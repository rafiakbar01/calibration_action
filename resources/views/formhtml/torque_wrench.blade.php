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


        .TableNormal {
    font-size: 9pt;              /* sebelumnya 7.5–8pt */
}

.TableNormal td {
    padding: 2.5pt;
}

.input-field {
    font-size: 8.5pt !important; /* sebelumnya 7.5pt */
    height: 16pt !important;     /* sebelumnya 100% */
}

.TableParagraph span {
    font-size: 9pt;
}

    </style>
</head>
<body>
    <div class="container my-4">
        <!-- resources/views/formhtml/torque_wrench.blade.php -->
        <form method="POST" action="/calibrations" id="kalibrasiForm">
        @csrf
        <input type="hidden" name="form_type" value="torque_wrench">
            <div class="form-kalibrasi-container">
                <table class="kalibrasi-header-table">
                    <tr>
                        <td colspan="2">
                            <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK13</p>
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
                            <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">TORQUE WRENCH - DRIVER</p>
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
                                    value="Torque Wrench"
                                    placeholder="Torque Wrench"
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
                
                <table cellspacing="0" cellpadding="0" class="TableNormal" style="margin-left:0.6pt; border:1pt solid #000000; -aw-border-insideh:1pt single #000000; -aw-border-insidev:1pt single #000000; border-collapse:collapse; width: 100%; max-width: 1500px;">
                <tr style="height:9pt">
                    <td rowspan="2" style="width:90pt; border:solid 1pt; border-left-style:solid; vertical-align:middle; text-align:center">
                        <p class="TableParagraph" style="margin:0; font-size:10pt; line-height:1.1">
                        <span style="font-family:Arial; font-weight:bold">Nominal Setting alat</span>
                        </p>
                    </td>
                    <td colspan="6" style="width:380pt; border:solid 1pt; border-right-style:solid; vertical-align:middle; text-align:center">
                        <p class="TableParagraph" style="margin:0; font-size:10pt; line-height:1.1">
                        <span style="font-family:Arial; font-weight:bold">Penunjukan Standard</span>
                        </p>
                    </td>
                    </tr>
                    <tr style="height:13pt"> <!-- sedikit ditambah agar tidak terlalu sempit setelah dirapatkan -->
                    <td colspan="3" style="width:190pt; border:solid 1pt; vertical-align:middle; text-align:center">
                        <p class="TableParagraph" style="margin:0; font-size:10pt; line-height:1.15">
                        <span style="font-family:Arial; font-weight:bold">Clockwise</span>
                        <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.5pt"> (</span>
                        <span style="font-family:'Lucida Console'; font-size:7.5pt; letter-spacing:0.5em;">
                        <input type="text"
                            name="isi_titik"
                            value=""
                            style="
                                    width:120px;
                                    border:none;
                                    outline:none;
                                    background:transparent;
                                    font-family:'Lucida Console';
                                    font-size:7.5pt;
                                    letter-spacing:0.5em;
                                    text-align:center;
                            ">
                    </span>

                        <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.5pt">)</span>
                        </p>
                    </td>
                    <td colspan="3" style="width:190pt; border:solid 1pt; vertical-align:middle; text-align:center">
                        <p class="TableParagraph" style="margin:0; font-size:10pt; line-height:1.15">
                        <span style="font-family:Arial; font-weight:bold">Counter Clockwise</span>
                        <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.5pt"> (</span>
                       <span style="font-family:'Lucida Console'; font-size:7.5pt; letter-spacing:0.5em;">
                    <input type="text"
                        name="isi_titik"
                        value=""
                        style="
                                width:120px;
                                border:none;
                                outline:none;
                                background:transparent;
                                font-family:'Lucida Console';
                                font-size:7.5pt;
                                letter-spacing:0.5em;
                                text-align:center;
                        ">
                </span>

                        <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.5pt">)</span>
                        </p>
                    </td>
                                </tr>
                        <tr style="height:12pt">
                        <td style="width:90pt; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:top; text-align:center">
                            <p class="TableParagraph" style="margin-top:0.8pt; margin-left:8pt; font-size:8pt">
                            <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.1pt;">
                    (
                    <input type="text"
                        name="nama_ttd"
                        value=""
                        style="
                                border:none;
                                border-bottom:1px dotted #000;
                                outline:none;
                                background:transparent;
                                width:120px;
                                font-family:Arial;
                                font-weight:bold;
                                letter-spacing:-0.1pt;
                                text-align:center;
                        ">
                    )
                </span>

            </p>
          </td>
          <td style="width:45pt; border-style:solid; border-width:1pt; vertical-align:top">
            <p class="TableParagraph" style="margin-top:1.2pt; margin-left:1.2pt; text-align:center; font-size:8pt">
              <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.5pt">1</span>
            </p>
          </td>
          <td style="width:45pt; border-style:solid; border-width:1pt; vertical-align:top">
            <p class="TableParagraph" style="margin-top:1.2pt; margin-left:1.2pt; text-align:center; font-size:8pt">
              <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.5pt">2</span>
            </p>
          </td>
          <td style="width:45pt; border-style:solid; border-width:1pt; vertical-align:top">
            <p class="TableParagraph" style="margin-top:1.2pt; margin-right:0.1pt; margin-left:1.2pt; text-align:center; font-size:8pt">
              <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.5pt">3</span>
            </p>
          </td>
          <td style="width:45pt; border-style:solid; border-width:1pt; vertical-align:top">
            <p class="TableParagraph" style="margin-top:1.2pt; margin-left:1pt; text-align:center; font-size:8pt">
              <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.5pt">1</span>
            </p>
          </td>
          <td style="width:45pt; border-style:solid; border-width:1pt; vertical-align:top">
            <p class="TableParagraph" style="margin-top:1.2pt; margin-left:1pt; text-align:center; font-size:8pt">
              <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.5pt">2</span>
            </p>
          </td>
          <td style="width:45pt; border-top-style:solid; border-top-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:top">
            <p class="TableParagraph" style="margin-top:1.2pt; margin-right:0.1pt; margin-left:1pt; text-align:center; font-size:8pt">
              <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.5pt">3</span>
            </p>
          </td>
        </tr>
        
        <!-- Baris 1-12 dengan input field -->
        <?php for($i = 1; $i <= 9; $i++): ?>
        <tr style="height:14pt">
          <td style="width:90pt; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:top; text-align:center;">
            <input type="number" step="any" class="input-field" style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;" id="row<?php echo $i; ?>_col0"   name="row<?php echo $i; ?>_col0" placeholder="&#xa0;">
          </td>
          <td style="width:45pt; border-style:solid; border-width:1pt; vertical-align:top">
            <input type="number" step="any" class="input-field" style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;" id="row<?php echo $i; ?>_col1"   name="row<?php echo $i; ?>_col1"placeholder="&#xa0;">
          </td>
          <td style="width:45pt; border-style:solid; border-width:1pt; vertical-align:top">
            <input type="number" step="any" class="input-field" style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;" id="row<?php echo $i; ?>_col2"   name="row<?php echo $i; ?>_col2"placeholder="&#xa0;">
          </td>
          <td style="width:45pt; border-style:solid; border-width:1pt; vertical-align:top">
            <input type="number" step="any" class="input-field" style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;" id="row<?php echo $i; ?>_col3"   name="row<?php echo $i; ?>_col3"placeholder="&#xa0;">
          </td>
          <td style="width:45pt; border-style:solid; border-width:1pt; vertical-align:top">
            <input type="number" step="any" class="input-field" style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;" id="row<?php echo $i; ?>_col4"   name="row<?php echo $i; ?>_col4" placeholder="&#xa0;">
          </td>
          <td style="width:45pt; border-style:solid; border-width:1pt; vertical-align:top">
            <input type="number" step="any" class="input-field" style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;" id="row<?php echo $i; ?>_col5"    name="row<?php echo $i; ?>_col5" placeholder="&#xa0;">
          </td>
          <td style="width:45pt; border-top-style:solid; border-top-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:top">
            <input type="number" step="any" class="input-field" style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;" id="row<?php echo $i; ?>_col6"  name="row<?php echo $i; ?>_col6" placeholder="&#xa0;">
          </td>
        </tr>
        <?php endfor; ?>
        
        <!-- Baris terakhir tanpa border bawah -->
        <tr style="height:14pt">
          <td style="width:90pt; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:top; text-align:center;">
            <input type="number" step="any" class="input-field" style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;" id="row<?php echo $i; ?>_col0"   name="row<?php echo $i; ?>_col0" placeholder="&#xa0;">
          </td>
          <td style="width:45pt; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:top">
            <input type="number" step="any" class="input-field" style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;" id="row13_col1"   name="row13_col1" placeholder="&#xa0;">
          </td>
          <td style="width:45pt; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:top">
            <input type="number" step="any" class="input-field" style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;" id="row13_col2"  name="row13_col2"  placeholder="&#xa0;">
          </td>
          <td style="width:45pt; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:top">
            <input type="number" step="any" class="input-field" style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;" id="row13_col3"    name="row13_col3" placeholder="&#xa0;">
          </td>
          <td style="width:45pt; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:top">
            <input type="number" step="any" class="input-field" style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;" id="row13_col4"   name="row13_col4" placeholder="&#xa0;">
          </td>
          <td style="width:45pt; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:top">
            <input type="number" step="any" class="input-field" style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;" id="row13_col5"   name="row13_col5" placeholder="&#xa0;">
          </td>
          <td style="width:45pt; border-top-style:solid; border-top-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:top">
            <input type="number" step="any" class="input-field" style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;" id="row13_col6"   name="row13_col6" placeholder="&#xa0;">
          </td>
        </tr>
      </table>

    
      <!-- Repeatability Clockwise -->
<p class="BodyText" style="margin-top:2pt; margin-left:2pt">
  <span style="letter-spacing:-0.1pt; font-size:9.5pt;">Repeatability Clockwise</span>
</p>

<table cellspacing="0" cellpadding="0" class="TableNormal" style="margin-left:0.6pt; border:1pt solid #000000; -aw-border-insideh:1pt single #000000; -aw-border-insidev:1pt single #000000; border-collapse:collapse; width: 100%; max-width: 450px;">
  <tr style="height:14pt">
   
    <td style="width:45pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:top">
      <input type="number" step="any" class="input-field" style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;" 
             id="repeat_cw_1" name="repeat_cw_1" placeholder="&#xa0;">
    </td>
    <td style="width:45pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:top">
      <input type="number" step="any" class="input-field" style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;" 
             id="repeat_cw_2" name="repeat_cw_2" placeholder="&#xa0;">
    </td>
    <td style="width:45pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:top">
      <input type="number" step="any" class="input-field" style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;" 
             id="repeat_cw_3" name="repeat_cw_3" placeholder="&#xa0;">
    </td>
    <td style="width:45pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:top">
      <input type="number" step="any" class="input-field" style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;" 
             id="repeat_cw_4" name="repeat_cw_4" placeholder="&#xa0;">
    </td>
    <td style="width:45pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:top">
      <input type="number" step="any" class="input-field" style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;" 
             id="repeat_cw_5" name="repeat_cw_5" placeholder="&#xa0;">
    </td>
  </tr>
  <tr style="height:14pt">
    
    <td style="width:45pt; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:top">
      <input type="number" step="any" class="input-field" style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;" 
             id="repeat_cw_6" name="repeat_cw_6" placeholder="&#xa0;">
    </td>
    <td style="width:45pt; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:top">
      <input type="number" step="any" class="input-field" style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;" 
             id="repeat_cw_7" name="repeat_cw_7" placeholder="&#xa0;">
    </td>
    <td style="width:45pt; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:top">
      <input type="number" step="any" class="input-field" style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;" 
             id="repeat_cw_8" name="repeat_cw_8" placeholder="&#xa0;">
    </td>
    <td style="width:45pt; border-top-style:solid; border-top-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:top">
      <input type="number" step="any" class="input-field" style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;" 
             id="repeat_cw_9" name="repeat_cw_9" placeholder="&#xa0;">
    </td>
    <td style="width:45pt; border-top-style:solid; border-top-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:top">
      <input type="number" step="any" class="input-field" style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;" 
             id="repeat_cw_10" name="repeat_cw_10" placeholder="&#xa0;">
    </td>
  </tr>
</table>

<!-- Repeatability Counter Clockwise -->
<p class="BodyText" style="margin-top:5pt; margin-left:2pt">
  <span style="font-size:9.5pt;">Repeatability Counter Clockwise</span>
</p>
<table cellspacing="0" cellpadding="0" class="TableNormal" style="margin-left:0.6pt; border:1pt solid #000000; -aw-border-insideh:1pt single #000000; -aw-border-insidev:1pt single #000000; border-collapse:collapse; width: 100%; max-width: 450px;">
  <tr style="height:14pt">
   
    <td style="width:45pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:top">
      <input type="number" step="any" class="input-field" style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;" 
             id="repeat_ccw_1" name="repeat_ccw_1" placeholder="&#xa0;">
    </td>
    <td style="width:45pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:top">
      <input type="number" step="any" class="input-field" style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;" 
             id="repeat_ccw_2" name="repeat_ccw_2" placeholder="&#xa0;">
    </td>
    <td style="width:45pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:top">
      <input type="number" step="any" class="input-field" style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;" 
             id="repeat_ccw_3" name="repeat_ccw_3" placeholder="&#xa0;">
    </td>
    <td style="width:45pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:top">
      <input type="number" step="any" class="input-field" style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;" 
             id="repeat_ccw_4" name="repeat_ccw_4" placeholder="&#xa0;">
    </td>
    <td style="width:45pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:top">
      <input type="number" step="any" class="input-field" style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;" 
             id="repeat_ccw_5" name="repeat_ccw_5" placeholder="&#xa0;">
    </td>
  </tr>
  <tr style="height:14pt">
   
    <td style="width:45pt; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:top">
      <input type="number" step="any" class="input-field" style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;" 
             id="repeat_ccw_6" name="repeat_ccw_6" placeholder="&#xa0;">
    </td>
    <td style="width:45pt; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:top">
      <input type="number" step="any" class="input-field" style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;" 
             id="repeat_ccw_7" name="repeat_ccw_7" placeholder="&#xa0;">
    </td>
    <td style="width:45pt; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:top">
      <input type="number" step="any" class="input-field" style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;" 
             id="repeat_ccw_8" name="repeat_ccw_8" placeholder="&#xa0;">
    </td>
    <td style="width:45pt; border-top-style:solid; border-top-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:top">
      <input type="number" step="any" class="input-field" style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;" 
             id="repeat_ccw_9" name="repeat_ccw_9" placeholder="&#xa0;">
    </td>
    <td style="width:45pt; border-top-style:solid; border-top-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:top">
      <input type="number" step="any" class="input-field" style="width:100%; height:100%; box-sizing:border-box; border:none; padding:1px; font-size:7.5pt; text-align:center;" 
             id="repeat_ccw_10" name="repeat_ccw_10" placeholder="&#xa0;">
    </td>
  </tr>
</table>

                <div style="height: 50px;"></div>


              <!-- Footer Section -->
              <table class="kalibrasi-main-table" style="width: 100%; border-collapse: collapse;">
    <!-- HEADER FOOTER -->
    <tr>
        <td colspan="6" style="text-align: center; border: 1px solid #000; border-bottom: none; padding: 10px 0;">
            <span style="font-weight: bold; font-size: 18px; color: #000000;">Isilah lembar data kalibrasi dengan lengkap dan jelas!</span>
        </td>
    </tr>

    <!-- ALAT STANDAR + CHECKBOX -->
    <tr style="height: 40px;">
        <td rowspan="3" style="width: 20%; border: 1px solid #000; vertical-align: middle; text-align: center; font-weight: bold; font-size: 10pt; color: #000000; background-color: #f8f9fa;">
            Alat<br>Standar
        </td>

        <!-- Alat 1 -->
        <td style="width: 5%; border: 1px solid #000; text-align: center; vertical-align: middle;">
            <input type="checkbox" name="alat_standar[]" value="Digital torque tester 10 N.m" id="alat1" 
                style="transform: scale(1.2); cursor: pointer;">
        </td>
        <td colspan="2" style="border: 1px solid #000; padding-left: 12px; font-size: 9pt; vertical-align: middle; color: #000000;">
            <label for="alat1" style="cursor: pointer; color: #000000; display: block; padding: 5px 0;">
                Digital torque tester 10 N.m
            </label>
        </td>

        <!-- Dikalibrasi oleh -->
        <td rowspan="3" style="width: 20%; border: 1px solid #000; text-align: center; vertical-align: top; font-size: 9pt; color: #000000; background-color: #f8f9fa; padding-top: 15px;">
            <strong>Dikalibrasi<br>oleh</strong>
        </td>
        <!-- Diperiksa oleh -->
        <td rowspan="3" style="width: 20%; border: 1px solid #000; text-align: center; vertical-align: top; font-size: 9pt; color: #000000; background-color: #f8f9fa; padding-top: 15px;">
            <strong>Diperiksa<br>oleh</strong>
        </td>
    </tr>

    <!-- Alat 2 -->
    <tr style="height: 40px;">
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle;">
            <input type="checkbox" name="alat_standar[]" value="Digital torque wrench tester 100 N.m" id="alat2" 
                style="transform: scale(1.2); cursor: pointer;">
        </td>
        <td colspan="2" style="border: 1px solid #000; padding-left: 12px; font-size: 9pt; vertical-align: middle; color: #000000;">
            <label for="alat2" style="cursor: pointer; color: #000000; display: block; padding: 5px 0;">
                Digital torque wrench tester 100 N.m
            </label>
        </td>
    </tr>

    <!-- Alat 3 -->
    <tr style="height: 40px;">
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle;">
            <input type="checkbox" name="alat_standar[]" value="Digital torque wrench tester 1000 N.m" id="alat3" 
                style="transform: scale(1.2); cursor: pointer;">
        </td>
        <td colspan="2" style="border: 1px solid #000; padding-left: 12px; font-size: 9pt; vertical-align: middle; color: #000000;">
            <label for="alat3" style="cursor: pointer; color: #000000; display: block; padding: 5px 0;">
                Digital torque wrench tester 1000 N.m
            </label>
        </td>
    </tr>

    <!-- METODE KALIBRASI + TTD & NAMA -->
    <tr style="height: 40px;">
        <td rowspan="2" style="width: 20%; border: 1px solid #000; text-align: center; vertical-align: middle; font-size: 9pt; color: #000000; background-color: #f8f9fa; padding: 10px;">
            <strong>Metode Kalibrasi</strong>
        </td>
        <td colspan="3" rowspan="2" style="border: 1px solid #000; padding: 10px; font-size: 9pt; vertical-align: middle; color: #000000; line-height: 1.4;">
            PAS-IK1102-13 (JIS B 4652:2008)
        </td>
        
        <!-- Input Nama Dikalibrasi Oleh -->
        <td style="width: 20%; border: 1px solid #000; padding: 5px; font-size: 9pt; vertical-align: middle; color: #000000;">
            <input type="text" 
                name="calibrated_by" 
                class="kalibrasi-input" 
                placeholder="Nama Lengkap" 
                style="width: 100%; border: none; outline: none; padding: 5px; font-size: 9pt; background: transparent;"
                required>
        </td>
        
        <!-- Input Nama Diperiksa Oleh -->
        <td style="width: 20%; border: 1px solid #000; padding: 5px; font-size: 9pt; vertical-align: middle; color: #000000;">
            <input type="text" 
                name="verified_by" 
                class="kalibrasi-input" 
                placeholder="Nama Lengkap" 
                style="width: 100%; border: none; outline: none; padding: 5px; font-size: 9pt; background: transparent;"
                required>
        </td>
    </tr>

    <!-- TTD -->
    <tr style="height: 40px;">
        <!-- Kolom kosong untuk metode kalibrasi -->
        <td style="width: 20%; border: 1px solid #000; padding: 10px; font-size: 9pt; vertical-align: middle; color: #000000; text-align: left;">
            <strong>TTD :</strong>
        </td>
        <td style="width: 20%; border: 1px solid #000; padding: 10px; font-size: 9pt; vertical-align: middle; color: #000000; text-align: left;">
            <strong>TTD :</strong>
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
</body>
</html>