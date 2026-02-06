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
                        <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK30</p>
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
                        <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">THERMOMETER</p>
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
                        <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;">{{ $calibration->headThermometer->certificate_id ?? 'N/A' }}</p>
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

                     <tr>
    <td>
        <p style="margin: 0; color: #000000;">Rentang Ukur</p>
    </td>
    <td colspan="3">
        <div class="d-flex align-items-center">
            <!-- Tampilkan nilai Min -->
            <div class="me-3" style="width: 45%;">
                <input type="text" 
                       class="kalibrasi-input" 
                       value="{{ isset($calibration->rangeMin) ? $calibration->rangeMin : '0' }}" 
                       readonly 
                       style="width: 100%;">
            </div>
            
            <span class="me-3" style="color: #000000;">-</span>
            
            <!-- Tampilkan nilai Max -->
            <div style="width: 45%;">
                <input type="text" 
                       class="kalibrasi-input" 
                       value="{{ isset($calibration->rangeMax) ? $calibration->rangeMax : '0' }}" 
                       readonly 
                       style="width: 100%;">
            </div>
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
                                       {{ $calibration->tempatKalibrasi == 'lab' ? 'checked' : '' }} disabled>
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


         <!-- Data Kalibrasi Section -->
<div class="data-kalibrasi-header" style="color: #000000;">DATA KALIBRASI</div>
<div class="setting-suhu-container" style="margin-bottom: 30px;">
    <div style="display: flex; justify-content: space-between;">
        
      <style>
    .suhu-table-container {
        width: 100%;
        display: flex;
        justify-content: space-between;
        gap: 4%;
        margin-bottom: 20px;
    }
    
    .suhu-table {
        border-collapse: collapse;
        width: 48%;
        table-layout: fixed;
        font-family: Arial, sans-serif;
    }
    
    .suhu-table th,
    .suhu-table td {
        border: 1pt solid #000;
        padding: 2px 1px;
        text-align: center;
        vertical-align: middle;
        overflow: hidden;
    }
    
    .suhu-table th {
        font-size: 8pt !important;
        background-color: #f0f0f0;
        font-weight: bold;
        line-height: 1;
        height: 20px;
    }
    
    .suhu-table td {
        font-size: 8pt;
        background-color: #f8f9fa;
        line-height: 1;
    }
    
    .header-container {
        padding: 0;
        margin: 0;
        line-height: 1;
    }
    
    .setting-suhu-header {
        font-size: 8pt;
        font-weight: bold;
        padding: 0;
        margin: 0;
        line-height: 1;
    }
    
    .satuan-suhu {
        font-size: 7pt;
        font-weight: normal;
        display: block;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 100%;
        line-height: 1;
        padding: 0;
        margin: 0;
        margin-top: 1px;
    }
    
    .pembacaan-header {
        font-size: 8pt;
        font-weight: bold;
        line-height: 1;
        padding: 0;
        margin: 0;
    }
    
    .std-uut-header {
        font-size: 8pt;
        font-weight: bold;
        line-height: 1;
        padding: 0;
        margin: 0;
    }
    
    .data-cell {
        display: inline-block;
        width: 100%;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        line-height: 1;
    }
    
    .data-cell-large {
        font-size: 8pt;
    }
    
    .data-cell-small {
        font-size: 7.5pt;
    }
    
    .setting-column {
        width: 35%;
        min-width: 60px;
    }
    
    .std-column,
    .uut-column {
        width: 32.5%;
        min-width: 50px;
    }
</style>

@php
    // DEBUG 1: Cek head_thermometer
    $headThermometer = $calibration->headThermometer ?? null;
    $headThermometerId = $headThermometer->id ?? null;
    
    // Ambil satuan dari head_thermometer (kiri dan kanan)
    $satuanSuhuKiri = $headThermometer->satuan_suhu_kiri ?? '';
    $satuanSuhuKanan = $headThermometer->satuan_suhu_kanan ?? '';

    // ⭐⭐ PERBAIKAN: Tambahkan debug langsung ke HTML untuk cek data
    echo "<!-- VIEW DEBUG:\n";
    echo "Calibration ID: " . $calibration->id . "\n";
    echo "Has Head Thermometer: " . (!is_null($headThermometer) ? 'YES' : 'NO') . "\n";
    echo "Satuan Kiri: '$satuanSuhuKiri'\n";
    echo "Satuan Kanan: '$satuanSuhuKanan'\n";
    
    // PERBAIKAN UTAMA: Ambil data detail berdasarkan calibration->id
    $allRecords = \DB::table('detail_thermometers')
        ->where('calibration_id', $calibration->id)
        ->orderBy('id')
        ->get();
    
    $detailThermometers = collect($allRecords);
    
    echo "Total records from DB: " . $detailThermometers->count() . "\n";
    
    // Tampilkan SEMUA data
    echo "\nALL DETAILS:\n";
    foreach($detailThermometers as $index => $item) {
        echo "Index $index: ID=" . $item->id . 
             ", cal_id=" . $item->calibration_id . 
             ", titikUkur=" . ($item->titikUkur ?? 'NULL') . 
             ", STD01=" . ($item->STD01 ?? 'NULL') . 
             ", UUT01=" . ($item->UUT01 ?? 'NULL') . "\n";
    }
    echo "-->";

    // Selalu siapkan 6 baris untuk kiri dan 6 baris untuk kanan (total 12)
    $totalRows = 6;
    
    // ⭐⭐ PERBAIKAN: Gunakan array access langsung, jangan slice
    $leftDetails = [];
    $rightDetails = [];
    
    // Data kiri: index 0-5
    for ($i = 0; $i < 6; $i++) {
        $leftDetails[$i] = $detailThermometers->get($i) ?? (object)[
            'id' => null,
            'titikUkur' => null,
            'STD01' => null, 'STD02' => null, 'STD03' => null,
            'UUT01' => null, 'UUT02' => null, 'UUT03' => null
        ];
    }
    
    // Data kanan: index 6-11  
    for ($i = 6; $i < 12; $i++) {
        $rightDetails[$i - 6] = $detailThermometers->get($i) ?? (object)[
            'id' => null,
            'titikUkur' => null,
            'STD01' => null, 'STD02' => null, 'STD03' => null,
            'UUT01' => null, 'UUT02' => null, 'UUT03' => null
        ];
    }
    
    // Konversi ke collection
    $leftDetails = collect($leftDetails);
    $rightDetails = collect($rightDetails);
    
    // Debug split
    echo "<!-- DATA SPLIT DEBUG:\n";
    echo "Left details count: " . $leftDetails->count() . "\n";
    echo "Right details count: " . $rightDetails->count() . "\n";
    
    echo "\nLEFT DETAILS:\n";
    foreach($leftDetails as $i => $detail) {
        echo "  [$i] ID: " . ($detail->id ?? 'null') . 
             ", titik: " . ($detail->titikUkur ?? 'null') . "\n";
    }
    
    echo "\nRIGHT DETAILS:\n";
    foreach($rightDetails as $i => $detail) {
        echo "  [$i] ID: " . ($detail->id ?? 'null') . 
             ", titik: " . ($detail->titikUkur ?? 'null') . "\n";
    }
    echo "-->";

    // Gunakan satuan dari head_thermometer untuk masing-masing tabel
    $leftSatuan = !empty($satuanSuhuKiri) ? $satuanSuhuKiri : '(......)';
    $rightSatuan = !empty($satuanSuhuKanan) ? $satuanSuhuKanan : '(......)';

@endphp

<div class="suhu-table-container">
    <!-- Tabel Kiri -->
    <table class="suhu-table">
        <tr>
            <th rowspan="2" class="setting-column" style="height: 25px;">
                <div class="header-container">
                    <div class="setting-suhu-header">Setting Suhu</div>
                    <span class="satuan-suhu">{{ $leftSatuan }}</span>
                </div>
            </th>
            <th colspan="2" class="pembacaan-header" style="height: 12px;">Pembacaan</th>
        </tr>
        <tr>
            <th class="std-column std-uut-header" style="height: 12px;">STD</th>
            <th class="uut-column std-uut-header" style="height: 12px;">UUT</th>
        </tr>
        
        @for($i = 0; $i < $totalRows; $i++)
            @php
                $detail = $leftDetails[$i] ?? null;
                // ⭐⭐ PERBAIKAN: Jangan konversi ke array, tetap sebagai object
                $isNullDetail = is_null($detail->id ?? null);
            @endphp
            <tr>
                <td rowspan="3" style="height: 90px; padding: 2px;">
                    <span class="data-cell data-cell-large">
                        {{ !$isNullDetail && isset($detail->titikUkur) ? $detail->titikUkur : '-' }}
                    </span>
                </td>
                <td style="height: 30px; padding: 2px;">
                    <span class="data-cell data-cell-small">
                        {{ !$isNullDetail && isset($detail->STD01) ? number_format($detail->STD01, 3) : '-' }}
                    </span>
                </td>
                <td style="height: 30px; padding: 2px;">
                    <span class="data-cell data-cell-small">
                        {{ !$isNullDetail && isset($detail->UUT01) ? number_format($detail->UUT01, 3) : '-' }}
                    </span>
                </td>
            </tr>
            <tr>
                <td style="height: 30px; padding: 2px;">
                    <span class="data-cell data-cell-small">
                        {{ !$isNullDetail && isset($detail->STD02) ? number_format($detail->STD02, 3) : '-' }}
                    </span>
                </td>
                <td style="height: 30px; padding: 2px;">
                    <span class="data-cell data-cell-small">
                        {{ !$isNullDetail && isset($detail->UUT02) ? number_format($detail->UUT02, 3) : '-' }}
                    </span>
                </td>
            </tr>
            <tr>
                <td style="height: 30px; padding: 2px;">
                    <span class="data-cell data-cell-small">
                        {{ !$isNullDetail && isset($detail->STD03) ? number_format($detail->STD03, 3) : '-' }}
                    </span>
                </td>
                <td style="height: 30px; padding: 2px;">
                    <span class="data-cell data-cell-small">
                        {{ !$isNullDetail && isset($detail->UUT03) ? number_format($detail->UUT03, 3) : '-' }}
                    </span>
                </td>
            </tr>
        @endfor
    </table>

    <!-- Tabel Kanan -->
    <table class="suhu-table">
        <tr>
            <th rowspan="2" class="setting-column" style="height: 25px;">
                <div class="header-container">
                    <div class="setting-suhu-header">Setting Suhu</div>
                    <span class="satuan-suhu">{{ $rightSatuan }}</span>
                </div>
            </th>
            <th colspan="2" class="pembacaan-header" style="height: 12px;">Pembacaan</th>
        </tr>
        <tr>
            <th class="std-column std-uut-header" style="height: 12px;">STD</th>
            <th class="uut-column std-uut-header" style="height: 12px;">UUT</th>
        </tr>
        
        @for($i = 0; $i < $totalRows; $i++)
            @php
                $detail = $rightDetails[$i] ?? null;
                // ⭐⭐ PERBAIKAN: Jangan konversi ke array
                $isNullDetail = is_null($detail->id ?? null);
            @endphp
            <tr>
                <td rowspan="3" style="height: 90px; padding: 2px;">
                    <span class="data-cell data-cell-large">
                        {{ !$isNullDetail && isset($detail->titikUkur) ? $detail->titikUkur : '-' }}
                    </span>
                </td>
                <td style="height: 30px; padding: 2px;">
                    <span class="data-cell data-cell-small">
                        {{ !$isNullDetail && isset($detail->STD01) ? number_format($detail->STD01, 3) : '-' }}
                    </span>
                </td>
                <td style="height: 30px; padding: 2px;">
                    <span class="data-cell data-cell-small">
                        {{ !$isNullDetail && isset($detail->UUT01) ? number_format($detail->UUT01, 3) : '-' }}
                    </span>
                </td>
            </tr>
            <tr>
                <td style="height: 30px; padding: 2px;">
                    <span class="data-cell data-cell-small">
                        {{ !$isNullDetail && isset($detail->STD02) ? number_format($detail->STD02, 3) : '-' }}
                    </span>
                </td>
                <td style="height: 30px; padding: 2px;">
                    <span class="data-cell data-cell-small">
                        {{ !$isNullDetail && isset($detail->UUT02) ? number_format($detail->UUT02, 3) : '-' }}
                    </span>
                </td>
            </tr>
            <tr>
                <td style="height: 30px; padding: 2px;">
                    <span class="data-cell data-cell-small">
                        {{ !$isNullDetail && isset($detail->STD03) ? number_format($detail->STD03, 3) : '-' }}
                    </span>
                </td>
                <td style="height: 30px; padding: 2px;">
                    <span class="data-cell data-cell-small">
                        {{ !$isNullDetail && isset($detail->UUT03) ? number_format($detail->UUT03, 3) : '-' }}
                    </span>
                </td>
            </tr>
        @endfor
    </table>
</div>
    </div>
</div>
            <!-- Footer Section -->
           <!-- Data Complete Section -->
                    <div class="data-complete-section">
                        <span class="data-complete-text">Data telah diisi dengan lengkap dan jelas!</span>
                    </div>

                    <!-- ALAT STANDAR + CHECKBOX -->
                    <table class="alat-standar-table">
    <tr style="height:13.5pt">
        <td rowspan="4" style="width:105.35pt; border:1pt solid #000; vertical-align:middle; text-align:center; font-weight:bold; font-size:10pt; color:#000000;">
            Standard
        </td>

        <td style="width:24.75pt; border:1pt solid #000; text-align:center; vertical-align:middle;">
            <input type="checkbox" class="alat-standar-checkbox" value="TD.001" id="std1" 
                {{ str_contains($calibration->headThermometer->standard ?? '', 'TD.001') ? 'checked' : '' }} disabled>
        </td>
        <td style="width:63.6pt; border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
            <label for="std1" style="cursor:pointer; color:#000000;">TD.001</label>
        </td>
        <td style="width:15.55pt; border:1pt solid #000; text-align:center; vertical-align:middle;">
            <input type="checkbox" class="alat-standar-checkbox" value="Microbath" id="jenis1" 
                {{ str_contains($calibration->headThermometer->standard ?? '', 'Microbath') ? 'checked' : '' }} disabled>
        </td>
        <td style="width:84.3pt; border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
            <label for="jenis1" style="cursor:pointer; color:#000000;">Microbath</label>
        </td>

        <td rowspan="4" style="width:111.15pt; border-top:1pt solid #000; border-right:1pt solid #000; border-left:1pt solid #000; border-bottom:none; padding-top:6pt; text-align:center; vertical-align:top; font-size:8.5pt; color:#000000;">
            Dikalibrasi<br>oleh
        </td>
        <td rowspan="4" style="width:98.3pt; border-top:1pt solid #000; border-right:1pt solid #000; border-left:1pt solid #000; border-bottom:none; padding-top:6pt; text-align:center; vertical-align:top; font-size:8.5pt; color:#000000;">
            Diperiksa<br>oleh
        </td>
    </tr>

    <tr style="height:13.5pt">
        <td style="border:1pt solid #000; text-align:center; vertical-align:middle;">
            <input type="checkbox" class="alat-standar-checkbox" value="TD.002" id="std2" 
                {{ str_contains($calibration->headThermometer->standard ?? '', 'TD.002') ? 'checked' : '' }} disabled>
        </td>
        <td style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
            <label for="std2" style="cursor:pointer; color:#000000;">TD.002</label>
        </td>
        <td style="border:1pt solid #000; text-align:center; vertical-align:middle;">
            <input type="checkbox" class="alat-standar-checkbox" value="Dry Block" id="jenis2" 
                {{ str_contains($calibration->headThermometer->standard ?? '', 'Dry Block') ? 'checked' : '' }} disabled>
        </td>
        <td style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
            <label for="jenis2" style="cursor:pointer; color:#000000;">Dry Block</label>
        </td>
    </tr>

    <tr style="height:13.5pt">
        <td style="border:1pt solid #000; text-align:center; vertical-align:middle;">
            <input type="checkbox" class="alat-standar-checkbox" value="TD.003" id="std3" 
                {{ str_contains($calibration->headThermometer->standard ?? '', 'TD.003') ? 'checked' : '' }} disabled>
        </td>
        <td style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
            <label for="std3" style="cursor:pointer; color:#000000;">TD.003</label>
        </td>
        <td rowspan="2" style="width:15.55pt; border:1pt solid #000; text-align:center; vertical-align:middle;">
            <input type="checkbox" class="alat-standar-checkbox" value="Microbath & Dry Block" id="jenis4" 
                {{ str_contains($calibration->headThermometer->standard ?? '', 'Microbath & Dry Block') ? 'checked' : '' }} disabled>
        </td>
        <td rowspan="2" style="width:84.3pt; border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
            <label for="jenis4" style="cursor:pointer; color:#000000;">Microbath & Dry Block</label>
        </td>
    </tr>

    <tr style="height:13.5pt">
        <td style="border:1pt solid #000; text-align:center; vertical-align:middle;">
            <input type="checkbox" class="alat-standar-checkbox" value="TD.004" id="std4" 
                {{ str_contains($calibration->headThermometer->standard ?? '', 'TD.004') ? 'checked' : '' }} disabled>
        </td>
        <td style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
            <label for="std4" style="cursor:pointer; color:#000000;">TD.004</label>
        </td>
    </tr>

    <!-- METODE KALIBRASI + TTD & NAMA -->
<tr style="height:15pt">
    <td rowspan="4" style="width:105.35pt; border:1pt solid #000; vertical-align:middle; text-align:center; font-weight:bold; font-size:10pt; color:#000000;">
        Metode Kalibrasi
    </td>
    
    <td style="width:24.75pt; border:1pt solid #000; text-align:center; vertical-align:middle;">
        <input type="checkbox" class="metode-checkbox" value="PAS-IK1102-30" id="metode1" 
            {{ str_contains($calibration->headThermometer->calibrationMethod ?? '', 'PAS-IK1102-30') ? 'checked' : '' }} disabled>
    </td>
    <td colspan="3" style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
        <label for="metode1" style="cursor:pointer; color:#000000;">PAS-IK1102-30 (Termometer Digital)</label>
    </td>
    
    <td style="width:111.15pt; border-top:none; border-right:1pt solid #000; border-left:1pt solid #000; border-bottom:1pt solid #000; padding:3.35pt 0 0 1.35pt; font-size:8.5pt; vertical-align:top; color:#000000;">
        &nbsp;
    </td>
    <td style="width:98.3pt; border-top:none; border-right:1pt solid #000; border-left:1pt solid #000; border-bottom:1pt solid #000; padding:3.35pt 0 0 1.8pt; font-size:8.5pt; vertical-align:top; color:#000000;">
        &nbsp;
    </td>
</tr>

<tr style="height:15pt">
    <td style="border:1pt solid #000; text-align:center; vertical-align:middle;">
        <input type="checkbox" class="metode-checkbox" value="PAS-IK1102-31" id="metode2" 
            {{ str_contains($calibration->headThermometer->calibrationMethod ?? '', 'PAS-IK1102-31') ? 'checked' : '' }} disabled>
    </td>
    <td colspan="3" style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
        <label for="metode2" style="cursor:pointer; color:#000000;">PAS-IK1102-31 (Termometer Gelas)</label>
    </td>
    
    <td style="width:111.15pt; border-top:none; border-right:1pt solid #000; border-left:1pt solid #000; border-bottom:1pt solid #000; padding:1.8pt 0 0 1.35pt; font-size:8.5pt; vertical-align:top; color:#000000;">
        TTD :
    </td>
    <td style="width:98.3pt; border-top:none; border-right:1pt solid #000; border-left:1pt solid #000; border-bottom:1pt solid #000; padding:1.8pt 0 0 1.8pt; font-size:8.5pt; vertical-align:top; color:#000000;">
        TTD :
    </td>
</tr>

<tr style="height:15pt">
    <td style="border:1pt solid #000; text-align:center; vertical-align:middle;">
        <input type="checkbox" class="metode-checkbox" value="PAS-IK1102-32" id="metode3" 
            {{ str_contains($calibration->headThermometer->calibrationMethod ?? '', 'PAS-IK1102-32') ? 'checked' : '' }} disabled>
    </td>
    <td colspan="3" style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
        <label for="metode3" style="cursor:pointer; color:#000000;">PAS-IK1102-32 (Termometer Dial)</label>
    </td>
    
    <td style="width:111.15pt; border-top:none; border-right:1pt solid #000; border-left:1pt solid #000; border-bottom:1pt solid #000; padding:1.8pt 0 0 1.35pt; font-size:8.5pt; vertical-align:top; color:#000000;">
        <input type="text" class="kalibrasi-input" value="{{ $calibration->calibratedBy ?? '-' }}" readonly style="border: none; width: 100%;">
    </td>
    <td style="width:98.3pt; border-top:none; border-right:1pt solid #000; border-left:1pt solid #000; border-bottom:1pt solid #000; padding:1.8pt 0 0 1.8pt; font-size:8.5pt; vertical-align:top; color:#000000;">
        <input type="text" class="kalibrasi-input" value="{{ $calibration->verifiedBy ?? '-' }}" readonly style="border: none; width: 100%;">
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