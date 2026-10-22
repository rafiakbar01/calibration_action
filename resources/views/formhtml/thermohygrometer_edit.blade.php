<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Kalibrasi - PT. PANANJUNG ANUGRAH SOLUTION</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    /* Pastikan semua text berwarna hitam */
    .form-kalibrasi-container,
    .form-kalibrasi-container *:not(input):not(select):not(textarea):not(button) {
        color: #000000 !important;
    }
    
    /* Input fields readonly styling */
    .kalibrasi-input {
        color: #000000 !important;
        border: 1px solid #ced4da !important;
        padding: 6px 10px;
        border-radius: 4px;
        width: 100%;
        background-color: #f8f9fa;
    }
    
    .kalibrasi-input:read-only {
        background-color: #e9ecef;
        cursor: not-allowed;
    }

    /* Styling khusus untuk input suhu dan RH */
    .kondisi-input {
        border: 1px solid #000 !important;
        text-align: center;
        width: 100%;
        padding: 4px;
        background-color: #f8f9fa;
    }

    /* CHECKBOX STYLING */
    .form-check-input[type="checkbox"]:checked,
    .alat-standar-checkbox[type="checkbox"]:checked {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }

    .form-check-input[type="checkbox"]:checked:disabled,
    .alat-standar-checkbox[type="checkbox"]:checked:disabled {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
        opacity: 1 !important;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25) !important;
    }

    .form-check-input[type="checkbox"]:disabled,
    .alat-standar-checkbox[type="checkbox"]:disabled {
        background-color: #f8f9fa !important;
        border-color: #6c757d !important;
        opacity: 1 !important;
    }

    /* Checkmark putih untuk checkbox */
    .form-check-input[type="checkbox"]:checked,
    .alat-standar-checkbox[type="checkbox"]:checked {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='m6 10 3 3 6-6'/%3e%3c/svg%3e") !important;
    }

    .form-check-input[type="checkbox"]:checked:disabled,
    .alat-standar-checkbox[type="checkbox"]:checked:disabled {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='m6 10 3 3 6-6'/%3e%3c/svg%3e") !important;
    }

    /* RADIO BUTTON STYLING - FIXED */
    .form-check-input[type="radio"]:checked {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='2' fill='%23fff'/%3e%3c/svg%3e") !important;
    }

    .form-check-input[type="radio"]:checked:disabled {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
        opacity: 1 !important;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='2' fill='%23fff'/%3e%3c/svg%3e") !important;
    }

    .form-check-input[type="radio"]:disabled {
        background-color: #f8f9fa !important;
        border-color: #6c757d !important;
        opacity: 1 !important;
    }

    /* Custom radio button styling untuk yang tanpa class form-check-input */
    input[type="radio"]:checked {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
    }

    input[type="radio"]:checked:disabled {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
        opacity: 1 !important;
    }

    input[type="radio"]:disabled {
        background-color: #f8f9fa !important;
        border-color: #6c757d !important;
        opacity: 1 !important;
    }

    /* Styling khusus untuk checkbox alat standar */
    .alat-standar-checkbox {
        width: 18px;
        height: 18px;
        margin: 0;
        cursor: not-allowed;
    }

    /* Pastikan checkbox dan radio memiliki ukuran yang konsisten */
    .form-check-input[type="checkbox"],
    .alat-standar-checkbox[type="checkbox"] {
        border-radius: 0.25em;
    }

    .form-check-input[type="radio"],
    input[type="radio"] {
        border-radius: 50%;
    }

    /* Header styling */
    .kalibrasi-header-table {
        width: 100%;
        margin-bottom: 20px;
        border-collapse: collapse;
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
        border: 1px solid #dee2e6;
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

    /* Button styling dengan gradien biru */
    .btn-primary {
        background: linear-gradient(135deg, #3b82f6, #1e40af);
        border: none;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        transition: all 0.3s ease;
        color: white;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
        background: linear-gradient(135deg, #1e40af, #1e3a8a);
        color: white;
    }

    .btn-secondary {
        background: linear-gradient(135deg, #6b7280, #4b5563);
        border: none;
        box-shadow: 0 4px 15px rgba(107, 114, 128, 0.3);
        transition: all 0.3s ease;
        color: white;
    }

    .btn-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(107, 114, 128, 0.4);
        background: linear-gradient(135deg, #4b5563, #374151);
        color: white;
    }

    /* Styling untuk bagian "Data telah diisi dengan lengkap dan jelas!" */
    .data-complete-section {
        text-align: center;
        padding: 20px 0;
        margin: 20px 0;
        border-top: 2px solid #000;
        border-bottom: 2px solid #000;
    }

    .data-complete-text {
        font-weight: bold;
        font-size: 18px;
        color: #000;
    }

    /* Styling untuk tabel alat standar */
    .alat-standar-section {
        margin: 20px 0;
    }

    .alat-standar-table {
        width: 100%;
        border-collapse: collapse;
    }

    .alat-standar-table td {
        border: 1px solid #000;
        padding: 8px;
        vertical-align: middle;
    }

    /* Print styling */
    @media print {
        .btn {
            display: none !important;
        }
        
        body {
            background: white !important;
        }
        
        .container {
            max-width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
        }
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .kalibrasi-main-table td {
            padding: 4px;
        }
        
        .data-kalibrasi-header {
            font-size: 16px;
        }
        
        .btn-lg {
            padding: 10px 20px !important;
            font-size: 14px !important;
        }
    }
</style>
</head>
<body>
    <div class="container my-4">
        <div class="form-kalibrasi-container">
            <table class="kalibrasi-header-table">
                <tr>
                    <td colspan="2">
                        <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK50</p>
                    </td>
                    <td rowspan="5" style="text-align: center; vertical-align: middle; padding: 10px 0;">
                      <div style="display: inline-block; text-align: center;">
                          <div style="margin-bottom: 15px;">
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
                        <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">THERMOHYGROMETER</p>
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
                        <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;">{{ $calibration->headThermohygrometer->certificate_id ?? 'N/A' }}</p>
                    </td>
                </tr>
            </table>

            <!-- Main Form Section - Readonly -->
            <table class="kalibrasi-main-table">
                <!-- Nama Alat -->
                <tr>
                    <td style="width: 20%;">
                        <p style="margin: 0; color: #000000;">Nama Alat</p>
                    </td>
                    <td colspan="3">
                        <input type="text" name="namaAlat" class="kalibrasi-input" value="{{ $calibration->namaAlat }}"  >
                    </td>
                </tr>

                 <!-- Merek & Kode Alat -->
    <tr>
        <td><p style="margin: 0; color: #000000;">Merek</p></td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="text" class="kalibrasi-input me-3"
                       name="brandAlat"
                       value="{{ old('brandAlat', $calibration->brandAlat) }}" style="width:60%;">

                <span class="me-3" style="color:#000;">Kode Alat :</span>

                <input type="text" class="kalibrasi-input"
                       name="kodeAlat"
                       value="{{ old('kodeAlat', $calibration->kodeAlat) }}" style="width:30%;">
            </div>
        </td>
    </tr>

    <!-- Type / No. Seri -->
    <tr>
        <td><p style="margin: 0; color:#000;">Type / No. Seri</p></td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="text" class="kalibrasi-input me-3"
                       name="typeAlat"
                       value="{{ old('typeAlat', $calibration->typeAlat) }}" style="width:45%;">

                <span class="me-3" style="color:#000;">/</span>

                <input type="text" class="kalibrasi-input"
                       name="NoSeri"
                       value="{{ old('NoSeri', $calibration->NoSeri) }}" style="width:45%;">
            </div>
        </td>
    </tr>

    <!-- Kapasitas / Resolusi -->
    <tr>
        <td><p style="margin:0;color:#000;">Kapasitas / Resolusi</p></td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="text" class="kalibrasi-input me-3"
                       name="kapasitas"
                       value="{{ old('kapasitas', $calibration->kapasitas) }}" style="width:45%;">

                <span class="me-3" style="color:#000;">/</span>

                <input type="text" class="kalibrasi-input"
                       name="resolusi"
                       value="{{ old('resolusi', $calibration->resolusi) }}" style="width:45%;">
            </div>
        </td>
    </tr>

    <!-- Nama Pemilik -->
    <tr>
        <td><p style="margin:0;color:#000;">Nama Pemilik</p></td>
        <td colspan="3">
            <input type="text" class="kalibrasi-input"
                   name="pemilikAlat"
                   value="{{ old('pemilikAlat', $calibration->pemilikAlat) }}">
        </td>
    </tr>

    <!-- Tanggal -->
    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;" class="required-field">Tanggal Alat Masuk</p>
                        </td>
                        <td colspan="3">
                            <input type="date" class="kalibrasi-input" name="tanggalMasuk" 
                                   value="{{ old('tanggalMasuk', \Carbon\Carbon::parse($calibration->tanggalMasuk)->format('Y-m-d')) }}" >
                        </td>
                    </tr>

    <tr>
        <td><p style="margin:0;color:#000;">Tanggal Kalibrasi</p></td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="date" class="kalibrasi-input me-3"
                       name="tanggalKalibrasi"
                       value="{{ old('tanggalKalibrasi', $calibration->tanggalKalibrasi) }}" style="width:45%;">

                <span class="me-3" style="color:#000;">Jenis Pembacaan:</span>

                <input type="text" class="kalibrasi-input"
                       name="jenisPembacaan"
                       value="{{ old('jenisPembacaan', $calibration->jenisPembacaan) }}" style="width:45%;">
            </div>
        </td>
    </tr>

    <!-- Tempat Kalibrasi -->
    <tr>
        <td><p style="margin:0;color:#000;">Tempat Kalibrasi</p></td>
        <td colspan="3">
            <div class="d-flex">
                <div class="form-check me-5">
                    <input class="form-check-input" type="radio" name="tempatKalibrasi" value="lab.PT PAS"
                        {{ old('tempatKalibrasi',$calibration->tempatKalibrasi)=='lab.PT PAS'?'checked':'' }}>
                    <label class="form-check-label" style="color:#000;">Lab. PT.PAS</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tempatKalibrasi" value="insitu"
                        {{ old('tempatKalibrasi',$calibration->tempatKalibrasi)=='insitu'?'checked':'' }}>
                    <label class="form-check-label" style="color:#000;">Insitu</label>
                </div>
            </div>
        </td>
    </tr>

    <!-- Lokasi PT -->
    <tr>
        <td><p style="margin:0;color:#000;">Lokasi PT</p></td>
        <td colspan="3">
            <input type="text" class="kalibrasi-input"
                   name="lokasiPT"
                   value="{{ old('lokasiPT', $calibration->lokasiPT) }}">
        </td>
    </tr>
    
    <tr>
        <td><p style="margin:0;color:#000;">Kode TH</p></td>
        <td colspan="3">
            <input type="text" class="kalibrasi-input"
                   name="kode_th"
                   value="{{ old('kode_th', $calibration->kode_th) }}">
        </td>
    </tr>

</table>

           <!-- Fungsi Komponen Lainnya & Kondisi Kalibrasi -->
<div class="row mt-4">

    <!-- Fungsi Komponen Lainnya -->
    <div class="col-md-6 mb-4">
        <div class="kalibrasi-section-header" style="color:#000;">Fungsi Komponen Lainnya</div>

        <!-- Radio -->
        <div class="d-flex justify-content-center align-items-center mb-4" style="gap:60px;">
            <div class="text-center">
                <span class="fw-bold d-block mb-2" style="font-size:14px;">Ok</span>
                <input type="radio" name="kondisiAlat" value="ok"
                    class="form-check-input"
                    style="width:18px;height:18px;display:block;margin:0 auto;"
                    {{ $calibration->kondisiAlat == 'ok' ? 'checked' : '' }}>
            </div>
            <div class="text-center">
                <span class="fw-bold d-block mb-2" style="font-size:14px;">Rusak</span>
                <input type="radio" name="kondisiAlat" value="rusak"
                    class="form-check-input"
                    style="width:18px;height:18px;display:block;margin:0 auto;"
                    {{ $calibration->kondisiAlat == 'rusak' ? 'checked' : '' }}>
            </div>
        </div>

        <!-- Keterangan -->
        <div class="d-flex align-items-center">
            <span class="fw-bold me-3" style="min-width:100px;">Keterangan :</span>
            <div style="flex:1;">
                <input type="text"
                    name="keterangan"
                    class="kalibrasi-input"
                    value="{{ $calibration->keterangan }}"
                    style="border:none;border-bottom:2px solid #000;border-radius:0;padding:4px 0;background:transparent;width:100%;">
            </div>
        </div>
    </div>

    <!-- Kondisi Kalibrasi -->
    <div class="col-md-6 mb-4">
        <div class="kalibrasi-section-header" style="color:#000;">Kondisi Kalibrasi</div>

        <table class="table table-bordered">
            <tr>
                <td class="table-secondary fw-bold" style="width:30%;"></td>
                <td class="table-secondary fw-bold text-center">Awal</td>
                <td class="table-secondary fw-bold text-center">Tengah</td>
                <td class="table-secondary fw-bold text-center">Akhir</td>
            </tr>

            <tr>
                <td class="bg-light fw-bold">Suhu (°C)</td>
                <td><input type="text" name="RT_condition1" class="kondisi-input" value="{{ $calibration->RT_condition1 }}"></td>
                <td><input type="text" name="RT_condition2" class="kondisi-input" value="{{ $calibration->RT_condition2 }}"></td>
                <td><input type="text" name="RT_condition3" class="kondisi-input" value="{{ $calibration->RT_condition3 }}"></td>
            </tr>

            <tr>
                <td class="bg-light fw-bold">RH (%)</td>
                <td><input type="text" name="RH_condition1" class="kondisi-input" value="{{ $calibration->RH_condition1 }}"></td>
                <td><input type="text" name="RH_condition2" class="kondisi-input" value="{{ $calibration->RH_condition2 }}"></td>
                <td><input type="text" name="RH_condition3" class="kondisi-input" value="{{ $calibration->RH_condition3 }}"></td>
            </tr>
        </table>
    </div>
</div>


            <!-- Data Kalibrasi Section -->
            <div class="data-kalibrasi-header" style="color: #000000;">DATA KALIBRASI</div>
   <?php
// Ambil type dari database (asumsi dari model $calibration)
$type = $calibration->type ?? 'single';

// Gunakan switch case untuk menentukan template yang akan ditampilkan
switch ($type) {
    case 'in_out':
        // Template untuk type in_out (EDIT MODE)
        ?>
        <table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif;">
            <!-- Bagian Temperatur -->
            <tr>
                <td style="width: 5%;"></td>
                <td rowspan="2" style="width: 10%; border: 1px solid #000; font-weight: bold; text-align: center; vertical-align: middle; padding: 8px; background-color: #f2f2f2;">
                    Set Point<br><small>(°C)</small>
                </td>
                <td colspan="3" style="border: 1px solid #000; text-align: center; vertical-align: middle; padding: 8px; background-color: #f2f2f2; font-weight: bold;">
                    Pembacaan Standar °C
                </td>
                <td style="width: 3%;"></td>
                <td colspan="3" style="border: 1px solid #000; text-align: center; vertical-align: middle; padding: 8px; background-color: #f2f2f2; font-weight: bold;">
                    Pembacaan Alat IN °C
                </td>
                <td colspan="3" style="border: 1px solid #000; text-align: center; vertical-align: middle; padding: 8px; background-color: #f2f2f2; font-weight: bold;">
                    Pembacaan Alat OUT °C
                </td>
                <td colspan="2" style="width: 8%;"></td>
            </tr>
            
            <!-- Sub Header x1, x2, x3 untuk Temperatur -->
            <tr>
                <td></td>
                <td style="border: 1px solid #000; text-align: center; vertical-align: middle; padding: 5px; background-color: #f8f8f8; font-weight: bold;">
                    x<sub>1</sub>
                </td>
                <td style="border: 1px solid #000; text-align: center; vertical-align: middle; padding: 5px; background-color: #f8f8f8; font-weight: bold;">
                    x<sub>2</sub>
                </td>
                <td style="border: 1px solid #000; text-align: center; vertical-align: middle; padding: 5px; background-color: #f8f8f8; font-weight: bold;">
                    x<sub>3</sub>
                </td>
                <td></td>
                <td style="border: 1px solid #000; text-align: center; vertical-align: middle; padding: 5px; background-color: #f8f8f8; font-weight: bold;">
                    x<sub>1</sub>
                </td>
                <td style="border: 1px solid #000; text-align: center; vertical-align: middle; padding: 5px; background-color: #f8f8f8; font-weight: bold;">
                    x<sub>2</sub>
                </td>
                <td style="border: 1px solid #000; text-align: center; vertical-align: middle; padding: 5px; background-color: #f8f8f8; font-weight: bold;">
                    x<sub>3</sub>
                </td>
                <td style="border: 1px solid #000; text-align: center; vertical-align: middle; padding: 5px; background-color: #f8f8f8; font-weight: bold;">
                    x<sub>1</sub>
                </td>
                <td style="border: 1px solid #000; text-align: center; vertical-align: middle; padding: 5px; background-color: #f8f8f8; font-weight: bold;">
                    x<sub>2</sub>
                </td>
                <td style="border: 1px solid #000; text-align: center; vertical-align: middle; padding: 5px; background-color: #f8f8f8; font-weight: bold;">
                    x<sub>3</sub>
                </td>
                <td colspan="2"></td>
            </tr>
            
            <!-- Baris Data Temperatur - SELALU 7 BARIS -->
            <?php 
            $tempDetails = $calibration->detailThermohygrometers ?? [];
            for($i = 0; $i < 7; $i++): 
                $detail = $tempDetails[$i] ?? null;
            ?>
            <tr>
                <td></td>
                <td style="border: 1px solid #000; padding: 0;">
                    <input type="text" name="temp[<?php echo $i; ?>][set_point]" step="0.1" 
                           value="<?php echo $detail ? $detail->titikUkur_T : ''; ?>"
                           style="width: 100%; height: 35px; border: 1px solid #ddd; text-align: center; padding: 0 5px; font-size: 12px;"
                           >
                </td>
                <td style="border: 1px solid #000; padding: 0;">
                    <input type="text" name="temp[<?php echo $i; ?>][std_x1]"  
                           value="<?php echo $detail ? $detail->T_STD1 : ''; ?>"
                           style="width: 100%; height: 35px; border: 1px solid #ddd; text-align: center; padding: 0 5px; font-size: 12px;"
                           >
                </td>
                <td style="border: 1px solid #000; padding: 0;">
                    <input type="text" name="temp[<?php echo $i; ?>][std_x2]"  
                           value="<?php echo $detail ? $detail->T_STD2 : ''; ?>"
                           style="width: 100%; height: 35px; border: 1px solid #ddd; text-align: center; padding: 0 5px; font-size: 12px;"
                           >
                </td>
                <td style="border: 1px solid #000; padding: 0;">
                    <input type="text" name="temp[<?php echo $i; ?>][std_x3]"  
                           value="<?php echo $detail ? $detail->T_STD3 : ''; ?>"
                           style="width: 100%; height: 35px; border: 1px solid #ddd; text-align: center; padding: 0 5px; font-size: 12px;"
                           >
                </td>
                <td></td>
                <td style="border: 1px solid #000; padding: 0;">
                    <input type="text" name="temp[<?php echo $i; ?>][in_x1]"  
                           value="<?php echo $detail ? $detail->T_IN1 : ''; ?>"
                           style="width: 100%; height: 35px; border: 1px solid #ddd; text-align: center; padding: 0 5px; font-size: 12px;"
                           >
                </td>
                <td style="border: 1px solid #000; padding: 0;">
                    <input type="text" name="temp[<?php echo $i; ?>][in_x2]"  
                           value="<?php echo $detail ? $detail->T_IN2 : ''; ?>"
                           style="width: 100%; height: 35px; border: 1px solid #ddd; text-align: center; padding: 0 5px; font-size: 12px;"
                           >
                </td>
                <td style="border: 1px solid #000; padding: 0;">
                    <input type="text" name="temp[<?php echo $i; ?>][in_x3]"  
                           value="<?php echo $detail ? $detail->T_IN3 : ''; ?>"
                           style="width: 100%; height: 35px; border: 1px solid #ddd; text-align: center; padding: 0 5px; font-size: 12px;"
                           >
                </td>
                <td style="border: 1px solid #000; padding: 0;">
                    <input type="text" name="temp[<?php echo $i; ?>][out_x1]"  
                           value="<?php echo $detail ? ($detail->T_OUT1 ?? '') : ''; ?>"
                           style="width: 100%; height: 35px; border: 1px solid #ddd; text-align: center; padding: 0 5px; font-size: 12px;"
                           >
                </td>
                <td style="border: 1px solid #000; padding: 0;">
                    <input type="text" name="temp[<?php echo $i; ?>][out_x2]"  
                           value="<?php echo $detail ? ($detail->T_OUT2 ?? '') : ''; ?>"
                           style="width: 100%; height: 35px; border: 1px solid #ddd; text-align: center; padding: 0 5px; font-size: 12px;"
                           >
                </td>
                <td style="border: 1px solid #000; padding: 0;">
                    <input type="text" name="temp[<?php echo $i; ?>][out_x3]"  
                           value="<?php echo $detail ? ($detail->T_OUT3 ?? '') : ''; ?>"
                           style="width: 100%; height: 35px; border: 1px solid #ddd; text-align: center; padding: 0 5px; font-size: 12px;"
                           >
                </td>
                <td colspan="2"></td>
            </tr>
            <?php endfor; ?>
            
            <!-- Spacer -->
            <tr style="height: 20px;">
                <td colspan="14"></td>
            </tr>
            
            <!-- Bagian Kelembaban - SELALU 7 BARIS -->
            <tr>
                <td></td>
                <td rowspan="2" style="border: 1px solid #000; font-weight: bold; text-align: center; vertical-align: middle; padding: 8px; background-color: #f2f2f2;">
                    Set Point<br><small>(%rh)</small>
                </td>
                <td colspan="3" style="border: 1px solid #000; text-align: center; vertical-align: middle; padding: 8px; background-color: #f2f2f2; font-weight: bold;">
                    Pembacaan Standar %rh
                </td>
                <td></td>
                <td colspan="3" style="border: 1px solid #000; text-align: center; vertical-align: middle; padding: 8px; background-color: #f2f2f2; font-weight: bold;">
                    Pembacaan Alat %rh
                </td>
                <td colspan="5"></td>
            </tr>
            
            <!-- Sub Header x1, x2, x3 untuk Kelembaban -->
            <tr>
                <td></td>
                <td style="border: 1px solid #000; text-align: center; vertical-align: middle; padding: 5px; background-color: #f8f8f8; font-weight: bold;">
                    x<sub>1</sub>
                </td>
                <td style="border: 1px solid #000; text-align: center; vertical-align: middle; padding: 5px; background-color: #f8f8f8; font-weight: bold;">
                    x<sub>2</sub>
                </td>
                <td style="border: 1px solid #000; text-align: center; vertical-align: middle; padding: 5px; background-color: #f8f8f8; font-weight: bold;">
                    x<sub>3</sub>
                </td>
                <td></td>
                <td style="border: 1px solid #000; text-align: center; vertical-align: middle; padding: 5px; background-color: #f8f8f8; font-weight: bold;">
                    x<sub>1</sub>
                </td>
                <td style="border: 1px solid #000; text-align: center; vertical-align: middle; padding: 5px; background-color: #f8f8f8; font-weight: bold;">
                    x<sub>2</sub>
                </td>
                <td style="border: 1px solid #000; text-align: center; vertical-align: middle; padding: 5px; background-color: #f8f8f8; font-weight: bold;">
                    x<sub>3</sub>
                </td>
                <td colspan="5"></td>
            </tr>
            
            <?php 
            $humidityDetails = $calibration->detailThermohygrometers ?? [];
            for($i = 0; $i < 7; $i++): 
                $detail = $humidityDetails[$i] ?? null;
            ?>
            <tr>
                <td></td>
                <td style="border: 1px solid #000; padding: 0;">
                    <input type="text" name="humidity[<?php echo $i; ?>][set_point]" step="0.1" 
                           value="<?php echo $detail ? $detail->titikUkur_RH : ''; ?>"
                           style="width: 100%; height: 35px; border: 1px solid #ddd; text-align: center; padding: 0 5px; font-size: 12px;"
                           >
                </td>
                <td style="border: 1px solid #000; padding: 0;">
                    <input type="text" name="humidity[<?php echo $i; ?>][std_x1]"  
                           value="<?php echo $detail ? $detail->RH_STD1 : ''; ?>"
                           style="width: 100%; height: 35px; border: 1px solid #ddd; text-align: center; padding: 0 5px; font-size: 12px;"
                           >
                </td>
                <td style="border: 1px solid #000; padding: 0;">
                    <input type="text" name="humidity[<?php echo $i; ?>][std_x2]"  
                           value="<?php echo $detail ? $detail->RH_STD2 : ''; ?>"
                           style="width: 100%; height: 35px; border: 1px solid #ddd; text-align: center; padding: 0 5px; font-size: 12px;"
                           >
                </td>
                <td style="border: 1px solid #000; padding: 0;">
                    <input type="text" name="humidity[<?php echo $i; ?>][std_x3]"  
                           value="<?php echo $detail ? $detail->RH_STD3 : ''; ?>"
                           style="width: 100%; height: 35px; border: 1px solid #ddd; text-align: center; padding: 0 5px; font-size: 12px;"
                           >
                </td>
                <td></td>
                <td style="border: 1px solid #000; padding: 0;">
                    <input type="text" name="humidity[<?php echo $i; ?>][alat_x1]"  
                           value="<?php echo $detail ? $detail->RH_ALAT1 : ''; ?>"
                           style="width: 100%; height: 35px; border: 1px solid #ddd; text-align: center; padding: 0 5px; font-size: 12px;"
                           >
                </td>
                <td style="border: 1px solid #000; padding: 0;">
                    <input type="text" name="humidity[<?php echo $i; ?>][alat_x2]"  
                           value="<?php echo $detail ? $detail->RH_ALAT2 : ''; ?>"
                           style="width: 100%; height: 35px; border: 1px solid #ddd; text-align: center; padding: 0 5px; font-size: 12px;"
                           >
                </td>
                <td style="border: 1px solid #000; padding: 0;">
                    <input type="text" name="humidity[<?php echo $i; ?>][alat_x3]"  
                           value="<?php echo $detail ? $detail->RH_ALAT3 : ''; ?>"
                           style="width: 100%; height: 35px; border: 1px solid #ddd; text-align: center; padding: 0 5px; font-size: 12px;"
                           >
                </td>
                <td colspan="5"></td>
            </tr>
            <?php endfor; ?>
        </table>
        <?php
        break;
        
    case 'single':
    default:
        // Template untuk type single - SELALU 10 BARIS
        ?>
        <table class="table table-bordered border-dark w-100">
            <thead>
                <tr class="text-center align-middle">
                    <th rowspan="2" class="text-center border-dark">
                        Set Point<br>°C
                    </th>
                    <th colspan="3" class="fw-bold border-dark">Pembacaan Standar °C</th>
                    <th colspan="3" class="fw-bold border-dark">Pembacaan Alat °C</th>
                </tr>
                <tr class="text-center align-middle">
                    <th class="border-dark">x<sub>1</sub></th>
                    <th class="border-dark">x<sub>2</sub></th>
                    <th class="border-dark">x<sub>3</sub></th>
                    <th class="border-dark">x<sub>1</sub></th>
                    <th class="border-dark">x<sub>2</sub></th>
                    <th class="border-dark">x<sub>3</sub></th>
                </tr>
            </thead>

            <tbody>
                <?php 
                $tempDetails = $calibration->detailThermohygrometers ?? [];
                // SELALU tampilkan 10 baris, walaupun datanya kurang
                for ($i = 1; $i <= 10; $i++): 
                    $detail = $tempDetails[$i-1] ?? null;
                ?>
                <tr>
                    <td class="p-0 border-dark">
                        <input type="text" name="t_set<?php echo $i; ?>"
                            value="<?php echo $detail ? $detail->titikUkur_T : ''; ?>"
                            class="form-control text-center border-dark fs-5 py-3"
                            >
                    </td>

                    <?php for ($j = 1; $j <= 3; $j++): ?>
                    <td class="p-0 border-dark">
                        <input type="text" name="t_std<?php echo $i; ?>_<?php echo $j; ?>"
                            value="<?php 
                                if($detail) {
                                    switch($j) {
                                        case 1: echo $detail->T_STD1; break;
                                        case 2: echo $detail->T_STD2; break;
                                        case 3: echo $detail->T_STD3; break;
                                    }
                                } else {
                                    echo '';
                                }
                            ?>"
                            class="form-control text-center border-dark fs-5 py-3"
                            >
                    </td>
                    <?php endfor; ?>

                    <?php for ($j = 1; $j <= 3; $j++): ?>
                    <td class="p-0 border-dark">
                        <input type="text" name="t_inst<?php echo $i; ?>_<?php echo $j; ?>"
                            value="<?php 
                                if($detail) {
                                    switch($j) {
                                        case 1: echo $detail->T_IN1; break;
                                        case 2: echo $detail->T_IN2; break;
                                        case 3: echo $detail->T_IN3; break;
                                    }
                                } else {
                                    echo '';
                                }
                            ?>"
                            class="form-control text-center border-dark fs-5 py-3"
                            >
                    </td>
                    <?php endfor; ?>
                </tr>
                <?php endfor; ?>
            </tbody>
        </table>

        <table class="table table-bordered border-dark w-100 mt-4">
            <thead>
                <tr class="text-center align-middle">
                    <th rowspan="2" class="text-center border-dark">
                        Set Point<br>(%rh)
                    </th>
                    <th colspan="3" class="fw-bold border-dark">Pembacaan Standar %rh</th>
                    <th colspan="3" class="fw-bold border-dark">Pembacaan Alat %rh</th>
                </tr>

                <tr class="text-center align-middle">
                    <th class="border-dark">x<sub>1</sub></th>
                    <th class="border-dark">x<sub>2</sub></th>
                    <th class="border-dark">x<sub>3</sub></th>
                    <th class="border-dark">x<sub>1</sub></th>
                    <th class="border-dark">x<sub>2</sub></th>
                    <th class="border-dark">x<sub>3</sub></th>
                </tr>
            </thead>

            <tbody>
                <?php 
                $humidityDetails = $calibration->detailThermohygrometers ?? [];
                // SELALU tampilkan 10 baris, walaupun datanya kurang
                for ($i = 1; $i <= 10; $i++): 
                    $detail = $humidityDetails[$i-1] ?? null;
                ?>
                <tr>
                    <td class="p-0 border-dark">
                        <input type="text" name="h_set<?php echo $i; ?>"
                            value="<?php echo $detail ? $detail->titikUkur_RH : ''; ?>"
                            class="form-control text-center border-dark fs-5 py-3"
                            >
                    </td>

                    <?php for ($j = 1; $j <= 3; $j++): ?>
                    <td class="p-0 border-dark">
                        <input type="text" name="h_std<?php echo $i; ?>_<?php echo $j; ?>"
                            value="<?php 
                                if($detail) {
                                    switch($j) {
                                        case 1: echo $detail->RH_STD1; break;
                                        case 2: echo $detail->RH_STD2; break;
                                        case 3: echo $detail->RH_STD3; break;
                                    }
                                } else {
                                    echo '';
                                }
                            ?>"
                            class="form-control text-center border-dark fs-5 py-3"
                            >
                    </td>
                    <?php endfor; ?>

                    <?php for ($j = 1; $j <= 3; $j++): ?>
                    <td class="p-0 border-dark">
                        <input type="text" name="h_inst<?php echo $i; ?>_<?php echo $j; ?>"
                            value="<?php 
                                if($detail) {
                                    switch($j) {
                                        case 1: echo $detail->RH_ALAT1; break;
                                        case 2: echo $detail->RH_ALAT2; break;
                                        case 3: echo $detail->RH_ALAT3; break;
                                    }
                                } else {
                                    echo '';
                                }
                            ?>"
                            class="form-control text-center border-dark fs-5 py-3"
                            >
                    </td>
                    <?php endfor; ?>
                </tr>
                <?php endfor; ?>
            </tbody>
        </table>
        <?php
        break;
}
?>

&nbsp;  &nbsp;

    <div class="data-complete-section">
                        <span class="data-complete-text">Data telah diisi dengan lengkap dan jelas!</span>
                    </div>

                 <!-- Footer Section -->
             <?php
// Ambil type dari database (asumsi dari model $calibration)
$type = $calibration->type ?? 'single';

// Gunakan switch case untuk menentukan template yang akan ditampilkan
switch ($type) {
    case 'in_out':
        // Template untuk type in_out (EDIT MODE)
        ?>
        <table class="kalibrasi-main-table" style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif; border: 1px solid #000;">
            <!-- BARIS 1: ALAT STANDAR (MERGE 2 ROW) + DIKALIBRASI & DIPERIKSA OLEH -->
            <tr style="height: 60px;">
                <!-- Alat Standar Label (merge 2 row) -->
                <td rowspan="2" style="width: 15%; border-right: 1px solid #000; border-bottom: 1px solid #000; vertical-align: middle; text-align: center; font-weight: bold; font-size: 10pt; color: #000000; background-color: #f8f9fa;">
                    Alat<br>Standar
                </td>

                <!-- Alat Standar Content (merge 2 row) -->
                <td rowspan="2" colspan="4" style="border-right: 1px solid #000; border-bottom: 1px solid #000; padding: 8px; font-size: 9pt; vertical-align: middle; color: #000000;">
                    <input type="text" 
                           name="standard" 
                           value="<?php echo htmlspecialchars($calibration->headThermohygrometer->standard ?? 'Temperature & Humidity Transmitter, Rotronic, 71946262; 20345594'); ?>"
                           style="width: 100%; border: 1px solid #ddd; outline: none; padding: 5px; font-size: 9pt;"
                             readonly>
                </td>

                <!-- Dikalibrasi oleh (sejajar dengan alat standar) -->
                <td style="width: 15%; border-right: 1px solid #000; border-bottom: 1px solid #000; text-align: center; vertical-align: middle; font-size: 10pt; color: #000000; background-color: #f8f9fa;">
                    <strong>Dikalibrasi<br>oleh</strong>
                </td>
                
                <!-- Diperiksa oleh (sejajar dengan alat standar) -->
                <td style="width: 15%; border-right: 1px solid #000; border-bottom: 1px solid #000; text-align: center; vertical-align: middle; font-size: 10pt; color: #000000; background-color: #f8f9fa;">
                    <strong>Diperiksa<br>oleh</strong>
                </td>
            </tr>

            <!-- BARIS 2: INPUT NAMA (SEJAJAR DENGAN ALAT STANDAR) -->
            <tr style="height: 40px;">
                <!-- Kolom-kolom kosong untuk menjaga struktur -->
                <!-- Tidak ada konten di baris ini untuk template in_out -->
            </tr>

            <!-- BARIS 3: METODE KALIBRASI + TTD -->
            <tr style="height: 40px;">
                <!-- Metode Kalibrasi Label -->
                <td style="border-right: 1px solid #000; border-bottom: 1px solid #000; text-align: center; vertical-align: middle; font-size: 9pt; color: #000000; background-color: #f8f9fa;">
                    <strong>Metode<br>Kalibrasi</strong>
                </td>
                
               <!-- Isi Metode Kalibrasi -->
                <td colspan="4" style="border-right: 1px solid #000; border-bottom: 1px solid #000; padding: 10px; font-size: 9pt; vertical-align: middle; color: #000000;">
                    <?php 
                    $method = $calibration->headThermohygrometer->calibrationMethod ?? 'PAS-IK1102-50';
                    echo htmlspecialchars($method);
                    ?>
                </td>
                
                <!-- TTD Dikalibrasi (sejajar dengan metode) -->
                <td style="border-right: 1px solid #000; border-bottom: 1px solid #000; padding: 8px; font-size: 9pt; vertical-align: middle; color: #000000; text-align: center;">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <span style="font-weight: bold;">TTD :</span>
                        <?php if(isset($calibration->headThermohygrometer) && !empty($calibration->headThermohygrometer->ttd_calibrated_by)): ?>
                           
                        <?php endif; ?>
                       
                    </div>
                </td>
                
                <!-- TTD Diperiksa (sejajar dengan metode) -->
                <td style="border-right: 1px solid #000; border-bottom: 1px solid #000; padding: 8px; font-size: 9pt; vertical-align: middle; color: #000000; text-align: center;">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <span style="font-weight: bold;">TTD :</span>
                        <?php if(isset($calibration->headThermohygrometer) && !empty($calibration->headThermohygrometer->ttd_verified_by)): ?>
                           
                        <?php endif; ?>
                      
                    </div>
                </td>
            </tr>

            <!-- BARIS 4: TERTELUSUR + NAMA -->
            <tr style="height: 40px;">
                <!-- Tertelusur Label -->
                <td style="border-right: 1px solid #000; border-bottom: 1px solid #000; text-align: center; vertical-align: middle; font-size: 9pt; color: #000000; background-color: #f8f9fa;">
                    <strong>Tertelusur</strong>
                </td>
                
                <!-- Isi Tertelusur -->
                <td colspan="4" style="border-right: 1px solid #000; border-bottom: 1px solid #000; padding: 10px; font-size: 9pt; vertical-align: middle; color: #000000;">
                    <input type="text" 
                           name="traceable" 
                           value="<?php echo htmlspecialchars($calibration->headThermohygrometer->traceable ?? 'Certus Metrology'); ?>"
                           style="width: 100%; border: 1px solid #ddd; outline: none; padding: 5px; font-size: 9pt;"
                           required readonly>
                </td>
                
                <!-- Nama Dikalibrasi (sejajar dengan tertelusur) -->
                <td style="border-right: 1px solid #000; border-bottom: 1px solid #000; padding: 8px; font-size: 9pt; vertical-align: middle; color: #000000; text-align: center;">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <span style="font-weight: bold;">Nama :</span>
                        <input type="text" 
                            name="calibratedBy" 
                            class="kalibrasi-input" 
                            value="<?php echo htmlspecialchars($calibration->headThermohygrometer->calibrated_by ?? $calibration->calibratedBy ?? ''); ?>"
                            placeholder="Nama lengkap" 
                            style="width: 70%; border: 1px solid #ddd; outline: none; padding: 5px; font-size: 9pt; background: white; text-align: center; margin-left: 5px;"
                            required>
                    </div>
                </td>
                
                <!-- Nama Diperiksa (sejajar dengan tertelusur) -->
                <td style="border-right: 1px solid #000; border-bottom: 1px solid #000; padding: 8px; font-size: 9pt; vertical-align: middle; color: #000000; text-align: center;">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <span style="font-weight: bold;">Nama :</span>
                        <input type="text" 
                            name="verifiedBy" 
                            class="kalibrasi-input" 
                            value="<?php echo htmlspecialchars($calibration->headThermohygrometer->verified_by ?? $calibration->verifiedBy ?? ''); ?>"
                            placeholder="-" 
                            style="width: 70%; border: 1px solid #ddd; outline: none; padding: 5px; font-size: 9pt; background: white; text-align: center; margin-left: 5px;"
                            readonly>
                    </div>
                </td>
            </tr>
        </table>
        <?php
        break;
        
    case 'single':
    default:
        // Template untuk type single (EDIT MODE)
        ?>
        <table class="kalibrasi-main-table" style="width: 100%; border-collapse: collapse;">
            <!-- ALAT STANDAR + CHECKBOX (MODIFIED FOR 2 TOOLS) -->
            <tr style="height: 40px;">
                <td rowspan="2" style="width: 20%; border: 1px solid #000; vertical-align: middle; text-align: center; font-weight: bold; font-size: 10pt; color: #000000; background-color: #f8f9fa;">
                    Alat<br>Standar
                </td>

                <!-- Alat 1 -->
                <td style="width: 5%; border: 1px solid #000; text-align: center; vertical-align: middle;">
                    <input type="radio" 
                           name="standard" 
                           value="Temperature & Humidity Transmitter, Rotronic,T017" 
                           id="alat1" 
                           class="form-check-input"
                           style="width: 18px; height: 18px; cursor: pointer;"
                           <?php 
                           $standard = isset($calibration->headThermohygrometer) ? $calibration->headThermohygrometer->standard : '';
                           echo ($standard == 'Temperature & Humidity Transmitter, Rotronic,T017') ? 'checked' : ''; 
                           ?>
                           required>
                </td>
                <td colspan="2" style="border: 1px solid #000; padding-left: 12px; font-size: 9pt; vertical-align: middle; color: #000000;">
                    <label for="alat1" style="cursor: pointer; color: #000000; display: block; padding: 5px 0;">
                        Temperature & Humidity Transmitter, Rotronic,T017
                    </label>
                </td>

                <!-- Dikalibrasi oleh -->
                <td rowspan="2" style="width: 20%; border: 1px solid #000; text-align: center; vertical-align: top; font-size: 9pt; color: #000000; background-color: #f8f9fa; padding-top: 15px;">
                    <strong>Dikalibrasi<br>oleh</strong>
                </td>
                <!-- Diperiksa oleh -->
                <td rowspan="2" style="width: 20%; border: 1px solid #000; text-align: center; vertical-align: top; font-size: 9pt; color: #000000; background-color: #f8f9fa; padding-top: 15px;">
                    <strong>Diperiksa<br>oleh</strong>
                </td>
            </tr>

            <!-- Alat 2 -->
            <tr style="height: 40px;">
                <td style="border: 1px solid #000; text-align: center; vertical-align: middle;">
                    <input type="radio" 
                           name="standard" 
                           value="Temperature & Humidity, LUTRON, T006" 
                           id="alat2" 
                           class="form-check-input"
                           style="width: 18px; height: 18px; cursor: pointer;"
                           <?php 
                           $standard = isset($calibration->headThermohygrometer) ? $calibration->headThermohygrometer->standard : '';
                           echo ($standard == 'Temperature & Humidity, LUTRON, T006') ? 'checked' : ''; 
                           ?>
                           required>
                </td>
                <td colspan="2" style="border: 1px solid #000; padding-left: 12px; font-size: 9pt; vertical-align: middle; color: #000000;">
                    <label for="alat2" style="cursor: pointer; color: #000000; display: block; padding: 5px 0;">
                        Temperature & Humidity, LUTRON, T006
                    </label>
                </td>
            </tr>

            <!-- METODE KALIBRASI + TTD & NAMA (2 BARIS) -->
            <tr style="height: 40px;">
                <!-- Metode Kalibrasi (Bagian Atas) -->
                <td rowspan="2" style="width: 20%; border: 1px solid #000; text-align: center; vertical-align: middle; font-size: 9pt; color: #000000; background-color: #f8f9fa; padding: 10px;">
                    <strong>Metode Kalibrasi</strong>
                </td>
                
                <!-- Isi Metode Kalibrasi -->
                <td colspan="3" rowspan="2" style="border: 1px solid #000; padding: 10px; font-size: 9pt; vertical-align: middle; color: #000000; line-height: 1.4;">
                    <input type="text" 
                           name="metode" 
                           value="<?php echo htmlspecialchars(isset($calibration->headThermohygrometer) ? $calibration->headThermohygrometer->calibrationMethod : 'PAS-IK1102-50'); ?>"
                           style="width: 100%; border: 1px solid #ddd; outline: none; padding: 5px; font-size: 9pt;"
                           readonly>
                </td>
                
                <!-- Input Nama Dikalibrasi Oleh -->
                <td style="width: 20%; border: 1px solid #000; padding: 5px; font-size: 9pt; vertical-align: middle; color: #000000;">
                    <input type="text" 
                        name="calibratedBy" 
                        class="kalibrasi-input" 
                        value="<?php echo htmlspecialchars($calibration->headThermohygrometer->calibrated_by ?? $calibration->calibratedBy ?? ''); ?>"
                        placeholder="Nama Lengkap" 
                        style="width: 100%; border: 1px solid #ddd; outline: none; padding: 5px; font-size: 9pt; background: white;"
                        readonly>
                </td>
                
                <!-- Input Nama Diperiksa Oleh -->
                <td style="width: 20%; border: 1px solid #000; padding: 5px; font-size: 9pt; vertical-align: middle; color: #000000;">
                    <input type="text" 
                        name="verifiedBy" 
                        class="kalibrasi-input" 
                        value="<?php echo htmlspecialchars($calibration->headThermohygrometer->verified_by ?? $calibration->verifiedBy ?? ''); ?>"
                        placeholder="Nama Lengkap" 
                        style="width: 100%; border: 1px solid #ddd; outline: none; padding: 5px; font-size: 9pt; background: white;"
                        required>
                </td>
            </tr>

            <!-- BARIS TTD (Bagian Bawah dari Metode Kalibrasi) -->
            <tr style="height: 40px;">
                <!-- Kolom untuk TTD Dikalibrasi Oleh -->
                <td style="width: 20%; border: 1px solid #000; padding: 10px; font-size: 9pt; vertical-align: middle; color: #000000; text-align: left;">
                    <strong>TTD :</strong>
                    <?php if(isset($calibration->headThermohygrometer) && !empty($calibration->headThermohygrometer->ttd_calibrated_by)): ?>
                        
                    <?php endif; ?>
                  
                </td>
                
                <!-- Kolom untuk TTD Diperiksa Oleh -->
                <td style="width: 20%; border: 1px solid #000; padding: 10px; font-size: 9pt; vertical-align: middle; color: #000000; text-align: left;">
                    <strong>TTD :</strong>
                    <?php if(isset($calibration->headThermohygrometer) && !empty($calibration->headThermohygrometer->ttd_verified_by)): ?>
                       
                    <?php endif; ?>
                    <!-- Input file untuk upload TTD baru -->
                  
                </td>
            </tr>
        </table>
        <?php
        break;
}
?>

            <!-- Action Buttons Section -->
           <div class="row mt-5">
                    <div class="col-12 text-center">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary btn-lg" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
                            <i class="fas fa-times me-2"></i>Batal
                        </a>
                        
                        <button type="submit" class="btn btn-success btn-lg ms-3" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
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

        // Form validation
        document.getElementById('editForm')?.addEventListener('submit', function(e) {
            let isValid = true;
            let errorMessage = '';
            
            // Check required fields
            const requiredFields = document.querySelectorAll('[required]');
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.style.borderColor = '#dc3545';
                } else {
                    field.style.borderColor = '';
                }
            });
            
            // Check radio buttons for kondisi alat
            const kondisiAlat = document.querySelector('input[name="kondisiAlat"]:checked');
            if (!kondisiAlat) {
                isValid = false;
                errorMessage += 'Pilih kondisi alat (Ok/Rusak)\n';
            }
            
            // Check tempat kalibrasi
            const tempatKalibrasi = document.querySelector('input[name="tempatKalibrasi"]:checked');
            if (!tempatKalibrasi) {
                isValid = false;
                errorMessage += 'Pilih tempat kalibrasi\n';
            }
            
            // Validate date order
            const tanggalMasuk = document.querySelector('input[name="tanggalMasuk"]').value;
            const tanggalKalibrasi = document.querySelector('input[name="tanggalKalibrasi"]').value;
            
            if (tanggalMasuk && tanggalKalibrasi) {
                if (new Date(tanggalMasuk) > new Date(tanggalKalibrasi)) {
                    isValid = false;
                    errorMessage += 'Tanggal alat masuk tidak boleh lebih baru dari tanggal kalibrasi\n';
                }
            }
            
            if (!isValid) {
                e.preventDefault();
                alert('Mohon lengkapi semua data yang diperlukan:\n' + errorMessage);
            }
        });
        
        // Add input validation for numeric fields
        document.querySelectorAll('input[type="number"]').forEach(input => {
            input.addEventListener('input', function() {
                if (this.value < 0 && this.getAttribute('min') === null) {
                    this.value = Math.abs(this.value);
                }
            });
        });
        
        // Auto format date display
        document.querySelectorAll('input[type="date"]').forEach(input => {
            input.addEventListener('change', function() {
                if (this.value) {
                    // Format untuk display (opsional)
                    const date = new Date(this.value);
                    const formattedDate = date.toLocaleDateString('id-ID', {
                        day: '2-digit',
                        month: '2-digit',
                        year: 'numeric'
                    });
                    // Anda bisa menambahkan display format di sini jika diperlukan
                }
            });
        });
    </script>

   <script>
    document.getElementById('editForm')?.addEventListener('submit', function(e) {
        console.log('🎯 Edit form submission started...');
        
        // Debug form data
        const formData = new FormData(this);
        console.log('📦 Form data collected for update');
        
        // Log titikUkur array
        const titikUkurInputs = document.querySelectorAll('input[name="titikUkur[]"]');
        console.log('🔢 titikUkur inputs count:', titikUkurInputs.length);
        titikUkurInputs.forEach((input, index) => {
            console.log(`📝 titikUkur[${index}]:`, input.value);
        });
        
        // Log alat standar checkboxes
        const alatStandarCheckboxes = document.querySelectorAll('.alat-standar-checkbox:checked');
        console.log('✅ Checked alat standar:', alatStandarCheckboxes.length);
        alatStandarCheckboxes.forEach((checkbox, index) => {
            console.log(`🔧 Alat standar ${index + 1}:`, checkbox.value);
        });
        
        // Log kondisi alat radio
        const kondisiAlatSelected = document.querySelector('input[name="kondisiAlat"]:checked');
        console.log('🎚️ Kondisi alat selected:', kondisiAlatSelected ? kondisiAlatSelected.value : 'none');
        
        // Log tempat kalibrasi radio
        const tempatKalibrasiSelected = document.querySelector('input[name="tempatKalibrasi"]:checked');
        console.log('📍 Tempat kalibrasi selected:', tempatKalibrasiSelected ? tempatKalibrasiSelected.value : 'none');
        
        // HANYA BASIC VALIDATION untuk edit form (tidak ada required)
        let isValid = true;
        let warningMessages = [];
        
        // 1. Validasi tanggal (jika diisi)
        const tanggalMasuk = document.querySelector('input[name="tanggalMasuk"]').value;
        const tanggalKalibrasi = document.querySelector('input[name="tanggalKalibrasi"]').value;
        
        if (tanggalMasuk && tanggalKalibrasi) {
            if (new Date(tanggalMasuk) > new Date(tanggalKalibrasi)) {
                warningMessages.push('Tanggal alat masuk tidak boleh lebih baru dari tanggal kalibrasi');
                console.warn('⚠️ Date validation warning: masuk > kalibrasi');
            }
        }
        
        // 2. Validasi numeric fields (jika diisi)
        document.querySelectorAll('input[type="number"]').forEach(input => {
            if (input.value && isNaN(parseFloat(input.value))) {
                input.style.borderColor = '#ffc107';
                warningMessages.push(`${input.name} harus berupa angka`);
                console.warn(`⚠️ ${input.name} is not a valid number`);
            } else {
                input.style.borderColor = '';
            }
        });
        
       
        
        // 4. Validasi alat standar (minimal satu dipilih)
        if (alatStandarCheckboxes.length === 0) {
            const alatStandarSection = document.querySelector('.alat-standar-table');
            if (alatStandarSection) {
                alatStandarSection.style.border = '2px solid #ffc107';
                warningMessages.push('Pilih minimal satu alat standar');
                console.warn('⚠️ No alat standar selected');
            }
        } else {
            const alatStandarSection = document.querySelector('.alat-standar-table');
            if (alatStandarSection) alatStandarSection.style.border = '';
        }
        
        // 5. Validasi kondisi alat (harus dipilih)
        if (!kondisiAlatSelected) {
            const kondisiSection = document.querySelector('.kalibrasi-section-header');
            if (kondisiSection) {
                kondisiSection.style.color = '#ffc107';
                warningMessages.push('Pilih kondisi alat (Ok/Rusak)');
                console.warn('⚠️ No kondisi alat selected');
            }
        } else {
            const kondisiSection = document.querySelector('.kalibrasi-section-header');
            if (kondisiSection) kondisiSection.style.color = '';
        }
        
        // 6. Validasi tempat kalibrasi (harus dipilih)
        if (!tempatKalibrasiSelected) {
            const tempatSection = document.querySelector('input[name="tempatKalibrasi"]').closest('tr');
            if (tempatSection) {
                tempatSection.style.backgroundColor = '#fff8e1';
                warningMessages.push('Pilih tempat kalibrasi');
                console.warn('⚠️ No tempat kalibrasi selected');
            }
        }
        
        // Tampilkan warning jika ada, tapi masih bisa submit
        if (warningMessages.length > 0) {
            const shouldProceed = confirm(
                '⚠️ Peringatan:\n' + 
                warningMessages.join('\n') + 
                '\n\nApakah Anda yakin ingin melanjutkan?'
            );
            
            if (!shouldProceed) {
                e.preventDefault();
                console.log('⛔ User cancelled submission due to warnings');
                return false;
            }
        }
        
        console.log('🚀 Form validation passed, submitting...');
        
        // Add loading indicator
        const submitBtn = this.querySelector('button[type="submit"]');
        if (submitBtn) {
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan Perubahan...';
            submitBtn.disabled = true;
            
            // Reset button setelah 10 detik jika ada error
            setTimeout(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 10000);
        }
        
        // Log data yang akan dikirim (optional debugging)
        console.log('📤 Data to be submitted:');
        for (let [key, value] of formData.entries()) {
            // Jangan log password atau sensitive data
            if (!key.includes('password') && !key.includes('token')) {
                console.log(`${key}:`, value);
            }
        }
        
        // Optional: Send analytics/log to server
        try {
            fetch('/api/log-form-edit', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    action: 'edit_form_submit',
                    calibration_id: {{ $calibration->id }},
                    form_type: 'inside_micrometer',
                    timestamp: new Date().toISOString(),
                    field_count: formData.entries().length
                })
            }).catch(err => console.log('Analytics log failed:', err));
        } catch (analyticsError) {
            console.log('Analytics error:', analyticsError);
        }
        
        return true;
    });
    
    // Additional debug on page load
    document.addEventListener('DOMContentLoaded', function() {
        console.log('📄 Edit form loaded for Inside Micrometer ID:', {{ $calibration->id }});
        console.log('🏷️ Certificate ID:', '{{ $calibration->headInsideMicrometer->certificate_id ?? "N/A" }}');
        console.log('🔢 Detail records count:', {{ $calibration->detailInsideMicrometers->count() }});
        
        // Log current alat standar
        const currentStandards = '{{ $calibration->headInsideMicrometer->standard ?? "" }}';
        console.log('📋 Current alat standar:', currentStandards);
        
        // Log current form values
        console.log('📝 Current form values:');
        document.querySelectorAll('.kalibrasi-input').forEach((input, index) => {
            if (index < 5) { // Hanya log 5 pertama
                console.log(`${input.name}:`, input.value);
            }
        });
        
        // Auto-hide validation messages after 5 seconds
        setTimeout(() => {
            document.querySelectorAll('.is-invalid').forEach(el => {
                el.classList.remove('is-invalid');
            });
            document.querySelectorAll('.invalid-feedback').forEach(el => {
                el.style.display = 'none';
            });
        }, 5000);
        
        // Real-time validation for numeric fields
        document.querySelectorAll('input[type="number"]').forEach(input => {
            input.addEventListener('blur', function() {
                if (this.value && isNaN(parseFloat(this.value))) {
                    this.classList.add('is-invalid');
                    this.title = 'Harus berupa angka';
                } else {
                    this.classList.remove('is-invalid');
                    this.title = '';
                }
            });
        });
        
        // Real-time validation for date fields
        document.querySelectorAll('input[type="date"]').forEach(input => {
            input.addEventListener('change', function() {
                const tanggalMasuk = document.querySelector('input[name="tanggalMasuk"]').value;
                const tanggalKalibrasi = document.querySelector('input[name="tanggalKalibrasi"]').value;
                
                if (tanggalMasuk && tanggalKalibrasi && new Date(tanggalMasuk) > new Date(tanggalKalibrasi)) {
                    this.classList.add('is-invalid');
                    this.title = 'Tanggal tidak valid';
                } else {
                    this.classList.remove('is-invalid');
                    this.title = '';
                }
            });
        });
        
        // Highlight required-ish fields (bukan required tapi penting)
        const importantFields = [
            'namaAlat', 'brandAlat', 'NoSeri', 'kapasitas', 'resolusi',
            'pemilikAlat', 'tanggalMasuk', 'tanggalKalibrasi'
        ];
        
        importantFields.forEach(fieldName => {
            const field = document.querySelector(`[name="${fieldName}"]`);
            if (field && !field.value.trim()) {
                field.style.backgroundColor = '#fff8e1';
                field.addEventListener('input', function() {
                    if (this.value.trim()) {
                        this.style.backgroundColor = '';
                    }
                });
            }
        });
    });
</script>
</body>
</html>