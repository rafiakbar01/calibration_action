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
                        <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK43</p>
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
                        <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">Viscometer</p>
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
                        <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;">{{ $calibration->headViscometer->certificate_id ?? 'N/A' }}</p>
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










            <p style="margin-top:0.35pt; font-size:9pt">&nbsp;</p>

<table cellspacing="0" cellpadding="0" class="TableNormal" style="margin-left:14.98pt; border:1.5pt solid #000000; -aw-border-insideh:1.5pt single #000000; -aw-border-insidev:1.5pt single #000000; border-collapse:collapse; width:100%">
    <tr style="height:25pt">
        <td style="width:120pt; border-right-style:solid; border-right-width:1.5pt; vertical-align:middle; background-color:#f2f2f2">
            <p class="TableParagraph" style="margin:5pt; text-align:center; font-size:12pt">
                <span style="font-family:Arial; font-weight:bold">Nilai</span>
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.05pt"></span>
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.1pt">Standard</span>
            </p>
        </td>
        <td rowspan="2" style="width:70pt; border-right-style:solid; border-right-width:1.5pt; border-left-style:solid; border-left-width:1.5pt; border-bottom-style:solid; border-bottom-width:1.5pt; vertical-align:middle; background-color:#f2f2f2">
            <p class="TableParagraph" style="margin:5pt; text-align:center; font-size:12pt">
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.1pt">Spindle</span>
            </p>
        </td>
        <td rowspan="2" style="width:70pt; border-right-style:solid; border-right-width:1.5pt; border-left-style:solid; border-left-width:1.5pt; border-bottom-style:solid; border-bottom-width:1.5pt; vertical-align:middle; background-color:#f2f2f2">
            <p class="TableParagraph" style="margin:5pt; text-align:center; font-size:12pt">
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.25pt">RPM</span>
            </p>
        </td>
        <td colspan="5" style="width:350pt; border-right-style:solid; border-right-width:1.5pt; border-left-style:solid; border-left-width:1.5pt; border-bottom-style:solid; border-bottom-width:1.5pt; vertical-align:middle; background-color:#f2f2f2">
            <p class="TableParagraph" style="margin:5pt; text-align:center; font-size:12pt">
                <span style="font-family:Arial; font-weight:bold">Pembacaan</span>
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.5pt"></span>
                <span style="font-family:Arial; font-weight:bold">Alat</span>
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.4pt"></span>
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.5pt">(</span>
                <span style="width:100pt; font-family:'Lucida Console'; display:inline-block; -aw-font-family:'Times New Roman'; -aw-tabstop-align:left; -aw-tabstop-leader:dots; -aw-tabstop-pos:198.55pt">............</span>
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.5pt">)</span>
            </p>
        </td>
        <td rowspan="2" style="width:80pt; border-right-style:solid; border-right-width:1.5pt; border-left-style:solid; border-left-width:1.5pt; border-bottom-style:solid; border-bottom-width:1.5pt; vertical-align:middle; background-color:#f2f2f2">
            <p class="TableParagraph" style="margin:5pt; text-align:center; font-size:12pt">
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.1pt">Resolusi</span>
            </p>
        </td>
        <td colspan="2" style="width:100pt; border-left-style:solid; border-left-width:1.5pt; border-bottom-style:solid; border-bottom-width:1.5pt; vertical-align:middle; background-color:#f2f2f2">
            <p class="TableParagraph" style="margin:5pt; text-align:center; font-size:12pt">
                <span style="font-family:Arial; font-weight:bold">Suhu CRM</span>
                <span style="font-family:Arial; font-weight:bold; letter-spacing:0.1pt"></span>
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.2pt">(</span>
                <span style="font-family:Calibri; font-weight:bold; letter-spacing:-0.2pt">°</span>
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.2pt">C)</span>
            </p>
        </td>
    </tr>
    <tr style="height:25pt">
        <td style="width:120pt; border-right-style:solid; border-right-width:1.5pt; border-bottom-style:solid; border-bottom-width:1.5pt; vertical-align:middle; background-color:#f2f2f2">
            <p class="TableParagraph" style="margin:5pt; text-align:center; font-size:12pt">
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.1pt">(………………)</span>
            </p>
        </td>
        <td style="width:70pt; border-style:solid; border-width:1.5pt; vertical-align:middle; background-color:#f2f2f2">
            <p class="TableParagraph" style="margin:5pt; text-align:center; font-size:12pt">
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.5pt">1</span>
            </p>
        </td>
        <td style="width:70pt; border-style:solid; border-width:1.5pt; vertical-align:middle; background-color:#f2f2f2">
            <p class="TableParagraph" style="margin:5pt; text-align:center; font-size:12pt">
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.5pt">2</span>
            </p>
        </td>
        <td style="width:70pt; border-style:solid; border-width:1.5pt; vertical-align:middle; background-color:#f2f2f2">
            <p class="TableParagraph" style="margin:5pt; text-align:center; font-size:12pt">
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.5pt">3</span>
            </p>
        </td>
        <td style="width:70pt; border-style:solid; border-width:1.5pt; vertical-align:middle; background-color:#f2f2f2">
            <p class="TableParagraph" style="margin:5pt; text-align:center; font-size:12pt">
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.5pt">4</span>
            </p>
        </td>
        <td style="width:70pt; border-style:solid; border-width:1.5pt; vertical-align:middle; background-color:#f2f2f2">
            <p class="TableParagraph" style="margin:5pt; text-align:center; font-size:12pt">
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.5pt">5</span>
            </p>
        </td>
        <td style="width:50pt; border-style:solid; border-width:1.5pt; vertical-align:middle; background-color:#f2f2f2">
            <p class="TableParagraph" style="margin:5pt; text-align:center; font-size:12pt">
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.2pt">Awal</span>
            </p>
        </td>
        <td style="width:50pt; border-top-style:solid; border-top-width:1.5pt; border-left-style:solid; border-left-width:1.5pt; border-bottom-style:solid; border-bottom-width:1.5pt; vertical-align:middle; background-color:#f2f2f2">
            <p class="TableParagraph" style="margin:5pt; text-align:center; font-size:12pt">
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.1pt">Akhir</span>
            </p>
        </td>
    </tr>

    <?php
    // Asumsi $calibration->detailViscometer adalah collection dari DetailViscometer models
    if(isset($calibration->detailViscometers) && $calibration->detailViscometers->count() > 0):
        foreach($calibration->detailViscometers as $detail):
    ?>
    
    <tr style="height:35pt">
        <!-- Kolom 1: Nilai Standard (titikUkur) -->
        <td style="width:120pt; border-top-style:solid; border-top-width:1.5pt; border-right-style:solid; border-right-width:1.5pt; border-bottom-style:solid; border-bottom-width:1.5pt; vertical-align:middle; text-align:center; padding:8px; font-size:11pt">
            <?php echo e(number_format($detail->titikUkur ?? 0, 2)); ?>
        </td>
        
        <!-- Kolom 2: Spindle -->
        <td style="width:70pt; border-style:solid; border-width:1.5pt; vertical-align:middle; text-align:center; padding:8px; font-size:11pt">
            <?php echo e($detail->spindle ?? ''); ?>
        </td>
        
        <!-- Kolom 3: RPM -->
        <td style="width:70pt; border-style:solid; border-width:1.5pt; vertical-align:middle; text-align:center; padding:8px; font-size:11pt">
            <?php echo e($detail->RPM ?? ''); ?>
        </td>
        
        <!-- Kolom 4: Pembacaan Alat 1 (ulangan01) -->
        <td style="width:70pt; border-style:solid; border-width:1.5pt; vertical-align:middle; text-align:center; padding:8px; font-size:11pt">
            <?php echo e(number_format($detail->ulangan01 ?? 0, 2)); ?>
        </td>
        
        <!-- Kolom 5: Pembacaan Alat 2 (ulangan02) -->
        <td style="width:70pt; border-style:solid; border-width:1.5pt; vertical-align:middle; text-align:center; padding:8px; font-size:11pt">
            <?php echo e(number_format($detail->ulangan02 ?? 0, 2)); ?>
        </td>
        
        <!-- Kolom 6: Pembacaan Alat 3 (ulangan03) -->
        <td style="width:70pt; border-style:solid; border-width:1.5pt; vertical-align:middle; text-align:center; padding:8px; font-size:11pt">
            <?php echo e(number_format($detail->ulangan03 ?? 0, 2)); ?>
        </td>
        
        <!-- Kolom 7: Pembacaan Alat 4 (ulangan04) -->
        <td style="width:70pt; border-style:solid; border-width:1.5pt; vertical-align:middle; text-align:center; padding:8px; font-size:11pt">
            <?php echo e(number_format($detail->ulangan04 ?? 0, 2)); ?>
        </td>
        
        <!-- Kolom 8: Pembacaan Alat 5 (ulangan05) -->
        <td style="width:70pt; border-style:solid; border-width:1.5pt; vertical-align:middle; text-align:center; padding:8px; font-size:11pt">
            <?php echo e(number_format($detail->ulangan05 ?? 0, 2)); ?>
        </td>
        
        <!-- Kolom 9: Resolusi (resolusion) -->
        <td style="width:80pt; border-style:solid; border-width:1.5pt; vertical-align:middle; text-align:center; padding:8px; font-size:11pt">
            <?php echo e(number_format($detail->resolusion ?? 0, 2)); ?>
        </td>
        
        <!-- Kolom 10: Suhu CRM Awal (T_awal) -->
        <td style="width:50pt; border-style:solid; border-width:1.5pt; vertical-align:middle; text-align:center; padding:8px; font-size:11pt">
            <?php echo e(number_format($detail->T_awal ?? 0, 1)); ?>°C
        </td>
        
        <!-- Kolom 11: Suhu CRM Akhir (T_akhir) -->
        <td style="width:50pt; border-top-style:solid; border-top-width:1.5pt; border-left-style:solid; border-left-width:1.5pt; border-bottom-style:solid; border-bottom-width:1.5pt; vertical-align:middle; text-align:center; padding:8px; font-size:11pt">
            <?php echo e(number_format($detail->T_akhir ?? 0, 1)); ?>°C
        </td>
    </tr>
    
    <?php
        endforeach;
        
        // Tambahkan baris kosong jika data kurang dari 15 baris
        $remainingRows = 15 - $calibration->detailViscometer->count();
        if($remainingRows > 0):
            for($i = 0; $i < $remainingRows; $i++):
    ?>
    <tr style="height:35pt">
        <td style="width:120pt; border-top-style:solid; border-top-width:1.5pt; border-right-style:solid; border-right-width:1.5pt; border-bottom-style:solid; border-bottom-width:1.5pt; vertical-align:middle; text-align:center; padding:8px; font-size:11pt">
            &nbsp;
        </td>
        <td style="width:70pt; border-style:solid; border-width:1.5pt; vertical-align:middle; text-align:center; padding:8px; font-size:11pt">
            &nbsp;
        </td>
        <td style="width:70pt; border-style:solid; border-width:1.5pt; vertical-align:middle; text-align:center; padding:8px; font-size:11pt">
            &nbsp;
        </td>
        <td style="width:70pt; border-style:solid; border-width:1.5pt; vertical-align:middle; text-align:center; padding:8px; font-size:11pt">
            &nbsp;
        </td>
        <td style="width:70pt; border-style:solid; border-width:1.5pt; vertical-align:middle; text-align:center; padding:8px; font-size:11pt">
            &nbsp;
        </td>
        <td style="width:70pt; border-style:solid; border-width:1.5pt; vertical-align:middle; text-align:center; padding:8px; font-size:11pt">
            &nbsp;
        </td>
        <td style="width:70pt; border-style:solid; border-width:1.5pt; vertical-align:middle; text-align:center; padding:8px; font-size:11pt">
            &nbsp;
        </td>
        <td style="width:70pt; border-style:solid; border-width:1.5pt; vertical-align:middle; text-align:center; padding:8px; font-size:11pt">
            &nbsp;
        </td>
        <td style="width:80pt; border-style:solid; border-width:1.5pt; vertical-align:middle; text-align:center; padding:8px; font-size:11pt">
            &nbsp;
        </td>
        <td style="width:50pt; border-style:solid; border-width:1.5pt; vertical-align:middle; text-align:center; padding:8px; font-size:11pt">
            &nbsp;
        </td>
        <td style="width:50pt; border-top-style:solid; border-top-width:1.5pt; border-left-style:solid; border-left-width:1.5pt; border-bottom-style:solid; border-bottom-width:1.5pt; vertical-align:middle; text-align:center; padding:8px; font-size:11pt">
            &nbsp;
        </td>
    </tr>
    <?php
            endfor;
        endif;
    else:
        // Tampilkan 15 baris kosong jika tidak ada data
        for($i = 0; $i < 15; $i++):
    ?>
    <tr style="height:35pt">
        <td style="width:120pt; border-top-style:solid; border-top-width:1.5pt; border-right-style:solid; border-right-width:1.5pt; border-bottom-style:solid; border-bottom-width:1.5pt; vertical-align:middle; text-align:center; padding:8px; font-size:11pt">
            &nbsp;
        </td>
        <td style="width:70pt; border-style:solid; border-width:1.5pt; vertical-align:middle; text-align:center; padding:8px; font-size:11pt">
            &nbsp;
        </td>
        <td style="width:70pt; border-style:solid; border-width:1.5pt; vertical-align:middle; text-align:center; padding:8px; font-size:11pt">
            &nbsp;
        </td>
        <td style="width:70pt; border-style:solid; border-width:1.5pt; vertical-align:middle; text-align:center; padding:8px; font-size:11pt">
            &nbsp;
        </td>
        <td style="width:70pt; border-style:solid; border-width:1.5pt; vertical-align:middle; text-align:center; padding:8px; font-size:11pt">
            &nbsp;
        </td>
        <td style="width:70pt; border-style:solid; border-width:1.5pt; vertical-align:middle; text-align:center; padding:8px; font-size:11pt">
            &nbsp;
        </td>
        <td style="width:70pt; border-style:solid; border-width:1.5pt; vertical-align:middle; text-align:center; padding:8px; font-size:11pt">
            &nbsp;
        </td>
        <td style="width:70pt; border-style:solid; border-width:1.5pt; vertical-align:middle; text-align:center; padding:8px; font-size:11pt">
            &nbsp;
        </td>
        <td style="width:80pt; border-style:solid; border-width:1.5pt; vertical-align:middle; text-align:center; padding:8px; font-size:11pt">
            &nbsp;
        </td>
        <td style="width:50pt; border-style:solid; border-width:1.5pt; vertical-align:middle; text-align:center; padding:8px; font-size:11pt">
            &nbsp;
        </td>
        <td style="width:50pt; border-top-style:solid; border-top-width:1.5pt; border-left-style:solid; border-left-width:1.5pt; border-bottom-style:solid; border-bottom-width:1.5pt; vertical-align:middle; text-align:center; padding:8px; font-size:11pt">
            &nbsp;
        </td>
    </tr>
    <?php
        endfor;
    endif;
    ?>
</table>

<table style="width: 100%; border-collapse: collapse; border: 1pt solid #000; font-family: Arial, sans-serif;">
    <!-- Header Judul -->
    <tr style="height: 40pt;">
        <td colspan="5" style="border-bottom: 1pt solid #000; text-align: center; vertical-align: middle; background-color: #f5f5f5;">
            <span style="font-size: 18pt; font-weight: bold;">
                Isilah lembar data kalibrasi dengan lengkap dan jelas!
            </span>
        </td>
    </tr>

    <!-- Header Kolom -->
    <tr style="height: 35pt;">
        <td rowspan="4" style="width: 20%; border: 1pt solid #000; text-align: center; vertical-align: middle; font-weight: bold; font-size: 12pt; background-color: #f0f0f0;">
            Standard
        </td>
        <td colspan="2" style="width: 40%; border: 1pt solid #000; text-align: center; vertical-align: middle; font-size: 12pt; background-color: #f8f8f8;">
            Digital Pressure Calibrator :
        </td>
        <td style="width: 20%; border: 1pt solid #000; text-align: center; vertical-align: middle; font-size: 12pt; font-weight: bold; background-color: #f0f0f0;">
            Dikalibrasi oleh
        </td>
        <td style="width: 20%; border: 1pt solid #000; text-align: center; vertical-align: middle; font-size: 12pt; font-weight: bold; background-color: #f0f0f0;">
            Diperiksa oleh
        </td>
    </tr>

    <?php
    // Ambil data alat standar dan type yang dipilih
    $standardValue = $calibration->headViscometer->standard ?? '';
    
    // Debug: Tampilkan nilai standard untuk troubleshooting
    // echo "<!-- DEBUG standardValue: " . htmlspecialchars($standardValue) . " -->";
    
    // Inisialisasi semua variabel sebagai false
    $viscosityChecked = false;
    $stopwatchChecked = false;
    $thermometerChecked = false;
    
    $viscosityN35 = false;
    $viscosityS60 = false;
    $viscosityD1000 = false;
    
    $stopwatchWF002 = false;
    $stopwatchWF003 = false;
    
    $thermometerTES = false;
    $thermometerTFA = false;
    
    // Parsing data standard (format: "AlatStandar TYPE")
    if (!empty($standardValue)) {
        // Cek alat standar mana yang dipilih berdasarkan keyword
        if (strpos($standardValue, 'Viscosity Standard Paragon') !== false) {
            $viscosityChecked = true;
            
            // Cek type viscosity yang dipilih
            if (strpos($standardValue, 'N35') !== false) {
                $viscosityN35 = true;
            } elseif (strpos($standardValue, 'S60') !== false) {
                $viscosityS60 = true;
            } elseif (strpos($standardValue, 'D1000') !== false) {
                $viscosityD1000 = true;
            }
        } elseif (strpos($standardValue, 'Digital Stopwatch') !== false) {
            $stopwatchChecked = true;
            
            // Cek type stopwatch yang dipilih
            if (strpos($standardValue, 'WF.002') !== false) {
                $stopwatchWF002 = true;
            } elseif (strpos($standardValue, 'WF.003') !== false) {
                $stopwatchWF003 = true;
            }
        } elseif (strpos($standardValue, 'Thermometer') !== false) {
            $thermometerChecked = true;
            
            // Cek type thermometer yang dipilih
            if (strpos($standardValue, 'TES') !== false) {
                $thermometerTES = true;
            } elseif (strpos($standardValue, 'TFA') !== false) {
                $thermometerTFA = true;
            }
        }
    }
    ?>

    <!-- Viscosity -->
    <tr style="height: 60pt;">
        <td style="border: 1pt solid #000; text-align: center; vertical-align: middle;">
            <input type="radio" name="alat_standar[]" value="Viscosity Standard Paragon"
                   <?php echo ($viscosityChecked ? 'checked' : ''); ?> disabled
                   style="width: 18pt; height: 18pt; cursor: pointer;">
        </td>
        <td style="border: 1pt solid #000; padding-left: 15pt; font-size: 11pt;">
            Viscosity Standard Paragon :
            <div style="margin-top:6pt;">
                <label>
                    <input type="radio" name="viscosity_type" value="N35" 
                        <?php echo ($viscosityN35 ? 'checked' : ''); ?> disabled> 
                    N35
                </label>
                &nbsp;&nbsp;
                <label>
                    <input type="radio" name="viscosity_type" value="S60" 
                        <?php echo ($viscosityS60 ? 'checked' : ''); ?> disabled> 
                    S60
                </label>
                &nbsp;&nbsp;
                <label>
                    <input type="radio" name="viscosity_type" value="D1000" 
                        <?php echo ($viscosityD1000 ? 'checked' : ''); ?> disabled> 
                    D1000
                </label>
            </div>
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none;"></td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none;"></td>
    </tr>

    <!-- Stopwatch -->
    <tr style="height: 60pt;">
        <td style="border: 1pt solid #000; text-align: center; vertical-align: middle;">
            <input type="radio" name="alat_standar[]" value="Digital Stopwatch"
                   <?php echo ($stopwatchChecked ? 'checked' : ''); ?> disabled
                   style="width: 18pt; height: 18pt; cursor: pointer;">
        </td>
        <td style="border: 1pt solid #000; padding-left: 15pt; font-size: 11pt;">
            Digital Stopwatch :
            <div style="margin-top:6pt;">
                <label>
                    <input type="radio" name="stopwatch_type" value="WF.002" 
                        <?php echo ($stopwatchWF002 ? 'checked' : ''); ?> disabled> 
                    WF.002
                </label>
                &nbsp;&nbsp;
                <label>
                    <input type="radio" name="stopwatch_type" value="WF.003" 
                        <?php echo ($stopwatchWF003 ? 'checked' : ''); ?> disabled> 
                    WF.003
                </label>
            </div>
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none;"></td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none;"></td>
    </tr>

    <!-- Thermometer -->
    <tr style="height: 60pt;">
        <td style="border: 1pt solid #000; text-align: center; vertical-align: middle;">
            <input type="radio" name="alat_standar[]" value="Thermometer"
                   <?php echo ($thermometerChecked ? 'checked' : ''); ?> disabled
                   style="width: 18pt; height: 18pt; cursor: pointer;">
        </td>
        <td style="border: 1pt solid #000; padding-left: 15pt; font-size: 11pt;">
            Thermometer :
            <div style="margin-top:6pt;">
                <label>
                    <input type="radio" name="thermometer_type" value="TES" 
                        <?php echo ($thermometerTES ? 'checked' : ''); ?> disabled> 
                    TES
                </label>
                &nbsp;&nbsp;
                <label>
                    <input type="radio" name="thermometer_type" value="TFA" 
                        <?php echo ($thermometerTFA ? 'checked' : ''); ?> disabled> 
                    TFA
                </label>
            </div>
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none;">
            TTD :
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none;">
            TTD :
        </td>
    </tr>

    <!-- Metode -->
    <tr style="height: 60pt;">
        <td style="border: 1pt solid #000; text-align: center; vertical-align: middle; font-weight: bold; font-size: 12pt; background-color: #f0f0f0;">
            Metode Kalibrasi
        </td>
        <td colspan="2" style="border: 1pt solid #000; text-align: center; font-size: 11pt;">
            PAS-IK1102-43B
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-bottom: 1pt solid #000; border-top: none;">
            Nama :
            <input type="text" name="calibrated_by"
                   value="<?php echo htmlspecialchars($calibration->calibratedBy ?? ''); ?>"
                   readonly
                   style="width:100%; border:none; border-bottom:2px solid #000; background:transparent;">
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-bottom: 1pt solid #000; border-top: none;">
            Nama :
            <input type="text" name="verified_by"
                   value="<?php echo htmlspecialchars($calibration->verifiedBy ?? ''); ?>"
                   readonly
                   style="width:100%; border:none; border-bottom:2px solid #000; background:transparent;">
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