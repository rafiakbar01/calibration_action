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
                        <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK15</p>
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
                        <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">TIMBANGAN</p>
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
                        <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;">{{ $calibration->headTimbangan->certificate_id ?? 'N/A' }}</p>
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

                <tr>
    <td>
        <p style="margin: 0; color: #000000;">Rentang Ukur</p>
    </td>
    <td colspan="3">
        <div class="d-flex align-items-center">
            <!-- Tampilkan nilai Min -->
            <div class="me-3" style="width: 45%;">
                <input type="text" 
                       class="kalibrasi-input" 
                       value="{{ isset($calibration->rangeMin) ? $calibration->rangeMin : '0' }}" 
                       readonly 
                       style="width: 100%;">
            </div>
            
            <span class="me-3" style="color: #000000;">-</span>
            
            <!-- Tampilkan nilai Max -->
            <div style="width: 45%;">
                <input type="text" 
                       class="kalibrasi-input" 
                       value="{{ isset($calibration->rangeMax) ? $calibration->rangeMax : '0' }}" 
                       readonly 
                       style="width: 100%;">
            </div>
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
                                       {{ $calibration->tempatKalibrasi == 'lab.PT PAS' ? 'checked' : '' }} disabled>
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
            
          <table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr valign="top">
        <!-- Blok Kiri: Setengah Kap. Max -->
        <td width="33%" valign="top" style="padding-right: 20px;">
        <b>Pemeriksaan Nilai Repeatability</b><br><br>
        Setengah Kap. Max = ....................<br><br>

        <table style="border-collapse: collapse; width: 100%;">
            <tr style="background: #cccccc;">
            <td style="border:2px solid #000; padding:8px; text-align:center; width:50%;">
                <b>Penunjukan z1</b>
            </td>
            <td style="border:2px solid #000; padding:8px; text-align:center; width:50%;">
                <b>Penunjukan m1</b>
            </td>
            </tr>
            <tr>
            <td style="border:2px solid #000; padding:0;">
                <input type="text" name="setengah_z1_1" 
                       value="{{ $calibration->addTimbangan->HalfMax_z1_01 ?? '' }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            <td style="border:2px solid #000; padding:0;">
                <input type="text" name="setengah_m1_1" 
                       value="{{ $calibration->addTimbangan->HalfMax_m1_01 ?? '' }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            </tr>
            <tr>
            <td style="border:2px solid #000; padding:0;">
                <input type="text" name="setengah_z1_2" 
                       value="{{ $calibration->addTimbangan->HalfMax_z1_02 ?? '' }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            <td style="border:2px solid #000; padding:0;">
                <input type="text" name="setengah_m1_2" 
                       value="{{ $calibration->addTimbangan->HalfMax_m1_02 ?? '' }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            </tr>
            <tr>
            <td style="border:2px solid #000; padding:0;">
                <input type="text" name="setengah_z1_3" 
                       value="{{ $calibration->addTimbangan->HalfMax_z1_03 ?? '' }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            <td style="border:2px solid #000; padding:0;">
                <input type="text" name="setengah_m1_3" 
                       value="{{ $calibration->addTimbangan->HalfMax_m1_03 ?? '' }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            </tr>
            <tr>
            <td style="border:2px solid #000; padding:0;">
                <input type="text" name="setengah_z1_4" 
                       value="{{ $calibration->addTimbangan->HalfMax_z1_04 ?? '' }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            <td style="border:2px solid #000; padding:0;">
                <input type="text" name="setengah_m1_4" 
                       value="{{ $calibration->addTimbangan->HalfMax_m1_04 ?? '' }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            </tr>
            <tr>
            <td style="border:2px solid #000; padding:0;">
                <input type="text" name="setengah_z1_5" 
                       value="{{ $calibration->addTimbangan->HalfMax_z1_05 ?? '' }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            <td style="border:2px solid #000; padding:0;">
                <input type="text" name="setengah_m1_5" 
                       value="{{ $calibration->addTimbangan->HalfMax_m1_05 ?? '' }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            </tr>
            <tr>
            <td style="border:2px solid #000; padding:0;">
                <input type="text" name="setengah_z1_6" 
                       value="{{ $calibration->addTimbangan->HalfMax_z1_06 ?? '' }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            <td style="border:2px solid #000; padding:0;">
                <input type="text" name="setengah_m1_6" 
                       value="{{ $calibration->addTimbangan->HalfMax_m1_06 ?? '' }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            </tr>
            <tr>
            <td style="border:2px solid #000; padding:0;">
                <input type="text" name="setengah_z1_7" 
                       value="{{ $calibration->addTimbangan->HalfMax_z1_07 ?? '' }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            <td style="border:2px solid #000; padding:0;">
                <input type="text" name="setengah_m1_7" 
                       value="{{ $calibration->addTimbangan->HalfMax_m1_07 ?? '' }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            </tr>
            <tr>
            <td style="border:2px solid #000; padding:0;">
                <input type="text" name="setengah_z1_8" 
                       value="{{ $calibration->addTimbangan->HalfMax_z1_08 ?? '' }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            <td style="border:2px solid #000; padding:0;">
                <input type="text" name="setengah_m1_8" 
                       value="{{ $calibration->addTimbangan->HalfMax_m1_08 ?? '' }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            </tr>
            <tr>
            <td style="border:2px solid #000; padding:0;">
                <input type="text" name="setengah_z1_9" 
                       value="{{ $calibration->addTimbangan->HalfMax_z1_09 ?? '' }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            <td style="border:2px solid #000; padding:0;">
                <input type="text" name="setengah_m1_9" 
                       value="{{ $calibration->addTimbangan->HalfMax_m1_09 ?? '' }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            </tr>
            <tr>
            <td style="border:2px solid #000; padding:0;">
                <input type="text" name="setengah_z1_10" 
                       value="{{ $calibration->addTimbangan->HalfMax_z1_10 ?? '' }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            <td style="border:2px solid #000; padding:0;">
                <input type="text" name="setengah_m1_10" 
                       value="{{ $calibration->addTimbangan->HalfMax_m1_10 ?? '' }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            </tr>
        </table>
        </td>

        <!-- Blok Tengah: Kapasitas Max -->
        <td width="33%" valign="top" style="padding-right: 20px;">
        <b>Pemeriksaan Nilai Repeatability</b><br><br>
        Kapasitas Max = ....................<br><br>

        <table style="border-collapse: collapse; width: 100%;">
            <tr style="background: #cccccc;">
            <td style="border:2px solid #000; padding:8px; text-align:center; width:50%;">
                <b>Penunjukan z1</b>
            </td>
            <td style="border:2px solid #000; padding:8px; text-align:center; width:50%;">
                <b>Penunjukan m1</b>
            </td>
            </tr>
            <tr>
            <td style="border:2px solid #000; padding:0;">
                <input type="text" name="kapasitas_z1_1" 
                       value="{{ $calibration->addTimbangan->FullMax_z1_01 ?? '' }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            <td style="border:2px solid #000; padding:0;">
                <input type="text" name="kapasitas_m1_1" 
                       value="{{ $calibration->addTimbangan->FullMax_m1_01 ?? '' }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            </tr>
            <tr>
            <td style="border:2px solid #000; padding:0;">
                <input type="text" name="kapasitas_z1_2" 
                       value="{{ $calibration->addTimbangan->FullMax_z1_02 ?? '' }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            <td style="border:2px solid #000; padding:0;">
                <input type="text" name="kapasitas_m1_2" 
                       value="{{ $calibration->addTimbangan->FullMax_m1_02 ?? '' }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            </tr>
            <tr>
            <td style="border:2px solid #000; padding:0;">
                <input type="text" name="kapasitas_z1_3" 
                       value="{{ $calibration->addTimbangan->FullMax_z1_03 ?? '' }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            <td style="border:2px solid #000; padding:0;">
                <input type="text" name="kapasitas_m1_3" 
                       value="{{ $calibration->addTimbangan->FullMax_m1_03 ?? '' }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            </tr>
            <tr>
            <td style="border:2px solid #000; padding:0;">
                <input type="text" name="kapasitas_z1_4" 
                       value="{{ $calibration->addTimbangan->FullMax_z1_04 ?? '' }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            <td style="border:2px solid #000; padding:0;">
                <input type="text" name="kapasitas_m1_4" 
                       value="{{ $calibration->addTimbangan->FullMax_m1_04 ?? '' }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            </tr>
            <tr>
            <td style="border:2px solid #000; padding:0;">
                <input type="text" name="kapasitas_z1_5" 
                       value="{{ $calibration->addTimbangan->FullMax_z1_05 ?? '' }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            <td style="border:2px solid #000; padding:0;">
                <input type="text" name="kapasitas_m1_5" 
                       value="{{ $calibration->addTimbangan->FullMax_m1_05 ?? '' }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            </tr>
            <tr>
            <td style="border:2px solid #000; padding:0;">
                <input type="text" name="kapasitas_z1_6" 
                       value="{{ $calibration->addTimbangan->FullMax_z1_06 ?? '' }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            <td style="border:2px solid #000; padding:0;">
                <input type="text" name="kapasitas_m1_6" 
                       value="{{ $calibration->addTimbangan->FullMax_m1_06 ?? '' }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            </tr>
            <tr>
            <td style="border:2px solid #000; padding:0;">
                <input type="text" name="kapasitas_z1_7" 
                       value="{{ $calibration->addTimbangan->FullMax_z1_07 ?? '' }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            <td style="border:2px solid #000; padding:0;">
                <input type="text" name="kapasitas_m1_7" 
                       value="{{ $calibration->addTimbangan->FullMax_m1_07 ?? '' }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            </tr>
            <tr>
            <td style="border:2px solid #000; padding:0;">
                <input type="text" name="kapasitas_z1_8" 
                       value="{{ $calibration->addTimbangan->FullMax_z1_08 ?? '' }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            <td style="border:2px solid #000; padding:0;">
                <input type="text" name="kapasitas_m1_8" 
                       value="{{ $calibration->addTimbangan->FullMax_m1_08 ?? '' }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            </tr>
            <tr>
            <td style="border:2px solid #000; padding:0;">
                <input type="text" name="kapasitas_z1_9" 
                       value="{{ $calibration->addTimbangan->FullMax_z1_09 ?? '' }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            <td style="border:2px solid #000; padding:0;">
                <input type="text" name="kapasitas_m1_9" 
                       value="{{ $calibration->addTimbangan->FullMax_m1_09 ?? '' }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            </tr>
            <tr>
            <td style="border:2px solid #000; padding:0;">
                <input type="text" name="kapasitas_z1_10" 
                       value="{{ $calibration->addTimbangan->FullMax_z1_10 ?? '' }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            <td style="border:2px solid #000; padding:0;">
                <input type="text" name="kapasitas_m1_10" 
                       value="{{ $calibration->addTimbangan->FullMax_m1_10 ?? '' }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            </tr>
        </table>
        </td>

        <!-- Blok Kanan: CATATAN PENTING -->
        <td width="34%" valign="top">
        <table style="border-collapse: collapse; width: 100%;">
            <tr>
            <td style="border:2px solid #000; background: #ffffff; text-align:center; padding:15px;">
                <b style="font-size: 18px;">CATATAN PENTING</b>
            </td>
            </tr>
            <tr>
            <td style="border:2px solid #000; background: #ffffff; padding:0; height: 500px;">
                <textarea name="catatan_penting" style="width:100%; height:100%; border:none; background:transparent; padding:15px; resize:none; box-sizing:border-box;">{{ $calibration->headTimbangan->note ?? '' }}</textarea>
            </td>
            </tr>
        </table>
        </td>
    </tr>
</table>

  <!-- Jarak dan Footer Section -->
                        <div style="margin-top: 40px; margin-bottom: 20px;"></div>
<p style="margin-top:4.6pt; margin-left:12.2pt; margin-bottom:0.65pt">Pemeriksaan Nilai Nominal</p>
<table style="border-collapse: collapse; width: 100%; margin-left:10.92pt; border:2px solid #000000;">
    <tr>
        <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold;">
            Skala Nominal
        </td>
        <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold;">
            z1
        </td>
        <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold;">
            m1
        </td>
        <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold;">
            m1
        </td>
        <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold;">
            z1
        </td>
        <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold;">
            Standar Anak Timbang yang Digunakan
        </td>
    </tr>
    
    @foreach($calibration->detailTimbangans as $index => $detail)
    <tr>
        <td style="border:2px solid #000; padding:0;">
            <input type="number" step="any" name="titikUkur_{{ $index+1 }}" 
                   value="{{ $detail->titikUkur ?? '' }}"
                   style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
        </td>
        <td style="border:2px solid #000; padding:0;">
            <input type="number" step="any" name="Lz1_{{ $index+1 }}" 
                   value="{{ $detail->Lz1 ?? '' }}"
                   style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
        </td>
        <td style="border:2px solid #000; padding:0;">
            <input type="number" step="any" name="Lm1_{{ $index+1 }}" 
                   value="{{ $detail->Lm1 ?? '' }}"
                   style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
        </td>
        <td style="border:2px solid #000; padding:0;">
            <input type="number" step="any" name="Rm1_{{ $index+1 }}" 
                   value="{{ $detail->Rm1 ?? '' }}"
                   style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
        </td>
        <td style="border:2px solid #000; padding:0;">
            <input type="number" step="any" name="Rz1_{{ $index+1 }}" 
                   value="{{ $detail->Rz1 ?? '' }}"
                   style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
        </td>
        <td style="border:2px solid #000; padding:0;">
            <input type="number" step="any" name="STD_{{ $index+1 }}" 
                   value="{{ $detail->STD ?? '' }}"
                   style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
        </td>
    </tr>
    @endforeach
    
    <!-- Fallback jika data belum ada (10 baris kosong) -->
    @if($calibration->detailTimbangans->count() === 0)
        @for($i = 1; $i <= 10; $i++)
        <tr>
            <td style="border:2px solid #000; padding:0;">
                <input type="number" step="any" name="titikUkur_{{ $i }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            <td style="border:2px solid #000; padding:0;">
                <input type="number" step="any" name="Lz1_{{ $i }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            <td style="border:2px solid #000; padding:0;">
                <input type="number" step="any" name="Lm1_{{ $i }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            <td style="border:2px solid #000; padding:0;">
                <input type="number" step="any" name="Rm1_{{ $i }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            <td style="border:2px solid #000; padding:0;">
                <input type="number" step="any" name="Rz1_{{ $i }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
            <td style="border:2px solid #000; padding:0;">
                <input type="number" step="any" name="STD_{{ $i }}" 
                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
            </td>
        </tr>
        @endfor
    @endif
</table>

     <div style="margin-top: 40px; margin-bottom: 20px;"></div>

     <p style="margin-left:12.2pt; font-size:12pt; font-weight:bold; font-style:italic;">Off-Center Loading Test</p>
<table border="0" cellpadding="0" cellspacing="0" style="margin-left:12.2pt; margin-bottom:1.75pt">
    <tr>
        <td>
            Beban Timbangan 1/3 atau 1/2 dari Kapasitas Maksimal = 
        </td>
        <td>
            <input type="text" name="beban_timbangan" 
                   value="{{ $calibration->addTimbangan->bebanOffCenter ?? '' }}"
                   style="width:120px; border:1px solid #000; text-align:center; padding:2px;">
        </td>
        <td>
            &nbsp;&nbsp;Diutamakan anak timbangan tunggal jika memadai.
        </td>
    </tr>
</table>

<!-- Tabel Off-Center Loading Test -->
<table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 100%; margin-left:10.92pt; border:2px solid #000000;">
    <tr>
        <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold;">
            Posisi
        </td>
        <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold;">
            Tengah
        </td>
        <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold;">
            Depan
        </td>
        <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold;">
            Belakang
        </td>
        <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold;">
            Kanan
        </td>
        <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold;">
            Kiri
        </td>
    </tr>
    <tr>
        <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold;">
            Beban
        </td>
        <td style="border:2px solid #000; padding:0;">
            <input type="text" name="beban_tengah" 
                   value="{{ $calibration->addTimbangan->offCenterMiddle ?? '' }}"
                   style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
        </td>
        <td style="border:2px solid #000; padding:0;">
            <input type="text" name="beban_depan" 
                   value="{{ $calibration->addTimbangan->offCenterFront ?? '' }}"
                   style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
        </td>
        <td style="border:2px solid #000; padding:0;">
            <input type="text" name="beban_belakang" 
                   value="{{ $calibration->addTimbangan->offCenterBack ?? '' }}"
                   style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
        </td>
        <td style="border:2px solid #000; padding:0;">
            <input type="text" name="beban_kanan" 
                   value="{{ $calibration->addTimbangan->offCenterRight ?? '' }}"
                   style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
        </td>
        <td style="border:2px solid #000; padding:0;">
            <input type="text" name="beban_kiri" 
                   value="{{ $calibration->addTimbangan->offCenterLeft ?? '' }}"
                   style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
        </td>
    </tr>
</table>
            <p style="margin-top:0.35pt; font-size:9pt">&nbsp;</p>
<p style="margin-top:0.35pt; font-size:9pt">&nbsp;</p>

<style>
    /* Styling untuk checkbox view mode */
    .view-checkbox {
        width: 16px;
        height: 16px;
        cursor: default;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        border: 2px solid #666;
        border-radius: 3px;
        background-color: #f0f0f0;
        position: relative;
        vertical-align: middle;
    }
    
    .view-checkbox:checked {
        background-color: #000;
        border-color: #000;
    }
    
    .view-checkbox:checked::after {
        content: '✓';
        color: white;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 12px;
        font-weight: bold;
    }
    
    .view-checkbox:disabled {
        opacity: 1; /* Tetap terlihat jelas meski disabled */
    }
    
    .view-checkbox-label {
        cursor: default;
        user-select: none;
        margin-left: 3px;
    }
</style>

<table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 100%; margin-left:10.92pt; border:2px solid #000000;">
    <tr>
        <td colspan="5" style="border:2px solid #000; padding:12px; text-align:center; background-color:#f0f0f0;">
            <font style="font-weight:bold; font-size:10pt;">Isilah lembar data kalibrasi dengan lengkap dan jelas!</font>
        </td>
    </tr>
    <tr>
        <td rowspan="2" style="border:2px solid #000; padding:8px; background-color:#f0f0f0; vertical-align:middle;">
            <font style="font-weight:bold;">Peralatan Standard</font>
        </td>
        <td style="border:2px solid #000; padding:8px;">
            <font>Anak Timbangan <i>class</i> :</font>
        </td>
        <td style="border:2px solid #000; padding:8px;">
            @php
                // Ambil data standard dengan 's' kecil
                $standardData = $calibration->headTimbangan->standard ?? null;
                
                // Konversi ke array jika perlu
                $standardArray = [];
                if ($standardData) {
                    if (is_array($standardData)) {
                        $standardArray = $standardData;
                    } elseif (is_string($standardData)) {
                        // Coba decode JSON
                        $decoded = json_decode($standardData, true);
                        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                            $standardArray = $decoded;
                        } else {
                            // Split by comma jika string biasa
                            $standardArray = array_map('trim', explode(',', $standardData));
                        }
                    }
                }
            @endphp
            
            <table border="0" cellpadding="0" cellspacing="5">
                <tr>
                    <td style="padding:0 5px;">
                        <input type="checkbox" class="view-checkbox" id="class_E2" disabled 
                               @if(in_array('E2', $standardArray)) checked @endif>
                        <label for="class_E2" class="view-checkbox-label">E2</label>
                    </td>
                    <td>/</td>
                    <td style="padding:0 5px;">
                        <input type="checkbox" class="view-checkbox" id="class_F1" disabled 
                               @if(in_array('F1', $standardArray)) checked @endif>
                        <label for="class_F1" class="view-checkbox-label">F1</label>
                    </td>
                    <td>/</td>
                    <td style="padding:0 5px;">
                        <input type="checkbox" class="view-checkbox" id="class_F2" disabled 
                               @if(in_array('F2', $standardArray)) checked @endif>
                        <label for="class_F2" class="view-checkbox-label">F2</label>
                    </td>
                    <td>/</td>
                    <td style="padding:0 5px;">
                        <input type="checkbox" class="view-checkbox" id="class_M1" disabled 
                               @if(in_array('M1', $standardArray)) checked @endif>
                        <label for="class_M1" class="view-checkbox-label">M1</label>
                    </td>
                    <td>/</td>
                    <td style="padding:0 5px;">
                        <input type="checkbox" class="view-checkbox" id="class_M2" disabled 
                               @if(in_array('M2', $standardArray)) checked @endif>
                        <label for="class_M2" class="view-checkbox-label">M2</label>
                    </td>
                    <td>/</td>
                    <td style="padding:0 5px;">
                        <input type="checkbox" class="view-checkbox" id="class_M3" disabled 
                               @if(in_array('M3', $standardArray)) checked @endif>
                        <label for="class_M3" class="view-checkbox-label">M3</label>
                    </td>
                </tr>
            </table>
            <font size="1"><i>(centang pilihan)</i></font>
        </td>
        <td style="border:2px solid #000; padding:8px; text-align:center;">
            <font style="font-weight:bold;">Dikalibrasi oleh</font><br><br>
            <table border="1" cellpadding="0" cellspacing="0" style="width:100%; height:50px; border:1px solid #000; background-color:#fff;">
                <tr>
                    <td style="text-align:center; vertical-align:bottom; padding:10px;">
                        <font>TTD</font><br>
                        <table border="0" cellpadding="0" cellspacing="0" style="width:100%; margin-top:5px;">
                            <tr>
                                <td style="border-bottom:1px solid #000; padding:3px; text-align:center;">
                                    <font size="2">{{ $calibration->headTimbangan->ttd_kalibrator ?? '(...........................................)' }}</font>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <table border="1" cellpadding="0" cellspacing="0" style="width:100%; height:30px; border:1px solid #000; background-color:#fff; margin-top:5px;">
                <tr>
                    <td style="padding:5px; text-align:center;">
                        <strong>{{ $calibration->calibratedBy ?? '' }}</strong>
                    </td>
                </tr>
            </table>
            <font>Nama</font>
        </td>
        <td style="border:2px solid #000; padding:8px; text-align:center;">
            <font style="font-weight:bold;">Diperiksa oleh</font><br><br>
            <table border="1" cellpadding="0" cellspacing="0" style="width:100%; height:50px; border:1px solid #000; background-color:#fff;">
                <tr>
                    <td style="text-align:center; vertical-align:bottom; padding:10px;">
                        <font>TTD</font><br>
                        <table border="0" cellpadding="0" cellspacing="0" style="width:100%; margin-top:5px;">
                            <tr>
                                <td style="border-bottom:1px solid #000; padding:3px; text-align:center;">
                                    <font size="2">{{ $calibration->headTimbangan->ttd_pemeriksa ?? '(...........................................)' }}</font>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <table border="1" cellpadding="0" cellspacing="0" style="width:100%; height:30px; border:1px solid #000; background-color:#fff; margin-top:5px;">
                <tr>
                    <td style="padding:5px; text-align:center;">
                        <strong>{{ $calibration->verifiedBy ?? '' }}</strong>
                    </td>
                </tr>
            </table>
            <font>Nama</font>
        </td>
    </tr>
    <tr>
        <td style="border:2px solid #000; padding:8px; background-color:#f0f0f0; vertical-align:middle;">
            <font style="font-weight:bold;">Metode Kalibrasi</font>
        </td>
        <td colspan="4" style="border:2px solid #000; padding:8px;">
            <font>PAS-IK1102-15 (Monograph 4 : The Calibration of Weights and Balances, NMI Australia 2010)</font>
        </td>
    </tr>
</table>

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