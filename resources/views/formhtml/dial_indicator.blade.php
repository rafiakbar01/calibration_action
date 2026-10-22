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

        /* Repeatability Table Styling */
        .repeatability-table {
            border-collapse: collapse;
            width: 100%;
            margin-left: 8.65pt;
            margin-bottom: 20px;
        }
        
        .repeatability-table td {
            border: 1px solid #000;
            padding: 0;
            vertical-align: top;
        }
        
        .repeatability-table p {
            margin: 0;
            font-size: 8pt;
        }
        
        .small-text {
            font-size: 7.5pt;
        }
        
        .medium-text {
            font-size: 8.5pt;
        }
        
        .letter-spacing-neg-01 {
            letter-spacing: -0.1pt;
        }
        
        .letter-spacing-06 {
            letter-spacing: 0.6pt;
        }
        
        .letter-spacing-neg-05 {
            letter-spacing: -0.5pt;
        }
        
        .letter-spacing-035 {
            letter-spacing: 0.35pt;
        }
        
        .letter-spacing-05 {
            letter-spacing: 0.5pt;
        }
        
        .letter-spacing-neg-035 {
            letter-spacing: -0.35pt;
        }
        
        .letter-spacing-neg-02 {
            letter-spacing: -0.2pt;
        }
        
        .letter-spacing-neg-03 {
            letter-spacing: -0.3pt;
        }
        
        .letter-spacing-neg-025 {
            letter-spacing: -0.25pt;
        }
        
        .letter-spacing-065 {
            letter-spacing: 0.65pt;
        }
        
        .letter-spacing-045 {
            letter-spacing: 0.45pt;
        }
        
        .checkbox {
            display: inline-block;
            width: 8px;
            height: 8px;
            border: 1px solid #000;
            margin-right: 4px;
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div class="container my-4">
        <!-- resources/views/formhtml/dial_indicator.blade.php -->
        <form method="POST" action="/calibrations" id="kalibrasiForm">
        @csrf
        <input type="hidden" name="form_type" value="dial_indicator">
        <input type="hidden" name="resolution" value="{{ $resolution ?? '' }}">
            <div class="form-kalibrasi-container">
                <table class="kalibrasi-header-table">
                    <tr>
                        <td colspan="2">
                            <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK04</p>
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
                            <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">DIAL INDICATOR</p>
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

                <!-- Container untuk form dan gambar -->
                <div class="d-flex align-items-start gap-4">
                    <!-- Main Form Section -->
                    <div style="flex: 1;">
                        <table class="kalibrasi-main-table">
                            <!-- Nama Alat -->
                               <tr>
                                   <td style="width: 20%;">
                                    <p style="margin: 0; color: #000000;">Nama Alat</p>
                                </td>
                                <td colspan="3">
                                    <select name="nama_alat" id="nama_alat_select" class="kalibrasi-input" onchange="updateFormType(this.value)" required style="background-color: #f5f5f5; color: #333; border: 1px solid #ced4da; padding: 6px 10px; border-radius: 4px; width: 100%;">
                                        <option value="">-- Pilih Alat --</option>
                                        <option value="Dial Indicator">Dial Indicator</option>
                                        <option value="MANUAL_INPUT">-- Input Manual Nama Alat --</option>
                                    </select>
                                    
                                    <!-- Input Manual - HIDANG AWALNYA -->
                                    <div id="manualInputContainer" style="display: none; margin-top: 10px;">
                                        <input type="text" name="nama_alat_manual" id="nama_alat_manual"
                                               placeholder="Ketik nama alat Dial Indicator secara manual"
                                               style="background-color: #f5f5f5; color: #333; border: 1px solid #ced4da; padding: 6px 10px; border-radius: 4px; width: 100%;"
                                               oninput="syncNamaAlat()">
                                    </div>
                                    
                                    <!-- Hidden input untuk menyimpan nama alat final -->
                                    <input type="hidden" name="nama_alat_final" id="nama_alat_final" value="">
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
                                    <div class="d-flex align-items-center">
                                        <!-- Nama Pemilik -->
                                        <input type="text" name="nama_pemilik" class="kalibrasi-input me-3" style="width: 45%;" placeholder="Masukkan Nama Pemilik" required>
                                        
                                        <span class="me-3" style="color: #000000;">Jenis Pembacaan:</span>

                                        <!-- Radio Button Jenis Pembacaan -->
                                        <div class="d-flex align-items-center" style="gap: 20px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jenis_pembacaan" value="manual" id="manual">
                                                <label class="form-check-label" for="manual" style="color: #000000;">Manual</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jenis_pembacaan" value="digital" id="digital">
                                                <label class="form-check-label" for="digital" style="color: #000000;">Digital</label>
                                            </div>
                                        </div>
                                    </div>
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
                                    <input type="date" name="tanggal_kalibrasi" class="kalibrasi-input" required>
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
                                    <input type="text" name="lokasi_pt" class="kalibrasi-input" placeholder="Masukkan Lokasi PT"  >
                                </td>
                            </tr>
                              <tr>
                                <td>
                                    <p style="margin: 0; color: #000000;">Kode TH</p>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="kode_th" class="kalibrasi-input" placeholder="Masukkan Kode TH"  >
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- Gambar Dial Indicator -->
                    <div style="width: 300px; margin-top: 40px;">
                        <div style="text-align: center; border: 1px solid #ccc; padding: 20px; background: #f8f9fa; border-radius: 8px;">
                            <p style="margin: 0 0 15px 0; font-weight: bold; color: #000000; font-size: 16px;">Referensi Dial Indicator</p>
                            <img src="/logo/dial_indicator.png" alt="Dial Indicator Reference" 
                                style="max-width: 250px; max-height: 300px; display: block; margin: 0 auto;">
                            <p style="margin: 15px 0 0 0; color: #000000; font-size: 12px; font-style: italic;">Gambar referensi pengukuran dial indicator</p>
                        </div>
                    </div>
                </div>

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

{{-- HIDDEN INPUT SKALA — INI YANG MENENTUKAN 0.001 atau 0.01 --}}
<input type="hidden" name="skala" value="{{ $resolution ?? '0.01' }}">

<div class="d-flex justify-content-between gap-4">
    @php
        // Pastikan $resolution datang dari controller via ?resolution=0.001 atau 0.01
        $is001 = ($resolution ?? '') === '0.001';

        // Nilai default penunjukan alat
                    $values001 = ['0.0','0.01','0.02','0.03','0.04','0.05','0.06','0.07','0.08','0.09',
                                  '0.10','0.11','0.12','0.13','0.14','0.15','0.16','0.17','0.18','0.19',
                                  '0.20','0.25','0.30','0.35','0.40','0.45','0.50','0.60','0.70','0.80',
                                  '0.90','1.00','','','','','','',''];

                    $values01  = ['0.0','0.1','0.2','0.3','0.4','0.5','0.6','0.7','0.8','0.9',
                                  '1','1.1','1.2','1.3','1.4','1.5','1.6','1.7','1.8','1.9',
                                  '2','2.5','3','3.5','4','4.5','5','6','7','8',
                                  '9','10','15','20','25','30','40','50',''];

        $values = $is001 ? $values001 : $values01;
    @endphp

    <!-- Tabel Kiri (0 – 1.9 / 0 – 0.190) -->
    <div style="flex:1;">
        <table class="kalibrasi-data-table">
            <tr style="background:#d9d9d9;">
                <td style="border:2px solid #000;padding:8px;text-align:center;"><strong>Penunjukan Alat</strong></td>
                <td colspan="2" style="border:2px solid #000;padding:8px;text-align:center;"><strong>Pembacaan Standard</strong></td>
            </tr>
                  <tr style="background:#e8e8e8;">
            <td style="border:2px solid #000;padding:8px;text-align:center;">
                <!-- Input satuan di tempat www -->
                <div style="position:relative;display:inline-block;width:100px;">
                    <!-- Parentheses tetap -->
                    <span style="position:absolute;left:10px;top:50%;transform:translateY(-50%);font-size:11pt;">(</span>
                    
                    <input type="text" 
                           name="satuan_alat_kiri" 
                           value=""
                           style="width: 80px; 
                                  text-align: center; 
                                  border: none;
                                  border-bottom: 1px dashed #666;
                                  background: transparent;
                                  font-size: 11pt;
                                  font-weight: normal;
                                  padding: 2px 20px;" 
                           maxlength="5"
                           placeholder="mm">
                    
                    <span style="position:absolute;right:10px;top:50%;transform:translateY(-50%);font-size:11pt;">)</span>
                </div>
            </td>
            <td style="border:2px solid #000;padding:8px;text-align:center;">
                <strong>Naik</strong>
            </td>
            <td style="border:2px solid #000;padding:8px;text-align:center;">
                <strong>Turun</strong>
            </td>
        </tr>
            @for($i = 0; $i < 20; $i++)
                <tr>
                    <td style="height:30px;">
                        <input type="text"  name="penunjukanAlat[]"
                               value="{{ $values[$i] ?? '' }}"
                              
                            
                               style="width:100%;height:100%;border:none;text-align:center;">
                    </td>
                    <td><input type="text"   name="pembacaanNaik[]"   ></td>
                    <td><input type="text"  name="pembacaanTurun[]"  ></td>
                </tr>
            @endfor
        </table>
    </div>

    <!-- Tabel Kanan (2 – 50 / 0.200 – 1.000) -->
    <div style="flex:1;">
        <table class="kalibrasi-data-table">
            <tr style="background:#d9d9d9;">
                <td style="border:2px solid #000;padding:8px;text-align:center;"><strong>Penunjukan Alat (mm)</strong></td>
                <td colspan="2" style="border:2px solid #000;padding:8px;text-align:center;"><strong>Pembacaan Standard</strong></td>
            </tr>
             <tr style="background:#e8e8e8;">
                <td style="border:2px solid #000;padding:8px;text-align:center;">
                    <!-- Input satuan di tempat www -->
                    <div style="position:relative;display:inline-block;width:100px;">
                        <!-- Parentheses tetap -->
                        <span style="position:absolute;left:10px;top:50%;transform:translateY(-50%);font-size:11pt;">(</span>
                        
                        <input type="text" 
                               name="satuan_alat_kanan" 
                               value=""
                               style="width: 80px; 
                                      text-align: center; 
                                      border: none;
                                      border-bottom: 1px dashed #666;
                                      background: transparent;
                                      font-size: 11pt;
                                      font-weight: normal;
                                      padding: 2px 20px;" 
                               maxlength="5"
                               placeholder="mm">
                        
                        <span style="position:absolute;right:10px;top:50%;transform:translateY(-50%);font-size:11pt;">)</span>
                    </div>
                </td>
                <td style="border:2px solid #000;padding:8px;text-align:center;">
                    <strong>Naik</strong>
                </td>
                <td style="border:2px solid #000;padding:8px;text-align:center;">
                    <strong>Turun</strong>
                </td>
            </tr>
            @for($i = 20; $i < count($values); $i++)
                <tr>
                    <td style="height:30px;">
                        <input type="text"  name="penunjukanAlat[]"
                               value="{{ $values[$i] ?? '' }}"
                              
                               
                               style="width:100%;height:100%;border:none;text-align:center;">
                    </td>
                    <td><input type="text"  name="pembacaanNaik[]"   ></td>
                    <td><input type="text"  name="pembacaanTurun[]"  ></td>
                </tr>
            @endfor
        </table>
    </div>
</div>
                    <!-- Repeatability Section -->
             <p class="medium-text" style="margin-top:5.1pt; margin-left:d10.2pt; margin-bottom:1.05pt; font-size: 10pt;">
                <span class="letter-spacing-neg-01">Repeatability</span>
                <span class="letter-spacing-06"></span>
                <span class="letter-spacing-neg-05">:</span>
                <input type="text" name="repeatability" 
                    style="border:none; border-bottom:1px solid #000; width:100px; margin-left:10px; font-size:10pt; background:transparent;"
                    >
            </p>

            <div class="table-responsive">
            <table class="repeatability-table" style="width: 100%; border-collapse: collapse; min-width: 600px;">
                        
                            <!-- Baris 1 -->
                <tr style="height: 20pt;">
                    <td style="width: 20%; border: 1px solid #000;">
                        <input type="text"  name="ulangan01" style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; background: transparent;">
                    </td>
                    <td style="width: 20%; border: 1px solid #000;">
                        <input type="text"  name="ulangan02" style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; background: transparent;">
                    </td>
                    <td style="width: 20%; border: 1px solid #000;">
                        <input type="text"  name="ulangan03" style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; background: transparent;">
                    </td>
                    <td style="width: 20%; border: 1px solid #000;">
                        <input type="text"  name="ulangan04" style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; background: transparent;">
                    </td>
                    <td style="width: 20%; border: 1px solid #000;">
                        <input type="text"  name="ulangan05" style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; background: transparent;">
                    </td>
                </tr>
                
                <!-- Baris 2 -->
                <tr style="height: 20pt;">
                    <td style="border: 1px solid #000;">
                        <input type="text" name="ulangan06" style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; background: transparent;">
                    </td>
                    <td style="border: 1px solid #000;">
                        <input type="text"  name="ulangan07" style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; background: transparent;">
                    </td>
                    <td style="border: 1px solid #000;">
                        <input type="text"  name="ulangan08" style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; background: transparent;">
                    </td>
                    <td style="border: 1px solid #000;">
                        <input type="text"  name="ulangan09" style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; background: transparent;">
                    </td>
                    <td style="border: 1px solid #000;">
                        <input type="text"  name="ulangan10" style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; background: transparent;">
                    </td>
                </tr>
            </table>
            </div>

            <!-- Table 2: Alat Standar, TTD, & Metode Kalibrasi -->
            <div class="table-responsive mt-3">
            <table class="repeatability-table" style="width: 100%; border-collapse: collapse; min-width: 800px;">
                    <!-- Baris 1: Alat Standar 1 -->
                    <tr style="height: 22pt;">
                        <td rowspan="3" style="width: 120px; border: 1px solid #000; text-align: center; vertical-align: middle; font-weight: bold; font-size: 10pt; background-color: #f8f9fa;">
                            Alat Standar
                        </td>
                        <td style="width: 40px; border: 1px solid #000; text-align: center; vertical-align: middle;">
                            <input type="checkbox" name="alat_standar[]" value="dial_gauge_tester_0_25mm" class="alat-standar-checkbox" style="transform:scale(1.1);">
                        </td>
                        <td style="width: 280px; border: 1px solid #000; vertical-align: middle; padding: 8px;">
                            <p style="margin: 0; font-size: 9.5pt;">Dial Gauge Tester 0~25 mm</p>
                        </td>
                        <td rowspan="3" style="width: 180px; border: 1px solid #000; vertical-align: top; padding: 8px;">
                            <p style="margin: 0 0 8px 0; font-size: 10pt; text-align: center; font-weight: bold; border-bottom: 1px solid #ddd; padding-bottom: 4px;">Dikalibrasi oleh</p>
                            <p style="margin: 0; font-size: 10pt;">TTD :</p>
                            <div style="height: 45px;"></div>
                            <div style="display:flex; align-items:center;">
                                <span style="font-size: 10pt; white-space: nowrap;">Nama :</span>
                                <input type="text" name="calibrated_by" 
                                    style="flex:1; border: none; border-bottom: 1px solid #000; margin-left: 6px; font-size: 9.5pt; background: transparent;" readonly value="{{ auth()->user()->nama ?? 'System' }}">
                            </div>
                        </td>
                        <td rowspan="3" style="width: 180px; border: 1px solid #000; vertical-align: top; padding: 8px;">
                            <p style="margin: 0 0 8px 0; font-size: 10pt; text-align: center; font-weight: bold; border-bottom: 1px solid #ddd; padding-bottom: 4px;">Diperiksa oleh</p>
                            <p style="margin: 0; font-size: 10pt;">TTD :</p>
                            <div style="height: 45px;"></div>
                            <div style="display:flex; align-items:center;">
                                <span style="font-size: 10pt; white-space: nowrap;">Nama :</span>
                                <input type="text" name="verified_by" 
                                    style="flex:1; border: none; border-bottom: 1px solid #000; margin-left: 6px; font-size: 9.5pt; background: transparent;" readonly>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- Baris 2: Alat Standar 2 -->
                    <tr style="height: 22pt;">
                        <td style="border: 1px solid #000; text-align: center; vertical-align: middle;">
                            <input type="checkbox" name="alat_standar[]" 
                                value="{{ ($resolution ?? '') === '0.001' ? 'dial_calibration_tester_0_1mm' : 'electronic_gauge_tester_0_50mm' }}" 
                                class="alat-standar-checkbox" style="transform:scale(1.1);">
                        </td>
                        <td style="border: 1px solid #000; vertical-align: middle; padding: 8px;">
                            <p style="margin: 0; font-size: 9.5pt;">
                                @if(($resolution ?? '') === '0.001')
                                    Dial Calibration Tester 0~1 mm
                                @else
                                    Electronic Gauge Tester 0~50 mm
                                @endif
                            </p>
                        </td>
                    </tr>
                    
                    <!-- Baris 3: Alat Standar 3 -->
                    <tr style="height: 22pt;">
                        <td style="border: 1px solid #000; text-align: center; vertical-align: middle;">
                            <input type="checkbox" name="alat_standar[]" value="alat_standar_lainnya" 
                                id="alat_standar_lainnya_checkbox"
                                class="alat-standar-checkbox custom-checkbox" 
                                style="transform:scale(1.1);">
                        </td>
                        <td style="border: 1px solid #000; vertical-align: middle; padding: 8px;">
                            <input type="text" name="alat_standar_tambahan" 
                                id="alat_standar_tambahan_input"
                                placeholder="Alat standar tambahan..." 
                                style="width:95%; border:none; border-bottom: 1px dashed #999; font-size:9.5pt; padding:2px; background:transparent;"
                                oninput="updateAlatStandarLainnya()">
                        </td>
                    </tr>
                    
                    <!-- Baris 4: Metode Kalibrasi -->
                    <!-- Baris 4: Metode Kalibrasi -->
                    <tr style="height: 25pt;">
                        <td colspan="2" style="border: 1px solid #000; vertical-align: middle; text-align: center; font-weight: bold; font-size: 10pt; background-color: #f8f9fa;">
                            Metode Kalibrasi
                        </td>
                        <td style="border: 1px solid #000; vertical-align: middle; padding: 8px;">
                            <p style="margin: 0; font-size: 9.5pt; font-weight: normal; color: #000;">
                                PAS-IK1102-03 (JIS B 7503:2017 (JMA/JSA); SNSU PK.P-03:2020).
                            </p>
                        </td>
                        <td style="border: 1px solid #000;"></td>
                        <td style="border: 1px solid #000;"></td>
                    </tr>
            </table>
            </div>

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

var tempFormDataStore = window.tempFormDataStore;
var isRestoring = window.isRestoring;
var tabSubmitStatus = window.tabSubmitStatus;

var currentActiveTabId = '1';

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

function formattextInput(input) {
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

    const formName = container.getAttribute('data-form-name') || 'Dial Indicator';
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
// SUBMIT DIAL INDICATOR - SINGLE FORM PER TAB
// ==========================================
// ==========================================
// SUBMIT DIAL INDICATOR - SINGLE FORM
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
    
    // 🔥 CARI FORM DENGAN ID TEPAT (BUKAN querySelectorAll)
    // Dial Indicator menggunakan ID "kalibrasiForm" (tanpa angka)
    let form = activeContainer.querySelector('#kalibrasiForm');
    
    // Jika tidak ditemukan, coba cari form dengan ID yang mengandung "kalibrasiForm"
    if (!form) {
        form = activeContainer.querySelector('form[id^="kalibrasiForm"]');
    }
    
    // Jika masih tidak ditemukan, cari form pertama di container
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
    
    // Validasi alat standar
    const alatStandar = form.querySelectorAll('input[name="alat_standar[]"]:checked');
    if (alatStandar.length === 0) {
        alert('Pilih minimal 1 alat standar!');
        return;
    }
    
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
        
        // Tambahkan field wajib yang mungkin kosong
        formData.append('form_type', 'dial_indicator');
        formData.append('rentang_ukur_min', '0');
        formData.append('rentang_ukur_max', '0');
        
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
        if (csrfToken) {
            formData.append('_token', csrfToken);
        }
        
        console.log('📤 Mengirim data dari tab:', activeTabId);
        
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
        let formName = 'Dial Indicator';
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
        
        // Panggil handleSaveSuccess dengan tabId yang benar
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
    console.log('🚀 DOM Content Loaded - Initializing Dial Indicator...');
    
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
    
    console.log('✅ Dial Indicator initialization complete!');
});
</script>

    <!-- <script>
    // FUNGSI UTAMA YANG BEKERJA DENGAN STRUKTUR ANDA
    function ubahSemuaSetting(jenis) {
        console.log('Memulai perubahan setting untuk:', jenis);
        
        if (!jenis) return;

        // 1. UBAH ALAT STANDAR - MENGGUNAKAN CLASS YANG DITAMBAHKAN
        const semuaCheckbox = document.querySelectorAll('.alat-standar-checkbox');
        console.log('Checkbox alat standar ditemukan:', semuaCheckbox.length);
        
        // Reset semua checkbox
        semuaCheckbox.forEach(checkbox => {
            checkbox.checked = false;
        });

        // Set checkbox berdasarkan jenis
        if (jenis === '0.01') {
            const electronicGauge = document.querySelector('input[value="electronic_gauge_tester_0_50mm"]');
            if (electronicGauge) {
                electronicGauge.checked = true;
                console.log('Electronic gauge tester 0~50mm dicentang');
            }
        } else if (jenis === '0.001') {
            const dialGauge = document.querySelector('input[value="dial_gauge_tester_0_25mm"]');
            if (dialGauge) {
                dialGauge.checked = true;
                console.log('Dial gauge tester 0~25mm dicentang');
            }
        }

        // 2. UBAH NILAI DEFAULT PENUNJUKAN ALAT
        // Cari semua input penunjukan alat di kedua tabel
        const semuaTabel = document.querySelectorAll('.kalibrasi-data-table');
        let semuaInputPenunjukan = [];
        
        semuaTabel.forEach((tabel, index) => {
            const inputs = tabel.querySelectorAll('input[name="penunjukanAlat[]"]');
            console.log(`Tabel ${index + 1} memiliki ${inputs.length} input penunjukan`);
            inputs.forEach(input => {
                semuaInputPenunjukan.push(input);
            });
        });

        console.log('Total input penunjukan ditemukan:', semuaInputPenunjukan.length);

        // Nilai default
        const nilaiDefault001 = [
            '0.000', '0.010', '0.020', '0.030', '0.040', '0.050', '0.060', '0.070', '0.080', '0.090',
            '0.100', '0.110', '0.120', '0.130', '0.140', '0.150', '0.160', '0.170', '0.180', '0.190',
            '0.200', '0.250', '0.300', '0.350', '0.400', '0.450', '0.500', '0.600', '0.700', '0.800', 
            '0.900', '1.000', '1.500', '2.000', '2.500', '3.000', '4.000', '5.000', ''
        ];

        const nilaiDefault01 = [
            '0.0', '0.1', '0.2', '0.3', '0.4', '0.5', '0.6', '0.7', '0.8', '0.9',
            '1.0', '1.1', '1.2', '1.3', '1.4', '1.5', '1.6', '1.7', '1.8', '1.9',
            '2.0', '2.5', '3.0', '3.5', '4.0', '4.5', '5.0', '6.0', '7.0', '8.0', 
            '9.0', '10.0', '15.0', '20.0', '25.0', '30.0', '40.0', '50.0', ''
        ];

        const nilaiYangDigunakan = (jenis === '0.001') ? nilaiDefault001 : nilaiDefault01;
        
        // Update setiap input penunjukan
        semuaInputPenunjukan.forEach((input, index) => {
            if (nilaiYangDigunakan[index] !== undefined) {
                console.log(`Mengubah input ${index} menjadi: "${nilaiYangDigunakan[index]}"`);
                input.value = nilaiYangDigunakan[index];
                
                // Update onblur event
                input.onblur = function() {
                    if (this.value.trim() === '') {
                        this.value = nilaiYangDigunakan[index];
                    }
                };
            }
        });

        // 3. CLEAR INPUT PEMBACAAN NAIK & TURUN
        const semuaInputNaik = document.querySelectorAll('input[name="pembacaanNaik[]"]');
        const semuaInputTurun = document.querySelectorAll('input[name="pembacaanTurun[]"]');
        
        semuaInputNaik.forEach(input => input.value = '');
        semuaInputTurun.forEach(input => input.value = '');

        console.log(`✅ Setting berhasil diubah untuk Dial Indicator ${jenis} mm`);
        alert(`✅ Berhasil diubah ke Dial Indicator ${jenis} mm\n• Alat standar otomatis terpilih\n• Nilai default penunjukan alat telah disesuaikan`);
    }

    // Event Listener untuk dropdown
    document.addEventListener('DOMContentLoaded', function() {
        const dropdown = document.getElementById('jenis_dial_indicator');
        if (dropdown) {
            console.log('Dropdown ditemukan, menambahkan event listener');
            
            dropdown.addEventListener('change', function() {
                console.log('Dropdown berubah:', this.value);
                ubahSemuaSetting(this.value);
            });
            
            // Jika dropdown sudah ada value, langsung apply
            if (dropdown.value) {
                console.log('Dropdown sudah ada value:', dropdown.value);
                ubahSemuaSetting(dropdown.value);
            }
        } else {
            console.error('Dropdown tidak ditemukan!');
        }
    });

    // Fungsi testing manual
    window.testPerubahan = function(jenis) {
        ubahSemuaSetting(jenis);
    };

    // Debug function
    window.debugAlatStandar = function() {
        const checkboxes = document.querySelectorAll('.alat-standar-checkbox');
        console.log('=== DEBUG ALAT STANDAR ===');
        checkboxes.forEach((cb, i) => {
            console.log(`Checkbox ${i}:`, {
                value: cb.value,
                checked: cb.checked,
                element: cb
            });
        });
    };
    </script> -->


</body>
</html>

