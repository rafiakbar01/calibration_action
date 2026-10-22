<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Kalibrasi Thermometer - PT. PANANJUNG ANUGRAH SOLUTION</title>
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

    .setting-suhu-table {
        border-collapse: collapse;
        width: 100%;
    }
    
    .setting-suhu-table td, .setting-suhu-table th {
        border: 1pt solid #000;
        padding: 8px;
        vertical-align: middle;
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
        $form1Head = $calibration->headThermometerForm1;
    @endphp

    <div class="container my-4">
         @for($formIndex = 1; $formIndex <= $jumlahForm; $formIndex++)
            @php
                // Gunakan relasi per form untuk head
                $head = $calibration->{'headThermometerForm' . $formIndex};
                
                // Ambil DETAILS BERDASARKAN form_index
                $formDetails = $calibration->detailThermometers->where('form_index', $formIndex)->sortBy('id');
                
                // Ambil data untuk Alat Standar & Metode Kalibrasi per form
                $standardValue = $head->standard ?? '';
                $calibrationMethodValue = $head->calibrationMethod ?? '';
                $calibratedByValue = $calibration->calibratedBy ?? '';
                $verifiedByValue = $head->verified_by ?? '';
            @endphp


            <div class="form-card">
                <div class="form-card-header">
                    <i class="fas fa-file-alt me-2"></i>
                    Form Thermometer ke-{{ $formIndex }}
                </div>
                
                <div class="form-card-body">
                    <!-- Header Table -->
                    <table class="kalibrasi-header-table">
                        <tr>
                            <td colspan="2">
                                <p style="margin: 0; font-size: 14px;">PAS-FLK30</p>
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
                                <p style="margin: 0; font-weight: bold; font-size: 14px;">THERMOMETER</p>
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
                            <td><p style="margin: 0;">Rentang Ukur</p></td>
                            <td colspan="3">
                                <div class="d-flex align-items-center">
                                    <div class="me-3" style="width: 45%;">
                                        <input type="text" class="kalibrasi-input" 
                                               value="{{ $head->rentang_ukur_min ?? '0' }}" readonly>
                                    </div>
                                    <span class="me-3">-</span>
                                    <div style="width: 45%;">
                                        <input type="text" class="kalibrasi-input" 
                                               value="{{ $head->rentang_ukur_max ?? '0' }}" readonly>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><p style="margin: 0;">Kapasitas / Resolusi</p></td>
                            <td colspan="3">
                                <div class="d-flex align-items-center">
                                    <input type="text" class="kalibrasi-input me-3" 
                                           value="{{ $head->kapasitas ?? '-' }}" readonly style="width: 45%;">
                                    <span class="me-3">/</span>
                                    <input type="text" class="kalibrasi-input" 
                                           value="{{ $head->resolusi ?? '-' }}" readonly style="width: 45%;">
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
                                           value="{{ $head->keterangan_fungsi_komponen ?? '-' }}" readonly>
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
                    
                    <div class="setting-suhu-container" style="margin-bottom: 30px;">
                        <div style="display: flex; justify-content: space-between;">
                            <!-- Tabel Kiri -->
                            <table class="setting-suhu-table" style="border-collapse: collapse; width: 48%;">
                                <tr>
                                    <th rowspan="2" style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; font-size: 10pt; background-color: #f0f0f0;">
                                        Setting Suhu<br>
                                        <span style="font-size: 9pt; font-weight: normal; margin-top: 5px; display: block;">
                                            {{ $head->satuan_suhu_kiri ?? $form1Head->satuan_suhu_kiri ?? ' ' }}
                                        </span>
                                    </th>
                                    <th colspan="2" style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; font-size: 10pt; background-color: #f0f0f0;">
                                        Pembacaan
                                    </th>
                                </tr>
                                <tr>
                                    <th style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; font-size: 10pt; background-color: #f0f0f0;">STD</th>
                                    <th style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; font-size: 10pt; background-color: #f0f0f0;">UUT</th>
                                </tr>

                                @php
                                    $leftDetails = $formDetails->slice(0, 6);
                                    $leftDetailsArray = $leftDetails->values();
                                @endphp

                                @for($i = 0; $i < 6; $i++)
                                    @php
                                        $detail = $leftDetailsArray[$i] ?? null;
                                        $titikUkur = $detail->titikUkur ?? '';
                                        $std01 = $detail->STD01 ?? '';
                                        $std02 = $detail->STD02 ?? '';
                                        $std03 = $detail->STD03 ?? '';
                                        $uut01 = $detail->UUT01 ?? '';
                                        $uut02 = $detail->UUT02 ?? '';
                                        $uut03 = $detail->UUT03 ?? '';
                                    @endphp
                                    <tr>
                                        <td rowspan="3" style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 90px;">
                                            <input type="text" value="{{ $titikUkur }}" readonly
                                                   style="width: 80%; border: none; text-align: center; background: transparent; font-size: 10pt;">
                                        </td>
                                        <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 30px;">
                                            <input type="text" value="{{ $std01 }}" readonly
                                                   style="width: 90%; border: none; text-align: center; background: transparent; font-size: 9pt;">
                                        </td>
                                        <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 30px;">
                                            <input type="text" value="{{ $uut01 }}" readonly
                                                   style="width: 90%; border: none; text-align: center; background: transparent; font-size: 9pt;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 30px;">
                                            <input type="text" value="{{ $std02 }}" readonly
                                                   style="width: 90%; border: none; text-align: center; background: transparent; font-size: 9pt;">
                                        </td>
                                        <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 30px;">
                                            <input type="text" value="{{ $uut02 }}" readonly
                                                   style="width: 90%; border: none; text-align: center; background: transparent; font-size: 9pt;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 30px;">
                                            <input type="text" value="{{ $std03 }}" readonly
                                                   style="width: 90%; border: none; text-align: center; background: transparent; font-size: 9pt;">
                                        </td>
                                        <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 30px;">
                                            <input type="text" value="{{ $uut03 }}" readonly
                                                   style="width: 90%; border: none; text-align: center; background: transparent; font-size: 9pt;">
                                        </td>
                                    </tr>
                                @endfor
                            </table>

                            <!-- Tabel Kanan (Lanjutan) -->
                            <table class="setting-suhu-table" style="border-collapse: collapse; width: 48%;">
                                <tr>
                                    <th rowspan="2" style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; font-size: 10pt; background-color: #f0f0f0;">
                                        Setting Suhu<br>
                                        <span style="font-size: 9pt; font-weight: normal; margin-top: 5px; display: block;">
                                            {{ $head->satuan_suhu_kanan ?? $form1Head->satuan_suhu_kanan ?? ' ' }}
                                        </span>
                                    </th>
                                    <th colspan="2" style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; font-size: 10pt; background-color: #f0f0f0;">
                                        Pembacaan
                                    </th>
                                </tr>
                                <tr>
                                    <th style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; font-size: 10pt; background-color: #f0f0f0;">STD</th>
                                    <th style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; font-size: 10pt; background-color: #f0f0f0;">UUT</th>
                                </tr>

                                @php
                                    $rightDetails = $formDetails->slice(6, 6);
                                    $rightDetailsArray = $rightDetails->values();
                                @endphp

                                @for($i = 0; $i < 6; $i++)
                                    @php
                                        $detail = $rightDetailsArray[$i] ?? null;
                                        $titikUkur = $detail->titikUkur ?? '';
                                        $std01 = $detail->STD01 ?? '';
                                        $std02 = $detail->STD02 ?? '';
                                        $std03 = $detail->STD03 ?? '';
                                        $uut01 = $detail->UUT01 ?? '';
                                        $uut02 = $detail->UUT02 ?? '';
                                        $uut03 = $detail->UUT03 ?? '';
                                    @endphp
                                    <tr>
                                        <td rowspan="3" style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 90px;">
                                            <input type="text" value="{{ $titikUkur }}" readonly
                                                   style="width: 80%; border: none; text-align: center; background: transparent; font-size: 10pt;">
                                        </td>
                                        <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 30px;">
                                            <input type="text" value="{{ $std01 }}" readonly
                                                   style="width: 90%; border: none; text-align: center; background: transparent; font-size: 9pt;">
                                        </td>
                                        <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 30px;">
                                            <input type="text" value="{{ $uut01 }}" readonly
                                                   style="width: 90%; border: none; text-align: center; background: transparent; font-size: 9pt;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 30px;">
                                            <input type="text" value="{{ $std02 }}" readonly
                                                   style="width: 90%; border: none; text-align: center; background: transparent; font-size: 9pt;">
                                        </td>
                                        <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 30px;">
                                            <input type="text" value="{{ $uut02 }}" readonly
                                                   style="width: 90%; border: none; text-align: center; background: transparent; font-size: 9pt;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 30px;">
                                            <input type="text" value="{{ $std03 }}" readonly
                                                   style="width: 90%; border: none; text-align: center; background: transparent; font-size: 9pt;">
                                        </td>
                                        <td style="border: 1pt solid #000; padding: 8px; text-align: center; vertical-align: middle; height: 30px;">
                                            <input type="text" value="{{ $uut03 }}" readonly
                                                   style="width: 90%; border: none; text-align: center; background: transparent; font-size: 9pt;">
                                        </td>
                                    </tr>
                                @endfor
                            </table>
                        </div>
                    </div>
 
        
     
     <table class="kalibrasi-main-table">
    <tr>
        <td colspan="6" style="text-align: center; border-bottom: 1px solid #000;">
            <span style="font-weight: bold; font-size: 18px; color: #000000;">Data telah diisi dengan lengkap dan jelas!</span>
        </td>
    </tr>

    @php
        // Logika pengecekan yang benar untuk data "TD.001 Microbath & Dry Block"
        $checkTd001 = str_contains($standardValue, 'TD.001');
        $checkTd002 = str_contains($standardValue, 'TD.002');
        $checkTd003 = str_contains($standardValue, 'TD.003');
        $checkTd004 = str_contains($standardValue, 'TD.004');
        
        // Cek apakah mengandung "Microbath & Dry Block" sebagai satu kesatuan
        $hasMicrobathDryBlock = str_contains($standardValue, 'Microbath & Dry Block');
        
        // Hanya check Microbath jika ada "Microbath" TAPI BUKAN "Microbath & Dry Block"
        $checkMicrobath = str_contains($standardValue, 'Microbath') && !$hasMicrobathDryBlock;
        
        // Hanya check Dry Block jika ada "Dry Block" TAPI BUKAN "Microbath & Dry Block"
        $checkDryBlock = str_contains($standardValue, 'Dry Block') && !$hasMicrobathDryBlock;
        
        // Check Microbath & Dry Block jika ada
        $checkMicrobathDryBlock = $hasMicrobathDryBlock;
        
        // Untuk metode kalibrasi
        $checkMetode1 = str_contains($calibrationMethodValue, 'PAS-IK1102-30');
        $checkMetode2 = str_contains($calibrationMethodValue, 'PAS-IK1102-31');
        $checkMetode3 = str_contains($calibrationMethodValue, 'PAS-IK1102-32');
    @endphp

    <tr style="height:13.5pt">
        <td rowspan="4" style="width:105.35pt; border:1pt solid #000; vertical-align:middle; text-align:center; font-weight:bold; font-size:10pt; color:#000000;">
            Standard
        </td>

        <td style="width:24.75pt; border:1pt solid #000; text-align:center; vertical-align:middle;">
            <input type="checkbox" name="alat_standar_{{ $formIndex }}[]" value="TD.001" id="std1_{{ $formIndex }}"
                {{ $checkTd001 ? 'checked' : '' }} disabled>
        </td>
        <td style="width:63.6pt; border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
            <label for="std1_{{ $formIndex }}" style="cursor:pointer; color:#000000;">TD.001</label>
        </td>
        <td style="width:15.55pt; border:1pt solid #000; text-align:center; vertical-align:middle;">
            <input type="checkbox" name="alat_standar_{{ $formIndex }}[]" value="Microbath" id="jenis1_{{ $formIndex }}"
                {{ $checkMicrobath ? 'checked' : '' }} disabled>
        </td>
        <td style="width:84.3pt; border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
            <label for="jenis1_{{ $formIndex }}" style="cursor:pointer; color:#000000;">Microbath</label>
        </td>

        <td rowspan="4" style="width:111.15pt; border-top:1pt solid #000; border-right:1pt solid #000; border-left:1pt solid #000; border-bottom:none; padding-top:6pt; text-align:center; vertical-align:top; font-size:8.5pt; color:#000000;">
            Dikalibrasi<br>oleh
        </td>
        <td rowspan="4" style="width:98.3pt; border-top:1pt solid #000; border-right:1pt solid #000; border-left:1pt solid #000; border-bottom:none; padding-top:6pt; text-align:center; vertical-align:top; font-size:8.5pt; color:#000000;">
            Diperiksa<br>oleh
        </td>
    </tr>

    <tr style="height:13.5pt">
        <td style="border:1pt solid #000; text-align:center; vertical-align:middle;">
            <input type="checkbox" name="alat_standar_{{ $formIndex }}[]" value="TD.002" id="std2_{{ $formIndex }}"
                {{ $checkTd002 ? 'checked' : '' }} disabled>
        </td>
        <td style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
            <label for="std2_{{ $formIndex }}" style="cursor:pointer; color:#000000;">TD.002</label>
        </td>
        <td style="border:1pt solid #000; text-align:center; vertical-align:middle;">
            <input type="checkbox" name="alat_standar_{{ $formIndex }}[]" value="Dry Block" id="jenis2_{{ $formIndex }}"
                {{ $checkDryBlock ? 'checked' : '' }} disabled>
        </td>
        <td style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
            <label for="jenis2_{{ $formIndex }}" style="cursor:pointer; color:#000000;">Dry Block</label>
        </td>
    </tr>

    <tr style="height:13.5pt">
        <td style="border:1pt solid #000; text-align:center; vertical-align:middle;">
            <input type="checkbox" name="alat_standar_{{ $formIndex }}[]" value="TD.003" id="std3_{{ $formIndex }}"
                {{ $checkTd003 ? 'checked' : '' }} disabled>
        </td>
        <td style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
            <label for="std3_{{ $formIndex }}" style="cursor:pointer; color:#000000;">TD.003</label>
        </td>
        <td rowspan="2" style="width:15.55pt; border:1pt solid #000; text-align:center; vertical-align:middle;">
            <input type="checkbox" name="alat_standar_{{ $formIndex }}[]" value="Microbath & Dry Block" id="jenis4_{{ $formIndex }}"
                {{ $checkMicrobathDryBlock ? 'checked' : '' }} disabled>
        </td>
        <td rowspan="2" style="width:84.3pt; border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
            <label for="jenis4_{{ $formIndex }}" style="cursor:pointer; color:#000000;">Microbath & Dry Block</label>
        </td>
    </tr>

    <tr style="height:13.5pt">
        <td style="border:1pt solid #000; text-align:center; vertical-align:middle;">
            <input type="checkbox" name="alat_standar_{{ $formIndex }}[]" value="TD.004" id="std4_{{ $formIndex }}"
                {{ $checkTd004 ? 'checked' : '' }} disabled>
        </td>
        <td style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
            <label for="std4_{{ $formIndex }}" style="cursor:pointer; color:#000000;">TD.004</label>
        </td>
    </tr>

    <!-- METODE KALIBRASI + TTD & NAMA -->
    <tr style="height:15pt">
        <td rowspan="4" style="width:105.35pt; border:1pt solid #000; vertical-align:middle; text-align:center; font-weight:bold; font-size:10pt; color:#000000;">
            Metode Kalibrasi
        </td>
        
        <td style="width:24.75pt; border:1pt solid #000; text-align:center; vertical-align:middle;">
            <input type="checkbox" name="metode_kalibrasi_{{ $formIndex }}[]" value="PAS-IK1102-30 (Thermometer Digital)" id="metode1_{{ $formIndex }}"
                {{ $checkMetode1 ? 'checked' : '' }} disabled>
        </td>
        <td colspan="3" style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
            <label for="metode1_{{ $formIndex }}" style="cursor:pointer; color:#000000;">PAS-IK1102-30 (Thermometer Digital)</label>
        </td>
        
        <td style="width:111.15pt; border-top:none; border-right:1pt solid #000; border-left:1pt solid #000; border-bottom:1pt solid #000; padding:3.35pt 0 0 1.35pt; font-size:8.5pt; vertical-align:top; color:#000000;">
            &nbsp;
        </td>
        <td style="width:98.3pt; border-top:none; border-right:1pt solid #000; border-left:1pt solid #000; border-bottom:1pt solid #000; padding:3.35pt 0 0 1.8pt; font-size:8.5pt; vertical-align:top; color:#000000;">
            &nbsp;
        </td>
    </tr>

    <tr style="height:15pt">
        <td style="border:1pt solid #000; text-align:center; vertical-align:middle;">
            <input type="checkbox" name="metode_kalibrasi_{{ $formIndex }}[]" value="PAS-IK1102-31 (Thermometer Gelas)" id="metode2_{{ $formIndex }}"
                {{ $checkMetode2 ? 'checked' : '' }} disabled>
        </td>
        <td colspan="3" style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
            <label for="metode2_{{ $formIndex }}" style="cursor:pointer; color:#000000;">PAS-IK1102-31 (Thermometer Gelas)</label>
        </td>
        
        <td style="width:111.15pt; border-top:none; border-right:1pt solid #000; border-left:1pt solid #000; border-bottom:1pt solid #000; padding:1.8pt 0 0 1.35pt; font-size:8.5pt; vertical-align:top; color:#000000;">
            TTD :
        </td>
        <td style="width:98.3pt; border-top:none; border-right:1pt solid #000; border-left:1pt solid #000; border-bottom:1pt solid #000; padding:1.8pt 0 0 1.8pt; font-size:8.5pt; vertical-align:top; color:#000000;">
            TTD :
        </td>
    </tr>

    <tr style="height:15pt">
        <td style="border:1pt solid #000; text-align:center; vertical-align:middle;">
            <input type="checkbox" name="metode_kalibrasi_{{ $formIndex }}[]" value="PAS-IK1102-32 (Thermometer Dial)" id="metode3_{{ $formIndex }}"
                {{ $checkMetode3 ? 'checked' : '' }} disabled>
        </td>
        <td colspan="3" style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
            <label for="metode3_{{ $formIndex }}" style="cursor:pointer; color:#000000;">PAS-IK1102-32 (Thermometer Dial)</label>
        </td>
        
        <td style="width:111.15pt; border-top:none; border-right:1pt solid #000; border-left:1pt solid #000; border-bottom:1pt solid #000; padding:1.8pt 0 0 1.35pt; font-size:8.5pt; vertical-align:top; color:#000000;">
            <input type="text" name="calibratedBy_{{ $formIndex }}" class="kalibrasi-input" 
                   value="{{ $calibratedByValue }}" 
                   placeholder="Nama" 
                   style="border: none; width: 100%; background-color: #f8f9fa;" 
                   readonly>
        </td>
        <td style="width:98.3pt; border-top:none; border-right:1pt solid #000; border-left:1pt solid #000; border-bottom:1pt solid #000; padding:1.8pt 0 0 1.8pt; font-size:8.5pt; vertical-align:top; color:#000000;">
            <input type="text" name="verifiedBy_{{ $formIndex }}" class="kalibrasi-input" 
                   value="{{ $verifiedByValue }}" 
                   placeholder="-" 
                   style="border: none; width: 100%;" 
                   readonly>
        </td>
    </tr>
</table>
        
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