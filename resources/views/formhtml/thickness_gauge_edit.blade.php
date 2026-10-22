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
    .form-kalibrasi-container *:not(input):not(select):not(textarea):not(button) {
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
                        <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK21</p>
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
                        <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">TICHKNESS GAUGE</p>
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
                        <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;">{{ $calibration->headThicknessGauge->certificate_id ?? 'N/A' }}</p>
                    </td>
                </tr>
            </table>

           <table class="kalibrasi-main-table">
    <!-- Nama Alat -->
    <tr>
        <td style="width: 20%;">
            <p style="margin: 0; color: #000000;">Nama Alat</p>
        </td>
        <td colspan="3">
            <input type="text" name="namaAlat" class="kalibrasi-input"
                   value="{{ old('namaAlat', $calibration->namaAlat) }}">
        </td>
    </tr>

    <!-- Merek & Kode Alat -->
    <tr>
        <td>
            <p style="margin: 0; color: #000000;">Merek</p>
        </td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="text" name="brandAlat" class="kalibrasi-input me-3"
                       value="{{ old('brandAlat', $calibration->brandAlat) }}" style="width:60%;">
                <span class="me-3" style="color:#000000;">Kode Alat :</span>
                <input type="text" name="kodeAlat" class="kalibrasi-input"
                       value="{{ old('kodeAlat', $calibration->kodeAlat) }}" style="width:30%;">
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
                <input type="text" name="typeAlat" class="kalibrasi-input me-3"
                       value="{{ old('typeAlat', $calibration->typeAlat) }}" style="width:45%;">
                <span class="me-3" style="color:#000000;">/</span>
                <input type="text" name="NoSeri" class="kalibrasi-input"
                       value="{{ old('NoSeri', $calibration->NoSeri) }}" style="width:45%;">
            </div>
        </td>
    </tr>

    <!-- Rentang Ukur -->
    <!--<tr>-->
    <!--    <td>-->
    <!--        <p style="margin: 0; color: #000000;">Rentang Ukur</p>-->
    <!--    </td>-->
    <!--    <td colspan="3">-->
    <!--        <div class="d-flex align-items-center">-->
    <!--            <div class="me-3" style="width:45%;">-->
    <!--                <input type="text" name="rangeMin" class="kalibrasi-input"-->
    <!--                       value="{{ old('rangeMin', $calibration->rangeMin ?? 0) }}">-->
    <!--            </div>-->
    <!--            <span class="me-3">-</span>-->
    <!--            <div style="width:45%;">-->
    <!--                <input type="text" name="rangeMax" class="kalibrasi-input"-->
    <!--                       value="{{ old('rangeMax', $calibration->rangeMax ?? 0) }}">-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </td>-->
    <!--</tr>-->

    <!-- Kapasitas / Resolusi -->
    <tr>
        <td><p style="margin:0;">Kapasitas / Resolusi</p></td>
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

    <!-- Nama Pemilik -->
    <tr>
        <td><p style="margin:0;">Nama Pemilik</p></td>
        <td colspan="3">
            <input type="text" name="pemilikAlat" class="kalibrasi-input"
                   value="{{ old('pemilikAlat', $calibration->pemilikAlat) }}">
        </td>
    </tr>

    <!-- Tanggal -->
      <tr>
        <td><p style="margin:0;color:#000;">Tanggal Alat Masuk</p></td>
        <td colspan="3">
            <input type="date" name="tanggalMasuk" class="kalibrasi-input"
                   value="{{ old('tanggalMasuk', \Carbon\Carbon::parse($calibration->tanggalMasuk)->format('Y-m-d')) }}">
        </td>
    </tr>

    <tr>
        <td><p style="margin:0;">Tanggal Kalibrasi</p></td>
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

    <!-- Tempat Kalibrasi -->
    <tr>
        <td><p style="margin:0;">Tempat Kalibrasi</p></td>
        <td colspan="3">
            <div class="d-flex">
                <div class="form-check me-5">
                    <input class="form-check-input" type="radio" name="tempatKalibrasi" value="lab.PT PAS"
                        {{ $calibration->tempatKalibrasi == 'lab.PT PAS' ? 'checked' : '' }}>
                    <label class="form-check-label">Lab. PT.PAS</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tempatKalibrasi" value="insitu"
                        {{ $calibration->tempatKalibrasi == 'insitu' ? 'checked' : '' }}>
                    <label class="form-check-label">Insitu</label>
                </div>
            </div>
        </td>
    </tr>

    <!-- Lokasi -->
    <tr>
        <td><p style="margin:0;">Lokasi PT</p></td>
        <td colspan="3">
            <input type="text" name="lokasiPT" class="kalibrasi-input"
                   value="{{ old('lokasiPT', $calibration->lokasiPT) }}">
        </td>
    </tr>
    
     <tr>
        <td><p style="margin:0;">Kode TH</p></td>
        <td colspan="3">
            <input type="text" name="kode_th" class="kalibrasi-input"
                   value="{{ old('kode_th', $calibration->kode_th) }}">
        </td>
    </tr>
</table>


           <div class="row mt-4">

<!-- Fungsi Komponen Lainnya -->
<div class="col-md-6 mb-4">
    <div class="kalibrasi-section-header" style="color: #000000;">Fungsi Komponen Lainnya</div>
    
    <div class="d-flex justify-content-center align-items-center mb-4" style="gap: 60px;">
        <div class="text-center">
            <span class="fw-bold d-block mb-2" style="color: #000000; font-size: 14px;">Ok</span>
            <input type="radio" name="kondisiAlat" value="ok" class="form-check-input"
                style="width:18px;height:18px;display:block;margin:0 auto;"
                {{ old('kondisiAlat', $calibration->kondisiAlat) == 'ok' ? 'checked' : '' }}>
        </div>
        <div class="text-center">
            <span class="fw-bold d-block mb-2" style="color: #000000; font-size: 14px;">Rusak</span>
            <input type="radio" name="kondisiAlat" value="rusak" class="form-check-input"
                style="width:18px;height:18px;display:block;margin:0 auto;"
                {{ old('kondisiAlat', $calibration->kondisiAlat) == 'rusak' ? 'checked' : '' }}>
        </div>
    </div>
    
    <div class="d-flex align-items-center">
        <span class="fw-bold me-3" style="color:#000; min-width:100px;">Keterangan :</span>
        <div style="flex:1;">
            <input type="text" name="keterangan" class="kalibrasi-input"
                value="{{ old('keterangan', $calibration->keterangan) }}"
                style="border:none;border-bottom:2px solid #000;border-radius:0;padding:4px 0;background:transparent;width:100%;">
        </div>
    </div>
</div>

<!-- Kondisi Kalibrasi -->
<div class="col-md-6 mb-4">
    <div class="kalibrasi-section-header" style="color: #000000;">Kondisi Kalibrasi</div>
    
    <table class="table table-bordered">
        <tr>
            <td class="table-secondary fw-bold" style="width:30%;"></td>
            <td class="table-secondary fw-bold text-center">Awal</td>
            <td class="table-secondary fw-bold text-center">Tengah</td>
            <td class="table-secondary fw-bold text-center">Akhir</td>
        </tr>
        <tr>
            <td class="bg-light fw-bold">Suhu (°C)</td>
            <td><input type="text" name="RT_condition1" class="kondisi-input"
                value="{{ old('RT_condition1', $calibration->RT_condition1) }}"></td>
            <td><input type="text" name="RT_condition2" class="kondisi-input"
                value="{{ old('RT_condition2', $calibration->RT_condition2) }}"></td>
            <td><input type="text" name="RT_condition3" class="kondisi-input"
                value="{{ old('RT_condition3', $calibration->RT_condition3) }}"></td>
        </tr>
        <tr>
            <td class="bg-light fw-bold">RH (%)</td>
            <td><input type="text" name="RH_condition1" class="kondisi-input"
                value="{{ old('RH_condition1', $calibration->RH_condition1) }}"></td>
            <td><input type="text" name="RH_condition2" class="kondisi-input"
                value="{{ old('RH_condition2', $calibration->RH_condition2) }}"></td>
            <td><input type="text" name="RH_condition3" class="kondisi-input"
                value="{{ old('RH_condition3', $calibration->RH_condition3) }}"></td>
        </tr>
    </table>
</div>

</div>


            <!-- Data Kalibrasi Section -->
<div class="data-kalibrasi-header" style="color: #000000;">DATA KALIBRASI</div>

<div class="mb-3">
    <span style="font-size: 16px; font-weight: bold; color: #000000;">Uji Skala Nominal</span>
</div>

<table class="kalibrasi-data-table">
    <tr style="background: #d9d9d9;">
        <td style="width: 20%;">
            <span style="font-weight: bold; color: #000000;">Nilai Nominal</span>
        </td>
        <td colspan="5">
            <span style="font-weight: bold; color: #000000;">Penunjukan Alat</span>
        </td>
    </tr>
    <tr style="background: #e8e8e8;">
        <td style="border: 2px solid #000000; text-align: center; vertical-align: middle; padding: 2px;">
            <div style="display: flex; justify-content: center; align-items: center; height: 100%;">
                <span style="font-weight: bold; color: #000000; font-size: 9.5pt; margin-right: 5px;">
                    Unit (
                </span>
                <input 
                    type="text" 
                    name="satuan_unit" 
                    value="{{ $calibration->headThicknessGauge->satuan_unit ?? 'mm' }}"
                    style="width: 60px; text-align: center; font-size: 9.5pt; padding: 2px; border: 1px solid #666;"
                    maxlength="10"
                />
                <span style="font-weight: bold; color: #000000; font-size: 9.5pt; margin-left: 5px;">
                    )
                </span>
            </div>
        </td>
        <td style="width: 16%;"><span style="font-weight: bold; color: #000000;">1</span></td>
        <td style="width: 16%;"><span style="font-weight: bold; color: #000000;">2</span></td>
        <td style="width: 16%;"><span style="font-weight: bold; color: #000000;">3</span></td>
        <td style="width: 16%;"><span style="font-weight: bold; color: #000000;">4</span></td>
        <td style="width: 16%;"><span style="font-weight: bold; color: #000000;">5</span></td>
    </tr>

    @php
        // Daftar tetap semua nilai nominal
        $nominalValues = ['0.0', '0.5', '1.0', '2.0', '3.0', '4.0', '5.0', '6.0', '7.0', '8.0', '9.0', '10.0', '15.0', '20.0', '30.0', '40.0', '50.0'];
        
        // Ambil data dari database
        $details = $calibration->detailThicknessGauges ?? collect();
        
        // Mapping untuk format field name di form
        $fieldMapping = [
            '0.0' => '0',
            '0.5' => '0_5',
            '1.0' => '1_0',
            '2.0' => '2_0',
            '3.0' => '3_0',
            '4.0' => '4_0',
            '5.0' => '5_0',
            '6.0' => '6_0',
            '7.0' => '7_0',
            '8.0' => '8_0',
            '9.0' => '9_0',
            '10.0' => '10_0',
            '15.0' => '15_0',
            '20.0' => '20_0',
            '30.0' => '30_0',
            '40.0' => '40_0',
            '50.0' => '50_0',
        ];
    @endphp

    @foreach($nominalValues as $nominal)
        @php
            // Cari data untuk nominal ini
            $detail = $details->firstWhere('titikUkur', $nominal);
            
            // Format field name untuk form (sesuai dengan store function)
            $fieldSuffix = $fieldMapping[$nominal] ?? str_replace('.', '_', $nominal);
        @endphp
        
        <tr style="height:21.3pt;">
            {{-- Nilai Nominal (readonly) --}}
            <td style="border:2px solid #000; padding:0;">
                <input type="text" 
                       name="titikukur_{{ $fieldSuffix }}" 
                       value="{{ $nominal }}" 
                       readonly 
                       style="width:100%;height:100%;border:none;background:transparent;text-align:center;font-size:10pt;color:#000;padding:2px;">
            </td>
            
            {{-- Ulangan 1-5 (editable) --}}
            @for($i = 1; $i <= 5; $i++)
                @php
                    // Format field name di database
                    $dbFieldName = 'ulangan0' . $i;
                    
                    // Nilai dari database atau kosong
                    $value = $detail ? ($detail->$dbFieldName ?? '') : '';
                    
                    // Name attribute untuk form (sesuai dengan store function)
                    $inputName = "ulangan_{$fieldSuffix}_{$i}";
                @endphp
                
                <td style="border:2px solid #000; padding:0;">
                    <input type="text" 
                           name="{{ $inputName }}"
                           value="{{ $value }}" 
                           oninput="this.value=this.value.replace(/[^0-9.,]/g,'').replace(/(\..*)\./g,'$1')"
                           style="width:100%;height:100%;border:none;background:transparent;text-align:center;font-size:10pt;color:#000;padding:2px;">
                </td>
            @endfor
        </tr>
    @endforeach
</table>


<table cellspacing="0" cellpadding="5" style="width:100%; border-collapse:collapse; font-size:12pt;">
    <tr>
        <td colspan="4" style="border:1px solid #000; text-align:center; font-weight:bold;">
            Data telah diisi dengan lengkap dan jelas!
        </td>
    </tr>

    <tr>
        <td style="border:1px solid #000; width:20%;text-align:center;">Alat Standar</td>
        <td style="border:1px solid #000; width:30%;">
            {{ $calibration->headThicknessGauge->standard ?? 'Gauge Block Set Grade 0' }}
        </td>
        <td style="border:1px solid #000; width:25%; text-align:center;">Dikalibrasi oleh</td>
        <td style="border:1px solid #000; width:25%; text-align:center;">Diperiksa oleh</td>
    </tr>

    <tr>
        <td style="border:1px solid #000;text-align:center;">Metode Kalibrasi</td>
        <td style="border:1px solid #000;">
            {{ $calibration->headThicknessGauge->calibrationMethod ?? 'PAS-IK1102-21' }}
        </td>

        <!-- Dikalibrasi oleh -->
        <td style="border:1px solid #000; vertical-align:top;">
            TTD:<br><br><br>
            Nama: <input type="text"
       name="calibratedBy"
       value="{{ old('calibratedBy', $calibration->calibratedBy ?? '') }}"
       style="
            border:none;
            background:transparent;
            outline:none;
            font-size:inherit;
            color:inherit;
       ">

        </td>

        <!-- Diperiksa oleh -->
        <td style="border:1px solid #000; vertical-align:top;">
            TTD:<br><br><br>
            Nama: <input type="text"
       name="verifiedBy"
       value="{{ old('verifiedBy', $calibration->verifiedBy ?? '') }}"
       style="
            border:none;
            background:transparent;
            outline:none;
            font-size:inherit;
            color:inherit;
       " readonly>

        </td>
    </tr>
</table>

            <!-- Action Buttons Section -->
         <div class="row mt-5">
                    <div class="col-12 text-center">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary btn-lg" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
                            <i class="fas fa-times me-2"></i>Batal
                        </a>
                        
                        <button type="submit" class="btn btn-success btn-lg ms-3" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
var tempFormDataStore = window.tempFormDataStore;
var isRestoring = window.isRestoring;
var tabSubmitStatus = window.tabSubmitStatus;
var currentActiveTabId = '1';

        // Form validation
        document.getElementById('editForm')?.addEventListener('submit', function(e) {
            let isValid = true;
            let errorMessage = '';
            
            // Check required fields
            const requiredFields = document.querySelectorAll('[required]');
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.style.borderColor = '#dc3545';
                } else {
                    field.style.borderColor = '';
                }
            });
            
            // Check radio buttons for kondisi alat
            const kondisiAlat = document.querySelector('input[name="kondisiAlat"]:checked');
            if (!kondisiAlat) {
                isValid = false;
                errorMessage += 'Pilih kondisi alat (Ok/Rusak)\n';
            }
            
            // Check tempat kalibrasi
            const tempatKalibrasi = document.querySelector('input[name="tempatKalibrasi"]:checked');
            if (!tempatKalibrasi) {
                isValid = false;
                errorMessage += 'Pilih tempat kalibrasi\n';
            }
            
            // Validate date order
            const tanggalMasuk = document.querySelector('input[name="tanggalMasuk"]').value;
            const tanggalKalibrasi = document.querySelector('input[name="tanggalKalibrasi"]').value;
            
            if (tanggalMasuk && tanggalKalibrasi) {
                if (new Date(tanggalMasuk) > new Date(tanggalKalibrasi)) {
                    isValid = false;
                    errorMessage += 'Tanggal alat masuk tidak boleh lebih baru dari tanggal kalibrasi\n';
                }
            }
            
            if (!isValid) {
                e.preventDefault();
                alert('Mohon lengkapi semua data yang diperlukan:\n' + errorMessage);
            }
        });
        
        // Add input validation for numeric fields
        document.querySelectorAll('input[type="number"]').forEach(input => {
            input.addEventListener('input', function() {
                if (this.value < 0 && this.getAttribute('min') === null) {
                    this.value = Math.abs(this.value);
                }
            });
        });
        
        // Auto format date display
        document.querySelectorAll('input[type="date"]').forEach(input => {
            input.addEventListener('change', function() {
                if (this.value) {
                    // Format untuk display (opsional)
                    const date = new Date(this.value);
                    const formattedDate = date.toLocaleDateString('id-ID', {
                        day: '2-digit',
                        month: '2-digit',
                        year: 'numeric'
                    });
                    // Anda bisa menambahkan display format di sini jika diperlukan
                }
            });
        });
    </script>

   <script>
    document.getElementById('editForm')?.addEventListener('submit', function(e) {
        console.log('🎯 Edit form submission started...');
        
        // Debug form data
        const formData = new FormData(this);
        console.log('📦 Form data collected for update');
        
        // Log titikUkur array
        const titikUkurInputs = document.querySelectorAll('input[name="titikUkur[]"]');
        console.log('🔢 titikUkur inputs count:', titikUkurInputs.length);
        titikUkurInputs.forEach((input, index) => {
            console.log(`📝 titikUkur[${index}]:`, input.value);
        });
        
        // Log alat standar checkboxes
        const alatStandarCheckboxes = document.querySelectorAll('.alat-standar-checkbox:checked');
        console.log('✅ Checked alat standar:', alatStandarCheckboxes.length);
        alatStandarCheckboxes.forEach((checkbox, index) => {
            console.log(`🔧 Alat standar ${index + 1}:`, checkbox.value);
        });
        
        // Log kondisi alat radio
        const kondisiAlatSelected = document.querySelector('input[name="kondisiAlat"]:checked');
        console.log('🎚️ Kondisi alat selected:', kondisiAlatSelected ? kondisiAlatSelected.value : 'none');
        
        // Log tempat kalibrasi radio
        const tempatKalibrasiSelected = document.querySelector('input[name="tempatKalibrasi"]:checked');
        console.log('📍 Tempat kalibrasi selected:', tempatKalibrasiSelected ? tempatKalibrasiSelected.value : 'none');
        
        // HANYA BASIC VALIDATION untuk edit form (tidak ada required)
        let isValid = true;
        let warningMessages = [];
        
        // 1. Validasi tanggal (jika diisi)
        const tanggalMasuk = document.querySelector('input[name="tanggalMasuk"]').value;
        const tanggalKalibrasi = document.querySelector('input[name="tanggalKalibrasi"]').value;
        
        if (tanggalMasuk && tanggalKalibrasi) {
            if (new Date(tanggalMasuk) > new Date(tanggalKalibrasi)) {
                warningMessages.push('Tanggal alat masuk tidak boleh lebih baru dari tanggal kalibrasi');
                console.warn('⚠️ Date validation warning: masuk > kalibrasi');
            }
        }
        
        // 2. Validasi numeric fields (jika diisi)
        document.querySelectorAll('input[type="number"]').forEach(input => {
            if (input.value && isNaN(parseFloat(input.value))) {
                input.style.borderColor = '#ffc107';
                warningMessages.push(`${input.name} harus berupa angka`);
                console.warn(`⚠️ ${input.name} is not a valid number`);
            } else {
                input.style.borderColor = '';
            }
        });
        
       
        
        // 4. Validasi alat standar (minimal satu dipilih)
        if (alatStandarCheckboxes.length === 0) {
            const alatStandarSection = document.querySelector('.alat-standar-table');
            if (alatStandarSection) {
                alatStandarSection.style.border = '2px solid #ffc107';
                warningMessages.push('Pilih minimal satu alat standar');
                console.warn('⚠️ No alat standar selected');
            }
        } else {
            const alatStandarSection = document.querySelector('.alat-standar-table');
            if (alatStandarSection) alatStandarSection.style.border = '';
        }
        
        // 5. Validasi kondisi alat (harus dipilih)
        if (!kondisiAlatSelected) {
            const kondisiSection = document.querySelector('.kalibrasi-section-header');
            if (kondisiSection) {
                kondisiSection.style.color = '#ffc107';
                warningMessages.push('Pilih kondisi alat (Ok/Rusak)');
                console.warn('⚠️ No kondisi alat selected');
            }
        } else {
            const kondisiSection = document.querySelector('.kalibrasi-section-header');
            if (kondisiSection) kondisiSection.style.color = '';
        }
        
        // 6. Validasi tempat kalibrasi (harus dipilih)
        if (!tempatKalibrasiSelected) {
            const tempatSection = document.querySelector('input[name="tempatKalibrasi"]').closest('tr');
            if (tempatSection) {
                tempatSection.style.backgroundColor = '#fff8e1';
                warningMessages.push('Pilih tempat kalibrasi');
                console.warn('⚠️ No tempat kalibrasi selected');
            }
        }
        
        // Tampilkan warning jika ada, tapi masih bisa submit
        if (warningMessages.length > 0) {
            const shouldProceed = confirm(
                '⚠️ Peringatan:\n' + 
                warningMessages.join('\n') + 
                '\n\nApakah Anda yakin ingin melanjutkan?'
            );
            
            if (!shouldProceed) {
                e.preventDefault();
                console.log('⛔ User cancelled submission due to warnings');
                return false;
            }
        }
        
        console.log('🚀 Form validation passed, submitting...');
        
        // Add loading indicator
        const submitBtn = this.querySelector('button[type="submit"]');
        if (submitBtn) {
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan Perubahan...';
            submitBtn.disabled = true;
            
            // Reset button setelah 10 detik jika ada error
            setTimeout(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 10000);
        }
        
        // Log data yang akan dikirim (optional debugging)
        console.log('📤 Data to be submitted:');
        for (let [key, value] of formData.entries()) {
            // Jangan log password atau sensitive data
            if (!key.includes('password') && !key.includes('token')) {
                console.log(`${key}:`, value);
            }
        }
        
        // Optional: Send analytics/log to server
        try {
            fetch('/api/log-form-edit', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    action: 'edit_form_submit',
                    calibration_id: {{ $calibration->id }},
                    form_type: 'inside_micrometer',
                    timestamp: new Date().toISOString(),
                    field_count: formData.entries().length
                })
            }).catch(err => console.log('Analytics log failed:', err));
        } catch (analyticsError) {
            console.log('Analytics error:', analyticsError);
        }
        
        return true;
    });
    
    // Additional debug on page load
    document.addEventListener('DOMContentLoaded', function() {
        console.log('📄 Edit form loaded for Inside Micrometer ID:', {{ $calibration->id }});
        console.log('🏷️ Certificate ID:', '{{ $calibration->headInsideMicrometer->certificate_id ?? "N/A" }}');
        console.log('🔢 Detail records count:', {{ $calibration->detailInsideMicrometers->count() }});
        
        // Log current alat standar
        const currentStandards = '{{ $calibration->headInsideMicrometer->standard ?? "" }}';
        console.log('📋 Current alat standar:', currentStandards);
        
        // Log current form values
        console.log('📝 Current form values:');
        document.querySelectorAll('.kalibrasi-input').forEach((input, index) => {
            if (index < 5) { // Hanya log 5 pertama
                console.log(`${input.name}:`, input.value);
            }
        });
        
        // Auto-hide validation messages after 5 seconds
        setTimeout(() => {
            document.querySelectorAll('.is-invalid').forEach(el => {
                el.classList.remove('is-invalid');
            });
            document.querySelectorAll('.invalid-feedback').forEach(el => {
                el.style.display = 'none';
            });
        }, 5000);
        
        // Real-time validation for numeric fields
        document.querySelectorAll('input[type="number"]').forEach(input => {
            input.addEventListener('blur', function() {
                if (this.value && isNaN(parseFloat(this.value))) {
                    this.classList.add('is-invalid');
                    this.title = 'Harus berupa angka';
                } else {
                    this.classList.remove('is-invalid');
                    this.title = '';
                }
            });
        });
        
        // Real-time validation for date fields
        document.querySelectorAll('input[type="date"]').forEach(input => {
            input.addEventListener('change', function() {
                const tanggalMasuk = document.querySelector('input[name="tanggalMasuk"]').value;
                const tanggalKalibrasi = document.querySelector('input[name="tanggalKalibrasi"]').value;
                
                if (tanggalMasuk && tanggalKalibrasi && new Date(tanggalMasuk) > new Date(tanggalKalibrasi)) {
                    this.classList.add('is-invalid');
                    this.title = 'Tanggal tidak valid';
                } else {
                    this.classList.remove('is-invalid');
                    this.title = '';
                }
            });
        });
        
        // Highlight required-ish fields (bukan required tapi penting)
        const importantFields = [
            'namaAlat', 'brandAlat', 'NoSeri', 'kapasitas', 'resolusi',
            'pemilikAlat', 'tanggalMasuk', 'tanggalKalibrasi'
        ];
        
        importantFields.forEach(fieldName => {
            const field = document.querySelector(`[name="${fieldName}"]`);
            if (field && !field.value.trim()) {
                field.style.backgroundColor = '#fff8e1';
                field.addEventListener('input', function() {
                    if (this.value.trim()) {
                        this.style.backgroundColor = '';
                    }
                });
            }
        });
    });
</script>
</body>
</html>