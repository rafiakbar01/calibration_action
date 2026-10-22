<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kalibrasi Mikropipet/Dispenset - PT. PANANJUNG ANUGRAH SOLUTION</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

    .form-check-input[type="checkbox"]:checked:disabled,
    .alat-standar-checkbox[type="checkbox"]:checked:disabled {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
        opacity: 1 !important;
    }

    .form-check-input[type="checkbox"]:disabled,
    .alat-standar-checkbox[type="checkbox"]:disabled {
        background-color: #f8f9fa !important;
        border-color: #6c757d !important;
        opacity: 1 !important;
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
        margin-top: 20px;
    }

    .alat-standar-table td {
        border: 1px solid #000;
        padding: 8px;
        vertical-align: middle;
    }

    .alat-standar-table input[type="checkbox"] {
        width: 18px;
        height: 18px;
        margin-right: 8px;
        vertical-align: middle;
    }

    @media print {
        .btn { display: none !important; }
        body { background: white !important; }
        .container { max-width: 100% !important; margin: 0 !important; padding: 0 !important; }
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

    .form-card {
        border: 2px solid #3b82f6;
        border-radius: 8px;
        margin-bottom: 30px;
        break-inside: avoid;
        page-break-inside: avoid;
    }

    .form-card-header {
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        color: white;
        padding: 12px 20px;
        border-radius: 6px 6px 0 0;
    }

    .form-card-body {
        padding: 20px;
        background: white;
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
                $allDetails = $calibration->detailMikropipetDispensets ?? collect();
                
                // Kelompokkan details berdasarkan form_index
                $detailsByForm = [];
                foreach ($allDetails as $detail) {
                    $formIdx = $detail->form_index ?? 1;
                    if (!isset($detailsByForm[$formIdx])) {
                        $detailsByForm[$formIdx] = [];
                    }
                    $detailsByForm[$formIdx][] = $detail;
                }
                
                // Urutkan berdasarkan ID untuk setiap form
                foreach ($detailsByForm as $formIdx => $details) {
                    usort($detailsByForm[$formIdx], function($a, $b) {
                        return $a->id <=> $b->id;
                    });
                }
                
                $form1Head = $calibration->headMikropipetDispensetForm1 ?? $calibration->headMikropipetDispenset;
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
                    $head = $calibration->{'headMikropipetDispensetForm' . $formIndex} ?? $calibration->headMikropipetDispenset;
                    
                    $formDetails = $detailsByForm[$formIndex] ?? [];
                    
                    // Ambil berdasarkan urutan array (0,1,2,3,4)
                    $detailAtasKiri   = $formDetails[0] ?? null;
                    $detailAtasKanan  = $formDetails[1] ?? null;
                    $detailBawahKiri  = $formDetails[2] ?? null;
                    $detailBawahKanan = $formDetails[3] ?? null;
                    $detailTambahanKiri = $formDetails[4] ?? null;
                    
                    $isFirstForm = ($formIndex == 1);
                    
                    // Data alat standar dari form 1
                    $standardString = $form1Head->standard ?? '';
                    $alatStandarData = [];
                    if (!empty($standardString)) {
                        if (strpos($standardString, ', ') !== false) {
                            $alatStandarData = array_map('trim', explode(', ', $standardString));
                        } elseif (strpos($standardString, ',') !== false) {
                            $alatStandarData = array_map('trim', explode(',', $standardString));
                        } else {
                            $alatStandarData = [$standardString];
                        }
                    }
                    
                    $isSelected = function($value) use ($alatStandarData) {
                        return in_array($value, $alatStandarData, true);
                    };
                @endphp
                
                @if($jumlahForm > 1)
                <div class="form-card">
                    <div class="form-card-header">
                        <i class="fas fa-file-alt me-2"></i>Form Mikropipet/Dispenset ke-{{ $formIndex }}
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
                                <p style="margin: 0; font-size: 14px;">PAS-FLK38</p>
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
                                <p style="margin: 0; font-weight: bold; font-size: 14px;">VOLUMETRIK: MIKROPIPET, DISPENSET</p>
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
                                    {{ $head->certificate_id ?? ($form1Head->certificate_id ?? 'N/A') }}
                                </p>
                            </td>
                        </tr>
                    </table>

                    <table class="kalibrasi-main-table">
                        <tr>
                            <td style="width: 20%;"><p class="required-field" style="margin:0;">Nama Alat</p></td>
                            <td colspan="3">
                                @if($isFirstForm)
                                    <input type="text" class="kalibrasi-input" name="namaAlat" value="{{ old('namaAlat', $calibration->namaAlat) }}">
                                @else
                                    <input type="text" class="kalibrasi-input" value="{{ $calibration->namaAlat }}" readonly>
                                @endif
                            </td>
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
                                        <input type="text" class="kalibrasi-input me-3" value="{{ $calibration->brandAlat }}" readonly style="width:60%;">
                                        <span class="me-3">Kode Alat :</span>
                                        <input type="text" class="kalibrasi-input" value="{{ $calibration->kodeAlat }}" readonly style="width:30%;">
                                    @endif
                                </div>
                            </td>
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
                                        <input type="text" class="kalibrasi-input me-3" value="{{ $calibration->typeAlat }}" readonly style="width:45%;">
                                        <span class="me-3">/</span>
                                        <input type="text" class="kalibrasi-input" value="{{ $calibration->NoSeri }}" readonly style="width:45%;">
                                    @endif
                                </div>
                            </td>
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
                                        <input type="text" class="kalibrasi-input me-3" value="{{ $calibration->kapasitas }}" readonly style="width:45%;">
                                        <span class="me-3">/</span>
                                        <input type="text" class="kalibrasi-input" value="{{ $calibration->resolusi }}" readonly style="width:45%;">
                                    @endif
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><p class="required-field" style="margin:0;">Nama Pemilik</p></td>
                            <td colspan="3">
                                @if($isFirstForm)
                                    <input type="text" class="kalibrasi-input" name="pemilikAlat" value="{{ old('pemilikAlat', $calibration->pemilikAlat) }}">
                                @else
                                    <input type="text" class="kalibrasi-input" value="{{ $calibration->pemilikAlat }}" readonly>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><p class="required-field" style="margin:0;">Tanggal Alat Masuk</p></td>
                            <td colspan="3">
                                @if($isFirstForm)
                                    <input type="date" class="kalibrasi-input" name="tanggalMasuk" value="{{ old('tanggalMasuk', $calibration->tanggalMasuk ? \Carbon\Carbon::parse($calibration->tanggalMasuk)->format('Y-m-d') : '') }}">
                                @else
                                    <input type="date" class="kalibrasi-input" value="{{ $calibration->tanggalMasuk ? \Carbon\Carbon::parse($calibration->tanggalMasuk)->format('Y-m-d') : '' }}" readonly>
                                @endif
                            </td>
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
                                        <input type="date" class="kalibrasi-input me-3" value="{{ $calibration->tanggalKalibrasi ? \Carbon\Carbon::parse($calibration->tanggalKalibrasi)->format('Y-m-d') : '' }}" readonly style="width:45%;">
                                        <span class="me-3">Jenis Pembacaan:</span>
                                        <input type="text" class="kalibrasi-input" value="{{ $calibration->jenisPembacaan }}" readonly style="width:45%;">
                                    @endif
                                </div>
                            </td>
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
                        <tr>
                            <td><p style="margin:0;">Lokasi PT</p></td>
                            <td colspan="3">
                                @if($isFirstForm)
                                    <input type="text" class="kalibrasi-input" name="lokasiPT" value="{{ old('lokasiPT', $calibration->lokasiPT) }}">
                                @else
                                    <input type="text" class="kalibrasi-input" value="{{ $calibration->lokasiPT }}" readonly>
                                @endif
                            </td>
                        </tr>
                    </table>

                    <div class="row mt-4">
                        <div class="col-md-6 mb-4">
                            <div class="kalibrasi-section-header">Fungsi Komponen Lainnya</div>
                            
                            @if($isFirstForm)
                            <div class="d-flex justify-content-center align-items-center mb-4" style="gap: 60px;">
                                <div class="text-center">
                                    <span class="fw-bold d-block mb-2" style="font-size: 14px;">Ok</span>
                                    <input type="radio" name="kondisiAlat" value="ok" class="form-check-input" 
                                        style="width: 18px; height: 18px; display: block; margin: 0 auto;"
                                        {{ old('kondisiAlat', $calibration->kondisiAlat) == 'ok' ? 'checked' : '' }}>
                                </div>
                                <div class="text-center">
                                    <span class="fw-bold d-block mb-2" style="font-size: 14px;">Rusak</span>
                                    <input type="radio" name="kondisiAlat" value="rusak" class="form-check-input"
                                        style="width: 18px; height: 18px; display: block; margin: 0 auto;"
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
                                    <span class="fw-bold d-block mb-2" style="font-size: 14px;">Ok</span>
                                    <input type="radio" value="ok" class="form-check-input" 
                                        style="width: 18px; height: 18px; display: block; margin: 0 auto;" disabled
                                        {{ $calibration->kondisiAlat == 'ok' ? 'checked' : '' }}>
                                </div>
                                <div class="text-center">
                                    <span class="fw-bold d-block mb-2" style="font-size: 14px;">Rusak</span>
                                    <input type="radio" value="rusak" class="form-check-input"
                                        style="width: 18px; height: 18px; display: block; margin: 0 auto;" disabled
                                        {{ $calibration->kondisiAlat == 'rusak' ? 'checked' : '' }}>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center">
                                <span class="fw-bold me-3" style="min-width: 100px;">Keterangan :</span>
                                <div style="flex: 1;">
                                    <input type="text" class="kalibrasi-input" value="{{ $calibration->keterangan ?? '-' }}" 
                                           style="border: none; border-bottom: 2px solid #000; border-radius: 0; padding: 4px 0; background: #e9ecef; width: 100%;" readonly>
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
                                    <td><input type="number" class="kondisi-input" value="{{ $calibration->RT_condition1 ?? '' }}" step="0.1" readonly disabled style="background-color: #e9ecef;"></td>
                                    <td><input type="number" class="kondisi-input" value="{{ $calibration->RT_condition2 ?? '' }}" step="0.1" readonly disabled style="background-color: #e9ecef;"></td>
                                    <td><input type="number" class="kondisi-input" value="{{ $calibration->RT_condition3 ?? '' }}" step="0.1" readonly disabled style="background-color: #e9ecef;"></td>
                                </tr>
                                <tr>
                                    <td class="bg-light fw-bold">RH (%)</td>
                                    <td><input type="number" class="kondisi-input" value="{{ $calibration->RH_condition1 ?? '' }}" step="0.1" readonly disabled style="background-color: #e9ecef;"></td>
                                    <td><input type="number" class="kondisi-input" value="{{ $calibration->RH_condition2 ?? '' }}" step="0.1" readonly disabled style="background-color: #e9ecef;"></td>
                                    <td><input type="number" class="kondisi-input" value="{{ $calibration->RH_condition3 ?? '' }}" step="0.1" readonly disabled style="background-color: #e9ecef;"></td>
                                </tr>
                            </table>
                            @endif
                        </div>
                    </div>
                    
                    <div class="data-kalibrasi-header">DATA KALIBRASI</div>
                    
                    <!-- Tabel Data Kalibrasi Bagian Atas Kiri dan Kanan -->
                <table cellspacing="0" cellpadding="0" style="width:100%; max-width:860pt; border-collapse:collapse; font-family:Arial,Helvetica,sans-serif; margin:0 auto;">
    <tr>
        <td colspan="9" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; padding:12pt 0;">
            <span style="font-size:12pt; font-weight:bold;">DATA KALIBRASI</span>
        </td>
    </tr>
    <tr style="height:55pt;">
        <td rowspan="2" style="width:130pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle; padding:8pt;">
            <span style="font-size:10pt; font-weight:bold;">Nominal Alat Ukur</span><br>
            <span style="font-family:'Lucida Console'; letter-spacing:0.5em">
                (
                <input type="text" 
                       name="satuan_alat_ukur_kiri_{{ $formIndex }}"
                       value="{{ $head->satuan_alat_ukur_kiri ?? '' }}"
                       style="width:60px; border:none; outline:none; background:transparent; text-align:center; font-family:'Lucida Console'; font-size:12pt;"
                       placeholder="-">
                )
            </span>
        </td>
        <td colspan="3" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; padding:8pt;">
            <span style="font-size:10pt; font-weight:bold;">Pembacaan Timbangan (g)</span>
        </td>
        <td rowspan="41" style="width:40pt; border-left:0.75pt solid #000; border-right:0.75pt solid #000;">&nbsp;</td>
        <td rowspan="2" style="width:130pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle; padding:8pt;">
            <span style="font-size:10pt; font-weight:bold;">Nominal Alat Ukur</span><br>
            <span style="font-family:'Lucida Console'; letter-spacing:0.5em">
                (
                <input type="text" 
                       name="satuan_alat_ukur_kanan_{{ $formIndex }}"
                       value="{{ $head->satuan_alat_ukur_kanan ?? '' }}"
                       style="width:60px; border:none; outline:none; background:transparent; text-align:center; font-family:'Lucida Console'; font-size:12pt;"
                       placeholder="-">
                )
            </span>
        </td>
        <td colspan="3" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; padding:8pt;">
            <span style="font-size:10pt; font-weight:bold;">Pembacaan Timbangan (g)</span>
        </td>
    </tr>
    <tr style="height:30pt;">
        <td style="width:70pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;"><b>m</b></td>
        <td colspan="2" style="width:160pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;"><b>Nilai</b></td>
        <td style="width:70pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;"><b>m</b></td>
        <td colspan="2" style="width:160pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;"><b>Nilai</b></td>
    </tr>

    @for($i = 0; $i <= 11; $i++)
    <tr style="height:25pt;">
        @if($i == 0)
            <td rowspan="12" style="border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:14pt; font-weight:bold;">
                <input type="text"
                       name="nominal_kiri_{{ $formIndex }}"
                       value="{{ $detailAtasKiri->titikUkur ?? '' }}"
                       style="border:none; outline:none; background:transparent; width:100%; text-align:center; font-size:inherit; color:inherit;">
            </td>
        @endif
        <td style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">
            m<sub>{{ $i }}</sub>
        </td>
        <td colspan="2" style="border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:11pt;">
            <input type="text"
                   name="m{{ $i }}_kiri_{{ $formIndex }}"
                   value="{{ $detailAtasKiri->{'m'.$i} ?? '' }}"
                   style="border:none; outline:none; background:transparent; width:100%; text-align:center; font-size:inherit; color:inherit;">
        </td>
        
        @if($i == 0)
            <td rowspan="12" style="border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:14pt; font-weight:bold;">
                <input type="text"
                       name="nominal_kanan_{{ $formIndex }}"
                       value="{{ $detailAtasKanan->titikUkur ?? '' }}"
                       style="border:none; outline:none; background:transparent; width:100%; text-align:center; font-size:14pt; font-weight:bold;">
            </td>
        @endif
        <td style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">
            m<sub>{{ $i }}</sub>
        </td>
        <td colspan="2" style="border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:11pt;">
            <input type="text"
                   name="m{{ $i }}_kanan_{{ $formIndex }}"
                   value="{{ $detailAtasKanan->{'m'.$i} ?? '' }}"
                   style="border:none; outline:none; background:transparent; width:100%; text-align:center; font-size:11pt;">
        </td>
    </tr>
    @endfor

    <!-- Parameter Pendukung Header Atas -->
    <tr style="height:30pt;">
        <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;"><b>Parameter Pendukung</b></td>
        <td style="width:80pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center;"><b>Awal</b></td>
        <td style="width:80pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center;"><b>Akhir</b></td>
        <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;"><b>Parameter Pendukung</b></td>
        <td style="width:80pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center;"><b>Awal</b></td>
        <td style="width:80pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center;"><b>Akhir</b></td>
    </tr>

    <!-- Suhu Udara Atas -->
    <tr style="height:25pt;">
        <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Suhu Udara (°C)</td>
        <td style="border:0.75pt solid #000; text-align:center;">
            <input type="text" name="suhu_awal_kiri_{{ $formIndex }}" value="{{ $detailAtasKiri->TUdaraS ?? '' }}" style="border:none;background:transparent;width:100%;text-align:center;">
        </td>
        <td style="border:0.75pt solid #000; text-align:center;">
            <input type="text" name="suhu_akhir_kiri_{{ $formIndex }}" value="{{ $detailAtasKiri->TUdaraE ?? '' }}" style="border:none;background:transparent;width:100%;text-align:center;">
        </td>
        <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Suhu Udara (°C)</td>
        <td style="border:0.75pt solid #000; text-align:center;">
            <input type="text" name="suhu_awal_kanan_{{ $formIndex }}" value="{{ $detailAtasKanan->TUdaraS ?? '' }}" style="border:none;background:transparent;width:100%;text-align:center;">
        </td>
        <td style="border:0.75pt solid #000; text-align:center;">
            <input type="text" name="suhu_akhir_kanan_{{ $formIndex }}" value="{{ $detailAtasKanan->TUdaraE ?? '' }}" style="border:none;background:transparent;width:100%;text-align:center;">
        </td>
    </tr>

    <!-- Kelembaban Udara Atas -->
    <tr style="height:25pt;">
        <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Kelembaban Udara (%rh)</td>
        <td style="border:0.75pt solid #000; text-align:center;">
            <input type="text" name="kelembaban_awal_kiri_{{ $formIndex }}" value="{{ $detailAtasKiri->RHS ?? '' }}" style="border:none;background:transparent;width:100%;text-align:center;">
        </td>
        <td style="border:0.75pt solid #000; text-align:center;">
            <input type="text" name="kelembaban_akhir_kiri_{{ $formIndex }}" value="{{ $detailAtasKiri->RHE ?? '' }}" style="border:none;background:transparent;width:100%;text-align:center;">
        </td>
        <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Kelembaban Udara (%rh)</td>
        <td style="border:0.75pt solid #000; text-align:center;">
            <input type="text" name="kelembaban_awal_kanan_{{ $formIndex }}" value="{{ $detailAtasKanan->RHS ?? '' }}" style="border:none;background:transparent;width:100%;text-align:center;">
        </td>
        <td style="border:0.75pt solid #000; text-align:center;">
            <input type="text" name="kelembaban_akhir_kanan_{{ $formIndex }}" value="{{ $detailAtasKanan->RHE ?? '' }}" style="border:none;background:transparent;width:100%;text-align:center;">
        </td>
    </tr>

    <!-- Tekanan Udara Atas -->
    <tr style="height:25pt;">
        <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Tekanan Udara (hPa)</td>
        <td style="border:0.75pt solid #000; text-align:center;">
            <input type="text" name="tekanan_awal_kiri_{{ $formIndex }}" value="{{ $detailAtasKiri->PUdaraS ?? '' }}" style="border:none;background:transparent;width:100%;text-align:center;">
        </td>
        <td style="border:0.75pt solid #000; text-align:center;">
            <input type="text" name="tekanan_akhir_kiri_{{ $formIndex }}" value="{{ $detailAtasKiri->PUdaraE ?? '' }}" style="border:none;background:transparent;width:100%;text-align:center;">
        </td>
        <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Tekanan Udara (hPa)</td>
        <td style="border:0.75pt solid #000; text-align:center;">
            <input type="text" name="tekanan_awal_kanan_{{ $formIndex }}" value="{{ $detailAtasKanan->PUdaraS ?? '' }}" style="border:none;background:transparent;width:100%;text-align:center;">
        </td>
        <td style="border:0.75pt solid #000; text-align:center;">
            <input type="text" name="tekanan_akhir_kanan_{{ $formIndex }}" value="{{ $detailAtasKanan->PUdaraE ?? '' }}" style="border:none;background:transparent;width:100%;text-align:center;">
        </td>
    </tr>

    <!-- Suhu Air Atas -->
    <tr style="height:25pt;">
        <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Suhu Air (°C)</td>
        <td style="border:0.75pt solid #000; text-align:center;">
            <input type="text" name="suhu_air_awal_kiri_{{ $formIndex }}" value="{{ $detailAtasKiri->TAirS ?? '' }}" style="border:none;background:transparent;width:100%;text-align:center;">
        </td>
        <td style="border:0.75pt solid #000; text-align:center;">
            <input type="text" name="suhu_air_akhir_kiri_{{ $formIndex }}" value="{{ $detailAtasKiri->TAirE ?? '' }}" style="border:none;background:transparent;width:100%;text-align:center;">
        </td>
        <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Suhu Air (°C)</td>
        <td style="border:0.75pt solid #000; text-align:center;">
            <input type="text" name="suhu_air_awal_kanan_{{ $formIndex }}" value="{{ $detailAtasKanan->TAirS ?? '' }}" style="border:none;background:transparent;width:100%;text-align:center;">
        </td>
        <td style="border:0.75pt solid #000; text-align:center;">
            <input type="text" name="suhu_air_akhir_kanan_{{ $formIndex }}" value="{{ $detailAtasKanan->TAirE ?? '' }}" style="border:none;background:transparent;width:100%;text-align:center;">
        </td>
    </tr>

    <!-- Waktu Atas -->
    <tr style="height:25pt;">
        <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Waktu (detik)</td>
        <td colspan="2" style="border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:11pt;">
            <input type="text" name="waktu_kiri_{{ $formIndex }}" value="{{ $detailAtasKiri->waktu ?? '' }}" style="border:none;background:transparent;width:100%;text-align:center;font-size:11pt;">
        </td>
        <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Waktu (detik)</td>
        <td colspan="2" style="border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:11pt;">
            <input type="text" name="waktu_kanan_{{ $formIndex }}" value="{{ $detailAtasKanan->waktu ?? '' }}" style="border:none;background:transparent;width:100%;text-align:center;font-size:11pt;">
        </td>
    </tr>

    <!-- SPACER -->
    <tr><td colspan="9" style="height:20pt;">&nbsp;</tr>

    <!-- BAGIAN BAWAH -->
    <tr style="height:55pt;">
        <td rowspan="2" style="width:130pt; border:2.25pt double #000; border-top:2.25pt double #000; background:#d9d9d9; text-align:center; vertical-align:middle; padding:8pt;">
            <span style="font-size:10pt; font-weight:bold;">Nominal Alat Ukur</span><br>
            <span style="font-family:'Lucida Console'; letter-spacing:0.5em">
                (
                <input type="text" 
                       name="satuan_alat_ukur_bawah_kiri_{{ $formIndex }}"
                       value="{{ $head->satuan_alat_ukur_bawah_kiri ?? '' }}"
                       style="width:60px; border:none; outline:none; background:transparent; text-align:center; font-family:'Lucida Console'; font-size:12pt;"
                       placeholder="-">
                )
            </span>
        </td>
        <td colspan="3" style="border:2.25pt double #000; border-top:2.25pt double #000; background:#d9d9d9; text-align:center; padding:8pt;">
            <span style="font-size:10pt; font-weight:bold;">Pembacaan Timbangan (g)</span>
        </td>
        <td rowspan="2" style="width:130pt; border:2.25pt double #000; border-top:2.25pt double #000; background:#d9d9d9; text-align:center; vertical-align:middle; padding:8pt;">
            <span style="font-size:10pt; font-weight:bold;">Nominal Alat Ukur</span><br>
            <span style="font-family:'Lucida Console'; letter-spacing:0.5em">
                (
                <input type="text" 
                       name="satuan_alat_ukur_bawah_kanan_{{ $formIndex }}"
                       value="{{ $head->satuan_alat_ukur_bawah_kanan ?? '' }}"
                       style="width:60px; border:none; outline:none; background:transparent; text-align:center; font-family:'Lucida Console'; font-size:12pt;"
                       placeholder="-">
                )
            </span>
        </td>
        <td colspan="3" style="border:2.25pt double #000; border-top:2.25pt double #000; background:#d9d9d9; text-align:center; padding:8pt;">
            <span style="font-size:10pt; font-weight:bold;">Pembacaan Timbangan (g)</span>
        </td>
    </tr>

    <tr style="height:30pt;">
        <td style="width:70pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center;"><b>m</b></td>
        <td colspan="2" style="width:160pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center;"><b>Nilai</b></td>
        <td style="width:70pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center;"><b>m</b></td>
        <td colspan="2" style="width:160pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center;"><b>Nilai</b></td>
    </tr>

    @for($i = 0; $i <= 11; $i++)
    <tr style="height:25pt;">
        @if($i == 0)
            <td rowspan="12" style="border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:14pt; font-weight:bold;">
                <input type="text"
                       name="nominal_kiri_bawah_{{ $formIndex }}"
                       value="{{ $detailBawahKiri->titikUkur ?? '' }}"
                       style="width:100%; border:none; text-align:center; font-size:14pt; font-weight:bold; background:transparent;">
            </td>
        @endif
        <td style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">
            m<sub>{{ $i }}</sub>
        </td>
        <td colspan="2" style="border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:11pt;">
            <input type="text"
                   name="m{{ $i }}_kiri_bawah_{{ $formIndex }}"
                   value="{{ $detailBawahKiri->{'m'.$i} ?? '' }}"
                   style="width:100%; border:none; text-align:center; font-size:11pt; background:transparent;">
        </td>
        @if($i == 0)
            <td rowspan="12" style="border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:14pt; font-weight:bold;">
                <input type="text"
                       name="nominal_kanan_bawah_{{ $formIndex }}"
                       value="{{ $detailBawahKanan->titikUkur ?? '' }}"
                       style="width:100%; border:none; text-align:center; font-size:14pt; font-weight:bold; background:transparent;">
            </td>
        @endif
        <td style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">
            m<sub>{{ $i }}</sub>
        </td>
        <td colspan="2" style="border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:11pt;">
            <input type="text"
                   name="m{{ $i }}_kanan_bawah_{{ $formIndex }}"
                   value="{{ $detailBawahKanan->{'m'.$i} ?? '' }}"
                   style="width:100%; border:none; text-align:center; font-size:11pt; background:transparent;">
        </td>
    </tr>
    @endfor

    <!-- Parameter Pendukung Bawah -->
    <tr style="height:30pt;">
        <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;"><b>Parameter Pendukung</b></td>
        <td style="width:80pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center;"><b>Awal</b></td>
        <td style="width:80pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center;"><b>Akhir</b></td>
        <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;"><b>Parameter Pendukung</b></td>
        <td style="width:80pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center;"><b>Awal</b></td>
        <td style="width:80pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center;"><b>Akhir</b></td>
    </tr>

    <!-- Suhu Udara Bawah -->
    <tr style="height:25pt;">
        <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Suhu Udara (°C)</td>
        <td style="border:0.75pt solid #000; text-align:center;">
            <input type="text" name="suhu_awal_kiri_bawah_{{ $formIndex }}" value="{{ $detailBawahKiri->TUdaraS ?? '' }}" style="width:100%; border:none; text-align:center; background:transparent;">
        </td>
        <td style="border:0.75pt solid #000; text-align:center;">
            <input type="text" name="suhu_akhir_kiri_bawah_{{ $formIndex }}" value="{{ $detailBawahKiri->TUdaraE ?? '' }}" style="width:100%; border:none; text-align:center; background:transparent;">
        </td>
        <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Suhu Udara (°C)</td>
        <td style="border:0.75pt solid #000; text-align:center;">
            <input type="text" name="suhu_awal_kanan_bawah_{{ $formIndex }}" value="{{ $detailBawahKanan->TUdaraS ?? '' }}" style="width:100%; border:none; text-align:center; background:transparent;">
        </td>
        <td style="border:0.75pt solid #000; text-align:center;">
            <input type="text" name="suhu_akhir_kanan_bawah_{{ $formIndex }}" value="{{ $detailBawahKanan->TUdaraE ?? '' }}" style="width:100%; border:none; text-align:center; background:transparent;">
        </td>
    </tr>

    <!-- Kelembaban Udara Bawah -->
    <tr style="height:25pt;">
        <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Kelembaban Udara (%rh)</td>
        <td style="border:0.75pt solid #000; text-align:center;">
            <input type="text" name="kelembaban_awal_kiri_bawah_{{ $formIndex }}" value="{{ $detailBawahKiri->RHS ?? '' }}" style="width:100%; border:none; text-align:center; background:transparent;">
        </td>
        <td style="border:0.75pt solid #000; text-align:center;">
            <input type="text" name="kelembaban_akhir_kiri_bawah_{{ $formIndex }}" value="{{ $detailBawahKiri->RHE ?? '' }}" style="width:100%; border:none; text-align:center; background:transparent;">
        </td>
        <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Kelembaban Udara (%rh)</td>
        <td style="border:0.75pt solid #000; text-align:center;">
            <input type="text" name="kelembaban_awal_kanan_bawah_{{ $formIndex }}" value="{{ $detailBawahKanan->RHS ?? '' }}" style="width:100%; border:none; text-align:center; background:transparent;">
        </td>
        <td style="border:0.75pt solid #000; text-align:center;">
            <input type="text" name="kelembaban_akhir_kanan_bawah_{{ $formIndex }}" value="{{ $detailBawahKanan->RHE ?? '' }}" style="width:100%; border:none; text-align:center; background:transparent;">
        </td>
    </tr>

    <!-- Tekanan Udara Bawah -->
    <tr style="height:25pt;">
        <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Tekanan Udara (hPa)</td>
        <td style="border:0.75pt solid #000; text-align:center;">
            <input type="text" name="tekanan_awal_kiri_bawah_{{ $formIndex }}" value="{{ $detailBawahKiri->PUdaraS ?? '' }}" style="width:100%; border:none; text-align:center; background:transparent;">
        </td>
        <td style="border:0.75pt solid #000; text-align:center;">
            <input type="text" name="tekanan_akhir_kiri_bawah_{{ $formIndex }}" value="{{ $detailBawahKiri->PUdaraE ?? '' }}" style="width:100%; border:none; text-align:center; background:transparent;">
        </td>
        <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Tekanan Udara (hPa)</td>
        <td style="border:0.75pt solid #000; text-align:center;">
            <input type="text" name="tekanan_awal_kanan_bawah_{{ $formIndex }}" value="{{ $detailBawahKanan->PUdaraS ?? '' }}" style="width:100%; border:none; text-align:center; background:transparent;">
        </td>
        <td style="border:0.75pt solid #000; text-align:center;">
            <input type="text" name="tekanan_akhir_kanan_bawah_{{ $formIndex }}" value="{{ $detailBawahKanan->PUdaraE ?? '' }}" style="width:100%; border:none; text-align:center; background:transparent;">
        </td>
    </tr>

    <!-- Suhu Air Bawah -->
    <tr style="height:25pt;">
        <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Suhu Air (°C)</td>
        <td style="border:0.75pt solid #000; text-align:center;">
            <input type="text" name="suhu_air_awal_kiri_bawah_{{ $formIndex }}" value="{{ $detailBawahKiri->TAirS ?? '' }}" style="width:100%; border:none; text-align:center; background:transparent;">
        </td>
        <td style="border:0.75pt solid #000; text-align:center;">
            <input type="text" name="suhu_air_akhir_kiri_bawah_{{ $formIndex }}" value="{{ $detailBawahKiri->TAirE ?? '' }}" style="width:100%; border:none; text-align:center; background:transparent;">
        </td>
        <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Suhu Air (°C)</td>
        <td style="border:0.75pt solid #000; text-align:center;">
            <input type="text" name="suhu_air_awal_kanan_bawah_{{ $formIndex }}" value="{{ $detailBawahKanan->TAirS ?? '' }}" style="width:100%; border:none; text-align:center; background:transparent;">
        </td>
        <td style="border:0.75pt solid #000; text-align:center;">
            <input type="text" name="suhu_air_akhir_kanan_bawah_{{ $formIndex }}" value="{{ $detailBawahKanan->TAirE ?? '' }}" style="width:100%; border:none; text-align:center; background:transparent;">
        </td>
    </tr>

    <!-- Waktu Bawah -->
    <tr style="height:25pt;">
        <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Waktu (detik)</td>
        <td colspan="2" style="border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:11pt;">
            <input type="text" name="waktu_kiri_bawah_{{ $formIndex }}" value="{{ $detailBawahKiri->waktu ?? '' }}" style="width:100%; border:none; text-align:center; font-size:11pt; background:transparent;">
        </td>
        <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Waktu (detik)</td>
        <td colspan="2" style="border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:11pt;">
            <input type="text" name="waktu_kanan_bawah_{{ $formIndex }}" value="{{ $detailBawahKanan->waktu ?? '' }}" style="width:100%; border:none; text-align:center; font-size:11pt; background:transparent;">
        </td>
    </tr>

<!-- ==================== BAGIAN TAMBAHAN KIRI ==================== -->
<tr>
    <td colspan="11" style="padding:10px;">&nbsp;</td>
</tr>

<tr style="height:40pt;">
    <td rowspan="2" style="width:130pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle; padding:8pt;">
        <span style="font-size:10pt; font-weight:bold;">Nominal Alat Ukur</span><br>
        <span style="font-family:'Lucida Console'; letter-spacing:0.5em">
            (
            <input type="text" 
                   name="satuan_alat_ukur_tambahan_kiri_{{ $formIndex }}"
                   value="{{ $head->satuan_alat_ukur_tambahan_kiri ?? '' }}"
                   style="width:60px; border:none; outline:none; background:transparent; text-align:center; font-family:'Lucida Console'; font-size:12pt;"
                   placeholder="-">
            )
        </span>
    </td>
    <td colspan="3" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; padding:8pt;">
        <span style="font-size:10pt; font-weight:bold;">Pembacaan Timbangan (g)</span>
    </td>
    <td rowspan="19" style="width:40pt; border-left:0.75pt solid #000; border-right:0.75pt solid #000;">&nbsp;</td>
    <td colspan="4" rowspan="19" style="border:none;">&nbsp;</td>
</tr>
<tr style="height:30pt;">
    <td style="width:70pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;"><b>m</b></td>
    <td colspan="2" style="width:160pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;"><b>Nilai</b></td>
</tr>

@for($i = 0; $i <= 11; $i++)
<tr style="height:25pt;">
    @if($i == 0)
        <td rowspan="12" style="border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:14pt; font-weight:bold;">
            <input type="text"
                   name="nominal_tambahan_kiri_{{ $formIndex }}"
                   value="{{ $detailTambahanKiri->titikUkur ?? '' }}"
                   style="border:none; outline:none; background:transparent; width:100%; text-align:center; font-size:inherit; color:inherit;">
        </td>
    @endif
    <td style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">
        m<sub>{{ $i }}</sub>
    </td>
    <td colspan="2" style="border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:11pt;">
        <input type="text"
               name="m{{ $i }}_tambahan_kiri_{{ $formIndex }}"
               value="{{ $detailTambahanKiri->{'m'.$i} ?? '' }}"
               style="width:100%; border:none; text-align:center; font-size:11pt; background:transparent;">
    </td>
</tr>
@endfor

<!-- Header Parameter Pendukung Tambahan -->
<tr style="height:25pt;">
    <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;"><b>Parameter Pendukung</b></td>
    <td style="width:80pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;"><b>Awal</b></td>
    <td style="width:80pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;"><b>Akhir</b></td>
</tr>

<!-- Suhu Udara Tambahan -->
<tr style="height:25pt;">
    <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Suhu Udara (&deg;C)</td>
    <td style="border:0.75pt solid #000; text-align:center;">
        <input type="text" name="suhu_awal_tambahan_kiri_{{ $formIndex }}" value="{{ $detailTambahanKiri->TUdaraS ?? '' }}" style="width:100%; border:none; text-align:center; background:transparent;">
    </td>
    <td style="border:0.75pt solid #000; text-align:center;">
        <input type="text" name="suhu_akhir_tambahan_kiri_{{ $formIndex }}" value="{{ $detailTambahanKiri->TUdaraE ?? '' }}" style="width:100%; border:none; text-align:center; background:transparent;">
    </td>
</tr>

<!-- Kelembaban Udara Tambahan -->
<tr style="height:25pt;">
    <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Kelembaban Udara (%rh)</td>
    <td style="border:0.75pt solid #000; text-align:center;">
        <input type="text" name="kelembaban_awal_tambahan_kiri_{{ $formIndex }}" value="{{ $detailTambahanKiri->RHS ?? '' }}" style="width:100%; border:none; text-align:center; background:transparent;">
    </td>
    <td style="border:0.75pt solid #000; text-align:center;">
        <input type="text" name="kelembaban_akhir_tambahan_kiri_{{ $formIndex }}" value="{{ $detailTambahanKiri->RHE ?? '' }}" style="width:100%; border:none; text-align:center; background:transparent;">
    </td>
</tr>

<!-- Tekanan Udara Tambahan -->
<tr style="height:25pt;">
    <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Tekanan Udara (hPa)</td>
    <td style="border:0.75pt solid #000; text-align:center;">
        <input type="text" name="tekanan_awal_tambahan_kiri_{{ $formIndex }}" value="{{ $detailTambahanKiri->PUdaraS ?? '' }}" style="width:100%; border:none; text-align:center; background:transparent;">
    </td>
    <td style="border:0.75pt solid #000; text-align:center;">
        <input type="text" name="tekanan_akhir_tambahan_kiri_{{ $formIndex }}" value="{{ $detailTambahanKiri->PUdaraE ?? '' }}" style="width:100%; border:none; text-align:center; background:transparent;">
    </td>
</tr>

<!-- Suhu Air Tambahan -->
<tr style="height:25pt;">
    <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Suhu Air (&deg;C)</td>
    <td style="border:0.75pt solid #000; text-align:center;">
        <input type="text" name="suhu_air_awal_tambahan_kiri_{{ $formIndex }}" value="{{ $detailTambahanKiri->TAirS ?? '' }}" style="width:100%; border:none; text-align:center; background:transparent;">
    </td>
    <td style="border:0.75pt solid #000; text-align:center;">
        <input type="text" name="suhu_air_akhir_tambahan_kiri_{{ $formIndex }}" value="{{ $detailTambahanKiri->TAirE ?? '' }}" style="width:100%; border:none; text-align:center; background:transparent;">
    </td>
</tr>

<!-- Waktu Tambahan -->
<tr style="height:25pt;">
    <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Waktu (detik)</td>
    <td colspan="2" style="border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:11pt;">
        <input type="text" name="waktu_tambahan_kiri_{{ $formIndex }}" value="{{ $detailTambahanKiri->waktu ?? '' }}" style="width:100%; border:none; text-align:center; font-size:11pt; background:transparent;">
    </td>
</tr>

</table>

                    <p style="margin-top:3.1pt; margin-left:4.45pt; margin-bottom:1.3pt">
                        <span>Catatan : Pengukuran m<sub>11</sub> dan penghitungan waktu hanya untuk volume 50μl ke bawah</span>
                    </p>

                    <div class="data-complete-section">
                        <span class="data-complete-text">Data telah diisi dengan lengkap dan jelas!</span>
                    </div>
                    
                    <!-- ALAT STANDAR Section -->
                    <table cellspacing="0" cellpadding="5" class="alat-standar-table">
                        <tr>
                            <td colspan="9" style="border:1px solid #000; text-align:center; font-weight:bold; font-size:11pt;">
                                Isilah lembar data kalibrasi dengan lengkap dan jelas!
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="4" style="border:1px solid #000; text-align:center; font-weight:bold; width:90px;">
                                Alat Standar
                            </td>
                            <td style="border:1px solid #000; width:200px;">Semi Microbalance, AND</td>
                            <td style="border:1px solid #000;" align="center">
                                @if($isFirstForm)
                                    <input type="checkbox" name="alat_standar[]" value="Semi Microbalance AND 0.1g" class="alat-standar-checkbox" @if($isSelected('Semi Microbalance AND 0.1g')) checked @endif>
                                @else
                                    <input type="checkbox" class="alat-standar-checkbox" disabled @if($isSelected('Semi Microbalance AND 0.1g')) checked @endif>
                                @endif
                                <span>0.1 g</span>
                            </td>
                            <td style="border:1px solid #000;" align="center">
                                @if($isFirstForm)
                                    <input type="checkbox" name="alat_standar[]" value="Semi Microbalance AND 1g" class="alat-standar-checkbox" @if($isSelected('Semi Microbalance AND 1g')) checked @endif>
                                @else
                                    <input type="checkbox" class="alat-standar-checkbox" disabled @if($isSelected('Semi Microbalance AND 1g')) checked @endif>
                                @endif
                                <span>1 g</span>
                            </td>
                            <td style="border:1px solid #000;" align="center">
                                @if($isFirstForm)
                                    <input type="checkbox" name="alat_standar[]" value="Semi Microbalance AND 10g" class="alat-standar-checkbox" @if($isSelected('Semi Microbalance AND 10g')) checked @endif>
                                @else
                                    <input type="checkbox" class="alat-standar-checkbox" disabled @if($isSelected('Semi Microbalance AND 10g')) checked @endif>
                                @endif
                                <span>10 g</span>
                            </td>
                            <td style="border:1px solid #000;" align="center">
                                @if($isFirstForm)
                                    <input type="checkbox" name="alat_standar[]" value="Semi Microbalance AND 100g" class="alat-standar-checkbox" @if($isSelected('Semi Microbalance AND 100g')) checked @endif>
                                @else
                                    <input type="checkbox" class="alat-standar-checkbox" disabled @if($isSelected('Semi Microbalance AND 100g')) checked @endif>
                                @endif
                                <span>100 g</span>
                            </td>
                            <td style="border:1px solid #000;" align="center">
                                @if($isFirstForm)
                                    <input type="checkbox" name="alat_standar[]" value="Semi Microbalance AND 200g" class="alat-standar-checkbox" @if($isSelected('Semi Microbalance AND 200g')) checked @endif>
                                @else
                                    <input type="checkbox" class="alat-standar-checkbox" disabled @if($isSelected('Semi Microbalance AND 200g')) checked @endif>
                                @endif
                                <span>200 g</span>
                            </td>
                            <td style="border:none; text-align:center; font-weight:bold;">Dikalibrasi oleh</td>
                            <td style="border:none; text-align:center; font-weight:bold;">Diperiksa oleh</td>
                        </tr>
                        <tr>
                            <td style="border:1px solid #000;">Semi Microbalance, Radwag</td>
                            <td style="border:1px solid #000;" align="center">
                                @if($isFirstForm)
                                    <input type="checkbox" name="alat_standar[]" value="Semi Microbalance Radwag 0.1g" class="alat-standar-checkbox" @if($isSelected('Semi Microbalance Radwag 0.1g')) checked @endif>
                                @else
                                    <input type="checkbox" class="alat-standar-checkbox" disabled @if($isSelected('Semi Microbalance Radwag 0.1g')) checked @endif>
                                @endif
                                <span>0.1 g</span>
                            </td>
                            <td style="border:1px solid #000;" align="center">
                                @if($isFirstForm)
                                    <input type="checkbox" name="alat_standar[]" value="Semi Microbalance Radwag 1g" class="alat-standar-checkbox" @if($isSelected('Semi Microbalance Radwag 1g')) checked @endif>
                                @else
                                    <input type="checkbox" class="alat-standar-checkbox" disabled @if($isSelected('Semi Microbalance Radwag 1g')) checked @endif>
                                @endif
                                <span>1 g</span>
                            </td>
                            <td style="border:1px solid #000;" align="center">
                                @if($isFirstForm)
                                    <input type="checkbox" name="alat_standar[]" value="Semi Microbalance Radwag 10g" class="alat-standar-checkbox" @if($isSelected('Semi Microbalance Radwag 10g')) checked @endif>
                                @else
                                    <input type="checkbox" class="alat-standar-checkbox" disabled @if($isSelected('Semi Microbalance Radwag 10g')) checked @endif>
                                @endif
                                <span>10 g</span>
                            </td>
                            <td style="border:1px solid #000;" align="center">
                                @if($isFirstForm)
                                    <input type="checkbox" name="alat_standar[]" value="Semi Microbalance Radwag 100g" class="alat-standar-checkbox" @if($isSelected('Semi Microbalance Radwag 100g')) checked @endif>
                                @else
                                    <input type="checkbox" class="alat-standar-checkbox" disabled @if($isSelected('Semi Microbalance Radwag 100g')) checked @endif>
                                @endif
                                <span>100 g</span>
                            </td>
                            <td style="border:1px solid #000;" align="center">
                                @if($isFirstForm)
                                    <input type="checkbox" name="alat_standar[]" value="Semi Microbalance Radwag 200g" class="alat-standar-checkbox" @if($isSelected('Semi Microbalance Radwag 200g')) checked @endif>
                                @else
                                    <input type="checkbox" class="alat-standar-checkbox" disabled @if($isSelected('Semi Microbalance Radwag 200g')) checked @endif>
                                @endif
                                <span>200 g</span>
                            </td>
                            <td style="border:none;">&nbsp;</td>
                            <td style="border:none;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="border:1px solid #000;">Timbangan Digital, AND</td>
                            <td colspan="2" style="border:1px solid #000;" align="center">
                                @if($isFirstForm)
                                    <input type="checkbox" name="alat_standar[]" value="Timbangan Digital AND 3kg" class="alat-standar-checkbox" @if($isSelected('Timbangan Digital AND 3kg')) checked @endif>
                                @else
                                    <input type="checkbox" class="alat-standar-checkbox" disabled @if($isSelected('Timbangan Digital AND 3kg')) checked @endif>
                                @endif
                                <span>3 kg</span>
                            </td>
                            <td colspan="3" style="border:1px solid #000;" align="center">
                                Stopwatch<br>
                                @if($isFirstForm)
                                    <input type="checkbox" name="alat_standar[]" value="Stopwatch WF002" class="alat-standar-checkbox" @if($isSelected('Stopwatch WF002')) checked @endif>
                                @else
                                    <input type="checkbox" class="alat-standar-checkbox" disabled @if($isSelected('Stopwatch WF002')) checked @endif>
                                @endif
                                <span>WF002</span>
                                &nbsp;&nbsp;&nbsp;
                                @if($isFirstForm)
                                    <input type="checkbox" name="alat_standar[]" value="Stopwatch WT003" class="alat-standar-checkbox" @if($isSelected('Stopwatch WT003')) checked @endif>
                                @else
                                    <input type="checkbox" class="alat-standar-checkbox" disabled @if($isSelected('Stopwatch WT003')) checked @endif>
                                @endif
                                <span>WT003</span>
                            </td>
                            <td style="border:none;">&nbsp;</td>
                            <td style="border:none;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="border:1px solid #000;">Termometer</td>
                            <td colspan="2" style="border:1px solid #000;" align="center">
                                @if($isFirstForm)
                                    <input type="checkbox" name="alat_standar[]" value="Termometer TES" class="alat-standar-checkbox" @if($isSelected('Termometer TES')) checked @endif>
                                @else
                                    <input type="checkbox" class="alat-standar-checkbox" disabled @if($isSelected('Termometer TES')) checked @endif>
                                @endif
                                <span>TES</span>
                            </td>
                            <td style="border:1px solid #000;">&nbsp;</td>
                            <td colspan="2" style="border:1px solid #000;" align="center">
                                @if($isFirstForm)
                                    <input type="checkbox" name="alat_standar[]" value="Termometer TFA" class="alat-standar-checkbox" @if($isSelected('Termometer TFA')) checked @endif>
                                @else
                                    <input type="checkbox" class="alat-standar-checkbox" disabled @if($isSelected('Termometer TFA')) checked @endif>
                                @endif
                                <span>TFA</span>
                            </td>
                            <td style="border:none;">&nbsp;</td>
                                                      <td style="border:none;">&nbsp;</td>
                            <td style="border:none;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="border:1px solid #000; font-weight:bold; text-align:center;">
                                Metode Kalibrasi
                            </td>
                            <td colspan="6" style="border:1px solid #000; padding-left:10px;">
                                PAS-IK102-39 (Volumetrik Piston)
                            </td>
                            <td style="border:1px solid #000; text-align:center;">
                                TTD :<br><br>
                                Nama :<br>
                                @if($isFirstForm)
                                    <input type="text" name="calibratedBy" value="{{ $calibration->calibratedBy ?? '' }}" 
                                           style="border:none; background:transparent; font-weight:bold; font-size:10pt; text-align:center; width:100%;">
                                @else
                                    <span style="font-weight:bold; font-size:10pt;">{{ $calibration->calibratedBy ?? '' }}</span>
                                @endif
                            </td>
                            <td style="border:1px solid #000; text-align:center;">
                                TTD :<br><br>
                                Nama :<br>
                                @if($isFirstForm)
                                    <input type="text" name="verifiedBy" value="{{ $calibration->verifiedBy ?? '' }}" 
                                           style="border:none; background:transparent; font-weight:bold; font-size:10pt; text-align:center; width:100%;" readonly>
                                @else
                                    <span style="font-weight:bold; font-size:10pt;">{{ $calibration->verifiedBy ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                    </table>

                    @if($isFirstForm && empty($alatStandarData))
                        <small class="text-muted">Belum ada alat standar yang dipilih</small>
                    @endif
                </div>
                
                @if($jumlahForm > 1)
                    </div>
                </div>
                @endif
            @endfor

            <!-- Action Buttons -->
            <div class="row mt-5">
                <div class="col-12 text-center">
                    <a href="{{ route('calibrations.index') }}" class="btn btn-secondary btn-lg" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
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
var tempFormDataStore = window.tempFormDataStore;
var isRestoring = window.isRestoring;
var tabSubmitStatus = window.tabSubmitStatus;
var currentActiveTabId = '1';

        document.getElementById('editForm')?.addEventListener('submit', function(e) {
            console.log('🎯 Edit form submission started...');
            
            // Debug form data
            const formData = new FormData(this);
            console.log('📦 Form data collected for update');
            console.log('📊 Jumlah form:', document.querySelector('input[name="jumlah_form"]')?.value);
            
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
            
            // Basic validation
            let isValid = true;
            let warningMessages = [];
            
            // 1. Validasi tanggal
            const tanggalMasuk = document.querySelector('input[name="tanggalMasuk"]').value;
            const tanggalKalibrasi = document.querySelector('input[name="tanggalKalibrasi"]').value;
            
            if (tanggalMasuk && tanggalKalibrasi) {
                if (new Date(tanggalMasuk) > new Date(tanggalKalibrasi)) {
                    warningMessages.push('Tanggal alat masuk tidak boleh lebih baru dari tanggal kalibrasi');
                    console.warn('⚠️ Date validation warning: masuk > kalibrasi');
                }
            }
            
            // 2. Validasi numeric fields
            document.querySelectorAll('input[type="number"]').forEach(input => {
                if (input.value && isNaN(parseFloat(input.value))) {
                    input.style.borderColor = '#ffc107';
                    warningMessages.push(`${input.name || 'Field'} harus berupa angka`);
                } else {
                    input.style.borderColor = '';
                }
            });
            
            // 3. Validasi alat standar (hanya untuk form pertama)
            if (alatStandarCheckboxes.length === 0 && document.querySelector('input[name="alat_standar[]"]') !== null) {
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
            
            // 4. Validasi kondisi alat
            if (!kondisiAlatSelected) {
                warningMessages.push('Pilih kondisi alat (Ok/Rusak)');
                console.warn('⚠️ No kondisi alat selected');
            }
            
            // 5. Validasi tempat kalibrasi
            if (!tempatKalibrasiSelected) {
                warningMessages.push('Pilih tempat kalibrasi');
                console.warn('⚠️ No tempat kalibrasi selected');
            }
            
            // Tampilkan warning jika ada
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
            
            // Log data yang akan dikirim
            console.log('📤 Data to be submitted:');
            for (let [key, value] of formData.entries()) {
                if (!key.includes('token')) {
                    console.log(`${key}:`, value);
                }
            }
            
            return true;
        });
        
        // Page load debug
        document.addEventListener('DOMContentLoaded', function() {
            console.log('📄 Edit form loaded for Mikropipet/Dispenset ID:', {{ $calibration->id ?? 'null' }});
            console.log('🔢 Jumlah form:', {{ $jumlahForm }});
            console.log('📋 Detail records count:', {{ $allDetails->count() }});
            
            // Log detail per form
            @for($i = 1; $i <= $jumlahForm; $i++)
                console.log('Form {{ $i }} details count:', {{ count($detailsByForm[$i] ?? []) }});
            @endfor
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