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
                    // Ambil semua data detailBoreGauge dan urutkan berdasarkan ID dari terkecil
                    $allDetails = $calibration->detailBoreGauges ?? collect([]);
                    $allDetails = $allDetails->sortBy('id'); // Urutkan berdasarkan ID ascending
                    
                    // 20 baris pertama untuk tabel bawah (index 0-19)
                    $detailsBawah = $allDetails->slice(0, 20);
                    
                    // Jika kurang dari 20 baris, tambahkan baris kosong
                    if($detailsBawah->count() < 20) {
                        $missingCount = 20 - $detailsBawah->count();
                        for($i = 0; $i < $missingCount; $i++) {
                            $detailsBawah->push((object)['penunjukAlat' => '', 'std_naik' => '', 'std_turun' => '']);
                        }
                    }
                @endphp

                @foreach($detailsBawah as $index => $detail)
                    @php
                        // Default value untuk 11 baris pertama (0.0 - 1.0)
                        $defaultValue = ($index <= 10) ? number_format($index * 0.1, 1) : '';
                        
                        // Nilai dari database atau default
                        $penunjukanValue = !empty($detail->penunjukAlat) ? $detail->penunjukAlat : $defaultValue;
                        $naikValue = $detail->std_naik ?? '';
                        $turunValue = $detail->std_turun ?? '';
                    @endphp
                    <tr>
                        <td class="penunjukan-input">
                            <input type="text" 
                                   value="{{ $penunjukanValue }}"
                                   readonly>
                        </td>
                        <td>
                            <input type="text" 
                                   value="{{ $naikValue }}"
                                   readonly>
                        </td>
                        <td>
                            <input type="text" 
                                   value="{{ $turunValue }}"
                                   readonly>
                        </td>
                    </tr>
                @endforeach
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
                @php
                    // Gunakan $allDetails yang sudah diurutkan untuk 20 baris berikutnya (index 20-39)
                    $detailsAtas = $allDetails->slice(20, 20);
                    
                    // Jika kurang dari 20 baris, tambahkan baris kosong
                    if($detailsAtas->count() < 20) {
                        $missingCount = 20 - $detailsAtas->count();
                        for($i = 0; $i < $missingCount; $i++) {
                            $detailsAtas->push((object)['penunjukAlat' => '', 'std_naik' => '', 'std_turun' => '']);
                        }
                    }
                @endphp

                @foreach($detailsAtas as $detail)
                    @php
                        $penunjukanValue = $detail->penunjukAlat ?? '';
                        $naikValue = $detail->std_naik ?? '';
                        $turunValue = $detail->std_turun ?? '';
                    @endphp
                    <tr>
                        <td class="penunjukan-input">
                            <input type="text" 
                                   value="{{ $penunjukanValue }}"
                                   readonly>
                        </td>
                        <td>
                            <input type="text" 
                                   value="{{ $naikValue }}"
                                   readonly>
                        </td>
                        <td>
                            <input type="text" 
                                   value="{{ $turunValue }}"
                                   readonly>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- Tabel Repeatability - VIEW DATA -->
<!-- Tabel Repeatability - VIEW DATA -->
<style>
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

.repeatability-value {
    width: 100%;
    height: 100%;
    border: none;
    background: transparent;
    text-align: center;
    font-size: 9pt;
    padding: 1px;
    box-sizing: border-box;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #000000;
}

.repeatability-empty {
    color: #999999;
    font-style: italic;
}
</style>

<div class="repeatability-section">
    <p class="repeatability-title" style="display: inline-block; margin-right: 10px;">Repeatability :</p>
    @php
        $repeat = $calibration->addBoreGauge ?? null;
        
        function formatRepeatValue($value) {
            if (is_null($value) || $value === '') {
                return '-';
            }
            if (is_numeric($value)) {
                if ($value == floor($value)) {
                    return number_format($value, 0);
                }
                return number_format($value, 3);
            }
            return e($value);
        }
    @endphp

    <span style="width: 100px; border-bottom: 1px solid #000; display: inline-block; text-align: center;">
        {{ formatRepeatValue($repeat->repeatability ?? null) }}
    </span>

    <table class="repeatability-table" style="margin-top: 10px; border-collapse: collapse;">
        <tr>
            <td style="border: 1px solid #000; padding: 4px 6px; text-align: center;">{{ formatRepeatValue($repeat->rep01 ?? null) }}</td>
            <td style="border: 1px solid #000; padding: 4px 6px; text-align: center;">{{ formatRepeatValue($repeat->rep02 ?? null) }}</td>
            <td style="border: 1px solid #000; padding: 4px 6px; text-align: center;">{{ formatRepeatValue($repeat->rep03 ?? null) }}</td>
            <td style="border: 1px solid #000; padding: 4px 6px; text-align: center;">{{ formatRepeatValue($repeat->rep04 ?? null) }}</td>
            <td style="border: 1px solid #000; padding: 4px 6px; text-align: center;">{{ formatRepeatValue($repeat->rep05 ?? null) }}</td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; padding: 4px 6px; text-align: center;">{{ formatRepeatValue($repeat->rep06 ?? null) }}</td>
            <td style="border: 1px solid #000; padding: 4px 6px; text-align: center;">{{ formatRepeatValue($repeat->rep07 ?? null) }}</td>
            <td style="border: 1px solid #000; padding: 4px 6px; text-align: center;">{{ formatRepeatValue($repeat->rep08 ?? null) }}</td>
            <td style="border: 1px solid #000; padding: 4px 6px; text-align: center;">{{ formatRepeatValue($repeat->rep09 ?? null) }}</td>
            <td style="border: 1px solid #000; padding: 4px 6px; text-align: center;">{{ formatRepeatValue($repeat->rep10 ?? null) }}</td>
        </tr>
    </table>
</div>
            <!-- Footer Section -->
           

                    <!-- ALAT STANDAR + CHECKBOX -->
                <!-- SPASI ANTARA DUA TABEL -->
<div style="height: 25px;"></div>

<!-- Tabel Alat Standar + Metode Kalibrasi - VIEW DATA (Lengkap) -->
<table style="width: 100%; border-collapse: collapse; font-family: Arial, Helvetica, sans-serif; font-size: 9.5pt;">
    <!-- Header Alat Standar (rowspan 3) -->
    <tr style="height: 18pt;">
        <td rowspan="3" style="width: 101.25pt; border: 1px solid #000; vertical-align: top; background-color: #f8f8f8;">
            <p style="margin: 12pt 0 0 20pt; font-size: 10pt; font-weight: bold;">
                Alat Standar
            </p>
            <p style="margin: 5pt 0 0 20pt; font-size: 8pt; color: #666;">
               
            </p>
        </td>

        <!-- Baris 1: Dial Gauge Tester 0~25mm -->
        <td style="width: 38px; border: 1px solid #000; text-align: center; vertical-align: middle;">
            @php
                $standard = $calibration->headBoreGauge->standard ?? '';
                $isChecked = str_contains($standard, 'Dial Gauge Tester');
            @endphp
            @if($isChecked)
                <span style="color: #0066cc; font-size: 14px; font-weight: bold;">✓</span>
            @endif
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
                <span style="border-bottom: 1px solid #000; padding: 0 4px; margin-left: 8px;">
                    {{ $calibration->calibratedBy ?? '-' }}
                </span>
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
                <span style="border-bottom: 1px solid #000; padding: 0 4px; margin-left: 8px;">
                    {{ $calibration->verifiedBy ?? '-' }}
                </span>
            </div>
        </td>
    </tr>

    <!-- Baris 2: Dial Indicator 1 mm -->
    <tr style="height: 18pt;">
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle;">
            @php
                $isChecked = str_contains($standard, 'Dial Indicator');
            @endphp
            @if($isChecked)
                <span style="color: #0066cc; font-size: 14px; font-weight: bold;">✓</span>
            @endif
        </td>
        <td style="border: 1px solid #000; vertical-align: middle; padding-left: 12px;">
            Dial Indicator 1 mm
           
        </td>
    </tr>

    <!-- Baris 3: Lainnya -->
    <tr style="height: 18pt;">
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle;">
            @php
                $hasOther = false;
                $standardArray = explode(', ', $standard);
                $otherList = [];
                foreach ($standardArray as $item) {
                    if (!str_contains($item, 'Dial Gauge Tester') && !str_contains($item, 'Dial Indicator') && !empty(trim($item))) {
                        $hasOther = true;
                        $otherList[] = $item;
                    }
                }
            @endphp
            @if($hasOther)
                <span style="color: #0066cc; font-size: 14px; font-weight: bold;">✓</span>
            @endif
        </td>
        <td style="border: 1px solid #000; vertical-align: middle; padding: 4px 12px;">
            <span style="width: 100%; font-size: 9.5pt; padding: 2px 0; display: inline-block;">
                Lainnya : 
                @if($hasOther)
                    <span style="border-bottom: 1px dotted #666; padding: 0 4px;">
                        {{ implode(', ', $otherList) }}
                    </span>
                @else
                    <span style="color: #999; border-bottom: 1px dotted #ccc; padding: 0 20px;">-</span>
                @endif
            </span>
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
            <p style="margin: 0; font-size: 9.5pt;">
                {{ $calibration->headBoreGauge->calibrationMethod ?? 'PAS-IK1102-58 (berdasarkan JIS B 7515-1982)' }}
            </p>
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