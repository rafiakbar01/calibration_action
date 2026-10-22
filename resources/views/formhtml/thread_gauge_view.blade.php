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
                                <input class="form-check-input" type="radio" name="tempat_kalibrasi" value="lab" id="lab" 
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

<table style="width:100%; font-family:Arial; font-size:11pt; border-collapse:collapse;">

  <!-- BARIS 1: SENSOR TABLE (DIPINDAHKAN KE ATAS) -->
  <tr>
    <td colspan="2" style="padding: 0 10px 15px 10px;">
      
      <style>
        /* Tetap gunakan CSS yang sama untuk styling tabel */
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
        
        .sensor-table th:first-child {
          border-top-left-radius: 4px;
        }
        
        .sensor-table th:last-child {
          border-top-right-radius: 4px;
        }
        
        .sensor-table td {
          vertical-align: middle;
          background-color: white;
          padding: 8px !important;
          text-align: center;
        }
        
        .sensor-value-display {
          display: block;
          width: 100%;
          padding: 8px;
          border: 1.5px solid #28a745;
          border-radius: 6px;
          font-size: 13px;
          font-weight: 600;
          background: #f0fff4;
          color: #155724;
          box-sizing: border-box;
          height: 40px;
          text-align: center;
          overflow: hidden;
          white-space: nowrap;
          text-overflow: ellipsis;
          margin-top: 4px;
        }
        
        .empty-sensor {
          display: block;
          width: 100%;
          padding: 8px;
          border: 1.5px dashed #ccc;
          border-radius: 6px;
          font-size: 13px;
          font-weight: 500;
          color: #999;
          background: #f9f9f9;
          box-sizing: border-box;
          height: 40px;
          text-align: center;
          margin-top: 4px;
        }
        
        /* Perkecil padding header */
        .sensor-table th {
          padding: 8px 4px !important;
        }
        
        /* Perkecil font header */
        .sensor-table thead tr:first-child th {
          font-size: 12px !important;
          padding: 10px 4px !important;
        }
      </style>

      <!-- Tampilkan data sensor -->
      @php
          // Inisialisasi variabel dengan nilai default
          $sensorData = null;
          $sensorType = null;
          $sensorValue = null;
          
          // Periksa apakah ada data detail thread gauge
          if($calibration->detailThreadGauges && $calibration->detailThreadGauges->isNotEmpty()) {
              $detail = $calibration->detailThreadGauges->first();
              $sensorData = $detail->sensor;
              
              // Parse sensor data jika ada
              if($sensorData) {
                  $parts = explode(':', $sensorData);
                  if(count($parts) > 1) {
                      $sensorType = trim($parts[0]);
                      $sensorValue = trim($parts[1]);
                  }
              }
          }
      @endphp

      <table class="sensor-table">
        <thead>
          <tr>
            <th colspan="4" style="border: 1px solid #dee2e6; padding: 10px 4px; text-align: center; font-size: 12px; font-weight: 600;">
              Sensor yang digunakan
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
            <td style="border: 1px solid #dee2e6; height: 60px;">
              @if($sensorType == 'T-Probe' && $sensorValue)
                <div class="sensor-value-display" title="T-Probe: {{ $sensorValue }}">
                  {{ $sensorValue }}
                </div>
              @else
                <div class="empty-sensor">
                  -
                </div>
              @endif
            </td>

            <!-- Hanging Wire -->
            <td style="border: 1px solid #dee2e6; height: 60px;">
              @if($sensorType == 'Hanging Wire' && $sensorValue)
                <div class="sensor-value-display" title="Hanging Wire: {{ $sensorValue }}">
                  {{ $sensorValue }}
                </div>
              @else
                <div class="empty-sensor">
                  -
                </div>
              @endif
            </td>

            <!-- Wire (Holder) -->
            <td style="border: 1px solid #dee2e6; height: 60px;">
              @if($sensorType == 'Wire (Holder)' && $sensorValue)
                <div class="sensor-value-display" title="Wire (Holder): {{ $sensorValue }}">
                  {{ $sensorValue }}
                </div>
              @else
                <div class="empty-sensor">
                  -
                </div>
              @endif
            </td>

            <!-- Ball -->
            <td style="border: 1px solid #dee2e6; height: 60px;">
              @if($sensorType == 'Ball' && $sensorValue)
                <div class="sensor-value-display" title="Ball: {{ $sensorValue }}">
                  {{ $sensorValue }}
                </div>
              @else
                <div class="empty-sensor">
                  -
                </div>
              @endif
            </td>
          </tr>
        </tbody>
      </table>
      
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
                    {{ $detail->kodeGO ?? '-' }}
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
                <div style="width: 100%; padding: 6px; border: 1px solid #aaa; border-radius: 4px; font-size: 14px; background: white;">
                    {{ $detail->satuan_go ?? 'mm' }}
                </div>
            </th>
            <th style="border: 1px solid #555; padding: 8px; text-align: center;">Posisi</th>
            <th style="border: 1px solid #555; padding: 8px; text-align: center;">X</th>
            <th style="border: 1px solid #555; padding: 8px; text-align: center;">Y</th>
        </tr>

        <!-- ATAS -->
        <tr>
            <td rowspan="4" style="border: 1px solid #555; padding: 10px; vertical-align: middle;">
                <div style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-size: 14px; background: white; text-align: center;">
                    {{ $detail->nominalGO ?? '-' }}
                </div>
            </div>
            <td rowspan="2" style="border: 1px solid #555; text-align: center; vertical-align: middle; padding: 40px 10px; background: #f9f9f9; font-weight: 500;">Atas</div>
            <td style="border: 1px solid #555; padding: 8px; height: 50px;">
                <div style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; text-align: center;">
                    {{ $detail->GOatasX1 ?? '-' }}
                </div>
            </div>
            <td style="border: 1px solid #555; padding: 8px; height: 50px;">
                <div style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; text-align: center;">
                    {{ $detail->GOatasY1 ?? '-' }}
                </div>
            </div>
        </tr>
        <tr>
            <td style="border: 1px solid #555; padding: 8px; height: 50px; background: #fff;"></div>
            <td style="border: 1px solid #555; padding: 8px; height: 50px; background: #fff;"></div>
        </tr>

        <!-- BAWAH -->
        <tr>
            <td rowspan="2" style="border: 1px solid #555; text-align: center; vertical-align: middle; padding: 40px 10px; background: #f9f9f9; font-weight: 500;">Bawah</div>
            <td style="border: 1px solid #555; padding: 8px; height: 50px;">
                <div style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; text-align: center;">
                    {{ $detail->GObawahX1 ?? '-' }}
                </div>
            </div>
            <td style="border: 1px solid #555; padding: 8px; height: 50px;">
                <div style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; text-align: center;">
                    {{ $detail->GObawahY1 ?? '-' }}
                </div>
            </div>
        </tr>
        <tr>
            <td style="border: 1px solid #555; padding: 8px; height: 50px; background: #fff;"></div>
            <td style="border: 1px solid #555; padding: 8px; height: 50px; background: #fff;"></div>
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
                    {{ $detail->kodeNOTGO ?? '-' }}
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
                <div style="width: 100%; padding: 6px; border: 1px solid #aaa; border-radius: 4px; font-size: 14px; background: white;">
                    {{ $detail->satuan_not_go ?? 'mm' }}
                </div>
            </th>
            <th style="border: 1px solid #555; padding: 8px; text-align: center;">Posisi</th>
            <th style="border: 1px solid #555; padding: 8px; text-align: center;">X</th>
            <th style="border: 1px solid #555; padding: 8px; text-align: center;">Y</th>
        </tr>

        <!-- ATAS -->
        <tr>
            <td rowspan="4" style="border: 1px solid #555; padding: 10px; vertical-align: middle;">
                <div style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-size: 14px; background: white; text-align: center;">
                    {{ $detail->nominalNOTGO ?? '-' }}
                </div>
            </div>
            <td rowspan="2" style="border: 1px solid #555; text-align: center; vertical-align: middle; padding: 40px 10px; background: #f9f9f9; font-weight: 500;">Atas</div>
            <td style="border: 1px solid #555; padding: 8px; height: 50px;">
                <div style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; text-align: center;">
                    {{ $detail->NOTGOatasX1 ?? '-' }}
                </div>
            </div>
            <td style="border: 1px solid #555; padding: 8px; height: 50px;">
                <div style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; text-align: center;">
                    {{ $detail->NOTGOatasY1 ?? '-' }}
                </div>
            </div>
        </tr>
        <tr>
            <td style="border: 1px solid #555; padding: 8px; height: 50px; background: #fff;"></div>
            <td style="border: 1px solid #555; padding: 8px; height: 50px; background: #fff;"></div>
        </tr>

        <!-- BAWAH -->
        <tr>
            <td rowspan="2" style="border: 1px solid #555; text-align: center; vertical-align: middle; padding: 40px 10px; background: #f9f9f9; font-weight: 500;">Bawah</div>
            <td style="border: 1px solid #555; padding: 8px; height: 50px;">
                <div style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; text-align: center;">
                    {{ $detail->NOTGObawahX1 ?? '-' }}
                </div>
            </div>
            <td style="border: 1px solid #555; padding: 8px; height: 50px;">
                <div style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; text-align: center;">
                    {{ $detail->NOTGObawahY1 ?? '-' }}
                </div>
            </div>
        </tr>
        <tr>
            <td style="border: 1px solid #555; padding: 8px; height: 50px; background: #fff;"></div>
            <td style="border: 1px solid #555; padding: 8px; height: 50px; background: #fff;"></div>
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
                // Ambil data sudut ulir dari database
                $sudutUlirDisplay = $detail->sudutUlir ?? '';
                $isMetrik = false;
                $isNonMetrik = false;
                $isLainnya = false;
                $sudutLainnyaValue = '';
                
                if($sudutUlirDisplay) {
                    // Cek apakah pilihan Metrik (60°)
                    if($sudutUlirDisplay == 'Ulir Metrik : 60°' || $sudutUlirDisplay == '60°') {
                        $isMetrik = true;
                    } 
                    // Cek apakah pilihan Non Metrik (55°)
                    elseif($sudutUlirDisplay == 'Ulir Non Metrik : 55°' || $sudutUlirDisplay == '55°') {
                        $isNonMetrik = true;
                    } 
                    // Selain itu adalah pilihan Lainnya - TAMPILKAN LANGSUNG APA ADANYA
                    else {
                        $isLainnya = true;
                        // Langsung gunakan nilai yang tersimpan di database tanpa modifikasi
                        $sudutLainnyaValue = $sudutUlirDisplay;
                    }
                }
            @endphp

            <!-- Ukuran Pitch -->
            @if($detail->ukuranPitch)
                <div style="display:flex; align-items:center; gap:10px; margin-bottom:15px;">
                    <strong style="white-space:nowrap;">Ukuran Pitch :</strong>
                    <div style="width:90px; border:none; border-bottom:1px solid #000; background:transparent; text-align:center; padding:2px 0;">
                        {{ $detail->ukuranPitch }}
                    </div>
                    <div style="border:none; border-bottom:1px solid #000; background:transparent; font-size:11pt; padding:2px 4px;">
                        {{ $detail->satuan_pitch ?? 'mm' }}
                    </div>
                </div>
            @endif

            <!-- Sudut Ulir -->
            <div>
                <strong>Sudut Ulir *</strong><br>
                <div style="margin-top:6px; display:flex; flex-direction:column; gap:6px;">
                    <!-- Pilihan Metrik 60° -->
                    <div style="display:flex; align-items:center; gap:6px;">
                        <div style="width:16px; height:16px; border:2px solid {{ $isMetrik ? '#28a745' : '#ccc' }}; border-radius:50%; background:{{ $isMetrik ? '#28a745' : 'white' }}; display:flex; align-items:center; justify-content:center;">
                            @if($isMetrik)
                                <div style="width:6px; height:6px; background:white; border-radius:50%;"></div>
                            @endif
                        </div>
                        <span {{ $isMetrik ? 'style=font-weight:bold;color:#28a745;' : '' }}>Ulir Metrik : 60°</span>
                    </div>
                    
                    <!-- Pilihan Non Metrik 55° -->
                    <div style="display:flex; align-items:center; gap:6px;">
                        <div style="width:16px; height:16px; border:2px solid {{ $isNonMetrik ? '#28a745' : '#ccc' }}; border-radius:50%; background:{{ $isNonMetrik ? '#28a745' : 'white' }}; display:flex; align-items:center; justify-content:center;">
                            @if($isNonMetrik)
                                <div style="width:6px; height:6px; background:white; border-radius:50%;"></div>
                            @endif
                        </div>
                        <span {{ $isNonMetrik ? 'style=font-weight:bold;color:#28a745;' : '' }}>Ulir Non Metrik : 55°</span>
                    </div>
                    
                    <!-- Pilihan Lainnya - TAMPILKAN DATA APA ADANYA -->
                    <div style="display:flex; align-items:center; gap:6px;">
                        <div style="width:16px; height:16px; border:2px solid {{ $isLainnya ? '#28a745' : '#ccc' }}; border-radius:50%; background:{{ $isLainnya ? '#28a745' : 'white' }}; display:flex; align-items:center; justify-content:center;">
                            @if($isLainnya)
                                <div style="width:6px; height:6px; background:white; border-radius:50%;"></div>
                            @endif
                        </div>
                        <div style="display:flex; align-items:center; gap:8px;">
                            <span {{ $isLainnya ? 'style=font-weight:bold;color:#28a745;' : '' }}>Lainnya :</span>
                            <div style="min-width:60px; border:none; border-bottom:1px solid #000; background:transparent; text-align:center; padding:2px; {{ $isLainnya ? 'font-weight:bold;color:#28a745;' : '' }}">
                                {{ $sudutLainnyaValue }}
                            </div>
                            <span {{ $isLainnya ? 'style=font-weight:bold;color:#28a745;' : '' }}>°</span>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Tampilkan kosong jika tidak ada data -->
            <div style="display:flex; align-items:center; gap:10px; margin-bottom:15px;">
                <strong style="white-space:nowrap;">Ukuran Pitch :</strong>
                <div style="width:90px; border:none; border-bottom:1px dashed #ccc; background:transparent; text-align:center; padding:2px 0; color:#999;">
                    -
                </div>
                <div style="border:none; border-bottom:1px dashed #ccc; background:transparent; font-size:11pt; padding:2px 4px; color:#999;">
                    mm
                </div>
            </div>

            <!-- Sudut Ulir -->
            <div>
                <strong>Sudut Ulir *</strong><br>
                <div style="margin-top:6px; display:flex; flex-direction:column; gap:6px;">
                    <div style="display:flex; align-items:center; gap:6px;">
                        <div style="width:16px; height:16px; border:2px dashed #ccc; border-radius:50%; background:white;"></div>
                        <span style="color:#999;">Ulir Metrik : 60°</span>
                    </div>
                    
                    <div style="display:flex; align-items:center; gap:6px;">
                        <div style="width:16px; height:16px; border:2px dashed #ccc; border-radius:50%; background:white;"></div>
                        <span style="color:#999;">Ulir Non Metrik : 55°</span>
                    </div>
                    
                    <div style="display:flex; align-items:center; gap:6px;">
                        <div style="width:16px; height:16px; border:2px dashed #ccc; border-radius:50%; background:white;"></div>
                        <span style="display:flex; align-items:center; gap:8px; color:#999;">
                            Lainnya :
                            <div style="width:60px; border:none; border-bottom:1px dashed #ccc; background:transparent; text-align:center; padding:2px;">
                                -
                            </div>
                            °
                        </span>
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
      {{ $calibration->headThreadGauge->catatan }}
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
                Data Kalibrasi Thread Gauge
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
            // Split by comma and clean up
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
                // Extract value, contoh: "Gauge Block 100 mm"
                preg_match('/Gauge Block\s+([\d\.]+)\s*mm/', $alat, $matches);
                if(isset($matches[1])) {
                    $gaugeBlockValue = $matches[1];
                }
            }
            if(str_contains($alat, 'Ring Gauge')) {
                $hasRingGauge = true;
                // TAMPILKAN SELURUH NILAI RING GAUGE APA ADANYA
                // Hapus kata "Ring Gauge " dari depan
                $ringGaugeValue = trim(str_replace('Ring Gauge', '', $alat));
                // Hapus tanda kurung dan isinya jika ada
                $ringGaugeValue = preg_replace('/\s*\([^)]*\)/', '', $ringGaugeValue);
                $ringGaugeValue = trim($ringGaugeValue);
            }
        }
        
        // Ambil data calibrated_by dan verified_by
        $calibratedBy = $calibration->calibratedBy ?? null;
        $verifiedBy = $calibration->verifiedBy ?? null;
    @endphp

    <!-- Baris 1: Mesin ULM 01-600D -->
    <tr style="height: 40pt;">
        <td style="width: 5%; border: 1pt solid #000; text-align: center; vertical-align: middle;">
            <div style="width: 18pt; height: 18pt; border: 2px solid {{ $hasMesinULM ? '#28a745' : '#ccc' }}; background: {{ $hasMesinULM ? '#28a745' : 'white' }}; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                @if($hasMesinULM)
                    <span style="color: white; font-size: 10pt;">✓</span>
                @endif
            </div>
        </td>
        <td style="border: 1pt solid #000; padding-left: 15pt; font-size: 11pt; vertical-align: middle;">
            Mesin ULM 01-600D
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none;"></td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none;"></td>
    </tr>

    <!-- Baris 2: GAUGE BLOCK -->
    <tr style="height: 40pt;">
        <td style="border: 1pt solid #000; text-align: center; vertical-align: middle;">
            <div style="width: 18pt; height: 18pt; border: 2px solid {{ $hasGaugeBlock ? '#28a745' : '#ccc' }}; background: {{ $hasGaugeBlock ? '#28a745' : 'white' }}; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                @if($hasGaugeBlock)
                    <span style="color: white; font-size: 10pt;">✓</span>
                @endif
            </div>
        </td>
        <td style="border: 1pt solid #000; padding-left: 15pt; font-size: 11pt; vertical-align: middle;">
            Gauge Block
            
            <!-- TAMPILKAN NILAI GAUGE BLOCK -->
            @if($hasGaugeBlock && $gaugeBlockValue)
                <span style="display: inline-block; padding: 2px 8px; border: 1px solid #aaa; border-radius: 4px; font-size: 11pt; background: white; text-align: center;">
                    {{ $gaugeBlockValue }} mm
                </span>
            @elseif($hasGaugeBlock)
                <span style="display: inline-block; padding: 2px 8px; border: 1px solid #aaa; border-radius: 4px; font-size: 11pt; background: white; text-align: center;">
                    {{ $gaugeBlockValue }}
                </span>
            @else
                <span style="display: inline-block; padding: 2px 8px; border: 1px dashed #ccc; border-radius: 4px; font-size: 11pt; background: #f9f9f9; color: #999; text-align: center;">
                    -
                </span>
            @endif
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none;"></td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none;"></td>
    </tr>

    <!-- Baris 3: RING GAUGE -->
    <tr style="height: 60pt;">
        <td style="border: 1pt solid #000; text-align: center; vertical-align: middle;">
            <div style="width: 18pt; height: 18pt; border: 2px solid {{ $hasRingGauge ? '#28a745' : '#ccc' }}; background: {{ $hasRingGauge ? '#28a745' : 'white' }}; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                @if($hasRingGauge)
                    <span style="color: white; font-size: 10pt;">✓</span>
                @endif
            </div>
        </td>
        <td style="border: 1pt solid #000; padding-left: 15pt; font-size: 11pt; vertical-align: middle;">
            Ring Gauge
            
            <!-- TAMPILKAN NILAI RING GAUGE APA ADANYA -->
            @if($hasRingGauge && $ringGaugeValue)
                <span style="display: inline-block; padding: 2px 8px; border: 1px solid #aaa; border-radius: 4px; font-size: 11pt; background: white; text-align: center;">
                    {{ $ringGaugeValue }}
                </span>
                <span style="margin-left: 5px;"> </span>
            @elseif($hasRingGauge)
                <span style="display: inline-block; padding: 2px 8px; border: 1px solid #aaa; border-radius: 4px; font-size: 11pt; background: white; text-align: center;">
                    {{ $ringGaugeValue }}
                </span>
                <span style="margin-left: 5px;"> </span>
            @else
                <span style="display: inline-block; padding: 2px 8px; border: 1px dashed #ccc; border-radius: 4px; font-size: 11pt; background: #f9f9f9; color: #999; text-align: center;">
                    -
                </span>
                <span style="margin-left: 5px; color:#999;"> </span>
            @endif
        </td>
        <!-- Hapus garis atas dan bawah sepenuhnya pada sel TTD -->
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none; padding: 10pt 0; vertical-align: top; font-size: 11pt; text-align: left;">
            TTD :
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none; padding: 10pt 0; vertical-align: top; font-size: 11pt; text-align: left;">
            TTD :
        </td>
    </tr>

    <tr style="height: 60pt;">
        <td style="border: 1pt solid #000; text-align: center; vertical-align: middle; font-weight: bold; font-size: 12pt; background-color: #f0f0f0;">
            Metode Kalibrasi
        </td>
        <td colspan="2" style="border: 1pt solid #000; padding-left: 15pt; font-size: 11pt; vertical-align: middle;">
            PAS-IK1102-64
        </td>
        <!-- Hapus border atas pada sel Nama -->
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-bottom: 1pt solid #000; border-top: none; padding: 10pt; vertical-align: middle; font-size: 11pt;">
            Nama : 
            <div style="width: 100%; border: none; border-bottom: 1px solid #000; font-size: 11pt; padding: 5px 0; background: transparent;">
                {{ $calibratedBy ?? '-' }}
            </div>
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-bottom: 1pt solid #000; border-top: none; padding: 10pt; vertical-align: middle; font-size: 11pt;">
            Nama : 
            <div style="width: 100%; border: none; border-bottom: 1px solid #000; font-size: 11pt; padding: 5px 0; background: transparent;">
                {{ $verifiedBy ?? '-' }}
            </div>
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