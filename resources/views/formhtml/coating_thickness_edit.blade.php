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
                        <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK46</p>
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
                        <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">COATING THICKNESS</p>
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
                        <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;">{{ $calibration->headCoatingThickness->certificate_id ?? 'N/A' }}</p>
                    </td>
                </tr>
            </table>
<table class="kalibrasi-main-table">
    <!-- Nama Alat -->
    <tr>
        <td style="width: 20%;">
            <p style="margin: 0; color: #000000;">Nama Alat</p>
        </td>
        <td colspan="3">
            <input type="text" class="kalibrasi-input" name="namaAlat" value="{{ old('namaAlat',$calibration->namaAlat) }}">
        </td>
    </tr>

    <!-- Merek & Kode Alat -->
    <tr>
        <td><p class="mb-0 text-dark">Merek</p></td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="text" class="kalibrasi-input me-3" name="brandAlat"
                       value="{{ old('brandAlat',$calibration->brandAlat) }}" style="width:60%;">
                <span class="me-3">Kode Alat :</span>
                <input type="text" class="kalibrasi-input" name="kodeAlat"
                       value="{{ old('kodeAlat',$calibration->kodeAlat) }}" style="width:30%;">
            </div>
        </td>
    </tr>

    <!-- Type / No Seri -->
    <tr>
        <td><p class="mb-0 text-dark">Type / No. Seri</p></td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="text" class="kalibrasi-input me-3" name="typeAlat"
                       value="{{ old('typeAlat',$calibration->typeAlat) }}" style="width:45%;">
                <span class="me-3">/</span>
                <input type="text" class="kalibrasi-input" name="NoSeri"
                       value="{{ old('NoSeri',$calibration->NoSeri) }}" style="width:45%;">
            </div>
        </td>
    </tr>

    <!-- Rentang -->
    <tr>
        <td><p class="mb-0 text-dark">Rentang Ukur</p></td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="text" class="kalibrasi-input me-3" name="rangeMin"
                       value="{{ old('rangeMin',$calibration->rangeMin) }}" style="width:45%;">
                <span class="me-3">-</span>
                <input type="text" class="kalibrasi-input" name="rangeMax"
                       value="{{ old('rangeMax',$calibration->rangeMax) }}" style="width:45%;">
            </div>
        </td>
    </tr>

    <!-- Kapasitas / Resolusi -->
    <tr>
        <td><p class="mb-0 text-dark">Kapasitas / Resolusi</p></td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="text" class="kalibrasi-input me-3" name="kapasitas"
                       value="{{ old('kapasitas',$calibration->kapasitas) }}" style="width:45%;">
                <span class="me-3">/</span>
                <input type="text" class="kalibrasi-input" name="resolusi"
                       value="{{ old('resolusi',$calibration->resolusi) }}" style="width:45%;">
            </div>
        </td>
    </tr>

    <!-- Pemilik -->
    <tr>
        <td><p class="mb-0 text-dark">Nama Pemilik</p></td>
        <td colspan="3">
            <input type="text" class="kalibrasi-input" name="pemilikAlat"
                   value="{{ old('pemilikAlat',$calibration->pemilikAlat) }}">
        </td>
    </tr>

    <!-- Tanggal -->
    <tr>
        <td><p class="mb-0 text-dark">Tanggal Alat Masuk</p></td>
        <td colspan="3">
            <input type="date" class="kalibrasi-input" name="tanggalMasuk"
                   value="{{ old('tanggalMasuk',$calibration->tanggalMasuk) }}">
        </td>
    </tr>

    <tr>
        <td><p class="mb-0 text-dark">Tanggal Kalibrasi</p></td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="date" class="kalibrasi-input me-3" name="tanggalKalibrasi"
                       value="{{ old('tanggalKalibrasi',$calibration->tanggalKalibrasi) }}" style="width:45%;">
                <span class="me-3">Jenis Pembacaan:</span>
                <input type="text" class="kalibrasi-input" name="jenisPembacaan"
                       value="{{ old('jenisPembacaan',$calibration->jenisPembacaan) }}" style="width:45%;">
            </div>
        </td>
    </tr>

    <!-- Tempat -->
    <tr>
        <td><p class="mb-0 text-dark">Tempat Kalibrasi</p></td>
        <td colspan="3">
            <div class="d-flex">
                <div class="form-check me-5">
                    <input class="form-check-input" type="radio" name="tempatKalibrasi" value="lab.PT PAS"
                        {{ old('tempatKalibrasi',$calibration->tempatKalibrasi) == 'lab.PT PAS' ? 'checked' : '' }}>
                    <label class="form-check-label">Lab. PT PAS</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tempatKalibrasi" value="insitu"
                        {{ old('tempatKalibrasi',$calibration->tempatKalibrasi) == 'insitu' ? 'checked' : '' }}>
                    <label class="form-check-label">Insitu</label>
                </div>
            </div>
        </td>
    </tr>

    <!-- Lokasi -->
    <tr>
        <td><p class="mb-0 text-dark">Lokasi PT</p></td>
        <td colspan="3">
            <input type="text" class="kalibrasi-input" name="lokasiPT"
                   value="{{ old('lokasiPT',$calibration->lokasiPT) }}">
        </td>
    </tr>
</table>


           <div class="row mt-4">

    <!-- KIRI: Fungsi Komponen Lainnya -->
    <div class="col-md-6 mb-4">
        <div class="kalibrasi-section-header" style="color:#000000;">
            Fungsi Komponen Lainnya
        </div>

        <div class="d-flex justify-content-center align-items-center mb-4" style="gap:60px;">
            <div class="text-center">
                <span class="fw-bold d-block mb-2" style="color:#000; font-size:14px;">Ok</span>
                <input type="radio" name="kondisiAlat" value="ok"
                    class="form-check-input"
                    {{ old('kondisiAlat', $calibration->kondisiAlat) == 'ok' ? 'checked' : '' }}>
            </div>

            <div class="text-center">
                <span class="fw-bold d-block mb-2" style="color:#000; font-size:14px;">Rusak</span>
                <input type="radio" name="kondisiAlat" value="rusak"
                    class="form-check-input"
                    {{ old('kondisiAlat', $calibration->kondisiAlat) == 'rusak' ? 'checked' : '' }}>
            </div>
        </div>

        <div class="d-flex align-items-center">
            <span class="fw-bold me-3" style="color:#000; min-width:100px;">Keterangan :</span>
            <div style="flex:1;">
                <input type="text" name="keterangan" class="kalibrasi-input"
                    value="{{ old('keterangan', $calibration->keterangan) }}"
                    style="border:none; border-bottom:2px solid #000; background:transparent; width:100%;">
            </div>
        </div>
    </div>


    <!-- KANAN: Kondisi Kalibrasi -->
    <div class="col-md-6 mb-4">
        <div class="kalibrasi-section-header" style="color:#000000;">
            Kondisi Kalibrasi
        </div>

        <table class="table table-bordered">
            <tr>
                <td class="table-secondary fw-bold" style="width:30%;"></td>
                <td class="table-secondary fw-bold text-center">Awal</td>
                <td class="table-secondary fw-bold text-center">Tengah</td>
                <td class="table-secondary fw-bold text-center">Akhir</td>
            </tr>
            <tr>
                <td class="bg-light fw-bold">Suhu (°C)</td>
                <td><input type="text" name="RT_condition1" class="kondisi-input" value="{{ old('RT_condition1', $calibration->RT_condition1) }}"></td>
                <td><input type="text" name="RT_condition2" class="kondisi-input" value="{{ old('RT_condition2', $calibration->RT_condition2) }}"></td>
                <td><input type="text" name="RT_condition3" class="kondisi-input" value="{{ old('RT_condition3', $calibration->RT_condition3) }}"></td>
            </tr>
            <tr>
                <td class="bg-light fw-bold">RH (%)</td>
                <td><input type="text" name="RH_condition1" class="kondisi-input" value="{{ old('RH_condition1', $calibration->RH_condition1) }}"></td>
                <td><input type="text" name="RH_condition2" class="kondisi-input" value="{{ old('RH_condition2', $calibration->RH_condition2) }}"></td>
                <td><input type="text" name="RH_condition3" class="kondisi-input" value="{{ old('RH_condition3', $calibration->RH_condition3) }}"></td>
            </tr>
        </table>
    </div>

</div>


        
    


    <!-- Data Kalibrasi Section -->
                <div class="data-kalibrasi-header" style="color: #000000;">DATA KALIBRASI</div>

       <?php
// Ambil data detail coating thickness dari relasi dengan nama yang benar
$detailCoatingThickness = $calibration->detailCoatingThicknesses ?? collect();
$jumlah_baris = 12;
?>

<table cellspacing="0" cellpadding="0"
       style="margin-left:1pt; width:100%; border:1px solid #000000;
              border-collapse:collapse; font-family:Arial;">

    <!-- Header pertama -->
    <tr style="height:35px;">
        <td style="width:150px; border:1px solid #000000; background:#d9d9d9; text-align:center;">
            <b>Nominal Standard</b>
        </td>
        <td colspan="5" style="border:1px solid #000000; background:#d9d9d9; text-align:center;">
            <b>Pembacaan Alat</b>
        </td>
        <td rowspan="2" style="width:150px; border:1px solid #000000; background:#d9d9d9; text-align:center;">
            <b>Resolusi Alat</b>
        </td>
    </tr>

    <!-- Header kedua -->
    <tr style="height:30px;">
       <td style="border:1px solid #000000; background:#d9d9d9; text-align:center;">
    <input type="text"
           name="unit"
           value="{{ old('unit', $calibration->unit ?? '') }}"
           placeholder="Unit"
           style="width:100%; border:none; background:transparent; text-align:center; font-weight:bold;">
</td>

        <?php for ($i = 1; $i <= 5; $i++): ?>
            <td style="width:90px; border:1px solid #000000; background:#d9d9d9; text-align:center;">
                <b><?= $i ?></b>
            </td>
        <?php endfor; ?>
    </tr>

    <!-- Baris data -->
    <?php for ($row = 1; $row <= $jumlah_baris; $row++): 
        $detail = $detailCoatingThickness[$row-1] ?? null;
    ?>
    <tr style="height:35px;">

        <!-- Nominal -->
        <td style="border:1px solid #000000; text-align:center;">
            <input type="number" step="0.01"
                   name="detail[<?= $row ?>][titikUkur]"
                   value="<?= $detail->titikUkur ?? '' ?>"
                   style="width:100%; border:none; text-align:center;">
        </td>

        <!-- 5 kolom pembacaan -->
        <?php for ($col = 1; $col <= 5; $col++):
            $fieldName = 'rep0' . $col;
        ?>
        <td style="border:1px solid #000000; text-align:center;">
            <input type="number" step="0.01"
                   name="detail[<?= $row ?>][<?= $fieldName ?>]"
                   value="<?= $detail->$fieldName ?? '' ?>"
                   style="width:100%; border:none; text-align:center;">
        </td>
        <?php endfor; ?>

        <!-- Resolusi -->
        <td style="border:1px solid #000000; text-align:center;">
            <input type="number" step="0.01"
                   name="detail[<?= $row ?>][resolusi]"
                   value="<?= $detail->resolusi ?? '' ?>"
                   style="width:100%; border:none; text-align:center;">
        </td>

    </tr>
    <?php endfor; ?>
</table>


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
<?php
// Ambil data head coating thickness dari relasi
$headCoatingThickness = $calibration->headCoatingThickness ?? null;

// Ambil data dari field standard
$standardText = $headCoatingThickness->standard ?? 'Coating Film Standar';

// Default values
$defaultNoSeri = 'T99022255-1';
$alatStandar = 'Coating Film Standar';
$noSeriCustom = '';
$noSeriDefault = $defaultNoSeri;
$isCustomSeri = false;

// Parse data dari database
if (!empty($standardText)) {
    if (strpos($standardText, ',') !== false) {
        // Format: "Coating Film Standar, No. Seri sda22"
        $parts = explode(',', $standardText, 2);
        $alatStandar = trim($parts[0]);
        
        if (isset($parts[1])) {
            $seriText = trim($parts[1]);
            // Ekstrak nomor seri
            if (preg_match('/(?:No\.?\s*Seri\s*)?([\w\-]+)/i', $seriText, $matches)) {
                $extractedSeri = trim($matches[1]);
                
                // Cek apakah nomor seri adalah custom atau default
                if ($extractedSeri === $defaultNoSeri || $extractedSeri === 'T99') {
                    // Ini default
                    $noSeriDefault = $extractedSeri;
                    $isCustomSeri = false;
                } else {
                    // Ini custom
                    $noSeriCustom = $extractedSeri;
                    $isCustomSeri = true;
                }
            }
        }
    } else {
        $alatStandar = trim($standardText);
    }
}
?>

<style>
    /* Styling untuk radio button yang lebih jelas */
    .radio-view {
        width: 16px;
        height: 16px;
        border: 2px solid #000;
        border-radius: 50%;
        display: inline-block;
        position: relative;
        vertical-align: middle;
        background-color: white;
    }
    
    .radio-view.checked:after {
        content: '';
        width: 8px;
        height: 8px;
        background-color: #000;
        border-radius: 50%;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    
    /* Atau styling langsung untuk input radio */
    input[type="radio"][disabled] {
        width: 16px;
        height: 16px;
        accent-color: #000; /* Warna untuk browser modern */
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        border: 2px solid #000;
        border-radius: 50%;
        outline: none;
        cursor: default;
        background-color: white;
    }
    
    input[type="radio"][disabled]:checked {
        background-color: #000;
        box-shadow: inset 0 0 0 3px white;
    }
</style>

<table cellspacing="0" cellpadding="0" class="TableNormal"
       style="margin-left:15pt; width:100%; border-collapse:collapse; border:1pt solid #000000;">

    <!-- JUDUL -->
    <tr style="height:17pt;">
        <td colspan="8" style="border:1pt solid #000000; padding:4px; text-align:center;">
            <span style="font-family:Arial; font-size:13pt; font-weight:bold;">
                Isilah lembar data kalibrasi dengan lengkap dan jelas!
            </span>
        </td>
    </tr>

    <!-- ALAT STANDAR + PETUGAS -->
    <tr style="height:14.2pt;">
        <td rowspan="2" style="border:1pt solid #000; text-align:center;">
            Alat Standar
        </td>

        <td colspan="5" style="border:1pt solid #000;">
            <input type="text" name="alat_standar"
                   value="{{ $alatStandar }}"
                   style="width:100%; border:none; text-align:center; font-size:11pt;">
        </td>

        <td style="border:1pt solid #000; text-align:center;">Dikalibrasi oleh</td>
        <td style="border:1pt solid #000; text-align:center;">Diperiksa oleh</td>
    </tr>

    <!-- NO SERI -->
    <tr>
        <td style="border:1pt solid #000;">No Seri</td>

        <td style="border:1pt solid #000; text-align:center;">
            <input type="radio" name="no_seri_pilihan" value="custom"
                   {{ $isCustomSeri ? 'checked' : '' }}>
        </td>

        <td style="border:1pt solid #000;">
            <input type="text" name="no_seri_custom"
                   value="{{ $noSeriCustom }}"
                   style="width:100%; border:none; text-align:center;"
                   placeholder="custom">
        </td>

        <td style="border:1pt solid #000; text-align:center;">
            <input type="radio" name="no_seri_pilihan" value="default"
                   {{ !$isCustomSeri ? 'checked' : '' }}>
        </td>

        <td style="border:1pt solid #000;">
            <input type="text" name="no_seri_default"
                   value="{{ $noSeriDefault }}"
                   readonly
                   style="width:100%; border:none; text-align:center;">
                   
        </td>
    </tr>

    <!-- METODE + TTD -->
    <tr>
        <td rowspan="2" style="border:1pt solid #000; text-align:center;">
            Metode Kalibrasi
        </td>

        <td colspan="5" rowspan="2" style="border:1pt solid #000;">
            <input type="text" name="calibration_method"
                   value="{{ $headCoatingThickness->calibrationMethod ?? 'PAS-IK1102-46' }}"
                   style="width:100%; border:none; text-align:center; font-size:12pt;">
        </td>

        <td style="border:1pt solid #000;">TTD :</td>
        <td style="border:1pt solid #000;">TTD :</td>
    </tr>

    <!-- NAMA -->
  <tr style="height:20pt;">
    <td style="border:1pt solid #000; padding:6px;">
        <div style="display:flex; align-items:center;">
            <span style="font-weight:normal; margin-right:6px; white-space:nowrap;">
                NAMA :
            </span>
            <input type="text" name="calibrated_by"
                   value="{{ $calibration->calibratedBy ?? $calibration->user->name ?? '' }}"
                   style="flex:1; border:none; font-weight:normal; outline:none;">
        </div>
    </td>

    <td style="border:1pt solid #000; padding:6px;">
        <div style="display:flex; align-items:center;">
            <span style="font-weight:normal; margin-right:6px; white-space:nowrap;">
                NAMA :
            </span>
            <input type="text" name="verified_by"
                   value="{{ $calibration->verifiedBy ?? '' }}"
                   style="flex:1; border:none; font-weight:normal; outline:none;">
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