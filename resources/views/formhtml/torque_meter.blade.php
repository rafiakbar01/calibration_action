<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Kalibrasi - PT. PANANJUNG ANUGRAH SOLUTION</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Pastikan semua text berwarna hitam */
        .form-kalibrasi-container,
        .form-kalibrasi-container *:not(input):not(select):not(textarea):not(button) {
            color: #000000 !important;
        }
        
        /* Input fields tetap dengan warna default mereka */
        .kalibrasi-input {
            color: #000000 !important;
            border: 1px solid #ced4da !important;
            padding: 6px 10px;
            border-radius: 4px;
            width: 100%;
        }
        
        /* Placeholder text */
        .kalibrasi-input::placeholder {
            color: #666666 !important;
        }

        /* Styling khusus untuk input suhu dan RH */
        .kondisi-input {
            border: 1px solid #000 !important;
            text-align: center;
            width: 100%;
            padding: 4px;
        }

        /* Header styling */
        .kalibrasi-header-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .kalibrasi-header-table td {
            padding: 5px;
            vertical-align: top;
        }

        /* Main form styling */
        .kalibrasi-main-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .kalibrasi-main-table td {
            padding: 8px;
            vertical-align: middle;
        }

        /* Data kalibrasi table styling */
        .kalibrasi-data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .kalibrasi-data-table td {
            padding: 0;
            border: 2px solid #000;
            text-align: center;
            vertical-align: middle;
        }

        .kalibrasi-data-table input {
            border: none;
            width: 100%;
            height: 100%;
            text-align: center;
            font-size: 10pt;
            color: #000;
            padding: 2px;
            background: transparent;
        }

        /* Section headers */
        .kalibrasi-section-header {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 15px;
            text-align: center;
            padding-bottom: 5px;
            border-bottom: 2px solid #000;
        }

        .data-kalibrasi-header {
            font-weight: bold;
            font-size: 18px;
            margin: 25px 0 15px;
            text-align: center;
            padding: 8px;
            background-color: #f0f0f0;
            border: 1px solid #000;
        }

        /* Submit Button Styling */
        .btn-primary {
            background: linear-gradient(135deg, #3b82f6, #1e40af);
            border: none;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
            background: linear-gradient(135deg, #1e40af, #1e3a8a);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #6b7280, #4b5563);
            border: none;
            box-shadow: 0 4px 15px rgba(107, 114, 128, 0.3);
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(107, 114, 128, 0.4);
            background: linear-gradient(135deg, #4b5563, #374151);
        }

        /* Form validation styling */
        input:required:invalid {
            border-color: #dc3545 !important;
        }

        input:required:valid {
            border-color: #198754 !important;
        }
    </style>
    <style>
        /* ── Standar Picker Widget ── */
        .sp-wrapper {
            position: relative;
            width: 100%;
            min-height: 34px;
            background: transparent;
            box-sizing: border-box;
            cursor: pointer;
        }
        .sp-display {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 3px;
            padding: 4px 6px;
            min-height: 34px;
            width: 100%;
            box-sizing: border-box;
        }
        .sp-placeholder {
            color: #aaa;
            font-size: 11px;
            font-style: italic;
            user-select: none;
        }
        .sp-chip {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: #e0f2fe; /* Background biru muda cerah */
            color: #0369a1; /* Teks biru cerah */
            border: 1px solid #bae6fd; /* Border tipis biru muda */
            border-radius: 6px;
            padding: 2px 6px;
            font-size: 11px;
            font-weight: 600;
            white-space: nowrap;
            user-select: none;
        }
        .sp-chip .sp-remove {
            cursor: pointer;
            font-size: 12px;
            line-height: 1;
            color: #ef4444; /* Warna merah cerah untuk tombol hapus agar terlihat jelas */
            font-weight: bold;
            margin-left: 2px;
        }
        .sp-chip .sp-remove:hover { color: #b91c1c; }
        .sp-dropdown {
            display: none;
            position: fixed;
            z-index: 99999;
            background: #fff;
            border: 2px solid #1e40af;
            border-radius: 10px;
            box-shadow: 0 8px 32px rgba(30,64,175,0.18);
            min-width: 220px;
            max-height: 340px;
            overflow-y: auto;
            padding: 6px 0;
            font-family: 'Inter', sans-serif;
        }
        .sp-dropdown.open { display: block; }
        .sp-search {
            width: calc(100% - 16px);
            margin: 6px 8px;
            padding: 5px 10px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 12px;
            box-sizing: border-box;
            outline: none;
        }
        .sp-search:focus { border-color: #1e40af; }
        .sp-group-label {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6b7280;
            padding: 6px 12px 2px;
        }
        .sp-option {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 5px 12px;
            font-size: 12px;
            cursor: pointer;
            transition: background 0.12s;
            color: #1f2937;
        }
        .sp-option:hover { background: #eff6ff; }
        .sp-option.selected { background: #dbeafe; font-weight: 600; color: #1e40af; }
        .sp-option .sp-check {
            width: 14px;
            height: 14px;
            border: 1.5px solid #d1d5db;
            border-radius: 3px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 9px;
            flex-shrink: 0;
            background: #fff;
        }
        .sp-option.selected .sp-check {
            background: #1e40af;
            border-color: #1e40af;
            color: #fff;
        }
        .sp-divider { border: none; border-top: 1px solid #f3f4f6; margin: 4px 0; }
        .sp-count-badge {
            display: inline-block;
            background: #1e40af;
            color: #fff;
            border-radius: 8px;
            font-size: 10px;
            font-weight: 700;
            padding: 0px 5px;
            margin-left: 4px;
            vertical-align: middle;
        }
    </style>
    <style>
    /* Tombol Copy Standar Picker */
    .copy-standar-btn {
        transition: all 0.2s ease;
        border-color: #3b82f6;
        color: #3b82f6;
        background-color: white;
        font-weight: bold;
    }
    
    .copy-standar-btn:hover {
        background-color: #3b82f6;
        color: white;
        transform: scale(1.1);
        box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
    }
    
    .copy-standar-btn:active {
        transform: scale(0.95);
    }
    
    /* Animasi flash hijau saat copy berhasil */
    @keyframes flashGreen {
        0%, 100% { background-color: transparent; }
        50% { background-color: #d4edda; }
    }
    
    .copy-success-flash {
        animation: flashGreen 0.6s ease;
    }
    
    /* Toast notification animation */
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
</style>

</head>
<body>
    <div class="container my-4">
        <!-- resources/views/formhtml/torque_wrench.blade.php -->
        <form method="POST" action="/calibrations" id="kalibrasiForm">
        @csrf
        <input type="hidden" name="form_type" value="torque_meter">
            <div class="form-kalibrasi-container">
                <table class="kalibrasi-header-table">
                    <tr>
                        <td colspan="2">
                            <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK13B</p>
                        </td>
                        <td rowspan="5" style="text-align: center; vertical-align: middle; padding: 10px 0;">
                          <div style="display: inline-block; text-align: center;">
                              <div style="margin-bottom: 15px;">
                                  <!-- Logo PT. PANANJUNG ANUGRAH SOLUTION -->
                                  <img src="/logo/logo_pas_basic.png" alt="Logo PT. PAS" style="width: 107px; height: 54px; display: block; margin: 0 auto;">
                              </div>
                              <p style="font-weight: bold; margin: 0; font-size: 15px; color: #000000;">PT. PANANJUNG ANUGRAH SOLUTION</p>
                          </div>
                      </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p style="margin: 0; font-size: 14px; color: #000000;">LEMBAR KERJA KALIBRASI</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">TORQUE TESTER - METER</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="height: 10px;"></td>
                    </tr>
                    <tr>
                        <td style="width: 25%;">
                            <p style="margin: 0; font-size: 14px; color: #000000;">No. Sertifikat</p>
                        </td>
                        <td style="width: 45%;">
                            <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;">PAS - </p>
                        </td>
                    </tr>
                </table>

                <!-- Main Form Section -->
                <table class="kalibrasi-main-table">
                    <!-- Nama Alat -->
                    <tr>
                           <td style="width: 20%;">
                                <p style="margin: 0; color: #000000;">Nama Alat</p>
                            </td>
                            <td colspan="3">
                                <!-- Hidden input untuk form type -->
                              
                                
                                <select name="nama_alat" id="nama_alat_select" class="kalibrasi-input" onchange="updateFormType(this.value)" required style="background-color: #f5f5f5; color: #333; border: 1px solid #ced4da; padding: 6px 10px; border-radius: 4px; width: 100%;">
                                    <option value="">-- Pilih Alat --</option>
                                    <option value="Torque Meter">Torque Meter</option>
                                    <option value="Torque Tester">Torque Tester</option>
                                    <option value="MANUAL_INPUT">-- Input Manual Nama Alat --</option>
                                </select>
                                
                                <!-- Input Manual - HIDANG AWALNYA -->
                                <div id="manualInputContainer" style="display: none; margin-top: 10px;">
                                    <input type="text" name="nama_alat_manual" id="nama_alat_manual"
                                           placeholder="Ketik nama alat secara manual"
                                           style="background-color: #f5f5f5; color: #333; border: 1px solid #ced4da; padding: 6px 10px; border-radius: 4px; width: 100%;"
                                           oninput="syncNamaAlat()">
                                </div>
                                
                                <!-- Hidden input untuk menyimpan nama alat final -->
                                <input type="hidden" name="nama_alat_final" id="nama_alat_final" value="">
                                
                                <!-- Hidden input untuk display (opsional) -->
                                <input type="hidden" name="nama_alat_display" id="nama_alat_display" value="">
                            </td>
                        </tr>

                    <!-- Merek & Kode Alat -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Merek</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" name="merek" class="kalibrasi-input me-3" placeholder="Masukkan merek alat" style="width: 60%;" required>
                                <span class="me-3" style="color: #000000;">Kode Alat :</span>
                                <input type="text" name="kode_alat" class="kalibrasi-input" placeholder="Masukkan kode" style="width: 30%;" required>
                            </div>
                        </td>
                    </tr>

                    <!-- Type / No. Seri -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Type / No. Seri</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" name="type_alat" class="kalibrasi-input me-3" placeholder="Masukkan Type" style="width: 45%;" required>
                                <span class="me-3" style="color: #000000;">/</span>
                                <input type="text" name="no_seri" class="kalibrasi-input" placeholder="Masukkan No. Seri" style="width: 45%;" required>
                            </div>
                        </td>
                    </tr>

                    <!-- Kapasitas / Resolusi -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Kapasitas / Resolusi</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" name="kapasitas" class="kalibrasi-input me-3" placeholder="Masukkan kapasitas" style="width: 45%;" required>
                                <span class="me-3" style="color: #000000;">/</span>
                                <input type="text" name="resolusi" class="kalibrasi-input" placeholder="Masukkan Resolusi" style="width: 45%;" required>
                            </div>
                        </td>
                    </tr>

                    <!-- Nama Pemilik -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Nama Pemilik</p>
                        </td>
                        <td colspan="3">
                            <input type="text" name="nama_pemilik" class="kalibrasi-input" placeholder="Masukkan nama pemilik / instansi" required>
                        </td>
                    </tr>

                    <!-- Tanggal Alat Masuk & Kalibrasi -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Tanggal Alat Masuk</p>
                        </td>
                        <td colspan="3">
                            <input type="date" name="tanggal_alat_masuk" class="kalibrasi-input" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Tanggal Kalibrasi</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <!-- Tanggal Kalibrasi -->
                                <input type="date" name="tanggal_kalibrasi" class="kalibrasi-input me-3" style="width: 45%;" required>
                                
                                <span class="me-3" style="color: #000000;">Jenis Pembacaan:</span>
                                
                                <!-- Dropdown Jenis Pembacaan -->
                                <select name="jenis_pembacaan" class="kalibrasi-input" style="width: 45%;" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="manual">Manual</option>
                                    <option value="digital">Digital</option>
                                </select>
                            </div>
                        </td>
                    </tr>

                    <!-- Tempat Kalibrasi -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Tempat Kalibrasi</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex">
                                <div class="form-check me-5">
                                    <input class="form-check-input" type="radio" name="tempat_kalibrasi" value="lab.PT PAS" id="lab" required>
                                    <label class="form-check-label" for="lab" style="color: #000000;">Lab. PT.PAS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tempat_kalibrasi" value="insitu" id="insitu" required>
                                    <label class="form-check-label" for="insitu" style="color: #000000;">Insitu</label>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Lokasi PT</p>
                        </td>
                        <td colspan="3">
                            <input type="text" name="lokasi_pt" class="kalibrasi-input" placeholder="Masukkan Lokasi PT" >
                        </td>
                    </tr>
                    
                       <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Kode TH</p>
                        </td>
                        <td colspan="3">
                            <input type="text" name="kode_th" class="kalibrasi-input" placeholder="Masukkan Kode TH" >
                        </td>
                    </tr>
                </table>

                <!-- Fungsi Komponen Lainnya & Kondisi Kalibrasi -->
                <div class="row mt-4">
                    <!-- Fungsi Komponen Lainnya -->
                    <div class="col-md-6 mb-4">
                        <div class="kalibrasi-section-header" style="color: #000000;">Fungsi Komponen Lainnya</div>
                        
                        <div class="d-flex justify-content-around align-items-center my-4">
                            <div class="text-center">
                                <span class="fw-bold d-block" style="color: #000000;">Ok</span>
                                <input type="radio" name="fungsi_komponen" value="ok" style="transform: scale(1.5); margin: 10px 0;" required>
                            </div>
                            <div class="text-center">
                                <span class="fw-bold d-block" style="color: #000000;">Rusak</span>
                                <input type="radio" name="fungsi_komponen" value="rusak" style="transform: scale(1.5); margin: 10px 0;" required>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center mt-4">
                            <span class="fw-bold me-3" style="color: #000000;">Keterangan :</span>
                            <div style="flex: 1; border-bottom: 2px solid #000;">
                                <input type="text" name="keterangan_fungsi_komponen" class="kalibrasi-input" placeholder="Masukkan Keterangan" style="border: none;">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Kondisi Kalibrasi -->
                        <div class="col-md-6 mb-4">
                            <div class="kalibrasi-section-header" style="color: #000000;">Kondisi Kalibrasi</div>
                            
                            <table class="table table-bordered">
                                <tr>
                                    <td class="table-secondary fw-bold" style="width: 30%; color: #000000;"></td>
                                    <td class="table-secondary fw-bold text-center" style="color: #000000;">Awal</td>
                                    <td class="table-secondary fw-bold text-center" style="color: #000000;">Tengah</td>
                                    <td class="table-secondary fw-bold text-center" style="color: #000000;">Akhir</td>
                                </tr>
                              <tr>
                                    <td class="bg-light fw-bold" style="color: #000000;">Suhu (°C)</td>
                                    <td><input type="text" name="suhu_awal" class="kondisi-input" required></td>
                                    <td><input type="text" name="suhu_tengah" class="kondisi-input" required></td>
                                    <td><input type="text" name="suhu_akhir" class="kondisi-input" required></td>
                                </tr>
                                <tr>
                                    <td class="bg-light fw-bold" style="color: #000000;">RH (%)</td>
                                    <td><input type="text" name="rh_awal" class="kondisi-input" required></td>
                                    <td><input type="text" name="rh_tengah" class="kondisi-input" required></td>
                                    <td><input type="text" name="rh_akhir" class="kondisi-input" required></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                <!-- Data Kalibrasi Section -->
                <div class="data-kalibrasi-header" style="color: #000000;">DATA KALIBRASI</div>
                            <!-- Bagian Radius dengan Inputan Sederhana -->
                    <!-- Bagian Radius dengan jarak lebih rapi & lega -->
                    <div style="margin-bottom: 18px; font-family: Arial, sans-serif;">
                        <table style="border-collapse: collapse; display: inline-table;">
                            <tr>
                                <!-- Huruf r -->
                                <td style="padding-right: 18px; vertical-align: middle; text-align: right;">
                                    <span style="font-size: 13pt; font-weight: bold;">r</span>
                                </td>

                                <!-- Input nilai radius -->
                                <td style="padding-right: 12px; vertical-align: middle;">
                                    <input type="text" 
                                        id="radius_value" 
                                        name="radius_value" 
                                        style="width: 100px; padding: 6px 8px; font-size: 12pt; border: 1px solid #999; border-radius: 4px; text-align: center;"
                                        placeholder="">
                                </td>

                                <!-- Tanda kurung buka dengan jarak -->
                                <td style="padding-right: 8px; vertical-align: middle;">
                                    <span style="font-size: 12pt; color: #555;">(</span>
                                </td>

                                <!-- Input satuan -->
                                <td style="padding-right: 8px; vertical-align: middle;">
                                    <input type="text" 
                                        id="radius_unit" 
                                        name="radius_unit" 
                                        style="width: 90px; padding: 6px 8px; font-size: 12pt; border: 1px solid #999; border-radius: 4px; text-align: center;"
                                        placeholder="">
                                </td>

                                <!-- Tanda kurung tutup -->
                                <td style="vertical-align: middle;">
                                    <span style="font-size: 12pt; color: #555;">)</span>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- Tabel Utama -->
                    <table cellspacing="0" cellpadding="0" class="TableNormal" style="margin-left:0.6pt; border:1pt solid #000000; border-collapse:collapse; width:100%; max-width:1500px;">
    
    <!-- Header Tabel - Baris 1 -->
    <tr style="height:14pt">
        <td colspan="2" style="width:128px; border:1pt solid #000000; vertical-align:middle; text-align:center">
            <p style="margin:0; font-size:10pt;"><strong>Beban Anak Timbang</strong></p>
        </td>
        <td colspan="2" rowspan="2" style="width:172px; border:1pt solid #000000; vertical-align:middle; text-align:center">
            <p style="margin:0; font-size:10pt;"><strong>Kode Anak timbangan yang digunakan</strong></p>
        </td>
        <td colspan="6" style="border:1pt solid #000000; vertical-align:middle; text-align:center">
            <p style="margin:0; font-size:10pt;"><strong>Penunjukan Standard</strong></p>
        </td>
    </tr>
    
    <!-- Header Tabel - Baris 2 -->
    <tr style="height:13pt">
        <td colspan="2" style="border:1pt solid #000000; vertical-align:middle; text-align:center">
            <!-- Empty cell - bagian dari rowspan di atas -->
        </td>
        <td colspan="3" style="border:1pt solid #000000; vertical-align:middle; text-align:center">
            <p style="margin:0; font-size:10pt; line-height:1.15">
                <strong>Clockwise (</strong>
                <input type="text"
                    name="satuan_cw"
                    value="{{ old('satuan_cw', $calibration->headTorqueWrench->satuan_cw ?? '') }}"
                    style="
                        width:120px;
                        border:none;
                        outline:none;
                        background:transparent;
                        font-size:10pt;
                        letter-spacing:normal;
                        text-align:center;
                        padding:0;
                        margin:0;
                    "
                    placeholder="..........">
                <strong>)</strong>
            </p>
        </td>
        <td colspan="3" style="border:1pt solid #000000; vertical-align:middle; text-align:center">
            <p style="margin:0; font-size:10pt; line-height:1.15">
                <strong>Counter Clockwise (</strong>
                <input type="text"
                    name="satuan_ccw"
                    value="{{ old('satuan_ccw', $calibration->headTorqueWrench->satuan_ccw ?? '') }}"
                    style="
                        width:120px;
                        border:none;
                        outline:none;
                        background:transparent;
                        font-size:10pt;
                        letter-spacing:normal;
                        text-align:center;
                        padding:0;
                        margin:0;
                    "
                    placeholder=".........">
                <strong>)</strong>
            </p>
        </td>
    </tr>
    
    <!-- Sub-header -->
    <tr style="height:14pt">
        <td colspan="2" style="border:1pt solid #000000; vertical-align:middle; text-align:center">
            <p style="margin:0; font-size:8.5pt;">
                (
                <input type="text"
                    name="satuan_titikUkur"
                    value="{{ old('satuan_titikUkur', $calibration->headTorqueWrench->satuan_titikUkur ?? '') }}"
                    style="
                        border:none;
                        outline:none;
                        background:transparent;
                        width:120px;
                        font-size:10pt;
                        letter-spacing:normal;
                        text-align:center;
                        padding:0;
                        margin:0;
                    "
                    placeholder="............"> )
               
            </p>
        </td>
        <td colspan="2" style="border:1pt solid #000000; vertical-align:middle; text-align:center">
            <!-- Empty cell - satuan untuk Kode Anak Timbang -->
        </td>
        <td style="border:1pt solid #000000; text-align:center">
            <p style="margin:0; font-size:10pt;"><strong>1</strong></p>
        </td>
        <td style="border:1pt solid #000000; text-align:center">
            <p style="margin:0; font-size:10pt;"><strong>2</strong></p>
        </td>
        <td style="border:1pt solid #000000; text-align:center">
            <p style="margin:0; font-size:10pt;"><strong>3</strong></p>
        </td>
        <td style="border:1pt solid #000000; text-align:center">
            <p style="margin:0; font-size:10pt;"><strong>1</strong></p>
        </td>
        <td style="border:1pt solid #000000; text-align:center">
            <p style="margin:0; font-size:10pt;"><strong>2</strong></p>
        </td>
        <td style="border:1pt solid #000000; text-align:center">
            <p style="margin:0; font-size:10pt;"><strong>3</strong></p>
        </td>
    </tr>
    
    <!-- Baris Input 1 sampai 13 -->
    @for($i = 1; $i <= 13; $i++)
        @php
            // Cari data untuk baris ini
            $detail = isset($calibration) && $calibration->detailTorqueWrenchs && $calibration->detailTorqueWrenchs->count() > 0 
                ? ($calibration->detailTorqueWrenchs->get($i-1) ?? null) 
                : null;
            
            // Tentukan nama input yang konsisten
            $inputName = "detail[" . ($i-1) . "]";
        @endphp
        
        <tr style="height:14pt">
            <!-- Beban Anak Timbang — HANYA ANGKA (anti E/e) -->
            <td colspan="2" style="border:1pt solid #000000; vertical-align:top">
                @if($detail && $detail->id)
                    <input type="hidden" name="{{ $inputName }}[id]" value="{{ $detail->id }}">
                @endif
                <input type="hidden" name="{{ $inputName }}[row_index]" value="{{ $i-1 }}">
                <input type="text"
                     
                    
                    class="number-only"
                    style="width:100%; height:100%; border:none; padding:4px 2px; font-size:9pt; text-align:center;"
                    name="{{ $inputName }}[titikUkur]"
                    value="{{ old($inputName . '.titikUkur', $detail->titikUkur ?? '') }}"
                    >
            </td>

            <!-- Kode Anak Timbang — BISA HURUF + ANGKA -->
            <td colspan="2" style="border:1pt solid #000000; vertical-align:top; position: relative;">
                <div style="display: flex; align-items: center; gap: 4px; padding: 4px 8px;">
                    <div style="flex: 1; min-width: 0;">
                        <input type="hidden"
                               name="{{ $inputName }}[kode_anak_timbang]"
                               id="sp_hidden_{{ $i }}"
                               value="{{ old($inputName . '.kode_anak_timbang', $detail->kode_anak_timbang ?? '') }}">
                        <div class="sp-wrapper"
                             data-id="{{ $i }}"
                             data-value="{{ old($inputName . '.kode_anak_timbang', $detail->kode_anak_timbang ?? '') }}"
                             style="min-height: 28px;">
                            <div class="sp-display" id="sp_display_{{ $i }}" style="min-height: 28px; padding: 2px 4px;">
                                <span class="sp-placeholder" id="sp_ph_{{ $i }}" style="font-size: 10px;">Pilih standar...</span>
                            </div>
                            <div class="sp-dropdown" id="sp_dd_{{ $i }}">
                                <input type="text" class="sp-search" placeholder="Cari kode..." id="sp_search_{{ $i }}">
                                <div class="sp-option-list" id="sp_list_{{ $i }}"></div>
                            </div>
                        </div>
                    </div>
                    
                    @if ($i > 1)
                    <button type="button" 
                            class="btn btn-sm btn-outline-secondary" 
                            onclick="copyStandar({{ $i - 1 }}, {{ $i }})"
                            title="Copy dari baris sebelumnya"
                            style="padding: 2px 6px; font-size: 10px;">
                        <i class="fas fa-copy"></i>
                    </button>
                    @endif
                </div>
            </td>

            <!-- Clockwise 1 -->
            <td style="border:1pt solid #000000; vertical-align:top">
                <input type="text"
                    
                    class="number-only"
                    style="width:100%; height:100%; border:none; padding:4px; font-size:9pt; text-align:center;"
                    name="{{ $inputName }}[cw1]"
                    value="{{ old($inputName . '.cw1', $detail->cw1 ?? '') }}">
            </td>
            
            <!-- Clockwise 2 -->
            <td style="border:1pt solid #000000; vertical-align:top">
                <input type="text"
                    
                    class="number-only"
                    style="width:100%; height:100%; border:none; padding:4px; font-size:9pt; text-align:center;"
                    name="{{ $inputName }}[cw2]"
                    value="{{ old($inputName . '.cw2', $detail->cw2 ?? '') }}">
            </td>
            
            <!-- Clockwise 3 -->
            <td style="border:1pt solid #000000; vertical-align:top">
                <input type="text"
                    
                    class="number-only"
                    style="width:100%; height:100%; border:none; padding:4px; font-size:9pt; text-align:center;"
                    name="{{ $inputName }}[cw3]"
                    value="{{ old($inputName . '.cw3', $detail->cw3 ?? '') }}">
            </td>
            
            <!-- Counter Clockwise 1 -->
            <td style="border:1pt solid #000000; vertical-align:top">
                <input type="text"
                    
                    class="number-only"
                    style="width:100%; height:100%; border:none; padding:4px; font-size:9pt; text-align:center;"
                    name="{{ $inputName }}[ccw1]"
                    value="{{ old($inputName . '.ccw1', $detail->ccw1 ?? '') }}">
            </td>
            
            <!-- Counter Clockwise 2 -->
            <td style="border:1pt solid #000000; vertical-align:top">
                <input type="text"
                    
                    class="number-only"
                    style="width:100%; height:100%; border:none; padding:4px; font-size:9pt; text-align:center;"
                    name="{{ $inputName }}[ccw2]"
                    value="{{ old($inputName . '.ccw2', $detail->ccw2 ?? '') }}">
            </td>
            
            <!-- Counter Clockwise 3 -->
            <td style="border:1pt solid #000000; vertical-align:top">
                <input type="text"
                    
                    class="number-only"
                    style="width:100%; height:100%; border:none; padding:4px; font-size:9pt; text-align:center;"
                    name="{{ $inputName }}[ccw3]"
                    value="{{ old($inputName . '.ccw3', $detail->ccw3 ?? '') }}">
            </td>
        </tr>
    @endfor
</table>
                        
                    <!-- Repeatability Clockwise -->
                    <p class="BodyText" style="margin-top:2pt; margin-left:2pt">
                        <span style="letter-spacing:-0.1pt; font-size:9.5pt;">Repeatability Clockwise</span>
                    </p>

                    <table cellspacing="0" cellpadding="0" class="TableNormal" 
                        style="margin-left:0.6pt; border:1pt solid #000000; border-collapse:collapse; width:100%; max-width:450px;">
                        
                        <!-- Baris 1: Judul + 5 kolom angka pertama -->
                        <tr style="height:14pt">
                        
                            <?php for($i = 1; $i <= 5; $i++): ?>
                            <td style="width:45pt; border-left:1pt solid #000; <?php echo $i < 5 ? 'border-right:1pt solid #000;' : ''; ?> border-bottom:1pt solid #000; vertical-align:top">
                                <input type="text" 
                                    class="only-number"
                                    style="width:100%; height:100%; border:none; padding:2px; font-size:8.5pt; text-align:center;"
                                    name="repeat_cw_<?php echo $i; ?>">
                            </td>
                            <?php endfor; ?>
                        </tr>

                        <!-- Baris 2: Judul kedua + 5 kolom angka kedua -->
                        <tr style="height:14pt">
                        
                            <?php for($i = 6; $i <= 10; $i++): ?>
                            <td style="width:45pt; border-top:1pt solid #000; border-left:1pt solid #000; <?php echo $i < 10 ? 'border-right:1pt solid #000;' : ''; ?> vertical-align:top">
                                <input type="text"  
                                    class="only-number"
                                    style="width:100%; height:100%; border:none; padding:2px; font-size:8.5pt; text-align:center;"
                                    name="repeat_cw_<?php echo $i; ?>">
                            </td>
                            <?php endfor; ?>
                        </tr>
                    </table>


                    <!-- Repeatability Counter Clockwise -->
                    <p class="BodyText" style="margin-top:5pt; margin-left:2pt">
                        <span style="font-size:9.5pt;">Repeatability Counter Clockwise</span>
                    </p>

                    <table cellspacing="0" cellpadding="0" class="TableNormal" 
                        style="margin-left:0.6pt; border:1pt solid #000000; border-collapse:collapse; width:100%; max-width:450px;">
                        
                        <!-- Baris 1 -->
                        <tr style="height:14pt">
                        
                            <?php for($i = 1; $i <= 5; $i++): ?>
                            <td style="width:45pt; border-left:1pt solid #000; <?php echo $i < 5 ? 'border-right:1pt solid #000;' : ''; ?> border-bottom:1pt solid #000; vertical-align:top">
                                <input type="text" 
                                    class="only-number"
                                    style="width:100%; height:100%; border:none; padding:2px; font-size:8.5pt; text-align:center;"
                                    name="repeat_ccw_<?php echo $i; ?>">
                            </td>
                            <?php endfor; ?>
                        </tr>

                        <!-- Baris 2 -->
                        <tr style="height:14pt">
                            <?php for($i = 6; $i <= 10; $i++): ?>
                            <td style="width:45pt; border-top:1pt solid #000; border-left:1pt solid #000; <?php echo $i < 10 ? 'border-right:1pt solid #000;' : ''; ?> vertical-align:top">
                                <input type="text" 
                                    class="only-number"
                                    style="width:100%; height:100%; border:none; padding:2px; font-size:8.5pt; text-align:center;"
                                    name="repeat_ccw_<?php echo $i; ?>">
                            </td>
                            <?php endfor; ?>
                        </tr>
                    </table>

                                    <div style="height: 50px;"></div>


                                <!-- Footer Section -->
                                <table cellspacing="0" cellpadding="0" style="border-collapse: collapse; width: 100%; max-width: 1500px; margin-top: 20px; font-family: Arial, sans-serif; font-size: 10pt;">
                        <!-- HEADER -->
                        <tr>
                            <td colspan="4" style="border: 1pt solid #000; padding: 12px; background-color: #f0f0f0; text-align: center; font-weight: bold;">
                                Isilah lembar data kalibrasi dengan lengkap dan jelas!
                            </td>
                        </tr>

                        <!-- STANDARD + ANAK TIMBANG (textarea) -->
                        <tr>
                        <td rowspan="3" style="width: 110px; border: 1pt solid #000; vertical-align: middle; text-align: center; background-color: #f8f9fa; font-weight: bold;">
                            Standard
                        </td>
                        <td rowspan="3" style="width: 380px; border: 1pt solid #000; padding: 12px;">
                            <p style="margin: 0 0 8px 0; font-size: 10pt;">Anak Timbang :</p>
                            <textarea id="alat_standar" name="alat_standar_text" rows="9"
                                style="width: 100%; height: 160px; padding: 8px; font-size: 10pt; border: 1px solid #999; resize: none; background-color: #fffff8;"
                                placeholder="Masukkan semua anak timbang, satu per baris..."></textarea>
                        </td>

                        <!-- Header Dikalibrasi oleh & Diperiksa oleh -->
                        <td style="width: 200px; border: 1pt solid #000; text-align: center; padding: 15px 8px; background-color: #f8f9fa; font-weight: bold;">
                            Dikalibrasi<br>oleh
                        </td>
                        <td style="width: 200px; border: 1pt solid #000; text-align: center; padding: 15px 8px; background-color: #f8f9fa; font-weight: bold;">
                            Diperiksa<br>oleh
                        </td>
                    </tr>

                        <!-- BARIS NAMA (sesuai gambar: di tengah) -->
                        <tr>
                            <td style="border: 1pt solid #000; padding: 12px 8px; text-align: center;">
                                <input type="text" name="calibrated_by" placeholder="Nama Lengkap"
                                    style="width: 92%; border: none; border-bottom: 1px solid #000; background: transparent; padding: 6px 4px; font-size: 10pt; text-align: center;"
                                    required value="{{ auth()->user()->nama ?? 'System' }}" readonly >
                            </td>
                            <td style="border: 1pt solid #000; padding: 12px 8px; text-align: center;">
                                <input type="text" name="verified_by" placeholder="-"
                                    style="width: 92%; border: none; border-bottom: 1px solid #000; background: transparent; padding: 6px 4px; font-size: 10pt; text-align: center;"
                                    readonly>
                            </td>
                        </tr>

                        <!-- BARIS TTD (sesuai gambar: paling bawah, garis panjang) -->
                        <tr>
                            <td style="border: 1pt solid #000; padding: 15px 8px; text-align: center;">
                                <strong>TTD :</strong><br><br>
                                <div style="height: 70px; border-bottom: 2px solid #000; margin: 10px 15px;"></div>
                            </td>
                            <td style="border: 1pt solid #000; padding: 15px 8px; text-align: center;">
                                <strong>TTD :</strong><br><br>
                                <div style="height: 70px; border-bottom: 2px solid #000; margin: 10px 15px;"></div>
                            </td>
                        </tr>

                        <!-- METODE KALIBRASI (tetap di baris paling bawah, seperti kode awal) -->
                        <tr>
                            <td style="border: 1pt solid #000; text-align: center; background-color: #f8f9fa; font-weight: bold; padding: 12px;">
                                Metode<br>Kalibrasi
                            </td>
                            <td colspan="3" style="border: 1pt solid #000; padding: 12px; vertical-align: middle;">
                                PAS-IK1102-13B (ASTM D 3474-90 : 2018)
                            </td>
                        </tr>
                    </table>


                <!-- Submit Button Section -->
                  <div class="row mt-5">
                    <div class="col-12 text-center">
                        <button type="button" id="btnSimpanSemua" class="btn btn-primary btn-lg" onclick="submitSemuaForm()" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
                            <i class="fas fa-save me-2"></i>Simpan Data Kalibrasi
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    

    <script>
var tempFormDataStore = window.tempFormDataStore;
var isRestoring = window.isRestoring;
var tabSubmitStatus = window.tabSubmitStatus;
var currentActiveTabId = '1';

// ==========================================
// STORAGE PER TAB - GLOBAL
// ==========================================
if (typeof window.tempFormDataStore === 'undefined') {
    window.tempFormDataStore = {};
}
if (typeof window.isRestoring === 'undefined') {
    window.isRestoring = false;
}
if (typeof window.tabSubmitStatus === 'undefined') {
    window.tabSubmitStatus = {};
}

// ==========================================
// FUNGSI GET TAB AKTIF
// ==========================================
function getActiveTabId() {
    const activePane = document.querySelector('.tab-pane.active');
    if (activePane && activePane.id && activePane.id.startsWith('lk-pane-')) {
        const tabId = activePane.id.replace('lk-pane-', '');
        currentActiveTabId = tabId;
        return tabId;
    }
    
    const activeTabButton = document.querySelector('.nav-link.active');
    if (activeTabButton && activeTabButton.id && activeTabButton.id.startsWith('lk-tab-')) {
        const tabId = activeTabButton.id.replace('lk-tab-', '');
        currentActiveTabId = tabId;
        return tabId;
    }
    
    const containers = document.querySelectorAll('.lk-form-container');
    for (let i = 0; i < containers.length; i++) {
        const style = window.getComputedStyle(containers[i]);
        if (style.display !== 'none') {
            const tabId = containers[i].getAttribute('data-lk-id');
            if (tabId) return tabId;
        }
    }
    
    return currentActiveTabId;
}

function updateActiveTab(tabId) {
    currentActiveTabId = tabId;
    console.log(`🔄 Global active tab updated to: ${tabId}`);
}

// ==========================================
// FUNGSI UNTUK MENONAKTIFKAN REQUIRED PADA FORM YANG TIDAK VISIBLE
// ==========================================
function disableRequiredOnHiddenForms() {
    console.log('🔧 disableRequiredOnHiddenForms called');
    
    // Cari semua form yang ada di halaman
    const allForms = document.querySelectorAll('form[id^="kalibrasiForm"]');
    
    allForms.forEach((form, index) => {
        const formIndex = index + 1;
        const container = form.closest('.lk-form-container');
        const isVisible = container && window.getComputedStyle(container).display !== 'none';
        
        console.log(`📌 Form ${formIndex}: isVisible=${isVisible}`);
        
        const requiredInputs = form.querySelectorAll('[required]');
        
        if (!isVisible) {
            // Nonaktifkan required untuk form yang tidak visible
            requiredInputs.forEach(input => {
                console.log(`🔧 Disabling required for: ${input.name}`);
                input.removeAttribute('required');
                input.setAttribute('data-required-temp', 'true');
            });
        } else {
            // Aktifkan kembali required untuk form yang visible
            requiredInputs.forEach(input => {
                if (input.hasAttribute('data-required-temp')) {
                    console.log(`🔧 Re-enabling required for: ${input.name}`);
                    input.setAttribute('required', 'required');
                    input.removeAttribute('data-required-temp');
                }
            });
        }
    });
}

function restoreRequiredOnAllForms() {
    const allForms = document.querySelectorAll('form[id^="kalibrasiForm"]');
    allForms.forEach(form => {
        form.querySelectorAll('[data-required-temp]').forEach(input => {
            input.setAttribute('required', 'required');
            input.removeAttribute('data-required-temp');
        });
    });
}

// ==========================================
// UPDATE FORM TYPE
// ==========================================
function updateFormType(selectedAlat) {
    const manualInputContainer = document.getElementById('manualInputContainer');
    const manualInput = document.getElementById('nama_alat_manual');
    const finalInput = document.getElementById('nama_alat_final');
    
    if (!manualInputContainer || !manualInput) return;
    
    if (selectedAlat === 'MANUAL_INPUT') {
        manualInputContainer.style.display = 'block';
        manualInput.required = true;
        if (finalInput) finalInput.value = '';
    } else {
        manualInputContainer.style.display = 'none';
        manualInput.required = false;
        manualInput.value = '';
        if (finalInput && selectedAlat) finalInput.value = selectedAlat;
    }
}

function syncNamaAlat() {
    const manualInput = document.getElementById('nama_alat_manual');
    const finalInput = document.getElementById('nama_alat_final');
    if (manualInput && finalInput) {
        finalInput.value = manualInput.value;
    }
}

function formatNumberInput(input) {
    if (!input) return;
    let value = input.value;
    if (value === '' || value === null) return;
    value = value.toString().replace(/,/g, '');
    if (!isNaN(value) && value !== '') {
        let num = parseFloat(value);
        if (!isNaN(num)) input.value = num.toString();
    }
}

function escapeHtml(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// ==========================================
// HANDLE SAVE SUCCESS
// ==========================================
window.handleSaveSuccess = function(tabId, data) {
    console.log('🎉 handleSaveSuccess called for tab:', tabId, data);
    
    const container = document.querySelector(`.lk-form-container[data-lk-id="${tabId}"]`);
    if (!container) {
        console.error(`Container for tab ${tabId} not found!`);
        return;
    }

    const tabButton = document.getElementById(`lk-tab-${tabId}`);
    if (tabButton) {
        tabButton.classList.add('tab-saved');
        const badge = tabButton.querySelector('.badge');
        if (badge) {
            badge.className = 'badge badge-success ml-1';
            badge.innerHTML = '<i class="fas fa-check mr-1"></i>Tersimpan';
        }
    }

    const formName = container.getAttribute('data-form-name') || 'Torque Meter';
    const calibrationId = data.calibration_id || data.id || '-';
    const printLabelUrl = data.print_label_url || `/calibrations/${calibrationId}/print-label`;
    
    tabSubmitStatus[tabId] = {
        success: true,
        calibrationId: calibrationId,
        printLabelUrl: printLabelUrl,
        formName: formName,
        timestamp: Date.now()
    };
    
    container.innerHTML = `
      <div class="save-success-overlay text-center p-5 fade-in" style="background: white; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.08);">
       <div class="mb-4">
                    <i class="fas fa-check-circle text-success fa-5x"></i>
                </div>
                <h3 class="text-success mb-2">Simpan Berhasil!</h3>
                <p class="mb-3" style="color: black;">Data kalibrasi untuk <strong>${escapeHtml(formName)}</strong> telah berhasil disimpan ke database.</p>
                
                <div class="d-inline-block mb-4 p-3" style="border-radius: 12px; text-align: left; background: white; border: 1px solid #ddd;">
                    <i class="fas fa-info-circle mr-2" style="color: #0d6efd;"></i>
                    <strong style="color: black;">ID Kalibrasi:</strong> <code style="background: #f5f5f5; color: black; font-weight: bold;">${escapeHtml(calibrationId)}</code>
                    <br>
                    <small style="color: black;">Status: <span class="badge bg-success">Draft</span></small>
                </div>
        
        <div class="d-flex justify-content-center gap-3 flex-wrap mb-4">
            <!-- Button Cetak Label - Blue -->
            <button type="button" class="btn btn-primary btn-lg px-4 py-2" 
                    style="border-radius: 10px; transition: all 0.2s ease;"
                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 5px 15px rgba(0,0,0,0.2)';"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';"
                    onmousedown="this.style.transform='translateY(1px)';"
                    onmouseup="this.style.transform='translateY(-2px)';"
                    onclick="window.open('${printLabelUrl}', '_blank')">
                <i class="fas fa-print me-2"></i> Cetak Label
            </button>
            
            <!-- Button Input Lagi - Green -->
            <button type="button" class="btn btn-success btn-lg px-4 py-2" 
                    style="border-radius: 10px; transition: all 0.2s ease;"
                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 5px 15px rgba(0,0,0,0.2)';"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';"
                    onmousedown="this.style.transform='translateY(1px)';"
                    onmouseup="this.style.transform='translateY(-2px)';"
                    onclick="resetTabForNewScan(${tabId})">
                <i class="fas fa-plus-circle me-2"></i> Input Lagi
            </button>
            
            <!-- Button Tutup Tab - Red -->
            <button type="button" class="btn btn-danger btn-lg px-4 py-2" 
                    style="border-radius: 10px; transition: all 0.2s ease;"
                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 5px 15px rgba(0,0,0,0.2)';"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';"
                    onmousedown="this.style.transform='translateY(1px)';"
                    onmouseup="this.style.transform='translateY(-2px)';"
                    onclick="removeTab(${tabId})">
                <i class="fas fa-times me-2"></i> Tutup Tab
            </button>
        </div>
        
        <div class="mt-3 text-muted small">
            <i class="fas fa-info-circle me-1"></i> Data tersimpan sebagai Draft. 
            Klik <strong>Cetak Label</strong> untuk mencetak, atau <strong>Input Lagi</strong> untuk melanjutkan kalibrasi berikutnya.
        </div>
    </div>
    `;

    const finishContainer = document.getElementById('finish-action-container');
    if (finishContainer) finishContainer.classList.remove('d-none');

    if (typeof Swal !== 'undefined') {
        Swal.fire({
            icon: 'success',
            title: '✓ Data Tersimpan!',
            html: `<strong>${escapeHtml(formName)}</strong><br>ID: ${calibrationId}`,
            timer: 2000,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    }
};

window.resetTabForNewScan = function(tabId) {
    if (confirm('Data yang belum disimpan akan hilang. Lanjutkan?')) {
        delete tabSubmitStatus[tabId];
        location.reload();
    }
};

window.removeTab = function(tabId) {
    if (tabId == 1) {
        alert('Tab utama tidak bisa ditutup!');
        return;
    }
    if (confirm(`Apakah Anda yakin ingin menutup Form ${tabId}?`)) {
        delete tabSubmitStatus[tabId];
        delete tempFormDataStore[tabId];
        const container = document.querySelector(`.lk-form-container[data-lk-id="${tabId}"]`);
        if (container) container.remove();
        const tabBtn = document.getElementById(`lk-tab-${tabId}`);
        if (tabBtn) tabBtn.remove();
        const firstContainer = document.querySelector('.lk-form-container[data-lk-id="1"]');
        if (firstContainer) firstContainer.style.display = 'block';
        updateActiveTab('1');
    }
};

// ==========================================
// SUBMIT Torque Meter - SINGLE FORM PER TAB
// ==========================================
// ==========================================
// SUBMIT Torque Meter - SINGLE FORM
// ==========================================
async function submitSemuaForm() {
    // Dapatkan tab ID yang aktif
    const activeTabId = getActiveTabId();
    console.log('📌 Submitting from active tab:', activeTabId);
    
    // Cari container yang aktif
    const activeContainer = document.querySelector(`.lk-form-container[data-lk-id="${activeTabId}"]`);
    if (!activeContainer) {
        alert('Container form tidak ditemukan!');
        return;
    }
    
    // 🔥 CARI FORM DENGAN ID TEPAT
    let form = activeContainer.querySelector('#kalibrasiForm');
    if (!form) {
        form = activeContainer.querySelector('form[id^="kalibrasiForm"]');
    }
    if (!form) {
        form = activeContainer.querySelector('form');
    }
    
    if (!form) {
        alert('Form tidak ditemukan!');
        return;
    }
    
    console.log(`✅ Form ditemukan di tab ${activeTabId}`);
    
    // 🔥 HAPUS SEMUA ATRIBUT REQUIRED
    form.querySelectorAll('[required]').forEach(el => {
        el.removeAttribute('required');
    });
    
    // 🔥 NONAKTIFKAN VALIDASI BROWSER
    form.setAttribute('novalidate', 'novalidate');
    form.noValidate = true;
    
    // 🔥 VALIDASI ALAT STANDAR (textarea)
    const alatStandarText = form.querySelector('#alat_standar, textarea[name="alat_standar_text"]');
    let alatStandarValue = '';
    if (alatStandarText) {
        alatStandarValue = alatStandarText.value.trim();
    }
    
    // Jika textarea kosong atau hanya spasi, tampilkan error
    if (!alatStandarValue || alatStandarValue === '') {
        alert('Pilih minimal 1 alat standar! Isi textarea Alat Standar.');
        return;
    }
    
    // 🔥 VALIDASI JUMLAH BARIS (opsional, minimal 1 baris tidak kosong)
    const lines = alatStandarValue.split(/\r?\n/).filter(line => line.trim() !== '');
    if (lines.length === 0) {
        alert('Pilih minimal 1 alat standar! Isi textarea dengan alat standar yang digunakan.');
        return;
    }
    
    console.log(`✅ Alat standar terisi: ${lines.length} item`);
    
    const btn = document.getElementById('btnSimpanSemua');
    if (!btn) {
        alert('Tombol simpan tidak ditemukan!');
        return;
    }
    
    const originalText = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan Data...';
    
    try {
        const formData = new FormData(form);
        
        // Tambahkan field wajib
        formData.append('form_type', 'torque_meter');
        formData.append('rentang_ukur_min', '0');
        formData.append('rentang_ukur_max', '0');
        
        // 🔥 KIRIM ALAT STANDAR SEBAGAI ARRAY (split by new line)
        // Hapus dulu yang lama jika ada
        formData.delete('alat_standar_text');
        
        // Kirim sebagai array
        lines.forEach(line => {
            formData.append('alat_standar[]', line);
        });
        
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
        if (csrfToken) {
            formData.append('_token', csrfToken);
        }
        
        console.log('📤 Mengirim data dari tab:', activeTabId);
        console.log('📤 Alat standar yang dikirim:', lines);
        
        const response = await fetch('/calibrations', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        });
        
        const contentType = response.headers.get('content-type');
        
        let result;
        if (contentType && contentType.includes('application/json')) {
            result = await response.json();
        } else {
            const text = await response.text();
            console.error('Non-JSON response:', text.substring(0, 500));
            throw new Error('Server mengembalikan response yang tidak valid');
        }
        
        if (!response.ok) {
            throw new Error(result.error || `Gagal menyimpan data: ${response.status}`);
        }
        
        // Ambil nama form
        let formName = 'Torque Meter';
        const selectNamaAlat = form.querySelector('select[name="nama_alat"]');
        if (selectNamaAlat && selectNamaAlat.value && selectNamaAlat.value !== 'MANUAL_INPUT') {
            formName = selectNamaAlat.value;
        } else {
            const manualNamaAlat = form.querySelector('input[name="nama_alat_manual"]');
            if (manualNamaAlat && manualNamaAlat.value) {
                formName = manualNamaAlat.value;
            }
        }
        
        // Update data-form-name di container
        activeContainer.setAttribute('data-form-name', formName);
        
        console.log('📌 Saving success for tab:', activeTabId);
        
        // Panggil handleSaveSuccess
        if (typeof window.handleSaveSuccess === 'function') {
            window.handleSaveSuccess(activeTabId, result);
        } else {
            alert('Data berhasil disimpan!');
        }
        
    } catch (err) {
        console.error('Submit error:', err);
        alert('Error: ' + err.message);
    } finally {
        btn.disabled = false;
        btn.innerHTML = originalText;
    }
}

// ==========================================
// SETUP TAB SWITCHING
// ==========================================
function setupTabSwitching() {
    $(document).on('shown.bs.tab', 'button[data-toggle="tab"]', function (e) {
        const targetId = $(e.target).attr('id');
        if (targetId && targetId.startsWith('lk-tab-')) {
            const tabId = targetId.replace('lk-tab-', '');
            console.log('🎯 Tab switched to:', tabId);
            updateActiveTab(tabId);
            
            // Sembunyikan semua container
            document.querySelectorAll('.lk-form-container').forEach(container => {
                container.style.display = 'none';
            });
            
            // Tampilkan container yang dipilih
            const targetContainer = document.querySelector(`.lk-form-container[data-lk-id="${tabId}"]`);
            if (targetContainer) {
                targetContainer.style.display = 'block';
            }
        }
    });
    
    const activeButton = document.querySelector('.nav-link.active');
    if (activeButton && activeButton.id) {
        const tabId = activeButton.id.replace('lk-tab-', '');
        updateActiveTab(tabId);
    }
}

// ==========================================
// INISIALISASI
// ==========================================
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 DOM Content Loaded - Initializing Torque Meter...');
    
    // Setup tab switching
    setupTabSwitching();
    
    // Setup event listeners untuk form yang ada
    const selectAlat = document.getElementById('nama_alat_select');
    if (selectAlat) {
        updateFormType(selectAlat.value);
        selectAlat.addEventListener('change', function() {
            updateFormType(this.value);
        });
    }
    
    const manualInput = document.getElementById('nama_alat_manual');
    if (manualInput) {
        manualInput.addEventListener('input', syncNamaAlat);
    }
    
    // Nonaktifkan required pada form yang tidak visible pertama kali
    setTimeout(() => {
        disableRequiredOnHiddenForms();
    }, 500);
    
    console.log('✅ Torque Meter initialization complete!');
});
</script>
<script>
/* ── Standar Picker (Multi-select chip) dengan Fitur Copy ── */
(function () {
    'use strict';

    // Bangun list AT secara dinamis
    var dynamicAtItems = [];
    for (var i = 1; i <= 5; i++) {
        dynamicAtItems.push('AT-5-' + (i < 10 ? '0' : '') + i);
    }
    for (var i = 1; i <= 6; i++) {
        dynamicAtItems.push('AT-10-' + (i < 10 ? '0' : '') + i);
    }
    for (var i = 1; i <= 115; i++) {
        dynamicAtItems.push('AT-20-' + (i < 10 ? '0' : '') + i);
    }

    var SP_OPTIONS = [
        { group: 'M. Anak Timbangan', items: [
            'M.001','M.002','M.003','M.004','M.005','M.006','M.007',
            'M.008','M.009','M.010','M.011','M.012','M.013','M.014','M.015',
            'M.016','M.017','M.018','M.019','M.020','M.021'
        ]},
        { group: 'AT. Anak Timbangan', items: dynamicAtItems }
    ];
    var SP_MAX = 5;
    var activeDropdown = null;

    // Helper untuk mencari elemen terkait sebuah wrapper (mengatasi masalah ID terduplikasi / tab dynamic)
    function getPickerElements(wrapper) {
        // Karena dropdown bisa dipindah ke body, kita beri referensi
        var dd = wrapper._dropdownEl;
        if (!dd) {
            dd = wrapper.querySelector('.sp-dropdown');
            if (dd) wrapper._dropdownEl = dd;
        }
        
        return {
            display: wrapper.querySelector('.sp-display'),
            ph: wrapper.querySelector('.sp-placeholder'),
            hidden: wrapper.parentElement ? wrapper.parentElement.querySelector('input[type="hidden"]') : null,
            search: dd ? dd.querySelector('.sp-search') : null,
            listEl: dd ? dd.querySelector('.sp-option-list') : null,
            dd: dd
        };
    }

    // ==========================================
    // FUNGSI CORE STANDAR PICKER
    // ==========================================
    function buildOptionList(listEl, selected, searchVal) {
        listEl.innerHTML = '';
        var q = (searchVal || '').toLowerCase();
        SP_OPTIONS.forEach(function (grp) {
            var filtered = grp.items.filter(function (item) {
                return !q || item.toLowerCase().includes(q);
            });
            if (!filtered.length) return;
            var lbl = document.createElement('div');
            lbl.className = 'sp-group-label';
            lbl.textContent = grp.group;
            listEl.appendChild(lbl);
            filtered.forEach(function (item) {
                var opt = document.createElement('div');
                opt.className = 'sp-option' + (selected.includes(item) ? ' selected' : '');
                opt.dataset.value = item;
                opt.innerHTML =
                    '<span class="sp-check">' + (selected.includes(item) ? '✓' : '') + '</span>' +
                    '<span>' + item + '</span>';
                listEl.appendChild(opt);
            });
            var div = document.createElement('hr');
            div.className = 'sp-divider';
            listEl.appendChild(div);
        });
    }

    // 🔥 renderChips dengan sync dari hidden
    window.renderChips = function(wrapper, selected) {
        var els = getPickerElements(wrapper);
        var display = els.display;
        var ph = els.ph;
        var hidden = els.hidden;

        if (!display || !ph || !hidden) {
            console.warn('Elements not found for wrapper:', wrapper.dataset.id);
            return;
        }

        // 🔥 Sinkronkan selected dengan nilai di hidden
        if (hidden.value) {
            var hiddenSelected = hidden.value.split('+').filter(Boolean);
            if (selected.length === 0 && hiddenSelected.length > 0) {
                selected = hiddenSelected;
            }
        }

        // Hapus chip lama
        Array.from(display.children).forEach(function (c) {
            if (c.classList.contains('sp-chip')) c.remove();
        });

        if (!selected || selected.length === 0) {
            ph.style.display = '';
            hidden.value = '';
            wrapper.dataset.value = '';
            return;
        }

        ph.style.display = 'none';
        selected.forEach(function (val) {
            var chip = document.createElement('span');
            chip.className = 'sp-chip';
            chip.innerHTML = val + '<span class="sp-remove" data-val="' + val + '">×</span>';
            chip.querySelector('.sp-remove').addEventListener('click', function (e) {
                e.stopPropagation();
                var idx = selected.indexOf(val);
                if (idx !== -1) {
                    selected.splice(idx, 1);
                    // 🔥 Update hidden dan wrapper
                    hidden.value = selected.join('+');
                    wrapper.dataset.value = selected.join('+');
                    window.renderChips(wrapper, selected);
                    refreshDropdown(wrapper, selected);
                }
            });
            display.insertBefore(chip, ph);
        });
        hidden.value = selected.join('+');
        wrapper.dataset.value = selected.join('+');
    };

    function refreshDropdown(wrapper, selected) {
        var els = getPickerElements(wrapper);
        if (!els.listEl) return;
        buildOptionList(els.listEl, selected, els.search ? els.search.value : '');
        attachOptionClicks(els.listEl, wrapper, selected);
    }

    function attachOptionClicks(listEl, wrapper, selected) {
        listEl.querySelectorAll('.sp-option').forEach(function (opt) {
            opt.removeEventListener('click', opt._clickHandler);
            opt._clickHandler = function (e) {
                e.stopPropagation();
                var val = opt.dataset.value;
                
                // 🔥 Ambil data terbaru dari hidden input
                var els = getPickerElements(wrapper);
                var hidden = els.hidden;
                if (hidden) {
                    var currentValue = hidden.value;
                    selected = currentValue ? currentValue.split('+').filter(Boolean) : [];
                }
                
                var idx = selected.indexOf(val);
                if (idx === -1) {
                    if (selected.length >= SP_MAX) {
                        showToast('Maksimal ' + SP_MAX + ' pilihan!');
                        return;
                    }
                    selected.push(val);
                } else {
                    selected.splice(idx, 1);
                }
                
                // Update
                window.renderChips(wrapper, selected);
                refreshDropdown(wrapper, selected);
                
                // 🔥 Update data-value di wrapper
                wrapper.dataset.value = selected.join('+');
            };
            opt.addEventListener('click', opt._clickHandler);
        });
    }

    function positionDropdown(wrapper, dd) {
        if (!wrapper || !dd) return;
        var rect = wrapper.getBoundingClientRect();
        var spaceBelow = window.innerHeight - rect.bottom;
        var spaceAbove = rect.top;
        dd.style.left = rect.left + 'px';
        dd.style.width = Math.max(220, rect.width) + 'px';
        if (spaceBelow >= 200 || spaceBelow >= spaceAbove) {
            dd.style.top = rect.bottom + 'px';
            dd.style.bottom = 'auto';
        } else {
            dd.style.bottom = (window.innerHeight - rect.top) + 'px';
            dd.style.top = 'auto';
        }
    }

    function openDropdown(wrapper, selected) {
        if (activeDropdown && activeDropdown !== wrapper) {
            closeDropdown(activeDropdown);
        }
        var els = getPickerElements(wrapper);
        var dd = els.dd;
        if (!dd) {
            console.warn('Dropdown not found for wrapper:', wrapper.dataset.id);
            return;
        }
        if (dd.parentElement !== document.body) {
            document.body.appendChild(dd);
        }
        positionDropdown(wrapper, dd);
        dd.classList.add('open');
        activeDropdown = wrapper;
        if (els.search) { 
            els.search.value = ''; 
            setTimeout(function() { els.search.focus(); }, 50);
        }
        refreshDropdown(wrapper, selected);
    }

    function closeDropdown(wrapper) {
        if (!wrapper) return;
        var els = getPickerElements(wrapper);
        if (els.dd) els.dd.classList.remove('open');
        if (activeDropdown === wrapper) activeDropdown = null;
    }

    function initPicker(wrapper) {
        if (wrapper.dataset.initialized) return;
        wrapper.dataset.initialized = 'true';
        
        var rawVal = wrapper.dataset.value || '';
        var selected = rawVal ? rawVal.split('+').map(function (s) { return s.trim(); }).filter(Boolean) : [];

        var els = getPickerElements(wrapper);
        var hidden = els.hidden;

        // 🔥 Sinkronkan dengan hidden
        if (hidden && hidden.value && selected.length === 0) {
            selected = hidden.value.split('+').filter(Boolean);
            wrapper.dataset.value = hidden.value;
        }

        window.renderChips(wrapper, selected);

        if (els.search) {
            els.search.addEventListener('input', function () {
                refreshDropdown(wrapper, selected);
            });
            els.search.addEventListener('click', function (e) { e.stopPropagation(); });
            els.search.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') closeDropdown(wrapper);
            });
        }

        wrapper.removeEventListener('click', wrapper._clickHandler);
        wrapper._clickHandler = function (e) {
            var myEls = getPickerElements(wrapper);
            if (myEls.dd && myEls.dd.classList.contains('open')) {
                closeDropdown(wrapper);
            } else {
                openDropdown(wrapper, selected);
            }
        };
        wrapper.addEventListener('click', wrapper._clickHandler);
    }

    // ==========================================
    // 🔥 FUNGSI COPY STANDAR PICKER
    // ==========================================
    window.copyStandarPicker = function(formIndex, fromRow, toRow) {
        // Fallback untuk file yang hanya mengoper 2 argumen
        if (arguments.length === 2) {
            toRow = fromRow;
            fromRow = formIndex;
            formIndex = null;
        }
        
        // Coba pakai DOM relasional (jika button berada dalam satu baris TD yang sama/berdekatan)
        // Agak tricky untuk copy row ke row. Gunakan class / tag.
        // Asumsi form tabel statik: kita gunakanquerySelectorAll('.sp-wrapper') lalu kita cari by index
        var wrappers = Array.from(document.querySelectorAll('.sp-wrapper'));
        // Find wrapper with data-id == fromRow (menggunakan regex jika ada suffix tab)
        var sourceWrapper = wrappers.find(w => w.dataset.id == fromRow || String(w.dataset.id).endsWith('_'+fromRow) || String(w.dataset.id).startsWith(fromRow+'_'));
        var targetWrapper = wrappers.find(w => w.dataset.id == toRow || String(w.dataset.id).endsWith('_'+toRow) || String(w.dataset.id).startsWith(toRow+'_'));
        
        // Jika form index dikirim (timbangan asli), prioritaskan strict match
        if (formIndex !== null) {
            var firstHidden = document.querySelector('[id^="sp_hidden_"]');
            var tabSuffix = '';
            if (firstHidden) {
                var match = firstHidden.id.match(/sp_hidden_\d+_\d+(_.*)/);
                if (match) tabSuffix = match[1];
            }
            var wrapperIdTarget = formIndex + '_' + toRow + tabSuffix;
            var wrapperIdSource = formIndex + '_' + fromRow + tabSuffix;
            var strictTarget = wrappers.find(w => w.dataset.id == wrapperIdTarget);
            var strictSource = wrappers.find(w => w.dataset.id == wrapperIdSource);
            if (strictTarget) targetWrapper = strictTarget;
            if (strictSource) sourceWrapper = strictSource;
        }

        if (!sourceWrapper) {
            showToast('❌ Row ' + fromRow + ' tidak ditemukan!');
            return;
        }
        if (!targetWrapper) {
            showToast('❌ Row ' + toRow + ' tidak ditemukan!');
            return;
        }

        var sourceEls = getPickerElements(sourceWrapper);
        var sourceValue = sourceEls.hidden ? sourceEls.hidden.value : sourceWrapper.dataset.value;
        var selected = sourceValue ? sourceValue.split('+').filter(Boolean) : [];
        
        var targetEls = getPickerElements(targetWrapper);
        if (targetEls.hidden) {
            targetEls.hidden.value = selected.join('+');
        }
        
        targetWrapper.dataset.value = selected.join('+');
        window.renderChips(targetWrapper, selected);
        refreshDropdown(targetWrapper, selected);
        
        if (targetEls.display) {
            var parentTd = targetEls.display.closest('td');
            if (parentTd) {
                parentTd.classList.add('copy-success-flash');
                setTimeout(function() {
                    parentTd.classList.remove('copy-success-flash');
                }, 500);
            }
        }
        
        if (selected.length > 0) {
            showToast('✅ Standar berhasil di-copy ke Row ' + toRow);
        } else {
            showToast('ℹ️ Row ' + fromRow + ' kosong, tidak ada yang di-copy');
        }
    };
    
    // Agar tombol copy versi lama (copyStandar) tetap work
    window.copyStandar = window.copyStandarPicker;

    // ==========================================
    // FUNGSI NOTIFIKASI
    // ==========================================
    function showToast(message) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'info',
                title: 'Informasi',
                text: message,
                timer: 2000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        } else {
            alert(message);
        }
    }

    // ==========================================
    // INISIALISASI
    // ==========================================
    function initAllPickers() {
        var wrappers = document.querySelectorAll('.sp-wrapper:not([data-initialized="true"])');
        wrappers.forEach(function(wrapper) {
            initPicker(wrapper);
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initAllPickers);
    } else {
        initAllPickers();
    }
    
    // Observe DOM changes untuk menangkap tab dinamis (MutationObserver sangat direkomendasikan)
    var observer = new MutationObserver(function(mutations) {
        var uninitialized = document.querySelectorAll('.sp-wrapper:not([data-initialized="true"])');
        if (uninitialized.length > 0) {
            uninitialized.forEach(initPicker);
        }
    });
    observer.observe(document.body, { childList: true, subtree: true });

    document.addEventListener('click', function(e) {
        if (!activeDropdown) return;
        var dd = getPickerElements(activeDropdown).dd;
        if (!activeDropdown.contains(e.target) && dd && !dd.contains(e.target)) {
            closeDropdown(activeDropdown);
        }
    });

    window.addEventListener('scroll', function() {
        if (activeDropdown) {
            var dd = getPickerElements(activeDropdown).dd;
            if (dd) positionDropdown(activeDropdown, dd);
        }
    }, true);
    
    window.addEventListener('resize', function() {
        if (activeDropdown) {
            var dd = getPickerElements(activeDropdown).dd;
            if (dd) positionDropdown(activeDropdown, dd);
        }
    });
})();
</script>
</body>
</html>