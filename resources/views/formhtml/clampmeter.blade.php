<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Kalibrasi Kelistrikan - Clamp Meter</title>
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

        /* Dotted Calibration Table Styles */
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
        <form method="POST" action="/calibrations" id="kalibrasiForm">
            @csrf
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
                            <p style="margin: 0; font-size: 10pt; color: #000000; font-weight: bold; text-align: left;">PAS-SK /</p>
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
                                <!-- Hidden input untuk form type -->
                                 
                                
                                <select name="nama_alat" id="nama_alat_select" class="kalibrasi-input" onchange="updateFormType(this.value)" required style="background-color: #f5f5f5; color: #333; border: 1px solid #ced4da; padding: 6px 10px; border-radius: 4px; width: 100%;">
                                    <option value="">-- Pilih Alat  --</option>
                                    <option value="Clampmeter">Clampmeter</option>
                                    <option value="MANUAL_INPUT">-- Input Manual Nama Alat --</option>
                                </select>
                                
                                <!-- Input Manual - HIDANG AWALNYA -->
                                <div id="manualInputContainer" style="display: none; margin-top: 10px;">
                                    <input type="text" name="nama_alat_manual" id="nama_alat_manual"
                                           placeholder="Ketik nama alat"
                                           style="background-color: #f5f5f5; color: #333; border: 1px solid #ced4da; padding: 6px 10px; border-radius: 4px; width: 100%;"
                                           oninput="syncNamaAlat()">
                                </div>
                                
                                <!-- Hidden input untuk menyimpan nama alat final -->
                                <input type="hidden" name="nama_alat_final" id="nama_alat_final" value="">
                                
                                <!-- Hidden input untuk display (opsional) -->
                                <input type="hidden" name="nama_alat_display" id="nama_alat_display" value="">
                            </td>
                        </tr>
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000; text-align: left; font-size: 10pt;">Merek</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" name="merek" class="kalibrasi-input me-3" placeholder="Masukkan merek alat" style="width: 45%; text-align: left; font-size: 10pt;" required>
                                <span class="me-1" style="color:#000000; font-size: 10pt;">Kode Alat:</span>
                                <input type="text" name="kode_alat" class="kalibrasi-input" placeholder="Masukkan kode" style="width: 30%; text-align: left; font-size: 10pt;" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000; text-align: left; font-size: 10pt;">Type / No. Seri</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" name="type_alat" class="kalibrasi-input me-3" placeholder="Masukkan Type Alat" style="width: 45%; text-align: left; font-size: 10pt;" oninput="formatTypeAlat(this)" required>
                                <span class="me-3" style="color: #000000; font-size: 10pt;">/</span>
                                <input type="text" name="no_seri" class="kalibrasi-input" placeholder="Masukkan No. Seri" style="width: 45%; text-align: left; font-size: 10pt;" oninput="formatNoSeri(this)" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000; text-align: left; font-size: 10pt;">Kapasitas / Resolusi</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" name="kapasitas" class="kalibrasi-input me-3" placeholder="Kapasitas" style="width: 45%; text-align: left; font-size: 10pt;" required>
                                <span class="me-3" style="color: #000000; font-size: 10pt;">/</span>
                                <input type="text" name="resolusi" class="kalibrasi-input" placeholder="Resolusi" style="width: 45%; text-align: left; font-size: 10pt;" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000; text-align: left; font-size: 10pt;">Nama Pemilik</p>
                        </td>
                        <td colspan="3">
                            <input type="text" name="nama_pemilik" class="kalibrasi-input" placeholder="Masukkan nama pemilik/Instansi" style="width: 60%; text-align: left; font-size: 10pt;" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000; text-align: left; font-size: 10pt;">Tanggal Alat Masuk</p>
                        </td>
                        <td colspan="3">
                            <input type="date" name="tanggal_alat_masuk" class="kalibrasi-input" value="{{ date('Y-m-d') }}" style="font-size: 10pt;" required>
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Tanggal Kalibrasi</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <!-- Tanggal Kalibrasi -->
                                <input type="date" 
                                    name="tanggal_kalibrasi" 
                                    class="kalibrasi-input me-3" 
                                    style="width: 45%;" 
                                    required
                                    value="{{ date('Y-m-d') }}">
                                
                                <span class="me-3" style="color: #000000;">Jenis Pembacaan:</span>
                                
                                <!-- Dropdown Jenis Pembacaan -->
                                <select name="jenis_pembacaan" class="kalibrasi-input" style="width: 45%;" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="manual">Manual</option>
                                    <option value="digital" selected>Digital</option>
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
                                    <input class="form-check-input" type="radio" name="tempat_kalibrasi" value="lab.PT PAS" id="lab" required>
                                    <label class="form-check-label" for="lab" style="color: #000000; font-size: 10pt;">Lab. PT.PAS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tempat_kalibrasi" value="insitu" id="insitu" required>
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
                            <input type="text" name="lokasi_pt" class="kalibrasi-input" placeholder="Masukkan Lokasi PT" required>
                        </td>
                    </tr>

                      <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Kode TH</p>
                        </td>
                        <td colspan="3">
                            <input type="text" name="kode_th" class="kalibrasi-input" placeholder="Masukkan Kode TH" required>
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
                                <input type="radio" name="fungsi_komponen" value="ok" style="transform: scale(1.5); margin: 10px 0;" required>
                            </div>
                            <div class="text-center">
                                <span class="fw-bold d-block" style="color: #000000; font-size: 9pt;">Rusak</span>
                                <input type="radio" name="fungsi_komponen" value="rusak" style="transform: scale(1.5); margin: 10px 0;" required>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mt-4">
                            <span class="fw-bold me-3" style="color: #000000; font-size: 9pt;">Keterangan :</span>
                            <div style="flex: 1; border-bottom: 2px solid #000;">
                                <input type="text" name="keterangan_fungsi_komponen" class="kalibrasi-input" placeholder="Masukkan Keterangan" style="border: none; font-size: 10pt;">
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
                                <td><input type="text" name="suhu_awal" class="kondisi-input"  placeholder="0.0" style="font-size: 10pt;" required></td>
                                <td><input type="text" name="suhu_tengah" class="kondisi-input"  placeholder="0.0" style="font-size: 10pt;" required></td>
                                <td><input type="text" name="suhu_akhir" class="kondisi-input"  placeholder="0.0" style="font-size: 10pt;" required></td>
                            </tr>
                            <tr>
                                <td class="bg-light fw-bold" style="color: #000000; font-size: 10pt;">RH (%)</td>
                                <td><input type="text" name="rh_awal" class="kondisi-input"  placeholder="0.0" style="font-size: 10pt;" required></td>
                                <td><input type="text" name="rh_tengah" class="kondisi-input"  placeholder="0.0" style="font-size: 10pt;" required></td>
                                <td><input type="text" name="rh_akhir" class="kondisi-input"  placeholder="0.0" style="font-size: 10pt;" required></td>
                            </tr>
                        </table>
                    </div>
                </div>

              <!-- ==================== PILIHAN PARAMETER ==================== -->
<div class="row mb-4 p-3 bg-light border rounded" style="color: #000;">
    <h6 class="fw-bold"><i class="fas fa-tasks me-2"></i>Pilih Parameter Clamp Meter yang Dikalibrasi:</h6>
    <div class="col-md-12 d-flex flex-wrap gap-4 mt-2">
        @php
            $acVoltChecked = in_array('ac_voltage', $prechecked ?? []) ? 'checked' : '';
            $dcVoltChecked = in_array('dc_voltage', $prechecked ?? []) ? 'checked' : '';
            $acCurrChecked = in_array('ac_current', $prechecked ?? []) ? 'checked' : '';
            $dcCurrChecked = in_array('dc_current', $prechecked ?? []) ? 'checked' : '';
            $resChecked = in_array('resistance', $prechecked ?? []) ? 'checked' : '';
        @endphp
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
<div id="section_ac_voltage" class="parameter-section mb-4" style="display: none;">
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
                // Baris pertama (indeks 0) pakai mV, sisanya V
                $unit = ($i == 0) ? 'mV' : 'V';
            @endphp
            <tr>
                <td rowspan="4" class="insulation-data-cell" style="vertical-align:middle; text-align:center; background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][rentang]" class="table-input-dotted" placeholder="Rentang" style="width:40pt; text-align:center;"> 
                    <span style="font-size:8pt;">{{ $unit }}</span>
                    <input type="hidden" name="insulation_data[ac_voltage][{{ $i }}][satuan]" value="{{ $unit }}">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][titik_ukur_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;"> 
                    <span style="font-size:8pt;">{{ $unit }}</span>
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][frequency_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;"> 
                    <span style="font-size:8pt;">Hz</span>
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_1_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_1_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_1_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_1_4]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_1_5]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][resolusi_alat_1_1]" class="table-input-dotted" placeholder="Resolusi" style="width:40pt; text-align:center;">
                </td>
            </tr>
            <tr>
                <td class="insulation-data-cell" style="width:60pt;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][titik_ukur_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;"> 
                    <span style="font-size:8pt;">{{ $unit }}</span>
                </td>
                <td class="insulation-data-cell" style="width:60pt;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][frequency_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;"> 
                    <span style="font-size:8pt;">Hz</span>
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_2_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_2_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_2_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_2_4]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_2_5]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][resolusi_alat_2_1]" class="table-input-dotted" placeholder="Resolusi" style="width:40pt; text-align:center;">
                </td>
            </tr>
            <tr>
                <td class="insulation-data-cell" style="width:60pt;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][titik_ukur_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;"> 
                    <span style="font-size:8pt;">{{ $unit }}</span>
                </td>
                <td class="insulation-data-cell" style="width:60pt;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][frequency_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;"> 
                    <span style="font-size:8pt;">Hz</span>
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_3_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_3_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_3_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_3_4]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_3_5]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][resolusi_alat_3_1]" class="table-input-dotted" placeholder="Resolusi" style="width:40pt; text-align:center;">
                </td>
            </tr>
            <tr>
                <td class="insulation-data-cell" style="width:60pt;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][titik_ukur_4]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;"> 
                    <span style="font-size:8pt;">{{ $unit }}</span>
                </td>
                <td class="insulation-data-cell" style="width:60pt;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][frequency_4]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;"> 
                    <span style="font-size:8pt;">Hz</span>
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_4_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_4_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_4_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_4_4]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][readAlat_4_5]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[ac_voltage][{{ $i }}][resolusi_alat_4_1]" class="table-input-dotted" placeholder="Resolusi" style="width:40pt; text-align:center;">
                </td>
            </tr>
            @endfor
        </tbody>
    </table>
</div>

<!-- 2. DC Voltage Table -->
<div id="section_dc_voltage" class="parameter-section mb-4" style="display: none;">
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
                // Baris pertama (indeks 0) pakai mV, sisanya V
                $unit = ($i == 0) ? 'mV' : 'V';
            @endphp
            <tr>
                <td rowspan="4" class="insulation-data-cell" style="vertical-align:middle; text-align:center; background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][rentang]" class="table-input-dotted" placeholder="Rentang" style="width:40pt; text-align:center;"> 
                    <span style="font-size:8pt;">{{ $unit }}</span>
                    <input type="hidden" name="insulation_data[dc_voltage][{{ $i }}][satuan]" value="{{ $unit }}">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][titik_ukur_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;"> 
                    <span style="font-size:8pt;">{{ $unit }}</span>
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_1_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_1_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_1_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_1_4]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_1_5]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][resolusi_alat_1_1]" class="table-input-dotted" placeholder="Resolusi" style="width:40pt; text-align:center;">
                </td>
            </tr>
            <tr>
                <td class="insulation-data-cell" style="width:60pt;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][titik_ukur_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;"> 
                    <span style="font-size:8pt;">{{ $unit }}</span>
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_2_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_2_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_2_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_2_4]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_2_5]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][resolusi_alat_2_1]" class="table-input-dotted" placeholder="Resolusi" style="width:40pt; text-align:center;">
                </td>
            </tr>
            <tr>
                <td class="insulation-data-cell" style="width:60pt;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][titik_ukur_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;"> 
                    <span style="font-size:8pt;">{{ $unit }}</span>
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_3_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_3_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_3_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_3_4]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_3_5]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][resolusi_alat_3_1]" class="table-input-dotted" placeholder="Resolusi" style="width:40pt; text-align:center;">
                </td>
            </tr>
            <tr>
                <td class="insulation-data-cell" style="width:60pt;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][titik_ukur_4]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;"> 
                    <span style="font-size:8pt;">{{ $unit }}</span>
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_4_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_4_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_4_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_4_4]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][readAlat_4_5]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_voltage][{{ $i }}][resolusi_alat_4_1]" class="table-input-dotted" placeholder="Resolusi" style="width:40pt; text-align:center;">
                </td>
            </tr>
            @endfor
        </tbody>
    </table>
</div>

<!-- 3. AC Current Table -->
<div id="section_ac_current" class="parameter-section mb-4" style="display: none;">
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
            @php $rowIndex = 0; @endphp
            
            <!-- 9 inputan A dan 9 inputan Hz selang-seling -->
            @for($i = 0; $i < 18; $i++)
                @php
                    // Genap = A, Ganjil = Hz
                    $isAmpere = ($i % 2 == 0);
                    $unit = $isAmpere ? 'A' : 'Hz';
                    $rowspan = $isAmpere ? 2 : 1;
                @endphp
                
                <tr>
                    <td rowspan="{{ $rowspan }}" class="insulation-data-cell" style="vertical-align:middle; text-align:center; background-color: #f9f9f9; width:60pt;">
                        <input type="text" name="insulation_data[ac_current][{{ $rowIndex }}][rentang]" class="table-input-dotted" placeholder="Rentang" style="width:40pt; text-align:center;"> 
                        <span style="font-size:8pt;">{{ $unit }}</span>
                        <input type="hidden" name="insulation_data[ac_current][{{ $rowIndex }}][satuan]" value="{{ $unit }}">
                    </td>
                    <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                        <input type="text" name="insulation_data[ac_current][{{ $rowIndex }}][titik_ukur_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;"> 
                        <span style="font-size:8pt;">A</span>
                    </td>
                    <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                        <input type="text" name="insulation_data[ac_current][{{ $rowIndex }}][coil_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                    </td>
                    <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                        <input type="text" name="insulation_data[ac_current][{{ $rowIndex }}][readAlat_1_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                    </td>
                    <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                        <input type="text" name="insulation_data[ac_current][{{ $rowIndex }}][readAlat_1_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                    </td>
                    <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                        <input type="text" name="insulation_data[ac_current][{{ $rowIndex }}][readAlat_1_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                    </td>
                    <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                        <input type="text" name="insulation_data[ac_current][{{ $rowIndex }}][readAlat_1_4]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                    </td>
                    <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                        <input type="text" name="insulation_data[ac_current][{{ $rowIndex }}][readAlat_1_5]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                    </td>
                    <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                        <input type="text" name="insulation_data[ac_current][{{ $rowIndex }}][resolusi_alat_1_1]" class="table-input-dotted" placeholder="Resolusi" style="width:40pt; text-align:center;">
                    </td>
                </tr>
                
                @if($isAmpere)
                <tr>
                    <td class="insulation-data-cell" style="width:60pt;">
                        <input type="text" name="insulation_data[ac_current][{{ $rowIndex }}][titik_ukur_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;"> 
                        <span style="font-size:8pt;">A</span>
                    </td>
                    <td class="insulation-data-cell" style="width:60pt;">
                        <input type="text" name="insulation_data[ac_current][{{ $rowIndex }}][coil_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                    </td>
                    <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                        <input type="text" name="insulation_data[ac_current][{{ $rowIndex }}][readAlat_2_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                    </td>
                    <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                        <input type="text" name="insulation_data[ac_current][{{ $rowIndex }}][readAlat_2_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                    </td>
                    <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                        <input type="text" name="insulation_data[ac_current][{{ $rowIndex }}][readAlat_2_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                    </td>
                    <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                        <input type="text" name="insulation_data[ac_current][{{ $rowIndex }}][readAlat_2_4]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                    </td>
                    <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                        <input type="text" name="insulation_data[ac_current][{{ $rowIndex }}][readAlat_2_5]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                    </td>
                    <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                        <input type="text" name="insulation_data[ac_current][{{ $rowIndex }}][resolusi_alat_2_1]" class="table-input-dotted" placeholder="Resolusi" style="width:40pt; text-align:center;">
                    </td>
                </tr>
                @endif
                
                @php $rowIndex++; @endphp
            @endfor
        </tbody>
    </table>
</div>

<!-- 4. DC Current Table -->
<div id="section_dc_current" class="parameter-section mb-4" style="display: none;">
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
            @for($i = 0; $i < 9; $i++)
            @php
                // Semua pakai satuan A
                $unit = 'A';
            @endphp
            <tr>
                <td rowspan="3" class="insulation-data-cell" style="vertical-align:middle; text-align:center; background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_current][{{ $i }}][rentang]" class="table-input-dotted" placeholder="Rentang" style="width:40pt; text-align:center;"> 
                    <span style="font-size:8pt;">{{ $unit }}</span>
                    <input type="hidden" name="insulation_data[dc_current][{{ $i }}][satuan]" value="{{ $unit }}">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_current][{{ $i }}][titik_ukur_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;"> 
                    <span style="font-size:8pt;">A</span>
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_current][{{ $i }}][coil_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_1_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_1_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_1_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_1_4]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_1_5]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_current][{{ $i }}][resolusi_alat_1_1]" class="table-input-dotted" placeholder="Resolusi" style="width:40pt; text-align:center;">
                </td>
            </tr>
            <tr>
                <td class="insulation-data-cell" style="width:60pt;">
                    <input type="text" name="insulation_data[dc_current][{{ $i }}][titik_ukur_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;"> 
                    <span style="font-size:8pt;">A</span>
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_current][{{ $i }}][coil_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_2_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_2_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_2_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_2_4]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_2_5]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_current][{{ $i }}][resolusi_alat_2_1]" class="table-input-dotted" placeholder="Resolusi" style="width:40pt; text-align:center;">
                </td>
            </tr>
            <tr>
                <td class="insulation-data-cell" style="width:60pt;">
                    <input type="text" name="insulation_data[dc_current][{{ $i }}][titik_ukur_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;"> 
                    <span style="font-size:8pt;">A</span>
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_current][{{ $i }}][coil_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_3_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_3_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_3_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_3_4]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_current][{{ $i }}][readAlat_3_5]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[dc_current][{{ $i }}][resolusi_alat_3_1]" class="table-input-dotted" placeholder="Resolusi" style="width:40pt; text-align:center;">
                </td>
            </tr>
            @endfor
        </tbody>
    </table>
</div>

<!-- 5. Resistance Table -->
<div id="section_resistance" class="parameter-section mb-4" style="display: none;">
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
            @for($i = 0; $i < 9; $i++)
            @php
                if ($i < 3) {
                    $unit = 'Ω';
                } elseif ($i < 6) {
                    $unit = 'kΩ';
                } else {
                    $unit = 'MΩ';
                }
            @endphp
            <tr>
                <td rowspan="3" class="insulation-data-cell" style="vertical-align:middle; text-align:center; background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[resistance][{{ $i }}][rentang]" class="table-input-dotted" placeholder="Rentang" style="width:40pt; text-align:center;"> 
                    <span style="font-size:8pt;">{{ $unit }}</span>
                    <input type="hidden" name="insulation_data[resistance][{{ $i }}][satuan]" value="{{ $unit }}">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[resistance][{{ $i }}][titik_ukur_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;"> 
                    <span style="font-size:8pt;">{{ $unit }}</span>
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_1_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_1_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_1_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_1_4]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_1_5]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[resistance][{{ $i }}][resolusi_alat_1_1]" class="table-input-dotted" placeholder="Resolusi" style="width:40pt; text-align:center;">
                </td>
            </tr>
            <tr>
                <td class="insulation-data-cell" style="width:60pt;">
                    <input type="text" name="insulation_data[resistance][{{ $i }}][titik_ukur_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;"> 
                    <span style="font-size:8pt;">{{ $unit }}</span>
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_2_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_2_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_2_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_2_4]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_2_5]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[resistance][{{ $i }}][resolusi_alat_2_1]" class="table-input-dotted" placeholder="Resolusi" style="width:40pt; text-align:center;">
                </td>
            </tr>
            <tr>
                <td class="insulation-data-cell" style="width:60pt;">
                    <input type="text" name="insulation_data[resistance][{{ $i }}][titik_ukur_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;"> 
                    <span style="font-size:8pt;">{{ $unit }}</span>
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_3_1]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_3_2]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_3_3]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_3_4]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[resistance][{{ $i }}][readAlat_3_5]" class="table-input-dotted" placeholder="......" style="width:40pt; text-align:center;">
                </td>
                <td class="insulation-data-cell" style="background-color: #f9f9f9; width:60pt;">
                    <input type="text" name="insulation_data[resistance][{{ $i }}][resolusi_alat_3_1]" class="table-input-dotted" placeholder="Resolusi" style="width:40pt; text-align:center;">
                </td>
            </tr>
            @endfor
        </tbody>
    </table>
</div>
                <!-- ==================== FOOTER ==================== -->
                <table class="footer-table">
                    <tr>
                        <td colspan="12" class="title" style="font-size: 11pt;">
                            Isilah lembar data kalibrasi dengan lengkap dan jelas!
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="2" class="label" style="font-size: 10pt; width: 12%;">Alat Standar</td>
                        <td colspan="5" rowspan="2" style="font-size: 10pt; text-align: left; padding-left: 10px;">
                             <input type="hidden" name="alat_standar_text" value="Multifunction Calibration System Transmille 1000A ">
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
                            <input type="hidden" name="metode_2" value="PAS-IK1102-43 B (Clamp Meter)">
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
                            Nama: <input type="text" name="calibrated_by" value="{{ auth()->user()->nama ?? 'System' }}" style="font-size: 10pt; border: none; text-align: left; width: 80%;" readonly>
                        </td>
                        <td colspan="3" style="text-align: left; padding-left: 20px; font-size: 10pt;">
                            Nama: <input type="text" name="verified_by" style="font-size: 10pt; border: none; text-align: left; width: 80%;" placeholder="" readonly>
                        </td>
                    </tr>
                </table>

               
                  <!-- Submit Button Section -->
                  <div class="row mt-5">
                    <div class="col-12 text-center">
                        <button type="button" id="btnSimpanSemua" class="btn btn-primary btn-lg" onclick="submitSemuaForm()" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
                            <i class="fas fa-save me-2"></i>Simpan Data Kalibrasi
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    

    <script>
// ==========================================
// STORAGE PER TAB - GLOBAL
// ==========================================
if (typeof window.tempFormDataStore === 'undefined') {
    window.tempFormDataStore = {};
}
if (typeof window.isRestoring === 'undefined') {
    window.isRestoring = false;
}
if (typeof window.tabSubmitStatus === 'undefined') {
    window.tabSubmitStatus = {};
}

var tempFormDataStore = window.tempFormDataStore;
var isRestoring = window.isRestoring;
var tabSubmitStatus = window.tabSubmitStatus;

var currentActiveTabId = '1';

// ==========================================
// FUNGSI GET TAB AKTIF
// ==========================================
function getActiveTabId() {
    const activePane = document.querySelector('.tab-pane.active');
    if (activePane && activePane.id && activePane.id.startsWith('lk-pane-')) {
        const tabId = activePane.id.replace('lk-pane-', '');
        currentActiveTabId = tabId;
        return tabId;
    }
    
    const activeTabButton = document.querySelector('.nav-link.active');
    if (activeTabButton && activeTabButton.id && activeTabButton.id.startsWith('lk-tab-')) {
        const tabId = activeTabButton.id.replace('lk-tab-', '');
        currentActiveTabId = tabId;
        return tabId;
    }
    
    const containers = document.querySelectorAll('.lk-form-container');
    for (let i = 0; i < containers.length; i++) {
        const style = window.getComputedStyle(containers[i]);
        if (style.display !== 'none') {
            const tabId = containers[i].getAttribute('data-lk-id');
            if (tabId) return tabId;
        }
    }
    
    return currentActiveTabId;
}

function updateActiveTab(tabId) {
    currentActiveTabId = tabId;
    console.log(`🔄 Global active tab updated to: ${tabId}`);
}

// ==========================================
// FUNGSI UNTUK MENONAKTIFKAN REQUIRED PADA FORM YANG TIDAK VISIBLE
// ==========================================
function disableRequiredOnHiddenForms() {
    console.log('🔧 disableRequiredOnHiddenForms called');
    
    const allForms = document.querySelectorAll('form[id^="kalibrasiForm"]');
    
    allForms.forEach((form, index) => {
        const formIndex = index + 1;
        const container = form.closest('.lk-form-container');
        const isVisible = container && window.getComputedStyle(container).display !== 'none';
        
        console.log(`📌 Form ${formIndex}: isVisible=${isVisible}`);
        
        const requiredInputs = form.querySelectorAll('[required]');
        
        if (!isVisible) {
            requiredInputs.forEach(input => {
                console.log(`🔧 Disabling required for: ${input.name}`);
                input.removeAttribute('required');
                input.setAttribute('data-required-temp', 'true');
            });
        } else {
            requiredInputs.forEach(input => {
                if (input.hasAttribute('data-required-temp')) {
                    console.log(`🔧 Re-enabling required for: ${input.name}`);
                    input.setAttribute('required', 'required');
                    input.removeAttribute('data-required-temp');
                }
            });
        }
    });
}

function restoreRequiredOnAllForms() {
    const allForms = document.querySelectorAll('form[id^="kalibrasiForm"]');
    allForms.forEach(form => {
        form.querySelectorAll('[data-required-temp]').forEach(input => {
            input.setAttribute('required', 'required');
            input.removeAttribute('data-required-temp');
        });
    });
}

// ==========================================
// UPDATE FORM TYPE
// ==========================================
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

function formatNumberInput(input) {
    if (!input) return;
    let value = input.value;
    if (value === '' || value === null) return;
    value = value.toString().replace(/,/g, '');
    if (!isNaN(value) && value !== '') {
        let num = parseFloat(value);
        if (!isNaN(num)) input.value = num.toString();
    }
}

function escapeHtml(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// ==========================================
// HANDLE SAVE SUCCESS
// ==========================================
window.handleSaveSuccess = function(tabId, data) {
    console.log('🎉 handleSaveSuccess called for tab:', tabId, data);
    
    const container = document.querySelector(`.lk-form-container[data-lk-id="${tabId}"]`);
    if (!container) {
        console.error(`Container for tab ${tabId} not found!`);
        return;
    }

    const tabButton = document.getElementById(`lk-tab-${tabId}`);
    if (tabButton) {
        tabButton.classList.add('tab-saved');
        const badge = tabButton.querySelector('.badge');
        if (badge) {
            badge.className = 'badge badge-success ml-1';
            badge.innerHTML = '<i class="fas fa-check mr-1"></i>Tersimpan';
        }
    }

    const formName = container.getAttribute('data-form-name') || 'clampmeter';
    const calibrationId = data.calibration_id || data.id || '-';
    const printLabelUrl = data.print_label_url || `/calibrations/${calibrationId}/print-label`;
    
    tabSubmitStatus[tabId] = {
        success: true,
        calibrationId: calibrationId,
        printLabelUrl: printLabelUrl,
        formName: formName,
        timestamp: Date.now()
    };
    
    container.innerHTML = `
       <div class="save-success-overlay text-center p-5 fade-in" style="background: white; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.08);">
       <div class="mb-4">
                    <i class="fas fa-check-circle text-success fa-5x"></i>
                </div>
                <h3 class="text-success mb-2">Simpan Berhasil!</h3>
                <p class="mb-3" style="color: black;">Data kalibrasi untuk <strong>${escapeHtml(formName)}</strong> telah berhasil disimpan ke database.</p>
                
                <div class="d-inline-block mb-4 p-3" style="border-radius: 12px; text-align: left; background: white; border: 1px solid #ddd;">
                    <i class="fas fa-info-circle mr-2" style="color: #0d6efd;"></i>
                    <strong style="color: black;">ID Kalibrasi:</strong> <code style="background: #f5f5f5; color: black; font-weight: bold;">${escapeHtml(calibrationId)}</code>
                    <br>
                    <small style="color: black;">Status: <span class="badge bg-success">Draft</span></small>
                </div>
        
        <div class="d-flex justify-content-center gap-3 flex-wrap mb-4">
            <button type="button" class="btn btn-primary btn-lg px-4 py-2" 
                    style="border-radius: 10px; transition: all 0.2s ease;"
                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 5px 15px rgba(0,0,0,0.2)';"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';"
                    onmousedown="this.style.transform='translateY(1px)';"
                    onmouseup="this.style.transform='translateY(-2px)';"
                    onclick="window.open('${printLabelUrl}', '_blank')">
                <i class="fas fa-print me-2"></i> Cetak Label
            </button>
            
            <button type="button" class="btn btn-success btn-lg px-4 py-2" 
                    style="border-radius: 10px; transition: all 0.2s ease;"
                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 5px 15px rgba(0,0,0,0.2)';"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';"
                    onmousedown="this.style.transform='translateY(1px)';"
                    onmouseup="this.style.transform='translateY(-2px)';"
                    onclick="resetTabForNewScan(${tabId})">
                <i class="fas fa-plus-circle me-2"></i> Input Lagi
            </button>
            
            <button type="button" class="btn btn-danger btn-lg px-4 py-2" 
                    style="border-radius: 10px; transition: all 0.2s ease;"
                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 5px 15px rgba(0,0,0,0.2)';"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';"
                    onmousedown="this.style.transform='translateY(1px)';"
                    onmouseup="this.style.transform='translateY(-2px)';"
                    onclick="removeTab(${tabId})">
                <i class="fas fa-times me-2"></i> Tutup Tab
            </button>
        </div>
        
        <div class="mt-3 text-muted small">
            <i class="fas fa-info-circle me-1"></i> Data tersimpan sebagai Draft. 
            Klik <strong>Cetak Label</strong> untuk mencetak, atau <strong>Input Lagi</strong> untuk melanjutkan kalibrasi berikutnya.
        </div>
    </div>
    `;

    const finishContainer = document.getElementById('finish-action-container');
    if (finishContainer) finishContainer.classList.remove('d-none');

    if (typeof Swal !== 'undefined') {
        Swal.fire({
            icon: 'success',
            title: '✓ Data Tersimpan!',
            html: `<strong>${escapeHtml(formName)}</strong><br>ID: ${calibrationId}`,
            timer: 2000,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    }
};

window.resetTabForNewScan = function(tabId) {
    if (confirm('Data yang belum disimpan akan hilang. Lanjutkan?')) {
        delete tabSubmitStatus[tabId];
        location.reload();
    }
};

window.removeTab = function(tabId) {
    if (tabId == 1) {
        alert('Tab utama tidak bisa ditutup!');
        return;
    }
    if (confirm(`Apakah Anda yakin ingin menutup Form ${tabId}?`)) {
        delete tabSubmitStatus[tabId];
        delete tempFormDataStore[tabId];
        const container = document.querySelector(`.lk-form-container[data-lk-id="${tabId}"]`);
        if (container) container.remove();
        const tabBtn = document.getElementById(`lk-tab-${tabId}`);
        if (tabBtn) tabBtn.remove();
        const firstContainer = document.querySelector('.lk-form-container[data-lk-id="1"]');
        if (firstContainer) firstContainer.style.display = 'block';
        updateActiveTab('1');
    }
};

// ==========================================
// SUBMIT SEMUA FORM - CLAMP METER
// ==========================================
async function submitSemuaForm() {
    // Dapatkan tab ID yang aktif
    const activeTabId = getActiveTabId();
    console.log('📌 Submitting from active tab:', activeTabId);
    
    // Cari container yang aktif
    const activeContainer = document.querySelector(`.lk-form-container[data-lk-id="${activeTabId}"]`);
    if (!activeContainer) {
        alert('Container form tidak ditemukan!');
        return;
    }
    
    // CARI FORM DENGAN ID TEPAT
    let form = activeContainer.querySelector('#kalibrasiForm');
    if (!form) {
        form = activeContainer.querySelector('form[id^="kalibrasiForm"]');
    }
    if (!form) {
        form = activeContainer.querySelector('form');
    }
    
    if (!form) {
        alert('Form tidak ditemukan!');
        return;
    }
    
    console.log(`✅ Form ditemukan di tab ${activeTabId}`);
    
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
    const tempatKalibrasiRadios = form.querySelectorAll('input[name="tempat_kalibrasi"]');
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
    
    const fungsiKomponenRadios = form.querySelectorAll('input[name="fungsi_komponen"]');
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
    
    // NONAKTIFKAN VALIDASI BROWSER
    form.setAttribute('novalidate', 'novalidate');
    form.noValidate = true;
    
    // VALIDASI ALAT STANDAR
    let alatStandarValue = '';
    const alatStandarHidden = form.querySelector('input[name="alat_standar_text"]');
    const alatStandarText = form.querySelector('.alat-standar-text');
    
    if (alatStandarHidden && alatStandarHidden.value) {
        alatStandarValue = alatStandarHidden.value;
    } else if (alatStandarText && alatStandarText.innerText) {
        alatStandarValue = alatStandarText.innerText.trim();
    }
    
    if (!alatStandarValue || alatStandarValue === '') {
        alert('Alat standar belum diisi!');
        return;
    }
    
    console.log(`✅ Alat standar: ${alatStandarValue}`);
    
    const btn = document.getElementById('btnSimpanSemua');
    if (!btn) {
        alert('Tombol simpan tidak ditemukan!');
        return;
    }
    
    const originalText = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan Data...';
    
    try {
        const formData = new FormData(form);
        
        // Tambahkan field wajib - form_type tetap 'insulation'
        formData.append('form_type', 'insulation');
        formData.append('rentang_ukur_min', '0');
        formData.append('rentang_ukur_max', '0');
        formData.append('is_ajax', 'true');
        
        // KIRIM ALAT STANDAR SEBAGAI ARRAY
        formData.delete('alat_standar_text');
        formData.append('alat_standar[]', alatStandarValue);
        
        // Ambil semua parameter yang aktif (checkbox yang dicentang)
        const activeParams = [];
        formData.delete('active_parameters[]');
        document.querySelectorAll('.param-checkbox:checked').forEach(checkbox => {
            const value = checkbox.value;
            if (value) {
                activeParams.push(value);
                formData.append('active_parameters[]', value);
            }
        });
        
        console.log('📤 Active parameters:', activeParams);
        
        // Ambil metode kalibrasi - untuk clamp meter gunakan metode_2
        const metodeInput = form.querySelector('input[name="metode_2"]');
        if (metodeInput && metodeInput.value) {
            formData.append('metode', metodeInput.value);
        }
        
        // Ambil nama alat
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
        
        // CSRF Token
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
        if (csrfToken) {
            formData.append('_token', csrfToken);
        }
        
        console.log('📤 Mengirim data dari tab:', activeTabId);
        console.log('📤 Alat standar yang dikirim:', [alatStandarValue]);
        console.log('📤 Parameter aktif:', activeParams);
        console.log('📤 Metode:', formData.get('metode'));
        
        const response = await fetch('/calibrations', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        });
        
        const contentType = response.headers.get('content-type');
        
        let result;
        if (contentType && contentType.includes('application/json')) {
            result = await response.json();
        } else {
            const text = await response.text();
            console.error('Non-JSON response:', text.substring(0, 500));
            throw new Error('Server mengembalikan response yang tidak valid');
        }
        
        if (!response.ok) {
            throw new Error(result.error || `Gagal menyimpan data: ${response.status}`);
        }
        
        // Update data-form-name di container
        activeContainer.setAttribute('data-form-name', formName);
        
        console.log('📌 Saving success for tab:', activeTabId);
        
        // Panggil handleSaveSuccess
        if (typeof window.handleSaveSuccess === 'function') {
            window.handleSaveSuccess(activeTabId, result);
        } else {
            alert('Data berhasil disimpan!');
        }
        
    } catch (err) {
        console.error('Submit error:', err);
        alert('Error: ' + err.message);
    } finally {
        btn.disabled = false;
        btn.innerHTML = originalText;
    }
}

// Define global toggle function if not exists
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
// FUNGSI UNTUK MENGUMPULKAN DATA PER PARAMETER
// ==========================================
function getParameterData(sectionId) {
    const section = document.getElementById(sectionId);
    if (!section) return null;
    
    const data = {};
    const inputs = section.querySelectorAll('input[type="text"]');
    
    inputs.forEach(input => {
        const name = input.getAttribute('name');
        if (name && name.startsWith('insulation_data')) {
            const match = name.match(/insulation_data\[([^\]]+)\]\[([^\]]+)\]\[([^\]]+)\]/);
            if (match) {
                const param = match[1];
                const index = match[2];
                const field = match[3];
                
                if (!data[param]) data[param] = {};
                if (!data[param][index]) data[param][index] = {};
                data[param][index][field] = input.value;
            }
        }
    });
    
    return data;
}

// ==========================================
// FUNGSI UNTUK CEK APAKAH ADA DATA DI SECTION
// ==========================================
function hasDataInSection(sectionId) {
    const section = document.getElementById(sectionId);
    if (!section) return false;
    
    const inputs = section.querySelectorAll('input[type="text"]');
    for (const input of inputs) {
        if (input.value && input.value.trim() !== '') {
            return true;
        }
    }
    return false;
}

// ==========================================
// FUNGSI UNTUK VALIDASI DATA SEBELUM SUBMIT
// ==========================================
function validateDataBeforeSubmit(activeParams) {
    let isValid = true;
    let errors = [];
    
    activeParams.forEach(param => {
        const sectionId = `section_${param}`;
        const section = document.getElementById(sectionId);
        if (section) {
            const inputs = section.querySelectorAll('input[type="text"]');
            let hasData = false;
            
            inputs.forEach(input => {
                if (input.value && input.value.trim() !== '') {
                    hasData = true;
                }
            });
            
            if (!hasData) {
                errors.push(`Tidak ada data untuk parameter ${param.replace('_', ' ').toUpperCase()}`);
            }
        }
    });
    
    if (errors.length > 0) {
        alert('Peringatan:\n' + errors.join('\n'));
        isValid = false;
    }
    
    return isValid;
}

// ==========================================
// SETUP TAB SWITCHING
// ==========================================
function setupTabSwitching() {
    $(document).on('shown.bs.tab', 'button[data-toggle="tab"]', function (e) {
        const targetId = $(e.target).attr('id');
        if (targetId && targetId.startsWith('lk-tab-')) {
            const tabId = targetId.replace('lk-tab-', '');
            console.log('🎯 Tab switched to:', tabId);
            updateActiveTab(tabId);
            
            document.querySelectorAll('.lk-form-container').forEach(container => {
                container.style.display = 'none';
            });
            
            const targetContainer = document.querySelector(`.lk-form-container[data-lk-id="${tabId}"]`);
            if (targetContainer) {
                targetContainer.style.display = 'block';
            }
        }
    });
    
    const activeButton = document.querySelector('.nav-link.active');
    if (activeButton && activeButton.id) {
        const tabId = activeButton.id.replace('lk-tab-', '');
        updateActiveTab(tabId);
    }
}


// ==========================================
// INISIALISASI
// ==========================================
(function() {
    function findMyContainer() {
        if (document.currentScript) {
            const container = document.currentScript.closest('.lk-form-container');
            if (container) return container;
        }
        if (typeof getActiveTabId === 'function') {
            const activeId = getActiveTabId();
            const container = document.querySelector(`.lk-form-container[data-lk-id="${activeId}"]`);
            if (container) return container;
        }
        if (typeof activeLkId !== 'undefined') {
            const container = document.querySelector(`.lk-form-container[data-lk-id="${activeLkId}"]`);
            if (container) return container;
        }
        const containers = document.querySelectorAll('.lk-form-container');
        if (containers.length > 0) {
            return containers[containers.length - 1];
        }
        return null;
    }

    function initClampMeter() {
        console.log('🚀 Initializing clamp meter...');
        
        setupTabSwitching();
        
        const container = findMyContainer();
        if (!container) {
            console.error('❌ Clamp meter container not found!');
            return;
        }
        
        const tabId = container.getAttribute('data-lk-id') || 'unknown';
        console.log(`📦 Found clamp meter container for Tab ID: ${tabId}`);
        
        // Find checkboxes only within this container
        const checkboxes = container.querySelectorAll('.param-checkbox');
        console.log(`🔍 Found ${checkboxes.length} checkboxes with class .param-checkbox in Tab ${tabId}`);
        
        checkboxes.forEach(checkbox => {
            const targetId = checkbox.getAttribute('data-target');
            // Look for target section only inside this container (or globally if not found)
            const targetSection = container.querySelector(`#${targetId}`) || document.getElementById(targetId);
            
            console.log(`   - Parameter [${checkbox.value}]: targetId=${targetId}, sectionFound=${!!targetSection}, checked=${checkbox.checked}`);
            
            if (targetSection) {
                // Set initial display state
                targetSection.style.display = checkbox.checked ? 'block' : 'none';
            } else {
                console.warn(`   ⚠️ Target section [#${targetId}] not found in container for Tab ${tabId}!`);
            }
        });
        
        const selectAlat = container.querySelector('#nama_alat_select') || document.getElementById('nama_alat_select');
        if (selectAlat) {
            updateFormType(selectAlat.value);
            selectAlat.addEventListener('change', function() {
                updateFormType(this.value);
            });
        }
        
        const manualInput = container.querySelector('#nama_alat_manual') || document.getElementById('nama_alat_manual');
        if (manualInput) {
            manualInput.addEventListener('input', syncNamaAlat);
        }
        
        setTimeout(() => {
            disableRequiredOnHiddenForms();
        }, 500);
        
        console.log(`✅ Clamp meter initialization complete for Tab ${tabId}!`);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initClampMeter);
    } else {
        initClampMeter();
    }
})();
</script>
</body>
</html>
