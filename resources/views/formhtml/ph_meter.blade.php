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

        /* Styling untuk tabel data kalibrasi */
        .data-kalibrasi-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .data-kalibrasi-table td, .data-kalibrasi-table th {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
            vertical-align: middle;
            font-size: 11pt;
        }
        .data-kalibrasi-table th {
            background-color: #d0d0d0;
            font-weight: bold;
        }
        .section-title {
            background-color: #a0a0a0;
            font-size: 1.2em;
            font-weight: bold;
        }
        .sub-header {
            background-color: #e6e6e6;
        }
        .unit-note {
            font-size: 0.9em;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container my-4">
        <!-- resources/views/formhtml/inside_micrometer.blade.php -->
        <form method="POST" action="/calibrations" id="kalibrasiForm">
        @csrf
        <input type="hidden" name="form_type" value="ph_meter">
                

            <div class="form-kalibrasi-container">
                <table class="kalibrasi-header-table">
                    <tr>
                        <td colspan="2">
                            <p style="margin: 0; font-size: 14px; color: #000000;text-align: left;">PAS-FLK40</p>
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
                            <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;text-align: left;"> </p>
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
                           <td style="width: 20%;">
                                <p style="margin: 0; color: #000000;">Nama Alat</p>
                            </td>
                            <td colspan="3">
                                <!-- Hidden input untuk form type -->
                                 
                                
                                <select name="nama_alat" id="nama_alat_select" class="kalibrasi-input" onchange="updateFormType(this.value)" required style="background-color: #f5f5f5; color: #333; border: 1px solid #ced4da; padding: 6px 10px; border-radius: 4px; width: 100%;">
                                    <option value="">-- Pilih Alat --</option>
                                    <option value="PH Meter">PH Meter</option>
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
                            <p style="margin: 0; color: #000000;text-align: left;">Merek</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" name="merek" class="kalibrasi-input me-3" placeholder="Masukkan merek alat" style="width: 60%;text-align: left;" required>
                                <span class="me-1" style="color:#000000;">KodeAlat:</span>
                                <input type="text" name="kode_alat" class="kalibrasi-input" placeholder="Masukkan kode" style="width: 30%; text-align: left;">
                            </div>
                        </td>
                    </tr>

                    <!-- Type / No. Seri -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;text-align: left;">Type / No. Seri</p>
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
                    <!-- Rentang Ukur -->
                    <!-- <tr>
                        <td><p style="margin:0;color:#000; text-align: left;">Rentang Ukur</p></td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="number"
                                    name="rentang_ukur_min"
                                    class="kalibrasi-input me-3"
                                    value="0"
                                    step="any"
                                    style="width:45%;"
                                    placeholder="Masukkan Range Min"
                                    required>

                                <span class="me-3">-</span>

                                <input type="number"
                                    name="rentang_ukur_max"
                                    id="rentang_ukur_max"
                                    class="kalibrasi-input"
                                    step="any"
                                    style="width:45%;"
                                    placeholder="Masukkan Range Max"
                                    required
                                    oninput="updateKapasitas()">
                            </div>
                        </td>
                    </tr> -->

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
                        <td>
                            <p style="margin: 0; color: #000000; text-align: left;">Nama Pemilik</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" name="nama_pemilik" class="kalibrasi-input me-3" placeholder="Masukkan nama pemilik/Instansi" style="width: 60%;text-align: left;" required>
                            </div>
                        </td>
                    </tr>
                    
                  

                    <!-- Tanggal Alat Masuk & Kalibrasi -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000; text-align: left;">Tanggal Alat Masuk</p>
                        </td>
                        <td colspan="3">
                            <input type="date" name="tanggal_alat_masuk" class="kalibrasi-input" value="{{ date('Y-m-d') }}" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000; text-align: left;">Tanggal Kalibrasi</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <!-- Tanggal Kalibrasi -->
                                <input type="date" 
                                    name="tanggal_kalibrasi" 
                                    class="kalibrasi-input me-3" 
                                    style="width: 45%;" 
                                    required
                                    value="{{ date('Y-m-d') }}">
                                
                                <span class="me-3" style="color: #000000;">Jenis Pembacaan:</span>
                                
                                <!-- Dropdown Jenis Pembacaan -->
                                <select name="jenis_pembacaan" class="kalibrasi-input" style="width: 45%;">
                                    <option value="">-- Pilih --</option>
                                    <option value="manual">Manual</option>
                                    <option value="digital" selected>Digital</option>
                                </select>
                            </div>
                        </td>
                    </tr>

                    <!-- Tempat Kalibrasi -->
                    <tr>
                        <td>
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
                        <td>
                            <p style="margin: 0; color: #000000; text-align: left;">Lokasi PT</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" name="lokasi_pt" class="kalibrasi-input me-3" placeholder="Masukkan lokasi pt" style="width: 60%;text-align: left;"  >
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
                                        step="any"
                                        
                                        placeholder="0.0"
                                        required></td>
                                <td><input type="number"
                                        name="suhu_tengah" 
                                        class="kondisi-input" 
                                        step="any"
                                        
                                        placeholder="0.0"
                                        required></td>
                                <td><input type="number"
                                        name="suhu_akhir" 
                                        class="kondisi-input" 
                                        step="any"
                                        
                                        placeholder="0.0"
                                        required></td>
                            </tr>
                            <tr>
                                <td class="bg-light fw-bold" style="color: #000000;">RH (%)</td>
                                <td><input type="number"
                                        name="rh_awal" 
                                        class="kondisi-input" 
                                        step="any"
                                        
                                        placeholder="0.0"
                                        required></td>
                                <td><input type="number"
                                        name="rh_tengah" 
                                        class="kondisi-input" 
                                        step="any"
                                        
                                        placeholder="0.0"
                                        required></td>
                                <td><input type="number"
                                        name="rh_akhir" 
                                        class="kondisi-input" 
                                        step="any"
                                        
                                        placeholder="0.0"
                                        required></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Data Kalibrasi Section -->
                <div class="data-kalibrasi-header" style="color: #000000;">DATA KALIBRASI</div>

        <table cellspacing="0" cellpadding="0" style="margin-left:2.75pt; border:1pt solid #000000; -aw-border-insideh:1pt single #000000; -aw-border-insidev:1pt single #000000; border-collapse:collapse; width:100%">
        <!-- Header Row 1 -->
        <tr style="height:14.2pt">
            <td rowspan="2" style="width:150pt; border-right-style:solid; border-right-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:top; background-color:#d9d9d9; text-align:center;">
            <p class="TableParagraph" style="margin-top:9.2pt; margin-left:0; margin-right:0; text-align:center; font-size:10pt">
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.1pt">Nilai</span>
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.25pt"></span>
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.1pt">Buffer</span>
            </p>
            </td>
            <td colspan="5" style="width:450pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:top; background-color:#d9d9d9">
            <p class="TableParagraph" style="margin-top:1.65pt; margin-left:1.65pt; text-align:center; font-size:10pt">
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.1pt">Pembacaan</span>
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.3pt"></span>
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.2pt">Alat</span>
            </p>
            </td>
            <td rowspan="2" style="width:120pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:top; background-color:#d9d9d9; text-align:center;">
            <p class="TableParagraph" style="margin-top:9.2pt; margin-left:0; margin-right:0; text-align:center; font-size:10pt">
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.1pt">Resolusi</span>
            </p>
            </td>
            <td style="width:120pt; border-left-style:solid; border-left-width:1pt; vertical-align:top; background-color:#d9d9d9">
            <p class="TableParagraph" style="margin-top:1.65pt; margin-right:0.1pt; margin-left:1.65pt; text-align:center; font-size:10pt">
                <span style="font-family:Arial; font-weight:bold">Suhu</span>
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.55pt"></span>
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.1pt">Buffer</span>
            </p>
            </td>
        </tr>
        
        <!-- Header Row 2 -->
        <tr style="height:14.2pt">
            <td style="width:90pt; border-style:solid; border-width:1pt; vertical-align:top; background-color:#d9d9d9">
            <p class="TableParagraph" style="margin-top:2.15pt; margin-left:1.65pt; text-align:center; font-size:10pt">
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.5pt">1</span>
            </p>
            </td>
            <td style="width:90pt; border-style:solid; border-width:1pt; vertical-align:top; background-color:#d9d9d9">
            <p class="TableParagraph" style="margin-top:2.15pt; margin-left:1.65pt; text-align:center; font-size:10pt">
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.5pt">2</span>
            </p>
            </td>
            <td style="width:90pt; border-style:solid; border-width:1pt; vertical-align:top; background-color:#d9d9d9">
            <p class="TableParagraph" style="margin-top:2.15pt; margin-right:0.05pt; margin-left:1.65pt; text-align:center; font-size:10pt">
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.5pt">3</span>
            </p>
            </td>
            <td style="width:90pt; border-style:solid; border-width:1pt; vertical-align:top; background-color:#d9d9d9">
            <p class="TableParagraph" style="margin-top:2.15pt; margin-left:1.65pt; text-align:center; font-size:10pt">
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.5pt">4</span>
            </p>
            </td>
            <td style="width:90pt; border-style:solid; border-width:1pt; vertical-align:top; background-color:#d9d9d9">
            <p class="TableParagraph" style="margin-top:2.15pt; margin-left:1.65pt; text-align:center; font-size:10pt">
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.5pt">5</span>
            </p>
            </td>
            <td style="width:120pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:top; background-color:#d9d9d9">
            <p class="TableParagraph" style="margin-top:1pt; margin-left:1.65pt; text-align:center; font-size:10pt">
                <span style="font-family:Arial; font-size:5.5pt; font-weight:bold; letter-spacing:-0.25pt">o</span>
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.25pt; vertical-align:-3.5pt">C</span>
            </p>
            </td>
        </tr>
        
        <!-- BARIS 1 -->
        <tr style="height:60pt">
            <td style="width:150pt; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:middle; text-align:center; padding:10px">
            <input type="text"   name="buffer_1" style="width:100%; height:50px; text-align:center; font-size:16pt; border:none; outline:none">
            </td>
            <td style="width:90pt; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center; padding:10px">
            <input type="text" name="pembacaan_1_1" style="width:100%; height:50px; text-align:center; font-size:16pt; border:none; outline:none">
            </td>
            <td style="width:90pt; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center; padding:10px">
            <input type="text" name="pembacaan_1_2" style="width:100%; height:50px; text-align:center; font-size:16pt; border:none; outline:none">
            </td>
            <td style="width:90pt; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center; padding:10px">
            <input type="text" name="pembacaan_1_3" style="width:100%; height:50px; text-align:center; font-size:16pt; border:none; outline:none">
            </td>
            <td style="width:90pt; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center; padding:10px">
            <input type="text" name="pembacaan_1_4" style="width:100%; height:50px; text-align:center; font-size:16pt; border:none; outline:none">
            </td>
            <td style="width:90pt; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center; padding:10px">
            <input type="text" name="pembacaan_1_5" style="width:100%; height:50px; text-align:center; font-size:16pt; border:none; outline:none">
            </td>
            <td style="width:120pt; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center; padding:10px">
            <input type="text" name="resolusi_1" style="width:100%; height:50px; text-align:center; font-size:16pt; border:none; outline:none">
            </td>
            <td style="width:120pt; border-top-style:solid; border-top-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:middle; text-align:center; padding:10px">
            <input type="text" name="suhu_1" style="width:100%; height:50px; text-align:center; font-size:16pt; border:none; outline:none">
            </td>
        </tr>
        
        <!-- BARIS 2 -->
        <tr style="height:60pt">
            <td style="width:150pt; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:middle; text-align:center; padding:10px">
            <input type="text" name="buffer_2" style="width:100%; height:50px; text-align:center; font-size:16pt; border:none; outline:none">
            </td>
            <td style="width:90pt; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center; padding:10px">
            <input type="text" name="pembacaan_2_1" style="width:100%; height:50px; text-align:center; font-size:16pt; border:none; outline:none">
            </td>
            <td style="width:90pt; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center; padding:10px">
            <input type="text" name="pembacaan_2_2" style="width:100%; height:50px; text-align:center; font-size:16pt; border:none; outline:none">
            </td>
            <td style="width:90pt; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center; padding:10px">
            <input type="text" name="pembacaan_2_3" style="width:100%; height:50px; text-align:center; font-size:16pt; border:none; outline:none">
            </td>
            <td style="width:90pt; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center; padding:10px">
            <input type="text" name="pembacaan_2_4" style="width:100%; height:50px; text-align:center; font-size:16pt; border:none; outline:none">
            </td>
            <td style="width:90pt; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center; padding:10px">
            <input type="text" name="pembacaan_2_5" style="width:100%; height:50px; text-align:center; font-size:16pt; border:none; outline:none">
            </td>
            <td style="width:120pt; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center; padding:10px">
            <input type="text" name="resolusi_2" style="width:100%; height:50px; text-align:center; font-size:16pt; border:none; outline:none">
            </td>
            <td style="width:120pt; border-top-style:solid; border-top-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:middle; text-align:center; padding:10px">
            <input type="text" name="suhu_2" style="width:100%; height:50px; text-align:center; font-size:16pt; border:none; outline:none">
            </td>
        </tr>
        
        <!-- BARIS 3 -->
        <tr style="height:60pt">
            <td style="width:150pt; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:middle; text-align:center; padding:10px">
            <input type="text" name="buffer_3" style="width:100%; height:50px; text-align:center; font-size:16pt; border:none; outline:none">
            </td>
            <td style="width:90pt; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center; padding:10px">
            <input type="text" name="pembacaan_3_1" style="width:100%; height:50px; text-align:center; font-size:16pt; border:none; outline:none">
            </td>
            <td style="width:90pt; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center; padding:10px">
            <input type="text" name="pembacaan_3_2" style="width:100%; height:50px; text-align:center; font-size:16pt; border:none; outline:none">
            </td>
            <td style="width:90pt; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center; padding:10px">
            <input type="text" name="pembacaan_3_3" style="width:100%; height:50px; text-align:center; font-size:16pt; border:none; outline:none">
            </td>
            <td style="width:90pt; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center; padding:10px">
            <input type="text" name="pembacaan_3_4" style="width:100%; height:50px; text-align:center; font-size:16pt; border:none; outline:none">
            </td>
            <td style="width:90pt; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center; padding:10px">
            <input type="text" name="pembacaan_3_5" style="width:100%; height:50px; text-align:center; font-size:16pt; border:none; outline:none">
            </td>
            <td style="width:120pt; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center; padding:10px">
            <input type="text" name="resolusi_3" style="width:100%; height:50px; text-align:center; font-size:16pt; border:none; outline:none">
            </td>
            <td style="width:120pt; border-top-style:solid; border-top-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:middle; text-align:center; padding:10px">
            <input type="text" name="suhu_3" style="width:100%; height:50px; text-align:center; font-size:16pt; border:none; outline:none">
            </td>
        </tr>
        
        <!-- BARIS 4 -->
        <tr style="height:60pt">
            <td style="width:150pt; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:middle; text-align:center; padding:10px">
            <input type="text" name="buffer_4" style="width:100%; height:50px; text-align:center; font-size:16pt; border:none; outline:none">
            </td>
            <td style="width:90pt; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center; padding:10px">
            <input type="text" name="pembacaan_4_1" style="width:100%; height:50px; text-align:center; font-size:16pt; border:none; outline:none">
            </td>
            <td style="width:90pt; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center; padding:10px">
            <input type="text" name="pembacaan_4_2" style="width:100%; height:50px; text-align:center; font-size:16pt; border:none; outline:none">
            </td>
            <td style="width:90pt; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center; padding:10px">
            <input type="text" name="pembacaan_4_3" style="width:100%; height:50px; text-align:center; font-size:16pt; border:none; outline:none">
            </td>
            <td style="width:90pt; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center; padding:10px">
            <input type="text" name="pembacaan_4_4" style="width:100%; height:50px; text-align:center; font-size:16pt; border:none; outline:none">
            </td>
            <td style="width:90pt; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center; padding:10px">
            <input type="text" name="pembacaan_4_5" style="width:100%; height:50px; text-align:center; font-size:16pt; border:none; outline:none">
            </td>
            <td style="width:120pt; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center; padding:10px">
            <input type="text" name="resolusi_4" style="width:100%; height:50px; text-align:center; font-size:16pt; border:none; outline:none">
            </td>
            <td style="width:120pt; border-top-style:solid; border-top-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:middle; text-align:center; padding:10px">
            <input type="text" name="suhu_4" style="width:100%; height:50px; text-align:center; font-size:16pt; border:none; outline:none">
            </td>
        </tr>
        
        <!-- BARIS 5 -->
        <tr style="height:60pt">
            <td style="width:150pt; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; vertical-align:middle; text-align:center; padding:10px">
            <input type="text" name="buffer_5" style="width:100%; height:50px; text-align:center; font-size:16pt; border:none; outline:none">
            </td>
            <td style="width:90pt; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:middle; text-align:center; padding:10px">
            <input type="text" name="pembacaan_5_1" style="width:100%; height:50px; text-align:center; font-size:16pt; border:none; outline:none">
            </td>
            <td style="width:90pt; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:middle; text-align:center; padding:10px">
            <input type="text" name="pembacaan_5_2" style="width:100%; height:50px; text-align:center; font-size:16pt; border:none; outline:none">
            </td>
            <td style="width:90pt; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:middle; text-align:center; padding:10px">
            <input type="text" name="pembacaan_5_3" style="width:100%; height:50px; text-align:center; font-size:16pt; border:none; outline:none">
            </td>
            <td style="width:90pt; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:middle; text-align:center; padding:10px">
            <input type="text" name="pembacaan_5_4" style="width:100%; height:50px; text-align:center; font-size:16pt; border:none; outline:none">
            </td>
            <td style="width:90pt; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:middle; text-align:center; padding:10px">
            <input type="text" name="pembacaan_5_5" style="width:100%; height:50px; text-align:center; font-size:16pt; border:none; outline:none">
            </td>
            <td style="width:120pt; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:middle; text-align:center; padding:10px">
            <input type="text" name="resolusi_5" style="width:100%; height:50px; text-align:center; font-size:16pt; border:none; outline:none">
            </td>
            <td style="width:120pt; border-top-style:solid; border-top-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:middle; text-align:center; padding:10px">
            <input type="text" name="suhu_5" style="width:100%; height:50px; text-align:center; font-size:16pt; border:none; outline:none">
            </td>
        </tr>
        </table>

        <p style="margin-top:4pt; font-size:10pt">
            <span style="-aw-import:ignore">&#xa0;</span>
        </p>
             
            <table cellspacing="0" cellpadding="0" style="border-collapse: collapse; width: 100%; border: 1px solid black;">
            <tr>
                <td colspan="9" style="border: 1px solid black; padding: 8px; text-align: center; background-color: #f0f0f0;">
                <p style="margin: 0; font-family: Arial; font-size: 14px; font-weight: bold;">
                    Isilah lembar data kalibrasi dengan lengkap dan jelas!
                </p>
                </td>
            </tr>
            <tr>
                <td rowspan="2" style="border: 1px solid black; padding: 8px; text-align: center; width: 25%; background-color: #f9f9f9;">
                <p style="margin: 0; font-size: 11px; font-weight: bold;">Alat Standar</p>
                </td>
                <td colspan="6" style="border: 1px solid black; padding: 8px; text-align: left; background-color: #f9f9f9;">
                <p style="margin: 0; font-size: 11px; font-weight: bold;">CRM Buffer pH, Merck, 4, 7, & 10</p>
                  <input type="hidden" name="alat_standar_text" value="CRM Buffer pH, Merck, 4, 7, & 10">
                </td>
                <td style="border: 1px solid black; padding: 8px; text-align: center; width: 15%; background-color: #f9f9f9;">
                <p style="margin: 0; font-size: 11px; font-weight: bold;">Dikalibrasi oleh</p>
                </td>
                <td style="border: 1px solid black; padding: 8px; text-align: center; width: 15%; background-color: #f9f9f9;">
                <p style="margin: 0; font-size: 11px; font-weight: bold;">Diperiksa oleh</p>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black; padding: 5px; text-align: center; background-color: #f9f9f9;">
                <p style="margin: 0; font-size: 11px;">TES</p>
                </td>
                <td style="border: 1px solid black; padding: 5px; text-align: center;">
                <input type="checkbox" name="alat_standar[]" value="TES" style="width: 16px; height: 16px;">
                </td>
                <td style="border: 1px solid black; padding: 5px;">
                
                </td>
                <td style="border: 1px solid black; padding: 5px; text-align: center; background-color: #f9f9f9;">
                <p style="margin: 0; font-size: 11px;">TFA</p>
                </td>
                <td style="border: 1px solid black; padding: 5px; text-align: center;">
                <input type="checkbox" name="alat_standar[]" value="TFA" style="width: 16px; height: 16px;">
                </td>
                <td style="border: 1px solid black; padding: 5px;">
                
                </td>
                <td rowspan="2" style="border: 1px solid black; padding: 10px; text-align: center; vertical-align: top;">
                <div style="text-align: center; margin-bottom: 15px;">
                    <p style="margin: 0 0 10px 0; font-size: 11px;">TTD :</p>
                    <div style="border-bottom: 1px solid black; width: 80%; margin: 0 auto 15px;"></div>
                    <input type="text" name="calibrated_by" placeholder="Nama" style="width: 90%; padding: 5px; border: 1px solid #ccc; text-align: center; font-size: 11px;"  value="{{ auth()->user()->nama ?? 'System' }}"  readonly>
                </div>
                </td>
                <td rowspan="2" style="border: 1px solid black; padding: 10px; text-align: center; vertical-align: top;">
                <div style="text-align: center; margin-bottom: 15px;">
                    <p style="margin: 0 0 10px 0; font-size: 11px;">TTD :</p>
                    <div style="border-bottom: 1px solid black; width: 80%; margin: 0 auto 15px;"></div>
                    <input type="text" name="verified_by" placeholder="Nama" style="width: 90%; padding: 5px; border: 1px solid #ccc; text-align: center; font-size: 11px;">
                </div>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black; padding: 8px; text-align: center; background-color: #f9f9f9;">
                <p style="margin: 0; font-size: 11px; font-weight: bold;">Metode Kalibrasi</p>
                </td>
                <td colspan="6" style="border: 1px solid black; padding: 8px; text-align: left;">
                <p style="margin: 0; font-size: 11px;">PAS-IK1102-40</p>
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

            const submitBtn = form.querySelector('button[type="submit"]');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
            submitBtn.disabled = true;
        });
        
        // Inisialisasi update kapasitas
        updateKapasitas();
    });

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

    // Fungsi format Type Alat
    function formatTypeAlat(input) {
        const regex = /[^A-Za-z0-9\s.,\-\/()"'&]/g;
        if (regex.test(input.value)) {
            input.value = input.value.replace(regex, '');
        }
    }

    // Fungsi format No. Seri
    function formatNoSeri(input) {
        const regex = /[^A-Za-z0-9.,\-\/]/g;
        if (regex.test(input.value)) {
            input.value = input.value.replace(regex, '');
        }
    }

    // Fungsi untuk format input number
    function formatInputNumber(input) {
        let value = input.value;
        value = value.replace(',', '.');
        
        const dotCount = (value.match(/\./g) || []).length;
        if (dotCount > 1) {
            const firstPart = value.substring(0, value.indexOf('.') + 1);
            const lastPart = value.substring(value.lastIndexOf('.') + 1);
            value = firstPart + lastPart.replace(/\./g, '');
        }
        
        if (value !== input.value) {
            input.value = value;
        }
    }

    // Tambahkan event listener untuk input rentang_ukur_max
    document.getElementById('rentang_ukur_max').addEventListener('input', updateKapasitas);
    document.getElementById('rentang_ukur_max').addEventListener('paste', function() {
        setTimeout(updateKapasitas, 10);
    });
    </script>
</body>
</html>