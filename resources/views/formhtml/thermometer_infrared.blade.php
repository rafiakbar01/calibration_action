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
        <input type="hidden" name="form_type" value="ir_thermometer">
            

            <div class="form-kalibrasi-container">
                <table class="kalibrasi-header-table">
                    <tr>
                        <td colspan="2">
                            <p style="margin: 0; font-size: 14px; color: #000000;text-align: left;">PAS-FLK47</p>
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
                            <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;text-align: left;">THERMOMETER INFRARED</p>
                        </td>
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

                <!-- Main Form Section -->
              <table class="kalibrasi-main-table">
    <!-- Nama Alat -->
   <tr>
    <td style="width: 20%; text-align: left;">
        <p style="margin: 0; color: #000000; text-align: left;">Nama Alat</p>
    </td>
    <td colspan="3" style="text-align: left;">
        <input type="text"
            name="nama_alat"
            class="kalibrasi-input"
            value="Thermometer Infrared"
            placeholder="Thermometer Infrared"
            readonly
            style="background-color: #f5f5f5; color: #333; text-align: left; padding-left: 10px;">
    </td>
</tr>

    <!-- Merek & Kode Alat -->
    <tr>
        <td style="text-align: left;">
            <p style="margin: 0; color: #000000; text-align: left;">Merek</p>
        </td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="text" name="merek" class="kalibrasi-input me-3" placeholder="Masukkan merek alat" style="width: 60%; text-align: left;" required>
                <span class="me-1" style="color:#000000;">KodeAlat:</span>
                <input type="text" name="kode_alat" class="kalibrasi-input" placeholder="Masukkan kode" style="width: 30%; text-align: left;">
            </div>
        </td>
    </tr>

    <!-- Type / No. Seri -->
    <tr>
        <td style="text-align: left;">
            <p style="margin: 0; color: #000000; text-align: left;">Type / No. Seri</p>
        </td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="text" 
                    name="type_alat" 
                    class="kalibrasi-input me-3" 
                    placeholder="Masukkan Type Alat" 
                    style="width: 45%; text-align: left;"
                    oninput="formatTypeAlat(this)">
                <span class="me-3" style="color: #000000;">/</span>
                <input type="text" 
                    name="no_seri" 
                    class="kalibrasi-input" 
                    placeholder="Masukkan No. Seri" 
                    style="width: 45%; text-align: left;"
                    oninput="formatNoSeri(this)"
                    required>
            </div>
        </td>
    </tr>

    <!-- Kapasitas / Resolusi -->
    <tr>
        <td style="text-align: left;">
            <p style="margin: 0; color: #000000; text-align: left;">Kapasitas / Resolusi</p>
        </td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="text" name="kapasitas" class="kalibrasi-input me-3" placeholder="Masukkan kapasitas" style="width: 45%; text-align: left;" required>
                <span class="me-3" style="color: #000000;">/</span>
                <input type="text" name="resolusi" class="kalibrasi-input" placeholder="Masukkan Resolusi" style="width: 45%; text-align: left;" required>
            </div>
        </td>
    </tr>

    <!-- Nama Pemilik -->
    <tr>
        <td style="text-align: left;">
            <p style="margin: 0; color: #000000; text-align: left;">Nama Pemilik</p>
        </td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="text" name="nama_pemilik" class="kalibrasi-input me-3" placeholder="Masukkan nama pemilik/Instansi" style="width: 60%; text-align: left;" required>
            </div>
        </td>
    </tr>
    
    <!-- Tanggal Alat Masuk & Kalibrasi -->
    <tr>
        <td style="text-align: left;">
            <p style="margin: 0; color: #000000; text-align: left;">Tanggal Alat Masuk</p>
        </td>
        <td colspan="3">
            <input type="date" name="tanggal_alat_masuk" class="kalibrasi-input" value="{{ date('Y-m-d') }}" style="text-align: left;" required>
        </td>
    </tr>
    <tr>
        <td style="text-align: left;">
            <p style="margin: 0; color: #000000; text-align: left;">Tanggal Kalibrasi</p>
        </td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <!-- Tanggal Kalibrasi -->
                <input type="date" 
                    name="tanggal_kalibrasi" 
                    class="kalibrasi-input me-3" 
                    style="width: 45%; text-align: left;" 
                    required
                    value="{{ date('Y-m-d') }}">
                
                <span class="me-3" style="color: #000000;">Jenis Pembacaan:</span>
                
                <!-- Dropdown Jenis Pembacaan -->
                <select name="jenis_pembacaan" class="kalibrasi-input" style="width: 45%; text-align: left;">
                    <option value="">-- Pilih --</option>
                    <option value="manual">Manual</option>
                    <option value="digital" selected>Digital</option>
                </select>
            </div>
        </td>
    </tr>

    <!-- Tempat Kalibrasi -->
    <tr>
        <td style="text-align: left;">
            <p style="margin: 0; color: #000000; text-align: left;">Tempat Kalibrasi</p>
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
        <td style="text-align: left;">
            <p style="margin: 0; color: #000000; text-align: left;">Lokasi PT</p>
        </td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="text" name="lokasi_pt" class="kalibrasi-input me-3" placeholder="Masukkan lokasi pt" style="width: 60%; text-align: left;" required>
            </div>
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
                <div class="setting-suhu-container" style="margin-bottom: 30px;">
    <div style="display: flex; justify-content: space-between;">
        <!-- Tabel Kiri (Data 1-5) -->
            <table class="setting-suhu-table" style="border-collapse: collapse; width: 48%;">
                <tr>
                    <th rowspan="2" style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; font-size: 10pt; background-color: #f0f0f0;">
                        Setting Suhu<br>
                        <select name="satuan_suhu" id="satuan_suhu_kiri" style="width: 80%; border: none; text-align: center; background: transparent; font-size: 9pt; font-weight: normal; margin-top: 5px;" 
                                onchange="document.getElementById('satuan_suhu_kanan_display').textContent = this.value || '(……………)'; document.getElementById('satuan_suhu_kanan').value = this.value || '';">
                            <option value="">Select</option>
                            <option value="°C">°C</option>
                            <option value="°F">°F</option>
                        </select>
                    </th>
                    <th colspan="2" style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; font-size: 10pt; background-color: #f0f0f0;">
                        Pembacaan
                    </th>
                </tr>
                <tr>
                    <th style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; font-size: 10pt; background-color: #f0f0f0;">STD</th>
                    <th style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; font-size: 10pt; background-color: #f0f0f0;">UUT</th>
                </tr>
                <?php 
                // Tabel kiri: 5 data dengan pola 1-3-3
                // Data 1: setting 1 → 3 pembacaan (std/uut 1,2,3)
                // Data 2: setting 2 → 3 pembacaan (std/uut 4,5,6)
                ?>
                <?php for($data=1; $data<=5; $data++): ?>
                    <?php 
                    // Hitung offset untuk STD dan UUT
                    $start_std = (($data-1) * 3) + 1;
                    ?>
                    <tr>
                        <td rowspan="3" style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 90px;">
                            <input type="text" name="setting_suhu_<?php echo $data; ?>" style="width: 80%; border: none; text-align: center; background: transparent; font-size: 10pt;" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" pattern="[0-9.]+">
                        </td>
                        <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 30px;">
                            <input type="text" name="std_<?php echo $start_std; ?>" style="width: 90%; border: none; text-align: center; background: transparent; font-size: 9pt;" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" pattern="[0-9.]+">
                        </td>
                        <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 30px;">
                            <input type="text" name="uut_<?php echo $start_std; ?>" style="width: 90%; border: none; text-align: center; background: transparent; font-size: 9pt;" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" pattern="[0-9.]+">
                        </td>
                    </tr>
                    <tr>
                        <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 30px;">
                            <input type="text" name="std_<?php echo $start_std + 1; ?>" style="width: 90%; border: none; text-align: center; background: transparent; font-size: 9pt;" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" pattern="[0-9.]+">
                        </td>
                        <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 30px;">
                            <input type="text" name="uut_<?php echo $start_std + 1; ?>" style="width: 90%; border: none; text-align: center; background: transparent; font-size: 9pt;" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" pattern="[0-9.]+">
                        </td>
                    </tr>
                    <tr>
                        <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 30px;">
                            <input type="text" name="std_<?php echo $start_std + 2; ?>" style="width: 90%; border: none; text-align: center; background: transparent; font-size: 9pt;" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" pattern="[0-9.]+">
                        </td>
                        <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 30px;">
                            <input type="text" name="uut_<?php echo $start_std + 2; ?>" style="width: 90%; border: none; text-align: center; background: transparent; font-size: 9pt;" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" pattern="[0-9.]+">
                        </td>
                    </tr>
                <?php endfor; ?>
            </table>

            <!-- Tabel Kanan (Data 6-10) -->
            <table class="setting-suhu-table" style="border-collapse: collapse; width: 48%;">
                <tr>
                    <th rowspan="2" style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; font-size: 10pt; background-color: #f0f0f0;">
                        Setting Suhu<br>
                        <span id="satuan_suhu_kanan_display" style="font-size: 9pt; font-weight: normal; margin-top: 5px; display: block;">....</span>
                        <input type="hidden" name="satuan_suhu_kanan" id="satuan_suhu_kanan" value="">
                    </th>
                    <th colspan="2" style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; font-size: 10pt; background-color: #f0f0f0;">
                        Pembacaan
                    </th>
                </tr>
                <tr>
                    <th style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; font-size: 10pt; background-color: #f0f0f0;">STD</th>
                    <th style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; font-size: 10pt; background-color: #f0f0f0;">UUT</th>
                </tr>
                <?php 
                // Tabel kanan: 5 data dengan pola 1-3-3
                // Data 6: setting 6 → 3 pembacaan (std/uut 16,17,18)
                // Data 7: setting 7 → 3 pembacaan (std/uut 19,20,21)
                // ... sampai data 10
                ?>
                <?php for($data=6; $data<=10; $data++): ?>
                    <?php 
                    // Hitung offset untuk STD dan UUT
                    // Karena tabel kiri sudah menggunakan 1-15 (5 data × 3 pembacaan)
                    // Maka tabel kanan mulai dari 16
                    $start_std = (($data-1) * 3) + 1;
                    ?>
                    <tr>
                        <td rowspan="3" style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 90px;">
                            <input type="text" name="setting_suhu_<?php echo $data; ?>" style="width: 80%; border: none; text-align: center; background: transparent; font-size: 10pt;" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" pattern="[0-9.]+">
                        </td>
                        <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 30px;">
                            <input type="text" name="std_<?php echo $start_std; ?>" style="width: 90%; border: none; text-align: center; background: transparent; font-size: 9pt;" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" pattern="[0-9.]+">
                        </td>
                        <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 30px;">
                            <input type="text" name="uut_<?php echo $start_std; ?>" style="width: 90%; border: none; text-align: center; background: transparent; font-size: 9pt;" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" pattern="[0-9.]+">
                        </td>
                    </tr>
                    <tr>
                        <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 30px;">
                            <input type="text" name="std_<?php echo $start_std + 1; ?>" style="width: 90%; border: none; text-align: center; background: transparent; font-size: 9pt;" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" pattern="[0-9.]+">
                        </td>
                        <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 30px;">
                            <input type="text" name="uut_<?php echo $start_std + 1; ?>" style="width: 90%; border: none; text-align: center; background: transparent; font-size: 9pt;" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" pattern="[0-9.]+">
                        </td>
                    </tr>
                    <tr>
                        <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 30px;">
                            <input type="text" name="std_<?php echo $start_std + 2; ?>" style="width: 90%; border: none; text-align: center; background: transparent; font-size: 9pt;" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" pattern="[0-9.]+">
                        </td>
                        <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 30px;">
                            <input type="text" name="uut_<?php echo $start_std + 2; ?>" style="width: 90%; border: none; text-align: center; background: transparent; font-size: 9pt;" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" pattern="[0-9.]+">
                        </td>
                    </tr>
                <?php endfor; ?>
            </table>
    </div>
</div>


 
        
 <div class="container">
        <strong>Emisivitas : 0.95</strong>
    </div>
    
   <div class="container">
    <strong>Jarak Kalibrasi :  
        <input type="number" step="any" name="jarak_kalibrasi" class="kalibrasi-input me-3" style="width: 5%; border: none; background: transparent; outline: none; padding: 0;" required>
    </strong>
</div>
  
    


    
                
                <!-- Jarak dan Footer Section -->
                <div style="margin-top: 40px; margin-bottom: 20px;"></div>

                <!-- Footer Section -->
                <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Footer Kalibrasi Roughness Tester</title>
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      padding: 20px;
      background-color: #f9f9f9;
    }
    table {
      width: 100%;
      max-width: 1100px;
      margin: 20px auto;
      border-collapse: collapse;
      background-color: #fff;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    td {
      border: 1px solid #000;
      padding: 12px;
      text-align: center;
      vertical-align: middle;
    }
    .title {
      font-weight: bold;
      font-size: 18px;
      background-color: #f0f0f0;
    }
    .label {
      font-weight: bold;
      background-color: #e0e0e0;
    }
    input[type="text"] {
      width: 95%;
      border: none;
      background: transparent;
      text-align: center;
      padding: 5px;
      font-size: 12pt;
    }
    input[type="text"]:focus {
      outline: 2px solid #4a90e2;
      background-color: #f0f8ff;
    }
    /* Area TTD tanpa garis bawah + ruang tinggi untuk tanda tangan */
    .signature-box {
      height: 120px;
      vertical-align: top;
      text-align: left;
      padding: 15px 20px 10px;
      border-bottom: none !important;
    }
    .empty-row {
      height: 20px;
      border: none;
    }
    @media print {
      body { background: white; padding: 10px; }
      table { box-shadow: none; }
    }
  </style>

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
            <input type="checkbox" name="alat_standar[]" value="Black Body (T.002)" style="width: 18pt; height: 18pt; cursor: pointer;">
        </td>
        <td style="border: 1pt solid #000; padding-left: 15pt; font-size: 11pt; vertical-align: middle;text-align: left;">
           Black Body (T.002)
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none;"></td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none;"></td>
    </tr>

    <!-- Baris 2: P.003 + TTD (tanpa garis atas & bawah pada sel TTD) -->
    <tr style="height: 60pt;">
        <td style="border: 1pt solid #000; text-align: center; vertical-align: middle;">
            <input type="checkbox" name="alat_standar[]" value=" Black Body (T.009)" style="width: 18pt; height: 18pt; cursor: pointer;">
        </td>
        <td style="border: 1pt solid #000; padding-left: 15pt; font-size: 11pt; vertical-align: middle;text-align: left;">
            Black Body (T.009)
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
            PAS-IK1102-47
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


</body>
</html>