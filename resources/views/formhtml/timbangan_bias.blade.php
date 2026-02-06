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
        <!-- <input type="hidden" name="timbanganType" value="standar"> -->
        <input type="hidden" name="form_type" value="timbangan_bias">
            <div class="form-kalibrasi-container">
                <table class="kalibrasi-header-table">
                    <tr>
                        <td colspan="2">
                            <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK15B</p>
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
                            <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">TIMBANGAN MASSA BIAS</p>
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
                                    value="Timbangan Bias"
                                    placeholder="Timbangan Bias"
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

              

         <div style="width:100%; margin:20px 0;">
  <table cellspacing="0" cellpadding="0" style="width:100%; border-collapse:collapse; border:0.75pt solid #000000; font-family:Arial, sans-serif; font-size:8pt;">
    <tr style="height:18pt">
      <td colspan="6" style="border:0.75pt solid #000000; background-color:#d9d9d9; text-align:center; vertical-align:middle;">
        <span style="font-weight:bold;">Data Hasil Kalibrasi</span>
      </td>
    </tr>
    <tr style="height:18pt">
      <td colspan="4" style="border:0.75pt solid #000000; text-align:center; vertical-align:middle;">
        <span style="font-weight:bold;">Repeatability</span>
      </td>
    <td colspan="2" rowspan="2" style="border:0.75pt solid #000000; text-align:center; vertical-align:middle;">
      <span style="font-weight:bold;">Effect of off-centre loading</span><br>
      <span style="font-weight:bold;">
          Beban Massa : 
          <input type="text" name="beban_massa" 
                style="width:80px; border:1px solid #000; text-align:center; font-weight:normal;"
                placeholder="...">
      </span>
  </td>
    </tr>
    <tr style="height:18pt">
      <td colspan="2" style="border:0.75pt solid #000000; text-align:center; vertical-align:middle;">
       <span style="font-weight:bold;">
    Beban 1/2 Kapasitas Maksimal
    <input type="number" step="any"
           name="beban_setengah_kapasitas"
           style="border:0; border-bottom:1px dotted #000; width:120px; background:transparent; text-align:center;">
    kg
</span>

      </td>
      <td colspan="2" style="border:0.75pt solid #000000; text-align:center; vertical-align:middle;">
        <span style="font-weight:bold;">
    Beban Kapasitas Maksimal
    <input type="number" step="any"
           name="beban_kapasitas_maks"
           style="border:0; border-bottom:1px dotted #000; width:120px; background:transparent; text-align:center;">
    kg
</span>

      </td>
    </tr>
    <tr style="height:20pt">
      <td colspan="2" style="border:0.75pt solid #000000; background-color:#d9d9d9; text-align:center; vertical-align:middle;">
        <span style="font-weight:bold;">Penunjukan Timbangan</span>
      </td>
      <td colspan="2" style="border:0.75pt solid #000000; background-color:#d9d9d9; text-align:center; vertical-align:middle;">
        <span style="font-weight:bold;">Penunjukan Timbangan</span>
      </td>
      <td style="border:0.75pt solid #000000; background-color:#d9d9d9; text-align:center; vertical-align:middle;">
        <span style="font-weight:bold;">Tengah</span>
      </td>
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="effect_tengah" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
    </tr>
    <tr style="height:20pt">
      <td style="border:0.75pt solid #000000; background-color:#d9d9d9; text-align:center; vertical-align:middle;">
        <span style="font-weight:bold;">zi</span>
      </td>
      <td style="border:0.75pt solid #000000; background-color:#d9d9d9; text-align:center; vertical-align:middle;">
        <span style="font-weight:bold;">mi</span>
      </td>
      <td style="border:0.75pt solid #000000; background-color:#d9d9d9; text-align:center; vertical-align:middle;">
        <span style="font-weight:bold;">zi</span>
      </td>
      <td style="border:0.75pt solid #000000; background-color:#d9d9d9; text-align:center; vertical-align:middle;">
        <span style="font-weight:bold;">mi</span>
      </td>
      <td style="border:0.75pt solid #000000; background-color:#d9d9d9; text-align:center; vertical-align:middle;">
        <span style="font-weight:bold;">Depan</span>
      </td>
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="effect_depan" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
    </tr>

    <!-- Baris 1 -->
    <tr style="height:20pt">
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="setengah_zi_1" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="setengah_mi_1" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="kapasitas_zi_1" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="kapasitas_mi_1" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
      <td style="border:0.75pt solid #000000; background-color:#d9d9d9; text-align:center; vertical-align:middle;">
        <span style="font-weight:bold;">Belakang</span>
      </td>
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="effect_belakang" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
    </tr>

    <!-- Baris 2 -->
    <tr style="height:20pt">
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="setengah_zi_2" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="setengah_mi_2" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="kapasitas_zi_2" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="kapasitas_mi_2" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
      <td style="border:0.75pt solid #000000; background-color:#d9d9d9; text-align:center; vertical-align:middle;">
        <span style="font-weight:bold;">Kanan</span>
      </td>
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="effect_kanan" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
    </tr>

    <!-- Baris 3 -->
    <tr style="height:20pt">
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="setengah_zi_3" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="setengah_mi_3" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="kapasitas_zi_3" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="kapasitas_mi_3" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
      <td style="border:0.75pt solid #000000; background-color:#d9d9d9; text-align:center; vertical-align:middle;">
        <span style="font-weight:bold;">Kiri</span>
      </td>
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="effect_kiri" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
    </tr>

    <!-- Baris 4 (mulai merge catatan) -->
    <tr style="height:20pt">
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="setengah_zi_4" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="setengah_mi_4" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="kapasitas_zi_4" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="kapasitas_mi_4" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
      <td colspan="2" rowspan="7" style="border:0.75pt solid #000000; vertical-align:top; padding:8px;">
        <span style="font-weight:bold; display:block; margin-bottom:5px;">CATATAN</span>
        <textarea name="catatan" style="width:100%; height:85%; border:none; background:transparent; resize:none; padding:2px; box-sizing:border-box;" placeholder=""></textarea>
      </td>
    </tr>

    <!-- Baris 5 sampai 10 -->
    <tr style="height:20pt">
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="setengah_zi_5" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="setengah_mi_5" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="kapasitas_zi_5" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="kapasitas_mi_5" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
    </tr>

    <tr style="height:20pt">
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="setengah_zi_6" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="setengah_mi_6" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="kapasitas_zi_6" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="kapasitas_mi_6" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
    </tr>

    <tr style="height:20pt">
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="setengah_zi_7" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="setengah_mi_7" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="kapasitas_zi_7" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="kapasitas_mi_7" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
    </tr>

    <tr style="height:20pt">
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="setengah_zi_8" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="setengah_mi_8" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="kapasitas_zi_8" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="kapasitas_mi_8" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
    </tr>

    <tr style="height:20pt">
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="setengah_zi_9" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="setengah_mi_9" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="kapasitas_zi_9" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="kapasitas_mi_9" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
    </tr>

    <tr style="height:20pt">
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="setengah_zi_10" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="setengah_mi_10" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="kapasitas_zi_10" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
      <td style="border:0.75pt solid #000000;">
        <input type="text" name="kapasitas_mi_10" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:2px; box-sizing:border-box;" placeholder="">
      </td>
    </tr>
  </table>
</div>
  
                        <!-- Jarak dan Footer Section -->
                        <div style="margin-top: 40px; margin-bottom: 20px;"></div>

             <p style="margin-top:20px; margin-bottom:10px; font-size:16pt; font-weight:bold; text-align:left;">
  Uji Skala Nominal
</p>

<table cellspacing="0" cellpadding="0" style="width:100%; border-collapse:collapse; border:0.75pt solid #000000; font-family:Arial, sans-serif;">
  <!-- Header Utama -->
  <tr style="height:50px;">
    <td style="width:12%; border:0.75pt solid #000000; background-color:#d9d9d9; text-align:center; font-weight:bold; font-size:12pt; vertical-align:middle;">
      Titik Ukur
    </td>
    <td colspan="4" style="width:45%; border:0.75pt solid #000000; background-color:#d9d9d9; text-align:center; font-weight:bold; font-size:12pt; vertical-align:middle;">
      Penimbangan
    </td>
    <td colspan="3" style="width:43%; border:0.75pt solid #000000; background-color:#d9d9d9; text-align:center; font-weight:bold; font-size:12pt; vertical-align:middle;">
      Standar yang digunakan dan/atau catatan terkait
    </td>
  </tr>

  <!-- Baris pertama: z M M z -->
  <tr style="height:50px;">
    <td rowspan="2" style="border:0.75pt solid #000000; vertical-align:middle; text-align:center;">
      <input type="text" name="titik_umum" style="width:95%; height:85%; border:none; background:transparent; text-align:center; font-size:12pt;" placeholder="">
    </td>
    <td style="border:0.75pt solid #000000; text-align:center; font-size:12pt; vertical-align:middle;">z</td>
    <td style="border:0.75pt solid #000000; text-align:center; font-size:12pt; vertical-align:middle;">M</td>
    <td style="border:0.75pt solid #000000; text-align:center; font-size:12pt; vertical-align:middle;">M</td>
    <td style="border:0.75pt solid #000000; text-align:center; font-size:12pt; vertical-align:middle;">z</td>
    <td colspan="3" rowspan="2" style="border:0.75pt solid #000000; vertical-align:middle; text-align:center;">
      <input type="text" name="standar_umum" style="width:98%; height:75%; border:none; background:transparent; text-align:center; font-size:12pt;" placeholder="Standar umum">
    </td>
  </tr>
  <tr style="height:50px;">
    <td style="border:0.75pt solid #000000; border-right:1px solid #000;"><input type="text" name="val_z_umum" style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:12pt;"></td>
    <td style="border:0.75pt solid #000000; border-right:1px solid #000;"><input type="text" name="val_m1_umum" style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:12pt;"></td>
    <td style="border:0.75pt solid #000000; border-right:1px solid #000;"><input type="text" name="val_m2_umum" style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:12pt;"></td>
    <td style="border:0.75pt solid #000000;"><input type="text" name="val_z2_umum" style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:12pt;"></td>
  </tr>

  <!-- Titik 1 -->
  <tr style="height:50px;">
    <td rowspan="2" style="border:0.75pt solid #000000; vertical-align:middle; text-align:center;">
      <input type="text" name="titik_1" style="width:95%; height:85%; border:none; background:transparent; text-align:center; font-size:12pt;" placeholder="">
    </td>
    <td style="border:0.75pt solid #000000; text-align:center; font-size:12pt; vertical-align:middle;">M1</td>
    <td style="border:0.75pt solid #000000; text-align:center; font-size:12pt; vertical-align:middle;">M1+M</td>
    <td style="border:0.75pt solid #000000; text-align:center; font-size:12pt; vertical-align:middle;">M1+M</td>
    <td style="border:0.75pt solid #000000; text-align:center; font-size:12pt; vertical-align:middle;">M1</td>
    <td colspan="3" rowspan="2" style="border:0.75pt solid #000000; vertical-align:middle; text-align:center;">
      <input type="text" name="standar_1" style="width:98%; height:75%; border:none; background:transparent; text-align:center; font-size:12pt;" placeholder="Standar titik 1">
    </td>
  </tr>
  <tr style="height:50px;">
    <td style="border:0.75pt solid #000000; border-right:1px solid #000;"><input type="text" name="val_z_1" style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:12pt;"></td>
    <td style="border:0.75pt solid #000000; border-right:1px solid #000;"><input type="text" name="val_m1_1" style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:12pt;"></td>
    <td style="border:0.75pt solid #000000; border-right:1px solid #000;"><input type="text" name="val_m2_1" style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:12pt;"></td>
    <td style="border:0.75pt solid #000000;"><input type="text" name="val_z2_1" style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:12pt;"></td>
  </tr>

  <!-- Titik 2 -->
  <tr style="height:50px;">
    <td rowspan="2" style="border:0.75pt solid #000000; vertical-align:middle; text-align:center;">
      <input type="text" name="titik_2" style="width:95%; height:85%; border:none; background:transparent; text-align:center; font-size:12pt;" placeholder="">
    </td>
    <td style="border:0.75pt solid #000000; text-align:center; font-size:12pt; vertical-align:middle;">M2</td>
    <td style="border:0.75pt solid #000000; text-align:center; font-size:12pt; vertical-align:middle;">M2+M</td>
    <td style="border:0.75pt solid #000000; text-align:center; font-size:12pt; vertical-align:middle;">M2+M</td>
    <td style="border:0.75pt solid #000000; text-align:center; font-size:12pt; vertical-align:middle;">M2</td>
    <td colspan="3" rowspan="2" style="border:0.75pt solid #000000; vertical-align:middle; text-align:center;">
      <input type="text" name="standar_2" style="width:98%; height:75%; border:none; background:transparent; text-align:center; font-size:12pt;" placeholder="Standar titik 2">
    </td>
  </tr>
  <tr style="height:50px;">
    <td style="border:0.75pt solid #000000; border-right:1px solid #000;"><input type="text" name="val_z_2" style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:12pt;"></td>
    <td style="border:0.75pt solid #000000; border-right:1px solid #000;"><input type="text" name="val_m1_2" style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:12pt;"></td>
    <td style="border:0.75pt solid #000000; border-right:1px solid #000;"><input type="text" name="val_m2_2" style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:12pt;"></td>
    <td style="border:0.75pt solid #000000;"><input type="text" name="val_z2_2" style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:12pt;"></td>
  </tr>

  <!-- Titik 3 -->
  <tr style="height:50px;">
    <td rowspan="2" style="border:0.75pt solid #000000; vertical-align:middle; text-align:center;">
      <input type="text" name="titik_3" style="width:95%; height:85%; border:none; background:transparent; text-align:center; font-size:12pt;" placeholder="">
    </td>
    <td style="border:0.75pt solid #000000; text-align:center; font-size:12pt; vertical-align:middle;">M3</td>
    <td style="border:0.75pt solid #000000; text-align:center; font-size:12pt; vertical-align:middle;">M3+M</td>
    <td style="border:0.75pt solid #000000; text-align:center; font-size:12pt; vertical-align:middle;">M3+M</td>
    <td style="border:0.75pt solid #000000; text-align:center; font-size:12pt; vertical-align:middle;">M3</td>
    <td colspan="3" rowspan="2" style="border:0.75pt solid #000000; vertical-align:middle; text-align:center;">
      <input type="text" name="standar_3" style="width:98%; height:75%; border:none; background:transparent; text-align:center; font-size:12pt;" placeholder="Standar titik 3">
    </td>
  </tr>
  <tr style="height:50px;">
    <td style="border:0.75pt solid #000000; border-right:1px solid #000;"><input type="text" name="val_z_3" style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:12pt;"></td>
    <td style="border:0.75pt solid #000000; border-right:1px solid #000;"><input type="text" name="val_m1_3" style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:12pt;"></td>
    <td style="border:0.75pt solid #000000; border-right:1px solid #000;"><input type="text" name="val_m2_3" style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:12pt;"></td>
    <td style="border:0.75pt solid #000000;"><input type="text" name="val_z2_3" style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:12pt;"></td>
  </tr>

  <!-- Titik 4 -->
  <tr style="height:50px;">
    <td rowspan="2" style="border:0.75pt solid #000000; vertical-align:middle; text-align:center;">
      <input type="text" name="titik_4" style="width:95%; height:85%; border:none; background:transparent; text-align:center; font-size:12pt;" placeholder="">
    </td>
    <td style="border:0.75pt solid #000000; text-align:center; font-size:12pt; vertical-align:middle;">M4</td>
    <td style="border:0.75pt solid #000000; text-align:center; font-size:12pt; vertical-align:middle;">M4+M</td>
    <td style="border:0.75pt solid #000000; text-align:center; font-size:12pt; vertical-align:middle;">M4+M</td>
    <td style="border:0.75pt solid #000000; text-align:center; font-size:12pt; vertical-align:middle;">M4</td>
    <td colspan="3" rowspan="2" style="border:0.75pt solid #000000; vertical-align:middle; text-align:center;">
      <input type="text" name="standar_4" style="width:98%; height:75%; border:none; background:transparent; text-align:center; font-size:12pt;" placeholder="Standar titik 4">
    </td>
  </tr>
  <tr style="height:50px;">
    <td style="border:0.75pt solid #000000; border-right:1px solid #000;"><input type="text" name="val_z_4" style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:12pt;"></td>
    <td style="border:0.75pt solid #000000; border-right:1px solid #000;"><input type="text" name="val_m1_4" style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:12pt;"></td>
    <td style="border:0.75pt solid #000000; border-right:1px solid #000;"><input type="text" name="val_m2_4" style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:12pt;"></td>
    <td style="border:0.75pt solid #000000;"><input type="text" name="val_z2_4" style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:12pt;"></td>
  </tr>

  <!-- Titik 5 -->
  <tr style="height:50px;">
    <td rowspan="2" style="border:0.75pt solid #000000; vertical-align:middle; text-align:center;">
      <input type="text" name="titik_5" style="width:95%; height:85%; border:none; background:transparent; text-align:center; font-size:12pt;" placeholder="">
    </td>
    <td style="border:0.75pt solid #000000; text-align:center; font-size:12pt; vertical-align:middle;">M5</td>
    <td style="border:0.75pt solid #000000; text-align:center; font-size:12pt; vertical-align:middle;">M5+M</td>
    <td style="border:0.75pt solid #000000; text-align:center; font-size:12pt; vertical-align:middle;">M5+M</td>
    <td style="border:0.75pt solid #000000; text-align:center; font-size:12pt; vertical-align:middle;">M5</td>
    <td colspan="3" rowspan="2" style="border:0.75pt solid #000000; vertical-align:middle; text-align:center;">
      <input type="text" name="standar_5" style="width:98%; height:75%; border:none; background:transparent; text-align:center; font-size:12pt;" placeholder="Standar titik 5">
    </td>
  </tr>
  <tr style="height:50px;">
    <td style="border:0.75pt solid #000000; border-right:1px solid #000;"><input type="text" name="val_z_5" style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:12pt;"></td>
    <td style="border:0.75pt solid #000000; border-right:1px solid #000;"><input type="text" name="val_m1_5" style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:12pt;"></td>
    <td style="border:0.75pt solid #000000; border-right:1px solid #000;"><input type="text" name="val_m2_5" style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:12pt;"></td>
    <td style="border:0.75pt solid #000000;"><input type="text" name="val_z2_5" style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:12pt;"></td>
  </tr>

  <!-- Titik 6 -->
  <tr style="height:50px;">
    <td rowspan="2" style="border:0.75pt solid #000000; vertical-align:middle; text-align:center;">
      <input type="text" name="titik_6" style="width:95%; height:85%; border:none; background:transparent; text-align:center; font-size:12pt;" placeholder="">
    </td>
    <td style="border:0.75pt solid #000000; text-align:center; font-size:12pt; vertical-align:middle;">M6</td>
    <td style="border:0.75pt solid #000000; text-align:center; font-size:12pt; vertical-align:middle;">M6+M</td>
    <td style="border:0.75pt solid #000000; text-align:center; font-size:12pt; vertical-align:middle;">M6+M</td>
    <td style="border:0.75pt solid #000000; text-align:center; font-size:12pt; vertical-align:middle;">M6</td>
    <td colspan="3" rowspan="2" style="border:0.75pt solid #000000; vertical-align:middle; text-align:center;">
      <input type="text" name="standar_6" style="width:98%; height:75%; border:none; background:transparent; text-align:center; font-size:12pt;" placeholder="Standar titik 6">
    </td>
  </tr>
  <tr style="height:50px;">
    <td style="border:0.75pt solid #000000; border-right:1px solid #000;"><input type="text" name="val_z_6" style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:12pt;"></td>
    <td style="border:0.75pt solid #000000; border-right:1px solid #000;"><input type="text" name="val_m1_6" style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:12pt;"></td>
    <td style="border:0.75pt solid #000000; border-right:1px solid #000;"><input type="text" name="val_m2_6" style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:12pt;"></td>
    <td style="border:0.75pt solid #000000;"><input type="text" name="val_z2_6" style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:12pt;"></td>
  </tr>

  <!-- Titik 7 -->
  <tr style="height:50px;">
    <td rowspan="2" style="border:0.75pt solid #000000; vertical-align:middle; text-align:center;">
      <input type="text" name="titik_7" style="width:95%; height:85%; border:none; background:transparent; text-align:center; font-size:12pt;" placeholder="">
    </td>
    <td style="border:0.75pt solid #000000; text-align:center; font-size:12pt; vertical-align:middle;">M7</td>
    <td style="border:0.75pt solid #000000; text-align:center; font-size:12pt; vertical-align:middle;">M7+M</td>
    <td style="border:0.75pt solid #000000; text-align:center; font-size:12pt; vertical-align:middle;">M7+M</td>
    <td style="border:0.75pt solid #000000; text-align:center; font-size:12pt; vertical-align:middle;">M7</td>
    <td colspan="3" rowspan="2" style="border:0.75pt solid #000000; vertical-align:middle; text-align:center;">
      <input type="text" name="standar_7" style="width:98%; height:75%; border:none; background:transparent; text-align:center; font-size:12pt;" placeholder="Standar titik 7">
    </td>
  </tr>
  <tr style="height:50px;">
    <td style="border:0.75pt solid #000000; border-right:1px solid #000;"><input type="text" name="val_z_7" style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:12pt;"></td>
    <td style="border:0.75pt solid #000000; border-right:1px solid #000;"><input type="text" name="val_m1_7" style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:12pt;"></td>
    <td style="border:0.75pt solid #000000; border-right:1px solid #000;"><input type="text" name="val_m2_7" style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:12pt;"></td>
    <td style="border:0.75pt solid #000000;"><input type="text" name="val_z2_7" style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:12pt;"></td>
  </tr>

  <!-- Titik 8 -->
  <tr style="height:50px;">
    <td rowspan="2" style="border:0.75pt solid #000000; vertical-align:middle; text-align:center;">
      <input type="text" name="titik_8" style="width:95%; height:85%; border:none; background:transparent; text-align:center; font-size:12pt;" placeholder="">
    </td>
    <td style="border:0.75pt solid #000000; text-align:center; font-size:12pt; vertical-align:middle;">M8</td>
    <td style="border:0.75pt solid #000000; text-align:center; font-size:12pt; vertical-align:middle;">M8+M</td>
    <td style="border:0.75pt solid #000000; text-align:center; font-size:12pt; vertical-align:middle;">M8+M</td>
    <td style="border:0.75pt solid #000000; text-align:center; font-size:12pt; vertical-align:middle;">M8</td>
    <td colspan="3" rowspan="2" style="border:0.75pt solid #000000; vertical-align:middle; text-align:center;">
      <input type="text" name="standar_8" style="width:98%; height:75%; border:none; background:transparent; text-align:center; font-size:12pt;" placeholder="Standar titik 8">
    </td>
  </tr>
  <tr style="height:50px;">
    <td style="border:0.75pt solid #000000; border-right:1px solid #000;"><input type="text" name="val_z_8" style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:12pt;"></td>
    <td style="border:0.75pt solid #000000; border-right:1px solid #000;"><input type="text" name="val_m1_8" style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:12pt;"></td>
    <td style="border:0.75pt solid #000000; border-right:1px solid #000;"><input type="text" name="val_m2_8" style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:12pt;"></td>
    <td style="border:0.75pt solid #000000;"><input type="text" name="val_z2_8" style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:12pt;"></td>
  </tr>

  <!-- Titik 9 dengan double border bawah -->
  <tr style="height:50px;">
    <td rowspan="2" style="border:0.75pt solid #000000; border-bottom:2.25pt double #000000; vertical-align:middle; text-align:center;">
      <input type="text" name="titik_9" style="width:95%; height:85%; border:none; background:transparent; text-align:center; font-size:12pt;" placeholder="">
    </td>
    <td style="border:0.75pt solid #000000; text-align:center; font-size:12pt; vertical-align:middle;">M9</td>
    <td style="border:0.75pt solid #000000; text-align:center; font-size:12pt; vertical-align:middle;">M9+M</td>
    <td style="border:0.75pt solid #000000; text-align:center; font-size:12pt; vertical-align:middle;">M9+M</td>
    <td style="border:0.75pt solid #000000; text-align:center; font-size:12pt; vertical-align:middle;">M9</td>
    <td colspan="3" rowspan="2" style="border:0.75pt solid #000000; border-bottom:2.25pt double #000000; vertical-align:middle; text-align:center;">
      <input type="text" name="standar_9" style="width:98%; height:75%; border:none; background:transparent; text-align:center; font-size:12pt;" placeholder="Standar titik 9">
    </td>
  </tr>
  <tr style="height:50px;">
    <td style="border:0.75pt solid #000000; border-right:1px solid #000; border-bottom:2.25pt double #000000;"><input type="text" name="val_z_9" style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:12pt;"></td>
    <td style="border:0.75pt solid #000000; border-right:1px solid #000; border-bottom:2.25pt double #000000;"><input type="text" name="val_m1_9" style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:12pt;"></td>
    <td style="border:0.75pt solid #000000; border-right:1px solid #000; border-bottom:2.25pt double #000000;"><input type="text" name="val_m2_9" style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:12pt;"></td>
    <td style="border:0.75pt solid #000000; border-bottom:2.25pt double #000000;"><input type="text" name="val_z2_9" style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:12pt;"></td>
  </tr>

  <!-- Footer -->
  <tr style="height:45px;">
    <td colspan="8" style="border-top:2.25pt double #000000; border-left:0.75pt solid #000000; border-right:0.75pt solid #000000; border-bottom:0.75pt solid #000000; text-align:center; font-weight:bold; font-size:12pt;">
      Isilah lembar data kalibrasi dengan lengkap dan jelas!
    </td>
  </tr>

  <!-- Informasi Tambahan -->
  <tr style="height:45px;">
    <td colspan="2" style="border:0.75pt solid #000000; vertical-align:middle; font-weight:bold; font-size:12pt; padding-left:10px;">
      Alat Standar
    </td>
    <td colspan="4" style="border:0.75pt solid #000000; vertical-align:middle; font-size:12pt; padding-left:10px;">
      Anak Timbang Kelas M1 | M2
      <input type="hidden" name="alat_standar_text" value="Anak Timbang Kelas M1 | M2">
    </td>
    <td style="border:0.75pt solid #000000; text-align:center; vertical-align:middle; font-size:12pt;">
      Dikalibrasi oleh
    </td>
    <td style="border:0.75pt solid #000000; text-align:center; vertical-align:middle; font-size:12pt;">
      Diperiksa oleh
    </td>
  </tr>
  <tr style="height:90px;">
    <td colspan="2" style="border:0.75pt solid #000000; vertical-align:middle; font-weight:bold; font-size:12pt; padding-left:10px;">
      Acuan Metode Kalibrasi
    </td>
    <td colspan="4" style="border:0.75pt solid #000000; vertical-align:middle; font-size:12pt; padding-left:10px;">
      The Calibration of Weight and Balance, Third Edition - NMI Australia.
    </td>
    <td style="border:0.75pt solid #000000; vertical-align:top; padding:25px 10px;">
      <div style="margin-bottom:15px; font-size:12pt;">TTD :</div>
      <input type="text" name="calibrated_by" style="width:100%; border:none; border-bottom:1px solid #000; background:transparent; font-size:12pt;">
    </td>
    <td style="border:0.75pt solid #000000; vertical-align:top; padding:25px 10px;">
      <div style="margin-bottom:15px; font-size:12pt;">TTD :</div>
      <input type="text" name="verified_by" style="width:100%; border:none; border-bottom:1px solid #000; background:transparent; font-size:12pt;">
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