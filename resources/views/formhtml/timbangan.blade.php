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
        <!-- resources/views/formhtml/thermometer.blade.php -->
        <form method="POST" action="/calibrations" id="kalibrasiForm">
        @csrf
        <input type="hidden" name="timbanganType" value="standar">
        <input type="hidden" name="form_type" value="timbangan">
            <div class="form-kalibrasi-container">
                <table class="kalibrasi-header-table">
                    <tr>
                        <td colspan="2">
                            <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK15</p>
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
                            <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">TIMBANGAN</p>
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
                                    value="Timbangan"
                                    placeholder="Timbangan"
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
                                    <input class="form-check-input" type="radio" name="tempat_kalibrasi" value="lab.PT PAS" id="lab" required>
                                    <label class="form-check-label" for="lab" style="color: #000000;">Lab. PT.PAS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tempat_kalibrasi" value="Insitu" id="insitu" required>
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
                <div class="setting-suhu-container" style="margin-bottom: 30px;">

                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr valign="top">
                        <!-- Blok Kiri: Setengah Kap. Max -->
                        <td width="33%" valign="top" style="padding-right: 20px;">
                        <b>Pemeriksaan Nilai Repeatability</b>
                        <br><br>
Setengah Kap. Max =
<input type="text"
       name="setengah_kapasitas"
       style="border:0; border-bottom:1px dotted #000; width:200px; background:transparent;">
<br><br>


                        <table style="border-collapse: collapse; width: 100%;">
                            <tr style="background: #cccccc;">
                            <td style="border:2px solid #000; padding:8px; text-align:center; width:50%;">
                                <b>Penunjukan z1</b>
                            </td>
                            <td style="border:2px solid #000; padding:8px; text-align:center; width:50%;">
                                <b>Penunjukan m1</b>
                            </td>
                            </tr>
                            <tr>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="setengah_z1_1" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="setengah_m1_1" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            </tr>
                            <tr>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="setengah_z1_2" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="setengah_m1_2" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            </tr>
                            <tr>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="setengah_z1_3" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="setengah_m1_3" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            </tr>
                            <tr>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="setengah_z1_4" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="setengah_m1_4" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            </tr>
                            <tr>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="setengah_z1_5" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="setengah_m1_5" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            </tr>
                            <tr>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="setengah_z1_6" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="setengah_m1_6" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            </tr>
                            <tr>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="setengah_z1_7" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="setengah_m1_7" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            </tr>
                            <tr>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="setengah_z1_8" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="setengah_m1_8" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            </tr>
                            <tr>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="setengah_z1_9" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="setengah_m1_9" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            </tr>
                            <tr>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="setengah_z1_10" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="setengah_m1_10" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            </tr>
                        </table>
                        </td>

                        <!-- Blok Tengah: Kapasitas Max -->
                        <td width="33%" valign="top" style="padding-right: 20px;">
                        <b>Pemeriksaan Nilai Repeatability</b><br><br>
Kapasitas Max =
<input type="text"
       name="kapasitas_max"
       style="border:0; border-bottom:1px dotted #000; width:200px; background:transparent;">
<br><br>


                        <table style="border-collapse: collapse; width: 100%;">
                            <tr style="background: #cccccc;">
                            <td style="border:2px solid #000; padding:8px; text-align:center; width:50%;">
                                <b>Penunjukan z1</b>
                            </td>
                            <td style="border:2px solid #000; padding:8px; text-align:center; width:50%;">
                                <b>Penunjukan m1</b>
                            </td>
                            </tr>
                            <tr>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="kapasitas_z1_1" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="kapasitas_m1_1" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            </tr>
                            <tr>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="kapasitas_z1_2" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="kapasitas_m1_2" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            </tr>
                            <tr>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="kapasitas_z1_3" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="kapasitas_m1_3" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            </tr>
                            <tr>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="kapasitas_z1_4" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="kapasitas_m1_4" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            </tr>
                            <tr>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="kapasitas_z1_5" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="kapasitas_m1_5" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            </tr>
                            <tr>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="kapasitas_z1_6" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="kapasitas_m1_6" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            </tr>
                            <tr>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="kapasitas_z1_7" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="kapasitas_m1_7" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            </tr>
                            <tr>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="kapasitas_z1_8" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="kapasitas_m1_8" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            </tr>
                            <tr>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="kapasitas_z1_9" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="kapasitas_m1_9" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            </tr>
                            <tr>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="kapasitas_z1_10" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" name="kapasitas_m1_10" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                            </td>
                            </tr>
                        </table>
                        </td>

                        <!-- Blok Kanan: CATATAN PENTING -->
                        <td width="34%" valign="top">
                        <table style="border-collapse: collapse; width: 100%;">
                            <tr>
                            <td style="border:2px solid #000; background: #ffffff; text-align:center; padding:15px;">
                                <b style="font-size: 18px;">CATATAN PENTING</b>
                            </td>
                            </tr>
                            <tr>
                            <td style="border:2px solid #000; background: #ffffff; padding:0; height: 500px;">
                                <textarea name="catatan_penting" style="width:100%; height:100%; border:none; background:transparent; padding:15px; resize:none; box-sizing:border-box;"></textarea>
                            </td>
                            </tr>
                        </table>
                        </td>
                    </tr>
                    </table>
                        <!-- Jarak dan Footer Section -->
                        <div style="margin-top: 40px; margin-bottom: 20px;"></div>

                <p style="margin-top:4.6pt; margin-left:12.2pt; margin-bottom:0.65pt">Pemeriksaan Nilai Nominal</p>
                <table style="border-collapse: collapse; width: 100%; margin-left:10.92pt; border:2px solid #000000;">
                <tr>
                    <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold;">
                    Skala Nominal
                    </td>
                    <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold;">
                    z1
                    </td>
                    <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold;">
                    m1
                    </td>
                    <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold;">
                    m1
                    </td>
                    <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold;">
                    z1
                    </td>
                    <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold;">
                    Standar Anak Timbang yang Digunakan
                    </td>
                </tr>
                
                <?php for($i = 1; $i <= 10; $i++): ?>
                <tr>
                    <td style="border:2px solid #000; padding:0;">
                    <input type="number" step="any" name="skala_nominal_<?php echo $i; ?>" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                    </td>
                    <td style="border:2px solid #000; padding:0;">
                    <input type="number" step="any" name="z1_1_<?php echo $i; ?>" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                    </td>
                    <td style="border:2px solid #000; padding:0;">
                    <input type="number" step="any" name="m1_1_<?php echo $i; ?>" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                    </td>
                    <td style="border:2px solid #000; padding:0;">
                    <input type="number" step="any" name="m1_2_<?php echo $i; ?>" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                    </td>
                    <td style="border:2px solid #000; padding:0;">
                    <input type="number" step="any" name="z1_2_<?php echo $i; ?>" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                    </td>
                    <td style="border:2px solid #000; padding:0;">
                    <input type="number" step="any" name="standar_<?php echo $i; ?>" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                    </td>
                </tr>
                <?php endfor; ?>
                </table>

         <div style="margin-top: 40px; margin-bottom: 20px;"></div>

            <p style="margin-left:12.2pt; font-size:12pt; font-weight:bold; font-style:italic;">Off-Center Loading Test</p>
                <table border="0" cellpadding="0" cellspacing="0" style="margin-left:12.2pt; margin-bottom:1.75pt">
                <tr>
                    <td>
                    Beban Timbangan 1/3 atau 1/2 dari Kapasitas Maksimal = 
                    </td>
                    <td>
                    <input type="text" name="beban_timbangan" style="width:120px; border:1px solid #000; text-align:center; padding:2px;">
                    </td>
                    <td>
                    &nbsp;&nbsp;Diutamakan anak timbangan tunggal jika memadai.
                    </td>
                </tr>
                </table>

                <!-- Tabel Off-Center Loading Test -->
                <table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 100%; margin-left:10.92pt; border:2px solid #000000;">
                <tr>
                    <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold;">
                    Posisi
                    </td>
                    <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold;">
                    Tengah
                    </td>
                    <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold;">
                    Depan
                    </td>
                    <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold;">
                    Belakang
                    </td>
                    <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold;">
                    Kanan
                    </td>
                    <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold;">
                    Kiri
                    </td>
                </tr>
                <tr>
                    <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold;">
                    Beban
                    </td>
                    <td style="border:2px solid #000; padding:0;">
                    <input type="text" name="beban_tengah" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                    </td>
                    <td style="border:2px solid #000; padding:0;">
                    <input type="text" name="beban_depan" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                    </td>
                    <td style="border:2px solid #000; padding:0;">
                    <input type="text" name="beban_belakang" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                    </td>
                    <td style="border:2px solid #000; padding:0;">
                    <input type="text" name="beban_kanan" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                    </td>
                    <td style="border:2px solid #000; padding:0;">
                    <input type="text" name="beban_kiri" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                    </td>
                </tr>
                </table>

                <p style="margin-top:0.35pt; font-size:9pt">&nbsp;</p>

               

                      <p style="margin-top:0.35pt; font-size:9pt">&nbsp;</p>
                        <table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 100%; margin-left:10.92pt; border:2px solid #000000;">
                        <tr>
                            <td colspan="5" style="border:2px solid #000; padding:12px; text-align:center; background-color:#f0f0f0;">
                            <font style="font-weight:bold; font-size:10pt;">Isilah lembar data kalibrasi dengan lengkap dan jelas!</font>
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="1" style="border:2px solid #000; padding:8px; background-color:#f0f0f0; vertical-align:middle;">
                            <font style="font-weight:bold;">Peralatan Standard</font>
                            </td>
                            <td style="border:2px solid #000; padding:8px;">
                            <font>Anak Timbangan <i>class</i> :</font>
                            </td>
                            <td style="border:2px solid #000; padding:8px;">
                            <table border="0" cellpadding="0" cellspacing="5">
                            <tr>
                                <td style="padding:0 5px;">
                                    <input type="checkbox" name="alat_standar[]" value="E2" id="class_E2"> 
                                    <label for="class_E2">E2</label>
                                </td>
                                <td>/</td>
                                <td style="padding:0 5px;">
                                    <input type="checkbox" name="alat_standar[]" value="F1" id="class_F1"> 
                                    <label for="class_F1">F1</label>
                                </td>
                                <td>/</td>
                                <td style="padding:0 5px;">
                                    <input type="checkbox" name="alat_standar[]" value="F2" id="class_F2"> 
                                    <label for="class_F2">F2</label>
                                </td>
                                <td>/</td>
                                <td style="padding:0 5px;">
                                    <input type="checkbox" name="alat_standar[]" value="M1" id="class_M1"> 
                                    <label for="class_M1">M1</label>
                                </td>
                                <td>/</td>
                                <td style="padding:0 5px;">
                                    <input type="checkbox" name="alat_standar[]" value="M2" id="class_M2"> 
                                    <label for="class_M2">M2</label>
                                </td>
                                <td>/</td>
                                <td style="padding:0 5px;">
                                    <input type="checkbox" name="alat_standar[]" value="M3" id="class_M3"> 
                                    <label for="class_M3">M3</label>
                                </td>
                            </tr>
                        </table>
                            <font size="1"><i>(centang pilihan)</i></font>
                            </td>
                            <td style="border:2px solid #000; padding:8px; text-align:center;">
                            <font style="font-weight:bold;">Dikalibrasi oleh</font><br><br>
                            <table border="1" cellpadding="0" cellspacing="0" style="width:100%; height:50px; border:1px solid #000; background-color:#fff;">
                                <tr>
                                <td style="text-align:center; vertical-align:bottom; padding:10px;">
                                    <font>TTD</font><br>
                                    <table border="0" cellpadding="0" cellspacing="0" style="width:100%; margin-top:5px;">
                                    <tr>
                                        <td style="border-bottom:1px solid #000; padding:3px; text-align:center;">
                                        <font size="2">(...........................................)</font>
                                        </td>
                                    </tr>
                                    </table>
                                </td>
                                </tr>
                            </table>
                            <table border="1" cellpadding="0" cellspacing="0" style="width:100%; height:30px; border:1px solid #000; background-color:#fff; margin-top:5px;">
                                <tr>
                                <td style="padding:5px;">
                                    <input type="text" name="calibrated_by" style="width:100%; height:100%; border:none; text-align:center;" placeholder="Nama">
                                </td>
                                </tr>
                            </table>
                            <font>Nama</font>
                            </td>
                            <td style="border:2px solid #000; padding:8px; text-align:center;">
                            <font style="font-weight:bold;">Diperiksa oleh</font><br><br>
                            <table border="1" cellpadding="0" cellspacing="0" style="width:100%; height:50px; border:1px solid #000; background-color:#fff;">
                                <tr>
                                <td style="text-align:center; vertical-align:bottom; padding:10px;">
                                    <font>TTD</font><br>
                                    <table border="0" cellpadding="0" cellspacing="0" style="width:100%; margin-top:5px;">
                                    <tr>
                                        <td style="border-bottom:1px solid #000; padding:3px; text-align:center;">
                                        <font size="2">(...........................................)</font>
                                        </td>
                                    </tr>
                                    </table>
                                </td>
                                </tr>
                            </table>
                            <table border="1" cellpadding="0" cellspacing="0" style="width:100%; height:30px; border:1px solid #000; background-color:#fff; margin-top:5px;">
                                <tr>
                                <td style="padding:5px;">
                                    <input type="text" name="verified_by" style="width:100%; height:100%; border:none; text-align:center;" placeholder="Nama">
                                </td>
                                </tr>
                            </table>
                            <font>Nama</font>
                            </td>
                        </tr>
                        <tr>
                            <td style="border:2px solid #000; padding:8px; background-color:#f0f0f0; vertical-align:middle;">
                            <font style="font-weight:bold;">Metode Kalibrasi</font>
                            </td>
                            <td colspan="4" style="border:2px solid #000; padding:8px;">
                            <font>PAS-IK1102-15 (Monograph 4 : The Calibration of Weights and Balances, NMI Australia 2010)</font>
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