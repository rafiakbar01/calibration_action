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
                        <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK52</p>
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
                        <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">CENTRIFUGE</p>
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
                        <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;">{{ $calibration->headCentrifuge->certificate_id ?? 'N/A' }}</p>
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
    <td><p style="margin:0;color:#000">Rentang Ukur</p></td>
    <td colspan="3">
        <div class="d-flex align-items-center">
            <div style="width:45%; border:1px solid #ccc; padding:8px 12px; margin-right:15px; background-color:#f8f9fa; border-radius:4px;">
                {{ $calibration->rangeMin ? number_format($calibration->rangeMin, 3) : '0' }}
            </div>
            
            <span class="me-3" style="font-weight:bold;">-</span>
            
            <div style="width:45%; border:1px solid #ccc; padding:8px 12px; background-color:#f8f9fa; border-radius:4px;">
                {{ $calibration->rangeMax ? number_format($calibration->rangeMax, 3) : '-' }}
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
            
      <table class="kalibrasi-data-table">
    <tr class="x23" style="height:18.75pt">
        <td colspan="2" class="x76" style="border-right:1px solid windowtext; height:18pt; text-align:center; vertical-align:middle;">Nominal / Setpoint UUT</td>
        <td colspan="5" class="x73" style="border-right:1px solid windowtext; border-bottom:1px solid windowtext; text-align:center;">Pembacaan Standar (rpm)</td>
        <td colspan="3" rowspan="2" class="x78" style="border-right:2px solid windowtext; border-bottom:1px solid windowtext; height:34.5pt; text-align:center; vertical-align:middle;">Resolusi Alat</td>
    </tr>
    <tr class="x23" style="height:16.5pt">
        <td colspan="2" class="x84" style="border-right:1px solid windowtext; border-bottom:1px solid windowtext; height:15.75pt; text-align:center;">rpm</td>
        <td class="x56" style="text-align:center;">1</td>
        <td class="x56" style="text-align:center;">2</td>
        <td class="x56" style="text-align:center;">3</td>
        <td class="x56" style="text-align:center;">4</td>
        <td class="x56" style="text-align:center;">5</td>
    </tr>

    @if($calibration->detailcentrifuges && $calibration->detailcentrifuges->count() > 0)
        @foreach($calibration->detailcentrifuges as $index => $detail)
        <tr class="x23" style="height:20.25pt">
            <td colspan="2" class="x65" style="border-right:2px solid windowtext; border-bottom:{{ $loop->last ? '2px' : '1px' }} solid windowtext; height:18.75pt; text-align:center; vertical-align:middle;">
                @if($detail->nominalRPM)
                    {{ is_numeric($detail->nominalRPM) ? number_format($detail->nominalRPM, 3) : $detail->nominalRPM }}
                @else
                    -
                @endif
            </td>
            
            <td class="x48" style="text-align:center; vertical-align:middle;">
                @if($detail->STD1)
                    {{ is_numeric($detail->STD1) ? number_format($detail->STD1, 3) : $detail->STD1 }}
                @else
                    -
                @endif
            </td>
            <td class="x48" style="text-align:center; vertical-align:middle;">
                @if($detail->STD2)
                    {{ is_numeric($detail->STD2) ? number_format($detail->STD2, 3) : $detail->STD2 }}
                @else
                    -
                @endif
            </td>
            <td class="x48" style="text-align:center; vertical-align:middle;">
                @if($detail->STD3)
                    {{ is_numeric($detail->STD3) ? number_format($detail->STD3, 3) : $detail->STD3 }}
                @else
                    -
                @endif
            </td>
            <td class="x48" style="text-align:center; vertical-align:middle;">
                @if($detail->STD4)
                    {{ is_numeric($detail->STD4) ? number_format($detail->STD4, 3) : $detail->STD4 }}
                @else
                    -
                @endif
            </td>
            <td class="x48" style="text-align:center; vertical-align:middle;">
                @if($detail->STD5)
                    {{ is_numeric($detail->STD5) ? number_format($detail->STD5, 3) : $detail->STD5 }}
                @else
                    -
                @endif
            </td>
            
            <!-- Resolusi Alat -->
            <td colspan="3" class="x65" style="border-right:2px solid windowtext; border-bottom:{{ $loop->last ? '2px' : '1px' }} solid windowtext; text-align:center; vertical-align:middle;">
                @if($detail->resolusi)
                    {{ is_numeric($detail->resolusi) ? number_format($detail->resolusi, 3) . ' rpm' : $detail->resolusi }}
                @else
                    -
                @endif
            </td>
        </tr>
        @endforeach
        
        <!-- Tambah baris kosong jika data kurang dari 12 -->
        @if($calibration->detailcentrifuges->count() < 12)
            @for($i = $calibration->detailcentrifuges->count() + 1; $i <= 12; $i++)
            <tr class="x23" style="height:20.25pt">
                <td colspan="2" class="x65" style="border-right:2px solid windowtext; border-bottom:{{ $i == 12 ? '2px' : '1px' }} solid windowtext; height:18.75pt; text-align:center; vertical-align:middle;">
                    -
                </td>
                
                @for($j = 1; $j <= 5; $j++)
                <td class="x48" style="text-align:center; vertical-align:middle;">
                    -
                </td>
                @endfor
                
                <!-- Resolusi Alat -->
                <td colspan="3" class="x65" style="border-right:2px solid windowtext; border-bottom:{{ $i == 12 ? '2px' : '1px' }} solid windowtext; text-align:center; vertical-align:middle;">
                    -
                </td>
            </tr>
            @endfor
        @endif
    @else
        <!-- Tampilkan 12 baris kosong jika tidak ada data -->
        @for($i = 1; $i <= 12; $i++)
        <tr class="x23" style="height:20.25pt">
            <td colspan="2" class="x65" style="border-right:2px solid windowtext; border-bottom:{{ $i == 12 ? '2px' : '1px' }} solid windowtext; height:18.75pt; text-align:center; vertical-align:middle;">
                -
            </td>
            
            @for($j = 1; $j <= 5; $j++)
            <td class="x48" style="text-align:center; vertical-align:middle;">
                -
            </td>
            @endfor
            
            <!-- Resolusi Alat -->
            <td colspan="3" class="x65" style="border-right:2px solid windowtext; border-bottom:{{ $i == 12 ? '2px' : '1px' }} solid windowtext; text-align:center; vertical-align:middle;">
                -
            </td>
        </tr>
        @endfor
    @endif
</table>

            <!-- Footer Section -->
          <table class="kalibrasi-main-table">
    <tr>
        <td colspan="9" style="text-align: center; border-bottom: 1px solid #000;">
            <span style="font-weight: bold; font-size: 18px; color: #000000;">Isilah lembar data kalibrasi dengan lengkap dan jelas!</span>
        </td>
    </tr>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
            font-size: 10pt;
        }
        td {
            border: 1px solid #000;
            padding: 8px;
            vertical-align: middle;
            text-align: left;
        }
        .label-col {
            font-weight: bold;
            background-color: #f0f0f0;
            text-align: center;
        }
        .content-col {
            text-align: left;
            padding-left: 15px;
            vertical-align: middle;
        }
        .signature-col {
            width: 18%;
            font-weight: bold;
            background-color: #f8f8f8;
            text-align: center;
        }
        .signature-name {
            font-weight: normal;
            margin-left: 10px;
            border-bottom: 1px solid #000;
            padding-bottom: 2px;
            min-width: 150px;
            display: inline-block;
        }
        .ttd-row {
            height: 80px;
            text-align: center;
            vertical-align: bottom;
        }
        .signature-line {
            width: 80%;
            border-top: 1px solid #000;
            margin: 0 auto;
            padding-top: 5px;
            font-size: 9pt;
            color: #666;
        }
    </style>

    <!-- Baris 1 & 2: Alat Standar + Tanda Tangan Header -->
    <tr>
        <td rowspan="2" colspan="2" class="label-col">Alat Standar</td>
        <td rowspan="2" colspan="4" class="content-col">
            @if(isset($calibration->headcentrifuges) && $calibration->headcentrifuges->standard)
                {{ $calibration->headcentrifuges->standard }}
            @else
                Tachometer CEM AT-8 (200302615)
            @endif
        </td>
        <td colspan="2" class="signature-col">Dikalibrasi oleh</td>
        <td colspan="2" class="signature-col">Diperiksa oleh</td>
    </tr>
    <tr>
        <!-- Baris kosong untuk rowspan=2 pada kolom tanda tangan -->
        <td colspan="2" class="ttd-row">
            @if(isset($calibration->headcentrifuges) && $calibration->headcentrifuges->calibrated_by)
                <div class="signature-line">
                    {{ $calibration->headcentrifuges->calibrated_by }}
                </div>
            @endif
        </td>
        <td colspan="2" class="ttd-row">
            @if(isset($calibration->headcentrifuges) && $calibration->headcentrifuges->verified_by)
                <div class="signature-line">
                    {{ $calibration->headcentrifuges->verified_by }}
                </div>
            @endif
        </td>
    </tr>

    <!-- Baris 3 & 4: Metode Kalibrasi + Nama & TTD -->
    <tr>
        <td rowspan="2" colspan="2" class="label-col">Metode Kalibrasi</td>
        <td rowspan="2" colspan="4" class="content-col">
            @if(isset($calibration->headcentrifuges) && $calibration->headcentrifuges->calibrationMethod)
                {{ $calibration->headcentrifuges->calibrationMethod }}
            @else
                PAS-IK1102-52
            @endif
        </td>
        <td colspan="2">TTD :</td>
        <td colspan="2">TTD :</td>
    </tr>
    <tr>
        <td colspan="2">
            Nama: 
            <span class="signature-name">
                @if(isset($calibration) && $calibration->calibratedBy)
                    {{ $calibration->calibratedBy }}
                @else
                    -
                @endif
            </span>
        </td>
        <td colspan="2">
            Nama: 
            <span class="signature-name">
                @if(isset($calibration) && $calibration->verifiedBy)
                    {{ $calibration->verifiedBy }}
                @else
                    -
                @endif
            </span>
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