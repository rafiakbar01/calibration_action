<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Kalibrasi Anak Timbangan - PT. PANANJUNG ANUGRAH SOLUTION</title>
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

        .kalibrasi-table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .kalibrasi-table th,
        .kalibrasi-table td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
            vertical-align: middle;
        }

        .kalibrasi-table input[type="text"] {
            width: 95%;
            border: none;
            outline: none;
            text-align: center;
            font-family: Arial, sans-serif;
            font-size: 12px;
            background: transparent;
            padding: 2px;
        }

        .kalibrasi-table input[type="text"]:focus {
            background: #f0f8ff;
            border: 1px solid #3b82f6;
            border-radius: 4px;
        }

        .left {
            text-align: left;
        }

        .required-field::after {
            content: " *";
            color: #dc3545;
        }

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
</head>

<body>
    <div class="container my-4">
        <form action="{{ route('calibrations.update', $calibration->id) }}" method="POST" id="editForm">
            @csrf
            @method('PUT')

            @php
            $jumlahForm = request()->query('jumlah_form', $calibration->jumlah_form ?? 1);
            $jumlahForm = max(1, (int)$jumlahForm);

            // Fungsi bantu untuk parsing alat standar
            function getAlatStandarArrayForEdit($standardString) {
            if (empty($standardString)) {
            return [];
            }
            if (strpos($standardString, ',') !== false) {
            $items = array_map('trim', explode(',', $standardString));
            return array_filter($items);
            }
            return [$standardString];
            }

            // Ambil semua head
            $allHeads = \App\Models\HeadAnakTimbangan::where('calibration_id', $calibration->id)->get();
            $details = \App\Models\DetailAnakTimbangan::where('calibration_id', $calibration->id)->get();
            $form1Head = $allHeads->where('form_index', 1)->first();

            // ðŸ”¥ KAPASITAS DAN RESOLUSI DIAMBIL DARI CALIBRATION
            $kapasitasCalibration = $calibration->kapasitas ?? '';
            $resolusiCalibration = $calibration->resolusi ?? '';
            @endphp

            <!-- Pilihan Jumlah Form -->
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
                $head=$allHeads->where('form_index', $formIndex)->first();
                if (!$head && $formIndex == 1) {
                $head = $allHeads->whereNull('form_index')->first();
                }

                $formDetails = $details->where('form_index', $formIndex);
                if ($formDetails->isEmpty() && $formIndex == 1) {
                $formDetails = $details->whereNull('form_index');
                }
                $formDetails = $formDetails->sortBy('id');

                $isFirstForm = ($formIndex == 1);

                // Ambil data dari head
                $standardValue = $head->standard ?? '';
                $satuanUnit01 = $head->satuan_unit01 ?? '';
                $satuanUnit02 = $head->satuan_unit02 ?? '';
                $verifiedByValue = $head->verified_by ?? '';
                $keteranganFungsiKomponen = $head->keterangan_fungsi_komponen ?? '';
                $certificateId = $head->certificate_id ?? $form1Head->certificate_id ?? $calibration->certificate_id ?? 'N/A';

                // ðŸ”¥ KAPASITAS DAN RESOLUSI DIAMBIL DARI CALIBRATION
                $kapasitas = $kapasitasCalibration;
                $resolusi = $resolusiCalibration;

                // Parse alat standar
                $selectedStandards = getAlatStandarArrayForEdit($standardValue);
                @endphp

                @if($jumlahForm > 1)
                <div class="form-card">
                    <div class="form-card-header">
                        <i class="fas fa-weight-scale me-2"></i>
                        Form Anak Timbangan ke-{{ $formIndex }}
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
                                        <p style="margin: 0; font-size: 14px;">PAS-FLK16</p>
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
                                        <p style="margin: 0; font-weight: bold; font-size: 14px;">ANAK TIMBANGAN</p>
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
                                        <p style="margin: 0; font-size: 14px; font-weight: bold;">{{ $certificateId }}</p>
                                    </td>
                                </tr>
                            </table>

                            <!-- Main Form Section -->
                            <table class="kalibrasi-main-table">
                                <!-- Nama Alat -->
                                <tr>
                                    <td style="width: 20%;">
                                        <p class="required-field" style="margin:0;">Nama Alat</p>
                                    </td>
                                    <td colspan="3">
                                        @if($isFirstForm)
                                        <input type="text" class="kalibrasi-input" name="namaAlat" value="{{ old('namaAlat', $calibration->namaAlat) }}">
                                        @else
                                        <input type="text" class="kalibrasi-input" value="{{ $calibration->namaAlat }}" readonly disabled style="background-color: #e9ecef;">
                                        @endif
                                    </td>
                                </tr>

                                <!-- Merek & Kode Alat -->
                                <tr>
                                    <td>
                                        <p class="required-field" style="margin:0;">Merek</p>
                                    </td>
                                    <td colspan="3">
                                        <div class="d-flex align-items-center">
                                            @if($isFirstForm)
                                            <input type="text" class="kalibrasi-input me-3" name="brandAlat" value="{{ old('brandAlat', $calibration->brandAlat) }}" style="width: 60%;">
                                            <span class="me-3">Kode Alat :</span>
                                            <input type="text" class="kalibrasi-input" name="kodeAlat" value="{{ old('kodeAlat', $calibration->kodeAlat) }}" style="width: 30%;">
                                            @else
                                            <input type="text" class="kalibrasi-input me-3" value="{{ $calibration->brandAlat }}" readonly disabled style="width: 60%; background-color: #e9ecef;">
                                            <span class="me-3">Kode Alat :</span>
                                            <input type="text" class="kalibrasi-input" value="{{ $calibration->kodeAlat }}" readonly disabled style="width: 30%; background-color: #e9ecef;">
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <!-- Type / No. Seri -->
                                <tr>
                                    <td>
                                        <p class="required-field" style="margin:0;">Type / No. Seri</p>
                                    </td>
                                    <td colspan="3">
                                        <div class="d-flex align-items-center">
                                            @if($isFirstForm)
                                            <input type="text" class="kalibrasi-input me-3" name="typeAlat" value="{{ old('typeAlat', $calibration->typeAlat) }}" style="width: 45%;">
                                            <span class="me-3">/</span>
                                            <input type="text" class="kalibrasi-input" name="NoSeri" value="{{ old('NoSeri', $calibration->NoSeri) }}" style="width: 45%;">
                                            @else
                                            <input type="text" class="kalibrasi-input me-3" value="{{ $calibration->typeAlat }}" readonly disabled style="width: 45%; background-color: #e9ecef;">
                                            <span class="me-3">/</span>
                                            <input type="text" class="kalibrasi-input" value="{{ $calibration->NoSeri }}" readonly disabled style="width: 45%; background-color: #e9ecef;">
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <!-- Kapasitas / Resolusi - ðŸ”¥ DIAMBIL DARI CALIBRATION -->
                                <tr>
                                    <td>
                                        <p style="margin:0;">Kapasitas / Resolusi</p>
                                    </td>
                                    <td colspan="3">
                                        <div class="d-flex align-items-center">
                                            <input type="text" class="kalibrasi-input me-3" name="kapasitas_{{ $formIndex }}"
                                                value="{{ old('kapasitas_' . $formIndex, $kapasitas) }}"
                                                placeholder="Kapasitas" style="width: 45%;">
                                            <span class="me-3">/</span>
                                            <input type="text" class="kalibrasi-input" name="resolusi_{{ $formIndex }}"
                                                value="{{ old('resolusi_' . $formIndex, $resolusi) }}"
                                                placeholder="Resolusi" style="width: 45%;">
                                        </div>
                                    </td>
                                </tr>

                                <!-- Nama Pemilik -->
                                <tr>
                                    <td>
                                        <p class="required-field" style="margin:0;">Nama Pemilik</p>
                                    </td>
                                    <td colspan="3">
                                        @if($isFirstForm)
                                        <input type="text" class="kalibrasi-input" name="pemilikAlat" value="{{ old('pemilikAlat', $calibration->pemilikAlat) }}">
                                        @else
                                        <input type="text" class="kalibrasi-input" value="{{ $calibration->pemilikAlat }}" readonly disabled style="background-color: #e9ecef;">
                                        @endif
                                    </td>
                                </tr>

                                <!-- Tanggal Alat Masuk -->
                                <tr>
                                    <td>
                                        <p class="required-field" style="margin:0;">Tanggal Alat Masuk</p>
                                    </td>
                                    <td colspan="3">
                                        @if($isFirstForm)
                                        <input type="date" class="kalibrasi-input" name="tanggalMasuk" value="{{ old('tanggalMasuk', $calibration->tanggalMasuk ? \Carbon\Carbon::parse($calibration->tanggalMasuk)->format('Y-m-d') : '') }}">
                                        @else
                                        <input type="date" class="kalibrasi-input" value="{{ $calibration->tanggalMasuk ? \Carbon\Carbon::parse($calibration->tanggalMasuk)->format('Y-m-d') : '' }}" readonly disabled style="background-color: #e9ecef;">
                                        @endif
                                    </td>
                                </tr>

                                <!-- Tanggal Kalibrasi -->
                                <tr>
                                    <td>
                                        <p class="required-field" style="margin:0;">Tanggal Kalibrasi</p>
                                    </td>
                                    <td colspan="3">
                                        @if($isFirstForm)
                                        <input type="date" class="kalibrasi-input" name="tanggalKalibrasi"
                                            value="{{ old('tanggalKalibrasi', $calibration->tanggalKalibrasi ? \Carbon\Carbon::parse($calibration->tanggalKalibrasi)->format('Y-m-d') : date('Y-m-d')) }}">
                                        @else
                                        <input type="date" class="kalibrasi-input" value="{{ $calibration->tanggalKalibrasi ? \Carbon\Carbon::parse($calibration->tanggalKalibrasi)->format('Y-m-d') : date('Y-m-d') }}" readonly disabled style="background-color: #e9ecef;">
                                        @endif
                                    </td>
                                </tr>

                                <!-- Tempat Kalibrasi -->
                                <tr>
                                    <td>
                                        <p style="margin:0;">Tempat Kalibrasi</p>
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
                                                <input class="form-check-input" type="radio" disabled {{ $calibration->tempatKalibrasi == 'lab.PT PAS' ? 'checked' : '' }}>
                                                <label class="form-check-label">Lab. PT.PAS</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" disabled {{ $calibration->tempatKalibrasi == 'insitu' ? 'checked' : '' }}>
                                                <label class="form-check-label">Insitu</label>
                                            </div>
                                        </div>
                                        @endif
                                    </td>
                                </tr>

                                <!-- Lokasi PT -->
                                <tr>
                                    <td>
                                        <p style="margin:0;">Lokasi PT</p>
                                    </td>
                                    <td colspan="3">
                                        @if($isFirstForm)
                                        <input type="text" class="kalibrasi-input" name="lokasiPT" value="{{ old('lokasiPT', $calibration->lokasiPT) }}">
                                        @else
                                        <input type="text" class="kalibrasi-input" value="{{ $calibration->lokasiPT }}" readonly disabled style="background-color: #e9ecef;">
                                        @endif
                                    </td>
                                </tr>

                                <!-- Kode TH -->
                                <tr>
                                    <td>
                                        <p style="margin:0;">Kode TH</p>
                                    </td>
                                    <td colspan="3">
                                        @if($isFirstForm)
                                        <input type="text" class="kalibrasi-input" name="kode_th" value="{{ old('kode_th', $calibration->kode_th) }}">
                                        @else
                                        <input type="text" class="kalibrasi-input" value="{{ $calibration->kode_th }}" readonly disabled style="background-color: #e9ecef;">
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
                                            <input type="text" class="kalibrasi-input" name="keterangan" value="{{ old('keterangan', $calibration->keterangan) }}"
                                                style="border: none; border-bottom: 2px solid #000; border-radius: 0; padding: 4px 0; background: transparent; width: 100%;">
                                        </div>
                                    </div>
                                    @else
                                    <div class="d-flex justify-content-center align-items-center mb-4" style="gap: 60px;">
                                        <div class="text-center">
                                            <span class="fw-bold d-block mb-2">Ok</span>
                                            <input type="radio" class="form-check-input" disabled style="width: 18px; height: 18px;" {{ $calibration->kondisiAlat == 'ok' ? 'checked' : '' }}>
                                        </div>
                                        <div class="text-center">
                                            <span class="fw-bold d-block mb-2">Rusak</span>
                                            <input type="radio" class="form-check-input" disabled style="width: 18px; height: 18px;" {{ $calibration->kondisiAlat == 'rusak' ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="fw-bold me-3" style="min-width: 100px;">Keterangan :</span>
                                        <div style="flex: 1;">
                                            <input type="text" class="kalibrasi-input" name="keterangan_{{ $formIndex }}"
                                                value="{{ old('keterangan_' . $formIndex, $keteranganFungsiKomponen) }}"
                                                style="border: none; border-bottom: 2px solid #000; border-radius: 0; padding: 4px 0; background: transparent; width: 100%;">
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
                                            <td class="bg-light fw-bold">Suhu (&deg;C)</td>
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
                                            <td class="bg-light fw-bold">Suhu (&deg;C)</td>
                                            <td><input type="text" class="kondisi-input" value="{{ $calibration->RT_condition1 ?? '' }}" readonly disabled style="background-color: #e9ecef;"></td>
                                            <td><input type="text" class="kondisi-input" value="{{ $calibration->RT_condition2 ?? '' }}" readonly disabled style="background-color: #e9ecef;"></td>
                                            <td><input type="text" class="kondisi-input" value="{{ $calibration->RT_condition3 ?? '' }}" readonly disabled style="background-color: #e9ecef;"></td>
                                        </tr>
                                        <tr>
                                            <td class="bg-light fw-bold">RH (%)</td>
                                            <td><input type="text" class="kondisi-input" value="{{ $calibration->RH_condition1 ?? '' }}" readonly disabled style="background-color: #e9ecef;"></td>
                                            <td><input type="text" class="kondisi-input" value="{{ $calibration->RH_condition2 ?? '' }}" readonly disabled style="background-color: #e9ecef;"></td>
                                            <td><input type="text" class="kondisi-input" value="{{ $calibration->RH_condition3 ?? '' }}" readonly disabled style="background-color: #e9ecef;"></td>
                                        </tr>
                                    </table>
                                    @endif
                                </div>
                            </div>

                            <!-- DATA KALIBRASI -->
                            <div class="data-kalibrasi-header">DATA KALIBRASI ANAK TIMBANGAN - Form {{ $formIndex }}</div>

                            <table class="kalibrasi-table">
                                <thead>
                                    <tr>
                                        <th rowspan="2">No</th>
                                        <th rowspan="2">Massa Nominal</th>
                                        <th colspan="3">Pembacaan Timbangan</th>
                                        <th colspan="3">Pembacaan Timbangan</th>
                                        <th rowspan="2">AT Standard</th>
                                    </tr>
                                    <tr>
                                        <th colspan="3">
                                            Unit (
                                            <input type="text" name="satuan_unit01_{{ $formIndex }}"
                                                value="{{ old('satuan_unit01_' . $formIndex, $satuanUnit01) }}"
                                                style="display:inline-block; width:50px; border:none; border-bottom:1px solid #000; text-align:center; background:transparent;">
                                            )
                                        </th>
                                        <th colspan="3">
                                            Unit (
                                            <input type="text" name="satuan_unit02_{{ $formIndex }}"
                                                value="{{ old('satuan_unit02_' . $formIndex, $satuanUnit02) }}"
                                                style="display:inline-block; width:50px; border:none; border-bottom:1px solid #000; text-align:center; background:transparent;">
                                            )
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $detailArray = $formDetails->values()->toArray();
                                    $maxData = min(5, count($detailArray));
                                    @endphp

                                    @if($maxData > 0)
                                    @for($i = 0; $i < $maxData; $i++)
                                        @php
                                        $currentData=$detailArray[$i];
                                        $rowNumber=$i + 1;

                                        if(!$currentData) continue;

                                        $massaNominal=$currentData['nominalAlat'] ?? '' ;
                                        $atStandard=$currentData['ATSTD'] ?? '' ;
                                        $unit01_s_1=$currentData['ULSTD'] ?? '' ;
                                        $unit02_s_1=$currentData['URSTD'] ?? '' ;
                                        $unit01_t_1=$currentData['ULUUT'] ?? '' ;
                                        $unit02_t_1=$currentData['URUUT'] ?? '' ;
                                        $unit01_t_2=$currentData['LLUUT'] ?? '' ;
                                        $unit02_t_2=$currentData['LRUUT'] ?? '' ;
                                        $unit01_s_2=$currentData['LLSTD'] ?? '' ;
                                        $unit02_s_2=$currentData['LRSTD'] ?? '' ;
                                        @endphp

                                        <!-- Hidden input untuk track detail ID -->
                                        <input type="hidden" name="detail_ids_{{ $formIndex }}[]" value="{{ $currentData['id'] ?? '' }}">

                                        <!-- Baris 1: S - S -->
                                        <tr>
                                            <td rowspan="4">{{ $rowNumber }}</td>
                                            <td rowspan="4">
                                                <input type="text" name="massa_nominal_{{ $formIndex }}_{{ $rowNumber }}"
                                                    value="{{ $massaNominal }}"
                                                    style="width:100%; border:none; background:transparent; text-align:center;">
                                            </td>
                                            <td>S</td>
                                            <td colspan="2">
                                                <input type="text" name="unit01_s_{{ $formIndex }}_{{ $rowNumber }}_1"
                                                    value="{{ $unit01_s_1 }}"
                                                    style="width:100%; border:none; background:transparent; text-align:center;">
                                            </td>
                                            <td>S</td>
                                            <td colspan="2">
                                                <input type="text" name="unit02_s_{{ $formIndex }}_{{ $rowNumber }}_1"
                                                    value="{{ $unit02_s_1 }}"
                                                    style="width:100%; border:none; background:transparent; text-align:center;">
                                            </td>
                                            <td rowspan="4">
                                                <input type="text" name="at_standard_{{ $formIndex }}_{{ $rowNumber }}"
                                                    value="{{ $atStandard }}"
                                                    style="width:100%; border:none; background:transparent; text-align:center;">
                                            </td>
                                        </tr>

                                        <!-- Baris 2: T - T -->
                                        <tr>
                                            <td>T</td>
                                            <td colspan="2">
                                                <input type="text" name="unit01_t_{{ $formIndex }}_{{ $rowNumber }}_1"
                                                    value="{{ $unit01_t_1 }}"
                                                    style="width:100%; border:none; background:transparent; text-align:center;">
                                            </td>
                                            <td>T</td>
                                            <td colspan="2">
                                                <input type="text" name="unit02_t_{{ $formIndex }}_{{ $rowNumber }}_1"
                                                    value="{{ $unit02_t_1 }}"
                                                    style="width:100%; border:none; background:transparent; text-align:center;">
                                            </td>
                                        </tr>

                                        <!-- Baris 3: T - T -->
                                        <tr>
                                            <td>T</td>
                                            <td colspan="2">
                                                <input type="text" name="unit01_t_{{ $formIndex }}_{{ $rowNumber }}_2"
                                                    value="{{ $unit01_t_2 }}"
                                                    style="width:100%; border:none; background:transparent; text-align:center;">
                                            </td>
                                            <td>T</td>
                                            <td colspan="2">
                                                <input type="text" name="unit02_t_{{ $formIndex }}_{{ $rowNumber }}_2"
                                                    value="{{ $unit02_t_2 }}"
                                                    style="width:100%; border:none; background:transparent; text-align:center;">
                                            </td>
                                        </tr>

                                        <!-- Baris 4: S - S -->
                                        <tr>
                                            <td>S</td>
                                            <td colspan="2">
                                                <input type="text" name="unit01_s_{{ $formIndex }}_{{ $rowNumber }}_2"
                                                    value="{{ $unit01_s_2 }}"
                                                    style="width:100%; border:none; background:transparent; text-align:center;">
                                            </td>
                                            <td>S</td>
                                            <td colspan="2">
                                                <input type="text" name="unit02_s_{{ $formIndex }}_{{ $rowNumber }}_2"
                                                    value="{{ $unit02_s_2 }}"
                                                    style="width:100%; border:none; background:transparent; text-align:center;">
                                            </td>
                                        </tr>
                                        @endfor

                                        <!-- Jika data kurang dari 5, tampilkan baris kosong -->
                                        @if($maxData < 5)
                                            @for($i=$maxData; $i < 5; $i++)
                                            @php $rowNumber=$i + 1; @endphp
                                            <tr>
                                            <td rowspan="4">{{ $rowNumber }}</td>
                                            <td rowspan="4">
                                                <input type="text" name="massa_nominal_{{ $formIndex }}_{{ $rowNumber }}"
                                                    value=""
                                                    style="width:100%; border:none; background:transparent; text-align:center;">
                                            </td>
                                            <td>S</td>
                                            <td colspan="2">
                                                <input type="text" name="unit01_s_{{ $formIndex }}_{{ $rowNumber }}_1"
                                                    value=""
                                                    style="width:100%; border:none; background:transparent; text-align:center;">
                                            </td>
                                            <td>S</td>
                                            <td colspan="2">
                                                <input type="text" name="unit02_s_{{ $formIndex }}_{{ $rowNumber }}_1"
                                                    value=""
                                                    style="width:100%; border:none; background:transparent; text-align:center;">
                                            </td>
                                            <td rowspan="4">
                                                <input type="text" name="at_standard_{{ $formIndex }}_{{ $rowNumber }}"
                                                    value=""
                                                    style="width:100%; border:none; background:transparent; text-align:center;">
                                            </td>
                                            </tr>
                                            <tr>
                                                <td>T</td>
                                                <td colspan="2">
                                                    <input type="text" name="unit01_t_{{ $formIndex }}_{{ $rowNumber }}_1"
                                                        value=""
                                                        style="width:100%; border:none; background:transparent; text-align:center;">
                                                </td>
                                                <td>T</td>
                                                <td colspan="2">
                                                    <input type="text" name="unit02_t_{{ $formIndex }}_{{ $rowNumber }}_1"
                                                        value=""
                                                        style="width:100%; border:none; background:transparent; text-align:center;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>T</td>
                                                <td colspan="2">
                                                    <input type="text" name="unit01_t_{{ $formIndex }}_{{ $rowNumber }}_2"
                                                        value=""
                                                        style="width:100%; border:none; background:transparent; text-align:center;">
                                                </td>
                                                <td>T</td>
                                                <td colspan="2">
                                                    <input type="text" name="unit02_t_{{ $formIndex }}_{{ $rowNumber }}_2"
                                                        value=""
                                                        style="width:100%; border:none; background:transparent; text-align:center;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>S</td>
                                                <td colspan="2">
                                                    <input type="text" name="unit01_s_{{ $formIndex }}_{{ $rowNumber }}_2"
                                                        value=""
                                                        style="width:100%; border:none; background:transparent; text-align:center;">
                                                </td>
                                                <td>S</td>
                                                <td colspan="2">
                                                    <input type="text" name="unit02_s_{{ $formIndex }}_{{ $rowNumber }}_2"
                                                        value=""
                                                        style="width:100%; border:none; background:transparent; text-align:center;">
                                                </td>
                                            </tr>
                                            @endfor
                                            @endif
                                            @else
                                            <!-- Jika tidak ada data sama sekali -->
                                            @for($i = 1; $i <= 5; $i++)
                                                <tr>
                                                <td rowspan="4">{{ $i }}</td>
                                                <td rowspan="4">
                                                    <input type="text" name="massa_nominal_{{ $formIndex }}_{{ $i }}"
                                                        value=""
                                                        style="width:100%; border:none; background:transparent; text-align:center;">
                                                </td>
                                                <td>S</td>
                                                <td colspan="2">
                                                    <input type="text" name="unit01_s_{{ $formIndex }}_{{ $i }}_1"
                                                        value=""
                                                        style="width:100%; border:none; background:transparent; text-align:center;">
                                                </td>
                                                <td>S</td>
                                                <td colspan="2">
                                                    <input type="text" name="unit02_s_{{ $formIndex }}_{{ $i }}_1"
                                                        value=""
                                                        style="width:100%; border:none; background:transparent; text-align:center;">
                                                </td>
                                                <td rowspan="4">
                                                    <input type="text" name="at_standard_{{ $formIndex }}_{{ $i }}"
                                                        value=""
                                                        style="width:100%; border:none; background:transparent; text-align:center;">
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td>T</td>
                                                    <td colspan="2">
                                                        <input type="text" name="unit01_t_{{ $formIndex }}_{{ $i }}_1"
                                                            value=""
                                                            style="width:100%; border:none; background:transparent; text-align:center;">
                                                    </td>
                                                    <td>T</td>
                                                    <td colspan="2">
                                                        <input type="text" name="unit02_t_{{ $formIndex }}_{{ $i }}_1"
                                                            value=""
                                                            style="width:100%; border:none; background:transparent; text-align:center;">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>T</td>
                                                    <td colspan="2">
                                                        <input type="text" name="unit01_t_{{ $formIndex }}_{{ $i }}_2"
                                                            value=""
                                                            style="width:100%; border:none; background:transparent; text-align:center;">
                                                    </td>
                                                    <td>T</td>
                                                    <td colspan="2">
                                                        <input type="text" name="unit02_t_{{ $formIndex }}_{{ $i }}_2"
                                                            value=""
                                                            style="width:100%; border:none; background:transparent; text-align:center;">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>S</td>
                                                    <td colspan="2">
                                                        <input type="text" name="unit01_s_{{ $formIndex }}_{{ $i }}_2"
                                                            value=""
                                                            style="width:100%; border:none; background:transparent; text-align:center;">
                                                    </td>
                                                    <td>S</td>
                                                    <td colspan="2">
                                                        <input type="text" name="unit02_s_{{ $formIndex }}_{{ $i }}_2"
                                                            value=""
                                                            style="width:100%; border:none; background:transparent; text-align:center;">
                                                    </td>
                                                </tr>
                                                @endfor
                                                @endif

                                                <!-- KETERANGAN -->
                                                <tr>
                                                    <td colspan="9" class="left">
                                                        <strong>S</strong> : anak timbang (Standard)<br>
                                                        <strong>T</strong> : anak timbang (UUT)
                                                    </td>
                                                </tr>
                                </tbody>
                            </table>

                            <!-- FOOTER SECTION - ALAT STANDAR -->
                            <div style="height: 10px;"></div>

                            <table class="alat-standar-table" style="width:100%; border-collapse:collapse;">
                                <tr>
                                    <td colspan="6" style="border:1px solid #000; text-align:center; font-weight:bold;">
                                        Isilah lembar data kalibrasi dengan lengkap dan jelas!
                                    </td>
                                </tr>

                                <tr>
                                    <td rowspan="5" style="border:1px solid #000; width:20%; text-align:center; font-weight:bold; font-size:14px; vertical-align:middle;">
                                        Alat Standar
                                    </td>
                                    <td style="border:1px solid #000; width:5%; text-align:center;">
                                        <input type="checkbox" class="alat-standar-checkbox" name="alat_standar_{{ $formIndex }}[]"
                                            value="Timbangan digital (Rinstrum)" id="std1_{{ $formIndex }}"
                                            {{ in_array('Timbangan digital (Rinstrum)', $selectedStandards) ? 'checked' : '' }}>
                                    </td>
                                    <td colspan="3" style="border:1px solid #000; padding-left:12.1pt; font-size:8.5pt;">
                                        <label for="std1_{{ $formIndex }}" style="cursor:pointer;">Timbangan digital (Rinstrum)</label>
                                    </td>
                                    <td rowspan="5" style="border:1px solid #000; width:25%; text-align:center; vertical-align:middle;">
                                        Dikalibrasi<br>oleh
                                    </td>
                                    <td rowspan="5" style="border:1px solid #000; width:25%; text-align:center; vertical-align:middle;">
                                        Diperiksa<br>oleh
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border:1px solid #000; text-align:center;">
                                        <input type="checkbox" class="alat-standar-checkbox" name="alat_standar_{{ $formIndex }}[]"
                                            value="Timbangan digital 3100 g (AND)" id="std2_{{ $formIndex }}"
                                            {{ in_array('Timbangan digital 3100 g (AND)', $selectedStandards) ? 'checked' : '' }}>
                                    </td>
                                    <td colspan="3" style="border:1px solid #000; padding-left:12.1pt; font-size:8.5pt;">
                                        <label for="std2_{{ $formIndex }}" style="cursor:pointer;">Timbangan digital 3100 g (AND)</label>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border:1px solid #000; text-align:center;">
                                        <input type="checkbox" class="alat-standar-checkbox" name="alat_standar_{{ $formIndex }}[]"
                                            value="Timbangan digital 250 g (AND)" id="std3_{{ $formIndex }}"
                                            {{ in_array('Timbangan digital 250 g (AND)', $selectedStandards) ? 'checked' : '' }}>
                                    </td>
                                    <td colspan="3" style="border:1px solid #000; padding-left:12.1pt; font-size:8.5pt;">
                                        <label for="std3_{{ $formIndex }}" style="cursor:pointer;">Timbangan digital 250 g (AND)</label>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border:1px solid #000; text-align:center;">
                                        <input type="checkbox" class="alat-standar-checkbox" name="alat_standar_{{ $formIndex }}[]"
                                            value="Timbangan digital (BEL)" id="std4_{{ $formIndex }}"
                                            {{ in_array('Timbangan digital (BEL)', $selectedStandards) ? 'checked' : '' }}>
                                    </td>
                                    <td colspan="3" style="border:1px solid #000; padding-left:12.1pt; font-size:8.5pt;">
                                        <label for="std4_{{ $formIndex }}" style="cursor:pointer;">Timbangan digital (BEL)</label>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border:1px solid #000; text-align:center;">
                                        <input type="checkbox" class="alat-standar-checkbox" name="alat_standar_{{ $formIndex }}[]"
                                            value="Timbangan digital (Radwag)" id="std5_{{ $formIndex }}"
                                            {{ in_array('Timbangan digital (Radwag)', $selectedStandards) ? 'checked' : '' }}>
                                    </td>
                                    <td colspan="3" style="border:1px solid #000; padding-left:12.1pt; font-size:8.5pt;">
                                        <label for="std5_{{ $formIndex }}" style="cursor:pointer;">Timbangan digital (Radwag)</label>
                                    </td>
                                </tr>

                                <!-- METODE KALIBRASI + TTD -->
                                <tr>
                                    <td style="border:1px solid #000; font-weight:bold; text-align:center; vertical-align:middle;">
                                        Metode Kalibrasi
                                    </td>
                                    <td colspan="4" style="border:1px solid #000; padding-left:12.1pt; font-size:8.5pt;">
                                        PAS-IK1102-16
                                    </td>
                                    <td style="border:1px solid #000; vertical-align:top;">
                                        TTD:<br><br>
                                        <input type="text" name="calibratedBy_{{ $formIndex }}"
                                            value="{{ old('calibratedBy_' . $formIndex, $calibration->calibratedBy ?? '') }}"
                                            style="width:95%; font-size:12pt; border:none; border-bottom:1px solid #000; background:transparent;">
                                    </td>
                                    <td style="border:1px solid #000; vertical-align:top;">
                                        TTD:<br><br>
                                        <input type="text" name="verifiedBy_{{ $formIndex }}"
                                            value="{{ old('verifiedBy_' . $formIndex, $verifiedByValue) }}"
                                            style="width:95%; font-size:12pt; border:none; border-bottom:1px solid #000; background:transparent;">
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
                        <a href="{{ route('calibrations.show', $calibration->id) }}" class="btn btn-secondary btn-lg" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
                            <i class="fas fa-times me-2"></i>Batal
                        </a>

                        <button type="submit" class="btn btn-success btn-lg ms-3" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>

                        <input type="hidden" name="jumlah_form" value="{{ $jumlahForm }}">
                        <input type="hidden" name="form_type" value="anak_timbangan">
                    </div>
                </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('editForm')?.addEventListener('submit', function(e) {
            console.log('ðŸŽ¯ Edit form submission started...');

            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan Perubahan...';
                submitBtn.disabled = true;

                setTimeout(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 30000);
            }

            return true;
        });

        document.addEventListener('DOMContentLoaded', function() {
            console.log('ðŸ“„ Edit form loaded for Anak Timbangan ID:', {
                {
                    $calibration - > id
                }
            });
            console.log('ðŸ“Š Jumlah Form:', {
                {
                    $jumlahForm
                }
            });

            @for($formIndex = 1; $formIndex <= $jumlahForm; $formIndex++)
            @php
            $head = $allHeads - > where('form_index', $formIndex) - > first();
            $tempDetails = $details - > where('form_index', $formIndex);
            if ($tempDetails - > isEmpty() && $formIndex == 1) {
                $tempDetails = $details - > whereNull('form_index');
            }
            $detailCount = $tempDetails - > count();
            @endphp
            console.log('ðŸ“‹ Form {{ $formIndex }} - Head Data:', {
                certificate_id: '{{ $head->certificate_id ?? '
                N / A ' }}',
                standard: '{{ addslashes($head->standard ?? '
                ') }}',
                satuan_unit01: '{{ $head->satuan_unit01 ?? '
                ' }}',
                satuan_unit02: '{{ $head->satuan_unit02 ?? '
                ' }}',
                details_count: '{{ $detailCount }}'
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
            if (confirm(`Menambahkan form menjadi ${jumlahBaru} form. Lanjutkan?`)) {
                currentJumlahForm = jumlahBaru;
                updateFormCounter();
                reloadPageWithFormCount(currentJumlahForm);
            }
        }

        function kurangiForm() {
            if (currentJumlahForm <= MIN_FORM) {
                alert('Minimal harus ada 1 form.');
                return;
            }

            if (confirm(`Apakah Anda yakin ingin menghapus form ke-${currentJumlahForm}? Data pada form tersebut akan dihapus.`)) {
                currentJumlahForm--;
                updateFormCounter();
                reloadPageWithFormCount(currentJumlahForm);
            }
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
                alert(`Jumlah form minimal ${MIN_FORM}.`);
                document.getElementById('jumlah_form_input').value = currentJumlahForm;
                return;
            }
            if (val === currentJumlahForm) {
                alert('Jumlah form sudah sesuai dengan yang dipilih.');
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