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
        <input type="hidden" name="form_type" value="thermometer">
            <div class="form-kalibrasi-container">
                <table class="kalibrasi-header-table">
                    <tr>
                        <td colspan="2">
                            <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK30</p>
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
                            <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">THERMOMETER</p>
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
                                    value="Thermometer"
                                    placeholder="Thermometer"
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

                    <!-- Rentang Ukur -->
                    <tr>
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
                    </tr>

                    <!-- Kapasitas / Resolusi -->
                    <tr>
                        <td><p style="margin:0;color:#000">Kapasitas / Resolusi</p></td>
                        <td colspan="3">
                            <div class="d-flex align-items-center justify-content-between">
                                <!-- Kapasitas dengan mm -->
                                <div class="d-flex align-items-center" style="width: 48%;">
                                    <input type="text"
                                        name="kapasitas"
                                        id="kapasitas"
                                        class="kalibrasi-input"
                                        style="border-top-right-radius: 0; border-bottom-right-radius: 0; border-right: none; width: calc(100% - 40px);"
                                        
                                        placeholder="Otomatis dari Range Max">
                                    <span class="bg-light border border-start-0 px-2" style="border-color: #ced4da !important; min-height: 38px; display: flex; align-items: center; font-size: 14px; color: #000; width: 40px; justify-content: center;">
                                        mm
                                    </span>
                                </div>

                                <!-- Pembatas / -->
                                <div class="mx-2" style="color: #000000; font-size: 16px; font-weight: normal;">/</div>

                                <!-- Resolusi dengan mm -->
                                <div class="d-flex align-items-center" style="width: 48%;">
                                    <input type="number"
                                        name="resolusi"
                                        step="any"
                                        class="kalibrasi-input"
                                        style="border-top-right-radius: 0; border-bottom-right-radius: 0; border-right: none; width: calc(100% - 40px);"
                                        
                                        required>
                                    <span class="bg-light border border-start-0 px-2" style="border-color: #ced4da !important; min-height: 38px; display: flex; align-items: center; font-size: 14px; color: #000; width: 40px; justify-content: center;">
                                        mm
                                    </span>
                                </div>
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
                <div class="setting-suhu-container" style="margin-bottom: 30px;">
    <div style="display: flex; justify-content: space-between;">
        <!-- Tabel Kiri -->
     <!-- Tabel Kiri -->
<table class="setting-suhu-table" style="border-collapse: collapse; width: 48%;">
    <tr>
        <th rowspan="2" style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; font-size: 10pt; background-color: #f0f0f0;">
            Setting Suhu<br>
            <select name="satuan_suhu_kiri" id="satuan_suhu_kiri" style="width: 80%; border: none; text-align: center; background: transparent; font-size: 9pt; font-weight: normal; margin-top: 5px;">
                <option value="">(……………)</option>
                <option value="°C" {{ old('satuan_suhu_kiri', $calibration->headThermometer->satuan_suhu_kiri ?? '') == '°C' ? 'selected' : '' }}>°C</option>
                <option value="°F" {{ old('satuan_suhu_kiri', $calibration->headThermometer->satuan_suhu_kiri ?? '') == '°F' ? 'selected' : '' }}>°F</option>
            </select>
        </th>
        <th colspan="2" style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; font-size: 10pt; background-color: #f0f0f0;">
            Pembacaan
        </th>
    </tr>
    <tr>
        <th style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; font-size: 10pt; background-color: #f0f0f0;">STD</th>
        <th style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; font-size: 10pt; background-color: #f0f0f0;">UUT</th>
    </tr>
    <?php 
    // Ambil data existing untuk kiri (6 kelompok pertama)
    $existingDetailsLeft = isset($calibration->headThermometer->details) ? 
        $calibration->headThermometer->details->take(6) : collect();
    
    for($group = 0; $group < 6; $group++):
        $existingDetail = $existingDetailsLeft->get($group);
        $baseIndex = ($group * 3) + 1;
    ?>
        <tr>
            <td rowspan="3" style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 90px;">
                <input type="number" step="any" name="setting_suhu[]" 
                       value="{{ $existingDetail->titikUkur ?? old('setting_suhu.'.$group) }}" 
                       style="width: 80%; border: none; text-align: center; background: transparent; font-size: 10pt;" 
                       oninput="this.value = this.value.replace(/[^0-9.]/g, '')" pattern="[0-9.]+">
            </td>
            <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 30px;">
                <input type="number" step="any" name="std_{{ $baseIndex }}" 
                       value="{{ $existingDetail->STD01 ?? old('std_'.$baseIndex) }}" 
                       style="width: 90%; border: none; text-align: center; background: transparent; font-size: 9pt;" 
                       oninput="this.value = this.value.replace(/[^0-9.]/g, '')" pattern="[0-9.]+">
            </td>
            <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 30px;">
                <input type="number" step="any" name="uut_{{ $baseIndex }}" 
                       value="{{ $existingDetail->UUT01 ?? old('uut_'.$baseIndex) }}" 
                       style="width: 90%; border: none; text-align: center; background: transparent; font-size: 9pt;" 
                       oninput="this.value = this.value.replace(/[^0-9.]/g, '')" pattern="[0-9.]+">
            </td>
        </tr>
        <tr>
            <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 30px;">
                <input type="number" step="any" name="std_{{ $baseIndex + 1 }}" 
                       value="{{ $existingDetail->STD02 ?? old('std_'.($baseIndex + 1)) }}" 
                       style="width: 90%; border: none; text-align: center; background: transparent; font-size: 9pt;" 
                       oninput="this.value = this.value.replace(/[^0-9.]/g, '')" pattern="[0-9.]+">
            </td>
            <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 30px;">
                <input type="number" step="any" name="uut_{{ $baseIndex + 1 }}" 
                       value="{{ $existingDetail->UUT02 ?? old('uut_'.($baseIndex + 1)) }}" 
                       style="width: 90%; border: none; text-align: center; background: transparent; font-size: 9pt;" 
                       oninput="this.value = this.value.replace(/[^0-9.]/g, '')" pattern="[0-9.]+">
            </td>
        </tr>
        <tr>
            <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 30px;">
                <input type="number" step="any" name="std_{{ $baseIndex + 2 }}" 
                       value="{{ $existingDetail->STD03 ?? old('std_'.($baseIndex + 2)) }}" 
                       style="width: 90%; border: none; text-align: center; background: transparent; font-size: 9pt;" 
                       oninput="this.value = this.value.replace(/[^0-9.]/g, '')" pattern="[0-9.]+">
            </td>
            <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 30px;">
                <input type="number" step="any" name="uut_{{ $baseIndex + 2 }}" 
                       value="{{ $existingDetail->UUT03 ?? old('uut_'.($baseIndex + 2)) }}" 
                       style="width: 90%; border: none; text-align: center; background: transparent; font-size: 9pt;" 
                       oninput="this.value = this.value.replace(/[^0-9.]/g, '')" pattern="[0-9.]+">
            </td>
        </tr>
    <?php endfor; ?>
</table>

<!-- Tabel Kanan (Lanjutan) -->
<table class="setting-suhu-table" style="border-collapse: collapse; width: 48%;">
    <tr>
        <th rowspan="2" style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; font-size: 10pt; background-color: #f0f0f0;">
            Setting Suhu<br>
            <select name="satuan_suhu_kanan" id="satuan_suhu_kanan" style="width: 80%; border: none; text-align: center; background: transparent; font-size: 9pt; font-weight: normal; margin-top: 5px;">
                <option value="">(……………)</option>
                <option value="°C" {{ old('satuan_suhu_kanan', $calibration->headThermometer->satuan_suhu_kanan ?? '') == '°C' ? 'selected' : '' }}>°C</option>
                <option value="°F" {{ old('satuan_suhu_kanan', $calibration->headThermometer->satuan_suhu_kanan ?? '') == '°F' ? 'selected' : '' }}>°F</option>
            </select>
        </th>
        <th colspan="2" style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; font-size: 10pt; background-color: #f0f0f0;">
            Pembacaan
        </th>
    </tr>
    <tr>
        <th style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; font-size: 10pt; background-color: #f0f0f0;">STD</th>
        <th style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; font-size: 10pt; background-color: #f0f0f0;">UUT</th>
    </tr>
    <?php 
    // Ambil data existing untuk kanan (6 kelompok terakhir)
    $existingDetailsRight = isset($calibration->headThermometer->details) ? 
        $calibration->headThermometer->details->slice(6)->take(6) : collect();
    
    for($group = 6; $group < 12; $group++):
        $existingDetail = $existingDetailsRight->get($group - 6);
        $baseIndex = ($group * 3) + 1; // Mulai dari 19
    ?>
        <tr>
            <td rowspan="3" style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 90px;">
                <input type="number" step="any" name="setting_suhu[]" 
                       value="{{ $existingDetail->titikUkur ?? old('setting_suhu.'.$group) }}" 
                       style="width: 80%; border: none; text-align: center; background: transparent; font-size: 10pt;" 
                       oninput="this.value = this.value.replace(/[^0-9.]/g, '')" pattern="[0-9.]+">
            </td>
            <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 30px;">
                <input type="number" step="any" name="std_{{ $baseIndex }}" 
                       value="{{ $existingDetail->STD01 ?? old('std_'.$baseIndex) }}" 
                       style="width: 90%; border: none; text-align: center; background: transparent; font-size: 9pt;" 
                       oninput="this.value = this.value.replace(/[^0-9.]/g, '')" pattern="[0-9.]+">
            </td>
            <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 30px;">
                <input type="number" step="any" name="uut_{{ $baseIndex }}" 
                       value="{{ $existingDetail->UUT01 ?? old('uut_'.$baseIndex) }}" 
                       style="width: 90%; border: none; text-align: center; background: transparent; font-size: 9pt;" 
                       oninput="this.value = this.value.replace(/[^0-9.]/g, '')" pattern="[0-9.]+">
            </td>
        </tr>
        <tr>
            <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 30px;">
                <input type="number" step="any" name="std_{{ $baseIndex + 1 }}" 
                       value="{{ $existingDetail->STD02 ?? old('std_'.($baseIndex + 1)) }}" 
                       style="width: 90%; border: none; text-align: center; background: transparent; font-size: 9pt;" 
                       oninput="this.value = this.value.replace(/[^0-9.]/g, '')" pattern="[0-9.]+">
            </td>
            <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 30px;">
                <input type="number" step="any" name="uut_{{ $baseIndex + 1 }}" 
                       value="{{ $existingDetail->UUT02 ?? old('uut_'.($baseIndex + 1)) }}" 
                       style="width: 90%; border: none; text-align: center; background: transparent; font-size: 9pt;" 
                       oninput="this.value = this.value.replace(/[^0-9.]/g, '')" pattern="[0-9.]+">
            </td>
        </tr>
        <tr>
            <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 30px;">
                <input type="number" step="any" name="std_{{ $baseIndex + 2 }}" 
                       value="{{ $existingDetail->STD03 ?? old('std_'.($baseIndex + 2)) }}" 
                       style="width: 90%; border: none; text-align: center; background: transparent; font-size: 9pt;" 
                       oninput="this.value = this.value.replace(/[^0-9.]/g, '')" pattern="[0-9.]+">
            </td>
            <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 30px;">
                <input type="number" step="any" name="uut_{{ $baseIndex + 2 }}" 
                       value="{{ $existingDetail->UUT03 ?? old('uut_'.($baseIndex + 2)) }}" 
                       style="width: 90%; border: none; text-align: center; background: transparent; font-size: 9pt;" 
                       oninput="this.value = this.value.replace(/[^0-9.]/g, '')" pattern="[0-9.]+">
            </td>
        </tr>
    <?php endfor; ?>
</table>
    </div>
</div>

    
                
                <!-- Jarak dan Footer Section -->
                <div style="margin-top: 40px; margin-bottom: 20px;"></div>

                <!-- Footer Section -->
                <table class="kalibrasi-main-table">
                    <tr>
                        <td colspan="6" style="text-align: center; border-bottom: 1px solid #000;">
                            <span style="font-weight: bold; font-size: 18px; color: #000000;">Isilah lembar data kalibrasi dengan lengkap dan jelas!</span>
                        </td>
                    </tr>

                                    
                    <tr style="height:13.5pt">
                        <td rowspan="4" style="width:105.35pt; border:1pt solid #000; vertical-align:middle; text-align:center; font-weight:bold; font-size:10pt; color:#000000;">
                            Standard
                        </td>

                        <td style="width:24.75pt; border:1pt solid #000; text-align:center; vertical-align:middle;">
                            <input type="checkbox" name="alat_standar[]" value="TD.001" id="std1">
                        </td>
                        <td style="width:63.6pt; border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
                            <label for="std1" style="cursor:pointer; color:#000000;">TD.001</label>
                        </td>
                        <td style="width:15.55pt; border:1pt solid #000; text-align:center; vertical-align:middle;">
                            <input type="checkbox" name="alat_standar[]" value="Microbath" id="jenis1">
                        </td>
                        <td style="width:84.3pt; border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
                            <label for="jenis1" style="cursor:pointer; color:#000000;">Microbath</label>
                        </td>

                        <td rowspan="4" style="width:111.15pt; border-top:1pt solid #000; border-right:1pt solid #000; border-left:1pt solid #000; border-bottom:none; padding-top:6pt; text-align:center; vertical-align:top; font-size:8.5pt; color:#000000;">
                            Dikalibrasi<br>oleh
                        </td>
                        <td rowspan="4" style="width:98.3pt; border-top:1pt solid #000; border-right:1pt solid #000; border-left:1pt solid #000; border-bottom:none; padding-top:6pt; text-align:center; vertical-align:top; font-size:8.5pt; color:#000000;">
                            Diperiksa<br>oleh
                        </td>
                    </tr>

                    <tr style="height:13.5pt">
                        <td style="border:1pt solid #000; text-align:center; vertical-align:middle;">
                            <input type="checkbox" name="alat_standar[]" value="TD.002" id="std2">
                        </td>
                        <td style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
                            <label for="std2" style="cursor:pointer; color:#000000;">TD.002</label>
                        </td>
                        <td style="border:1pt solid #000; text-align:center; vertical-align:middle;">
                            <input type="checkbox" name="alat_standar[]" value="Dry Block" id="jenis2">
                        </td>
                        <td style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
                            <label for="jenis2" style="cursor:pointer; color:#000000;">Dry Block</label>
                        </td>
                    </tr>

                    <tr style="height:13.5pt">
                        <td style="border:1pt solid #000; text-align:center; vertical-align:middle;">
                            <input type="checkbox" name="alat_standar[]" value="TD.003" id="std3">
                        </td>
                        <td style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
                            <label for="std3" style="cursor:pointer; color:#000000;">TD.003</label>
                        </td>
                        <td rowspan="2" style="width:15.55pt; border:1pt solid #000; text-align:center; vertical-align:middle;">
                            <input type="checkbox" name="alat_standar[]" value="Microbath & Dry Block" id="jenis4">
                        </td>
                        <td rowspan="2" style="width:84.3pt; border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
                            <label for="jenis4" style="cursor:pointer; color:#000000;">Microbath & Dry Block</label>
                        </td>
                    </tr>

                    <tr style="height:13.5pt">
                        <td style="border:1pt solid #000; text-align:center; vertical-align:middle;">
                            <input type="checkbox" name="alat_standar[]" value="TD.004" id="std4">
                        </td>
                        <td style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
                            <label for="std4" style="cursor:pointer; color:#000000;">TD.004</label>
                        </td>
                    </tr>

                    <!-- METODE KALIBRASI + TTD & NAMA -->
                    <tr style="height:15pt">
                    <td rowspan="4" style="width:105.35pt; border:1pt solid #000; vertical-align:middle; text-align:center; font-weight:bold; font-size:10pt; color:#000000;">
                            Metode Kalibrasi
                        </td>
                        
                        <td style="width:24.75pt; border:1pt solid #000; text-align:center; vertical-align:middle;">
                            <input type="radio" name="metode_kalibrasi[]" value="PAS-IK1102-30 (Termometer Digital)" id="metode1">
                        </td>
                        <td colspan="3" style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
                            <label for="metode1" style="cursor:pointer; color:#000000;">PAS-IK1102-30 (Termometer Digital)</label>
                        </td>
                        
                        <td style="width:111.15pt; border-top:none; border-right:1pt solid #000; border-left:1pt solid #000; border-bottom:1pt solid #000; padding:3.35pt 0 0 1.35pt; font-size:8.5pt; vertical-align:top; color:#000000;">
                            &nbsp;
                        </td>
                        <td style="width:98.3pt; border-top:none; border-right:1pt solid #000; border-left:1pt solid #000; border-bottom:1pt solid #000; padding:3.35pt 0 0 1.8pt; font-size:8.5pt; vertical-align:top; color:#000000;">
                            &nbsp;
                        </td>
                    </tr>

                    <tr style="height:15pt">
                        <td style="border:1pt solid #000; text-align:center; vertical-align:middle;">
                            <input type="radio" name="metode_kalibrasi[]" value="PAS-IK1102-31 (Termometer Gelas)" id="metode2">
                        </td>
                        <td colspan="3" style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
                            <label for="metode2" style="cursor:pointer; color:#000000;">PAS-IK1102-31 (Termometer Gelas)</label>
                        </td>
                        
                        <td style="width:111.15pt; border-top:none; border-right:1pt solid #000; border-left:1pt solid #000; border-bottom:1pt solid #000; padding:1.8pt 0 0 1.35pt; font-size:8.5pt; vertical-align:top; color:#000000;">
                            TTD :
                        </td>
                        <td style="width:98.3pt; border-top:none; border-right:1pt solid #000; border-left:1pt solid #000; border-bottom:1pt solid #000; padding:1.8pt 0 0 1.8pt; font-size:8.5pt; vertical-align:top; color:#000000;">
                            TTD :
                        </td>
                    </tr>

                    <tr style="height:15pt">
                        <td style="border:1pt solid #000; text-align:center; vertical-align:middle;">
                            <input type="radio" name="metode_kalibrasi[]" value="PAS-IK1102-32 (Termometer Dial)" id="metode3">
                        </td>
                        <td colspan="3" style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
                            <label for="metode3" style="cursor:pointer; color:#000000;">PAS-IK1102-32 (Termometer Dial)</label>
                        </td>
                        
                        <td style="width:111.15pt; border-top:none; border-right:1pt solid #000; border-left:1pt solid #000; border-bottom:1pt solid #000; padding:1.8pt 0 0 1.35pt; font-size:8.5pt; vertical-align:top; color:#000000;">
                            <input type="text" name="calibrated_by" class="kalibrasi-input" placeholder="Nama" style="border: none; width: 100%;" required>
                        </td>
                        <td style="width:98.3pt; border-top:none; border-right:1pt solid #000; border-left:1pt solid #000; border-bottom:1pt solid #000; padding:1.8pt 0 0 1.8pt; font-size:8.5pt; vertical-align:top; color:#000000;">
                            <input type="text" name="verified_by" class="kalibrasi-input" placeholder="Nama" style="border: none; width: 100%;" required>
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