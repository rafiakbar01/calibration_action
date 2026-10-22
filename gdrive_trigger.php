<?php
// ============================================================================
// gdrive_trigger.php — Endpoint untuk Google Apps Script
// PT PANANJUNG ANUGRAH SOLUTION
// ============================================================================

set_time_limit(60);
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/gdrive_trigger_error.log');

$logFile   = __DIR__ . '/gdrive_trigger.log';
$secretKey = 'pas_gdrive_trigger_2026';

function triggerLog($msg) {
    global $logFile;
    $ts = date('Y-m-d H:i:s');
    @file_put_contents($logFile, "[{$ts}] {$msg}\n", FILE_APPEND | LOCK_EX);
}

header('Content-Type: application/json; charset=utf-8');

// ─── Validasi secret key ──────────────────────────────────────────────────────
$inputKey = $_GET['key'] ?? (json_decode(file_get_contents('php://input'), true)['key'] ?? '');
if ($inputKey !== $secretKey) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Akses ditolak.']);
    exit;
}

require_once __DIR__ . '/db_customer.php';

$action = $_GET['action'] ?? 'notify';

// ─── ACTION: Ambil daftar folder ID semua klien aktif ────────────────────────
if ($action === 'get_folders') {
    try {
        $pdo = getCustomerPdo();
        $clients = $pdo->query("SELECT folder_ids, folder_ids_tambahan, email_tambahan FROM client_access WHERE status = 'active'")->fetchAll();

        $allFolders = [];
        foreach ($clients as $c) {
            $raw = trim(($c['folder_ids'] ?? '') . "\n" . ($c['folder_ids_tambahan'] ?? ''));
            $splits = preg_split('/[\r\n,;]+/', $raw);
            foreach ($splits as $sp) {
                $fid = extractGoogleDriveId(trim($sp));
                if ($fid) $allFolders[] = $fid;
            }
            // Email tambahan dengan folder khusus
            $adds = parseAdditionalEmails($c['email_tambahan'] ?? '');
            foreach ($adds as $add) {
                if (!empty($add['folder_ids'])) {
                    $splits2 = preg_split('/[\r\n,;]+/', $add['folder_ids']);
                    foreach ($splits2 as $sp2) {
                        $fid2 = extractGoogleDriveId(trim($sp2));
                        if ($fid2) $allFolders[] = $fid2;
                    }
                }
            }
        }

        $allFolders = array_values(array_unique(array_filter($allFolders)));
        triggerLog("GET_FOLDERS: " . count($allFolders) . " folder dikirim ke Apps Script.");

        echo json_encode([
            'success' => true,
            'folders' => $allFolders,
            'count'   => count($allFolders)
        ]);
    } catch (Throwable $e) {
        triggerLog("ERROR get_folders: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    exit;
}

// ─── ACTION: Terima file baru dari Apps Script dan kirim email ───────────────
if ($action === 'notify' || $_SERVER['REQUEST_METHOD'] === 'POST') {
    $body = json_decode(file_get_contents('php://input'), true);
    $files = $body['files'] ?? [];

    if (empty($files)) {
        echo json_encode(['success' => false, 'message' => 'Tidak ada file yang dikirim.']);
        exit;
    }

    triggerLog("NOTIF MASUK: " . count($files) . " file baru dari Google Apps Script.");

    try {
        $pdo = getCustomerPdo();

        // Bangun peta folder → klien penerima
        $clients = $pdo->query("SELECT * FROM client_access WHERE status = 'active'")->fetchAll();
        $folderMap = [];

        foreach ($clients as $client) {
            $cEmail      = strtolower(trim($client['email']));
            $cNama       = trim($client['nama']);
            $cPerusahaan = trim($client['perusahaan']);
            $cId         = $client['id'];

            $raw = trim(($client['folder_ids'] ?? '') . "\n" . ($client['folder_ids_tambahan'] ?? ''));
            $splits = preg_split('/[\r\n,;]+/', $raw);
            foreach ($splits as $sp) {
                $fid = extractGoogleDriveId(trim($sp));
                if ($fid) {
                    if (!isset($folderMap[$fid])) $folderMap[$fid] = [];
                    $folderMap[$fid][$cEmail] = [
                        'email'      => $cEmail,
                        'nama'       => $cNama,
                        'perusahaan' => $cPerusahaan,
                        'client_id'  => $cId
                    ];
                }
            }
            // Email tambahan
            $adds = parseAdditionalEmails($client['email_tambahan'] ?? '');
            foreach ($adds as $add) {
                $addEmail = strtolower(trim($add['email']));
                if (empty($addEmail)) continue;
                $addFolderRaw = !empty($add['folder_ids']) ? $add['folder_ids'] : ($client['folder_ids'] ?? '');
                foreach (preg_split('/[\r\n,;]+/', $addFolderRaw) as $sp) {
                    $fid = extractGoogleDriveId(trim($sp));
                    if ($fid) {
                        if (!isset($folderMap[$fid])) $folderMap[$fid] = [];
                        $folderMap[$fid][$addEmail] = [
                            'email'      => $addEmail,
                            'nama'       => !empty($add['nama']) ? $add['nama'] : $cNama,
                            'perusahaan' => $cPerusahaan,
                            'client_id'  => $cId
                        ];
                    }
                }
            }
        }

        // Cache pengingat berbasis file JSON lokal (100% tanpa database)
        // Mencegah email terkirim berulang kali saat Google Apps Script berjalan berkala
        $cacheFile = __DIR__ . '/sent_notifications.json';
        $sentCache = [];
        if (file_exists($cacheFile)) {
            $rawCache = @file_get_contents($cacheFile);
            if (!empty($rawCache)) {
                $sentCache = json_decode($rawCache, true) ?: [];
            }
        }

        // Bersihkan entri yang sudah lebih dari 20 hari agar file sent_notifications.json tetap kecil
        $now = time();
        $cutoff = $now - (20 * 86400);
        $cacheChanged = false;
        foreach ($sentCache as $k => $ts) {
            if ($ts < $cutoff) {
                unset($sentCache[$k]);
                $cacheChanged = true;
            }
        }

        $totalSent    = 0;
        $totalSkipped = 0;
        $log          = [];

        foreach ($files as $fileInfo) {
            $fileId     = $fileInfo['fileId']     ?? '';
            $fileName   = $fileInfo['fileName']   ?? 'Berkas Baru';
            $folderId   = $fileInfo['folderId']   ?? '';
            $folderName = $fileInfo['folderName'] ?? 'Folder Sertifikat';

            if (empty($fileId) || empty($folderId)) continue;

            $recipients = $folderMap[$folderId] ?? [];
            if (empty($recipients)) {
                triggerLog("SKIP: Folder {$folderId} tidak punya klien terdaftar di sistem.");
                continue;
            }

            foreach ($recipients as $rEmail => $recipient) {
                $cacheKey = $fileId . '|' . $rEmail;

                // Cek apakah file ini sudah pernah dikirimkan emailnya ke klien ini
                if (isset($sentCache[$cacheKey])) {
                    $totalSkipped++;
                    continue; // Lewati! Hanya kirim sekali saja
                }

                // Kirim email notifikasi
                $sent = sendNewCertificateNotificationEmail(
                    $recipient['email'],
                    $recipient['nama'],
                    $recipient['perusahaan'],
                    $fileName,
                    $fileId,
                    $folderName
                );

                if ($sent) {
                    $totalSent++;
                    $sentCache[$cacheKey] = $now;
                    $cacheChanged = true;
                    $msg = "EMAIL TERKIRIM: {$fileName} → {$rEmail} (folder: {$folderName})";
                    triggerLog($msg);
                    $log[] = $msg;
                } else {
                    triggerLog("EMAIL GAGAL: {$fileName} → {$rEmail}");
                }
            }
        }

        // Simpan cache ke file lokal jika ada berkas yang baru dikirim
        if ($cacheChanged) {
            @file_put_contents($cacheFile, json_encode($sentCache, JSON_PRETTY_PRINT), LOCK_EX);
        }

        $summary = "SELESAI: {$totalSent} email notifikasi terkirim, {$totalSkipped} dilewati (sudah pernah dikirim).";
        triggerLog($summary);

        echo json_encode([
            'success'         => true,
            'emails_sent'     => $totalSent,
            'emails_skipped'  => $totalSkipped,
            'log'             => $log,
            'timestamp'       => date('Y-m-d H:i:s')
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

    } catch (Throwable $e) {
        triggerLog("ERROR notify: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    exit;
}

echo json_encode(['success' => false, 'message' => 'Action tidak dikenal.']);
