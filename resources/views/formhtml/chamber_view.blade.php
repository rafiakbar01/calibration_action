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
                        <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK29B</p>
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
                        <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">CLIMATIC CHAMBER</p>
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
                        <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;">{{ $calibration->headChamber->certificate_id ?? 'N/A' }}</p>
                    </td>
                </tr>
            </table>

            <!-- Main Form Section - Readonly -->
            <table class="kalibrasi-main-table">

    <tr>
        <td style="width:20%;">Nama Alat</td>
        <td colspan="3">
            <input type="text" class="kalibrasi-input"
                   value="{{ $calibration->namaAlat }}" readonly>
        </td>
    </tr>

    <tr>
        <td>Merek</td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="text" class="kalibrasi-input me-3"
                       value="{{ $calibration->brandAlat }}" readonly style="width:60%;">
                <span class="me-3">Kode Alat :</span>
                <input type="text" class="kalibrasi-input"
                       value="{{ $calibration->kodeAlat }}" readonly style="width:30%;">
            </div>
        </td>
    </tr>

    <tr>
        <td>Type / No. Seri</td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="text" class="kalibrasi-input me-3"
                       value="{{ $calibration->typeAlat }}" readonly style="width:45%;">
                <span class="me-3">/</span>
                <input type="text" class="kalibrasi-input"
                       value="{{ $calibration->NoSeri }}" readonly style="width:45%;">
            </div>
        </td>
    </tr>

    <tr>
        <td>Kapasitas / Resolusi</td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="text" class="kalibrasi-input me-3"
                       value="{{ $calibration->kapasitas }}" readonly style="width:45%;">
                <span class="me-3">/</span>
                <input type="text" class="kalibrasi-input"
                       value="{{ $calibration->resolusi }}" readonly style="width:45%;">
            </div>
        </td>
    </tr>

    <tr>
        <td>Nama Pemilik</td>
        <td colspan="3">
            <input type="text" class="kalibrasi-input"
                   value="{{ $calibration->pemilikAlat }}" readonly>
        </td>
    </tr>

    <tr>
        <td>Tanggal Alat Masuk</td>
        <td colspan="3">
            <input type="text" class="kalibrasi-input"
                   value="{{ \Carbon\Carbon::parse($calibration->tanggalMasuk)->format('d/m/Y') }}" readonly>
        </td>
    </tr>

    <tr>
        <td>Tanggal Kalibrasi</td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="text" class="kalibrasi-input me-3"
                       value="{{ \Carbon\Carbon::parse($calibration->tanggalKalibrasi)->format('d/m/Y') }}" readonly style="width:45%;">
                <span class="me-3">Jenis Pembacaan:</span>
                <input type="text" class="kalibrasi-input"
                       value="{{ $calibration->jenisPembacaan }}" readonly style="width:45%;">
            </div>
        </td>
    </tr>

    <tr>
        <td>Tempat Kalibrasi</td>
        <td colspan="3">
            <div class="d-flex">
                <div class="form-check me-5">
                    <input class="form-check-input" type="radio" disabled
                        {{ $calibration->tempatKalibrasi == 'lab.PT PAS' ? 'checked' : '' }}>
                    <label class="form-check-label">Lab. PT.PAS</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" disabled
                        {{ $calibration->tempatKalibrasi == 'insitu' ? 'checked' : '' }}>
                    <label class="form-check-label">Insitu</label>
                </div>
            </div>
        </td>
    </tr>

    <tr>
        <td>Lokasi PT</td>
        <td colspan="3">
            <input type="text" class="kalibrasi-input"
                   value="{{ $calibration->lokasiPT }}" readonly>
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
                <span style="font-size:18px; color: {{ $calibration->kondisiAlat == 'ok' ? '#000' : '#ccc' }};">
                    ☑
                </span>
            </div>

            <div class="text-center">
                <span class="fw-bold d-block mb-2" style="color:#000000;font-size:14px;">Rusak</span>
                <span style="font-size:18px; color: {{ $calibration->kondisiAlat == 'rusak' ? '#000' : '#ccc' }};">
                    ☑
                </span>
            </div>
        </div>

        <!-- Keterangan -->
        <div class="d-flex align-items-center">
            <span class="fw-bold me-3" style="color:#000000;min-width:100px;">Keterangan :</span>
            <div style="flex:1;">
                <span style="border-bottom:2px solid #000; display:block; padding:4px 0; color:#000;">
                    {{ $calibration->keterangan ?? '-' }}
                </span>
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
                <td class="text-center">{{ $calibration->RT_condition1 ?? '-' }}</td>
                <td class="text-center">{{ $calibration->RT_condition2 ?? '-' }}</td>
                <td class="text-center">{{ $calibration->RT_condition3 ?? '-' }}</td>
            </tr>

            <tr>
                <td class="bg-light fw-bold">RH (%)</td>
                <td class="text-center">{{ $calibration->RH_condition1 ?? '-' }}</td>
                <td class="text-center">{{ $calibration->RH_condition2 ?? '-' }}</td>
                <td class="text-center">{{ $calibration->RH_condition3 ?? '-' }}</td>
            </tr>
        </table>
    </div>
</div>



            <!-- Data Kalibrasi Section -->
            <div class="data-kalibrasi-header" style="color: #000000;">DATA KALIBRASI</div>
            
            <ol type="1" style="margin:0pt; padding-left:0pt">
    <li class="ListParagraph" style="margin-top:0.5pt; margin-left:10.05pt; text-indent:0pt; font-size:11pt; font-weight:bold; letter-spacing:-0.1pt">
        <span>Penempatan</span>
        <span style="letter-spacing:-0.05pt"></span>
        <span>Sensor</span>
    </li>
</ol>

<p style="margin-left:0.05pt; font-size:10pt">
    <!-- Gambar Kiri -->
    <div style="display: inline-block; vertical-align: top; text-align: center; margin-right: 20px;">
        <img src="/logo/foto_rektangular.png" width="350" height="190" alt="" 
            style="border: 2px solid #000000; padding: 5px; -aw-left-pos:0pt; -aw-rel-hpos:column; -aw-rel-vpos:paragraph; -aw-top-pos:0pt; -aw-wrap-type:inline" />
        <div style="margin-top: 8px; font-family: Arial; font-size: 9pt; font-weight: bold; color: #000000; text-align: center;">
            Rektangular
        </div>
    </div>
    
    <!-- Spacer -->
    <span style="width:359.85pt; font-family:Arial; display:inline-block; -aw-tabstop-align:left; -aw-tabstop-pos:359.9pt">&#xa0;</span>
    
    <!-- Gambar Kanan -->
    <div style="display: inline-block; vertical-align: top; text-align: center; margin-left: 20px;">
        <img src="/logo/foto_silindrik.png" width="240" height="190" alt="" 
            style="border: 2px solid #000000; padding: 5px; -aw-left-pos:0pt; -aw-rel-hpos:column; -aw-rel-vpos:paragraph; -aw-top-pos:0pt; -aw-wrap-type:inline" />
        <div style="margin-top: 8px; font-family: Arial; font-size: 9pt; font-weight: bold; color: #000000; text-align: center;">
            Silindrik atau Sferik
        </div>
    </div>
</p>

<p class="BodyText" style="margin-top:2.45pt">
    <span style="-aw-import:ignore">&#xa0;</span>
</p>
@php
// === CHAMBER VIEW - TSETTING SEBAGAI STRING MURNI ===
$interval_waktu = [1, 2, 3, 4, 5, 13, 20, 30];

// PROSES DATA
$tsettingValues = [];
$repetition = 1;
$detailsByRepetition = [];

// CARI DATA ADDCHAMBER (UNTUK TSETTING)
// Coba dari relasi terlebih dahulu
$addChambersData = null;

// Cek semua kemungkinan nama relasi
if (method_exists($calibration, 'addChambers') && $calibration->addChambers->count() > 0) {
    $addChambersData = $calibration->addChambers;
} elseif (method_exists($calibration, 'addChamber') && $calibration->addChamber->count() > 0) {
    $addChambersData = $calibration->addChamber;
} else {
    // Jika tidak ada relasi, coba query langsung
    try {
        $addChambersData = \DB::table('add_chambers')
            ->where('calibration_id', $calibration->id)
            ->orderBy('repetition_number')
            ->get();
        
        // Coba tabel dengan nama singular jika tidak ditemukan
        if ($addChambersData->count() == 0) {
            $addChambersData = \DB::table('add_chamber')
                ->where('calibration_id', $calibration->id)
                ->orderBy('repetition_number')
                ->get();
        }
    } catch (\Exception $e) {
        // Jika error, set empty collection
        $addChambersData = collect();
    }
}

// Pastikan $addChambersData adalah collection
if (!$addChambersData instanceof \Illuminate\Support\Collection) {
    $addChambersData = collect($addChambersData);
}

// PROSES TSETTING DARI ADDCHAMBER - FOCUS PADA FIELD "Tsetting"
if ($addChambersData->isNotEmpty()) {
    foreach ($addChambersData as $index => $add) {
        // Gunakan property access yang tepat
        $repNum = $add->repetition_number ?? ($add['repetition_number'] ?? 1);
        
        // FOKUS PADA FIELD "Tsetting" (T besar, setting kecil)
        $tsettingValue = null;
        
        // Cari dengan nama field yang tepat: Tsetting
        if (isset($add->Tsetting)) {
            $tsettingValue = $add->Tsetting;
        } elseif (isset($add['Tsetting'])) {
            $tsettingValue = $add['Tsetting'];
        }
        // Juga coba variasi lain untuk safety
        elseif (isset($add->tsetting)) {
            $tsettingValue = $add->tsetting;
        } elseif (isset($add['tsetting'])) {
            $tsettingValue = $add['tsetting'];
        } elseif (isset($add->t_setting)) {
            $tsettingValue = $add->t_setting;
        } elseif (isset($add['t_setting'])) {
            $tsettingValue = $add['t_setting'];
        }
        
        if ($tsettingValue !== null && $tsettingValue !== '' && !empty(trim($tsettingValue))) {
            // Simpan sebagai string murni
            $tsettingValues[$repNum] = trim($tsettingValue);
        } else {
            $tsettingValues[$repNum] = null;
        }
    }
    
    // Update jumlah repetition berdasarkan data yang ditemukan
    if (!empty($tsettingValues)) {
        $repetition = max(array_keys($tsettingValues));
    }
}

// CARI DATA DETAILCHAMBER (UNTUK PEMBACAAN)
// Coba dari relasi terlebih dahulu
$detailChambersData = null;

if (method_exists($calibration, 'detailChambers') && $calibration->detailChambers->count() > 0) {
    $detailChambersData = $calibration->detailChambers;
} elseif (method_exists($calibration, 'detailChamber') && $calibration->detailChamber->count() > 0) {
    $detailChambersData = $calibration->detailChamber;
} else {
    // Jika tidak ada relasi, coba query langsung
    try {
        $detailChambersData = \DB::table('detail_chambers')
            ->where('calibration_id', $calibration->id)
            ->orderBy('repetition_number')
            ->orderBy('interval_number')
            ->get();
        
        // Coba tabel dengan nama singular jika tidak ditemukan
        if ($detailChambersData->count() == 0) {
            $detailChambersData = \DB::table('detail_chamber')
                ->where('calibration_id', $calibration->id)
                ->orderBy('repetition_number')
                ->orderBy('interval_number')
                ->get();
        }
    } catch (\Exception $e) {
        // Jika error, set empty collection
        $detailChambersData = collect();
    }
}

// Pastikan $detailChambersData adalah collection
if (!$detailChambersData instanceof \Illuminate\Support\Collection) {
    $detailChambersData = collect($detailChambersData);
}

// PROSES DETAILCHAMBER
if ($detailChambersData->isNotEmpty()) {
    foreach ($detailChambersData as $detail) {
        $repNum = $detail->repetition_number ?? ($detail['repetition_number'] ?? 1);
        $intervalNum = $detail->interval_number ?? ($detail['interval_number'] ?? 1);
        
        if (!isset($detailsByRepetition[$repNum])) {
            $detailsByRepetition[$repNum] = [];
        }
        
        $detailsByRepetition[$repNum][$intervalNum] = $detail;
    }
    
    // Update repetition jika ada data detail dengan repetition lebih tinggi
    if (!empty($detailsByRepetition)) {
        $maxRepFromDetails = max(array_keys($detailsByRepetition));
        if ($maxRepFromDetails > $repetition) {
            $repetition = $maxRepFromDetails;
        }
    }
}

// JIKA TIDAK ADA DATA SAMA SEKALI, SET KE 1 REPETITION DEFAULT
if ($repetition < 1) {
    $repetition = 1;
}

@endphp

{{-- LOOP UNTUK SETIAP PENGULANGAN --}}
<ol start="1" type="1" style="margin:0pt; padding-left:0pt">
    @for($p = 1; $p <= $repetition; $p++)
    @php
        $currentTsetting = $tsettingValues[$p] ?? null;
        
        // Format display untuk TSetting
        if ($currentTsetting !== null && $currentTsetting !== '' && !empty(trim($currentTsetting))) {
            // Jika berupa angka, tambahkan simbol derajat
            if (is_numeric($currentTsetting)) {
                $displayValue = htmlspecialchars($currentTsetting);
            } else {
                $displayValue = htmlspecialchars($currentTsetting);
            }
        } else {
            $displayValue = '<span style="color: #999; font-style: italic;">Belum diisi</span>';
        }
    @endphp
    
    <li class="ListParagraph" style="margin-right:468.8pt; margin-bottom:2.65pt; text-indent:0pt; line-height:147%; font-size:11pt; font-weight:bold; letter-spacing:-0.1pt; list-style-position:inside">
        <span style="height:0pt; display:block; position:absolute; z-index:0">
            <img src="{{ asset('images/Aspose.Words.3583c371-5f86-44ec-a7f9-7c86fc979546.011.png') }}" width="108" height="1" alt="" style="margin-top:23.16pt; margin-left:55.02pt; -aw-left-pos:75.02pt; -aw-rel-hpos:page; -aw-rel-vpos:paragraph; -aw-top-pos:23.16pt; -aw-wrap-type:none; position:absolute" />
        </span>
        <span>Data</span>
        <span style="letter-spacing:-0.45pt"></span>
        <span>Pengukuran</span>
        <span style="letter-spacing:normal"> Setting</span>
        <span style="letter-spacing:normal">Suhu</span>
        <span style="letter-spacing:-0.05pt"></span>
        <span>ke-{{ $p }}</span>
        <span style="width:31.99pt; letter-spacing:normal; display:inline-block">&#xa0;</span>
        <span style="font-family:'Arial MT'; font-weight:normal; letter-spacing:-0.5pt">:</span>
        
        <span style="font-size:10pt; width:100pt; margin-left:5pt; font-family:'Arial MT'; height:18pt; display:inline-block; font-weight:bold; color:#000; border-bottom: 1px solid #000;">
            {!! $displayValue !!}
        </span>
    </li>
    
    {{-- TABEL SETIAP PENGULANGAN --}}
    <table cellspacing="0" cellpadding="0" class="TableNormal" style="width:100%; margin-left:0.48pt; border:2px solid #000000; border-collapse:collapse; margin-bottom: {{ $p < $repetition ? '40px' : '20px' }}">
        <tr style="background: #d9d9d9; height:14pt">
            <td style="width:8%; border:2px solid #000; vertical-align:middle; text-align:center">
                <span style="font-weight: bold; color: #000000; font-size:9pt">Interval Waktu</span>
            </td>
            <td colspan="2" style="border:2px solid #000; vertical-align:middle; text-align:center">
                <span style="font-weight: bold; color: #000000; font-size:9pt">Pembacaan Alat</span>
            </td>
            <td colspan="10" style="border:2px solid #000; vertical-align:middle; text-align:center">
                <span style="font-weight: bold; color: #000000; font-size:9pt">Pembacaan Sensor</span>
            </td>
        </tr>
        <tr style="background: #e8e8e8; height:13pt">
            <td style="border:2px solid #000; vertical-align:middle; text-align:center">
                <span style="font-weight: bold; color: #000000; font-size:9pt">(Menit)</span>
            </td>
            <td style="width:8%; border:2px solid #000; vertical-align:middle; text-align:center">
                <span style="font-family:Arial; font-size:6pt; font-weight:bold; letter-spacing:-0.25pt">o</span>
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.25pt; vertical-align:-3pt; font-size:9pt;">C</span>
            </td>
            <td style="width:8%; border:2px solid #000; vertical-align:middle; text-align:center">
                <span style="font-weight: bold; color: #000000; font-size:9pt">%</span>
            </td>
            @for($s = 1; $s <= 9; $s++)
            <td style="width:7.2%; border:2px solid #000; vertical-align:middle; text-align:center">
                <span style="font-weight: bold; color: #000000; font-size:9pt">{{ $s }}</span>
            </td>
            @endfor
            <td style="width:8%; border:2px solid #000; vertical-align:middle; text-align:center">
                <span style="font-weight: bold; color: #000000; font-size:9pt">%</span>
            </td>
        </tr>
        
        @foreach($interval_waktu as $interval)
        @php
            $detailData = $detailsByRepetition[$p][$interval] ?? null;
        @endphp
        
        <tr style="height:22pt;">
            <td style="border:2px solid #000; padding:0; vertical-align:middle; text-align:center; font-weight:bold; font-size:10pt; color:#000;">
                {{ $interval }}
            </td>
            
            <!-- Kolom °C untuk Pembacaan Alat (readAlat) -->
            <td style="border:2px solid #000; padding:0; vertical-align:middle; text-align:center; font-size:10pt; color:#000;">
                @if($detailData)
                    @php
                        $readAlat = $detailData->readAlat ?? 
                                   ($detailData->read_alat ?? 
                                   ($detailData['readAlat'] ?? 
                                   ($detailData['read_alat'] ?? null)));
                    @endphp
                    @if($readAlat !== null)
                        {{ $readAlat }}
                    @else
                        &nbsp;
                    @endif
                @else
                    &nbsp;
                @endif
            </td>
            
            <!-- Kolom % untuk Pembacaan Alat (RHAlat) -->
            <td style="border:2px solid #000; padding:0; vertical-align:middle; text-align:center; font-size:10pt; color:#000;">
                @if($detailData)
                    @php
                        $rhalat = $detailData->RHAlat ?? 
                                 ($detailData->rhalat ?? 
                                 ($detailData['RHAlat'] ?? 
                                 ($detailData['rhalat'] ?? null)));
                    @endphp
                    @if($rhalat !== null)
                        {{ $rhalat }}
                    @else
                        &nbsp;
                    @endif
                @else
                    &nbsp;
                @endif
            </td>
            
            <!-- Kolom Sensor 1-9 -->
            @for($s = 1; $s <= 9; $s++)
            @php
                $sensorValue = null;
                if ($detailData) {
                    // Coba beberapa format nama field untuk sensor
                    $fieldNames = [
                        "ulangan0{$s}",
                        "ulangan{$s}",
                        "readSensor{$s}",
                        "sensor{$s}",
                        "sensor_{$s}"
                    ];
                    
                    foreach ($fieldNames as $field) {
                        if (isset($detailData->$field)) {
                            $sensorValue = $detailData->$field;
                            break;
                        } elseif (isset($detailData[$field])) {
                            $sensorValue = $detailData[$field];
                            break;
                        }
                    }
                }
            @endphp
            <td style="border:2px solid #000; padding:0; vertical-align:middle; text-align:center; font-size:10pt; color:#000;">
                @if($sensorValue !== null)
                    {{ $sensorValue }}
                @else
                    &nbsp;
                @endif
            </td>
            @endfor
            
            <!-- Kolom % untuk Sensor RH (RHulangan) -->
            <td style="border:2px solid #000; padding:0; vertical-align:middle; text-align:center; font-size:10pt; color:#000;">
                @if($detailData)
                    @php
                        $rhSensor = $detailData->RHulangan ?? 
                                   ($detailData->rhulangan ?? 
                                   ($detailData['RHulangan'] ?? 
                                   ($detailData['rhulangan'] ?? null)));
                    @endphp
                    @if($rhSensor !== null)
                        {{ $rhSensor }}
                    @else
                        &nbsp;
                    @endif
                @else
                    &nbsp;
                @endif
            </td>
        </tr>
        @endforeach
    </table>
    @endfor
</ol>

&nbsp;  &nbsp;
                 <!-- Footer Section -->
<table class="kalibrasi-main-table" style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
    <!-- HEADER FOOTER -->
    <tr>
        <td colspan="7" style="text-align: center; border: 1px solid #000; border-bottom: none; padding: 10px 0;">
            <span style="font-weight: bold; font-size: 18px; color: #000000;">LEMBAR DATA KALIBRASI</span>
        </td>
    </tr>

    <!-- ROW 1: TEMPERATURE -->
    <tr>
        <td rowspan="2" style="width: 15%; border: 1px solid #000; text-align: center; vertical-align: middle; font-weight: bold; font-size: 10pt; padding: 8px; background-color: #f0f0f0;">
            Alat<br>Standar
        </td>
        <td style="width: 15%; border: 1px solid #000; text-align: left; vertical-align: middle; font-size: 9pt; padding: 8px;">
            - Temperature
        </td>
        <td style="width: 10%; border: 1px solid #000; text-align: center; vertical-align: middle; font-size: 9pt; padding: 8px;">
            <div style="display: flex; align-items: center; justify-content: center;">
                {{-- Ambil data dari headChamber --}}
                @php
                    $isGL220 = false;
                    if (isset($calibration->headChamber) && $calibration->headChamber->standard) {
                        $isGL220 = str_contains($calibration->headChamber->standard, 'GL-220');
                    } elseif (isset($calibration->alat_standar)) {
                        $isGL220 = (is_array($calibration->alat_standar) && in_array('GL-220', $calibration->alat_standar)) ||
                                   str_contains($calibration->alat_standar ?? '', 'GL-220');
                    }
                @endphp
                @if($isGL220)
                    <span style="margin-right: 8px; font-weight: bold; color: #000; font-size: 14px;">☑</span>
                @else
                    <span style="margin-right: 8px; font-weight: bold; color: #ccc; font-size: 14px;">□</span>
                @endif
                <span style="font-weight: normal; color: #000;">GL-220</span>
            </div>
        </td>
        <td style="width: 10%; border: 1px solid #000; text-align: center; vertical-align: middle; font-size: 9pt; padding: 8px;">
            <div style="display: flex; align-items: center; justify-content: center;">
                @php
                    $isGL240 = false;
                    if (isset($calibration->headChamber) && $calibration->headChamber->standard) {
                        $isGL240 = str_contains($calibration->headChamber->standard, 'GL-240');
                    } elseif (isset($calibration->alat_standar)) {
                        $isGL240 = (is_array($calibration->alat_standar) && in_array('GL-240', $calibration->alat_standar)) ||
                                   str_contains($calibration->alat_standar ?? '', 'GL-240');
                    }
                @endphp
                @if($isGL240)
                    <span style="margin-right: 8px; font-weight: bold; color: #000; font-size: 14px;">☑</span>
                @else
                    <span style="margin-right: 8px; font-weight: bold; color: #ccc; font-size: 14px;">□</span>
                @endif
                <span style="font-weight: normal; color: #000;">GL-240</span>
            </div>
        </td>
        <td style="width: 10%; border: 1px solid #000; text-align: center; vertical-align: middle; font-size: 9pt; padding: 8px;">
            <div style="display: flex; align-items: center; justify-content: center;">
                @php
                    $isHuato = false;
                    if (isset($calibration->headChamber) && $calibration->headChamber->standard) {
                        $isHuato = str_contains($calibration->headChamber->standard, 'Huato');
                    } elseif (isset($calibration->alat_standar)) {
                        $isHuato = (is_array($calibration->alat_standar) && in_array('Huato', $calibration->alat_standar)) ||
                                   str_contains($calibration->alat_standar ?? '', 'Huato');
                    }
                @endphp
                @if($isHuato)
                    <span style="margin-right: 8px; font-weight: bold; color: #000; font-size: 14px;">☑</span>
                @else
                    <span style="margin-right: 8px; font-weight: bold; color: #ccc; font-size: 14px;">□</span>
                @endif
                <span style="font-weight: normal; color: #000;">Huato</span>
            </div>
        </td>
        <td rowspan="2" style="width: 20%; border: 1px solid #000; text-align: center; vertical-align: middle; font-weight: bold; font-size: 9pt; padding: 8px; background-color: #f0f0f0;">
            Dikalibrasi<br>oleh
        </td>
        <td rowspan="2" style="width: 20%; border: 1px solid #000; text-align: center; vertical-align: middle; font-weight: bold; font-size: 9pt; padding: 8px; background-color: #f0f0f0;">
            Diperiksa<br>oleh
        </td>
    </tr>

    <!-- ROW 2: KELEMBABAN -->
    <tr>
        <td style="border: 1px solid #000; text-align: left; vertical-align: middle; font-size: 9pt; padding: 8px;">
            - Kelembaban
        </td>
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle; font-size: 9pt; padding: 8px;">
            <div style="display: flex; align-items: center; justify-content: center;">
                @php
                    $isRotronic = false;
                    if (isset($calibration->headChamber) && $calibration->headChamber->standard) {
                        $isRotronic = str_contains($calibration->headChamber->standard, 'Rotronic');
                    } elseif (isset($calibration->alat_standar)) {
                        $isRotronic = (is_array($calibration->alat_standar) && in_array('Rotronic', $calibration->alat_standar)) ||
                                      str_contains($calibration->alat_standar ?? '', 'Rotronic');
                    }
                @endphp
                @if($isRotronic)
                    <span style="margin-right: 8px; font-weight: bold; color: #000; font-size: 14px;">☑</span>
                @else
                    <span style="margin-right: 8px; font-weight: bold; color: #ccc; font-size: 14px;">□</span>
                @endif
                <span style="font-weight: normal; color: #000;">Rotronic</span>
            </div>
        </td>
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle; font-size: 9pt; padding: 8px;">
            <div style="display: flex; align-items: center; justify-content: center;">
                @php
                    $isLutron = false;
                    if (isset($calibration->headChamber) && $calibration->headChamber->standard) {
                        $isLutron = str_contains($calibration->headChamber->standard, 'Lutron');
                    } elseif (isset($calibration->alat_standar)) {
                        $isLutron = (is_array($calibration->alat_standar) && in_array('Lutron', $calibration->alat_standar)) ||
                                    str_contains($calibration->alat_standar ?? '', 'Lutron');
                    }
                @endphp
                @if($isLutron)
                    <span style="margin-right: 8px; font-weight: bold; color: #000; font-size: 14px;">☑</span>
                @else
                    <span style="margin-right: 8px; font-weight: bold; color: #ccc; font-size: 14px;">□</span>
                @endif
                <span style="font-weight: normal; color: #000;">Lutron</span>
            </div>
        </td>
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle; font-size: 9pt; padding: 8px;">
            &nbsp;
        </td>
    </tr>

    <!-- ROW 3: METODE KALIBRASI, TTD DAN NAMA DALAM SATU BARIS -->
    <tr>
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle; font-weight: bold; font-size: 9pt; padding: 8px; background-color: #f0f0f0;">
            Metode<br>Kalibrasi
        </td>
        <td colspan="4" style="border: 1px solid #000; text-align: left; vertical-align: middle; font-size: 9pt; padding: 8px;">
            {{-- Ambil metode kalibrasi dari headChamber --}}
            @if(isset($calibration->headChamber) && $calibration->headChamber->calibrationMethod)
                <strong>{{ $calibration->headChamber->calibrationMethod }}</strong>
            @else
                <strong>PAS-IK1102-29B</strong>
            @endif
        </td>
        <td style="border: 1px solid #000; text-align: left; vertical-align: middle; font-size: 9pt; padding: 8px;">
            <div style="margin-bottom: 10px;">
                <strong>TTD :</strong> 
                @if(isset($calibration->calibrated_signature) && $calibration->calibrated_signature)
                    <span style="color: #0066cc; font-weight: bold;">✓ Tersedia</span>
                @else
                    <span style="color: #999;">-</span>
                @endif
            </div>
            <div>
                <strong>Nama :</strong>
                <span style="font-weight: normal; margin-left: 5px;">
                    {{ $calibration->calibratedBy ?? '—' }}
                </span>
            </div>
        </td>
        <td style="border: 1px solid #000; text-align: left; vertical-align: middle; font-size: 9pt; padding: 8px;">
            <div style="margin-bottom: 10px;">
                <strong>TTD :</strong>
                @if(isset($calibration->verified_signature) && $calibration->verified_signature)
                    <span style="color: #0066cc; font-weight: bold;">✓ Tersedia</span>
                @else
                    <span style="color: #999;">-</span>
                @endif
            </div>
            <div>
                <strong>Nama :</strong>
                <span style="font-weight: normal; margin-left: 5px;">
                    {{ $calibration->verifiedBy ?? '—' }}
                </span>
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