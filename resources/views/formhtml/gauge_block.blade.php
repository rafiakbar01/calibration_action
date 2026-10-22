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
    </style>
</head>
<body>
    <div class="container my-4">
        <!-- resources/views/formhtml/inside_micrometer.blade.php -->
      <form method="POST" action="/calibrations" id="kalibrasiForm" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="form_type" value="gauge_block">
 
            <div class="form-kalibrasi-container">
                <table class="kalibrasi-header-table">
                    <tr>
                        <td colspan="2">
                            <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK65</p>
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
                            <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;">PAS - </p>
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
                                    <option value="Gauge Block">Gauge Block</option>
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
                            <p style="margin: 0; color: #000000;">Merek</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" name="merek" class="kalibrasi-input me-3" placeholder="Masukkan merek alat" style="width: 60%;" required>
                                <span class="me-3" style="color: #000000;">Kode Alat :</span>
                                <input type="text" name="kode_alat" class="kalibrasi-input" placeholder="Masukkan kode" style="width: 30%;">
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
                                <input type="text" 
                                    name="type_alat" 
                                    class="kalibrasi-input me-3" 
                                    placeholder="Masukkan Type Alat" 
                                    style="width: 45%;"
                                    oninput="formatTypeAlat(this)">
                                <span class="me-3" style="color: #000000;">/</span>
                                <input type="text" 
                                    name="no_seri" 
                                    class="kalibrasi-input" 
                                    placeholder="Masukkan No. Seri" 
                                    style="width: 45%;"
                                    oninput="formatNoSeri(this)"
                                    required>
                            </div>
                        </td>
                    </tr>
                    <!-- Rentang Ukur
                    <tr>
                        <td><p style="margin:0;color:#000">Rentang Ukur</p></td>
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
                                    oninput="document.getElementById('kapasitas').value = this.value || ''"
                                    onpaste="setTimeout(() => document.getElementById('kapasitas').value = this.value || '', 10)">
                            </div>
                        </td>
                    </tr> -->

                    <!-- Kapasitas / Resolusi -->
                   <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Kapasitas / Resolusi</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" name="kapasitas" class="kalibrasi-input me-3" placeholder="Masukkan kapasitas" style="width: 45%;" required>
                                <span class="me-3" style="color: #000000;">/</span>
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
                            <p style="margin: 0; color: #000000;">Tanggal Alat Masuk</p>
                        </td>
                        <td colspan="3">
                            <input type="date" name="tanggal_alat_masuk" class="kalibrasi-input" value="{{ date('Y-m-d') }}" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Tanggal Kalibrasi</p>
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
                            <p style="margin: 0; color: #000000;">Tempat Kalibrasi</p>
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
                            <p style="margin: 0; color: #000000;">Lokasi PT</p>
                        </td>
                        <td colspan="3">
                            <input type="text" name="lokasi_pt" class="kalibrasi-input" placeholder="Masukkan Lokasi PT">
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Kode TH</p>
                        </td>
                        <td colspan="3">
                            <input type="text" name="kode_th" class="kalibrasi-input" placeholder="Masukkan Kode TH">
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
                                <td class="bg-light fw-bold" style="color: #000000;">Suhu (&deg;C)</td>
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
                        
                        <!-- Baris 1 -->
                        <tr>
                            <td style="border: 1px solid black; padding: 8px; text-align: center;">
                                <input type="text" class="form-control form-control-sm text-center" 
                                    name="nominal_gauge_1" style="width:65px; display:inline-block; font-size: 0.9rem;">  
                            </td>
                            <td style="border: 1px solid black; padding: 8px; text-align: center;">
                                ( <input type="radio" name="kiri1" id="kiri1_ber" value="beraturan"> ) 
                                <label for="kiri1_ber" class="mb-0 ms-1" style="font-size: 0.85rem;">Beraturan</label>
                            </td>
                            <td style="border: 1px solid black; padding: 8px; text-align: center;">
                                ( <input type="radio" name="kiri1" id="kiri1_tdk" value="tidak_beraturan"> ) 
                                <label for="kiri1_tdk" class="mb-0 ms-1" style="font-size: 0.85rem;">Tdk Beraturan</label>
                            </td>
                            <td style="border: 1px solid black; padding: 8px; text-align: center;">
                                ( <input type="radio" name="kanan1" id="kanan1_ber" value="beraturan"> ) 
                                <label for="kanan1_ber" class="mb-0 ms-1" style="font-size: 0.85rem;">Beraturan</label>
                            </td>
                            <td style="border: 1px solid black; padding: 8px; text-align: center;">
                                ( <input type="radio" name="kanan1" id="kanan1_tdk" value="tidak_beraturan"> ) 
                                <label for="kanan1_tdk" class="mb-0 ms-1" style="font-size: 0.85rem;">Tdk Beraturan</label>
                            </td>
                        </tr>
                        
                        <!-- Baris 2 -->
                        <tr>
                            <td style="border: 1px solid black; padding: 8px; text-align: center;">
                                <input type="text" class="form-control form-control-sm text-center" 
                                    name="nominal_gauge_2" style="width:65px; display:inline-block; font-size: 0.9rem;">  
                            </td>
                            <td style="border: 1px solid black; padding: 8px; text-align: center;">
                                ( <input type="radio" name="kiri2" id="kiri2_ber" value="beraturan"> ) 
                                <label for="kiri2_ber" class="mb-0 ms-1" style="font-size: 0.85rem;">Beraturan</label>
                            </td>
                            <td style="border: 1px solid black; padding: 8px; text-align: center;">
                                ( <input type="radio" name="kiri2" id="kiri2_tdk" value="tidak_beraturan"> ) 
                                <label for="kiri2_tdk" class="mb-0 ms-1" style="font-size: 0.85rem;">Tdk Beraturan</label>
                            </td>
                            <td style="border: 1px solid black; padding: 8px; text-align: center;">
                                ( <input type="radio" name="kanan2" id="kanan2_ber" value="beraturan"> ) 
                                <label for="kanan2_ber" class="mb-0 ms-1" style="font-size: 0.85rem;">Beraturan</label>
                            </td>
                            <td style="border: 1px solid black; padding: 8px; text-align: center;">
                                ( <input type="radio" name="kanan2" id="kanan2_tdk" value="tidak_beraturan"> ) 
                                <label for="kanan2_tdk" class="mb-0 ms-1" style="font-size: 0.85rem;">Tdk Beraturan</label>
                            </td>
                        </tr>
                        
                        <!-- Baris 3 -->
                        <tr>
                            <td style="border: 1px solid black; padding: 8px; text-align: center;">
                                <input type="text" class="form-control form-control-sm text-center" 
                                    name="nominal_gauge_3" style="width:65px; display:inline-block; font-size: 0.9rem;">  
                            </td>
                            <td style="border: 1px solid black; padding: 8px; text-align: center;">
                                ( <input type="radio" name="kiri3" id="kiri3_ber" value="beraturan"> ) 
                                <label for="kiri3_ber" class="mb-0 ms-1" style="font-size: 0.85rem;">Beraturan</label>
                            </td>
                            <td style="border: 1px solid black; padding: 8px; text-align: center;">
                                ( <input type="radio" name="kiri3" id="kiri3_tdk" value="tidak_beraturan"> ) 
                                <label for="kiri3_tdk" class="mb-0 ms-1" style="font-size: 0.85rem;">Tdk Beraturan</label>
                            </td>
                            <td style="border: 1px solid black; padding: 8px; text-align: center;">
                                ( <input type="radio" name="kanan3" id="kanan3_ber" value="beraturan"> ) 
                                <label for="kanan3_ber" class="mb-0 ms-1" style="font-size: 0.85rem;">Beraturan</label>
                            </td>
                            <td style="border: 1px solid black; padding: 8px; text-align: center;">
                                ( <input type="radio" name="kanan3" id="kanan3_tdk" value="tidak_beraturan"> ) 
                                <label for="kanan3_tdk" class="mb-0 ms-1" style="font-size: 0.85rem;">Tdk Beraturan</label>
                            </td>
                        </tr>
                    </table>

                <!-- Data Kalibrasi Section -->
                <div class="data-kalibrasi-header" style="color: #000000;">DATA KALIBRASI</div>
                
                <div class="table-responsive">
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
                <input type="text" 
                       name="satuan_unit" 
                       value="{{ $calibration->headTimbanganBias->unit ?? '' }}"
                       style="width: 40px; border: none; border-bottom: 1px solid #999; text-align: center; background: transparent; font-weight: bold; display: inline-block; margin: 0 2px;">
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
        <?php for ($no = 1; $no <= 15; $no++): ?>
            <tr>
                <!-- No -->
                <td style="border: 1px solid black; padding: 8px; text-align: center;"><?= $no ?></td>
                
                <!-- Unit ( ) -->
                <td style="border: 1px solid black; padding: 0;">
                    <input type="text" name="titikUkur_<?= $no ?>" class="form-control form-control-sm text-center" 
                           style="width:100%; border: none; outline: none; padding: 8px;">
                </td>
                
                <!-- No. Seri -->
                <td style="border: 1px solid black; padding: 0;">
                    <input type="text" name="NoSeri_<?= $no ?>" class="form-control form-control-sm text-center" 
                           style="width:100%; border: none; outline: none; padding: 8px;">
                </td>
                
                <!-- Standar yang digunakan -->
                <td style="border: 1px solid black; padding: 0;">
                    <input type="text" name="STD_<?= $no ?>" class="form-control form-control-sm text-center" 
                           style="width:100%; border: none; outline: none; padding: 8px;">
                </td>
                
                <!-- Pengukuran: Siklus 1 dan Siklus 2 vertikal (hanya teks) -->
                <td style="border: 1px solid black; padding: 12px 8px; line-height: 2.2; text-align: center;">
                    Siklus 1<br>
                    Siklus 2
                </td>
                
                <!-- Penunjukan Standard: 2 input vertikal (Siklus 1 atas, Siklus 2 bawah) -->
                <!-- 1 Tengah -->
                <td style="border: 1px solid black; padding: 0;">
                    <div style="border-bottom: 1px solid black;">
                        <input type="text" name="C1M_<?= $no ?>" class="form-control form-control-sm text-center" 
                               style="width:100%; border: none; outline: none; padding: 8px;">
                    </div>
                    <div>
                        <input type="text" name="C2M_<?= $no ?>" class="form-control form-control-sm text-center" 
                               style="width:100%; border: none; outline: none; padding: 8px;">
                    </div>
                </td>
                
                <!-- 2 Kiri Atas -->
                <td style="border: 1px solid black; padding: 0;">
                    <div style="border-bottom: 1px solid black;">
                        <input type="text" name="C1UL_<?= $no ?>" class="form-control form-control-sm text-center" 
                               style="width:100%; border: none; outline: none; padding: 8px;">
                    </div>
                    <div>
                        <input type="text" name="C2UL_<?= $no ?>" class="form-control form-control-sm text-center" 
                               style="width:100%; border: none; outline: none; padding: 8px;">
                    </div>
                </td>
                
                <!-- 3 Kiri Bawah (LL) -->
                <td style="border: 1px solid black; padding: 0;">
                    <div style="border-bottom: 1px solid black;">
                        <input type="text" name="C1LL_<?= $no ?>" class="form-control form-control-sm text-center" 
                               style="width:100%; border: none; outline: none; padding: 8px;">
                    </div>
                    <div>
                        <input type="text" name="C2LL_<?= $no ?>" class="form-control form-control-sm text-center" 
                               style="width:100%; border: none; outline: none; padding: 8px;">
                    </div>
                </td>
                
                <!-- 4 Kanan Atas (UR) -->
                <td style="border: 1px solid black; padding: 0;">
                    <div style="border-bottom: 1px solid black;">
                        <input type="text" name="C1UR_<?= $no ?>" class="form-control form-control-sm text-center" 
                               style="width:100%; border: none; outline: none; padding: 8px;">
                    </div>
                    <div>
                        <input type="text" name="C2UR_<?= $no ?>" class="form-control form-control-sm text-center" 
                               style="width:100%; border: none; outline: none; padding: 8px;">
                    </div>
                </td>
                
                <!-- 5 Kanan Bawah (LR) -->
                <td style="border: 1px solid black; padding: 0;">
                    <div style="border-bottom: 1px solid black;">
                        <input type="text" name="C1LR_<?= $no ?>" class="form-control form-control-sm text-center" 
                               style="width:100%; border: none; outline: none; padding: 8px;">
                    </div>
                    <div>
                        <input type="text" name="C2LR_<?= $no ?>" class="form-control form-control-sm text-center" 
                               style="width:100%; border: none; outline: none; padding: 8px;">
                    </div>
                </td>
                
                <!-- 6 Tengah (C) -->
                <td style="border: 1px solid black; padding: 0;">
                    <div style="border-bottom: 1px solid black;">
                        <input type="text" name="C1C_<?= $no ?>" class="form-control form-control-sm text-center" 
                               style="width:100%; border: none; outline: none; padding: 8px;">
                    </div>
                    <div>
                        <input type="text" name="C2C_<?= $no ?>" class="form-control form-control-sm text-center" 
                               style="width:100%; border: none; outline: none; padding: 8px;">
                    </div>
                </td>
            </tr>
        <?php endfor; ?>
    </tbody>
</table>
    </div>
<!-- Tambahkan ini di bagian form, sebelum submit button -->
<!-- Bagian Upload File - GANTI DENGAN KODE INI -->
<div class="container mt-3">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <i class="fas fa-paperclip me-2"></i> Lampiran Dokumen (Maksimal 25MB per file)
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="attachments" class="form-label fw-bold">Pilih File Attachment</label>
                <input type="file" 
                       name="attachments[]" 
                       id="attachments" 
                       class="form-control"
                       multiple
                       accept=".pdf,.jpg,.jpeg,.png">
                <div class="form-text text-muted mt-2">
                    <i class="fas fa-info-circle me-1"></i>
                    Maksimal ukuran per file: <strong>25MB</strong>. 
                    Format yang didukung: PDF, JPG, JPEG, PNG.
                </div>
            </div>
            
            <!-- TEMPAT UNTUK MENAMPILKAN DAFTAR FILE -->
                       <!-- TEMPAT UNTUK MENAMPILKAN DAFTAR FILE -->
            <div id="daftarFileContainer" style="margin-top: 20px;"></div>
        </div>
    </div>
</div>

<!-- ==================== SCRIPT UPLOAD FILE + MODAL PREVIEW (MULTI-TAB SAFE) ==================== -->
<script>
    console.log('🚀 Script Upload + Modal Preview (Multi-Tab) loaded');

    // =====================================================================
    // HELPER: ambil tabId dari container form terdekat
    // =====================================================================
    function getTabIdFromElement(el) {
        const container = el ? el.closest('.lk-form-container') : null;
        return container ? container.getAttribute('data-lk-id') : null;
    }

    // =====================================================================
    // HELPER: ambil / inisialisasi array file per-tab
    // =====================================================================
    function getFileArray(tabId) {
        const key = 'fileGaugeBlock_tab_' + tabId;
        if (!window[key]) window[key] = [];
        return window[key];
    }

    function setFileArray(tabId, arr) {
        window['fileGaugeBlock_tab_' + tabId] = arr;
    }

    // =====================================================================
    // HELPER: ambil container & input yang scoped ke tabId tertentu
    // =====================================================================
    function getContainerByTabId(tabId) {
        return document.querySelector('.lk-form-container[data-lk-id="' + tabId + '"]');
    }

    function getFileInputByTabId(tabId) {
        // 1. Coba scoped ke container tab yang tepat
        const container = getContainerByTabId(tabId);
        if (container) {
            const inp = container.querySelector('input[type="file"][id="attachments"], input[type="file"][name="attachments[]"]');
            if (inp) return inp;
        }
        // 2. Fallback: cari di seluruh dokumen
        return document.getElementById('attachments')
            || document.querySelector('input[type="file"][name="attachments[]"]');
    }

    function getPreviewContainerByTabId(tabId) {
        // 1. Coba scoped ke container tab yang tepat
        const container = getContainerByTabId(tabId);
        if (container) {
            const pc = container.querySelector('#daftarFileContainer');
            if (pc) return pc;
        }
        // 2. Fallback: cari di seluruh dokumen
        return document.getElementById('daftarFileContainer');
    }

    // =====================================================================
    // FORMAT FILE SIZE
    // =====================================================================
    function formatFileSize(bytes) {
        if (!bytes) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    // =====================================================================
    // TAMPILKAN PREVIEW — scoped ke tabId
    // =====================================================================
    function tampilkanFilePreview(tabId) {
        // Jika tabId tidak diberikan, cari dari active tab
        if (!tabId) tabId = (typeof getActiveTabId === 'function') ? getActiveTabId() : '1';

        const previewContainer = getPreviewContainerByTabId(tabId);
        if (!previewContainer) return;

        const files = getFileArray(tabId);

        if (files.length === 0) {
            previewContainer.innerHTML = `
                <div class="alert alert-info py-3 text-center">
                    <i class="fas fa-info-circle me-2"></i> Belum ada file yang dipilih.
                </div>`;
            return;
        }

        let totalUkuran = files.reduce((sum, f) => sum + f.size, 0);

        let html = `
            <div class="border border-primary rounded-3 p-3 bg-light">
                <h6 class="fw-bold text-primary mb-3">
                    <i class="fas fa-paperclip me-2"></i>
                    File Attachment (${files.length} file)
                </h6>
                <div style="max-height: 450px; overflow-y: auto;">`;

        files.forEach((file, index) => {
            const ukuran = formatFileSize(file.size);
            const mb = (file.size / 1048576).toFixed(2);
            const isImage = file.type.includes('image');
            const icon = isImage ? '🖼️' : file.type.includes('pdf') ? '📑' : '📄';

            html += `
                <div class="d-flex align-items-center justify-content-between p-3 mb-2 bg-white border rounded shadow-sm">
    <div class="d-flex align-items-center gap-3 flex-grow-1">
        <span style="font-size: 28px;">${icon}</span>
        <div class="flex-grow-1 min-width-0">
            <div class="fw-medium text-break small">${file.name}</div>
            <div class="text-muted small">${ukuran} (${mb} MB)</div>
        </div>
    </div>
    <div class="d-flex" style="gap: 12px;">
        <button type="button" onclick="lihatFile(${index}, '${tabId}')" 
                class="btn btn-sm btn-primary">
            <i class="fas fa-eye"></i> Lihat
        </button>
        <button type="button" onclick="hapusFile(${index}, '${tabId}')" 
                class="btn btn-sm btn-danger">
            <i class="fas fa-trash"></i> Hapus
        </button>
    </div>
</div>`;
        });

        html += `
                </div>
                <div class="mt-3 pt-3 border-top d-flex justify-content-between align-items-center">
                    <strong>Total Ukuran:</strong>
                    <div class="text-end">
                        <strong class="text-primary">${formatFileSize(totalUkuran)}</strong>
                        <small class="text-muted"> (${(totalUkuran/1048576).toFixed(2)} MB)</small>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <button type="button" onclick="hapusSemuaFile('${tabId}')" 
                            class="btn btn-sm btn-secondary">
                        <i class="fas fa-trash me-1"></i> Hapus Semua File
                    </button>
                </div>
            </div>`;

        previewContainer.innerHTML = html;
    }

    // =====================================================================
    // LIHAT FILE DI MODAL — scoped ke tabId
    // =====================================================================
    window.lihatFile = function(index, tabId) {
        if (!tabId) tabId = (typeof getActiveTabId === 'function') ? getActiveTabId() : '1';
        const file = getFileArray(tabId)[index];
        if (!file) return;

        const isImage = file.type.includes('image');
        let modalContent = '';

        if (isImage) {
            const url = URL.createObjectURL(file);
            modalContent = `<img src="${url}" class="img-fluid rounded" style="max-height: 75vh;" alt="${file.name}">`;
        } else if (file.type === 'application/pdf') {
            const url = URL.createObjectURL(file);
            modalContent = `<iframe src="${url}" style="width:100%; height:75vh; border:none;" allowfullscreen></iframe>`;
        } else {
            modalContent = `<p class="text-center p-5">Preview tidak tersedia untuk tipe file ini.</p>`;
        }

        const modalHTML = `
            <div class="modal fade" id="filePreviewModal" tabindex="-1">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-truncate">${file.name}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body p-3">
                            ${modalContent}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>`;

        const oldModal = document.getElementById('filePreviewModal');
        if (oldModal) oldModal.remove();

        document.body.insertAdjacentHTML('beforeend', modalHTML);
        const modal = new bootstrap.Modal(document.getElementById('filePreviewModal'));
        modal.show();
    };

    // =====================================================================
    // HAPUS FILE — scoped ke tabId
    // =====================================================================
    window.hapusFile = function(index, tabId) {
        if (!tabId) tabId = (typeof getActiveTabId === 'function') ? getActiveTabId() : '1';
        const files = getFileArray(tabId);
        if (confirm(`Hapus file "${files[index].name}"?`)) {
            files.splice(index, 1);
            tampilkanFilePreview(tabId);
            syncFileInput(tabId);
        }
    };

    window.hapusSemuaFile = function(tabId) {
        if (!tabId) tabId = (typeof getActiveTabId === 'function') ? getActiveTabId() : '1';
        const files = getFileArray(tabId);
        if (confirm(`Hapus SEMUA ${files.length} file?`)) {
            setFileArray(tabId, []);
            tampilkanFilePreview(tabId);
            syncFileInput(tabId);
        }
    };

    // =====================================================================
    // SYNC FILE INPUT — scoped ke tabId
    // =====================================================================
    function syncFileInput(tabId) {
        if (!tabId) tabId = (typeof getActiveTabId === 'function') ? getActiveTabId() : '1';
        const input = getFileInputByTabId(tabId);
        if (!input) return;

        const dt = new DataTransfer();
        getFileArray(tabId).forEach(file => dt.items.add(file));
        input.files = dt.files;
        console.log('🔄 File input synced for tab ' + tabId + ':', input.files.length, 'file');
    }

    // =====================================================================
    // PASANG LISTENER — scoped ke container tab tertentu
    // =====================================================================
    function pasangListenerUpload(tabId) {
        if (!tabId) tabId = (typeof getActiveTabId === 'function') ? getActiveTabId() : '1';
        const input = getFileInputByTabId(tabId);
        if (input) {
            // Hindari duplikat listener
            input.onchange = null;
            input.onchange = function(e) {
                const targetTabId = getTabIdFromElement(e.target) || tabId;
                if (e.target.files && e.target.files.length > 0) {
                    const files = getFileArray(targetTabId);
                    Array.from(e.target.files).forEach(file => {
                        if (!files.some(f => f.name === file.name)) {
                            files.push(file);
                        }
                    });
                    tampilkanFilePreview(targetTabId);
                    syncFileInput(targetTabId);
                }
            };
            console.log('✅ Listener upload aktif untuk tab ' + tabId);
        } else {
            console.warn('⚠️ Input file tidak ditemukan untuk tab ' + tabId);
        }
    }

    // =====================================================================
    // INISIALISASI — pasang listener untuk semua tab yang ada
    // =====================================================================
    function initUploadAllTabs() {
        const containers = document.querySelectorAll('.lk-form-container');
        if (containers.length > 0) {
            containers.forEach(container => {
                const tid = container.getAttribute('data-lk-id');
                if (tid) {
                    pasangListenerUpload(tid);
                    tampilkanFilePreview(tid);
                }
            });
        } else {
            // Fallback: belum ada .lk-form-container, coba tab 1
            pasangListenerUpload('1');
            tampilkanFilePreview('1');
        }
    }

    // Jalankan saat DOM siap
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initUploadAllTabs);
    } else {
        initUploadAllTabs();
    }
    // Fallback untuk lazy-loaded tab
    setTimeout(initUploadAllTabs, 1500);

    // Expose untuk dipanggil dari luar (misal saat tab baru ditambahkan)
    window.initGaugeBlockUpload = initUploadAllTabs;
    window.pasangListenerUploadGaugeBlock = pasangListenerUpload;

    console.log('✅ Script Upload + Modal Preview (Multi-Tab) siap');
</script>


                <div class="mt-5">
  <table style="font-size: 0.95rem; border-collapse: collapse; width: 100%;">
    <!-- Baris Pesan Penting (full width) -->
    <tr>
      <td colspan="4" style="border: 1px solid black; padding: 12px; text-align: center;">
        <span class="fw-bold text-danger" style="font-size: 1.1rem;">Isilah lembar data kalibrasi dengan lengkap dan jelas!</span>
      </td>
    </tr>

    <!-- Baris Utama: Alat Standar (1 row saja) + Dikalibrasi/Diperiksa -->
    <tr>
      <!-- Alat Standar -->
      <td style="border: 1px solid black; padding: 10px; width: 15%; text-align: center; vertical-align: middle; font-weight: bold;">
        Alat<br>Standar
      </td>
      <td style="border: 1px solid black; padding: 10px; width: 35%; vertical-align: middle;">
        <span class="fw-bold">Mesin ULM 01-600D</span>
        <input type="hidden" name="alat_standar_text" value="Mesin ULM 01-600D">
      </td>

      <!-- Dikalibrasi oleh & Diperiksa oleh -->
      <td style="border: 1px solid black; padding: 10px; width: 25%; text-align: center; vertical-align: middle;">
        Dikalibrasi<br>oleh
      </td>
      <td style="border: 1px solid black; padding: 10px; width: 25%; text-align: center; vertical-align: middle;">
        Diperiksa<br>oleh
      </td>
    </tr>

    <!-- Baris Input Nama + Metode Kalibrasi -->
    <tr>
      <!-- Metode Kalibrasi -->
      <td style="border: 1px solid black; padding: 10px; text-align: center; vertical-align: middle; font-weight: bold;">
        Metode<br>Kalibrasi
      </td>
      <td style="border: 1px solid black; padding: 10px; vertical-align: middle;">
        PAS-IK1102-65
      </td>

      <!-- Input Nama Dikalibrasi oleh -->
     <td style="border: 1px solid black; padding: 10px; vertical-align: middle;">
    <label class="form-label fw-bold small d-block mb-2">Nama :</label>
    <input type="text" 
           name="calibrated_by" 
           class="form-control form-control-sm text-center" 
           value="{{ old('calibrated_by', auth()->user()->nama ?? $calibration->calibratedBy ?? '') }}"
           placeholder="Masukkan nama" readonly>
</td>

      <!-- Input Nama Diperiksa oleh -->
      <td style="border: 1px solid black; padding: 10px; vertical-align: middle;">
        <label class="form-label fw-bold small d-block mb-2">Nama :</label>
        <input type="text" name="verified_by" class="form-control form-control-sm text-center" placeholder="-" readonly>
      </td>
    </tr>
  </table>
</div>

                <!-- Submit Button Section -->
                <div class="row mt-5">
                    <div class="col-12 text-center">
                       <button type="button" id="btnSimpanSemua" onclick="submitSemuaForm()" class="btn btn-primary btn-lg" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
                                    <i class="fas fa-save me-2"></i>Simpan Data Kalibrasi
                                </button>
                        
                        <!--<button type="reset" class="btn btn-secondary btn-lg ms-3" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">-->
                        <!--    <i class="fas fa-redo me-2"></i>Reset Form-->
                        <!--</button>-->
                    </div>
                </div>

            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// ==========================================
// STORAGE PER TAB - GAUGE BLOCK
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
// FUNGSI UNTUK MENONAKTIFKAN REQUIRED
// ==========================================
function disableRequiredOnHiddenForms() {
    console.log('🔧 disableRequiredOnHiddenForms called for Gauge Block');
    
    const allForms = document.querySelectorAll('form[id^="kalibrasiForm"]');
    
    allForms.forEach((form, index) => {
        const formIndex = index + 1;
        const container = form.closest('.lk-form-container');
        const isVisible = container && window.getComputedStyle(container).display !== 'none';
        
        console.log(`📌 Form ${formIndex}: isVisible=${isVisible}`);
        
        const requiredInputs = form.querySelectorAll('[required]');
        
        if (!isVisible) {
            requiredInputs.forEach(input => {
                console.log(`🔧 Disabling required for: ${input.name}`);
                input.removeAttribute('required');
                input.setAttribute('data-required-temp', 'true');
            });
        } else {
            requiredInputs.forEach(input => {
                if (input.hasAttribute('data-required-temp')) {
                    console.log(`🔧 Re-enabling required for: ${input.name}`);
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
// UPDATE FORM TYPE UNTUK GAUGE BLOCK
// ==========================================
function updateFormType(selectedAlat, formIndex = 1, tabId = null) {
    const manualInputContainer = document.getElementById(`manualInputContainer_${formIndex}`);
    const manualInput = document.getElementById(`nama_alat_manual_${formIndex}`);
    const finalInput = document.getElementById(`nama_alat_final_${formIndex}`);
    
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

function syncNamaAlat(formIndex = 1) {
    const manualInput = document.getElementById(`nama_alat_manual_${formIndex}`);
    const finalInput = document.getElementById(`nama_alat_final_${formIndex}`);
    if (manualInput && finalInput) {
        finalInput.value = manualInput.value;
    }
}

function escapeHtml(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// ==========================================
// HANDLE SAVE SUCCESS UNTUK GAUGE BLOCK
// ==========================================
// ==========================================
// HANDLE SAVE SUCCESS UNTUK GAUGE BLOCK (BUTTON PASTEL - NO HOVER)
// ==========================================
window.handleSaveSuccess = function(tabId, data) {
    console.log('🎉 handleSaveSuccess called for Gauge Block tab:', tabId, data);
    
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

    const formName = container.getAttribute('data-form-name') || 'Gauge Block';
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
            <!-- Button Cetak Label - Blue -->
            <button type="button" class="btn btn-primary btn-lg px-4 py-2" 
                    style="border-radius: 10px; transition: all 0.2s ease;"
                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 5px 15px rgba(0,0,0,0.2)';"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';"
                    onmousedown="this.style.transform='translateY(1px)';"
                    onmouseup="this.style.transform='translateY(-2px)';"
                    onclick="window.open('${printLabelUrl}', '_blank')">
                <i class="fas fa-print me-2"></i> Cetak Label
            </button>
            
            <!-- Button Input Lagi - Green -->
            <button type="button" class="btn btn-success btn-lg px-4 py-2" 
                    style="border-radius: 10px; transition: all 0.2s ease;"
                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 5px 15px rgba(0,0,0,0.2)';"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';"
                    onmousedown="this.style.transform='translateY(1px)';"
                    onmouseup="this.style.transform='translateY(-2px)';"
                    onclick="resetTabForNewScan(${tabId})">
                <i class="fas fa-plus-circle me-2"></i> Input Lagi
            </button>
            
            <!-- Button Tutup Tab - Red -->
            <button type="button" class="btn btn-danger btn-lg px-4 py-2" 
                    style="border-radius: 10px; transition: all 0.2s ease;"
                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 5px 15px rgba(0,0,0,0.2)';"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';"
                    onmousedown="this.style.transform='translateY(1px)';"
                    onmouseup="this.style.transform='translateY(-2px)';"
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
            title: 'Data Tersimpan!',
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

async function submitSemuaForm() {
    const activeTabId = getActiveTabId();
    console.log('📌 Submitting Gauge Block from active tab:', activeTabId);

    const activeContainer = document.querySelector(`.lk-form-container[data-lk-id="${activeTabId}"]`);
    if (!activeContainer) {
        alert('Container form tidak ditemukan!');
        return;
    }

    let form = activeContainer.querySelector('#kalibrasiForm')
        || activeContainer.querySelector('form[id^="kalibrasiForm"]')
        || activeContainer.querySelector('form');

    if (!form) {
        alert('Form tidak ditemukan!');
        return;
    }

    console.log(`✅ Form Gauge Block ditemukan di tab ${activeTabId}`);

    form.setAttribute('novalidate', 'novalidate');
    form.noValidate = true;

    // =========================================================
    // VALIDASI ALAT STANDAR
    // =========================================================
    let alatStandarValues = [];
    const checkboxes = form.querySelectorAll('input[name="alat_standar[]"]:checked');
    if (checkboxes.length > 0) {
        checkboxes.forEach(cb => {
            if (cb.value) alatStandarValues.push(cb.value);
        });
    } else {
        const alatStandarHidden = form.querySelector('input[name="alat_standar_text"]');
        const alatStandarSpan = form.querySelector('.alat-standar-text');
        let singleValue = '';
        if (alatStandarHidden && alatStandarHidden.value) {
            singleValue = alatStandarHidden.value;
        } else if (alatStandarSpan && alatStandarSpan.innerText) {
            singleValue = alatStandarSpan.innerText.trim();
        }
        if (singleValue) alatStandarValues.push(singleValue);
    }
    if (alatStandarValues.length === 0) {
        alatStandarValues = ['Mesin ULM 01-600D'];
    }

    // =========================================================
    // VALIDASI DATA PENGUKURAN
    // =========================================================
    let hasMeasurementData = false;
    for (let i = 1; i <= 15; i++) {
        const titikUkur = form.querySelector(`input[name="titikUkur_${i}"]`)?.value;
        const std = form.querySelector(`input[name="STD_${i}"]`)?.value;
        const noSeri = form.querySelector(`input[name="NoSeri_${i}"]`)?.value;
        if (titikUkur || std || noSeri) hasMeasurementData = true;
    }

    const btn = document.getElementById('btnSimpanSemua');
    if (!btn) {
        alert('Tombol simpan tidak ditemukan!');
        return;
    }

    const originalText = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan Data...';

    try {
    const formData = new FormData(form);
    formData.append('form_type', 'gauge_block');

    // Alat standar
    formData.delete('alat_standar_text');
    formData.delete('alat_standar[]');
    alatStandarValues.forEach(value => {
        formData.append('alat_standar[]', value);
    });

    // ====================================================================
    // ATTACHMENT HANDLING — 3-layer fallback
    // ====================================================================
    formData.delete('attachments');
    formData.delete('attachments[]');

    // Layer 1: per-tab array (paling diutamakan)
    const tabFileArray = window['fileGaugeBlock_tab_' + activeTabId] || [];

    // Layer 2: file input milik form aktif
    const fileInputEl = form.querySelector('input[type="file"][name="attachments[]"]')
        || form.querySelector('input[type="file"][id="attachments"]')
        || document.getElementById('attachments');
    const inputFiles = fileInputEl && fileInputEl.files.length > 0
        ? Array.from(fileInputEl.files)
        : [];

    const fileSumber = tabFileArray.length > 0
        ? tabFileArray
        : inputFiles;

    console.log('📎 [GaugeBlock] Attachment debug:', {
        activeTabId,
        tabArrayLen: tabFileArray.length,
        inputFilesLen: inputFiles.length,
        fileSumberLen: fileSumber.length,
        fileInputFound: !!fileInputEl
    });

    if (fileSumber.length > 0) {
        console.log(`📎 Menambahkan ${fileSumber.length} file ke FormData (tab ${activeTabId})`);
        fileSumber.forEach((file, i) => {
            formData.append('attachments[]', file, file.name);
            console.log(`   File ${i+1}: ${file.name} (${file.size} bytes)`);
        });
    } else {
        console.warn('⚠️ Tidak ada file — tab array kosong DAN file input kosong untuk tab ' + activeTabId);
    }


    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
    if (csrfToken) {
        formData.append('_token', csrfToken);
    }

    console.log('📤 Mengirim data Gauge Block dari tab:', activeTabId);
    console.log('📤 Jumlah file di tab ini:', fileSumber.length);

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

    let formName = 'Gauge Block';
    const selectNamaAlat = form.querySelector('select[name="nama_alat"]');
    if (selectNamaAlat && selectNamaAlat.value && selectNamaAlat.value !== 'MANUAL_INPUT') {
        formName = selectNamaAlat.value;
    } else {
        const manualNamaAlat = form.querySelector('input[name="nama_alat_manual"]');
        if (manualNamaAlat && manualNamaAlat.value) {
            formName = manualNamaAlat.value;
        }
    }
    activeContainer.setAttribute('data-form-name', formName);

    // Reset file setelah sukses (hanya untuk tab yang baru saja disimpan)
    window['fileGaugeBlock_tab_' + activeTabId] = [];
    const fileInput = form.querySelector('input[type="file"][name="attachments[]"]')
        || form.querySelector('input[type="file"][id="attachments"]');
    if (fileInput) fileInput.value = '';
    tampilkanFilePreview(activeTabId);

    console.log('📌 Save success for Gauge Block tab:', activeTabId);

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

            // ✅ Re-init listener upload untuk tab yang baru aktif
            if (typeof pasangListenerUpload === 'function') {
                pasangListenerUpload(tabId);
            }
            if (typeof tampilkanFilePreview === 'function') {
                tampilkanFilePreview(tabId);
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
    console.log('🚀 DOM Content Loaded - Initializing Gauge Block...');
    
    setupTabSwitching();
    
    // ✅ Init listener upload untuk semua tab yang sudah ada
    if (typeof initUploadAllTabs === 'function') {
        initUploadAllTabs();
    } else if (typeof window.initGaugeBlockUpload === 'function') {
        window.initGaugeBlockUpload();
    }
    
    const selectAlat = document.getElementById('nama_alat_select_1');
    if (selectAlat) {
        updateFormType(selectAlat.value);
        selectAlat.addEventListener('change', function() {
            updateFormType(this.value);
        });
    }
    
    const manualInput = document.getElementById('nama_alat_manual_1');
    if (manualInput) {
        manualInput.addEventListener('input', function() {
            syncNamaAlat(1);
        });
    }
    
    setTimeout(() => {
        disableRequiredOnHiddenForms();
    }, 500);
    
    console.log('✅ Gauge Block initialization complete!');
});
</script>


</body>

</html>