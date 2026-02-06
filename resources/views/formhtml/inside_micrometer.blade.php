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
        <input type="hidden" name="form_type" value="inside_micrometer">
        <input type="hidden" name="capacity" value="{{ $capacity ?? '' }}">
            <div class="form-kalibrasi-container">
                <table class="kalibrasi-header-table">
                    <tr>
                        <td colspan="2">
                            <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK01</p>
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
                            <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">INSIDE MICROMETER</p>
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
                                    value="Inside Micrometer"
                                    placeholder="Inside Micrometer"
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
                                <input type="text" name="kode_alat" class="kalibrasi-input" placeholder="Masukkan kode" style="width: 30%;">
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
                                <input type="text" 
                                    name="type_alat" 
                                    class="kalibrasi-input me-3" 
                                    placeholder="Masukkan Type Alat" 
                                    style="width: 45%;"
                                  required>
                                <span class="me-3" style="color: #000000;">/</span>
                                <input type="text" 
                                    name="no_seri" 
                                    class="kalibrasi-input" 
                                    placeholder="Mmasukkan No. Seri" 
                                    style="width: 45%;"
                                    
                                    required>
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
                                        readonly
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
                            <input type="date" name="tanggal_alat_masuk" class="kalibrasi-input" value="{{ date('Y-m-d') }}" required>
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
                                <select name="jenis_pembacaan" class="kalibrasi-input" style="width: 45%;">
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
                            <input type="text" name="lokasi_pt" class="kalibrasi-input" placeholder="Masukkan Lokasi PT">
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

                <!-- Data Kalibrasi Section -->
                <div class="data-kalibrasi-header" style="color: #000000;">DATA KALIBRASI</div>
                
                <div class="mb-3">
                    <span style="font-size: 16px; font-weight: bold; color: #000000;">Uji Skala Nominal</span>
                </div>
                
            
   
                                    @php
                        // Konversi capacity ke integer (null jika belum dipilih)
                        $capacity = isset($capacity) && $capacity !== '' ? (int)$capacity : null;
                        
                        // Fungsi untuk menentukan nilai nominal berdasarkan kapasitas
                        function getNominalValues($capacity) {
                            if ($capacity === null) {
                                // Jika belum dipilih capacity, kembalikan array kosong 14 elemen
                                return array_fill(0, 14, '');
                            }
                            
                            $values = [];
                        
                        switch($capacity) {
                            case 0:
                                $values = [0.0, 2.5, 5.1, 7.7, 10.3, 12.9, 15.0, 17.6, 20.2, 22.8, 25.0, '', '', ''];
                                break;
                            case 25:
                                $values = [25.0, 27.5, 30.1, 32.7, 35.3, 37.9, 40.0, 42.6, 45.2, 47.8, 50.0, '', '', ''];
                                break;
                            case 50:
                                $values = [50.0, 52.5, 55.1, 57.7, 60.3, 62.9, 65.0, 67.6, 70.2, 72.8, 75.0, '', '', ''];
                                break;
                            case 75:
                                $values = [75.0, 77.5, 80.1, 82.7, 85.3, 87.9, 90.0, 92.6, 95.2, 97.8, 100.0, '', '', ''];
                                break;
                            case 100:
                                $values = [100.0, 102.5, 105.1, 107.7, 110.3, 112.9, 115.0, 117.6, 120.2, 122.8, 125.0, '', '', ''];
                                break;
                            case 125:
                                $values = [125.0, 127.5, 130.1, 132.7, 135.3, 137.9, 140.0, 142.6, 145.2, 147.8, 150.0, '', '', ''];
                                break;
                            case 150:
                                $values = [150.0, 152.5, 155.1, 157.7, 160.3, 162.9, 165.0, 167.6, 170.2, 172.8, 175.0, '', '', ''];
                                break;
                            case 175:
                                $values = [175.0, 177.5, 180.1, 182.7, 185.3, 187.9, 190.0, 192.6, 195.2, 197.8, 200.0, '', '', ''];
                                break;
                            case 200:
                                $values = [200.0, 202.5, 205.1, 207.7, 210.3, 212.9, 215.0, 217.6, 220.2, 222.8, 225.0, '', '', ''];
                                break;
                            case 225:
                                $values = [225.0, 227.5, 230.1, 232.7, 235.3, 237.9, 240.0, 242.6, 245.2, 247.8, 250.0, '', '', ''];
                                break;
                            case 250:
                                $values = [250.0, 252.5, 255.1, 257.7, 260.3, 262.9, 265.0, 267.6, 270.2, 272.8, 275.0, '', '', ''];
                                break;
                            case 275:
                                $values = [275.0, 277.5, 280.1, 282.7, 285.3, 287.9, 290.0, 292.6, 295.2, 297.8, 300.0, '', '', ''];
                                break;
                            case 300:
                                $values = [300.0, 302.5, 305.1, 307.7, 310.3, 312.9, 315.0, 317.6, 320.2, 322.8, 325.0, '', '', ''];
                                break;
                            case 325:
                                $values = [325.0, 327.5, 330.1, 332.7, 335.3, 337.9, 340.0, 342.6, 345.2, 347.8, 350.0, '', '', ''];
                                break;
                            case 350:
                                $values = [350.0, 352.5, 355.1, 357.7, 360.3, 362.9, 365.0, 367.6, 370.2, 372.8, 375.0, '', '', ''];
                                break;
                            case 375:
                                $values = [375.0, 377.5, 380.1, 382.7, 385.3, 387.9, 390.0, 392.6, 395.2, 397.8, 400.0, '', '', ''];
                                break;
                            case 400:
                                $values = [400.0, 402.5, 405.1, 407.7, 410.3, 412.9, 415.0, 417.6, 420.2, 422.8, 425.0, '', '', ''];
                                break;
                            case 425:
                                $values = [425.0, 427.5, 430.1, 432.7, 435.3, 437.9, 440.0, 442.6, 445.2, 447.8, 450.0, '', '', ''];
                                break;
                            case 450:
                                $values = [450.0, 452.5, 455.1, 457.7, 460.3, 462.9, 465.0, 467.6, 470.2, 472.8, 475.0, '', '', ''];
                                break;
                            case 475:
                                $values = [475.0, 477.5, 480.1, 482.7, 485.3, 487.9, 490.0, 492.6, 495.2, 497.8, 500.0, '', '', ''];
                                break;
                            case 500:
                                $values = [500.0, 502.5, 505.1, 507.7, 510.3, 512.9, 515.0, 517.6, 520.2, 522.8, 525.0, '', '', ''];
                                break;
                            default:
                                // Jika kapasitas tidak valid, kembalikan array kosong 14 elemen
                                return array_fill(0, 14, '');
                        }
                        
                        return $values;
                    }

                    $nominalValues = getNominalValues($capacity);
                    $capacityTitle = $capacity === null ? "Inside Micrometer" : ($capacity == 0 ? "0 mm" : "{$capacity} mm");
                    @endphp

                    <table class="kalibrasi-data-table">
                    <tr style="background: #d9d9d9;">
                        <td style="width: 20%;">
                            <span style="font-weight: bold; color: #000000;">Nilai Nominal</span>
                        </td>
                        <td colspan="5">
                            <span style="font-weight: bold; color: #000000;">Penunjukan Alat</span>
                        </td>
                    </tr>
                    <tr style="background: #e8e8e8;">
                        <td>
                            <span style="font-weight: bold; color: #000000;">Unit (mm)</span>
                        </td>
                        <td style="width: 16%;"><span style="font-weight: bold; color: #000000;">1</span></td>
                        <td style="width: 16%;"><span style="font-weight: bold; color: #000000;">2</span></td>
                        <td style="width: 16%;"><span style="font-weight: bold; color: #000000;">3</span></td>
                        <td style="width: 16%;"><span style="font-weight: bold; color: #000000;">4</span></td>
                        <td style="width: 16%;"><span style="font-weight: bold; color: #000000;">5</span></td>
                    </tr>

                    @for($i = 1; $i <= 14; $i++)
                        @php
                            $nominalValue = isset($nominalValues[$i-1]) ? $nominalValues[$i-1] : '';
                            // Format nilai hanya jika bukan string kosong
                            if ($nominalValue !== '') {
                                $nominalFormatted = number_format($nominalValue, 1, '.', '');
                                $readonly = 'readonly';
                                $inputType = 'text';
                            } else {
                                $nominalFormatted = '';
                                $readonly = '';
                                $inputType = 'number';
                            }
                        @endphp
                        <tr style="height:21.3pt;">
                            <td style="border:2px solid #000; padding:0; background: #f0f0f0;">
                                <input type="{{ $inputType }}" 
                                    name="nominal_{{ $i }}" 
                                    value="{{ $nominalFormatted }}" 
                                    {{ $readonly }}
                                    step="any"
                                    oninput="{{ !$readonly ? 'formatNumberInput(this)' : '' }}"
                                    style="width:100%;height:100%;border:none;background:transparent;text-align:center;font-size:10pt;color:#000;padding:2px;"
                                  
                            </td>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="number" 
                                    name="penunjukan_{{ $i }}_1" 
                                    value="" 
                                    step="any"
                                    oninput="formatNumberInput(this)"
                                    style="width:100%;height:100%;border:none;background:transparent;text-align:center;font-size:10pt;color:#000;padding:2px;"
                                   >
                            </td>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="number" 
                                    name="penunjukan_{{ $i }}_2" 
                                    value="" 
                                    step="any"
                                    oninput="formatNumberInput(this)"
                                    style="width:100%;height:100%;border:none;background:transparent;text-align:center;font-size:10pt;color:#000;padding:2px;"
                                  >
                            </td>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="number" 
                                    name="penunjukan_{{ $i }}_3" 
                                    value="" 
                                    step="any"
                                    oninput="formatNumberInput(this)"
                                    style="width:100%;height:100%;border:none;background:transparent;text-align:center;font-size:10pt;color:#000;padding:2px;"
                                   >
                            </td>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="number" 
                                    name="penunjukan_{{ $i }}_4" 
                                    value="" 
                                    step="any"
                                    oninput="formatNumberInput(this)"
                                    style="width:100%;height:100%;border:none;background:transparent;text-align:center;font-size:10pt;color:#000;padding:2px;"
                                    >
                            </td>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="number" 
                                    name="penunjukan_{{ $i }}_5" 
                                    value="" 
                                    step="any"
                                    oninput="formatNumberInput(this)"
                                    style="width:100%;height:100%;border:none;background:transparent;text-align:center;font-size:10pt;color:#000;padding:2px;"
                                   >
                            </td>
                        </tr>
                    @endfor
                </table>



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
                            <input type="checkbox" name="alat_standar[]" value="Gauge Block (150mm) D.007" id="alat1">
                        </td>
                        <td colspan="2" style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
                            <label for="alat1" style="cursor:pointer; color:#000000;">Gauge Block (150mm) D.007</label>
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
                            <input type="checkbox" name="alat_standar[]" value="Gauge Block (300mm) D.008" id="alat2">
                        </td>
                        <td colspan="2" style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
                            <label for="alat2" style="cursor:pointer; color:#000000;">Gauge Block (300mm) D.008</label>
                        </td>
                    </tr>

                    <tr style="height:13.5pt">
                        <td style="border:1pt solid #000; text-align:center; vertical-align:middle;">
                            <input type="checkbox" name="alat_standar[]" value="Gauge Block (300mm) D.009" id="alat3">
                        </td>
                        <td colspan="2" style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
                            <label for="alat3" style="cursor:pointer; color:#000000;">Gauge Block (300mm) D.009</label>
                        </td>
                    </tr>

                    <tr style="height:13.5pt">
                        <td style="border:1pt solid #000; text-align:center; vertical-align:middle;">
                            <input type="checkbox" name="alat_standar[]" value="Gauge Block Set Grade 0.5 ~ 100 mm 0 D.012" id="alat4">
                        </td>
                        <td colspan="2" style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
                            <label for="alat4" style="cursor:pointer; color:#000000;">Gauge Block Set Grade 0.5 ~ 100 mm 0 D.012</label>
                        </td>
                    </tr>

                    <tr style="height:13.5pt">
                        <td style="border:1pt solid #000; text-align:center; vertical-align:middle;">
                            <input type="checkbox" name="alat_standar[]" value="Gauge Block Set Grade 2.5 ~ 25 mm 0 D.013" id="alat5">
                        </td>
                        <td colspan="2" style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
                            <label for="alat5" style="cursor:pointer; color:#000000;">Gauge Block Set Grade 2.5 ~ 25 mm 0 D.013</label>
                        </td>
                    </tr>

                    <!-- METODE KALIBRASI + TTD & NAMA -->
                    <tr style="height:15pt">
                        <td rowspan="2" style="width:105.35pt; border:1pt solid #000; padding:8.6pt 0 0 20.5pt; font-size:8.5pt; vertical-align:top; color:#000000;">
                            Metode Kalibrasi
                        </td>
                        <td colspan="3" rowspan="2" style="border:1pt solid #000; padding:3.2pt 5.25pt 0 8.85pt; font-size:8.5pt; line-height:112%; vertical-align:top; color:#000000;">
                            PAS-IK1102-01 (JIS B 7502:2016 (JMA/JSA); SNSU PK.P-01:2020).
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

</body>

</html>