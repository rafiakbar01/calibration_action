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
                        <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK38</p>
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
                        <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">VOLUMETRIK: MIKROPIPET, DISPENSET</p>
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
                        <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;">{{ $calibration->headMikropipetDispenset->certificate_id ?? 'N/A' }}</p>
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
                                   value="{{ \Carbon\Carbon::parse($calibration->tanggalKalibrasi)->format('d/m/Y') }}" readonly style="width: 45%;">
                            <span class="me-3" style="color: #000000;">Jenis Pembacaan:</span>
                            <input type="text" class="kalibrasi-input" value="{{ $calibration->jenisPembacaan }}" readonly style="width: 45%;">
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
                                <input class="form-check-input" type="radio" name="tempat_kalibrasi" value="lab" id="lab" 
                                       {{ $calibration->tempatKalibrasi == 'lab' ? 'checked' : '' }} disabled>
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

       @php
    $details = $calibration->detailMikropipetDispensets ?? collect();
    
    $detailAtasKiri   = $details->get(0) ?? null;
    $detailAtasKanan  = $details->get(1) ?? null;
    $detailBawahKiri  = $details->get(2) ?? null;
    $detailBawahKanan = $details->get(3) ?? null;
@endphp

<table cellspacing="0" cellpadding="0" style="width:100%; max-width:860pt; border-collapse:collapse; font-family:Arial,Helvetica,sans-serif; margin:0 auto;">
    <!-- HEADER UTAMA -->
    <tr>
        <td colspan="9" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; padding:12pt 0;">
            <span style="font-size:12pt; font-weight:bold;">DATA KALIBRASI</span>
        </td>
    </tr>

    <!-- ==================== BAGIAN ATAS ==================== -->
    <tr style="height:55pt;">
        <td rowspan="2" style="width:130pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle; padding:8pt;">
            <span style="font-size:10pt; font-weight:bold;">Nominal Alat Ukur</span><br>
         <span style="font-family:'Courier New'; letter-spacing:0.5em; font-size:10pt;">(............)</span>
        </td>
        <td colspan="3" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; padding:8pt;">
            <span style="font-size:10pt; font-weight:bold;">Pembacaan Timbangan (g)</span>
        </td>
        <td rowspan="41" style="width:40pt; border-left:0.75pt solid #000; border-right:0.75pt solid #000;">&nbsp;</td>
        <td rowspan="2" style="width:130pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle; padding:8pt;">
            <span style="font-size:10pt; font-weight:bold;">Nominal Alat Ukur</span><br>
            
                <span style="font-family:'Courier New'; letter-spacing:0.5em; font-size:10pt;">(............)</span>
          
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
                {{ $detailAtasKiri->titikUkur ?? '' }}
            </td>
        @endif
        <td style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">
            m<sub>{{ $i }}</sub>
        </td>
        <td colspan="2" style="border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:11pt;">
            {{ $detailAtasKiri->{'m'.$i} ?? '' }}
        </td>
      
        @if($i == 0)
            <td rowspan="12" style="border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:14pt; font-weight:bold;">
                {{ $detailAtasKanan->titikUkur ?? '' }}
            </td>
        @endif
        <td style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">
            m<sub>{{ $i }}</sub>
        </td>
        <td colspan="2" style="border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:11pt;">
            {{ $detailAtasKanan->{'m'.$i} ?? '' }}
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
        <td style="border:0.75pt solid #000; text-align:center;">{{ $detailAtasKiri->TUdaraS ?? '' }}</td>
        <td style="border:0.75pt solid #000; text-align:center;">{{ $detailAtasKiri->TUdaraE ?? '' }}</td>
      
        <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Suhu Udara (°C)</td>
        <td style="border:0.75pt solid #000; text-align:center;">{{ $detailAtasKanan->TUdaraS ?? '' }}</td>
        <td style="border:0.75pt solid #000; text-align:center;">{{ $detailAtasKanan->TUdaraE ?? '' }}</td>
    </tr>

    <!-- Kelembaban Udara Atas -->
    <tr style="height:25pt;">
        <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Kelembaban Udara (%rh)</td>
        <td style="border:0.75pt solid #000; text-align:center;">{{ $detailAtasKiri->RHS ?? '' }}</td>
        <td style="border:0.75pt solid #000; text-align:center;">{{ $detailAtasKiri->RHE ?? '' }}</td>
       
        <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Kelembaban Udara (%rh)</td>
        <td style="border:0.75pt solid #000; text-align:center;">{{ $detailAtasKanan->RHS ?? '' }}</td>
        <td style="border:0.75pt solid #000; text-align:center;">{{ $detailAtasKanan->RHE ?? '' }}</td>
    </tr>

    <!-- Tekanan Udara Atas -->
    <tr style="height:25pt;">
        <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Tekanan Udara (hPa)</td>
        <td style="border:0.75pt solid #000; text-align:center;">{{ $detailAtasKiri->PUdaraS ?? '' }}</td>
        <td style="border:0.75pt solid #000; text-align:center;">{{ $detailAtasKiri->PUdaraE ?? '' }}</td>
      
        <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Tekanan Udara (hPa)</td>
        <td style="border:0.75pt solid #000; text-align:center;">{{ $detailAtasKanan->PUdaraS ?? '' }}</td>
        <td style="border:0.75pt solid #000; text-align:center;">{{ $detailAtasKanan->PUdaraE ?? '' }}</td>
    </tr>

    <!-- Suhu Air Atas -->
    <tr style="height:25pt;">
        <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Suhu Air (°C)</td>
        <td style="border:0.75pt solid #000; text-align:center;">{{ $detailAtasKiri->TAirS ?? '' }}</td>
        <td style="border:0.75pt solid #000; text-align:center;">{{ $detailAtasKiri->TAirE ?? '' }}</td>
     
        <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Suhu Air (°C)</td>
        <td style="border:0.75pt solid #000; text-align:center;">{{ $detailAtasKanan->TAirS ?? '' }}</td>
        <td style="border:0.75pt solid #000; text-align:center;">{{ $detailAtasKanan->TAirE ?? '' }}</td>
    </tr>

    <!-- Waktu Atas - Sekarang sama seperti parameter lain, Awal & Akhir digabung -->
    <tr style="height:25pt;">
        <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Waktu (detik)</td>
        <td colspan="2" style="border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:11pt;">
            {{ $detailAtasKiri->waktu ?? '' }}
        </td>
     
        <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Waktu (detik)</td>
        <td colspan="2" style="border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:11pt;">
            {{ $detailAtasKanan->waktu ?? '' }}
        </td>
    </tr>

    <!-- Spacer -->
    <tr><td colspan="9" style="height:30pt;">&nbsp;</td></tr>

    <!-- ==================== BAGIAN BAWAH ==================== -->
    <tr style="height:55pt;">
        <td rowspan="2" style="width:130pt; border:2.25pt double #000; border-top:2.25pt double #000; background:#d9d9d9; text-align:center; vertical-align:middle; padding:8pt;">
            <span style="font-size:10pt; font-weight:bold;">Nominal Alat Ukur</span><br>
           <span style="font-family:'Courier New'; letter-spacing:0.5em; font-size:10pt;">(............)</span>
        </td>
        <td colspan="3" style="border:2.25pt double #000; border-top:2.25pt double #000; background:#d9d9d9; text-align:center; padding:8pt;">
            <span style="font-size:10pt; font-weight:bold;">Pembacaan Timbangan (g)</span>
        </td>
       
        <td rowspan="2" style="width:130pt; border:2.25pt double #000; border-top:2.25pt double #000; background:#d9d9d9; text-align:center; vertical-align:middle; padding:8pt;">
            <span style="font-size:10pt; font-weight:bold;">Nominal Alat Ukur</span><br>
          
                <span style="font-family:'Courier New'; letter-spacing:0.5em; font-size:10pt;">(............)</span>
            
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
                {{ $detailBawahKiri->titikUkur ?? '' }}
            </td>
        @endif
        <td style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">
            m<sub>{{ $i }}</sub>
        </td>
        <td colspan="2" style="border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:11pt;">
            {{ $detailBawahKiri->{'m'.$i} ?? '' }}
        </td>
      
        @if($i == 0)
            <td rowspan="12" style="border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:14pt; font-weight:bold;">
                {{ $detailBawahKanan->titikUkur ?? '' }}
            </td>
        @endif
        <td style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">
            m<sub>{{ $i }}</sub>
        </td>
        <td colspan="2" style="border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:11pt;">
            {{ $detailBawahKanan->{'m'.$i} ?? '' }}
        </td>
    </tr>
    @endfor

    <!-- Parameter Pendukung Header Bawah -->
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
        <td style="border:0.75pt solid #000; text-align:center;">{{ $detailBawahKiri->TUdaraS ?? '' }}</td>
        <td style="border:0.75pt solid #000; text-align:center;">{{ $detailBawahKiri->TUdaraE ?? '' }}</td>
    
        <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Suhu Udara (°C)</td>
        <td style="border:0.75pt solid #000; text-align:center;">{{ $detailBawahKanan->TUdaraS ?? '' }}</td>
        <td style="border:0.75pt solid #000; text-align:center;">{{ $detailBawahKanan->TUdaraE ?? '' }}</td>
    </tr>

    <!-- Kelembaban Udara Bawah -->
    <tr style="height:25pt;">
        <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Kelembaban Udara (%rh)</td>
        <td style="border:0.75pt solid #000; text-align:center;">{{ $detailBawahKiri->RHS ?? '' }}</td>
        <td style="border:0.75pt solid #000; text-align:center;">{{ $detailBawahKiri->RHE ?? '' }}</td>
        
        <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Kelembaban Udara (%rh)</td>
        <td style="border:0.75pt solid #000; text-align:center;">{{ $detailBawahKanan->RHS ?? '' }}</td>
        <td style="border:0.75pt solid #000; text-align:center;">{{ $detailBawahKanan->RHE ?? '' }}</td>
    </tr>

    <!-- Tekanan Udara Bawah -->
    <tr style="height:25pt;">
        <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Tekanan Udara (hPa)</td>
        <td style="border:0.75pt solid #000; text-align:center;">{{ $detailBawahKiri->PUdaraS ?? '' }}</td>
        <td style="border:0.75pt solid #000; text-align:center;">{{ $detailBawahKiri->PUdaraE ?? '' }}</td>
        
        <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Tekanan Udara (hPa)</td>
        <td style="border:0.75pt solid #000; text-align:center;">{{ $detailBawahKanan->PUdaraS ?? '' }}</td>
        <td style="border:0.75pt solid #000; text-align:center;">{{ $detailBawahKanan->PUdaraE ?? '' }}</td>
    </tr>

    <!-- Suhu Air Bawah -->
    <tr style="height:25pt;">
        <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Suhu Air (°C)</td>
        <td style="border:0.75pt solid #000; text-align:center;">{{ $detailBawahKiri->TAirS ?? '' }}</td>
        <td style="border:0.75pt solid #000; text-align:center;">{{ $detailBawahKiri->TAirE ?? '' }}</td>
       
        <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Suhu Air (°C)</td>
        <td style="border:0.75pt solid #000; text-align:center;">{{ $detailBawahKanan->TAirS ?? '' }}</td>
        <td style="border:0.75pt solid #000; text-align:center;">{{ $detailBawahKanan->TAirE ?? '' }}</td>
    </tr>

    <!-- Waktu Bawah - Merge Awal & Akhir -->
    <tr style="height:25pt;">
        <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Waktu (detik)</td>
        <td colspan="2" style="border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:11pt;">
            {{ $detailBawahKiri->waktu ?? '' }}
        </td>
        
        <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Waktu (detik)</td>
        <td colspan="2" style="border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:11pt;">
            {{ $detailBawahKanan->waktu ?? '' }}
        </td>
    </tr>
</table>



<p class="BodyText" style="margin-top:3.1pt; margin-left:4.45pt; margin-bottom:1.3pt">
    <span>Catatan</span>
    <span style="letter-spacing:0.15pt"></span>
    <span>:</span>
    <span style="letter-spacing:0.1pt"></span>
    <span>Pengukuran</span>
    <span style="letter-spacing:0.2pt"></span>
    <span>m</span>
    <span style="font-size:6pt; vertical-align:sub">11</span>
    <span style="letter-spacing:0.15pt"></span>
    <span>dan</span>
    <span style="letter-spacing:0.15pt"></span>
    <span>penghitungan</span>
    <span style="letter-spacing:0.2pt"></span>
    <span>waktu</span>
    <span style="letter-spacing:0.15pt"></span>
    <span>hanya</span>
    <span style="letter-spacing:0.2pt"></span>
    <span>untuk</span>
    <span style="letter-spacing:0.15pt"></span>
    <span>volume</span>
    <span style="letter-spacing:0.15pt"></span>
    <span>50</span>
    <span style="letter-spacing:0.35pt"></span>
    <span style="font-family:Calibri">μ</span>
    <span>l ke</span>
    <span style="letter-spacing:0.2pt"></span>
    <span style="letter-spacing:-0.2pt">bawah</span>
</p>



&nbsp;  &nbsp;
@php
    $head = $calibration->headMikropipetDispenset;

    // Data berupa string dipisah koma → ubah jadi array
    $standardString = $head->standard ?? '';
    $alatStandarData = [];
    if (!empty($standardString)) {
        $alatStandarData = array_map('trim', explode(',', $standardString));
    }

    $calibratedBy = $calibration->calibratedBy ?? '';
    $verifiedBy = $calibration->verifiedBy ?? '';

    $isSelected = function($value) use ($alatStandarData) {
        return in_array($value, $alatStandarData, true);
    };
@endphp

<style>
    /* Checkbox & radio standar */
    input[type="checkbox"], input[type="radio"] {
        width: 18px;
        height: 18px;
        margin-right: 8px;
        vertical-align: middle;
        cursor: default;
    }

    /* YANG TERPILIH: background hitam + centang/bulat putih tebal (jelas bedanya) */
    input[type="checkbox"]:checked,
    input[type="radio"]:checked {
        accent-color: #ffffff !important;   /* centang putih */
        background-color: #000000 !important; /* kotak hitam */
        border: 2px solid #000000 !important;
        box-shadow: 0 0 0 2px #ffffff; /* outline putih biar kontras */
    }

    /* YANG TIDAK TERPILIH: kotak biasa abu-abu pudar */
    input[type="checkbox"]:not(:checked),
    input[type="radio"]:not(:checked) {
        background-color: #f0f0f0;
        border: 1px solid #999999;
    }

    /* Pastikan disabled tetap kelihatan penuh */
    input[type="checkbox"]:disabled,
    input[type="radio"]:disabled {
        opacity: 1 !important;
    }
</style>

<table cellspacing="0" cellpadding="5"
    style="border-collapse:collapse; width:100%; font-family:Arial; font-size:9pt; border:1px solid #000;">

    <!-- JUDUL -->
    <tr>
        <td colspan="9" style="border:1px solid #000; text-align:center; font-weight:bold; font-size:11pt;">
            Isilah lembar data kalibrasi dengan lengkap dan jelas!
        </td>
    </tr>

    <!-- BARIS 1 -->
    <tr>
        <td rowspan="4" style="border:1px solid #000; text-align:center; font-weight:bold; width:90px;">
            Alat Standar
        </td>

        <td style="border:1px solid #000; width:200px;">Semi Microbalance, AND</td>
        <td style="border:1px solid #000;" align="center">
            <input type="checkbox" @if($isSelected('Semi Microbalance AND 0.1g')) checked @endif disabled>
            <span>0.1 g</span>
        </td>
        <td style="border:1px solid #000;" align="center">
            <input type="checkbox" @if($isSelected('Semi Microbalance AND 1g')) checked @endif disabled>
            <span>1 g</span>
        </td>
        <td style="border:1px solid #000;" align="center">
            <input type="checkbox" @if($isSelected('Semi Microbalance AND 10g')) checked @endif disabled>
            <span>10 g</span>
        </td>
        <td style="border:1px solid #000;" align="center">
            <input type="checkbox" @if($isSelected('Semi Microbalance AND 100g')) checked @endif disabled>
            <span>100 g</span>
        </td>
        <td style="border:1px solid #000;" align="center">
            <input type="checkbox" @if($isSelected('Semi Microbalance AND 200g')) checked @endif disabled>
            <span>200 g</span>
        </td>

        <td style="border:none; text-align:center; font-weight:bold;">Dikalibrasi oleh</td>
        <td style="border:none; text-align:center; font-weight:bold;">Diperiksa oleh</td>
    </tr>

    <!-- BARIS 2 -->
    <tr>
        <td style="border:1px solid #000;">Semi Microbalance, Radwag</td>
        <td style="border:1px solid #000;" align="center">
            <input type="checkbox" @if($isSelected('Semi Microbalance Radwag 0.1g')) checked @endif disabled>
            <span>0.1 g</span>
        </td>
        <td style="border:1px solid #000;" align="center">
            <input type="checkbox" @if($isSelected('Semi Microbalance Radwag 1g')) checked @endif disabled>
            <span>1 g</span>
        </td>
        <td style="border:1px solid #000;" align="center">
            <input type="checkbox" @if($isSelected('Semi Microbalance Radwag 10g')) checked @endif disabled>
            <span>10 g</span>
        </td>
        <td style="border:1px solid #000;" align="center">
            <input type="checkbox" @if($isSelected('Semi Microbalance Radwag 100g')) checked @endif disabled>
            <span>100 g</span>
        </td>
        <td style="border:1px solid #000;" align="center">
            <input type="checkbox" @if($isSelected('Semi Microbalance Radwag 200g')) checked @endif disabled>
            <span>200 g</span>
        </td>
    </tr>

    <!-- BARIS 3 -->
    <tr>
        <td style="border:1px solid #000;">Timbangan Digital, AND</td>
        <td colspan="2" style="border:1px solid #000;" align="center">
            <input type="checkbox" @if($isSelected('Timbangan Digital AND 3kg')) checked @endif disabled>
            <span>3 kg</span>
        </td>
        <td colspan="3" style="border:1px solid #000;" align="center">
            Stopwatch<br>
            <input type="radio" name="stopwatch_view" @if($isSelected('Stopwatch WF002')) checked @endif disabled>
            <span>WF002</span>
            &nbsp;&nbsp;&nbsp;
            <input type="radio" name="stopwatch_view" @if($isSelected('Stopwatch WT003')) checked @endif disabled>
            <span>WT003</span>
        </td>
    </tr>

    <!-- BARIS 4 -->
    <tr>
        <td style="border:1px solid #000;">Termometer</td>
        <td colspan="2" style="border:1px solid #000;" align="center">
            <input type="radio" name="termometer_view" @if($isSelected('Termometer TES')) checked @endif disabled>
            <span>TES</span>
        </td>
        <td style="border:1px solid #000;"></td>
        <td colspan="2" style="border:1px solid #000;" align="center">
            <input type="radio" name="termometer_view" @if($isSelected('Termometer TFA')) checked @endif disabled>
            <span>TFA</span>
        </td>
    </tr>

    <!-- BARIS TERAKHIR -->
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
            @if($calibratedBy)
                <span style="font-weight:bold; font-size:10pt; display:inline-block; margin-top:5px;">{{ $calibratedBy }}</span>
            @endif
        </td>

        <td style="border:1px solid #000; text-align:center;">
            TTD :<br><br>
            Nama :<br>
            @if($verifiedBy)
                <span style="font-weight:bold; font-size:10pt; display:inline-block; margin-top:5px;">{{ $verifiedBy }}</span>
            @endif
        </td>
    </tr>
</table>

<script>// 3. Jumlah item terpilih
    console.log('Jumlah alat standar terpilih:', {{ count($alatStandarData) }});
    </script>


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