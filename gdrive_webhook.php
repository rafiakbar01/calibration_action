<?php
// ============================================================================
// gdrive_webhook.php — Penerima Realtime Google Drive Push Notifications
// PT PANANJUNG ANUGRAH SOLUTION
// ============================================================================
// Google akan mengirimkan HTTP POST ke URL ini setiap kali ada berkas baru
// diunggah atau diubah di folder Google Drive yang dipantau.
// ============================================================================

error_reporting(E_ALL);
ini_set('display_errors', 0);

require_once __DIR__ . '/db_customer.php';

// Ambil Header Google Push Notification
$channelId     = $_SERVER['HTTP_X_GOOG_CHANNEL_ID'] ?? '';
$resourceState = strtolower($_SERVER['HTTP_X_GOOG_RESOURCE_STATE'] ?? '');
$channelToken  = $_SERVER['HTTP_X_GOOG_CHANNEL_TOKEN'] ?? '';
$resourceId    = $_SERVER['HTTP_X_GOOG_RESOURCE_ID'] ?? '';
$resourceUri   = $_SERVER['HTTP_X_GOOG_RESOURCE_URI'] ?? '';
$messageNumber = $_SERVER['HTTP_X_GOOG_MESSAGE_NUMBER'] ?? '';

// Log file untuk pemantauan admin
$logFile = __DIR__ . '/gdrive_webhook.log';
$now = date('Y-m-d H:i:s');

function appendWebhookLog($msg) {
    global $logFile, $now;
    $line = "[{$now}] " . $msg . "\n";
    @file_put_contents($logFile, $line, FILE_APPEND | LOCK_EX);
}

// Respon handshake awal Google (State: sync)
if ($resourceState === 'sync') {
    appendWebhookLog("SYNC HANDSHAKE: Channel {$channelId} berhasil terhubung dengan Google Drive.");
    http_response_code(200);
    echo "OK - SYNC RECEIVED";
    exit;
}

// Abaikan jika bukan request resmi dari Google
if (empty($channelId) || empty($resourceState)) {
    appendWebhookLog("IGNORING REQUEST: Request bukan dari Google Push Notification.");
    http_response_code(200);
    echo "NO GOOGLE HEADERS";
    exit;
}

appendWebhookLog("EVENT MASUK: State: {$resourceState} | Channel: {$channelId} | ResourceId: {$resourceId}");

// Tangani perubahan berkas (add / update / change)
if (in_array($resourceState, ['add', 'update', 'change'])) {
    try {
        // Pindai folder Google Drive dan kirimkan email realtime ke klien yang berhak
        $scanResult = checkAndNotifyNewCertificates([
            'recent_minutes'  => 15, // Berkas baru 15 menit terakhir
            'mark_only'       => false,
            'limit_per_folder'=> 20
        ]);

        $sentCount = $scanResult['notifications_sent'] ?? 0;
        appendWebhookLog("SELESAI DIPROSES: {$sentCount} email notifikasi terkirim ke klien.");

    } catch (Throwable $e) {
        appendWebhookLog("ERROR PADA SCAN: " . $e->getMessage());
    }
}

// Google mewajibkan server mengembalikan HTTP 200 OK
http_response_code(200);
echo "OK";
exit;
