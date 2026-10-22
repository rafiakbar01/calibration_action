<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Kalibrasi - PT. PANANJUNG ANUGRAH SOLUTION</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Pastikan semua text berwarna hitam */
        .form-kalibrasi-container,
        .form-kalibrasi-container *:not(input):not(select):not(textarea):not(button) {
            color: #000000 !important;
        }
        
        /* Input fields tetap dengan warna default mereka */
        .kalibrasi-input {
            color: #000000 !important;
            border: 1px solid #ced4da !important;
            padding: 6px 10px;
            border-radius: 4px;
            width: 100%;
        }
        
        /* Placeholder text */
        .kalibrasi-input::placeholder {
            color: #666666 !important;
        }

        /* Styling khusus untuk input suhu dan RH */
        .kondisi-input {
            border: 1px solid #000 !important;
            text-align: center;
            width: 100%;
            padding: 4px;
        }

        /* Header styling */
        .kalibrasi-header-table {
            width: 100%;
            margin-bottom: 20px;
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

        /* Submit Button Styling */
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

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(107, 114, 128, 0.4);
            background: linear-gradient(135deg, #4b5563, #374151);
        }

        /* Form validation styling */
        input:required:invalid {
            border-color: #dc3545 !important;
        }

        input:required:valid {
            border-color: #198754 !important;
        }
    </style>
</head>
<body>
    <div class="container my-4">
        <!-- resources/views/formhtml/inside_micrometer.blade.php -->
        <form method="POST" action="/calibrations" id="kalibrasiForm">
        @csrf
        <input type="hidden" name="form_type" value="thread_gauge">
        
            <div class="form-kalibrasi-container">
                <table class="kalibrasi-header-table">
                    <tr>
                        <td colspan="2">
                            <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK64</p>
                        </td>
                        <td rowspan="5" style="text-align: center; vertical-align: middle; padding: 10px 0;">
                          <div style="display: inline-block; text-align: center;">
                              <div style="margin-bottom: 15px;">
                                  <!-- Logo PT. PANANJUNG ANUGRAH SOLUTION -->
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
                            <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;">PAS - </p>
                        </td>
                    </tr>
                </table>

                <!-- Main Form Section -->
                <table class="kalibrasi-main-table">
                    <!-- Nama Alat -->
                     <tr>
                           <td style="width: 20%;">
                                <p style="margin: 0; color: #000000;">Nama Alat</p>
                            </td>
                            <td colspan="3">
                                <!-- Hidden input untuk form type -->
                                 
                                
                                <select name="nama_alat" id="nama_alat_select" class="kalibrasi-input" onchange="updateFormType(this.value)" required style="background-color: #f5f5f5; color: #333; border: 1px solid #ced4da; padding: 6px 10px; border-radius: 4px; width: 100%;">
                                    <option value="">-- Pilih Alat --</option>
                                    <option value="Thread Gauge">Thread Gauge</option>
                                    <option value="MANUAL_INPUT">-- Input Nama Alat --</option>
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
                  

                    <!-- Merek & Kode Alat -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Merek</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" name="merek" class="kalibrasi-input me-3" placeholder="Masukkan merek alat" style="width: 60%;" required>
                                <span class="me-3" style="color: #000000;">Kode Alat :</span>
                                <input type="text" name="kode_alat" class="kalibrasi-input" placeholder="Masukkan kode" style="width: 30%;">
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
                                <input type="text" 
                                    name="type_alat" 
                                    class="kalibrasi-input me-3" 
                                    placeholder="Masukkan Type Alat" 
                                    style="width: 45%;"
                                    oninput="formatTypeAlat(this)">
                                <span class="me-3" style="color: #000000;">/</span>
                                <input type="text" 
                                    name="no_seri" 
                                    class="kalibrasi-input" 
                                    placeholder="Mmasukkan No. Seri" 
                                    style="width: 45%;"
                                    oninput="formatNoSeri(this)"
                                    required>
                            </div>
                        </td>
                    </tr>
                    <!-- Rentang Ukur -->
                    <!-- <tr>
                        <td><p style="margin:0;color:#000">Rentang Ukur</p></td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="number"
                                    name="rentang_ukur_min"
                                    class="kalibrasi-input me-3"
                                    value="0"
                                    step="any"
                                    style="width:45%;"
                                    placeholder="Masukkan Range Min"
                                    required>

                                <span class="me-3">-</span>

                                <input type="number"
                                    name="rentang_ukur_max"
                                    id="rentang_ukur_max"
                                    class="kalibrasi-input"
                                    step="any"
                                    style="width:45%;"
                                    placeholder="Masukkan Range Max"
                                    required
                                    oninput="document.getElementById('kapasitas').value = this.value || ''"
                                    onpaste="setTimeout(() => document.getElementById('kapasitas').value = this.value || '', 10)">
                            </div>
                        </td>
                    </tr> -->

                    <!-- Kapasitas / Resolusi -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Kapasitas / Resolusi</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" name="kapasitas" class="kalibrasi-input me-3" placeholder="Masukkan kapasitas" style="width: 45%;" required>
                                <span class="me-3" style="color: #000000;">/</span>
                                <input type="text" name="resolusi" class="kalibrasi-input" placeholder="Masukkan Resolusi" style="width: 45%;" required>
                            </div>
                        </td>
                    </tr>


                    <!-- Nama Pemilik -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Nama Pemilik</p>
                        </td>
                        <td colspan="3">
                            <input type="text" name="nama_pemilik" class="kalibrasi-input" placeholder="Masukkan nama pemilik / instansi" required>
                        </td>
                    </tr>

                    <!-- Tanggal Alat Masuk & Kalibrasi -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Tanggal Alat Masuk</p>
                        </td>
                        <td colspan="3">
                            <input type="date" name="tanggal_alat_masuk" class="kalibrasi-input" value="{{ date('Y-m-d') }}" required>
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
                                <select name="jenis_pembacaan" class="kalibrasi-input" style="width: 45%;">
                                    <option value="">-- Pilih --</option>
                                    <option value="manual">Manual</option>
                                    <option value="digital" selected>Digital</option>
                                </select>
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
                                    <input class="form-check-input" type="radio" name="tempat_kalibrasi" value="lab.PT PAS" id="lab" required>
                                    <label class="form-check-label" for="lab" style="color: #000000;">Lab. PT.PAS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tempat_kalibrasi" value="insitu" id="insitu" required>
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
                            <input type="text" name="lokasi_pt" class="kalibrasi-input" placeholder="Masukkan Lokasi PT">
                        </td>
                    </tr>

                  


                </table>

                <!-- Fungsi Komponen Lainnya & Kondisi Kalibrasi -->
                <div class="row mt-4">
                    <!-- Fungsi Komponen Lainnya -->
                    <div class="col-md-6 mb-4">
                        <div class="kalibrasi-section-header" style="color: #000000;">Fungsi Komponen Lainnya</div>
                        
                        <div class="d-flex justify-content-around align-items-center my-4">
                            <div class="text-center">
                                <span class="fw-bold d-block" style="color: #000000;">Ok</span>
                                <input type="radio" name="fungsi_komponen" value="ok" style="transform: scale(1.5); margin: 10px 0;" required>
                            </div>
                            <div class="text-center">
                                <span class="fw-bold d-block" style="color: #000000;">Rusak</span>
                                <input type="radio" name="fungsi_komponen" value="rusak" style="transform: scale(1.5); margin: 10px 0;" required>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center mt-4">
                            <span class="fw-bold me-3" style="color: #000000;">Keterangan :</span>
                            <div style="flex: 1; border-bottom: 2px solid #000;">
                                <input type="text" name="keterangan_fungsi_komponen" class="kalibrasi-input" placeholder="Masukkan Keterangan" style="border: none;">
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
                                <td><input type="number"
                                        name="suhu_awal" 
                                        class="kondisi-input" 
                                        step="any"
                                   
                                        placeholder="0.0"
                                        required></td>
                                <td><input type="number"
                                        name="suhu_tengah" 
                                        class="kondisi-input" 
                                        step="any"
                                   
                                        placeholder="0.0"
                                        required></td>
                                <td><input type="number"
                                        name="suhu_akhir" 
                                        class="kondisi-input" 
                                        step="any"
                                   
                                        placeholder="0.0"
                                        required></td>
                            </tr>
                            <tr>
                                <td class="bg-light fw-bold" style="color: #000000;">RH (%)</td>
                                <td><input type="number"
                                        name="rh_awal" 
                                        class="kondisi-input" 
                                        step="any"
                                   
                                        placeholder="0.0"
                                        required></td>
                                <td><input type="number"
                                        name="rh_tengah" 
                                        class="kondisi-input" 
                                        step="any"
                                   
                                        placeholder="0.0"
                                        required></td>
                                <td><input type="number"
                                        name="rh_akhir" 
                                        class="kondisi-input" 
                                        step="any"
                                   
                                        placeholder="0.0"
                                        required></td>
                            </tr>
                        </table>
                    </div>

                <!-- Data Kalibrasi Section -->
                <div class="data-kalibrasi-header" style="color: #000000;">DATA KALIBRASI</div>
                


        <table style="width:100%; font-family:Arial; font-size:11pt; border-collapse:collapse;">

  <!-- BARIS 1: SENSOR TABLE (DIPINDAHKAN KE ATAS) -->
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
        
        .sensor-label::after {
          content: '';
          position: absolute;
          right: 8px;
          top: 50%;
          transform: translateY(-50%);
          width: 10px;
          height: 6px;
          background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6' viewBox='0 0 10 4' fill='none'%3E%3Cpath d='M1 1L5 3L9 1' stroke='%23333' stroke-width='1.2' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
          background-repeat: no-repeat;
          opacity: 0.7;
          transition: all 0.2s ease;
        }
        
        .sensor-radio:checked + .sensor-label {
          border-color: #28a745;
          background-color: #f0fff4;
          color: #155724;
          box-shadow: 0 0 0 2px rgba(40, 167, 69, 0.1);
        }
        
        .sensor-radio:checked + .sensor-label::after {
          background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6' viewBox='0 0 10 4' fill='none'%3E%3Cpath d='M1 1L5 3L9 1' stroke='%23155724' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
          opacity: 1;
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
        
        .sensor-table th:first-child {
          border-top-left-radius: 4px;
        }
        
        .sensor-table th:last-child {
          border-top-right-radius: 4px;
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
        
        /* Styling untuk option dropdown */
        .sensor-select option {
          padding: 6px 8px;
          font-size: 12px;
          font-weight: 500;
        }
        
        /* Radio button group */
        .sensor-group {
          margin: 0;
          padding: 0;
          border: none;
        }
        
        .sensor-group-legend {
          display: none;
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

      <!-- Gunakan fieldset untuk mengelompokkan radio buttons -->
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
                  <input type="radio" name="sensor_type" id="sensor_t_probe" class="sensor-radio" value="t_probe">
                  <label for="sensor_t_probe" class="sensor-label" title="Pilih T-Probe">T-Probe</label>
                  
                  <select name="t_probe_value" class="sensor-select">
                    <option value="">Pilih nilai</option>
                    <option value="0.455">0.455</option>
                    <option value="0.530">0.530</option>
                    <option value="0.620">0.620</option>
                    <option value="0.725">0.725</option>
                    <option value="0.895">0.895</option>
                    <option value="1.100">1.100</option>
                    <option value="1.350">1.350</option>
                    <option value="1.650">1.650</option>
                    <option value="2.050">2.050</option>
                    <option value="2.550">2.550</option>
                    <option value="3.200">3.200</option>
                    <option value="4.000">4.000</option>
                  </select>
                </div>
              </td>

              <!-- Hanging Wire -->
              <td style="border: 1px solid #dee2e6;">
                <div class="sensor-container">
                  <input type="radio" name="sensor_type" id="sensor_hanging_wire" class="sensor-radio" value="hanging_wire">
                  <label for="sensor_hanging_wire" class="sensor-label" title="Pilih Hanging Wire">Hanging Wire</label>
                  
                  <select name="hanging_wire_value" class="sensor-select">
                    <option value="">Pilih nilai</option>
                    <option value="0.170">0.170</option>
                    <option value="0.195">0.195</option>
                    <option value="0.220">0.220</option>
                    <option value="0.250">0.250</option>
                    <option value="0.290">0.290</option>
                    <option value="0.335">0.335</option>
                    <option value="0.390">0.390</option>
                    <option value="0.455">0.455</option>
                    <option value="0.530">0.530</option>
                    <option value="0.620">0.620</option>
                    <option value="0.725">0.725</option>
                    <option value="0.895">0.895</option>
                    <option value="1.100">1.100</option>
                    <option value="1.350">1.350</option>
                    <option value="1.650">1.650</option>
                    <option value="2.050">2.050</option>
                    <option value="2.550">2.550</option>
                    <option value="3.200">3.200</option>
                    <option value="4.000">4.000</option>
                    <option value="5.050">5.050</option>
                    <option value="6.350">6.350</option>
                    
                  </select>
                </div>
              </td>

              <!-- Wire (Holder) -->
              <td style="border: 1px solid #dee2e6;">
                <div class="sensor-container">
                  <input type="radio" name="sensor_type" id="sensor_wire_holder" class="sensor-radio" value="wire_holder">
                  <label for="sensor_wire_holder" class="sensor-label" title="Pilih Wire (Holder)">Wire (Holder)</label>
                  
                  <select name="wire_holder_value" class="sensor-select">
                    <option value="">Pilih nilai</option>
                    <option value="0.173">0.173</option>
                    <option value="0.202">0.202</option>
                    <option value="0.231">0.231</option>
                    <option value="0.260">0.260</option>
                    <option value="0.289">0.289</option>
                    <option value="0.346">0.346</option>
                    <option value="0.404">0.404</option>
                    <option value="0.433">0.433</option>
                    <option value="0.462">0.462</option>
                    <option value="0.577">0.577</option>
                    <option value="0.722">0.722</option>
                    <option value="0.866">0.866</option>
                    <option value="1.010">1.010</option>
                    <option value="1.155">1.155</option>
                    <option value="1.443">1.443</option>
                    <option value="1.732">1.732</option>
                    <option value="2.021">2.021</option>
                    <option value="2.309">2.309</option>
                 
                  </select>
                </div>
              </td>

              <!-- Ball -->
              <td style="border: 1px solid #dee2e6;">
                <div class="sensor-container">
                  <input type="radio" name="sensor_type" id="sensor_ball" class="sensor-radio" value="ball">
                  <label for="sensor_ball" class="sensor-label" title="Pilih Ball">Ball</label>
                  
                  <select name="ball_value" class="sensor-select">
                    <option value="">Pilih nilai</option>
                    <option value="0.800">0.800</option>
                    <option value="1.350">1.350</option>
                    <option value="1.800">1.800</option>
                    <option value="2.300">2.300</option>
                    <option value="3.200">3.200</option>
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

      <!-- GO -->
      <table style="width:100%; border-collapse: collapse; border: 1px solid #555; font-size: 14px; background: #fff; margin-bottom: 20px;">
        <thead style="background: #f5f5f5;">
          <tr>
            <th style="border: 1px solid #555; width: 20%; padding: 8px; text-align: center; font-weight: bold;">Go</th>
            <th colspan="3" style="border: 1px solid #555; padding: 8px; text-align: left;">
              Kode Go Side :
              <input type="text" name="kode_go" style="width: 65%; margin-left: 10px; border: none; border-bottom: 1px solid #777; padding: 4px; font-size: 14px;">
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
                       value="mm"
                       style="width: 100%; padding: 6px; border: 1px solid #aaa; border-radius: 4px; font-size: 14px; text-align: center;">
            </th>
            <th style="border: 1px solid #555; padding: 8px; text-align: center;">Posisi</th>
            <th style="border: 1px solid #555; padding: 8px; text-align: center;">X</th>
            <th style="border: 1px solid #555; padding: 8px; text-align: center;">Y</th>
          </tr>

          <!-- ATAS -->
          <tr>
            <td rowspan="4" style="border: 1px solid #555; padding: 10px; vertical-align: middle;">
              <input type="text" name="nilai_nominal_go" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-size: 14px;">
            </td>
            <td rowspan="2" style="border: 1px solid #555; text-align: center; vertical-align: middle; padding: 40px 10px; background: #f9f9f9; font-weight: 500;">Atas</td>
            <td style="border: 1px solid #555; padding: 8px; height: 50px;">
              <input type="text" name="go_atas_x" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
            </td>
            <td style="border: 1px solid #555; padding: 8px; height: 50px;">
              <input type="text" name="go_atas_y" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
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
              <input type="text" name="go_bawah_x" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
            </td>
            <td style="border: 1px solid #555; padding: 8px; height: 50px;">
              <input type="text" name="go_bawah_y" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
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
              <input type="text" name="kode_not_go" style="width: 65%; margin-left: 10px; border: none; border-bottom: 1px solid #777; padding: 4px; font-size: 14px;">
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
                       value="mm"
                       style="width: 100%; padding: 6px; border: 1px solid #aaa; border-radius: 4px; font-size: 14px; text-align: center;">
            </th>
            <th style="border: 1px solid #555; padding: 8px; text-align: center;">Posisi</th>
            <th style="border: 1px solid #555; padding: 8px; text-align: center;">X</th>
            <th style="border: 1px solid #555; padding: 8px; text-align: center;">Y</th>
          </tr>

          <!-- ATAS -->
          <tr>
            <td rowspan="4" style="border: 1px solid #555; padding: 10px; vertical-align: middle;">
              <input type="text" name="nilai_nominal_not_go" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-size: 14px;">
            </td>
            <td rowspan="2" style="border: 1px solid #555; text-align: center; vertical-align: middle; padding: 40px 10px; background: #f9f9f9; font-weight: 500;">Atas</td>
            <td style="border: 1px solid #555; padding: 8px; height: 50px;">
              <input type="text" name="not_go_atas_x" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
            </td>
            <td style="border: 1px solid #555; padding: 8px; height: 50px;">
              <input type="text" name="not_go_atas_y" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
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
              <input type="text" name="not_go_bawah_x" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
            </td>
            <td style="border: 1px solid #555; padding: 8px; height: 50px;">
              <input type="text" name="not_go_bawah_y" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
            </td>
          </tr>
          <tr>
            <td style="border: 1px solid #555; padding: 8px; height: 50px; background: #fff;"></td>
            <td style="border: 1px solid #555; padding: 8px; height: 50px; background: #fff;"></td>
          </tr>
        </tbody>
      </table>

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
    <!-- Ukuran Pitch -->
   <div style="display:flex; align-items:center; gap:10px; margin-bottom:15px;">
        <strong style="white-space:nowrap;">Ukuran Pitch :</strong>
        <input type="text"
               name="ukuran_pitch"
               style="width:90px; border:none; border-bottom:1px solid #000; background:transparent; text-align:center;"
               placeholder="0.00">
        <input type="text"
               name="satuan_pitch"
               style="width:60px; border:none; border-bottom:1px solid #000; background:transparent; text-align:center; font-size:11pt; padding:2px 4px;"
               placeholder="satuan">
    </div>

    <!-- Sudut Ulir -->
    <div>
      <strong>Sudut Ulir *</strong><br>
      <div style="margin-top:6px; display:flex; flex-direction:column; gap:6px;">
        <label style="display:flex; align-items:center; gap:6px;">
          <input type="radio" name="sudut_ulir_type" value="metrik"> 
          <span>Ulir Metrik : 60°</span>
        </label>
        
        <label style="display:flex; align-items:center; gap:6px;">
          <input type="radio" name="sudut_ulir_type" value="non_metrik"> 
          <span>Ulir Non Metrik : 55°</span>
        </label>
        
        <div style="display:flex; align-items:center; gap:6px;">
          <input type="radio" name="sudut_ulir_type" value="lainnya"> 
          <span style="display:flex; align-items:center; gap:8px;">
            Lainnya :
            <input type="text"
                   
                   name="sudut_ulir_lainnya"
                   style="width:60px; border:none; border-bottom:1px solid #000; background:transparent; text-align:center; padding:2px;"
                   placeholder="0">
            °
          </span>
        </div>
      </div>
    </div>
  </div>

</div>

<!-- CATATAN -->
<div style="font-family:Arial, sans-serif; font-size:11pt; margin-top:20px;">
  <strong>Catatan :</strong>
  <textarea
    name="catatan"
    style="
      width:100%;
      height:200px;
      margin-top:6px;
      border:1px solid #000;
      padding:8px;
      resize:none;
      font-family:Arial;
      font-size:11pt;
    "></textarea>
</div>




                <!-- Footer Section -->
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
            Digital Pressure Calibrator :
        </td>
        <td style="width: 20%; border: 1pt solid #000; text-align: center; vertical-align: middle; font-size: 12pt; font-weight: bold; background-color: #f0f0f0;">
            Dikalibrasi oleh
        </td>
        <td style="width: 20%; border: 1pt solid #000; text-align: center; vertical-align: middle; font-size: 12pt; font-weight: bold; background-color: #f0f0f0;">
            Diperiksa oleh
        </td>
    </tr>

    <!-- Baris 1: Const P.001 -->
    <tr style="height: 40pt;">
        <td style="width: 5%; border: 1pt solid #000; text-align: center; vertical-align: middle;">
            <input type="checkbox" name="alat_standar[]" value="Mesin ULM 01-600D" style="width: 18pt; height: 18pt; cursor: pointer;">
        </td>
        <td style="border: 1pt solid #000; padding-left: 15pt; font-size: 11pt; vertical-align: middle;">
            Mesin ULM 01-600D
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none;"></td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none;"></td>
    </tr>

    <!-- Baris 2: Adittel P.003 - GAUGE BLOCK (SELECT SAJA) -->
    <tr style="height: 40pt;">
        <td style="border: 1pt solid #000; text-align: center; vertical-align: middle;">
            <input type="checkbox" name="alat_standar[]" value="Gauge Block" style="width: 18pt; height: 18pt; cursor: pointer;">
        </td>
        <td style="border: 1pt solid #000; padding-left: 15pt; font-size: 11pt; vertical-align: middle;">
            Gauge Block
            
            <!-- HANYA SELECT, TIDAK ADA MANUAL -->
            <select name="gauge_block" class="mm-select" style="width: 100px; font-size: 11pt; padding: 2px; border: 1px solid #ccc;">
                <option value="">-- Pilih --</option>
                <option value="100">100 mm</option>
                <option value="150">150 mm</option>
                <option value="300">300 mm</option>
            </select>
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none;"></td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none;"></td>
    </tr>

    <!-- Baris 3: Adittel P.004 - RING GAUGE (SELECT ATAU MANUAL) -->
    <tr style="height: 60pt;">
        <td style="border: 1pt solid #000; text-align: center; vertical-align: middle;">
            <input type="checkbox" name="alat_standar[]" value="Ring Gauge" style="width: 18pt; height: 18pt; cursor: pointer;">
        </td>
        <td style="border: 1pt solid #000; padding-left: 15pt; font-size: 11pt; vertical-align: middle;">
            Ring Gauge
            
            <!-- PILIHAN SELECT -->
            <select name="ring_gauge_select" class="mm-select" style="width: 100px; font-size: 11pt; padding: 2px; border: 1px solid #ccc; margin-right: 10px;">
                <option value="">-- Pilih --</option>
                <option value="14">14 mm</option>
                <option value="50">50 mm</option>
            </select>
            
            <span style="margin: 0 10px; color: #666;">,</span>
            
            <!-- INPUT MANUAL (HANYA 1) -->
            <input type="text" name="ring_gauge_manual" 
                   style="width: 100px; border: none; border-bottom: 2px solid #000; font-size: 11pt; padding: 2px 0; background: transparent; text-align: center;" 
                   placeholder="ketik manual">
             
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
            <input type="text" name="calibrated_by" 
                style="width: 100%; border: none; border-bottom: 2px solid #000; font-size: 11pt; padding: 5px 0; background: transparent;"    value="{{ auth()->user()->nama ?? 'System' }}"  readonly
                >
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-bottom: 1pt solid #000; border-top: none; padding: 10pt; vertical-align: middle; font-size: 11pt;">
            Nama : 
            <input type="text" name="verified_by" 
                style="width: 100%; border: none; border-bottom: 2px solid #000; font-size: 11pt; padding: 5px 0; background: transparent;" 
                >
        </td>
    </tr>
</table>

                <!-- Submit Button Section -->
                <div class="row mt-5">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary btn-lg" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
                            <i class="fas fa-save me-2"></i>Simpan Data Kalibrasi
                        </button>
                        
                        <!--<button type="reset" class="btn btn-secondary btn-lg ms-3" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">-->
                        <!--    <i class="fas fa-redo me-2"></i>Reset Form-->
                        <!--</button>-->
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

// JavaScript form validation
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('kalibrasiForm');
    
    form.addEventListener('submit', function(e) {
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.style.borderColor = '#dc3545';
            }
        });

        if (!isValid) {
            e.preventDefault();
            alert('Harap isi semua field yang wajib diisi!');
            return;
        }

        const alatStandar = form.querySelectorAll('input[name="alat_standar[]"]:checked');
        if (alatStandar.length === 0) {
            e.preventDefault();
            alert('Pilih minimal 1 alat standar!');
            return;
        }

        const submitBtn = form.querySelector('button[type="submit"]');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
        submitBtn.disabled = true;
    });
});
</script>

<script>
// Fungsi untuk update kapasitas secara real-time dari range max
function updateKapasitas() {
    const maxInput = document.getElementById('rentang_ukur_max');
    const kapasitasInput = document.getElementById('kapasitas');
    
    // Ambil nilai dari rentang max
    const maxValue = parseFloat(maxInput.value);
    
    // Update kapasitas dengan nilai dari rentang max
    if (!isNaN(maxValue)) {
        // Format angka dengan 1 digit desimal
        kapasitasInput.value = maxValue.toFixed(1);
    } else {
        kapasitasInput.value = '';
    }
}

// Event listener saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    const maxInput = document.getElementById('rentang_ukur_max');
    
    // Tambahkan event listener untuk paste event juga
    maxInput.addEventListener('paste', function(e) {
        // Biarkan paste terjadi, lalu update kapasitas setelah 10ms
        setTimeout(updateKapasitas, 10);
    });
    
    // Juga update saat halaman pertama kali dimuat (jika ada nilai default di range max)
    updateKapasitas();
});
</script>



<script>
// Fungsi format Type Alat - menerima huruf, angka, titik, koma, dash, slash, spasi
function formatTypeAlat(input) {
    // Izinkan: huruf, angka, titik, koma, dash, slash, spasi, kurung, tanda petik
    // Tidak perlu mengubah value, hanya validasi input
    const regex = /[^A-Za-z0-9\s.,\-\/()"'&]/g;
    if (regex.test(input.value)) {
        input.value = input.value.replace(regex, '');
    }
}

// Fungsi format No. Seri - menerima huruf, angka, titik, koma, dash, slash
function formatNoSeri(input) {
    // Izinkan: huruf, angka, titik, koma, dash, slash
    // Tidak perlu mengubah value, hanya validasi input
    const regex = /[^A-Za-z0-9.,\-\/]/g;
    if (regex.test(input.value)) {
        input.value = input.value.replace(regex, '');
    }
}
</script>


<script>
// Fungsi untuk format input number yang bisa menerima koma
function formatNumberInput(input) {
    // Ambil nilai input
    let value = input.value;
    
    // Ganti koma dengan titik (untuk browser yang mengizinkan koma)
    value = value.replace(',', '.');
    
    // Jika ada lebih dari satu titik, hapus yang berlebih
    const dotCount = (value.match(/\./g) || []).length;
    if (dotCount > 1) {
        // Simpan bagian sebelum titik pertama dan setelah titik terakhir
        const firstPart = value.substring(0, value.indexOf('.') + 1);
        const lastPart = value.substring(value.lastIndexOf('.') + 1);
        value = firstPart + lastPart.replace(/\./g, '');
    }
    
    // Update nilai input jika ada perubahan
    if (value !== input.value) {
        input.value = value;
    }
}

// Event listener untuk menangani paste
document.addEventListener('DOMContentLoaded', function() {
    const numberInputs = document.querySelectorAll('input[type="number"]');
    
    numberInputs.forEach(input => {
        input.addEventListener('paste', function(e) {
            // Biarkan paste terjadi dulu
            setTimeout(() => {
                formatNumberInput(this);
            }, 10);
        });
    });
});
</script>

</body>

</html>