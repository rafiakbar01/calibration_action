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
                        <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK55</p>
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
                        <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">PRESSURE TRANSMITTER / DIFF PRESSURE TRANSMITTER</p>
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
                        <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;">{{ $calibration->headPressureTransmitter->certificate_id ?? 'N/A' }}</p>
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
                <td class="bg-light fw-bold">Suhu (&deg;C)</td>
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
        <table cellspacing="0" cellpadding="0" class="TableNormal" style="width:100%; border:1pt solid #000000; -aw-border-insideh:1pt single #000000; -aw-border-insidev:1pt single #000000; border-collapse:collapse">
    <tr style="height:12.05pt">
        <td rowspan="2" style="width:15%; border-right-style:solid; border-right-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:middle; text-align:center">
            <p class="TableParagraph" style="margin:0; padding:0; font-size:9pt">
                <span style="font-family:Arial; font-weight:bold">Set Point</span>
            </p>
        </td>
        <td style="width:21%; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:middle; text-align:center">
            <p class="TableParagraph" style="margin:0; padding:0; font-size:9pt">
                <span style="font-family:Arial; font-weight:bold">Pembacaan Pressure</span>
            </p>
        </td>
        <td style="width:21%; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:middle; text-align:center">
            <p class="TableParagraph" style="margin:0; padding:0; font-size:9pt">
                <span style="font-family:Arial; font-weight:bold">Signal Output</span>
            </p>
        </td>
        <td style="width:21%; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:middle; text-align:center">
            <p class="TableParagraph" style="margin:0; padding:0; font-size:9pt">
                <span style="font-family:Arial; font-weight:bold">Pembacaan Pressure</span>
            </p>
        </td>
        <td style="width:22%; border-left-style:solid; border-left-width:1pt; vertical-align:middle; text-align:center">
            <p class="TableParagraph" style="margin:0; padding:0; font-size:9pt">
                <span style="font-family:Arial; font-weight:bold">Signal Output</span>
            </p>
        </td>
    </tr>
      @php
        // Mengambil data details langsung dari calibration
        $head = $calibration->headPressureTransmitter ?? collect();
    @endphp
    <tr style="height:13pt">
        <td style="width:21%; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:middle; text-align:center">
            <p class="TableParagraph" style="margin:0; padding:0; font-size:9pt">
                <span style="font-family:Arial; font-weight:bold">Naik</span>
            </p>
        </td>
        <td style="width:21%; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:middle; text-align:center">
            <p class="TableParagraph" style="margin:0; padding:0; font-size:9pt">
                <span style="font-family:Arial; font-weight:bold">Naik</span>
            </p>
        </td>
        <td style="width:21%; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:middle; text-align:center">
            <p class="TableParagraph" style="margin:0; padding:0; font-size:9pt">
                <span style="font-family:Arial; font-weight:bold">Turun</span>
            </p>
        </td>
        <td style="width:22%; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:middle; text-align:center">
            <p class="TableParagraph" style="margin:0; padding:0; font-size:9pt">
                <span style="font-family:Arial; font-weight:bold">Turun</span>
            </p>
        </td>
    </tr>
    <tr style="height:12.55pt">
        <td style="width:15%; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:middle; text-align:center">
            <p class="TableParagraph" style="margin:0; padding:2px 0; font-size:9pt">
                <span style="font-family:Arial; font-weight:bold">(</span>
               <input type="text"
       name="satuan_set_point"
       value="{{ $head->satuan_set_point ?? '' }}"
       style="font-family:Arial;
              font-size:9pt;
              padding:0 2px;
              border:none;
              background:transparent;
              outline:none;
              width:30px;
              text-align:center;">
                <span style="font-family:Arial; font-weight:bold">)</span>
            </p>
        </td>
       <td style="width:21%; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center">
    <p class="TableParagraph" style="margin:0; padding:2px 0; font-size:9pt">
        <span style="font-family:Arial; font-weight:bold">(</span>
        <input type="text" 
               name="satuan_p_naik"
               value="{{ $head->satuan_p_naik ?? '' }}"
               style="font-family:Arial;
                      font-size:9pt;
                      padding:0 2px;
                      border:none;
                      background:transparent;
                      outline:none;
                      width:30px;
                      text-align:center;">
        <span style="font-family:Arial; font-weight:bold">)</span>
    </p>
</td>

<td style="width:21%; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center">
    <p class="TableParagraph" style="margin:0; padding:2px 0; font-size:9pt">
        <span style="font-family:Arial; font-weight:bold">(</span>
        <input type="text" 
               name="satuan_so_naik"
               value="{{ $head->satuan_so_naik ?? '' }}"
               style="font-family:Arial;
                      font-size:9pt;
                      padding:0 2px;
                      border:none;
                      background:transparent;
                      outline:none;
                      width:30px;
                      text-align:center;">
        <span style="font-family:Arial; font-weight:bold">)</span>
    </p>
</td>

<td style="width:21%; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center">
    <p class="TableParagraph" style="margin:0; padding:2px 0; font-size:9pt">
        <span style="font-family:Arial; font-weight:bold">(</span>
        <input type="text" 
               name="satuan_p_turun"
               value="{{ $head->satuan_p_turun ?? '' }}"
               style="font-family:Arial;
                      font-size:9pt;
                      padding:0 2px;
                      border:none;
                      background:transparent;
                      outline:none;
                      width:30px;
                      text-align:center;">
        <span style="font-family:Arial; font-weight:bold">)</span>
    </p>
</td>

<td style="width:22%; border-top-style:solid; border-top-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:middle; text-align:center">
    <p class="TableParagraph" style="margin:0; padding:2px 0; font-size:9pt">
        <span style="font-family:Arial; font-weight:bold">(</span>
        <input type="text" 
               name="satuan_so_turun"
               value="{{ $head->satuan_so_turun ?? '' }}"
               style="font-family:Arial;
                      font-size:9pt;
                      padding:0 2px;
                      border:none;
                      background:transparent;
                      outline:none;
                      width:30px;
                      text-align:center;">
        <span style="font-family:Arial; font-weight:bold">)</span>
    </p>
</td>
    </tr>
    
    @php
        // Mengambil data details langsung dari calibration
        $details = $calibration->detailPressureTransmitters ?? collect();
    @endphp
    
    @for($i = 1; $i <= 11; $i++)
        @php
            // Mengambil data untuk baris ke-i (jika ada, index mulai dari 0)
            $detail = $details->get($i-1) ?? null;
        @endphp
        <tr style="height:17.2pt">
           <td style="width:15%; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:middle; text-align:center">
    <input type="text"
           name="setPoint[]"
           value="{{ $detail->setPoint ?? '' }}"
           style="font-family:Arial;
                  font-size:9pt;
                  display:block;
                  padding:3px 0;
                  border:none;
                  background:transparent;
                  outline:none;
                  width:100%;
                  text-align:center;">
</td>

<td style="width:21%; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center">
    <input type="text"
           name="readP_UP[]"
           value="{{ $detail->readP_UP ?? '' }}"
           style="font-family:Arial;
                  font-size:9pt;
                  display:block;
                  padding:3px 0;
                  border:none;
                  background:transparent;
                  outline:none;
                  width:100%;
                  text-align:center;">
</td>

<td style="width:21%; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center">
    <input type="text"
           name="readS_UP[]"
           value="{{ $detail->readS_UP ?? '' }}"
           style="font-family:Arial;
                  font-size:9pt;
                  display:block;
                  padding:3px 0;
                  border:none;
                  background:transparent;
                  outline:none;
                  width:100%;
                  text-align:center;">
</td>

<td style="width:21%; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center">
    <input type="text"
           name="readP_DOWN[]"
           value="{{ $detail->readP_DOWN ?? '' }}"
           style="font-family:Arial;
                  font-size:9pt;
                  display:block;
                  padding:3px 0;
                  border:none;
                  background:transparent;
                  outline:none;
                  width:100%;
                  text-align:center;">
</td>

<td style="width:22%; border-top-style:solid; border-top-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:middle; text-align:center">
    <input type="text"
           name="readS_DOWN[]"
           value="{{ $detail->readS_DOWN ?? '' }}"
           style="font-family:Arial;
                  font-size:9pt;
                  display:block;
                  padding:3px 0;
                  border:none;
                  background:transparent;
                  outline:none;
                  width:100%;
                  text-align:center;">
</td>
        </tr>
    @endfor
    
    <tr style="height:17.2pt">
        <td style="width:15%; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; vertical-align:middle; text-align:center">
            <p class="TableParagraph" style="margin:0; padding:0; font-size:9pt">
                <span style="font-family:'Times New Roman'">&#xa0;</span>
            </p>
        </td>
        <td style="width:21%; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:middle; text-align:center">
            <p class="TableParagraph" style="margin:0; padding:0; font-size:9pt">
                <span style="font-family:'Times New Roman'">&#xa0;</span>
            </p>
        </td>
        <td style="width:21%; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:middle; text-align:center">
            <p class="TableParagraph" style="margin:0; padding:0; font-size:9pt">
                <span style="font-family:'Times New Roman'">&#xa0;</span>
            </p>
        </td>
        <td style="width:21%; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:middle; text-align:center">
            <p class="TableParagraph" style="margin:0; padding:0; font-size:9pt">
                <span style="font-family:'Times New Roman'">&#xa0;</span>
            </p>
        </td>
        <td style="width:22%; border-top-style:solid; border-top-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:middle; text-align:center">
            <p class="TableParagraph" style="margin:0; padding:0; font-size:9pt">
                <span style="font-family:'Times New Roman'">&#xa0;</span>
            </p>
        </td>
    </tr>
</table>
&nbsp;  &nbsp;

@php
    // Ambil data additional dari calibration
    $addData = $calibration->addPressureTransmitter ?? null;
@endphp

@if($addData)
<!-- Bagian Repeatability Pressure -->
<p class="BodyText" style="margin-left:14.15pt; margin-bottom:1.35pt">
    <span>Repeatability</span>
    <span style="letter-spacing:-0.15pt"></span>
    <span>:</span>
    <span style="font-family:Arial; font-size:9pt; margin:0 5px"><input type="text"
       name="repeatibility_P"
       value="{{ $addData->repeatibility_P ?? '' }}"
       style="font-family:Arial;
              font-size:9pt;
              padding:0 2px;
              border:none;
              background:transparent;
              outline:none;
              width:50px;
              text-align:center;"></span>
    <span style="letter-spacing:-0.05pt"></span>
    <span style="letter-spacing:-0.5pt">(</span>
    <span style="font-family:Arial; font-size:9pt; margin:0 2px"><input type="text"
       name="satuan_P"
       value="{{ $addData->satuan_P ?? '' }}"
       style="font-family:Arial;
              font-size:9pt;
              padding:0 2px;
              border:none;
              background:transparent;
              outline:none;
              width:30px;
              text-align:center;"></span>
    <span style="letter-spacing:-0.5pt">)</span>
</p>

<table cellspacing="0" cellpadding="0" class="TableNormal" style="margin-left:12.5pt; border:1pt solid #000000; -aw-border-insideh:1pt single #000000; -aw-border-insidev:1pt single #000000; border-collapse:collapse">
    @for($row = 1; $row <= 2; $row++)
    <tr style="height:{{ $row == 1 ? '12.55pt' : '14.7pt' }}">
        @for($col = 1; $col <= 5; $col++)
        @php
            $index = ($row - 1) * 5 + $col;
            $fieldName = 'repP' . sprintf('%02d', $index);
            $value = $addData->{$fieldName} ?? '';
        @endphp
        <td style="width:{{ 
            $col == 1 ? '52.05pt' : 
            ($col == 2 ? '53.7pt' : 
            ($col == 3 ? '61.05pt' : 
            ($col == 4 ? '55.85pt' : '55.85pt'))) 
        }}; 
        @php
            // Border styling
            if($row == 1) {
                echo 'border-right-style:solid; border-right-width:1pt; ';
                if($col > 1) echo 'border-left-style:solid; border-left-width:1pt; ';
                echo 'border-bottom-style:solid; border-bottom-width:1pt; ';
            } else {
                echo 'border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; ';
                if($col > 1) echo 'border-left-style:solid; border-left-width:1pt; ';
            }
        @endphp
        vertical-align:middle; text-align:center">
            <span style="font-family:Arial; font-size:9pt"><input type="text"
       name="repP_value[]"
       value="{{ $value ?? '' }}"
       style="font-family:Arial;
              font-size:9pt;
              padding:0 2px;
              border:none;
              background:transparent;
              outline:none;
              width:50px;
              text-align:center;"></span>
        </td>
        @endfor
    </tr>
    @endfor
</table>

<p class="BodyText" style="margin-top:0.05pt">
    <span style="-aw-import:ignore">&#xa0;</span>
</p>

<!-- Bagian Repeatability Signal Output -->
<p class="BodyText" style="margin-left:14.15pt; margin-bottom:1.35pt">
    <span>Repeatability</span>
    <span style="letter-spacing:-0.15pt"></span>
    <span>:</span>
    <span style="font-family:Arial; font-size:9pt; margin:0 5px"><input type="text"
       name="repeatibility_SO"
       value="{{ $addData->repeatibility_SO ?? '' }}"
       style="font-family:Arial;
              font-size:9pt;
              padding:0 2px;
              border:none;
              background:transparent;
              outline:none;
              width:50px;
              text-align:center;"></span>
    <span style="letter-spacing:-0.05pt"></span>
    <span style="letter-spacing:-0.5pt">(</span>
    <span style="font-family:Arial; font-size:9pt; margin:0 2px"><input type="text"
       name="satuan_SO"
       value="{{ $addData->satuan_SO ?? '' }}"
       style="font-family:Arial;
              font-size:9pt;
              padding:0 2px;
              border:none;
              background:transparent;
              outline:none;
              width:30px;
              text-align:center;"></span>
    <span style="letter-spacing:-0.5pt">)</span>
</p>

<table cellspacing="0" cellpadding="0" class="TableNormal" style="margin-left:12.5pt; border:1pt solid #000000; -aw-border-insideh:1pt single #000000; -aw-border-insidev:1pt single #000000; border-collapse:collapse">
    @for($row = 1; $row <= 2; $row++)
    <tr style="height:{{ $row == 1 ? '12.55pt' : '14.7pt' }}">
        @for($col = 1; $col <= 5; $col++)
        @php
            $index = ($row - 1) * 5 + $col;
            $fieldName = 'repSO' . sprintf('%02d', $index);
            $value = $addData->{$fieldName} ?? '';
        @endphp
        <td style="width:{{ 
            $col == 1 ? '52.05pt' : 
            ($col == 2 ? '53.7pt' : 
            ($col == 3 ? '61.05pt' : 
            ($col == 4 ? '55.85pt' : '55.85pt'))) 
        }}; 
        @php
            // Border styling
            if($row == 1) {
                echo 'border-right-style:solid; border-right-width:1pt; ';
                if($col > 1) echo 'border-left-style:solid; border-left-width:1pt; ';
                echo 'border-bottom-style:solid; border-bottom-width:1pt; ';
            } else {
                echo 'border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; ';
                if($col > 1) echo 'border-left-style:solid; border-left-width:1pt; ';
            }
        @endphp
        vertical-align:middle; text-align:center">
            <span style="font-family:Arial; font-size:9pt"><input type="text"
       name="repSO_value[]"
       value="{{ $value ?? '' }}"
       style="font-family:Arial;
              font-size:9pt;
              padding:0 2px;
              border:none;
              background:transparent;
              outline:none;
              width:50px;
              text-align:center;"></span>
        </td>
        @endfor
    </tr>
    @endfor
</table>
@endif


&nbsp;  &nbsp;
                 <!-- Footer Section -->
        <table cellspacing="0" cellpadding="0" class="TableNormal" style="width:100%; border:1pt solid #000000; -aw-border-insideh:1pt single #000000; -aw-border-insidev:1pt single #000000; border-collapse:collapse">
    <tr style="height:16.6pt">
        <td colspan="6" style="border-bottom-style:solid; border-bottom-width:1pt; vertical-align:middle; text-align:center">
            <p class="TableParagraph" style="margin:0; padding:4px 0; font-size:12.5pt">
                <span style="font-family:Arial; font-weight:bold">Isilah lembar data kalibrasi dengan lengkap dan jelas!</span>
            </p>
        </td>
    </tr>
    <tr style="height:13.85pt">
        <td rowspan="4" style="width:20%; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:middle; text-align:center">
            <p class="TableParagraph" style="margin:0; padding:8px 0; font-size:9pt; font-weight:bold">
                Alat Standar
            </p>
        </td>
        <td style="width:3%; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center; padding:4px 0">
            @php
                $alatStandar = $head->standard ?? '';
                $alatStandarArray = !empty($alatStandar) ? explode(', ', $alatStandar) : [];
            @endphp
           <input type="checkbox" 
       name="const_P001"
       value="1"
       style="transform: scale(1.2); margin:0;" 
       {{ in_array('Const P.001 (0 ~ 700 bar ; Hydraulic)', $alatStandarArray) ? 'checked' : '' }}>
        </td>
        <td style="width:32%; border-style:solid; border-width:1pt; vertical-align:middle; padding:4px 8px">
            <p class="TableParagraph" style="margin:0; font-size:9pt">
                <span>Const P.001 (0 ~ 700 bar ; Hydraulic)</span>
            </p>
        </td>
        <td style="width:20%; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center; padding:4px 0">
            <p class="TableParagraph" style="margin:0; font-size:9pt; font-weight:bold">
                Dikalibrasi oleh
            </p>
        </td>
        <td style="width:20%; border-top-style:solid; border-top-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:middle; text-align:center; padding:4px 0">
            <p class="TableParagraph" style="margin:0; font-size:9pt; font-weight:bold">
                Diperiksa oleh
            </p>
        </td>
    </tr>
    <tr style="height:13.85pt">
        <td style="width:3%; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center; padding:4px 0">
          <input type="checkbox" 
       name="adittel_P002"
       value="1"
       style="transform: scale(1.2); margin:0;"
       {{ in_array('Adittel P.002 (-125 ~ 1000 Pa ; Pneumatic)', $alatStandarArray) ? 'checked' : '' }}>
        </td>
        <td style="width:32%; border-style:solid; border-width:1pt; vertical-align:middle; padding:4px 8px">
            <p class="TableParagraph" style="margin:0; font-size:9pt">
                <span>Adittel P.002 (-125 ~ 1000 Pa ; Pneumatic)</span>
            </p>
        </td>
        <td rowspan="3" style="width:20%; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center; padding:8px 4px">
            <span style="font-family:Arial; font-size:9pt">{{ $calibration->calibrated_by ?? '' }}</span>
        </td>
        <td rowspan="3" style="width:20%; border-top-style:solid; border-top-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:middle; text-align:center; padding:8px 4px">
            <span style="font-family:Arial; font-size:9pt">{{ $calibration->verified_by ?? '' }}</span>
        </td>
    </tr>
    <tr style="height:13.85pt">
        <td style="width:3%; border-style:solid; border-width:1pt 1.5pt 1pt 1pt; vertical-align:middle; text-align:center; padding:4px 0">
           <input type="checkbox" 
       name="adittel_P003"
       value="1"
       style="transform: scale(1.2); margin:0;"
       {{ in_array('Adittel P.003 (-1 ~ 20 bar ; Pneumatic)', $alatStandarArray) ? 'checked' : '' }}>
        </td>
        <td style="width:32%; border-style:solid; border-width:1pt 1pt 1pt 1.5pt; vertical-align:middle; padding:4px 8px">
            <p class="TableParagraph" style="margin:0; font-size:9pt">
                <span>Adittel P.003 (-1 ~ 20 bar ; Pneumatic)</span>
            </p>
        </td>
    </tr>
    <tr style="height:13.85pt">
        <td style="width:3%; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center; padding:4px 0">
          <input type="checkbox" 
       name="adittel_P004"
       value="1"
       style="transform: scale(1.2); margin:0;"
       {{ in_array('Adittel P.004 (0 ~ 700 bar ; Hydraulic)', $alatStandarArray) ? 'checked' : '' }}>
        </td>
        <td style="width:32%; border-style:solid; border-width:1pt; vertical-align:middle; padding:4px 8px">
            <p class="TableParagraph" style="margin:0; font-size:9pt">
                <span>Adittel P.004 (0 ~ 700 bar ; Hydraulic)</span>
            </p>
        </td>
    </tr>
    <tr style="height:13.9pt">
        <td style="width:20%; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:middle; text-align:center; padding:4px 0">
            <p class="TableParagraph" style="margin:0; font-size:9pt; font-weight:bold">
                Metode Kalibrasi
            </p>
        </td>
        <td colspan="2" style="width:35%; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center; padding:4px 0">
            <span style="font-family:Arial; font-size:9pt">{{ $head->calibrationMethod ?? 'PAS-IK1102-55' }}</span>
        </td>
        <td style="width:20%; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:middle; text-align:center; padding:4px 0">
            <p class="TableParagraph" style="margin:0; font-size:9pt; font-weight:bold">
                TTD:
            </p>
        </td>
        <td style="width:20%; border-top-style:solid; border-top-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:middle; text-align:center; padding:4px 0">
            <p class="TableParagraph" style="margin:0; font-size:9pt; font-weight:bold">
                TTD:
            </p>
        </td>
    </tr>
    <tr style="height:13.85pt">
        <td style="width:20%; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; vertical-align:middle; text-align:center; padding:4px 0">
            <p class="TableParagraph" style="margin:0; font-size:9pt; font-weight:bold">
                Tertelusur
            </p>
        </td>
       <td colspan="2" style="width:35%; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:middle; text-align:center; padding:4px 0">
    <input type="text"
           name="tertelusur"
           value="{{ $head->tertelusur ?? '' }}"
           style="font-family:Arial;
                  font-size:9pt;
                  border:none;
                  background:transparent;
                  outline:none;
                  width:100%;
                  text-align:center;
                  padding:0;">
</td>

<td style="width:20%; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:middle; text-align:center; padding:4px 0">
    <input type="text"
           name="calibratedBy"
           value="{{ $calibration->calibratedBy ?? '' }}"
           style="font-family:Arial;
                  font-size:9pt;
                  border:none;
                  background:transparent;
                  outline:none;
                  width:100%;
                  text-align:center;
                  padding:0;">
</td>

<td style="width:20%; border-left-style:solid; border-left-width:1pt; vertical-align:middle; text-align:center; padding:4px 0">
    <input type="text"
           name="verifiedBy"
           value="{{ $calibration->verifiedBy ?? '' }}"
           style="font-family:Arial;
                  font-size:9pt;
                  border:none;
                  background:transparent;
                  outline:none;
                  width:100%;
                  text-align:center;
                  padding:0;">
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