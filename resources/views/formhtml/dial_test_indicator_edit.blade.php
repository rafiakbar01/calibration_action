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
                        <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK07</p>
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
                        <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">DIAL TEST INDICATOR</p>
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
                        <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;">{{ $calibration->headDialTestIndicator->certificate_id ?? 'N/A' }}</p>
                    </td>
                </tr>
            </table>

           <table class="kalibrasi-main-table">
    <!-- Nama Alat -->
    <tr>
        <td style="width: 20%;">
            <p style="margin: 0; color: #000000;">Nama Alat</p>
        </td>
        <td colspan="3">
            <input type="text" name="namaAlat" class="kalibrasi-input"
                   value="{{ $calibration->namaAlat }}">
        </td>
    </tr>

    <!-- Merek & Kode Alat -->
    <tr>
        <td><p style="margin: 0; color: #000000;">Merek</p></td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="text" name="brandAlat" class="kalibrasi-input me-3"
                       value="{{ $calibration->brandAlat }}" style="width:60%;">
                <span class="me-3" style="color:#000;">Kode Alat :</span>
                <input type="text" name="kodeAlat" class="kalibrasi-input"
                       value="{{ $calibration->kodeAlat }}" style="width:30%;">
            </div>
        </td>
    </tr>

    <!-- Type / No. Seri -->
    <tr>
        <td><p style="margin: 0; color: #000000;">Type / No. Seri</p></td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="text" name="typeAlat" class="kalibrasi-input me-3"
                       value="{{ $calibration->typeAlat }}" style="width:45%;">
                <span class="me-3">/</span>
                <input type="text" name="NoSeri" class="kalibrasi-input"
                       value="{{ $calibration->NoSeri }}" style="width:45%;">
            </div>
        </td>
    </tr>

    <!-- Kapasitas / Resolusi -->
    <tr>
        <td><p style="margin: 0; color: #000000;">Kapasitas / Resolusi</p></td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="text" name="kapasitas" class="kalibrasi-input me-3"
                       value="{{ $calibration->kapasitas }}" style="width:45%;">
                <span class="me-3">/</span>
                <input type="text" name="resolusi" class="kalibrasi-input"
                       value="{{ $calibration->resolusi }}" style="width:45%;">
            </div>
        </td>
    </tr>

    <!-- Nama Pemilik -->
    <tr>
        <td><p style="margin: 0; color: #000000;">Nama Pemilik</p></td>
        <td colspan="3">
            <input type="text" name="pemilikAlat" class="kalibrasi-input"
                   value="{{ $calibration->pemilikAlat }}">
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
        <td><p style="margin: 0; color: #000000;">Tanggal Kalibrasi</p></td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="date" name="tanggalKalibrasi" class="kalibrasi-input me-3"
                       value="{{ $calibration->tanggalKalibrasi }}" style="width:45%;">
                <span class="me-3">Jenis Pembacaan:</span>
                <input type="text" name="jenisPembacaan" class="kalibrasi-input"
                       value="{{ $calibration->jenisPembacaan }}" style="width:45%;">
            </div>
        </td>
    </tr>

    <!-- Tempat Kalibrasi -->
    <tr>
        <td><p style="margin: 0; color: #000000;">Tempat Kalibrasi</p></td>
        <td colspan="3">
            <div class="d-flex">
                <div class="form-check me-5">
                    <input class="form-check-input" type="radio" name="tempatKalibrasi" value="lab"
                        {{ $calibration->tempatKalibrasi == 'lab' ? 'checked' : '' }}>
                    <label class="form-check-label">Lab. PT.PAS</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tempatKalibrasi" value="insitu"
                        {{ $calibration->tempatKalibrasi == 'insitu' ? 'checked' : '' }}>
                    <label class="form-check-label">Insitu</label>
                </div>
            </div>
        </td>
    </tr>

    <!-- Lokasi PT -->
    <tr>
        <td><p style="margin: 0; color: #000000;">Lokasi PT</p></td>
        <td colspan="3">
            <input type="text" name="lokasiPT" class="kalibrasi-input"
                   value="{{ $calibration->lokasiPT }}">
        </td>
    </tr>
</table>


           <div class="row mt-4">
    <!-- Fungsi Komponen Lainnya -->
    <div class="col-md-6 mb-4">
        <div class="kalibrasi-section-header" style="color: #000000;">
            Fungsi Komponen Lainnya
        </div>

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
                <input type="text" name="keterangan" class="kalibrasi-input"
                       value="{{ $calibration->keterangan }}"
                       style="border:none;border-bottom:2px solid #000;border-radius:0;padding:4px 0;background:transparent;width:100%;">
            </div>
        </div>
    </div>

    <!-- Kondisi Kalibrasi -->
    <div class="col-md-6 mb-4">
        <div class="kalibrasi-section-header" style="color:#000;">
            Kondisi Kalibrasi
        </div>

        <table class="table table-bordered">
            <tr>
                <td class="table-secondary fw-bold" style="width:30%;"></td>
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


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Kalibrasi - PT. PANANJUNG ANUGRAH SOLUTION</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    /* ... (CSS styles tetap sama seperti sebelumnya) ... */
    </style>
</head>
<body>
    <div class="container my-4">
        <div class="form-kalibrasi-container">
            <!-- ... (Header dan Main Form Section tetap sama) ... -->

      <!-- Data Kalibrasi Section -->
<div class="data-kalibrasi-header" style="color: #000000;">DATA KALIBRASI</div>

<div class="d-flex justify-content-between gap-4">
    @php
        $is001 = ($calibration->resolusi ?? '') === '0.001';
        $detailData = $calibration->detailDialTestIndicators ?? collect();
        
        // Tentukan judul berdasarkan resolusi
        $judulKiri = $is001 ? '0 - 0.19 mm' : '0 - 1.9 mm';
        $judulKanan = $is001 ? '0.20 - 1.00 mm' : '2 - 50 mm';
        
        // Pisahkan data berdasarkan index
        $dataKiri = [];
        $dataKanan = [];
        
        foreach ($detailData as $index => $detail) {
            if ($index < 20) {
                $dataKiri[] = $detail;
            } else {
                $dataKanan[] = $detail;
            }
        }
        
        // Untuk memastikan ada cukup baris, tambahkan data kosong jika kurang
        while (count($dataKiri) < 20) {
            $dataKiri[] = null;
        }
        while (count($dataKanan) < 19) {
            $dataKanan[] = null;
        }
    @endphp

    <!-- Tabel Kiri -->
    <div style="flex:1;">
        <div class="text-center mb-2">
            
        </div>
        <table class="kalibrasi-data-table">
            <tr style="background:#d9d9d9;">
                <td style="border:2px solid #000;padding:8px;text-align:center;width:40%;">
                    <strong>Penunjukan Alat (mm)</strong>
                </td>
                <td colspan="2" style="border:2px solid #000;padding:8px;text-align:center;width:60%;">
                    <strong>Pembacaan Standard (mm)</strong>
                </td>
            </tr>
            <tr style="background:#e8e8e8;">
                <td></td>
                <td style="border:2px solid #000;padding:8px;text-align:center;">
                    <strong>Naik</strong>
                </td>
                <td style="border:2px solid #000;padding:8px;text-align:center;">
                    <strong>Turun</strong>
                </td>
            </tr>
            @foreach($dataKiri as $detail)
               <tr>
    <td style="height:32px; background-color: #f8f9fa;">
        <input type="text"
               name="titikUkur[]"
               value="{{ $detail->titikUkur ?? '' }}"
               style="width:100%;height:100%;border:none;text-align:center;background:transparent;font-weight:bold;">
    </td>
    <td style="height:32px;">
        <input type="text"
               name="ulanganNaik[]"
               value="{{ $detail->ulanganNaik ?? '' }}"
               style="width:100%;height:100%;border:none;text-align:center;background:transparent;">
    </td>
    <td style="height:32px;">
        <input type="text"
               name="ulanganTurun[]"
               value="{{ $detail->ulanganTurun ?? '' }}"
               style="width:100%;height:100%;border:none;text-align:center;background:transparent;">
    </td>
</tr>

            @endforeach
        </table>
    </div>

    <!-- Tabel Kanan -->
    <div style="flex:1;">
        <div class="text-center mb-2">
          
        </div>
        <table class="kalibrasi-data-table">
            <tr style="background:#d9d9d9;">
                <td style="border:2px solid #000;padding:8px;text-align:center;width:40%;">
                    <strong>Penunjukan Alat (mm)</strong>
                </td>
                <td colspan="2" style="border:2px solid #000;padding:8px;text-align:center;width:60%;">
                    <strong>Pembacaan Standard (mm)</strong>
                </td>
            </tr>
            <tr style="background:#e8e8e8;">
                <td></td>
                <td style="border:2px solid #000;padding:8px;text-align:center;">
                    <strong>Naik</strong>
                </td>
                <td style="border:2px solid #000;padding:8px;text-align:center;">
                    <strong>Turun</strong>
                </td>
            </tr>
            @foreach($dataKanan as $detail)
               <tr>
    <td style="height:32px; background-color: #f8f9fa;">
        <input type="text"
               name="titikUkur[]"
               value="{{ $detail->titikUkur ?? '' }}"
               style="width:100%;height:100%;border:none;text-align:center;background:transparent;font-weight:bold;">
    </td>
    <td style="height:32px;">
        <input type="text"
               name="ulanganNaik[]"
               value="{{ $detail->ulanganNaik ?? '' }}"
               style="width:100%;height:100%;border:none;text-align:center;background:transparent;">
    </td>
    <td style="height:32px;">
        <input type="text"
               name="ulanganTurun[]"
               value="{{ $detail->ulanganTurun ?? '' }}"
               style="width:100%;height:100%;border:none;text-align:center;background:transparent;">
    </td>
</tr>

            @endforeach
        </table>
    </div>
</div>
               

            <!-- Repeatability Section -->
        <p class="medium-text" style="margin-top:5.1pt; margin-left:10.2pt; margin-bottom:1.05pt; font-size: 10pt;">
                <span class="letter-spacing-neg-01">Repeatability</span>
                <span class="letter-spacing-06"></span>
                <span class="letter-spacing-neg-05">:</span>
                <span style="margin-left:10px;">
                    <input type="text" name="repeatability" 
                        value="{{ old('repeatability', $calibration->addDialTestIndicator->repeatability ?? '') }}"
                        style="border:none; border-bottom:1px solid #000; width:80px; text-align:center; font-size:10pt; background:transparent;"
                        placeholder="0.000">
                    <!-- HAPUS oninput tersebut! -->
                </span>
            </p>

            <table class="repeatability-table" style="width: 100%; border-collapse: collapse;">
                <!-- Baris 1 -->
               <tr style="height: 20pt;">
    <td style="width: 49.05pt; border: 1px solid #000;">
        <input type="number" step="any" name="ulangan01"
               value="{{ $calibration->addDialTestIndicator->ulangan01 ?? '' }}"
               style="width:100%;height:100%;border:none;text-align:center;font-size:10pt;background:transparent;">
    </td>
    <td style="width: 51.2pt; border: 1px solid #000;">
        <input type="number" step="any" name="ulangan02"
               value="{{ $calibration->addDialTestIndicator->ulangan02 ?? '' }}"
               style="width:100%;height:100%;border:none;text-align:center;font-size:10pt;background:transparent;">
    </td>
    <td style="width: 51.2pt; border: 1px solid #000;">
        <input type="number" step="any" name="ulangan03"
               value="{{ $calibration->addDialTestIndicator->ulangan03 ?? '' }}"
               style="width:100%;height:100%;border:none;text-align:center;font-size:10pt;background:transparent;">
    </td>
    <td style="width: 57.05pt; border: 1px solid #000;">
        <input type="number" step="any" name="ulangan04"
               value="{{ $calibration->addDialTestIndicator->ulangan04 ?? '' }}"
               style="width:100%;height:100%;border:none;text-align:center;font-size:10pt;background:transparent;">
    </td>
    <td style="width: 57.05pt; border: 1px solid #000;">
        <input type="number" step="any" name="ulangan05"
               value="{{ $calibration->addDialTestIndicator->ulangan05 ?? '' }}"
               style="width:100%;height:100%;border:none;text-align:center;font-size:10pt;background:transparent;">
    </td>
</tr>

                
                <!-- Baris 2 -->
               <tr style="height: 20pt;">
    <td style="width: 49.05pt; border: 1px solid #000;">
        <input type="number" step="any" name="ulangan06"
               value="{{ $calibration->addDialTestIndicator->ulangan06 ?? '' }}"
               style="width:100%;height:100%;border:none;text-align:center;font-size:10pt;background:transparent;">
    </td>
    <td style="width: 51.2pt; border: 1px solid #000;">
        <input type="number" step="any" name="ulangan07"
               value="{{ $calibration->addDialTestIndicator->ulangan07 ?? '' }}"
               style="width:100%;height:100%;border:none;text-align:center;font-size:10pt;background:transparent;">
    </td>
    <td style="width: 51.2pt; border: 1px solid #000;">
        <input type="number" step="any" name="ulangan08"
               value="{{ $calibration->addDialTestIndicator->ulangan08 ?? '' }}"
               style="width:100%;height:100%;border:none;text-align:center;font-size:10pt;background:transparent;">
    </td>
    <td style="width: 57.05pt; border: 1px solid #000;">
        <input type="number" step="any" name="ulangan09"
               value="{{ $calibration->addDialTestIndicator->ulangan09 ?? '' }}"
               style="width:100%;height:100%;border:none;text-align:center;font-size:10pt;background:transparent;">
    </td>
    <td style="width: 57.05pt; border: 1px solid #000;">
        <input type="number" step="any" name="ulangan10"
               value="{{ $calibration->addDialTestIndicator->ulangan10 ?? '' }}"
               style="width:100%;height:100%;border:none;text-align:center;font-size:10pt;background:transparent;">
    </td>
</tr>


                <!-- ALAT STANDAR – DINAMIS SESUAI RESOLUSI -->
              <tr style="height:18pt;">
    <td colspan="2" rowspan="3" style="width:101.25pt;border:1px solid #000;vertical-align:top;">
        <p style="margin-top:8pt;font-size:10pt;">&nbsp;</p>
        <p style="margin-left:28.05pt;font-size:10pt;">
            <span>Alat</span><span style="letter-spacing:-0.1pt;"> Standar</span>
        </p>
    </td>

    <!-- Baris 1: Calibration Tester 0 ~ 1 mm -->
    <td style="width:3.62pt;border:1px solid #000;text-align:center;vertical-align:middle;">
        @php
            // Parse data dari string yang dipisahkan koma
            $standardArray = [];
            if (!empty($calibration->headDialTestIndicator->standard)) {
                $standardArray = explode(',', $calibration->headDialTestIndicator->standard);
                $standardArray = array_map('trim', $standardArray);
            }

            // Cek apakah ada "Calibration Tester 0 ~ 1 mm"
            $isChecked = false;
            foreach ($standardArray as $alat) {
                if (str_contains(strtolower($alat), 'calibration tester 0 ~ 1 mm')) {
                    $isChecked = true;
                    break;
                }
            }
        @endphp
        <input type="checkbox" 
               name="alat_standar[]" 
               value="Calibration Tester 0 ~ 1 mm"
               class="alat-standar-checkbox"
               {{ $isChecked ? 'checked' : '' }}>
    </td>
    <td colspan="3" style="width:151.93pt;border:1px solid #000;vertical-align:middle;">
        <p style="margin:3pt 0 0 10.4pt;font-size:9.5pt;">
            Calibration Tester 0 ~ 1 mm
        </p>
    </td>
    <td style="width:115.15pt;border:1px solid #000;vertical-align:top;">
        <p style="margin:1.8pt 0 0 29.55pt;font-size:10pt;">
            <span>Dikalibrasi</span><span style="letter-spacing:-0.2pt;"> oleh</span>
        </p>
    </td>
    <td style="width:113.9pt;border:1px solid #000;vertical-align:top;">
        <p style="margin:1.8pt 0 0 30.9pt;font-size:10pt;">
            <span>Diperiksa</span><span style="letter-spacing:-0.2pt;"> oleh</span>
        </p>
    </td>
</tr>

<!-- Baris 2: Calibration Tester 0 ~ 25 mm -->
<tr style="height:18pt;">
    <td style="width:3.62pt;border:1px solid #000;text-align:center;vertical-align:middle;">
        @php
            $standardArray = [];
            if (!empty($calibration->headDialTestIndicator->standard)) {
                $standardArray = explode(',', $calibration->headDialTestIndicator->standard);
                $standardArray = array_map('trim', $standardArray);
            }

            // Cek apakah ada "Calibration Tester 0 ~ 25 mm"
            $isChecked = false;
            foreach ($standardArray as $alat) {
                if (str_contains(strtolower($alat), 'calibration tester 0 ~ 25 mm')) {
                    $isChecked = true;
                    break;
                }
            }
        @endphp
        <input type="checkbox"
               name="alat_standar[]"
               value="Calibration Tester 0 ~ 25 mm"
               class="alat-standar-checkbox"
               {{ $isChecked ? 'checked' : '' }}>
    </td>
    <td colspan="3" style="width:151.93pt;border:1px solid #000;vertical-align:middle;">
        <p style="margin:3pt 0 0 10.4pt;font-size:9.5pt;">
            Calibration Tester 0 ~ 25 mm
        </p>
    </td>
    <td rowspan="3" style="width:115.15pt;border:1px solid #000;vertical-align:top;">
        <p style="margin-top:8pt;font-size:10pt;">&nbsp;</p>
        <p style="margin-left:1.6pt;font-size:10pt;">TTD :</p>
        <p style="margin-top:2.3pt;font-size:10pt;">&nbsp;</p>
        <div style="display:flex;align-items:center;margin-left:1.6pt;">
            <span style="font-size:10pt;white-space:nowrap;">Nama :</span>
            <input type="text" 
                   name="calibratedBy"
                   value="{{ old('calibratedBy', $calibration->calibratedBy) }}" 
                   style="flex:1;border:none;border-bottom:1px solid #000;margin-left:6px;font-size:9pt;background:transparent;">
        </div>
    </td>
    <td rowspan="3" style="width:113.9pt;border:1px solid #000;vertical-align:top;">
        <p style="margin-top:8pt;font-size:10pt;">&nbsp;</p>
        <p style="margin-left:1.65pt;font-size:10pt;">TTD :</p>
        <p style="margin-top:2.3pt;font-size:10pt;">&nbsp;</p>
        <div style="display:flex;align-items:center;margin-left:1.65pt;">
            <span style="font-size:10pt;white-space:nowrap;">Nama :</span>
            <input type="text" 
                   name="verifiedBy"
                   value="{{ old('verifiedBy', $calibration->verifiedBy) }}" 
                   style="flex:1;border:none;border-bottom:1px solid #000;margin-left:6px;font-size:9pt;background:transparent;">
        </div>
    </td>
</tr>

<!-- Baris 3: Alat Standar Lainnya (Input Manual) -->
<tr style="height:15pt;">
    <td style="width:3.62pt;border:1px solid #000;text-align:center;vertical-align:middle;">
        @php
            $standardArray = [];
            if (!empty($calibration->headDialTestIndicator->standard)) {
                $standardArray = explode(',', $calibration->headDialTestIndicator->standard);
                $standardArray = array_map('trim', $standardArray);
            }

            // Filter untuk menghapus alat standar yang sudah diketahui
            $filteredArray = array_filter($standardArray, function($alat) {
                $lowerAlat = strtolower($alat);
                $knownTools = [
                    'calibration tester 0 ~ 1 mm',
                    'calibration tester 0 ~ 25 mm'
                ];
                
                foreach ($knownTools as $tool) {
                    if (str_contains($lowerAlat, $tool)) {
                        return false;
                    }
                }
                return true;
            });

            $isChecked = !empty($filteredArray);
        @endphp
        <input type="checkbox"
               name="alat_standar[]"
               value="alat_standar_lainnya"
               class="alat-standar-checkbox"
               {{ $isChecked ? 'checked' : '' }}>
    </td>
    <td colspan="3" style="width:151.93pt;border:1px solid #000;vertical-align:middle;">
        @php
            $alatStandarLainnya = '';
            if (!empty($filteredArray)) {
                $alatStandarLainnya = implode(', ', $filteredArray);
            }
        @endphp
        <input type="text"
               name="alat_standar_tambahan"
               value="{{ old('alat_standar_tambahan', $alatStandarLainnya) }}"
               placeholder="........................................."
               style="width:95%;border:none;font-size:9pt;padding:2px;background:transparent;">
    </td>
</tr>

<!-- Baris 6: Metode Kalibrasi -->
<tr style="height: 22pt;">
    <td colspan="2" style="width: 101.25pt; border: 1px solid #000;">
        <p style="margin-top: 5.75pt; margin-left: 19.75pt; font-size: 10pt;">
            <span>Metode</span>
            <span class="letter-spacing-neg-05"></span>
            <span class="letter-spacing-neg-01">Kalibrasi</span>
        </p>
    </td>
    <td colspan="5" style="width: 173.2pt; border: 1px solid #000;">
        <p style="margin-top: 0.8pt; margin-left: 8.95pt; line-height: 11pt; font-size: 9.5pt;">
            <span>PAS-IK1102-07 (JIS B 7533:2015)</span>
        </p>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
// HAPUS SEMUA SCRIPT LAMA, ganti dengan ini:
document.addEventListener('DOMContentLoaded', function() {
    const editForm = document.getElementById('editForm');
    if (!editForm) return;
    
    console.log('🔧 Form loaded, checking JavaScript...');
    
    // 1. LOG SEMUA FIELD YANG ADA DI FORM
    console.log('📋 Listing all form fields:');
    const allFields = editForm.querySelectorAll('input, select, textarea');
    allFields.forEach(field => {
        // Log field-field penting
        const fieldNames = ['repeatability', 'ulangan0', 'calibrated', 'verified', 'titikUkur'];
        const shouldLog = fieldNames.some(name => field.name && field.name.includes(name));
        
        if (shouldLog && field.name) {
            console.log(`🔍 Field: ${field.name} =`, field.value);
        }
    });
    
    // 2. SIMPLE SUBMIT HANDLER - TANPA BLOCKING VALIDATION
    editForm.addEventListener('submit', function(e) {
        console.log('🚀 Form submit event triggered');
        
        // HANYA LOGGING, TIDAK ADA PREVENT DEFAULT!
        
        // Debug: Tampilkan nilai sebelum submit
        console.log('📤 Checking field values before submit:');
        
        // Check repeatability
        const repeatInput = this.querySelector('[name="repeatability"]');
        console.log('🔢 repeatability:', repeatInput ? repeatInput.value : 'NOT FOUND');
        
        // Check ulangan fields
        for (let i = 1; i <= 10; i++) {
            const fieldName = i < 10 ? 'ulangan0' + i : 'ulangan' + i;
            const field = this.querySelector(`[name="${fieldName}"]`);
            if (field) {
                console.log(`🔢 ${fieldName}:`, field.value);
            }
        }
        
        // Check alat standar
        const alatStandarChecked = this.querySelectorAll('.alat-standar-checkbox:checked');
        console.log('✅ Alat standar checked:', alatStandarChecked.length);
        
        // Check calibratedBy dan verifiedBy
        const calibratedBy = this.querySelector('[name="calibratedBy"]');
        const verifiedBy = this.querySelector('[name="verifiedBy"]');
        console.log('🖋️ calibratedBy:', calibratedBy ? calibratedBy.value : 'NOT FOUND');
        console.log('🖋️ verifiedBy:', verifiedBy ? verifiedBy.value : 'NOT FOUND');
        
        // 3. TAMPILKAN LOADING, TAPI JANGAN CANCEL SUBMIT
        const submitBtn = this.querySelector('button[type="submit"]');
        if (submitBtn) {
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
            submitBtn.disabled = true;
            
            // Auto reset setelah 30 detik jika stuck
            setTimeout(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 30000);
        }
        
        // 4. LANGSUNG SUBMIT - TIDAK ADA VALIDASI YANG MEMBLOKIR
        console.log('✅ Allowing form submission...');
        return true;
    });
    
    // 5. REAL-TIME DEBUGGING: Log ketika field berubah
    editForm.querySelectorAll('input').forEach(input => {
        // Hanya monitor field-field penting
        if (input.name && (
            input.name.includes('repeatability') || 
            input.name.includes('ulangan') ||
            input.name.includes('calibrated') ||
            input.name.includes('verified')
        )) {
            input.addEventListener('change', function() {
                console.log(`🔄 Field ${this.name} changed to:`, this.value);
            });
            
            input.addEventListener('blur', function() {
                console.log(`📝 Field ${this.name} on blur:`, this.value);
            });
        }
    });
});

// TAMBAHKAN INI UNTUK CATCH SEMUA JS ERRORS
window.addEventListener('error', function(e) {
    console.error('❌ JavaScript Error:', e.message);
    // JANGAN lakukan apa-apa, biarkan form submit
});
</script>
</body>
</html>