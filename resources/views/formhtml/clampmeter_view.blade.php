<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Kalibrasi Clamp Meter - PT. PANANJUNG ANUGRAH SOLUTION</title>
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
            background-color: #f8f9fa;
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
            background-color: #f8f9fa;
        }

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

        .form-check-input[type="checkbox"]:checked,
        .alat-standar-checkbox[type="checkbox"]:checked {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='m6 10 3 3 6-6'/%3e%3c/svg%3e") !important;
        }

        .form-check-input[type="checkbox"]:checked:disabled,
        .alat-standar-checkbox[type="checkbox"]:checked:disabled {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='m6 10 3 3 6-6'/%3e%3c/svg%3e") !important;
        }

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

        .alat-standar-checkbox {
            width: 18px;
            height: 18px;
            margin: 0;
            cursor: not-allowed;
        }

        .form-check-input[type="checkbox"],
        .alat-standar-checkbox[type="checkbox"] {
            border-radius: 0.25em;
        }

        .form-check-input[type="radio"],
        input[type="radio"] {
            border-radius: 50%;
        }

        .kalibrasi-header-table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .kalibrasi-header-table td {
            padding: 5px;
            vertical-align: top;
            border: 1px solid #000;
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

        .parameter-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border: 1px solid #000;
        }

        .parameter-table td,
        .parameter-table th {
            border: 1px solid #000;
            padding: 4px;
            text-align: center;
            vertical-align: middle;
            font-size: 8pt;
        }

        .parameter-table th {
            background-color: #d9d9d9;
            font-weight: bold;
        }

        .insulation-header-row {
            height: 10pt;
        }

        .insulation-spacer-row {
            height: 3.4pt;
        }

        .insulation-header-cell {
            background-color: #d9d9d9 !important;
            font-family: Arial, sans-serif !important;
            font-size: 8pt !important;
            font-weight: bold !important;
            text-align: center !important;
            vertical-align: middle !important;
            border: 1px solid #000000 !important;
            color: #000 !important;
            padding: 4px !important;
        }

        .insulation-header-cell-italic {
            background-color: #d9d9d9 !important;
            font-family: Arial, sans-serif !important;
            font-size: 8pt !important;
            font-weight: bold !important;
            font-style: italic !important;
            text-align: left !important;
            padding-left: 8px !important;
            vertical-align: middle !important;
            border: 1px solid #000000 !important;
            color: #000 !important;
            padding: 4px !important;
        }

        .insulation-data-cell {
            font-family: Arial, sans-serif !important;
            font-size: 8pt !important;
            vertical-align: middle !important;
            text-align: center !important;
            border: 1px solid #000000 !important;
            padding: 4px !important;
            background-color: #fff !important;
        }

        .footer-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .footer-table td {
            border: 1px solid #000;
            padding: 8px;
            vertical-align: middle;
            text-align: center;
            font-size: 9pt;
        }

        .footer-table .title {
            font-weight: bold;
            background-color: #f0f0f0;
            font-size: 11pt;
        }

        .footer-table .label {
            font-weight: bold;
            background-color: #e0e0e0;
        }

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
    </style>
</head>
<body>
    <div class="container my-4">
        <div class="form-kalibrasi-container">
            <table class="kalibrasi-header-table">
                <tr>
                    <td colspan="2">
                        <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK044</p>
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
                        <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">KELISTRIKAN (CLAMP METER)</p>
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
                        <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;">{{ $calibration->headInsulation->certificate_id ?? 'N/A' }}</p>
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
                <div class="col-md-6 mb-4">
                    <div class="kalibrasi-section-header" style="color: #000000;">Fungsi Komponen Lainnya</div>
                    
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
                    
                    <div class="d-flex align-items-center">
                        <span class="fw-bold me-3" style="color: #000000; min-width: 100px;">Keterangan :</span>
                        <div style="flex: 1;">
                            <input type="text" class="kalibrasi-input" value="{{ $calibration->keterangan ?? '-' }}" readonly 
                                   style="border: none; border-bottom: 2px solid #000; border-radius: 0; padding: 4px 0; background: transparent; width: 100%;">
                        </div>
                    </div>
                </div>
                
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

            <!-- ==================== DATA KALIBRASI ==================== -->
            @php
                $details = $calibration->detailInsulations ?? collect();
                
                $groupedDetails = [];
                $activeParams = [];
                foreach ($details as $detail) {
                    $param = $detail->parameter_type;
                    if (!isset($groupedDetails[$param])) {
                        $groupedDetails[$param] = [];
                    }
                    $groupedDetails[$param][] = $detail;
                    
                    if (!in_array($param, $activeParams)) {
                        $activeParams[] = $param;
                    }
                }
                
                if (empty($activeParams) && isset($calibration->active_parameters)) {
                    $tempParams = $calibration->active_parameters;
                    if (is_string($tempParams)) {
                        $tempParams = json_decode($tempParams, true) ?? [];
                    }
                    if (is_array($tempParams)) {
                        $activeParams = $tempParams;
                    }
                }
                
                if (!is_array($activeParams)) {
                    $activeParams = [];
                }
            @endphp

            @if(!empty($activeParams))
            <div class="row mb-4 p-3 bg-light border rounded" style="color: #000;">
                <h6 class="fw-bold"><i class="fas fa-tasks me-2"></i>Parameter yang Dikalibrasi:</h6>
                <div class="col-md-12 d-flex flex-wrap gap-4 mt-2">
                    @foreach($activeParams as $param)
                        <span class="badge bg-primary p-2" style="font-size: 10pt;">
                            <i class="fas fa-check-circle me-1"></i> {{ strtoupper(str_replace('_', ' ', $param)) }}
                        </span>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- ==================== TABLES ==================== -->

            <!-- 1. AC Voltage Table -->
            @if(in_array('ac_voltage', $activeParams))
            @php
                $acVoltageDetails = isset($groupedDetails['ac_voltage']) ? $groupedDetails['ac_voltage'] : [];
                $acVoltageIndex = 0;
            @endphp
            <div id="section_ac_voltage" class="parameter-section mb-4">
                <table class="parameter-table table table-bordered" style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
                    <thead>
                        <tr class="insulation-header-row">
                            <td colspan="10" class="insulation-header-cell">DATA KALIBRASI</td>
                        </tr>
                        <tr class="insulation-spacer-row">
                            <td colspan="10" style="background-color: #d9d9d9; border: 1px solid #000; font-size: 1pt;">&nbsp;</td>
                        </tr>
                        <tr class="insulation-header-row">
                            <td colspan="10" class="insulation-header-cell-italic">AC Voltage</td>
                        </tr>
                        <tr class="insulation-header-row">
                            <td rowspan="2" class="insulation-header-cell" style="width: 60pt; vertical-align:middle;">Rentang</td>
                            <td rowspan="2" class="insulation-header-cell" style="width: 60pt; vertical-align:middle;">Penunjukan Standard</td>
                            <td rowspan="2" class="insulation-header-cell" style="width: 60pt; vertical-align:middle;">Frekuensi</td>
                            <td colspan="5" class="insulation-header-cell" style="width: 300pt;">Pembacaan Alat</td>
                            <td rowspan="2" class="insulation-header-cell" style="width: 60pt; vertical-align:middle;">Resolusi Alat</td>
                        </tr>
                        <tr class="insulation-header-row">
                            <td class="insulation-header-cell" style="width: 60pt;">1</td>
                            <td class="insulation-header-cell" style="width: 60pt;">2</td>
                            <td class="insulation-header-cell" style="width: 60pt;">3</td>
                            <td class="insulation-header-cell" style="width: 60pt;">4</td>
                            <td class="insulation-header-cell" style="width: 60pt;">5</td>
                        </tr>
                    </thead>
                    <tbody>
                        @for($i = 0; $i < 9; $i++)
                        @php
                            $unit = ($i == 0) ? 'mV' : 'V';
                            $detail = isset($acVoltageDetails[$acVoltageIndex]) ? $acVoltageDetails[$acVoltageIndex] : null;
                            $acVoltageIndex++;
                        @endphp
                        <tr>
                            <td rowspan="4" class="insulation-data-cell" style="vertical-align:middle; text-align:center; background-color: #f9f9f9; width:60pt;">
                                {{ isset($detail->rentang) ? $detail->rentang : $unit }}
                            </td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                {{ isset($detail->titik_ukur) ? $detail->titik_ukur : '-' }}
                            </td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                {{ isset($detail->frequency) ? $detail->frequency : '-' }}
                            </td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_1) ? $detail->readAlat_1 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_2) ? $detail->readAlat_2 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_3) ? $detail->readAlat_3 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_4) ? $detail->readAlat_4 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_5) ? $detail->readAlat_5 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->resolusi_alat) ? $detail->resolusi_alat : '-' }}</td>
                        </tr>
                        <tr>
                            @php
                                $detail = isset($acVoltageDetails[$acVoltageIndex]) ? $acVoltageDetails[$acVoltageIndex] : null;
                                $acVoltageIndex++;
                            @endphp
                            <td class="insulation-data-cell" style="width:60pt;">{{ isset($detail->titik_ukur) ? $detail->titik_ukur : '-' }}</td>
                            <td class="insulation-data-cell" style="width:60pt;">{{ isset($detail->frequency) ? $detail->frequency : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_1) ? $detail->readAlat_1 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_2) ? $detail->readAlat_2 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_3) ? $detail->readAlat_3 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_4) ? $detail->readAlat_4 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_5) ? $detail->readAlat_5 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->resolusi_alat) ? $detail->resolusi_alat : '-' }}</td>
                        </tr>
                        <tr>
                            @php
                                $detail = isset($acVoltageDetails[$acVoltageIndex]) ? $acVoltageDetails[$acVoltageIndex] : null;
                                $acVoltageIndex++;
                            @endphp
                            <td class="insulation-data-cell" style="width:60pt;">{{ isset($detail->titik_ukur) ? $detail->titik_ukur : '-' }}</td>
                            <td class="insulation-data-cell" style="width:60pt;">{{ isset($detail->frequency) ? $detail->frequency : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_1) ? $detail->readAlat_1 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_2) ? $detail->readAlat_2 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_3) ? $detail->readAlat_3 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_4) ? $detail->readAlat_4 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_5) ? $detail->readAlat_5 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->resolusi_alat) ? $detail->resolusi_alat : '-' }}</td>
                        </tr>
                        <tr>
                            @php
                                $detail = isset($acVoltageDetails[$acVoltageIndex]) ? $acVoltageDetails[$acVoltageIndex] : null;
                                $acVoltageIndex++;
                            @endphp
                            <td class="insulation-data-cell" style="width:60pt;">{{ isset($detail->titik_ukur) ? $detail->titik_ukur : '-' }}</td>
                            <td class="insulation-data-cell" style="width:60pt;">{{ isset($detail->frequency) ? $detail->frequency : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_1) ? $detail->readAlat_1 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_2) ? $detail->readAlat_2 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_3) ? $detail->readAlat_3 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_4) ? $detail->readAlat_4 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_5) ? $detail->readAlat_5 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->resolusi_alat) ? $detail->resolusi_alat : '-' }}</td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
            @endif

            <!-- 2. DC Voltage Table -->
            @if(in_array('dc_voltage', $activeParams))
            @php
                $dcVoltageDetails = isset($groupedDetails['dc_voltage']) ? $groupedDetails['dc_voltage'] : [];
                $dcVoltageIndex = 0;
            @endphp
            <div id="section_dc_voltage" class="parameter-section mb-4">
                <table class="parameter-table table table-bordered" style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
                    <thead>
                        <tr class="insulation-header-row">
                            <td colspan="10" class="insulation-header-cell">DATA KALIBRASI</td>
                        </tr>
                        <tr class="insulation-spacer-row">
                            <td colspan="10" style="background-color: #d9d9d9; border: 1px solid #000; font-size: 1pt;">&nbsp;</td>
                        </tr>
                        <tr class="insulation-header-row">
                            <td colspan="10" class="insulation-header-cell-italic">DC Voltage</td>
                        </tr>
                        <tr class="insulation-header-row">
                            <td rowspan="2" class="insulation-header-cell" style="width: 60pt; vertical-align:middle;">Rentang</td>
                            <td rowspan="2" class="insulation-header-cell" style="width: 60pt; vertical-align:middle;">Penunjukan Standard</td>
                            <td colspan="5" class="insulation-header-cell" style="width: 300pt;">Pembacaan Alat</td>
                            <td rowspan="2" class="insulation-header-cell" style="width: 60pt; vertical-align:middle;">Resolusi Alat</td>
                        </tr>
                        <tr class="insulation-header-row">
                            <td class="insulation-header-cell" style="width: 60pt;">1</td>
                            <td class="insulation-header-cell" style="width: 60pt;">2</td>
                            <td class="insulation-header-cell" style="width: 60pt;">3</td>
                            <td class="insulation-header-cell" style="width: 60pt;">4</td>
                            <td class="insulation-header-cell" style="width: 60pt;">5</td>
                        </tr>
                    </thead>
                    <tbody>
                        @for($i = 0; $i < 9; $i++)
                        @php
                            $unit = ($i == 0) ? 'mV' : 'V';
                            $detail = isset($dcVoltageDetails[$dcVoltageIndex]) ? $dcVoltageDetails[$dcVoltageIndex] : null;
                            $dcVoltageIndex++;
                        @endphp
                        <tr>
                            <td rowspan="4" class="insulation-data-cell" style="vertical-align:middle; text-align:center; background-color: #f9f9f9; width:60pt;">
                                {{ isset($detail->rentang) ? $detail->rentang : $unit }}
                            </td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                {{ isset($detail->titik_ukur) ? $detail->titik_ukur : '-' }}
                            </td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_1) ? $detail->readAlat_1 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_2) ? $detail->readAlat_2 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_3) ? $detail->readAlat_3 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_4) ? $detail->readAlat_4 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_5) ? $detail->readAlat_5 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->resolusi_alat) ? $detail->resolusi_alat : '-' }}</td>
                        </tr>
                        <tr>
                            @php
                                $detail = isset($dcVoltageDetails[$dcVoltageIndex]) ? $dcVoltageDetails[$dcVoltageIndex] : null;
                                $dcVoltageIndex++;
                            @endphp
                            <td class="insulation-data-cell" style="width:60pt;">{{ isset($detail->titik_ukur) ? $detail->titik_ukur : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_1) ? $detail->readAlat_1 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_2) ? $detail->readAlat_2 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_3) ? $detail->readAlat_3 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_4) ? $detail->readAlat_4 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_5) ? $detail->readAlat_5 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->resolusi_alat) ? $detail->resolusi_alat : '-' }}</td>
                        </tr>
                        <tr>
                            @php
                                $detail = isset($dcVoltageDetails[$dcVoltageIndex]) ? $dcVoltageDetails[$dcVoltageIndex] : null;
                                $dcVoltageIndex++;
                            @endphp
                            <td class="insulation-data-cell" style="width:60pt;">{{ isset($detail->titik_ukur) ? $detail->titik_ukur : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_1) ? $detail->readAlat_1 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_2) ? $detail->readAlat_2 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_3) ? $detail->readAlat_3 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_4) ? $detail->readAlat_4 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_5) ? $detail->readAlat_5 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->resolusi_alat) ? $detail->resolusi_alat : '-' }}</td>
                        </tr>
                        <tr>
                            @php
                                $detail = isset($dcVoltageDetails[$dcVoltageIndex]) ? $dcVoltageDetails[$dcVoltageIndex] : null;
                                $dcVoltageIndex++;
                            @endphp
                            <td class="insulation-data-cell" style="width:60pt;">{{ isset($detail->titik_ukur) ? $detail->titik_ukur : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_1) ? $detail->readAlat_1 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_2) ? $detail->readAlat_2 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_3) ? $detail->readAlat_3 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_4) ? $detail->readAlat_4 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_5) ? $detail->readAlat_5 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->resolusi_alat) ? $detail->resolusi_alat : '-' }}</td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
            @endif

            <!-- 3. AC Current Table -->
            @if(in_array('ac_current', $activeParams))
            @php
                $acCurrentDetails = isset($groupedDetails['ac_current']) ? $groupedDetails['ac_current'] : [];
                $acCurrentIndex = 0;
            @endphp
            <div id="section_ac_current" class="parameter-section mb-4">
                <table class="parameter-table table table-bordered" style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
                    <thead>
                        <tr class="insulation-header-row">
                            <td colspan="10" class="insulation-header-cell">DATA KALIBRASI</td>
                        </tr>
                        <tr class="insulation-spacer-row">
                            <td colspan="10" style="background-color: #d9d9d9; border: 1px solid #000; font-size: 1pt;">&nbsp;</td>
                        </tr>
                        <tr class="insulation-header-row">
                            <td colspan="10" class="insulation-header-cell-italic">AC Current</td>
                        </tr>
                        <tr class="insulation-header-row">
                            <td rowspan="2" class="insulation-header-cell" style="width: 60pt; vertical-align:middle;">Rentang</td>
                            <td rowspan="2" class="insulation-header-cell" style="width: 60pt; vertical-align:middle;">Penunjukan Standard</td>
                            <td rowspan="2" class="insulation-header-cell" style="width: 60pt; vertical-align:middle;">Coil</td>
                            <td colspan="5" class="insulation-header-cell" style="width: 300pt;">Pembacaan Alat</td>
                            <td rowspan="2" class="insulation-header-cell" style="width: 60pt; vertical-align:middle;">Resolusi Alat</td>
                        </tr>
                        <tr class="insulation-header-row">
                            <td class="insulation-header-cell" style="width: 60pt;">1</td>
                            <td class="insulation-header-cell" style="width: 60pt;">2</td>
                            <td class="insulation-header-cell" style="width: 60pt;">3</td>
                            <td class="insulation-header-cell" style="width: 60pt;">4</td>
                            <td class="insulation-header-cell" style="width: 60pt;">5</td>
                        </tr>
                    </thead>
                    <tbody>
                        @for($i = 0; $i < 18; $i++)
                        @php
                            $isAmpere = ($i % 2 == 0);
                            $unit = $isAmpere ? 'A' : 'Hz';
                            $rowspan = $isAmpere ? 2 : 1;
                            
                            $detail = isset($acCurrentDetails[$acCurrentIndex]) ? $acCurrentDetails[$acCurrentIndex] : null;
                            $acCurrentIndex++;
                        @endphp
                        <tr>
                            <td rowspan="{{ $rowspan }}" class="insulation-data-cell" style="vertical-align:middle; text-align:center; background-color: #f9f9f9; width:60pt;">
                                {{ isset($detail->rentang) ? $detail->rentang : $unit }}
                            </td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                {{ isset($detail->titik_ukur) ? $detail->titik_ukur : '-' }}
                            </td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                {{ isset($detail->coil) ? $detail->coil : '-' }}
                            </td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_1) ? $detail->readAlat_1 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_2) ? $detail->readAlat_2 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_3) ? $detail->readAlat_3 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_4) ? $detail->readAlat_4 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_5) ? $detail->readAlat_5 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->resolusi_alat) ? $detail->resolusi_alat : '-' }}</td>
                        </tr>
                        @if($isAmpere)
                        @php
                            $detail = isset($acCurrentDetails[$acCurrentIndex]) ? $acCurrentDetails[$acCurrentIndex] : null;
                            $acCurrentIndex++;
                        @endphp
                        <tr>
                            <td class="insulation-data-cell" style="width:60pt;">{{ isset($detail->titik_ukur) ? $detail->titik_ukur : '-' }}</td>
                            <td class="insulation-data-cell" style="width:60pt;">{{ isset($detail->coil) ? $detail->coil : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_1) ? $detail->readAlat_1 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_2) ? $detail->readAlat_2 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_3) ? $detail->readAlat_3 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_4) ? $detail->readAlat_4 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_5) ? $detail->readAlat_5 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->resolusi_alat) ? $detail->resolusi_alat : '-' }}</td>
                        </tr>
                        @endif
                        @endfor
                    </tbody>
                </table>
            </div>
            @endif

            <!-- 4. DC Current Table -->
            @if(in_array('dc_current', $activeParams))
            @php
                $dcCurrentDetails = isset($groupedDetails['dc_current']) ? $groupedDetails['dc_current'] : [];
                $dcCurrentIndex = 0;
            @endphp
            <div id="section_dc_current" class="parameter-section mb-4">
                <table class="parameter-table table table-bordered" style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
                    <thead>
                        <tr class="insulation-header-row">
                            <td colspan="9" class="insulation-header-cell">DATA KALIBRASI</td>
                        </tr>
                        <tr class="insulation-spacer-row">
                            <td colspan="9" style="background-color: #d9d9d9; border: 1px solid #000; font-size: 1pt;">&nbsp;</td>
                        </tr>
                        <tr class="insulation-header-row">
                            <td colspan="9" class="insulation-header-cell-italic">DC Current</td>
                        </tr>
                        <tr class="insulation-header-row">
                            <td rowspan="2" class="insulation-header-cell" style="width: 60pt; vertical-align:middle;">Rentang</td>
                            <td rowspan="2" class="insulation-header-cell" style="width: 60pt; vertical-align:middle;">Penunjukan Standard</td>
                            <td rowspan="2" class="insulation-header-cell" style="width: 60pt; vertical-align:middle;">Coil</td>
                            <td colspan="5" class="insulation-header-cell" style="width: 300pt;">Pembacaan Alat</td>
                            <td rowspan="2" class="insulation-header-cell" style="width: 60pt; vertical-align:middle;">Resolusi Alat</td>
                        </tr>
                        <tr class="insulation-header-row">
                            <td class="insulation-header-cell" style="width: 60pt;">1</td>
                            <td class="insulation-header-cell" style="width: 60pt;">2</td>
                            <td class="insulation-header-cell" style="width: 60pt;">3</td>
                            <td class="insulation-header-cell" style="width: 60pt;">4</td>
                            <td class="insulation-header-cell" style="width: 60pt;">5</td>
                        </tr>
                    </thead>
                    <tbody>
                        @for($i = 0; $i < 9; $i++)
                        @php
                            $unit = 'A';
                            $detail = isset($dcCurrentDetails[$dcCurrentIndex]) ? $dcCurrentDetails[$dcCurrentIndex] : null;
                            $dcCurrentIndex++;
                        @endphp
                        <tr>
                            <td rowspan="3" class="insulation-data-cell" style="vertical-align:middle; text-align:center; background-color: #f9f9f9; width:60pt;">
                                {{ isset($detail->rentang) ? $detail->rentang : $unit }}
                            </td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                {{ isset($detail->titik_ukur) ? $detail->titik_ukur : '-' }}
                            </td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                {{ isset($detail->coil) ? $detail->coil : '-' }}
                            </td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_1) ? $detail->readAlat_1 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_2) ? $detail->readAlat_2 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_3) ? $detail->readAlat_3 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_4) ? $detail->readAlat_4 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_5) ? $detail->readAlat_5 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->resolusi_alat) ? $detail->resolusi_alat : '-' }}</td>
                        </tr>
                        <tr>
                            @php
                                $detail = isset($dcCurrentDetails[$dcCurrentIndex]) ? $dcCurrentDetails[$dcCurrentIndex] : null;
                                $dcCurrentIndex++;
                            @endphp
                            <td class="insulation-data-cell" style="width:60pt;">{{ isset($detail->titik_ukur) ? $detail->titik_ukur : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->coil) ? $detail->coil : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_1) ? $detail->readAlat_1 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_2) ? $detail->readAlat_2 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_3) ? $detail->readAlat_3 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_4) ? $detail->readAlat_4 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_5) ? $detail->readAlat_5 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->resolusi_alat) ? $detail->resolusi_alat : '-' }}</td>
                        </tr>
                        <tr>
                            @php
                                $detail = isset($dcCurrentDetails[$dcCurrentIndex]) ? $dcCurrentDetails[$dcCurrentIndex] : null;
                                $dcCurrentIndex++;
                            @endphp
                            <td class="insulation-data-cell" style="width:60pt;">{{ isset($detail->titik_ukur) ? $detail->titik_ukur : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->coil) ? $detail->coil : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_1) ? $detail->readAlat_1 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_2) ? $detail->readAlat_2 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_3) ? $detail->readAlat_3 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_4) ? $detail->readAlat_4 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_5) ? $detail->readAlat_5 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->resolusi_alat) ? $detail->resolusi_alat : '-' }}</td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
            @endif

            <!-- 5. Resistance Table -->
            @if(in_array('resistance', $activeParams))
            @php
                $resistanceDetails = isset($groupedDetails['resistance']) ? $groupedDetails['resistance'] : [];
                $resistanceIndex = 0;
            @endphp
            <div id="section_resistance" class="parameter-section mb-4">
                <table class="parameter-table table table-bordered" style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
                    <thead>
                        <tr class="insulation-header-row">
                            <td colspan="9" class="insulation-header-cell">DATA KALIBRASI</td>
                        </tr>
                        <tr class="insulation-spacer-row">
                            <td colspan="9" style="background-color: #d9d9d9; border: 1px solid #000; font-size: 1pt;">&nbsp;</td>
                        </tr>
                        <tr class="insulation-header-row">
                            <td colspan="9" class="insulation-header-cell-italic">Resistance</td>
                        </tr>
                        <tr class="insulation-header-row">
                            <td rowspan="2" class="insulation-header-cell" style="width: 60pt; vertical-align:middle;">Rentang</td>
                            <td rowspan="2" class="insulation-header-cell" style="width: 60pt; vertical-align:middle;">Penunjukan Standard</td>
                            <td colspan="5" class="insulation-header-cell" style="width: 300pt;">Pembacaan Alat</td>
                            <td rowspan="2" class="insulation-header-cell" style="width: 60pt; vertical-align:middle;">Resolusi Alat</td>
                        </tr>
                        <tr class="insulation-header-row">
                            <td class="insulation-header-cell" style="width: 60pt;">1</td>
                            <td class="insulation-header-cell" style="width: 60pt;">2</td>
                            <td class="insulation-header-cell" style="width: 60pt;">3</td>
                            <td class="insulation-header-cell" style="width: 60pt;">4</td>
                            <td class="insulation-header-cell" style="width: 60pt;">5</td>
                        </tr>
                    </thead>
                    <tbody>
                        @for($i = 0; $i < 9; $i++)
                        @php
                            if ($i < 3) {
                                $unit = 'Ω';
                            } elseif ($i < 6) {
                                $unit = 'kΩ';
                            } else {
                                $unit = 'MΩ';
                            }
                            $detail = isset($resistanceDetails[$resistanceIndex]) ? $resistanceDetails[$resistanceIndex] : null;
                            $resistanceIndex++;
                        @endphp
                        <tr>
                            <td rowspan="3" class="insulation-data-cell" style="vertical-align:middle; text-align:center; background-color: #f9f9f9; width:60pt;">
                                {{ isset($detail->rentang) ? $detail->rentang : $unit }}
                            </td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                {{ isset($detail->titik_ukur) ? $detail->titik_ukur : '-' }}
                            </td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_1) ? $detail->readAlat_1 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_2) ? $detail->readAlat_2 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_3) ? $detail->readAlat_3 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_4) ? $detail->readAlat_4 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_5) ? $detail->readAlat_5 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->resolusi_alat) ? $detail->resolusi_alat : '-' }}</td>
                        </tr>
                        <tr>
                            @php
                                $detail = isset($resistanceDetails[$resistanceIndex]) ? $resistanceDetails[$resistanceIndex] : null;
                                $resistanceIndex++;
                            @endphp
                            <td class="insulation-data-cell" style="width:60pt;">{{ isset($detail->titik_ukur) ? $detail->titik_ukur : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_1) ? $detail->readAlat_1 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_2) ? $detail->readAlat_2 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_3) ? $detail->readAlat_3 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_4) ? $detail->readAlat_4 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_5) ? $detail->readAlat_5 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->resolusi_alat) ? $detail->resolusi_alat : '-' }}</td>
                        </tr>
                        <tr>
                            @php
                                $detail = isset($resistanceDetails[$resistanceIndex]) ? $resistanceDetails[$resistanceIndex] : null;
                                $resistanceIndex++;
                            @endphp
                            <td class="insulation-data-cell" style="width:60pt;">{{ isset($detail->titik_ukur) ? $detail->titik_ukur : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_1) ? $detail->readAlat_1 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_2) ? $detail->readAlat_2 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_3) ? $detail->readAlat_3 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_4) ? $detail->readAlat_4 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->readAlat_5) ? $detail->readAlat_5 : '-' }}</td>
                            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">{{ isset($detail->resolusi_alat) ? $detail->resolusi_alat : '-' }}</td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
            @endif

            <!-- ==================== FOOTER ==================== -->
            @php
                $headInsulation = $calibration->headInsulation ?? null;
                $standard = $headInsulation->standard ?? 'Multifunction Calibration System Transmille 1000A';
                $calibrationMethod = $headInsulation->calibrationMethod ?? 'PAS-IK1102-43 B (Clamp Meter)';
            @endphp

            <table class="footer-table">
                <tr>
                    <td colspan="12" class="title" style="font-size: 11pt;">
                        Isilah lembar data kalibrasi dengan lengkap dan jelas!
                    </td>
                </tr>
                <tr>
                    <td rowspan="2" class="label" style="font-size: 10pt; width: 12%;">Alat Standar</td>
                    <td colspan="5" rowspan="2" style="font-size: 10pt; text-align: left; padding-left: 10px;">
                        {{ $standard }}
                    </td>
                    <td colspan="3" class="label" style="font-size: 10pt;">Di Kalibrasi oleh</td>
                    <td colspan="3" class="label" style="font-size: 10pt;">Di Periksa oleh</td>
                </tr>
                <tr>
                </tr>
                <tr>
                    <td rowspan="2" class="label" style="font-size: 10pt;">Metode Kalibrasi</td>
                    <td colspan="5" style="text-align: left; padding-left: 10px; font-size: 10pt;">
                        {{ $calibrationMethod }}
                    </td>
                    <td colspan="3" style="text-align: left; padding-left: 20px; font-size: 10pt;">
                        TTD : 
                        @if($calibration->calibrated_by)
                            <span style="font-weight: bold;">{{ $calibration->calibrated_by }}</span>
                        @else
                            _______________
                        @endif
                    </td>
                    <td colspan="3" style="text-align: left; padding-left: 20px; font-size: 10pt;">
                        TTD :
                        @if($calibration->verified_by)
                            <span style="font-weight: bold;">{{ $calibration->verified_by }}</span>
                        @else
                            _______________
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align: left; padding-left: 10px; font-size: 10pt;">&nbsp;</td>
                    <td colspan="3" style="text-align: left; padding-left: 20px; font-size: 10pt;">
                        Nama: <span style="font-weight: bold;">{{ $calibration->calibratedBy ?? '-' }}</span>
                    </td>
                    <td colspan="3" style="text-align: left; padding-left: 20px; font-size: 10pt;">
                        Nama: <span style="font-weight: bold;">{{ $calibration->verifiedBy ?? '-' }}</span>
                    </td>
                </tr>
            </table>

            <!-- Action Buttons Section -->
            <div class="row mt-5">
                <div class="col-12 text-center">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary btn-lg" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
