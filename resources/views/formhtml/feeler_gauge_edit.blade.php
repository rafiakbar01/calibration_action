<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kalibrasi Feeler Gauge - PT. PANANJUNG ANUGRAH SOLUTION</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    .kalibrasi-data-table input:read-only {
        background-color: #e9ecef;
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
    }

    .alat-standar-table td {
        border: 1px solid #000;
        padding: 8px;
        vertical-align: middle;
    }

    .form-card {
        border: 2px solid #3b82f6;
        border-radius: 8px;
        margin-bottom: 30px;
        break-inside: avoid;
        page-break-inside: avoid;
        transition: all 0.3s ease;
    }

    .form-card-header {
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        color: white;
        padding: 12px 20px;
        border-radius: 6px 6px 0 0;
        font-weight: bold;
        font-size: 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .form-card-body {
        padding: 20px;
        background: white;
    }

    /* Tombol tambah/kurang form */
    .form-counter-wrapper {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .form-counter-wrapper .btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        font-weight: bold;
        padding: 0;
    }
    
    .form-counter-wrapper .form-control {
        width: 80px;
        text-align: center;
        font-size: 18px;
        font-weight: bold;
    }

    .btn-remove-form {
        color: white;
        border: 1px solid rgba(255,255,255,0.3);
        border-radius: 50%;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255,0,0,0.2);
        transition: all 0.3s ease;
        border: none;
    }

    .btn-remove-form:hover {
        background: rgba(255,0,0,0.5);
        color: white;
        transform: scale(1.1);
    }

    .form-card-enter {
        animation: slideDown 0.3s ease-out;
    }
    
    .form-card-exit {
        animation: slideUp 0.3s ease-in;
    }
    
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes slideUp {
        from {
            opacity: 1;
            transform: translateY(0);
        }
        to {
            opacity: 0;
            transform: translateY(-20px);
        }
    }

    .form-count-badge {
        background: rgba(255,255,255,0.2);
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 14px;
        margin-left: 10px;
    }

    @media print {
        .btn { display: none !important; }
        .form-counter-wrapper { display: none !important; }
        .btn-remove-form { display: none !important; }
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
                $heads = $calibration->headFeelerGauge ?? collect();
                $allDetails = $calibration->detailFeelerGauges ?? collect();
                $form1Head = $calibration->headFeelerGaugeForm1;
                 
                // Kelompokkan details berdasarkan form_index
                $detailsByForm = [];
                foreach ($allDetails as $detail) {
                    $formIdx = $detail->form_index ?? 1;
                    if (!isset($detailsByForm[$formIdx])) {
                        $detailsByForm[$formIdx] = [];
                    }
                    $detailsByForm[$formIdx][] = $detail;
                }

                // Data alat standar dari form 1
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
            
           <!-- Pilihan Jumlah Form Feeler Gauge - UNLIMITED -->
            <div class="card mb-4 border-primary shadow-sm">
                <div class="card-body bg-light">
                    <div class="row align-items-center g-3">
                        <!-- Label dan Badge -->
                        <div class="col-md-6">
                            <label for="jumlah_form_input" class="form-label fw-bold mb-0 text-black">
                                <i class="fas fa-copy text-primary me-2"></i>Jumlah Form Feeler Gauge
                            </label>
                            <span class="badge bg-primary ms-2" id="formCountBadge">{{ $jumlahForm }} Form</span>
                        </div>
            
                        <!-- Kontrol Jumlah Form -->
                        <div class="col-md-6">
                            <div class="d-flex align-items-center gap-2 flex-wrap">
                                <!-- Tombol Kurang -->
                                <button type="button" class="btn btn-outline-danger" id="btnKurangForm" {{ $jumlahForm <= 1 ? 'disabled' : '' }}>
                                    <i class="fas fa-minus"></i>
                                </button>
            
                                <!-- Input Jumlah (Readonly) -->
                                <input type="number" id="jumlah_form_input" name="jumlah_form" class="form-control text-center" 
                                       value="{{ $jumlahForm }}" min="1" readonly style="max-width: 80px;">
            
                                <!-- Tombol Tambah -->
                                <button type="button" class="btn btn-outline-success" id="btnTambahForm">
                                    <i class="fas fa-plus"></i>
                                </button>
            
                                <!-- Tombol Ubah -->
                                <button type="button" class="btn btn-primary" id="btnChangeJumlahForm">
                                    <i class="fas fa-sync-alt me-1"></i> Ubah
                                </button>
                            </div>
            
                            <!-- Informasi Tambahan -->
                            <small class="text-muted d-block mt-1" style="font-size: 11px;">
                                <i class="fas fa-info-circle me-1"></i> Jumlah form tidak terbatas. Klik + untuk menambah, - untuk mengurangi.
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Container untuk semua form -->
            <div id="formContainer">
                @for($formIndex = 1; $formIndex <= $jumlahForm; $formIndex++)
                    @php
                        $head = $calibration->{'headFeelerGaugeForm' . $formIndex};
                        $formDetails = $detailsByForm[$formIndex] ?? [];
                        $isFirstForm = ($formIndex == 1);
                    @endphp
                    
                    <div class="form-card form-card-item" data-form-index="{{ $formIndex }}" id="formCard_{{ $formIndex }}">
                        <div class="form-card-header">
                            <span>
                                <i class="fas fa-file-alt me-2"></i>Form Feeler Gauge ke-{{ $formIndex }}
                                @if(!$isFirstForm)
                                    <small class="ms-2">(Data alat mengikuti form 1)</small>
                                @endif
                            </span>
                            <div class="d-flex align-items-center gap-2">
                                <span class="form-count-badge">
                                    <i class="fas fa-table me-1"></i> Form {{ $formIndex }}
                                </span>
                                @if($formIndex > 1)
                                    <button type="button" class="btn-remove-form" onclick="removeForm({{ $formIndex }})" title="Hapus form ini">
                                        <i class="fas fa-times"></i>
                                    </button>
                                @endif
                            </div>
                        </div>
                        
                        
                        <div class="form-card-body">
                            <!-- ========================================== -->
                            <!-- KONTEN FORM FEELER GAUGE -->
                            <!-- ========================================== -->
                            <div class="form-kalibrasi-container">
                                <table class="kalibrasi-header-table">
                                    <tr>
                                        <td colspan="2">
                                            <p style="margin: 0; font-size: 14px;">PAS-FLK62</p>
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
                                            <p style="margin: 0; font-weight: bold; font-size: 14px;">FEELER GAUGE</p>
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
                                                @else
                                                    <input type="date" class="kalibrasi-input me-3" value="{{ $calibration->tanggalKalibrasi ? \Carbon\Carbon::parse($calibration->tanggalKalibrasi)->format('Y-m-d') : '' }}" readonly style="width:45%;">
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><p style="margin:0;">Tempat Kalibrasi</p></td>
                                        <td colspan="3">
                                            @if($isFirstForm)
                                    @php $tempat = strtolower(old('tempatKalibrasi', $calibration->tempatKalibrasi ?? '')); @endphp
                                    <div class="d-flex">
                                        <div class="form-check me-5">
                                            <input class="form-check-input" type="radio" name="tempatKalibrasi" value="lab.PT PAS" id="lab_{{ $formIndex }}" {{ $tempat == 'lab.pt pas' || $tempat == 'lab. pt.pas' || $tempat == 'lab. pt pas' || str_contains($tempat, 'lab') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="lab_{{ $formIndex }}">Lab. PT.PAS</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tempatKalibrasi" value="insitu" id="insitu_{{ $formIndex }}" {{ $tempat == 'insitu' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="insitu_{{ $formIndex }}">Insitu</label>
                                        </div>
                                    </div>
                                @else
                                    @php $tempat = strtolower($calibration->tempatKalibrasi ?? ''); @endphp
                                    <div class="d-flex">
                                        <div class="form-check me-5">
                                            <input class="form-check-input" type="radio" value="lab.PT PAS" disabled {{ $tempat == 'lab.pt pas' || $tempat == 'lab. pt.pas' || $tempat == 'lab. pt pas' || str_contains($tempat, 'lab') ? 'checked' : '' }}>
                                            <label class="form-check-label">Lab. PT.PAS</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="insitu" disabled {{ $tempat == 'insitu' ? 'checked' : '' }}>
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
                                    <tr>
                                        <td><p style="margin:0;">Kode TH</p></td>
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
                                    <div class="col-md-6 mb-4">
                                        <div class="kalibrasi-section-header">Fungsi Komponen Lainnya</div>
                                        
                                        @if($isFirstForm)
                                        @php $kondisi = strtolower(old('kondisiAlat', $calibration->kondisiAlat ?? '')); @endphp
                                        <div class="d-flex justify-content-center align-items-center mb-4" style="gap: 60px;">
                                            <div class="text-center">
                                                <span class="fw-bold d-block mb-2" style="font-size: 14px;">Ok</span>
                                                <input type="radio" name="kondisiAlat" value="ok" class="form-check-input" 
                                                    style="width: 18px; height: 18px; display: block; margin: 0 auto;"
                                                    {{ $kondisi == 'ok' || $kondisi == 'baik' ? 'checked' : '' }}>
                                            </div>
                                            <div class="text-center">
                                                <span class="fw-bold d-block mb-2" style="font-size: 14px;">Rusak</span>
                                                <input type="radio" name="kondisiAlat" value="rusak" class="form-check-input"
                                                    style="width: 18px; height: 18px; display: block; margin: 0 auto;"
                                                    {{ $kondisi == 'rusak' ? 'checked' : '' }}>
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
                                        @php $kondisi = strtolower($calibration->kondisiAlat ?? ''); @endphp
                                        <div class="d-flex justify-content-center align-items-center mb-4" style="gap: 60px;">
                                            <div class="text-center">
                                                <span class="fw-bold d-block mb-2" style="font-size: 14px;">Ok</span>
                                                <input type="radio" value="ok" class="form-check-input" 
                                                    style="width: 18px; height: 18px; display: block; margin: 0 auto;" disabled
                                                    {{ $kondisi == 'ok' || $kondisi == 'baik' ? 'checked' : '' }}>
                                            </div>
                                            <div class="text-center">
                                                <span class="fw-bold d-block mb-2" style="font-size: 14px;">Rusak</span>
                                                <input type="radio" value="rusak" class="form-check-input"
                                                    style="width: 18px; height: 18px; display: block; margin: 0 auto;" disabled
                                                    {{ $kondisi == 'rusak' ? 'checked' : '' }}>
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

                                <!-- DATA KALIBRASI -->
                                <div class="data-kalibrasi-header">DATA KALIBRASI</div>

                                <table class="data-kalibrasi-table" cellspacing="0" cellpadding="0" style="border:0.75pt solid #000000; border-collapse:collapse; width:100%; max-width:1200px;">
                                    <tr style="height:13.15pt">
                                        <td rowspan="3" style="width:15.8pt; border-right:0.75pt solid #000; border-bottom:0.75pt solid #000; vertical-align:top; text-align:center;">
                                            <p style="margin-top:15pt; font-size:8pt; font-weight:bold;">No</p>
                                        </td>
                                        <td colspan="2" style="width:96.35pt; border-right:0.75pt solid #000; border-bottom:0.75pt solid #000; vertical-align:top; text-align:center;">
                                            <p style="margin-top:5pt; font-size:8pt; font-weight:bold;">Nilai Nominal</p>
                                        </td>
                                        <td colspan="8" style="width:432.15pt; border-bottom:0.75pt solid #000; vertical-align:top; text-align:center;">
                                            <p style="margin-top:5pt; font-size:8pt; font-weight:bold;">PEMBACAAN STANDAR ULM</p>
                                        </td>
                                    </tr>
                                    <tr style="height:13.15pt">
                                        <td style="width:44.4pt; border:0.75pt solid #000; vertical-align:top; text-align:center;">
                                            <p style="margin-top:5pt; font-size:8pt; font-weight:bold;">UUT</p>
                                        </td>
                                        <td style="width:51.2pt; border:0.75pt solid #000; vertical-align:top; text-align:center;">
                                            <p style="margin-top:5pt; font-size:8pt; font-weight:bold;">Gauge Block</p>
                                        </td>
                                        <td colspan="4" style="width:215.10pt; border:0.75pt solid #000; vertical-align:top; text-align:center;">
                                            <p style="margin-top:5pt; font-size:8pt; font-weight:bold;">PENGUKURAN A dan B</p>
                                        </td>
                                        <td colspan="4" style="width:215.10pt; border:0.75pt solid #000; vertical-align:top; text-align:center;">
                                            <p style="margin-top:5pt; font-size:8pt; font-weight:bold;">PENGUKURAN A dan C</p>
                                        </td>
                                    </tr>
                                    <tr style="height:13.15pt">
                                        <td style="width:44.4pt; border:0.75pt solid #000; vertical-align:top; text-align:center;">
                                            <p style="margin-top:3pt; font-size:10pt; font-weight:bold;">
                                                Unit ( 
                                                <input type="text" name="satuan_unit_uut_{{ $formIndex }}" 
                                                       value="{{ $head->satuan_unit_uut ?? 'mm' }}"
                                                       style="width: 40px; border: none; text-align: center; background: transparent; font-size: 10pt;">
                                                )
                                            </p>
                                        </td>
                                        <td style="width:51.2pt; border:0.75pt solid #000; vertical-align:top; text-align:center;">
                                            <p style="margin-top:3pt; font-size:10pt; font-weight:bold;">
                                                Unit ( 
                                                <input type="text" name="satuan_unit_gauge_block_{{ $formIndex }}" 
                                                       value="{{ $head->satuan_unit_gauge_block ?? 'mm' }}"
                                                       style="width: 40px; border: none; text-align: center; background: transparent; font-size: 10pt;">
                                                )
                                            </p>
                                        </td>
                                        <td style="width:53.4pt; border:0.75pt solid #000; vertical-align:top; text-align:center;">
                                            <p style="margin-top:3pt; font-size:10pt; font-weight:bold;">Gauge Block(A)</p>
                                        </td>
                                        <td style="width:53.35pt; border:0.75pt solid #000; vertical-align:top; text-align:center;">
                                            <p style="margin-top:3pt; font-size:10pt; font-weight:bold;">UUT(B)</p>
                                        </td>
                                        <td style="width:53.35pt; border:0.75pt solid #000; vertical-align:top; text-align:center;">
                                            <p style="margin-top:3pt; font-size:10pt; font-weight:bold;">Gauge Block(A)</p>
                                        </td>
                                        <td style="width:53.35pt; border:0.75pt solid #000; vertical-align:top; text-align:center;">
                                            <p style="margin-top:3pt; font-size:10pt; font-weight:bold;">UUT(B)</p>
                                        </td>
                                        <td style="width:53.35pt; border:0.75pt solid #000; vertical-align:top; text-align:center;">
                                            <p style="margin-top:3pt; font-size:10pt; font-weight:bold;">Gauge Block(A)</p>
                                        </td>
                                        <td style="width:53.4pt; border:0.75pt solid #000; vertical-align:top; text-align:center;">
                                            <p style="margin-top:3pt; font-size:10pt; font-weight:bold;">UUT(C)</p>
                                        </td>
                                        <td style="width:53.35pt; border:0.75pt solid #000; vertical-align:top; text-align:center;">
                                            <p style="margin-top:3pt; font-size:10pt; font-weight:bold;">Gauge Block(A)</p>
                                        </td>
                                        <td style="width:53.35pt; border:0.75pt solid #000; vertical-align:top; text-align:center;">
                                            <p style="margin-top:3pt; font-size:10pt; font-weight:bold;">UUT(C)</p>
                                        </td>
                                    </tr>

                                    @php
                                        $maxRows = 25;
                                        $detailCount = count($formDetails);
                                    @endphp

                                    @for($row = 1; $row <= $maxRows; $row++)
                                        @php
                                            $detail = $row <= $detailCount ? $formDetails[$row - 1] : null;
                                            $detailId = $detail->id ?? null;
                                        @endphp
                                        <tr style="height:14.25pt">
                                            <td style="width:15.8pt; border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:10pt;">
                                                {{ $row }}
                                                @if($detailId)
                                                    <input type="hidden" name="detail_ids_{{ $formIndex }}[]" value="{{ $detailId }}">
                                                @endif
                                            </td>
                                            <td style="width:44.4pt; border:0.75pt solid #000; text-align:center; vertical-align:middle;">
                                                <input type="text" name="nominal_uut_{{ $formIndex }}_{{ $row }}" 
                                                       value="{{ $detail->nominalUUT ?? '' }}" 
                                                       style="width:100%; text-align:center; border:none; background:transparent;">
                                            </td>
                                            <td style="width:51.2pt; border:0.75pt solid #000; text-align:center; vertical-align:middle;">
                                                <input type="text" name="nominal_gb_{{ $formIndex }}_{{ $row }}" 
                                                       value="{{ $detail->nominalGB ?? '' }}" 
                                                       style="width:100%; text-align:center; border:none; background:transparent;">
                                            </td>
                                            <td style="width:53.4pt; border:0.75pt solid #000; text-align:center; vertical-align:middle;">
                                                <input type="text" name="ab_gb_a_{{ $formIndex }}_{{ $row }}" 
                                                       value="{{ $detail->GBA1 ?? '' }}" 
                                                       style="width:100%; text-align:center; border:none; background:transparent;">
                                            </td>
                                            <td style="width:53.35pt; border:0.75pt solid #000; text-align:center; vertical-align:middle;">
                                                <input type="text" name="ab_uut_b_{{ $formIndex }}_{{ $row }}" 
                                                       value="{{ $detail->UUTB1 ?? '' }}" 
                                                       style="width:100%; text-align:center; border:none; background:transparent;">
                                            </td>
                                            <td style="width:53.35pt; border:0.75pt solid #000; text-align:center; vertical-align:middle;">
                                                <input type="text" name="ab_gb_a2_{{ $formIndex }}_{{ $row }}" 
                                                       value="{{ $detail->GBA2 ?? '' }}" 
                                                       style="width:100%; text-align:center; border:none; background:transparent;">
                                            </td>
                                            <td style="width:53.35pt; border:0.75pt solid #000; text-align:center; vertical-align:middle;">
                                                <input type="text" name="ab_uut_b2_{{ $formIndex }}_{{ $row }}" 
                                                       value="{{ $detail->UUTB2 ?? '' }}" 
                                                       style="width:100%; text-align:center; border:none; background:transparent;">
                                            </td>
                                            <td style="width:53.35pt; border:0.75pt solid #000; text-align:center; vertical-align:middle;">
                                                <input type="text" name="ac_gb_a_{{ $formIndex }}_{{ $row }}" 
                                                       value="{{ $detail->GBA3 ?? '' }}" 
                                                       style="width:100%; text-align:center; border:none; background:transparent;">
                                            </td>
                                            <td style="width:53.4pt; border:0.75pt solid #000; text-align:center; vertical-align:middle;">
                                                <input type="text" name="ac_uut_c_{{ $formIndex }}_{{ $row }}" 
                                                       value="{{ $detail->UUTC3 ?? '' }}" 
                                                       style="width:100%; text-align:center; border:none; background:transparent;">
                                            </td>
                                            <td style="width:53.35pt; border:0.75pt solid #000; text-align:center; vertical-align:middle;">
                                                <input type="text" name="ac_gb_a2_{{ $formIndex }}_{{ $row }}" 
                                                       value="{{ $detail->GBA4 ?? '' }}" 
                                                       style="width:100%; text-align:center; border:none; background:transparent;">
                                            </td>
                                            <td style="width:53.35pt; border:0.75pt solid #000; text-align:center; vertical-align:middle;">
                                                <input type="text" name="ac_uut_c2_{{ $formIndex }}_{{ $row }}" 
                                                       value="{{ $detail->UUTC4 ?? '' }}" 
                                                       style="width:100%; text-align:center; border:none; background:transparent;">
                                            </td>
                                        </tr>
                                    @endfor
                                </table>

                                <!-- Footer Section -->
                                <div class="data-complete-section">
                                    <span class="data-complete-text">Data telah diisi dengan lengkap dan jelas!</span>
                                </div>

                                <!-- ALAT STANDAR -->
                                @if($isFirstForm)
                                    <!-- FORM 1 - BISA DIEDIT -->
                                    <table border="1" cellspacing="0" cellpadding="5" style="border-collapse: collapse; width: 100%; margin-bottom: 20px; border: 1px solid black;">
                                        <tr>
                                            <td colspan="4" style="text-align: center; font-weight: bold; background-color: #e6e6e6; border: 1px solid black;">
                                                Isilah lembar data kalibrasi dengan lengkap dan jelas!
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 20%; text-align: center; vertical-align: middle; border: 1px solid black;">
                                                Alat Standar
                                            </td>
                                            <td style="width: 40%; vertical-align: top; border: 1px solid black;">
                                                <input type="checkbox" class="alat-standar-checkbox" name="alat_standar[]" value="Mesin ULM 01-600D" id="ulm" 
                                                    {{ in_array('Mesin ULM 01-600D', $selectedStandards) ? 'checked' : '' }}>
                                                <label for="ulm">Mesin ULM 01-600D</label><br>
                                                <input type="checkbox" class="alat-standar-checkbox" name="alat_standar[]" value="Micrometer" id="micrometer" 
                                                    {{ in_array('Micrometer', $selectedStandards) ? 'checked' : '' }}>
                                                <label for="micrometer">Micrometer</label><br>
                                                <input type="checkbox" class="alat-standar-checkbox" name="alat_standar[]" value="Gauge Block" id="gaugeblock" 
                                                    {{ in_array('Gauge Block', $selectedStandards) ? 'checked' : '' }}>
                                                <label for="gaugeblock">Gauge Block</label>
                                            </td>
                                            <td style="width: 20%; text-align: center; vertical-align: top; border: 1px solid black;">
                                                Dikalibrasi oleh
                                            </td>
                                            <td style="width: 20%; text-align: center; vertical-align: top; border: 1px solid black;">
                                                Diperiksa oleh
                                            </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2" style="text-align: center; vertical-align: middle; border: 1px solid black;">
                                                Metode Kalibrasi
                                            </td>
                                            <td rowspan="2" style="text-align: center; vertical-align: middle; border: 1px solid black;">
                                                PAS-IK1102-62
                                            </td>
                                            <td style="border: 1px solid black;">
                                                TTD :
                                            </td>
                                            <td style="border: 1px solid black;">
                                                TTD :
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid black;">
                                                Nama :<br>
                                                <input type="text" name="calibratedBy" class="kalibrasi-input" 
                                                       value="{{ old('calibratedBy', $calibration->calibratedBy ?? '') }}" 
                                                       style="width: 100%; margin-top: 5px;">
                                            </td>
                                            <td style="border: 1px solid black;">
                                                Nama :<br>
                                                <input type="text" name="verifiedBy" class="kalibrasi-input" 
                                                       value="{{ old('verifiedBy', $calibration->verifiedBy ?? '') }}" 
                                                       style="width: 100%; margin-top: 5px;" readonly>
                                            </td>
                                        </tr>
                                    </table>
                                @else
                                    <!-- FORM 2,3,4,... - TAMPILAN DATA DARI FORM 1 (READONLY/DISABLED) -->
                                    <table border="1" cellspacing="0" cellpadding="5" style="border-collapse: collapse; width: 100%; margin-bottom: 20px; border: 1px solid black;">
                                        <tr>
                                            <td colspan="4" style="text-align: center; font-weight: bold; background-color: #e6e6e6; border: 1px solid black;">
                                                Isilah lembar data kalibrasi dengan lengkap dan jelas!
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 20%; text-align: center; vertical-align: middle; border: 1px solid black;">
                                                Alat Standar
                                            </td>
                                            <td style="width: 40%; vertical-align: top; border: 1px solid black;">
                                                <input type="checkbox" class="alat-standar-checkbox" disabled 
                                                    {{ in_array('Mesin ULM 01-600D', $selectedStandards) ? 'checked' : '' }}>
                                                <label>Mesin ULM 01-600D</label><br>
                                                <input type="checkbox" class="alat-standar-checkbox" disabled 
                                                    {{ in_array('Micrometer', $selectedStandards) ? 'checked' : '' }}>
                                                <label>Micrometer</label><br>
                                                <input type="checkbox" class="alat-standar-checkbox" disabled 
                                                    {{ in_array('Gauge Block', $selectedStandards) ? 'checked' : '' }}>
                                                <label>Gauge Block</label>
                                            </td>
                                            <td style="width: 20%; text-align: center; vertical-align: top; border: 1px solid black;">
                                                Dikalibrasi oleh
                                            </td>
                                            <td style="width: 20%; text-align: center; vertical-align: top; border: 1px solid black;">
                                                Diperiksa oleh
                                            </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2" style="text-align: center; vertical-align: middle; border: 1px solid black;">
                                                Metode Kalibrasi
                                            </td>
                                            <td rowspan="2" style="text-align: center; vertical-align: middle; border: 1px solid black;">
                                                PAS-IK1102-62
                                            </td>
                                            <td style="border: 1px solid black;">
                                                TTD :
                                            </td>
                                            <td style="border: 1px solid black;">
                                                TTD :
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid black;">
                                                Nama :<br>
                                                <input type="text" class="kalibrasi-input" 
                                                       value="{{ $calibration->calibratedBy ?? '' }}" 
                                                       style="width: 100%; background-color: #e9ecef;" readonly disabled>
                                            </td>
                                            <td style="border: 1px solid black;">
                                                Nama :<br>
                                                <input type="text" class="kalibrasi-input" 
                                                       value="{{ $calibration->verifiedBy ?? '' }}" 
                                                       style="width: 100%; background-color: #e9ecef;" readonly disabled>
                                            </td>
                                        </tr>
                                    </table>
                                @endif
                            </div>
                            <!-- ========================================== -->
                            <!-- AKHIR KONTEN FORM FEELER GAUGE -->
                            <!-- ========================================== -->
                        </div>
                    </div>
                @endfor
            </div>

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

        // ==========================================
        // FUNGSI TAMBAH / KURANG FORM - UNLIMITED
        // ==========================================
        
        let currentJumlahForm = parseInt(document.getElementById('jumlah_form_input').value) || 1;
        const MIN_FORM = 1;
        // TIDAK ADA BATAS MAKSIMUM (unlimited)
        
      // Fungsi untuk menambah form
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
                // Jika dibatalkan, tidak perlu melakukan apa-apa
            });
        }
        
        // Fungsi untuk mengurangi form
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
        
        // Fungsi untuk update tampilan counter
        function updateFormCounter() {
            const input = document.getElementById('jumlah_form_input');
            const btnKurang = document.getElementById('btnKurangForm');
            const badge = document.getElementById('formCountBadge');
            
            if (input) input.value = currentJumlahForm;
            if (btnKurang) btnKurang.disabled = currentJumlahForm <= MIN_FORM;
            if (badge) badge.textContent = `${currentJumlahForm} Form`;
        }
        
        // Fungsi untuk reload page dengan parameter jumlah form
        function reloadPageWithFormCount(count) {
            const url = new URL(window.location.href);
            url.searchParams.set('jumlah_form', count);
            window.location.href = url.toString();
        }
        
        // Event listener untuk tombol tambah
        document.getElementById('btnTambahForm')?.addEventListener('click', tambahForm);
        
        // Event listener untuk tombol kurang
        document.getElementById('btnKurangForm')?.addEventListener('click', kurangiForm);
        
        // Event listener untuk tombol Ubah (manual)
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
        
        // Event listener untuk enter pada input jumlah form
        document.getElementById('jumlah_form_input')?.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                document.getElementById('btnChangeJumlahForm').click();
            }
        });
        
        // ==========================================
        // FUNGSI HAPUS FORM (untuk tombol hapus per form)
        // ==========================================
        
        function removeForm(formIndex) {
            if (formIndex <= 1) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Tidak Dapat Dihapus',
                    text: 'Form pertama tidak dapat dihapus.',
                    confirmButtonText: 'OK'
                });
                return;
            }
            
            Swal.fire({
                title: 'Hapus Form?',
                text: `Apakah Anda yakin ingin menghapus form ke-${formIndex}? Data pada form tersebut akan dihapus.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const newCount = currentJumlahForm - 1;
                    reloadPageWithFormCount(newCount);
                }
            });
        }
        
        // ==========================================
        // VALIDASI FORM SEBELUM SUBMIT
        // ==========================================
        
        document.getElementById('editForm')?.addEventListener('submit', function(e) {
            console.log('🎯 Edit form submission started...');
            
            const alatStandarCheckboxes = document.querySelectorAll('.alat-standar-checkbox:checked');
            console.log('✅ Checked alat standar:', alatStandarCheckboxes.length);
            
            const kondisiAlatSelected = document.querySelector('input[name="kondisiAlat"]:checked');
            console.log('🎚️ Kondisi alat selected:', kondisiAlatSelected ? kondisiAlatSelected.value : 'none');
            
            const tempatKalibrasiSelected = document.querySelector('input[name="tempatKalibrasi"]:checked');
            console.log('📍 Tempat kalibrasi selected:', tempatKalibrasiSelected ? tempatKalibrasiSelected.value : 'none');
            
            let warningMessages = [];
            
            const tanggalMasuk = document.querySelector('input[name="tanggalMasuk"]')?.value;
            const tanggalKalibrasi = document.querySelector('input[name="tanggalKalibrasi"]')?.value;
            
            if (tanggalMasuk && tanggalKalibrasi) {
                if (new Date(tanggalMasuk) > new Date(tanggalKalibrasi)) {
                    warningMessages.push('Tanggal alat masuk tidak boleh lebih baru dari tanggal kalibrasi');
                }
            }
            
            if (alatStandarCheckboxes.length === 0) {
                warningMessages.push('Pilih minimal satu alat standar');
            }
            
            if (!kondisiAlatSelected) {
                warningMessages.push('Pilih kondisi alat (Ok/Rusak)');
            }
            
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
            console.log('📄 Edit form loaded for Feeler Gauge ID:', {{ $calibration->id }});
            console.log('🔢 Jumlah form:', {{ $jumlahForm }});
            console.log('📋 Detail records count:', {{ $allDetails->count() }});
            
            currentJumlahForm = {{ $jumlahForm }};
            updateFormCounter();
        });
    </script>
</body>
</html>