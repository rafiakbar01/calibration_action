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
           <input type="hidden" name="type" value="single">
        <input type="hidden" name="form_type" value="thermohygrometer">
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
                        <input type="text" class="kalibrasi-input" value="{{ $calibration->namaAlat }}" readonly>
                    </td>
                </tr>

                <!-- Merek & Kode Alat -->
                <tr>
                    <td>
                        <p style="margin: 0; color: #000000;">Merek</p>
                    </td>
                    <td colspan="3">
                        <div class="d-flex align-items-center">
                            <input type="text" class="kalibrasi-input me-3" value="{{ $calibration->brandAlat }}" readonly style="width: 60%;">
                            <span class="me-3" style="color: #000000;">Kode Alat :</span>
                            <input type="text" class="kalibrasi-input" value="{{ $calibration->kodeAlat }}" readonly style="width: 30%;">
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
                            <input type="text" class="kalibrasi-input me-3" value="{{ $calibration->typeAlat }}" readonly style="width: 45%;">
                            <span class="me-3" style="color: #000000;">/</span>
                            <input type="text" class="kalibrasi-input" value="{{ $calibration->NoSeri }}" readonly style="width: 45%;">
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
                            <input type="text" class="kalibrasi-input me-3" value="{{ $calibration->kapasitas }}" readonly style="width: 45%;">
                            <span class="me-3" style="color: #000000;">/</span>
                            <input type="text" class="kalibrasi-input" value="{{ $calibration->resolusi }}" readonly style="width: 45%;">
                        </div>
                    </td>
                </tr>

                <!-- Nama Pemilik -->
                <tr>
                    <td>
                        <p style="margin: 0; color: #000000;">Nama Pemilik</p>
                    </td>
                    <td colspan="3">
                        <input type="text" class="kalibrasi-input" value="{{ $calibration->pemilikAlat }}" readonly>
                    </td>
                </tr>

                <!-- Tanggal -->
                <tr>
                    <td>
                        <p style="margin: 0; color: #000000;">Tanggal Alat Masuk</p>
                    </td>
                    <td colspan="3">
                        <input type="text" class="kalibrasi-input" 
                               value="{{ \Carbon\Carbon::parse($calibration->tanggalMasuk)->format('d/m/Y') }}" readonly>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p style="margin: 0; color: #000000;">Tanggal Kalibrasi</p>
                    </td>
                    <td colspan="3">
                        <div class="d-flex align-items-center">
                            <input type="text" class="kalibrasi-input me-3" 
                               value="{{ \Carbon\Carbon::parse($calibration->tanggalKalibrasi)->format('d/m/Y') }}"
                                readonly style="width: 45%;">
                            <span class="me-3" style="color: #000000;">Jenis Pembacaan:</span>
                            <input type="text" class="kalibrasi-input" 
                                value="{{ $calibration->jenisPembacaan }}" 
                                readonly style="width: 45%;">
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
                                <input class="form-check-input" type="radio" name="tempat_kalibrasi" value="lab" id="lab" 
                                       {{ $calibration->tempatKalibrasi == 'lab' ? 'checked' : '' }} disabled>
                                <label class="form-check-label" for="lab" style="color: #000000;">Lab. PT.PAS</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tempat_kalibrasi" value="insitu" id="insitu" 
                                       {{ $calibration->tempatKalibrasi == 'insitu' ? 'checked' : '' }} disabled>
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
                        <input type="text" class="kalibrasi-input" value="{{ $calibration->lokasiPT }}" readonly>
                    </td>
                </tr>
            </table>

            <!-- Fungsi Komponen Lainnya & Kondisi Kalibrasi -->
            <div class="row mt-4">
    <!-- Fungsi Komponen Lainnya -->
    <div class="col-md-6 mb-4">
        <div class="kalibrasi-section-header" style="color: #000000;">Fungsi Komponen Lainnya</div>
        
        <!-- Radio Button Section - Text di atas, radio di bawah -->
        <div class="d-flex justify-content-center align-items-center mb-4" style="gap: 60px;">
            <div class="text-center">
                <span class="fw-bold d-block mb-2" style="color: #000000; font-size: 14px;">Ok</span>
                <input type="radio" name="kondisiAlat" value="ok" class="form-check-input" 
                    style="width: 18px; height: 18px; display: block; margin: 0 auto;"
                    {{ $calibration->kondisiAlat == 'ok' ? 'checked' : '' }} disabled>
            </div>
            <div class="text-center">
                <span class="fw-bold d-block mb-2" style="color: #000000; font-size: 14px;">Rusak</span>
                <input type="radio" name="kondisiAlat" value="rusak" class="form-check-input"
                    style="width: 18px; height: 18px; display: block; margin: 0 auto;"
                    {{ $calibration->kondisiAlat == 'rusak' ? 'checked' : '' }} disabled>
            </div>
        </div>
        
        <!-- Keterangan Section -->
        <div class="d-flex align-items-center">
            <span class="fw-bold me-3" style="color: #000000; min-width: 100px;">Keterangan :</span>
            <div style="flex: 1;">
                <input type="text" class="kalibrasi-input" value="{{ $calibration->keterangan ?? '-' }}" readonly 
                       style="border: none; border-bottom: 2px solid #000; border-radius: 0; padding: 4px 0; background: transparent; width: 100%;">
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
                <td><input type="text" class="kondisi-input" value="{{ $calibration->RT_condition1 ?? '-' }}" readonly></td>
                <td><input type="text" class="kondisi-input" value="{{ $calibration->RT_condition2 ?? '-' }}" readonly></td>
                <td><input type="text" class="kondisi-input" value="{{ $calibration->RT_condition3 ?? '-' }}" readonly></td>
            </tr>
            <tr>
                <td class="bg-light fw-bold" style="color: #000000;">RH (%)</td>
                <td><input type="text" class="kondisi-input" value="{{ $calibration->RH_condition1 ?? '-' }}" readonly></td>
                <td><input type="text" class="kondisi-input" value="{{ $calibration->RH_condition2 ?? '-' }}" readonly></td>
                <td><input type="text" class="kondisi-input" value="{{ $calibration->RH_condition3 ?? '-' }}" readonly></td>
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
        // Template untuk type in_out
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
                <!-- Kolom Set Point sudah di-merge ke atas, jadi tidak perlu lagi -->
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
            
            <!-- Baris Data Temperatur dengan Loop dan array -->
            <?php 
            $tempDetails = $calibration->detailThermohygrometers ?? [];
            for($i = 0; $i < 7; $i++): 
                $detail = $tempDetails[$i] ?? null;
            ?>
            <tr>
                <td></td>
                <!-- Set Point (kolom ini sekarang rowspan="2") -->
                <td style="border: 1px solid #000; padding: 0;">
                    <input type="number" name="temp[<?php echo $i; ?>][set_point]" step="0.1" 
                           value="<?php echo $detail ? $detail->titikUkur_T : ''; ?>"
                           style="width: 100%; height: 35px; border: none; text-align: center; padding: 0 5px; font-size: 12px;"
                           readonly>
                </td>
                
                <!-- Pembacaan Standar x1, x2, x3 -->
                <td style="border: 1px solid #000; padding: 0;">
                    <input type="number" name="temp[<?php echo $i; ?>][std_x1]" step="0.01" 
                           value="<?php echo $detail ? $detail->T_STD1 : ''; ?>"
                           style="width: 100%; height: 35px; border: none; text-align: center; padding: 0 5px; font-size: 12px;"
                           readonly>
                </td>
                <td style="border: 1px solid #000; padding: 0;">
                    <input type="number" name="temp[<?php echo $i; ?>][std_x2]" step="0.01" 
                           value="<?php echo $detail ? $detail->T_STD2 : ''; ?>"
                           style="width: 100%; height: 35px; border: none; text-align: center; padding: 0 5px; font-size: 12px;"
                           readonly>
                </td>
                <td style="border: 1px solid #000; padding: 0;">
                    <input type="number" name="temp[<?php echo $i; ?>][std_x3]" step="0.01" 
                           value="<?php echo $detail ? $detail->T_STD3 : ''; ?>"
                           style="width: 100%; height: 35px; border: none; text-align: center; padding: 0 5px; font-size: 12px;"
                           readonly>
                </td>
                
                <!-- Spacer -->
                <td></td>
                
                <!-- Pembacaan Alat IN x1, x2, x3 -->
                <td style="border: 1px solid #000; padding: 0;">
                    <input type="number" name="temp[<?php echo $i; ?>][in_x1]" step="0.01" 
                           value="<?php echo $detail ? $detail->T_IN1 : ''; ?>"
                           style="width: 100%; height: 35px; border: none; text-align: center; padding: 0 5px; font-size: 12px;"
                           readonly>
                </td>
                <td style="border: 1px solid #000; padding: 0;">
                    <input type="number" name="temp[<?php echo $i; ?>][in_x2]" step="0.01" 
                           value="<?php echo $detail ? $detail->T_IN2 : ''; ?>"
                           style="width: 100%; height: 35px; border: none; text-align: center; padding: 0 5px; font-size: 12px;"
                           readonly>
                </td>
                <td style="border: 1px solid #000; padding: 0;">
                    <input type="number" name="temp[<?php echo $i; ?>][in_x3]" step="0.01" 
                           value="<?php echo $detail ? $detail->T_IN3 : ''; ?>"
                           style="width: 100%; height: 35px; border: none; text-align: center; padding: 0 5px; font-size: 12px;"
                           readonly>
                </td>
                
                <!-- Pembacaan Alat OUT x1, x2, x3 -->
                <td style="border: 1px solid #000; padding: 0;">
                    <input type="number" name="temp[<?php echo $i; ?>][out_x1]" step="0.01" 
                           value="<?php echo $detail ? $detail->T_OUT1 ?? '' : ''; ?>"
                           style="width: 100%; height: 35px; border: none; text-align: center; padding: 0 5px; font-size: 12px;"
                           readonly>
                </td>
                <td style="border: 1px solid #000; padding: 0;">
                    <input type="number" name="temp[<?php echo $i; ?>][out_x2]" step="0.01" 
                           value="<?php echo $detail ? $detail->T_OUT2 ?? '' : ''; ?>"
                           style="width: 100%; height: 35px; border: none; text-align: center; padding: 0 5px; font-size: 12px;"
                           readonly>
                </td>
                <td style="border: 1px solid #000; padding: 0;">
                    <input type="number" name="temp[<?php echo $i; ?>][out_x3]" step="0.01" 
                           value="<?php echo $detail ? $detail->T_OUT3 ?? '' : ''; ?>"
                           style="width: 100%; height: 35px; border: none; text-align: center; padding: 0 5px; font-size: 12px;"
                           readonly>
                </td>
                
                <td colspan="2"></td>
            </tr>
            <?php endfor; ?>
            
            <!-- Spacer -->
            <tr style="height: 20px;">
                <td colspan="14"></td>
            </tr>
            
            <!-- Bagian Kelembaban -->
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
                <!-- Kolom Set Point sudah di-merge ke atas, jadi tidak perlu lagi -->
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
            
            <!-- Baris Data Kelembaban dengan Loop dan array -->
            <?php 
            $humidityDetails = $calibration->detailThermohygrometers ?? [];
            for($i = 0; $i < 7; $i++): 
                $detail = $humidityDetails[$i] ?? null;
            ?>
            <tr>
                <td></td>
                <!-- Set Point Kelembaban (kolom ini sekarang rowspan="2") -->
                <td style="border: 1px solid #000; padding: 0;">
                    <input type="number" name="humidity[<?php echo $i; ?>][set_point]" step="0.1" 
                           value="<?php echo $detail ? $detail->titikUkur_RH : ''; ?>"
                           style="width: 100%; height: 35px; border: none; text-align: center; padding: 0 5px; font-size: 12px;"
                           readonly>
                </td>
                
                <!-- Pembacaan Standar Kelembaban x1, x2, x3 -->
                <td style="border: 1px solid #000; padding: 0;">
                    <input type="number" name="humidity[<?php echo $i; ?>][std_x1]" step="0.01" 
                           value="<?php echo $detail ? $detail->RH_STD1 : ''; ?>"
                           style="width: 100%; height: 35px; border: none; text-align: center; padding: 0 5px; font-size: 12px;"
                           readonly>
                </td>
                <td style="border: 1px solid #000; padding: 0;">
                    <input type="number" name="humidity[<?php echo $i; ?>][std_x2]" step="0.01" 
                           value="<?php echo $detail ? $detail->RH_STD2 : ''; ?>"
                           style="width: 100%; height: 35px; border: none; text-align: center; padding: 0 5px; font-size: 12px;"
                           readonly>
                </td>
                <td style="border: 1px solid #000; padding: 0;">
                    <input type="number" name="humidity[<?php echo $i; ?>][std_x3]" step="0.01" 
                           value="<?php echo $detail ? $detail->RH_STD3 : ''; ?>"
                           style="width: 100%; height: 35px; border: none; text-align: center; padding: 0 5px; font-size: 12px;"
                           readonly>
                </td>
                
                <!-- Spacer -->
                <td></td>
                
                <!-- Pembacaan Alat Kelembaban x1, x2, x3 -->
                <td style="border: 1px solid #000; padding: 0;">
                    <input type="number" name="humidity[<?php echo $i; ?>][alat_x1]" step="0.01" 
                           value="<?php echo $detail ? $detail->RH_ALAT1 : ''; ?>"
                           style="width: 100%; height: 35px; border: none; text-align: center; padding: 0 5px; font-size: 12px;"
                           readonly>
                </td>
                <td style="border: 1px solid #000; padding: 0;">
                    <input type="number" name="humidity[<?php echo $i; ?>][alat_x2]" step="0.01" 
                           value="<?php echo $detail ? $detail->RH_ALAT2 : ''; ?>"
                           style="width: 100%; height: 35px; border: none; text-align: center; padding: 0 5px; font-size: 12px;"
                           readonly>
                </td>
                <td style="border: 1px solid #000; padding: 0;">
                    <input type="number" name="humidity[<?php echo $i; ?>][alat_x3]" step="0.01" 
                           value="<?php echo $detail ? $detail->RH_ALAT3 : ''; ?>"
                           style="width: 100%; height: 35px; border: none; text-align: center; padding: 0 5px; font-size: 12px;"
                           readonly>
                </td>
                
                <td colspan="5"></td>
            </tr>
            <?php endfor; ?>
        </table>
        <?php
        break;
        

case 'single':
default:
    // Template untuk type single
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
            if(isset($calibration) && $calibration->detailThermohygrometers && $calibration->detailThermohygrometers->count() > 0): 
                $iteration = 1;
                foreach($calibration->detailThermohygrometers as $detail): 
            ?>
            <tr>
                <td class="p-0 border-dark">
                    <input type="number" name="t_set<?php echo $iteration; ?>"
                        value="<?php echo $detail->titikUkur_T ?? ''; ?>"
                        class="form-control text-center border-0 fs-5 py-3" readonly>
                </td>

                <td class="p-0 border-dark">
                    <input type="number" name="t_std<?php echo $iteration; ?>_1"
                        value="<?php echo $detail->T_STD1 ?? ''; ?>"
                        class="form-control text-center border-0 fs-5 py-3" readonly>
                </td>
                <td class="p-0 border-dark">
                    <input type="number" name="t_std<?php echo $iteration; ?>_2"
                        value="<?php echo $detail->T_STD2 ?? ''; ?>"
                        class="form-control text-center border-0 fs-5 py-3" readonly>
                </td>
                <td class="p-0 border-dark">
                    <input type="number" name="t_std<?php echo $iteration; ?>_3"
                        value="<?php echo $detail->T_STD3 ?? ''; ?>"
                        class="form-control text-center border-0 fs-5 py-3" readonly>
                </td>

                <td class="p-0 border-dark">
                    <input type="number" name="t_inst<?php echo $iteration; ?>_1"
                        value="<?php echo $detail->T_IN1 ?? ''; ?>"
                        class="form-control text-center border-0 fs-5 py-3" readonly>
                </td>
                <td class="p-0 border-dark">
                    <input type="number" name="t_inst<?php echo $iteration; ?>_2"
                        value="<?php echo $detail->T_IN2 ?? ''; ?>"
                        class="form-control text-center border-0 fs-5 py-3" readonly>
                </td>
                <td class="p-0 border-dark">
                    <input type="number" name="t_inst<?php echo $iteration; ?>_3"
                        value="<?php echo $detail->T_IN3 ?? ''; ?>"
                        class="form-control text-center border-0 fs-5 py-3" readonly>
                </td>
            </tr>
            <?php 
                $iteration++;
                endforeach; 
            else: 
            ?>
                <!-- Jika tidak ada data, tampilkan input kosong -->
                <?php for ($i = 1; $i <= 10; $i++): ?>
                <tr>
                    <td class="p-0 border-dark">
                        <input type="number" name="t_set<?php echo $i; ?>"
                            class="form-control text-center border-0 fs-5 py-3" readonly>
                    </td>

                    <?php for ($j = 1; $j <= 3; $j++): ?>
                    <td class="p-0 border-dark">
                        <input type="number" name="t_std<?php echo $i; ?>_<?php echo $j; ?>"
                            class="form-control text-center border-0 fs-5 py-3" readonly>
                    </td>
                    <?php endfor; ?>

                    <?php for ($j = 1; $j <= 3; $j++): ?>
                    <td class="p-0 border-dark">
                        <input type="number" name="t_inst<?php echo $i; ?>_<?php echo $j; ?>"
                            class="form-control text-center border-0 fs-5 py-3" readonly>
                    </td>
                    <?php endfor; ?>
                </tr>
                <?php endfor; ?>
            <?php endif; ?>
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
            if(isset($calibration) && $calibration->detailThermohygrometers && $calibration->detailThermohygrometers->count() > 0): 
                $iteration = 1;
                foreach($calibration->detailThermohygrometers as $detail): 
            ?>
            <tr>
                <td class="p-0 border-dark">
                    <input type="number" name="h_set<?php echo $iteration; ?>"
                        value="<?php echo $detail->titikUkur_RH ?? ''; ?>"
                        class="form-control text-center border-0 fs-5 py-3" readonly>
                </td>

                <td class="p-0 border-dark">
                    <input type="number" name="h_std<?php echo $iteration; ?>_1"
                        value="<?php echo $detail->RH_STD1 ?? ''; ?>"
                        class="form-control text-center border-0 fs-5 py-3" readonly>
                </td>
                <td class="p-0 border-dark">
                    <input type="number" name="h_std<?php echo $iteration; ?>_2"
                        value="<?php echo $detail->RH_STD2 ?? ''; ?>"
                        class="form-control text-center border-0 fs-5 py-3" readonly>
                </td>
                <td class="p-0 border-dark">
                    <input type="number" name="h_std<?php echo $iteration; ?>_3"
                        value="<?php echo $detail->RH_STD3 ?? ''; ?>"
                        class="form-control text-center border-0 fs-5 py-3" readonly>
                </td>

                <td class="p-0 border-dark">
                    <input type="number" name="h_inst<?php echo $iteration; ?>_1"
                        value="<?php echo $detail->RH_ALAT1 ?? ''; ?>"
                        class="form-control text-center border-0 fs-5 py-3" readonly>
                </td>
                <td class="p-0 border-dark">
                    <input type="number" name="h_inst<?php echo $iteration; ?>_2"
                        value="<?php echo $detail->RH_ALAT2 ?? ''; ?>"
                        class="form-control text-center border-0 fs-5 py-3" readonly>
                </td>
                <td class="p-0 border-dark">
                    <input type="number" name="h_inst<?php echo $iteration; ?>_3"
                        value="<?php echo $detail->RH_ALAT3 ?? ''; ?>"
                        class="form-control text-center border-0 fs-5 py-3" readonly>
                </td>
            </tr>
            <?php 
                $iteration++;
                endforeach; 
            else: 
            ?>
                <!-- Jika tidak ada data, tampilkan input kosong -->
                <?php for ($i = 1; $i <= 10; $i++): ?>
                <tr>
                    <td class="p-0 border-dark">
                        <input type="number" name="h_set<?php echo $i; ?>"
                            class="form-control text-center border-0 fs-5 py-3" readonly>
                    </td>

                    <?php for ($j = 1; $j <= 3; $j++): ?>
                    <td class="p-0 border-dark">
                        <input type="number" name="h_std<?php echo $i; ?>_<?php echo $j; ?>"
                            class="form-control text-center border-0 fs-5 py-3" readonly>
                    </td>
                    <?php endfor; ?>

                    <?php for ($j = 1; $j <= 3; $j++): ?>
                    <td class="p-0 border-dark">
                        <input type="number" name="h_inst<?php echo $i; ?>_<?php echo $j; ?>"
                            class="form-control text-center border-0 fs-5 py-3" readonly>
                    </td>
                    <?php endfor; ?>
                </tr>
                <?php endfor; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <?php
    break;
}
?>

            <!-- Footer Section -->
           <!-- Data Complete Section -->
                    <div class="data-complete-section">
                        <span class="data-complete-text">Data telah diisi dengan lengkap dan jelas!</span>
                    </div>

                <?php
// Ambil type dari database (asumsi dari model $calibration)
$type = $calibration->type ?? 'single';

// Gunakan switch case untuk menentukan template yang akan ditampilkan
switch ($type) {
    case 'in_out':
        // Template untuk type in_out
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
                    <?php 
                    $standardText = '';
                    if(isset($calibration->headThermohygrometer)) {
                        $standardText = $calibration->headThermohygrometer->standard ?? 'Temperature & Humidity Transmitter, Rotronic, 71946262; 20345594';
                    }
                    echo htmlspecialchars($standardText);
                    ?>
                    <input type="hidden" name="alat_standar_text" value="<?php echo htmlspecialchars($standardText); ?>">
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
                    $method = $calibration->headThermohygrometer->metode ?? 'PAS-IK1102-50';
                    echo htmlspecialchars($method);
                    ?>
                </td>
                
                <!-- TTD Dikalibrasi (sejajar dengan metode) -->
                <td style="border-right: 1px solid #000;  padding: 8px; font-size: 9pt; vertical-align: middle; color: #000000; text-align: center;">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <span style="font-weight: bold;">TTD :</span>
                        <?php if(isset($calibration->headThermohygrometer) && !empty($calibration->headThermohygrometer->ttd_calibrated_by)): ?>
                            <img src="<?php echo asset('storage/' . $calibration->headThermohygrometer->ttd_calibrated_by); ?>" 
                                 alt="TTD" 
                                 style="max-width: 100px; max-height: 50px; margin-left: 10px;">
                        <?php else: ?>
                            <span style="margin-left: 10px; color: #999;">-</span>
                        <?php endif; ?>
                    </div>
                </td>
                
                <!-- TTD Diperiksa (sejajar dengan metode) -->
                <td style="border-right: 1px solid #000;  padding: 8px; font-size: 9pt; vertical-align: middle; color: #000000; text-align: center;">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <span style="font-weight: bold;">TTD :</span>
                        <?php if(isset($calibration->headThermohygrometer) && !empty($calibration->headThermohygrometer->ttd_verified_by)): ?>
                            <img src="<?php echo asset('storage/' . $calibration->headThermohygrometer->ttd_verified_by); ?>" 
                                 alt="TTD" 
                                 style="max-width: 100px; max-height: 50px; margin-left: 10px;">
                        <?php else: ?>
                            <span style="margin-left: 10px; color: #999;">-</span>
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
                    <?php 
                    $traceable = $calibration->headThermohygrometer->traceable ?? 'Certus Metrology';
                    echo htmlspecialchars($traceable);
                    ?>
                </td>
                
                <!-- Nama Dikalibrasi (sejajar dengan tertelusur) -->
                <td style="border-right: 1px solid #000; border-bottom: 1px solid #000; padding: 8px; font-size: 9pt; vertical-align: middle; color: #000000; text-align: center;">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <span style="font-weight: bold;">Nama :</span>
                        <input type="text" 
                            name="calibrated_by" 
                            class="kalibrasi-input" 
                            value="<?php echo htmlspecialchars($calibration->calibratedBy ?? ''); ?>"
                            placeholder="" 
                            style="width: 70%; border: none; outline: none; padding: 5px; font-size: 9pt; background: transparent; text-align: center; border-bottom: 1px solid #999; margin-left: 5px;"
                            readonly>
                    </div>
                </td>
                
                <!-- Nama Diperiksa (sejajar dengan tertelusur) -->
                <td style="border-right: 1px solid #000; border-bottom: 1px solid #000; padding: 8px; font-size: 9pt; vertical-align: middle; color: #000000; text-align: center;">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <span style="font-weight: bold;">Nama :</span>
                        <input type="text" 
                            name="verified_by" 
                            class="kalibrasi-input" 
                            value="<?php echo htmlspecialchars($calibration->verifiedBy ?? ''); ?>"
                            placeholder="" 
                            style="width: 70%; border: none; outline: none; padding: 5px; font-size: 9pt; background: transparent; text-align: center; border-bottom: 1px solid #999; margin-left: 5px;"
                            readonly>
                    </div>
                </td>
            </tr>
        </table>
        <?php
        break;
        
    case 'single':
    default:
        // Template untuk type single
        ?>
        <table class="kalibrasi-main-table" style="width: 100%; border-collapse: collapse;">
            <!-- ALAT STANDAR + CHECKBOX (MODIFIED FOR 2 TOOLS) -->
            <tr style="height: 40px;">
                <td rowspan="2" style="width: 20%; border: 1px solid #000; vertical-align: middle; text-align: center; font-weight: bold; font-size: 10pt; color: #000000; background-color: #f8f9fa;">
                    Alat<br>Standar
                </td>

                <!-- Alat 1 -->
                <td style="width: 5%; border: 1px solid #000; text-align: center; vertical-align: middle;">
                    <input type="checkbox" 
                           name="alat_standar[]" 
                           value="Temperature & Humidity Transmitter, Rotronic,T017" 
                           id="alat1" 
                           class="form-check-input"
                           style="width: 18px; height: 18px; cursor: pointer;"
                           <?php 
                           $standard = isset($calibration->headThermohygrometer) ? $calibration->headThermohygrometer->standard : '';
                           echo ($standard == 'Temperature & Humidity Transmitter, Rotronic,T017') ? 'checked' : ''; 
                           ?>
                           disabled>
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
                    <input type="checkbox" 
                           name="alat_standar[]" 
                           value="Temperature & Humidity, LUTRON, T006" 
                           id="alat2" 
                           class="form-check-input"
                           style="width: 18px; height: 18px; cursor: pointer;"
                           <?php 
                           $standard = isset($calibration->headThermohygrometer) ? $calibration->headThermohygrometer->standard : '';
                           echo ($standard == 'Temperature & Humidity, LUTRON, T006') ? 'checked' : ''; 
                           ?>
                           disabled>
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
                    <?php 
                    $method = isset($calibration->headThermohygrometer) ? $calibration->headThermohygrometer->metode : 'PAS-IK1102-50';
                    echo htmlspecialchars($method);
                    ?>
                </td>
                
                <!-- Input Nama Dikalibrasi Oleh -->
                <td style="width: 20%; border: 1px solid #000; padding: 5px; font-size: 9pt; vertical-align: middle; color: #000000;">
                    <input type="text" 
                        name="calibratedBy" 
                        class="kalibrasi-input" 
                        value="<?php echo htmlspecialchars($calibration->calibratedBy ?? ''); ?>"
                        placeholder="Nama Lengkap" 
                        style="width: 100%; border: none; outline: none; padding: 5px; font-size: 9pt; background: transparent;"
                        readonly>
                </td>
                
                <!-- Input Nama Diperiksa Oleh -->
                <td style="width: 20%; border: 1px solid #000; padding: 5px; font-size: 9pt; vertical-align: middle; color: #000000;">
                    <input type="text" 
                        name="calibratedBy" 
                        class="kalibrasi-input" 
                        value="<?php echo htmlspecialchars($calibration->verifiedBy ?? ''); ?>"
                        placeholder="Nama Lengkap" 
                        style="width: 100%; border: none; outline: none; padding: 5px; font-size: 9pt; background: transparent;"
                        readonly>
                </td>
            </tr>

            <!-- BARIS TTD (Bagian Bawah dari Metode Kalibrasi) -->
            <tr style="height: 40px;">
                <!-- Kolom untuk TTD Dikalibrasi Oleh -->
                <td style="width: 20%; border: 1px solid #000; padding: 10px; font-size: 9pt; vertical-align: middle; color: #000000; text-align: left;">
                    <strong>TTD :</strong>
                    <?php if(isset($calibration->headThermohygrometer) && !empty($calibration->headThermohygrometer->ttd_calibrated_by)): ?>
                        <img src="<?php echo asset('storage/' . $calibration->headThermohygrometer->ttd_calibrated_by); ?>" 
                             alt="TTD" 
                             style="max-width: 100px; max-height: 50px; margin-left: 10px;">
                    <?php else: ?>
                        <span style="margin-left: 10px; color: #999;">-</span>
                    <?php endif; ?>
                </td>
                
                <!-- Kolom untuk TTD Diperiksa Oleh -->
                <td style="width: 20%; border: 1px solid #000; padding: 10px; font-size: 9pt; vertical-align: middle; color: #000000; text-align: left;">
                    <strong>TTD :</strong>
                    <?php if(isset($calibration->headThermohygrometer) && !empty($calibration->headThermohygrometer->ttd_verified_by)): ?>
                        <img src="<?php echo asset('storage/' . $calibration->headThermohygrometer->ttd_verified_by); ?>" 
                             alt="TTD" 
                             style="max-width: 100px; max-height: 50px; margin-left: 10px;">
                    <?php else: ?>
                        <span style="margin-left: 10px; color: #999;">-</span>
                    <?php endif; ?>
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
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                    
                    <button onclick="window.print()" class="btn btn-primary btn-lg ms-3" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
                        <i class="fas fa-print me-2"></i>Cetak
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>