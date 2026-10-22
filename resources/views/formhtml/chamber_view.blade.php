<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Kalibrasi Climatic Chamber - PT. PANANJUNG ANUGRAH SOLUTION</title>
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
        $heads = $calibration->headChamber  ?? collect();
        $details = $calibration->detailChambers ?? collect();
        $addChambers = $calibration->addChamber  ?? collect();
        $interval_waktu = [1, 2, 3, 4, 5, 13, 20, 30];
    @endphp

    <div class="container my-4" style="width: 95%; max-width: 1600px;">
        @for($formIndex = 1; $formIndex <= $jumlahForm; $formIndex++)
            @php
                // Gunakan relasi per form untuk head
                $head = $heads->where('form_index', $formIndex)->first();
                 $form1Head = $calibration->headChamberForm1;
                
                // Ambil DETAILS berdasarkan form_index
                $formDetails = $details->where('form_index', $formIndex)->sortBy('id');
                
                // Ambil ADD CHAMBER berdasarkan form_index
                $formAdds = $addChambers->where('form_index', $formIndex)->sortBy('repetition_number');
                
                // Tentukan repetition dari add chamber
                $repetition = $formAdds->count() > 0 ? $formAdds->count() : 1;
            @endphp

            <div class="form-card">
                <div class="form-card-header">
                    <i class="fas fa-file-alt me-2"></i>
                    Form Climatic Chamber ke-{{ $formIndex }}
                </div>
                
                <div class="form-card-body">
                    <!-- Header Table -->
                    <table class="kalibrasi-header-table">
                        <tr>
                            <td colspan="2">
                                <p style="margin: 0; font-size: 14px;">PAS-FLK29B</p>
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
                                <p style="margin: 0; font-weight: bold; font-size: 14px;">CLIMATIC CHAMBER</p>
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
                    </tr>

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
                            <td>
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
                        
                         <tr>
                            <td><p style="margin: 0;">Kode TH</p></td>
                            <td colspan="3">
                                <input type="text" class="kalibrasi-input" 
                                       value="{{ $calibration->kode_th ?? '-' }}" readonly>
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
                                    <td class="table-secondary fw-bold text-center">Awal</div>
                                    <td class="table-secondary fw-bold text-center">Tengah</div>
                                    <td class="table-secondary fw-bold text-center">Akhir</div>
                                </tr>
                                <tr>
                                    <td class="bg-light fw-bold">Suhu (°C)</div>
                                    <td><input type="text" class="kondisi-input" value="{{ $calibration->RT_condition1 ?? '-' }}" readonly></div>
                                    <td><input type="text" class="kondisi-input" value="{{ $calibration->RT_condition2 ?? '-' }}" readonly></div>
                                    <td><input type="text" class="kondisi-input" value="{{ $calibration->RT_condition3 ?? '-' }}" readonly></div>
                                </tr>
                                <tr>
                                    <td class="bg-light fw-bold">RH (%)</div>
                                    <td><input type="text" class="kondisi-input" value="{{ $calibration->RH_condition1 ?? '-' }}" readonly></div>
                                    <td><input type="text" class="kondisi-input" value="{{ $calibration->RH_condition2 ?? '-' }}" readonly></div>
                                    <td><input type="text" class="kondisi-input" value="{{ $calibration->RH_condition3 ?? '-' }}" readonly></div>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- DATA KALIBRASI Section -->
                    <div class="data-kalibrasi-header">DATA KALIBRASI</div>
                    
                    <ol type="1" style="margin:0pt; padding-left:0pt">
                        <li class="ListParagraph" style="margin-top:0.5pt; margin-left:10.05pt; text-indent:0pt; font-size:11pt; font-weight:bold; letter-spacing:-0.1pt">
                            <span>Penempatan Sensor</span>
                        </li>
                    </ol>
                    
                    <p style="margin-left:0.05pt; font-size:10pt">
                        <div style="display: inline-block; vertical-align: top; text-align: center; margin-right: 20px;">
                            <img src="/logo/foto_rektangular.png" width="350" height="190" alt="" 
                                style="border: 2px solid #000000; padding: 5px;" />
                            <div style="margin-top: 8px; font-family: Arial; font-size: 9pt; font-weight: bold; color: #000000; text-align: center;">
                                Rektangular
                            </div>
                        </div>
                        
                        <span style="width:359.85pt; font-family:Arial; display:inline-block;">&#xa0;</span>
                        
                        <div style="display: inline-block; vertical-align: top; text-align: center; margin-left: 20px;">
                            <img src="/logo/foto_silindrik.png" width="240" height="190" alt="" 
                                style="border: 2px solid #000000; padding: 5px;" />
                            <div style="margin-top: 8px; font-family: Arial; font-size: 9pt; font-weight: bold; color: #000000; text-align: center;">
                                Silindrik atau Sferik
                            </div>
                        </div>
                    </p>

                    @for($p = 1; $p <= $repetition; $p++)
                        @php
                            $addData = $formAdds->where('repetition_number', $p)->first();
                            $tsettingValue = $addData->Tsetting ?? '';
                        @endphp
                        
                        <ol start="2" type="1" style="margin:0pt; padding-left:0pt">
                            <li class="ListParagraph" style="margin-right:468.8pt; margin-bottom:2.65pt; text-indent:0pt; line-height:147%; font-size:11pt; font-weight:bold; letter-spacing:-0.1pt; list-style-position:inside">
                                <span>Data Pengukuran Setting Suhu ke-{{ $p }}</span>
                                <span style="width:31.99pt; letter-spacing:normal; display:inline-block">&#xa0;</span>
                                <span style="font-family:'Arial MT'; font-weight:normal; letter-spacing:-0.5pt">:</span>
                                <span style="font-size:10pt; width:100pt; margin-left:5pt; font-family:'Arial MT'; height:18pt; display:inline-block; font-weight:bold; color:#000; border-bottom: 1px solid #000;">
                                    {{ $tsettingValue ?: '-' }}
                                </span>
                            </li>
                        </ol>

                        <table cellspacing="0" cellpadding="0" class="TableNormal" style="width:100%; margin-left:0.48pt; border:2px solid #000000; border-collapse:collapse; margin-bottom: {{ $p < $repetition ? '40px' : '20px' }}">
                            <tr style="background: #d9d9d9; height:14pt">
                                <td style="width:8%; border:2px solid #000; vertical-align:middle; text-align:center">
                                    <span style="font-weight: bold; color: #000000; font-size:9pt">Interval Waktu</span>
                                </div>
                                <td colspan="2" style="border:2px solid #000; vertical-align:middle; text-align:center">
                                    <span style="font-weight: bold; color: #000000; font-size:9pt">Pembacaan Alat</span>
                                </div>
                                <td colspan="10" style="border:2px solid #000; vertical-align:middle; text-align:center">
                                    <span style="font-weight: bold; color: #000000; font-size:9pt">Pembacaan Sensor</span>
                                </div>
                            </tr>
                            <tr style="background: #e8e8e8; height:13pt">
                                <td style="border:2px solid #000; vertical-align:middle; text-align:center">
                                    <span style="font-weight:bold; color:#000000; font-size:9pt;">(Menit)</span>
                                </div>
                                <td style="width:8%; border:2px solid #000; vertical-align:middle; text-align:center">
                                    <span style="font-family:Arial; font-size:6pt; font-weight:bold;">o</span>
                                    <span style="font-family:Arial; font-weight:bold; vertical-align:-3pt; font-size:9pt;">C</span>
                                </div>
                                <td style="width:8%; border:2px solid #000; vertical-align:middle; text-align:center">
                                    <span style="font-weight: bold; color: #000000; font-size:9pt">%</span>
                                </div>
                                @for($s = 1; $s <= 9; $s++)
                                <td style="width:7.2%; border:2px solid #000; vertical-align:middle; text-align:center">
                                    <span style="font-weight: bold; color: #000000; font-size:9pt">{{ $s }}</span>
                                </div>
                                @endfor
                                <td style="width:8%; border:2px solid #000; vertical-align:middle; text-align:center">
                                    <span style="font-weight: bold; color: #000000; font-size:9pt">%</span>
                                </div>
                            <tr>
                            
                            @foreach($interval_waktu as $interval)
                                @php
                                    $detailData = $formDetails->where('repetition_number', $p)
                                        ->where('interval_number', $interval)
                                        ->first();
                                @endphp
                                
                                <tr style="height:22pt;">
                                    <td style="border:2px solid #000; padding:0; vertical-align:middle; text-align:center; font-weight:bold; font-size:10pt; color:#000;">
                                        {{ $interval }}
                                    </div>
                                    
                                    <td style="border:2px solid #000; padding:0; vertical-align:middle; text-align:center; font-size:10pt; color:#000;">
                                        {{ $detailData->readAlat ?? '-' }}
                                    </div>
                                    
                                    <td style="border:2px solid #000; padding:0; vertical-align:middle; text-align:center; font-size:10pt; color:#000;">
                                        {{ $detailData->RHAlat ?? '-' }}
                                    </div>
                                    
                                    @for($s = 1; $s <= 9; $s++)
                                        <td style="border:2px solid #000; padding:0; vertical-align:middle; text-align:center; font-size:10pt; color:#000;">
                                            {{ $detailData->{'ulangan0' . $s} ?? '-' }}
                                        </div>
                                    @endfor
                                    
                                    <td style="border:2px solid #000; padding:0; vertical-align:middle; text-align:center; font-size:10pt; color:#000;">
                                        {{ $detailData->RHulangan ?? '-' }}
                                    </div>
                                </tr>
                            @endforeach
                        </table>
                    @endfor

                    <div style="height: 50px;"></div>

                    <!-- Footer Section -->
                    <table class="kalibrasi-main-table" style="width:100%; border-collapse:collapse;">
                        <tr style="height:13.5pt">
                            <td rowspan="2" style="width:15%; border:1pt solid #000; text-align:center; vertical-align:middle; font-weight:bold; font-size:10pt; background-color:#f0f0f0;">
                                Alat<br>Standar
                            </div>
                            <td style="width:15%; border:1pt solid #000; text-align:left; vertical-align:middle; font-size:9pt; padding:8px;">- Temperature</div>
                            <td style="width:10%; border:1pt solid #000; text-align:center; vertical-align:middle; font-size:9pt; padding:8px;">
                                <div style="display:flex; align-items:center; justify-content:center;">
                                    @php
                                        $isGL220 = str_contains($form1Head->standard ?? '', 'GL-220');
                                    @endphp
                                    <input type="checkbox" class="alat-standar-checkbox" {{ $isGL220 ? 'checked' : '' }} disabled>
                                    <span style="margin-left:8px;">GL-220</span>
                                </div>
                            </div>
                            <td style="width:10%; border:1pt solid #000; text-align:center; vertical-align:middle; font-size:9pt; padding:8px;">
                                <div style="display:flex; align-items:center; justify-content:center;">
                                    @php
                                        $isGL240 = str_contains($form1Head->standard ?? '', 'GL-240');
                                    @endphp
                                    <input type="checkbox" class="alat-standar-checkbox" {{ $isGL240 ? 'checked' : '' }} disabled>
                                    <span style="margin-left:8px;">GL-240</span>
                                </div>
                            </div>
                            <td style="width:10%; border:1pt solid #000; text-align:center; vertical-align:middle; font-size:9pt; padding:8px;">
                                <div style="display:flex; align-items:center; justify-content:center;">
                                    @php
                                        $isHuato = str_contains($form1Head->standard ?? '', 'Huato');
                                    @endphp
                                    <input type="checkbox" class="alat-standar-checkbox" {{ $isHuato ? 'checked' : '' }} disabled>
                                    <span style="margin-left:8px;">Huato</span>
                                </div>
                            </div>
                            <td rowspan="2" style="width:20%; border:1pt solid #000; text-align:center; vertical-align:middle; font-weight:bold; font-size:9pt; padding:8px; background-color:#f0f0f0;">
                                Dikalibrasi<br>oleh
                            </div>
                            <td rowspan="2" style="width:20%; border:1pt solid #000; text-align:center; vertical-align:middle; font-weight:bold; font-size:9pt; padding:8px; background-color:#f0f0f0;">
                                Diperiksa<br>oleh
                            </div>
                        </tr>

                        <tr style="height:13.5pt">
                            <td style="border:1pt solid #000; text-align:left; vertical-align:middle; font-size:9pt; padding:8px;">- Kelembaban</div>
                            <td style="border:1pt solid #000; text-align:center; vertical-align:middle; font-size:9pt; padding:8px;">
                                <div style="display:flex; align-items:center; justify-content:center;">
                                    @php
                                        $isRotronic = str_contains($form1Head->standard ?? '', 'Rotronic');
                                    @endphp
                                    <input type="checkbox" class="alat-standar-checkbox" {{ $isRotronic ? 'checked' : '' }} disabled>
                                    <span style="margin-left:8px;">Rotronic</span>
                                </div>
                            </div>
                            <td style="border:1pt solid #000; text-align:center; vertical-align:middle; font-size:9pt; padding:8px;">
                                <div style="display:flex; align-items:center; justify-content:center;">
                                    @php
                                        $isLutron = str_contains($form1Head->standard ?? '', 'Lutron');
                                    @endphp
                                    <input type="checkbox" class="alat-standar-checkbox" {{ $isLutron ? 'checked' : '' }} disabled>
                                    <span style="margin-left:8px;">Lutron</span>
                                </div>
                            </div>
                            <td style="border:1pt solid #000; text-align:center; vertical-align:middle; font-size:9pt; padding:8px;">&nbsp;</div>
                        </tr>

                        <tr style="height:15pt">
                            <td style="width:15%; border:1pt solid #000; text-align:center; vertical-align:middle; font-weight:bold; font-size:9pt; padding:8px; background-color:#f0f0f0;">
                                Metode<br>Kalibrasi
                            </div>
                            <td colspan="4" style="border:1pt solid #000; text-align:left; vertical-align:middle; font-size:9pt; padding:8px;">
                                {{ $form1Head->calibrationMethod ?? 'PAS-IK1102-29B' }}
                            </div>
                            <td style="width:20%; border:1pt solid #000; text-align:left; vertical-align:middle; font-size:9pt; padding:8px;">
                                <div><strong>TTD :</strong></div>
                                <div><strong>Nama :</strong> {{ $calibration->calibratedBy ?? '-' }}</div>
                            </div>
                            <td style="width:20%; border:1pt solid #000; text-align:left; vertical-align:middle; font-size:9pt; padding:8px;">
                                <div><strong>TTD :</strong></div>
                                <div><strong>Nama :</strong> {{ $calibration->verifiedBy ?? '-' }}</div>
                            </div>
                        </tr>
                    </table>
                </div>
            </div>
        @endfor
        
        <!-- Action Buttons Section - DI LUAR LOOP (HANYA SEKALI) -->
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