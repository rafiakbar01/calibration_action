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
                        <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK29</p>
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
                        <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">ENCLOSURE</p>
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
                        <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;">{{ $calibration->headEnclosure->certificate_id ?? 'N/A' }}</p>
                    </td>
                </tr>
            </table>

           
           <!-- Main Calibration Section-->
            <table class="kalibrasi-main-table">

    <!-- Nama Alat -->
<tr>
    <td style="width: 20%;">
        <p style="margin: 0; color: #000000;">Nama Alat</p>
    </td>
    <td colspan="3">
        <!-- Select dropdown untuk pilihan alat -->
        <select name="nama_alat_select" id="nama_alat_select" class="kalibrasi-input" onchange="updateFormType(this.value)" 
                style="background-color: #f5f5f5; color: #333; border: 1px solid #ced4da; padding: 6px 10px; border-radius: 4px; width: 100%;">
            <option value="">-- Pilih Jenis Alat Enclosure --</option>
            @php
                $alatOptions = ['Oven', 'Freezer', 'Furnace', 'Incubator', 'Waterbath', 'Autoclave'];
                $selectedAlat = old('nama_alat_select', $calibration->namaAlat ?? '');
            @endphp
            
            @foreach($alatOptions as $alat)
                <option value="{{ $alat }}" {{ $selectedAlat == $alat ? 'selected' : '' }}>
                    {{ $alat }}
                </option>
            @endforeach
            <option value="MANUAL_INPUT">-- Input Manual Nama Alat --</option>
            
            {{-- Jika ada nilai custom yang tidak ada di options --}}
            @if($selectedAlat && !in_array($selectedAlat, $alatOptions))
                <option value="{{ $selectedAlat }}" selected>{{ $selectedAlat }}</option>
            @endif
        </select>
        
        <!-- Input Manual - HIDDEN AWALNYA -->
        <div id="manualInputContainer" style="display: none; margin-top: 10px;">
            <input type="text" name="nama_alat_manual" id="nama_alat_manual"
                   placeholder="Ketik nama alat Enclosure secara manual"
                   value="{{ old('nama_alat_manual', (!in_array($selectedAlat, $alatOptions) && $selectedAlat ? $selectedAlat : '')) }}"
                   style="background-color: #f5f5f5; color: #333; border: 1px solid #ced4da; padding: 6px 10px; border-radius: 4px; width: 100%;"
                   oninput="syncNamaAlat()">
        </div>
        
        <!-- Hidden input untuk menyimpan nama alat final -->
        <input type="hidden" name="nama_alat_final" id="nama_alat_final" 
               value="{{ old('nama_alat_final', $calibration->namaAlat ?? '') }}">
        
        <!-- Hidden input untuk form_type -->
        <input type="hidden" name="form_type" id="form_type" 
               value="{{ old('form_type', $calibration->form_type ?? 'enclosure') }}">
    </td>
</tr>

    <!-- Merek & Kode -->
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

    <!-- Type / No Seri -->
    <tr>
        <td><p style="margin:0;color:#000;">Type / No. Seri</p></td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="text" name="typeAlat" class="kalibrasi-input me-3"
                       value="{{ old('typeAlat', $calibration->typeAlat) }}" style="width:45%;">
                <span class="me-3">/</span>
                <input type="text" name="NoSeri" class="kalibrasi-input"
                       value="{{ old('NoSeri', $calibration->NoSeri) }}" style="width:45%;">
            </div>
        </td>
    </tr>

    <!-- Kapasitas / Resolusi -->
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

    <!-- Pemilik -->
    <tr>
        <td><p style="margin:0;color:#000;">Nama Pemilik</p></td>
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

    <!-- Tempat -->
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

    <!-- Lokasi -->
    <tr>
        <td><p style="margin:0;color:#000;">Lokasi PT</p></td>
        <td colspan="3">
            <input type="text" name="lokasiPT" class="kalibrasi-input"
                   value="{{ old('lokasiPT', $calibration->lokasiPT) }}">
        </td>
    </tr>
    
      <tr>
        <td><p style="margin:0;color:#000;">Kode TH</p></td>
        <td colspan="3">
            <input type="text" name="kode_th" class="kalibrasi-input"
                   value="{{ old('kode_th', $calibration->kode_th) }}">
        </td>
    </tr>
</table>


           <!-- Fungsi Komponen Lainnya & Kondisi Kalibrasi -->
<div class="row mt-4">

    <!-- Fungsi Komponen Lainnya -->
    <div class="col-md-6 mb-4">
        <div class="kalibrasi-section-header" style="color:#000000;">
            Fungsi Komponen Lainnya
        </div>

        <!-- Radio -->
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

        <!-- Keterangan -->
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

    <!-- Kondisi Kalibrasi -->
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
                <td><input type="number" step="any" name="RT_condition1" class="kondisi-input"
                           value="{{ $calibration->RT_condition1 }}"></td>
                <td><input type="number" step="any" name="RT_condition2" class="kondisi-input"
                           value="{{ $calibration->RT_condition2 }}"></td>
                <td><input type="number" step="any" name="RT_condition3" class="kondisi-input"
                           value="{{ $calibration->RT_condition3 }}"></td>
            </tr>

            <tr>
                <td class="bg-light fw-bold">RH (%)</td>
                <td><input type="number" step="any" name="RH_condition1" class="kondisi-input"
                           value="{{ $calibration->RH_condition1 }}"></td>
                <td><input type="number" step="any" name="RH_condition2" class="kondisi-input"
                           value="{{ $calibration->RH_condition2 }}"></td>
                <td><input type="number" step="any" name="RH_condition3" class="kondisi-input"
                           value="{{ $calibration->RH_condition3 }}"></td>
            </tr>
        </table>
    </div>
</div>

            <!-- Data Kalibrasi Section -->
            <div class="data-kalibrasi-header" style="color: #000000;">DATA KALIBRASI</div>
               <ol type="1" style="margin:0pt; padding-left:0pt">
    <li class="ListParagraph" style="margin-top:0.5pt; margin-left:10.05pt; text-indent:0pt; font-size:11pt; font-weight:bold; letter-spacing:-0.1pt">
        <span>Penempatan</span>
        <span style="letter-spacing:-0.05pt"></span>
        <span>Sensor</span>
    </li>
</ol>

<p style="margin-left:0.05pt; font-size:10pt">
    <!-- Gambar Kiri -->
    <div style="display: inline-block; vertical-align: top; text-align: center; margin-right: 20px;">
        <img src="/logo/foto_rektangular.png" width="350" height="190" alt="" 
            style="border: 2px solid #000000; padding: 5px; -aw-left-pos:0pt; -aw-rel-hpos:column; -aw-rel-vpos:paragraph; -aw-top-pos:0pt; -aw-wrap-type:inline" />
        <div style="margin-top: 8px; font-family: Arial; font-size: 9pt; font-weight: bold; color: #000000; text-align: center;">
            Rektangular
        </div>
    </div>
    
    <!-- Canvas Edit Penempatan Sensor (Tengah) -->
    <div style="display: inline-block; vertical-align: top; text-align: center; margin: 0 10px; min-width: 200px; max-width: 260px;">
        <strong style="font-family: Arial; font-size: 9pt; color: #000000;">Penempatan Sensor:</strong>
        @php
            $existingImg = $calibration->headEnclosure->keterangan_gambar ?? null;
        @endphp
        <div class="enclosure-edit-canvas-wrapper" style="border: 2px solid #000; background: #fff; margin-top: 4px; position: relative;">
            <canvas id="enclosureEditCanvas" height="200" style="display:block; width:100%; cursor:crosshair; touch-action:none;"></canvas>
        </div>
        <div style="margin-top: 5px; text-align: center;">
            <button type="button" id="enclosureEditClearBtn" class="btn btn-danger btn-sm"
                style="padding: 3px 12px; font-size: 8pt; font-family: Arial;
                       background-color: #dc3545 !important; color: #ffffff !important; border: none;
                       border-radius: 3px; cursor: pointer; display: inline-block !important; visibility: visible !important;">
                🗑️ Hapus Gambar
            </button>
        </div>
        <div style="font-family: Arial; font-size: 8pt; color: #666; text-align: center; margin-top: 3px; font-style: italic;">
            Gambar penempatan sensor di sini
        </div>
        <!-- Input hidden gambar lama untuk referensi -->
        <input type="hidden" id="enclosureEditExistingImg" value="{{ $existingImg && file_exists(public_path($existingImg)) ? '/' . $existingImg : ($existingImg ?? '') }}">
        <!-- Input hidden untuk data canvas baru -->
        <input type="hidden" name="keterangan_gambar" id="enclosureEditCanvasHidden">
    </div>

    <script>
    // =============================================
    // ENCLOSURE EDIT FREE-DRAW CANVAS
    // =============================================
    (function() {
        function initEnclosureEditCanvas() {
            var canvas = document.getElementById('enclosureEditCanvas');
            if (!canvas) return;

            var wrapper = canvas.parentElement;
            canvas.width = wrapper.clientWidth || 240;
            canvas.height = 200;

            var ctx = canvas.getContext('2d');
            ctx.fillStyle = '#ffffff';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            ctx.strokeStyle = '#000000';
            ctx.lineWidth = 2;
            ctx.lineCap = 'round';
            ctx.lineJoin = 'round';

            // Load gambar yang sudah ada
            var existingImgEl = document.getElementById('enclosureEditExistingImg');
            var existingSrc = existingImgEl ? existingImgEl.value : '';
            if (existingSrc && existingSrc.trim() !== '') {
                var img = new Image();
                img.crossOrigin = 'anonymous';
                img.onload = function() {
                    ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                    saveCanvas();
                };
                img.src = existingSrc;
            }

            var drawing = false;

            function getPos(e) {
                var rect = canvas.getBoundingClientRect();
                var scaleX = canvas.width / rect.width;
                var scaleY = canvas.height / rect.height;
                if (e.touches) {
                    return {
                        x: (e.touches[0].clientX - rect.left) * scaleX,
                        y: (e.touches[0].clientY - rect.top) * scaleY
                    };
                }
                return {
                    x: (e.clientX - rect.left) * scaleX,
                    y: (e.clientY - rect.top) * scaleY
                };
            }

            function startDraw(e) {
                e.preventDefault();
                drawing = true;
                var pos = getPos(e);
                ctx.beginPath();
                ctx.moveTo(pos.x, pos.y);
            }

            function draw(e) {
                if (!drawing) return;
                e.preventDefault();
                var pos = getPos(e);
                ctx.lineTo(pos.x, pos.y);
                ctx.stroke();
            }

            function stopDraw(e) {
                if (!drawing) return;
                drawing = false;
                ctx.beginPath();
                saveCanvas();
            }

            function saveCanvas() {
                var hidden = document.getElementById('enclosureEditCanvasHidden');
                if (hidden) {
                    hidden.value = canvas.toDataURL('image/png');
                }
            }

            canvas.addEventListener('mousedown', startDraw);
            canvas.addEventListener('mousemove', draw);
            canvas.addEventListener('mouseup', stopDraw);
            canvas.addEventListener('mouseleave', stopDraw);
            canvas.addEventListener('touchstart', startDraw, {passive: false});
            canvas.addEventListener('touchmove', draw, {passive: false});
            canvas.addEventListener('touchend', stopDraw);

            // Tombol Hapus Gambar (Reset Canvas)
            var clearBtn = document.getElementById('enclosureEditClearBtn');
            if (clearBtn) {
                clearBtn.addEventListener('click', function() {
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    ctx.fillStyle = '#ffffff';
                    ctx.fillRect(0, 0, canvas.width, canvas.height);
                    saveCanvas();
                });
            }

            var form = canvas.closest('form');
            if (form) {
                form.addEventListener('submit', saveCanvas);
            }
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initEnclosureEditCanvas);
        } else {
            initEnclosureEditCanvas();
        }
    })();
    </script>
    
    <!-- Gambar Kanan -->
    <div style="display: inline-block; vertical-align: top; text-align: center; margin-left: 20px;">
        <img src="/logo/foto_silindrik.png" width="240" height="190" alt="" 
            style="border: 2px solid #000000; padding: 5px; -aw-left-pos:0pt; -aw-rel-hpos:column; -aw-rel-vpos:paragraph; -aw-top-pos:0pt; -aw-wrap-type:inline" />
        <div style="margin-top: 8px; font-family: Arial; font-size: 9pt; font-weight: bold; color: #000000; text-align: center;">
            Silindrik atau Sferik
        </div>
    </div>
</p>

<p class="BodyText" style="margin-top:2.45pt">
    <span style="-aw-import:ignore">&#xa0;</span>
</p>
@php
// === ENCLOSURE EDIT FORM - WITH EXISTING DATA ===
$interval_waktu = [1, 2, 3, 4, 5, 13, 20, 30];

// PROSES DATA EXISTING
$tsettingValues = [];
$repetition = 1;
$detailsByRepetition = [];

// CARI DATA ADDENCLOSURE (UNTUK TSETTING)
// Coba dari relasi terlebih dahulu
$addEnclosuresData = null;

// Cek semua kemungkinan nama relasi
if (method_exists($calibration, 'addEnclosures') && $calibration->addEnclosures->count() > 0) {
    $addEnclosuresData = $calibration->addEnclosures;
} elseif (method_exists($calibration, 'addEnclosure') && $calibration->addEnclosure->count() > 0) {
    $addEnclosuresData = $calibration->addEnclosure;
} else {
    // Jika tidak ada relasi, coba query langsung
    try {
        $addEnclosuresData = \DB::table('add_enclosures')
            ->where('calibration_id', $calibration->id)
            ->orderBy('repetition_number')
            ->get();
        
        // Coba tabel dengan nama singular jika tidak ditemukan
        if ($addEnclosuresData->count() == 0) {
            $addEnclosuresData = \DB::table('add_enclosure')
                ->where('calibration_id', $calibration->id)
                ->orderBy('repetition_number')
                ->get();
        }
    } catch (\Exception $e) {
        // Jika error, set empty collection
        $addEnclosuresData = collect();
    }
}

// Pastikan $addEnclosuresData adalah collection
if (!$addEnclosuresData instanceof \Illuminate\Support\Collection) {
    $addEnclosuresData = collect($addEnclosuresData);
}

// PROSES TSETTING DARI ADDENCLOSURE - DATA MURNI DARI DATABASE
if ($addEnclosuresData->isNotEmpty()) {
    foreach ($addEnclosuresData as $index => $add) {
        // Gunakan property access yang tepat
        $repNum = $add->repetition_number ?? ($add['repetition_number'] ?? 1);
        
        // Coba beberapa kemungkinan nama field untuk TSetting
        $tsettingValue = null;
        if (isset($add->TSetting)) {
            $tsettingValue = $add->TSetting;
        } elseif (isset($add->Tsetting)) {
            $tsettingValue = $add->Tsetting;
        } elseif (isset($add['TSetting'])) {
            $tsettingValue = $add['TSetting'];
        } elseif (isset($add['tsetting'])) {
            $tsettingValue = $add['tsetting'];
        } elseif (isset($add->t_setting)) {
            $tsettingValue = $add->t_setting;
        } elseif (isset($add['t_setting'])) {
            $tsettingValue = $add['t_setting'];
        }
        
        // Simpan data murni dari database
        if ($tsettingValue !== null && $tsettingValue !== '') {
            $tsettingValues[$repNum] = $tsettingValue;
        } else {
            $tsettingValues[$repNum] = null;
        }
    }
    
    // Update jumlah repetition berdasarkan data yang ditemukan
    if (!empty($tsettingValues)) {
        $repetition = max(array_keys($tsettingValues));
    }
}

// CARI DATA DETAILENCLOSURE (UNTUK PEMBACAAN)
// Coba dari relasi terlebih dahulu
$detailEnclosuresData = null;

if (method_exists($calibration, 'detailEnclosures') && $calibration->detailEnclosures->count() > 0) {
    $detailEnclosuresData = $calibration->detailEnclosures;
} elseif (method_exists($calibration, 'detailEnclosure') && $calibration->detailEnclosure->count() > 0) {
    $detailEnclosuresData = $calibration->detailEnclosure;
} else {
    // Jika tidak ada relasi, coba query langsung
    try {
        $detailEnclosuresData = \DB::table('detail_enclosures')
            ->where('calibration_id', $calibration->id)
            ->orderBy('repetition_number')
            ->orderBy('interval_number')
            ->get();
        
        // Coba tabel dengan nama singular jika tidak ditemukan
        if ($detailEnclosuresData->count() == 0) {
            $detailEnclosuresData = \DB::table('detail_enclosure')
                ->where('calibration_id', $calibration->id)
                ->orderBy('repetition_number')
                ->orderBy('interval_number')
                ->get();
        }
    } catch (\Exception $e) {
        // Jika error, set empty collection
        $detailEnclosuresData = collect();
    }
}

// Pastikan $detailEnclosuresData adalah collection
if (!$detailEnclosuresData instanceof \Illuminate\Support\Collection) {
    $detailEnclosuresData = collect($detailEnclosuresData);
}

// PROSES DETAILENCLOSURE
if ($detailEnclosuresData->isNotEmpty()) {
    foreach ($detailEnclosuresData as $detail) {
        $repNum = $detail->repetition_number ?? ($detail['repetition_number'] ?? 1);
        $intervalNum = $detail->interval_number ?? ($detail['interval_number'] ?? 1);
        
        if (!isset($detailsByRepetition[$repNum])) {
            $detailsByRepetition[$repNum] = [];
        }
        
        $detailsByRepetition[$repNum][$intervalNum] = $detail;
    }
    
    // Update repetition jika ada data detail dengan repetition lebih tinggi
    if (!empty($detailsByRepetition)) {
        $maxRepFromDetails = max(array_keys($detailsByRepetition));
        if ($maxRepFromDetails > $repetition) {
            $repetition = $maxRepFromDetails;
        }
    }
}

// JIKA TIDAK ADA DATA SAMA SEKALI, SET KE 1 REPETITION DEFAULT
if ($repetition < 1) {
    $repetition = 1;
}

@endphp

{{-- LOOP UNTUK SETIAP PENGULANGAN --}}
<ol start="1" type="1" style="margin:0pt; padding-left:0pt">
    @for($p = 1; $p <= $repetition; $p++)
    <li class="ListParagraph" style="margin-right:468.8pt; margin-bottom:2.65pt; text-indent:0pt; line-height:147%; font-size:11pt; font-weight:bold; letter-spacing:-0.1pt; list-style-position:inside">
        <span style="height:0pt; display:block; position:absolute; z-index:0">
            <img src="{{ asset('images/Aspose.Words.3583c371-5f86-44ec-a7f9-7c86fc979546.011.png') }}" width="108" height="1" alt="" style="margin-top:23.16pt; margin-left:55.02pt; -aw-left-pos:75.02pt; -aw-rel-hpos:page; -aw-rel-vpos:paragraph; -aw-top-pos:23.16pt; -aw-wrap-type:none; position:absolute" />
        </span>
        <span>Data</span>
        <span style="letter-spacing:-0.45pt"></span>
        <span>Pengukuran</span>
        <span style="letter-spacing:normal"> Setting</span>
        <span style="letter-spacing:normal">Suhu</span>
        <span style="letter-spacing:-0.05pt"></span>
        <span>ke-{{ $p }}</span>
        <span style="width:31.99pt; letter-spacing:normal; display:inline-block">&#xa0;</span>
        <span style="font-family:'Arial MT'; font-weight:normal; letter-spacing:-0.5pt">:</span>
        
        {{-- INPUT TSETTING --}}
        @php
            $currentValue = $tsettingValues[$p] ?? null;
            
            // Data murni dari database
            $formattedValue = '';
            if ($currentValue !== null && $currentValue !== '') {
                $formattedValue = htmlspecialchars($currentValue);
            }
            
            // Cek old value dari form submission
            $oldValue = old("suhu_setting_{$p}", $formattedValue);
        @endphp
        
        <input type="text"
               name="suhu_setting_{{ $p }}"
               value="{{ $oldValue }}"
               style="font-size:10pt;
                      border:none;
                      border-bottom:0.75pt solid #000;
                      width:100pt;
                      margin-left:5pt;
                      background:transparent;
                      color:#000;
                      padding:0;
                      font-family:'Arial MT';
                      height:18pt;
                      text-align:center;"
               placeholder="0.0">
    </li>
    
    <table cellspacing="0" cellpadding="0" class="TableNormal" style="width:100%; margin-left:0.48pt; border:2px solid #000000; border-collapse:collapse; margin-bottom: {{ $p < $repetition ? '40px' : '20px' }}">
        <tr style="background: #d9d9d9; height:14pt">
            <td style="width:10%; border:2px solid #000; vertical-align:middle; text-align:center">
                <span style="font-weight: bold; color: #000000; font-size:9pt">Interval Waktu</span>
            </td>
            <td style="width:12%; border:2px solid #000; vertical-align:middle; text-align:center">
                <span style="font-weight: bold; color: #000000; font-size:9pt">Pembacaan Alat</span>
            </td>
            <td colspan="9" style="border:2px solid #000; vertical-align:middle; text-align:center">
                <span style="font-weight: bold; color: #000000; font-size:9pt">Pembacaan Sensor</span>
            </td>
        </tr>
        <tr style="background: #e8e8e8; height:13pt">
            <td style="border:2px solid #000; vertical-align:middle; text-align:center">
                <span style="font-weight: bold; color: #000000; font-size:9pt">(Menit)</span>
            </td>
            <td style="border:2px solid #000; vertical-align:middle; text-align:center">
                <span style="font-family:Arial; font-size:6pt; font-weight:bold; letter-spacing:-0.25pt">o</span>
                <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.25pt; vertical-align:-3pt; font-size:9pt;">C</span>
            </td>
            @for($s = 1; $s <= 9; $s++)
            <td style="width:8.67%; border:2px solid #000; vertical-align:middle; text-align:center">
                <span style="font-weight: bold; color: #000000; font-size:9pt">{{ $s }}</span>
            </td>
            @endfor
        </tr>
        
        @foreach($interval_waktu as $interval)
        @php
            $detailData = $detailsByRepetition[$p][$interval] ?? null;
            
            // Format nilai pembacaan alat - data murni
            $alatValue = '';
            if ($detailData) {
                // Cari nilai pembacaan alat
                $readAlat = $detailData->readAlat ?? 
                           ($detailData->read_alat ?? 
                           ($detailData['readAlat'] ?? 
                           ($detailData['read_alat'] ?? null)));
                
                if ($readAlat !== null && $readAlat !== '') {
                    $alatValue = htmlspecialchars($readAlat);
                }
            }
            
            // Cek old value
            $alatOldValue = old("alat_{$p}_{$interval}", $alatValue);
        @endphp
        
        <tr style="height:22pt;">
            <td style="border:2px solid #000; padding:0; vertical-align:middle; text-align:center; font-weight:bold; font-size:10pt; color:#000;">
                {{ $interval }}
            </td>
            <td style="border:2px solid #000; padding:0; vertical-align:middle;">
                <input type="number" step="any"
                       name="alat_{{ $p }}_{{ $interval }}" 
                       value="{{ $alatOldValue }}"
                       style="width:100%;height:100%;border:none;background:transparent;text-align:center;font-size:10pt;color:#000;padding:2px;box-sizing:border-box;"
                      >
            </td>
            
            @for($s = 1; $s <= 9; $s++)
            @php
                $sensorValue = '';
                if ($detailData) {
                    // Cari nilai sensor dengan berbagai format nama field
                    $fieldNames = [
                        "readSensor{$s}",
                        "read_sensor_{$s}",
                        "sensor{$s}",
                        "sensor_{$s}"
                    ];
                    
                    foreach ($fieldNames as $field) {
                        if (isset($detailData->$field)) {
                            $rawValue = $detailData->$field;
                            break;
                        } elseif (isset($detailData[$field])) {
                            $rawValue = $detailData[$field];
                            break;
                        } else {
                            $rawValue = null;
                        }
                    }
                    
                    if ($rawValue !== null && $rawValue !== '') {
                        $sensorValue = htmlspecialchars($rawValue);
                    }
                }
                
                // Cek old value
                $sensorOldValue = old("sensor_{$p}_{$interval}_{$s}", $sensorValue);
            @endphp
            <td style="border:2px solid #000; padding:0; vertical-align:middle;">
                <input type="number" step="any" 
                       name="sensor_{{ $p }}_{{ $interval }}_{{ $s }}" 
                       value="{{ $sensorOldValue }}"
                       style="width:100%;height:100%;border:none;background:transparent;text-align:center;font-size:10pt;color:#000;padding:2px;box-sizing:border-box;"
                      >
            </td>
            @endfor
        </tr>
        @endforeach
    </table>
    @endfor
</ol>


&nbsp;  &nbsp;
                 <!-- Footer Section -->
                 <table class="kalibrasi-main-table" style="width: 100%; border-collapse: collapse;">
    <!-- HEADER FOOTER -->
    <tr>
        <td colspan="6" style="text-align: center; border: 1px solid #000; border-bottom: none; padding: 10px 0;">
            <span style="font-weight: bold; font-size: 18px; color: #000000;">Isilah lembar data kalibrasi dengan lengkap dan jelas!</span>
        </td>
    </tr>

    <!-- ALAT STANDAR + CHECKBOX (VIEW MODE) -->
    <tr style="height: 40px;">
        <td rowspan="3" style="width: 20%; border: 1px solid #000; vertical-align: middle; text-align: center; font-weight: bold; font-size: 10pt; color: #000000; background-color: #f8f9fa;">
            Alat<br>Standar
        </td>

        <!-- Alat 1 -->
        <td style="width: 5%; border: 1px solid #000; text-align: center; vertical-align: middle;">
    @php
        $alatStandar = old(
            'standard',
            isset($calibration) && $calibration->headEnclosure
                ? $calibration->headEnclosure->standard
                : ''
        );

        $hasAlat1 = str_contains($alatStandar, 'Midi Data Logger Graphtec GL-220');
    @endphp

    <input type="checkbox" name="standard_list[]"
           value="Midi Data Logger Graphtec GL-220"
           {{ $hasAlat1 ? 'checked' : '' }}
           style="transform: scale(1.2); cursor:pointer;">
</td>

        <td colspan="2" style="border: 1px solid #000; padding-left: 12px; font-size: 9pt; vertical-align: middle; color: #000000;">
            <span style="display: block; padding: 5px 0;">
                Midi Data Logger Graphtec GL-220
            </span>
        </td>

        <!-- Dikalibrasi oleh -->
        <td rowspan="3" style="width: 20%; border: 1px solid #000; text-align: center; vertical-align: top; font-size: 9pt; color: #000000; background-color: #f8f9fa; padding-top: 15px;">
            <strong>Dikalibrasi<br>oleh</strong>
        </td>
        <!-- Diperiksa oleh -->
        <td rowspan="3" style="width: 20%; border: 1px solid #000; text-align: center; vertical-align: top; font-size: 9pt; color: #000000; background-color: #f8f9fa; padding-top: 15px;">
            <strong>Diperiksa<br>oleh</strong>
        </td>
    </tr>

    <!-- Alat 2 -->
    <tr style="height: 40px;">
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle;">
    @php
        $alatStandar = old(
            'standard',
            isset($calibration) && $calibration->headEnclosure
                ? $calibration->headEnclosure->standard
                : ''
        );

        $hasAlat2 = str_contains($alatStandar, 'Midi Data Logger Graphtec GL-240');
    @endphp

    <input type="checkbox" name="standard_list[]"
           value="Midi Data Logger Graphtec GL-240"
           {{ $hasAlat2 ? 'checked' : '' }}
           style="transform: scale(1.2); cursor:pointer;">
</td>

        <td colspan="2" style="border: 1px solid #000; padding-left: 12px; font-size: 9pt; vertical-align: middle; color: #000000;">
            <span style="display: block; padding: 5px 0;">
                Midi Data Logger Graphtec GL-240
            </span>
        </td>
    </tr>

    <!-- Alat 3 -->
    <tr style="height: 40px;">
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle;">
    @php
        $alatStandar = old(
            'standard',
            isset($calibration) && $calibration->headEnclosure
                ? $calibration->headEnclosure->standard
                : ''
        );

        $hasAlat3 = str_contains($alatStandar, 'Midi Data Logger Huato');
    @endphp

    <input type="checkbox" name="standard_list[]"
           value="Midi Data Logger Huato"
           {{ $hasAlat3 ? 'checked' : '' }}
           style="transform: scale(1.2); cursor:pointer;">
</td>

        <td colspan="2" style="border: 1px solid #000; padding-left: 12px; font-size: 9pt; vertical-align: middle; color: #000000;">
            <span style="display: block; padding: 5px 0;">
                 Midi Data Logger Huato
            </span>
        </td>
    </tr>

    <!-- METODE KALIBRASI + TTD & NAMA (VIEW MODE) -->
    <tr style="height: 40px;">
        <td rowspan="2" style="width: 20%; border: 1px solid #000; text-align: center; vertical-align: middle; font-size: 9pt; color: #000000; background-color: #f8f9fa; padding: 10px;">
            <strong>Metode Kalibrasi</strong>
        </td>
        <td colspan="3" rowspan="2" style="border: 1px solid #000; padding: 10px; font-size: 9pt; vertical-align: middle; color: #000000; line-height: 1.4;">
            @if(isset($calibration) && $calibration->headEnclosure && $calibration->headEnclosure->calibrationMethod)
                {{ $calibration->headEnclosure->calibrationMethod }}
            @else
                PAS-IK1102-29
            @endif
        </td>
        
        <!-- Nama Dikalibrasi Oleh (VIEW MODE) -->
        <td style="width: 20%; border: 1px solid #000; padding: 5px; font-size: 9pt; vertical-align: middle; color: #000000;">
            <div style="width: 100%; padding: 5px; font-size: 9pt; min-height: 20px; display:flex; align-items:center; gap:6px;">
    <strong>Nama :</strong>
    <input type="text"
           name="calibratedBy"
           value="{{ old('calibratedBy', $calibration->calibratedBy ?? '') }}"
           style="flex:1; border:none; border-bottom:1px solid #000; font-size:9pt; background:transparent;">
</div>

        </td>
        
        <!-- Nama Diperiksa Oleh (VIEW MODE) -->
        <td style="width: 20%; border: 1px solid #000; padding: 5px; font-size: 9pt; vertical-align: middle; color: #000000;">
            <div style="width: 100%; padding: 5px; font-size: 9pt; min-height: 20px; display:flex; align-items:center; gap:6px;">
    <strong>Nama :</strong>
    <input type="text"
           name="verifiedBy"
           value="{{ old('verifiedBy', $calibration->verifiedBy ?? '') }}"
           style="flex:1; border:none; border-bottom:1px solid #000; font-size:9pt; background:transparent;" readonly>
</div>

        </td>
    </tr>

    <!-- TTD (VIEW MODE) -->
    <tr style="height: 40px;">
        <!-- Kolom kosong untuk metode kalibrasi -->
        <td style="width: 20%; border: 1px solid #000; padding: 10px; font-size: 9pt; vertical-align: middle; color: #000000; text-align: left;">
            <strong>TTD :</strong>
            <div style="margin-top: 5px; height: 60px; display: flex; align-items: center; justify-content: center;">
                <span style="color: #666; font-style: italic; font-size: 8pt;">
                    @if(isset($calibration) && $calibration->calibrated_by)
                        (Tanda tangan {{ $calibration->calibrated_by }})
                    @else
                        (Tanda tangan)
                    @endif
                </span>
            </div>
        </td>
        <td style="width: 20%; border: 1px solid #000; padding: 10px; font-size: 9pt; vertical-align: middle; color: #000000; text-align: left;">
            <strong>TTD :</strong>
            <div style="margin-top: 5px; height: 60px; display: flex; align-items: center; justify-content: center;">
                <span style="color: #666; font-style: italic; font-size: 8pt;">
                    @if(isset($calibration) && $calibration->verified_by)
                        (Tanda tangan {{ $calibration->verified_by }})
                    @else
                        (Tanda tangan)
                    @endif
                </span>
            </div>
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
        
       
        
        // 4. Validasi alat standar (Midimal satu dipilih)
        if (alatStandarCheckboxes.length === 0) {
            const alatStandarSection = document.querySelector('.alat-standar-table');
            if (alatStandarSection) {
                alatStandarSection.style.border = '2px solid #ffc107';
                warningMessages.push('Pilih Midimal satu alat standar');
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


<script>
function updateFormType(selectedAlat) {
    const alat = selectedAlat.toLowerCase().trim();
    
    const formTypeMap = {
        'oven': 'enclosure',
        'freezer': 'enclosure', 
        'furnace': 'enclosure',
        'incubator': 'enclosure',
        'waterbath': 'enclosure',
        'autoclave': 'enclosure'
    };
    
    const formTypeInput = document.getElementById('form_type_input');
    if (formTypeMap[alat]) {
        formTypeInput.value = formTypeMap[alat];
        console.log('✅ Form type set to: enclosure for alat:', selectedAlat);
    } else {
        formTypeInput.value = 'enclosure'; // Default ke enclosure
        console.log('ℹ️ Defaulting to enclosure for:', selectedAlat);
    }
}

// Set form type saat halaman load
document.addEventListener('DOMContentLoaded', function() {
    const selectedAlat = document.querySelector('select[name="nama_alat"]').value;
    if (selectedAlat) {
        updateFormType(selectedAlat);
    }
});
</script>

</body>
</html>