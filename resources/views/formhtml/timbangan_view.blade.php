<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Kalibrasi Timbangan - PT. PANANJUNG ANUGRAH SOLUTION</title>
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
        opacity: 1;
    }
    
    .view-checkbox-label {
        cursor: default;
        user-select: none;
        margin-left: 3px;
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
        $details = $calibration->detailTimbangans ?? collect();
        $adds = $calibration->addTimbangans ?? collect();
           
    @endphp

    <div class="container my-4" style="width: 95%; max-width: 1600px;">
        @for($formIndex = 1; $formIndex <= $jumlahForm; $formIndex++)
            @php
                $head = $calibration->{'headTimbanganForm' . $formIndex};
                $form1Head = $calibration->headTimbanganForm1;
                
                 $formAdd = $calibration->{'addTimbanganForm' . $formIndex};
                // Ambil DETAILS berdasarkan form_index
                $formDetails = $calibration->detailTimbangans->where('form_index', $formIndex)->sortBy('id');
               
            @endphp

            <div class="form-card">
                <div class="form-card-header">
                    <i class="fas fa-weight-hanging me-2"></i>
                    Form Timbangan ke-{{ $formIndex }}
                </div>
                
                <div class="form-card-body">
                    <!-- Header Table -->
                    <table class="kalibrasi-header-table">
                        <tr>
                            <td colspan="2">
                                <p style="margin: 0; font-size: 14px;">PAS-FLK15</p>
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
                                <p style="margin: 0; font-weight: bold; font-size: 14px;">TIMBANGAN</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="height: 10px;"></div>
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

                    <!-- Main Form Section - Readonly -->
                    <table class="kalibrasi-main-table">
                        <tr>
                            <td style="width: 20%;"><p style="margin: 0;">Nama Alat</p></div>
                            <td colspan="3">
                                <input type="text" class="kalibrasi-input" value="{{ $calibration->namaAlat ?? '-' }}" readonly>
                            </div>
                        </tr>
                        <tr>
                            <td><p style="margin: 0;">Merek</p></div>
                            <td colspan="3">
                                <div class="d-flex align-items-center">
                                    <input type="text" class="kalibrasi-input me-3" value="{{ $calibration->brandAlat ?? '-' }}" readonly style="width: 60%;">
                                    <span class="me-3">Kode Alat :</span>
                                    <input type="text" class="kalibrasi-input" value="{{ $calibration->kodeAlat ?? '-' }}" readonly style="width: 30%;">
                                </div>
                            </div>
                        </tr>
                        <tr>
                            <td><p style="margin: 0;">Type / No. Seri</p></div>
                            <td colspan="3">
                                <div class="d-flex align-items-center">
                                    <input type="text" class="kalibrasi-input me-3" value="{{ $calibration->typeAlat ?? '-' }}" readonly style="width: 45%;">
                                    <span class="me-3">/</span>
                                    <input type="text" class="kalibrasi-input" value="{{ $calibration->NoSeri ?? '-' }}" readonly style="width: 45%;">
                                </div>
                            </div>
                        </tr>
                        <tr>
                            <td><p style="margin: 0;">Kapasitas / Resolusi</p></div>
                            <td colspan="3">
                                <div class="d-flex align-items-center">
                                    <input type="text" class="kalibrasi-input me-3" value="{{ $calibration->kapasitas ?? '-' }}" readonly style="width: 45%;">
                                    <span class="me-3">/</span>
                                    <input type="text" class="kalibrasi-input" value="{{ $calibration->resolusi ?? '-' }}" readonly style="width: 45%;">
                                </div>
                            </div>
                        </tr>
                        <tr>
                            <td><p style="margin: 0;">Nama Pemilik</p></div>
                            <td colspan="3">
                                <input type="text" class="kalibrasi-input" value="{{ $calibration->pemilikAlat ?? '-' }}" readonly>
                            </div>
                        </tr>
                        <tr>
                            <td><p style="margin: 0;">Tanggal Alat Masuk</p></div>
                            <td colspan="3">
                                <input type="text" class="kalibrasi-input" value="{{ $calibration->tanggalMasuk ? \Carbon\Carbon::parse($calibration->tanggalMasuk)->format('d/m/Y') : '-' }}" readonly>
                            </div>
                        </tr>
                        <tr>
                            <td><p style="margin: 0;">Tanggal Kalibrasi</p></div>
                            <td colspan="3">
                                <div class="d-flex align-items-center">
                                    <input type="text" class="kalibrasi-input me-3" value="{{ $calibration->tanggalKalibrasi ? \Carbon\Carbon::parse($calibration->tanggalKalibrasi)->format('d/m/Y') : '-' }}" readonly style="width: 45%;">
                                    <span class="me-3">Jenis Pembacaan:</span>
                                    <input type="text" class="kalibrasi-input" value="{{ $calibration->jenisPembacaan ?? '-' }}" readonly style="width: 45%;">
                                </div>
                            </div>
                        </tr>
                        <tr>
                            <td><p style="margin: 0;">Tempat Kalibrasi</p></div>
                            <td colspan="3">
                                <div class="d-flex">
                                    <div class="form-check me-5">
                                        <input class="form-check-input" type="radio" {{ $calibration->tempatKalibrasi == 'lab.PT PAS' ? 'checked' : '' }} disabled>
                                        <label class="form-check-label">Lab. PT.PAS</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" {{ $calibration->tempatKalibrasi == 'insitu' ? 'checked' : '' }} disabled>
                                        <label class="form-check-label">Insitu</label>
                                    </div>
                                </div>
                            </div>
                        </tr>
                        <tr>
                            <td><p style="margin: 0;">Lokasi PT</p></div>
                            <td colspan="3">
                                <input type="text" class="kalibrasi-input" value="{{ $calibration->lokasiPT ?? '-' }}" readonly>
                            </div>
                        </tr>
                    </table>

                    <!-- Fungsi Komponen Lainnya & Kondisi Kalibrasi -->
                    <div class="row mt-4">
                        <div class="col-md-6 mb-4">
                            <div class="kalibrasi-section-header">Fungsi Komponen Lainnya</div>
                            
                            <div class="d-flex justify-content-center align-items-center mb-4" style="gap: 60px;">
                                <div class="text-center">
                                    <span class="fw-bold d-block mb-2">Ok</span>
                                    <input type="radio" class="form-check-input" {{ $calibration->kondisiAlat == 'ok' ? 'checked' : '' }} disabled>
                                </div>
                                <div class="text-center">
                                    <span class="fw-bold d-block mb-2">Rusak</span>
                                    <input type="radio" class="form-check-input" {{ $calibration->kondisiAlat == 'rusak' ? 'checked' : '' }} disabled>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center">
                                <span class="fw-bold me-3" style="min-width: 100px;">Keterangan :</span>
                                <div style="flex: 1;">
                                    <input type="text" class="kalibrasi-input" value="{{ $calibration->keterangan ?? '-' }}" readonly>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="kalibrasi-section-header">Kondisi Kalibrasi</div>
                            
                            <table class="table table-bordered">
                                <tr>
                                    <td class="table-secondary fw-bold" style="width: 30%;"></div>
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
                    
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr valign="top">
                            <!-- Blok Kiri: Setengah Kapasitas Max -->
                            <td width="33%" valign="top" style="padding-right: 20px;">
                                <b>Pemeriksaan Nilai Repeatability</b><br><br>
                                Setengah Kapasitas = {{ $head->setengah_kapasitas ?? '' }}<br><br>

                                <table style="border-collapse: collapse; width: 100%;">
                                    <tr style="background: #cccccc;">
                                        <td style="border:2px solid #000; padding:8px; text-align:center; width:50%;"><b>Penunjukan z1</b></div>
                                        <td style="border:2px solid #000; padding:8px; text-align:center; width:50%;"><b>Penunjukan m1</b></div>
                                    </tr>
                                    @for($i = 1; $i <= 10; $i++)
                                    <tr>
                                        <td style="border:2px solid #000; padding:0;">
                                            <input type="text" value="{{ $formAdd->{'HalfMax_z1_' . sprintf('%02d', $i)} ?? '' }}" 
                                                   style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;" readonly>
                                        </div>
                                        <td style="border:2px solid #000; padding:0;">
                                            <input type="text" value="{{ $formAdd->{'HalfMax_m1_' . sprintf('%02d', $i)} ?? '' }}" 
                                                   style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;" readonly>
                                        </div>
                                    </tr>
                                    @endfor
                                </table>
                            </div>

                            <!-- Blok Tengah: Kapasitas Max -->
                            <td width="33%" valign="top" style="padding-right: 20px;">
                                <b>Pemeriksaan Nilai Repeatability</b><br><br>
                                Kapasitas Max = {{ $head->kapasitas_max ?? '' }} <br><br>

                                <table style="border-collapse: collapse; width: 100%;">
                                    <tr style="background: #cccccc;">
                                        <td style="border:2px solid #000; padding:8px; text-align:center; width:50%;"><b>Penunjukan z1</b></div>
                                        <td style="border:2px solid #000; padding:8px; text-align:center; width:50%;"><b>Penunjukan m1</b></div>
                                    </tr>
                                    @for($i = 1; $i <= 10; $i++)
                                    <tr>
                                        <td style="border:2px solid #000; padding:0;">
                                            <input type="text" value="{{ $formAdd->{'FullMax_z1_' . sprintf('%02d', $i)} ?? '' }}" 
                                                   style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;" readonly>
                                        </div>
                                        <td style="border:2px solid #000; padding:0;">
                                            <input type="text" value="{{ $formAdd->{'FullMax_m1_' . sprintf('%02d', $i)} ?? '' }}" 
                                                   style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;" readonly>
                                        </div>
                                    </tr>
                                    @endfor
                                </table>
                            </div>

                            <!-- Blok Kanan: CATATAN PENTING -->
                            <td width="34%" valign="top">
                                <table style="border-collapse: collapse; width: 100%;">
                                    <tr>
                                        <td style="border:2px solid #000; background: #ffffff; text-align:center; padding:15px;">
                                            <b style="font-size: 18px;">CATATAN PENTING</b>
                                        </div>
                                    </tr>
                                    <tr>
                                        <td style="border:2px solid #000; background: #ffffff; padding:0; height: 500px;">
                                            <textarea style="width:100%; height:100%; border:none; background:transparent; padding:15px; resize:none; box-sizing:border-box;" readonly>{{ $head->note ?? '' }}</textarea>
                                        </div>
                                    </tr>
                                </table>
                            </div>
                        </tr>
                    </table>

                    <div style="margin-top: 40px; margin-bottom: 20px;"></div>

                    <p style="margin-top:4.6pt; margin-left:12.2pt; margin-bottom:0.65pt">Pemeriksaan Nilai Nominal</p>
                    <table style="border-collapse: collapse; width: 100%; margin-left:10.92pt; border:2px solid #000000;">
                        <tr style="background: #bebebe;">
                            <td style="border:2px solid #000; padding:8px; text-align:center; font-weight:bold;">Skala Nominal</div>
                            <td style="border:2px solid #000; padding:8px; text-align:center; font-weight:bold;">z1</div>
                            <td style="border:2px solid #000; padding:8px; text-align:center; font-weight:bold;">m1</div>
                            <td style="border:2px solid #000; padding:8px; text-align:center; font-weight:bold;">m1</div>
                            <td style="border:2px solid #000; padding:8px; text-align:center; font-weight:bold;">z1</div>
                            <td style="border:2px solid #000; padding:8px; text-align:center; font-weight:bold;">Standar Anak Timbangan yang Digunakan</div>
                        </tr>
                        
                        @php
                            $detailArray = [];
                            foreach ($formDetails as $detail) {
                                $detailArray[] = $detail;
                            }
                        @endphp
                        
                        @for($i = 0; $i < 10; $i++)
                            @php
                                $detail = $detailArray[$i] ?? null;
                            @endphp
                            <tr>
                                <td style="border:2px solid #000; padding:0;">
                                    <input type="text" value="{{ $detail->titikUkur ?? '' }}" 
                                           style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;" readonly>
                                </div>
                                <td style="border:2px solid #000; padding:0;">
                                    <input type="text" value="{{ $detail->Lz1 ?? '' }}" 
                                           style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;" readonly>
                                </div>
                                <td style="border:2px solid #000; padding:0;">
                                    <input type="text" value="{{ $detail->Lm1 ?? '' }}" 
                                           style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;" readonly>
                                </div>
                                <td style="border:2px solid #000; padding:0;">
                                    <input type="text" value="{{ $detail->Rm1 ?? '' }}" 
                                           style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;" readonly>
                                </div>
                                <td style="border:2px solid #000; padding:0;">
                                    <input type="text" value="{{ $detail->Rz1 ?? '' }}" 
                                           style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;" readonly>
                                </div>
                                <td style="border:2px solid #000; padding:0;">
                                    <input type="text" value="{{ $detail->STD ?? '' }}" 
                                           style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;" readonly>
                                </div>
                            </tr>
                        @endfor
                    </table>

                    <div style="margin-top: 40px; margin-bottom: 20px;"></div>

                    <p style="margin-left:12.2pt; font-size:12pt; font-weight:bold; font-style:italic;">Off-Center Loading Test</p>
                    <table border="0" cellpadding="0" cellspacing="0" style="margin-left:12.2pt; margin-bottom:1.75pt">
                        <tr>
                            <td>Beban Timbangan 1/3 atau 1/2 dari Kapasitas Maksimal =</div>
                            <td>
                                <input type="text" value="{{ $formAdd->bebanOffCenter ?? '' }}" 
                                       style="width:120px; border:1px solid #000; text-align:center; padding:2px;" readonly>
                            </div>
                            <td>&nbsp;&nbsp;Diutamakan anak timbangan tunggal jika memadai.</div>
                        </tr>
                    </table>

                    <table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 100%; margin-left:10.92pt; border:2px solid #000000;">
                        <tr style="background: #bebebe;">
                            <td style="border:2px solid #000; padding:8px; text-align:center; font-weight:bold;">Posisi</div>
                            <td style="border:2px solid #000; padding:8px; text-align:center; font-weight:bold;">Tengah</div>
                            <td style="border:2px solid #000; padding:8px; text-align:center; font-weight:bold;">Depan</div>
                            <td style="border:2px solid #000; padding:8px; text-align:center; font-weight:bold;">Belakang</div>
                            <td style="border:2px solid #000; padding:8px; text-align:center; font-weight:bold;">Kanan</div>
                            <td style="border:2px solid #000; padding:8px; text-align:center; font-weight:bold;">Kiri</div>
                        </tr>
                        <tr>
                            <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold;">Beban</div>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" value="{{ $formAdd->offCenterMiddle ?? '' }}" 
                                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;" readonly>
                            </div>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" value="{{ $formAdd->offCenterFront ?? '' }}" 
                                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;" readonly>
                            </div>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" value="{{ $formAdd->offCenterBack ?? '' }}" 
                                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;" readonly>
                            </div>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" value="{{ $formAdd->offCenterRight ?? '' }}" 
                                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;" readonly>
                            </div>
                            <td style="border:2px solid #000; padding:0;">
                                <input type="text" value="{{ $formAdd->offCenterLeft ?? '' }}" 
                                       style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;" readonly>
                            </div>
                        </tr>
                    </table>

                    <p style="margin-top:0.35pt; font-size:9pt">&nbsp;</p>

                    <div class="data-complete-section">
                        <span class="data-complete-text">Data telah diisi dengan lengkap dan jelas!</span>
                    </div>

                    <!-- ALAT STANDAR Section (mengikuti form 1) -->
                    <table class="alat-standar-table">
                        <tr>
                            <td rowspan="2" style="width:20%; text-align:center; font-weight:bold; font-size:14px;">Peralatan Standard</div>
                            <td style="border:2px solid #000; padding:8px;">
                                <font>Anak Timbangan <i>class</i> :</font>
                            </div>
                            <td style="border:2px solid #000; padding:8px;">
                                @php
                                    $standardData = $form1Head->standard ?? null;
                                    $standardArray = [];
                                    if ($standardData) {
                                        if (is_array($standardData)) {
                                            $standardArray = $standardData;
                                        } elseif (is_string($standardData)) {
                                            $standardArray = array_map('trim', explode(',', $standardData));
                                        }
                                    }
                                @endphp
                                
                                <table border="0" cellpadding="0" cellspacing="5">
                                    <tr>
                                        <td style="padding:0 5px;">
                                            <input type="checkbox" class="view-checkbox" disabled @if(in_array('E2', $standardArray)) checked @endif>
                                            <label class="view-checkbox-label">E2</label>
                                        </div>
                                        <td>/</div>
                                        <td style="padding:0 5px;">
                                            <input type="checkbox" class="view-checkbox" disabled @if(in_array('F1', $standardArray)) checked @endif>
                                            <label class="view-checkbox-label">F1</label>
                                        </div>
                                        <td>/</div>
                                        <td style="padding:0 5px;">
                                            <input type="checkbox" class="view-checkbox" disabled @if(in_array('F2', $standardArray)) checked @endif>
                                            <label class="view-checkbox-label">F2</label>
                                        </div>
                                        <td>/</div>
                                        <td style="padding:0 5px;">
                                            <input type="checkbox" class="view-checkbox" disabled @if(in_array('M1', $standardArray)) checked @endif>
                                            <label class="view-checkbox-label">M1</label>
                                        </div>
                                        <td>/</div>
                                        <td style="padding:0 5px;">
                                            <input type="checkbox" class="view-checkbox" disabled @if(in_array('M2', $standardArray)) checked @endif>
                                            <label class="view-checkbox-label">M2</label>
                                        </div>
                                        <td>/</div>
                                        <td style="padding:0 5px;">
                                            <input type="checkbox" class="view-checkbox" disabled @if(in_array('M3', $standardArray)) checked @endif>
                                            <label class="view-checkbox-label">M3</label>
                                        </div>
                                    </tr>
                                </table>
                                <font size="1"><i>(centang pilihan)</i></font>
                            </div>
                            <td style="border:2px solid #000; padding:8px; text-align:center; width:20%;">
                                <font style="font-weight:bold;">Dikalibrasi oleh</font><br><br>
                                <div style="height:80px; border:1px solid #000; background-color:#fff; display:flex; align-items:flex-end; justify-content:center;">
                                    <div>
                                        <font>TTD</font><br>
                                        <div style="border-bottom:1px solid #000; width:150px; margin:10px auto 5px;">
                                            <font size="2">{{ $head->ttd_kalibrator ?? '(...........................................)' }}</font>
                                        </div>
                                    </div>
                                </div>
                                <div style="height:40px; border:1px solid #000; background-color:#fff; margin-top:10px; display:flex; align-items:center; justify-content:center;">
                                    <strong>{{ $calibration->calibratedBy ?? '' }}</strong>
                                </div>
                                <font>Nama</font>
                            </div>
                            <td style="border:2px solid #000; padding:8px; text-align:center; width:20%;">
                                <font style="font-weight:bold;">Diperiksa oleh</font><br><br>
                                <div style="height:80px; border:1px solid #000; background-color:#fff; display:flex; align-items:flex-end; justify-content:center;">
                                    <div>
                                        <font>TTD</font><br>
                                        <div style="border-bottom:1px solid #000; width:150px; margin:10px auto 5px;">
                                            <font size="2">{{ $head->ttd_pemeriksa ?? '(...........................................)' }}</font>
                                        </div>
                                    </div>
                                </div>
                                <div style="height:40px; border:1px solid #000; background-color:#fff; margin-top:10px; display:flex; align-items:center; justify-content:center;">
                                    <strong>{{ $calibration->verifiedBy ?? '' }}</strong>
                                </div>
                                <font>Nama</font>
                            </div>
                        </tr>
                        <tr>
                            <td style="border:2px solid #000; padding:8px; background-color:#f0f0f0; vertical-align:middle;">
                                <font style="font-weight:bold;">Metode Kalibrasi</font>
                            </div>
                            <td colspan="4" style="border:2px solid #000; padding:8px;">
                                <font>PAS-IK1102-15 (Monograph 4 : The Calibration of Weights and Balances, NMI Australia 2010)</font>
                            </div>
                        </tr>
                    </table>
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