<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Kalibrasi - PT. PANANJUNG ANUGRAH SOLUTION</title>
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

    .form-check-input[type="checkbox"]:checked:disabled,
    .alat-standar-checkbox[type="checkbox"]:checked:disabled {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
        opacity: 1 !important;
    }

    .form-check-input[type="radio"]:checked {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='2' fill='%23fff'/%3e%3c/svg%3e") !important;
    }

    .form-check-input[type="radio"]:checked:disabled {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
        opacity: 1 !important;
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
        $jumlahForm = max(1, $jumlahForm);
        $details = $calibration->detailDepthMicrometers ?? collect();
        $form1Head = $calibration->headDepthMicrometerForm1;
    @endphp

    <div class="container my-4">
        @for($formIndex = 1; $formIndex <= $jumlahForm; $formIndex++)
            @php
                // Gunakan relasi per form untuk head
                $head = $calibration->{'headDepthMicrometerForm' . $formIndex};
                
                // Ambil details berdasarkan form_index
                $formDetails = $calibration->detailDepthMicrometers->where('form_index', $formIndex)->sortBy('id');
            @endphp

            <div class="form-card">
                <div class="form-card-header">
                    <i class="fas fa-file-alt me-2"></i>
                    Form Depth Micrometer ke-{{ $formIndex }}
                </div>
                
                <div class="form-card-body">
                    <!-- Header Table -->
                    <table class="kalibrasi-header-table">
                        <tr>
                            <td colspan="2">
                                <p style="margin: 0; font-size: 14px;">PAS-FLK06</p>
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
                                <p style="margin: 0; font-weight: bold; font-size: 14px;">MICROMETER DEPTH</p>
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
                         
                        <tr>
                            <td><p style="margin: 0;">TH</p></td>
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

                    <!-- DATA KALIBRASI - Setiap form punya data sendiri sesuai form_index -->
                    <div class="data-kalibrasi-header">DATA KALIBRASI</div>
                    
                    <div class="mb-3">
                        <span style="font-size: 16px; font-weight: bold;">Uji Skala Nominal</span>
                    </div>
                    
                    <table class="kalibrasi-data-table">
                        <tr style="background: #d9d9d9;">
                            <td style="width: 20%;"><span style="font-weight: bold;">Nilai Nominal</span></td>
                            <td colspan="5"><span style="font-weight: bold;">Penunjukan Alat</span></td>
                        </tr>
                        <tr style="background: #e8e8e8;">
                            <td>
                                <span style="font-weight: bold;">Unit (</span>
                                <span>{{ $head->satuan_unit ?? 'mm' }}</span>
                                <span style="font-weight: bold;">)</span>
                            </td>
                            <td style="width: 16%;"><span style="font-weight: bold;">1</span></td>
                            <td style="width: 16%;"><span style="font-weight: bold;">2</span></td>
                            <td style="width: 16%;"><span style="font-weight: bold;">3</span></td>
                            <td style="width: 16%;"><span style="font-weight: bold;">4</span></td>
                            <td style="width: 16%;"><span style="font-weight: bold;">5</span></td>
                        </tr>

                        @php
                            // Buat array 14 baris, isi dengan data dari form ini
                            $detailArray = [];
                            foreach ($formDetails as $detail) {
                                $detailArray[] = $detail;
                            }
                        @endphp

                        @for($i = 0; $i < 14; $i++)
                            @php
                                $detail = $detailArray[$i] ?? null;
                            @endphp
                            <tr style="height:21.3pt;">
                                <td style="border:2px solid #000; padding:0; background: #f0f0f0;">
                                    <input type="text" value="{{ $detail->titikUkur ?? '' }}" readonly 
                                           style="width:100%;height:100%;border:none;background:transparent;text-align:center;font-size:10pt;color:#000;padding:2px;">
                                </td>
                                <td style="border:2px solid #000; padding:0;">
                                    <input type="text" value="{{ $detail->ulangan01 ?? '' }}" readonly 
                                           style="width:100%;height:100%;border:none;background:transparent;text-align:center;font-size:10pt;color:#000;padding:2px;">
                                </td>
                                <td style="border:2px solid #000; padding:0;">
                                    <input type="text" value="{{ $detail->ulangan02 ?? '' }}" readonly 
                                           style="width:100%;height:100%;border:none;background:transparent;text-align:center;font-size:10pt;color:#000;padding:2px;">
                                </td>
                                <td style="border:2px solid #000; padding:0;">
                                    <input type="text" value="{{ $detail->ulangan03 ?? '' }}" readonly 
                                           style="width:100%;height:100%;border:none;background:transparent;text-align:center;font-size:10pt;color:#000;padding:2px;">
                                </td>
                                <td style="border:2px solid #000; padding:0;">
                                    <input type="text" value="{{ $detail->ulangan04 ?? '' }}" readonly 
                                           style="width:100%;height:100%;border:none;background:transparent;text-align:center;font-size:10pt;color:#000;padding:2px;">
                                </td>
                                <td style="border:2px solid #000; padding:0;">
                                    <input type="text" value="{{ $detail->ulangan05 ?? '' }}" readonly 
                                           style="width:100%;height:100%;border:none;background:transparent;text-align:center;font-size:10pt;color:#000;padding:2px;">
                                </td>
                            </tr>
                        @endfor
                    </table>

                    <!-- Footer Section -->
                    <div class="data-complete-section">
                        <span class="data-complete-text">Data telah diisi dengan lengkap dan jelas!</span>
                    </div>

                    <!-- ALAT STANDAR + CHECKBOX (mengikuti form 1) -->
                    <table class="alat-standar-table">
                        <tr>
                            <td rowspan="5" style="width:20%; text-align:center; font-weight:bold; font-size:14px;">
                                Alat Standar
                            </td>
                            <td style="width:5%; text-align:center;">
                                <input type="checkbox" class="alat-standar-checkbox" 
                                    {{ str_contains($form1Head->standard ?? '', 'Gauge Block (150mm) D.007') ? 'checked' : '' }} disabled>
                            </td>
                            <td colspan="2">Gauge Block (150mm) D.007</td>
                            <td rowspan="5" style="width:20%; text-align:center;">Dikalibrasi<br>oleh</td>
                            <td rowspan="5" style="width:20%; text-align:center;">Diperiksa<br>oleh</td>
                        </tr>
                        <tr>
                            <td style="text-align:center;">
                                <input type="checkbox" class="alat-standar-checkbox" 
                                    {{ str_contains($form1Head->standard ?? '', 'Gauge Block (300mm) D.008') ? 'checked' : '' }} disabled>
                            </td>
                            <td colspan="2">Gauge Block (300mm) D.008</td>
                        </tr>
                        <tr>
                            <td style="text-align:center;">
                                <input type="checkbox" class="alat-standar-checkbox" 
                                    {{ str_contains($form1Head->standard ?? '', 'Gauge Block (300mm) D.009') ? 'checked' : '' }} disabled>
                            </td>
                            <td colspan="2">Gauge Block (300mm) D.009</td>
                        </tr>
                        <tr>
                            <td style="text-align:center;">
                                <input type="checkbox" class="alat-standar-checkbox" 
                                    {{ str_contains($form1Head->standard ?? '', 'Gauge Block Set Grade 0.5 ~ 100 mm 0 D.012') ? 'checked' : '' }} disabled>
                            </td>
                            <td colspan="2">Gauge Block Set Grade 0.5 ~ 100 mm 0 D.012</td>
                        </tr>
                        <tr>
                            <td style="text-align:center;">
                                <input type="checkbox" class="alat-standar-checkbox" 
                                    {{ str_contains($form1Head->standard ?? '', 'Gauge Block Set Grade 2.5 ~ 25 mm 0 D.013') ? 'checked' : '' }} disabled>
                            </td>
                            <td colspan="2">Gauge Block Set Grade 2.5 ~ 25 mm 0 D.013</td>
                        </tr>
                        <tr>
                            <td style="font-weight:bold;">Metode Kalibrasi</td>
                            <td colspan="3">PAS-IK1102-06 (JIS B 7544 : 1994)</td>
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
                <!--<button onclick="window.print()" class="btn btn-primary btn-lg ms-3">-->
                <!--    <i class="fas fa-print me-2"></i>Cetak-->
                <!--</button>-->
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>