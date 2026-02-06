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
    .alat-standar-checkbox[type="checkbox"]:checked {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }

    .form-check-input[type="checkbox"]:checked:disabled,
    .alat-standar-checkbox[type="checkbox"]:checked:disabled {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
        opacity: 1 !important;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25) !important;
    }

    .form-check-input[type="checkbox"]:disabled,
    .alat-standar-checkbox[type="checkbox"]:disabled {
        background-color: #f8f9fa !important;
        border-color: #6c757d !important;
        opacity: 1 !important;
    }

    /* Checkmark putih untuk checkbox */
    .form-check-input[type="checkbox"]:checked,
    .alat-standar-checkbox[type="checkbox"]:checked {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='m6 10 3 3 6-6'/%3e%3c/svg%3e") !important;
    }

    .form-check-input[type="checkbox"]:checked:disabled,
    .alat-standar-checkbox[type="checkbox"]:checked:disabled {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='m6 10 3 3 6-6'/%3e%3c/svg%3e") !important;
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
                        <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK54</p>
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
                        <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">MESIN UJI TARIK/TEKAN</p>
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
                        <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;">{{ $calibration->headUtm->certificate_id ?? 'N/A' }}</p>
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
                               value="{{ \Carbon\Carbon::parse($calibration->tanggalKalibrasi)->format('d/m/Y') }}"
                                readonly style="width: 45%;">
                            <span class="me-3" style="color: #000000;">Jenis Pembacaan:</span>
                            <input type="text" class="kalibrasi-input" 
                                value="{{ $calibration->jenisPembacaan }}" 
                                readonly style="width: 45%;">
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
                                <input class="form-check-input" type="radio" name="tempat_kalibrasi" value="lab.PT PAS" id="lab" 
                                       {{ $calibration->tempatKalibrasi == 'lab.PT PAS' ? 'checked' : '' }} disabled>
                                <label class="form-check-label" for="lab" style="color: #000000;">Lab. PT.PAS</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tempat_kalibrasi" value="insitu" id="insitu" 
                                       {{ $calibration->tempatKalibrasi == 'insitu' ? 'checked' : '' }} disabled>
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


<?php
// Ambil data detail UTM dari calibration
$detailUtms = $calibration->detailUtms ?? collect();
// Pisahkan data tekan dan tarik
$dataTekan = $detailUtms->filter(function($item) {
    return !is_null($item->readTekanSTD1) || !is_null($item->readTekanSTD2) || !is_null($item->readTekanSTD3) ||
           !is_null($item->readTekanUUT1) || !is_null($item->readTekanUUT2) || !is_null($item->readTekanUUT3);
});

$dataTarik = $detailUtms->filter(function($item) {
    return !is_null($item->readTarikSTD1) || !is_null($item->readTarikSTD2) || !is_null($item->readTarikSTD3) ||
           !is_null($item->readTarikUUT1) || !is_null($item->readTarikUUT2) || !is_null($item->readTarikUUT3);
});

// Ambil data head utm untuk satuan
$headUtm = $calibration->headUtm ?? null;
?>

<!-- TABEL TEKAN VIEW DATA -->
<table class="data-kalibrasi-table" style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
    <tr>
        <td colspan="8" class="header" style="border: 1px solid #000; text-align: center; padding: 10px; font-weight: bold; background-color: #e0e0e0;">
            DATA KALIBRASI TEKAN
        </td>
    </tr>

    <tr>
        <td rowspan="1" class="header" style="border: 1px solid #000; text-align: center; padding: 8px; background-color: #f0f0f0; vertical-align: middle;">
            Titik Ukur
        </td>
        <td colspan="3" class="header" style="border: 1px solid #000; text-align: center; padding: 8px; background-color: #f0f0f0;">
            Pembacaan Tekan Standar<br>
            <span style="font-weight: normal; font-size: 10pt;">
                @if($headUtm && $headUtm->satuan_read_tekan_std)
                    ({{ $headUtm->satuan_read_tekan_std }})
                @else
                    (.........)
                @endif
            </span>
        </td>
        <td colspan="3" class="header" style="border: 1px solid #000; text-align: center; padding: 8px; background-color: #f0f0f0;">
            Pembacaan Tekan UUT<br>
            <span style="font-weight: normal; font-size: 10pt;">
                @if($headUtm && $headUtm->satuan_read_tekan_uut)
                    ({{ $headUtm->satuan_read_tekan_uut }})
                @else
                    (.........)
                @endif
            </span>
        </td>
    </tr>

    <!-- Baris 2: Derajat dan Input Satuan -->
    <tr>
        <!-- Kolom untuk satuan titik ukur (rowspan 2) -->
        <td rowspan="2" style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #e8e8e8; vertical-align: middle;">
            <span style="font-weight: normal; font-size: 10pt;">
                @if($headUtm && $headUtm->satuan_titik_ukur_tekan)
                    ({{ $headUtm->satuan_titik_ukur_tekan }})
                @else
                    (.........)
                @endif
            </span>
        </td>
        <!-- Derajat Standar -->
        <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #e8e8e8;">0°</td>
        <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #e8e8e8;">120°</td>
        <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #e8e8e8;">240°</td>
        <!-- Derajat UUT -->
        <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #e8e8e8;">0°</td>
        <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #e8e8e8;">120°</td>
        <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #e8e8e8;">240°</td>
    </tr>

    <!-- Baris 3: Angka -->
    <tr>
        <!-- Angka Standar -->
        <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #f8f8f8; font-weight: bold;">1</td>
        <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #f8f8f8; font-weight: bold;">2</td>
        <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #f8f8f8; font-weight: bold;">3</td>
        <!-- Angka UUT -->
        <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #f8f8f8; font-weight: bold;">1</td>
        <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #f8f8f8; font-weight: bold;">2</td>
        <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #f8f8f8; font-weight: bold;">3</td>
    </tr>

    <!-- DATA TEKAN - Maksimal 8 Baris -->
    @if($dataTekan->count() > 0)
        @foreach($dataTekan as $index => $detail)
        <tr>
            <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">
                {{ $detail->titikUkur ? number_format($detail->titikUkur, 2) : '-' }}
            </td>
            <!-- Pembacaan Tekan Standar -->
            <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">
                {{ $detail->readTekanSTD1 ? number_format($detail->readTekanSTD1, 2) : '-' }}
            </td>
            <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">
                {{ $detail->readTekanSTD2 ? number_format($detail->readTekanSTD2, 2) : '-' }}
            </td>
            <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">
                {{ $detail->readTekanSTD3 ? number_format($detail->readTekanSTD3, 2) : '-' }}
            </td>
            <!-- Pembacaan Tekan UUT -->
            <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">
                {{ $detail->readTekanUUT1 ? number_format($detail->readTekanUUT1, 2) : '-' }}
            </td>
            <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">
                {{ $detail->readTekanUUT2 ? number_format($detail->readTekanUUT2, 2) : '-' }}
            </td>
            <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">
                {{ $detail->readTekanUUT3 ? number_format($detail->readTekanUUT3, 2) : '-' }}
            </td>
        </tr>
        @endforeach
        
        <!-- Tambah baris kosong jika data kurang dari 8 -->
        @if($dataTekan->count() < 8)
            @for($i = $dataTekan->count() + 1; $i <= 8; $i++)
            <tr>
                <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">-</td>
                <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">-</td>
                <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">-</td>
                <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">-</td>
                <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">-</td>
                <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">-</td>
                <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">-</td>
            </tr>
            @endfor
        @endif
    @else
        <!-- Tampilkan 8 baris kosong jika tidak ada data -->
        @for($i = 1; $i <= 8; $i++)
        <tr>
            <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">-</td>
            <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">-</td>
            <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">-</td>
            <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">-</td>
            <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">-</td>
            <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">-</td>
            <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">-</td>
        </tr>
        @endfor
    @endif
</table>

<!-- TABEL TARIK VIEW DATA -->
<table class="data-kalibrasi-table" style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
    <tr>
        <td colspan="8" class="header" style="border: 1px solid #000; text-align: center; padding: 10px; font-weight: bold; background-color: #e0e0e0;">
            DATA KALIBRASI TARIK
        </td>
    </tr>

    <tr>
        <td rowspan="1" class="header" style="border: 1px solid #000; text-align: center; padding: 8px; background-color: #f0f0f0; vertical-align: middle;">
            Titik Ukur
        </td>
        <td colspan="3" class="header" style="border: 1px solid #000; text-align: center; padding: 8px; background-color: #f0f0f0;">
            Pembacaan Tarik Standar<br>
            <span style="font-weight: normal; font-size: 10pt;">
                @if($headUtm && $headUtm->satuan_read_tarik_std)
                    ({{ $headUtm->satuan_read_tarik_std }})
                @else
                    (.........)
                @endif
            </span>
        </td>
        <td colspan="3" class="header" style="border: 1px solid #000; text-align: center; padding: 8px; background-color: #f0f0f0;">
            Pembacaan Tarik UUT<br>
            <span style="font-weight: normal; font-size: 10pt;">
                @if($headUtm && $headUtm->satuan_read_tarik_uut)
                    ({{ $headUtm->satuan_read_tarik_uut }})
                @else
                    (.........)
                @endif
            </span>
        </td>
    </tr>

    <!-- Baris 2: Derajat dan Input Satuan -->
    <tr>
        <!-- Kolom untuk satuan titik ukur (rowspan 2) -->
        <td rowspan="2" style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #e8e8e8; vertical-align: middle;">
            <span style="font-weight: normal; font-size: 10pt;">
                @if($headUtm && $headUtm->satuan_titik_ukur_tarik)
                    ({{ $headUtm->satuan_titik_ukur_tarik }})
                @else
                    (.........)
                @endif
            </span>
        </td>
        <!-- Derajat Standar -->
        <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #e8e8e8;">0°</td>
        <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #e8e8e8;">120°</td>
        <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #e8e8e8;">240°</td>
        <!-- Derajat UUT -->
        <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #e8e8e8;">0°</td>
        <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #e8e8e8;">120°</td>
        <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #e8e8e8;">240°</td>
    </tr>

    <!-- Baris 3: Angka -->
    <tr>
        <!-- Angka Standar -->
        <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #f8f8f8; font-weight: bold;">1</td>
        <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #f8f8f8; font-weight: bold;">2</td>
        <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #f8f8f8; font-weight: bold;">3</td>
        <!-- Angka UUT -->
        <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #f8f8f8; font-weight: bold;">1</td>
        <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #f8f8f8; font-weight: bold;">2</td>
        <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #f8f8f8; font-weight: bold;">3</td>
    </tr>

    <!-- DATA TARIK - Maksimal 8 Baris -->
    @if($dataTarik->count() > 0)
        @foreach($dataTarik as $index => $detail)
        <tr>
            <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">
                {{ $detail->titikUkur ? number_format($detail->titikUkur, 2) : '-' }}
            </td>
            <!-- Pembacaan Tarik Standar -->
            <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">
                {{ $detail->readTarikSTD1 ? number_format($detail->readTarikSTD1, 2) : '-' }}
            </td>
            <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">
                {{ $detail->readTarikSTD2 ? number_format($detail->readTarikSTD2, 2) : '-' }}
            </td>
            <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">
                {{ $detail->readTarikSTD3 ? number_format($detail->readTarikSTD3, 2) : '-' }}
            </td>
            <!-- Pembacaan Tarik UUT -->
            <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">
                {{ $detail->readTarikUUT1 ? number_format($detail->readTarikUUT1, 2) : '-' }}
            </td>
            <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">
                {{ $detail->readTarikUUT2 ? number_format($detail->readTarikUUT2, 2) : '-' }}
            </td>
            <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">
                {{ $detail->readTarikUUT3 ? number_format($detail->readTarikUUT3, 2) : '-' }}
            </td>
        </tr>
        @endforeach
        
        <!-- Tambah baris kosong jika data kurang dari 8 -->
        @if($dataTarik->count() < 8)
            @for($i = $dataTarik->count() + 1; $i <= 8; $i++)
            <tr>
                <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">-</td>
                <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">-</td>
                <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">-</td>
                <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">-</td>
                <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">-</td>
                <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">-</td>
                <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">-</td>
            </tr>
            @endfor
        @endif
    @else
        <!-- Tampilkan 8 baris kosong jika tidak ada data -->
        @for($i = 1; $i <= 8; $i++)
        <tr>
            <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">-</td>
            <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">-</td>
            <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">-</td>
            <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">-</td>
            <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">-</td>
            <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">-</td>
            <td style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: middle;">-</td>
        </tr>
        @endfor
    @endif
</table>    

<!-- CSS untuk styling radio button tanpa Bootstrap -->
<style>
/* Custom radio button styling tanpa class Bootstrap */
input[type="radio"] {
    width: 18px;
    height: 18px;
    margin-right: 6px;
    vertical-align: middle;
}

input[type="radio"]:checked {
    /* Warna biru untuk yang checked */
    accent-color: #0d6efd;
}

input[type="radio"]:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

/* Pastikan label dan span visible */
label {
    display: inline-flex !important;
    align-items: center !important;
    margin-right: 5px !important;
}

span {
    display: inline-block !important;
    visibility: visible !important;
}
</style>







            <p style="margin-top:0.35pt; font-size:9pt">&nbsp;</p>



<style>
/* KHUSUS tabel data kalibrasi */
.kalibrasi-simple {
    width: 100%;
    border-collapse: collapse;
    border: 1px solid #000;
    font-size: 10pt;
}

.kalibrasi-simple td {
    border: 1px solid #000;
    padding: 6px 5px;
    text-align: center;
    vertical-align: middle;
}

.kalibrasi-simple .bold {
    font-weight: bold;
}

/* Input agar menyatu dengan tabel */
.kalibrasi-simple input {
    width: 100%;
    border: none;
    outline: none;
    text-align: center;
    font-size: 10pt;
    padding: 3px 0;
    background: transparent;
}

/* Opsional: efek saat diketik */
.kalibrasi-simple input:focus {
    background-color: #f5f5f5;
}
</style>

         

          <!-- Footer Section - VIEW DATA -->
<table style="width: 100%; max-width: 1100px; margin: 20px auto; border-collapse: collapse; background-color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
    <!-- Judul Instruksi -->
    <tr>
        <td colspan="12" style="font-weight: bold; font-size: 18px; background-color: #f0f0f0; border: 1px solid #000; padding: 12px; text-align: center;">
            Isilah lembar data kalibrasi dengan lengkap dan jelas!
        </td>
    </tr>

    <!-- Alat Standar -->
    <tr>
        <td rowspan="2" style="font-weight: bold; background-color: #e0e0e0; width:15%; border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;">Alat Standar</td>
        <td rowspan="2" colspan="5" style="border: 1px solid #000; padding: 15px; text-align: left; vertical-align: middle;">
            <!-- Container untuk checkbox alat standar -->
            <div style="display: flex; flex-direction: column; gap: 12px; padding: 0 10px;">
                <!-- Option 1 - Ambil dari calibration->headUtm -->
                <div style="display: flex; align-items: center; padding: 5px 0;">
                    <input type="checkbox" name="alat_standar_text" value="Loadcell, 1Ton, ST2-C3-It ; JIE115587" 
                           style="margin-right: 12px; width: 18px; height: 18px;" disabled 
                           @if(isset($calibration) && isset($calibration->headUtm) && str_contains($calibration->headUtm->standard ?? '', 'Loadcell, 1Ton, ST2-C3-It ; JIE115587')) checked @endif>
                    <span style="font-size: 11.5pt; font-weight: normal;">Loadcell, 1Ton, ST2-C3-It ; JIE115587</span>
                </div>
                
                <!-- Option 2 - Ambil dari calibration->headUtm -->
                <div style="display: flex; align-items: center; padding: 5px 0;">
                    <input type="checkbox" name="alat_standar_text" value="Loadcell, 250Kg, STI-C3-250; J025B58363" 
                           style="margin-right: 12px; width: 18px; height: 18px;" disabled
                           @if(isset($calibration) && isset($calibration->headUtm) && str_contains($calibration->headUtm->standard ?? '', 'Loadcell, 250Kg, STI-C3-250; J025B58363')) checked @endif>
                    <span style="font-size: 11.5pt; font-weight: normal;">Loadcell, 250Kg, STI-C3-250; J025B58363</span>
                </div>
            </div>
        </td>
        <td colspan="3" style="font-weight: bold; background-color: #e0e0e0; border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;">Dikalibrasi oleh</td>
        <td colspan="3" style="font-weight: bold; background-color: #e0e0e0; border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;">Diperiksa oleh</td>
    </tr>
    
    <tr>
        <!-- Area TTD Kalibrator -->
        <td colspan="3" style="height: 120px; vertical-align: top; text-align: center; padding: 15px; border: 1px solid #000;">
            <div style="text-align: center;">
                TTD:<br><br>
                <!-- Area tanda tangan -->
            </div>
        </td>
        
        <!-- Area TTD Verifikator -->
        <td colspan="3" style="height: 120px; vertical-align: top; text-align: center; padding: 15px; border: 1px solid #000;">
            <div style="text-align: center;">
                TTD:<br><br>
                <!-- Area tanda tangan -->
            </div>
        </td>
    </tr>

    <!-- Metode Kalibrasi + Nama -->
    <tr>
        <td style="font-weight: bold; background-color: #e0e0e0; border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;">Metode Kalibrasi</td>
        <td colspan="5" style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle; font-size: 11.5pt;">
            PAS-IK1102-54
        </td>
        <td colspan="3" style="border: 1px solid #000; padding: 12px; text-align: left; vertical-align: middle;">
            <div style="display: flex; align-items: center; justify-content: center;">
                <span style="margin-right: 10px; font-weight: bold;">Nama:</span>
                <div style="flex: 1; border-bottom: 1px solid #000; padding: 5px 0;">
                    <input type="text" name="calibrated_by" 
                           style="width: 100%; border: none; background: transparent; text-align: center; font-size: 11pt;" 
                           readonly 
                           value="{{ $calibration->calibratedBy ?? '' }}">
                </div>
            </div>
        </td>
        <td colspan="3" style="border: 1px solid #000; padding: 12px; text-align: left; vertical-align: middle;">
            <div style="display: flex; align-items: center; justify-content: center;">
                <span style="margin-right: 10px; font-weight: bold;">Nama:</span>
                <div style="flex: 1; border-bottom: 1px solid #000; padding: 5px 0;">
                    <input type="text" name="verified_by" 
                           style="width: 100%; border: none; background: transparent; text-align: center; font-size: 11pt;" 
                           readonly 
                           value="{{ $calibration->verifiedBy ?? '' }}">
                </div>
            </div>
        </td>
    </tr>
</table>

<!-- Action Buttons Section -->
            <div class="row mt-5">
                <div class="col-12 text-center">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary btn-lg" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                    
                    <button onclick="window.print()" class="btn btn-primary btn-lg ms-3" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
                        <i class="fas fa-print me-2"></i>Cetak
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>