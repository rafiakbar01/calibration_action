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
        <!-- resources/views/formhtml/inside_micrometer.blade.php -->
        <form method="POST" action="/calibrations" id="kalibrasiForm">
        @csrf
        <input type="hidden" name="form_type" value="durometer">
        
            <div class="form-kalibrasi-container">
                <table class="kalibrasi-header-table">
                    <tr>
                        <td colspan="2">
                            <p style="margin: 0; font-size: 14px; color: #000000; text-align: left;">PAS-FLK56</p>
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
                            <p style="margin: 0; font-size: 14px; color: #000000;text-align: left;">LEMBAR KERJA KALIBRASI</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;text-align: left;">DUROMETER</p>
                        </td>
                    </tr>
                    <tr>
                        
                    </tr>
                    <tr>
                        <td style="width: 25%;">
                            <p style="margin: 0; font-size: 14px; color: #000000;text-align: left;">No. Sertifikat</p>
                        </td>
                        <td style="width: 45%;">
                            <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;text-align: left;">PAS - </p>
                        </td>
                    </tr>
                </table>

               <table class="kalibrasi-main-table">
    <!-- Nama Alat -->
    <tr>
        <td style="width: 20%; vertical-align: middle;">
            <p style="margin: 0; color: #000000; text-align: left; padding-left: 5px;">Nama Alat</p>
        </td>
        <td colspan="3" style="vertical-align: middle;">
            <input type="text"
                name="nama_alat"
                class="kalibrasi-input"
                value="Durometer"
                placeholder="Durometer"
                readonly
                style="background-color: #f5f5f5; color: #333;">
        </td>
    </tr>

    <!-- Merek & Kode Alat -->
    <tr>
        <td style="vertical-align: middle;">
            <p style="margin: 0; color: #000000; text-align: left; padding-left: 5px;">Merek</p>
        </td>
        <td colspan="3" style="vertical-align: middle;">
            <div class="d-flex align-items-center gap-3">
                <input type="text" name="merek" class="kalibrasi-input" placeholder="Masukkan merek alat" style="width: 60%;" required>
                <span style="color: #000000; min-width: 90px;">Kode Alat :</span>
                <input type="text" name="kode_alat" class="kalibrasi-input" placeholder="Masukkan kode" style="width: 30%;" required>
            </div>
        </td>
    </tr>

    <!-- Type / No. Seri -->
    <tr>
        <td style="vertical-align: middle;">
            <p style="margin: 0; color: #000000; text-align: left; padding-left: 5px;">Type / No. Seri</p>
        </td>
        <td colspan="3" style="vertical-align: middle;">
            <div class="d-flex align-items-center gap-3">
                <input type="text" name="type_alat" class="kalibrasi-input" placeholder="Masukkan Type" style="width: 45%;" required>
                <span style="color: #000000; font-size: 1.2em;">/</span>
                <input type="text" name="no_seri" class="kalibrasi-input" placeholder="Masukkan No. Seri" style="width: 45%;" required>
            </div>
        </td>
    </tr>

    <!-- Kapasitas / Resolusi -->
    <tr>
        <td style="vertical-align: middle;">
            <p style="margin: 0; color: #000000; text-align: left; padding-left: 5px;">Kapasitas / Resolusi</p>
        </td>
        <td colspan="3" style="vertical-align: middle;">
            <div class="d-flex align-items-center gap-3">
                <input type="text" name="kapasitas" class="kalibrasi-input" placeholder="Masukkan kapasitas" style="width: 45%;" required>
                <span style="color: #000000; font-size: 1.2em;">/</span>
                <input type="text" name="resolusi" class="kalibrasi-input" placeholder="Masukkan Resolusi" style="width: 45%;" required>
            </div>
        </td>
    </tr>

    <!-- Nama Pemilik -->
    <tr>
        <td style="vertical-align: middle;">
            <p style="margin: 0; color: #000000; text-align: left; padding-left: 5px;">Nama Pemilik</p>
        </td>
        <td colspan="3" style="vertical-align: middle;">
            <input type="text" name="nama_pemilik" class="kalibrasi-input" placeholder="Masukkan nama pemilik / instansi" required>
        </td>
    </tr>

    <!-- Tanggal Alat Masuk -->
    <tr>
        <td style="vertical-align: middle;">
            <p style="margin: 0; color: #000000; text-align: left; padding-left: 5px;">Tanggal Alat Masuk</p>
        </td>
        <td colspan="3" style="vertical-align: middle;">
            <input type="date" name="tanggal_alat_masuk" class="kalibrasi-input" required>
        </td>
    </tr>

    <!-- Tanggal Kalibrasi & Jenis Pembacaan -->
    <tr>
        <td style="vertical-align: middle;">
            <p style="margin: 0; color: #000000; text-align: left; padding-left: 5px;">Tanggal Kalibrasi</p>
        </td>
        <td colspan="3" style="vertical-align: middle;">
            <div class="d-flex align-items-center gap-3">
                <input type="date" name="tanggal_kalibrasi" class="kalibrasi-input" style="width: 45%;" required>
                <span style="color: #000000; min-width: 120px;">Jenis Pembacaan:</span>
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
        <td style="vertical-align: middle;">
            <p style="margin: 0; color: #000000; text-align: left; padding-left: 5px;">Tempat Kalibrasi</p>
        </td>
        <td colspan="3" style="vertical-align: middle;">
            <div class="d-flex align-items-center gap-5">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tempat_kalibrasi" value="lab" id="lab" required>
                    <label class="form-check-label" for="lab" style="color: #000000;">Lab. PT.PAS</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tempat_kalibrasi" value="insitu" id="insitu" required>
                    <label class="form-check-label" for="insitu" style="color: #000000;">Insitu</label>
                </div>
            </div>
        </td>
    </tr>

    <!-- Lokasi PT -->
    <tr>
        <td style="vertical-align: middle;">
            <p style="margin: 0; color: #000000; text-align: left; padding-left: 5px;">Lokasi PT</p>
        </td>
        <td colspan="3" style="vertical-align: middle;">
            <input type="text" name="lokasi_pt" class="kalibrasi-input" placeholder="Masukkan Lokasi PT" required>
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
                                <td><input type="number"
                                        name="suhu_awal" 
                                        class="kondisi-input" 
                                        step="0.1"
                                        oninput="formatInputNumber(this)"
                                        placeholder="0.0"
                                        required></td>
                                <td><input type="number"
                                        name="suhu_tengah" 
                                        class="kondisi-input" 
                                        step="0.1"
                                        oninput="formatInputNumber(this)"
                                        placeholder="0.0"
                                        required></td>
                                <td><input type="number"
                                        name="suhu_akhir" 
                                        class="kondisi-input" 
                                        step="0.1"
                                        oninput="formatInputNumber(this)"
                                        placeholder="0.0"
                                        required></td>
                            </tr>
                            <tr>
                                <td class="bg-light fw-bold" style="color: #000000;">RH (%)</td>
                                <td><input type="number"
                                        name="rh_awal" 
                                        class="kondisi-input" 
                                        step="0.1"
                                        oninput="formatInputNumber(this)"
                                        placeholder="0.0"
                                        required></td>
                                <td><input type="number"
                                        name="rh_tengah" 
                                        class="kondisi-input" 
                                        step="0.1"
                                        oninput="formatInputNumber(this)"
                                        placeholder="0.0"
                                        required></td>
                                <td><input type="number"
                                        name="rh_akhir" 
                                        class="kondisi-input" 
                                        step="0.1"
                                        oninput="formatInputNumber(this)"
                                        placeholder="0.0"
                                        required></td>
                            </tr>
                        </table>
                    </div>

                <!-- Data Kalibrasi Section -->
                <div class="data-kalibrasi-header" style="color: #000000;">DATA KALIBRASI</div>            
   
              
              <?php
// Set point skala yang diminta
$set_points = [0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100];
$jumlah_baris = count($set_points);
?>

<table style="width:100%; border-collapse:collapse; font-size:11pt;">
    <thead>
        <tr>
            <th rowspan="2" style="border:1px solid #000; padding:10px; text-align:center; vertical-align:middle; background-color:#f0f0f0; font-weight:bold;">Set Point Skala<br>(0–100)</th>
            <th colspan="3" style="border:1px solid #000; padding:10px; text-align:center; vertical-align:middle; background-color:#f0f0f0; font-weight:bold;">Pembacaan Standar (kg)</th>
        </tr>
        <tr>
            <th style="border:1px solid #000; padding:10px; text-align:center; vertical-align:middle; background-color:#f0f0f0; font-weight:bold;">x1</th>
            <th style="border:1px solid #000; padding:10px; text-align:center; vertical-align:middle; background-color:#f0f0f0; font-weight:bold;">x2</th>
            <th style="border:1px solid #000; padding:10px; text-align:center; vertical-align:middle; background-color:#f0f0f0; font-weight:bold;">x3</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($set_points as $index => $set_point): ?>
        <?php $i = $index + 1; // Untuk urutan nama field ?>
        <tr>
            <!-- Kolom Set Point dengan value tetap -->
            <td style="border:1px solid #000; padding:10px; text-align:center; vertical-align:middle;">
                <input type="number" 
                       name="titikUkur_<?php echo $i; ?>" 
                       value="<?php echo $set_point; ?>"
                       readonly
                       style="width:90%; border:none; text-align:center; font-size:11pt; background-color:#f8f9fa; font-weight:bold; padding:4px;"
                       >
            </td>
            
            <!-- Kolom Pembacaan x1 -->
            <td style="border:1px solid #000; padding:10px; text-align:center; vertical-align:middle;">
                <input type="number" 
                       name="x1_<?php echo $i; ?>" 
                       step="0.01"
                       style="width:90%; border:none; border-bottom:1px solid #000; text-align:center; font-size:11pt; background:transparent; padding:4px;"
                       onfocus="this.style.backgroundColor='#fffce0';"
                       onblur="this.style.backgroundColor='transparent';"
                      
            </td>
            
            <!-- Kolom Pembacaan x2 -->
            <td style="border:1px solid #000; padding:10px; text-align:center; vertical-align:middle;">
                <input type="number" 
                       name="x2_<?php echo $i; ?>" 
                       step="0.01"
                       style="width:90%; border:none; border-bottom:1px solid #000; text-align:center; font-size:11pt; background:transparent; padding:4px;"
                       onfocus="this.style.backgroundColor='#fffce0';"
                       onblur="this.style.backgroundColor='transparent';"
                       
            </td>
            
            <!-- Kolom Pembacaan x3 -->
            <td style="border:1px solid #000; padding:10px; text-align:center; vertical-align:middle;">
                <input type="number" 
                       name="x3_<?php echo $i; ?>" 
                       step="0.01"
                       style="width:90%; border:none; border-bottom:1px solid #000; text-align:center; font-size:11pt; background:transparent; padding:4px;"
                       onfocus="this.style.backgroundColor='#fffce0';"
                       onblur="this.style.backgroundColor='transparent';"
                       
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
      

<!-- Bagian Repeatability -->
<div style="margin: 50px 0 80px 0; font-family: Arial, sans-serif; font-size: 10pt;">
    <div style="margin-bottom: 15px;">
        <strong>Repeatability :</strong>
    </div>

    <!-- Baris pertama: 5 kolom input -->
    <div style="display: flex; gap: 12px; margin-bottom: 10px; justify-content: left;">
        <input type="text" 
               name="repeatability_1_1" 
              
               style="width: 15%; padding: 8px; border: 1px solid #000; text-align: center; font-size: 10pt;">
        
        <input type="text" 
               name="repeatability_1_2" 
              
               style="width: 15%; padding: 8px; border: 1px solid #000; text-align: center; font-size: 10pt;">
        
        <input type="text" 
               name="repeatability_1_3" 
              
               style="width: 15%; padding: 8px; border: 1px solid #000; text-align: center; font-size: 10pt;">
        
        <input type="text" 
               name="repeatability_1_4" 
              
               style="width: 15%; padding: 8px; border: 1px solid #000; text-align: center; font-size: 10pt;">
        
        <input type="text" 
               name="repeatability_1_5" 
              
               style="width: 15%; padding: 8px; border: 1px solid #000; text-align: center; font-size: 10pt;">
    </div>

    <!-- Baris kedua: 5 kolom input -->
    <div style="display: flex; gap: 12px; justify-content: left;">
        <input type="text" 
               name="repeatability_2_1" 
              
               style="width: 15%; padding: 8px; border: 1px solid #000; text-align: center; font-size: 10pt;">
        
        <input type="text" 
               name="repeatability_2_2" 
              
               style="width: 15%; padding: 8px; border: 1px solid #000; text-align: center; font-size: 10pt;">
        
        <input type="text" 
               name="repeatability_2_3" 
              
               style="width: 15%; padding: 8px; border: 1px solid #000; text-align: center; font-size: 10pt;">
        
        <input type="text" 
               name="repeatability_2_4" 
              
               style="width: 15%; padding: 8px; border: 1px solid #000; text-align: center; font-size: 10pt;">
        
        <input type="text" 
               name="repeatability_2_5" 
              
               style="width: 15%; padding: 8px; border: 1px solid #000; text-align: center; font-size: 10pt;">
    </div>
</div>
<!-- Jarak besar sebelum footer (sudah termasuk di margin-bottom di atas + margin-top di tabel) -->

<!-- Footer Section: Tabel Informasi Alat & Tanda Tangan -->
<table cellspacing="0" cellpadding="8" style="width:100%; border-collapse:collapse; font-family: Arial, sans-serif; font-size:12pt; margin-top: 40px;">
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
        <td colspan="2" style="width: 40%; border: 1pt solid #000; text-align: center; vertical-align: middle; font-size: 12pt; background-color: #f0f0f0;">
            Digital Pressure Calibrator :
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
            <input type="checkbox" name="alat_standar[]" value="Timbangan Digital (AND)" style="width: 18pt; height: 18pt; cursor: pointer;">
        </td>
        <td style="border: 1pt solid #000; padding-left: 15pt; font-size: 11pt; vertical-align: middle;text-align: left;">
           Timbangan Digital (AND)
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none;"></td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none;"></td>
    </tr>

    <!-- Baris 2: P.003 + TTD (tanpa garis atas & bawah pada sel TTD) -->
    <tr style="height: 60pt;">
        <td style="border: 1pt solid #000; text-align: center; vertical-align: middle;">
            <input type="checkbox" name="alat_standar[]" value="Timbangan Digital (Rinstrum)" style="width: 18pt; height: 18pt; cursor: pointer;">
        </td>
        <td style="border: 1pt solid #000; padding-left: 15pt; font-size: 11pt; vertical-align: middle;text-align: left;">
            Timbangan Digital (Rinstrum)
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
        <td colspan="2" style="border: 1pt solid #000; padding-left: 15pt; font-size: 11pt; vertical-align: middle;text-align: left;">
            PAS-IK1102-56
        </td>
        <!-- Hapus border atas pada sel Nama -->
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-bottom: 1pt solid #000; border-top: none; padding: 10pt; vertical-align: middle; font-size: 11pt;">
            Nama : 
            <input type="text" name="calibrated_by" 
                   style="width: 75%; border: none; border-bottom: 2px solid #000; font-size: 11pt; padding: 5px 0; background: transparent;" 
                 >
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-bottom: 1pt solid #000; border-top: none; padding: 10pt; vertical-align: middle; font-size: 11pt;">
            Nama : 
            <input type="text" name="verified_by" 
                   style="width: 75%; border: none; border-bottom: 2px solid #000; font-size: 11pt; padding: 5px 0; background: transparent;" 
                  >
        </td>
    </tr>
</table>

                <!-- Submit Button Section -->
                <div class="row mt-5">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary btn-lg" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
                            <i class="fas fa-save me-2"></i>Simpan Data Kalibrasi
                        </button>
                        
                        <button type="reset" class="btn btn-secondary btn-lg ms-3" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
                            <i class="fas fa-redo me-2"></i>Reset Form
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
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

        if (!isValid) {
            e.preventDefault();
            alert('Harap isi semua field yang wajib diisi!');
            return;
        }

        const alatStandar = form.querySelectorAll('input[name="alat_standar[]"]:checked');
        if (alatStandar.length === 0) {
            e.preventDefault();
            alert('Pilih minimal 1 alat standar!');
            return;
        }

        const submitBtn = form.querySelector('button[type="submit"]');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
        submitBtn.disabled = true;
    });
});
</script>

<script>
// Fungsi untuk update kapasitas secara real-time dari range max
function updateKapasitas() {
    const maxInput = document.getElementById('rentang_ukur_max');
    const kapasitasInput = document.getElementById('kapasitas');
    
    // Ambil nilai dari rentang max
    const maxValue = parseFloat(maxInput.value);
    
    // Update kapasitas dengan nilai dari rentang max
    if (!isNaN(maxValue)) {
        // Format angka dengan 1 digit desimal
        kapasitasInput.value = maxValue.toFixed(1);
    } else {
        kapasitasInput.value = '';
    }
}

// Event listener saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    const maxInput = document.getElementById('rentang_ukur_max');
    
    // Tambahkan event listener untuk paste event juga
    maxInput.addEventListener('paste', function(e) {
        // Biarkan paste terjadi, lalu update kapasitas setelah 10ms
        setTimeout(updateKapasitas, 10);
    });
    
    // Juga update saat halaman pertama kali dimuat (jika ada nilai default di range max)
    updateKapasitas();
});
</script>



<script>
// Fungsi format Type Alat - menerima huruf, angka, titik, koma, dash, slash, spasi
function formatTypeAlat(input) {
    // Izinkan: huruf, angka, titik, koma, dash, slash, spasi, kurung, tanda petik
    // Tidak perlu mengubah value, hanya validasi input
    const regex = /[^A-Za-z0-9\s.,\-\/()"'&]/g;
    if (regex.test(input.value)) {
        input.value = input.value.replace(regex, '');
    }
}

// Fungsi format No. Seri - menerima huruf, angka, titik, koma, dash, slash
function formatNoSeri(input) {
    // Izinkan: huruf, angka, titik, koma, dash, slash
    // Tidak perlu mengubah value, hanya validasi input
    const regex = /[^A-Za-z0-9.,\-\/]/g;
    if (regex.test(input.value)) {
        input.value = input.value.replace(regex, '');
    }
}
</script>


<script>
// Fungsi untuk format input number yang bisa menerima koma
function formatNumberInput(input) {
    // Ambil nilai input
    let value = input.value;
    
    // Ganti koma dengan titik (untuk browser yang mengizinkan koma)
    value = value.replace(',', '.');
    
    // Jika ada lebih dari satu titik, hapus yang berlebih
    const dotCount = (value.match(/\./g) || []).length;
    if (dotCount > 1) {
        // Simpan bagian sebelum titik pertama dan setelah titik terakhir
        const firstPart = value.substring(0, value.indexOf('.') + 1);
        const lastPart = value.substring(value.lastIndexOf('.') + 1);
        value = firstPart + lastPart.replace(/\./g, '');
    }
    
    // Update nilai input jika ada perubahan
    if (value !== input.value) {
        input.value = value;
    }
}

// Event listener untuk menangani paste
document.addEventListener('DOMContentLoaded', function() {
    const numberInputs = document.querySelectorAll('input[type="number"]');
    
    numberInputs.forEach(input => {
        input.addEventListener('paste', function(e) {
            // Biarkan paste terjadi dulu
            setTimeout(() => {
                formatNumberInput(this);
            }, 10);
        });
    });
});
</script>

</body>

</html>