<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Form Kalibrasi Kelistrikan - Clamp Meter</title>
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
        }

        .kondisi-input {
            border: 1px solid #000 !important;
            text-align: center;
            width: 100%;
            padding: 4px;
        }

        /* Form validation styling (Red if empty/invalid, Green if valid/filled) */
        .kalibrasi-input:required:invalid,
        .kondisi-input:required:invalid,
        select.kalibrasi-input:required:invalid {
            border-color: #dc3545 !important;
            background-color: #fff8f8 !important;
        }

        .kalibrasi-input:required:valid,
        .kondisi-input:required:valid,
        select.kalibrasi-input:required:valid {
            border-color: #198754 !important;
            background-color: #f8fff8 !important;
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
            border: none !important;
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
        }

        .parameter-table td,
        .parameter-table th {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
            vertical-align: middle;
            font-size: 9pt;
        }

        .parameter-table th {
            background-color: #d9d9d9;
            font-weight: bold;
        }

        .parameter-table input[type="text"],
        .parameter-table input[type="number"] {
            width: 100%;
            border: none;
            background: transparent;
            text-align: center;
            padding: 4px;
            box-sizing: border-box;
            font-size: 9pt;
            color: #000;
        }

        .parameter-table input[type="text"]:focus,
        .parameter-table input[type="number"]:focus {
            outline: 2px solid #4a90e2;
            background-color: #f0f8ff;
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

        .footer-table input[type="text"] {
            width: 90%;
            border: none;
            background: transparent;
            text-align: center;
            padding: 4px;
            font-size: 9pt;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3b82f6, #1e40af);
            border: none;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
            background: linear-gradient(135deg, #1e40af, #1e3a8a);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #6b7280, #4b5563);
            border: none;
            box-shadow: 0 4px 15px rgba(107, 114, 128, 0.3);
            transition: all 0.3s ease;
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
            border-bottom: 1px solid #4a90e2 !important;
            background-color: #f0f8ff !important;
        }
    </style>
</head>
<body>
    <div class="container my-4">
        <form method="POST" action="/calibrations/{{ $calibration->id }}" id="kalibrasiForm">
            @csrf
            @method('PUT')
            <input type="hidden" name="form_type" value="insulation">
            <input type="hidden" name="insulation_type" value="clampmeter">

            <div class="form-kalibrasi-container">

                <!-- ==================== HEADER ==================== -->
                <table class="kalibrasi-header-table">
                    <tr>
                        <td colspan="2" style="width: 50%;">
                            <p style="margin: 0; font-size: 10pt; color: #000000; text-align: left;">PAS-FLK044</p>
                        </td>
                        <td rowspan="5" style="width: 50%; text-align: center; vertical-align: middle; padding: 10px 0;">
                            <div style="display: inline-block; text-align: center;">
                                <div style="margin-bottom: 10px;">
                                    <img src="/logo/logo_pas_basic.png" alt="Logo PT. PAS" style="width: 107px; height: 54px; display: block; margin: 0 auto;">
                                </div>
                                <p style="font-weight: bold; margin: 0; font-size: 9pt; color: #000000;">PT. PANANJUNG ANUGRAH SOLUTION</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p style="margin: 0; font-size: 10pt; color: #000000; text-align: left;">LEMBAR KERJA KALIBRASI</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p style="margin: 0; font-weight: bold; font-size: 10pt; color: #000000; text-align: left;">KELISTRIKAN (CLAMP METER)</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="margin: 0; font-size: 10pt; color: #000000; text-align: left;">No. Sertifikat</p>
                        </td>
                        <td>
                            <p style="margin: 0; font-size: 10pt; color: #000000; font-weight: bold; text-align: left;">{{ $calibration->headInsulation->certificate_id ?? 'N/A' }}</p>
                        </td>
                    </tr>
                </table>

                <!-- ==================== MAIN FORM ==================== -->
                <table class="kalibrasi-main-table">
                    <tr>
                        <td style="width: 20%;">
                            <p style="margin: 0; color: #000000;">Nama Alat</p>
                        </td>
                        <td colspan="3">
                            <select name="nama_alat" id="nama_alat_select" class="kalibrasi-input" onchange="updateFormType(this.value)" required style="background-color: #f5f5f5; color: #333; border: 1px solid #ced4da; padding: 6px 10px; border-radius: 4px; width: 100%;">
                                <option value="">-- Pilih Alat  --</option>
                                <option value="Clampmeter" {{ old('nama_alat', $calibration->namaAlat) == 'Clampmeter' ? 'selected' : '' }}>Clampmeter</option>
                                <option value="MANUAL_INPUT" {{ old('nama_alat', $calibration->namaAlat) != 'Clampmeter' && old('nama_alat', $calibration->namaAlat) != '' ? 'selected' : '' }}>-- Input Manual Nama Alat --</option>
                            </select>
                            
                            <div id="manualInputContainer" style="{{ old('nama_alat', $calibration->namaAlat) != 'Clampmeter' && old('nama_alat', $calibration->namaAlat) != '' ? 'display: block;' : 'display: none;' }} margin-top: 10px;">
                                <input type="text" name="nama_alat_manual" id="nama_alat_manual"
                                       placeholder="Ketik nama alat"
                                       value="{{ old('nama_alat_manual', $calibration->namaAlat != 'Clampmeter' ? $calibration->namaAlat : '') }}"
                                       style="background-color: #f5f5f5; color: #333; border: 1px solid #ced4da; padding: 6px 10px; border-radius: 4px; width: 100%;"
                                       oninput="syncNamaAlat()">
                            </div>
                            
                            <input type="hidden" name="namaAlat" id="nama_alat_final" value="{{ old('namaAlat', $calibration->namaAlat) }}">
                            <input type="hidden" name="nama_alat_display" id="nama_alat_display" value="">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000; text-align: left; font-size: 10pt;">Merek</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" name="brandAlat" class="kalibrasi-input me-3" placeholder="Masukkan merek alat" style="width: 45%; text-align: left; font-size: 10pt;" value="{{ old('brandAlat', $calibration->brandAlat) }}" required>
                                <span class="me-1" style="color:#000000; font-size: 10pt;">Kode Alat:</span>
                                <input type="text" name="kodeAlat" class="kalibrasi-input" placeholder="Masukkan kode" style="width: 30%; text-align: left; font-size: 10pt;" value="{{ old('kodeAlat', $calibration->kodeAlat) }}" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000; text-align: left; font-size: 10pt;">Type / No. Seri</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" name="typeAlat" class="kalibrasi-input me-3" placeholder="Masukkan Type Alat" style="width: 45%; text-align: left; font-size: 10pt;" value="{{ old('typeAlat', $calibration->typeAlat) }}" oninput="formatTypeAlat(this)" required>
                                <span class="me-3" style="color: #000000; font-size: 10pt;">/</span>
                                <input type="text" name="NoSeri" class="kalibrasi-input" placeholder="Masukkan No. Seri" style="width: 45%; text-align: left; font-size: 10pt;" value="{{ old('NoSeri', $calibration->NoSeri) }}" oninput="formatNoSeri(this)" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000; text-align: left; font-size: 10pt;">Kapasitas / Resolusi</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" name="kapasitas" class="kalibrasi-input me-3" placeholder="Kapasitas" style="width: 45%; text-align: left; font-size: 10pt;" value="{{ old('kapasitas', $calibration->kapasitas) }}" required>
                                <span class="me-3" style="color: #000000; font-size: 10pt;">/</span>
                                <input type="text" name="resolusi" class="kalibrasi-input" placeholder="Resolusi" style="width: 45%; text-align: left; font-size: 10pt;" value="{{ old('resolusi', $calibration->resolusi) }}" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000; text-align: left; font-size: 10pt;">Nama Pemilik</p>
                        </td>
                        <td colspan="3">
                            <input type="text" name="pemilikAlat" class="kalibrasi-input" placeholder="Masukkan nama pemilik/Instansi" style="width: 60%; text-align: left; font-size: 10pt;" value="{{ old('pemilikAlat', $calibration->pemilikAlat) }}" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000; text-align: left; font-size: 10pt;">Tanggal Alat Masuk</p>
                        </td>
                        <td colspan="3">
                            <input type="date" name="tanggalMasuk" class="kalibrasi-input" style="font-size: 10pt;" value="{{ old('tanggalMasuk', $calibration->tanggalMasuk ? \Carbon\Carbon::parse($calibration->tanggalMasuk)->format('Y-m-d') : '') }}" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Tanggal Kalibrasi</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="date" 
                                    name="tanggalKalibrasi" 
                                    class="kalibrasi-input me-3" 
                                    style="width: 45%;" 
                                    required
                                    value="{{ old('tanggalKalibrasi', $calibration->tanggalKalibrasi ? \Carbon\Carbon::parse($calibration->tanggalKalibrasi)->format('Y-m-d') : '') }}">
                                
                                <span class="me-3" style="color: #000000;">Jenis Pembacaan:</span>
                                
                                <select name="jenisPembacaan" class="kalibrasi-input" style="width: 45%;" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="manual" {{ old('jenisPembacaan', $calibration->jenisPembacaan) == 'manual' ? 'selected' : '' }}>Manual</option>
                                    <option value="digital" {{ old('jenisPembacaan', $calibration->jenisPembacaan) == 'digital' ? 'selected' : '' }}>Digital</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000; text-align: left; font-size: 10pt;">Tempat Kalibrasi</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex">
                                <div class="form-check me-5">
                                    <input class="form-check-input" type="radio" name="tempatKalibrasi" value="lab.PT PAS" id="lab" required {{ old('tempatKalibrasi', $calibration->tempatKalibrasi) == 'lab.PT PAS' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="lab" style="color: #000000; font-size: 10pt;">Lab. PT.PAS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tempatKalibrasi" value="insitu" id="insitu" required {{ old('tempatKalibrasi', $calibration->tempatKalibrasi) == 'insitu' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="insitu" style="color: #000000; font-size: 10pt;">Insitu</label>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Lokasi PT</p>
                        </td>
                        <td colspan="3">
                            <input type="text" name="lokasiPT" class="kalibrasi-input" placeholder="Masukkan Lokasi PT" value="{{ old('lokasiPT', $calibration->lokasiPT) }}" required>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Kode TH</p>
                        </td>
                        <td colspan="3">
                            <input type="text" name="kode_th" class="kalibrasi-input" placeholder="Masukkan Kode TH" value="{{ old('kode_th', $calibration->kode_th) }}" required>
                        </td>
                    </tr>
                </table>

                <!-- ==================== FUNGSI KOMPONEN & KONDISI KALIBRASI ==================== -->
                <div class="row mt-4">
                    <div class="col-md-6 mb-4">
                        <div class="kalibrasi-section-header" style="color: #000000; font-size: 10pt;">Fungsi Komponen Lainnya</div>
                        <div class="d-flex justify-content-around align-items-center my-4">
                            <div class="text-center">
                                <span class="fw-bold d-block" style="color: #000000; font-size: 9pt;">Ok</span>
                                <input type="radio" name="kondisiAlat" value="ok" style="transform: scale(1.5); margin: 10px 0;" required {{ old('kondisiAlat', $calibration->kondisiAlat) == 'ok' ? 'checked' : '' }}>
                            </div>
                            <div class="text-center">
                                <span class="fw-bold d-block" style="color: #000000; font-size: 9pt;">Rusak</span>
                                <input type="radio" name="kondisiAlat" value="rusak" style="transform: scale(1.5); margin: 10px 0;" required {{ old('kondisiAlat', $calibration->kondisiAlat) == 'rusak' ? 'checked' : '' }}>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mt-4">
                            <span class="fw-bold me-3" style="color: #000000; font-size: 9pt;">Keterangan :</span>
                            <div style="flex: 1; border-bottom: 2px solid #000;">
                                <input type="text" name="keterangan" class="kalibrasi-input" placeholder="Masukkan Keterangan" style="border: none; font-size: 10pt;" value="{{ old('keterangan', $calibration->keterangan) }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="kalibrasi-section-header" style="color: #000000; font-size: 10pt;">Kondisi Kalibrasi</div>
                        <table class="table table-bordered" style="font-size: 10pt;">
                            <tr>
                                <td class="table-secondary fw-bold" style="width: 30%; color: #000000; font-size: 10pt;"></td>
                                <td class="table-secondary fw-bold text-center" style="color: #000000; font-size: 10pt;">Awal</td>
                                <td class="table-secondary fw-bold text-center" style="color: #000000; font-size: 10pt;">Tengah</td>
                                <td class="table-secondary fw-bold text-center" style="color: #000000; font-size: 10pt;">Akhir</td>
                            </tr>
                            <tr>
                                <td class="bg-light fw-bold" style="color: #000000; font-size: 10pt;">Suhu (&deg;C)</td>
                                <td><input type="text" name="RT_condition1" class="kondisi-input" placeholder="0.0" style="font-size: 10pt;" value="{{ old('RT_condition1', $calibration->RT_condition1) }}" required></td>
                                <td><input type="text" name="RT_condition2" class="kondisi-input" placeholder="0.0" style="font-size: 10pt;" value="{{ old('RT_condition2', $calibration->RT_condition2) }}" required></td>
                                <td><input type="text" name="RT_condition3" class="kondisi-input" placeholder="0.0" style="font-size: 10pt;" value="{{ old('RT_condition3', $calibration->RT_condition3) }}" required></td>
                            </tr>
                            <tr>
                                <td class="bg-light fw-bold" style="color: #000000; font-size: 10pt;">RH (%)</td>
                                <td><input type="text" name="RH_condition1" class="kondisi-input" placeholder="0.0" style="font-size: 10pt;" value="{{ old('RH_condition1', $calibration->RH_condition1) }}" required></td>
                                <td><input type="text" name="RH_condition2" class="kondisi-input" placeholder="0.0" style="font-size: 10pt;" value="{{ old('RH_condition2', $calibration->RH_condition2) }}" required></td>
                                <td><input type="text" name="RH_condition3" class="kondisi-input" placeholder="0.0" style="font-size: 10pt;" value="{{ old('RH_condition3', $calibration->RH_condition3) }}" required></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- ==================== PILIHAN PARAMETER ==================== -->
                @php
                    $details = $calibration->detailInsulations ?? collect();
                    $groupedDetails = [];
                    $prechecked = [];
                    foreach ($details as $detail) {
                        $param = $detail->parameter_type;
                        if (!isset($groupedDetails[$param])) {
                            $groupedDetails[$param] = [];
                        }
                        $groupedDetails[$param][] = $detail;
                        if (!in_array($param, $prechecked)) {
                            $prechecked[] = $param;
                        }
                    }
                    
                    $acVoltChecked = in_array('ac_voltage', $prechecked) ? 'checked' : '';
                    $dcVoltChecked = in_array('dc_voltage', $prechecked) ? 'checked' : '';
                    $acCurrChecked = in_array('ac_current', $prechecked) ? 'checked' : '';
                    $dcCurrChecked = in_array('dc_current', $prechecked) ? 'checked' : '';
                    $resChecked = in_array('resistance', $prechecked) ? 'checked' : '';
                @endphp
                <div class="row mb-4 p-3 bg-light border rounded" style="color: #000;">
                    <h6 class="fw-bold"><i class="fas fa-tasks me-2"></i>Pilih Parameter Clamp Meter yang Dikalibrasi:</h6>
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

                <!-- 1. AC Voltage Table -->
                <div id="section_ac_voltage" class="parameter-section mb-4" style="{{ $acVoltChecked ? 'display: block;' : 'display: none;' }}">
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
                            @php
                                $acVoltageDetails = isset($groupedDetails['ac_voltage']) ? $groupedDetails['ac_voltage'] : [];
                                $acVoltageIndex = 0;
                            @endphp
                            @for($i = 0; $i < 9; $i++)
                            @php
                                $unit = ($i == 0) ? 'mV' : 'V';
                                $rowDetails = [];
                                for ($k = 1; $k <= 4; $k++) {
                                    $rowDetails[$k] = isset($acVoltageDetails[$acVoltageIndex]) ? $acVoltageDetails[$acVoltageIndex] : null;
                                    if ($rowDetails[$k]) {
                                        $acVoltageIndex++;
                                    }
                                }
                                $firstDetail = $rowDetails[1] ?? null;
                            @endphp
                            <tr>
                                <td rowspan="4" class="insulation-data-cell" style="vertical-align:middle; text-align:center; background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][rentang]" class="table-input-dotted" placeholder="Rentang" style="width:40pt; text-align:center;" value="{{ $firstDetail ? $firstDetail->rentang : '' }}"> 
                                    <span style="font-size:8pt;">{{ $unit }}</span>
                                    <input type="hidden" name="insulation_data[ac_voltage][{{ $i }}][satuan]" value="{{ $unit }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][titik_ukur_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[1] ? $rowDetails[1]->titik_ukur : '' }}"> 
                                    <span style="font-size:8pt;">{{ $unit }}</span>
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][frequency_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[1] ? $rowDetails[1]->frequency : '' }}"> 
                                    <span style="font-size:8pt;">Hz</span>
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_1_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[1] ? $rowDetails[1]->readAlat_1 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_1_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[1] ? $rowDetails[1]->readAlat_2 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_1_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[1] ? $rowDetails[1]->readAlat_3 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_1_4]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[1] ? $rowDetails[1]->readAlat_4 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_1_5]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[1] ? $rowDetails[1]->readAlat_5 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][resolusi_alat_1_1]" class="table-input-dotted" placeholder="Resolusi" style="width:40pt; text-align:center;" value="{{ $rowDetails[1] ? $rowDetails[1]->resolusi_alat : '' }}">
                                </td>
                            </tr>
                            <tr>
                                <td class="insulation-data-cell" style="width:60pt;">
                                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][titik_ukur_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[2] ? $rowDetails[2]->titik_ukur : '' }}"> 
                                    <span style="font-size:8pt;">{{ $unit }}</span>
                                </td>
                                <td class="insulation-data-cell" style="width:60pt;">
                                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][frequency_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[2] ? $rowDetails[2]->frequency : '' }}"> 
                                    <span style="font-size:8pt;">Hz</span>
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_2_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[2] ? $rowDetails[2]->readAlat_1 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_2_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[2] ? $rowDetails[2]->readAlat_2 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_2_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[2] ? $rowDetails[2]->readAlat_3 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_2_4]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[2] ? $rowDetails[2]->readAlat_4 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_2_5]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[2] ? $rowDetails[2]->readAlat_5 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][resolusi_alat_2_1]" class="table-input-dotted" placeholder="Resolusi" style="width:40pt; text-align:center;" value="{{ $rowDetails[2] ? $rowDetails[2]->resolusi_alat : '' }}">
                                </td>
                            </tr>
                            <tr>
                                <td class="insulation-data-cell" style="width:60pt;">
                                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][titik_ukur_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[3] ? $rowDetails[3]->titik_ukur : '' }}"> 
                                    <span style="font-size:8pt;">{{ $unit }}</span>
                                </td>
                                <td class="insulation-data-cell" style="width:60pt;">
                                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][frequency_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[3] ? $rowDetails[3]->frequency : '' }}"> 
                                    <span style="font-size:8pt;">Hz</span>
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_3_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[3] ? $rowDetails[3]->readAlat_1 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_3_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[3] ? $rowDetails[3]->readAlat_2 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_3_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[3] ? $rowDetails[3]->readAlat_3 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_3_4]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[3] ? $rowDetails[3]->readAlat_4 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_3_5]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[3] ? $rowDetails[3]->readAlat_5 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][resolusi_alat_3_1]" class="table-input-dotted" placeholder="Resolusi" style="width:40pt; text-align:center;" value="{{ $rowDetails[3] ? $rowDetails[3]->resolusi_alat : '' }}">
                                </td>
                            </tr>
                            <tr>
                                <td class="insulation-data-cell" style="width:60pt;">
                                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][titik_ukur_4]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[4] ? $rowDetails[4]->titik_ukur : '' }}"> 
                                    <span style="font-size:8pt;">{{ $unit }}</span>
                                </td>
                                <td class="insulation-data-cell" style="width:60pt;">
                                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][frequency_4]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[4] ? $rowDetails[4]->frequency : '' }}"> 
                                    <span style="font-size:8pt;">Hz</span>
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_4_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[4] ? $rowDetails[4]->readAlat_1 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_4_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[4] ? $rowDetails[4]->readAlat_2 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_4_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[4] ? $rowDetails[4]->readAlat_3 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_4_4]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[4] ? $rowDetails[4]->readAlat_4 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_4_5]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[4] ? $rowDetails[4]->readAlat_5 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][resolusi_alat_4_1]" class="table-input-dotted" placeholder="Resolusi" style="width:40pt; text-align:center;" value="{{ $rowDetails[4] ? $rowDetails[4]->resolusi_alat : '' }}">
                                </td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>

                <!-- 2. DC Voltage Table -->
                <div id="section_dc_voltage" class="parameter-section mb-4" style="{{ $dcVoltChecked ? 'display: block;' : 'display: none;' }}">
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
                            @php
                                $dcVoltageDetails = isset($groupedDetails['dc_voltage']) ? $groupedDetails['dc_voltage'] : [];
                                $dcVoltageIndex = 0;
                            @endphp
                            @for($i = 0; $i < 9; $i++)
                            @php
                                $unit = ($i == 0) ? 'mV' : 'V';
                                $rowDetails = [];
                                for ($k = 1; $k <= 4; $k++) {
                                    $rowDetails[$k] = isset($dcVoltageDetails[$dcVoltageIndex]) ? $dcVoltageDetails[$dcVoltageIndex] : null;
                                    if ($rowDetails[$k]) {
                                        $dcVoltageIndex++;
                                    }
                                }
                                $firstDetail = $rowDetails[1] ?? null;
                            @endphp
                            <tr>
                                <td rowspan="4" class="insulation-data-cell" style="vertical-align:middle; text-align:center; background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][rentang]" class="table-input-dotted" placeholder="Rentang" style="width:40pt; text-align:center;" value="{{ $firstDetail ? $firstDetail->rentang : '' }}"> 
                                    <span style="font-size:8pt;">{{ $unit }}</span>
                                    <input type="hidden" name="insulation_data[dc_voltage][{{ $i }}][satuan]" value="{{ $unit }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][titik_ukur_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[1] ? $rowDetails[1]->titik_ukur : '' }}"> 
                                    <span style="font-size:8pt;">{{ $unit }}</span>
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_1_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[1] ? $rowDetails[1]->readAlat_1 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_1_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[1] ? $rowDetails[1]->readAlat_2 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_1_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[1] ? $rowDetails[1]->readAlat_3 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_1_4]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[1] ? $rowDetails[1]->readAlat_4 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_1_5]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[1] ? $rowDetails[1]->readAlat_5 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][resolusi_alat_1_1]" class="table-input-dotted" placeholder="Resolusi" style="width:40pt; text-align:center;" value="{{ $rowDetails[1] ? $rowDetails[1]->resolusi_alat : '' }}">
                                </td>
                            </tr>
                            <tr>
                                <td class="insulation-data-cell" style="width:60pt;">
                                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][titik_ukur_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[2] ? $rowDetails[2]->titik_ukur : '' }}"> 
                                    <span style="font-size:8pt;">{{ $unit }}</span>
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_2_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[2] ? $rowDetails[2]->readAlat_1 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_2_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[2] ? $rowDetails[2]->readAlat_2 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_2_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[2] ? $rowDetails[2]->readAlat_3 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_2_4]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[2] ? $rowDetails[2]->readAlat_4 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_2_5]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[2] ? $rowDetails[2]->readAlat_5 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][resolusi_alat_2_1]" class="table-input-dotted" placeholder="Resolusi" style="width:40pt; text-align:center;" value="{{ $rowDetails[2] ? $rowDetails[2]->resolusi_alat : '' }}">
                                </td>
                            </tr>
                            <tr>
                                <td class="insulation-data-cell" style="width:60pt;">
                                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][titik_ukur_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[3] ? $rowDetails[3]->titik_ukur : '' }}"> 
                                    <span style="font-size:8pt;">{{ $unit }}</span>
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_3_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[3] ? $rowDetails[3]->readAlat_1 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_3_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[3] ? $rowDetails[3]->readAlat_2 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_3_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[3] ? $rowDetails[3]->readAlat_3 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_3_4]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[3] ? $rowDetails[3]->readAlat_4 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_3_5]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[3] ? $rowDetails[3]->readAlat_5 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][resolusi_alat_3_1]" class="table-input-dotted" placeholder="Resolusi" style="width:40pt; text-align:center;" value="{{ $rowDetails[3] ? $rowDetails[3]->resolusi_alat : '' }}">
                                </td>
                            </tr>
                            <tr>
                                <td class="insulation-data-cell" style="width:60pt;">
                                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][titik_ukur_4]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[4] ? $rowDetails[4]->titik_ukur : '' }}"> 
                                    <span style="font-size:8pt;">{{ $unit }}</span>
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_4_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[4] ? $rowDetails[4]->readAlat_1 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_4_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[4] ? $rowDetails[4]->readAlat_2 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_4_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[4] ? $rowDetails[4]->readAlat_3 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_4_4]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[4] ? $rowDetails[4]->readAlat_4 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_4_5]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[4] ? $rowDetails[4]->readAlat_5 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][resolusi_alat_4_1]" class="table-input-dotted" placeholder="Resolusi" style="width:40pt; text-align:center;" value="{{ $rowDetails[4] ? $rowDetails[4]->resolusi_alat : '' }}">
                                </td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>

                <!-- 3. AC Current Table -->
                <div id="section_ac_current" class="parameter-section mb-4" style="{{ $acCurrChecked ? 'display: block;' : 'display: none;' }}">
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
                            @php
                                $acCurrentDetails = isset($groupedDetails['ac_current']) ? $groupedDetails['ac_current'] : [];
                                $acCurrentIndex = 0;
                            @endphp
                            @for($i = 0; $i < 18; $i++)
                            @php
                                $isAmpere = ($i % 2 == 0);
                                $unit = $isAmpere ? 'A' : 'Hz';
                                $rowspan = $isAmpere ? 2 : 1;
                                
                                $rowDetails = [];
                                for ($k = 1; $k <= $rowspan; $k++) {
                                    $rowDetails[$k] = isset($acCurrentDetails[$acCurrentIndex]) ? $acCurrentDetails[$acCurrentIndex] : null;
                                    if ($rowDetails[$k]) {
                                        $acCurrentIndex++;
                                    }
                                }
                                $firstDetail = $rowDetails[1] ?? null;
                            @endphp
                            <tr>
                                <td rowspan="{{ $rowspan }}" class="insulation-data-cell" style="vertical-align:middle; text-align:center; background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[ac_current][{{ $i }}][rentang]" class="table-input-dotted" placeholder="Rentang" style="width:40pt; text-align:center;" value="{{ $firstDetail ? $firstDetail->rentang : '' }}"> 
                                    <span style="font-size:8pt;">{{ $unit }}</span>
                                    <input type="hidden" name="insulation_data[ac_current][{{ $i }}][satuan]" value="{{ $unit }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[ac_current][{{ $i }}][titik_ukur_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[1] ? $rowDetails[1]->titik_ukur : '' }}"> 
                                    <span style="font-size:8pt;">A</span>
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[ac_current][{{ $i }}][coil_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[1] ? $rowDetails[1]->coil : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[ac_current][{{ $i }}][readAlat_1_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[1] ? $rowDetails[1]->readAlat_1 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[ac_current][{{ $i }}][readAlat_1_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[1] ? $rowDetails[1]->readAlat_2 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[ac_current][{{ $i }}][readAlat_1_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[1] ? $rowDetails[1]->readAlat_3 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[ac_current][{{ $i }}][readAlat_1_4]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[1] ? $rowDetails[1]->readAlat_4 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[ac_current][{{ $i }}][readAlat_1_5]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[1] ? $rowDetails[1]->readAlat_5 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[ac_current][{{ $i }}][resolusi_alat_1_1]" class="table-input-dotted" placeholder="Resolusi" style="width:40pt; text-align:center;" value="{{ $rowDetails[1] ? $rowDetails[1]->resolusi_alat : '' }}">
                                </td>
                            </tr>
                            @if($isAmpere)
                            <tr>
                                <td class="insulation-data-cell" style="width:60pt;">
                                    <input type="text" name="insulation_data[ac_current][{{ $i }}][titik_ukur_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[2] ? $rowDetails[2]->titik_ukur : '' }}"> 
                                    <span style="font-size:8pt;">A</span>
                                </td>
                                <td class="insulation-data-cell" style="width:60pt;">
                                    <input type="text" name="insulation_data[ac_current][{{ $i }}][coil_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[2] ? $rowDetails[2]->coil : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[ac_current][{{ $i }}][readAlat_2_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[2] ? $rowDetails[2]->readAlat_1 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[ac_current][{{ $i }}][readAlat_2_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[2] ? $rowDetails[2]->readAlat_2 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[ac_current][{{ $i }}][readAlat_2_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[2] ? $rowDetails[2]->readAlat_3 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[ac_current][{{ $i }}][readAlat_2_4]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[2] ? $rowDetails[2]->readAlat_4 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[ac_current][{{ $i }}][readAlat_2_5]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[2] ? $rowDetails[2]->readAlat_5 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[ac_current][{{ $i }}][resolusi_alat_2_1]" class="table-input-dotted" placeholder="Resolusi" style="width:40pt; text-align:center;" value="{{ $rowDetails[2] ? $rowDetails[2]->resolusi_alat : '' }}">
                                </td>
                            </tr>
                            @endif
                            @endfor
                        </tbody>
                    </table>
                </div>

                <!-- 4. DC Current Table -->
                <div id="section_dc_current" class="parameter-section mb-4" style="{{ $dcCurrChecked ? 'display: block;' : 'display: none;' }}">
                    <table class="parameter-table table table-bordered" style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
                        <thead>
                            <tr class="insulation-header-row">
                                <td colspan="10" class="insulation-header-cell">DATA KALIBRASI</td>
                            </tr>
                            <tr class="insulation-spacer-row">
                                <td colspan="10" style="background-color: #d9d9d9; border: 1px solid #000; font-size: 1pt;">&nbsp;</td>
                            </tr>
                            <tr class="insulation-header-row">
                                <td colspan="10" class="insulation-header-cell-italic">DC Current</td>
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
                            @php
                                $dcCurrentDetails = isset($groupedDetails['dc_current']) ? $groupedDetails['dc_current'] : [];
                                $dcCurrentIndex = 0;
                            @endphp
                            @for($i = 0; $i < 9; $i++)
                            @php
                                $unit = 'A';
                                $rowDetails = [];
                                for ($k = 1; $k <= 3; $k++) {
                                    $rowDetails[$k] = isset($dcCurrentDetails[$dcCurrentIndex]) ? $dcCurrentDetails[$dcCurrentIndex] : null;
                                    if ($rowDetails[$k]) {
                                        $dcCurrentIndex++;
                                    }
                                }
                                $firstDetail = $rowDetails[1] ?? null;
                            @endphp
                            <tr>
                                <td rowspan="3" class="insulation-data-cell" style="vertical-align:middle; text-align:center; background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_current][{{ $i }}][rentang]" class="table-input-dotted" placeholder="Rentang" style="width:40pt; text-align:center;" value="{{ $firstDetail ? $firstDetail->rentang : '' }}"> 
                                    <span style="font-size:8pt;">{{ $unit }}</span>
                                    <input type="hidden" name="insulation_data[dc_current][{{ $i }}][satuan]" value="{{ $unit }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_current][{{ $i }}][titik_ukur_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[1] ? $rowDetails[1]->titik_ukur : '' }}"> 
                                    <span style="font-size:8pt;">A</span>
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_current][{{ $i }}][coil_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[1] ? $rowDetails[1]->coil : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_1_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[1] ? $rowDetails[1]->readAlat_1 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_1_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[1] ? $rowDetails[1]->readAlat_2 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_1_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[1] ? $rowDetails[1]->readAlat_3 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_1_4]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[1] ? $rowDetails[1]->readAlat_4 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_1_5]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[1] ? $rowDetails[1]->readAlat_5 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_current][{{ $i }}][resolusi_alat_1_1]" class="table-input-dotted" placeholder="Resolusi" style="width:40pt; text-align:center;" value="{{ $rowDetails[1] ? $rowDetails[1]->resolusi_alat : '' }}">
                                </td>
                            </tr>
                            <tr>
                                <td class="insulation-data-cell" style="width:60pt;">
                                    <input type="text" name="insulation_data[dc_current][{{ $i }}][titik_ukur_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[2] ? $rowDetails[2]->titik_ukur : '' }}"> 
                                    <span style="font-size:8pt;">A</span>
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_current][{{ $i }}][coil_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[2] ? $rowDetails[2]->coil : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_2_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[2] ? $rowDetails[2]->readAlat_1 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_2_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[2] ? $rowDetails[2]->readAlat_2 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_2_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[2] ? $rowDetails[2]->readAlat_3 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_2_4]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[2] ? $rowDetails[2]->readAlat_4 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_2_5]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[2] ? $rowDetails[2]->readAlat_5 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_current][{{ $i }}][resolusi_alat_2_1]" class="table-input-dotted" placeholder="Resolusi" style="width:40pt; text-align:center;" value="{{ $rowDetails[2] ? $rowDetails[2]->resolusi_alat : '' }}">
                                </td>
                            </tr>
                            <tr>
                                <td class="insulation-data-cell" style="width:60pt;">
                                    <input type="text" name="insulation_data[dc_current][{{ $i }}][titik_ukur_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[3] ? $rowDetails[3]->titik_ukur : '' }}"> 
                                    <span style="font-size:8pt;">A</span>
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_current][{{ $i }}][coil_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[3] ? $rowDetails[3]->coil : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_3_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[3] ? $rowDetails[3]->readAlat_1 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_3_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[3] ? $rowDetails[3]->readAlat_2 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_3_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[3] ? $rowDetails[3]->readAlat_3 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_3_4]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[3] ? $rowDetails[3]->readAlat_4 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_3_5]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[3] ? $rowDetails[3]->readAlat_5 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[dc_current][{{ $i }}][resolusi_alat_3_1]" class="table-input-dotted" placeholder="Resolusi" style="width:40pt; text-align:center;" value="{{ $rowDetails[3] ? $rowDetails[3]->resolusi_alat : '' }}">
                                </td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>

                <!-- 5. Resistance Table -->
                <div id="section_resistance" class="parameter-section mb-4" style="{{ $resChecked ? 'display: block;' : 'display: none;' }}">
                    <table class="parameter-table table table-bordered" style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
                        <thead>
                            <tr class="insulation-header-row">
                                <td colspan="10" class="insulation-header-cell">DATA KALIBRASI</td>
                            </tr>
                            <tr class="insulation-spacer-row">
                                <td colspan="10" style="background-color: #d9d9d9; border: 1px solid #000; font-size: 1pt;">&nbsp;</td>
                            </tr>
                            <tr class="insulation-header-row">
                                <td colspan="10" class="insulation-header-cell-italic">Resistance</td>
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
                            @php
                                $resistanceDetails = isset($groupedDetails['resistance']) ? $groupedDetails['resistance'] : [];
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
                                $rowDetails = [];
                                for ($k = 1; $k <= 3; $k++) {
                                    $rowDetails[$k] = isset($resistanceDetails[$resistanceIndex]) ? $resistanceDetails[$resistanceIndex] : null;
                                    if ($rowDetails[$k]) {
                                        $resistanceIndex++;
                                    }
                                }
                                $firstDetail = $rowDetails[1] ?? null;
                            @endphp
                            <tr>
                                <td rowspan="3" class="insulation-data-cell" style="vertical-align:middle; text-align:center; background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[resistance][{{ $i }}][rentang]" class="table-input-dotted" placeholder="Rentang" style="width:40pt; text-align:center;" value="{{ $firstDetail ? $firstDetail->rentang : '' }}"> 
                                    <span style="font-size:8pt;">{{ $unit }}</span>
                                    <input type="hidden" name="insulation_data[resistance][{{ $i }}][satuan]" value="{{ $unit }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[resistance][{{ $i }}][titik_ukur_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[1] ? $rowDetails[1]->titik_ukur : '' }}"> 
                                    <span style="font-size:8pt;">{{ $unit }}</span>
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_1_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[1] ? $rowDetails[1]->readAlat_1 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_1_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[1] ? $rowDetails[1]->readAlat_2 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_1_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[1] ? $rowDetails[1]->readAlat_3 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_1_4]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[1] ? $rowDetails[1]->readAlat_4 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_1_5]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[1] ? $rowDetails[1]->readAlat_5 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[resistance][{{ $i }}][resolusi_alat_1_1]" class="table-input-dotted" placeholder="Resolusi" style="width:40pt; text-align:center;" value="{{ $rowDetails[1] ? $rowDetails[1]->resolusi_alat : '' }}">
                                </td>
                            </tr>
                            <tr>
                                <td class="insulation-data-cell" style="width:60pt;">
                                    <input type="text" name="insulation_data[resistance][{{ $i }}][titik_ukur_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[2] ? $rowDetails[2]->titik_ukur : '' }}"> 
                                    <span style="font-size:8pt;">{{ $unit }}</span>
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_2_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[2] ? $rowDetails[2]->readAlat_1 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_2_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[2] ? $rowDetails[2]->readAlat_2 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_2_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[2] ? $rowDetails[2]->readAlat_3 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_2_4]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[2] ? $rowDetails[2]->readAlat_4 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_2_5]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[2] ? $rowDetails[2]->readAlat_5 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[resistance][{{ $i }}][resolusi_alat_2_1]" class="table-input-dotted" placeholder="Resolusi" style="width:40pt; text-align:center;" value="{{ $rowDetails[2] ? $rowDetails[2]->resolusi_alat : '' }}">
                                </td>
                            </tr>
                            <tr>
                                <td class="insulation-data-cell" style="width:60pt;">
                                    <input type="text" name="insulation_data[resistance][{{ $i }}][titik_ukur_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[3] ? $rowDetails[3]->titik_ukur : '' }}"> 
                                    <span style="font-size:8pt;">{{ $unit }}</span>
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_3_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[3] ? $rowDetails[3]->readAlat_1 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_3_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[3] ? $rowDetails[3]->readAlat_2 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_3_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[3] ? $rowDetails[3]->readAlat_3 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_3_4]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[3] ? $rowDetails[3]->readAlat_4 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_3_5]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;" value="{{ $rowDetails[3] ? $rowDetails[3]->readAlat_5 : '' }}">
                                </td>
                                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                                    <input type="text" name="insulation_data[resistance][{{ $i }}][resolusi_alat_3_1]" class="table-input-dotted" placeholder="Resolusi" style="width:40pt; text-align:center;" value="{{ $rowDetails[3] ? $rowDetails[3]->resolusi_alat : '' }}">
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
                            <input type="hidden" name="alat_standar_text" value="{{ $standard }}">
                            Multifunction Calibration System "Transmille 1000A"
                        </td>
                        <td colspan="3" class="label" style="font-size: 10pt;">Di Kalibrasi oleh</td>
                        <td colspan="3" class="label" style="font-size: 10pt;">Di Periksa oleh</td>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                        <td rowspan="2" class="label" style="font-size: 10pt;">Metode Kalibrasi</td>
                        <td colspan="5" style="text-align: left; padding-left: 10px; font-size: 10pt;">
                            <input type="hidden" name="metode_2" value="{{ $calibrationMethod }}">
                            PAS-IK1102-43 B (Clamp Meter)
                        </td>
                        <td colspan="3" style="text-align: left; padding-left: 20px; font-size: 10pt;">
                            TTD :
                        </td>
                        <td colspan="3" style="text-align: left; padding-left: 20px; font-size: 10pt;">
                            TTD :
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" style="text-align: left; padding-left: 10px; font-size: 10pt;">
                        </td>
                        <td colspan="3" style="text-align: left; padding-left: 20px; font-size: 10pt;">
                            Nama: <input type="text" name="calibratedBy" value="{{ old('calibratedBy', $calibration->calibratedBy ?? 'System') }}" style="font-size: 10pt; border: none; text-align: left; width: 80%;" readonly>
                        </td>
                        <td colspan="3" style="text-align: left; padding-left: 20px; font-size: 10pt;">
                            Nama: <input type="text" name="verifiedBy" value="{{ old('verifiedBy', $calibration->verifiedBy ?? '') }}" style="font-size: 10pt; border: none; text-align: left; width: 80%;" readonly>
                        </td>
                    </tr>
                </table>

                <!-- Submit Button Section -->
                <div class="row mt-5">
                    <div class="col-12 text-center">
                        <button type="button" id="btnSimpanSemua" class="btn btn-primary btn-lg" onclick="submitSemuaForm()" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
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

        // Sync Nama Alat Manual
        function updateFormType(selectedAlat) {
            const manualInputContainer = document.getElementById('manualInputContainer');
            const manualInput = document.getElementById('nama_alat_manual');
            const finalInput = document.getElementById('nama_alat_final');
            
            if (!manualInputContainer || !manualInput) return;
            
            if (selectedAlat === 'MANUAL_INPUT') {
                manualInputContainer.style.display = 'block';
                manualInput.required = true;
                if (finalInput) finalInput.value = '';
            } else {
                manualInputContainer.style.display = 'none';
                manualInput.required = false;
                manualInput.value = '';
                if (finalInput && selectedAlat) finalInput.value = selectedAlat;
            }
        }

        function syncNamaAlat() {
            const manualInput = document.getElementById('nama_alat_manual');
            const finalInput = document.getElementById('nama_alat_final');
            if (manualInput && finalInput) {
                finalInput.value = manualInput.value;
            }
        }

        // JS Submit Handler
        async function submitSemuaForm() {
            let form = document.getElementById('kalibrasiForm');
            if (!form) {
                form = document.getElementById('calibrationForm');
            }
            if (!form) {
                alert('Form tidak ditemukan!');
                return;
            }
            
            // VALIDASI HEADER FORM (Dari Nama Alat sampai Kondisi Kalibrasi)
            let isHeaderValid = true;
            const headerFields = form.querySelectorAll('.kalibrasi-input, .kondisi-input, select.kalibrasi-input');
            
            // Validate required fields
            headerFields.forEach(field => {
                // Skip manual input if it's hidden
                if (field.id === 'nama_alat_manual') {
                    const container = document.getElementById('manualInputContainer');
                    if (container && container.style.display === 'none') {
                        return;
                    }
                }
                
                if (field.hasAttribute('required') && (!field.value || field.value.trim() === '')) {
                    isHeaderValid = false;
                }
            });
            
            // Validate radio buttons
            const tempatKalibrasiRadios = form.querySelectorAll('input[name="tempatKalibrasi"]');
            let tempatKalibrasiChecked = false;
            tempatKalibrasiRadios.forEach(radio => {
                if (radio.checked) tempatKalibrasiChecked = true;
            });
            if (tempatKalibrasiRadios.length > 0 && !tempatKalibrasiChecked) {
                tempatKalibrasiRadios.forEach(radio => {
                    radio.parentNode.style.outline = '1px solid #dc3545';
                    radio.parentNode.style.padding = '2px 5px';
                    radio.parentNode.style.borderRadius = '3px';
                });
                isHeaderValid = false;
            } else {
                tempatKalibrasiRadios.forEach(radio => {
                    radio.parentNode.style.outline = '';
                    radio.parentNode.style.padding = '';
                    radio.parentNode.style.borderRadius = '';
                });
            }
            
            const fungsiKomponenRadios = form.querySelectorAll('input[name="kondisiAlat"]');
            let fungsiKomponenChecked = false;
            fungsiKomponenRadios.forEach(radio => {
                if (radio.checked) fungsiKomponenChecked = true;
            });
            if (fungsiKomponenRadios.length > 0 && !fungsiKomponenChecked) {
                fungsiKomponenRadios.forEach(radio => {
                    radio.parentNode.style.outline = '1px solid #dc3545';
                    radio.parentNode.style.padding = '2px 5px';
                    radio.parentNode.style.borderRadius = '3px';
                });
                isHeaderValid = false;
            } else {
                fungsiKomponenRadios.forEach(radio => {
                    radio.parentNode.style.outline = '';
                    radio.parentNode.style.padding = '';
                    radio.parentNode.style.borderRadius = '';
                });
            }
            
            if (!isHeaderValid) {
                alert('Harap lengkapi semua data wajib yang ditandai merah!');
                
                if (tempatKalibrasiRadios.length > 0) {
                    tempatKalibrasiRadios.forEach(radio => {
                        radio.addEventListener('change', function() {
                            tempatKalibrasiRadios.forEach(r => {
                                r.parentNode.style.outline = '';
                                r.parentNode.style.padding = '';
                                r.parentNode.style.borderRadius = '';
                            });
                        });
                    });
                }
                
                if (fungsiKomponenRadios.length > 0) {
                    fungsiKomponenRadios.forEach(radio => {
                        radio.addEventListener('change', function() {
                            fungsiKomponenRadios.forEach(r => {
                                r.parentNode.style.outline = '';
                                r.parentNode.style.padding = '';
                                r.parentNode.style.borderRadius = '';
                            });
                        });
                    });
                }
                
                return;
            }
            
            // Hapus required validation browser
            form.querySelectorAll('[required]').forEach(el => {
                el.removeAttribute('required');
            });
            form.setAttribute('novalidate', 'novalidate');
            form.noValidate = true;
            
            const btn = document.getElementById('btnSimpanSemua');
            const originalText = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan Data...';
            
            try {
                const formData = new FormData(form);
                
                // Tambahkan field wajib
                formData.append('form_type', 'insulation');
                formData.append('rentang_ukur_min', '0');
                formData.append('rentang_ukur_max', '0');
                formData.append('_method', 'PUT'); // UPDATE method Laravel
                formData.append('is_ajax', 'true');
                
                // Alat standar
                const alatStandarValue = form.querySelector('input[name="alat_standar_text"]')?.value || 'Multifunction Calibration System Transmille 1000A';
                formData.delete('alat_standar_text');
                formData.append('alat_standar[]', alatStandarValue);
                
                // Active parameters
                const activeParams = [];
                formData.delete('active_parameters[]');
                document.querySelectorAll('.param-checkbox:checked').forEach(checkbox => {
                    const value = checkbox.value;
                    if (value) {
                        activeParams.push(value);
                        formData.append('active_parameters[]', value);
                    }
                });
                
                // Metode
                const metodeInput = form.querySelector('input[name="metode_2"]');
                if (metodeInput && metodeInput.value) {
                    formData.append('metode', metodeInput.value);
                }
                
                // Nama alat
                const selectNamaAlat = form.querySelector('select[name="nama_alat"]');
                let formName = 'clampmeter';
                if (selectNamaAlat && selectNamaAlat.value && selectNamaAlat.value !== 'MANUAL_INPUT') {
                    formName = selectNamaAlat.value;
                } else {
                    const manualNamaAlat = form.querySelector('input[name="nama_alat_manual"]');
                    if (manualNamaAlat && manualNamaAlat.value) {
                        formName = manualNamaAlat.value;
                    }
                }
                formData.append('nama_alat', formName);
                formData.append('namaAlat', formName);
                
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
                if (csrfToken) {
                    formData.append('_token', csrfToken);
                }
                
                const response = await fetch('/calibrations/{{ $calibration->id }}', {
                    method: 'POST', // Sent as POST with _method=PUT
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });
                
                const responseData = await response.json();
                
                if (response.ok) {
                    window.location.href = responseData.redirect || '/calibrations';
                } else {
                    alert('Gagal menyimpan: ' + (responseData.message || responseData.error || 'Terjadi kesalahan'));
                    btn.disabled = false;
                    btn.innerHTML = originalText;
                }
            } catch (err) {
                console.error(err);
                alert('Gagal mengirim form: ' + err.message);
                btn.disabled = false;
                btn.innerHTML = originalText;
            }
        }
    </script>
</body>
</html>
