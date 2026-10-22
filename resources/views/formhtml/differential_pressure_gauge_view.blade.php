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
                        <input type="text" class="kalibrasi-input" value="{{ $calibration->namaAlat }}" readonly>
                    </td>
                </tr>

                <!-- Merek & Kode Alat -->
                <tr>
                    <td>
                        <p style="margin: 0; color: #000000;">Merek</p>
                    </td>
                    <td colspan="3">
                        <div class="d-flex align-items-center">
                            <input type="text" class="kalibrasi-input me-3" value="{{ $calibration->brandAlat }}" readonly style="width: 60%;">
                            <span class="me-3" style="color: #000000;">Kode Alat :</span>
                            <input type="text" class="kalibrasi-input" value="{{ $calibration->kodeAlat }}" readonly style="width: 30%;">
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
                            <input type="text" class="kalibrasi-input me-3" value="{{ $calibration->typeAlat }}" readonly style="width: 45%;">
                            <span class="me-3" style="color: #000000;">/</span>
                            <input type="text" class="kalibrasi-input" value="{{ $calibration->NoSeri }}" readonly style="width: 45%;">
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
                            <input type="text" class="kalibrasi-input me-3" value="{{ $calibration->kapasitas }}" readonly style="width: 45%;">
                            <span class="me-3" style="color: #000000;">/</span>
                            <input type="text" class="kalibrasi-input" value="{{ $calibration->resolusi }}" readonly style="width: 45%;">
                        </div>
                    </td>
                </tr>

                <!-- Nama Pemilik -->
                <tr>
                    <td>
                        <p style="margin: 0; color: #000000;">Nama Pemilik</p>
                    </td>
                    <td colspan="3">
                        <input type="text" class="kalibrasi-input" value="{{ $calibration->pemilikAlat }}" readonly>
                    </td>
                </tr>

                <!-- Tanggal -->
                <tr>
                    <td>
                        <p style="margin: 0; color: #000000;">Tanggal Alat Masuk</p>
                    </td>
                    <td colspan="3">
                        <input type="text" class="kalibrasi-input" 
                               value="{{ \Carbon\Carbon::parse($calibration->tanggalMasuk)->format('d/m/Y') }}" readonly>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p style="margin: 0; color: #000000;">Tanggal Kalibrasi</p>
                    </td>
                    <td colspan="3">
                        <div class="d-flex align-items-center">
                            <input type="text" class="kalibrasi-input me-3" 
                                   value="{{ \Carbon\Carbon::parse($calibration->tanggalKalibrasi)->format('d/m/Y') }}" readonly style="width: 45%;">
                            <span class="me-3" style="color: #000000;">Jenis Pembacaan:</span>
                            <input type="text" class="kalibrasi-input" value="{{ $calibration->jenisPembacaan }}" readonly style="width: 45%;">
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
                                <input class="form-check-input" type="radio" name="tempat_kalibrasi" value="lab" id="lab" 
                                       {{ $calibration->tempatKalibrasi == 'lab.PT PAS' ? 'checked' : '' }} disabled>
                                <label class="form-check-label" for="lab" style="color: #000000;">Lab. PT.PAS</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tempat_kalibrasi" value="Insitu" id="insitu" 
                                       {{ $calibration->tempatKalibrasi == 'Insitu' ? 'checked' : '' }} disabled>
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
                        <input type="text" class="kalibrasi-input" value="{{ $calibration->lokasiPT }}" readonly>
                    </td>
                </tr>
                
                   <tr>
                    <td>
                        <p style="margin: 0; color: #000000;">Kode TH</p>
                    </td>
                    <td colspan="3">
                        <input type="text" class="kalibrasi-input" value="{{ $calibration->kode_th }}" readonly>
                    </td>
                </tr>
            </table>

            <!-- Fungsi Komponen Lainnya & Kondisi Kalibrasi -->
            <div class="row mt-4">
    <!-- Fungsi Komponen Lainnya -->
    <div class="col-md-6 mb-4">
        <div class="kalibrasi-section-header" style="color: #000000;">Fungsi Komponen Lainnya</div>
        
        <!-- Radio Button Section - Text di atas, radio di bawah -->
        <div class="d-flex justify-content-center align-items-center mb-4" style="gap: 60px;">
            <div class="text-center">
                <span class="fw-bold d-block mb-2" style="color: #000000; font-size: 14px;">Ok</span>
                <input type="radio" name="kondisiAlat" value="ok" class="form-check-input" 
                    style="width: 18px; height: 18px; display: block; margin: 0 auto;"
                    {{ $calibration->kondisiAlat == 'ok' ? 'checked' : '' }} disabled>
            </div>
            <div class="text-center">
                <span class="fw-bold d-block mb-2" style="color: #000000; font-size: 14px;">Rusak</span>
                <input type="radio" name="kondisiAlat" value="rusak" class="form-check-input"
                    style="width: 18px; height: 18px; display: block; margin: 0 auto;"
                    {{ $calibration->kondisiAlat == 'rusak' ? 'checked' : '' }} disabled>
            </div>
        </div>
        
        <!-- Keterangan Section -->
        <div class="d-flex align-items-center">
            <span class="fw-bold me-3" style="color: #000000; min-width: 100px;">Keterangan :</span>
            <div style="flex: 1;">
                <input type="text" class="kalibrasi-input" value="{{ $calibration->keterangan ?? '-' }}" readonly 
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
                <td><input type="text" class="kondisi-input" value="{{ $calibration->RT_condition1 ?? '-' }}" readonly></td>
                <td><input type="text" class="kondisi-input" value="{{ $calibration->RT_condition2 ?? '-' }}" readonly></td>
                <td><input type="text" class="kondisi-input" value="{{ $calibration->RT_condition3 ?? '-' }}" readonly></td>
            </tr>
            <tr>
                <td class="bg-light fw-bold" style="color: #000000;">RH (%)</td>
                <td><input type="text" class="kondisi-input" value="{{ $calibration->RH_condition1 ?? '-' }}" readonly></td>
                <td><input type="text" class="kondisi-input" value="{{ $calibration->RH_condition2 ?? '-' }}" readonly></td>
                <td><input type="text" class="kondisi-input" value="{{ $calibration->RH_condition3 ?? '-' }}" readonly></td>
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
                <span style="font-size: 9pt; font-weight: normal; display: block; margin-top: 5px;">
                    (@if(isset($calibration->headDifferentialPressureGauge->satuan_alat_kiri) && $calibration->headDifferentialPressureGauge->satuan_alat_kiri)
                        {{ $calibration->headDifferentialPressureGauge->satuan_alat_kiri }}
                    @else
                        ……………
                    @endif)
                </span>
            </th>
            <th colspan="2" style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; font-size: 10pt; background-color: #f0f0f0;">
                Pembacaan STD<br>
                <span style="font-size: 9pt; font-weight: normal; display: block; margin-top: 5px;">
                    (@if(isset($calibration->headDifferentialPressureGauge->satuan_std_kiri) && $calibration->headDifferentialPressureGauge->satuan_std_kiri)
                        {{ $calibration->headDifferentialPressureGauge->satuan_std_kiri }}
                    @else
                        ……………
                    @endif)
                </span>
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
                $titik = $detail ? $detail->titikUkur : '';
                $naik  = $detail ? $detail->STDNaik : '';
                $turun = $detail ? $detail->STDTurun : '';
            ?>
            <tr>
                <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 40px; font-size: 10pt;">
                    {{ $titik }}
                </td>
                <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; font-size: 9pt;">
                    {{ $naik }}
                </td>
                <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; font-size: 9pt;">
                    {{ $turun }}
                </td>
            </tr>
        <?php endfor; ?>
    </tbody>
</table>

<!-- Tabel Kanan (baris 11-20) -->
<table class="setting-suhu-table" style="border-collapse: collapse; width: 48%; font-family: Arial, sans-serif; float: right;">
    <thead>
        <tr>
            <th rowspan="2" style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; font-size: 10pt; background-color: #f0f0f0; width: 25%;">
                Pembacaan Alat<br>
                <span style="font-size: 9pt; font-weight: normal; display: block; margin-top: 5px;">(……………)</span>
            </th>
            <th colspan="2" style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; font-size: 10pt; background-color: #f0f0f0;">
                Pembacaan STD<br>
                <span style="font-size: 9pt; font-weight: normal; display: block; margin-top: 5px;">(……………)</span>
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
                $titik = $detail ? $detail->titikUkur : '';
                $naik  = $detail ? $detail->STDNaik : '';
                $turun = $detail ? $detail->STDTurun : '';
            ?>
            <tr>
                <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 40px; font-size: 10pt;">
                    {{ $titik }}
                </td>
                <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; font-size: 9pt;">
                    {{ $naik }}
                </td>
                <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; font-size: 9pt;">
                    {{ $turun }}
                </td>
            </tr>
        <?php endfor; ?>
    </tbody>
</table>
</div>
</div>

@php
    $addPG = $calibration->addDifferentialPressureGauge ?? new \App\Models\AddDifferentialPressureGauge;
@endphp

<table cellspacing="0" cellpadding="0" class="TableNormal"
    style="margin-left:1.2pt;
           -aw-border:1.2pt single #000000;
           -aw-border-insideh:1.2pt single #000000;
           -aw-border-insidev:1.2pt single #000000;
           border-collapse:collapse">

    <tr style="height:14pt">
        <td style="width:78.25pt; border-bottom:1.2pt solid #000; vertical-align:top;">
            <p class="TableParagraph" style="margin-left:16.05pt; line-height:11pt">
                <span style="font-family:Arial; font-size:9pt; font-weight:bold;">
                    Repeatability
                </span>
            </p>
        </td>
        <td style="width:75.55pt; border-bottom:1.2pt solid #000; vertical-align:top;">
            <p class="TableParagraph" style="margin-left:3pt; line-height:11pt">
                <span style="font-size:9pt">:</span>
                <span style="border:none; border-bottom:1.2pt dotted #000;
                              width:60px; font-size:9pt; margin-left:6px;
                              background:transparent; display:inline-block;
                              text-align:center;">
                    {{ $addPG->repeatability }}
                </span>
            </p>
        </td>
        <td style="width:80.35pt; border-bottom:1.2pt solid #000; vertical-align:top;">
            <p class="TableParagraph" style="margin-top:1pt; margin-left:18.05pt;">
                <span style="font-size:9pt">(</span>
                <span style="border:none; border-bottom:1.2pt dotted #000;
                              width:45px; font-size:9pt; text-align:center;
                              background:transparent; display:inline-block;">
                    {{ $addPG->repeatabilitySTD }}
                </span>
                <span style="font-size:9pt">)</span>
            </p>
        </td>
    </tr>

    <!-- Baris 1: 3 kolom penuh -->
    <tr style="height:22pt">
        <td style="width:77.5pt; border:1.2pt solid #000; text-align:center;">
            <span style="font-size:8.5pt;">
                {{ $addPG->ulangan01 }}
            </span>
        </td>
        <td style="width:74.8pt; border:1.2pt solid #000; text-align:center;">
            <span style="font-size:8.5pt;">
                {{ $addPG->ulangan02 }}
            </span>
        </td>
        <td style="width:79.6pt; border:1.2pt solid #000; text-align:center;">
            <span style="font-size:8.5pt;">
                {{ $addPG->ulangan03 }}
            </span>
        </td>
    </tr>

    <!-- Baris 2: Hanya 2 kolom berborder, kolom ke-3 TANPA border dan tanpa isi -->
    <tr style="height:22pt">
        <td style="width:77.5pt; border:1.2pt solid #000; text-align:center;">
            <span style="font-size:8.5pt;">
                {{ $addPG->ulangan04 }}
            </span>
        </td>
        <td style="width:74.8pt; border:1.2pt solid #000; text-align:center;">
            <span style="font-size:8.5pt;">
                {{ $addPG->ulangan05 }}
            </span>
        </td>
        <!-- Kolom kosong tanpa border -->
        <td style="width:79.6pt; border:none;"></td>
    </tr>
</table>

            <!-- Footer Section -->
           <!-- Data Complete Section -->
                    <div class="data-complete-section">
                        <span class="data-complete-text">Data telah diisi dengan lengkap dan jelas!</span>
                    </div>

                    @php
            // Data dari head pressure gauge
            $headDifferentialPressureGauge = $calibration->headDifferentialPressureGauge ?? null;
            
            // Set default values
            $dikalibrasiOleh = '';
            $diperiksaOleh = '';
            $isP002 = false;
            $isP003 = false;
            
            if ($headDifferentialPressureGauge) {
                $dikalibrasiOleh = $calibration->calibratedBy ?? $headDifferentialPressureGauge->calibratedBy ?? '';
                $diperiksaOleh = $calibration->verifiedBy ?? $headDifferentialPressureGauge->verifiedBy ?? '';
                
                // Ambil data alat standar
                $alatStandar = $headDifferentialPressureGauge->standard ?? $headDifferentialPressureGauge->alat_standar ?? '';
                
                // Cek dengan str_contains (Laravel 8+)
                if (function_exists('str_contains')) {
                    $isP002 = str_contains($alatStandar, 'Calibrator P.002') || 
                            str_contains($alatStandar, 'P.002');
                    $isP003 = str_contains($alatStandar, 'Calibrator P.003') || 
                            str_contains($alatStandar, 'P.003');
                } else {
                    // Fallback untuk versi Laravel lama
                    $isP002 = strpos($alatStandar, 'Calibrator P.002') !== false || 
                            strpos($alatStandar, 'P.002') !== false;
                    $isP003 = strpos($alatStandar, 'Calibrator P.003') !== false || 
                            strpos($alatStandar, 'P.003') !== false;
                }
                
                // Debug (bisa diaktifkan jika perlu)
                // echo "Alat Standar: " . $alatStandar . "<br>";
                // echo "P.002: " . ($isP002 ? 'true' : 'false') . "<br>";
                // echo "P.003: " . ($isP003 ? 'true' : 'false') . "<br>";
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
            @if($isP002)
                ✓
            @else
                &nbsp;
            @endif
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
            @if($isP003)
                ✓
            @else
                &nbsp;
            @endif
        </td>
        <td style="border: 1pt solid #000; padding-left: 15pt; font-size: 11pt; vertical-align: middle;">
            Calibrator P.003 (1 ~ 20 bar ; Pneumatic)
        </td>
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
            PAS-IK1102-17B
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-bottom: 1pt solid #000; border-top: none; padding: 10pt; vertical-align: middle; font-size: 11pt;">
            Nama : <br>
            <span style="font-weight: bold; font-size: 12pt; display: inline-block; margin-top: 5px; min-height: 20px; width: 75%;">
                {{ $dikalibrasiOleh ?: '&nbsp;' }}
            </span>
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-bottom: 1pt solid #000; border-top: none; padding: 10pt; vertical-align: middle; font-size: 11pt;">
            Nama : <br>
            <span style="font-weight: bold; font-size: 12pt; display: inline-block; margin-top: 5px; min-height: 20px; width: 75%;">
                {{ $diperiksaOleh ?: '&nbsp;' }}
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
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                    
                    <!--<button onclick="window.print()" class="btn btn-primary btn-lg ms-3" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">-->
                    <!--    <i class="fas fa-print me-2"></i>Cetak-->
                    <!--</button>-->
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>