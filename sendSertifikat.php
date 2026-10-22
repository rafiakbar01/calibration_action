<?php
// ============================================================================
// sendSertifikat.php — Portal Pengiriman Sertifikat Digital (Khusus Tim Marketing)
// PT PANANJUNG ANUGRAH SOLUTION
// ============================================================================
// FITUR & KEAMANAN:
// 1. Khusus Tim Marketing internal PT Pananjung Anugrah Solution.
// 2. Login menggunakan Email Perusahaan (OTP) yang didaftarkan via kelolaKlien.php.
// 3. Tanpa Google OAuth login untuk simplifikasi dan fokus tim internal.
// 4. Marketing dapat mencari, menelusuri, dan melihat pratinjau berkas sertifikat.
// 5. Mengirimkan sertifikat digital langsung ke email customer (dilengkapi
//    lampiran PDF langsung & tautan Paperless online).
// ============================================================================

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 0); // Ubah ke 1 saat debugging

require_once __DIR__ . '/db_customer.php';

// =========================================================================
// KONFIGURASI
// =========================================================================

// Folder ID utama di Google Drive yang berisi kumpulan folder sertifikat klien/PT
$rootFolderId = '19qvHuJ0q84DARVA8uf0DLPq7Vtpv4Hwq';

// Sanitasi otomatis ID root folder
if (preg_match('/folders\/([a-zA-Z0-9_-]+)/i', $rootFolderId, $matchId)) {
    $rootFolderId = $matchId[1];
} elseif (preg_match('/[?&]id=([a-zA-Z0-9_-]+)/i', $rootFolderId, $matchId)) {
    $rootFolderId = $matchId[1];
}

// Deteksi Host & URL Halaman Saat Ini
$currentHost = $_SERVER['HTTP_HOST'] ?? 'pascalibration.com';
$requestPath = strtok($_SERVER['REQUEST_URI'] ?? '', '?');
$pageUrl     = (!empty($requestPath) && $requestPath !== '/') ? $requestPath : '/sendSertifikat.php';

// Path file credentials Service Account
$credentialsPath = __DIR__ . '/credentials.json';

// URL Viewer di Paperless
$paperlessUrl = 'https://paperless.pascalibration.com/sertifikat/gdrive-view';

// =========================================================================
// 1. HELPER NATIVE GDRIVE & AUTH SERVICE ACCOUNT
// =========================================================================

function base64UrlEncode($data) {
    return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($data));
}

/**
 * Dapatkan Access Token dari Service Account (credentials.json)
 */
function getServiceAccountToken($credentialsPath) {
    if (!file_exists($credentialsPath)) {
        throw new Exception("File credentials.json tidak ditemukan di: " . $credentialsPath);
    }

    $sa = json_decode(file_get_contents($credentialsPath), true);
    if (!$sa || empty($sa['private_key']) || empty($sa['client_email'])) {
        throw new Exception("Format credentials.json tidak valid.");
    }

    $now = time();
    $header  = base64UrlEncode(json_encode(['alg' => 'RS256', 'typ' => 'JWT']));
    $payload = base64UrlEncode(json_encode([
        'iss'   => $sa['client_email'],
        'scope' => 'https://www.googleapis.com/auth/drive.readonly',
        'aud'   => 'https://oauth2.googleapis.com/token',
        'exp'   => $now + 3600,
        'iat'   => $now
    ]));

    $signingInput = $header . '.' . $payload;
    openssl_sign($signingInput, $signature, $sa['private_key'], 'SHA256');
    $jwt = $signingInput . '.' . base64UrlEncode($signature);

    $ch = curl_init('https://oauth2.googleapis.com/token');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
        'assertion'  => $jwt
    ]));
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    $res = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $data = json_decode($res, true);
    if (!empty($data['access_token'])) {
        return $data['access_token'];
    }

    throw new Exception("Gagal mendapatkan access token dari Service Account. HTTP: {$httpCode}");
}

/**
 * Panggil Google Drive API via cURL
 */
function curlGDriveAPI($url, $accessToken) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $accessToken,
        'Accept: application/json'
    ]);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    $res = curl_exec($ch);
    curl_close($ch);
    return json_decode($res, true);
}

/**
 * Download konten berkas dari Google Drive via Service Account
 */
function downloadGDriveFileContent($fileId, $accessToken) {
    $url = "https://www.googleapis.com/drive/v3/files/{$fileId}?alt=media&supportsAllDrives=true";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $accessToken]);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    $data = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode >= 200 && $httpCode < 300 && !empty($data)) {
        return $data;
    }
    return null;
}

/**
 * Ambil daftar file/folder di dalam folder tertentu
 */
function listDriveFiles($parentFolderId, $accessToken, $searchQuery = '') {
    $allFiles = [];
    $pageToken = null;
    $fields = 'nextPageToken,files(id,name,mimeType,parents,modifiedTime,size)';

    do {
        $q = "'{$parentFolderId}' in parents and trashed = false";
        if (!empty($searchQuery)) {
            $q .= " and name contains '" . addslashes($searchQuery) . "'";
        }

        $params = [
            'q'                         => $q,
            'fields'                    => $fields,
            'orderBy'                   => 'folder,name',
            'pageSize'                  => 100,
            'supportsAllDrives'         => 'true',
            'includeItemsFromAllDrives' => 'true'
        ];

        if ($pageToken) {
            $params['pageToken'] = $pageToken;
        }

        $apiUrl = "https://www.googleapis.com/drive/v3/files?" . http_build_query($params);
        $resData = curlGDriveAPI($apiUrl, $accessToken);

        if (!empty($resData['files'])) {
            $allFiles = array_merge($allFiles, $resData['files']);
        }

        $pageToken = $resData['nextPageToken'] ?? null;
    } while ($pageToken);

    return $allFiles;
}

/**
 * Ambil info file/folder (nama & parent)
 */
function getFolderInfo($folderId, $accessToken) {
    $url = "https://www.googleapis.com/drive/v3/files/{$folderId}?fields=id,name,parents,mimeType,size,modifiedTime&supportsAllDrives=true";
    return curlGDriveAPI($url, $accessToken);
}

/**
 * Kumpulkan semua ID folder dan subfolder di bawah folder tertentu
 */
function getAllSubfolderIds($parentFolderIds, $accessToken, $maxDepth = 4) {
    $allFolderIds = $parentFolderIds;
    $queue = $parentFolderIds;
    $depth = 0;

    while (!empty($queue) && $depth < $maxDepth) {
        $nextQueue = [];
        $chunks = array_chunk($queue, 10);

        foreach ($chunks as $chunk) {
            $parentConditions = [];
            foreach ($chunk as $pid) {
                $parentConditions[] = "'{$pid}' in parents";
            }
            $q = "(" . implode(" or ", $parentConditions) . ") and mimeType = 'application/vnd.google-apps.folder' and trashed = false";
            $params = [
                'q'                         => $q,
                'fields'                    => 'files(id)',
                'pageSize'                  => 100,
                'supportsAllDrives'         => 'true',
                'includeItemsFromAllDrives' => 'true'
            ];
            $apiUrl = "https://www.googleapis.com/drive/v3/files?" . http_build_query($params);
            $res = curlGDriveAPI($apiUrl, $accessToken);

            if (!empty($res['files'])) {
                foreach ($res['files'] as $f) {
                    if (!in_array($f['id'], $allFolderIds)) {
                        $allFolderIds[] = $f['id'];
                        $nextQueue[]    = $f['id'];
                    }
                }
            }
        }
        $queue = $nextQueue;
        $depth++;
    }

    return $allFolderIds;
}

/**
 * Cari file/folder di dalam cakupan folder yang diizinkan
 */
function searchDriveScoped($allowedParentFolderIds, $searchQuery, $accessToken) {
    if (empty($allowedParentFolderIds) || empty(trim($searchQuery))) {
        return [];
    }

    $scopeFolderIds = getAllSubfolderIds($allowedParentFolderIds, $accessToken);
    $results = [];
    $chunks = array_chunk($scopeFolderIds, 15);

    foreach ($chunks as $chunk) {
        $parentOrs = [];
        foreach ($chunk as $pid) {
            $parentOrs[] = "'{$pid}' in parents";
        }
        $q = "(" . implode(" or ", $parentOrs) . ") and name contains '" . addslashes($searchQuery) . "' and trashed = false";

        $params = [
            'q'                         => $q,
            'fields'                    => 'files(id,name,mimeType,parents,modifiedTime,size)',
            'orderBy'                   => 'folder,name',
            'pageSize'                  => 50,
            'supportsAllDrives'         => 'true',
            'includeItemsFromAllDrives' => 'true'
        ];

        $apiUrl = "https://www.googleapis.com/drive/v3/files?" . http_build_query($params);
        $res = curlGDriveAPI($apiUrl, $accessToken);

        if (!empty($res['files'])) {
            $results = array_merge($results, $res['files']);
        }
    }

    return $results;
}

/**
 * Format ikon file berdasarkan mimeType
 */
function getFileIcon($mimeType) {
    if ($mimeType === 'application/vnd.google-apps.folder') {
        return ['fas fa-folder', 'folder'];
    } elseif (strpos($mimeType, 'pdf') !== false) {
        return ['far fa-file-pdf', 'pdf'];
    } elseif (strpos($mimeType, 'spreadsheet') !== false || strpos($mimeType, 'excel') !== false) {
        return ['far fa-file-excel', 'excel'];
    } elseif (strpos($mimeType, 'word') !== false || strpos($mimeType, 'document') !== false) {
        return ['far fa-file-word', 'doc'];
    } elseif (strpos($mimeType, 'image') !== false) {
        return ['far fa-file-image', 'image'];
    }
    return ['far fa-file-alt', 'generic'];
}

function formatFileSize($bytes) {
    if ($bytes <= 0) return '';
    $units = ['B', 'KB', 'MB', 'GB'];
    $i = floor(log($bytes, 1024));
    return round($bytes / pow(1024, $i), 1) . ' ' . $units[$i];
}

function formatDate($isoString) {
    if (empty($isoString)) return '';
    $ts = strtotime($isoString);
    if (!$ts) return '';
    return date('d/m/Y H:i', $ts);
}

// =========================================================================
// 2. HANDLE LOGOUT MARKETING
// =========================================================================
if (isset($_GET['logout'])) {
    unset(
        $_SESSION['marketing_logged_in'],
        $_SESSION['marketing_email'],
        $_SESSION['marketing_name'],
        $_SESSION['marketing_divisi']
    );
    header("Location: " . $pageUrl);
    exit;
}

// =========================================================================
// 3. HANDLE AJAX AUTH: OTP MARKETING EMAIL (marketing_access)
// =========================================================================
if (isset($_GET['action']) && $_GET['action'] === 'send_marketing_otp' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json; charset=utf-8');
    $inputEmail = strtolower(trim($_POST['email'] ?? ''));
    if (empty($inputEmail)) {
        echo json_encode(['success' => false, 'message' => 'Alamat email marketing wajib diisi.']);
        exit;
    }
    $res = generateAndSendMarketingOtp($inputEmail);
    echo json_encode($res);
    exit;
}

if (isset($_GET['action']) && $_GET['action'] === 'verify_marketing_otp' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json; charset=utf-8');
    $inputEmail = strtolower(trim($_POST['email'] ?? ''));
    $inputOtp   = trim($_POST['otp'] ?? '');

    $res = verifyMarketingOtp($inputEmail, $inputOtp);
    if ($res['success']) {
        $marketing = $res['marketing'];
        $_SESSION['marketing_logged_in'] = true;
        $_SESSION['marketing_email']     = strtolower($marketing['email']);
        $_SESSION['marketing_name']      = $marketing['nama'];
        $_SESSION['marketing_divisi']    = $marketing['divisi'] ?? 'Marketing & Sales';
        echo json_encode(['success' => true, 'redirect' => $pageUrl]);
    } else {
        echo json_encode(['success' => false, 'message' => $res['message']]);
    }
    exit;
}

// =========================================================================
// 4. CEK SESSION LOGIN MARKETING
// =========================================================================
$marketingEmail   = strtolower($_SESSION['marketing_email'] ?? '');
$marketingName    = $_SESSION['marketing_name'] ?? '';
$marketingDivisi  = $_SESSION['marketing_divisi'] ?? 'Marketing & Sales';

if (!empty($marketingEmail) && empty($marketingName)) {
    $mRow = getMarketingByEmail($marketingEmail);
    if ($mRow) {
        $marketingName = $mRow['nama'] ?? '';
        $_SESSION['marketing_name'] = $marketingName;
        if (!empty($mRow['divisi'])) {
            $marketingDivisi = $mRow['divisi'];
            $_SESSION['marketing_divisi'] = $marketingDivisi;
        }
    }
}

$isLoggedIn       = !empty($_SESSION['marketing_logged_in']) && !empty($marketingEmail);

// =========================================================================
// 5. HANDLE AJAX: KIRIM SERTIFIKAT KE EMAIL CUSTOMER (SINGLE & BATCH MULTI-FILE)
// =========================================================================
if (isset($_GET['action']) && $_GET['action'] === 'send_cert_email' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json; charset=utf-8');

    if (!$isLoggedIn) {
        echo json_encode(['success' => false, 'message' => 'Sesi login marketing telah berakhir. Silakan login kembali.']);
        exit;
    }

    // Ambil daftar file ID (bisa berupa JSON array string, POST array file_ids, atau single file_id)
    $rawFileIds = $_POST['file_ids'] ?? ($_POST['file_id'] ?? []);
    $fileIds = [];

    if (is_array($rawFileIds)) {
        $fileIds = $rawFileIds;
    } elseif (is_string($rawFileIds)) {
        $trimmed = trim($rawFileIds);
        if (str_starts_with($trimmed, '[') || str_starts_with($trimmed, '{')) {
            $decoded = json_decode($trimmed, true);
            if (is_array($decoded)) {
                $fileIds = $decoded;
            }
        } elseif (!empty($trimmed)) {
            $fileIds = [$trimmed];
        }
    }

    // Bersihkan fileIds
    $fileIds = array_values(array_unique(array_filter(array_map('trim', $fileIds))));

    $customerEmail = strtolower(trim($_POST['customer_email'] ?? ''));
    $customerName  = trim($_POST['customer_name'] ?? '');
    $companyName   = trim($_POST['company_name'] ?? '');
    $customNotes   = trim($_POST['custom_notes'] ?? '');
    $attachPdf     = !empty($_POST['attach_pdf']) && $_POST['attach_pdf'] == '1';

    if (empty($fileIds) || empty($customerEmail)) {
        echo json_encode(['success' => false, 'message' => 'Berkas sertifikat (minimal 1 berkas) dan email pelanggan wajib ditentukan.']);
        exit;
    }

    if (!filter_var($customerEmail, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Format email pelanggan tidak valid.']);
        exit;
    }

    try {
        $accessToken = getServiceAccountToken($credentialsPath);
        $preparedFiles = [];
        $attachments = [];
        $totalAttachBytes = 0;
        $maxTotalAttachBytes = 20 * 1024 * 1024; // Maksimal 20MB total lampiran PDF

        foreach ($fileIds as $fId) {
            $fInfo = getFolderInfo($fId, $accessToken);
            if (!$fInfo || !empty($fInfo['error'])) {
                continue;
            }

            // Tentukan certId untuk viewer Paperless
            $certId = '';
            if (preg_match('/(PAS-\d+)/i', $fInfo['name'], $m)) {
                $certId = strtoupper($m[1]);
            } else {
                $certId = pathinfo($fInfo['name'], PATHINFO_FILENAME);
            }

            $sig = substr(hash_hmac('sha256', $fId . '|' . $certId, 'PAS_CALIBRATION_SECURE_GDRIVE_KEY_2026'), 0, 16);
            $viewUrl = $paperlessUrl . "?" . http_build_query([
                'file_id' => $fId,
                'cert_id' => $certId,
                'sig'     => $sig
            ]);

            $fileItem = [
                'id'      => $fId,
                'name'    => $fInfo['name'],
                'size'    => intval($fInfo['size'] ?? 0),
                'certId'  => $certId,
                'viewUrl' => $viewUrl
            ];
            $preparedFiles[] = $fileItem;

            // Jika opsi lampiran PDF aktif dan total ukuran masih di bawah batas
            if ($attachPdf) {
                $fileSize = intval($fInfo['size'] ?? 0);
                if (($totalAttachBytes + $fileSize) <= $maxTotalAttachBytes) {
                    $pdfContent = downloadGDriveFileContent($fId, $accessToken);
                    if ($pdfContent) {
                        $sanitizedName = preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $fInfo['name']);
                        if (!str_ends_with(strtolower($sanitizedName), '.pdf')) {
                            $sanitizedName .= '.pdf';
                        }
                        $attachments[] = [
                            'name'    => $sanitizedName,
                            'content' => $pdfContent,
                            'mime'    => 'application/pdf'
                        ];
                        $totalAttachBytes += strlen($pdfContent);
                    }
                }
            }
        }

        if (empty($preparedFiles)) {
            echo json_encode(['success' => false, 'message' => 'Berkas sertifikat yang dipilih tidak ditemukan di Google Drive.']);
            exit;
        }

        // Kirim email sertifikat (bisa 1 atau banyak berkas)
        $sendOk = sendCertificateEmailToCustomer(
            $customerEmail,
            $customerName,
            $companyName,
            $marketingName,
            $marketingEmail,
            $preparedFiles,
            '',
            $customNotes,
            $attachments
        );

        $totalSent = count($preparedFiles);
        $totalAttached = count($attachments);

        if ($sendOk) {
            $msgSuccess = $totalSent === 1
                ? "Sertifikat '{$preparedFiles[0]['name']}' berhasil dikirimkan ke email {$customerEmail}."
                : "Sebanyak {$totalSent} berkas sertifikat berhasil dikirimkan sekaligus ke email {$customerEmail}.";

            if ($attachPdf && $totalAttached > 0) {
                $msgSuccess .= " ({$totalAttached} berkas PDF dilampirkan langsung)";
            }

            echo json_encode([
                'success' => true,
                'message' => $msgSuccess,
                'total_sent' => $totalSent,
                'total_attached' => $totalAttached
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => "Gagal mengirimkan email ke {$customerEmail}. Periksa koneksi SMTP mail server."
            ]);
        }
    } catch (Throwable $e) {
        echo json_encode(['success' => false, 'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()]);
    }
    exit;
}

// =========================================================================
// 6. PROSES BROWSE & PENCARIAN SERTIFIKAT
// =========================================================================
$currentFolderId    = trim($_GET['folder_id'] ?? '');
$searchQuery        = trim($_GET['search'] ?? '');
$filesFound         = [];
$breadcrumbs        = [];
$currentFolderName  = 'Semua Sertifikat';
$isSearchMode       = false;
$allClientsList     = [];

if ($isLoggedIn) {
    try {
        $accessToken = getServiceAccountToken($credentialsPath);

        // Ambil daftar klien terdaftar untuk preset dropdown kirim sertifikat
        try {
            $pdo = getCustomerPdo();
            $allClientsList = $pdo->query("SELECT id, nama, email, perusahaan FROM `client_access` WHERE status = 'active' ORDER BY perusahaan ASC, nama ASC")->fetchAll();
        } catch (Throwable $ex) {
            $allClientsList = [];
        }

        // Cek apakah marketing dibatasi folder tertentu atau boleh akses root
        $marketingAllowedFids = getMarketingAllowedFolderIds($marketingEmail);
        $hasCustomScope = !empty($marketingAllowedFids);

        // Tentukan root browse
        if ($hasCustomScope) {
            $baseFolderScope = $marketingAllowedFids;
        } else {
            $baseFolderScope = [$rootFolderId];
        }

        if (!empty($searchQuery)) {
            // MODE PENCARIAN
            $isSearchMode = true;
            if (!empty($currentFolderId)) {
                $filesFound = searchDriveScoped([$currentFolderId], $searchQuery, $accessToken);
            } else {
                $filesFound = searchDriveScoped($baseFolderScope, $searchQuery, $accessToken);
            }
        } else {
            // MODE BROWSE FOLDER
            if (empty($currentFolderId) || $currentFolderId === $rootFolderId) {
                if ($hasCustomScope) {
                    // Tampilkan hanya folder-folder khusus yang ditugaskan ke marketing ini
                    foreach ($marketingAllowedFids as $fid) {
                        $info = getFolderInfo($fid, $accessToken);
                        if ($info && empty($info['error'])) {
                            $filesFound[] = $info;
                        }
                    }
                    $currentFolderName = 'Folder Sertifikat Ditugaskan';
                } else {
                    // Akses penuh root folder sertifikat
                    $filesFound = listDriveFiles($rootFolderId, $accessToken);
                    $currentFolderName = 'Beranda Sertifikat (Root)';
                }
            } else {
                // Di dalam subfolder
                $filesFound = listDriveFiles($currentFolderId, $accessToken);
                $info = getFolderInfo($currentFolderId, $accessToken);
                $currentFolderName = $info['name'] ?? 'Folder';

                // Susun breadcrumb
                $breadcrumbs[] = ['id' => '', 'name' => 'Beranda'];
                if ($currentFolderId !== $rootFolderId) {
                    $breadcrumbs[] = ['id' => $currentFolderId, 'name' => $currentFolderName];
                }
            }
        }
    } catch (Throwable $e) {
        $errorMsg = 'api_error';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Pengiriman Sertifikat — PT PANANJUNG ANUGRAH SOLUTION</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #0284c7;
            --primary-dark: #0369a1;
            --primary-light: #e0f2fe;
            --accent-gold: #f7941d;
            --bg-page: #f8fafc;
            --card-bg: #ffffff;
            --border-color: #e2e8f0;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --radius-lg: 16px;
            --radius-md: 12px;
            --shadow-sm: 0 2px 8px rgba(0,0,0,0.04);
            --shadow-md: 0 8px 24px rgba(0,0,0,0.06);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-page);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── NAVBAR ── */
        .portal-navbar {
            background: #ffffff;
            border-bottom: 1px solid var(--border-color);
            padding: 0.75rem 0;
            position: sticky;
            top: 0;
            z-index: 1020;
            box-shadow: var(--shadow-sm);
        }

        .brand-logo {
            height: 40px;
            object-fit: contain;
        }

        .user-chip {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 50px;
            padding: 5px 14px 5px 8px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
        }

        .user-chip .avatar-circle {
            width: 28px;
            height: 28px;
            background: #16a34a;
            color: #ffffff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.75rem;
        }

        /* ── HERO BANNER ── */
        .hero-banner {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 50%, #075985 100%);
            border-radius: var(--radius-lg);
            padding: 2.25rem 2rem;
            margin-bottom: 1.5rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 16px 40px rgba(2, 132, 199, 0.22);
        }

        .hero-banner::before {
            content: '';
            position: absolute;
            top: -40%;
            right: -25%;
            width: 380px;
            height: 380px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.2) 0%, transparent 70%);
            border-radius: 50%;
        }

        .hero-badge {
            background: rgba(255, 255, 255, 0.22);
            border: 1px solid rgba(255, 255, 255, 0.4);
            color: #ffffff;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 30px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 0.75rem;
            backdrop-filter: blur(8px);
        }

        .hero-title {
            color: #ffffff;
            font-weight: 800;
            font-size: 1.6rem;
            letter-spacing: -0.5px;
            margin-bottom: 0.35rem;
        }

        .hero-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.9rem;
            margin-bottom: 1.25rem;
            line-height: 1.5;
            max-width: 720px;
        }

        /* ── SEARCH BOX ── */
        .search-input-wrapper {
            position: relative;
            display: flex;
            background: rgba(255,255,255,0.22);
            border: 1px solid rgba(255,255,255,0.4);
            border-radius: 14px;
            overflow: hidden;
            backdrop-filter: blur(10px);
            transition: all 0.25s ease;
        }

        .search-input-wrapper:focus-within {
            background: rgba(255,255,255,0.28);
            border-color: #ffffff;
            box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.25);
        }

        .search-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255,255,255,0.8);
            font-size: 1.1rem;
            pointer-events: none;
            z-index: 2;
        }

        .search-input {
            width: 100%;
            padding: 13px 16px 13px 48px;
            background: transparent;
            border: none;
            color: #ffffff;
            font-size: 0.95rem;
            font-family: inherit;
            outline: none;
        }

        .search-input::placeholder {
            color: rgba(255,255,255,0.6);
        }

        .search-btn {
            background: linear-gradient(135deg, var(--accent-gold), #ea580c);
            color: #ffffff;
            border: none;
            padding: 0 24px;
            font-weight: 700;
            font-size: 0.9rem;
            font-family: inherit;
            cursor: pointer;
            transition: all 0.25s ease;
            display: flex;
            align-items: center;
            gap: 6px;
            flex-shrink: 0;
        }

        .search-btn:hover {
            opacity: 0.95;
            box-shadow: 0 4px 15px rgba(247, 148, 29, 0.4);
        }

        /* ── BREADCRUMB ── */
        .breadcrumb-custom {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 0.75rem 1.25rem;
            margin-bottom: 1.25rem;
            font-size: 0.85rem;
        }

        /* ── FILE CARD ── */
        .file-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .file-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 1rem 1.25rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            transition: all 0.2s ease;
            box-shadow: var(--shadow-sm);
        }

        .file-card:hover {
            border-color: #93c5fd;
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(2, 132, 199, 0.08);
        }

        .file-card.selected {
            background-color: #f0f9ff;
            border-color: #38bdf8;
            box-shadow: 0 6px 20px rgba(2, 132, 199, 0.14);
        }

        /* ── MULTI-SELECT & BATCH STYLES ── */
        .batch-toolbar {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 0.85rem 1.25rem;
            margin-bottom: 0.85rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            box-shadow: var(--shadow-sm);
        }

        .batch-checkbox-wrap {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            user-select: none;
        }

        .cert-check-box {
            width: 22px;
            height: 22px;
            border-radius: 6px;
            border: 2px solid #94a3b8;
            cursor: pointer;
            transition: all 0.2s ease;
            flex-shrink: 0;
            accent-color: var(--primary-pas);
        }

        .cert-check-box:checked {
            border-color: var(--primary-pas);
        }

        /* Floating Bottom Batch Bar */
        .floating-batch-bar {
            position: fixed;
            bottom: 24px;
            left: 50%;
            transform: translateX(-50%) translateY(120px);
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: #ffffff;
            border-radius: 50px;
            padding: 10px 16px 10px 22px;
            display: flex;
            align-items: center;
            gap: 18px;
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.15);
            z-index: 1050;
            transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.3s ease;
            opacity: 0;
            pointer-events: none;
            max-width: 92vw;
        }

        .floating-batch-bar.show {
            transform: translateX(-50%) translateY(0);
            opacity: 1;
            pointer-events: auto;
        }

        .floating-batch-counter {
            background: linear-gradient(135deg, var(--accent-gold), #ea580c);
            color: #ffffff;
            font-weight: 800;
            font-size: 0.82rem;
            padding: 3px 12px;
            border-radius: 20px;
            display: inline-block;
            box-shadow: 0 2px 8px rgba(247, 148, 29, 0.4);
        }

        /* Modal Selected Files List Container */
        .selected-files-container {
            max-height: 190px;
            overflow-y: auto;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            background: #f8fafc;
            padding: 8px;
        }

        .selected-file-chip {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 8px 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 6px;
            transition: all 0.2s ease;
        }

        .selected-file-chip:last-child {
            margin-bottom: 0;
        }

        .selected-file-chip:hover {
            border-color: #cbd5e1;
            background: #f1f5f9;
        }

        .selected-file-remove {
            color: #94a3b8;
            cursor: pointer;
            border: none;
            background: transparent;
            padding: 2px 6px;
            border-radius: 6px;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .selected-file-remove:hover {
            color: #ef4444;
            background: #fee2e2;
        }

        .icon-box {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
            flex-shrink: 0;
        }

        .icon-box.folder { background: #fef3c7; color: #d97706; }
        .icon-box.pdf { background: #fee2e2; color: #dc2626; }
        .icon-box.excel { background: #dcfce7; color: #15803d; }
        .icon-box.doc { background: #e0e7ff; color: #4338ca; }
        .icon-box.image { background: #fce7f3; color: #db2777; }
        .icon-box.generic { background: #f1f5f9; color: #64748b; }

        .file-title {
            font-weight: 700;
            font-size: 0.95rem;
            color: var(--text-dark);
            margin-bottom: 2px;
            word-break: break-all;
        }

        .file-meta {
            font-size: 0.78rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        /* ── LOGIN CARD ── */
        .login-card {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border-color);
            padding: 3.5rem 2rem;
            text-align: center;
            box-shadow: var(--shadow-md);
            max-width: 480px;
            margin: 40px auto;
        }

        .login-icon-circle {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #e0f2fe, #bae6fd);
            color: #0284c7;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto 1.5rem auto;
            box-shadow: 0 8px 25px rgba(2, 132, 199, 0.15);
        }

        .otp-display-box {
            background: #f0fdf4;
            border: 2px dashed #16a34a;
            border-radius: 12px;
            padding: 12px;
            margin: 15px 0;
            color: #15803d;
            font-size: 0.85rem;
        }

        /* ── STATS ROW ── */
        .stat-badge {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 30px;
            padding: 5px 14px;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--text-dark);
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .stat-badge .count {
            background: #e0f2fe;
            color: #0284c7;
            padding: 1px 7px;
            border-radius: 20px;
            font-size: 0.72rem;
        }

        .portal-footer {
            background: var(--card-bg);
            border-top: 1px solid var(--border-color);
            padding: 1rem;
            text-align: center;
            font-size: 0.78rem;
            color: var(--text-muted);
            margin-top: auto;
        }

        /* Loading Spinner Overlay */
        .loading-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(255,255,255,0.85);
            backdrop-filter: blur(6px);
            z-index: 9999;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 15px;
        }

        .loading-overlay.active {
            display: flex;
        }

        /* Responsive & Sticky Modal Fix */
        .modal-dialog-scrollable {
            max-height: calc(100vh - 1.5rem);
        }
        .modal-dialog-scrollable .modal-content {
            max-height: calc(100vh - 2rem);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            border-radius: 16px !important;
        }
        .modal-dialog-scrollable .modal-body {
            overflow-y: auto !important;
            -webkit-overflow-scrolling: touch;
            flex: 1 1 auto;
            max-height: calc(100vh - 210px);
        }
        .modal-header-sticky {
            position: sticky;
            top: 0;
            z-index: 1020;
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0 !important;
            flex-shrink: 0;
        }
        .modal-footer-sticky {
            position: sticky;
            bottom: 0;
            z-index: 1020;
            background: #ffffff;
            border-top: 1px solid #e2e8f0 !important;
            box-shadow: 0 -4px 16px rgba(0, 0, 0, 0.05);
            flex-shrink: 0;
        }
        @media (max-width: 767.98px) {
            .modal-dialog {
                margin: 0.5rem;
            }
            .modal-footer-sticky {
                flex-direction: column-reverse;
                gap: 8px;
            }
            .modal-footer-sticky .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <!-- LOADING OVERLAY -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status"></div>
        <div class="fw-bold text-dark small" id="loadingText">Memproses data...</div>
    </div>

    <!-- NAVBAR -->
    <nav class="portal-navbar">
        <div class="container-fluid px-4 d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <a href="<?php echo htmlspecialchars($pageUrl); ?>" class="text-decoration-none">
                    <img src="https://www.pascalibration.com/wp-content/uploads/2023/09/logo_pas_basic.png" alt="PAS Logo" class="brand-logo">
                </a>
                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1 rounded-pill small fw-bold">
                    <i class="fas fa-bullhorn me-1"></i> Portal Khusus Marketing
                </span>
            </div>

            <div class="d-flex align-items-center gap-2">
                <?php if ($isLoggedIn): ?>
                    <div class="user-chip shadow-sm">
                        <div class="avatar-circle">
                            <?php echo strtoupper(substr($marketingName ?: $marketingEmail, 0, 1)); ?>
                        </div>
                        <div class="d-none d-sm-block text-start leading-tight">
                            <div class="fw-bold text-dark small"><?php echo htmlspecialchars($marketingName); ?></div>
                            <div class="text-muted" style="font-size: 0.7rem;"><?php echo htmlspecialchars($marketingEmail); ?></div>
                        </div>
                    </div>
                    <a href="?logout=1" class="btn btn-outline-danger btn-sm rounded-pill px-3" onclick="return confirm('Keluar dari portal pengiriman marketing?');">
                        <i class="fas fa-sign-out-alt me-1"></i> Logout
                    </a>
                <?php else: ?>
                    <a href="cariSertifikat.php" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                        <i class="fas fa-search me-1"></i> Portal Cari Sertifikat
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- CONTENT WRAPPER -->
    <div class="container px-3 px-md-4 py-4" style="max-width: 1040px;">

        <?php if (!$isLoggedIn): ?>
            <!-- =============================================================== -->
            <!-- LOGIN KHUSUS MARKETING: EMAIL PERUSAHAAN (OTP)                  -->
            <!-- (TIDAK ADA LOGIN GOOGLE SESUAI PERMINTAAN)                      -->
            <!-- =============================================================== -->
            <div class="login-card">
                <div class="login-icon-circle">
                    <i class="fas fa-paper-plane"></i>
                </div>
                <h4 class="fw-bold text-dark mb-1">Masuk Portal Marketing</h4>
                <p class="text-muted small mb-4" style="line-height: 1.5;">
                    Pengiriman Berkas Sertifikat Digital Resmi ke Pelanggan PT Pananjung Anugrah Solution.
                </p>

                <!-- STEP 1: FORM INPUT EMAIL MARKETING -->
                <div id="otpStepEmail">
                    <div class="mb-3 text-start">
                        <label class="form-label small fw-bold text-secondary">Alamat Email Marketing Anda *</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="far fa-envelope text-muted"></i></span>
                            <input type="email" id="inputMarketingEmail" class="form-control border-start-0" placeholder="nama@pascalibration.com" autocomplete="email" autofocus>
                        </div>
                    </div>
                    <button type="button" id="btnRequestOtp" class="btn btn-primary w-100 py-2 rounded-pill fw-semibold shadow-sm" onclick="sendMarketingOtpRequest()">
                        <i class="fas fa-paper-plane me-1"></i> Kirim Kode OTP Masuk
                    </button>
                </div>

                <!-- STEP 2: FORM INPUT KODE OTP MARKETING (Hidden Awalnya) -->
                <div id="otpStepCode" style="display: none;">
                    <div class="alert alert-success py-2 px-3 small rounded-3 mb-3 text-start" id="otpSentAlert">
                        
                    </div>
                    <div class="mb-3 text-start">
                        <label class="form-label small fw-bold text-secondary">Masukkan 6 Digit Kode OTP *</label>
                        <input type="text" id="inputMarketingOtp" class="form-control text-center font-monospace fs-4 fw-bold letter-spacing-2" placeholder="------" maxlength="6" autocomplete="one-time-code" onkeydown="if(event.key==='Enter') verifyMarketingOtp();">
                        <div class="form-text" style="font-size: 0.72rem;">*Periksa folder Kotak Masuk atau Spam email perusahaan Anda.</div>
                    </div>
                    <button type="button" id="btnVerifyOtp" class="btn btn-success w-100 py-2 rounded-pill fw-semibold shadow-sm mb-2" onclick="verifyMarketingOtp()">
                        <i class="fas fa-sign-in-alt me-1"></i> Verifikasi & Masuk Portal
                    </button>
                    <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top">
                        <button type="button" class="btn btn-link btn-sm text-secondary text-decoration-none p-0" onclick="resetMarketingOtpStep()">
                            <i class="fas fa-arrow-left me-1"></i> Ganti Email
                        </button>
                        <button type="button" class="btn btn-link btn-sm text-primary text-decoration-none p-0 fw-semibold" onclick="resendMarketingOtp()">
                            <i class="fas fa-redo me-1"></i> Kirim Ulang OTP
                        </button>
                    </div>
                </div>
                <!-- FEEDBACK MESSAGE -->
                <div id="otpFeedback" class="mt-3 small" style="display: none;"></div>
            </div>

        <?php else: ?>
            <!-- =============================================================== -->
            <!-- DASHBOARD MARKETING: BROWSE & KIRIM SERTIFIKAT KE CUSTOMER      -->
            <!-- =============================================================== -->

            <!-- HERO SEARCH SECTION -->
            <div class="hero-banner">
                <div class="hero-badge">
                    <i class="fas fa-bullhorn"></i> Portal Tim Marketing
                </div>
                <h1 class="hero-title">Kirim Sertifikat Digital ke Klien</h1>
                <p class="hero-subtitle">
                    Cari berdasarkan nomor sertifikat, kode alat (PAS-XXXXX), atau nama PT klien. Anda dapat menelusuri berkas, melihat pratinjau, dan mengirimkannya langsung ke email pelanggan dengan lampiran PDF.
                </p>

                <form method="GET" action="<?php echo htmlspecialchars($pageUrl); ?>" class="search-box" id="searchForm">
                    <?php if (!empty($currentFolderId)): ?>
                        <input type="hidden" name="folder_id" value="<?php echo htmlspecialchars($currentFolderId); ?>">
                    <?php endif; ?>
                    <div class="search-input-wrapper">
                        <i class="fas fa-search search-icon"></i>
                        <input 
                            type="text" 
                            name="search" 
                            class="search-input" 
                            placeholder="Ketik nomor sertifikat, kode alat (PAS-...), nama file, atau nama PT klien..." 
                            value="<?php echo htmlspecialchars($searchQuery); ?>"
                            autocomplete="off"
                            id="searchInput"
                        >
                        <button type="submit" class="search-btn" onclick="showLoading('Mencari berkas sertifikat...')">
                            <i class="fas fa-search me-1"></i> Cari
                        </button>
                    </div>
                </form>
            </div>

            <!-- BREADCRUMB NAVIGATION -->
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 bg-white px-3 py-2 rounded-pill border shadow-sm small">
                        <li class="breadcrumb-item">
                            <a href="<?php echo htmlspecialchars($pageUrl); ?>" class="text-decoration-none text-primary fw-bold">
                                <i class="fas fa-home me-1"></i> Beranda
                            </a>
                        </li>
                        <?php if (!empty($currentFolderId) && $currentFolderId !== $rootFolderId): ?>
                            <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">
                                <i class="fas fa-folder-open text-warning me-1"></i> <?php echo htmlspecialchars($currentFolderName); ?>
                            </li>
                        <?php endif; ?>
                        <?php if ($isSearchMode): ?>
                            <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">
                                <i class="fas fa-search text-primary me-1"></i> Hasil: "<?php echo htmlspecialchars($searchQuery); ?>"
                            </li>
                        <?php endif; ?>
                    </ol>
                </nav>

                <?php if ($isSearchMode || (!empty($currentFolderId) && $currentFolderId !== $rootFolderId)): ?>
                    <a href="<?php echo htmlspecialchars($pageUrl); ?>" class="btn btn-outline-secondary btn-sm rounded-pill px-3 shadow-sm">
                        <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
                    </a>
                <?php endif; ?>
            </div>

            <!-- STATS ROW -->
            <?php 
                $folderCount = 0;
                $fileCount = 0;
                foreach ($filesFound as $f) {
                    if ($f['mimeType'] === 'application/vnd.google-apps.folder') {
                        $folderCount++;
                    } else {
                        $fileCount++;
                    }
                }
            ?>
            <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
                <div class="d-flex gap-2">
                    <?php if ($folderCount > 0): ?>
                        <div class="stat-badge">
                            <i class="fas fa-folder text-warning"></i> Folder
                            <span class="count"><?php echo $folderCount; ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if ($fileCount > 0): ?>
                        <div class="stat-badge">
                            <i class="far fa-file-pdf text-primary"></i> Berkas Sertifikat
                            <span class="count"><?php echo $fileCount; ?></span>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="small text-muted">
                    <i class="fas fa-shield-alt text-success me-1"></i> Login: <strong><?php echo htmlspecialchars($marketingName); ?></strong> (<?php echo htmlspecialchars($marketingDivisi); ?>)
                </div>
            </div>

            <!-- EMPTY STATE -->
            <?php if (empty($filesFound)): ?>
                <div class="card border-0 shadow-sm rounded-4 p-5 text-center my-4 bg-white">
                    <div class="mb-3 text-secondary opacity-50"><i class="fas fa-folder-open fs-1"></i></div>
                    <?php if ($isSearchMode): ?>
                        <h5 class="fw-bold text-dark">Berkas Tidak Ditemukan</h5>
                        <p class="text-muted small mb-3">
                            Tidak ditemukan sertifikat atau folder yang cocok dengan kata kunci "<strong><?php echo htmlspecialchars($searchQuery); ?></strong>".
                        </p>
                    <?php else: ?>
                        <h5 class="fw-bold text-dark">Folder Ini Kosong</h5>
                        <p class="text-muted small mb-3">Belum ada berkas atau subfolder sertifikat di dalam direktori ini.</p>
                    <?php endif; ?>
                    <div>
                        <a href="<?php echo htmlspecialchars($pageUrl); ?>" class="btn btn-primary rounded-pill px-4 btn-sm">
                            <i class="fas fa-home me-1"></i> Kembali ke Beranda
                        </a>
                    </div>
                </div>

            <?php else: ?>
                <!-- BATCH MULTI-SELECT TOOLBAR (HANYA MUNCUL JIKA ADA BERKAS SERTIFIKAT) -->
                <?php if ($fileCount > 0): ?>
                    <div class="batch-toolbar">
                        <label class="batch-checkbox-wrap m-0">
                            <input type="checkbox" class="form-check-input cert-check-box" id="selectAllCheckbox" onchange="toggleSelectAll(this.checked)">
                            <span class="fw-bold small text-dark">Pilih Semua (<?php echo $fileCount; ?> Berkas)</span>
                        </label>
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-light text-secondary border small fw-normal py-2 px-3 rounded-pill" id="selectedCounterBadge">0 berkas dipilih</span>
                            <button type="button" class="btn btn-primary btn-sm rounded-pill px-3 fw-bold" id="btnBatchSendTop" onclick="openBatchSendModal()" disabled>
                                <i class="fas fa-paper-plane me-1"></i> Kirim Terpilih
                            </button>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- DAFTAR FOLDER & BERKAS SERTIFIKAT -->
                <div class="file-list mb-5">
                    <?php foreach ($filesFound as $file): ?>
                        <?php 
                            $isFolder = ($file['mimeType'] === 'application/vnd.google-apps.folder');
                            list($iconClass, $iconType) = getFileIcon($file['mimeType']);
                            $sizeTxt = formatFileSize($file['size'] ?? 0);
                            $dateTxt = formatDate($file['modifiedTime'] ?? '');
                        ?>

                        <?php if ($isFolder): ?>
                            <!-- ITEM FOLDER: KLIK UNTUK MASUK -->
                            <a href="<?php echo $pageUrl . '?' . http_build_query(['folder_id' => $file['id']]); ?>" class="text-decoration-none" onclick="showLoading('Membuka folder...')">
                                <div class="file-card">
                                    <div class="d-flex align-items-center gap-3" style="min-width: 0; flex: 1;">
                                        <div class="icon-box folder">
                                            <i class="fas fa-folder"></i>
                                        </div>
                                        <div style="min-width: 0; flex: 1;">
                                            <div class="file-title"><?php echo htmlspecialchars($file['name']); ?></div>
                                            <div class="file-meta">
                                                <span><i class="fas fa-folder-open text-warning me-1"></i> Folder Perusahaan / Sertifikat</span>
                                                <?php if ($dateTxt): ?><span>• <?php echo $dateTxt; ?></span><?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center text-primary fw-semibold small">
                                        <span>Buka Folder</span>
                                        <i class="fas fa-chevron-right ms-2"></i>
                                    </div>
                                </div>
                            </a>

                        <?php else: ?>
                            <!-- ITEM FILE SERTIFIKAT: ADA CHECKBOX BATCH, TOMBOL PREVIEW & KIRIM EMAIL -->
                            <?php 
                                $previewUrl = $paperlessUrl . "?" . http_build_query([
                                    'file_id' => $file['id'],
                                    'cert_id' => preg_match('/(PAS-\d+)/i', $file['name'], $m) ? strtoupper($m[1]) : pathinfo($file['name'], PATHINFO_FILENAME)
                                ]);
                            ?>
                            <div class="file-card cert-card-item" id="fileCard_<?php echo htmlspecialchars($file['id']); ?>">
                                <div class="d-flex align-items-center gap-3" style="min-width: 0; flex: 1;">
                                    <!-- CHECKBOX BATCH SELECTION -->
                                    <div class="d-flex align-items-center">
                                        <input 
                                            type="checkbox" 
                                            class="form-check-input cert-check-box cert-item-checkbox" 
                                            id="chk_<?php echo htmlspecialchars($file['id']); ?>"
                                            data-id="<?php echo htmlspecialchars($file['id'], ENT_QUOTES); ?>"
                                            data-name="<?php echo htmlspecialchars($file['name'], ENT_QUOTES); ?>"
                                            data-size="<?php echo htmlspecialchars($sizeTxt, ENT_QUOTES); ?>"
                                            onchange="onCertItemCheckboxChange(this)"
                                        >
                                    </div>

                                    <div class="icon-box <?php echo $iconType; ?>">
                                        <i class="<?php echo $iconClass; ?>"></i>
                                    </div>
                                    <div style="min-width: 0; flex: 1;">
                                        <div class="file-title"><?php echo htmlspecialchars($file['name']); ?></div>
                                        <div class="file-meta">
                                            <span class="badge bg-light text-secondary border font-monospace py-1 px-2">
                                                <i class="fas fa-shield-alt text-success me-1"></i> Sertifikat Digital
                                            </span>
                                            <?php if ($sizeTxt): ?><span><i class="fas fa-weight-hanging me-1"></i><?php echo $sizeTxt; ?></span><?php endif; ?>
                                            <?php if ($dateTxt): ?><span><i class="far fa-clock me-1"></i><?php echo $dateTxt; ?></span><?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center gap-2 flex-shrink-0">
                                    <!-- TOMBOL PREVIEW / LIHAT -->
                                    <a href="<?php echo htmlspecialchars($previewUrl); ?>" target="_blank" class="btn btn-outline-secondary btn-sm rounded-pill px-3 shadow-sm" title="Pratinjau Sertifikat">
                                        <i class="fas fa-eye me-1"></i> Lihat
                                    </a>

                                    <!-- TOMBOL KIRIM EMAIL KE CUSTOMER -->
                                    <button 
                                        type="button" 
                                        class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm fw-bold"
                                        onclick="openSendCertModal('<?php echo htmlspecialchars($file['id'], ENT_QUOTES); ?>', '<?php echo htmlspecialchars($file['name'], ENT_QUOTES); ?>', '<?php echo htmlspecialchars($sizeTxt, ENT_QUOTES); ?>')"
                                    >
                                        <i class="fas fa-paper-plane me-1"></i> Kirim ke Klien
                                    </button>
                                </div>
                            </div>

                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        <?php endif; ?>

        <!-- FLOATING BATCH ACTION BAR (STICKY BOTTOM SAAT ADA BERKAS DIPILIH) -->
        <div class="floating-batch-bar" id="floatingBatchBar">
            <div class="d-flex align-items-center gap-2">
                <span class="floating-batch-counter" id="floatingCount">0</span>
                <span class="small fw-semibold text-white">Berkas Sertifikat Dipilih</span>
            </div>
            <div class="d-flex align-items-center gap-2 ms-auto">
                <button type="button" class="btn btn-sm btn-outline-light rounded-pill px-3" onclick="clearAllSelections()">
                    <i class="fas fa-times me-1"></i> Batal
                </button>
                <button type="button" class="btn btn-sm btn-warning rounded-pill px-4 fw-bold shadow-sm text-dark" onclick="openBatchSendModal()">
                    <i class="fas fa-paper-plane me-1"></i> Kirim ke Klien Sekarang
                </button>
            </div>
        </div>

    </div>

    <!-- =================================================================== -->
    <!-- MODAL KIRIM EMAIL SERTIFIKAT KE CUSTOMER                            -->
    <!-- =================================================================== -->
    <div class="modal fade" id="modalSendCert" tabindex="-1" aria-labelledby="modalSendCertLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content rounded-4 border-0 shadow-lg">
                <div class="modal-header modal-header-sticky px-4 py-3 border-bottom">
                    <div>
                        <h5 class="modal-title fw-bold text-dark mb-0" id="modalSendCertLabel">
                            <i class="fas fa-paper-plane text-primary me-2"></i>Kirim Sertifikat ke Email Pelanggan
                        </h5>
                        <small class="text-muted" style="font-size: 0.78rem;">Berkas sertifikat resmi akan dikirimkan langsung ke email pelanggan.</small>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-4">
                    <!-- INFORMASI DAFTAR BERKAS SERTIFIKAT (SINGLE / MULTI-FILE) -->
                    <div class="mb-4">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <label class="form-label small fw-bold text-dark mb-0">
                                <i class="fas fa-file-contract text-primary me-1"></i> Berkas Sertifikat yang Akan Dikirim (<span id="modalCertCount">0</span> Berkas):
                            </label>
                            <span class="badge bg-light text-secondary border small" id="modalCertTotalHint">Lampiran Resmi PAS</span>
                        </div>
                        <div class="selected-files-container" id="modalSelectedFilesList">
                            <!-- Items rendered dynamically by JS -->
                        </div>
                    </div>

                    <form id="formSendCert" onsubmit="event.preventDefault(); submitSendCertificate();">
                        <input type="hidden" id="sendCertFileIdsJson">

                        <!-- PRESET DROPDOWN KLIEN TERDAFTAR (MEMUDAHKAN MARKETING) -->
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary">
                                <i class="fas fa-users text-primary me-1"></i> Pilih dari Klien Terdaftar (Otomatis Isi)
                            </label>
                            <select id="selectClientPreset" class="form-select rounded-3" onchange="applyClientPreset(this.value)">
                                <option value="">-- Ketik manual atau pilih pelanggan yang sudah terdaftar --</option>
                                <?php foreach ($allClientsList as $cl): ?>
                                    <option 
                                        value="<?php echo htmlspecialchars($cl['email'], ENT_QUOTES); ?>"
                                        data-nama="<?php echo htmlspecialchars($cl['nama'], ENT_QUOTES); ?>"
                                        data-perusahaan="<?php echo htmlspecialchars($cl['perusahaan'], ENT_QUOTES); ?>"
                                    >
                                        <?php echo htmlspecialchars($cl['perusahaan']); ?> — <?php echo htmlspecialchars($cl['nama']); ?> (<?php echo htmlspecialchars($cl['email']); ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- INFO IDENTITAS PENGIRIM (MARKETING LOGIN) -->
                        <div class="p-2 px-3 mb-3 bg-light rounded-3 border d-flex align-items-center justify-content-between flex-wrap gap-2">
                            <div class="small text-secondary">
                                <i class="fas fa-paper-plane text-primary me-1"></i> Pengirim Email:
                                <strong class="text-dark"><?php echo htmlspecialchars($marketingName ?: 'Marketing PAS'); ?></strong> 
                                (<span class="text-primary font-monospace fw-semibold"><?php echo htmlspecialchars($marketingEmail); ?></span>)
                            </div>
                            <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill small">
                                <i class="fas fa-check-circle me-1"></i> Mengirim via Akun Marketing
                            </span>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-dark">Alamat Email Pelanggan *</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="far fa-envelope text-muted"></i></span>
                                    <input type="email" id="sendClientEmail" class="form-control" placeholder="contoh: customer@perusahaan.com" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-dark">Nama PIC / Kontak Pelanggan</label>
                                <input type="text" id="sendClientName" class="form-control" placeholder="Contoh: Bapak Budi Hartono">
                            </div>

                            <div class="col-12">
                                <label class="form-label small fw-bold text-dark">Nama Perusahaan Pelanggan</label>
                                <input type="text" id="sendClientCompany" class="form-control" placeholder="Contoh: PT Indofood CBP Sukses Makmur Tbk">
                            </div>

                            <div class="col-12">
                                <label class="form-label small fw-bold text-dark">Subjek Email *</label>
                                <input type="text" id="sendEmailSubject" class="form-control" required>
                            </div>

                            <div class="col-12">
                                <label class="form-label small fw-bold text-dark">Pesan Tambahan / Catatan Khusus (Opsional)</label>
                                <textarea id="sendCustomNotes" class="form-control" rows="3" placeholder="Contoh: Bersama ini kami kirimkan sertifikat kalibrasi Pressure Gauge untuk penawaran PO No. 1234. Terima kasih..."></textarea>
                            </div>

                            <div class="col-12">
                                <div class="form-check form-switch p-0 d-flex align-items-center gap-3">
                                    <input class="form-check-input ms-0 mt-0" type="checkbox" id="checkAttachPdf" checked style="width: 2.25rem; height: 1.25rem;">
                                    <label class="form-check-label small fw-bold text-dark" for="checkAttachPdf">
                                        <i class="fas fa-paperclip text-primary me-1"></i> Lampirkan file PDF langsung ke dalam email (Offline Attachment)
                                    </label>
                                </div>
                                <div class="form-text small" style="font-size: 0.72rem;">
                                    Selain tombol pratinjau Paperless online, pelanggan juga akan menerima berkas PDF yang dapat diunduh langsung dari inbox email.
                                </div>
                            </div>
                        </div>

                        <!-- FEEDBACK AREA -->
                        <div id="sendCertFeedback" class="mt-3 small" style="display: none;"></div>

                        <div class="modal-footer modal-footer-sticky px-4 py-3 mt-4 d-flex justify-content-between">
                            <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" id="btnSubmitSendCert" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
                                <i class="fas fa-paper-plane me-1"></i> Kirim Email Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="portal-footer">
        &copy; <?php echo date('Y'); ?> <strong>PT PANANJUNG ANUGRAH SOLUTION</strong>. Smart Paperless Calibration System.
    </footer>

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const pageUrl = <?php echo json_encode($pageUrl); ?>;
        let currentMarketingOtpEmail = '';

        function showLoading(msg = 'Memproses data...') {
            document.getElementById('loadingText').textContent = msg;
            document.getElementById('loadingOverlay').classList.add('active');
        }

        function hideLoading() {
            document.getElementById('loadingOverlay').classList.remove('active');
        }

        // =====================================================================
        // AUTH MARKETING OTP LOGIC
        // =====================================================================
        function showOtpFeedback(msg, isSuccess = false) {
            const fb = document.getElementById('otpFeedback');
            if (!fb) return;
            fb.style.display = 'block';
            fb.className = 'mt-3 small ' + (isSuccess ? 'text-success fw-semibold' : 'text-danger fw-semibold');
            fb.innerHTML = (isSuccess ? '<i class="fas fa-check-circle me-1"></i> ' : '<i class="fas fa-exclamation-circle me-1"></i> ') + msg;
        }

        function clearOtpFeedback() {
            const fb = document.getElementById('otpFeedback');
            if (fb) fb.style.display = 'none';
        }

        function sendMarketingOtpRequest() {
            const emailInput = document.getElementById('inputMarketingEmail');
            const btn = document.getElementById('btnRequestOtp');
            if (!emailInput || !btn) return;

            const email = emailInput.value.trim();
            if (!email) {
                showOtpFeedback('Silakan ketik alamat email marketing Anda.');
                return;
            }

            clearOtpFeedback();
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Mengirim OTP...';

            const fd = new FormData();
            fd.append('email', email);

            fetch(pageUrl + '?action=send_marketing_otp', {
                method: 'POST',
                body: fd
            })
            .then(r => r.json())
            .then(res => {
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-paper-plane me-1"></i> Kirim Kode OTP Masuk';

                if (res.success) {
                    currentMarketingOtpEmail = email;
                    const displayEmailEl = document.getElementById('displayTargetEmail');
                    if (displayEmailEl) {
                        displayEmailEl.textContent = email;
                    }
                    const stepEmailEl = document.getElementById('otpStepEmail');
                    if (stepEmailEl) stepEmailEl.style.display = 'none';
                    const stepCodeEl = document.getElementById('otpStepCode');
                    if (stepCodeEl) stepCodeEl.style.display = 'block';

                    showOtpFeedback(res.message, true);

                    const otpInput = document.getElementById('inputMarketingOtp');
                    if (otpInput) {
                        otpInput.value = '';
                        otpInput.focus();
                    }
                } else {
                    showOtpFeedback(res.message || 'Gagal mengirim kode OTP.');
                }
            })
            .catch(err => {
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-paper-plane me-1"></i> Kirim Kode OTP Masuk';
                showOtpFeedback('Terjadi kendala jaringan: ' + err.message);
            });
        }

        function verifyMarketingOtp() {
            const otpInput = document.getElementById('inputMarketingOtp');
            const btn = document.getElementById('btnVerifyOtp');
            if (!otpInput || !btn) return;

            const otp = otpInput.value.trim();
            if (!otp || otp.length < 6) {
                showOtpFeedback('Masukkan 6 digit kode OTP yang telah dikirim ke email.');
                return;
            }

            clearOtpFeedback();
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Memverifikasi...';

            const fd = new FormData();
            fd.append('email', currentMarketingOtpEmail);
            fd.append('otp', otp);

            fetch(pageUrl + '?action=verify_marketing_otp', {
                method: 'POST',
                body: fd
            })
            .then(r => r.json())
            .then(res => {
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-sign-in-alt me-1"></i> Verifikasi & Masuk Portal';

                if (res.success) {
                    showOtpFeedback('Verifikasi berhasil! Mengalihkan...', true);
                    showLoading('Memuat portal marketing...');
                    window.location.href = res.redirect || pageUrl;
                } else {
                    showOtpFeedback(res.message || 'Kode OTP tidak valid.');
                }
            })
            .catch(err => {
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-sign-in-alt me-1"></i> Verifikasi & Masuk Portal';
                showOtpFeedback('Terjadi kendala jaringan: ' + err.message);
            });
        }

        function resetMarketingOtpStep() {
            clearOtpFeedback();
            const stepCodeEl = document.getElementById('otpStepCode');
            const stepEmailEl = document.getElementById('otpStepEmail');
            if (stepCodeEl) stepCodeEl.style.display = 'none';
            if (stepEmailEl) stepEmailEl.style.display = 'block';
        }

        function resendMarketingOtp() {
            if (!currentMarketingOtpEmail) return;
            clearOtpFeedback();
            showOtpFeedback('Mengirim ulang kode OTP...', true);

            const fd = new FormData();
            fd.append('email', currentMarketingOtpEmail);

            fetch(pageUrl + '?action=send_marketing_otp', {
                method: 'POST',
                body: fd
            })
            .then(r => r.json())
            .then(res => {
                if (res.success) {
                    showOtpFeedback('Kode OTP baru telah dikirimkan ke ' + currentMarketingOtpEmail, true);
                } else {
                    showOtpFeedback(res.message);
                }
            })
            .catch(err => {
                showOtpFeedback('Gagal mengirim ulang: ' + err.message);
            });
        }

        // =====================================================================
        // MULTI-SELECT & BATCH SERTIFIKAT LOGIC
        // =====================================================================
        const selectedFiles = new Map(); // key: fileId, value: { id, name, size }

        function updateSelectionUI() {
            const count = selectedFiles.size;

            // Update badge di toolbar atas
            const counterBadge = document.getElementById('selectedCounterBadge');
            if (counterBadge) {
                counterBadge.textContent = count + ' berkas dipilih';
            }

            // Update tombol kirim terpilih di toolbar atas
            const btnBatchTop = document.getElementById('btnBatchSendTop');
            if (btnBatchTop) {
                btnBatchTop.disabled = (count === 0);
            }

            // Update floating action bar di bawah
            const floatingBar = document.getElementById('floatingBatchBar');
            const floatingCount = document.getElementById('floatingCount');
            if (floatingBar && floatingCount) {
                floatingCount.textContent = count;
                if (count > 0) {
                    floatingBar.classList.add('show');
                } else {
                    floatingBar.classList.remove('show');
                }
            }

            // Update checkbox Select All & Card Highlight
            const allItemCheckboxes = document.querySelectorAll('.cert-item-checkbox');
            let allChecked = allItemCheckboxes.length > 0;
            let someChecked = false;

            allItemCheckboxes.forEach(chk => {
                const fId = chk.getAttribute('data-id');
                const card = document.getElementById('fileCard_' + fId);
                if (chk.checked) {
                    someChecked = true;
                    if (card) card.classList.add('selected');
                } else {
                    allChecked = false;
                    if (card) card.classList.remove('selected');
                }
            });

            const selectAllChk = document.getElementById('selectAllCheckbox');
            if (selectAllChk) {
                selectAllChk.checked = (allItemCheckboxes.length > 0 && allChecked);
                selectAllChk.indeterminate = (!allChecked && someChecked);
            }
        }

        function onCertItemCheckboxChange(chk) {
            const fId = chk.getAttribute('data-id');
            const fName = chk.getAttribute('data-name');
            const fSize = chk.getAttribute('data-size') || '';

            if (chk.checked) {
                selectedFiles.set(fId, { id: fId, name: fName, size: fSize });
            } else {
                selectedFiles.delete(fId);
            }

            updateSelectionUI();
        }

        function toggleSelectAll(checked) {
            const allItemCheckboxes = document.querySelectorAll('.cert-item-checkbox');
            allItemCheckboxes.forEach(chk => {
                chk.checked = checked;
                const fId = chk.getAttribute('data-id');
                const fName = chk.getAttribute('data-name');
                const fSize = chk.getAttribute('data-size') || '';

                if (checked) {
                    selectedFiles.set(fId, { id: fId, name: fName, size: fSize });
                } else {
                    selectedFiles.delete(fId);
                }
            });

            updateSelectionUI();
        }

        function clearAllSelections() {
            selectedFiles.clear();
            const allItemCheckboxes = document.querySelectorAll('.cert-item-checkbox');
            allItemCheckboxes.forEach(chk => {
                chk.checked = false;
            });
            updateSelectionUI();
        }

        // =====================================================================
        // MODAL KIRIM EMAIL SERTIFIKAT (SINGLE / MULTI-FILE)
        // =====================================================================
        let sendCertModalInstance = null;

        function renderModalSelectedFiles() {
            const container = document.getElementById('modalSelectedFilesList');
            const countSpan = document.getElementById('modalCertCount');
            const hintSpan  = document.getElementById('modalCertTotalHint');
            if (!container) return;

            const total = selectedFiles.size;
            if (countSpan) countSpan.textContent = total;
            if (hintSpan) {
                hintSpan.textContent = total > 1 ? 'Pengiriman Kolektif (Batch)' : 'Pengiriman Berkas Tunggal';
            }

            container.innerHTML = '';
            if (total === 0) {
                container.innerHTML = '<div class="text-center text-muted small p-3">Tidak ada berkas yang dipilih.</div>';
                return;
            }

            selectedFiles.forEach((file) => {
                const chip = document.createElement('div');
                chip.className = 'selected-file-chip';
                chip.id = 'modalFileChip_' + file.id;

                chip.innerHTML = `
                    <div class="d-flex align-items-center gap-2" style="min-width: 0; flex: 1;">
                        <i class="far fa-file-pdf text-danger fs-5 flex-shrink-0"></i>
                        <div class="text-truncate" style="min-width: 0; flex: 1;">
                            <div class="fw-bold text-dark small text-truncate" title="${escapeHtml(file.name)}">${escapeHtml(file.name)}</div>
                            <div class="text-muted" style="font-size: 0.72rem;">${escapeHtml(file.size || 'PDF Kalibrasi')}</div>
                        </div>
                    </div>
                    <button type="button" class="selected-file-remove flex-shrink-0" title="Keluarkan dari daftar kirim" onclick="removeFileFromModal('${file.id}')">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                container.appendChild(chip);
            });
        }

        function removeFileFromModal(fileId) {
            selectedFiles.delete(fileId);

            // Uncheck di daftar file jika ada
            const chk = document.getElementById('chk_' + fileId);
            if (chk) chk.checked = false;

            updateSelectionUI();

            if (selectedFiles.size === 0) {
                if (sendCertModalInstance) sendCertModalInstance.hide();
            } else {
                renderModalSelectedFiles();
                updateModalSubject();
            }
        }

        function updateModalSubject() {
            const count = selectedFiles.size;
            const subjectInput = document.getElementById('sendEmailSubject');
            if (!subjectInput) return;

            if (count === 1) {
                const first = selectedFiles.values().next().value;
                let certId = first.name.replace(/\.[^/.]+$/, "");
                subjectInput.value = "Sertifikat Kalibrasi Digital: " + certId + " - PT PANANJUNG ANUGRAH SOLUTION";
            } else if (count > 1) {
                subjectInput.value = "Sertifikat Kalibrasi Digital (" + count + " Berkas) - PT PANANJUNG ANUGRAH SOLUTION";
            }
        }

        function openBatchSendModal() {
            if (selectedFiles.size === 0) {
                alert('Silakan pilih minimal satu berkas sertifikat terlebih dahulu.');
                return;
            }

            renderModalSelectedFiles();
            updateModalSubject();

            // Clear feedback
            const fb = document.getElementById('sendCertFeedback');
            if (fb) fb.style.display = 'none';

            // Reset preset dropdown
            const sel = document.getElementById('selectClientPreset');
            if (sel) sel.value = '';

            const btn = document.getElementById('btnSubmitSendCert');
            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-paper-plane me-1"></i> Kirim Email Sekarang';

            if (!sendCertModalInstance) {
                sendCertModalInstance = new bootstrap.Modal(document.getElementById('modalSendCert'));
            }
            sendCertModalInstance.show();
        }

        function openSendCertModal(fileId, fileName, fileSize) {
            // Jika diklik tombol kirim individual dari baris file,
            // atur pilihan ke 1 file tersebut lalu buka modal
            clearAllSelections();
            const chk = document.getElementById('chk_' + fileId);
            if (chk) chk.checked = true;

            selectedFiles.set(fileId, { id: fileId, name: fileName, size: fileSize || '' });
            updateSelectionUI();
            openBatchSendModal();
        }

        function applyClientPreset(selectedEmail) {
            const sel = document.getElementById('selectClientPreset');
            if (!sel || !selectedEmail) return;

            const opt = sel.options[sel.selectedIndex];
            if (!opt) return;

            document.getElementById('sendClientEmail').value = selectedEmail;
            document.getElementById('sendClientName').value = opt.getAttribute('data-nama') || '';
            document.getElementById('sendClientCompany').value = opt.getAttribute('data-perusahaan') || '';
        }

        function escapeHtml(str) {
            if (!str) return '';
            return String(str)
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }

        function submitSendCertificate() {
            const fileIds = Array.from(selectedFiles.keys());
            const email   = document.getElementById('sendClientEmail').value.trim();
            const name    = document.getElementById('sendClientName').value.trim();
            const company = document.getElementById('sendClientCompany').value.trim();
            const subject = document.getElementById('sendEmailSubject').value.trim();
            const notes   = document.getElementById('sendCustomNotes').value.trim();
            const attach  = document.getElementById('checkAttachPdf').checked ? '1' : '0';
            const btn     = document.getElementById('btnSubmitSendCert');
            const fb      = document.getElementById('sendCertFeedback');

            if (fileIds.length === 0) {
                fb.style.display = 'block';
                fb.className = 'mt-3 small text-danger fw-semibold';
                fb.innerHTML = '<i class="fas fa-exclamation-circle me-1"></i> Belum ada berkas sertifikat yang dipilih.';
                return;
            }

            if (!email) {
                fb.style.display = 'block';
                fb.className = 'mt-3 small text-danger fw-semibold';
                fb.innerHTML = '<i class="fas fa-exclamation-circle me-1"></i> Alamat email pelanggan wajib diisi.';
                return;
            }

            fb.style.display = 'block';
            fb.className = 'mt-3 small text-primary fw-semibold';
            fb.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Mengirimkan ' + fileIds.length + ' berkas sertifikat ke email pelanggan... Mohon tunggu.';

            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Mengirim...';

            const fd = new FormData();
            fd.append('file_ids', JSON.stringify(fileIds));
            fd.append('customer_email', email);
            fd.append('customer_name', name);
            fd.append('company_name', company);
            fd.append('email_subject', subject);
            fd.append('custom_notes', notes);
            fd.append('attach_pdf', attach);

            fetch(pageUrl + '?action=send_cert_email', {
                method: 'POST',
                body: fd
            })
            .then(r => r.json())
            .then(res => {
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-paper-plane me-1"></i> Kirim Email Sekarang';

                if (res.success) {
                    fb.className = 'mt-3 small text-success fw-bold p-3 bg-success bg-opacity-10 border border-success-subtle rounded-3';
                    fb.innerHTML = '<i class="fas fa-check-circle me-1"></i> ' + res.message;
                    setTimeout(() => {
                        if (sendCertModalInstance) sendCertModalInstance.hide();
                        clearAllSelections();
                    }, 2400);
                } else {
                    fb.className = 'mt-3 small text-danger fw-semibold p-2 bg-danger bg-opacity-10 border border-danger-subtle rounded-3';
                    fb.innerHTML = '<i class="fas fa-exclamation-triangle me-1"></i> ' + (res.message || 'Gagal mengirim email.');
                }
            })
            .catch(err => {
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-paper-plane me-1"></i> Kirim Email Sekarang';
                fb.className = 'mt-3 small text-danger fw-semibold';
                fb.innerHTML = '<i class="fas fa-times me-1"></i> Kesalahan jaringan: ' + err.message;
            });
        }
    </script>
</body>
</html>
