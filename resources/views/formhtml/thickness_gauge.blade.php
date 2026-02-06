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
        <!-- resources/views/formhtml/thickness_gauge.blade.php -->
        <form method="POST" action="/calibrations" id="kalibrasiForm">
        @csrf
        <input type="hidden" name="form_type" value="thickness_gauge">
            <div class="form-kalibrasi-container">
                <table class="kalibrasi-header-table">
                    <tr>
                        <td colspan="2">
                            <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK21</p>
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
                            <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">THICKNESS GAUGE</p>
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
                                    value="Thickness Gauge"
                                    placeholder="Thickness Gauge"
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
                    <!-- <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Rentang Ukur</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="number" 
                                    name="rentang_ukur_min" 
                                    class="kalibrasi-input me-3" 
                                    value="0"
                                    placeholder="Masukkan Rentang Ukur Min" 
                                    style="width: 45%;" 
                                   
                                    onblur="if(this.value=='') this.value=0"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                <span class="me-3" style="color: #000000;">-</span>
                                <input type="number" 
                                    name="rentang_ukur_max" 
                                    class="kalibrasi-input" 
                                    placeholder="Masukkan Rentang Ukur Max" 
                                    style="width: 45%;" 
                                    onblur="if(this.value=='') this.value=0"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')">
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
                

                <table cellspacing="0" cellpadding="0" style="width: 100%; border-collapse: collapse; margin-bottom: 20px; border: 1px solid #000000;">
                    <tr style="background: #d9d9d9; height: 11.55pt;">
                        <td style="width: 20%; border: 1px solid #000000; padding: 2px; vertical-align: top;">
                            <p style="margin: 0; text-align: center; line-height: 10.6pt;">
                                <span style="font-family: Arial; font-size: 9.5pt; font-weight: bold; color: #000000;">Nominal Gauge Block</span>
                            </p>
                        </td>
                        <td colspan="5" style="border: 1px solid #000000; padding: 2px; vertical-align: top;">
                            <p style="margin: 0; text-align: center; line-height: 10.6pt;">
                                <span style="font-family: Arial; font-size: 9.5pt; font-weight: bold; color: #000000;">Penunjukan Alat</span>
                            </p>
                        </td>
                    </tr>
                    
                    <tr style="background: #e8e8e8; height: 11.6pt;">
                        <td style="border: 1px solid #000000; padding: 2px; vertical-align: top;">
                            <p style="margin: 0; text-align: center; line-height: 10.6pt;">
                                <span style="font-family: Arial; font-size: 9.5pt; font-weight: bold; color: #000000;">Unit (mm)</span>
                            </p>
                        </td>
                        <td style="width: 16%; border: 1px solid #000000; padding: 2px; vertical-align: top;">
                            <p style="margin: 0; text-align: center; line-height: 10.15pt;">
                                <span style="font-family: Arial; font-size: 9.5pt; font-weight: bold; color: #000000;">1</span>
                            </p>
                        </td>
                        <td style="width: 16%; border: 1px solid #000000; padding: 2px; vertical-align: top;">
                            <p style="margin: 0; text-align: center; line-height: 10.15pt;">
                                <span style="font-family: Arial; font-size: 9.5pt; font-weight: bold; color: #000000;">2</span>
                            </p>
                        </td>
                        <td style="width: 16%; border: 1px solid #000000; padding: 2px; vertical-align: top;">
                            <p style="margin: 0; text-align: center; line-height: 10.15pt;">
                                <span style="font-family: Arial; font-size: 9.5pt; font-weight: bold; color: #000000;">3</span>
                            </p>
                        </td>
                        <td style="width: 16%; border: 1px solid #000000; padding: 2px; vertical-align: top;">
                            <p style="margin: 0; text-align: center; line-height: 10.15pt;">
                                <span style="font-family: Arial; font-size: 9.5pt; font-weight: bold; color: #000000;">4</span>
                            </p>
                        </td>
                        <td style="width: 16%; border: 1px solid #000000; padding: 2px; vertical-align: top;">
                            <p style="margin: 0; text-align: center; line-height: 10.15pt;">
                                <span style="font-family: Arial; font-size: 9.5pt; font-weight: bold; color: #000000;">5</span>
                            </p>
                        </td>
                    </tr>

                    <!-- Baris 0.0 mm -->
                    <tr style="height: 30pt;">
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle; text-align: center; background-color: #ffffff;">
                            <input type="text" name="titikukur_0" value="0.0" readonly
                                style="width: 100%; height: 100%; border: none; background: transparent; text-align: center; font-size: 9.5pt; color: #000; padding: 2px; cursor: default;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_0_1" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_0_2" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_0_3" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_0_4" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_0_5" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                    </tr>

                    <!-- Baris 0.5 mm -->
                    <tr style="height: 30pt;">
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle; text-align: center; background-color: #ffffff;">
                            <input type="text" name="titikukur_0.5" value="0.5" readonly
                                style="width: 100%; height: 100%; border: none; background: transparent; text-align: center; font-size: 9.5pt; color: #000; padding: 2px; cursor: default;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_0.5_1" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_0.5_2" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_0.5_3" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_0.5_4" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_0.5_5" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                    </tr>

                    <!-- Baris 1.0 mm -->
                    <tr style="height: 30pt;">
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle; text-align: center; background-color: #ffffff;">
                            <input type="text" name="titikukur_1.0" value="1.0" readonly
                                style="width: 100%; height: 100%; border: none; background: transparent; text-align: center; font-size: 9.5pt; color: #000; padding: 2px; cursor: default;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_1.0_1" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_1.0_2" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_1.0_3" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_1.0_4" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_1.0_5" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                    </tr>

                    <!-- Baris 2.0 mm -->
                    <tr style="height: 30pt;">
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle; text-align: center; background-color: #ffffff;">
                            <input type="text" name="titikukur_2.0" value="2.0" readonly
                                style="width: 100%; height: 100%; border: none; background: transparent; text-align: center; font-size: 9.5pt; color: #000; padding: 2px; cursor: default;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_2.0_1" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_2.0_2" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_2.0_3" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_2.0_4" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_2.0_5" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                    </tr>

                    <!-- Baris 3.0 mm -->
                    <tr style="height: 30pt;">
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle; text-align: center; background-color: #ffffff;">
                            <input type="text" name="titikukur_3.0" value="3.0" readonly
                                style="width: 100%; height: 100%; border: none; background: transparent; text-align: center; font-size: 9.5pt; color: #000; padding: 2px; cursor: default;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_3.0_1" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_3.0_2" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_3.0_3" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_3.0_4" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_3.0_5" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                    </tr>

                      <!-- Baris 4.0 mm -->
                      <tr style="height: 30pt;">
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle; text-align: center; background-color: #ffffff;">
                            <input type="text" name="titikukur_4.0" value="4.0" readonly
                                style="width: 100%; height: 100%; border: none; background: transparent; text-align: center; font-size: 9.5pt; color: #000; padding: 2px; cursor: default;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_4.0_1" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_4.0_2" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_4.0_3" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_4.0_4" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_4.0_5" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                    </tr>

                     <!-- Baris 5.0 mm -->
                     <tr style="height: 30pt;">
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle; text-align: center; background-color: #ffffff;">
                            <input type="text" name="titikukur_5.0" value="5.0" readonly
                                style="width: 100%; height: 100%; border: none; background: transparent; text-align: center; font-size: 9.5pt; color: #000; padding: 2px; cursor: default;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_5.0_1" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_5.0_2" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_5.0_3" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_5.0_4" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_5.0_5" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                    </tr>

                     <!-- Baris 6.0 mm -->
                     <tr style="height: 30pt;">
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle; text-align: center; background-color: #ffffff;">
                            <input type="text" name="titikukur_6.0" value="6.0" readonly
                                style="width: 100%; height: 100%; border: none; background: transparent; text-align: center; font-size: 9.5pt; color: #000; padding: 2px; cursor: default;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_6.0_1" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_6.0_2" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_6.0_3" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_6.0_4" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_6.0_5" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                    </tr>

                     <!-- Baris 7.0 mm -->
                     <tr style="height: 30pt;">
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle; text-align: center; background-color: #ffffff;">
                            <input type="text" name="titikukur_7.0" value="7.0" readonly
                                style="width: 100%; height: 100%; border: none; background: transparent; text-align: center; font-size: 9.5pt; color: #000; padding: 2px; cursor: default;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_7.0_1" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_7.0_2" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_7.0_3" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_7.0_4" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_7.0_5" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                    </tr>

                     <!-- Baris 8.0 mm -->
                     <tr style="height: 30pt;">
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle; text-align: center; background-color: #ffffff;">
                            <input type="text" name="titikukur_8.0" value="8.0" readonly
                                style="width: 100%; height: 100%; border: none; background: transparent; text-align: center; font-size: 9.5pt; color: #000; padding: 2px; cursor: default;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_8.0_1" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_8.0_2" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_8.0_3" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_8.0_4" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_8.0_5" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                    </tr>

                     <!-- Baris 9.0 mm -->
                     <tr style="height: 30pt;">
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle; text-align: center; background-color: #ffffff;">
                            <input type="text" name="titikukur_9.0" value="9.0" readonly
                                style="width: 100%; height: 100%; border: none; background: transparent; text-align: center; font-size: 9.5pt; color: #000; padding: 2px; cursor: default;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_9.0_1" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_9.0_2" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_9.0_3" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_9.0_4" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_9.0_5" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                    </tr>

                     <!-- Baris 10.0 mm -->
                     <tr style="height: 30pt;">
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle; text-align: center; background-color: #ffffff;">
                            <input type="text" name="titikukur_10.0" value="10.0" readonly
                                style="width: 100%; height: 100%; border: none; background: transparent; text-align: center; font-size: 9.5pt; color: #000; padding: 2px; cursor: default;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_10.0_1" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_10.0_2" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_10.0_3" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_10.0_4" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_10.0_5" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                    </tr>

                     <!-- Baris 15.0 mm -->
                     <tr style="height: 30pt;">
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle; text-align: center; background-color: #ffffff;">
                            <input type="text" name="titikukur_15.0" value="15.0" readonly
                                style="width: 100%; height: 100%; border: none; background: transparent; text-align: center; font-size: 9.5pt; color: #000; padding: 2px; cursor: default;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_15.0_1" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_15.0_2" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_15.0_3" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_15.0_4" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_15.0_5" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                    </tr>

                     <!-- Baris 20.0 mm -->
                     <tr style="height: 30pt;">
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle; text-align: center; background-color: #ffffff;">
                            <input type="text" name="titikukur_20.0" value="20.0" readonly
                                style="width: 100%; height: 100%; border: none; background: transparent; text-align: center; font-size: 9.5pt; color: #000; padding: 2px; cursor: default;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_20.0_1" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_20.0_2" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_20.0_3" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_20.0_4" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_20.0_5" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                    </tr>

                     <!-- Baris 30.0 mm -->
                     <tr style="height: 30pt;">
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle; text-align: center; background-color: #ffffff;">
                            <input type="text" name="titikukur_30.0" value="30.0" readonly
                                style="width: 100%; height: 100%; border: none; background: transparent; text-align: center; font-size: 9.5pt; color: #000; padding: 2px; cursor: default;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_30.0_1" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_30.0_2" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_30.0_3" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_30.0_4" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_30.0_5" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                    </tr>

                     <!-- Baris 40.0 mm -->
                     <tr style="height: 30pt;">
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle; text-align: center; background-color: #ffffff;">
                            <input type="text" name="titikukur_40.0" value="40.0" readonly
                                style="width: 100%; height: 100%; border: none; background: transparent; text-align: center; font-size: 9.5pt; color: #000; padding: 2px; cursor: default;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_40.0_1" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_40.0_2" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_40.0_3" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_40.0_4" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_40.0_5" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                    </tr>

                     <!-- Baris 50.0 mm -->
                     <tr style="height: 30pt;">
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle; text-align: center; background-color: #ffffff;">
                            <input type="text" name="titikukur_50.0" value="50.0" readonly
                                style="width: 100%; height: 100%; border: none; background: transparent; text-align: center; font-size: 9.5pt; color: #000; padding: 2px; cursor: default;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_50.0_1" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_50.0_2" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_50.0_3" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_50.0_4" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                        <td style="border: 1px solid #000000; padding: 0; vertical-align: middle;">
                            <input type="text" name="ulangan_50.0_5" value="" 
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" 
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                        </td>
                    </tr>

                   

                    

                </table>

                <table cellspacing="0" cellpadding="5" style="width:100%; border-collapse:collapse; font-size:12pt;">
                    <tr>
                        <td colspan="4" style="border:1px solid #000; text-align:center; font-weight:bold;">
                            Isilah lembar data kalibrasi dengan lengkap dan jelas!
                        </td>
                    </tr>

                    <tr>
                        <td style="border:1px solid #000; width:20%;text-align:center;">Alat Standar</td>
                        <td style="border:1px solid #000; width:30%;">
                            <!-- TAMBAHKAN HIDDEN INPUT DI SINI -->
                            <input type="hidden" name="alat_standar_text" value="Gauge Block Set Grade 0">
                            Gauge Block Set Grade 0
                        </td>
                        <td style="border:1px solid #000; width:25%; text-align:center;">Dikalibrasi oleh</td>
                        <td style="border:1px solid #000; width:25%; text-align:center;">Diperiksa oleh</td>
                    </tr>

                    <tr>
                        <td style="border:1px solid #000;text-align:center;">Metode Kalibrasi</td>
                        <td style="border:1px solid #000;">PAS-IK1102-21</td>

                        <!-- Dikalibrasi oleh -->
                        <td style="border:1px solid #000; vertical-align:top;">
                            TTD:<br><br><br>
                            Nama: <input type="text"  name="calibrated_by" style="width:95%; font-size:12pt;">
                        </td>

                        <!-- Diperiksa oleh -->
                        <td style="border:1px solid #000; vertical-align:top;">
                            TTD:<br><br><br>
                            Nama: <input type="text"  name="verified_by" style="width:95%; font-size:12pt;">
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