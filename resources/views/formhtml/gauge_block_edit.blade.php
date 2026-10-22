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
    .form-kalibrasi-container *:not(input):not(select):not(textarea):not(button):not(i):not(.btn) {
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
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25) !important;
    }

    .form-check-input[type="checkbox"]:disabled,
    .alat-standar-checkbox[type="checkbox"]:disabled {
        background-color: #f8f9fa !important;
        border-color: #6c757d !important;
        opacity: 1 !important;
    }

    .form-check-input[type="checkbox"]:checked,
    .alat-standar-checkbox[type="checkbox"]:checked {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='m6 10 3 3 6-6'/%3e%3c/svg%3e") !important;
    }

    .form-check-input[type="checkbox"]:checked:disabled,
    .alat-standar-checkbox[type="checkbox"]:checked:disabled {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='m6 10 3 3 6-6'/%3e%3c/svg%3e") !important;
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
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='2' fill='%23fff'/%3e%3c/svg%3e") !important;
    }

    .form-check-input[type="radio"]:disabled {
        background-color: #f8f9fa !important;
        border-color: #6c757d !important;
        opacity: 1 !important;
    }

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

    .alat-standar-checkbox {
        width: 18px;
        height: 18px;
        margin: 0;
        cursor: not-allowed;
    }

    .form-check-input[type="checkbox"],
    .alat-standar-checkbox[type="checkbox"] {
        border-radius: 0.25em;
    }

    .form-check-input[type="radio"],
    input[type="radio"] {
        border-radius: 50%;
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

    @media print {
        .btn { display: none !important; }
        body { background: white !important; }
        .container { max-width: 100% !important; margin: 0 !important; padding: 0 !important; }
    }

    @media (max-width: 768px) {
        .kalibrasi-main-table td { padding: 4px; }
        .data-kalibrasi-header { font-size: 16px; }
        .btn-lg { padding: 10px 20px !important; font-size: 14px !important; }
    }
    </style>

    <div class="form-kalibrasi-container">
        <!-- HEADER -->
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

                <!-- MAIN FORM -->
                <table class="kalibrasi-main-table">
                    <tr>
                        <td style="width: 20%;">
                            <p style="margin: 0; color: #000000;">Nama Alat</p>
                        </td>
                        <td colspan="3">
                            <input type="text" name="namaAlat" class="kalibrasi-input" 
                                   value="{{ old('namaAlat', $calibration->namaAlat) }}">
                        </td>
                    </tr>

                    <tr>
                        <td><p style="margin:0;color:#000;">Merek</p></td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" name="brandAlat" class="kalibrasi-input me-3"
                                       value="{{ old('brandAlat', $calibration->brandAlat) }}" style="width:60%;">
                                <span class="me-3">Kode Alat :</span>
                                <input type="text" name="kodeAlat" class="kalibrasi-input"
                                       value="{{ old('kodeAlat', $calibration->kodeAlat) }}" style="width:30%;">
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;" class="required-field">Type / No. Seri</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" class="kalibrasi-input me-3" name="typeAlat" value="{{ old('typeAlat', $calibration->typeAlat) }}" style="width: 45%;">
                                <span class="me-3" style="color: #000000;">/</span>
                                <input type="text" class="kalibrasi-input" name="NoSeri" value="{{ old('NoSeri', $calibration->NoSeri) }}" style="width: 45%;">
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td><p style="margin:0;color:#000;">Kapasitas / Resolusi</p></td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" name="kapasitas" class="kalibrasi-input me-3"
                                       value="{{ old('kapasitas', $calibration->kapasitas) }}" style="width:45%;">
                                <span class="me-3">/</span>
                                <input type="text" name="resolusi" class="kalibrasi-input"
                                       value="{{ old('resolusi', $calibration->resolusi) }}" style="width:45%;">
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td><p style="margin:0;color:#000;">Nama Pemilik</p></td>
                        <td colspan="3">
                            <input type="text" name="pemilikAlat" class="kalibrasi-input"
                                   value="{{ old('pemilikAlat', $calibration->pemilikAlat) }}">
                        </td>
                    </tr>

                    <tr>
                        <td><p style="margin:0;color:#000;">Tanggal Alat Masuk</p></td>
                        <td colspan="3">
                            <input type="date" name="tanggalMasuk" class="kalibrasi-input"
                                   value="{{ old('tanggalMasuk', \Carbon\Carbon::parse($calibration->tanggalMasuk)->format('Y-m-d')) }}">
                        </td>
                    </tr>

                    <tr>
                        <td><p style="margin:0;color:#000;">Tanggal Kalibrasi</p></td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="date" name="tanggalKalibrasi" class="kalibrasi-input me-3"
                                       value="{{ old('tanggalKalibrasi', $calibration->tanggalKalibrasi) }}" style="width:45%;">
                                <span class="me-3">Jenis Pembacaan:</span>
                                <input type="text" name="jenisPembacaan" class="kalibrasi-input"
                                       value="{{ old('jenisPembacaan', $calibration->jenisPembacaan) }}" style="width:45%;">
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td><p style="margin: 0; color: #000000;">Tempat Kalibrasi</p></td>
                        <td colspan="3">
                            <div class="d-flex">
                                <div class="form-check me-5">
                                    <input class="form-check-input" type="radio" name="tempatKalibrasi" value="lab.PT PAS"
                                           {{ old('tempatKalibrasi', $calibration->tempatKalibrasi) == 'lab.PT PAS' ? 'checked' : '' }}>
                                    <label class="form-check-label">Lab. PT.PAS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tempatKalibrasi" value="insitu"
                                           {{ old('tempatKalibrasi', $calibration->tempatKalibrasi) == 'insitu' ? 'checked' : '' }}>
                                    <label class="form-check-label">Insitu</label>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td><p style="margin:0;color:#000;">Lokasi PT</p></td>
                        <td colspan="3">
                            <input type="text" name="lokasiPT" class="kalibrasi-input"
                                   value="{{ old('lokasiPT', $calibration->lokasiPT) }}">
                        </td>
                    </tr>
                </table>

                <!-- FUNGSI KOMPONEN & KONDISI -->
                <div class="row mt-4">
                    <div class="col-md-6 mb-4">
                        <div class="kalibrasi-section-header" style="color:#000000;">
                            Fungsi Komponen Lainnya
                        </div>

                        <div class="d-flex justify-content-center align-items-center mb-4" style="gap:60px;">
                            <div class="text-center">
                                <span class="fw-bold d-block mb-2" style="color:#000000;font-size:14px;">Ok</span>
                                <input type="radio" name="kondisiAlat" value="ok" class="form-check-input"
                                    style="width:18px;height:18px;display:block;margin:0 auto;"
                                    {{ $calibration->kondisiAlat == 'ok' ? 'checked' : '' }}>
                            </div>
                            <div class="text-center">
                                <span class="fw-bold d-block mb-2" style="color:#000000;font-size:14px;">Rusak</span>
                                <input type="radio" name="kondisiAlat" value="rusak" class="form-check-input"
                                    style="width:18px;height:18px;display:block;margin:0 auto;"
                                    {{ $calibration->kondisiAlat == 'rusak' ? 'checked' : '' }}>
                            </div>
                        </div>

                        <div class="d-flex align-items-center">
                            <span class="fw-bold me-3" style="color:#000000;min-width:100px;">Keterangan :</span>
                            <div style="flex:1;">
                                <input type="text" name="keterangan" class="kalibrasi-input"
                                       value="{{ $calibration->keterangan }}"
                                       style="border:none;border-bottom:2px solid #000;border-radius:0;
                                              padding:4px 0;background:transparent;width:100%;">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="kalibrasi-section-header" style="color:#000000;">
                            Kondisi Kalibrasi
                        </div>

                        <table class="table table-bordered">
                            <tr>
                                <td class="table-secondary fw-bold" style="width:30%;color:#000000;"></td>
                                <td class="table-secondary fw-bold text-center">Awal</td>
                                <td class="table-secondary fw-bold text-center">Tengah</td>
                                <td class="table-secondary fw-bold text-center">Akhir</td>
                            </tr>
                            <tr>
                                <td class="bg-light fw-bold">Suhu (°C)</td>
                                <td><input type="text" name="RT_condition1" class="kondisi-input" value="{{ $calibration->RT_condition1 }}"></td>
                                <td><input type="text" name="RT_condition2" class="kondisi-input" value="{{ $calibration->RT_condition2 }}"></td>
                                <td><input type="text" name="RT_condition3" class="kondisi-input" value="{{ $calibration->RT_condition3 }}"></td>
                            </tr>
                            <tr>
                                <td class="bg-light fw-bold">RH (%)</td>
                                <td><input type="text" name="RH_condition1" class="kondisi-input" value="{{ $calibration->RH_condition1 }}"></td>
                                <td><input type="text" name="RH_condition2" class="kondisi-input" value="{{ $calibration->RH_condition2 }}"></td>
                                <td><input type="text" name="RH_condition3" class="kondisi-input" value="{{ $calibration->RH_condition3 }}"></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- UJI KERATAAN -->
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
                        use App\Models\AddGaugeBlock;
                        $addGaugeBlocks = AddGaugeBlock::where('calibration_id', $calibration->id)
                            ->orderBy('id')
                            ->limit(3)
                            ->get();
                        $block1 = $addGaugeBlocks->get(0);
                        $block2 = $addGaugeBlocks->get(1);
                        $block3 = $addGaugeBlocks->get(2);
                    @endphp

                    @foreach([1 => $block1, 2 => $block2, 3 => $block3] as $i => $block)
                    <tr>
                        <td style="border: 1px solid black; padding: 0;">
                            <div style="display: flex; align-items: center; justify-content: center;">
                                <input type="text" name="titikUkurKerataan{{ $i }}" value="{{ $block->titikUkurKerataan ?? '' }}"
                                       style="width: 80px; border: none; outline: none; padding: 8px; text-align: center;">
                                <span style="padding-right: 8px;">mm</span>
                            </div>
                        </td>
                        <td style="border: 1px solid black; padding: 8px; text-align: center;">
                            <label style="cursor:pointer; display: flex; align-items: center; justify-content: center;">
                                <input type="radio" name="Lsurface{{ $i }}" value="beraturan" 
                                    {{ ($block->Lsurface ?? '') == 'beraturan' ? 'checked' : '' }}
                                    style="margin-right: 5px;">
                                <span style="font-size:0.85rem;">Beraturan</span>
                            </label>
                        </td>
                        <td style="border: 1px solid black; padding: 8px; text-align: center;">
                            <label style="cursor:pointer; display: flex; align-items: center; justify-content: center;">
                                <input type="radio" name="Lsurface{{ $i }}" value="tidak_beraturan" 
                                    {{ ($block->Lsurface ?? '') == 'tidak_beraturan' ? 'checked' : '' }}
                                    style="margin-right: 5px;">
                                <span style="font-size:0.85rem;">Tdk Beraturan</span>
                            </label>
                        </td>
                        <td style="border: 1px solid black; padding: 8px; text-align: center;">
                            <label style="cursor:pointer; display: flex; align-items: center; justify-content: center;">
                                <input type="radio" name="Rsurface{{ $i }}" value="beraturan" 
                                    {{ ($block->Rsurface ?? '') == 'beraturan' ? 'checked' : '' }}
                                    style="margin-right: 5px;">
                                <span style="font-size:0.85rem;">Beraturan</span>
                            </label>
                        </td>
                        <td style="border: 1px solid black; padding: 8px; text-align: center;">
                            <label style="cursor:pointer; display: flex; align-items: center; justify-content: center;">
                                <input type="radio" name="Rsurface{{ $i }}" value="tidak_beraturan" 
                                    {{ ($block->Rsurface ?? '') == 'tidak_beraturan' ? 'checked' : '' }}
                                    style="margin-right: 5px;">
                                <span style="font-size:0.85rem;">Tdk Beraturan</span>
                            </label>
                        </td>
                    </tr>
                    @endforeach
                </table>

                <!-- DATA KALIBRASI -->
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
                                    <input type="text" name="satuan_unit"
                                           value="{{ $calibration->headGaugeBlock->satuan_unit ?? '-' }}"
                                           style="border:none; outline:none; width:40px; text-align:center;">
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
                                $details = $calibration->detailGaugeBlocks ?? collect();
                                if (!$details instanceof \Illuminate\Support\Collection) {
                                    $details = collect($details);
                                }
                                $detailsArray = $details->values()->all();
                            @endphp
                            
                            @for($no = 1; $no <= 15; $no++)
                                @php
                                    $data = isset($detailsArray[$no-1]) ? $detailsArray[$no-1] : null;
                                @endphp
                                <tr>
                                    <td style="border: 1px solid black; padding: 8px; text-align: center;">{{ $no }}</td>
                                    <td style="border: 1px solid black; padding: 0;">
                                        <input type="text" name="titikUkur_{{ $no }}" value="{{ $data->titikUkur ?? '' }}"
                                               style="width:100%; border: none; outline: none; padding: 8px; text-align:center;">
                                    </td>
                                    <td style="border: 1px solid black; padding: 0;">
                                        <input type="text" name="NoSeri_{{ $no }}" value="{{ $data->NoSeri ?? '' }}"
                                               style="width:100%; border: none; outline: none; padding: 8px; text-align:center;">
                                    </td>
                                    <td style="border: 1px solid black; padding: 0;">
                                        <input type="text" name="STD_{{ $no }}" value="{{ $data->STD ?? '' }}"
                                               style="width:100%; border: none; outline: none; padding: 8px; text-align:center;">
                                    </td>
                                    <td style="border: 1px solid black; padding: 12px 8px; line-height: 2.2; text-align: center;">
                                        Siklus 1<br>Siklus 2
                                    </td>
                                    @foreach(['M', 'UL', 'LL', 'UR', 'LR', 'C'] as $col)
                                    <td style="border: 1px solid black; padding: 0;">
                                        <div style="border-bottom: 1px solid black;">
                                            <input type="text" name="C1{{ $col }}_{{ $no }}" value="{{ $data->{'C1'.$col} ?? '' }}"
                                                   style="width:100%; border: none; outline: none; padding: 8px; text-align:center;">
                                        </div>
                                        <div>
                                            <input type="text" name="C2{{ $col }}_{{ $no }}" value="{{ $data->{'C2'.$col} ?? '' }}"
                                                   style="width:100%; border: none; outline: none; padding: 8px; text-align:center;">
                                        </div>
                                    </td>
                                    @endforeach
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>

                <!-- ===================================================== -->
                <!-- ✅ BAGIAN ATTACHMENT - SUDAH DI DALAM FORM -->
                <!-- ===================================================== -->
                <div class="container mt-3">
                    <div class="card">
                        <div class="card-header bg-warning text-white">
                            <i class="fas fa-paperclip me-2"></i> Edit Lampiran Attachment
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="attachments" class="form-label fw-bold">Tambah/Upload Attachment Baru</label>
                                <input type="file" 
                                       name="attachments[]" 
                                       id="attachments" 
                                       class="form-control"
                                       multiple
                                       accept=".pdf,.jpg,.jpeg,.png">
                                <div class="form-text text-muted mt-2">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Maksimal ukuran: <strong>25MB</strong>. 
                                    Format yang didukung: PDF, JPG, JPEG, PNG.
                                </div>
                            </div>
                            
                            <div id="existingFilesWrapper" style="margin-top: 20px;"></div>
                            <div id="newFilesWrapper" style="margin-top: 20px;"></div>
                        </div>
                    </div>
                </div>

                <!-- FOOTER: Alat Standar & Tanda Tangan -->
                <div class="mt-5">
                    <table style="font-size: 0.95rem; border-collapse: collapse; width: 100%;">
                        <tr>
                            <td colspan="4" style="border: 1px solid black; padding: 12px; text-align: center;">
                                <span class="fw-bold text-danger" style="font-size: 1.1rem;">Isilah lembar data kalibrasi dengan lengkap dan jelas!</span>
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding: 10px; width: 15%; text-align: center; vertical-align: middle; font-weight: bold;">
                                Alat<br>Standar
                            </td>
                            <td style="border: 1px solid black; padding: 10px; width: 35%; vertical-align: middle;">
                                <span class="fw-bold">{{ $calibration->alat_standar ?? 'Mesin ULM 01-600D' }}</span>
                            </td>
                            <td style="border: 1px solid black; padding: 10px; width: 25%; text-align: center; vertical-align: middle;">
                                Dikalibrasi<br>oleh
                            </td>
                            <td style="border: 1px solid black; padding: 10px; width: 25%; text-align: center; vertical-align: middle;">
                                Diperiksa<br>oleh
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding: 10px; text-align: center; vertical-align: middle; font-weight: bold;">
                                Metode<br>Kalibrasi
                            </td>
                            <td style="border: 1px solid black; padding: 10px; vertical-align: middle;">
                                {{ $calibration->metode_kalibrasi ?? 'PAS-IK1102-65' }}
                            </td>
                            <td style="border: 1px solid black; padding: 10px; vertical-align: middle;">
                                <label class="form-label fw-bold small d-block mb-2">Nama :</label>
                                <input type="text" name="calibratedBy"
                                       value="{{ $calibration->calibratedBy ?? '' }}"
                                       class="form-control form-control-sm text-center bg-light"
                                       style="min-height: 38px;">
                            </td>
                            <td style="border: 1px solid black; padding: 10px; vertical-align: middle;">
                                <label class="form-label fw-bold small d-block mb-2">Nama :</label>
                                <input type="text" name="verifiedBy"
                                       value="{{ $calibration->verifiedBy ?? '' }}"
                                       class="form-control form-control-sm text-center bg-light"
                                       style="min-height: 38px;" readonly>
                            </td>
                        </tr>
                    </table>
                </div>

            </div> <!-- END form-kalibrasi-container -->
    
    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
// ==================== ATTACHMENT HANDLER - V2 (FIXED) ====================
console.log('=== SCRIPT READY ===');

// ==================== LOAD DATA EXISTING ====================
let existingAttachments = [];
let existingNames = [];
let filesToDelete = [];

try {
    // Ambil data dari Blade
    const rawAttachments = @json($calibration->headGaugeBlock->attachment ?? null);
    const rawNames = @json($calibration->headGaugeBlock->attachment_name ?? null);
    
    console.log('🔍 Raw attachments from DB:', rawAttachments);
    console.log('🔍 Raw names from DB:', rawNames);
    
    // Parse attachments
    if (rawAttachments) {
        if (typeof rawAttachments === 'string') {
            try { existingAttachments = JSON.parse(rawAttachments); }
            catch(e) { existingAttachments = [rawAttachments]; }
        } else if (Array.isArray(rawAttachments)) {
            existingAttachments = rawAttachments;
        }
    }
    
    // Parse names
    if (rawNames) {
        if (typeof rawNames === 'string') {
            try { existingNames = JSON.parse(rawNames); }
            catch(e) { existingNames = [rawNames]; }
        } else if (Array.isArray(rawNames)) {
            existingNames = rawNames;
        }
    }
    
    // Pastikan array
    if (!Array.isArray(existingAttachments)) existingAttachments = [];
    if (!Array.isArray(existingNames)) existingNames = [];
    
    // Fallback: kalau nama kosong, ambil dari path
    if (existingNames.length === 0 && existingAttachments.length > 0) {
        existingNames = existingAttachments.map(p => p.split('/').pop());
    }
    
    console.log('✅ Loaded existing files:', existingAttachments.length);
    console.log('   Names:', existingNames);
    
} catch(e) {
    console.error('❌ Error loading existing files:', e);
    existingAttachments = [];
    existingNames = [];
}

// ==================== TAMPILKAN FILE EXISTING ====================
function tampilkanFileExisting() {
    const wrapper = document.getElementById('existingFilesWrapper');
    if (!wrapper) {
        console.warn('⚠️ Wrapper existingFilesWrapper tidak ditemukan');
        return;
    }
    
    if (!existingAttachments.length) {
        wrapper.innerHTML = `<div style="background:#f8f9fa;border:1px solid #dee2e6;border-radius:8px;padding:20px;text-align:center;">
            <i class="fas fa-folder-open fa-2x text-muted mb-2"></i>
            <p class="text-muted mb-0">Belum ada file</p>
        </div>`;
        return;
    }
    
    let html = `<div style="background:#e7f3ff;border:2px solid #007bff;border-radius:10px;padding:15px;">
        <div style="margin-bottom:15px;border-bottom:2px solid #007bff;">
            <strong>📋 FILE YANG SUDAH ADA (${existingAttachments.length})</strong>
        </div>`;
    
    for (let i = 0; i < existingAttachments.length; i++) {
        const fileName = existingNames[i] || existingAttachments[i].split('/').pop();
        const fileUrl = '/' + existingAttachments[i];
        const fileExt = fileName.split('.').pop().toLowerCase();
        
        // Icon berdasarkan tipe file
        let icon = '📄';
        if (fileExt === 'pdf') icon = '📑';
        else if (['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(fileExt)) icon = '🖼️';
        
       html += `<div style="background:white;border:1px solid #dee2e6;border-radius:8px;margin-bottom:10px;padding:12px;">
    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;">
        <div style="flex:1; word-break:break-all;">
            <span style="font-size:18px;">${icon}</span>
            <strong style="margin-left:6px;">${fileName}</strong>
        </div>
        <div style="display:flex; gap:8px; flex-shrink:0;">
            <a href="${fileUrl}" target="_blank" 
               style="display:inline-block !important; visibility:visible !important; opacity:1 !important;
                      background:#0d6efd !important; color:#ffffff !important; 
                      padding:6px 12px !important; border-radius:4px !important; 
                      text-decoration:none !important; font-size:14px !important; 
                      border:none !important; cursor:pointer !important;">
                <i class="fas fa-eye"></i> Lihat
            </a>
            <button type="button" 
                    onclick="tandaiHapus('${fileName.replace(/'/g, "\\'")}', ${i})" 
                    style="display:inline-block !important; visibility:visible !important; opacity:1 !important;
                           background:#dc3545 !important; color:#ffffff !important; 
                           padding:6px 12px !important; border-radius:4px !important; 
                           border:none !important; cursor:pointer !important; 
                           font-size:14px !important;">
                <i class="fas fa-trash-alt"></i> Hapus
            </button>
        </div>
    </div>
</div>`;
    }
    
    html += `</div>`;
    wrapper.innerHTML = html;
    
    console.log('✅ Rendered', existingAttachments.length, 'existing files');
}

// ==================== TAMPILKAN FILE BARU ====================
function tampilkanFileBaru() {
    const input = document.getElementById('attachments');
    const wrapper = document.getElementById('newFilesWrapper');
    if (!wrapper || !input) return;
    
    if (!input.files || input.files.length === 0) {
        wrapper.innerHTML = '';
        return;
    }
    
    let html = `<div style="background:#d4edda;border:2px solid #28a745;border-radius:10px;padding:15px;margin-top:20px;">
        <div style="margin-bottom:15px;border-bottom:2px solid #28a745;">
            <strong>📤 FILE BARU (${input.files.length})</strong>
        </div>`;
    
    for (let i = 0; i < input.files.length; i++) {
        const f = input.files[i];
        html += `<div style="background:white;border:1px solid #dee2e6;border-radius:8px;margin-bottom:10px;padding:12px;">
            <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;">
                <div style="flex:1; word-break:break-all;">
                    <strong>📄 ${f.name}</strong><br>
                    <small style="color:#28a745;">${(f.size/1024).toFixed(2)} KB</small>
                </div>
            </div>
        </div>`;
    }
    
    html += `</div>`;
    wrapper.innerHTML = html;
}

// ==================== TANDAI HAPUS (DENGAN KONFIRMASI) ====================
function tandaiHapus(fileName, index) {
    console.log('🗑️ === TANDAI HAPUS (AJAX) ===');
    console.log('File name:', fileName);
    console.log('Index:', index);
    
    Swal.fire({
        title: 'Hapus File?',
        html: `Apakah Anda yakin ingin menghapus file:<br>
               <strong style="color: #dc3545; word-break: break-all;">${fileName}</strong>?<br>
               <small style="color: #6c757d;">File akan dihapus permanen dan tidak dapat dikembalikan.</small>`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: '<i class="fas fa-trash-alt me-1"></i> Ya, Hapus!',
        cancelButtonText: '<i class="fas fa-times me-1"></i> Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Tampilkan loading
            Swal.fire({
                title: 'Menghapus...',
                html: 'Mohon tunggu, sedang menghapus file...',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Ambil calibration ID
            const calibrationId = '{{ $calibration->id }}';
            
            // Kirim AJAX DELETE
            fetch(`/calibrations/${calibrationId}/attachment/${index}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log('📥 Response:', data);
                
                if (data.success) {
                    // ✅ Hapus dari array tampilan
                    existingAttachments.splice(index, 1);
                    existingNames.splice(index, 1);
                    
                    // Update tampilan
                    tampilkanFileExisting();
                    
                    console.log('✅ File deleted from backend');
                    console.log('   Remaining:', data.remaining);
                    
                    // Notifikasi sukses
                    Swal.fire({
                        title: 'Berhasil Dihapus!',
                        html: `File <strong>${data.deleted.name}</strong> telah dihapus permanen.`,
                        icon: 'success',
                        confirmButtonColor: '#28a745',
                        confirmButtonText: 'OK',
                        timer: 2500,
                        timerProgressBar: true
                    });
                } else {
                    Swal.fire({
                        title: 'Gagal!',
                        text: data.message || 'Gagal menghapus file',
                        icon: 'error',
                        confirmButtonColor: '#dc3545'
                    });
                }
            })
            .catch(error => {
                console.error('❌ AJAX Error:', error);
                Swal.fire({
                    title: 'Error!',
                    text: 'Gagal menghubungi server: ' + error.message,
                    icon: 'error',
                    confirmButtonColor: '#dc3545'
                });
            });
        }
    });
}

// ==================== INIT ====================
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 DOM Ready - Init attachment handler');
    
    // Tampilkan file existing
    tampilkanFileExisting();
    
    // File input listener
    const input = document.getElementById('attachments');
    if (input) {
        input.addEventListener('change', function(e) {
            console.log('📎 Files selected:', e.target.files.length);
            for (let i = 0; i < e.target.files.length; i++) {
                console.log(`   - ${e.target.files[i].name} (${(e.target.files[i].size/1024).toFixed(2)} KB)`);
            }
            tampilkanFileBaru();
        });
        console.log('✅ Input listener terpasang');
    } else {
        console.warn('⚠️ Input #attachments tidak ditemukan');
    }
    
    // Cari form (support multiple form ID)
    const form = document.getElementById('editForm') 
                || document.getElementById('calibrationForm') 
                || document.querySelector('form[enctype*="multipart"]')
                || document.querySelector('form');
    
    console.log('🔍 Form ditemukan:', form ? (form.id || form.action) : 'TIDAK ADA');
    
    if (form) {
        // Pastikan enctype multipart
        if (form.enctype !== 'multipart/form-data') {
            form.enctype = 'multipart/form-data';
            console.log('🔧 Enctype di-set ke multipart/form-data');
        }
        
        // Hidden input untuk files_to_delete
        if (!document.getElementById('filesToDeleteInput')) {
            const inp = document.createElement('input');
            inp.type = 'hidden';
            inp.name = 'files_to_delete';
            inp.id = 'filesToDeleteInput';
            inp.value = '[]';
            form.appendChild(inp);
            console.log('✅ Hidden input files_to_delete ditambahkan ke form');
        }
        
        // Verifikasi posisi input file
        if (input) {
            const isInside = form.contains(input);
            console.log('🔍 Input file di dalam form?', isInside ? '✅ YA' : '❌ TIDAK');
        }
        
        // Submit listener
        form.addEventListener('submit', function(e) {
            console.log('=== 📤 FORM SUBMIT ===');
            
            // Update hidden input
            const hiddenInput = document.getElementById('filesToDeleteInput');
            if (hiddenInput) {
                hiddenInput.value = JSON.stringify(filesToDelete);
                console.log('📋 files_to_delete:', hiddenInput.value);
            }
            
            // Cek file baru
            if (input && input.files.length > 0) {
                console.log('📎 Files to upload:', input.files.length);
                for (let i = 0; i < input.files.length; i++) {
                    console.log(`   - ${input.files[i].name}`);
                }
            } else {
                console.log('📎 No new files');
            }
            
            console.log('🗑️ Files to delete:', filesToDelete);
        });
        console.log('✅ Submit listener terpasang');
    } else {
        console.error('❌ Form TIDAK DITEMUKAN!');
    }
    
    console.log('=== ✅ INIT COMPLETE ===');
});
</script>