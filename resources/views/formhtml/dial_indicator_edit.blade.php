<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kalibrasi - PT. PANANJUNG ANUGRAH SOLUTION</title>
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
    </style>
</head>

<body>
    <div class="container my-4">
        <form action="{{ route('calibrations.update', $calibration->id) }}" method="POST" id="editForm">
            @csrf
            @method('PUT')

            <div class="form-kalibrasi-container">
                <table class="kalibrasi-header-table">
                    <tr>
                        <td colspan="2">
                            <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK04</p>
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
                            <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">DIAL INDICATOR</p>
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
                            <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;">{{ $calibration->headDialIndicator->certificate_id ?? 'N/A' }}</p>
                        </td>
                    </tr>
                </table>

                <!-- Main Form Section - Editable -->
                <table class="kalibrasi-main-table">
                    <!-- Nama Alat -->
                    <tr>
                        <td style="width: 20%;">
                            <p style="margin: 0; color: #000000;" class="required-field">Nama Alat</p>
                        </td>
                        <td colspan="3">
                            <input type="text" class="kalibrasi-input" name="namaAlat" value="{{ old('namaAlat', $calibration->namaAlat) }}">
                        </td>
                    </tr>

                    <!-- Merek & Kode Alat -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;" class="required-field">Merek</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" class="kalibrasi-input me-3" name="brandAlat" value="{{ old('brandAlat', $calibration->brandAlat) }}" style="width: 60%;">
                                <span class="me-3" style="color: #000000;">Kode Alat :</span>
                                <input type="text" class="kalibrasi-input" name="kodeAlat" value="{{ old('kodeAlat', $calibration->kodeAlat) }}" style="width: 30%;">
                            </div>
                        </td>
                    </tr>

                    <!-- Type / No. Seri -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;" class="required-field">Type / No. Seri</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" class="kalibrasi-input me-3" name="typeAlat" value="{{ old('typeAlat', $calibration->typeAlat) }}" style="width: 45%;">
                                <span class="me-3" style="color: #000000;">/</span>
                                <input type="text" class="kalibrasi-input" name="NoSeri" value="{{ old('NoSeri', $calibration->NoSeri) }}" style="width: 45%;">
                            </div>
                        </td>
                    </tr>


                    <!-- Kapasitas / Resolusi -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Kapasitas / Resolusi</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" class="kalibrasi-input me-3" name="kapasitas" value="{{ old('kapasitas', $calibration->kapasitas) }}" style="width: 45%;">
                                <span class="me-3" style="color: #000000;">/</span>
                                <input type="text" class="kalibrasi-input" name="resolusi" value="{{ old('resolusi', $calibration->resolusi) }}" style="width: 45%;">
                            </div>
                        </td>
                    </tr>

                    <!-- Nama Pemilik -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;" class="required-field">Nama Pemilik</p>
                        </td>
                        <td colspan="3">
                            <input type="text" class="kalibrasi-input" name="pemilikAlat" value="{{ old('pemilikAlat', $calibration->pemilikAlat) }}">
                        </td>
                    </tr>

                    <!-- Tanggal -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;" class="required-field">Tanggal Alat Masuk</p>
                        </td>
                        <td colspan="3">
                            <input type="date" class="kalibrasi-input" name="tanggalMasuk"
                                value="{{ old('tanggalMasuk', \Carbon\Carbon::parse($calibration->tanggalMasuk)->format('Y-m-d')) }}">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;" class="required-field">Tanggal Kalibrasi</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="date" class="kalibrasi-input me-3" name="tanggalKalibrasi"
                                    value="{{ old('tanggalKalibrasi', \Carbon\Carbon::parse($calibration->tanggalKalibrasi)->format('Y-m-d')) }}"
                                    style="width: 45%;">
                                <span class="me-3" style="color: #000000;">Jenis Pembacaan:</span>
                                <input type="text" class="kalibrasi-input" name="jenisPembacaan"
                                    value="{{ old('jenisPembacaan', $calibration->jenisPembacaan) }}"
                                    style="width: 45%;">
                            </div>
                        </td>
                    </tr>

                    <!-- Tempat Kalibrasi -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Tempat Kalibrasi</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex">
                                <div class="form-check me-5">
                                    <input class="form-check-input" type="radio" name="tempatKalibrasi" value="lab.PT PAS" id="lab"
                                        {{ old('tempatKalibrasi', $calibration->tempatKalibrasi) == 'lab.PT PAS' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="lab" style="color: #000000;">Lab. PT.PAS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tempatKalibrasi" value="insitu" id="insitu"
                                        {{ old('tempatKalibrasi', $calibration->tempatKalibrasi) == 'insitu' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="insitu" style="color: #000000;">Insitu</label>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Lokasi PT</p>
                        </td>
                        <td colspan="3">
                            <input type="text" class="kalibrasi-input" name="lokasiPT" value="{{ old('lokasiPT', $calibration->lokasiPT) }}">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Kode TH</p>
                        </td>
                        <td colspan="3">
                            <input type="text" class="kalibrasi-input" name="kode_th" value="{{ old('kode_th', $calibration->kode_th) }}">
                        </td>
                    </tr>
                </table>

                <!-- Fungsi Komponen Lainnya & Kondisi Kalibrasi -->
                <div class="row mt-4">
                    <!-- Fungsi Komponen Lainnya -->
                    <div class="col-md-6 mb-4">
                        <div class="kalibrasi-section-header" style="color: #000000;">Fungsi Komponen Lainnya</div>

                        <!-- Radio Button Section - Text di atas, radio di bawah -->
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

                        <!-- Keterangan Section -->
                        <div class="d-flex align-items-center">
                            <span class="fw-bold me-3" style="color: #000000; min-width: 100px;">Keterangan :</span>
                            <div style="flex: 1;">
                                <input type="text" class="kalibrasi-input" name="keterangan" value="{{ old('keterangan', $calibration->keterangan ?? '-') }}"
                                    style="border: none; border-bottom: 2px solid #000; border-radius: 0; padding: 4px 0; background: transparent; width: 100%;">
                            </div>
                        </div>
                    </div>

                    <!-- Kondisi Kalibrasi -->
                    <div class="col-md-6 mb-4">
                        <div class="kalibrasi-section-header" style="color: #000000;">Kondisi Kalibrasi</div>

                        <table class="table table-bordered">
                            <tr>
                                <td class="table-secondary fw-bold" style="width: 30%; color: #000000;"></td>
                                <td class="table-secondary fw-bold text-center" style="color: #000000;">Awal</td>
                                <td class="table-secondary fw-bold text-center" style="color: #000000;">Tengah</td>
                                <td class="table-secondary fw-bold text-center" style="color: #000000;">Akhir</td>
                            </tr>
                            <tr>
                                <td class="bg-light fw-bold" style="color: #000000;">Suhu (°C)</td>
                                <td><input type="number" class="kondisi-input" name="RT_condition1" value="{{ old('RT_condition1', $calibration->RT_condition1 ?? '-') }}" step="0.1"></td>
                                <td><input type="number" class="kondisi-input" name="RT_condition2" value="{{ old('RT_condition2', $calibration->RT_condition2 ?? '-') }}" step="0.1"></td>
                                <td><input type="number" class="kondisi-input" name="RT_condition3" value="{{ old('RT_condition3', $calibration->RT_condition3 ?? '-') }}" step="0.1"></td>
                            </tr>
                            <tr>
                                <td class="bg-light fw-bold" style="color: #000000;">RH (%)</td>
                                <td><input type="number" class="kondisi-input" name="RH_condition1" value="{{ old('RH_condition1', $calibration->RH_condition1 ?? '-') }}" step="0.1"></td>
                                <td><input type="number" class="kondisi-input" name="RH_condition2" value="{{ old('RH_condition2', $calibration->RH_condition2 ?? '-') }}" step="0.1"></td>
                                <td><input type="number" class="kondisi-input" name="RH_condition3" value="{{ old('RH_condition3', $calibration->RH_condition3 ?? '-') }}" step="0.1"></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Data Kalibrasi Section -->
                <div class="data-kalibrasi-header" style="color: #000000;">DATA KALIBRASI</div>

                <div class="d-flex justify-content-between gap-4">
                    @php
                    $is001 = ($calibration->resolusi ?? '') === '0.001';
                    $detailData = $calibration->detailDialIndicators ?? collect();

                    // Pisahkan data berdasarkan index
                    $dataKiri = [];
                    $dataKanan = [];

                    foreach ($detailData as $index => $detail) {
                    if ($index < 20) {
                        $dataKiri[]=$detail;
                        } else {
                        $dataKanan[]=$detail;
                        }
                        }

                        // Untuk memastikan ada cukup baris, tambahkan data kosong jika kurang
                        while (count($dataKiri) < 20) {
                        $dataKiri[]=null;
                        }
                        while (count($dataKanan) < 19) {
                        $dataKanan[]=null;
                        }
                        @endphp

                        <!-- Tabel Kiri -->
                        <div style="flex:1;">
                            <table class="kalibrasi-data-table">
                                <tr style="background:#d9d9d9;">
                                    <td style="border:2px solid #000;padding:8px;text-align:center;width:40%;">
                                        <strong>Penunjukan Alat (mm)</strong>
                                    </td>
                                    <td colspan="2" style="border:2px solid #000;padding:8px;text-align:center;width:60%;">
                                        <strong>Pembacaan Standard (mm)</strong>
                                    </td>
                                </tr>
                                <tr style="background:#e8e8e8;">
                                    <td style="border:2px solid #000;padding:8px;text-align:center;">
                                        <div style="position:relative;display:inline-block;width:100px;">
                                            <span style="position:absolute;left:10px;top:50%;transform:translateY(-50%);font-size:11pt;">(</span>
                                            @php
                                            $satuanKiriEdit = old('satuan_alat_kiri',
                                            $calibration->headDialIndicator->satuan_alat_kiri ??
                                            $calibration->headDialIndicator->satuan_alat ??
                                            $calibration->satuan_alat_kiri ??
                                            $calibration->satuan_penunjukan_alat ??
                                            ''
                                            );
                                            @endphp
                                            <input type="text"
                                                name="satuan_alat_kiri"
                                                value="{{ $satuanKiriEdit }}"
                                                style="width: 80px; 
                                      text-align: center; 
                                      border: none;
                                      border-bottom: 1px dashed #666;
                                      background: transparent;
                                      font-size: 11pt;
                                      font-weight: normal;
                                      padding: 2px 20px;"
                                                maxlength="5">
                                            <span style="position:absolute;right:10px;top:50%;transform:translateY(-50%);font-size:11pt;">)</span>
                                        </div>
                                    </td>
                                    <td style="border:2px solid #000;padding:8px;text-align:center;">
                                        <strong>Naik</strong>
                                    </td>
                                    <td style="border:2px solid #000;padding:8px;text-align:center;">
                                        <strong>Turun</strong>
                                    </td>
                                </tr>

                                @foreach($dataKiri as $index => $detail)
                                <tr>
                                    <td style="height:32px; background-color:#f8f9fa;">
                                        <!-- PERBAIKAN: name berbeda untuk kiri -->
                                        <input type="number" step="any"
                                            name="titikUkur_kiri[]"
                                            value="{{ $detail->titikUkur ?? '' }}"
                                            style="width:100%;height:100%;border:none;text-align:center;background:transparent;font-weight:bold;">
                                    </td>
                                    <td style="height:32px;">
                                        <!-- PERBAIKAN: name berbeda untuk kiri -->
                                        <input type="number" step="any"
                                            name="ulanganNaik_kiri[]"
                                            value="{{ $detail->ulanganNaik ?? '' }}"
                                            style="width:100%;height:100%;border:none;text-align:center;background:transparent;">
                                    </td>
                                    <td style="height:32px;">
                                        <!-- PERBAIKAN: name berbeda untuk kiri -->
                                        <input type="number" step="any"
                                            name="ulanganTurun_kiri[]"
                                            value="{{ $detail->ulanganTurun ?? '' }}"
                                            style="width:100%;height:100%;border:none;text-align:center;background:transparent;">
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>

                        <!-- Tabel Kanan -->
                        <div style="flex:1;">
                            <table class="kalibrasi-data-table">
                                <tr style="background:#d9d9d9;">
                                    <td style="border:2px solid #000;padding:8px;text-align:center;width:40%;">
                                        <strong>Penunjukan Alat</strong>
                                    </td>
                                    <td colspan="2" style="border:2px solid #000;padding:8px;text-align:center;width:60%;">
                                        <strong>Pembacaan Standard</strong>
                                    </td>
                                </tr>
                                <tr style="background:#e8e8e8;">
                                    <td style="border:2px solid #000;padding:8px;text-align:center;">
                                        <div style="position:relative;display:inline-block;width:100px;">
                                            <span style="position:absolute;left:10px;top:50%;transform:translateY(-50%);font-size:11pt;">(</span>
                                            @php
                                            $satuanKananEdit = old('satuan_alat_kanan',
                                            $calibration->headDialIndicator->satuan_alat_kanan ??
                                            $calibration->headDialIndicator->satuan_alat ??
                                            $calibration->satuan_alat_kanan ??
                                            ' '
                                            );
                                            @endphp
                                            <input type="text"
                                                name="satuan_alat_kanan"
                                                value="{{ $satuanKananEdit }}"
                                                style="width: 80px; 
                                      text-align: center; 
                                      border: none;
                                      border-bottom: 1px dashed #666;
                                      background: transparent;
                                      font-size: 11pt;
                                      font-weight: normal;
                                      padding: 2px 20px;"
                                                maxlength="5">
                                            <span style="position:absolute;right:10px;top:50%;transform:translateY(-50%);font-size:11pt;">)</span>
                                        </div>
                                    </td>
                                    <td style="border:2px solid #000;padding:8px;text-align:center;">
                                        <strong>Naik</strong>
                                    </td>
                                    <td style="border:2px solid #000;padding:8px;text-align:center;">
                                        <strong>Turun</strong>
                                    </td>
                                </tr>

                                @foreach($dataKanan as $index => $detail)
                                <tr>
                                    <td style="height:32px; background-color:#f8f9fa;">
                                        <!-- PERBAIKAN: name berbeda untuk kanan -->
                                        <input type="number" step="any"
                                            name="titikUkur_kanan[]"
                                            value="{{ $detail->titikUkur ?? '' }}"
                                            style="width:100%;height:100%;border:none;text-align:center;background:transparent;font-weight:bold;">
                                    </td>
                                    <td style="height:32px;">
                                        <!-- PERBAIKAN: name berbeda untuk kanan -->
                                        <input type="number" step="any"
                                            name="ulanganNaik_kanan[]"
                                            value="{{ $detail->ulanganNaik ?? '' }}"
                                            style="width:100%;height:100%;border:none;text-align:center;background:transparent;">
                                    </td>
                                    <td style="height:32px;">
                                        <!-- PERBAIKAN: name berbeda untuk kanan -->
                                        <input type="number" step="any"
                                            name="ulanganTurun_kanan[]"
                                            value="{{ $detail->ulanganTurun ?? '' }}"
                                            style="width:100%;height:100%;border:none;text-align:center;background:transparent;">
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                </div>


                <!-- Repeatability Section -->
                <p class="medium-text" style="margin-top:5.1pt; margin-left:10.2pt; margin-bottom:1.05pt; font-size: 10pt;">
                    <span class="letter-spacing-neg-01">Repeatability</span>
                    <span class="letter-spacing-06"></span>
                    <span class="letter-spacing-neg-05">:</span>
                    <span style="margin-left:10px;">
                        <input type="text" name="repeatability"
                            value="{{ old('repeatability', $calibration->addDialIndicator->repeatability ?? '') }}"
                            style="border:none; border-bottom:1px solid #000; width:80px; text-align:center; font-size:10pt; background:transparent;"
                            placeholder="0.000">
                        <!-- HAPUS oninput tersebut! -->
                    </span>
                </p>

                <div class="table-responsive">
                    <table class="repeatability-table" style="width: 100%; border-collapse: collapse; min-width: 600px;">
                        <!-- Baris 1 -->
                        <tr style="height: 20pt;">
                            <td style="width: 49.05pt; border: 1px solid #000;">
                                <input type="number" step="any" name="ulangan01"
                                    value="{{ $calibration->addDialIndicator->ulangan01 ?? '' }}"
                                    style="width:100%;height:100%;border:none;text-align:center;font-size:10pt;background:transparent;">
                            </td>
                            <td style="width: 51.2pt; border: 1px solid #000;">
                                <input type="number" step="any" name="ulangan02"
                                    value="{{ $calibration->addDialIndicator->ulangan02 ?? '' }}"
                                    style="width:100%;height:100%;border:none;text-align:center;font-size:10pt;background:transparent;">
                            </td>
                            <td style="width: 51.2pt; border: 1px solid #000;">
                                <input type="number" step="any" name="ulangan03"
                                    value="{{ $calibration->addDialIndicator->ulangan03 ?? '' }}"
                                    style="width:100%;height:100%;border:none;text-align:center;font-size:10pt;background:transparent;">
                            </td>
                            <td style="width: 57.05pt; border: 1px solid #000;">
                                <input type="number" step="any" name="ulangan04"
                                    value="{{ $calibration->addDialIndicator->ulangan04 ?? '' }}"
                                    style="width:100%;height:100%;border:none;text-align:center;font-size:10pt;background:transparent;">
                            </td>
                            <td style="width: 57.05pt; border: 1px solid #000;">
                                <input type="number" step="any" name="ulangan05"
                                    value="{{ $calibration->addDialIndicator->ulangan05 ?? '' }}"
                                    style="width:100%;height:100%;border:none;text-align:center;font-size:10pt;background:transparent;">
                            </td>
                        </tr>


                        <!-- Baris 2 -->
                        <tr style="height: 20pt;">
                            <td style="width: 49.05pt; border: 1px solid #000;">
                                <input type="number" step="any" name="ulangan06"
                                    value="{{ $calibration->addDialIndicator->ulangan06 ?? '' }}"
                                    style="width:100%;height:100%;border:none;text-align:center;font-size:10pt;background:transparent;">
                            </td>
                            <td style="width: 51.2pt; border: 1px solid #000;">
                                <input type="number" step="any" name="ulangan07"
                                    value="{{ $calibration->addDialIndicator->ulangan07 ?? '' }}"
                                    style="width:100%;height:100%;border:none;text-align:center;font-size:10pt;background:transparent;">
                            </td>
                            <td style="width: 51.2pt; border: 1px solid #000;">
                                <input type="number" step="any" name="ulangan08"
                                    value="{{ $calibration->addDialIndicator->ulangan08 ?? '' }}"
                                    style="width:100%;height:100%;border:none;text-align:center;font-size:10pt;background:transparent;">
                            </td>
                            <td style="width: 57.05pt; border: 1px solid #000;">
                                <input type="number" step="any" name="ulangan09"
                                    value="{{ $calibration->addDialIndicator->ulangan09 ?? '' }}"
                                    style="width:100%;height:100%;border:none;text-align:center;font-size:10pt;background:transparent;">
                            </td>
                            <td style="width: 57.05pt; border: 1px solid #000;">
                                <input type="number" step="any" name="ulangan10"
                                    value="{{ $calibration->addDialIndicator->ulangan10 ?? '' }}"
                                    style="width:100%;height:100%;border:none;text-align:center;font-size:10pt;background:transparent;">
                            </td>
                        </tr>

                        </tr>
                    </table>
                </div>

                <!-- Table 2: Alat Standar, TTD, & Metode Kalibrasi -->
                <div class="table-responsive mt-3">
                    <table class="repeatability-table" style="width: 100%; border-collapse: collapse; min-width: 800px;">
                        <!-- Baris 1: Alat Standar 1 -->
                        <tr style="height: 22pt;">
                            <td rowspan="3" style="width: 120px; border: 1px solid #000; text-align: center; vertical-align: middle; font-weight: bold; font-size: 10pt; background-color: #f8f9fa;">
                                Alat Standar
                            </td>
                            <td style="width: 40px; border: 1px solid #000; text-align: center; vertical-align: middle;">
                                @php
                                $standardArray = [];
                                if (!empty($calibration->headDialIndicator->standard)) {
                                    $standardArray = explode(',', $calibration->headDialIndicator->standard);
                                    $standardArray = array_map('trim', $standardArray);
                                }
                                $isChecked1 = false;
                                foreach ($standardArray as $alat) {
                                    if (str_contains(strtolower($alat), 'dial gauge tester 0~25 mm') || str_contains(strtolower($alat), 'dial_gauge_tester_0_25mm')) {
                                        $isChecked1 = true; break;
                                    }
                                }
                                @endphp
                                <input type="checkbox" name="alat_standar[]" value="dial_gauge_tester_0_25mm" class="alat-standar-checkbox" style="transform:scale(1.1);" {{ $isChecked1 ? 'checked' : '' }}>
                            </td>
                            <td style="width: 280px; border: 1px solid #000; vertical-align: middle; padding: 8px;">
                                <p style="margin: 0; font-size: 9.5pt;">Dial Gauge Tester 0~25 mm</p>
                            </td>
                            <td rowspan="3" style="width: 180px; border: 1px solid #000; vertical-align: top; padding: 8px;">
                                <p style="margin: 0 0 8px 0; font-size: 10pt; text-align: center; font-weight: bold; border-bottom: 1px solid #ddd; padding-bottom: 4px;">Dikalibrasi oleh</p>
                                <p style="margin: 0; font-size: 10pt;">TTD :</p>
                                <div style="height: 45px;"></div>
                                <div style="display:flex; align-items:center;">
                                    <span style="font-size: 10pt; white-space: nowrap;">Nama :</span>
                                    <input type="text" name="calibratedBy" value="{{ old('calibratedBy', $calibration->calibratedBy) }}" style="flex:1; border: none; border-bottom: 1px solid #000; margin-left: 6px; font-size: 9.5pt; background: transparent;">
                                </div>
                            </td>
                            <td rowspan="3" style="width: 180px; border: 1px solid #000; vertical-align: top; padding: 8px;">
                                <p style="margin: 0 0 8px 0; font-size: 10pt; text-align: center; font-weight: bold; border-bottom: 1px solid #ddd; padding-bottom: 4px;">Diperiksa oleh</p>
                                <p style="margin: 0; font-size: 10pt;">TTD :</p>
                                <div style="height: 45px;"></div>
                                <div style="display:flex; align-items:center;">
                                    <span style="font-size: 10pt; white-space: nowrap;">Nama :</span>
                                    <input type="text" name="verifiedBy" value="{{ old('verifiedBy', $calibration->verifiedBy) }}" style="flex:1; border: none; border-bottom: 1px solid #000; margin-left: 6px; font-size: 9.5pt; background: transparent;" readonly>
                                </div>
                            </td>
                        </tr>

                        <!-- Baris 2: Alat Standar 2 -->
                        <tr style="height: 22pt;">
                            <td style="border: 1px solid #000; text-align: center; vertical-align: middle;">
                                @php
                                $skala = $calibration->skala ?? '0.01';
                                $is001 = $skala === '0.001';
                                $isChecked2 = false;
                                if ($is001) {
                                    foreach ($standardArray as $alat) {
                                        if (str_contains(strtolower($alat), 'dial calibration tester 0~1 mm') || str_contains(strtolower($alat), 'dial_calibration_tester_0_1mm')) {
                                            $isChecked2 = true; break;
                                        }
                                    }
                                } else {
                                    foreach ($standardArray as $alat) {
                                        if (str_contains(strtolower($alat), 'electronic gauge tester 0~50 mm') || str_contains(strtolower($alat), 'electronic_gauge_tester_0_50mm')) {
                                            $isChecked2 = true; break;
                                        }
                                    }
                                }
                                @endphp
                                <input type="checkbox" name="alat_standar[]" value="{{ $is001 ? 'dial_calibration_tester_0_1mm' : 'electronic_gauge_tester_0_50mm' }}" class="alat-standar-checkbox" style="transform:scale(1.1);" {{ $isChecked2 ? 'checked' : '' }}>
                            </td>
                            <td style="border: 1px solid #000; vertical-align: middle; padding: 8px;">
                                <p style="margin: 0; font-size: 9.5pt;">
                                    {{ $is001 ? 'Dial Calibration Tester 0~1 mm' : 'Electronic Gauge Tester 0~50 mm' }}
                                </p>
                            </td>
                        </tr>

                        <!-- Baris 3: Alat Standar Lainnya -->
                        <tr style="height: 22pt;">
                            <td style="border: 1px solid #000; text-align: center; vertical-align: middle;">
                                @php
                                $filteredArray = array_filter($standardArray, function($alat) {
                                    $lowerAlat = strtolower($alat);
                                    $knownTools = ['dial gauge tester 0~25 mm', 'dial_gauge_tester_0_25mm', 'dial calibration tester 0~1 mm', 'dial_calibration_tester_0_1mm', 'electronic gauge tester 0~50 mm', 'electronic_gauge_tester_0_50mm'];
                                    foreach ($knownTools as $tool) {
                                        if (str_contains($lowerAlat, $tool)) return false;
                                    }
                                    return true;
                                });
                                $isChecked3 = !empty($filteredArray);
                                $alatStandarLainnya = $isChecked3 ? implode(', ', $filteredArray) : '';
                                @endphp
                                <input type="checkbox" name="alat_standar[]" value="alat_standar_lainnya" id="alat_standar_lainnya_checkbox" class="alat-standar-checkbox custom-checkbox" style="transform:scale(1.1);" {{ $isChecked3 ? 'checked' : '' }}>
                            </td>
                            <td style="border: 1px solid #000; vertical-align: middle; padding: 8px;">
                                <input type="text" name="alat_standar_tambahan" id="alat_standar_tambahan_input" value="{{ old('alat_standar_tambahan', $alatStandarLainnya) }}" placeholder="Alat standar tambahan..." style="width:95%; border:none; border-bottom: 1px dashed #999; font-size:9.5pt; padding:2px; background:transparent;" oninput="updateAlatStandarLainnya()">
                            </td>
                        </tr>

                        <!-- Baris 4: Metode Kalibrasi -->
                        <tr style="height: 25pt;">
                            <td colspan="2" style="border: 1px solid #000; vertical-align: middle; text-align: center; font-weight: bold; font-size: 10pt; background-color: #f8f9fa;">
                                Metode Kalibrasi
                            </td>
                            <td colspan="3" style="border: 1px solid #000; vertical-align: middle; padding: 8px;">
                                <p style="margin: 0; font-size: 9.5pt;">
                                    PAS-IK1102-03 (JIS B 7503:2017 (JMA/JSA); SNSU PK.P-03:2020)
                                </p>
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- Action Buttons Section -->
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
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var tempFormDataStore = window.tempFormDataStore;
        var isRestoring = window.isRestoring;
        var tabSubmitStatus = window.tabSubmitStatus;
        var currentActiveTabId = '1';

        // HAPUS SEMUA SCRIPT LAMA, ganti dengan ini:
        document.addEventListener('DOMContentLoaded', function() {
            const editForm = document.getElementById('editForm');
            if (!editForm) return;

            console.log('🔧 Form loaded, checking JavaScript...');

            // 1. LOG SEMUA FIELD YANG ADA DI FORM
            console.log('📋 Listing all form fields:');
            const allFields = editForm.querySelectorAll('input, select, textarea');
            allFields.forEach(field => {
                // Log field-field penting
                const fieldNames = ['repeatability', 'ulangan0', 'calibrated', 'verified', 'titikUkur'];
                const shouldLog = fieldNames.some(name => field.name && field.name.includes(name));

                if (shouldLog && field.name) {
                    console.log(`🔍 Field: ${field.name} =`, field.value);
                }
            });

            // 2. SIMPLE SUBMIT HANDLER - TANPA BLOCKING VALIDATION
            editForm.addEventListener('submit', function(e) {
                console.log('🚀 Form submit event triggered');

                // HANYA LOGGING, TIDAK ADA PREVENT DEFAULT!

                // Debug: Tampilkan nilai sebelum submit
                console.log('📤 Checking field values before submit:');

                // Check repeatability
                const repeatInput = this.querySelector('[name="repeatability"]');
                console.log('🔢 repeatability:', repeatInput ? repeatInput.value : 'NOT FOUND');

                // Check ulangan fields
                for (let i = 1; i <= 10; i++) {
                    const fieldName = i < 10 ? 'ulangan0' + i : 'ulangan' + i;
                    const field = this.querySelector(`[name="${fieldName}"]`);
                    if (field) {
                        console.log(`🔢 ${fieldName}:`, field.value);
                    }
                }

                // Check alat standar
                const alatStandarChecked = this.querySelectorAll('.alat-standar-checkbox:checked');
                console.log('✅ Alat standar checked:', alatStandarChecked.length);

                // Check calibratedBy dan verifiedBy
                const calibratedBy = this.querySelector('[name="calibratedBy"]');
                const verifiedBy = this.querySelector('[name="verifiedBy"]');
                console.log('🖋️ calibratedBy:', calibratedBy ? calibratedBy.value : 'NOT FOUND');
                console.log('🖋️ verifiedBy:', verifiedBy ? verifiedBy.value : 'NOT FOUND');

                // 3. TAMPILKAN LOADING, TAPI JANGAN CANCEL SUBMIT
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn) {
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
                    submitBtn.disabled = true;

                    // Auto reset setelah 30 detik jika stuck
                    setTimeout(() => {
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    }, 30000);
                }

                // 4. LANGSUNG SUBMIT - TIDAK ADA VALIDASI YANG MEMBLOKIR
                console.log('✅ Allowing form submission...');
                return true;
            });

            // 5. REAL-TIME DEBUGGING: Log ketika field berubah
            editForm.querySelectorAll('input').forEach(input => {
                // Hanya monitor field-field penting
                if (input.name && (
                        input.name.includes('repeatability') ||
                        input.name.includes('ulangan') ||
                        input.name.includes('calibrated') ||
                        input.name.includes('verified')
                    )) {
                    input.addEventListener('change', function() {
                        console.log(`🔄 Field ${this.name} changed to:`, this.value);
                    });

                    input.addEventListener('blur', function() {
                        console.log(`📝 Field ${this.name} on blur:`, this.value);
                    });
                }
            });
        });

        // TAMBAHKAN INI UNTUK CATCH SEMUA JS ERRORS
        window.addEventListener('error', function(e) {
            console.error('❌ JavaScript Error:', e.message);
            // JANGAN lakukan apa-apa, biarkan form submit
        });