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
    $jumlahForm = $calibration->headUltrasonicThicknessGauges->count() > 0 ? $calibration->headUltrasonicThicknessGauges->count() : 1;
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
        $head = $calibration->{'headUltrasonicThicknessGaugeForm' . $formIndex};
        $formDetails = $calibration->detailUltrasonicThicknessGauges->where('form_index', $formIndex)->sortBy('id');
        $isFirstForm = ($formIndex == 1);
        
        $form1Head = $calibration->headUltrasonicThicknessGaugeForm1;
    @endphp
    
    @if($jumlahForm > 1)
    <div class="card mb-4" style="border: 2px solid #3b82f6; border-radius: 8px;">
        <div class="card-header" style="background: linear-gradient(135deg, #1e40af, #3b82f6); color: white;">
            <i class="fas fa-file-alt me-2"></i>Ultrasonic Thickness Gauge ke-{{ $formIndex }}
            @if(!$isFirstForm)
                <small class="ms-2">(Data alat mengikuti form 1)</small>
            @endif
        </div>
        <div class="card-body">
    @endif
    
    <div class="form-kalibrasi-container" id="form-container-{{ $formIndex }}" data-form-index="{{ $formIndex }}">
            <table class="kalibrasi-header-table">
                <tr>
                    <td colspan="2">
                        <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK59</p>
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
                        <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">ULTRASONIC TICHKNESS GAUGE</p>
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

            <!-- Main Form Section - Readonly -->
            <table class="kalibrasi-main-table">
                <!-- Nama Alat -->
                <tr>
        <td style="width: 20%;">
            <p style="margin: 0; color: #000000;">Nama Alat</p>
        </td>
        <td colspan="3">
            @if($isFirstForm)
                                    <input type="text" name="nama_alat" class="kalibrasi-input"  >
                                @else
                                    <input type="text" name="nama_alat_display" class="kalibrasi-input disabled-field" value="Mengikuti Form 1" style=" background-color: #e9ecef;" readonly disabled>
                                @endifnamaAlat) }}" {{ !$isFirstForm ? 'readonly' : '' }}>
        </td>
    </tr>

               <!-- Merek & Kode Alat -->
    <tr>
        <td>
            <p style="margin: 0; color: #000000;">Merek</p>
        </td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                @if($isFirstForm)
                                    <input type="text" name="merek" class="kalibrasi-input me-3"  >
                                @else
                                    <input type="text" name="merek_display" class="kalibrasi-input me-3 disabled-field" value="Mengikuti Form 1" style=" background-color: #e9ecef;" readonly disabled>
                                @endifbrandAlat) }}" style="width:60%;">
                <span class="me-3" style="color:#000000;">Kode Alat :</span>
                @if($isFirstForm)
                                    <input type="text" name="kode_alat" class="kalibrasi-input"  >
                                @else
                                    <input type="text" name="kode_alat_display" class="kalibrasi-input disabled-field" value="Mengikuti Form 1" style=" background-color: #e9ecef;" readonly disabled>
                                @endifkodeAlat) }}" style="width:30%;">
            </div>
        </td>
    </tr>

    <!-- Type / No. Seri -->
    <tr>
        <td>
            <p style="margin: 0; color: #000000;">Type / No. Seri</p>
        </td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                @if($isFirstForm)
                                    <input type="text" name="type_alat" class="kalibrasi-input me-3"  >
                                @else
                                    <input type="text" name="type_alat_display" class="kalibrasi-input me-3 disabled-field" value="Mengikuti Form 1" style=" background-color: #e9ecef;" readonly disabled>
                                @endiftypeAlat) }}" style="width:45%;">
                <span class="me-3" style="color:#000000;">/</span>
                @if($isFirstForm)
                                    <input type="text" name="no_seri" class="kalibrasi-input"  >
                                @else
                                    <input type="text" name="no_seri_display" class="kalibrasi-input disabled-field" value="Mengikuti Form 1" style=" background-color: #e9ecef;" readonly disabled>
                                @endifNoSeri) }}" {{ !$isFirstForm ? 'readonly' : '' }} style="width:45%;">
            </div>
        </td>
    </tr>

    <!-- Rentang Ukur -->
    <!--<tr>-->
    <!--    <td>-->
    <!--        <p style="margin: 0; color: #000000;">Rentang Ukur</p>-->
    <!--    </td>-->
    <!--    <td colspan="3">-->
    <!--        <div class="d-flex align-items-center">-->
    <!--            <div class="me-3" style="width:45%;">-->
    <!--                <input type="text" name="rangeMin" class="kalibrasi-input"-->
    <!--                       value="{{ old('rangeMin', $calibration->rangeMin ?? 0) }}">-->
    <!--            </div>-->
    <!--            <span class="me-3">-</span>-->
    <!--            <div style="width:45%;">-->
    <!--                <input type="text" name="rangeMax" class="kalibrasi-input"-->
    <!--                       value="{{ old('rangeMax', $calibration->rangeMax ?? 0) }}">-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </td>-->
    <!--</tr>-->

    <!-- Kapasitas / Resolusi -->
    <tr>
        <td><p style="margin:0;">Kapasitas / Resolusi</p></td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                @if($isFirstForm)
                                    <input type="text" name="kapasitas" class="kalibrasi-input me-3"  >
                                @else
                                    <input type="text" name="kapasitas_display" class="kalibrasi-input me-3 disabled-field" value="Mengikuti Form 1" style=" background-color: #e9ecef;" readonly disabled>
                                @endifkapasitas) }}" {{ !$isFirstForm ? 'readonly' : '' }} style="width:45%;">
                <span class="me-3">/</span>
                @if($isFirstForm)
                                    <input type="text" name="resolusi" class="kalibrasi-input"  >
                                @else
                                    <input type="text" name="resolusi_display" class="kalibrasi-input disabled-field" value="Mengikuti Form 1" style=" background-color: #e9ecef;" readonly disabled>
                                @endifresolusi) }}" {{ !$isFirstForm ? 'readonly' : '' }} style="width:45%;">
            </div>
        </td>
    </tr>

    <!-- Nama Pemilik -->
    <tr>
        <td><p style="margin:0;">Nama Pemilik</p></td>
        <td colspan="3">
            @if($isFirstForm)
                                    <input type="text" name="nama_pemilik" class="kalibrasi-input"  >
                                @else
                                    <input type="text" name="nama_pemilik_display" class="kalibrasi-input disabled-field" value="Mengikuti Form 1" style=" background-color: #e9ecef;" readonly disabled>
                                @endifpemilikAlat) }}">
        </td>
    </tr>

    <!-- Tanggal -->
      <tr>
        <td><p style="margin:0;color:#000;">Tanggal Alat Masuk</p></td>
        <td colspan="3">
            @if($isFirstForm)
                                    <input type="date" name="tanggal_alat_masuk" class="kalibrasi-input"  >
                                @else
                                    <input type="date" name="tanggal_alat_masuk_display" class="kalibrasi-input disabled-field" value="Mengikuti Form 1" style=" background-color: #e9ecef;" readonly disabled>
                                @endiftanggalMasuk)->format('Y-m-d')) }}">
        </td>
    </tr>

    <tr>
        <td><p style="margin:0;">Tanggal Kalibrasi</p></td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                @if($isFirstForm)
                                    <input type="date" name="tanggal_kalibrasi" class="kalibrasi-input me-3"  >
                                @else
                                    <input type="date" name="tanggal_kalibrasi_display" class="kalibrasi-input me-3 disabled-field" value="Mengikuti Form 1" style=" background-color: #e9ecef;" readonly disabled>
                                @endiftanggalKalibrasi) }}" style="width:45%;">
                <span class="me-3">Jenis Pembacaan:</span>
                @if($isFirstForm)
                                    <input type="text" name="jenis_pembacaan" class="kalibrasi-input"  >
                                @else
                                    <input type="text" name="jenis_pembacaan_display" class="kalibrasi-input disabled-field" value="Mengikuti Form 1" style=" background-color: #e9ecef;" readonly disabled>
                                @endifjenisPembacaan) }}" style="width:45%;">
            </div>
        </td>
    </tr>

    <!-- Tempat Kalibrasi -->
    <tr>
        <td><p style="margin:0;">Tempat Kalibrasi</p></td>
        <td colspan="3">
            <div class="d-flex">
                <div class="form-check me-5">
                    @if($isFirstForm)
                                    <input class="form-check-input" type="radio" name="tempat_kalibrasi" value="lab.PT PAS" >
                                @else
                                    <input class="form-check-input" type="radio" name="tempat_kalibrasi_display" value="lab.PT PAS" disabled>
                                @endiftempatKalibrasi == 'lab.PT PAS' ? 'checked' : '' }}>
                    <label class="form-check-label">Lab. PT.PAS</label>
                </div>
                <div class="form-check">
                    @if($isFirstForm)
                                    <input class="form-check-input" type="radio" name="tempat_kalibrasi" value="insitu" >
                                @else
                                    <input class="form-check-input" type="radio" name="tempat_kalibrasi_display" value="insitu" disabled>
                                @endiftempatKalibrasi == 'insitu' ? 'checked' : '' }}>
                    <label class="form-check-label">Insitu</label>
                </div>
            </div>
        </td>
    </tr>

    <!-- Lokasi -->
    <tr>
        <td><p style="margin:0;">Lokasi PT</p></td>
        <td colspan="3">
            @if($isFirstForm)
                                    <input type="text" name="lokasi_pt" class="kalibrasi-input"  >
                                @else
                                    <input type="text" name="lokasi_pt_display" class="kalibrasi-input disabled-field" value="Mengikuti Form 1" style=" background-color: #e9ecef;" readonly disabled>
                                @endiflokasiPT) }}">
        </td>
    </tr>
</table>


           <div class="row mt-4">

<!-- Fungsi Komponen Lainnya -->
<div class="col-md-6 mb-4">
    <div class="kalibrasi-section-header" style="color: #000000;">Fungsi Komponen Lainnya</div>
    
    <div class="d-flex justify-content-center align-items-center mb-4" style="gap: 60px;">
        <div class="text-center">
            <span class="fw-bold d-block mb-2" style="color: #000000; font-size: 14px;">Ok</span>
            @if($isFirstForm)
                                    <input class="form-check-input" type="radio" name="fungsi_komponen" value="ok" >
                                @else
                                    <input class="form-check-input" type="radio" name="fungsi_komponen_display" value="ok" disabled>
                                @endifkondisiAlat) == 'ok' ? 'checked' : '' }}>
        </div>
        <div class="text-center">
            <span class="fw-bold d-block mb-2" style="color: #000000; font-size: 14px;">Rusak</span>
            @if($isFirstForm)
                                    <input class="form-check-input" type="radio" name="fungsi_komponen" value="rusak" >
                                @else
                                    <input class="form-check-input" type="radio" name="fungsi_komponen_display" value="rusak" disabled>
                                @endifkondisiAlat) == 'rusak' ? 'checked' : '' }}>
        </div>
    </div>
    
    <div class="d-flex align-items-center">
        <span class="fw-bold me-3" style="color:#000; min-width:100px;">Keterangan :</span>
        <div style="flex:1;">
            @if($isFirstForm)
                                    <input type="text" name="keterangan_fungsi_komponen" class="kalibrasi-input"  >
                                @else
                                    <input type="text" name="keterangan_fungsi_komponen_display" class="kalibrasi-input disabled-field" value="Mengikuti Form 1" style=" background-color: #e9ecef;" readonly disabled>
                                @endifketerangan) }}"
                style="border:none;border-bottom:2px solid #000;border-radius:0;padding:4px 0;background:transparent;width:100%;">
        </div>
    </div>
</div>

<!-- Kondisi Kalibrasi -->
<div class="col-md-6 mb-4">
    <div class="kalibrasi-section-header" style="color: #000000;">Kondisi Kalibrasi</div>
    
    <table class="table table-bordered">
        <tr>
            <td class="table-secondary fw-bold" style="width:30%;"></td>
            <td class="table-secondary fw-bold text-center">Awal</td>
            <td class="table-secondary fw-bold text-center">Tengah</td>
            <td class="table-secondary fw-bold text-center">Akhir</td>
        </tr>
        <tr>
            <td class="bg-light fw-bold">Suhu (&deg;C)</td>
            <td>@if($isFirstForm)
                                    <input type="text" name="suhu_awal" class="kondisi-input"  >
                                @else
                                    <input type="text" name="suhu_awal_display" class="kondisi-input disabled-field" value="Mengikuti Form 1" style=" background-color: #e9ecef;" readonly disabled>
                                @endifRT_condition1) }}"></td>
            <td>@if($isFirstForm)
                                    <input type="text" name="suhu_tengah" class="kondisi-input"  >
                                @else
                                    <input type="text" name="suhu_tengah_display" class="kondisi-input disabled-field" value="Mengikuti Form 1" style=" background-color: #e9ecef;" readonly disabled>
                                @endifRT_condition2) }}"></td>
            <td>@if($isFirstForm)
                                    <input type="text" name="suhu_akhir" class="kondisi-input"  >
                                @else
                                    <input type="text" name="suhu_akhir_display" class="kondisi-input disabled-field" value="Mengikuti Form 1" style=" background-color: #e9ecef;" readonly disabled>
                                @endifRT_condition3) }}"></td>
        </tr>
        <tr>
            <td class="bg-light fw-bold">RH (%)</td>
            <td><input type="text" name="RH_condition1" class="kondisi-input"
                value="{{ old('RH_condition1', $calibration->RH_condition1) }}"></td>
            <td><input type="text" name="RH_condition2" class="kondisi-input"
                value="{{ old('RH_condition2', $calibration->RH_condition2) }}"></td>
            <td><input type="text" name="RH_condition3" class="kondisi-input"
                value="{{ old('RH_condition3', $calibration->RH_condition3) }}"></td>
        </tr>
    </table>
</div>

</div>

            <!-- Data Kalibrasi Section -->
<div class="data-kalibrasi-header" style="color: #000000;">DATA KALIBRASI</div>

<div class="mb-3">
    <span style="font-size: 16px; font-weight: bold; color: #000000;">Uji Skala Nominal</span>
</div>

<table class="kalibrasi-data-table" cellspacing="0" cellpadding="0" style="width:100%; border-collapse:collapse; border:2px solid #000;">
    <tr style="background: #d9d9d9;">
        <td style="width: 20%; border:2px solid #000; padding:8px;">
            <span style="font-weight: bold; color: #000000;">Nilai Nominal</span>
        </td>
        <td colspan="5" style="border:2px solid #000; padding:8px;">
            <span style="font-weight: bold; color: #000000;">Penunjukan Alat</span>
        </td>
    </tr>
    <tr style="background: #e8e8e8;">
        <td style="border:2px solid #000; padding:8px;">
            <div style="display: flex; align-items: center; justify-content: center; gap: 5px;">
                <span style="font-weight: bold; color: #000000;">Unit (</span>
                <input type="text" 
                       name="form_{{ $formIndex }}_satuan_unit" 
                       value="{{ $calibration->headUltrasonicThicknessGauge->satuan_unit ?? '' }}"
                       style="width: 60px; padding: 4px 0; border: none; border-bottom: 1px solid #000; text-align: center; font-weight: bold; background: transparent;">
                <span style="font-weight: bold; color: #000000;">)</span>
            </div>
        </div>
        <td style="width: 16%; border:2px solid #000; padding:8px;"><span style="font-weight: bold; color: #000000;">1</span></td>
        <td style="width: 16%; border:2px solid #000; padding:8px;"><span style="font-weight: bold; color: #000000;">2</span></td>
        <td style="width: 16%; border:2px solid #000; padding:8px;"><span style="font-weight: bold; color: #000000;">3</span></td>
        <td style="width: 16%; border:2px solid #000; padding:8px;"><span style="font-weight: bold; color: #000000;">4</span></td>
        <td style="width: 16%; border:2px solid #000; padding:8px;"><span style="font-weight: bold; color: #000000;">5</span></td>
    </tr>

    <?php 
    // Ambil data atau buat array kosong untuk 15 baris
    $details = $calibration->detailUltrasonicThicknessGauges ?? collect();
    $totalRows = 15; // Tampilkan 15 baris tetap
    ?>
    
    @for($i = 0; $i < $totalRows; $i++)
    @php
        $rowNumber = $i + 1;
        $detail = isset($details[$i]) ? $details[$i] : null;
    @endphp
    <tr style="height:21.3pt;">
        <!-- Kolom 1: Nilai Nominal - name="form_{{ $formIndex }}_nominal_1", "nominal_2", dst -->
        <td style="border:2px solid #000; padding:0; text-align:center; vertical-align:middle;">
            <input type="text" 
                   name="nominal_{{ $rowNumber }}"
                   value="{{ $detail->nominalSTD ?? '' }}"
                   style="display:inline-block; width:100%; height:100%; padding:2px; font-size:10pt; color:#000; border:none; text-align:center; background:transparent;">
         </div>

        <!-- Kolom 2: Penunjukan Alat 1 - name="form_{{ $formIndex }}_penunjukan_1_1", "penunjukan_2_1", dst -->
        <td style="border:2px solid #000; padding:0; text-align:center; vertical-align:middle;">
            <input type="text" 
                   name="penunjukan_{{ $rowNumber }}_1"
                   value="{{ $detail->ulangan01 ?? '' }}"
                   style="display:inline-block; width:100%; height:100%; padding:2px; font-size:10pt; color:#000; border:none; text-align:center; background:transparent;">
         </div>

        <!-- Kolom 3: Penunjukan Alat 2 - name="form_{{ $formIndex }}_penunjukan_1_2", "penunjukan_2_2", dst -->
        <td style="border:2px solid #000; padding:0; text-align:center; vertical-align:middle;">
            <input type="text" 
                   name="penunjukan_{{ $rowNumber }}_2"
                   value="{{ $detail->ulangan02 ?? '' }}"
                   style="display:inline-block; width:100%; height:100%; padding:2px; font-size:10pt; color:#000; border:none; text-align:center; background:transparent;">
         </div>

        <!-- Kolom 4: Penunjukan Alat 3 - name="form_{{ $formIndex }}_penunjukan_1_3", "penunjukan_2_3", dst -->
        <td style="border:2px solid #000; padding:0; text-align:center; vertical-align:middle;">
            <input type="text" 
                   name="penunjukan_{{ $rowNumber }}_3"
                   value="{{ $detail->ulangan03 ?? '' }}"
                   style="display:inline-block; width:100%; height:100%; padding:2px; font-size:10pt; color:#000; border:none; text-align:center; background:transparent;">
         </div>

        <!-- Kolom 5: Penunjukan Alat 4 - name="form_{{ $formIndex }}_penunjukan_1_4", "penunjukan_2_4", dst -->
        <td style="border:2px solid #000; padding:0; text-align:center; vertical-align:middle;">
            <input type="text" 
                   name="penunjukan_{{ $rowNumber }}_4"
                   value="{{ $detail->ulangan04 ?? '' }}"
                   style="display:inline-block; width:100%; height:100%; padding:2px; font-size:10pt; color:#000; border:none; text-align:center; background:transparent;">
         </div>

        <!-- Kolom 6: Penunjukan Alat 5 - name="form_{{ $formIndex }}_penunjukan_1_5", "penunjukan_2_5", dst -->
        <td style="border:2px solid #000; padding:0; text-align:center; vertical-align:middle;">
            <input type="text" 
                   name="penunjukan_{{ $rowNumber }}_5"
                   value="{{ $detail->ulangan05 ?? '' }}"
                   style="display:inline-block; width:100%; height:100%; padding:2px; font-size:10pt; color:#000; border:none; text-align:center; background:transparent;">
         </div>
    </tr>
    @endfor
</table>

<table cellspacing="0" cellpadding="5" style="width:100%; border-collapse:collapse; font-size:12pt;">
    <tr>
        <td colspan="4" style="border:1px solid #000; text-align:center; font-weight:bold;">
            Data telah diisi dengan lengkap dan jelas!
        </td>
    </tr>

    <tr>
        <td style="border:1px solid #000; width:20%;text-align:center;">Alat Standar</td>
        <td style="border:1px solid #000; width:30%;">
            {{ $calibration->headUltrasonicThicknessGauge->standard ?? 'Gauge Block Set Grade 0' }}
        </td>
        <td style="border:1px solid #000; width:25%; text-align:center;">Dikalibrasi oleh</td>
        <td style="border:1px solid #000; width:25%; text-align:center;">Diperiksa oleh</td>
    </tr>

    <tr>
        <td style="border:1px solid #000;text-align:center;">Metode Kalibrasi</td>
        <td style="border:1px solid #000;">
            {{ $calibration->headUltrasonicThicknessGauge->calibrationMethod ?? 'PAS-IK1102-21' }}
        </td>

        <!-- Dikalibrasi oleh -->
       <!-- Calibrated By -->
<td style="border:1px solid #000; vertical-align:top; padding:4px;">
    TTD:<br><br><br>
    Nama: 
    @if($isFirstForm)
                                    <input type="text" name="calibrated_by" class="kalibrasi-input"  >
                                @else
                                    <input type="text" name="calibrated_by_display" class="kalibrasi-input disabled-field" value="Mengikuti Form 1" style=" background-color: #e9ecef;" readonly disabled>
                                @endifcalibratedBy ?? '' }}" 
           style="width:100%; border:none; background:transparent; font-size:10pt;">
</td>

<!-- Verified By -->
<td style="border:1px solid #000; vertical-align:top; padding:4px;">
    TTD:<br><br><br>
    Nama: 
    @if($isFirstForm)
                                    <input type="text" name="verified_by" class="kalibrasi-input"  >
                                @else
                                    <input type="text" name="verified_by_display" class="kalibrasi-input disabled-field" value="Mengikuti Form 1" style=" background-color: #e9ecef;" readonly disabled>
                                @endifverifiedBy ?? '' }}" 
           style="width:100%; border:none; background:transparent; font-size:10pt;">
</td>
    </tr>
</table>

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
            const kondisiAlat = document.querySelector('input[name="kondisiAlat"]:checked');
            if (!kondisiAlat) {
                isValid = false;
                errorMessage += 'Pilih kondisi alat (Ok/Rusak)\n';
            }
            
            // Check tempat kalibrasi
            const tempatKalibrasi = document.querySelector('input[name="tempatKalibrasi"]:checked');
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
        const kondisiAlatSelected = document.querySelector('input[name="kondisiAlat"]:checked');
        console.log('🎚️ Kondisi alat selected:', kondisiAlatSelected ? kondisiAlatSelected.value : 'none');
        
        // Log tempat kalibrasi radio
        const tempatKalibrasiSelected = document.querySelector('input[name="tempatKalibrasi"]:checked');
        console.log('📍 Tempat kalibrasi selected:', tempatKalibrasiSelected ? tempatKalibrasiSelected.value : 'none');
        
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
            const tempatSection = document.querySelector('input[name="tempatKalibrasi"]').closest('tr');
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
    });
</script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

