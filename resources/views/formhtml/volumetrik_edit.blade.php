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
                  <input type="hidden" name="form_type" id="form_type_input"  value="volumetrik">
                <tr>
                    <td colspan="2">
                        <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK38</p>
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
                        <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">VOLUMETRIK</p>
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
                        <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;">{{ $calibration->headVolumetrik->certificate_id ?? 'N/A' }}</p>
                    </td>
                </tr>
            </table>

            <!-- Main Form Section - Readonly -->
            <table class="kalibrasi-main-table">
                <!-- Nama Alat -->
         <tr>
    <td style="width: 20%;">
        <p style="margin: 0; color: #000000;">Nama Alat</p>
    </td>
    <td colspan="3">
        @php
            $alatOptions = ['Buret', 'Gelas Ukur', 'Pipet Ukur', 'Labu Ukur', 'Pipet Volume'];
            $selectedAlat = old('namaAlat', $calibration->namaAlat ?? '');
            $isCustomAlat = $selectedAlat && !in_array($selectedAlat, $alatOptions);
        @endphp
        
        <select name="nama_alat_select" id="nama_alat_select" class="kalibrasi-input" 
                onchange="toggleManualInput(this.value)" required 
                style="background-color: #f5f5f5; color: #333; border: 1px solid #ced4da; padding: 6px 10px; border-radius: 4px; width: 100%;">
            <option value="">-- Pilih Jenis Alat --</option>
            
            @foreach($alatOptions as $alat)
                <option value="{{ $alat }}" {{ $selectedAlat == $alat ? 'selected' : '' }}>
                    {{ $alat }}
                </option>
            @endforeach
            
            {{-- Opsi Input Manual --}}
            <option value="MANUAL_INPUT" {{ $isCustomAlat ? 'selected' : '' }}>
                -- Input Manual Nama Alat --
            </option>
        </select>
        
        <!-- Input Manual - Tampilkan jika custom atau MANUAL_INPUT selected -->
        <div id="manualInputContainer" style="display: {{ $isCustomAlat ? 'block' : 'none' }}; margin-top: 10px;">
            <input type="text" name="nama_alat_manual" id="nama_alat_manual"
                   value="{{ $isCustomAlat ? $selectedAlat : '' }}"
                   placeholder="Ketik nama alat secara manual"
                   style="background-color: #f5f5f5; color: #333; border: 1px solid #ced4da; padding: 6px 10px; border-radius: 4px; width: 100%;"
                   oninput="syncNamaAlat()">
        </div>
        
        <!-- Hidden input untuk menyimpan nama alat final -->
        <input type="hidden" name="namaAlat" id="namaAlat_final" value="{{ $selectedAlat }}">
        
        <!-- Hidden input untuk form_type -->
        <input type="hidden" name="form_type" id="form_type_input" 
               value="{{ old('form_type', $calibration->form_type ?? 'volumetrik') }}">
    </td>
</tr>

<script>
var tempFormDataStore = window.tempFormDataStore;
var isRestoring = window.isRestoring;
var tabSubmitStatus = window.tabSubmitStatus;
var currentActiveTabId = '1';

// Fungsi untuk toggle input manual
function toggleManualInput(selectedValue) {
    const manualInputContainer = document.getElementById('manualInputContainer');
    const manualInput = document.getElementById('nama_alat_manual');
    const namaAlatFinal = document.getElementById('namaAlat_final');
    
    if (selectedValue === 'MANUAL_INPUT') {
        // Tampilkan input manual
        manualInputContainer.style.display = 'block';
        if (manualInput) {
            manualInput.required = true;
            manualInput.focus();
        }
        // Kosongkan final jika user pilih manual tapi belum input
        if (namaAlatFinal) {
            namaAlatFinal.value = '';
        }
    } else {
        // Sembunyikan input manual
        manualInputContainer.style.display = 'none';
        if (manualInput) {
            manualInput.required = false;
            manualInput.value = '';
        }
        // Set nilai final dari dropdown
        if (namaAlatFinal && selectedValue) {
            namaAlatFinal.value = selectedValue;
        }
    }
}

// Fungsi untuk sync nilai dari input manual ke hidden input
function syncNamaAlat() {
    const manualInput = document.getElementById('nama_alat_manual');
    const namaAlatFinal = document.getElementById('namaAlat_final');
    const selectElement = document.getElementById('nama_alat_select');
    
    if (manualInput && namaAlatFinal && selectElement) {
        if (selectElement.value === 'MANUAL_INPUT' && manualInput.value.trim() !== '') {
            namaAlatFinal.value = manualInput.value.trim();
        }
    }
}

// Setup saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    const selectElement = document.getElementById('nama_alat_select');
    const manualInput = document.getElementById('nama_alat_manual');
    const namaAlatFinal = document.getElementById('namaAlat_final');
    const form = document.querySelector('form');
    
    // Setup event listeners
    if (selectElement) {
        selectElement.addEventListener('change', function() {
            toggleManualInput(this.value);
        });
    }
    
    if (manualInput) {
        manualInput.addEventListener('input', syncNamaAlat);
        manualInput.addEventListener('blur', syncNamaAlat);
    }
    
    // Handle form submission
    if (form) {
        form.addEventListener('submit', function(e) {
            const selectElement = document.getElementById('nama_alat_select');
            const manualInput = document.getElementById('nama_alat_manual');
            const namaAlatFinal = document.getElementById('namaAlat_final');
            
            // Validasi
            if (!selectElement || selectElement.value === '') {
                alert('Silakan pilih jenis alat dari dropdown!');
                e.preventDefault();
                selectElement.focus();
                return false;
            }
            
            // Validasi input manual
            if (selectElement.value === 'MANUAL_INPUT') {
                if (!manualInput || manualInput.value.trim() === '') {
                    alert('Silakan isi nama alat secara manual!');
                    e.preventDefault();
                    manualInput.focus();
                    return false;
                }
                // Pastikan namaAlat_final terisi
                if (namaAlatFinal) {
                    namaAlatFinal.value = manualInput.value.trim();
                }
            } else {
                // Pastikan namaAlat_final terisi untuk dropdown biasa
                if (namaAlatFinal) {
                    namaAlatFinal.value = selectElement.value;
                }
            }
            
            return true;
        });
    }
    
    // Initialize berdasarkan nilai awal
    @if($isCustomAlat)
        // Jika custom, pastikan manual input terisi
        if (manualInput && namaAlatFinal) {
            syncNamaAlat();
        }
    @endif
});
</script>

                <!-- Merek & Kode Alat -->
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
        <div class="kalibrasi-section-header" style="color: #000000;">Fungsi Komponen Lainnya</div>
        
        <!-- Radio Button Section - Text di atas, radio di bawah -->
        <div class="d-flex justify-content-center align-items-center mb-4" style="gap: 60px;">
            <div class="text-center">
                <span class="fw-bold d-block mb-2" style="color: #000000; font-size: 14px;">Ok</span>
               <input type="radio" name="kondisiAlat" value="ok"
 {{ old('kondisiAlat', $calibration->kondisiAlat) == 'ok' ? 'checked' : '' }}>
            </div>
            <div class="text-center">
                <span class="fw-bold d-block mb-2" style="color: #000000; font-size: 14px;">Rusak</span>
               <input type="radio" name="kondisiAlat" value="rusak"
 {{ old('kondisiAlat', $calibration->kondisiAlat) == 'rusak' ? 'checked' : '' }}>
            </div>
        </div>
        
        <!-- Keterangan Section -->
        <div class="d-flex align-items-center">
            <span class="fw-bold me-3" style="color: #000000; min-width: 100px;">Keterangan :</span>
            <div style="flex: 1;">
                <input type="text" class="kalibrasi-input"
       name="keterangan"
       value="{{ old('keterangan', $calibration->keterangan) }}">

            </div>
        </div>
    </div>
    
    <!-- Kondisi Kalibrasi -->
    <div class="col-md-6 mb-4">
        <div class="kalibrasi-section-header" style="color: #000000;">Kondisi Kalibrasi</div>
        
        <table class="table table-bordered">
            <tr>
                <td class="table-secondary fw-bold" style="width:30%;color:#000000;"></td>
                <td class="table-secondary fw-bold text-center">Awal</td>
                <td class="table-secondary fw-bold text-center">Tengah</td>
                <td class="table-secondary fw-bold text-center">Akhir</td>
            </tr>

            <tr>
                <td class="bg-light fw-bold">Suhu (°C)</td>
                <td><input type="text" name="RT_condition1" class="kondisi-input"
                           value="{{ $calibration->RT_condition1 }}"></td>
                <td><input type="text" name="RT_condition2" class="kondisi-input"
                           value="{{ $calibration->RT_condition2 }}"></td>
                <td><input type="text" name="RT_condition3" class="kondisi-input"
                           value="{{ $calibration->RT_condition3 }}"></td>
            </tr>

            <tr>
                <td class="bg-light fw-bold">RH (%)</td>
                <td><input type="text" name="RH_condition1" class="kondisi-input"
                           value="{{ $calibration->RH_condition1 }}"></td>
                <td><input type="text" name="RH_condition2" class="kondisi-input"
                           value="{{ $calibration->RH_condition2 }}"></td>
                <td><input type="text" name="RH_condition3" class="kondisi-input"
                           value="{{ $calibration->RH_condition3 }}"></td>
            </tr>
        </table>
    </div>
</div>

            <!-- Data Kalibrasi Section -->
            <div class="data-kalibrasi-header" style="color: #000000;">DATA KALIBRASI</div>
            
           <table cellspacing="0" cellpadding="0" style="width:100%; max-width:800pt; margin:10pt 0; border:2pt solid #000; border-collapse:collapse; font-family:Arial,Helvetica,sans-serif;">
    
        <!-- Header Baris 1 -->
        <tr style="height:45pt;">
            <td rowspan="2" style="width:160pt; border:2pt solid #000; background:#f0f0f0; text-align:center; vertical-align:middle;">
                <p style="margin:0; font-size:15pt; font-weight:bold;">Nominal Alat Ukur</p>
                <p style="margin-top:10pt; font-size:12pt;">
                    (
                    <input type="text" name="satuan_alatUkur"
                           value="{{ old('satuan_alatUkur', $calibration->headVolumetrik->satuan_alatUkur ?? '') }}"
                           style="border:none; outline:none; font-size:12pt; width:150px; text-align:center; background:none;"
                           placeholder="......">
                    )
                </p>
            </td>
            <td colspan="2" style="width:320pt; border:2pt solid #000; background:#f0f0f0; text-align:center; vertical-align:middle;">
                <p style="margin:0; font-size:15pt; font-weight:bold;">Pembacaan Timbangan (g)</p>
            </td>
            <td rowspan="2" style="width:140pt; border:2pt solid #000; background:#f0f0f0; text-align:center; vertical-align:middle;">
                <p style="margin:0; font-size:15pt; font-weight:bold;">Suhu Air Suling</p>
                <p style="margin-top:8pt; font-size:15pt;">°C</p>
            </td>
            <td rowspan="2" style="width:140pt; border:2pt solid #000; background:#f0f0f0; text-align:center; vertical-align:middle;">
                <p style="margin:0; font-size:15pt; font-weight:bold;">Tekanan Udara</p>
                <p style="margin-top:8pt; font-size:15pt;">hPa</p>
            </td>
        </tr>
    
        <!-- Header Baris 2 -->
        <tr style="height:40pt;">
            <td style="width:160pt; border:2pt solid #000; background:#f0f0f0; text-align:center; vertical-align:middle;">
                <p style="margin:0; font-size:14pt; font-weight:bold;">Massa Kosong</p>
            </td>
            <td style="width:160pt; border:2pt solid #000; background:#f0f0f0; text-align:center; vertical-align:middle;">
                <p style="margin:0; font-size:14pt; font-weight:bold;">Massa Isi</p>
            </td>
        </tr>
    
        <!-- Ambil data detail, urutkan berdasarkan titikUkur -->
        @php
            $details = $calibration->detailVolumetriks()
                       
                        ->get();
            
            // Pastikan selalu ada 5 nominal (15 baris)
            $totalNominals = 5;
            $totalRows = $totalNominals * 3; // 15 baris
        @endphp
    
        @for($nominalIndex = 0; $nominalIndex < $totalNominals; $nominalIndex++)
            @php
                $detail = $details->get($nominalIndex) ?? null;
                $nominalNumber = $nominalIndex + 1;
            @endphp
            
            @for($repeat = 1; $repeat <= 3; $repeat++)
            <tr style="height:32pt;">
                @if($repeat == 1)
                <td rowspan="3" style="width:160pt; border:2pt solid #000; vertical-align:middle; text-align:center;">
                    <input type="text" name="nominal_{{ $nominalNumber }}" 
                           value="{{ old('nominal_'.$nominalNumber, $detail->titikUkur ?? '') }}"
                           step="any"
                           style="width:100%; height:100%; border:none; background:transparent; font-size:13pt; text-align:center;"
                           {{ $detail ? '-' : 'placeholder= - ' }}>
                </td>
                @endif
    
                <td style="border:2pt solid #000; vertical-align:middle; text-align:center;">
                    <input type="text" 
                           name="massa_kosong_{{ $nominalNumber }}_{{ $repeat }}" 
                           value="{{ old('massa_kosong_'.$nominalNumber.'_'.$repeat, 
                                   $repeat == 1 ? ($detail->masssaKosong01 ?? $detail->massaKosong01 ?? '') : 
                                   ($repeat == 2 ? ($detail->masssaKosong02 ?? $detail->massaKosong02 ?? '') : 
                                   ($detail->masssaKosong03 ?? $detail->massaKosong03 ?? ''))) }}"
                           step="any"
                           style="width:100%; height:100%; border:none; background:transparent; font-size:13pt; text-align:center;"
                           placeholder= - >
                </td>
                <td style="border:2pt solid #000; vertical-align:middle; text-align:center;">
                    <input type="text" 
                           name="massa_isi_{{ $nominalNumber }}_{{ $repeat }}" 
                           value="{{ old('massa_isi_'.$nominalNumber.'_'.$repeat, 
                                   $repeat == 1 ? ($detail->massaIsi01 ?? '') : 
                                   ($repeat == 2 ? ($detail->massaIsi02 ?? '') : 
                                   ($detail->massaIsi03 ?? ''))) }}"
                           step="any"
                           style="width:100%; height:100%; border:none; background:transparent; font-size:13pt; text-align:center;"
                           placeholder= ->
                </td>
                <td style="border:2pt solid #000; vertical-align:middle; text-align:center;">
                    <input type="text" 
                           name="suhu_{{ $nominalNumber }}_{{ $repeat }}" 
                           value="{{ old('suhu_'.$nominalNumber.'_'.$repeat, 
                                   $repeat == 1 ? ($detail->T_airSuling01 ?? '') : 
                                   ($repeat == 2 ? ($detail->T_airSuling02 ?? '') : 
                                   ($detail->T_airSuling03 ?? ''))) }}"
                           step="any"
                           style="width:100%; height:100%; border:none; background:transparent; font-size:13pt; text-align:center;"
                           placeholder= - >
                </td>
                <td style="border:2pt solid #000; vertical-align:middle; text-align:center;">
                    <input type="text" 
                           name="tekanan_{{ $nominalNumber }}_{{ $repeat }}" 
                           value="{{ old('tekanan_'.$nominalNumber.'_'.$repeat, 
                                   $repeat == 1 ? ($detail->P_Udara01 ?? '') : 
                                   ($repeat == 2 ? ($detail->P_Udara02 ?? '') : 
                                   ($detail->P_Udara03 ?? ''))) }}"
                           step="any"
                           style="width:100%; height:100%; border:none; background:transparent; font-size:13pt; text-align:center;"
                           placeholder= - >
                </td>
            </tr>
            @endfor
        @endfor
    
    </table>
    
    <p style="margin-top:2.15pt; margin-left:18.8pt; margin-bottom:1.05pt; font-size:15pt">
        <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.1pt">REPEATABILITY</span>
    </p>
    
    <table cellspacing="0" cellpadding="0" class="TableNormal" 
           style="margin-left:10pt; width:100%; max-width:750pt; border:2pt solid #000000; border-collapse:collapse; font-family:Arial;">
    
        <!-- Header -->
        <tr style="height:35pt">
            <td rowspan="2" style="width:140pt; border:2pt solid #000000; vertical-align:middle; background-color:#d9d9d9; text-align:center;">
                <p style="margin:0; font-size:14pt; font-weight:bold;">Nominal Alat Ukur</p>
                <p style="margin-top:10pt; font-size:12pt;">
                    (
                    <input type="text" name="satuan_rep"
                           value="{{ old('satuan_rep', $calibration->headVolumetrik->satuan_rep ?? '') }}"
                           style="border:none; outline:none; font-size:12pt; width:150px; text-align:center; background:none;"
                           placeholder="......">
                    )
                </p>
            </td>
            <td colspan="2" style="width:280pt; border:2pt solid #000000; vertical-align:middle; background-color:#d9d9d9; text-align:center;">
                <p style="margin:0; font-size:14pt; font-weight:bold;">Pembacaan Timbangan (g)</p>
            </td>
            <td rowspan="2" style="width:120pt; border:2pt solid #000000; vertical-align:middle; background-color:#d9d9d9; text-align:center;">
                <p style="margin:0; font-size:14pt; font-weight:bold;">Suhu Air Suling</p>
                <p style="margin-top:5pt; font-size:14pt;">°C</p>
            </td>
            <td rowspan="2" style="width:120pt; border:2pt solid #000000; vertical-align:middle; background-color:#d9d9d9; text-align:center;">
                <p style="margin:0; font-size:14pt; font-weight:bold;">Tekanan Udara</p>
                <p style="margin-top:5pt; font-size:14pt;">hPa</p>
            </td>
        </tr>
    
        <tr style="height:30pt">
            <td style="width:140pt; border:2pt solid #000000; vertical-align:middle; background-color:#d9d9d9; text-align:center;">
                <p style="margin:0; font-size:12pt; font-weight:bold;">Massa Kosong</p>
            </td>
            <td style="width:140pt; border:2pt solid #000000; vertical-align:middle; background-color:#d9d9d9; text-align:center;">
                <p style="margin:0; font-size:12pt; font-weight:bold;">Massa Isi</p>
            </td>
        </tr>
    
        <!-- Ambil data AddVolumetrik (repeatability) -->
        @php
            $repeatData = $calibration->addVolumetrik()->orderBy('id')->get();
            
            // Jika tidak ada data, buat array kosong untuk 10 baris
            if($repeatData->isEmpty()) {
                $repeatData = collect();
                for($i = 0; $i < 10; $i++) {
                    $repeatData->push((object)[]);
                }
            }
            
            // Ambil nominal dari data pertama jika ada
            $firstData = $repeatData->first();
            $nominalValue = $firstData->titikUkur ?? $firstData->nominal ?? '';
        @endphp
    
        <!-- Tampilkan 10 baris data -->
        @for($i = 1; $i <= 10; $i++)
            @php
                $data = $repeatData->get($i - 1) ?? (object)[];
            @endphp
            <tr style="height:25pt">
                @if($i == 1)
                <td rowspan="10" style="width:140pt; border:2pt solid #000000; vertical-align:middle; text-align:center;">
                    <input type="text" name="repeatability_nominal" 
                           value="{{ old('repeatability_nominal', $nominalValue) }}"
                           step="any"
                           style="width:100%; height:100%; border:none; font-size:12pt; text-align:center; background:transparent;"
                           placeholder= - >
                </td>
                @endif
    
                <td style="width:140pt; border:2pt solid #000000; vertical-align:middle;">
                    <input type="text" 
                           name="repeat_massa_kosong_{{ $i }}" 
                           value="{{ old('repeat_massa_kosong_'.$i, 
                                   $data->massaKosong ?? $data->masssaKosong ?? $data->massa_kosong ?? '') }}"
                           step="any"
                           style="width:100%; height:100%; border:none; font-size:12pt; text-align:center; background:transparent;"
                           placeholder= - >
                </td>
                <td style="width:140pt; border:2pt solid #000000; vertical-align:middle;">
                    <input type="text" 
                           name="repeat_massa_isi_{{ $i }}" 
                           value="{{ old('repeat_massa_isi_'.$i, 
                                   $data->massaIsi ?? $data->massa_isi ?? '') }}"
                           step="any"
                           style="width:100%; height:100%; border:none; font-size:12pt; text-align:center; background:transparent;"
                           placeholder= - >
                </td>
                <td style="width:120pt; border:2pt solid #000000; vertical-align:middle;">
                    <input type="text" 
                           name="repeat_suhu_{{ $i }}" 
                           value="{{ old('repeat_suhu_'.$i, 
                                   $data->T_airSuling ?? $data->t_airSuling ?? $data->suhu ?? '') }}"
                           step="any"
                           style="width:100%; height:100%; border:none; font-size:12pt; text-align:center; background:transparent;"
                           placeholder= - >
                </td>
                <td style="width:120pt; border:2pt solid #000000; vertical-align:middle;">
                    <input type="text" 
                           name="repeat_tekanan_{{ $i }}" 
                           value="{{ old('repeat_tekanan_'.$i, 
                                   $data->P_Udara ?? $data->p_udara ?? $data->tekanan ?? '') }}"
                           step="any"
                           style="width:100%; height:100%; border:none; font-size:12pt; text-align:center; background:transparent;"
                           placeholder= - >
                </td>
            </tr>
        @endfor
    
    </table>

&nbsp;  &nbsp;
<table class="kalibrasi-main-table" style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
    <!-- HEADER -->
    <tr>
        <td colspan="6" style="text-align: center; border: 1px solid #000; border-bottom: none; padding: 10px 0;">
            <span style="font-weight: bold; font-size: 18px; color: #000000;">Isilah lembar data kalibrasi dengan lengkap dan jelas!</span>
        </td>
    </tr>

    @php
        // Ambil data standard dari head_volumetrik
        $standard = '';
        if (isset($calibration) && $calibration->headVolumetrik) {
            $standard = $calibration->headVolumetrik->standard ?? '';
        }
    @endphp

    <!-- ALAT STANDAR (EDIT MODE) -->
    <tr style="height: 40px;">
        <td rowspan="5" style="width: 15%; border: 1px solid #000; vertical-align: middle; text-align: center; font-weight: bold; font-size: 10pt; background-color: #f8f9fa;">
            Alat<br>Standar
        </td>

        <!-- Alat 1 -->
        <td style="width: 5%; border: 1px solid #000; text-align: center; vertical-align: middle;">
            <input type="checkbox" 
                   name="alat_standar[]" 
                   value="Semi Microbalance, BEL, Res 0.01 mg (0~200 ml)" 
                   {{ str_contains($standard, 'Semi Microbalance, BEL, Res 0.01 mg') ? 'checked' : '' }}
                   style="width: 18px; height: 18px; cursor: pointer;">
        </td>
        <td colspan="2" style="border: 1px solid #000; padding-left: 12px; font-size: 9pt; vertical-align: middle;">
            <label style="cursor: pointer; display: block; padding: 5px 0;">
                - Semi Microbalance, BEL, Res 0.01 mg (0~200 ml)
            </label>
        </td>

        <td rowspan="5" style="width: 15%; border: 1px solid #000; text-align: center; vertical-align: top; font-size: 9pt; background-color: #f8f9fa; padding-top: 15px;">
            <strong>Dikalibrasi<br>oleh</strong>
        </td>
        <td rowspan="5" style="width: 15%; border: 1px solid #000; text-align: center; vertical-align: top; font-size: 9pt; background-color: #f8f9fa; padding-top: 15px;">
            <strong>Diperiksa<br>oleh</strong>
        </td>
    </tr>

    <!-- Alat 2 -->
    <tr style="height: 40px;">
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle;">
            <input type="checkbox" 
                   name="alat_standar[]" 
                   value="Semi Microbalance, Radwag, Res 0.1 mg (0~200 ml)" 
                   {{ str_contains($standard, 'Semi Microbalance, Radwag, Res 0.1 mg') ? 'checked' : '' }}
                   style="width: 18px; height: 18px; cursor: pointer;">
        </td>
        <td colspan="2" style="border: 1px solid #000; padding-left: 12px; font-size: 9pt; vertical-align: middle;">
            <label style="cursor: pointer; display: block; padding: 5px 0;">
                - Semi Microbalance, Radwag, Res 0.1 mg (0~200 ml)
            </label>
        </td>
    </tr>

    <!-- Alat 3 -->
    <tr style="height: 40px;">
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle;">
            <input type="checkbox" 
                   name="alat_standar[]" 
                   value="Semi Microbalance, AND, Res 0.1 mg (0~200 ml)" 
                   {{ str_contains($standard, 'Semi Microbalance, AND, Res 0.1 mg') ? 'checked' : '' }}
                   style="width: 18px; height: 18px; cursor: pointer;">
        </td>
        <td colspan="2" style="border: 1px solid #000; padding-left: 12px; font-size: 9pt; vertical-align: middle;">
            <label style="cursor: pointer; display: block; padding: 5px 0;">
                - Semi Microbalance, AND, Res 0.1 mg (0~200 ml)
            </label>
        </td>
    </tr>

    <!-- Alat 4 -->
    <tr style="height: 40px;">
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle;">
            <input type="checkbox" 
                   name="alat_standar[]" 
                   value="Timbangan Digital, AND, Res 0.01 g" 
                   {{ str_contains($standard, 'Timbangan Digital, AND, Res 0.01 g') ? 'checked' : '' }}
                   style="width: 18px; height: 18px; cursor: pointer;">
        </td>
        <td colspan="2" style="border: 1px solid #000; padding-left: 12px; font-size: 9pt; vertical-align: middle;">
            <label style="cursor: pointer; display: block; padding: 5px 0;">
                - Timbangan Digital, AND, Res 0.01 g
            </label>
        </td>
    </tr>

    <!-- Alat 5 -->
    <tr style="height: 40px;">
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle;">
            <input type="checkbox" 
                   name="alat_standar[]" 
                   value="Timbangan Digital, Rinstrum, Res 0.1g (200~1000 ml)" 
                   {{ str_contains($standard, 'Timbangan Digital, Rinstrum, Res 0.1g') ? 'checked' : '' }}
                   style="width: 18px; height: 18px; cursor: pointer;">
        </td>
        <td colspan="2" style="border: 1px solid #000; padding-left: 12px; font-size: 9pt; vertical-align: middle;">
            <label style="cursor: pointer; display: block; padding: 5px 0;">
                - Timbangan Digital, Rinstrum, Res 0.1g (200~1000 ml)
            </label>
        </td>
    </tr>

    <!-- METODE KALIBRASI + TTD -->
    <tr style="height: 50px;">
        <td style="width: 15%; border: 1px solid #000; text-align: center; vertical-align: middle; font-size: 9pt; background-color: #f8f9fa;">
            <strong>Metode<br>Kalibrasi</strong>
        </td>
        <td colspan="3" style="border: 1px solid #000; padding: 10px; font-size: 9pt; vertical-align: middle;">
            <input type="text" 
                   name="calibration_method" 
                   value="{{ $calibration->headVolumetrik->calibrationMethod ?? 'PAS-IK1102-38 (Volumetrik Glassware)' }}"
                   style="width: 100%; border: 1px solid #ddd; padding: 5px; font-size: 9pt; background: white;" readonly>
        </td>

        <!-- Dikalibrasi oleh -->
        <td style="width: 15%; border: 1px solid #000; padding: 10px 5px; font-size: 9pt; vertical-align: middle;">
            <div style="min-height: 24px; padding: 5px 0;">
                <input type="text" 
                       name="calibratedBy" 
                       value="{{ $calibration->headVolumetrik->calibratedBy ?? $calibration->calibratedBy ?? '' }}"
                       placeholder="Nama lengkap"
                       style="width: 100%; border: 1px solid #ddd; padding: 5px; font-size: 9pt; background: white;">
            </div>
            <div style="margin-top: 10px;">
                <strong>TTD :</strong>
                @if(isset($calibration->headVolumetrik) && !empty($calibration->headVolumetrik->ttd_calibrated_by))
                    <img src="{{ asset('storage/' . $calibration->headVolumetrik->ttd_calibrated_by) }}" 
                         alt="TTD Dikalibrasi" 
                         style="max-width: 80px; max-height: 40px; margin-left: 10px;">
                @else
                    <span style="margin-left: 10px; color: #999;">-</span>
                @endif
            </div>
        </td>

        <!-- Diperiksa oleh -->
        <td style="width: 15%; border: 1px solid #000; padding: 10px 5px; font-size: 9pt; vertical-align: middle;">
            <div style="min-height: 24px; padding: 5px 0;">
                <input type="text" 
                       name="verifiedBy" 
                       value="{{ $calibration->headVolumetrik->verifiedBy ?? $calibration->verifiedBy ?? '' }}"
                       placeholder="Nama lengkap"
                       style="width: 100%; border: 1px solid #ddd; padding: 5px; font-size: 9pt; background: white;" readonly>
            </div>
            <div style="margin-top: 10px;">
                <strong>TTD :</strong>
                @if(isset($calibration->headVolumetrik) && !empty($calibration->headVolumetrik->ttd_verified_by))
                    <img src="{{ asset('storage/' . $calibration->headVolumetrik->ttd_verified_by) }}" 
                         alt="TTD Diperiksa" 
                         style="max-width: 80px; max-height: 40px; margin-left: 10px;">
                @else
                    <span style="margin-left: 10px; color: #999;">-</span>
                @endif
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
        document.querySelectorAll('input[type="text"]').forEach(input => {
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
        document.querySelectorAll('input[type="text"]').forEach(input => {
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
        document.querySelectorAll('input[type="text"]').forEach(input => {
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
        'Buret': 'volumetrik',
        'Gelas Ukur': 'volumetrik', 
        'Pipet Ukur': 'volumetrik',
        'Labu Ukur': 'volumetrik',
        'Pipet Volume': 'volumetrik',
        'autoclave': 'volumetrik'
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