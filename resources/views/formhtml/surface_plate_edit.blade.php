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
            <input type="text" name="namaAlat" class="kalibrasi-input" 
                   value="{{ old('namaAlat', $calibration->namaAlat) }}">
        </td>
    </tr>


                <!-- Merek & Kode -->
    <tr>
        <td><p style="margin:0;color:#000;">Merek</p></td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="text" name="brandAlat" class="kalibrasi-input me-3"
                       value="{{ old('brandAlat', $calibration->brandAlat) }}" style="width:60%;">
                <span class="me-3">Kode Alat :</span>
                <input type="text" name="kodeAlat" class="kalibrasi-input"
                       value="{{ old('kodeAlat', $calibration->kodeAlat) }}" style="width:30%;">
            </div>
        </td>
    </tr>

    <!-- Type / No Seri -->
    <tr>
        <td><p style="margin:0;color:#000;">Type / No. Seri</p></td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="text" name="typeAlat" class="kalibrasi-input me-3"
                       value="{{ old('typeAlat', $calibration->typeAlat) }}" style="width:45%;">
                <span class="me-3">/</span>
                <input type="text" name="NoSeri" class="kalibrasi-input"
                       value="{{ old('NoSeri', $calibration->NoSeri) }}" style="width:45%;">
            </div>
        </td>
    </tr>

    <!-- Kapasitas / Resolusi -->
    <tr>
        <td><p style="margin:0;color:#000;">Kapasitas / Resolusi</p></td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="text" name="kapasitas" class="kalibrasi-input me-3"
                       value="{{ old('kapasitas', $calibration->kapasitas) }}" style="width:45%;">
                <span class="me-3">/</span>
                <input type="text" name="resolusi" class="kalibrasi-input"
                       value="{{ old('resolusi', $calibration->resolusi) }}" style="width:45%;">
            </div>
        </td>
    </tr>

    <!-- Pemilik -->
    <tr>
        <td><p style="margin:0;color:#000;">Nama Pemilik</p></td>
        <td colspan="3">
            <input type="text" name="pemilikAlat" class="kalibrasi-input"
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
                                   value="{{ old('tanggalMasuk', Carbon\Carbon::parse($calibration->tanggalMasuk)->format('Y-m-d')) }}" >
                        </td>
                    </tr>


    <tr>
        <td><p style="margin:0;color:#000;">Tanggal Kalibrasi</p></td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="date" name="tanggalKalibrasi" class="kalibrasi-input me-3"
                       value="{{ old('tanggalKalibrasi', $calibration->tanggalKalibrasi) }}" style="width:45%;">
                <span class="me-3">Jenis Pembacaan:</span>
                <input type="text" name="jenisPembacaan" class="kalibrasi-input"
                       value="{{ old('jenisPembacaan', $calibration->jenisPembacaan) }}" style="width:45%;">
            </div>
        </td>
    </tr>

    <!-- Tempat -->
     <tr>
        <td><p style="margin: 0; color: #000000;">Tempat Kalibrasi</p></td>
        <td colspan="3">
            <div class="d-flex">
                <div class="form-check me-5">
                    <input class="form-check-input" type="radio" name="tempatKalibrasi" value="lab.PT PAS"
                           {{ old('tempatKalibrasi', $calibration->tempatKalibrasi) == 'lab.PT PAS' ? 'checked' : '' }}>
                    <label class="form-check-label">Lab. PT.PAS</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tempatKalibrasi" value="insitu"
                           {{ old('tempatKalibrasi', $calibration->tempatKalibrasi) == 'insitu' ? 'checked' : '' }}>
                    <label class="form-check-label">Insitu</label>
                </div>
            </div>
        </td>
    </tr>

    <!-- Lokasi -->
    <tr>
        <td><p style="margin:0;color:#000;">Lokasi PT</p></td>
        <td colspan="3">
            <input type="text" name="lokasiPT" class="kalibrasi-input"
                   value="{{ old('lokasiPT', $calibration->lokasiPT) }}">
        </td>
    </tr>
            </table>

           <!-- Fungsi Komponen Lainnya & Kondisi Kalibrasi -->
<div class="row mt-4">

    <!-- Fungsi Komponen Lainnya -->
    <div class="col-md-6 mb-4">
        <div class="kalibrasi-section-header" style="color:#000000;">
            Fungsi Komponen Lainnya
        </div>

        <!-- Radio -->
        <div class="d-flex justify-content-center align-items-center mb-4" style="gap:60px;">
            <div class="text-center">
                <span class="fw-bold d-block mb-2" style="color:#000000;font-size:14px;">Ok</span>
                <input type="radio" name="kondisiAlat" value="ok" class="form-check-input"
                    style="width:18px;height:18px;display:block;margin:0 auto;"
                    {{ $calibration->kondisiAlat == 'ok' ? 'checked' : '' }}>
            </div>

            <div class="text-center">
                <span class="fw-bold d-block mb-2" style="color:#000000;font-size:14px;">Rusak</span>
                <input type="radio" name="kondisiAlat" value="rusak" class="form-check-input"
                    style="width:18px;height:18px;display:block;margin:0 auto;"
                    {{ $calibration->kondisiAlat == 'rusak' ? 'checked' : '' }}>
            </div>
        </div>

        <!-- Keterangan -->
        <div class="d-flex align-items-center">
            <span class="fw-bold me-3" style="color:#000000;min-width:100px;">Keterangan :</span>
            <div style="flex:1;">
                <input type="text" name="keterangan_fungsi_komponen" class="kalibrasi-input"
                       value="{{ $calibration->keterangan }}"
                       style="border:none;border-bottom:2px solid #000;border-radius:0;
                              padding:4px 0;background:transparent;width:100%;">
            </div>
        </div>
    </div>

    <!-- Kondisi Kalibrasi -->
    <div class="col-md-6 mb-4">
        <div class="kalibrasi-section-header" style="color:#000000;">
            Kondisi Kalibrasi
        </div>

        <table class="table table-bordered">
            <tr>
                <td class="table-secondary fw-bold" style="width:30%;color:#000000;"></td>
                <td class="table-secondary fw-bold text-center">Awal</td>
                <td class="table-secondary fw-bold text-center">Tengah</td>
                <td class="table-secondary fw-bold text-center">Akhir</td>
            </tr>

            <tr>
                <td class="bg-light fw-bold">Suhu (°C)</td>
                <td><input type="text" name="RT_condition1" class="kondisi-input"
                           value="{{ $calibration->RT_condition1 }}"></td>
                <td><input type="text" name="RT_condition2" class="kondisi-input"
                           value="{{ $calibration->RT_condition2 }}"></td>
                <td><input type="text" name="RT_condition3" class="kondisi-input"
                           value="{{ $calibration->RT_condition3 }}"></td>
            </tr>

            <tr>
                <td class="bg-light fw-bold">RH (%)</td>
                <td><input type="text" name="RH_condition1" class="kondisi-input"
                           value="{{ $calibration->RH_condition1 }}"></td>
                <td><input type="text" name="RH_condition2" class="kondisi-input"
                           value="{{ $calibration->RH_condition2 }}"></td>
                <td><input type="text" name="RH_condition3" class="kondisi-input"
                           value="{{ $calibration->RH_condition3 }}"></td>
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

/* ================================
   🔥 FIX TOOLS CANVAS UNTUK HALAMAN EDIT
   ================================ */

/* Container utama canvas + tools */
.drawing-container {
    border: 1px solid #000;
    background: white;
    margin-top: 8px;
    position: relative;
    overflow: visible !important;
    height: auto !important;
    min-height: 350px;
}

.canvas-wrapper {
    width: 100%;
    height: 280px;
    text-align: center;
    position: relative;
    overflow: visible !important;
}

/* Simple tools — tampil jelas */
.simple-tools {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
    position: relative !important;
    z-index: 100 !important;
    background: #f0f0f0 !important;
    padding: 10px !important;
    margin-top: 8px !important;
    min-height: 50px !important;
    clear: both !important;
    overflow: visible !important;
    border-top: 1px solid #ddd !important;
}

/* Canvas tools wrapper */
.simple-tools #canvasTools,
.simple-tools > div {
    display: flex !important;
    flex-wrap: wrap !important;
    align-items: center !important;
    gap: 8px !important;
    visibility: visible !important;
    opacity: 1 !important;
    position: relative !important;
    z-index: 101 !important;
    padding: 5px 0 !important;
    background: transparent !important;
    border: none !important;
}

/* Tombol-tombol tools */
.simple-tools button,
#canvasTools button {
    display: inline-block !important;
    visibility: visible !important;
    opacity: 1 !important;
    padding: 6px 12px !important;
    font-size: 12px !important;
    font-weight: 600 !important;
    cursor: pointer !important;
    border: none !important;
    border-radius: 4px !important;
    white-space: nowrap !important;
    min-width: 70px !important;
    height: auto !important;
    line-height: 1.2 !important;
    text-align: center !important;
    color: white !important;
    position: relative !important;
    z-index: 102 !important;
}

/* Warna spesifik per tombol */
#canvasDrawBtn {
    background: #007bff !important;
    color: #ffffff !important;
}

#canvasDotBtn {
    background: #28a745 !important;
    color: #ffffff !important;
}

#canvasClearBtn {
    background: #dc3545 !important;
    color: #ffffff !important;
}

/* Label "Tools:" */
.simple-tools span {
    display: inline-block !important;
    visibility: visible !important;
    font-size: 13px !important;
    font-weight: 600 !important;
    color: #333 !important;
    margin-right: 5px !important;
}
</style>

<div class="responsive-table-container">
<table class="setting-suhu-table">
    <?php
    // Data gambar panah
    $arrow1 = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAgAAAARCAYAAADg1u3YAAAABHNCSVQICAgIfAhkiAAAALRJREFUKJGVkLENwkAMRR+n1Ag6yqxAnyKFe9iAjBB5AZggygZkhNCnoLgBYAOYgGwABXfS5TiB+I31re/vb0MAUfskgon4VdSW3wTjL4cP/C24ANMMorZLZRC1uagdDZCL2irhvgV6A3TALiEogX7m7G5ABSyA2k0/gKUPeQD2QYYtcBqaYjQAQ1N0wBpYhfvjM1u3JgM2XpBFgjsw9/YTB9c4Otr7fvzJ1tVz4uw3RG0d8hcHNC4StBm3LQAAAABJRU5ErkJggg==";
    $arrow2 = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAgAAAAUCAYAAACwG3xrAAAABHNCSVQICAgIfAhkiAAAAJpJREFUKJHtkLENAyEQBEfIhVDCOyekAEJnJnRoUQj6EijhCyCkADtzSAmU4MDnF/gpwSshnfZGqz2gkw0l2VDW3lOMugC3KWBD8UAFqsyHBA+85F0HwIaigQV4Ag/gLN6ecAdSl5bE2wEH9O1V8VA2FAe0HE39buVmNhSnpNxwe5filZTbJsAGLKccjZ4sydE0QP/+5EF/4KM3EREoIkKvALUAAAAASUVORK5CYII=";
    
    // Ambil data dengan benar
    $detail = $calibration->detailSurfacePlates->first() ?? null;
    $head = $calibration->headSurfacePlate ?? null;
    
    // Cari gambar dari folder public/img_SurfacePlate
    $calibrationId = $calibration->id ?? null;
    $existingImageUrl = null;
    $existingImageFile = null;
    
    if($calibrationId):
        $pattern = public_path('img_SurfacePlate/surface_plate_' . $calibrationId . '_*.png');
        $files = glob($pattern);
        if(!empty($files)):
            $filePath = $files[0];
            $fileName = basename($filePath);
            $existingImageUrl = asset('img_SurfacePlate/' . $fileName);
            $existingImageFile = $fileName;
        endif;
    endif;
    
    // Header row
    ?>
      <tr>
         <td class="empty">&nbsp;</td>
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
         
         <!-- Kolom keterangan dengan 2 opsi: gambar lama + canvas baru -->
         <td rowspan="14" class="keterangan-cell">
            <strong>Keterangan / Visualisasi:</strong><br>
            
            <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                <!-- Opsi 1: Gambar yang sudah ada -->
                <div style="flex: 1; min-width: 200px;">
                    <div style="font-weight: bold; margin-bottom: 5px; text-align: center;">Gambar Saat Ini</div>
                    <div style="border: 1px solid #000; background: white; height: 250px; display: flex; align-items: center; justify-content: center;">
                        <?php if($existingImageUrl): ?>
                            <img id="existingImage" src="<?php echo $existingImageUrl; ?>" style="max-width: 100%; max-height: 240px;">
                        <?php else: ?>
                            <span style="color: #999;">Belum ada gambar</span>
                        <?php endif; ?>
                    </div>
                    <div style="text-align: center; margin-top: 5px;">
                        <!--<button type="button" id="useExistingImageBtn" style="padding: 4px 8px; background: #28a745; color: white; border: none; border-radius: 3px; font-size: 11px; cursor: pointer;">-->
                        <!--    📷 Gunakan Gambar Ini-->
                        <!--</button>-->
                    </div>
                </div>
                
                         <!-- Opsi 2: Canvas untuk gambar baru -->
                 <div style="flex: 1; min-width: 250px;">
                     <div style="font-weight: bold; margin-bottom: 5px; text-align: center;">Gambar Baru (Edit/Ganti)</div>
                     <div class="drawing-container">
                         <div class="canvas-wrapper">
                             <canvas id="drawCanvas" class="drawing-canvas"></canvas>
                         </div>
                         
                         <!-- INPUT HIDDEN UNTUK GAMBAR -->
                         <input type="hidden" name="keterangan" id="keterangan" value="">
                         <input type="hidden" name="keterangan_gambar" id="keteranganGambar" value="">
                         
                         <div class="simple-tools"></div>
                     </div>
                 </div>
            </div>
        </td>
     </tr>

     <!-- Data pengukuran a1_1 sampai a13_10 -->
     <?php for($row = 1; $row <= 13; $row++): ?>
      <tr>
         <td class="row-label">a<?php echo $row; ?></td>
         <?php for($col = 1; $col <= 10; $col++): 
             $key = "a{$row}_{$col}";
             $value = $detail ? ($detail->$key ?? '') : '';
         ?>
         <td class="data-cell">
             <input type="text" name="<?php echo $key; ?>" 
                    value="<?php echo htmlspecialchars($value); ?>" 
                    style="width: 100%; border: none; text-align: center; font-size: 11pt; padding: 4px; background: transparent;"
                    placeholder=" ">
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
    
    // Data kelompok dengan field database langsung
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
        $letter = strtolower($groupKey);
    ?>
     <tr>
        <td class="empty">&nbsp;</td>
        <?php foreach($headers as $header): ?>
        <td class="head"><?php echo $header; ?></td>
        <?php endforeach; ?>
     </tr>
    
    <!-- Row 1 -->
     <tr>
        <td class="rowno">
            1 
            <img width='42' height='8' src="<?php echo $arrow1; ?>" class="arrow-img" alt='→' />
        </td>
        <?php 
        for($i=1; $i<=9; $i++): 
            if ($groupKey == 'A') {
                // Group A: a1_1_tbl1, a2_1_tbl1, ..., a9_1_tbl1
                $fieldName = "a{$i}_1_tbl1";
                $value = isset($detail->$fieldName) ? $detail->$fieldName : '';
            } else {
                if ($i == 1) {
                    // Kolom pertama: a1_1_tblX
                    $fieldName = "a1_1_tbl{$tableNum}";
                    $value = isset($detail->$fieldName) ? $detail->$fieldName : '';
                } else {
                    // Kolom 2-9: b1_1_tbl2, b2_1_tbl2, ..., b8_1_tbl2
                    $rowNum = $i - 1;
                    $fieldName = "{$letter}{$rowNum}_1_tbl{$tableNum}";
                    $value = isset($detail->$fieldName) ? $detail->$fieldName : '';
                }
            }
        ?>
        <td class="data-cell">
            <input type="text" name="<?php echo $fieldName; ?>" 
                   value="<?php echo htmlspecialchars($value); ?>" 
                   style="width: 100%; border: none; text-align: center; font-size: 11pt; padding: 4px; background: transparent;" 
                   placeholder=" ">
        </td>
        <?php endfor; ?>
     </tr>
    
    <!-- Row 2 -->
     <tr>
        <td class="rowno">
            2
            <img width='39' height='8' src="<?php echo $arrow2; ?>" class="arrow-img" alt='→' />
        </td>
        <?php 
        for($i=1; $i<=9; $i++): 
            if ($groupKey == 'A') {
                // Group A: a1_2_tbl1, a2_2_tbl1, ..., a9_2_tbl1
                $fieldName = "a{$i}_2_tbl1";
                $value = isset($detail->$fieldName) ? $detail->$fieldName : '';
            } else {
                if ($i == 1) {
                    // Kolom pertama: a1_2_tblX
                    $fieldName = "a1_2_tbl{$tableNum}";
                    $value = isset($detail->$fieldName) ? $detail->$fieldName : '';
                } else {
                    // Kolom 2-9: b1_2_tbl2, b2_2_tbl2, ..., b8_2_tbl2
                    $rowNum = $i - 1;
                    $fieldName = "{$letter}{$rowNum}_2_tbl{$tableNum}";
                    $value = isset($detail->$fieldName) ? $detail->$fieldName : '';
                }
            }
        ?>
        <td class="data-cell">
            <input type="text" name="<?php echo $fieldName; ?>" 
                   value="<?php echo htmlspecialchars($value); ?>" 
                   style="width: 100%; border: none; text-align: center; font-size: 11pt; padding: 4px; background: transparent;" 
                   placeholder=" ">
        </td>
        <?php endfor; ?>
     </tr>
    
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
        <input type="hidden" name="alat_standar_text" value="PRECISION SPIRIT LEVEL">
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
        Nama: 
        <input type="text" name="calibratedBy" 
               value="<?php echo isset($calibration->calibratedBy) ? htmlspecialchars($calibration->calibratedBy) : ''; ?>" 
               style="width: 90%; font-weight: bold; font-size: 12pt; border-bottom: 2px solid #000; border-top: none; border-left: none; border-right: none; background: transparent; padding: 2px;" readonly>
    </div>
</td>

<!-- Diperiksa oleh (Area TTD & Nama) -->
<td colspan="3" style="border:1px solid #000; vertical-align:top; padding: 15px 20px 10px; height: 120px;">
    TTD:<br><br><br>
    <div style="margin-top: 20px; font-weight: bold;">
        Nama: 
        <input type="text" name="verifiedBy" 
               value="<?php echo isset($calibration->verifiedBy) ? htmlspecialchars($calibration->verifiedBy) : ''; ?>" 
               style="width: 90%; font-weight: bold; font-size: 12pt; border-bottom: 2px solid #000; border-top: none; border-left: none; border-right: none; background: transparent; padding: 2px;">
    </div>
</td>
    </tr>
</table>
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

    <script src="/js/canvas-surface-plate.js?v={{ filemtime(public_path('js/canvas-surface-plate.js')) }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
var tempFormDataStore = window.tempFormDataStore;
var isRestoring = window.isRestoring;
var tabSubmitStatus = window.tabSubmitStatus;
var currentActiveTabId = '1';

// Force save canvas to hidden input before any form submission
document.addEventListener('DOMContentLoaded', function() {
    console.log('🔧 Setting up forced canvas save on submit');
    
    // Find all forms on the page
    const forms = document.querySelectorAll('form');
    
    forms.forEach(function(form) {
        form.addEventListener('submit', function(e) {
            console.log('📤 Form submit intercepted');
            
            const canvas = document.getElementById('drawCanvas');
            const hiddenInput = document.getElementById('keteranganGambar');
            
            if (canvas && hiddenInput) {
                try {
                    // Convert canvas to base64
                    const imageData = canvas.toDataURL('image/png');
                    hiddenInput.value = imageData;
                    console.log('✅ Canvas saved to hidden input, length:', imageData.length);
                    console.log('✅ First 100 chars:', imageData.substring(0, 100));
                } catch (error) {
                    console.error('❌ Error saving canvas:', error);
                }
            } else {
                console.error('❌ Canvas or hidden input not found');
                console.log('Canvas exists:', !!canvas);
                console.log('Hidden input exists:', !!hiddenInput);
            }
        }, false); // Use capturing phase to ensure it runs
    });
});

// Fungsi untuk mengecek apakah canvas kosong (putih semua)
function isCanvasEmpty(canvas) {
    const ctx = canvas.getContext('2d');
    const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
    const data = imageData.data;
    
    // Cek apakah semua pixel berwarna putih (255,255,255)
    for (let i = 0; i < data.length; i += 4) {
        if (data[i] !== 255 || data[i+1] !== 255 || data[i+2] !== 255) {
            return false; // Ada warna selain putih
        }
    }
    return true; // Semua putih
}

// Saat submit, hanya kirim gambar jika canvas TIDAK kosong
document.addEventListener('submit', function(e) {
    const form = e.target.closest('form');
    if (form) {
        const canvas = document.getElementById('drawCanvas');
        const hiddenInput = document.getElementById('keteranganGambar');
        
        if (canvas && hiddenInput) {
            if (!isCanvasEmpty(canvas)) {
                // Canvas berisi gambar (bukan putih)
                hiddenInput.value = canvas.toDataURL('image/png');
                console.log('💾 Canvas has content, sending image');
            } else {
                // Canvas kosong, jangan kirim apa-apa
                hiddenInput.value = '';
                console.log('💾 Canvas empty, skipping image send');
            }
        }
    }
});
</script>


    <script>
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