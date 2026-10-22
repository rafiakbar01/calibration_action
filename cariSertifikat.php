<?php
// ============================================================================
// cariSertifikat.php  Portal Pencarian Sertifikat Digital (Security Hardened)
// PT PANANJUNG ANUGRAH SOLUTION
// ============================================================================
// FLOW & SECURITY:
// 1. User wajib login menggunakan Google OAuth (email terdaftar).
// 2. Sistem memeriksa hak akses email user ke folder/subfolder di Google Drive.
// 3. User HANYA DAPAT MELIHAT folder dan berkas yang memang diizinkan untuk emailnya.
// 4. Pencarian (Search) DIBATASI KETAT hanya di dalam lingkup folder milik user tersebut.
//    Pencarian nama PT lain TIDAK AKAN PERNAH memunculkan berkas/folder milik pihak lain.
// 5. Klik berkas sertifikat -> redirect aman ke paperless.pascalibration.com/sertifikat/gdrive-view
// ============================================================================

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 0); // Ubah ke 1 saat debugging

require_once __DIR__ . '/db_customer.php';

// =========================================================================
// KONFIGURASI
// =========================================================================
$googleClientId     = getenv('GOOGLE_CLIENT_ID') ?: ($_ENV['GOOGLE_CLIENT_ID'] ?? '');
$googleClientSecret = getenv('GOOGLE_CLIENT_SECRET') ?: ($_ENV['GOOGLE_CLIENT_SECRET'] ?? '');

// Folder ID utama di Google Drive yang berisi kumpulan folder sertifikat klien/PT
// Bisa diisi ID langsung (contoh: 19qvHuJ0q84DARVA8uf0DLPq7Vtpv4Hwq) atau URL lengkap Google Drive
$rootFolderId = '19qvHuJ0q84DARVA8uf0DLPq7Vtpv4Hwq';

// SANITASI OTOMATIS: Jika dimasukkan URL lengkap Google Drive, ekstrak ID-nya saja
if (preg_match('/folders\/([a-zA-Z0-9_-]+)/i', $rootFolderId, $matchId)) {
    $rootFolderId = $matchId[1];
} elseif (preg_match('/[?&]id=([a-zA-Z0-9_-]+)/i', $rootFolderId, $matchId)) {
    $rootFolderId = $matchId[1];
}

// Deteksi Host & URL Halaman Saat Ini (Mendukung Masking URL via .htaccess)
$currentHost = $_SERVER['HTTP_HOST'] ?? 'pascalibration.com';
$requestPath = strtok($_SERVER['REQUEST_URI'] ?? '', '?');
$pageUrl     = (!empty($requestPath) && $requestPath !== '/') ? $requestPath : '/cariSertifikat.php';
$redirectUri = 'https://' . $currentHost . $pageUrl;

// Path file credentials Service Account
$credentialsPath = __DIR__ . '/credentials.json';

// URL Viewer di Paperless
$paperlessUrl = 'https://paperless.pascalibration.com/sertifikat/gdrive-view';

// =========================================================================
// 1. HELPER NATIVE GDRIVE & AUTH
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
 * Cek apakah user email memiliki akses eksplisit ke file/folder Google Drive
 * STRICT: Menghilangkan izin tipe 'anyone' (tidak boleh publik).
 * Hanya menerima email langsung atau domain email yang cocok.
 */
function checkUserAccess($fileId, $accessToken, $userEmail) {
    if (empty($userEmail) || empty($fileId)) return false;
    
    $permUrl = "https://www.googleapis.com/drive/v3/files/{$fileId}/permissions?fields=permissions(id,emailAddress,role,type,domain)&supportsAllDrives=true";
    $permData = curlGDriveAPI($permUrl, $accessToken);

    if (!empty($permData['permissions'])) {
        $userEmailLower = strtolower($userEmail);
        $userDomain = substr(strrchr($userEmailLower, "@"), 1);

        foreach ($permData['permissions'] as $perm) {
            $type = $perm['type'] ?? '';
            
            // Cocokkan email langsung (user atau group)
            if ($type === 'user' || $type === 'group') {
                $allowedEmail = strtolower($perm['emailAddress'] ?? '');
                if (!empty($allowedEmail) && $allowedEmail === $userEmailLower) {
                    return true;
                }
            }
            
            // Cocokkan domain email jika ada izin domain perusahaan
            if ($type === 'domain') {
                $allowedDomain = strtolower($perm['domain'] ?? '');
                if (!empty($allowedDomain) && $allowedDomain === $userDomain) {
                    return true;
                }
            }
        }
    }
    return false;
}

/**
 * Periksa hak akses email dari objek item yang sudah memuat array permissions
 * Berjalan instan di RAM server tanpa HTTP request tambahan
 */
function checkItemAccess($item, $userEmail) {
    if (empty($userEmail)) return false;
    $userEmailLower = strtolower($userEmail);
    $userDomain = substr(strrchr($userEmailLower, "@"), 1);
    
    if (!empty($item['permissions']) && is_array($item['permissions'])) {
        foreach ($item['permissions'] as $perm) {
            $type = $perm['type'] ?? '';
            if ($type === 'user' || $type === 'group') {
                $allowedEmail = strtolower($perm['emailAddress'] ?? '');
                if (!empty($allowedEmail) && $allowedEmail === $userEmailLower) {
                    return true;
                }
            }
            if ($type === 'domain') {
                $allowedDomain = strtolower($perm['domain'] ?? '');
                if (!empty($allowedDomain) && $allowedDomain === $userDomain) {
                    return true;
                }
            }
        }
    }
    return false;
}

/**
 * Ambil daftar file/folder di dalam folder tertentu
 * Mengambil sekaligus data permissions agar hemat kuota dan super cepat (1 API Call)
 */
function listDriveFiles($parentFolderId, $accessToken, $searchQuery = '', $includePermissions = true) {
    $allFiles = [];
    $pageToken = null;
    
    $fields = 'nextPageToken,files(id,name,mimeType,parents,modifiedTime,size' . ($includePermissions ? ',permissions(emailAddress,role,type,domain)' : '') . ')';
    
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
    $url = "https://www.googleapis.com/drive/v3/files/{$folderId}?fields=id,name,parents,mimeType&supportsAllDrives=true";
    return curlGDriveAPI($url, $accessToken);
}

/**
 * Ambil isi BANYAK folder sekaligus dalam minimal API call (batch).
 * Jauh lebih efisien daripada memanggil listDriveFiles satu-per-satu.
 * Menerima array parent IDs, mengembalikan semua anak-anaknya.
 */
function batchListDriveFiles($parentFolderIds, $accessToken, $includePermissions = true) {
    if (empty($parentFolderIds)) return [];
    $allFiles = [];
    $fields   = 'nextPageToken,files(id,name,mimeType,parents,modifiedTime,size'
              . ($includePermissions ? ',permissions(emailAddress,role,type,domain)' : '')
              . ')';
    // Pecah menjadi chunk 15 parent setiap query (batas Drive API)
    $chunks = array_chunk(array_values($parentFolderIds), 15);
    foreach ($chunks as $chunk) {
        $parentOrs = array_map(fn($id) => "'{$id}' in parents", $chunk);
        $q         = '(' . implode(' or ', $parentOrs) . ') and trashed = false';
        $pageToken = null;
        do {
            $params = [
                'q'                         => $q,
                'fields'                    => $fields,
                'orderBy'                   => 'folder,name',
                'pageSize'                  => 100,
                'supportsAllDrives'         => 'true',
                'includeItemsFromAllDrives' => 'true',
            ];
            if ($pageToken) $params['pageToken'] = $pageToken;
            $apiUrl  = 'https://www.googleapis.com/drive/v3/files?' . http_build_query($params);
            $resData = curlGDriveAPI($apiUrl, $accessToken);
            if (!empty($resData['files'])) {
                $allFiles = array_merge($allFiles, $resData['files']);
            }
            $pageToken = $resData['nextPageToken'] ?? null;
        } while ($pageToken);
    }
    return $allFiles;
}

/**
 * DEEP SCAN (BFS)  Temukan SEMUA item yang dapat diakses user secara rekursif.
 *
 * Mendukung 3 skenario akses:
 *   1. Folder level root langsung dibagikan ke user â†’ tampil di beranda
 *   2. Sub-folder di dalam folder yang tidak dibagikan â†’ tetap tampil di beranda
 *   3. File individual yang dibagikan langsung ke user â†’ tampil di beranda
 *
 * Menggunakan batch API calls untuk efisiensi tinggi.
 * Hasil di-cache di session agar halaman berikutnya instan.
 *
 * Returns array:
 *   'accessibleFolderIds' â†’ semua folder ID yang boleh dibrowse user
 *   'accessibleFileIds'   â†’ semua file ID dengan akses langsung ke user
 *   'displayItems'        â†’ item "entry point" yang ditampilkan di halaman beranda [id => item]
 */
function deepScanUserAccess($rootFolderId, $accessToken, $userEmail, $forceRefresh = false) {
    if (empty($userEmail)) {
        return ['accessibleFolderIds' => [], 'accessibleFileIds' => [], 'displayItems' => []];
    }

    $cacheKey = 'deep_access_v3_' . md5($userEmail . '_' . $rootFolderId);
    if (!$forceRefresh && isset($_SESSION[$cacheKey]) && !empty($_SESSION[$cacheKey])) {
        return $_SESSION[$cacheKey];
    }

    $accessibleFolderIds = [];
    $accessibleFileIds   = [];
    $displayItems        = [];   // Entry points untuk halaman beranda
    $visited             = [];   // Hindari proses berulang

    //  STEP 1: Cek apakah root folder langsung dibagikan ke user 
    $hasRootAccess = checkUserAccess($rootFolderId, $accessToken, $userEmail);

    if ($hasRootAccess) {
        // Root dibagikan â†’ tampilkan semua anak root sebagai entry points
        $accessibleFolderIds[] = $rootFolderId;
        $rootChildren = listDriveFiles($rootFolderId, $accessToken, '', false);
        foreach ($rootChildren as $item) {
            $displayItems[$item['id']] = $item;
            if ($item['mimeType'] === 'application/vnd.google-apps.folder') {
                $accessibleFolderIds[] = $item['id'];
            } else {
                $accessibleFileIds[] = $item['id'];
            }
        }
        $result = compact('accessibleFolderIds', 'accessibleFileIds', 'displayItems');
        $_SESSION[$cacheKey] = $result;
        return $result;
    }

    //  STEP 2: BFS Deep Scan  cari akses di seluruh hierarki 
    // Format queue: [$folderId, $parentHasAccess]
    // $parentHasAccess = true â†’ anak-anaknya otomatis accessible (warisan)
    // $parentHasAccess = false â†’ perlu cek izin setiap item secara individual
    $toScan  = [[$rootFolderId, false]];
    $visited = [$rootFolderId];
    $maxScanDepth = 5; // Kedalaman maksimal scan

    for ($depth = 0; $depth < $maxScanDepth && !empty($toScan); $depth++) {
        $noAccessParents   = [];
        $fullAccessParents = [];

        foreach ($toScan as [$fid, $pAccess]) {
            if ($pAccess) $fullAccessParents[] = $fid;
            else          $noAccessParents[]   = $fid;
        }

        $nextScan = [];

        //  Anak-anak folder TANPA akses: cek izin setiap item 
        if (!empty($noAccessParents)) {
            $children = batchListDriveFiles($noAccessParents, $accessToken, true);
            foreach ($children as $item) {
                $itemId   = $item['id'];
                $isFolder = ($item['mimeType'] === 'application/vnd.google-apps.folder');

                if (in_array($itemId, $visited)) continue;
                $visited[] = $itemId;

                if (checkItemAccess($item, $userEmail)) {
                    // âœ… Akses langsung ditemukan  ini adalah entry point!
                    $displayItems[$itemId] = $item;
                    if ($isFolder) {
                        $accessibleFolderIds[] = $itemId;
                        // Anak-anaknya akan mewarisi akses â†’ scan dengan flag true
                        $nextScan[] = [$itemId, true];
                    } else {
                        $accessibleFileIds[] = $itemId;
                    }
                } elseif ($isFolder) {
                    // Tidak ada akses di sini, tapi lanjut scan lebih dalam
                    $nextScan[] = [$itemId, false];
                }
            }
        }

        //  Anak-anak folder DENGAN akses penuh (warisan): semua accessible 
        if (!empty($fullAccessParents)) {
            $children = batchListDriveFiles($fullAccessParents, $accessToken, false);
            foreach ($children as $item) {
                $itemId   = $item['id'];
                $isFolder = ($item['mimeType'] === 'application/vnd.google-apps.folder');

                if (in_array($itemId, $visited)) continue;
                $visited[] = $itemId;

                if ($isFolder) {
                    if (!in_array($itemId, $accessibleFolderIds)) {
                        $accessibleFolderIds[] = $itemId;
                    }
                    // Daftarkan juga anak-anaknya (satu level lebih dalam) agar bisa di-browse
                    $nextScan[] = [$itemId, true];
                } else {
                    if (!in_array($itemId, $accessibleFileIds)) {
                        $accessibleFileIds[] = $itemId;
                    }
                }
            }
        }

        $toScan = $nextScan;
    }

    $result = compact('accessibleFolderIds', 'accessibleFileIds', 'displayItems');
    if (!empty($accessibleFolderIds) || !empty($displayItems)) {
        $_SESSION[$cacheKey] = $result;
    }
    return $result;
}

/**
 * Cek apakah folder tertentu boleh dibrowse oleh user.
 * Menggunakan accessData dari deepScanUserAccess.
 * Fallback: telusuri silsilah parent untuk kasus folder yang baru dibuat setelah scan.
 *
 * @param string $folderId        ID folder yang ingin diakses
 * @param string $rootFolderId    ID root folder
 * @param array  $accessData      Hasil deepScanUserAccess()
 * @param string $accessToken     Service account token
 */
function isFolderAllowedForUser($folderId, $rootFolderId, $accessData, $accessToken) {
    if (empty($folderId) || $folderId === $rootFolderId) {
        return true;
    }

    // Cek langsung di daftar folder yang diizinkan
    if (in_array($folderId, $accessData['accessibleFolderIds'] ?? [])) {
        return true;
    }

    // Cek di displayItems (entry points)
    if (isset($accessData['displayItems'][$folderId])) {
        return true;
    }

    // Fallback: telusuri parent ke atas (untuk konten baru setelah cache dibuat)
    $currentId = $folderId;
    $maxDepth  = 8;
    while (!empty($currentId) && $currentId !== $rootFolderId && $maxDepth-- > 0) {
        $info     = getFolderInfo($currentId, $accessToken);
        if (!$info || !empty($info['error'])) break;
        $parentId = $info['parents'][0] ?? null;
        if (!$parentId) break;
        if (in_array($parentId, $accessData['accessibleFolderIds'] ?? [])
            || isset($accessData['displayItems'][$parentId])) {
            return true;
        }
        $currentId = $parentId;
    }
    return false;
}

/**
 * Kumpulkan semua ID folder dan subfolder di bawah daftar folder tertentu
 * Digunakan untuk membatasi query pencarian (search)
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
 * PENCARIAN KETAT (SCOPED SEARCH):
 * Hanya mencari file/folder di dalam folder-folder yang secara legal dimiliki user.
 * Sama sekali tidak menyentuh folder PT lain di Google Drive.
 */
function searchDriveStrictScoped($allowedParentFolderIds, $searchQuery, $accessToken) {
    if (empty($allowedParentFolderIds) || empty(trim($searchQuery))) {
        return [];
    }
    
    // 1. Kumpulkan semua ID folder dan seluruh subfoldernya
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
 * PROGRESSIVE SCAN  Level 0+1 saja (cepat, untuk load awal).
 * Menyimpan status BFS di session untuk dilanjutkan via AJAX.
 *
 * Mendukung tiga skenario akses:
 *   1. Folder root langsung dibagikan ke user
 *   2. Sub-folder dibagikan (parent tidak perlu dibagikan)
 *   3. File individual dibagikan langsung
 *
 * Returns array:
 *   'accessibleFolderIds'  semua folder ID yang boleh dibrowse user
 *   'accessibleFileIds'    semua file ID yang punya akses langsung
 *   'displayItems'         entry points untuk beranda [id => item]
 *   'scanComplete'         true jika tidak ada level lebih dalam yang perlu di-scan
 */
function initProgressiveScan($rootFolderId, $accessToken, $userEmail, $forceRefresh = false) {
    if (empty($userEmail)) {
        return ['accessibleFolderIds' => [], 'accessibleFileIds' => [], 'displayItems' => [], 'scanComplete' => true];
    }

    $finalCacheKey = 'deep_access_v3_' . md5($userEmail . '_' . $rootFolderId);
    $stateKey      = 'scan_bfs_state_' . md5($userEmail . '_' . $rootFolderId);

    // Jika scan lengkap sudah tersimpan, kembalikan langsung (instan)
    if (!$forceRefresh && isset($_SESSION[$finalCacheKey]) && !empty($_SESSION[$finalCacheKey])) {
        return array_merge($_SESSION[$finalCacheKey], ['scanComplete' => true]);
    }

    // Reset semua cache jika dipaksa refresh
    if ($forceRefresh) {
        unset($_SESSION[$finalCacheKey], $_SESSION[$stateKey]);
    }

    $accessibleFolderIds = [];
    $accessibleFileIds   = [];
    $displayItems        = [];

    //  Level 0: Cek apakah root folder langsung dibagikan ke user â”€
    $hasRootAccess = checkUserAccess($rootFolderId, $accessToken, $userEmail);

    if ($hasRootAccess) {
        $accessibleFolderIds[] = $rootFolderId;
        $rootChildren = listDriveFiles($rootFolderId, $accessToken, '', false);
        foreach ($rootChildren as $item) {
            $displayItems[$item['id']] = $item;
            if ($item['mimeType'] === 'application/vnd.google-apps.folder') {
                $accessibleFolderIds[] = $item['id'];
            } else {
                $accessibleFileIds[] = $item['id'];
            }
        }
        $result = compact('accessibleFolderIds', 'accessibleFileIds', 'displayItems');
        $_SESSION[$finalCacheKey] = $result;
        return array_merge($result, ['scanComplete' => true]);
    }

    //  Level 1: Scan anak-anak root dengan permission check â”€
    $visited    = [$rootFolderId];
    $children   = batchListDriveFiles([$rootFolderId], $accessToken, true);
    $nextToScan = []; // Queue untuk AJAX level berikutnya

    foreach ($children as $item) {
        $itemId   = $item['id'];
        $isFolder = ($item['mimeType'] === 'application/vnd.google-apps.folder');

        if (in_array($itemId, $visited)) continue;
        $visited[] = $itemId;

        if (checkItemAccess($item, $userEmail)) {
            // âœ… Entry point ditemukan di Level 1
            $displayItems[$itemId] = $item;
            if ($isFolder) {
                $accessibleFolderIds[] = $itemId;
                $nextToScan[] = [$itemId, true]; // Anak-anaknya mewarisi akses
            } else {
                $accessibleFileIds[] = $itemId;
            }
        } elseif ($isFolder) {
            // Tidak ada akses di sini  simpan untuk scan lebih dalam via AJAX
            $nextToScan[] = [$itemId, false];
        }
    }

    $scanComplete = empty($nextToScan); // Tidak ada yang perlu di-scan lebih dalam

    // Simpan state BFS untuk dilanjutkan via AJAX
    $_SESSION[$stateKey] = [
        'accessibleFolderIds' => $accessibleFolderIds,
        'accessibleFileIds'   => $accessibleFileIds,
        'displayItems'        => $displayItems,
        'visited'             => $visited,
        'nextToScan'          => $nextToScan,
        'depth'               => 1,
        'maxDepth'            => 5,
        'complete'            => $scanComplete,
    ];

    if ($scanComplete) {
        // Scan sudah selesai di Level 1, simpan sebagai cache final
        $_SESSION[$finalCacheKey] = compact('accessibleFolderIds', 'accessibleFileIds', 'displayItems');
    }

    return compact('accessibleFolderIds', 'accessibleFileIds', 'displayItems', 'scanComplete');
}

/**
 * Build breadcrumb path dari folder ID ke base folder milik user
 */
function buildBreadcrumbsToUserBase($folderId, $accessibleBaseFolders, $accessToken) {
    $breadcrumbs = [];
    $currentId = $folderId;
    $maxDepth = 8;

    while ($currentId && $maxDepth > 0) {
        $info = getFolderInfo($currentId, $accessToken);
        if (!$info || !empty($info['error'])) break;

        array_unshift($breadcrumbs, [
            'id'   => $info['id'],
            'name' => $info['name'] ?? 'Folder'
        ]);

        // Berhenti jika sudah sampai di base folder milik user
        if (isset($accessibleBaseFolders[$currentId])) {
            break;
        }

        $currentId = $info['parents'][0] ?? null;
        $maxDepth--;
    }

    return $breadcrumbs;
}

// =========================================================================
// 2. HANDLE LOGOUT & REFRESH AKSES
// =========================================================================
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: " . $pageUrl);
    exit;
}

// =========================================================================
// 3. HANDLE GOOGLE OAUTH CALLBACK
// =========================================================================
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
    $res = curl_exec($ch);
    curl_close($ch);

    $tokenInfo = json_decode($res, true);
    if (!empty($tokenInfo['access_token'])) {
        $ch2 = curl_init('https://www.googleapis.com/oauth2/v2/userinfo');
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch2, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $tokenInfo['access_token']]);
        $userInfoRes = curl_exec($ch2);
        curl_close($ch2);

        $userInfo = json_decode($userInfoRes, true);
        if (!empty($userInfo['email'])) {
            $_SESSION['user_email']   = strtolower($userInfo['email']);
            $_SESSION['user_name']    = $userInfo['name'] ?? '';
            $_SESSION['user_picture'] = $userInfo['picture'] ?? '';
            
            $returnUrl = $_SESSION['oauth_return_url'] ?? $pageUrl;
            unset($_SESSION['oauth_return_url']);
            header("Location: " . $returnUrl);
            exit;
        }
    }
    
    header("Location: " . $pageUrl . "?error=oauth_failed");
    exit;
}

// =========================================================================
// 3b. HANDLE AJAX OTP EMAIL PERUSAHAAN (pascalib_customer)
// =========================================================================
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
    $inputEmail = strtolower(trim($_POST['email'] ?? ''));
    $inputOtp   = trim($_POST['otp'] ?? '');
    
    $res = verifyCustomerOtp($inputEmail, $inputOtp);
    if ($res['success']) {
        $client = $res['client'];
        $loggedEmail = strtolower($client['logged_email'] ?? $inputEmail);
        $_SESSION['user_email']   = $loggedEmail;

        // Gunakan nama masing-masing email tambahan, TIDAK BOLEH pakai nama akun utama perusahaan
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
        $_SESSION['user_picture'] = '';
        $_SESSION['auth_source']  = 'database'; // Tanda login via database pascalib_customer
        $_SESSION['is_additional_email'] = !empty($client['is_additional_email']);
        echo json_encode(['success' => true, 'redirect' => $pageUrl]);
    } else {
        echo json_encode(['success' => false, 'message' => $res['message']]);
    }
    exit;
}

// =========================================================================
// 4. TANGKAP PARAMETER & CEK SESSION
// =========================================================================
$userEmail   = strtolower($_SESSION['user_email'] ?? '');
$userName    = $_SESSION['user_name'] ?? '';
$userPicture = $_SESSION['user_picture'] ?? '';
$isLoggedIn  = !empty($userEmail);

// Sinkronisasi otomatis data nama pengguna dari database client_access
if ($isLoggedIn && function_exists('getCustomerByEmail')) {
    $custInfo = getCustomerByEmail($userEmail);
    if ($custInfo) {
        if (!empty($custInfo['is_additional_email'])) {
            // Email tambahan: HANYA gunakan nama akun tambahan miliknya sendiri
            if (!empty($custInfo['additional_nama'])) {
                $userName = $custInfo['additional_nama'];
            } else {
                $emailPrefix = explode('@', $userEmail)[0];
                $userName = ucwords(str_replace(['.', '_', '-'], ' ', $emailPrefix));
            }
            $_SESSION['is_additional_email'] = true;
        } else {
            // Email akun utama
            if (!empty($custInfo['nama'])) {
                $userName = $custInfo['nama'];
            }
            $_SESSION['is_additional_email'] = false;
        }
        if (!empty($custInfo['perusahaan'])) {
            $_SESSION['user_company'] = $custInfo['perusahaan'];
        }
        $_SESSION['user_name'] = $userName;
    }
}

$currentFolderId = trim($_GET['folder_id'] ?? '');
$searchQuery     = trim($_GET['search'] ?? '');
$action          = $_GET['action'] ?? '';
$fileId          = trim($_GET['file_id'] ?? '');
$errorMsg        = $_GET['error'] ?? '';
$refreshAccess   = isset($_GET['refresh_access']) && $_GET['refresh_access'] == '1';
$isDebugMode     = isset($_GET['debug']) && $_GET['debug'] == '1';

// URL Google OAuth
$googleAuthUrl = "https://accounts.google.com/o/oauth2/v2/auth?" . http_build_query([
    'client_id'     => $googleClientId,
    'redirect_uri'  => $redirectUri,
    'response_type' => 'code',
    'scope'         => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile',
    'access_type'   => 'online',
    'prompt'        => 'select_account'
]);

// =========================================================================
// 4b. HANDLE AJAX: SCAN LEVEL BERIKUTNYA (Progressive Loading)
// Dipanggil oleh JavaScript secara bertahap di background
// =========================================================================
if ($action === 'scan_deeper' && $isLoggedIn) {
    header('Content-Type: application/json; charset=utf-8');
    header('X-Robots-Tag: noindex');

    if (($_SESSION['auth_source'] ?? '') === 'database') {
        echo json_encode(['done' => true, 'newItems' => [], 'depth' => 0]);
        exit;
    }

    try {
        $accessToken   = getServiceAccountToken($credentialsPath);
        $stateKey      = 'scan_bfs_state_' . md5($userEmail . '_' . $rootFolderId);
        $finalCacheKey = 'deep_access_v3_'  . md5($userEmail . '_' . $rootFolderId);
        $state         = $_SESSION[$stateKey] ?? null;

        if (!$state || $state['complete']) {
            // Tidak ada yang perlu di-scan, atau sudah selesai
            echo json_encode(['done' => true, 'newItems' => [], 'depth' => 0]);
            exit;
        }

        $toScan              = $state['nextToScan'];
        $visited             = $state['visited'];
        $accessibleFolderIds = $state['accessibleFolderIds'];
        $accessibleFileIds   = $state['accessibleFileIds'];
        $displayItems        = $state['displayItems'];
        $depth               = $state['depth'];
        $maxDepth            = $state['maxDepth'];

        $newDisplayItems = []; // Hanya item BARU yang ditemukan di level ini
        $nextToScan      = []; // Queue untuk level berikutnya

        // Pisahkan berdasarkan status akses parent
        $noAccessParents   = [];
        $fullAccessParents = [];
        foreach ($toScan as [$fid, $pAccess]) {
            if ($pAccess) $fullAccessParents[] = $fid;
            else          $noAccessParents[]   = $fid;
        }

        //  Proses folder TANPA akses: cek permission setiap anak â”€
        if (!empty($noAccessParents)) {
            $children = batchListDriveFiles($noAccessParents, $accessToken, true);
            foreach ($children as $item) {
                $itemId   = $item['id'];
                $isFolder = ($item['mimeType'] === 'application/vnd.google-apps.folder');
                if (in_array($itemId, $visited)) continue;
                $visited[] = $itemId;

                if (checkItemAccess($item, $userEmail)) {
                    // âœ… Entry point baru ditemukan!
                    $newDisplayItems[$itemId]  = $item;
                    $displayItems[$itemId]     = $item;
                    if ($isFolder) {
                        $accessibleFolderIds[] = $itemId;
                        $nextToScan[] = [$itemId, true];
                    } else {
                        $accessibleFileIds[] = $itemId;
                    }
                } elseif ($isFolder && ($depth + 1) < $maxDepth) {
                    // Lanjut scan lebih dalam
                    $nextToScan[] = [$itemId, false];
                }
            }
        }

        //  Proses folder DENGAN akses penuh: semua anak otomatis accessible 
        if (!empty($fullAccessParents)) {
            $children = batchListDriveFiles($fullAccessParents, $accessToken, false);
            foreach ($children as $item) {
                $itemId   = $item['id'];
                $isFolder = ($item['mimeType'] === 'application/vnd.google-apps.folder');
                if (in_array($itemId, $visited)) continue;
                $visited[] = $itemId;

                if ($isFolder) {
                    if (!in_array($itemId, $accessibleFolderIds)) {
                        $accessibleFolderIds[] = $itemId;
                    }
                    if (($depth + 1) < $maxDepth) {
                        $nextToScan[] = [$itemId, true];
                    }
                } else {
                    if (!in_array($itemId, $accessibleFileIds)) {
                        $accessibleFileIds[] = $itemId;
                    }
                }
            }
        }

        $isDone = empty($nextToScan) || (($depth + 1) >= $maxDepth);

        // Update state di session
        $_SESSION[$stateKey] = [
            'accessibleFolderIds' => $accessibleFolderIds,
            'accessibleFileIds'   => $accessibleFileIds,
            'displayItems'        => $displayItems,
            'visited'             => $visited,
            'nextToScan'          => $nextToScan,
            'depth'               => $depth + 1,
            'maxDepth'            => $maxDepth,
            'complete'            => $isDone,
        ];

        if ($isDone) {
            // Simpan sebagai cache final agar visit berikutnya instan
            $_SESSION[$finalCacheKey] = compact('accessibleFolderIds', 'accessibleFileIds', 'displayItems');
        }

        echo json_encode([
            'done'     => $isDone,
            'depth'    => $depth + 1,
            'newItems' => array_values($newDisplayItems),
        ]);

    } catch (Throwable $e) {
        echo json_encode(['error' => $e->getMessage(), 'done' => true, 'newItems' => []]);
    }
    exit;
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
function renderOldCertificateViewer($fileId, $fileName, $pageUrl) {
    $downloadUrl = $pageUrl . '?' . http_build_query([
        'action'  => 'download',
        'file_id' => $fileId
    ]);
    $gdrivePreviewUrl = "https://drive.google.com/file/d/" . urlencode($fileId) . "/preview";
    $backUrl = !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $pageUrl;
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
// 5. HANDLE BUKA & DOWNLOAD FILE (REDIRECT PAPERLESS / STREAM DOWNLOAD DENGAN VERIFIKASI KEAMANAN)
// =========================================================================
if (($action === 'open' || $action === 'download') && !empty($fileId)) {
    if (!$isLoggedIn) {
        $_SESSION['oauth_return_url'] = $_SERVER['REQUEST_URI'];
        header("Location: " . $googleAuthUrl);
        exit;
    }

    try {
        $accessToken = getServiceAccountToken($credentialsPath);
        $authSource  = $_SESSION['auth_source'] ?? 'google';
        $dbClient = getCustomerByEmail($userEmail);
        $isDbUser = ($authSource === 'database') || ($dbClient && $dbClient['status'] === 'active');

        if ($isDbUser) {
            $allowedFids = getCustomerAllowedFolderIds($userEmail);
            $displayItems = [];
            $accessibleFolderIds = [];
            $accessibleFileIds = [];

            foreach ($allowedFids as $fid) {
                $displayItems[$fid] = ['id' => $fid];
                if ($fid === $fileId) {
                    $accessibleFileIds[] = $fid;
                } else {
                    $accessibleFolderIds[] = $fid;
                }
            }
            $scopeFolderIds = !empty($accessibleFolderIds) ? getAllSubfolderIds($accessibleFolderIds, $accessToken) : [];
            $accessibleFolderIds = array_values(array_unique(array_merge($accessibleFolderIds, $scopeFolderIds)));
            $accessData = [
                'accessibleFolderIds' => $accessibleFolderIds,
                'accessibleFileIds'   => $accessibleFileIds,
                'displayItems'        => $displayItems
            ];
        } else {
            $accessData  = deepScanUserAccess($rootFolderId, $accessToken, $userEmail);
        }
        $fileInfo    = getFolderInfo($fileId, $accessToken);

        if (!$fileInfo || !empty($fileInfo['error'])) {
            header("Location: " . $pageUrl . "?error=file_not_found");
            exit;
        }

        // Verifikasi berkas: cek apakah parent-nya accessible, atau file itu sendiri ada di daftar akses
        $parentFolderId = $fileInfo['parents'][0] ?? '';
        $isAuthorized   = false;

        if (!empty($parentFolderId)) {
            $isAuthorized = isFolderAllowedForUser($parentFolderId, $rootFolderId, $accessData, $accessToken);
        }

        // Fallback: cek apakah file ini memiliki akses langsung ke user
        if (!$isAuthorized) {
            $isAuthorized = in_array($fileId, $accessData['accessibleFileIds'])
                         || checkUserAccess($fileId, $accessToken, $userEmail);
        }

        if ($isAuthorized) {
            $fileName = $fileInfo['name'] ?? 'sertifikat.pdf';
            $mimeType = $fileInfo['mimeType'] ?? 'application/pdf';

            // JIKA AKSI ADALAH DOWNLOAD:
            if ($action === 'download') {
                downloadDriveFileStream($fileId, $fileName, $mimeType, $accessToken, $fileInfo['size'] ?? null);
                exit;
            }

            // Cek apakah berkas merupakan Sertifikat Digital PAS (PAS-XXXXXX) atau format sertifikat lama
            $isDigital = false;
            $certId = '';
            if (preg_match('/(PAS-\d+)/i', $fileInfo['name'], $m)) {
                $certId = strtoupper($m[1]);
                $isDigital = true;
            } else {
                $certId = pathinfo($fileInfo['name'], PATHINFO_FILENAME);
            }

            // Jika format sertifikat lama (bukan sertifikat digital), tampilkan viewer khusus dengan tombol Download & preview iframe
            if (!$isDigital) {
                renderOldCertificateViewer($fileId, $fileName, $pageUrl);
                exit;
            }

            $secretKey = 'PAS_CALIBRATION_SECURE_GDRIVE_KEY_2026';
            $sig = substr(hash_hmac('sha256', $fileId . '|' . $certId, $secretKey), 0, 16);

            $targetUrl = $paperlessUrl . "?" . http_build_query([
                'file_id'   => $fileId,
                'cert_id'   => $certId,
                'file_name' => $fileName,
                'sig'       => $sig
            ]);
            header("Location: " . $targetUrl);
            exit;
        } else {
            $errorMsg = 'access_denied';
        }
    } catch (Throwable $e) {
        $errorMsg = 'api_error';
    }
}

// =========================================================================
// 6. PROSES BROWSE & PENCARIAN KETAT (SECURITY SCOPED)
// =========================================================================
$filesFound         = [];
$breadcrumbs        = [];
$currentFolderName  = 'Sertifikat Digital';
$isSearchMode       = false;
$userBaseFolders    = [];
$isFolderForbidden  = false;
$debugInfo          = [];

if ($isLoggedIn) {
    try {
        $accessToken = getServiceAccountToken($credentialsPath);
        $authSource  = $_SESSION['auth_source'] ?? 'google';
        $dbClient = getCustomerByEmail($userEmail);
        $isDbUser = ($authSource === 'database') || ($dbClient && $dbClient['status'] === 'active');

        if ($isDbUser) {
            // Akun Perusahaan (Login Database pascalib_customer atau Akun Google terdaftar di client_access)
            $allowedFids = getCustomerAllowedFolderIds($userEmail);
            $displayItems = [];
            $accessibleFolderIds = [];
            $accessibleFileIds   = [];

            foreach ($allowedFids as $fid) {
                $info = getFolderInfo($fid, $accessToken);
                if ($info && empty($info['error'])) {
                    $displayItems[$fid] = $info;
                    $isFolder = ($info['mimeType'] === 'application/vnd.google-apps.folder');
                    if ($isFolder) {
                        $accessibleFolderIds[] = $fid;
                    } else {
                        $accessibleFileIds[] = $fid;
                    }
                }
            }

            // Kumpulkan seluruh subfolder di bawahnya untuk pencarian aman
            $scopeFolderIds = !empty($accessibleFolderIds) ? getAllSubfolderIds($accessibleFolderIds, $accessToken) : [];
            $accessibleFolderIds = array_values(array_unique(array_merge($accessibleFolderIds, $scopeFolderIds)));

            $accessData = [
                'accessibleFolderIds' => $accessibleFolderIds,
                'accessibleFileIds'   => $accessibleFileIds,
                'displayItems'        => $displayItems,
                'scanComplete'        => true
            ];

            $userBaseFolders = $displayItems;
            $baseFolderIds   = $accessibleFolderIds;
            $scanComplete    = true;
        } else {
            // Akun Google (Google OAuth) — Tetap 100% seperti sebelumnya
            $accessData       = initProgressiveScan($rootFolderId, $accessToken, $userEmail, $refreshAccess);
            $userBaseFolders  = $accessData['displayItems'];
            $baseFolderIds    = $accessData['accessibleFolderIds'];
            $scanComplete     = $accessData['scanComplete'] ?? true;
        }

        if ($isDebugMode) {
            $debugInfo['rootFolderId']        = $rootFolderId;
            $debugInfo['userEmail']           = $userEmail;
            $debugInfo['hasRootAccess']       = checkUserAccess($rootFolderId, $accessToken, $userEmail);
            $debugInfo['totalDisplayItems']   = count($accessData['displayItems']);
            $debugInfo['totalFolders']        = count($accessData['accessibleFolderIds']);
            $debugInfo['totalFiles']          = count($accessData['accessibleFileIds']);
            $debugInfo['displayItems']        = array_map(
                fn($f) => ($f['name'] ?? '?') . ' (' . $f['id'] . ') [' . $f['mimeType'] . ']',
                $accessData['displayItems']
            );
        }

        if (!empty($searchQuery)) {
            // =================================================================
            // MODE PENCARIAN AMAN (SCOPED SEARCH)
            // Cari di dalam SEMUA folder yang accessible untuk user ini
            // =================================================================
            $isSearchMode = true;

            if (empty($baseFolderIds) && empty($accessData['displayItems'])) {
                $filesFound = [];
            } else {
                // Tentukan cakupan pencarian:
                // - Jika sedang di dalam subfolder â†’ cari di dalam subfolder itu
                // - Jika di beranda â†’ cari di seluruh entry-point folder milik user
                if (!empty($currentFolderId)
                    && isFolderAllowedForUser($currentFolderId, $rootFolderId, $accessData, $accessToken)) {
                    $searchScope = [$currentFolderId];
                } else {
                    // Gunakan semua folder ID accessible sebagai scope pencarian
                    $entryFolders = array_keys(array_filter(
                        $accessData['displayItems'],
                        fn($item) => $item['mimeType'] === 'application/vnd.google-apps.folder'
                    ));
                    $searchScope = !empty($entryFolders) ? $entryFolders : $baseFolderIds;
                }

                $filesFound = searchDriveStrictScoped($searchScope, $searchQuery, $accessToken);
            }

        } else {
            // =================================================================
            // MODE BROWSE FOLDER
            // =================================================================

            if (empty($currentFolderId) || $currentFolderId === $rootFolderId) {
                //  BERANDA: Tampilkan semua entry-point items milik user â”€
                // Ini bisa berupa folder ATAU file individual yang dibagikan langsung
                $filesFound        = array_values($accessData['displayItems']);
                $currentFolderName = 'Folder Saya';
            } else {
                //  BROWSE SUBFOLDER: Verifikasi keamanan dulu â”€
                if (!isFolderAllowedForUser($currentFolderId, $rootFolderId, $accessData, $accessToken)) {
                    // BLOKIR: User mencoba mengakses folder yang bukan miliknya
                    $isFolderForbidden = true;
                    $errorMsg          = 'access_denied';
                } else {
                    // Aman: tampilkan seluruh isi folder
                    $filesFound  = listDriveFiles($currentFolderId, $accessToken, '');
                    $breadcrumbs = buildBreadcrumbsToUserBase(
                        $currentFolderId,
                        $accessData['displayItems'],
                        $accessToken
                    );
                    if (!empty($breadcrumbs)) {
                        $currentFolderName = end($breadcrumbs)['name'];
                    }
                }
            }
        }

    } catch (Throwable $e) {
        $errorMsg = 'api_error';
        if ($isDebugMode) {
            $debugInfo['error'] = $e->getMessage() . ' on line ' . $e->getLine();
        }
    }
}

// Helper format file size
function formatFileSize($bytes) {
    if (!$bytes) return '';
    $units = ['B', 'KB', 'MB', 'GB'];
    $i = 0;
    $bytes = intval($bytes);
    while ($bytes >= 1024 && $i < count($units) - 1) {
        $bytes /= 1024;
        $i++;
    }
    return round($bytes, 1) . ' ' . $units[$i];
}

// Helper format date
function formatDate($dateStr) {
    if (!$dateStr) return '';
    $dt = new DateTime($dateStr);
    return $dt->format('d M Y, H:i');
}

// Helper icon berdasarkan mimeType
function getFileIcon($mimeType) {
    if ($mimeType === 'application/vnd.google-apps.folder') return ['fas fa-folder', 'folder'];
    if (stripos($mimeType, 'pdf') !== false) return ['far fa-file-pdf', 'pdf'];
    if (stripos($mimeType, 'spreadsheet') !== false || stripos($mimeType, 'excel') !== false) return ['far fa-file-excel', 'excel'];
    if (stripos($mimeType, 'document') !== false || stripos($mimeType, 'word') !== false) return ['far fa-file-word', 'doc'];
    if (stripos($mimeType, 'image') !== false) return ['far fa-file-image', 'image'];
    return ['far fa-file', 'generic'];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Cari Sertifikat Digital  PT PANANJUNG ANUGRAH SOLUTION</title>
    <meta name="description" content="Portal pencarian sertifikat kalibrasi digital aman PT Pananjung Anugrah Solution (PAS Calibration).">
    
    <link rel="icon" href="https://www.pascalibration.com/wp-content/uploads/2023/09/logo_pas_basic.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    
    <style>
        :root {
            --bg-body: #f0f4f8;
            --navbar-bg: #FFFFFF;
            --card-bg: #FFFFFF;
            --border-color: #e2e8f0;
            --accent-blue: #1d4ed8;
            --accent-gold: #F7941D;
            --text-dark: #0F2B5C;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.04);
            --shadow-md: 0 4px 16px rgba(0,0,0,0.06);
            --shadow-lg: 0 12px 40px rgba(0,0,0,0.08);
            --radius-lg: 20px;
            --radius-md: 16px;
            --radius-sm: 12px;
        }

        * { 
            -webkit-tap-highlight-color: transparent;
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            min-height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        /*  NAVBAR  */
        .portal-navbar {
            background-color: var(--navbar-bg);
            padding: 0.75rem 1rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04);
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid var(--border-color);
            backdrop-filter: blur(10px);
        }

        .brand-logo-text { 
            font-weight: 800; 
            font-size: 1.15rem; 
            letter-spacing: -0.5px; 
            color: var(--text-dark) !important; 
            line-height: 1.1; 
        }

        .brand-sub { 
            font-size: 0.65rem; 
            color: var(--accent-gold) !important; 
            letter-spacing: 1px; 
            font-weight: 700;
            text-transform: uppercase; 
        }

        /*  MAIN CONTENT  */
        .portal-body { 
            flex: 1; 
            padding: 1.5rem 1rem; 
        }

        .portal-container { 
            max-width: 920px; 
            margin: 0 auto; 
        }

        /*  HERO SEARCH SECTION (BIRU TERANG)  */
        .hero-search {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 50%, #0284c7 100%);
            border-radius: var(--radius-lg);
            padding: 2.5rem 2rem;
            margin-bottom: 1.5rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 16px 45px rgba(29, 78, 216, 0.28);
        }

        .hero-search::before {
            content: '';
            position: absolute;
            top: -40%;
            right: -25%;
            width: 380px;
            height: 380px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.2) 0%, transparent 70%);
            border-radius: 50%;
        }

        .hero-search::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -15%;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(247, 148, 29, 0.18) 0%, transparent 70%);
            border-radius: 50%;
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero-icon {
            width: 56px;
            height: 56px;
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #ffffff;
            margin-bottom: 1rem;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .hero-title {
            color: #ffffff;
            font-weight: 800;
            font-size: 1.65rem;
            letter-spacing: -0.5px;
            margin-bottom: 0.35rem;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .hero-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.9rem;
            font-weight: 400;
            margin-bottom: 1.5rem;
            line-height: 1.5;
        }

        .security-pill {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.4);
            color: #ffffff;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 30px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 0.75rem;
            backdrop-filter: blur(8px);
        }

        /*  SEARCH BOX  */
        .search-box {
            position: relative;
        }

        .search-input-wrapper {
            position: relative;
            display: flex;
            background: rgba(255,255,255,0.22);
            border: 1px solid rgba(255,255,255,0.35);
            border-radius: 14px;
            overflow: hidden;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
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
            padding: 14px 16px 14px 48px;
            background: transparent;
            border: none;
            color: #ffffff;
            font-size: 0.95rem;
            font-family: inherit;
            outline: none;
        }

        .search-input::placeholder {
            color: rgba(255,255,255,0.5);
        }

        .search-btn {
            background: linear-gradient(135deg, var(--accent-gold), #e6881eff);
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
            background: linear-gradient(135deg, #f9a338, var(--accent-gold));
            box-shadow: 0 4px 15px rgba(247, 148, 29, 0.4);
        }

        /*  USER BAR  */
        .user-bar {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 0.85rem 1.25rem;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            box-shadow: var(--shadow-sm);
            flex-wrap: wrap;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #e0f2fe;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }

        .user-name {
            font-weight: 700;
            font-size: 0.95rem;
            color: var(--text-dark);
            line-height: 1.2;
        }

        .user-email-text {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .logout-btn {
            background: #fee2e2;
            color: #dc2626;
            border: 1px solid #fecaca;
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 0.8rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .logout-btn:hover {
            background: #dc2626;
            color: #ffffff;
        }

        .sync-btn {
            background: #f1f5f9;
            color: #475569;
            border: 1px solid #cbd5e1;
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 0.8rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .sync-btn:hover {
            background: #e2e8f0;
            color: #1e293b;
        }

        /*  BREADCRUMBS  */
        .breadcrumb-bar {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            padding: 0.65rem 1rem;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
            font-size: 0.82rem;
            box-shadow: var(--shadow-sm);
        }

        .breadcrumb-item-custom a {
            color: var(--accent-blue);
            text-decoration: none;
            font-weight: 500;
        }

        .breadcrumb-item-custom a:hover {
            text-decoration: underline;
        }

        .breadcrumb-sep {
            color: #cbd5e1;
            font-size: 0.7rem;
            margin: 0 2px;
        }

        /*  FILE/FOLDER CARDS  */
        .file-card-link {
            text-decoration: none;
            display: block;
            margin-bottom: 0.6rem;
        }

        .file-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 1rem 1.15rem;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: var(--shadow-sm);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .file-card:hover {
            border-color: #3b82f6;
            background: #f0f9ff;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.1);
        }

        /* Icon boxes */
        .icon-box {
            width: 46px;
            height: 46px;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            flex-shrink: 0;
            transition: all 0.25s ease;
        }

        .icon-box.folder {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            color: #d97706;
        }

        .file-card:hover .icon-box.folder {
            background: linear-gradient(135deg, #d97706, #b45309);
            color: #ffffff;
        }

        .icon-box.pdf {
            background: linear-gradient(135deg, #fef2f2, #fecaca);
            color: #ef4444;
        }

        .file-card:hover .icon-box.pdf {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: #ffffff;
        }

        .icon-box.excel {
            background: linear-gradient(135deg, #ecfdf5, #a7f3d0);
            color: #059669;
        }

        .file-card:hover .icon-box.excel {
            background: linear-gradient(135deg, #059669, #047857);
            color: #ffffff;
        }

        .icon-box.doc {
            background: linear-gradient(135deg, #eff6ff, #bfdbfe);
            color: #2563eb;
        }

        .icon-box.image {
            background: linear-gradient(135deg, #faf5ff, #e9d5ff);
            color: #7c3aed;
        }

        .icon-box.generic {
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            color: #64748b;
        }

        .file-name {
            font-weight: 600;
            font-size: 0.92rem;
            color: var(--text-main);
            line-height: 1.3;
            margin-bottom: 2px;
            word-break: break-word;
        }

        .file-meta {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        .chevron-circle {
            width: 34px;
            height: 34px;
            background: #f1f5f9;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            color: #94a3b8;
            flex-shrink: 0;
            transition: all 0.25s ease;
        }

        .file-card:hover .chevron-circle {
            background: #2563eb;
            color: #ffffff;
            transform: translateX(3px);
        }

        /* File Card with Direct Actions */
        .file-card-item {
            margin-bottom: 0.6rem;
            position: relative;
        }

        .file-main-link {
            display: flex;
            align-items: center;
            gap: 1rem;
            min-width: 0;
            flex: 1;
            text-decoration: none;
            color: inherit;
        }

        .file-main-link:hover .file-name {
            color: #2563eb;
        }

        .file-card-actions {
            display: flex;
            align-items: center;
            gap: 6px;
            flex-shrink: 0;
            z-index: 2;
        }

        .btn-card-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 6px 14px;
            font-size: 0.8rem;
            font-weight: 600;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            white-space: nowrap;
        }

        .btn-card-preview {
            background: #f1f5f9;
            color: #475569 !important;
            border: 1px solid #cbd5e1;
        }

        .btn-card-preview:hover {
            background: #e2e8f0;
            color: #1e293b !important;
            border-color: #94a3b8;
            transform: translateY(-1px);
        }

        .btn-card-download {
            background: linear-gradient(135deg, #10b981, #059669);
            color: #ffffff !important;
            border: 1px solid #059669;
            box-shadow: 0 2px 6px rgba(16, 185, 129, 0.25);
        }

        .btn-card-download:hover {
            background: linear-gradient(135deg, #059669, #047857);
            color: #ffffff !important;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
            transform: translateY(-1px);
        }

        .btn-card-detail {
            background: #eff6ff;
            color: #2563eb !important;
            border: 1px solid #bfdbfe;
        }

        .btn-card-detail:hover {
            background: #2563eb;
            color: #ffffff !important;
            border-color: #2563eb;
            transform: translateY(-1px);
        }


        /*  SEARCH RESULT BAR  */
        .search-result-bar {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            padding: 0.75rem 1rem;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            flex-wrap: wrap;
        }

        .search-badge {
            font-size: 0.88rem;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /*  EMPTY STATE  */
        .empty-state {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border-color);
            padding: 3.5rem 2rem;
            text-align: center;
            box-shadow: var(--shadow-md);
        }

        .empty-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            color: #d97706;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto 1.25rem auto;
            box-shadow: 0 8px 25px rgba(217, 119, 6, 0.12);
        }

        /*  ACCESS DENIED  */
        .access-denied-card {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            border: 1px solid #fecaca;
            padding: 2.5rem 2rem;
            text-align: center;
            box-shadow: 0 12px 35px rgba(239, 68, 68, 0.08);
        }

        .denied-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #fef2f2, #fecaca);
            color: #ef4444;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto 1.25rem auto;
            box-shadow: 0 8px 25px rgba(239, 68, 68, 0.15);
        }

        /*  STATS ROW  */
        .stats-row {
            display: flex;
            gap: 8px;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }

        .stat-badge {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 30px;
            padding: 4px 14px;
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

        /*  LOGIN CARD  */
        .login-card {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border-color);
            padding: 3.5rem 2rem;
            text-align: center;
            box-shadow: var(--shadow-md);
            max-width: 520px;
            margin: 0 auto;
        }

        .login-icon-circle {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #eff6ff, #dbeafe);
            color: #2563eb;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto 1.5rem auto;
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.12);
        }

        .google-login-btn {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: #ffffff;
            color: #1f2937;
            border: 1px solid #d1d5db;
            padding: 12px 24px;
            border-radius: 50px;
            font-size: 0.95rem;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            transition: all 0.25s ease;
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

        /*  FOOTER  */
        .portal-footer {
            background: var(--card-bg);
            border-top: 1px solid var(--border-color);
            padding: 1rem;
            text-align: center;
            font-size: 0.78rem;
            color: var(--text-muted);
            margin-top: auto;
        }

        /*  LOADING OVERLAY  */
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
            gap: 16px;
        }

        .loading-overlay.active {
            display: flex;
        }

        .spinner-ring {
            width: 48px;
            height: 48px;
            border: 4px solid #e2e8f0;
            border-top: 4px solid var(--accent-blue);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-in {
            animation: fadeInUp 0.4s ease forwards;
        }

        @media (max-width: 767.98px) {
            .portal-body { padding: 1rem 0.5rem; }
            .hero-search { padding: 1.75rem 1.25rem; }
            .hero-title { font-size: 1.3rem; }
            .hero-subtitle { font-size: 0.82rem; }
            .brand-logo-text { font-size: 1rem; }
            .login-card { padding: 2.5rem 1.25rem; }
            .empty-state { padding: 2.5rem 1.25rem; }
            .user-bar { flex-direction: column; text-align: center; }
            .user-info { flex-direction: column; }
            .file-card { padding: 0.85rem 1rem; }
        }
    </style>
</head>
<body>

    <!-- LOADING OVERLAY -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="spinner-ring"></div>
        <span style="font-weight: 600; color: var(--text-dark); font-size: 0.95rem;">Memuat data sertifikat...</span>
    </div>

    <!--  NAVBAR  -->
    <nav class="portal-navbar">
        <div class="container portal-container d-flex align-items-center justify-content-between">
            <a href="https://pascalibration.com" class="d-flex align-items-center gap-2 text-decoration-none">
                <img src="https://www.pascalibration.com/wp-content/uploads/2023/09/logo_pas_basic.png" alt="PAS Logo" style="height: 36px; object-fit: contain;">
                <div>
                    <div class="brand-logo-text">PT PANANJUNG ANUGRAH SOLUTION</div>
                    <div class="brand-sub">Smart Certificate Verification</div>
                </div>
            </a>
            <?php if ($isLoggedIn): ?>
           
            <?php endif; ?>
        </div>
    </nav>

    <!--  MAIN CONTENT  -->
    <div class="portal-body">
        <div class="portal-container">

            <?php if ($isDebugMode && !empty($debugInfo)): ?>
                <!-- DEBUG CONSOLE -->
                <div class="card mb-4 border-warning shadow-sm">
                    <div class="card-header bg-warning text-dark fw-bold small">
                        <i class="fas fa-bug me-1"></i> Debug Info Google Drive API
                    </div>
                    <div class="card-body small font-monospace">
                        <div><strong>Root Folder ID:</strong> <?php echo htmlspecialchars($debugInfo['rootFolderId'] ?? ''); ?></div>
                        <div><strong>User Email:</strong> <?php echo htmlspecialchars($debugInfo['userEmail'] ?? ''); ?></div>
                        <div><strong>Has Root Access:</strong> <?php echo !empty($debugInfo['hasRootAccess']) ? '<span class="text-success fw-bold">YES</span>' : '<span class="text-danger fw-bold">NO</span>'; ?></div>
                        <div><strong>Total Base Folders Found:</strong> <?php echo htmlspecialchars($debugInfo['totalBaseFound'] ?? 0); ?></div>
                        <?php if (!empty($debugInfo['baseFolders'])): ?>
                            <div class="mt-2"><strong>Accessible Folders:</strong></div>
                            <ul>
                                <?php foreach ($debugInfo['baseFolders'] as $bf): ?>
                                    <li><?php echo htmlspecialchars($bf); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                        <?php if (!empty($debugInfo['error'])): ?>
                            <div class="text-danger mt-2"><strong>Error:</strong> <?php echo htmlspecialchars($debugInfo['error']); ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- HERO SEARCH SECTION -->
            <div class="hero-search">
                <div class="hero-content">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                        <div class="hero-icon">
                            <i class="fas fa-certificate"></i>
                        </div>
                        
                    </div>

                    <h1 class="hero-title">Cari Sertifikat Digital</h1>
                    <p class="hero-subtitle">
                        <?php if ($isLoggedIn): ?>
                            Cari berdasarkan nomor sertifikat, kode alat (PAS-XXXXX), atau nama file. Pencarian hanya akan menampilkan berkas dari folder perusahaan yang terdaftar untuk email Anda.
                        <?php else: ?>
                            Masuk dengan email perusahaan Anda menggunakan kode OTP untuk mengakses sertifikat kalibrasi digital yang telah didaftarkan.
                        <?php endif; ?>
                    </p>

                    <?php if ($isLoggedIn): ?>
                        <form method="GET" action="<?php echo htmlspecialchars($pageUrl); ?>" class="search-box" id="searchForm">
                            <?php if (!empty($currentFolderId) && !$isFolderForbidden): ?>
                                <input type="hidden" name="folder_id" value="<?php echo htmlspecialchars($currentFolderId); ?>">
                            <?php endif; ?>
                            <div class="search-input-wrapper">
                                <i class="fas fa-search search-icon"></i>
                                <input 
                                    type="text" 
                                    name="search" 
                                    class="search-input" 
                                    placeholder="Ketik nomor sertifikat, kode alat (PAS-...), atau nama file..." 
                                    value="<?php echo htmlspecialchars($searchQuery); ?>"
                                    autocomplete="off"
                                    id="searchInput"
                                >
                                <button type="submit" class="search-btn" onclick="showLoading()">
                                    <i class="fas fa-search me-1"></i> Cari
                                </button>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>

            <?php if ($errorMsg === 'access_denied'): ?>
                <!-- ACCESS DENIED (TERLINDUNGI) -->
                <div class="access-denied-card animate-in">
                    <div class="denied-icon">
                        <i class="fas fa-user-lock"></i>
                    </div>
                    <h4 class="fw-bold text-dark mb-2">Akses Ditolak / Dibatasi</h4>
                    <p class="text-muted mb-1 small">
                        Login sebagai: <strong class="text-dark"><?php echo htmlspecialchars($userEmail); ?></strong>
                    </p>
                    <div class="alert alert-danger border-0 bg-danger bg-opacity-10 text-danger p-3 rounded-4 mb-4 text-start small mt-3" style="max-width: 520px; margin: 0 auto; line-height: 1.6;">
                        <i class="fas fa-shield-alt me-2 fs-6"></i>
                        <strong>Perlindungan Privasi:</strong> Akun email Anda tidak memiliki izin akses ke folder atau berkas ini. Sistem hanya menampilkan berkas perusahaan yang secara khusus didaftarkan untuk email Anda.
                    </div>
                    <div class="d-flex flex-column flex-sm-row gap-2 justify-content-center mt-3">
                        <a href="?logout=1" class="btn btn-outline-danger rounded-pill px-4 py-2 fw-semibold small">
                            <i class="fas fa-sign-out-alt me-1"></i> Ganti Akun Email
                        </a>
                        <a href="<?php echo htmlspecialchars($pageUrl); ?>" class="btn btn-light rounded-pill px-4 py-2 fw-semibold small text-secondary">
                            <i class="fas fa-home me-1"></i> Kembali ke Beranda Saya
                        </a>
                    </div>
                </div>

            <?php elseif ($errorMsg === 'api_error'): ?>
                <!-- API ERROR -->
                <div class="access-denied-card animate-in">
                    <div class="denied-icon" style="background: linear-gradient(135deg, #fef3c7, #fde68a); color: #d97706;">
                        <i class="fas fa-server"></i>
                    </div>
                    <h4 class="fw-bold text-dark mb-2">Terjadi Gangguan Koneksi</h4>
                    <p class="text-muted small mb-3">
                        Gagal terhubung ke Google Drive API. Silakan periksa file credentials.json atau coba beberapa saat lagi.
                    </p>
                    <a href="<?php echo htmlspecialchars($pageUrl); ?>" class="btn btn-outline-primary rounded-pill px-4 py-2 fw-semibold small">
                        <i class="fas fa-redo me-1"></i> Muat Ulang
                    </a>
                </div>

            <?php elseif (!$isLoggedIn): ?>
                <!-- LOGIN REQUIRED (OTP-ONLY VERIFICATION) -->
                <div class="login-card animate-in" style="max-width: 480px;">
                    <div class="login-logo-wrap mb-3 text-center">
                        <img src="logo/logo_pas_basic.png" alt="Logo PT Pananjung Anugrah Solution" style="height: 56px; max-width: 100%; object-fit: contain;" onerror="this.onerror=null; this.src='https://www.pascalibration.com/wp-content/uploads/2023/09/logo_pas_basic.png';">
                    </div>
                    <h4 class="fw-bold text-dark mb-1">Masuk ke Portal Sertifikat</h4>
                    <p class="text-muted small mb-4" style="line-height: 1.5;">
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
                            <button type="button" id="btnRequestOtp" class="btn btn-primary w-100 py-2 rounded-pill fw-semibold shadow-sm" onclick="sendOtpRequest()">
                                Login
                            </button>
                        </div>

                        <!-- STEP 2: FORM INPUT KODE OTP (Hidden awalnya) -->
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
                            <button type="button" id="btnVerifyOtp" class="btn btn-primary w-100 py-2 rounded-pill fw-semibold shadow-sm mb-2" onclick="verifyOtpRequest()">
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
                                <div class="text-muted mt-1" style="font-size: 0.78rem;">
                                    Daftarkan akun Email Anda untuk mendapatkan izin unduh & lihat Sertifikat Digital.
                                </div>
                                <a href="https://pascalibration.com/formRegister" class="btn btn-sm btn-outline-primary rounded-pill px-3 mt-2 fw-semibold">
                                    <i class="fas fa-file-signature me-1"></i> Form Pendaftaran Akses Sertifikat Digital
                                </a>
                            </div>
                        </div>
                    </div>
                    
                     <!-- HOTLINE & BANTUAN ADMIN PT PAS -->
                    <div class="alert alert-light border rounded-3 p-3 mt-3 text-start small">
                        <div class="d-flex align-items-start gap-2">
                            <i class="fas fa-headset text-success mt-1"></i>
                            <div>
                                <span class="fw-bold text-dark">Pusat Bantuan & Hotline Admin</span>
                                <div class="text-muted mt-1" style="font-size: 0.78rem;">
                                    Ada pertanyaan atau kendala terkait sertifikat? Hubungi kami langsung:
                                </div>
                              <a href="https://wa.me/628567770150?text=Halo%20Admin%20PT%20PAS,%20saya%20ingin%20menanyakan%20terkait%20akses%20sertifikat%20kalibrasi%20digital." target="_blank" class="btn btn-sm btn-outline-success rounded-pill px-3 mt-2 fw-semibold">
                                    <i class="fab fa-whatsapp me-1"></i>Admin PT PAS Calibration
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            <?php else: ?>
                <!-- LOGGED IN: USER BAR -->
                <div class="user-bar animate-in">
                    <div class="user-info">
                        <?php if ($userPicture): ?>
                            <img src="<?php echo htmlspecialchars($userPicture); ?>" alt="Avatar" class="user-avatar">
                        <?php else: ?>
                            <div class="user-avatar d-flex align-items-center justify-content-center" style="background: #e0f2fe; color: #0284c7; font-weight: 700; font-size: 0.95rem;">
                                <?php echo strtoupper(substr($userName ?: $userEmail, 0, 1)); ?>
                            </div>
                        <?php endif; ?>
                          <div class="user-name">
                                    <?php 
                                        // Hilangkan note dalam tanda kurung, contoh: "Rafi Akbar (Hanya akses subfolder)" -> "Rafi Akbar"
                                        $cleanUserName = preg_replace('/\s*\([^)]*\)\s*$/', '', $userName);
                                        echo htmlspecialchars($cleanUserName ?: 'Pengguna'); 
                                    ?>
                                    <?php if (!empty($_SESSION['user_company'])): ?>
                                        <span class="badge bg-light text-primary border ms-1" style="font-size: 0.72rem; font-weight: 600;"><i class="far fa-building me-1"></i><?php echo htmlspecialchars($_SESSION['user_company']); ?></span>
                                    <?php endif; ?>
                                </div>
                            <div class="user-email-text"><?php echo htmlspecialchars($userEmail); ?></div>
                    </div>
                    
                    <div class="d-flex align-items-center gap-2">
                        <a href="?refresh_access=1<?php echo !empty($currentFolderId) ? '&folder_id=' . urlencode($currentFolderId) : ''; ?>" class="sync-btn d-inline-flex align-items-center gap-1" title="Sinkronkan pembaruan izin dari Google Drive">
                            <i class="fas fa-sync-alt"></i> <span class="d-none d-sm-inline">Sinkronkan</span>
                        </a>
                        <a href="?logout=1" class="logout-btn d-inline-flex align-items-center gap-1">
                            <i class="fas fa-power-off"></i> Keluar
                        </a>
                    </div>
                </div>

                <?php if ($isSearchMode): ?>
                    <!-- SEARCH RESULT BAR -->
                    <div class="search-result-bar animate-in">
                        <div class="search-badge">
                            <i class="fas fa-search text-primary"></i>
                            Hasil pencarian: "<strong><?php echo htmlspecialchars($searchQuery); ?></strong>"
                            <span class="badge bg-primary rounded-pill ms-1"><?php echo count($filesFound); ?></span>
                        </div>
                        <a href="<?php echo htmlspecialchars($pageUrl); ?><?php echo !empty($currentFolderId) ? '?folder_id=' . urlencode($currentFolderId) : ''; ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3 fw-semibold small">
                            <i class="fas fa-times me-1"></i> Reset Pencarian
                        </a>
                    </div>
                <?php else: ?>
                    <!-- BREADCRUMBS -->
                    <div class="breadcrumb-bar animate-in">
                        <span class="breadcrumb-item-custom">
                            <a href="<?php echo htmlspecialchars($pageUrl); ?>"><i class="fas fa-home me-1"></i> Beranda Saya</a>
                        </span>
                        <?php if (!empty($breadcrumbs)): ?>
                            <?php foreach ($breadcrumbs as $bc): ?>
                                <span class="breadcrumb-sep"><i class="fas fa-chevron-right"></i></span>
                                <span class="breadcrumb-item-custom">
                                    <?php if ($bc['id'] === $currentFolderId): ?>
                                        <strong class="text-dark"><?php echo htmlspecialchars($bc['name']); ?></strong>
                                    <?php else: ?>
                                        <a href="?folder_id=<?php echo urlencode($bc['id']); ?>"><?php echo htmlspecialchars($bc['name']); ?></a>
                                    <?php endif; ?>
                                </span>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php if (empty($filesFound)): ?>
                    <!-- EMPTY STATE -->
                    <div class="empty-state animate-in">
                        <div class="empty-icon">
                            <i class="fas fa-folder-open"></i>
                        </div>
                        <?php if ($isSearchMode): ?>
                            <h5 class="fw-bold text-dark mb-2">Berkas Tidak Ditemukan</h5>
                            <p class="text-muted mb-3 small" style="max-width: 460px; margin: 0 auto; line-height: 1.6;">
                                Tidak ditemukan berkas yang cocok dengan kata kunci "<strong class="text-dark"><?php echo htmlspecialchars($searchQuery); ?></strong>" pada folder yang terdaftar untuk email Anda.
                            </p>
                        <?php elseif (empty($userBaseFolders)): ?>
                            <h5 class="fw-bold text-dark mb-2">Belum Ada Folder yang Diberikan Akses</h5>
                            <p class="text-muted mb-3 small" style="max-width: 480px; margin: 0 auto; line-height: 1.6;">
                                Email <strong class="text-dark"><?php echo htmlspecialchars($userEmail); ?></strong> belum memiliki folder sertifikat yang dihubungkan. Silakan hubungi tim PT PANANJUNG ANUGRAH SOLUTION atau isi formulir pendaftaran akses.
                            </p>
                        <?php else: ?>
                            <h5 class="fw-bold text-dark mb-2">Folder Ini Kosong</h5>
                            <p class="text-muted mb-3 small" style="max-width: 440px; margin: 0 auto; line-height: 1.6;">
                                Belum ada berkas atau subfolder sertifikat yang tersedia di dalam folder ini.
                            </p>
                        <?php endif; ?>
                        
                        <div class="d-flex justify-content-center gap-2 mt-3">
                            <a href="<?php echo htmlspecialchars($pageUrl); ?>" class="btn btn-outline-primary rounded-pill px-4 py-2 fw-semibold small">
                                <i class="fas fa-home me-1"></i> Kembali ke Beranda
                            </a>
                            <a href="?refresh_access=1" class="btn btn-light rounded-pill px-3 py-2 fw-semibold small text-secondary">
                                <i class="fas fa-sync-alt me-1"></i> Cek Ulang Izin
                            </a>
                        </div>
                    </div>

                <?php else: ?>
                    <!-- STATS BADGES -->
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
                    <div class="stats-row animate-in">
                        <?php if ($folderCount > 0): ?>
                            <div class="stat-badge">
                                <i class="fas fa-folder text-warning"></i> Folder
                                <span class="count"><?php echo $folderCount; ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if ($fileCount > 0): ?>
                            <div class="stat-badge">
                                <i class="far fa-file text-primary"></i> Berkas Sertifikat
                                <span class="count"><?php echo $fileCount; ?></span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- FILE / FOLDER LIST -->
                       <div class="file-list">
                        <?php foreach ($filesFound as $file): ?>
                            <?php 
                                $isFolder = ($file['mimeType'] === 'application/vnd.google-apps.folder');
                                list($iconClass, $iconType) = getFileIcon($file['mimeType']);
                                $isDigital = (bool) preg_match('/(PAS-\d+)/i', $file['name']);
                                $downloadUrl = '';
                                
                                if ($isFolder) {
                                    $itemUrl = $pageUrl . "?" . http_build_query(['folder_id' => $file['id']]);
                                    $subText = 'Folder • Klik untuk melihat berkas di dalamnya';
                                    $linkTarget = '';
                                    $linkOnclick = 'onclick="showLoading()"';
                                } else {
                                    $itemUrl = $pageUrl . "?" . http_build_query([
                                        'action'  => 'open',
                                        'file_id' => $file['id']
                                    ]);
                                    $downloadUrl = $pageUrl . "?" . http_build_query([
                                        'action'  => 'download',
                                        'file_id' => $file['id']
                                    ]);
                                    $sizeTxt = formatFileSize($file['size'] ?? 0);
                                    $dateTxt = formatDate($file['modifiedTime'] ?? '');
                                    $parts = [];
                                    if ($sizeTxt) $parts[] = $sizeTxt;
                                    if ($dateTxt) $parts[] = $dateTxt;
                                    
                                    if ($isDigital) {
                                        $subText = implode(' • ', $parts) ?: 'Sertifikat Digital • Klik untuk melihat detail';
                                    } else {
                                        $subText = implode(' • ', $parts) ?: 'Sertifikat Lama (PDF) • Klik untuk melihat';
                                    }
                                    $linkTarget = 'target="_blank" rel="noopener noreferrer"';
                                    $linkOnclick = '';
                                }
                            ?>
                            <?php if ($isFolder): ?>
                                <a href="<?php echo $itemUrl; ?>" class="file-card-link animate-in" <?php echo $linkOnclick; ?>>
                                    <div class="file-card">
                                        <div class="d-flex align-items-center gap-3" style="min-width: 0; flex: 1;">
                                            <div class="icon-box <?php echo $iconType; ?>">
                                                <i class="<?php echo $iconClass; ?>"></i>
                                            </div>
                                            <div style="min-width: 0; flex: 1;">
                                                <div class="file-name"><?php echo htmlspecialchars($file['name']); ?></div>
                                                <div class="file-meta">
                                                    <i class="fas fa-folder-open me-1 text-warning"></i>
                                                    <?php echo htmlspecialchars($subText); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chevron-circle ms-2">
                                            <i class="fas fa-chevron-right"></i>
                                        </div>
                                    </div>
                                </a>
                            <?php else: ?>
                                <div class="file-card file-card-item animate-in">
                                    <a href="<?php echo $itemUrl; ?>" class="file-main-link" <?php echo $linkTarget; ?> title="Klik untuk membuka pratinjau">
                                        <div class="icon-box <?php echo $iconType; ?>">
                                            <i class="<?php echo $iconClass; ?>"></i>
                                        </div>
                                        <div style="min-width: 0; flex: 1;">
                                            <div class="file-name"><?php echo htmlspecialchars($file['name']); ?></div>
                                            <div class="file-meta">
                                                <?php if ($isDigital): ?>
                                                    <span class="badge bg-light text-success border py-0.5 px-1.5 me-1"><i class="fas fa-shield-alt me-1"></i> Sertifikat Digital</span>
                                                <?php else: ?>
                                                    <span class="badge bg-light text-danger border py-0.5 px-1.5 me-1"><i class="fas fa-file-pdf me-1"></i> Sertifikat Lama</span>
                                                <?php endif; ?>
                                                <?php echo htmlspecialchars($subText); ?>
                                            </div>
                                        </div>
                                    </a>
                                    
                                    <div class="file-card-actions ms-2">
                                        <?php if (!$isDigital): ?>
                                            <!-- Tombol Pratinjau & Tombol Download Khusus Sertifikat Lama -->
                                            <a href="<?php echo $itemUrl; ?>" target="_blank" rel="noopener noreferrer" class="btn-card-action btn-card-preview" title="Pratinjau Sertifikat Lama">
                                                <i class="fas fa-eye"></i> <span class="d-none d-md-inline">Lihat</span>
                                            </a>
                                            <a href="<?php echo $downloadUrl; ?>" class="btn-card-action btn-card-download" title="Download File Sertifikat Lama">
                                                <i class="fas fa-download"></i> <span class="d-none d-sm-inline">Download</span>
                                            </a>
                                        <?php else: ?>
                                            <a href="<?php echo $itemUrl; ?>" target="_blank" rel="noopener noreferrer" class="btn-card-action btn-card-detail" title="Lihat Detail Sertifikat Digital">
                                                <span class="d-none d-sm-inline">Buka</span> <i class="fas fa-arrow-right ms-1"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

            <?php endif; ?>

        </div>
    </div>

    <!--  FOOTER  -->
    <footer class="portal-footer">
        &copy; <?php echo date('Y'); ?> <strong>PT PANANJUNG ANUGRAH SOLUTION</strong>. Smart Paperless Calibration System.
    </footer>

    <script>
         //  Utility: show/hide loading overlay 
        var loadingTimeout = null;

        function showLoading() {
            var overlay = document.getElementById('loadingOverlay');
            if (overlay) {
                overlay.classList.add('active');
                if (loadingTimeout) clearTimeout(loadingTimeout);
                // Auto hide setelah 6 detik untuk mencegah overlay macet jika proses selesai/batal
                loadingTimeout = setTimeout(hideLoading, 6000);
            }
        }

        function hideLoading() {
            var overlay = document.getElementById('loadingOverlay');
            if (overlay) {
                overlay.classList.remove('active');
            }
            if (loadingTimeout) {
                clearTimeout(loadingTimeout);
                loadingTimeout = null;
            }
        }

        // PENTING: Sembunyikan loading jika user menekan tombol Back di browser (BFCache restore)
        window.addEventListener('pageshow', function(event) {
            hideLoading();
        });

        // Sembunyikan juga saat tab/window kembali aktif
        window.addEventListener('focus', function() {
            hideLoading();
        });

        // Pastikan loading tidak muncul saat awal dokumen siap
        document.addEventListener('DOMContentLoaded', function() {
            hideLoading();
        });


        // ── Manual tab switcher (fallback agar tab Google selalu bisa diklik) ──
        document.addEventListener('DOMContentLoaded', function() {
            var tabBtns = document.querySelectorAll('#loginTab .nav-link');
            tabBtns.forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    // Jika Bootstrap JS sudah handle, jangan double-handle
                    // Tapi tetap pastikan class active dan panel tampil
                    var target = this.getAttribute('data-bs-target');
                    if (!target) return;

                    tabBtns.forEach(function(b) { b.classList.remove('active'); });
                    this.classList.add('active');

                    document.querySelectorAll('#loginTabContent .tab-pane').forEach(function(pane) {
                        pane.classList.remove('show', 'active');
                    });
                    var pane = document.querySelector(target);
                    if (pane) {
                        pane.classList.add('show', 'active');
                    }
                });
            });
        });

        //  Auto-focus search on desktop â”€
        const searchInput = document.getElementById('searchInput');
        if (searchInput && window.innerWidth > 768) {
            searchInput.focus();
        }
        if (searchInput) {
            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    showLoading();
                    document.getElementById('searchForm').submit();
                }
            });
        }

        //  PROGRESSIVE SCAN: Load bertahap, tambahkan kartu baru secara dinamis â”€
        <?php if ($isLoggedIn && empty($currentFolderId) && empty($searchQuery) && !($scanComplete ?? true)): ?>
        (function () {
            const pageUrl       = <?php echo json_encode($pageUrl); ?>;
            const scanDepthEl   = document.getElementById('scanDepthBadge');
            const scanBannerEl  = document.getElementById('scanProgressBanner');
            const fileList      = document.querySelector('.file-list');
            const emptyState    = document.querySelector('.empty-state');
            let   currentDepth  = 1;
            let   newItemCount  = 0;

            // Buat elemen scan-progress banner jika file-list ada
            if (scanBannerEl) scanBannerEl.style.display = 'flex';

             function buildCardHTML(item) {
                const isFolder = item.mimeType === 'application/vnd.google-apps.folder';
                const safeId   = item.id.replace(/[^a-z0-9]/gi, '');
                const safeName = item.name.replace(/</g, '&lt;').replace(/>/g, '&gt;');

                if (isFolder) {
                    const itemUrl  = pageUrl + '?folder_id=' + encodeURIComponent(item.id);
                    const subText  = 'Folder • Klik untuk melihat berkas di dalamnya';
                    return `
                        <a href="${itemUrl}" class="file-card-link animate-in" onclick="showLoading()" id="item-${safeId}" style="animation-delay:0.05s">
                            <div class="file-card">
                                <div class="d-flex align-items-center gap-3" style="min-width:0;flex:1">
                                    <div class="icon-box folder"><i class="fas fa-folder"></i></div>
                                    <div style="min-width:0;flex:1">
                                        <div class="file-name">${safeName}</div>
                                        <div class="file-meta">
                                            <i class="fas fa-folder-open me-1 text-warning"></i>
                                            ${subText}
                                        </div>
                                    </div>
                                </div>
                                <div class="chevron-circle ms-2"><i class="fas fa-chevron-right"></i></div>
                            </div>
                        </a>`;
                }

                const isDigital = /(PAS-\d+)/i.test(item.name);
                const itemUrl   = pageUrl + '?action=open&file_id=' + encodeURIComponent(item.id);
                const downloadUrl = pageUrl + '?action=download&file_id=' + encodeURIComponent(item.id);
                let iconClass = 'far fa-file-pdf';
                let iconType  = 'pdf';
                const m = item.name.match(/\.(xlsx?|xls)$/i);
                if (m) { iconClass = 'far fa-file-excel'; iconType = 'excel'; }

                let badgeHtml = '';
                let actionsHtml = '';

                if (isDigital) {
                    badgeHtml = '<span class="badge bg-light text-success border py-0.5 px-1.5 me-1"><i class="fas fa-shield-alt me-1"></i> Sertifikat Digital</span>';
                    actionsHtml = `
                        <a href="${itemUrl}" target="_blank" rel="noopener noreferrer" class="btn-card-action btn-card-detail" title="Lihat Detail Sertifikat Digital">
                            <span class="d-none d-sm-inline">Buka</span> <i class="fas fa-arrow-right ms-1"></i>
                        </a>`;
                } else {
                    badgeHtml = '<span class="badge bg-light text-danger border py-0.5 px-1.5 me-1"><i class="fas fa-file-pdf me-1"></i> Sertifikat Lama</span>';
                    actionsHtml = `
                        <a href="${itemUrl}" target="_blank" rel="noopener noreferrer" class="btn-card-action btn-card-preview" title="Pratinjau Sertifikat Lama">
                            <i class="fas fa-eye"></i> <span class="d-none d-md-inline">Lihat</span>
                        </a>
                        <a href="${downloadUrl}" class="btn-card-action btn-card-download" title="Download File Sertifikat Lama">
                            <i class="fas fa-download"></i> <span class="d-none d-sm-inline">Download</span>
                        </a>`;
                }

                return `
                    <div class="file-card file-card-item animate-in" id="item-${safeId}" style="animation-delay:0.05s">
                        <a href="${itemUrl}" target="_blank" rel="noopener noreferrer" class="file-main-link" title="Klik untuk membuka pratinjau">
                            <div class="icon-box ${iconType}"><i class="${iconClass}"></i></div>
                            <div style="min-width:0;flex:1">
                                <div class="file-name">${safeName}</div>
                                <div class="file-meta">
                                    ${badgeHtml}
                                    ⚡ Baru ditemukan • Klik untuk melihat
                                </div>
                            </div>
                        </a>
                        <div class="file-card-actions ms-2">
                            ${actionsHtml}
                        </div>
                    </div>`;
            }


            function updateScanBadge(depth, found) {
                if (!scanBannerEl) return;
                const badge = scanBannerEl.querySelector('.scan-badge-text');
                if (badge) badge.textContent = `Memindai level ${depth}... (+${found} item baru)`;
            }

            function hideScanBanner(found) {
                if (!scanBannerEl) return;
                if (found > 0) {
                    scanBannerEl.innerHTML = `
                        <div class="d-flex align-items-center gap-2 text-success small fw-semibold">
                            <i class="fas fa-check-circle"></i>
                            Pemindaian selesai. ${found} item tambahan ditemukan.
                        </div>`;
                    setTimeout(() => { scanBannerEl.style.display = 'none'; }, 3500);
                } else {
                    scanBannerEl.style.display = 'none';
                }
            }

            async function scanNextLevel() {
                try {
                    const res  = await fetch(pageUrl + '?action=scan_deeper', { credentials: 'same-origin' });
                    const data = await res.json();

                    currentDepth = data.depth || currentDepth;

                    if (data.newItems && data.newItems.length > 0) {
                        newItemCount += data.newItems.length;
                        updateScanBadge(currentDepth, newItemCount);

                        // Jika sebelumnya kosong, hapus empty-state
                        const emptyEl = document.querySelector('.empty-state');
                        if (emptyEl) emptyEl.remove();

                        // Buat atau pastikan file-list ada
                        let list = document.querySelector('.file-list');
                        if (!list) {
                            list = document.createElement('div');
                            list.className = 'file-list';
                            const statsRow = document.querySelector('.stats-row');
                            if (statsRow) statsRow.insertAdjacentElement('afterend', list);
                            else document.querySelector('.portal-body')?.appendChild(list);
                        }

                        data.newItems.forEach(item => {
                            if (!document.getElementById('item-' + item.id.replace(/[^a-z0-9]/gi, ''))) {
                                list.insertAdjacentHTML('beforeend', buildCardHTML(item));
                            }
                        });

                        // Update stats badge
                        const statsRow = document.querySelector('.stats-row');
                        if (statsRow) {
                            const totalFolders = document.querySelectorAll('.icon-box.folder').length;
                            const totalFiles   = document.querySelectorAll('.icon-box.pdf, .icon-box.excel, .icon-box.doc, .icon-box.generic, .icon-box.image').length;
                            const folderBadge  = statsRow.querySelector('.stat-badge:first-child .count');
                            const fileBadge    = statsRow.querySelector('.stat-badge:last-child .count');
                            if (folderBadge) folderBadge.textContent = totalFolders;
                            if (fileBadge)   fileBadge.textContent   = totalFiles;
                        }
                    }

                    if (!data.done) {
                        // Ada level lebih dalam, lanjut scan setelah jeda singkat
                        setTimeout(scanNextLevel, 800);
                    } else {
                        hideScanBanner(newItemCount);
                    }

                } catch (err) {
                    console.warn('[ProgressiveScan] Error:', err);
                    hideScanBanner(newItemCount);
                }
            }

            // Mulai scan setelah halaman selesai render
            setTimeout(scanNextLevel, 600);
        })();
        <?php endif; ?>

        // =====================================================================
        // CLIENT OTP HANDLER (EMAIL PERUSAHAAN)
        // =====================================================================
        let currentOtpEmail = '';

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

            fetch('<?php echo htmlspecialchars($pageUrl); ?>?action=send_otp', {
                method: 'POST',
                body: fd
            })
            .then(r => r.json())
            .then(res => {
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-paper-plane me-1"></i> Login';

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
                btn.innerHTML = '<i class="fas fa-paper-plane me-1"></i> Login';
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

            fetch('<?php echo htmlspecialchars($pageUrl); ?>?action=verify_otp', {
                method: 'POST',
                body: fd
            })
            .then(r => r.json())
            .then(res => {
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-sign-in-alt me-1"></i> Verifikasi & Masuk';

                if (res.success) {
                    showOtpFeedback('Verifikasi berhasil! Mengalihkan ke portal...', true);
                    showLoading();
                    window.location.href = res.redirect || '<?php echo htmlspecialchars($pageUrl); ?>';
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

            fetch('<?php echo htmlspecialchars($pageUrl); ?>?action=send_otp', {
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

