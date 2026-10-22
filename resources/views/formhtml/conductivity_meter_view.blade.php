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
    @php
        $jumlahForm = $calibration->jumlah_form ?? 1;
        $jumlahForm = max(1, (int)$jumlahForm);
    @endphp

    <div class="container my-4">
        @for($formIndex = 1; $formIndex <= $jumlahForm; $formIndex++)
            @php
                $headData = $calibration->{'headConductivityMeterForm' . $formIndex} ?? \App\Models\HeadConductivityMeter::where('calibration_id', $calibration->id)->where('form_index', $formIndex)->first() ?? $calibration->headConductivityMeter;
                $details = $calibration->detailConductivityMeters->where('form_index', $formIndex)->sortBy('id')->values();
                if ($details->count() == 0 && $formIndex == 1) {
                    $details = \App\Models\DetailConductivityMeter::where('calibration_id', $calibration->id)->orderBy('id')->get();
                }
            @endphp

            @if($jumlahForm > 1)
            <div style="background: linear-gradient(135deg,#1e40af,#3b82f6); color:#fff; padding:10px 20px; margin: 16px 0 0; border-radius:8px 8px 0 0; font-weight:bold; font-size:16px;">
                <i class="fas fa-file-alt" style="margin-right:8px;"></i>Form Conductivity Meter ke-{{ $formIndex }}
            </div>
            @endif

            <div class="form-kalibrasi-container" style="@if($jumlahForm > 1) border: 2px solid #3b82f6; border-radius: 0 0 8px 8px; padding: 20px; margin-bottom: 30px; @endif">
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

<!--                <tr>-->
<!--    <td>-->
<!--        <p style="margin: 0; color: #000000;">Rentang Ukur</p>-->
<!--    </td>-->
<!--    <td colspan="3">-->
<!--        <div class="d-flex align-items-center">-->
            <!-- Tampilkan nilai Min -->
<!--            <div class="me-3" style="width: 45%;">-->
<!--                <input type="text" -->
<!--                       class="kalibrasi-input" -->
<!--                       value="{{ isset($calibration->rangeMin) ? $calibration->rangeMin : '0' }}" -->
<!--                       readonly -->
<!--                       style="width: 100%;">-->
<!--            </div>-->
            
<!--            <span class="me-3" style="color: #000000;">-</span>-->
            
            <!-- Tampilkan nilai Max -->
<!--            <div style="width: 45%;">-->
<!--                <input type="text" -->
<!--                       class="kalibrasi-input" -->
<!--                       value="{{ isset($calibration->rangeMax) ? $calibration->rangeMax : '0' }}" -->
<!--                       readonly -->
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
                            <input type="text" class="kalibrasi-input me-3" value="{{ $headData->kapasitas ?? $calibration->kapasitas }}" readonly style="width: 45%;">
                            <span class="me-3" style="color: #000000;">/</span>
                            <input type="text" class="kalibrasi-input" value="{{ $headData->resolusi ?? $calibration->resolusi }}" readonly style="width: 45%;">
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
                        @php
                            $valTempatView = $headData->tempat_kalibrasi ?? $calibration->tempatKalibrasi ?? 'lab.PT PAS';
                            if (empty($valTempatView)) { $valTempatView = 'lab.PT PAS'; }
                        @endphp
                        <div class="d-flex">
                            <div class="form-check me-5">
                                <input class="form-check-input" type="radio" name="tempat_kalibrasi_{{ $formIndex }}" value="lab.PT PAS" id="lab_{{ $formIndex }}" 
                                       {{ $valTempatView == 'lab.PT PAS' ? 'checked' : '' }} disabled>
                                <label class="form-check-label" for="lab_{{ $formIndex }}" style="color: #000000;">Lab. PT.PAS</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tempat_kalibrasi_{{ $formIndex }}" value="insitu" id="insitu_{{ $formIndex }}" 
                                       {{ $valTempatView == 'insitu' ? 'checked' : '' }} disabled>
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
                        <input type="text" class="kalibrasi-input" value="{{ $calibration->lokasiPT }}" readonly>
                    </td>
                </tr>
                  <tr>
                    <td>
                        <p style="margin: 0; color: #000000;">Kode TH</p>
                    </td>
                    <td colspan="3">
                        <input type="text" class="kalibrasi-input" value="{{ $calibration->kode_th }}" readonly>
                    </td>
                </tr>
            </table>

            <!-- Fungsi Komponen Lainnya & Kondisi Kalibrasi -->
            <div class="row mt-4">
    <!-- Fungsi Komponen Lainnya -->
    <div class="col-md-6 mb-4">
        <div class="kalibrasi-section-header" style="color: #000000;">Fungsi Komponen Lainnya</div>
        
        @php
            $valKondisiView = $headData->kondisiAlat ?? $headData->kondisi_fungsi_komponen ?? $calibration->kondisiAlat ?? 'ok';
            if (empty($valKondisiView)) { $valKondisiView = 'ok'; }
        @endphp
        <!-- Radio Button Section - Text di atas, radio di bawah -->
        <div class="d-flex justify-content-center align-items-center mb-4" style="gap: 60px;">
            <div class="text-center">
                <span class="fw-bold d-block mb-2" style="color: #000000; font-size: 14px;">Ok</span>
                <input type="radio" name="kondisiAlat_{{ $formIndex }}" value="ok" class="form-check-input" 
                    style="width: 18px; height: 18px; display: block; margin: 0 auto;"
                    {{ $valKondisiView == 'ok' ? 'checked' : '' }} disabled>
            </div>
            <div class="text-center">
                <span class="fw-bold d-block mb-2" style="color: #000000; font-size: 14px;">Rusak</span>
                <input type="radio" name="kondisiAlat_{{ $formIndex }}" value="rusak" class="form-check-input"
                    style="width: 18px; height: 18px; display: block; margin: 0 auto;"
                    {{ $valKondisiView == 'rusak' ? 'checked' : '' }} disabled>
            </div>
        </div>
        <!-- Keterangan Section -->
        <div class="d-flex align-items-center">
            <span class="fw-bold me-3" style="color: #000000; min-width: 100px;">Keterangan :</span>
            <div style="flex: 1;">
                <input type="text" class="kalibrasi-input" value="{{ $headData->keterangan_fungsi_komponen ?? $headData->keterangan ?? $calibration->keterangan ?? '-' }}" readonly 
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

       <table cellspacing="0" cellpadding="0" class="TableNormal" style="margin-left:3.48pt; border:1pt solid #000000; -aw-border-insideh:1pt solid #000000; -aw-border-insidev:1pt solid #000000; border-collapse:collapse; font-size:12pt; width:100%;">
    <!-- Header Row 1 -->
    <tr style="height:20pt">
        <td style="width:150pt; border-right:1pt solid #000000; vertical-align:middle; text-align:center">
            <span style="font-family:Arial; font-weight:bold; font-size:11pt">Nilai CRM</span>
        </td>
        <td colspan="5" style="width:400pt; border:1pt solid #000000; border-bottom:1pt solid #000000; vertical-align:middle; text-align:center">
            <span style="font-family:Arial; font-weight:bold; font-size:11pt">Pembacaan Alat</span>
        </td>
        <td rowspan="2" style="width:130pt; border:1pt solid #000000; vertical-align:middle; text-align:center">
            <span style="font-family:Arial; font-weight:bold; font-size:11pt">Resolusi</span>
        </td>
        <td style="width:130pt; border-left:1pt solid #000000; vertical-align:middle; text-align:center">
            <span style="font-family:Arial; font-weight:bold; font-size:11pt">Suhu CRM</span>
        </td>
    </tr>
    
    <!-- Header Row 2 -->
    <tr style="height:20pt">
        <td style="width:150pt; border-right:1pt solid #000000; border-bottom:1pt solid #000000; vertical-align:middle; text-align:center">
            <span style="font-family:Arial; font-weight:bold; font-size:10pt"></span>
        </td>
        <td style="width:80pt; border:1pt solid #000000; vertical-align:middle; text-align:center">
            <span style="font-family:Arial; font-weight:bold; font-size:11pt">1</span>
        </td>
        <td style="width:80pt; border:1pt solid #000000; vertical-align:middle; text-align:center">
            <span style="font-family:Arial; font-weight:bold; font-size:11pt">2</span>
        </td>
        <td style="width:80pt; border:1pt solid #000000; vertical-align:middle; text-align:center">
            <span style="font-family:Arial; font-weight:bold; font-size:11pt">3</span>
        </td>
        <td style="width:80pt; border:1pt solid #000000; vertical-align:middle; text-align:center">
            <span style="font-family:Arial; font-weight:bold; font-size:11pt">4</span>
        </td>
        <td style="width:80pt; border:1pt solid #000000; vertical-align:middle; text-align:center">
            <span style="font-family:Arial; font-weight:bold; font-size:11pt">5</span>
        </td>
        <td style="width:130pt; border-left:1pt solid #000000; border-bottom:1pt solid #000000; vertical-align:middle; text-align:center">
            <span style="font-family:Arial; font-weight:bold; font-size:11pt"><sup>o</sup>C</span>
        </td>
    </tr>
    
    {{-- Details already loaded above per formIndex --}}
    
    @for ($row = 1; $row <= 6; $row++)
        @php
            // Ambil data untuk baris ke-i
            $detail = $details->get($row-1);
            $isLastRow = ($row == 6);
            
            // Style untuk sel pertama (Nilai CRM)
            $firstCellStyle = "width:150pt; border-right:1pt solid #000000;";
            if ($row == 1) {
                $firstCellStyle .= " border-top:1pt solid #000000;";
            }
            if (!$isLastRow) {
                $firstCellStyle .= " border-bottom:1pt solid #000000;";
            }
            $firstCellStyle .= " vertical-align:middle; text-align:center;";
            
            // Style untuk sel tengah (Pembacaan 1-5)
            $middleCellStyle = "width:80pt; border:1pt solid #000000;";
            if (!$isLastRow) {
                $middleCellStyle .= " border-bottom:1pt solid #000000;";
            }
            $middleCellStyle .= " vertical-align:middle; text-align:center;";
            
            // Style untuk sel resolusi
            $resolusiStyle = "width:130pt; border:1pt solid #000000;";
            if (!$isLastRow) {
                $resolusiStyle .= " border-bottom:1pt solid #000000;";
            }
            $resolusiStyle .= " vertical-align:middle; text-align:center;";
            
            // Style untuk sel terakhir (Suhu)
            $lastCellStyle = "width:130pt; border-left:1pt solid #000000;";
            if ($row == 1) {
                $lastCellStyle .= " border-top:1pt solid #000000;";
            }
            if (!$isLastRow) {
                $lastCellStyle .= " border-bottom:1pt solid #000000;";
            }
            $lastCellStyle .= " vertical-align:middle; text-align:center;";
            
            // Style untuk value - tanpa formatting number
            $valueStyle = "width:100%; height:60px; border:none; font-family:'Times New Roman'; font-size:14pt; text-align:center; box-sizing:border-box; background:transparent; outline:none; padding:5px; display:flex; align-items:center; justify-content:center;";
        @endphp
        
        <tr style="height:60pt">
            <!-- Kolom 1: Nilai CRM - TAMPILKAN APA ADANYA -->
            <td style="{{ $firstCellStyle }}">
                @if($detail && !is_null($detail->nilaiCRM))
                    <div style="{{ $valueStyle }}">
                        {{ $detail->nilaiCRM }}
                    </div>
                @else
                    <div style="{{ $valueStyle }}">&nbsp;</div>
                @endif
            </td>
            
            <!-- Kolom 2-6: Pembacaan Alat 1-5 - TAMPILKAN APA ADANYA -->
            @for($col = 1; $col <= 5; $col++)
                @php
                    $fieldName = 'rep' . sprintf('%02d', $col);
                    $value = $detail ? $detail->$fieldName : null;
                @endphp
                <td style="{{ $middleCellStyle }}">
                    @if(!is_null($value))
                        <div style="{{ $valueStyle }}">
                            {{ $value }}
                        </div>
                    @else
                        <div style="{{ $valueStyle }}">&nbsp;</div>
                    @endif
                </td>
            @endfor
            
            <!-- Kolom 7: Resolusi - TAMPILKAN APA ADANYA -->
            <td style="{{ $resolusiStyle }}">
                @if($detail && !is_null($detail->Resolusi))
                    <div style="{{ $valueStyle }}">
                        {{ $detail->Resolusi }}
                    </div>
                @else
                    <div style="{{ $valueStyle }}">&nbsp;</div>
                @endif
            </td>
            
            <!-- Kolom 8: Suhu CRM - TAMPILKAN APA ADANYA -->
            <td style="{{ $lastCellStyle }}">
                @if($detail && !is_null($detail->suhuCRM))
                    <div style="{{ $valueStyle }}">
                        {{ $detail->suhuCRM }}
                    </div>
                @else
                    <div style="{{ $valueStyle }}">&nbsp;</div>
                @endif
            </td>
        </tr>
    @endfor
</table>

<!-- Debug Section (tampilkan di bawah tabel untuk testing) -->
<div style="display:none; margin-top: 20px; padding: 10px; background: #f5f5f5; border: 1px solid #ddd;">
    <h4>Debug Information:</h4>
    <p><strong>Calibration ID:</strong> {{ $calibration->id }}</p>
    <p><strong>Relationship Name:</strong> detailConductivityMeter</p>
    <p><strong>Data Count:</strong> {{ $details->count() }}</p>
    
    @if($details->count() > 0)
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
                @foreach($details as $index => $detail)
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
</style>

<table cellspacing="0" cellpadding="0" class="TableNormal" style="margin-left:3.48pt; border:0.75pt solid #000000; -aw-border-insideh:0.75pt single #000000; -aw-border-insidev:0.75pt single #000000; border-collapse:collapse; width:100%;">
    <tr style="height:12.9pt">
      <td colspan="9" style="width:545.85pt; border-bottom-style:solid; border-bottom-width:0.75pt; vertical-align:top">
        <p class="TableParagraph" style="margin-left:0.8pt; text-align:center; line-height:11.95pt">
          <span style="font-family:Arial; font-weight:bold">Isilah</span>
          <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.45pt"></span>
          <span style="font-family:Arial; font-weight:bold">lembar</span>
          <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.5pt"></span>
          <span style="font-family:Arial; font-weight:bold">data</span>
          <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.45pt"></span>
          <span style="font-family:Arial; font-weight:bold">kalibrasi</span>
          <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.5pt"></span>
          <span style="font-family:Arial; font-weight:bold">dengan</span>
          <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.45pt"></span>
          <span style="font-family:Arial; font-weight:bold">lengkap</span>
          <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.45pt"></span>
          <span style="font-family:Arial; font-weight:bold">dan</span>
          <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.45pt"></span>
          <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.1pt">jelas!</span>
        </p>
      </td>
    </tr>
    <tr style="height:14.3pt">
      <td rowspan="2" style="width:148.15pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; vertical-align:top">
        <p class="TableParagraph" style="margin-top:0.2pt; font-size:9.5pt">
          <span style="-aw-import:ignore">&#xa0;</span>
        </p>
        <p class="TableParagraph" style="margin-left:1.35pt; text-align:center; font-size:9.5pt">
          <span>Alat</span>
          <span style="letter-spacing:-0.05pt"></span>
          <span style="letter-spacing:-0.1pt">Standar</span>
        </p>
      </td>
     <td colspan="6" style="width:224.7pt; border-style:solid; border-width:0.75pt; vertical-align:top; -aw-border-bottom:0.38pt thin-thick-medium-gap #000000">
    <p class="TableParagraph" style="margin-top:2.2pt; margin-left:1.45pt; font-size:9.5pt">
        @php
            // Ambil data dari headConductivityMeter
            $headData = $calibration->headConductivityMeter ?? null;
            
            // Tampilkan hanya CRM, Thermoscientific saja (tanpa TES/TFA)
            $alatStandar = 'CRM, Thermoscientific';
            
            // Jika ingin mengambil dari database tapi dipisah, bisa juga:
            // if ($headData && $headData->standard) {
            //     // Ambil hanya bagian CRM, Thermoscientific saja (sebelum koma TES/TFA)
            //     $standard = $headData->standard;
            //     $parts = explode(',', $standard);
            //     $alatStandar = trim($parts[0] . ',' . ($parts[1] ?? ''));
            // }
        @endphp
        <span>{{ $alatStandar }}</span>
    </p>
</td>
      <td style="width:85.3pt; border-style:solid; border-width:0.75pt; vertical-align:top">
        <p class="TableParagraph" style="margin-top:2.1pt; margin-left:13.75pt; font-size:9.5pt">
          <span>Dikalibrasi</span>
          <span style="letter-spacing:0.35pt"></span>
          <span style="letter-spacing:-0.2pt">oleh</span>
        </p>
      </td>
      <td style="width:85.45pt; border-top-style:solid; border-top-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; vertical-align:top">
        <p class="TableParagraph" style="margin-top:2.1pt; margin-left:15.8pt; font-size:9.5pt">
          <span>Diperiksa</span>
          <span style="letter-spacing:0.35pt"></span>
          <span style="letter-spacing:-0.2pt">oleh</span>
        </p>
      </td>
    </tr>
    <tr style="height:13.6pt">
      <td style="width:24.65pt; border-style:solid; border-width:0.75pt; vertical-align:top">
        <p class="TableParagraph" style="margin-top:1.95pt; margin-left:1.45pt; font-size:9.5pt">
          <span style="letter-spacing:-0.25pt">TES</span>
        </p>
      </td>
      <td style="width:26.5pt; border-style:solid; border-width:0.75pt; vertical-align:top; -aw-border-bottom:0.38pt thick-thin-medium-gap #000000; -aw-border-top:0.38pt thick-thin-medium-gap #000000">
        <div style="text-align:center; padding:2px">
          @php
            // Cek apakah TES dipilih
            $isTES = false;
            if ($headData && $headData->standard) {
                $isTES = str_contains($headData->standard, 'TES');
            }
          @endphp
          @if($isTES)
            <span style="font-weight:bold; font-size:14px;">✓</span>
          @else
            <span style="font-size:14px; color:#ccc;">□</span>
          @endif
        </div>
      </td>
      <td style="width:59.15pt; border-style:solid; border-width:0.75pt; vertical-align:top">
        <!-- Kosong untuk view mode -->
      </td>
      <td style="width:24.5pt; border-style:solid; border-width:0.75pt; vertical-align:top">
        <p class="TableParagraph" style="margin-top:1.95pt; margin-left:1.5pt; font-size:9.5pt">
          <span style="letter-spacing:-0.25pt">TFA</span>
        </p>
      </td>
      <td style="width:26.5pt; border-style:solid; border-width:0.75pt; vertical-align:top; -aw-border-bottom:0.38pt thick-thin-medium-gap #000000; -aw-border-top:0.38pt thick-thin-medium-gap #000000">
        <div style="text-align:center; padding:2px">
          @php
            // Cek apakah TFA dipilih
            $isTFA = false;
            if ($headData && $headData->standard) {
                $isTFA = str_contains($headData->standard, 'TFA');
            }
          @endphp
          @if($isTFA)
            <span style="font-weight:bold; font-size:14px;">✓</span>
          @else
            <span style="font-size:14px; color:#ccc;">□</span>
          @endif
        </div>
      </td>
      <td style="width:59.65pt; border-style:solid; border-width:0.75pt; vertical-align:top">
        <!-- Kosong untuk view mode -->
      </td>
      <td style="width:85.3pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; vertical-align:top">
        <!-- Kosong untuk view mode -->
      </td>
      <td style="width:85.45pt; border-top-style:solid; border-top-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; vertical-align:top">
        <!-- Kosong untuk view mode -->
      </td>
    </tr>
    <tr style="height:16.95pt">
      <td rowspan="2" style="width:148.15pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; vertical-align:top">
        <p class="TableParagraph" style="margin-top:9.25pt; margin-left:42.7pt; font-size:9.5pt">
          <span>Metode</span>
          <span style="letter-spacing:-0.1pt"> Kalibrasi</span>
        </p>
      </td>
      <td colspan="6" rowspan="2" style="width:224.7pt; border-style:solid; border-width:0.75pt; vertical-align:top; -aw-border-top:0.38pt thin-thick-medium-gap #000000">
        <p class="TableParagraph" style="margin-top:9.25pt; margin-left:1.45pt; font-size:9.5pt">
          @php
            $metodeKalibrasi = $headData ? $headData->calibrationMethod : 'PAS-IK1102-41';
          @endphp
          <span style="letter-spacing:-0.1pt">{{ $metodeKalibrasi }}</span>
        </p>
      </td>
      <td style="width:85.3pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; vertical-align:top">
        <p class="TableParagraph" style="margin-top:4.45pt; margin-left:1.15pt; font-size:9.5pt">
          <span style="letter-spacing:-0.5pt">TTD</span>
        </p>
      </td>
      <td style="width:85.45pt; border-left-style:solid; border-left-width:0.75pt; vertical-align:top">
        <p class="TableParagraph" style="margin-top:4.45pt; margin-left:1.3pt; font-size:9.5pt">
          <span style="letter-spacing:-0.5pt">TTD</span>
        </p>
      </td>
    </tr>
    <tr style="height:12.4pt">
      <td style="width:85.3pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; vertical-align:top">
        <div style="display:flex; align-items:center; height:100%; padding-left:1.15pt">
          <span style="font-size:9.5pt; margin-right:4px; font-weight:bold">Nama</span>
          <span style="font-size:9.5pt; margin-right:2px; font-weight:bold">:</span>
          @php
            // Ambil nama dari calibration atau headConductivityMeter
            $namaDikalibrasi = $calibration->calibratedBy ?? 
                              ($headData ? $headData->calibratedBy : null) ?? '';
          @endphp
          <div style="flex:1; border:none; font-size:10pt; font-weight:bold; margin-left:4px; padding:2px 4px">
            {{ $namaDikalibrasi }}
          </div>
        </div>
      </td>
      <td style="width:85.45pt; border-left-style:solid; border-left-width:0.75pt; vertical-align:top">
        <div style="display:flex; align-items:center; height:100%; padding-left:1.3pt">
          <span style="font-size:9.5pt; margin-right:4px; font-weight:bold">Nama</span>
          <span style="font-size:9.5pt; margin-right:2px; font-weight:bold">:</span>
          @php
            // Ambil nama dari calibration atau headConductivityMeter
            $namaDiperiksa = $calibration->verifiedBy ?? 
                            ($headData ? $headData->verifiedBy : null) ?? '';
          @endphp
          <div style="flex:1; border:none; font-size:10pt; font-weight:bold; margin-left:4px; padding:2px 4px">
            {{ $namaDiperiksa }}
          </div>
        </div>
      </td>
    </tr>
</table>
</div>
@endfor



            <!-- Action Buttons Section -->
            <div class="row mt-5">
                <div class="col-12 text-center">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary btn-lg" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                    
                    <!--<button onclick="window.print()" class="btn btn-primary btn-lg ms-3" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">-->
                    <!--    <i class="fas fa-print me-2"></i>Cetak-->
                    <!--</button>-->
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>