<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Kalibrasi Caliper - PT. PANANJUNG ANUGRAH SOLUTION</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    /* CSS SAMA SEPERTI INSIDE MICROMETER */
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
        $details = $calibration->detailCalipers ?? collect();
        $adds = $calibration->addCaliper ?? collect();
        $heads = $calibration->headCaliper ?? collect();
    @endphp

    <div class="container my-4" style="width: 95%; max-width: 1600px;">
        @for($formIndex = 1; $formIndex <= $jumlahForm; $formIndex++)
            @php
                // Gunakan relasi per form untuk head
                 $head = $calibration->{'headCaliperForm' . $formIndex};
                 $form1Head = $calibration->headCaliperForm1;
                
                // Ambil DETAILS berdasarkan form_index
                $formDetails = $details->where('form_index', $formIndex)->sortBy('id');
                $formAdd = $calibration->{'addCaliperForm' . $formIndex};
            @endphp

            <div class="form-card">
                <div class="form-card-header">
                    <i class="fas fa-file-alt me-2"></i>
                    Form Caliper ke-{{ $formIndex }}
                </div>
                
                <div class="form-card-body">
                    <!-- Header Table -->
                    <table class="kalibrasi-header-table">
                        <tr>
                            <td colspan="2">
                                <p style="margin: 0; font-size: 14px;">PAS-FLK03</p>
                            </td>
                            <td rowspan="5" style="text-align: center; vertical-align: middle; padding: 10px 0;">
                                <div style="display: inline-block; text-align: center;">
                                    <div style="margin-bottom: 15px;">
                                        <img src="/logo/logo_pas_basic.png" alt="Logo PT. PAS" style="width: 107px; height: 54px; display: block; margin: 0 auto;">
                                    </div>
                                    <p style="font-weight: bold; margin: 0; font-size: 15px;">PT. PANANJUNG ANUGRAH SOLUTION</p>
                                </div>
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
                                <p style="margin: 0; font-weight: bold; font-size: 14px;">CALIPER</p>
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
                            </div>
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
                                    <td class="bg-light fw-bold">Suhu (°C)</td>
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

                    <!-- DATA KALIBRASI Section -->
                    <div class="data-kalibrasi-header">DATA KALIBRASI</div>
                    
                    <!-- BAGIAN 1: PEMERIKSAAN KESEJAJARAN MUKA UKUR EKSTERNAL -->
                    <div class="mb-3">
                        <ol type="1" style="margin:0pt; padding-left:0pt">
                            <li class="ListParagraph" style="text-indent:0pt; font-size:11pt; font-weight:bold">
                                <span>Pemeriksaan Kesejajaran Muka Ukur Eksternal</span>
                            </li>
                        </ol>
                        <table cellspacing="0" cellpadding="0" class="TableNormal" style="margin-left:15.48pt; border:0.75pt solid #000000; border-collapse:collapse; width:100%">
                            <tr style="height:10.05pt">
                                <td style="width:25%; border:0.75pt solid #000000; vertical-align:top; background-color:#bebebe">
                                    <p style="text-align:center; line-height:9.05pt; padding:4pt">
                                        <span style="font-family:Arial; font-size:9.5pt; font-weight:bold">Titik Ukur</span>
                                    </p>
                                </td>
                                <td style="width:25%; border:0.75pt solid #000000; vertical-align:top; background-color:#bebebe">
                                    <p style="text-align:center; line-height:9.05pt; padding:4pt">
                                        <span style="font-family:Arial; font-size:9.5pt; font-weight:bold">Atas / Pangkal</span>
                                    </p>
                                </td>
                                <td style="width:25%; border:0.75pt solid #000000; vertical-align:top; background-color:#bebebe">
                                    <p style="text-align:center; line-height:9.05pt; padding:4pt">
                                        <span style="font-family:Arial; font-size:9.5pt; font-weight:bold">Tengah</span>
                                    </p>
                                </td>
                                <td style="width:25%; border:0.75pt solid #000000; vertical-align:top; background-color:#bebebe">
                                    <p style="text-align:center; line-height:9.05pt; padding:4pt">
                                        <span style="font-family:Arial; font-size:9.5pt; font-weight:bold">Bawah / Ujung</span>
                                    </p>
                                </td>
                            </tr>
                            <tr style="height:12.65pt">
                                <td style="width:25%; border:0.75pt solid #000000; vertical-align:top; padding:4pt; position:relative">
                                    <input type="text" value="{{ $formAdd->titikUkurKesajajaran ?? '' }}" readonly 
                                           style="width: 100%; height: 100%; border: none; text-align: center; font-size: 9.5pt; background: transparent; padding: 2px;">
                                    <span style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); font-size: 9.5pt; color: #666;">mm</span>
                                </td>
                                <td style="width:25%; border:0.75pt solid #000000; vertical-align:top; padding:4pt">
                                    <input type="text" value="{{ $formAdd->kesejajaranAwal ?? '' }}" readonly 
                                           style="width: 100%; height: 100%; border: none; text-align: center; font-size: 9.5pt; background: transparent; padding: 2px;">
                                </td>
                                <td style="width:25%; border:0.75pt solid #000000; vertical-align:top; padding:4pt">
                                    <input type="text" value="{{ $formAdd->kesejajaranTengah ?? '' }}" readonly 
                                           style="width: 100%; height: 100%; border: none; text-align: center; font-size: 9.5pt; background: transparent; padding: 2px;">
                                </td>
                                <td style="width:25%; border:0.75pt solid #000000; vertical-align:top; padding:4pt">
                                    <input type="text" value="{{ $formAdd->kesejajaranAkhir ?? '' }}" readonly 
                                           style="width: 100%; height: 100%; border: none; text-align: center; font-size: 9.5pt; background: transparent; padding: 2px;">
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- BAGIAN 2: PENGUKURAN DALAM DENGAN UJUNG PISAU BERSILANG -->
                    <div class="mb-3">
                        <ol start="2" type="1" style="margin:0pt; padding-left:0pt">
                            <li class="ListParagraph" style="margin-top:4.85pt; text-indent:0pt; font-size:11pt; font-weight:bold">
                                <span>Pengukuran Dalam Dengan Ujung Pisau Bersilang</span>
                            </li>
                        </ol>
                        <table cellspacing="0" cellpadding="0" class="TableNormal" style="margin-left:15.48pt; border:0.75pt solid #000000; border-collapse:collapse; width:100%">
                            <tr style="height:12pt">
                                <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                                    <p style="text-align:center; line-height:11pt; padding:6pt">
                                        <span style="font-family:Arial; font-size:10pt; font-weight:bold">Titik Ukur</span>
                                    </p>
                                </td>
                                <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                                    <p style="text-align:center; line-height:11pt; padding:6pt">
                                        <span style="font-family:Arial; font-size:10pt; font-weight:bold">Pembacaan-1</span>
                                    </p>
                                </td>
                                <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                                    <p style="text-align:center; line-height:11pt; padding:6pt">
                                        <span style="font-family:Arial; font-size:10pt; font-weight:bold">Pembacaan-2</span>
                                    </p>
                                </td>
                                <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                                    <p style="text-align:center; line-height:11pt; padding:6pt">
                                        <span style="font-family:Arial; font-size:10pt; font-weight:bold">Pembacaan-3</span>
                                    </p>
                                </td>
                            </tr>
                            <tr style="height:16pt">
                                <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt; position: relative;">
                                    <input type="text" value="{{ $formAdd->pengukuranDalamPisauBersilang ?? '' }}" readonly 
                                           style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; background: transparent; padding: 4px;">
                                    <span style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); font-size: 9pt; color: #666; font-family: Arial;">mm</span>
                                </td>
                                <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                                    <input type="text" value="{{ $formAdd->pembacaan1 ?? '' }}" readonly 
                                           style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; background: transparent; padding: 4px;">
                                </td>
                                <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                                    <input type="text" value="{{ $formAdd->pembacaan2 ?? '' }}" readonly 
                                           style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; background: transparent; padding: 4px;">
                                </td>
                                <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                                    <input type="text" value="{{ $formAdd->pembacaan3 ?? '' }}" readonly 
                                           style="width: 100%; height: 100%; border: none; text-align: center; font-size: 10pt; background: transparent; padding: 4px;">
                                </td>
                            </tr>
                        </table>
                    </div>

                <!-- BAGIAN 3: PENGUKURAN OUTSIDE -->
<div class="mb-3">
    <ol start="3" type="1" style="margin:0pt; padding-left:0pt">
        <li class="ListParagraph" style="margin-top:4.85pt; text-indent:0pt; font-size:11pt; font-weight:bold">
            <span>Pengukuran Outside</span>
        </li>
    </ol>
    
    @php
        // LANGSUNG AMBIL DATA OUTSIDE DARI DATABASE (data yang memiliki nilai outside)
        $outsideRows = $formDetails->filter(function($item) {
            return !is_null($item->outside01) || !is_null($item->outside02) || 
                   !is_null($item->outside03) || !is_null($item->outside04) || 
                   !is_null($item->outside05);
        });
        
        // Jika tidak ada data outside, ambil semua formDetails
        if ($outsideRows->count() == 0) {
            $outsideRows = $formDetails;
        }
        
        $outsideCount = $outsideRows->count();
        
        // DEBUG
        echo "<!-- OUTSIDE DEBUG: total formDetails = " . $formDetails->count() . " -->";
        echo "<!-- OUTSIDE DEBUG: outsideRows count = " . $outsideCount . " -->";
    @endphp
    
    <table cellspacing="0" cellpadding="0" class="TableNormal" style="margin-left:15.48pt; border:0.75pt solid #000000; border-collapse:collapse; width:100%">
        <tr style="height:12pt">
            <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <div style="text-align:center; padding:6pt">
                    <div style="margin-bottom: 8px; line-height:11pt;">
                        <span style="font-family:Arial; font-size:10pt; font-weight:bold">Titik Ukur</span>
                    </div>
                    <div>
                        <span style="font-family:Arial; font-size:9pt; font-weight:bold">Unit (</span>
                        <span style="font-family:Arial; font-size:9pt;">{{ $head->satuan_unit_outside ?? ' ' }}</span>
                        <span style="font-family:Arial; font-size:9pt; font-weight:bold">)</span>
                    </div>
                </div>
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Penunjukan 1</span>
                </p>
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Penunjukan 2</span>
                </p>
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Penunjukan 3</span>
                </p>
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Penunjukan 4</span>
                </p>
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Penunjukan 5</span>
                </p>
            </td>
        </tr>
        
        @foreach($outsideRows as $detail)
            @php
                $titikUkur = $detail->titikUkur ?? '';
                $outside01 = $detail->outside01 ?? '';
                $outside02 = $detail->outside02 ?? '';
                $outside03 = $detail->outside03 ?? '';
                $outside04 = $detail->outside04 ?? '';
                $outside05 = $detail->outside05 ?? '';
            @endphp
            <tr style="height:16pt">
                <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text" value="{{ $titikUkur }}" readonly 
                           style="width:100%; height:100%; border:none; text-align:center; font-size:10pt; background:transparent; padding:4px;">
                </td>
                <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text" value="{{ $outside01 }}" readonly 
                           style="width:100%; height:100%; border:none; text-align:center; font-size:10pt; background:transparent; padding:4px;">
                </td>
                <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text" value="{{ $outside02 }}" readonly 
                           style="width:100%; height:100%; border:none; text-align:center; font-size:10pt; background:transparent; padding:4px;">
                </td>
                <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text" value="{{ $outside03 }}" readonly 
                           style="width:100%; height:100%; border:none; text-align:center; font-size:10pt; background:transparent; padding:4px;">
                </td>
                <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text" value="{{ $outside04 }}" readonly 
                           style="width:100%; height:100%; border:none; text-align:center; font-size:10pt; background:transparent; padding:4px;">
                </td>
                <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text" value="{{ $outside05 }}" readonly 
                           style="width:100%; height:100%; border:none; text-align:center; font-size:10pt; background:transparent; padding:4px;">
                </td>
            </tr>
        @endforeach
        
        @if($outsideCount == 0)
            <tr style="height:16pt">
                <td colspan="6" style="border:0.75pt solid #000000; vertical-align:middle; padding:6pt; text-align:center">
                    <span style="font-family:Arial; font-size:10pt; color:#999;">Tidak ada data Outside</span>
                </td>
            </tr>
        @endif
    </table>
</div>

<!-- BAGIAN 4: PENGUKURAN INSIDE -->
<div class="mb-3">
    <ol start="4" type="1" style="margin:0pt; padding-left:0pt">
        <li class="ListParagraph" style="margin-top:4.85pt; text-indent:0pt; font-size:11pt; font-weight:bold">
            <span>Pengukuran Inside</span>
        </li>
    </ol>
    
    @php
        // LANGSUNG AMBIL DATA INSIDE DARI DATABASE (data yang memiliki nilai inside)
        $insideRows = $formDetails->filter(function($item) {
            return !is_null($item->inside01) || !is_null($item->inside02) || 
                   !is_null($item->inside03) || !is_null($item->inside04) || 
                   !is_null($item->inside05);
        });
        
        $insideCount = $insideRows->count();
        
        // DEBUG
        echo "<!-- INSIDE DEBUG: insideRows count = " . $insideCount . " -->";
    @endphp
    
    <table cellspacing="0" cellpadding="0" class="TableNormal" style="margin-left:15.48pt; border:0.75pt solid #000000; border-collapse:collapse; width:100%">
        <tr style="height:12pt">
            <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <div style="text-align:center; padding:6pt">
                    <div style="margin-bottom: 8px; line-height:11pt;">
                        <span style="font-family:Arial; font-size:10pt; font-weight:bold">Titik Ukur</span>
                    </div>
                    <div>
                        <span style="font-family:Arial; font-size:9pt; font-weight:bold">Unit (</span>
                        <span style="font-family:Arial; font-size:9pt;">{{ $head->satuan_unit_inside ?? ' ' }}</span>
                        <span style="font-family:Arial; font-size:9pt; font-weight:bold">)</span>
                    </div>
                </div>
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Penunjukan 1</span>
                </p>
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Penunjukan 2</span>
                </p>
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Penunjukan 3</span>
                </p>
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Penunjukan 4</span>
                </p>
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Penunjukan 5</span>
                </p>
            </td>
        </tr>
        
        @foreach($insideRows as $detail)
            @php
                $titikUkur = $detail->titikUkur ?? '';
                $inside01 = $detail->inside01 ?? '';
                $inside02 = $detail->inside02 ?? '';
                $inside03 = $detail->inside03 ?? '';
                $inside04 = $detail->inside04 ?? '';
                $inside05 = $detail->inside05 ?? '';
            @endphp
            <tr style="height:16pt">
                <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text" value="{{ $titikUkur }}" readonly 
                           style="width:100%; height:100%; border:none; text-align:center; font-size:10pt; background:transparent; padding:4px;">
                </td>
                <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text" value="{{ $inside01 }}" readonly 
                           style="width:100%; height:100%; border:none; text-align:center; font-size:10pt; background:transparent; padding:4px;">
                </td>
                <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text" value="{{ $inside02 }}" readonly 
                           style="width:100%; height:100%; border:none; text-align:center; font-size:10pt; background:transparent; padding:4px;">
                </td>
                <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text" value="{{ $inside03 }}" readonly 
                           style="width:100%; height:100%; border:none; text-align:center; font-size:10pt; background:transparent; padding:4px;">
                </td>
                <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text" value="{{ $inside04 }}" readonly 
                           style="width:100%; height:100%; border:none; text-align:center; font-size:10pt; background:transparent; padding:4px;">
                </td>
                <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text" value="{{ $inside05 }}" readonly 
                           style="width:100%; height:100%; border:none; text-align:center; font-size:10pt; background:transparent; padding:4px;">
                </td>
            </tr>
        @endforeach
        
        @if($insideCount == 0)
            <tr style="height:16pt">
                <td colspan="6" style="border:0.75pt solid #000000; vertical-align:middle; padding:6pt; text-align:center">
                    <span style="font-family:Arial; font-size:10pt; color:#999;">Tidak ada data Inside</span>
                </td>
            </tr>
        @endif
    </table>
</div>

<!-- BAGIAN 5: PENGUKURAN DEPTH -->
<div class="mb-3">
    <ol start="5" type="1" style="margin:0pt; padding-left:0pt">
        <li class="ListParagraph" style="margin-top:4.85pt; text-indent:0pt; font-size:11pt; font-weight:bold">
            <span>Pengukuran Depth</span>
        </li>
    </ol>
    
    @php
        // LANGSUNG AMBIL DATA DEPTH DARI DATABASE (data yang memiliki nilai depth atau kode standar)
        $depthRows = $formDetails->filter(function($item) {
            return !is_null($item->depth01) || !is_null($item->depth02) || 
                   !is_null($item->depth03) || !is_null($item->depth04) || 
                   !is_null($item->depth05) || !is_null($item->KodeStandarKiri) ||
                   !is_null($item->kodeStandarKiri) || !is_null($item->KodeStandarKanan) ||
                   !is_null($item->kodeStandarKanan);
        });
        
        $depthCount = $depthRows->count();
        
        // DEBUG
        echo "<!-- DEPTH DEBUG: depthRows count = " . $depthCount . " -->";
    @endphp
    
    <table cellspacing="0" cellpadding="0" class="TableNormal" style="margin-left:15.48pt; border:0.75pt solid #000000; border-collapse:collapse; width:100%">
        <!-- HEADER ROW 1 -->
        <tr style="height:12pt">
            <td style="width:20%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <div style="text-align:center; padding:6pt">
                    <div style="margin-bottom: 8px; line-height:11pt;">
                        <span style="font-family:Arial; font-size:10pt; font-weight:bold">Titik Ukur</span>
                    </div>
                    <div>
                        <span style="font-family:Arial; font-size:9pt; font-weight:bold">Unit (</span>
                        <span style="font-family:Arial; font-size:9pt;">{{ $head->satuan_unit_depth ?? ' ' }}</span>
                        <span style="font-family:Arial; font-size:9pt; font-weight:bold">)</span>
                    </div>
                </div>
            </td>
            <td colspan="2" style="width:20%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Kode Standar yang Digunakan</span>
                </p>
            </td>
            <td colspan="5" style="width:60%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Penunjukan Alat</span>
                </p>
            </td>
        </tr>
        
        <!-- HEADER ROW 2 -->
        <tr style="height:12pt">
            <td style="width:20%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Nilai Nominal</span>
                </p>
            </td>
            <td style="width:10%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:9.5pt; font-weight:bold">Kiri</span>
                </p>
            </td>
            <td style="width:10%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:9.5pt; font-weight:bold">Kanan</span>
                </p>
            </td>
            <td style="width:12%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:9.5pt; font-weight:bold">1</span>
                </p>
             </td>
            <td style="width:12%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:9.5pt; font-weight:bold">2</span>
                </p>
             </td>
            <td style="width:12%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:9.5pt; font-weight:bold">3</span>
                </p>
             </td>
            <td style="width:12%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:9.5pt; font-weight:bold">4</span>
                </p>
             </td>
            <td style="width:12%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:9.5pt; font-weight:bold">5</span>
                </p>
             </td>
         </tr>
        
        @foreach($depthRows as $detail)
            @php
                $titikUkur = $detail->titikUkur ?? '';
                $kodeStandarKiri = $detail->KodeStandarKiri ?? $detail->kodeStandarKiri ?? $detail->kodeStandardKiri ?? '';
                $kodeStandarKanan = $detail->KodeStandarKanan ?? $detail->kodeStandarKanan ?? $detail->kodeStandardKanan ?? '';
                $depth01 = $detail->depth01 ?? '';
                $depth02 = $detail->depth02 ?? '';
                $depth03 = $detail->depth03 ?? '';
                $depth04 = $detail->depth04 ?? '';
                $depth05 = $detail->depth05 ?? '';
            @endphp
            <tr style="height:16pt">
                <!-- Nilai Nominal -->
                <td style="width:20%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text" value="{{ $titikUkur }}" readonly 
                           style="width:100%; height:100%; border:none; text-align:center; font-size:10pt; background:transparent; padding:4px;">
                </td>
                
                <!-- Kode Standar Kiri -->
                <td style="width:10%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text" value="{{ $kodeStandarKiri }}" readonly 
                           style="width:100%; height:100%; border:none; text-align:center; font-size:10pt; background:transparent; padding:4px;">
                </td>
                
                <!-- Kode Standar Kanan -->
                <td style="width:10%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text" value="{{ $kodeStandarKanan }}" readonly 
                           style="width:100%; height:100%; border:none; text-align:center; font-size:10pt; background:transparent; padding:4px;">
                </td>
                
                <!-- Penunjukan 1 -->
                <td style="width:12%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text" value="{{ $depth01 }}" readonly 
                           style="width:100%; height:100%; border:none; text-align:center; font-size:10pt; background:transparent; padding:4px;">
                </td>
                
                <!-- Penunjukan 2 -->
                <td style="width:12%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text" value="{{ $depth02 }}" readonly 
                           style="width:100%; height:100%; border:none; text-align:center; font-size:10pt; background:transparent; padding:4px;">
                </td>
                
                <!-- Penunjukan 3 -->
                <td style="width:12%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text" value="{{ $depth03 }}" readonly 
                           style="width:100%; height:100%; border:none; text-align:center; font-size:10pt; background:transparent; padding:4px;">
                </td>
                
                <!-- Penunjukan 4 -->
                <td style="width:12%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text" value="{{ $depth04 }}" readonly 
                           style="width:100%; height:100%; border:none; text-align:center; font-size:10pt; background:transparent; padding:4px;">
                </td>
                
                <!-- Penunjukan 5 -->
                <td style="width:12%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text" value="{{ $depth05 }}" readonly 
                           style="width:100%; height:100%; border:none; text-align:center; font-size:10pt; background:transparent; padding:4px;">
                </td>
             </td>
        @endforeach
        
        @if($depthCount == 0)
            <tr style="height:16pt">
                <td colspan="8" style="border:0.75pt solid #000000; vertical-align:middle; padding:6pt; text-align:center">
                    <span style="font-family:Arial; font-size:10pt; color:#999;">Tidak ada data Depth</span>
                </td>
            </tr>
        @endif
     </table>
</div>
                    <!-- Footer Section -->
                    <div class="data-complete-section">
                        <span class="data-complete-text">Data telah diisi dengan lengkap dan jelas!</span>
                    </div>

                    <!-- ALAT STANDAR + CHECKBOX (sesuai head form masing-masing) -->
                    @php
                        $currentHead = $head ?? $form1Head;
                        $standardVal = $currentHead->standard ?? '';
                    @endphp
                    <table class="alat-standar-table">
                        <tr>
                            <td rowspan="5" style="width:20%; text-align:center; font-weight:bold; font-size:14px;">
                                Alat Standar
                            </td>
                            <td style="width:5%; text-align:center;">
                                <input type="checkbox" class="alat-standar-checkbox" 
                                    {{ str_contains($standardVal, 'Caliper Checker D.001') ? 'checked' : '' }} disabled>
                            </td>
                            <td colspan="2">Caliper Checker D.001</td>
                            <td rowspan="5" style="width:20%; text-align:center;">Dikalibrasi<br>oleh</td>
                            <td rowspan="5" style="width:20%; text-align:center;">Diperiksa<br>oleh</td>
                        </tr>
                        <tr>
                            <td style="text-align:center;">
                                <input type="checkbox" class="alat-standar-checkbox" 
                                    {{ str_contains($standardVal, 'Caliper Checker D.001B') ? 'checked' : '' }} disabled>
                              </td>
                            <td colspan="2">Caliper Checker D.001B</td>
                        </tr>
                        <tr>
                            <td style="text-align:center;">
                                <input type="checkbox" class="alat-standar-checkbox" 
                                    {{ str_contains($standardVal, 'Gauge Block Set Grade 0') ? 'checked' : '' }} disabled>
                              </td>
                            <td colspan="2">Gauge Block Set Grade 0</td>
                        </tr>
                        <tr>
                            <td style="text-align:center;">
                                <input type="checkbox" class="alat-standar-checkbox" 
                                    {{ str_contains($standardVal, 'Pin Gauge 15 mm') ? 'checked' : '' }} disabled>
                              </td>
                            <td colspan="2">Pin Gauge 15 mm</td>
                        </tr>
                        <tr>
                            <td style="text-align:center;">
                                <input type="checkbox" class="alat-standar-checkbox" 
                                    {{ str_contains($standardVal, 'Ring Gauge 5 mm') ? 'checked' : '' }} disabled>
                              </td>
                            <td colspan="2">Ring Gauge 5 mm</td>
                        </tr>
                        
                        <!-- Alat standar tambahan (selain default) -->
                        @php
                            $standardArray = [];
                            if (!empty($standardVal)) {
                                $standardArray = explode(',', $standardVal);
                                $standardArray = array_map('trim', $standardArray);
                            }
                            $defaultTools = ['Caliper Checker D.001', 'Caliper Checker D.001B', 'Gauge Block Set Grade 0', 'PIN Gauge 15 mm', 'Pin Gauge 15 mm', 'Ring Gauge 5 mm'];
                            $additionalTools = array_filter($standardArray, function($tool) use ($defaultTools) {
                                $isDefault = false;
                                foreach ($defaultTools as $default) {
                                    if (str_contains($tool, $default)) {
                                        $isDefault = true;
                                        break;
                                    }
                                }
                                return !$isDefault && !empty($tool);
                            });
                        @endphp
                        
                        @foreach($additionalTools as $tool)
                            <tr style="height:13.5pt">
                                <td style="text-align:center;">
                                    <input type="checkbox" class="alat-standar-checkbox" checked disabled>
                                </td>
                                <td colspan="2">{{ $tool }}</td>
                            </tr>
                        @endforeach
                        
                        <tr>
                            <td style="font-weight:bold;">Metode Kalibrasi</td>
                            <td colspan="3">{{ $form1Head->calibrationMethod ?? 'PAS-IK1102-03 (JIS B 7518:2023 (JMA/JSA); SNSU PK.P-02:2020)' }}</td>
                            <td><input type="text" class="kalibrasi-input" value="{{ $calibration->calibratedBy ?? '-' }}" readonly></td>
                            <td><input type="text" class="kalibrasi-input" value="{{ $calibration->verifiedBy ?? '-' }}" readonly></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="3"></td>
                            <td>TTD :</td>
                            <td>TTD :</td>
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