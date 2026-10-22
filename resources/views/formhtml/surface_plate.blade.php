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
                                <!-- Hidden input untuk form type -->
                                 
                                
                                <select name="nama_alat" id="nama_alat_select" class="kalibrasi-input" onchange="updateFormType(this.value)" required style="background-color: #f5f5f5; color: #333; border: 1px solid #ced4da; padding: 6px 10px; border-radius: 4px; width: 100%;">
                                    <option value="">-- Pilih Alat --</option>
                                    <option value="Meja Rata">Meja Rata</option>
                                    <option value="MANUAL_INPUT">-- Input Manual Nama Alat --</option>
                                </select>
                                
                                <!-- Input Manual - HIDANG AWALNYA -->
                                <div id="manualInputContainer" style="display: none; margin-top: 10px;">
                                    <input type="text" name="nama_alat_manual" id="nama_alat_manual"
                                           placeholder="Ketik nama alat secara manual"
                                           style="background-color: #f5f5f5; color: #333; border: 1px solid #ced4da; padding: 6px 10px; border-radius: 4px; width: 100%;"
                                           oninput="syncNamaAlat()">
                                </div>
                                
                                <!-- Hidden input untuk menyimpan nama alat final -->
                                <input type="hidden" name="nama_alat_final" id="nama_alat_final" value="">
                                
                                <!-- Hidden input untuk display (opsional) -->
                                <input type="hidden" name="nama_alat_display" id="nama_alat_display" value="">
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
                      <tr>
                        <td><p style="margin:0;color:#000">Rentang Ukur</p></td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text"
                                    name="rentang_ukur_min"
                                    class="kalibrasi-input me-3"
                                    value="0"
                                    
                                    style="width:45%;"
                                    placeholder="Masukkan Range Min"
                                    required>

                                <span class="me-3">-</span>

                                <input type="text"
                                    name="rentang_ukur_max"
                                    id="rentang_ukur_max"
                                    class="kalibrasi-input"
                                    
                                    style="width:45%;"
                                    placeholder="Masukkan Range Max"
                                    required
                                    oninput="document.getElementById('kapasitas').value = this.value || ''"
                                    onpaste="setTimeout(() => document.getElementById('kapasitas').value = this.value || '', 10)">
                            </div>
                        </td>
                    </tr> 

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
                                <input type="text" name="lokasi_pt" class="kalibrasi-input me-3" placeholder="Masukkan lokasi pt" style="width: 60%;text-align: left;"  >
                            </div>
                        </td>
                    </tr>
                        <tr>
                        <td>
                            <p style="margin: 0; color: #000000; text-align: left;">Kode TH</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" name="kode_th" class="kalibrasi-input me-3" placeholder="Masukkan Kode TH" style="width: 60%;text-align: left;"  >
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
                                <td><input type="text"
                                        name="suhu_awal" 
                                        class="kondisi-input" 
                                        
                                       
                                        placeholder="0.0"
                                        required></td>
                                <td><input type="text"
                                        name="suhu_tengah" 
                                        class="kondisi-input" 
                                        
                                       
                                        placeholder="0.0"
                                        required></td>
                                <td><input type="text"
                                        name="suhu_akhir" 
                                        class="kondisi-input" 
                                        
                                       
                                        placeholder="0.0"
                                        required></td>
                            </tr>
                            <tr>
                                <td class="bg-light fw-bold" style="color: #000000;">RH (%)</td>
                                <td><input type="text"
                                        name="rh_awal" 
                                        class="kondisi-input" 
                                        
                                       
                                        placeholder="0.0"
                                        required></td>
                                <td><input type="text"
                                        name="rh_tengah" 
                                        class="kondisi-input" 
                                        
                                       
                                        placeholder="0.0"
                                        required></td>
                                <td><input type="text"
                                        name="rh_akhir" 
                                        class="kondisi-input" 
                                        
                                       
                                        placeholder="0.0"
                                        required></td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                
            <style>
.responsive-table-container {
    width: 100%;
    overflow-x: auto;
    margin: 20px 0;
    border: 1px solid #ddd;
    border-radius: 4px;
    -webkit-overflow-scrolling: touch;
}

.setting-suhu-table {
    border-collapse: collapse;
    table-layout: fixed;
    min-width: 650px;
    width: 100%;
    font-family: Arial, sans-serif;
    font-size: 10pt;
    background: white;
}

/* ================================
   CELL — PERKECIL PADDING
   ================================ */
.setting-suhu-table td {
    border: 1px solid #000;
    padding: 0;              /* <-- dari 6px 4px jadi 0 */
    height: 26px;            /* <-- tinggi baris dipatok */
    line-height: 1.2;        /* <-- rapatkan teks */
    text-align: center;
    vertical-align: middle;
}

/* ================================
   LABEL BARIS (a1 - a13)
   ================================ */
.setting-suhu-table .row-label {
    width: 16px;
    min-width: 16px;
    max-width: 16px;
    font-weight: bold;
    background: #f8f9fa;
    padding: 0 1px;
    line-height: 1.1;
    font-size: 9pt;
    text-align: center;
}

/* Cell kosong di header */
.setting-suhu-table tr:first-child td:first-child {
    width: 16px;
    min-width: 16px;
    max-width: 16px;
    padding: 0;
}

/* ================================
   HEADER (1 - 10)
   ================================ */
.setting-suhu-table .head {
    width: 40px;
    min-width: 40px;
    font-weight: bold;
    background: #f5f5f5;
    position: relative;
    padding: 2px 2px;        /* <-- dari 4px 2px */
    height: 28px;
    line-height: 1.1;
}

.arrow-container {
    position: relative;
    display: inline-block;
    margin-left: 3px;
}

.header-arrow {
    vertical-align: middle;
}

/* ================================
   KOLOM KETERANGAN
   ================================ */
.keterangan-cell {
    width: 320px;
    min-width: 320px;
    vertical-align: top;
    padding: 8px;
    background: #f9f9f9;
    text-align: left;
    height: auto;            /* <-- penting: jangan dipatok */
}

.drawing-container {
    border: 1px solid #000;
    background: white;
    margin-top: 8px;
}

.canvas-wrapper {
    width: 100%;
    height: 320px;
    overflow: hidden;
    background: #fff;
}

/* ================================
   INPUT — PERKECIL BIAR RAMPING
   ================================ */
.setting-suhu-table input {
    width: 100%;
    max-width: 100%;
    height: 100%;            /* <-- isi penuh cell */
    text-align: center;
    border: none;
    outline: none;
    background: transparent;
    font-family: Arial, sans-serif;
    font-size: 10pt;
    padding: 2px 2px;        /* <-- dari 4px 2px */
    box-sizing: border-box;
    line-height: 1.2;
}

.setting-suhu-table input:focus {
    background-color: #fff8e1;
    border-radius: 2px;
}

/* ================================
   TOOLS
   ================================ */
.simple-tools {
    background: #f0f0f0;
    padding: 6px;
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    align-items: center;
}

.tool-btn {
    padding: 3px 10px;
    font-size: 9pt;
    cursor: pointer;
    border: 1px solid #aaa;
    background: white;
    border-radius: 3px;
}

.tool-btn:hover {
    background: #e9e9e9;
}

.color-btn {
    width: 22px;
    height: 22px;
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
    padding: 2px 6px;
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

#drawCanvas {
    border: 1px solid #000 !important;
    background: #fff !important;
    cursor: crosshair !important;
    display: block !important;
    width: 100% !important;
    height: 100% !important;
    touch-action: none;
}

/* ================================
   RESPONSIVE
   ================================ */
@media (max-width: 768px) {
    .canvas-wrapper {
        height: 230px;
    }
    .keterangan-cell {
        width: 260px;
        min-width: 260px;
    }
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
        <?php for($i = 1; $i <= 10; $i++):
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
    <td rowspan="14" class="keterangan-cell">
    <strong>Keterangan / Visualisasi:</strong><br>
    <div class="drawing-container">
        <div class="canvas-wrapper">
            <canvas id="drawCanvas" class="drawing-canvas"></canvas>
        </div>
        
        <!-- INPUT HIDDEN UNTUK GAMBAR -->
        <input type="hidden" name="keterangan" id="keterangan" class="keterangan-canvas-hidden">
        <input type="hidden" name="keterangan_gambar" id="keteranganGambar">
        
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

  
    
    <?php for($row = 1; $row <= 13; $row++): ?>
    <tr>
        <td class="row-label">a<?php echo $row; ?></td>
        <?php for($col = 1; $col <= 10; $col++): ?>
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
    // Gambar panah (Base64 encoded) - sama seperti sebelumnya
    $arrow1 = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACsAAAAICAYAAABgZQZYAAAABHNCSVQICAgIfAhkiAAAANpJREFUOI3N1D1KA1EUhuEnMPhXaWGtllbaO+UtLF1CdqDc3i0MZgeTHcR+CovbmwVYZAkREX8aLa7FEGSiAZ18cIoDH4eXy8sd6DkhphnuUTdVedvVHfwLUUdCTLu4wBAnmGDUVOV0sds7bDshpkMZ/AofqDFuqnLGL2FDTFvYaM3mH+77OMIBphgVIaY77Cw5sN1ifsJ7a95W3F/xgsdvOgXOcIwHWYu6wPWy401VPv/8/VdPiOkUl7K/Y5y33V0LZ0NMQxlyDzfyzzBf7PUO+6XhXAacdHU/AV7uUis0PhT9AAAAAElFTkSuQmCC";
    $arrow2 = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAICAYAAACLUr1bAAAABHNCSVQICAgIfAhkiAAAAOFJREFUOI3FlLsJQjEUQE9AtFIsbOzcQO1TKGSAt4HPCZQMEhxBN7A3hWAGcAO11MZCENTGwijhKZEHfg5cws2HnBuSCCIo7RKgB7StkY3Y3G9RyHYo7VrAAEiADTAC+j/2eiC8VCOQEl5qao1c/0vsjlDaLYEmsAZWwA44A6cgPpZbIw95BAvcTmsA1IEtMAMuQCmIom/LQC3Is+Nvc6VdOdj/ECnqaI3sivtMf/eG3B7FGJhYI+d5qs2L0q4SK8gauRAvFlWB1MvugZE1cvJN0RhPgiH+m0mBqjWy8wuhLFdg5k+38TkR6wAAAABJRU5ErkJggg==";
    
    // Data kelompok (TETAP SAMA SEPERTI ASLI)
    $groups = [
        'A' => ['A1', 'A2', 'A3', 'A4', 'A5', 'A6', 'A7', 'A8', 'A9','A10'],
        'B' => ['A1', 'B1', 'B2', 'B3', 'B4', 'B5', 'B6', 'B7', 'B8','B9','B10'],
        'C' => ['A1', 'C1', 'C2', 'C3', 'C4', 'C5', 'C6', 'C7', 'C8','C9','C10'],
        'D' => ['A1', 'D1', 'D2', 'D3', 'D4', 'D5', 'D6', 'D7', 'D8','D9','D10'],
        'E' => ['A1', 'E1', 'E2', 'E3', 'E4', 'E5', 'E6', 'E7', 'E8','E9','E10'],
        'F' => ['A1', 'F1', 'F2', 'F3', 'F4', 'F5', 'F6', 'F7', 'F8','F9','F10'],
        'G' => ['A1', 'G1', 'G2', 'G3', 'G4', 'G5', 'G6', 'G7', 'G8','G9','G10'],
        'H' => ['A1', 'H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'H7', 'H8','H9','H10'],
        'I' => ['A1', 'I1', 'I2', 'I3', 'I4', 'I5', 'I6', 'I7', 'I8','I9','I10'],
        'J' => ['A1', 'J1', 'J2', 'J3', 'J4', 'J5', 'J6', 'J7', 'J8','J9','J10'],
        'K' => ['A1', 'K1', 'K2', 'K3', 'K4', 'K5', 'K6', 'K7', 'K8','K9','K10'],
        'L' => ['A1', 'L1', 'L2', 'L3', 'L4', 'L5', 'L6', 'L7', 'L8','L9','L10'],
    ];
    
    // Loop untuk setiap kelompok
    foreach($groups as $groupKey => $headers):
        $groupLower = strtolower($groupKey);
        // Hitung jumlah kolom dari header (untuk menentukan maxCol)
        $maxCol = count($headers);
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
            <img width='42' height='8' src="<?php echo $arrow1; ?>" class="arrow-img" alt='→' />
        </td>
        <?php 
        // Input untuk row 1 - loop sesuai jumlah kolom
        for($i=1; $i<=$maxCol; $i++): 
            if ($groupKey == 'A') {
                $name = "repeat_a{$i}_1";
            } else {
                $name = "{$groupLower}_row1_col{$i}";
            }
        ?>
        <td><input name="<?php echo $name; ?>"></td>
        <?php endfor; ?>
    </tr>
    
    <!-- Row 2 -->
    <tr>
        <td class="rowno">
            2
            <img width='39' height='8' src="<?php echo $arrow2; ?>" class="arrow-img" alt='→' />
        </td>
        <?php 
        // Input untuk row 2 - loop sesuai jumlah kolom
        for($i=1; $i<=$maxCol; $i++): 
            if ($groupKey == 'A') {
                $name = "repeat_a{$i}_2";
            } else {
                $name = "{$groupLower}_row2_col{$i}";
            }
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
                            Nama: <input type="text" name="calibrated_by" placeholder="Masukkan nama" style="width: 70%; border: none; background: transparent; text-align: center;"   value="{{ auth()->user()->nama ?? 'System' }}"  readonly>
                        </td>
                        <td colspan="3" style="border: 1px solid #000; padding: 12px; text-align: center;">
                            Nama: <input type="text" name="verified_by" placeholder="Masukkan nama" style="width: 70%; border: none; background: transparent; text-align: center;" readonly> 
                        </td>
                    </tr>
                </table>
                   <!-- Submit Button Section -->
                  <!-- Submit Button Section -->
                  <div class="row mt-5">
                    <div class="col-12 text-center">
                        <button type="button" id="btnSimpanSemua" class="btn btn-primary btn-lg" onclick="submitSemuaForm()" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
                            <i class="fas fa-save me-2"></i>Simpan Data Kalibrasi
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    

 <script>
// ==========================================
// STORAGE PER TAB - GLOBAL
// ==========================================
if (typeof window.tempFormDataStore === 'undefined') {
    window.tempFormDataStore = {};
}
if (typeof window.isRestoring === 'undefined') {
    window.isRestoring = false;
}
if (typeof window.tabSubmitStatus === 'undefined') {
    window.tabSubmitStatus = {};
}

var tempFormDataStore = window.tempFormDataStore;
var isRestoring = window.isRestoring;
var tabSubmitStatus = window.tabSubmitStatus;

var currentActiveTabId = '1';

// ==========================================
// FUNGSI GET TAB AKTIF
// ==========================================
function getActiveTabId() {
    const activePane = document.querySelector('.tab-pane.active');
    if (activePane && activePane.id && activePane.id.startsWith('lk-pane-')) {
        const tabId = activePane.id.replace('lk-pane-', '');
        currentActiveTabId = tabId;
        return tabId;
    }

    const activeTabButton = document.querySelector('.nav-link.active');
    if (activeTabButton && activeTabButton.id && activeTabButton.id.startsWith('lk-tab-')) {
        const tabId = activeTabButton.id.replace('lk-tab-', '');
        currentActiveTabId = tabId;
        return tabId;
    }

    const containers = document.querySelectorAll('.lk-form-container');
    for (let i = 0; i < containers.length; i++) {
        const style = window.getComputedStyle(containers[i]);
        if (style.display !== 'none') {
            const tabId = containers[i].getAttribute('data-lk-id');
            if (tabId) return tabId;
        }
    }

    return currentActiveTabId;
}

function updateActiveTab(tabId) {
    currentActiveTabId = tabId;
    console.log(`🔄 Global active tab updated to: ${tabId}`);
}

// ==========================================
// FUNGSI UNTUK MENONAKTIFKAN REQUIRED PADA FORM YANG TIDAK VISIBLE
// ==========================================
function disableRequiredOnHiddenForms() {
    console.log('🔧 disableRequiredOnHiddenForms called');

    const allForms = document.querySelectorAll('form[id^="kalibrasiForm"]');

    allForms.forEach((form, index) => {
        const formIndex = index + 1;
        const container = form.closest('.lk-form-container');
        const isVisible = container && window.getComputedStyle(container).display !== 'none';

        console.log(`📌 Form ${formIndex}: isVisible=${isVisible}`);

        const requiredInputs = form.querySelectorAll('[required]');

        if (!isVisible) {
            requiredInputs.forEach(input => {
                input.removeAttribute('required');
                input.setAttribute('data-required-temp', 'true');
            });
        } else {
            requiredInputs.forEach(input => {
                if (input.hasAttribute('data-required-temp')) {
                    input.setAttribute('required', 'required');
                    input.removeAttribute('data-required-temp');
                }
            });
        }
    });
}

function restoreRequiredOnAllForms() {
    const allForms = document.querySelectorAll('form[id^="kalibrasiForm"]');
    allForms.forEach(form => {
        form.querySelectorAll('[data-required-temp]').forEach(input => {
            input.setAttribute('required', 'required');
            input.removeAttribute('data-required-temp');
        });
    });
}

// ==========================================
// UPDATE FORM TYPE
// ==========================================
function updateFormType(selectedAlat) {
    const manualInputContainer = document.getElementById('manualInputContainer');
    const manualInput = document.getElementById('nama_alat_manual');
    const finalInput = document.getElementById('nama_alat_final');

    if (!manualInputContainer || !manualInput) return;

    if (selectedAlat === 'MANUAL_INPUT') {
        manualInputContainer.style.display = 'block';
        manualInput.required = true;
        if (finalInput) finalInput.value = '';
    } else {
        manualInputContainer.style.display = 'none';
        manualInput.required = false;
        manualInput.value = '';
        if (finalInput && selectedAlat) finalInput.value = selectedAlat;
    }
}

function syncNamaAlat() {
    const manualInput = document.getElementById('nama_alat_manual');
    const finalInput = document.getElementById('nama_alat_final');
    if (manualInput && finalInput) {
        finalInput.value = manualInput.value;
    }
}

function formatNumberInput(input) {
    if (!input) return;
    let value = input.value;
    if (value === '' || value === null) return;
    value = value.toString().replace(/,/g, '');
    if (!isNaN(value) && value !== '') {
        let num = parseFloat(value);
        if (!isNaN(num)) input.value = num.toString();
    }
}

function escapeHtml(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// ==========================================
// 🔥 CANVAS DRAWING — INIT + SAVE (FIXED MOBILE)
// ==========================================
let canvasEl = null;
let ctxEl = null;
let drawing = false;
let lastX = 0, lastY = 0;
let currentColor = '#000000';
let currentSize = 2;

// 🔥 Init canvas — SEKALI SAJA
function initDrawingCanvas() {
    if (window.__canvasInitialized) {
        console.log('⏭️ Canvas already initialized, skip');
        return;
    }

    canvasEl = document.querySelector('#kalibrasiForm canvas#drawCanvas')
              || document.querySelector('canvas#drawCanvas');

    if (!canvasEl) {
        console.warn('⚠️ Canvas #drawCanvas tidak ada');
        return;
    }

    ctxEl = canvasEl.getContext('2d');

    // Set ukuran canvas (pakai devicePixelRatio untuk ketajaman di mobile)
    const wrapper = canvasEl.parentElement;
    const rect = wrapper.getBoundingClientRect();
    const targetWidth = Math.max(Math.floor(rect.width) || 559, 300);
    const targetHeight = Math.max(Math.floor(rect.height) || 280, 200);

    canvasEl.width = targetWidth;
    canvasEl.height = targetHeight;
    canvasEl.style.width = targetWidth + 'px';
    canvasEl.style.height = targetHeight + 'px';

    // Background putih
    ctxEl.fillStyle = '#ffffff';
    ctxEl.fillRect(0, 0, canvasEl.width, canvasEl.height);

    // Style default
    ctxEl.lineCap = 'round';
    ctxEl.lineJoin = 'round';
    ctxEl.strokeStyle = currentColor;
    ctxEl.lineWidth = currentSize;

    // ============================================
    // 🖱️ MOUSE EVENTS (Desktop)
    // ============================================
    canvasEl.addEventListener('mousedown', startDraw);
    canvasEl.addEventListener('mousemove', drawLine);
    canvasEl.addEventListener('mouseup', stopDraw);
    canvasEl.addEventListener('mouseleave', stopDraw);

    // ============================================
    // 📱 TOUCH EVENTS (Mobile) — INI YANG DIPERBAIKI
    // ============================================
    // Gunakan pointer events jika tersedia (lebih reliable)
    if (window.PointerEvent) {
        canvasEl.addEventListener('pointerdown', handlePointerDown);
        canvasEl.addEventListener('pointermove', handlePointerMove);
        canvasEl.addEventListener('pointerup', stopDraw);
        canvasEl.addEventListener('pointercancel', stopDraw);
        canvasEl.addEventListener('pointerleave', stopDraw);
    } else {
        // Fallback touch events
        canvasEl.addEventListener('touchstart', handleTouchStart, { passive: false });
        canvasEl.addEventListener('touchmove', handleTouchMove, { passive: false });
        canvasEl.addEventListener('touchend', handleTouchEnd, { passive: false });
        canvasEl.addEventListener('touchcancel', handleTouchEnd, { passive: false });
    }

    window.__canvasInitialized = true;
    console.log('✅ Canvas initialized:', canvasEl.width, 'x', canvasEl.height);

    renderCanvasTools();
}

// ============================================
// HELPER: ambil posisi dari event (mouse/touch/pointer)
// ============================================
function getCanvasPosFromClient(clientX, clientY) {
    const rect = canvasEl.getBoundingClientRect();
    return {
        x: (clientX - rect.left) * (canvasEl.width / rect.width),
        y: (clientY - rect.top) * (canvasEl.height / rect.height)
    };
}

// ============================================
// MOUSE
// ============================================
function startDraw(e) {
    drawing = true;
    const pos = getCanvasPosFromClient(e.clientX, e.clientY);
    lastX = pos.x;
    lastY = pos.y;

    // 🔥 Langsung gambar titik awal (biar tap saja = titik)
    ctxEl.beginPath();
    ctxEl.arc(pos.x, pos.y, currentSize / 2, 0, Math.PI * 2);
    ctxEl.fillStyle = currentColor;
    ctxEl.fill();
    ctxEl.beginPath();
    ctxEl.moveTo(pos.x, pos.y);
    e.preventDefault();
}

function drawLine(e) {
    if (!drawing) return;
    const pos = getCanvasPosFromClient(e.clientX, e.clientY);

    ctxEl.beginPath();
    ctxEl.moveTo(lastX, lastY);
    ctxEl.lineTo(pos.x, pos.y);
    ctxEl.strokeStyle = currentColor;
    ctxEl.lineWidth = currentSize;
    ctxEl.lineCap = 'round';
    ctxEl.lineJoin = 'round';
    ctxEl.stroke();

    lastX = pos.x;
    lastY = pos.y;
    e.preventDefault();
}

function stopDraw() {
    drawing = false;
}

// ============================================
// POINTER (paling bagus untuk mobile modern)
// ============================================
function handlePointerDown(e) {
    // Hanya respon mouse/touch/pen — skip jika bukan primary
    if (e.button !== undefined && e.button !== 0 && e.pointerType === 'mouse') return;
    e.preventDefault();
    canvasEl.setPointerCapture(e.pointerId);
    drawing = true;
    const pos = getCanvasPosFromClient(e.clientX, e.clientY);
    lastX = pos.x;
    lastY = pos.y;

    // Titik awal
    ctxEl.beginPath();
    ctxEl.arc(pos.x, pos.y, currentSize / 2, 0, Math.PI * 2);
    ctxEl.fillStyle = currentColor;
    ctxEl.fill();
    ctxEl.beginPath();
    ctxEl.moveTo(pos.x, pos.y);
}

function handlePointerMove(e) {
    if (!drawing) return;
    e.preventDefault();
    const pos = getCanvasPosFromClient(e.clientX, e.clientY);

    ctxEl.beginPath();
    ctxEl.moveTo(lastX, lastY);
    ctxEl.lineTo(pos.x, pos.y);
    ctxEl.strokeStyle = currentColor;
    ctxEl.lineWidth = currentSize;
    ctxEl.lineCap = 'round';
    ctxEl.lineJoin = 'round';
    ctxEl.stroke();

    lastX = pos.x;
    lastY = pos.y;
}

// ============================================
// TOUCH FALLBACK (untuk browser lama)
// ============================================
function handleTouchStart(e) {
    e.preventDefault(); // penting: cegah scroll & double-tap zoom
    const t = e.touches[0];
    const pos = getCanvasPosFromClient(t.clientX, t.clientY);
    lastX = pos.x;
    lastY = pos.y;
    drawing = true;

    // Titik awal
    ctxEl.beginPath();
    ctxEl.arc(pos.x, pos.y, currentSize / 2, 0, Math.PI * 2);
    ctxEl.fillStyle = currentColor;
    ctxEl.fill();
    ctxEl.beginPath();
    ctxEl.moveTo(pos.x, pos.y);
}

function handleTouchMove(e) {
    e.preventDefault();
    if (!drawing) return;
    const t = e.touches[0];
    const pos = getCanvasPosFromClient(t.clientX, t.clientY);

    ctxEl.beginPath();
    ctxEl.moveTo(lastX, lastY);
    ctxEl.lineTo(pos.x, pos.y);
    ctxEl.strokeStyle = currentColor;
    ctxEl.lineWidth = currentSize;
    ctxEl.lineCap = 'round';
    ctxEl.lineJoin = 'round';
    ctxEl.stroke();

    lastX = pos.x;
    lastY = pos.y;
}

function handleTouchEnd(e) {
    if (e) e.preventDefault();
    drawing = false;
}

// ============================================
// TOOLS: warna, ukuran, clear, save
// ============================================
function setCanvasColor(color) {
    currentColor = color;
    if (ctxEl) ctxEl.strokeStyle = color;
    document.querySelectorAll('.color-btn').forEach(b => b.classList.remove('active'));
    const active = document.querySelector(`.color-btn[data-color="${color}"]`);
    if (active) active.classList.add('active');
}

function setCanvasSize(size) {
    currentSize = size;
    if (ctxEl) ctxEl.lineWidth = size;
    document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));
    const active = document.querySelector(`.size-btn[data-size="${size}"]`);
    if (active) active.classList.add('active');
}

function clearCanvas() {
    if (!canvasEl || !ctxEl) return;
    if (!confirm('Hapus semua gambar?')) return;
    ctxEl.fillStyle = '#ffffff';
    ctxEl.fillRect(0, 0, canvasEl.width, canvasEl.height);
    console.log('🗑️ Canvas cleared');
}

function renderCanvasTools() {
    const container = document.querySelector('.simple-tools');
    if (!container) return;

    container.innerHTML = `
        <span style="font-size:11px;color:#333;">Tools:</span>
        <button type="button" onclick="setCanvasColor('#000000')"
                style="padding:3px 8px;background:#000;color:#fff;border:none;border-radius:3px;cursor:pointer;font-size:11px;">Hitam</button>
        <button type="button" onclick="setCanvasColor('#dc3545')"
                style="padding:3px 8px;background:#dc3545;color:#fff;border:none;border-radius:3px;cursor:pointer;font-size:11px;">Merah</button>
        <button type="button" onclick="setCanvasColor('#007bff')"
                style="padding:3px 8px;background:#007bff;color:#fff;border:none;border-radius:3px;cursor:pointer;font-size:11px;">Biru</button>
        <button type="button" onclick="clearCanvas()"
                style="padding:3px 8px;background:#6c757d;color:#fff;border:none;border-radius:3px;cursor:pointer;font-size:11px;">🗑️ Hapus</button>
        <button type="button" onclick="testSaveCanvas()"
                style="padding:3px 8px;background:#198754;color:#fff;border:none;border-radius:3px;cursor:pointer;font-size:11px;">💾 Test Save</button>
    `;
}

// Fungsi debug untuk test save
function testSaveCanvas() {
    const result = saveCanvasToHidden();
    const hidden = document.querySelector('#kalibrasiForm input[name="keterangan"]')
                 || document.querySelector('input[name="keterangan"]');
    const len = hidden ? hidden.value.length : 0;
    alert('Save result: ' + result + '\nHidden length: ' + len);
}

// ==========================================
// 🔥 SAVE CANVAS KE HIDDEN INPUT — FINAL
// ==========================================
function saveCanvasToHidden() {
    // PRIORITAS: cari di dalam form #kalibrasiForm dulu
    const form = document.querySelector('#kalibrasiForm');

    let canvas = null;
    let hiddenInput = null;

    if (form) {
        canvas = form.querySelector('canvas#drawCanvas');
        hiddenInput = form.querySelector('input[name="keterangan"]');
    }

    // Fallback global
    if (!canvas) {
        canvas = document.querySelector('canvas#drawCanvas');
    }
    if (!hiddenInput) {
        hiddenInput = document.querySelector('input[name="keterangan"]');
    }

    console.log('🔍 saveCanvasToHidden scope:', {
        formFound: !!form,
        canvasFound: !!canvas,
        hiddenFound: !!hiddenInput,
    });

    if (!canvas) {
        console.warn('⚠️ Canvas #drawCanvas tidak ditemukan');
        return false;
    }
    if (!hiddenInput) {
        console.warn('⚠️ Hidden input #keterangan tidak ditemukan');
        return false;
    }

    try {
        const dataURL = canvas.toDataURL('image/png');
        hiddenInput.value = dataURL;

        console.log('✅ Canvas saved. DataURL length:', dataURL.length);
        console.log('✅ Hidden value length:', hiddenInput.value.length);

        if (dataURL.length < 500) {
            console.warn('⚠️ WARNING: DataURL sangat pendek — canvas mungkin kosong!');
        }

        return true;
    } catch (e) {
        console.error('❌ Error saving canvas:', e);
        return false;
    }
}

// ==========================================
// HANDLE SAVE SUCCESS
// ==========================================
window.handleSaveSuccess = function(tabId, data) {
    console.log('🎉 handleSaveSuccess called for tab:', tabId, data);

    const container = document.querySelector(`.lk-form-container[data-lk-id="${tabId}"]`);
    if (!container) {
        console.error(`Container for tab ${tabId} not found!`);
        return;
    }

    const tabButton = document.getElementById(`lk-tab-${tabId}`);
    if (tabButton) {
        tabButton.classList.add('tab-saved');
        const badge = tabButton.querySelector('.badge');
        if (badge) {
            badge.className = 'badge badge-success ml-1';
            badge.innerHTML = '<i class="fas fa-check mr-1"></i>Tersimpan';
        }
    }

    const formName = container.getAttribute('data-form-name') || 'surface_plate';
    const calibrationId = data.calibration_id || data.id || '-';
    const printLabelUrl = data.print_label_url || `/calibrations/${calibrationId}/print-label`;

    tabSubmitStatus[tabId] = {
        success: true,
        calibrationId: calibrationId,
        printLabelUrl: printLabelUrl,
        formName: formName,
        timestamp: Date.now()
    };

    container.innerHTML = `
      <div class="save-success-overlay text-center p-5 fade-in" style="background: white; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.08);">
       <div class="mb-4">
                    <i class="fas fa-check-circle text-success fa-5x"></i>
                </div>
                <h3 class="text-success mb-2">Simpan Berhasil!</h3>
                <p class="mb-3" style="color: black;">Data kalibrasi untuk <strong>${escapeHtml(formName)}</strong> telah berhasil disimpan ke database.</p>

                <div class="d-inline-block mb-4 p-3" style="border-radius: 12px; text-align: left; background: white; border: 1px solid #ddd;">
                    <i class="fas fa-info-circle mr-2" style="color: #0d6efd;"></i>
                    <strong style="color: black;">ID Kalibrasi:</strong> <code style="background: #f5f5f5; color: black; font-weight: bold;">${escapeHtml(calibrationId)}</code>
                    <br>
                    <small style="color: black;">Status: <span class="badge bg-success">Draft</span></small>
                </div>

        <div class="d-flex justify-content-center gap-3 flex-wrap mb-4">
            <button type="button" class="btn btn-primary btn-lg px-4 py-2"
                    onclick="window.open('${printLabelUrl}', '_blank')">
                <i class="fas fa-print me-2"></i> Cetak Label
            </button>

            <button type="button" class="btn btn-success btn-lg px-4 py-2"
                    onclick="resetTabForNewScan(${tabId})">
                <i class="fas fa-plus-circle me-2"></i> Input Lagi
            </button>

            <button type="button" class="btn btn-danger btn-lg px-4 py-2"
                    onclick="removeTab(${tabId})">
                <i class="fas fa-times me-2"></i> Tutup Tab
            </button>
        </div>

        <div class="mt-3 text-muted small">
            <i class="fas fa-info-circle me-1"></i> Data tersimpan sebagai Draft.
            Klik <strong>Cetak Label</strong> untuk mencetak, atau <strong>Input Lagi</strong> untuk melanjutkan kalibrasi berikutnya.
        </div>
    </div>
    `;

    const finishContainer = document.getElementById('finish-action-container');
    if (finishContainer) finishContainer.classList.remove('d-none');

    if (typeof Swal !== 'undefined') {
        Swal.fire({
            icon: 'success',
            title: '✓ Data Tersimpan!',
            html: `<strong>${escapeHtml(formName)}</strong><br>ID: ${calibrationId}`,
            timer: 2000,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    }
};

window.resetTabForNewScan = function(tabId) {
    if (confirm('Data yang belum disimpan akan hilang. Lanjutkan?')) {
        delete tabSubmitStatus[tabId];
        location.reload();
    }
};

window.removeTab = function(tabId) {
    if (tabId == 1) {
        alert('Tab utama tidak bisa ditutup!');
        return;
    }
    if (confirm(`Apakah Anda yakin ingin menutup Form ${tabId}?`)) {
        delete tabSubmitStatus[tabId];
        delete tempFormDataStore[tabId];
        const container = document.querySelector(`.lk-form-container[data-lk-id="${tabId}"]`);
        if (container) container.remove();
        const tabBtn = document.getElementById(`lk-tab-${tabId}`);
        if (tabBtn) tabBtn.remove();
        const firstContainer = document.querySelector('.lk-form-container[data-lk-id="1"]');
        if (firstContainer) firstContainer.style.display = 'block';
        updateActiveTab('1');
    }
};

// ==========================================
// SUBMIT surface_plate - SINGLE FORM PER TAB
// ==========================================
async function submitSemuaForm() {
    const activeTabId = getActiveTabId();
    console.log('📌 Submitting from active tab:', activeTabId);

    // ============================================================
    // STEP 1: CARI FORM
    // ============================================================
    let form = null;
    const activeContainer = document.querySelector(`.lk-form-container[data-lk-id="${activeTabId}"]`);

    if (activeContainer) {
        form = activeContainer.querySelector('#kalibrasiForm')
            || activeContainer.querySelector('form[id^="kalibrasiForm"]')
            || activeContainer.querySelector('form');
    }
    if (!form) {
        form = document.querySelector('#kalibrasiForm')
            || document.querySelector('form#kalibrasiForm')
            || document.querySelector('form[id^="kalibrasiForm"]');
    }
    if (!form) {
        alert('Form tidak ditemukan!');
        return;
    }
    console.log('✅ Form ditemukan:', form.id);

        // ============================================================
    // STEP 2: SAVE CANVAS KE HIDDEN INPUT
    // Pakai fungsi dari canvas-surface-plate.js (window.saveCanvasToHidden)
    // ============================================================
    try {
        // 🔥 PRIORITAS 1: Panggil fungsi global dari canvas-surface-plate.js
        if (typeof window.saveCanvasToHidden === 'function') {
            const saved = window.saveCanvasToHidden();
            console.log('🎨 window.saveCanvasToHidden() →', saved);
        } else {
            console.warn('⚠️ window.saveCanvasToHidden tidak ada, pakai fallback');
        }

        // 🔥 VERIFIKASI: cek hidden input terisi atau belum
        const hiddenCheck = form.querySelector('input[name="keterangan"]')
            || document.querySelector('#keteranganGambar')
            || document.querySelector('input[name="keterangan"]');

        const len = hiddenCheck ? hiddenCheck.value.length : 0;
        console.log('🔍 Hidden value length setelah save:', len);

        // 🔥 FALLBACK: kalau masih kosong, pakai cara manual
        if (!hiddenCheck || len < 100) {
            console.warn('⚠️ Hidden masih kosong, pakai fallback manual');

            const canvasEl = form.querySelector('canvas#drawCanvas')
                || form.querySelector('canvas')
                || document.querySelector('#drawCanvas');

            if (canvasEl && hiddenCheck) {
                const dataURL = canvasEl.toDataURL('image/png');
                hiddenCheck.value = dataURL;
                console.log('✅ Fallback manual save. Length:', dataURL.length);
            }
        }
    } catch (e) {
        console.error('❌ Error save canvas:', e);
    }

    // ============================================================
    // STEP 3: VALIDASI
    // ============================================================
    form.setAttribute('novalidate', 'novalidate');
    form.noValidate = true;

    const alatStandar = form.querySelectorAll('input[name="alat_standar_text"]');
    if (alatStandar.length === 0) {
        alert('Pilih minimal 1 alat standar!');
        return;
    }

    const btn = document.getElementById('btnSimpanSemua');
    if (!btn) {
        alert('Tombol simpan tidak ditemukan!');
        return;
    }

    const originalText = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan Data...';

    // ============================================================
    // STEP 4: BUAT FORMDATA & SUBMIT
    // ============================================================
    try {
        const formData = new FormData(form);

        const keteranganVal = formData.get('keterangan');
        console.log('🔍 FormData keterangan length:', keteranganVal ? keteranganVal.length : 0);

        if (!keteranganVal || keteranganVal.length < 100) {
            console.warn('⚠️ WARNING: keterangan kosong / terlalu pendek!');
        }

        formData.append('form_type', 'surface_plate');
        formData.append('rentang_ukur_min', '0');
        formData.append('rentang_ukur_max', '0');

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content
            || document.querySelector('input[name="_token"]')?.value;
        if (csrfToken) {
            formData.append('_token', csrfToken);
        }

        console.log('📤 Mengirim data dari tab:', activeTabId);

        const response = await fetch('/calibrations', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        });

        const contentType = response.headers.get('content-type');

        let result;
        if (contentType && contentType.includes('application/json')) {
            result = await response.json();
        } else {
            const text = await response.text();
            console.error('Non-JSON response:', text.substring(0, 500));
            throw new Error('Server mengembalikan response yang tidak valid');
        }

        if (!response.ok) {
            throw new Error(result.error || `Gagal menyimpan data: ${response.status}`);
        }

        let formName = 'surface_plate';
        const selectNamaAlat = form.querySelector('select[name="nama_alat"]');
        if (selectNamaAlat && selectNamaAlat.value && selectNamaAlat.value !== 'MANUAL_INPUT') {
            formName = selectNamaAlat.value;
        } else {
            const manualNamaAlat = form.querySelector('input[name="nama_alat_manual"]');
            if (manualNamaAlat && manualNamaAlat.value) {
                formName = manualNamaAlat.value;
            }
        }

        if (activeContainer) {
            activeContainer.setAttribute('data-form-name', formName);
        }

        console.log('📌 Saving success for tab:', activeTabId);

        if (typeof window.handleSaveSuccess === 'function') {
            window.handleSaveSuccess(activeTabId, result);
        } else {
            alert('Data berhasil disimpan!');
        }

    } catch (err) {
        console.error('Submit error:', err);
        alert('Error: ' + err.message);
    } finally {
        btn.disabled = false;
        btn.innerHTML = originalText;
    }
}

// ==========================================
// SETUP TAB SWITCHING
// ==========================================
function setupTabSwitching() {
    if (typeof $ === 'undefined') return;

    $(document).on('shown.bs.tab', 'button[data-toggle="tab"]', function (e) {
        const targetId = $(e.target).attr('id');
        if (targetId && targetId.startsWith('lk-tab-')) {
            const tabId = targetId.replace('lk-tab-', '');
            console.log('🎯 Tab switched to:', tabId);
            updateActiveTab(tabId);

            document.querySelectorAll('.lk-form-container').forEach(container => {
                container.style.display = 'none';
            });

            const targetContainer = document.querySelector(`.lk-form-container[data-lk-id="${tabId}"]`);
            if (targetContainer) {
                targetContainer.style.display = 'block';
            }
        }
    });

    const activeButton = document.querySelector('.nav-link.active');
    if (activeButton && activeButton.id) {
        const tabId = activeButton.id.replace('lk-tab-', '');
        updateActiveTab(tabId);
    }
}

// ==========================================
// INISIALISASI
// ==========================================
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 DOM Content Loaded - Initializing surface_plate...');

    setupTabSwitching();

    // INIT CANVAS — sekali saja
    setTimeout(() => {
        initDrawingCanvas();
    }, 500);

    const selectAlat = document.getElementById('nama_alat_select');

    if (selectAlat) {
        updateFormType(selectAlat.value);
        selectAlat.addEventListener('change', function() {
            updateFormType(this.value);
        });
    }

    const manualInput = document.getElementById('nama_alat_manual');
    if (manualInput) {
        manualInput.addEventListener('input', syncNamaAlat);
    }

    setTimeout(() => {
        disableRequiredOnHiddenForms();
    }, 500);

    console.log('✅ surface_plate initialization complete!');
});
</script>


</body>
</html>