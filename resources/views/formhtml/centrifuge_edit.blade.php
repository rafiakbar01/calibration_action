<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kalibrasi Centrifuge - PT. PANANJUNG ANUGRAH SOLUTION</title>
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

    .required-field::after {
        content: " *";
        color: #dc3545;
    }

    .label-col {
        font-weight: bold;
        background-color: #f0f0f0;
        text-align: center;
    }

    .content-col {
        text-align: left;
        padding-left: 15px;
    }

    .signature-col {
        width: 18%;
        font-weight: bold;
        background-color: #f8f8f8;
        text-align: center;
    }

    .name-input {
        width: 90%;
        border: none;
        border-bottom: 1px solid #000;
        background: transparent;
        text-align: center;
        font-size: 10pt;
        outline: none;
    }

    .ttd-row {
        height: 50px;
    }

    @media print {
        .btn { display: none !important; }
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
                $heads = $calibration->headCentrifuge ?? collect();
                $details = $calibration->detailCentrifuges ?? collect();
                $form1Head = $calibration->headCentrifugeForm1;
                
                $standardValue = $form1Head->standard ?? '';
                $selectedStandards = array();
                if (!empty($standardValue)) {
                    if (strpos($standardValue, ', ') !== false) {
                        $selectedStandards = array_map('trim', explode(', ', $standardValue));
                    } elseif (strpos($standardValue, ',') !== false) {
                        $selectedStandards = array_map('trim', explode(',', $standardValue));
                    } else {
                        $selectedStandards = array($standardValue);
                    }
                }
                
                $metodeValue = $form1Head->calibrationMethod ?? 'PAS-IK1102-52';
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
                    $head = $calibration->{'headCentrifugeForm' . $formIndex};
                    $formDetails = $calibration->detailCentrifuges->where('form_index', $formIndex)->sortBy('id');
                    $isFirstForm = ($formIndex == 1);
                    
                    $detailByRow = array();
                    $rowIndex = 1;
                    foreach ($formDetails as $detail) {
                        $detailByRow[$rowIndex] = $detail;
                        $rowIndex++;
                    }
                @endphp
                
                @if($jumlahForm > 1)
                <div class="card mb-4" style="border: 2px solid #3b82f6; border-radius: 8px;">
                    <div class="card-header" style="background: linear-gradient(135deg, #1e40af, #3b82f6); color: white;">
                        <i class="fas fa-file-alt me-2"></i>Form Centrifuge ke-{{ $formIndex }}
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
                                <p style="margin: 0; font-size: 14px;">PAS-FLK52</p>
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
                                <p style="margin: 0; font-weight: bold; font-size: 14px;">CENTRIFUGE</p>
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
                                <p style="margin: 0; font-size: 14px; font-weight: bold;">{{ $head->certificate_id ?? $form1Head->certificate_id ?? 'N/A' }}</p>
                             </div>
                        </tr>
                    </table>

                    <!-- Main Form Section -->
                    <table class="kalibrasi-main-table">
                        <tr>
                            <td style="width: 20%;"><p class="required-field" style="margin:0;">Nama Alat</p></td>
                            <td colspan="3">
                                @if($isFirstForm)
                                    <input type="text" class="kalibrasi-input" name="namaAlat" value="{{ old('namaAlat', $calibration->namaAlat) }}">
                                @else
                                    <input type="text" class="kalibrasi-input" value="{{ $calibration->namaAlat ?? '' }}" readonly disabled>
                                @endif
                             </div>
                        </tr>
                        
                        <tr>
                            <td><p class="required-field" style="margin:0;">Merek</p></td>
                            <td colspan="3">
                                <div class="d-flex align-items-center">
                                    @if($isFirstForm)
                                        <input type="text" class="kalibrasi-input me-3" name="brandAlat" value="{{ old('brandAlat', $calibration->brandAlat) }}" style="width:60%;">
                                        <span class="me-3">Kode Alat :</span>
                                        <input type="text" class="kalibrasi-input" name="kodeAlat" value="{{ old('kodeAlat', $calibration->kodeAlat) }}" style="width:30%;">
                                    @else
                                        <input type="text" class="kalibrasi-input me-3" value="{{ $calibration->brandAlat ?? '' }}" readonly disabled style="width:60%;">
                                        <span class="me-3">Kode Alat :</span>
                                        <input type="text" class="kalibrasi-input" value="{{ $calibration->kodeAlat ?? '' }}" readonly disabled style="width:30%;">
                                    @endif
                                </div>
                             </div>
                        </tr>
                        
                        <tr>
                            <td><p class="required-field" style="margin:0;">Type / No. Seri</p></td>
                            <td colspan="3">
                                <div class="d-flex align-items-center">
                                    @if($isFirstForm)
                                        <input type="text" class="kalibrasi-input me-3" name="typeAlat" value="{{ old('typeAlat', $calibration->typeAlat) }}" style="width:45%;">
                                        <span class="me-3">/</span>
                                        <input type="text" class="kalibrasi-input" name="NoSeri" value="{{ old('NoSeri', $calibration->NoSeri) }}" style="width:45%;">
                                    @else
                                        <input type="text" class="kalibrasi-input me-3" value="{{ $calibration->typeAlat ?? '' }}" readonly disabled style="width:45%;">
                                        <span class="me-3">/</span>
                                        <input type="text" class="kalibrasi-input" value="{{ $calibration->NoSeri ?? '' }}" readonly disabled style="width:45%;">
                                    @endif
                                </div>
                             </div>
                        </tr>
                        
                        <tr>
                            <td><p style="margin:0;">Kapasitas / Resolusi</p></td>
                            <td colspan="3">
                                <div class="d-flex align-items-center">
                                    @if($isFirstForm)
                                        <input type="text" class="kalibrasi-input me-3" name="kapasitas" value="{{ old('kapasitas', $calibration->kapasitas) }}" style="width:45%;">
                                        <span class="me-3">/</span>
                                        <input type="text" class="kalibrasi-input" name="resolusi" value="{{ old('resolusi', $calibration->resolusi) }}" style="width:45%;">
                                    @else
                                        <input type="text" class="kalibrasi-input me-3" value="{{ $calibration->kapasitas ?? '' }}" readonly disabled style="width:45%;">
                                        <span class="me-3">/</span>
                                        <input type="text" class="kalibrasi-input" value="{{ $calibration->resolusi ?? '' }}" readonly disabled style="width:45%;">
                                    @endif
                                </div>
                             </div>
                        </tr>
                        
                        <tr>
                            <td><p class="required-field" style="margin:0;">Nama Pemilik</p></td>
                            <td colspan="3">
                                @if($isFirstForm)
                                    <input type="text" class="kalibrasi-input" name="pemilikAlat" value="{{ old('pemilikAlat', $calibration->pemilikAlat) }}">
                                @else
                                    <input type="text" class="kalibrasi-input" value="{{ $calibration->pemilikAlat ?? '' }}" readonly disabled>
                                @endif
                             </div>
                        </tr>
                        
                        <tr>
                            <td><p class="required-field" style="margin:0;">Tanggal Alat Masuk</p></td>
                            <td colspan="3">
                                @if($isFirstForm)
                                    <input type="date" class="kalibrasi-input" name="tanggalMasuk" value="{{ old('tanggalMasuk', $calibration->tanggalMasuk ? \Carbon\Carbon::parse($calibration->tanggalMasuk)->format('Y-m-d') : '') }}">
                                @else
                                    <input type="date" class="kalibrasi-input" value="{{ $calibration->tanggalMasuk ? \Carbon\Carbon::parse($calibration->tanggalMasuk)->format('Y-m-d') : '' }}" readonly disabled>
                                @endif
                             </div>
                        </tr>
                        
                        <tr>
                            <td><p class="required-field" style="margin:0;">Tanggal Kalibrasi</p></td>
                            <td colspan="3">
                                <div class="d-flex align-items-center">
                                    @if($isFirstForm)
                                        <input type="date" class="kalibrasi-input me-3" name="tanggalKalibrasi" value="{{ old('tanggalKalibrasi', $calibration->tanggalKalibrasi ? \Carbon\Carbon::parse($calibration->tanggalKalibrasi)->format('Y-m-d') : '') }}" style="width:45%;">
                                        <span class="me-3">Jenis Pembacaan:</span>
                                        <input type="text" class="kalibrasi-input" name="jenisPembacaan" value="{{ old('jenisPembacaan', $calibration->jenisPembacaan) }}" style="width:45%;">
                                    @else
                                        <input type="date" class="kalibrasi-input me-3" value="{{ $calibration->tanggalKalibrasi ? \Carbon\Carbon::parse($calibration->tanggalKalibrasi)->format('Y-m-d') : '' }}" readonly disabled style="width:45%;">
                                        <span class="me-3">Jenis Pembacaan:</span>
                                        <input type="text" class="kalibrasi-input" value="{{ $calibration->jenisPembacaan ?? '' }}" readonly disabled style="width:45%;">
                                    @endif
                                </div>
                             </div>
                        </tr>
                        
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
                                            <input class="form-check-input" type="radio" value="lab.PT PAS" disabled>
                                            <label class="form-check-label">Lab. PT.PAS</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="insitu" disabled>
                                            <label class="form-check-label">Insitu</label>
                                        </div>
                                    </div>
                                @endif
                             </div>
                        </tr>
                        
                        <tr>
                            <td><p style="margin:0;">Lokasi PT</p></td>
                            <td colspan="3">
                                @if($isFirstForm)
                                    <input type="text" class="kalibrasi-input" name="lokasiPT" value="{{ old('lokasiPT', $calibration->lokasiPT) }}">
                                @else
                                    <input type="text" class="kalibrasi-input" value="{{ $calibration->lokasiPT ?? '' }}" readonly disabled>
                                @endif
                             </div>
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
                                        {{ old('kondisiAlat', $calibration->kondisiAlat) == 'ok' ? 'checked' : '' }}>
                                </div>
                                <div class="text-center">
                                    <span class="fw-bold d-block mb-2">Rusak</span>
                                    <input type="radio" name="kondisiAlat" value="rusak" class="form-check-input"
                                        {{ old('kondisiAlat', $calibration->kondisiAlat) == 'rusak' ? 'checked' : '' }}>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center">
                                <span class="fw-bold me-3" style="min-width: 100px;">Keterangan :</span>
                                <div style="flex: 1;">
                                    <input type="text" class="kalibrasi-input" name="keterangan" value="{{ old('keterangan', $calibration->keterangan ?? '') }}">
                                </div>
                            </div>
                            @else
                            <div class="d-flex justify-content-center align-items-center mb-4" style="gap: 60px;">
                                <div class="text-center">
                                    <span class="fw-bold d-block mb-2">Ok</span>
                                    <input type="radio" class="form-check-input" disabled>
                                </div>
                                <div class="text-center">
                                    <span class="fw-bold d-block mb-2">Rusak</span>
                                    <input type="radio" class="form-check-input" disabled>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center">
                                <span class="fw-bold me-3" style="min-width: 100px;">Keterangan :</span>
                                <div style="flex: 1;">
                                    <input type="text" class="kalibrasi-input" value="{{ $calibration->keterangan ?? '' }}" readonly disabled>
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
                                    <td><input type="text" class="kondisi-input" name="RT_condition1" value="{{ old('RT_condition1', $calibration->RT_condition1 ?? '') }}"></td>
                                    <td><input type="text" class="kondisi-input" name="RT_condition2" value="{{ old('RT_condition2', $calibration->RT_condition2 ?? '') }}"></td>
                                    <td><input type="text" class="kondisi-input" name="RT_condition3" value="{{ old('RT_condition3', $calibration->RT_condition3 ?? '') }}"></td>
                                </tr>
                                <tr>
                                    <td class="bg-light fw-bold">RH (%)</td>
                                    <td><input type="text" class="kondisi-input" name="RH_condition1" value="{{ old('RH_condition1', $calibration->RH_condition1 ?? '') }}"></td>
                                    <td><input type="text" class="kondisi-input" name="RH_condition2" value="{{ old('RH_condition2', $calibration->RH_condition2 ?? '') }}"></td>
                                    <td><input type="text" class="kondisi-input" name="RH_condition3" value="{{ old('RH_condition3', $calibration->RH_condition3 ?? '') }}"></td>
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
                                    <td><input type="text" class="kondisi-input" value="{{ $calibration->RT_condition1 ?? '' }}" readonly disabled></td>
                                    <td><input type="text" class="kondisi-input" value="{{ $calibration->RT_condition2 ?? '' }}" readonly disabled></td>
                                    <td><input type="text" class="kondisi-input" value="{{ $calibration->RT_condition3 ?? '' }}" readonly disabled></td>
                                </tr>
                                <tr>
                                    <td class="bg-light fw-bold">RH (%)</td>
                                    <td><input type="text" class="kondisi-input" value="{{ $calibration->RH_condition1 ?? '' }}" readonly disabled></td>
                                    <td><input type="text" class="kondisi-input" value="{{ $calibration->RH_condition2 ?? '' }}" readonly disabled></td>
                                    <td><input type="text" class="kondisi-input" value="{{ $calibration->RH_condition3 ?? '' }}" readonly disabled></td>
                                </tr>
                            </table>
                            @endif
                        </div>
                    </div>

                    <!-- DATA KALIBRASI -->
                    <div class="data-kalibrasi-header">DATA KALIBRASI</div>
                    
                    <table class="kalibrasi-data-table">
                        <tr>
                            <td colspan="2" style="border:2px solid #000; text-align:center; padding:8px; font-weight:bold;">Nominal / Setpoint UUT</td>
                            <td colspan="5" style="border:2px solid #000; text-align:center; padding:8px; font-weight:bold;">Pembacaan Standar (rpm)</td>
                            <td colspan="3" rowspan="2" style="border:2px solid #000; text-align:center; vertical-align:middle; padding:8px; font-weight:bold;">Resolusi Alat</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="border:2px solid #000; text-align:center; padding:8px;">rpm</td>
                            <td style="border:2px solid #000; text-align:center; padding:8px;">1</td>
                            <td style="border:2px solid #000; text-align:center; padding:8px;">2</td>
                            <td style="border:2px solid #000; text-align:center; padding:8px;">3</td>
                            <td style="border:2px solid #000; text-align:center; padding:8px;">4</td>
                            <td style="border:2px solid #000; text-align:center; padding:8px;">5</td>
                        </tr>

                        @for($row = 1; $row <= 12; $row++)
                            @php
                                $detail = isset($detailByRow[$row]) ? $detailByRow[$row] : null;
                                $detailId = !is_null($detail) ? $detail->id : '';
                                $nominalRPM = !is_null($detail) ? $detail->nominalRPM : '';
                                $std1 = !is_null($detail) ? $detail->STD1 : '';
                                $std2 = !is_null($detail) ? $detail->STD2 : '';
                                $std3 = !is_null($detail) ? $detail->STD3 : '';
                                $std4 = !is_null($detail) ? $detail->STD4 : '';
                                $std5 = !is_null($detail) ? $detail->STD5 : '';
                                $resolusi = !is_null($detail) ? $detail->resolusi : '';
                            @endphp
                            <tr>
                                <td colspan="2" style="border:2px solid #000; text-align:center; padding:0;">
                                    @if(!empty($detailId))
                                        <input type="hidden" name="detail_ids_{{ $formIndex }}[]" value="{{ $detailId }}">
                                    @endif
                                    <input type="text" name="nominal_{{ $formIndex }}[]" value="{{ $nominalRPM }}" 
                                           style="width:100%; border:none; background:transparent; text-align:center; padding:8px;">
                                </td>
                                <td style="border:2px solid #000; text-align:center; padding:0;">
                                    <input type="text" name="std1_{{ $formIndex }}[]" value="{{ $std1 }}" 
                                           style="width:100%; border:none; background:transparent; text-align:center; padding:8px;">
                                </td>
                                <td style="border:2px solid #000; text-align:center; padding:0;">
                                    <input type="text" name="std2_{{ $formIndex }}[]" value="{{ $std2 }}" 
                                           style="width:100%; border:none; background:transparent; text-align:center; padding:8px;">
                                </td>
                                <td style="border:2px solid #000; text-align:center; padding:0;">
                                    <input type="text" name="std3_{{ $formIndex }}[]" value="{{ $std3 }}" 
                                           style="width:100%; border:none; background:transparent; text-align:center; padding:8px;">
                                </td>
                                <td style="border:2px solid #000; text-align:center; padding:0;">
                                    <input type="text" name="std4_{{ $formIndex }}[]" value="{{ $std4 }}" 
                                           style="width:100%; border:none; background:transparent; text-align:center; padding:8px;">
                                </td>
                                <td style="border:2px solid #000; text-align:center; padding:0;">
                                    <input type="text" name="std5_{{ $formIndex }}[]" value="{{ $std5 }}" 
                                           style="width:100%; border:none; background:transparent; text-align:center; padding:8px;">
                                </td>
                                <td colspan="3" style="border:2px solid #000; text-align:center; padding:0;">
                                    <input type="text" name="resolusi_alat_{{ $formIndex }}[]" value="{{ $resolusi }}" 
                                           style="width:100%; border:none; background:transparent; text-align:center; padding:8px;">
                                </td>
                            </tr>
                        @endfor
                    </table>

                    <!-- Footer Section -->
                    <div class="data-complete-section">
                        <span class="data-complete-text">Data telah diisi dengan lengkap dan jelas!</span>
                    </div>

                    <!-- ALAT STANDAR + METODE KALIBRASI + TTD DALAM SATU TABLE -->
                    <table class="kalibrasi-main-table" style="width:100%; border-collapse: collapse;">
                        <!-- Baris 1: Alat Standar + Header TTD -->
                        <tr>
                            <td rowspan="2" colspan="2" class="label-col">Alat Standar</td>
                            <td rowspan="2" colspan="4" class="content-col">
                                @if($isFirstForm)
                                       <input type="hidden" name="alat_standar_text" value="Tachometer CEM AT-8 (200302615)">
                                   
                                    <label style="cursor:pointer; color:#000000; margin-left:5px;">Tachometer CEM AT-8 (200302615)</label>
                                @else
                                    <span style="color: #666;">Mengikuti Form 1</span>
                                    <input type="hidden" name="alat_standar_{{ $formIndex }}[]" value="Tachometer CEM AT-8 (200302615)">
                                @endif
                            </td>
                            <td colspan="2" class="signature-col">Dikalibrasi oleh</td>
                            <td colspan="2" class="signature-col">Diperiksa oleh</td>
                        </tr>
                        
                        <!-- Baris 2: Baris kosong untuk TTD -->
                        <tr>
                            <td colspan="2" class="ttd-row"></td>
                            <td colspan="2" class="ttd-row"></td>
                        </tr>
                        
                        <!-- Baris 3: Metode Kalibrasi + Header TTD -->
                        <tr>
                            <td rowspan="2" colspan="2" class="label-col">Metode Kalibrasi</td>
                            <td rowspan="2" colspan="4" class="content-col">
                                @if($isFirstForm)
                                    <input type="checkbox" name="metode_kalibrasi[]" value="{{ $metodeValue }}" checked style="display:none;">
                                    {{ $metodeValue }}
                                @else
                                    <span style="color: #666;">Mengikuti Form 1</span>
                                    <input type="hidden" name="metode_kalibrasi_{{ $formIndex }}[]" value="{{ $metodeValue }}">
                                @endif
                            </td>
                            <td colspan="2">TTD :</td>
                            <td colspan="2">TTD :</td>
                        </tr>
                        
                        <!-- Baris 4: Nama Calibrated By dan Verified By -->
                        <tr>
                            <td colspan="2">
                                Nama: <input type="text" name="calibratedBy" class="name-input" value="{{ old('calibratedBy', $calibration->calibratedBy ?? '') }}" readonly>
                            </td>
                            <td colspan="2">
                                Nama: <input type="text" name="verifiedBy" id="verified_by_{{ $formIndex }}" class="name-input" value="{{ old('verifiedBy', $calibration->verifiedBy ?? '') }}" {{ $isFirstForm ? 'readonly' : '' }}>
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
            console.log('Edit form submission started...');
            
            let warningMessages = [];
            
            var tanggalMasuk = document.querySelector('input[name="tanggalMasuk"]');
            var tanggalKalibrasi = document.querySelector('input[name="tanggalKalibrasi"]');
            
            if(tanggalMasuk && tanggalKalibrasi) {
                if (tanggalMasuk.value && tanggalKalibrasi.value) {
                    if (new Date(tanggalMasuk.value) > new Date(tanggalKalibrasi.value)) {
                        warningMessages.push('Tanggal alat masuk tidak boleh lebih baru dari tanggal kalibrasi');
                    }
                }
            }
            
            var kondisiAlatSelected = document.querySelector('input[name="kondisiAlat"]:checked');
            if (!kondisiAlatSelected) {
                warningMessages.push('Pilih kondisi alat (Ok/Rusak)');
            }
            
            var tempatKalibrasiSelected = document.querySelector('input[name="tempatKalibrasi"]:checked');
            if (!tempatKalibrasiSelected) {
                warningMessages.push('Pilih tempat kalibrasi');
            }
            
            if (warningMessages.length > 0) {
                var shouldProceed = confirm(
                    'Peringatan:\n' + 
                    warningMessages.join('\n') + 
                    '\n\nApakah Anda yakin ingin melanjutkan?'
                );
                
                if (!shouldProceed) {
                    e.preventDefault();
                    return false;
                }
            }
            
            var submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan Perubahan...';
                submitBtn.disabled = true;
            }
            
            return true;
        });
        
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Edit form loaded for Centrifuge ID:', {{ $calibration->id }});
            console.log('Jumlah Form:', {{ $jumlahForm }});
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