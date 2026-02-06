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
        <input type="hidden" name="form_type" value="conductivity_meter">
        
            <div class="form-kalibrasi-container">
                <table class="kalibrasi-header-table">
                    <tr>
                        <td colspan="2">
                            <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK41</p>
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
                            <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">CONDUCTIVITY METER</p>
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
                                <input type="text"
                                    name="nama_alat"
                                    class="kalibrasi-input"
                                    value="Conductivity Meter"
                                    placeholder="Conductivity Meter"
                                    readonly
                                    style="background-color: #f5f5f5; color: #333;">
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
                                    <input class="form-check-input" type="radio" name="tempat_kalibrasi" value="lab" id="lab" required>
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
                                        step="0.1"
                                        oninput="formatInputNumber(this)"
                                        placeholder="0.0"
                                        required></td>
                                <td><input type="number"
                                        name="suhu_tengah" 
                                        class="kondisi-input" 
                                        step="0.1"
                                        oninput="formatInputNumber(this)"
                                        placeholder="0.0"
                                        required></td>
                                <td><input type="number"
                                        name="suhu_akhir" 
                                        class="kondisi-input" 
                                        step="0.1"
                                        oninput="formatInputNumber(this)"
                                        placeholder="0.0"
                                        required></td>
                            </tr>
                            <tr>
                                <td class="bg-light fw-bold" style="color: #000000;">RH (%)</td>
                                <td><input type="number"
                                        name="rh_awal" 
                                        class="kondisi-input" 
                                        step="0.1"
                                        oninput="formatInputNumber(this)"
                                        placeholder="0.0"
                                        required></td>
                                <td><input type="number"
                                        name="rh_tengah" 
                                        class="kondisi-input" 
                                        step="0.1"
                                        oninput="formatInputNumber(this)"
                                        placeholder="0.0"
                                        required></td>
                                <td><input type="number"
                                        name="rh_akhir" 
                                        class="kondisi-input" 
                                        step="0.1"
                                        oninput="formatInputNumber(this)"
                                        placeholder="0.0"
                                        required></td>
                            </tr>
                        </table>
                    </div>

                <!-- Data Kalibrasi Section -->
                <div class="data-kalibrasi-header" style="color: #000000;">DATA KALIBRASI</div>
                
           <table cellspacing="0" cellpadding="0" class="TableNormal" style="margin-left:3.48pt; border:1pt solid #000000; -aw-border-insideh:1pt solid #000000; -aw-border-insidev:1pt solid #000000; border-collapse:collapse; font-size:12pt">
    <!-- Header Row 1 -->
    <tr style="height:20pt">
    <td style="width:120pt; border-right:1pt solid #000000; vertical-align:middle; text-align:center">
        <span style="font-family:Arial; font-weight:bold; font-size:11pt">Nilai CRM</span>
    </td>
    <td colspan="5" style="width:350pt; border:1pt solid #000000; border-bottom:1pt solid #000000; vertical-align:middle; text-align:center">
        <span style="font-family:Arial; font-weight:bold; font-size:11pt">Pembacaan Alat</span>
    </td>
    <td rowspan="2" style="width:110pt; border:1pt solid #000000; vertical-align:middle; text-align:center">
        <span style="font-family:Arial; font-weight:bold; font-size:11pt">Resolusi</span>
    </td>
    <td style="width:110pt; border-left:1pt solid #000000; vertical-align:middle; text-align:center">
        <span style="font-family:Arial; font-weight:bold; font-size:11pt">Suhu CRM</span>
    </td>
    </tr>
    
    <!-- Header Row 2 -->
    <tr style="height:20pt">
    <td style="width:120pt; border-right:1pt solid #000000; border-bottom:1pt solid #000000; vertical-align:middle; text-align:center">
        <span style="font-family:Arial; font-weight:bold; font-size:10pt"></span>
    </td>
    <td style="width:70pt; border:1pt solid #000000; vertical-align:middle; text-align:center">
        <span style="font-family:Arial; font-weight:bold; font-size:11pt">1</span>
    </td>
    <td style="width:70pt; border:1pt solid #000000; vertical-align:middle; text-align:center">
        <span style="font-family:Arial; font-weight:bold; font-size:11pt">2</span>
    </td>
    <td style="width:70pt; border:1pt solid #000000; vertical-align:middle; text-align:center">
        <span style="font-family:Arial; font-weight:bold; font-size:11pt">3</span>
    </td>
    <td style="width:70pt; border:1pt solid #000000; vertical-align:middle; text-align:center">
        <span style="font-family:Arial; font-weight:bold; font-size:11pt">4</span>
    </td>
    <td style="width:70pt; border:1pt solid #000000; vertical-align:middle; text-align:center">
        <span style="font-family:Arial; font-weight:bold; font-size:11pt">5</span>
    </td>
    <td style="width:110pt; border-left:1pt solid #000000; border-bottom:1pt solid #000000; vertical-align:middle; text-align:center">
        <span style="font-family:Arial; font-weight:bold; font-size:11pt"><sup>o</sup>C</span>
    </td>
    </tr>
    
    <!-- Data Rows - PHP Loop untuk 6 baris -->
    <?php
    for ($row = 1; $row <= 6; $row++) {
        // Tentukan style untuk baris terakhir
        $isLastRow = ($row == 6);
        
        // Style untuk sel pertama (Nilai CRM)
        $firstCellStyle = "width:120pt; border-right:1pt solid #000000;";
        if ($row == 1) {
            $firstCellStyle .= " border-top:1pt solid #000000;";
        }
        if (!$isLastRow) {
            $firstCellStyle .= " border-bottom:1pt solid #000000;";
        }
        $firstCellStyle .= " vertical-align:middle;";
        
        // Style untuk sel tengah (Pembacaan 1-5)
        $middleCellStyle = "width:70pt; border:1pt solid #000000;";
        if (!$isLastRow) {
            $middleCellStyle .= " border-bottom:1pt solid #000000;";
        }
        $middleCellStyle .= " vertical-align:middle;";
        
        // Style untuk sel resolusi
        $resolusiStyle = "width:110pt; border:1pt solid #000000;";
        if (!$isLastRow) {
            $resolusiStyle .= " border-bottom:1pt solid #000000;";
        }
        $resolusiStyle .= " vertical-align:middle;";
        
        // Style untuk sel terakhir (Suhu)
        $lastCellStyle = "width:110pt; border-left:1pt solid #000000;";
        if ($row == 1) {
            $lastCellStyle .= " border-top:1pt solid #000000;";
        }
        if (!$isLastRow) {
            $lastCellStyle .= " border-bottom:1pt solid #000000;";
        }
        $lastCellStyle .= " vertical-align:middle;";
        
        // Input style yang konsisten
        $inputStyle = "width:100%; height:60px; border:none; font-family:'Times New Roman'; font-size:14pt; text-align:center; box-sizing:border-box; background:transparent; outline:none; padding:5px;";
        
        echo '<tr style="height:60pt">';

        // Kolom 1: Nilai CRM - Sesuai dengan store: "nilai_crm_{$i}"
        echo '<td style="' . $firstCellStyle . '">';
        echo '<input type="number" name="nilai_crm_' . $row . '" style="' . $inputStyle . '">';
        echo '</td>';
        
        // Kolom 2-6: Pembacaan Alat 1-5 - Sesuai dengan store: "pembacaan_{$i}_{$j}"
        for ($col = 1; $col <= 5; $col++) {
            echo '<td style="' . $middleCellStyle . '">';
            echo '<input type="number" name="pembacaan_' . $row . '_' . $col . '" style="' . $inputStyle . '" step="0.01">';
            echo '</td>';
        }
        
        // Kolom 7: Resolusi - Sesuai dengan store: "resolusi_{$i}"
        echo '<td style="' . $resolusiStyle . '">';
        echo '<input type="number" name="resolusi_' . $row . '" style="' . $inputStyle . '" step="0.001">';
        echo '</td>';
        
        // Kolom 8: Suhu CRM - Sesuai dengan store: "suhu_crm_{$i}"
        echo '<td style="' . $lastCellStyle . '">';
        echo '<input type="number" name="suhu_crm_' . $row . '" style="' . $inputStyle . '" step="0.1">';
        echo '</td>';
        
        echo '</tr>';
    }
    ?>
</table>

                <p style="margin-top:8.8pt; margin-bottom:0.05pt; font-size:10pt">
                    <span style="-aw-import:ignore">&#xa0;</span>
                </p>


             <table cellspacing="0" cellpadding="0" class="TableNormal" style="margin-left:3.48pt; border:0.75pt solid #000000; -aw-border-insideh:0.75pt single #000000; -aw-border-insidev:0.75pt single #000000; border-collapse:collapse">
    <tr style="height:12.9pt">
      <td colspan="9" style="width:545.85pt; border-bottom-style:solid; border-bottom-width:0.75pt; vertical-align:top">
        <p class="TableParagraph" style="margin-left:0.8pt; text-align:center; line-height:11.95pt">
          <span style="font-family:Arial; font-weight:bold">Isilah</span>
          <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.45pt"></span>
          <span style="font-family:Arial; font-weight:bold">lembar</span>
          <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.5pt"></span>
          <span style="font-family:Arial; font-weight:bold">data</span>
          <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.45pt"></span>
          <span style="font-family:Arial; font-weight:bold">kalibrasi</span>
          <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.5pt"></span>
          <span style="font-family:Arial; font-weight:bold">dengan</span>
          <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.45pt"></span>
          <span style="font-family:Arial; font-weight:bold">lengkap</span>
          <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.45pt"></span>
          <span style="font-family:Arial; font-weight:bold">dan</span>
          <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.45pt"></span>
          <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.1pt">jelas!</span>
        </p>
      </td>
    </tr>
    <tr style="height:14.3pt">
      <td rowspan="2" style="width:148.15pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; vertical-align:top">
        <p class="TableParagraph" style="margin-top:0.2pt; font-size:9.5pt">
          <span style="-aw-import:ignore">&#xa0;</span>
        </p>
        <p class="TableParagraph" style="margin-left:1.35pt; text-align:center; font-size:9.5pt">
          <span>Alat</span>
          <span style="letter-spacing:-0.05pt"></span>
          <span style="letter-spacing:-0.1pt">Standar</span>
        </p>
      </td>
      <td colspan="6" style="width:224.7pt; border-style:solid; border-width:0.75pt; vertical-align:top; -aw-border-bottom:0.38pt thin-thick-medium-gap #000000">
        <p class="TableParagraph" style="margin-top:2.2pt; margin-left:1.45pt; font-size:9.5pt">
          <span>CRM,</span>
          <span style="letter-spacing:0.05pt"></span>
          <span style="letter-spacing:-0.1pt">Thermoscientific.</span>
        </p>
      </td>
      <td style="width:85.3pt; border-style:solid; border-width:0.75pt; vertical-align:top">
        <p class="TableParagraph" style="margin-top:2.1pt; margin-left:13.75pt; font-size:9.5pt">
          <span>Dikalibrasi</span>
          <span style="letter-spacing:0.35pt"></span>
          <span style="letter-spacing:-0.2pt">oleh</span>
        </p>
      </td>
      <td style="width:85.45pt; border-top-style:solid; border-top-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; vertical-align:top">
        <p class="TableParagraph" style="margin-top:2.1pt; margin-left:15.8pt; font-size:9.5pt">
          <span>Diperiksa</span>
          <span style="letter-spacing:0.35pt"></span>
          <span style="letter-spacing:-0.2pt">oleh</span>
        </p>
      </td>
    </tr>
    <tr style="height:13.6pt">
      <td style="width:24.65pt; border-style:solid; border-width:0.75pt; vertical-align:top">
        <p class="TableParagraph" style="margin-top:1.95pt; margin-left:1.45pt; font-size:9.5pt">
          <span style="letter-spacing:-0.25pt">TES</span>
        </p>
      </td>
      <td style="width:26.5pt; border-style:solid; border-width:0.75pt; vertical-align:top; -aw-border-bottom:0.38pt thick-thin-medium-gap #000000; -aw-border-top:0.38pt thick-thin-medium-gap #000000">
        <div style="text-align:center; padding:2px">
          <input type="checkbox" name="alat_standar[]" value="TES" id="tes_checkbox" style="width:14px; height:14px; margin:0">
        </div>
      </td>
      <td style="width:59.15pt; border-style:solid; border-width:0.75pt; vertical-align:top">
       
      </td>
      <td style="width:24.5pt; border-style:solid; border-width:0.75pt; vertical-align:top">
        <p class="TableParagraph" style="margin-top:1.95pt; margin-left:1.5pt; font-size:9.5pt">
          <span style="letter-spacing:-0.25pt">TFA</span>
        </p>
      </td>
      <td style="width:26.5pt; border-style:solid; border-width:0.75pt; vertical-align:top; -aw-border-bottom:0.38pt thick-thin-medium-gap #000000; -aw-border-top:0.38pt thick-thin-medium-gap #000000">
        <div style="text-align:center; padding:2px">
          <input type="checkbox" name="alat_standar[]" value="TFA" id="tfa_checkbox" style="width:14px; height:14px; margin:0">
        </div>
      </td>
      <td style="width:59.65pt; border-style:solid; border-width:0.75pt; vertical-align:top">
       
      </td>
      <td style="width:85.3pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; vertical-align:top">
       
      </td>
      <td style="width:85.45pt; border-top-style:solid; border-top-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; vertical-align:top">
      
      </td>
    </tr>
    <tr style="height:16.95pt">
      <td rowspan="2" style="width:148.15pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; vertical-align:top">
        <p class="TableParagraph" style="margin-top:9.25pt; margin-left:42.7pt; font-size:9.5pt">
          <span>Metode</span>
          <span style="letter-spacing:-0.1pt"> Kalibrasi</span>
        </p>
      </td>
      <td colspan="6" rowspan="2" style="width:224.7pt; border-style:solid; border-width:0.75pt; vertical-align:top; -aw-border-top:0.38pt thin-thick-medium-gap #000000">
        <p class="TableParagraph" style="margin-top:9.25pt; margin-left:1.45pt; font-size:9.5pt">
          <span style="letter-spacing:-0.1pt">PAS-IK1102-</span>
          <span style="letter-spacing:-0.25pt">41</span>
        </p>
      </td>
      <td style="width:85.3pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; vertical-align:top">
        <p class="TableParagraph" style="margin-top:4.45pt; margin-left:1.15pt; font-size:9.5pt">
          <span style="letter-spacing:-0.5pt">TTD</span>
        </p>
      </td>
      <td style="width:85.45pt; border-left-style:solid; border-left-width:0.75pt; vertical-align:top">
        <p class="TableParagraph" style="margin-top:4.45pt; margin-left:1.3pt; font-size:9.5pt">
          <span style="letter-spacing:-0.5pt">TTD</span>
        </p>
      </td>
    </tr>
    <tr style="height:12.4pt">
      <td style="width:85.3pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; vertical-align:top">
        <div style="display:flex; align-items:center; height:100%; padding-left:1.15pt">
          <span style="font-size:9.5pt; margin-right:4px; font-weight:bold">Nama</span>
          <span style="font-size:9.5pt; margin-right:2px; font-weight:bold">:</span>
          <input type="text" name="calibrated_by" style="flex:1; border:none; font-size:10pt; font-weight:bold; margin-left:4px; padding:2px 4px">
        </div>
      </td>
      <td style="width:85.45pt; border-left-style:solid; border-left-width:0.75pt; vertical-align:top">
        <div style="display:flex; align-items:center; height:100%; padding-left:1.3pt">
          <span style="font-size:9.5pt; margin-right:4px; font-weight:bold">Nama</span>
          <span style="font-size:9.5pt; margin-right:2px; font-weight:bold">:</span>
          <input type="text" name="verified_by" style="flex:1; border:none; font-size:10pt; font-weight:bold; margin-left:4px; padding:2px 4px">
        </div>
      </td>
    </tr>
</table>

                <!-- Submit Button Section -->
                <div class="row mt-5">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary btn-lg" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
                            <i class="fas fa-save me-2"></i>Simpan Data Kalibrasi
                        </button>
                        
                        <button type="reset" class="btn btn-secondary btn-lg ms-3" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
                            <i class="fas fa-redo me-2"></i>Reset Form
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
<script>
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