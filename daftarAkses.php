<?php
// ============================================================================
// daftarAkses.php — Formulir Pendaftaran Akses Sertifikat Digital Klien
// PT PANANJUNG ANUGRAH SOLUTION
// ============================================================================

session_start();
require_once __DIR__ . '/db_customer.php';

$isSubmitted = false;
$submitSuccess = false;
$submitMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama           = trim($_POST['nama'] ?? '');
    $perusahaan     = trim($_POST['perusahaan'] ?? '');
    $jabatan        = trim($_POST['jabatan'] ?? '');
    $email          = strtolower(trim($_POST['email'] ?? ''));
    $modelAkses     = trim($_POST['model_akses'] ?? 'MODEL A');
    
    // Tangkap daftar email tambahan dinamis
    $namasTambahan  = $_POST['nama_tambahan'] ?? [];
    $emailsTambahan = $_POST['email_tambahan'] ?? [];
    $notesTambahan  = $_POST['note_tambahan'] ?? [];
    
    $additionalList = [];
    if (is_array($emailsTambahan)) {
        foreach ($emailsTambahan as $idx => $em) {
            $emClean = strtolower(trim($em));
            $nmClean = trim($namasTambahan[$idx] ?? '');
            $ntClean = trim($notesTambahan[$idx] ?? '');
            if (!empty($emClean) && filter_var($emClean, FILTER_VALIDATE_EMAIL)) {
                $additionalList[] = [
                    'nama'       => $nmClean,
                    'email'      => $emClean,
                    'note'       => $ntClean,
                    'folder_ids' => ''
                ];
            }
        }
    }
    
    $emailTambahanJson = !empty($additionalList) ? json_encode($additionalList, JSON_UNESCAPED_UNICODE) : '';

    if (empty($nama) || empty($perusahaan) || empty($jabatan) || empty($email)) {
        $submitSuccess = false;
        $submitMessage = 'Mohon lengkapi semua kolom yang wajib diisi (*).';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $submitSuccess = false;
        $submitMessage = 'Format alamat email utama tidak valid.';
    } else {
        $res = registerCustomerPublicForm($nama, $perusahaan, $jabatan, $email, $modelAkses, $emailTambahanJson);
        $submitSuccess = $res['success'];
        $submitMessage = $res['message'];
        $isSubmitted   = $res['success'];
    }

    // Jika dipanggil via AJAX/Fetch
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([
            'success' => $submitSuccess,
            'message' => $submitMessage
        ]);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran Akses Sertifikat Digital — PT Pananjung Anugrah Solution</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link rel="icon" href="https://www.pascalibration.com/wp-content/uploads/2023/09/logo_pas_basic.png" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Product+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --gform-bg: #f0ebf8;
            --gform-card-bg: #ffffff;
            --gform-accent: #0284c7;
            --gform-header-gradient: linear-gradient(135deg, #0284c7 0%, #0369a1 50%, #075985 100%);
            --gform-border: #dadce0;
            --text-main: #202124;
            --text-secondary: #5f6368;
            --border-radius: 12px;
        }

        body {
            background-color: var(--gform-bg);
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            color: var(--text-main);
            min-height: 100vh;
            padding-bottom: 60px;
        }

        .form-container {
            max-width: 770px;
            margin: 0 auto;
            padding: 24px 16px;
        }

        /* Card Section Styles */
        .gform-card {
            background: var(--gform-card-bg);
            border: 1px solid #e0e0e0;
            border-radius: var(--border-radius);
            box-shadow: 0 1px 4px rgba(0,0,0,0.06);
            padding: 26px 28px;
            margin-bottom: 18px;
            transition: box-shadow 0.2s ease, border-color 0.2s ease;
        }

        .gform-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        /* Header Card with Color Stripe */
        .gform-header-card {
            border-top: 10px solid #0284c7;
            position: relative;
            overflow: hidden;
            padding-top: 32px;
        }

        .header-logo {
            height: 48px;
            object-fit: contain;
            margin-bottom: 20px;
        }

        .form-title {
            font-size: 1.85rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 10px;
            letter-spacing: -0.5px;
        }

        .form-desc {
            font-size: 0.92rem;
            color: var(--text-secondary);
            line-height: 1.6;
            margin-bottom: 18px;
        }

        .required-notice {
            color: #d93025;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .question-title {
            font-size: 1rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .question-desc {
            font-size: 0.82rem;
            color: var(--text-secondary);
            margin-bottom: 14px;
            line-height: 1.5;
        }

        .gform-input {
            width: 100%;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 12px 14px;
            font-size: 0.95rem;
            outline: none;
            transition: all 0.2s ease;
            background-color: #ffffff;
            color: var(--text-main);
        }

        .gform-input:focus {
            border-color: #0284c7;
            box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.18);
        }

        /* Radio Choice Cards */
        .model-option-card {
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 14px 18px;
            margin-bottom: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: flex-start;
            gap: 14px;
            background: #ffffff;
        }

        .model-option-card:hover {
            border-color: #93c5fd;
            background: #f8fafc;
        }

        .model-option-card.active {
            border-color: #0284c7;
            background: #f0f9ff;
            box-shadow: 0 2px 8px rgba(2, 132, 199, 0.12);
        }

        .model-option-card input[type="radio"] {
            margin-top: 4px;
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #0284c7;
        }

        /* Visual Folder Diagram Models */
        .visual-diagram-card {
            background: #f8fafc;
            border: 1px dashed #cbd5e1;
            border-radius: 12px;
            padding: 18px;
            margin-top: 14px;
        }

        .tree-node {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.86rem;
            margin-bottom: 6px;
            font-weight: 600;
        }

        .tree-node.level-0 { color: #0284c7; font-size: 0.92rem; font-weight: 700; }
        .tree-node.level-1 { margin-left: 24px; color: #334155; }
        .tree-node.level-2 { margin-left: 48px; color: #475569; }

        .tree-badge {
            font-size: 0.72rem;
            padding: 2px 8px;
            border-radius: 20px;
            background: #e2e8f0;
            color: #475569;
            font-weight: 600;
        }

        /* Panduan Skenario */
        .scenario-box {
            background: #f8fafc;
            border-left: 4px solid #0284c7;
            padding: 14px 18px;
            border-radius: 0 8px 8px 0;
            margin-bottom: 12px;
            font-size: 0.86rem;
            line-height: 1.6;
        }

        .scenario-title {
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 4px;
        }

        .note-highlight {
            background: #fffbeb;
            border: 1px solid #fde68a;
            border-radius: 10px;
            padding: 14px 16px;
            font-size: 0.84rem;
            color: #92400e;
            margin-top: 14px;
            line-height: 1.5;
        }

        /* Dynamic Email Tambahan Row */
        .email-extra-row {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 14px;
            margin-bottom: 12px;
            position: relative;
        }

        .btn-remove-row {
            color: #94a3b8;
            cursor: pointer;
            border: none;
            background: transparent;
            font-size: 1rem;
            transition: color 0.2s;
        }

        .btn-remove-row:hover {
            color: #ef4444;
        }

        /* Button Google Form Style */
        .btn-submit-gform {
            background: #0284c7;
            color: #ffffff;
            border: none;
            padding: 12px 32px;
            border-radius: 24px;
            font-weight: 700;
            font-size: 0.95rem;
            letter-spacing: 0.3px;
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.25);
            transition: all 0.2s ease;
        }

        .btn-submit-gform:hover {
            background: #0369a1;
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(2, 132, 199, 0.35);
            color: #ffffff;
        }

        .form-footer {
            text-align: center;
            font-size: 0.78rem;
            color: #94a3b8;
            margin-top: 24px;
        }
    </style>
</head>
<body>

    <div class="form-container">

        <?php if ($isSubmitted && $submitSuccess): ?>
            <!-- =============================================================== -->
            <!-- TAMPILAN SUKSES SETELAH KIRIM FORMULIR                          -->
            <!-- =============================================================== -->
            <div class="gform-card gform-header-card text-center py-5">
                <img src="https://www.pascalibration.com/wp-content/uploads/2023/09/logo_pas_basic.png" alt="PAS Logo" class="header-logo mx-auto">
                <div class="my-3 text-success fs-1">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h2 class="form-title">Pendaftaran Berhasil Terkirim</h2>
                <p class="text-secondary small mb-4" style="max-width: 540px; margin: 0 auto; line-height: 1.6;">
                    <?php echo htmlspecialchars($submitMessage); ?>
                </p>
                <div class="d-flex justify-content-center gap-2 mt-3 flex-wrap">
                    <a href="https://pascalibration.com/formRegister" class="btn btn-outline-secondary rounded-pill px-4 btn-sm">
                        <i class="fas fa-redo me-1"></i> Kirim Tanggapan Lain
                    </a>
                    <a href="https://pascalibration.com/portal-sertifikat" class="btn btn-primary rounded-pill px-4 btn-sm">
                        <i class="fas fa-search me-1"></i> Buka Portal Cari Sertifikat
                    </a>
                </div>
            </div>

        <?php else: ?>

            <!-- =============================================================== -->
            <!-- HEADER CARD FORMULIR                                            -->
            <!-- =============================================================== -->
            <div class="gform-card gform-header-card">
                <img src="https://www.pascalibration.com/wp-content/uploads/2023/09/logo_pas_basic.png" alt="PAS Logo" class="header-logo">
                <h1 class="form-title">Formulir Pendaftaran Akses Sertifikat Digital</h1>
                <p class="form-desc">
                    Silakan lengkapi formulir pendaftaran ini untuk mengajukan hak akses berkas sertifikat kalibrasi digital resmi perusahaan Anda di portal <strong>PT Pananjung Anugrah Solution</strong>.
                </p>
                <div class="border-top pt-3 d-flex justify-content-between align-items-center">
                    <span class="required-notice">* Menunjukkan pertanyaan yang wajib diisi</span>
                </div>
            </div>

            <?php if (!empty($submitMessage) && !$submitSuccess): ?>
                <div class="alert alert-danger rounded-3 shadow-sm border-0 d-flex align-items-center gap-2 mb-3">
                    <i class="fas fa-exclamation-triangle fs-5"></i>
                    <div><?php echo htmlspecialchars($submitMessage); ?></div>
                </div>
            <?php endif; ?>

            <form method="POST" action="" id="registrationForm">

                <!-- =============================================================== -->
                <!-- CARD 1: IDENTITAS PEMOHON & PERUSAHAAN                          -->
                <!-- =============================================================== -->
                <div class="gform-card">
                    <div class="question-title">Nama Pengguna (PIC / Penanggung Jawab) <span class="required-notice">*</span></div>
                    <input type="text" name="nama" class="gform-input" placeholder="Nama lengkap orang yang bertanggung jawab mengelola sertifikat perusahaan." value="<?php echo htmlspecialchars($_POST['nama'] ?? ''); ?>" required>
                </div>

                <div class="gform-card">
                    <div class="question-title">Nama Perusahaan / PT <span class="required-notice">*</span></div>
                    <input type="text" name="perusahaan" class="gform-input" placeholder="Nama resmi instansi atau perusahaan (Contoh: PT. Pananjung Anugrah Solution)" value="<?php echo htmlspecialchars($_POST['perusahaan'] ?? ''); ?>" required>
                </div>

                <div class="gform-card">
                    <div class="question-title">Jabatan <span class="required-notice">*</span></div>
                    <input type="text" name="jabatan" class="gform-input" placeholder="Posisi / divisi Anda di perusahaan (contoh: QA/QC Manager, Staff Kalibrasi, Maintenance)." value="<?php echo htmlspecialchars($_POST['jabatan'] ?? ''); ?>" required>
                </div>

                <div class="gform-card">
                    <div class="question-title">Email Utama (Akun Akses Utama) <span class="required-notice">*</span></div>
                    <div class="question-desc">
                        Alamat email utama. Email ini akan memiliki hak akses penuh ke seluruh folder sertifikat perusahaan Anda.
                    </div>
                    <input type="email" name="email" class="gform-input" placeholder="contoh: nama@perusahaan.com/ nama@gmail.com" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
                </div>
                
                 <!-- =============================================================== -->
                <!-- CARD 4: INPUT EMAIL TAMBAHAN (DINAMIS MULTI-ROW)                 -->
                <!-- =============================================================== -->
                <div class="gform-card">
                    <div class="d-flex justify-content-between align-items-center mb-2 flex-wrap gap-2">
                        <div>
                            <div class="question-title mb-0">Email Tambahan (Opsional)</div>
                            <div class="question-desc mb-0">Tambahkan akun staf / personil lain yang membutuhkan akses khusus ke subfolder tertentu.</div>
                        </div>
                    </div>

                    <div id="emailTambahanContainer" class="mt-3">
                        <!-- Baris 1 Default -->
                        <div class="email-extra-row" id="rowExtra_0">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="small fw-bold text-dark"><i class="far fa-envelope text-primary me-1"></i> Email Tambahan #1</span>
                                <button type="button" class="btn-remove-row" onclick="removeEmailRow('rowExtra_0')" title="Hapus baris ini">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <div class="row g-2">
                                <div class="col-md-4">
                                    <label class="form-label small text-secondary mb-1">Nama Pemilik Akun</label>
                                    <input type="text" name="nama_tambahan[]" class="gform-input" placeholder="contoh: Budi Santoso">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small text-secondary mb-1">Alamat Email</label>
                                    <input type="email" name="email_tambahan[]" class="gform-input" placeholder="contoh: user.plant1@perusahaan.com">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small text-secondary mb-1">Catatan Akses (Subfolder / Plant / PO)</label>
                                    <input type="text" name="note_tambahan[]" class="gform-input" placeholder="contoh: Hanya akses subfolder Plant Karawang">
                                </div>
                            </div>
                        </div>

                        <!-- Baris 2 Default -->
                        <div class="email-extra-row" id="rowExtra_1">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="small fw-bold text-dark"><i class="far fa-envelope text-primary me-1"></i> Email Tambahan #2</span>
                                <button type="button" class="btn-remove-row" onclick="removeEmailRow('rowExtra_1')" title="Hapus baris ini">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <div class="row g-2">
                                <div class="col-md-4">
                                    <label class="form-label small text-secondary mb-1">Nama Pemilik Akun</label>
                                    <input type="text" name="nama_tambahan[]" class="gform-input" placeholder="contoh: Siti Aminah">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small text-secondary mb-1">Alamat Email</label>
                                    <input type="email" name="email_tambahan[]" class="gform-input" placeholder="contoh: user.plant2@perusahaan.com">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small text-secondary mb-1">Catatan Akses (Subfolder / Plant / PO)</label>
                                    <input type="text" name="note_tambahan[]" class="gform-input" placeholder="contoh: Hanya akses subfolder Plant Cikarang">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-2 text-end">
                        <button type="button" class="btn btn-link btn-sm text-decoration-none text-primary fw-semibold p-0" onclick="addNewEmailRow()">
                            <i class="fas fa-plus-circle me-1"></i> Tambah email tambahan lainnya
                        </button>
                    </div>
                </div>

                <!-- =============================================================== -->
                <!-- CARD 2: PILIHAN MODEL AKSES (RADIO BUTTON & VISUAL)              -->
                <!-- =============================================================== -->
                <div class="gform-card">
                    <div class="question-title">Pilihan Model Akses Folder <span class="required-notice">*</span></div>
                    <div class="question-desc">Pilih struktur penataan berkas sertifikat yang paling sesuai dengan kebutuhan organisasi perusahaan Anda:</div>

                    <?php $selectedModel = $_POST['model_akses'] ?? 'MODEL A'; ?>

                    <!-- OPSI A -->
                    <label class="model-option-card <?php echo $selectedModel === 'MODEL A' ? 'active' : ''; ?>" onclick="selectModelCard(this, 'MODEL A')">
                        <input type="radio" name="model_akses" value="MODEL A" <?php echo $selectedModel === 'MODEL A' ? 'checked' : ''; ?> required>
                        <div>
                            <div class="fw-bold text-dark">A. MODEL A (Satu folder PT, Tanpa folder tambahan)</div>
                            <small class="text-secondary">Seluruh berkas sertifikat kalibrasi berada langsung di dalam satu folder induk perusahaan.</small>
                        </div>
                    </label>

                    <!-- OPSI B -->
                    <label class="model-option-card <?php echo $selectedModel === 'MODEL B' ? 'active' : ''; ?>" onclick="selectModelCard(this, 'MODEL B')">
                        <input type="radio" name="model_akses" value="MODEL B" <?php echo $selectedModel === 'MODEL B' ? 'checked' : ''; ?>>
                        <div>
                            <div class="fw-bold text-dark">B. MODEL B (Folder PT, dengan subfolder Lokasi Perusahaan)</div>
                            <small class="text-secondary">Folder induk perusahaan dibagi ke beberapa subfolder cabang / plant (contoh: Plant Karawang, Plant Cikarang, Plant Surabaya).</small>
                        </div>
                    </label>

                    <!-- OPSI C -->
                    <label class="model-option-card <?php echo $selectedModel === 'MODEL C' ? 'active' : ''; ?>" onclick="selectModelCard(this, 'MODEL C')">
                        <input type="radio" name="model_akses" value="MODEL C" <?php echo $selectedModel === 'MODEL C' ? 'checked' : ''; ?>>
                        <div>
                            <div class="fw-bold text-dark">C. MODEL C (Folder PT, dengan subfolder # PO)</div>
                            <small class="text-secondary">Folder induk perusahaan dikelompokkan berdasarkan nomor Purchase Order (contoh: PO-2024-001, PO-2024-002).</small>
                        </div>
                    </label>

                    <!-- CONTOH VISUAL GAMBAR / DIAGRAM STRUKTUR FOLDER -->
                    <div class="visual-diagram-card mt-3">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="small fw-bold text-dark"><i class="fas fa-sitemap text-primary me-1"></i> Contoh Visual Struktur Folder:</span>
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle small" id="currentModelBadge">Model A Terpilih</span>
                        </div>

                        <!-- VISUAL MODEL A -->
                        <div id="visualModelA" class="model-visual-preview" style="<?php echo $selectedModel === 'MODEL A' ? '' : 'display:none;'; ?>">
                            <div class="tree-node level-0"><i class="fas fa-folder text-warning"></i> [Folder PT Anda] <span class="tree-badge">Folder Induk (Akses Email Utama)</span></div>
                            <div class="tree-node level-1"><i class="far fa-file-pdf text-danger"></i> Sertifikat_PAS-001.pdf</div>
                            <div class="tree-node level-1"><i class="far fa-file-pdf text-danger"></i> Sertifikat_PAS-002.pdf</div>
                            <div class="tree-node level-1"><i class="far fa-file-pdf text-danger"></i> Sertifikat_PAS-003.pdf</div>
                            <small class="text-muted d-block mt-2">*Semua berkas tersimpan langsung di dalam 1 folder tanpa subfolder.</small>
                        </div>

                        <!-- VISUAL MODEL B -->
                        <div id="visualModelB" class="model-visual-preview" style="<?php echo $selectedModel === 'MODEL B' ? '' : 'display:none;'; ?>">
                            <div class="tree-node level-0"><i class="fas fa-folder text-warning"></i> [Folder PT Anda] <span class="tree-badge">Folder Induk (Akses Email Utama)</span></div>
                            <div class="tree-node level-1"><i class="fas fa-folder-open text-primary"></i> Subfolder: Plant Cikarang <span class="tree-badge">(Akses Email Tambahan)</span></div>
                            <div class="tree-node level-2"><i class="far fa-file-pdf text-danger"></i> Sertifikat_Cikarang_001.pdf</div>
                            <div class="tree-node level-1"><i class="fas fa-folder-open text-primary"></i> Subfolder: Plant Karawang<span class="tree-badge">(Akses Email Tambahan)</span></div>
                            <div class="tree-node level-2"><i class="far fa-file-pdf text-danger"></i> Sertifikat_Karawang_001.pdf</div>
                            <small class="text-muted d-block mt-2">*Berkas dikelompokkan per lokasi/pabrik cabang perusahaan.</small>
                        </div>

                        <!-- VISUAL MODEL C -->
                        <div id="visualModelC" class="model-visual-preview" style="<?php echo $selectedModel === 'MODEL C' ? '' : 'display:none;'; ?>">
                            <div class="tree-node level-0"><i class="fas fa-folder text-warning"></i> [Folder PT Anda] <span class="tree-badge">Folder Induk (Akses Email Utama)</span></div>
                            <div class="tree-node level-1"><i class="fas fa-folder-open text-success"></i> Subfolder: PO-2024-001<span class="tree-badge">(Akses Email Tambahan)</span></div>
                            <div class="tree-node level-2"><i class="far fa-file-pdf text-danger"></i> Sertifikat_PAS-PO001.pdf</div>
                            <div class="tree-node level-1"><i class="fas fa-folder-open text-success"></i> Subfolder: PO-2024-002<span class="tree-badge">(Akses Email Tambahan)</span></div>
                            <div class="tree-node level-2"><i class="far fa-file-pdf text-danger"></i> Sertifikat_PAS-PO002.pdf</div>
                            <small class="text-muted d-block mt-2">*Berkas dikelompokkan sesuai nomor Purchase Order masing-masing proyek.</small>
                        </div>
                    </div>
                </div>

                <!-- =============================================================== -->
                <!-- CARD 3: PETUNJUK SKENARIO AKSES & PERBEDAAN EMAIL GMAIL/NON-GMAIL-->
                <!-- =============================================================== -->
                <div class="gform-card">
                    <div class="question-title"><i class="fas fa-info-circle text-primary me-1"></i> Ketentuan Akses & Contoh Pengisian Email Tambahan</div>
                    <div class="question-desc">
                        Setiap email yang didaftarkan dapat digunakan untuk mengakses folder Perusahaan masing-masing. Email yang didaftarkan hanya bisa mengakses sertifikat di dalam folder dan subfolder di bawahnya.
                    </div>

                    <div class="small fw-bold text-dark mb-2">Permintaan pembagian folder masing-masing perusahaan adalah sebagai berikut:</div>

                    <!-- SKENARIO 1 -->
                    <div class="scenario-box">
                        <div class="scenario-title"><i class="fas fa-check-circle text-success me-1"></i> Skenario 1 (Akses Tunggal Penuh)</div>
                        <div><strong>utama@gmail.com</strong> : dapat mengakses seluruh sertifikat.</div>
                        <div class="text-secondary small">Email tambahan: <em>dikosongkan</em>.</div>
                    </div>

                    <!-- SKENARIO 2 -->
                    <div class="scenario-box">
                        <div class="scenario-title"><i class="fas fa-check-circle text-success me-1"></i> Skenario 2 (Akses Subfolder Tertentu)</div>
                        <div><strong>utama@gmail.com</strong> : dapat mengakses seluruh sertifikat dan subfolder (contoh: &gt;&gt;Cikarang dan &gt;&gt;Karawang).</div>
                        <div><strong>contoh@gmail.com</strong> : hanya dapat mengakses sertifikat di dalam/di bawahnya (contoh: &gt;&gt;Karawang).</div>
                        <div class="text-primary small mt-1">
                            <i class="fas fa-arrow-right me-1"></i> Pada email tambahan, isi dengan format: <code>contoh@gmail.com;Karawang;</code>
                        </div>
                    </div>

                    <!-- SKENARIO 3 -->
                    <div class="scenario-box">
                        <div class="scenario-title"><i class="fas fa-check-circle text-success me-1"></i> Skenario 3 (Banyak Email Tambahan & Multi Plant)</div>
                        <div><strong>utama@gmail.com</strong> : dapat mengakses seluruh sertifikat dan seluruh subfolder.</div>
                        <div><strong>contoh1@gmail.com</strong> : hanya dapat mengakses sertifikat di &gt;&gt;Plant Karawang dan &gt;&gt;Plant Tangerang.</div>
                        <div><strong>contoh2@gmail.com</strong> : hanya dapat mengakses sertifikat di &gt;&gt;Plant Cikarang dan &gt;&gt;Plant Tangerang.</div>
                        <div class="text-primary small mt-1">
                            <i class="fas fa-arrow-right me-1"></i> Pada email tambahan, isi dengan format: <code>contoh1@gmail.com;Karawang; contoh1@gmail.com;Tangerang; contoh2@gmail.com;Cikarang; contoh2@gmail.com;Tangerang;</code>
                        </div>
                    </div>
                </div>

               

                <!-- =============================================================== -->
                <!-- SUBMIT ACTION BUTTON & HOTLINE                                  -->
                <!-- =============================================================== -->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-stretch align-items-md-center gap-3 mt-4">
                    <button type="submit" class="btn-submit-gform m-0">
                        <i class="fas fa-paper-plane me-2"></i> Kirim Formulir Pendaftaran
                    </button>
                    <a href="https://wa.me/628567770150?text=Halo%20Admin%20PT%20PAS,%20saya%20ingin%20bertanya%20mengenai%20pendaftaran%20akses%20sertifikat%20digital." target="_blank" class="btn btn-outline-success rounded-pill px-4 py-2 fw-semibold text-center small text-decoration-none">
                        <i class="fab fa-whatsapp me-1"></i> Tanya Admin via WhatsApp
                    </a>
                </div>

            </form>

            <div class="form-footer">
                Formulir ini dibuat resmi oleh <strong>PT Pananjung Anugrah Solution</strong>.<br>
                Informasi Anda dilindungi secara rahasia untuk keperluan autentikasi sertifikat kalibrasi.
            </div>

        <?php endif; ?>

    </div>

    <!-- SCRIPTS -->
    <script>
        let rowCounter = 2;

        function selectModelCard(cardElement, modelValue) {
            document.querySelectorAll('.model-option-card').forEach(c => c.classList.remove('active'));
            cardElement.classList.add('active');

            const radio = cardElement.querySelector('input[type="radio"]');
            if (radio) radio.checked = true;

            // Update badge dan visual diagram preview
            const badge = document.getElementById('currentModelBadge');
            const visA = document.getElementById('visualModelA');
            const visB = document.getElementById('visualModelB');
            const visC = document.getElementById('visualModelC');

            if (badge) badge.textContent = modelValue + ' Terpilih';

            if (visA) visA.style.display = (modelValue === 'MODEL A') ? 'block' : 'none';
            if (visB) visB.style.display = (modelValue === 'MODEL B') ? 'block' : 'none';
            if (visC) visC.style.display = (modelValue === 'MODEL C') ? 'block' : 'none';
        }

        function addNewEmailRow() {
            rowCounter++;
            const container = document.getElementById('emailTambahanContainer');
            const rowId = 'rowExtra_' + Date.now();

            const div = document.createElement('div');
            div.className = 'email-extra-row';
            div.id = rowId;
            div.innerHTML = `
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="small fw-bold text-dark"><i class="far fa-envelope text-primary me-1"></i> Email Tambahan #${rowCounter}</span>
                    <button type="button" class="btn-remove-row" onclick="removeEmailRow('${rowId}')" title="Hapus baris ini">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="row g-2">
                    <div class="col-md-4">
                        <label class="form-label small text-secondary mb-1">Nama Pemilik Akun</label>
                        <input type="text" name="nama_tambahan[]" class="gform-input" placeholder="contoh: Nama Pegawai">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small text-secondary mb-1">Alamat Email</label>
                        <input type="email" name="email_tambahan[]" class="gform-input" placeholder="contoh: user@perusahaan.com">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small text-secondary mb-1">Catatan Akses (Subfolder / Plant / PO)</label>
                        <input type="text" name="note_tambahan[]" class="gform-input" placeholder="contoh: Hanya akses subfolder tertentu">
                    </div>
                </div>
            `;
            container.appendChild(div);
        }

        function removeEmailRow(rowId) {
            const row = document.getElementById(rowId);
            if (row) {
                row.remove();
            }
        }
    </script>
</body>
</html>
