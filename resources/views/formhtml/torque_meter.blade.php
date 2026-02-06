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
        <!-- resources/views/formhtml/torque_wrench.blade.php -->
        <form method="POST" action="/calibrations" id="kalibrasiForm">
        @csrf
        <input type="hidden" name="form_type" value="torque_meter">
            <div class="form-kalibrasi-container">
                <table class="kalibrasi-header-table">
                    <tr>
                        <td colspan="2">
                            <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK13B</p>
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
                            <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">TORQUE TESTER - METER</p>
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
                                    value="Torque Meter"
                                    placeholder="Torque Meter"
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
                                <input type="text" name="kode_alat" class="kalibrasi-input" placeholder="Masukkan kode" style="width: 30%;" required>
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
                                <input type="text" name="type_alat" class="kalibrasi-input me-3" placeholder="Masukkan Type" style="width: 45%;" required>
                                <span class="me-3" style="color: #000000;">/</span>
                                <input type="text" name="no_seri" class="kalibrasi-input" placeholder="Masukkan No. Seri" style="width: 45%;" required>
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
                            <input type="date" name="tanggal_alat_masuk" class="kalibrasi-input" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Tanggal Kalibrasi</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <!-- Tanggal Kalibrasi -->
                                <input type="date" name="tanggal_kalibrasi" class="kalibrasi-input me-3" style="width: 45%;" required>
                                
                                <span class="me-3" style="color: #000000;">Jenis Pembacaan:</span>
                                
                                <!-- Dropdown Jenis Pembacaan -->
                                <select name="jenis_pembacaan" class="kalibrasi-input" style="width: 45%;" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="manual">Manual</option>
                                    <option value="digital">Digital</option>
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
                            <input type="text" name="lokasi_pt" class="kalibrasi-input" placeholder="Masukkan Lokasi PT"required>
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
                                    <td><input type="number" name="suhu_awal" class="kondisi-input" required></td>
                                    <td><input type="number" name="suhu_tengah" class="kondisi-input" required></td>
                                    <td><input type="number" name="suhu_akhir" class="kondisi-input" required></td>
                                </tr>
                                <tr>
                                    <td class="bg-light fw-bold" style="color: #000000;">RH (%)</td>
                                    <td><input type="number" name="rh_awal" class="kondisi-input" required></td>
                                    <td><input type="number" name="rh_tengah" class="kondisi-input" required></td>
                                    <td><input type="number" name="rh_akhir" class="kondisi-input" required></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                <!-- Data Kalibrasi Section -->
                <div class="data-kalibrasi-header" style="color: #000000;">DATA KALIBRASI</div>
                            <!-- Bagian Radius dengan Inputan Sederhana -->
                    <!-- Bagian Radius dengan jarak lebih rapi & lega -->
                    <div style="margin-bottom: 18px; font-family: Arial, sans-serif;">
                        <table style="border-collapse: collapse; display: inline-table;">
                            <tr>
                                <!-- Huruf r -->
                                <td style="padding-right: 18px; vertical-align: middle; text-align: right;">
                                    <span style="font-size: 13pt; font-weight: bold;">r</span>
                                </td>

                                <!-- Input nilai radius -->
                                <td style="padding-right: 12px; vertical-align: middle;">
                                    <input type="text" 
                                        id="radius_value" 
                                        name="radius_value" 
                                        style="width: 100px; padding: 6px 8px; font-size: 12pt; border: 1px solid #999; border-radius: 4px; text-align: center;"
                                        placeholder="">
                                </td>

                                <!-- Tanda kurung buka dengan jarak -->
                                <td style="padding-right: 8px; vertical-align: middle;">
                                    <span style="font-size: 12pt; color: #555;">(</span>
                                </td>

                                <!-- Input satuan -->
                                <td style="padding-right: 8px; vertical-align: middle;">
                                    <input type="text" 
                                        id="radius_unit" 
                                        name="radius_unit" 
                                        style="width: 90px; padding: 6px 8px; font-size: 12pt; border: 1px solid #999; border-radius: 4px; text-align: center;"
                                        placeholder="">
                                </td>

                                <!-- Tanda kurung tutup -->
                                <td style="vertical-align: middle;">
                                    <span style="font-size: 12pt; color: #555;">)</span>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- Tabel Utama -->
                    <table cellspacing="0" cellpadding="0" class="TableNormal" style="margin-left:0.6pt; border:1pt solid #000000; border-collapse:collapse; width:100%; max-width:1500px;">
                        
                        <!-- Header Tabel -->
                        <tr style="height:14pt">
                            <td colspan="2" style="width:128px; border:1pt solid #000000; vertical-align:middle; text-align:center">
                                <p style="margin:0; font-size:10pt;"><strong>Beban Anak Timbang</strong></p>
                            </td>
                            <td colspan="2" rowspan="2" style="width:172px; border:1pt solid #000000; vertical-align:middle; text-align:center">
                                <p style="margin:0; font-size:10pt;"><strong>Kode Anak timbangan yang digunakan</strong></p>
                            </td>
                            <td colspan="3" style="border:1pt solid #000000; vertical-align:middle; text-align:center">
                                <p style="margin:0; font-size:10pt; font-weight:bold;">
    Clockwise (
    <input type="text"
           name="clockwise_note"
           value=""
           style="
             width:80px;
             border:none;
             border-bottom:1px solid #000;
             font-size:10pt;
             font-family:inherit;
             background:transparent;
             text-align:center;
           ">
    )
</p>

                            </td>
                            <td colspan="3" style="border:1pt solid #000000; vertical-align:middle; text-align:center">
                               <p style="margin:0; font-size:10pt; font-weight:bold;">
    Counter Clockwise (
    <input type="text"
           name="counter_clockwise_note"
           value=""
           style="
             width:80px;
             border:none;
             border-bottom:1px solid #000;
             font-size:10pt;
             font-family:inherit;
             background:transparent;
             text-align:center;
           ">
    )
</p>

                            </td>
                        </tr>
                        
                        <!-- Sub-header -->
                        <tr style="height:14pt">
                            <td colspan="2" style="border:1pt solid #000000; vertical-align:middle; text-align:center">
                               <p style="margin:0; font-size:8.5pt;">
    <span style="font-family:'Lucida Console'; letter-spacing:0.5em">
        (
        <input type="text"
               name="catatan_lucida"
               value=""
               style="
                 width:120px;
                 border:none;
                 border-bottom:1px solid #000;
                 background:transparent;
                 font-family:'Lucida Console';
                 font-size:8.5pt;
                 letter-spacing:0.5em;
                 text-align:center;
                 outline:none;
               ">
        )
    </span>
</p>

                            </td>
                            <td style="border:1pt solid #000000; text-align:center"><strong>1</strong></td>
                            <td style="border:1pt solid #000000; text-align:center"><strong>2</strong></td>
                            <td style="border:1pt solid #000000; text-align:center"><strong>3</strong></td>
                            <td style="border:1pt solid #000000; text-align:center"><strong>1</strong></td>
                            <td style="border:1pt solid #000000; text-align:center"><strong>2</strong></td>
                            <td style="border:1pt solid #000000; text-align:center"><strong>3</strong></td>
                        </tr>
                        
                       <?php for($i = 1; $i <= 13; $i++): ?>
<tr style="height:14pt">
    <!-- Beban Anak Timbang — HANYA ANGKA (anti E/e) -->
    <td colspan="2" style="border:1pt solid #000000; vertical-align:top">
        <input type="number"
            step="any"
            class="number-only"
            style="width:100%; height:100%; border:none; padding:4px 2px; font-size:9pt; text-align:center;"
            id="row<?php echo $i; ?>_col0"
            name="row<?php echo $i; ?>_col0">
    </td>

    <!-- Kode Anak Timbang — BISA HURUF + ANGKA -->
    <td colspan="2" style="border:1pt solid #000000; vertical-align:top">
        <input type="text"
            style="width:100%; height:100%; border:none; padding:4px 2px; font-size:9pt;"
            id="row<?php echo $i; ?>_col1"
            name="row<?php echo $i; ?>_col1">
    </td>

    <!-- Clockwise & Counter Clockwise — HANYA ANGKA (anti E/e) -->
    <?php for($j = 2; $j <= 7; $j++): ?>
    <td style="border:1pt solid #000000; vertical-align:top">
        <input type="number"
            step="any"
            class="number-only"
            style="width:100%; height:100%; border:none; padding:4px; font-size:9pt; text-align:center;"
            name="row<?php echo $i; ?>_col<?php echo $j; ?>">
    </td>
    <?php endfor; ?>
</tr>
<?php endfor; ?>
                    </table>
                        
                    <!-- Repeatability Clockwise -->
                    <p class="BodyText" style="margin-top:2pt; margin-left:2pt">
                        <span style="letter-spacing:-0.1pt; font-size:9.5pt;">Repeatability Clockwise</span>
                    </p>

                    <table cellspacing="0" cellpadding="0" class="TableNormal" 
                        style="margin-left:0.6pt; border:1pt solid #000000; border-collapse:collapse; width:100%; max-width:450px;">
                        
                        <!-- Baris 1: Judul + 5 kolom angka pertama -->
                        <tr style="height:14pt">
                        
                            <?php for($i = 1; $i <= 5; $i++): ?>
                            <td style="width:45pt; border-left:1pt solid #000; <?php echo $i < 5 ? 'border-right:1pt solid #000;' : ''; ?> border-bottom:1pt solid #000; vertical-align:top">
                                <input type="number" 
                                    class="only-number"
                                    style="width:100%; height:100%; border:none; padding:2px; font-size:8.5pt; text-align:center;"
                                    name="repeat_cw_<?php echo $i; ?>">
                            </td>
                            <?php endfor; ?>
                        </tr>

                        <!-- Baris 2: Judul kedua + 5 kolom angka kedua -->
                        <tr style="height:14pt">
                        
                            <?php for($i = 6; $i <= 10; $i++): ?>
                            <td style="width:45pt; border-top:1pt solid #000; border-left:1pt solid #000; <?php echo $i < 10 ? 'border-right:1pt solid #000;' : ''; ?> vertical-align:top">
                                <input type="number" 
                                    class="only-number"
                                    style="width:100%; height:100%; border:none; padding:2px; font-size:8.5pt; text-align:center;"
                                    name="repeat_cw_<?php echo $i; ?>">
                            </td>
                            <?php endfor; ?>
                        </tr>
                    </table>


                    <!-- Repeatability Counter Clockwise -->
                    <p class="BodyText" style="margin-top:5pt; margin-left:2pt">
                        <span style="font-size:9.5pt;">Repeatability Counter Clockwise</span>
                    </p>

                    <table cellspacing="0" cellpadding="0" class="TableNormal" 
                        style="margin-left:0.6pt; border:1pt solid #000000; border-collapse:collapse; width:100%; max-width:450px;">
                        
                        <!-- Baris 1 -->
                        <tr style="height:14pt">
                        
                            <?php for($i = 1; $i <= 5; $i++): ?>
                            <td style="width:45pt; border-left:1pt solid #000; <?php echo $i < 5 ? 'border-right:1pt solid #000;' : ''; ?> border-bottom:1pt solid #000; vertical-align:top">
                                <input type="number" 
                                    class="only-number"
                                    style="width:100%; height:100%; border:none; padding:2px; font-size:8.5pt; text-align:center;"
                                    name="repeat_ccw_<?php echo $i; ?>">
                            </td>
                            <?php endfor; ?>
                        </tr>

                        <!-- Baris 2 -->
                        <tr style="height:14pt">
                            <?php for($i = 6; $i <= 10; $i++): ?>
                            <td style="width:45pt; border-top:1pt solid #000; border-left:1pt solid #000; <?php echo $i < 10 ? 'border-right:1pt solid #000;' : ''; ?> vertical-align:top">
                                <input type="number" 
                                    class="only-number"
                                    style="width:100%; height:100%; border:none; padding:2px; font-size:8.5pt; text-align:center;"
                                    name="repeat_ccw_<?php echo $i; ?>">
                            </td>
                            <?php endfor; ?>
                        </tr>
                    </table>

                                    <div style="height: 50px;"></div>


                                <!-- Footer Section -->
                                <table cellspacing="0" cellpadding="0" style="border-collapse: collapse; width: 100%; max-width: 1500px; margin-top: 20px; font-family: Arial, sans-serif; font-size: 10pt;">
                        <!-- HEADER -->
                        <tr>
                            <td colspan="4" style="border: 1pt solid #000; padding: 12px; background-color: #f0f0f0; text-align: center; font-weight: bold;">
                                Isilah lembar data kalibrasi dengan lengkap dan jelas!
                            </td>
                        </tr>

                        <!-- STANDARD + ANAK TIMBANG (textarea) -->
                        <tr>
                        <td rowspan="3" style="width: 110px; border: 1pt solid #000; vertical-align: middle; text-align: center; background-color: #f8f9fa; font-weight: bold;">
                            Standard
                        </td>
                        <td rowspan="3" style="width: 380px; border: 1pt solid #000; padding: 12px;">
                            <p style="margin: 0 0 8px 0; font-size: 10pt;">Anak Timbang :</p>
                            <textarea id="alat_standar" name="alat_standar_text" rows="9"
                                style="width: 100%; height: 160px; padding: 8px; font-size: 10pt; border: 1px solid #999; resize: none; background-color: #fffff8;"
                                placeholder="Masukkan semua anak timbang, satu per baris..."></textarea>
                        </td>

                        <!-- Header Dikalibrasi oleh & Diperiksa oleh -->
                        <td style="width: 200px; border: 1pt solid #000; text-align: center; padding: 15px 8px; background-color: #f8f9fa; font-weight: bold;">
                            Dikalibrasi<br>oleh
                        </td>
                        <td style="width: 200px; border: 1pt solid #000; text-align: center; padding: 15px 8px; background-color: #f8f9fa; font-weight: bold;">
                            Diperiksa<br>oleh
                        </td>
                    </tr>

                        <!-- BARIS NAMA (sesuai gambar: di tengah) -->
                        <tr>
                            <td style="border: 1pt solid #000; padding: 12px 8px; text-align: center;">
                                <input type="text" name="calibrated_by" placeholder="Nama Lengkap"
                                    style="width: 92%; border: none; border-bottom: 1px solid #000; background: transparent; padding: 6px 4px; font-size: 10pt; text-align: center;"
                                    required>
                            </td>
                            <td style="border: 1pt solid #000; padding: 12px 8px; text-align: center;">
                                <input type="text" name="verified_by" placeholder="Nama Lengkap"
                                    style="width: 92%; border: none; border-bottom: 1px solid #000; background: transparent; padding: 6px 4px; font-size: 10pt; text-align: center;"
                                    required>
                            </td>
                        </tr>

                        <!-- BARIS TTD (sesuai gambar: paling bawah, garis panjang) -->
                        <tr>
                            <td style="border: 1pt solid #000; padding: 15px 8px; text-align: center;">
                                <strong>TTD :</strong><br><br>
                                <div style="height: 70px; border-bottom: 2px solid #000; margin: 10px 15px;"></div>
                            </td>
                            <td style="border: 1pt solid #000; padding: 15px 8px; text-align: center;">
                                <strong>TTD :</strong><br><br>
                                <div style="height: 70px; border-bottom: 2px solid #000; margin: 10px 15px;"></div>
                            </td>
                        </tr>

                        <!-- METODE KALIBRASI (tetap di baris paling bawah, seperti kode awal) -->
                        <tr>
                            <td style="border: 1pt solid #000; text-align: center; background-color: #f8f9fa; font-weight: bold; padding: 12px;">
                                Metode<br>Kalibrasi
                            </td>
                            <td colspan="3" style="border: 1pt solid #000; padding: 12px; vertical-align: middle;">
                                PAS-IK1102-13B (ASTM D 3474-90 : 2018)
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
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.number-only').forEach(function(input) {
        // Blokir E, e, +, - saat diketik
        input.addEventListener('keydown', function(e) {
            if (['e', 'E', '+', '-'].includes(e.key)) {
                e.preventDefault();
            }
        });

        // Bersihkan jika ada E/e yang masuk lewat paste
        input.addEventListener('input', function() {
            this.value = this.value.replace(/[eE\+\-\,]/g, '');
        });

        // Opsional: batasi panjang (misal maks 10 karakter)
        input.addEventListener('input', function() {
            if (this.value.length > 12) {
                this.value = this.value.slice(0, 12);
            }
        });
    });
});
</script>
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

        // Validasi khusus untuk Torque Meter (ANAK TIMBANG)
        const anakTimbang = document.getElementById('anak_timbang');
        if (!anakTimbang.value.trim()) {
            isValid = false;
            anakTimbang.style.borderColor = '#dc3545';
            alert('Field "Anak Timbang" harus diisi!');
        }

        if (!isValid) {
            e.preventDefault();
            alert('Harap isi semua field yang wajib diisi!');
            return;
        }

        // HAPUS VALIDASI ALAT_STANDAR UNTUK TORQUE METER
        // Kode berikut tidak diperlukan untuk torque meter:
        // const alatStandar = form.querySelectorAll('input[name="alat_standar[]"]:checked');
        // if (alatStandar.length === 0) {
        //     e.preventDefault();
        //     alert('Pilih minimal 1 alat standar!');
        //     return;
        // }

        const submitBtn = form.querySelector('button[type="submit"]');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
        submitBtn.disabled = true;
    });
});
</script>
</body>
</html>