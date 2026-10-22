<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Kalibrasi - PT. PANANJUNG ANUGRAH SOLUTION</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    /* Pastikan semua text berwarna hitam */
    .form-kalibrasi-container,
    .form-kalibrasi-container *:not(input):not(select):not(textarea):not(button) {
        color: #000000 !important;
    }
    
    /* Input fields readonly styling */
    .kalibrasi-input {
        color: #000000 !important;
        border: 1px solid #ced4da !important;
        padding: 6px 10px;
        border-radius: 4px;
        width: 100%;
        background-color: #f8f9fa;
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
        background-color: #f8f9fa;
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

    /* Styling khusus untuk checkbox alat standar */
    .alat-standar-checkbox {
        width: 18px;
        height: 18px;
        margin: 0;
        cursor: not-allowed;
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
</style>
</head>
<body>
    <div class="container my-4">
            @php
                $jumlahForm = request()->query('jumlah_form', $calibration->jumlah_form ?? 1);
                $jumlahForm = max(1, (int)$jumlahForm);
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
                    $headData = $calibration->{'headConductivityMeterForm' . $formIndex} ?? \App\Models\HeadConductivityMeter::where('calibration_id', $calibration->id)->where('form_index', $formIndex)->first() ?? $calibration->headConductivityMeter;
                    $formDetails = $calibration->detailConductivityMeters->where('form_index', $formIndex)->sortBy('id')->values();
                    if ($formDetails->count() == 0 && $formIndex == 1) {
                        $formDetails = \App\Models\DetailConductivityMeter::where('calibration_id', $calibration->id)->orderBy('id')->get();
                    }
                    $detailsArray = [];
                    foreach($formDetails as $dItem) {
                        $detailsArray[] = $dItem;
                    }
                    $isFirstForm = ($formIndex == 1);
                @endphp

                @if($jumlahForm > 1)
                <div class="card mb-4" style="border: 2px solid #3b82f6; border-radius: 8px;">
                    <div class="card-header text-white fw-bold d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #1e40af, #3b82f6);">
                        <span><i class="fas fa-file-alt me-2"></i>Form Conductivity Meter ke-{{ $formIndex }}</span>
                        @if(!$isFirstForm)
                        <span class="badge bg-warning text-dark"><i class="fas fa-info-circle me-1"></i> Data Informasi Alat mengikuti Form 1</span>
                        @endif
                    </div>
                    <div class="card-body p-3">
                @endif

        <div class="form-kalibrasi-container">
            <table class="kalibrasi-header-table">
                <tr>
                    <td colspan="2">
                        <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK41</p>
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
                        <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">CONDUCTIVITY METER</p>
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
                        <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;">{{ $headData->certificate_id ?? $calibration->certificate_id ?? 'N/A' }}</p>
                    </td>
                </tr>
            </table>

            <!-- Main Form Section - Readonly -->
              <table class="kalibrasi-main-table">
                    <!-- Nama Alat -->
                    <tr>
        <td style="width: 20%;">
            <p style="margin: 0; color: #000000;">Nama Alat</p>
        </td>
        <td colspan="3">
            <input type="text" name="namaAlat" class="kalibrasi-input" 
                   value="{{ old('namaAlat', $calibration->namaAlat) }}">
        </td>
    </tr>

                    <!-- Merek & Kode Alat -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;" class="required-field">Merek</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" class="kalibrasi-input me-3" name="brandAlat" value="{{ old('brandAlat', $calibration->brandAlat) }}"  style="width: 60%;">
                                <span class="me-3" style="color: #000000;">Kode Alat :</span>
                                <input type="text" class="kalibrasi-input" name="kodeAlat" value="{{ old('kodeAlat', $calibration->kodeAlat) }}"  style="width: 30%;">
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
                                <input type="text" class="kalibrasi-input me-3" name="typeAlat" value="{{ old('typeAlat', $calibration->typeAlat) }}"  style="width: 45%;">
                                <span class="me-3" style="color: #000000;">/</span>
                                <input type="text" class="kalibrasi-input" name="NoSeri" value="{{ old('NoSeri', $calibration->NoSeri) }}"  style="width: 45%;">
                            </div>
                        </td>
                    </tr>

                    <!--<tr>-->
                    <!--    <td>-->
                    <!--        <p style="margin: 0; color: #000000;">Rentang Ukur</p>-->
                    <!--    </td>-->
                    <!--    <td colspan="3">-->
                    <!--        <div class="d-flex align-items-center">-->
                    <!--            <div class="me-3" style="width: 45%;">-->
                    <!--                <input type="number" -->
                    <!--                       class="kalibrasi-input" -->
                    <!--                       name="rangeMin" -->
                    <!--                       value="{{ old('rangeMin', isset($calibration->rangeMin) ? $calibration->rangeMin : '0') }}" -->
                    <!--                       step="0.01"-->
                    <!--                       style="width: 100%;">-->
                    <!--            </div>-->
                                
                    <!--            <span class="me-3" style="color: #000000;">-</span>-->
                                
                    <!--            <div style="width: 45%;">-->
                    <!--                <input type="number" -->
                    <!--                       class="kalibrasi-input" -->
                    <!--                       name="rangeMax" -->
                    <!--                       value="{{ old('rangeMax', isset($calibration->rangeMax) ? $calibration->rangeMax : '0') }}" -->
                    <!--                       step="0.01"-->
                    <!--                       style="width: 100%;">-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </td>-->
                    <!--</tr>-->

                    <!-- Kapasitas / Resolusi -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Kapasitas / Resolusi</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" class="kalibrasi-input me-3" name="kapasitas_{{ $formIndex }}" value="{{ old('kapasitas_' . $formIndex, $headData->kapasitas ?? $calibration->kapasitas) }}" style="width: 45%;">
                                <span class="me-3" style="color: #000000;">/</span>
                                <input type="text" class="kalibrasi-input" name="resolusi_{{ $formIndex }}" value="{{ old('resolusi_' . $formIndex, $headData->resolusi ?? $calibration->resolusi) }}" style="width: 45%;">
                            </div>
                        </td>
                    </tr>

                    <!-- Nama Pemilik -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;" class="required-field">Nama Pemilik</p>
                        </td>
                        <td colspan="3">
                            <input type="text" class="kalibrasi-input" name="pemilikAlat" value="{{ old('pemilikAlat', $calibration->pemilikAlat) }}" >
                        </td>
                    </tr>

                    <!-- Tanggal -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;" class="required-field">Tanggal Alat Masuk</p>
                        </td>
                        <td colspan="3">
                            <input type="date" class="kalibrasi-input" name="tanggalMasuk" 
                                   value="{{ old('tanggalMasuk', \Carbon\Carbon::parse($calibration->tanggalMasuk)->format('Y-m-d')) }}" >
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
                            @php
                                $valTempat = old('tempatKalibrasi_' . $formIndex, old('tempatKalibrasi', $headData->tempat_kalibrasi ?? $calibration->tempatKalibrasi ?? 'lab.PT PAS'));
                                if (empty($valTempat)) { $valTempat = 'lab.PT PAS'; }
                            @endphp
                            <div class="d-flex">
                                <div class="form-check me-5">
                                    <input class="form-check-input" type="radio" name="tempatKalibrasi_{{ $formIndex }}" value="lab.PT PAS" id="lab_{{ $formIndex }}" 
                                           {{ $valTempat == 'lab.PT PAS' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="lab_{{ $formIndex }}" style="color: #000000;">Lab. PT.PAS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tempatKalibrasi_{{ $formIndex }}" value="insitu" id="insitu_{{ $formIndex }}" 
                                           {{ $valTempat == 'insitu' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="insitu_{{ $formIndex }}" style="color: #000000;">Insitu</label>
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
                        
                        @php
                            $valKondisi = old('kondisiAlat_' . $formIndex, old('kondisiAlat', $headData->kondisiAlat ?? $headData->kondisi_fungsi_komponen ?? $calibration->kondisiAlat ?? 'ok'));
                            if (empty($valKondisi)) { $valKondisi = 'ok'; }
                        @endphp
                        <!-- Radio Button Section - Text di atas, radio di bawah -->
                        <div class="d-flex justify-content-center align-items-center mb-4" style="gap: 60px;">
                            <div class="text-center">
                                <span class="fw-bold d-block mb-2" style="color: #000000; font-size: 14px;">Ok</span>
                                <input type="radio" name="kondisiAlat_{{ $formIndex }}" value="ok" class="form-check-input" 
                                    style="width: 18px; height: 18px; display: block; margin: 0 auto;"
                                    {{ $valKondisi == 'ok' ? 'checked' : '' }}>
                            </div>
                            <div class="text-center">
                                <span class="fw-bold d-block mb-2" style="color: #000000; font-size: 14px;">Rusak</span>
                                <input type="radio" name="kondisiAlat_{{ $formIndex }}" value="rusak" class="form-check-input"
                                    style="width: 18px; height: 18px; display: block; margin: 0 auto;"
                                    {{ $valKondisi == 'rusak' ? 'checked' : '' }}>
                            </div>
                        </div>
                        
                        <!-- Keterangan Section -->
                        <div class="d-flex align-items-center">
                            <span class="fw-bold me-3" style="color: #000000; min-width: 100px;">Keterangan :</span>
                            <div style="flex: 1;">
                                <input type="text" class="kalibrasi-input" name="keterangan_fungsi_komponen_{{ $formIndex }}" value="{{ old('keterangan_fungsi_komponen_' . $formIndex, $headData->keterangan_fungsi_komponen ?? $headData->keterangan ?? $calibration->keterangan ?? '-') }}" 
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

     <table cellspacing="0" cellpadding="0" class="TableNormal" style="width:100%; border:1pt solid #000000; -aw-border-insideh:1pt solid #000000; -aw-border-insidev:1pt solid #000000; border-collapse:collapse; font-size:12pt; margin: 15px 0;">
        <!-- Header Row 1 -->
        <tr style="height:20pt">
            <td style="width:18%; border-right:1pt solid #000000; vertical-align:middle; text-align:center">
                <span style="font-family:Arial; font-weight:bold; font-size:11pt">Nilai CRM</span>
            </td>
            <td colspan="5" style="width:48%; border:1pt solid #000000; border-bottom:1pt solid #000000; vertical-align:middle; text-align:center">
                <span style="font-family:Arial; font-weight:bold; font-size:11pt">Pembacaan Alat</span>
            </td>
            <td rowspan="2" style="width:17%; border:1pt solid #000000; vertical-align:middle; text-align:center">
                <span style="font-family:Arial; font-weight:bold; font-size:11pt">Resolusi</span>
            </td>
            <td style="width:17%; border-left:1pt solid #000000; vertical-align:middle; text-align:center">
                <span style="font-family:Arial; font-weight:bold; font-size:11pt">Suhu CRM</span>
            </td>
        </tr>
        
        <!-- Header Row 2 -->
        <tr style="height:20pt">
            <td style="border-right:1pt solid #000000; border-bottom:1pt solid #000000; vertical-align:middle; text-align:center">
                <span style="font-family:Arial; font-weight:bold; font-size:10pt"></span>
            </td>
            <td style="width:9.6%; border:1pt solid #000000; vertical-align:middle; text-align:center">
                <span style="font-family:Arial; font-weight:bold; font-size:11pt">1</span>
            </td>
            <td style="width:9.6%; border:1pt solid #000000; vertical-align:middle; text-align:center">
                <span style="font-family:Arial; font-weight:bold; font-size:11pt">2</span>
            </td>
            <td style="width:9.6%; border:1pt solid #000000; vertical-align:middle; text-align:center">
                <span style="font-family:Arial; font-weight:bold; font-size:11pt">3</span>
            </td>
            <td style="width:9.6%; border:1pt solid #000000; vertical-align:middle; text-align:center">
                <span style="font-family:Arial; font-weight:bold; font-size:11pt">4</span>
            </td>
            <td style="width:9.6%; border:1pt solid #000000; vertical-align:middle; text-align:center">
                <span style="font-family:Arial; font-weight:bold; font-size:11pt">5</span>
            </td>
            <td style="border-left:1pt solid #000000; border-bottom:1pt solid #000000; vertical-align:middle; text-align:center">
                <span style="font-family:Arial; font-weight:bold; font-size:11pt"><sup>o</sup>C</span>
            </td>
        </tr>
        
        <!-- Data Rows - Loop untuk 6 baris -->
        @for ($row = 1; $row <= 6; $row++)
            @php
                // Ambil data untuk baris ke-i (index 0-based)
                $detail = $detailsArray[$row-1] ?? null;
                
                $isLastRow = ($row == 6);
                
                // Style untuk sel pertama (Nilai CRM)
                $firstCellStyle = "width:18%; border-right:1pt solid #000000;";
                if ($row == 1) {
                    $firstCellStyle .= " border-top:1pt solid #000000;";
                }
                if (!$isLastRow) {
                    $firstCellStyle .= " border-bottom:1pt solid #000000;";
                }
                $firstCellStyle .= " vertical-align:middle; text-align:center; padding:2px;";
                
                // Style untuk sel tengah (Pembacaan 1-5)
                $middleCellStyle = "width:9.6%; border:1pt solid #000000;";
                if (!$isLastRow) {
                    $middleCellStyle .= " border-bottom:1pt solid #000000;";
                }
                $middleCellStyle .= " vertical-align:middle; text-align:center; padding:2px;";
                
                // Style untuk sel resolusi
                $resolusiStyle = "width:17%; border:1pt solid #000000;";
                if (!$isLastRow) {
                    $resolusiStyle .= " border-bottom:1pt solid #000000;";
                }
                $resolusiStyle .= " vertical-align:middle; text-align:center; padding:2px;";
                
                // Style untuk sel terakhir (Suhu)
                $lastCellStyle = "width:17%; border-left:1pt solid #000000;";
                if ($row == 1) {
                    $lastCellStyle .= " border-top:1pt solid #000000;";
                }
                if (!$isLastRow) {
                    $lastCellStyle .= " border-bottom:1pt solid #000000;";
                }
                $lastCellStyle .= " vertical-align:middle; text-align:center; padding:2px;";
                
                // Style untuk input
                $inputStyle = "width:100%; height:60px; border:none; font-family:'Times New Roman'; font-size:14pt; text-align:center; box-sizing:border-box; background:transparent; outline:none; padding:5px;";
                
                // Hidden input untuk ID (jika ada data)
                $hasDetail = !is_null($detail);
                $detailPrefix = ($formIndex == 1) ? 'details[' . ($row-1) . ']' : 'details_' . $formIndex . '[' . ($row-1) . ']';
                $oldKeyPrefix = ($formIndex == 1) ? 'details.' . ($row-1) . '.' : 'details_' . $formIndex . '.' . ($row-1) . '.';
            @endphp
            
            <tr style="height:60pt">
                <!-- Hidden ID field untuk update existing record -->
                @if($hasDetail)
                    <input type="hidden" name="{{ $detailPrefix }}[id]" value="{{ $detail->id }}">
                @endif
                
                <!-- Kolom 1: Nilai CRM -->
                <td style="{{ $firstCellStyle }}">
                    <input type="text" 
                           name="{{ $detailPrefix }}[nilaiCRM]" 
                           value="{{ old($oldKeyPrefix . 'nilaiCRM', $detail->nilaiCRM ?? '') }}"
                           style="{{ $inputStyle }}"
                         
                           onkeypress="return isNumberKey(event)">
                </td>
                
                <!-- Kolom 2-6: Pembacaan Alat 1-5 -->
                @for($col = 1; $col <= 5; $col++)
                    @php
                        $fieldName = 'rep' . sprintf('%02d', $col); // rep01, rep02, rep03, rep04, rep05
                        $oldValue = old($oldKeyPrefix . $fieldName, $detail->$fieldName ?? '');
                    @endphp
                    <td style="{{ $middleCellStyle }}">
                        <input type="text" 
                               name="{{ $detailPrefix }}[{{ $fieldName }}]" 
                               value="{{ $oldValue }}"
                               style="{{ $inputStyle }}"
                              
                               onkeypress="return isNumberKey(event)">
                    </td>
                @endfor
                
                <!-- Kolom 7: Resolusi -->
                <td style="{{ $resolusiStyle }}">
                    <input type="text" 
                           name="{{ $detailPrefix }}[Resolusi]" 
                           value="{{ old($oldKeyPrefix . 'Resolusi', $detail->Resolusi ?? '') }}"
                           style="{{ $inputStyle }}"
                         
                           onkeypress="return isNumberKey(event)">
                </td>
                
                <!-- Kolom 8: Suhu CRM -->
                <td style="{{ $lastCellStyle }}">
                    <input type="text" 
                           name="{{ $detailPrefix }}[suhuCRM]" 
                           value="{{ old($oldKeyPrefix . 'suhuCRM', $detail->suhuCRM ?? '') }}"
                           style="{{ $inputStyle }}"
                         
                           onkeypress="return isNumberKey(event)">
                </td>
            </tr>
        @endfor
    </table>
    

<!-- Debug Section (tampilkan di bawah tabel untuk testing) -->
<div style="display:none; margin-top: 20px; padding: 10px; background: #f5f5f5; border: 1px solid #ddd;">
    <h4>Debug Information:</h4>
    <p><strong>Calibration ID:</strong> {{ $calibration->id }}</p>
    <p><strong>Relationship Name:</strong> detailConductivityMeter</p>
    <p><strong>Data Count:</strong> {{ isset($formDetails) ? $formDetails->count() : 0 }}</p>
    
    @if(isset($formDetails) && $formDetails->count() > 0)
        <table border="1" style="width:100%; margin-top:10px;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>nilaiCRM</th>
                    <th>pembacaan1</th>
                    <th>pembacaan2</th>
                    <th>pembacaan3</th>
                    <th>pembacaan4</th>
                    <th>pembacaan5</th>
                    <th>resolusi</th>
                    <th>suhuCRM</th>
                </tr>
            </thead>
            <tbody>
                @foreach($formDetails as $index => $detail)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $detail->id }}</td>
                    <td>{{ $detail->nilaiCRM }}</td>
                    <td>{{ $detail->rep01 }}</td>
                    <td>{{ $detail->rep02 }}</td>
                    <td>{{ $detail->rep03 }}</td>
                    <td>{{ $detail->rep04 }}</td>
                    <td>{{ $detail->rep05 }}</td>
                    <td>{{ $detail->Resolusi }}</td>
                    <td>{{ $detail->suhuCRM }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="color:red;">No detailConductivityMeter data found!</p>
        <p>Trying to query directly...</p>
        @php
            $directQuery = \App\Models\DetailConductivityMeter::where('calibration_id', $calibration->id)->get();
        @endphp
        <p>Direct query count: {{ $directQuery->count() }}</p>
    @endif
</div>


            <p style="margin-top:0.35pt; font-size:9pt">&nbsp;</p>
<style>
    /* Styling untuk checkbox view mode */
    .view-checkbox {
        width: 16px;
        height: 16px;
        cursor: default;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        border: 2px solid #666;
        border-radius: 3px;
        background-color: #f0f0f0;
        position: relative;
        vertical-align: middle;
    }
    
    .view-checkbox:checked {
        background-color: #000;
        border-color: #000;
    }
    
    .view-checkbox:checked::after {
        content: '✓';
        color: white;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 12px;
        font-weight: bold;
    }
    
    .view-checkbox:disabled {
        opacity: 1; /* Tetap terlihat jelas meski disabled */
    }
    
    .view-checkbox-label {
        cursor: default;
        user-select: none;
        margin-left: 3px;
    }
</style>    <table cellspacing="0" cellpadding="0" class="TableNormal" style="width:100%; border:0.75pt solid #000000; -aw-border-insideh:0.75pt single #000000; -aw-border-insidev:0.75pt single #000000; border-collapse:collapse; margin-top:20px;">
    <tr style="height:12.9pt">
        <td colspan="9" style="width:100%; border-bottom-style:solid; border-bottom-width:0.75pt; vertical-align:top">
            <p class="TableParagraph" style="margin-left:0.8pt; text-align:center; line-height:11.95pt">
                <span style="font-family:Arial; font-weight:bold">Isilah lembar data kalibrasi dengan lengkap dan jelas!</span>
            </p>
        </td>
    </tr>
    <tr style="height:14.3pt">
        <td rowspan="2" style="width:25%; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; vertical-align:top">
            <p class="TableParagraph" style="margin-top:0.2pt; font-size:9.5pt">
                <span style="-aw-import:ignore">&#xa0;</span>
            </p>
            <p class="TableParagraph" style="margin-left:1.35pt; text-align:center; font-size:9.5pt">
                <span>Alat</span>
                <span style="letter-spacing:-0.05pt"></span>
                <span style="letter-spacing:-0.1pt">Standar</span>
            </p>
        </td>
       <td colspan="6" style="width:45%; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border-bottom:0.38pt thin-thick-medium-gap #000000">
    @php
        $headData = $calibration->headConductivityMeter ?? null;
        // Tampilkan hanya CRM, Thermoscientific (tanpa TES/TFA)
        $alatStandar = 'CRM, Thermoscientific';
    @endphp
    <input type="text" 
           name="alat_standar[]" 
           value="{{ $alatStandar }}"
           style="width:100%; border:none; font-family:Arial; font-size:9.5pt; background:transparent; outline:none; padding:2px; margin-top:2px;" 
           readonly>
</td>
        <td style="width:15%; border-style:solid; border-width:0.75pt; vertical-align:top">
            <p class="TableParagraph" style="margin-top:2.1pt; text-align:center; font-size:9.5pt">
                <span>Dikalibrasi</span>
                <span style="letter-spacing:0.35pt"></span>
                <span style="letter-spacing:-0.2pt">oleh</span>
            </p>
        </td>
        <td style="width:15%; border-top-style:solid; border-top-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; vertical-align:top">
            <p class="TableParagraph" style="margin-top:2.1pt; text-align:center; font-size:9.5pt">
                <span>Diperiksa</span>
                <span style="letter-spacing:0.35pt"></span>
                <span style="letter-spacing:-0.2pt">oleh</span>
            </p>
        </td>
    </tr>
    <tr style="height:13.6pt">
        <td style="width:6%; border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
            <span style="font-family:Arial; font-size:9.5pt; letter-spacing:-0.25pt">TES</span>
        </td>
        <td style="width:6%; border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center; -aw-border-bottom:0.38pt thick-thin-medium-gap #000000; -aw-border-top:0.38pt thick-thin-medium-gap #000000">
            @php
                $isTES = old('alat_standar[]', $headData && str_contains($headData->standard ?? '', 'TES'));
            @endphp
            <input type="checkbox" 
                   name="alat_standar[]" 
                   value="TES" 
                   {{ $isTES ? 'checked' : '' }}
                   style="width:16px; height:16px; cursor:pointer; margin:2px;">
        </td>
        <td style="width:10.5%; border-style:solid; border-width:0.75pt; vertical-align:top"></td>
        <td style="width:6%; border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
            <span style="font-family:Arial; font-size:9.5pt; letter-spacing:-0.25pt">TFA</span>
        </td>
        <td style="width:6%; border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center; -aw-border-bottom:0.38pt thick-thin-medium-gap #000000; -aw-border-top:0.38pt thick-thin-medium-gap #000000">
            @php
                $isTFA = old('alat_standar[]', $headData && str_contains($headData->standard ?? '', 'TFA'));
            @endphp
            <input type="checkbox" 
                   name="alat_standar[]" 
                   value="TFA" 
                   {{ $isTFA ? 'checked' : '' }}
                   style="width:16px; height:16px; cursor:pointer; margin:2px;">
        </td>
        <td style="width:10.5%; border-style:solid; border-width:0.75pt; vertical-align:top"></td>
        <td style="width:15%; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; vertical-align:middle; padding-left:5px;">
            <!-- INPUT UNTUK DIKALIBRASI -->
          
        </td>
        <td style="width:15%; border-top-style:solid; border-top-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; vertical-align:middle; padding-left:5px;">
            <!-- INPUT UNTUK DIPERIKSA -->
        
        </td>
    </tr>
    <tr style="height:16.95pt">
        <td rowspan="2" style="width:25%; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; vertical-align:top">
            <p class="TableParagraph" style="margin-top:9.25pt; text-align:center; font-size:9.5pt">
                <span>Metode</span>
                <span style="letter-spacing:-0.1pt"> Kalibrasi</span>
            </p>
        </td>
        <td colspan="6" rowspan="2" style="width:45%; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border-top:0.38pt thin-thick-medium-gap #000000">
            @php
                $metode = old('calibration_method', $headData->calibrationMethod ?? 'PAS-IK1102-41');
            @endphp
            <input type="text" 
                   name="calibration_method" 
                   value="{{ $metode }}"
                   style="width:100%; border:none; font-family:Arial; font-size:9.5pt; background:transparent; outline:none; padding:2px; margin-left:5px;">
        </td>
        <td style="width:15%; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; vertical-align:top">
            <p class="TableParagraph" style="margin-top:4.45pt; text-align:center; font-size:9.5pt">
                <span style="letter-spacing:-0.5pt">TTD</span>
            </p>
        </td>
        <td style="width:15%; border-left-style:solid; border-left-width:0.75pt; vertical-align:top">
            <p class="TableParagraph" style="margin-top:4.45pt; text-align:center; font-size:9.5pt">
                <span style="letter-spacing:-0.5pt">TTD</span>
            </p>
        </td>
    </tr>
    <tr style="height:12.4pt">
        <td style="width:15%; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; vertical-align:middle">
            <div style="display:flex; align-items:center; padding-left:5px;">
                <span style="font-size:9.5pt; font-weight:bold; margin-right:4px;">Nama:</span>
                <input type="text" 
                       name="calibratedBy" 
                       value="{{ old('calibratedBy', $calibration->calibratedBy ?? '') }}"
                       placeholder="Nama"
                       style="flex:1; border:none; font-family:Arial; font-size:9.5pt; background:transparent; outline:none; padding:2px;" readonly>
            </div>
        </td>
        <td style="width:15%; border-left-style:solid; border-left-width:0.75pt; vertical-align:middle">
            <div style="display:flex; align-items:center; padding-left:5px;">
                <span style="font-size:9.5pt; font-weight:bold; margin-right:4px;">Nama:</span>
                <input type="text" 
                       name="verifiedBy" 
                       value="{{ old('verifiedBy', $calibration->verifiedBy ?? '') }}"
                       placeholder="Nama"
                       style="flex:1; border:none; font-family:Arial; font-size:9.5pt; background:transparent; outline:none; padding:2px;" readonly>
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
        // Form validation
        document.getElementById('editForm')?.addEventListener('submit', function(e) {
            let isValid = true;
            let errorMessage = '';
            
            // Check required fields
            const requiredFields = document.querySelectorAll('[required]');
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.style.borderColor = '#dc3545';
                } else {
                    field.style.borderColor = '';
                }
            });
            
            // Check radio buttons for kondisi alat
            const kondisiAlat = document.querySelector('input[name^="kondisiAlat"]:checked');
            if (!kondisiAlat) {
                isValid = false;
                errorMessage += 'Pilih kondisi alat (Ok/Rusak)\n';
            }
            
            // Check tempat kalibrasi
            const tempatKalibrasi = document.querySelector('input[name^="tempatKalibrasi"]:checked');
            if (!tempatKalibrasi) {
                isValid = false;
                errorMessage += 'Pilih tempat kalibrasi\n';
            }
            
            // Validate date order
            const tanggalMasuk = document.querySelector('input[name="tanggalMasuk"]').value;
            const tanggalKalibrasi = document.querySelector('input[name="tanggalKalibrasi"]').value;
            
            if (tanggalMasuk && tanggalKalibrasi) {
                if (new Date(tanggalMasuk) > new Date(tanggalKalibrasi)) {
                    isValid = false;
                    errorMessage += 'Tanggal alat masuk tidak boleh lebih baru dari tanggal kalibrasi\n';
                }
            }
            
            if (!isValid) {
                e.preventDefault();
                alert('Mohon lengkapi semua data yang diperlukan:\n' + errorMessage);
            }
        });
        
        // Add input validation for numeric fields
        document.querySelectorAll('input[type="number"]').forEach(input => {
            input.addEventListener('input', function() {
                if (this.value < 0 && this.getAttribute('min') === null) {
                    this.value = Math.abs(this.value);
                }
            });
        });
        
        // Auto format date display
        document.querySelectorAll('input[type="date"]').forEach(input => {
            input.addEventListener('change', function() {
                if (this.value) {
                    // Format untuk display (opsional)
                    const date = new Date(this.value);
                    const formattedDate = date.toLocaleDateString('id-ID', {
                        day: '2-digit',
                        month: '2-digit',
                        year: 'numeric'
                    });
                    // Anda bisa menambahkan display format di sini jika diperlukan
                }
            });
        });
    </script>

   <script>
    document.getElementById('editForm')?.addEventListener('submit', function(e) {
        console.log('🎯 Edit form submission started...');
        
        // Debug form data
        const formData = new FormData(this);
        console.log('📦 Form data collected for update');
        
        // Log titikUkur array
        const titikUkurInputs = document.querySelectorAll('input[name="titikUkur[]"]');
        console.log('🔢 titikUkur inputs count:', titikUkurInputs.length);
        titikUkurInputs.forEach((input, index) => {
            console.log(`📝 titikUkur[${index}]:`, input.value);
        });
        
        // Log alat standar checkboxes
        const alatStandarCheckboxes = document.querySelectorAll('.alat-standar-checkbox:checked');
        console.log('✅ Checked alat standar:', alatStandarCheckboxes.length);
        alatStandarCheckboxes.forEach((checkbox, index) => {
            console.log(`🔧 Alat standar ${index + 1}:`, checkbox.value);
        });
        
        // Log kondisi alat radio
        const kondisiAlatSelected = document.querySelector('input[name^="kondisiAlat"]:checked');
        console.log('🎚️ Kondisi alat selected:', kondisiAlatSelected ? kondisiAlatSelected.value : 'none');
        
        // Log tempat kalibrasi radio
        const tempatKalibrasiSelected = document.querySelector('input[name^="tempatKalibrasi"]:checked');
        console.log('📍 Tempat kalibrasi selected:', tempatKalibrasiSelected ? tempatKalibrasiSelected.value : 'none');
        
        // Sync tempatKalibrasi & kondisiAlat hidden input for main calibration record
        if (tempatKalibrasiSelected) {
            let hiddenTempat = this.querySelector('input[name="tempatKalibrasi"]');
            if (!hiddenTempat) {
                hiddenTempat = document.createElement('input');
                hiddenTempat.type = 'hidden';
                hiddenTempat.name = 'tempatKalibrasi';
                this.appendChild(hiddenTempat);
            }
            hiddenTempat.value = tempatKalibrasiSelected.value;
        }
        if (kondisiAlatSelected) {
            let hiddenKondisi = this.querySelector('input[name="kondisiAlat"]');
            if (!hiddenKondisi) {
                hiddenKondisi = document.createElement('input');
                hiddenKondisi.type = 'hidden';
                hiddenKondisi.name = 'kondisiAlat';
                this.appendChild(hiddenKondisi);
            }
            hiddenKondisi.value = kondisiAlatSelected.value;
        }
        
        // HANYA BASIC VALIDATION untuk edit form (tidak ada required)
        let isValid = true;
        let warningMessages = [];
        
        // 1. Validasi tanggal (jika diisi)
        const tanggalMasuk = document.querySelector('input[name="tanggalMasuk"]').value;
        const tanggalKalibrasi = document.querySelector('input[name="tanggalKalibrasi"]').value;
        
        if (tanggalMasuk && tanggalKalibrasi) {
            if (new Date(tanggalMasuk) > new Date(tanggalKalibrasi)) {
                warningMessages.push('Tanggal alat masuk tidak boleh lebih baru dari tanggal kalibrasi');
                console.warn('⚠️ Date validation warning: masuk > kalibrasi');
            }
        }
        
        // 2. Validasi numeric fields (jika diisi)
        document.querySelectorAll('input[type="number"]').forEach(input => {
            if (input.value && isNaN(parseFloat(input.value))) {
                input.style.borderColor = '#ffc107';
                warningMessages.push(`${input.name} harus berupa angka`);
                console.warn(`⚠️ ${input.name} is not a valid number`);
            } else {
                input.style.borderColor = '';
            }
        });
        
       
        
        // 4. Validasi alat standar (minimal satu dipilih)
        if (alatStandarCheckboxes.length === 0) {
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
        
        // 5. Validasi kondisi alat (harus dipilih)
        if (!kondisiAlatSelected) {
            const kondisiSection = document.querySelector('.kalibrasi-section-header');
            if (kondisiSection) {
                kondisiSection.style.color = '#ffc107';
                warningMessages.push('Pilih kondisi alat (Ok/Rusak)');
                console.warn('⚠️ No kondisi alat selected');
            }
        } else {
            const kondisiSection = document.querySelector('.kalibrasi-section-header');
            if (kondisiSection) kondisiSection.style.color = '';
        }
        
        // 6. Validasi tempat kalibrasi (harus dipilih)
        if (!tempatKalibrasiSelected) {
            const tempatSection = document.querySelector('input[name^="tempatKalibrasi"]').closest('tr');
            if (tempatSection) {
                tempatSection.style.backgroundColor = '#fff8e1';
                warningMessages.push('Pilih tempat kalibrasi');
                console.warn('⚠️ No tempat kalibrasi selected');
            }
        }
        
        // Tampilkan warning jika ada, tapi masih bisa submit
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
            
            // Reset button setelah 10 detik jika ada error
            setTimeout(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 10000);
        }
        
        // Log data yang akan dikirim (optional debugging)
        console.log('📤 Data to be submitted:');
        for (let [key, value] of formData.entries()) {
            // Jangan log password atau sensitive data
            if (!key.includes('password') && !key.includes('token')) {
                console.log(`${key}:`, value);
            }
        }
        
        // Optional: Send analytics/log to server
        try {
            fetch('/api/log-form-edit', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    action: 'edit_form_submit',
                    calibration_id: {{ $calibration->id }},
                    form_type: 'inside_micrometer',
                    timestamp: new Date().toISOString(),
                    field_count: formData.entries().length
                })
            }).catch(err => console.log('Analytics log failed:', err));
        } catch (analyticsError) {
            console.log('Analytics error:', analyticsError);
        }
        
        return true;
    });
    
    // Additional debug on page load
    document.addEventListener('DOMContentLoaded', function() {
        console.log('📄 Edit form loaded for Inside Micrometer ID:', {{ $calibration->id }});
        console.log('🏷️ Certificate ID:', '{{ $calibration->headInsideMicrometer->certificate_id ?? "N/A" }}');
        console.log('🔢 Detail records count:', {{ $calibration->detailInsideMicrometers->count() }});
        
        // Log current alat standar
        const currentStandards = '{{ $calibration->headInsideMicrometer->standard ?? "" }}';
        console.log('📋 Current alat standar:', currentStandards);
        
        // Log current form values
        console.log('📝 Current form values:');
        document.querySelectorAll('.kalibrasi-input').forEach((input, index) => {
            if (index < 5) { // Hanya log 5 pertama
                console.log(`${input.name}:`, input.value);
            }
        });
        
        // Auto-hide validation messages after 5 seconds
        setTimeout(() => {
            document.querySelectorAll('.is-invalid').forEach(el => {
                el.classList.remove('is-invalid');
            });
            document.querySelectorAll('.invalid-feedback').forEach(el => {
                el.style.display = 'none';
            });
        }, 5000);
        
        // Real-time validation for numeric fields
        document.querySelectorAll('input[type="number"]').forEach(input => {
            input.addEventListener('blur', function() {
                if (this.value && isNaN(parseFloat(this.value))) {
                    this.classList.add('is-invalid');
                    this.title = 'Harus berupa angka';
                } else {
                    this.classList.remove('is-invalid');
                    this.title = '';
                }
            });
        });
        
        // Real-time validation for date fields
        document.querySelectorAll('input[type="date"]').forEach(input => {
            input.addEventListener('change', function() {
                const tanggalMasuk = document.querySelector('input[name="tanggalMasuk"]').value;
                const tanggalKalibrasi = document.querySelector('input[name="tanggalKalibrasi"]').value;
                
                if (tanggalMasuk && tanggalKalibrasi && new Date(tanggalMasuk) > new Date(tanggalKalibrasi)) {
                    this.classList.add('is-invalid');
                    this.title = 'Tanggal tidak valid';
                } else {
                    this.classList.remove('is-invalid');
                    this.title = '';
                }
            });
        });
        
        // Highlight required-ish fields (bukan required tapi penting)
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
        document.getElementById('btnTambahForm')?.addEventListener('click', function() {
            const input = document.getElementById('jumlah_form_input');
            if (input) {
                input.value = parseInt(input.value) + 1;
                document.getElementById('formCountBadge').textContent = input.value + ' Form';
                document.getElementById('btnKurangForm').disabled = false;
            }
        });

        document.getElementById('btnKurangForm')?.addEventListener('click', function() {
            const input = document.getElementById('jumlah_form_input');
            if (input && parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
                document.getElementById('formCountBadge').textContent = input.value + ' Form';
                if (parseInt(input.value) <= 1) {
                    this.disabled = true;
                }
            }
        });

        document.getElementById('btnChangeJumlahForm')?.addEventListener('click', function() {
            const count = document.getElementById('jumlah_form_input').value;
            const url = new URL(window.location.href);
            url.searchParams.set('jumlah_form', count);
            window.location.href = url.toString();
        });
    });
</script>
</body>
</html>