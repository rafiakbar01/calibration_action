<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Kalibrasi Climatic Chamber - PT. PANANJUNG ANUGRAH SOLUTION</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

    .form-check-input[type="radio"]:checked {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='2' fill='%23fff'/%3e%3c/svg%3e") !important;
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

    /* Button styling */
    .btn-primary {
        background: linear-gradient(135deg, #3b82f6, #1e40af);
        border: none;
        color: white;
    }

    .btn-success {
        background: linear-gradient(135deg, #10b981, #059669);
        border: none;
        color: white;
    }

    .btn-secondary {
        background: linear-gradient(135deg, #6b7280, #4b5563);
        border: none;
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
    .alat-standar-table {
        width: 100%;
        border-collapse: collapse;
    }

    .alat-standar-table td {
        border: 1px solid #000;
        padding: 8px;
        vertical-align: middle;
    }

    /* Form card styling untuk multiple forms */
    .form-card {
        border: 2px solid #3b82f6;
        border-radius: 8px;
        margin-bottom: 24px;
        background: white;
    }

    .form-card-header {
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        color: white;
        padding: 12px 20px;
        border-radius: 6px 6px 0 0;
        font-weight: bold;
        font-size: 16px;
    }

    .form-card-body {
        padding: 20px;
    }

    /* Alat standar checkbox */
    .alat-standar-checkbox {
        width: 18px;
        height: 18px;
        margin: 0;
        cursor: pointer;
    }

    /* Print styling */
    @media print {
        .btn { display: none !important; }
        .form-card { border: 1px solid #000; break-inside: avoid; }
        .form-card-header { background: #f0f0f0 !important; color: #000 !important; }
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .kalibrasi-main-table td { padding: 4px; }
        .data-kalibrasi-header { font-size: 16px; }
        .btn-lg { padding: 10px 20px !important; font-size: 14px !important; }
    }

    /* Required field styling */
    .required-field::after {
        content: " *";
        color: #dc3545;
    }

    /* Table Normal styling */
    .TableNormal {
        border-collapse: collapse;
        width: 100%;
    }

    .TableNormal td, .TableNormal th {
        border: 0.75pt solid #000000;
        vertical-align: middle;
    }
    </style>
</head>
<body>
    <div class="container my-4" style="width: 95%; max-width: 1600px;">
        <form action="{{ route('calibrations.update', $calibration->id) }}" method="POST" id="editForm">
            @csrf
            @method('PUT')
            
            @php
                $jumlahForm = request()->query('jumlah_form', $calibration->jumlah_form ?? 1);
                $jumlahForm = max(1, (int)$jumlahForm);
                $head = $calibration->headChamber;
                $details = $calibration->detailChambers ?? collect();
                $addChambers = $calibration->addChamber  ?? collect();
            @endphp
            
            <input type="hidden" name="jumlah_form" value="{{ $jumlahForm }}">

            <!-- Pilihan Jumlah Form - UNLIMITED -->
            <div class="card mb-4 border-primary shadow-sm">
                <div class="card-body bg-light">
                    <div class="row align-items-center g-3">
                        <div class="col-md-6">
                            <label for="jumlah_form_input" class="form-label fw-bold mb-0 text-black">
                                <i class="fas fa-copy text-primary me-2"></i>Jumlah Form
                            </label>
                            <span class="badge bg-primary ms-2" id="formCountBadge">{{ $jumlahForm }} Form</span>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center gap-2 flex-wrap">
                                <button type="button" class="btn btn-outline-danger" id="btnKurangForm" {{ $jumlahForm <= 1 ? 'disabled' : '' }}>
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" id="jumlah_form_input" name="jumlah_form" class="form-control text-center" 
                                       value="{{ $jumlahForm }}" min="1" readonly style="max-width: 80px;">
                                <button type="button" class="btn btn-outline-success" id="btnTambahForm">
                                    <i class="fas fa-plus"></i>
                                </button>
                                <button type="button" class="btn btn-primary" id="btnChangeJumlahForm">
                                    <i class="fas fa-sync-alt me-1"></i> Ubah
                                </button>
                            </div>
                            <small class="text-muted d-block mt-1" style="font-size: 11px;">
                                <i class="fas fa-info-circle me-1"></i> Jumlah form tidak terbatas. Klik + untuk menambah, - untuk mengurangi.
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            
            @for($formIndex = 1; $formIndex <= $jumlahForm; $formIndex++)
                @php
                    $isFirstForm = ($formIndex == 1);
                    $formAddChambers = $addChambers->where('form_index', $formIndex)->sortBy('repetition_number');
                    $formDetails = $details->where('form_index', $formIndex);
                @endphp
                
                @if($jumlahForm > 1)
                <div class="form-card">
                    <div class="form-card-header">
                        <i class="fas fa-file-alt me-2"></i>
                        Form Chamber ke-{{ $formIndex }}
                        @if(!$isFirstForm)
                            <small class="ms-2">(Data alat mengikuti form 1)</small>
                        @endif
                    </div>
                    <div class="form-card-body">
                @endif
                
                <div class="form-kalibrasi-container">
                    <!-- Header Table -->
                    <table class="kalibrasi-header-table">
                        <tr>
                            <td colspan="2">
                                <p style="margin: 0; font-size: 14px;">PAS-FLK29B</p>
                            </td>
                            <td rowspan="5" style="text-align: center; vertical-align: middle; padding: 10px 0;">
                                <div style="display: inline-block; text-align: center;">
                                    <div style="margin-bottom: 15px;">
                                        <img src="/logo/logo_pas_basic.png" alt="Logo PT. PAS" style="width: 107px; height: 54px; display: block; margin: 0 auto;">
                                    </div>
                                    <p style="font-weight: bold; margin: 0; font-size: 15px;">PT. PANANJUNG ANUGRAH SOLUTION</p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p style="margin: 0; font-size: 14px;">LEMBAR KERJA KALIBRASI</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p style="margin: 0; font-weight: bold; font-size: 14px;">CLIMATIC CHAMBER</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="height: 10px;"></td>
                        </tr>
                        <tr>
                            <td style="width: 25%;">
                                <p style="margin: 0; font-size: 14px;">No. Sertifikat</p>
                            </td>
                            <td style="width: 45%;">
                                <p style="margin: 0; font-size: 14px; font-weight: bold;">
                                    {{ $head->certificate_id ?? 'N/A' }}
                                </p>
                            </td>
                        </tr>
                    </table>

                    <!-- Main Form Section -->
                    <table class="kalibrasi-main-table">
                        <!-- Nama Alat -->
                        <tr>
                            <td style="width: 20%;"><p class="required-field" style="margin:0;">Nama Alat</p></td>
                            <td colspan="3">
                                @if($isFirstForm)
                                    <input type="text" class="kalibrasi-input" name="namaAlat" value="{{ old('namaAlat', $calibration->namaAlat) }}">
                                @else
                                    <input type="text" class="kalibrasi-input" value="" readonly disabled style="background-color: #e9ecef;">
                                @endif
                            </td>
                        </tr>

                        <!-- Merek & Kode Alat -->
                        <tr>
                            <td><p class="required-field" style="margin:0;">Merek</p></td>
                            <td colspan="3">
                                <div class="d-flex align-items-center">
                                    @if($isFirstForm)
                                        <input type="text" class="kalibrasi-input me-3" name="brandAlat" value="{{ old('brandAlat', $calibration->brandAlat) }}" style="width: 60%;">
                                        <span class="me-3">Kode Alat :</span>
                                        <input type="text" class="kalibrasi-input" name="kodeAlat" value="{{ old('kodeAlat', $calibration->kodeAlat) }}" style="width: 30%;">
                                    @else
                                        <input type="text" class="kalibrasi-input me-3" value="" readonly disabled style="width: 60%; background-color: #e9ecef;">
                                        <span class="me-3">Kode Alat :</span>
                                        <input type="text" class="kalibrasi-input" value="" readonly disabled style="width: 30%; background-color: #e9ecef;">
                                    @endif
                                </div>
                            </td>
                        </tr>

                        <!-- Type / No. Seri -->
                        <tr>
                            <td><p class="required-field" style="margin:0;">Type / No. Seri</p></td>
                            <td colspan="3">
                                <div class="d-flex align-items-center">
                                    @if($isFirstForm)
                                        <input type="text" class="kalibrasi-input me-3" name="typeAlat" value="{{ old('typeAlat', $calibration->typeAlat) }}" style="width: 45%;">
                                        <span class="me-3">/</span>
                                        <input type="text" class="kalibrasi-input" name="NoSeri" value="{{ old('NoSeri', $calibration->NoSeri) }}" style="width: 45%;">
                                    @else
                                        <input type="text" class="kalibrasi-input me-3" value="" readonly disabled style="width: 45%; background-color: #e9ecef;">
                                        <span class="me-3">/</span>
                                        <input type="text" class="kalibrasi-input" value="" readonly disabled style="width: 45%; background-color: #e9ecef;">
                                    @endif
                                </div>
                            </td>
                        </tr>

                        <!-- Kapasitas / Resolusi -->
                        <tr>
                            <td><p style="margin:0;">Kapasitas / Resolusi</p></td>
                            <td colspan="3">
                                <div class="d-flex align-items-center">
                                    @if($isFirstForm)
                                        <input type="text" class="kalibrasi-input me-3" name="kapasitas" value="{{ old('kapasitas', $calibration->kapasitas) }}" style="width: 45%;">
                                        <span class="me-3">/</span>
                                        <input type="text" class="kalibrasi-input" name="resolusi" value="{{ old('resolusi', $calibration->resolusi) }}" style="width: 45%;">
                                    @else
                                        <input type="text" class="kalibrasi-input me-3" value="" readonly disabled style="width: 45%; background-color: #e9ecef;">
                                        <span class="me-3">/</span>
                                        <input type="text" class="kalibrasi-input" value="" readonly disabled style="width: 45%; background-color: #e9ecef;">
                                    @endif
                                </div>
                            </td>
                        </tr>

                        <!-- Nama Pemilik -->
                        <tr>
                            <td><p class="required-field" style="margin:0;">Nama Pemilik</p></td>
                            <td colspan="3">
                                @if($isFirstForm)
                                    <input type="text" class="kalibrasi-input" name="pemilikAlat" value="{{ old('pemilikAlat', $calibration->pemilikAlat) }}">
                                @else
                                    <input type="text" class="kalibrasi-input" value="" readonly disabled style="background-color: #e9ecef;">
                                @endif
                            </td>
                        </tr>

                        <!-- Tanggal Alat Masuk -->
                        <tr>
                            <td><p class="required-field" style="margin:0;">Tanggal Alat Masuk</p></td>
                            <td colspan="3">
                                @if($isFirstForm)
                                    <input type="date" class="kalibrasi-input" name="tanggalMasuk" value="{{ old('tanggalMasuk', $calibration->tanggalMasuk ? \Carbon\Carbon::parse($calibration->tanggalMasuk)->format('Y-m-d') : '') }}">
                                @else
                                    <input type="date" class="kalibrasi-input" value="" readonly disabled style="background-color: #e9ecef;">
                                @endif
                            </td>
                        </tr>

                        <!-- Tanggal Kalibrasi + Jenis Pembacaan -->
                        <tr>
                            <td><p class="required-field" style="margin:0;">Tanggal Kalibrasi</p></td>
                            <td colspan="3">
                                <div class="d-flex align-items-center">
                                    @if($isFirstForm)
                                        <input type="date" class="kalibrasi-input me-3" name="tanggalKalibrasi" value="{{ old('tanggalKalibrasi', $calibration->tanggalKalibrasi ? \Carbon\Carbon::parse($calibration->tanggalKalibrasi)->format('Y-m-d') : '') }}" style="width: 45%;">
                                        <span class="me-3">Jenis Pembacaan:</span>
                                        <input type="text" class="kalibrasi-input" name="jenisPembacaan" value="{{ old('jenisPembacaan', $calibration->jenisPembacaan) }}" style="width: 45%;">
                                    @else
                                        <input type="date" class="kalibrasi-input me-3" value="" readonly disabled style="width: 45%; background-color: #e9ecef;">
                                        <span class="me-3">Jenis Pembacaan:</span>
                                        <input type="text" class="kalibrasi-input" value="" readonly disabled style="width: 45%; background-color: #e9ecef;">
                                    @endif
                                </div>
                            </td>
                        </tr>

                        <!-- Tempat Kalibrasi -->
                        <tr>
                            <td><p style="margin:0;">Tempat Kalibrasi</p></td>
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
                                            <input class="form-check-input" type="radio" disabled>
                                            <label class="form-check-label">Lab. PT.PAS</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" disabled>
                                            <label class="form-check-label">Insitu</label>
                                        </div>
                                    </div>
                                @endif
                            </td>
                        </tr>

                        <!-- Lokasi PT -->
                        <tr>
                            <td><p style="margin:0;">Lokasi PT</p></td>
                            <td colspan="3">
                                @if($isFirstForm)
                                    <input type="text" class="kalibrasi-input" name="lokasiPT" value="{{ old('lokasiPT', $calibration->lokasiPT) }}">
                                @else
                                    <input type="text" class="kalibrasi-input" value="" readonly disabled style="background-color: #e9ecef;">
                                @endif
                            </td>
                        </tr>
                        
                         <tr>
                            <td><p style="margin:0;">Kode TH</p></td>
                            <td colspan="3">
                                @if($isFirstForm)
                                    <input type="text" class="kalibrasi-input" name="kode_th" value="{{ old('kode_th', $calibration->kode_th) }}">
                                @else
                                    <input type="text" class="kalibrasi-input" value="" readonly disabled style="background-color: #e9ecef;">
                                @endif
                            </td>
                        </tr>
                    </table>

                    <!-- Fungsi Komponen Lainnya & Kondisi Kalibrasi -->
                    <div class="row mt-4">
                        <div class="col-md-6 mb-4">
                            <div class="kalibrasi-section-header">Fungsi Komponen Lainnya</div>
                            
                            @if($isFirstForm)
                            <div class="d-flex justify-content-center align-items-center mb-4" style="gap: 60px;">
                                <div class="text-center">
                                    <span class="fw-bold d-block mb-2">Ok</span>
                                    <input type="radio" name="kondisiAlat" value="ok" class="form-check-input" 
                                        style="width: 18px; height: 18px; display: block; margin: 0 auto;"
                                        {{ old('kondisiAlat', $calibration->kondisiAlat) == 'ok' ? 'checked' : '' }}>
                                </div>
                                <div class="text-center">
                                    <span class="fw-bold d-block mb-2">Rusak</span>
                                    <input type="radio" name="kondisiAlat" value="rusak" class="form-check-input"
                                        style="width: 18px; height: 18px; display: block; margin: 0 auto;"
                                        {{ old('kondisiAlat', $calibration->kondisiAlat) == 'rusak' ? 'checked' : '' }}>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center">
                                <span class="fw-bold me-3" style="min-width: 100px;">Keterangan :</span>
                                <div style="flex: 1;">
                                    <input type="text" class="kalibrasi-input" name="keterangan" value="{{ old('keterangan', $calibration->keterangan ?? '') }}" 
                                           style="border: none; border-bottom: 2px solid #000; border-radius: 0; padding: 4px 0; background: transparent; width: 100%;">
                                </div>
                            </div>
                            @else
                            <div class="d-flex justify-content-center align-items-center mb-4" style="gap: 60px;">
                                <div class="text-center">
                                    <span class="fw-bold d-block mb-2">Ok</span>
                                    <input type="radio" class="form-check-input" disabled style="width: 18px; height: 18px;">
                                </div>
                                <div class="text-center">
                                    <span class="fw-bold d-block mb-2">Rusak</span>
                                    <input type="radio" class="form-check-input" disabled style="width: 18px; height: 18px;">
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="fw-bold me-3" style="min-width: 100px;">Keterangan :</span>
                                <div style="flex: 1;">
                                    <input type="text" class="kalibrasi-input" value="" readonly disabled style="background-color: #e9ecef;">
                                </div>
                            </div>
                            @endif
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="kalibrasi-section-header">Kondisi Kalibrasi</div>
                            
                            @if($isFirstForm)
                            <table class="table table-bordered">
                                <tr>
                                    <td class="table-secondary fw-bold" style="width: 30%;"></td>
                                    <td class="table-secondary fw-bold text-center">Awal</td>
                                    <td class="table-secondary fw-bold text-center">Tengah</td>
                                    <td class="table-secondary fw-bold text-center">Akhir</td>
                                </tr>
                                <tr>
                                    <td class="bg-light fw-bold">Suhu (°C)</td>
                                    <td><input type="number" step="any" name="RT_condition1" class="kondisi-input" value="{{ old('RT_condition1', $calibration->RT_condition1 ?? '') }}"></td>
                                    <td><input type="number" step="any" name="RT_condition2" class="kondisi-input" value="{{ old('RT_condition2', $calibration->RT_condition2 ?? '') }}"></td>
                                    <td><input type="number" step="any" name="RT_condition3" class="kondisi-input" value="{{ old('RT_condition3', $calibration->RT_condition3 ?? '') }}"></td>
                                </tr>
                                <tr>
                                    <td class="bg-light fw-bold">RH (%)</td>
                                    <td><input type="number" step="any" name="RH_condition1" class="kondisi-input" value="{{ old('RH_condition1', $calibration->RH_condition1 ?? '') }}"></td>
                                    <td><input type="number" step="any" name="RH_condition2" class="kondisi-input" value="{{ old('RH_condition2', $calibration->RH_condition2 ?? '') }}"></td>
                                    <td><input type="number" step="any" name="RH_condition3" class="kondisi-input" value="{{ old('RH_condition3', $calibration->RH_condition3 ?? '') }}"></td>
                                </tr>
                            </table>
                            @else
                            <table class="table table-bordered">
                                <tr>
                                    <td class="table-secondary fw-bold" style="width: 30%;"></td>
                                    <td class="table-secondary fw-bold text-center">Awal</td>
                                    <td class="table-secondary fw-bold text-center">Tengah</td>
                                    <td class="table-secondary fw-bold text-center">Akhir</td>
                                </tr>
                                <tr>
                                    <td class="bg-light fw-bold">Suhu (°C)</td>
                                    <td><input type="number" class="kondisi-input" value="" readonly disabled style="background-color: #e9ecef;"></td>
                                    <td><input type="number" class="kondisi-input" value="" readonly disabled style="background-color: #e9ecef;"></td>
                                    <td><input type="number" class="kondisi-input" value="" readonly disabled style="background-color: #e9ecef;"></td>
                                </tr>
                                <tr>
                                    <td class="bg-light fw-bold">RH (%)</td>
                                    <td><input type="number" class="kondisi-input" value="" readonly disabled style="background-color: #e9ecef;"></td>
                                    <td><input type="number" class="kondisi-input" value="" readonly disabled style="background-color: #e9ecef;"></td>
                                    <td><input type="number" class="kondisi-input" value="" readonly disabled style="background-color: #e9ecef;"></td>
                                </tr>
                            </table>
                            @endif
                        </div>
                    </div>

                    <!-- DATA KALIBRASI Section -->
                    <div class="data-kalibrasi-header">DATA KALIBRASI</div>
                    
                    <!-- Penempatan Sensor -->
                    <ol type="1" style="margin:0pt; padding-left:0pt">
                        <li class="ListParagraph" style="margin-top:0.5pt; margin-left:10.05pt; text-indent:0pt; font-size:11pt; font-weight:bold; letter-spacing:-0.1pt">
                            <span>Penempatan</span>
                            <span style="letter-spacing:-0.05pt"></span>
                            <span>Sensor</span>
                        </li>
                    </ol>

                    <p style="margin-left:0.05pt; font-size:10pt">
                        <div style="display: inline-block; vertical-align: top; text-align: center; margin-right: 20px;">
                            <img src="/logo/foto_rektangular.png" width="350" height="190" alt="" 
                                style="border: 2px solid #000000; padding: 5px;" />
                            <div style="margin-top: 8px; font-family: Arial; font-size: 9pt; font-weight: bold; color: #000000; text-align: center;">
                                Rektangular
                            </div>
                        </div>
                        
                        <span style="width:359.85pt; font-family:Arial; display:inline-block;">&#xa0;</span>
                        
                        <div style="display: inline-block; vertical-align: top; text-align: center; margin-left: 20px;">
                            <img src="/logo/foto_silindrik.png" width="240" height="190" alt="" 
                                style="border: 2px solid #000000; padding: 5px;" />
                            <div style="margin-top: 8px; font-family: Arial; font-size: 9pt; font-weight: bold; color: #000000; text-align: center;">
                                Silindrik atau Sferik
                            </div>
                        </div>
                    </p>

                    @php
                        // Interval waktu
                        $interval_waktu = [1, 2, 3, 4, 5, 13, 20, 30];
                        
                        // Proses data existing
                        $tsettingValues = [];
                        $repetition = 1;
                        $detailsByRepetition = [];
                        
                        // Cari data addChambers untuk tsetting
                        if ($formAddChambers->count() > 0) {
                            foreach ($formAddChambers as $add) {
                                $repNum = $add->repetition_number ?? 1;
                                $tsettingValues[$repNum] = $add->Tsetting ?? $add->tsetting ?? $add->t_setting ?? '';
                                if ($repNum > $repetition) $repetition = $repNum;
                            }
                        }
                        
                        // Cari data details untuk pembacaan
                        if ($formDetails->count() > 0) {
                            foreach ($formDetails as $detail) {
                                $repNum = $detail->repetition_number ?? 1;
                                $intervalNum = $detail->interval_number ?? 1;
                                if (!isset($detailsByRepetition[$repNum])) {
                                    $detailsByRepetition[$repNum] = [];
                                }
                                $detailsByRepetition[$repNum][$intervalNum] = $detail;
                                if ($repNum > $repetition) $repetition = $repNum;
                            }
                        }
                        
                        if ($repetition < 1) $repetition = 1;
                        for ($i = 1; $i <= $repetition; $i++) {
                            if (!isset($tsettingValues[$i])) $tsettingValues[$i] = null;
                        }
                    @endphp

                   {{-- LOOP UNTUK SETIAP PENGULANGAN --}}
<ol start="1" type="1" style="margin:0pt; padding-left:0pt">
    @for($p = 1; $p <= $repetition; $p++)
    <li class="ListParagraph" style="margin-right:468.8pt; margin-bottom:2.65pt; text-indent:0pt; line-height:147%; font-size:11pt; font-weight:bold; letter-spacing:-0.1pt; list-style-position:inside">
        <span>Data</span>
        <span style="letter-spacing:-0.45pt"></span>
        <span>Pengukuran</span>
        <span style="letter-spacing:normal"> Setting</span>
        <span style="letter-spacing:normal">Suhu</span>
        <span style="letter-spacing:-0.05pt"></span>
        <span>ke-{{ $p }}</span>
        <span style="width:31.99pt; letter-spacing:normal; display:inline-block">&#xa0;</span>
        <span style="font-family:'Arial MT'; font-weight:normal; letter-spacing:-0.5pt">:</span>
        
        @php
            $currentValue = $tsettingValues[$p] ?? null;
            $formattedValue = '';
            if ($currentValue !== null && $currentValue !== '' && !empty(trim($currentValue))) {
                $formattedValue = htmlspecialchars($currentValue);
            }
            // PERBAIKAN: tambahkan formIndex
            $oldValue = old("suhu_setting_{$formIndex}_{$p}", $formattedValue);
        @endphp
        
        <input type="text"
               name="suhu_setting_{{ $formIndex }}_{{ $p }}"
               value="{{ $oldValue }}"
               style="font-size:10pt;
                      border:none;
                      border-bottom:0.75pt solid #000;
                      width:100pt;
                      margin-left:5pt;
                      background:transparent;
                      color:#000;
                      padding:0;
                      font-family:'Arial MT';
                      height:18pt;
                      text-align:center;"
               placeholder="0.0">
    </li>
    
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
            
            $alatSuhuValue = '';
            if ($detailData) {
                $readAlat = $detailData->readAlat ?? $detailData->read_alat ?? null;
                if ($readAlat !== null && $readAlat !== '') {
                    $alatSuhuValue = htmlspecialchars($readAlat);
                }
            }
            // PERBAIKAN: tambahkan formIndex
            $alatSuhuOldValue = old("alat_{$formIndex}_{$p}_{$interval}", $alatSuhuValue);
            
            $alatRhValue = '';
            if ($detailData) {
                $rhalat = $detailData->RHAlat ?? $detailData->rhalat ?? null;
                if ($rhalat !== null && $rhalat !== '') {
                    $alatRhValue = htmlspecialchars($rhalat);
                }
            }
            // PERBAIKAN: tambahkan formIndex
            $alatRhOldValue = old("alat_percent_{$formIndex}_{$p}_{$interval}", $alatRhValue);
        @endphp
        
        <tr style="height:22pt;">
            <td style="border:2px solid #000; padding:0; vertical-align:middle; text-align:center; font-weight:bold; font-size:10pt; color:#000;">
                {{ $interval }}
            </td>
            
            <!-- PERBAIKAN: name attribute dengan formIndex -->
            <td style="border:2px solid #000; padding:0; vertical-align:middle;">
                <input type="text" 
                       name="alat_{{ $formIndex }}_{{ $p }}_{{ $interval }}" 
                       value="{{ $alatSuhuOldValue }}"
                       style="width:100%;height:100%;border:none;background:transparent;text-align:center;font-size:10pt;color:#000;padding:2px;box-sizing:border-box;">
            </td>
            
            <!-- PERBAIKAN: name attribute dengan formIndex -->
            <td style="border:2px solid #000; padding:0; vertical-align:middle;">
                <input type="text" 
                       name="alat_percent_{{ $formIndex }}_{{ $p }}_{{ $interval }}" 
                       value="{{ $alatRhOldValue }}"
                       style="width:100%;height:100%;border:none;background:transparent;text-align:center;font-size:10pt;color:#000;padding:2px;box-sizing:border-box;">
            </td>
            
            @for($s = 1; $s <= 9; $s++)
            @php
                $sensorValue = '';
                if ($detailData) {
                    $fieldNames = ["ulangan0{$s}", "ulangan{$s}", "readSensor{$s}", "sensor{$s}", "sensor_{$s}"];
                    foreach ($fieldNames as $field) {
                        if (isset($detailData->$field)) {
                            $rawValue = $detailData->$field;
                            break;
                        } elseif (isset($detailData[$field])) {
                            $rawValue = $detailData[$field];
                            break;
                        } else {
                            $rawValue = null;
                        }
                    }
                    if ($rawValue !== null && $rawValue !== '') {
                        $sensorValue = htmlspecialchars($rawValue);
                    }
                }
                // PERBAIKAN: tambahkan formIndex
                $sensorOldValue = old("sensor_{$formIndex}_{$p}_{$interval}_{$s}", $sensorValue);
            @endphp
            <td style="border:2px solid #000; padding:0; vertical-align:middle;">
                <!-- PERBAIKAN: name attribute dengan formIndex -->
                <input type="text" 
                       name="sensor_{{ $formIndex }}_{{ $p }}_{{ $interval }}_{{ $s }}" 
                       value="{{ $sensorOldValue }}"
                       style="width:100%;height:100%;border:none;background:transparent;text-align:center;font-size:10pt;color:#000;padding:2px;box-sizing:border-box;">
            </td>
            @endfor
            
            @php
                $rhSensorValue = '';
                if ($detailData) {
                    $rhSensor = $detailData->RHulangan ?? $detailData->rhulangan ?? null;
                    if ($rhSensor !== null && $rhSensor !== '') {
                        $rhSensorValue = htmlspecialchars($rhSensor);
                    }
                }
                // PERBAIKAN: tambahkan formIndex
                $rhSensorOldValue = old("sensor_percent_{$formIndex}_{$p}_{$interval}", $rhSensorValue);
            @endphp
            <td style="border:2px solid #000; padding:0; vertical-align:middle;">
                <!-- PERBAIKAN: name attribute dengan formIndex -->
                <input type="text" 
                       name="sensor_percent_{{ $formIndex }}_{{ $p }}_{{ $interval }}" 
                       value="{{ $rhSensorOldValue }}"
                       style="width:100%;height:100%;border:none;background:transparent;text-align:center;font-size:10pt;color:#000;padding:2px;box-sizing:border-box;">
            </td>
        </tr>
        @endforeach
    </table>
    @endfor
</ol>

                    <!-- Footer Section -->
                   <table class="kalibrasi-main-table" style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
    <tr>
        <td colspan="7" style="text-align: center; border: 1px solid #000; border-bottom: none; padding: 10px 0;">
            <span style="font-weight: bold; font-size: 18px; color: #000000;">LEMBAR DATA KALIBRASI</span>
        </td>
    </tr>

    @php
        $selectedStandards = [];
        $standardValue = $head->standard ?? '';
        if (!empty($standardValue)) {
            // Support multiple formats: newline, comma+space, or just comma
            if (strpos($standardValue, "\n") !== false) {
                $selectedStandards = array_map('trim', explode("\n", $standardValue));
            } elseif (strpos($standardValue, ', ') !== false) {
                $selectedStandards = array_map('trim', explode(', ', $standardValue));
            } elseif (strpos($standardValue, ',') !== false) {
                $selectedStandards = array_map('trim', explode(',', $standardValue));
            } else {
                $selectedStandards = [$standardValue];
            }
        }
        // Filter out empty values
        $selectedStandards = array_filter($selectedStandards);
    @endphp

    <!-- ROW 1: TEMPERATURE -->
    <tr>
        <td rowspan="2" style="width: 15%; border: 1px solid #000; text-align: center; vertical-align: middle; font-weight: bold; font-size: 10pt; padding: 8px; background-color: #f0f0f0;">
            Alat<br>Standar
        </td>
        <td style="width: 15%; border: 1px solid #000; text-align: left; vertical-align: middle; font-size: 9pt; padding: 8px;">
            - Temperature
        </td>
        <td style="width: 10%; border: 1px solid #000; text-align: center; vertical-align: middle; font-size: 9pt; padding: 8px;">
            <div style="display: flex; align-items: center; justify-content: center; gap: 5px;">
                @if($isFirstForm)
                    <input type="checkbox" name="alat_standar[]" value="GL-220" class="alat-standar-checkbox"
                        {{ in_array('GL-220', $selectedStandards) ? 'checked' : '' }}>
                    <span style="font-weight: normal; color: #000;">GL-220</span>
                @else
                    <input type="checkbox" class="alat-standar-checkbox" disabled 
                        {{ in_array('GL-220', $selectedStandards) ? 'checked' : '' }}>
                    <span style="font-weight: normal; color: #000;">GL-220</span>
                @endif
            </div>
        </td>
        <td style="width: 10%; border: 1px solid #000; text-align: center; vertical-align: middle; font-size: 9pt; padding: 8px;">
            <div style="display: flex; align-items: center; justify-content: center; gap: 5px;">
                @if($isFirstForm)
                    <input type="checkbox" name="alat_standar[]" value="GL-240" class="alat-standar-checkbox"
                        {{ in_array('GL-240', $selectedStandards) ? 'checked' : '' }}>
                    <span style="font-weight: normal; color: #000;">GL-240</span>
                @else
                    <input type="checkbox" class="alat-standar-checkbox" disabled 
                        {{ in_array('GL-240', $selectedStandards) ? 'checked' : '' }}>
                    <span style="font-weight: normal; color: #000;">GL-240</span>
                @endif
            </div>
        </td>
        <td style="width: 10%; border: 1px solid #000; text-align: center; vertical-align: middle; font-size: 9pt; padding: 8px;">
            <div style="display: flex; align-items: center; justify-content: center; gap: 5px;">
                @if($isFirstForm)
                    <input type="checkbox" name="alat_standar[]" value="Huato" class="alat-standar-checkbox"
                        {{ in_array('Huato', $selectedStandards) ? 'checked' : '' }}>
                    <span style="font-weight: normal; color: #000;">Huato</span>
                @else
                    <input type="checkbox" class="alat-standar-checkbox" disabled 
                        {{ in_array('Huato', $selectedStandards) ? 'checked' : '' }}>
                    <span style="font-weight: normal; color: #000;">Huato</span>
                @endif
            </div>
        </td>
        <td rowspan="2" style="width: 20%; border: 1px solid #000; text-align: center; vertical-align: middle; font-weight: bold; font-size: 9pt; padding: 8px; background-color: #f0f0f0;">
            <strong>Dikalibrasi<br>oleh</strong>    
        </td>
        <td rowspan="2" style="width: 20%; border: 1px solid #000; text-align: center; vertical-align: middle; font-weight: bold; font-size: 9pt; padding: 8px; background-color: #f0f0f0;">
           <strong>Diperiksa<br>oleh</strong>
        </td>
    </tr>

    <!-- ROW 2: KELEMBABAN -->
    <tr>
        <td style="border: 1px solid #000; text-align: left; vertical-align: middle; font-size: 9pt; padding: 8px;">
            - Kelembaban
        </td>
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle; font-size: 9pt; padding: 8px;">
            @if($isFirstForm)
                <input type="checkbox" name="alat_standar[]" value="Rotronic" class="alat-standar-checkbox"
                    {{ in_array('Rotronic', $selectedStandards) ? 'checked' : '' }}>
                <span style="font-weight: normal; color: #000;">Rotronic</span>
            @else
                <input type="checkbox" class="alat-standar-checkbox" disabled 
                    {{ in_array('Rotronic', $selectedStandards) ? 'checked' : '' }}>
                <span style="font-weight: normal; color: #000;">Rotronic</span>
            @endif
        </td>
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle; font-size: 9pt; padding: 8px;">
            @if($isFirstForm)
                <input type="checkbox" name="alat_standar[]" value="Lutron" class="alat-standar-checkbox"
                    {{ in_array('Lutron', $selectedStandards) ? 'checked' : '' }}>
                <span style="font-weight: normal; color: #000;">Lutron</span>
            @else
                <input type="checkbox" class="alat-standar-checkbox" disabled 
                    {{ in_array('Lutron', $selectedStandards) ? 'checked' : '' }}>
                <span style="font-weight: normal; color: #000;">Lutron</span>
            @endif
        </td>
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle; font-size: 9pt; padding: 8px;">
            &nbsp;
        </td>
    </tr>

    <!-- ROW 3: METODE KALIBRASI, TTD DAN NAMA -->
    <tr>
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle; font-weight: bold; font-size: 9pt; padding: 8px; background-color: #f0f0f0;">
            Metode<br>Kalibrasi
        </td>
        <td colspan="4" style="border: 1px solid #000; text-align: left; vertical-align: middle; font-size: 9pt; padding: 8px;">
            @if($isFirstForm)
                <input type="text" name="calibration_method" 
                    value="{{ old('calibration_method', $head->calibrationMethod ?? $head->calibration_method ?? 'PAS-IK1102-29B') }}"
                    style="width: 100%; border: 1px solid #ccc; padding: 6px; border-radius: 4px;">
            @else
                <strong>{{ $head->calibrationMethod ?? $head->calibration_method ?? 'PAS-IK1102-29B' }}</strong>
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
                <div style="display: flex; align-items: center; gap: 5px;">
                    <strong>Nama :</strong>
                    @if($isFirstForm)
                        <input type="text" name="calibratedBy" 
                            value="{{ old('calibrated_by', $calibration->calibratedBy ?? $calibration->calibrated_by) }}" 
                            style="flex: 1; font-size:10pt; border: none; border-bottom: 1px solid #000; background: transparent; color: #000; padding: 2px;">
                    @else
                        <span>{{ $calibration->calibratedBy ?? $calibration->calibrated_by ?? '-' }}</span>
                    @endif
                </div>
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
                <div style="display: flex; align-items: center; gap: 5px;">
                    <strong>Nama :</strong>
                    @if($isFirstForm)
                        <input type="text" name="verifiedBy" 
                            value="{{ old('verified_by', $calibration->verifiedBy ?? $calibration->verified_by) }}" 
                            style="flex: 1; font-size:10pt; border: none; border-bottom: 1px solid #000; background: transparent; color: #000; padding: 2px;" readonly>
                    @else
                        <span>{{ $calibration->verifiedBy ?? $calibration->verified_by ?? '-' }}</span>
                    @endif
                </div>
            </div>
        </td>
    </tr>
</table>
                </div>
                
                @if($jumlahForm > 1)
                    </div>
                </div>
                @endif
            @endfor

            <!-- Action Buttons Section -->
            <div class="row mt-5">
                <div class="col-12 text-center">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary btn-lg">
                        <i class="fas fa-times me-2"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-success btn-lg ms-3">
                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                    </button>
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

    document.getElementById('editForm')?.addEventListener('submit', function(e) {
        console.log('🎯 Edit form submission started...');
        
        const formData = new FormData(this);
        console.log('📦 Form data collected for update');
        
        // Log alat standar checkboxes
        const alatStandarCheckboxes = document.querySelectorAll('.alat-standar-checkbox:checked');
        console.log('✅ Checked alat standar:', alatStandarCheckboxes.length);
        
        // Log kondisi alat radio
        const kondisiAlatSelected = document.querySelector('input[name="kondisiAlat"]:checked');
        console.log('🎚️ Kondisi alat selected:', kondisiAlatSelected ? kondisiAlatSelected.value : 'none');
        
        // Log tempat kalibrasi radio
        const tempatKalibrasiSelected = document.querySelector('input[name="tempatKalibrasi"]:checked');
        console.log('📍 Tempat kalibrasi selected:', tempatKalibrasiSelected ? tempatKalibrasiSelected.value : 'none');
        
        let isValid = true;
        let warningMessages = [];
        
        // Validasi tanggal
        const tanggalMasuk = document.querySelector('input[name="tanggalMasuk"]')?.value;
        const tanggalKalibrasi = document.querySelector('input[name="tanggalKalibrasi"]')?.value;
        
        if (tanggalMasuk && tanggalKalibrasi) {
            if (new Date(tanggalMasuk) > new Date(tanggalKalibrasi)) {
                warningMessages.push('Tanggal alat masuk tidak boleh lebih baru dari tanggal kalibrasi');
            }
        }
        
        // Validasi alat standar
        if (alatStandarCheckboxes.length === 0) {
            warningMessages.push('Pilih minimal satu alat standar');
        }
        
        // Validasi kondisi alat
        if (!kondisiAlatSelected) {
            warningMessages.push('Pilih kondisi alat (Ok/Rusak)');
        }
        
        // Validasi tempat kalibrasi
        if (!tempatKalibrasiSelected) {
            warningMessages.push('Pilih tempat kalibrasi');
        }
        
        if (warningMessages.length > 0) {
            const shouldProceed = confirm(
                '⚠️ Peringatan:\n' + 
                warningMessages.join('\n') + 
                '\n\nApakah Anda yakin ingin melanjutkan?'
            );
            
            if (!shouldProceed) {
                e.preventDefault();
                return false;
            }
        }
        
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
        
        console.log('🚀 Form validation passed, submitting...');
        return true;
    });
    
    document.addEventListener('DOMContentLoaded', function() {
        console.log('📄 Edit form loaded for Climatic Chamber ID:', {{ $calibration->id }});
    });
    </script>

    <script>
        const MIN_FORM = 1;
        let currentJumlahForm = {{ $jumlahForm }};
        
        function tambahForm() {
            const jumlahBaru = currentJumlahForm + 1;
            Swal.fire({
                title: 'Tambah Form',
                text: `Menambahkan form menjadi ${jumlahBaru} form. Lanjutkan?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Tambahkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    currentJumlahForm = jumlahBaru;
                    updateFormCounter();
                    reloadPageWithFormCount(currentJumlahForm);
                }
            });
        }
        
        function kurangiForm() {
            if (currentJumlahForm <= MIN_FORM) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Minimum Form',
                    text: 'Minimal harus ada 1 form.',
                    confirmButtonText: 'OK'
                });
                return;
            }
            
            Swal.fire({
                title: 'Hapus Form?',
                text: `Apakah Anda yakin ingin menghapus form ke-${currentJumlahForm}? Data pada form tersebut akan dihapus.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    currentJumlahForm--;
                    updateFormCounter();
                    reloadPageWithFormCount(currentJumlahForm);
                }
            });
        }
        
        function updateFormCounter() {
            const input = document.getElementById('jumlah_form_input');
            const btnKurang = document.getElementById('btnKurangForm');
            const badge = document.getElementById('formCountBadge');
            
            if (input) input.value = currentJumlahForm;
            if (btnKurang) btnKurang.disabled = currentJumlahForm <= MIN_FORM;
            if (badge) badge.textContent = `${currentJumlahForm} Form`;
        }
        
        function reloadPageWithFormCount(count) {
            const url = new URL(window.location.href);
            url.searchParams.set('jumlah_form', count);
            window.location.href = url.toString();
        }
        
        document.getElementById('btnTambahForm')?.addEventListener('click', tambahForm);
        document.getElementById('btnKurangForm')?.addEventListener('click', kurangiForm);
        
        document.getElementById('btnChangeJumlahForm')?.addEventListener('click', function() {
            const val = parseInt(document.getElementById('jumlah_form_input').value);
            if (isNaN(val) || val < MIN_FORM) {
                Swal.fire({
                    icon: 'error',
                    title: 'Nilai Tidak Valid',
                    text: `Jumlah form minimal ${MIN_FORM}.`,
                    confirmButtonText: 'OK'
                });
                document.getElementById('jumlah_form_input').value = currentJumlahForm;
                return;
            }
            if (val === currentJumlahForm) {
                Swal.fire({
                    icon: 'info',
                    title: 'Tidak Ada Perubahan',
                    text: 'Jumlah form sudah sesuai dengan yang dipilih.',
                    timer: 1500,
                    showConfirmButton: false
                });
                return;
            }
            
            if (confirm(`Mengubah jumlah form menjadi ${val} akan memuat ulang halaman. Lanjutkan?`)) {
                reloadPageWithFormCount(val);
            } else {
                document.getElementById('jumlah_form_input').value = currentJumlahForm;
            }
        });
        
        document.getElementById('jumlah_form_input')?.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                document.getElementById('btnChangeJumlahForm').click();
            }
        });
    </script>

</body>
</html>