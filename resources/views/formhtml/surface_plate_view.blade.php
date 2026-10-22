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
                        <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK53</p>
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
                        <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">MEJA RATA</p>
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
                        <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;">{{ $calibration->headSurfacePlate->certificate_id ?? 'N/A' }}</p>
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
                                   value="{{ \Carbon\Carbon::parse($calibration->tanggalKalibrasi)->format('d/m/Y') }}" readonly style="width: 45%;">
                            <span class="me-3" style="color: #000000;">Jenis Pembacaan:</span>
                            <input type="text" class="kalibrasi-input" value="{{ $calibration->jenisPembacaan }}" readonly style="width: 45%;">
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
         <style>
/* Container responsif */
.responsive-table-container {
    width: 100%;
    overflow-x: auto;
    margin: 20px 0;
    border: 1px solid #ddd;
    border-radius: 4px;
}

/* Styling tabel */
.setting-suhu-table {
    border-collapse: collapse;
    table-layout: fixed;
    min-width: 650px;
    width: 100%;
    font-family: Arial, sans-serif;
    font-size: 10pt;
    background: white;
}

.setting-suhu-table td {
    border: 1px solid #000;
    padding: 0;
    height: 26px;
    line-height: 1.2;
    text-align: center;
    vertical-align: middle;
}

.setting-suhu-table .row-label {
    width: 16px;
    min-width: 16px;
    max-width: 16px;
    font-weight: bold;
    background: #f8f9fa;
    padding: 0 1px;
    line-height: 1.1;
    font-size: 9pt;
    text-align: center;
}

.setting-suhu-table tr:first-child td:first-child {
    width: 16px;
    min-width: 16px;
    max-width: 16px;
    padding: 0;
}

.setting-suhu-table .head {
    width: 40px;
    min-width: 40px;
    font-weight: bold;
    background: #f5f5f5;
    position: relative;
    padding: 2px 2px;
    height: 28px;
    line-height: 1.1;
}

/* Styling untuk gambar panah di header */
.arrow-container {
    position: relative;
    display: inline-block;
    margin-left: 5px;
}

.header-arrow {
    vertical-align: middle;
}

/* Kolom keterangan dengan canvas drawing SIMPLE */
.keterangan-cell {
    width: 40%;
    min-width: 250px;
    vertical-align: top;
    padding: 12px;
    background: #f9f9f9;
}

.drawing-container {
    border: 1px solid #000;
    background: white;
    margin-top: 8px;
}

.canvas-wrapper {
    width: 100%;
    height: 280px;
    text-align: center;
}

.canvas-wrapper img {
    max-width: 100%;
    max-height: 100%;
    border: 1px solid #ccc;
}

/* Row labels */
.row-label {
    font-weight: bold;
    background: #f8f9fa;
    min-width: 50px;
}

/* Data value */
.data-value {
    font-weight: normal;
    color: #333;
}

/* Responsive design */
@media (max-width: 768px) {
    .canvas-wrapper {
        height: 230px;
    }
}
</style>

<div class="responsive-table-container">
<table class="setting-suhu-table">
    <?php
    // Data gambar panah
    $arrow1 = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAgAAAARCAYAAADg1u3YAAAABHNCSVQICAgIfAhkiAAAALRJREFUKJGVkLENwkAMRR+n1Ag6yqxAnyKFe9iAjBB5AZggygZkhNCnoLgBYAOYgGwABXfS5TiB+I31re/vb0MAUfskgon4VdSW3wTjL4cP/C24ANMMorZLZRC1uagdDZCL2irhvgV6A3TALiEogX7m7G5ABSyA2k0/gKUPeQD2QYYtcBqaYjQAQ1N0wBpYhfvjM1u3JgM2XpBFgjsw9/YTB9c4Otr7fvzJ1tVz4uw3RG0d8hcHNC4StBm3LQAAAABJRU5ErkJggg==";
    $arrow2 = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAgAAAAUCAYAAACwG3xrAAAABHNCSVQICAgIfAhkiAAAAJpJREFUKJHtkLENAyEQBEfIhVDCOyekAEJnJnRoUQj6EijhCyCkADtzSAmU4MDnF/gpwSshnfZGqz2gkw0l2VDW3lOMugC3KWBD8UAFqsyHBA+85F0HwIaigQV4Ag/gLN6ecAdSl5bE2wEH9O1V8VA2FAe0HE39bmVuNhSnpNxwe5filZTbJsAGLKccjZ4sydE0QP/+5EF/4KM3EREoIkKvALUAAAAASUVORK5CYII=";
    
    // Ambil data dengan benar
    // $calibration->detailSurfacePlates adalah COLLECTION, gunakan first()
    $detail = $calibration->detailSurfacePlates->first() ?? null;
    $head = $calibration->headSurfacePlate ?? null;
    
    // Header row
    ?>
    <tr>
         <td></td>
         <?php for($i = 1; $i <= 10; $i++):
             $arrow = ($i % 2 == 1) ? $arrow1 : $arrow2;
             $height = ($i % 2 == 1) ? '16' : '20';
         ?>
         <td class="head">
             <?php echo $i; ?>
             <span class="arrow-container">
                 <img width='8' height='<?php echo $height; ?>' 
                      src='<?php echo $arrow; ?>' 
                      class='header-arrow' 
                      alt='→' />
             </span>
         </td>
         <?php endfor; ?>
         
     <!-- Kolom keterangan dengan visualisasi gambar -->
 <td rowspan="14" class="keterangan-cell">
    <strong>Keterangan / Visualisasi:</strong><br>
    <div class="drawing-container">
        <?php
        $calibrationId = $calibration->id ?? null;

        if($calibrationId):
            // Cari file dengan pattern: surface_plate_{ID}_*.png
            $pattern = public_path('img_SurfacePlate/surface_plate_' . $calibrationId . '_*.png');
            $files = glob($pattern);
            
            if(!empty($files)):
                // Ambil file pertama
                $filePath = $files[0];
                $fileName = basename($filePath);
                // Gunakan asset() helper untuk path yang benar
                $imageUrl = asset('img_SurfacePlate/' . $fileName);
        ?>
                <div style="text-align: center; height: 280px; border: 1px solid #000; background: white;">
                    <img src="<?php echo $imageUrl; ?>" 
                         style="max-width: 100%; max-height: 250px; margin-top: 10px;"
                         alt="Surface Plate Image"
                         onerror="this.onerror=null; this.src=''; this.parentElement.innerHTML='<div style=\'padding:40px; color:#999;\'>Gambar tidak dapat dimuat</div>';">
                    <!--<div style="font-size: 10px; color: #666; margin-top: 5px;">-->
                    <!--    <?php echo $fileName; ?>-->
                    <!--</div>-->
                </div>
        <?php
            else:
        ?>
                <div style="text-align: center; padding: 40px; color: #999; border: 1px solid #000; height: 280px;">
                    Tidak ditemukan gambar untuk ID: <?php echo $calibrationId; ?>
                </div>
        <?php
            endif;
        else:
        ?>
            <div style="text-align: center; padding: 40px; color: #999; border: 1px solid #000; height: 280px;">
                ID calibration tidak tersedia
            </div>
        <?php endif; ?>
    </div>
</td>
    </tr>

     <!-- Data pengukuran a1_1 sampai a13_10 -->
     <?php for($row = 1; $row <= 13; $row++): ?>
     <tr>
         <td class="row-label">a<?php echo $row; ?></td>
         <?php for($col = 1; $col <= 10; $col++): 
             $key = "a{$row}_{$col}";
             // Ambil value dari detail (jika ada)
             $value = $detail ? ($detail->$key ?? '') : '';
         ?>
         <td>
             <?php if($value !== '' && $value !== null): ?>
                 <span class="data-value"><?php echo $value; ?></span>
             <?php else: ?>
                 <span class="data-value" style="color: #999;"> </span>
            <?php endif; ?>
        </td>
        <?php endfor; ?>
    </tr>
    <?php endfor; ?>
</table>
</div>

<style>
.repeatability-matrix{
    border-collapse: collapse;
    width: 98%;
    font-family: Arial, sans-serif;
    font-size: 10pt;
    margin: 10px 0;
}

.repeatability-matrix td{
    border:1px solid #000;
    padding:3px;
    text-align:center;
    height:22px;
}

.repeatability-matrix .head{
    font-weight:bold;
    background:#f5f5f5;
}

.repeatability-matrix .rowno{
    width:40px;
    font-weight:bold;
}

.repeatability-matrix .data-value{
    font-weight: normal;
    color: #333;
}

.repeatability-matrix .arrow-img {
    vertical-align: middle;
    margin-left: 2px;
}
</style>

<table class="repeatability-matrix">
    <?php
    // Gambar panah (Base64 encoded)
    $arrow1 = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACsAAAAICAYAAABgZQZYAAAABHNCSVQICAgIfAhkiAAAANpJREFUOI3N1D1KA1EUhuEnMPhXaWGtllbaO+UtLF1CdqDc3i0MZgeTHcR+CovbmwVYZAkREX8aLa7FEGSiAZ18cIoDH4eXy8sd6DkhphnuUTdVedvVHfwLUUdCTLu4wBAnmGDUVOV0sds7bDshpkMZ/AofqDFuqnLGL2FDTFvYaM3mH+77OMIBphgVIaY77Cw5sN1ifsJ7a95W3F/xgsdvOgXOcIwHWYu6wPWy401VPv/8/VdPiOkVl7K/Y5y33V0LZ0NMQxlyDzfyzzBf7PUO+6XhXAacdHU/AV7uUis0PhT9AAAAAElFTkSuQmCC";
    $arrow2 = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAICAYAAACLUr1bAAAABHNCSVQICAgIfAhkiAAAAOFJREFUOI3FlLsJQjEUQE9AtFIsbOzcQO1TKGSAt4HPCZQMEhxBN7A3hWAGcAO11MZCENTGwijhKZEHfg5cws2HnBuSCCIo7RKgB7StkY3Y3G9RyHYo7VrAAEiADTAC+j/2eiC8VCOQEl5qao1c/0vsjlDaLYEmsAZWwA44A6cgPpZbIw95BAvcTmsA1IEtMAMuQCmIom/LQC3Is+Nvc6VdOdj/ECnqaI3sivtMf/eG3B7FGJhYI+d5qs2L0q4SK8gauRAvFlWB1MvugZE1cvJN0RhPgiH+m0mBqjWy8wuhLFdg5k+38TkR6wAAAABJRU5ErkJggg==";
    
    // Data kelompok
    $groups = [
        'A' => ['name' => 'A', 'table_num' => 1, 'headers' => ['A1', 'A2', 'A3', 'A4', 'A5', 'A6', 'A7', 'A8', 'A9']],
        'B' => ['name' => 'B', 'table_num' => 2, 'headers' => ['A1', 'B2', 'B2', 'B3', 'B4', 'B5', 'B6', 'B7', 'B8']],
        'C' => ['name' => 'C', 'table_num' => 3, 'headers' => ['A1', 'C1', 'C2', 'C3', 'C4', 'C5', 'C6', 'C7', 'C8']],
        'D' => ['name' => 'D', 'table_num' => 4, 'headers' => ['A1', 'D1', 'D2', 'D3', 'D4', 'D5', 'D6', 'D7', 'D8']],
        'E' => ['name' => 'E', 'table_num' => 5, 'headers' => ['A1', 'E1', 'E2', 'E3', 'E4', 'E5', 'E6', 'E7', 'E8']],
        'F' => ['name' => 'F', 'table_num' => 6, 'headers' => ['A1', 'F1', 'F2', 'F3', 'F4', 'F5', 'F6', 'F7', 'F8']],
        'G' => ['name' => 'G', 'table_num' => 7, 'headers' => ['A1', 'G1', 'G2', 'G3', 'G4', 'G5', 'G6', 'G7', 'G8']],
        'H' => ['name' => 'H', 'table_num' => 8, 'headers' => ['A1', 'H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'H7', 'H8']],
        'I' => ['name' => 'I', 'table_num' => 9, 'headers' => ['A1', 'I1', 'I2', 'I3', 'I4', 'I5', 'I6', 'I7', 'I8']],
        'J' => ['name' => 'J', 'table_num' => 10, 'headers' => ['A1', 'J1', 'J2', 'J3', 'J4', 'J5', 'J6', 'J7', 'J8']]
    ];
    
    // Loop untuk setiap kelompok
    foreach($groups as $group):
        $groupKey = $group['name'];
        $tableNum = $group['table_num'];
        $headers = $group['headers'];
    ?>
    <thead>
         <tr>
            <td class="empty">&nbsp;</td>
            <?php foreach($headers as $header): ?>
            <td class="head"><?php echo $header; ?></td>
            <?php endforeach; ?>
         </tr>
    </thead>
    
    <tbody>
        <!-- Row 1 -->
         <tr>
            <td class="rowno">
                1 
                <?php if($groupKey == 'A'): ?>
                <img width='42' height='8' src="<?php echo $arrow1; ?>" class="arrow-img" alt='→' />
                <?php else: ?>
                <img width='42' height='8' src="<?php echo $arrow1; ?>" class="arrow-img" alt='→' />
                <?php endif; ?>
            </td>
            <?php 
            // Data untuk row 1 - ambil dari $detail sesuai database field
            for($i=1; $i<=9; $i++): 
                if ($groupKey == 'A') {
                    // Table 1: a1_1_tbl1, a2_1_tbl1, ..., a9_1_tbl1
                    $fieldName = "a{$i}_1_tbl1";
                    $value = isset($detail->$fieldName) ? $detail->$fieldName : '';
                } else {
                    if ($i == 1) {
                        // Baris pertama untuk semua tabel: a1_1_tblX
                        $fieldName = "a1_1_tbl{$tableNum}";
                        $value = isset($detail->$fieldName) ? $detail->$fieldName : '';
                    } else {
                        // Baris 2-9: b1_1_tbl2, b2_1_tbl2, ..., c1_1_tbl3, dst
                        $letter = strtolower($groupKey);
                        $rowNum = $i - 1; // Karena dimulai dari 2 di database
                        $fieldName = "{$letter}{$rowNum}_1_tbl{$tableNum}";
                        $value = isset($detail->$fieldName) ? $detail->$fieldName : '';
                    }
                }
                
                // Tampilkan nilai asli (tanpa number_format)
                $displayValue = ($value !== '' && $value !== null) ? $value : '';
            ?>
            <td>
                <?php if($displayValue !== ''): ?>
                    <span class="data-value"><?php echo $displayValue; ?></span>
                <?php else: ?>
                    <span class="data-value" style="color: #999;"> </span>
                <?php endif; ?>
            </td>
            <?php endfor; ?>
         </tr>
        
        <!-- Row 2 -->
         <tr>
            <td class="rowno">
                2
                <?php if($groupKey == 'A'): ?>
                <img width='39' height='8' src="<?php echo $arrow2; ?>" class="arrow-img" alt='→' />
                <?php else: ?>
                <img width='39' height='8' src="<?php echo $arrow2; ?>" class="arrow-img" alt='→' />
                <?php endif; ?>
            </td>
            <?php 
            // Data untuk row 2 - ambil dari $detail sesuai database field
            for($i=1; $i<=9; $i++): 
                if ($groupKey == 'A') {
                    // Table 1: a1_2_tbl1, a2_2_tbl1, ..., a9_2_tbl1
                    $fieldName = "a{$i}_2_tbl1";
                    $value = isset($detail->$fieldName) ? $detail->$fieldName : '';
                } else {
                    if ($i == 1) {
                        // Baris pertama untuk semua tabel: a1_2_tblX
                        $fieldName = "a1_2_tbl{$tableNum}";
                        $value = isset($detail->$fieldName) ? $detail->$fieldName : '';
                    } else {
                        // Baris 2-9: b1_2_tbl2, b2_2_tbl2, ..., c1_2_tbl3, dst
                        $letter = strtolower($groupKey);
                        $rowNum = $i - 1; // Karena dimulai dari 2 di database
                        $fieldName = "{$letter}{$rowNum}_2_tbl{$tableNum}";
                        $value = isset($detail->$fieldName) ? $detail->$fieldName : '';
                    }
                }
                
                // Tampilkan nilai asli (tanpa number_format)
                $displayValue = ($value !== '' && $value !== null) ? $value : '';
            ?>
            <td>
                <?php if($displayValue !== ''): ?>
                    <span class="data-value"><?php echo $displayValue; ?></span>
                <?php else: ?>
                    <span class="data-value" style="color: #999;"> </span>
                <?php endif; ?>
            </td>
            <?php endfor; ?>
         </tr>
    </tbody>
    
    <?php endforeach; ?>
</table>


              <table cellspacing="0" cellpadding="5" style="width:100%; max-width: 1100px; margin: 20px auto; border-collapse:collapse; font-size:12pt; background-color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
    <tr>
        <td colspan="12" style="border:1px solid #000; text-align:center; font-weight:bold; font-size: 18px; background-color: #f0f0f0; padding: 12px;">
            Isilah lembar data kalibrasi dengan lengkap dan jelas!
        </td>
    </tr>

    <tr>
        <!-- Alat Standar -->
        <td style="border:1px solid #000; width:15%; text-align:center; font-weight: bold; background-color: #e0e0e0; padding: 12px;">Alat Standar</td>
        
        <!-- Data Alat Standar -->
        <td style="border:1px solid #000; width:35%; padding: 12px; text-align: center;">
            <?php 
            // Ambil data alat standar dari head 
            $alatStandar = isset($calibration->headSurfacePlate->standard) 
                ? $calibration->headSurfacePlate->standard 
                : 'PRECISION SPIRIT LEVEL';
            echo htmlspecialchars($alatStandar);
            ?>
        </td>
        
        <!-- Dikalibrasi oleh (Header) -->
        <td colspan="3" style="border:1px solid #000; text-align:center; font-weight: bold; background-color: #e0e0e0; padding: 12px;">Dikalibrasi oleh</td>
        
        <!-- Diperiksa oleh (Header) -->
        <td colspan="3" style="border:1px solid #000; text-align:center; font-weight: bold; background-color: #e0e0e0; padding: 12px;">Diperiksa oleh</td>
    </tr>

    <tr>
        <!-- Metode Kalibrasi -->
        <td style="border:1px solid #000; text-align:center; font-weight: bold; background-color: #e0e0e0; padding: 12px;">Metode Kalibrasi</td>
        
        <!-- Data Metode Kalibrasi -->
        <td style="border:1px solid #000; padding: 12px; text-align: center;">
            <?php 
            // Ambil metode kalibrasi dari head
            $calibrationMethod = isset($calibration->headSurfacePlate->calibrationMethod) 
                ? $calibration->headSurfacePlate->calibrationMethod 
                : 'PAS-IK1102-53';
            echo htmlspecialchars($calibrationMethod);
            ?>
        </td>

        <!-- Dikalibrasi oleh (Area TTD & Nama) -->
        <td colspan="3" style="border:1px solid #000; vertical-align:top; padding: 15px 20px 10px; height: 120px;">
            TTD:<br><br><br>
            <div style="margin-top: 20px; font-weight: bold;">
                Nama: <?php echo isset($calibration->calibratedBy) ? htmlspecialchars($calibration->calibratedBy) : ''; ?>
            </div>
        </td>

        <!-- Diperiksa oleh (Area TTD & Nama) -->
        <td colspan="3" style="border:1px solid #000; vertical-align:top; padding: 15px 20px 10px; height: 120px;">
            TTD:<br><br><br>
            <div style="margin-top: 20px; font-weight: bold;">
                Nama: <?php echo isset($calibration->verifiedBy) ? htmlspecialchars($calibration->verifiedBy) : ''; ?>
            </div>
        </td>
    </tr>
</table>
            <!-- Action Buttons Section -->
            <div class="row mt-5">
                <div class="col-12 text-center">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary btn-lg" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                    
                    <!--<button onclick="window.print()" class="btn btn-primary btn-lg ms-3" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">-->
                    <!--    <i class="fas fa-print me-2"></i>Cetak-->
                    <!--</button>-->
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>