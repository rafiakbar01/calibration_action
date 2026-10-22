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
    
    /* Input fields styling */
    .kalibrasi-input {
        color: #000000 !important;
        border: 1px solid #ced4da !important;
        padding: 6px 10px;
        border-radius: 4px;
        width: 100%;
        background-color: #ffffff;
    }
    
    .kalibrasi-input:focus {
        outline: none !important;
        border-color: #0d6efd !important;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25) !important;
    }

    /* Styling khusus untuk input suhu dan RH */
    .kondisi-input {
        border: 1px solid #000 !important;
        text-align: center;
        width: 100%;
        padding: 4px;
        background-color: #ffffff;
    }
    
    .kondisi-input:focus {
        outline: none !important;
        border-color: #0d6efd !important;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25) !important;
    }

    /* CHECKBOX STYLING */
    .form-check-input[type="checkbox"]:checked {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }

    /* RADIO BUTTON STYLING */
    .form-check-input[type="radio"]:checked {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='2' fill='%23fff'/%3e%3c/svg%3e") !important;
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
        border: 1px solid #000;
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

    /* Section headers */
    .kalibrasi-section-header {
        font-weight: bold;
        font-size: 16px;
        margin-bottom: 15px;
        text-align: center;
        padding-bottom: 5px;
        border-bottom: 2px solid #000;
    }

    /* Parameter Table Styling */
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

    .table-input-dotted {
        border: none !important;
        border-bottom: 1px dotted #000 !important;
        background: transparent !important;
        text-align: center !important;
        width: 55px !important;
        font-size: 8pt !important;
        font-family: Arial, sans-serif !important;
        color: #000 !important;
        padding: 0 !important;
        margin: 0 !important;
    }
    
    .table-input-dotted:focus {
        outline: none !important;
        border-bottom: 1px solid #0d6efd !important;
        background-color: #f0f8ff !important;
    }

    /* Footer Table Styling */
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

    .btn-success {
        background: linear-gradient(135deg, #22c55e, #16a34a);
        border: none;
        box-shadow: 0 4px 15px rgba(34, 197, 94, 0.3);
        transition: all 0.3s ease;
        color: white;
    }

    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(34, 197, 94, 0.4);
        background: linear-gradient(135deg, #16a34a, #15803d);
        color: white;
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
        <form method="POST" action="{{ route('calibrations.update', $calibration->id) }}" id="editForm">
            @csrf
            @method('PUT')
            
            <div class="form-kalibrasi-container">
                <table class="kalibrasi-header-table">
                    <tr>
                        <td colspan="2">
                            <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK28</p>
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
                            <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">KELISTRIKAN (MULTIMETER)</p>
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
                            <input type="hidden" name="certificate_id" value="{{ $calibration->headInsulation->certificate_id ?? '' }}">
                        </td>
                    </tr>
                </table>

                <table class="kalibrasi-main-table">
                    <!-- Nama Alat -->
                    <tr>
                        <td style="width: 20%;">
                            <p style="margin: 0; color: #000000;">Nama Alat</p>
                        </td>
                        <td colspan="3">
                            <input type="text" name="namaAlat" class="kalibrasi-input"
                                   value="{{ old('namaAlat', $calibration->namaAlat) }}" required>
                        </td>
                    </tr>

                    <!-- Merek & Kode Alat -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Merek</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" name="brandAlat" class="kalibrasi-input me-3"
                                       value="{{ old('brandAlat', $calibration->brandAlat) }}" style="width: 60%;" required>
                                <span class="me-3" style="color: #000000;">Kode Alat :</span>
                                <input type="text" name="kodeAlat" class="kalibrasi-input"
                                       value="{{ old('kodeAlat', $calibration->kodeAlat) }}" style="width: 30%;">
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
                                <input type="text" name="typeAlat" class="kalibrasi-input me-3"
                                       value="{{ old('typeAlat', $calibration->typeAlat) }}" style="width: 45%;" required>
                                <span class="me-3" style="color: #000000;">/</span>
                                <input type="text" name="NoSeri" class="kalibrasi-input"
                                       value="{{ old('NoSeri', $calibration->NoSeri) }}" style="width: 45%;" required>
                            </div>
                        </td>
                    </tr>

                    <!-- Kapasitas / Resolusi -->
                    <tr>
                        <td><p style="margin: 0; color: #000000;">Kapasitas / Resolusi</p></td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" name="kapasitas" class="kalibrasi-input me-3"
                                       value="{{ old('kapasitas', $calibration->kapasitas) }}" style="width: 45%;">
                                <span class="me-3" style="color: #000000;">/</span>
                                <input type="text" name="resolusi" class="kalibrasi-input"
                                       value="{{ old('resolusi', $calibration->resolusi) }}" style="width: 45%;">
                            </div>
                        </td>
                    </tr>

                    <!-- Nama Pemilik -->
                    <tr>
                        <td><p style="margin: 0; color: #000000;">Nama Pemilik</p></td>
                        <td colspan="3">
                            <input type="text" name="pemilikAlat" class="kalibrasi-input"
                                   value="{{ old('pemilikAlat', $calibration->pemilikAlat) }}" required>
                        </td>
                    </tr>

                    <!-- Tanggal -->
                    <tr>
                        <td><p style="margin:0;color:#000;">Tanggal Alat Masuk</p></td>
                        <td colspan="3">
                            <input type="date" name="tanggalMasuk" class="kalibrasi-input"
                                   value="{{ old('tanggalMasuk', \Carbon\Carbon::parse($calibration->tanggalMasuk)->format('Y-m-d')) }}" required>
                        </td>
                    </tr>

                    <tr>
                        <td><p style="margin: 0; color: #000000;">Tanggal Kalibrasi</p></td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="date" name="tanggalKalibrasi" class="kalibrasi-input me-3"
                                       value="{{ old('tanggalKalibrasi', $calibration->tanggalKalibrasi) }}" style="width:45%;" required>
                                <span class="me-3" style="color: #000000;">Jenis Pembacaan:</span>
                                <input type="text" name="jenisPembacaan" class="kalibrasi-input"
                                       value="{{ old('jenisPembacaan', $calibration->jenisPembacaan) }}" style="width:45%;">
                            </div>
                        </td>
                    </tr>

                    <!-- Tempat Kalibrasi -->
                    <tr>
                        <td><p style="margin: 0; color: #000000;">Tempat Kalibrasi</p></td>
                        <td colspan="3">
                            <div class="d-flex">
                                <div class="form-check me-5">
                                    <input class="form-check-input" type="radio" name="tempatKalibrasi" value="lab.PT PAS" id="lab"
                                           {{ old('tempatKalibrasi', $calibration->tempatKalibrasi) == 'lab.PT PAS' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="lab" style="color: #000000;">Lab. PT.PAS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tempatKalibrasi" value="insitu" id="insitu"
                                           {{ old('tempatKalibrasi', $calibration->tempatKalibrasi) == 'insitu' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="insitu" style="color: #000000;">Insitu</label>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- Lokasi -->
                    <tr>
                        <td><p style="margin: 0; color: #000000;">Lokasi PT</p></td>
                        <td colspan="3">
                            <input type="text" name="lokasiPT" class="kalibrasi-input"
                                   value="{{ old('lokasiPT', $calibration->lokasiPT) }}">
                        </td>
                    </tr>
                    
                    <tr>
                        <td><p style="margin: 0; color: #000000;">Kode TH</p></td>
                        <td colspan="3">
                            <input type="text" name="kode_th" class="kalibrasi-input"
                                   value="{{ old('kode_th', $calibration->kode_th) }}">
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
                                <input type="radio" name="kondisiAlat" value="ok" class="form-check-input"
                                       style="width: 18px; height: 18px; display: block; margin: 0 auto;"
                                       {{ old('kondisiAlat', $calibration->kondisiAlat) == 'ok' ? 'checked' : '' }} required>
                            </div>
                            <div class="text-center">
                                <span class="fw-bold d-block mb-2" style="color: #000000; font-size: 14px;">Rusak</span>
                                <input type="radio" name="kondisiAlat" value="rusak" class="form-check-input"
                                       style="width: 18px; height: 18px; display: block; margin: 0 auto;"
                                       {{ old('kondisiAlat', $calibration->kondisiAlat) == 'rusak' ? 'checked' : '' }} required>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center">
                            <span class="fw-bold me-3" style="color: #000000; min-width: 100px;">Keterangan :</span>
                            <div style="flex: 1;">
                                <input type="text" name="keterangan" class="kalibrasi-input"
                                       value="{{ old('keterangan', $calibration->keterangan ?? '-') }}"
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
                                <td><input type="text" name="RT_condition1" class="kondisi-input" value="{{ old('RT_condition1', $calibration->RT_condition1 ?? '-') }}"></td>
                                <td><input type="text" name="RT_condition2" class="kondisi-input" value="{{ old('RT_condition2', $calibration->RT_condition2 ?? '-') }}"></td>
                                <td><input type="text" name="RT_condition3" class="kondisi-input" value="{{ old('RT_condition3', $calibration->RT_condition3 ?? '-') }}"></td>
                            </tr>
                            <tr>
                                <td class="bg-light fw-bold" style="color: #000000;">RH (%)</td>
                                <td><input type="text" name="RH_condition1" class="kondisi-input" value="{{ old('RH_condition1', $calibration->RH_condition1 ?? '-') }}"></td>
                                <td><input type="text" name="RH_condition2" class="kondisi-input" value="{{ old('RH_condition2', $calibration->RH_condition2 ?? '-') }}"></td>
                                <td><input type="text" name="RH_condition3" class="kondisi-input" value="{{ old('RH_condition3', $calibration->RH_condition3 ?? '-') }}"></td>
                            </tr>
                        </table>
                    </div>
                </div>
<!-- ==================== DATA KALIBRASI ==================== -->
@php
    // Ambil detail measurements
    $details = $calibration->detailInsulations ?? collect();
    
    // Kelompokkan data berdasarkan parameter dari detail yang sudah ada
    $groupedDetails = [];
    $activeParams = [];
    foreach ($details as $detail) {
        $param = $detail->parameter_type;
        if (!isset($groupedDetails[$param])) {
            $groupedDetails[$param] = [];
        }
        $groupedDetails[$param][] = $detail;
        
        // Kumpulkan parameter yang unik
        if (!in_array($param, $activeParams)) {
            $activeParams[] = $param;
        }
    }
    
    // Jika tidak ada detail, coba dari parameter lain (fallback)
    if (empty($activeParams)) {
        if (isset($calibration->active_parameters)) {
            $tempParams = $calibration->active_parameters;
            if (is_string($tempParams)) {
                $tempParams = json_decode($tempParams, true) ?? [];
            }
            if (is_array($tempParams)) {
                $activeParams = $tempParams;
            }
        }
    }
    
    if (!is_array($activeParams)) {
        $activeParams = [];
    }
    
    // Ambil data terpilih untuk checkbox
    $acVoltChecked = in_array('ac_voltage', $activeParams) ? 'checked' : '';
    $dcVoltChecked = in_array('dc_voltage', $activeParams) ? 'checked' : '';
    $acCurrChecked = in_array('ac_current', $activeParams) ? 'checked' : '';
    $dcCurrChecked = in_array('dc_current', $activeParams) ? 'checked' : '';
    $resChecked = in_array('resistance', $activeParams) ? 'checked' : '';
    
    // Fungsi untuk ekstrak nilai dan satuan dari string
    if (!function_exists('extractValueAndUnit')) {
        function extractValueAndUnit($string) {
            if (empty($string)) return ['value' => '', 'unit' => ''];
            $parts = explode(' ', trim($string));
            if (count($parts) >= 2) {
                $unit = end($parts);
                $value = trim(str_replace($unit, '', $string));
                return ['value' => $value, 'unit' => $unit];
            }
            return ['value' => $string, 'unit' => ''];
        }
    }
    
    // Fungsi untuk ekstrak nilai dan satuan dari titik_ukur
    if (!function_exists('extractTitikUkur')) {
        function extractTitikUkur($titikUkur, $defaultUnit = '') {
            if (empty($titikUkur)) return ['value' => '', 'unit' => $defaultUnit];
            $parts = explode(' ', trim($titikUkur));
            if (count($parts) >= 2) {
                $unit = end($parts);
                $value = trim(str_replace($unit, '', $titikUkur));
                return ['value' => $value, 'unit' => $unit];
            }
            return ['value' => $titikUkur, 'unit' => $defaultUnit];
        }
    }
@endphp

<!-- ==================== PILIHAN PARAMETER ==================== -->
<div class="row mb-4 p-3 bg-light border rounded" style="color: #000;">
    <h6 class="fw-bold"><i class="fas fa-tasks me-2"></i>Pilih Parameter Multimeter yang Dikalibrasi:</h6>
    <div class="col-md-12 d-flex flex-wrap gap-4 mt-2">
        <div class="form-check">
            <input class="form-check-input param-checkbox" type="checkbox" name="active_parameters[]" value="ac_voltage" id="chk_ac_voltage" data-target="section_ac_voltage" onchange="window.toggleParamSection(this)" {{ $acVoltChecked }}>
            <label class="form-check-label fw-bold" for="chk_ac_voltage">AC Voltage</label>
        </div>
        <div class="form-check">
            <input class="form-check-input param-checkbox" type="checkbox" name="active_parameters[]" value="dc_voltage" id="chk_dc_voltage" data-target="section_dc_voltage" onchange="window.toggleParamSection(this)" {{ $dcVoltChecked }}>
            <label class="form-check-label fw-bold" for="chk_dc_voltage">DC Voltage</label>
        </div>
        <div class="form-check">
            <input class="form-check-input param-checkbox" type="checkbox" name="active_parameters[]" value="ac_current" id="chk_ac_current" data-target="section_ac_current" onchange="window.toggleParamSection(this)" {{ $acCurrChecked }}>
            <label class="form-check-label fw-bold" for="chk_ac_current">AC Current</label>
        </div>
        <div class="form-check">
            <input class="form-check-input param-checkbox" type="checkbox" name="active_parameters[]" value="dc_current" id="chk_dc_current" data-target="section_dc_current" onchange="window.toggleParamSection(this)" {{ $dcCurrChecked }}>
            <label class="form-check-label fw-bold" for="chk_dc_current">DC Current</label>
        </div>
        <div class="form-check">
            <input class="form-check-input param-checkbox" type="checkbox" name="active_parameters[]" value="resistance" id="chk_resistance" data-target="section_resistance" onchange="window.toggleParamSection(this)" {{ $resChecked }}>
            <label class="form-check-label fw-bold" for="chk_resistance">Resistance</label>
        </div>
    </div>
</div>

<!-- ==================== TABLES ==================== -->

<!-- 1. AC Voltage Table -->
@php
    $acVoltageDetails = isset($groupedDetails['ac_voltage']) ? $groupedDetails['ac_voltage'] : [];
@endphp
<div id="section_ac_voltage" class="parameter-section mb-4" style="{{ $acVoltChecked ? 'display: block;' : 'display: none;' }}">
    <table class="parameter-table table table-bordered" style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
        <thead>
            <tr class="insulation-header-row">
                <td colspan="10" class="insulation-header-cell" style="font-size: 11pt !important;">DATA KALIBRASI</td>
            </tr>
            <tr class="insulation-spacer-row">
                <td colspan="10" style="background-color: #d9d9d9; border: 1px solid #000; font-size: 1pt;">&nbsp;</td>
            </tr>
            <tr class="insulation-header-row">
                <td colspan="10" class="insulation-header-cell-italic" style="font-size: 11pt !important;">AC Voltage</td>
            </tr>
            <tr class="insulation-header-row">
                <td rowspan="2" class="insulation-header-cell" style="width: 60pt; vertical-align:middle; font-size: 11pt !important;">Rentang</td>
                <td rowspan="2" class="insulation-header-cell" style="width: 60pt; vertical-align:middle; font-size: 11pt !important;">Penunjukan Standard</td>
                <td rowspan="2" class="insulation-header-cell" style="width: 60pt; vertical-align:middle; font-size: 11pt !important;">Frekuensi</td>
                <td colspan="5" class="insulation-header-cell" style="width: 300pt; font-size: 11pt !important;">Pembacaan Alat</td>
                <td rowspan="2" class="insulation-header-cell" style="width: 60pt; vertical-align:middle; font-size: 11pt !important;">Resolusi Alat</td>
            </tr>
            <tr class="insulation-header-row">
                <td class="insulation-header-cell" style="width: 60pt; font-size: 11pt !important;">1</td>
                <td class="insulation-header-cell" style="width: 60pt; font-size: 11pt !important;">2</td>
                <td class="insulation-header-cell" style="width: 60pt; font-size: 11pt !important;">3</td>
                <td class="insulation-header-cell" style="width: 60pt; font-size: 11pt !important;">4</td>
                <td class="insulation-header-cell" style="width: 60pt; font-size: 11pt !important;">5</td>
            </tr>
        </thead>
        <tbody>
            @php
                $acVoltageIndex = 0;
            @endphp
            @for($i = 0; $i < 9; $i++)
            @php
                $unit = ($i == 0) ? 'mV' : 'V';
                
                // Ambil 4 detail untuk 4 titik ukur
                $detail1 = isset($acVoltageDetails[$acVoltageIndex]) ? $acVoltageDetails[$acVoltageIndex] : null;
                $acVoltageIndex++;
                $detail2 = isset($acVoltageDetails[$acVoltageIndex]) ? $acVoltageDetails[$acVoltageIndex] : null;
                $acVoltageIndex++;
                $detail3 = isset($acVoltageDetails[$acVoltageIndex]) ? $acVoltageDetails[$acVoltageIndex] : null;
                $acVoltageIndex++;
                $detail4 = isset($acVoltageDetails[$acVoltageIndex]) ? $acVoltageDetails[$acVoltageIndex] : null;
                $acVoltageIndex++;
                
                // Ekstrak rentang dari detail pertama
                if ($detail1 && !empty($detail1->rentang)) {
                    $rentangData = extractValueAndUnit($detail1->rentang);
                    $rentangValue = $rentangData['value'];
                    $rentangUnit = !empty($rentangData['unit']) ? $rentangData['unit'] : $unit;
                } else {
                    $rentangValue = '';
                    $rentangUnit = $unit;
                }
                
                // Ekstrak masing-masing titik ukur
                $titik1 = $detail1 ? extractTitikUkur($detail1->titik_ukur, $unit) : ['value' => '', 'unit' => $unit];
                $titik2 = $detail2 ? extractTitikUkur($detail2->titik_ukur, $unit) : ['value' => '', 'unit' => $unit];
                $titik3 = $detail3 ? extractTitikUkur($detail3->titik_ukur, $unit) : ['value' => '', 'unit' => $unit];
                $titik4 = $detail4 ? extractTitikUkur($detail4->titik_ukur, $unit) : ['value' => '', 'unit' => $unit];
                
                // Frequency masing-masing
                $freq1 = $detail1 ? $detail1->frequency : '';
                $freq2 = $detail2 ? $detail2->frequency : '';
                $freq3 = $detail3 ? $detail3->frequency : '';
                $freq4 = $detail4 ? $detail4->frequency : '';
                
                // Resolusi alat dari detail pertama
                $resolusiAlat = $detail1 ? $detail1->resolusi_alat : '';
            @endphp
            <tr>
                <td rowspan="4" class="insulation-data-cell" style="vertical-align:middle; text-align:center; background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][rentang]" class="table-input-dotted" value="{{ $rentangValue }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                    <input type="hidden" name="insulation_data[ac_voltage][{{ $i }}][satuan]" value="{{ $rentangUnit }}">
                    <span style="font-size:8pt; color:#000; font-weight:bold;">{{ $rentangUnit }}</span>
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][titik_ukur_1]" class="table-input-dotted" value="{{ $titik1['value'] }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                    <span style="font-size:8pt; color:#000;">{{ $titik1['unit'] }}</span>
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][frequency_1]" class="table-input-dotted" value="{{ $freq1 }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                    <span style="font-size:8pt; color:#000;">Hz</span>
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_1_1]" class="table-input-dotted" value="{{ $detail1->readAlat_1 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_1_2]" class="table-input-dotted" value="{{ $detail1->readAlat_2 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_1_3]" class="table-input-dotted" value="{{ $detail1->readAlat_3 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_1_4]" class="table-input-dotted" value="{{ $detail1->readAlat_4 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_1_5]" class="table-input-dotted" value="{{ $detail1->readAlat_5 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][resolusi_alat_1_1]" class="table-input-dotted" value="{{ $detail1->resolusi_alat ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
            </tr>
            <tr>
                <td class="insulation-data-cell" style="width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][titik_ukur_2]" class="table-input-dotted" value="{{ $titik2['value'] }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                    <span style="font-size:8pt; color:#000;">{{ $titik2['unit'] }}</span>
                </td>
                <td class="insulation-data-cell" style="width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][frequency_2]" class="table-input-dotted" value="{{ $freq2 }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                    <span style="font-size:8pt; color:#000;">Hz</span>
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_2_1]" class="table-input-dotted" value="{{ $detail2->readAlat_1 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_2_2]" class="table-input-dotted" value="{{ $detail2->readAlat_2 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_2_3]" class="table-input-dotted" value="{{ $detail2->readAlat_3 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_2_4]" class="table-input-dotted" value="{{ $detail2->readAlat_4 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_2_5]" class="table-input-dotted" value="{{ $detail2->readAlat_5 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][resolusi_alat_2_1]" class="table-input-dotted" value="{{ $detail2->resolusi_alat ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
            </tr>
            <tr>
                <td class="insulation-data-cell" style="width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][titik_ukur_3]" class="table-input-dotted" value="{{ $titik3['value'] }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                    <span style="font-size:8pt; color:#000;">{{ $titik3['unit'] }}</span>
                </td>
                <td class="insulation-data-cell" style="width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][frequency_3]" class="table-input-dotted" value="{{ $freq3 }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                    <span style="font-size:8pt; color:#000;">Hz</span>
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_3_1]" class="table-input-dotted" value="{{ $detail3->readAlat_1 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_3_2]" class="table-input-dotted" value="{{ $detail3->readAlat_2 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_3_3]" class="table-input-dotted" value="{{ $detail3->readAlat_3 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_3_4]" class="table-input-dotted" value="{{ $detail3->readAlat_4 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_3_5]" class="table-input-dotted" value="{{ $detail3->readAlat_5 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][resolusi_alat_3_1]" class="table-input-dotted" value="{{ $detail3->resolusi_alat ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
            </tr>
            <tr>
                <td class="insulation-data-cell" style="width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][titik_ukur_4]" class="table-input-dotted" value="{{ $titik4['value'] }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                    <span style="font-size:8pt; color:#000;">{{ $titik4['unit'] }}</span>
                </td>
                <td class="insulation-data-cell" style="width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][frequency_4]" class="table-input-dotted" value="{{ $freq4 }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                    <span style="font-size:8pt; color:#000;">Hz</span>
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_4_1]" class="table-input-dotted" value="{{ $detail4->readAlat_1 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_4_2]" class="table-input-dotted" value="{{ $detail4->readAlat_2 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_4_3]" class="table-input-dotted" value="{{ $detail4->readAlat_3 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_4_4]" class="table-input-dotted" value="{{ $detail4->readAlat_4 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_4_5]" class="table-input-dotted" value="{{ $detail4->readAlat_5 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][resolusi_alat_4_1]" class="table-input-dotted" value="{{ $detail4->resolusi_alat ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
            </tr>
            @endfor
        </tbody>
    </table>
</div>

<!-- 2. DC Voltage Table -->
@php
    $dcVoltageDetails = isset($groupedDetails['dc_voltage']) ? $groupedDetails['dc_voltage'] : [];
@endphp
<div id="section_dc_voltage" class="parameter-section mb-4" style="{{ $dcVoltChecked ? 'display: block;' : 'display: none;' }}">
    <table class="parameter-table table table-bordered" style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
        <thead>
            <tr class="insulation-header-row">
                <td colspan="9" class="insulation-header-cell" style="font-size: 11pt !important;">DATA KALIBRASI</td>
            </tr>
            <tr class="insulation-spacer-row">
                <td colspan="9" style="background-color: #d9d9d9; border: 1px solid #000; font-size: 1pt;">&nbsp;</td>
            </tr>
            <tr class="insulation-header-row">
                <td colspan="9" class="insulation-header-cell-italic" style="font-size: 11pt !important;">DC Voltage</td>
            </tr>
            <tr class="insulation-header-row">
                <td rowspan="2" class="insulation-header-cell" style="width: 60pt; vertical-align:middle; font-size: 11pt !important;">Rentang</td>
                <td rowspan="2" class="insulation-header-cell" style="width: 60pt; vertical-align:middle; font-size: 11pt !important;">Penunjukan Standard</td>
                <td colspan="5" class="insulation-header-cell" style="width: 300pt; font-size: 11pt !important;">Pembacaan Alat</td>
                <td rowspan="2" class="insulation-header-cell" style="width: 60pt; vertical-align:middle; font-size: 11pt !important;">Resolusi Alat</td>
            </tr>
            <tr class="insulation-header-row">
                <td class="insulation-header-cell" style="width: 60pt; font-size: 11pt !important;">1</td>
                <td class="insulation-header-cell" style="width: 60pt; font-size: 11pt !important;">2</td>
                <td class="insulation-header-cell" style="width: 60pt; font-size: 11pt !important;">3</td>
                <td class="insulation-header-cell" style="width: 60pt; font-size: 11pt !important;">4</td>
                <td class="insulation-header-cell" style="width: 60pt; font-size: 11pt !important;">5</td>
            </tr>
        </thead>
        <tbody>
            @php
                $dcVoltageIndex = 0;
            @endphp
            @for($i = 0; $i < 9; $i++)
            @php
                $unit = ($i == 0) ? 'mV' : 'V';
                
                $detail1 = isset($dcVoltageDetails[$dcVoltageIndex]) ? $dcVoltageDetails[$dcVoltageIndex] : null;
                $dcVoltageIndex++;
                $detail2 = isset($dcVoltageDetails[$dcVoltageIndex]) ? $dcVoltageDetails[$dcVoltageIndex] : null;
                $dcVoltageIndex++;
                $detail3 = isset($dcVoltageDetails[$dcVoltageIndex]) ? $dcVoltageDetails[$dcVoltageIndex] : null;
                $dcVoltageIndex++;
                $detail4 = isset($dcVoltageDetails[$dcVoltageIndex]) ? $dcVoltageDetails[$dcVoltageIndex] : null;
                $dcVoltageIndex++;
                
                if ($detail1 && !empty($detail1->rentang)) {
                    $rentangData = extractValueAndUnit($detail1->rentang);
                    $rentangValue = $rentangData['value'];
                    $rentangUnit = !empty($rentangData['unit']) ? $rentangData['unit'] : $unit;
                } else {
                    $rentangValue = '';
                    $rentangUnit = $unit;
                }
                
                $titik1 = $detail1 ? extractTitikUkur($detail1->titik_ukur, $unit) : ['value' => '', 'unit' => $unit];
                $titik2 = $detail2 ? extractTitikUkur($detail2->titik_ukur, $unit) : ['value' => '', 'unit' => $unit];
                $titik3 = $detail3 ? extractTitikUkur($detail3->titik_ukur, $unit) : ['value' => '', 'unit' => $unit];
                $titik4 = $detail4 ? extractTitikUkur($detail4->titik_ukur, $unit) : ['value' => '', 'unit' => $unit];
                
                $resolusiAlat = $detail1 ? $detail1->resolusi_alat : '';
            @endphp
            <tr>
                <td rowspan="4" class="insulation-data-cell" style="vertical-align:middle; text-align:center; background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][rentang]" class="table-input-dotted" value="{{ $rentangValue }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                    <input type="hidden" name="insulation_data[dc_voltage][{{ $i }}][satuan]" value="{{ $rentangUnit }}">
                    <span style="font-size:8pt; color:#000; font-weight:bold;">{{ $rentangUnit }}</span>
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][titik_ukur_1]" class="table-input-dotted" value="{{ $titik1['value'] }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                    <span style="font-size:8pt; color:#000;">{{ $titik1['unit'] }}</span>
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_1_1]" class="table-input-dotted" value="{{ $detail1->readAlat_1 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_1_2]" class="table-input-dotted" value="{{ $detail1->readAlat_2 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_1_3]" class="table-input-dotted" value="{{ $detail1->readAlat_3 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_1_4]" class="table-input-dotted" value="{{ $detail1->readAlat_4 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_1_5]" class="table-input-dotted" value="{{ $detail1->readAlat_5 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][resolusi_alat_1_1]" class="table-input-dotted" value="{{ $detail1->resolusi_alat ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
            </tr>
            <tr>
                <td class="insulation-data-cell" style="width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][titik_ukur_2]" class="table-input-dotted" value="{{ $titik2['value'] }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                    <span style="font-size:8pt; color:#000;">{{ $titik2['unit'] }}</span>
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_2_1]" class="table-input-dotted" value="{{ $detail2->readAlat_1 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_2_2]" class="table-input-dotted" value="{{ $detail2->readAlat_2 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_2_3]" class="table-input-dotted" value="{{ $detail2->readAlat_3 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_2_4]" class="table-input-dotted" value="{{ $detail2->readAlat_4 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_2_5]" class="table-input-dotted" value="{{ $detail2->readAlat_5 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][resolusi_alat_2_1]" class="table-input-dotted" value="{{ $detail2->resolusi_alat ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
            </tr>
            <tr>
                <td class="insulation-data-cell" style="width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][titik_ukur_3]" class="table-input-dotted" value="{{ $titik3['value'] }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                    <span style="font-size:8pt; color:#000;">{{ $titik3['unit'] }}</span>
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_3_1]" class="table-input-dotted" value="{{ $detail3->readAlat_1 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_3_2]" class="table-input-dotted" value="{{ $detail3->readAlat_2 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_3_3]" class="table-input-dotted" value="{{ $detail3->readAlat_3 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_3_4]" class="table-input-dotted" value="{{ $detail3->readAlat_4 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_3_5]" class="table-input-dotted" value="{{ $detail3->readAlat_5 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][resolusi_alat_3_1]" class="table-input-dotted" value="{{ $detail3->resolusi_alat ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
            </tr>
            <tr>
                <td class="insulation-data-cell" style="width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][titik_ukur_4]" class="table-input-dotted" value="{{ $titik4['value'] }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                    <span style="font-size:8pt; color:#000;">{{ $titik4['unit'] }}</span>
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_4_1]" class="table-input-dotted" value="{{ $detail4->readAlat_1 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_4_2]" class="table-input-dotted" value="{{ $detail4->readAlat_2 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_4_3]" class="table-input-dotted" value="{{ $detail4->readAlat_3 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_4_4]" class="table-input-dotted" value="{{ $detail4->readAlat_4 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_4_5]" class="table-input-dotted" value="{{ $detail4->readAlat_5 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][resolusi_alat_4_1]" class="table-input-dotted" value="{{ $detail4->resolusi_alat ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                </td>
            </tr>
            @endfor
        </tbody>
    </table>
</div>

<!-- 3. AC Current Table -->
@php
    $acCurrentDetails = isset($groupedDetails['ac_current']) ? $groupedDetails['ac_current'] : [];
@endphp
<div id="section_ac_current" class="parameter-section mb-4" style="{{ $acCurrChecked ? 'display: block;' : 'display: none;' }}">
   <table class="parameter-table table table-bordered" style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
    <thead>
        <tr class="insulation-header-row">
            <td colspan="10" class="insulation-header-cell" style="font-size: 11pt !important;">DATA KALIBRASI</td>
        </tr>
        <tr class="insulation-spacer-row">
            <td colspan="10" style="background-color: #d9d9d9; border: 1px solid #000; font-size: 1pt;">&nbsp;</td>
        </tr>
        <tr class="insulation-header-row">
            <td colspan="10" class="insulation-header-cell-italic" style="font-size: 11pt !important;">AC Current</td>
        </tr>
        <tr class="insulation-header-row">
            <td rowspan="2" class="insulation-header-cell" style="width: 60pt; vertical-align:middle; font-size: 11pt !important;">Rentang</td>
            <td rowspan="2" class="insulation-header-cell" style="width: 60pt; vertical-align:middle; font-size: 11pt !important;">Penunjukan Standard</td>
            <td rowspan="2" class="insulation-header-cell" style="width: 60pt; vertical-align:middle; font-size: 11pt !important;">Frekuensi</td>
            <td colspan="5" class="insulation-header-cell" style="width: 300pt; font-size: 11pt !important;">Pembacaan Alat</td>
            <td rowspan="2" class="insulation-header-cell" style="width: 60pt; vertical-align:middle; font-size: 11pt !important;">Resolusi Alat</td>
        </tr>
        <tr class="insulation-header-row">
            <td class="insulation-header-cell" style="width: 60pt; font-size: 11pt !important;">1</td>
            <td class="insulation-header-cell" style="width: 60pt; font-size: 11pt !important;">2</td>
            <td class="insulation-header-cell" style="width: 60pt; font-size: 11pt !important;">3</td>
            <td class="insulation-header-cell" style="width: 60pt; font-size: 11pt !important;">4</td>
            <td class="insulation-header-cell" style="width: 60pt; font-size: 11pt !important;">5</td>
        </tr>
    </thead>
    <tbody>
        @php
            $acCurrentIndex = 0;
        @endphp
        @for($i = 0; $i < 9; $i++)
        @php
            if ($i < 3) {
                $unit = 'µA';
            } elseif ($i < 6) {
                $unit = 'mA';
            } else {
                $unit = 'A';
            }
            
            $detail1 = isset($acCurrentDetails[$acCurrentIndex]) ? $acCurrentDetails[$acCurrentIndex] : null;
            $acCurrentIndex++;
            $detail2 = isset($acCurrentDetails[$acCurrentIndex]) ? $acCurrentDetails[$acCurrentIndex] : null;
            $acCurrentIndex++;
            $detail3 = isset($acCurrentDetails[$acCurrentIndex]) ? $acCurrentDetails[$acCurrentIndex] : null;
            $acCurrentIndex++;
            
            if ($detail1 && !empty($detail1->rentang)) {
                $rentangData = extractValueAndUnit($detail1->rentang);
                $rentangValue = $rentangData['value'];
                $rentangUnit = !empty($rentangData['unit']) ? $rentangData['unit'] : $unit;
            } else {
                $rentangValue = '';
                $rentangUnit = $unit;
            }
            
            $titik1 = $detail1 ? extractTitikUkur($detail1->titik_ukur, $unit) : ['value' => '', 'unit' => $unit];
            $titik2 = $detail2 ? extractTitikUkur($detail2->titik_ukur, $unit) : ['value' => '', 'unit' => $unit];
            $titik3 = $detail3 ? extractTitikUkur($detail3->titik_ukur, $unit) : ['value' => '', 'unit' => $unit];
            
            $freq1 = $detail1 ? $detail1->frequency : '';
            $freq2 = $detail2 ? $detail2->frequency : '';
            $freq3 = $detail3 ? $detail3->frequency : '';
            
            $resolusiAlat = $detail1 ? $detail1->resolusi_alat : '';
        @endphp
        <tr>
            <td rowspan="3" class="insulation-data-cell" style="vertical-align:middle; text-align:center; background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[ac_current][{{ $i }}][rentang]" class="table-input-dotted" value="{{ $rentangValue }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                <input type="hidden" name="insulation_data[ac_current][{{ $i }}][satuan]" value="{{ $rentangUnit }}">
                <span style="font-size:8pt; color:#000; font-weight:bold;">{{ $rentangUnit }}</span>
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[ac_current][{{ $i }}][titik_ukur_1]" class="table-input-dotted" value="{{ $titik1['value'] }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                <span style="font-size:8pt; color:#000;">{{ $titik1['unit'] }}</span>
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[ac_current][{{ $i }}][frequency_1]" class="table-input-dotted" value="{{ $freq1 }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                <span style="font-size:8pt; color:#000;">Hz</span>
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[ac_current][{{ $i }}][readAlat_1_1]" class="table-input-dotted" value="{{ $detail1->readAlat_1 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[ac_current][{{ $i }}][readAlat_1_2]" class="table-input-dotted" value="{{ $detail1->readAlat_2 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[ac_current][{{ $i }}][readAlat_1_3]" class="table-input-dotted" value="{{ $detail1->readAlat_3 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[ac_current][{{ $i }}][readAlat_1_4]" class="table-input-dotted" value="{{ $detail1->readAlat_4 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[ac_current][{{ $i }}][readAlat_1_5]" class="table-input-dotted" value="{{ $detail1->readAlat_5 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[ac_current][{{ $i }}][resolusi_alat_1_1]" class="table-input-dotted" value="{{ $detail1->resolusi_alat ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
        </tr>
        <tr>
            <td class="insulation-data-cell" style="width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[ac_current][{{ $i }}][titik_ukur_2]" class="table-input-dotted" value="{{ $titik2['value'] }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                <span style="font-size:8pt; color:#000;">{{ $titik2['unit'] }}</span>
            </td>
            <td class="insulation-data-cell" style="width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[ac_current][{{ $i }}][frequency_2]" class="table-input-dotted" value="{{ $freq2 }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                <span style="font-size:8pt; color:#000;">Hz</span>
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[ac_current][{{ $i }}][readAlat_2_1]" class="table-input-dotted" value="{{ $detail2->readAlat_1 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[ac_current][{{ $i }}][readAlat_2_2]" class="table-input-dotted" value="{{ $detail2->readAlat_2 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[ac_current][{{ $i }}][readAlat_2_3]" class="table-input-dotted" value="{{ $detail2->readAlat_3 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[ac_current][{{ $i }}][readAlat_2_4]" class="table-input-dotted" value="{{ $detail2->readAlat_4 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[ac_current][{{ $i }}][readAlat_2_5]" class="table-input-dotted" value="{{ $detail2->readAlat_5 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[ac_current][{{ $i }}][resolusi_alat_2_1]" class="table-input-dotted" value="{{ $detail2->resolusi_alat ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
        </tr>
        <tr>
            <td class="insulation-data-cell" style="width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[ac_current][{{ $i }}][titik_ukur_3]" class="table-input-dotted" value="{{ $titik3['value'] }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                <span style="font-size:8pt; color:#000;">{{ $titik3['unit'] }}</span>
            </td>
            <td class="insulation-data-cell" style="width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[ac_current][{{ $i }}][frequency_3]" class="table-input-dotted" value="{{ $freq3 }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                <span style="font-size:8pt; color:#000;">Hz</span>
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[ac_current][{{ $i }}][readAlat_3_1]" class="table-input-dotted" value="{{ $detail3->readAlat_1 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[ac_current][{{ $i }}][readAlat_3_2]" class="table-input-dotted" value="{{ $detail3->readAlat_2 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[ac_current][{{ $i }}][readAlat_3_3]" class="table-input-dotted" value="{{ $detail3->readAlat_3 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[ac_current][{{ $i }}][readAlat_3_4]" class="table-input-dotted" value="{{ $detail3->readAlat_4 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[ac_current][{{ $i }}][readAlat_3_5]" class="table-input-dotted" value="{{ $detail3->readAlat_5 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[ac_current][{{ $i }}][resolusi_alat_3_1]" class="table-input-dotted" value="{{ $detail3->resolusi_alat ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
        </tr>
        @endfor
    </tbody>
</table>
</div>

<!-- 4. DC Current Table -->
@php
    $dcCurrentDetails = isset($groupedDetails['dc_current']) ? $groupedDetails['dc_current'] : [];
@endphp
<div id="section_dc_current" class="parameter-section mb-4" style="{{ $dcCurrChecked ? 'display: block;' : 'display: none;' }}">
    <table class="parameter-table table table-bordered" style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
    <thead>
        <tr class="insulation-header-row">
            <td colspan="9" class="insulation-header-cell" style="font-size: 11pt !important;">DATA KALIBRASI</td>
        </tr>
        <tr class="insulation-spacer-row">
            <td colspan="9" style="background-color: #d9d9d9; border: 1px solid #000; font-size: 1pt;">&nbsp;</td>
        </tr>
        <tr class="insulation-header-row">
            <td colspan="9" class="insulation-header-cell-italic" style="font-size: 11pt !important;">DC Current</td>
        </tr>
        <tr class="insulation-header-row">
            <td rowspan="2" class="insulation-header-cell" style="width: 60pt; vertical-align:middle; font-size: 11pt !important;">Rentang</td>
            <td rowspan="2" class="insulation-header-cell" style="width: 60pt; vertical-align:middle; font-size: 11pt !important;">Penunjukan Standard</td>
            <td colspan="5" class="insulation-header-cell" style="width: 300pt; font-size: 11pt !important;">Pembacaan Alat</td>
            <td rowspan="2" class="insulation-header-cell" style="width: 60pt; vertical-align:middle; font-size: 11pt !important;">Resolusi Alat</td>
        </tr>
        <tr class="insulation-header-row">
            <td class="insulation-header-cell" style="width: 60pt; font-size: 11pt !important;">1</td>
            <td class="insulation-header-cell" style="width: 60pt; font-size: 11pt !important;">2</td>
            <td class="insulation-header-cell" style="width: 60pt; font-size: 11pt !important;">3</td>
            <td class="insulation-header-cell" style="width: 60pt; font-size: 11pt !important;">4</td>
            <td class="insulation-header-cell" style="width: 60pt; font-size: 11pt !important;">5</td>
        </tr>
    </thead>
    <tbody>
        @php
            $dcCurrentIndex = 0;
        @endphp
        @for($i = 0; $i < 9; $i++)
        @php
            if ($i < 3) {
                $unit = 'µA';
            } elseif ($i < 6) {
                $unit = 'mA';
            } else {
                $unit = 'A';
            }
            
            $detail1 = isset($dcCurrentDetails[$dcCurrentIndex]) ? $dcCurrentDetails[$dcCurrentIndex] : null;
            $dcCurrentIndex++;
            $detail2 = isset($dcCurrentDetails[$dcCurrentIndex]) ? $dcCurrentDetails[$dcCurrentIndex] : null;
            $dcCurrentIndex++;
            $detail3 = isset($dcCurrentDetails[$dcCurrentIndex]) ? $dcCurrentDetails[$dcCurrentIndex] : null;
            $dcCurrentIndex++;
            
            if ($detail1 && !empty($detail1->rentang)) {
                $rentangData = extractValueAndUnit($detail1->rentang);
                $rentangValue = $rentangData['value'];
                $rentangUnit = !empty($rentangData['unit']) ? $rentangData['unit'] : $unit;
            } else {
                $rentangValue = '';
                $rentangUnit = $unit;
            }
            
            $titik1 = $detail1 ? extractTitikUkur($detail1->titik_ukur, $unit) : ['value' => '', 'unit' => $unit];
            $titik2 = $detail2 ? extractTitikUkur($detail2->titik_ukur, $unit) : ['value' => '', 'unit' => $unit];
            $titik3 = $detail3 ? extractTitikUkur($detail3->titik_ukur, $unit) : ['value' => '', 'unit' => $unit];
            
            $resolusiAlat = $detail1 ? $detail1->resolusi_alat : '';
        @endphp
        <tr>
            <td rowspan="3" class="insulation-data-cell" style="vertical-align:middle; text-align:center; background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[dc_current][{{ $i }}][rentang]" class="table-input-dotted" value="{{ $rentangValue }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                <input type="hidden" name="insulation_data[dc_current][{{ $i }}][satuan]" value="{{ $rentangUnit }}">
                <span style="font-size:8pt; color:#000; font-weight:bold;">{{ $rentangUnit }}</span>
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[dc_current][{{ $i }}][titik_ukur_1]" class="table-input-dotted" value="{{ $titik1['value'] }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                <span style="font-size:8pt; color:#000;">{{ $titik1['unit'] }}</span>
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_1_1]" class="table-input-dotted" value="{{ $detail1->readAlat_1 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_1_2]" class="table-input-dotted" value="{{ $detail1->readAlat_2 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_1_3]" class="table-input-dotted" value="{{ $detail1->readAlat_3 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_1_4]" class="table-input-dotted" value="{{ $detail1->readAlat_4 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_1_5]" class="table-input-dotted" value="{{ $detail1->readAlat_5 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[dc_current][{{ $i }}][resolusi_alat_1_1]" class="table-input-dotted" value="{{ $detail1->resolusi_alat ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
        </tr>
        <tr>
            <td class="insulation-data-cell" style="width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[dc_current][{{ $i }}][titik_ukur_2]" class="table-input-dotted" value="{{ $titik2['value'] }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                <span style="font-size:8pt; color:#000;">{{ $titik2['unit'] }}</span>
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_2_1]" class="table-input-dotted" value="{{ $detail2->readAlat_1 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_2_2]" class="table-input-dotted" value="{{ $detail2->readAlat_2 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_2_3]" class="table-input-dotted" value="{{ $detail2->readAlat_3 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_2_4]" class="table-input-dotted" value="{{ $detail2->readAlat_4 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_2_5]" class="table-input-dotted" value="{{ $detail2->readAlat_5 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[dc_current][{{ $i }}][resolusi_alat_2_1]" class="table-input-dotted" value="{{ $detail2->resolusi_alat ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
        </tr>
        <tr>
            <td class="insulation-data-cell" style="width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[dc_current][{{ $i }}][titik_ukur_3]" class="table-input-dotted" value="{{ $titik3['value'] }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                <span style="font-size:8pt; color:#000;">{{ $titik3['unit'] }}</span>
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_3_1]" class="table-input-dotted" value="{{ $detail3->readAlat_1 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_3_2]" class="table-input-dotted" value="{{ $detail3->readAlat_2 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_3_3]" class="table-input-dotted" value="{{ $detail3->readAlat_3 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_3_4]" class="table-input-dotted" value="{{ $detail3->readAlat_4 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_3_5]" class="table-input-dotted" value="{{ $detail3->readAlat_5 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[dc_current][{{ $i }}][resolusi_alat_3_1]" class="table-input-dotted" value="{{ $detail3->resolusi_alat ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
        </tr>
        @endfor
    </tbody>
</table>
</div>

<!-- 5. Resistance Table -->
@php
    $resistanceDetails = isset($groupedDetails['resistance']) ? $groupedDetails['resistance'] : [];
@endphp
<div id="section_resistance" class="parameter-section mb-4" style="{{ $resChecked ? 'display: block;' : 'display: none;' }}">
    <table class="parameter-table table table-bordered" style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
    <thead>
        <tr class="insulation-header-row">
            <td colspan="9" class="insulation-header-cell" style="font-size: 11pt !important;">DATA KALIBRASI</td>
        </tr>
        <tr class="insulation-spacer-row">
            <td colspan="9" style="background-color: #d9d9d9; border: 1px solid #000; font-size: 1pt;">&nbsp;</td>
        </tr>
        <tr class="insulation-header-row">
            <td colspan="9" class="insulation-header-cell-italic" style="font-size: 11pt !important;">Resistance</td>
        </tr>
        <tr class="insulation-header-row">
            <td rowspan="2" class="insulation-header-cell" style="width: 60pt; vertical-align:middle; font-size: 11pt !important;">Rentang</td>
            <td rowspan="2" class="insulation-header-cell" style="width: 60pt; vertical-align:middle; font-size: 11pt !important;">Penunjukan Standard</td>
            <td colspan="5" class="insulation-header-cell" style="width: 300pt; font-size: 11pt !important;">Pembacaan Alat</td>
            <td rowspan="2" class="insulation-header-cell" style="width: 60pt; vertical-align:middle; font-size: 11pt !important;">Resolusi Alat</td>
        </tr>
        <tr class="insulation-header-row">
            <td class="insulation-header-cell" style="width: 60pt; font-size: 11pt !important;">1</td>
            <td class="insulation-header-cell" style="width: 60pt; font-size: 11pt !important;">2</td>
            <td class="insulation-header-cell" style="width: 60pt; font-size: 11pt !important;">3</td>
            <td class="insulation-header-cell" style="width: 60pt; font-size: 11pt !important;">4</td>
            <td class="insulation-header-cell" style="width: 60pt; font-size: 11pt !important;">5</td>
        </tr>
    </thead>
    <tbody>
        @php
            $resistanceIndex = 0;
        @endphp
        @for($i = 0; $i < 9; $i++)
        @php
            if ($i < 3) {
                $unit = 'Ω';
            } elseif ($i < 6) {
                $unit = 'kΩ';
            } else {
                $unit = 'MΩ';
            }
            
            $detail1 = isset($resistanceDetails[$resistanceIndex]) ? $resistanceDetails[$resistanceIndex] : null;
            $resistanceIndex++;
            $detail2 = isset($resistanceDetails[$resistanceIndex]) ? $resistanceDetails[$resistanceIndex] : null;
            $resistanceIndex++;
            $detail3 = isset($resistanceDetails[$resistanceIndex]) ? $resistanceDetails[$resistanceIndex] : null;
            $resistanceIndex++;
            
            if ($detail1 && !empty($detail1->rentang)) {
                $rentangData = extractValueAndUnit($detail1->rentang);
                $rentangValue = $rentangData['value'];
                $rentangUnit = !empty($rentangData['unit']) ? $rentangData['unit'] : $unit;
            } else {
                $rentangValue = '';
                $rentangUnit = $unit;
            }
            
            $titik1 = $detail1 ? extractTitikUkur($detail1->titik_ukur, $unit) : ['value' => '', 'unit' => $unit];
            $titik2 = $detail2 ? extractTitikUkur($detail2->titik_ukur, $unit) : ['value' => '', 'unit' => $unit];
            $titik3 = $detail3 ? extractTitikUkur($detail3->titik_ukur, $unit) : ['value' => '', 'unit' => $unit];
            
            $resolusiAlat = $detail1 ? $detail1->resolusi_alat : '';
        @endphp
        <tr>
            <td rowspan="3" class="insulation-data-cell" style="vertical-align:middle; text-align:center; background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[resistance][{{ $i }}][rentang]" class="table-input-dotted" value="{{ $rentangValue }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                <input type="hidden" name="insulation_data[resistance][{{ $i }}][satuan]" value="{{ $rentangUnit }}">
                <span style="font-size:8pt; color:#000; font-weight:bold;">{{ $rentangUnit }}</span>
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[resistance][{{ $i }}][titik_ukur_1]" class="table-input-dotted" value="{{ $titik1['value'] }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                <span style="font-size:8pt; color:#000;">{{ $titik1['unit'] }}</span>
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_1_1]" class="table-input-dotted" value="{{ $detail1->readAlat_1 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_1_2]" class="table-input-dotted" value="{{ $detail1->readAlat_2 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_1_3]" class="table-input-dotted" value="{{ $detail1->readAlat_3 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_1_4]" class="table-input-dotted" value="{{ $detail1->readAlat_4 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_1_5]" class="table-input-dotted" value="{{ $detail1->readAlat_5 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[resistance][{{ $i }}][resolusi_alat_1_1]" class="table-input-dotted" value="{{ $detail1->resolusi_alat ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
        </tr>
        <tr>
            <td class="insulation-data-cell" style="width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[resistance][{{ $i }}][titik_ukur_2]" class="table-input-dotted" value="{{ $titik2['value'] }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                <span style="font-size:8pt; color:#000;">{{ $titik2['unit'] }}</span>
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_2_1]" class="table-input-dotted" value="{{ $detail2->readAlat_1 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_2_2]" class="table-input-dotted" value="{{ $detail2->readAlat_2 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_2_3]" class="table-input-dotted" value="{{ $detail2->readAlat_3 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_2_4]" class="table-input-dotted" value="{{ $detail2->readAlat_4 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_2_5]" class="table-input-dotted" value="{{ $detail2->readAlat_5 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[resistance][{{ $i }}][resolusi_alat_2_1]" class="table-input-dotted" value="{{ $detail2->resolusi_alat ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
        </tr>
        <tr>
            <td class="insulation-data-cell" style="width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[resistance][{{ $i }}][titik_ukur_3]" class="table-input-dotted" value="{{ $titik3['value'] }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
                <span style="font-size:8pt; color:#000;">{{ $titik3['unit'] }}</span>
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_3_1]" class="table-input-dotted" value="{{ $detail3->readAlat_1 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_3_2]" class="table-input-dotted" value="{{ $detail3->readAlat_2 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_3_3]" class="table-input-dotted" value="{{ $detail3->readAlat_3 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_3_4]" class="table-input-dotted" value="{{ $detail3->readAlat_4 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_3_5]" class="table-input-dotted" value="{{ $detail3->readAlat_5 ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
            <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt; font-size: 11pt !important;">
                <input type="text" name="insulation_data[resistance][{{ $i }}][resolusi_alat_3_1]" class="table-input-dotted" value="{{ $detail3->resolusi_alat ?? '' }}" style="width:40pt; text-align:center; font-size: 11pt !important;">
            </td>
        </tr>
        @endfor
    </tbody>
</table>
</div>

        <!-- ==================== FOOTER ==================== -->
@php
    $headInsulation = $calibration->headInsulation ?? null;
    $standard = $headInsulation->standard ?? 'Multifunction Calibration System Transmille 1000A';
    $calibrationMethod = $headInsulation->calibrationMethod ?? 'PAS-IK1102-43 A (Multimeter)';
@endphp

<table class="footer-table">
    <tr>
        <td colspan="12" class="title" style="font-size: 11pt;">
            Isilah lembar data kalibrasi dengan lengkap dan jelas!
        </td>
    </tr>
    <tr>
        <td rowspan="2" class="label" style="font-size: 10pt; width: 12%;">Alat Standar</td>
        <td colspan="5" rowspan="2" style="font-size: 10pt; text-align: left; padding-left: 10px; font-weight: bold;">
            {{ $standard }}
        </td>
        <td colspan="3" class="label" style="font-size: 10pt;">Di Kalibrasi oleh</td>
        <td colspan="3" class="label" style="font-size: 10pt;">Di Periksa oleh</td>
    </tr>
    <tr>
    </tr>
    <tr>
        <td rowspan="2" class="label" style="font-size: 10pt;">Metode Kalibrasi</td>
        <td colspan="5" style="text-align: left; padding-left: 10px; font-size: 10pt; font-weight: bold;">
            <input type="hidden" name="metode_1" value="{{ $calibrationMethod }}">
            PAS-IK1102-43 A (Multimeter)
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
            <div class="d-flex align-items-center">
                <span style="font-size: 10pt; color: #000; margin-right: 5px;">Nama:</span>
                <input type="text" name="calibratedBy" class="kalibrasi-input" 
                       value="{{ old('calibratedBy', $calibration->calibratedBy ?? '') }}" 
                       style="font-size: 10pt; width: 100%; border: none; border-bottom: 1px solid #000; background: transparent; padding: 4px 0;" readonly>
            </div>
        </td>
        <td colspan="3" style="text-align: left; padding-left: 20px; font-size: 10pt;">
            <div class="d-flex align-items-center">
                <span style="font-size: 10pt; color: #000; margin-right: 5px;">Nama:</span>
                <input type="text" name="verifiedBy" class="kalibrasi-input" 
                       value="{{ old('verifiedBy', $calibration->verifiedBy ?? '') }}" 
                       style="font-size: 10pt; width: 100%; border: none; border-bottom: 1px solid #000; background: transparent; padding: 4px 0;" readonly>
            </div>
        </td>
    </tr>
</table>

                <!-- Action Buttons Section -->
                <div class="row mt-5">
                    <div class="col-12 text-center">
                        <a href="{{ route('calibrations.index') }}" class="btn btn-secondary btn-lg" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
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

        // ==========================================
        // EDIT FORM VALIDATION & SUBMIT HANDLER
        // ==========================================
        document.getElementById('editForm')?.addEventListener('submit', function(e) {
            console.log('🎯 Edit form submission started...');
            
            // Debug form data
            const formData = new FormData(this);
            console.log('📦 Form data collected for update');
            
            // Log alat standar
            const standardInput = document.querySelector('input[name="standard"]');
            if (standardInput) {
                console.log('📋 Standard:', standardInput.value);
            }
            
            // Log calibration method
            const methodInput = document.querySelector('input[name="calibrationMethod"]');
            if (methodInput) {
                console.log('📋 Calibration Method:', methodInput.value);
            }
            
            // Log kondisi alat radio
            const kondisiAlatSelected = document.querySelector('input[name="kondisiAlat"]:checked');
            console.log('🎚️ Kondisi alat selected:', kondisiAlatSelected ? kondisiAlatSelected.value : 'none');
            
            // Log tempat kalibrasi radio
            const tempatKalibrasiSelected = document.querySelector('input[name="tempatKalibrasi"]:checked');
            console.log('📍 Tempat kalibrasi selected:', tempatKalibrasiSelected ? tempatKalibrasiSelected.value : 'none');
            
            // VALIDASI
            let isValid = true;
            let warningMessages = [];
            
            // 1. Validasi tanggal
            const tanggalMasuk = document.querySelector('input[name="tanggalMasuk"]').value;
            const tanggalKalibrasi = document.querySelector('input[name="tanggalKalibrasi"]').value;
            
            if (tanggalMasuk && tanggalKalibrasi) {
                if (new Date(tanggalMasuk) > new Date(tanggalKalibrasi)) {
                    warningMessages.push('Tanggal alat masuk tidak boleh lebih baru dari tanggal kalibrasi');
                    console.warn('⚠️ Date validation warning: masuk > kalibrasi');
                }
            }
            
            // 2. Validasi kondisi alat (harus dipilih)
            if (!kondisiAlatSelected) {
                warningMessages.push('Pilih kondisi alat (Ok/Rusak)');
                console.warn('⚠️ No kondisi alat selected');
            }
            
            // 3. Validasi tempat kalibrasi (harus dipilih)
            if (!tempatKalibrasiSelected) {
                warningMessages.push('Pilih tempat kalibrasi');
                console.warn('⚠️ No tempat kalibrasi selected');
            }
            
            // Tampilkan warning jika ada
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
            
            // Log data yang akan dikirim
            console.log('📤 Data to be submitted:');
            for (let [key, value] of formData.entries()) {
                if (!key.includes('password') && !key.includes('token')) {
                    console.log(`${key}:`, value);
                }
            }
            
            return true;
        });
        
        // Global function for parameter checkbox toggles
        if (typeof window.toggleParamSection !== 'function') {
            window.toggleParamSection = function(checkbox) {
                const targetId = checkbox.getAttribute('data-target');
                const container = checkbox.closest('.subform-wrapper') || checkbox.closest('.lk-form-container') || document;
                const targetSection = container.querySelector('#' + targetId) || document.getElementById(targetId);
                if (targetSection) {
                    targetSection.style.display = checkbox.checked ? 'block' : 'none';
                    console.log(`📢 Parameter toggled: ${targetId} -> ${targetSection.style.display}`);
                }
            };
        }
        
        // ==========================================
        // ADDITIONAL DEBUG ON PAGE LOAD
        // ==========================================
        document.addEventListener('DOMContentLoaded', function() {
            console.log('📄 Edit form loaded for Multimeter ID:', '{{ $calibration->id }}');
            console.log('🏷️ Certificate ID:', '{{ $calibration->headInsulation->certificate_id ?? "N/A" }}');
            
            // Log current standard and method
            const standard = document.querySelector('input[name="standard"]');
            const method = document.querySelector('input[name="calibrationMethod"]');
            console.log('📋 Current standard:', standard ? standard.value : 'N/A');
            console.log('📋 Current method:', method ? method.value : 'N/A');
            
            // Auto-hide validation messages after 5 seconds
            setTimeout(() => {
                document.querySelectorAll('.is-invalid').forEach(el => {
                    el.classList.remove('is-invalid');
                });
            }, 5000);
        });
    </script>
</body>
</html>