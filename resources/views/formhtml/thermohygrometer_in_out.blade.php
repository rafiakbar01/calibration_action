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
        <input type="hidden" name="type" value="in_out">
        <input type="hidden" name="form_type" value="thermohygrometer">
            <div class="form-kalibrasi-container">
                <table class="kalibrasi-header-table">
                    <tr>
                        <td colspan="2">
                            <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK50</p>
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
                            <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">THERMOHYGROMETER</p>
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
                                <input type="text"
                                    name="nama_alat"
                                    class="kalibrasi-input"
                                    value="Thermohygrometer"
                                    placeholder="Thermohygrometer"
                                    readonly
                                    style="background-color: #f5f5f5; color: #333;">
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
                            <input type="text" name="lokasi_pt" class="kalibrasi-input" placeholder="Masukkan Lokasi PT"required>
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
                                    <td><input type="number" name="suhu_awal" class="kondisi-input" required></td>
                                    <td><input type="number" name="suhu_tengah" class="kondisi-input" required></td>
                                    <td><input type="number" name="suhu_akhir" class="kondisi-input" required></td>
                                </tr>
                                <tr>
                                    <td class="bg-light fw-bold" style="color: #000000;">RH (%)</td>
                                    <td><input type="number" name="rh_awal" class="kondisi-input" required></td>
                                    <td><input type="number" name="rh_tengah" class="kondisi-input" required></td>
                                    <td><input type="number" name="rh_akhir" class="kondisi-input" required></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                <!-- Data Kalibrasi Section -->
                <div class="data-kalibrasi-header" style="color: #000000;">DATA KALIBRASI</div>
                
              <table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif;">
    <!-- Bagian Temperatur -->
    <tr>
        <td style="width: 5%;"></td>
        <td rowspan="2" style="width: 10%; border: 1px solid #000; font-weight: bold; text-align: center; vertical-align: middle; padding: 8px; background-color: #f2f2f2;">
            Set Point<br><small>(°C)</small>
        </td>
        <td colspan="3" style="border: 1px solid #000; text-align: center; vertical-align: middle; padding: 8px; background-color: #f2f2f2; font-weight: bold;">
            Pembacaan Standar °C
        </td>
        <td style="width: 3%;"></td>
        <td colspan="3" style="border: 1px solid #000; text-align: center; vertical-align: middle; padding: 8px; background-color: #f2f2f2; font-weight: bold;">
            Pembacaan Alat IN °C
        </td>
        <td colspan="3" style="border: 1px solid #000; text-align: center; vertical-align: middle; padding: 8px; background-color: #f2f2f2; font-weight: bold;">
            Pembacaan Alat OUT °C
        </td>
        <td colspan="2" style="width: 8%;"></td>
    </tr>
    
    <!-- Sub Header x1, x2, x3 untuk Temperatur -->
    <tr>
        <td></td>
        <!-- Kolom Set Point sudah di-merge ke atas, jadi tidak perlu lagi -->
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle; padding: 5px; background-color: #f8f8f8; font-weight: bold;">
            x<sub>1</sub>
        </td>
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle; padding: 5px; background-color: #f8f8f8; font-weight: bold;">
            x<sub>2</sub>
        </td>
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle; padding: 5px; background-color: #f8f8f8; font-weight: bold;">
            x<sub>3</sub>
        </td>
        <td></td>
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle; padding: 5px; background-color: #f8f8f8; font-weight: bold;">
            x<sub>1</sub>
        </td>
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle; padding: 5px; background-color: #f8f8f8; font-weight: bold;">
            x<sub>2</sub>
        </td>
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle; padding: 5px; background-color: #f8f8f8; font-weight: bold;">
            x<sub>3</sub>
        </td>
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle; padding: 5px; background-color: #f8f8f8; font-weight: bold;">
            x<sub>1</sub>
        </td>
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle; padding: 5px; background-color: #f8f8f8; font-weight: bold;">
            x<sub>2</sub>
        </td>
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle; padding: 5px; background-color: #f8f8f8; font-weight: bold;">
            x<sub>3</sub>
        </td>
        <td colspan="2"></td>
    </tr>
    
    <!-- Baris Data Temperatur dengan Loop dan array -->
    <?php for($i = 0; $i < 7; $i++): ?>
    <tr>
        <td></td>
        <!-- Set Point (kolom ini sekarang rowspan="2") -->
        <td style="border: 1px solid #000; padding: 0;">
            <input type="number" name="temp[<?php echo $i; ?>][set_point]" step="0.1" 
                   style="width: 100%; height: 35px; border: none; text-align: center; padding: 0 5px; font-size: 12px;"
                   >
        </td>
        
        <!-- Pembacaan Standar x1, x2, x3 -->
        <td style="border: 1px solid #000; padding: 0;">
            <input type="number" name="temp[<?php echo $i; ?>][std_x1]" step="0.01" 
                   style="width: 100%; height: 35px; border: none; text-align: center; padding: 0 5px; font-size: 12px;">
        </td>
        <td style="border: 1px solid #000; padding: 0;">
            <input type="number" name="temp[<?php echo $i; ?>][std_x2]" step="0.01" 
                   style="width: 100%; height: 35px; border: none; text-align: center; padding: 0 5px; font-size: 12px;">
        </td>
        <td style="border: 1px solid #000; padding: 0;">
            <input type="number" name="temp[<?php echo $i; ?>][std_x3]" step="0.01" 
                   style="width: 100%; height: 35px; border: none; text-align: center; padding: 0 5px; font-size: 12px;">
        </td>
        
        <!-- Spacer -->
        <td></td>
        
        <!-- Pembacaan Alat IN x1, x2, x3 -->
        <td style="border: 1px solid #000; padding: 0;">
            <input type="number" name="temp[<?php echo $i; ?>][in_x1]" step="0.01" 
                   style="width: 100%; height: 35px; border: none; text-align: center; padding: 0 5px; font-size: 12px;">
        </td>
        <td style="border: 1px solid #000; padding: 0;">
            <input type="number" name="temp[<?php echo $i; ?>][in_x2]" step="0.01" 
                   style="width: 100%; height: 35px; border: none; text-align: center; padding: 0 5px; font-size: 12px;">
        </td>
        <td style="border: 1px solid #000; padding: 0;">
            <input type="number" name="temp[<?php echo $i; ?>][in_x3]" step="0.01" 
                   style="width: 100%; height: 35px; border: none; text-align: center; padding: 0 5px; font-size: 12px;">
        </td>
        
        <!-- Pembacaan Alat OUT x1, x2, x3 -->
        <td style="border: 1px solid #000; padding: 0;">
            <input type="number" name="temp[<?php echo $i; ?>][out_x1]" step="0.01" 
                   style="width: 100%; height: 35px; border: none; text-align: center; padding: 0 5px; font-size: 12px;">
        </td>
        <td style="border: 1px solid #000; padding: 0;">
            <input type="number" name="temp[<?php echo $i; ?>][out_x2]" step="0.01" 
                   style="width: 100%; height: 35px; border: none; text-align: center; padding: 0 5px; font-size: 12px;">
        </td>
        <td style="border: 1px solid #000; padding: 0;">
            <input type="number" name="temp[<?php echo $i; ?>][out_x3]" step="0.01" 
                   style="width: 100%; height: 35px; border: none; text-align: center; padding: 0 5px; font-size: 12px;">
        </td>
        
        <td colspan="2"></td>
    </tr>
    <?php endfor; ?>
    
    <!-- Spacer -->
    <tr style="height: 20px;">
        <td colspan="14"></td>
    </tr>
    
    <!-- Bagian Kelembaban -->
    <tr>
        <td></td>
        <td rowspan="2" style="border: 1px solid #000; font-weight: bold; text-align: center; vertical-align: middle; padding: 8px; background-color: #f2f2f2;">
            Set Point<br><small>(%rh)</small>
        </td>
        <td colspan="3" style="border: 1px solid #000; text-align: center; vertical-align: middle; padding: 8px; background-color: #f2f2f2; font-weight: bold;">
            Pembacaan Standar %rh
        </td>
        <td></td>
        <td colspan="3" style="border: 1px solid #000; text-align: center; vertical-align: middle; padding: 8px; background-color: #f2f2f2; font-weight: bold;">
            Pembacaan Alat %rh
        </td>
        <td colspan="5"></td>
    </tr>
    
    <!-- Sub Header x1, x2, x3 untuk Kelembaban -->
    <tr>
        <td></td>
        <!-- Kolom Set Point sudah di-merge ke atas, jadi tidak perlu lagi -->
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle; padding: 5px; background-color: #f8f8f8; font-weight: bold;">
            x<sub>1</sub>
        </td>
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle; padding: 5px; background-color: #f8f8f8; font-weight: bold;">
            x<sub>2</sub>
        </td>
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle; padding: 5px; background-color: #f8f8f8; font-weight: bold;">
            x<sub>3</sub>
        </td>
        <td></td>
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle; padding: 5px; background-color: #f8f8f8; font-weight: bold;">
            x<sub>1</sub>
        </td>
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle; padding: 5px; background-color: #f8f8f8; font-weight: bold;">
            x<sub>2</sub>
        </td>
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle; padding: 5px; background-color: #f8f8f8; font-weight: bold;">
            x<sub>3</sub>
        </td>
        <td colspan="5"></td>
    </tr>
    
    <!-- Baris Data Kelembaban dengan Loop dan array -->
    <?php for($i = 0; $i < 7; $i++): ?>
    <tr>
        <td></td>
        <!-- Set Point Kelembaban (kolom ini sekarang rowspan="2") -->
        <td style="border: 1px solid #000; padding: 0;">
            <input type="number" name="humidity[<?php echo $i; ?>][set_point]" step="0.1" 
                   style="width: 100%; height: 35px; border: none; text-align: center; padding: 0 5px; font-size: 12px;"
                   >
        </td>
        
        <!-- Pembacaan Standar Kelembaban x1, x2, x3 -->
        <td style="border: 1px solid #000; padding: 0;">
            <input type="number" name="humidity[<?php echo $i; ?>][std_x1]" step="0.01" 
                   style="width: 100%; height: 35px; border: none; text-align: center; padding: 0 5px; font-size: 12px;">
        </td>
        <td style="border: 1px solid #000; padding: 0;">
            <input type="number" name="humidity[<?php echo $i; ?>][std_x2]" step="0.01" 
                   style="width: 100%; height: 35px; border: none; text-align: center; padding: 0 5px; font-size: 12px;">
        </td>
        <td style="border: 1px solid #000; padding: 0;">
            <input type="number" name="humidity[<?php echo $i; ?>][std_x3]" step="0.01" 
                   style="width: 100%; height: 35px; border: none; text-align: center; padding: 0 5px; font-size: 12px;">
        </td>
        
        <!-- Spacer -->
        <td></td>
        
        <!-- Pembacaan Alat Kelembaban x1, x2, x3 -->
        <td style="border: 1px solid #000; padding: 0;">
            <input type="number" name="humidity[<?php echo $i; ?>][alat_x1]" step="0.01" 
                   style="width: 100%; height: 35px; border: none; text-align: center; padding: 0 5px; font-size: 12px;">
        </td>
        <td style="border: 1px solid #000; padding: 0;">
            <input type="number" name="humidity[<?php echo $i; ?>][alat_x2]" step="0.01" 
                   style="width: 100%; height: 35px; border: none; text-align: center; padding: 0 5px; font-size: 12px;">
        </td>
        <td style="border: 1px solid #000; padding: 0;">
            <input type="number" name="humidity[<?php echo $i; ?>][alat_x3]" step="0.01" 
                   style="width: 100%; height: 35px; border: none; text-align: center; padding: 0 5px; font-size: 12px;">
        </td>
        
        <td colspan="5"></td>
    </tr>
    <?php endfor; ?>
</table>




                <div style="height: 50px;"></div>


              <!-- Footer Section -->
              <table class="kalibrasi-main-table" style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif; border: 1px solid #000;">
    <!-- BARIS 1: ALAT STANDAR (MERGE 2 ROW) + DIKALIBRASI & DIPERIKSA OLEH -->
    <tr style="height: 60px;">
        <!-- Alat Standar Label (merge 2 row) -->
        <td rowspan="2" style="width: 15%; border-right: 1px solid #000; border-bottom: 1px solid #000; vertical-align: middle; text-align: center; font-weight: bold; font-size: 10pt; color: #000000; background-color: #f8f9fa;">
            Alat<br>Standar
        </td>

        <!-- Alat Standar Content (merge 2 row) -->
        <td rowspan="2" colspan="4" style="border-right: 1px solid #000; border-bottom: 1px solid #000; padding: 8px; font-size: 9pt; vertical-align: middle; color: #000000;">
            Temperature & Humidity Transmitter, Rotronic, 71946262; 20345594
              <input type="hidden" name="alat_standar_text" value="Temperature & Humidity Transmitter, Rotronic, 71946262; 20345594">
        </td>

        <!-- Dikalibrasi oleh (sejajar dengan alat standar) -->
        <td style="width: 15%; border-right: 1px solid #000; border-bottom: 1px solid #000; text-align: center; vertical-align: middle; font-size: 10pt; color: #000000; background-color: #f8f9fa;">
            <strong>Dikalibrasi<br>oleh</strong>
        </td>
        
        <!-- Diperiksa oleh (sejajar dengan alat standar) -->
        <td style="width: 15%; border-right: 1px solid #000; border-bottom: 1px solid #000; text-align: center; vertical-align: middle; font-size: 10pt; color: #000000; background-color: #f8f9fa;">
            <strong>Diperiksa<br>oleh</strong>
        </td>
    </tr>

    <!-- BARIS 2: INPUT NAMA (SEJAJAR DENGAN ALAT STANDAR) -->
    <tr style="height: 40px;">
        
        
       
    </tr>

    <!-- BARIS 3: METODE KALIBRASI + TTD -->
    <tr style="height: 40px;">
        <!-- Metode Kalibrasi Label -->
        <td style="border-right: 1px solid #000; border-bottom: 1px solid #000; text-align: center; vertical-align: middle; font-size: 9pt; color: #000000; background-color: #f8f9fa;">
            <strong>Metode<br>Kalibrasi</strong>
        </td>
        
        <!-- Isi Metode Kalibrasi -->
        <td colspan="4" style="border-right: 1px solid #000; border-bottom: 1px solid #000; padding: 10px; font-size: 9pt; vertical-align: middle; color: #000000;">
            PAS-IK1102-50
        </td>
        
        <!-- TTD Dikalibrasi (sejajar dengan metode) -->
        <td style="border-right: 1px solid #000;  padding: 8px; font-size: 9pt; vertical-align: middle; color: #000000; text-align: center;">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <span style="font-weight: bold;">TTD :</span>
               
            </div>
        </td>
        
        <!-- TTD Diperiksa (sejajar dengan metode) -->
        <td style="border-right: 1px solid #000;  padding: 8px; font-size: 9pt; vertical-align: middle; color: #000000; text-align: center;">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <span style="font-weight: bold;">TTD :</span>
                
            </div>
        </td>
    </tr>

    <!-- BARIS 4: TERTELUSUR + NAMA -->
    <tr style="height: 40px;">
        <!-- Tertelusur Label -->
        <td style="border-right: 1px solid #000; border-bottom: 1px solid #000; text-align: center; vertical-align: middle; font-size: 9pt; color: #000000; background-color: #f8f9fa;">
            <strong>Tertelusur</strong>
        </td>
        
        <!-- Isi Tertelusur -->
        <td colspan="4" style="border-right: 1px solid #000; border-bottom: 1px solid #000; padding: 10px; font-size: 9pt; vertical-align: middle; color: #000000;">
            Certus Metrology
        </td>
        
        <!-- Nama Dikalibrasi (sejajar dengan tertelusur) -->
        <td style="border-right: 1px solid #000; border-bottom: 1px solid #000; padding: 8px; font-size: 9pt; vertical-align: middle; color: #000000; text-align: center;">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <span style="font-weight: bold;">Nama :</span>
                <input type="text" 
                    name="calibrated_by" 
                    class="kalibrasi-input" 
                    placeholder="" 
                    style="width: 70%; border: none; outline: none; padding: 5px; font-size: 9pt; background: transparent; text-align: center; border-bottom: 1px solid #999; margin-left: 5px;">
            </div>
        </td>
        
        <!-- Nama Diperiksa (sejajar dengan tertelusur) -->
        <td style="border-right: 1px solid #000; border-bottom: 1px solid #000; padding: 8px; font-size: 9pt; vertical-align: middle; color: #000000; text-align: center;">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <span style="font-weight: bold;">Nama :</span>
                <input type="text" 
                    name="verified_by" 
                    class="kalibrasi-input" 
                    placeholder="" 
                    style="width: 70%; border: none; outline: none; padding: 5px; font-size: 9pt; background: transparent; text-align: center; border-bottom: 1px solid #999; margin-left: 5px;">
            </div>
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