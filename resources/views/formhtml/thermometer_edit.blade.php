<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Kalibrasi Thermometer - PT. PANANJUNG ANUGRAH SOLUTION</title>
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
            f padding: 6px 10px;
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
        .alat-standar-checkbox[type="checkbox"]:checked,
        .metode-checkbox[type="checkbox"]:checked {
            background-color: #0d6efd !important;
            border-color: #0d6efd !important;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        .form-check-input[type="checkbox"]:checked:disabled,
        .alat-standar-checkbox[type="checkbox"]:checked:disabled,
        .metode-checkbox[type="checkbox"]:checked:disabled {
            background-color: #0d6efd !important;
            border-color: #0d6efd !important;
            opacity: 1 !important;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25) !important;
        }

        .form-check-input[type="checkbox"]:disabled,
        .alat-standar-checkbox[type="checkbox"]:disabled,
        .metode-checkbox[type="checkbox"]:disabled {
            background-color: #f8f9fa !important;
            border-color: #6c757d !important;
            opacity: 1 !important;
        }

        /* Checkmark putih untuk checkbox */
        .form-check-input[type="checkbox"]:checked,
        .alat-standar-checkbox[type="checkbox"]:checked,
        .metode-checkbox[type="checkbox"]:checked {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='m6 10 3 3 6-6'/%3e%3c/svg%3e") !important;
        }

        .form-check-input[type="checkbox"]:checked:disabled,
        .alat-standar-checkbox[type="checkbox"]:checked:disabled,
        .metode-checkbox[type="checkbox"]:checked:disabled {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='m6 10 3 3 6-6'/%3e%3c/svg%3e") !important;
        }

        /* RADIO BUTTON STYLING */
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

        /* Data complete section */
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

        /* Alat standar table */
        .alat-standar-table {
            width: 100%;
            border-collapse: collapse;
        }

        .alat-standar-table td {
            border: 1px solid #000;
            padding: 8px;
            vertical-align: middle;
        }

        /* Card styling untuk multiple form */
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

        /* Edit data table styling */
        .edit-suhu-container {
            width: 100%;
            display: flex;
            justify-content: space-between;
            gap: 4%;
            margin-bottom: 20px;
        }

        .edit-suhu-table {
            border-collapse: collapse;
            width: 48%;
            table-layout: fixed;
        }

        .edit-suhu-table th,
        .edit-suhu-table td {
            border: 1pt solid #000;
            padding: 2px;
            text-align: center;
            vertical-align: middle;
        }

        .edit-suhu-table th {
            font-size: 9pt;
            background-color: #f0f0f0;
            font-weight: bold;
        }

        .edit-header-cell {
            padding: 4px !important;
        }

        .edit-satuan-select {
            width: 80%;
            border: none;
            text-align: center;
            background: transparent;
            font-size: 9pt;
            font-weight: normal;
            margin-top: 2px;
            padding: 0;
        }

        .edit-setting-input {
            width: 80%;
            border: none;
            text-align: center;
            background: transparent;
            font-size: 9pt;
            padding: 2px;
        }

        .edit-data-input {
            width: 90%;
            border: none;
            text-align: center;
            background: transparent;
            font-size: 8pt;
            padding: 2px;
        }

        .edit-setting-column {
            width: 35%;
        }

        .edit-std-column,
        .edit-uut-column {
            width: 32.5%;
        }

        /* Print styling */
        @media print {
            .btn {
                display: none !important;
            }

            .form-card {
                border: 1px solid #000;
                break-inside: avoid;
            }

            .form-card-header {
                background: #f0f0f0 !important;
                color: #000 !important;
            }
        }

        /* Responsive */
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

            .edit-suhu-container {
                flex-direction: column;
                gap: 20px;
            }

            .edit-suhu-table {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="w-100 my-4">
        <form action="{{ route('calibrations.update', $calibration->id) }}" method="POST" id="editForm">
            @csrf
            @method('PUT')

            @php
            $jumlahForm = request()->query('jumlah_form', $calibration->jumlah_form ?? 1);
            $jumlahForm = max(1, (int)$jumlahForm);
            $heads = $calibration->headThermometer ?? collect();
            $details = $calibration->detailThermometers ?? collect();
            $form1Head = $calibration->headDepthMicrometerForm1;
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
                $head=$calibration->{'headThermometerForm' . $formIndex};
                $formDetails = $details->where('form_index', $formIndex)->sortBy('id');
                $isFirstForm = ($formIndex == 1);
                $rentangUkurMin = $head->rentang_ukur_min ?? '0';
                $rentangUkurMax = $head->rentang_ukur_max ?? '';
                $kapasitas = $head->kapasitas ?? '';
                $resolusi = $head->resolusi ?? '';
                @endphp

                @if($jumlahForm > 1)
                <div class="form-card">
                    <div class="form-card-header">
                        <i class="fas fa-file-alt me-2"></i>
                        Form Thermometer ke-{{ $formIndex }}
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
                                        <p style="margin: 0; font-size: 14px;">PAS-FLK30</p>
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
                                        <p style="margin: 0; font-weight: bold; font-size: 14px;">THERMOMETER</p>
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
                                    <td style="width: 20%;">
                                        <p style="margin: 0;">Nama Alat</p>
                                    </td>
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
                                    <td>
                                        <p style="margin: 0;">Merek</p>
                                    </td>
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
                                    <td>
                                        <p style="margin: 0;">Type / No. Seri</p>
                                    </td>
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

                                <!-- Rentang Ukur -->
                                <!-- 🔥 RENTANG UKUR - DIAMBIL DARI HEAD PER FORM -->
                                <tr>
                                    <td>
                                        <p style="margin:0;">Rentang Ukur</p>
                                    </td>
                                    <td colspan="3">
                                        <div class="d-flex align-items-center">
                                            <div class="me-3" style="width:45%;">
                                                <input type="text" class="kalibrasi-input" name="rentang_ukur_min_{{ $formIndex }}"
                                                    value="{{ old('rentang_ukur_min_' . $formIndex, $rentangUkurMin) }}"
                                                    placeholder="Range Min">
                                            </div>
                                            <span class="me-3">-</span>
                                            <div style="width:45%;">
                                                <input type="text" class="kalibrasi-input" name="rentang_ukur_max_{{ $formIndex }}"
                                                    value="{{ old('rentang_ukur_max_' . $formIndex, $rentangUkurMax) }}"
                                                    placeholder="Range Max">
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <!-- 🔥 KAPASITAS / RESOLUSI - DIAMBIL DARI HEAD PER FORM -->
                                <tr>
                                    <td>
                                        <p style="margin:0;">Kapasitas / Resolusi</p>
                                    </td>
                                    <td colspan="3">
                                        <div class="d-flex align-items-center">
                                            <input type="text" class="kalibrasi-input me-3" name="kapasitas_{{ $formIndex }}"
                                                value="{{ old('kapasitas_' . $formIndex, $kapasitas) }}"
                                                placeholder="Kapasitas" style="width:45%;">
                                            <span class="me-3">/</span>
                                            <input type="text" class="kalibrasi-input" name="resolusi_{{ $formIndex }}"
                                                value="{{ old('resolusi_' . $formIndex, $resolusi) }}"
                                                placeholder="Resolusi" style="width:45%;">
                                        </div>
                                    </td>
                                </tr>

                                <!-- Nama Pemilik -->
                                <tr>
                                    <td>
                                        <p style="margin: 0;">Nama Pemilik</p>
                                    </td>
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
                                    <td>
                                        <p style="margin: 0;">Tanggal Alat Masuk</p>
                                    </td>
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
                                    <td>
                                        <p style="margin: 0;">Tanggal Kalibrasi</p>
                                    </td>
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
                                    <td>
                                        <p style="margin: 0;">Tempat Kalibrasi</p>
                                    </td>
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
                                    <td>
                                        <p style="margin: 0;">Lokasi PT</p>
                                    </td>
                                    <td colspan="3">
                                        @if($isFirstForm)
                                        <input type="text" class="kalibrasi-input" name="lokasiPT" value="{{ old('lokasiPT', $calibration->lokasiPT) }}">
                                        @else
                                        <input type="text" class="kalibrasi-input" value="" readonly disabled style="background-color: #e9ecef;">
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p style="margin: 0;">Kode Th</p>
                                    </td>
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
                                <!-- Fungsi Komponen Lainnya -->
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
                                            <input type="text" class="kalibrasi-input" name="keterangan_fungsi_komponen" value="{{ old('keterangan_fungsi_komponen', $head->keterangan_fungsi_komponen ?? '') }}"
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
                                            <input type="text" class="kalibrasi-input" name="keterangan_fungsi_komponen_{{ $formIndex }}"
                                                value="{{ old('keterangan_fungsi_komponen_' . $formIndex, $head->keterangan_fungsi_komponen ?? '') }}"
                                                style="border: none; border-bottom: 2px solid #000; border-radius: 0; padding: 4px 0; background: transparent; width: 100%;">
                                        </div>
                                    </div>
                                    @endif
                                </div>

                                <!-- Kondisi Kalibrasi -->
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

                            <div class="data-kalibrasi-header">DATA KALIBRASI</div>

                            <div class="edit-suhu-container">
                                <!-- Tabel Kiri -->
                                <table class="edit-suhu-table">
                                    <tr>
                                        <th rowspan="2" class="edit-setting-column edit-header-cell">
                                            Setting Suhu<br>
                                            <select name="satuan_suhu_kiri_{{ $formIndex }}" class="edit-satuan-select">
                                                <option value="">(……………)</option>
                                                <option value="°C" {{ ($head->satuan_suhu_kiri ?? '') == '°C' ? 'selected' : '' }}>°C</option>
                                                <option value="°F" {{ ($head->satuan_suhu_kiri ?? '') == '°F' ? 'selected' : '' }}>°F</option>
                                            </select>
                                        </th>
                                        <th colspan="2" class="edit-header-cell">Pembacaan</th>
                                    </tr>
                                    <tr>
                                        <th class="edit-std-column edit-header-cell">STD</th>
                                        <th class="edit-uut-column edit-header-cell">UUT</th>
                                    </tr>

                                    @php
                                    $leftDetails = $formDetails->slice(0, 6);
                                    $leftDetailsArray = $leftDetails->values();
                                    @endphp

                                    @for($i = 0; $i < 6; $i++)
                                        @php
                                        $detail=$leftDetailsArray[$i] ?? null;
                                        $rowNumber=$i * 3 + 1; // 1, 4, 7, 10, 13, 16
                                        @endphp
                                        <tr>
                                        <td rowspan="3" style="height: 90px;">
                                            <input type="text"
                                                name="setting_suhu_{{ $formIndex }}_{{ $rowNumber }}"
                                                value="{{ $detail->titikUkur ?? '' }}"
                                                class="edit-setting-input"

                                                <input type="hidden" name="detail_ids_{{ $formIndex }}[]" value="{{ $detail->id ?? '' }}">
                                        </td>
                                        <td style="height: 30px;">
                                            <input type="text"
                                                name="std_{{ $formIndex }}_{{ $rowNumber }}"
                                                value="{{ $detail->STD01 ?? '' }}"
                                                class="edit-data-input"

                                                </td>
                                        <td style="height: 30px;">
                                            <input type="text"
                                                name="uut_{{ $formIndex }}_{{ $rowNumber }}"
                                                value="{{ $detail->UUT01 ?? '' }}"
                                                class="edit-data-input"

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="height: 30px;">
                                                    <input type="text"
                                                        name="std_{{ $formIndex }}_{{ $rowNumber + 1 }}"
                                                        value="{{ $detail->STD02 ?? '' }}"
                                                        class="edit-data-input"

                                                        </td>
                                                <td style="height: 30px;">
                                                    <input type="text"
                                                        name="uut_{{ $formIndex }}_{{ $rowNumber + 1 }}"
                                                        value="{{ $detail->UUT02 ?? '' }}"
                                                        class="edit-data-input"

                                                        </td>
                                            </tr>
                                            <tr>
                                                <td style="height: 30px;">
                                                    <input type="text"
                                                        name="std_{{ $formIndex }}_{{ $rowNumber + 2 }}"
                                                        value="{{ $detail->STD03 ?? '' }}"
                                                        class="edit-data-input"

                                                        </td>
                                                <td style="height: 30px;">
                                                    <input type="text"
                                                        name="uut_{{ $formIndex }}_{{ $rowNumber + 2 }}"
                                                        value="{{ $detail->UUT03 ?? '' }}"
                                                        class="edit-data-input"
                                                        type="text"
                                                        </td>
                                            </tr>
                                            @endfor
                                </table>

                                <!-- Tabel Kanan -->
                                <table class="edit-suhu-table">
                                    <tr>
                                        <th rowspan="2" class="edit-setting-column edit-header-cell">
                                            Setting Suhu<br>
                                            <select name="satuan_suhu_kanan_{{ $formIndex }}" class="edit-satuan-select">
                                                <option value="">(……………)</option>
                                                <option value="°C" {{ ($head->satuan_suhu_kanan ?? '') == '°C' ? 'selected' : '' }}>°C</option>
                                                <option value="°F" {{ ($head->satuan_suhu_kanan ?? '') == '°F' ? 'selected' : '' }}>°F</option>
                                            </select>
                                        </th>
                                        <th colspan="2" class="edit-header-cell">Pembacaan</th>
                                    </tr>
                                    <tr>
                                        <th class="edit-std-column edit-header-cell">STD</th>
                                        <th class="edit-uut-column edit-header-cell">UUT</th>
                                    </tr>

                                    @php
                                    $rightDetails = $formDetails->slice(6, 6);
                                    $rightDetailsArray = $rightDetails->values();
                                    @endphp

                                    @for($i = 0; $i < 6; $i++)
                                        @php
                                        $detail=$rightDetailsArray[$i] ?? null;
                                        $rowNumber=($i + 6) * 3 + 1; // 19, 22, 25, 28, 31, 34
                                        @endphp
                                        <tr>
                                        <td rowspan="3" style="height: 90px;">
                                            <input type="text"
                                                name="setting_suhu_{{ $formIndex }}_{{ $rowNumber }}"
                                                value="{{ $detail->titikUkur ?? '' }}"
                                                class="edit-setting-input"

                                                <input type="hidden" name="detail_ids_{{ $formIndex }}[]" value="{{ $detail->id ?? '' }}">
                                        </td>
                                        <td style="height: 30px;">
                                            <input type="text"
                                                name="std_{{ $formIndex }}_{{ $rowNumber }}"
                                                value="{{ $detail->STD01 ?? '' }}"
                                                class="edit-data-input"

                                                </td>
                                        <td style="height: 30px;">
                                            <input type="text"
                                                name="uut_{{ $formIndex }}_{{ $rowNumber }}"
                                                value="{{ $detail->UUT01 ?? '' }}"
                                                class="edit-data-input"

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="height: 30px;">
                                                    <input type="text"
                                                        name="std_{{ $formIndex }}_{{ $rowNumber + 1 }}"
                                                        value="{{ $detail->STD02 ?? '' }}"
                                                        class="edit-data-input"

                                                        </td>
                                                <td style="height: 30px;">
                                                    <input type="text"
                                                        name="uut_{{ $formIndex }}_{{ $rowNumber + 1 }}"
                                                        value="{{ $detail->UUT02 ?? '' }}"
                                                        class="edit-data-input"

                                                        </td>
                                            </tr>
                                            <tr>
                                                <td style="height: 30px;">
                                                    <input type="text"
                                                        name="std_{{ $formIndex }}_{{ $rowNumber + 2 }}"
                                                        value="{{ $detail->STD03 ?? '' }}"
                                                        class="edit-data-input"

                                                        </td>
                                                <td style="height: 30px;">
                                                    <input type="text"
                                                        name="uut_{{ $formIndex }}_{{ $rowNumber + 2 }}"
                                                        value="{{ $detail->UUT03 ?? '' }}"
                                                        class="edit-data-input"

                                                        </td>
                                            </tr>
                                            @endfor
                                </table>
                            </div>

                            <!-- ALAT STANDAR & METODE KALIBRASI -->
                            @php
                            // Ambil head berdasarkan formIndex menggunakan relasi yang sudah dibuat
                            $currentHead = null;

                            switch($formIndex) {
                            case 1:
                            $currentHead = $calibration->headThermometerForm1;
                            break;
                            case 2:
                            $currentHead = $calibration->headThermometerForm2;
                            break;
                            case 3:
                            $currentHead = $calibration->headThermometerForm3;
                            break;
                            case 4:
                            $currentHead = $calibration->headThermometerForm4;
                            break;
                            default:
                            $currentHead = $calibration->headThermometerForm1;
                            }

                            // Ambil nilai standard (contoh: "TD.001 Microbath & Dry Block")
                            $standardValue = $currentHead->standard ?? '';

                            // ==============================================================
                            // LOGIKA PENGECEKAN YANG BENAR UNTUK DATA SPASI
                            // ==============================================================
                            $checkTd001 = str_contains($standardValue, 'TD.001');
                            $checkTd002 = str_contains($standardValue, 'TD.002');
                            $checkTd003 = str_contains($standardValue, 'TD.003');
                            $checkTd004 = str_contains($standardValue, 'TD.004');

                            // Cek apakah mengandung "Microbath & Dry Block" sebagai satu kesatuan
                            $hasMicrobathDryBlock = str_contains($standardValue, 'Microbath & Dry Block');

                            // Hanya check Microbath jika ada "Microbath" TAPI BUKAN "Microbath & Dry Block"
                            $checkMicrobath = str_contains($standardValue, 'Microbath') && !$hasMicrobathDryBlock;

                            // Hanya check Dry Block jika ada "Dry Block" TAPI BUKAN "Microbath & Dry Block"
                            $checkDryBlock = str_contains($standardValue, 'Dry Block') && !$hasMicrobathDryBlock;

                            // Check Microbath & Dry Block jika ada
                            $checkMicrobathDryBlock = $hasMicrobathDryBlock;

                            // ==============================================================
                            // AMBIL METODE KALIBRASI
                            // ==============================================================
                            $calibrationMethodValue = $currentHead->calibrationMethod ?? '';

                            // Cek metode kalibrasi (data bisa "PAS-IK1102-30 (Thermometer Digital)" atau "PAS-IK1102-30")
                            $checkMetode1 = str_contains($calibrationMethodValue, 'PAS-IK1102-30');
                            $checkMetode2 = str_contains($calibrationMethodValue, 'PAS-IK1102-31');
                            $checkMetode3 = str_contains($calibrationMethodValue, 'PAS-IK1102-32');

                            // Ambil calibrated_by dan verified_by
                            $calibratedByValue = $calibration->calibratedBy ?? $calibration->calibrated_by ?? (auth()->user()->nama ?? '');
                            $verifiedByValue = $currentHead->verified_by ?? $calibration->verifiedBy ?? $calibration->verified_by ?? '';

                            // Debug (hapus di production)
                            // echo "<!-- FORM INDEX: {$formIndex} -->\n";
                            // echo "<!-- STANDARD VALUE: {$standardValue} -->\n";
                            // echo "<!-- METHOD VALUE: {$calibrationMethodValue} -->\n";
                            @endphp

                            <!-- TABLE ALAT STANDAR & METODE KALIBRASI -->
                            <table class="alat-standar-table" style="width:100%; border-collapse:collapse;">
                                <!-- HEADER ROW -->
                                <tr style="height:13.5pt">
                                    <td rowspan="4" style="width:105.35pt; border:1pt solid #000; vertical-align:middle; text-align:center; font-weight:bold; font-size:10pt; color:#000000;">
                                        Standard
                                    </td>
                                    <td style="width:24.75pt; border:1pt solid #000; text-align:center; vertical-align:middle;">
                                        <input type="checkbox" name="alat_standar_{{ $formIndex }}[]" value="TD.001" id="std1_{{ $formIndex }}"
                                            {{ $checkTd001 ? 'checked' : '' }}>
                                    </td>
                                    <td style="width:63.6pt; border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
                                        <label for="std1_{{ $formIndex }}" style="cursor:pointer; color:#000000;">TD.001</label>
                                    </td>
                                    <td style="width:15.55pt; border:1pt solid #000; text-align:center; vertical-align:middle;">
                                        <input type="checkbox" name="alat_standar_{{ $formIndex }}[]" value="Microbath" id="jenis1_{{ $formIndex }}"
                                            {{ $checkMicrobath ? 'checked' : '' }}>
                                    </td>
                                    <td style="width:84.3pt; border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
                                        <label for="jenis1_{{ $formIndex }}" style="cursor:pointer; color:#000000;">Microbath</label>
                                    </td>
                                    <td rowspan="4" style="width:111.15pt; border-top:1pt solid #000; border-right:1pt solid #000; border-left:1pt solid #000; border-bottom:none; padding-top:6pt; text-align:center; vertical-align:top; font-size:8.5pt; color:#000000;">
                                        Dikalibrasi<br>oleh
                                    </td>
                                    <td rowspan="4" style="width:98.3pt; border-top:1pt solid #000; border-right:1pt solid #000; border-left:1pt solid #000; border-bottom:none; padding-top:6pt; text-align:center; vertical-align:top; font-size:8.5pt; color:#000000;">
                                        Diperiksa<br>oleh
                                    </td>
                                </tr>

                                <!-- TD.002 & Dry Block -->
                                <tr style="height:13.5pt">
                                    <td style="border:1pt solid #000; text-align:center; vertical-align:middle;">
                                        <input type="checkbox" name="alat_standar_{{ $formIndex }}[]" value="TD.002" id="std2_{{ $formIndex }}"
                                            {{ $checkTd002 ? 'checked' : '' }}>
                                    </td>
                                    <td style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
                                        <label for="std2_{{ $formIndex }}" style="cursor:pointer; color:#000000;">TD.002</label>
                                    </td>
                                    <td style="border:1pt solid #000; text-align:center; vertical-align:middle;">
                                        <input type="checkbox" name="alat_standar_{{ $formIndex }}[]" value="Dry Block" id="jenis2_{{ $formIndex }}"
                                            {{ $checkDryBlock ? 'checked' : '' }}>
                                    </td>
                                    <td style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
                                        <label for="jenis2_{{ $formIndex }}" style="cursor:pointer; color:#000000;">Dry Block</label>
                                    </td>
                                </tr>

                                <!-- TD.003 & Microbath & Dry Block -->
                                <tr style="height:13.5pt">
                                    <td style="border:1pt solid #000; text-align:center; vertical-align:middle;">
                                        <input type="checkbox" name="alat_standar_{{ $formIndex }}[]" value="TD.003" id="std3_{{ $formIndex }}"
                                            {{ $checkTd003 ? 'checked' : '' }}>
                                    </td>
                                    <td style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
                                        <label for="std3_{{ $formIndex }}" style="cursor:pointer; color:#000000;">TD.003</label>
                                    </td>
                                    <td rowspan="2" style="border:1pt solid #000; text-align:center; vertical-align:middle;">
                                        <input type="checkbox" name="alat_standar_{{ $formIndex }}[]" value="Microbath & Dry Block" id="jenis4_{{ $formIndex }}"
                                            {{ $checkMicrobathDryBlock ? 'checked' : '' }}>
                                    </td>
                                    <td rowspan="2" style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
                                        <label for="jenis4_{{ $formIndex }}" style="cursor:pointer; color:#000000;">Microbath & Dry Block</label>
                                    </td>
                                </tr>

                                <!-- TD.004 -->
                                <tr style="height:13.5pt">
                                    <td style="border:1pt solid #000; text-align:center; vertical-align:middle;">
                                        <input type="checkbox" name="alat_standar_{{ $formIndex }}[]" value="TD.004" id="std4_{{ $formIndex }}"
                                            {{ $checkTd004 ? 'checked' : '' }}>
                                    </td>
                                    <td style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
                                        <label for="std4_{{ $formIndex }}" style="cursor:pointer; color:#000000;">TD.004</label>
                                    </td>
                                </tr>

                                <!-- METODE KALIBRASI ROW 1 -->
                                <tr style="height:15pt">
                                    <td rowspan="4" style="width:105.35pt; border:1pt solid #000; vertical-align:middle; text-align:center; font-weight:bold; font-size:10pt; color:#000000;">
                                        Metode Kalibrasi
                                    </td>
                                    <td style="width:24.75pt; border:1pt solid #000; text-align:center; vertical-align:middle;">
                                        <input type="checkbox" name="metode_kalibrasi_{{ $formIndex }}[]" value="PAS-IK1102-30 (Thermometer Digital)" id="metode1_{{ $formIndex }}"
                                            {{ $checkMetode1 ? 'checked' : '' }}>
                                    </td>
                                    <td colspan="3" style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
                                        <label for="metode1_{{ $formIndex }}" style="cursor:pointer; color:#000000;">PAS-IK1102-30 (Thermometer Digital)</label>
                                    </td>
                                    <td style="width:111.15pt; border-top:none; border-right:1pt solid #000; border-left:1pt solid #000; border-bottom:1pt solid #000; padding:3.35pt 0 0 1.35pt; font-size:8.5pt; vertical-align:top; color:#000000;">
                                        &nbsp;
                                    </td>
                                    <td style="width:98.3pt; border-top:none; border-right:1pt solid #000; border-left:1pt solid #000; border-bottom:1pt solid #000; padding:3.35pt 0 0 1.8pt; font-size:8.5pt; vertical-align:top; color:#000000;">
                                        &nbsp;
                                    </td>
                                </tr>

                                <!-- METODE KALIBRASI ROW 2 -->
                                <tr style="height:15pt">
                                    <td style="border:1pt solid #000; text-align:center; vertical-align:middle;">
                                        <input type="checkbox" name="metode_kalibrasi_{{ $formIndex }}[]" value="PAS-IK1102-31 (Thermometer Gelas)" id="metode2_{{ $formIndex }}"
                                            {{ $checkMetode2 ? 'checked' : '' }}>
                                    </td>
                                    <td colspan="3" style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
                                        <label for="metode2_{{ $formIndex }}" style="cursor:pointer; color:#000000;">PAS-IK1102-31 (Thermometer Gelas)</label>
                                    </td>
                                    <td style="width:111.15pt; border-top:none; border-right:1pt solid #000; border-left:1pt solid #000; border-bottom:1pt solid #000; padding:1.8pt 0 0 1.35pt; font-size:8.5pt; vertical-align:top; color:#000000;">
                                        TTD :
                                    </td>
                                    <td style="width:98.3pt; border-top:none; border-right:1pt solid #000; border-left:1pt solid #000; border-bottom:1pt solid #000; padding:1.8pt 0 0 1.8pt; font-size:8.5pt; vertical-align:top; color:#000000;">
                                        TTD :
                                    </td>
                                </tr>

                                <!-- METODE KALIBRASI ROW 3 -->
                                <tr style="height:15pt">
                                    <td style="border:1pt solid #000; text-align:center; vertical-align:middle;">
                                        <input type="checkbox" name="metode_kalibrasi_{{ $formIndex }}[]" value="PAS-IK1102-32 (Thermometer Dial)" id="metode3_{{ $formIndex }}"
                                            {{ $checkMetode3 ? 'checked' : '' }}>
                                    </td>
                                    <td colspan="3" style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
                                        <label for="metode3_{{ $formIndex }}" style="cursor:pointer; color:#000000;">PAS-IK1102-32 (Thermometer Dial)</label>
                                    </td>
                                    <td style="width:111.15pt; border-top:none; border-right:1pt solid #000; border-left:1pt solid #000; border-bottom:1pt solid #000; padding:1.8pt 0 0 1.35pt; font-size:8.5pt; vertical-align:top; color:#000000;">
                                        <input type="text" name="calibratedBy_{{ $formIndex }}" class="kalibrasi-input"
                                            value="{{ old('calibratedBy_' . $formIndex, $calibratedByValue) }}"
                                            placeholder="Nama"
                                            style="border: none; width: 100%; background-color: transparent;">
                                    </td>
                                    <td style="width:98.3pt; border-top:none; border-right:1pt solid #000; border-left:1pt solid #000; border-bottom:1pt solid #000; padding:1.8pt 0 0 1.8pt; font-size:8.5pt; vertical-align:top; color:#000000;">
                                        <input type="text" name="verifiedBy_{{ $formIndex }}" class="kalibrasi-input"
                                            value="{{ old('verifiedBy_' . $formIndex, $verifiedByValue) }}"
                                            placeholder="-"
                                            style="border: none; width: 100%;">
                                    </td>
                                </tr>
                            </table>
                            @if($jumlahForm > 1)
                        </div>
                    </div>
                    @endif
                    @endfor

                    <!-- Action Buttons Section - DI LUAR LOOP -->
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
            console.log('📄 Edit form loaded for Inside Micrometer ID:', {
                {
                    $calibration - > id
                }
            });

            @for($formIndex = 1; $formIndex <= $jumlahForm; $formIndex++)
            @php
            $head = $headsByForm[$formIndex] ?? null;
            @endphp
            console.log('📋 Form {{ $formIndex }} - Head Data:', {
                rentang_ukur_min: '{{ $head->rentang_ukur_min ?? '
                0 ' }}',
                rentang_ukur_max: '{{ $head->rentang_ukur_max ?? '
                ' }}',
                kapasitas: '{{ $head->kapasitas ?? '
                ' }}',
                resolusi: '{{ $head->resolusi ?? '
                ' }}',
                satuan_unit: '{{ $head->satuan_unit ?? '
                mm ' }}',
                standard: '{{ $head->standard ?? '
                ' }}'
            });
            @endfor
        });
    </script>

    <script>
        const MIN_FORM = 1;
        let currentJumlahForm = {
            {
                $jumlahForm
            }
        };

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