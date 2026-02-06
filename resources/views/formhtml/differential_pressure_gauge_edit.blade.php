<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Kalibrasi - PT. PANANJUNG ANUGRAH SOLUTION</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    /* Pastikan semua text berwarna hitam */
    .form-kalibrasi-container,
    .form-kalibrasi-container *:not(input):not(select):not(textarea):not(button) {
        color: #000000 !important;
    }
    
    /* Input fields readonly styling */
    .kalibrasi-input {
        color: #000000 !important;
        border: 1px solid #ced4da !important;
        padding: 6px 10px;
        border-radius: 4px;
        width: 100%;
        background-color: #f8f9fa;
    }
    
    .kalibrasi-input:read-only {
        background-color: #e9ecef;
        cursor: not-allowed;
    }

    /* Styling khusus untuk input suhu dan RH */
    .kondisi-input {
        border: 1px solid #000 !important;
        text-align: center;
        width: 100%;
        padding: 4px;
        background-color: #f8f9fa;
    }

    /* CHECKBOX STYLING */
    .form-check-input[type="checkbox"]:checked,
    .alat-standar-checkbox[type="checkbox"]:checked,
    .metode-checkbox[type="checkbox"]:checked {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }

    .form-check-input[type="checkbox"]:checked:disabled,
    .alat-standar-checkbox[type="checkbox"]:checked:disabled,
    .metode-checkbox[type="checkbox"]:checked:disabled {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
        opacity: 1 !important;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25) !important;
    }

    .form-check-input[type="checkbox"]:disabled,
    .alat-standar-checkbox[type="checkbox"]:disabled,
    .metode-checkbox[type="checkbox"]:disabled {
        background-color: #f8f9fa !important;
        border-color: #6c757d !important;
        opacity: 1 !important;
    }

    /* Checkmark putih untuk checkbox */
    .form-check-input[type="checkbox"]:checked,
    .alat-standar-checkbox[type="checkbox"]:checked,
    .metode-checkbox[type="checkbox"]:checked {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='m6 10 3 3 6-6'/%3e%3c/svg%3e") !important;
    }

    .form-check-input[type="checkbox"]:checked:disabled,
    .alat-standar-checkbox[type="checkbox"]:checked:disabled,
    .metode-checkbox[type="checkbox"]:checked:disabled {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='m6 10 3 3 6-6'/%3e%3c/svg%3e") !important;
    }

    /* Styling khusus untuk checkbox alat standar dan metode */
    .alat-standar-checkbox,
    .metode-checkbox {
        width: 18px;
        height: 18px;
        margin: 0;
        cursor: not-allowed;
    }

    /* Pastikan checkbox dan radio memiliki ukuran yang konsisten */
    .form-check-input[type="checkbox"],
    .alat-standar-checkbox[type="checkbox"],
    .metode-checkbox[type="checkbox"] {
        border-radius: 0.25em;
    }
    /* RADIO BUTTON STYLING - FIXED */
    .form-check-input[type="radio"]:checked {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='2' fill='%23fff'/%3e%3c/svg%3e") !important;
    }

    .form-check-input[type="radio"]:checked:disabled {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
        opacity: 1 !important;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='2' fill='%23fff'/%3e%3c/svg%3e") !important;
    }

    .form-check-input[type="radio"]:disabled {
        background-color: #f8f9fa !important;
        border-color: #6c757d !important;
        opacity: 1 !important;
    }

    /* Custom radio button styling untuk yang tanpa class form-check-input */
    input[type="radio"]:checked {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
    }

    input[type="radio"]:checked:disabled {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
        opacity: 1 !important;
    }

    input[type="radio"]:disabled {
        background-color: #f8f9fa !important;
        border-color: #6c757d !important;
        opacity: 1 !important;
    }

    /* Styling khusus untuk checkbox alat standar */
    .alat-standar-checkbox {
        width: 18px;
        height: 18px;
        margin: 0;
        cursor: not-allowed;
    }

    /* Pastikan checkbox dan radio memiliki ukuran yang konsisten */
    .form-check-input[type="checkbox"],
    .alat-standar-checkbox[type="checkbox"] {
        border-radius: 0.25em;
    }

    .form-check-input[type="radio"],
    input[type="radio"] {
        border-radius: 50%;
    }

    /* Header styling */
    .kalibrasi-header-table {
        width: 100%;
        margin-bottom: 20px;
        border-collapse: collapse;
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
        border: 1px solid #dee2e6;
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

    /* Button styling dengan gradien biru */
    .btn-primary {
        background: linear-gradient(135deg, #3b82f6, #1e40af);
        border: none;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        transition: all 0.3s ease;
        color: white;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
        background: linear-gradient(135deg, #1e40af, #1e3a8a);
        color: white;
    }

    .btn-secondary {
        background: linear-gradient(135deg, #6b7280, #4b5563);
        border: none;
        box-shadow: 0 4px 15px rgba(107, 114, 128, 0.3);
        transition: all 0.3s ease;
        color: white;
    }

    .btn-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(107, 114, 128, 0.4);
        background: linear-gradient(135deg, #4b5563, #374151);
        color: white;
    }

    /* Styling untuk bagian "Data telah diisi dengan lengkap dan jelas!" */
    .data-complete-section {
        text-align: center;
        padding: 20px 0;
        margin: 20px 0;
        border-top: 2px solid #000;
        border-bottom: 2px solid #000;
    }

    .data-complete-text {
        font-weight: bold;
        font-size: 18px;
        color: #000;
    }

    /* Styling untuk tabel alat standar */
    .alat-standar-section {
        margin: 20px 0;
    }

    .alat-standar-table {
        width: 100%;
        border-collapse: collapse;
    }

    .alat-standar-table td {
        border: 1px solid #000;
        padding: 8px;
        vertical-align: middle;
    }

    /* Print styling */
    @media print {
        .btn {
            display: none !important;
        }
        
        body {
            background: white !important;
        }
        
        .container {
            max-width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
        }
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .kalibrasi-main-table td {
            padding: 4px;
        }
        
        .data-kalibrasi-header {
            font-size: 16px;
        }
        
        .btn-lg {
            padding: 10px 20px !important;
            font-size: 14px !important;
        }
    }
</style>
</head>
<body>
    <div class="container my-4">
        <div class="form-kalibrasi-container">
            <table class="kalibrasi-header-table">
                <tr>
                    <td colspan="2">
                        <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK17B</p>
                    </td>
                    <td rowspan="5" style="text-align: center; vertical-align: middle; padding: 10px 0;">
                      <div style="display: inline-block; text-align: center;">
                          <div style="margin-bottom: 15px;">
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
                        <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">DIFFERENTIAL PRESSURE GAUGE</p>
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
                        <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;">{{ $calibration->headDifferentialPressureGauge->certificate_id ?? 'N/A' }}</p>
                    </td>
                </tr>
            </table>

            <!-- Main Form Section - Readonly -->
            <table class="kalibrasi-main-table">
                <!-- Nama Alat -->
                <tr>
                    <td style="width: 20%;">
                        <p style="margin: 0; color: #000000;">Nama Alat</p>
                    </td>
                    <td colspan="3">
                        <input type="text" name="namaAlat" class="kalibrasi-input" value="{{ $calibration->namaAlat }}">
                    </td>
                </tr>

                <!-- Merek & Kode Alat -->
                <tr>
        <td>
            <p style="margin: 0; color: #000000;">Merek</p>
        </td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="text" name="brandAlat" class="kalibrasi-input me-3" 
                       value="{{ old('brandAlat', $calibration->brandAlat) }}" style="width: 60%;">
                <span class="me-3" style="color: #000000;">Kode Alat :</span>
                <input type="text" name="kodeAlat" class="kalibrasi-input" 
                       value="{{ old('kodeAlat', $calibration->kodeAlat) }}" style="width: 30%;">
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
                <input type="text" name="typeAlat" class="kalibrasi-input me-3" 
                       value="{{ old('typeAlat', $calibration->typeAlat) }}" style="width: 45%;">
                <span class="me-3" style="color: #000000;">/</span>
                <input type="text" name="NoSeri" class="kalibrasi-input" 
                       value="{{ old('NoSeri', $calibration->NoSeri) }}" style="width: 45%;">
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
                <input type="text" name="kapasitas" class="kalibrasi-input me-3" 
                       value="{{ old('kapasitas', $calibration->kapasitas) }}" style="width: 45%;">
                <span class="me-3" style="color: #000000;">/</span>
                <input type="text" name="resolusi" class="kalibrasi-input" 
                       value="{{ old('resolusi', $calibration->resolusi) }}" style="width: 45%;">
            </div>
        </td>
    </tr>

    <!-- Nama Pemilik -->
    <tr>
        <td>
            <p style="margin: 0; color: #000000;">Nama Pemilik</p>
        </td>
        <td colspan="3">
            <input type="text" name="pemilikAlat" class="kalibrasi-input" 
                   value="{{ old('pemilikAlat', $calibration->pemilikAlat) }}">
        </td>
    </tr>

    <!-- Tanggal -->
    <tr>
        <td>
            <p style="margin: 0; color: #000000;">Tanggal Alat Masuk</p>
        </td>
        <td colspan="3">
            <input type="date" name="tanggalMasuk" class="kalibrasi-input" 
                   value="{{ old('tanggalMasuk', $calibration->tanggalMasuk ? \Carbon\Carbon::parse($calibration->tanggalMasuk)->format('Y-m-d') : '') }}">
        </td>
    </tr>
    <tr>
        <td>
            <p style="margin: 0; color: #000000;">Tanggal Kalibrasi</p>
        </td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="date" name="tanggalKalibrasi" class="kalibrasi-input me-3" 
                       value="{{ old('tanggalKalibrasi', $calibration->tanggalKalibrasi ? \Carbon\Carbon::parse($calibration->tanggalKalibrasi)->format('Y-m-d') : '') }}" style="width: 45%;">
                <span class="me-3" style="color: #000000;">Jenis Pembacaan:</span>
                <select name="jenisPembacaan" class="kalibrasi-input" style="width: 45%;">
                    <option value="manual" {{ old('jenisPembacaan', $calibration->jenisPembacaan) == 'manual' ? 'selected' : '' }}>Manual</option>
                    <option value="digital" {{ old('jenisPembacaan', $calibration->jenisPembacaan) == 'digital' ? 'selected' : '' }}>Digital</option>
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
                    <input class="form-check-input" type="radio" name="tempatKalibrasi" value="lab.PT PAS" id="lab" 
                           {{ old('tempatKalibrasi', $calibration->tempatKalibrasi) == 'lab.PT PAS' ? 'checked' : '' }}>
                    <label class="form-check-label" for="lab" style="color: #000000;">Lab. PT.PAS</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tempatKalibrasi" value="insitu" id="insitu" 
                           {{ old('tempatKalibrasi', $calibration->tempatKalibrasi) == 'insitu' ? 'checked' : '' }}>
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
            <input type="text" name="lokasiPT" class="kalibrasi-input" 
                   value="{{ old('lokasiPT', $calibration->lokasiPT) }}">
        </td>
    </tr>
</table>

<!-- Fungsi Komponen Lainnya & Kondisi Kalibrasi -->
<div class="row mt-4">
    <!-- Fungsi Komponen Lainnya -->
    <div class="col-md-6 mb-4">
        <div class="kalibrasi-section-header" style="color: #000000;">Fungsi Komponen Lainnya</div>
        
        <div class="d-flex justify-content-center align-items-center mb-4" style="gap: 60px;">
            <div class="text-center">
                <span class="fw-bold d-block mb-2" style="color: #000000; font-size: 14px;">Ok</span>
                <input type="radio" name="kondisiAlat" value="ok" class="form-check-input" 
                    style="width: 18px; height: 18px; display: block; margin: 0 auto;"
                    {{ old('kondisiAlat', $calibration->kondisiAlat) == 'ok' ? 'checked' : '' }}>
            </div>
            <div class="text-center">
                <span class="fw-bold d-block mb-2" style="color: #000000; font-size: 14px;">Rusak</span>
                <input type="radio" name="kondisiAlat" value="rusak" class="form-check-input"
                    style="width: 18px; height: 18px; display: block; margin: 0 auto;"
                    {{ old('kondisiAlat', $calibration->kondisiAlat) == 'rusak' ? 'checked' : '' }}>
            </div>
        </div>
        
        <div class="d-flex align-items-center">
            <span class="fw-bold me-3" style="color: #000000; min-width: 100px;">Keterangan :</span>
            <div style="flex: 1;">
                <input type="text" name="keterangan" class="kalibrasi-input" 
                       value="{{ old('keterangan', $calibration->keterangan) }}"
                       style="border: none; border-bottom: 2px solid #000; border-radius: 0; padding: 4px 0; background: transparent; width: 100%;">
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
                <td><input type="text" name="RT_condition1" class="kondisi-input" value="{{ old('RT_condition1', $calibration->RT_condition1) }}"></td>
                <td><input type="text" name="RT_condition2" class="kondisi-input" value="{{ old('RT_condition2', $calibration->RT_condition2) }}"></td>
                <td><input type="text" name="RT_condition3" class="kondisi-input" value="{{ old('RT_condition3', $calibration->RT_condition3) }}"></td>
            </tr>
            <tr>
                <td class="bg-light fw-bold" style="color: #000000;">RH (%)</td>
                <td><input type="text" name="RH_condition1" class="kondisi-input" value="{{ old('RH_condition1', $calibration->RH_condition1) }}"></td>
                <td><input type="text" name="RH_condition2" class="kondisi-input" value="{{ old('RH_condition2', $calibration->RH_condition2) }}"></td>
                <td><input type="text" name="RH_condition3" class="kondisi-input" value="{{ old('RH_condition3', $calibration->RH_condition3) }}"></td>
            </tr>
        </table>
    </div>
</div>


           
         <!-- Data Kalibrasi Section -->
        <div class="data-kalibrasi-header" style="color: #000000;">DATA KALIBRASI</div>
        <div class="setting-suhu-container" style="margin-bottom: 30px;">
            <div style="display: flex; justify-content: space-between;">
                
            <?php
        // Urutkan berdasarkan titikUkur (biasanya dari kecil ke besar)
        $detailsIndexed = $calibration->detailDifferentialPressureGauges
            ->sortBy('id')
            ->values(); // reset key jadi 0,1,2,...
        ?>

       <!-- Tabel Kiri (baris 1-10) -->
        <table class="setting-suhu-table" style="border-collapse: collapse; width: 48%; font-family: Arial, sans-serif; margin-bottom: 30px; float: left;">
            <thead>
     <tr>
    <th rowspan="2" style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; font-size: 10pt; background-color: #f0f0f0; width: 25%;">
        Pembacaan Alat<br>
        <div style="font-size: 9pt; font-weight: normal; display: block; margin-top: 5px;">
            (
            <input type="text" 
                name="headDifferentialPressureGauge[satuan_alat_kiri]" 
                value="{{ isset($calibration->headDifferentialPressureGauge->satuan_alat_kiri) ? $calibration->headDifferentialPressureGauge->satuan_alat_kiri : '' }}"
                style="border: none; border-bottom: none; outline: none; width: 80px; font-size: 9pt; font-weight: normal; text-align: center; background: none;"
                placeholder="............"
            >
            )
        </div>
    </th>
    <th colspan="2" style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; font-size: 10pt; background-color: #f0f0f0;">
        Pembacaan STD<br>
        <div style="font-size: 9pt; font-weight: normal; display: block; margin-top: 5px;">
            (
            <input type="text" 
                name="headDifferentialPressureGauge[satuan_std_kiri]" 
                value="{{ isset($calibration->headDifferentialPressureGauge->satuan_std_kiri) ? $calibration->headDifferentialPressureGauge->satuan_std_kiri : '' }}"
                style="border: none; border-bottom: none; outline: none; width: 80px; font-size: 9pt; font-weight: normal; text-align: center; background: none;"
                placeholder="............"
            >
            )
        </div>
    </th>
</tr>
                <tr>
                    <th style="border: 1pt solid #000; padding: 8px; text-align: center; font-size: 10pt; background-color: #f0f0f0;">Naik</th>
                    <th style="border: 1pt solid #000; padding: 8px; text-align: center; font-size: 10pt; background-color: #f0f0f0;">Turun</th>
                </tr>
            </thead>
            <tbody>
                <?php for($i = 0; $i < 10; $i++): ?>
                    <?php 
                        $detail = $detailsIndexed->get($i);
                        $titik = $detail ? number_format($detail->titikUkur, 5) : '';
                        $naik  = $detail ? number_format($detail->STDNaik, 5) : '';
                        $turun = $detail ? number_format($detail->STDTurun, 5) : '';
                    ?>
                     <tr>
    <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 40px; font-size: 10pt;">
        <input type="number" step="any" name="pembacaan_alat_kiri[]" 
               value="{{ old('titik.'.$i, $detail ? $detail->titikUkur : '') }}" 
               style="width: 100%; text-align: center; border: none; border-bottom: none; background: transparent; font-size: 10pt;">
    </td>
    <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; font-size: 9pt;">
        <input type="number" step="any" name="naik_kiri_<?php echo $i; ?>" 
               value="{{ old('naik.'.$i, $detail ? $detail->STDNaik : '') }}" 
               style="width: 100%; text-align: center; border: none; border-bottom: none; background: transparent; font-size: 9pt;">
    </td>
    <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; font-size: 9pt;">
        <input type="number" step="any" name="turun_kiri_<?php echo $i; ?>"
               value="{{ old('turun.'.$i, $detail ? $detail->STDTurun : '') }}" 
               style="width: 100%; text-align: center; border: none; border-bottom:none; background: transparent; font-size: 9pt;">
    </td>
</tr>
                <?php endfor; ?>
            </tbody>
        </table>

        <!-- Tabel Kanan (baris 11-20) -->
        <table class="setting-suhu-table" style="border-collapse: collapse; width: 48%; font-family: Arial, sans-serif; float: right;">
            <thead>
                <!-- sama seperti atas -->
          <tr>
    <th rowspan="2" style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; font-size: 10pt; background-color: #f0f0f0; width: 25%;">
        Pembacaan Alat<br>
        <div style="font-size: 9pt; font-weight: normal; display: block; margin-top: 5px;">
            (
            <input type="text" 
                name="headDifferentialPressureGauge[satuan_alat_kanan]" 
                value="{{ isset($calibration->headDifferentialPressureGauge->satuan_alat_kanan) ? $calibration->headDifferentialPressureGauge->satuan_alat_kanan : '' }}"
                style="border: none; border-bottom: none; outline: none; width: 80px; font-size: 9pt; font-weight: normal; text-align: center; background: none;"
                placeholder="............"
            >
            )
        </div>
    </th>
    <th colspan="2" style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; font-size: 10pt; background-color: #f0f0f0;">
        Pembacaan STD<br>
        <div style="font-size: 9pt; font-weight: normal; display: block; margin-top: 5px;">
            (
            <input type="text" 
                name="headDifferentialPressureGauge[satuan_std_kanan]" 
                value="{{ isset($calibration->headDifferentialPressureGauge->satuan_std_kanan) ? $calibration->headDifferentialPressureGauge->satuan_std_kanan : '' }}"
                style="border: none; border-bottom: none; outline: none; width: 80px; font-size: 9pt; font-weight: normal; text-align: center; background: none;"
                placeholder="............"
            >
            )
        </div>
    </th>
</tr>
                <tr>
                    <th style="border: 1pt solid #000; padding: 8px; text-align: center; font-size: 10pt; background-color: #f0f0f0;">Naik</th>
                    <th style="border: 1pt solid #000; padding: 8px; text-align: center; font-size: 10pt; background-color: #f0f0f0;">Turun</th>
                </tr>
            </thead>
            <tbody>
                <?php for($i = 10; $i < 20; $i++): ?>
                    <?php 
                        $detail = $detailsIndexed->get($i);
                        $titik = $detail ? number_format($detail->titikUkur, 5) : '';
                        $naik  = $detail ? number_format($detail->STDNaik, 5) : '';
                        $turun = $detail ? number_format($detail->STDTurun, 5) : '';
                    ?>
                    <tr>
    <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 40px; font-size: 10pt;">
        <input type="number" step="any" name="pembacaan_alat_kanan[]" 
               value="{{ old('titik.'.$i, $detail ? $detail->titikUkur : '') }}" 
               style="width: 100%; text-align: center; border: none; border-bottom: none; background: transparent; font-size: 10pt;">
    </td>
    <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; font-size: 9pt;">
        <input type="number" step="any" name="naik_kanan_<?php echo $i; ?>"
               value="{{ old('naik.'.$i, $detail ? $detail->STDNaik : '') }}" 
               style="width: 100%; text-align: center; border: none; border-bottom: none; background: transparent; font-size: 9pt;">
    </td>
    <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; font-size: 9pt;">
        <input type="number" step="any" name="turun_kanan_<?php echo $i; ?>"
               value="{{ old('turun.'.$i, $detail ? $detail->STDTurun : '') }}" 
               style="width: 100%; text-align: center; border: none; border-bottom:none; background: transparent; font-size: 9pt;">
    </td>
</tr>

                <?php endfor; ?>
            </tbody>
        </table>
            </div>
        </div>


       
        @php
    $addPG = $calibration->AddDifferentialPressureGauge ?? new \App\Models\AddDifferentialPressureGauge;
@endphp

<table cellspacing="0" cellpadding="0" class="TableNormal"
    style="margin-left:1.2pt;
           -aw-border:1.2pt single #000000;
           -aw-border-insideh:1.2pt single #000000;
           -aw-border-insidev:1.2pt single #000000;
           border-collapse:collapse">

  <tr style="height:14pt; margin-bottom:5pt;">
    <!-- Label -->
    <td style="width:78.25pt; border-bottom:1.2pt solid #000; vertical-align:middle;">
        <p class="TableParagraph" style="margin:0; line-height:11pt; text-align:left;">
            <span style="font-family:Arial; font-size:9pt; font-weight:bold;">Repeatability</span>
        </p>
    </td>

    <!-- Titik Dua + Input -->
    <td style="width:75.55pt; border-bottom:1.2pt solid #000; vertical-align:middle;">
        <p class="TableParagraph" style="margin:0; line-height:11pt; text-align:left;">
            <span style="font-size:9pt;">:</span>
            <span style="border-bottom:none; width:60px; display:inline-block; text-align:center; margin-left:6px;">
                <input type="text" name="repeatability" 
                       value="{{ old('repeatability', $addPG->repeatability) }}" 
                       style="width:100%; text-align:center; border:none; background:transparent; font-size:9pt;"
                       placeholder=".....">
            </span>
        </p>
    </td>

    <!-- Input dalam kurung -->
    <td style="width:80.35pt; border-bottom:1.2pt solid #000; vertical-align:middle;">
    <p class="TableParagraph" style="margin:0; line-height:11pt; text-align:left;">
        <span style="font-size:9pt;">(</span>
        <span style="border-bottom:none; width:45px; display:inline-block; text-align:center; background:transparent;">
            <input type="text" name="repeatabilitySTD"  
                   value="{{ $addPG->repeatabilitySTD ?? '' }}" 
                   style="width:100%; text-align:center; border:none; background:transparent; font-size:9pt;"
                   placeholder=".....">
        </span>
        <span style="font-size:9pt;">)</span>
    </p>
</td>
</tr>
<!-- Spacer row untuk sedikit jarak -->




    <!-- Baris 1: 3 kolom penuh -->
   <tr style="height:22pt">
    <td style="width:77.5pt; border:1.2pt solid #000; text-align:center;">
        <input type="number" step="any" name="ulangan01" 
               value="{{ old('ulangan01', $addPG->ulangan01) }}" 
               style="width:100%; text-align:center; font-size:8.5pt; border:none; border-bottom:none; background:transparent; padding:2px;">
    </td>
    <td style="width:74.8pt; border:1.2pt solid #000; text-align:center;">
        <input type="number" step="any" name="ulangan02" 
               value="{{ old('ulangan02', $addPG->ulangan02) }}" 
               style="width:100%; text-align:center; font-size:8.5pt; border:none; border-bottom:none; background:transparent; padding:2px;">
    </td>
    <td style="width:79.6pt; border:1.2pt solid #000; text-align:center;">
        <input type="number" step="any" name="ulangan03" 
               value="{{ old('ulangan03', $addPG->ulangan03) }}" 
               style="width:100%; text-align:center; font-size:8.5pt; border:none; border-bottom:none; background:transparent; padding:2px;">
    </td>
</tr>


    <!-- Baris 2: Hanya 2 kolom berborder, kolom ke-3 TANPA border dan tanpa isi -->
    <tr style="height:22pt">
       <td style="width:77.5pt; border:1.2pt solid #000; text-align:center;">
    <input type="number" step="any" name="ulangan04" 
           value="{{ old('ulangan04', $addPG->ulangan04) }}" 
           style="width:100%; text-align:center; font-size:8.5pt; border:none; border-bottom:none; background:transparent; padding:2px;">
</td>
<td style="width:74.8pt; border:1.2pt solid #000; text-align:center;">
    <input type="number" step="any" name="ulangan05" 
           value="{{ old('ulangan05', $addPG->ulangan05) }}" 
           style="width:100%; text-align:center; font-size:8.5pt; border:none; border-bottom:none; background:transparent; padding:2px;">
</td>

        <!-- Kolom kosong tanpa border -->
        <td style="width:79.6pt; border:none;"></td>
    </tr>

</table>

<br><br>

            <!-- Footer Section -->
         @php
    // Data dari head differential pressure gauge
    $headDifferentialPressureGauge = $calibration->headDifferentialPressureGauge ?? null;
    
    if ($headDifferentialPressureGauge) {
        // Ambil data dari head differential pressure gauge
        $alatStandar = $headDifferentialPressureGauge->standard ?? '';
        $dikalibrasiOleh = $calibration->calibratedBy ?? '';
        $diperiksaOleh = $calibration->verifiedBy ?? '';
        
        // Parse data standard
        $isP002 = false;
        $isP003 = false;
        
        // Coba berbagai format
        if (!empty($alatStandar)) {
            // 1. Coba sebagai JSON
            $jsonData = json_decode($alatStandar, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($jsonData)) {
                // Data adalah JSON array
                $isP002 = in_array('Calibrator P.002 (10 ~ 10 mbar ; Pneumatic)', $jsonData);
                $isP003 = in_array('Calibrator P.003 (1 ~ 20 bar ; Pneumatic)', $jsonData);
            } 
            // 2. Coba sebagai string dipisahkan koma
            elseif (strpos($alatStandar, ',') !== false) {
                $alatArray = array_map('trim', explode(',', $alatStandar));
                $isP002 = in_array('Calibrator P.002 (10 ~ 10 mbar ; Pneumatic)', $alatArray);
                $isP003 = in_array('Calibrator P.003 (1 ~ 20 bar ; Pneumatic)', $alatArray);
            }
            // 3. Coba sebagai serialized PHP array
            elseif (preg_match('/^a:\d+:\{/', $alatStandar)) {
                $unserialized = @unserialize($alatStandar);
                if ($unserialized !== false && is_array($unserialized)) {
                    $isP002 = in_array('Calibrator P.002 (10 ~ 10 mbar ; Pneumatic)', $unserialized);
                    $isP003 = in_array('Calibrator P.003 (1 ~ 20 bar ; Pneumatic)', $unserialized);
                }
            }
            // 4. Coba exact match untuk single value
            else {
                $isP002 = ($alatStandar === 'Calibrator P.002 (10 ~ 10 mbar ; Pneumatic)');
                $isP003 = ($alatStandar === 'Calibrator P.003 (1 ~ 20 bar ; Pneumatic)');
            }
        }
        
        // Debug output (bisa diaktifkan jika perlu)
        // echo "isP002: " . ($isP002 ? 'true' : 'false') . "<br>";
        // echo "isP003: " . ($isP003 ? 'true' : 'false') . "<br>";
    } else {
        $dikalibrasiOleh = '';
        $diperiksaOleh = '';
        $isP002 = false;
        $isP003 = false;
    }
@endphp

<table style="width: 100%; border-collapse: collapse; border: 1pt solid #000; font-family: Arial, sans-serif;">
    <!-- Header Judul -->
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
            Digital Pressure Calibrator :
        </td>
        <td style="width: 20%; border: 1pt solid #000; text-align: center; vertical-align: middle; font-size: 12pt; font-weight: bold; background-color: #f0f0f0;">
            Dikalibrasi oleh
        </td>
        <td style="width: 20%; border: 1pt solid #000; text-align: center; vertical-align: middle; font-size: 12pt; font-weight: bold; background-color: #f0f0f0;">
            Diperiksa oleh
        </td>
    </tr>

    <!-- Baris 1: P.002 -->
    <tr style="height: 40pt;">
        <td style="width: 5%; border: 1pt solid #000; text-align: center; vertical-align: middle; font-size: 18pt;">
            <input type="checkbox" name="alat_standar[]" value="Calibrator P.002 (10 ~ 10 mbar ; Pneumatic)" 
                   {{ $isP002 ? 'checked' : '' }} 
                   style="width:16px; height:16px;">
        </td>
        <td style="border: 1pt solid #000; padding-left: 15pt; font-size: 11pt; vertical-align: middle;">
            Calibrator P.002 (10 ~ 10 mbar ; Pneumatic)
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none;"></td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none;"></td>
    </tr>

    <!-- Baris 2: P.003 + TTD -->
    <tr style="height: 60pt;">
        <td style="border: 1pt solid #000; text-align: center; vertical-align: middle; font-size: 18pt;">
            <input type="checkbox" name="alat_standar[]" value="Calibrator P.003 (1 ~ 20 bar ; Pneumatic)"
                   {{ $isP003 ? 'checked' : '' }}
                   style="width:16px; height:16px;">
        </td>
        <td style="border: 1pt solid #000; padding-left: 15pt; font-size: 11pt; vertical-align: middle;">
            Calibrator P.003 (1 ~ 20 bar ; Pneumatic)
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none; padding: 10pt 0; vertical-align: top; font-size: 11pt; text-align: left;">
            TTD :
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none; padding: 10pt 0; vertical-align: top; font-size: 11pt; text-align: left;">
            TTD :
        </td>
    </tr>

    <!-- Baris 3: Metode Kalibrasi + Nama -->
    <tr style="height: 60pt;">
        <td style="border: 1pt solid #000; text-align: center; vertical-align: middle; font-weight: bold; font-size: 12pt; background-color: #f0f0f0;">
            Metode Kalibrasi
        </td>
        <td colspan="2" style="border: 1pt solid #000; padding-left: 15pt; font-size: 11pt; vertical-align: middle;">
            PAS-IK1102-17B
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-bottom: none; border-top: none; padding: 10pt; vertical-align: middle; font-size: 11pt;">
            Nama : <br>
            <span style="font-weight: bold; font-size: 12pt; display: inline-block; margin-top: 5px; min-height: 20px;">
                <input type="text" name="calibratedBy" 
                       value="{{ $dikalibrasiOleh }}" 
                       style="width: 100%; font-size: 9pt; border: none; border-bottom: none; background: transparent; color: #000; padding: 2px;"
                       placeholder="masukan nama">
            </span>
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-bottom: none; border-top: none; padding: 10pt; vertical-align: middle; font-size: 11pt;">
            Nama : <br>
            <span style="font-weight: bold; font-size: 12pt; display: inline-block; margin-top: 5px; min-height: 20px;">
                <input type="text" name="verifiedBy" 
                       value="{{ $diperiksaOleh }}" 
                       style="width: 100%; font-size: 9pt; border: none; border-bottom: none; background: transparent; color: #000; padding: 2px;"
                       placeholder="masukan nama">
            </span>
        </td>
    </tr>
</table>

<!-- Debug section (uncomment jika perlu) -->
@php
    /*
    echo "<div style='background: #f0f0f0; padding: 10px; margin: 10px 0; border: 1px solid #ccc;'>";
    echo "<strong>Debug Info:</strong><br>";
    echo "Head Pressure Gauge: " . ($headDifferentialPressureGauge ? 'Yes' : 'No') . "<br>";
    if ($headDifferentialPressureGauge) {
        echo "Alat Standar data: '" . ($alatStandar ?? 'NULL') . "'<br>";
        echo "P.002 checked: " . ($isP002 ? 'Yes' : 'No') . "<br>";
        echo "P.003 checked: " . ($isP003 ? 'Yes' : 'No') . "<br>";
        echo "Dikalibrasi oleh: '" . $dikalibrasiOleh . "'<br>";
        echo "Diperiksa oleh: '" . $diperiksaOleh . "'<br>";
    }
    echo "</div>";
    */
@endphp
            <!-- Action Buttons Section -->
           <div class="row mt-5">
                    <div class="col-12 text-center">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary btn-lg" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
                            <i class="fas fa-times me-2"></i>Batal
                        </a>
                        
                        <button type="submit" class="btn btn-success btn-lg ms-3" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Form validation
        document.getElementById('editForm').addEventListener('submit', function(e) {
            let isValid = true;
            let errorMessage = '';
            
            // Check required fields
            const requiredFields = document.querySelectorAll('[required]');
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.style.borderColor = '#dc3545';
                } else {
                    field.style.borderColor = '';
                }
            });
            
            // Check radio buttons for kondisi alat
            const kondisiAlat = document.querySelector('input[name="kondisiAlat"]:checked');
            if (!kondisiAlat) {
                isValid = false;
                errorMessage += 'Pilih kondisi alat (Ok/Rusak)\n';
            }
            
            // Check tempat kalibrasi
            const tempatKalibrasi = document.querySelector('input[name="tempatKalibrasi"]:checked');
            if (!tempatKalibrasi) {
                isValid = false;
                errorMessage += 'Pilih tempat kalibrasi\n';
            }
            
            // Validate date order
            const tanggalMasuk = document.querySelector('input[name="tanggalMasuk"]').value;
            const tanggalKalibrasi = document.querySelector('input[name="tanggalKalibrasi"]').value;
            
            if (tanggalMasuk && tanggalKalibrasi) {
                if (new Date(tanggalMasuk) > new Date(tanggalKalibrasi)) {
                    isValid = false;
                    errorMessage += 'Tanggal alat masuk tidak boleh lebih baru dari tanggal kalibrasi\n';
                }
            }
            
            if (!isValid) {
                e.preventDefault();
                alert('Mohon lengkapi semua data yang diperlukan:\n' + errorMessage);
            }
        });
        
        // Add input validation for numeric fields
        document.querySelectorAll('input[type="number"]').forEach(input => {
            input.addEventListener('input', function() {
                if (this.value < 0 && this.getAttribute('min') === null) {
                    this.value = Math.abs(this.value);
                }
            });
        });
        
        // Auto format date display
        document.querySelectorAll('input[type="date"]').forEach(input => {
            input.addEventListener('change', function() {
                if (this.value) {
                    // Format untuk display (opsional)
                    const date = new Date(this.value);
                    const formattedDate = date.toLocaleDateString('id-ID', {
                        day: '2-digit',
                        month: '2-digit',
                        year: 'numeric'
                    });
                    // Anda bisa menambahkan display format di sini jika diperlukan
                }
            });
        });
    </script>

   <script>
    document.getElementById('editForm').addEventListener('submit', function(e) {
        console.log('🎯 Edit form submission started...');
        
        // Debug form data
        const formData = new FormData(this);
        console.log('📦 Form data collected for update');
        
        // Log titikUkur array
        const titikUkurInputs = document.querySelectorAll('input[name="titikUkur[]"]');
        console.log('🔢 titikUkur inputs count:', titikUkurInputs.length);
        titikUkurInputs.forEach((input, index) => {
            console.log(`📝 titikUkur[${index}]:`, input.value);
        });
        
        // Log alat standar checkboxes
        const alatStandarCheckboxes = document.querySelectorAll('.alat-standar-checkbox:checked');
        console.log('✅ Checked alat standar:', alatStandarCheckboxes.length);
        alatStandarCheckboxes.forEach((checkbox, index) => {
            console.log(`🔧 Alat standar ${index + 1}:`, checkbox.value);
        });
        
        // Log kondisi alat radio
        const kondisiAlatSelected = document.querySelector('input[name="kondisiAlat"]:checked');
        console.log('🎚️ Kondisi alat selected:', kondisiAlatSelected ? kondisiAlatSelected.value : 'none');
        
        // Log tempat kalibrasi radio
        const tempatKalibrasiSelected = document.querySelector('input[name="tempatKalibrasi"]:checked');
        console.log('📍 Tempat kalibrasi selected:', tempatKalibrasiSelected ? tempatKalibrasiSelected.value : 'none');
        
        // HANYA BASIC VALIDATION untuk edit form (tidak ada required)
        let isValid = true;
        let warningMessages = [];
        
        // 1. Validasi tanggal (jika diisi)
        const tanggalMasuk = document.querySelector('input[name="tanggalMasuk"]').value;
        const tanggalKalibrasi = document.querySelector('input[name="tanggalKalibrasi"]').value;
        
        if (tanggalMasuk && tanggalKalibrasi) {
            if (new Date(tanggalMasuk) > new Date(tanggalKalibrasi)) {
                warningMessages.push('Tanggal alat masuk tidak boleh lebih baru dari tanggal kalibrasi');
                console.warn('⚠️ Date validation warning: masuk > kalibrasi');
            }
        }
        
        // 2. Validasi numeric fields (jika diisi)
        document.querySelectorAll('input[type="number"]').forEach(input => {
            if (input.value && isNaN(parseFloat(input.value))) {
                input.style.borderColor = '#ffc107';
                warningMessages.push(`${input.name} harus berupa angka`);
                console.warn(`⚠️ ${input.name} is not a valid number`);
            } else {
                input.style.borderColor = '';
            }
        });
        
       
        
        // 4. Validasi alat standar (minimal satu dipilih)
        if (alatStandarCheckboxes.length === 0) {
            const alatStandarSection = document.querySelector('.alat-standar-table');
            if (alatStandarSection) {
                alatStandarSection.style.border = '2px solid #ffc107';
                warningMessages.push('Pilih minimal satu alat standar');
                console.warn('⚠️ No alat standar selected');
            }
        } else {
            const alatStandarSection = document.querySelector('.alat-standar-table');
            if (alatStandarSection) alatStandarSection.style.border = '';
        }
        
        // 5. Validasi kondisi alat (harus dipilih)
        if (!kondisiAlatSelected) {
            const kondisiSection = document.querySelector('.kalibrasi-section-header');
            if (kondisiSection) {
                kondisiSection.style.color = '#ffc107';
                warningMessages.push('Pilih kondisi alat (Ok/Rusak)');
                console.warn('⚠️ No kondisi alat selected');
            }
        } else {
            const kondisiSection = document.querySelector('.kalibrasi-section-header');
            if (kondisiSection) kondisiSection.style.color = '';
        }
        
        // 6. Validasi tempat kalibrasi (harus dipilih)
        if (!tempatKalibrasiSelected) {
            const tempatSection = document.querySelector('input[name="tempatKalibrasi"]').closest('tr');
            if (tempatSection) {
                tempatSection.style.backgroundColor = '#fff8e1';
                warningMessages.push('Pilih tempat kalibrasi');
                console.warn('⚠️ No tempat kalibrasi selected');
            }
        }
        
        // Tampilkan warning jika ada, tapi masih bisa submit
        if (warningMessages.length > 0) {
            const shouldProceed = confirm(
                '⚠️ Peringatan:\n' + 
                warningMessages.join('\n') + 
                '\n\nApakah Anda yakin ingin melanjutkan?'
            );
            
            if (!shouldProceed) {
                e.preventDefault();
                console.log('⛔ User cancelled submission due to warnings');
                return false;
            }
        }
        
        console.log('🚀 Form validation passed, submitting...');
        
        // Add loading indicator
        const submitBtn = this.querySelector('button[type="submit"]');
        if (submitBtn) {
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan Perubahan...';
            submitBtn.disabled = true;
            
            // Reset button setelah 10 detik jika ada error
            setTimeout(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 10000);
        }
        
        // Log data yang akan dikirim (optional debugging)
        console.log('📤 Data to be submitted:');
        for (let [key, value] of formData.entries()) {
            // Jangan log password atau sensitive data
            if (!key.includes('password') && !key.includes('token')) {
                console.log(`${key}:`, value);
            }
        }
        
        // Optional: Send analytics/log to server
        try {
            fetch('/api/log-form-edit', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    action: 'edit_form_submit',
                    calibration_id: {{ $calibration->id }},
                    form_type: 'inside_micrometer',
                    timestamp: new Date().toISOString(),
                    field_count: formData.entries().length
                })
            }).catch(err => console.log('Analytics log failed:', err));
        } catch (analyticsError) {
            console.log('Analytics error:', analyticsError);
        }
        
        return true;
    });
    
    // Additional debug on page load
    document.addEventListener('DOMContentLoaded', function() {
        console.log('📄 Edit form loaded for Inside Micrometer ID:', {{ $calibration->id }});
        console.log('🏷️ Certificate ID:', '{{ $calibration->headInsideMicrometer->certificate_id ?? "N/A" }}');
        console.log('🔢 Detail records count:', {{ $calibration->detailInsideMicrometers->count() }});
        
        // Log current alat standar
        const currentStandards = '{{ $calibration->headInsideMicrometer->standard ?? "" }}';
        console.log('📋 Current alat standar:', currentStandards);
        
        // Log current form values
        console.log('📝 Current form values:');
        document.querySelectorAll('.kalibrasi-input').forEach((input, index) => {
            if (index < 5) { // Hanya log 5 pertama
                console.log(`${input.name}:`, input.value);
            }
        });
        
        // Auto-hide validation messages after 5 seconds
        setTimeout(() => {
            document.querySelectorAll('.is-invalid').forEach(el => {
                el.classList.remove('is-invalid');
            });
            document.querySelectorAll('.invalid-feedback').forEach(el => {
                el.style.display = 'none';
            });
        }, 5000);
        
        // Real-time validation for numeric fields
        document.querySelectorAll('input[type="number"]').forEach(input => {
            input.addEventListener('blur', function() {
                if (this.value && isNaN(parseFloat(this.value))) {
                    this.classList.add('is-invalid');
                    this.title = 'Harus berupa angka';
                } else {
                    this.classList.remove('is-invalid');
                    this.title = '';
                }
            });
        });
        
        // Real-time validation for date fields
        document.querySelectorAll('input[type="date"]').forEach(input => {
            input.addEventListener('change', function() {
                const tanggalMasuk = document.querySelector('input[name="tanggalMasuk"]').value;
                const tanggalKalibrasi = document.querySelector('input[name="tanggalKalibrasi"]').value;
                
                if (tanggalMasuk && tanggalKalibrasi && new Date(tanggalMasuk) > new Date(tanggalKalibrasi)) {
                    this.classList.add('is-invalid');
                    this.title = 'Tanggal tidak valid';
                } else {
                    this.classList.remove('is-invalid');
                    this.title = '';
                }
            });
        });
        
        // Highlight required-ish fields (bukan required tapi penting)
        const importantFields = [
            'namaAlat', 'brandAlat', 'NoSeri', 'kapasitas', 'resolusi',
            'pemilikAlat', 'tanggalMasuk', 'tanggalKalibrasi'
        ];
        
        importantFields.forEach(fieldName => {
            const field = document.querySelector(`[name="${fieldName}"]`);
            if (field && !field.value.trim()) {
                field.style.backgroundColor = '#fff8e1';
                field.addEventListener('input', function() {
                    if (this.value.trim()) {
                        this.style.backgroundColor = '';
                    }
                });
            }
        });
    });
</script>
</body>
</html>