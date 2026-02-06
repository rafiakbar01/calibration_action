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
        <!-- resources/views/formhtml/enclosure.blade.php -->
        <form method="POST" action="/calibrations" id="kalibrasiForm">
        @csrf
        <input type="hidden" name="form_type" id="form_type_input"  value="chamber">
        <input type="hidden" name="repetition" value="{{ $repetition ?? '' }}">

            <div class="form-kalibrasi-container">
                <table class="kalibrasi-header-table">
                    <tr>
                        <td colspan="2">
                            <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK29B</p>
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
                            <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">CLIMATIC CHAMBER</p>
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
                                    value="Climatic Chamber"
                                    placeholder="Climatic Chamber"
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
                
                <ol type="1" style="margin:0pt; padding-left:0pt">
        <li class="ListParagraph" style="margin-top:0.5pt; margin-left:10.05pt; text-indent:0pt; font-size:11pt; font-weight:bold; letter-spacing:-0.1pt">
          <span>Penempatan</span>
          <span style="letter-spacing:-0.05pt"></span>
          <span>Sensor</span>
        </li>
      </ol>
      <p style="margin-left:0.05pt; font-size:10pt">
            <!-- Gambar Kiri -->
            <div style="display: inline-block; vertical-align: top; text-align: center; margin-right: 20px;">
                <img src="/logo/foto_rektangular.png" width="350" height="190" alt="" 
                    style="border: 2px solid #000000; padding: 5px; -aw-left-pos:0pt; -aw-rel-hpos:column; -aw-rel-vpos:paragraph; -aw-top-pos:0pt; -aw-wrap-type:inline" />
                <div style="margin-top: 8px; font-family: Arial; font-size: 9pt; font-weight: bold; color: #000000; text-align: center;">
                Rektangular
                </div>
            </div>
            
            <!-- Spacer -->
            <span style="width:359.85pt; font-family:Arial; display:inline-block; -aw-tabstop-align:left; -aw-tabstop-pos:359.9pt">&#xa0;</span>
            
            <!-- Gambar Kanan -->
            <div style="display: inline-block; vertical-align: top; text-align: center; margin-left: 20px;">
                <img src="/logo/foto_silindrik.png" width="240" height="190" alt="" 
                    style="border: 2px solid #000000; padding: 5px; -aw-left-pos:0pt; -aw-rel-hpos:column; -aw-rel-vpos:paragraph; -aw-top-pos:0pt; -aw-wrap-type:inline" />
                <div style="margin-top: 8px; font-family: Arial; font-size: 9pt; font-weight: bold; color: #000000; text-align: center;">
                Silindrik atau Sferik
                </div>
            </div>
            </p>
      <p class="BodyText" style="margin-top:2.45pt">
        <span style="-aw-import:ignore">&#xa0;</span>
      </p>
      <?php
// Ambil nilai repetition dari controller
$repetition = $repetition ?? 1; // Default 1 jika tidak ada
$interval_waktu = [1, 2, 3, 4, 5, 13, 20, 30];
?>

@for($p = 1; $p <= $repetition; $p++)
<ol start="2" type="1" style="margin:0pt; padding-left:0pt">
    <li class="ListParagraph" style="margin-right:468.8pt; margin-bottom:2.65pt; text-indent:0pt; line-height:147%; font-size:11pt; font-weight:bold; letter-spacing:-0.1pt; list-style-position:inside">
        <span style="height:0pt; display:block; position:absolute; z-index:0">
            <img src="images/Aspose.Words.3583c371-5f86-44ec-a7f9-7c86fc979546.011.png" width="108" height="1" alt="" style="margin-top:23.16pt; margin-left:55.02pt; -aw-left-pos:75.02pt; -aw-rel-hpos:page; -aw-rel-vpos:paragraph; -aw-top-pos:23.16pt; -aw-wrap-type:none; position:absolute" />
        </span>
        <span>Data</span>
        <span style="letter-spacing:-0.45pt"></span>
        <span>Pengukuran</span>
        <span style="letter-spacing:normal"> Setting</span>
        <span style="letter-spacing:-0.05pt"></span>
        <span style="letter-spacing:normal">Suhu</span>
        <span style="letter-spacing:-0.05pt"></span>
        <span>ke-{{ $p }}</span>
        <span style="width:31.99pt; letter-spacing:normal; display:inline-block">&#xa0;</span>
        <span style="font-family:'Arial MT'; font-weight:normal; letter-spacing:-0.5pt">:</span>
       <input type="text"
       name="suhu_setting_{{ $p }}"
       value="{{ old('suhu_setting_'.$p, $detail->suhu_setting ?? '') }}"
       style="font-size:10pt;
              border:none;
              border-bottom:0.75pt solid #000;
              width:100pt;
              margin-left:5pt;
              background:transparent;
              color:#000;
              padding:0;
              font-family:'Arial MT';
              height:18pt;
              text-align:center;">
        <span style="font-family:Arial; font-size:7pt; font-weight:bold; letter-spacing:-0.25pt"></span>
        <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.25pt; vertical-align:-3pt; font-size:9pt;"></span>
    </li>
</ol>


<table cellspacing="0" cellpadding="0" class="TableNormal" style="width:100%; margin-left:0.48pt; border:2px solid #000000; border-collapse:collapse; margin-bottom: {{ $p < $repetition ? '40px' : '20px' }}">
    <tr style="background: #d9d9d9; height:14pt">
        <td style="width:8%; border:2px solid #000; vertical-align:middle; text-align:center">
            <span style="font-weight: bold; color: #000000; font-size:9pt">Interval Waktu</span>
        </td>
        <td colspan="2" style="border:2px solid #000; vertical-align:middle; text-align:center">
            <span style="font-weight: bold; color: #000000; font-size:9pt">Pembacaan Alat</span>
        </td>
        <td colspan="10" style="border:2px solid #000; vertical-align:middle; text-align:center">
            <span style="font-weight: bold; color: #000000; font-size:9pt">Pembacaan Sensor</span>
        </td>
    </tr>
    <tr style="background: #e8e8e8; height:13pt">
        <td style="border:2px solid #000; vertical-align:middle; text-align:center">
            <span style="font-weight:bold; color:#000000; font-size:9pt;">(Menit)</span>
        </td>
        
        <td style="width:8%; border:2px solid #000; vertical-align:middle; text-align:center">
            <span style="font-family:Arial; font-size:6pt; font-weight:bold; letter-spacing:-0.25pt">o</span>
            <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.25pt; vertical-align:-3pt; font-size:9pt;">C</span>
        </td>
        <td style="width:8%; border:2px solid #000; vertical-align:middle; text-align:center">
            <span style="font-weight: bold; color: #000000; font-size:9pt">%</span>
        </td>
        <td style="width:7.2%; border:2px solid #   000; vertical-align:middle; text-align:center">
            <span style="font-weight: bold; color: #000000; font-size:9pt">1</span>
        </td>
        <td style="width:7.2%; border:2px solid #000; vertical-align:middle; text-align:center">
            <span style="font-weight: bold; color: #000000; font-size:9pt">2</span>
        </td>
        <td style="width:7.2%; border:2px solid #000; vertical-align:middle; text-align:center">
            <span style="font-weight: bold; color: #000000; font-size:9pt">3</span>
        </td>
        <td style="width:7.2%; border:2px solid #000; vertical-align:middle; text-align:center">
            <span style="font-weight: bold; color: #000000; font-size:9pt">4</span>
        </td>
        <td style="width:7.2%; border:2px solid #000; vertical-align:middle; text-align:center">
            <span style="font-weight: bold; color: #000000; font-size:9pt">5</span>
        </td>
        <td style="width:7.2%; border:2px solid #000; vertical-align:middle; text-align:center">
            <span style="font-weight: bold; color: #000000; font-size:9pt">6</span>
        </td>
        <td style="width:7.2%; border:2px solid #000; vertical-align:middle; text-align:center">
            <span style="font-weight: bold; color: #000000; font-size:9pt">7</span>
        </td>
        <td style="width:7.2%; border:2px solid #000; vertical-align:middle; text-align:center">
            <span style="font-weight: bold; color: #000000; font-size:9pt">8</span>
        </td>
        <td style="width:7.2%; border:2px solid #000; vertical-align:middle; text-align:center">
            <span style="font-weight: bold; color: #000000; font-size:9pt">9</span>
        </td>
        <td style="width:8%; border:2px solid #000; vertical-align:middle; text-align:center">
            <span style="font-weight: bold; color: #000000; font-size:9pt">%</span>
        </td>
    </tr>
    
    @foreach($interval_waktu as $interval)
    <tr style="height:22pt;">
        <td style="border:2px solid #000; padding:0; vertical-align:middle;">
            <input type="text" name="interval_{{ $p }}_{{ $interval }}" readonly value="{{ $interval }}" style="width:100%;height:100%;border:none;background:transparent;text-align:center;font-size:10pt;color:#000;padding:2px;font-weight:bold;box-sizing:border-box;">
        </td>
        
      
        
        <!-- Kolom °C untuk Pembacaan Alat -->
        <td style="border:2px solid #000; padding:0; vertical-align:middle;">
            <input type="text" name="alat_{{ $p }}_{{ $interval }}" value="" oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" style="width:100%;height:100%;border:none;background:transparent;text-align:center;font-size:10pt;color:#000;padding:2px;box-sizing:border-box;">
        </td>
          <!-- Kolom % untuk Pembacaan Alat -->
          <td style="border:2px solid #000; padding:0; vertical-align:middle;">
            <input type="text" name="alat_percent_{{ $p }}_{{ $interval }}" value="" oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" style="width:100%;height:100%;border:none;background:transparent;text-align:center;font-size:10pt;color:#000;padding:2px;box-sizing:border-box;">
        </td>
        
        <!-- Kolom Sensor 1-9 -->
        @for($s = 1; $s <= 9; $s++)
        <td style="border:2px solid #000; padding:0; vertical-align:middle;">
            <input type="text" name="sensor_{{ $p }}_{{ $interval }}_{{ $s }}" value="" oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" style="width:100%;height:100%;border:none;background:transparent;text-align:center;font-size:10pt;color:#000;padding:2px;box-sizing:border-box;">
        </td>
        @endfor
        
        <!-- Kolom % setelah Sensor 9 -->
        <td style="border:2px solid #000; padding:0; vertical-align:middle;">
            <input type="text" name="sensor_percent_{{ $p }}_{{ $interval }}" value="" oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')" style="width:100%;height:100%;border:none;background:transparent;text-align:center;font-size:10pt;color:#000;padding:2px;box-sizing:border-box;">
        </td>
    </tr>
    @endforeach
</table>
@endfor

                <div style="height: 50px;"></div>


                <table class="kalibrasi-main-table" style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
    <!-- HEADER FOOTER -->
    <tr>
        <td colspan="7" style="text-align: center; border: 1px solid #000; border-bottom: none; padding: 10px 0;">
            <span style="font-weight: bold; font-size: 18px; color: #000000;">Isilah lembar data kalibrasi dengan lengkap dan jelas!</span>
        </td>
    </tr>

    <!-- ROW 1: TEMPERATURE -->
    <tr>
        <td rowspan="2" style="width: 15%; border: 1px solid #000; text-align: center; vertical-align: middle; font-weight: bold; font-size: 10pt; padding: 8px; background-color: #f0f0f0;">
            Alat<br>Standar
        </td>
        <td style="width: 15%; border: 1px solid #000; text-align: left; vertical-align: middle; font-size: 9pt; padding: 8px;">
            - Temperature
        </td>
        <td style="width: 10%; border: 1px solid #000; text-align: center; vertical-align: middle; font-size: 9pt; padding: 8px;">
            <div style="display: flex; align-items: center; justify-content: center;">
                <input type="checkbox" name="alat_standar[]" value="GL-220" id="gl220" 
                       style="transform: scale(1.2); margin-right: 8px;">
                <label for="gl220" style="cursor: pointer; font-weight: normal;">GL-220</label>
            </div>
        </td>
        <td style="width: 10%; border: 1px solid #000; text-align: center; vertical-align: middle; font-size: 9pt; padding: 8px;">
            <div style="display: flex; align-items: center; justify-content: center;">
                <input type="checkbox" name="alat_standar[]" value="GL-240" id="gl240" 
                       style="transform: scale(1.2); margin-right: 8px;">
                <label for="gl240" style="cursor: pointer; font-weight: normal;">GL-240</label>
            </div>
        </td>
        <td style="width: 10%; border: 1px solid #000; text-align: center; vertical-align: middle; font-size: 9pt; padding: 8px;">
            <div style="display: flex; align-items: center; justify-content: center;">
                <input type="checkbox" name="alat_standar[]" value="Huato" id="huato" 
                       style="transform: scale(1.2); margin-right: 8px;">
                <label for="huato" style="cursor: pointer; font-weight: normal;">Huato</label>
            </div>
        </td>
        <td rowspan="2" style="width: 20%; border: 1px solid #000; text-align: center; vertical-align: middle; font-weight: bold; font-size: 9pt; padding: 8px; background-color: #f0f0f0;">
            Dikalibrasi<br>oleh
        </td>
        <td rowspan="2" style="width: 20%; border: 1px solid #000; text-align: center; vertical-align: middle; font-weight: bold; font-size: 9pt; padding: 8px; background-color: #f0f0f0;">
            Diperiksa<br>oleh
        </td>
    </tr>

    <!-- ROW 2: KELEMBABAN -->
    <tr>
        <td style="border: 1px solid #000; text-align: left; vertical-align: middle; font-size: 9pt; padding: 8px;">
            - Kelembaban
        </td>
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle; font-size: 9pt; padding: 8px;">
            <div style="display: flex; align-items: center; justify-content: center;">
                <input type="checkbox" name="alat_standar[]" value="Rotronic" id="rotronic" 
                       style="transform: scale(1.2); margin-right: 8px;">
                <label for="rotronic" style="cursor: pointer; font-weight: normal;">Rotronic</label>
            </div>
        </td>
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle; font-size: 9pt; padding: 8px;">
            <div style="display: flex; align-items: center; justify-content: center;">
                <input type="checkbox" name="alat_standar[]" value="Lutron" id="lutron" 
                       style="transform: scale(1.2); margin-right: 8px;">
                <label for="lutron" style="cursor: pointer; font-weight: normal;">Lutron</label>
            </div>
        </td>
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle; font-size: 9pt; padding: 8px;">
            &nbsp;
        </td>
    </tr>

   
      <!-- ROW 3: METODE KALIBRASI, TTD DAN NAMA DALAM SATU BARIS -->
      <tr>
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle; font-weight: bold; font-size: 9pt; padding: 8px; background-color: #f0f0f0;">
            Metode<br>Kalibrasi
        </td>
        <td colspan="4" style="border: 1px solid #000; text-align: left; vertical-align: middle; font-size: 9pt; padding: 8px;">
            PAS-IK1102-29B
        </td>
        <td style="border: 1px solid #000; text-align: left; vertical-align: middle; font-size: 9pt; padding: 8px;">
            <div style="margin-bottom: 10px;"><strong>TTD :</strong></div>
            <div><strong>Nama :</strong>
                <input type="text" name="calibrated_by" value="" 
                       style="width: calc(100% - 45px); border: none; border-bottom: 1px solid #000; background: transparent; font-size: 9pt; padding: 2px 5px; margin-left: 5px;"
                       placeholder="Nama Lengkap">
            </div>
        </td>
        <td style="border: 1px solid #000; text-align: left; vertical-align: middle; font-size: 9pt; padding: 8px;">
            <div style="margin-bottom: 10px;"><strong>TTD :</strong></div>
            <div><strong>Nama :</strong>
                <input type="text" name="verified_by" value="" 
                       style="width: calc(100% - 45px); border: none; border-bottom: 1px solid #000; background: transparent; font-size: 9pt; padding: 2px 5px; margin-left: 5px;"
                       placeholder="Nama Lengkap">
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
    function updateFormType(selectedAlat) {
        // Normalize input (case-insensitive)
        const alat = selectedAlat.toLowerCase().trim();
        
        // SEMUA alat menggunakan form_type 'enclosure'
        const formTypeMap = {
            'oven': 'enclosure',
            'freezer': 'enclosure', 
            'furnace': 'enclosure',
            'incubator': 'enclosure',
            'waterbath': 'enclosure',
            'autoclave': 'enclosure'
            // Tidak perlu 'enclosure' karena tidak ada di dropdown
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