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
                        <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK61</p>
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
                        <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">SURFACE ROUGHNESS TESTER</p>
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
                        <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;">{{ $calibration->headSurfaceRoughnessTester->certificate_id ?? 'N/A' }}</p>
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
                                <input class="form-check-input" type="radio" name="tempat_kalibrasi" value="lab.PT PAS" id="lab" 
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
            
  <table class="kalibrasi-data-table" cellspacing="0" cellpadding="8" style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
    <!-- Header baris 1 -->
      <thead>
        <tr style="background-color: #e6e6e6;">
            <td colspan="2" style="border: 1px solid #000; padding: 10px; text-align: center; font-weight: bold;">
                Nominal Standar
            </td>
            <td rowspan="2" style="border: 1px solid #000; padding: 10px; text-align: center; font-weight: bold; vertical-align: middle;">
                Parameter
            </td>
            <td colspan="3" style="border: 1px solid #000; padding: 10px; text-align: center; font-weight: bold;">
                Penunjukan Alat (<?php echo $calibration->headSurfaceRoughnessTester->satuan_penunjukan_alat ?? 'µm'; ?>)
            </td>
            <td style="border: 1px solid #000; padding: 10px; text-align: center; font-weight: bold;">
                Cut Off
            </td>
        </tr>
        <tr style="background-color: #f5f5f5;">
            <td colspan="2" style="border: 1px solid #000; padding: 10px; text-align: center;">
                Unit (<?php echo $calibration->headSurfaceRoughnessTester->satuan_unit ?? 'µm'; ?>)
            </td>
            <td style="border: 1px solid #000; padding: 10px; text-align: center;">1</td>
            <td style="border: 1px solid #000; padding: 10px; text-align: center;">2</td>
            <td style="border: 1px solid #000; padding: 10px; text-align: center;">3</td>
            <td style="border: 1px solid #000; padding: 10px; text-align: center;">
                (<?php echo $calibration->headSurfaceRoughnessTester->satuan_cut_off ?? 'mm'; ?>)
            </td>
        </tr>
    </thead>
    
    <tbody>
    <?php 
    // Ambil semua data detail surface roughness tester untuk calibration ini
    $detailSurfaceRoughnessTesters = $calibration->detailSurfaceRoughnessTesters ?? collect();
    
    for ($i = 1; $i <= 10; $i++): 
        // Cari data berdasarkan urutan (atau jika ada relasi langsung)
        $data = isset($detailSurfaceRoughnessTesters[$i-1]) ? $detailSurfaceRoughnessTesters[$i-1] : null;
    ?>
        <tr style="height: 35px;">
            <td colspan="2" style="border: 1px solid #000; padding: 8px; text-align: center;">
                <?php 
                if ($data && !empty($data->nominalSTD)) {
                    echo htmlspecialchars($data->nominalSTD);
                } else {
                    echo '-';
                }
                ?>
            </td>
            <td style="border: 1px solid #000; padding: 8px; text-align: center;">
                <?php 
                if ($data && !empty($data->parameter)) {
                    echo htmlspecialchars($data->parameter);
                } else {
                    echo '-';
                }
                ?>
            </td>
            <td style="border: 1px solid #000; padding: 8px; text-align: center;">
                <?php 
                if ($data && !empty($data->ukurAlat1)) {
                    echo htmlspecialchars($data->ukurAlat1);
                } else {
                    echo '-';
                }
                ?>
            </td>
            <td style="border: 1px solid #000; padding: 8px; text-align: center;">
                <?php 
                if ($data && !empty($data->ukurAlat2)) {
                    echo htmlspecialchars($data->ukurAlat2);
                } else {
                    echo '-';
                }
                ?>
            </td>
            <td style="border: 1px solid #000; padding: 8px; text-align: center;">
                <?php 
                if ($data && !empty($data->ukurAlat3)) {
                    echo htmlspecialchars($data->ukurAlat3);
                } else {
                    echo '-';
                }
                ?>
            </td>
            <td style="border: 1px solid #000; padding: 8px; text-align: center;">
                <?php 
                if ($data && !empty($data->CutOff)) {
                    echo htmlspecialchars($data->CutOff);
                } else {
                    echo '-';
                }
                ?>
            </td>
        </tr>
    <?php endfor; ?>
    </tbody>
</table>

<div class="rekomendasi-cutoff" style="margin-top:15px;">
    <strong>Rekomendasi Nilai Cut Off (Sampling Length)</strong>
    <br>
        
            <img width='400' height='250' src="data:image/png;base64,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" name='Picture3' alt='1' />
         
          <span style='mso-ignore:vglayout2'>
            <table cellpadding='0' cellspacing='0'>
              <tr>
                <td colspan='2' class='x98' style='height:23.25pt;width:111.75pt;'></td>
              </tr>
            </table>
          </span>


               <table cellspacing="0" cellpadding="5" style="width:100%; border-collapse:collapse; font-size:12pt;">
    <tr>
        <td colspan="4" style="border:1px solid #000; text-align:center; font-weight:bold;">
            Isilah lembar data kalibrasi dengan lengkap dan jelas!
        </td>
    </tr>

    <tr>
        <td style="border:1px solid #000; width:20%;text-align:center;">Alat Standar</td>
        <td style="border:1px solid #000; width:30%;">
            <?php 
            // Ambil data alat standar dari head surface roughness tester
            $alatStandar = isset($calibration->headSurfaceRoughnessTester->standard) 
                ? $calibration->headSurfaceRoughnessTester->standard 
                : 'Roughness Standard Speciment';
            echo htmlspecialchars($alatStandar);
            ?>
        </td>
        <td style="border:1px solid #000; width:25%; text-align:center;">Dikalibrasi oleh</td>
        <td style="border:1px solid #000; width:25%; text-align:center;">Diperiksa oleh</td>
    </tr>

    <tr>
        <td style="border:1px solid #000;text-align:center;">Metode Kalibrasi</td>
        <td style="border:1px solid #000;">
            <?php 
            // Ambil metode kalibrasi dari head surface roughness tester
            $calibrationMethod = isset($calibration->headSurfaceRoughnessTester->calibrationMethod) 
                ? $calibration->headSurfaceRoughnessTester->calibrationMethod 
                : 'PAS-IK1102-61 (ISO 4288:1996)';
            echo htmlspecialchars($calibrationMethod);
            ?>
        </td>

        <!-- Dikalibrasi oleh -->
        <td style="border:1px solid #000; vertical-align:top;">
            TTD:<br><br><br>
            Nama: <strong><?php echo isset($calibration->calibratedBy) ? htmlspecialchars($calibration->calibratedBy) : ''; ?></strong>
        </td>

        <!-- Diperiksa oleh -->
        <td style="border:1px solid #000; vertical-align:top;">
            TTD:<br><br><br>
            Nama: <strong><?php echo isset($calibration->verifiedBy) ? htmlspecialchars($calibration->verifiedBy) : ''; ?></strong>
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