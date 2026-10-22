<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Kalibrasi Anak Timbangan - PT. PANANJUNG ANUGRAH SOLUTION</title>
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

    .kalibrasi-table {
        width: 100%;
        border-collapse: collapse;
        font-family: Arial, sans-serif;
        font-size: 12px;
    }

    .kalibrasi-table th,
    .kalibrasi-table td {
        border: 1px solid #000;
        padding: 6px;
        text-align: center;
        vertical-align: middle;
    }

    .kalibrasi-table .data-cell {
        min-height: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .left {
        text-align: left;
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
        
        // Ambil semua head anak timbangan untuk calibration ini
        $allHeads = $calibration->headAnakTimbangans ?? collect();
        \Log::info('📊 VIEW - All Heads:', [
            'jumlahForm' => $jumlahForm,
            'heads_count' => $allHeads->count(),
            'heads_data' => $allHeads->toArray()
        ]);
    @endphp

    <div class="container my-4">
        @for($formIndex = 1; $formIndex <= $jumlahForm; $formIndex++)
            @php
                // Cari head untuk form ini dari collection
                $head = $allHeads->where('form_index', $formIndex)->first();
                
                // Fallback untuk data lama dimana form_index masih null
                if (!$head && $formIndex == 1) {
                    $head = $allHeads->whereNull('form_index')->first();
                }
                
                // Jika head tidak ditemukan, coba gunakan relasi dinamis
                if (!$head) {
                    $head = $calibration->{'headAnakTimbanganForm' . $formIndex} ?? null;
                }
                
                // Ambil DETAILS BERDASARKAN form_index
                $formDetails = $calibration->detailAnakTimbangans->where('form_index', $formIndex);
                
                // Fallback untuk detail jika masih kosong (mungkin karena form_index null)
                if ($formDetails->isEmpty() && $formIndex == 1) {
                    $formDetails = $calibration->detailAnakTimbangans->whereNull('form_index');
                }
                $formDetails = $formDetails->sortBy('id');
                
                // Ambil data untuk Alat Standar
                $standardValue = $head->standard ?? '';
                $calibratedByValue = $calibration->calibratedBy ?? '';
                $verifiedByValue = $head->verified_by ?? '';
                
                // Ambil satuan unit
                $satuanUnit01 = $head->satuan_unit01 ?? '';
                $satuanUnit02 = $head->satuan_unit02 ?? '';
                
                // Certificate ID
                $certificateId = $head->certificate_id ?? $calibration->certificate_id ?? 'N/A';
                
                \Log::info('📊 VIEW - Form ' . $formIndex . ':', [
                    'head_exists' => !is_null($head),
                    'head_id' => $head->id ?? null,
                    'details_count' => $formDetails->count(),
                    'certificate_id' => $certificateId,
                    'satuan_unit01' => $satuanUnit01,
                    'satuan_unit02' => $satuanUnit02,
                    'standard' => $standardValue
                ]);
            @endphp

            <div class="form-card">
                <div class="form-card-header">
                    <i class="fas fa-weight-scale me-2"></i>
                    Form Anak Timbangan ke-{{ $formIndex }}
                </div>
                
                <div class="form-card-body">
                    <!-- Header Table -->
                    <table class="kalibrasi-header-table">
                        <tr>
                            <td colspan="2">
                                <p style="margin: 0; font-size: 14px;">PAS-FLK16</p>
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
                                <p style="margin: 0; font-weight: bold; font-size: 14px;">ANAK TIMBANGAN</p>
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
                                    {{ $certificateId }}
                                </p>
                            </td>
                        </tr>
                    </table>

                    <!-- Main Form Section -->
                    <table class="kalibrasi-main-table">
                        <!-- Nama Alat -->
                        <tr>
                            <td style="width: 20%;"><p style="margin: 0;">Nama Alat</p></td>
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
                                           value="{{ $head->kapasitas ?? $calibration->kapasitas ?? '-' }}" readonly style="width: 45%;">
                                    <span class="me-3">/</span>
                                    <input type="text" class="kalibrasi-input" 
                                           value="{{ $head->resolusi ?? $calibration->resolusi ?? '-' }}" readonly style="width: 45%;">
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

                        <!-- Tanggal Alat Masuk -->
                        <tr>
                            <td><p style="margin: 0;">Tanggal Alat Masuk</p></td>
                            <td colspan="3">
                                <input type="text" class="kalibrasi-input" 
                                       value="{{ $calibration->tanggalMasuk ? \Carbon\Carbon::parse($calibration->tanggalMasuk)->format('d/m/Y') : '-' }}" 
                                       readonly>
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

                        <!-- Lokasi PT -->
                        <tr>
                            <td><p style="margin: 0;">Lokasi PT</p></td>
                            <td colspan="3">
                                <input type="text" class="kalibrasi-input" 
                                       value="{{ $calibration->lokasiPT ?? '-' }}" readonly>
                            </td>
                        </tr>

                        <!-- Kode TH -->
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

                    <!-- ================= DATA KALIBRASI - VIEW MODE ================= -->
                    @php
                        $detailData = $formDetails;
                    @endphp

                    <div class="data-kalibrasi-header" style="font-weight: bold; margin-bottom: 10px; text-align: center;">
                        DATA KALIBRASI ANAK TIMBANGAN - Form {{ $formIndex }}
                        <span style="font-size: 12px; font-weight: normal; display: block;">
                            ({{ $detailData->count() }} data tersimpan)
                        </span>
                    </div>

                    <table class="kalibrasi-table">
                        <thead>
                            <tr>
                                <th rowspan="2">No</th>
                                <th rowspan="2">Massa Nominal</th>
                                <th colspan="3">Pembacaan Timbangan</th>
                                <th colspan="3">Pembacaan Timbangan</th>
                                <th rowspan="2">AT Standard</th>
                            </tr>
                            <tr>
                                <th colspan="3">
                                    Unit (
                                    <span style="display: inline-block; width: 50px; border-bottom: 1px solid #000; text-align: center;">
                                        {{ $satuanUnit01 }}
                                    </span>
                                    )
                                </th>
                                <th colspan="3">
                                    Unit (
                                    <span style="display: inline-block; width: 50px; border-bottom: 1px solid #000; text-align: center;">
                                        {{ $satuanUnit02 }}
                                    </span>
                                    )
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                // Ambil maksimal 5 data pertama
                                $detailArray = $detailData->values()->toArray();
                                $maxData = min(5, count($detailArray));
                            @endphp
                            
                            @if($maxData > 0)
                                @for($i = 0; $i < $maxData; $i++)
                                    @php
                                        $currentData = $detailArray[$i];
                                        
                                        if(!$currentData) {
                                            continue;
                                        }
                                        
                                        // Default values
                                        $massaNominal = $currentData['nominalAlat'] ?? '';
                                        $atStandard = $currentData['ATSTD'] ?? '';
                                        
                                        // Nilai untuk 4 baris
                                        $unit01_s_1 = $currentData['ULSTD'] ?? '';
                                        $unit02_s_1 = $currentData['URSTD'] ?? '';
                                        $unit01_t_1 = $currentData['ULUUT'] ?? '';
                                        $unit02_t_1 = $currentData['URUUT'] ?? '';
                                        $unit01_t_2 = $currentData['LLUUT'] ?? '';
                                        $unit02_t_2 = $currentData['LRUUT'] ?? '';
                                        $unit01_s_2 = $currentData['LLSTD'] ?? '';
                                        $unit02_s_2 = $currentData['LRSTD'] ?? '';
                                    @endphp
                                    
                                    <!-- Baris 1: S - S -->
                                    <tr>
                                        <td rowspan="4">{{ $i + 1 }}</td>
                                        <td rowspan="4">
                                            <div class="data-cell">{{ $massaNominal }}</div>
                                        </td>
                                        <td>S</td>
                                        <td colspan="2">
                                            <div class="data-cell">{{ $unit01_s_1 }}</div>
                                        </td>
                                        <td>S</td>
                                        <td colspan="2">
                                            <div class="data-cell">{{ $unit02_s_1 }}</div>
                                        </td>
                                        <td rowspan="4">
                                            <div class="data-cell">{{ $atStandard }}</div>
                                        </td>
                                    </tr>
                                    
                                    <!-- Baris 2: T - T -->
                                    <tr>
                                        <td>T</td>
                                        <td colspan="2">
                                            <div class="data-cell">{{ $unit01_t_1 }}</div>
                                        </td>
                                        <td>T</td>
                                        <td colspan="2">
                                            <div class="data-cell">{{ $unit02_t_1 }}</div>
                                        </td>
                                    </tr>
                                    
                                    <!-- Baris 3: T - T -->
                                    <tr>
                                        <td>T</td>
                                        <td colspan="2">
                                            <div class="data-cell">{{ $unit01_t_2 }}</div>
                                        </td>
                                        <td>T</td>
                                        <td colspan="2">
                                            <div class="data-cell">{{ $unit02_t_2 }}</div>
                                        </td>
                                    </tr>
                                    
                                    <!-- Baris 4: S - S -->
                                    <tr>
                                        <td>S</td>
                                        <td colspan="2">
                                            <div class="data-cell">{{ $unit01_s_2 }}</div>
                                        </td>
                                        <td>S</td>
                                        <td colspan="2">
                                            <div class="data-cell">{{ $unit02_s_2 }}</div>
                                        </td>
                                    </tr>
                                @endfor
                                
                                <!-- Jika data kurang dari 5, tampilkan baris kosong -->
                                @if($maxData < 5)
                                    @for($i = $maxData; $i < 5; $i++)
                                        <tr>
                                            <td rowspan="4">{{ $i + 1 }}</td>
                                            <td rowspan="4">
                                                <div class="data-cell"></div>
                                            </td>
                                            <td>S</td>
                                            <td colspan="2">
                                                <div class="data-cell"></div>
                                            </td>
                                            <td>S</td>
                                            <td colspan="2">
                                                <div class="data-cell"></div>
                                            </td>
                                            <td rowspan="4">
                                                <div class="data-cell"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>T</td>
                                            <td colspan="2">
                                                <div class="data-cell"></div>
                                            </td>
                                            <td>T</td>
                                            <td colspan="2">
                                                <div class="data-cell"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>T</td>
                                            <td colspan="2">
                                                <div class="data-cell"></div>
                                            </td>
                                            <td>T</td>
                                            <td colspan="2">
                                                <div class="data-cell"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>S</td>
                                            <td colspan="2">
                                                <div class="data-cell"></div>
                                            </td>
                                            <td>S</td>
                                            <td colspan="2">
                                                <div class="data-cell"></div>
                                            </td>
                                        </tr>
                                    @endfor
                                @endif
                            @else
                                <!-- Jika tidak ada data sama sekali -->
                                @for($i = 1; $i <= 5; $i++)
                                    <tr>
                                        <td rowspan="4">{{ $i }}</td>
                                        <td rowspan="4">
                                            <div class="data-cell"></div>
                                        </td>
                                        <td>S</td>
                                        <td colspan="2">
                                            <div class="data-cell"></div>
                                        </td>
                                        <td>S</td>
                                        <td colspan="2">
                                            <div class="data-cell"></div>
                                        </td>
                                        <td rowspan="4">
                                            <div class="data-cell"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>T</td>
                                        <td colspan="2">
                                            <div class="data-cell"></div>
                                        </td>
                                        <td>T</td>
                                        <td colspan="2">
                                            <div class="data-cell"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>T</td>
                                        <td colspan="2">
                                            <div class="data-cell"></div>
                                        </td>
                                        <td>T</td>
                                        <td colspan="2">
                                            <div class="data-cell"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>S</td>
                                        <td colspan="2">
                                            <div class="data-cell"></div>
                                        </td>
                                        <td>S</td>
                                        <td colspan="2">
                                            <div class="data-cell"></div>
                                        </td>
                                    </tr>
                                @endfor
                            @endif
                            
                            <!-- ===== KETERANGAN ===== -->
                            <tr>
                                <td colspan="9" class="left">
                                    <strong>S</strong> : anak timbang (Standard)<br>
                                    <strong>T</strong> : anak timbang (UUT)
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- ================= FOOTER SECTION ================= -->
                    @php
                        // Pisahkan alat standar jika disimpan sebagai string (dipisahkan koma)
                        $alatStandarArray = [];
                        if (!empty($standardValue)) {
                            $alatStandarArray = array_map('trim', explode(',', $standardValue));
                        }
                    @endphp

                    <div style="height: 10px;"></div>

                    <table cellspacing="0" cellpadding="5" style="width:100%; border-collapse:collapse; font-size:12pt;">
                        <tr>
                            <td colspan="4" style="border:1px solid #000; text-align:center; font-weight:bold;">
                                Isilah lembar data kalibrasi dengan lengkap dan jelas!
                            </td>
                        </tr>

                        <tr>
                            <td style="border:1px solid #000; width:20%;text-align:center;">Alat Standar</td>
                            <td style="border:1px solid #000; width:30%;">
                                <label style="display:block;">
                                    <input type="checkbox" class="alat-standar-checkbox" 
                                           {{ in_array('Timbangan digital (Rinstrum)', $alatStandarArray) ? 'checked' : '' }} 
                                           style="pointer-events: none;" readonly disabled>
                                    Timbangan digital (Rinstrum)
                                </label>

                                <label style="display:block;">
                                    <input type="checkbox" class="alat-standar-checkbox" 
                                           {{ in_array('Timbangan digital 3100 g (AND)', $alatStandarArray) ? 'checked' : '' }} 
                                           style="pointer-events: none;" readonly disabled>
                                    Timbangan digital 3100 g (AND)
                                </label>

                                <label style="display:block;">
                                    <input type="checkbox" class="alat-standar-checkbox" 
                                           {{ in_array('Timbangan digital 250 g (AND)', $alatStandarArray) ? 'checked' : '' }} 
                                           style="pointer-events: none;" readonly disabled>
                                    Timbangan digital 250 g (AND)
                                </label>

                                <label style="display:block;">
                                    <input type="checkbox" class="alat-standar-checkbox" 
                                           {{ in_array('Timbangan digital (BEL)', $alatStandarArray) ? 'checked' : '' }} 
                                           style="pointer-events: none;" readonly disabled>
                                    Timbangan digital (BEL)
                                </label>

                                <label style="display:block;">
                                    <input type="checkbox" class="alat-standar-checkbox" 
                                           {{ in_array('Timbangan digital (Radwag)', $alatStandarArray) ? 'checked' : '' }} 
                                           style="pointer-events: none;" readonly disabled>
                                    Timbangan digital (Radwag)
                                </label>
                                
                                @if(!empty($standardValue))
                                    <div style="margin-top: 5px; font-size: 11px; color: #666;">
                                        <em>Data tersimpan: {{ $standardValue }}</em>
                                    </div>
                                @endif
                            </td>

                            <td style="border:1px solid #000; width:25%; text-align:center;">Dikalibrasi oleh</td>
                            <td style="border:1px solid #000; width:25%; text-align:center;">Diperiksa oleh</td>
                        </tr>

                        <tr>
                            <td style="border:1px solid #000;text-align:center;">Metode Kalibrasi</td>
                            <td style="border:1px solid #000;">PAS-IK1102-16</td>

                            <!-- Dikalibrasi oleh -->
                            <td style="border:1px solid #000; vertical-align:top;">
                                TTD:<br><br><br>
                                Nama: <input type="text" value="{{ $calibratedByValue }}" 
                                       style="width:95%; font-size:12pt;" readonly disabled>
                            </td>

                            <!-- Diperiksa oleh -->
                            <td style="border:1px solid #000; vertical-align:top;">
                                TTD:<br><br><br>
                                Nama: <input type="text" value="{{ $verifiedByValue }}" 
                                       style="width:95%; font-size:12pt;" readonly disabled>
                            </td>
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