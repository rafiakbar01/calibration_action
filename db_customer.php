<?php
// ============================================================================
// db_customer.php — Koneksi Database & Helper Akun Klien (pascalib_customer)
// PT PANANJUNG ANUGRAH SOLUTION
// ============================================================================

if (!defined('CUSTOMER_DB_LOADED')) {
    define('CUSTOMER_DB_LOADED', true);
}

// ----------------------------------------------------------------------------
// 1. KONFIGURASI DATABASE & EMAIL
// ----------------------------------------------------------------------------
// Silakan sesuaikan data login database cPanel Anda di bawah ini jika berbeda:
$customerDbConfig = [
    'host'     => '127.0.0.1',
    'dbname'   => 'pascalib_customer',
    'username' => 'pascalib_customer',         // Ganti dengan user DB cPanel (contoh: pascalib_user)
    'password' => 'Customer355',             // Ganti dengan password DB cPanel
    'charset'  => 'utf8mb4'
];

// Kunci Pengaman Admin untuk akses kelolaKlien.php (bisa diganti sesuai keinginan)
$adminSecretPasskey = 'admin123';

// Konfigurasi Pengirim Email OTP
$otpMailConfig = [
    'from_email' => 'noreply@pascalibration.com', // Email resmi pengirim OTP
    'from_name'  => 'PAS Calibration Portal',
    // Opsi SMTP (Gunakan SMTP cPanel agar email masuk inbox):
    'use_smtp'   => true,                         // Diaktifkan untuk koneksi langsung ke SMTP cPanel
    'smtp_host'  => 'mail.pascalibration.com',    // Server email cPanel
    'smtp_port'  => 465,                          // Port SSL (465)
    'smtp_user'  => 'noreply@pascalibration.com', // Akun email cPanel
    'smtp_pass'  => 'Customer355',                // Password email noreply@pascalibration.com
    'smtp_secure' => 'ssl'
];

// ----------------------------------------------------------------------------
// 2. KONEKSI PDO DENGAN AUTO-MIGRATION
// ----------------------------------------------------------------------------
function getCustomerPdo()
{
    global $customerDbConfig;
    static $pdo = null;

    if ($pdo !== null) {
        return $pdo;
    }

    $dsn = "mysql:host={$customerDbConfig['host']};dbname={$customerDbConfig['dbname']};charset={$customerDbConfig['charset']}";
    try {
        $pdo = new PDO($dsn, $customerDbConfig['username'], $customerDbConfig['password'], [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);

        // Auto-create tabel jika belum dibuat oleh admin
        initCustomerTables($pdo);

        return $pdo;
    } catch (PDOException $e) {
        // Coba koneksi ke MySQL tanpa dbname dulu, buat database jika di localhost belum ada
        if (strpos($e->getMessage(), 'Unknown database') !== false) {
            try {
                $rootDsn = "mysql:host={$customerDbConfig['host']};charset={$customerDbConfig['charset']}";
                $rootPdo = new PDO($rootDsn, $customerDbConfig['username'], $customerDbConfig['password']);
                $rootPdo->exec("CREATE DATABASE IF NOT EXISTS `{$customerDbConfig['dbname']}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");

                // Coba koneksi lagi
                $pdo = new PDO($dsn, $customerDbConfig['username'], $customerDbConfig['password'], [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);
                initCustomerTables($pdo);
                return $pdo;
            } catch (Exception $ex) {
                throw new Exception("Gagal membuat/menghubungkan ke database {$customerDbConfig['dbname']}: " . $ex->getMessage());
            }
        }
        throw new Exception("Koneksi database pascalib_customer gagal: " . $e->getMessage());
    }
}

/**
 * Buat tabel client_access dan client_otps secara otomatis
 */
function initCustomerTables(PDO $pdo)
{
    // Tabel 1: client_access
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `client_access` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `email` VARCHAR(191) NOT NULL UNIQUE,
            `nama` VARCHAR(191) NOT NULL,
            `perusahaan` VARCHAR(191) NOT NULL,
            `folder_ids` TEXT NOT NULL COMMENT 'Daftar Google Drive folder ID, pisah koma atau baris baru',
            `status` ENUM('active','inactive') NOT NULL DEFAULT 'active',
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            INDEX (`email`),
            INDEX (`status`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");

    // Tabel 2: client_otps
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `client_otps` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `email` VARCHAR(191) NOT NULL,
            `otp_code` VARCHAR(10) NOT NULL,
            `expires_at` DATETIME NOT NULL,
            `is_used` TINYINT(1) DEFAULT 0,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            INDEX (`email`),
            INDEX (`otp_code`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");

    // Tabel 3: marketing_access (Khusus Akun Marketing - Terpisah dari Customer)
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `marketing_access` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `email` VARCHAR(191) NOT NULL UNIQUE,
            `nama` VARCHAR(191) NOT NULL,
            `divisi` VARCHAR(191) NOT NULL DEFAULT 'Marketing & Sales',
            `folder_ids` TEXT NULL COMMENT 'Daftar Google Drive folder ID, pisah koma atau baris baru. Kosongkan untuk akses semua folder sertifikat.',
            `status` ENUM('active','inactive') NOT NULL DEFAULT 'active',
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            INDEX (`email`),
            INDEX (`status`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");

    // Tabel 4: marketing_otps
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `marketing_otps` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `email` VARCHAR(191) NOT NULL,
            `otp_code` VARCHAR(10) NOT NULL,
            `expires_at` DATETIME NOT NULL,
            `is_used` TINYINT(1) DEFAULT 0,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            INDEX (`email`),
            INDEX (`otp_code`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");

    // Tabel 5: client_notified_files (Mencatat berkas sertifikat yang telah dinotifikasikan via email ke klien)
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `client_notified_files` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `file_id` VARCHAR(191) NOT NULL,
            `file_name` VARCHAR(255) NOT NULL,
            `folder_id` VARCHAR(191) NOT NULL,
            `client_email` VARCHAR(191) NOT NULL,
            `client_id` INT NULL,
            `sent_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `status` ENUM('sent','failed') NOT NULL DEFAULT 'sent',
            UNIQUE KEY `uniq_file_client` (`file_id`, `client_email`),
            INDEX (`file_id`),
            INDEX (`folder_id`),
            INDEX (`client_email`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");

    // Auto-migration kolom baru pada client_access jika belum ada
    try {
        $cols = $pdo->query("SHOW COLUMNS FROM `client_access`")->fetchAll(PDO::FETCH_COLUMN);
        if (!in_array('jabatan', $cols)) {
            $pdo->exec("ALTER TABLE `client_access` ADD COLUMN `jabatan` VARCHAR(191) NULL AFTER `perusahaan`");
        }
        if (!in_array('model_akses', $cols)) {
            $pdo->exec("ALTER TABLE `client_access` ADD COLUMN `model_akses` VARCHAR(50) NULL AFTER `jabatan`");
        }
        if (!in_array('email_tambahan', $cols)) {
            $pdo->exec("ALTER TABLE `client_access` ADD COLUMN `email_tambahan` TEXT NULL AFTER `model_akses`");
        }
        if (!in_array('folder_ids_tambahan', $cols)) {
            $pdo->exec("ALTER TABLE `client_access` ADD COLUMN `folder_ids_tambahan` TEXT NULL AFTER `folder_ids`");
        }
    } catch (Throwable $e) {
        error_log("Migration error client_access: " . $e->getMessage());
    }
}

// ----------------------------------------------------------------------------
// 3. FUNGSI HELPER & CRUD DATA KLIEN
// ----------------------------------------------------------------------------

/**
 * Parsing data email tambahan (bisa dari JSON string atau format text string: email;note)
 * Output array of associative array: [['email' => ..., 'note' => ..., 'folder_ids' => ...], ...]
 */
function parseAdditionalEmails($raw)
{
    if (empty($raw)) return [];

    $trimmed = trim($raw);
    if (str_starts_with($trimmed, '[') || str_starts_with($trimmed, '{')) {
        $decoded = json_decode($trimmed, true);
        if (is_array($decoded)) {
            $res = [];
            foreach ($decoded as $item) {
                if (is_array($item) && !empty($item['email'])) {
                    $res[] = [
                        'nama'       => trim($item['nama'] ?? ''),
                        'email'      => strtolower(trim($item['email'])),
                        'note'       => trim($item['note'] ?? ''),
                        'folder_ids' => trim($item['folder_ids'] ?? '')
                    ];
                } elseif (is_string($item) && !empty($item)) {
                    $res[] = [
                        'nama'       => '',
                        'email'      => strtolower(trim($item)),
                        'note'       => '',
                        'folder_ids' => ''
                    ];
                }
            }
            return $res;
        }
    }

    // Format string delimiter: misal "email@gmail.com;Karawang;email2@gmail.com;Tangerang;"
    $results = [];
    $lines = preg_split('/[\r\n]+/', $raw);

    foreach ($lines as $line) {
        $line = trim($line);
        if (empty($line)) continue;

        if (strpos($line, ';') !== false) {
            $parts = array_values(array_filter(array_map('trim', explode(';', $line))));
            for ($i = 0; $i < count($parts); $i += 2) {
                $em = $parts[$i] ?? '';
                $nt = $parts[$i + 1] ?? '';
                if (!empty($em) && strpos($em, '@') !== false) {
                    $results[] = [
                        'nama'       => '',
                        'email'      => strtolower($em),
                        'note'       => $nt,
                        'folder_ids' => ''
                    ];
                }
            }
        } elseif (preg_match('/([a-zA-Z0-9_\.\+-]+@[a-zA-Z0-9\.-]+\.[a-zA-Z]{2,})(?:\s*[-:,]\s*(.*))?/', $line, $m)) {
            $results[] = [
                'nama'       => '',
                'email'      => strtolower($m[1]),
                'note'       => trim($m[2] ?? ''),
                'folder_ids' => ''
            ];
        }
    }

    return $results;
}

/**
 * Cari klien berdasarkan email (Mendukung pencarian Email Utama dan Email Tambahan)
 */
function getCustomerByEmail($email)
{
    $email = strtolower(trim($email));
    if (empty($email)) return null;

    try {
        $pdo = getCustomerPdo();
        // 1. Cek email utama
        $stmt = $pdo->prepare("SELECT * FROM `client_access` WHERE LOWER(`email`) = ? LIMIT 1");
        $stmt->execute([$email]);
        $row = $stmt->fetch();
        if ($row) {
            $row['is_additional_email'] = false;
            $row['logged_email'] = $row['email'];
            return $row;
        }

        // 2. Cek di daftar email tambahan (Cari di semua record yang mengandung email ini)
        $stmt2 = $pdo->prepare("SELECT * FROM `client_access` WHERE LOWER(`email_tambahan`) LIKE ?");
        $stmt2->execute(["%{$email}%"]);
        $rows2 = $stmt2->fetchAll();
        foreach ($rows2 as $row2) {
            $addList = parseAdditionalEmails($row2['email_tambahan'] ?? '');
            foreach ($addList as $add) {
                if (strtolower($add['email']) === $email) {
                    $row2['is_additional_email'] = true;
                    $row2['logged_email'] = $email;
                    $row2['additional_nama'] = $add['nama'] ?? '';   // Nama masing-masing email tambahan
                    $row2['additional_note'] = $add['note'] ?? '';
                    // Folder khusus untuk email tambahan ini. HANYA ambil jika diisi khusus untuk email ini.
                    // JANGAN pernah fallback ke folder_ids akun utama.
                    $dedicatedFolder = trim($add['folder_ids'] ?? '');
                    $row2['additional_folder_ids'] = $dedicatedFolder;
                    return $row2;
                }
            }
        }
        return null;
    } catch (Throwable $e) {
        error_log("DB Error getCustomerByEmail: " . $e->getMessage());
        return null;
    }
}

/**
 * Cari klien berdasarkan ID primary key
 */
function getCustomerById($id)
{
    $id = intval($id);
    if ($id <= 0) return null;

    try {
        $pdo = getCustomerPdo();
        $stmt = $pdo->prepare("SELECT * FROM `client_access` WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    } catch (Throwable $e) {
        error_log("DB Error getCustomerById: " . $e->getMessage());
        return null;
    }
}

/**
 * Ekstrak ID Google Drive dari URL (folder atau file) atau string ID langsung
 */
function extractGoogleDriveId($str)
{
    if (!is_string($str)) return '';
    $str = trim($str);
    if (empty($str)) return '';

    // 1. Ekstrak dari URL folder: /folders/ID
    if (preg_match('/folders\/([a-zA-Z0-9_-]{10,})/i', $str, $m)) {
        return $m[1];
    }
    // 2. Ekstrak dari URL file: /file/d/ID atau /d/ID
    if (preg_match('/(?:\/file\/d\/|\/d\/)([a-zA-Z0-9_-]{10,})/i', $str, $m)) {
        return $m[1];
    }
    // 3. Ekstrak dari parameter id: id=ID
    if (preg_match('/[?&]id=([a-zA-Z0-9_-]{10,})/i', $str, $m)) {
        return $m[1];
    }
    // 4. Jika format URL drive lain
    if (preg_match('/drive\.google\.com\/(?:[^\/]+\/)*([a-zA-Z0-9_-]{15,})/i', $str, $m)) {
        return $m[1];
    }

    // 5. Bersihkan tanda kutip / whitespace / query string
    $clean = trim($str, " '\"\t\n\r");
    if (strpos($clean, '?') !== false) {
        $clean = explode('?', $clean)[0];
    }
    if (strpos($clean, '/') !== false) {
        $segments = explode('/', rtrim($clean, '/'));
        $last = end($segments);
        if (preg_match('/^[a-zA-Z0-9_-]{10,}$/', $last)) {
            return $last;
        }
    }

    return $clean;
}

/**
 * Ambil daftar folder ID yang diizinkan untuk klien tertentu
 * Mengembalikan array of string folder ID yang bersih
 */
function getCustomerAllowedFolderIds($email)
{
    $client = getCustomerByEmail($email);
    if (!$client || $client['status'] !== 'active') {
        return [];
    }

    // Jika login menggunakan email tambahan:
    if (!empty($client['is_additional_email'])) {
        // HANYA ambil folder yang secara khusus dialokasikan untuk email tambahan ini.
        // Jika belum/tidak diberikan folder khusus, maka TIDAK BOLEH ada akses folder (kosong).
        $raw = trim($client['additional_folder_ids'] ?? '');
        if (empty($raw)) {
            return [];
        }
    } else {
        // Akun email utama
        $raw = trim($client['folder_ids'] ?? '');
        if (!empty($client['folder_ids_tambahan'])) {
            $raw .= "\n" . trim($client['folder_ids_tambahan']);
        }
        if (empty(trim($raw))) {
            return [];
        }
    }

    $rawList = [];

    // Bisa berupa JSON array atau string dipisah koma / baris baru
    if (str_starts_with(trim($raw), '[')) {
        $decoded = json_decode($raw, true);
        if (is_array($decoded)) {
            $rawList = $decoded;
        }
    }
    if (empty($rawList)) {
        $rawList = preg_split('/[\r\n,;]+/', $raw);
    }

    $ids = [];
    foreach ($rawList as $item) {
        if (is_string($item)) {
            $extracted = extractGoogleDriveId($item);
            if (!empty($extracted)) {
                $ids[] = $extracted;
            }
        }
    }

    return array_values(array_unique(array_filter($ids)));
}

/**
 * Ambil semua data klien untuk halaman admin kelolaKlien.php
 */
function getAllCustomers($search = '', $status = '')
{
    $pdo = getCustomerPdo();
    $sql = "SELECT * FROM `client_access` WHERE 1=1";
    $params = [];

    if (!empty($search)) {
        $sql .= " AND (nama LIKE ? OR email LIKE ? OR perusahaan LIKE ? OR jabatan LIKE ? OR email_tambahan LIKE ?)";
        $term = "%{$search}%";
        $params[] = $term;
        $params[] = $term;
        $params[] = $term;
        $params[] = $term;
        $params[] = $term;
    }

    if (!empty($status)) {
        $sql .= " AND status = ?";
        $params[] = $status;
    }

    $sql .= " ORDER BY id DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

/**
 * Simpan / Tambah Klien Baru (dengan Jabatan, Model Akses, Email Tambahan)
 */
function createCustomer($nama, $email, $perusahaan, $folderIds, $status = 'active', $jabatan = '', $modelAkses = '', $emailTambahan = '', $folderIdsTambahan = '')
{
    $pdo = getCustomerPdo();
    $stmt = $pdo->prepare("
        INSERT INTO `client_access` (nama, email, perusahaan, jabatan, model_akses, email_tambahan, folder_ids, folder_ids_tambahan, status, created_at)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
    ");
    return $stmt->execute([
        trim($nama),
        strtolower(trim($email)),
        trim($perusahaan),
        trim($jabatan),
        trim($modelAkses),
        trim($emailTambahan),
        trim($folderIds),
        trim($folderIdsTambahan),
        $status === 'inactive' ? 'inactive' : 'active'
    ]);
}

/**
 * Update Data Klien (dengan Jabatan, Model Akses, Email Tambahan)
 */
function updateCustomer($id, $nama, $email, $perusahaan, $folderIds, $status = 'active', $jabatan = '', $modelAkses = '', $emailTambahan = '', $folderIdsTambahan = '')
{
    $pdo = getCustomerPdo();
    $stmt = $pdo->prepare("
        UPDATE `client_access`
        SET nama = ?, email = ?, perusahaan = ?, jabatan = ?, model_akses = ?, email_tambahan = ?, folder_ids = ?, folder_ids_tambahan = ?, status = ?, updated_at = NOW()
        WHERE id = ?
    ");
    return $stmt->execute([
        trim($nama),
        strtolower(trim($email)),
        trim($perusahaan),
        trim($jabatan),
        trim($modelAkses),
        trim($emailTambahan),
        trim($folderIds),
        trim($folderIdsTambahan),
        $status === 'inactive' ? 'inactive' : 'active',
        intval($id)
    ]);
}

/**
 * Pendaftaran Klien Mandiri dari Formulir Publik (daftarAkses.php)
 */
function registerCustomerPublicForm($nama, $perusahaan, $jabatan, $email, $modelAkses, $emailTambahanJson)
{
    $email = strtolower(trim($email));
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return ['success' => false, 'message' => 'Alamat email utama tidak valid.'];
    }

    $existing = getCustomerByEmail($email);
    if ($existing && strtolower($existing['email']) === $email) {
        return [
            'success' => false,
            'message' => 'Alamat email perusahaan ini sudah terdaftar sebelumnya. Silakan hubungi admin PT Pananjung Anugrah Solution jika ingin memperbarui data.'
        ];
    }

    $pdo = getCustomerPdo();
    try {
        $stmt = $pdo->prepare("
            INSERT INTO `client_access` (nama, email, perusahaan, jabatan, model_akses, email_tambahan, folder_ids, status, created_at)
            VALUES (?, ?, ?, ?, ?, ?, '', 'active', NOW())
        ");
        $ok = $stmt->execute([
            trim($nama),
            $email,
            trim($perusahaan),
            trim($jabatan),
            trim($modelAkses),
            trim($emailTambahanJson)
        ]);

        if ($ok) {
            // Kirim email notifikasi pendaftaran berhasil ke email utama
            sendCustomerRegistrationSuccessEmail($email, $nama, $perusahaan);

            // Kirim email notifikasi ke setiap email tambahan jika ada
            if (!empty($emailTambahanJson)) {
                $additionalArr = json_decode($emailTambahanJson, true);
                if (is_array($additionalArr)) {
                    foreach ($additionalArr as $addEntry) {
                        $addEmail = strtolower(trim($addEntry['email'] ?? ''));
                        $addName  = trim($addEntry['nama'] ?? $nama);
                        if (!empty($addEmail) && filter_var($addEmail, FILTER_VALIDATE_EMAIL)) {
                            sendCustomerRegistrationSuccessEmail($addEmail, $addName, $perusahaan);
                        }
                    }
                }
            }

            return [
                'success' => true,
                'message' => 'Pendaftaran berhasil dikirim! Silakan periksa email Anda.'
            ];
        } else {
            return ['success' => false, 'message' => 'Gagal menyimpan data pendaftaran ke sistem.'];
        }
    } catch (Throwable $e) {
        error_log("Register client error: " . $e->getMessage());
        return ['success' => false, 'message' => 'Terjadi kesalahan basis data: ' . $e->getMessage()];
    }
}

/**
 * Hapus Klien
 */
function deleteCustomer($id)
{
    $pdo = getCustomerPdo();
    $stmt = $pdo->prepare("DELETE FROM `client_access` WHERE id = ?");
    return $stmt->execute([intval($id)]);
}

// ----------------------------------------------------------------------------
// 4. GENERATE, SEND & VERIFY OTP
// ----------------------------------------------------------------------------

/**
 * Buat dan kirim kode OTP ke email klien
 */
function generateAndSendCustomerOtp($email)
{
    $email = strtolower(trim($email));
    $client = getCustomerByEmail($email);

    if (!$client) {
        return [
            'success' => false,
            'message' => 'Email perusahaan belum terdaftar di sistem. Silakan hubungi admin PT Pananjung Anugrah Solution.'
        ];
    }

    if ($client['status'] !== 'active') {
        return [
            'success' => false,
            'message' => 'Akun untuk email ini sedang dinonaktifkan oleh admin.'
        ];
    }

    // Generate 6 digit angka acak aman
    $otpCode = str_pad((string)random_int(100000, 999999), 6, '0', STR_PAD_LEFT);
    $expiresAt = date('Y-m-d H:i:s', time() + (10 * 60)); // Berlaku 10 menit

    $pdo = getCustomerPdo();
    // Nonaktifkan OTP lama yang belum terpakai untuk email ini
    $pdo->prepare("UPDATE `client_otps` SET is_used = 1 WHERE email = ? AND is_used = 0")->execute([$email]);

    // Simpan OTP baru
    $stmt = $pdo->prepare("INSERT INTO `client_otps` (email, otp_code, expires_at, is_used, created_at) VALUES (?, ?, ?, 0, NOW())");
    $stmt->execute([$email, $otpCode, $expiresAt]);

    // Kirim email OTP via SMTP
    $mailSent = sendCustomerOtpEmail($email, $otpCode, $client['nama'], $client['perusahaan']);

    // Simpan ke session untuk keperluan debugging lokal
    $_SESSION['debug_dev_otp'] = $otpCode;
    $_SESSION['debug_dev_otp_email'] = $email;

    return [
        'success'   => true,
        'message'   => $mailSent
            ? 'Kode OTP 6-digit telah dikirimkan ke email ' . $email . '. Silakan periksa kotak masuk atau spam.'
            : 'Kode OTP telah dibuat, namun email gagal dikirim. Coba lagi atau hubungi admin.',
        'mail_sent' => $mailSent,
        'debug_otp' => $otpCode
    ];
}

/**
 * Verifikasi kode OTP yang diinput oleh user
 */
function verifyCustomerOtp($email, $otpInput)
{
    $email    = strtolower(trim($email));
    $otpInput = trim($otpInput);

    if (empty($email) || empty($otpInput)) {
        return ['success' => false, 'message' => 'Email dan kode OTP wajib diisi.'];
    }

    $pdo = getCustomerPdo();
    $stmt = $pdo->prepare("
        SELECT * FROM `client_otps`
        WHERE email = ? AND otp_code = ? AND is_used = 0
        ORDER BY id DESC LIMIT 1
    ");
    $stmt->execute([$email, $otpInput]);
    $otpRow = $stmt->fetch();

    if (!$otpRow) {
        return ['success' => false, 'message' => 'Kode OTP salah atau sudah pernah digunakan.'];
    }

    if (strtotime($otpRow['expires_at']) < time()) {
        return ['success' => false, 'message' => 'Kode OTP telah kadaluarsa (melebihi 10 menit). Silakan minta kode baru.'];
    }

    // Tandai OTP sudah terpakai
    $pdo->prepare("UPDATE `client_otps` SET is_used = 1 WHERE id = ?")->execute([$otpRow['id']]);

    // Ambil data klien
    $client = getCustomerByEmail($email);
    if (!$client || $client['status'] !== 'active') {
        return ['success' => false, 'message' => 'Akun klien tidak aktif atau tidak ditemukan.'];
    }

    return [
        'success' => true,
        'client'  => $client
    ];
}

/**
 * Fungsi Pengirim Email Berformat HTML Modern
 */
function sendCustomerOtpEmail($toEmail, $otpCode, $clientName = '', $companyName = '')
{
    global $otpMailConfig;

    $subject = "Kode Verifikasi Masuk Portal Sertifikat: {$otpCode}";
    $displayName = !empty($clientName) ? htmlspecialchars($clientName) : 'Bapak/Ibu Klien';
    $displayCompany = !empty($companyName) ? '(' . htmlspecialchars($companyName) . ')' : '';

    $bodyHtml = "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='utf-8'>
        <style>
            body { font-family: 'Segoe UI', Arial, sans-serif; background-color: #f8fafc; margin: 0; padding: 20px; color: #1e293b; }
            .container { max-width: 520px; margin: 0 auto; background: #ffffff; border-radius: 16px; overflow: hidden; border: 1px solid #e2e8f0; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
            .header { background: linear-gradient(135deg, #0284c7, #0369a1); padding: 24px; text-align: center; color: white; }
            .header h2 { margin: 0; font-size: 18px; font-weight: 700; letter-spacing: 0.5px; }
            .header p { margin: 4px 0 0; font-size: 12px; opacity: 0.85; }
            .content { padding: 30px 24px; text-align: center; }
            .greeting { font-size: 15px; color: #334155; margin-bottom: 12px; text-align: left; }
            .desc { font-size: 13px; color: #64748b; line-height: 1.6; margin-bottom: 24px; text-align: left; }
            .otp-box { background: #f0f9ff; border: 2px dashed #0284c7; border-radius: 12px; padding: 18px; display: inline-block; margin: 10px 0 20px; }
            .otp-number { font-size: 32px; font-weight: 800; letter-spacing: 8px; color: #0284c7; font-family: monospace; }
            .expiry-note { font-size: 12px; color: #dc2626; margin-top: 6px; font-weight: 600; }
            .footer { background: #f8fafc; padding: 16px; text-align: center; font-size: 11px; color: #94a3b8; border-top: 1px solid #f1f5f9; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h2>PT PANANJUNG ANUGRAH SOLUTION</h2>
                <p>Portal Akses Sertifikat Digital</p>
            </div>
            <div class='content'>
                <div class='greeting'>Halo <strong>{$displayName}</strong> {$displayCompany},</div>
                <div class='desc'>
                    Kami menerima permintaan akses sertifikat digital untuk email perusahaan Anda. Gunakan kode verifikasi (OTP) di bawah ini untuk masuk ke portal:
                </div>
                
                <div class='otp-box'>
                    <div class='otp-number'>{$otpCode}</div>
                    <div class='expiry-note'>*Berlaku selama 10 menit</div>
                </div>

                <div class='desc' style='font-size: 12px;'>
                    Jika Anda tidak merasa meminta kode ini, silakan abaikan pesan email ini. Jangan berikan kode OTP ini kepada siapapun demi keamanan berkas sertifikat perusahaan Anda.
                </div>
            </div>
            <div class='footer'>
                &copy; " . date('Y') . " PT PANANJUNG ANUGRAH SOLUTION. All rights reserved.
            </div>
        </div>
    </body>
    </html>";

    // OPSI 1: JIKA MENGGUNAKAN SMTP TERAUTENTIKASI (cPanel / Gmail SMTP)
    if (!empty($otpMailConfig['use_smtp'])) {
        $smtpSuccess = sendViaSocketSmtp($toEmail, $subject, $bodyHtml);
        if ($smtpSuccess) return true;
    }

    return sendCustomerGenericEmail($toEmail, $subject, $bodyHtml);
}

/**
 * Kirim email pemberitahuan pendaftaran mandiri berhasil dari daftarAkses.php
 */
function sendCustomerRegistrationSuccessEmail($toEmail, $clientName, $companyName)
{
    $toEmail = strtolower(trim($toEmail));
    if (empty($toEmail) || !filter_var($toEmail, FILTER_VALIDATE_EMAIL)) {
        return false;
    }

    $portalUrl = 'https://pascalibration.com/portal-sertifikat';
    $displayName    = !empty($clientName) ? htmlspecialchars(trim($clientName)) : 'Bapak/Ibu Pelanggan';
    $displayCompany = !empty($companyName) ? htmlspecialchars(trim($companyName)) : 'Perusahaan Anda';
    $safeEmail      = htmlspecialchars($toEmail);
    $safePortalUrl  = htmlspecialchars($portalUrl);

    $subject = "Pendaftaran Akses Sertifikat Digital Berhasil - {$displayCompany}";

    $bodyHtml = "
    <!DOCTYPE html>
    <html lang='id'>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>{$subject}</title>
        <style>
            body { font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #f1f5f9; margin: 0; padding: 24px 12px; color: #1e293b; -webkit-font-smoothing: antialiased; }
            .container { max-width: 580px; margin: 0 auto; background: #ffffff; border-radius: 16px; overflow: hidden; border: 1px solid #e2e8f0; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.06); }
            .header { background: linear-gradient(135deg, #1d4ed8 0%, #0284c7 100%); padding: 32px 24px; text-align: center; color: #ffffff; }
            .header-badge { display: inline-block; background: rgba(255,255,255,0.2); border: 1px solid rgba(255,255,255,0.35); border-radius: 50px; padding: 4px 14px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px; }
            .header h1 { margin: 0; font-size: 19px; font-weight: 800; letter-spacing: 0.3px; line-height: 1.3; }
            .header p { margin: 6px 0 0; font-size: 12.5px; opacity: 0.9; }
            .content { padding: 32px 26px; line-height: 1.6; }
            .greeting { font-size: 16px; font-weight: 700; color: #0f172a; margin-bottom: 14px; }
            .paragraph { font-size: 14px; color: #475569; margin-bottom: 16px; line-height: 1.65; }
            .highlight-card { background: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid #0284c7; border-radius: 10px; padding: 18px 20px; margin: 22px 0; }
            .highlight-title { font-size: 12px; font-weight: 700; color: #0369a1; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 10px; }
            .btn-cta-box { text-align: center; margin: 30px 0 24px; }
            .btn-cta { display: inline-block; background: linear-gradient(135deg, #1d4ed8 0%, #0284c7 100%); color: #ffffff !important; padding: 15px 36px; border-radius: 50px; font-size: 15px; font-weight: 700; text-decoration: none; box-shadow: 0 4px 18px rgba(29, 78, 216, 0.35); }
            .steps-box { background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 12px; padding: 18px 20px; margin-top: 24px; }
            .steps-title { font-size: 13px; font-weight: 700; color: #166534; margin-bottom: 8px; }
            .steps-list { margin: 0; padding-left: 20px; font-size: 12.5px; color: #15803d; line-height: 1.7; }
            .footer { background: #f8fafc; padding: 22px; text-align: center; font-size: 11.5px; color: #94a3b8; border-top: 1px solid #f1f5f9; line-height: 1.6; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <div class='header-badge'>Pendaftaran Akses Berhasil</div>
                <h1>PT PANANJUNG ANUGRAH SOLUTION</h1>
                <p>Portal Pencarian Sertifikat Digital</p>
            </div>
            <div class='content'>
                <div class='greeting'>Halo, {$displayName}</div>
                <div class='paragraph'>
                    Pendaftaran akses sertifikat digital untuk perusahaan <strong>{$displayCompany}</strong> telah berhasil disimpan di sistem kami.
                </div>
                <div class='paragraph'>
                    Tim admin kami akan segera meninjau dan memproses folder sertifikat Anda. Anda dapat masuk ke portal untuk memeriksa berkas sertifikat kapan saja menggunakan email terdaftar Anda.
                </div>

                <div class='highlight-card'>
                    <div class='highlight-title'>Detail Pendaftaran :</div>
                    <table style='width: 100%; border-collapse: collapse; font-size: 13px;'>
                        <tr>
                            <td style='padding: 6px 0; color: #64748b; width: 35%;'>Nama:</td>
                            <td style='padding: 6px 0; text-align: right; font-weight: 600; color: #0f172a;'>{$displayName}</td>
                        </tr>
                        <tr>
                            <td style='padding: 6px 0; color: #64748b; width: 35%;'>Perusahaan:</td>
                            <td style='padding: 6px 0; text-align: right; font-weight: 600; color: #0f172a;'>{$displayCompany}</td>
                        </tr>
                        <tr>
                            <td style='padding: 6px 0; color: #64748b; width: 35%;'>Email Utama:</td>
                            <td style='padding: 6px 0; text-align: right; font-weight: 600; color: #0284c7;'>{$safeEmail}</td>
                        </tr>
                    </table>
                </div>

                <div class='btn-cta-box'>
                    <a href='{$safePortalUrl}' class='btn-cta' target='_blank'>
                        Kunjungi Portal Sertifikat &rarr;
                    </a>
                </div>

                <div class='steps-box'>
                    <div class='steps-title'>Cara Masuk ke Portal:</div>
                    <ol class='steps-list'>
                        <li>Buka tautan portal di atas.</li>
                        <li>Masukkan email Anda (<strong>{$safeEmail}</strong>) dan klik kirim OTP.</li>
                        <li>Masukkan kode OTP yang dikirim ke email untuk masuk.</li>
                    </ol>
                </div>
            </div>
            <div class='footer'>
                &copy; " . date('Y') . " PT PANANJUNG ANUGRAH SOLUTION. All rights reserved.
            </div>
        </div>
    </body>
    </html>";

    return sendCustomerGenericEmail($toEmail, $subject, $bodyHtml);
}   

/**
 * Kirim email pemberitahuan ke customer bahwa akses folder/subfolder/berkas sertifikat telah diberikan.
 * Dilengkapi tautan langsung ke portal cariSertifikat.php dan panduan masuk OTP.
 */
function sendCustomerAccessNotification($toEmail, $clientName, $companyName, $folderIds = '', $portalUrl = '') {
    $toEmail = strtolower(trim($toEmail));
    if (empty($toEmail) || !filter_var($toEmail, FILTER_VALIDATE_EMAIL)) {
        return false;
    }

    if (empty($portalUrl)) {
        $host = $_SERVER['HTTP_HOST'] ?? 'pascalibration.com';
        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $portalUrl = $scheme . '://' . $host . '/cariSertifikat.php';
        if ($host === 'pascalibration.com' || strpos($host, 'pascalibration.com') !== false) {
            $portalUrl = 'https://pascalibration.com/portal-sertifikat';
        }
    }

    $displayName    = !empty($clientName) ? htmlspecialchars(trim($clientName)) : 'Bapak/Ibu Pelanggan';
    $displayCompany = !empty($companyName) ? htmlspecialchars(trim($companyName)) : 'Perusahaan Anda';
    $safeEmail      = htmlspecialchars($toEmail);
    $safePortalUrl  = htmlspecialchars($portalUrl);

    $subject = "Hak Akses Sertifikat Kalibrasi Digital - {$displayCompany}";

    $bodyHtml = "
    <!DOCTYPE html>
    <html lang='id'>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>{$subject}</title>
        <style>
            body { font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #f1f5f9; margin: 0; padding: 24px 12px; color: #1e293b; -webkit-font-smoothing: antialiased; }
            .container { max-width: 580px; margin: 0 auto; background: #ffffff; border-radius: 16px; overflow: hidden; border: 1px solid #e2e8f0; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.06); }
            .header { background: linear-gradient(135deg, #1d4ed8 0%, #0284c7 100%); padding: 32px 24px; text-align: center; color: #ffffff; }
            .header-badge { display: inline-block; background: rgba(255,255,255,0.2); border: 1px solid rgba(255,255,255,0.35); border-radius: 50px; padding: 4px 14px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px; }
            .header h1 { margin: 0; font-size: 19px; font-weight: 800; letter-spacing: 0.3px; line-height: 1.3; }
            .header p { margin: 6px 0 0; font-size: 12.5px; opacity: 0.9; }
            .content { padding: 32px 26px; line-height: 1.6; }
            .greeting { font-size: 16px; font-weight: 700; color: #0f172a; margin-bottom: 14px; }
            .paragraph { font-size: 14px; color: #475569; margin-bottom: 16px; line-height: 1.65; }
            .highlight-card { background: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid #0284c7; border-radius: 10px; padding: 18px 20px; margin: 22px 0; }
            .highlight-title { font-size: 12px; font-weight: 700; color: #0369a1; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 10px; }
            .btn-cta-box { text-align: center; margin: 30px 0 24px; }
            .btn-cta { display: inline-block; background: linear-gradient(135deg, #1d4ed8 0%, #0284c7 100%); color: #ffffff !important; padding: 15px 36px; border-radius: 50px; font-size: 15px; font-weight: 700; text-decoration: none; box-shadow: 0 4px 18px rgba(29, 78, 216, 0.35); }
            .steps-box { background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 12px; padding: 18px 20px; margin-top: 24px; }
            .steps-title { font-size: 13px; font-weight: 700; color: #166534; margin-bottom: 8px; }
            .steps-list { margin: 0; padding-left: 20px; font-size: 12.5px; color: #15803d; line-height: 1.7; }
            .link-alt { font-size: 12px; color: #64748b; margin-top: 22px; word-break: break-all; }
            .link-alt a { color: #0284c7; text-decoration: underline; }
            .footer { background: #f8fafc; padding: 22px; text-align: center; font-size: 11.5px; color: #94a3b8; border-top: 1px solid #f1f5f9; line-height: 1.6; }
            .footer strong { color: #64748b; }
            @media only screen and (max-width: 520px) {
                body { padding: 12px 6px !important; }
                .container { width: 100% !important; border-radius: 12px !important; }
                .header { padding: 24px 16px !important; }
                .content { padding: 22px 16px !important; }
                .highlight-card { padding: 14px 14px !important; }
                .detail-table, .detail-table tbody, .detail-table tr, .detail-table td {
                    display: block !important;
                    width: 100% !important;
                    box-sizing: border-box !important;
                }
                .detail-table tr {
                    padding: 8px 0 !important;
                    border-bottom: 1px dashed #e2e8f0 !important;
                }
                .detail-table tr:last-child {
                    border-bottom: none !important;
                }
                .detail-table td.detail-label {
                    text-align: left !important;
                    padding: 0 0 2px 0 !important;
                    font-size: 11.5px !important;
                    color: #64748b !important;
                    font-weight: 500 !important;
                }
                .detail-table td.detail-value {
                    text-align: left !important;
                    padding: 0 !important;
                    font-size: 13.5px !important;
                }
                .btn-cta { display: block !important; padding: 14px 20px !important; font-size: 14px !important; }
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <div class='header-badge'>Pemberitahuan Hak Akses Sertifikat Digital</div>
                <h1>PT PANANJUNG ANUGRAH SOLUTION</h1>
                <p>Portal Pencarian Sertifikat Digital</p>
            </div>
            <div class='content'>
                <div class='greeting'>Halo, {$displayName}</div>
                <div class='paragraph'>
                    Kami informasikan bahwa akun email Anda telah diberikan hak akses ke berkas &amp; folder Sertifikat Kalibrasi Digital untuk <strong>{$displayCompany}</strong>.
                </div>
                <div class='paragraph'>
                    Kini Anda dapat langsung mencari, melihat, dan mengunduh berkas Sertifikat Kalibrasi perusahaan Anda secara mandiri, cepat, dan aman melalui portal resmi kami.
                </div>

                <div class='highlight-card'>
                    <div class='highlight-title'>Detail Akun :</div>
                    <table class='detail-table' style='width: 100%; border-collapse: collapse; font-size: 13px; table-layout: fixed;'>
                        <tr>
                            <td class='detail-label' style='padding: 6px 0; color: #64748b; width: 35%; vertical-align: top;'>Nama:</td>
                            <td class='detail-value' style='padding: 6px 0; text-align: right; font-weight: 600; color: #0f172a; word-break: break-word;'>{$displayName}</td>
                        </tr>
                        <tr>
                            <td class='detail-label' style='padding: 6px 0; color: #64748b; width: 35%; vertical-align: top;'>Perusahaan:</td>
                            <td class='detail-value' style='padding: 6px 0; text-align: right; font-weight: 600; color: #0f172a; word-break: break-word;'>{$displayCompany}</td>
                        </tr>
                        <tr>
                            <td class='detail-label' style='padding: 6px 0; color: #64748b; width: 35%; vertical-align: top;'>Email Terdaftar:</td>
                            <td class='detail-value' style='padding: 6px 0; text-align: right; font-weight: 600; color: #0284c7; word-break: break-all; overflow-wrap: anywhere;'>{$safeEmail}</td>
                        </tr>
                        <tr>
                            <td class='detail-label' style='padding: 6px 0; color: #64748b; width: 35%; vertical-align: top;'>Metode Masuk:</td>
                            <td class='detail-value' style='padding: 6px 0; text-align: right; font-weight: 600; color: #0284c7;'>Kode OTP</td>
                        </tr>
                    </table>
                </div>

                <div class='btn-cta-box'>
                    <a href='{$safePortalUrl}' class='btn-cta' target='_blank'>
                        Buka Portal Cari Sertifikat &rarr;
                    </a>
                </div>

                <div class='steps-box'>
                    <div class='steps-title'>Panduan Cara Mengakses Sertifikat:</div>
                    <ol class='steps-list'>
                        <li>Klik tombol <strong>Buka Portal Cari Sertifikat</strong> di atas.</li>
                        <li>Masukkan email Anda (<strong>{$safeEmail}</strong>) lalu klik <em>Kirim Kode OTP</em>.</li>
                        <li>Periksa email Anda untuk menerima 6 digit kode verifikasi OTP.</li>
                        <li>Masukkan kode OTP tersebut untuk masuk dan langsung melihat seluruh berkas sertifikat Anda.</li>
                    </ol>
                </div>
            </div>
             <div class='footer'>
                &copy; " . date('Y') . " PT PANANJUNG ANUGRAH SOLUTION. All rights reserved.
            </div>
        </div>
    </body>
    </html>";

    return sendCustomerGenericEmail($toEmail, $subject, $bodyHtml);
}

/**
 * Pengirim Email Serbaguna (Support HTML, SMTP cPanel, Fallback mail, dan Attachment)
 */
function sendCustomerGenericEmail($toEmail, $subject, $bodyHtml, $attachments = [], $replyToEmail = '', $replyToName = '', $fromEmail = '', $fromName = '')
{
    global $otpMailConfig;

    $finalFromEmail = !empty($fromEmail) ? trim($fromEmail) : ($otpMailConfig['from_email'] ?? 'noreply@pascalibration.com');
    $finalFromName  = !empty($fromName) ? trim($fromName) : ($otpMailConfig['from_name'] ?? 'PT Pananjung Anugrah Solution');
    $replyEmail     = !empty($replyToEmail) ? trim($replyToEmail) : $finalFromEmail;

    // OPSI 1: JIKA MENGGUNAKAN SMTP TERAUTENTIKASI (cPanel / Hostinger / SSL SMTP)
    if (!empty($otpMailConfig['use_smtp'])) {
        $smtpSuccess = sendViaSocketSmtp($toEmail, $subject, $bodyHtml, $attachments, $replyEmail, $replyToName, $finalFromEmail, $finalFromName);
        if ($smtpSuccess) return true;
    }

    // OPSI 2: JIKA TIDAK MENGGUNAKAN SMTP (BAWAAN SERVER CPANEL MAIL)
    if (empty($attachments)) {
        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";
        $headers .= "From: =?UTF-8?B?" . base64_encode($finalFromName) . "?= <{$finalFromEmail}>\r\n";
        $headers .= "Reply-To: <{$replyEmail}>\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();
        return @mail($toEmail, $subject, $bodyHtml, $headers);
    } else {
        $boundary = "==Multipart_Boundary_" . md5(uniqid(strval(time()), true));
        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "From: =?UTF-8?B?" . base64_encode($finalFromName) . "?= <{$finalFromEmail}>\r\n";
        $headers .= "Reply-To: <{$replyEmail}>\r\n";
        $headers .= "Content-Type: multipart/mixed; boundary=\"{$boundary}\"\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

        $body  = "--{$boundary}\r\n";
        $body .= "Content-Type: text/html; charset=UTF-8\r\n";
        $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
        $body .= chunk_split(base64_encode($bodyHtml)) . "\r\n";

        foreach ($attachments as $att) {
            $attName = $att['name'] ?? 'attachment.pdf';
            $attMime = $att['mime'] ?? 'application/pdf';
            $attContent = $att['content'] ?? '';
            $body .= "--{$boundary}\r\n";
            $body .= "Content-Type: {$attMime}; name=\"{$attName}\"\r\n";
            $body .= "Content-Disposition: attachment; filename=\"{$attName}\"\r\n";
            $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
            $body .= chunk_split(base64_encode($attContent)) . "\r\n";
        }
        $body .= "--{$boundary}--";

        return @mail($toEmail, $subject, $body, $headers);
    }
}

/**
 * Helper Pengiriman Email via SMTP Socket Murni (SSL/TLS) dengan dukungan Attachment & Custom Sender
 */
function sendViaSocketSmtp($to, $subject, $htmlBody, $attachments = [], $replyToEmail = '', $replyToName = '', $customFromEmail = '', $customFromName = '')
{
    global $otpMailConfig;

    $host     = $otpMailConfig['smtp_host'] ?? 'localhost';
    $port     = intval($otpMailConfig['smtp_port'] ?? 465);
    $user     = $otpMailConfig['smtp_user'] ?? '';
    $pass     = $otpMailConfig['smtp_pass'] ?? '';
    $authMail = $otpMailConfig['from_email'] ?? $user;

    // Gunakan email dan nama pengirim marketing jika disediakan
    $fromMail = !empty($customFromEmail) ? trim($customFromEmail) : $authMail;
    $fromName = !empty($customFromName) ? trim($customFromName) : ($otpMailConfig['from_name'] ?? 'PT Pananjung Anugrah Solution');
    $secure   = strtolower($otpMailConfig['smtp_secure'] ?? 'ssl');

    $prefix = ($secure === 'ssl') ? 'ssl://' : '';
    $socket = @fsockopen($prefix . $host, $port, $errno, $errstr, 15);
    if (!$socket) {
        error_log("SMTP Connect Error: {$errno} - {$errstr}");
        return false;
    }

    $readAll = function () use ($socket) {
        $buf = '';
        while (($line = fgets($socket, 512)) !== false) {
            $buf .= $line;
            if (strlen($line) < 4 || $line[3] !== '-') break;
        }
        return $buf;
    };

    $cmd = function ($c) use ($socket, $readAll) {
        fputs($socket, $c . "\r\n");
        return $readAll();
    };

    $readAll();
    $cmd("EHLO " . ($_SERVER['SERVER_NAME'] ?? 'test.local'));

    if ($secure === 'tls') {
        $cmd("STARTTLS");
        stream_socket_enable_crypto($socket, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
        $cmd("EHLO " . ($_SERVER['SERVER_NAME'] ?? 'test.local'));
    }

    $cmd("AUTH LOGIN");
    $cmd(base64_encode($user));
    $authResp = $cmd(base64_encode($pass));

    if (strpos($authResp, '235') === false) {
        error_log("SMTP Auth Failed for {$user}. Response: " . trim($authResp));
        fputs($socket, "QUIT\r\n");
        fclose($socket);
        return false;
    }

    // Untuk SMTP Envelope, gunakan $user terautentikasi agar aman dari rejection cPanel SPF
    $cmd("MAIL FROM: <{$user}>");
    $cmd("RCPT TO: <{$to}>");
    $cmd("DATA");

    $replyEmail = !empty($replyToEmail) ? $replyToEmail : $fromMail;

    // Header MIME: Pengirim sesungguhnya yang dilihat pelanggan di inbox (From: Marketing)
    $mime  = "From: =?UTF-8?B?" . base64_encode($fromName) . "?= <{$fromMail}>\r\n";
    $mime .= "To: <{$to}>\r\n";
    $mime .= "Reply-To: <{$replyEmail}>\r\n";
    $mime .= "Subject: =?UTF-8?B?" . base64_encode($subject) . "?=\r\n";
    $mime .= "MIME-Version: 1.0\r\n";

    if (empty($attachments)) {
        $mime .= "Content-Type: text/html; charset=UTF-8\r\n";
        $mime .= "Content-Transfer-Encoding: base64\r\n\r\n";
        $mime .= chunk_split(base64_encode($htmlBody)) . "\r\n.";
    } else {
        $boundary = "==Multipart_Boundary_" . md5(uniqid(strval(time()), true));
        $mime .= "Content-Type: multipart/mixed; boundary=\"{$boundary}\"\r\n\r\n";

        $mime .= "--{$boundary}\r\n";
        $mime .= "Content-Type: text/html; charset=UTF-8\r\n";
        $mime .= "Content-Transfer-Encoding: base64\r\n\r\n";
        $mime .= chunk_split(base64_encode($htmlBody)) . "\r\n";

        foreach ($attachments as $att) {
            $attName = $att['name'] ?? 'attachment.pdf';
            $attMime = $att['mime'] ?? 'application/pdf';
            $attContent = $att['content'] ?? '';
            $mime .= "--{$boundary}\r\n";
            $mime .= "Content-Type: {$attMime}; name=\"{$attName}\"\r\n";
            $mime .= "Content-Disposition: attachment; filename=\"{$attName}\"\r\n";
            $mime .= "Content-Transfer-Encoding: base64\r\n\r\n";
            $mime .= chunk_split(base64_encode($attContent)) . "\r\n";
        }

        $mime .= "--{$boundary}--\r\n.";
    }

    $dataResp = $cmd($mime);
    $cmd("QUIT");
    fclose($socket);

    return (strpos($dataResp, '5') !== 0);
}

// ----------------------------------------------------------------------------
// 5. FUNGSI CRUD DATA MARKETING (marketing_access)
// ----------------------------------------------------------------------------

/**
 * Cari akun marketing berdasarkan email
 */
function getMarketingByEmail($email)
{
    $email = strtolower(trim($email));
    if (empty($email)) return null;

    try {
        $pdo = getCustomerPdo();
        $stmt = $pdo->prepare("SELECT * FROM `marketing_access` WHERE LOWER(`email`) = ? LIMIT 1");
        $stmt->execute([$email]);
        return $stmt->fetch() ?: null;
    } catch (Throwable $e) {
        error_log("DB Error getMarketingByEmail: " . $e->getMessage());
        return null;
    }
}

/**
 * Ambil daftar folder ID yang diizinkan untuk marketing tertentu
 */
function getMarketingAllowedFolderIds($email)
{
    $m = getMarketingByEmail($email);
    if (!$m || $m['status'] !== 'active') {
        return [];
    }

    $raw = $m['folder_ids'] ?? '';
    $ids = [];

    if (str_starts_with(trim($raw), '[')) {
        $decoded = json_decode($raw, true);
        if (is_array($decoded)) {
            $ids = $decoded;
        }
    } else {
        $parts = preg_split('/[\r\n,;]+/', $raw);
        foreach ($parts as $p) {
            $p = trim($p);
            if (preg_match('/folders\/([a-zA-Z0-9_-]+)/i', $p, $match)) {
                $p = $match[1];
            } elseif (preg_match('/[?&]id=([a-zA-Z0-9_-]+)/i', $p, $match)) {
                $p = $match[1];
            }
            if (!empty($p)) {
                $ids[] = $p;
            }
        }
    }

    return array_values(array_unique(array_filter($ids)));
}

/**
 * Ambil semua data akun marketing
 */
function getAllMarketing($search = '', $status = '')
{
    $pdo = getCustomerPdo();
    $sql = "SELECT * FROM `marketing_access` WHERE 1=1";
    $params = [];

    if (!empty($search)) {
        $sql .= " AND (nama LIKE ? OR email LIKE ? OR divisi LIKE ?)";
        $term = "%{$search}%";
        $params[] = $term;
        $params[] = $term;
        $params[] = $term;
    }

    if (!empty($status)) {
        $sql .= " AND status = ?";
        $params[] = $status;
    }

    $sql .= " ORDER BY id DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

/**
 * Simpan Akun Marketing Baru
 */
function createMarketing($nama, $email, $divisi = 'Marketing & Sales', $folderIds = '', $status = 'active')
{
    $pdo = getCustomerPdo();
    $stmt = $pdo->prepare("
        INSERT INTO `marketing_access` (nama, email, divisi, folder_ids, status, created_at)
        VALUES (?, ?, ?, ?, ?, NOW())
    ");
    return $stmt->execute([
        trim($nama),
        strtolower(trim($email)),
        trim($divisi ?: 'Marketing & Sales'),
        trim($folderIds),
        $status === 'inactive' ? 'inactive' : 'active'
    ]);
}

/**
 * Update Akun Marketing
 */
function updateMarketing($id, $nama, $email, $divisi = 'Marketing & Sales', $folderIds = '', $status = 'active')
{
    $pdo = getCustomerPdo();
    $stmt = $pdo->prepare("
        UPDATE `marketing_access`
        SET nama = ?, email = ?, divisi = ?, folder_ids = ?, status = ?, updated_at = NOW()
        WHERE id = ?
    ");
    return $stmt->execute([
        trim($nama),
        strtolower(trim($email)),
        trim($divisi ?: 'Marketing & Sales'),
        trim($folderIds),
        $status === 'inactive' ? 'inactive' : 'active',
        intval($id)
    ]);
}

/**
 * Hapus Akun Marketing
 */
function deleteMarketing($id)
{
    $pdo = getCustomerPdo();
    $stmt = $pdo->prepare("DELETE FROM `marketing_access` WHERE id = ?");
    return $stmt->execute([intval($id)]);
}

// ----------------------------------------------------------------------------
// 6. GENERATE, SEND & VERIFY OTP MARKETING
// ----------------------------------------------------------------------------

/**
 * Buat dan kirim kode OTP ke email marketing
 */
function generateAndSendMarketingOtp($email)
{
    $email = strtolower(trim($email));
    $marketing = getMarketingByEmail($email);

    if (!$marketing) {
        return [
            'success' => false,
            'message' => 'Email perusahaan marketing belum terdaftar di sistem. Silakan daftarkan melalui menu Admin Kelola Klien.'
        ];
    }

    if ($marketing['status'] !== 'active') {
        return [
            'success' => false,
            'message' => 'Akun marketing untuk email ini sedang dinonaktifkan oleh admin.'
        ];
    }

    $otpCode = str_pad((string)random_int(100000, 999999), 6, '0', STR_PAD_LEFT);
    $expiresAt = date('Y-m-d H:i:s', time() + (10 * 60)); // 10 menit

    $pdo = getCustomerPdo();
    $pdo->prepare("UPDATE `marketing_otps` SET is_used = 1 WHERE email = ? AND is_used = 0")->execute([$email]);

    $stmt = $pdo->prepare("INSERT INTO `marketing_otps` (email, otp_code, expires_at, is_used, created_at) VALUES (?, ?, ?, 0, NOW())");
    $stmt->execute([$email, $otpCode, $expiresAt]);

    $mailSent = sendMarketingOtpEmail($email, $otpCode, $marketing['nama'], $marketing['divisi']);

    $_SESSION['debug_dev_marketing_otp'] = $otpCode;
    $_SESSION['debug_dev_marketing_otp_email'] = $email;

    return [
        'success'   => true,
        'message'   => $mailSent
            ? 'Kode OTP 6-digit telah dikirimkan ke email marketing ' . $email . '. Silakan periksa kotak masuk atau spam.'
            : 'Kode OTP telah dibuat. Jika email belum masuk, silakan coba kirim ulang.',
        'mail_sent' => $mailSent,
        'debug_otp' => $otpCode
    ];
}

/**
 * Verifikasi kode OTP marketing
 */
function verifyMarketingOtp($email, $otpInput)
{
    $email    = strtolower(trim($email));
    $otpInput = trim($otpInput);

    if (empty($email) || empty($otpInput)) {
        return ['success' => false, 'message' => 'Email dan kode OTP wajib diisi.'];
    }

    $pdo = getCustomerPdo();
    $stmt = $pdo->prepare("
        SELECT * FROM `marketing_otps`
        WHERE email = ? AND otp_code = ? AND is_used = 0
        ORDER BY id DESC LIMIT 1
    ");
    $stmt->execute([$email, $otpInput]);
    $otpRow = $stmt->fetch();

    if (!$otpRow) {
        return ['success' => false, 'message' => 'Kode OTP salah atau sudah pernah digunakan.'];
    }

    if (strtotime($otpRow['expires_at']) < time()) {
        return ['success' => false, 'message' => 'Kode OTP telah kadaluarsa (melebihi 10 menit). Silakan minta kode baru.'];
    }

    $pdo->prepare("UPDATE `marketing_otps` SET is_used = 1 WHERE id = ?")->execute([$otpRow['id']]);

    $marketing = getMarketingByEmail($email);
    if (!$marketing || $marketing['status'] !== 'active') {
        return ['success' => false, 'message' => 'Akun marketing tidak aktif atau tidak ditemukan.'];
    }

    return [
        'success'   => true,
        'marketing' => $marketing
    ];
}

/**
 * Kirim Email OTP Marketing
 */
function sendMarketingOtpEmail($toEmail, $otpCode, $marketingName = '', $divisi = '')
{
    $subject = "Kode OTP Masuk Portal Marketing Sertifikat: {$otpCode}";
    $displayName = !empty($marketingName) ? htmlspecialchars($marketingName) : 'Rekan Marketing';
    $displayDivisi = !empty($divisi) ? '(' . htmlspecialchars($divisi) . ')' : '';

    $bodyHtml = "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='utf-8'>
        <style>
            body { font-family: 'Segoe UI', Arial, sans-serif; background-color: #f8fafc; margin: 0; padding: 20px; color: #1e293b; }
            .container { max-width: 520px; margin: 0 auto; background: #ffffff; border-radius: 16px; overflow: hidden; border: 1px solid #e2e8f0; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
            .header { background: linear-gradient(135deg, #0284c7, #0369a1); padding: 24px; text-align: center; color: white; }
            .header h2 { margin: 0; font-size: 18px; font-weight: 700; letter-spacing: 0.5px; }
            .header p { margin: 4px 0 0; font-size: 12px; opacity: 0.9; }
            .content { padding: 30px 24px; text-align: center; }
            .greeting { font-size: 15px; color: #334155; margin-bottom: 12px; text-align: left; }
            .desc { font-size: 13px; color: #64748b; line-height: 1.6; margin-bottom: 24px; text-align: left; }
            .otp-box { background: #f0f9ff; border: 2px dashed #0284c7; border-radius: 12px; padding: 18px; display: inline-block; margin: 10px 0 20px; }
            .otp-number { font-size: 32px; font-weight: 800; letter-spacing: 8px; color: #0284c7; font-family: monospace; }
            .expiry-note { font-size: 12px; color: #dc2626; margin-top: 6px; font-weight: 600; }
            .footer { background: #f8fafc; padding: 16px; text-align: center; font-size: 11px; color: #94a3b8; border-top: 1px solid #f1f5f9; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h2>PT PANANJUNG ANUGRAH SOLUTION</h2>
                <p>Portal Pengiriman Sertifikat (Khusus Tim Marketing)</p>
            </div>
            <div class='content'>
                <div class='greeting'>Halo <strong>{$displayName}</strong> {$displayDivisi},</div>
                <div class='desc'>
                    Gunakan kode verifikasi (OTP) di bawah ini untuk masuk ke <strong>Portal Pengiriman Sertifikat Digital</strong>:
                </div>
                
                <div class='otp-box'>
                    <div class='otp-number'>{$otpCode}</div>
                    <div class='expiry-note'>*Berlaku selama 10 menit</div>
                </div>

                <div class='desc' style='font-size: 12px;'>
                    Kode OTP ini khusus untuk otentikasi tim internal marketing PT Pananjung Anugrah Solution. Jangan berikan kode ini kepada siapapun demi keamanan berkas sertifikat pelanggan.
                </div>
            </div>
            <div class='footer'>
                &copy; " . date('Y') . " PT PANANJUNG ANUGRAH SOLUTION. All rights reserved.
            </div>
        </div>
    </body>
    </html>";

    return sendCustomerGenericEmail($toEmail, $subject, $bodyHtml);
}

// ----------------------------------------------------------------------------
// 7. PENGIRIMAN SERTIFIKAT KE EMAIL CUSTOMER OLEH TIM MARKETING
// ----------------------------------------------------------------------------

/**
 * Kirim email sertifikat resmi ke email pelanggan (Mendukung 1 atau Banyak Berkas Sekaligus)
 */
function sendCertificateEmailToCustomer($toEmail, $customerName, $companyName, $senderName, $senderEmail, $fileInfo, $viewUrl = '', $customNotes = '', $pdfContent = null)
{
    // Normalisasi apakah satu berkas atau banyak berkas
    $isMultiple = false;
    $fileList = [];

    if (isset($fileInfo[0]) && is_array($fileInfo[0])) {
        // Banyak berkas
        $isMultiple = true;
        $fileList = $fileInfo;
    } else {
        // Satu berkas
        $fileName = $fileInfo['name'] ?? 'Sertifikat_Kalibrasi.pdf';
        $certId = '';
        if (preg_match('/(PAS-\d+)/i', $fileName, $m)) {
            $certId = strtoupper($m[1]);
        } else {
            $certId = pathinfo($fileName, PATHINFO_FILENAME);
        }
        $fileList = [[
            'id'      => $fileInfo['id'] ?? '',
            'name'    => $fileName,
            'certId'  => $certId,
            'viewUrl' => $viewUrl
        ]];
    }

    $totalFiles = count($fileList);
    if ($isMultiple && $totalFiles > 1) {
        $subject = "Sertifikat Kalibrasi Digital ({$totalFiles} Berkas) - PT PANANJUNG ANUGRAH SOLUTION";
    } else {
        $firstCertId = $fileList[0]['certId'] ?? pathinfo($fileList[0]['name'], PATHINFO_FILENAME);
        $subject = "Sertifikat Kalibrasi Digital: {$firstCertId} - PT PANANJUNG ANUGRAH SOLUTION";
    }

    $displayName = !empty($customerName) ? htmlspecialchars($customerName) : 'Bapak/Ibu Pelanggan';
    $displayCompany = !empty($companyName) ? htmlspecialchars($companyName) : 'Pelanggan Terhormat';
    $displaySender = !empty($senderName) ? htmlspecialchars($senderName) : 'Tim Marketing';
    $displayNotes = !empty(trim($customNotes)) ? nl2br(htmlspecialchars(trim($customNotes))) : '';

    $bodyHtml = "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='utf-8'>
        <style>
            body { font-family: 'Segoe UI', Arial, sans-serif; background-color: #f1f5f9; margin: 0; padding: 20px; color: #1e293b; }
            .container { max-width: 620px; margin: 0 auto; background: #ffffff; border-radius: 16px; overflow: hidden; border: 1px solid #e2e8f0; box-shadow: 0 4px 16px rgba(0,0,0,0.06); }
            .header { background: linear-gradient(135deg, #0284c7, #0369a1); padding: 28px 24px; text-align: center; color: white; }
            .header h2 { margin: 0; font-size: 20px; font-weight: 700; letter-spacing: 0.5px; }
            .header p { margin: 6px 0 0; font-size: 13px; opacity: 0.9; }
            .content { padding: 32px 28px; }
            .greeting { font-size: 15px; color: #0f172a; margin-bottom: 12px; }
            .desc { font-size: 14px; color: #475569; line-height: 1.6; margin-bottom: 20px; }
            .cert-card { background: #f8fafc; border: 1px solid #cbd5e1; border-left: 4px solid #0284c7; border-radius: 10px; padding: 14px 18px; margin: 12px 0; }
            .cert-title { font-size: 14px; font-weight: 700; color: #0f172a; margin-bottom: 4px; word-break: break-all; }
            .cert-meta { font-size: 12px; color: #64748b; line-height: 1.5; }
            .notes-card { background: #fffbeb; border: 1px dashed #f59e0b; border-radius: 10px; padding: 14px 18px; margin: 20px 0; font-size: 13px; color: #92400e; }
            .btn-action { display: inline-block; background: #0284c7; color: #ffffff !important; text-decoration: none; padding: 7px 16px; border-radius: 20px; font-weight: 600; font-size: 12px; margin-top: 6px; }
            .sender-box { border-top: 1px solid #e2e8f0; padding-top: 18px; margin-top: 24px; font-size: 12px; color: #64748b; line-height: 1.5; }
            .footer { background: #f8fafc; padding: 18px; text-align: center; font-size: 11px; color: #94a3b8; border-top: 1px solid #f1f5f9; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h2>PT PANANJUNG ANUGRAH SOLUTION</h2>
                <p>Laboratorium Kalibrasi</p>
            </div>
            <div class='content'>
                <div class='greeting'>Yth. <strong>{$displayName}</strong> / {$displayCompany},</div>
                <div class='desc'>
                    Terima kasih telah mempercayakan kalibrasi alat ukur dan instrumen Anda kepada <strong>PT Pananjung Anugrah Solution</strong>. Bersama ini kami kirimkan <strong>{$totalFiles} berkas sertifikat kalibrasi digital</strong> resmi Anda:
                </div>";

    foreach ($fileList as $idx => $f) {
        $no = $idx + 1;
        $fn = htmlspecialchars($f['name']);
        $cid = htmlspecialchars($f['certId'] ?? '');
        $vUrl = htmlspecialchars($f['viewUrl'] ?? '');
        $bodyHtml .= "
                <div class='cert-card'>
                    <div class='cert-title'>📄 {$no}. {$fn}</div>
                    <div class='cert-meta'>
                        <strong>No. Sertifikat / Identitas:</strong> {$cid}<br>";
        if (!empty($vUrl)) {
            $bodyHtml .= "
                        <a href='{$vUrl}' class='btn-action' target='_blank'>🔍 Buka & Unduh Online</a>";
        }
        $bodyHtml .= "
                    </div>
                </div>";
    }

    if (!empty($displayNotes)) {
        $bodyHtml .= "
                <div class='notes-card'>
                    <strong>Pesan dari Tim Marketing:</strong><br>
                    {$displayNotes}
                </div>";
    }

    $bodyHtml .= "
                <div class='desc' style='font-size: 13px; color: #64748b; margin-top: 20px;'>
                    Seluruh berkas di atas dapat dibuka dan diverifikasi keasliannya kapan saja melalui tautan online masing-masing. Jika berkas PDF dilampirkan langsung pada email ini, Anda juga dapat mengunduh dan menyimpannya secara offline.
                </div>
            </div>
            <div class='footer'>
                &copy; " . date('Y') . " PT PANANJUNG ANUGRAH SOLUTION. All rights reserved.<br>
            </div>
        </div>
    </body>
    </html>";

    // Handle attachments
    $attachments = [];
    if (!empty($pdfContent)) {
        if (is_array($pdfContent) && isset($pdfContent[0])) {
            // Array of attachments: [['name' => ..., 'content' => ..., 'mime' => ...]]
            $attachments = $pdfContent;
        } elseif (is_string($pdfContent)) {
            // Single attachment string
            $singleName = preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $fileList[0]['name'] ?? 'Sertifikat.pdf');
            if (!str_ends_with(strtolower($singleName), '.pdf')) $singleName .= '.pdf';
            $attachments[] = [
                'name'    => $singleName,
                'content' => $pdfContent,
                'mime'    => 'application/pdf'
            ];
        }
    }

    return sendCustomerGenericEmail($toEmail, $subject, $bodyHtml, $attachments, $senderEmail, $senderName, $senderEmail, $senderName);
}

// ============================================================================
// 10. NOTIFIKASI OTOMATIS BERKAS SERTIFIKAT BARU DI GOOGLE DRIVE KLIEN
// ============================================================================

/**
 * Dapatkan token Google Drive Service Account
 */
function getCustomerSaToken($credentialsPath = null) {
    if (!$credentialsPath) {
        $credentialsPath = __DIR__ . '/credentials.json';
    }
    if (!file_exists($credentialsPath)) {
        return null;
    }

    $sa = json_decode(file_get_contents($credentialsPath), true);
    if (!$sa || empty($sa['private_key']) || empty($sa['client_email'])) {
        return null;
    }

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
    curl_setopt($ch, CURLOPT_TIMEOUT, 12);
    $res = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($res, true);
    return $data['access_token'] ?? null;
}

/**
 * Helper cURL GDrive API
 */
function callGDriveApiCustomer($url, $accessToken) {
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
 * Kirim email notifikasi bahwa sertifikat kalibrasi baru telah tersedia di folder klien
 */
function sendNewCertificateNotificationEmail($toEmail, $clientName, $companyName, $fileName, $fileId, $folderName = '', $portalUrl = '') {
    $toEmail = strtolower(trim($toEmail));
    if (empty($toEmail) || !filter_var($toEmail, FILTER_VALIDATE_EMAIL)) {
        return false;
    }

    if (empty($portalUrl)) {
        $host = $_SERVER['HTTP_HOST'] ?? 'pascalibration.com';
        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $portalUrl = $scheme . '://' . $host . '/cariSertifikat.php';
        if ($host === 'pascalibration.com' || strpos($host, 'pascalibration.com') !== false) {
            $portalUrl = 'https://pascalibration.com/portal-sertifikat';
        }
    }

    $displayName    = !empty($clientName) ? htmlspecialchars(trim($clientName)) : 'Bapak/Ibu Pelanggan';
    $displayCompany = !empty($companyName) ? htmlspecialchars(trim($companyName)) : 'Perusahaan Anda';
    $safeFileName   = htmlspecialchars($fileName);
    $safeFolderName = !empty($folderName) ? htmlspecialchars(trim($folderName)) : 'Folder Sertifikat';
    $safeEmail      = htmlspecialchars($toEmail);
    $safePortalUrl  = htmlspecialchars($portalUrl);
    $displayDate    = date('d F Y, H:i') . ' WIB';

    $subject = "Sertifikat Baru di Folder [{$safeFolderName}]: {$fileName} - {$displayCompany}";

    $bodyHtml = "
    <!DOCTYPE html>
    <html lang='id'>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>{$subject}</title>
        <style>
            body { font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #f1f5f9; margin: 0; padding: 24px 12px; color: #1e293b; -webkit-font-smoothing: antialiased; }
            .container { max-width: 580px; margin: 0 auto; background: #ffffff; border-radius: 16px; overflow: hidden; border: 1px solid #e2e8f0; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.06); }
            .header { background: linear-gradient(135deg, #059669 0%, #0284c7 100%); padding: 32px 24px; text-align: center; color: #ffffff; }
            .header-badge { display: inline-block; background: rgba(255,255,255,0.2); border: 1px solid rgba(255,255,255,0.35); border-radius: 50px; padding: 4px 14px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px; }
            .header h1 { margin: 0; font-size: 19px; font-weight: 800; letter-spacing: 0.3px; line-height: 1.3; }
            .header p { margin: 6px 0 0; font-size: 12.5px; opacity: 0.9; }
            .content { padding: 32px 26px; line-height: 1.6; }
            .greeting { font-size: 16px; font-weight: 700; color: #0f172a; margin-bottom: 14px; }
            .paragraph { font-size: 14px; color: #475569; margin-bottom: 16px; line-height: 1.65; }
            .highlight-card { background: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid #059669; border-radius: 10px; padding: 18px 20px; margin: 22px 0; }
            .highlight-title { font-size: 12px; font-weight: 700; color: #059669; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 10px; }
            .btn-cta-box { text-align: center; margin: 30px 0 24px; }
            .btn-cta { display: inline-block; background: linear-gradient(135deg, #059669 0%, #0284c7 100%); color: #ffffff !important; padding: 15px 36px; border-radius: 50px; font-size: 15px; font-weight: 700; text-decoration: none; box-shadow: 0 4px 18px rgba(5, 150, 105, 0.35); }
            .steps-box { background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 12px; padding: 18px 20px; margin-top: 24px; }
            .steps-title { font-size: 13px; font-weight: 700; color: #166534; margin-bottom: 8px; }
            .steps-list { margin: 0; padding-left: 20px; font-size: 12.5px; color: #15803d; line-height: 1.7; }
            .footer { background: #f8fafc; padding: 22px; text-align: center; font-size: 11.5px; color: #94a3b8; border-top: 1px solid #f1f5f9; line-height: 1.6; }
            @media only screen and (max-width: 520px) {
                body { padding: 12px 6px !important; }
                .container { width: 100% !important; border-radius: 12px !important; }
                .header { padding: 24px 16px !important; }
                .content { padding: 22px 16px !important; }
                .highlight-card { padding: 14px 14px !important; }
                .detail-table, .detail-table tbody, .detail-table tr, .detail-table td {
                    display: block !important;
                    width: 100% !important;
                    box-sizing: border-box !important;
                }
                .detail-table tr {
                    padding: 8px 0 !important;
                    border-bottom: 1px dashed #e2e8f0 !important;
                }
                .detail-table tr:last-child {
                    border-bottom: none !important;
                }
                .detail-table td.detail-label {
                    text-align: left !important;
                    padding: 0 0 2px 0 !important;
                    font-size: 11.5px !important;
                    color: #64748b !important;
                    font-weight: 500 !important;
                }
                .detail-table td.detail-value {
                    text-align: left !important;
                    padding: 0 !important;
                    font-size: 13.5px !important;
                }
                .btn-cta { display: block !important; padding: 14px 20px !important; font-size: 14px !important; }
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <div class='header-badge'>Notifikasi Berkas Sertifikat Baru</div>
                <h1>PT PANANJUNG ANUGRAH SOLUTION</h1>
                <p>Sistem Kalibrasi &amp; Sertifikat Digital Paperless</p>
            </div>
            <div class='content'>
                <div class='greeting'>Halo, {$displayName}</div>
                <div class='paragraph'>
                    Kami informasikan bahwa berkas <strong>Sertifikat Kalibrasi baru</strong> telah ditambahkan ke dalam folder <strong>{$safeFolderName}</strong> untuk perusahaan Anda (<strong>{$displayCompany}</strong>).
                </div>

                <div class='highlight-card'>
                    <div class='highlight-title'>Detail Berkas Baru :</div>
                    <table class='detail-table' style='width: 100%; border-collapse: collapse; font-size: 13px; table-layout: fixed;'>
                        <tr>
                            <td class='detail-label' style='padding: 6px 0; color: #64748b; width: 35%; vertical-align: top;'>Folder Penyimpanan:</td>
                            <td class='detail-value' style='padding: 6px 0; text-align: right; font-weight: 700; color: #0284c7; word-break: break-word;'>📁 {$safeFolderName}</td>
                        </tr>
                        <tr>
                            <td class='detail-label' style='padding: 6px 0; color: #64748b; width: 35%; vertical-align: top;'>Nama Berkas:</td>
                            <td class='detail-value' style='padding: 6px 0; text-align: right; font-weight: 700; color: #059669; word-break: break-word;'>📄 {$safeFileName}</td>
                        </tr>
                        <tr>
                            <td class='detail-label' style='padding: 6px 0; color: #64748b; width: 35%; vertical-align: top;'>Perusahaan:</td>
                            <td class='detail-value' style='padding: 6px 0; text-align: right; font-weight: 600; color: #0f172a; word-break: break-word;'>{$displayCompany}</td>
                        </tr>
                        <tr>
                            <td class='detail-label' style='padding: 6px 0; color: #64748b; width: 35%; vertical-align: top;'>Waktu Tersedia:</td>
                            <td class='detail-value' style='padding: 6px 0; text-align: right; font-weight: 600; color: #334155;'>{$displayDate}</td>
                        </tr>
                    </table>
                </div>

                <div class='btn-cta-box'>
                    <a href='{$safePortalUrl}' class='btn-cta' target='_blank'>
                        Buka &amp; Unduh Sertifikat &rarr;
                    </a>
                </div>

                <div class='steps-box'>
                    <div class='steps-title'>Cara Melihat Sertifikat:</div>
                    <ol class='steps-list'>
                        <li>Klik tombol <strong>Buka &amp; Unduh Sertifikat</strong> di atas.</li>
                        <li>Masukkan email Anda (<strong>{$safeEmail}</strong>) lalu klik <em>Login / Kirim OTP</em>.</li>
                        <li>Masukkan 6 digit kode OTP yang dikirimkan ke email Anda untuk membuka seluruh berkas sertifikat.</li>
                    </ol>
                </div>

                <div style='font-size: 12px; color: #64748b; margin-top: 24px; line-height: 1.6;'>
                    <em>*Pemberitahuan otomatis ini dikirimkan khusus kepada pemilik hak akses folder perusahaan terkait.</em>
                </div>
            </div>
            <div class='footer'>
                &copy; " . date('Y') . " PT PANANJUNG ANUGRAH SOLUTION. All rights reserved.
            </div>
        </div>
    </body>
    </html>";

    return sendCustomerGenericEmail($toEmail, $subject, $bodyHtml);
}

/**
 * Pindai seluruh folder klien di Google Drive dan kirimkan email notifikasi jika ada berkas baru
 * 
 * @param array $options
 *   - 'recent_days': int (default: 7) hanya berkas yang diubah/dibuat dalam N hari terakhir. Set 0 untuk semua.
 *   - 'mark_only': bool (default: false) jika true, hanya menandai berkas yang ada sebagai sudah ternotifikasi tanpa kirim email (baseline sync).
 *   - 'limit_per_folder': int (default: 50) batas maksimal berkas yang dicek per folder.
 * @return array
 */
function checkAndNotifyNewCertificates($options = []) {
    $recentMinutes  = isset($options['recent_minutes']) ? intval($options['recent_minutes']) : null;
    $recentDays     = isset($options['recent_days']) ? floatval($options['recent_days']) : ($recentMinutes !== null ? null : 7);
    $markOnly       = !empty($options['mark_only']);
    $limitPerFolder = isset($options['limit_per_folder']) ? intval($options['limit_per_folder']) : 50;
    $credentialsPath= $options['credentials_path'] ?? (__DIR__ . '/credentials.json');

    $pdo = getCustomerPdo();

    // 1. Dapatkan Access Token Service Account
    $accessToken = getCustomerSaToken($credentialsPath);
    if (!$accessToken) {
        return [
            'success' => false,
            'message' => 'Gagal mendapatkan access token Google Drive Service Account. Periksa file credentials.json.'
        ];
    }

    // 2. Kumpulkan seluruh folder ID dan peta klien penerima
    // Struktur: $folderMap[$folderId] = [ ['email' => ..., 'nama' => ..., 'perusahaan' => ..., 'client_id' => ...], ... ]
    $folderMap = [];

    $activeClients = $pdo->query("SELECT * FROM `client_access` WHERE `status` = 'active'")->fetchAll();

    foreach ($activeClients as $client) {
        $cEmail       = strtolower(trim($client['email']));
        $cNama        = trim($client['nama']);
        $cPerusahaan  = trim($client['perusahaan']);
        $cId          = $client['id'];

        // Ambil folder-folder untuk email utama
        $mainFolderRaw = trim($client['folder_ids'] ?? '');
        if (!empty($client['folder_ids_tambahan'])) {
            $mainFolderRaw .= "\n" . trim($client['folder_ids_tambahan']);
        }
        $mainFolderIds = [];
        if (!empty($mainFolderRaw)) {
            $rawList = preg_split('/[\r\n,;]+/', $mainFolderRaw);
            foreach ($rawList as $rItem) {
                $ext = extractGoogleDriveId($rItem);
                if ($ext) $mainFolderIds[] = $ext;
            }
        }
        $mainFolderIds = array_unique(array_filter($mainFolderIds));

        // Daftarkan email utama ke folder-foldernya
        foreach ($mainFolderIds as $fId) {
            if (!isset($folderMap[$fId])) $folderMap[$fId] = [];
            $folderMap[$fId][$cEmail] = [
                'email'      => $cEmail,
                'nama'       => $cNama,
                'perusahaan' => $cPerusahaan,
                'client_id'  => $cId
            ];
        }

        // Ambil email tambahan
        $additionalEmails = parseAdditionalEmails($client['email_tambahan'] ?? '');
        foreach ($additionalEmails as $add) {
            $addEmail = strtolower(trim($add['email']));
            if (empty($addEmail)) continue;

            $addFolders = [];
            if (!empty($add['folder_ids'])) {
                $rawList = preg_split('/[\r\n,;]+/', $add['folder_ids']);
                foreach ($rawList as $rItem) {
                    $ext = extractGoogleDriveId($rItem);
                    if ($ext) $addFolders[] = $ext;
                }
            } else {
                // Jika email tambahan tidak menentukan folder khusus, gunakan folder utama klien
                $addFolders = $mainFolderIds;
            }

            foreach ($addFolders as $fId) {
                if (!isset($folderMap[$fId])) $folderMap[$fId] = [];
                $folderMap[$fId][$addEmail] = [
                    'email'      => $addEmail,
                    'nama'       => !empty($add['nama']) ? $add['nama'] : $cNama,
                    'perusahaan' => $cPerusahaan,
                    'client_id'  => $cId
                ];
            }
        }
    }

    if (empty($folderMap)) {
        return [
            'success'            => true,
            'message'            => 'Tidak ada folder klien aktif yang terdaftar di sistem.',
            'scanned_folders'    => 0,
            'notifications_sent' => 0,
            'details'            => []
        ];
    }

    // 3. Pindai setiap folder di Google Drive
    $sentLog      = [];
    $totalFolders = count($folderMap);
    $errors       = [];

    // Filter tanggal Google Drive (RFC 3339 UTC)
    $timeQuery = "";
    $thresholdTimestamp = null;
    if ($recentMinutes !== null && $recentMinutes > 0) {
        $thresholdTimestamp = time() - ($recentMinutes * 60);
        $thresholdIso       = gmdate('Y-m-d\TH:i:s\Z', $thresholdTimestamp);
        $timeQuery          = " and modifiedTime >= '{$thresholdIso}'";
    } elseif ($recentDays !== null && $recentDays > 0) {
        $thresholdTimestamp = time() - intval($recentDays * 86400);
        $thresholdIso       = gmdate('Y-m-d\TH:i:s\Z', $thresholdTimestamp);
        $timeQuery          = " and modifiedTime >= '{$thresholdIso}'";
    }

    $insertStmt = $pdo->prepare("
        INSERT INTO `client_notified_files` (file_id, file_name, folder_id, client_email, client_id, sent_at, status)
        VALUES (?, ?, ?, ?, ?, NOW(), ?)
        ON DUPLICATE KEY UPDATE sent_at = NOW(), status = VALUES(status)
    ");

    $checkStmt = $pdo->prepare("
        SELECT id FROM `client_notified_files`
        WHERE file_id = ? AND client_email = ?
        LIMIT 1
    ");

    // Cache nama folder agar tidak query berulang untuk folder yang sama
    $folderNameCache = [];

    foreach ($folderMap as $folderId => $recipients) {
        if (empty($recipients)) continue;

        // Ambil nama folder dari Google Drive API (cache agar tidak query berulang)
        if (!isset($folderNameCache[$folderId])) {
            $folderMetaUrl = "https://www.googleapis.com/drive/v3/files/{$folderId}?" . http_build_query([
                'fields'                    => 'id,name',
                'supportsAllDrives'         => 'true',
                'includeItemsFromAllDrives' => 'true'
            ]);
            $folderMeta = callGDriveApiCustomer($folderMetaUrl, $accessToken);
            $folderNameCache[$folderId] = !empty($folderMeta['name']) ? $folderMeta['name'] : 'Folder Sertifikat';
        }
        $currentFolderName = $folderNameCache[$folderId];

        // Query files di dalam folder
        $q = "'{$folderId}' in parents and trashed = false and mimeType != 'application/vnd.google-apps.folder'{$timeQuery}";
        $url = "https://www.googleapis.com/drive/v3/files?" . http_build_query([
            'q'                           => $q,
            'fields'                      => 'files(id,name,mimeType,modifiedTime,createdTime,size)',
            'orderBy'                     => 'modifiedTime desc',
            'pageSize'                    => $limitPerFolder,
            'supportsAllDrives'           => 'true',
            'includeItemsFromAllDrives'   => 'true'
        ]);

        $res = callGDriveApiCustomer($url, $accessToken);
        $files = $res['files'] ?? [];

        if (!empty($res['error'])) {
            $errors[] = "Folder {$folderId}: " . ($res['error']['message'] ?? 'API error');
            continue;
        }

        foreach ($files as $file) {
            $fileId   = $file['id'];
            $fileName = $file['name'];

            // Proteksi Tambahan: Jangan pernah kirim berkas yang lebih lama dari threshold
            if ($thresholdTimestamp !== null) {
                $modTs = !empty($file['modifiedTime']) ? strtotime($file['modifiedTime']) : 0;
                $creTs = !empty($file['createdTime']) ? strtotime($file['createdTime']) : 0;
                $latestFileTime = max($modTs, $creTs);
                if ($latestFileTime > 0 && $latestFileTime < $thresholdTimestamp) {
                    // Berkas ini dibuat/diubah sebelum ambang batas waktu, abaikan!
                    continue;
                }
            }

            foreach ($recipients as $recipient) {
                $rEmail       = $recipient['email'];
                $rNama        = $recipient['nama'];
                $rPerusahaan  = $recipient['perusahaan'];
                $rClientId    = $recipient['client_id'];

                // Cek apakah kombinasi file_id + client_email sudah pernah dinotifikasikan
                $checkStmt->execute([$fileId, $rEmail]);
                if ($checkStmt->fetch()) {
                    // Sudah pernah dinotifikasikan, lewati
                    continue;
                }

                if ($markOnly) {
                    // Mode inisialisasi / baseline: hanya tandai tanpa kirim email
                    $insertStmt->execute([$fileId, $fileName, $folderId, $rEmail, $rClientId, 'sent']);
                    $sentLog[] = [
                        'file_id'    => $fileId,
                        'file_name'  => $fileName,
                        'folder_name'=> $currentFolderName,
                        'email'      => $rEmail,
                        'perusahaan' => $rPerusahaan,
                        'status'     => 'marked'
                    ];
                } else {
                    // Kirim email notifikasi — sertakan nama folder
                    $sent = sendNewCertificateNotificationEmail($rEmail, $rNama, $rPerusahaan, $fileName, $fileId, $currentFolderName);
                    $status = $sent ? 'sent' : 'failed';
                    $insertStmt->execute([$fileId, $fileName, $folderId, $rEmail, $rClientId, $status]);

                    $sentLog[] = [
                        'file_id'    => $fileId,
                        'file_name'  => $fileName,
                        'folder_name'=> $currentFolderName,
                        'email'      => $rEmail,
                        'perusahaan' => $rPerusahaan,
                        'status'     => $status
                    ];
                }
            }
        }
    }

    $notificationsSent = 0;
    foreach ($sentLog as $logItem) {
        if ($logItem['status'] === 'sent') {
            $notificationsSent++;
        }
    }

    return [
        'success'            => true,
        'scanned_folders'    => $totalFolders,
        'notifications_sent' => $notificationsSent,
        'total_processed'    => count($sentLog),
        'is_mark_only'       => $markOnly,
        'details'            => $sentLog,
        'errors'             => $errors
    ];
}
