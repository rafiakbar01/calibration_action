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

           <table class="kalibrasi-main-table">

<tr>
    <td style="width:20%;">Nama Alat</td>
    <td colspan="3">
        <input type="text" name="namaAlat" class="kalibrasi-input"
               value="{{ $calibration->namaAlat }}">
    </td>
</tr>

<tr>
    <td>Merek</td>
    <td colspan="3">
        <div class="d-flex align-items-center">
            <input type="text" name="brandAlat" class="kalibrasi-input me-3"
                   value="{{ $calibration->brandAlat }}" style="width:60%;">
            <span class="me-3">Kode Alat :</span>
            <input type="text" name="kodeAlat" class="kalibrasi-input"
                   value="{{ $calibration->kodeAlat }}" style="width:30%;">
        </div>
    </td>
</tr>

<tr>
    <td>Type / No. Seri</td>
    <td colspan="3">
        <div class="d-flex align-items-center">
            <input type="text" name="typeAlat" class="kalibrasi-input me-3"
                   value="{{ $calibration->typeAlat }}" style="width:45%;">
            <span class="me-3">/</span>
            <input type="text" name="NoSeri" class="kalibrasi-input"
                   value="{{ $calibration->NoSeri }}" style="width:45%;">
        </div>
    </td>
</tr>

<tr>
    <td>Rentang Ukur</td>
    <td colspan="3">
        <div class="d-flex align-items-center">
            <input type="text" name="rangeMin" class="kalibrasi-input me-3"
                   value="{{ $calibration->rangeMin }}" style="width:45%;">
            <span class="me-3">-</span>
            <input type="text" name="rangeMax" class="kalibrasi-input"
                   value="{{ $calibration->rangeMax }}" style="width:45%;">
        </div>
    </td>
</tr>

<tr>
    <td>Kapasitas / Resolusi</td>
    <td colspan="3">
        <div class="d-flex align-items-center">
            <input type="text" name="kapasitas" class="kalibrasi-input me-3"
                   value="{{ $calibration->kapasitas }}" style="width:45%;">
            <span class="me-3">/</span>
            <input type="text" name="resolusi" class="kalibrasi-input"
                   value="{{ $calibration->resolusi }}" style="width:45%;">
        </div>
    </td>
</tr>

<tr>
    <td>Nama Pemilik</td>
    <td colspan="3">
        <input type="text" name="pemilikAlat" class="kalibrasi-input"
               value="{{ $calibration->pemilikAlat }}">
    </td>
</tr>

<tr>
    <td>Tanggal Alat Masuk</td>
    <td colspan="3">
        <input type="date" name="tanggalMasuk" class="kalibrasi-input"
               value="{{ \Carbon\Carbon::parse($calibration->tanggalMasuk)->format('Y-m-d') }}">
    </td>
</tr>

<tr>
    <td>Tanggal Kalibrasi</td>
    <td colspan="3">
        <div class="d-flex align-items-center">
            <input type="date" name="tanggalKalibrasi" class="kalibrasi-input me-3"
                   value="{{ \Carbon\Carbon::parse($calibration->tanggalKalibrasi)->format('Y-m-d') }}" style="width:45%;">
            <span class="me-3">Jenis Pembacaan:</span>
            <input type="text" name="jenisPembacaan" class="kalibrasi-input"
                   value="{{ $calibration->jenisPembacaan }}" style="width:45%;">
        </div>
    </td>
</tr>

<tr>
    <td>Tempat Kalibrasi</td>
    <td colspan="3">
        <div class="d-flex">
            <div class="form-check me-5">
                <input class="form-check-input" type="radio" name="tempatKalibrasi" value="lab"
                       {{ $calibration->tempatKalibrasi == 'lab' ? 'checked' : '' }}>
                <label class="form-check-label">Lab. PT.PAS</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="tempatKalibrasi" value="insitu"
                       {{ $calibration->tempatKalibrasi == 'insitu' ? 'checked' : '' }}>
                <label class="form-check-label">Insitu</label>
            </div>
        </div>
    </td>
</tr>

<tr>
    <td>Lokasi PT</td>
    <td colspan="3">
        <input type="text" name="lokasiPT" class="kalibrasi-input"
               value="{{ $calibration->lokasiPT }}">
    </td>
</tr>

</table>


           <div class="row mt-4">

<!-- Fungsi Komponen Lainnya -->
<div class="col-md-6 mb-4">
    <div class="kalibrasi-section-header" style="color:#000;">Fungsi Komponen Lainnya</div>

    <!-- Radio -->
    <div class="d-flex justify-content-center align-items-center mb-4" style="gap:60px;">
        <div class="text-center">
            <span class="fw-bold d-block mb-2">Ok</span>
            <input type="radio" name="kondisiAlat" value="ok" class="form-check-input"
                   style="width:18px;height:18px;"
                   {{ $calibration->kondisiAlat == 'ok' ? 'checked' : '' }}>
        </div>

        <div class="text-center">
            <span class="fw-bold d-block mb-2">Rusak</span>
            <input type="radio" name="kondisiAlat" value="rusak" class="form-check-input"
                   style="width:18px;height:18px;"
                   {{ $calibration->kondisiAlat == 'rusak' ? 'checked' : '' }}>
        </div>
    </div>

    <!-- Keterangan -->
    <div class="d-flex align-items-center">
        <span class="fw-bold me-3" style="min-width:100px;">Keterangan :</span>
        <input type="text" name="keterangan" class="kalibrasi-input"
               value="{{ $calibration->keterangan ?? '' }}"
               style="border:none;border-bottom:2px solid #000;border-radius:0;background:transparent;width:100%;">
    </div>
</div>

<!-- Kondisi Kalibrasi -->
<div class="col-md-6 mb-4">
    <div class="kalibrasi-section-header" style="color:#000;">Kondisi Kalibrasi</div>

    <table class="table table-bordered">
        <tr>
            <td class="table-secondary fw-bold"></td>
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
            
         <!-- Data Kalibrasi Section -->
<div class="data-kalibrasi-header" style="color: #000000;">DATA KALIBRASI</div>
<div class="setting-suhu-container" style="margin-bottom: 30px;">
    <div style="display: flex; justify-content: space-between;">
  
@php
    $calibrationId = $calibration->id;
    
    // ⭐⭐ TAMBAHKAN INI: Define totalRows
    $totalRows = 6;
    
    // Ambil head data
    $headThermometer = $calibration->headThermometer ?? null;
    $satuanSuhuKiri = $headThermometer->satuan_suhu_kiri ?? '';
    $satuanSuhuKanan = $headThermometer->satuan_suhu_kanan ?? '';
    
    // DEBUG: Cek data head
    echo "<!-- DEBUG: Head Thermometer exists: " . (!is_null($headThermometer) ? 'YES' : 'NO') . " -->\n";
    echo "<!-- DEBUG: Satuan Kiri: '$satuanSuhuKiri', Satuan Kanan: '$satuanSuhuKanan' -->\n";
    
    // Ambil SEMUA detail data
    $allDetails = \DB::table('detail_thermometers')
        ->where('calibration_id', $calibrationId)
        ->orderBy('id')
        ->get();
    
    // DEBUG: Cek total data
    echo "<!-- DEBUG: Total detail records found: " . $allDetails->count() . " -->\n";
    echo "<!-- DEBUG: Calibration ID used: $calibrationId -->\n";
    
    // Bagi menjadi 2 array: kiri (0-5) dan kanan (6-11)
    $leftDetails = [];
    $rightDetails = [];
    
    for ($i = 0; $i < 12; $i++) {
        $detail = $allDetails->get($i);
        
        if ($i < 6) {
            // Data kiri (kelompok 1-6)
            $leftDetails[$i] = $detail ?? (object)[
                'id' => null,
                'titikUkur' => null,
                'STD01' => null, 'STD02' => null, 'STD03' => null,
                'UUT01' => null, 'UUT02' => null, 'UUT03' => null
            ];
        } else {
            // Data kanan (kelompok 7-12)
            $rightDetails[$i - 6] = $detail ?? (object)[
                'id' => null,
                'titikUkur' => null,
                'STD01' => null, 'STD02' => null, 'STD03' => null,
                'UUT01' => null, 'UUT02' => null, 'UUT03' => null
            ];
        }
    }
    
    // DEBUG: Tampilkan data yang didapat
    echo "<!-- DEBUG LEFT DETAILS (should be 6):\n";
    foreach($leftDetails as $index => $detail) {
        echo "  [$index] ID: " . ($detail->id ?? 'null') . 
             ", titik: " . ($detail->titikUkur ?? 'null') . 
             ", STD01: " . ($detail->STD01 ?? 'null') . "\n";
    }
    echo "-->";
    
    echo "<!-- DEBUG RIGHT DETAILS (should be 6):\n";
    foreach($rightDetails as $index => $detail) {
        echo "  [$index] ID: " . ($detail->id ?? 'null') . 
             ", titik: " . ($detail->titikUkur ?? 'null') . 
             ", STD01: " . ($detail->STD01 ?? 'null') . "\n";
    }
    echo "-->";

@endphp

<style>
    .edit-suhu-container {
        width: 100%;
        display: flex;
        justify-content: space-between;
        gap: 4%;
        margin-bottom: 20px;
    }
    
    .edit-suhu-table {
        border-collapse: collapse;
        width: 48%;
        table-layout: fixed;
        font-family: Arial, sans-serif;
    }
    
    .edit-suhu-table th,
    .edit-suhu-table td {
        border: 1pt solid #000;
        padding: 2px;
        text-align: center;
        vertical-align: middle;
    }
    
    .edit-suhu-table th {
        font-size: 9pt;
        background-color: #f0f0f0;
        font-weight: bold;
    }
    
    .edit-header-cell {
        padding: 4px !important;
    }
    
    .edit-satuan-select {
        width: 80%;
        border: none;
        text-align: center;
        background: transparent;
        font-size: 9pt;
        font-weight: normal;
        margin-top: 2px;
        padding: 0;
    }
    
    .edit-setting-input {
        width: 80%;
        border: none;
        text-align: center;
        background: transparent;
        font-size: 9pt;
        padding: 2px;
    }
    
    .edit-data-input {
        width: 90%;
        border: none;
        text-align: center;
        background: transparent;
        font-size: 8pt;
        padding: 2px;
    }
    
    .edit-setting-column {
        width: 35%;
    }
    
    .edit-std-column,
    .edit-uut-column {
        width: 32.5%;
    }
</style>

<div class="edit-suhu-container">
    <!-- Tabel Kiri -->
    <table class="edit-suhu-table">
        <tr>
            <th rowspan="2" class="edit-setting-column edit-header-cell">
                Setting Suhu<br>
                <select name="satuan_suhu_kiri" class="edit-satuan-select">
                    <option value="">(……………)</option>
                    <option value="°C" {{ $satuanSuhuKiri == '°C' ? 'selected' : '' }}>°C</option>
                    <option value="°F" {{ $satuanSuhuKiri == '°F' ? 'selected' : '' }}>°F</option>
                </select>
            </th>
            <th colspan="2" class="edit-header-cell">Pembacaan</th>
        </tr>
        <tr>
            <th class="edit-std-column edit-header-cell">STD</th>
            <th class="edit-uut-column edit-header-cell">UUT</th>
        </tr>
        
        @for($i = 0; $i < $totalRows; $i++)
            @php
                $detail = $leftDetails[$i] ?? null;
                
                // Hitung index untuk STD dan UUT
                $baseIndex = $i * 3 + 1; // 1, 4, 7, 10, 13, 16
            @endphp
            <tr>
                <td rowspan="3" style="height: 90px;">
                    <input type="number" step="any" 
                           name="setting_suhu[]" 
                           value="{{ isset($detail->titikUkur) ? $detail->titikUkur : '' }}"
                           class="edit-setting-input"
                           oninput="this.value = this.value.replace(/[^0-9.]/g, '')">
                    <input type="hidden" name="detail_ids[]" value="{{ $detail->id ?? '' }}">
                </td>
                <td style="height: 30px;">
                    <input type="number" step="any" 
                           name="std_{{ $baseIndex }}" 
                           value="{{ isset($detail->STD01) ? $detail->STD01 : '' }}"
                           class="edit-data-input"
                           oninput="this.value = this.value.replace(/[^0-9.]/g, '')">
                </td>
                <td style="height: 30px;">
                    <input type="number" step="any" 
                           name="uut_{{ $baseIndex }}" 
                           value="{{ isset($detail->UUT01) ? $detail->UUT01 : '' }}"
                           class="edit-data-input"
                           oninput="this.value = this.value.replace(/[^0-9.]/g, '')">
                </td>
            </tr>
            <tr>
                <td style="height: 30px;">
                    <input type="number" step="any" 
                           name="std_{{ $baseIndex + 1 }}" 
                           value="{{ isset($detail->STD02) ? $detail->STD02 : '' }}"
                           class="edit-data-input"
                           oninput="this.value = this.value.replace(/[^0-9.]/g, '')">
                </td>
                <td style="height: 30px;">
                    <input type="number" step="any" 
                           name="uut_{{ $baseIndex + 1 }}" 
                           value="{{ isset($detail->UUT02) ? $detail->UUT02 : '' }}"
                           class="edit-data-input"
                           oninput="this.value = this.value.replace(/[^0-9.]/g, '')">
                </td>
            </tr>
            <tr>
                <td style="height: 30px;">
                    <input type="number" step="any" 
                           name="std_{{ $baseIndex + 2 }}" 
                           value="{{ isset($detail->STD03) ? $detail->STD03 : '' }}"
                           class="edit-data-input"
                           oninput="this.value = this.value.replace(/[^0-9.]/g, '')">
                </td>
                <td style="height: 30px;">
                    <input type="number" step="any" 
                           name="uut_{{ $baseIndex + 2 }}" 
                           value="{{ isset($detail->UUT03) ? $detail->UUT03 : '' }}"
                           class="edit-data-input"
                           oninput="this.value = this.value.replace(/[^0-9.]/g, '')">
                </td>
            </tr>
        @endfor
    </table>

    <!-- Tabel Kanan -->
    <table class="edit-suhu-table">
        <tr>
            <th rowspan="2" class="edit-setting-column edit-header-cell">
                Setting Suhu<br>
                <select name="satuan_suhu_kanan" class="edit-satuan-select">
                    <option value="">(……………)</option>
                    <option value="°C" {{ $satuanSuhuKanan == '°C' ? 'selected' : '' }}>°C</option>
                    <option value="°F" {{ $satuanSuhuKanan == '°F' ? 'selected' : '' }}>°F</option>
                </select>
            </th>
            <th colspan="2" class="edit-header-cell">Pembacaan</th>
        </tr>
        <tr>
            <th class="edit-std-column edit-header-cell">STD</th>
            <th class="edit-uut-column edit-header-cell">UUT</th>
        </tr>
        
        @for($i = 0; $i < $totalRows; $i++)
            @php
                $detail = $rightDetails[$i] ?? null;
                
                // Hitung index untuk STD dan UUT (lanjutan dari kiri)
                $groupNumber = $i + 6; // Group 7-12
                $baseIndex = $groupNumber * 3 + 1; // 19, 22, 25, 28, 31, 34
            @endphp
            <tr>
                <td rowspan="3" style="height: 90px;">
                    <input type="number" step="any" 
                           name="setting_suhu[]" 
                           value="{{ isset($detail->titikUkur) ? $detail->titikUkur : '' }}"
                           class="edit-setting-input"
                           oninput="this.value = this.value.replace(/[^0-9.]/g, '')">
                    <input type="hidden" name="detail_ids[]" value="{{ $detail->id ?? '' }}">
                </td>
                <td style="height: 30px;">
                    <input type="number" step="any" 
                           name="std_{{ $baseIndex }}" 
                           value="{{ isset($detail->STD01) ? $detail->STD01 : '' }}"
                           class="edit-data-input"
                           oninput="this.value = this.value.replace(/[^0-9.]/g, '')">
                </td>
                <td style="height: 30px;">
                    <input type="number" step="any" 
                           name="uut_{{ $baseIndex }}" 
                           value="{{ isset($detail->UUT01) ? $detail->UUT01 : '' }}"
                           class="edit-data-input"
                           oninput="this.value = this.value.replace(/[^0-9.]/g, '')">
                </td>
            </tr>
            <tr>
                <td style="height: 30px;">
                    <input type="number" step="any" 
                           name="std_{{ $baseIndex + 1 }}" 
                           value="{{ isset($detail->STD02) ? $detail->STD02 : '' }}"
                           class="edit-data-input"
                           oninput="this.value = this.value.replace(/[^0-9.]/g, '')">
                </td>
                <td style="height: 30px;">
                    <input type="number" step="any" 
                           name="uut_{{ $baseIndex + 1 }}" 
                           value="{{ isset($detail->UUT02) ? $detail->UUT02 : '' }}"
                           class="edit-data-input"
                           oninput="this.value = this.value.replace(/[^0-9.]/g, '')">
                </td>
            </tr>
            <tr>
                <td style="height: 30px;">
                    <input type="number" step="any" 
                           name="std_{{ $baseIndex + 2 }}" 
                           value="{{ isset($detail->STD03) ? $detail->STD03 : '' }}"
                           class="edit-data-input"
                           oninput="this.value = this.value.replace(/[^0-9.]/g, '')">
                </td>
                <td style="height: 30px;">
                    <input type="number" step="any" 
                           name="uut_{{ $baseIndex + 2 }}" 
                           value="{{ isset($detail->UUT03) ? $detail->UUT03 : '' }}"
                           class="edit-data-input"
                           oninput="this.value = this.value.replace(/[^0-9.]/g, '')">
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
<tr>
    <td rowspan="4" style="border:1pt solid #000; text-align:center; font-weight:bold;">Standard</td>

    <td style="border:1pt solid #000; text-align:center;">
        <input type="checkbox" name="alat_standar[]" value="TD.001"
            {{ str_contains($calibration->headThermometer->standard ?? '', 'TD.001') ? 'checked' : '' }}>
    </td>
    <td style="border:1pt solid #000;">TD.001</td>

    <td style="border:1pt solid #000; text-align:center;">
        <input type="checkbox" name="alat_standar[]" value="Microbath"
            {{ str_contains($calibration->headThermometer->standard ?? '', 'Microbath') ? 'checked' : '' }}>
    </td>
    <td style="border:1pt solid #000;">Microbath</td>

    <td rowspan="4" style="border:1pt solid #000; text-align:center;">Dikalibrasi<br>oleh</td>
    <td rowspan="4" style="border:1pt solid #000; text-align:center;">Diperiksa<br>oleh</td>
</tr>

<tr>
    <td style="border:1pt solid #000; text-align:center;">
        <input type="checkbox" name="alat_standar[]" value="TD.002"
            {{ str_contains($calibration->headThermometer->standard ?? '', 'TD.002') ? 'checked' : '' }}>
    </td>
    <td style="border:1pt solid #000;">TD.002</td>

    <td style="border:1pt solid #000; text-align:center;">
        <input type="checkbox" name="alat_standar[]" value="Dry Block"
            {{ str_contains($calibration->headThermometer->standard ?? '', 'Dry Block') ? 'checked' : '' }}>
    </td>
    <td style="border:1pt solid #000;">Dry Block</td>
</tr>

<tr>
    <td style="border:1pt solid #000; text-align:center;">
        <input type="checkbox" name="alat_standar[]" value="TD.003"
            {{ str_contains($calibration->headThermometer->standard ?? '', 'TD.003') ? 'checked' : '' }}>
    </td>
    <td style="border:1pt solid #000;">TD.003</td>

    <td rowspan="2" style="border:1pt solid #000; text-align:center;">
        <input type="checkbox" name="alat_standar[]" value="Microbath & Dry Block"
            {{ str_contains($calibration->headThermometer->standard ?? '', 'Microbath & Dry Block') ? 'checked' : '' }}>
    </td>
    <td rowspan="2" style="border:1pt solid #000;">Microbath & Dry Block</td>
</tr>

<tr>
    <td style="border:1pt solid #000; text-align:center;">
        <input type="checkbox" name="alat_standar[]" value="TD.004"
            {{ str_contains($calibration->headThermometer->standard ?? '', 'TD.004') ? 'checked' : '' }}>
    </td>
    <td style="border:1pt solid #000;">TD.004</td>
</tr>

<!-- METODE -->
<tr>
    <td rowspan="4" style="border:1pt solid #000; text-align:center; font-weight:bold;">Metode Kalibrasi</td>

    <td style="border:1pt solid #000; text-align:center;">
        <input type="checkbox" name="metode_kalibrasi[]" value="PAS-IK1102-30"
            {{ str_contains($calibration->headThermometer->calibrationMethod ?? '', 'PAS-IK1102-30') ? 'checked' : '' }}>
    </td>
    <td colspan="3" style="border:1pt solid #000;">PAS-IK1102-30</td>

    <td style="border:1pt solid #000;"></td>
    <td style="border:1pt solid #000;"></td>
</tr>

<tr>
    <td style="border:1pt solid #000; text-align:center;">
        <input type="checkbox" name="metode_kalibrasi[]" value="PAS-IK1102-31"
            {{ str_contains($calibration->headThermometer->calibrationMethod ?? '', 'PAS-IK1102-31') ? 'checked' : '' }}>
    </td>
    <td colspan="3" style="border:1pt solid #000;">PAS-IK1102-31</td>

    <td style="border:1pt solid #000;">TTD :</td>
    <td style="border:1pt solid #000;">TTD :</td>
</tr>

<tr>
    <td style="border:1pt solid #000; text-align:center;">
        <input type="checkbox" name="metode_kalibrasi[]" value="PAS-IK1102-32"
            {{ str_contains($calibration->headThermometer->calibrationMethod ?? '', 'PAS-IK1102-32') ? 'checked' : '' }}>
    </td>
    <td colspan="3" style="border:1pt solid #000;">PAS-IK1102-32</td>

    <td style="border:1pt solid #000;">
        <input type="text" name="calibratedBy"
               value="{{ $calibration->calibratedBy }}"
               style="border:none; width:100%;">
    </td>
    <td style="border:1pt solid #000;">
        <input type="text" name="verifiedBy"
               value="{{ $calibration->verifiedBy }}"
               style="border:none; width:100%;">
    </td>
</tr>
</table>


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