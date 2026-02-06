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
                        <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK29</p>
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
                        <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">ENCLOSURE</p>
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
                        <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;">{{ $calibration->headEnclosure->certificate_id ?? 'N/A' }}</p>
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
// === ENCLOSURE VIEW - TSETTING SEBAGAI STRING MURNI ===
$interval_waktu = [1, 2, 3, 4, 5, 13, 20, 30];

// PROSES DATA
$tsettingValues = [];
$repetition = 1;
$detailsByRepetition = [];

// CARI DATA ADDENCLOSURE (UNTUK TSETTING)
// Coba dari relasi terlebih dahulu
$addEnclosuresData = null;

// Cek semua kemungkinan nama relasi
if (method_exists($calibration, 'addEnclosures') && $calibration->addEnclosures->count() > 0) {
    $addEnclosuresData = $calibration->addEnclosures;
} elseif (method_exists($calibration, 'addEnclosure') && $calibration->addEnclosure->count() > 0) {
    $addEnclosuresData = $calibration->addEnclosure;
} else {
    // Jika tidak ada relasi, coba query langsung
    try {
        $addEnclosuresData = \DB::table('add_enclosures')
            ->where('calibration_id', $calibration->id)
            ->orderBy('repetition_number')
            ->get();
        
        // Coba tabel dengan nama singular jika tidak ditemukan
        if ($addEnclosuresData->count() == 0) {
            $addEnclosuresData = \DB::table('add_enclosure')
                ->where('calibration_id', $calibration->id)
                ->orderBy('repetition_number')
                ->get();
        }
    } catch (\Exception $e) {
        // Jika error, set empty collection
        $addEnclosuresData = collect();
    }
}

// Pastikan $addEnclosuresData adalah collection
if (!$addEnclosuresData instanceof \Illuminate\Support\Collection) {
    $addEnclosuresData = collect($addEnclosuresData);
}

// PROSES TSETTING DARI ADDENCLOSURE
if ($addEnclosuresData->isNotEmpty()) {
    foreach ($addEnclosuresData as $index => $add) {
        // Gunakan property access yang tepat
        $repNum = $add->repetition_number ?? ($add['repetition_number'] ?? 1);
        
        // Coba beberapa kemungkinan nama field untuk TSetting
        $tsettingValue = null;
        if (isset($add->TSetting)) {
            $tsettingValue = $add->TSetting;
        } elseif (isset($add->tsetting)) {
            $tsettingValue = $add->tsetting;
        } elseif (isset($add['TSetting'])) {
            $tsettingValue = $add['TSetting'];
        } elseif (isset($add['tsetting'])) {
            $tsettingValue = $add['tsetting'];
        } elseif (isset($add->t_setting)) {
            $tsettingValue = $add->t_setting;
        } elseif (isset($add['t_setting'])) {
            $tsettingValue = $add['t_setting'];
        }
        
        if ($tsettingValue !== null && $tsettingValue !== '' && !empty(trim($tsettingValue))) {
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

// CARI DATA DETAILENCLOSURE (UNTUK PEMBACAAN)
// Coba dari relasi terlebih dahulu
$detailEnclosuresData = null;

if (method_exists($calibration, 'detailEnclosures') && $calibration->detailEnclosures->count() > 0) {
    $detailEnclosuresData = $calibration->detailEnclosures;
} elseif (method_exists($calibration, 'detailEnclosure') && $calibration->detailEnclosure->count() > 0) {
    $detailEnclosuresData = $calibration->detailEnclosure;
} else {
    // Jika tidak ada relasi, coba query langsung
    try {
        $detailEnclosuresData = \DB::table('detail_enclosures')
            ->where('calibration_id', $calibration->id)
            ->orderBy('repetition_number')
            ->orderBy('interval_number')
            ->get();
        
        // Coba tabel dengan nama singular jika tidak ditemukan
        if ($detailEnclosuresData->count() == 0) {
            $detailEnclosuresData = \DB::table('detail_enclosure')
                ->where('calibration_id', $calibration->id)
                ->orderBy('repetition_number')
                ->orderBy('interval_number')
                ->get();
        }
    } catch (\Exception $e) {
        // Jika error, set empty collection
        $detailEnclosuresData = collect();
    }
}

// Pastikan $detailEnclosuresData adalah collection
if (!$detailEnclosuresData instanceof \Illuminate\Support\Collection) {
    $detailEnclosuresData = collect($detailEnclosuresData);
}

// PROSES DETAILENCLOSURE
if ($detailEnclosuresData->isNotEmpty()) {
    foreach ($detailEnclosuresData as $detail) {
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
                $displayValue = htmlspecialchars($currentTsetting) . '°C';
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
            <td style="width:10%; border:2px solid #000; vertical-align:middle; text-align:center">
                <span style="font-weight: bold; color: #000000; font-size:9pt">Interval Waktu</span>
            </td>
            <td style="width:12%; border:2px solid #000; vertical-align:middle; text-align:center">
                <span style="font-weight: bold; color: #000000; font-size:9pt">Pembacaan Alat</span>
            </td>
            <td colspan="9" style="border:2px solid #000; vertical-align:middle; text-align:center">
                <span style="font-weight: bold; color: #000000; font-size:9pt">Pembacaan Sensor</span>
            </td>
        </tr>
        <tr style="background: #e8e8e8; height:13pt">
            <td style="border:2px solid #000; vertical-align:middle; text-align:center">
                <span style="font-weight: bold; color: #000000; font-size:9pt">(Menit)</span>
            </td>
            <td style="border:2px solid #000; vertical-align:middle; text-align:center">
                <span style="font-family:Arial; font-size:6pt; font-weight:bold; letter-spacing:-0.25pt">o</span>
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.25pt; vertical-align:-3pt; font-size:9pt;">C</span>
            </td>
            @for($s = 1; $s <= 9; $s++)
            <td style="width:8.67%; border:2px solid #000; vertical-align:middle; text-align:center">
                <span style="font-weight: bold; color: #000000; font-size:9pt">{{ $s }}</span>
            </td>
            @endfor
        </tr>
        
        @foreach($interval_waktu as $interval)
        @php
            $detailData = $detailsByRepetition[$p][$interval] ?? null;
        @endphp
        <tr style="height:22pt;">
            <td style="border:2px solid #000; padding:0; vertical-align:middle; text-align:center; font-weight:bold; font-size:10pt; color:#000;">
                {{ $interval }}
            </td>
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
            
            @for($s = 1; $s <= 9; $s++)
            @php
                $sensorValue = null;
                if ($detailData) {
                    // Coba beberapa format nama field
                    $fieldNames = [
                        "readSensor{$s}",
                        "read_sensor_{$s}",
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
        </tr>
        @endforeach
    </table>
    @endfor
</ol>
&nbsp;  &nbsp;
                 <!-- Footer Section -->
                 <table class="kalibrasi-main-table" style="width: 100%; border-collapse: collapse;">
    <!-- HEADER FOOTER -->
    <tr>
        <td colspan="6" style="text-align: center; border: 1px solid #000; border-bottom: none; padding: 10px 0;">
            <span style="font-weight: bold; font-size: 18px; color: #000000;">Isilah lembar data kalibrasi dengan lengkap dan jelas!</span>
        </td>
    </tr>

    <!-- ALAT STANDAR + CHECKBOX (VIEW MODE) -->
    <tr style="height: 40px;">
        <td rowspan="3" style="width: 20%; border: 1px solid #000; vertical-align: middle; text-align: center; font-weight: bold; font-size: 10pt; color: #000000; background-color: #f8f9fa;">
            Alat<br>Standar
        </td>

        <!-- Alat 1 -->
        <td style="width: 5%; border: 1px solid #000; text-align: center; vertical-align: middle;">
            @php
                // Ambil data alat standar dari database
                $alatStandar = isset($calibration) && $calibration->headEnclosure 
                    ? $calibration->headEnclosure->standard 
                    : '';
                
                // Cek apakah alat 1 ada dalam data
                $hasAlat1 = str_contains($alatStandar, 'Mini Data Logger Graphtec GL-220');
            @endphp
            @if($hasAlat1)
                <span style="font-weight: bold; color: #000000; font-size: 12px;">✓</span>
            @else
                <span style="color: #cccccc;">□</span>
            @endif
        </td>
        <td colspan="2" style="border: 1px solid #000; padding-left: 12px; font-size: 9pt; vertical-align: middle; color: #000000;">
            <span style="display: block; padding: 5px 0;">
                Mini Data Logger Graphtec GL-220
            </span>
        </td>

        <!-- Dikalibrasi oleh -->
        <td rowspan="3" style="width: 20%; border: 1px solid #000; text-align: center; vertical-align: top; font-size: 9pt; color: #000000; background-color: #f8f9fa; padding-top: 15px;">
            <strong>Dikalibrasi<br>oleh</strong>
        </td>
        <!-- Diperiksa oleh -->
        <td rowspan="3" style="width: 20%; border: 1px solid #000; text-align: center; vertical-align: top; font-size: 9pt; color: #000000; background-color: #f8f9fa; padding-top: 15px;">
            <strong>Diperiksa<br>oleh</strong>
        </td>
    </tr>

    <!-- Alat 2 -->
    <tr style="height: 40px;">
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle;">
            @php
                $hasAlat2 = str_contains($alatStandar, 'Mini Data Logger Graphtec GL-240');
            @endphp
            @if($hasAlat2)
                <span style="font-weight: bold; color: #000000; font-size: 12px;">✓</span>
            @else
                <span style="color: #cccccc;">□</span>
            @endif
        </td>
        <td colspan="2" style="border: 1px solid #000; padding-left: 12px; font-size: 9pt; vertical-align: middle; color: #000000;">
            <span style="display: block; padding: 5px 0;">
                Mini Data Logger Graphtec GL-240
            </span>
        </td>
    </tr>

    <!-- Alat 3 -->
    <tr style="height: 40px;">
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle;">
            @php
                $hasAlat3 = str_contains($alatStandar, 'Mini Data Logger Huato');
            @endphp
            @if($hasAlat3)
                <span style="font-weight: bold; color: #000000; font-size: 12px;">✓</span>
            @else
                <span style="color: #cccccc;">□</span>
            @endif
        </td>
        <td colspan="2" style="border: 1px solid #000; padding-left: 12px; font-size: 9pt; vertical-align: middle; color: #000000;">
            <span style="display: block; padding: 5px 0;">
                 Mini Data Logger Huato
            </span>
        </td>
    </tr>

    <!-- METODE KALIBRASI + TTD & NAMA (VIEW MODE) -->
    <tr style="height: 40px;">
        <td rowspan="2" style="width: 20%; border: 1px solid #000; text-align: center; vertical-align: middle; font-size: 9pt; color: #000000; background-color: #f8f9fa; padding: 10px;">
            <strong>Metode Kalibrasi</strong>
        </td>
        <td colspan="3" rowspan="2" style="border: 1px solid #000; padding: 10px; font-size: 9pt; vertical-align: middle; color: #000000; line-height: 1.4;">
            @if(isset($calibration) && $calibration->headEnclosure && $calibration->headEnclosure->calibrationMethod)
                {{ $calibration->headEnclosure->calibrationMethod }}
            @else
                PAS-IK1102-29
            @endif
        </td>
        
        <!-- Nama Dikalibrasi Oleh (VIEW MODE) -->
        <td style="width: 20%; border: 1px solid #000; padding: 5px; font-size: 9pt; vertical-align: middle; color: #000000;">
            <div style="width: 100%; padding: 5px; font-size: 9pt; min-height: 20px;">
                {{ $calibration->calibratedBy ?? '-' }}
            </div>
        </td>
        
        <!-- Nama Diperiksa Oleh (VIEW MODE) -->
        <td style="width: 20%; border: 1px solid #000; padding: 5px; font-size: 9pt; vertical-align: middle; color: #000000;">
            <div style="width: 100%; padding: 5px; font-size: 9pt; min-height: 20px;">
                {{ $calibration->verifiedBy ?? '-' }}
            </div>
        </td>
    </tr>

    <!-- TTD (VIEW MODE) -->
    <tr style="height: 40px;">
        <!-- Kolom kosong untuk metode kalibrasi -->
        <td style="width: 20%; border: 1px solid #000; padding: 10px; font-size: 9pt; vertical-align: middle; color: #000000; text-align: left;">
            <strong>TTD :</strong>
            <div style="margin-top: 5px; height: 60px; display: flex; align-items: center; justify-content: center;">
                <span style="color: #666; font-style: italic; font-size: 8pt;">
                    @if(isset($calibration) && $calibration->calibrated_by)
                        (Tanda tangan {{ $calibration->calibrated_by }})
                    @else
                        (Tanda tangan)
                    @endif
                </span>
            </div>
        </td>
        <td style="width: 20%; border: 1px solid #000; padding: 10px; font-size: 9pt; vertical-align: middle; color: #000000; text-align: left;">
            <strong>TTD :</strong>
            <div style="margin-top: 5px; height: 60px; display: flex; align-items: center; justify-content: center;">
                <span style="color: #666; font-style: italic; font-size: 8pt;">
                    @if(isset($calibration) && $calibration->verified_by)
                        (Tanda tangan {{ $calibration->verified_by }})
                    @else
                        (Tanda tangan)
                    @endif
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