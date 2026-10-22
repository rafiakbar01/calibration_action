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
                        <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK63</p>
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
                        <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">PLAIN LIMIT GAUGE</p>
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
                        <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;">{{ $calibration->headPlainLimitGauge->certificate_id ?? 'N/A' }}</p>
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
            <input type="text" name="namaAlat" class="kalibrasi-input" 
                   value="{{ old('namaAlat', $calibration->namaAlat) }}">
        </td>
    </tr>

                        <!-- Merek & Kode -->
    <tr>
        <td><p style="margin:0;color:#000;">Merek</p></td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="text" name="brandAlat" class="kalibrasi-input me-3"
                       value="{{ old('brandAlat', $calibration->brandAlat) }}" style="width:60%;">
                <span class="me-3">Kode Alat :</span>
                <input type="text" name="kodeAlat" class="kalibrasi-input"
                       value="{{ old('kodeAlat', $calibration->kodeAlat) }}" style="width:30%;">
            </div>
        </td>
    </tr>

    <!-- Type / No Seri -->
    <tr>
        <td><p style="margin:0;color:#000;">Type / No. Seri</p></td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="text" name="typeAlat" class="kalibrasi-input me-3"
                       value="{{ old('typeAlat', $calibration->typeAlat) }}" style="width:45%;">
                <span class="me-3">/</span>
                <input type="text" name="NoSeri" class="kalibrasi-input"
                       value="{{ old('NoSeri', $calibration->NoSeri) }}" style="width:45%;">
            </div>
        </td>
    </tr>

    <!-- Kapasitas / Resolusi -->
    <tr>
        <td><p style="margin:0;color:#000;">Kapasitas / Resolusi</p></td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="text" name="kapasitas" class="kalibrasi-input me-3"
                       value="{{ old('kapasitas', $calibration->kapasitas) }}" style="width:45%;">
                <span class="me-3">/</span>
                <input type="text" name="resolusi" class="kalibrasi-input"
                       value="{{ old('resolusi', $calibration->resolusi) }}" style="width:45%;">
            </div>
        </td>
    </tr>

    <!-- Pemilik -->
    <tr>
        <td><p style="margin:0;color:#000;">Nama Pemilik</p></td>
        <td colspan="3">
            <input type="text" name="pemilikAlat" class="kalibrasi-input"
                   value="{{ old('pemilikAlat', $calibration->pemilikAlat) }}">
        </td>
    </tr>

    <!-- Tanggal -->
       <tr>
        <td><p style="margin:0;color:#000;">Tanggal Alat Masuk</p></td>
        <td colspan="3">
            <input type="date" name="tanggalMasuk" class="kalibrasi-input"
                   value="{{ old('tanggalMasuk', \Carbon\Carbon::parse($calibration->tanggalMasuk)->format('Y-m-d')) }}">
        </td>
    </tr>


    <tr>
        <td><p style="margin:0;color:#000;">Tanggal Kalibrasi</p></td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="date" name="tanggalKalibrasi" class="kalibrasi-input me-3"
                       value="{{ old('tanggalKalibrasi', $calibration->tanggalKalibrasi) }}" style="width:45%;">
                <span class="me-3">Jenis Pembacaan:</span>
                <input type="text" name="jenisPembacaan" class="kalibrasi-input"
                       value="{{ old('jenisPembacaan', $calibration->jenisPembacaan) }}" style="width:45%;">
            </div>
        </td>
    </tr>

    <!-- Tempat -->
     <tr>
        <td><p style="margin: 0; color: #000000;">Tempat Kalibrasi</p></td>
        <td colspan="3">
            <div class="d-flex">
                <div class="form-check me-5">
                    <input class="form-check-input" type="radio" name="tempatKalibrasi" value="lab.PT PAS"
                           {{ old('tempatKalibrasi', $calibration->tempatKalibrasi) == 'lab.PT PAS' ? 'checked' : '' }}>
                    <label class="form-check-label">Lab. PT.PAS</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tempatKalibrasi" value="insitu"
                           {{ old('tempatKalibrasi', $calibration->tempatKalibrasi) == 'insitu' ? 'checked' : '' }}>
                    <label class="form-check-label">Insitu</label>
                </div>
            </div>
        </td>
    </tr>

    <!-- Lokasi -->
    <tr>
        <td><p style="margin:0;color:#000;">Lokasi PT</p></td>
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
        <div class="kalibrasi-section-header" style="color:#000000;">
            Fungsi Komponen Lainnya
        </div>

        <!-- Radio -->
        <div class="d-flex justify-content-center align-items-center mb-4" style="gap:60px;">
            <div class="text-center">
                <span class="fw-bold d-block mb-2" style="color:#000000;font-size:14px;">Ok</span>
                <input type="radio" name="kondisiAlat" value="ok" class="form-check-input"
                    style="width:18px;height:18px;display:block;margin:0 auto;"
                    {{ $calibration->kondisiAlat == 'ok' ? 'checked' : '' }}>
            </div>

            <div class="text-center">
                <span class="fw-bold d-block mb-2" style="color:#000000;font-size:14px;">Rusak</span>
                <input type="radio" name="kondisiAlat" value="rusak" class="form-check-input"
                    style="width:18px;height:18px;display:block;margin:0 auto;"
                    {{ $calibration->kondisiAlat == 'rusak' ? 'checked' : '' }}>
            </div>
        </div>

        <!-- Keterangan -->
        <div class="d-flex align-items-center">
            <span class="fw-bold me-3" style="color:#000000;min-width:100px;">Keterangan :</span>
            <div style="flex:1;">
                <input type="text" name="keterangan" class="kalibrasi-input"
                       value="{{ $calibration->keterangan }}"
                       style="border:none;border-bottom:2px solid #000;border-radius:0;
                              padding:4px 0;background:transparent;width:100%;">
            </div>
        </div>
    </div>

    <!-- Kondisi Kalibrasi -->
    <div class="col-md-6 mb-4">
        <div class="kalibrasi-section-header" style="color:#000000;">
            Kondisi Kalibrasi
        </div>

        <table class="table table-bordered">
            <tr>
                <td class="table-secondary fw-bold" style="width:30%;color:#000000;"></td>
                <td class="table-secondary fw-bold text-center">Awal</td>
                <td class="table-secondary fw-bold text-center">Tengah</td>
                <td class="table-secondary fw-bold text-center">Akhir</td>
            </tr>

            <tr>
                <td class="bg-light fw-bold">Suhu (°C)</td>
                <td><input type="text" name="RT_condition1" class="kondisi-input"
                           value="{{ $calibration->RT_condition1 }}"></td>
                <td><input type="text" name="RT_condition2" class="kondisi-input"
                           value="{{ $calibration->RT_condition2 }}"></td>
                <td><input type="text" name="RT_condition3" class="kondisi-input"
                           value="{{ $calibration->RT_condition3 }}"></td>
            </tr>

            <tr>
                <td class="bg-light fw-bold">RH (%)</td>
                <td><input type="text" name="RH_condition1" class="kondisi-input"
                           value="{{ $calibration->RH_condition1 }}"></td>
                <td><input type="text" name="RH_condition2" class="kondisi-input"
                           value="{{ $calibration->RH_condition2 }}"></td>
                <td><input type="text" name="RH_condition3" class="kondisi-input"
                           value="{{ $calibration->RH_condition3 }}"></td>
            </tr>
        </table>
    </div>
</div>




    <!-- Data Kalibrasi Section -->
                <div class="data-kalibrasi-header" style="color: #000000;">DATA KALIBRASI</div>
@php
    // Coba beberapa cara untuk mengambil data
    
    // Cara 1: Cek langsung dari calibration
    $details = null;
    $head = null;
    
    // Debug: Cek apa yang ada di calibration
    // dd($calibration->toArray()); // Uncomment untuk debug
    
    // Coba beberapa kemungkinan nama relasi
    if (method_exists($calibration, 'detailPlainLimitGauge')) {
        $details = $calibration->detailPlainLimitGauge;
        \Log::info('Found detailPlainLimitGauge relation', [
            'count' => $details ? $details->count() : 0
        ]);
    } elseif (method_exists($calibration, 'detailPlainLimitGauges')) {
        $details = $calibration->detailPlainLimitGauges;
        \Log::info('Found detailPlainLimitGauges relation', [
            'count' => $details ? $details->count() : 0
        ]);
    }
    
    // Cek head
    if (method_exists($calibration, 'headPlainLimitGauge')) {
        $head = $calibration->headPlainLimitGauge;
    } elseif (method_exists($calibration, 'headPlainLimitGauges')) {
        $head = $calibration->headPlainLimitGauges;
    }
    
    // Ambil data pertama jika ada
    $detail = $details && $details->count() > 0 ? $details->first() : null;
    
    // Debug langsung di halaman (akan muncul sebagai HTML comment)
    echo "<!-- DEBUG: Calibration ID: " . $calibration->id . " -->\n";
    echo "<!-- DEBUG: Details count: " . ($details ? $details->count() : 0) . " -->\n";
    echo "<!-- DEBUG: Detail exists: " . ($detail ? 'YES' : 'NO') . " -->\n";
    echo "<!-- DEBUG: Head exists: " . ($head ? 'YES' : 'NO') . " -->\n";
    if ($detail) {
        echo "<!-- DEBUG: titikUkurGO: " . ($detail->titikUkurGO ?? 'NULL') . " -->\n";
        echo "<!-- DEBUG: titikUkurNOGO: " . ($detail->titikUkurNOGO ?? 'NULL') . " -->\n";
    }
@endphp

@if($detail)
<!-- Tabel GO -->
<table border="1" cellspacing="0" cellpadding="8" style="float: left; margin-right: 20px; width: 100%; max-width: 800px;">
    <tr>
        <td bgcolor="#e6e6e6" align="center" style="border:1px solid #999;"><strong>Go</strong></td>
        <td colspan="3" bgcolor="#e6e6e6" align="center" style="border:1px solid #999;">&nbsp;</td>
    </tr>
    <tr>
        <td width="25%" bgcolor="#f5f5f5" align="center" style="border:1px solid #999;"><strong>Nilai Nominal</strong></td>
        <td colspan="3" bgcolor="#e6e6e6" align="center" style="border:1px solid #999;"><strong>Penunjukan Standard</strong></td>
    </tr>
    <tr>
        <td width="25%" bgcolor="#f5f5f5" align="center" style="border:1px solid #999;">
            <strong>Unit ( <input type="text" name="satuan_go" value="<?php echo isset($head->satuan_go) && $head->satuan_go !== '' ? $head->satuan_go : ''; ?>" style="display: inline-block; width: 50px; text-align: center; border:none; outline:none;"> )</strong>
        </td>
        <td width="25%" bgcolor="#e6e6e6" align="center" style="border:1px solid #999;"><strong>Posisi</strong></td>
        <td width="25%" bgcolor="#e6e6e6" align="center" style="border:1px solid #999;"><strong>X</strong></td>
        <td width="25%" bgcolor="#e6e6e6" align="center" style="border:1px solid #999;"><strong>Y</strong></td>
    </tr>
    <tr>
        <td rowspan="4" align="center" style="border:1px solid #999;">
            <div style="display: inline-block; width: 90%; max-width: 200px; text-align: center; padding: 10px 0; font-size: 14px;">
                <input type="text" name="go_nominal"
                       value="<?php echo isset($detail->titikUkurGO) && $detail->titikUkurGO !== '' ? $detail->titikUkurGO : ''; ?>"
                       style="width:100%;border:none;background:transparent;text-align:center;font-size:14px;">
            </div>
        </td>
        <td rowspan="2" align="center" style="border:1px solid #999; font-size: 14px;">Atas</td>
        <td align="center" style="border:1px solid #999;">
            <div style="display: inline-block; width: 90%; max-width: 180px; text-align: center; padding: 10px 0; font-size: 14px;">
                <input type="text" name="go_atas_x"
                       value="<?php echo isset($detail->posisiAtasX1) && $detail->posisiAtasX1 !== '' ? $detail->posisiAtasX1 : ''; ?>"
                       style="width:100%;border:none;background:transparent;text-align:center;font-size:14px;">
            </div>
        </td>
        <td align="center" style="border:1px solid #999;">
            <div style="display: inline-block; width: 90%; max-width: 180px; text-align: center; padding: 10px 0; font-size: 14px;">
                <input type="text" name="go_atas_y"
                       value="<?php echo isset($detail->posisiAtasY1) && $detail->posisiAtasY1 !== '' ? $detail->posisiAtasY1 : ''; ?>"
                       style="width:100%;border:none;background:transparent;text-align:center;font-size:14px;">
            </div>
        </td>
    </tr>
    <tr>
        <td align="center" style="border:1px solid #999;">
            <div style="display: inline-block; width: 90%; max-width: 180px; text-align: center; padding: 10px 0; font-size: 14px;">
                <input type="text" name="go_atas_x2"
                       value="<?php echo isset($detail->posisiAtasX2) && $detail->posisiAtasX2 !== '' ? $detail->posisiAtasX2 : ''; ?>"
                       style="width:100%;border:none;background:transparent;text-align:center;font-size:14px;">
            </div>
        </td>
        <td align="center" style="border:1px solid #999;">
            <div style="display: inline-block; width: 90%; max-width: 180px; text-align: center; padding: 10px 0; font-size: 14px;">
                <input type="text" name="go_atas_y2"
                       value="<?php echo isset($detail->posisiAtasY2) && $detail->posisiAtasY2 !== '' ? $detail->posisiAtasY2 : ''; ?>"
                       style="width:100%;border:none;background:transparent;text-align:center;font-size:14px;">
            </div>
        </td>
    </tr>
    <tr>
        <td rowspan="2" align="center" style="border:1px solid #999; font-size: 14px;">Bawah</td>
        <td align="center" style="border:1px solid #999;">
            <div style="display: inline-block; width: 90%; max-width: 180px; text-align: center; padding: 10px 0; font-size: 14px;">
                <input type="text" name="go_bawah_x"
                       value="<?php echo isset($detail->posisiBawahX1) && $detail->posisiBawahX1 !== '' ? $detail->posisiBawahX1 : ''; ?>"
                       style="width:100%;border:none;background:transparent;text-align:center;font-size:14px;">
            </div>
        </td>
        <td align="center" style="border:1px solid #999;">
            <div style="display: inline-block; width: 90%; max-width: 180px; text-align: center; padding: 10px 0; font-size: 14px;">
                <input type="text" name="go_bawah_y"
                       value="<?php echo isset($detail->posisiBawahY1) && $detail->posisiBawahY1 !== '' ? $detail->posisiBawahY1 : ''; ?>"
                       style="width:100%;border:none;background:transparent;text-align:center;font-size:14px;">
            </div>
        </td>
    </tr>
    <tr>
        <td align="center" style="border:1px solid #999;">
            <div style="display: inline-block; width: 90%; max-width: 180px; text-align: center; padding: 10px 0; font-size: 14px;">
                <input type="text" name="go_bawah_x2"
                       value="<?php echo isset($detail->posisiBawahX2) && $detail->posisiBawahX2 !== '' ? $detail->posisiBawahX2 : ''; ?>"
                       style="width:100%;border:none;background:transparent;text-align:center;font-size:14px;">
            </div>
        </td>
        <td align="center" style="border:1px solid #999;">
            <div style="display: inline-block; width: 90%; max-width: 180px; text-align: center; padding: 10px 0; font-size: 14px;">
                <input type="text" name="go_bawah_y2"
                       value="<?php echo isset($detail->posisiBawahY2) && $detail->posisiBawahY2 !== '' ? $detail->posisiBawahY2 : ''; ?>"
                       style="width:100%;border:none;background:transparent;text-align:center;font-size:14px;">
            </div>
        </td>
    </tr>
</table>

<div style="clear: both;"></div>

<br><br>

<!-- Tabel NO GO -->
<table border="1" cellspacing="0" cellpadding="8" style="width: 100%; max-width: 800px;">
    <tr>
        <td bgcolor="#e6e6e6" align="center" style="border:1px solid #999;"><strong>No Go</strong></td>
        <td colspan="3" bgcolor="#e6e6e6" align="center" style="border:1px solid #999;">&nbsp;</td>
    </tr>
    <tr>
        <td width="25%" bgcolor="#f5f5f5" align="center" style="border:1px solid #999;"><strong>Nilai Nominal</strong></td>
        <td colspan="3" bgcolor="#e6e6e6" align="center" style="border:1px solid #999;"><strong>Penunjukan Standard</strong></td>
    </tr>
    <tr>
        <td width="25%" bgcolor="#f5f5f5" align="center" style="border:1px solid #999;">
            <strong>Unit ( <input type="text" name="satuan_no_go" value="<?php echo isset($head->satuan_no_go) && $head->satuan_no_go !== '' ? $head->satuan_no_go : ''; ?>" style="display: inline-block; width: 50px; text-align: center; border:none; outline:none;"> )</strong>
        </td>
        <td width="25%" bgcolor="#e6e6e6" align="center" style="border:1px solid #999;"><strong>Sumbu</strong></td>
        <td width="25%" bgcolor="#e6e6e6" align="center" style="border:1px solid #999;"><strong>X</strong></td>
        <td width="25%" bgcolor="#e6e6e6" align="center" style="border:1px solid #999;"><strong>Y</strong></td>
    </tr>
    <tr>
        <td rowspan="4" align="center" style="border:1px solid #999;">
            <div style="display: inline-block; width: 90%; max-width: 200px; text-align: center; padding: 10px 0; font-size: 14px;">
                <input type="text" name="nogo_nominal"
                       value="<?php echo isset($detail->titikUkurNOGO) && $detail->titikUkurNOGO !== '' ? $detail->titikUkurNOGO : ''; ?>"
                       style="width:100%;border:none;background:transparent;text-align:center;font-size:14px;">
            </div>
        </td>
        <td rowspan="2" align="center" style="border:1px solid #999; font-size: 14px;">Atas</td>
        <td align="center" style="border:1px solid #999;">
            <div style="display: inline-block; width: 90%; max-width: 180px; text-align: center; padding: 10px 0; font-size: 14px;">
                <input type="text" name="nogo_atas_x"
                       value="<?php echo isset($detail->sumbuAtasX1) && $detail->sumbuAtasX1 !== '' ? $detail->sumbuAtasX1 : ''; ?>"
                       style="width:100%;border:none;background:transparent;text-align:center;font-size:14px;">
            </div>
        </td>
        <td align="center" style="border:1px solid #999;">
            <div style="display: inline-block; width: 90%; max-width: 180px; text-align: center; padding: 10px 0; font-size: 14px;">
                <input type="text" name="nogo_atas_y"
                       value="<?php echo isset($detail->sumbuAtasY1) && $detail->sumbuAtasY1 !== '' ? $detail->sumbuAtasY1 : ''; ?>"
                       style="width:100%;border:none;background:transparent;text-align:center;font-size:14px;">
            </div>
        </td>
    </tr>
    <tr>
        <td align="center" style="border:1px solid #999;">
            <div style="display: inline-block; width: 90%; max-width: 180px; text-align: center; padding: 10px 0; font-size: 14px;">
                <input type="text" name="nogo_atas_x2"
                       value="<?php echo isset($detail->sumbuAtasX2) && $detail->sumbuAtasX2 !== '' ? $detail->sumbuAtasX2 : ''; ?>"
                       style="width:100%;border:none;background:transparent;text-align:center;font-size:14px;">
            </div>
        </td>
        <td align="center" style="border:1px solid #999;">
            <div style="display: inline-block; width: 90%; max-width: 180px; text-align: center; padding: 10px 0; font-size: 14px;">
                <input type="text" name="nogo_atas_y2"
                       value="<?php echo isset($detail->sumbuAtasY2) && $detail->sumbuAtasY2 !== '' ? $detail->sumbuAtasY2 : ''; ?>"
                       style="width:100%;border:none;background:transparent;text-align:center;font-size:14px;">
            </div>
        </td>
    </tr>
    <tr>
        <td rowspan="2" align="center" style="border:1px solid #999; font-size: 14px;">Bawah</td>
        <td align="center" style="border:1px solid #999;">
            <div style="display: inline-block; width: 90%; max-width: 180px; text-align: center; padding: 10px 0; font-size: 14px;">
                <input type="text" name="nogo_bawah_x"
                       value="<?php echo isset($detail->sumbuBawahX1) && $detail->sumbuBawahX1 !== '' ? $detail->sumbuBawahX1 : ''; ?>"
                       style="width:100%;border:none;background:transparent;text-align:center;font-size:14px;">
            </div>
        </td>
        <td align="center" style="border:1px solid #999;">
            <div style="display: inline-block; width: 90%; max-width: 180px; text-align: center; padding: 10px 0; font-size: 14px;">
                <input type="text" name="nogo_bawah_y"
                       value="<?php echo isset($detail->sumbuBawahY1) && $detail->sumbuBawahY1 !== '' ? $detail->sumbuBawahY1 : ''; ?>"
                       style="width:100%;border:none;background:transparent;text-align:center;font-size:14px;">
            </div>
        </td>
    </tr>
    <tr>
        <td align="center" style="border:1px solid #999;">
            <div style="display: inline-block; width: 90%; max-width: 180px; text-align: center; padding: 10px 0; font-size: 14px;">
                <input type="text" name="nogo_bawah_x2"
                       value="<?php echo isset($detail->sumbuBawahX2) && $detail->sumbuBawahX2 !== '' ? $detail->sumbuBawahX2 : ''; ?>"
                       style="width:100%;border:none;background:transparent;text-align:center;font-size:14px;">
            </div>
        </td>
        <td align="center" style="border:1px solid #999;">
            <div style="display: inline-block; width: 90%; max-width: 180px; text-align: center; padding: 10px 0; font-size: 14px;">
                <input type="text" name="nogo_bawah_y2"
                       value="<?php echo isset($detail->sumbuBawahY2) && $detail->sumbuBawahY2 !== '' ? $detail->sumbuBawahY2 : ''; ?>"
                       style="width:100%;border:none;background:transparent;text-align:center;font-size:14px;">
            </div>
        </td>
    </tr>
</table>

<!-- Jarak dan Footer Section -->
<div style="margin-top: 40px; margin-bottom: 20px;"></div>

<!-- Tabel Catatan FULL WIDTH -->
@if($head)
<table border="1" cellspacing="0" cellpadding="8" style="width: 100%;">
<tr>
    <td bgcolor="#f8f8f8" align="center" style="border:1px solid #999;"><strong>Catatan :</strong></td>
</tr>
<tr>
    <td bgcolor="#f8f8f8" valign="top" style="border:1px solid #999;">
        <div style="width:100%; min-height: 200px; font-family:Arial; font-size:14px; padding: 15px; white-space: pre-wrap; line-height: 1.6;">
            <textarea name="catatan" style="width:100%; border:none; background:transparent;" rows="3">{{ old('catatan') ?? ($head->catatan ?? '') }}</textarea>
        </div>
    </td>
</tr>
</table>
@endif

<div style="clear: both;"></div>

@else
<div style="text-align: center; padding: 20px; color: #666; background: #f9f9f9; border: 1px dashed #ccc; width: 100%;">
    <h4>⚠️ Data Plain Limit Gauge Tidak Ditemukan</h4>
    <p>Data detail tidak ditemukan untuk calibration ini.</p>
</div>
@endif

<!-- Debug panel (View Source untuk melihat) -->
<!-- 
    Untuk debugging:
    1. Klik kanan → View Page Source
    2. Cari "DEBUG:" 
    3. Akan melihat informasi seperti:
       DEBUG: Calibration ID: 123
       DEBUG: Details count: 0
       DEBUG: Detail exists: NO
       DEBUG: Head exists: YES
-->


            <p style="margin-top:0.35pt; font-size:9pt">&nbsp;</p>
<style>
    /* Styling untuk checkbox view mode */
    .view-checkbox {
        width: 16px;
        height: 16px;
        cursor: default;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        border: 2px solid #666;
        border-radius: 3px;
        background-color: #f0f0f0;
        position: relative;
        vertical-align: middle;
    }
    
    .view-checkbox:checked {
        background-color: #000;
        border-color: #000;
    }
    
    .view-checkbox:checked::after {
        content: '✓';
        color: white;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 12px;
        font-weight: bold;
    }
    
    .view-checkbox:disabled {
        opacity: 1; /* Tetap terlihat jelas meski disabled */
    }
    
    .view-checkbox-label {
        cursor: default;
        user-select: none;
        margin-left: 3px;
    }
</style>
@php
    // Ambil data head jika ada
    $head = $calibration->headPlainLimitGauge ?? null;
    
    // Parse alat standar dari string
    $alatStandarString = $head->standard ?? '';
    $alatStandarArray = $alatStandarString ? explode(', ', $alatStandarString) : [];
    
    // Cek apakah alat standar tertentu ada
    $hasMesinULM = false;
    $hasGaugeBlock = false;
    $hasRingGauge = false;
    $gaugeBlockMm = '';
    $ringGaugeMm = '';
    
    foreach ($alatStandarArray as $alat) {
        if (strpos($alat, 'Mesin ULM') !== false) {
            $hasMesinULM = true;
        }
        if (strpos($alat, 'Gauge Block') !== false) {
            $hasGaugeBlock = true;
            // Extract mm value
            preg_match('/Gauge Block (\d+(?:\.\d+)?) mm/', $alat, $matches);
            $gaugeBlockMm = $matches[1] ?? '';
        }
        if (strpos($alat, 'Ring Gauge') !== false) {
            $hasRingGauge = true;
            // Extract mm value
            preg_match('/Ring Gauge (\d+(?:\.\d+)?) mm/', $alat, $matches);
            $ringGaugeMm = $matches[1] ?? '';
        }
    }
    
    // Ambil nama yang dikalibrasi dan diperiksa
    $calibrated_by = $calibration->calibratedBy ?? (auth()->user()->nama ?? 'System');
    $verified_by = $calibration->verifiedBy ?? '';
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
        <td rowspan="4" style="width: 20%; border: 1pt solid #000; text-align: center; vertical-align: middle; font-weight: bold; font-size: 12pt; background-color: #f0f0f0;">
            Standard
        </td>
        <td colspan="2" style="width: 40%; border: 1pt solid #000; text-align: center; vertical-align: middle; font-size: 12pt; background-color: #f8f8f8;">
            <!-- Teks "Digital Pressure Calibrator :" dihapus -->
        </td>
        <td style="width: 20%; border: 1pt solid #000; text-align: center; vertical-align: middle; font-size: 12pt; font-weight: bold; background-color: #f0f0f0;">
            Dikalibrasi oleh
        </td>
        <td style="width: 20%; border: 1pt solid #000; text-align: center; vertical-align: middle; font-size: 12pt; font-weight: bold; background-color: #f0f0f0;">
            Diperiksa oleh
        </td>
    </tr>

    <!-- Baris 1: Mesin ULM -->
    <tr style="height: 40pt;">
        <td style="width: 5%; border: 1pt solid #000; text-align: center; vertical-align: middle;">
            <input type="checkbox" 
                   name="alat_standar[]" 
                   value="Mesin ULM 01-600D"
                   <?php echo $hasMesinULM ? 'checked' : ''; ?>
                   style="width: 18pt; height: 18pt; cursor: pointer;">
        </td>
        <td style="border: 1pt solid #000; padding-left: 15pt; font-size: 11pt; vertical-align: middle;">
           Mesin ULM 01-600D
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none;"></td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none;"></td>
    </tr>

    <!-- Baris 2: Gauge Block -->
    <tr style="height: 40pt;">
        <td style="border: 1pt solid #000; text-align: center; vertical-align: middle;">
            <input type="checkbox" 
                   name="alat_standar[]" 
                   value="Gauge Block <?php echo $gaugeBlockMm ? $gaugeBlockMm . ' mm' : ''; ?>"
                   <?php echo $hasGaugeBlock ? 'checked' : ''; ?>
                   style="width: 18pt; height: 18pt; cursor: pointer;">
        </td>
        <td style="border: 1pt solid #000; padding-left: 15pt; font-size: 11pt; vertical-align: middle;">
            Gauge Block 
            <select name="gauge_block_mm" 
                    id="gauge_block_mm"
                    style="border: none; border-bottom: 1px solid #000; font-size: 11pt; margin-left: 10px; padding: 2px 5px; background: transparent;">
                <option value="">Pilih mm</option>
                <option value="100" <?php echo $gaugeBlockMm == '100' ? 'selected' : ''; ?>>100 mm</option>
                <option value="150" <?php echo $gaugeBlockMm == '150' ? 'selected' : ''; ?>>150 mm</option>
                <option value="300" <?php echo $gaugeBlockMm == '300' ? 'selected' : ''; ?>>300 mm</option>
            </select>
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none;"></td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none;"></td>
    </tr>

    <!-- Baris 3: Ring Gauge -->
    <tr style="height: 60pt;">
        <td style="border: 1pt solid #000; text-align: center; vertical-align: middle;">
            <input type="checkbox" 
                   name="alat_standar[]" 
                   value="Ring Gauge <?php echo $ringGaugeMm ? $ringGaugeMm . ' mm' : ''; ?>"
                   <?php echo $hasRingGauge ? 'checked' : ''; ?>
                   style="width: 18pt; height: 18pt; cursor: pointer;">
        </td>
        <td style="border: 1pt solid #000; padding-left: 15pt; font-size: 11pt; vertical-align: middle;">
            Ring Gauge 
            <select name="ring_gauge_mm" 
                    id="ring_gauge_mm"
                    style="border: none; border-bottom: 1px solid #000; font-size: 11pt; margin-left: 10px; padding: 2px 5px; background: transparent;">
                <option value="">Pilih mm</option>
                <option value="14" <?php echo $ringGaugeMm == '14' ? 'selected' : ''; ?>>14 mm</option>
                <option value="50" <?php echo $ringGaugeMm == '50' ? 'selected' : ''; ?>>50 mm</option>
            </select>
        </td>
        <!-- Hapus garis atas dan bawah sepenuhnya pada sel TTD -->
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none; padding: 10pt 0; vertical-align: top; font-size: 11pt; text-align: left;">
            TTD :
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none; padding: 10pt 0; vertical-align: top; font-size: 11pt; text-align: left;">
            TTD :
        </td>
    </tr>

    <tr style="height: 60pt;">
        <td style="border: 1pt solid #000; text-align: center; vertical-align: middle; font-weight: bold; font-size: 12pt; background-color: #f0f0f0;">
            Metode Kalibrasi
        </td>
        <td colspan="2" style="border: 1pt solid #000; padding-left: 15pt; font-size: 11pt; vertical-align: middle;">
           PAS-IK1102-63
        </td>
        <!-- Hapus border atas pada sel Nama -->
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-bottom: 1pt solid #000; border-top: none; padding: 10pt; vertical-align: middle; font-size: 11pt;">
            Nama : 
            <input type="text" name="calibratedBy" 
                   style="width: 100%; border: none; border-bottom: 2px solid #000; font-size: 11pt; padding: 5px 0; background: transparent;" 
                   value="<?php echo $calibrated_by; ?>" readonly>
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-bottom: 1pt solid #000; border-top: none; padding: 10pt; vertical-align: middle; font-size: 11pt;">
            Nama : 
            <input type="text" name="verifiedBy" 
                   style="width: 100%; border: none; border-bottom: 2px solid #000; font-size: 11pt; padding: 5px 0; background: transparent;" 
                   value="<?php echo $verified_by; ?>" readonly>
        </td>
    </tr>
</table>

<script>
var tempFormDataStore = window.tempFormDataStore;
var isRestoring = window.isRestoring;
var tabSubmitStatus = window.tabSubmitStatus;
var currentActiveTabId = '1';

// JavaScript untuk update value checkbox Gauge Block saat select berubah
document.getElementById('gauge_block_mm')?.addEventListener('change', function() {
    const checkbox = document.querySelector('input[name="alat_standar[]"][value*="Gauge Block"]');
    if (checkbox && this.value) {
        checkbox.value = 'Gauge Block ' + this.value + ' mm';
    } else if (checkbox && !this.value) {
        checkbox.value = 'Gauge Block';
    }
});

// JavaScript untuk update value checkbox Ring Gauge saat select berubah
document.getElementById('ring_gauge_mm')?.addEventListener('change', function() {
    const checkbox = document.querySelector('input[name="alat_standar[]"][value*="Ring Gauge"]');
    if (checkbox && this.value) {
        checkbox.value = 'Ring Gauge ' + this.value + ' mm';
    } else if (checkbox && !this.value) {
        checkbox.value = 'Ring Gauge';
    }
});

// JavaScript untuk update checkbox saat select berubah (jika checkbox belum tercentang)
function updateCheckboxOnSelect(selectId, checkboxValuePrefix) {
    const select = document.getElementById(selectId);
    const checkboxes = document.querySelectorAll('input[name="alat_standar[]"]');
    
    select?.addEventListener('change', function() {
        const checkbox = Array.from(checkboxes).find(cb => cb.value.includes(checkboxValuePrefix));
        if (checkbox && this.value) {
            checkbox.checked = true;
            checkbox.value = checkboxValuePrefix + ' ' + this.value + ' mm';
        } else if (checkbox && !this.value) {
            checkbox.checked = false;
            checkbox.value = checkboxValuePrefix;
        }
    });
}

// Inisialisasi
updateCheckboxOnSelect('gauge_block_mm', 'Gauge Block');
updateCheckboxOnSelect('ring_gauge_mm', 'Ring Gauge');
</script>

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
        document.getElementById('editForm')?.addEventListener('submit', function(e) {
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
    document.getElementById('editForm')?.addEventListener('submit', function(e) {
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