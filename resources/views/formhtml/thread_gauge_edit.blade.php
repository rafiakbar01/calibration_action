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
                        <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK64</p>
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
                        <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">THREAD GAUGE</p>
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
                        <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;">{{ $calibration->headThreadGauge->certificate_id ?? 'N/A' }}</p>
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
            <input type="text" name="namaAlat" class="kalibrasi-input" 
                   value="{{ old('namaAlat', $calibration->namaAlat) }}">
        </td>
    </tr>

                 <!-- Merek & Kode -->
    <tr>
        <td><p style="margin:0;color:#000;">Merek</p></td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="text" name="brandAlat" class="kalibrasi-input me-3"
                       value="{{ old('brandAlat', $calibration->brandAlat) }}" style="width:60%;">
                <span class="me-3">Kode Alat :</span>
                <input type="text" name="kodeAlat" class="kalibrasi-input"
                       value="{{ old('kodeAlat', $calibration->kodeAlat) }}" style="width:30%;">
            </div>
        </td>
    </tr>

    <!-- Type / No Seri -->
    <tr>
        <td><p style="margin:0;color:#000;">Type / No. Seri</p></td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="text" name="typeAlat" class="kalibrasi-input me-3"
                       value="{{ old('typeAlat', $calibration->typeAlat) }}" style="width:45%;">
                <span class="me-3">/</span>
                <input type="text" name="NoSeri" class="kalibrasi-input"
                       value="{{ old('NoSeri', $calibration->NoSeri) }}" style="width:45%;">
            </div>
        </td>
    </tr>

    <!-- Kapasitas / Resolusi -->
    <tr>
        <td><p style="margin:0;color:#000;">Kapasitas / Resolusi</p></td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="text" name="kapasitas" class="kalibrasi-input me-3"
                       value="{{ old('kapasitas', $calibration->kapasitas) }}" style="width:45%;">
                <span class="me-3">/</span>
                <input type="text" name="resolusi" class="kalibrasi-input"
                       value="{{ old('resolusi', $calibration->resolusi) }}" style="width:45%;">
            </div>
        </td>
    </tr>

    <!-- Pemilik -->
    <tr>
        <td><p style="margin:0;color:#000;">Nama Pemilik</p></td>
        <td colspan="3">
            <input type="text" name="pemilikAlat" class="kalibrasi-input"
                   value="{{ old('pemilikAlat', $calibration->pemilikAlat) }}">
        </td>
    </tr>

    <!-- Tanggal -->
       <tr>
        <td><p style="margin:0;color:#000;">Tanggal Alat Masuk</p></td>
        <td colspan="3">
            <input type="date" name="tanggalMasuk" class="kalibrasi-input"
                   value="{{ old('tanggalMasuk', \Carbon\Carbon::parse($calibration->tanggalMasuk)->format('Y-m-d')) }}">
        </td>
    </tr>


    <tr>
        <td><p style="margin:0;color:#000;">Tanggal Kalibrasi</p></td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="date" name="tanggalKalibrasi" class="kalibrasi-input me-3"
                       value="{{ old('tanggalKalibrasi', $calibration->tanggalKalibrasi) }}" style="width:45%;">
                <span class="me-3">Jenis Pembacaan:</span>
                <input type="text" name="jenisPembacaan" class="kalibrasi-input"
                       value="{{ old('jenisPembacaan', $calibration->jenisPembacaan) }}" style="width:45%;">
            </div>
        </td>
    </tr>

    <!-- Tempat -->
     <tr>
        <td><p style="margin: 0; color: #000000;">Tempat Kalibrasi</p></td>
        <td colspan="3">
            <div class="d-flex">
                <div class="form-check me-5">
                    <input class="form-check-input" type="radio" name="tempatKalibrasi" value="lab.PT PAS"
                           {{ old('tempatKalibrasi', $calibration->tempatKalibrasi) == 'lab.PT PAS' ? 'checked' : '' }}>
                    <label class="form-check-label">Lab. PT.PAS</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tempatKalibrasi" value="insitu"
                           {{ old('tempatKalibrasi', $calibration->tempatKalibrasi) == 'insitu' ? 'checked' : '' }}>
                    <label class="form-check-label">Insitu</label>
                </div>
            </div>
        </td>
    </tr>

    <!-- Lokasi -->
    <tr>
        <td><p style="margin:0;color:#000;">Lokasi PT</p></td>
        <td colspan="3">
            <input type="text" name="lokasiPT" class="kalibrasi-input"
                   value="{{ old('lokasiPT', $calibration->lokasiPT) }}">
        </td>
    </tr>
            </table>

           <!-- Fungsi Komponen Lainnya & Kondisi Kalibrasi -->
<div class="row mt-4">

    <!-- Fungsi Komponen Lainnya -->
    <div class="col-md-6 mb-4">
        <div class="kalibrasi-section-header" style="color:#000000;">
            Fungsi Komponen Lainnya
        </div>

        <!-- Radio -->
        <div class="d-flex justify-content-center align-items-center mb-4" style="gap:60px;">
            <div class="text-center">
                <span class="fw-bold d-block mb-2" style="color:#000000;font-size:14px;">Ok</span>
                <input type="radio" name="kondisiAlat" value="ok" class="form-check-input"
                    style="width:18px;height:18px;display:block;margin:0 auto;"
                    {{ $calibration->kondisiAlat == 'ok' ? 'checked' : '' }}>
            </div>

            <div class="text-center">
                <span class="fw-bold d-block mb-2" style="color:#000000;font-size:14px;">Rusak</span>
                <input type="radio" name="kondisiAlat" value="rusak" class="form-check-input"
                    style="width:18px;height:18px;display:block;margin:0 auto;"
                    {{ $calibration->kondisiAlat == 'rusak' ? 'checked' : '' }}>
            </div>
        </div>

        <!-- Keterangan -->
        <div class="d-flex align-items-center">
            <span class="fw-bold me-3" style="color:#000000;min-width:100px;">Keterangan :</span>
            <div style="flex:1;">
                <input type="text" name="keterangan" class="kalibrasi-input"
                       value="{{ $calibration->keterangan }}"
                       style="border:none;border-bottom:2px solid #000;border-radius:0;
                              padding:4px 0;background:transparent;width:100%;">
            </div>
        </div>
    </div>

    <!-- Kondisi Kalibrasi -->
    <div class="col-md-6 mb-4">
        <div class="kalibrasi-section-header" style="color:#000000;">
            Kondisi Kalibrasi
        </div>

        <table class="table table-bordered">
            <tr>
                <td class="table-secondary fw-bold" style="width:30%;color:#000000;"></td>
                <td class="table-secondary fw-bold text-center">Awal</td>
                <td class="table-secondary fw-bold text-center">Tengah</td>
                <td class="table-secondary fw-bold text-center">Akhir</td>
            </tr>

            <tr>
                <td class="bg-light fw-bold">Suhu (°C)</td>
                <td><input type="text" name="RT_condition1" class="kondisi-input"
                           value="{{ $calibration->RT_condition1 }}"></td>
                <td><input type="text" name="RT_condition2" class="kondisi-input"
                           value="{{ $calibration->RT_condition2 }}"></td>
                <td><input type="text" name="RT_condition3" class="kondisi-input"
                           value="{{ $calibration->RT_condition3 }}"></td>
            </tr>

            <tr>
                <td class="bg-light fw-bold">RH (%)</td>
                <td><input type="text" name="RH_condition1" class="kondisi-input"
                           value="{{ $calibration->RH_condition1 }}"></td>
                <td><input type="text" name="RH_condition2" class="kondisi-input"
                           value="{{ $calibration->RH_condition2 }}"></td>
                <td><input type="text" name="RH_condition3" class="kondisi-input"
                           value="{{ $calibration->RH_condition3 }}"></td>
            </tr>
        </table>
    </div>
</div>

            <!-- Data Kalibrasi Section -->
<div class="data-kalibrasi-header" style="color: #000000;">DATA KALIBRASI</div>

<!-- BARIS 1: SENSOR TABLE (EDIT DATA) -->
<tr>
    <td colspan="2" style="padding: 0 10px 15px 10px;">
        <style>
            .sensor-container {
                position: relative;
                width: 100%;
                margin-bottom: 6px;
            }
            
            .sensor-radio {
                display: none;
            }
            
            .sensor-label {
                display: block;
                width: 100%;
                padding: 8px 30px 8px 8px;
                border: 1.5px solid #666;
                border-radius: 6px;
                font-size: 13px;
                font-weight: 600;
                background: #fff;
                box-sizing: border-box;
                height: 40px;
                text-align: center;
                cursor: pointer;
                position: relative;
                transition: all 0.2s ease;
                overflow: hidden;
                white-space: nowrap;
                text-overflow: ellipsis;
            }
            
            .sensor-label:hover {
                background-color: #f8f9fa;
                border-color: #444;
            }
            
            .sensor-radio:checked + .sensor-label {
                border-color: #28a745;
                background-color: #f0fff4;
                color: #155724;
                box-shadow: 0 0 0 2px rgba(40, 167, 69, 0.1);
            }
            
            .sensor-select {
                display: none;
                width: 100%;
                padding: 6px;
                border: 1.5px solid #ddd;
                border-radius: 4px;
                margin-top: 4px;
                background: white;
                font-size: 12px;
                font-weight: 500;
                color: #333;
                box-shadow: 0 1px 4px rgba(0,0,0,0.08);
                animation: fadeIn 0.3s ease;
            }
            
            .sensor-select:focus {
                outline: none;
                border-color: #28a745;
                box-shadow: 0 0 0 2px rgba(40, 167, 69, 0.1);
            }
            
            .sensor-radio:checked ~ .sensor-select {
                display: block;
            }
            
            .sensor-table {
                width: 100%;
                border-collapse: collapse;
                border: 1px solid #dee2e6;
                font-size: 11px;
                background: #fff;
                box-shadow: 0 1px 2px rgba(0,0,0,0.04);
            }
            
            .sensor-table th {
                font-weight: 600;
                background-color: #f8f9fa;
            }
            
            .sensor-table td {
                vertical-align: top;
                background-color: white;
                padding: 8px !important;
            }
            
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(-3px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            .sensor-group {
                margin: 0;
                padding: 0;
                border: none;
            }
            
            .sensor-group-legend {
                display: none;
            }
            
            .sensor-table th {
                padding: 8px 4px !important;
            }
            
            .sensor-table thead tr:first-child th {
                font-size: 12px !important;
                padding: 10px 4px !important;
            }
        </style>

        @php
            // Parse data sensor yang tersimpan
            $savedSensorType = '';
            $savedSensorValue = '';
            
            if($calibration->detailThreadGauges && $calibration->detailThreadGauges->isNotEmpty()) {
                $detail = $calibration->detailThreadGauges->first();
                $sensorData = $detail->sensor ?? '';
                
                if($sensorData) {
                    $parts = explode(':', $sensorData);
                    if(count($parts) > 1) {
                        $savedSensorType = trim($parts[0]);
                        $savedSensorValue = trim($parts[1]);
                    }
                }
            }
        @endphp

        <fieldset class="sensor-group">
            <legend class="sensor-group-legend">Sensor Type</legend>
            
            <table class="sensor-table">
                <thead>
                    <tr>
                        <th colspan="4" style="border: 1px solid #dee2e6; padding: 10px 4px; text-align: center; font-size: 12px; font-weight: 600;">
                            Sensor yang digunakan*
                        </th>
                    </tr>
                    <tr>
                        <th style="border: 1px solid #dee2e6; padding: 8px 4px; text-align: center; width: 25%; background-color: #e9ecef; font-size: 11px;">T-Probe</th>
                        <th style="border: 1px solid #dee2e6; padding: 8px 4px; text-align: center; width: 25%; background-color: #e9ecef; font-size: 11px;">Hanging Wire</th>
                        <th style="border: 1px solid #dee2e6; padding: 8px 4px; text-align: center; width: 25%; background-color: #e9ecef; font-size: 11px;">Wire (Holder)</th>
                        <th style="border: 1px solid #dee2e6; padding: 8px 4px; text-align: center; width: 25%; background-color: #e9ecef; font-size: 11px;">Ball</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <!-- T-Probe -->
                        <td style="border: 1px solid #dee2e6;">
                            <div class="sensor-container">
                                <input type="radio" name="sensor_type" id="sensor_t_probe" class="sensor-radio" value="T-Probe" {{ $savedSensorType == 'T-Probe' ? 'checked' : '' }}>
                                <label for="sensor_t_probe" class="sensor-label" title="Pilih T-Probe">T-Probe</label>
                                
                                <select name="t_probe_value" class="sensor-select">
                                    <option value="">Pilih nilai</option>
                                    <option value="0.455" {{ ($savedSensorType == 'T-Probe' && $savedSensorValue == '0.455') ? 'selected' : '' }}>0.455</option>
                                    <option value="0.530" {{ ($savedSensorType == 'T-Probe' && $savedSensorValue == '0.530') ? 'selected' : '' }}>0.530</option>
                                    <option value="0.620" {{ ($savedSensorType == 'T-Probe' && $savedSensorValue == '0.620') ? 'selected' : '' }}>0.620</option>
                                    <option value="0.725" {{ ($savedSensorType == 'T-Probe' && $savedSensorValue == '0.725') ? 'selected' : '' }}>0.725</option>
                                    <option value="0.895" {{ ($savedSensorType == 'T-Probe' && $savedSensorValue == '0.895') ? 'selected' : '' }}>0.895</option>
                                    <option value="1.100" {{ ($savedSensorType == 'T-Probe' && $savedSensorValue == '1.100') ? 'selected' : '' }}>1.100</option>
                                    <option value="1.350" {{ ($savedSensorType == 'T-Probe' && $savedSensorValue == '1.350') ? 'selected' : '' }}>1.350</option>
                                    <option value="1.650" {{ ($savedSensorType == 'T-Probe' && $savedSensorValue == '1.650') ? 'selected' : '' }}>1.650</option>
                                    <option value="2.050" {{ ($savedSensorType == 'T-Probe' && $savedSensorValue == '2.050') ? 'selected' : '' }}>2.050</option>
                                    <option value="2.550" {{ ($savedSensorType == 'T-Probe' && $savedSensorValue == '2.550') ? 'selected' : '' }}>2.550</option>
                                    <option value="3.200" {{ ($savedSensorType == 'T-Probe' && $savedSensorValue == '3.200') ? 'selected' : '' }}>3.200</option>
                                    <option value="4.000" {{ ($savedSensorType == 'T-Probe' && $savedSensorValue == '4.000') ? 'selected' : '' }}>4.000</option>
                                </select>
                            </div>
                        </td>

                        <!-- Hanging Wire -->
                        <td style="border: 1px solid #dee2e6;">
                            <div class="sensor-container">
                                <input type="radio" name="sensor_type" id="sensor_hanging_wire" class="sensor-radio" value="Hanging Wire" {{ $savedSensorType == 'Hanging Wire' ? 'checked' : '' }}>
                                <label for="sensor_hanging_wire" class="sensor-label" title="Pilih Hanging Wire">Hanging Wire</label>
                                
                                <select name="hanging_wire_value" class="sensor-select">
                                    <option value="">Pilih nilai</option>
                                    <option value="0.170" {{ ($savedSensorType == 'Hanging Wire' && $savedSensorValue == '0.170') ? 'selected' : '' }}>0.170</option>
                                    <option value="0.195" {{ ($savedSensorType == 'Hanging Wire' && $savedSensorValue == '0.195') ? 'selected' : '' }}>0.195</option>
                                    <option value="0.220" {{ ($savedSensorType == 'Hanging Wire' && $savedSensorValue == '0.220') ? 'selected' : '' }}>0.220</option>
                                    <option value="0.250" {{ ($savedSensorType == 'Hanging Wire' && $savedSensorValue == '0.250') ? 'selected' : '' }}>0.250</option>
                                    <option value="0.290" {{ ($savedSensorType == 'Hanging Wire' && $savedSensorValue == '0.290') ? 'selected' : '' }}>0.290</option>
                                    <option value="0.335" {{ ($savedSensorType == 'Hanging Wire' && $savedSensorValue == '0.335') ? 'selected' : '' }}>0.335</option>
                                    <option value="0.390" {{ ($savedSensorType == 'Hanging Wire' && $savedSensorValue == '0.390') ? 'selected' : '' }}>0.390</option>
                                    <option value="0.455" {{ ($savedSensorType == 'Hanging Wire' && $savedSensorValue == '0.455') ? 'selected' : '' }}>0.455</option>
                                    <option value="0.530" {{ ($savedSensorType == 'Hanging Wire' && $savedSensorValue == '0.530') ? 'selected' : '' }}>0.530</option>
                                    <option value="0.620" {{ ($savedSensorType == 'Hanging Wire' && $savedSensorValue == '0.620') ? 'selected' : '' }}>0.620</option>
                                    <option value="0.725" {{ ($savedSensorType == 'Hanging Wire' && $savedSensorValue == '0.725') ? 'selected' : '' }}>0.725</option>
                                    <option value="0.895" {{ ($savedSensorType == 'Hanging Wire' && $savedSensorValue == '0.895') ? 'selected' : '' }}>0.895</option>
                                    <option value="1.100" {{ ($savedSensorType == 'Hanging Wire' && $savedSensorValue == '1.100') ? 'selected' : '' }}>1.100</option>
                                    <option value="1.350" {{ ($savedSensorType == 'Hanging Wire' && $savedSensorValue == '1.350') ? 'selected' : '' }}>1.350</option>
                                    <option value="1.650" {{ ($savedSensorType == 'Hanging Wire' && $savedSensorValue == '1.650') ? 'selected' : '' }}>1.650</option>
                                    <option value="2.050" {{ ($savedSensorType == 'Hanging Wire' && $savedSensorValue == '2.050') ? 'selected' : '' }}>2.050</option>
                                    <option value="2.550" {{ ($savedSensorType == 'Hanging Wire' && $savedSensorValue == '2.550') ? 'selected' : '' }}>2.550</option>
                                    <option value="3.200" {{ ($savedSensorType == 'Hanging Wire' && $savedSensorValue == '3.200') ? 'selected' : '' }}>3.200</option>
                                    <option value="4.000" {{ ($savedSensorType == 'Hanging Wire' && $savedSensorValue == '4.000') ? 'selected' : '' }}>4.000</option>
                                    <option value="5.050" {{ ($savedSensorType == 'Hanging Wire' && $savedSensorValue == '5.050') ? 'selected' : '' }}>5.050</option>
                                    <option value="6.350" {{ ($savedSensorType == 'Hanging Wire' && $savedSensorValue == '6.350') ? 'selected' : '' }}>6.350</option>
                                </select>
                            </div>
                        </td>

                        <!-- Wire (Holder) -->
                        <td style="border: 1px solid #dee2e6;">
                            <div class="sensor-container">
                                <input type="radio" name="sensor_type" id="sensor_wire_holder" class="sensor-radio" value="Wire (Holder)" {{ $savedSensorType == 'Wire (Holder)' ? 'checked' : '' }}>
                                <label for="sensor_wire_holder" class="sensor-label" title="Pilih Wire (Holder)">Wire (Holder)</label>
                                
                                <select name="wire_holder_value" class="sensor-select">
                                    <option value="">Pilih nilai</option>
                                    <option value="0.173" {{ ($savedSensorType == 'Wire (Holder)' && $savedSensorValue == '0.173') ? 'selected' : '' }}>0.173</option>
                                    <option value="0.202" {{ ($savedSensorType == 'Wire (Holder)' && $savedSensorValue == '0.202') ? 'selected' : '' }}>0.202</option>
                                    <option value="0.231" {{ ($savedSensorType == 'Wire (Holder)' && $savedSensorValue == '0.231') ? 'selected' : '' }}>0.231</option>
                                    <option value="0.260" {{ ($savedSensorType == 'Wire (Holder)' && $savedSensorValue == '0.260') ? 'selected' : '' }}>0.260</option>
                                    <option value="0.289" {{ ($savedSensorType == 'Wire (Holder)' && $savedSensorValue == '0.289') ? 'selected' : '' }}>0.289</option>
                                    <option value="0.346" {{ ($savedSensorType == 'Wire (Holder)' && $savedSensorValue == '0.346') ? 'selected' : '' }}>0.346</option>
                                    <option value="0.404" {{ ($savedSensorType == 'Wire (Holder)' && $savedSensorValue == '0.404') ? 'selected' : '' }}>0.404</option>
                                    <option value="0.433" {{ ($savedSensorType == 'Wire (Holder)' && $savedSensorValue == '0.433') ? 'selected' : '' }}>0.433</option>
                                    <option value="0.462" {{ ($savedSensorType == 'Wire (Holder)' && $savedSensorValue == '0.462') ? 'selected' : '' }}>0.462</option>
                                    <option value="0.577" {{ ($savedSensorType == 'Wire (Holder)' && $savedSensorValue == '0.577') ? 'selected' : '' }}>0.577</option>
                                    <option value="0.722" {{ ($savedSensorType == 'Wire (Holder)' && $savedSensorValue == '0.722') ? 'selected' : '' }}>0.722</option>
                                    <option value="0.866" {{ ($savedSensorType == 'Wire (Holder)' && $savedSensorValue == '0.866') ? 'selected' : '' }}>0.866</option>
                                    <option value="1.010" {{ ($savedSensorType == 'Wire (Holder)' && $savedSensorValue == '1.010') ? 'selected' : '' }}>1.010</option>
                                    <option value="1.155" {{ ($savedSensorType == 'Wire (Holder)' && $savedSensorValue == '1.155') ? 'selected' : '' }}>1.155</option>
                                    <option value="1.443" {{ ($savedSensorType == 'Wire (Holder)' && $savedSensorValue == '1.443') ? 'selected' : '' }}>1.443</option>
                                    <option value="1.732" {{ ($savedSensorType == 'Wire (Holder)' && $savedSensorValue == '1.732') ? 'selected' : '' }}>1.732</option>
                                    <option value="2.021" {{ ($savedSensorType == 'Wire (Holder)' && $savedSensorValue == '2.021') ? 'selected' : '' }}>2.021</option>
                                    <option value="2.309" {{ ($savedSensorType == 'Wire (Holder)' && $savedSensorValue == '2.309') ? 'selected' : '' }}>2.309</option>
                                </select>
                            </div>
                        </td>

                        <!-- Ball -->
                        <td style="border: 1px solid #dee2e6;">
                            <div class="sensor-container">
                                <input type="radio" name="sensor_type" id="sensor_ball" class="sensor-radio" value="Ball" {{ $savedSensorType == 'Ball' ? 'checked' : '' }}>
                                <label for="sensor_ball" class="sensor-label" title="Pilih Ball">Ball</label>
                                
                                <select name="ball_value" class="sensor-select">
                                    <option value="">Pilih nilai</option>
                                    <option value="0.800" {{ ($savedSensorType == 'Ball' && $savedSensorValue == '0.800') ? 'selected' : '' }}>0.800</option>
                                    <option value="1.350" {{ ($savedSensorType == 'Ball' && $savedSensorValue == '1.350') ? 'selected' : '' }}>1.350</option>
                                    <option value="1.800" {{ ($savedSensorType == 'Ball' && $savedSensorValue == '1.800') ? 'selected' : '' }}>1.800</option>
                                    <option value="2.300" {{ ($savedSensorType == 'Ball' && $savedSensorValue == '2.300') ? 'selected' : '' }}>2.300</option>
                                    <option value="3.200" {{ ($savedSensorType == 'Ball' && $savedSensorValue == '3.200') ? 'selected' : '' }}>3.200</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </fieldset>
        
    </td>
</tr>
 

  <!-- BARIS 2: GO DAN NOT GO -->
  <tr>
    <!-- ================= KIRI ================= -->
    <td style="width:65%; vertical-align:top; padding: 0 10px;">

      @if($calibration->detailThreadGauges && $calibration->detailThreadGauges->isNotEmpty())
        @php
          $detail = $calibration->detailThreadGauges->first();
        @endphp

        <!-- GO -->
        <table style="width:100%; border-collapse: collapse; border: 1px solid #555; font-size: 14px; background: #fff; margin-bottom: 20px;">
          <thead style="background: #f5f5f5;">
            <tr>
              <th style="border: 1px solid #555; width: 20%; padding: 8px; text-align: center; font-weight: bold;">Go</th>
              <th colspan="3" style="border: 1px solid #555; padding: 8px; text-align: left;">
                Kode Go Side :
                <span style="width: 65%; margin-left: 10px; font-size: 14px; display: inline-block; border-bottom: 1px solid #777; padding: 4px 0;">
                 <input type="text" name="kodeGO"
       value="{{ $detail->kodeGO ?? '' }}"
       style="border:none; outline:none; background:transparent; text-align:center;">
                </span>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr style="background: #fafafa;">
              <th style="border: 1px solid #555; padding: 10px; text-align: center;">Nilai Nominal</th>
              <th colspan="3" style="border: 1px solid #555; padding: 10px; text-align: center;">Penunjukan Standard</th>
            </tr>
            <tr style="background: #fafafa;">
            <th style="border: 1px solid #555; padding: 8px;">
                <input type="text" 
                       name="satuan_go" 
                       value="{{ $detail->satuan_go ?? ' ' }}"
                       style="width: 100%; padding: 6px; border: 1px solid #aaa; border-radius: 4px; font-size: 14px; background: white; text-align: center;">
            </th>
              <th style="border: 1px solid #555; padding: 8px; text-align: center;">Posisi</th>
              <th style="border: 1px solid #555; padding: 8px; text-align: center;">X</th>
              <th style="border: 1px solid #555; padding: 8px; text-align: center;">Y</th>
            </tr>

            <!-- ATAS -->
            <tr>
             <td rowspan="4" style="border: 1px solid #555; padding: 10px; vertical-align: middle;">
    <div style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-size: 14px; background: white; text-align: center;">
        <input type="text" name="nominalGO"
               value="{{ $detail->nominalGO ?? '' }}"
               style="width:100%; border:none; outline:none; background:transparent; text-align:center; font-size:14px;">
    </div>
</td>

<td rowspan="2" style="border: 1px solid #555; text-align: center; vertical-align: middle; padding: 40px 10px; background: #f9f9f9; font-weight: 500;">
    Atas
</td>

<td style="border: 1px solid #555; padding: 8px; height: 50px;">
    <div style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; text-align: center;">
        <input type="text" name="GOatasX1"
               value="{{ $detail->GOatasX1 ?? '' }}"
               style="width:100%; border:none; outline:none; background:transparent; text-align:center;">
    </div>
</td>

<td style="border: 1px solid #555; padding: 8px; height: 50px;">
    <div style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; text-align: center;">
        <input type="text" name="GOatasY1"
               value="{{ $detail->GOatasY1 ?? '' }}"
               style="width:100%; border:none; outline:none; background:transparent; text-align:center;">
    </div>
</td>
            </tr>
            <tr>
              <td style="border: 1px solid #555; padding: 8px; height: 50px; background: #fff;"></td>
              <td style="border: 1px solid #555; padding: 8px; height: 50px; background: #fff;"></td>
            </tr>

            <!-- BAWAH -->
            <tr>
              <td rowspan="2" style="border: 1px solid #555; text-align: center; vertical-align: middle; padding: 40px 10px; background: #f9f9f9; font-weight: 500;">Bawah</td>
             <td style="border: 1px solid #555; padding: 8px; height: 50px;">
    <div style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; text-align: center;">
        <input type="text" name="GObawahX1"
               value="{{ $detail->GObawahX1 ?? '' }}"
               style="width:100%; border:none; outline:none; background:transparent; text-align:center;">
    </div>
</td>

<td style="border: 1px solid #555; padding: 8px; height: 50px;">
    <div style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; text-align: center;">
        <input type="text" name="GObawahY1"
               value="{{ $detail->GObawahY1 ?? '' }}"
               style="width:100%; border:none; outline:none; background:transparent; text-align:center;">
    </div>
</td>
            </tr>
            <tr>
              <td style="border: 1px solid #555; padding: 8px; height: 50px; background: #fff;"></td>
              <td style="border: 1px solid #555; padding: 8px; height: 50px; background: #fff;"></td>
            </tr>
          </tbody>
        </table>

        <!-- NOT GO -->
        <table style="width:100%; border-collapse: collapse; border: 1px solid #555; font-size: 14px; background: #fff;">
          <thead style="background: #f5f5f5;">
            <tr>
              <th style="border: 1px solid #555; width: 20%; padding: 8px; text-align: center; font-weight: bold;">Not Go</th>
              <th colspan="3" style="border: 1px solid #555; padding: 8px; text-align: left;">
                Kode Not Go Side :
                <span style="width: 65%; margin-left: 10px; font-size: 14px; display: inline-block; border-bottom: 1px solid #777; padding: 4px 0;">
                 <input type="text" name="kodeNOTGO"
       value="{{ $detail->kodeNOTGO ?? '' }}"
       style="border:none; outline:none; background:transparent; text-align:center;">
                </span>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr style="background: #fafafa;">
              <th style="border: 1px solid #555; padding: 10px; text-align: center;">Nilai Nominal</th>
              <th colspan="3" style="border: 1px solid #555; padding: 10px; text-align: center;">Penunjukan Standard</th>
            </tr>
            <tr style="background: #fafafa;">
              <th style="border: 1px solid #555; padding: 8px;">
                    <input type="text" 
                           name="satuan_not_go" 
                           value="{{ $detail->satuan_not_go ?? 'mm' }}"
                           style="width: 100%; padding: 6px; border: 1px solid #aaa; border-radius: 4px; font-size: 14px; background: white; text-align: center;">
                </th>
              <th style="border: 1px solid #555; padding: 8px; text-align: center;">Posisi</th>
              <th style="border: 1px solid #555; padding: 8px; text-align: center;">X</th>
              <th style="border: 1px solid #555; padding: 8px; text-align: center;">Y</th>
            </tr>

           <!-- ATAS -->
<tr>
    <td rowspan="4" style="border: 1px solid #555; padding: 10px; vertical-align: middle;">
        <div style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-size: 14px; background: white; text-align: center;">
            <input type="text" name="nominalNOTGO"
                   value="{{ $detail->nominalNOTGO ?? '' }}"
                   style="width:100%; border:none; outline:none; background:transparent; text-align:center; font-size:14px;">
        </div>
    </td>

    <td rowspan="2" style="border: 1px solid #555; text-align: center; vertical-align: middle; padding: 40px 10px; background: #f9f9f9; font-weight: 500;">
        Atas
    </td>

    <td style="border: 1px solid #555; padding: 8px; height: 50px;">
        <div style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; text-align: center;">
            <input type="text" name="NOTGOatasX1"
                   value="{{ $detail->NOTGOatasX1 ?? '' }}"
                   style="width:100%; border:none; outline:none; background:transparent; text-align:center;">
        </div>
    </td>

    <td style="border: 1px solid #555; padding: 8px; height: 50px;">
        <div style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; text-align: center;">
            <input type="text" name="NOTGOatasY1"
                   value="{{ $detail->NOTGOatasY1 ?? '' }}"
                   style="width:100%; border:none; outline:none; background:transparent; text-align:center;">
        </div>
    </td>
</tr>

<tr>
    <td style="border: 1px solid #555; padding: 8px; height: 50px; background: #fff;"></td>
    <td style="border: 1px solid #555; padding: 8px; height: 50px; background: #fff;"></td>
</tr>

<!-- BAWAH -->
<tr>
    <td rowspan="2" style="border: 1px solid #555; text-align: center; vertical-align: middle; padding: 40px 10px; background: #f9f9f9; font-weight: 500;">
        Bawah
    </td>

    <td style="border: 1px solid #555; padding: 8px; height: 50px;">
        <div style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; text-align: center;">
            <input type="text" name="NOTGObawahX1"
                   value="{{ $detail->NOTGObawahX1 ?? '' }}"
                   style="width:100%; border:none; outline:none; background:transparent; text-align:center;">
        </div>
    </td>

    <td style="border: 1px solid #555; padding: 8px; height: 50px;">
        <div style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; text-align: center;">
            <input type="text" name="NOTGObawahY1"
                   value="{{ $detail->NOTGObawahY1 ?? '' }}"
                   style="width:100%; border:none; outline:none; background:transparent; text-align:center;">
        </div>
    </td>
</tr>
            <tr>
              <td style="border: 1px solid #555; padding: 8px; height: 50px; background: #fff;"></td>
              <td style="border: 1px solid #555; padding: 8px; height: 50px; background: #fff;"></td>
            </tr>
          </tbody>
        </table>
      @else
        <!-- Tampilkan jika tidak ada data -->
        <div style="text-align: center; padding: 30px; background: #f8f9fa; border: 1px dashed #dee2e6; border-radius: 6px; margin-bottom: 20px;">
          <p style="color: #6c757d; margin: 0;">Tidak ada data Thread Gauge</p>
        </div>
      @endif

    </td>

    <!-- ================= KANAN (KOSONG KARENA SENSOR SUDAH DIPINDAH) ================= -->
    <td style="width:35%; vertical-align:top; padding: 0 10px;">
      <!-- Kosong karena sensor table sudah dipindah ke atas -->
    </td>
  </tr>

</table>



<!-- ================= KETERANGAN & SUDUT ULIR (TANPA TABEL) ================= -->
<div style="font-family:Arial, sans-serif; font-size:11pt; margin-top:20px; display:flex; gap:30px; align-items:flex-start;">

  <!-- Keterangan Nilai Nominal -->
  <div style="width:50%;">
    <strong>Keterangan nilai nominal alat*</strong>
    <div style="margin-top:6px;">
      1. Tidak ada informasi<br>
      2. Tertera di alat ukur<br>
      3. Terdapat di lembaran dari manufaktur
    </div>
  </div>

 <!-- Ukuran Pitch & Sudut Ulir -->
<div style="width:50%;">
    @if($calibration->detailThreadGauges && $calibration->detailThreadGauges->isNotEmpty())
        @php
            $detail = $calibration->detailThreadGauges->first();
            // Parse sudut ulir
            $sudutUlirDisplay = $detail->sudutUlir ?? '';
            $isMetrik = false;
            $isNonMetrik = false;
            $isLainnya = false;
            $sudutLainnyaValue = '';
            
            if($sudutUlirDisplay) {
                if(str_contains($sudutUlirDisplay, 'Ulir Metrik') || $sudutUlirDisplay == '60°') {
                    $isMetrik = true;
                } elseif(str_contains($sudutUlirDisplay, 'Ulir Non Metrik') || $sudutUlirDisplay == '55°') {
                    $isNonMetrik = true;
                } else {
                    $isLainnya = true;
                    // Ambil nilai apa adanya, hapus kata "Lainnya" jika ada
                    $sudutLainnyaValue = trim(str_replace(['Lainnya:', 'Lainnya', '°'], '', $sudutUlirDisplay));
                    if(empty($sudutLainnyaValue)) {
                        $sudutLainnyaValue = $sudutUlirDisplay;
                    }
                }
            }
        @endphp

        <!-- Ukuran Pitch -->
        <div style="display:flex; align-items:center; gap:10px; margin-bottom:15px;">
            <strong style="white-space:nowrap;">Ukuran Pitch :</strong>
            <input type="text" 
                   name="ukuranPitch"
                   value="{{ $detail->ukuranPitch ?? '' }}"
                   style="width:90px; border:none; border-bottom:1px solid #000; background:transparent; text-align:center; padding:2px 0; outline:none;">
            <input type="text" 
                   name="satuan_pitch"
                   value="{{ $detail->satuan_pitch ?? 'mm' }}"
                   style="width:60px; border:none; border-bottom:1px solid #000; background:transparent; font-size:11pt; padding:2px 4px; text-align:center; outline:none;">
        </div>

        <!-- Sudut Ulir -->
        <div>
            <strong>Sudut Ulir *</strong><br>
            <div style="margin-top:6px; display:flex; flex-direction:column; gap:6px;">
                <!-- Pilihan Metrik 60° -->
                <div style="display:flex; align-items:center; gap:6px;">
                    <input type="radio" 
                           name="sudut_ulir" 
                           id="sudut_metrik" 
                           value="Ulir Metrik : 60°"
                           style="width:16px; height:16px; cursor:pointer;"
                           {{ $isMetrik ? 'checked' : '' }}>
                    <label for="sudut_metrik" style="cursor:pointer;">Ulir Metrik : 60°</label>
                </div>
                
                <!-- Pilihan Non Metrik 55° -->
                <div style="display:flex; align-items:center; gap:6px;">
                    <input type="radio" 
                           name="sudut_ulir" 
                           id="sudut_non_metrik" 
                           value="Ulir Non Metrik : 55°"
                           style="width:16px; height:16px; cursor:pointer;"
                           {{ $isNonMetrik ? 'checked' : '' }}>
                    <label for="sudut_non_metrik" style="cursor:pointer;">Ulir Non Metrik : 55°</label>
                </div>
                
                <!-- Pilihan Lainnya dengan input manual -->
                <div style="display:flex; align-items:center; gap:6px;">
                    <input type="radio" 
                           name="sudut_ulir" 
                           id="sudut_lainnya" 
                           value="lainnya"
                           style="width:16px; height:16px; cursor:pointer;"
                           {{ $isLainnya ? 'checked' : '' }}>
                    <label for="sudut_lainnya" style="cursor:pointer;">Lainnya :</label>
                    <input type="text" 
                           name="sudut_lainnya_value" 
                           value="{{ $sudutLainnyaValue }}"
                           style="width:60px; border:none; border-bottom:1px solid #000; background:transparent; text-align:center; padding:2px; outline:none;"
                           placeholder="nilai">
                    <span>°</span>
                </div>
            </div>
        </div>
    @else
        <!-- Tampilkan form kosong jika tidak ada data -->
        <!-- Ukuran Pitch -->
        <div style="display:flex; align-items:center; gap:10px; margin-bottom:15px;">
            <strong style="white-space:nowrap;">Ukuran Pitch :</strong>
            <input type="text" 
                   name="ukuranPitch"
                   value=""
                   style="width:90px; border:none; border-bottom:1px solid #000; background:transparent; text-align:center; padding:2px 0; outline:none;"
                   placeholder="0.00">
            <input type="text" 
                   name="satuan_pitch"
                   value=""
                   style="width:60px; border:none; border-bottom:1px solid #000; background:transparent; font-size:11pt; padding:2px 4px; text-align:center; outline:none;">
        </div>

        <!-- Sudut Ulir -->
        <div>
            <strong>Sudut Ulir *</strong><br>
            <div style="margin-top:6px; display:flex; flex-direction:column; gap:6px;">
                <div style="display:flex; align-items:center; gap:6px;">
                    <input type="radio" name="sudut_ulir" id="sudut_metrik_new" value="Ulir Metrik : 60°" style="width:16px; height:16px;">
                    <label for="sudut_metrik_new" style="cursor:pointer;">Ulir Metrik : 60°</label>
                </div>
                
                <div style="display:flex; align-items:center; gap:6px;">
                    <input type="radio" name="sudut_ulir" id="sudut_non_metrik_new" value="Ulir Non Metrik : 55°" style="width:16px; height:16px;">
                    <label for="sudut_non_metrik_new" style="cursor:pointer;">Ulir Non Metrik : 55°</label>
                </div>
                
                <div style="display:flex; align-items:center; gap:6px;">
                    <input type="radio" name="sudut_ulir" id="sudut_lainnya_new" value="lainnya" style="width:16px; height:16px;">
                    <label for="sudut_lainnya_new" style="cursor:pointer;">Lainnya :</label>
                    <input type="text" 
                           name="sudut_lainnya_value" 
                           value=""
                           style="width:60px; border:none; border-bottom:1px solid #000; background:transparent; text-align:center; padding:2px; outline:none;"
                           placeholder="nilai">
                    <span>°</span>
                </div>
            </div>
        </div>
    @endif
</div>

</div>

<!-- CATATAN -->
<div style="font-family:Arial, sans-serif; font-size:11pt; margin-top:20px;">
  <strong>Catatan :</strong>
  <div style="
    width:100%;
    height:200px;
    margin-top:6px;
    border:1px solid #000;
    padding:8px;
    font-family:Arial;
    font-size:11pt;
    background:white;
    overflow-y:auto;
    white-space:pre-line;
  ">
    @if($calibration->headThreadGauge && $calibration->headThreadGauge->catatan)
     <textarea name="catatan"
          rows="3"
          style="width:100%; border:none; outline:none; resize:none; background:transparent; font-size:12px; text-align:left;">
{{ $calibration->headThreadGauge->catatan ?? '' }}
</textarea>
    @else
      <div style="color:#999; text-align:center; padding:40px 0;">
        Tidak ada catatan
      </div>
    @endif
  </div>
</div>

                    <!-- Jarak dan Footer Section -->
                        <div style="margin-top: 40px; margin-bottom: 20px;"></div>

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
        </td>
        <td style="width: 20%; border: 1pt solid #000; text-align: center; vertical-align: middle; font-size: 12pt; font-weight: bold; background-color: #f0f0f0;">
            Dikalibrasi oleh
        </td>
        <td style="width: 20%; border: 1pt solid #000; text-align: center; vertical-align: middle; font-size: 12pt; font-weight: bold; background-color: #f0f0f0;">
            Diperiksa oleh
        </td>
    </tr>

    @php
        // Parse data alat standar dari headThreadGauge
        $alatStandarString = $calibration->headThreadGauge->standard ?? '';
        $alatStandarArray = [];
        
        if($alatStandarString) {
            $items = explode(',', $alatStandarString);
            foreach($items as $item) {
                $alatStandarArray[] = trim($item);
            }
        }
        
        // Cek alat-alat spesifik
        $hasMesinULM = false;
        $hasGaugeBlock = false;
        $gaugeBlockValue = '';
        $hasRingGauge = false;
        $ringGaugeValue = '';
        
        foreach($alatStandarArray as $alat) {
            if(str_contains($alat, 'Mesin ULM 01-600D')) {
                $hasMesinULM = true;
            }
            if(str_contains($alat, 'Gauge Block')) {
                $hasGaugeBlock = true;
                preg_match('/Gauge Block\s+([\d\.]+)\s*mm/', $alat, $matches);
                if(isset($matches[1])) {
                    $gaugeBlockValue = $matches[1];
                } else {
                    // Ambil nilai apa adanya
                    $gaugeBlockValue = trim(str_replace(['Gauge Block', 'mm'], '', $alat));
                }
            }
            if(str_contains($alat, 'Ring Gauge')) {
                $hasRingGauge = true;
                // Ambil nilai Ring Gauge apa adanya
                $ringGaugeValue = trim(str_replace(['Ring Gauge', 'mm'], '', $alat));
                // Hapus tanda kurung dan isinya
                $ringGaugeValue = preg_replace('/\s*\([^)]*\)/', '', $ringGaugeValue);
                $ringGaugeValue = trim($ringGaugeValue);
            }
        }
        
        $calibratedBy = $calibration->calibratedBy ?? '';
        $verifiedBy = $calibration->verifiedBy ?? '';
    @endphp

    <!-- Baris 1: Mesin ULM 01-600D -->
    <tr style="height: 40pt;">
        <td style="width: 5%; border: 1pt solid #000; text-align: center; vertical-align: middle;">
            <input type="checkbox"
                   name="alat_standar[]"
                   value="Mesin ULM 01-600D"
                   style="width: 18px; height: 18px; cursor: pointer; transform: scale(1.2);"
                   {{ $hasMesinULM ? 'checked' : '' }}>
        </td>
        <td style="border: 1pt solid #000; padding-left: 15pt; font-size: 11pt; vertical-align: middle;">
            Mesin ULM 01-600D
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none;"></td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none;"></td>
    </tr>

    <!-- Baris 2: GAUGE BLOCK -->
       <!-- Baris 2: GAUGE BLOCK (SELECT SAJA 100,150,300) -->
    <tr style="height: 40pt;">
        <td style="border: 1pt solid #000; text-align: center; vertical-align: middle;">
            <input type="checkbox"
                   name="alat_standar[]"
                   value="Gauge Block"
                   class="gauge-block-checkbox"
                   style="width: 18px; height: 18px; cursor: pointer; transform: scale(1.2);"
                   {{ $hasGaugeBlock ? 'checked' : '' }}>
        </td>
        <td style="border: 1pt solid #000; padding-left: 15pt; font-size: 11pt; vertical-align: middle;">
            Gauge Block
            
            <select name="gauge_block_value" class="gauge-block-select" style="width: 100px; font-size: 11pt; padding: 4px; border: 1px solid #aaa; border-radius: 4px; margin-left: 10px;">
                <option value="">-- Pilih --</option>
                <option value="100" {{ $gaugeBlockValue == '100' ? 'selected' : '' }}>100 mm</option>
                <option value="150" {{ $gaugeBlockValue == '150' ? 'selected' : '' }}>150 mm</option>
                <option value="300" {{ $gaugeBlockValue == '300' ? 'selected' : '' }}>300 mm</option>
            </select>
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none;"></td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none;"></td>
    </tr>

    <!-- Baris 3: RING GAUGE -->
    <tr style="height: 60pt;">
        <td style="border: 1pt solid #000; text-align: center; vertical-align: middle;">
            <input type="checkbox"
                   name="alat_standar[]"
                   value="Ring Gauge"
                   class="ring-gauge-checkbox"
                   style="width: 18px; height: 18px; cursor: pointer; transform: scale(1.2);"
                   {{ $hasRingGauge ? 'checked' : '' }}>
        </td>
        <td style="border: 1pt solid #000; padding-left: 15pt; font-size: 11pt; vertical-align: middle;">
            Ring Gauge
            
            <!-- Pilihan nilai Ring Gauge (dropdown) -->
            <select name="ring_gauge_select" style="width: 100px; padding: 4px; border: 1px solid #aaa; border-radius: 4px; font-size: 11pt; margin-right: 10px;">
                <option value="">Pilih nilai</option>
                <option value="14" {{ $ringGaugeValue == '14' ? 'selected' : '' }}>14 mm</option>
                <option value="50" {{ $ringGaugeValue == '50' ? 'selected' : '' }}>50 mm</option>
                <option value="lainnya" {{ !in_array($ringGaugeValue, ['14', '50', '']) ? 'selected' : '' }}>Lainnya</option>
            </select>
            
            <!-- Input manual untuk nilai lainnya -->
            <input type="text"
                   name="ring_gauge_manual"
                   value="{{ !in_array($ringGaugeValue, ['14', '50', '']) ? $ringGaugeValue : '' }}"
                   style="width: 80px; border: none; border-bottom: 1px solid #000; background: transparent; text-align: center; padding: 2px;"
                   placeholder="isi nilai">
            <span> mm</span>
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none; padding: 10pt 0; vertical-align: top; font-size: 11pt; text-align: left;">
            TTD :
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none; padding: 10pt 0; vertical-align: top; font-size: 11pt; text-align: left;">
            TTD :
        </td>
    </tr>

    <!-- Baris 4: Metode Kalibrasi + Nama -->
    <tr style="height: 60pt;">
        <td style="border: 1pt solid #000; text-align: center; vertical-align: middle; font-weight: bold; font-size: 12pt; background-color: #f0f0f0;">
            Metode Kalibrasi
        </td>
        <td colspan="2" style="border: 1pt solid #000; padding-left: 15pt; font-size: 11pt; vertical-align: middle;">
            <input type="text"
                   name="calibration_method"
                   value="PAS-IK1102-64"
                   style="width: 100%; border: none; background: transparent; font-size: 11pt;" readonly>
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-bottom: 1pt solid #000; border-top: none; padding: 10pt; vertical-align: middle; font-size: 11pt;">
            Nama :
            <input type="text"
                   name="calibratedBy"
                   value="{{ $calibratedBy }}"
                   style="width: 100%; border: none; border-bottom: 1px solid #000; font-size: 11pt; padding: 5px 0; background: transparent; outline: none;" readonly>
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-bottom: 1pt solid #000; border-top: none; padding: 10pt; vertical-align: middle; font-size: 11pt;">
            Nama :
            <input type="text"
                   name="verifiedBy"
                   value="{{ $verifiedBy }}"
                   style="width: 100%; border: none; border-bottom: 1px solid #000; font-size: 11pt; padding: 5px 0; background: transparent; outline: none;">
        </td>
    </tr>
</table>

<!-- JavaScript untuk interaksi Ring Gauge -->
<script>
var tempFormDataStore = window.tempFormDataStore;
var isRestoring = window.isRestoring;
var tabSubmitStatus = window.tabSubmitStatus;
var currentActiveTabId = '1';

    document.addEventListener('DOMContentLoaded', function() {
        const ringGaugeSelect = document.querySelector('select[name="ring_gauge_select"]');
        const ringGaugeManual = document.querySelector('input[name="ring_gauge_manual"]');
        const ringGaugeCheckbox = document.querySelector('.ring-gauge-checkbox');
        
        function toggleRingGaugeInput() {
            if (ringGaugeSelect.value === 'lainnya') {
                ringGaugeManual.removeAttribute('readonly');
                ringGaugeManual.style.opacity = '1';
                ringGaugeManual.style.backgroundColor = '#fff';
            } else {
                ringGaugeManual.setAttribute('readonly', 'readonly');
                ringGaugeManual.style.opacity = '0.6';
                ringGaugeManual.style.backgroundColor = '#f5f5f5';
                if (ringGaugeSelect.value) {
                    ringGaugeManual.value = ringGaugeSelect.value;
                } else {
                    ringGaugeManual.value = '';
                }
            }
        }
        
        if (ringGaugeSelect) {
            ringGaugeSelect.addEventListener('change', toggleRingGaugeInput);
            toggleRingGaugeInput();
        }
        
        // Untuk Gauge Block
        const gaugeBlockCheckbox = document.querySelector('.gauge-block-checkbox');
        const gaugeBlockInput = document.querySelector('input[name="gauge_block_value"]');
        
        if (gaugeBlockCheckbox && gaugeBlockInput) {
            function toggleGaugeBlockInput() {
                if (gaugeBlockCheckbox.checked) {
                    gaugeBlockInput.removeAttribute('readonly');
                    gaugeBlockInput.style.opacity = '1';
                } else {
                    gaugeBlockInput.setAttribute('readonly', 'readonly');
                    gaugeBlockInput.style.opacity = '0.6';
                    gaugeBlockInput.value = '';
                }
            }
            
            gaugeBlockCheckbox.addEventListener('change', toggleGaugeBlockInput);
            toggleGaugeBlockInput();
        }
    });
</script>


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
</body>
</html>