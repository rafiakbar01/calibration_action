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
                                    <input type="text" name="nama_alat" class="kalibrasi-input" placeholder="Masukkan nama alat..." required>
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
                            <tr>
                                <td>
                                    <p style="margin: 0; color: #000000;">Lokasi PT</p>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="lokasi_pt" class="kalibrasi-input" placeholder="Masukkan Lokasi PT" required>
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

            <select id="jenis_dial_indicator" name="jenis_dial_indicator" class="form-select">
                <option value="">-- Pilih Jenis --</option>
                <option value="0.01">Dial Indicator 0,01 mm (Electronic Gauge Tester 0~50mm)</option>
                <option value="0.001">Dial Indicator 0,001 mm (Dial Gauge Tester 0~25mm)</option>
            </select>

<div class="d-flex justify-content-between gap-4">
    <!-- Tabel Kiri - 0.0 sampai 1.9 -->
    <div style="flex: 1;">
        <table class="kalibrasi-data-table" style="width: 100%;">
            <tr style="background: #d9d9d9;">
                <td style="border: 2px solid #000; padding: 8px; text-align: center;">
                    <span style="font-weight: bold; color: #000000;">Penunjukan Alat (mm)</span>
                </td>
                <td style="border: 2px solid #000; padding: 8px; text-align: center;" colspan="2">
                    <span style="font-weight: bold; color: #000000;">Pembacaan Standard</span>
                </td>
            </tr>
            <tr style="background: #e8e8e8;">
                <td style="border: 2px solid #000; padding: 8px; text-align: center;">
                    <span style="font-weight: bold; color: #000000;">&nbsp;</span>
                </td>
                <td style="border: 2px solid #000; padding: 8px; text-align: center;">
                    <span style="font-weight: bold; color: #000000;">Naik</span>
                </td>
                <td style="border: 2px solid #000; padding: 8px; text-align: center;">
                    <span style="font-weight: bold; color: #000000;">Turun</span>
                </td>
            </tr>

            <!-- Baris data dari 0.0 sampai 1.9 -->
            <!-- Baris 0.0 -->
            <tr>
                <td style="border: 2px solid #000; padding: 0; text-align: center; height: 30px;">
                    <input type="text" name="penunjukanAlat[]" 
                        value="0.0" 
                        onblur="if(this.value.trim()==='') this.value='0.0'" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px; background: transparent;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanNaik[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanTurun[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
            </tr>

            <!-- Baris 0.1 -->
            <tr>
                <td style="border: 2px solid #000; padding: 0; text-align: center; height: 30px;">
                    <input type="text" name="penunjukanAlat[]" 
                        value="0.1" 
                        onblur="if(this.value.trim()==='') this.value='0.1'" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px; background: transparent;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanNaik[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanTurun[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
            </tr>

            <!-- Baris 0.2 -->
            <tr>
                <td style="border: 2px solid #000; padding: 0; text-align: center; height: 30px;">
                    <input type="text" name="penunjukanAlat[]" 
                        value="0.2" 
                        onblur="if(this.value.trim()==='') this.value='0.2'" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px; background: transparent;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanNaik[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanTurun[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
            </tr>

            <!-- Baris 0.3 -->
            <tr>
                <td style="border: 2px solid #000; padding: 0; text-align: center; height: 30px;">
                    <input type="text" name="penunjukanAlat[]" 
                        value="0.3" 
                        onblur="if(this.value.trim()==='') this.value='0.3'" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px; background: transparent;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanNaik[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanTurun[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
            </tr>

            <!-- Baris 0.4 -->
            <tr>
                <td style="border: 2px solid #000; padding: 0; text-align: center; height: 30px;">
                    <input type="text" name="penunjukanAlat[]" 
                        value="0.4" 
                        onblur="if(this.value.trim()==='') this.value='0.4'" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px; background: transparent;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanNaik[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanTurun[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
            </tr>

            <!-- Baris 0.5 -->
            <tr>
                <td style="border: 2px solid #000; padding: 0; text-align: center; height: 30px;">
                    <input type="text" name="penunjukanAlat[]" 
                        value="0.5" 
                        onblur="if(this.value.trim()==='') this.value='0.5'" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px; background: transparent;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanNaik[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanTurun[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
            </tr>

            <!-- Baris 0.6 -->
            <tr>
                <td style="border: 2px solid #000; padding: 0; text-align: center; height: 30px;">
                    <input type="text" name="penunjukanAlat[]" 
                        value="0.6" 
                        onblur="if(this.value.trim()==='') this.value='0.6'" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px; background: transparent;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanNaik[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanTurun[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
            </tr>

            <!-- Baris 0.7 -->
            <tr>
                <td style="border: 2px solid #000; padding: 0; text-align: center; height: 30px;">
                    <input type="text" name="penunjukanAlat[]" 
                        value="0.7" 
                        onblur="if(this.value.trim()==='') this.value='0.7'" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px; background: transparent;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanNaik[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanTurun[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
            </tr>

            <!-- Baris 0.8 -->
            <tr>
                <td style="border: 2px solid #000; padding: 0; text-align: center; height: 30px;">
                    <input type="text" name="penunjukanAlat[]" 
                        value="0.8" 
                        onblur="if(this.value.trim()==='') this.value='0.8'" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px; background: transparent;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanNaik[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanTurun[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
            </tr>

            <!-- Baris 0.9 -->
            <tr>
                <td style="border: 2px solid #000; padding: 0; text-align: center; height: 30px;">
                    <input type="text" name="penunjukanAlat[]" 
                        value="0.9" 
                        onblur="if(this.value.trim()==='') this.value='0.9'" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px; background: transparent;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanNaik[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanTurun[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
            </tr>

            <!-- Baris 1 -->
            <tr>
                <td style="border: 2px solid #000; padding: 0; text-align: center; height: 30px;">
                    <input type="text" name="penunjukanAlat[]" 
                        value="1" 
                        onblur="if(this.value.trim()==='') this.value='1'" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px; background: transparent;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanNaik[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanTurun[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
            </tr>

            <!-- Baris 1.1 -->
            <tr>
                <td style="border: 2px solid #000; padding: 0; text-align: center; height: 30px;">
                    <input type="text" name="penunjukanAlat[]" 
                        value="1.1" 
                        onblur="if(this.value.trim()==='') this.value='1.1'" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px; background: transparent;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanNaik[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanTurun[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
            </tr>

            <!-- Baris 1.2 -->
            <tr>
                <td style="border: 2px solid #000; padding: 0; text-align: center; height: 30px;">
                    <input type="text" name="penunjukanAlat[]" 
                        value="1.2" 
                        onblur="if(this.value.trim()==='') this.value='1.2'" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px; background: transparent;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanNaik[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanTurun[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
            </tr>

            <!-- Baris 1.3 -->
            <tr>
                <td style="border: 2px solid #000; padding: 0; text-align: center; height: 30px;">
                    <input type="text" name="penunjukanAlat[]" 
                        value="1.3" 
                        onblur="if(this.value.trim()==='') this.value='1.3'" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px; background: transparent;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanNaik[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanTurun[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
            </tr>

            <!-- Baris 1.4 -->
            <tr>
                <td style="border: 2px solid #000; padding: 0; text-align: center; height: 30px;">
                    <input type="text" name="penunjukanAlat[]" 
                        value="1.4" 
                        onblur="if(this.value.trim()==='') this.value='1.4'" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px; background: transparent;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanNaik[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanTurun[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
            </tr>

            <!-- Baris 1.5 -->
            <tr>
                <td style="border: 2px solid #000; padding: 0; text-align: center; height: 30px;">
                    <input type="text" name="penunjukanAlat[]" 
                        value="1.5" 
                        onblur="if(this.value.trim()==='') this.value='1.5'" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px; background: transparent;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanNaik[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanTurun[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
            </tr>

            <!-- Baris 1.6 -->
            <tr>
                <td style="border: 2px solid #000; padding: 0; text-align: center; height: 30px;">
                    <input type="text" name="penunjukanAlat[]" 
                        value="1.6" 
                        onblur="if(this.value.trim()==='') this.value='1.6'" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px; background: transparent;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanNaik[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanTurun[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
            </tr>

            <!-- Baris 1.7 -->
            <tr>
                <td style="border: 2px solid #000; padding: 0; text-align: center; height: 30px;">
                    <input type="text" name="penunjukanAlat[]" 
                        value="1.7" 
                        onblur="if(this.value.trim()==='') this.value='1.7'" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px; background: transparent;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanNaik[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanTurun[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
            </tr>

            <!-- Baris 1.8 -->
            <tr>
                <td style="border: 2px solid #000; padding: 0; text-align: center; height: 30px;">
                    <input type="text" name="penunjukanAlat[]" 
                        value="1.8" 
                        onblur="if(this.value.trim()==='') this.value='1.8'" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px; background: transparent;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanNaik[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanTurun[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
            </tr>

            <!-- Baris 1.9 -->
            <tr>
                <td style="border: 2px solid #000; padding: 0; text-align: center; height: 30px;">
                    <input type="text" name="penunjukanAlat[]" 
                        value="1.9" 
                        onblur="if(this.value.trim()==='') this.value='1.9'" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px; background: transparent;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanNaik[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanTurun[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
            </tr>
        </table>
    </div>

    <!-- Tabel Kanan - 2 sampai 50 -->
    <div style="flex: 1;">
        <table class="kalibrasi-data-table" style="width: 100%;">
            <tr style="background: #d9d9d9;">
                <td style="border: 2px solid #000; padding: 8px; text-align: center;">
                    <span style="font-weight: bold; color: #000000;">Penunjukan Alat (mm)</span>
                </td>
                <td style="border: 2px solid #000; padding: 8px; text-align: center;" colspan="2">
                    <span style="font-weight: bold; color: #000000;">Pembacaan Standard</span>
                </td>
            </tr>
            <tr style="background: #e8e8e8;">
                <td style="border: 2px solid #000; padding: 8px; text-align: center;">
                    <span style="font-weight: bold; color: #000000;">&nbsp;</span>
                </td>
                <td style="border: 2px solid #000; padding: 8px; text-align: center;">
                    <span style="font-weight: bold; color: #000000;">Naik</span>
                </td>
                <td style="border: 2px solid #000; padding: 8px; text-align: center;">
                    <span style="font-weight: bold; color: #000000;">Turun</span>
                </td>
            </tr>

            <!-- Baris data dari 2 sampai 50 -->
            <!-- Baris 2 -->
            <tr>
                <td style="border: 2px solid #000; padding: 0; text-align: center; height: 30px;">
                    <input type="text" name="penunjukanAlat[]" 
                        value="2" 
                        onblur="if(this.value.trim()==='') this.value='2'" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px; background: transparent;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanNaik[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanTurun[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
            </tr>

            <!-- Baris 2.5 -->
            <tr>
                <td style="border: 2px solid #000; padding: 0; text-align: center; height: 30px;">
                    <input type="text" name="penunjukanAlat[]" 
                        value="2.5" 
                        onblur="if(this.value.trim()==='') this.value='2.5'" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px; background: transparent;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanNaik[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanTurun[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
            </tr>

            <!-- Baris 3 -->
            <tr>
                <td style="border: 2px solid #000; padding: 0; text-align: center; height: 30px;">
                    <input type="text" name="penunjukanAlat[]" 
                        value="3" 
                        onblur="if(this.value.trim()==='') this.value='3'" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px; background: transparent;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanNaik[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanTurun[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
            </tr>

            <!-- Baris 3.5 -->
            <tr>
                <td style="border: 2px solid #000; padding: 0; text-align: center; height: 30px;">
                    <input type="text" name="penunjukanAlat[]" 
                        value="3.5" 
                        onblur="if(this.value.trim()==='') this.value='3.5'" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px; background: transparent;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanNaik[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanTurun[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
            </tr>

            <!-- Baris 4 -->
            <tr>
                <td style="border: 2px solid #000; padding: 0; text-align: center; height: 30px;">
                    <input type="text" name="penunjukanAlat[]" 
                        value="4" 
                        onblur="if(this.value.trim()==='') this.value='4'" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px; background: transparent;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanNaik[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanTurun[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
            </tr>

            <!-- Baris 4.5 -->
            <tr>
                <td style="border: 2px solid #000; padding: 0; text-align: center; height: 30px;">
                    <input type="text" name="penunjukanAlat[]" 
                        value="4.5" 
                        onblur="if(this.value.trim()==='') this.value='4.5'" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px; background: transparent;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanNaik[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanTurun[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
            </tr>

            <!-- Baris 5 -->
            <tr>
                <td style="border: 2px solid #000; padding: 0; text-align: center; height: 30px;">
                    <input type="text" name="penunjukanAlat[]" 
                        value="5" 
                        onblur="if(this.value.trim()==='') this.value='5'" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px; background: transparent;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanNaik[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanTurun[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
            </tr>

            <!-- Baris 6 -->
            <tr>
                <td style="border: 2px solid #000; padding: 0; text-align: center; height: 30px;">
                    <input type="text" name="penunjukanAlat[]" 
                        value="6" 
                        onblur="if(this.value.trim()==='') this.value='6'" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px; background: transparent;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanNaik[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanTurun[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
            </tr>

            <!-- Baris 7 -->
            <tr>
                <td style="border: 2px solid #000; padding: 0; text-align: center; height: 30px;">
                    <input type="text" name="penunjukanAlat[]" 
                        value="7" 
                        onblur="if(this.value.trim()==='') this.value='7'" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px; background: transparent;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanNaik[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanTurun[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
            </tr>

            <!-- Baris 8 -->
            <tr>
                <td style="border: 2px solid #000; padding: 0; text-align: center; height: 30px;">
                    <input type="text" name="penunjukanAlat[]" 
                        value="8" 
                        onblur="if(this.value.trim()==='') this.value='8'" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px; background: transparent;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanNaik[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanTurun[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
            </tr>

            <!-- Baris 9 -->
            <tr>
                <td style="border: 2px solid #000; padding: 0; text-align: center; height: 30px;">
                    <input type="text" name="penunjukanAlat[]" 
                        value="9" 
                        onblur="if(this.value.trim()==='') this.value='9'" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px; background: transparent;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanNaik[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanTurun[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
            </tr>

            <!-- Baris 10 -->
            <tr>
                <td style="border: 2px solid #000; padding: 0; text-align: center; height: 30px;">
                    <input type="text" name="penunjukanAlat[]" 
                        value="10" 
                        onblur="if(this.value.trim()==='') this.value='10'" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px; background: transparent;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanNaik[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanTurun[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
            </tr>

            <!-- Baris 15 -->
            <tr>
                <td style="border: 2px solid #000; padding: 0; text-align: center; height: 30px;">
                    <input type="text" name="penunjukanAlat[]" 
                        value="15" 
                        onblur="if(this.value.trim()==='') this.value='15'" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px; background: transparent;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanNaik[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanTurun[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
            </tr>

            <!-- Baris 20 -->
            <tr>
                <td style="border: 2px solid #000; padding: 0; text-align: center; height: 30px;">
                    <input type="text" name="penunjukanAlat[]" 
                        value="20" 
                        onblur="if(this.value.trim()==='') this.value='20'" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px; background: transparent;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanNaik[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanTurun[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
            </tr>

            <!-- Baris 25 -->
            <tr>
                <td style="border: 2px solid #000; padding: 0; text-align: center; height: 30px;">
                    <input type="text" name="penunjukanAlat[]" 
                        value="25" 
                        onblur="if(this.value.trim()==='') this.value='25'" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px; background: transparent;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanNaik[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanTurun[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
            </tr>

            <!-- Baris 30 -->
            <tr>
                <td style="border: 2px solid #000; padding: 0; text-align: center; height: 30px;">
                    <input type="text" name="penunjukanAlat[]" 
                        value="30" 
                        onblur="if(this.value.trim()==='') this.value='30'" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px; background: transparent;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanNaik[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanTurun[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
            </tr>

            <!-- Baris 40 -->
            <tr>
                <td style="border: 2px solid #000; padding: 0; text-align: center; height: 30px;">
                    <input type="text" name="penunjukanAlat[]" 
                        value="40" 
                        onblur="if(this.value.trim()==='') this.value='40'" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px; background: transparent;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanNaik[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanTurun[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
            </tr>

            <!-- Baris 50 -->
            <tr>
                <td style="border: 2px solid #000; padding: 0; text-align: center; height: 30px;">
                    <input type="text" name="penunjukanAlat[]" 
                        value="50" 
                        onblur="if(this.value.trim()==='') this.value='50'" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px; background: transparent;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanNaik[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanTurun[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
            </tr>

            <!-- Baris kosong untuk input manual -->
            <tr>
                <td style="border: 2px solid #000; padding: 0; text-align: center; height: 30px;">
                    <input type="text" name="penunjukanAlat[]" 
                        value="" 
                        onblur="if(this.value.trim()==='') this.value=''" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px; background: transparent;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanNaik[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
                <td style="border: 2px solid #000; padding: 0;">
                    <input type="text" name="pembacaanTurun[]" 
                        oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                        style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; color: #000; padding: 2px;">
                </td>
            </tr>
        </table>
    </div>
</div>

                    <!-- Repeatability Section -->
            <p class="medium-text" style="margin-top:5.1pt; margin-left:10.2pt; margin-bottom:1.05pt; font-size: 10pt;">
                <span class="letter-spacing-neg-01">Repeatability</span>
                <span class="letter-spacing-06"></span>
                <span class="letter-spacing-neg-05">:</span>
            </p>

            <table class="repeatability-table" style="width: 100%; border-collapse: collapse;">
                        
                            <!-- Baris 1 -->
                <tr style="height: 20pt;">
                    <td style="width: 49.05pt; border: 1px solid #000;">
                        <input type="text" name="ulangan01" style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; background: transparent;">
                    </td>
                    <td style="width: 51.2pt; border: 1px solid #000;">
                        <input type="text" name="ulangan02" style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; background: transparent;">
                    </td>
                    <td style="width: 51.2pt; border: 1px solid #000;">
                        <input type="text" name="ulangan03" style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; background: transparent;">
                    </td>
                    <td style="width: 57.05pt; border: 1px solid #000;">
                        <input type="text" name="ulangan04" style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; background: transparent;">
                    </td>
                    <td style="width: 57.05pt; border: 1px solid #000;">
                        <input type="text" name="ulangan05" style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; background: transparent;">
                    </td>
                </tr>
                
                <!-- Baris 2 -->
                <tr style="height: 20pt;">
                    <td style="width: 49.05pt; border: 1px solid #000;">
                        <input type="text" name="ulangan06" style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; background: transparent;">
                    </td>
                    <td style="width: 51.2pt; border: 1px solid #000;">
                        <input type="text" name="ulangan07" style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; background: transparent;">
                    </td>
                    <td style="width: 57.1pt; border: 1px solid #000;">
                        <input type="text" name="ulangan08" style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; background: transparent;">
                    </td>
                    <td style="width: 57.05pt; border: 1px solid #000;">
                        <input type="text" name="ulangan09" style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; background: transparent;">
                    </td>
                    <td style="width: 57.05pt; border: 1px solid #000;">
                        <input type="text" name="ulangan10" style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; background: transparent;">
                    </td>
                </tr>
                

                         <!-- Baris 3 -->
                         <tr style="height: 18pt;">
                        <td colspan="2" rowspan="3" style="width: 101.25pt; border: 1px solid #000; vertical-align: top;">
                            <p style="margin-top: 8pt; font-size: 10pt;">&#xa0;</p>
                            <p style="margin-left: 28.05pt; font-size: 10pt;">
                                <span>Alat</span>
                                <span class="letter-spacing-neg-01"> Standar</span>
                            </p>
                        </td>
                        <td style="width: 3.62pt; border: 1px solid #000; text-align: center; vertical-align: middle;">
                            <input type="checkbox" name="alat_standar[]" value="dial_gauge_tester_0_25mm" class="alat-standar-checkbox" style="transform: scale(1);">
                        </td>
                        <td colspan="3" style="width: 151.93pt; border: 1px solid #000; vertical-align: middle;">
                            <p style="margin-top: 3pt; margin-left: 10.4pt; font-size: 9.5pt;">
                                <span>Dial</span>
                                <span class="letter-spacing-035"></span>
                                <span>Gauge</span>
                                <span class="letter-spacing-05"></span>
                                <span>Tester</span>
                                <span class="letter-spacing-035"></span>
                                <span class="letter-spacing-neg-01">0~25mm</span>
                            </p>
                        </td>
                        <td style="width: 115.15pt; border: 1px solid #000; vertical-align: top;">
                            <p style="margin-top: 1.8pt; margin-left: 29.55pt; font-size: 10pt;">
                                <span>Dikalibrasi</span>
                                <span class="letter-spacing-neg-035"></span>
                                <span class="letter-spacing-neg-02">oleh</span>
                            </p>
                        </td>
                        <td style="width: 113.9pt; border: 1px solid #000; vertical-align: top;">
                            <p style="margin-top: 1.8pt; margin-left: 30.9pt; font-size: 10pt;">
                                <span>Diperiksa</span>
                                <span class="letter-spacing-neg-03"></span>
                                <span class="letter-spacing-neg-02">oleh</span>
                            </p>
                        </td>
                    </tr>

                    <!-- Baris 4 -->
                    <tr style="height: 18pt;">
                        <td style="width: 3.62pt; border: 1px solid #000; text-align: center; vertical-align: middle;">
                            <input type="checkbox" name="alat_standar[]" value="electronic_gauge_tester_0_50mm" class="alat-standar-checkbox" style="transform: scale(1);">
                        </td>
                        <td colspan="3" style="width: 151.93pt; border: 1px solid #000; vertical-align: middle;">
                            <p style="margin-top: 3pt; margin-left: 10.4pt; font-size: 9.5pt;">
                                <span>Electronic</span>
                                <span class="letter-spacing-05"></span>
                                <span>Gauge</span>
                                <span class="letter-spacing-065"></span>
                                <span>Tester</span>
                                <span class="letter-spacing-045"></span>
                                <span class="letter-spacing-neg-01">0~50mm</span>
                            </p>
                        </td>
                        <td rowspan="3" style="width: 115.15pt; border: 1px solid #000; vertical-align: top;">
                            <p style="margin-top: 8pt; font-size: 10pt;">&#xa0;</p>
                            <p style="margin-left: 1.6pt; font-size: 10pt;">
                                <span>TTD</span>
                                <span class="letter-spacing-neg-025"></span>
                                <span class="letter-spacing-neg-05">:</span>
                            </p>
                            <p style="margin-top: 2.3pt; font-size: 10pt;">&#xa0;</p>
                            <p style="margin-left: 1.6pt; line-height: 10pt;">
                                <span style="font-size: 10pt;">Nama</span>
                                <span style="font-size: 10pt; letter-spacing-neg-025"></span>
                                <span style="font-size: 10pt; letter-spacing-neg-05">:</span>
                                <input type="text" name="nama_dikalibrasi" style="width: 60%; border: none; border-bottom: 1px solid #000; margin-left: 5px; font-size: 9pt; background: transparent;">
                            </p>
                        </td>
                        <td rowspan="3" style="width: 113.9pt; border: 1px solid #000; vertical-align: top;">
                            <p style="margin-top: 8pt; font-size: 10pt;">&#xa0;</p>
                            <p style="margin-left: 1.65pt; font-size: 10pt;">
                                <span>TTD</span>
                                <span class="letter-spacing-neg-025"></span>
                                <span class="letter-spacing-neg-05">:</span>
                            </p>
                            <p style="margin-top: 2.3pt; font-size: 10pt;">&#xa0;</p>
                            <p style="margin-left: 1.65pt; line-height: 10pt;">
                                <span style="font-size: 10pt;">Nama</span>
                                <span style="font-size: 10pt; letter-spacing-neg-025"></span>
                                <span style="font-size: 10pt; letter-spacing-neg-05">:</span>
                                <input type="text" name="nama_diperiksa" style="width: 60%; border: none; border-bottom: 1px solid #000; margin-left: 5px; font-size: 9pt; background: transparent;">
                            </p>
                        </td>
                    </tr>

                    <!-- Baris 5 -->
                    <tr style="height: 15pt;">
                        <td style="width: 3.62pt; border: 1px solid #000; text-align: center; vertical-align: middle;">
                            <input type="checkbox" name="alat_standar[]" value="alat_standar_lainnya" class="alat-standar-checkbox" style="transform: scale(1);">
                        </td>
                        <td colspan="3" style="width: 151.93pt; border: 1px solid #000; vertical-align: middle;">
                            <p style="margin-top: 0.5pt; margin-left: 10.4pt;">
                                <input type="text" name="alat_standar_tambahan" placeholder="........................................." 
                                    style="width: 95%; border: none; font-size: 9pt; padding: 2px; background: transparent;">
                            </p>
                        </td>
                    </tr>

                <!-- Baris 6 -->
                <tr style="height: 22pt;">
                    <td colspan="2" style="width: 101.25pt; border: 1px solid #000;">
                        <p style="margin-top: 5.75pt; margin-left: 19.75pt; font-size: 10pt;">
                            <span>Metode</span>
                            <span class="letter-spacing-neg-05"></span>
                            <span class="letter-spacing-neg-01">Kalibrasi</span>
                        </p>
                    </td>
                    <td colspan="5" style="width: 173.2pt; border: 1px solid #000;">
                        <p style="margin-top: 0.8pt; margin-left: 8.95pt; line-height: 11pt; font-size: 9.5pt;">
                            <span>PAS-IK1102-03 (JIS B 7503:2017 (JMA/JSA); SNSU PK.P-03:2020).</span>
                        </p>
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
    </script>

</body>
</html>

