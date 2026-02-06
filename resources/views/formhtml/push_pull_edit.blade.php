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
                        <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK34</p>
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
                        <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">PUSH PULL</p>
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
                        <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;">{{ $calibration->headPushPull->certificate_id ?? 'N/A' }}</p>
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
        <td><p style="margin: 0; color: #000000;">Merek</p></td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="text" class="kalibrasi-input me-3"
                       name="brandAlat"
                       value="{{ old('brandAlat', $calibration->brandAlat) }}" style="width:60%;">

                <span class="me-3" style="color:#000;">Kode Alat :</span>

                <input type="text" class="kalibrasi-input"
                       name="kodeAlat"
                       value="{{ old('kodeAlat', $calibration->kodeAlat) }}" style="width:30%;">
            </div>
        </td>
    </tr>

    <!-- Type / No. Seri -->
    <tr>
        <td><p style="margin: 0; color:#000;">Type / No. Seri</p></td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="text" class="kalibrasi-input me-3"
                       name="typeAlat"
                       value="{{ old('typeAlat', $calibration->typeAlat) }}" style="width:45%;">

                <span class="me-3" style="color:#000;">/</span>

                <input type="text" class="kalibrasi-input"
                       name="NoSeri"
                       value="{{ old('NoSeri', $calibration->NoSeri) }}" style="width:45%;">
            </div>
        </td>
    </tr>

    <!-- Kapasitas / Resolusi -->
    <tr>
        <td><p style="margin:0;color:#000;">Kapasitas / Resolusi</p></td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="text" class="kalibrasi-input me-3"
                       name="kapasitas"
                       value="{{ old('kapasitas', $calibration->kapasitas) }}" style="width:45%;">

                <span class="me-3" style="color:#000;">/</span>

                <input type="text" class="kalibrasi-input"
                       name="resolusi"
                       value="{{ old('resolusi', $calibration->resolusi) }}" style="width:45%;">
            </div>
        </td>
    </tr>

    <!-- Nama Pemilik -->
    <tr>
        <td><p style="margin:0;color:#000;">Nama Pemilik</p></td>
        <td colspan="3">
            <input type="text" class="kalibrasi-input"
                   name="pemilikAlat"
                   value="{{ old('pemilikAlat', $calibration->pemilikAlat) }}">
        </td>
    </tr>

    <!-- Tanggal -->
    <tr>
        <td><p style="margin:0;color:#000;">Tanggal Alat Masuk</p></td>
        <td colspan="3">
            <input type="date" class="kalibrasi-input"
                   name="tanggalMasuk"
                   value="{{ old('tanggalMasuk', $calibration->tanggalMasuk) }}">
        </td>
    </tr>

    <tr>
        <td><p style="margin:0;color:#000;">Tanggal Kalibrasi</p></td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="date" class="kalibrasi-input me-3"
                       name="tanggalKalibrasi"
                       value="{{ old('tanggalKalibrasi', $calibration->tanggalKalibrasi) }}" style="width:45%;">

                <span class="me-3" style="color:#000;">Jenis Pembacaan:</span>

                <input type="text" class="kalibrasi-input"
                       name="jenisPembacaan"
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
                        {{ old('tempatKalibrasi',$calibration->tempatKalibrasi)=='lab'?'checked':'' }}>
                    <label class="form-check-label" style="color:#000;">Lab. PT.PAS</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tempatKalibrasi" value="insitu"
                        {{ old('tempatKalibrasi',$calibration->tempatKalibrasi)=='insitu'?'checked':'' }}>
                    <label class="form-check-label" style="color:#000;">Insitu</label>
                </div>
            </div>
        </td>
    </tr>

    <!-- Lokasi PT -->
    <tr>
        <td><p style="margin:0;color:#000;">Lokasi PT</p></td>
        <td colspan="3">
            <input type="text" class="kalibrasi-input"
                   name="lokasiPT"
                   value="{{ old('lokasiPT', $calibration->lokasiPT) }}">
        </td>
    </tr>

</table>

           <!-- Fungsi Komponen Lainnya & Kondisi Kalibrasi -->
<div class="row mt-4">

    <!-- Fungsi Komponen Lainnya -->
    <div class="col-md-6 mb-4">
        <div class="kalibrasi-section-header" style="color:#000;">Fungsi Komponen Lainnya</div>

        <!-- Radio -->
        <div class="d-flex justify-content-center align-items-center mb-4" style="gap:60px;">
            <div class="text-center">
                <span class="fw-bold d-block mb-2" style="font-size:14px;">Ok</span>
                <input type="radio" name="kondisiAlat" value="ok"
                    class="form-check-input"
                    style="width:18px;height:18px;display:block;margin:0 auto;"
                    {{ $calibration->kondisiAlat == 'ok' ? 'checked' : '' }}>
            </div>
            <div class="text-center">
                <span class="fw-bold d-block mb-2" style="font-size:14px;">Rusak</span>
                <input type="radio" name="kondisiAlat" value="rusak"
                    class="form-check-input"
                    style="width:18px;height:18px;display:block;margin:0 auto;"
                    {{ $calibration->kondisiAlat == 'rusak' ? 'checked' : '' }}>
            </div>
        </div>

        <!-- Keterangan -->
        <div class="d-flex align-items-center">
            <span class="fw-bold me-3" style="min-width:100px;">Keterangan :</span>
            <div style="flex:1;">
                <input type="text"
                    name="keterangan"
                    class="kalibrasi-input"
                    value="{{ $calibration->keterangan }}"
                    style="border:none;border-bottom:2px solid #000;border-radius:0;padding:4px 0;background:transparent;width:100%;">
            </div>
        </div>
    </div>

    <!-- Kondisi Kalibrasi -->
    <div class="col-md-6 mb-4">
        <div class="kalibrasi-section-header" style="color:#000;">Kondisi Kalibrasi</div>

        <table class="table table-bordered">
            <tr>
                <td class="table-secondary fw-bold" style="width:30%;"></td>
                <td class="table-secondary fw-bold text-center">Awal</td>
                <td class="table-secondary fw-bold text-center">Tengah</td>
                <td class="table-secondary fw-bold text-center">Akhir</td>
            </tr>

            <tr>
                <td class="bg-light fw-bold">Suhu (°C)</td>
                <td><input type="text" name="RT_condition1" class="kondisi-input" value="{{ $calibration->RT_condition1 }}"></td>
                <td><input type="text" name="RT_condition2" class="kondisi-input" value="{{ $calibration->RT_condition2 }}"></td>
                <td><input type="text" name="RT_condition3" class="kondisi-input" value="{{ $calibration->RT_condition3 }}"></td>
            </tr>

            <tr>
                <td class="bg-light fw-bold">RH (%)</td>
                <td><input type="text" name="RH_condition1" class="kondisi-input" value="{{ $calibration->RH_condition1 }}"></td>
                <td><input type="text" name="RH_condition2" class="kondisi-input" value="{{ $calibration->RH_condition2 }}"></td>
                <td><input type="text" name="RH_condition3" class="kondisi-input" value="{{ $calibration->RH_condition3 }}"></td>
            </tr>
        </table>
    </div>
</div>


            <!-- Data Kalibrasi Section -->
            <div class="data-kalibrasi-header" style="color: #000000;">DATA KALIBRASI</div>
            
         <!-- resources/views/formhtml/push_pull_view.blade.php -->
<table cellspacing="0" cellpadding="0" class="TableNormal" 
    style="margin-left:6.12pt; border:1.5pt solid #000000; border-collapse:collapse; width:98%; font-family:Arial, sans-serif;">
    
    <!-- BARIS 1: HEADER UTAMA -->
    <!-- BARIS 1: HEADER UTAMA - VIEW DATA -->
<tr style="height:18pt">
    <td style="width:120pt; border:1.5pt solid #000000; vertical-align:middle; background-color:#f0f0f0;">
        <p style="margin:3pt; text-align:center; font-size:11pt; font-weight:bold;">
            Titik Ukur
        </p>
    </td>
    <td rowspan="2" style="width:200pt; border:1.5pt solid #000000; vertical-align:middle; background-color:#f0f0f0;">
        <p style="margin:3pt; text-align:center; font-size:11pt; font-weight:bold;">
            STD Yang Digunakan
        </p>
    </td>
    <td colspan="3" style="width:300pt; border:1.5pt solid #000000; vertical-align:middle; background-color:#f0f0f0;">
        <p style="margin:3pt; text-align:center; font-size:11pt; font-weight:bold;">
            Pembacaan Tarik 
           <input type="text"
       name="satuan_tarik"
       value="{{ $calibration->headPushPull->satuan_tarik ?? '(N)' }}"
       style="border:none;
              border-bottom:1px solid #000;
              padding:0 10px;
              min-width:80px;
              display:inline-block;
              text-align:center;
              background:transparent;">

        </p>
    </td>
    <td colspan="3" style="width:300pt; border:1.5pt solid #000000; vertical-align:middle; background-color:#f0f0f0;">
        <p style="margin:3pt; text-align:center; font-size:11pt; font-weight:bold;">
            Pembacaan Tekan 
           <input type="text"
       name="satuan_tekan"
       value="{{ $calibration->headPushPull->satuan_tekan ?? '(N)' }}"
       style="border:none;
              border-bottom:1px solid #000;
              padding:0 10px;
              min-width:80px;
              display:inline-block;
              text-align:center;
              background:transparent;">

        </p>
    </td>
</tr>

<!-- BARIS 2: SUB HEADER - VIEW DATA -->
<tr style="height:18pt">
    <td style="width:120pt; border:1.5pt solid #000000; vertical-align:middle;">
        <p style="margin:3pt; text-align:center; font-size:10pt;">
            <input type="text"
       name="satuan_titik_ukur"
       value="{{ $calibration->headPushPull->satuan_titik_ukur ?? '(N)' }}"
       style="border:none;
              border-bottom:1px solid #000;
              padding:0 10px;
              min-width:120px;
              display:inline-block;
              text-align:center;
              background:transparent;">

        </p>
    </td>
    <td style="width:100pt; border:1.5pt solid #000000; vertical-align:middle; text-align:center; font-size:10pt; font-weight:bold;">
        1
    </td>
    <td style="width:100pt; border:1.5pt solid #000000; vertical-align:middle; text-align:center; font-size:10pt; font-weight:bold;">
        2
    </td>
    <td style="width:100pt; border:1.5pt solid #000000; vertical-align:middle; text-align:center; font-size:10pt; font-weight:bold;">
        3
    </td>
    <td style="width:100pt; border:1.5pt solid #000000; vertical-align:middle; text-align:center; font-size:10pt; font-weight:bold;">
        1
    </td>
    <td style="width:100pt; border:1.5pt solid #000000; vertical-align:middle; text-align:center; font-size:10pt; font-weight:bold;">
        2
    </td>
    <td style="width:100pt; border:1.5pt solid #000000; vertical-align:middle; text-align:center; font-size:10pt; font-weight:bold;">
        3
    </td>
</tr>
    
    <!-- BARIS 3-12: DATA DETAIL (10 BARIS) -->
    @if($calibration->detailPushpulls && count($calibration->detailPushpulls) > 0)
        @foreach($calibration->detailPushpulls as $index => $detail)
        <tr style="height:25pt">
           <!-- Kolom 1: Titik Ukur -->
<td style="width:120pt; border:1.5pt solid #000000; vertical-align:middle; text-align:center;">
    <input type="text"
           name="titikUkur[]"
           value="{{ $detail->titikUkur ?? '' }}"
           style="font-size:11pt; border:none; background:transparent; width:100%; text-align:center;">
</td>

<!-- Kolom 2: STD -->
<td style="width:200pt; border:1.5pt solid #000000; vertical-align:middle; text-align:center;">
    <input type="text"
           name="STD[]"
           value="{{ $detail->STD ?? '' }}"
           style="font-size:11pt; border:none; background:transparent; width:100%; text-align:center;">
</td>

<!-- Kolom 3–5: Pembacaan Tarik -->
<td style="width:100pt; border:1.5pt solid #000000; text-align:center;">
    <input type="text" name="ulanganTarik01[]"
           value="{{ $detail->ulanganTarik01 ?? '' }}"
           style="font-size:11pt; border:none; background:transparent; width:100%; text-align:center;">
</td>

<td style="width:100pt; border:1.5pt solid #000000; text-align:center;">
    <input type="text" name="ulanganTarik02[]"
           value="{{ $detail->ulanganTarik02 ?? '' }}"
           style="font-size:11pt; border:none; background:transparent; width:100%; text-align:center;">
</td>

<td style="width:100pt; border:1.5pt solid #000000; text-align:center;">
    <input type="text" name="ulanganTarik03[]"
           value="{{ $detail->ulanganTarik03 ?? '' }}"
           style="font-size:11pt; border:none; background:transparent; width:100%; text-align:center;">
</td>

<!-- Kolom 6–8: Pembacaan Tekan -->
<td style="width:100pt; border:1.5pt solid #000000; text-align:center;">
    <input type="text" name="ulanganTekan01[]"
           value="{{ $detail->ulanganTekan01 ?? '' }}"
           style="font-size:11pt; border:none; background:transparent; width:100%; text-align:center;">
</td>

<td style="width:100pt; border:1.5pt solid #000000; text-align:center;">
    <input type="text" name="ulanganTekan02[]"
           value="{{ $detail->ulanganTekan02 ?? '' }}"
           style="font-size:11pt; border:none; background:transparent; width:100%; text-align:center;">
</td>

<td style="width:100pt; border:1.5pt solid #000000; text-align:center;">
    <input type="text" name="ulanganTekan03[]"
           value="{{ $detail->ulanganTekan03 ?? '' }}"
           style="font-size:11pt; border:none; background:transparent; width:100%; text-align:center;">
</td>

        </tr>
        @endforeach
        
        <!-- Jika kurang dari 10 baris, tampilkan baris kosong -->
        @if(count($calibration->detailPushpulls) < 10)
            @for($i = count($calibration->detailPushpulls); $i < 10; $i++)
            <tr style="height:25pt">
                <td style="width:120pt; border:1.5pt solid #000000; vertical-align:middle; text-align:center;"></td>
                <td style="width:200pt; border:1.5pt solid #000000; vertical-align:middle; text-align:center;"></td>
                <td style="width:100pt; border:1.5pt solid #000000; vertical-align:middle; text-align:center;"></td>
                <td style="width:100pt; border:1.5pt solid #000000; vertical-align:middle; text-align:center;"></td>
                <td style="width:100pt; border:1.5pt solid #000000; vertical-align:middle; text-align:center;"></td>
                <td style="width:100pt; border:1.5pt solid #000000; vertical-align:middle; text-align:center;"></td>
                <td style="width:100pt; border:1.5pt solid #000000; vertical-align:middle; text-align:center;"></td>
                <td style="width:100pt; border:1.5pt solid #000000; vertical-align:middle; text-align:center;"></td>
            </tr>
            @endfor
        @endif
    @else
        <!-- Jika tidak ada data -->
        @for($i = 1; $i <= 10; $i++)
        <tr style="height:25pt">
            <td style="width:120pt; border:1.5pt solid #000000; vertical-align:middle; text-align:center;"></td>
            <td style="width:200pt; border:1.5pt solid #000000; vertical-align:middle; text-align:center;"></td>
            <td style="width:100pt; border:1.5pt solid #000000; vertical-align:middle; text-align:center;"></td>
            <td style="width:100pt; border:1.5pt solid #000000; vertical-align:middle; text-align:center;"></td>
            <td style="width:100pt; border:1.5pt solid #000000; vertical-align:middle; text-align:center;"></td>
            <td style="width:100pt; border:1.5pt solid #000000; vertical-align:middle; text-align:center;"></td>
            <td style="width:100pt; border:1.5pt solid #000000; vertical-align:middle; text-align:center;"></td>
            <td style="width:100pt; border:1.5pt solid #000000; vertical-align:middle; text-align:center;"></td>
        </tr>
        @endfor
    @endif
    
</table>

<!-- REPEATABILITY TARIK -->
<p class="BodyText" style="margin-top:15pt; margin-left:2pt; margin-bottom:5pt;">
    <span style="font-size:12pt; font-weight:bold;">Repeatability Tarik</span>
</p>

<table cellspacing="0" cellpadding="0" class="TableNormal" 
    style="margin-left:0.6pt; border:1.5pt solid #000000; border-collapse:collapse; width:100%; max-width:600px;">
    
    <!-- Baris 1: 5 kolom angka pertama -->
    <tr style="height:25pt">
        @for($i = 1; $i <= 5; $i++)
        <td style="width:120px; border-left:1.5pt solid #000; {{ $i < 5 ? 'border-right:1.5pt solid #000;' : '' }} border-bottom:1.5pt solid #000; vertical-align:middle; text-align:center;">
            <span style="font-size:11pt;">
                @if($calibration->addPushpull)
                    @if($i == 1) <input type="text"
       name="repeatabilityTarik01"
       value="{{ $calibration->addPushpull->repeatabilityTarik01 ?? '' }}"
       style="width:100%; border:0; background:transparent; text-align:center;">

                    @elseif($i == 2) <input type="text"
       name="repeatabilityTarik02"
       value="{{ $calibration->addPushpull->repeatabilityTarik02 ?? '' }}"
       style="width:100%; border:0; background:transparent; text-align:center;">

                    @elseif($i == 3) <input type="number" step="any" name="repeatabilityTarik03" value="{{ $calibration->addPushpull->repeatabilityTarik03 ?? '' }}" style="width:100%; border:0; background:transparent; text-align:center;">
                    @elseif($i == 4) <input type="number" step="any" name="repeatabilityTarik04" value="{{ $calibration->addPushpull->repeatabilityTarik04 ?? '' }}" style="width:100%; border:0; background:transparent; text-align:center;">
                    @elseif($i == 5) <input type="number" step="any" name="repeatabilityTarik05" value="{{ $calibration->addPushpull->repeatabilityTarik05 ?? '' }}" style="width:100%; border:0; background:transparent; text-align:center;">
                    @endif
                @endif
            </span>
        </td>
        @endfor
    </tr>

    <!-- Baris 2: 5 kolom angka kedua -->
    <tr style="height:25pt">
        @for($i = 6; $i <= 10; $i++)
        <td style="width:120px; border-top:1.5pt solid #000; border-left:1.5pt solid #000; {{ $i < 10 ? 'border-right:1.5pt solid #000;' : '' }} vertical-align:middle; text-align:center;">
            <span style="font-size:11pt;">
                @if($calibration->addPushpull)
                    @if($i == 6) <input type="text"
       name="repeatabilityTarik06"
       value="{{ $calibration->addPushpull->repeatabilityTarik06 ?? '' }}"
       style="width:100%; border:0; background:transparent; text-align:center;">
                    @elseif($i == 7) <input type="text"
       name="repeatabilityTarik07"
       value="{{ $calibration->addPushpull->repeatabilityTarik07 ?? '' }}"
       style="width:100%; border:0; background:transparent; text-align:center;">
                    @elseif($i == 8) <input type="text"
       name="repeatabilityTarik08"
       value="{{ $calibration->addPushpull->repeatabilityTarik08 ?? '' }}"
       style="width:100%; border:0; background:transparent; text-align:center;">
                    @elseif($i == 9) <input type="text"
       name="repeatabilityTarik09"
       value="{{ $calibration->addPushpull->repeatabilityTarik09 ?? '' }}"
       style="width:100%; border:0; background:transparent; text-align:center;">
                    @elseif($i == 10) <input type="text"
       name="repeatabilityTarik10"
       value="{{ $calibration->addPushpull->repeatabilityTarik10 ?? '' }}"
       style="width:100%; border:0; background:transparent; text-align:center;">
                    @endif
                @endif
            </span>
        </td>
        @endfor
    </tr>
</table>

<!-- REPEATABILITY TEKAN -->
<p class="BodyText" style="margin-top:15pt; margin-left:2pt; margin-bottom:5pt;">
    <span style="font-size:12pt; font-weight:bold;">Repeatability Tekan</span>
</p>

<table cellspacing="0" cellpadding="0" class="TableNormal" 
    style="margin-left:0.6pt; border:1.5pt solid #000000; border-collapse:collapse; width:100%; max-width:600px;">
    
    <!-- Baris 1 -->
    <tr style="height:25pt">
        @for($i = 1; $i <= 5; $i++)
        <td style="width:120px; border-left:1.5pt solid #000; {{ $i < 5 ? 'border-right:1.5pt solid #000;' : '' }} border-bottom:1.5pt solid #000; vertical-align:middle; text-align:center;">
            <span style="font-size:11pt;">
                @if($calibration->addPushpull)
                    @if($i == 1)<input type="text"
       name="repeatabilityTekan01"
       value="{{ $calibration->addPushpull->repeatabilityTekan01 ?? '' }}"
       style="width:100%; border:0; background:transparent; text-align:center;">

                  @elseif($i == 2)
    <input type="text"
           name="repeatabilityTekan02"
           value="{{ $calibration->addPushpull->repeatabilityTekan02 ?? '' }}"
           style="width:100%; border:0; background:transparent; text-align:center;">
@elseif($i == 3)
    <input type="text"
           name="repeatabilityTekan03"
           value="{{ $calibration->addPushpull->repeatabilityTekan03 ?? '' }}"
           style="width:100%; border:0; background:transparent; text-align:center;">
@elseif($i == 4)
    <input type="text"
           name="repeatabilityTekan04"
           value="{{ $calibration->addPushpull->repeatabilityTekan04 ?? '' }}"
           style="width:100%; border:0; background:transparent; text-align:center;">
@elseif($i == 5)
    <input type="text"
           name="repeatabilityTekan05"
           value="{{ $calibration->addPushpull->repeatabilityTekan05 ?? '' }}"
           style="width:100%; border:0; background:transparent; text-align:center;">
@endif

                @endif
            </span>
        </td>
        @endfor
    </tr>

    <!-- Baris 2 -->
    <tr style="height:25pt">
        @for($i = 6; $i <= 10; $i++)
        <td style="width:120px; border-top:1.5pt solid #000; border-left:1.5pt solid #000; {{ $i < 10 ? 'border-right:1.5pt solid #000;' : '' }} vertical-align:middle; text-align:center;">
            <span style="font-size:11pt;">
                @if($calibration->addPushpull)
                   @if($i == 6)
    <input type="text"
           name="repeatabilityTekan06"
           value="{{ $calibration->addPushpull->repeatabilityTekan06 ?? '' }}"
           style="width:100%; border:0; background:transparent; text-align:center;">
@elseif($i == 7)
    <input type="text"
           name="repeatabilityTekan07"
           value="{{ $calibration->addPushpull->repeatabilityTekan07 ?? '' }}"
           style="width:100%; border:0; background:transparent; text-align:center;">
@elseif($i == 8)
    <input type="text"
           name="repeatabilityTekan08"
           value="{{ $calibration->addPushpull->repeatabilityTekan08 ?? '' }}"
           style="width:100%; border:0; background:transparent; text-align:center;">
@elseif($i == 9)
    <input type="text"
           name="repeatabilityTekan09"
           value="{{ $calibration->addPushpull->repeatabilityTekan09 ?? '' }}"
           style="width:100%; border:0; background:transparent; text-align:center;">
@elseif($i == 10)
    <input type="text"
           name="repeatabilityTekan10"
           value="{{ $calibration->addPushpull->repeatabilityTekan10 ?? '' }}"
           style="width:100%; border:0; background:transparent; text-align:center;">
@endif

                @endif
            </span>
        </td>
        @endfor
    </tr>
</table>

&nbsp;  &nbsp;
                 <!-- Footer Section -->
                 <table cellspacing="0" cellpadding="0" style="border-collapse: collapse; width: 100%; max-width: 1500px; margin-top: 20px; font-family: Arial, sans-serif; font-size: 10pt;">
    <!-- HEADER -->
    <tr>
        <td colspan="4" style="border: 1pt solid #000; padding: 12px; background-color: #f0f0f0; text-align: center; font-weight: bold;">
            Isilah lembar data kalibrasi dengan lengkap dan jelas!
        </td>
    </tr>

    <!-- STANDARD + ANAK TIMBANG (VIEW MODE) -->
    <tr>
        <td rowspan="3" style="width: 110px; border: 1pt solid #000; vertical-align: middle; text-align: center; background-color: #f8f9fa; font-weight: bold;">
            Standard
        </td>
        <td rowspan="3" style="width: 380px; border: 1pt solid #000; padding: 12px; vertical-align: top;">
            <p style="margin: 0 0 8px 0; font-size: 10pt; font-weight: bold;">Class Anak Timbang :</p>
            <div style="width: 100%; min-height: 160px; padding: 8px; font-size: 10pt; background-color: #fffff8; border: 1px solid #ddd;">
               @if(isset($calibration) && $calibration->headPushPull && $calibration->headPushPull->standard)
    <textarea name="standard"
              rows="3"
              style="width:100%; height:160px; border:0; background:transparent; resize:none; text-align:left;">{{ $calibration->headPushPull->standard }}</textarea>
@else

                    <span style="color: #999; font-style: italic;">Tidak ada data anak timbang</span>
                @endif
            </div>
        </td>

        <!-- Header Dikalibrasi oleh & Diperiksa oleh -->
        <td style="width: 200px; border: 1pt solid #000; text-align: center; padding: 15px 8px; background-color: #f8f9fa; font-weight: bold;">
            Dikalibrasi<br>oleh
        </td>
        <td style="width: 200px; border: 1pt solid #000; text-align: center; padding: 15px 8px; background-color: #f8f9fa; font-weight: bold;">
            Diperiksa<br>oleh
        </td>
    </tr>

    <!-- BARIS NAMA (VIEW MODE) -->
    <tr>
        <td style="border: 1pt solid #000; padding: 12px 8px; text-align: center; vertical-align: middle;">
            <div style="width: 92%; border-bottom: 1px solid #000; padding: 6px 4px; font-size: 10pt; text-align: center; min-height: 30px;">
                <input type="text"
       name="calibratedBy"
       value="{{ $calibration->calibratedBy ?? '' }}"
       style="width:100%; border:0; background:transparent; text-align:center;">

            </div>
        </td>
        <td style="border: 1pt solid #000; padding: 12px 8px; text-align: center; vertical-align: middle;">
            <div style="width: 92%; border-bottom: 1px solid #000; padding: 6px 4px; font-size: 10pt; text-align: center; min-height: 30px;">
                <input type="text"
       name="calibratedBy"
       value="{{ $calibration->calibratedBy ?? '' }}"
       style="width:100%; border:0; background:transparent; text-align:center;">

            </div>
        </td>
    </tr>

    <!-- BARIS TTD (VIEW MODE - tanpa garis TTD, hanya placeholder) -->
    <tr>
        <td style="border: 1pt solid #000; padding: 15px 8px; text-align: center; vertical-align: middle;">
            <strong>TTD :</strong><br>
            <div style="height: 70px; margin: 10px 15px; display: flex; align-items: center; justify-content: center;">
                <span style="color: #666; font-style: italic;">
                    @if(isset($calibration) && $calibration->calibrated_by)
                        (Tanda tangan {{ $calibration->calibrated_by }})
                    @else
                        (Tanda tangan)
                    @endif
                </span>
            </div>
        </td>
        <td style="border: 1pt solid #000; padding: 15px 8px; text-align: center; vertical-align: middle;">
            <strong>TTD :</strong><br>
            <div style="height: 70px; margin: 10px 15px; display: flex; align-items: center; justify-content: center;">
                <span style="color: #666; font-style: italic;">
                    @if(isset($calibration) && $calibration->verified_by)
                        (Tanda tangan {{ $calibration->verified_by }})
                    @else
                        (Tanda tangan)
                    @endif
                </span>
            </div>
        </td>
    </tr>

    <!-- METODE KALIBRASI (VIEW MODE) -->
    <tr>
        <td style="border: 1pt solid #000; text-align: center; background-color: #f8f9fa; font-weight: bold; padding: 12px;">
            Metode<br>Kalibrasi
        </td>
        <td colspan="3" style="border: 1pt solid #000; padding: 12px; vertical-align: middle;">
            @if(isset($calibration) && $calibration->headPushPull && $calibration->headPushPull->calibrationMethod)
                {{ $calibration->headPushPull->calibrationMethod }}
            @else
                PAS-IK1102-34
            @endif
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