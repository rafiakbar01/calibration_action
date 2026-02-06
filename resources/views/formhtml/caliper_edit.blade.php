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
                        <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK03</p>
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
                        <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">CALIPER</p>
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
                        <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;">{{ $calibration->headCaliper->certificate_id ?? 'N/A' }}</p>
                    </td>
                </tr>
            </table>

           <table class="kalibrasi-main-table">

    <!-- Nama Alat -->
    <tr>
        <td style="width:20%;"><p style="margin:0;color:#000;">Nama Alat</p></td>
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

    <!-- Nama Pemilik -->
    <tr>
        <td><p style="margin:0;color:#000;">Nama Pemilik</p></td>
        <td colspan="3">
            <input type="text" name="pemilikAlat" class="kalibrasi-input"
                   value="{{ old('pemilikAlat', $calibration->pemilikAlat) }}">
        </td>
    </tr>

    <!-- Tanggal -->
   <tr>
        <td>Tanggal Alat Masuk</td>
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

    <!-- Tempat Kalibrasi -->
    <tr>
        <td><p style="margin:0;color:#000;">Tempat Kalibrasi</p></td>
        <td colspan="3">
            <div class="d-flex">
                <div class="form-check me-5">
                    <input class="form-check-input" type="radio" name="tempatKalibrasi" value="lab"
                        {{ old('tempatKalibrasi', $calibration->tempatKalibrasi) == 'lab' ? 'checked' : '' }}>
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

    <!-- KIRI -->
    <div class="col-md-6 mb-4">
        <div class="kalibrasi-section-header" style="color:#000000;">
            Fungsi Komponen Lainnya
        </div>

        <!-- Radio -->
        <div class="d-flex justify-content-center align-items-center mb-4" style="gap:60px;">
            <div class="text-center">
                <span class="fw-bold d-block mb-2" style="color:#000; font-size:14px;">Ok</span>
                <input type="radio" name="kondisiAlat" value="ok"
                    class="form-check-input"
                    style="width:18px;height:18px;"
                    {{ old('kondisiAlat',$calibration->kondisiAlat)=='ok'?'checked':'' }}>
            </div>

            <div class="text-center">
                <span class="fw-bold d-block mb-2" style="color:#000; font-size:14px;">Rusak</span>
                <input type="radio" name="kondisiAlat" value="rusak"
                    class="form-check-input"
                    style="width:18px;height:18px;"
                    {{ old('kondisiAlat',$calibration->kondisiAlat)=='rusak'?'checked':'' }}>
            </div>
        </div>

        <!-- Keterangan -->
        <div class="d-flex align-items-center">
            <span class="fw-bold me-3" style="min-width:100px;">Keterangan :</span>
            <input type="text" name="keterangan"
                class="kalibrasi-input"
                value="{{ old('keterangan',$calibration->keterangan) }}"
                style="flex:1;border:none;border-bottom:2px solid #000;background:transparent;">
        </div>
    </div>

    <!-- KANAN -->
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
                <td><input type="text" name="RT_condition1" class="kondisi-input" value="{{ old('RT_condition1',$calibration->RT_condition1) }}"></td>
                <td><input type="text" name="RT_condition2" class="kondisi-input" value="{{ old('RT_condition2',$calibration->RT_condition2) }}"></td>
                <td><input type="text" name="RT_condition3" class="kondisi-input" value="{{ old('RT_condition3',$calibration->RT_condition3) }}"></td>
            </tr>
            <tr>
                <td class="bg-light fw-bold">RH (%)</td>
                <td><input type="text" name="RH_condition1" class="kondisi-input" value="{{ old('RH_condition1',$calibration->RH_condition1) }}"></td>
                <td><input type="text" name="RH_condition2" class="kondisi-input" value="{{ old('RH_condition2',$calibration->RH_condition2) }}"></td>
                <td><input type="text" name="RH_condition3" class="kondisi-input" value="{{ old('RH_condition3',$calibration->RH_condition3) }}"></td>
            </tr>
        </table>
    </div>

</div>


            <!-- Data Kalibrasi Section -->
            <div class="data-kalibrasi-header" style="color: #000000;">DATA KALIBRASI</div>
            
        <!-- BAGIAN 1: PEMERIKSAAN KESEJAJARAN MUKA UKUR EKSTERNAL -->
<div class="mb-3">
    <ol type="1" style="margin:0pt; padding-left:0pt">
        <li class="ListParagraph" style="text-indent:0pt; font-size:11pt; font-weight:bold">
            <span>Pemeriksaan Kesejajaran Muka Ukur Eksternal</span>
        </li>
    </ol>
   <table cellspacing="0" cellpadding="0" class="TableNormal"
       style="margin-left:15.48pt; border:0.75pt solid #000000; border-collapse:collapse; width:100%">
    <tr style="height:10.05pt">
        <td style="width:25%; border:0.75pt solid #000000; vertical-align:top; background-color:#bebebe">
            <p style="text-align:center; line-height:9.05pt; padding:4pt">
                <span style="font-family:Arial; font-size:9.5pt; font-weight:bold">Titik Ukur</span>
            </p>
        </td>
        <td style="width:25%; border:0.75pt solid #000000; vertical-align:top; background-color:#bebebe">
            <p style="text-align:center; line-height:9.05pt; padding:4pt">
                <span style="font-family:Arial; font-size:9.5pt; font-weight:bold">Atas / Pangkal</span>
            </p>
        </td>
        <td style="width:25%; border:0.75pt solid #000000; vertical-align:top; background-color:#bebebe">
            <p style="text-align:center; line-height:9.05pt; padding:4pt">
                <span style="font-family:Arial; font-size:9.5pt; font-weight:bold">Tengah</span>
            </p>
        </td>
        <td style="width:25%; border:0.75pt solid #000000; vertical-align:top; background-color:#bebebe">
            <p style="text-align:center; line-height:9.05pt; padding:4pt">
                <span style="font-family:Arial; font-size:9.5pt; font-weight:bold">Bawah / Ujung</span>
            </p>
        </td>
    </tr>

    <tr style="height:12.65pt">
        <td style="width:25%; border:0.75pt solid #000000; vertical-align:top; padding:4pt; position:relative">
            <input type="text"
                   name="titikUkurKesajajaran"
                   value="{{ old('titikUkurKesajajaran', $calibration->addCaliper->titikUkurKesajajaran ?? '') }}"
                   style="width: calc(100% - 25px); height: 100%; border:none; text-align:center;
                          font-size:9.5pt; background:transparent; padding:2px;">
            <span style="position:absolute; right:10px; top:50%; transform:translateY(-50%);
                         font-size:9.5pt; color:#666;">mm</span>
        </td>

        <td style="width:25%; border:0.75pt solid #000000; vertical-align:top; padding:4pt">
            <input type="text"
                   name="kesejajaranAwal"
                   value="{{ old('kesejajaranAwal', $calibration->addCaliper->kesejajaranAwal ?? '') }}"
                   style="width:100%; height:100%; border:none; text-align:center;
                          font-size:9.5pt; background:transparent; padding:2px;">
        </td>

        <td style="width:25%; border:0.75pt solid #000000; vertical-align:top; padding:4pt">
            <input type="text"
                   name="kesejajaranTengah"
                   value="{{ old('kesejajaranTengah', $calibration->addCaliper->kesejajaranTengah ?? '') }}"
                   style="width:100%; height:100%; border:none; text-align:center;
                          font-size:9.5pt; background:transparent; padding:2px;">
        </td>

        <td style="width:25%; border:0.75pt solid #000000; vertical-align:top; padding:4pt">
            <input type="text"
                   name="kesejajaranAkhir"
                   value="{{ old('kesejajaranAkhir', $calibration->addCaliper->kesejajaranAkhir ?? '') }}"
                   style="width:100%; height:100%; border:none; text-align:center;
                          font-size:9.5pt; background:transparent; padding:2px;">
        </td>
    </tr>
</table>

</div>

<!-- BAGIAN 2: PENGUKURAN DALAM DENGAN UJUNG PISAU BERSILANG -->
<div class="mb-3">
    <ol start="2" type="1" style="margin:0pt; padding-left:0pt">
        <li class="ListParagraph" style="margin-top:4.85pt; text-indent:0pt; font-size:11pt; font-weight:bold">
            <span>Pengukuran Dalam Dengan Ujung Pisau Bersilang</span>
        </li>
    </ol>
    <table cellspacing="0" cellpadding="0" class="TableNormal"
       style="margin-left:15.48pt; border:0.75pt solid #000000; border-collapse:collapse; width:100%">
    <tr style="height:12pt">
        <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
            <p style="text-align:center; line-height:11pt; padding:6pt">
                <span style="font-family:Arial; font-size:10pt; font-weight:bold">Titik Ukur</span>
            </p>
        </td>
        <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
            <p style="text-align:center; line-height:11pt; padding:6pt">
                <span style="font-family:Arial; font-size:10pt; font-weight:bold">Pembacaan-1</span>
            </p>
        </td>
        <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
            <p style="text-align:center; line-height:11pt; padding:6pt">
                <span style="font-family:Arial; font-size:10pt; font-weight:bold">Pembacaan-2</span>
            </p>
        </td>
        <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
            <p style="text-align:center; line-height:11pt; padding:6pt">
                <span style="font-family:Arial; font-size:10pt; font-weight:bold">Pembacaan-3</span>
            </p>
        </td>
    </tr>

    <tr style="height:16pt">
        <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt; position:relative;">
            <input type="text"
                   name="pengukuranDalamPisauBersilang"
                   value="{{ old('pengukuranDalamPisauBersilang', $calibration->addCaliper->pengukuranDalamPisauBersilang ?? '') }}"
                   style="width:calc(100% - 25px); height:100%; border:none; text-align:center;
                          font-size:10pt; background:transparent; padding:4px;">
            <span style="position:absolute; right:10px; top:50%; transform:translateY(-50%);
                         font-size:9pt; color:#666; font-family:Arial;">mm</span>
        </td>

        <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
            <input type="text"
                   name="pembacaan1"
                   value="{{ old('pembacaan1', $calibration->addCaliper->pembacaan1 ?? '') }}"
                   style="width:100%; height:100%; border:none; text-align:center;
                          font-size:10pt; background:transparent; padding:4px;">
        </td>

        <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
            <input type="text"
                   name="pembacaan2"
                   value="{{ old('pembacaan2', $calibration->addCaliper->pembacaan2 ?? '') }}"
                   style="width:100%; height:100%; border:none; text-align:center;
                          font-size:10pt; background:transparent; padding:4px;">
        </td>

        <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
            <input type="text"
                   name="pembacaan3"
                   value="{{ old('pembacaan3', $calibration->addCaliper->pembacaan3 ?? '') }}"
                   style="width:100%; height:100%; border:none; text-align:center;
                          font-size:10pt; background:transparent; padding:4px;">
        </td>
    </tr>
</table>

</div>

<!-- BAGIAN 3: PENGUKURAN OUTSIDE -->
<!-- BAGIAN 3: PENGUKURAN OUTSIDE - EDIT MODE -->
<div class="mb-3">
    <ol start="3" type="1" style="margin:0pt; padding-left:0pt">
        <li class="ListParagraph" style="margin-top:4.85pt; text-indent:0pt; font-size:11pt; font-weight:bold">
            <span>Pengukuran Outside</span>
        </li>
    </ol>
    
    @php
    // Ambil capacity dari data yang sudah disimpan
    $capacity = $calibration->capacity ?? 300;
    $outsideValues = [];
    if ($capacity == 300) {
        $outsideValues = [0, 20, 50, 100, 150, 200, 250, 300];
    } elseif ($capacity == 450) {
        $outsideValues = [0, 50, 100, 200, 300, 350, 400, 450];
    } elseif ($capacity == 600) {
        $outsideValues = [0, 50, 100, 200, 300, 400, 500, 600];
    } elseif ($capacity == 1000) {
        $outsideValues = [0, 100, 300, 500, 700, 800, 900, 1000];
    }
    
    // Ambil semua data dari detailCalipers
    $allData = $calibration->detailCalipers ?? collect();
    
    // Ambil 8 baris pertama (untuk outside) - SAMA PERSIS DENGAN VIEW
    $outsideRows = $allData->take(8);
    @endphp
    
    <table cellspacing="0" cellpadding="0" class="TableNormal" style="margin-left:15.48pt; border:0.75pt solid #000000; border-collapse:collapse; width:100%">
        <tr style="height:12pt">
            <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Titik Ukur<br>(Unit: mm)</span>
                </p>
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Penunjukan 1</span>
                </p>
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Penunjukan 2</span>
                </p>
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Penunjukan 3</span>
                </p>
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Penunjukan 4</span>
                </p>
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Penunjukan 5</span>
                </p>
            </td>
        </tr>
        
        <!-- OUTSIDE ROWS (8 baris) - EDIT MODE -->
        @for($i = 0; $i < 8; $i++)
        @php
            // Tentukan nilai titik ukur - SAMA PERSIS DENGAN VIEW MODE
            $titikUkur = '';
            $rowData = null;
            
            if($outsideRows->count() > $i) {
                $titikUkur = $outsideRows->values()->get($i)->titikUkur ?? $outsideValues[$i] ?? '';
                $rowData = $outsideRows->values()->get($i);
            } else {
                $titikUkur = $outsideValues[$i] ?? '';
            }
            
            // Simpan ID jika ada
            $detailId = $rowData->id ?? null;
        @endphp
        <tr style="height:16pt">
            <!-- Kolom Titik Ukur -->
            <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                <div style="width:100%; height:100%; text-align:center; font-size:10pt; color:#000; padding:4px;">
                    {{ $titikUkur }}
                    <input type="hidden" name="outside[{{ $i }}][titikUkur]" value="{{ $titikUkur }}">
                    @if($detailId)
                    <input type="hidden" name="outside[{{ $i }}][id]" value="{{ $detailId }}">
                    @endif
                </div>
            </td>
            
            <!-- Kolom Penunjukan 1 -->
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                <div style="width:100%; height:100%; text-align:center;">
                    @if($outsideRows->count() > $i)
                        <input type="text" name="outside[{{ $i }}][outside01]" 
                               value="{{ $outsideRows->values()->get($i)->outside01 ?? '' }}"
                               style="width:100%; text-align:center; border:none; font-size:10pt;">
                    @else
                        <input type="text" name="outside[{{ $i }}][outside01]" 
                               value=""
                               style="width:100%; text-align:center; border:none; font-size:10pt;">
                    @endif
                </div>
            </td>
            
            <!-- Kolom Penunjukan 2 -->
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                <div style="width:100%; height:100%; text-align:center;">
                    @if($outsideRows->count() > $i)
                        <input type="text" name="outside[{{ $i }}][outside02]" 
                               value="{{ $outsideRows->values()->get($i)->outside02 ?? '' }}"
                               style="width:100%; text-align:center; border:none; font-size:10pt;">
                    @else
                        <input type="text" name="outside[{{ $i }}][outside02]" 
                               value=""
                               style="width:100%; text-align:center; border:none; font-size:10pt;">
                    @endif
                </div>
            </td>
            
            <!-- Kolom Penunjukan 3 -->
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                <div style="width:100%; height:100%; text-align:center;">
                    @if($outsideRows->count() > $i)
                        <input type="text" name="outside[{{ $i }}][outside03]" 
                               value="{{ $outsideRows->values()->get($i)->outside03 ?? '' }}"
                               style="width:100%; text-align:center; border:none; font-size:10pt;">
                    @else
                        <input type="text" name="outside[{{ $i }}][outside03]" 
                               value=""
                               style="width:100%; text-align:center; border:none; font-size:10pt;">
                    @endif
                </div>
            </td>
            
            <!-- Kolom Penunjukan 4 -->
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                <div style="width:100%; height:100%; text-align:center;">
                    @if($outsideRows->count() > $i)
                        <input type="text" name="outside[{{ $i }}][outside04]" 
                               value="{{ $outsideRows->values()->get($i)->outside04 ?? '' }}"
                               style="width:100%; text-align:center; border:none; font-size:10pt;">
                    @else
                        <input type="text" name="outside[{{ $i }}][outside04]" 
                               value=""
                               style="width:100%; text-align:center; border:none; font-size:10pt;">
                    @endif
                </div>
            </td>
            
            <!-- Kolom Penunjukan 5 -->
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                <div style="width:100%; height:100%; text-align:center;">
                    @if($outsideRows->count() > $i)
                        <input type="text" name="outside[{{ $i }}][outside05]" 
                               value="{{ $outsideRows->values()->get($i)->outside05 ?? '' }}"
                               style="width:100%; text-align:center; border:none; font-size:10pt;">
                    @else
                        <input type="text" name="outside[{{ $i }}][outside05]" 
                               value=""
                               style="width:100%; text-align:center; border:none; font-size:10pt;">
                    @endif
                </div>
            </td>
        </tr>
        @endfor
    </table>
</div>

<!-- BAGIAN 4: PENGUKURAN INSIDE -->
<div class="mb-3">
    <ol start="4" type="1" style="margin:0pt; padding-left:0pt">
        <li class="ListParagraph" style="margin-top:4.85pt; text-indent:0pt; font-size:11pt; font-weight:bold">
            <span>Pengukuran Inside</span>
        </li>
    </ol>
    
    @php
        $insideValues = [];
        if ($capacity == 300) {
            $insideValues = [20, 50, 100, 150, 200, 250, 300];
        } elseif ($capacity == 450) {
            $insideValues = [50, 100, 200, 300, 350, 400, 450];
        } elseif ($capacity == 600) {
            $insideValues = [50, 100, 200, 300, 400, 500, 600];
        } elseif ($capacity == 1000) {
            $insideValues = [100, 300, 500, 700, 800, 900, 1000];
        }
        
        // Filter data inside: ambil baris yang punya nilai inside
        $insideRows = $allData->where(function($item) {
            return !is_null($item->inside01) || !is_null($item->inside02) || 
                   !is_null($item->inside03) || !is_null($item->inside04) || 
                   !is_null($item->inside05);
        })->take(7);
    @endphp
    
    <table cellspacing="0" cellpadding="0" class="TableNormal" style="margin-left:15.48pt; border:0.75pt solid #000000; border-collapse:collapse; width:100%">
        <tr style="height:12pt">
            <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Titik Ukur<br>(Unit: mm)</span>
                </p>
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Penunjukan 1</span>
                </p>
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Penunjukan 2</span>
                </p>
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Penunjukan 3</span>
                </p>
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Penunjukan 4</span>
                </p>
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Penunjukan 5</span>
                </p>
            </td>
        </tr>
        
        <!-- INSIDE ROWS (7 baris tanpa nilai 0) -->
        @for($i = 0; $i < 7; $i++)
        <tr style="height:16pt">
            <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                <div style="width:100%; height:100%; text-align:center; font-size:10pt; color:#000; padding:4px;">
                    @if($insideRows->count() > $i)
                        {{ $insideRows->values()->get($i)->titikUkur ?? $insideValues[$i] ?? 'N/A' }}
                    @else
                        {{ $insideValues[$i] ?? 'N/A' }}
                    @endif
                </div>
            </td>
           <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
    <div style="width:100%; height:100%; text-align:center;">
        @if($insideRows->count() > $i)
            <input type="text" name="inside01[]" 
                   value="{{ $insideRows->values()->get($i)->inside01 ?? '' }}"
                   style="width:100%; text-align:center; border:none; font-size:10pt;">
        @else
            <input type="text" name="inside01[]" 
                   value=""
                   style="width:100%; text-align:center; border:none; font-size:10pt;">
        @endif
    </div>
</td>

<td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
    <div style="width:100%; height:100%; text-align:center;">
        @if($insideRows->count() > $i)
            <input type="text" name="inside02[]" 
                   value="{{ $insideRows->values()->get($i)->inside02 ?? '' }}"
                   style="width:100%; text-align:center; border:none; font-size:10pt;">
        @else
            <input type="text" name="inside02[]" 
                   value=""
                   style="width:100%; text-align:center; border:none; font-size:10pt;">
        @endif
    </div>
</td>

<td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
    <div style="width:100%; height:100%; text-align:center;">
        @if($insideRows->count() > $i)
            <input type="text" name="inside03[]" 
                   value="{{ $insideRows->values()->get($i)->inside03 ?? '' }}"
                   style="width:100%; text-align:center; border:none; font-size:10pt;">
        @else
            <input type="text" name="inside03[]" 
                   value=""
                   style="width:100%; text-align:center; border:none; font-size:10pt;">
        @endif
    </div>
</td>

<td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
    <div style="width:100%; height:100%; text-align:center;">
        @if($insideRows->count() > $i)
            <input type="text" name="inside04[]" 
                   value="{{ $insideRows->values()->get($i)->inside04 ?? '' }}"
                   style="width:100%; text-align:center; border:none; font-size:10pt;">
        @else
            <input type="text" name="inside04[]" 
                   value=""
                   style="width:100%; text-align:center; border:none; font-size:10pt;">
        @endif
    </div>
</td>

<td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
    <div style="width:100%; height:100%; text-align:center;">
        @if($insideRows->count() > $i)
            <input type="text" name="inside05[]" 
                   value="{{ $insideRows->values()->get($i)->inside05 ?? '' }}"
                   style="width:100%; text-align:center; border:none; font-size:10pt;">
        @else
            <input type="text" name="inside05[]" 
                   value=""
                   style="width:100%; text-align:center; border:none; font-size:10pt;">
        @endif
    </div>
</td>

        </tr>
        @endfor
    </table>
</div>
          

                    <!-- ALAT STANDAR + CHECKBOX -->
                <!-- Footer Section -->
<table class="kalibrasi-main-table">
    <tr>
        <td colspan="6" style="text-align: center; border-bottom: 1px solid #000;">
            <span style="font-weight: bold; font-size: 18px; color: #000000;">Isilah lembar data kalibrasi dengan lengkap dan jelas!</span>
        </td>
    </tr>

    <!-- ALAT STANDAR + CHECKBOX - Versi Sederhana -->
    @php
        // Parse data alat standar dari string
        $standardString = $calibration->headCaliper->standard ?? '';
        $standardArray = !empty($standardString) ? explode(', ', $standardString) : [];
        
        // Daftar alat standar yang mungkin ada
        $allTools = [
            'Caliper Checker D.001' => 'Caliper Checker D.001',
            'Caliper Checker D.001B' => 'Caliper Checker D.001B', 
            'Gauge Block Set Grade 0' => 'Gauge Block Set Grade 0',
            'Pin Gauge 15 mm' => 'Pin Gauge 15 mm',
            'Ring Gauge 5 mm' => 'Ring Gauge 5 mm'
        ];
        
        // Alat standar tambahan (yang tidak ada di $allTools)
        $additionalTools = [];
        foreach ($standardArray as $tool) {
            $tool = trim($tool);
            if (!empty($tool) && !in_array($tool, $allTools) && !in_array(strtolower($tool), array_map('strtolower', $allTools))) {
                $additionalTools[] = $tool;
            }
        }
        
        $toolCount = count($allTools) + count($additionalTools);
    @endphp
    
    <tr style="height:13.5pt">
        <td rowspan="{{ $toolCount }}" style="width:105.35pt; border:1pt solid #000; vertical-align:middle; text-align:center; font-weight:bold; font-size:10pt; color:#000000;">
            Alat<br>Standar
        </td>

        <!-- Loop melalui semua alat standar -->
        @foreach($allTools as $key => $displayName)
            @if($loop->first)
                <!-- Baris pertama (sudah ada rowspan di atas) -->
                <td style="width:24.75pt; border:1pt solid #000; text-align:center; vertical-align:middle;">
                    <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center;">
                        <input type="checkbox" name="alat_standar[]"
                               value="{{ $key }}"
                               {{ in_array($key, $standardArray) || in_array(strtolower($key), array_map('strtolower', $standardArray)) ? 'checked' : '' }}>
                    </div>
                </td>
                <td colspan="2" style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
                    {{ $displayName }}
                </td>
                <td rowspan="{{ $toolCount }}" style="width:111.15pt; border:1pt solid #000; padding-top:6pt; text-align:center; vertical-align:top; font-size:8.5pt; color:#000000;">
                    Dikalibrasi<br>oleh
                </td>
                <td rowspan="{{ $toolCount }}" style="width:98.3pt; border:1pt solid #000; padding-top:6pt; text-align:center; vertical-align:top; font-size:8.5pt; color:#000000;">
                    Diperiksa<br>oleh
                </td>
            @else
                <!-- Baris berikutnya -->
                <tr style="height:13.5pt">
                    <td style="border:1pt solid #000; text-align:center; vertical-align:middle;">
                        <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center;">
                            <input type="checkbox" name="alat_standar[]"
                                   value="{{ $key }}"
                                   {{ in_array($key, $standardArray) || in_array(strtolower($key), array_map('strtolower', $standardArray)) ? 'checked' : '' }}>
                        </div>
                    </td>
                    <td colspan="2" style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
                        {{ $displayName }}
                    </td>
                </tr>
            @endif
        @endforeach

        <!-- Alat standar tambahan -->
        @foreach($additionalTools as $tool)
            <tr style="height:13.5pt">
                <td style="border:1pt solid #000; text-align:center; vertical-align:middle;">
                    <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center;">
                        <span style="font-size:14pt; color:#000; font-weight:bold;">✓</span>
                    </div>
                </td>
                <td colspan="2" style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
                    {{ $tool }}
                </td>
            </tr>
        @endforeach

    <!-- METODE KALIBRASI + TTD & NAMA -->
    <tr style="height:15pt">
        <td style="width:105.35pt; border:1pt solid #000; padding:8.6pt 0 0 20.5pt; font-size:8.5pt; vertical-align:top; color:#000000;">
            Metode Kalibrasi
        </td>
        <td colspan="3" style="border:1pt solid #000; padding:3.2pt 5.25pt 0 8.85pt; font-size:8.5pt; line-height:112%; vertical-align:top; color:#000000;">
            {{ $calibration->headCaliper->calibrationMethod ?? 'PAS-IK1102-03 (JIS B 7518:2023 (JMA/JSA); SNSU PK.P-02:2020)' }}
        </td>
        <td style="width:111.15pt; border:1pt solid #000; padding:3.35pt 0 0 1.35pt; font-size:8.5pt; vertical-align:top; color:#000000;">
            <div style="width:100%; text-align:center;">
                TTD :<br><br>
                <div style="display:flex; align-items:center; gap:6px;">
                    <span style="font-weight:bold; font-size:9pt;">Nama:</span>
                    <input type="text" name="calibratedBy"
                           value="{{ $calibration->calibratedBy ?? '' }}"
                           style="font-weight:bold; font-size:9pt; border:none; border-bottom:1px solid #000; outline:none; background:transparent; width:180px;">
                </div>
            </div>
        </td>
        <td style="width:98.3pt; border:1pt solid #000; padding:3.35pt 0 0 1.8pt; font-size:8.5pt; vertical-align:top; color:#000000;">
            <div style="width:100%; text-align:center;">
                TTD :<br><br>
                <div style="display:flex; align-items:center; gap:6px;">
                    <span style="font-weight:bold; font-size:9pt;">Nama:</span>
                    <input type="text" name="verifiedBy"
                           value="{{ $calibration->verifiedBy ?? '' }}"
                           style="font-weight:bold; font-size:9pt; border:none; border-bottom:1px solid #000; outline:none; background:transparent; width:180px;">
                </div>
            </div>
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