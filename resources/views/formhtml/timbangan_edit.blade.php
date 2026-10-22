<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kalibrasi - PT. PANANJUNG ANUGRAH SOLUTION</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
    /* Pastikan semua text berwarna hitam */
    .form-kalibrasi-container,
    .form-kalibrasi-container *:not(input):not(select):not(textarea):not(button) {
        color: #000000 !important;
    }
    
    /* Input fields styling untuk edit */
    .kalibrasi-input {
        color: #000000 !important;
        border: 1px solid #ced4da !important;
        padding: 6px 10px;
        border-radius: 4px;
        width: 100%;
        background-color: #ffffff;
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
        background-color: #ffffff;
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

    /* Styling khusus untuk checkbox alat standar - ENABLED */
    .alat-standar-checkbox {
        width: 18px;
        height: 18px;
        margin: 0;
        cursor: pointer;
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
        background: #ffffff;
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

    .btn-success {
        background: linear-gradient(135deg, #10b981, #059669);
        border: none;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        transition: all 0.3s ease;
        color: white;
    }

    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        background: linear-gradient(135deg, #059669, #047857);
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

    /* Required field styling */
    .required-field::after {
        content: " *";
        color: #dc3545;
    }

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
        background: #e0f2fe;
        color: #0369a1;
        border: 1px solid #bae6fd;
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
        color: #ef4444;
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
    
    @keyframes flashGreen {
        0%, 100% { background-color: transparent; }
        50% { background-color: #d4edda; }
    }
    
    .copy-success-flash {
        animation: flashGreen 0.6s ease;
    }
    </style>
</head>
<body>
    <div class="container my-4">
        <form action="{{ route('calibrations.update', $calibration->id) }}" method="POST" id="editForm">
            @csrf
            @method('PUT')
            
            @php
                $jumlahForm = $calibration->jumlah_form ?? 1;
                $jumlahForm = max(1, min(4, $jumlahForm));
                $heads = $calibration->headTimbangan ?? collect();
                $details = $calibration->detailTimbangans ?? collect();
                $addDetails = $calibration->addTimbangan ?? collect();
            @endphp
            
            @for($formIndex = 1; $formIndex <= $jumlahForm; $formIndex++)
                @php
                    $head = $calibration->{'headTimbanganForm' . $formIndex};
                    $formDetails = $details->where('form_index', $formIndex)->sortBy('id');
                    $addData = $calibration->{'addTimbanganForm' . $formIndex};
                    $isFirstForm = ($formIndex == 1);
                @endphp
                
                @if($jumlahForm > 1)
                <div class="card mb-4" style="border: 2px solid #3b82f6; border-radius: 8px;">
                    <div class="card-header" style="background: linear-gradient(135deg, #1e40af, #3b82f6); color: white;">
                        <i class="fas fa-file-alt me-2"></i>Form Timbangan ke-{{ $formIndex }}
                        @if(!$isFirstForm)
                            <small class="ms-2">(Data alat mengikuti form 1)</small>
                        @endif
                    </div>
                    <div class="card-body">
                @endif
                
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
                                <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;">{{ $head->certificate_id ?? $calibration->headTimbangan->certificate_id ?? 'N/A' }}</p>
                            </td>
                        </tr>
                    </table>

                    <!-- Main Form Section -->
                    <table class="kalibrasi-main-table">
                        <!-- Nama Alat -->
                        <tr>
                            <td style="width: 20%;"><p class="required-field" style="margin:0; color:#000;">Nama Alat</p></td>
                            <td colspan="3">
                                @if($isFirstForm)
                                    <input type="text" class="kalibrasi-input" name="namaAlat" value="{{ old('namaAlat', $calibration->namaAlat) }}">
                                @else
                                    <input type="text" class="kalibrasi-input" value="{{ $calibration->namaAlat }}" readonly>
                                @endif
                            </td>
                        </tr>

                        <!-- Merek & Kode Alat -->
                        <tr>
                            <td><p class="required-field" style="margin:0; color:#000;">Merek</p></td>
                            <td colspan="3">
                                <div class="d-flex align-items-center">
                                    @if($isFirstForm)
                                        <input type="text" class="kalibrasi-input me-3" name="brandAlat" value="{{ old('brandAlat', $calibration->brandAlat) }}" style="width:60%;">
                                        <span class="me-3" style="color:#000;">Kode Alat :</span>
                                        <input type="text" class="kalibrasi-input" name="kodeAlat" value="{{ old('kodeAlat', $calibration->kodeAlat) }}" style="width:30%;">
                                    @else
                                        <input type="text" class="kalibrasi-input me-3" value="{{ $calibration->brandAlat }}" readonly style="width:60%;">
                                        <span class="me-3" style="color:#000;">Kode Alat :</span>
                                        <input type="text" class="kalibrasi-input" value="{{ $calibration->kodeAlat }}" readonly style="width:30%;">
                                    @endif
                                </div>
                            </td>
                        </tr>

                        <!-- Type / No. Seri -->
                        <tr>
                            <td><p class="required-field" style="margin:0; color:#000;">Type / No. Seri</p></td>
                            <td colspan="3">
                                <div class="d-flex align-items-center">
                                    @if($isFirstForm)
                                        <input type="text" class="kalibrasi-input me-3" name="typeAlat" value="{{ old('typeAlat', $calibration->typeAlat) }}" style="width:45%;">
                                        <span class="me-3" style="color:#000;">/</span>
                                        <input type="text" class="kalibrasi-input" name="NoSeri" value="{{ old('NoSeri', $calibration->NoSeri) }}" style="width:45%;">
                                    @else
                                        <input type="text" class="kalibrasi-input me-3" value="{{ $calibration->typeAlat }}" readonly style="width:45%;">
                                        <span class="me-3" style="color:#000;">/</span>
                                        <input type="text" class="kalibrasi-input" value="{{ $calibration->NoSeri }}" readonly style="width:45%;">
                                    @endif
                                </div>
                            </td>
                        </tr>

                        <!-- Kapasitas / Resolusi -->
                        <tr>
                            <td><p style="margin:0; color:#000;">Kapasitas / Resolusi</p></td>
                            <td colspan="3">
                                <div class="d-flex align-items-center">
                                    @if($isFirstForm)
                                        <input type="text" class="kalibrasi-input me-3" name="kapasitas" value="{{ old('kapasitas', $calibration->kapasitas) }}" style="width:45%;">
                                        <span class="me-3" style="color:#000;">/</span>
                                        <input type="text" class="kalibrasi-input" name="resolusi" value="{{ old('resolusi', $calibration->resolusi) }}" style="width:45%;">
                                    @else
                                        <input type="text" class="kalibrasi-input me-3" value="{{ $calibration->kapasitas }}" readonly style="width:45%;">
                                        <span class="me-3" style="color:#000;">/</span>
                                        <input type="text" class="kalibrasi-input" value="{{ $calibration->resolusi }}" readonly style="width:45%;">
                                    @endif
                                </div>
                            </td>
                        </tr>

                        <!-- Nama Pemilik -->
                        <tr>
                            <td><p class="required-field" style="margin:0; color:#000;">Nama Pemilik</p></td>
                            <td colspan="3">
                                @if($isFirstForm)
                                    <input type="text" class="kalibrasi-input" name="pemilikAlat" value="{{ old('pemilikAlat', $calibration->pemilikAlat) }}">
                                @else
                                    <input type="text" class="kalibrasi-input" value="{{ $calibration->pemilikAlat }}" readonly>
                                @endif
                            </td>
                        </tr>

                        <!-- Tanggal Alat Masuk -->
                        <tr>
                            <td><p class="required-field" style="margin:0; color:#000;">Tanggal Alat Masuk</p></td>
                            <td colspan="3">
                                @if($isFirstForm)
                                    <input type="date" class="kalibrasi-input" name="tanggalMasuk" value="{{ old('tanggalMasuk', $calibration->tanggalMasuk ? \Carbon\Carbon::parse($calibration->tanggalMasuk)->format('Y-m-d') : '') }}">
                                @else
                                    <input type="date" class="kalibrasi-input" value="{{ $calibration->tanggalMasuk ? \Carbon\Carbon::parse($calibration->tanggalMasuk)->format('Y-m-d') : '' }}" readonly>
                                @endif
                            </td>
                        </tr>

                        <!-- Tanggal Kalibrasi + Jenis Pembacaan -->
                        <tr>
                            <td><p class="required-field" style="margin:0; color:#000;">Tanggal Kalibrasi</p></td>
                            <td colspan="3">
                                <div class="d-flex align-items-center">
                                    @if($isFirstForm)
                                        <input type="date" class="kalibrasi-input me-3" name="tanggalKalibrasi" value="{{ old('tanggalKalibrasi', $calibration->tanggalKalibrasi ? \Carbon\Carbon::parse($calibration->tanggalKalibrasi)->format('Y-m-d') : '') }}" style="width:45%;">
                                        <span class="me-3" style="color:#000;">Jenis Pembacaan:</span>
                                        <input type="text" class="kalibrasi-input" name="jenisPembacaan" value="{{ old('jenisPembacaan', $calibration->jenisPembacaan) }}" style="width:45%;">
                                    @else
                                        <input type="date" class="kalibrasi-input me-3" value="{{ $calibration->tanggalKalibrasi ? \Carbon\Carbon::parse($calibration->tanggalKalibrasi)->format('Y-m-d') : '' }}" readonly style="width:45%;">
                                        <span class="me-3" style="color:#000;">Jenis Pembacaan:</span>
                                        <input type="text" class="kalibrasi-input" value="{{ $calibration->jenisPembacaan }}" readonly style="width:45%;">
                                    @endif
                                </div>
                            </td>
                        </tr>

                        <!-- Tempat Kalibrasi -->
                        <tr>
                            <td><p style="margin:0; color:#000;">Tempat Kalibrasi</p></td>
                            <td colspan="3">
                                @if($isFirstForm)
                                    @php $tempat = old('tempatKalibrasi', $calibration->tempatKalibrasi ?? ''); @endphp
                                    <div class="d-flex">
                                        <div class="form-check me-5">
                                            <input class="form-check-input" type="radio" name="tempatKalibrasi" value="lab.PT PAS" id="lab_{{ $formIndex }}" {{ $tempat == 'lab.PT PAS' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="lab_{{ $formIndex }}">Lab. PT.PAS</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tempatKalibrasi" value="insitu" id="insitu_{{ $formIndex }}" {{ $tempat == 'insitu' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="insitu_{{ $formIndex }}">Insitu</label>
                                        </div>
                                    </div>
                                @else
                                    <div class="d-flex">
                                        <div class="form-check me-5">
                                            <input class="form-check-input" type="radio" value="lab.PT PAS" disabled {{ $calibration->tempatKalibrasi == 'lab.PT PAS' ? 'checked' : '' }}>
                                            <label class="form-check-label">Lab. PT.PAS</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="insitu" disabled {{ $calibration->tempatKalibrasi == 'insitu' ? 'checked' : '' }}>
                                            <label class="form-check-label">Insitu</label>
                                        </div>
                                    </div>
                                @endif
                            </td>
                        </tr>

                        <!-- Lokasi PT -->
                        <tr>
                            <td><p style="margin:0; color:#000;">Lokasi PT</p></td>
                            <td colspan="3">
                                @if($isFirstForm)
                                    <input type="text" class="kalibrasi-input" name="lokasiPT" value="{{ old('lokasiPT', $calibration->lokasiPT) }}">
                                @else
                                    <input type="text" class="kalibrasi-input" value="{{ $calibration->lokasiPT }}" readonly>
                                @endif
                            </td>
                        </tr>
                        
                         <tr>
                            <td><p style="margin:0; color:#000;">Kode TH</p></td>
                            <td colspan="3">
                                @if($isFirstForm)
                                    <input type="text" class="kalibrasi-input" name="kode_th" value="{{ old('kode_th', $calibration->kode_th) }}">
                                @else
                                    <input type="text" class="kalibrasi-input" value="{{ $calibration->kode_th }}" readonly>
                                @endif
                            </td>
                        </tr>
                    </table>

                    <!-- Fungsi Komponen Lainnya & Kondisi Kalibrasi -->
                    <div class="row mt-4">
                        <!-- Fungsi Komponen Lainnya -->
                        <div class="col-md-6 mb-4">
                            <div class="kalibrasi-section-header" style="color: #000000;">Fungsi Komponen Lainnya</div>
                            
                            @if($isFirstForm)
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
                            
                            <div class="d-flex align-items-center">
                                <span class="fw-bold me-3" style="color: #000000; min-width: 100px;">Keterangan :</span>
                                <div style="flex: 1;">
                                    <input type="text" class="kalibrasi-input" name="keterangan" value="{{ old('keterangan', $calibration->keterangan ?? '-') }}" 
                                           style="border: none; border-bottom: 2px solid #000; border-radius: 0; padding: 4px 0; background: transparent; width: 100%;">
                                </div>
                            </div>
                            @else
                            <div class="d-flex justify-content-center align-items-center mb-4" style="gap: 60px;">
                                <div class="text-center">
                                    <span class="fw-bold d-block mb-2" style="color: #000000; font-size: 14px;">Ok</span>
                                    <input type="radio" value="ok" class="form-check-input" 
                                        style="width: 18px; height: 18px; display: block; margin: 0 auto;" disabled {{ $calibration->kondisiAlat == 'ok' ? 'checked' : '' }}>
                                </div>
                                <div class="text-center">
                                    <span class="fw-bold d-block mb-2" style="color: #000000; font-size: 14px;">Rusak</span>
                                    <input type="radio" value="rusak" class="form-check-input"
                                        style="width: 18px; height: 18px; display: block; margin: 0 auto;" disabled {{ $calibration->kondisiAlat == 'rusak' ? 'checked' : '' }}>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center">
                                <span class="fw-bold me-3" style="color: #000000; min-width: 100px;">Keterangan :</span>
                                <div style="flex: 1;">
                                    <input type="text" class="kalibrasi-input" value="{{ $calibration->keterangan ?? '-' }}" 
                                           style="border: none; border-bottom: 2px solid #000; border-radius: 0; padding: 4px 0; background: #e9ecef; width: 100%;" readonly>
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Kondisi Kalibrasi -->
                        <div class="col-md-6 mb-4">
                            <div class="kalibrasi-section-header" style="color: #000000;">Kondisi Kalibrasi</div>
                            
                            @if($isFirstForm)
                            <table class="table table-bordered">
                                <tr>
                                    <td class="table-secondary fw-bold" style="width: 30%; color: #000000;"></td>
                                    <td class="table-secondary fw-bold text-center" style="color: #000000;">Awal</td>
                                    <td class="table-secondary fw-bold text-center" style="color: #000000;">Tengah</td>
                                    <td class="table-secondary fw-bold text-center" style="color: #000000;">Akhir</td>
                                </tr>
                                <tr>
                                    <td class="bg-light fw-bold" style="color: #000000;">Suhu (℃)</td>
                                    <td><input type="number" class="kondisi-input" name="RT_condition1" value="{{ old('RT_condition1', $calibration->RT_condition1 ?? '') }}" step="0.1"></td>
                                    <td><input type="number" class="kondisi-input" name="RT_condition2" value="{{ old('RT_condition2', $calibration->RT_condition2 ?? '') }}" step="0.1"></td>
                                    <td><input type="number" class="kondisi-input" name="RT_condition3" value="{{ old('RT_condition3', $calibration->RT_condition3 ?? '') }}" step="0.1"></td>
                                </tr>
                                <tr>
                                    <td class="bg-light fw-bold" style="color: #000000;">RH (%)</td>
                                    <td><input type="number" class="kondisi-input" name="RH_condition1" value="{{ old('RH_condition1', $calibration->RH_condition1 ?? '') }}" step="0.1"></td>
                                    <td><input type="number" class="kondisi-input" name="RH_condition2" value="{{ old('RH_condition2', $calibration->RH_condition2 ?? '') }}" step="0.1"></td>
                                    <td><input type="number" class="kondisi-input" name="RH_condition3" value="{{ old('RH_condition3', $calibration->RH_condition3 ?? '') }}" step="0.1"></td>
                                </tr>
                            </table>
                            @else
                            <table class="table table-bordered">
                                <tr>
                                    <td class="table-secondary fw-bold" style="width: 30%; color: #000000;"></td>
                                    <td class="table-secondary fw-bold text-center" style="color: #000000;">Awal</td>
                                    <td class="table-secondary fw-bold text-center" style="color: #000000;">Tengah</td>
                                    <td class="table-secondary fw-bold text-center" style="color: #000000;">Akhir</td>
                                </tr>
                                <tr>
                                    <td class="bg-light fw-bold" style="color: #000000;">Suhu (℃)</td>
                                    <td><input type="number" class="kondisi-input" value="{{ $calibration->RT_condition1 ?? '' }}" step="0.1" readonly disabled style="background-color: #e9ecef;"></td>
                                    <td><input type="number" class="kondisi-input" value="{{ $calibration->RT_condition2 ?? '' }}" step="0.1" readonly disabled style="background-color: #e9ecef;"></td>
                                    <td><input type="number" class="kondisi-input" value="{{ $calibration->RT_condition3 ?? '' }}" step="0.1" readonly disabled style="background-color: #e9ecef;"></td>
                                </tr>
                                <tr>
                                    <td class="bg-light fw-bold" style="color: #000000;">RH (%)</td>
                                    <td><input type="number" class="kondisi-input" value="{{ $calibration->RH_condition1 ?? '' }}" step="0.1" readonly disabled style="background-color: #e9ecef;"></td>
                                    <td><input type="number" class="kondisi-input" value="{{ $calibration->RH_condition2 ?? '' }}" step="0.1" readonly disabled style="background-color: #e9ecef;"></td>
                                    <td><input type="number" class="kondisi-input" value="{{ $calibration->RH_condition3 ?? '' }}" step="0.1" readonly disabled style="background-color: #e9ecef;"></td>
                                </tr>
                            </table>
                            @endif
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
                                <input type="text" name="setengah_kap_max_{{ $formIndex }}"
                                       value="{{ $head->setengah_kapasitas ?? '' }}"
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
                                    <tr>
                                        <td style="border:2px solid #000; padding:0;">
                                            <input type="text" name="setengah_z1_{{ $formIndex }}_{{ $i }}" 
                                                   value="{{ $addData->{'HalfMax_z1_0'.$i} ?? '' }}" 
                                                   style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                                        </td>
                                        <td style="border:2px solid #000; padding:0;">
                                            <input type="text" name="setengah_m1_{{ $formIndex }}_{{ $i }}" 
                                                   value="{{ $addData->{'HalfMax_m1_0'.$i} ?? '' }}" 
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
                                <input type="text" name="kapasitas_max_{{ $formIndex }}"
                                       value="{{ $head->kapasitas_max ?? '' }}"
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
                                    <tr>
                                        <td style="border:2px solid #000; padding:0;">
                                            <input type="text" name="kapasitas_z1_{{ $formIndex }}_{{ $i }}" 
                                                   value="{{ $addData->{'FullMax_z1_0'.$i} ?? '' }}" 
                                                   style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                                        </td>
                                        <td style="border:2px solid #000; padding:0;">
                                            <input type="text" name="kapasitas_m1_{{ $formIndex }}_{{ $i }}" 
                                                   value="{{ $addData->{'FullMax_m1_0'.$i} ?? '' }}" 
                                                   style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                                        </td>
                                    </tr>
                                    @endfor
                                </table>
                            </td>

                            <!-- Blok Kanan: CATATAN PENTING -->
                            <td width="34%" valign="top">
                                <table style="border-collapse: collapse; width: 100%;">
                                    <tr>
                                        <td style="border:2px solid #000; background: #ffffff; text-align:center; padding:15px;">
                                            <b style="font-size: 18px;">CATATAN PENTING</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border:2px solid #000; background: #ffffff; padding:0; height: 500px;">
                                            <textarea name="catatan_penting_{{ $formIndex }}" style="width:100%; height:100%; border:none; background:transparent; padding:15px; resize:none; box-sizing:border-box;">{{ $head->note ?? '' }}</textarea>
                                        </td>
                                    </tr>
                                </table>
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
                                Standar Anak Timbangan yang Digunakan
                            </td>
                        </tr>

                        @for($i = 1; $i <= 10; $i++)
                            @php
                                $detail = $formDetails->skip($i - 1)->first();
                                $detailId = $detail->id ?? null;
                                
                                $titikUkur = old("titikUkur_{$formIndex}_" . ($i - 1), $detail->titikUkur ?? '');
                                $Lz1 = old("Lz1_{$formIndex}_" . ($i - 1), $detail->Lz1 ?? '');
                                $Lm1 = old("Lm1_{$formIndex}_" . ($i - 1), $detail->Lm1 ?? '');
                                $Rm1 = old("Rm1_{$formIndex}_" . ($i - 1), $detail->Rm1 ?? '');
                                $Rz1 = old("Rz1_{$formIndex}_" . ($i - 1), $detail->Rz1 ?? '');
                                $STD = old("STD_{$formIndex}_" . ($i - 1), $detail->STD ?? '');
                            @endphp
                            
                            <tr>
                                <td style="border:2px solid #000; padding:0;">
                                    @if($detailId)
                                        <input type="hidden" name="detail_ids_{{ $formIndex }}[]" value="{{ $detailId }}">
                                    @endif
                                    <input type="text" name="titikUkur_{{ $formIndex }}[]" value="{{ $titikUkur }}"
                                           style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                                </td>
                                <td style="border:2px solid #000; padding:0;">
                                    <input type="text" name="Lz1_{{ $formIndex }}[]" value="{{ $Lz1 }}"
                                           style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                                </td>
                                <td style="border:2px solid #000; padding:0;">
                                    <input type="text" name="Lm1_{{ $formIndex }}[]" value="{{ $Lm1 }}"
                                           style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                                </td>
                                <td style="border:2px solid #000; padding:0;">
                                    <input type="text" name="Rm1_{{ $formIndex }}[]" value="{{ $Rm1 }}"
                                           style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                                </td>
                                <td style="border:2px solid #000; padding:0;">
                                    <input type="text" name="Rz1_{{ $formIndex }}[]" value="{{ $Rz1 }}"
                                           style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                                </td>
                                <td style="border:2px solid #000; padding:0; position: relative;">
                                    <!-- Container flex untuk Standar Picker + Tombol Copy -->
                                    <div style="display: flex; align-items: center; gap: 4px; padding: 4px 8px;">
                                        <!-- Standar Picker Widget -->
                                        <div style="flex: 1; min-width: 0;">
                                            <input type="hidden"
                                                   name="STD_{{ $formIndex }}[]"
                                                   id="sp_hidden_{{ $formIndex }}_{{ $i }}"
                                                   value="{{ $STD }}">
                                            <div class="sp-wrapper"
                                                 data-id="{{ $formIndex }}_{{ $i }}"
                                                 data-value="{{ $STD }}"
                                                 style="min-height: 28px;">
                                                <div class="sp-display" id="sp_display_{{ $formIndex }}_{{ $i }}" style="min-height: 28px; padding: 2px 4px;">
                                                    <span class="sp-placeholder" id="sp_ph_{{ $formIndex }}_{{ $i }}" style="font-size: 10px;">Pilih standar...</span>
                                                </div>
                                                <div class="sp-dropdown" id="sp_dd_{{ $formIndex }}_{{ $i }}">
                                                    <input type="text" class="sp-search" placeholder="Cari kode..." id="sp_search_{{ $formIndex }}_{{ $i }}">
                                                    <div class="sp-option-list" id="sp_list_{{ $formIndex }}_{{ $i }}"></div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- 🔥 Tombol Copy (hanya untuk row > 1) -->
                                        @if($i > 1)
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-secondary copy-standar-btn" 
                                                onclick="copyStandarPicker({{ $formIndex }}, {{ $i - 1 }}, {{ $i }})"
                                                style="padding: 2px 6px; font-size: 10px; border-radius: 4px; flex-shrink: 0;"
                                                title="Copy dari baris sebelumnya">
                                            <i class="fas fa-copy"></i>
                                        </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforp
                    </table>
                    
                                        <!-- Off-Center Loading Test -->
                    <div style="margin-top: 40px; margin-bottom: 20px;"></div>

                    <p style="margin-left:12.2pt; font-size:12pt; font-weight:bold; font-style:italic;">Off-Center Loading Test</p>
                    <table border="0" cellpadding="0" cellspacing="0" style="margin-left:12.2pt; margin-bottom:1.75pt">
                        <tr>
                            <td>
                                Beban Timbangan 1/3 atau 1/2 dari Kapasitas Maksimal = 
                            </td>
                            <td>
                                <input type="text" name="beban_timbangan_{{ $formIndex }}" 
                                       value="{{ $addData->bebanOffCenter ?? '' }}"
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
                                <input type="text" name="beban_tengah_{{ $formIndex }}" 
                                       value="{{ $addData->offCenterMiddle ?? '' }}"
                                       style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="beban_depan_{{ $formIndex }}" 
                                       value="{{ $addData->offCenterFront ?? '' }}"
                                       style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="beban_belakang_{{ $formIndex }}" 
                                       value="{{ $addData->offCenterBack ?? '' }}"
                                       style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="beban_kanan_{{ $formIndex }}" 
                                       value="{{ $addData->offCenterRight ?? '' }}"
                                       style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="beban_kiri_{{ $formIndex }}" 
                                       value="{{ $addData->offCenterLeft ?? '' }}"
                                       style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                        </tr>
                    </table>

                    <p style="margin-top:0.35pt; font-size:9pt">&nbsp;</p>
                    <p style="margin-top:0.35pt; font-size:9pt">&nbsp;</p>

                                   <!-- Footer Section - ALAT STANDAR -->
                    <div class="data-complete-section">
                        <span class="data-complete-text">Data telah diisi dengan lengkap dan jelas!</span>
                    </div>

                    <table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 100%; margin-left:10.92pt; border:2px solid #000000;">
                        <tr>
                            <td colspan="5" style="border:2px solid #000; padding:12px; text-align:center; background-color:#f0f0f0;">
                                <font style="font-weight:bold; font-size:10pt;">Isilah lembar data kalibrasi dengan lengkap dan jelas!</font>
                            </font>
                        </td>
                    </tr>
                    
                    @php
                        // Ambil data standard dari head
                        $standardData = $head->standard ?? null;
                        $standardArray = [];
                        if ($standardData) {
                            if (is_array($standardData)) {
                                $standardArray = $standardData;
                            } elseif (is_string($standardData)) {
                                $decoded = json_decode($standardData, true);
                                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                                    $standardArray = $decoded;
                                } else {
                                    $standardArray = array_map('trim', explode(',', $standardData));
                                }
                            }
                        }
                    @endphp

                    @if($isFirstForm)
                        <!-- FORM 1 - BISA DIEDIT -->
                        <tr>
                            <td rowspan="1" style="border:2px solid #000; padding:8px; background-color:#f0f0f0; vertical-align:middle;">
                                <font style="font-weight:bold;">Peralatan Standard</font>
                            </td>
                            <td style="border:2px solid #000; padding:8px;">
                                <font>Anak Timbangan <i>class</i> :</font>
                            </td>
                            <td style="border:2px solid #000; padding:8px;">
                                <table border="0" cellpadding="0" cellspacing="5">
                                    <tr>
                                        <td style="padding:0 5px;">
                                            <input type="checkbox" name="alat_standar[]" value="E2" id="class_E2_{{ $formIndex }}" 
                                                {{ in_array('E2', $standardArray) ? 'checked' : '' }}>
                                            <label for="class_E2_{{ $formIndex }}">E2</label>
                                        </td>
                                        <td>/</td>
                                        <td style="padding:0 5px;">
                                            <input type="checkbox" name="alat_standar[]" value="F1" id="class_F1_{{ $formIndex }}" 
                                                {{ in_array('F1', $standardArray) ? 'checked' : '' }}>
                                            <label for="class_F1_{{ $formIndex }}">F1</label>
                                        </td>
                                        <td>/</td>
                                        <td style="padding:0 5px;">
                                            <input type="checkbox" name="alat_standar[]" value="F2" id="class_F2_{{ $formIndex }}" 
                                                {{ in_array('F2', $standardArray) ? 'checked' : '' }}>
                                            <label for="class_F2_{{ $formIndex }}">F2</label>
                                        </td>
                                        <td>/</td>
                                        <td style="padding:0 5px;">
                                            <input type="checkbox" name="alat_standar[]" value="M1" id="class_M1_{{ $formIndex }}" 
                                                {{ in_array('M1', $standardArray) ? 'checked' : '' }}>
                                            <label for="class_M1_{{ $formIndex }}">M1</label>
                                        </td>
                                        <td>/</td>
                                        <td style="padding:0 5px;">
                                            <input type="checkbox" name="alat_standar[]" value="M2" id="class_M2_{{ $formIndex }}" 
                                                {{ in_array('M2', $standardArray) ? 'checked' : '' }}>
                                            <label for="class_M2_{{ $formIndex }}">M2</label>
                                        </td>
                                        <td>/</td>
                                        <td style="padding:0 5px;">
                                            <input type="checkbox" name="alat_standar[]" value="M3" id="class_M3_{{ $formIndex }}" 
                                                {{ in_array('M3', $standardArray) ? 'checked' : '' }}>
                                            <label for="class_M3_{{ $formIndex }}">M3</label>
                                        </td>
                                    </tr>
                                </table>
                                <font size="1"><i>(centang pilihan)</i></font>
                            </td>
                            <td style="border:2px solid #000; padding:8px; text-align:center;">
                                <font style="font-weight:bold;">Dikalibrasi oleh</font><br><br>
                                <table border="1" cellpadding="0" cellspacing="0" style="width:100%; height:50px; border:1px solid #000; background-color:#fff;">
                                    <tr>
                                        <td style="text-align:center; vertical-align:bottom; padding:10px;">
                                            <font>TTD</font><br>
                                            <table border="0" cellpadding="0" cellspacing="0" style="width:100%; margin-top:5px;">
                                                <tr>
                                                    <td style="border-bottom:1px solid #000; padding:3px; text-align:center;">
                                                        <font size="2">{{ $head->ttd_kalibrator ?? '(...........................................)' }}</font>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <table border="1" cellpadding="0" cellspacing="0" style="width:100%; height:30px; border:1px solid #000; background-color:#fff; margin-top:5px;">
                                    <tr>
                                        <td style="padding:5px;">
                                            <input type="text" name="calibratedBy" class="kalibrasi-input" 
                                                  value="{{ old('calibratedBy', $calibration->calibratedBy ?? '') }}" 
                                                   placeholder="Nama" 
                                                   style="border: none; width: 100%; background-color: #f8f9fa;">
                                        </td>
                                    </tr>
                                </table>
                                <font>Nama</font>
                            </td>
                            <td style="border:2px solid #000; padding:8px; text-align:center;">
                                <font style="font-weight:bold;">Diperiksa oleh</font><br><br>
                                <table border="1" cellpadding="0" cellspacing="0" style="width:100%; height:50px; border:1px solid #000; background-color:#fff;">
                                    <tr>
                                        <td style="text-align:center; vertical-align:bottom; padding:10px;">
                                            <font>TTD</font><br>
                                            <table border="0" cellpadding="0" cellspacing="0" style="width:100%; margin-top:5px;">
                                                <tr>
                                                    <td style="border-bottom:1px solid #000; padding:3px; text-align:center;">
                                                        <font size="2">{{ $head->ttd_pemeriksa ?? '(...........................................)' }}</font>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <table border="1" cellpadding="0" cellspacing="0" style="width:100%; height:30px; border:1px solid #000; background-color:#fff; margin-top:5px;">
                                    <tr>
                                        <td style="padding:5px;">
                                            <input type="text" name="verifiedBy" id="verified_by_{{ $formIndex }}" 
                                                   style="width:100%; height:100%; border:none; text-align:center;" 
                                                   placeholder="-"   value="{{ old('verifiedBy', $calibration->verifiedBy ?? '') }}" readonly>
                                        </td>
                                    </tr>
                                </table>
                                <font>Nama</font>
                            </td>
                        </tr>
                    @else
                        <!-- FORM 2,3,4 - TAMPILAN DATA DARI FORM 1 (READONLY/DISABLED) -->
                        @php
                            $firstHead = $heads->where('form_index', 1)->first();
                            $firstStandardData = $firstHead->standard ?? null;
                            $firstStandardArray = [];
                            if ($firstStandardData) {
                                if (is_array($firstStandardData)) {
                                    $firstStandardArray = $firstStandardData;
                                } elseif (is_string($firstStandardData)) {
                                    $decoded = json_decode($firstStandardData, true);
                                    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                                        $firstStandardArray = $decoded;
                                    } else {
                                        $firstStandardArray = array_map('trim', explode(',', $firstStandardData));
                                    }
                                }
                            }
                        @endphp
                        <tr>
                            <td rowspan="1" style="border:2px solid #000; padding:8px; background-color:#f0f0f0; vertical-align:middle;">
                                <font style="font-weight:bold;">Peralatan Standard</font>
                            </td>
                            <td style="border:2px solid #000; padding:8px;">
                                <font>Anak Timbangan <i>class</i> :</font>
                            </td>
                            <td style="border:2px solid #000; padding:8px;">
                                <table border="0" cellpadding="0" cellspacing="5">
                                    <tr>
                                        <td style="padding:0 5px;">
                                            <input type="checkbox" disabled {{ in_array('E2', $firstStandardArray) ? 'checked' : '' }}>
                                            <label>E2</label>
                                        </td>
                                        <td>/</td>
                                        <td style="padding:0 5px;">
                                            <input type="checkbox" disabled {{ in_array('F1', $firstStandardArray) ? 'checked' : '' }}>
                                            <label>F1</label>
                                        </td>
                                        <td>/</td>
                                        <td style="padding:0 5px;">
                                            <input type="checkbox" disabled {{ in_array('F2', $firstStandardArray) ? 'checked' : '' }}>
                                            <label>F2</label>
                                        </td>
                                        <td>/</td>
                                        <td style="padding:0 5px;">
                                            <input type="checkbox" disabled {{ in_array('M1', $firstStandardArray) ? 'checked' : '' }}>
                                            <label>M1</label>
                                        </td>
                                        <td>/</td>
                                        <td style="padding:0 5px;">
                                            <input type="checkbox" disabled {{ in_array('M2', $firstStandardArray) ? 'checked' : '' }}>
                                            <label>M2</label>
                                        </td>
                                        <td>/</td>
                                        <td style="padding:0 5px;">
                                            <input type="checkbox" disabled {{ in_array('M3', $firstStandardArray) ? 'checked' : '' }}>
                                            <label>M3</label>
                                        </td>
                                    </tr>
                                </table>
                                <font size="1"><i>(centang pilihan)</i></font>
                            </td>
                            <td style="border:2px solid #000; padding:8px; text-align:center;">
                                <font style="font-weight:bold;">Dikalibrasi oleh</font><br><br>
                                <table border="1" cellpadding="0" cellspacing="0" style="width:100%; height:50px; border:1px solid #000; background-color:#fff;">
                                    <tr>
                                        <td style="text-align:center; vertical-align:bottom; padding:10px;">
                                            <font>TTD</font><br>
                                            <table border="0" cellpadding="0" cellspacing="0" style="width:100%; margin-top:5px;">
                                                <tr>
                                                    <td style="border-bottom:1px solid #000; padding:3px; text-align:center;">
                                                        <font size="2">{{ $firstHead->ttd_kalibrator ?? '(...........................................)' }}</font>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <table border="1" cellpadding="0" cellspacing="0" style="width:100%; height:30px; border:1px solid #000; background-color:#fff; margin-top:5px;">
                                    <tr>
                                        <td style="padding:5px;">
                                            <input type="text" class="kalibrasi-input" 
                                                   value="{{ $firstHead->calibrated_by ?? auth()->user()->nama ?? '' }}" 
                                                   style="border: none; width: 100%; background-color: #e9ecef;" readonly disabled>
                                        </td>
                                    </tr>
                                </table>
                                <font>Nama</font>
                            </td>
                            <td style="border:2px solid #000; padding:8px; text-align:center;">
                                <font style="font-weight:bold;">Diperiksa oleh</font><br><br>
                                <table border="1" cellpadding="0" cellspacing="0" style="width:100%; height:50px; border:1px solid #000; background-color:#fff;">
                                    <tr>
                                        <td style="text-align:center; vertical-align:bottom; padding:10px;">
                                            <font>TTD</font><br>
                                            <table border="0" cellpadding="0" cellspacing="0" style="width:100%; margin-top:5px;">
                                                <tr>
                                                    <td style="border-bottom:1px solid #000; padding:3px; text-align:center;">
                                                        <font size="2">{{ $firstHead->ttd_pemeriksa ?? '(...........................................)' }}</font>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <table border="1" cellpadding="0" cellspacing="0" style="width:100%; height:30px; border:1px solid #000; background-color:#fff; margin-top:5px;">
                                    <tr>
                                        <td style="padding:5px;">
                                            <input type="text" value="{{ $firstHead->verified_by ?? '' }}" 
                                                   style="width:100%; height:100%; border:none; text-align:center; background-color: #e9ecef;" readonly disabled>
                                        </td>
                                    </tr>
                                </table>
                                <font>Nama</font>
                            </td>
                        </tr>
                    @endif
                    
                    <tr>
                        <td style="border:2px solid #000; padding:8px; background-color:#f0f0f0; vertical-align:middle;">
                            <font style="font-weight:bold;">Metode Kalibrasi</font>
                        </td>
                        <td colspan="4" style="border:2px solid #000; padding:8px;">
                            <font>PAS-IK1102-15 (Monograph 4 : The Calibration of Weights and Balances, NMI Australia 2010)</font>
                        </td>
                    </tr>
                </table>
                   
                </div>
                
                @if($jumlahForm > 1)
                    </div> <!-- tutup card-body -->
                </div> <!-- tutup card -->
                @endif
            @endfor

            <!-- Action Buttons Section - DI LUAR LOOP -->
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
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('editForm')?.addEventListener('submit', function(e) {
            console.log('🎯 Edit form submission started...');
            
            const namaAlatInput = document.querySelector('input[name="namaAlat"]');
            console.log('Final value before submit:', namaAlatInput ? namaAlatInput.value : 'not found');
            
            // Basic validation
            let warningMessages = [];
            
            // 1. Validasi tanggal (jika diisi)
            const tanggalMasuk = document.querySelector('input[name="tanggalMasuk"]');
            const tanggalKalibrasi = document.querySelector('input[name="tanggalKalibrasi"]');
            
            if (tanggalMasuk && tanggalKalibrasi && tanggalMasuk.value && tanggalKalibrasi.value) {
                if (new Date(tanggalMasuk.value) > new Date(tanggalKalibrasi.value)) {
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
                
                setTimeout(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 10000);
            }
            
            return true;
        });
        
        // Additional debug on page load
        document.addEventListener('DOMContentLoaded', function() {
            console.log('📄 Edit form loaded for Timbangan ID:', {{ $calibration->id ?? 'null' }});
            console.log('🏷️ Certificate ID:', '{{ $calibration->headTimbangan->certificate_id ?? "N/A" }}');
            console.log('🔢 Detail records count:', {{ $calibration->detailTimbangans->count() }});
        });
    </script>

    <!-- Standar Picker JS IIFE -->
    <script>
    (function () {
        'use strict';

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
        var SP_MAX = Infinity;
        var activeDropdown = null;

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

        function getSpElements(wrapper) {
            if (!wrapper) return null;

            var parentTd = wrapper.closest('td') || wrapper.parentElement;
            var hidden = parentTd ? parentTd.querySelector('input[type="hidden"]') : null;
            var display = wrapper.querySelector('.sp-display');
            var ph = display ? display.querySelector('.sp-placeholder') : wrapper.querySelector('.sp-placeholder');

            var dd = wrapper._ddElement || wrapper.querySelector('.sp-dropdown');
            var id = wrapper.dataset.id;

            if (!dd && id) {
                dd = document.getElementById('sp_dd_' + id) || document.querySelector('[id^="sp_dd_' + id + '"]');
            }

            var search = dd ? dd.querySelector('.sp-search') : null;
            var listEl = dd ? dd.querySelector('.sp-option-list') : null;

            if (id) {
                if (!hidden) hidden = document.getElementById('sp_hidden_' + id) || document.querySelector('[id^="sp_hidden_' + id + '"]');
                if (!display) display = document.getElementById('sp_display_' + id) || document.querySelector('[id^="sp_display_' + id + '"]');
                if (!ph) ph = document.getElementById('sp_ph_' + id) || document.querySelector('[id^="sp_ph_' + id + '"]');
                if (dd) {
                    if (!search) search = dd.querySelector('.sp-search') || document.getElementById('sp_search_' + id) || document.querySelector('[id^="sp_search_' + id + '"]');
                    if (!listEl) listEl = dd.querySelector('.sp-option-list') || document.getElementById('sp_list_' + id) || document.querySelector('[id^="sp_list_' + id + '"]');
                }
            }

            return {
                hidden: hidden,
                display: display,
                ph: ph,
                dd: dd,
                search: search,
                listEl: listEl
            };
        }

        window.renderChips = function(wrapper, selected) {
            var els = getSpElements(wrapper);
            if (!els || !els.display || !els.ph || !els.hidden) {
                console.warn('Elements not found for wrapper:', wrapper);
                return;
            }
            var display = els.display;
            var ph = els.ph;
            var hidden = els.hidden;

            if (hidden.value) {
                var hiddenSelected = hidden.value.split('+').filter(Boolean);
                if (selected.length === 0 && hiddenSelected.length > 0) {
                    selected = hiddenSelected;
                }
            }

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
            var els = getSpElements(wrapper);
            if (!els || !els.listEl) return;
            buildOptionList(els.listEl, selected, els.search ? els.search.value : '');
            attachOptionClicks(els.listEl, wrapper, selected);
        }

        function attachOptionClicks(listEl, wrapper, selected) {
            listEl.querySelectorAll('.sp-option').forEach(function (opt) {
                opt.removeEventListener('click', opt._clickHandler);
                opt._clickHandler = function (e) {
                    e.stopPropagation();
                    var val = opt.dataset.value;

                    var els = getSpElements(wrapper);
                    if (els && els.hidden) {
                        var currentValue = els.hidden.value;
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

                    window.renderChips(wrapper, selected);
                    refreshDropdown(wrapper, selected);

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
            var els = getSpElements(wrapper);
            var dd = els ? els.dd : null;
            if (!dd) {
                console.warn('Dropdown element not found for wrapper:', wrapper);
                return;
            }
            wrapper._ddElement = dd;
            if (dd.parentElement !== document.body) {
                document.body.appendChild(dd);
            }
            positionDropdown(wrapper, dd);
            dd.classList.add('open');
            activeDropdown = wrapper;
            var search = els.search;
            if (search) {
                search.value = '';
                setTimeout(function() { search.focus(); }, 50);
            }
            refreshDropdown(wrapper, selected);
        }

        function closeDropdown(wrapper) {
            if (!wrapper) return;
            var els = getSpElements(wrapper);
            var dd = els ? els.dd : null;
            if (dd) dd.classList.remove('open');
            if (activeDropdown === wrapper) activeDropdown = null;
        }

        function initPicker(wrapper) {
            var els = getSpElements(wrapper);
            if (!els) return;

            var rawVal = wrapper.dataset.value || (els.hidden ? els.hidden.value : '');
            var selected = rawVal ? rawVal.split('+').map(function (s) { return s.trim(); }).filter(Boolean) : [];

            if (els.hidden && els.hidden.value && selected.length === 0) {
                selected = els.hidden.value.split('+').filter(Boolean);
                wrapper.dataset.value = els.hidden.value;
            }

            window.renderChips(wrapper, selected);

            if (els.search) {
                els.search.removeEventListener('input', els.search._spInputHandler);
                els.search._spInputHandler = function () {
                    refreshDropdown(wrapper, selected);
                };
                els.search.addEventListener('input', els.search._spInputHandler);

                els.search.removeEventListener('click', els.search._spClickHandler);
                els.search._spClickHandler = function (e) { e.stopPropagation(); };
                els.search.addEventListener('click', els.search._spClickHandler);

                els.search.removeEventListener('keydown', els.search._spKeyHandler);
                els.search._spKeyHandler = function (e) {
                    if (e.key === 'Escape') closeDropdown(wrapper);
                };
                els.search.addEventListener('keydown', els.search._spKeyHandler);
            }

            wrapper.removeEventListener('click', wrapper._clickHandler);
            wrapper._clickHandler = function (e) {
                var currentEls = getSpElements(wrapper);
                var dd = currentEls ? currentEls.dd : null;
                if (dd && dd.classList.contains('open')) {
                    closeDropdown(wrapper);
                } else {
                    openDropdown(wrapper, selected);
                }
            };
            wrapper.addEventListener('click', wrapper._clickHandler);
        }

        window.copyStandarPicker = function(formIndex, fromRow, toRow) {
            console.log('📋 Copy Standar dari row', fromRow, 'ke row', toRow);

            var sourceHidden = document.getElementById('sp_hidden_' + formIndex + '_' + fromRow);
            var targetHidden = document.getElementById('sp_hidden_' + formIndex + '_' + toRow);

            var sourceWrapper = sourceHidden ? sourceHidden.closest('td').querySelector('.sp-wrapper') : null;
            var targetWrapper = targetHidden ? targetHidden.closest('td').querySelector('.sp-wrapper') : null;

            if (!sourceWrapper) {
                document.querySelectorAll('.sp-wrapper').forEach(function(w) {
                    if (w.dataset.id === formIndex + '_' + fromRow || w.dataset.id === String(fromRow)) {
                        sourceWrapper = w;
                    }
                });
            }

            if (!targetWrapper) {
                document.querySelectorAll('.sp-wrapper').forEach(function(w) {
                    if (w.dataset.id === formIndex + '_' + toRow || w.dataset.id === String(toRow)) {
                        targetWrapper = w;
                    }
                });
            }

            if (!sourceWrapper) {
                console.error('❌ Source wrapper not found! Row:', fromRow);
                showToast('❌ Row ' + fromRow + ' tidak ditemukan!');
                return;
            }

            if (!targetWrapper) {
                console.error('❌ Target wrapper not found! Row:', toRow);
                showToast('❌ Row ' + toRow + ' tidak ditemukan!');
                return;
            }

            var sourceEls = getSpElements(sourceWrapper);
            var targetEls = getSpElements(targetWrapper);

            if (!sourceEls || !sourceEls.hidden || !targetEls || !targetEls.hidden) {
                console.error('❌ Hidden inputs not found for copy');
                showToast('❌ Data standar tidak ditemukan!');
                return;
            }

            var sourceValue = sourceEls.hidden.value;
            var selected = sourceValue ? sourceValue.split('+').filter(Boolean) : [];

            targetEls.hidden.value = selected.join('+');
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
                showToast('✅ Standar dari Row ' + fromRow + ' berhasil di-copy ke Row ' + toRow + ' (' + selected.join(', ') + ')');
            } else {
                showToast('ℹ️ Row ' + fromRow + ' kosong, tidak ada yang di-copy');
            }
        };

        window.copyStandarPickerToAll = function(formIndex, sourceRow) {
            sourceRow = sourceRow || 1;
            console.log('📋 Copy Standar dari row', sourceRow, 'ke SEMUA row');

            var sourceHidden = document.getElementById('sp_hidden_' + formIndex + '_' + sourceRow);
            var sourceWrapper = sourceHidden ? sourceHidden.closest('td').querySelector('.sp-wrapper') : null;

            if (!sourceWrapper) {
                document.querySelectorAll('.sp-wrapper').forEach(function(w) {
                    if (w.dataset.id === formIndex + '_' + sourceRow || w.dataset.id === String(sourceRow)) sourceWrapper = w;
                });
            }

            if (!sourceWrapper) {
                showToast('❌ Row ' + sourceRow + ' tidak ditemukan!');
                return;
            }

            var sourceEls = getSpElements(sourceWrapper);
            if (!sourceEls || !sourceEls.hidden) {
                showToast('❌ Data standar tidak ditemukan!');
                return;
            }

            var sourceValue = sourceEls.hidden.value;
            var selected = sourceValue ? sourceValue.split('+').filter(Boolean) : [];

            var successCount = 0;
            for (var targetRow = 1; targetRow <= 10; targetRow++) {
                if (targetRow === sourceRow) continue;

                var targetHidden = document.getElementById('sp_hidden_' + formIndex + '_' + targetRow);
                var targetWrapper = targetHidden ? targetHidden.closest('td').querySelector('.sp-wrapper') : null;
                if (!targetWrapper) {
                    document.querySelectorAll('.sp-wrapper').forEach(function(w) {
                        if (w.dataset.id === formIndex + '_' + targetRow || w.dataset.id === String(targetRow)) targetWrapper = w;
                    });
                }

                if (targetWrapper) {
                    var targetEls = getSpElements(targetWrapper);
                    if (targetEls && targetEls.hidden) {
                        targetEls.hidden.value = selected.join('+');
                        targetWrapper.dataset.value = selected.join('+');
                        window.renderChips(targetWrapper, selected);
                        refreshDropdown(targetWrapper, selected);

                        if (targetEls.display) {
                            var parentTd = targetEls.display.closest('td');
                            if (parentTd) {
                                parentTd.classList.add('copy-success-flash');
                                (function(td) {
                                    setTimeout(function() { td.classList.remove('copy-success-flash'); }, 500);
                                })(parentTd);
                            }
                        }
                        successCount++;
                    }
                }
            }

            if (selected.length > 0) {
                showToast('✅ Standar dari Row ' + sourceRow + ' berhasil di-copy ke ' + successCount + ' baris! (' + selected.join(', ') + ')');
            } else {
                showToast('ℹ️ Row ' + sourceRow + ' kosong, tidak ada data untuk di-copy.');
            }
        };

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

        function initAllPickers() {
            console.log('🚀 Initializing Standar Pickers in Edit Form...');
            var wrappers = document.querySelectorAll('.sp-wrapper');
            console.log('📦 Found ' + wrappers.length + ' picker(s)');

            wrappers.forEach(function(wrapper) {
                initPicker(wrapper);
            });
        }

        window.initAllStandarPickers = initAllPickers;

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initAllPickers);
        } else {
            initAllPickers();
        }

        document.addEventListener('click', function(e) {
            if (!activeDropdown) return;
            var els = getSpElements(activeDropdown);
            var dd = els ? els.dd : null;
            if (!activeDropdown.contains(e.target) && dd && !dd.contains(e.target)) {
                closeDropdown(activeDropdown);
            }
        });

        window.addEventListener('scroll', function() {
            if (activeDropdown) {
                var els = getSpElements(activeDropdown);
                var dd = els ? els.dd : null;
                if (dd) positionDropdown(activeDropdown, dd);
            }
        }, true);

        window.addEventListener('resize', function() {
            if (activeDropdown) {
                var els = getSpElements(activeDropdown);
                var dd = els ? els.dd : null;
                if (dd) positionDropdown(activeDropdown, dd);
            }
        });
    })();
    </script>
</body>
</html>