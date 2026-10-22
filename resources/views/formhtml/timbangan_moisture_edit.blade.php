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
    <style>
        /* ── Standar Picker Widget ── */
        .sp-wrapper {
            position: relative;
            width: 100%;
            min-height: 34px;
            background: transparent;
            box-sizing: border-box;
            cursor: pointer;
        }
        .sp-display {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 3px;
            padding: 4px 6px;
            min-height: 34px;
            width: 100%;
            box-sizing: border-box;
        }
        .sp-placeholder {
            color: #aaa;
            font-size: 11px;
            font-style: italic;
            user-select: none;
        }
        .sp-chip {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: #e0f2fe; /* Background biru muda cerah */
            color: #0369a1; /* Teks biru cerah */
            border: 1px solid #bae6fd; /* Border tipis biru muda */
            border-radius: 6px;
            padding: 2px 6px;
            font-size: 11px;
            font-weight: 600;
            white-space: nowrap;
            user-select: none;
        }
        .sp-chip .sp-remove {
            cursor: pointer;
            font-size: 12px;
            line-height: 1;
            color: #ef4444; /* Warna merah cerah untuk tombol hapus agar terlihat jelas */
            font-weight: bold;
            margin-left: 2px;
        }
        .sp-chip .sp-remove:hover { color: #b91c1c; }
        .sp-dropdown {
            display: none;
            position: fixed;
            z-index: 99999;
            background: #fff;
            border: 2px solid #1e40af;
            border-radius: 10px;
            box-shadow: 0 8px 32px rgba(30,64,175,0.18);
            min-width: 220px;
            max-height: 340px;
            overflow-y: auto;
            padding: 6px 0;
            font-family: 'Inter', sans-serif;
        }
        .sp-dropdown.open { display: block; }
        .sp-search {
            width: calc(100% - 16px);
            margin: 6px 8px;
            padding: 5px 10px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 12px;
            box-sizing: border-box;
            outline: none;
        }
        .sp-search:focus { border-color: #1e40af; }
        .sp-group-label {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6b7280;
            padding: 6px 12px 2px;
        }
        .sp-option {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 5px 12px;
            font-size: 12px;
            cursor: pointer;
            transition: background 0.12s;
            color: #1f2937;
        }
        .sp-option:hover { background: #eff6ff; }
        .sp-option.selected { background: #dbeafe; font-weight: 600; color: #1e40af; }
        .sp-option .sp-check {
            width: 14px;
            height: 14px;
            border: 1.5px solid #d1d5db;
            border-radius: 3px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 9px;
            flex-shrink: 0;
            background: #fff;
        }
        .sp-option.selected .sp-check {
            background: #1e40af;
            border-color: #1e40af;
            color: #fff;
        }
        .sp-divider { border: none; border-top: 1px solid #f3f4f6; margin: 4px 0; }
        .sp-count-badge {
            display: inline-block;
            background: #1e40af;
            color: #fff;
            border-radius: 8px;
            font-size: 10px;
            font-weight: 700;
            padding: 0px 5px;
            margin-left: 4px;
            vertical-align: middle;
        }
    </style>
    <style>
    /* Tombol Copy Standar Picker */
    .copy-standar-btn {
        transition: all 0.2s ease;
        border-color: #3b82f6;
        color: #3b82f6;
        background-color: white;
        font-weight: bold;
    }
    
    .copy-standar-btn:hover {
        background-color: #3b82f6;
        color: white;
        transform: scale(1.1);
        box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
    }
    
    .copy-standar-btn:active {
        transform: scale(0.95);
    }
    
    /* Animasi flash hijau saat copy berhasil */
    @keyframes flashGreen {
        0%, 100% { background-color: transparent; }
        50% { background-color: #d4edda; }
    }
    
    .copy-success-flash {
        animation: flashGreen 0.6s ease;
    }
    
    /* Toast notification animation */
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
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
                        <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK15</p>
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
                        <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">TIMBANGAN</p>
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
                        <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;">{{ $calibration->headTimbanganMoisture->certificate_id ?? $calibration->headTimbangan->certificate_id ?? 'N/A' }}</p>
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
                        <td>
                            <p style="margin: 0; color: #000000;" class="required-field">Tanggal Alat Masuk</p>
                        </td>
                        <td colspan="3">
                            <input type="date" class="kalibrasi-input" name="tanggalMasuk" 
                                   value="{{ old('tanggalMasuk', \Carbon\Carbon::parse($calibration->tanggalMasuk)->format('Y-m-d')) }}" >
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
                    <input class="form-check-input" type="radio" name="tempatKalibrasi" value="lab.PT PAS"
                        {{ old('tempatKalibrasi',$calibration->tempatKalibrasi)=='lab.PT PAS'?'checked':'' }}>
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
            
      <table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr valign="top">
        <!-- Blok Kiri: Setengah Kap. Max -->
        <td width="33%" valign="top" style="padding-right: 20px;">
            <b>Pemeriksaan Nilai Repeatability</b><br><br>
            Setengah Kap. Max =
            <input type="text"
                   name="setengah_kapasitas"
            value="{{ $calibration->headTimbanganMoisture->setengah_kapasitas ?? $calibration->headTimbangan->setengah_kapasitas ?? '' }}"
                   style="border:0; border-bottom:1px dotted #000; width:200px; background:transparent;">
            <br><br>

            <table style="border-collapse: collapse; width: 100%;">
                <tr style="background: #cccccc;">
                    <td style="border:2px solid #000; padding:8px; text-align:center; width:50%;">
                        <b>Penunjukan z1</b>
                    </td>
                    <td style="border:2px solid #000; padding:8px; text-align:center; width:50%;">
                        <b>Penunjukan m1</b>
                    </td>
                </tr>
                
                @for($i = 1; $i <= 10; $i++)
                    @php
                        $field_z1 = 'HalfMax_z1_' . str_pad($i, 2, '0', STR_PAD_LEFT);
                        $field_m1 = 'HalfMax_m1_' . str_pad($i, 2, '0', STR_PAD_LEFT);
                        
                        $value_z1 = '';
                        $value_m1 = '';
                        
                        $addModelHalf = $calibration->addTimbanganMoisture ?? $calibration->addTimbangan;
                        if ($addModelHalf) {
                            $value_z1 = $addModelHalf->{$field_z1} ?? '';
                            $value_m1 = $addModelHalf->{$field_m1} ?? '';
                        }
                    @endphp
                    <tr>
                        <td style="border:2px solid #000; padding:0;">
                            <input type="text" name="setengah_z1_{{ $i }}" 
                                   value="{{ $value_z1 }}" 
                                   style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                        </td>
                        <td style="border:2px solid #000; padding:0;">
                            <input type="text" name="setengah_m1_{{ $i }}" 
                                   value="{{ $value_m1 }}" 
                                   style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                        </td>
                    </tr>
                @endfor
            </table>
        </td>

        <!-- Blok Tengah: Kapasitas Max -->
        <td width="33%" valign="top" style="padding-right: 20px;">
            <b>Pemeriksaan Nilai Repeatability</b><br><br>
            Kapasitas Max =
            <input type="text"
                   name="kapasitas_max"
            value="{{ $calibration->headTimbanganMoisture->kapasitas_max ?? $calibration->headTimbangan->kapasitas_max ?? '' }}"
                   style="border:0; border-bottom:1px dotted #000; width:200px; background:transparent;">
            <br><br>

            <table style="border-collapse: collapse; width: 100%;">
                <tr style="background: #cccccc;">
                    <td style="border:2px solid #000; padding:8px; text-align:center; width:50%;">
                        <b>Penunjukan z1</b>
                    </td>
                    <td style="border:2px solid #000; padding:8px; text-align:center; width:50%;">
                        <b>Penunjukan m1</b>
                    </td>
                </tr>
                
                @for($i = 1; $i <= 10; $i++)
                    @php
                        $field_z1 = 'FullMax_z1_' . str_pad($i, 2, '0', STR_PAD_LEFT);
                        $field_m1 = 'FullMax_m1_' . str_pad($i, 2, '0', STR_PAD_LEFT);
                        
                        $value_z1 = '';
                        $value_m1 = '';
                        
                        $addModelFull = $calibration->addTimbanganMoisture ?? $calibration->addTimbangan;
                        if ($addModelFull) {
                            $value_z1 = $addModelFull->{$field_z1} ?? '';
                            $value_m1 = $addModelFull->{$field_m1} ?? '';
                        }
                    @endphp
                    <tr>
                        <td style="border:2px solid #000; padding:0;">
                            <input type="text" name="kapasitas_z1_{{ $i }}" 
                                   value="{{ $value_z1 }}" 
                                   style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                        </td>
                        <td style="border:2px solid #000; padding:0;">
                            <input type="text" name="kapasitas_m1_{{ $i }}" 
                                   value="{{ $value_m1 }}" 
                                   style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                        </td>
                    </tr>
                @endfor
            </table>
        </td>
   

    <!-- Blok Kanan: Suhu Moisture Analyzer -->
<td width="34%" valign="top">
   <!-- Judul SUHU MOISTURE ANALYZER dimasukkan dalam tabel -->
<table style="border-collapse: collapse; width: 100%; border: 2px solid #000000;">
    <!-- Baris untuk judul SUHU MOISTURE ANALYZER -->
    <tr>
        <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold; font-size:14px;" colspan="3">
            SUHU MOISTURE ANALYZER
        </td>
    </tr>
    
    <!-- Baris untuk header Setting suhu dan Pembacaan -->
    <tr>
        <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold;" rowspan="2">
            Setting suhu
        </td>
        <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold;" colspan="2">
            Pembacaan
        </td>
    </tr>
    
    <!-- Baris untuk sub-header Alat dan Standar -->
    <tr>
        <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#cccccc; font-weight:bold;">
            Alat
        </td>
        <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#cccccc; font-weight:bold;">
            Standar
        </td>
    </tr>
    
    @for($i = 0; $i < 3; $i++)
        @php
            // Ambil data untuk record ke-$i (0,1,2)
            $detail = $calibration->detailTimbanganMoistures[$i] ?? null;
        @endphp
        
        <!-- SETTING SUHU - ROWSPAN 3 -->
        <tr>
            <td style="border:2px solid #000; padding:8px; text-align:center;" rowspan="3">
                <input type="text"
                       name="Tsetting[]"
                       value="{{ $detail->Tsetting ?? '' }}"
                       style="width:100%; border:0; background:transparent; text-align:center;">
            </td>
            
            <!-- BARIS 1 -->
            <td style="border:2px solid #000; padding:8px; text-align:center;">
                <input type="text"
                       name="ReadAlat01[]"
                       value="{{ $detail->ReadAlat01 ?? '' }}"
                       style="width:100%; border:0; background:transparent; text-align:center;">
            </td>
            <td style="border:2px solid #000; padding:8px; text-align:center;">
                <input type="text"
                       name="ReadSTD01[]"
                       value="{{ $detail->ReadSTD01 ?? '' }}"
                       style="width:100%; border:0; background:transparent; text-align:center;">
            </td>
        </tr>

        <!-- BARIS 2 -->
        <tr>
            <td style="border:2px solid #000; padding:8px; text-align:center;">
                <input type="text"
                       name="ReadAlat02[]"
                       value="{{ $detail->ReadAlat02 ?? '' }}"
                       style="width:100%; border:0; background:transparent; text-align:center;">
            </td>
            <td style="border:2px solid #000; padding:8px; text-align:center;">
                <input type="text"
                       name="ReadSTD02[]"
                       value="{{ $detail->ReadSTD02 ?? '' }}"
                       style="width:100%; border:0; background:transparent; text-align:center;">
            </td>
        </tr>

        <!-- BARIS 3 -->
        <tr>
            <td style="border:2px solid #000; padding:8px; text-align:center;">
                <input type="text"
                       name="ReadAlat03[]"
                       value="{{ $detail->ReadAlat03 ?? '' }}"
                       style="width:100%; border:0; background:transparent; text-align:center;">
            </td>
            <td style="border:2px solid #000; padding:8px; text-align:center;">
                <input type="text"
                       name="ReadSTD03[]"
                       value="{{ $detail->ReadSTD03 ?? '' }}"
                       style="width:100%; border:0; background:transparent; text-align:center;">
            </td>
        </tr>
    @endfor
</table>
</td>
        </td>
    </tr>
</table>




  <!-- Jarak dan Footer Section -->
                        <div style="margin-top: 40px; margin-bottom: 20px;"></div>
<p style="margin-top:4.6pt; margin-left:12.2pt; margin-bottom:0.65pt">Pemeriksaan Nilai Nominal</p>
<table style="border-collapse: collapse; width: 100%; margin-left:10.92pt; border:2px solid #000000;">
    <tr>
        <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold;">
            Skala Nominal
        </td>
        <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold;">
            z1
        </td>
        <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold;">
            m1
        </td>
        <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold;">
            m1
        </td>
        <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold;">
            z1
        </td>
        <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold;">
            Standar Anak Timbang yang Digunakan
        </td>
    </tr>
    
    @for($i = 0; $i < 10; $i++)
        @php
            // Ambil data berdasarkan index array (0-9)
            $detail = $calibration->detailTimbanganMoistures[$i] ?? null;
            $rowNumber = $i + 1;
        @endphp
        <tr>
            <td style="border:2px solid #000; padding:0;">
                <input type="number" step="any" name="titikUkur_{{ $rowNumber }}" 
                       value="{{ $detail->titikUkur ?? '' }}"
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            <td style="border:2px solid #000; padding:0;">
                <input type="number" step="any" name="Lz1_{{ $rowNumber }}" 
                       value="{{ $detail->Lz1 ?? '' }}"
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            <td style="border:2px solid #000; padding:0;">
                <input type="number" step="any" name="Lm1_{{ $rowNumber }}" 
                       value="{{ $detail->Lm1 ?? '' }}"
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            <td style="border:2px solid #000; padding:0;">
                <input type="number" step="any" name="Rm1_{{ $rowNumber }}" 
                       value="{{ $detail->Rm1 ?? '' }}"
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            <td style="border:2px solid #000; padding:0;">
                <input type="number" step="any" name="Rz1_{{ $rowNumber }}" 
                       value="{{ $detail->Rz1 ?? '' }}"
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            <td style="border:2px solid #000; padding:0; position: relative;">
                @php $stdVal = $detail->STD ?? ''; @endphp
                <div style="display: flex; align-items: center; gap: 4px; padding: 4px 8px;">
                    <div style="flex: 1; min-width: 0;">
                        <input type="hidden"
                               name="STD_{{ $rowNumber }}"
                               id="sp_hidden_{{ $rowNumber }}"
                               value="{{ $stdVal }}">
                        <div class="sp-wrapper"
                             data-id="{{ $rowNumber }}"
                             data-value="{{ $stdVal }}"
                             style="min-height: 28px;">
                            <div class="sp-display" id="sp_display_{{ $rowNumber }}" style="min-height: 28px; padding: 2px 4px;">
                                <span class="sp-placeholder" id="sp_ph_{{ $rowNumber }}" style="font-size: 10px;">Pilih standar...</span>
                            </div>
                            <div class="sp-dropdown" id="sp_dd_{{ $rowNumber }}">
                                <input type="text" class="sp-search" placeholder="Cari kode..." id="sp_search_{{ $rowNumber }}">
                                <div class="sp-option-list" id="sp_list_{{ $rowNumber }}"></div>
                            </div>
                        </div>
                    </div>
                    
                    @if ($rowNumber > 1)
                    <button type="button" 
                            class="btn btn-sm btn-outline-secondary" 
                            onclick="copyStandar({{ $rowNumber - 1 }}, {{ $rowNumber }})"
                            title="Copy dari baris sebelumnya"
                            style="padding: 2px 6px; font-size: 10px;">
                        <i class="fas fa-copy"></i>
                    </button>
                    @endif
                </div>
            </td>
        </tr>
    @endfor
</table>

     <div style="margin-top: 40px; margin-bottom: 20px;"></div>

     <p style="margin-left:12.2pt; font-size:12pt; font-weight:bold; font-style:italic;">Off-Center Loading Test</p>
<table border="0" cellpadding="0" cellspacing="0" style="margin-left:12.2pt; margin-bottom:1.75pt">
    <tr>
        <td>
            Beban Timbangan 1/3 atau 1/2 dari Kapasitas Maksimal = 
        </td>
        <td>
            <input type="text" name="beban_timbangan" 
                   value="{{ $calibration->addTimbanganMoisture->bebanOffCenter ?? '' }}"
                   style="width:120px; border:1px solid #000; text-align:center; padding:2px;">
        </td>
        <td>
            &nbsp;&nbsp;Diutamakan anak timbangan tunggal jika memadai.
        </td>
    </tr>
</table>

<!-- Tabel Off-Center Loading Test -->
<table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 100%; margin-left:10.92pt; border:2px solid #000000;">
    <tr>
        <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold;">
            Posisi
        </td>
        <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold;">
            Tengah
        </td>
        <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold;">
            Depan
        </td>
        <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold;">
            Belakang
        </td>
        <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold;">
            Kanan
        </td>
        <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold;">
            Kiri
        </td>
    </tr>
    <tr>
        <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold;">
            Beban
        </td>
        <td style="border:2px solid #000; padding:0;">
            <input type="text" name="beban_tengah" 
                   value="{{ $calibration->addTimbanganMoisture->offCenterMiddle ?? '' }}"
                   style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
        </td>
        <td style="border:2px solid #000; padding:0;">
            <input type="text" name="beban_depan" 
                   value="{{ $calibration->addTimbanganMoisture->offCenterFront ?? '' }}"
                   style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
        </td>
        <td style="border:2px solid #000; padding:0;">
            <input type="text" name="beban_belakang" 
                   value="{{ $calibration->addTimbanganMoisture->offCenterBack ?? '' }}"
                   style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
        </td>
        <td style="border:2px solid #000; padding:0;">
            <input type="text" name="beban_kanan" 
                   value="{{ $calibration->addTimbanganMoisture->offCenterRight ?? '' }}"
                   style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
        </td>
        <td style="border:2px solid #000; padding:0;">
            <input type="text" name="beban_kiri" 
                   value="{{ $calibration->addTimbanganMoisture->offCenterLeft ?? '' }}"
                   style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
        </td>
    </tr>
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

<table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 100%; border:2px solid #000000;">
    <tr>
        <td colspan="6" style="border:2px solid #000; padding:12px; text-align:center; background-color:#f0f0f0;">
            <font style="font-weight:bold; font-size:10pt;">Isilah lembar data kalibrasi dengan lengkap dan jelas!</font>
        </td>
    </tr>
    <tr>
        <td rowspan="5" style="border:2px solid #000; padding:8px; background-color:#f0f0f0; vertical-align:middle; width:18%; text-align:center;">
            <font style="font-weight:bold;">Peralatan Standard</font>
        </td>
        <td colspan="4" style="border:2px solid #000; padding:8px;">
            <font>Anak Timbangan <i>class</i> :</font>
            @php
                // Ambil data alat standar dari head_timbangan_moisture
                $alatStandar = $calibration->headTimbanganMoisture->standard ?? $calibration->headTimbangan->standard ?? '';
                
                // Konversi ke array
                $alatStandarArray = [];
                if ($alatStandar) {
                    if (is_string($alatStandar)) {
                        $alatStandarArray = array_map('trim', explode(',', $alatStandar));
                    } elseif (is_array($alatStandar)) {
                        $alatStandarArray = $alatStandar;
                    }
                }
            @endphp
            
            <table border="0" cellpadding="0" cellspacing="5" style="display:inline-block; margin-left:20px;">
                <tr>
    <td style="padding:0 5px;">
        <input type="checkbox" class="view-checkbox" id="class_E2"
               name="alat_standar[]" value="E2"
               @if(in_array('E2', $alatStandarArray)) checked @endif>
        <label for="class_E2" class="view-checkbox-label">E2</label>
    </td>
    <td>/</td>
    <td style="padding:0 5px;">
        <input type="checkbox" class="view-checkbox" id="class_F1"
               name="alat_standar[]" value="F1"
               @if(in_array('F1', $alatStandarArray)) checked @endif>
        <label for="class_F1" class="view-checkbox-label">F1</label>
    </td>
    <td>/</td>
    <td style="padding:0 5px;">
        <input type="checkbox" class="view-checkbox" id="class_F2"
               name="alat_standar[]" value="F2"
               @if(in_array('F2', $alatStandarArray)) checked @endif>
        <label for="class_F2" class="view-checkbox-label">F2</label>
    </td>
    <td>/</td>
    <td style="padding:0 5px;">
        <input type="checkbox" class="view-checkbox" id="class_M1"
               name="alat_standar[]" value="M1"
               @if(in_array('M1', $alatStandarArray)) checked @endif>
        <label for="class_M1" class="view-checkbox-label">M1</label>
    </td>
    <td>/</td>
    <td style="padding:0 5px;">
        <input type="checkbox" class="view-checkbox" id="class_M2"
               name="alat_standar[]" value="M2"
               @if(in_array('M2', $alatStandarArray)) checked @endif>
        <label for="class_M2" class="view-checkbox-label">M2</label>
    </td>
    <td>/</td>
    <td style="padding:0 5px;">
        <input type="checkbox" class="view-checkbox" id="class_M3"
               name="alat_standar[]" value="M3"
               @if(in_array('M3', $alatStandarArray)) checked @endif>
        <label for="class_M3" class="view-checkbox-label">M3</label>
    </td>
</tr>

            </table>
            <font size="1"><i>(centang pilihan)</i></font>
        </td>
        <td rowspan="6" style="border:2px solid #000; padding:8px; text-align:center; vertical-align:top; width:15%;">
            <font style="font-weight:bold;">Dikalibrasi oleh</font><br><br><br>
            <table border="1" cellpadding="0" cellspacing="0" style="width:100%; height:80px; border:1px solid #000; background-color:#fff;">
                <tr>
                    <td style="text-align:center; vertical-align:bottom; padding:10px;">
                        <font>TTD</font><br>
                        <table border="0" cellpadding="0" cellspacing="0" style="width:100%; margin-top:5px;">
                            <tr>
                                <td style="border-bottom:1px solid #000; padding:3px; text-align:center;">
                                    <font size="2">{{ $calibration->headTimbanganMoisture->ttd_kalibrator ?? $calibration->headTimbangan->ttd_kalibrator ?? '(...........................................)' }}</font>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <br>
            <table border="1" cellpadding="0" cellspacing="0" style="width:100%; height:40px; border:1px solid #000; background-color:#fff; margin-top:10px;">
                <tr>
                    <td style="padding:5px; text-align:center;">
                        <strong><input type="text"
       name="calibratedBy"
       value="{{ $calibration->calibratedBy ?? '' }}"
       style="width:100%; border:0; background:transparent; text-align:center;">
</strong>
                    </td>
                </tr>
            </table>
            <font>Nama</font>
        </td>
        <td rowspan="6" style="border:2px solid #000; padding:8px; text-align:center; vertical-align:top; width:15%;">
            <font style="font-weight:bold;">Diperiksa oleh</font><br><br><br>
            <table border="1" cellpadding="0" cellspacing="0" style="width:100%; height:80px; border:1px solid #000; background-color:#fff;">
                <tr>
                    <td style="text-align:center; vertical-align:bottom; padding:10px;">
                        <font>TTD</font><br>
                        <table border="0" cellpadding="0" cellspacing="0" style="width:100%; margin-top:5px;">
                            <tr>
                                <td style="border-bottom:1px solid #000; padding:3px; text-align:center;">
                                    <font size="2">{{ $calibration->headTimbanganMoisture->ttd_pemeriksa ?? $calibration->headTimbangan->ttd_pemeriksa ?? '(...........................................)' }}</font>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <br>
            <table border="1" cellpadding="0" cellspacing="0" style="width:100%; height:40px; border:1px solid #000; background-color:#fff; margin-top:10px;">
                <tr>
                    <td style="padding:5px; text-align:center;">
                        <strong><input type="text"
       name="verifiedBy"
       value="{{ $calibration->verifiedBy ?? '' }}"
       style="width:100%; border:0; background:transparent; text-align:center;">
</strong>
                    </td>
                </tr>
            </table>
            <font>Nama</font>
        </td>
    </tr>
    <tr>
    <td style="border:2px solid #000; padding:8px; background-color:#f0f0f0; text-align:center; width:5%;">
        <input type="checkbox" class="view-checkbox" id="peralatan_1"
               name="alat_standar[]" value="Multifunction Temperature Calibrator (Adittel) ADT221A"
               @if(in_array('Multifunction Temperature Calibrator (Adittel) ADT221A', $alatStandarArray)) checked @endif>
    </td>
    <td colspan="2" style="border:2px solid #000; padding:8px;">
        <font>Multifunction Temperature Calibrator (Adittel) ADT221A</font>
    </td>
</tr>

<tr>
    <td style="border:2px solid #000; padding:8px; background-color:#f0f0f0; text-align:center;">
        <input type="checkbox" class="view-checkbox" id="peralatan_2"
               name="alat_standar[]" value="Multifunction Calibrator, SIKA WEM41021-021C"
               @if(in_array('Multifunction Calibrator, SIKA WEM41021-021C', $alatStandarArray)) checked @endif>
    </td>
    <td colspan="2" style="border:2px solid #000; padding:8px;">
        <font>Multifunction Calibrator, SIKA WEM41021-021C</font>
    </td>
</tr>

<tr>
    <td style="border:2px solid #000; padding:8px; background-color:#f0f0f0; text-align:center;">
        <input type="checkbox" class="view-checkbox" id="peralatan_3"
               name="alat_standar[]" value="Midi Logger Graptech 220"
               @if(in_array('Midi Logger Graptech 220', $alatStandarArray)) checked @endif>
    </td>
    <td colspan="2" style="border:2px solid #000; padding:8px;">
        <font>Midi Logger Graptech 220</font>
    </td>
</tr>

<tr>
    <td style="border:2px solid #000; padding:8px; background-color:#f0f0f0; text-align:center;">
        <input type="checkbox" class="view-checkbox" id="peralatan_4"
               name="alat_standar[]" value="Midi Logger Graptech 240"
               @if(in_array('Midi Logger Graptech 240', $alatStandarArray)) checked @endif>
    </td>
    <td colspan="2" style="border:2px solid #000; padding:8px;">
        <font>Midi Logger Graptech 240</font>
    </td>
</tr>

    <tr>
        <td style="border:2px solid #000; padding:8px; background-color:#f0f0f0; vertical-align:middle; text-align:center;">
            <font style="font-weight:bold;">Metode Kalibrasi</font>
        </td>
        <td colspan="4" style="border:2px solid #000; padding:8px; vertical-align:middle;">
            <font>PAS-IK1102-15 (Monograph 4 : The Calibration of Weights and Balances, NMI Australia 2010)</font>
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
<script>
/* ── Standar Picker (Multi-select chip) dengan Fitur Copy ── */
(function () {
    'use strict';

    // Bangun list AT secara dinamis
    var dynamicAtItems = [];
    for (var i = 1; i <= 5; i++) {
        dynamicAtItems.push('AT-5-' + (i < 10 ? '0' : '') + i);
    }
    for (var i = 1; i <= 6; i++) {
        dynamicAtItems.push('AT-10-' + (i < 10 ? '0' : '') + i);
    }
    for (var i = 1; i <= 115; i++) {
        dynamicAtItems.push('AT-20-' + (i < 10 ? '0' : '') + i);
    }

    var SP_OPTIONS = [
        { group: 'M. Anak Timbangan', items: [
            'M.001','M.002','M.003','M.004','M.005','M.006','M.007',
            'M.008','M.009','M.010','M.011','M.012','M.013','M.014','M.015',
            'M.016','M.017','M.018','M.019','M.020','M.021'
        ]},
        { group: 'AT. Anak Timbangan', items: dynamicAtItems }
    ];
    var SP_MAX = 5;
    var activeDropdown = null;

    // Helper untuk mencari elemen terkait sebuah wrapper (mengatasi masalah ID terduplikasi / tab dynamic)
    function getPickerElements(wrapper) {
        // Karena dropdown bisa dipindah ke body, kita beri referensi
        var dd = wrapper._dropdownEl;
        if (!dd) {
            dd = wrapper.querySelector('.sp-dropdown');
            if (dd) wrapper._dropdownEl = dd;
        }
        
        return {
            display: wrapper.querySelector('.sp-display'),
            ph: wrapper.querySelector('.sp-placeholder'),
            hidden: wrapper.parentElement ? wrapper.parentElement.querySelector('input[type="hidden"]') : null,
            search: dd ? dd.querySelector('.sp-search') : null,
            listEl: dd ? dd.querySelector('.sp-option-list') : null,
            dd: dd
        };
    }

    // ==========================================
    // FUNGSI CORE STANDAR PICKER
    // ==========================================
    function buildOptionList(listEl, selected, searchVal) {
        listEl.innerHTML = '';
        var q = (searchVal || '').toLowerCase();
        SP_OPTIONS.forEach(function (grp) {
            var filtered = grp.items.filter(function (item) {
                return !q || item.toLowerCase().includes(q);
            });
            if (!filtered.length) return;
            var lbl = document.createElement('div');
            lbl.className = 'sp-group-label';
            lbl.textContent = grp.group;
            listEl.appendChild(lbl);
            filtered.forEach(function (item) {
                var opt = document.createElement('div');
                opt.className = 'sp-option' + (selected.includes(item) ? ' selected' : '');
                opt.dataset.value = item;
                opt.innerHTML =
                    '<span class="sp-check">' + (selected.includes(item) ? '✓' : '') + '</span>' +
                    '<span>' + item + '</span>';
                listEl.appendChild(opt);
            });
            var div = document.createElement('hr');
            div.className = 'sp-divider';
            listEl.appendChild(div);
        });
    }

    // 🔥 renderChips dengan sync dari hidden
    window.renderChips = function(wrapper, selected) {
        var els = getPickerElements(wrapper);
        var display = els.display;
        var ph = els.ph;
        var hidden = els.hidden;

        if (!display || !ph || !hidden) {
            console.warn('Elements not found for wrapper:', wrapper.dataset.id);
            return;
        }

        // 🔥 Sinkronkan selected dengan nilai di hidden
        if (hidden.value) {
            var hiddenSelected = hidden.value.split('+').filter(Boolean);
            if (selected.length === 0 && hiddenSelected.length > 0) {
                selected = hiddenSelected;
            }
        }

        // Hapus chip lama
        Array.from(display.children).forEach(function (c) {
            if (c.classList.contains('sp-chip')) c.remove();
        });

        if (!selected || selected.length === 0) {
            ph.style.display = '';
            hidden.value = '';
            wrapper.dataset.value = '';
            return;
        }

        ph.style.display = 'none';
        selected.forEach(function (val) {
            var chip = document.createElement('span');
            chip.className = 'sp-chip';
            chip.innerHTML = val + '<span class="sp-remove" data-val="' + val + '">×</span>';
            chip.querySelector('.sp-remove').addEventListener('click', function (e) {
                e.stopPropagation();
                var idx = selected.indexOf(val);
                if (idx !== -1) {
                    selected.splice(idx, 1);
                    // 🔥 Update hidden dan wrapper
                    hidden.value = selected.join('+');
                    wrapper.dataset.value = selected.join('+');
                    window.renderChips(wrapper, selected);
                    refreshDropdown(wrapper, selected);
                }
            });
            display.insertBefore(chip, ph);
        });
        hidden.value = selected.join('+');
        wrapper.dataset.value = selected.join('+');
    };

    function refreshDropdown(wrapper, selected) {
        var els = getPickerElements(wrapper);
        if (!els.listEl) return;
        buildOptionList(els.listEl, selected, els.search ? els.search.value : '');
        attachOptionClicks(els.listEl, wrapper, selected);
    }

    function attachOptionClicks(listEl, wrapper, selected) {
        listEl.querySelectorAll('.sp-option').forEach(function (opt) {
            opt.removeEventListener('click', opt._clickHandler);
            opt._clickHandler = function (e) {
                e.stopPropagation();
                var val = opt.dataset.value;
                
                // 🔥 Ambil data terbaru dari hidden input
                var els = getPickerElements(wrapper);
                var hidden = els.hidden;
                if (hidden) {
                    var currentValue = hidden.value;
                    selected = currentValue ? currentValue.split('+').filter(Boolean) : [];
                }
                
                var idx = selected.indexOf(val);
                if (idx === -1) {
                    if (selected.length >= SP_MAX) {
                        showToast('Maksimal ' + SP_MAX + ' pilihan!');
                        return;
                    }
                    selected.push(val);
                } else {
                    selected.splice(idx, 1);
                }
                
                // Update
                window.renderChips(wrapper, selected);
                refreshDropdown(wrapper, selected);
                
                // 🔥 Update data-value di wrapper
                wrapper.dataset.value = selected.join('+');
            };
            opt.addEventListener('click', opt._clickHandler);
        });
    }

    function positionDropdown(wrapper, dd) {
        if (!wrapper || !dd) return;
        var rect = wrapper.getBoundingClientRect();
        var spaceBelow = window.innerHeight - rect.bottom;
        var spaceAbove = rect.top;
        dd.style.left = rect.left + 'px';
        dd.style.width = Math.max(220, rect.width) + 'px';
        if (spaceBelow >= 200 || spaceBelow >= spaceAbove) {
            dd.style.top = rect.bottom + 'px';
            dd.style.bottom = 'auto';
        } else {
            dd.style.bottom = (window.innerHeight - rect.top) + 'px';
            dd.style.top = 'auto';
        }
    }

    function openDropdown(wrapper, selected) {
        if (activeDropdown && activeDropdown !== wrapper) {
            closeDropdown(activeDropdown);
        }
        var els = getPickerElements(wrapper);
        var dd = els.dd;
        if (!dd) {
            console.warn('Dropdown not found for wrapper:', wrapper.dataset.id);
            return;
        }
        if (dd.parentElement !== document.body) {
            document.body.appendChild(dd);
        }
        positionDropdown(wrapper, dd);
        dd.classList.add('open');
        activeDropdown = wrapper;
        if (els.search) { 
            els.search.value = ''; 
            setTimeout(function() { els.search.focus(); }, 50);
        }
        refreshDropdown(wrapper, selected);
    }

    function closeDropdown(wrapper) {
        if (!wrapper) return;
        var els = getPickerElements(wrapper);
        if (els.dd) els.dd.classList.remove('open');
        if (activeDropdown === wrapper) activeDropdown = null;
    }

    function initPicker(wrapper) {
        if (wrapper.dataset.initialized) return;
        wrapper.dataset.initialized = 'true';
        
        var rawVal = wrapper.dataset.value || '';
        var selected = rawVal ? rawVal.split('+').map(function (s) { return s.trim(); }).filter(Boolean) : [];

        var els = getPickerElements(wrapper);
        var hidden = els.hidden;

        // 🔥 Sinkronkan dengan hidden
        if (hidden && hidden.value && selected.length === 0) {
            selected = hidden.value.split('+').filter(Boolean);
            wrapper.dataset.value = hidden.value;
        }

        window.renderChips(wrapper, selected);

        if (els.search) {
            els.search.addEventListener('input', function () {
                refreshDropdown(wrapper, selected);
            });
            els.search.addEventListener('click', function (e) { e.stopPropagation(); });
            els.search.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') closeDropdown(wrapper);
            });
        }

        wrapper.removeEventListener('click', wrapper._clickHandler);
        wrapper._clickHandler = function (e) {
            var myEls = getPickerElements(wrapper);
            if (myEls.dd && myEls.dd.classList.contains('open')) {
                closeDropdown(wrapper);
            } else {
                openDropdown(wrapper, selected);
            }
        };
        wrapper.addEventListener('click', wrapper._clickHandler);
    }

    // ==========================================
    // 🔥 FUNGSI COPY STANDAR PICKER
    // ==========================================
    window.copyStandarPicker = function(formIndex, fromRow, toRow) {
        // Fallback untuk file yang hanya mengoper 2 argumen
        if (arguments.length === 2) {
            toRow = fromRow;
            fromRow = formIndex;
            formIndex = null;
        }
        
        // Coba pakai DOM relasional (jika button berada dalam satu baris TD yang sama/berdekatan)
        // Agak tricky untuk copy row ke row. Gunakan class / tag.
        // Asumsi form tabel statik: kita gunakanquerySelectorAll('.sp-wrapper') lalu kita cari by index
        var wrappers = Array.from(document.querySelectorAll('.sp-wrapper'));
        // Find wrapper with data-id == fromRow (menggunakan regex jika ada suffix tab)
        var sourceWrapper = wrappers.find(w => w.dataset.id == fromRow || String(w.dataset.id).endsWith('_'+fromRow) || String(w.dataset.id).startsWith(fromRow+'_'));
        var targetWrapper = wrappers.find(w => w.dataset.id == toRow || String(w.dataset.id).endsWith('_'+toRow) || String(w.dataset.id).startsWith(toRow+'_'));
        
        // Jika form index dikirim (timbangan asli), prioritaskan strict match
        if (formIndex !== null) {
            var firstHidden = document.querySelector('[id^="sp_hidden_"]');
            var tabSuffix = '';
            if (firstHidden) {
                var match = firstHidden.id.match(/sp_hidden_\d+_\d+(_.*)/);
                if (match) tabSuffix = match[1];
            }
            var wrapperIdTarget = formIndex + '_' + toRow + tabSuffix;
            var wrapperIdSource = formIndex + '_' + fromRow + tabSuffix;
            var strictTarget = wrappers.find(w => w.dataset.id == wrapperIdTarget);
            var strictSource = wrappers.find(w => w.dataset.id == wrapperIdSource);
            if (strictTarget) targetWrapper = strictTarget;
            if (strictSource) sourceWrapper = strictSource;
        }

        if (!sourceWrapper) {
            showToast('❌ Row ' + fromRow + ' tidak ditemukan!');
            return;
        }
        if (!targetWrapper) {
            showToast('❌ Row ' + toRow + ' tidak ditemukan!');
            return;
        }

        var sourceEls = getPickerElements(sourceWrapper);
        var sourceValue = sourceEls.hidden ? sourceEls.hidden.value : sourceWrapper.dataset.value;
        var selected = sourceValue ? sourceValue.split('+').filter(Boolean) : [];
        
        var targetEls = getPickerElements(targetWrapper);
        if (targetEls.hidden) {
            targetEls.hidden.value = selected.join('+');
        }
        
        targetWrapper.dataset.value = selected.join('+');
        window.renderChips(targetWrapper, selected);
        refreshDropdown(targetWrapper, selected);
        
        if (targetEls.display) {
            var parentTd = targetEls.display.closest('td');
            if (parentTd) {
                parentTd.classList.add('copy-success-flash');
                setTimeout(function() {
                    parentTd.classList.remove('copy-success-flash');
                }, 500);
            }
        }
        
        if (selected.length > 0) {
            showToast('✅ Standar berhasil di-copy ke Row ' + toRow);
        } else {
            showToast('ℹ️ Row ' + fromRow + ' kosong, tidak ada yang di-copy');
        }
    };
    
    // Agar tombol copy versi lama (copyStandar) tetap work
    window.copyStandar = window.copyStandarPicker;

    // ==========================================
    // FUNGSI NOTIFIKASI
    // ==========================================
    function showToast(message) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'info',
                title: 'Informasi',
                text: message,
                timer: 2000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        } else {
            alert(message);
        }
    }

    // ==========================================
    // INISIALISASI
    // ==========================================
    function initAllPickers() {
        var wrappers = document.querySelectorAll('.sp-wrapper:not([data-initialized="true"])');
        wrappers.forEach(function(wrapper) {
            initPicker(wrapper);
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initAllPickers);
    } else {
        initAllPickers();
    }
    
    // Observe DOM changes untuk menangkap tab dinamis (MutationObserver sangat direkomendasikan)
    var observer = new MutationObserver(function(mutations) {
        var uninitialized = document.querySelectorAll('.sp-wrapper:not([data-initialized="true"])');
        if (uninitialized.length > 0) {
            uninitialized.forEach(initPicker);
        }
    });
    observer.observe(document.body, { childList: true, subtree: true });

    document.addEventListener('click', function(e) {
        if (!activeDropdown) return;
        var dd = getPickerElements(activeDropdown).dd;
        if (!activeDropdown.contains(e.target) && dd && !dd.contains(e.target)) {
            closeDropdown(activeDropdown);
        }
    });

    window.addEventListener('scroll', function() {
        if (activeDropdown) {
            var dd = getPickerElements(activeDropdown).dd;
            if (dd) positionDropdown(activeDropdown, dd);
        }
    }, true);
    
    window.addEventListener('resize', function() {
        if (activeDropdown) {
            var dd = getPickerElements(activeDropdown).dd;
            if (dd) positionDropdown(activeDropdown, dd);
        }
    });
})();
</script>
</body>
</html>