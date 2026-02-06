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
                        <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK16</p>
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
                        <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">ANAK TIMBANGAN</p>
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
                        <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;">{{ $calibration->headAnakTimbangan->certificate_id ?? 'N/A' }}</p>
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

           <!-- ================= DATA KALIBRASI - VIEW MODE ================= -->
@php
    // Ambil data dari database
    $headData = $calibration->headAnakTimbangan ?? null;
    $detailData = $calibration->detailAnakTimbangans ?? collect();
    
    if($headData) {
        $satuanUnit01 = $headData->satuan_unit01 ?? '';
        $satuanUnit02 = $headData->satuan_unit02 ?? '';
        $standard = $headData->standard ?? '';
        $calibrationMethod = $headData->calibrationMethod ?? '';
    } else {
        $satuanUnit01 = '';
        $satuanUnit02 = '';
        $standard = '';
        $calibrationMethod = '';
    }
    
    // Debug log
    \Log::info('📊 VIEW ANAK TIMBANGAN DATA:', [
        'head_exists' => !is_null($headData),
        'detail_count' => $detailData->count(),
        'detail_data' => $detailData->toArray()
    ]);
@endphp

<style>
    .kalibrasi-table {
        width: 100%;
        border-collapse: collapse;
        font-family: Arial, sans-serif;
        font-size: 12px;
    }

    .kalibrasi-table th,
    .kalibrasi-table td {
        border: 1px solid #000;
        padding: 6px;
        text-align: center;
        vertical-align: middle;
    }

    .kalibrasi-table .data-cell {
        min-height: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .left {
        text-align: left;
    }
</style>

<div class="data-kalibrasi-header" style="color: #000000; font-weight: bold; margin-bottom: 10px; text-align: center;">
    DATA KALIBRASI ANAK TIMBANGAN
</div>


<table class="kalibrasi-table">
    <thead>
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Massa Nominal</th>
            <th colspan="3">Pembacaan Timbangan</th>
            <th colspan="3">Pembacaan Timbangan</th>
            <th rowspan="2">AT Standard</th>
        </tr>
        <tr>
            <th colspan="3">
                Unit (
                <span style="display: inline-block; width: 50px; border-bottom: 1px solid #000; text-align: center;">
                    {{ $satuanUnit01 }}
                </span>
                )
            </th>
            <th colspan="3">
                Unit (
                <span style="display: inline-block; width: 50px; border-bottom: 1px solid #000; text-align: center;">
                    {{ $satuanUnit02 }}
                </span>
                )
            </th>
        </tr>
    </thead>
    <tbody>
        @php
            // Ambil maksimal 5 data pertama
            $maxData = min(5, $detailData->count());
        @endphp
        
        @if($detailData->count() > 0)
            @for($i = 0; $i < $maxData; $i++)
                @php
                    $currentData = $detailData->get($i);
                    
                    if(!$currentData) {
                        continue;
                    }
                    
                    // Default values
                    $massaNominal = $currentData->nominalAlat ?? '';
                    $atStandard = $currentData->ATSTD ?? '';
                    
                    // Nilai untuk 4 baris
                    $unit01_s_1 = $currentData->ULSTD ?? '';
                    $unit02_s_1 = $currentData->URSTD ?? '';
                    $unit01_t_1 = $currentData->ULUUT ?? '';
                    $unit02_t_1 = $currentData->URUUT ?? '';
                    $unit01_t_2 = $currentData->LLUUT ?? '';
                    $unit02_t_2 = $currentData->LRUUT ?? '';
                    $unit01_s_2 = $currentData->LLSTD ?? '';
                    $unit02_s_2 = $currentData->LRSTD ?? '';
                    
                    // Format angka jika perlu
                    $formatNumber = function($value) {
                        if (is_numeric($value)) {
                            return number_format($value, 5, '.', '');
                        }
                        return $value;
                    };
                @endphp
                
                <!-- Baris 1: S - S -->
                <tr>
                    <td rowspan="4">{{ $i + 1 }}</td>
                    <td rowspan="4">
                        <div class="data-cell">{{ $massaNominal }}</div>
                    </td>
                    <td>S</td>
                    <td colspan="2">
                        <div class="data-cell">{{ $formatNumber($unit01_s_1) }}</div>
                    </td>
                    <td>S</td>
                    <td colspan="2">
                        <div class="data-cell">{{ $formatNumber($unit02_s_1) }}</div>
                    </td>
                    <td rowspan="4">
                        <div class="data-cell">{{ $atStandard }}</div>
                    </td>
                </tr>
                
                <!-- Baris 2: T - T -->
                <tr>
                    <td>T</td>
                    <td colspan="2">
                        <div class="data-cell">{{ $formatNumber($unit01_t_1) }}</div>
                    </td>
                    <td>T</td>
                    <td colspan="2">
                        <div class="data-cell">{{ $formatNumber($unit02_t_1) }}</div>
                    </td>
                </tr>
                
                <!-- Baris 3: T - T -->
                <tr>
                    <td>T</td>
                    <td colspan="2">
                        <div class="data-cell">{{ $formatNumber($unit01_t_2) }}</div>
                    </td>
                    <td>T</td>
                    <td colspan="2">
                        <div class="data-cell">{{ $formatNumber($unit02_t_2) }}</div>
                    </td>
                </tr>
                
                <!-- Baris 4: S - S -->
                <tr>
                    <td>S</td>
                    <td colspan="2">
                        <div class="data-cell">{{ $formatNumber($unit01_s_2) }}</div>
                    </td>
                    <td>S</td>
                    <td colspan="2">
                        <div class="data-cell">{{ $formatNumber($unit02_s_2) }}</div>
                    </td>
                </tr>
            @endfor
            
            <!-- Jika data kurang dari 5, tampilkan baris kosong -->
            @if($detailData->count() < 5)
                @for($i = $detailData->count(); $i < 5; $i++)
                    <!-- Baris 1: S - S -->
                    <tr>
                        <td rowspan="4">{{ $i + 1 }}</td>
                        <td rowspan="4">
                            <div class="data-cell"></div>
                        </td>
                        <td>S</td>
                        <td colspan="2">
                            <div class="data-cell"></div>
                        </td>
                        <td>S</td>
                        <td colspan="2">
                            <div class="data-cell"></div>
                        </td>
                        <td rowspan="4">
                            <div class="data-cell"></div>
                        </td>
                    </tr>
                    
                    <!-- Baris 2: T - T -->
                    <tr>
                        <td>T</td>
                        <td colspan="2">
                            <div class="data-cell"></div>
                        </td>
                        <td>T</td>
                        <td colspan="2">
                            <div class="data-cell"></div>
                        </td>
                    </tr>
                    
                    <!-- Baris 3: T - T -->
                    <tr>
                        <td>T</td>
                        <td colspan="2">
                            <div class="data-cell"></div>
                        </td>
                        <td>T</td>
                        <td colspan="2">
                            <div class="data-cell"></div>
                        </td>
                    </tr>
                    
                    <!-- Baris 4: S - S -->
                    <tr>
                        <td>S</td>
                        <td colspan="2">
                            <div class="data-cell"></div>
                        </td>
                        <td>S</td>
                        <td colspan="2">
                            <div class="data-cell"></div>
                        </td>
                    </tr>
                @endfor
            @endif
        @else
            <!-- Jika tidak ada data sama sekali -->
            @for($i = 1; $i <= 5; $i++)
                <!-- Baris 1: S - S -->
                <tr>
                    <td rowspan="4">{{ $i }}</td>
                    <td rowspan="4">
                        <div class="data-cell"></div>
                    </td>
                    <td>S</td>
                    <td colspan="2">
                        <div class="data-cell"></div>
                    </td>
                    <td>S</td>
                    <td colspan="2">
                        <div class="data-cell"></div>
                    </td>
                    <td rowspan="4">
                        <div class="data-cell"></div>
                    </td>
                </tr>
                
                <!-- Baris 2: T - T -->
                <tr>
                    <td>T</td>
                    <td colspan="2">
                        <div class="data-cell"></div>
                    </td>
                    <td>T</td>
                    <td colspan="2">
                        <div class="data-cell"></div>
                    </td>
                </tr>
                
                <!-- Baris 3: T - T -->
                <tr>
                    <td>T</td>
                    <td colspan="2">
                        <div class="data-cell"></div>
                    </td>
                    <td>T</td>
                    <td colspan="2">
                        <div class="data-cell"></div>
                    </td>
                </tr>
                
                <!-- Baris 4: S - S -->
                <tr>
                    <td>S</td>
                    <td colspan="2">
                        <div class="data-cell"></div>
                    </td>
                    <td>S</td>
                    <td colspan="2">
                        <div class="data-cell"></div>
                    </td>
                </tr>
            @endfor
        @endif
        
        <!-- ===== KETERANGAN ===== -->
        <tr>
            <td colspan="9" class="left">
                <strong>S</strong> : anak timbang (Standard)<br>
                <strong>T</strong> : anak timbang (UUT)
            </td>
        </tr>
    </tbody>
</table>


         @php
    // Ambil data dari database
    $headData = $calibration->headAnakTimbangan ?? null;
    
    // Ambil alat standar yang sudah disimpan
    $alatStandar = $headData->standard ?? '';
    
    // Pisahkan alat standar jika disimpan sebagai string (dipisahkan koma)
    $alatStandarArray = [];
    if (!empty($alatStandar)) {
        $alatStandarArray = array_map('trim', explode(',', $alatStandar));
    }
@endphp

<!-- SPACE DI ATAS -->
<div style="height: 10px;"></div>

<table cellspacing="0" cellpadding="5" style="width:100%; border-collapse:collapse; font-size:12pt;">
    <tr>
        <td colspan="4" style="border:1px solid #000; text-align:center; font-weight:bold;">
            Isilah lembar data kalibrasi dengan lengkap dan jelas!
        </td>
    </tr>

    <tr>
        <td style="border:1px solid #000; width:20%;text-align:center;">Alat Standar</td>
        <td style="border:1px solid #000; width:30%;">
            <!-- CHECKBOX DENGAN CEKLIS DI DALAM KOTAK (READONLY) -->
            <label style="display:block;">
                <input type="checkbox" class="alat-standar-checkbox" {{ in_array('Timbangan digital (Rinstrum)', $alatStandarArray) ? 'checked' : '' }} 
                       style="pointer-events: none;" readonly disabled>
                Timbangan digital (Rinstrum)
            </label>

            <label style="display:block;">
                <input type="checkbox" class="alat-standar-checkbox" {{ in_array('Timbangan digital 3100 g (AND)', $alatStandarArray) ? 'checked' : '' }} 
                       style="pointer-events: none;" readonly disabled>
                Timbangan digital 3100 g (AND)
            </label>

            <label style="display:block;">
                <input type="checkbox" class="alat-standar-checkbox" {{ in_array('Timbangan digital 250 g (AND)', $alatStandarArray) ? 'checked' : '' }} 
                       style="pointer-events: none;" readonly disabled>
                Timbangan digital 250 g (AND)
            </label>

            <label style="display:block;">
                <input type="checkbox" class="alat-standar-checkbox" {{ in_array('Timbangan digital (BEL)', $alatStandarArray) ? 'checked' : '' }} 
                       style="pointer-events: none;" readonly disabled>
                Timbangan digital (BEL)
            </label>

            <label style="display:block;">
                <input type="checkbox" class="alat-standar-checkbox" {{ in_array('Timbangan digital (Radwag)', $alatStandarArray) ? 'checked' : '' }} 
                       style="pointer-events: none;" readonly disabled>
                Timbangan digital (Radwag)
            </label>
            
            <!-- Tampilkan data alat standar yang tersimpan -->
            @if(!empty($alatStandar))
                <div style="margin-top: 5px; font-size: 11px; color: #666;">
                    <em>Data tersimpan: {{ $alatStandar }}</em>
                </div>
            @endif
        </td>

        <td style="border:1px solid #000; width:25%; text-align:center;">Dikalibrasi oleh</td>
        <td style="border:1px solid #000; width:25%; text-align:center;">Diperiksa oleh</td>
    </tr>

    <tr>
        <td style="border:1px solid #000;text-align:center;">Metode Kalibrasi</td>
        <td style="border:1px solid #000;">PAS-IK1102-16</td>

        <!-- Dikalibrasi oleh -->
        <td style="border:1px solid #000; vertical-align:top;">
            TTD:<br><br><br>
            Nama: <input type="text" value="{{ $calibration->calibratedBy ?? '' }}" style="width:95%; font-size:12pt;" readonly disabled>
        </td>

        <!-- Diperiksa oleh -->
        <td style="border:1px solid #000; vertical-align:top;">
            TTD:<br><br><br>
            Nama: <input type="text" value="{{ $calibration->verifiedBy ?? '' }}" style="width:95%; font-size:12pt;" readonly disabled>
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