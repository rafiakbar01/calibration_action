<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Kalibrasi - PT. PANANJUNG ANUGRAH SOLUTION</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Pastikan semua text berwarna hitam */
        .form-kalibrasi-container,
        .form-kalibrasi-container *:not(input):not(select):not(textarea):not(button) {
            color: #000000 !important;
        }
        
        /* Input fields tetap dengan warna default mereka */
        .kalibrasi-input {
            color: #000000 !important;
            border: 1px solid #ced4da !important;
            padding: 6px 10px;
            border-radius: 4px;
            width: 100%;
        }
        
        /* Placeholder text */
        .kalibrasi-input::placeholder {
            color: #666666 !important;
        }

        /* Styling khusus untuk input suhu dan RH */
        .kondisi-input {
            border: 1px solid #000 !important;
            text-align: center;
            width: 100%;
            padding: 4px;
        }

        /* Header styling */
        .kalibrasi-header-table {
            width: 100%;
            margin-bottom: 20px;
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

        /* Submit Button Styling */
        .btn-primary {
            background: linear-gradient(135deg, #3b82f6, #1e40af);
            border: none;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
            background: linear-gradient(135deg, #1e40af, #1e3a8a);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #6b7280, #4b5563);
            border: none;
            box-shadow: 0 4px 15px rgba(107, 114, 128, 0.3);
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(107, 114, 128, 0.4);
            background: linear-gradient(135deg, #4b5563, #374151);
        }

        /* Form validation styling */
        input:required:invalid {
            border-color: #dc3545 !important;
        }

        input:required:valid {
            border-color: #198754 !important;
        }

        /* Styling untuk tabel data kalibrasi */
        .data-kalibrasi-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .data-kalibrasi-table td, .data-kalibrasi-table th {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
            vertical-align: middle;
            font-size: 11pt;
        }
        .data-kalibrasi-table th {
            background-color: #d0d0d0;
            font-weight: bold;
        }
        .section-title {
            background-color: #a0a0a0;
            font-size: 1.2em;
            font-weight: bold;
        }
        .sub-header {
            background-color: #e6e6e6;
        }
        .unit-note {
            font-size: 0.9em;
            color: #555;
        }
        
/* Active state untuk tombol warna dan ukuran */
.color-btn.active {
    border-color: #000;
    box-shadow: 0 0 5px rgba(0,0,0,0.5);
    transform: scale(1.1);
}

.size-btn.active {
    background-color: #007bff;
    color: white;
    border-color: #0056b3;
}

/* Validasi input */
.is-invalid {
    border-color: #dc3545 !important;
    box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
}

.invalid-feedback {
    display: block;
    color: #dc3545;
    font-size: 0.875em;
    margin-top: 0.25rem;
}
  /* Debug panel styling */
        .debug-panel {
            position: fixed;
            top: 10px;
            right: 10px;
            background: rgba(0,0,0,0.85);
            color: #0f0;
            padding: 15px;
            font-family: monospace;
            font-size: 12px;
            z-index: 9999;
            border: 2px solid #0f0;
            border-radius: 5px;
            max-width: 300px;
        }
        
        .debug-panel button {
            background: #333;
            color: white;
            border: 1px solid #0f0;
            padding: 2px 8px;
            cursor: pointer;
            float: right;
        }
        
        .manual-test-panel {
            position: fixed;
            bottom: 10px;
            left: 10px;
            background: rgba(255,255,0,0.9);
            padding: 10px;
            border-radius: 5px;
            z-index: 9998;
        }
    </style>
</head>
<body>
    
    <div class="container my-4">
        <!-- resources/views/formhtml/inside_micrometer.blade.php -->
        <form method="POST" action="/calibrations" id="kalibrasiForm">
        @csrf
        <input type="hidden" name="form_type" value="surface_plate">
                

            <div class="form-kalibrasi-container">
                <table class="kalibrasi-header-table">
                    <tr>
                        <td colspan="2">
                            <p style="margin: 0; font-size: 14px; color: #000000;text-align: left;">PAS-FLK53</p>
                        </td>
                        <td rowspan="5" style="text-align: center; vertical-align: middle; padding: 10px 0;">
                          <div style="display: inline-block; text-align: center;">
                              <div style="margin-bottom: 15px;">
                                  <!-- Logo PT. PANANJUNG ANUGRAH SOLUTION -->
                                  <img src="/logo/logo_pas_basic.png" alt="Logo PT. PAS" style="width: 107px; height: 54px; display: block; margin: 0 auto;">
                              </div>
                              <p style="font-weight: bold; margin: 0; font-size: 15px; color: #000000;">PT. PANANJUNG ANUGRAH SOLUTION</p>
                          </div>
                      </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p style="margin: 0; font-size: 14px; color: #000000;text-align: left;">LEMBAR KERJA KALIBRASI</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;text-align: left;">MEJA RATA</p>
                        </td>
                    </tr>
                   
                    
                   
                     <tr>
                        <td style="width: 25%;">
                            <p style="margin: 0; font-size: 14px; color: #000000;text-align: left;">No. Sertifikat</p>
                        </td>
                        <td style="width: 45%;">
                            <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;text-align: left;">PAS - </p>
                        </td>
                    </tr>
                </table>

                <!-- Main Form Section -->
                <table class="kalibrasi-main-table">
                    <!-- Nama Alat -->
                   <tr>
                            <td style="width: 20%;">
                                <p style="margin: 0; color: #000000;">Nama Alat</p>
                            </td>
                            <td colspan="3">
                                <input type="text"
                                    name="nama_alat"
                                    class="kalibrasi-input"
                                    value="Meja Rata"
                                    placeholder="Meja Rata"
                                    readonly
                                    style="background-color: #f5f5f5; color: #333;">
                            </td>
                    </tr>


                    <!-- Merek & Kode Alat -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;text-align: left;">Merek</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" name="merek" class="kalibrasi-input me-3" placeholder="Masukkan merek alat" style="width: 60%;text-align: left;" required>
                                <span class="me-1" style="color:#000000;">KodeAlat:</span>
                                <input type="text" name="kode_alat" class="kalibrasi-input" placeholder="Masukkan kode" style="width: 30%; text-align: left;">
                            </div>
                        </td>
                    </tr>

                    <!-- Type / No. Seri -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;text-align: left;">Type / No. Seri</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" 
                                    name="type_alat" 
                                    class="kalibrasi-input me-3" 
                                    placeholder="masukkan type alat" 
                                    style="width: 45%; text-align: left;"
                                   >
                                <span class="me-3" style="color: #000000;">/</span>
                                <input type="text" 
                                    name="no_seri" 
                                    class="kalibrasi-input" 
                                    placeholder="masukkan no. seri" 
                                    style="width: 45%; text-align: left;"
                                  
                                    required>
                            </div>
                        </td>
                    </tr>
                    <!-- Rentang Ukur -->
                    <!-- <tr>
                        <td><p style="margin:0;color:#000; text-align: left;">Rentang Ukur</p></td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="number"
                                    name="rentang_ukur_min"
                                    class="kalibrasi-input me-3"
                                    value="0"
                                    step="any"
                                    style="width:45%;"
                                    placeholder="Masukkan Range Min"
                                    required>

                                <span class="me-3">-</span>

                                <input type="number"
                                    name="rentang_ukur_max"
                                    id="rentang_ukur_max"
                                    class="kalibrasi-input"
                                    step="any"
                                    style="width:45%;"
                                    placeholder="Masukkan Range Max"
                                    required
                                    oninput="updateKapasitas()">
                            </div>
                        </td>
                    </tr> -->

                    <!-- Kapasitas / Resolusi -->
                    <tr>
        <td style="vertical-align: middle;">
            <p style="margin: 0; color: #000000; text-align: left; padding-left: 5px;">Kapasitas / Resolusi</p>
        </td>
        <td colspan="3" style="vertical-align: middle;">
            <div class="d-flex align-items-center gap-3">
                <input type="text"     id="kapasitas" name="kapasitas" class="kalibrasi-input" placeholder="Masukkan kapasitas" style="width: 45%;" required>
                <span style="color: #000000; font-size: 1.2em;">/</span>
                <input type="text" name="resolusi" class="kalibrasi-input" placeholder="Masukkan Resolusi" style="width: 45%;" required>
            </div>
        </td>
    </tr>

                    <!-- Nama Pemilik -->
                       <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Nama Pemilik</p>
                        </td>
                        <td colspan="3">
                            <input type="text" name="nama_pemilik" class="kalibrasi-input" placeholder="Masukkan nama pemilik / instansi" required>
                        </td>
                    </tr>

                    
                 

                    <!-- Tanggal Alat Masuk & Kalibrasi -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000; text-align: left;">Tanggal Alat Masuk</p>
                        </td>
                        <td colspan="3">
                            <input type="date" name="tanggal_alat_masuk" class="kalibrasi-input" value="{{ date('Y-m-d') }}" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000; text-align: left;">Tanggal Kalibrasi</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <!-- Tanggal Kalibrasi -->
                                <input type="date" 
                                    name="tanggal_kalibrasi" 
                                    class="kalibrasi-input me-3" 
                                    style="width: 45%;" 
                                    required
                                    value="{{ date('Y-m-d') }}">
                                
                                <span class="me-3" style="color: #000000;">Jenis Pembacaan:</span>
                                
                                <!-- Dropdown Jenis Pembacaan -->
                                <select name="jenis_pembacaan" class="kalibrasi-input" style="width: 45%;">
                                    <option value="">-- Pilih --</option>
                                    <option value="manual">Manual</option>
                                    <option value="digital" selected>Digital</option>
                                </select>
                            </div>
                        </td>
                    </tr>

                    <!-- Tempat Kalibrasi -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000; text-align: left;">Tempat Kalibrasi</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex">
                                <div class="form-check me-5">
                                    <input class="form-check-input" type="radio" name="tempat_kalibrasi" value="lab.PT PAS" id="lab" required>
                                    <label class="form-check-label" for="lab" style="color: #000000;">Lab. PT.PAS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tempat_kalibrasi" value="insitu" id="insitu" required>
                                    <label class="form-check-label" for="insitu" style="color: #000000;">Insitu</label>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000; text-align: left;">Lokasi PT</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" name="lokasi_pt" class="kalibrasi-input me-3" placeholder="Masukkan lokasi pt" style="width: 60%;text-align: left;" required>
                            </div>
                        </td>
                    </tr>
                </table>

                <!-- Fungsi Komponen Lainnya & Kondisi Kalibrasi -->
                <div class="row mt-4">
                    <!-- Fungsi Komponen Lainnya -->
                    <div class="col-md-6 mb-4">
                        <div class="kalibrasi-section-header" style="color: #000000;">Fungsi Komponen Lainnya</div>
                        
                        <div class="d-flex justify-content-around align-items-center my-4">
                            <div class="text-center">
                                <span class="fw-bold d-block" style="color: #000000;">Ok</span>
                                <input type="radio" name="fungsi_komponen" value="ok" style="transform: scale(1.5); margin: 10px 0;" required>
                            </div>
                            <div class="text-center">
                                <span class="fw-bold d-block" style="color: #000000;">Rusak</span>
                                <input type="radio" name="fungsi_komponen" value="rusak" style="transform: scale(1.5); margin: 10px 0;" required>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center mt-4">
                            <span class="fw-bold me-3" style="color: #000000;">Keterangan :</span>
                            <div style="flex: 1; border-bottom: 2px solid #000;">
                                <input type="text" name="keterangan_fungsi_komponen" class="kalibrasi-input" placeholder="Masukkan Keterangan" style="border: none;">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Kondisi Kalibrasi -->
                    <div class="col-md-6 mb-4">
                        <div class="kalibrasi-section-header" style="color: #000000;">Kondisi Kalibrasi</div>
                        
                        <table class="table table-bordered">
                            <tr>
                                <td class="table-secondary fw-bold" style="width: 30%; color: #000000;"></td>
                                <td class="table-secondary fw-bold text-center" style="color: #000000;">Awal</td>
                                <td class="table-secondary fw-bold text-center" style="color: #000000;">Tengah</td>
                                <td class="table-secondary fw-bold text-center" style="color: #000000;">Akhir</td>
                            </tr>
                            <tr>
                                <td class="bg-light fw-bold" style="color: #000000;">Suhu (°C)</td>
                                <td><input type="number"
                                        name="suhu_awal" 
                                        class="kondisi-input" 
                                        step="0.1"
                                        oninput="formatInputNumber(this)"
                                        placeholder="0.0"
                                        required></td>
                                <td><input type="number"
                                        name="suhu_tengah" 
                                        class="kondisi-input" 
                                        step="0.1"
                                        oninput="formatInputNumber(this)"
                                        placeholder="0.0"
                                        required></td>
                                <td><input type="number"
                                        name="suhu_akhir" 
                                        class="kondisi-input" 
                                        step="0.1"
                                        oninput="formatInputNumber(this)"
                                        placeholder="0.0"
                                        required></td>
                            </tr>
                            <tr>
                                <td class="bg-light fw-bold" style="color: #000000;">RH (%)</td>
                                <td><input type="number"
                                        name="rh_awal" 
                                        class="kondisi-input" 
                                        step="0.1"
                                        oninput="formatInputNumber(this)"
                                        placeholder="0.0"
                                        required></td>
                                <td><input type="number"
                                        name="rh_tengah" 
                                        class="kondisi-input" 
                                        step="0.1"
                                        oninput="formatInputNumber(this)"
                                        placeholder="0.0"
                                        required></td>
                                <td><input type="number"
                                        name="rh_akhir" 
                                        class="kondisi-input" 
                                        step="0.1"
                                        oninput="formatInputNumber(this)"
                                        placeholder="0.0"
                                        required></td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                
             <style>
/* Container responsif */
.responsive-table-container {
    width: 100%;
    overflow-x: auto;
    margin: 20px 0;
    border: 1px solid #ddd;
    border-radius: 4px;
}

/* Styling tabel */
.setting-suhu-table {
    border-collapse: collapse;
    width: 100%;
    min-width: 600px;
    font-family: Arial, sans-serif;
    font-size: 10pt;
    background: white;
}

.setting-suhu-table td {
    border: 1px solid #000;
    padding: 6px 4px;
    text-align: center;
    vertical-align: middle;
}

.setting-suhu-table .head {
    font-weight: bold;
    background: #f5f5f5;
    position: relative;
    min-width: 50px;
}

/* Styling untuk gambar panah di header */
.arrow-container {
    position: relative;
    display: inline-block;
    margin-left: 5px;
}

.header-arrow {
    vertical-align: middle;
}

/* Kolom keterangan dengan canvas drawing SIMPLE */
.keterangan-cell {
    width: 40%;
    min-width: 250px;
    vertical-align: top;
    padding: 12px;
    background: #f9f9f9;
}

.drawing-container {
    border: 1px solid #000;
    background: white;
    margin-top: 8px;
}




/* Simple tools */
.simple-tools {
    background: #f0f0f0;
    padding: 8px;
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    align-items: center;
}

.tool-btn {
    padding: 4px 12px;
    font-size: 10pt;
    cursor: pointer;
    border: 1px solid #aaa;
    background: white;
    border-radius: 3px;
    min-width: 60px;
}

.tool-btn:hover {
    background: #e9e9e9;
}

.color-btn {
    width: 25px;
    height: 25px;
    border-radius: 50%;
    border: 2px solid #999;
    cursor: pointer;
    display: inline-block;
    margin: 0 2px;
}

.color-btn.active {
    border-color: #000;
    box-shadow: 0 0 3px #000;
}

.size-btn {
    padding: 2px 8px;
    margin: 0 2px;
    border: 1px solid #999;
    cursor: pointer;
    background: white;
}

.size-btn.active {
    background: #333;
    color: white;
}

.hidden-input {
    display: none;
}

/* Input fields */
.setting-suhu-table input {
    width: 90%;
    max-width: 80px;
    text-align: center;
    border: none;
    outline: none;
    background: transparent;
    font-family: Arial, sans-serif;
    font-size: 10pt;
    padding: 4px;
}

/* Row labels */
.row-label {
    font-weight: bold;
    background: #f8f9fa;
    min-width: 50px;
}

/* Responsive design */
@media (max-width: 768px) {
    .canvas-wrapper {
        height: 230px;
    }
}

/* Dual Mode Canvas */
#drawCanvas {
    border: 1px solid #000 !important;
    background: #fff !important;
    cursor: crosshair !important;
    display: block !important;
    width: 100% !important;
    height: 100% !important;
}

/* Mode selector buttons */
#dotModeBtn, #drawModeBtn {
    transition: all 0.3s !important;
}

#dotModeBtn:hover, #drawModeBtn:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2) !important;
}

/* Notification */
.notification {
    position: fixed !important;
    top: 10px !important;
    right: 10px !important;
    background: #333 !important;
    color: white !important;
    padding: 10px 15px !important;
    border-radius: 4px !important;
    z-index: 10000 !important;
    font-size: 12px !important;
    animation: slideIn 0.3s, fadeOut 0.5s 2.5s !important;
}

@keyframes slideIn {
    from { transform: translateX(100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}

@keyframes fadeOut {
    to { opacity: 0; }
}

/* Disabled buttons */
.color-btn[disabled], .size-btn[disabled] {
    opacity: 0.5 !important;
    cursor: not-allowed !important;
}

/* Active mode indicator */
.active-mode {
    border: 3px solid #007bff !important;
    box-shadow: 0 0 10px rgba(0,123,255,0.5) !important;
}
</style>

<div class="responsive-table-container">
<table class="setting-suhu-table">
    <?php
    // Data gambar panah
    $arrow1 = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAgAAAARCAYAAADg1u3YAAAABHNCSVQICAgIfAhkiAAAALRJREFUKJGVkLENwkAMRR+n1Ag6yqxAnyKFe9iAjBB5AZggygZkhNCnoLgBYAOYgGwABXfS5TiB+I31re/vb0MAUfskgon4VdSW3wTjL4cP/C24ANMMorZLZRC1uagdDZCL2irhvgV6A3TALiEogX7m7G5ABSyA2k0/gKUPeQD2QYYtcBqaYjQAQ1N0wBpYhfvjM1u3JgM2XpBFgjsw9/YTB9c4Otr7fvzJ1tVz4uw3RG0d8hcHNC4StBm3LQAAAABJRU5ErkJggg==";
    $arrow2 = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAgAAAAUCAYAAACwG3xrAAAABHNCSVQICAgIfAhkiAAAAJpJREFUKJHtkLENAyEQBEfIhVDCOyekAEJnJnRoUQj6EijhCyCkADtzSAmU4MDnF/gpwSshnfZGqz2gkw0l2VDW3lOMugC3KWBD8UAFqsyHBA+85F0HwIaigQV4Ag/gLN6ecAdSl5bE2wEH9O1V8VA2FAe0HE39bmVuNhSnpNxwe5filZTbJsAGLKccjZ4sydE0QP/+5EF/4KM3EREoIkKvALUAAAAASUVORK5CYII=";
    
    // Header row
    ?>
    <tr>
        <td></td>
        <?php for($i = 1; $i <= 4; $i++):
            $arrow = ($i % 2 == 1) ? $arrow1 : $arrow2;
            $height = ($i % 2 == 1) ? '16' : '20';
        ?>
        <td class="head">
            <?php echo $i; ?>
            <span class="arrow-container">
                <img width='8' height='<?php echo $height; ?>' 
                     src='<?php echo $arrow; ?>' 
                     class='header-arrow' 
                     alt='→' />
            </span>
        </td>
        <?php endfor; ?>
        
        <!-- Kolom keterangan dengan canvas drawing SIMPLE -->
   <!-- HTML ANDA TETAP SAMA - TIDAK PERLU DIUBAH -->
    <td rowspan="11" class="keterangan-cell">
    <strong>Keterangan / Visualisasi:</strong><br>
    <div class="drawing-container">
        <div class="canvas-wrapper">
            <canvas id="drawCanvas" class="drawing-canvas"></canvas>
        </div>
        
        <!-- INPUT HIDDEN UNTUK GAMBAR -->
        <input type="hidden" name="keterangan" id="keterangan">
        
        <!-- DEBUG BUTTONS DENGAN ID -->
        <div style="margin-top: 10px; font-size: 12px;">
            <!-- <div>
                <strong>Status:</strong> 
                <span id="canvasStatus">Siap</span>
            </div>
            <div style="margin-top: 5px;">
                <button type="button" id="testSaveBtn" 
                        style="padding: 4px 8px; background: #6c757d; color: white; border: none; border-radius: 3px; font-size: 11px; margin-right: 5px;">
                    🧪 Test Save Canvas
                </button>
                <button type="button" id="checkInputBtn" 
                        style="padding: 4px 8px; background: #17a2b8; color: white; border: none; border-radius: 3px; font-size: 11px;">
                    🔍 Check Input
                </button>
            </div> -->
        </div>
        
        <div class="simple-tools">
            <!-- Tools dari canvas script -->
        </div>
    </div>
</td>

    </tr>

  
    
    <?php for($row = 1; $row <= 10; $row++): ?>
    <tr>
        <td class="row-label">a<?php echo $row; ?></td>
        <?php for($col = 1; $col <= 4; $col++): ?>
        <td><input type="text" name="a<?php echo $row; ?>_<?php echo $col; ?>"></td>
        <?php endfor; ?>
    </tr>
    <?php endfor; ?>
</table>
</div>


<style>
.repeatability-matrix{
    border-collapse: collapse;
    width: 98%;
    font-family: Arial, sans-serif;
    font-size: 10pt;
    margin: 10px 0;
}

.repeatability-matrix td{
    border:1px solid #000;
    padding:3px;
    text-align:center;
    height:22px;
}

.repeatability-matrix .head{
    font-weight:bold;
    background:#f5f5f5;
}

.repeatability-matrix .rowno{
    width:40px;
    font-weight:bold;
}

.repeatability-matrix input{
    width:95%;
    border:none;
    text-align:center;
    background:transparent;
}

.repeatability-matrix .arrow-img {
    vertical-align: middle;
    margin-left: 2px;
}
</style>

<table class="repeatability-matrix">
    <?php
    // Gambar panah (Base64 encoded)
    $arrow1 = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACsAAAAICAYAAABgZQZYAAAABHNCSVQICAgIfAhkiAAAANpJREFUOI3N1D1KA1EUhuEnMPhXaWGtllbaO+UtLF1CdqDc3i0MZgeTHcR+CovbmwVYZAkREX8aLa7FEGSiAZ18cIoDH4eXy8sd6DkhphnuUTdVedvVHfwLUUdCTLu4wBAnmGDUVOV0sds7bDshpkMZ/AofqDFuqnLGL2FDTFvYaM3mH+77OMIBphgVIaY77Cw5sN1ifsJ7a95W3F/xgsdvOgXOcIwHWYu6wPWy401VPv/8/VdPiOkUl7K/Y5y33V0LZ0NMQxlyDzfyzzBf7PUO+6XhXAacdHU/AV7uUis0PhT9AAAAAElFTkSuQmCC";
    $arrow2 = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAICAYAAACLUr1bAAAABHNCSVQICAgIfAhkiAAAAOFJREFUOI3FlLsJQjEUQE9AtFIsbOzcQO1TKGSAt4HPCZQMEhxBN7A3hWAGcAO11MZCENTGwijhKZEHfg5cws2HnBuSCCIo7RKgB7StkY3Y3G9RyHYo7VrAAEiADTAC+j/2eiC8VCOQEl5qao1c/0vsjlDaLYEmsAZWwA44A6cgPpZbIw95BAvcTmsA1IEtMAMuQCmIom/LQC3Is+Nvc6VdOdj/ECnqaI3sivtMf/eG3B7FGJhYI+d5qs2L0q4SK8gauRAvFlWB1MvugZE1cvJN0RhPgiH+m0mBqjWy8wuhLFdg5k+38TkR6wAAAABJRU5ErkJggg==";
    
    // Data kelompok
    $groups = [
        'A' => ['A1', 'A2', 'A3', 'A4', 'A5', 'A6', 'A7', 'A8', 'A9'],
        'B' => ['A1', 'B2', 'B2', 'B3', 'B4', 'B5', 'B6', 'B7', 'B8'],
        'C' => ['A1', 'C1', 'C2', 'C3', 'C4', 'C5', 'C6', 'C7', 'C8'],
        'D' => ['A1', 'D1', 'D2', 'D3', 'D4', 'D5', 'D6', 'D7', 'D8'],
        'E' => ['A1', 'E1', 'E2', 'E3', 'E4', 'E5', 'E6', 'E7', 'E8'],
        'F' => ['A1', 'F1', 'F2', 'F3', 'F4', 'F5', 'F6', 'F7', 'F8'],
        'G' => ['A1', 'G1', 'G2', 'G3', 'G4', 'G5', 'G6', 'G7', 'G8'],
        'H' => ['A1', 'H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'H7', 'H8'],
        'I' => ['A1', 'I1', 'I2', 'I3', 'I4', 'I5', 'I6', 'I7', 'I8'],
        'J' => ['A1', 'J1', 'J2', 'J3', 'J4', 'J5', 'J6', 'J7', 'J8']
    ];
    
    // Loop untuk setiap kelompok
    foreach($groups as $groupKey => $headers):
        // Header row
    ?>
    <tr>
        <td></td>
        <?php foreach($headers as $header): ?>
        <td class="head"><?php echo $header; ?></td>
        <?php endforeach; ?>
    </tr>
    
    <!-- Row 1 -->
    <tr>
        <td class="rowno">
            1 
            <?php if($groupKey == 'A'): ?>
            <img width='42' height='8' src="<?php echo $arrow1; ?>" class="arrow-img" alt='→' />
            <?php else: ?>
            <img width='42' height='8' src="<?php echo $arrow1; ?>" class="arrow-img" alt='→' />
            <?php endif; ?>
        </td>
        <?php 
        // Input untuk row 1
        for($i=1; $i<=9; $i++): 
            $name = ($groupKey == 'A') ? "a{$i}_1" : strtolower($groupKey)."_{$i}_1";
        ?>
        <td><input name="<?php echo $name; ?>"></td>
        <?php endfor; ?>
    </tr>
    
    <!-- Row 2 -->
    <tr>
        <td class="rowno">
            2
            <?php if($groupKey == 'A'): ?>
            <img width='39' height='8' src="<?php echo $arrow2; ?>" class="arrow-img" alt='→' />
            <?php else: ?>
            <img width='39' height='8' src="<?php echo $arrow2; ?>" class="arrow-img" alt='→' />
            <?php endif; ?>
        </td>
        <?php 
        // Input untuk row 2
        for($i=1; $i<=9; $i++): 
            $name = ($groupKey == 'A') ? "a{$i}_2" : strtolower($groupKey)."_{$i}_2";
        ?>
        <td><input name="<?php echo $name; ?>"></td>
        <?php endfor; ?>
    </tr>
    
    <?php endforeach; ?>
</table>


                <!-- Footer Section -->
                <table style="width: 100%; max-width: 1100px; margin: 20px auto; border-collapse: collapse; background-color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                    <!-- Judul Instruksi -->
                    <tr>
                        <td colspan="12" style="font-weight: bold; font-size: 18px; background-color: #f0f0f0; border: 1px solid #000; padding: 12px; text-align: center;">
                            Isilah lembar data kalibrasi dengan lengkap dan jelas!
                        </td>
                    </tr>

                    <!-- Alat Standar -->
                    <tr>
                        <td rowspan="2" style="font-weight: bold; background-color: #e0e0e0; width:15%; border: 1px solid #000; padding: 12px; text-align: center;">Alat Standar</td>
                        <td rowspan="2" colspan="5" style="border: 1px solid #000; padding: 12px; text-align: center;">
                            PRECISION SPIRIT LEVEL
                        </td>
                         <input type="hidden" name="alat_standar_text" value="PRECISION SPIRIT LEVEL">
                        <td colspan="3" style="font-weight: bold; background-color: #e0e0e0; border: 1px solid #000; padding: 12px; text-align: center;">Dikalibrasi oleh</td>
                        <td colspan="3" style="font-weight: bold; background-color: #e0e0e0; border: 1px solid #000; padding: 12px; text-align: center;">Diperiksa oleh</td>
                    </tr>
                    <tr>
                        <!-- Area TTD + Nama -->
                        <td colspan="3" style="height: 120px; vertical-align: top; text-align: left; padding: 15px 20px 10px; border: 1px solid #000;">
                            TTD:<br><br><br><br>
                        </td>
                        <td colspan="3" style="height: 120px; vertical-align: top; text-align: left; padding: 15px 20px 10px; border: 1px solid #000;">
                            TTD:<br><br><br><br>
                        </td>
                    </tr>

                    <!-- Metode Kalibrasi -->
                    <tr>
                        <td style="font-weight: bold; background-color: #e0e0e0; border: 1px solid #000; padding: 12px; text-align: center;">Metode Kalibrasi</td>
                        <td colspan="5" style="border: 1px solid #000; padding: 12px; text-align: center;">
                            PAS-IK1102-53
                        </td>
                        <td colspan="3" style="border: 1px solid #000; padding: 12px; text-align: center;">
                            Nama: <input type="text" name="calibrated_by" placeholder="Masukkan nama" style="width: 70%; border: none; background: transparent; text-align: center;">
                        </td>
                        <td colspan="3" style="border: 1px solid #000; padding: 12px; text-align: center;">
                            Nama: <input type="text" name="verified_by" placeholder="Masukkan nama" style="width: 70%; border: none; background: transparent; text-align: center;">
                        </td>
                    </tr>
                </table>

                <!-- Submit Button Section -->
                <div class="row mt-5">
                    <div class="col-12 text-center">
                        <button type="submit" id="savebutton" class="btn btn-primary btn-lg" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
                            <i class="fas fa-save me-2"></i>Simpan Data Kalibrasi
                        </button>
                        
                        <button type="reset" class="btn btn-secondary btn-lg ms-3" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
                            <i class="fas fa-redo me-2"></i>Reset Form
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   

</body>
</html>