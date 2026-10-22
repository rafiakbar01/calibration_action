<?php
// ============================================================================
// cron_check_certificates.php — Background Poller & Notifikasi Email Sertifikat Baru
// PT PANANJUNG ANUGRAH SOLUTION
// ============================================================================
// Kegunaan:
// 1. Dijalankan via cPanel Cron Job / Windows Task Scheduler setiap 5 - 15 menit.
//    Contoh Cron: */10 * * * * php -q /path/ke/cron_check_certificates.php > /dev/null 2>&1
// 2. Atau dipanggil melalui URL browser/cURL:
//    https://pascalibration.com/cron_check_certificates.php?key=pas_cron_sync_2026
// ============================================================================

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/db_customer.php';

// Kunci Pengaman untuk eksekusi via URL Browser
$secretKey = 'pas_cron_sync_2026';

// Cek apakah dieksekusi via CLI atau Web
$isCli = (php_sapi_name() === 'cli');

if (!$isCli) {
    // Validasi token pengaman jika dipanggil via web
    $inputKey = $_GET['key'] ?? '';
    if ($inputKey !== $secretKey && empty($_SESSION['is_admin_logged_in'])) {
        header('HTTP/1.1 403 Forbidden');
        echo json_encode([
            'success' => false,
            'message' => 'Akses ditolak. Secret key cron tidak valid.'
        ]);
        exit;
    }
}

// Opsi parameter
$recentMinutes = isset($_GET['minutes']) ? intval($_GET['minutes']) : null;
$recentDays    = isset($_GET['days']) ? floatval($_GET['days']) : ($recentMinutes !== null ? null : 7);
if ($isCli) {
    global $argv;
    foreach ($argv ?? [] as $arg) {
        if (strpos($arg, '--minutes=') === 0) {
            $recentMinutes = intval(substr($arg, 10));
        }
        if (strpos($arg, '--days=') === 0) {
            $recentDays = floatval(substr($arg, 7));
        }
        if ($arg === '--mark-only') {
            $markOnly = true;
        }
    }
}
$markOnly = !empty($_GET['mark_only']) || !empty($markOnly);

header('Content-Type: application/json; charset=utf-8');

try {
    $options = [
        'mark_only'       => $markOnly,
        'limit_per_folder'=> 50
    ];
    if ($recentMinutes !== null) {
        $options['recent_minutes'] = $recentMinutes;
    } else {
        $options['recent_days'] = $recentDays;
    }

    $result = checkAndNotifyNewCertificates($options);

    $result['timestamp']   = date('Y-m-d H:i:s');
    $result['recent_days'] = $recentDays;

    echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
} catch (Throwable $e) {
    echo json_encode([
        'success'   => false,
        'message'   => 'Terjadi pengecualian sistem: ' . $e->getMessage(),
        'timestamp' => date('Y-m-d H:i:s')
    ], JSON_PRETTY_PRINT);
}
