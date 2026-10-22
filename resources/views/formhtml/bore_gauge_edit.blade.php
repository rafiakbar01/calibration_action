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
                        <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK58</p>
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
                        <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">BORE GAUGE</p>
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
                        <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;">{{ $calibration->headBoreGauge->certificate_id ?? 'N/A' }}</p>
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

              <!-- Merek & Kode Alat -->
    <tr>
        <td><p class="mb-0 text-dark">Merek</p></td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="text" class="kalibrasi-input me-3" name="brandAlat"
                       value="{{ old('brandAlat',$calibration->brandAlat) }}" style="width:60%;">
                <span class="me-3">Kode Alat :</span>
                <input type="text" class="kalibrasi-input" name="kodeAlat"
                       value="{{ old('kodeAlat',$calibration->kodeAlat) }}" style="width:30%;">
            </div>
        </td>
    </tr>

    <!-- Type / No Seri -->
    <tr>
        <td><p class="mb-0 text-dark">Type / No. Seri</p></td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="text" class="kalibrasi-input me-3" name="typeAlat"
                       value="{{ old('typeAlat',$calibration->typeAlat) }}" style="width:45%;">
                <span class="me-3">/</span>
                <input type="text" class="kalibrasi-input" name="NoSeri"
                       value="{{ old('NoSeri',$calibration->NoSeri) }}" style="width:45%;">
            </div>
        </td>
    </tr>

    <!-- Rentang -->
    <!--<tr>-->
    <!--    <td><p class="mb-0 text-dark">Rentang Ukur</p></td>-->
    <!--    <td colspan="3">-->
    <!--        <div class="d-flex align-items-center">-->
    <!--            <input type="text" class="kalibrasi-input me-3" name="rangeMin"-->
    <!--                   value="{{ old('rangeMin',$calibration->rangeMin) }}" style="width:45%;">-->
    <!--            <span class="me-3">-</span>-->
    <!--            <input type="text" class="kalibrasi-input" name="rangeMax"-->
    <!--                   value="{{ old('rangeMax',$calibration->rangeMax) }}" style="width:45%;">-->
    <!--        </div>-->
    <!--    </td>-->
    <!--</tr>-->

    <!-- Kapasitas / Resolusi -->
    <tr>
        <td><p class="mb-0 text-dark">Kapasitas / Resolusi</p></td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="text" class="kalibrasi-input me-3" name="kapasitas"
                       value="{{ old('kapasitas',$calibration->kapasitas) }}" style="width:45%;">
                <span class="me-3">/</span>
                <input type="text" class="kalibrasi-input" name="resolusi"
                       value="{{ old('resolusi',$calibration->resolusi) }}" style="width:45%;">
            </div>
        </td>
    </tr>

    <!-- Pemilik -->
    <tr>
        <td><p class="mb-0 text-dark">Nama Pemilik</p></td>
        <td colspan="3">
            <input type="text" class="kalibrasi-input" name="pemilikAlat"
                   value="{{ old('pemilikAlat',$calibration->pemilikAlat) }}">
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
        <td><p class="mb-0 text-dark">Tanggal Kalibrasi</p></td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="date" class="kalibrasi-input me-3" name="tanggalKalibrasi"
                       value="{{ old('tanggalKalibrasi',$calibration->tanggalKalibrasi) }}" style="width:45%;">
                <span class="me-3">Jenis Pembacaan:</span>
                <input type="text" class="kalibrasi-input" name="jenisPembacaan"
                       value="{{ old('jenisPembacaan',$calibration->jenisPembacaan) }}" style="width:45%;">
            </div>
        </td>
    </tr>

    <!-- Tempat -->
    <tr>
        <td><p class="mb-0 text-dark">Tempat Kalibrasi</p></td>
        <td colspan="3">
            <div class="d-flex">
                <div class="form-check me-5">
                    <input class="form-check-input" type="radio" name="tempatKalibrasi" value="lab.PT PAS"
                        {{ old('tempatKalibrasi',$calibration->tempatKalibrasi) == 'lab.PT PAS' ? 'checked' : '' }}>
                    <label class="form-check-label">Lab. PT PAS</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tempatKalibrasi" value="insitu"
                        {{ old('tempatKalibrasi',$calibration->tempatKalibrasi) == 'insitu' ? 'checked' : '' }}>
                    <label class="form-check-label">Insitu</label>
                </div>
            </div>
        </td>
    </tr>

    <!-- Lokasi -->
    <tr>
        <td><p class="mb-0 text-dark">Lokasi PT</p></td>
        <td colspan="3">
            <input type="text" class="kalibrasi-input" name="lokasiPT"
                   value="{{ old('lokasiPT',$calibration->lokasiPT) }}">
        </td>
    </tr>
</table>


           <div class="row mt-4">

    <!-- KIRI: Fungsi Komponen Lainnya -->
    <div class="col-md-6 mb-4">
        <div class="kalibrasi-section-header" style="color:#000000;">
            Fungsi Komponen Lainnya
        </div>

        <div class="d-flex justify-content-center align-items-center mb-4" style="gap:60px;">
            <div class="text-center">
                <span class="fw-bold d-block mb-2" style="color:#000; font-size:14px;">Ok</span>
                <input type="radio" name="kondisiAlat" value="ok"
                    class="form-check-input"
                    {{ old('kondisiAlat', $calibration->kondisiAlat) == 'ok' ? 'checked' : '' }}>
            </div>

            <div class="text-center">
                <span class="fw-bold d-block mb-2" style="color:#000; font-size:14px;">Rusak</span>
                <input type="radio" name="kondisiAlat" value="rusak"
                    class="form-check-input"
                    {{ old('kondisiAlat', $calibration->kondisiAlat) == 'rusak' ? 'checked' : '' }}>
            </div>
        </div>

        <div class="d-flex align-items-center">
            <span class="fw-bold me-3" style="color:#000; min-width:100px;">Keterangan :</span>
            <div style="flex:1;">
                <input type="text" name="keterangan" class="kalibrasi-input"
                    value="{{ old('keterangan', $calibration->keterangan) }}"
                    style="border:none; border-bottom:2px solid #000; background:transparent; width:100%;">
            </div>
        </div>
    </div>


    <!-- KANAN: Kondisi Kalibrasi -->
    <div class="col-md-6 mb-4">
        <div class="kalibrasi-section-header" style="color:#000000;">
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
                <td><input type="text" name="RT_condition1" class="kondisi-input" value="{{ old('RT_condition1', $calibration->RT_condition1) }}"></td>
                <td><input type="text" name="RT_condition2" class="kondisi-input" value="{{ old('RT_condition2', $calibration->RT_condition2) }}"></td>
                <td><input type="text" name="RT_condition3" class="kondisi-input" value="{{ old('RT_condition3', $calibration->RT_condition3) }}"></td>
            </tr>
            <tr>
                <td class="bg-light fw-bold">RH (%)</td>
                <td><input type="text" name="RH_condition1" class="kondisi-input" value="{{ old('RH_condition1', $calibration->RH_condition1) }}"></td>
                <td><input type="text" name="RH_condition2" class="kondisi-input" value="{{ old('RH_condition2', $calibration->RH_condition2) }}"></td>
                <td><input type="text" name="RH_condition3" class="kondisi-input" value="{{ old('RH_condition3', $calibration->RH_condition3) }}"></td>
            </tr>
        </table>
    </div>

</div>
<style>
/* Kalibrasi Data Table - Versi Rapi & Bersih */
.kalibrasi-data-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 11pt;
    font-family: Arial, Helvetica, sans-serif;
    table-layout: fixed;
}

.kalibrasi-data-table th,
.kalibrasi-data-table td {
    border: 1px solid #000;
    padding: 8px 6px;
    text-align: center;
    vertical-align: middle;
}

.kalibrasi-data-table thead th {
    background-color: #d9d9d9;
    font-weight: bold;
    border: 2px solid #000;
}

.kalibrasi-data-table .sub-header th {
    background-color: #e8e8e8;
    font-weight: 600;
    border: 2px solid #000;
}

.kalibrasi-data-table .penunjukan-input input[type="text"] {
    width: 100%;
    height: 32px;
    border: none;
    background: transparent;
    text-align: center;
    font-size: 11pt;
    padding: 2px;
    box-sizing: border-box;
}

.kalibrasi-data-table input[type="text"]:focus {
    outline: none;
    background-color: rgba(74, 144, 226, 0.08);
}

.kalibrasi-data-table input[type="text"] {
    width: 100%;
    border: none;
    background: transparent;
    text-align: center;
    font-size: 11pt;
}

.kalibrasi-wrapper {
    display: flex;
    gap: 24px;
    margin-top: 16px;
}

.kalibrasi-wrapper > div {
    flex: 1;
    min-width: 0;
}

@media (max-width: 992px) {
    .kalibrasi-wrapper {
        flex-direction: column;
        gap: 32px;
    }
}
</style>



<!-- HIDDEN INPUT SKALA -->
<style>
/* Kalibrasi Data Table - Versi Rapi & Bersih */
.kalibrasi-data-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 11pt;
    font-family: Arial, Helvetica, sans-serif;
    table-layout: fixed;
}

.kalibrasi-data-table th,
.kalibrasi-data-table td {
    border: 1px solid #000;
    padding: 8px 6px;
    text-align: center;
    vertical-align: middle;
}

.kalibrasi-data-table thead th {
    background-color: #d9d9d9;
    font-weight: bold;
    border: 2px solid #000;
}

.kalibrasi-data-table .sub-header th {
    background-color: #e8e8e8;
    font-weight: 600;
    border: 2px solid #000;
}

.kalibrasi-data-table .penunjukan-input input[type="text"] {
    width: 100%;
    height: 32px;
    border: none;
    background: transparent;
    text-align: center;
    font-size: 11pt;
    padding: 2px;
    box-sizing: border-box;
}

.kalibrasi-data-table input[type="text"]:focus {
    outline: none;
    background-color: rgba(74, 144, 226, 0.08);
}

.kalibrasi-data-table input[type="text"] {
    width: 100%;
    border: none;
    background: transparent;
    text-align: center;
    font-size: 11pt;
}

.kalibrasi-wrapper {
    display: flex;
    gap: 24px;
    margin-top: 16px;
}

.kalibrasi-wrapper > div {
    flex: 1;
    min-width: 0;
}

@media (max-width: 992px) {
    .kalibrasi-wrapper {
        flex-direction: column;
        gap: 32px;
    }
}
</style>
          <div class="kalibrasi-wrapper">
    <!-- Tabel Kiri: 20 baris pertama -->
    <div>
        <table class="kalibrasi-data-table">
            <thead>
                 <tr>
                    <th colspan="3">Uji Skala Nominal (Bagian Bawah)</th>
                 </tr>
                <tr class="sub-header">
                      <th>
                        Penunjukan Alat 
                        ({{ $calibration->headBoreGauge->satuan_unit_bawah ?? '' }})
                    </th>
                    <th>Pembacaan Standard - Naik</th>
                    <th>Pembacaan Standard - Turun</th>
                 </tr>
            </thead>
            <tbody>
                @php
                    // Ambil data detailBoreGauge dan urutkan berdasarkan ID dari terkecil
                    $details = $calibration->detailBoreGauges ?? collect([]);
                    $details = $details->sortBy('id')->values(); // sort by ID ascending and reset keys
                @endphp

                @for($i = 0; $i < 20; $i++)
                    @php
                        // Ambil data dari index ke-$i
                        $detail = $details->get($i);
                        
                        // Default value untuk penunjukan alat (0.0, 0.1, 0.2, ... 1.9)
                        $defaultValue = ($i <= 10) ? number_format($i * 0.1, 1) : '';
                        
                        // Nilai dari database atau default
                        $penunjukanValue = $detail->penunjukAlat ?? $defaultValue;
                        $naikValue = $detail->std_naik ?? '';
                        $turunValue = $detail->std_turun ?? '';
                        
                        // Format angka
                        if (is_numeric($penunjukanValue)) {
                            $penunjukanValue = rtrim(rtrim(number_format($penunjukanValue, 5), '0'), '.');
                        }
                        if (is_numeric($naikValue)) {
                            $naikValue = rtrim(rtrim(number_format($naikValue, 5), '0'), '.');
                        }
                        if (is_numeric($turunValue)) {
                            $turunValue = rtrim(rtrim(number_format($turunValue, 5), '0'), '.');
                        }
                    @endphp
                    <tr>
                      <td class="penunjukan-input">
                        <input type="text" 
                               name="penunjukanAlat[]"
                               value="{{ $penunjukanValue }}"
                               style="font-weight: {{ $i <= 10 ? '500' : 'normal' }}; 
                                      background-color: transparent; 
                                      cursor: text;">
                      </td>
                      <td>
                        <input type="text" 
                               name="pembacaanNaik[]"
                               value="{{ $naikValue }}"
                               style="background-color: transparent; 
                                      cursor: text;">
                      </td>
                      <td>
                        <input type="text" 
                               name="pembacaanTurun[]"
                               value="{{ $turunValue }}"
                               style="background-color: transparent; 
                                      cursor: text;">
                      </td>
                    </tr>
                @endfor
            </tbody>
         </table>
    </div>

    <!-- Tabel Kanan: 20 baris sisanya (index 20-39) -->
    <div>
        <table class="kalibrasi-data-table">
            <thead>
                 <tr>
                    <th colspan="3">Uji Skala Nominal (Bagian Atas / Lanjutan)</th>
                 </tr>
                <tr class="sub-header">
                    <th>
                        Penunjukan Alat 
                        ({{ $calibration->headBoreGauge->satuan_unit_atas ?? '' }})
                    </th>
                    <th>Pembacaan Standard - Naik</th>
                    <th>Pembacaan Standard - Turun</th>
                 </tr>
            </thead>
            <tbody>
                @for($i = 20; $i < 40; $i++)
                    @php
                        // Ambil data dari index ke-$i
                        $detail = $details->get($i);
                        
                        // Nilai dari database atau kosong
                        $penunjukanValue = $detail->penunjukAlat ?? '';
                        $naikValue = $detail->std_naik ?? '';
                        $turunValue = $detail->std_turun ?? '';
                        
                        // Format angka
                        if (is_numeric($penunjukanValue)) {
                            $penunjukanValue = rtrim(rtrim(number_format($penunjukanValue, 5), '0'), '.');
                        }
                        if (is_numeric($naikValue)) {
                            $naikValue = rtrim(rtrim(number_format($naikValue, 5), '0'), '.');
                        }
                        if (is_numeric($turunValue)) {
                            $turunValue = rtrim(rtrim(number_format($turunValue, 5), '0'), '.');
                        }
                    @endphp
                    <tr>
                       <td class="penunjukan-input">
                        <input type="text" 
                               name="penunjukanAlat[]"
                               value="{{ $penunjukanValue }}"
                               style="background-color: transparent; cursor: text;">
                      </td>
                      <td>
                        <input type="text" 
                               name="pembacaanNaik[]"
                               value="{{ $naikValue }}"
                               style="background-color: transparent; cursor: text;">
                      </td>
                      <td>
                        <input type="text" 
                               name="pembacaanTurun[]"
                               value="{{ $turunValue }}"
                               style="background-color: transparent; cursor: text;">
                      </td>
                    </tr>
                @endfor
            </tbody>
         </table>
    </div>
</div>
<!-- Tabel Repeatability - EDIT DATA (Versi Looping) -->
<style>
/* Style sama persis dengan input */
.repeatability-section {
    margin: 12px 0 20px 0;
}

.repeatability-title {
    font-size: 10pt;
    font-weight: 600;
    margin: 0 0 6px 12px;
}

.repeatability-table {
    width: 100%;
    max-width: 380px;
    border-collapse: collapse;
    font-size: 9pt;
    font-family: Arial, Helvetica, sans-serif;
}

.repeatability-table td {
    border: 1px solid #000;
    padding: 3px 4px;
    height: 18pt;
    text-align: center;
    vertical-align: middle;
}

.repeatability-table input[type="number"] {
    width: 100%;
    height: 100%;
    border: none;
    background: transparent;
    text-align: center;
    font-size: 9pt;
    padding: 1px;
    box-sizing: border-box;
}

.repeatability-table input[type="number"]:focus {
    outline: none;
    background-color: rgba(74, 144, 226, 0.08);
}

.repeatability-table input[type="number"]::-webkit-inner-spin-button,
.repeatability-table input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.repeatability-table input[type="number"] {
    -moz-appearance: textfield;
}
</style>

<div class="repeatability-section">
    <p class="repeatability-title" style="display: inline-block; margin-right: 10px;">Repeatability :</p>
    
    @php
        // Ambil data repeatability - menggunakan relasi yang sama dengan view (singular)
        $repeat = $calibration->addBoreGauge ?? null;
    @endphp

    <input type="text" 
           name="repeatability" 
           value="{{ $repeat->repeatability ?? '' }}"
           placeholder="-"
           style="width: 100px; border: 1px solid #ccc; display: inline-block; text-align: center; padding: 4px 8px; background-color: transparent; cursor: text;">

    <table class="repeatability-table" style="margin-top: 10px; border-collapse: collapse;">
         <tr>
            <td style="border: 1px solid #000; padding: 4px 6px; text-align: center;">
                <input type="text" 
                       name="rep01" 
                       value="{{ $repeat->rep01 ?? '' }}"
                       placeholder="-"
                       style="width: 80px; border: none; text-align: center; background-color: transparent; cursor: text;">
             </td>
            <td style="border: 1px solid #000; padding: 4px 6px; text-align: center;">
                <input type="text" 
                       name="rep02" 
                       value="{{ $repeat->rep02 ?? '' }}"
                       placeholder="-"
                       style="width: 80px; border: none; text-align: center; background-color: transparent; cursor: text;">
             </td>
            <td style="border: 1px solid #000; padding: 4px 6px; text-align: center;">
                <input type="text" 
                       name="rep03" 
                       value="{{ $repeat->rep03 ?? '' }}"
                       placeholder="-"
                       style="width: 80px; border: none; text-align: center; background-color: transparent; cursor: text;">
             </td>
            <td style="border: 1px solid #000; padding: 4px 6px; text-align: center;">
                <input type="text" 
                       name="rep04" 
                       value="{{ $repeat->rep04 ?? '' }}"
                       placeholder="-"
                       style="width: 80px; border: none; text-align: center; background-color: transparent; cursor: text;">
             </td>
            <td style="border: 1px solid #000; padding: 4px 6px; text-align: center;">
                <input type="text" 
                       name="rep05" 
                       value="{{ $repeat->rep05 ?? '' }}"
                       placeholder="-"
                       style="width: 80px; border: none; text-align: center; background-color: transparent; cursor: text;">
             </td>
         </tr>
         <tr>
            <td style="border: 1px solid #000; padding: 4px 6px; text-align: center;">
                <input type="text" 
                       name="rep06" 
                       value="{{ $repeat->rep06 ?? '' }}"
                       placeholder="-"
                       style="width: 80px; border: none; text-align: center; background-color: transparent; cursor: text;">
             </td>
            <td style="border: 1px solid #000; padding: 4px 6px; text-align: center;">
                <input type="text" 
                       name="rep07" 
                       value="{{ $repeat->rep07 ?? '' }}"
                       placeholder="-"
                       style="width: 80px; border: none; text-align: center; background-color: transparent; cursor: text;">
             </td>
            <td style="border: 1px solid #000; padding: 4px 6px; text-align: center;">
                <input type="text" 
                       name="rep08" 
                       value="{{ $repeat->rep08 ?? '' }}"
                       placeholder="-"
                       style="width: 80px; border: none; text-align: center; background-color: transparent; cursor: text;">
             </td>
            <td style="border: 1px solid #000; padding: 4px 6px; text-align: center;">
                <input type="text" 
                       name="rep09" 
                       value="{{ $repeat->rep09 ?? '' }}"
                       placeholder="-"
                       style="width: 80px; border: none; text-align: center; background-color: transparent; cursor: text;">
             </td>
            <td style="border: 1px solid #000; padding: 4px 6px; text-align: center;">
                <input type="text" 
                       name="rep10" 
                       value="{{ $repeat->rep10 ?? '' }}"
                       placeholder="-"
                       style="width: 80px; border: none; text-align: center; background-color: transparent; cursor: text;">
             </td>
         </tr>
     </table>
</div>
            <!-- Footer Section -->
           
<!-- SPASI ANTARA DUA TABEL -->
<div style="height: 25px;"></div>

<!-- Tabel Alat Standar + Metode Kalibrasi - EDIT DATA (No Script) -->
<table style="width: 100%; border-collapse: collapse; font-family: Arial, Helvetica, sans-serif; font-size: 9.5pt;">
    <!-- Header Alat Standar (rowspan 3) -->
    <tr style="height: 18pt;">
        <td rowspan="3" style="width: 101.25pt; border: 1px solid #000; vertical-align: top; background-color: #f8f8f8;">
            <p style="margin: 12pt 0 0 20pt; font-size: 10pt; font-weight: bold;">
                Alat Standar
            </p>
        </td>

        <!-- Baris 1: Dial Gauge Tester 0~25mm -->
        <td style="width: 38px; border: 1px solid #000; text-align: center; vertical-align: middle;">
            @php
                $standard = $calibration->headBoreGauge->standard ?? '';
                $isDialGaugeChecked = str_contains($standard, 'Dial Gauge Tester');
            @endphp
            <input type="checkbox" name="alat_standar[]" value="dial_gauge_tester_0_25mm" 
                   class="alat-standar-checkbox" 
                   style="width: 16px; height: 16px; accent-color: #0066cc; cursor: pointer;"
                   {{ $isDialGaugeChecked ? 'checked' : '' }}>
        </td>
        <td style="width: 152pt; border: 1px solid #000; vertical-align: middle; padding-left: 12px;">
            Dial Gauge Tester 0~25mm
        </td>

        <!-- Dikalibrasi oleh -->
        <td rowspan="3" style="width: 115pt; border: 1px solid #000; vertical-align: top; padding: 8px 10px;">
            <div style="margin-bottom: 6px;">
                <strong>Dikalibrasi oleh</strong>
            </div>
            <div style="margin: 8px 0;">
                TTD : ________________________
            </div>
            <div>
                Nama : 
                <input type="text" name="calibratedBy" 
                       value="{{ $calibration->calibratedBy ?? '' }}"
                       placeholder="Nama"
                       style="width: 65%; border: none; border-bottom: 1px solid #000; 
                              font-size: 9.5pt; background: transparent; margin-left: 8px; padding: 2px 4px;" readonly>
            </div>
        </td>

        <!-- Diperiksa oleh -->
        <td rowspan="3" style="width: 114pt; border: 1px solid #000; vertical-align: top; padding: 8px 10px;">
            <div style="margin-bottom: 6px;">
                <strong>Diperiksa oleh</strong>
            </div>
            <div style="margin: 8px 0;">
                TTD : ________________________
            </div>
            <div>
                Nama : 
                <input type="text" name="verifiedBy" 
                       value="{{ $calibration->verifiedBy ?? '' }}"
                       placeholder="Nama"
                       style="width: 65%; border: none; border-bottom: 1px solid #000; 
                              font-size: 9.5pt; background: transparent; margin-left: 8px; padding: 2px 4px;">
            </div>
        </td>
    </tr>

    <!-- Baris 2: Dial Indicator 1 mm -->
    <tr style="height: 18pt;">
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle;">
            @php
                $isDialIndicatorChecked = str_contains($standard, 'Dial Indicator');
            @endphp
            <input type="checkbox" name="alat_standar[]" value="dial_indicator_1mm" 
                   class="alat-standar-checkbox" 
                   style="width: 16px; height: 16px; accent-color: #0066cc; cursor: pointer;"
                   {{ $isDialIndicatorChecked ? 'checked' : '' }}>
        </td>
        <td style="border: 1px solid #000; vertical-align: middle; padding-left: 12px;">
            Dial Indicator 1 mm
        </td>
    </tr>

    <!-- Baris 3: Lainnya -->
    <tr style="height: 18pt;">
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle;">
            @php
                $standardArray = explode(', ', $standard);
                $hasOther = false;
                $otherValue = '';
                
                foreach ($standardArray as $item) {
                    if (!str_contains($item, 'Dial Gauge Tester') && 
                        !str_contains($item, 'Dial Indicator') && 
                        !empty(trim($item))) {
                        $hasOther = true;
                        $otherValue = $item;
                        break;
                    }
                }
            @endphp
            <input type="checkbox" name="alat_standar[]" value="lainnya" 
                   id="alat_standar_lainnya_checkbox"
                   class="alat-standar-checkbox" 
                   style="width: 16px; height: 16px; accent-color: #0066cc; cursor: pointer;"
                   {{ $hasOther ? 'checked' : '' }}>
        </td>
        <td style="border: 1px solid #000; vertical-align: middle; padding: 4px 12px;">
            <input type="text" name="alat_standar_tambahan" 
                   id="alat_standar_tambahan_input"
                   value="{{ $otherValue ?? '' }}"
                   placeholder="Lainnya :................................................"
                   style="width: 100%; border: none; border-bottom: 1px dotted #666; 
                          font-size: 9.5pt; background: transparent; padding: 2px 0;">
        </td>
    </tr>

    <!-- Metode Kalibrasi -->
    <tr style="height: 24pt;">
        <td colspan="2" style="border: 1px solid #000; vertical-align: middle; background-color: #f8f8f8;">
            <p style="margin: 0; padding-left: 18px; font-size: 10pt; font-weight: bold;">
                Metode Kalibrasi
            </p>
        </td>
        <td colspan="3" style="border: 1px solid #000; vertical-align: middle; padding-left: 12px;">
            <input type="text" name="calibration_method" 
                   value="{{ $calibration->headBoreGauge->calibrationMethod ?? 'PAS-IK1102-58 (berdasarkan JIS B 7515-1982)' }}"
                   style="width: 100%; border: none; border-bottom: 1px solid #666; 
                          font-size: 9.5pt; background: transparent; padding: 4px 0;" readonly>
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