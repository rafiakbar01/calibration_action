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

    /* Styling khusus untuk checkbox alat standar dan metode */
    .alat-standar-checkbox,
    .metode-checkbox {
        width: 18px;
        height: 18px;
        margin: 0;
        cursor: not-allowed;
    }

    /* Pastikan checkbox dan radio memiliki ukuran yang konsisten */
    .form-check-input[type="checkbox"],
    .alat-standar-checkbox[type="checkbox"],
    .metode-checkbox[type="checkbox"] {
        border-radius: 0.25em;
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
                        <p style="margin: 0; font-size: 14px; color: #000000;">PAS-</p>
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
                        <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">ABRATION TESTER</p>
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
                        <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;">{{ $calibration->headAbrationTester->certificate_id ?? 'N/A' }}</p>
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
                                <input class="form-check-input" type="radio" name="tempat_kalibrasi" value="lab.PT PAS" id="lab" 
                                       {{ $calibration->tempatKalibrasi == 'lab.PT PAS' ? 'checked' : '' }} disabled>
                                <label class="form-check-label" for="lab" style="color: #000000;">Lab. PT.PAS</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tempat_kalibrasi" value="Insitu" id="insitu" 
                                       {{ $calibration->tempatKalibrasi == 'Insitu' ? 'checked' : '' }} disabled>
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
        <div class="setting-suhu-container" style="margin-bottom: 30px;">  
    <div style="overflow-x:auto;">
        <div class="container">
            <table class="kalibrasi-data-table" border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; width: 100%;">
                <tr class="x23" style="height:18.75pt">
                    <td colspan="2" class="x76" style="border-right:1px solid windowtext; height:18pt; text-align:center; vertical-align:middle; background-color: #f0f0f0; font-weight: bold;">Nominal / Setpoint UUT</td>
                    <td colspan="5" class="x73" style="border-right:1px solid windowtext; border-bottom:1px solid windowtext; text-align:center; background-color: #f0f0f0; font-weight: bold;">Pembacaan Standar (rpm)</td>
                    <td colspan="3" rowspan="2" class="x78" style="border-right:2px solid windowtext; border-bottom:1px solid windowtext; height:34.5pt; text-align:center; vertical-align:middle; background-color: #f0f0f0; font-weight: bold;">Resolusi Alat</td>
                </tr>
                <tr class="x23" style="height:16.5pt">
                    <td colspan="2" class="x84" style="border-right:1px solid windowtext; border-bottom:1px solid windowtext; height:15.75pt; text-align:center; background-color: #f9f9f9;">rpm</td>
                    <td class="x56" style="text-align:center; background-color: #f9f9f9;">1</td>
                    <td class="x56" style="text-align:center; background-color: #f9f9f9;">2</td>
                    <td class="x56" style="text-align:center; background-color: #f9f9f9;">3</td>
                    <td class="x56" style="text-align:center; background-color: #f9f9f9;">4</td>
                    <td class="x56" style="text-align:center; background-color: #f9f9f9;">5</td>
                </tr>
                
                <!-- Loop untuk 12 baris data -->
                @php
                    $details = $calibration->detailAbrationTesters ?? [];
                    $stdData = [];
                    foreach ($details as $detail) {
                        $stdData[] = [
                            'nominalRPM' => $detail->nominalRPM,
                            'STD1' => $detail->STD1,
                            'STD2' => $detail->STD2,
                            'STD3' => $detail->STD3,
                            'STD4' => $detail->STD4,
                            'STD5' => $detail->STD5,
                            'resolusi' => $detail->resolusi,
                        ];
                    }
                @endphp
                
                @for($i = 0; $i < 12; $i++)
                <tr class="x23" style="height:20.25pt">
                    <td colspan="2" class="x65" style="border-right:2px solid windowtext; border-bottom:{{ $i == 11 ? '2px' : '1px' }} solid windowtext; height:18.75pt; text-align:center;">
                        {{ $stdData[$i]['nominalRPM'] ?? '-' }}
                    </td>
                    
                    @for($j = 1; $j <= 5; $j++)
                    <td class="x48" style="text-align:center;">
                        {{ $stdData[$i]["STD{$j}"] ?? '-' }}
                    </td>
                    @endfor
                    
                    <!-- Resolusi Alat -->
                    <td colspan="3" class="x65" style="border-right:2px solid windowtext; border-bottom:{{ $i == 11 ? '2px' : '1px' }} solid windowtext; text-align:center;">
                      
                            {{ $stdData[$i]['resolusi'] ?? '-' }}  
                       
                    </td>
                </tr>
                @endfor
            </table>
        </div>
        <table class="kalibrasi-main-table">
    <tr>
        <td colspan="9" style="text-align: center; border-bottom: 1px solid #000;">
            <span style="font-weight: bold; font-size: 18px; color: #000000;">Isilah lembar data kalibrasi dengan lengkap dan jelas!</span>
        </td>
    </tr>

    <!-- ALAT STANDAR + CHECKBOX -->
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
            font-size: 10pt;
        }
        td {
            border: 1px solid #000;
            padding: 8px;
            vertical-align: middle;
            text-align: left;
        }
        .label-col {
            font-weight: bold;
            background-color: #f0f0f0;
            text-align: center;
        }
        .content-col {
            text-align: left;
            padding-left: 15px;
        }
        .signature-col {
            width: 18%;
            font-weight: bold;
            background-color: #f8f8f8;
        }
        .name-input {
            width: 90%;
            border: none;
            border-bottom: 1px solid #000;
            background: transparent;
            text-align: center;
            font-size: 10pt;
            outline: none;
        }
        .ttd-row {
            height: 50px;
        }
    </style>

    @php
        $head = $calibration->headAbrationTester ?? null;
        $alatStandarArray = $head && $head->standard ? explode(', ', $head->standard) : [];
    @endphp

    <!-- Baris 1 & 2: Alat Standar + Tanda Tangan Header -->
    <tr>
        <td rowspan="2" colspan="2" class="label-col">Alat Standar</td>
        <td rowspan="2" colspan="4" class="content-col">
            Tachometer CEM AT-8 (200302615)
            <input type="checkbox" name="alat_standar[]" value="Tachometer CEM AT-8 (200302615)" 
                   {{ in_array('Tachometer CEM AT-8 (200302615)', $alatStandarArray) ? 'checked' : '' }} 
                   disabled style="display:none;">
        </td>
        <td colspan="2" class="signature-col">Dikalibrasi oleh</td>
        <td colspan="2" class="signature-col">Diperiksa oleh</td>
    </tr>
    <tr>
        <td colspan="2" class="ttd-row">{{ $calibration->calibrated_by ?? '' }}</td>
        <td colspan="2" class="ttd-row">{{ $calibration->verified_by ?? '' }}</td>
    </tr>

    <!-- Baris 3 & 4: Metode Kalibrasi + Nama & TTD -->
    <tr>
        <td rowspan="2" colspan="2" class="label-col">Metode Kalibrasi</td>
        <td rowspan="2" colspan="4" class="content-col">PAS-IK1102-52</td>
        <td colspan="2">TTD :</td>
        <td colspan="2">TTD :</td>
    </tr>
    <tr>
        <td colspan="2">
            Nama: <input type="text" name="calibrated_by" value="{{ $calibration->calibratedBy ?? '' }}" class="name-input" readonly>
        </td>
        <td colspan="2">
            Nama: <input type="text" name="verified_by" value="{{ $calibration->verifiedBy ?? '' }}" class="name-input" readonly>
        </td>
    </tr>
</table>
        
    
        <div class="container" style="margin-top: 20px;">
            <table class="kalibrasi-data-table" border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; width: 100%;">
                <tr class="x21" style="height:12.75pt">
                    <td class="x128" rowspan="3" style="border-bottom:1px solid windowtext; height:41.25pt; background-color: #f0f0f0; font-weight: bold; text-align:center;">Titik Ukur</td>
                    <td class="x128" rowspan="3" style="border-bottom:1px solid windowtext; height:41.25pt; background-color: #f0f0f0; font-weight: bold; text-align:center;">Objek</td>
                    <td class="x99" colspan="16" style="border-right:1px solid windowtext; border-bottom:1px solid windowtext; background-color: #f0f0f0; font-weight: bold; text-align:center;">Penunjukan Standar dan UUT</td>
                </tr>
                <tr class="x21" style="height:12.75pt">
                    <td class="x99" colspan="3" style="border-right:1px solid windowtext; border-bottom:1px solid windowtext; background-color: #f9f9f9; text-align:center; font-weight: bold;">Pengulangan 1</td>
                    <td class="x99" colspan="3" style="border-right:1px solid windowtext; border-bottom:1px solid windowtext; background-color: #f9f9f9; text-align:center; font-weight: bold;">Pengulangan 2</td>
                    <td class="x100" colspan="4" style="border-right:1px solid windowtext; border-bottom:1px solid windowtext; background-color: #f9f9f9; text-align:center; font-weight: bold;">Pengulangan 3</td>
                    <td class="x99" colspan="3" style="border-right:1px solid windowtext; border-bottom:1px solid windowtext; background-color: #f9f9f9; text-align:center; font-weight: bold;">Pengulangan 4</td>
                    <td class="x99" colspan="3" style="border-right:1px solid windowtext; border-bottom:1px solid windowtext; background-color: #f9f9f9; text-align:center; font-weight: bold;">Pengulangan 5</td>
                </tr>
                <tr class="x21" style="height:16.5pt">
                    <td class="x63" style="text-align:center;">menit</td>
                    <td class="x63" style="text-align:center;">second</td>
                    <td class="x63" style="text-align:center;">milisecond</td>
                    <td class="x63" style="text-align:center;">menit</td>
                    <td class="x63" style="text-align:center;">second</td>
                    <td class="x63" style="text-align:center;">milisecond</td>
                    <td class="x63" style="text-align:center;">menit</td>
                    <td class="x63" style="text-align:center;">second</td>
                    <td class="x131" colspan="2" style="border-right:1px solid windowtext; border-bottom:1px solid windowtext; text-align:center;">milisecond</td>
                    <td class="x63" style="text-align:center;">menit</td>
                    <td class="x63" style="text-align:center;">second</td>
                    <td class="x63" style="text-align:center;">milisecond</td>
                    <td class="x63" style="text-align:center;">menit</td>
                    <td class="x63" style="text-align:center;">second</td>
                    <td class="x63" style="border-right:1px solid windowtext; text-align:center;">milisecond</td>
                </tr>
                
                @php
                    $detailData = $calibration->detailAbrationTesters ?? [];
                @endphp
                
                @for($i = 0; $i < 10; $i++)
                @php
                    $detail = $detailData[$i] ?? null;
                @endphp
                <!-- Baris Standar -->
                <tr class="x21" style="height:19.5pt">
                    <td class="x121" rowspan="2" style="border-bottom:1px solid windowtext; height:37.5pt; text-align:center; vertical-align:middle;">
                        {{ $detail->titikUkur ?? '-' }}
                    </td>
                    <td class="x53" style="text-align:center;">Standar</td>
                    @for($pengulangan = 1; $pengulangan <= 5; $pengulangan++)
                        <td class="x53" style="text-align:center;">
                            {{ $detail ? $detail->{"STDm{$pengulangan}"} : '-' }}
                        </td>
                        <td class="x53" style="text-align:center;">
                            {{ $detail ? $detail->{"STDs{$pengulangan}"} : '-' }}
                        </td>
                        @if($pengulangan == 3)
                        <td class="x53" colspan="2" style="text-align:center;">
                            {{ $detail ? $detail->{"STDms{$pengulangan}"} : '-' }}
                        </td>
                        @else
                        <td class="x53" style="text-align:center;">
                            {{ $detail ? $detail->{"STDms{$pengulangan}"} : '-' }}
                        </td>
                        @endif
                    @endfor
                </tr>
                <!-- Baris Alat (UUT) -->
                <tr class="x21" style="height:19.5pt">
                    <td class="x78" style="text-align:center;">Alat (UUT)</td>
                    @for($pengulangan = 1; $pengulangan <= 5; $pengulangan++)
                        <td class="x78" style="text-align:center;">
                            {{ $detail ? $detail->{"UUTm{$pengulangan}"} : '-' }}
                        </td>
                        <td class="x78" style="text-align:center;">
                            {{ $detail ? $detail->{"UUTs{$pengulangan}"} : '-' }}
                        </td>
                        @if($pengulangan == 3)
                        <td class="x78" colspan="2" style="text-align:center;">
                            {{ $detail ? $detail->{"UUTms{$pengulangan}"} : '-' }}
                        </td>
                        @else
                        <td class="x78" style="text-align:center;">
                            {{ $detail ? $detail->{"UUTms{$pengulangan}"} : '-' }}
                        </td>
                        @endif
                    @endfor
                </tr>
                @endfor
            </table>
        </div>
        
        <div class="container" style="margin-top: 20px;">
            <strong>Catatan:</strong>
        </div>
        <div class="container">
            <div style="width:50%; padding:10px; border:1px solid #aaa; border-radius:6px; font-size:10pt; min-height:100px; background-color: #f9f9f9;">
                {{ $calibration->headAbrationTester->catatan ?? '-' }}
            </div>
        </div>
    </div>
</div>

          <div style="margin-top: 40px; margin-bottom: 20px;"></div>
<!-- Footer Section: Tabel Informasi Alat & Tanda Tangan -->
<table cellspacing="0" cellpadding="8" style="width:100%; border-collapse:collapse; font-family: Arial, sans-serif; font-size:12pt; margin-top: 40px;">
    @php
        $head = $calibration->headAbrationTester ?? null;
        $alatStandarString = $head && $head->standard ? $head->standard : '';
        
        // Cek apakah string mengandung value yang dicari
        $isChecked1 = strpos($alatStandarString, 'Digital Stopwatch, Casio (WF.002)') !== false;
        $isChecked2 = strpos($alatStandarString, 'Digital Stopwatch, Casio (WF.003)') !== false;
    @endphp
    
    <tr style="height: 40pt;">
        <td colspan="5" style="border-bottom: 1pt solid #000; text-align: center; vertical-align: middle; background-color: #f5f5f5;">
            <span style="font-size: 18pt; font-weight: bold;">
                Isilah lembar data kalibrasi dengan lengkap dan jelas!
            </span>
        </td>
    </tr>

    <!-- Header Kolom -->
    <tr style="height: 35pt;">
        <td rowspan="3" style="width: 20%; border: 1pt solid #000; text-align: center; vertical-align: middle; font-weight: bold; font-size: 12pt; background-color: #f0f0f0;">
            Standard
        </td>
        <td colspan="2" style="width: 40%; border: 1pt solid #000; text-align: center; vertical-align: middle; font-size: 12pt; background-color: #f0f0f0;">
        </td>
        <td style="width: 20%; border: 1pt solid #000; text-align: center; vertical-align: middle; font-size: 12pt; font-weight: bold; background-color: #f0f0f0;">
            Dikalibrasi oleh
        </td>
        <td style="width: 20%; border: 1pt solid #000; text-align: center; vertical-align: middle; font-size: 12pt; font-weight: bold; background-color: #f0f0f0;">
            Diperiksa oleh
        </td>
    </tr>

    <!-- Baris 1: Digital Stopwatch, Casio (WF.002) -->
    <tr style="height: 40pt;">
        <td style="width: 5%; border: 1pt solid #000; text-align: center; vertical-align: middle;">
            <input type="checkbox" value="Digital Stopwatch, Casio (WF.002)" 
                   {{ $isChecked1 ? 'checked' : '' }} 
                   style="width: 18pt; height: 18pt; pointer-events: none;">
        </td>
        <td style="border: 1pt solid #000; padding-left: 15pt; font-size: 11pt; vertical-align: middle;text-align: left;">
            Digital Stopwatch, Casio (WF.002)
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none;">{{ $calibration->calibrated_by ?? '' }}</td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none;">{{ $calibration->verified_by ?? '' }}</td>
    </tr>

    <!-- Baris 2: Digital Stopwatch, Casio (WF.003) -->
    <tr style="height: 60pt;">
        <td style="border: 1pt solid #000; text-align: center; vertical-align: middle;">
            <input type="checkbox" value="Digital Stopwatch, Casio (WF.003)" 
                   {{ $isChecked2 ? 'checked' : '' }} 
                   style="width: 18pt; height: 18pt; pointer-events: none;">
        </td>
        <td style="border: 1pt solid #000; padding-left: 15pt; font-size: 11pt; vertical-align: middle;text-align: left;">
            Digital Stopwatch, Casio (WF.003)
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none; padding: 10pt 0; vertical-align: top; font-size: 11pt; text-align: left;">
            TTD
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none; padding: 10pt 0; vertical-align: top; font-size: 11pt; text-align: left;">
            TTD
        </td>
    </tr>

    <!-- Baris 3: Metode Kalibrasi + Nama -->
    <tr style="height: 60pt;">
        <td style="border: 1pt solid #000; text-align: center; vertical-align: middle; font-weight: bold; font-size: 12pt; background-color: #f0f0f0;">
            Metode Kalibrasi
        </td>
        <td colspan="2" style="border: 1pt solid #000; padding-left: 15pt; font-size: 11pt; vertical-align: middle;text-align: left;">
            {{ $head->calibrationMethod ?? 'PAS-IK1102-45' }}
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-bottom: 1pt solid #000; border-top: none; padding: 10pt; vertical-align: left; font-size: 11pt;">
            Nama : 
            <input type="text" name="calibrated_by" 
                   style="width: 75%; border: none; border-bottom: 2px solid #000; font-size: 11pt; padding: 5px 0; background: transparent;" 
                   value="{{ $calibration->calibratedBy ?? '' }}" readonly>
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-bottom: 1pt solid #000; border-top: none; padding: 10pt; vertical-align: left; font-size: 11pt;">
            Nama : 
            <input type="text" name="verified_by" 
                   style="width: 75%; border: none; border-bottom: 2px solid #000; font-size: 11pt; padding: 5px 0; background: transparent;" 
                   value="{{ $calibration->verifiedBy ?? '' }}" readonly>
        </td>
    </tr>
</table>

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