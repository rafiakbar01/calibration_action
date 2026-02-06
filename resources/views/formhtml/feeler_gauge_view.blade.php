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
                        <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK62</p>
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
                        <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">FEELER GAUGE</p>
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
                        <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;">{{ $calibration->headFeelerGauge->certificate_id ?? 'N/A' }}</p>
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

      @php
    use App\Models\DetailFeelerGauge;
    
    $calibrationId = $calibration->id ?? request('calibration_id') ?? 0;
    $details = DetailFeelerGauge::where('calibration_id', $calibrationId)
                ->orderBy('id', 'asc')
                ->get();
@endphp

<table class="data-kalibrasi-table" cellspacing="0" cellpadding="0" style="margin-left:14.28pt; border:0.75pt solid #000000; border-collapse:collapse; width:100%; max-width:1200px;">
    <!-- Baris 1: Judul Utama + merged cell -->
    <tr style="height:13.15pt">
        <td rowspan="3" style="width:15.8pt; border-right:0.75pt solid #000; border-bottom:0.75pt solid #000; vertical-align:top; text-align:center;">
            <p style="margin-top:15pt; font-size:8pt; font-weight:bold;">No</p>
        </td>
        <td colspan="2" style="width:96.35pt; border-right:0.75pt solid #000; border-bottom:0.75pt solid #000; vertical-align:top; text-align:center;">
            <p style="margin-top:5pt; font-size:8pt; font-weight:bold;">Nilai Nominal</p>
        </td>
        <td colspan="8" style="width:432.15pt; border-bottom:0.75pt solid #000; vertical-align:top; text-align:center;">
            <p style="margin-top:5pt; font-size:8pt; font-weight:bold;">PEMBACAAN STANDAR ULM</p>
        </td>
    </tr>

    <!-- Baris 2: Sub-header UUT & Gauge Block + merged pengukuran -->
    <tr style="height:13.15pt">
        <td style="width:44.4pt; border:0.75pt solid #000; vertical-align:top; text-align:center;">
            <p style="margin-top:5pt; font-size:8pt; font-weight:bold;">UUT</p>
        </td>
        <td style="width:51.2pt; border:0.75pt solid #000; vertical-align:top; text-align:center;">
            <p style="margin-top:5pt; font-size:8pt; font-weight:bold;">Gauge Block</p>
        </td>
        <td colspan="4" style="width:215.10pt; border:0.75pt solid #000; vertical-align:top; text-align:center;">
            <p style="margin-top:5pt; font-size:8pt; font-weight:bold;">PENGUKURAN A dan B</p>
        </td>
        <td colspan="4" style="width:215.10pt; border:0.75pt solid #000; vertical-align:top; text-align:center;">
            <p style="margin-top:5pt; font-size:8pt; font-weight:bold;">PENGUKURAN A dan C</p>
        </td>
    </tr>

    <!-- Baris 3: Detail label dengan Unit ( ) di bawah UUT & Gauge Block -->
    <tr style="height:13.15pt">
        <td style="width:44.4pt; border:0.75pt solid #000; vertical-align:top; text-align:center;">
            <p style="margin-top:3pt; font-size:10pt; font-weight:bold;">Unit ( )</p>
        </td>
        <td style="width:51.2pt; border:0.75pt solid #000; vertical-align:top; text-align:center;">
            <p style="margin-top:3pt; font-size:10pt; font-weight:bold;">Unit ( )</p>
        </td>

        <!-- Pengukuran A dan B - 4 kolom detail -->
        <td style="width:53.4pt; border:0.75pt solid #000; vertical-align:top; text-align:center;">
            <p style="margin-top:3pt; font-size:10pt; font-weight:bold;">Gauge Block(A)</p>
        </td>
        <td style="width:53.35pt; border:0.75pt solid #000; vertical-align:top; text-align:center;">
            <p style="margin-top:3pt; font-size:10pt; font-weight:bold;">UUT(B)</p>
        </td>
        <td style="width:53.35pt; border:0.75pt solid #000; vertical-align:top; text-align:center;">
            <p style="margin-top:3pt; font-size:10pt; font-weight:bold;">Gauge Block(A)</p>
        </td>
        <td style="width:53.35pt; border:0.75pt solid #000; vertical-align:top; text-align:center;">
            <p style="margin-top:3pt; font-size:10pt; font-weight:bold;">UUT(B)</p>
        </td>

        <!-- Pengukuran A dan C - 4 kolom detail -->
        <td style="width:53.35pt; border:0.75pt solid #000; vertical-align:top; text-align:center;">
            <p style="margin-top:3pt; font-size:10pt; font-weight:bold;">Gauge Block(A)</p>
        </td>
        <td style="width:53.4pt; border:0.75pt solid #000; vertical-align:top; text-align:center;">
            <p style="margin-top:3pt; font-size:10pt; font-weight:bold;">UUT(C)</p>
        </td>
        <td style="width:53.35pt; border:0.75pt solid #000; vertical-align:top; text-align:center;">
            <p style="margin-top:3pt; font-size:10pt; font-weight:bold;">Gauge Block(A)</p>
        </td>
        <td style="width:53.35pt; border:0.75pt solid #000; vertical-align:top; text-align:center;">
            <p style="margin-top:3pt; font-size:10pt; font-weight:bold;">UUT(C)</p>
        </td>
    </tr>

    <!-- Baris Data dari Database -->
    @if($details->isNotEmpty())
        @foreach($details as $detail)
        <tr style="height:14.25pt">
            <td style="width:15.8pt; border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:10pt;">
                {{ $loop->iteration }}
            </td>
            
            <!-- Nilai Nominal -->
            <td style="width:44.4pt; border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:10pt;">
                @if($detail->nominalUUT !== null)
                {{ number_format((float)$detail->nominalUUT, 5) }}
                @endif
            </td>
            <td style="width:51.2pt; border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:10pt;">
                @if($detail->nominalGB !== null)
                {{ number_format((float)$detail->nominalGB, 5) }}
                @endif
            </td>
            
            <!-- Pengukuran A dan B -->
            <td style="width:53.4pt; border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:10pt;">
                @if($detail->GBA1 !== null)
                {{ number_format((float)$detail->GBA1, 5) }}
                @endif
            </td>
            <td style="width:53.35pt; border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:10pt;">
                @if($detail->UUTB1 !== null)
                {{ number_format((float)$detail->UUTB1, 5) }}
                @endif
            </td>
            <td style="width:53.35pt; border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:10pt;">
                @if($detail->GBA2 !== null)
                {{ number_format((float)$detail->GBA2, 5) }}
                @endif
            </td>
            <td style="width:53.35pt; border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:10pt;">
                @if($detail->UUTB2 !== null)
                {{ number_format((float)$detail->UUTB2, 5) }}
                @endif
            </td>
            
            <!-- Pengukuran A dan C -->
            <td style="width:53.35pt; border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:10pt;">
                @if($detail->GBA3 !== null)
                {{ number_format((float)$detail->GBA3, 5) }}
                @endif
            </td>
            <td style="width:53.4pt; border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:10pt;">
                @if($detail->UUTC3 !== null)
                {{ number_format((float)$detail->UUTC3, 5) }}
                @endif
            </td>
            <td style="width:53.35pt; border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:10pt;">
                @if($detail->GBA4 !== null)
                {{ number_format((float)$detail->GBA4, 5) }}
                @endif
            </td>
            <td style="width:53.35pt; border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:10pt;">
                @if($detail->UUTC4 !== null)
                {{ number_format((float)$detail->UUTC4, 5) }}
                @endif
            </td>
        </tr>
        @endforeach
        
        <!-- Tambah baris kosong hingga 25 jika jumlah data kurang dari 25 -->
        @php
            $currentRows = count($details);
            $emptyRows = max(0, 25 - $currentRows);
        @endphp
        
        @for($i = 1; $i <= $emptyRows; $i++)
        <tr style="height:14.25pt">
            <td style="width:15.8pt; border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:10pt;">
                {{ $currentRows + $i }}
            </td>
            <td style="width:44.4pt; border:0.75pt solid #000; text-align:center;"></td>
            <td style="width:51.2pt; border:0.75pt solid #000; text-align:center;"></td>
            <td style="width:53.4pt; border:0.75pt solid #000; text-align:center;"></td>
            <td style="width:53.35pt; border:0.75pt solid #000; text-align:center;"></td>
            <td style="width:53.35pt; border:0.75pt solid #000; text-align:center;"></td>
            <td style="width:53.35pt; border:0.75pt solid #000; text-align:center;"></td>
            <td style="width:53.35pt; border:0.75pt solid #000; text-align:center;"></td>
            <td style="width:53.4pt; border:0.75pt solid #000; text-align:center;"></td>
            <td style="width:53.35pt; border:0.75pt solid #000; text-align:center;"></td>
            <td style="width:53.35pt; border:0.75pt solid #000; text-align:center;"></td>
        </tr>
        @endfor
        
    @else
        <!-- Jika tidak ada data, tampilkan 25 baris kosong -->
        @for($i = 1; $i <= 25; $i++)
        <tr style="height:14.25pt">
            <td style="width:15.8pt; border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:10pt;">
                {{ $i }}
            </td>
            <td style="width:44.4pt; border:0.75pt solid #000; text-align:center;"></td>
            <td style="width:51.2pt; border:0.75pt solid #000; text-align:center;"></td>
            <td style="width:53.4pt; border:0.75pt solid #000; text-align:center;"></td>
            <td style="width:53.35pt; border:0.75pt solid #000; text-align:center;"></td>
            <td style="width:53.35pt; border:0.75pt solid #000; text-align:center;"></td>
            <td style="width:53.35pt; border:0.75pt solid #000; text-align:center;"></td>
            <td style="width:53.35pt; border:0.75pt solid #000; text-align:center;"></td>
            <td style="width:53.4pt; border:0.75pt solid #000; text-align:center;"></td>
            <td style="width:53.35pt; border:0.75pt solid #000; text-align:center;"></td>
            <td style="width:53.35pt; border:0.75pt solid #000; text-align:center;"></td>
        </tr>
        @endfor
    @endif
</table>

<!-- Info tambahan jika ada data -->
@if($details->isNotEmpty() && isset($calibration))
<div style="margin-top: 10px; font-size: 9pt;">
    @if($calibration->uncertainty)
    <p><strong>Uncertainty:</strong> {{ $calibration->uncertainty }}</p>
    @endif
    @if($calibration->keterangan)
    <p><strong>Keterangan:</strong> {{ $calibration->keterangan }}</p>
    @endif
</div>
@endif


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

@php
    use App\Models\HeadFeelerGauge;
    
    $calibrationId = $calibration->id ?? request('calibration_id') ?? 0;
    $head = HeadFeelerGauge::where('calibration_id', $calibrationId)->first();
    
    $allStandards = ['Mesin ULM 01-600D', 'Micrometer', 'Gauge Block'];
    $selectedStandards = [];
    
    if ($head && $head->standard) {
        if (is_string($head->standard)) {
            $selectedStandards = array_map('trim', explode(',', $head->standard));
        } elseif (is_array($head->standard)) {
            $selectedStandards = $head->standard;
        }
    }
@endphp

<table border="1" cellspacing="0" cellpadding="5" style="border-collapse: collapse; width: 100%; margin-bottom: 20px; border: 1px solid black;">
    <tr>
        <td colspan="4" style="text-align: center; font-weight: bold; background-color: #e6e6e6; border: 1px solid black; padding: 10px;">
            Isilah lembar data kalibrasi dengan lengkap dan jelas!
        </td>
    </tr>
    <tr>
        <td style="width: 20%; text-align: center; vertical-align: middle; border: 1px solid black; padding: 10px;">
            <strong>Alat Standar</strong>
        </td>
        <td style="width: 40%; vertical-align: top; border: 1px solid black; padding: 10px;">
            <!-- Custom checkbox dengan border tebal -->
            @foreach($allStandards as $standard)
            <div style="margin-bottom: 12px; display: flex; align-items: center;">
                <!-- Kotak checkbox custom -->
                <div style="
                    width: 20px; 
                    height: 20px; 
                    border: 3px solid {{ in_array($standard, $selectedStandards) ? '#198754' : '#adb5bd' }};
                    background-color: {{ in_array($standard, $selectedStandards) ? '#198754' : 'white' }};
                    margin-right: 12px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    box-shadow: {{ in_array($standard, $selectedStandards) ? '0 0 5px rgba(25, 135, 84, 0.5)' : 'none' }};
                ">
                    @if(in_array($standard, $selectedStandards))
                    <span style="color: white; font-weight: bold; font-size: 14px;">✓</span>
                    @endif
                </div>
                
                <!-- Label tebal -->
                <span style="
                    font-weight: bold; 
                    font-size: 12pt;
                    color: {{ in_array($standard, $selectedStandards) ? '#198754' : '#495057' }};
                    text-shadow: {{ in_array($standard, $selectedStandards) ? '0 1px 1px rgba(0,0,0,0.1)' : 'none' }};
                ">
                    {{ $standard }}
                </span>
            </div>
            @endforeach
            
            <!-- Alat standar tambahan -->
            @if(!empty($selectedStandards))
                @foreach($selectedStandards as $standard)
                    @if(!in_array($standard, $allStandards))
                    <div style="margin-bottom: 12px; display: flex; align-items: center;">
                        <div style="
                            width: 20px; 
                            height: 20px; 
                            border: 3px solid #198754;
                            background-color: #198754;
                            margin-right: 12px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        ">
                            <span style="color: white; font-weight: bold; font-size: 14px;">✓</span>
                        </div>
                        <span style="font-weight: bold; font-size: 12pt; color: #198754;">{{ $standard }}</span>
                    </div>
                    @endif
                @endforeach
            @endif
        </td>
        <td style="width: 20%; text-align: center; vertical-align: top; border: 1px solid black; padding: 10px;">
            <strong style="font-size: 11pt;">Dikalibrasi oleh</strong>
        </td>
        <td style="width: 20%; text-align: center; vertical-align: top; border: 1px solid black; padding: 10px;">
            <strong style="font-size: 11pt;">Diperiksa oleh</strong>
        </td>
    </tr>
    <tr>
        <td rowspan="2" style="text-align: center; vertical-align: middle; border: 1px solid black; padding: 10px;">
            <strong style="font-size: 11pt;">Metode Kalibrasi</strong>
        </td>
        <td rowspan="2" style="text-align: center; vertical-align: middle; border: 1px solid black; padding: 10px;">
            <span style="font-weight: bold; font-size: 13pt; color: #dc3545;">{{ $head->calibrationMethod ?? 'PAS-IK1102-62' }}</span>
        </td>
        <td style="border: 1px solid black; padding: 10px;">
            <strong style="font-size: 11pt;">TTD :</strong>
        </td>
        <td style="border: 1px solid black; padding: 10px;">
            <strong style="font-size: 11pt;">TTD :</strong>
        </td>
    </tr>
    <tr>
        <td style="border: 1px solid black; padding: 10px;">
            <strong style="font-size: 11pt;">Nama :</strong><br>
            <div style="margin-top: 8px; padding: 10px; border: 2px solid #212529; background-color: white; font-weight: bold; font-size: 12pt; min-height: 40px; display: flex; align-items: center;">
                {{ $calibration->calibratedBy ?? '....................' }}
            </div>
        </td>
        <td style="border: 1px solid black; padding: 10px;">
            <strong style="font-size: 11pt;">Nama :</strong><br>
            <div style="margin-top: 8px; padding: 10px; border: 2px solid #212529; background-color: white; font-weight: bold; font-size: 12pt; min-height: 40px; display: flex; align-items: center;">
                {{ $calibration->verifiedBy ?? '....................' }}
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