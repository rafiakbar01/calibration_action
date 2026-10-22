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
        <input type="hidden" name="form_type" id="form_type_input"  value="volumetrik">
        <input type="hidden" name="kategori_alat" value="volumetrik">



            <div class="form-kalibrasi-container">
                <table class="kalibrasi-header-table">
                    <tr>
                        <td colspan="2">
                            <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK38</p>
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
                            <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">VOLUMETRIK</p>
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
        <select name="nama_alat" id="nama_alat_select" class="kalibrasi-input" onchange="updateFormType(this.value)" required style="background-color: #f5f5f5; color: #333; border: 1px solid #ced4da; padding: 6px 10px; border-radius: 4px; width: 100%;">
            <option value="">-- Pilih Alat --</option>
            <option value="Buret">Buret</option>
            <option value="Gelas Ukur">Gelas Ukur</option>
            <option value="Pipet Ukur">Pipet Ukur</option>
            <option value="Labu Ukur">Labu Ukur</option>
            <option value="Pipet Volume">Pipet Volume</option>
            <option value="MANUAL_INPUT">-- Input Manual Nama Alat --</option>
        </select>
        
        <!-- Input Manual - HIDANG AWALNYA -->
        <div id="manualInputContainer" style="display: none; margin-top: 10px;">
            <input type="text" name="nama_alat_manual" id="nama_alat_manual"
                   placeholder="Ketik nama alat volumetrik secara manual"
                   style="background-color: #f5f5f5; color: #333; border: 1px solid #ced4da; padding: 6px 10px; border-radius: 4px; width: 100%;"
                   oninput="syncNamaAlat()">
        </div>
        
        <!-- Hidden input untuk menyimpan nama alat final (auto-created by JS) -->
        <input type="hidden" name="nama_alat_final" id="nama_alat_final" value="">
        
    
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
                            <input type="text" name="lokasi_pt" class="kalibrasi-input" placeholder="Masukkan Lokasi PT" >
                        </td>
                    </tr>
                    
                     <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Kode TH</p>
                        </td>
                        <td colspan="3">
                            <input type="text" name="kode_th" class="kalibrasi-input" placeholder="Masukkan Kode TH" >
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
                                    <td><input type="text"  name="suhu_awal" class="kondisi-input" required></td>
                                    <td><input type="text"  name="suhu_tengah" class="kondisi-input" required></td>
                                    <td><input type="text"  name="suhu_akhir" class="kondisi-input" required></td>
                                </tr>
                                <tr>
                                    <td class="bg-light fw-bold" style="color: #000000;">RH (%)</td>
                                    <td><input type="text"  name="rh_awal" class="kondisi-input" required></td>
                                    <td><input type="text"  name="rh_tengah" class="kondisi-input" required></td>
                                    <td><input type="text"  name="rh_akhir" class="kondisi-input" required></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                <!-- Data Kalibrasi Section -->
                <div class="data-kalibrasi-header" style="color: #000000;">DATA KALIBRASI</div>
                
              <table cellspacing="0" cellpadding="0" style="width:100%; max-width:800pt; margin:10pt 0; border:2pt solid #000; border-collapse:collapse; font-family:Arial,Helvetica,sans-serif;">

<!-- Header Baris 1 -->
<tr style="height:45pt;">
    <td rowspan="2" style="width:160pt; border:2pt solid #000; background:#f0f0f0; text-align:center; vertical-align:middle;">
        <p style="margin:0; font-size:15pt; font-weight:bold;">Nominal Alat Ukur</p>
       <p style="margin-top:10pt; font-size:12pt;">
    (
    <input type="text" name="satuan_alatUkur"
           value="{{ old('satuan_alatUkur', $satuan_alatUkur ?? '') }}"
           style="border:none; outline:none; font-size:12pt; width:150px; text-align:center; background:none;"
           placeholder="......">
    )
</p>

    </td>
    <td colspan="2" style="width:320pt; border:2pt solid #000; border-left:1pt solid #000; background:#f0f0f0; text-align:center; vertical-align:middle;">
        <p style="margin:0; font-size:15pt; font-weight:bold;">Pembacaan Timbangan (g)</p>
    </td>
    <td rowspan="2" style="width:140pt; border:2pt solid #000; border-left:1pt solid #000; background:#f0f0f0; text-align:center; vertical-align:middle;">
        <p style="margin:0; font-size:15pt; font-weight:bold;">Suhu Air Suling</p>
        <p style="margin-top:8pt; font-size:15pt;">°C</p>
    </td>
    <td rowspan="2" style="width:140pt; border:2pt solid #000; border-left:1pt solid #000; background:#f0f0f0; text-align:center; vertical-align:middle;">
        <p style="margin:0; font-size:15pt; font-weight:bold;">Tekanan Udara</p>
        <p style="margin-top:8pt; font-size:15pt;">hPa</p>
    </td>
</tr>

<!-- Header Baris 2 -->
<tr style="height:40pt;">
    <td style="width:160pt; border:2pt solid #000; border-top:1pt solid #000; border-left:1pt solid #000; background:#f0f0f0; text-align:center; vertical-align:middle;">
        <p style="margin:0; font-size:14pt; font-weight:bold;">Massa Kosong</p>
    </td>
    <td style="width:160pt; border:2pt solid #000; border-top:1pt solid #000; border-left:1pt solid #000; background:#f0f0f0; text-align:center; vertical-align:middle;">
        <p style="margin:0; font-size:14pt; font-weight:bold;">Massa Isi</p>
    </td>
</tr>

<!-- 5 Nominal x 3 Pengulangan = 15 baris data -->
@for ($nominal = 1; $nominal <= 5; $nominal++)
    @for ($repeat = 1; $repeat <= 3; $repeat++)
    <tr style="height:32pt;">
        @if ($repeat == 1)
        <td rowspan="3" style="width:160pt; border:2pt solid #000; vertical-align:middle; text-align:center;">
            <input type="text"  name="nominal_{{ $nominal }}" 
                   style="width:100%; height:100%; border:none; background:transparent; font-size:13pt; text-align:center;">
        </td>
        @endif

        <td style="width:160pt; border:2pt solid #000; border-left:1pt solid #000; vertical-align:middle; text-align:center;">
            <input type="text"  name="massa_kosong_{{ $nominal }}_{{ $repeat }}" 
                   style="width:100%; height:100%; border:none; background:transparent; font-size:13pt; text-align:center;">
        </td>
        <td style="width:160pt; border:2pt solid #000; border-left:1pt solid #000; vertical-align:middle; text-align:center;">
            <input type="text"  name="massa_isi_{{ $nominal }}_{{ $repeat }}" 
                   style="width:100%; height:100%; border:none; background:transparent; font-size:13pt; text-align:center;">
        </td>
        <td style="width:140pt; border:2pt solid #000; border-left:1pt solid #000; vertical-align:middle; text-align:center;">
            <input type="text"  name="suhu_{{ $nominal }}_{{ $repeat }}" 
                   style="width:100%; height:100%; border:none; background:transparent; font-size:13pt; text-align:center;">
        </td>
        <td style="width:140pt; border:2pt solid #000; border-left:1pt solid #000; vertical-align:middle; text-align:center;">
            <input type="text"  name="tekanan_{{ $nominal }}_{{ $repeat }}" 
                   style="width:100%; height:100%; border:none; background:transparent; font-size:13pt; text-align:center;">
        </td>
    </tr>
    @endfor
@endfor

</table>


        
        <p style="margin-top:2.15pt; margin-left:18.8pt; margin-bottom:1.05pt; font-size:15pt">
            <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.1pt">REPEATABILITY</span>
        </p>
        <table cellspacing="0" cellpadding="0" class="TableNormal" 
               style="margin-left:10pt; width:100%; max-width:750pt; border:2pt solid #000000; border-collapse:collapse; font-family:Arial;">
        
            <!-- Header -->
            <tr style="height:35pt">
                <td rowspan="2" style="width:140pt; border:2pt solid #000000; vertical-align:middle; background-color:#d9d9d9; text-align:center;">
                    <p style="margin:0; font-size:14pt; font-weight:bold;">Nominal Alat Ukur</p>
                    <p style="margin-top:10pt; font-size:12pt;">
            (
            <input type="text" name="satuan_rep"
                   value="{{ old('satuan_rep', $satuan_rep ?? '') }}"
                   style="border:none; outline:none; font-size:12pt; width:150px; text-align:center; background:none;"
                   placeholder="......">
            )
                    </p>
                </td>
                <td colspan="2" style="width:280pt; border:2pt solid #000000; border-left:1pt solid #000; vertical-align:middle; background-color:#d9d9d9; text-align:center;">
                    <p style="margin:0; font-size:14pt; font-weight:bold;">Pembacaan Timbangan (g)</p>
                </td>
                <td rowspan="2" style="width:120pt; border:2pt solid #000000; border-left:1pt solid #000; vertical-align:middle; background-color:#d9d9d9; text-align:center;">
                    <p style="margin:0; font-size:14pt; font-weight:bold;">Suhu Air Suling</p>
                    <p style="margin-top:5pt; font-size:14pt;">°C</p>
                </td>
                <td rowspan="2" style="width:120pt; border:2pt solid #000000; border-left:1pt solid #000; vertical-align:middle; background-color:#d9d9d9; text-align:center;">
                    <p style="margin:0; font-size:14pt; font-weight:bold;">Tekanan Udara</p>
                    <p style="margin-top:5pt; font-size:14pt;">hPa</p>
                </td>
            </tr>
        
            <tr style="height:30pt">
                <td style="width:140pt; border:2pt solid #000000; border-top:1pt solid #000; border-left:1pt solid #000; vertical-align:middle; background-color:#d9d9d9; text-align:center;">
                    <p style="margin:0; font-size:12pt; font-weight:bold;">Massa Kosong</p>
                </td>
                <td style="width:140pt; border:2pt solid #000000; border-top:1pt solid #000; border-left:1pt solid #000; vertical-align:middle; background-color:#d9d9d9; text-align:center;">
                    <p style="margin:0; font-size:12pt; font-weight:bold;">Massa Isi</p>
                </td>
            </tr>
        
            <!-- 10 baris input untuk repeatability -->
            @for($i = 1; $i <= 10; $i++)
            <tr style="height:25pt">
                <!-- Input nominal hanya di baris pertama -->
                @if($i == 1)
                <td rowspan="10" style="width:140pt; border:2pt solid #000000; vertical-align:middle; text-align:center;">
                    <input type="text"  name="repeatability_nominal" 
                           value="{{ old('repeatability_nominal', $repeatability_nominal ?? '') }}"
                           style="width:100%; height:100%; border:none; font-size:12pt; text-align:center; background:transparent;" 
                           placeholder="Masukkan nominal">
                </td>
                @endif
        
                <!-- Input data untuk setiap baris -->
                <td style="width:140pt; border:2pt solid #000000; border-left:1pt solid #000; vertical-align:middle;">
                    <input type="text"  name="repeat_massa_kosong_{{ $i }}" 
                           value="{{ old('repeat_massa_kosong_' . $i, ${'repeat_massa_kosong_' . $i} ?? '') }}"
                           style="width:100%; height:100%; border:none; font-size:12pt; text-align:center; background:transparent;" 
                           >
                </td>
                <td style="width:140pt; border:2pt solid #000000; border-left:1pt solid #000; vertical-align:middle;">
                    <input type="text"  name="repeat_massa_isi_{{ $i }}" 
                           value="{{ old('repeat_massa_isi_' . $i, ${'repeat_massa_isi_' . $i} ?? '') }}"
                           style="width:100%; height:100%; border:none; font-size:12pt; text-align:center; background:transparent;" 
                          >
                </td>
                <td style="width:120pt; border:2pt solid #000000; border-left:1pt solid #000;   vertical-align:middle;">
                    <input type="text"  name="repeat_suhu_{{ $i }}" 
                           value="{{ old('repeat_suhu_' . $i, ${'repeat_suhu_' . $i} ?? '') }}"
                           style="width:100%; height:100%; border:none; font-size:12pt; text-align:center; background:transparent;" 
                          >
                </td>
                <td style="width:120pt; border:2pt solid #000000; border-left:1pt solid #000; vertical-align:middle;">
                    <input type="text"  name="repeat_tekanan_{{ $i }}" 
                           value="{{ old('repeat_tekanan_' . $i, ${'repeat_tekanan_' . $i} ?? '') }}"
                           style="width:100%; height:100%; border:none; font-size:12pt; text-align:center; background:transparent;" 
                          >
                </td>
            </tr>
            @endfor
        
        </table>

                <div style="height: 50px;"></div>


                <table class="kalibrasi-main-table" style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
                    <!-- HEADER -->
                    <tr>
                        <td colspan="7" style="text-align: center; border: 1px solid #000; border-bottom: none; padding: 10px 0;">
                            <span style="font-weight: bold; font-size: 18px; color: #000000;">Isilah lembar data kalibrasi dengan lengkap dan jelas!</span>
                        </td>
                    </tr>

                    <!-- ALAT STANDAR + DETAIL ALAT -->
                    <tr style="height: 40px;">
                        <td rowspan="5" style="width: 15%; border: 1px solid #000; vertical-align: middle; text-align: center; font-weight: bold; font-size: 10pt; color: #000000; background-color: #f8f9fa;">
                            Alat<br>Standar
                        </td>

                        <!-- Kolom Checkbox -->
                        <td style="width: 5%; border: 1px solid #000; text-align: center; vertical-align: middle;">
                            <input type="checkbox" name="alat_standar[]" value="Semi Microbalance, BEL, Res 0.01 mg (0~200ml)" 
                                style="transform: scale(1.2); cursor: pointer;">
                        </td>
                        
                        <!-- Nama Alat -->
                        <td colspan="2" style="border: 1px solid #000; padding-left: 12px; font-size: 9pt; vertical-align: middle; color: #000000;">
                            - Semi Microbalance, BEL, Res 0.01 mg (0~200 ml)
                        </td>

                        <!-- Dikalibrasi oleh -->
                        <td rowspan="5" style="width: 15%; border: 1px solid #000; text-align: center; vertical-align: top; font-size: 9pt; color: #000000; background-color: #f8f9fa; padding-top: 15px;">
                            <strong>Dikalibrasi<br>oleh</strong>
                        </td>
                        <!-- Diperiksa oleh -->
                        <td rowspan="5" style="width: 15%; border: 1px solid #000; text-align: center; vertical-align: top; font-size: 9pt; color: #000000; background-color: #f8f9fa; padding-top: 15px;">
                            <strong>Diperiksa<br>oleh</strong>
                        </td>
                    </tr>

                    <!-- Baris ke-2 -->
                    <tr style="height: 40px;">
                        <td style="border: 1px solid #000; text-align: center; vertical-align: middle;">
                            <input type="checkbox" name="alat_standar[]" value="Semi Microbalance, Radwag, Res 0.1 mg (0~200ml)" 
                                style="transform: scale(1.2); cursor: pointer;">
                        </td>
                        <td colspan="2" style="border: 1px solid #000; padding-left: 12px; font-size: 9pt; vertical-align: middle; color: #000000;">
                            - Semi Microbalance, Radwag, Res 0.1 mg (0~200 ml)
                        </td>
                    </tr>

                    <!-- Baris ke-3 -->
                    <tr style="height: 40px;">
                        <td style="border: 1px solid #000; text-align: center; vertical-align: middle;">
                            <input type="checkbox" name="alat_standar[]" value="Semi Microbalance, AND, Res 0.1 mg (0~200ml)" 
                                style="transform: scale(1.2); cursor: pointer;">
                        </td>
                        <td colspan="2" style="border: 1px solid #000; padding-left: 12px; font-size: 9pt; vertical-align: middle; color: #000000;">
                            - Semi Microbalance, AND, Res 0.1 mg (0~200 ml)
                        </td>
                    </tr>

                    <!-- Baris ke-4 -->
                    <tr style="height: 40px;">
                        <td style="border: 1px solid #000; text-align: center; vertical-align: middle;">
                            <input type="checkbox" name="alat_standar[]" value="Timbangan Digital, AND, Res 0.01 g" 
                                style="transform: scale(1.2); cursor: pointer;">
                        </td>
                        <td colspan="2" style="border: 1px solid #000; padding-left: 12px; font-size: 9pt; vertical-align: middle; color: #000000;">
                            - Timbangan Digital, AND, Res 0.01 g
                        </td>
                    </tr>

                    <!-- Baris ke-5 -->
                    <tr style="height: 40px;">
                        <td style="border: 1px solid #000; text-align: center; vertical-align: middle;">
                            <input type="checkbox" name="alat_standar[]" value="Timbangan Digital, Rinstrum, Res 0.1g (200~1000ml)" 
                                style="transform: scale(1.2); cursor: pointer;">
                        </td>
                        <td colspan="2" style="border: 1px solid #000; padding-left: 12px; font-size: 9pt; vertical-align: middle; color: #000000;">
                            - Timbangan Digital, Rinstrum, Res 0.1g (200~1000 ml)
                        </td>
                    </tr>

                    <!-- METODE KALIBRASI + INPUT NAMA -->
                    <tr style="height: 50px;">
                        <td style="width: 15%; border: 1px solid #000; text-align: center; vertical-align: middle; font-size: 9pt; color: #000000; background-color: #f8f9fa;">
                            <strong>Metode<br>Kalibrasi</strong>
                        </td>
                        <td colspan="3" style="border: 1px solid #000; padding: 10px; font-size: 9pt; vertical-align: middle; color: #000000; line-height: 1.4;">
                            PAS-IK1102-38 (Volumetrik Glassware)
                        </td>
                        
                        <!-- Input Nama Dikalibrasi Oleh -->
                        <td style="width: 15%; border: 1px solid #000; padding: 5px; font-size: 9pt; vertical-align: middle; color: #000000;">
                            <div style="margin-bottom: 5px;">
                                <input type="text" 
                                    name="calibrated_by" 
                                    class="kalibrasi-input" 
                                    placeholder="Nama Lengkap" 
                                    style="width: 100%; border: none; border-bottom: 1px solid #000; outline: none; padding: 5px 0; font-size: 9pt; background: transparent;"
                                    required readonly value="{{ auth()->user()->nama ?? 'System' }}">
                            </div>
                            <div style="margin-top: 10px; font-weight: bold; font-size: 9pt;">
                                TTD :
                            </div>
                        </td>
                        
                        <!-- Input Nama Diperiksa Oleh -->
                        <td style="width: 15%; border: 1px solid #000; padding: 5px; font-size: 9pt; vertical-align: middle; color: #000000;">
                            <div style="margin-bottom: 5px;">
                                <input type="text" 
                                    name="verified_by" 
                                    class="kalibrasi-input" 
                                    placeholder="-" 
                                    style="width: 100%; border: none; border-bottom: 1px solid #000; outline: none; padding: 5px 0; font-size: 9pt; background: transparent;"
                                    readonly>
                            </div>
                            <div style="margin-top: 10px; font-weight: bold; font-size: 9pt;">
                                TTD :
                            </div>
                        </td>
                    </tr>
                </table>    


                <!-- Submit Button Section -->
                 <!-- Submit Button Section -->
                  <!-- Submit Button Section -->
                  <div class="row mt-5">
                    <div class="col-12 text-center">
                        <button type="button" id="btnSimpanSemua" class="btn btn-primary btn-lg" onclick="submitSemuaForm()" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
                            <i class="fas fa-save me-2"></i>Simpan Data Kalibrasi
                        </button>
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

// ==========================================
// STORAGE PER TAB - GLOBAL
// ==========================================
if (typeof window.tempFormDataStore === 'undefined') {
    window.tempFormDataStore = {};
}
if (typeof window.isRestoring === 'undefined') {
    window.isRestoring = false;
}
if (typeof window.tabSubmitStatus === 'undefined') {
    window.tabSubmitStatus = {};
}

// ==========================================
// FUNGSI GET TAB AKTIF
// ==========================================
function getActiveTabId() {
    const activePane = document.querySelector('.tab-pane.active');
    if (activePane && activePane.id && activePane.id.startsWith('lk-pane-')) {
        const tabId = activePane.id.replace('lk-pane-', '');
        currentActiveTabId = tabId;
        return tabId;
    }
    
    const activeTabButton = document.querySelector('.nav-link.active');
    if (activeTabButton && activeTabButton.id && activeTabButton.id.startsWith('lk-tab-')) {
        const tabId = activeTabButton.id.replace('lk-tab-', '');
        currentActiveTabId = tabId;
        return tabId;
    }
    
    const containers = document.querySelectorAll('.lk-form-container');
    for (let i = 0; i < containers.length; i++) {
        const style = window.getComputedStyle(containers[i]);
        if (style.display !== 'none') {
            const tabId = containers[i].getAttribute('data-lk-id');
            if (tabId) return tabId;
        }
    }
    
    return currentActiveTabId;
}

function updateActiveTab(tabId) {
    currentActiveTabId = tabId;
    console.log(`🔄 Global active tab updated to: ${tabId}`);
}

// ==========================================
// FUNGSI UNTUK MENONAKTIFKAN REQUIRED PADA FORM YANG TIDAK VISIBLE
// ==========================================
function disableRequiredOnHiddenForms() {
    console.log('🔧 disableRequiredOnHiddenForms called');
    
    const allForms = document.querySelectorAll('form[id^="kalibrasiForm"]');
    
    allForms.forEach((form, index) => {
        const formIndex = index + 1;
        const container = form.closest('.lk-form-container');
        const isVisible = container && window.getComputedStyle(container).display !== 'none';
        
        console.log(`📌 Form ${formIndex}: isVisible=${isVisible}`);
        
        const requiredInputs = form.querySelectorAll('[required]');
        
        if (!isVisible) {
            requiredInputs.forEach(input => {
                console.log(`🔧 Disabling required for: ${input.name}`);
                input.removeAttribute('required');
                input.setAttribute('data-required-temp', 'true');
            });
        } else {
            requiredInputs.forEach(input => {
                if (input.hasAttribute('data-required-temp')) {
                    console.log(`🔧 Re-enabling required for: ${input.name}`);
                    input.setAttribute('required', 'required');
                    input.removeAttribute('data-required-temp');
                }
            });
        }
    });
}

function restoreRequiredOnAllForms() {
    const allForms = document.querySelectorAll('form[id^="kalibrasiForm"]');
    allForms.forEach(form => {
        form.querySelectorAll('[data-required-temp]').forEach(input => {
            input.setAttribute('required', 'required');
            input.removeAttribute('data-required-temp');
        });
    });
}

// ==========================================
// UPDATE FORM TYPE
// ==========================================
function updateFormType(selectedAlat) {
    const manualInputContainer = document.getElementById('manualInputContainer');
    const manualInput = document.getElementById('nama_alat_manual');
    const finalInput = document.getElementById('nama_alat_final');
    
    if (!manualInputContainer || !manualInput) return;
    
    if (selectedAlat === 'MANUAL_INPUT') {
        manualInputContainer.style.display = 'block';
        manualInput.required = true;
        if (finalInput) finalInput.value = '';
    } else {
        manualInputContainer.style.display = 'none';
        manualInput.required = false;
        manualInput.value = '';
        if (finalInput && selectedAlat) finalInput.value = selectedAlat;
    }
}

function syncNamaAlat() {
    const manualInput = document.getElementById('nama_alat_manual');
    const finalInput = document.getElementById('nama_alat_final');
    if (manualInput && finalInput) {
        finalInput.value = manualInput.value;
    }
}

function formatNumberInput(input) {
    if (!input) return;
    let value = input.value;
    if (value === '' || value === null) return;
    value = value.toString().replace(/,/g, '');
    if (!isNaN(value) && value !== '') {
        let num = parseFloat(value);
        if (!isNaN(num)) input.value = num.toString();
    }
}

function escapeHtml(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// ==========================================
// HANDLE SAVE SUCCESS
// ==========================================
window.handleSaveSuccess = function(tabId, data) {
    console.log('🎉 handleSaveSuccess called for tab:', tabId, data);
    
    const container = document.querySelector(`.lk-form-container[data-lk-id="${tabId}"]`);
    if (!container) {
        console.error(`Container for tab ${tabId} not found!`);
        return;
    }

    const tabButton = document.getElementById(`lk-tab-${tabId}`);
    if (tabButton) {
        tabButton.classList.add('tab-saved');
        const badge = tabButton.querySelector('.badge');
        if (badge) {
            badge.className = 'badge badge-success ml-1';
            badge.innerHTML = '<i class="fas fa-check mr-1"></i>Tersimpan';
        }
    }

    const formName = container.getAttribute('data-form-name') || 'Volumetrik';
    const calibrationId = data.calibration_id || data.id || '-';
    const printLabelUrl = data.print_label_url || `/calibrations/${calibrationId}/print-label`;
    
    tabSubmitStatus[tabId] = {
        success: true,
        calibrationId: calibrationId,
        printLabelUrl: printLabelUrl,
        formName: formName,
        timestamp: Date.now()
    };
    
    container.innerHTML = `
      <div class="save-success-overlay text-center p-5 fade-in" style="background: white; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.08);">
       <div class="mb-4">
                    <i class="fas fa-check-circle text-success fa-5x"></i>
                </div>
                <h3 class="text-success mb-2">Simpan Berhasil!</h3>
                <p class="mb-3" style="color: black;">Data kalibrasi untuk <strong>${escapeHtml(formName)}</strong> telah berhasil disimpan ke database.</p>
                
                <div class="d-inline-block mb-4 p-3" style="border-radius: 12px; text-align: left; background: white; border: 1px solid #ddd;">
                    <i class="fas fa-info-circle mr-2" style="color: #0d6efd;"></i>
                    <strong style="color: black;">ID Kalibrasi:</strong> <code style="background: #f5f5f5; color: black; font-weight: bold;">${escapeHtml(calibrationId)}</code>
                    <br>
                    <small style="color: black;">Status: <span class="badge bg-success">Draft</span></small>
                </div>
        
        <div class="d-flex justify-content-center gap-3 flex-wrap mb-4">
            <!-- Button Cetak Label - Blue -->
            <button type="button" class="btn btn-primary btn-lg px-4 py-2" 
                    style="border-radius: 10px; transition: all 0.2s ease;"
                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 5px 15px rgba(0,0,0,0.2)';"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';"
                    onmousedown="this.style.transform='translateY(1px)';"
                    onmouseup="this.style.transform='translateY(-2px)';"
                    onclick="window.open('${printLabelUrl}', '_blank')">
                <i class="fas fa-print me-2"></i> Cetak Label
            </button>
            
            <!-- Button Input Lagi - Green -->
            <button type="button" class="btn btn-success btn-lg px-4 py-2" 
                    style="border-radius: 10px; transition: all 0.2s ease;"
                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 5px 15px rgba(0,0,0,0.2)';"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';"
                    onmousedown="this.style.transform='translateY(1px)';"
                    onmouseup="this.style.transform='translateY(-2px)';"
                    onclick="resetTabForNewScan(${tabId})">
                <i class="fas fa-plus-circle me-2"></i> Input Lagi
            </button>
            
            <!-- Button Tutup Tab - Red -->
            <button type="button" class="btn btn-danger btn-lg px-4 py-2" 
                    style="border-radius: 10px; transition: all 0.2s ease;"
                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 5px 15px rgba(0,0,0,0.2)';"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';"
                    onmousedown="this.style.transform='translateY(1px)';"
                    onmouseup="this.style.transform='translateY(-2px)';"
                    onclick="removeTab(${tabId})">
                <i class="fas fa-times me-2"></i> Tutup Tab
            </button>
        </div>
        
        <div class="mt-3 text-muted small">
            <i class="fas fa-info-circle me-1"></i> Data tersimpan sebagai Draft. 
            Klik <strong>Cetak Label</strong> untuk mencetak, atau <strong>Input Lagi</strong> untuk melanjutkan kalibrasi berikutnya.
        </div>
    </div>
    `;

    const finishContainer = document.getElementById('finish-action-container');
    if (finishContainer) finishContainer.classList.remove('d-none');

    if (typeof Swal !== 'undefined') {
        Swal.fire({
            icon: 'success',
            title: '✓ Data Tersimpan!',
            html: `<strong>${escapeHtml(formName)}</strong><br>ID: ${calibrationId}`,
            timer: 2000,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    }
};

window.resetTabForNewScan = function(tabId) {
    if (confirm('Data yang belum disimpan akan hilang. Lanjutkan?')) {
        delete tabSubmitStatus[tabId];
        location.reload();
    }
};

window.removeTab = function(tabId) {
    if (tabId == 1) {
        alert('Tab utama tidak bisa ditutup!');
        return;
    }
    if (confirm(`Apakah Anda yakin ingin menutup Form ${tabId}?`)) {
        delete tabSubmitStatus[tabId];
        delete tempFormDataStore[tabId];
        const container = document.querySelector(`.lk-form-container[data-lk-id="${tabId}"]`);
        if (container) container.remove();
        const tabBtn = document.getElementById(`lk-tab-${tabId}`);
        if (tabBtn) tabBtn.remove();
        const firstContainer = document.querySelector('.lk-form-container[data-lk-id="1"]');
        if (firstContainer) firstContainer.style.display = 'block';
        updateActiveTab('1');
    }
};

// ==========================================
// SUBMIT Volumetrik - SINGLE FORM PER TAB
// ==========================================
async function submitSemuaForm() {
    // Dapatkan tab ID yang aktif
    const activeTabId = getActiveTabId();
    console.log('📌 Submitting from active tab:', activeTabId);
    
    // Cari container yang aktif
    const activeContainer = document.querySelector(`.lk-form-container[data-lk-id="${activeTabId}"]`);
    if (!activeContainer) {
        alert('Container form tidak ditemukan!');
        return;
    }
    
    // CARI FORM
    let form = activeContainer.querySelector('#kalibrasiForm');
    if (!form) {
        form = activeContainer.querySelector('form[id^="kalibrasiForm"]');
    }
    if (!form) {
        form = activeContainer.querySelector('form');
    }
    
    if (!form) {
        alert('Form tidak ditemukan!');
        return;
    }
    
    console.log(`✅ Form ditemukan di tab ${activeTabId}`);
    
    // 🔥 JANGAN HAPUS REQUIRED, TAPI NONAKTIFKAN VALIDASI BROWSER SAJA
    form.setAttribute('novalidate', 'novalidate');
    form.noValidate = true;
    
    // Validasi manual untuk alat standar (tetap menggunakan required di HTML)
    const alatStandar = form.querySelectorAll('input[name="alat_standar[]"]:checked');
    if (alatStandar.length === 0) {
        alert('Pilih minimal 1 alat standar!');
        return;
    }
    
    const btn = document.getElementById('btnSimpanSemua');
    if (!btn) {
        alert('Tombol simpan tidak ditemukan!');
        return;
    }
    
    const originalText = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan Data...';
    
    try {
        const formData = new FormData(form);
        
        // Tambahkan field wajib yang mungkin kosong
        formData.append('form_type', 'volumetrik');
        formData.append('rentang_ukur_min', '0');
        formData.append('rentang_ukur_max', '0');
        
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
        if (csrfToken) {
            formData.append('_token', csrfToken);
        }
        
        console.log('📤 Mengirim data dari tab:', activeTabId);
        
        const response = await fetch('/calibrations', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        });
        
        const contentType = response.headers.get('content-type');
        
        let result;
        if (contentType && contentType.includes('application/json')) {
            result = await response.json();
        } else {
            const text = await response.text();
            console.error('Non-JSON response:', text.substring(0, 500));
            throw new Error('Server mengembalikan response yang tidak valid');
        }
        
        if (!response.ok) {
            throw new Error(result.error || `Gagal menyimpan data: ${response.status}`);
        }
        
        // Ambil nama form
        let formName = 'Volumetrik';
        const selectNamaAlat = form.querySelector('select[name="nama_alat"]');
        if (selectNamaAlat && selectNamaAlat.value && selectNamaAlat.value !== 'MANUAL_INPUT') {
            formName = selectNamaAlat.value;
        } else {
            const manualNamaAlat = form.querySelector('input[name="nama_alat_manual"]');
            if (manualNamaAlat && manualNamaAlat.value) {
                formName = manualNamaAlat.value;
            }
        }
        
        // Update data-form-name di container
        activeContainer.setAttribute('data-form-name', formName);
        
        console.log('📌 Saving success for tab:', activeTabId);
        
        if (typeof window.handleSaveSuccess === 'function') {
            window.handleSaveSuccess(activeTabId, result);
        } else {
            alert('Data berhasil disimpan!');
        }
        
    } catch (err) {
        console.error('Submit error:', err);
        alert('Error: ' + err.message);
    } finally {
        btn.disabled = false;
        btn.innerHTML = originalText;
    }
}

// ==========================================
// SETUP TAB SWITCHING
// ==========================================
function setupTabSwitching() {
    $(document).on('shown.bs.tab', 'button[data-toggle="tab"]', function (e) {
        const targetId = $(e.target).attr('id');
        if (targetId && targetId.startsWith('lk-tab-')) {
            const tabId = targetId.replace('lk-tab-', '');
            console.log('🎯 Tab switched to:', tabId);
            updateActiveTab(tabId);
            
            document.querySelectorAll('.lk-form-container').forEach(container => {
                container.style.display = 'none';
            });
            
            const targetContainer = document.querySelector(`.lk-form-container[data-lk-id="${tabId}"]`);
            if (targetContainer) {
                targetContainer.style.display = 'block';
            }
        }
    });
    
    const activeButton = document.querySelector('.nav-link.active');
    if (activeButton && activeButton.id) {
        const tabId = activeButton.id.replace('lk-tab-', '');
        updateActiveTab(tabId);
    }
}

// ==========================================
// INISIALISASI
// ==========================================
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 DOM Content Loaded - Initializing Volumetrik...');
    
    setupTabSwitching();
    
    const selectAlat = document.getElementById('nama_alat_select');
    if (selectAlat) {
        updateFormType(selectAlat.value);
        selectAlat.addEventListener('change', function() {
            updateFormType(this.value);
        });
    }
    
    const manualInput = document.getElementById('nama_alat_manual');
    if (manualInput) {
        manualInput.addEventListener('input', syncNamaAlat);
    }
    
    setTimeout(() => {
        disableRequiredOnHiddenForms();
    }, 500);
    
    console.log('✅ Volumetrik initialization complete!');
});
</script>

</body>
</html>