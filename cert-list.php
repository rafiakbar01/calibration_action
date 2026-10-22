<?php
// cert-list.php — Portal Daftar & Akses Sertifikat Digital
// Autentikasi: Email Kantor / Perusahaan via Kode OTP (Database pascalib_customer)
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 0);

require_once __DIR__ . '/db_customer.php';

// =========================================================================
// KREDENSIAL GOOGLE OAUTH TERPASANG
// =========================================================================
$googleClientId     = getenv('GOOGLE_CLIENT_ID') ?: ($_ENV['GOOGLE_CLIENT_ID'] ?? '');
$googleClientSecret = getenv('GOOGLE_CLIENT_SECRET') ?: ($_ENV['GOOGLE_CLIENT_SECRET'] ?? ''); 
$folderId           = '19qvHuJ0q84DARVA8uf0DLPq7Vtpv4Hwq'; 

// Deteksi Host & Redirect URI
$currentHost = $_SERVER['HTTP_HOST'] ?? 'pascalibration.com';
$redirectUri = 'https://' . $currentHost . '/cert-list.php';

$credentialsPath = __DIR__ . '/credentials.json';
$tokenPath       = __DIR__ . '/token.json';
$paperlessUrl    = 'https://paperless.pascalibration.com/sertifikat/gdrive-view';

// =========================================================================
// 1. HELPER NATIVE GDRIVE & GOOGLE OAUTH
// =========================================================================
function base64UrlEncode($data) {
    return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($data));
}

function getGDriveAccessToken($credentialsPath, $tokenPath) {
    if (file_exists($credentialsPath)) {
        $sa = json_decode(file_get_contents($credentialsPath), true);
        if ($sa && !empty($sa['private_key']) && !empty($sa['client_email'])) {
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
            curl_close($ch);

            $data = json_decode($res, true);
            if (!empty($data['access_token'])) return $data['access_token'];
        }
    }

    if (file_exists($tokenPath)) {
        $tk = json_decode(file_get_contents($tokenPath), true);
        if (!empty($tk['access_token']) && !empty($tk['expires_at']) && time() < ($tk['expires_at'] - 60)) {
            return $tk['access_token'];
        }
        if (!empty($tk['refresh_token'])) {
            $ch = curl_init('https://oauth2.googleapis.com/token');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
                'client_id'     => $googleClientId,
                'grant_type'    => 'refresh_token',
                'refresh_token' => $tk['refresh_token']
            ]));
            curl_setopt($ch, CURLOPT_TIMEOUT, 15);
            $res = curl_exec($ch);
            curl_close($ch);

            $data = json_decode($res, true);
            if (!empty($data['access_token'])) return $data['access_token'];
        }
    }

    throw new Exception("File credentials.json atau token.json tidak ditemukan.");
}

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
 * Kumpulkan semua ID folder dan subfolder di bawah daftar folder tertentu (Top-Down)
 */
function getAllSubfolderIds($parentFolderIds, $accessToken, $maxDepth = 5) {
    if (empty($parentFolderIds)) return [];
    $allFolderIds = array_values($parentFolderIds);
    $queue = array_values($parentFolderIds);
    $depth = 0;
    
    while (!empty($queue) && $depth < $maxDepth) {
        $nextQueue = [];
        $chunks = array_chunk($queue, 10);
        
        foreach ($chunks as $chunk) {
            $parentConditions = [];
            foreach ($chunk as $pid) {
                $cleanPid = addslashes($pid);
                $parentConditions[] = "'{$cleanPid}' in parents";
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
                    if (!empty($f['id']) && !in_array($f['id'], $allFolderIds)) {
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
 * Stream unduh berkas secara langsung dari Google Drive via Service Account
 */
function downloadDriveFileStream($fileId, $fileName, $mimeType, $accessToken, $fileSize = null) {
    while (ob_get_level() > 0) {
        ob_end_clean();
    }

    $cleanFileName = basename($fileName);
    if (empty($cleanFileName)) {
        $cleanFileName = 'Sertifikat_Kalibrasi.pdf';
    }
    if (stripos($cleanFileName, '.pdf') === false && (empty($mimeType) || $mimeType === 'application/pdf')) {
        $cleanFileName .= '.pdf';
    }

    $downloadUrl = "https://www.googleapis.com/drive/v3/files/" . urlencode($fileId) . "?alt=media&supportsAllDrives=true";

    $asciiName = preg_replace('/[^\w\s\.-]/', '_', $cleanFileName);
    header('Content-Description: File Transfer');
    header('Content-Type: ' . ($mimeType ?: 'application/pdf'));
    header('Content-Disposition: attachment; filename="' . addslashes($asciiName) . '"; filename*=UTF-8\'\'' . rawurlencode($cleanFileName));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    if (!empty($fileSize) && is_numeric($fileSize) && $fileSize > 0) {
        header('Content-Length: ' . (int)$fileSize);
    }

    $ch = curl_init($downloadUrl);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer {$accessToken}"
    ]);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 300);

    $out = fopen('php://output', 'wb');
    curl_setopt($ch, CURLOPT_FILE, $out);
    curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    fclose($out);
    exit;
}

/**
 * Tampilkan Viewer Khusus Sertifikat Lama dengan Tombol Download & Pratinjau
 */
function renderOldCertificateViewer($fileId, $fileName, $pageUrl, $customBackUrl = null) {
    $downloadUrl = $pageUrl . (strpos($pageUrl, '?') !== false ? '&' : '?') . http_build_query([
        'action'  => 'download',
        'file_id' => $fileId
    ]);
    $gdrivePreviewUrl = "https://drive.google.com/file/d/" . urlencode($fileId) . "/preview";
    $backUrl = !empty($customBackUrl) ? $customBackUrl : (!empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $pageUrl);
    ?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pratinjau Sertifikat - <?php echo htmlspecialchars($fileName); ?></title>
        <link rel="icon" href="logo/logo_pas_basic.png" type="image/png">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <style>
            :root {
                --primary: #2563eb;
                --primary-hover: #1d4ed8;
                --bg: #0f172a;
                --bar-bg: #1e293b;
                --border: #334155;
            }
            * { box-sizing: border-box; }
            body, html {
                margin: 0; padding: 0; width: 100%; height: 100%;
                font-family: 'Outfit', sans-serif;
                background-color: var(--bg);
                overflow: hidden;
                display: flex;
                flex-direction: column;
            }
            .viewer-topbar {
                background: var(--bar-bg);
                border-bottom: 1px solid var(--border);
                padding: 10px 18px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 12px;
                flex-shrink: 0;
                z-index: 10;
                box-shadow: 0 4px 15px rgba(0,0,0,0.3);
            }
            .viewer-title {
                color: #f8fafc;
                font-weight: 600;
                font-size: 0.95rem;
                display: flex;
                align-items: center;
                gap: 8px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                max-width: 50vw;
            }
            .btn-dl {
                background: linear-gradient(135deg, #10b981, #059669);
                color: #ffffff !important;
                border: none;
                padding: 7px 18px;
                border-radius: 50px;
                font-weight: 600;
                font-size: 0.85rem;
                display: inline-flex;
                align-items: center;
                gap: 7px;
                transition: all 0.2s ease;
                box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
                text-decoration: none;
            }
            .btn-dl:hover {
                background: linear-gradient(135deg, #059669, #047857);
                box-shadow: 0 4px 14px rgba(16, 185, 129, 0.45);
                transform: translateY(-1px);
            }
            .btn-back {
                background: rgba(255,255,255,0.08);
                color: #e2e8f0 !important;
                border: 1px solid rgba(255,255,255,0.15);
                padding: 6px 14px;
                border-radius: 50px;
                font-size: 0.82rem;
                font-weight: 500;
                text-decoration: none;
                transition: all 0.2s;
            }
            .btn-back:hover {
                background: rgba(255,255,255,0.18);
                color: #ffffff !important;
            }
            .viewer-frame-container {
                flex: 1;
                width: 100%;
                height: 100%;
                position: relative;
                background: #525659;
            }
            .viewer-frame {
                width: 100%;
                height: 100%;
                border: none;
                display: block;
            }
        </style>
    </head>
    <body>
        <div class="viewer-topbar">
            <div class="d-flex align-items-center gap-2" style="min-width: 0;">
                <a href="<?php echo htmlspecialchars($backUrl); ?>" class="btn-back">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
                <div class="viewer-title">
                    <i class="fas fa-file-pdf text-danger"></i>
                    <span title="<?php echo htmlspecialchars($fileName); ?>"><?php echo htmlspecialchars($fileName); ?></span>
                </div>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="<?php echo htmlspecialchars($downloadUrl); ?>" class="btn-dl">
                    <i class="fas fa-download"></i> <span>Download File</span>
                </a>
            </div>
        </div>
        <div class="viewer-frame-container">
            <iframe class="viewer-frame" src="<?php echo htmlspecialchars($gdrivePreviewUrl); ?>" allow="autoplay"></iframe>
        </div>
    </body>
    </html>
    <?php
}

// =========================================================================
// 2. AJAX ENDPOINTS: OTP EMAIL PERUSAHAAN
// =========================================================================

// ── DEBUG ENDPOINT (sementara – hapus setelah masalah terselesaikan) ──────
if (isset($_GET['action']) && $_GET['action'] === 'debug_access') {
    header('Content-Type: application/json; charset=utf-8');
    $debugEmail  = strtolower($_SESSION['user_email'] ?? '');
    $debugFileId = trim($_GET['file_id'] ?? '');
    $debugResult = [
        'session_email'  => $debugEmail,
        'session_source' => $_SESSION['auth_source'] ?? '',
        'file_id'        => $debugFileId,
        'allowed_fids'   => [],
        'file_parents'   => [],
        'access'         => false,
        'step'           => '',
    ];
    if (!empty($debugEmail)) {
        $debugResult['allowed_fids'] = getCustomerAllowedFolderIds($debugEmail);
    }
    if (!empty($debugFileId)) {
        try {
            $at = getGDriveAccessToken($credentialsPath, $tokenPath);
            $fi = curlGDriveAPI(
                "https://www.googleapis.com/drive/v3/files/{$debugFileId}"
                . "?fields=id,name,parents&supportsAllDrives=true&includeItemsFromAllDrives=true",
                $at
            );
            $debugResult['file_info']    = $fi;
            $debugResult['file_parents'] = $fi['parents'] ?? [];
            $debugResult['access']       = !empty($debugResult['allowed_fids'])
                && (
                    in_array($debugFileId, $debugResult['allowed_fids'])
                    || !empty(array_intersect($debugResult['file_parents'], $debugResult['allowed_fids']))
                );
        } catch (Throwable $e) {
            $debugResult['error'] = $e->getMessage();
        }
    }
    echo json_encode($debugResult, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    exit;
}
// ─────────────────────────────────────────────────────────────────────────

if (isset($_GET['action']) && $_GET['action'] === 'send_otp' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json; charset=utf-8');
    $inputEmail = strtolower(trim($_POST['email'] ?? ''));
    if (empty($inputEmail)) {
        echo json_encode(['success' => false, 'message' => 'Alamat email perusahaan wajib diisi.']);
        exit;
    }
    $res = generateAndSendCustomerOtp($inputEmail);
    echo json_encode($res);
    exit;
}

if (isset($_GET['action']) && $_GET['action'] === 'verify_otp' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json; charset=utf-8');
    $inputEmail   = strtolower(trim($_POST['email'] ?? ''));
    $inputOtp     = trim($_POST['otp'] ?? '');
    $targetFileId = trim($_POST['target_file_id'] ?? '');
    $certIdParam  = trim($_POST['cert_id'] ?? '');

    $res = verifyCustomerOtp($inputEmail, $inputOtp);
    if ($res['success']) {
        $client = $res['client'];
        $loggedEmail = strtolower($client['logged_email'] ?? $inputEmail);
        $_SESSION['user_email']   = $loggedEmail;

        if (!empty($client['is_additional_email'])) {
            if (!empty($client['additional_nama'])) {
                $displayName = $client['additional_nama'];
            } else {
                $emailPrefix = explode('@', $loggedEmail)[0];
                $displayName = ucwords(str_replace(['.', '_', '-'], ' ', $emailPrefix));
            }
        } else {
            $displayName = $client['nama'] ?: 'Pengguna';
        }
        $_SESSION['user_name']    = $displayName;
        $_SESSION['user_company'] = $client['perusahaan'] ?? '';
        $_SESSION['auth_source']  = 'database';
        $_SESSION['is_additional_email'] = !empty($client['is_additional_email']);

        $redirect = !empty($targetFileId)
            ? 'cert-list.php?cert_id=' . urlencode($certIdParam) . '&action=open&file_id=' . urlencode($targetFileId)
            : ('cert-list.php' . (!empty($certIdParam) ? '?cert_id=' . urlencode($certIdParam) : ''));

        echo json_encode(['success' => true, 'redirect' => $redirect]);
    } else {
        echo json_encode(['success' => false, 'message' => $res['message']]);
    }
    exit;
}

// Endpoint untuk inisiasi Google Login dengan mengingat file target
if (isset($_GET['action']) && $_GET['action'] === 'google_login') {
    $targetFileId = trim($_GET['file_id'] ?? '');
    $certIdParam  = trim($_GET['cert_id'] ?? '');
    if (!empty($targetFileId)) {
        $_SESSION['redirect_target'] = 'cert-list.php?cert_id=' . urlencode($certIdParam) . '&action=open&file_id=' . urlencode($targetFileId);
    } elseif (!empty($certIdParam)) {
        $_SESSION['redirect_target'] = 'cert-list.php?cert_id=' . urlencode($certIdParam);
    } else {
        $_SESSION['redirect_target'] = 'cert-list.php';
    }
    $authUrl = "https://accounts.google.com/o/oauth2/v2/auth?" . http_build_query([
        'client_id'     => $googleClientId,
        'redirect_uri'  => $redirectUri,
        'response_type' => 'code',
        'scope'         => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile',
        'access_type'   => 'online',
        'prompt'        => 'select_account'
    ]);
    header("Location: " . $authUrl);
    exit;
}

// =========================================================================
// 3. LOGOUT & OAUTH CALLBACK
// =========================================================================
if (isset($_GET['logout'])) {
    unset($_SESSION['user_email']);
    unset($_SESSION['user_name']);
    unset($_SESSION['user_company']);
    unset($_SESSION['auth_source']);
    unset($_SESSION['redirect_target']);
    $certId = $_GET['cert_id'] ?? '';
    header("Location: cert-list.php" . ($certId ? "?cert_id=" . urlencode($certId) : ''));
    exit;
}

if (isset($_GET['code'])) {
    $code = $_GET['code'];
    $ch = curl_init('https://oauth2.googleapis.com/token');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'code'          => $code,
        'client_id'     => $googleClientId,
        'client_secret' => $googleClientSecret,
        'redirect_uri'  => $redirectUri,
        'grant_type'    => 'authorization_code'
    ]));
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    $res = curl_exec($ch);
    curl_close($ch);

    $tokenInfo = json_decode($res, true);
    if (!empty($tokenInfo['access_token'])) {
        $ch2 = curl_init('https://www.googleapis.com/oauth2/v2/userinfo');
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch2, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $tokenInfo['access_token']]);
        curl_setopt($ch2, CURLOPT_TIMEOUT, 15);
        $userInfoRes = curl_exec($ch2);
        curl_close($ch2);

        $userInfo = json_decode($userInfoRes, true);
        if (!empty($userInfo['email'])) {
            $_SESSION['user_email']   = strtolower($userInfo['email']);
            $_SESSION['user_name']    = $userInfo['name'] ?? '';
            $_SESSION['auth_source']  = 'google';
            
            $client = getCustomerByEmail($_SESSION['user_email']);
            if ($client) {
                $_SESSION['user_company'] = $client['perusahaan'];
            }
            
            $targetUrl = $_SESSION['redirect_target'] ?? 'cert-list.php';
            unset($_SESSION['redirect_target']);
            header("Location: " . $targetUrl);
            exit;
        }
    }
}

// Google Auth URL default
$googleAuthUrl = "https://accounts.google.com/o/oauth2/v2/auth?" . http_build_query([
    'client_id'     => $googleClientId,
    'redirect_uri'  => $redirectUri,
    'response_type' => 'code',
    'scope'         => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile',
    'access_type'   => 'online',
    'prompt'        => 'select_account'
]);

// =========================================================================
// 4. TANGKAP PARAMETER URL & PREFIX
// =========================================================================
$rawCertId   = rawurldecode($_GET['cert_id'] ?? '');
$action      = $_GET['action']    ?? '';
$fileId      = $_GET['file_id']   ?? '';
$subFolderId = $_GET['folder_id'] ?? '';
$viewAll     = isset($_GET['view_all']) && $_GET['view_all'] == '1';
$userEmail   = strtolower($_SESSION['user_email'] ?? '');
$userName    = $_SESSION['user_name'] ?? '';
$userCompany = $_SESSION['user_company'] ?? '';
$authSource  = $_SESSION['auth_source'] ?? '';
$isLoggedIn  = !empty($userEmail);

$prefix = '';
if (preg_match('/(PAS-\d+)/i', $rawCertId, $matches)) {
    $prefix = strtoupper($matches[1]);
} else {
    $prefix = strtoupper(trim($rawCertId));
}

$accessDenied      = false;
$requireLoginModal = false;
$errorMsg          = null;

// =========================================================================
// 5. PENGECEKAN KEAMANAN HAK AKSES SEBELUM BUKA FILE
// =========================================================================
if (($action === 'open' || $action === 'download') && !empty($fileId)) {
    if (!$isLoggedIn) {
        // Belum login: tampilkan modal login dengan target file yang dipilih
        $requireLoginModal = true;
    } else {
        try {
            $accessToken = getGDriveAccessToken($credentialsPath, $tokenPath);
            $hasAccess   = false;
            $fileInfo    = null;
            $allAllowedIds = [];

            // 1. Ambil folder yang diizinkan dari database client_access
            $allowedFids = getCustomerAllowedFolderIds($userEmail);
            error_log("[CertList-Access] user={$userEmail} fileId={$fileId} allowedFids=" . json_encode($allowedFids));

            // ── Tahap A: Direct match — file ID itu sendiri ada di daftar ──
            if (!empty($allowedFids) && in_array($fileId, $allowedFids)) {
                $hasAccess = true;
                $allAllowedIds = $allowedFids;
                error_log("[CertList-Access] GRANTED via direct file ID match");
            }

            // ── Tahap B & seterusnya: cek hierarki folder ──
            if (!$hasAccess && !empty($allowedFids)) {

                // B1. Ambil info file (parents) dari Google Drive
                $fileInfo = curlGDriveAPI(
                    "https://www.googleapis.com/drive/v3/files/{$fileId}"
                    . "?fields=id,name,parents"
                    . "&supportsAllDrives=true&includeItemsFromAllDrives=true",
                    $accessToken
                );
                $parents = $fileInfo['parents'] ?? [];
                error_log("[CertList-Access] file parents=" . json_encode($parents));

                // B2. Cek apakah parent LANGSUNG ada di daftar allowed (kasus paling umum)
                if (!$hasAccess && !empty($parents)) {
                    foreach ($parents as $pId) {
                        if (in_array($pId, $allowedFids)) {
                            $hasAccess = true;
                            $allAllowedIds = $allowedFids;
                            error_log("[CertList-Access] GRANTED via direct parent in allowedFids");
                            break;
                        }
                    }
                }

                // B3. Top-Down scan: kumpulkan seluruh subfolder di bawah folder yang diizinkan
                if (!$hasAccess) {
                    $allScopeFolderIds = getAllSubfolderIds($allowedFids, $accessToken, 6);
                    $allAllowedIds = array_values(array_unique(array_merge($allowedFids, $allScopeFolderIds)));
                    error_log("[CertList-Access] allAllowedIds count=" . count($allAllowedIds));

                    // Cek apakah fileId ada di dalam subfolder
                    if (in_array($fileId, $allAllowedIds)) {
                        $hasAccess = true;
                        error_log("[CertList-Access] GRANTED via file ID in subfolder scan");
                    }

                    // Cek apakah parent ada di dalam subfolder
                    if (!$hasAccess && !empty($parents)) {
                        foreach ($parents as $pId) {
                            if (in_array($pId, $allAllowedIds)) {
                                $hasAccess = true;
                                error_log("[CertList-Access] GRANTED via parent in subfolder scan");
                                break;
                            }
                        }
                    }

                    // B4. Bottom-Up: naiki hierarki folder sampai ketemu atau habis
                    if (!$hasAccess && !empty($parents)) {
                        $currentParent = $parents[0] ?? null;
                        $maxDepth = 8;
                        $depthCount = 0;
                        while (!empty($currentParent) && $maxDepth-- > 0) {
                            $depthCount++;
                            if (in_array($currentParent, $allowedFids) || in_array($currentParent, $allAllowedIds)) {
                                $hasAccess = true;
                                error_log("[CertList-Access] GRANTED via database allowedFids bottom-up depth={$depthCount}");
                                break;
                            }
                            $pInfo = curlGDriveAPI(
                                "https://www.googleapis.com/drive/v3/files/{$currentParent}"
                                . "?fields=id,parents"
                                . "&supportsAllDrives=true&includeItemsFromAllDrives=true",
                                $accessToken
                            );
                            $currentParent = $pInfo['parents'][0] ?? null;
                        }
                    }
                }
            }

            if (!$hasAccess) {
                error_log("[CertList-Access] DENIED user={$userEmail} fileId={$fileId}");
            }

            if ($hasAccess) {
                // Pastikan nama file didapatkan
                if (empty($fileInfo) || empty($fileInfo['name'])) {
                    $fileInfo = curlGDriveAPI(
                        "https://www.googleapis.com/drive/v3/files/{$fileId}"
                        . "?fields=id,name,parents&supportsAllDrives=true",
                        $accessToken
                    );
                }

                $fileName = $fileInfo['name'] ?? 'sertifikat.pdf';
                $mimeType = $fileInfo['mimeType'] ?? 'application/pdf';

                // JIKA AKSI ADALAH DOWNLOAD:
                if ($action === 'download') {
                    downloadDriveFileStream($fileId, $fileName, $mimeType, $accessToken, $fileInfo['size'] ?? null);
                    exit;
                }

                // Cek apakah berkas merupakan Sertifikat Digital PAS (PAS-XXXXXX) atau format sertifikat lama
                // Seperti di cariSertifikat.php: HANYA jika nama file mengandung PAS-XXXXXX dianggap sertifikat digital
                $actualCertId = '';
                $isDigital = false;
                if (!empty($fileInfo['name']) && preg_match('/(PAS-\d+)/i', $fileInfo['name'], $m)) {
                    $actualCertId = strtoupper($m[1]);
                    $isDigital = true;
                } else {
                    $actualCertId = pathinfo($fileInfo['name'] ?? '', PATHINFO_FILENAME);
                }

                // Jika format sertifikat lama (bukan sertifikat digital PAS / belum punya ID di server),
                // tampilkan viewer khusus dengan tombol Download & pratinjau
                if (!$isDigital) {
                    $backUrl = 'cert-list.php?' . http_build_query([
                        'cert_id'   => $prefix,
                        'folder_id' => $subFolderId ?? '',
                        'view_all'  => $viewAll ? 1 : 0
                    ]);
                    renderOldCertificateViewer($fileId, $fileName, 'cert-list.php', $backUrl);
                    exit;
                }

                $sig = substr(hash_hmac('sha256', $fileId . '|' . $actualCertId, 'PAS_CALIBRATION_SECURE_GDRIVE_KEY_2026'), 0, 16);
                $targetUrl = $paperlessUrl . "?" . http_build_query([
                    'file_id'   => $fileId,
                    'cert_id'   => $actualCertId,
                    'file_name' => $fileName,
                    'sig'       => $sig
                ]);
                header("Location: " . $targetUrl);
                exit;
            } else {
                $accessDenied = true;
            }

        } catch (Throwable $e) {
            $accessDenied = true;
            $errorMsg = "Gagal memverifikasi akses: " . $e->getMessage();
            error_log("[CertList-Access] Exception: " . $e->getMessage());
        }
    }
}

// =========================================================================
// 6. CARI FILE / FOLDER DARI GDRIVE
// =========================================================================
$filesFound = [];
$matchedParentFolderId = null;
$currentFolderName = null;
$parentOfSubfolder = null;

if (!$accessDenied) {
    try {
        $accessToken = getGDriveAccessToken($credentialsPath, $tokenPath);

        if (!empty($subFolderId) && $viewAll) {
            // Dapatkan informasi nama folder & parent-nya
            $folderInfo = curlGDriveAPI(
                "https://www.googleapis.com/drive/v3/files/{$subFolderId}?fields=id,name,parents&supportsAllDrives=true",
                $accessToken
            );
            if (!empty($folderInfo['name'])) {
                $currentFolderName = $folderInfo['name'];
            }
            if (!empty($folderInfo['parents'][0])) {
                $parentOfSubfolder = $folderInfo['parents'][0];
            }

            // Mode Membuka Isi Folder Induk (STRICT Hanya File Dalam Folder Tersebut)
            $rawQuery = "'{$subFolderId}' in parents and trashed = false";
        } elseif (!empty($prefix)) {
            // Mode Default Scan (Filter Nama Mengandung Prefix)
            $rawQuery = "name contains '{$prefix}' and mimeType != 'application/vnd.google-apps.folder' and trashed = false";
        } else {
            $rawQuery = "trashed = false";
        }

        $apiUrl = "https://www.googleapis.com/drive/v3/files?q=" . urlencode($rawQuery) . "&fields=files(id,name,mimeType,parents)&orderBy=name&pageSize=100";
        $resData = curlGDriveAPI($apiUrl, $accessToken);
        
        if (!empty($resData['files'])) {
            $filesFound = $resData['files'];

            // Deteksi Folder Induk (Parent Folder) dari file yang ditemukan
            foreach ($filesFound as $f) {
                if (!empty($f['parents'][0])) {
                    $matchedParentFolderId = $f['parents'][0];
                    break;
                }
            }
        }
    } catch (Throwable $e) {
        $errorMsg = "Gagal koneksi ke Google Drive API: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Portal Sertifikat Digital — <?php echo htmlspecialchars($prefix ?: 'PT PANANJUNG ANUGRAH SOLUTION'); ?></title>
    
    <link rel="icon" href="https://www.pascalibration.com/wp-content/uploads/2023/09/logo_pas_basic.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --navbar-bg: #FFFFFF;
            --accent-blue: #1d4ed8;
            --bg-body: #f8fafc;
            --border-color: #e2e8f0;
        }

        * { -webkit-tap-highlight-color: transparent; }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg-body);
            color: #0f172a;
            min-height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        /* HEADER NAVBAR WARNA PUTIH #FFFFFF */
        .portal-navbar {
            background-color: var(--navbar-bg);
            padding: 0.85rem 1rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.04);
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid var(--border-color);
        }

        /* TEXT NAMA PT (BIRU AGA TUA #0F2B5C) */
        .brand-logo-text { 
            font-weight: 800; 
            font-size: 1.15rem; 
            letter-spacing: -0.5px; 
            color: #0F2B5C !important; 
            line-height: 1.1; 
        }

        /* TULISAN SMART CERTIFICATE VERIFICATION (GOLD #F7941D) */
        .brand-sub { 
            font-size: 0.68rem; 
            color: #F7941D !important; 
            letter-spacing: 0.8px; 
            font-weight: 700;
            text-transform: uppercase; 
        }

        .portal-body { flex: 1; padding: 1.25rem 0.75rem; }
        .portal-container { max-width: 860px; margin: 0 auto; }

        .hero-banner {
            background: #ffffff;
            border-radius: 18px;
            border: 1px solid var(--border-color);
            padding: 1.25rem 1rem;
            margin-bottom: 1rem;
            box-shadow: 0 4px 16px rgba(0,0,0,0.02);
        }

        .cert-id-badge {
            background: #e0f2fe;
            color: #0284c7;
            font-weight: 700;
            font-size: 0.95rem;
            padding: 5px 14px;
            border-radius: 30px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: 1px solid #bae6fd;
        }

        /* COMPACT TAP-CARD LINK */
        .cert-card-link {
            text-decoration: none;
            display: block;
            margin-bottom: 0.65rem;
        }
        .cert-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 1rem 1.15rem;
            transition: all 0.2s ease;
            box-shadow: 0 2px 8px rgba(0,0,0,0.02);
            cursor: pointer;
        }
        .cert-card-link:hover .cert-card,
        .cert-card-link:active .cert-card {
            border-color: #3b82f6;
            background: #f0f9ff;
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(37, 99, 235, 0.08);
        }

        /* ICON PDF vs FOLDER */
        .icon-pdf-box {
            width: 44px;
            height: 44px;
            background: #fef2f2;
            color: #ef4444;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
            flex-shrink: 0;
            transition: all 0.2s ease;
        }
        .cert-card-link:hover .icon-pdf-box {
            background: #ef4444;
            color: #ffffff;
        }

        .icon-folder-box {
            width: 44px;
            height: 44px;
            background: #fef3c7;
            color: #d97706;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
            flex-shrink: 0;
            transition: all 0.2s ease;
        }
        .cert-card-link:hover .icon-folder-box {
            background: #d97706;
            color: #ffffff;
        }

        .chevron-box {
            width: 32px;
            height: 32px;
            background: #f1f5f9;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            color: #64748b;
            flex-shrink: 0;
            transition: all 0.2s ease;
        }
        .cert-card-link:hover .chevron-box {
            background: #2563eb;
            color: #ffffff;
            transform: translateX(3px);
        }

        /* Cert Card with Direct Actions (untuk sertifikat lama yang punya tombol Download) */
        .cert-card-actions {
            display: flex;
            align-items: center;
            gap: 6px;
            flex-shrink: 0;
            z-index: 2;
        }
        .btn-cert-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            padding: 5px 12px;
            font-size: 0.78rem;
            font-weight: 600;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            white-space: nowrap;
        }
        .btn-cert-preview {
            background: #f1f5f9;
            color: #475569 !important;
            border: 1px solid #cbd5e1;
        }
        .btn-cert-preview:hover {
            background: #e2e8f0;
            color: #1e293b !important;
            border-color: #94a3b8;
            transform: translateY(-1px);
        }
        .btn-cert-download {
            background: linear-gradient(135deg, #10b981, #059669);
            color: #ffffff !important;
            border: 1px solid #059669;
            box-shadow: 0 2px 6px rgba(16, 185, 129, 0.25);
        }
        .btn-cert-download:hover {
            background: linear-gradient(135deg, #059669, #047857);
            color: #ffffff !important;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
            transform: translateY(-1px);
        }


        .access-denied-wrapper {
            background: #ffffff;
            border-radius: 20px;
            border: 1px solid #fee2e2;
            padding: 2.5rem 1.25rem;
            text-align: center;
            box-shadow: 0 10px 30px rgba(239, 68, 68, 0.06);
            max-width: 540px;
            margin: 1rem auto;
        }
        .icon-lock-large {
            width: 80px;
            height: 80px;
            background: #fef2f2;
            color: #ef4444;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.25rem;
            margin: 0 auto 1.25rem auto;
            box-shadow: 0 8px 20px rgba(239, 68, 68, 0.12);
        }

        .empty-state-wrapper {
            background: #ffffff;
            border-radius: 20px;
            border: 1px solid var(--border-color);
            padding: 3rem 1.25rem;
            text-align: center;
        }
        .icon-empty-folder {
            width: 80px;
            height: 80px;
            background: #fef3c7;
            color: #d97706;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.25rem;
            margin: 0 auto 1.25rem auto;
        }

        .user-account-chip {
            background: #ffffff;
            border: 1px solid #cbd5e1;
            padding: 5px 12px;
            border-radius: 30px;
            font-size: 0.8rem;
            color: #0f172a;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        /* TOMBOL GOOGLE LOGIN */
        .google-login-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            background: #ffffff;
            color: #1f2937;
            border: 1px solid #d1d5db;
            padding: 11px 20px;
            border-radius: 50px;
            font-size: 0.95rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            width: 100%;
        }
        .google-login-btn:hover {
            box-shadow: 0 4px 16px rgba(0,0,0,0.12);
            transform: translateY(-2px);
            border-color: #9ca3af;
            color: #111827;
        }
        .google-login-btn img {
            width: 20px;
            height: 20px;
        }

        /* MODAL LOGIN STYLING */
        .modal-login-content {
            border-radius: 24px;
            border: 1px solid #e2e8f0;
            overflow: hidden;
            box-shadow: 0 20px 45px rgba(0,0,0,0.12);
        }
        .login-icon-circle {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, #e0f2fe, #bae6fd);
            color: #0284c7;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            margin: 0 auto 1rem auto;
            box-shadow: 0 6px 16px rgba(2, 132, 199, 0.18);
        }

        .nav-pills .nav-link {
            color: #64748b;
            font-weight: 600;
            border-radius: 30px;
            padding: 8px 16px;
            transition: all 0.2s ease;
        }
        .nav-pills .nav-link.active {
            background-color: #0d6efd;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.25);
        }

        @media (max-width: 767.98px) {
            .portal-body { padding: 1rem 0.5rem; }
            .hero-banner { padding: 1rem; text-align: center; }
            .hero-banner-content { flex-direction: column; align-items: center !important; text-align: center; }
            .brand-logo-text { font-size: 1.02rem; }
            .brand-sub { font-size: 0.62rem; }
        }
    </style>
</head>
<body>

    <!-- NAVBAR HEADER WARNA PUTIH #FFFFFF + LOGO PAS -->
    <nav class="portal-navbar">
        <div class="container portal-container d-flex align-items-center justify-content-between">
            <a href="https://pascalibration.com" class="d-flex align-items-center gap-2 text-decoration-none">
                <img src="https://www.pascalibration.com/wp-content/uploads/2023/09/logo_pas_basic.png" alt="PAS Logo" style="height: 38px; object-fit: contain;">
                <div>
                    <div class="brand-logo-text">PT PANANJUNG ANUGRAH SOLUTION</div>
                    <div class="brand-sub">SMART CERTIFICATE VERIFICATION</div>
                </div>
            </a>

            <div>
                <?php if ($isLoggedIn): ?>
                    <div class="user-account-chip">
                        <i class="fas fa-user-circle text-primary"></i>
                        <span class="text-truncate d-none d-sm-inline" style="max-width: 150px;"><?php echo htmlspecialchars($userEmail); ?></span>
                        <a href="cert-list.php?logout=1&cert_id=<?php echo urlencode($prefix); ?>" class="text-danger text-decoration-none ms-1 fw-bold" title="Logout">
                            <i class="fas fa-power-off"></i>
                        </a>
                    </div>
                <?php else: ?>
                    <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1.5 fw-bold shadow-sm" onclick="openLoginModal('', '')">
                        <i class="fas fa-sign-in-alt me-1"></i> Masuk
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="portal-body">
        <div class="portal-container">

            <?php if ($accessDenied): ?>
                <!-- TAMPILAN SECURITY CEK AKSES: DIBLOKIR -->
                <div class="access-denied-wrapper">
                    <div class="icon-lock-large">
                        <i class="fas fa-user-lock"></i>
                    </div>
                    <h4 class="fw-bold text-dark mb-2">Akses Ditolak</h4>
                    <p class="text-muted mb-3 small">
                        Login sebagai: <strong class="text-dark"><?php echo htmlspecialchars($userEmail); ?></strong>
                        <?php if (!empty($userCompany)): ?>
                            <br><span class="badge bg-light text-primary border mt-1"><?php echo htmlspecialchars($userCompany); ?></span>
                        <?php endif; ?>
                    </p>
                    
                    <div class="alert alert-danger border-0 bg-danger bg-opacity-10 text-danger p-3 rounded-4 mb-4 text-start small">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Maaf, akun email Anda tidak memiliki hak akses untuk membuka berkas sertifikat ini.
                        Silakan hubungi admin PT Pananjung Anugrah Solution atau masuk dengan akun lain yang diizinkan.
                    </div>

                    <div class="d-grid gap-2">
                        <button type="button" onclick="openLoginModal('', '')" class="btn btn-primary rounded-pill py-2.5 fw-semibold shadow-sm">
                            <i class="fas fa-user-circle me-2"></i>Masuk dengan Akun Lain
                        </button>
                        <a href="cert-list.php?logout=1&cert_id=<?php echo urlencode($prefix); ?>" class="btn btn-outline-danger rounded-pill py-2.5 fw-semibold">
                            <i class="fas fa-sign-out-alt me-2"></i>Keluar / Logout
                        </a>
                        <a href="cert-list.php?cert_id=<?php echo urlencode($prefix); ?><?php echo (!empty($subFolderId) && $viewAll) ? '&folder_id=' . urlencode($subFolderId) . '&view_all=1' : ''; ?>" class="btn btn-light rounded-pill py-2.5 fw-semibold text-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
                        </a>
                    </div>
                </div>

            <?php else: ?>
                <!-- DAFTAR SERTIFIKAT HASIL SCAN -->
                <div class="hero-banner">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 hero-banner-content">
                        <div>
                            <?php if ($viewAll && !empty($subFolderId)): ?>
                                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary-subtle rounded-pill px-3 py-1.5 mb-2 fw-semibold">
                                    <i class="fas fa-folder-open me-1"></i> <?php echo htmlspecialchars($currentFolderName ?: 'Folder Berkas'); ?>
                                </span>
                            <?php else: ?>
                                <span class="cert-id-badge mb-1">
                                    <i class="fas fa-qrcode"></i> ID ALAT : <?php echo htmlspecialchars($prefix ?: 'N/A'); ?>
                                </span>
                            <?php endif; ?>
                            <h5 class="fw-bold mb-0 text-dark">
                                <?php echo ($viewAll && !empty($subFolderId)) ? htmlspecialchars($currentFolderName ?: 'Semua Berkas di Folder Ini') : 'Daftar Berkas Sertifikat'; ?>
                            </h5>
                            <small class="text-muted" style="font-size:0.8rem;">
                                <?php echo ($viewAll && !empty($subFolderId)) ? 'Menampilkan seluruh berkas di dalam folder ini' : 'Tap pada berkas sertifikat di bawah ini untuk Melihat Detail Sertifikat'; ?>
                            </small>
                        </div>

                        <?php if (!empty($userEmail)): ?>
                            <div class="user-account-chip">
                                <i class="fas fa-user-circle text-primary"></i>
                                <span class="text-truncate" style="max-width: 180px;"><?php echo htmlspecialchars($userEmail); ?></span>
                                <?php if (!empty($userCompany)): ?>
                                    <span class="badge bg-light text-primary border" style="font-size: 0.72rem;"><?php echo htmlspecialchars($userCompany); ?></span>
                                <?php endif; ?>
                                <a href="cert-list.php?logout=1&cert_id=<?php echo urlencode($prefix); ?>" class="text-danger text-decoration-none ms-1 fw-bold" title="Logout">
                                    <i class="fas fa-power-off"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if (!$isLoggedIn): ?>
                    <?php endif; ?>
                </div>

                <!-- CONTROLLER INDICATOR -->
                <?php if ($viewAll && !empty($subFolderId)): ?>
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                        <div class="d-flex align-items-center gap-2 flex-wrap">
                            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary-subtle rounded-pill px-3 py-2">
                                <i class="fas fa-folder-open me-1"></i> Folder: <?php echo htmlspecialchars($currentFolderName ?: 'Folder Berkas'); ?>
                            </span>
                            <?php if (!empty($parentOfSubfolder) && $parentOfSubfolder !== $folderId): ?>
                                <a href="cert-list.php?cert_id=<?php echo urlencode($prefix); ?>&folder_id=<?php echo urlencode($parentOfSubfolder); ?>&view_all=1" class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1.5 fw-semibold small">
                                    <i class="fas fa-arrow-up me-1"></i> Ke Folder Sebelumnya
                                </a>
                            <?php endif; ?>
                        </div>
                        <a href="cert-list.php?cert_id=<?php echo urlencode($prefix); ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1.5 fw-semibold small">
                            <i class="fas fa-qrcode me-1"></i> Kembali ke Scan Alat (<?php echo htmlspecialchars($prefix); ?>)
                        </a>
                    </div>
                <?php endif; ?>

                <?php if ($errorMsg): ?>
                    <div class="alert alert-danger rounded-4 p-3 mb-4 small">
                        <i class="fas fa-exclamation-circle me-2 fs-6"></i><?php echo htmlspecialchars($errorMsg); ?>
                    </div>

                <?php elseif (empty($filesFound)): ?>
                    <div class="empty-state-wrapper">
                        <div class="icon-empty-folder">
                            <i class="fas fa-folder-open"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Sertifikat Belum Tersedia</h5>
                        <p class="text-muted mb-4 small" style="max-width: 440px; margin: 0 auto; line-height: 1.6;">
                            Berkas sertifikat digital untuk ID <strong class="text-dark"><?php echo htmlspecialchars($prefix); ?></strong> belum diunggah atau belum tersedia di Server.
                        </p>
                        <a href="https://pascalibration.com" class="btn btn-outline-secondary rounded-pill px-4 py-2 fw-semibold small">
                            <i class="fas fa-home me-2"></i>Kembali ke Beranda Utama
                        </a>
                    </div>

                <?php else: ?>
                    <!-- COMPACT LIST SERTIFIKAT (TAP MANA SAJA UNTUK BUKA) -->
                    <div class="cert-list-group">
                        <?php foreach ($filesFound as $file): ?>
                            <?php 
                                $isFolder = ($file['mimeType'] === 'application/vnd.google-apps.folder');
                                
                                if ($isFolder) {
                                    $itemUrl = "cert-list.php?" . http_build_query([
                                        'cert_id'   => $prefix,
                                        'folder_id' => $file['id'],
                                        'view_all'  => 1
                                    ]);
                                    $onclickAttr = '';
                                } else {
                                    // Ekstrak cert_id spesifik dari nama berkas ini (bukan terpaku pada prefix scan awal)
                                    $fileCertId = '';
                                    if (!empty($file['name']) && preg_match('/(PAS-\d+)/i', $file['name'], $m)) {
                                        $fileCertId = strtoupper($m[1]);
                                    }

                                    $itemParams = [
                                        'action'  => 'open',
                                        'file_id' => $file['id']
                                    ];
                                    if (!empty($fileCertId)) {
                                        $itemParams['cert_id'] = $fileCertId;
                                    }
                                    if (!empty($subFolderId) && $viewAll) {
                                        $itemParams['folder_id'] = $subFolderId;
                                        $itemParams['view_all']  = 1;
                                    }

                                    $downloadParams = $itemParams;
                                    $downloadParams['action'] = 'download';

                                    if ($isLoggedIn) {
                                        $itemUrl = "cert-list.php?" . http_build_query($itemParams);
                                        $downloadUrl = "cert-list.php?" . http_build_query($downloadParams);
                                        $onclickAttr = '';
                                    } else {
                                        $itemUrl = "javascript:void(0)";
                                        $downloadUrl = "javascript:void(0)";
                                        $safeFileName = htmlspecialchars(addslashes($file['name']));
                                        $safeFileId   = htmlspecialchars($file['id']);
                                        $safeCertId   = htmlspecialchars(addslashes($fileCertId));
                                        $onclickAttr  = 'onclick="openLoginModal(\'' . $safeFileId . '\', \'' . $safeFileName . '\', \'' . $safeCertId . '\')"';
                                    }
                                }

                                $isOldCert = (!$isFolder && empty($fileCertId));
                            ?>

                            <?php if ($isFolder): ?>
                                <!-- FOLDER CARD -->
                                <a href="<?php echo $itemUrl; ?>" class="cert-card-link">
                                    <div class="cert-card d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center gap-3" style="min-width: 0;">
                                            <div class="icon-folder-box">
                                                <i class="fas fa-folder"></i>
                                            </div>
                                            <div style="min-width: 0;">
                                                <h6 class="fw-bold text-dark mb-1 text-truncate" style="font-size: 0.95rem; line-height: 1.3;">
                                                    <?php echo htmlspecialchars($file['name']); ?>
                                                </h6>
                                                <small class="text-warning-emphasis d-block" style="font-size: 0.78rem;">
                                                    <i class="fas fa-folder-open me-1"></i> Sub-Folder — Tap untuk Membuka Isi Folder
                                                </small>
                                            </div>
                                        </div>
                                        <div class="chevron-box ms-2">
                                            <i class="fas fa-chevron-right"></i>
                                        </div>
                                    </div>
                                </a>

                            <?php elseif ($isOldCert && $isLoggedIn): ?>
                                <!-- SERTIFIKAT LAMA: Tombol Lihat + Download -->
                                <div class="cert-card d-flex align-items-center justify-content-between" style="margin-bottom: 0.65rem;">
                                    <a href="<?php echo $itemUrl; ?>" target="_blank" rel="noopener noreferrer" class="d-flex align-items-center gap-3 text-decoration-none" style="min-width: 0; flex: 1; color: inherit;">
                                        <div class="icon-pdf-box">
                                            <i class="far fa-file-pdf"></i>
                                        </div>
                                        <div style="min-width: 0;">
                                            <h6 class="fw-bold text-dark mb-1 text-truncate" style="font-size: 0.95rem; line-height: 1.3;">
                                                <?php echo htmlspecialchars($file['name']); ?>
                                            </h6>
                                            <small class="text-muted d-block" style="font-size: 0.78rem;">
                                                <span class="badge bg-light text-danger border me-1" style="font-size: 0.7rem;"><i class="fas fa-file-pdf me-1"></i>Sertifikat Lama</span>
                                                Berkas PDF • Klik untuk pratinjau
                                            </small>
                                        </div>
                                    </a>
                                    <div class="cert-card-actions ms-2">
                                        <a href="<?php echo $itemUrl; ?>" target="_blank" rel="noopener noreferrer" class="btn-cert-action btn-cert-preview" title="Pratinjau Sertifikat">
                                            <i class="fas fa-eye"></i> <span class="d-none d-md-inline">Lihat</span>
                                        </a>
                                        <a href="<?php echo $downloadUrl; ?>" class="btn-cert-action btn-cert-download" title="Download File Sertifikat">
                                            <i class="fas fa-download"></i> <span class="d-none d-sm-inline">Download</span>
                                        </a>
                                    </div>
                                </div>

                            <?php else: ?>
                                <!-- SERTIFIKAT DIGITAL ATAU BELUM LOGIN -->
                                <a href="<?php echo $itemUrl; ?>" <?php echo $onclickAttr; ?> class="cert-card-link">
                                    <div class="cert-card d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center gap-3" style="min-width: 0;">
                                            <div class="icon-pdf-box">
                                                <i class="far fa-file-pdf"></i>
                                            </div>
                                            <div style="min-width: 0;">
                                                <h6 class="fw-bold text-dark mb-1 text-truncate" style="font-size: 0.95rem; line-height: 1.3;">
                                                    <?php echo htmlspecialchars($file['name']); ?>
                                                </h6>
                                                <small class="text-muted d-block" style="font-size: 0.78rem;">
                                                    <?php if ($isLoggedIn): ?>
                                                        <?php if (!empty($fileCertId)): ?>
                                                            <i class="fas fa-shield-alt text-success me-1"></i> Sertifikat Digital (<?php echo htmlspecialchars($fileCertId); ?>) • Tap untuk Melihat Detail
                                                        <?php else: ?>
                                                            <i class="fas fa-file-pdf text-danger me-1"></i> Sertifikat / Berkas PDF • Tap untuk Membuka Pratinjau
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <i class="fas fa-lock text-primary me-1"></i> Perlu Masuk untuk Melihat Sertifikat
                                                    <?php endif; ?>
                                                </small>
                                            </div>
                                        </div>
                                        <div class="chevron-box ms-2">
                                            <i class="fas fa-chevron-right"></i>
                                        </div>
                                    </div>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>

                    <!-- TOMBOL MUAT LEBIH BANYAK HANYA UNTUK FOLDER TEMPAT FILE TERSEBUT BERADA -->
                    <?php if (!$viewAll && !empty($matchedParentFolderId)): ?>
                        <div class="text-center mt-3 mb-4">
                            <a href="cert-list.php?cert_id=<?php echo urlencode($prefix); ?>&folder_id=<?php echo urlencode($matchedParentFolderId); ?>&view_all=1" class="btn btn-outline-primary rounded-pill px-4 py-2.5 fw-semibold small shadow-sm">
                                <i class="fas fa-folder-open me-2"></i> Muat Lebih Banyak Berkas di Folder Ini
                            </a>
                        </div>
                    <?php endif; ?>

                <?php endif; ?>

            <?php endif; ?>

        </div>
    </div>

    <!-- MODAL LOGIN PORTAL (OTP-ONLY VERIFICATION) -->
    <div class="modal fade" id="modalLoginPortal" tabindex="-1" aria-labelledby="modalLoginPortalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 480px;">
            <div class="modal-content modal-login-content">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 pt-1 text-center">
                    <div class="login-logo-wrap mb-3 text-center">
                        <img src="logo/logo_pas_basic.png" alt="Logo PT Pananjung Anugrah Solution" style="height: 56px; max-width: 100%; object-fit: contain;" onerror="this.onerror=null; this.src='https://www.pascalibration.com/wp-content/uploads/2023/09/logo_pas_basic.png';">
                    </div>
                    <h4 class="fw-bold text-dark mb-1" id="modalLoginPortalLabel">Masuk ke Portal Sertifikat</h4>
                    <p class="text-muted small mb-4" id="modalSubTitle">
                        Masukkan alamat email perusahaan Anda untuk verifikasi melalui kode OTP.
                    </p>

                    <div id="otpSection">
                        <!-- STEP 1: FORM INPUT EMAIL -->
                        <div id="otpStepEmail">
                            <div class="mb-3 text-start">
                                <label class="form-label small fw-bold text-secondary">Alamat Email Perusahaan</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="far fa-envelope text-muted"></i></span>
                                    <input type="email" id="inputClientEmail" class="form-control border-start-0" placeholder="nama@perusahaan.com" autocomplete="email">
                                </div>
                                <div class="form-text" style="font-size: 0.72rem;">*Email terdaftar yang diberikan hak akses sertifikat oleh PT PAS</div>
                            </div>
                            <button type="button" id="btnRequestOtp" class="btn btn-primary w-100 py-2.5 rounded-pill fw-semibold shadow-sm" onclick="sendOtpRequest()">
                                Login
                            </button>
                        </div>

                        <!-- STEP 2: FORM INPUT KODE OTP -->
                        <div id="otpStepCode" style="display: none;">
                            <div class="alert alert-success py-2 px-3 small rounded-3 mb-3 text-start" id="otpSentAlert">
                                <i class="fas fa-check-circle me-1"></i> Kode OTP telah dikirimkan ke <strong id="displayTargetEmail"></strong>
                            </div>
                            <div class="mb-3 text-start">
                                <label class="form-label small fw-bold text-secondary">Masukkan 6 Digit Kode OTP</label>
                                <input type="text" id="inputClientOtp" class="form-control text-center font-monospace fw-bold fs-4" placeholder="••••••" maxlength="6" autocomplete="one-time-code" style="letter-spacing: 6px;">
                                <div class="d-flex justify-content-between align-items-center mt-2 small">
                                    <span class="text-muted" style="font-size: 0.72rem;">*Berlaku selama 10 menit</span>
                                    <a href="javascript:void(0)" onclick="resendOtp()" class="text-decoration-none fw-semibold" style="font-size: 0.75rem;">Kirim Ulang OTP</a>
                                </div>
                            </div>
                            <button type="button" id="btnVerifyOtp" class="btn btn-primary w-100 py-2.5 rounded-pill fw-semibold shadow-sm mb-2" onclick="verifyOtpRequest()">
                                <i class="fas fa-sign-in-alt me-1"></i> Verifikasi & Masuk
                            </button>
                            <button type="button" class="btn btn-link btn-sm text-secondary text-decoration-none" onclick="backToEmailStep()">
                                <i class="fas fa-arrow-left me-1"></i> Ganti Email
                            </button>
                        </div>

                        <!-- Pesan Status / Error OTP -->
                        <div id="otpFeedback" class="mt-3 small" style="display: none;"></div>
                    </div>

                    <!-- BANNER DAFTAR AKSES KLIEN BARU -->
                    <div class="alert alert-light border rounded-3 p-3 mt-4 text-start small">
                        <div class="d-flex align-items-start gap-2">
                            <i class="fas fa-info-circle text-primary mt-1"></i>
                            <div>
                                <span class="fw-bold text-dark">Belum memiliki akses?</span>
                                <div class="text-muted mt-1" style="font-size: 0.76rem;">
                                    Daftarkan akun Email Anda untuk mendapatkan izin unduh & lihat sertifikat digital.
                                </div>
                                <a href="https://pascalibration.com/formRegister" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3 mt-2 fw-semibold">
                                    <i class="fas fa-file-signature me-1"></i> Form Pendaftaran Akses Sertifikat Digital
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="py-3 text-center text-muted border-top bg-white mt-auto small">
        <div class="container">
            &copy; <?php echo date('Y'); ?> <strong>PT PANANJUNG ANUGRAH SOLUTION</strong>. Smart Paperless Calibration System.
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const currentPrefix = <?php echo json_encode($prefix); ?>;
        let selectedTargetFileId = <?php echo json_encode($fileId); ?>;
        let selectedTargetCertId = '';
        let currentOtpEmail = '';

        document.addEventListener('DOMContentLoaded', function() {
            // Enter key trigger for email / otp input
            const inputEmail = document.getElementById('inputClientEmail');
            if (inputEmail) {
                inputEmail.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        sendOtpRequest();
                    }
                });
            }

            const inputOtp = document.getElementById('inputClientOtp');
            if (inputOtp) {
                inputOtp.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        verifyOtpRequest();
                    }
                });
            }

            <?php if ($requireLoginModal): ?>
                openLoginModal(<?php echo json_encode($fileId); ?>, '', <?php echo json_encode($prefix); ?>);
            <?php endif; ?>
        });

        // Buka Modal Login (OTP-Only)
        function openLoginModal(fileId = '', fileName = '', fileCertId = '') {
            selectedTargetFileId = fileId || '';
            selectedTargetCertId = fileCertId || '';
            
            const subTitle = document.getElementById('modalSubTitle');
            if (subTitle) {
                if (fileName) {
                    subTitle.innerHTML = 'Akses untuk berkas <strong>' + fileName + '</strong> dilindungi. Masuk dengan Email Perusahaan via OTP:';
                } else {
                    subTitle.textContent = 'Masukkan alamat email perusahaan Anda untuk verifikasi melalui kode OTP.';
                }
            }

            clearOtpFeedback();
            const stepEmail = document.getElementById('otpStepEmail');
            const stepCode  = document.getElementById('otpStepCode');
            if (stepEmail) stepEmail.style.display = 'block';
            if (stepCode)  stepCode.style.display = 'none';

            const modalEl = document.getElementById('modalLoginPortal');
            if (modalEl) {
                if (window.bootstrap && bootstrap.Modal) {
                    const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
                    modal.show();
                } else {
                    modalEl.classList.add('show');
                    modalEl.style.display = 'block';
                }
            }
        }

        // =====================================================================
        // CLIENT OTP HANDLER (EMAIL PERUSAHAAN)
        // =====================================================================
        function showOtpFeedback(msg, isSuccess = false) {
            const fb = document.getElementById('otpFeedback');
            if (!fb) return;
            fb.style.display = 'block';
            fb.className = 'mt-3 small ' + (isSuccess ? 'text-success fw-semibold' : 'text-danger fw-semibold');
            fb.innerHTML = (isSuccess ? '<i class="fas fa-check-circle me-1"></i>' : '<i class="fas fa-exclamation-circle me-1"></i>') + msg;
        }

        function clearOtpFeedback() {
            const fb = document.getElementById('otpFeedback');
            if (fb) fb.style.display = 'none';
        }

        function sendOtpRequest() {
            const emailInput = document.getElementById('inputClientEmail');
            const btn = document.getElementById('btnRequestOtp');
            if (!emailInput || !btn) return;

            const email = emailInput.value.trim();
            if (!email) {
                showOtpFeedback('Silakan ketik alamat email perusahaan Anda.');
                return;
            }

            clearOtpFeedback();
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Mengirim OTP...';

            const fd = new FormData();
            fd.append('email', email);

            fetch('cert-list.php?action=send_otp', {
                method: 'POST',
                body: fd
            })
            .then(r => r.json())
            .then(res => {
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-paper-plane me-1"></i> Kirim Kode OTP';

                if (res.success) {
                    currentOtpEmail = email;
                    document.getElementById('otpStepEmail').style.display = 'none';
                    document.getElementById('otpStepCode').style.display = 'block';
                    document.getElementById('displayTargetEmail').textContent = email;
                    const otpInput = document.getElementById('inputClientOtp');
                    if (otpInput) {
                        otpInput.value = '';
                        otpInput.focus();
                    }
                } else {
                    showOtpFeedback(res.message || 'Gagal mengirim OTP.');
                }
            })
            .catch(err => {
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-paper-plane me-1"></i> Kirim Kode OTP';
                showOtpFeedback('Terjadi kesalahan jaringan: ' + err.message);
            });
        }

        function verifyOtpRequest() {
            const otpInput = document.getElementById('inputClientOtp');
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
            fd.append('email', currentOtpEmail);
            fd.append('otp', otp);
            fd.append('target_file_id', selectedTargetFileId || '');
            fd.append('cert_id', selectedTargetCertId || currentPrefix || '');

            fetch('cert-list.php?action=verify_otp', {
                method: 'POST',
                body: fd
            })
            .then(r => r.json())
            .then(res => {
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-sign-in-alt me-1"></i> Verifikasi & Masuk';

                if (res.success) {
                    showOtpFeedback('Verifikasi berhasil! Mengalihkan ke sertifikat...', true);
                    window.location.href = res.redirect || 'cert-list.php';
                } else {
                    showOtpFeedback(res.message || 'Kode OTP tidak valid.');
                }
            })
            .catch(err => {
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-sign-in-alt me-1"></i> Verifikasi & Masuk';
                showOtpFeedback('Terjadi kesalahan jaringan: ' + err.message);
            });
        }

        function resendOtp() {
            if (!currentOtpEmail) return;
            clearOtpFeedback();
            showOtpFeedback('Mengirim ulang kode OTP...', true);

            const fd = new FormData();
            fd.append('email', currentOtpEmail);

            fetch('cert-list.php?action=send_otp', {
                method: 'POST',
                body: fd
            })
            .then(r => r.json())
            .then(res => {
                if (res.success) {
                    showOtpFeedback('Kode OTP baru telah dikirimkan ke ' + currentOtpEmail, true);
                } else {
                    showOtpFeedback(res.message || 'Gagal mengirim ulang OTP.');
                }
            })
            .catch(err => {
                showOtpFeedback('Gagal mengirim ulang: ' + err.message);
            });
        }

        function backToEmailStep() {
            clearOtpFeedback();
            document.getElementById('otpStepCode').style.display = 'none';
            document.getElementById('otpStepEmail').style.display = 'block';
        }
    </script>

</body>
</html>
