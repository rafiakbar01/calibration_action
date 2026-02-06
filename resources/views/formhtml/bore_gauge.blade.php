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
        <input type="hidden" name="form_type" value="dial_test_indicator">
        <input type="hidden" name="resolution" value="{{ $resolution ?? '' }}">
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
                                <input type="text"
                                    name="nama_alat"
                                    class="kalibrasi-input"
                                    value="Bore Gauge"
                                    placeholder="Bore Gauge"
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

<!-- HIDDEN INPUT SKALA -->
<input type="hidden" name="skala" value="{{ $resolution ?? '0.01' }}">

<div class="kalibrasi-wrapper">
    <!-- Tabel Kiri: 20 baris, nilai hanya sampai 1.0 -->
    <div>
        <table class="kalibrasi-data-table">
            <thead>
                <tr>
                    <th colspan="3">Uji Skala Nominal (Bagian Bawah)</th>
                </tr>
                <tr class="sub-header">
                    <th>Penunjukan Alat (mm)</th>
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
                                   placeholder="{{ $i > 10 ? 'Masukkan nilai' : '' }}"
                                   onblur="if(this.value.trim()==='' && '{{ $value }}' !== '') this.value='{{ $value }}'"
                                   oninput="this.value=this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g,'$1')"
                                   style="font-weight: {{ $i <= 10 ? '500' : 'normal' }};">
                        </td>
                        <td>
                            <input type="text" name="pembacaanNaik[]"
                                   oninput="this.value=this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g,'$1')">
                        </td>
                        <td>
                            <input type="text" name="pembacaanTurun[]"
                                   oninput="this.value=this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g,'$1')">
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>

    <!-- Tabel Kanan: 20 baris, kosong / user isi manual -->
    <div>
        <table class="kalibrasi-data-table">
            <thead>
                <tr>
                    <th colspan="3">Uji Skala Nominal (Bagian Atas / Lanjutan)</th>
                </tr>
                <tr class="sub-header">
                    <th>Penunjukan Alat (mm)</th>
                    <th>Pembacaan Standard - Naik</th>
                    <th>Pembacaan Standard - Turun</th>
                </tr>
            </thead>
            <tbody>
                @for($i = 0; $i < 20; $i++)
                    <tr>
                        <td class="penunjukan-input">
                            <input type="text" name="penunjukanAlat[]"
                                   placeholder="Masukkan nilai"
                                   oninput="this.value=this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g,'$1')">
                        </td>
                        <td>
                            <input type="text" name="pembacaanNaik[]"
                                   oninput="this.value=this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g,'$1')">
                        </td>
                        <td>
                            <input type="text" name="pembacaanTurun[]"
                                   oninput="this.value=this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g,'$1')">
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>
                    <!-- Repeatability Section -->
            <!-- Tabel Repeatability -->
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
    max-width: 380px;           /* membatasi lebar agar tidak melebar terlalu jauh */
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

.repeatability-table input[type="text"] {
    width: 100%;
    height: 100%;
    border: none;
    background: transparent;
    text-align: center;
    font-size: 9pt;
    padding: 1px;
    box-sizing: border-box;
}

.repeatability-table input[type="text"]:focus {
    outline: none;
    background-color: rgba(74, 144, 226, 0.08);
}
</style>

<div class="repeatability-section">
    <p class="repeatability-title">Repeatability :</p>

    <table class="repeatability-table">
        <tr>
            <td><input type="text" name="ulangan01"></td>
            <td><input type="text" name="ulangan02"></td>
            <td><input type="text" name="ulangan03"></td>
            <td><input type="text" name="ulangan04"></td>
            <td><input type="text" name="ulangan05"></td>
        </tr>
        <tr>
            <td><input type="text" name="ulangan06"></td>
            <td><input type="text" name="ulangan07"></td>
            <td><input type="text" name="ulangan08"></td>
            <td><input type="text" name="ulangan09"></td>
            <td><input type="text" name="ulangan10"></td>
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
            <input type="checkbox" name="alat_standar[]" value="dial_gauge_tester_0_25mm" 
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
                              font-size: 9.5pt; background: transparent; margin-left: 8px;">
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
                              font-size: 9.5pt; background: transparent; margin-left: 8px;">
            </div>
        </td>
    </tr>

    <!-- Baris 2: Dial Indicator 1 mm -->
    <tr style="height: 18pt;">
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle;">
            <input type="checkbox" name="alat_standar[]" value="dial_indicator_1mm" 
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
                   oninput="updateAlatStandarLainnya()">
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
    // Fungsi untuk mengupdate nilai checkbox "Lainnya" berdasarkan input teks
    function updateAlatStandarLainnya() {
        const checkbox = document.getElementById('alat_standar_lainnya_checkbox');
        const inputText = document.getElementById('alat_standar_tambahan_input');
        
        if (inputText.value.trim() !== '') {
            checkbox.value = inputText.value.trim();
        } else {
            checkbox.value = '';
        }
    }

    // Fungsi untuk toggle input teks ketika checkbox dicentang/dicentang
    function toggleAlatStandarLainnya() {
        const checkbox = document.getElementById('alat_standar_lainnya_checkbox');
        const inputText = document.getElementById('alat_standar_tambahan_input');
        
        if (checkbox.checked) {
            inputText.disabled = false;
            inputText.focus();
            // Update nilai jika input sudah terisi
            if (inputText.value.trim() !== '') {
                checkbox.value = inputText.value.trim();
            }
        } else {
            inputText.disabled = true;
            checkbox.value = '';
        }
    }

    // Event listener untuk checkbox "Lainnya"
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxLainnya = document.getElementById('alat_standar_lainnya_checkbox');
        const inputLainnya = document.getElementById('alat_standar_tambahan_input');
        
        if (checkboxLainnya) {
            checkboxLainnya.addEventListener('change', toggleAlatStandarLainnya);
        }
        
        if (inputLainnya) {
            inputLainnya.addEventListener('input', updateAlatStandarLainnya);
            
            // Nonaktifkan input teks awalnya
            inputLainnya.disabled = true;
        }
        
        // Validasi form untuk memastikan jika checkbox "Lainnya" dicentang, input harus diisi
        const form = document.getElementById('kalibrasiForm');
        if (form) {
            form.addEventListener('submit', function(e) {
                const checkboxLainnya = document.getElementById('alat_standar_lainnya_checkbox');
                const inputLainnya = document.getElementById('alat_standar_tambahan_input');
                
                if (checkboxLainnya.checked && inputLainnya.value.trim() === '') {
                    e.preventDefault();
                    alert('Harap isi nama alat standar lainnya!');
                    inputLainnya.focus();
                    return;
                }
            });
        }
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
        const dropdown = document.getElementById('jenis_dial_test_indicator');
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

