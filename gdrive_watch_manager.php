<?php
// ============================================================================
// gdrive_watch_manager.php — Pengelola Pendaftaran Realtime Webhook Google Drive
// PT PANANJUNG ANUGRAH SOLUTION
// ============================================================================

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/db_customer.php';

$secretKey = 'pas_cron_sync_2026';
$isCli = (php_sapi_name() === 'cli');

if (!$isCli) {
    $inputKey = $_GET['key'] ?? '';
    if ($inputKey !== $secretKey && empty($_SESSION['is_admin_logged_in'])) {
        header('HTTP/1.1 403 Forbidden');
        echo json_encode(['success' => false, 'message' => 'Akses ditolak.']);
        exit;
    }
}

$channelsFile = __DIR__ . '/gdrive_channels.json';
$credentialsPath = __DIR__ . '/credentials.json';

// URL Webhook resmi Paperless (wajib HTTPS publik)
$webhookAddress = 'https://pascalibration.com/gdrive_webhook.php';

function loadStoredChannels() {
    global $channelsFile;
    if (file_exists($channelsFile)) {
        $json = @file_get_contents($channelsFile);
        $data = json_decode($json, true);
        if (is_array($data)) return $data;
    }
    return [];
}

function saveStoredChannels($channels) {
    global $channelsFile;
    @file_put_contents($channelsFile, json_encode($channels, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
}

/**
 * Daftarkan pemantauan realtime ke Google Drive API untuk 1 folder
 */
function registerFolderWatch($folderId, $accessToken, $webhookUrl) {
    $channelId = 'ch_' . substr($folderId, 0, 12) . '_' . substr(md5(uniqid('', true)), 0, 10);
    // Expiration maksimal 7 hari dari sekarang (dalam milidetik)
    $expirationMs = (time() + (7 * 86400)) * 1000;

    $postData = [
        'id'         => $channelId,
        'type'       => 'web_hook',
        'address'    => $webhookUrl,
        'token'      => 'pas_webhook_token_2026',
        'expiration' => (string) $expirationMs
    ];

    $url = "https://www.googleapis.com/drive/v3/files/{$folderId}/watch?supportsAllDrives=true";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $accessToken,
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    $res = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $json = json_decode($res, true);
    if (!empty($json['id']) && !empty($json['resourceId'])) {
        return [
            'success'       => true,
            'channel_id'    => $json['id'],
            'resource_id'   => $json['resourceId'],
            'expiration_ms' => $json['expiration'] ?? $expirationMs,
            'expiration_dt' => date('Y-m-d H:i:s', intval(($json['expiration'] ?? $expirationMs) / 1000)),
            'folder_id'     => $folderId,
            'created_at'    => date('Y-m-d H:i:s')
        ];
    }

    return [
        'success'   => false,
        'http_code' => $httpCode,
        'error'     => $json['error']['message'] ?? $res,
        'folder_id' => $folderId
    ];
}

/**
 * Hentikan pemantauan channel lama di Google
 */
function stopFolderWatch($channelId, $resourceId, $accessToken) {
    $url = "https://www.googleapis.com/drive/v3/channels/stop";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
        'id'         => $channelId,
        'resourceId' => $resourceId
    ]));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $accessToken,
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $res = curl_exec($ch);
    curl_close($ch);
    return true;
}

// ----------------------------------------------------------------------------
// EKSEKUSI ACTION
// ----------------------------------------------------------------------------
$action = $_GET['action'] ?? 'status';
header('Content-Type: application/json; charset=utf-8');

try {
    $accessToken = getCustomerSaToken($credentialsPath);
    if (!$accessToken) {
        throw new Exception("Gagal mendapatkan Access Token Service Account.");
    }

    $existingChannels = loadStoredChannels();

    // 1. ACTION: REGISTER ALL / RENEW
    if ($action === 'register' || $action === 'renew') {
        $pdo = getCustomerPdo();
        $clients = $pdo->query("SELECT folder_ids, folder_ids_tambahan, email_tambahan FROM `client_access` WHERE `status` = 'active'")->fetchAll();

        $allFolders = [];
        // Tambahkan Root Folder jika ada
        $rootFolderId = '19qvHuJ0q84DARVA8uf0DLPq7Vtpv4Hwq';
        $allFolders[] = $rootFolderId;

        foreach ($clients as $c) {
            $raw = ($c['folder_ids'] ?? '') . "\n" . ($c['folder_ids_tambahan'] ?? '');
            $splits = preg_split('/[\r\n,;]+/', $raw);
            foreach ($splits as $sp) {
                $ext = extractGoogleDriveId($sp);
                if ($ext) $allFolders[] = $ext;
            }
            $adds = parseAdditionalEmails($c['email_tambahan'] ?? '');
            foreach ($adds as $add) {
                if (!empty($add['folder_ids'])) {
                    $splits2 = preg_split('/[\r\n,;]+/', $add['folder_ids']);
                    foreach ($splits2 as $sp2) {
                        $ext2 = extractGoogleDriveId($sp2);
                        if ($ext2) $allFolders[] = $ext2;
                    }
                }
            }
        }

        $allFolders = array_values(array_unique(array_filter($allFolders)));
        $registered = [];
        $failed = [];

        foreach ($allFolders as $fId) {
            // Hentikan channel lama untuk folder ini jika ada
            if (isset($existingChannels[$fId])) {
                stopFolderWatch($existingChannels[$fId]['channel_id'], $existingChannels[$fId]['resource_id'], $accessToken);
            }

            $reg = registerFolderWatch($fId, $accessToken, $webhookAddress);
            if ($reg['success']) {
                $existingChannels[$fId] = $reg;
                $registered[] = $reg;
            } else {
                $failed[] = $reg;
            }
        }

        saveStoredChannels($existingChannels);

        echo json_encode([
            'success'          => true,
            'message'          => 'Pendaftaran realtime webhook selesai diproses.',
            'total_folders'    => count($allFolders),
            'registered_count' => count($registered),
            'failed_count'     => count($failed),
            'registered'       => $registered,
            'failed'           => $failed,
            'webhook_address'  => $webhookAddress
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        exit;
    }

    // 2. ACTION: STATUS
    $nowMs = time() * 1000;
    $statusList = [];
    foreach ($existingChannels as $fId => $ch) {
        $expMs = intval($ch['expiration_ms'] ?? 0);
        $isExpired = ($nowMs >= $expMs);
        $daysLeft = round(($expMs - $nowMs) / (86400 * 1000), 1);
        $statusList[] = [
            'folder_id'     => $fId,
            'channel_id'    => $ch['channel_id'],
            'created_at'    => $ch['created_at'] ?? 'N/A',
            'expires_at'    => $ch['expiration_dt'] ?? 'N/A',
            'days_left'     => $daysLeft,
            'is_active'     => !$isExpired
        ];
    }

    echo json_encode([
        'success'         => true,
        'webhook_url'     => $webhookAddress,
        'total_channels'  => count($statusList),
        'channels'        => $statusList
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

} catch (Throwable $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ], JSON_PRETTY_PRINT);
}
