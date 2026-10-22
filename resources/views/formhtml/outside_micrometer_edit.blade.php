<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kalibrasi Outside Micrometer - PT. PANANJUNG ANUGRAH SOLUTION</title>
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

        /* Styling khusus untuk checkbox alat standar */
        .alat-standar-checkbox {
            width: 18px;
            height: 18px;
            margin: 0;
            cursor: pointer;
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

        .required-field::after {
            content: " *";
            color: #dc3545;
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

            // Ambil semua data add & head per form_index
            $allAdds = ($calibration->relationLoaded('addOutsideMicrometers') && $calibration->addOutsideMicrometers->isNotEmpty()
            ? $calibration->addOutsideMicrometers
            : \App\Models\AddOutsideMicrometer::where('calibration_id', $calibration->id)->get()
            )->keyBy('form_index');

            $allHeads = ($calibration->relationLoaded('headOutsideMicrometers') && $calibration->headOutsideMicrometers->isNotEmpty()
            ? $calibration->headOutsideMicrometers
            : \App\Models\HeadOutsideMicrometer::where('calibration_id', $calibration->id)->get()
            )->keyBy('form_index');

            $allDetails = $calibration->detailOutsideMicrometers ?? \App\Models\DetailOutsideMicrometer::where('calibration_id', $calibration->id)->orderBy('id', 'asc')->get();

            // 🔥 FUNGSI BANTU UNTUK PARSING ALAT STANDAR
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
                // Ambil head & addData sesuai form_index saat ini
                $head=$allHeads->get($formIndex) ?? $calibration->{'headOutsideMicrometerForm' . $formIndex} ?? ($formIndex == 1 ? $calibration->headOutsideMicrometer : null);
                $addData = $allAdds->get($formIndex) ?? $calibration->{'addOutsideMicrometerForm' . $formIndex} ?? ($formIndex == 1 ? $calibration->addOutsideMicrometer : null);
                $formDetails = $allDetails->where('form_index', $formIndex)->sortBy('id');
                $isFirstForm = ($formIndex == 1);
                $rentangUkurMin = $head->rentang_ukur_min ?? '0';
                $rentangUkurMax = $head->rentang_ukur_max ?? '';
                $kapasitas = $head->kapasitas ?? '';
                $resolusi = $head->resolusi ?? '';
                $standardValue = $head->standard ?? '';
                $selectedStandards = getAlatStandarArrayForEdit($standardValue);

                // Data form pertama untuk fallback
                $form1Head = $allHeads->get(1) ?? $calibration->headOutsideMicrometerForm1;
                $form1AddData = $allAdds->get(1) ?? $calibration->addOutsideMicrometerForm1;
                @endphp

                @if($jumlahForm > 1)
                <div class="card mb-4" style="border: 2px solid #3b82f6; border-radius: 8px;">
                    <div class="card-header" style="background: linear-gradient(135deg, #1e40af, #3b82f6); color: white;">
                        <i class="fas fa-file-alt me-2"></i>Outside Micrometer ke-{{ $formIndex }}
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
                                        <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK02</p>
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
                                        <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">OUTSIDE MICROMETER</p>
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
                                        <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;">{{ $head->certificate_id ?? $form1Head->certificate_id ?? 'N/A' }}</p>
                                    </td>
                                </tr>
                            </table>

                            <!-- Main Form Section -->
                            <table class="kalibrasi-main-table">
                                <!-- Nama Alat -->
                                <tr>
                                    <td style="width: 20%;">
                                        <p class="required-field" style="margin:0; color:#000;">Nama Alat</p>
                                    </td>
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
                                    <td>
                                        <p class="required-field" style="margin:0; color:#000;">Merek</p>
                                    </td>
                                    <td colspan="3">
                                        <div class="d-flex align-items-center">
                                            @if($isFirstForm)
                                            <input type="text" class="kalibrasi-input me-3" name="brandAlat" value="{{ old('brandAlat', $calibration->brandAlat) }}" style="width:60%;">
                                            <span class="me-3" style="color:#000;">Kode Alat :</span>
                                            <input type="text" class="kalibrasi-input" name="kodeAlat" value="{{ old('kodeAlat', $calibration->kodeAlat) }}" style="width:30%;">
                                            @else
                                            <input type="text" class="kalibrasi-input me-3" value="{{ $calibration->brandAlat }}" readonly disabled style="width:60%;">
                                            <span class="me-3" style="color:#000;">Kode Alat :</span>
                                            <input type="text" class="kalibrasi-input" value="{{ $calibration->kodeAlat }}" readonly disabled style="width:30%;">
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <!-- Type / No. Seri -->
                                <tr>
                                    <td>
                                        <p class="required-field" style="margin:0; color:#000;">Type / No. Seri</p>
                                    </td>
                                    <td colspan="3">
                                        <div class="d-flex align-items-center">
                                            @if($isFirstForm)
                                            <input type="text" class="kalibrasi-input me-3" name="typeAlat" value="{{ old('typeAlat', $calibration->typeAlat) }}" style="width:45%;">
                                            <span class="me-3" style="color:#000;">/</span>
                                            <input type="text" class="kalibrasi-input" name="NoSeri" value="{{ old('NoSeri', $calibration->NoSeri) }}" style="width:45%;">
                                            @else
                                            <input type="text" class="kalibrasi-input me-3" value="{{ $calibration->typeAlat }}" readonly disabled style="width:45%;">
                                            <span class="me-3" style="color:#000;">/</span>
                                            <input type="text" class="kalibrasi-input" value="{{ $calibration->NoSeri }}" readonly disabled style="width:45%;">
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <!-- Kapasitas / Resolusi -->
                                <!-- ðŸ”¥ RENTANG UKUR - DIAMBIL DARI HEAD PER FORM -->
                                <!-- ðŸ”¥ RENTANG UKUR - DIAMBIL DARI HEAD PER FORM -->
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

                                <!-- ðŸ”¥ KAPASITAS / RESOLUSI - DIAMBIL DARI HEAD PER FORM -->
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
                                        <p class="required-field" style="margin:0; color:#000;">Nama Pemilik</p>
                                    </td>
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
                                    <td>
                                        <p class="required-field" style="margin:0; color:#000;">Tanggal Alat Masuk</p>
                                    </td>
                                    <td colspan="3">
                                        @if($isFirstForm)
                                        <input type="date" class="kalibrasi-input" name="tanggalMasuk" value="{{ old('tanggalMasuk', $calibration->tanggalMasuk ? \Carbon\Carbon::parse($calibration->tanggalMasuk)->format('Y-m-d') : '') }}">
                                        @else
                                        <input type="date" class="kalibrasi-input" value="{{ $calibration->tanggalMasuk ? \Carbon\Carbon::parse($calibration->tanggalMasuk)->format('Y-m-d') : '' }}" readonly disabled>
                                        @endif
                                    </td>
                                </tr>

                                <!-- Tanggal Kalibrasi + Jenis Pembacaan -->
                                <tr>
                                    <td>
                                        <p class="required-field" style="margin:0; color:#000;">Tanggal Kalibrasi</p>
                                    </td>
                                    <td colspan="3">
                                        <div class="d-flex align-items-center">
                                            @if($isFirstForm)
                                            <input type="date" class="kalibrasi-input me-3" name="tanggalKalibrasi" value="{{ old('tanggalKalibrasi', $calibration->tanggalKalibrasi ? \Carbon\Carbon::parse($calibration->tanggalKalibrasi)->format('Y-m-d') : '') }}" style="width:45%;">
                                            <span class="me-3" style="color:#000;">Jenis Pembacaan:</span>
                                            <input type="text" class="kalibrasi-input" name="jenisPembacaan" value="{{ old('jenisPembacaan', $calibration->jenisPembacaan) }}" style="width:45%;">
                                            @else
                                            <input type="date" class="kalibrasi-input me-3" value="{{ $calibration->tanggalKalibrasi ? \Carbon\Carbon::parse($calibration->tanggalKalibrasi)->format('Y-m-d') : '' }}" readonly disabled style="width:45%;">
                                            <span class="me-3" style="color:#000;">Jenis Pembacaan:</span>
                                            <input type="text" class="kalibrasi-input" value="{{ $calibration->jenisPembacaan }}" readonly disabled style="width:45%;">
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <!-- Tempat Kalibrasi -->
                                <tr>
                                    <td>
                                        <p style="margin:0; color:#000;">Tempat Kalibrasi</p>
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
                                    <td>
                                        <p style="margin:0; color:#000;">Lokasi PT</p>
                                    </td>
                                    <td colspan="3">
                                        @if($isFirstForm)
                                        <input type="text" class="kalibrasi-input" name="lokasiPT" value="{{ old('lokasiPT', $calibration->lokasiPT) }}">
                                        @else
                                        <input type="text" class="kalibrasi-input" value="{{ $calibration->lokasiPT }}" readonly disabled>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <p style="margin:0; color:#000;">TH</p>
                                    </td>
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
                                                style="width: 18px; height: 18px; display: block; margin: 0 auto;" disabled
                                                {{ $calibration->kondisiAlat == 'ok' ? 'checked' : '' }}>
                                        </div>
                                        <div class="text-center">
                                            <span class="fw-bold d-block mb-2" style="color: #000000; font-size: 14px;">Rusak</span>
                                            <input type="radio" value="rusak" class="form-check-input"
                                                style="width: 18px; height: 18px; display: block; margin: 0 auto;" disabled
                                                {{ $calibration->kondisiAlat == 'rusak' ? 'checked' : '' }}>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <span class="fw-bold me-3" style="color: #000000; min-width: 100px;">Keterangan :</span>
                                        <div style="flex: 1;">
                                            <input type="text" class="kalibrasi-input" value="{{ $calibration->keterangan ?? '-' }}"
                                                style="border: none; border-bottom: 2px solid #000; border-radius: 0; padding: 4px 0; background: #e9ecef; width: 100%;" readonly disabled>
                                        </div>
                                    </div>
                                    @endif
                                </div>

                                <div class="col-md-6 mb-4">
                                    <div class="kalibrasi-section-header" style="color: #000000;">Kondisi Kalibrasi</div>

                                    @if($isFirstForm)
                                    <table class="table table-bordered">
                                        <tr>
                                            <td class="table-secondary fw-bold" style="width: 30%; color: #000000;">&nbsp;</td>
                                            <td class="table-secondary fw-bold text-center" style="color: #000000;">Awal</td>
                                            <td class="table-secondary fw-bold text-center" style="color: #000000;">Tengah</td>
                                            <td class="table-secondary fw-bold text-center" style="color: #000000;">Akhir</td>
                                        </tr>
                                        <tr>
                                            <td class="bg-light fw-bold" style="color: #000000;">Suhu (&deg;C)</td>
                                            <td><input type="text" class="kondisi-input" name="RT_condition1" value="{{ old('RT_condition1', $calibration->RT_condition1 ?? '') }}"></td>
                                            <td><input type="text" class="kondisi-input" name="RT_condition2" value="{{ old('RT_condition2', $calibration->RT_condition2 ?? '') }}"></td>
                                            <td><input type="text" class="kondisi-input" name="RT_condition3" value="{{ old('RT_condition3', $calibration->RT_condition3 ?? '') }}"></td>
                                        </tr>
                                        <tr>
                                            <td class="bg-light fw-bold" style="color: #000000;">RH (%)</td>
                                            <td><input type="text" class="kondisi-input" name="RH_condition1" value="{{ old('RH_condition1', $calibration->RH_condition1 ?? '') }}"></td>
                                            <td><input type="text" class="kondisi-input" name="RH_condition2" value="{{ old('RH_condition2', $calibration->RH_condition2 ?? '') }}"></td>
                                            <td><input type="text" class="kondisi-input" name="RH_condition3" value="{{ old('RH_condition3', $calibration->RH_condition3 ?? '') }}"></td>
                                        </tr>
                                    </table>
                                    @else
                                    <table class="table table-bordered">
                                        <tr>
                                            <td class="table-secondary fw-bold" style="width: 30%; color: #000000;">&nbsp;</td>
                                            <td class="table-secondary fw-bold text-center" style="color: #000000;">Awal</td>
                                            <td class="table-secondary fw-bold text-center" style="color: #000000;">Tengah</td>
                                            <td class="table-secondary fw-bold text-center" style="color: #000000;">Akhir</td>
                                        </tr>
                                        <tr>
                                            <td class="bg-light fw-bold" style="color: #000000;">Suhu (&deg;C)</td>
                                            <td><input type="text" class="kondisi-input" value="{{ $calibration->RT_condition1 ?? '' }}" readonly disabled style="background-color: #e9ecef;"></td>
                                            <td><input type="text" class="kondisi-input" value="{{ $calibration->RT_condition2 ?? '' }}" readonly disabled style="background-color: #e9ecef;"></td>
                                            <td><input type="text" class="kondisi-input" value="{{ $calibration->RT_condition3 ?? '' }}" readonly disabled style="background-color: #e9ecef;"></td>
                                        </tr>
                                        <tr>
                                            <td class="bg-light fw-bold" style="color: #000000;">RH (%)</td>
                                            <td><input type="text" class="kondisi-input" value="{{ $calibration->RH_condition1 ?? '' }}" readonly disabled style="background-color: #e9ecef;"></td>
                                            <td><input type="text" class="kondisi-input" value="{{ $calibration->RH_condition2 ?? '' }}" readonly disabled style="background-color: #e9ecef;"></td>
                                            <td><input type="text" class="kondisi-input" value="{{ $calibration->RH_condition3 ?? '' }}" readonly disabled style="background-color: #e9ecef;"></td>
                                        </tr>
                                    </table>
                                    @endif
                                </div>
                            </div>

                            <!-- UJI KERATAAN (FLATNESS TEST) -->
                            <div class="data-kalibrasi-header" style="color: #000000;">DATA KALIBRASI</div>
                            <table class="table table-bordered" style="width: 100%; border: 2px solid #000;">
                                <tr>
                                    <td colspan="4" style="border: 2px solid #000; background-color: #f0f0f0; text-align: center; padding: 8px;">
                                        <strong>Uji Kerataan</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="border: 2px solid #000; background-color: #e8e8e8; text-align: center; padding: 6px;">
                                        <strong>Anvil</strong>
                                    </td>
                                    <td colspan="2" style="border: 2px solid #000; background-color: #e8e8e8; text-align: center; padding: 6px;">
                                        <strong>Spindle</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: 2px solid #000; background-color: #d9d9d9; text-align: center; padding: 6px; width: 25%;">
                                        <strong>Ukuran Optical Flat</strong>
                                    </td>
                                    <td style="border: 2px solid #000; background-color: #d9d9d9; text-align: center; padding: 6px; width: 25%;">
                                        <strong>Jumlah Frinji</strong>
                                    </td>
                                    <td style="border: 2px solid #000; background-color: #d9d9d9; text-align: center; padding: 6px; width: 25%;">
                                        <strong>Ukuran Optical Flat</strong>
                                    </td>
                                    <td style="border: 2px solid #000; background-color: #d9d9d9; text-align: center; padding: 6px; width: 25%;">
                                        <strong>Jumlah Frinji</strong>
                                    </td>
                                </tr>

                                <!-- Baris 1 - Anvil 1 dan Spindle 1 -->
                                <tr>
                                    <td style="border: 2px solid #000; padding: 0;">
                                        <div class="d-flex align-items-center justify-content-center" style="padding: 8px;">
                                            <input type="text" name="ukuranAnvil1_{{ $formIndex }}" value="{{ old('ukuranAnvil1_' . $formIndex, $addData->ukuranAnvil1 ?? '') }}" step="0.01"
                                                style="width: 80px; border: none; background: transparent; text-align: center;">
                                            <span style="margin-left: 8px;">mm</span>
                                        </div>
                                    </td>
                                    <td style="border: 2px solid #000; padding: 0;">
                                        <div class="text-center" style="padding: 8px;">
                                            <input type="text" name="jumlahAnvil1_{{ $formIndex }}" value="{{ old('jumlahAnvil1_' . $formIndex, $addData->jumlahAnvil1 ?? '') }}" step="1"
                                                style="width: 100%; border: none; background: transparent; text-align: center;">
                                        </div>
                                    </td>
                                    <td style="border: 2px solid #000; padding: 0;">
                                        <div class="d-flex align-items-center justify-content-center" style="padding: 8px;">
                                            <input type="text" name="ukuranSpindle1_{{ $formIndex }}" value="{{ old('ukuranSpindle1_' . $formIndex, $addData->ukuranSpindle1 ?? '') }}" step="0.01"
                                                style="width: 80px; border: none; background: transparent; text-align: center;">
                                            <span style="margin-left: 8px;">mm</span>
                                        </div>
                                    </td>
                                    <td style="border: 2px solid #000; padding: 0;">
                                        <div class="text-center" style="padding: 8px;">
                                            <input type="text" name="jumlahSpindle1_{{ $formIndex }}" value="{{ old('jumlahSpindle1_' . $formIndex, $addData->jumlahSpindle1 ?? '') }}" step="1"
                                                style="width: 100%; border: none; background: transparent; text-align: center;">
                                        </div>
                                    </td>
                                </tr>

                                <!-- Baris 2 - Anvil 2 dan Spindle 2 -->
                                @php
                                // Baris 2 harus kosong jika merupakan duplikat dari Baris 1 atau tidak ada data pengukuran ke-2
                                $isBaris2Duplicate = (
                                $addData &&
                                !empty($addData->ukuranAnvil1) &&
                                ($addData->ukuranAnvil2 == $addData->ukuranAnvil1) &&
                                ($addData->jumlahAnvil2 == $addData->jumlahAnvil1) &&
                                ($addData->ukuranSpindle2 == $addData->ukuranSpindle1) &&
                                ($addData->jumlahSpindle2 == $addData->jumlahSpindle1)
                                );

                                $valUkuranAnvil2 = (!$isBaris2Duplicate && $addData) ? ($addData->ukuranAnvil2 ?? '') : '';
                                $valJumlahAnvil2 = (!$isBaris2Duplicate && $addData) ? ($addData->jumlahAnvil2 ?? '') : '';
                                $valUkuranSpindle2 = (!$isBaris2Duplicate && $addData) ? ($addData->ukuranSpindle2 ?? '') : '';
                                $valJumlahSpindle2 = (!$isBaris2Duplicate && $addData) ? ($addData->jumlahSpindle2 ?? '') : '';
                                @endphp
                                <tr>
                                    <td style="border: 2px solid #000; padding: 0;">
                                        <div class="d-flex align-items-center justify-content-center" style="padding: 8px;">
                                            <input type="text" name="ukuranAnvil2_{{ $formIndex }}" value="{{ old('ukuranAnvil2_' . $formIndex, $valUkuranAnvil2) }}" step="0.01"
                                                style="width: 80px; border: none; background: transparent; text-align: center;">
                                            <span style="margin-left: 8px;">mm</span>
                                        </div>
                                    </td>
                                    <td style="border: 2px solid #000; padding: 0;">
                                        <div class="text-center" style="padding: 8px;">
                                            <input type="text" name="jumlahAnvil2_{{ $formIndex }}" value="{{ old('jumlahAnvil2_' . $formIndex, $valJumlahAnvil2) }}" step="1"
                                                style="width: 100%; border: none; background: transparent; text-align: center;">
                                        </div>
                                    </td>
                                    <td style="border: 2px solid #000; padding: 0;">
                                        <div class="d-flex align-items-center justify-content-center" style="padding: 8px;">
                                            <input type="text" name="ukuranSpindle2_{{ $formIndex }}" value="{{ old('ukuranSpindle2_' . $formIndex, $valUkuranSpindle2) }}" step="0.01"
                                                style="width: 80px; border: none; background: transparent; text-align: center;">
                                            <span style="margin-left: 8px;">mm</span>
                                        </div>
                                    </td>
                                    <td style="border: 2px solid #000; padding: 0;">
                                        <div class="text-center" style="padding: 8px;">
                                            <input type="text" name="jumlahSpindle2_{{ $formIndex }}" value="{{ old('jumlahSpindle2_' . $formIndex, $valJumlahSpindle2) }}" step="1"
                                                style="width: 100%; border: none; background: transparent; text-align: center;">
                                        </div>
                                    </td>
                                </tr>

                            </table>



                            <div class="mb-3">
                                <span style="font-size: 16px; font-weight: bold; color: #000000;">Uji Skala Nominal</span>
                            </div>

                            <table class="kalibrasi-data-table">
                                <tr style="background: #d9d9d9;">
                                    <td style="width: 20%;"><span style="font-weight: bold; color: #000000;">Nilai Nominal</span></td>
                                    <td colspan="5"><span style="font-weight: bold; color: #000000;">Penunjukan Alat</span></td>
                                </tr>
                                <tr style="background: #e8e8e8;">
                                    <td style="vertical-align: middle;">
                                        <div style="display: flex; align-items: center; justify-content: center;">
                                            <span style="font-weight: bold; color: #000000; margin-right: 5px;">Unit (</span>
                                            <input type="text" name="satuan_unit_{{ $formIndex }}" value="{{ old('satuan_unit_' . $formIndex, $head->satuan_unit ?? 'mm') }}"
                                                style="width: 80px; padding: 5px; border: 1px solid #ccc; border-radius: 3px; text-align: center;">
                                            <span style="font-weight: bold; color: #000000; margin-left: 5px;">)</span>
                                        </div>
                                    </td>
                                    <td style="width: 16%;"><span style="font-weight: bold; color: #000000;">1</span></td>
                                    <td style="width: 16%;"><span style="font-weight: bold; color: #000000;">2</span></td>
                                    <td style="width: 16%;"><span style="font-weight: bold; color: #000000;">3</span></td>
                                    <td style="width: 16%;"><span style="font-weight: bold; color: #000000;">4</span></td>
                                    <td style="width: 16%;"><span style="font-weight: bold; color: #000000;">5</span></td>
                                </tr>

                                @php
                                $detailArray = [];
                                foreach ($formDetails as $detail) {
                                $detailArray[] = $detail;
                                }
                                $defaultNominal = ['0.00', '0.10', '0.20', '0.30', '0.40', '0.50', '0.60', '0.70', '0.80', '0.90', '1.00', '2.00', '3.00', '4.00'];
                                @endphp

                                @for($i = 0; $i < 14; $i++)
                                    @php
                                    $detail=$detailArray[$i] ?? null;
                                    $detailId=$detail->id ?? null;

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
                                            <input type="text" name="titikUkur_{{ $formIndex }}[]" value="{{ $titikUkur }}"
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


                            <!-- ðŸ”¥ ALAT STANDAR UNTUK FORM INI - SEMUA FORM BISA DIEDIT -->
                            <table class="alat-standar-table">
                                <tr>
                                    <td rowspan="5" style="width:20%; text-align:center; font-weight:bold; font-size:14px;">Alat Standar</td>
                                    <td style="width:24.75pt; text-align:center;">
                                        <input type="checkbox" class="alat-standar-checkbox" name="alat_standar_{{ $formIndex }}[]" value="Gauge Block (150mm) D.007" id="alat1_{{ $formIndex }}"
                                            {{ in_array('Gauge Block (150mm) D.007', $selectedStandards) ? 'checked' : '' }}>
                                    </td>
                                    <td colspan="2"><label for="alat1_{{ $formIndex }}">Gauge Block (150mm) D.007</label></td>
                                    <td rowspan="5" style="width:111.15pt; text-align:center;">Dikalibrasi<br>oleh</td>
                                    <td rowspan="5" style="width:98.3pt; text-align:center;">Diperiksa<br>oleh</td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;">
                                        <input type="checkbox" class="alat-standar-checkbox" name="alat_standar_{{ $formIndex }}[]" value="Gauge Block (300mm) D.008" id="alat2_{{ $formIndex }}"
                                            {{ in_array('Gauge Block (300mm) D.008', $selectedStandards) ? 'checked' : '' }}>
                                    </td>
                                    <td colspan="2"><label for="alat2_{{ $formIndex }}">Gauge Block (300mm) D.008</label></td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;">
                                        <input type="checkbox" class="alat-standar-checkbox" name="alat_standar_{{ $formIndex }}[]" value="Gauge Block (300mm) D.009" id="alat3_{{ $formIndex }}"
                                            {{ in_array('Gauge Block (300mm) D.009', $selectedStandards) ? 'checked' : '' }}>
                                    </td>
                                    <td colspan="2"><label for="alat3_{{ $formIndex }}">Gauge Block (300mm) D.009</label></td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;">
                                        <input type="checkbox" class="alat-standar-checkbox" name="alat_standar_{{ $formIndex }}[]" value="Gauge Block Set Grade 0.5 ~ 100 mm 0 D.012" id="alat4_{{ $formIndex }}"
                                            {{ in_array('Gauge Block Set Grade 0.5 ~ 100 mm 0 D.012', $selectedStandards) ? 'checked' : '' }}>
                                    </td>
                                    <td colspan="2"><label for="alat4_{{ $formIndex }}">Gauge Block Set Grade 0.5 ~ 100 mm 0 D.012</label></td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;">
                                        <input type="checkbox" class="alat-standar-checkbox" name="alat_standar_{{ $formIndex }}[]" value="Gauge Block Set Grade 2.5 ~ 25 mm 0 D.013" id="alat5_{{ $formIndex }}"
                                            {{ in_array('Gauge Block Set Grade 2.5 ~ 25 mm 0 D.013', $selectedStandards) ? 'checked' : '' }}>
                                    </td>
                                    <td colspan="2"><label for="alat5_{{ $formIndex }}">Gauge Block Set Grade 2.5 ~ 25 mm 0 D.013</label></td>
                                </tr>
                                <tr>
                                    <td style="font-weight:bold;">Metode Kalibrasi</td>
                                    <td colspan="3">PAS-IK1102-01 (JIS B 7502:2016 (JMA/JSA); SNSU PK.P-01:2020).</td>
                                    <td><input type="text" class="kalibrasi-input" name="calibratedBy" value="{{ old('calibratedBy', $calibration->calibratedBy ?? '') }}" style="border: none; width: 100%;" readonly></td>
                                    <td><input type="text" class="kalibrasi-input" name="verifiedBy" value="{{ old('verifiedBy', $calibration->verifiedBy ?? '') }}" style="border: none; width: 100%;"></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td colspan="3">&nbsp;</td>
                                    <td>TTD :</td>
                                    <td>TTD :</td>
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
                        <a href="{{ url()->previous() }}" class="btn btn-secondary btn-lg" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
                            <i class="fas fa-times me-2"></i>Batal
                        </a>

                        <button type="submit" class="btn btn-success btn-lg ms-3" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>

                        <input type="hidden" name="jumlah_form" value="{{ $jumlahForm }}">
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
            console.log('ðŸŽ¯ Edit form submission started...');

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
            console.log('ðŸ“„ Edit form loaded for Inside Micrometer ID:', {
                {
                    $calibration - > id
                }
            });

            @for($formIndex = 1; $formIndex <= $jumlahForm; $formIndex++)
            @php
            $head = $headsByForm[$formIndex] ?? null;
            @endphp
            console.log('ðŸ“‹ Form {{ $formIndex }} - Head Data:', {
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