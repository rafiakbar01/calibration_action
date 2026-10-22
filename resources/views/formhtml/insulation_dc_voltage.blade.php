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
        <input type="hidden" name="form_type" value="insulation">
                <input type="hidden" name="type" value="resistance">

            <div class="form-kalibrasi-container">
                <table class="kalibrasi-header-table">
                    <tr>
                        <td colspan="2">
                            <p style="margin: 0; font-size: 14px; color: #000000;text-align: left;">PAS-FLK004</p>
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
                            <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;text-align: left;">KELISTRIKAN</p>
                        </td>
                    </tr>
                    
                    
                    <tr>
                        <td style="width: 25%;">
                            <p style="margin: 0; font-size: 14px; color: #000000;text-align: left;">No. Order</p>
                        </td>
                        <td style="width: 45%;">
                            <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;text-align: left;">PAS-OCC- </p>
                        </td>
                    </tr>
                   
                    
                   
                     <tr>
                        <td style="width: 25%;">
                            <p style="margin: 0; font-size: 14px; color: #000000;text-align: left;">No. Sertifikat</p>
                        </td>
                        <td style="width: 45%;">
                            <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;text-align: left;">PAS-SK </p>
                        </td>
                    </tr>
                </table>

               <!-- Main Form Section -->
                <table class="kalibrasi-main-table">
                    <!-- Nama Alat -->
                    <tr>
                            <td style="width: 20%;">
                                <p style="margin: 0; color: #000000;text-align: left;">Nama Alat</p>
                            </td>
                            <td colspan="3">
                                <div class="d-flex align-items-center">
                                <input type="text" name="merek" class="kalibrasi-input me-3" placeholder="Insulation" readonly style="width: 60%;text-align: left;" required>
                            </td>
                        </tr>

                    <!-- Merek & Kode Alat -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;text-align: left;">Merek</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" name="merek" class="kalibrasi-input me-3" placeholder="Masukkan merek alat" style="width: 60%;text-align: left;" required>
                                <span class="me-1" style="color:#000000;">KodeAlat:</span>
                                <input type="text" name="kode_alat" class="kalibrasi-input" placeholder="Masukkan kode" style="width: 30%; text-align: left;">
                            </div>
                        </td>
                    </tr>

                    <!-- Type / No. Seri -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;text-align: left;">Type / No. Seri</p>
                        </td>
                       <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" 
                                    name="type_alat" 
                                    class="kalibrasi-input me-3" 
                                    placeholder="Masukkan Type Alat" 
                                    style="width: 45%; text-align: left;"
                                    oninput="formatTypeAlat(this)">
                                <span class="me-3" style="color: #000000;">/</span>
                                <input type="text" 
                                    name="no_seri" 
                                    class="kalibrasi-input" 
                                    placeholder="Masukkan No. Seri" 
                                    style="width: 45%; text-align: left;"
                                    oninput="formatNoSeri(this)"
                                    required>
                            </div>
                        </td>
                    </tr>
                    <!-- Rentang Ukur -->
                    <tr>
                        <td><p style="margin:0;color:#000; text-align: left;">Rentang Ukur</p></td>
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
                        <td><p style="margin:0;color:#000; text-align: left;">Kapasitas / Resolusi</p></td>
                        <td colspan="3">
                            <div class="d-flex align-items-center justify-content-between">
                                <!-- Kapasitas dengan mm -->
                                <div class="d-flex align-items-center" style="width: 48%;">
                                    <input type="number"
                                        name="kapasitas"
                                        id="kapasitas"
                                        class="kalibrasi-input"
                                        style="border-top-right-radius: 0; border-bottom-right-radius: 0; border-right: none; width: calc(100% - 40px);"
                            
                                        placeholder="">
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
                            <p style="margin: 0; color: #000000; text-align: left;">Nama Pemilik</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" name="merek" class="kalibrasi-input me-3" placeholder="Masukkan nama pemilik/Instansi" style="width: 60%;text-align: left;" required>
                        </td>
                    </tr>
                    
                    
                     <tr>
                        <td>
                            <p style="margin: 0; color: #000000; text-align: left;">Kisaran Pakai Alat</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" name="kisaran pakai alat" class="kalibrasi-input me-3" placeholder="Masukkan kisaran pakai" style="width: 60%;text-align: left;" required>
                        </td>
                    </tr>

                    <!-- Tanggal Alat Masuk & Kalibrasi -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000; text-align: left;">Tanggal Alat Masuk</p>
                        </td>
                        <td colspan="3">
                            <input type="date" name="tanggal_alat_masuk" class="kalibrasi-input" value="{{ date('Y-m-d') }}" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000; text-align: left;">Tanggal Kalibrasi</p>
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
                            <p style="margin: 0; color: #000000; text-align: left;">Tempat Kalibrasi</p>
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
                            <p style="margin: 0; color: #000000; text-align: left;">Lokasi PT</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" name="merek" class="kalibrasi-input me-3" placeholder="Masukkan lokasi pt" style="width: 60%;text-align: left;" required>
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

                    <!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DC Voltage - Kalibrasi</title>
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      padding: 20px;
      background-color: #f9f9f9;
    }
    table {
      width: 100%;
      max-width: 1100px;
      margin: 20px auto;
      border-collapse: collapse;
      background-color: #fff;
    }
    td, th {
      border: 1px solid #000;
      padding: 10px;
      text-align: center;
      vertical-align: middle;
    }
    th {
      background-color: #d0d0d0;
      font-weight: bold;
    }
    .section-title {
      background-color: #a0a0a0;
      font-size: 1.2em;
      font-weight: bold;
    }
    input[type="text"] {
      width: 100%;
      border: none;
      background: transparent;
      text-align: center;
      padding: 5px;
      box-sizing: border-box;
      font-size: 11pt;
    }
    input[type="text"]:focus {
      outline: 2px solid #4a90e2;
      background-color: #f0f8ff;
    }
    .rentang-input {
      font-weight: bold;
    }
    .unit {
      font-size: 0.9em;
      display: block;
      margin-top: 5px;
    }
    .resolusi-input {
      width: 90%;
      margin: 0 auto;
      display: block;
    }
  </style>

  <table>
    <!-- Judul Bagian -->
    <tr>
      <td colspan="10" class="section-title">DC Voltage</td>
    </tr>

    <!-- Header Tabel -->
    <tr>
      <th rowspan="2">Rentang</th>
      <th colspan="2" rowspan="2">Penunjukan Alat</th>
      <th colspan="5">Pembacaan Standard</th>
      <th rowspan="2">Resolusi Alat</th>
    </tr>
    <tr>
      <th>1</th>
      <th>2</th>
      <th>3</th>
      <th>4</th>
      <th>5</th>
    </tr>

    <!-- Rentang 1: 0-100 mV -->
    <tr>
      <td rowspan="5">
        <input type="text" class="rentang-input" placeholder="0-100">
        <span class="unit">mV</span>
      </td>
      <td><input type="text" placeholder="0.0"></td>
      <td>mV</td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td rowspan="5"><input type="text" class="resolusi-input" placeholder="0.1"></td>
    </tr>
    <tr>
      <td><input type="text" placeholder="20.0"></td>
      <td>mV</td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
    </tr>
    <tr>
      <td><input type="text" placeholder="40.0"></td>
      <td>mV</td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
    </tr>
    <tr>
      <td><input type="text" placeholder="60.0"></td>
      <td>mV</td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
    </tr>
    <tr>
      <td><input type="text" placeholder="100.0"></td>
      <td>mV</td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
    </tr>
    
    
    <tr>
      <th rowspan="2">Rentang</th>
      <th colspan="2" rowspan="2">Penunjukan Alat</th>
      <th colspan="5">Pembacaan Standard</th>
      <th rowspan="2">Resolusi Alat</th>
    </tr>
    <tr>
      <th>1</th>
      <th>2</th>
      <th>3</th>
      <th>4</th>
      <th>5</th>
    </tr>

    <!-- Rentang 2: 0-100 V -->
    <tr>
      <td rowspan="5">
        <input type="text" class="rentang-input" placeholder="0-100">
        <span class="unit">V</span>
      </td>
      <td><input type="text" placeholder="0.0"></td>
      <td>V</td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td rowspan="5"><input type="text" class="resolusi-input" placeholder="0.1"></td>
    </tr>
    <tr>
      <td><input type="text" placeholder="20.0"></td>
      <td>V</td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
    </tr>
    <tr>
      <td><input type="text" placeholder="40.0"></td>
      <td>V</td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
    </tr>
    <tr>
      <td><input type="text" placeholder="60.0"></td>
      <td>V</td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
    </tr>
    <tr>
      <td><input type="text" placeholder="100.0"></td>
      <td>V</td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
    </tr>

    <!-- Rentang 3: 0-300 V -->
    <tr>
      <td rowspan="5">
        <input type="text" class="rentang-input" placeholder="0-300">
        <span class="unit">V</span>
      </td>
      <td><input type="text" placeholder="0.0"></td>
      <td>V</td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td rowspan="5"><input type="text" class="resolusi-input" placeholder="0.1"></td>
    </tr>
    <tr>
      <td><input type="text" placeholder="60.0"></td>
      <td>V</td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
    </tr>
    <tr>
      <td><input type="text" placeholder="120.0"></td>
      <td>V</td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
    </tr>
    <tr>
      <td><input type="text" placeholder="180.0"></td>
      <td>V</td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
    </tr>
    <tr>
      <td><input type="text" placeholder="300.0"></td>
      <td>V</td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
    </tr>

    <!-- Rentang 4: 0-600 V -->
    <tr>
      <td rowspan="5">
        <input type="text" class="rentang-input" placeholder="0-600">
        <span class="unit">V</span>
      </td>
      <td><input type="text" placeholder="0.0"></td>
      <td>V</td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td rowspan="5"><input type="text" class="resolusi-input" placeholder="1"></td>
    </tr>
    <tr>
      <td><input type="text" placeholder="120.0"></td>
      <td>V</td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
    </tr>
    <tr>
      <td><input type="text" placeholder="240.0"></td>
      <td>V</td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
    </tr>
    <tr>
      <td><input type="text" placeholder="360.0"></td>
      <td>V</td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
    </tr>
    <tr>
      <td><input type="text" placeholder="600.0"></td>
      <td>V</td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
    </tr>

    <!-- Rentang 5: 0-1000 V -->
    <tr>
      <td rowspan="5">
        <input type="text" class="rentang-input" placeholder="0-1000">
        <span class="unit">V</span>
      </td>
      <td><input type="text" placeholder="0.0"></td>
      <td>V</td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td rowspan="5"><input type="text" class="resolusi-input" placeholder="1"></td>
    </tr>
    <tr>
      <td><input type="text" placeholder="200.0"></td>
      <td>V</td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
    </tr>
    <tr>
      <td><input type="text" placeholder="400.0"></td>
      <td>V</td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
    </tr>
    <tr>
      <td><input type="text" placeholder="600.0"></td>
      <td>V</td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
    </tr>
    <tr>
      <td><input type="text" placeholder="1000.0"></td>
      <td>V</td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
    </tr>
  </table>

</body>
</html>



                <!-- Footer Section -->
               <html lang="id">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lembar Data Kalibrasi</title>
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      padding: 20px;
      background-color: #f9f9f9;
    }
    table {
      width: 100%;
      max-width: 1100px;
      margin: 20px auto;
      border-collapse: collapse;
      background-color: #fff;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    td {
      border: 1px solid #000;
      padding: 12px;
      text-align: center;
      vertical-align: middle;
    }
    .title {
      font-weight: bold;
      font-size: 18px;
      background-color: #f0f0f0;
    }
    .label {
      font-weight: bold;
      background-color: #e0e0e0;
    }
    input[type="text"] {
      width: 90%;
      border: none;
      background: transparent;
      text-align: center;
      padding: 5px;
      font-size: 1em;
    }
    input[type="text"]:focus {
      outline: 2px solid #4a90e2;
      background-color: #f0f8ff;
    }
    input[type="checkbox"] {
      transform: scale(1.3);
      margin: 0 8px;
    }
    .signature-box {
      height: 60px;
      vertical-align: bottom;
    }
    @media print {
      body { background: white; padding: 10px; }
      table { box-shadow: none; }
    }
  </style>

  <table>
    <tr>
      <td colspan="12" class="title">
        Isilah lembar data kalibrasi dengan lengkap dan jelas!
      </td>
    </tr>

    <!-- Baris Alat Standar -->
    <tr>
      <td rowspan="2" class="label">Alat Standar</td>
      <td colspan="5" rowspan="2">
        Multifunction Calibration System "Transmille 1000A"
      </td>
      <td colspan="3" class="label">Di Kalibrasi oleh</td>
      <td colspan="3" class="label">Di Periksa oleh</td>
    </tr>
    <tr>
      
    </tr>

    <!-- Baris Metode Kalibrasi -->
    <tr>
      <td rowspan="2" class="label">Metode Kalibrasi</td>
      <td colspan="5">
        <label>
          <input type="checkbox" name="metode">
          PAS-IK1102-43 A (Multimeter)
        </label>
      </td>
      <td colspan="3" style="text-align: left; padding-left: 20px;">
        TTD :
      </td>
      <td colspan="3" style="text-align: left; padding-left: 20px;">
        TTD :
      </td>
    </tr>
    <tr>
      <td colspan="5">
        <label>
          <input type="checkbox" name="metode">
          PAS-IK1102-43 B (Clamp Meter)
        </label>
      </td>
      <td colspan="3">
        Nama: <input type="text" placeholder="Masukkan nama">
      </td>
      <td colspan="3">
        Nama: <input type="text" placeholder="Masukkan nama">
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
var tempFormDataStore = window.tempFormDataStore;
var isRestoring = window.isRestoring;
var tabSubmitStatus = window.tabSubmitStatus;
var currentActiveTabId = '1';

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