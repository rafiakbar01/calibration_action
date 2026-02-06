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
        <!-- resources/views/formhtml/caliper.blade.php -->
        <form method="POST" action="/calibrations" id="kalibrasiForm">
        @csrf
        <input type="hidden" name="form_type" value="caliper">
        <input type="hidden" name="capacity" value="{{ $capacity ?? '' }}">
            <div class="form-kalibrasi-container">
                <table class="kalibrasi-header-table">
                    <tr>
                        <td colspan="2">
                            <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK03</p>
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
                            <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">CALIPER</p>
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
                                    value="Caliper"
                                    placeholder="Caliper"
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
                                    <td><input type="text" name="suhu_awal" class="kondisi-input" required></td>
                                    <td><input type="text" name="suhu_tengah" class="kondisi-input" required></td>
                                    <td><input type="text" name="suhu_akhir" class="kondisi-input" required></td>
                                </tr>
                                <tr>
                                    <td class="bg-light fw-bold" style="color: #000000;">RH (%)</td>
                                    <td><input type="text" name="rh_awal" class="kondisi-input" required></td>
                                    <td><input type="text" name="rh_tengah" class="kondisi-input" required></td>
                                    <td><input type="text" name="rh_akhir" class="kondisi-input" required></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                <!-- Data Kalibrasi Section -->
                <div class="data-kalibrasi-header" style="color: #000000;">DATA KALIBRASI</div>
                
              <!-- BAGIAN 1: PEMERIKSAAN KESEJAJARAN MUKA UKUR EKSTERNAL -->
            <div class="mb-3">
                <ol type="1" style="margin:0pt; padding-left:0pt">
                    <li class="ListParagraph" style="text-indent:0pt;  font-size:11pt; font-weight:bold">
                        <span>Pemeriksaan</span>
                        <span style="letter-spacing:0.6pt"></span>
                        <span>Kesejajaran</span>
                        <span style="letter-spacing:0.6pt"></span>
                        <span>Muka</span>
                        <span style="letter-spacing:0.5pt"></span>
                        <span>Ukur</span>
                        <span style="letter-spacing:0.45pt"></span>
                        <span style="letter-spacing:-0.1pt">Eksternal</span>
                    </li>
                </ol>
                <table cellspacing="0" cellpadding="0" class="TableNormal" style="margin-left:15.48pt; border:0.75pt solid #000000; border-collapse:collapse; width:100%">
                        <tr style="height:10.05pt">
                        <td style="width:25%; border:0.75pt solid #000000; vertical-align:top; background-color:#bebebe">
                            <p style="text-align:center; line-height:9.05pt; padding:4pt">
                                <span style="font-family:Arial; font-size:9.5pt; font-weight:bold">Titik Ukur</span>
                            </p>
                        </td>
                        <td style="width:25%; border:0.75pt solid #000000; vertical-align:top; background-color:#bebebe">
                            <p style="text-align:center; line-height:9.05pt; padding:4pt">
                                <span style="font-family:Arial; font-size:9.5pt; font-weight:bold">Atas / Pangkal</span>
                            </p>
                        </td>
                        <td style="width:25%; border:0.75pt solid #000000; vertical-align:top; background-color:#bebebe">
                            <p style="text-align:center; line-height:9.05pt; padding:4pt">
                                <span style="font-family:Arial; font-size:9.5pt; font-weight:bold">Tengah</span>
                            </p>
                        </td>
                        <td style="width:25%; border:0.75pt solid #000000; vertical-align:top; background-color:#bebebe">
                            <p style="text-align:center; line-height:9.05pt; padding:4pt">
                                <span style="font-family:Arial; font-size:9.5pt; font-weight:bold">Bawah / Ujung</span>
                            </p>
                        </td>
                    </tr>
                    <tr style="height:12.65pt">
                        <td style="width:25%; border:0.75pt solid #000000; vertical-align:top; padding:4pt; position:relative">
                            <div style="display:flex; align-items:center; width:100%;">
                                <input type="text" 
                                    name="titikUkurKesajajaran" 
                                    value="{{ old('titikUkurKesajajaran') }}"
                                    oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')"
                                    style="flex:1; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;"
                                    required>
                                <span style="font-size:9.5pt; color:#666; margin-left:4px;">mm</span>
                            </div>
                        </td>
                        <td style="width:25%; border:0.75pt solid #000000; vertical-align:top; padding:4pt">
                            <input type="text" 
                                name="kesejajaranAwal" 
                                value="{{ old('kesejajaranAwal') }}"
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')"
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;"
                                placeholder=""
                                required>
                        </td>
                        <td style="width:25%; border:0.75pt solid #000000; vertical-align:top; padding:4pt">
                            <input type="text" 
                                name="kesejajaranTengah" 
                                value="{{ old('kesejajaranTengah') }}"
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')"
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;"
                                placeholder=""
                                required>
                        </td>
                        <td style="width:25%; border:0.75pt solid #000000; vertical-align:top; padding:4pt">
                            <input type="text" 
                                name="kesejajaranAkhir" 
                                value="{{ old('kesejajaranAkhir') }}"
                                oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')"
                                style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;"
                                placeholder=""
                                required>
                        </td>
                    </tr>
            </table>
            </div>

<!-- BAGIAN 2: PENGUKURAN DALAM DENGAN UJUNG PISAU BERSILANG -->
<div class="mb-3">
    <ol start="2" type="1" style="margin:0pt; padding-left:0pt">
        <li class="ListParagraph" style="margin-top:4.85pt; text-indent:0pt; font-size:11pt; font-weight:bold">
            <span>Pengukuran Dalam Dengan Ujung Pisau Bersilang</span>
        </li>
    </ol>
    <table cellspacing="0" cellpadding="0" class="TableNormal" style="margin-left:15.48pt; border:0.75pt solid #000000; border-collapse:collapse; width:100%">
    <tr style="height:12pt">
    <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
        <p style="text-align:center; line-height:11pt; padding:6pt">
            <span style="font-family:Arial; font-size:10pt; font-weight:bold">Titik Ukur</span>
        </p>
    </td>
    <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
        <p style="text-align:center; line-height:11pt; padding:6pt">
            <span style="font-family:Arial; font-size:10pt; font-weight:bold">Pembacaan-1</span>
        </p>
    </td>
    <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
        <p style="text-align:center; line-height:11pt; padding:6pt">
            <span style="font-family:Arial; font-size:10pt; font-weight:bold">Pembacaan-2</span>
        </p>
    </td>
    <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
        <p style="text-align:center; line-height:11pt; padding:6pt">
            <span style="font-family:Arial; font-size:10pt; font-weight:bold">Pembacaan-3</span>
        </p>
    </td>
</tr>
<tr style="height:16pt">
    <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
        <div style="display:flex; align-items:center; width:100%; height:100%;">

    <input type="text" 
        name="pengukuranDalamPisauBersilang" 
        value="{{ old('pengukuranDalamPisauBersilang') }}"
        oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')"
        style="flex:1; height:100%; border:none; background:transparent;
               text-align:center; font-size:10pt; color:#000; padding:4px;"
        required>

    <span style="margin-left:6px; font-size:9pt; color:#666; font-family:Arial;">
        mm
    </span>

</div>

    </td>
    <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
        <input type="text" 
            name="pembacaan1" 
            value="{{ old('pembacaan1') }}"
            oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')"
            style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:10pt; color:#000; padding:4px;"
            placeholder=""
            required>
    </td>
    <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
        <input type="text" 
            name="pembacaan2" 
            value="{{ old('pembacaan2') }}"
            oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')"
            style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:10pt; color:#000; padding:4px;"
            placeholder=""
            required>
    </td>
    <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
        <input type="text" 
            name="pembacaan3" 
            value="{{ old('pembacaan3') }}"
            oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')"
            style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:10pt; color:#000; padding:4px;"
            placeholder=""
            required>
    </td>
</tr>
</table>
</div>
<!-- BAGIAN 3: PENGUKURAN OUTSIDE -->
<div class="mb-3">
    <ol start="3" type="1" style="margin:0pt; padding-left:0pt">
        <li class="ListParagraph" style="margin-top:4.85pt; text-indent:0pt; font-size:11pt; font-weight:bold">
            <span>Pengukuran Outside</span>
        </li>
    </ol>
    <input type="hidden" name="capacity" value="{{ $capacity ?? '' }}">
    
    <table cellspacing="0" cellpadding="0" class="TableNormal" style="margin-left:15.48pt; border:0.75pt solid #000000; border-collapse:collapse; width:100%">
        <tr style="height:12pt">
            <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Titik Ukur<br>(Unit: mm)</span>
                </p>
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Penunjukan 1</span>
                </p>
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Penunjukan 2</span>
                </p>
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Penunjukan 3</span>
                </p>
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Penunjukan 4</span>
                </p>
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Penunjukan 5</span>
                </p>
            </td>
        </tr>
        
        <!-- OUTSIDE ROWS (8 baris) -->
        @php
            $capacity = request('capacity', 300);
            $outsideValues = [];
            if ($capacity == 300) {
                $outsideValues = [0, 20, 50, 100, 150, 200, 250, 300];
            } elseif ($capacity == 450) {
                $outsideValues = [0, 50, 100, 200, 300, 350, 400, 450];
            } elseif ($capacity == 600) {
                $outsideValues = [0, 50, 100, 200, 300, 400, 500, 600];
            } elseif ($capacity == 1000) {
                $outsideValues = [0, 100, 300, 500, 700, 800, 900, 1000];
            }
        @endphp
        
        @foreach($outsideValues as $index => $value)
        <tr style="height:16pt">
            <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                <input type="text" 
                    value="{{ $value }}"
                    readonly
                    style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:10pt; color:#000; padding:4px;">
                <input type="hidden" 
                    name="outside_titik_ukur[{{ $index }}]" 
                    value="{{ $value }}">
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                <input type="text" 
                    name="outside_ulangan01[{{ $index }}]" 
                    value="{{ old("outside_ulangan01.{$index}") }}"
                    oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')"
                    style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:10pt; color:#000; padding:4px;"
                    placeholder="">
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                <input type="text" 
                    name="outside_ulangan02[{{ $index }}]" 
                    value="{{ old("outside_ulangan02.{$index}") }}"
                    oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')"
                    style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:10pt; color:#000; padding:4px;"
                    placeholder="">
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                <input type="text" 
                    name="outside_ulangan03[{{ $index }}]" 
                    value="{{ old("outside_ulangan03.{$index}") }}"
                    oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')"
                    style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:10pt; color:#000; padding:4px;"
                    placeholder="">
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                <input type="text" 
                    name="outside_ulangan04[{{ $index }}]" 
                    value="{{ old("outside_ulangan04.{$index}") }}"
                    oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')"
                    style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:10pt; color:#000; padding:4px;"
                    placeholder="">
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                <input type="text" 
                    name="outside_ulangan05[{{ $index }}]" 
                    value="{{ old("outside_ulangan05.{$index}") }}"
                    oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')"
                    style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:10pt; color:#000; padding:4px;"
                    placeholder="">
            </td>
        </tr>
        @endforeach
    </table>
</div>

<!-- BAGIAN 4: PENGUKURAN INSIDE -->
<div class="mb-3">
    <ol start="4" type="1" style="margin:0pt; padding-left:0pt">
        <li class="ListParagraph" style="margin-top:4.85pt; text-indent:0pt; font-size:11pt; font-weight:bold">
            <span>Pengukuran Inside</span>
        </li>
    </ol>
    
    <table cellspacing="0" cellpadding="0" class="TableNormal" style="margin-left:15.48pt; border:0.75pt solid #000000; border-collapse:collapse; width:100%">
        <tr style="height:12pt">
            <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Titik Ukur<br>(Unit: mm)</span>
                </p>
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Penunjukan 1</span>
                </p>
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Penunjukan 2</span>
                </p>
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Penunjukan 3</span>
                </p>
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Penunjukan 4</span>
                </p>
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Penunjukan 5</span>
                </p>
            </td>
        </tr>
        
        <!-- INSIDE ROWS (7 baris tanpa nilai 0) -->
        @php
            $insideValues = [];
            if ($capacity == 300) {
                $insideValues = [20, 50, 100, 150, 200, 250, 300];
            } elseif ($capacity == 450) {
                $insideValues = [50, 100, 200, 300, 350, 400, 450];
            } elseif ($capacity == 600) {
                $insideValues = [50, 100, 200, 300, 400, 500, 600];
            } elseif ($capacity == 1000) {
                $insideValues = [100, 300, 500, 700, 800, 900, 1000];
            }
        @endphp
        
        @foreach($insideValues as $index => $value)
        <tr style="height:16pt">
            <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                <input type="text" 
                    value="{{ $value }}"
                    readonly
                    style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:10pt; color:#000; padding:4px;">
                <input type="hidden" 
                    name="inside_titik_ukur[{{ $index }}]" 
                    value="{{ $value }}">
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                <input type="text" 
                    name="inside_ulangan01[{{ $index }}]" 
                    value="{{ old("inside_ulangan01.{$index}") }}"
                    oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')"
                    style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:10pt; color:#000; padding:4px;"
                    placeholder="">
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                <input type="text" 
                    name="inside_ulangan02[{{ $index }}]" 
                    value="{{ old("inside_ulangan02.{$index}") }}"
                    oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')"
                    style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:10pt; color:#000; padding:4px;"
                    placeholder="">
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                <input type="text" 
                    name="inside_ulangan03[{{ $index }}]" 
                    value="{{ old("inside_ulangan03.{$index}") }}"
                    oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')"
                    style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:10pt; color:#000; padding:4px;"
                    placeholder="">
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                <input type="text" 
                    name="inside_ulangan04[{{ $index }}]" 
                    value="{{ old("inside_ulangan04.{$index}") }}"
                    oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')"
                    style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:10pt; color:#000; padding:4px;"
                    placeholder="">
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                <input type="text" 
                    name="inside_ulangan05[{{ $index }}]" 
                    value="{{ old("inside_ulangan05.{$index}") }}"
                    oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')"
                    style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:10pt; color:#000; padding:4px;"
                    placeholder="">
            </td>
        </tr>
        @endforeach
    </table>
</div>


                <!-- Footer Section -->
                <table class="kalibrasi-main-table">
                    <tr>
                        <td colspan="6" style="text-align: center; border-bottom: 1px solid #000;">
                            <span style="font-weight: bold; font-size: 18px; color: #000000;">Isilah lembar data kalibrasi dengan lengkap dan jelas!</span>
                        </td>
                    </tr>

                    <!-- ALAT STANDAR + CHECKBOX -->
                    <tr style="height:13.5pt">
                        <td rowspan="5" style="width:105.35pt; border:1pt solid #000; vertical-align:middle; text-align:center; font-weight:bold; font-size:10pt; color:#000000;">
                            Alat<br>Standar
                        </td>

                        <td style="width:24.75pt; border:1pt solid #000; text-align:center; vertical-align:middle;">
                            <input type="checkbox" name="alat_standar[]" value="Caliper Checker D.001" id="alat1">
                        </td>
                        <td colspan="2" style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
                            <label for="alat1" style="cursor:pointer; color:#000000;">Caliper Checker D.001</label>
                        </td>

                        <td rowspan="5" style="width:111.15pt; border:1pt solid #000; padding-top:6pt; text-align:center; vertical-align:top; font-size:8.5pt; color:#000000;">
                            Dikalibrasi<br>oleh
                        </td>
                        <td rowspan="5" style="width:98.3pt; border:1pt solid #000; padding-top:6pt; text-align:center; vertical-align:top; font-size:8.5pt; color:#000000;">
                            Diperiksa<br>oleh
                        </td>
                    </tr>

                    <tr style="height:13.5pt">
                        <td style="border:1pt solid #000; text-align:center; vertical-align:middle;">
                            <input type="checkbox" name="alat_standar[]" value="Caliper Checker D.001B" id="alat2">
                        </td>
                        <td colspan="2" style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
                            <label for="alat2" style="cursor:pointer; color:#000000;">Caliper Checker D.001B</label>
                        </td>
                    </tr>

                    <tr style="height:13.5pt">
                        <td style="border:1pt solid #000; text-align:center; vertical-align:middle;">
                            <input type="checkbox" name="alat_standar[]" value="Gauge Block Set Grade 0" id="alat3">
                        </td>
                        <td colspan="2" style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
                            <label for="alat3" style="cursor:pointer; color:#000000;">Gauge Block Set Grade 0</label>
                        </td>
                    </tr>

                    <tr style="height:13.5pt">
                        <td style="border:1pt solid #000; text-align:center; vertical-align:middle;">
                            <input type="checkbox" name="alat_standar[]" value="PIN Gauge 15 mm" id="alat4">
                        </td>
                        <td colspan="2" style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
                            <label for="alat4" style="cursor:pointer; color:#000000;">Pin Gauge 15 mm</label>
                        </td>
                    </tr>

                    <tr style="height:13.5pt">
                        <td style="border:1pt solid #000; text-align:center; vertical-align:middle;">
                            <input type="checkbox" name="alat_standar[]" value="Ring Gauge 5 mm" id="alat5">
                        </td>
                        <td colspan="2" style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
                            <label for="alat5" style="cursor:pointer; color:#000000;">Ring Gauge 5 mm</label>
                        </td>
                    </tr>

                    <!-- METODE KALIBRASI + TTD & NAMA -->
                    <tr style="height:15pt">
                        <td rowspan="2" style="width:105.35pt; border:1pt solid #000; padding:8.6pt 0 0 20.5pt; font-size:8.5pt; vertical-align:top; color:#000000;">
                            Metode Kalibrasi
                        </td>
                        <td colspan="3" rowspan="2" style="border:1pt solid #000; padding:3.2pt 5.25pt 0 8.85pt; font-size:8.5pt; line-height:112%; vertical-align:top; color:#000000;">
                            PAS-IK1102-03 (JIS B 7507:2022 (JMA/JSA); SNSU PK.P-02:2020).
                        </td>
                        <td style="width:111.15pt; border:1pt solid #000; padding:3.35pt 0 0 1.35pt; font-size:8.5pt; vertical-align:top; color:#000000;">
                            <input type="text" name="calibrated_by" class="kalibrasi-input" placeholder="Nama" style="border: none; width: 100%;" required>
                        </td>
                        <td style="width:98.3pt; border:1pt solid #000; padding:3.35pt 0 0 1.8pt; font-size:8.5pt; vertical-align:top; color:#000000;">
                            <input type="text" name="verified_by" class="kalibrasi-input" placeholder="Nama" style="border: none; width: 100%;" required>
                        </td>
                    </tr>

                    <tr style="height:11.95pt">
                        <td style="width:111.15pt; border:1pt solid #000; padding:1.8pt 0 0 1.35pt; font-size:8.5pt; vertical-align:top; color:#000000;">
                            TTD :
                        </td>
                        <td style="width:98.3pt; border:1pt solid #000; padding:1.8pt 0 0 1.8pt; font-size:8.5pt; vertical-align:top; color:#000000;">
                            TTD :
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
// Fungsi untuk mengupdate nilai titik ukur berdasarkan kapasitas
function updateMeasurementPoints(capacity) {
    // Update hidden input untuk kapasitas
    document.getElementById('selectedCapacity').value = capacity;
    
    // Data untuk outside (8 titik)
    const outsideData = {
        '300': [0, 20, 50, 100, 150, 200, 250, 300],
        '450': [0, 50, 100, 200, 300, 350, 400, 450],
        '600': [0, 50, 100, 200, 300, 400, 500, 600],
        '1000': [0, 100, 300, 500, 700, 800, 900, 1000]
    };
    
    // Data untuk inside (7 titik - tanpa 0)
    const insideData = {
        '300': [20, 50, 100, 150, 200, 250, 300],
        '450': [50, 100, 200, 300, 350, 400, 450],
        '600': [50, 100, 200, 300, 400, 500, 600],
        '1000': [100, 300, 500, 700, 800, 900, 1000]
    };
    
    // Update outside points
    const outsideValues = outsideData[capacity];
    for (let i = 0; i < 8; i++) {
        const outsideInput = document.getElementById(`outside_titik_${i}`);
        const outsideHidden = document.getElementById(`outside_hidden_${i}`);
        if (outsideInput && outsideHidden && outsideValues[i] !== undefined) {
            outsideInput.value = outsideValues[i];
            outsideHidden.value = outsideValues[i];
        }
    }
    
    // Update inside points
    const insideValues = insideData[capacity];
    for (let i = 0; i < 7; i++) {
        const insideInput = document.getElementById(`inside_titik_${i}`);
        const insideHidden = document.getElementById(`inside_hidden_${i}`);
        if (insideInput && insideHidden && insideValues[i] !== undefined) {
            insideInput.value = insideValues[i];
            insideHidden.value = insideValues[i];
        }
    }
}

// Set kapasitas awal berdasarkan query parameter atau default
window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    const capacityFromUrl = urlParams.get('capacity');
    const capacity = capacityFromUrl || '300';
    
    // Set dropdown value
    const selectElement = document.getElementById('capacitySelect');
    if (selectElement) {
        selectElement.value = capacity;
    }
    
    // Update titik ukur sesuai kapasitas awal
    updateMeasurementPoints(capacity);
};
</script>

<style>
/* Style untuk highlight perubahan */
.outside-row.changed, .inside-row.changed {
    background-color: #f0f8ff !important; /* Light blue untuk perubahan */
}

/* Style untuk row yang sedang aktif */
.outside-row.updating, .inside-row.updating {
    transition: background-color 0.3s ease;
}
</style>
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