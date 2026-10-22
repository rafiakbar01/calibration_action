<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Kalibrasi - PT. PANANJUNG ANUGRAH SOLUTION</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    /* CSS SAMA SEPERTI SEBELUMNYA */
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
    $allDetails = $calibration->detailMikropipetDispensets ?? collect();
    
    // Kelompokkan berdasarkan form_index
    $detailsByForm = [];
    foreach ($allDetails as $detail) {
        $formIdx = $detail->form_index ?? 1;
        if (!isset($detailsByForm[$formIdx])) {
            $detailsByForm[$formIdx] = [];
        }
        $detailsByForm[$formIdx][] = $detail;
    }
    
    // Urutkan berdasarkan ID untuk setiap form (gunakan usort karena ini array)
    foreach ($detailsByForm as $formIdx => $details) {
        usort($detailsByForm[$formIdx], function($a, $b) {
            return $a->id <=> $b->id;
        });
    }
    
    $form1Head = $calibration->headMikropipetDispensetForm1 ?? $calibration->headMikropipetDispenset;
    
    \Log::info('=== DETAILS MAPPING ===');
    for ($i = 1; $i <= $jumlahForm; $i++) {
        $details = $detailsByForm[$i] ?? [];
        \Log::info("Form {$i}: " . count($details) . " details");
        foreach ($details as $idx => $d) {
            \Log::info("  [$idx] titikUkur={$d->titikUkur}, m0={$d->m0}");
        }
    }
@endphp

<div class="container my-4">
    @for($formIndex = 1; $formIndex <= $jumlahForm; $formIndex++)
        @php
            $head = $calibration->{'headMikropipetDispensetForm' . $formIndex} ?? $calibration->headMikropipetDispenset;
            
            $formDetails = $detailsByForm[$formIndex] ?? [];
            
            // Ambil berdasarkan urutan array (0,1,2,3,4)
            $detailAtasKiri   = $formDetails[0] ?? null;
            $detailAtasKanan  = $formDetails[1] ?? null;
            $detailBawahKiri  = $formDetails[2] ?? null;
            $detailBawahKanan = $formDetails[3] ?? null;
            $detailTambahanKiri = $formDetails[4] ?? null;
            
            $isFirstForm = ($formIndex == 1);
            
            \Log::info("=== Form {$formIndex} ===");
            \Log::info("detailAtasKiri: " . ($detailAtasKiri ? $detailAtasKiri->titikUkur : 'null'));
            \Log::info("detailAtasKanan: " . ($detailAtasKanan ? $detailAtasKanan->titikUkur : 'null'));
            \Log::info("detailBawahKiri: " . ($detailBawahKiri ? $detailBawahKiri->titikUkur : 'null'));
            \Log::info("detailBawahKanan: " . ($detailBawahKanan ? $detailBawahKanan->titikUkur : 'null'));
            \Log::info("detailTambahanKiri: " . ($detailTambahanKiri ? $detailTambahanKiri->titikUkur : 'null'));
        @endphp

        <!-- DEBUG ONLY: Hilangkan ini nanti -->
        <div style="background: yellow; padding: 10px; border: 1px solid red; margin-bottom: 20px;">
            <strong>DEBUG DATA FOR FORM {{ $formIndex }}:</strong><br>
            Total Details in array: {{ count($formDetails) }}<br>
            @foreach($formDetails as $index => $detail)
                Index {{ $index }}: ID = {{ $detail->id }}, Titik Ukur = {{ $detail->titikUkur }}, M0 = {{ $detail->m0 }}<br>
            @endforeach
            <br>
            Variable $detailTambahanKiri: {{ $detailTambahanKiri ? 'EXISTS (ID: '.$detailTambahanKiri->id.', Titik Ukur: '.$detailTambahanKiri->titikUkur.')' : 'NULL' }}
        </div>

            <div class="form-card">
                <div class="form-card-header">
                    <i class="fas fa-file-alt me-2"></i>
                    Form Mikropipet/Dispenset ke-{{ $formIndex }}
                    @if(!$isFirstForm)
                        <span style="font-size:12px; margin-left:10px;">
                            <i class="fas fa-info-circle"></i> Data mengikuti Form 1
                        </span>
                    @endif
                </div>
                
                <div class="form-card-body">
                    <!-- Header Table -->
                    <table class="kalibrasi-header-table">
                        <tr>
                            <td colspan="2">
                                <p style="margin: 0; font-size: 14px;">PAS-FLK39</p>
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
                                <p style="margin: 0; font-weight: bold; font-size: 14px;">VOLUMETRIK: MIKROPIPET, DISPENSET</p>
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

                    <!-- Main Form Section - Readonly -->
                    <table class="kalibrasi-main-table">
                        <!-- Nama Alat -->
                        <tr>
                            <td style="width: 20%;">
                                <p style="margin: 0;">Nama Alat</p>
                            </td>
                            <td colspan="3">
                                <input type="text" class="kalibrasi-input" 
                                       value="{{ $calibration->namaAlat ?? '-' }}" readonly>
                            </td>
                        </tr>

                        <!-- Merek & Kode Alat -->
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

                        <!-- Type / No. Seri -->
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

                        <!-- Kapasitas / Resolusi -->
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

                        <!-- Nama Pemilik -->
                        <tr>
                            <td><p style="margin: 0;">Nama Pemilik</p></td>
                            <td colspan="3">
                                <input type="text" class="kalibrasi-input" 
                                       value="{{ $calibration->pemilikAlat ?? '-' }}" readonly>
                            </td>
                        </tr>

                        <!-- Tanggal -->
                        <tr>
                            <td><p style="margin: 0;">Tanggal Alat Masuk</p></td>
                            <td colspan="3">
                                <input type="text" class="kalibrasi-input" 
                                       value="{{ $calibration->tanggalMasuk ? \Carbon\Carbon::parse($calibration->tanggalMasuk)->format('d/m/Y') : '-' }}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td><p style="margin: 0;">Tanggal Kalibrasi</p></td>
                            <td colspan="3">
                                <div class="d-flex align-items-center">
                                    <input type="text" class="kalibrasi-input me-3" 
                                           value="{{ $calibration->tanggalKalibrasi ? \Carbon\Carbon::parse($calibration->tanggalKalibrasi)->format('d/m/Y') : '-' }}" readonly style="width: 45%;">
                                    <span class="me-3">Jenis Pembacaan:</span>
                                    <input type="text" class="kalibrasi-input" 
                                           value="{{ $calibration->jenisPembacaan ?? '-' }}" readonly style="width: 45%;">
                                </div>
                            </td>
                        </tr>

                        <!-- Tempat Kalibrasi -->
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

                    <!-- DATA KALIBRASI -->
                    <div class="data-kalibrasi-header">DATA KALIBRASI</div>

                    <table cellspacing="0" cellpadding="0" style="width:100%; border-collapse:collapse; margin:0 auto;">
                        <!-- HEADER UTAMA -->
                        <tr>
                            <td colspan="9" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; padding:12pt 0;">
                                <span style="font-size:12pt; font-weight:bold;">DATA KALIBRASI</span>
                             </td>
                        </tr>

                        <!-- ==================== BAGIAN ATAS ==================== -->
                        <tr style="height:55pt;">
                            <td rowspan="2" style="width:130pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle; padding:8pt;">
                                <span style="font-size:10pt; font-weight:bold;">Nominal Alat Ukur</span><br>
                                <span style="font-family:'Courier New'; font-size:14pt;">
                                    ({{ $head->satuan_alat_ukur_kiri ?? $form1Head->satuan_alat_ukur_kiri ?? '............' }})
                                </span>
                             </td>
                            <td colspan="3" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; padding:8pt;">
                                <span style="font-size:10pt; font-weight:bold;">Pembacaan Timbangan (g)</span>
                             </td>
                            <td rowspan="41" style="width:40pt; border-left:0.75pt solid #000; border-right:0.75pt solid #000;">&nbsp;</td>
                            <td rowspan="2" style="width:130pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle; padding:8pt;">
                                <span style="font-size:10pt; font-weight:bold;">Nominal Alat Ukur</span><br>
                                <span style="font-family:'Courier New'; font-size:14pt;">
                                    ({{ $head->satuan_alat_ukur_kanan ?? $form1Head->satuan_alat_ukur_kanan ?? '............' }})
                                </span>
                             </td>
                            <td colspan="3" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; padding:8pt;">
                                <span style="font-size:10pt; font-weight:bold;">Pembacaan Timbangan (g)</span>
                             </td>
                        </tr>

                        <tr style="height:30pt;">
                            <td style="width:70pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;"><b>m</b></td>
                            <td colspan="2" style="width:160pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;"><b>Nilai</b></td>
                            <td style="width:70pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;"><b>m</b></td>
                            <td colspan="2" style="width:160pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;"><b>Nilai</b></td>
                        </tr>

                        @for($i = 0; $i <= 11; $i++)
                        <tr style="height:25pt;">
                            @if($i == 0)
                                <td rowspan="12" style="border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:14pt; font-weight:bold;">
                                    {{ $detailAtasKiri->titikUkur ?? '' }}
                                 </td>
                            @endif
                            <td style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">
                                m<sub>{{ $i }}</sub>
                             </td>
                            <td colspan="2" style="border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:11pt;">
                                {{ $detailAtasKiri->{'m'.$i} ?? '' }}
                             </td>
                          
                            @if($i == 0)
                                <td rowspan="12" style="border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:14pt; font-weight:bold;">
                                    {{ $detailAtasKanan->titikUkur ?? '' }}
                                 </td>
                            @endif
                            <td style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">
                                m<sub>{{ $i }}</sub>
                             </td>
                            <td colspan="2" style="border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:11pt;">
                                {{ $detailAtasKanan->{'m'.$i} ?? '' }}
                             </td>
                        </tr>
                        @endfor

                        <!-- Parameter Pendukung Header Atas -->
                        <tr style="height:30pt;">
                            <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;"><b>Parameter Pendukung</b></td>
                            <td style="width:80pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center;"><b>Awal</b></td>
                            <td style="width:80pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center;"><b>Akhir</b></td>
                            <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;"><b>Parameter Pendukung</b></td>
                            <td style="width:80pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center;"><b>Awal</b></td>
                            <td style="width:80pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center;"><b>Akhir</b></td>
                        </tr>

                        <!-- Suhu Udara Atas -->
                        <tr style="height:25pt;">
                            <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Suhu Udara (°C)</td>
                            <td style="border:0.75pt solid #000; text-align:center;">{{ $detailAtasKiri->TUdaraS ?? '' }}</td>
                            <td style="border:0.75pt solid #000; text-align:center;">{{ $detailAtasKiri->TUdaraE ?? '' }}</td>
                            <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Suhu Udara (°C)</td>
                            <td style="border:0.75pt solid #000; text-align:center;">{{ $detailAtasKanan->TUdaraS ?? '' }}</td>
                            <td style="border:0.75pt solid #000; text-align:center;">{{ $detailAtasKanan->TUdaraE ?? '' }}</td>
                        </tr>

                        <!-- Kelembaban Udara Atas -->
                        <tr style="height:25pt;">
                            <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Kelembaban Udara (%rh)</td>
                            <td style="border:0.75pt solid #000; text-align:center;">{{ $detailAtasKiri->RHS ?? '' }}</td>
                            <td style="border:0.75pt solid #000; text-align:center;">{{ $detailAtasKiri->RHE ?? '' }}</td>
                            <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Kelembaban Udara (%rh)</td>
                            <td style="border:0.75pt solid #000; text-align:center;">{{ $detailAtasKanan->RHS ?? '' }}</td>
                            <td style="border:0.75pt solid #000; text-align:center;">{{ $detailAtasKanan->RHE ?? '' }}</td>
                        </tr>

                        <!-- Tekanan Udara Atas -->
                        <tr style="height:25pt;">
                            <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Tekanan Udara (hPa)</td>
                            <td style="border:0.75pt solid #000; text-align:center;">{{ $detailAtasKiri->PUdaraS ?? '' }}</td>
                            <td style="border:0.75pt solid #000; text-align:center;">{{ $detailAtasKiri->PUdaraE ?? '' }}</td>
                            <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Tekanan Udara (hPa)</td>
                            <td style="border:0.75pt solid #000; text-align:center;">{{ $detailAtasKanan->PUdaraS ?? '' }}</td>
                            <td style="border:0.75pt solid #000; text-align:center;">{{ $detailAtasKanan->PUdaraE ?? '' }}</td>
                        </tr>

                        <!-- Suhu Air Atas -->
                        <tr style="height:25pt;">
                            <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Suhu Air (°C)</td>
                            <td style="border:0.75pt solid #000; text-align:center;">{{ $detailAtasKiri->TAirS ?? '' }}</td>
                            <td style="border:0.75pt solid #000; text-align:center;">{{ $detailAtasKiri->TAirE ?? '' }}</td>
                            <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Suhu Air (°C)</td>
                            <td style="border:0.75pt solid #000; text-align:center;">{{ $detailAtasKanan->TAirS ?? '' }}</td>
                            <td style="border:0.75pt solid #000; text-align:center;">{{ $detailAtasKanan->TAirE ?? '' }}</td>
                        </tr>

                        <!-- Waktu Atas -->
                        <tr style="height:25pt;">
                            <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Waktu (detik)</td>
                            <td colspan="2" style="border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:11pt;">
                                {{ $detailAtasKiri->waktu ?? '' }}
                             </td>
                            <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Waktu (detik)</td>
                            <td colspan="2" style="border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:11pt;">
                                {{ $detailAtasKanan->waktu ?? '' }}
                             </td>
                        </tr>

                        <!-- Spacer -->
                        <tr><td colspan="9" style="height:30pt;">&nbsp;</td></tr>

                        <!-- ==================== BAGIAN BAWAH ==================== -->
                        <tr style="height:55pt;">
                            <td rowspan="2" style="width:130pt; border:2.25pt double #000; border-top:2.25pt double #000; background:#d9d9d9; text-align:center; vertical-align:middle; padding:8pt;">
                                <span style="font-size:10pt; font-weight:bold;">Nominal Alat Ukur</span><br>
                                <span style="font-family:'Courier New'; font-size:14pt;">
                                    ({{ $head->satuan_alat_ukur_bawah_kiri ?? $form1Head->satuan_alat_ukur_bawah_kiri ?? '............' }})
                                </span>
                             </td>
                            <td colspan="3" style="border:2.25pt double #000; border-top:2.25pt double #000; background:#d9d9d9; text-align:center; padding:8pt;">
                                <span style="font-size:10pt; font-weight:bold;">Pembacaan Timbangan (g)</span>
                             </td>
                            <td rowspan="2" style="width:130pt; border:2.25pt double #000; border-top:2.25pt double #000; background:#d9d9d9; text-align:center; vertical-align:middle; padding:8pt;">
                                <span style="font-size:10pt; font-weight:bold;">Nominal Alat Ukur</span><br>
                                <span style="font-family:'Courier New'; font-size:14pt;">
                                    ({{ $head->satuan_alat_ukur_bawah_kanan ?? $form1Head->satuan_alat_ukur_bawah_kanan ?? '............' }})
                                </span>
                             </td>
                            <td colspan="3" style="border:2.25pt double #000; border-top:2.25pt double #000; background:#d9d9d9; text-align:center; padding:8pt;">
                                <span style="font-size:10pt; font-weight:bold;">Pembacaan Timbangan (g)</span>
                             </td>
                        </tr>

                        <tr style="height:30pt;">
                            <td style="width:70pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center;"><b>m</b></td>
                            <td colspan="2" style="width:160pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center;"><b>Nilai</b></td>
                            <td style="width:70pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center;"><b>m</b></td>
                            <td colspan="2" style="width:160pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center;"><b>Nilai</b></td>
                        </tr>

                        @for($i = 0; $i <= 11; $i++)
                        <tr style="height:25pt;">
                            @if($i == 0)
                                <td rowspan="12" style="border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:14pt; font-weight:bold;">
                                    {{ $detailBawahKiri->titikUkur ?? '' }}
                                 </td>
                            @endif
                            <td style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">
                                m<sub>{{ $i }}</sub>
                             </td>
                            <td colspan="2" style="border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:11pt;">
                                {{ $detailBawahKiri->{'m'.$i} ?? '' }}
                             </td>
                          
                            @if($i == 0)
                                <td rowspan="12" style="border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:14pt; font-weight:bold;">
                                    {{ $detailBawahKanan->titikUkur ?? '' }}
                                 </td>
                            @endif
                            <td style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">
                                m<sub>{{ $i }}</sub>
                             </td>
                            <td colspan="2" style="border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:11pt;">
                                {{ $detailBawahKanan->{'m'.$i} ?? '' }}
                             </td>
                        </tr>
                        @endfor

                        <!-- Parameter Pendukung Header Bawah -->
                        <tr style="height:30pt;">
                            <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;"><b>Parameter Pendukung</b></td>
                            <td style="width:80pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center;"><b>Awal</b></td>
                            <td style="width:80pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center;"><b>Akhir</b></td>
                            <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;"><b>Parameter Pendukung</b></td>
                            <td style="width:80pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center;"><b>Awal</b></td>
                            <td style="width:80pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center;"><b>Akhir</b></td>
                        </tr>

                        <!-- Suhu Udara Bawah -->
                        <tr style="height:25pt;">
                            <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Suhu Udara (°C)</td>
                            <td style="border:0.75pt solid #000; text-align:center;">{{ $detailBawahKiri->TUdaraS ?? '' }}</td>
                            <td style="border:0.75pt solid #000; text-align:center;">{{ $detailBawahKiri->TUdaraE ?? '' }}</td>
                            <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Suhu Udara (°C)</td>
                            <td style="border:0.75pt solid #000; text-align:center;">{{ $detailBawahKanan->TUdaraS ?? '' }}</td>
                            <td style="border:0.75pt solid #000; text-align:center;">{{ $detailBawahKanan->TUdaraE ?? '' }}</td>
                        </tr>

                        <!-- Kelembaban Udara Bawah -->
                        <tr style="height:25pt;">
                            <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Kelembaban Udara (%rh)</td>
                            <td style="border:0.75pt solid #000; text-align:center;">{{ $detailBawahKiri->RHS ?? '' }}</td>
                            <td style="border:0.75pt solid #000; text-align:center;">{{ $detailBawahKiri->RHE ?? '' }}</td>
                            <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Kelembaban Udara (%rh)</td>
                            <td style="border:0.75pt solid #000; text-align:center;">{{ $detailBawahKanan->RHS ?? '' }}</td>
                            <td style="border:0.75pt solid #000; text-align:center;">{{ $detailBawahKanan->RHE ?? '' }}</td>
                        </tr>

                        <!-- Tekanan Udara Bawah -->
                        <tr style="height:25pt;">
                            <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Tekanan Udara (hPa)</td>
                            <td style="border:0.75pt solid #000; text-align:center;">{{ $detailBawahKiri->PUdaraS ?? '' }}</td>
                            <td style="border:0.75pt solid #000; text-align:center;">{{ $detailBawahKiri->PUdaraE ?? '' }}</td>
                            <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Tekanan Udara (hPa)</td>
                            <td style="border:0.75pt solid #000; text-align:center;">{{ $detailBawahKanan->PUdaraS ?? '' }}</td>
                            <td style="border:0.75pt solid #000; text-align:center;">{{ $detailBawahKanan->PUdaraE ?? '' }}</td>
                        </tr>

                        <!-- Suhu Air Bawah -->
                        <tr style="height:25pt;">
                            <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Suhu Air (°C)</td>
                            <td style="border:0.75pt solid #000; text-align:center;">{{ $detailBawahKiri->TAirS ?? '' }}</td>
                            <td style="border:0.75pt solid #000; text-align:center;">{{ $detailBawahKiri->TAirE ?? '' }}</td>
                            <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Suhu Air (°C)</td>
                            <td style="border:0.75pt solid #000; text-align:center;">{{ $detailBawahKanan->TAirS ?? '' }}</td>
                            <td style="border:0.75pt solid #000; text-align:center;">{{ $detailBawahKanan->TAirE ?? '' }}</td>
                        </tr>

                        <!-- Waktu Bawah -->
                        <tr style="height:25pt;">
                            <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Waktu (detik)</td>
                            <td colspan="2" style="border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:11pt;">
                                {{ $detailBawahKiri->waktu ?? '' }}
                             </td>
                            <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Waktu (detik)</td>
                            <td colspan="2" style="border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:11pt;">
                                {{ $detailBawahKanan->waktu ?? '' }}
                             </td>
                        </tr>

<!-- ==================== BAGIAN TAMBAHAN KIRI ==================== -->
<tr>
    <td colspan="11" style="padding:10px;">&nbsp;</td>
</tr>

<tr style="height:40pt;">
    <td rowspan="2" style="width:130pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle; padding:8pt;">
        <span style="font-size:10pt; font-weight:bold;">Nominal Alat Ukur</span><br>
        <span style="font-family:'Lucida Console'; letter-spacing:0.5em">
            (
            {{ $head->satuan_alat_ukur_tambahan_kiri ?? '' }}
            )
        </span>
    </td>
    <td colspan="3" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; padding:8pt;">
        <span style="font-size:10pt; font-weight:bold;">Pembacaan Timbangan (g)</span>
    </td>
    <td rowspan="19" style="width:40pt; border-left:0.75pt solid #000; border-right:0.75pt solid #000;">&nbsp;</td>
    <td colspan="4" rowspan="19" style="border:none;">&nbsp;</td>
</tr>
<tr style="height:30pt;">
    <td style="width:70pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;"><b>m</b></td>
    <td colspan="2" style="width:160pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;"><b>Nilai</b></td>
</tr>

@for($i = 0; $i <= 11; $i++)
<tr style="height:25pt;">
    @if($i == 0)
        <td rowspan="12" style="border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:14pt; font-weight:bold;">
            {{ $detailTambahanKiri->titikUkur ?? '' }}
        </td>
    @endif
    <td style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">
        m<sub>{{ $i }}</sub>
    </td>
    <td colspan="2" style="border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:11pt;">
        {{ $detailTambahanKiri->{'m'.$i} ?? '' }}
    </td>
</tr>
@endfor

<!-- Parameter Pendukung Header Tambahan -->
<tr style="height:30pt;">
    <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;"><b>Parameter Pendukung</b></td>
    <td style="width:80pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center;"><b>Awal</b></td>
    <td style="width:80pt; border:0.75pt solid #000; background:#d9d9d9; text-align:center;"><b>Akhir</b></td>
</tr>

<!-- Suhu Udara Tambahan -->
<tr style="height:25pt;">
    <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Suhu Udara (&deg;C)</td>
    <td style="border:0.75pt solid #000; text-align:center;">
        {{ $detailTambahanKiri->TUdaraS ?? '' }}
    </td>
    <td style="border:0.75pt solid #000; text-align:center;">
        {{ $detailTambahanKiri->TUdaraE ?? '' }}
    </td>
</tr>

<!-- Kelembaban Udara Tambahan -->
<tr style="height:25pt;">
    <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Kelembaban Udara (%rh)</td>
    <td style="border:0.75pt solid #000; text-align:center;">
        {{ $detailTambahanKiri->RHS ?? '' }}
    </td>
    <td style="border:0.75pt solid #000; text-align:center;">
        {{ $detailTambahanKiri->RHE ?? '' }}
    </td>
</tr>

<!-- Tekanan Udara Tambahan -->
<tr style="height:25pt;">
    <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Tekanan Udara (hPa)</td>
    <td style="border:0.75pt solid #000; text-align:center;">
        {{ $detailTambahanKiri->PUdaraS ?? '' }}
    </td>
    <td style="border:0.75pt solid #000; text-align:center;">
        {{ $detailTambahanKiri->PUdaraE ?? '' }}
    </td>
</tr>

<!-- Suhu Air Tambahan -->
<tr style="height:25pt;">
    <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Suhu Air (&deg;C)</td>
    <td style="border:0.75pt solid #000; text-align:center;">
        {{ $detailTambahanKiri->TAirS ?? '' }}
    </td>
    <td style="border:0.75pt solid #000; text-align:center;">
        {{ $detailTambahanKiri->TAirE ?? '' }}
    </td>
</tr>

<!-- Waktu Tambahan -->
<tr style="height:25pt;">
    <td colspan="2" style="border:0.75pt solid #000; background:#d9d9d9; text-align:center; vertical-align:middle;">Waktu (detik)</td>
    <td colspan="2" style="border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:11pt;">
        {{ $detailTambahanKiri->waktu ?? '' }}
    </td>
</tr>

                    </table>

                    <p class="BodyText" style="margin-top:3.1pt; margin-left:4.45pt; margin-bottom:1.3pt">
                        <span>Catatan:</span>
                        <span>Pengukuran m<sub>11</sub> dan penghitungan waktu hanya untuk volume 50 µl ke bawah</span>
                    </p>

                    <!-- Data Complete Section -->
                    <div class="data-complete-section">
                        <span class="data-complete-text">Data telah diisi dengan lengkap dan jelas!</span>
                    </div>

                    <!-- ==================== ALAT STANDAR SECTION (STYLE TIDAK DIRUBAH) ==================== -->
                    &nbsp; &nbsp;
                    @php
                        $headAlatStandar = $form1Head;
                        $standardString = $headAlatStandar->standard ?? '';
                        $alatStandarData = [];
                        if (!empty($standardString)) {
                            $alatStandarData = array_map('trim', explode(',', $standardString));
                        }

                        $calibratedBy = $calibration->calibratedBy ?? '';
                        $verifiedBy = $calibration->verifiedBy ?? '';

                        $isSelected = function($value) use ($alatStandarData) {
                            return in_array($value, $alatStandarData, true);
                        };
                    @endphp

                    <style>
                        /* Checkbox & radio standar */
                        input[type="checkbox"], input[type="radio"] {
                            width: 18px;
                            height: 18px;
                            margin-right: 8px;
                            vertical-align: middle;
                            cursor: default;
                        }

                        /* YANG TERPILIH: background hitam + centang/bulat putih tebal (jelas bedanya) */
                        input[type="checkbox"]:checked,
                        input[type="radio"]:checked {
                            accent-color: #ffffff !important;   /* centang putih */
                            background-color: #000000 !important; /* kotak hitam */
                            border: 2px solid #000000 !important;
                            box-shadow: 0 0 0 2px #ffffff; /* outline putih biar kontras */
                        }

                        /* YANG TIDAK TERPILIH: kotak biasa abu-abu pudar */
                        input[type="checkbox"]:not(:checked),
                        input[type="radio"]:not(:checked) {
                            background-color: #f0f0f0;
                            border: 1px solid #999999;
                        }

                        /* Pastikan disabled tetap kelihatan penuh */
                        input[type="checkbox"]:disabled,
                        input[type="radio"]:disabled {
                            opacity: 1 !important;
                        }
                    </style>

                    <style>
                        /* Styling untuk checkbox readonly */
                        input[type="checkbox"][readonly] {
                            pointer-events: none;
                            opacity: 0.8;
                        }
                        
                        /* Warna untuk checkbox yang dicentang */
                        input[type="checkbox"][readonly]:checked {
                            accent-color: #4CAF50;  /* Warna hijau untuk yang checked */
                        }
                        
                        /* Alternatif: menggunakan filter untuk efek berbeda */
                        input[type="checkbox"][readonly]:checked {
                            filter: hue-rotate(120deg);  /* Mengubah warna */
                        }
                        
                        /* Efek tambahan untuk label */
                        input[type="checkbox"][readonly]:checked + span {
                            font-weight: bold;
                            color: #2E7D32;
                        }
                    </style>

                    <table cellspacing="0" cellpadding="5"
                        style="border-collapse:collapse; width:100%; font-family:Arial; font-size:9pt; border:1px solid #000;">

                        <!-- JUDUL -->
                        <tr>
                            <td colspan="9" style="border:1px solid #000; text-align:center; font-weight:bold; font-size:11pt;">
                                Isilah lembar data kalibrasi dengan lengkap dan jelas!
                            </td>
                        </tr>

                        <!-- BARIS 1 -->
                        <tr>
                            <td rowspan="4" style="border:1px solid #000; text-align:center; font-weight:bold; width:90px;">
                                Alat Standar
                            </td>

                            <td style="border:1px solid #000; width:200px;">Semi Microbalance, AND</td>
                            <td style="border:1px solid #000;" align="center">
                                <input type="checkbox" @if($isSelected('Semi Microbalance AND 0.1g')) checked @endif readonly>
                                <span>0.1 g</span>
                            </td>
                            <td style="border:1px solid #000;" align="center">
                                <input type="checkbox" @if($isSelected('Semi Microbalance AND 1g')) checked @endif readonly>
                                <span>1 g</span>
                            </td>
                            <td style="border:1px solid #000;" align="center">
                                <input type="checkbox" @if($isSelected('Semi Microbalance AND 10g')) checked @endif readonly>
                                <span>10 g</span>
                            </td>
                            <td style="border:1px solid #000;" align="center">
                                <input type="checkbox" @if($isSelected('Semi Microbalance AND 100g')) checked @endif readonly>
                                <span>100 g</span>
                            </td>
                            <td style="border:1px solid #000;" align="center">
                                <input type="checkbox" @if($isSelected('Semi Microbalance AND 200g')) checked @endif readonly>
                                <span>200 g</span>
                            </td>

                            <td style="border:none; text-align:center; font-weight:bold;">Dikalibrasi oleh</td>
                            <td style="border:none; text-align:center; font-weight:bold;">Diperiksa oleh</td>
                        </tr>

                        <!-- BARIS 2 -->
                        <tr>
                            <td style="border:1px solid #000;">Semi Microbalance, Radwag</td>
                            <td style="border:1px solid #000;" align="center">
                                <input type="checkbox" @if($isSelected('Semi Microbalance Radwag 0.1g')) checked @endif readonly>
                                <span>0.1 g</span>
                            </td>
                            <td style="border:1px solid #000;" align="center">
                                <input type="checkbox" @if($isSelected('Semi Microbalance Radwag 1g')) checked @endif readonly>
                                <span>1 g</span>
                            </td>
                            <td style="border:1px solid #000;" align="center">
                                <input type="checkbox" @if($isSelected('Semi Microbalance Radwag 10g')) checked @endif readonly>
                                <span>10 g</span>
                            </td>
                            <td style="border:1px solid #000;" align="center">
                                <input type="checkbox" @if($isSelected('Semi Microbalance Radwag 100g')) checked @endif readonly>
                                <span>100 g</span>
                            </td>
                            <td style="border:1px solid #000;" align="center">
                                <input type="checkbox" @if($isSelected('Semi Microbalance Radwag 200g')) checked @endif readonly>
                                <span>200 g</span>
                            </td>
                        </tr>

                        <!-- BARIS 3 -->
                        <tr>
                            <td style="border:1px solid #000;">Timbangan Digital, AND</td>
                            <td colspan="2" style="border:1px solid #000;" align="center">
                                <input type="checkbox" @if($isSelected('Timbangan Digital AND 3kg')) checked @endif readonly>
                                <span>3 kg</span>
                            </td>
                            <td colspan="3" style="border:1px solid #000;" align="center">
                                Stopwatch<br>
                                <input type="checkbox" name="stopwatch_view" @if($isSelected('Stopwatch WF002')) checked @endif readonly>
                                <span>WF002</span>
                                &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" name="stopwatch_view" @if($isSelected('Stopwatch WT003')) checked @endif readonly>
                                <span>WT003</span>
                            </td>
                        </tr>

                        <!-- BARIS 4 -->
                        <tr>
                            <td style="border:1px solid #000;">Termometer</td>
                            <td colspan="2" style="border:1px solid #000;" align="center">
                                <input type="checkbox" name="termometer_view" @if($isSelected('Termometer TES')) checked @endif readonly>
                                <span>TES</span>
                            </td>
                            <td style="border:1px solid #000;"></td>
                            <td colspan="2" style="border:1px solid #000;" align="center">
                                <input type="checkbox" name="termometer_view" @if($isSelected('Termometer TFA')) checked @endif readonly>
                                <span>TFA</span>
                             </td>
                        </tr>

                        <!-- BARIS TERAKHIR -->
                        <tr>
                            <td style="border:1px solid #000; font-weight:bold; text-align:center;">
                                Metode Kalibrasi
                             </td>

                            <td colspan="6" style="border:1px solid #000; padding-left:10px;">
                                PAS-IK102-39 (Volumetrik Piston)
                             </td>

                            <td style="border:1px solid #000; text-align:center;">
                                TTD :<br><br>
                                Nama :<br>
                                @if($calibratedBy)
                                    <span style="font-weight:bold; font-size:10pt; display:inline-block; margin-top:5px;">{{ $calibratedBy }}</span>
                                @endif
                             </td>

                            <td style="border:1px solid #000; text-align:center;">
                                TTD :<br><br>
                                Nama :<br>
                                @if($verifiedBy)
                                    <span style="font-weight:bold; font-size:10pt; display:inline-block; margin-top:5px;">{{ $verifiedBy }}</span>
                                @endif
                             </td>
                        </tr>
                    </table>

                    <script>
var tempFormDataStore = window.tempFormDataStore;
var isRestoring = window.isRestoring;
var tabSubmitStatus = window.tabSubmitStatus;
var currentActiveTabId = '1';

                        // Jumlah item terpilih
                        console.log('Jumlah alat standar terpilih:', {{ count($alatStandarData) }});
                    </script>

                </div>
            </div>
        @endfor

        <!-- Action Buttons Section -->
        <div class="row mt-5">
            <div class="col-12 text-center">
                <a href="{{ url()->previous() }}" class="btn btn-secondary btn-lg" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>