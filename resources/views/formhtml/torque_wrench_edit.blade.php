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
                        <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK13</p>
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
                        <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">TORQUE WRENCH</p>
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
                        <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;">{{ $calibration->headTorqueWrench->certificate_id ?? 'N/A' }}</p>
                    </td>
                </tr>
            </table>

           <table class="kalibrasi-main-table">

    <tr>
        <td style="width:20%;">
            <p style="margin:0;color:#000;">Nama Alat</p>
        </td>
        <td colspan="3">
            <input type="text" name="namaAlat" class="kalibrasi-input"
                   value="{{ old('namaAlat', $calibration->namaAlat) }}">
        </td>
    </tr>

    <tr>
        <td><p style="margin:0;color:#000;">Merek</p></td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="text" name="brandAlat" class="kalibrasi-input me-3"
                       value="{{ old('brandAlat', $calibration->brandAlat) }}" style="width:60%;">
                <span class="me-3" style="color:#000;">Kode Alat :</span>
                <input type="text" name="kodeAlat" class="kalibrasi-input"
                       value="{{ old('kodeAlat', $calibration->kodeAlat) }}" style="width:30%;">
            </div>
        </td>
    </tr>

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

    <tr>
        <td><p style="margin:0;color:#000;">Nama Pemilik</p></td>
        <td colspan="3">
            <input type="text" name="pemilikAlat" class="kalibrasi-input"
                   value="{{ old('pemilikAlat', $calibration->pemilikAlat) }}">
        </td>
    </tr>

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
                       value="{{ old('tanggalKalibrasi', \Carbon\Carbon::parse($calibration->tanggalKalibrasi)->format('Y-m-d')) }}" style="width:45%;">
                <span class="me-3" style="color:#000;">Jenis Pembacaan:</span>
                <input type="text" name="jenisPembacaan" class="kalibrasi-input"
                       value="{{ old('jenisPembacaan', $calibration->jenisPembacaan) }}" style="width:45%;">
            </div>
        </td>
    </tr>

    <tr>
        <td><p style="margin:0;color:#000;">Tempat Kalibrasi</p></td>
        <td colspan="3">
            <div class="d-flex">
                <div class="form-check me-5">
                    <input class="form-check-input" type="radio" name="tempatKalibrasi" value="lab.PT PAS"
                        {{ old('tempatKalibrasi', $calibration->tempatKalibrasi) == 'lab.PT PAS' ? 'checked' : '' }}>
                    <label class="form-check-label" style="color:#000;">Lab. PT.PAS</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tempatKalibrasi" value="insitu"
                        {{ old('tempatKalibrasi', $calibration->tempatKalibrasi) == 'insitu' ? 'checked' : '' }}>
                    <label class="form-check-label" style="color:#000;">Insitu</label>
                </div>
            </div>
        </td>
    </tr>

    <tr>
        <td><p style="margin:0;color:#000;">Lokasi PT</p></td>
        <td colspan="3">
            <input type="text" name="lokasiPT" class="kalibrasi-input"
                   value="{{ old('lokasiPT', $calibration->lokasiPT) }}">
        </td>
    </tr>
      <tr>
        <td><p style="margin:0;color:#000;">Kode TH</p></td>
        <td colspan="3">
            <input type="text" name="kode_th" class="kalibrasi-input"
                   value="{{ old('kode_th', $calibration->kode_th) }}">
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
        <span class="fw-bold d-block mb-2" style="color:#000;font-size:14px;">Ok</span>
        <input type="radio" name="kondisiAlat" value="ok" class="form-check-input"
            style="width:18px;height:18px;display:block;margin:0 auto;"
            {{ old('kondisiAlat', $calibration->kondisiAlat) == 'ok' ? 'checked' : '' }}>
    </div>
    <div class="text-center">
        <span class="fw-bold d-block mb-2" style="color:#000;font-size:14px;">Rusak</span>
        <input type="radio" name="kondisiAlat" value="rusak" class="form-check-input"
            style="width:18px;height:18px;display:block;margin:0 auto;"
            {{ old('kondisiAlat', $calibration->kondisiAlat) == 'rusak' ? 'checked' : '' }}>
    </div>
</div>

<!-- Keterangan Section -->
<div class="d-flex align-items-center">
    <span class="fw-bold me-3" style="color:#000;min-width:100px;">Keterangan :</span>
    <div style="flex:1;">
        <input type="text" name="keterangan" class="kalibrasi-input"
               value="{{ old('keterangan', $calibration->keterangan) }}"
               style="border:none;border-bottom:2px solid #000;border-radius:0;padding:4px 0;background:transparent;width:100%;">
    </div>
</div>
</div>

<!-- Kondisi Kalibrasi -->
<div class="col-md-6 mb-4">
    <div class="kalibrasi-section-header" style="color:#000;">Kondisi Kalibrasi</div>

    <table class="table table-bordered">
        <tr>
            <td class="table-secondary fw-bold" style="width:30%;color:#000;"></td>
            <td class="table-secondary fw-bold text-center" style="color:#000;">Awal</td>
            <td class="table-secondary fw-bold text-center" style="color:#000;">Tengah</td>
            <td class="table-secondary fw-bold text-center" style="color:#000;">Akhir</td>
        </tr>
        <tr>
            <td class="bg-light fw-bold" style="color:#000;">Suhu (°C)</td>
            <td><input type="number" step="any"  name="RT_condition1" class="kondisi-input"
                       value="{{ old('RT_condition1', $calibration->RT_condition1) }}"></td>
            <td><input type="number" step="any"  name="RT_condition2" class="kondisi-input"
                       value="{{ old('RT_condition2', $calibration->RT_condition2) }}"></td>
            <td><input type="number" step="any"  name="RT_condition3" class="kondisi-input"
                       value="{{ old('RT_condition3', $calibration->RT_condition3) }}"></td>
        </tr>
        <tr>
            <td class="bg-light fw-bold" style="color:#000;">RH (%)</td>
            <td><input type="number" step="any"  name="RH_condition1" class="kondisi-input"
                       value="{{ old('RH_condition1', $calibration->RH_condition1) }}"></td>
            <td><input type="number" step="any"  name="RH_condition2" class="kondisi-input"
                       value="{{ old('RH_condition2', $calibration->RH_condition2) }}"></td>
            <td><input type="number" step="any"  name="RH_condition3" class="kondisi-input"
                       value="{{ old('RH_condition3', $calibration->RH_condition3) }}"></td>
        </tr>
    </table>
</div>


            <!-- Data Kalibrasi Section -->
            <div class="data-kalibrasi-header" style="color: #000000;">DATA KALIBRASI</div>
            
          <table cellspacing="0" cellpadding="0" class="TableNormal" style="margin-left:0.6pt; border:1pt solid #000000; -aw-border-insideh:1pt single #000000; -aw-border-insidev:1pt single #000000; border-collapse:collapse; width: 100%; max-width: 1500px;">
    <tr style="height:9pt">
        <td rowspan="2" style="width:90pt; border:solid 1pt; border-left-style:solid; vertical-align:middle; text-align:center">
            <p class="TableParagraph" style="margin:0; font-size:10pt; line-height:1.1">
                <span style="font-family:Arial; font-weight:bold">Nominal Setting alat</span>
            </p>
        </td>
        <td colspan="6" style="width:380pt; border:solid 1pt; border-right-style:solid; vertical-align:middle; text-align:center">
            <p class="TableParagraph" style="margin:0; font-size:10pt; line-height:1.1">
                <span style="font-family:Arial; font-weight:bold">Penunjukan Standard</span>
            </p>
        </td>
    </tr>
    <tr style="height:13pt">
        <td colspan="3" style="width:190pt; border:solid 1pt; vertical-align:middle; text-align:center">
            <p class="TableParagraph" style="margin:0; font-size:10pt; line-height:1.15">
                <span style="font-weight:bold">Clockwise</span>
                <span style="font-weight:bold"> (</span>
                <input type="text"
                    name="satuan_cw"
                    value="{{ old('satuan_cw', $calibration->headTorqueWrench->satuan_cw ?? '') }}"
                    style="
                        width:120px;
                        border:none;
                        outline:none;
                        background:transparent;
                        font-size:7.5pt;
                        letter-spacing:normal;
                        text-align:center;
                        padding:0;
                        margin:0;
                    "
                    placeholder=".........">
                <span style="font-weight:bold">)</span>
            </p>
        </td>
        <td colspan="3" style="width:190pt; border:solid 1pt; vertical-align:middle; text-align:center">
            <p class="TableParagraph" style="margin:0; font-size:10pt; line-height:1.15">
                <span style="font-weight:bold">Counter Clockwise</span>
                <span style="font-weight:bold"> (</span>
                <input type="text"
                    name="satuan_ccw"
                    value="{{ old('satuan_ccw', $calibration->headTorqueWrench->satuan_ccw ?? '') }}"
                    style="
                        width:120px;
                        border:none;
                        outline:none;
                        background:transparent;
                        font-size:7.5pt;
                        letter-spacing:normal;
                        text-align:center;
                        padding:0;
                        margin:0;
                    "
                    placeholder=".........">
                <span style="font-weight:bold">)</span>
            </p>
        </td>
    </tr>
    <tr style="height:12pt">
        <td style="width:90pt; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:top; text-align:center">
            <p class="TableParagraph" style="margin-top:0.8pt; margin-left:8pt; font-size:8pt">
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.1pt;">
                    (
                    <input type="text"
                        name="satuan_setting_alat"
                        value="{{ old('satuan_setting_alat', $calibration->headTorqueWrench->satuan_setting_alat ?? '') }}"
                        style="
                            border:none;
                            border-bottom:1px dotted #000;
                            outline:none;
                            background:transparent;
                            width:120px;
                            font-family:Arial;
                            font-weight:bold;
                            letter-spacing:-0.1pt;
                            text-align:center;
                        "
                        placeholder="………………..">
                    )
                </span>
            </p>
        </td>
        <td style="width:45pt; border-style:solid; border-width:1pt; vertical-align:top">
            <p class="TableParagraph" style="margin-top:1.2pt; margin-left:1.2pt; text-align:center; font-size:8pt">
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.5pt">1</span>
            </p>
        </td>
        <td style="width:45pt; border-style:solid; border-width:1pt; vertical-align:top">
            <p class="TableParagraph" style="margin-top:1.2pt; margin-left:1.2pt; text-align:center; font-size:8pt">
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.5pt">2</span>
            </p>
        </td>
        <td style="width:45pt; border-style:solid; border-width:1pt; vertical-align:top">
            <p class="TableParagraph" style="margin-top:1.2pt; margin-right:0.1pt; margin-left:1.2pt; text-align:center; font-size:8pt">
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.5pt">3</span>
            </p>
        </td>
        <td style="width:45pt; border-style:solid; border-width:1pt; vertical-align:top">
            <p class="TableParagraph" style="margin-top:1.2pt; margin-left:1pt; text-align:center; font-size:8pt">
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.5pt">1</span>
            </p>
        </td>
        <td style="width:45pt; border-style:solid; border-width:1pt; vertical-align:top">
            <p class="TableParagraph" style="margin-top:1.2pt; margin-left:1pt; text-align:center; font-size:8pt">
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.5pt">2</span>
            </p>
        </td>
        <td style="width:45pt; border-top-style:solid; border-top-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:top">
            <p class="TableParagraph" style="margin-top:1.2pt; margin-right:0.1pt; margin-left:1pt; text-align:center; font-size:8pt">
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.5pt">3</span>
            </p>
        </td>
    </tr>
    
    <!-- Baris 1-13 dengan input field untuk edit -->
    @for($i = 1; $i <= 13; $i++)
        @php
            // Cari data untuk baris ini
            $detail = isset($calibration) && $calibration->detailTorqueWrenchs && $calibration->detailTorqueWrenchs->count() > 0 
                ? ($calibration->detailTorqueWrenchs->get($i-1) ?? null) 
                : null;
            
            // Tentukan nama input yang konsisten
            $inputName = "detail[" . ($i-1) . "]";
        @endphp
        
        <tr style="height:14pt">
            <td style="width:90pt; 
                @if($i < 13) 
                    border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-bottom-style:solid; border-bottom-width:1pt;
                @else
                    border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt;
                @endif
                vertical-align:top; text-align:center;">
                @if($detail && $detail->id)
                    <input type="hidden" name="{{ $inputName }}[id]" value="{{ $detail->id }}">
                @endif
                <input type="hidden" name="{{ $inputName }}[row_index]" value="{{ $i-1 }}">
                <input type="text" 
                       name="{{ $inputName }}[titikUkur]" 
                       value="{{ old($inputName . '.titikUkur', $detail->titikUkur ?? '') }}"
                       style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                       placeholder="&#xa0;">
            </td>
            <td style="width:45pt; 
                @if($i < 13) 
                    border-style:solid; border-width:1pt;
                @else
                    border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt;
                @endif
                vertical-align:top">
                <input type="text" 
                       name="{{ $inputName }}[cw1]" 
                       value="{{ old($inputName . '.cw1', $detail->cw1 ?? '') }}"
                       style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                       placeholder="&#xa0;">
            </td>
            <td style="width:45pt; 
                @if($i < 13) 
                    border-style:solid; border-width:1pt;
                @else
                    border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt;
                @endif
                vertical-align:top">
                <input type="text" 
                       name="{{ $inputName }}[cw2]" 
                       value="{{ old($inputName . '.cw2', $detail->cw2 ?? '') }}"
                       style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                       placeholder="&#xa0;">
            </td>
            <td style="width:45pt; 
                @if($i < 13) 
                    border-style:solid; border-width:1pt;
                @else
                    border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt;
                @endif
                vertical-align:top">
                <input type="text" 
                       name="{{ $inputName }}[cw3]" 
                       value="{{ old($inputName . '.cw3', $detail->cw3 ?? '') }}"
                       style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                       placeholder="&#xa0;">
            </td>
            <td style="width:45pt; 
                @if($i < 13) 
                    border-style:solid; border-width:1pt;
                @else
                    border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt;
                @endif
                vertical-align:top">
                <input type="text" 
                       name="{{ $inputName }}[ccw1]" 
                       value="{{ old($inputName . '.ccw1', $detail->ccw1 ?? '') }}"
                       style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                       placeholder="&#xa0;">
            </td>
            <td style="width:45pt; 
                @if($i < 13) 
                    border-style:solid; border-width:1pt;
                @else
                    border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt;
                @endif
                vertical-align:top">
                <input type="text" 
                       name="{{ $inputName }}[ccw2]" 
                       value="{{ old($inputName . '.ccw2', $detail->ccw2 ?? '') }}"
                       style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                       placeholder="&#xa0;">
            </td>
            <td style="width:45pt; 
                @if($i < 13) 
                    border-top-style:solid; border-top-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt;
                @else
                    border-top-style:solid; border-top-width:1pt; border-left-style:solid; border-left-width:1pt;
                @endif
                vertical-align:top">
                <input type="text" 
                       name="{{ $inputName }}[ccw3]" 
                       value="{{ old($inputName . '.ccw3', $detail->ccw3 ?? '') }}"
                       style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                       placeholder="&#xa0;">
            </td>
        </tr>
    @endfor
</table>

<!-- Repeatability Clockwise - EDIT MODE -->
@php
    $addTorqueWrench = $calibration->addTorqueWrench ?? null;
@endphp

<p class="BodyText" style="margin-top:2pt; margin-left:2pt">
    <span style="letter-spacing:-0.1pt; font-size:9.5pt;">Repeatability Clockwise</span>
</p>

<table cellspacing="0" cellpadding="0" class="TableNormal" style="margin-left:0.6pt; border:1pt solid #000000; -aw-border-insideh:1pt single #000000; -aw-border-insidev:1pt single #000000; border-collapse:collapse; width: 100%; max-width: 450px;">
    <tr style="height:14pt">
        <td style="width:90pt; border-right-style:solid; border-right-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:top; padding:1px;">
            <input type="text" 
                   name="repCw01"
                   value="{{ $addTorqueWrench->repCw01 ?? '' }}"
                   style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                   placeholder="-">
        </td>
        <td style="width:45pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:top; padding:1px;">
            <input type="text" 
                   name="repCw02"
                   value="{{ $addTorqueWrench->repCw02 ?? '' }}"
                   style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                   placeholder="-">
        </td>
        <td style="width:45pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:top; padding:1px;">
            <input  type="text" 
                   name="repCw03"
                   value="{{ $addTorqueWrench->repCw03 ?? '' }}"
                   style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                   placeholder="-">
        </td>
        <td style="width:45pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:top; padding:1px;">
            <input type="text" 
                   name="repCw04"
                   value="{{ $addTorqueWrench->repCw04 ?? '' }}"
                   style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                   placeholder="-">
        </td>
        <td style="width:45pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:top; padding:1px;">
            <input type="text" 
                   name="repCw05"
                   value="{{ $addTorqueWrench->repCw05 ?? '' }}"
                   style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                   placeholder="-">
        </td>
    </tr>
    <tr style="height:14pt">
        <td style="width:90pt; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; vertical-align:top; padding:1px;">
            <input type="text" 
                   name="repCw06"
                   value="{{ $addTorqueWrench->repCw06 ?? '' }}"
                   style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                   placeholder="-">
        </td>
        <td style="width:45pt; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:top; padding:1px;">
            <input type="text"  
                   name="repCw07"
                   value="{{ $addTorqueWrench->repCw07 ?? '' }}"
                   style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                   placeholder="-">
        </td>
        <td style="width:45pt; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:top; padding:1px;">
            <input type="text" 
                   name="repCw08"
                   value="{{ $addTorqueWrench->repCw08 ?? '' }}"
                   style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                   placeholder="-">
        </td>
        <td style="width:45pt; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:top; padding:1px;">
            <input type="text" 
                   name="repCw09"
                   value="{{ $addTorqueWrench->repCw09 ?? '' }}"
                   style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                   placeholder="-">
        </td>
        <td style="width:45pt; border-top-style:solid; border-top-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:top; padding:1px;">
            <input type="text" 
                   name="repCw10"
                   value="{{ $addTorqueWrench->repCw10 ?? '' }}"
                   style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                   placeholder="-">
        </td>
    </tr>
</table>

<!-- Repeatability Counter Clockwise - EDIT MODE -->
<p class="BodyText" style="margin-top:5pt; margin-left:2pt">
    <span style="font-size:9.5pt;">Repeatability Counter Clockwise</span>
</p>
<table cellspacing="0" cellpadding="0" class="TableNormal" style="margin-left:0.6pt; border:1pt solid #000000; -aw-border-insideh:1pt single #000000; -aw-border-insidev:1pt single #000000; border-collapse:collapse; width: 100%; max-width: 450px;">
    <tr style="height:14pt">
        <td style="width:90pt; border-right-style:solid; border-right-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:top; padding:1px;">
            <input type="text" 
                   name="repCcw01"
                   value="{{ $addTorqueWrench->repCcw01 ?? '' }}"
                   style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                   placeholder="-">
        </td>
        <td style="width:45pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:top; padding:1px;">
            <input type="text" 
                   name="repCcw02"
                   value="{{ $addTorqueWrench->repCcw02 ?? '' }}"
                   style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                   placeholder="-">
        </td>
        <td style="width:45pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:top; padding:1px;">
            <input type="text" 
                   name="repCcw03"
                   value="{{ $addTorqueWrench->repCcw03 ?? '' }}"
                   style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                   placeholder="-">
        </td>
        <td style="width:45pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:top; padding:1px;">
            <input type="text" 
                   name="repCcw04"
                   value="{{ $addTorqueWrench->repCcw04 ?? '' }}"
                   style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                   placeholder="-">
        </td>
        <td style="width:45pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:top; padding:1px;">
            <input type="text"  
                   name="repCcw05"
                   value="{{ $addTorqueWrench->repCcw05 ?? '' }}"
                   style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                   placeholder="-">
        </td>
    </tr>
    <tr style="height:14pt">
        <td style="width:90pt; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; vertical-align:top; padding:1px;">
            <input type="text" 
                   name="repCcw06"
                   value="{{ $addTorqueWrench->repCcw06 ?? '' }}"
                   style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                   placeholder="-">
        </td>
        <td style="width:45pt; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:top; padding:1px;">
            <input type="text" 
                   name="repCcw07"
                   value="{{ $addTorqueWrench->repCcw07 ?? '' }}"
                   style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                   placeholder="-">
        </td>
        <td style="width:45pt; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:top; padding:1px;">
            <input type="text" 
                   name="repCcw08"
                   value="{{ $addTorqueWrench->repCcw08 ?? '' }}"
                   style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                   placeholder="-">
        </td>
        <td style="width:45pt; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:top; padding:1px;">
            <input type="text" 
                   name="repCcw09"
                   value="{{ $addTorqueWrench->repCcw09 ?? '' }}"
                   style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                   placeholder="-">
        </td>
        <td style="width:45pt; border-top-style:solid; border-top-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:top; padding:1px;">
            <input type="text" 
                   name="repCcw10"
                   value="{{ $addTorqueWrench->repCcw10 ?? '' }}"
                   style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                   placeholder="-">
        </td>
    </tr>
</table>


<div style="height: 30px;"></div>
                 <!-- Footer Section -->
                 <table class="kalibrasi-main-table" style="width: 100%; border-collapse: collapse;">
    <!-- HEADER FOOTER -->
    <tr>
        <td colspan="6" style="text-align: center; border: 1px solid #000; border-bottom: none; padding: 10px 0;">
            <span style="font-weight: bold; font-size: 18px; color: #000000;">Isilah lembar data kalibrasi dengan lengkap dan jelas!</span>
        </td>
    </tr>
<!-- ALAT STANDAR + CHECKBOX -->
<tr style="height: 40px;">
    <td rowspan="3" style="width: 20%; border: 1px solid #000; vertical-align: middle; text-align: center; font-weight: bold; font-size: 10pt; color: #000000; background-color: #f8f9fa;">
        Alat<br>Standar
    </td>

    <!-- Alat 1 -->
   <td style="width: 5%; border: 1px solid #000; text-align: center; vertical-align: middle;">
    @php
        $standard = old(
            'standard',
            $calibration->headTorqueWrench->standard ?? ''
        );

        $checked = str_contains(
            strtolower($standard),
            strtolower('Digital torque tester 10 N.m')
        );
    @endphp

    <input type="checkbox"
           name="alat_standar[]"
           value="Digital torque tester 10 N.m"
           {{ $checked ? 'checked' : '' }}
           style="width:16px; height:16px;">
</td>

    <td colspan="2" style="border: 1px solid #000; padding-left: 12px; font-size: 9pt; vertical-align: middle; color: #000000;">
        Digital torque tester 10 N.m
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
        $standard = old(
            'standard',
            $calibration->headTorqueWrench->standard ?? ''
        );

        $checked = str_contains(
            strtolower($standard),
            strtolower('Digital torque wrench tester 100 N.m')
        );
    @endphp

    <input type="checkbox"
           name="alat_standar[]"
           value="Digital torque wrench tester 100 N.m"
           {{ $checked ? 'checked' : '' }}
           style="width:16px; height:16px;">
</td>

    <td colspan="2" style="border: 1px solid #000; padding-left: 12px; font-size: 9pt; vertical-align: middle; color: #000000;">
        Digital torque wrench tester 100 N.m
    </td>
</tr>

<!-- Alat 3 -->
<tr style="height: 40px;">
   <td style="border: 1px solid #000; text-align: center; vertical-align: middle;">
    @php
        $standard = old(
            'standard',
            $calibration->headTorqueWrench->standard ?? ''
        );

        $checked = str_contains(
            strtolower($standard),
            strtolower('Digital torque wrench tester 1000 N.m')
        );
    @endphp

    <input type="checkbox"
           name="alat_standar[]"
           value="Digital torque wrench tester 1000 N.m"
           {{ $checked ? 'checked' : '' }}
           style="width:16px; height:16px;">
</td>

    <td colspan="2" style="border: 1px solid #000; padding-left: 12px; font-size: 9pt; vertical-align: middle; color: #000000;">
        Digital torque wrench tester 1000 N.m
    </td>
</tr>

<!-- METODE KALIBRASI + TTD & NAMA -->
<tr style="height: 40px;">
    <td rowspan="2" style="width: 20%; border: 1px solid #000; text-align: center; vertical-align: middle; font-size: 9pt; color: #000000; background-color: #f8f9fa; padding: 10px;">
        <strong>Metode Kalibrasi</strong>
    </td>
    <td colspan="3" rowspan="2" style="border: 1px solid #000; padding: 10px; font-size: 9pt; vertical-align: middle; color: #000000; line-height: 1.4;">
        @if(isset($calibration) && $calibration->headTorqueWrench)
            {{ $calibration->headTorqueWrench->calibrationMethod ?? 'PAS-IK1102-13 (JIS B 4652:2008)' }}
        @else
            PAS-IK1102-13 (JIS B 4652:2008)
        @endif
    </td>
    
    <!-- Nama Dikalibrasi Oleh -->
    <td style="width: 20%; border: 1px solid #000; padding: 5px; font-size: 9pt; vertical-align: middle; color: #000000;">
    <div style="display:flex; align-items:center; gap:4px;">
        <span>Nama :</span>
        <input type="text"
               name="calibratedBy"
               value="{{ old('calibratedBy', $calibration->calibratedBy ?? '') }}"
               style="flex:1; border:none; border-bottom:1px solid #000; font-size:9pt; background:transparent;">
    </div>
</td>

    
    <!-- Nama Diperiksa Oleh -->
   <td style="width: 20%; border: 1px solid #000; padding: 5px; font-size: 9pt; vertical-align: middle; color: #000000;">
    <div style="display:flex; align-items:center; gap:4px;">
        <span>Nama :</span>
        <input type="text"
               name="verifiedBy"
               value="{{ old('verifiedBy', $calibration->verifiedBy ?? '') }}"
               style="flex:1; border:none; border-bottom:1px solid #000; font-size:9pt; background:transparent;" readonly>
    </div>
</td>

</tr>

<!-- TTD -->
<tr style="height: 40px;">
    <!-- Kolom kosong untuk metode kalibrasi -->
    <td style="width: 20%; border: 1px solid #000; padding: 10px; font-size: 9pt; vertical-align: middle; color: #000000; text-align: left;">
        <strong>TTD :</strong>
    </td>
    <td style="width: 20%; border: 1px solid #000; padding: 10px; font-size: 9pt; vertical-align: middle; color: #000000; text-align: left;">
        <strong>TTD :</strong>
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
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
var tempFormDataStore = window.tempFormDataStore;
var isRestoring = window.isRestoring;
var tabSubmitStatus = window.tabSubmitStatus;
var currentActiveTabId = '1';

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