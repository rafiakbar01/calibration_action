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
                        <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK13B</p>
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
                        <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">TORQUE METER</p>
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
                        <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;">{{ $calibration->headTorqueMeter->certificate_id ?? 'N/A' }}</p>
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
            <input type="text" name="namaAlat" class="kalibrasi-input"
                   value="{{ old('namaAlat', $calibration->namaAlat) }}">
        </td>
    </tr>

    <!-- Merek & Kode Alat -->
    <tr>
        <td>
            <p style="margin: 0; color: #000000;">Merek</p>
        </td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="text" name="brandAlat" class="kalibrasi-input me-3"
                       value="{{ old('brandAlat', $calibration->brandAlat) }}" style="width:60%;">
                <span class="me-3" style="color:#000000;">Kode Alat :</span>
                <input type="text" name="kodeAlat" class="kalibrasi-input"
                       value="{{ old('kodeAlat', $calibration->kodeAlat) }}" style="width:30%;">
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
        <td>
            <p style="margin: 0; color: #000000;">Kapasitas / Resolusi</p>
        </td>
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
        <td><p style="margin:0;">Nama Pemilik</p></td>
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
        <td><p style="margin:0;">Tanggal Kalibrasi</p></td>
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
        <td><p style="margin:0;">Tempat Kalibrasi</p></td>
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
        <td><p style="margin:0;">Lokasi PT</p></td>
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
        
        <!-- Radio Button Section -->
        <div class="d-flex justify-content-center align-items-center mb-4" style="gap: 60px;">
            <div class="text-center">
                <span class="fw-bold d-block mb-2" style="color: #000000; font-size: 14px;">Ok</span>
                <input type="radio" name="kondisiAlat" value="ok" class="form-check-input" 
                    style="width: 18px; height: 18px; display: block; margin: 0 auto;"
                    {{ old('kondisiAlat', $calibration->kondisiAlat) == 'ok' ? 'checked' : '' }}>
            </div>

            <div class="text-center">
                <span class="fw-bold d-block mb-2" style="color: #000000; font-size: 14px;">Rusak</span>
                <input type="radio" name="kondisiAlat" value="rusak" class="form-check-input"
                    style="width: 18px; height: 18px; display: block; margin: 0 auto;"
                    {{ old('kondisiAlat', $calibration->kondisiAlat) == 'rusak' ? 'checked' : '' }}>
            </div>
        </div>
        
        <!-- Keterangan Section -->
        <div class="d-flex align-items-center">
            <span class="fw-bold me-3" style="color: #000000; min-width: 100px;">Keterangan :</span>
            <div style="flex: 1;">
                <input type="text" name="keterangan" class="kalibrasi-input"
                       value="{{ old('keterangan', $calibration->keterangan) }}"
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
                <td><input  type="number" step="any"  name="RT_condition1" class="kondisi-input"
                           value="{{ old('RT_condition1', $calibration->RT_condition1) }}"></td>
                <td><input  type="number" step="any"  name="RT_condition2" class="kondisi-input"
                           value="{{ old('RT_condition2', $calibration->RT_condition2) }}"></td>
                <td><input  type="number" step="any"  name="RT_condition3" class="kondisi-input"
                           value="{{ old('RT_condition3', $calibration->RT_condition3) }}"></td>
            </tr>
            <tr>
                <td class="bg-light fw-bold" style="color: #000000;">RH (%)</td>
                <td><input  type="number" step="any"  name="RH_condition1" class="kondisi-input"
                           value="{{ old('RH_condition1', $calibration->RH_condition1) }}"></td>
                <td><input  type="number" step="any"  name="RH_condition2" class="kondisi-input"
                           value="{{ old('RH_condition2', $calibration->RH_condition2) }}"></td>
                <td><input  type="number" step="any"  name="RH_condition3" class="kondisi-input"
                           value="{{ old('RH_condition3', $calibration->RH_condition3) }}"></td>
            </tr>
        </table>
    </div>
</div>


            <!-- Data Kalibrasi Section -->
            <div class="data-kalibrasi-header" style="color: #000000;">DATA KALIBRASI</div>
            
            <!-- Bagian Radius dengan jarak lebih rapi & lega -->
<div style="margin-bottom: 18px; font-family: Arial, sans-serif;">
    <table style="border-collapse: collapse; display: inline-table;">
        <tr>
            <!-- Huruf r -->
            <td style="padding-right: 18px; vertical-align: middle; text-align: right;">
                <span style="font-size: 13pt; font-weight: bold;">r</span>
            </td>

            <!-- Nilai radius (VIEW MODE) -->
            <td style="padding-right: 12px; vertical-align: middle;">
                <span style="font-size:12pt;">(</span>
<input type="text"
       name="radiusAlatBantuSTD"
       value="{{ old('radiusAlatBantuSTD', $calibration->addTorqueMeter->radiusAlatBantuSTD ?? '') }}"
       style="width: 70px; padding: 6px 4px; font-size: 12pt; text-align: center; border: none; background: transparent;">
<span style="font-size:12pt;">)</span>

            </td>

            <!-- Tanda kurung buka dengan jarak -->
            <td style="padding-right: 8px; vertical-align: middle;">
                <span style="font-size: 12pt; color: #555;">(</span>
            </td>

            <!-- Satuan radius (VIEW MODE) -->
            <td style="padding-right: 8px; vertical-align: middle;">
                
<input type="text"
       name="kodeAlatBantuSTD"
       value="{{ old('kodeAlatBantuSTD', $calibration->addTorqueMeter->kodeAlatBantuSTD ?? '') }}"
       style="width: 70px; padding: 6px 4px; font-size: 12pt; text-align: center; border: none; background: transparent;">
<span style="font-size:12pt;">)</span>
            </td>

            <!-- Tanda kurung tutup -->
            <td style="vertical-align: middle;">
                
            </td>
        </tr>
    </table>
</div>

<!-- Tabel Utama -->
<!-- Tabel Utama - EDIT MODE -->
<table cellspacing="0" cellpadding="0" class="TableNormal" style="margin-left:0.6pt; border:1pt solid #000000; border-collapse:collapse; width:100%; max-width:1500px;">
    
    <!-- Header Tabel - Baris 1 -->
    <tr style="height:14pt">
        <td colspan="2" style="width:128px; border:1pt solid #000000; vertical-align:middle; text-align:center">
            <p style="margin:0; font-size:10pt;"><strong>Beban Anak Timbang</strong></p>
        </td>
        <td colspan="2" rowspan="2" style="width:172px; border:1pt solid #000000; vertical-align:middle; text-align:center">
            <p style="margin:0; font-size:10pt;"><strong>Kode Anak timbangan yang digunakan</strong></p>
        </td>
        <td colspan="6" style="border:1pt solid #000000; vertical-align:middle; text-align:center">
            <p style="margin:0; font-size:10pt;"><strong>Penunjukan Standard</strong></p>
        </td>
    </tr>
    
    <!-- Header Tabel - Baris 2 -->
    <tr style="height:13pt">
        <td colspan="2" style="border:1pt solid #000000; vertical-align:middle; text-align:center">
            <!-- Empty cell - bagian dari rowspan di atas -->
        </td>
        <td colspan="3" style="border:1pt solid #000000; vertical-align:middle; text-align:center">
            <p style="margin:0; font-size:10pt; line-height:1.15">
                <strong>Clockwise (</strong>
                <input type="text"
                    name="satuan_cw"
                    value="{{ old('satuan_cw', $calibration->headTorqueMeter->satuan_cw ?? '') }}"
                    style="
                        width:120px;
                        border:none;
                        outline:none;
                        background:transparent;
                        font-size:10pt;
                        letter-spacing:normal;
                        text-align:center;
                        padding:0;
                        margin:0;
                    "
                    placeholder="..........">
                <strong>)</strong>
            </p>
        </td>
        <td colspan="3" style="border:1pt solid #000000; vertical-align:middle; text-align:center">
            <p style="margin:0; font-size:10pt; line-height:1.15">
                <strong>Counter Clockwise (</strong>
                <input type="text"
                    name="satuan_ccw"
                    value="{{ old('satuan_ccw', $calibration->headTorqueMeter->satuan_ccw ?? '') }}"
                    style="
                        width:120px;
                        border:none;
                        outline:none;
                        background:transparent;
                        font-size:10pt;
                        letter-spacing:normal;
                        text-align:center;
                        padding:0;
                        margin:0;
                    "
                    placeholder=".........">
                <strong>)</strong>
            </p>
        </td>
    </tr>
    
    <!-- Sub-header -->
    <tr style="height:14pt">
        <td colspan="2" style="border:1pt solid #000000; vertical-align:middle; text-align:center">
            <p style="margin:0; font-size:8.5pt;">
                (
                <input type="text"
                    name="satuan_titikUkur"
                    value="{{ old('satuan_titikUkur', $calibration->headTorqueMeter->satuan_titikUkur ?? '') }}"
                    style="
                        border:none;
                        outline:none;
                        background:transparent;
                        width:120px;
                        font-size:10pt;
                        letter-spacing:normal;
                        text-align:center;
                        padding:0;
                        margin:0;
                    "
                    placeholder="...................">
                )
            </p>
        </td>
        <td colspan="2" style="border:1pt solid #000000; vertical-align:middle; text-align:center">
            <!-- Empty cell - satuan untuk Kode Anak Timbang -->
        </td>
        <td style="border:1pt solid #000000; text-align:center">
            <p style="margin:0; font-size:10pt;"><strong>1</strong></p>
        </td>
        <td style="border:1pt solid #000000; text-align:center">
            <p style="margin:0; font-size:10pt;"><strong>2</strong></p>
        </td>
        <td style="border:1pt solid #000000; text-align:center">
            <p style="margin:0; font-size:10pt;"><strong>3</strong></p>
        </td>
        <td style="border:1pt solid #000000; text-align:center">
            <p style="margin:0; font-size:10pt;"><strong>1</strong></p>
        </td>
        <td style="border:1pt solid #000000; text-align:center">
            <p style="margin:0; font-size:10pt;"><strong>2</strong></p>
        </td>
        <td style="border:1pt solid #000000; text-align:center">
            <p style="margin:0; font-size:10pt;"><strong>3</strong></p>
        </td>
    </tr>
    
    <!-- Baris 1-13 dengan input field untuk edit -->
    @for($i = 1; $i <= 13; $i++)
        @php
            // Cari data untuk baris ini
            $detail = isset($calibration) && $calibration->detailTorqueMeters && $calibration->detailTorqueMeters->count() > 0 
                ? ($calibration->detailTorqueMeters->get($i-1) ?? null) 
                : null;
            
            // Tentukan nama input yang konsisten
            $inputName = "detail[" . ($i-1) . "]";
        @endphp
        
        <tr style="height:14pt">
            <!-- Beban Anak Timbang — HANYA ANGKA (anti E/e) -->
            <td colspan="2" style="border:1pt solid #000000; vertical-align:top">
                @if($detail && $detail->id)
                    <input type="hidden" name="{{ $inputName }}[id]" value="{{ $detail->id }}">
                @endif
                <input type="hidden" name="{{ $inputName }}[row_index]" value="{{ $i-1 }}">
                <input type="text"
                    step="any"
                  
                    class="number-only"
                    style="width:100%; height:100%; border:none; padding:4px 2px; font-size:9pt; text-align:center;"
                    name="{{ $inputName }}[titikUkurBeban]"
                    value="{{ old($inputName . '.titikUkurBeban', $detail->titikUkurBeban ?? '') }}"
                    placeholder="-">
            </td>

            <!-- Kode Anak Timbang — BISA HURUF + ANGKA -->
            <td colspan="2" style="border:1pt solid #000000; vertical-align:top; position: relative;">
                <div style="display: flex; align-items: center; gap: 4px; padding: 4px 8px;">
                    <div style="flex: 1; min-width: 0;">
                        <input type="hidden"
                               name="{{ $inputName }}[kodeStandard]"
                               id="sp_hidden_{{ $i }}"
                               value="{{ old($inputName . '.kodeStandard', $detail->kodeStandard ?? '') }}">
                        <div class="sp-wrapper"
                             data-id="{{ $i }}"
                             data-value="{{ old($inputName . '.kodeStandard', $detail->kodeStandard ?? '') }}"
                             style="min-height: 28px;">
                            <div class="sp-display" id="sp_display_{{ $i }}" style="min-height: 28px; padding: 2px 4px;">
                                <span class="sp-placeholder" id="sp_ph_{{ $i }}" style="font-size: 10px;">Pilih standar...</span>
                            </div>
                            <div class="sp-dropdown" id="sp_dd_{{ $i }}">
                                <input type="text" class="sp-search" placeholder="Cari kode..." id="sp_search_{{ $i }}">
                                <div class="sp-option-list" id="sp_list_{{ $i }}"></div>
                            </div>
                        </div>
                    </div>
                    
                    @if ($i > 1)
                    <button type="button" 
                            class="btn btn-sm btn-outline-secondary" 
                            onclick="copyStandar({{ $i - 1 }}, {{ $i }})"
                            title="Copy dari baris sebelumnya"
                            style="padding: 2px 6px; font-size: 10px;">
                        <i class="fas fa-copy"></i>
                    </button>
                    @endif
                </div>
            </td>

            <!-- Clockwise 1 -->
            <td style="border:1pt solid #000000; vertical-align:top">
                <input type="text"
                     
                  
                    class="number-only"
                    style="width:100%; height:100%; border:none; padding:4px; font-size:9pt; text-align:center;"
                    name="{{ $inputName }}[cw1]"
                    value="{{ old($inputName . '.cw1', $detail->cw1 ?? '') }}"
                    placeholder="-">
            </td>
            
            <!-- Clockwise 2 -->
            <td style="border:1pt solid #000000; vertical-align:top">
                <input type="text"
                     
                  
                    class="number-only"
                    style="width:100%; height:100%; border:none; padding:4px; font-size:9pt; text-align:center;"
                    name="{{ $inputName }}[cw2]"
                    value="{{ old($inputName . '.cw2', $detail->cw2 ?? '') }}"
                    placeholder="-">
            </td>
            
            <!-- Clockwise 3 -->
            <td style="border:1pt solid #000000; vertical-align:top">
                <input type="text"
                     
                  
                    class="number-only"
                    style="width:100%; height:100%; border:none; padding:4px; font-size:9pt; text-align:center;"
                    name="{{ $inputName }}[cw3]"
                    value="{{ old($inputName . '.cw3', $detail->cw3 ?? '') }}"
                    placeholder="-">
            </td>
            
            <!-- Counter Clockwise 1 -->
            <td style="border:1pt solid #000000; vertical-align:top">
                <input type="text"
                     
                  
                    class="number-only"
                    style="width:100%; height:100%; border:none; padding:4px; font-size:9pt; text-align:center;"
                    name="{{ $inputName }}[ccw1]"
                    value="{{ old($inputName . '.ccw1', $detail->ccw1 ?? '') }}"
                    placeholder="-">
            </td>
            
            <!-- Counter Clockwise 2 -->
            <td style="border:1pt solid #000000; vertical-align:top">
                <input type="text"
                     
                  
                    class="number-only"
                    style="width:100%; height:100%; border:none; padding:4px; font-size:9pt; text-align:center;"
                    name="{{ $inputName }}[ccw2]"
                    value="{{ old($inputName . '.ccw2', $detail->ccw2 ?? '') }}"
                    placeholder="-">
            </td>
            
            <!-- Counter Clockwise 3 -->
            <td style="border:1pt solid #000000; vertical-align:top">
                <input type="text"
                    "
                  
                    class="number-only"
                    style="width:100%; height:100%; border:none; padding:4px; font-size:9pt; text-align:center;"
                    name="{{ $inputName }}[ccw3]"
                    value="{{ old($inputName . '.ccw3', $detail->ccw3 ?? '') }}"
                    placeholder="-">
            </td>
        </tr>
    @endfor
</table>

<!-- Repeatability Clockwise - EDIT MODE -->
@php
    $addTorqueMeter = $calibration->addTorqueMeter ?? null;
@endphp

<p class="BodyText" style="margin-top:2pt; margin-left:2pt">
    <span style="letter-spacing:-0.1pt; font-size:9.5pt;">Repeatability Clockwise</span>
</p>

<table cellspacing="0" cellpadding="0" class="TableNormal" style="margin-left:0.6pt; border:1pt solid #000000; -aw-border-insideh:1pt single #000000; -aw-border-insidev:1pt single #000000; border-collapse:collapse; width: 100%; max-width: 450px;">
    <tr style="height:14pt">
        <td style="width:90pt; border-right-style:solid; border-right-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:top; padding:1px;">
            <input type="text" 
                   name="repCw01"
                   value="{{ $addTorqueMeter->repCw01 ?? '' }}"
                   style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                   placeholder="-">
        </td>
        <td style="width:45pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:top; padding:1px;">
            <input type="text" 
                   name="repCw02"
                   value="{{ $addTorqueMeter->repCw02 ?? '' }}"
                   style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                   placeholder="-">
        </td>
        <td style="width:45pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:top; padding:1px;">
            <input type="text" 
                   name="repCw03"
                   value="{{ $addTorqueMeter->repCw03 ?? '' }}"
                   style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                   placeholder="-">
        </td>
        <td style="width:45pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:top; padding:1px;">
            <input type="number" step="any"
                   name="repCw04"
                   value="{{ $addTorqueMeter->repCw04 ?? '' }}"
                   style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                   placeholder="-">
        </td>
        <td style="width:45pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:top; padding:1px;">
            <input type="text" 
                   name="repCw05"
                   value="{{ $addTorqueMeter->repCw05 ?? '' }}"
                   style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                   placeholder="-">
        </td>
    </tr>
    <tr style="height:14pt">
        <td style="width:90pt; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; vertical-align:top; padding:1px;">
            <input type="text" 
                   name="repCw06"
                   value="{{ $addTorqueMeter->repCw06 ?? '' }}"
                   style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                   placeholder="-">
        </td>
        <td style="width:45pt; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:top; padding:1px;">
            <input type="text" 
                   name="repCw07"
                   value="{{ $addTorqueMeter->repCw07 ?? '' }}"
                   style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                   placeholder="-">
        </td>
        <td style="width:45pt; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:top; padding:1px;">
            <input type="text" 
                   name="repCw08"
                   value="{{ $addTorqueMeter->repCw08 ?? '' }}"
                   style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                   placeholder="-">
        </td>
        <td style="width:45pt; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:top; padding:1px;">
            <input type="number" step="any"
                   name="repCw09"
                   value="{{ $addTorqueMeter->repCw09 ?? '' }}"
                   style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                   placeholder="-">
        </td>
        <td style="width:45pt; border-top-style:solid; border-top-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:top; padding:1px;">
            <input type="text" 
                   name="repCw10"
                   value="{{ $addTorqueMeter->repCw10 ?? '' }}"
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
                   value="{{ $addTorqueMeter->repCcw01 ?? '' }}"
                   style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                   placeholder="-">
        </td>
        <td style="width:45pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:top; padding:1px;">
            <input type="text" 
                   name="repCcw02"
                   value="{{ $addTorqueMeter->repCcw02 ?? '' }}"
                   style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                   placeholder="-">
        </td>
        <td style="width:45pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:top; padding:1px;">
            <input type="text" 
                   name="repCcw03"
                   value="{{ $addTorqueMeter->repCcw03 ?? '' }}"
                   style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                   placeholder="-">
        </td>
        <td style="width:45pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:top; padding:1px;">
            <input type="text" 
                   name="repCcw04"
                   value="{{ $addTorqueMeter->repCcw04 ?? '' }}"
                   style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                   placeholder="-">
        </td>
        <td style="width:45pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:top; padding:1px;">
            <input type="text" 
                   name="repCcw05"
                   value="{{ $addTorqueMeter->repCcw05 ?? '' }}"
                   style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                   placeholder="-">
        </td>
    </tr>
    <tr style="height:14pt">
        <td style="width:90pt; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; vertical-align:top; padding:1px;">
            <input type="text" 
                   name="repCcw06"
                   value="{{ $addTorqueMeter->repCcw06 ?? '' }}"
                   style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                   placeholder="-">
        </td>
        <td style="width:45pt; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:top; padding:1px;">
            <input type="number" step="any"
                   name="repCcw07"
                   value="{{ $addTorqueMeter->repCcw07 ?? '' }}"
                   style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                   placeholder="-">
        </td>
        <td style="width:45pt; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:top; padding:1px;">
            <input type="text" 
                   name="repCcw08"
                   value="{{ $addTorqueMeter->repCcw08 ?? '' }}"
                   style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                   placeholder="-">
        </td>
        <td style="width:45pt; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:top; padding:1px;">
            <input type="text" 
                   name="repCcw09"
                   value="{{ $addTorqueMeter->repCcw09 ?? '' }}"
                   style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                   placeholder="-">
        </td>
        <td style="width:45pt; border-top-style:solid; border-top-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:top; padding:1px;">
            <input type="number" step="any"
                   name="repCcw10"
                   value="{{ $addTorqueMeter->repCcw10 ?? '' }}"
                   style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;"
                   placeholder="-">
        </td>
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
            <p style="margin: 0 0 8px 0; font-size: 10pt; font-weight: bold;">Anak Timbang :</p>
            <div style="width:100%; min-height:160px; padding:8px; font-size:10pt; background-color:#fffff8; border:1px solid #ddd;">
    <textarea name="alat_standar_text"
        style="
            width:100%;
            min-height:140px;
            border:none;
            background:transparent;
            resize:none;
            outline:none;
            font-size:10pt;
        "
    >{{ old('standard', $calibration->headTorqueMeter->standard ?? '') }}</textarea>
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
        value="{{ old('calibratedBy', $calibration->calibratedBy ?? '') }}"
        style="
            width:100%;
            border:none;
            background:transparent;
            text-align:center;
            font-size:10pt;
            outline:none;
        ">
</div>

        </td>
        <td style="border: 1pt solid #000; padding: 12px 8px; text-align: center; vertical-align: middle;">
           <div style="width: 92%; border-bottom: 1px solid #000; padding: 6px 4px; font-size: 10pt; text-align: center; min-height: 30px;">
    <input type="text"
        name="verifiedBy"
        value="{{ old('verifiedBy', $calibration->verifiedBy ?? '') }}"
        style="
            width:100%;
            border:none;
            background:transparent;
            text-align:center;
            font-size:10pt;
            outline:none;
        " readonly>
</div>

        </td>
    </tr>

    <!-- BARIS TTD (VIEW MODE - tanpa garis TTD, hanya placeholder) -->
    <tr>
        <td style="border: 1pt solid #000; padding: 15px 8px; text-align: center; vertical-align: middle;">
            <strong>TTD :</strong><br>
            <div style="height: 70px; margin: 10px 15px; display: flex; align-items: center; justify-content: center;">
                <span style="color: #666; font-style: italic;">
                  
                </span>
            </div>
        </td>
        <td style="border: 1pt solid #000; padding: 15px 8px; text-align: center; vertical-align: middle;">
            <strong>TTD :</strong><br>
            <div style="height: 70px; margin: 10px 15px; display: flex; align-items: center; justify-content: center;">
                <span style="color: #666; font-style: italic;">
                  
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
            @if(isset($calibration) && $calibration->headTorqueMeter && $calibration->headTorqueMeter->calibrationMethod)
                {{ $calibration->headTorqueMeter->calibrationMethod }}
            @else
                PAS-IK1102-13B (ASTM D 3474-90 : 2018)
            @endif
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