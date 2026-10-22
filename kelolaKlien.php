<?php
// ============================================================================
// https://pascalibration.com/client-portal — Panel Admin Pengelolaan Akun Klien & Akses Google Drive
// PT PANANJUNG ANUGRAH SOLUTION
// ============================================================================

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 0);

require_once __DIR__ . '/db_customer.php';

// Path credentials Service Account untuk fitur tes cek folder Google Drive
$credentialsPath = __DIR__ . '/credentials.json';
$rootFolderId    = '19qvHuJ0q84DARVA8uf0DLPq7Vtpv4Hwq';

// ----------------------------------------------------------------------------
// HELPER SERVICE ACCOUNT GDRIVE UNTUK VALIDASI FOLDER
// ----------------------------------------------------------------------------
function getAdminSaToken($credentialsPath)
{
    if (!file_exists($credentialsPath)) return null;
    $sa = json_decode(file_get_contents($credentialsPath), true);
    if (!$sa || empty($sa['private_key']) || empty($sa['client_email'])) return null;

    $now = time();
    $b64 = fn($d) => str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($d));
    $jwt = $b64(json_encode(['alg' => 'RS256', 'typ' => 'JWT'])) . '.' .
        $b64(json_encode([
            'iss'   => $sa['client_email'],
            'scope' => 'https://www.googleapis.com/auth/drive.readonly',
            'aud'   => 'https://oauth2.googleapis.com/token',
            'exp'   => $now + 3600,
            'iat'   => $now
        ]));
    openssl_sign($jwt, $sig, $sa['private_key'], 'SHA256');
    $jwt .= '.' . $b64($sig);

    $ch = curl_init('https://oauth2.googleapis.com/token');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
        'assertion'  => $jwt
    ]));
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $res = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($res, true);
    return $data['access_token'] ?? null;
}

// ----------------------------------------------------------------------------
// 1. AUTENTIKASI ADMIN
// ----------------------------------------------------------------------------
$loginError = '';
if (isset($_POST['admin_login'])) {
    $inputPasskey = trim($_POST['passkey'] ?? '');
    if ($inputPasskey === $adminSecretPasskey) {
        $_SESSION['is_admin_logged_in'] = true;
        header("Location: https://pascalibration.com/client-portal");
        exit;
    } else {
        $loginError = 'Kunci sandi admin salah. Silakan coba lagi.';
    }
}

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    unset($_SESSION['is_admin_logged_in']);
    header("Location: https://pascalibration.com/client-portal");
    exit;
}

$isAdmin = !empty($_SESSION['is_admin_logged_in']);

// ----------------------------------------------------------------------------
// 2. AJAX ENDPOINTS: VALIDASI & BROWSE GOOGLE DRIVE
// ----------------------------------------------------------------------------
if ($isAdmin && isset($_GET['ajax']) && $_GET['ajax'] === 'check_folder') {
    header('Content-Type: application/json; charset=utf-8');
    $folderInput = trim($_GET['folder_id'] ?? '');

    // Sanitasi jika paste URL lengkap
    if (preg_match('/folders\/([a-zA-Z0-9_-]+)/i', $folderInput, $m)) {
        $folderInput = $m[1];
    } elseif (preg_match('/[?&]id=([a-zA-Z0-9_-]+)/i', $folderInput, $m)) {
        $folderInput = $m[1];
    }

    if (empty($folderInput)) {
        echo json_encode(['valid' => false, 'message' => 'Folder ID kosong']);
        exit;
    }

    try {
        $token = getAdminSaToken($credentialsPath);
        if (!$token) {
            echo json_encode(['valid' => false, 'message' => 'Credentials Service Account belum siap']);
            exit;
        }

        $url = "https://www.googleapis.com/drive/v3/files/{$folderInput}?fields=id,name,mimeType&supportsAllDrives=true";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $token]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $res = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($res, true);

        if (!empty($data['id'])) {
            echo json_encode([
                'valid'     => true,
                'folder_id' => $data['id'],
                'name'      => $data['name'] ?? 'Folder Tanpa Nama',
                'mimeType'  => $data['mimeType'] ?? ''
            ]);
        } else {
            echo json_encode(['valid' => false, 'message' => 'Folder tidak ditemukan atau Service Account belum diberikan akses.']);
        }
    } catch (Throwable $e) {
        echo json_encode(['valid' => false, 'message' => $e->getMessage()]);
    }
    exit;
}

// BROWSE & SEARCH GOOGLE DRIVE FOLDERS/FILES
if ($isAdmin && isset($_GET['ajax']) && $_GET['ajax'] === 'browse_drive') {
    header('Content-Type: application/json; charset=utf-8');
    $currentFid  = trim($_GET['folder_id'] ?? '');
    $searchQuery = trim($_GET['search'] ?? '');

    if (empty($currentFid)) {
        $currentFid = $rootFolderId;
    }

    try {
        $token = getAdminSaToken($credentialsPath);
        if (!$token) {
            echo json_encode(['success' => false, 'message' => 'Credentials Service Account belum siap']);
            exit;
        }

        // Ambil info folder saat ini
        $currentName = 'Root Folder (PAS DIGITAL)';
        $parentFolderId = null;
        if ($currentFid !== $rootFolderId) {
            $infoUrl = "https://www.googleapis.com/drive/v3/files/{$currentFid}?fields=id,name,parents,mimeType&supportsAllDrives=true";
            $ch = curl_init($infoUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $token]);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            $infoRes = curl_exec($ch);
            curl_close($ch);
            $infoData = json_decode($infoRes, true);
            if (!empty($infoData['name'])) {
                $currentName = $infoData['name'];
                $parentFolderId = $infoData['parents'][0] ?? null;
            }
        }

        // Susun query pencarian / browse
        if (!empty($searchQuery)) {
            $q = "name contains '" . addslashes($searchQuery) . "' and trashed = false";
            if ($currentFid !== $rootFolderId) {
                $q .= " and '{$currentFid}' in parents";
            }
        } else {
            $q = "'{$currentFid}' in parents and trashed = false";
        }

        $params = [
            'q'                         => $q,
            'fields'                    => 'files(id,name,mimeType,parents,size,modifiedTime)',
            'orderBy'                   => 'folder,name',
            'pageSize'                  => 100,
            'supportsAllDrives'         => 'true',
            'includeItemsFromAllDrives' => 'true'
        ];

        $apiUrl = "https://www.googleapis.com/drive/v3/files?" . http_build_query($params);
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $token]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        $res = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($res, true);

        $items = [];
        if (!empty($data['files'])) {
            foreach ($data['files'] as $f) {
                $isFolder = ($f['mimeType'] === 'application/vnd.google-apps.folder');
                $items[] = [
                    'id'       => $f['id'],
                    'name'     => $f['name'] ?? 'Tanpa Nama',
                    'mimeType' => $f['mimeType'] ?? '',
                    'isFolder' => $isFolder,
                    'size'     => $f['size'] ?? 0
                ];
            }
        }

        echo json_encode([
            'success'          => true,
            'root_id'          => $rootFolderId,
            'current_id'       => $currentFid,
            'current_name'     => $currentName,
            'parent_folder_id' => $parentFolderId,
            'items'            => $items
        ]);
    } catch (Throwable $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    exit;
}

// ----------------------------------------------------------------------------
// 3. ACTION POST CRUD (Tambah / Edit / Hapus / Toggle Status)
// ----------------------------------------------------------------------------
$flashSuccess = '';
$flashError   = '';

if ($isAdmin && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $postAction = $_POST['form_action'] ?? '';

    // A. TAMBAH KLIEN
    if ($postAction === 'create') {
        $nama               = trim($_POST['nama'] ?? '');
        $email              = strtolower(trim($_POST['email'] ?? ''));
        $perusahaan         = trim($_POST['perusahaan'] ?? '');
        $jabatan            = trim($_POST['jabatan'] ?? '');
        $modelAkses         = trim($_POST['model_akses'] ?? 'MODEL A');
        $folderIds          = trim($_POST['folder_ids'] ?? '');
        $folderIdsTambahan  = trim($_POST['folder_ids_tambahan'] ?? '');
        $status             = $_POST['status'] ?? 'active';

        // Olah email tambahan per item
        $addEmailItems = [];
        $pNamas   = $_POST['add_nama_list'] ?? [];
        $pEmails  = $_POST['add_email_list'] ?? [];
        $pNotes   = $_POST['add_note_list'] ?? [];
        $pFolders = $_POST['add_folder_list'] ?? [];
        if (is_array($pEmails)) {
            foreach ($pEmails as $idx => $em) {
                $emClean = strtolower(trim($em));
                $nmClean = trim($pNamas[$idx] ?? '');
                $ntClean = trim($pNotes[$idx] ?? '');
                $fdClean = trim($pFolders[$idx] ?? '');
                if (!empty($emClean) && filter_var($emClean, FILTER_VALIDATE_EMAIL)) {
                    $addEmailItems[] = [
                        'nama'       => $nmClean,
                        'email'      => $emClean,
                        'note'       => $ntClean,
                        'folder_ids' => $fdClean
                    ];
                }
            }
        }
        if (empty($addEmailItems) && !empty($_POST['email_tambahan'])) {
            $addEmailItems = parseAdditionalEmails($_POST['email_tambahan']);
        }
        $emailTambahan = !empty($addEmailItems) ? json_encode($addEmailItems, JSON_UNESCAPED_UNICODE) : '';

        if (empty($nama) || empty($email) || empty($perusahaan)) {
            $flashError = 'Nama, Email, dan Perusahaan wajib diisi.';
        } else {
            try {
                // Cek duplikasi email
                if (getCustomerByEmail($email)) {
                    $flashError = "Email <strong>{$email}</strong> sudah terdaftar sebelumnya.";
                } else {
                    createCustomer($nama, $email, $perusahaan, $folderIds, $status, $jabatan, $modelAkses, $emailTambahan, $folderIdsTambahan);

                    // Kirim notifikasi email ke customer yang diberikan akses folder
                    $sentNotifs = [];
                    $sendNotification = !isset($_POST['send_notification']) || !empty($_POST['send_notification']);
                    if ($sendNotification && $status === 'active') {
                        // 1. Email Utama: kirim HANYA jika sudah diberikan akses folder
                        if (!empty(trim($folderIds))) {
                            if (sendCustomerAccessNotification($email, $nama, $perusahaan, $folderIds)) {
                                $sentNotifs[] = "{$email} (Utama)";
                            }
                        }
                        // 2. Email Tambahan: kirim HANYA jika email tambahan tersebut sudah diberikan akses folder khusus
                        foreach ($addEmailItems as $addEm) {
                            $addFd = trim($addEm['folder_ids'] ?? '');
                            if (!empty($addFd) && !empty($addEm['email'])) {
                                $picName = !empty($addEm['nama']) ? $addEm['nama'] : $nama;
                                if (sendCustomerAccessNotification($addEm['email'], $picName, $perusahaan, $addFd)) {
                                    $sentNotifs[] = "{$addEm['email']} (Tambahan)";
                                }
                            }
                        }
                    }

                    if (!empty($sentNotifs)) {
                        $flashSuccess = "Akun klien <strong>{$nama}</strong> ({$email}) berhasil ditambahkan! Notifikasi email akses telah dikirimkan ke: " . implode(', ', $sentNotifs) . ".";
                    } else {
                        $flashSuccess = "Akun klien <strong>{$nama}</strong> ({$email}) berhasil ditambahkan!";
                    }
                }
            } catch (Throwable $e) {
                $flashError = "Gagal menyimpan: " . $e->getMessage();
            }
        }
    }

    // B. EDIT KLIEN
    elseif ($postAction === 'update') {
        $id                 = intval($_POST['id'] ?? 0);
        $nama               = trim($_POST['nama'] ?? '');
        $email              = strtolower(trim($_POST['email'] ?? ''));
        $perusahaan         = trim($_POST['perusahaan'] ?? '');
        $jabatan            = trim($_POST['jabatan'] ?? '');
        $modelAkses         = trim($_POST['model_akses'] ?? 'MODEL A');
        $folderIds          = trim($_POST['folder_ids'] ?? '');
        $folderIdsTambahan  = trim($_POST['folder_ids_tambahan'] ?? '');
        $status             = $_POST['status'] ?? 'active';

        // Olah email tambahan per item
        $addEmailItems = [];
        $pNamas   = $_POST['add_nama_list'] ?? [];
        $pEmails  = $_POST['add_email_list'] ?? [];
        $pNotes   = $_POST['add_note_list'] ?? [];
        $pFolders = $_POST['add_folder_list'] ?? [];
        if (is_array($pEmails)) {
            foreach ($pEmails as $idx => $em) {
                $emClean = strtolower(trim($em));
                $nmClean = trim($pNamas[$idx] ?? '');
                $ntClean = trim($pNotes[$idx] ?? '');
                $fdClean = trim($pFolders[$idx] ?? '');
                if (!empty($emClean) && filter_var($emClean, FILTER_VALIDATE_EMAIL)) {
                    $addEmailItems[] = [
                        'nama'       => $nmClean,
                        'email'      => $emClean,
                        'note'       => $ntClean,
                        'folder_ids' => $fdClean
                    ];
                }
            }
        }
        if (empty($addEmailItems) && !empty($_POST['email_tambahan'])) {
            $addEmailItems = parseAdditionalEmails($_POST['email_tambahan']);
        }
        $emailTambahan = !empty($addEmailItems) ? json_encode($addEmailItems, JSON_UNESCAPED_UNICODE) : '';

        if ($id <= 0 || empty($nama) || empty($email) || empty($perusahaan)) {
            $flashError = 'Nama, Email, dan Perusahaan wajib diisi.';
        } else {
            try {
                // Pastikan email tidak bentrok dengan akun lain
                $existing = getCustomerByEmail($email);
                if ($existing && $existing['id'] != $id) {
                    $flashError = "Email <strong>{$email}</strong> sudah digunakan oleh klien lain.";
                } else {
                    // Ambil data klien lama sebelum diupdate untuk deteksi pemberian folder baru
                    $oldClient     = getCustomerById($id);
                    $oldMainFolder = trim($oldClient['folder_ids'] ?? '');
                    $oldAddMap     = [];
                    if ($oldClient) {
                        $oldAddList = parseAdditionalEmails($oldClient['email_tambahan'] ?? '');
                        foreach ($oldAddList as $item) {
                            if (!empty($item['email'])) {
                                $oldAddMap[strtolower(trim($item['email']))] = trim($item['folder_ids'] ?? '');
                            }
                        }
                    }

                    updateCustomer($id, $nama, $email, $perusahaan, $folderIds, $status, $jabatan, $modelAkses, $emailTambahan, $folderIdsTambahan);

                    // Kirim notifikasi email ke email yang baru diberikan akses folder
                    $sentNotifs = [];
                    $sendNotification = !isset($_POST['send_notification']) || !empty($_POST['send_notification']);
                    if ($sendNotification && $status === 'active') {
                        $newMainFolder = trim($folderIds);
                        // 1. Email Utama: kirim jika memiliki folder DAN (sebelumnya belum ada folder ATAU foldernya berubah)
                        if (!empty($newMainFolder)) {
                            $mainNewlyAssigned = empty($oldMainFolder) || ($newMainFolder !== $oldMainFolder);
                            if ($mainNewlyAssigned) {
                                if (sendCustomerAccessNotification($email, $nama, $perusahaan, $newMainFolder)) {
                                    $sentNotifs[] = "{$email} (Utama)";
                                }
                            }
                        }

                        // 2. Email Tambahan: HANYA yang memiliki folder khusus DAN baru diberikan / foldernya berubah
                        foreach ($addEmailItems as $addEm) {
                            $addEmKey = strtolower(trim($addEm['email']));
                            $newAddFd = trim($addEm['folder_ids'] ?? '');
                            $oldAddFd = $oldAddMap[$addEmKey] ?? '';

                            if (!empty($newAddFd)) {
                                $addNewlyAssigned = empty($oldAddFd) || ($newAddFd !== $oldAddFd);
                                if ($addNewlyAssigned) {
                                    $picName = !empty($addEm['nama']) ? $addEm['nama'] : $nama;
                                    if (sendCustomerAccessNotification($addEmKey, $picName, $perusahaan, $newAddFd)) {
                                        $sentNotifs[] = "{$addEmKey} (Tambahan)";
                                    }
                                }
                            }
                        }
                    }

                    if (!empty($sentNotifs)) {
                        $flashSuccess = "Data akun klien <strong>{$nama}</strong> berhasil diperbarui! Notifikasi email akses telah dikirimkan ke: " . implode(', ', $sentNotifs) . ".";
                    } else {
                        $flashSuccess = "Data akun klien <strong>{$nama}</strong> berhasil diperbarui!";
                    }
                }
            } catch (Throwable $e) {
                $flashError = "Gagal memperbarui: " . $e->getMessage();
            }
        }
    }

    // C. HAPUS KLIEN
    elseif ($postAction === 'delete') {
        $id = intval($_POST['id'] ?? 0);
        if ($id > 0) {
            try {
                deleteCustomer($id);
                $flashSuccess = "Akun klien berhasil dihapus.";
            } catch (Throwable $e) {
                $flashError = "Gagal menghapus: " . $e->getMessage();
            }
        }
    }

    // D. TOGGLE STATUS KLIEN
    elseif ($postAction === 'toggle_status') {
        $id     = intval($_POST['id'] ?? 0);
        $status = $_POST['status'] === 'active' ? 'inactive' : 'active';
        if ($id > 0) {
            try {
                $pdo = getCustomerPdo();
                $pdo->prepare("UPDATE `client_access` SET status = ? WHERE id = ?")->execute([$status, $id]);
                $flashSuccess = "Status akun klien berhasil diubah menjadi " . strtoupper($status) . ".";
            } catch (Throwable $e) {
                $flashError = "Gagal mengubah status: " . $e->getMessage();
            }
        }
    }

    // E. MANUAL KIRIM NOTIFIKASI EMAIL AKSES KE KLIEN
    elseif ($postAction === 'send_access_notification_manual') {
        $id          = intval($_POST['id'] ?? 0);
        $targetEmail = strtolower(trim($_POST['target_email'] ?? ''));
        $client      = getCustomerById($id);

        if (!$client) {
            $flashError = "Data akun klien tidak ditemukan.";
        } elseif (empty($targetEmail)) {
            $flashError = "Alamat email target tidak valid.";
        } else {
            $allowedFids = getCustomerAllowedFolderIds($targetEmail);
            if (empty($allowedFids)) {
                $flashError = "Email <strong>{$targetEmail}</strong> belum memiliki akses folder. Notifikasi tidak dapat dikirim.";
            } else {
                $picName = $client['nama'];
                if (strtolower($client['email']) !== $targetEmail) {
                    $addList = parseAdditionalEmails($client['email_tambahan'] ?? '');
                    foreach ($addList as $add) {
                        if (strtolower(trim($add['email'])) === $targetEmail && !empty($add['nama'])) {
                            $picName = $add['nama'];
                            break;
                        }
                    }
                }
                $sent = sendCustomerAccessNotification($targetEmail, $picName, $client['perusahaan'], implode(', ', $allowedFids));
                if ($sent) {
                    $flashSuccess = "Notifikasi email akses berhasil dikirimkan ke <strong>{$targetEmail}</strong>!";
                } else {
                    $flashError = "Gagal mengirimkan notifikasi email ke {$targetEmail}. Silakan periksa koneksi SMTP.";
                }
            }
        }
    }

    // =========================================================================
    // CRUD AKUN MARKETING (Tabel marketing_access)
    // =========================================================================

    // E. TAMBAH MARKETING
    elseif ($postAction === 'marketing_create') {
        $nama      = trim($_POST['nama'] ?? '');
        $email     = strtolower(trim($_POST['email'] ?? ''));
        $divisi    = trim($_POST['divisi'] ?? 'Marketing & Sales');
        $folderIds = trim($_POST['folder_ids'] ?? '');
        $status    = $_POST['status'] ?? 'active';

        if (empty($nama) || empty($email)) {
            $flashError = 'Nama dan Email Perusahaan Marketing wajib diisi.';
        } else {
            try {
                if (getMarketingByEmail($email)) {
                    $flashError = "Email Marketing <strong>{$email}</strong> sudah terdaftar.";
                } else {
                    createMarketing($nama, $email, $divisi, $folderIds, $status);
                    $flashSuccess = "Akun Marketing <strong>{$nama}</strong> ({$email}) berhasil didaftarkan!";
                }
            } catch (Throwable $e) {
                $flashError = "Gagal menyimpan akun marketing: " . $e->getMessage();
            }
        }
    }

    // F. EDIT MARKETING
    elseif ($postAction === 'marketing_update') {
        $id        = intval($_POST['id'] ?? 0);
        $nama      = trim($_POST['nama'] ?? '');
        $email     = strtolower(trim($_POST['email'] ?? ''));
        $divisi    = trim($_POST['divisi'] ?? 'Marketing & Sales');
        $folderIds = trim($_POST['folder_ids'] ?? '');
        $status    = $_POST['status'] ?? 'active';

        if ($id <= 0 || empty($nama) || empty($email)) {
            $flashError = 'Nama dan Email Perusahaan Marketing wajib diisi.';
        } else {
            try {
                $existing = getMarketingByEmail($email);
                if ($existing && $existing['id'] != $id) {
                    $flashError = "Email <strong>{$email}</strong> sudah digunakan oleh akun marketing lain.";
                } else {
                    updateMarketing($id, $nama, $email, $divisi, $folderIds, $status);
                    $flashSuccess = "Data akun Marketing <strong>{$nama}</strong> berhasil diperbarui!";
                }
            } catch (Throwable $e) {
                $flashError = "Gagal memperbarui akun marketing: " . $e->getMessage();
            }
        }
    }

    // G. HAPUS MARKETING
    elseif ($postAction === 'marketing_delete') {
        $id = intval($_POST['id'] ?? 0);
        if ($id > 0) {
            try {
                deleteMarketing($id);
                $flashSuccess = "Akun Marketing berhasil dihapus.";
            } catch (Throwable $e) {
                $flashError = "Gagal menghapus akun marketing: " . $e->getMessage();
            }
        }
    }

    // H. TOGGLE STATUS MARKETING
    elseif ($postAction === 'marketing_toggle_status') {
        $id     = intval($_POST['id'] ?? 0);
        $status = $_POST['status'] === 'active' ? 'inactive' : 'active';
        if ($id > 0) {
            try {
                $pdo = getCustomerPdo();
                $pdo->prepare("UPDATE `marketing_access` SET status = ? WHERE id = ?")->execute([$status, $id]);
                $flashSuccess = "Status akun Marketing berhasil diubah menjadi " . strtoupper($status) . ".";
            } catch (Throwable $e) {
                $flashError = "Gagal mengubah status marketing: " . $e->getMessage();
            }
        }
    }
}

// ----------------------------------------------------------------------------
// 4. AMBIL DATA DAFTAR KLIEN & MARKETING
// ----------------------------------------------------------------------------
$activeTab = $_GET['tab'] ?? ($_POST['active_tab'] ?? 'klien');
if (!empty($_POST['form_action']) && str_starts_with($_POST['form_action'], 'marketing_')) {
    $activeTab = 'marketing';
}

$search = trim($_GET['search'] ?? '');
$statusFilter = trim($_GET['status'] ?? '');
$clients = [];
$totalAll = 0;
$totalActive = 0;
$totalInactive = 0;

$searchMkt = trim($_GET['search_mkt'] ?? '');
$statusMktFilter = trim($_GET['status_mkt'] ?? '');
$marketingList = [];
$totalMarketingAll = 0;
$totalMarketingActive = 0;
$totalMarketingInactive = 0;

if ($isAdmin) {
    try {
        // Data Klien Customer
        $clients = getAllCustomers($search, $statusFilter);
        $allClients = getAllCustomers();
        $totalAll = count($allClients);
        foreach ($allClients as $c) {
            if ($c['status'] === 'active') $totalActive++;
            else $totalInactive++;
        }

        // Data Akun Marketing
        $marketingList = getAllMarketing($searchMkt, $statusMktFilter);
        $allMarketing = getAllMarketing();
        $totalMarketingAll = count($allMarketing);
        foreach ($allMarketing as $m) {
            if ($m['status'] === 'active') $totalMarketingActive++;
            else $totalMarketingInactive++;
        }
    } catch (Throwable $e) {
        $flashError = "Koneksi database bermasalah: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Akun Klien & Hak Akses Sertifikat — PAS Calibration</title>
    <link rel="icon" href="https://www.pascalibration.com/wp-content/uploads/2023/09/logo_pas_basic.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #0284c7;
            --primary-dark: #0369a1;
            --primary-light: #e0f2fe;
            --bg-page: #f8fafc;
            --card-border: #e2e8f0;
            --text-dark: #0f172a;
            --text-muted: #64748b;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-page);
            color: var(--text-dark);
            min-height: 100vh;
        }

        .navbar-custom {
            background: #ffffff;
            border-bottom: 1px solid var(--card-border);
            padding: 0.85rem 0;
        }

        .stat-card {
            background: #ffffff;
            border: 1px solid var(--card-border);
            border-radius: 16px;
            padding: 1.25rem 1.5rem;
            transition: all 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.04);
        }

        .table-custom {
            background: #ffffff;
            border: 1px solid var(--card-border);
            border-radius: 16px;
            overflow: hidden;
        }

        .table-custom thead th {
            background: #f1f5f9;
            color: var(--text-muted);
            font-size: 0.78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid var(--card-border);
            padding: 1rem 1.25rem;
        }

        .table-custom tbody td {
            padding: 1rem 1.25rem;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.9rem;
        }

        .badge-status {
            padding: 0.35rem 0.75rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
        }

        .badge-active {
            background: #dcfce7;
            color: #15803d;
        }

        .badge-inactive {
            background: #fee2e2;
            color: #b91c1c;
        }

        .folder-badge {
            display: inline-block;
            background: #f1f5f9;
            color: #334155;
            padding: 0.2rem 0.5rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-family: 'JetBrains Mono', monospace;
            margin: 2px 2px 2px 0;
            border: 1px solid #e2e8f0;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            padding: 0.6rem 1.25rem;
            transition: all 0.2s ease;
        }

        .btn-primary-custom:hover {
            opacity: 0.95;
            color: white;
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.3);
        }

        .login-box {
            max-width: 420px;
            margin: 80px auto;
            background: #ffffff;
            border: 1px solid var(--card-border);
            border-radius: 20px;
            padding: 2.5rem 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
        }

        /* =====================================================================
           RESPONSIVE & STICKY MODAL FIX (Mencegah Tombol Simpan/Batal Ketutupan)
           ===================================================================== */
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

        .modal-dialog-scrollable .modal-content>form {
            display: flex;
            flex-direction: column;
            height: 100%;
            min-height: 0;
            flex: 1 1 auto;
            overflow: hidden;
            margin-bottom: 0;
        }

        .modal-dialog-scrollable .modal-body {
            overflow-y: auto !important;
            -webkit-overflow-scrolling: touch;
            flex: 1 1 auto;
            max-height: calc(100vh - 210px);
            padding: 1.5rem !important;
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

            .modal-dialog-scrollable .modal-content {
                max-height: calc(100vh - 1rem);
            }

            .modal-dialog-scrollable .modal-body {
                max-height: calc(100vh - 190px);
                padding: 1rem !important;
            }

            .modal-footer-sticky {
                padding: 0.75rem 1rem !important;
                flex-direction: column-reverse;
                gap: 8px;
            }

            .modal-footer-sticky .btn {
                width: 100%;
                margin: 0 !important;
            }
        }

        .extra-email-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-left: 4px solid var(--primary);
            transition: all 0.2s ease;
        }

        .extra-email-card:hover {
            border-color: #cbd5e1;
            border-left-color: #0369a1;
            background: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>

<body>

    <?php if (!$isAdmin): ?>
        <!-- =================================================================== -->
        <!-- FORM LOGIN ADMIN                                                    -->
        <!-- =================================================================== -->
        <div class="container">
            <div class="login-box text-center">
                <img src="https://www.pascalibration.com/wp-content/uploads/2023/09/logo_pas_basic.png" alt="PAS Logo" style="height: 48px; object-fit: contain;" class="mb-3">
                <h4 class="fw-bold mb-1">Admin Panel Klien</h4>
                <p class="text-muted small mb-4">Pengelolaan Hak Akses Sertifikat Digital</p>

                <?php if ($loginError): ?>
                    <div class="alert alert-danger py-2 small rounded-3 mb-3 text-start">
                        <i class="fas fa-exclamation-circle me-1"></i> <?php echo htmlspecialchars($loginError); ?>
                    </div>
                <?php endif; ?>

                <form method="POST">
                    <input type="hidden" name="admin_login" value="1">
                    <div class="mb-3 text-start">
                        <label class="form-label small fw-bold text-secondary">Kunci Sandi Admin (Passkey)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="fas fa-key text-muted"></i></span>
                            <input type="password" name="passkey" class="form-control border-start-0" placeholder="Masukkan passkey admin..." required autofocus>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary-custom w-100 py-2 mt-2">
                        <i class="fas fa-sign-in-alt me-1"></i> Masuk Panel
                    </button>
                </form>

                <div class="mt-4 pt-3 border-top">
                    <a href="https://pascalibration.com/portal-sertifikat" class="text-decoration-none small text-muted">
                        <i class="fas fa-arrow-left me-1"></i> Buka Portal Cari Sertifikat
                    </a>
                </div>
            </div>
        </div>

    <?php else: ?>
        <!-- =================================================================== -->
        <!-- DASHBOARD PANEL ADMIN                                               -->
        <!-- =================================================================== -->

        <!-- Navbar -->
        <nav class="navbar navbar-custom sticky-top">
            <div class="container-fluid px-4 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <img src="https://www.pascalibration.com/wp-content/uploads/2023/09/logo_pas_basic.png" alt="Logo" style="height: 38px;">
                    <div>
                        <h6 class="mb-0 fw-bold">Kelola Akses Klien Google Drive</h6>

                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a href="sendSertifikat.php" target="_blank" class="btn btn-outline-success btn-sm rounded-pill px-3 shadow-sm">
                        <i class="fas fa-paper-plane me-1"></i> Portal Kirim Sertifikat (Marketing)
                    </a>
                    <a href="https://pascalibration.com/portal-sertifikat" target="_blank" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                        <i class="fas fa-external-link-alt me-1"></i> Portal Cari Sertifikat
                    </a>
                    <a href="?action=logout" class="btn btn-outline-danger btn-sm rounded-pill px-3">
                        <i class="fas fa-sign-out-alt me-1"></i> Logout
                    </a>
                </div>
            </div>
        </nav>

        <div class="container-fluid px-4 py-4">

            <!-- Notifikasi Flash -->
            <?php if ($flashSuccess): ?>
                <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
                    <i class="fas fa-check-circle me-1"></i> <?php echo $flashSuccess; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
            <?php if ($flashError): ?>
                <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
                    <i class="fas fa-exclamation-triangle me-1"></i> <?php echo $flashError; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <!-- NAV TABS: KELOLA KLIEN vs KELOLA MARKETING -->
            <ul class="nav nav-pills mb-4 p-1 bg-white rounded-pill border shadow-sm d-inline-flex" id="managementTabs">
                <li class="nav-item">
                    <a class="nav-link rounded-pill px-4 py-2 fw-bold small <?php echo $activeTab === 'klien' ? 'active' : 'text-secondary'; ?>" href="https://pascalibration.com/client-portal?tab=klien">
                        <i class="fas fa-users me-2"></i> Akun Klien Pelanggan
                        <span class="badge <?php echo $activeTab === 'klien' ? 'bg-white text-primary' : 'bg-light text-secondary border'; ?> rounded-pill ms-2"><?php echo $totalAll; ?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rounded-pill px-4 py-2 fw-bold small <?php echo $activeTab === 'marketing' ? 'active' : 'text-secondary'; ?>" href="https://pascalibration.com/client-portal?tab=marketing">
                        <i class="fas fa-bullhorn me-2"></i> Akun Tim Marketing
                        <span class="badge <?php echo $activeTab === 'marketing' ? 'bg-white text-primary' : 'bg-light text-secondary border'; ?> rounded-pill ms-2"><?php echo $totalMarketingAll; ?></span>
                    </a>
                </li>
            </ul>

            <?php if ($activeTab === 'marketing'): ?>
                <!-- =================================================================== -->
                <!-- TAB PANEL: KELOLA AKUN MARKETING (Tabel marketing_access)           -->
                <!-- =================================================================== -->

                <!-- Stat Counter Marketing & Action -->
                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-muted small fw-bold text-uppercase">Total Marketing</div>
                                    <h3 class="fw-bold mb-0 mt-1"><?php echo $totalMarketingAll; ?></h3>
                                </div>
                                <div class="rounded-circle bg-light p-3 text-primary"><i class="fas fa-bullhorn fs-4"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-muted small fw-bold text-uppercase">Marketing Aktif</div>
                                    <h3 class="fw-bold mb-0 mt-1 text-success"><?php echo $totalMarketingActive; ?></h3>
                                </div>
                                <div class="rounded-circle bg-light p-3 text-success"><i class="fas fa-user-check fs-4"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-muted small fw-bold text-uppercase">Marketing Nonaktif</div>
                                    <h3 class="fw-bold mb-0 mt-1 text-danger"><?php echo $totalMarketingInactive; ?></h3>
                                </div>
                                <div class="rounded-circle bg-light p-3 text-danger"><i class="fas fa-user-slash fs-4"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-center">
                        <button class="btn btn-primary-custom w-100 py-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalAddMarketing">
                            <i class="fas fa-plus-circle me-1"></i> Tambah Akun Marketing
                        </button>
                    </div>
                </div>

                <!-- Filter & Search Marketing -->
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-3">
                        <form method="GET" class="row g-2 align-items-center">
                            <input type="hidden" name="tab" value="marketing">
                            <div class="col-md-5">
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-search text-muted"></i></span>
                                    <input type="text" name="search_mkt" class="form-control border-start-0" placeholder="Cari nama marketing, email, atau divisi..." value="<?php echo htmlspecialchars($searchMkt); ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <select name="status_mkt" class="form-select">
                                    <option value="">Semua Status</option>
                                    <option value="active" <?php echo $statusMktFilter === 'active' ? 'selected' : ''; ?>>Hanya Aktif</option>
                                    <option value="inactive" <?php echo $statusMktFilter === 'inactive' ? 'selected' : ''; ?>>Hanya Nonaktif</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100 rounded-3"><i class="fas fa-filter me-1"></i> Filter</button>
                            </div>
                            <div class="col-md-2">
                                <a href="https://pascalibration.com/client-portal?tab=marketing" class="btn btn-light w-100 rounded-3 text-secondary">Reset</a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Tabel Daftar Marketing -->
                <div class="table-custom shadow-sm mb-5">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th style="width: 50px;">#</th>
                                <th>PIC Marketing & Divisi</th>
                                <th>Email Login (OTP)</th>
                                <th>Akses Folder Sertifikat</th>
                                <th>Status</th>
                                <th style="width: 140px;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($marketingList)): ?>
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="fas fa-bullhorn fs-1 mb-2 d-block text-secondary opacity-50"></i>
                                        Belum ada akun tim marketing yang tersimpan. Klik tombol <strong>"Tambah Akun Marketing"</strong> untuk mendaftarkan akun.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php $no = 1;
                                foreach ($marketingList as $m):
                                    $mFolderIds = getMarketingAllowedFolderIds($m['email']);
                                ?>
                                    <tr>
                                        <td class="text-muted fw-bold"><?php echo $no++; ?></td>
                                        <td>
                                            <div class="fw-bold text-dark"><?php echo htmlspecialchars($m['nama']); ?></div>
                                            <div class="text-muted small"><i class="fas fa-briefcase me-1"></i><?php echo htmlspecialchars($m['divisi']); ?></div>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border px-2 py-1 font-monospace">
                                                <i class="far fa-envelope me-1 text-primary"></i><?php echo htmlspecialchars($m['email']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php if (empty($mFolderIds)): ?>
                                                <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">
                                                    <i class="fas fa-globe me-1"></i> Akses Semua Sertifikat (Root)
                                                </span>
                                            <?php else: ?>
                                                <div class="d-flex flex-wrap align-items-center">
                                                    <?php foreach ($mFolderIds as $fid): ?>
                                                        <span class="folder-badge" title="<?php echo htmlspecialchars($fid); ?>">
                                                            <i class="fab fa-google-drive text-warning me-1"></i><?php echo htmlspecialchars($fid); ?>
                                                        </span>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <form method="POST" class="d-inline" onsubmit="return confirm('Ubah status akun marketing ini?');">
                                                <input type="hidden" name="form_action" value="marketing_toggle_status">
                                                <input type="hidden" name="active_tab" value="marketing">
                                                <input type="hidden" name="id" value="<?php echo $m['id']; ?>">
                                                <input type="hidden" name="status" value="<?php echo $m['status']; ?>">
                                                <button type="submit" class="border-0 p-0 bg-transparent text-decoration-none">
                                                    <span class="badge-status <?php echo $m['status'] === 'active' ? 'badge-active' : 'badge-inactive'; ?> shadow-sm">
                                                        <i class="fas <?php echo $m['status'] === 'active' ? 'fa-check' : 'fa-ban'; ?> me-1"></i>
                                                        <?php echo strtoupper($m['status']); ?>
                                                    </span>
                                                </button>
                                            </form>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-outline-primary rounded-pill px-2 me-1"
                                                onclick='openEditMarketingModal(<?php echo json_encode($m); ?>)' title="Edit Marketing">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                            <form method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun marketing <?php echo htmlspecialchars($m['email']); ?>?');">
                                                <input type="hidden" name="form_action" value="marketing_delete">
                                                <input type="hidden" name="active_tab" value="marketing">
                                                <input type="hidden" name="id" value="<?php echo $m['id']; ?>">
                                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-2" title="Hapus Marketing">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            <?php else: ?>
                <!-- =================================================================== -->
                <!-- TAB PANEL: KELOLA AKUN KLIEN CUSTOMER (Tabel client_access)         -->
                <!-- =================================================================== -->

                <!-- Stat Counter & Actions Klien -->
                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-muted small fw-bold text-uppercase">Total Klien</div>
                                    <h3 class="fw-bold mb-0 mt-1"><?php echo $totalAll; ?></h3>
                                </div>
                                <div class="rounded-circle bg-light p-3 text-primary"><i class="fas fa-users fs-4"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-muted small fw-bold text-uppercase">Akun Aktif</div>
                                    <h3 class="fw-bold mb-0 mt-1 text-success"><?php echo $totalActive; ?></h3>
                                </div>
                                <div class="rounded-circle bg-light p-3 text-success"><i class="fas fa-user-check fs-4"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-muted small fw-bold text-uppercase">Akun Nonaktif</div>
                                    <h3 class="fw-bold mb-0 mt-1 text-danger"><?php echo $totalInactive; ?></h3>
                                </div>
                                <div class="rounded-circle bg-light p-3 text-danger"><i class="fas fa-user-slash fs-4"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-center">
                        <button class="btn btn-primary-custom w-100 py-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalAddClient" onclick="resetAddClientModal()">
                            <i class="fas fa-plus-circle me-1"></i> Tambah Klien Baru
                        </button>
                    </div>
                </div>

                <!-- Filter & Search Card Klien -->
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-3">
                        <form method="GET" class="row g-2 align-items-center">
                            <input type="hidden" name="tab" value="klien">
                            <div class="col-md-5">
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-search text-muted"></i></span>
                                    <input type="text" name="search" class="form-control border-start-0" placeholder="Cari nama, email, atau nama PT..." value="<?php echo htmlspecialchars($search); ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <select name="status" class="form-select">
                                    <option value="">Semua Status</option>
                                    <option value="active" <?php echo $statusFilter === 'active' ? 'selected' : ''; ?>>Hanya Aktif</option>
                                    <option value="inactive" <?php echo $statusFilter === 'inactive' ? 'selected' : ''; ?>>Hanya Nonaktif</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100 rounded-3"><i class="fas fa-filter me-1"></i> Filter</button>
                            </div>
                            <div class="col-md-2">
                                <a href="https://pascalibration.com/client-portal?tab=klien" class="btn btn-light w-100 rounded-3 text-secondary">Reset</a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Tabel Daftar Klien -->
                <div class="table-custom shadow-sm mb-5">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th style="width: 50px;">#</th>
                                <th>Klien &amp; Perusahaan</th>
                                <th>Email Login</th>
                                <th>Model &amp; Info Akses</th>
                                <th>Folder Google Drive</th>
                                <th>Status</th>
                                <th style="width: 140px;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($clients)): ?>
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <i class="fas fa-inbox fs-1 mb-2 d-block text-secondary opacity-50"></i>
                                        Belum ada data klien yang tersimpan. Klik tombol <strong>"Tambah Klien Baru"</strong> untuk mendaftarkan akun.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php $no = 1;
                                foreach ($clients as $c):
                                    $folderIdsArray = getCustomerAllowedFolderIds($c['email']);
                                    $additionalEmails = parseAdditionalEmails($c['email_tambahan'] ?? '');
                                    $pendingFolder = empty(trim($c['folder_ids'] ?? ''));
                                ?>
                                    <tr class="<?php echo $pendingFolder ? 'table-warning' : ''; ?>">
                                        <td class="text-muted fw-bold"><?php echo $no++; ?></td>
                                        <td>
                                            <div class="fw-bold text-dark"><?php echo htmlspecialchars($c['nama']); ?></div>
                                            <div class="text-muted small"><i class="far fa-building me-1"></i><?php echo htmlspecialchars($c['perusahaan']); ?></div>
                                            <?php if (!empty($c['jabatan'])): ?>
                                                <div class="text-muted small"><i class="fas fa-id-badge me-1"></i><?php echo htmlspecialchars($c['jabatan']); ?></div>
                                            <?php endif; ?>
                                            <?php if ($pendingFolder): ?>
                                                <span class="badge bg-warning text-dark mt-1" style="font-size:0.68rem;"><i class="fas fa-clock me-1"></i>Menunggu assign folder</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center justify-content-between gap-1 mb-1">
                                                <span class="badge bg-light text-dark border px-2 py-1 font-monospace" title="Email Utama Perusahaan">
                                                    <i class="far fa-envelope me-1 text-primary"></i><?php echo htmlspecialchars($c['email']); ?>
                                                </span>
                                                <?php if (!$pendingFolder): ?>
                                                    <form method="POST" class="d-inline" onsubmit="return confirm('Kirim notifikasi email akses ke email utama: <?php echo htmlspecialchars($c['email']); ?>?');">
                                                        <input type="hidden" name="form_action" value="send_access_notification_manual">
                                                        <input type="hidden" name="id" value="<?php echo $c['id']; ?>">
                                                        <input type="hidden" name="target_email" value="<?php echo htmlspecialchars($c['email']); ?>">
                                                        <button type="submit" class="btn btn-outline-primary btn-xs py-0 px-2 rounded-pill shadow-xs" style="font-size:0.65rem;" title="Kirim Ulang Notifikasi Email Akses">
                                                            <i class="far fa-paper-plane me-1"></i>Kirim Email
                                                        </button>
                                                    </form>
                                                <?php endif; ?>
                                            </div>
                                            <?php if (!empty($additionalEmails)): ?>
                                                <div class="mt-2 d-flex flex-column gap-1">
                                                    <?php foreach ($additionalEmails as $addEm): ?>
                                                        <div class="d-flex align-items-center justify-content-between gap-1 flex-wrap p-1 rounded border bg-light-subtle">
                                                            <div class="d-flex align-items-center gap-1 flex-wrap">
                                                                <span class="badge bg-secondary-subtle text-secondary border font-monospace" style="font-size:0.7rem;">
                                                                    <i class="fas fa-user-plus me-1 text-primary"></i>
                                                                    <?php if (!empty($addEm['nama'])): ?>
                                                                        <strong><?php echo htmlspecialchars($addEm['nama']); ?></strong> —
                                                                    <?php endif; ?>
                                                                    <?php echo htmlspecialchars($addEm['email']); ?>
                                                                    <?php if (!empty($addEm['note'])): ?><span class="text-muted fst-italic ms-1">(<?php echo htmlspecialchars($addEm['note']); ?>)</span><?php endif; ?>
                                                                </span>
                                                                <?php if (!empty($addEm['folder_ids'])): ?>
                                                                    <span class="badge bg-warning-subtle text-dark border border-warning-subtle font-monospace" style="font-size:0.65rem;" title="Folder Khusus: <?php echo htmlspecialchars($addEm['folder_ids']); ?>">
                                                                        <i class="fab fa-google-drive text-warning me-1"></i>Folder Khusus
                                                                    </span>
                                                                <?php else: ?>
                                                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle font-monospace" style="font-size:0.65rem;" title="Belum memiliki akses folder apapun">
                                                                        <i class="fas fa-ban me-1"></i>Belum Ada Akses Folder
                                                                    </span>
                                                                <?php endif; ?>
                                                            </div>
                                                            <?php if (!empty($addEm['folder_ids'])): ?>
                                                                <form method="POST" class="d-inline" onsubmit="return confirm('Kirim notifikasi email akses ke email tambahan: <?php echo htmlspecialchars($addEm['email']); ?>?');">
                                                                    <input type="hidden" name="form_action" value="send_access_notification_manual">
                                                                    <input type="hidden" name="id" value="<?php echo $c['id']; ?>">
                                                                    <input type="hidden" name="target_email" value="<?php echo htmlspecialchars($addEm['email']); ?>">
                                                                    <button type="submit" class="btn btn-outline-primary btn-xs py-0 px-2 rounded-pill shadow-xs" style="font-size:0.65rem;" title="Kirim Ulang Notifikasi Email Akses">
                                                                        <i class="far fa-paper-plane me-1"></i>Kirim Email
                                                                    </button>
                                                                </form>
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if (!empty($c['model_akses'])): ?>
                                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1 small">
                                                    <i class="fas fa-sitemap me-1"></i><?php echo htmlspecialchars($c['model_akses']); ?>
                                                </span>
                                            <?php else: ?>
                                                <span class="text-muted small fst-italic">—</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if (empty($folderIdsArray)): ?>
                                                <span class="text-danger small fst-italic"><i class="fas fa-exclamation-circle me-1"></i>Belum ada folder diatur</span>
                                            <?php else: ?>
                                                <div class="d-flex flex-wrap align-items-center">
                                                    <?php foreach ($folderIdsArray as $fid): ?>
                                                        <span class="folder-badge" title="<?php echo htmlspecialchars($fid); ?>">
                                                            <i class="fab fa-google-drive text-warning me-1"></i><?php echo htmlspecialchars($fid); ?>
                                                        </span>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <form method="POST" class="d-inline" onsubmit="return confirm('Ubah status akun ini?');">
                                                <input type="hidden" name="form_action" value="toggle_status">
                                                <input type="hidden" name="active_tab" value="klien">
                                                <input type="hidden" name="id" value="<?php echo $c['id']; ?>">
                                                <input type="hidden" name="status" value="<?php echo $c['status']; ?>">
                                                <button type="submit" class="border-0 p-0 bg-transparent text-decoration-none">
                                                    <span class="badge-status <?php echo $c['status'] === 'active' ? 'badge-active' : 'badge-inactive'; ?> shadow-sm">
                                                        <i class="fas <?php echo $c['status'] === 'active' ? 'fa-check' : 'fa-ban'; ?> me-1"></i>
                                                        <?php echo strtoupper($c['status']); ?>
                                                    </span>
                                                </button>
                                            </form>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-outline-primary rounded-pill px-2 me-1"
                                                onclick='openEditModal(<?php echo json_encode($c); ?>)' title="Edit Klien">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                            <form method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun <?php echo htmlspecialchars($c['email']); ?>?');">
                                                <input type="hidden" name="form_action" value="delete">
                                                <input type="hidden" name="active_tab" value="klien">
                                                <input type="hidden" name="id" value="<?php echo $c['id']; ?>">
                                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-2" title="Hapus Klien">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            <?php endif; ?>

        </div>

        <!-- =================================================================== -->
        <!-- MODAL TAMBAH KLIEN                                                  -->
        <!-- =================================================================== -->
        <div class="modal fade" id="modalAddClient" tabindex="-1">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content rounded-4 border-0 shadow">
                    <form method="POST" class="d-flex flex-column h-100 mb-0">
                        <input type="hidden" name="form_action" value="create">
                        <div class="modal-header modal-header-sticky px-4 py-3">
                            <h5 class="modal-title fw-bold text-dark mb-0"><i class="fas fa-user-plus text-primary me-2"></i>Tambah Akun Klien Baru</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body p-4">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Nama PIC / Penanggung Jawab *</label>
                                    <input type="text" name="nama" class="form-control" placeholder="Masukkan nama" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Email Perusahaan (Login OTP) *</label>
                                    <input type="email" name="email" class="form-control" placeholder="Contoh: nama@perusahaan.com" required>
                                    <div class="form-text" style="font-size: 0.72rem;">*Bisa domain perusahaan apa saja (tidak wajib @gmail.com)</div>
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label small fw-bold">Nama Perusahaan / PT *</label>
                                    <input type="text" name="perusahaan" class="form-control" placeholder="Contoh: PT Indofood CBP Sukses Makmur" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold">Jabatan / Divisi</label>
                                    <input type="text" name="jabatan" class="form-control" placeholder="Contoh: QA Manager">
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-bold">Model Akses Folder</label>
                                    <select name="model_akses" class="form-select">
                                        <option value="MODEL A">MODEL A — Satu folder PT, tanpa subfolder tambahan</option>
                                        <option value="MODEL B">MODEL B — Folder PT dengan subfolder Lokasi/Plant</option>
                                        <option value="MODEL C">MODEL C — Folder PT dengan subfolder # PO</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <label class="form-label small fw-bold mb-0">Folder Google Drive (Email Utama / Folder PT) *</label>
                                        <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-3 shadow-sm" onclick="openDrivePicker('addFolderIds')">
                                            <i class="fab fa-google-drive text-warning me-1"></i> <strong>Pilih dari GDrive</strong>
                                        </button>
                                    </div>
                                    <textarea name="folder_ids" id="addFolderIds" class="form-control font-monospace" rows="2" placeholder="Folder ID atau URL Google Drive folder utama PT (bisa diisi setelah pendaftaran)"></textarea>
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="checkGdriveFolder('addFolderIds', 'addFolderFeedback')">
                                            <i class="fas fa-check-circle me-1"></i> Cek Folder di GDrive
                                        </button>
                                    </div>
                                    <div id="addFolderFeedback" class="mt-2 small"></div>
                                </div>

                                <!-- Daftar Email Tambahan (Per Satu Email) -->
                                <div class="col-12 mt-2 pt-3 border-top">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div>
                                            <label class="form-label small fw-bold mb-0 text-dark">
                                                <i class="fas fa-user-plus text-primary me-1"></i> Email Tambahan &amp; Hak Akses Folder
                                            </label>
                                            <div class="form-text mt-0" style="font-size: 0.72rem;">
                                                Dikelola per satu email. Setiap email dapat login ke portal cariSertifikat via OTP secara mandiri.
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-3 shadow-sm" onclick="addClientExtraRow('addExtraEmailContainer')">
                                            <i class="fas fa-plus me-1"></i> Tambah Email
                                        </button>
                                    </div>
                                    <div id="addExtraEmailContainer" class="d-flex flex-column gap-2 mb-2"></div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Status Akun</label>
                                    <select name="status" class="form-select">
                                        <option value="active">Aktif (Dapat Login &amp; Akses)</option>
                                        <option value="inactive">Nonaktif (Akses Ditutup)</option>
                                    </select>
                                </div>
                                <div class="col-12 mt-2 pt-2 border-top">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="send_notification" id="addSendNotification" value="1" checked>
                                        <label class="form-check-label small fw-semibold text-dark" for="addSendNotification">
                                            <i class="far fa-paper-plane text-primary me-1"></i>Kirim Notifikasi Email Akses ke Pelanggan (Link cariSertifikat)
                                        </label>
                                        <div class="form-text" style="font-size: 0.72rem;">
                                            *Hanya dikirimkan ke email yang sudah diberikan akses folder. Email tambahan tanpa folder tidak akan dikirimi email.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer modal-footer-sticky px-4 py-3 d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary-custom px-4"><i class="fas fa-save me-1"></i>Simpan Klien</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- =================================================================== -->
        <!-- MODAL EDIT KLIEN                                                    -->
        <!-- =================================================================== -->
        <div class="modal fade" id="modalEditClient" tabindex="-1">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content rounded-4 border-0 shadow">
                    <form method="POST" class="d-flex flex-column h-100 mb-0">
                        <input type="hidden" name="form_action" value="update">
                        <input type="hidden" name="id" id="editId">
                        <div class="modal-header modal-header-sticky px-4 py-3">
                            <h5 class="modal-title fw-bold text-dark mb-0"><i class="fas fa-user-edit text-primary me-2"></i>Edit Akun Klien</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body p-4">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Nama PIC / Penanggung Jawab *</label>
                                    <input type="text" name="nama" id="editNama" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Email Perusahaan (Login OTP) *</label>
                                    <input type="email" name="email" id="editEmail" class="form-control" required>
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label small fw-bold">Nama Perusahaan / PT *</label>
                                    <input type="text" name="perusahaan" id="editPerusahaan" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold">Jabatan / Divisi</label>
                                    <input type="text" name="jabatan" id="editJabatan" class="form-control" placeholder="Contoh: QA Manager">
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-bold">Model Akses Folder</label>
                                    <select name="model_akses" id="editModelAkses" class="form-select">
                                        <option value="MODEL A">MODEL A — Satu folder PT, tanpa subfolder tambahan</option>
                                        <option value="MODEL B">MODEL B — Folder PT dengan subfolder Lokasi/Plant</option>
                                        <option value="MODEL C">MODEL C — Folder PT dengan subfolder # PO</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <label class="form-label small fw-bold mb-0">Folder Google Drive (Email Utama / Folder PT) *</label>
                                        <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-3 shadow-sm" onclick="openDrivePicker('editFolderIds')">
                                            <i class="fab fa-google-drive text-warning me-1"></i> <strong>Pilih dari GDrive</strong>
                                        </button>
                                    </div>
                                    <textarea name="folder_ids" id="editFolderIds" class="form-control font-monospace" rows="2"></textarea>
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <div class="form-text small" style="font-size: 0.72rem;">
                                            Gunakan tombol "Pilih dari GDrive" di atas untuk menambah atau mengganti folder.
                                        </div>
                                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="checkGdriveFolder('editFolderIds', 'editFolderFeedback')">
                                            <i class="fas fa-check-circle me-1"></i> Cek Folder di GDrive
                                        </button>
                                    </div>
                                    <div id="editFolderFeedback" class="mt-2 small"></div>
                                </div>

                                <!-- Daftar Email Tambahan (Per Satu Email) -->
                                <div class="col-12 mt-2 pt-3 border-top">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div>
                                            <label class="form-label small fw-bold mb-0 text-dark">
                                                <i class="fas fa-user-plus text-primary me-1"></i> Email Tambahan &amp; Hak Akses Folder
                                            </label>
                                            <div class="form-text mt-0" style="font-size: 0.72rem;">
                                                Dikelola per satu email. Setiap email dapat login ke portal cariSertifikat via OTP secara mandiri.
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-3 shadow-sm" onclick="addClientExtraRow('editExtraEmailContainer')">
                                            <i class="fas fa-plus me-1"></i> Tambah Email
                                        </button>
                                    </div>
                                    <div id="editExtraEmailContainer" class="d-flex flex-column gap-2 mb-2"></div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Status Akun</label>
                                    <select name="status" id="editStatus" class="form-select">
                                        <option value="active">Aktif (Dapat Login &amp; Akses)</option>
                                        <option value="inactive">Nonaktif (Akses Ditutup)</option>
                                    </select>
                                </div>
                                <div class="col-12 mt-2 pt-2 border-top">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="send_notification" id="editSendNotification" value="1" checked>
                                        <label class="form-check-label small fw-semibold text-dark" for="editSendNotification">
                                            <i class="far fa-paper-plane text-primary me-1"></i>Kirim Notifikasi Email Akses ke Pelanggan (Link cariSertifikat)
                                        </label>
                                        <div class="form-text" style="font-size: 0.72rem;">
                                            *Dikirimkan otomatis jika ada akses folder baru yang diberikan atau diperbarui. Email tambahan tanpa folder tidak akan dikirimi email.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer modal-footer-sticky px-4 py-3 d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary-custom px-4"><i class="fas fa-save me-1"></i>Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- =================================================================== -->
        <!-- MODAL TAMBAH MARKETING                                              -->
        <!-- =================================================================== -->
        <div class="modal fade" id="modalAddMarketing" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content rounded-4 border-0 shadow">
                    <form method="POST" class="d-flex flex-column h-100 mb-0">
                        <input type="hidden" name="form_action" value="marketing_create">
                        <input type="hidden" name="active_tab" value="marketing">
                        <div class="modal-header modal-header-sticky px-4 py-3">
                            <h5 class="modal-title fw-bold text-dark mb-0"><i class="fas fa-bullhorn text-primary me-2"></i>Tambah Akun Tim Marketing Baru</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body p-4">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Nama Lengkap PIC Marketing *</label>
                                    <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Email Perusahaan (Login OTP) *</label>
                                    <input type="email" name="email" class="form-control" placeholder="Contoh: nama@pascalibration.com" required>
                                    <div class="form-text" style="font-size: 0.72rem;">*Email internal perusahaan untuk menerima kode OTP login portal kirim sertifikat</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Divisi / Bagian *</label>
                                    <input type="text" name="divisi" class="form-control" placeholder="Contoh: Marketing" value="Marketing" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Status Akun</label>
                                    <select name="status" class="form-select">
                                        <option value="active">Aktif (Dapat Login & Kirim Sertifikat)</option>
                                        <option value="inactive">Nonaktif (Akses Ditutup)</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <label class="form-label small fw-bold mb-0">Cakupan Akses Folder Google Drive (Opsional)</label>
                                        <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-3 shadow-sm" onclick="openDrivePicker('addMarketingFolderIds')">
                                            <i class="fab fa-google-drive text-warning me-1"></i> <strong>Pilih dari GDrive</strong>
                                        </button>
                                    </div>
                                    <textarea name="folder_ids" id="addMarketingFolderIds" class="form-control font-monospace" rows="3" placeholder="Biarkan KOSONG jika ingin marketing ini dapat mengakses & mencari SEMUA folder sertifikat klien di root GDrive..."></textarea>
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <div class="form-text small" style="font-size: 0.72rem;">
                                            <i class="fas fa-info-circle text-primary me-1"></i><strong>Tips:</strong> Jika dikosongkan, akun marketing memiliki akses universal ke seluruh folder sertifikat untuk keperluan pengiriman email ke semua klien.
                                        </div>
                                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="checkGdriveFolder('addMarketingFolderIds', 'addMarketingFolderFeedback')">
                                            <i class="fas fa-check-circle me-1"></i> Cek Folder di GDrive
                                        </button>
                                    </div>
                                    <div id="addMarketingFolderFeedback" class="mt-2 small"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer modal-footer-sticky px-4 py-3 d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary-custom px-4"><i class="fas fa-save me-1"></i> Simpan Akun Marketing</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- =================================================================== -->
        <!-- MODAL EDIT MARKETING                                                -->
        <!-- =================================================================== -->
        <div class="modal fade" id="modalEditMarketing" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content rounded-4 border-0 shadow">
                    <form method="POST" class="d-flex flex-column h-100 mb-0">
                        <input type="hidden" name="form_action" value="marketing_update">
                        <input type="hidden" name="active_tab" value="marketing">
                        <input type="hidden" name="id" id="editMarketingId">
                        <div class="modal-header modal-header-sticky px-4 py-3">
                            <h5 class="modal-title fw-bold text-dark mb-0"><i class="fas fa-user-edit text-primary me-2"></i>Edit Akun Tim Marketing</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body p-4">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Nama Lengkap PIC Marketing *</label>
                                    <input type="text" name="nama" id="editMarketingNama" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Email Perusahaan (Login OTP) *</label>
                                    <input type="email" name="email" id="editMarketingEmail" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Divisi / Bagian *</label>
                                    <input type="text" name="divisi" id="editMarketingDivisi" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Status Akun</label>
                                    <select name="status" id="editMarketingStatus" class="form-select">
                                        <option value="active">Aktif (Dapat Login & Kirim Sertifikat)</option>
                                        <option value="inactive">Nonaktif (Akses Ditutup)</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <label class="form-label small fw-bold mb-0">Cakupan Akses Folder Google Drive (Opsional)</label>
                                        <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-3 shadow-sm" onclick="openDrivePicker('editMarketingFolderIds')">
                                            <i class="fab fa-google-drive text-warning me-1"></i> <strong>Pilih dari GDrive</strong>
                                        </button>
                                    </div>
                                    <textarea name="folder_ids" id="editMarketingFolderIds" class="form-control font-monospace" rows="3" placeholder="Biarkan KOSONG jika ingin marketing ini dapat mengakses & mencari SEMUA folder sertifikat klien di root GDrive..."></textarea>
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <div class="form-text small" style="font-size: 0.72rem;">
                                            Kosongkan jika akun ini berwenang melayani pengiriman seluruh sertifikat klien.
                                        </div>
                                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="checkGdriveFolder('editMarketingFolderIds', 'editMarketingFolderFeedback')">
                                            <i class="fas fa-check-circle me-1"></i> Cek Folder di GDrive
                                        </button>
                                    </div>
                                    <div id="editMarketingFolderFeedback" class="mt-2 small"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer modal-footer-sticky px-4 py-3 d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary-custom px-4"><i class="fas fa-save me-1"></i> Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- =================================================================== -->
        <!-- MODAL DRIVE PICKER (PILIH FOLDER / SUBFOLDER / FILE DARI GDRIVE)    -->
        <!-- =================================================================== -->
        <div class="modal fade" id="modalDrivePicker" tabindex="-1" style="z-index: 1060;">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content rounded-4 border-0 shadow-lg">
                    <div class="modal-header modal-header-sticky border-bottom px-4 py-3 bg-light">
                        <div>
                            <h5 class="modal-title fw-bold text-dark mb-0">
                                <i class="fab fa-google-drive text-warning me-2"></i>Pilih Folder / Berkas dari Google Drive
                            </h5>
                            <small class="text-muted" style="font-size: 0.78rem;">
                                Jelajahi folder atau gunakan pencarian untuk memilih folder/subfolder/berkas sertifikat yang diizinkan.
                            </small>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body p-4">
                        <!-- Search & Navigation Bar -->
                        <div class="row g-2 align-items-center mb-3">
                            <div class="col-md-7">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                                    <input type="text" id="pickerSearchInput" class="form-control border-start-0" placeholder="Ketik nama folder PT, sertifikat, atau nomor alat..." onkeydown="if(event.key==='Enter'){event.preventDefault();doPickerSearch();}">
                                    <button type="button" class="btn btn-primary" onclick="doPickerSearch()">
                                        <i class="fas fa-search me-1"></i> Cari
                                    </button>
                                    <button type="button" class="btn btn-light border" onclick="resetPickerSearch()" title="Reset pencarian">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-5 d-flex justify-content-md-end gap-2">
                                <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill px-3" onclick="navigateDriveUp()" id="btnDriveUp" disabled>
                                    <i class="fas fa-level-up-alt me-1"></i> Naik 1 Level
                                </button>
                                <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-3" onclick="refreshDriveCurrent()">
                                    <i class="fas fa-sync-alt me-1"></i> Muat Ulang
                                </button>
                            </div>
                        </div>

                        <!-- Breadcrumbs Bar -->
                        <div class="bg-light p-2 px-3 rounded-3 mb-3 d-flex align-items-center overflow-auto" style="white-space: nowrap; font-size: 0.85rem;" id="driveBreadcrumbs">
                            <span class="text-muted"><i class="fas fa-spinner fa-spin me-1"></i> Memuat...</span>
                        </div>

                        <!-- Items Container -->
                        <div class="border rounded-3 overflow-hidden bg-white" style="min-height: 280px; max-height: 420px; overflow-y: auto;" id="driveItemsList">
                            <!-- Items rendered by JS -->
                        </div>

                        <!-- Selected Items Tray -->
                        <div class="mt-3 p-3 bg-light rounded-3 border">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold small text-dark">
                                    <i class="fas fa-check-double text-success me-1"></i> Item yang Dipilih: <span id="selectedCountBadge" class="badge bg-primary rounded-pill">0</span>
                                </span>
                                <button type="button" class="btn btn-link btn-sm text-danger text-decoration-none p-0" onclick="clearSelectedPickerItems()">
                                    <i class="fas fa-trash-alt me-1"></i> Kosongkan Pilihan
                                </button>
                            </div>
                            <div id="pickerSelectedTags" class="d-flex flex-wrap gap-1" style="min-height: 32px;">
                                <span class="text-muted small fst-italic">Belum ada item yang dipilih. Klik tombol "+ Pilih" pada daftar di atas.</span>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer modal-footer-sticky border-top px-4 py-3 bg-light d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-success rounded-pill px-4 fw-bold" onclick="applyDrivePickerSelection()">
                            <i class="fas fa-check-circle me-1"></i> Terapkan Pilihan ke Form
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scripts Bootstrap & Client Modal Helper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            let extraRowCounter = 0;

            function resetAddClientModal() {
                const container = document.getElementById('addExtraEmailContainer');
                if (container) container.innerHTML = '';
                const feedback = document.getElementById('addFolderFeedback');
                if (feedback) feedback.innerHTML = '';
            }

            function parseClientAdditionalEmails(raw) {
                if (!raw) return [];
                if (Array.isArray(raw)) return raw;
                if (typeof raw === 'object') return [raw];

                const str = String(raw).trim();
                if (!str) return [];

                if (str.startsWith('[') || str.startsWith('{')) {
                    try {
                        const parsed = JSON.parse(str);
                        if (Array.isArray(parsed)) {
                            return parsed.map(item => {
                                if (typeof item === 'object' && item !== null) {
                                    return {
                                        nama: item.nama || '',
                                        email: item.email || '',
                                        note: item.note || '',
                                        folder_ids: item.folder_ids || ''
                                    };
                                } else if (typeof item === 'string') {
                                    return {
                                        nama: '',
                                        email: item,
                                        note: '',
                                        folder_ids: ''
                                    };
                                }
                                return null;
                            }).filter(Boolean);
                        } else if (typeof parsed === 'object') {
                            return [{
                                nama: parsed.nama || '',
                                email: parsed.email || '',
                                note: parsed.note || '',
                                folder_ids: parsed.folder_ids || ''
                            }];
                        }
                    } catch (e) {
                        // fallback to string delimiter parser
                    }
                }

                const results = [];
                const lines = str.split(/[\r\n]+/);
                for (const line of lines) {
                    const trimmed = line.trim();
                    if (!trimmed) continue;
                    if (trimmed.includes(';')) {
                        const parts = trimmed.split(';').map(s => s.trim()).filter(Boolean);
                        for (let i = 0; i < parts.length; i += 2) {
                            const em = parts[i] || '';
                            const nt = parts[i + 1] || '';
                            if (em.includes('@')) {
                                results.push({
                                    nama: '',
                                    email: em,
                                    note: nt,
                                    folder_ids: ''
                                });
                            }
                        }
                    } else {
                        const match = trimmed.match(/([a-zA-Z0-9_\.\+-]+@[a-zA-Z0-9\.-]+\.[a-zA-Z]{2,})(?:\s*[-:,]\s*(.*))?/);
                        if (match) {
                            results.push({
                                nama: '',
                                email: match[1],
                                note: (match[2] || '').trim(),
                                folder_ids: ''
                            });
                        }
                    }
                }
                return results;
            }

            function addClientExtraRow(containerId, data = {}) {
                const container = document.getElementById(containerId);
                if (!container) return;

                extraRowCounter++;
                const rowId = `extra_row_${extraRowCounter}`;
                const folderInputId = `extra_folder_${extraRowCounter}`;
                const namaVal = escapeAttr(data.nama || '');
                const emailVal = escapeAttr(data.email || '');
                const noteVal = escapeAttr(data.note || '');
                const folderVal = escapeAttr(data.folder_ids || '');

                const card = document.createElement('div');
                card.className = 'extra-email-card p-3 rounded-3 shadow-sm';
                card.id = rowId;
                card.innerHTML = `
                <div class="d-flex justify-content-between align-items-center mb-2 pb-1 border-bottom">
                    <span class="small fw-bold text-primary">
                        <i class="fas fa-user-plus me-1"></i> Email Tambahan <span class="badge bg-primary-subtle text-primary border ms-1 item-idx"></span>
                    </span>
                    <button type="button" class="btn btn-outline-danger btn-sm py-0 px-2 rounded-pill" onclick="removeClientExtraRow('${rowId}')" title="Hapus email ini">
                        <i class="fas fa-trash-alt me-1"></i><span style="font-size:0.75rem;">Hapus</span>
                    </button>
                </div>
                <div class="row g-2">
                    <div class="col-md-6">
                        <label class="form-label small fw-semibold text-secondary mb-1">Nama Karyawan / PIC *</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-white"><i class="fas fa-user text-muted"></i></span>
                            <input type="text" name="add_nama_list[]" class="form-control" placeholder="Contoh: Budi Santoso" value="${namaVal}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-semibold text-secondary mb-1">Email Karyawan / PIC *</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-white"><i class="far fa-envelope text-muted"></i></span>
                            <input type="email" name="add_email_list[]" class="form-control" placeholder="staff@perusahaan.com" value="${emailVal}" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label small fw-semibold text-secondary mb-1">Keterangan (Plant / Divisi / #PO)</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-white"><i class="fas fa-tag text-muted"></i></span>
                            <input type="text" name="add_note_list[]" class="form-control" placeholder="Contoh: Plant Karawang" value="${noteVal}">
                        </div>
                    </div>
                    <div class="col-12 mt-1">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label class="form-label small fw-semibold text-secondary mb-0">Folder Google Drive Khusus (Opsional):</label>
                            <button type="button" class="btn btn-outline-primary btn-sm py-0 px-2 rounded-pill" style="font-size:0.75rem;" onclick="openDrivePicker('${folderInputId}')">
                                <i class="fab fa-google-drive text-warning me-1"></i> Pilih dari GDrive
                            </button>
                        </div>
                        <input type="text" name="add_folder_list[]" id="${folderInputId}" class="form-control form-control-sm font-monospace" placeholder="Folder ID / URL GDrive khusus akses email ini" value="${folderVal}">
                        <div class="form-text mt-1" style="font-size: 0.68rem;">*Email tambahan hanya bisa mengakses folder yang diisi di sini. Jika dikosongkan, email ini tidak memiliki akses ke folder manapun.</div>
                    </div>
                </div>
            `;

                container.appendChild(card);
                updateExtraEmailIndices(containerId);
            }

            function removeClientExtraRow(rowId) {
                const el = document.getElementById(rowId);
                if (!el) return;
                const container = el.parentElement;
                el.remove();
                if (container && container.id) {
                    updateExtraEmailIndices(container.id);
                }
            }

            function updateExtraEmailIndices(containerId) {
                const container = document.getElementById(containerId);
                if (!container) return;
                const cards = container.querySelectorAll('.extra-email-card');
                cards.forEach((c, idx) => {
                    const badge = c.querySelector('.item-idx');
                    if (badge) badge.textContent = `#${idx + 1}`;
                });
            }

            function openEditModal(client) {
                document.getElementById('editId').value = client.id || '';
                document.getElementById('editNama').value = client.nama || '';
                document.getElementById('editEmail').value = client.email || '';
                document.getElementById('editPerusahaan').value = client.perusahaan || '';
                document.getElementById('editJabatan').value = client.jabatan || '';
                document.getElementById('editModelAkses').value = client.model_akses || 'MODEL A';
                document.getElementById('editFolderIds').value = client.folder_ids || '';
                document.getElementById('editStatus').value = client.status || 'active';
                document.getElementById('editFolderFeedback').innerHTML = '';

                const editContainer = document.getElementById('editExtraEmailContainer');
                if (editContainer) {
                    editContainer.innerHTML = '';
                    const extras = parseClientAdditionalEmails(client.email_tambahan);
                    if (extras && extras.length > 0) {
                        extras.forEach(item => {
                            addClientExtraRow('editExtraEmailContainer', item);
                        });
                    }
                }

                const modal = new bootstrap.Modal(document.getElementById('modalEditClient'));
                modal.show();
            }

            function openEditMarketingModal(marketing) {
                document.getElementById('editMarketingId').value = marketing.id;
                document.getElementById('editMarketingNama').value = marketing.nama;
                document.getElementById('editMarketingEmail').value = marketing.email;
                document.getElementById('editMarketingDivisi').value = marketing.divisi;
                document.getElementById('editMarketingFolderIds').value = marketing.folder_ids || '';
                document.getElementById('editMarketingStatus').value = marketing.status;
                document.getElementById('editMarketingFolderFeedback').innerHTML = '';

                const modal = new bootstrap.Modal(document.getElementById('modalEditMarketing'));
                modal.show();
            }

            // Cek Folder ID ke Google Drive via AJAX
            function checkGdriveFolder(textareaId, feedbackId) {
                const val = document.getElementById(textareaId).value.trim();
                const feedback = document.getElementById(feedbackId);
                if (!val) {
                    feedback.innerHTML = '<span class="text-danger"><i class="fas fa-times me-1"></i>Isi Folder ID terlebih dahulu.</span>';
                    return;
                }

                const firstId = val.split(/[\r\n,;]+/)[0].trim();
                feedback.innerHTML = '<span class="text-secondary"><i class="fas fa-spinner fa-spin me-1"></i>Memeriksa folder di Google Drive...</span>';

                fetch('https://pascalibration.com/client-portal?ajax=check_folder&folder_id=' + encodeURIComponent(firstId))
                    .then(r => r.json())
                    .then(res => {
                        if (res.valid) {
                            feedback.innerHTML = `<span class="text-success fw-bold"><i class="fas fa-check-circle me-1"></i>Folder Ditemukan: "${res.name}" (ID: ${res.folder_id})</span>`;
                        } else {
                            feedback.innerHTML = `<span class="text-danger"><i class="fas fa-exclamation-triangle me-1"></i>${res.message}</span>`;
                        }
                    })
                    .catch(err => {
                        feedback.innerHTML = `<span class="text-danger"><i class="fas fa-times me-1"></i>Gagal cek: ${err.message}</span>`;
                    });
            }

            // =====================================================================
            // GOOGLE DRIVE VISUAL PICKER LOGIC
            // =====================================================================
            let activeTargetTextareaId = '';
            let pickerCurrentFolderId = '<?php echo $rootFolderId; ?>';
            let pickerHistoryStack = []; // [{id: ..., name: ...}]
            let pickerSelectedMap = new Map(); // id => {id, name, isFolder}

            function openDrivePicker(targetTextareaId) {
                activeTargetTextareaId = targetTextareaId;
                pickerSelectedMap.clear();

                // Ambil ID yang sudah ada di textarea saat ini (jika ada)
                const existingVal = document.getElementById(targetTextareaId).value.trim();
                if (existingVal) {
                    const lines = existingVal.split(/[\r\n,;]+/);
                    lines.forEach(id => {
                        id = id.trim();
                        if (id) {
                            pickerSelectedMap.set(id, {
                                id: id,
                                name: id,
                                isFolder: true
                            });
                        }
                    });
                }

                renderPickerSelectedTags();

                pickerCurrentFolderId = '<?php echo $rootFolderId; ?>';
                pickerHistoryStack = [{
                    id: '<?php echo $rootFolderId; ?>',
                    name: 'Root (PAS DIGITAL)'
                }];
                document.getElementById('pickerSearchInput').value = '';

                loadDriveFolder(pickerCurrentFolderId);

                const modal = new bootstrap.Modal(document.getElementById('modalDrivePicker'));
                modal.show();
            }

            function loadDriveFolder(folderId, search = '') {
                const listEl = document.getElementById('driveItemsList');
                listEl.innerHTML = '<div class="p-5 text-center text-muted"><div class="spinner-border text-primary spinner-border-sm me-2"></div>Memuat isi Google Drive...</div>';

                let url = 'https://pascalibration.com/client-portal?ajax=browse_drive&folder_id=' + encodeURIComponent(folderId);
                if (search) {
                    url += '&search=' + encodeURIComponent(search);
                }

                fetch(url)
                    .then(r => r.json())
                    .then(res => {
                        if (!res.success) {
                            listEl.innerHTML = `<div class="p-4 text-center text-danger"><i class="fas fa-exclamation-triangle me-1"></i>${res.message || 'Gagal memuat data.'}</div>`;
                            return;
                        }

                        pickerCurrentFolderId = res.current_id;
                        updatePickerBreadcrumbs(res);

                        const btnUp = document.getElementById('btnDriveUp');
                        if (btnUp) {
                            btnUp.disabled = (pickerHistoryStack.length <= 1);
                        }

                        if (!res.items || res.items.length === 0) {
                            listEl.innerHTML = '<div class="p-5 text-center text-muted"><i class="far fa-folder-open fs-2 d-block text-secondary mb-2 opacity-50"></i>Folder ini kosong atau tidak ada item yang cocok dengan pencarian.</div>';
                            return;
                        }

                        let html = '<div class="list-group list-group-flush">';
                        res.items.forEach(item => {
                            const isSelected = pickerSelectedMap.has(item.id);
                            const isFolder = item.isFolder;
                            const iconClass = isFolder ? 'fas fa-folder text-warning fs-5' : (item.mimeType.includes('pdf') ? 'far fa-file-pdf text-danger fs-5' : 'far fa-file-alt text-primary fs-5');
                            const typeBadge = isFolder ? '<span class="badge bg-warning bg-opacity-10 text-dark border border-warning-subtle small ms-2">Folder</span>' : '<span class="badge bg-light text-secondary border small ms-2">Berkas</span>';

                            html += `
                            <div class="list-group-item d-flex align-items-center justify-content-between p-3 ${isSelected ? 'bg-light' : ''}">
                                <div class="d-flex align-items-center gap-3 overflow-hidden me-2">
                                    <div><i class="${iconClass}"></i></div>
                                    <div class="overflow-hidden">
                                        <div class="fw-bold text-dark text-truncate" title="${escapeHtml(item.name)}">
                                            ${escapeHtml(item.name)} ${typeBadge}
                                        </div>
                                        <div class="text-muted font-monospace" style="font-size: 0.72rem;">ID: ${item.id}</div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center gap-2 flex-shrink-0">
                                    ${isFolder ? `
                                        <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3" onclick="navigateToFolder('${item.id}', '${escapeAttr(item.name)}')">
                                            <i class="fas fa-folder-open me-1"></i> Buka
                                        </button>
                                    ` : ''}
                                    <button type="button" class="btn btn-sm ${isSelected ? 'btn-success' : 'btn-outline-success'} rounded-pill px-3" onclick="togglePickerSelect('${item.id}', '${escapeAttr(item.name)}', ${isFolder})">
                                        <i class="fas ${isSelected ? 'fa-check' : 'fa-plus'} me-1"></i> ${isSelected ? 'Terpilih' : 'Pilih'}
                                    </button>
                                </div>
                            </div>
                        `;
                        });
                        html += '</div>';
                        listEl.innerHTML = html;
                    })
                    .catch(err => {
                        listEl.innerHTML = `<div class="p-4 text-center text-danger">Error: ${err.message}</div>`;
                    });
            }

            function updatePickerBreadcrumbs(res) {
                const bcEl = document.getElementById('driveBreadcrumbs');
                if (!bcEl) return;

                let html = '<i class="fas fa-folder-tree text-primary me-2"></i> ';
                pickerHistoryStack.forEach((h, index) => {
                    const isLast = (index === pickerHistoryStack.length - 1);
                    if (isLast) {
                        html += `<strong class="text-dark">${escapeHtml(h.name)}</strong>`;
                    } else {
                        html += `<a href="javascript:void(0)" class="text-decoration-none fw-semibold text-primary" onclick="jumpToHistoryIndex(${index})">${escapeHtml(h.name)}</a> <span class="text-muted mx-2">/</span> `;
                    }
                });
                bcEl.innerHTML = html;
            }

            function navigateToFolder(folderId, folderName) {
                pickerHistoryStack.push({
                    id: folderId,
                    name: folderName
                });
                document.getElementById('pickerSearchInput').value = '';
                loadDriveFolder(folderId);
            }

            function navigateDriveUp() {
                if (pickerHistoryStack.length > 1) {
                    pickerHistoryStack.pop();
                    const parent = pickerHistoryStack[pickerHistoryStack.length - 1];
                    document.getElementById('pickerSearchInput').value = '';
                    loadDriveFolder(parent.id);
                }
            }

            function jumpToHistoryIndex(idx) {
                pickerHistoryStack = pickerHistoryStack.slice(0, idx + 1);
                const target = pickerHistoryStack[idx];
                document.getElementById('pickerSearchInput').value = '';
                loadDriveFolder(target.id);
            }

            function refreshDriveCurrent() {
                const searchVal = document.getElementById('pickerSearchInput').value.trim();
                loadDriveFolder(pickerCurrentFolderId, searchVal);
            }

            function doPickerSearch() {
                const query = document.getElementById('pickerSearchInput').value.trim();
                loadDriveFolder(pickerCurrentFolderId, query);
            }

            function resetPickerSearch() {
                document.getElementById('pickerSearchInput').value = '';
                loadDriveFolder(pickerCurrentFolderId);
            }

            function togglePickerSelect(id, name, isFolder) {
                if (pickerSelectedMap.has(id)) {
                    pickerSelectedMap.delete(id);
                } else {
                    pickerSelectedMap.set(id, {
                        id,
                        name,
                        isFolder
                    });
                }
                renderPickerSelectedTags();
                const searchVal = document.getElementById('pickerSearchInput').value.trim();
                loadDriveFolder(pickerCurrentFolderId, searchVal);
            }

            function removeSelectedTag(id) {
                pickerSelectedMap.delete(id);
                renderPickerSelectedTags();
                const searchVal = document.getElementById('pickerSearchInput').value.trim();
                loadDriveFolder(pickerCurrentFolderId, searchVal);
            }

            function clearSelectedPickerItems() {
                pickerSelectedMap.clear();
                renderPickerSelectedTags();
                const searchVal = document.getElementById('pickerSearchInput').value.trim();
                loadDriveFolder(pickerCurrentFolderId, searchVal);
            }

            function renderPickerSelectedTags() {
                const container = document.getElementById('pickerSelectedTags');
                const badgeCount = document.getElementById('selectedCountBadge');
                if (badgeCount) badgeCount.textContent = pickerSelectedMap.size;

                if (!container) return;
                if (pickerSelectedMap.size === 0) {
                    container.innerHTML = '<span class="text-muted small fst-italic">Belum ada item yang dipilih. Klik tombol "+ Pilih" pada daftar di atas.</span>';
                    return;
                }

                let html = '';
                pickerSelectedMap.forEach((item, id) => {
                    const icon = item.isFolder ? 'fa-folder text-warning' : 'fa-file text-primary';
                    html += `
                    <span class="badge bg-white text-dark border p-2 d-inline-flex align-items-center gap-2 rounded-3 shadow-sm" style="font-size: 0.8rem;">
                        <i class="fas ${icon}"></i>
                        <span class="text-truncate" style="max-width: 220px;" title="${escapeHtml(item.name)}">${escapeHtml(item.name)}</span>
                        <a href="javascript:void(0)" class="text-danger ms-1" onclick="removeSelectedTag('${id}')" title="Hapus"><i class="fas fa-times"></i></a>
                    </span>
                `;
                });
                container.innerHTML = html;
            }

            function applyDrivePickerSelection() {
                if (!activeTargetTextareaId) return;
                const targetEl = document.getElementById(activeTargetTextareaId);
                if (!targetEl) return;

                const selectedIds = Array.from(pickerSelectedMap.keys());
                targetEl.value = selectedIds.join('\n');

                const modalEl = document.getElementById('modalDrivePicker');
                const modalInstance = bootstrap.Modal.getInstance(modalEl);
                if (modalInstance) {
                    modalInstance.hide();
                }

                const feedbackId = activeTargetTextareaId === 'addFolderIds' ? 'addFolderFeedback' : 'editFolderFeedback';
                const feedback = document.getElementById(feedbackId);
                if (feedback && selectedIds.length > 0) {
                    feedback.innerHTML = `<span class="text-success fw-bold"><i class="fas fa-check-circle me-1"></i>${selectedIds.length} item berhasil dipilih dari Google Drive.</span>`;
                }
            }

            function escapeHtml(str) {
                if (!str) return '';
                return str.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
            }

            function escapeAttr(str) {
                if (!str) return '';
                return str.replace(/'/g, "\\'").replace(/"/g, '&quot;');
            }

            // =====================================================================
            // SYNC NOTIFIKASI SERTIFIKAT BARU & REALTIME WEBHOOK
            // =====================================================================
            function runNotificationSync(isMarkOnly) {
                const daysSelect = document.getElementById('syncRecentDays');
                const days = daysSelect ? daysSelect.value : 7;
                const btnRun = document.getElementById('btnRunSync');
                const btnMark = document.getElementById('btnRunMarkOnly');
                const statusArea = document.getElementById('syncStatusArea');

                if (isMarkOnly && !confirm('Inisialisasi Baseline akan menandai seluruh berkas yang ada di folder klien sebagai SUDAH TERCATAT tanpa mengirim email notifikasi.\n\nLanjutkan?')) {
                    return;
                }

                if (btnRun) btnRun.disabled = true;
                if (btnMark) btnMark.disabled = true;

                statusArea.style.display = 'block';
                statusArea.innerHTML = `
                    <div class="p-4 text-center">
                        <div class="spinner-border text-primary mb-2" role="status"></div>
                        <div class="fw-bold text-dark">Sedang memindai folder Google Drive klien...</div>
                        <small class="text-muted">Memeriksa berkas sertifikat baru dan mengirim notifikasi email.</small>
                    </div>
                `;

                const url = `kelolaKlien.php?ajax=sync_certificate_notifications&days=${encodeURIComponent(days)}${isMarkOnly ? '&mark_only=1' : ''}`;

                fetch(url)
                    .then(r => r.json())
                    .then(res => {
                        if (btnRun) btnRun.disabled = false;
                        if (btnMark) btnMark.disabled = false;

                        if (!res.success) {
                            statusArea.innerHTML = `
                                <div class="alert alert-danger mb-0">
                                    <i class="fas fa-exclamation-triangle me-1"></i> ${escapeHtml(res.message || 'Gagal memproses sinkronisasi.')}
                                </div>
                            `;
                            return;
                        }

                        let detailsHtml = '';
                        if (res.details && res.details.length > 0) {
                            detailsHtml = `
                                <div class="table-responsive mt-3" style="max-height: 240px; overflow-y: auto;">
                                    <table class="table table-sm table-bordered align-middle small mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Nama Berkas</th>
                                                <th>Perusahaan</th>
                                                <th>Tujuan Email</th>
                                                <th class="text-center">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            ${res.details.map(d => `
                                                <tr>
                                                    <td class="text-truncate fw-semibold" style="max-width: 200px;" title="${escapeHtml(d.file_name)}">
                                                        <i class="far fa-file-pdf text-danger me-1"></i> ${escapeHtml(d.file_name)}
                                                    </td>
                                                    <td>${escapeHtml(d.perusahaan)}</td>
                                                    <td><span class="font-monospace">${escapeHtml(d.email)}</span></td>
                                                    <td class="text-center">
                                                        ${d.status === 'sent'
                                                            ? '<span class="badge bg-success">Terkirim</span>'
                                                            : (d.status === 'marked'
                                                                ? '<span class="badge bg-info text-dark">Tercatat</span>'
                                                                : '<span class="badge bg-danger">Gagal</span>')}
                                                    </td>
                                                </tr>
                                            `).join('')}
                                        </tbody>
                                    </table>
                                </div>
                            `;
                        }

                        statusArea.innerHTML = `
                            <div class="alert ${res.notifications_sent > 0 ? 'alert-success' : 'alert-info'} mb-0">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="fw-bold">
                                        <i class="fas ${res.notifications_sent > 0 ? 'fa-check-circle' : 'fa-info-circle'} me-1"></i>
                                        ${res.is_mark_only ? 'Inisialisasi Baseline Selesai' : 'Pemindaian Selesai'}
                                    </span>
                                    <span class="badge bg-dark">${res.scanned_folders} Folder Dipindai</span>
                                </div>
                                <div class="small">
                                    ${res.is_mark_only
                                        ? `Berhasil menandai <strong>${res.total_processed}</strong> berkas sebagai sudah tercatat.`
                                        : (res.notifications_sent > 0
                                            ? `Berhasil mengirim <strong>${res.notifications_sent}</strong> email notifikasi berkas baru.`
                                            : 'Tidak ada berkas sertifikat baru yang perlu dinotifikasikan.')}
                                </div>
                                ${detailsHtml}
                            </div>
                        `;
                    })
                    .catch(err => {
                        if (btnRun) btnRun.disabled = false;
                        if (btnMark) btnMark.disabled = false;
                        statusArea.innerHTML = `
                            <div class="alert alert-danger mb-0">
                                <i class="fas fa-times-circle me-1"></i> Terjadi kesalahan: ${escapeHtml(err.message)}
                            </div>
                        `;
                    });
            }

            function registerRealtimeWebhook() {
                const btn = document.getElementById('btnRegisterWebhook');
                const resultBox = document.getElementById('webhookStatusBox');
                if (!confirm('Daftarkan Realtime Webhook ke Google Drive API sekarang?')) return;

                if (btn) btn.disabled = true;
                if (resultBox) {
                    resultBox.style.display = 'block';
                    resultBox.innerHTML = '<div class="text-muted small"><i class="fas fa-spinner fa-spin me-1"></i> Mendaftarkan pemantauan ke Google Drive API...</div>';
                }

                fetch('gdrive_watch_manager.php?action=register')
                    .then(r => r.json())
                    .then(res => {
                        if (btn) btn.disabled = false;
                        if (res.success) {
                            resultBox.innerHTML = `
                                <div class="alert alert-success small mb-0 py-2 px-3">
                                    <i class="fas fa-check-circle me-1"></i> <strong>Realtime Webhook Berhasil Diaktifkan!</strong><br>
                                    Terdaftar: ${res.registered_count} folder. Google akan otomatis mengirim notifikasi ke server setiap kali ada berkas baru.
                                </div>
                            `;
                        } else {
                            resultBox.innerHTML = `
                                <div class="alert alert-danger small mb-0 py-2 px-3">
                                    <i class="fas fa-times-circle me-1"></i> Gagal: ${escapeHtml(res.message || 'Error API')}
                                </div>
                            `;
                        }
                    })
                    .catch(e => {
                        if (btn) btn.disabled = false;
                        resultBox.innerHTML = `<div class="alert alert-danger small mb-0">Error: ${escapeHtml(e.message)}</div>`;
                    });
            }
        </script>

        <!-- MODAL SINKRONISASI NOTIFIKASI SERTIFIKAT BARU -->
        <div class="modal fade" id="modalSyncNotifications" tabindex="-1" aria-labelledby="modalSyncNotificationsLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-light border-0">
                        <div class="d-flex align-items-center gap-2">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                <i class="fas fa-bell"></i>
                            </div>
                            <div>
                                <h5 class="modal-title fw-bold" id="modalSyncNotificationsLabel">Pindai Berkas &amp; Kirim Notifikasi Email</h5>
                                <small class="text-muted">Kirim notifikasi otomatis ke klien saat ada sertifikat baru di folder Google Drive mereka</small>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="card border-0 bg-light p-3 rounded-3 mb-3">
                            <div class="row g-3 align-items-center">
                                <div class="col-md-7">
                                    <label class="form-label small fw-bold text-secondary mb-1">Rentang Waktu Berkas Baru</label>
                                    <select id="syncRecentDays" class="form-select form-select-sm">
                                        <option value="3">Berkas yang diunggah dalam 3 Hari Terakhir</option>
                                        <option value="7" selected>Berkas yang diunggah dalam 7 Hari Terakhir (Disarankan)</option>
                                        <option value="14">Berkas yang diunggah dalam 14 Hari Terakhir</option>
                                        <option value="30">Berkas yang diunggah dalam 30 Hari Terakhir</option>
                                        <option value="0">Semua Berkas Tanpa Batasan Waktu</option>
                                    </select>
                                    <small class="text-muted" style="font-size: 0.72rem;">*Hanya file yang belum pernah dinotifikasikan yang akan dikirimi email.</small>
                                </div>
                                <div class="col-md-5 d-flex flex-column gap-2 justify-content-end">
                                    <button type="button" id="btnRunSync" class="btn btn-primary btn-sm rounded-pill py-2 fw-semibold shadow-sm" onclick="runNotificationSync(false)">
                                        <i class="fas fa-paper-plane me-1"></i> Pindai &amp; Kirim Email Sekarang
                                    </button>
                                    <button type="button" id="btnRunMarkOnly" class="btn btn-outline-secondary btn-sm rounded-pill" onclick="runNotificationSync(true)" title="Tandai semua berkas yang sudah ada saat ini agar tidak terkirim email">
                                        <i class="fas fa-check-double me-1"></i> Inisialisasi Baseline (Tandai Saja)
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Area Status / Hasil -->
                        <div id="syncStatusArea" style="display: none;" class="mb-3"></div>

                        <!-- Panel Realtime Webhook Google Drive -->
                        <div class="border rounded-3 p-3 bg-white mb-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div>
                                    <h6 class="fw-bold small text-dark mb-0"><i class="fas fa-bolt text-warning me-1"></i> Realtime Google Drive Push Notifications</h6>
                                    <small class="text-muted" style="font-size: 0.75rem;">Mendaftarkan webhook agar Google Drive langsung mengabari server saat ada berkas baru.</small>
                                </div>
                                <button type="button" id="btnRegisterWebhook" class="btn btn-outline-primary btn-sm rounded-pill px-3" onclick="registerRealtimeWebhook()">
                                    <i class="fas fa-sync-alt me-1"></i> Aktifkan / Perpanjang Webhook
                                </button>
                            </div>
                            <div id="webhookStatusBox" style="display: none;" class="mt-2"></div>
                        </div>

                        <!-- Panduan Cron Job Otomatis -->
                        <div class="border rounded-3 p-3 bg-light">
                            <h6 class="fw-bold small text-dark mb-1"><i class="fas fa-clock text-primary me-1"></i> Cadangan Otomatis (Cron Job cPanel)</h6>
                            <p class="text-muted small mb-2" style="font-size: 0.78rem;">
                                Pasang Cron Job berikut di cPanel agar server mengecek secara otomatis setiap 10 menit (sebagai cadangan jika webhook tertunda):
                            </p>
                            <div class="bg-white p-2 rounded font-monospace small text-dark border user-select-all mb-1" style="font-size: 0.75rem;">
                                */10 * * * * php -q <?php echo htmlspecialchars(__DIR__); ?>/cron_check_certificates.php > /dev/null 2>&1
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php endif; ?>

</body>

</html>