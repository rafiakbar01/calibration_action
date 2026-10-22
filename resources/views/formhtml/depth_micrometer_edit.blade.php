<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kalibrasi - PT. PANANJUNG ANUGRAH SOLUTION</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    .form-kalibrasi-container,
    .form-kalibrasi-container *:not(input):not(select):not(textarea):not(button) {
        color: #000000 !important;
    }
    
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

    .alat-standar-checkbox {
        width: 18px;
        height: 18px;
        margin: 0;
        cursor: pointer;
    }

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

    .required-field::after {
        content: " *";
        color: #dc3545;
    }

    @media print {
        .btn { display: none !important; }
        .form-card { border: 1px solid #000; break-inside: avoid; }
        .form-card-header { background: #f0f0f0 !important; color: #000 !important; }
    }
    </style>
</head>
<body>
    <div class="container my-4">
        <form action="{{ route('calibrations.update', $calibration->id) }}" method="POST" id="editForm">
            @csrf
            @method('PUT')
            
            @php
                $jumlahForm = request()->query('jumlah_form', $calibration->jumlah_form ?? 1);
                $jumlahForm = max(1, (int)$jumlahForm);
                $heads = $calibration->headDepthMicrometer  ?? collect();
                $details = $calibration->detailDepthMicrometers ?? collect();
                $form1Head = $calibration->headDepthMicrometerForm1;
                
                // Ambil nilai standard dari form 1
                $standardValue = $form1Head->standard ?? '';
                $selectedStandards = [];
                if (!empty($standardValue)) {
                    if (strpos($standardValue, ', ') !== false) {
                        $selectedStandards = array_map('trim', explode(', ', $standardValue));
                    } elseif (strpos($standardValue, ',') !== false) {
                        $selectedStandards = array_map('trim', explode(',', $standardValue));
                    } else {
                        $selectedStandards = [$standardValue];
                    }
                }
            @endphp

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
                    $head = $calibration->{'headDepthMicrometerForm' . $formIndex};
                    $formDetails = $details->where('form_index', $formIndex)->sortBy('id');
                    $isFirstForm = ($formIndex == 1);
                @endphp
                
                @if($jumlahForm > 1)
                <div class="form-card">
                    <div class="form-card-header">
                        <i class="fas fa-file-alt me-2"></i>
                        Form Depth Micrometer ke-{{ $formIndex }}
                        @if(!$isFirstForm)
                            <small class="ms-2">(Data alat mengikuti form 1)</small>
                        @endif
                    </div>
                    <div class="form-card-body">
                @endif
                
                <div class="form-kalibrasi-container">
                    <table class="kalibrasi-header-table">
                        <tr>
                            <td colspan="2">
                                <p style="margin: 0; font-size: 14px;">PAS-FLK06</p>
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
                                <p style="margin: 0; font-weight: bold; font-size: 14px;">MICROMETER DEPTH</p>
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
                                    <input type="text" class="kalibrasi-input" value="{{ $calibration->namaAlat }}" readonly disabled>
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
                                        <input type="text" class="kalibrasi-input me-3" value="{{ $calibration->brandAlat }}" readonly disabled style="width: 60%;">
                                        <span class="me-3">Kode Alat :</span>
                                        <input type="text" class="kalibrasi-input" value="{{ $calibration->kodeAlat }}" readonly disabled style="width: 30%;">
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
                                        <input type="text" class="kalibrasi-input me-3" value="{{ $calibration->typeAlat }}" readonly disabled style="width: 45%;">
                                        <span class="me-3">/</span>
                                        <input type="text" class="kalibrasi-input" value="{{ $calibration->NoSeri }}" readonly disabled style="width: 45%;">
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
                                        <input type="text" class="kalibrasi-input me-3" value="{{ $calibration->kapasitas }}" readonly disabled style="width: 45%;">
                                        <span class="me-3">/</span>
                                        <input type="text" class="kalibrasi-input" value="{{ $calibration->resolusi }}" readonly disabled style="width: 45%;">
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
                                    <input type="text" class="kalibrasi-input" value="{{ $calibration->pemilikAlat }}" readonly disabled>
                                @endif
                            </td>
                        </tr>

                        <!-- Tanggal Alat Masuk -->
                        <tr>
                            <td><p class="required-field" style="margin:0;">Tanggal Alat Masuk</p></td>
                            <td colspan="3">
                                @if($isFirstForm)
                                    <input type="date" class="kalibrasi-input" name="tanggalMasuk" 
                                           value="{{ old('tanggalMasuk', $calibration->tanggalMasuk ? \Carbon\Carbon::parse($calibration->tanggalMasuk)->format('Y-m-d') : '') }}">
                                @else
                                    <input type="date" class="kalibrasi-input" value="{{ $calibration->tanggalMasuk ? \Carbon\Carbon::parse($calibration->tanggalMasuk)->format('Y-m-d') : '' }}" readonly disabled>
                                @endif
                            </td>
                        </tr>

                        <!-- Tanggal Kalibrasi + Jenis Pembacaan -->
                        <tr>
                            <td><p class="required-field" style="margin:0;">Tanggal Kalibrasi</p></td>
                            <td colspan="3">
                                <div class="d-flex align-items-center">
                                    @if($isFirstForm)
                                        <input type="date" class="kalibrasi-input me-3" name="tanggalKalibrasi" 
                                               value="{{ old('tanggalKalibrasi', $calibration->tanggalKalibrasi ? \Carbon\Carbon::parse($calibration->tanggalKalibrasi)->format('Y-m-d') : '') }}"
                                               style="width: 45%;">
                                        <span class="me-3">Jenis Pembacaan:</span>
                                        <input type="text" class="kalibrasi-input" name="jenisPembacaan" 
                                               value="{{ old('jenisPembacaan', $calibration->jenisPembacaan) }}" 
                                               style="width: 45%;">
                                    @else
                                        <input type="date" class="kalibrasi-input me-3" value="{{ $calibration->tanggalKalibrasi ? \Carbon\Carbon::parse($calibration->tanggalKalibrasi)->format('Y-m-d') : '' }}" readonly disabled style="width: 45%;">
                                        <span class="me-3">Jenis Pembacaan:</span>
                                        <input type="text" class="kalibrasi-input" value="{{ $calibration->jenisPembacaan }}" readonly disabled style="width: 45%;">
                                    @endif
                                </div>
                            </td>
                        </tr>

                        <!-- Tempat Kalibrasi -->
                        <tr>
                            <td><p style="margin:0;">Tempat Kalibrasi</p></td>
                            <td colspan="3">
                                @if($isFirstForm)
                                    <div class="d-flex">
                                        <div class="form-check me-5">
                                            <input class="form-check-input" type="radio" name="tempatKalibrasi" value="lab.PT PAS" id="lab_{{ $formIndex }}" 
                                                   {{ old('tempatKalibrasi', $calibration->tempatKalibrasi) == 'lab.PT PAS' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="lab_{{ $formIndex }}">Lab. PT.PAS</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tempatKalibrasi" value="insitu" id="insitu_{{ $formIndex }}" 
                                                   {{ old('tempatKalibrasi', $calibration->tempatKalibrasi) == 'insitu' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="insitu_{{ $formIndex }}">Insitu</label>
                                        </div>
                                    </div>
                                @else
                                    <div class="d-flex">
                                        <div class="form-check me-5">
                                            <input class="form-check-input" type="radio" value="lab.PT PAS" disabled 
                                                   {{ $calibration->tempatKalibrasi == 'lab.PT PAS' ? 'checked' : '' }}>
                                            <label class="form-check-label">Lab. PT.PAS</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="insitu" disabled 
                                                   {{ $calibration->tempatKalibrasi == 'insitu' ? 'checked' : '' }}>
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
                                    <input type="text" class="kalibrasi-input" value="{{ $calibration->lokasiPT }}" readonly disabled>
                                @endif
                            </td>
                        </tr>
                          <tr>
                            <td><p style="margin:0;">TH</p></td>
                            <td colspan="3">
                                @if($isFirstForm)
                                    <input type="text" class="kalibrasi-input" name="kode_th" value="{{ old('kode_th', $calibration->kode_th) }}">
                                @else
                                    <input type="text" class="kalibrasi-input" value="{{ $calibration->kode_th }}" readonly disabled>
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
                                           style="width: 18px; height: 18px; margin: 0 auto; display: block;"
                                           {{ old('kondisiAlat', $calibration->kondisiAlat) == 'ok' ? 'checked' : '' }}>
                                </div>
                                <div class="text-center">
                                    <span class="fw-bold d-block mb-2">Rusak</span>
                                    <input type="radio" name="kondisiAlat" value="rusak" class="form-check-input"
                                           style="width: 18px; height: 18px; margin: 0 auto; display: block;"
                                           {{ old('kondisiAlat', $calibration->kondisiAlat) == 'rusak' ? 'checked' : '' }}>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center">
                                <span class="fw-bold me-3" style="min-width: 100px;">Keterangan :</span>
                                <div style="flex: 1;">
                                    <input type="text" class="kalibrasi-input" name="keterangan" value="{{ old('keterangan', $calibration->keterangan ?? '-') }}" 
                                           style="border: none; border-bottom: 2px solid #000; border-radius: 0; padding: 4px 0; background: transparent; width: 100%;">
                                </div>
                            </div>
                            @else
                            <div class="d-flex justify-content-center align-items-center mb-4" style="gap: 60px;">
                                <div class="text-center">
                                    <span class="fw-bold d-block mb-2">Ok</span>
                                    <input type="radio" value="ok" class="form-check-input" disabled 
                                           {{ $calibration->kondisiAlat == 'ok' ? 'checked' : '' }}>
                                </div>
                                <div class="text-center">
                                    <span class="fw-bold d-block mb-2">Rusak</span>
                                    <input type="radio" value="rusak" class="form-check-input" disabled 
                                           {{ $calibration->kondisiAlat == 'rusak' ? 'checked' : '' }}>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center">
                                <span class="fw-bold me-3" style="min-width: 100px;">Keterangan :</span>
                                <div style="flex: 1;">
                                    <input type="text" class="kalibrasi-input" value="{{ $calibration->keterangan ?? '-' }}" readonly disabled 
                                           style="border: none; border-bottom: 2px solid #000; border-radius: 0; padding: 4px 0; background: #e9ecef; width: 100%;">
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
                                    <td class="bg-light fw-bold">Suhu (℃)</td>
                                    <td><input type="number" class="kondisi-input" name="RT_condition1" value="{{ old('RT_condition1', $calibration->RT_condition1 ?? '') }}" step="0.1"></td>
                                    <td><input type="number" class="kondisi-input" name="RT_condition2" value="{{ old('RT_condition2', $calibration->RT_condition2 ?? '') }}" step="0.1"></td>
                                    <td><input type="number" class="kondisi-input" name="RT_condition3" value="{{ old('RT_condition3', $calibration->RT_condition3 ?? '') }}" step="0.1"></td>
                                </tr>
                                <tr>
                                    <td class="bg-light fw-bold">RH (%)</td>
                                    <td><input type="number" class="kondisi-input" name="RH_condition1" value="{{ old('RH_condition1', $calibration->RH_condition1 ?? '') }}" step="0.1"></td>
                                    <td><input type="number" class="kondisi-input" name="RH_condition2" value="{{ old('RH_condition2', $calibration->RH_condition2 ?? '') }}" step="0.1"></td>
                                    <td><input type="number" class="kondisi-input" name="RH_condition3" value="{{ old('RH_condition3', $calibration->RH_condition3 ?? '') }}" step="0.1"></td>
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
                                    <td class="bg-light fw-bold">Suhu (℃)</td>
                                    <td><input type="number" class="kondisi-input" value="{{ $calibration->RT_condition1 ?? '' }}" readonly disabled style="background-color: #e9ecef;" step="0.1"></td>
                                    <td><input type="number" class="kondisi-input" value="{{ $calibration->RT_condition2 ?? '' }}" readonly disabled style="background-color: #e9ecef;" step="0.1"></td>
                                    <td><input type="number" class="kondisi-input" value="{{ $calibration->RT_condition3 ?? '' }}" readonly disabled style="background-color: #e9ecef;" step="0.1"></td>
                                </tr>
                                <tr>
                                    <td class="bg-light fw-bold">RH (%)</td>
                                    <td><input type="number" class="kondisi-input" value="{{ $calibration->RH_condition1 ?? '' }}" readonly disabled style="background-color: #e9ecef;" step="0.1"></td>
                                    <td><input type="number" class="kondisi-input" value="{{ $calibration->RH_condition2 ?? '' }}" readonly disabled style="background-color: #e9ecef;" step="0.1"></td>
                                    <td><input type="number" class="kondisi-input" value="{{ $calibration->RH_condition3 ?? '' }}" readonly disabled style="background-color: #e9ecef;" step="0.1"></td>
                                </tr>
                            </table>
                            @endif
                        </div>
                    </div>

                    <!-- Data Kalibrasi Section -->
                    <div class="data-kalibrasi-header">DATA KALIBRASI</div>
                    
                    <div class="mb-3">
                        <span style="font-size: 16px; font-weight: bold;">Uji Skala Nominal</span>
                    </div>
                    
                    <table class="kalibrasi-data-table">
                        <tr style="background: #d9d9d9;">
                            <td style="width: 20%;"><span style="font-weight: bold;">Nilai Nominal</span></td>
                            <td colspan="5"><span style="font-weight: bold;">Penunjukan Alat</span></td>
                        </tr>
                        <tr style="background: #e8e8e8;">
                            <td style="vertical-align: middle;">
                                <div style="display: flex; align-items: center; justify-content: center;">
                                    <span style="font-weight: bold; margin-right: 5px;">Unit (</span>
                                    <input type="text" name="satuan_unit_{{ $formIndex }}" 
                                           value="{{ old('satuan_unit_' . $formIndex, $head->satuan_unit ?? 'mm') }}"
                                           style="width: 80px; padding: 5px; border: 1px solid #ccc; border-radius: 3px; text-align: center;">
                                    <span style="font-weight: bold; margin-left: 5px;">)</span>
                                </div>
                             </td>
                            <td style="width: 16%;"><span style="font-weight: bold;">1</span></td>
                            <td style="width: 16%;"><span style="font-weight: bold;">2</span></td>
                            <td style="width: 16%;"><span style="font-weight: bold;">3</span></td>
                            <td style="width: 16%;"><span style="font-weight: bold;">4</span></td>
                            <td style="width: 16%;"><span style="font-weight: bold;">5</span></td>
                        </tr>

                        @php
                            $detailArray = [];
                            foreach ($formDetails as $detail) {
                                $detailArray[] = $detail;
                            }
                        @endphp

                        @for($i = 0; $i < 14; $i++)
                            @php
                                $detail = $detailArray[$i] ?? null;
                                $detailId = $detail->id ?? null;
                                
                                $titikUkur = old("titikUkur_{$formIndex}_{$i}", $detail->titikUkur ?? '');
                                $ulangan01 = old("ulangan01_{$formIndex}_{$i}", $detail->ulangan01 ?? '');
                                $ulangan02 = old("ulangan02_{$formIndex}_{$i}", $detail->ulangan02 ?? '');
                                $ulangan03 = old("ulangan03_{$formIndex}_{$i}", $detail->ulangan03 ?? '');
                                $ulangan04 = old("ulangan04_{$formIndex}_{$i}", $detail->ulangan04 ?? '');
                                $ulangan05 = old("ulangan05_{$formIndex}_{$i}", $detail->ulangan05 ?? '');
                            @endphp
                            
                            <tr style="height:21.3pt;">
                                <td style="border:2px solid #000; padding:0; background: #f0f0f0;">
                                    @if($detailId)
                                        <input type="hidden" name="detail_ids_{{ $formIndex }}[]" value="{{ $detailId }}">
                                    @endif
                                    <input type="number" name="titikUkur_{{ $formIndex }}[]" value="{{ $titikUkur }}" step="0.01" 
                                           style="width:100%;height:100%;border:none;background:transparent;text-align:center;font-size:10pt;color:#000;padding:2px;">
                                 </td>
                                <td style="border:2px solid #000; padding:0;">
                                    <input type="number" name="ulangan01_{{ $formIndex }}[]" value="{{ $ulangan01 }}" step="0.001" 
                                           style="width:100%;height:100%;border:none;background:transparent;text-align:center;font-size:10pt;color:#000;padding:2px;">
                                 </td>
                                <td style="border:2px solid #000; padding:0;">
                                    <input type="number" name="ulangan02_{{ $formIndex }}[]" value="{{ $ulangan02 }}" step="0.001" 
                                           style="width:100%;height:100%;border:none;background:transparent;text-align:center;font-size:10pt;color:#000;padding:2px;">
                                 </td>
                                <td style="border:2px solid #000; padding:0;">
                                    <input type="number" name="ulangan03_{{ $formIndex }}[]" value="{{ $ulangan03 }}" step="0.001" 
                                           style="width:100%;height:100%;border:none;background:transparent;text-align:center;font-size:10pt;color:#000;padding:2px;">
                                 </td>
                                <td style="border:2px solid #000; padding:0;">
                                    <input type="number" name="ulangan04_{{ $formIndex }}[]" value="{{ $ulangan04 }}" step="0.001" 
                                           style="width:100%;height:100%;border:none;background:transparent;text-align:center;font-size:10pt;color:#000;padding:2px;">
                                 </td>
                                <td style="border:2px solid #000; padding:0;">
                                    <input type="number" name="ulangan05_{{ $formIndex }}[]" value="{{ $ulangan05 }}" step="0.001" 
                                           style="width:100%;height:100%;border:none;background:transparent;text-align:center;font-size:10pt;color:#000;padding:2px;">
                                 </td>
                            </tr>
                        @endfor
                    </table>

                    <!-- Footer Section -->
                    <div class="data-complete-section">
                        <span class="data-complete-text">Data telah diisi dengan lengkap dan jelas!</span>
                    </div>

                <!-- ALAT STANDAR - HANYA DI FORM 1 SAJA YANG BISA DIEDIT -->
@if($isFirstForm)
    @php
        // Ambil nilai standard dari form 1 untuk edit form
        $standardValueEdit = $form1Head->standard ?? '';
    @endphp
    <table class="alat-standar-table">
        <tr>
            <td rowspan="5" style="width:20%; text-align:center; font-weight:bold; font-size:14px;">Alat Standar</td>
            <td style="width:24.75pt; text-align:center;">
                <input type="checkbox" class="alat-standar-checkbox" name="alat_standar[]" value="Gauge Block (150mm) D.007" id="alat1_{{ $formIndex }}" 
                    {{ str_contains($standardValueEdit, 'Gauge Block (150mm) D.007') ? 'checked' : '' }}>
             </td>
            <td colspan="2"><label for="alat1_{{ $formIndex }}">Gauge Block (150mm) D.007</label></td>
            <td rowspan="5" style="width:111.15pt; text-align:center;">Dikalibrasi<br>oleh</td>
            <td rowspan="5" style="width:98.3pt; text-align:center;">Diperiksa<br>oleh</td>
         </tr>
        <tr>
            <td style="text-align:center;">
                <input type="checkbox" class="alat-standar-checkbox" name="alat_standar[]" value="Gauge Block (300mm) D.008" id="alat2_{{ $formIndex }}" 
                    {{ str_contains($standardValueEdit, 'Gauge Block (300mm) D.008') ? 'checked' : '' }}>
             </td>
            <td colspan="2"><label for="alat2_{{ $formIndex }}">Gauge Block (300mm) D.008</label></td>
         </tr>
        <tr>
            <td style="text-align:center;">
                <input type="checkbox" class="alat-standar-checkbox" name="alat_standar[]" value="Gauge Block (300mm) D.009" id="alat3_{{ $formIndex }}" 
                    {{ str_contains($standardValueEdit, 'Gauge Block (300mm) D.009') ? 'checked' : '' }}>
             </td>
            <td colspan="2"><label for="alat3_{{ $formIndex }}">Gauge Block (300mm) D.009</label></td>
         </tr>
        <tr>
            <td style="text-align:center;">
                <input type="checkbox" class="alat-standar-checkbox" name="alat_standar[]" value="Gauge Block Set Grade 0.5 ~ 100 mm 0 D.012" id="alat4_{{ $formIndex }}" 
                    {{ str_contains($standardValueEdit, 'Gauge Block Set Grade 0.5 ~ 100 mm 0 D.012') ? 'checked' : '' }}>
             </td>
            <td colspan="2"><label for="alat4_{{ $formIndex }}">Gauge Block Set Grade 0.5 ~ 100 mm 0 D.012</label></td>
         </tr>
        <tr>
            <td style="text-align:center;">
                <input type="checkbox" class="alat-standar-checkbox" name="alat_standar[]" value="Gauge Block Set Grade 2.5 ~ 25 mm 0 D.013" id="alat5_{{ $formIndex }}" 
                    {{ str_contains($standardValueEdit, 'Gauge Block Set Grade 2.5 ~ 25 mm 0 D.013') ? 'checked' : '' }}>
             </td>
            <td colspan="2"><label for="alat5_{{ $formIndex }}">Gauge Block Set Grade 2.5 ~ 25 mm 0 D.013</label></td>
         </tr>
        <tr>
            <td style="font-weight:bold;">Metode Kalibrasi</td>
            <td colspan="3">PAS-IK1102-06 (JIS B 7544 : 1994)</td>
            <td><input type="text" class="kalibrasi-input" name="calibratedBy" value="{{ old('calibratedBy', $calibration->calibratedBy ?? '') }}" style="border: none; width: 100%;" readonly></td>
            <td><input type="text" class="kalibrasi-input" name="verifiedBy" value="{{ old('verifiedBy', $calibration->verifiedBy ?? '') }}"  readonly style="border: none; width: 100%;"></td>
         </tr>
        <tr>
            <td>&nbsp;</td>
            <td colspan="3">&nbsp;</td>
            <td>TTD :</td>
            <td>TTD :</td>
         </tr>
     </table>
@else
    <!-- FORM 2,3,4 - TAMPILAN DATA DARI FORM 1 (READONLY/DISABLED) -->
    <table class="alat-standar-table">
        <tr>
            <td rowspan="5" style="width:20%; text-align:center; font-weight:bold; font-size:14px;">Alat Standar</td>
            <td style="width:24.75pt; text-align:center;">
                <input type="checkbox" class="alat-standar-checkbox" disabled 
                    {{ str_contains($form1Head->standard ?? '', 'Gauge Block (150mm) D.007') ? 'checked' : '' }}>
             </td>
            <td colspan="2">Gauge Block (150mm) D.007</td>
            <td rowspan="5" style="width:111.15pt; text-align:center;">Dikalibrasi<br>oleh</td>
            <td rowspan="5" style="width:98.3pt; text-align:center;">Diperiksa<br>oleh</td>
         </tr>
        <tr>
            <td style="text-align:center;">
                <input type="checkbox" class="alat-standar-checkbox" disabled 
                    {{ str_contains($form1Head->standard ?? '', 'Gauge Block (300mm) D.008') ? 'checked' : '' }}>
             </td>
            <td colspan="2">Gauge Block (300mm) D.008</td>
         </tr>
        <tr>
            <td style="text-align:center;">
                <input type="checkbox" class="alat-standar-checkbox" disabled 
                    {{ str_contains($form1Head->standard ?? '', 'Gauge Block (300mm) D.009') ? 'checked' : '' }}>
             </td>
            <td colspan="2">Gauge Block (300mm) D.009</td>
         </tr>
        <tr>
            <td style="text-align:center;">
                <input type="checkbox" class="alat-standar-checkbox" disabled 
                    {{ str_contains($form1Head->standard ?? '', 'Gauge Block Set Grade 0.5 ~ 100 mm 0 D.012') ? 'checked' : '' }}>
             </td>
            <td colspan="2">Gauge Block Set Grade 0.5 ~ 100 mm 0 D.012</td>
         </tr>
        <tr>
            <td style="text-align:center;">
                <input type="checkbox" class="alat-standar-checkbox" disabled 
                    {{ str_contains($form1Head->standard ?? '', 'Gauge Block Set Grade 2.5 ~ 25 mm 0 D.013') ? 'checked' : '' }}>
             </td>
            <td colspan="2">Gauge Block Set Grade 2.5 ~ 25 mm 0 D.013</td>
         </tr>
        <tr>
            <td style="font-weight:bold;">Metode Kalibrasi</td>
            <td colspan="3">PAS-IK1102-06 (JIS B 7544 : 1994)</td>
            <td><input type="text" class="kalibrasi-input" value="{{ $calibration->calibratedBy ?? '' }}" readonly disabled style="border: none; width: 100%; background-color: #e9ecef;"></td>
            <td><input type="text" class="kalibrasi-input" value="{{ $calibration->verifiedBy ?? '' }}" readonly disabled style="border: none; width: 100%; background-color: #e9ecef;"></td>
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
var tempFormDataStore = window.tempFormDataStore;
var isRestoring = window.isRestoring;
var tabSubmitStatus = window.tabSubmitStatus;
var currentActiveTabId = '1';

    document.getElementById('editForm')?.addEventListener('submit', function(e) {
        console.log('🎯 Edit form submission started...');
        
        const formData = new FormData(this);
        
        const alatStandarCheckboxes = document.querySelectorAll('.alat-standar-checkbox:checked');
        console.log('✅ Checked alat standar:', alatStandarCheckboxes.length);
        
        const kondisiAlatSelected = document.querySelector('input[name="kondisiAlat"]:checked');
        console.log('🎚️ Kondisi alat selected:', kondisiAlatSelected ? kondisiAlatSelected.value : 'none');
        
        const tempatKalibrasiSelected = document.querySelector('input[name="tempatKalibrasi"]:checked');
        console.log('📍 Tempat kalibrasi selected:', tempatKalibrasiSelected ? tempatKalibrasiSelected.value : 'none');
        
        let isValid = true;
        let warningMessages = [];
        
        // Validasi tanggal
        const tanggalMasuk = document.querySelector('input[name="tanggalMasuk"]').value;
        const tanggalKalibrasi = document.querySelector('input[name="tanggalKalibrasi"]').value;
        
        if (tanggalMasuk && tanggalKalibrasi) {
            if (new Date(tanggalMasuk) > new Date(tanggalKalibrasi)) {
                warningMessages.push('Tanggal alat masuk tidak boleh lebih baru dari tanggal kalibrasi');
            }
        }
        
        // Validasi numeric fields
        document.querySelectorAll('input[type="number"]').forEach(input => {
            if (input.value && isNaN(parseFloat(input.value))) {
                input.style.borderColor = '#ffc107';
                warningMessages.push(`${input.name} harus berupa angka`);
            } else {
                input.style.borderColor = '';
            }
        });
        
        // Validasi alat standar (minimal satu dipilih)
        if (alatStandarCheckboxes.length === 0) {
            const alatStandarSection = document.querySelector('.alat-standar-table');
            if (alatStandarSection) {
                alatStandarSection.style.border = '2px solid #ffc107';
                warningMessages.push('Pilih minimal satu alat standar');
            }
        } else {
            const alatStandarSection = document.querySelector('.alat-standar-table');
            if (alatStandarSection) alatStandarSection.style.border = '';
        }
        
        // Validasi kondisi alat
        if (!kondisiAlatSelected) {
            const kondisiSection = document.querySelector('.kalibrasi-section-header');
            if (kondisiSection) {
                kondisiSection.style.color = '#ffc107';
                warningMessages.push('Pilih kondisi alat (Ok/Rusak)');
            }
        } else {
            const kondisiSection = document.querySelector('.kalibrasi-section-header');
            if (kondisiSection) kondisiSection.style.color = '';
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
        
        // Loading indicator
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
    
    document.addEventListener('DOMContentLoaded', function() {
        console.log('📄 Edit form loaded for Depth Micrometer ID:', {{ $calibration->id }});
        console.log('🔢 Jumlah form:', {{ $jumlahForm }});
        
        // Highlight empty important fields
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