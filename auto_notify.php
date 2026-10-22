<?php
// ============================================================================
// auto_notify.php — Notifikasi Otomatis Berkas Sertifikat Baru (Cron-Friendly)
// PT PANANJUNG ANUGRAH SOLUTION
// ============================================================================
// Dijalankan via cPanel Cron Job setiap 5 menit:
//   */5 * * * * php -q /home/USERNAME/public_html/auto_notify.php >> /dev/null 2>&1
//
// Atau via URL (dilindungi secret key):
//   https://pascalibration.com/auto_notify.php?key=pas_auto_notify_2026
// ============================================================================

// Cegah timeout PHP
set_time_limit(120);
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/auto_notify_error.log');

// Lock file — mencegah proses berjalan ganda secara bersamaan
$lockFile = sys_get_temp_dir() . '/pas_auto_notify.lock';
$logFile  = __DIR__ . '/auto_notify.log';
$isCli    = (php_sapi_name() === 'cli');

// Proteksi akses web
if (!$isCli) {
    $secretKey = 'pas_auto_notify_2026';
    $inputKey  = $_GET['key'] ?? '';
    $isLocal   = in_array($_SERVER['REMOTE_ADDR'] ?? '', ['127.0.0.1', '::1']);
    if ($inputKey !== $secretKey && !$isLocal) {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'Akses ditolak.']);
        exit;
    }
    header('Content-Type: application/json; charset=utf-8');
}

function autoNotifyLog($msg) {
    global $logFile;
    $ts = date('Y-m-d H:i:s');
    @file_put_contents($logFile, "[{$ts}] {$msg}\n", FILE_APPEND | LOCK_EX);
}

// Cek lock — hindari proses ganda
if (file_exists($lockFile)) {
    $lockAge = time() - filemtime($lockFile);
    if ($lockAge < 90) {
        if (!$isCli) {
            echo json_encode([
                'success'   => false,
                'message'   => "Proses sebelumnya masih berjalan ({$lockAge}s). Skip.",
                'timestamp' => date('Y-m-d H:i:s')
            ]);
        }
        exit;
    }
    @unlink($lockFile);
}

// Buat lock
@file_put_contents($lockFile, date('Y-m-d H:i:s'));

require_once __DIR__ . '/db_customer.php';

// Jumlah siklus: CLI jalan 2 siklus (interval ~25 detik) agar realtime, Web jalan 1 siklus
$cycles = $isCli ? 2 : 1;
$totalSent = 0;
$scannedFolders = 0;
$allErrors = [];

try {
    for ($i = 1; $i <= $cycles; $i++) {
        // Cek berkas yang diunggah / diubah dalam 15 menit terakhir
        $result = checkAndNotifyNewCertificates([
            'recent_minutes'   => 15,
            'mark_only'        => false,
            'limit_per_folder' => 20,
        ]);

        $sent    = $result['notifications_sent'] ?? 0;
        $scanned = $result['scanned_folders']    ?? 0;
        $errors  = $result['errors']             ?? [];

        $totalSent += $sent;
        $scannedFolders = $scanned;
        if (!empty($errors)) {
            $allErrors = array_merge($allErrors, $errors);
        }

        if ($sent > 0) {
            $msg = "SIKLUS {$i}: {$scanned} folder diperiksa, {$sent} email TERKIRIM REALTIME.";
            autoNotifyLog($msg);
            if ($isCli) echo "[" . date('Y-m-d H:i:s') . "] {$msg}\n";
        }

        // Jika CLI dan masih ada siklus berikutnya, tunggu 25 detik
        if ($isCli && $i < $cycles) {
            sleep(25);
        }
    }

    if ($totalSent === 0) {
        $msg = "DONE: {$scannedFolders} folder diperiksa, tidak ada berkas baru.";
        autoNotifyLog($msg);
        if ($isCli) echo "[" . date('Y-m-d H:i:s') . "] {$msg}\n";
    }

    if (!$isCli) {
        echo json_encode([
            'success'            => true,
            'scanned_folders'    => $scannedFolders,
            'notifications_sent' => $totalSent,
            'errors'             => $allErrors,
            'timestamp'          => date('Y-m-d H:i:s')
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

} catch (Throwable $e) {
    $errMsg = "ERROR: " . $e->getMessage();
    autoNotifyLog($errMsg);
    if ($isCli) {
        echo "[" . date('Y-m-d H:i:s') . "] {$errMsg}\n";
    } else {
        echo json_encode([
            'success'   => false,
            'message'   => $e->getMessage(),
            'timestamp' => date('Y-m-d H:i:s')
        ], JSON_PRETTY_PRINT);
    }
} finally {
    @unlink($lockFile);
}
