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
        <!-- resources/views/formhtml/dial_test_indicator.blade.php -->
       <form method="POST" action="/calibrations" id="kalibrasiForm">
        @csrf
        <input type="hidden" name="form_type" value="bore_gauge">
        <!--<input type="hidden" name="resolution" value="{{ $resolution ?? '' }}">-->
            <div class="form-kalibrasi-container">
                <table class="kalibrasi-header-table">
                    <tr>
                        <td colspan="2">
                            <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK58</p>
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
                            <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">BORE GAUGE</p>
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
                                <!-- Hidden input untuk form type -->
                                 
                                
                                <select name="nama_alat" id="nama_alat_select" class="kalibrasi-input" onchange="updateFormType(this.value)" required style="background-color: #f5f5f5; color: #333; border: 1px solid #ced4da; padding: 6px 10px; border-radius: 4px; width: 100%;">
                                    <option value="">-- Pilih Alat --</option>
                                    <option value="Bore Gauge">Bore Gauge</option>
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
                                    <td class="bg-light fw-bold" style="color: #000000;">Suhu (&deg;C)</td>
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
            <style>
/* Kalibrasi Data Table - Versi Rapi & Bersih */
.kalibrasi-data-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 11pt;
    font-family: Arial, Helvetica, sans-serif;
    table-layout: fixed;
}

.kalibrasi-data-table th,
.kalibrasi-data-table td {
    border: 1px solid #000;
    padding: 8px 6px;
    text-align: center;
    vertical-align: middle;
}

.kalibrasi-data-table thead th {
    background-color: #d9d9d9;
    font-weight: bold;
    border: 2px solid #000;
}

.kalibrasi-data-table .sub-header th {
    background-color: #e8e8e8;
    font-weight: 600;
    border: 2px solid #000;
}

.kalibrasi-data-table .penunjukan-input input[type="text"] {
    width: 100%;
    height: 32px;
    border: none;
    background: transparent;
    text-align: center;
    font-size: 11pt;
    padding: 2px;
    box-sizing: border-box;
}

.kalibrasi-data-table input[type="text"]:focus {
    outline: none;
    background-color: rgba(74, 144, 226, 0.08);
}

.kalibrasi-data-table input[type="text"] {
    width: 100%;
    border: none;
    background: transparent;
    text-align: center;
    font-size: 11pt;
}

.kalibrasi-wrapper {
    display: flex;
    gap: 24px;
    margin-top: 16px;
}

.kalibrasi-wrapper > div {
    flex: 1;
    min-width: 0;
}

@media (max-width: 992px) {
    .kalibrasi-wrapper {
        flex-direction: column;
        gap: 32px;
    }
}
</style>



<!-- HIDDEN INPUT SKALA -->
<style>
/* Kalibrasi Data Table - Versi Rapi & Bersih */
.kalibrasi-data-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 11pt;
    font-family: Arial, Helvetica, sans-serif;
    table-layout: fixed;
}

.kalibrasi-data-table th,
.kalibrasi-data-table td {
    border: 1px solid #000;
    padding: 8px 6px;
    text-align: center;
    vertical-align: middle;
}

.kalibrasi-data-table thead th {
    background-color: #d9d9d9;
    font-weight: bold;
    border: 2px solid #000;
}

.kalibrasi-data-table .sub-header th {
    background-color: #e8e8e8;
    font-weight: 600;
    border: 2px solid #000;
}

.kalibrasi-data-table .penunjukan-input input[type="text"] {
    width: 100%;
    height: 32px;
    border: none;
    background: transparent;
    text-align: center;
    font-size: 11pt;
    padding: 2px;
    box-sizing: border-box;
}

.kalibrasi-data-table input[type="text"]:focus {
    outline: none;
    background-color: rgba(74, 144, 226, 0.08);
}

.kalibrasi-data-table input[type="text"] {
    width: 100%;
    border: none;
    background: transparent;
    text-align: center;
    font-size: 11pt;
}

.kalibrasi-wrapper {
    display: flex;
    gap: 24px;
    margin-top: 16px;
}

.kalibrasi-wrapper > div {
    flex: 1;
    min-width: 0;
}

@media (max-width: 992px) {
    .kalibrasi-wrapper {
        flex-direction: column;
        gap: 32px;
    }
}
</style>

<div class="data-kalibrasi-header" style="color: #000000; font-size: 14pt; font-weight: bold; margin-bottom: 16px;">
    DATA KALIBRASI
</div>

<div class="kalibrasi-wrapper">
    <!-- Tabel Kiri: 20 baris -->
    <div>
        <table class="kalibrasi-data-table">
            <thead>
                 <tr>
                    <th colspan="3">Uji Skala Nominal (Bagian Bawah)</th>
                 </tr>
                <tr class="sub-header">
                    <th>
                        Penunjukan Alat
                        <div style="font-weight: normal; margin-top: 2px;">
                            ( <input type="text" 
                                     name="satuan_unit_bawah" 
                                     value=""
                                     style="width: 50px; border: none; background: transparent; text-align: center; font-weight: bold; display: inline-block;">
                            )
                        </div>
                    </th>
                    <th>Pembacaan Standard - Naik</th>
                    <th>Pembacaan Standard - Turun</th>
                 </tr>
            </thead>
            <tbody>
                @for($i = 0; $i < 20; $i++)
                    @php
                        $value = ($i <= 10) ? number_format($i * 0.1, 1) : '';
                    @endphp
                     <tr>
                        <td class="penunjukan-input">
                            <input type="text" name="penunjukanAlat[]"
                                   value="{{ $value }}"
                                   placeholder="{{ $i > 10 ? '' : '' }}"
                                   style="font-weight: {{ $i <= 10 ? '500' : 'normal' }};">
                         </td>
                         <td>
                            <input type="text" name="pembacaanNaik[]">
                         </td>
                         <td>
                            <input type="text" name="pembacaanTurun[]">
                         </td>
                     </tr>
                @endfor
            </tbody>
         </table>
    </div>

    <!-- Tabel Kanan: 20 baris -->
    <div>
        <table class="kalibrasi-data-table">
            <thead>
                 <tr>
                    <th colspan="3">Uji Skala Nominal (Bagian Atas / Lanjutan)</th>
                 </tr>
                <tr class="sub-header">
                    <th>
                        Penunjukan Alat
                        <div style="font-weight: normal; margin-top: 2px;">
                            ( <input type="text" 
                                     name="satuan_unit_atas" 
                                     value=""
                                     style="width: 50px; border: none; background: transparent; text-align: center; font-weight: bold; display: inline-block;">
                            )
                        </div>
                    </th>
                    <th>Pembacaan Standard - Naik</th>
                    <th>Pembacaan Standard - Turun</th>
                 </tr>
            </thead>
            <tbody>
                @for($i = 0; $i < 20; $i++)
                     <tr>
                        <td class="penunjukan-input">
                            <input type="text" name="penunjukanAlat[]" placeholder="Masukkan nilai">
                         </td>
                         <td>
                            <input type="text" name="pembacaanNaik[]">
                         </td>
                         <td>
                            <input type="text" name="pembacaanTurun[]">
                         </td>
                     </tr>
                @endfor
            </tbody>
         </table>
    </div>
</div>

<!-- Repeatability Section -->
<style>
.repeatability-section {
    margin: 12px 0 20px 0;
}

.repeatability-title {
    font-size: 10pt;
    font-weight: 600;
    margin: 0 0 6px 12px;
}

.repeatability-table {
    width: 100%;
    max-width: 380px;
    border-collapse: collapse;
    font-size: 9pt;
    font-family: Arial, Helvetica, sans-serif;
}

.repeatability-table td {
    border: 1px solid #000;
    padding: 3px 4px;
    height: 18pt;
    text-align: center;
    vertical-align: middle;
}

.repeatability-table input[type="text"],
.repeatability-table input[type="number"] {
    width: 100%;
    height: 100%;
    border: none;
    background: transparent;
    text-align: center;
    font-size: 9pt;
    padding: 1px;
    box-sizing: border-box;
}
</style>

<div class="repeatability-section">
    <p class="repeatability-title" style="display: inline-block; margin-right: 10px;">Repeatability :</p>
    <input type="text" name="repeatability" style="width: 100px; border: none; border-bottom: 1px solid #000; background: transparent; text-align: center;">

    <table class="repeatability-table" style="margin-top: 10px;">
        <tr>
            <td><input type="text" name="rep01"></td>
            <td><input type="text" name="rep02"></td>
            <td><input type="text" name="rep03"></td>
            <td><input type="text" name="rep04"></td>
            <td><input type="text" name="rep05"></td>
        </tr>
        <tr>
            <td><input type="text" name="rep06"></td>
            <td><input type="text" name="rep07"></td>
            <td><input type="text" name="rep08"></td>
            <td><input type="text" name="rep09"></td>
            <td><input type="text" name="rep10"></td>
        </tr>
    </table>
</div>

<!-- SPASI ANTARA DUA TABEL -->
<div style="height: 25px;"></div>
<!-- ATAU bisa pakai ini jika lebih suka: -->
<!-- <br><br><br> -->

<!-- Tabel Alat Standar + Metode Kalibrasi -->
<table style="width: 100%; border-collapse: collapse; font-family: Arial, Helvetica, sans-serif; font-size: 9.5pt;">
    <!-- Header Alat Standar (rowspan 3) -->
    <tr style="height: 18pt;">
        <td rowspan="3" style="width: 101.25pt; border: 1px solid #000; vertical-align: top; background-color: #f8f8f8;">
            <p style="margin: 12pt 0 0 20pt; font-size: 10pt; font-weight: bold;">
                Alat Standar
            </p>
        </td>

        <!-- Baris 1: Dial Gauge Tester 0~25mm -->
        <td style="width: 38px; border: 1px solid #000; text-align: center; vertical-align: middle;">
            <input type="checkbox" name="alat_standar[]" value="Dial Gauge Tester 0~25mm" 
                   class="alat-standar-checkbox" 
                   style="width: 16px; height: 16px; accent-color: #0066cc; cursor: pointer;">
        </td>
        <td style="width: 152pt; border: 1px solid #000; vertical-align: middle; padding-left: 12px;">
            Dial Gauge Tester 0~25mm
        </td>

        <!-- Dikalibrasi oleh & Diperiksa oleh (rowspan 3) -->
        <td rowspan="3" style="width: 115pt; border: 1px solid #000; vertical-align: top; padding: 8px 10px;">
            <div style="margin-bottom: 6px;">
                <strong>Dikalibrasi oleh</strong>
            </div>
            <div style="margin: 8px 0;">
                TTD : ________________________
            </div>
            <div>
                Nama : 
                <input type="text" name="calibrated_by" 
                       style="width: 65%; border: none; border-bottom: 1px solid #000; 
                              font-size: 9.5pt; background: transparent; margin-left: 8px;"  value="{{ auth()->user()->nama ?? 'System' }}"  readonly>
            </div>
        </td>

        <td rowspan="3" style="width: 114pt; border: 1px solid #000; vertical-align: top; padding: 8px 10px;">
            <div style="margin-bottom: 6px;">
                <strong>Diperiksa oleh</strong>
            </div>
            <div style="margin: 8px 0;">
                TTD : ________________________
            </div>
            <div>
                Nama : 
                <input type="text" name="verified_by" 
                       style="width: 65%; border: none; border-bottom: 1px solid #000; 
                              font-size: 9.5pt; background: transparent; margin-left: 8px;" readonly>
            </div>
        </td>
    </tr>

    <!-- Baris 2: Dial Indicator 1 mm -->
    <tr style="height: 18pt;">
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle;">
            <input type="checkbox" name="alat_standar[]" value="Dial Indicator 1 mm" 
                   class="alat-standar-checkbox" 
                   style="width: 16px; height: 16px; accent-color: #0066cc; cursor: pointer;">
        </td>
        <td style="border: 1px solid #000; vertical-align: middle; padding-left: 12px;">
            Dial Indicator 1 mm
        </td>
    </tr>

    <!-- Baris 3: Lainnya -->
    <tr style="height: 18pt;">
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle;">
            <input type="checkbox" name="alat_standar[]" value="lainnya" 
                   id="alat_standar_lainnya_checkbox" 
                   class="alat-standar-checkbox" 
                   style="width: 16px; height: 16px; accent-color: #0066cc; cursor: pointer;">
        </td>
        <td style="border: 1px solid #000; vertical-align: middle; padding: 4px 12px;">
            <input type="text" name="alat_standar_tambahan" 
                   id="alat_standar_tambahan_input"
                   placeholder="Lainnya :................................................"
                   style="width: 100%; border: none; border-bottom: 1px dotted #666; 
                          font-size: 9.5pt; background: transparent; padding: 2px 0;"
                   >
        </td>
    </tr>

    <!-- Metode Kalibrasi -->
    <tr style="height: 24pt;">
        <td colspan="2" style="border: 1px solid #000; vertical-align: middle; background-color: #f8f8f8;">
            <p style="margin: 0; padding-left: 18px; font-size: 10pt; font-weight: bold;">
                Metode Kalibrasi
            </p>
        </td>
        <td colspan="3" style="border: 1px solid #000; vertical-align: middle; padding-left: 12px;">
            <p style="margin: 0; font-size: 9.5pt;">
                PAS-IK1102-58 (berdasarkan JIS B 7515-1982)
            </p>
        </td>
    </tr>
</table>

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
    console.log(`ðŸ”„ Global active tab updated to: ${tabId}`);
}

// ==========================================
// FUNGSI UNTUK MENONAKTIFKAN REQUIRED PADA FORM YANG TIDAK VISIBLE
// ==========================================
function disableRequiredOnHiddenForms() {
    console.log('ðŸ”§ disableRequiredOnHiddenForms called');
    
    const allForms = document.querySelectorAll('form[id^="kalibrasiForm"]');
    
    allForms.forEach((form, index) => {
        const formIndex = index + 1;
        const container = form.closest('.lk-form-container');
        const isVisible = container && window.getComputedStyle(container).display !== 'none';
        
        console.log(`ðŸ“Œ Form ${formIndex}: isVisible=${isVisible}`);
        
        const requiredInputs = form.querySelectorAll('[required]');
        
        if (!isVisible) {
            requiredInputs.forEach(input => {
                console.log(`ðŸ”§ Disabling required for: ${input.name}`);
                input.removeAttribute('required');
                input.setAttribute('data-required-temp', 'true');
            });
        } else {
            requiredInputs.forEach(input => {
                if (input.hasAttribute('data-required-temp')) {
                    console.log(`ðŸ”§ Re-enabling required for: ${input.name}`);
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
    console.log('ðŸŽ‰ handleSaveSuccess called for tab:', tabId, data);
    
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

    const formName = container.getAttribute('data-form-name') || 'bore_gauge';
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
            title: 'âœ“ Data Tersimpan!',
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
    
    // CARI FORM
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
    
    // NONAKTIFKAN VALIDASI BROWSER
    form.setAttribute('novalidate', 'novalidate');
    form.noValidate = true;
    
    // =========================================================
    // VALIDASI ALAT STANDAR - UNTUK bore_gauge (VERSI CHECKBOX)
    // =========================================================
    let alatStandarValues = [];
    
    // 1. Ambil nilai dari checkbox alat_standar[] yang dicentang
    const selectedCheckboxes = form.querySelectorAll('input[name="alat_standar[]"]:checked');
    
    if (selectedCheckboxes.length === 0) {
        alert('Pilih minimal satu Alat Standar (Dial Gauge Tester 0~25mm, Dial Indicator 1 mm, atau Lainnya)!');
        return;
    }
    
    // 2. Proses setiap checkbox yang dipilih
    let hasLainnyaWithValue = false;
    
    selectedCheckboxes.forEach(checkbox => {
        const value = checkbox.value;
        
        if (value === 'lainnya') {
            // Jika "Lainnya" dipilih, ambil dari input text alat_standar_tambahan
            const lainnyaInput = form.querySelector('input[name="alat_standar_tambahan"]');
            if (lainnyaInput && lainnyaInput.value.trim() !== '') {
                const lainnyaValue = lainnyaInput.value.trim();
                alatStandarValues.push(lainnyaValue);
                hasLainnyaWithValue = true;
            } else {
                // Jika checkbox "Lainnya" dicentang tapi tidak diisi
                alert('Silakan isi Alat Standar Lainnya terlebih dahulu!');
                throw new Error('Lainnya input kosong');
            }
        } else {
            // Nilai preset: dial_gauge_tester_0_25mm atau dial_indicator_1mm
            let displayValue = '';
            if (value === 'dial_gauge_tester_0_25mm') {
                displayValue = 'Dial Gauge Tester 0~25mm';
            } else if (value === 'dial_indicator_1mm') {
                displayValue = 'Dial Indicator 1 mm';
            } else {
                displayValue = value;
            }
            alatStandarValues.push(displayValue);
        }
    });
    
    // Validasi khusus untuk checkbox "Lainnya"
    const lainnyaCheckbox = form.querySelector('input[name="alat_standar[]"][value="lainnya"]');
    if (lainnyaCheckbox && lainnyaCheckbox.checked && !hasLainnyaWithValue) {
        return; // alert sudah ditampilkan di atas
    }
    
    if (alatStandarValues.length === 0) {
        alert('Alat standar belum lengkap! Silakan pilih atau isi alat standar.');
        return;
    }
    
    console.log('✅ Alat standar valid:', alatStandarValues);
    
    // =========================================================
    // VALIDASI DATA DETAIL - UNTUK bore_gauge
    // Menggunakan penunjukanAlat[], pembacaanNaik[], pembacaanTurun[]
    // =========================================================
    let hasDetailData = false;
    
    // Ambil semua nilai dari array inputs
    const penunjukanAlatInputs = form.querySelectorAll('input[name="penunjukanAlat[]"]');
    const pembacaanNaikInputs = form.querySelectorAll('input[name="pembacaanNaik[]"]');
    const pembacaanTurunInputs = form.querySelectorAll('input[name="pembacaanTurun[]"]');
    
    // Cek apakah ada data di penunjukanAlat
    for (let i = 0; i < penunjukanAlatInputs.length; i++) {
        const value = penunjukanAlatInputs[i]?.value;
        if (value && value.trim() !== '') {
            hasDetailData = true;
            break;
        }
    }
    
    // Jika belum ada, cek pembacaanNaik
    if (!hasDetailData) {
        for (let i = 0; i < pembacaanNaikInputs.length; i++) {
            const value = pembacaanNaikInputs[i]?.value;
            if (value && value.trim() !== '') {
                hasDetailData = true;
                break;
            }
        }
    }
    
    // Jika belum ada, cek pembacaanTurun
    if (!hasDetailData) {
        for (let i = 0; i < pembacaanTurunInputs.length; i++) {
            const value = pembacaanTurunInputs[i]?.value;
            if (value && value.trim() !== '') {
                hasDetailData = true;
                break;
            }
        }
    }
    
    if (!hasDetailData) {
        if (!confirm('Belum ada data pengukuran yang diisi. Lanjutkan menyimpan?')) {
            return;
        }
    }
    
    console.log('📊 Detail data valid:', { hasDetailData });
    
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
        
        // Hapus field alat_standar[] yang lama (checkbox values asli)
        formData.delete('alat_standar[]');
        
        // Tambahkan alat standar yang sudah diformat
        alatStandarValues.forEach(value => {
            formData.append('alat_standar[]', value);
        });
        
        // Tambahkan field wajib yang mungkin kosong
        formData.append('form_type', 'bore_gauge');
        
        // Set rentang ukur default jika kosong
        if (!formData.has('rentang_ukur_min') || formData.get('rentang_ukur_min') === '') {
            formData.append('rentang_ukur_min', '0');
        }
        if (!formData.has('rentang_ukur_max') || formData.get('rentang_ukur_max') === '') {
            formData.append('rentang_ukur_max', '0');
        }
        
        // Pastikan satuan_unit_bawah dan satuan_unit_atas ada (meskipun kosong)
        if (!formData.has('satuan_unit_bawah')) {
            formData.append('satuan_unit_bawah', '');
        }
        if (!formData.has('satuan_unit_atas')) {
            formData.append('satuan_unit_atas', '');
        }
        
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
        if (csrfToken) {
            formData.append('_token', csrfToken);
        }
        
        // Log data yang akan dikirim (untuk debugging)
        console.log('📤 Mengirim data dari tab:', activeTabId);
        console.log('📤 Alat standar yang dikirim:', alatStandarValues);
        console.log('📤 Jumlah penunjukanAlat:', penunjukanAlatInputs.length);
        console.log('📤 Jumlah pembacaanNaik:', pembacaanNaikInputs.length);
        console.log('📤 Jumlah pembacaanTurun:', pembacaanTurunInputs.length);
        
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
        let formName = 'bore_gauge';
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
        
        console.log('💾 Saving success for tab:', activeTabId);
        
        if (typeof window.handleSaveSuccess === 'function') {
            window.handleSaveSuccess(activeTabId, result);
        } else {
            alert('Data berhasil disimpan!');
        }
        
    } catch (err) {
        console.error('Submit error:', err);
        if (err.message !== 'Lainnya input kosong') {
            alert('Error: ' + err.message);
        }
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
            console.log('ðŸŽ¯ Tab switched to:', tabId);
            updateActiveTab(tabId);
            
            document.querySelectorAll('.lk-form-container').forEach(container => {
                container.style.display = 'none';
            });
            
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
    console.log('ðŸš€ DOM Content Loaded - Initializing bore_gauge...');
    
    setupTabSwitching();
    
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
    
    setTimeout(() => {
        disableRequiredOnHiddenForms();
    }, 500);
    
    console.log('âœ… bore_gauge initialization complete!');
});
</script>
  

</body>
</html>

