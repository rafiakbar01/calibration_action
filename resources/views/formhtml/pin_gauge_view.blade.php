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
        <div class="form-kalibrasi-container">
            <table class="kalibrasi-header-table">
                <tr>
                    <td colspan="2">
                        <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK19</p>
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
                        <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">PIN GAUGE</p>
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
                        <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;">{{ $calibration->headPinGauge->certificate_id ?? 'N/A' }}</p>
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
                        <input type="text" class="kalibrasi-input" value="{{ $calibration->namaAlat }}" readonly>
                    </td>
                </tr>

                <!-- Merek & Kode Alat -->
                <tr>
                    <td>
                        <p style="margin: 0; color: #000000;">Merek</p>
                    </td>
                    <td colspan="3">
                        <div class="d-flex align-items-center">
                            <input type="text" class="kalibrasi-input me-3" value="{{ $calibration->brandAlat }}" readonly style="width: 60%;">
                            <span class="me-3" style="color: #000000;">Kode Alat :</span>
                            <input type="text" class="kalibrasi-input" value="{{ $calibration->kodeAlat }}" readonly style="width: 30%;">
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
                            <input type="text" class="kalibrasi-input me-3" value="{{ $calibration->typeAlat }}" readonly style="width: 45%;">
                            <span class="me-3" style="color: #000000;">/</span>
                            <input type="text" class="kalibrasi-input" value="{{ $calibration->NoSeri }}" readonly style="width: 45%;">
                        </div>
                    </td>
                </tr>

                <tr>
    <td>
        <p style="margin: 0; color: #000000;">Rentang Ukur</p>
    </td>
    <td colspan="3">
        <div class="d-flex align-items-center">
            <!-- Tampilkan nilai Min -->
            <div class="me-3" style="width: 45%;">
                <input type="text" 
                       class="kalibrasi-input" 
                       value="{{ isset($calibration->rangeMin) ? $calibration->rangeMin : '0' }}" 
                       readonly 
                       style="width: 100%;">
            </div>
            
            <span class="me-3" style="color: #000000;">-</span>
            
            <!-- Tampilkan nilai Max -->
            <div style="width: 45%;">
                <input type="text" 
                       class="kalibrasi-input" 
                       value="{{ isset($calibration->rangeMax) ? $calibration->rangeMax : '0' }}" 
                       readonly 
                       style="width: 100%;">
            </div>
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
                            <input type="text" class="kalibrasi-input me-3" value="{{ $calibration->kapasitas }}" readonly style="width: 45%;">
                            <span class="me-3" style="color: #000000;">/</span>
                            <input type="text" class="kalibrasi-input" value="{{ $calibration->resolusi }}" readonly style="width: 45%;">
                        </div>
                    </td>
                </tr>

                <!-- Nama Pemilik -->
                <tr>
                    <td>
                        <p style="margin: 0; color: #000000;">Nama Pemilik</p>
                    </td>
                    <td colspan="3">
                        <input type="text" class="kalibrasi-input" value="{{ $calibration->pemilikAlat }}" readonly>
                    </td>
                </tr>

                <!-- Tanggal -->
                <tr>
                    <td>
                        <p style="margin: 0; color: #000000;">Tanggal Alat Masuk</p>
                    </td>
                    <td colspan="3">
                        <input type="text" class="kalibrasi-input" 
                               value="{{ \Carbon\Carbon::parse($calibration->tanggalMasuk)->format('d/m/Y') }}" readonly>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p style="margin: 0; color: #000000;">Tanggal Kalibrasi</p>
                    </td>
                    <td colspan="3">
                        <div class="d-flex align-items-center">
                            <input type="text" class="kalibrasi-input me-3" 
                               value="{{ \Carbon\Carbon::parse($calibration->tanggalKalibrasi)->format('d/m/Y') }}"
                                readonly style="width: 45%;">
                            <span class="me-3" style="color: #000000;">Jenis Pembacaan:</span>
                            <input type="text" class="kalibrasi-input" 
                                value="{{ $calibration->jenisPembacaan }}" 
                                readonly style="width: 45%;">
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
                                <input class="form-check-input" type="radio" name="tempat_kalibrasi" value="lab.PT PAS" id="lab" 
                                       {{ $calibration->tempatKalibrasi == 'lab.PT PAS' ? 'checked' : '' }} disabled>
                                <label class="form-check-label" for="lab" style="color: #000000;">Lab. PT.PAS</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tempat_kalibrasi" value="insitu" id="insitu" 
                                       {{ $calibration->tempatKalibrasi == 'insitu' ? 'checked' : '' }} disabled>
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
                        <input type="text" class="kalibrasi-input" value="{{ $calibration->lokasiPT }}" readonly>
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
                    {{ $calibration->kondisiAlat == 'ok' ? 'checked' : '' }} disabled>
            </div>
            <div class="text-center">
                <span class="fw-bold d-block mb-2" style="color: #000000; font-size: 14px;">Rusak</span>
                <input type="radio" name="kondisiAlat" value="rusak" class="form-check-input"
                    style="width: 18px; height: 18px; display: block; margin: 0 auto;"
                    {{ $calibration->kondisiAlat == 'rusak' ? 'checked' : '' }} disabled>
            </div>
        </div>
        
        <!-- Keterangan Section -->
        <div class="d-flex align-items-center">
            <span class="fw-bold me-3" style="color: #000000; min-width: 100px;">Keterangan :</span>
            <div style="flex: 1;">
                <input type="text" class="kalibrasi-input" value="{{ $calibration->keterangan ?? '-' }}" readonly 
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
                <td><input type="text" class="kondisi-input" value="{{ $calibration->RT_condition1 ?? '-' }}" readonly></td>
                <td><input type="text" class="kondisi-input" value="{{ $calibration->RT_condition2 ?? '-' }}" readonly></td>
                <td><input type="text" class="kondisi-input" value="{{ $calibration->RT_condition3 ?? '-' }}" readonly></td>
            </tr>
            <tr>
                <td class="bg-light fw-bold" style="color: #000000;">RH (%)</td>
                <td><input type="text" class="kondisi-input" value="{{ $calibration->RH_condition1 ?? '-' }}" readonly></td>
                <td><input type="text" class="kondisi-input" value="{{ $calibration->RH_condition2 ?? '-' }}" readonly></td>
                <td><input type="text" class="kondisi-input" value="{{ $calibration->RH_condition3 ?? '-' }}" readonly></td>
            </tr>
        </table>
    </div>
</div>




    <!-- Data Kalibrasi Section -->
                <div class="data-kalibrasi-header" style="color: #000000;">DATA KALIBRASI</div>
@php
    // Ambil data langsung dari relasi Calibration
    $details = $calibration->detailPinGauges ?? collect();
@endphp

<table cellspacing="0" cellpadding="0" style="width: 100%; border-collapse: collapse; font-family: Arial; margin: 0 auto;">
    <tr>
        <!-- Tabel Kiri (No 1-11) -->
        <td style="vertical-align: top; padding-right: 10px; width: 50%;">
            <table cellspacing="0" cellpadding="0" style="width: 100%; border: 2px solid #000000; border-collapse: collapse;">
                <!-- Header -->
                <tr style="height: 40px;">
                    <td rowspan="2" style="width: 50px; border: 2px solid #000000; background-color: #d9d9d9; text-align: center; vertical-align: middle;">
                        <span style="font-size: 12pt; font-weight: bold;">No</span>
                    </td>
                    <td rowspan="2" style="width: 100px; border: 2px solid #000000; background-color: #d9d9d9; text-align: center; vertical-align: middle;">
                        <span style="font-size: 12pt; font-weight: bold;">Nominal Alat</span>
                    </td>
                    <td style="width: 80px; border: 2px solid #000000; background-color: #d9d9d9; text-align: center; vertical-align: middle;">
                        <span style="font-size: 12pt; font-weight: bold;">Atas</span>
                    </td>
                    <td style="width: 80px; border: 2px solid #000000; background-color: #d9d9d9; text-align: center; vertical-align: middle;">
                        <span style="font-size: 12pt; font-weight: bold;">Tengah</span>
                    </td>
                    <td style="width: 80px; border: 2px solid #000000; background-color: #d9d9d9; text-align: center; vertical-align: middle;">
                        <span style="font-size: 12pt; font-weight: bold;">Bawah</span>
                    </td>
                </tr>
                <tr style="height: 35px;">
                    <td style="width: 80px; border: 2px solid #000000; background-color: #d9d9d9; text-align: center; vertical-align: middle;">
                        <span style="font-size: 11pt; font-weight: bold;">1</span><br>
                        <span style="font-size: 11pt; font-weight: bold;">4</span>
                    </td>
                    <td style="width: 80px; border: 2px solid #000000; background-color: #d9d9d9; text-align: center; vertical-align: middle;">
                        <span style="font-size: 11pt; font-weight: bold;">2</span><br>
                        <span style="font-size: 11pt; font-weight: bold;">5</span>
                    </td>
                    <td style="width: 80px; border: 2px solid #000000; background-color: #d9d9d9; text-align: center; vertical-align: middle;">
                        <span style="font-size: 11pt; font-weight: bold;">3</span><br>
                        <span style="font-size: 11pt; font-weight: bold;">6</span>
                    </td>
                </tr>
                
                @for($i = 1; $i <= 11; $i++)
                    @php
                        $detail = $details->get($i-1) ?? null;
                    @endphp
                    <!-- Baris {{ $i }} -->
                    <tr style="height: 40px;">
                        <td rowspan="2" style="border: 2px solid #000000; text-align: center; vertical-align: middle; background-color: #ffffff;">
                            <span style="font-size: 12pt; font-weight: bold;">{{ $i }}</span>
                        </td>
                        <td rowspan="2" style="border: 2px solid #000000; text-align: center; vertical-align: middle; background-color: #ffffff;">
                            <span style="font-size: 12pt; color: #000000;">
                                @if($detail && $detail->titikUkur !== null)
                                    {{ number_format($detail->titikUkur, 5) }}
                                @else
                                    -
                                @endif
                            </span>
                        </td>
                        <td style="width: 80px; border: 2px solid #000000; text-align: center; vertical-align: middle; background-color: #ffffff;">
                            <span style="font-size: 11pt; color: #000000;">
                                @if($detail && $detail->ulangan1 !== null)
                                    {{ number_format($detail->ulangan1, 5) }}
                                @else
                                    -
                                @endif
                            </span>
                        </td>
                        <td style="width: 80px; border: 2px solid #000000; text-align: center; vertical-align: middle; background-color: #ffffff;">
                            <span style="font-size: 11pt; color: #000000;">
                                @if($detail && $detail->ulangan2 !== null)
                                    {{ number_format($detail->ulangan2, 5) }}
                                @else
                                    -
                                @endif
                            </span>
                        </td>
                        <td style="width: 80px; border: 2px solid #000000; text-align: center; vertical-align: middle; background-color: #ffffff;">
                            <span style="font-size: 11pt; color: #000000;">
                                @if($detail && $detail->ulangan3 !== null)
                                    {{ number_format($detail->ulangan3, 5) }}
                                @else
                                    -
                                @endif
                            </span>
                        </td>
                    </tr>
                    <tr style="height: 40px;">
                        <td style="width: 80px; border: 2px solid #000000; text-align: center; vertical-align: middle; background-color: #ffffff;">
                            <span style="font-size: 11pt; color: #000000;">
                                @if($detail && $detail->ulangan4 !== null)
                                    {{ number_format($detail->ulangan4, 5) }}
                                @else
                                    -
                                @endif
                            </span>
                        </td>
                        <td style="width: 80px; border: 2px solid #000000; text-align: center; vertical-align: middle; background-color: #ffffff;">
                            <span style="font-size: 11pt; color: #000000;">
                                @if($detail && $detail->ulangan5 !== null)
                                    {{ number_format($detail->ulangan5, 5) }}
                                @else
                                    -
                                @endif
                            </span>
                        </td>
                        <td style="width: 80px; border: 2px solid #000000; text-align: center; vertical-align: middle; background-color: #ffffff;">
                            <span style="font-size: 11pt; color: #000000;">
                                @if($detail && $detail->ulangan6 !== null)
                                    {{ number_format($detail->ulangan6, 5) }}
                                @else
                                    -
                                @endif
                            </span>
                        </td>
                    </tr>
                @endfor
            </table>
        </td>
        
        <!-- Tabel Kanan (No 12-22) -->
        <td style="vertical-align: top; width: 50%;">
            <table cellspacing="0" cellpadding="0" style="width: 100%; border: 2px solid #000000; border-collapse: collapse;">
                <!-- Header -->
                <tr style="height: 40px;">
                    <td rowspan="3" style="width: 50px; border: 2px solid #000000; background-color: #d9d9d9; text-align: center; vertical-align: middle;">
                        <span style="font-size: 12pt; font-weight: bold;">No</span>
                    </td>
                    <td rowspan="3" style="width: 100px; border: 2px solid #000000; background-color: #d9d9d9; text-align: center; vertical-align: middle;">
                        <span style="font-size: 12pt; font-weight: bold;">Nominal Alat</span>
                    </td>
                    <td style="width: 80px; border: 2px solid #000000; background-color: #d9d9d9; text-align: center; vertical-align: middle;">
                        <span style="font-size: 12pt; font-weight: bold;">Atas</span>
                    </td>
                    <td style="width: 80px; border: 2px solid #000000; background-color: #d9d9d9; text-align: center; vertical-align: middle;">
                        <span style="font-size: 12pt; font-weight: bold;">Tengah</span>
                    </td>
                    <td style="width: 80px; border: 2px solid #000000; background-color: #d9d9d9; text-align: center; vertical-align: middle;">
                        <span style="font-size: 12pt; font-weight: bold;">Bawah</span>
                    </td>
                </tr>
                <tr style="height: 35px;">
                    <td style="width: 80px; border: 2px solid #000000; background-color: #d9d9d9; text-align: center; vertical-align: middle;">
                        <span style="font-size: 11pt; font-weight: bold;">1</span>
                    </td>
                    <td style="width: 80px; border: 2px solid #000000; background-color: #d9d9d9; text-align: center; vertical-align: middle;">
                        <span style="font-size: 11pt; font-weight: bold;">2</span>
                    </td>
                    <td style="width: 80px; border: 2px solid #000000; background-color: #d9d9d9; text-align: center; vertical-align: middle;">
                        <span style="font-size: 11pt; font-weight: bold;">3</span>
                    </td>
                </tr>
                <tr style="height: 35px;">
                    <td style="width: 80px; border: 2px solid #000000; background-color: #d9d9d9; text-align: center; vertical-align: middle;">
                        <span style="font-size: 11pt; font-weight: bold;">4</span>
                    </td>
                    <td style="width: 80px; border: 2px solid #000000; background-color: #d9d9d9; text-align: center; vertical-align: middle;">
                        <span style="font-size: 11pt; font-weight: bold;">5</span>
                    </td>
                    <td style="width: 80px; border: 2px solid #000000; background-color: #d9d9d9; text-align: center; vertical-align: middle;">
                        <span style="font-size: 11pt; font-weight: bold;">6</span>
                    </td>
                </tr>
                
                @for($i = 12; $i <= 22; $i++)
                    @php
                        $detail = $details->get($i-1) ?? null;
                    @endphp
                    <!-- Baris {{ $i }} -->
                    <tr style="height: 40px;">
                        <td rowspan="2" style="border: 2px solid #000000; text-align: center; vertical-align: middle; background-color: #ffffff;">
                            <span style="font-size: 12pt; font-weight: bold;">{{ $i }}</span>
                        </td>
                        <td rowspan="2" style="border: 2px solid #000000; text-align: center; vertical-align: middle; background-color: #ffffff;">
                            <span style="font-size: 12pt; color: #000000;">
                                @if($detail && $detail->titikUkur !== null)
                                    {{ number_format($detail->titikUkur, 5) }}
                                @else
                                    -
                                @endif
                            </span>
                        </td>
                        <td style="width: 80px; border: 2px solid #000000; text-align: center; vertical-align: middle; background-color: #ffffff;">
                            <span style="font-size: 11pt; color: #000000;">
                                @if($detail && $detail->ulangan1 !== null)
                                    {{ number_format($detail->ulangan1, 5) }}
                                @else
                                    -
                                @endif
                            </span>
                        </td>
                        <td style="width: 80px; border: 2px solid #000000; text-align: center; vertical-align: middle; background-color: #ffffff;">
                            <span style="font-size: 11pt; color: #000000;">
                                @if($detail && $detail->ulangan2 !== null)
                                    {{ number_format($detail->ulangan2, 5) }}
                                @else
                                    -
                                @endif
                            </span>
                        </td>
                        <td style="width: 80px; border: 2px solid #000000; text-align: center; vertical-align: middle; background-color: #ffffff;">
                            <span style="font-size: 11pt; color: #000000;">
                                @if($detail && $detail->ulangan3 !== null)
                                    {{ number_format($detail->ulangan3, 5) }}
                                @else
                                    -
                                @endif
                            </span>
                        </td>
                    </tr>
                    <tr style="height: 40px;">
                        <td style="width: 80px; border: 2px solid #000000; text-align: center; vertical-align: middle; background-color: #ffffff;">
                            <span style="font-size: 11pt; color: #000000;">
                                @if($detail && $detail->ulangan4 !== null)
                                    {{ number_format($detail->ulangan4, 5) }}
                                @else
                                    -
                                @endif
                            </span>
                        </td>
                        <td style="width: 80px; border: 2px solid #000000; text-align: center; vertical-align: middle; background-color: #ffffff;">
                            <span style="font-size: 11pt; color: #000000;">
                                @if($detail && $detail->ulangan5 !== null)
                                    {{ number_format($detail->ulangan5, 5) }}
                                @else
                                    -
                                @endif
                            </span>
                        </td>
                        <td style="width: 80px; border: 2px solid #000000; text-align: center; vertical-align: middle; background-color: #ffffff;">
                            <span style="font-size: 11pt; color: #000000;">
                                @if($detail && $detail->ulangan6 !== null)
                                    {{ number_format($detail->ulangan6, 5) }}
                                @else
                                    -
                                @endif
                            </span>
                        </td>
                    </tr>
                @endfor
            </table>
        </td>
    </tr>
</table>



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
</style>
<table cellspacing="0" cellpadding="0" style="width: 100%; border: 1px solid #000000; border-collapse: collapse; font-family: Arial; margin: 20px auto 0;">
    <!-- Baris 1: Judul -->
    <tr style="height: 30px;">
        <td colspan="4" style="border: 1px solid #000000; text-align: center; vertical-align: middle; padding: 5px; background-color: #f0f0f0;">
            <span style="font-size: 11pt; font-weight: bold;">
                Isilah lembar data kalibrasi dengan lengkap dan jelas!
            </span>
        </td>
    </tr>
    
    <!-- Baris 2: Data peralatan dan penanggung jawab -->
    <tr style="height: 40px;">
        <td rowspan="2" style="width: 15%; border: 1px solid #000000; vertical-align: middle; padding: 5px; background-color: #f9f9f9;">
            <span style="font-size: 9pt; font-weight: bold;">Standard</span>
        </td>
        <td style="width: 40%; border: 1px solid #000000; text-align: left; vertical-align: middle; padding: 5px;">
            @php
                // Ambil data alat standar dari head atau calibration
                $alatStandar = $calibration->headPinGauge->standard ?? '';
                $alatStandarArray = explode(", ", $alatStandar);
            @endphp
            <div style="display: flex; align-items: center; justify-content: flex-start; gap: 10px;">
                <input type="checkbox" 
                       style="width: 18px; height: 18px; cursor: default; accent-color: #000000; transform: scale(1.2);" 
                       @if(in_array('Digital Micrometer 0~25mm', $alatStandarArray) || strpos($alatStandar, 'Digital Micrometer') !== false) checked @endif
                       disabled>
                <label style="font-size: 9pt; color: #000000; cursor: default; font-weight: 500;">
                    Digital Micrometer 0~25mm
                </label>
            </div>
        </td>
        <td style="width: 22.5%; border: 1px solid #000000; text-align: center; vertical-align: middle; padding: 5px; background-color: #f9f9f9;">
            <span style="font-size: 9pt; font-weight: bold;">Dikalibrasi oleh</span>
        </td>
        <td style="width: 22.5%; border: 1px solid #000000; text-align: center; vertical-align: middle; padding: 5px; background-color: #f9f9f9;">
            <span style="font-size: 9pt; font-weight: bold;">Diperiksa oleh</span>
        </td>
    </tr>
    
    <!-- Baris 3: Lanjutan data dan input nama -->
    <tr style="height: 40px;">
        <td style="border: 1px solid #000000; text-align: left; vertical-align: middle; padding: 5px;">
            <div style="display: flex; align-items: center; justify-content: flex-start; gap: 10px;">
                <input type="checkbox" 
                       style="width: 18px; height: 18px; cursor: default; accent-color: #000000; transform: scale(1.2);" 
                       @if(in_array('Mesin ULM 01-600D', $alatStandarArray) || strpos($alatStandar, 'Mesin ULM') !== false) checked @endif
                       disabled>
                <label style="font-size: 9pt; color: #000000; cursor: default; font-weight: 500;">
                    Mesin ULM 01-600D
                </label>
            </div>
        </td>
        <td rowspan="2" style="border: 1px solid #000000; vertical-align: middle; padding: 5px;">
            <div style="margin-bottom: 5px;">
                <span style="font-size: 9pt; font-weight: bold;">Nama:</span>
            </div>
            <div style="width: 95%; height: 25px; border: 1px solid #ddd; font-size: 9pt; padding: 2px; display: flex; align-items: center;">
                <span style="color: #000000; font-weight: 500;">
                    {{ $calibration->calibratedBy ?? '-' }}
                </span>
            </div>
        </td>
        <td rowspan="2" style="border: 1px solid #000000; vertical-align: middle; padding: 5px;">
            <div style="margin-bottom: 5px;">
                <span style="font-size: 9pt; font-weight: bold;">Nama:</span>
            </div>
            <div style="width: 95%; height: 25px; border: 1px solid #ddd; font-size: 9pt; padding: 2px; display: flex; align-items: center;">
                <span style="color: #000000; font-weight: 500;">
                    {{ $calibration->verifiedBy ?? '-' }}
                </span>
            </div>
        </td>
    </tr>
    
    <!-- Baris 4: Metode kalibrasi -->
    <tr style="height: 40px;">
        <td style="border: 1px solid #000000; vertical-align: middle; padding: 5px; background-color: #f9f9f9;">
            <span style="font-size: 9pt; font-weight: bold;">Metode Kalibrasi</span>
        </td>
        <td style="border: 1px solid #000000; text-align: left; vertical-align: middle; padding: 5px;">
            <span style="font-size: 9pt; color: #000000; font-weight: 500;">
                {{ $calibration->headPinGauge->calibrationMethod ?? 'PAS-IK1102-19' }}
            </span>
        </td>
    </tr>
</table>
 <!-- Action Buttons Section -->
            <div class="row mt-5">
                <div class="col-12 text-center">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary btn-lg" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                    
                    <button onclick="window.print()" class="btn btn-primary btn-lg ms-3" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
                        <i class="fas fa-print me-2"></i>Cetak
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>