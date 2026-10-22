<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Kalibrasi Caliper - PT. PANANJUNG ANUGRAH SOLUTION</title>
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

    .alat-standar-table {
        width: 100%;
        border-collapse: collapse;
    }

    .alat-standar-table td {
        border: 1px solid #000;
        padding: 8px;
        vertical-align: middle;
    }

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

    .alat-standar-checkbox {
        width: 18px;
        height: 18px;
        margin: 0;
        cursor: pointer;
    }

    @media print {
        .btn { display: none !important; }
        .form-card { border: 1px solid #000; break-inside: avoid; }
        .form-card-header { background: #f0f0f0 !important; color: #000 !important; }
    }

    @media (max-width: 768px) {
        .kalibrasi-main-table td { padding: 4px; }
        .data-kalibrasi-header { font-size: 16px; }
        .btn-lg { padding: 10px 20px !important; font-size: 14px !important; }
    }

    .required-field::after {
        content: " *";
        color: #dc3545;
    }
    </style>
</head>
<body>
    <div class="container my-4" style="width: 95%; max-width: 1600px;">
        <form action="{{ route('calibrations.update', $calibration->id) }}" method="POST" id="editForm">
            @csrf
            @method('PUT')
            
            @php
                $jumlahForm = $calibration->jumlah_form ?? 1;
                $jumlahForm = max(1, min(4, $jumlahForm));
                $heads = $calibration->headCaliper ?? collect();
                $details = $calibration->detailCalipers ?? collect();
                $addCalipers = $calibration->addCaliper  ?? collect();
                $form1Head = $calibration->headCaliperForm1;
            @endphp
            
            <input type="hidden" name="jumlah_form" value="{{ $jumlahForm }}">
            
            @for($formIndex = 1; $formIndex <= $jumlahForm; $formIndex++)
                @php
                    $head = $calibration->{'headCaliperForm' . $formIndex};
                    $formDetails = $details->where('form_index', $formIndex)->sortBy('id');
                    $formAdd = $calibration->{'addCaliperForm' . $formIndex};
                    $isFirstForm = ($formIndex == 1);
                @endphp
                
                @if($jumlahForm > 1)
                <div class="form-card">
                    <div class="form-card-header">
                        <i class="fas fa-file-alt me-2"></i>
                        Form Caliper ke-{{ $formIndex }}
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
                                <p style="margin: 0; font-size: 14px;">PAS-FLK03</p>
                            </td>
                            <td rowspan="5" style="text-align: center; vertical-align: middle; padding: 10px 0;">
                                <div style="display: inline-block; text-align: center;">
                                    <div style="margin-bottom: 15px;">
                                        <img src="/logo/logo_pas_basic.png" alt="Logo PT. PAS" style="width: 107px; height: 54px; display: block; margin: 0 auto;">
                                    </div>
                                    <p style="font-weight: bold; margin: 0; font-size: 15px;">PT. PANANJUNG ANUGRAH SOLUTION</p>
                                </div>
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
                                <p style="margin: 0; font-weight: bold; font-size: 14px;">CALIPER</p>
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
                                    {{ $head->certificate_id ?? $form1Head->certificate_id ?? 'N/A' }}
                                </p>
                            </div>
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
                            </div>
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
                            </div>
                            </tr>
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
                            </div>
                            </tr>
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
                            </div>
                            </tr>
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
                            </div>
                            </tr>
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
                            </div>
                            </tr>
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
                            </div>
                            </tr>
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
                            </div>
                            </tr>
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
                            </div>
                            </tr>
                        </tr>
                        
                         <tr>
                            <td><p style="margin:0;">Kode TH</p></td>
                            <td colspan="3">
                                @if($isFirstForm)
                                    <input type="text" class="kalibrasi-input" name="kode_th" value="{{ old('kode_th', $calibration->kode_th) }}">
                                @else
                                    <input type="text" class="kalibrasi-input" value="" readonly disabled style="background-color: #e9ecef;">
                                @endif
                            </div>
                            </tr>
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
                                    <td><input type="text" step="any" name="RT_condition1" class="kondisi-input" value="{{ old('RT_condition1', $calibration->RT_condition1 ?? '') }}"></td>
                                    <td><input type="text" step="any" name="RT_condition2" class="kondisi-input" value="{{ old('RT_condition2', $calibration->RT_condition2 ?? '') }}"></td>
                                    <td><input type="text" step="any" name="RT_condition3" class="kondisi-input" value="{{ old('RT_condition3', $calibration->RT_condition3 ?? '') }}"></td>
                                </tr>
                                <tr>
                                    <td class="bg-light fw-bold">RH (%)</td>
                                    <td><input type="text" step="any" name="RH_condition1" class="kondisi-input" value="{{ old('RH_condition1', $calibration->RH_condition1 ?? '') }}"></td>
                                    <td><input type="text" step="any" name="RH_condition2" class="kondisi-input" value="{{ old('RH_condition2', $calibration->RH_condition2 ?? '') }}"></td>
                                    <td><input type="text" step="any" name="RH_condition3" class="kondisi-input" value="{{ old('RH_condition3', $calibration->RH_condition3 ?? '') }}"></td>
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
                                    <td><input type="text" class="kondisi-input" value="" readonly disabled style="background-color: #e9ecef;"></td>
                                    <td><input type="text" class="kondisi-input" value="" readonly disabled style="background-color: #e9ecef;"></td>
                                    <td><input type="text" class="kondisi-input" value="" readonly disabled style="background-color: #e9ecef;"></td>
                                </tr>
                                <tr>
                                    <td class="bg-light fw-bold">RH (%)</td>
                                    <td><input type="text" class="kondisi-input" value="" readonly disabled style="background-color: #e9ecef;"></td>
                                    <td><input type="text" class="kondisi-input" value="" readonly disabled style="background-color: #e9ecef;"></td>
                                    <td><input type="text" class="kondisi-input" value="" readonly disabled style="background-color: #e9ecef;"></td>
                                </tr>
                            </table>
                            @endif
                        </div>
                    </div>

                    <!-- DATA KALIBRASI Section -->
                    <div class="data-kalibrasi-header">DATA KALIBRASI</div>
                    
                    <!-- BAGIAN 1: PEMERIKSAAN KESEJAJARAN MUKA UKUR EKSTERNAL -->
                    <div class="mb-3">
                        <ol type="1" style="margin:0pt; padding-left:0pt">
                            <li class="ListParagraph" style="text-indent:0pt; font-size:11pt; font-weight:bold">
                                <span>Pemeriksaan Kesejajaran Muka Ukur Eksternal</span>
                            </li>
                        </ol>
                        <table cellspacing="0" cellpadding="0" class="TableNormal" style="margin-left:15.48pt; border:0.75pt solid #000000; border-collapse:collapse; width:100%">
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
                                    <input type="text" step="any"
                                           name="titikUkurKesejajaran_{{ $formIndex }}"
                                           value="{{ old('titikUkurKesejajaran_' . $formIndex, $formAdd->titikUkurKesajajaran ?? '') }}"
                                           style="width: calc(100% - 25px); height: 100%; border:none; text-align:center; font-size:9.5pt; background:transparent; padding:2px;">
                                    <span style="position:absolute; right:10px; top:50%; transform:translateY(-50%); font-size:9.5pt; color:#666;">mm</span>
                                </td>
                                <td style="width:25%; border:0.75pt solid #000000; vertical-align:top; padding:4pt">
                                    <input type="text" step="any"
                                           name="kesejajaranAwal_{{ $formIndex }}"
                                           value="{{ old('kesejajaranAwal_' . $formIndex, $formAdd->kesejajaranAwal ?? '') }}"
                                           style="width:100%; height:100%; border:none; text-align:center; font-size:9.5pt; background:transparent; padding:2px;">
                                </td>
                                <td style="width:25%; border:0.75pt solid #000000; vertical-align:top; padding:4pt">
                                    <input type="text" step="any"
                                           name="kesejajaranTengah_{{ $formIndex }}"
                                           value="{{ old('kesejajaranTengah_' . $formIndex, $formAdd->kesejajaranTengah ?? '') }}"
                                           style="width:100%; height:100%; border:none; text-align:center; font-size:9.5pt; background:transparent; padding:2px;">
                                </td>
                                <td style="width:25%; border:0.75pt solid #000000; vertical-align:top; padding:4pt">
                                    <input type="text" step="any"
                                           name="kesejajaranAkhir_{{ $formIndex }}"
                                           value="{{ old('kesejajaranAkhir_' . $formIndex, $formAdd->kesejajaranAkhir ?? '') }}"
                                           style="width:100%; height:100%; border:none; text-align:center; font-size:9.5pt; background:transparent; padding:2px;">
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
                        <table cellspacing="0" cellpadding="0" class="TableNormal" style="margin-left:15.48pt; border:0.75pt solid #000000; border-collapse:collapse; width:100%">
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
                                    <input type="text" step="any"
                                           name="pengukuranDalamPisauBersilang_{{ $formIndex }}"
                                           value="{{ old('pengukuranDalamPisauBersilang_' . $formIndex, $formAdd->pengukuranDalamPisauBersilang ?? '') }}"
                                           style="width:calc(100% - 25px); height:100%; border:none; text-align:center; font-size:10pt; background:transparent; padding:4px;">
                                    <span style="position:absolute; right:10px; top:50%; transform:translateY(-50%); font-size:9pt; color:#666; font-family:Arial;">mm</span>
                                </td>
                                <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                                    <input type="text" step="any"
                                           name="pembacaan1_{{ $formIndex }}"
                                           value="{{ old('pembacaan1_' . $formIndex, $formAdd->pembacaan1 ?? '') }}"
                                           style="width:100%; height:100%; border:none; text-align:center; font-size:10pt; background:transparent; padding:4px;">
                                </td>
                                <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                                    <input type="text" step="any"
                                           name="pembacaan2_{{ $formIndex }}"
                                           value="{{ old('pembacaan2_' . $formIndex, $formAdd->pembacaan2 ?? '') }}"
                                           style="width:100%; height:100%; border:none; text-align:center; font-size:10pt; background:transparent; padding:4px;">
                                </td>
                                <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                                    <input type="text" step="any"
                                           name="pembacaan3_{{ $formIndex }}"
                                           value="{{ old('pembacaan3_' . $formIndex, $formAdd->pembacaan3 ?? '') }}"
                                           style="width:100%; height:100%; border:none; text-align:center; font-size:10pt; background:transparent; padding:4px;">
                                </td>
                            </tr>
                        </table>
                    </div>

         <!-- BAGIAN 3: PENGUKURAN OUTSIDE -->
<div class="mb-3">
    <ol start="3" type="1" style="margin:0pt; padding-left:0pt">
        <li class="ListParagraph" style="margin-top:4.85pt; text-indent:0pt; font-size:11pt; font-weight:bold">
            <span>Pengukuran Outside</span>
        </li>
    </ol>
    
    @php
        // Ambil data outside dari database
        $outsideRows = $formDetails->filter(function($item) {
            return !is_null($item->outside01) || !is_null($item->outside02) || 
                   !is_null($item->outside03) || !is_null($item->outside04) || 
                   !is_null($item->outside05);
        })->values();
        
        // Pastikan selalu 6 baris
        $targetRows = 6;
        $currentCount = $outsideRows->count();
        
        if ($currentCount < $targetRows) {
            // Tambah baris kosong sampai 6
            for ($i = $currentCount; $i < $targetRows; $i++) {
                $outsideRows->push((object)[
                    'titikUkur' => '',
                    'outside01' => '',
                    'outside02' => '',
                    'outside03' => '',
                    'outside04' => '',
                    'outside05' => '',
                    'id' => null
                ]);
            }
        }
    @endphp
    
    <table id="outside-table-{{ $formIndex }}" cellspacing="0" cellpadding="0" class="TableNormal" style="margin-left:15.48pt; border:0.75pt solid #000000; border-collapse:collapse; width:100%">
        <tr style="height:12pt">
            <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <div style="text-align:center; padding:6pt">
                    <div style="margin-bottom: 8px; line-height:11pt;">
                        <span style="font-family:Arial; font-size:10pt; font-weight:bold">Titik Ukur</span>
                    </div>
                    <div>
                        <span style="font-family:Arial; font-size:9pt; font-weight:bold">Unit (</span>
                        <input type="text" 
                               name="satuan_unit_outside_{{ $formIndex }}" 
                               value="{{ old('satuan_unit_outside_' . $formIndex, $head->satuan_unit_outside ?? 'mm') }}"
                               style="width: 50px; padding: 2px; border: 1px solid #666; border-radius: 3px; text-align: center; font-size: 9pt; background: white;">
                        <span style="font-family:Arial; font-size:9pt; font-weight:bold">)</span>
                    </div>
                </div>
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
        
        @foreach($outsideRows as $index => $detail)
            @php
                $titikUkur = $detail->titikUkur ?? '';
                $outside01 = $detail->outside01 ?? '';
                $outside02 = $detail->outside02 ?? '';
                $outside03 = $detail->outside03 ?? '';
                $outside04 = $detail->outside04 ?? '';
                $outside05 = $detail->outside05 ?? '';
                $detailId = $detail->id ?? null;
            @endphp
            <tr style="height:16pt">
                <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text"
                           name="outside_titik_ukur_{{ $formIndex }}[{{ $index }}]"
                           value="{{ $titikUkur }}"
                           style="width:100%; text-align:center; border:none; font-size:10pt;">
                    @if($detailId)
                        <input type="hidden" name="outside_detail_ids_{{ $formIndex }}[{{ $index }}]" value="{{ $detailId }}">
                    @endif
                </td>
                <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text" step="any"
                           name="outside_ulangan01_{{ $formIndex }}[{{ $index }}]"
                           value="{{ $outside01 }}"
                           style="width:100%; text-align:center; border:none; font-size:10pt;">
                </td>
                <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text" step="any"
                           name="outside_ulangan02_{{ $formIndex }}[{{ $index }}]"
                           value="{{ $outside02 }}"
                           style="width:100%; text-align:center; border:none; font-size:10pt;">
                </td>
                <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text" step="any"
                           name="outside_ulangan03_{{ $formIndex }}[{{ $index }}]"
                           value="{{ $outside03 }}"
                           style="width:100%; text-align:center; border:none; font-size:10pt;">
                </td>
                <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text" step="any"
                           name="outside_ulangan04_{{ $formIndex }}[{{ $index }}]"
                           value="{{ $outside04 }}"
                           style="width:100%; text-align:center; border:none; font-size:10pt;">
                </td>
                <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text" step="any"
                           name="outside_ulangan05_{{ $formIndex }}[{{ $index }}]"
                           value="{{ $outside05 }}"
                           style="width:100%; text-align:center; border:none; font-size:10pt;">
                </td>
            </tr>
        @endforeach
    </table>
    <div style="text-align:right; margin-top:6px;">
        <button type="button" class="btn btn-sm btn-outline-primary add-row-btn"
                data-table="outside" data-form="{{ $formIndex }}"
                data-target-table="outside-table-{{ $formIndex }}"
                style="font-size:12px;">
            <i class="fas fa-plus me-1"></i>Tambah Baris Outside
        </button>
        <button type="button" class="btn btn-sm btn-outline-danger remove-row-btn"
                data-table="outside" data-form="{{ $formIndex }}"
                data-target-table="outside-table-{{ $formIndex }}"
                style="font-size:12px; margin-left: 5px;">
            <i class="fas fa-trash-alt me-1"></i>Hapus Baris Terakhir
        </button>
    </div>
</div>

<!-- BAGIAN 4: PENGUKURAN INSIDE -->
<div class="mb-3">
    <ol start="4" type="1" style="margin:0pt; padding-left:0pt">
        <li class="ListParagraph" style="margin-top:4.85pt; text-indent:0pt; font-size:11pt; font-weight:bold">
            <span>Pengukuran Inside</span>
        </li>
    </ol>
    
    @php
        // Ambil data inside dari database
        $insideRows = $formDetails->filter(function($item) {
            return !is_null($item->inside01) || !is_null($item->inside02) || 
                   !is_null($item->inside03) || !is_null($item->inside04) || 
                   !is_null($item->inside05);
        })->values();
        
        // Pastikan selalu 6 baris
        $targetRows = 6;
        $currentCount = $insideRows->count();
        
        if ($currentCount < $targetRows) {
            // Tambah baris kosong sampai 6
            for ($i = $currentCount; $i < $targetRows; $i++) {
                $insideRows->push((object)[
                    'titikUkur' => '',
                    'inside01' => '',
                    'inside02' => '',
                    'inside03' => '',
                    'inside04' => '',
                    'inside05' => '',
                    'id' => null
                ]);
            }
        }
    @endphp
    
    <table id="inside-table-{{ $formIndex }}" cellspacing="0" cellpadding="0" class="TableNormal" style="margin-left:15.48pt; border:0.75pt solid #000000; border-collapse:collapse; width:100%">
        <tr style="height:12pt">
            <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <div style="text-align:center; padding:6pt">
                    <div style="margin-bottom: 8px; line-height:11pt;">
                        <span style="font-family:Arial; font-size:10pt; font-weight:bold">Titik Ukur</span>
                    </div>
                    <div>
                        <span style="font-family:Arial; font-size:9pt; font-weight:bold">Unit (</span>
                        <input type="text" 
                               name="satuan_unit_inside_{{ $formIndex }}" 
                               value="{{ old('satuan_unit_inside_' . $formIndex, $head->satuan_unit_inside ?? 'mm') }}"
                               style="width: 50px; padding: 2px; border: 1px solid #666; border-radius: 3px; text-align: center; font-size: 9pt; background: white;">
                        <span style="font-family:Arial; font-size:9pt; font-weight:bold">)</span>
                    </div>
                </div>
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
        
        @foreach($insideRows as $index => $detail)
            @php
                $titikUkur = $detail->titikUkur ?? '';
                $inside01 = $detail->inside01 ?? '';
                $inside02 = $detail->inside02 ?? '';
                $inside03 = $detail->inside03 ?? '';
                $inside04 = $detail->inside04 ?? '';
                $inside05 = $detail->inside05 ?? '';
                $detailId = $detail->id ?? null;
            @endphp
            <tr style="height:16pt">
                <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text"
                           name="inside_titik_ukur_{{ $formIndex }}[{{ $index }}]"
                           value="{{ $titikUkur }}"
                           style="width:100%; text-align:center; border:none; font-size:10pt;">
                    @if($detailId)
                        <input type="hidden" name="inside_detail_ids_{{ $formIndex }}[{{ $index }}]" value="{{ $detailId }}">
                    @endif
                </td>
                <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text" step="any"
                           name="inside_ulangan01_{{ $formIndex }}[{{ $index }}]"
                           value="{{ $inside01 }}"
                           style="width:100%; text-align:center; border:none; font-size:10pt;">
                </td>
                <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text" step="any"
                           name="inside_ulangan02_{{ $formIndex }}[{{ $index }}]"
                           value="{{ $inside02 }}"
                           style="width:100%; text-align:center; border:none; font-size:10pt;">
                </td>
                <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text" step="any"
                           name="inside_ulangan03_{{ $formIndex }}[{{ $index }}]"
                           value="{{ $inside03 }}"
                           style="width:100%; text-align:center; border:none; font-size:10pt;">
                </td>
                <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text" step="any"
                           name="inside_ulangan04_{{ $formIndex }}[{{ $index }}]"
                           value="{{ $inside04 }}"
                           style="width:100%; text-align:center; border:none; font-size:10pt;">
                </td>
                <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text" step="any"
                           name="inside_ulangan05_{{ $formIndex }}[{{ $index }}]"
                           value="{{ $inside05 }}"
                           style="width:100%; text-align:center; border:none; font-size:10pt;">
                </td>
            </tr>
        @endforeach
    </table>
    <div style="text-align:right; margin-top:6px;">
        <button type="button" class="btn btn-sm btn-outline-success add-row-btn"
                data-table="inside" data-form="{{ $formIndex }}"
                data-target-table="inside-table-{{ $formIndex }}"
                style="font-size:12px;">
            <i class="fas fa-plus me-1"></i>Tambah Baris Inside
        </button>
        <button type="button" class="btn btn-sm btn-outline-danger remove-row-btn"
                data-table="inside" data-form="{{ $formIndex }}"
                data-target-table="inside-table-{{ $formIndex }}"
                style="font-size:12px; margin-left: 5px;">
            <i class="fas fa-trash-alt me-1"></i>Hapus Baris Terakhir
        </button>
    </div>
</div>

<!-- BAGIAN 5: PENGUKURAN DEPTH -->
<div class="mb-3">
    <ol start="5" type="1" style="margin:0pt; padding-left:0pt">
        <li class="ListParagraph" style="margin-top:4.85pt; text-indent:0pt; font-size:11pt; font-weight:bold">
            <span>Pengukuran Depth</span>
        </li>
    </ol>
    @php
        // Ambil data depth dari database
        $depthRows = $formDetails->filter(function($item) {
            return !is_null($item->depth01) || !is_null($item->depth02) || 
                   !is_null($item->depth03) || !is_null($item->depth04) || 
                   !is_null($item->depth05) || !is_null($item->KodeStandarKiri) ||
                   !is_null($item->kodeStandarKiri) || !is_null($item->KodeStandarKanan) ||
                   !is_null($item->kodeStandarKanan);
        })->values();
        
        // Pastikan selalu minimal 6 baris input
        $targetRows = 6;
        $currentCount = $depthRows->count();
        
        if ($currentCount < $targetRows) {
            for ($i = $currentCount; $i < $targetRows; $i++) {
                $depthRows->push((object)[
                    'titikUkur' => '',
                    'KodeStandarKiri' => '',
                    'KodeStandarKanan' => '',
                    'depth01' => '',
                    'depth02' => '',
                    'depth03' => '',
                    'depth04' => '',
                    'depth05' => '',
                    'id' => null
                ]);
            }
        }
    @endphp
    
    <table id="depth-table-{{ $formIndex }}" cellspacing="0" cellpadding="0" class="TableNormal" style="margin-left:15.48pt; border:0.75pt solid #000000; border-collapse:collapse; width:100%">
        <!-- HEADER ROW 1 -->
        <tr style="height:12pt">
            <td style="width:20%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <div style="text-align:center; padding:6pt">
                    <div style="margin-bottom: 8px; line-height:11pt;">
                        <span style="font-family:Arial; font-size:10pt; font-weight:bold">Titik Ukur</span>
                    </div>
                    <div>
                        <span style="font-family:Arial; font-size:9pt; font-weight:bold">Unit (</span>
                        <input type="text" 
                               name="satuan_unit_depth_{{ $formIndex }}" 
                               value="{{ old('satuan_unit_depth_' . $formIndex, $head->satuan_unit_depth ?? 'mm') }}"
                               style="width: 50px; padding: 2px; border: 1px solid #666; border-radius: 3px; text-align: center; font-size: 9pt; background: white;">
                        <span style="font-family:Arial; font-size:9pt; font-weight:bold">)</span>
                    </div>
                </div>
            </td>
            <td colspan="2" style="width:20%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Kode Standar yang Digunakan</span>
                </p>
            </td>
            <td colspan="5" style="width:60%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Penunjukan Alat</span>
                </p>
            </td>
         </tr>
        
        <!-- HEADER ROW 2 -->
        <tr style="height:12pt">
            <td style="width:20%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Nilai Nominal</span>
                </p>
            </td>
            <td style="width:10%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:9.5pt; font-weight:bold">Kiri</span>
                </p>
            </td>
            <td style="width:10%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:9.5pt; font-weight:bold">Kanan</span>
                </p>
            </td>
            <td style="width:12%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:9.5pt; font-weight:bold">1</span>
                </p>
            </td>
            <td style="width:12%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:9.5pt; font-weight:bold">2</span>
                </p>
            </td>
            <td style="width:12%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:9.5pt; font-weight:bold">3</span>
                </p>
            </td>
            <td style="width:12%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:9.5pt; font-weight:bold">4</span>
                </p>
            </td>
            <td style="width:12%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:9.5pt; font-weight:bold">5</span>
                </p>
            </td>
         </tr>
        
       @foreach($depthRows as $index => $detail)
            @php
                $titikUkur = $detail->titikUkur ?? '';
                $kodeStandarKiri = $detail->KodeStandarKiri ?? $detail->kodeStandarKiri ?? $detail->kodeStandardKiri ?? '';
                $kodeStandarKanan = $detail->KodeStandarKanan ?? $detail->kodeStandarKanan ?? $detail->kodeStandardKanan ?? '';
                $depth01 = $detail->depth01 ?? '';
                $depth02 = $detail->depth02 ?? '';
                $depth03 = $detail->depth03 ?? '';
                $depth04 = $detail->depth04 ?? '';
                $depth05 = $detail->depth05 ?? '';
                $detailId = $detail->id ?? null;
            @endphp
            <tr style="height:16pt">
                <td style="width:20%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text"
                           name="depth_titik_ukur_{{ $formIndex }}[{{ $index }}]"
                           value="{{ $titikUkur }}"
                           style="width:100%; text-align:center; border:none; font-size:10pt;">
                    @if($detailId)
                        <input type="hidden" name="depth_detail_ids_{{ $formIndex }}[{{ $index }}]" value="{{ $detailId }}">
                    @endif
                </td>
                <td style="width:10%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text"
                           name="depth_kode_standar_kiri_{{ $formIndex }}[{{ $index }}]"
                           value="{{ $kodeStandarKiri }}"
                           style="width:100%; text-align:center; border:none; font-size:10pt;">
                </td>
                <td style="width:10%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text"
                           name="depth_kode_standar_kanan_{{ $formIndex }}[{{ $index }}]"
                           value="{{ $kodeStandarKanan }}"
                           style="width:100%; text-align:center; border:none; font-size:10pt;">
                </td>
                <td style="width:12%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text" step="any"
                           name="depth_ulangan01_{{ $formIndex }}[{{ $index }}]"
                           value="{{ $depth01 }}"
                           style="width:100%; text-align:center; border:none; font-size:10pt;">
                </td>
                <td style="width:12%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text" step="any"
                           name="depth_ulangan02_{{ $formIndex }}[{{ $index }}]"
                           value="{{ $depth02 }}"
                           style="width:100%; text-align:center; border:none; font-size:10pt;">
                </td>
                <td style="width:12%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text" step="any"
                           name="depth_ulangan03_{{ $formIndex }}[{{ $index }}]"
                           value="{{ $depth03 }}"
                           style="width:100%; text-align:center; border:none; font-size:10pt;">
                </td>
                <td style="width:12%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text" step="any"
                           name="depth_ulangan04_{{ $formIndex }}[{{ $index }}]"
                           value="{{ $depth04 }}"
                           style="width:100%; text-align:center; border:none; font-size:10pt;">
                </td>
                <td style="width:12%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text" step="any"
                           name="depth_ulangan05_{{ $formIndex }}[{{ $index }}]"
                           value="{{ $depth05 }}"
                           style="width:100%; text-align:center; border:none; font-size:10pt;">
                </td>
            </tr>
        @endforeach
    </table>
    <div style="text-align:right; margin-top:6px;">
        <button type="button" class="btn btn-sm btn-outline-warning add-row-btn"
                data-table="depth" data-form="{{ $formIndex }}"
                data-target-table="depth-table-{{ $formIndex }}"
                style="font-size:12px;">
            <i class="fas fa-plus me-1"></i>Tambah Baris Depth
        </button>
        <button type="button" class="btn btn-sm btn-outline-danger remove-row-btn"
                data-table="depth" data-form="{{ $formIndex }}"
                data-target-table="depth-table-{{ $formIndex }}"
                style="font-size:12px; margin-left: 5px;">
            <i class="fas fa-trash-alt me-1"></i>Hapus Baris Terakhir
        </button>
    </div>
</div>
                    <!-- Footer Section -->
                    <div class="data-complete-section">
                        <span class="data-complete-text">Data telah diisi dengan lengkap dan jelas!</span>
                    </div>

                                      <!-- ALAT STANDAR + CHECKBOX (mengikuti form 1) -->
                    @php
                        // Gunakan data alat standar dari HEAD form saat ini (bukan selalu form 1)
                        $currentHead = $head ?? $form1Head;
                        $standardValue = $currentHead->standard ?? '';
                        $selectedStandards = [];
                        
                        // Parse nilai standard dari database
                        if (!empty($standardValue)) {
                            // Cek apakah mengandung koma (multiple values)
                            if (strpos($standardValue, ', ') !== false) {
                                $selectedStandards = array_map('trim', explode(', ', $standardValue));
                            } elseif (strpos($standardValue, ',') !== false) {
                                $selectedStandards = array_map('trim', explode(',', $standardValue));
                            } else {
                                $selectedStandards = [$standardValue];
                            }
                        }
                        
                        // Daftar alat standar yang tersedia (tanpa additional)
                        $availableTools = ['Caliper Checker D.001', 'Caliper Checker D.001B', 'Gauge Block Set Grade 0', 'Pin Gauge 15 mm', 'Ring Gauge 5 mm'];
                    @endphp
                    
                    @if($isFirstForm)
                        <table class="alat-standar-table">
                            <tr>
                                <td rowspan="5" style="width:20%; text-align:center; font-weight:bold; font-size:14px;">Alat Standar</td>
                                <td style="width:5%; text-align:center;">
                                    <input type="checkbox" class="alat-standar-checkbox" name="alat_standar_{{ $formIndex }}[]" value="Caliper Checker D.001" 
                                        {{ in_array('Caliper Checker D.001', $selectedStandards) ? 'checked' : '' }}>
                                </td>
                                <td colspan="2">Caliper Checker D.001</td>
                                <td rowspan="5" style="width:15%; text-align:center;">Dikalibrasi<br>oleh</td>
                                <td rowspan="5" style="width:15%; text-align:center;">Diperiksa<br>oleh</td>
                            </tr>
                            <tr>
                                <td style="text-align:center;">
                                    <input type="checkbox" class="alat-standar-checkbox" name="alat_standar_{{ $formIndex }}[]" value="Caliper Checker D.001B" 
                                        {{ in_array('Caliper Checker D.001B', $selectedStandards) ? 'checked' : '' }}>
                                </td>
                                <td colspan="2">Caliper Checker D.001B</td>
                            </tr>
                            <tr>
                                <td style="text-align:center;">
                                    <input type="checkbox" class="alat-standar-checkbox" name="alat_standar_{{ $formIndex }}[]" value="Gauge Block Set Grade 0" 
                                        {{ in_array('Gauge Block Set Grade 0', $selectedStandards) ? 'checked' : '' }}>
                                </td>
                                <td colspan="2">Gauge Block Set Grade 0</td>
                            </tr>
                            <tr>
                                <td style="text-align:center;">
                                    <input type="checkbox" class="alat-standar-checkbox" name="alat_standar_{{ $formIndex }}[]" value="Pin Gauge 15 mm" 
                                        {{ in_array('Pin Gauge 15 mm', $selectedStandards) ? 'checked' : '' }}>
                                </td>
                                <td colspan="2">Pin Gauge 15 mm</td>
                            </tr>
                            <tr>
                                <td style="text-align:center;">
                                    <input type="checkbox" class="alat-standar-checkbox" name="alat_standar_{{ $formIndex }}[]" value="Ring Gauge 5 mm" 
                                        {{ in_array('Ring Gauge 5 mm', $selectedStandards) ? 'checked' : '' }}>
                                </td>
                                <td colspan="2">Ring Gauge 5 mm</td>
                            </tr>
                            
                            <tr>
                                <td style="font-weight:bold;">Metode Kalibrasi</td>
                                <td colspan="3">
                                    <input type="text" class="kalibrasi-input" name="calibrationMethod" 
                                           value="{{ old('calibrationMethod', $form1Head->calibrationMethod ?? 'PAS-IK1102-03 (JIS B 7518:2023 (JMA/JSA); SNSU PK.P-02:2020)') }}" 
                                           style="border: none; width: 100%; background-color: #ffffff;" readonly>
                                </td>
                                <td><input type="text" class="kalibrasi-input" name="calibratedBy" value="{{ $calibration->calibratedBy ?? '' }}" style="border: none; width: 100%; background-color: #f8f9fa;" readonly></td>
                                <td><input type="text" class="kalibrasi-input" name="verifiedBy" value="{{ old('verifiedBy', $calibration->verifiedBy ?? '') }}" style="border: none; width: 100%;" readonly></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td colspan="3">&nbsp;</td>
                                <td>TTD :</td>
                                <td>TTD :</td>
                            </tr>
                        </table>
                    @else
                        {{-- FORM 2+ : Alat standar bisa diedit sendiri-sendiri --}}
                        <table class="alat-standar-table">
                            <tr>
                                <td rowspan="5" style="width:20%; text-align:center; font-weight:bold; font-size:14px;">Alat Standar</td>
                                <td style="width:5%; text-align:center;">
                                    <input type="checkbox" class="alat-standar-checkbox" name="alat_standar_{{ $formIndex }}[]" value="Caliper Checker D.001"
                                        {{ in_array('Caliper Checker D.001', $selectedStandards) ? 'checked' : '' }}>
                                </td>
                                <td colspan="2">Caliper Checker D.001</td>
                                <td rowspan="5" style="width:15%; text-align:center;">Dikalibrasi<br>oleh</td>
                                <td rowspan="5" style="width:15%; text-align:center;">Diperiksa<br>oleh</td>
                            </tr>
                            <tr>
                                <td style="text-align:center;">
                                    <input type="checkbox" class="alat-standar-checkbox" name="alat_standar_{{ $formIndex }}[]" value="Caliper Checker D.001B"
                                        {{ in_array('Caliper Checker D.001B', $selectedStandards) ? 'checked' : '' }}>
                                </td>
                                <td colspan="2">Caliper Checker D.001B</td>
                            </tr>
                            <tr>
                                <td style="text-align:center;">
                                    <input type="checkbox" class="alat-standar-checkbox" name="alat_standar_{{ $formIndex }}[]" value="Gauge Block Set Grade 0"
                                        {{ in_array('Gauge Block Set Grade 0', $selectedStandards) ? 'checked' : '' }}>
                                </td>
                                <td colspan="2">Gauge Block Set Grade 0</td>
                            </tr>
                            <tr>
                                <td style="text-align:center;">
                                    <input type="checkbox" class="alat-standar-checkbox" name="alat_standar_{{ $formIndex }}[]" value="Pin Gauge 15 mm"
                                        {{ in_array('Pin Gauge 15 mm', $selectedStandards) ? 'checked' : '' }}>
                                </td>
                                <td colspan="2">Pin Gauge 15 mm</td>
                            </tr>
                            <tr>
                                <td style="text-align:center;">
                                    <input type="checkbox" class="alat-standar-checkbox" name="alat_standar_{{ $formIndex }}[]" value="Ring Gauge 5 mm"
                                        {{ in_array('Ring Gauge 5 mm', $selectedStandards) ? 'checked' : '' }}>
                                </td>
                                <td colspan="2">Ring Gauge 5 mm</td>
                            </tr>
                            
                            <tr>
                                <td style="font-weight:bold;">Metode Kalibrasi</td>
                                <td colspan="3">{{ $form1Head->calibrationMethod ?? 'PAS-IK1102-03 (JIS B 7518:2023 (JMA/JSA); SNSU PK.P-02:2020)' }}</td>
                                <td><input type="text" class="kalibrasi-input" value="{{ $calibration->calibratedBy ?? '' }}" readonly disabled style="background-color: #e9ecef;"></td>
                                <td><input type="text" class="kalibrasi-input" value="{{ $calibration->verifiedBy ?? '' }}" readonly disabled style="background-color: #e9ecef;"></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td colspan="3">&nbsp;</td>
                                <td>TTD :</td>
                                <td>TTD :</td>
                            </tr>
                        </table>
                    @endif
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
    
    // =========================================================
    // TAMBAH & HAPUS BARIS DINAMIS untuk Outside / Inside / Depth
    // =========================================================
    document.addEventListener('click', function(e) {
        // --- 1. TAMBAH BARIS ---
        const addBtn = e.target.closest('.add-row-btn');
        if (addBtn) {
            const tableType = addBtn.dataset.table;   // 'outside' | 'inside' | 'depth'
            const formIndex = addBtn.dataset.form;    // '1', '2', ...
            const targetTableId = addBtn.dataset.targetTable; // e.g. 'outside-table-1'
            
            // Cari tabel via id unik (lebih reliable daripada closest)
            let table = targetTableId ? document.getElementById(targetTableId) : null;
            
            // Fallback: cari dari wrapper terdekat
            if (!table) {
                const tableWrapper = addBtn.closest('.mb-3') || addBtn.parentElement;
                table = tableWrapper ? tableWrapper.querySelector('table') : null;
            }
            if (!table) {
                console.warn('❌ Table not found for', tableType, formIndex);
                return;
            }
            
            // Hitung data row yang ada (bukan header)
            const allDataRows = table.querySelectorAll('tr[style*="height:16pt"]');
            const newIndex = allDataRows.length; // indeks baris baru (0-based)
            
            console.log(`➕ Tambah baris ${tableType} form ${formIndex}, newIndex=${newIndex}`);
            
            let newRow = '';
            
            if (tableType === 'outside') {
                newRow = `
                <tr style="height:16pt">
                    <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                        <input type="text" name="outside_titik_ukur_${formIndex}[${newIndex}]" value=""
                               style="width:100%; text-align:center; border:none; font-size:10pt;">
                    </td>
                    <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                        <input type="text" step="any" name="outside_ulangan01_${formIndex}[${newIndex}]" value=""
                               style="width:100%; text-align:center; border:none; font-size:10pt;">
                    </td>
                    <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                        <input type="text" step="any" name="outside_ulangan02_${formIndex}[${newIndex}]" value=""
                               style="width:100%; text-align:center; border:none; font-size:10pt;">
                    </td>
                    <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                        <input type="text" step="any" name="outside_ulangan03_${formIndex}[${newIndex}]" value=""
                               style="width:100%; text-align:center; border:none; font-size:10pt;">
                    </td>
                    <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                        <input type="text" step="any" name="outside_ulangan04_${formIndex}[${newIndex}]" value=""
                               style="width:100%; text-align:center; border:none; font-size:10pt;">
                    </td>
                    <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                        <input type="text" step="any" name="outside_ulangan05_${formIndex}[${newIndex}]" value=""
                               style="width:100%; text-align:center; border:none; font-size:10pt;">
                    </td>
                </tr>`;
            } else if (tableType === 'inside') {
                newRow = `
                <tr style="height:16pt">
                    <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                        <input type="text" name="inside_titik_ukur_${formIndex}[${newIndex}]" value=""
                               style="width:100%; text-align:center; border:none; font-size:10pt;">
                    </td>
                    <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                        <input type="text" step="any" name="inside_ulangan01_${formIndex}[${newIndex}]" value=""
                               style="width:100%; text-align:center; border:none; font-size:10pt;">
                    </td>
                    <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                        <input type="text" step="any" name="inside_ulangan02_${formIndex}[${newIndex}]" value=""
                               style="width:100%; text-align:center; border:none; font-size:10pt;">
                    </td>
                    <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                        <input type="text" step="any" name="inside_ulangan03_${formIndex}[${newIndex}]" value=""
                               style="width:100%; text-align:center; border:none; font-size:10pt;">
                    </td>
                    <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                        <input type="text" step="any" name="inside_ulangan04_${formIndex}[${newIndex}]" value=""
                               style="width:100%; text-align:center; border:none; font-size:10pt;">
                    </td>
                    <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                        <input type="text" step="any" name="inside_ulangan05_${formIndex}[${newIndex}]" value=""
                               style="width:100%; text-align:center; border:none; font-size:10pt;">
                    </td>
                </tr>`;
            } else if (tableType === 'depth') {
                newRow = `
                <tr style="height:16pt">
                    <td style="width:20%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                        <input type="text" name="depth_titik_ukur_${formIndex}[${newIndex}]" value=""
                               style="width:100%; text-align:center; border:none; font-size:10pt;">
                    </td>
                    <td style="width:10%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                        <input type="text" name="depth_kode_standar_kiri_${formIndex}[${newIndex}]" value=""
                               style="width:100%; text-align:center; border:none; font-size:10pt;">
                    </td>
                    <td style="width:10%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                        <input type="text" name="depth_kode_standar_kanan_${formIndex}[${newIndex}]" value=""
                               style="width:100%; text-align:center; border:none; font-size:10pt;">
                    </td>
                    <td style="width:12%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                        <input type="text" step="any" name="depth_ulangan01_${formIndex}[${newIndex}]" value=""
                               style="width:100%; text-align:center; border:none; font-size:10pt;">
                    </td>
                    <td style="width:12%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                        <input type="text" step="any" name="depth_ulangan02_${formIndex}[${newIndex}]" value=""
                               style="width:100%; text-align:center; border:none; font-size:10pt;">
                    </td>
                    <td style="width:12%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                        <input type="text" step="any" name="depth_ulangan03_${formIndex}[${newIndex}]" value=""
                               style="width:100%; text-align:center; border:none; font-size:10pt;">
                    </td>
                    <td style="width:12%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                        <input type="text" step="any" name="depth_ulangan04_${formIndex}[${newIndex}]" value=""
                               style="width:100%; text-align:center; border:none; font-size:10pt;">
                    </td>
                    <td style="width:12%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                        <input type="text" step="any" name="depth_ulangan05_${formIndex}[${newIndex}]" value=""
                               style="width:100%; text-align:center; border:none; font-size:10pt;">
                    </td>
                </tr>`;
            }
            
            if (newRow) {
                table.insertAdjacentHTML('beforeend', newRow);
                const allTrs = table.querySelectorAll('tr[style*="height:16pt"]');
                const lastTr = allTrs[allTrs.length - 1];
                const firstInput = lastTr ? lastTr.querySelector('input[type="text"]') : null;
                if (firstInput) firstInput.focus();
                console.log(`✅ Baris berhasil ditambahkan ke ${tableType}-table-${formIndex}`);
            }
        }
        
        // --- 2. HAPUS BARIS TERAKHIR ---
        const removeBtn = e.target.closest('.remove-row-btn');
        if (removeBtn) {
            const targetTableId = removeBtn.dataset.targetTable;
            let table = targetTableId ? document.getElementById(targetTableId) : null;
            
            if (!table) {
                const tableWrapper = removeBtn.closest('.mb-3') || removeBtn.parentElement;
                table = tableWrapper ? tableWrapper.querySelector('table') : null;
            }
            if (!table) return;
            
            const dataRows = table.querySelectorAll('tr[style*="height:16pt"]');
            
            // Minimal 6 baris agar format dasar tetap utuh
            if (dataRows.length > 6) {
                dataRows[dataRows.length - 1].remove();
                console.log(`🗑️ Baris terakhir dihapus dari ${targetTableId}`);
            } else {
                alert('Tabel minimal memiliki 6 baris. Tidak dapat menghapus lebih lanjut.');
            }
        }
    });
    
    document.addEventListener('DOMContentLoaded', function() {
        console.log('📄 Edit form loaded for Caliper ID:', {{ $calibration->id }});
        console.log('🔢 Jumlah Form:', {{ $jumlahForm }});
    });
    </script>
</body>
</html>

