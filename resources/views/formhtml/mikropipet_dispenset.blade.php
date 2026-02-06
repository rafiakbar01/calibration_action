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
        <input type="hidden" name="form_type" value="mikropipet_dispenset">
        
            <div class="form-kalibrasi-container">
                <table class="kalibrasi-header-table">
                    <tr>
                        <td colspan="2">
                            <p style="margin: 0; font-size: 14px; color: #000000; text-align: left;">PAS-FLK39</p>
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
                            <p style="margin: 0; font-size: 14px; color: #000000;text-align: left;">LEMBAR KERJA KALIBRASI</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;text-align: left;">VOLUMETRIK: MIKROPIPET, DISPENSET</p>
                        </td>
                    </tr>
                    <tr>
                        
                    </tr>
                    <tr>
                        <td style="width: 25%;">
                            <p style="margin: 0; font-size: 14px; color: #000000;text-align: left;">No. Sertifikat</p>
                        </td>
                        <td style="width: 45%;">
                            <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;text-align: left;">PAS - </p>
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
                            <select name="nama_alat" class="kalibrasi-input"   onchange="updateFormType(this.value)" required style="background-color: #f5f5f5; color: #333; border: 1px solid #ced4da; padding: 6px 10px; border-radius: 4px; width: 100%;">
                                <option value="">-- Pilih Jenis Alat --</option>
                                <option value="Mikropipet">Mikropipet</option>
                                <option value="Dispenset">Dispenset</option>
                            </select>
                        </td>
                    </tr>

    <!-- Merek & Kode Alat -->
    <tr>
        <td style="vertical-align: middle;">
            <p style="margin: 0; color: #000000; text-align: left; padding-left: 5px;">Merek</p>
        </td>
        <td colspan="3" style="vertical-align: middle;">
            <div class="d-flex align-items-center gap-3">
                <input type="text" name="merek" class="kalibrasi-input" placeholder="Masukkan merek alat" style="width: 60%;" required>
                <span style="color: #000000; min-width: 90px;">Kode Alat :</span>
                <input type="text" name="kode_alat" class="kalibrasi-input" placeholder="Masukkan kode" style="width: 30%;" required>
            </div>
        </td>
    </tr>

    <!-- Type / No. Seri -->
    <tr>
        <td style="vertical-align: middle;">
            <p style="margin: 0; color: #000000; text-align: left; padding-left: 5px;">Type / No. Seri</p>
        </td>
        <td colspan="3" style="vertical-align: middle;">
            <div class="d-flex align-items-center gap-3">
                <input type="text" name="type_alat" class="kalibrasi-input" placeholder="Masukkan Type" style="width: 45%;" required>
                <span style="color: #000000; font-size: 1.2em;">/</span>
                <input type="text" name="no_seri" class="kalibrasi-input" placeholder="Masukkan No. Seri" style="width: 45%;" required>
            </div>
        </td>
    </tr>

    <!-- Kapasitas / Resolusi -->
    <tr>
        <td style="vertical-align: middle;">
            <p style="margin: 0; color: #000000; text-align: left; padding-left: 5px;">Kapasitas / Resolusi</p>
        </td>
        <td colspan="3" style="vertical-align: middle;">
            <div class="d-flex align-items-center gap-3">
                <input type="text" name="kapasitas" class="kalibrasi-input" placeholder="Masukkan kapasitas" style="width: 45%;" required>
                <span style="color: #000000; font-size: 1.2em;">/</span>
                <input type="text" name="resolusi" class="kalibrasi-input" placeholder="Masukkan Resolusi" style="width: 45%;" required>
            </div>
        </td>
    </tr>

    <!-- Nama Pemilik -->
    <tr>
        <td style="vertical-align: middle;">
            <p style="margin: 0; color: #000000; text-align: left; padding-left: 5px;">Nama Pemilik</p>
        </td>
        <td colspan="3" style="vertical-align: middle;">
            <input type="text" name="nama_pemilik" class="kalibrasi-input" placeholder="Masukkan nama pemilik / instansi" required>
        </td>
    </tr>

    <!-- Tanggal Alat Masuk -->
    <tr>
        <td style="vertical-align: middle;">
            <p style="margin: 0; color: #000000; text-align: left; padding-left: 5px;">Tanggal Alat Masuk</p>
        </td>
        <td colspan="3" style="vertical-align: middle;">
            <input type="date" name="tanggal_alat_masuk" class="kalibrasi-input" required>
        </td>
    </tr>

    <!-- Tanggal Kalibrasi & Jenis Pembacaan -->
    <tr>
        <td style="vertical-align: middle;">
            <p style="margin: 0; color: #000000; text-align: left; padding-left: 5px;">Tanggal Kalibrasi</p>
        </td>
        <td colspan="3" style="vertical-align: middle;">
            <div class="d-flex align-items-center gap-3">
                <input type="date" name="tanggal_kalibrasi" class="kalibrasi-input" style="width: 45%;" required>
                <span style="color: #000000; min-width: 120px;">Jenis Pembacaan:</span>
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
        <td style="vertical-align: middle;">
            <p style="margin: 0; color: #000000; text-align: left; padding-left: 5px;">Tempat Kalibrasi</p>
        </td>
        <td colspan="3" style="vertical-align: middle;">
            <div class="d-flex align-items-center gap-5">
                <div class="form-check">
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

    <!-- Lokasi PT -->
    <tr>
        <td style="vertical-align: middle;">
            <p style="margin: 0; color: #000000; text-align: left; padding-left: 5px;">Lokasi PT</p>
        </td>
        <td colspan="3" style="vertical-align: middle;">
            <input type="text" name="lokasi_pt" class="kalibrasi-input" placeholder="Masukkan Lokasi PT" required>
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

       <table cellspacing="0" cellpadding="0" class="TableNormal" style="margin-left:3.12pt; -aw-border:0.75pt single #000000; -aw-border-insideh:0.75pt single #000000; -aw-border-insidev:0.75pt single #000000; border-collapse:collapse">
    <tr style="height:12pt">
        <td colspan="9" style="width:425.45pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-right:0.05pt; margin-left:1.15pt; text-align:center; line-height:10pt">
                <span style="font-family:Arial; font-size:10pt; font-weight:bold">DATA KALIBRASI</span>
            </p>
        </td>
    </tr>
    <tr style="height:15pt">
        <td rowspan="2" style="width:77.35pt; border-style:solid; border-width:0.75pt; vertical-align:middle; background-color:#d9d9d9; -aw-border:0.75pt single #000000; text-align:center">
            <div style="width:100%; text-align:center">
                <span style="font-family:Arial; font-size:8pt; font-weight:bold">Nominal Alat Ukur</span><br>
                 <p style="margin:0; font-size:6pt;"><span style="font-family:'Lucida Console'; letter-spacing:0.5em">(.......)</span></p>
            </div>
        </td>
        <td colspan="3" style="width:110.2pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:5pt; margin-left:13.55pt; font-size:8pt">
                <span style="font-family:Arial; font-weight:bold">Pembacaan Timbangan (g)</span>
            </p>
        </td>
        <td rowspan="40" style="width:43.55pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; vertical-align:top; -aw-border-bottom-style:nil; -aw-border-left:0.75pt single #000000; -aw-border-right:0.75pt single #000000; -aw-border-top:0.75pt single #000000">
            <p class="TableParagraph" style="font-size:8pt">
                <span style="font-family:'Times New Roman'; -aw-import:ignore">&#xa0;</span>
            </p>
        </td>
        <td rowspan="2" style="width:81.1pt; border-style:solid; border-width:0.75pt; vertical-align:middle; background-color:#d9d9d9; -aw-border:0.75pt single #000000; text-align:center">
            <div style="width:100%; text-align:center">
                <span style="font-family:Arial; font-size:8pt; font-weight:bold">Nominal Alat Ukur</span><br>
                <p style="margin:0; font-size:6pt;"><span style="font-family:'Lucida Console'; letter-spacing:0.5em">(.......)</span></p>
            </div>
        </td>
        <td colspan="3" style="width:110.25pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:5pt; margin-left:13.5pt; font-size:8pt">
                <span style="font-family:Arial; font-weight:bold">Pembacaan Timbangan (g)</span>
            </p>
        </td>
    </tr>
    <tr style="height:12pt">
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                <span style="font-family:Arial; font-weight:bold">m</span>
            </p>
        </td>
        <td colspan="2" style="width:77.05pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                <span style="font-family:Arial; font-weight:bold">Nilai</span>
            </p>
        </td>
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                <span style="font-family:Arial; font-weight:bold">m</span>
            </p>
        </td>
        <td colspan="2" style="width:77.1pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                <span style="font-family:Arial; font-weight:bold">Nilai</span>
            </p>
        </td>
    </tr>
    <!-- Baris m0 sampai m11 dengan input fields transparan -->
    <tr style="height:12pt">
        <td rowspan="12" style="width:77.35pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="nominal_kiri_1" style="width:90%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none" placeholder="Nominal">
        </td>
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>0</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.05pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m0_kiri" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td rowspan="12" style="width:81.1pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="nominal_kanan_1" style="width:90%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none" placeholder="Nominal">
        </td>
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>0</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.1pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m0_kanan" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
    </tr>
    <tr style="height:12pt">
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>1</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.05pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m1_kiri" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>1</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.1pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m1_kanan" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
    </tr>
    <tr style="height:12pt">
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>2</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.05pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m2_kiri" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>2</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.1pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m2_kanan" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
    </tr>
    <tr style="height:12pt">
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>3</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.05pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m3_kiri" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>3</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.1pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m3_kanan" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
    </tr>
    <tr style="height:12pt">
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>4</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.05pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m4_kiri" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>4</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.1pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m4_kanan" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
    </tr>
    <tr style="height:12pt">
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>5</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.05pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m5_kiri" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>5</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.1pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m5_kanan" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
    </tr>
    <tr style="height:12pt">
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>6</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.05pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m6_kiri" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>6</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.1pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m6_kanan" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
    </tr>
    <tr style="height:12pt">
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>7</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.05pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m7_kiri" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>7</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.1pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m7_kanan" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
    </tr>
    <tr style="height:12pt">
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>8</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.05pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m8_kiri" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>8</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.1pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m8_kanan" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
    </tr>
    <tr style="height:12pt">
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>9</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.05pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m9_kiri" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>9</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.1pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m9_kanan" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
    </tr>
    <tr style="height:12pt">
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>10</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.05pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m10_kiri" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>10</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.1pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m10_kanan" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
    </tr>
    <tr style="height:12pt">
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>11</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.05pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m11_kiri" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>11</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.1pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m11_kanan" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
    </tr>
    <!-- Parameter Pendukung -->
    <tr style="height:12pt">
        <td colspan="2" style="width:110.5pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                <span style="font-family:Arial; font-weight:bold">Parameter Pendukung</span>
            </p>
        </td>
        <td style="width:38.15pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                <span style="font-family:Arial; font-weight:bold">Awal</span>
            </p>
        </td>
        <td style="width:38.15pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                <span style="font-family:Arial; font-weight:bold">Akhir</span>
            </p>
        </td>
        <td colspan="2" style="width:114.25pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                <span style="font-family:Arial; font-weight:bold">Parameter Pendukung</span>
            </p>
        </td>
        <td style="width:38.2pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                <span style="font-family:Arial; font-weight:bold">Awal</span>
            </p>
        </td>
        <td style="width:38.15pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                <span style="font-family:Arial; font-weight:bold">Akhir</span>
            </p>
        </td>
    </tr>
    <!-- Baris Parameter -->
    <tr style="height:12pt">
        <td colspan="2" style="width:110.5pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                Suhu Udara (°C)
            </p>
        </td>
        <td style="width:38.15pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="suhu_awal_kiri" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td style="width:38.15pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="suhu_akhir_kiri" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td colspan="2" style="width:114.25pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                Suhu Udara (°C)
            </p>
        </td>
        <td style="width:38.2pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="suhu_awal_kanan" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td style="width:38.15pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="suhu_akhir_kanan" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
    </tr>
    <tr style="height:12pt">
        <td colspan="2" style="width:110.5pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                Kelembaban Udara (%rh)
            </p>
        </td>
        <td style="width:38.15pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="kelembaban_awal_kiri" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td style="width:38.15pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="kelembaban_akhir_kiri" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td colspan="2" style="width:114.25pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                Kelembaban Udara (%rh)
            </p>
        </td>
        <td style="width:38.2pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="kelembaban_awal_kanan" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td style="width:38.15pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="kelembaban_akhir_kanan" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
    </tr>
    <tr style="height:12pt">
        <td colspan="2" style="width:110.5pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                Tekanan Udara (hPa)
            </p>
        </td>
        <td style="width:38.15pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="tekanan_awal_kiri" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td style="width:38.15pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="tekanan_akhir_kiri" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td colspan="2" style="width:114.25pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                Tekanan Udara (hPa)
            </p>
        </td>
        <td style="width:38.2pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="tekanan_awal_kanan" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td style="width:38.15pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="tekanan_akhir_kanan" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
    </tr>
    <tr style="height:12pt">
        <td colspan="2" style="width:110.5pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                Suhu Air (°C)
            </p>
        </td>
        <td style="width:38.15pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="suhu_air_awal_kiri" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td style="width:38.15pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="suhu_air_akhir_kiri" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td colspan="2" style="width:114.25pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                Suhu Air (°C)
            </p>
        </td>
        <td style="width:38.2pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="suhu_air_awal_kanan" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td style="width:38.15pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="suhu_air_akhir_kanan" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
    </tr>
    <tr style="height:12pt">
        <td colspan="2" style="width:110.5pt; border-style:solid solid double; border-width:0.75pt 0.75pt 2.25pt; vertical-align:top; background-color:#d9d9d9; -aw-border-bottom:0.75pt double #000000; -aw-border-left:0.75pt single #000000; -aw-border-right:0.75pt single #000000; -aw-border-top:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                Waktu (detik)
            </p>
        </td>
        <td colspan="2" style="width:77.05pt; border-style:solid solid double; border-width:0.75pt 0.75pt 2.25pt; vertical-align:middle; -aw-border-bottom:0.75pt double #000000; -aw-border-left:0.75pt single #000000; -aw-border-right:0.75pt single #000000; -aw-border-top:0.75pt single #000000; text-align:center">
            <input type="text" name="waktu_kiri" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td colspan="2" style="width:114.25pt; border-style:solid solid double; border-width:0.75pt 0.75pt 2.25pt; vertical-align:top; background-color:#d9d9d9; -aw-border-bottom:0.75pt double #000000; -aw-border-left:0.75pt single #000000; -aw-border-right:0.75pt single #000000; -aw-border-top:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                Waktu (detik)
            </p>
        </td>
        <td colspan="2" style="width:77.1pt; border-style:solid solid double; border-width:0.75pt 0.75pt 2.25pt; vertical-align:middle; -aw-border-bottom:0.75pt double #000000; -aw-border-left:0.75pt single #000000; -aw-border-right:0.75pt single #000000; -aw-border-top:0.75pt single #000000; text-align:center">
            <input type="text" name="waktu_kanan" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
    </tr>

         <p style="margin-top:0.35pt; font-size:9pt">&nbsp;</p>
    
        <!-- BAGIAN BAWAH -->
    <tr style="height:15pt">
        <td rowspan="2" style="width:77.35pt; border-style:double solid solid; border-width:2.25pt 0.75pt 0.75pt; vertical-align:middle; background-color:#d9d9d9; -aw-border-bottom:0.75pt single #000000; -aw-border-left:0.75pt single #000000; -aw-border-right:0.75pt single #000000; -aw-border-top:0.75pt double #000000; text-align:center">
            <div style="width:100%; text-align:center">
                <span style="font-family:Arial; font-size:8pt; font-weight:bold">Nominal Alat Ukur</span><br>
                  <p style="margin:0; font-size:6pt;"><span style="font-family:'Lucida Console'; letter-spacing:0.5em">(.......)</span></p>
            </div>
        </td>
        <td colspan="3" style="width:110.2pt; border-style:double solid solid; border-width:2.25pt 0.75pt 0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border-bottom:0.75pt single #000000; -aw-border-left:0.75pt single #000000; -aw-border-right:0.75pt single #000000; -aw-border-top:0.75pt double #000000">
            <p class="TableParagraph" style="margin-top:5pt; margin-left:13.55pt; font-size:8pt">
                <span style="font-family:Arial; font-weight:bold">Pembacaan Timbangan (g)</span>
            </p>
        </td>
     
        <td rowspan="2" style="width:81.1pt; border-style:double solid solid; border-width:2.25pt 0.75pt 0.75pt; vertical-align:middle; background-color:#d9d9d9; -aw-border-bottom:0.75pt single #000000; -aw-border-left:0.75pt single #000000; -aw-border-right:0.75pt single #000000; -aw-border-top:0.75pt double #000000; text-align:center">
            <div style="width:100%; text-align:center">
                <span style="font-family:Arial; font-size:8pt; font-weight:bold">Nominal Alat Ukur</span><br>
                <p style="margin:0; font-size:6pt;"><span style="font-family:'Lucida Console'; letter-spacing:0.5em">(.......)</span></p>
            </div>
        </td>
        <td colspan="3" style="width:110.25pt; border-style:double solid solid; border-width:2.25pt 0.75pt 0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border-bottom:0.75pt single #000000; -aw-border-left:0.75pt single #000000; -aw-border-right:0.75pt single #000000; -aw-border-top:0.75pt double #000000">
            <p class="TableParagraph" style="margin-top:5pt; margin-left:13.5pt; font-size:8pt">
                <span style="font-family:Arial; font-weight:bold">Pembacaan Timbangan (g)</span>
            </p>
        </td>
    </tr>
    <tr style="height:12pt">
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                <span style="font-family:Arial; font-weight:bold">m</span>
            </p>
        </td>
        <td colspan="2" style="width:77.05pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                <span style="font-family:Arial; font-weight:bold">Nilai</span>
            </p>
        </td>
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                <span style="font-family:Arial; font-weight:bold">m</span>
            </p>
        </td>
        <td colspan="2" style="width:77.1pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                <span style="font-family:Arial; font-weight:bold">Nilai</span>
            </p>
        </td>
    </tr>
    <!-- Baris m0 sampai m11 dengan input fields transparan - BAWAH -->
    <tr style="height:12pt">
        <td rowspan="12" style="width:77.35pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="nominal_kiri_bawah_1" style="width:90%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none" placeholder="Nominal">
        </td>
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>0</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.05pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m0_kiri_bawah" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td rowspan="12" style="width:81.1pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="nominal_kanan_bawah_1" style="width:90%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none" placeholder="Nominal">
        </td>
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>0</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.1pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m0_kanan_bawah" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
    </tr>
    <tr style="height:12pt">
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>1</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.05pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m1_kiri_bawah" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>1</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.1pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m1_kanan_bawah" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
    </tr>
    <tr style="height:12pt">
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>2</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.05pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m2_kiri_bawah" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>2</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.1pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m2_kanan_bawah" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
    </tr>
    <tr style="height:12pt">
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>3</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.05pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m3_kiri_bawah" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>3</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.1pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m3_kanan_bawah" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
    </tr>
    <tr style="height:12pt">
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>4</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.05pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m4_kiri_bawah" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>4</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.1pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m4_kanan_bawah" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
    </tr>
    <tr style="height:12pt">
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>5</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.05pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m5_kiri_bawah" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>5</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.1pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m5_kanan_bawah" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
    </tr>
    <tr style="height:12pt">
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>6</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.05pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m6_kiri_bawah" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>6</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.1pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m6_kanan_bawah" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
    </tr>
    <tr style="height:12pt">
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>7</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.05pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m7_kiri_bawah" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>7</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.1pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m7_kanan_bawah" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
    </tr>
    <tr style="height:12pt">
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>8</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.05pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m8_kiri_bawah" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>8</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.1pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m8_kanan_bawah" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
    </tr>
    <tr style="height:12pt">
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>9</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.05pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m9_kiri_bawah" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>9</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.1pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m9_kanan_bawah" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
    </tr>
    <tr style="height:12pt">
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>10</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.05pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m10_kiri_bawah" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>10</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.1pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m10_kanan_bawah" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
    </tr>
    <tr style="height:12pt">
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>11</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.05pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m11_kiri_bawah" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td style="width:32.4pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                m<sub>11</sub>
            </p>
        </td>
        <td colspan="2" style="width:77.1pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="m11_kanan_bawah" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
    </tr>
    <!-- Parameter Pendukung - BAWAH -->
    <tr style="height:12pt">
        <td colspan="2" style="width:110.5pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                <span style="font-family:Arial; font-weight:bold">Parameter Pendukung</span>
            </p>
        </td>
        <td style="width:38.15pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                <span style="font-family:Arial; font-weight:bold">Awal</span>
            </p>
        </td>
        <td style="width:38.15pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                <span style="font-family:Arial; font-weight:bold">Akhir</span>
            </p>
        </td>
        <td colspan="2" style="width:114.25pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                <span style="font-family:Arial; font-weight:bold">Parameter Pendukung</span>
            </p>
        </td>
        <td style="width:38.2pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                <span style="font-family:Arial; font-weight:bold">Awal</span>
            </p>
        </td>
        <td style="width:38.15pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                <span style="font-family:Arial; font-weight:bold">Akhir</span>
            </p>
        </td>
    </tr>
    <!-- Baris Parameter - BAWAH -->
    <tr style="height:12pt">
        <td colspan="2" style="width:110.5pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                Suhu Udara (°C)
            </p>
        </td>
        <td style="width:38.15pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="suhu_awal_kiri_bawah" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td style="width:38.15pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="suhu_akhir_kiri_bawah" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td colspan="2" style="width:114.25pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                Suhu Udara (°C)
            </p>
        </td>
        <td style="width:38.2pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="suhu_awal_kanan_bawah" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td style="width:38.15pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="suhu_akhir_kanan_bawah" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
    </tr>
    <tr style="height:12pt">
        <td colspan="2" style="width:110.5pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                Kelembaban Udara (%rh)
            </p>
        </td>
        <td style="width:38.15pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="kelembaban_awal_kiri_bawah" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td style="width:38.15pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="kelembaban_akhir_kiri_bawah" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td colspan="2" style="width:114.25pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                Kelembaban Udara (%rh)
            </p>
        </td>
        <td style="width:38.2pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="kelembaban_awal_kanan_bawah" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td style="width:38.15pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="kelembaban_akhir_kanan_bawah" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
    </tr>
    <tr style="height:12pt">
        <td colspan="2" style="width:110.5pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                Tekanan Udara (hPa)
            </p>
        </td>
        <td style="width:38.15pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="tekanan_awal_kiri_bawah" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td style="width:38.15pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="tekanan_akhir_kiri_bawah" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td colspan="2" style="width:114.25pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                Tekanan Udara (hPa)
            </p>
        </td>
        <td style="width:38.2pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="tekanan_awal_kanan_bawah" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td style="width:38.15pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="tekanan_akhir_kanan_bawah" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
    </tr>
    <tr style="height:12pt">
        <td colspan="2" style="width:110.5pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                Suhu Air (°C)
            </p>
        </td>
        <td style="width:38.15pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="suhu_air_awal_kiri_bawah" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td style="width:38.15pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="suhu_air_akhir_kiri_bawah" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td colspan="2" style="width:114.25pt; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                Suhu Air (°C)
            </p>
        </td>
        <td style="width:38.2pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="suhu_air_awal_kanan_bawah" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td style="width:38.15pt; border-style:solid; border-width:0.75pt; vertical-align:middle; -aw-border:0.75pt single #000000; text-align:center">
            <input type="text" name="suhu_air_akhir_kanan_bawah" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
    </tr>
    <tr style="height:12pt">
        <td colspan="2" style="width:110.5pt; border-style:solid solid double; border-width:0.75pt 0.75pt 2.25pt; vertical-align:top; background-color:#d9d9d9; -aw-border-bottom:0.75pt double #000000; -aw-border-left:0.75pt single #000000; -aw-border-right:0.75pt single #000000; -aw-border-top:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                Waktu (detik)
            </p>
        </td>
        <td colspan="2" style="width:77.05pt; border-style:solid solid double; border-width:0.75pt 0.75pt 2.25pt; vertical-align:middle; -aw-border-bottom:0.75pt double #000000; -aw-border-left:0.75pt single #000000; -aw-border-right:0.75pt single #000000; -aw-border-top:0.75pt single #000000; text-align:center">
            <input type="text" name="waktu_kiri_bawah" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
        <td colspan="2" style="width:114.25pt; border-style:solid solid double; border-width:0.75pt 0.75pt 2.25pt; vertical-align:top; background-color:#d9d9d9; -aw-border-bottom:0.75pt double #000000; -aw-border-left:0.75pt single #000000; -aw-border-right:0.75pt single #000000; -aw-border-top:0.75pt single #000000">
            <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                Waktu (detik)
            </p>
        </td>
        <td colspan="2" style="width:77.1pt; border-style:solid solid double; border-width:0.75pt 0.75pt 2.25pt; vertical-align:middle; -aw-border-bottom:0.75pt double #000000; -aw-border-left:0.75pt single #000000; -aw-border-right:0.75pt single #000000; -aw-border-top:0.75pt single #000000; text-align:center">
            <input type="text" name="waktu_kanan_bawah" style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
        </td>
    </tr>
</table>

<p class="BodyText" style="margin-top:3.1pt; margin-left:4.45pt; margin-bottom:1.3pt">
    <span>Catatan</span>
    <span style="letter-spacing:0.15pt"></span>
    <span>:</span>
    <span style="letter-spacing:0.1pt"></span>
    <span>Pengukuran</span>
    <span style="letter-spacing:0.2pt"></span>
    <span>m</span>
    <span style="font-size:6pt; vertical-align:sub">11</span>
    <span style="letter-spacing:0.15pt"></span>
    <span>dan</span>
    <span style="letter-spacing:0.15pt"></span>
    <span>penghitungan</span>
    <span style="letter-spacing:0.2pt"></span>
    <span>waktu</span>
    <span style="letter-spacing:0.15pt"></span>
    <span>hanya</span>
    <span style="letter-spacing:0.2pt"></span>
    <span>untuk</span>
    <span style="letter-spacing:0.15pt"></span>
    <span>volume</span>
    <span style="letter-spacing:0.15pt"></span>
    <span>50</span>
    <span style="letter-spacing:0.35pt"></span>
    <span style="font-family:Calibri">μ</span>
    <span>l ke</span>
    <span style="letter-spacing:0.2pt"></span>
    <span style="letter-spacing:-0.2pt">bawah</span>
</p>

<table cellspacing="0" cellpadding="5"
    style="border-collapse:collapse; width:100%; font-family:Arial; font-size:9pt; border:1px solid #000;">

    <!-- JUDUL -->
    <tr>
        <td colspan="9" style="border:1px solid #000; text-align:center; font-weight:bold; font-size:11pt;">
            Isilah lembar data kalibrasi dengan lengkap dan jelas!
        </td>
    </tr>

    <!-- BARIS 1 -->
    <tr>
        <td rowspan="4" style="border:1px solid #000; text-align:center; font-weight:bold; width:90px;">
            Alat Standar
        </td>

        <td style="border:1px solid #000; width:200px;">Semi Microbalance, AND</td>
        <td style="border:1px solid #000;" align="center">
            <input type="checkbox" name="alat_standar[]" value="Semi Microbalance AND 0.1g"> 0.1 g
        </td>
        <td style="border:1px solid #000;" align="center">
            <input type="checkbox" name="alat_standar[]" value="Semi Microbalance AND 1g"> 1 g
        </td>
        <td style="border:1px solid #000;" align="center">
            <input type="checkbox" name="alat_standar[]" value="Semi Microbalance AND 10g"> 10 g
        </td>
        <td style="border:1px solid #000;" align="center">
            <input type="checkbox" name="alat_standar[]" value="Semi Microbalance AND 100g"> 100 g
        </td>
        <td style="border:1px solid #000;" align="center">
            <input type="checkbox" name="alat_standar[]" value="Semi Microbalance AND 200g"> 200 g
        </td>

        <!-- TANPA BORDER (SESUAI PERMINTAAN) -->
        <td style="border:none; text-align:center; font-weight:bold;">
            Dikalibrasi oleh
        </td>
        <td style="border:none; text-align:center; font-weight:bold;">
            Diperiksa oleh
        </td>
    </tr>

    <!-- BARIS 2 -->
    <tr>
        <td style="border:1px solid #000;">Semi Microbalance, Radwag</td>
        <td style="border:1px solid #000;" align="center">
            <input type="checkbox" name="alat_standar[]" value="Semi Microbalance Radwag 0.1g"> 0.1 g
        </td>
        <td style="border:1px solid #000;" align="center">
            <input type="checkbox" name="alat_standar[]" value="Semi Microbalance Radwag 1g"> 1 g
        </td>
        <td style="border:1px solid #000;" align="center">
            <input type="checkbox" name="alat_standar[]" value="Semi Microbalance Radwag 10g"> 10 g
        </td>
        <td style="border:1px solid #000;" align="center">
            <input type="checkbox" name="alat_standar[]" value="Semi Microbalance Radwag 100g"> 100 g
        </td>
        <td style="border:1px solid #000;" align="center">
            <input type="checkbox" name="alat_standar[]" value="Semi Microbalance Radwag 200g"> 200 g
        </td>
     
    </tr>

    <!-- BARIS 3 -->
    <tr>
        <td style="border:1px solid #000;">Timbangan Digital, AND</td>
        <td colspan="2" style="border:1px solid #000;" align="center">
            <input type="checkbox" name="alat_standar[]" value="Timbangan Digital AND 3kg"> 3 kg
        </td>
        <td colspan="3" style="border:1px solid #000;" align="center">
            Stopwatch<br>
            <input type="radio" name="alat_standar[]" value="Stopwatch WF002"> WF002
            &nbsp;&nbsp;
            <input type="radio" name="alat_standar[]" value="Stopwatch WT003"> WT003
        </td>
       
    </tr>

    <!-- BARIS 4 -->
    <tr>
        <td style="border:1px solid #000;">Termometer</td>
        <td colspan="2" style="border:1px solid #000;" align="center">
            <input type="radio" name="alat_standar[]" value="Termometer TES"> TES
        </td>
        <td style="border:1px solid #000;"></td>
        <td colspan="2" style="border:1px solid #000;" align="center">
            <input type="radio" name="alat_standar[]" value="Termometer TFA"> TFA
        </td>
    
    </tr>

    <!-- BARIS TERAKHIR -->
    <tr>
        <td style="border:1px solid #000; font-weight:bold; text-align:center;">
            Metode Kalibrasi
        </td>

        <td colspan="6" style="border:1px solid #000; padding-left:10px;">
            PAS-IK102-39 (Volumetrik Piston)
        </td>

        <td style="border:1px solid #000; text-align:center;">
            TTD :<br><br>
            Nama :<br>
            <input type="text" name="calibrated_by"style="width:90%; border:none; border-bottom:1px solid #000;">
        </td>

        <td style="border:1px solid #000; text-align:center;">
            TTD :<br><br>
            Nama :<br>
            <input type="text" name="verified_by" style="width:90%; border:none; border-bottom:1px solid #000;">
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

<script>
    function updateFormType(selectedAlat) {
        // Normalize input (case-insensitive)
        const alat = selectedAlat.toLowerCase().trim();
        
        // SEMUA alat menggunakan form_type 'enclosure'
        const formTypeMap = {
            'Mikropipet': 'mikropipet_dispenset',
            'Dispenset': 'mikropipet_dispenset'
           
        };
        
        // Update hidden input
        const formTypeInput = document.getElementById('form_type_input');
        if (formTypeMap[alat]) {
            formTypeInput.value = formTypeMap[alat];
            console.log('✅ Form type set to: enclosure for alat:', selectedAlat);
        } else {
            formTypeInput.value = '';
            console.warn('⚠️ No form type mapping for:', selectedAlat);
        }
    }
</script>

</body>

</html>