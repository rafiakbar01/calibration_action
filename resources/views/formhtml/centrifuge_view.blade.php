<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Kalibrasi Centrifuge - PT. PANANJUNG ANUGRAH SOLUTION</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    .form-kalibrasi-container,
    .form-kalibrasi-container *:not(input):not(select):not(textarea):not(button) {
        color: #000000 !important;
    }
    
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

    .kondisi-input {
        border: 1px solid #000 !important;
        text-align: center;
        width: 100%;
        padding: 4px;
        background-color: #f8f9fa;
    }

    .form-check-input[type="checkbox"]:checked,
    .alat-standar-checkbox[type="checkbox"]:checked {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }

    .form-check-input[type="radio"]:checked {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='2' fill='%23fff'/%3e%3c/svg%3e") !important;
    }

    .kalibrasi-header-table {
        width: 100%;
        margin-bottom: 20px;
        border-collapse: collapse;
    }

    .kalibrasi-header-table td {
        padding: 5px;
        vertical-align: top;
    }

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

    .kalibrasi-data-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .kalibrasi-data-table td {
        padding: 8px;
        border: 2px solid #000;
        text-align: center;
        vertical-align: middle;
    }

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

    .btn-primary {
        background: linear-gradient(135deg, #3b82f6, #1e40af);
        border: none;
        color: white;
    }

    .btn-secondary {
        background: linear-gradient(135deg, #6b7280, #4b5563);
        border: none;
        color: white;
    }

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

    .alat-standar-table {
        width: 100%;
        border-collapse: collapse;
    }

    .alat-standar-table td {
        border: 1px solid #000;
        padding: 8px;
        vertical-align: middle;
    }

    .form-card {
        border: 2px solid #3b82f6;
        border-radius: 8px;
        margin-bottom: 24px;
        background: white;
    }

    .form-card-header {
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        color: white;
        padding: 12px 20px;
        border-radius: 6px 6px 0 0;
        font-weight: bold;
        font-size: 16px;
    }

    .form-card-body {
        padding: 20px;
    }

    @media print {
        .btn { display: none !important; }
        .form-card { border: 1px solid #000; break-inside: avoid; }
        .form-card-header { background: #f0f0f0 !important; color: #000 !important; }
    }
    </style>
</head>
<body>
    @php
        $jumlahForm = $calibration->jumlah_form ?? 1;
        $jumlahForm = max(1, min(4, $jumlahForm));
    @endphp

    <div class="container my-4">
        @for($formIndex = 1; $formIndex <= $jumlahForm; $formIndex++)
            @php
                // Ambil head berdasarkan form_index
                $head = \App\Models\HeadCentrifuge::where('calibration_id', $calibration->id)
                        ->where('form_index', $formIndex)
                        ->first();
                
                // Ambil details berdasarkan form_index, urutkan berdasarkan id
                $formDetails = \App\Models\DetailCentrifuge::where('calibration_id', $calibration->id)
                                ->where('form_index', $formIndex)
                                ->orderBy('id', 'asc')
                                ->get();
                
                // Buat array index 1-12 untuk memudahkan akses
                $detailByRow = [];
                $rowIndex = 1;
                foreach ($formDetails as $detail) {
                    $detailByRow[$rowIndex] = $detail;
                    $rowIndex++;
                }
                
                // Head untuk form 1
                $form1Head = \App\Models\HeadCentrifuge::where('calibration_id', $calibration->id)
                            ->where('form_index', 1)
                            ->first();
            @endphp

            <div class="form-card">
                <div class="form-card-header">
                    <i class="fas fa-file-alt me-2"></i>
                    Form Centrifuge ke-{{ $formIndex }}
                </div>
                
                <div class="form-card-body">
                    <!-- Header Table -->
                    <table class="kalibrasi-header-table">
                        <tr>
                            <td colspan="2">
                                <p style="margin: 0; font-size: 14px;">PAS-FLK52</p>
                            </td>
                            <td rowspan="5" style="text-align: center; vertical-align: middle; padding: 10px 0;">
                                <div style="display: inline-block; text-align: center;">
                                    <div style="margin-bottom: 15px;">
                                        <img src="/logo/logo_pas_basic.png" alt="Logo PT. PAS" style="width: 107px; height: 54px; display: block; margin: 0 auto;">
                                    </div>
                                    <p style="font-weight: bold; margin: 0; font-size: 15px;">PT. PANANJUNG ANUGRAH SOLUTION</p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p style="margin: 0; font-size: 14px;">LEMBAR KERJA KALIBRASI</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p style="margin: 0; font-weight: bold; font-size: 14px;">CENTRIFUGE</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="height: 10px;"></td>
                        </tr>
                        <tr>
                            <td style="width: 25%;">
                                <p style="margin: 0; font-size: 14px;">No. Sertifikat</p>
                            </td>
                            <td style="width: 45%;">
                                <p style="margin: 0; font-size: 14px; font-weight: bold;">
                                    {{ $head->certificate_id ?? $form1Head->certificate_id ?? 'N/A' }}
                                </p>
                            </td>
                        </tr>
                    </table>

                    <!-- Main Form Section -->
                    <table class="kalibrasi-main-table">
                        <tr>
                            <td style="width: 20%;"><p style="margin: 0;">Nama Alat</p></td>
                            <td colspan="3">
                                <input type="text" class="kalibrasi-input" 
                                       value="{{ $calibration->namaAlat ?? '-' }}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td><p style="margin: 0;">Merek</p></td>
                            <td colspan="3">
                                <div class="d-flex align-items-center">
                                    <input type="text" class="kalibrasi-input me-3" 
                                           value="{{ $calibration->brandAlat ?? '-' }}" readonly style="width: 60%;">
                                    <span class="me-3">Kode Alat :</span>
                                    <input type="text" class="kalibrasi-input" 
                                           value="{{ $calibration->kodeAlat ?? '-' }}" readonly style="width: 30%;">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><p style="margin: 0;">Type / No. Seri</p></td>
                            <td colspan="3">
                                <div class="d-flex align-items-center">
                                    <input type="text" class="kalibrasi-input me-3" 
                                           value="{{ $calibration->typeAlat ?? '-' }}" readonly style="width: 45%;">
                                    <span class="me-3">/</span>
                                    <input type="text" class="kalibrasi-input" 
                                           value="{{ $calibration->NoSeri ?? '-' }}" readonly style="width: 45%;">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><p style="margin: 0;">Kapasitas / Resolusi</p></td>
                            <td colspan="3">
                                <div class="d-flex align-items-center">
                                    <input type="text" class="kalibrasi-input me-3" 
                                           value="{{ $calibration->kapasitas ?? '-' }}" readonly style="width: 45%;">
                                    <span class="me-3">/</span>
                                    <input type="text" class="kalibrasi-input" 
                                           value="{{ $calibration->resolusi ?? '-' }}" readonly style="width: 45%;">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><p style="margin: 0;">Nama Pemilik</p></td>
                            <td colspan="3">
                                <input type="text" class="kalibrasi-input" 
                                       value="{{ $calibration->pemilikAlat ?? '-' }}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td><p style="margin: 0;">Tanggal Alat Masuk</p></td>
                            <td colspan="3">
                                <input type="text" class="kalibrasi-input" 
                                       value="{{ $calibration->tanggalMasuk ? \Carbon\Carbon::parse($calibration->tanggalMasuk)->format('d/m/Y') : '-' }}" 
                                       readonly>
                            </td>
                        </tr>
                        <tr>
                            <td><p style="margin: 0;">Tanggal Kalibrasi</p></td>
                            <td colspan="3">
                                <div class="d-flex align-items-center">
                                    <input type="text" class="kalibrasi-input me-3" 
                                           value="{{ $calibration->tanggalKalibrasi ? \Carbon\Carbon::parse($calibration->tanggalKalibrasi)->format('d/m/Y') : '-' }}" 
                                           readonly style="width: 45%;">
                                    <span class="me-3">Jenis Pembacaan:</span>
                                    <input type="text" class="kalibrasi-input" 
                                           value="{{ $calibration->jenisPembacaan ?? '-' }}" 
                                           readonly style="width: 45%;">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><p style="margin: 0;">Tempat Kalibrasi</p></td>
                            <td colspan="3">
                                <div class="d-flex">
                                    <div class="form-check me-5">
                                        <input class="form-check-input" type="radio" 
                                               {{ $calibration->tempatKalibrasi == 'lab.PT PAS' ? 'checked' : '' }} disabled>
                                        <label class="form-check-label">Lab. PT.PAS</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" 
                                               {{ $calibration->tempatKalibrasi == 'insitu' ? 'checked' : '' }} disabled>
                                        <label class="form-check-label">Insitu</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><p style="margin: 0;">Lokasi PT</p></td>
                            <td colspan="3">
                                <input type="text" class="kalibrasi-input" 
                                       value="{{ $calibration->lokasiPT ?? '-' }}" readonly>
                            </td>
                        </tr>
                    </table>

                    <!-- Fungsi Komponen Lainnya & Kondisi Kalibrasi -->
                    <div class="row mt-4">
                        <div class="col-md-6 mb-4">
                            <div class="kalibrasi-section-header">Fungsi Komponen Lainnya</div>
                            
                            <div class="d-flex justify-content-center align-items-center mb-4" style="gap: 60px;">
                                <div class="text-center">
                                    <span class="fw-bold d-block mb-2">Ok</span>
                                    <input type="radio" name="kondisiAlat_{{ $formIndex }}" value="ok" class="form-check-input"
                                           {{ $calibration->kondisiAlat == 'ok' ? 'checked' : '' }} disabled>
                                </div>
                                <div class="text-center">
                                    <span class="fw-bold d-block mb-2">Rusak</span>
                                    <input type="radio" name="kondisiAlat_{{ $formIndex }}" value="rusak" class="form-check-input"
                                           {{ $calibration->kondisiAlat == 'rusak' ? 'checked' : '' }} disabled>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center">
                                <span class="fw-bold me-3" style="min-width: 100px;">Keterangan :</span>
                                <div style="flex: 1;">
                                    <input type="text" class="kalibrasi-input" 
                                           value="{{ $calibration->keterangan ?? '-' }}" readonly>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="kalibrasi-section-header">Kondisi Kalibrasi</div>
                            
                            <table class="table table-bordered">
                                <tr>
                                    <td class="table-secondary fw-bold" style="width: 30%;"></td>
                                    <td class="table-secondary fw-bold text-center">Awal</td>
                                    <td class="table-secondary fw-bold text-center">Tengah</td>
                                    <td class="table-secondary fw-bold text-center">Akhir</td>
                                </tr>
                                <tr>
                                    <td class="bg-light fw-bold">Suhu (&deg;C)</td>
                                    <td><input type="text" class="kondisi-input" value="{{ $calibration->RT_condition1 ?? '-' }}" readonly></td>
                                    <td><input type="text" class="kondisi-input" value="{{ $calibration->RT_condition2 ?? '-' }}" readonly></td>
                                    <td><input type="text" class="kondisi-input" value="{{ $calibration->RT_condition3 ?? '-' }}" readonly></td>
                                </tr>
                                <tr>
                                    <td class="bg-light fw-bold">RH (%)</td>
                                    <td><input type="text" class="kondisi-input" value="{{ $calibration->RH_condition1 ?? '-' }}" readonly></td>
                                    <td><input type="text" class="kondisi-input" value="{{ $calibration->RH_condition2 ?? '-' }}" readonly></td>
                                    <td><input type="text" class="kondisi-input" value="{{ $calibration->RH_condition3 ?? '-' }}" readonly></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                  
                                      <!-- DATA KALIBRASI -->
                    <div class="data-kalibrasi-header">DATA KALIBRASI</div>
                    
                    <table class="kalibrasi-data-table" style="width: 100%; border-collapse: collapse; table-layout: fixed;">
                        <tr>
                            <td colspan="2" style="width: 16%; font-weight: bold; text-align:center; border: 2px solid #000; padding: 10px;">Nominal / Setpoint UUT</td>
                            <td colspan="5" style="width: 42%; font-weight: bold; text-align:center; border: 2px solid #000; padding: 10px;">Pembacaan Standar (rpm)</td>
                            <td colspan="3" rowspan="2" style="width: 42%; font-weight: bold; text-align:center; vertical-align:middle; border: 2px solid #000; padding: 10px;">Resolusi Alat</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align:center; border: 2px solid #000; padding: 10px;">rpm</td>
                            <td style="text-align:center; border: 2px solid #000; padding: 10px;">1</td>
                            <td style="text-align:center; border: 2px solid #000; padding: 10px;">2</td>
                            <td style="text-align:center; border: 2px solid #000; padding: 10px;">3</td>
                            <td style="text-align:center; border: 2px solid #000; padding: 10px;">4</td>
                            <td style="text-align:center; border: 2px solid #000; padding: 10px;">5</td>
                        </tr>

                        @for($row = 1; $row <= 12; $row++)
                            @php
                                $detail = isset($detailByRow[$row]) ? $detailByRow[$row] : null;
                            @endphp
                            <tr>
                                <td colspan="2" style="text-align:center; border: 2px solid #000; padding: 10px; height: 45px;">
                                    {{ $detail->nominalRPM ?? '' }}
                                </td>
                                <td style="text-align:center; border: 2px solid #000; padding: 10px; height: 45px;">
                                    {{ $detail->STD1 ?? '' }}
                                </td>
                                <td style="text-align:center; border: 2px solid #000; padding: 10px; height: 45px;">
                                    {{ $detail->STD2 ?? '' }}
                                </td>
                                <td style="text-align:center; border: 2px solid #000; padding: 10px; height: 45px;">
                                    {{ $detail->STD3 ?? '' }}
                                </td>
                                <td style="text-align:center; border: 2px solid #000; padding: 10px; height: 45px;">
                                    {{ $detail->STD4 ?? '' }}
                                </td>
                                <td style="text-align:center; border: 2px solid #000; padding: 10px; height: 45px;">
                                    {{ $detail->STD5 ?? '' }}
                                </td>
                                <td colspan="3" style="text-align:center; border: 2px solid #000; padding: 10px; height: 45px;">
                                    {{ $detail->resolusi ?? '' }}
                                </td>
                            </tr>
                        @endfor
                    </table>
                                       <!-- Footer Section -->
                    <div class="data-complete-section">
                        <span class="data-complete-text">Data telah diisi dengan lengkap dan jelas!</span>
                    </div>

                    <!-- ALAT STANDAR + METODE KALIBRASI + TTD DALAM SATU TABLE -->
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
                        }
                        .signature-col {
                            width: 18%;
                            font-weight: bold;
                            background-color: #f8f8f8;
                            text-align: center;
                        }
                        .name-input {
                            width: 90%;
                            border: none;
                            border-bottom: 1px solid #000;
                            background: transparent;
                            text-align: center;
                            font-size: 10pt;
                            outline: none;
                        }
                        .ttd-row {
                            height: 50px;
                        }
                    </style>

                    <!-- SATU TABLE UNTUK SEMUA (Alat Standar + Metode Kalibrasi + TTD) -->
                    <table class="kalibrasi-main-table" style="width:100%; border-collapse: collapse;">
                        <!-- Baris 1: Alat Standar + Header TTD -->
                        <tr>
                            <td rowspan="2" colspan="2" class="label-col">Alat Standar</td>
                            <td rowspan="2" colspan="4" class="content-col">
                                Tachometer CEM AT-8 (200302615)
                            </td>
                            <td colspan="2" class="signature-col">Dikalibrasi oleh</td>
                            <td colspan="2" class="signature-col">Diperiksa oleh</td>
                        </tr>
                        
                        <!-- Baris 2: Baris kosong untuk TTD -->
                        <tr>
                            <td colspan="2" class="ttd-row"></td>
                            <td colspan="2" class="ttd-row"></td>
                        </tr>
                        
                        <!-- Baris 3: Metode Kalibrasi + Header TTD -->
                        <tr>
                            <td rowspan="2" colspan="2" class="label-col">Metode Kalibrasi</td>
                            <td rowspan="2" colspan="4" class="content-col">
                                {{ $form1Head->calibrationMethod ?? 'PAS-IK1102-52' }}
                            </td>
                            <td colspan="2">TTD :</td>
                            <td colspan="2">TTD :</td>
                        </tr>
                        
                        <!-- Baris 4: Nama Calibrated By dan Verified By -->
                        <tr>
                            <td colspan="2">
                                Nama: <input type="text" class="name-input" value="{{ $calibration->calibratedBy ?? '-' }}" readonly>
                            </td>
                            <td colspan="2">
                                Nama: <input type="text" class="name-input" value="{{ $calibration->verifiedBy ?? '-' }}" readonly>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        @endfor

        <!-- Action Buttons Section -->
        <div class="row mt-5">
            <div class="col-12 text-center">
                <a href="{{ url()->previous() }}" class="btn btn-secondary btn-lg">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>