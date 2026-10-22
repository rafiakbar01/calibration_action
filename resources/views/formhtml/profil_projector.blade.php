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
</head>
<body>
    <div class="container my-4">
        <!-- resources/views/formhtml/torque_wrench.blade.php -->
        <form method="POST" action="/calibrations" id="kalibrasiForm">
        @csrf
        <input type="hidden" name="form_type" value="profil_projector">
            <div class="form-kalibrasi-container">
                <table class="kalibrasi-header-table">
                    <tr>
                        <td colspan="2">
                            <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK42</p>
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
                            <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">PROFIL PROJECTOR/MICROSCOPE</p>
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
                                    <option value="Profil Projector">Profil Projector</option>
                                    <option value="MANUAL_INPUT">-- Input Nama Alat --</option>
                                </select>
                                
                                <!-- Input Manual - HIDANG AWALNYA -->
                                <div id="manualInputContainer" style="display: none; margin-top: 10px;">
                                    <input type="text" name="nama_alat_manual" id="nama_alat_manual"
                                           placeholder="Ketik nama alat"
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
                                    <td><input type="number" step="any" name="suhu_awal" class="kondisi-input" required></td>
                                    <td><input type="number" step="any" name="suhu_tengah" class="kondisi-input" required></td>
                                    <td><input type="number" step="any" name="suhu_akhir" class="kondisi-input" required></td>
                                </tr>
                                <tr>
                                    <td class="bg-light fw-bold" style="color: #000000;">RH (%)</td>
                                    <td><input type="number" step="any" name="rh_awal" class="kondisi-input" required></td>
                                    <td><input type="number" step="any" name="rh_tengah" class="kondisi-input" required></td>
                                    <td><input type="number" step="any" name="rh_akhir" class="kondisi-input" required></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                <!-- Data Kalibrasi Section -->
              <style>
/* STYLE KHUSUS HANYA UNTUK TABEL KALIBRASI UTAMA - TIDAK AKAN MEMENGARUHI TABEL LAIN */
.tabel-kalibrasi-utama {
    margin-left: 6.12pt;
    border: 1.5pt solid #000000;
    border-collapse: collapse;
    width: 98%;
    font-family: Arial, sans-serif;
}

.tabel-kalibrasi-utama td {
    border: 1.5pt solid #000000;
    vertical-align: middle;
    padding: 0;
}

.tabel-kalibrasi-utama tr.header-utama td {
    background-color: #f0f0f0;
    height: 18pt;
}

.tabel-kalibrasi-utama .titik-ukur-header {
    width: 120pt;
    text-align: center;
    font-weight: bold;
    font-size: 11pt;
}

.tabel-kalibrasi-utama .pembacaan-header {
    width: 500pt;
    text-align: center;
    font-weight: bold;
    font-size: 11pt;
}

.tabel-kalibrasi-utama .sub-header td {
    height: 18pt;
    text-align: center;
    font-size: 10pt;
    font-weight: bold;
}

.tabel-kalibrasi-utama .titik-ukur-satuan {
    width: 120pt;
    font-size: 10pt;
    text-align: center;
}

.tabel-kalibrasi-utama .data-row {
    height: 25pt;
}

.tabel-kalibrasi-utama .input-titik-ukur,
.tabel-kalibrasi-utama .input-pembacaan {
    width: 95%;
    height: 80%;
    border: none;
    padding: 4px;
    font-size: 11pt;
    text-align: center;
    background-color: white;
    box-sizing: border-box;
}

.tabel-kalibrasi-utama .input-satuan-header {
    width: 50px;
    font-size: 10pt;
    text-align: center;
    border: none;
    background: none;
    outline: none;
    padding: 0;
    margin: 0;
}

.tabel-kalibrasi-utama .input-satuan-titik {
    width: 35px;
    font-size: 10pt;
    text-align: center;
    border: none;
    background: none;
    outline: none;
    padding: 0;
    margin: 0;
}
</style>

<div class="data-kalibrasi-header" style="color: #000000; margin-top: 30px; font-weight: bold; font-size: 14pt; margin-bottom: 8px;">
    DATA KALIBRASI
</div>

<table class="tabel-kalibrasi-utama" cellspacing="0" cellpadding="0">
    
    <!-- HEADER UTAMA -->
    <tr class="header-utama">
        <td class="titik-ukur-header">
            <p style="margin:3pt;">Titik Ukur</p>
         </td>
        <td colspan="5" class="pembacaan-header">
            <p style="margin:3pt;">
                Pembacaan Alat X (
                <input type="text" 
                       name="satuan_alat_x" 
                       class="form-control form-control-sm d-inline-block" 
                       value="MM"
                       style="width: 60px; border: 1px solid #ccc; border-radius: 3px; padding: 2px 5px; height: 26px; text-align: center;">
                )
            </p>
         </td>
        <td colspan="5" class="pembacaan-header">
            <p style="margin:3pt;">
                Pembacaan Alat Y (
                <input type="text" 
                       name="satuan_alat_y" 
                       class="form-control form-control-sm d-inline-block" 
                       value="MM"
                       style="width: 60px; border: 1px solid #ccc; border-radius: 3px; padding: 2px 5px; height: 26px; text-align: center;">
                )
            </p>
         </td>
     </tr>
    
    <!-- SUB HEADER -->
    <tr class="sub-header">
        <td class="titik-ukur-satuan">
            <p style="margin:3pt;">
                ( 
                <input type="text" 
                       name="satuan_titik_ukur" 
                       class="form-control form-control-sm d-inline-block" 
                       value="MM"
                       style="width: 60px; border: 1px solid #ccc; border-radius: 3px; padding: 2px 5px; height: 26px; text-align: center;">
                )
            </p>
         </td>
        <!-- Alat X -->
        <td>1</td>
        <td>2</td>
        <td>3</td>
        <td>4</td>
        <td>5</td>
        <!-- Alat Y -->
        <td>1</td>
        <td>2</td>
        <td>3</td>
        <td>4</td>
        <td>5</td>
     </tr>
    
    <!-- DATA ROWS (20 baris) -->
    <?php for ($i = 1; $i <= 20; $i++): ?>
    <tr class="data-row">
        <td><input type="text" name="titik_ukur_<?php echo $i; ?>" class="input-titik-ukur"></td>
        
        <!-- Alat X -->
        <td><input type="text" step="any" name="x_<?php echo $i; ?>_1" class="input-pembacaan"></td>
        <td><input type="text" step="any" name="x_<?php echo $i; ?>_2" class="input-pembacaan"></td>
        <td><input type="text" step="any" name="x_<?php echo $i; ?>_3" class="input-pembacaan"></td>
        <td><input type="text" step="any" name="x_<?php echo $i; ?>_4" class="input-pembacaan"></td>
        <td><input type="text" step="any" name="x_<?php echo $i; ?>_5" class="input-pembacaan"></td>
        
        <!-- Alat Y -->
        <td><input type="text" step="any" name="y_<?php echo $i; ?>_1" class="input-pembacaan"></td>
        <td><input type="text" step="any" name="y_<?php echo $i; ?>_2" class="input-pembacaan"></td>
        <td><input type="text" step="any" name="y_<?php echo $i; ?>_3" class="input-pembacaan"></td>
        <td><input type="text" step="any" name="y_<?php echo $i; ?>_4" class="input-pembacaan"></td>
        <td><input type="text" step="any" name="y_<?php echo $i; ?>_5" class="input-pembacaan"></td>
     </tr>
    <?php endfor; ?>
</table>

<!-- Jarak antara tabel utama dan footer -->
<div style="margin-top: 40px; margin-bottom: 20px;"></div>
<!-- atau bisa pakai margin lebih besar: margin-top: 60px; -->

<!-- Footer Section -->
<table style="width:100%; border-collapse:collapse; font-family:Arial, sans-serif; font-size:11pt; border:1px solid #000; table-layout:fixed;">

  <!-- Judul -->
   <tr style="height: 40pt;">
        <td colspan="5" style="border-bottom: 1pt solid #000; text-align: center; vertical-align: middle; background-color: #f5f5f5;">
            <span style="font-size: 18pt; font-weight: bold;">
                Isilah lembar data kalibrasi dengan lengkap dan jelas!
            </span>
        </td>
    </tr>

    <!-- Header Kolom -->
    <tr style="height: 35pt;">
        <td rowspan="3" style="width: 20%; border: 1pt solid #000; text-align: center; vertical-align: middle; font-weight: bold; font-size: 12pt; background-color: #f0f0f0;">
            Standard
        </td>
        <td colspan="2" style="width: 40%; border: 1pt solid #000; text-align: center; vertical-align: middle; font-size: 12pt; background-color: #f8f8f8;">
            <!-- Bagian Digital Pressure Calibrator dihapus, kolom tetap ada -->
        </td>
        <td style="width: 20%; border: 1pt solid #000; text-align: center; vertical-align: middle; font-size: 12pt; font-weight: bold; background-color: #f0f0f0;">
            Dikalibrasi oleh
        </td>
        <td style="width: 20%; border: 1pt solid #000; text-align: center; vertical-align: middle; font-size: 12pt; font-weight: bold; background-color: #f0f0f0;">
            Diperiksa oleh
        </td>
    </tr>

    <!-- Baris 1: P.002 (kosong tanpa garis horizontal di kolom TTD) -->
    <tr style="height: 40pt;">
        <td style="width: 5%; border: 1pt solid #000; text-align: center; vertical-align: middle;">
            <input type="checkbox" name="alat_standar[]" value=" Reading Glass Scale, Metrology, D.004 (400mm)" style="width: 18pt; height: 18pt; cursor: pointer;">
        </td>
        <td style="border: 1pt solid #000; padding-left: 15pt; font-size: 11pt; vertical-align: middle;">
            Reading Glass Scale, Metrology, D.004 (400mm)
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none;"></td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none;"></td>
    </tr>

    <!-- Baris 2: P.003 + TTD (tanpa garis atas & bawah pada sel TTD) -->
    <tr style="height: 60pt;">
        <td style="border: 1pt solid #000; text-align: center; vertical-align: middle;">
            <input type="checkbox" name="alat_standar[]" value="  Reading Glass Scale, Metrology, D.005 (100mm)" style="width: 18pt; height: 18pt; cursor: pointer;">
        </td>
        <td style="border: 1pt solid #000; padding-left: 15pt; font-size: 11pt; vertical-align: middle;">
            Reading Glass Scale, Metrology, D.005 (100mm)
        </td>
        <!-- Hapus garis atas dan bawah sepenuhnya pada sel TTD -->
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none; padding: 10pt 0; vertical-align: top; font-size: 11pt; text-align: left;">
            TTD
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none; padding: 10pt 0; vertical-align: top; font-size: 11pt; text-align: left;">
            TTD
        </td>
    </tr>

    <!-- Baris 3: Metode Kalibrasi + Nama -->
    <tr style="height: 60pt;">
        <td style="border: 1pt solid #000; text-align: center; vertical-align: middle; font-weight: bold; font-size: 12pt; background-color: #f0f0f0;">
            Metode Kalibrasi
        </td>
        <td colspan="2" style="border: 1pt solid #000; padding-left: 15pt; font-size: 11pt; vertical-align: middle;">
            PAS-IK1102-60
        </td>
        <!-- Hapus border atas pada sel Nama -->
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-bottom: 1pt solid #000; border-top: none; padding: 10pt; vertical-align: middle; font-size: 11pt;">
            Nama : 
            <input type="text" name="calibrated_by" 
                   style="width: 75%; border: none; border-bottom: 2px solid #000; font-size: 11pt; padding: 5px 0; background: transparent;" 
                   placeholder="Nama"  value="{{ auth()->user()->nama ?? 'System' }}"  readonly>
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-bottom: 1pt solid #000; border-top: none; padding: 10pt; vertical-align: middle; font-size: 11pt;">
            Nama : 
            <input type="text" name="verified_by" 
                   style="width: 75%; border: none; border-bottom: 2px solid #000; font-size: 11pt; padding: 5px 0; background: transparent;" 
                   placeholder="Nama">
        </td>
    </tr>
</table>




                <!-- Submit Button Section -->
                <div class="row mt-5">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary btn-lg" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
                            <i class="fas fa-save me-2"></i>Simpan Data Kalibrasi
                        </button>
                        
                        <!--<button type="reset" class="btn btn-secondary btn-lg ms-3" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">-->
                        <!--    <i class="fas fa-redo me-2"></i>Reset Form-->
                        <!--</button>-->
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

        
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.number-only').forEach(function(input) {
        // Blokir E, e, +, - saat diketik
        input.addEventListener('keydown', function(e) {
            if (['e', 'E', '+', '-'].includes(e.key)) {
                e.preventDefault();
            }
        });

        // Bersihkan jika ada E/e yang masuk lewat paste
        input.addEventListener('input', function() {
            this.value = this.value.replace(/[eE\+\-\,]/g, '');
        });

        // Opsional: batasi panjang (misal maks 10 karakter)
        input.addEventListener('input', function() {
            if (this.value.length > 12) {
                this.value = this.value.slice(0, 12);
            }
        });
    });
});
</script>
    <script>
// JavaScript form validation
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('kalibrasiForm');
    
    form.addEventListener('submit', function(e) {
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.style.borderColor = '#dc3545';
            }
        });

        // Validasi khusus untuk Torque Meter (ANAK TIMBANG)
        const anakTimbang = document.getElementById('anak_timbang');
        if (!anakTimbang.value.trim()) {
            isValid = false;
            anakTimbang.style.borderColor = '#dc3545';
            alert('Field "Anak Timbang" harus diisi!');
        }

        if (!isValid) {
            e.preventDefault();
            alert('Harap isi semua field yang wajib diisi!');
            return;
        }

        // HAPUS VALIDASI ALAT_STANDAR UNTUK TORQUE METER
        // Kode berikut tidak diperlukan untuk torque meter:
        // const alatStandar = form.querySelectorAll('input[name="alat_standar[]"]:checked');
        // if (alatStandar.length === 0) {
        //     e.preventDefault();
        //     alert('Pilih minimal 1 alat standar!');
        //     return;
        // }

        const submitBtn = form.querySelector('button[type="submit"]');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
        submitBtn.disabled = true;
    });
});
</script>
</body>
</html>