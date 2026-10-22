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
    .form-kalibrasi-container *:not(input):not(select):not(textarea):not(button):not(i):not(.btn) {
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
                        <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK65</p>
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
                        <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">GAUGE BLOCK</p>
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
                        <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;">{{ $calibration->headGaugeBlock->certificate_id ?? 'N/A' }}</p>
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



<table style="font-size: 0.9rem; border-collapse: collapse; width: 100%;">
    <tr>
        <th colspan="5" class="text-start" style="font-size: 1.1rem; background-color: white; padding: 8px;">Uji Kerataan</th>
    </tr>
    
    <tr style="background-color: #d6d6d6;">
        <th rowspan="2" class="align-middle" style="width:20%; font-size: 0.95rem; border: 2px solid black; padding: 8px;">Nominal Gauge Block</th>
        <th colspan="4" class="fw-bold text-center" style="font-size: 0.95rem; border: 2px solid black; padding: 8px; text-align: center;">Bentuk Frinji</th>
    </tr>
    <tr style="background-color: #d6d6d6;">
        <th colspan="2" style="font-size: 0.9rem; border: 2px solid black; padding: 8px;">Permukaan kiri</th>
        <th colspan="2" style="font-size: 0.9rem; border: 2px solid black; padding: 8px;">Permukaan kanan</th>
    </tr>
    
    @php
        // SOLUSI: Query langsung dari database
        use App\Models\AddGaugeBlock;
        
        $addGaugeBlocks = AddGaugeBlock::where('calibration_id', $calibration->id)
            ->orderBy('id')
            ->limit(3)
            ->get();
            
        // Atau jika $calibration tidak memiliki id
        // $addGaugeBlocks = AddGaugeBlock::where('calibrations_id', $calibration->id ?? 0)->get();
        
        // Debug: cek jumlah data
        // {{-- Data count: {{ $addGaugeBlocks->count() }} --}}
        
        $block1 = $addGaugeBlocks->get(0);
        $block2 = $addGaugeBlocks->get(1);
        $block3 = $addGaugeBlocks->get(2);
    @endphp
    
    <!-- Baris 1 -->
    <tr>
        <td style="border: 1px solid black; padding: 8px; text-align: center;">
            <span style="display:inline-block; min-width: 65px; font-size: 0.9rem;">
                {{ $block1->titikUkurKerataan ?? '' }}
            </span> mm
        </td>
        <td style="border: 1px solid black; padding: 8px; text-align: center;">
            @php
                $kiri1 = $block1->Lsurface ?? '';
            @endphp
            @if($kiri1 == 'beraturan')
                ( <span style="color: #000; font-weight: bold;">✓</span> ) 
                <span class="mb-0 ms-1" style="font-size: 0.85rem;">Beraturan</span>
            @else
                ( <span style="opacity: 0.3;">□</span> ) 
                <span class="mb-0 ms-1" style="font-size: 0.85rem; opacity: 0.7;">Beraturan</span>
            @endif
        </td>
        <td style="border: 1px solid black; padding: 8px; text-align: center;">
            @if($kiri1 == 'tidak_beraturan')
                ( <span style="color: #000; font-weight: bold;">✓</span> ) 
                <span class="mb-0 ms-1" style="font-size: 0.85rem;">Tdk Beraturan</span>
            @else
                ( <span style="opacity: 0.3;">□</span> ) 
                <span class="mb-0 ms-1" style="font-size: 0.85rem; opacity: 0.7;">Tdk Beraturan</span>
            @endif
        </td>
        <td style="border: 1px solid black; padding: 8px; text-align: center;">
            @php
                $kanan1 = $block1->Rsurface ?? '';
            @endphp
            @if($kanan1 == 'beraturan')
                ( <span style="color: #000; font-weight: bold;">✓</span> ) 
                <span class="mb-0 ms-1" style="font-size: 0.85rem;">Beraturan</span>
            @else
                ( <span style="opacity: 0.3;">□</span> ) 
                <span class="mb-0 ms-1" style="font-size: 0.85rem; opacity: 0.7;">Beraturan</span>
            @endif
        </td>
        <td style="border: 1px solid black; padding: 8px; text-align: center;">
            @if($kanan1 == 'tidak_beraturan')
                ( <span style="color: #000; font-weight: bold;">✓</span> ) 
                <span class="mb-0 ms-1" style="font-size: 0.85rem;">Tdk Beraturan</span>
            @else
                ( <span style="opacity: 0.3;">□</span> ) 
                <span class="mb-0 ms-1" style="font-size: 0.85rem; opacity: 0.7;">Tdk Beraturan</span>
            @endif
        </td>
    </tr>
    
    <!-- Baris 2 -->
    <tr>
        <td style="border: 1px solid black; padding: 8px; text-align: center;">
            <span style="display:inline-block; min-width: 65px; font-size: 0.9rem;">
                {{ $block2->titikUkurKerataan ?? '' }}
            </span> mm
        </td>
        <td style="border: 1px solid black; padding: 8px; text-align: center;">
            @php
                $kiri2 = $block2->Lsurface ?? '';
            @endphp
            @if($kiri2 == 'beraturan')
                ( <span style="color: #000; font-weight: bold;">✓</span> ) 
                <span class="mb-0 ms-1" style="font-size: 0.85rem;">Beraturan</span>
            @else
                ( <span style="opacity: 0.3;">□</span> ) 
                <span class="mb-0 ms-1" style="font-size: 0.85rem; opacity: 0.7;">Beraturan</span>
            @endif
        </td>
        <td style="border: 1px solid black; padding: 8px; text-align: center;">
            @if($kiri2 == 'tidak_beraturan')
                ( <span style="color: #000; font-weight: bold;">✓</span> ) 
                <span class="mb-0 ms-1" style="font-size: 0.85rem;">Tdk Beraturan</span>
            @else
                ( <span style="opacity: 0.3;">□</span> ) 
                <span class="mb-0 ms-1" style="font-size: 0.85rem; opacity: 0.7;">Tdk Beraturan</span>
            @endif
        </td>
        <td style="border: 1px solid black; padding: 8px; text-align: center;">
            @php
                $kanan2 = $block2->Rsurface ?? '';
            @endphp
            @if($kanan2 == 'beraturan')
                ( <span style="color: #000; font-weight: bold;">✓</span> ) 
                <span class="mb-0 ms-1" style="font-size: 0.85rem;">Beraturan</span>
            @else
                ( <span style="opacity: 0.3;">□</span> ) 
                <span class="mb-0 ms-1" style="font-size: 0.85rem; opacity: 0.7;">Beraturan</span>
            @endif
        </td>
        <td style="border: 1px solid black; padding: 8px; text-align: center;">
            @if($kanan2 == 'tidak_beraturan')
                ( <span style="color: #000; font-weight: bold;">✓</span> ) 
                <span class="mb-0 ms-1" style="font-size: 0.85rem;">Tdk Beraturan</span>
            @else
                ( <span style="opacity: 0.3;">□</span> ) 
                <span class="mb-0 ms-1" style="font-size: 0.85rem; opacity: 0.7;">Tdk Beraturan</span>
            @endif
        </td>
    </tr>
    
    <!-- Baris 3 -->
    <tr>
        <td style="border: 1px solid black; padding: 8px; text-align: center;">
            <span style="display:inline-block; min-width: 65px; font-size: 0.9rem;">
                {{ $block3->titikUkurKerataan ?? '' }}
            </span> mm
        </td>
        <td style="border: 1px solid black; padding: 8px; text-align: center;">
            @php
                $kiri3 = $block3->Lsurface ?? '';
            @endphp
            @if($kiri3 == 'beraturan')
                ( <span style="color: #000; font-weight: bold;">✓</span> ) 
                <span class="mb-0 ms-1" style="font-size: 0.85rem;">Beraturan</span>
            @else
                ( <span style="opacity: 0.3;">□</span> ) 
                <span class="mb-0 ms-1" style="font-size: 0.85rem; opacity: 0.7;">Beraturan</span>
            @endif
        </td>
        <td style="border: 1px solid black; padding: 8px; text-align: center;">
            @if($kiri3 == 'tidak_beraturan')
                ( <span style="color: #000; font-weight: bold;">✓</span> ) 
                <span class="mb-0 ms-1" style="font-size: 0.85rem;">Tdk Beraturan</span>
            @else
                ( <span style="opacity: 0.3;">□</span> ) 
                <span class="mb-0 ms-1" style="font-size: 0.85rem; opacity: 0.7;">Tdk Beraturan</span>
            @endif
        </td>
        <td style="border: 1px solid black; padding: 8px; text-align: center;">
            @php
                $kanan3 = $block3->Rsurface ?? '';
            @endphp
            @if($kanan3 == 'beraturan')
                ( <span style="color: #000; font-weight: bold;">✓</span> ) 
                <span class="mb-0 ms-1" style="font-size: 0.85rem;">Beraturan</span>
            @else
                ( <span style="opacity: 0.3;">□</span> ) 
                <span class="mb-0 ms-1" style="font-size: 0.85rem; opacity: 0.7;">Beraturan</span>
            @endif
        </td>
        <td style="border: 1px solid black; padding: 8px; text-align: center;">
            @if($kanan3 == 'tidak_beraturan')
                ( <span style="color: #000; font-weight: bold;">✓</span> ) 
                <span class="mb-0 ms-1" style="font-size: 0.85rem;">Tdk Beraturan</span>
            @else
                ( <span style="opacity: 0.3;">□</span> ) 
                <span class="mb-0 ms-1" style="font-size: 0.85rem; opacity: 0.7;">Tdk Beraturan</span>
            @endif
        </td>
    </tr>
</table>


    <!-- Data Kalibrasi Section -->
                <div class="data-kalibrasi-header" style="color: #000000;">DATA KALIBRASI</div>

          <div class="table-responsive">
  <table style="font-size: 0.85rem; border-collapse: collapse; width: 100%;">
    <thead>
    <tr style="background-color: #f8f9fa;">
        <th colspan="2" class="fw-bold text-center" style="border: 2px solid black; padding: 8px;">Nilai Nominal</th>
        <th rowspan="2" class="fw-bold text-center align-middle" style="border: 2px solid black; padding: 8px; vertical-align: middle;">No. Seri</th>
        <th rowspan="2" class="fw-bold text-center align-middle" style="border: 2px solid black; padding: 8px; vertical-align: middle;">Standar yang<br>digunakan</th>
        <th rowspan="2" class="fw-bold text-center align-middle" style="border: 2px solid black; padding: 8px; vertical-align: middle;">Pengukuran</th>
        <th colspan="6" class="fw-bold text-center" style="border: 2px solid black; padding: 8px;">Penunjukan Standard</th>
    </tr>
    <tr style="background-color: #f8f9fa;">
        <th class="fw-bold text-center" style="border: 2px solid black; padding: 8px;">No</th>
        <th class="fw-bold text-center" style="border: 2px solid black; padding: 8px;">
            Unit (
            <input type="text" 
                   name="satuan_unit"                
                   value="{{ $calibration->headGaugeBlock->satuan_unit ?? 'Tidak tersedia'  }}"
                   style="width: 40px; border: none; border-bottom: 1px solid #999; text-align: center; background: transparent; font-weight: bold; display: inline-block; margin: 0 2px;" readonly>
            )
        </th>   
        <th class="fw-bold text-center" style="border: 2px solid black; padding: 8px;">1<br>Tengah</th>
        <th class="fw-bold text-center" style="border: 2px solid black; padding: 8px;">2<br>Kiri Atas</th>
        <th class="fw-bold text-center" style="border: 2px solid black; padding: 8px;">3<br>Kiri Bawah</th>
        <th class="fw-bold text-center" style="border: 2px solid black; padding: 8px;">4<br>Kanan Atas</th>
        <th class="fw-bold text-center" style="border: 2px solid black; padding: 8px;">5<br>Kanan Bawah</th>
        <th class="fw-bold text-center" style="border: 2px solid black; padding: 8px;">6<br>Tengah</th>
    </tr>
</thead>
    <tbody>
      @php
        // Ambil semua data sekali saja di luar loop
        $details = $calibration->detailGaugeBlocks ?? collect();
        // Jika tidak ada data, buat collection kosong
        if (!$details instanceof \Illuminate\Support\Collection) {
            $details = collect($details);
        }
        // Ambil data berdasarkan index (0-14 untuk 15 baris)
        $detailsArray = $details->values()->all();
      @endphp
      
      @for($no = 1; $no <= 15; $no++)
        @php
          // Ambil data berdasarkan index (no-1 karena array dimulai dari 0)
          $data = isset($detailsArray[$no-1]) ? $detailsArray[$no-1] : null;
        @endphp
        <tr>
          <!-- No -->
          <td style="border: 1px solid black; padding: 8px; text-align: center;">{{ $no }}</td>
          
          <!-- Unit ( ) -->
          <td style="border: 1px solid black; padding: 8px; text-align: center;">
            <div style="width:100%;">
              {{ $data->titikUkur ?? '' }}
            </div>
          </td>
          
          <!-- No. Seri -->
          <td style="border: 1px solid black; padding: 8px; text-align: center;">
            <div style="width:100%;">
              {{ $data->NoSeri ?? '' }}
            </div>
          </td>
          
          <!-- Standar yang digunakan -->
          <td style="border: 1px solid black; padding: 8px; text-align: center;">
            <div style="width:100%;">
              {{ $data->STD ?? '' }}
            </div>
          </td>
          
          <!-- Pengukuran: Siklus 1 dan Siklus 2 vertikal (hanya teks) -->
          <td style="border: 1px solid black; padding: 12px 8px; line-height: 2.2; text-align: center;">
            Siklus 1<br>
            Siklus 2
          </td>
          
          <!-- Penunjukan Standard: 2 nilai vertikal (Siklus 1 atas, Siklus 2 bawah) -->
          <!-- 1 Tengah -->
          <td style="border: 1px solid black; padding: 8px; text-align: center;">
            <div style="margin-bottom: 8px;">{{ $data->C1M ?? '' }}</div>
            <div>{{ $data->C2M ?? '' }}</div>
          </td>
          
          <!-- 2 Kiri Atas -->
          <td style="border: 1px solid black; padding: 8px; text-align: center;">
            <div style="margin-bottom: 8px;">{{ $data->C1UL ?? '' }}</div>
            <div>{{ $data->C2UL ?? '' }}</div>
          </td>
          
          <!-- 3 Kiri Bawah (LL) -->
          <td style="border: 1px solid black; padding: 8px; text-align: center;">
            <div style="margin-bottom: 8px;">{{ $data->C1LL ?? '' }}</div>
            <div>{{ $data->C2LL ?? '' }}</div>
          </td>
          
          <!-- 4 Kanan Atas (UR) -->
          <td style="border: 1px solid black; padding: 8px; text-align: center;">
            <div style="margin-bottom: 8px;">{{ $data->C1UR ?? '' }}</div>
            <div>{{ $data->C2UR ?? '' }}</div>
          </td>
          
          <!-- 5 Kanan Bawah (LR) -->
          <td style="border: 1px solid black; padding: 8px; text-align: center;">
            <div style="margin-bottom: 8px;">{{ $data->C1LR ?? '' }}</div>
            <div>{{ $data->C2LR ?? '' }}</div>
          </td>
          
          <!-- 6 Tengah (C) -->
          <td style="border: 1px solid black; padding: 8px; text-align: center;">
            <div style="margin-bottom: 8px;">{{ $data->C1C ?? '' }}</div>
            <div>{{ $data->C2C ?? '' }}</div>
          </td>
        </tr>
      @endfor
    </tbody>
  </table>
</div>


<!-- Attachment / Lampiran -->
<div class="container" style="margin-top: 20px;">
    <strong>Lampiran Attachment:</strong>
    <div style="margin-top: 10px;">
        @php
            $head = $calibration->headGaugeBlock;
            $attachments = [];
            $attachmentNames = [];
            
            if ($head) {
                if ($head->attachment) {
                    if (is_string($head->attachment)) {
                        $attachments = json_decode($head->attachment, true);
                    } else {
                        $attachments = $head->attachment;
                    }
                }
                if ($head->attachment_name) {
                    if (is_string($head->attachment_name)) {
                        $attachmentNames = json_decode($head->attachment_name, true);
                    } else {
                        $attachmentNames = $head->attachment_name;
                    }
                }
            }
            
            if (empty($attachmentNames) && !empty($attachments)) {
                foreach ($attachments as $attachment) {
                    $attachmentNames[] = basename($attachment);
                }
            }
        @endphp
        
        <script>
            console.log("=== DEBUG ATTACHMENT VIEW ===");
            console.log("Raw attachment string:", @json($head->attachment ?? null));
            console.log("Parsed attachments array:", @json($attachments ?? null));
            console.log("Raw attachment_name string:", @json($head->attachment_name ?? null));
            console.log("Parsed attachmentNames array:", @json($attachmentNames ?? null));
        </script>
        
        @if(!empty($attachments) && count($attachments) > 0)
            <table class="table table-bordered" style="width: 100%; border-collapse: collapse; background: #fff;">
                <thead>
                    <tr>
                        <th style="width: 10%; text-align:center; background: #f5f5f5;">No</th>
                        <th style="width: 60%; text-align:center; background: #f5f5f5;">Nama File</th>
                        <th style="width: 30%; text-align:center; background: #f5f5f5;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attachments as $index => $attachment)
                    @php
                        $fileExtension = pathinfo($attachment, PATHINFO_EXTENSION);
                        $fileExtension = strtolower($fileExtension);
                        $isImage = in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']);
                        $isPdf = $fileExtension == 'pdf';
                        $fileName = $attachmentNames[$index] ?? basename($attachment);
                        
                        // URL langsung ke public (tanpa storage)
                        $fileUrl = asset($attachment);
                    @endphp
                    <script>
                        console.log("File:", {!! json_encode($attachment) !!});
                        console.log("Extension:", {!! json_encode($fileExtension) !!});
                        console.log("isPdf:", {!! json_encode($isPdf) !!});
                    </script>
                    
                    <tr>
                        <td style="text-align:center;">{{ $loop->iteration }}</td>
                        <td>
                            @if($isImage)
                                <i class="fas fa-image text-primary me-2"></i>
                            @elseif($isPdf)
                                <i class="fas fa-file-pdf text-danger me-2"></i>
                            @else
                                <i class="fas fa-file text-secondary me-2"></i>
                            @endif
                            {{ $fileName }}
                        </td>
                        <td style="text-align:center; vertical-align: middle;">
                            @if($isImage)
                            <button type="button" class="btn btn-sm btn-primary" style="background: linear-gradient(135deg, #3b82f6, #1e40af) !important; color: #ffffff !important; border: none; padding: 5px 10px; display: inline-block !important; visibility: visible !important;" onclick="previewFile('{{ $fileUrl }}', '{{ $fileName }}')">
                                <i class="fas fa-eye me-1" style="color: #ffffff !important;"></i> Lihat Gambar
                            </button>
                            @elseif($isPdf)
                            <button type="button" class="btn btn-sm btn-primary" style="background: linear-gradient(135deg, #3b82f6, #1e40af) !important; color: #ffffff !important; border: none; padding: 5px 10px; display: inline-block !important; visibility: visible !important;" onclick="previewFile('{{ $fileUrl }}', '{{ $fileName }}')">
                                <i class="fas fa-eye me-1" style="color: #ffffff !important;"></i> Lihat PDF
                            </button>
                            @else
                            <a href="{{ $fileUrl }}" class="btn btn-sm btn-info" style="background-color: #0dcaf0 !important; color: #000000 !important; border: none; padding: 5px 10px; display: inline-block !important; visibility: visible !important;" target="_blank">
                                <i class="fas fa-download me-1" style="color: #000000 !important;"></i> Download
                            </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p style="color: #999; padding: 20px; background: #f9f9f9; border-radius: 5px;">Tidak ada lampiran</p>
        @endif
    </div>
</div>

<!-- Modal untuk preview GAMBAR -->
<div id="imageModal" style="display: none; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.9);">
    <!--<span onclick="closeImageModal()" style="position: absolute; top: 20px; right: 35px; color: white; font-size: 40px; font-weight: bold; cursor: pointer; background: rgba(255,255,255,0.2); width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; border-radius: 50%; transition: all 0.3s;">&times;</span>-->
    <div style="display: flex; justify-content: center; align-items: center; height: 100%; flex-direction: column;">
        <img id="modalImage" style="max-width: 90%; max-height: 80%; object-fit: contain;">
        <div id="modalCaption" style="margin-top: 20px; color: white; text-align: center; font-size: 16px;"></div>
        <button onclick="closeImageModal()" style="margin-top: 20px; background: white; color: black; border: none; border-radius: 5px; padding: 10px 30px; cursor: pointer; font-size: 16px; font-weight: bold;">
            <i class="fas fa-times me-2"></i> Tutup
        </button>
    </div>
</div>

<!-- Modal untuk preview PDF -->
<div id="pdfModal" style="display: none; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.9);">
    <!--<span onclick="closePdfModal()" style="position: absolute; top: 20px; right: 35px; color: white; font-size: 40px; font-weight: bold; cursor: pointer; background: rgba(255,255,255,0.2); width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; border-radius: 50%; transition: all 0.3s;">&times;</span>-->
    <div style="display: flex; justify-content: center; align-items: center; height: 100%; flex-direction: column; padding: 20px;">
        <iframe id="modalPdf" style="width: 90%; height: 85%; border: none; background: white; border-radius: 8px;"></iframe>
        <div id="pdfModalCaption" style="margin-top: 20px; color: white; text-align: center; font-size: 16px;"></div>
        <button onclick="closePdfModal()" style="margin-top: 20px; background: white; color: black; border: none; border-radius: 5px; padding: 10px 30px; cursor: pointer; font-size: 16px; font-weight: bold;">
            <i class="fas fa-times me-2"></i> Tutup
        </button>
    </div>
</div>


<style>
/* Animasi hover untuk tombol close */
#imageModal span:hover,
#pdfModal span:hover {
    background: rgba(255,255,255,0.4) !important;
    transform: scale(1.1);
}

/* Styling untuk tombol di modal */
#imageModal button:hover,
#pdfModal button:hover {
    background: #f0f0f0 !important;
    transform: translateY(-2px);
    transition: all 0.3s;
}
</style>


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

<div class="mt-5">
  <table style="font-size: 0.95rem; border-collapse: collapse; width: 100%;">
    <!-- Baris Pesan Penting (full width) -->
    <tr>
      <td colspan="4" style="border: 1px solid black; padding: 12px; text-align: center;">
        <span class="fw-bold text-danger" style="font-size: 1.1rem;">Isilah lembar data kalibrasi dengan lengkap dan jelas!</span>
      </td>
    </tr>

    <!-- Baris Utama: Alat Standar (1 row saja) + Dikalibrasi/Diperiksa -->
    <tr>
      <!-- Alat Standar -->
      <td style="border: 1px solid black; padding: 10px; width: 15%; text-align: center; vertical-align: middle; font-weight: bold;">
        Alat<br>Standar
      </td>
      <td style="border: 1px solid black; padding: 10px; width: 35%; vertical-align: middle;">
        <span class="fw-bold">{{ $calibration->alat_standar ?? 'Mesin ULM 01-600D' }}</span>
      </td>

      <!-- Dikalibrasi oleh & Diperiksa oleh -->
      <td style="border: 1px solid black; padding: 10px; width: 25%; text-align: center; vertical-align: middle;">
        Dikalibrasi<br>oleh
      </td>
      <td style="border: 1px solid black; padding: 10px; width: 25%; text-align: center; vertical-align: middle;">
        Diperiksa<br>oleh
      </td>
    </tr>

    <!-- Baris Input Nama + Metode Kalibrasi -->
    <tr>
      <!-- Metode Kalibrasi -->
      <td style="border: 1px solid black; padding: 10px; text-align: center; vertical-align: middle; font-weight: bold;">
        Metode<br>Kalibrasi
      </td>
      <td style="border: 1px solid black; padding: 10px; vertical-align: middle;">
        {{ $calibration->metode_kalibrasi ?? 'PAS-IK1102-65' }}
      </td>

      <!-- Nama Dikalibrasi oleh -->
      <td style="border: 1px solid black; padding: 10px; vertical-align: middle;">
        <label class="form-label fw-bold small d-block mb-2">Nama :</label>
        <div class="form-control form-control-sm text-center bg-light" style="min-height: 38px;">
          {{ $calibration->calibratedBy ?? '' }}
        </div>
      </td>

      <!-- Nama Diperiksa oleh -->
      <td style="border: 1px solid black; padding: 10px; vertical-align: middle;">
        <label class="form-label fw-bold small d-block mb-2">Nama :</label>
        <div class="form-control form-control-sm text-center bg-light" style="min-height: 38px;">
          {{ $calibration->verifiedBy ?? '' }}
        </div>
      </td>
    </tr>
  </table>
</div>

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
    
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function previewFile(fileUrl, fileName) {
    const ext = fileName.split('.').pop().toLowerCase();
    
    if (['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(ext)) {
        Swal.fire({
            title: fileName,
            html: `<img src="${fileUrl}" style="max-width: 100%; max-height: 70vh; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">`,
            showCloseButton: false,
            showConfirmButton: true,
            confirmButtonText: '<i class="fas fa-times me-2"></i>Tutup',
            confirmButtonColor: '#6c757d',
            width: 'auto',
            padding: '20px',
            background: '#fff',
            backdrop: 'rgba(0,0,0,0.8)',
            customClass: {
                popup: 'preview-modal',
                title: 'preview-title'
            },
            didOpen: () => {
                const style = document.createElement('style');
                style.textContent = `
                    .preview-modal { border-radius: 16px !important; }
                    .preview-title { font-size: 16px !important; color: #333 !important; word-break: break-all !important; }
                `;
                document.head.appendChild(style);
            }
        });
    } 
    else if (ext === 'pdf') {
        Swal.fire({
            title: fileName,
            html: `<iframe src="${fileUrl}" style="width: 100%; height: 70vh; border: none; border-radius: 8px;"></iframe>`,
            showCloseButton: false,
            showConfirmButton: true,
            confirmButtonText: '<i class="fas fa-times me-2"></i>Tutup',
            confirmButtonColor: '#6c757d',
            width: '90%',
            maxWidth: '1000px',
            padding: '20px',
            background: '#fff',
            backdrop: 'rgba(0,0,0,0.8)',
            customClass: {
                popup: 'preview-modal',
                title: 'preview-title'
            }
        });
    } 
    else {
        Swal.fire({
            title: 'Tidak Dapat Dipreview',
            text: `File "${fileName}" tidak dapat ditampilkan. Silakan download untuk melihat.`,
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#0d6efd',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fas fa-download me-1"></i> Download',
            cancelButtonText: 'Tutup'
        }).then((result) => {
            if (result.isConfirmed) {
                window.open(fileUrl, '_blank');
            }
        });
    }
}
</script>
</body>
</html>