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
        <form method="POST" action="/calibrations" id="kalibrasiForm">
        @csrf
        <input type="hidden" name="form_type" value="stopwatch">
        

            <div class="form-kalibrasi-container">
                <table class="kalibrasi-header-table">
                    <tr>
                        <td colspan="2">
                            <p style="margin: 0; font-size: 14px; color: #000000;text-align: left;">PAS-FLK45</p>
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
                            <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;text-align: left;">STOPWATCH</p>
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
                        <td style="width: 20%; text-align: left;">
                            <p style="margin: 0; color: #000000; text-align: left;">Nama Alat</p>
                        </td>
                        <td colspan="3">
                            <select name="nama_alat" class="kalibrasi-input"   onchange="updateFormType(this.value)" required style="background-color: #f5f5f5; color: #333; border: 1px solid #ced4da; padding: 6px 10px; border-radius: 4px; width: 100%;">
                                <option value="">-- Pilih Jenis Alat --</option>
                                <option value="Stopwatch">Stopwatch</option>
                                <option value="Stopwatch Digital">Stopwatch Digital</option>
                             
                            </select>
                        </td>
                    </tr>

    <!-- Merek & Kode Alat -->
    <tr>
        <td>
            <p style="margin: 0; color: #000000; text-align: left;">Merek</p>
        </td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="text" name="merek" class="kalibrasi-input me-3" placeholder="Masukkan merek alat" style="width: 60%; text-align: left;" required>
                <span class="me-3" style="color: #000000; text-align: left;">Kode Alat :</span>
                <input type="text" name="kode_alat" class="kalibrasi-input" placeholder="Masukkan kode" style="width: 30%; text-align: left;">
            </div>
        </td>
    </tr>

    <!-- Type / No. Seri -->
    <tr>
        <td>
            <p style="margin: 0; color: #000000; text-align: left;">Type / No. Seri</p>
        </td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="text" 
                    name="type_alat" 
                    class="kalibrasi-input me-3" 
                    placeholder="Masukkan Type Alat" 
                    style="width: 45%; text-align: left;"
                    oninput="formatTypeAlat(this)">
                <span class="me-3" style="color: #000000; text-align: left;">/</span>
                <input type="text" 
                    name="no_seri" 
                    class="kalibrasi-input" 
                    placeholder="Masukkan No. Seri" 
                    style="width: 45%; text-align: left;"
                    oninput="formatNoSeri(this)"
                    required>
            </div>
        </td>
    </tr>

    <!-- Kapasitas / Resolusi -->
    <tr>
        <td>
            <p style="margin: 0; color: #000000; text-align: left;">Kapasitas / Resolusi</p>
        </td>
        <td colspan="3">
            <div class="d-flex align-items-center">
                <input type="text" name="kapasitas" class="kalibrasi-input me-3" placeholder="Masukkan kapasitas" style="width: 45%; text-align: left;" required>
                <span class="me-3" style="color: #000000; text-align: left;">/</span>
                <input type="text" name="resolusi" class="kalibrasi-input" placeholder="Masukkan Resolusi" style="width: 45%; text-align: left;" required>
            </div>
        </td>
    </tr>

    <!-- Nama Pemilik -->
    <tr>
        <td>
            <p style="margin: 0; color: #000000; text-align: left;">Nama Pemilik</p>
        </td>
        <td colspan="3">
            <input type="text" name="nama_pemilik" class="kalibrasi-input" placeholder="Masukkan nama pemilik / instansi" style="width: 100%; text-align: left;" required>
        </td>
    </tr>

    <!-- Tanggal Alat Masuk -->
    <tr>
        <td>
            <p style="margin: 0; color: #000000; text-align: left;">Tanggal Alat Masuk</p>
        </td>
        <td colspan="3">
            <input type="date" name="tanggal_alat_masuk" class="kalibrasi-input" value="{{ date('Y-m-d') }}" style="width: 100%; text-align: left;" required>
        </td>
    </tr>
    
    <!-- Tanggal Kalibrasi & Jenis Pembacaan -->
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
                    style="width: 45%; text-align: left;" 
                    required
                    value="{{ date('Y-m-d') }}">
                
                <span class="me-3" style="color: #000000; text-align: left;">Jenis Pembacaan:</span>
                
                <!-- Dropdown Jenis Pembacaan -->
                <select name="jenis_pembacaan" class="kalibrasi-input" style="width: 45%; text-align: left;">
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
                    <label class="form-check-label" for="lab" style="color: #000000; text-align: left;">Lab. PT.PAS</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tempat_kalibrasi" value="insitu" id="insitu" required>
                    <label class="form-check-label" for="insitu" style="color: #000000; text-align: left;">Insitu</label>
                </div>
            </div>
        </td>
    </tr>
    
    <!-- Lokasi PT -->
    <tr>
        <td>
            <p style="margin: 0; color: #000000; text-align: left;">Lokasi PT</p>
        </td>
        <td colspan="3">
            <input type="text" name="lokasi_pt" class="kalibrasi-input" placeholder="Masukkan Lokasi PT" style="width: 100%; text-align: left;">
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

                <!-- Data Kalibrasi Section -->
                <div class="data-kalibrasi-header" style="color: #000000;">DATA KALIBRASI</div>
                
                
                

<html lang="id">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kalibrasi Gauge Block - ULM Comparison</title>
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      padding: 20px;
      background-color: #f9f9f9;
    }
    table {
      width: 80%;
      max-width: 1200px;
      margin: 20px auto;
      border-collapse: collapse;
      background-color: #fff;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    td, th {
      border: 1px solid #000;
      padding: 8px;
      text-align: center;
      vertical-align: middle;
      font-size: 11pt;
    }
    th {
      background-color: #d0d0d0;
      font-weight: bold;
    }
    .section-title {
      background-color: #a0a0a0;
      font-size: 1.2em;
      font-weight: bold;
    }
    input[type="text"] {
      width: 100%;
      border: none;
      background: transparent;
      text-align: center;
      padding: 4px;
      box-sizing: border-box;
    }
    input[type="text"]:focus {
      outline: 2px solid #4a90e2;
      background-color: #f0f8ff;
    }
    .unit-note {
      font-size: 0.9em;
      color: #555;
    }
    .sub-header {
      background-color: #e6e6e6;
    }
    
    textarea {
      width: 50%;
      height:400px;
      padding: 10px;
      border: 1px solid #aaa;
      border-radius: 6px;
      font-size: 10pt;
      resize: none;
      
    }
    
    
    .x78 {
        text-align: general;
        vertical-align: middle;
        white-space: nowrap;
        background: #DBEEF4;
        color: #000000;
        font-size: 10pt;
        font-weight: 700;
        font-style: normal;
        font-family: Arial, sans-serif;
        border-top: 1px solid windowtext;
        border-right: 1px solid windowtext;
        border-bottom: 1px solid windowtext;
        border-left: 1px solid windowtext;
      }
      
      .x82 {
        text-align: general;
        vertical-align: middle;
        white-space: nowrap;
        background: #DBEEF4;
        color: #000000;
        font-size: 10pt;
        font-weight: 700;
        font-style: normal;
        font-family: Arial, sans-serif;
        border-top: 1px solid windowtext;
        border-right: 1px solid windowtext;
        border-bottom: 1px solid windowtext;
        border-left: 1px solid windowtext;
      }
      
      .x128 {
        text-align: center;
        vertical-align: middle;
        white-space: nowrap;
        background: #D9D9D9;
        color: #000000;
        font-size: 10pt;
        font-weight: 700;
        font-style: normal;
        font-family: Arial, sans-serif;
        border-top: 1px solid windowtext;
        border-right: none;
        border-bottom: none;
        border-left: 1px solid windowtext;
      }
      
      .x99 {
        text-align: center;
        vertical-align: middle;
        white-space: nowrap;
        background: #D9D9D9;
        color: #000000;
        font-size: 10pt;
        font-weight: 700;
        font-style: normal;
        font-family: Arial, sans-serif;
        border-top: 1px solid windowtext;
        border-right: none;
        border-bottom: none;
        border-left: 1px solid windowtext;
      }
      
      .x100 {
        text-align: center;
        vertical-align: middle;
        white-space: nowrap;
        background: #D9D9D9;
        color: #000000;
        font-size: 10pt;
        font-weight: 700;
        font-style: normal;
        font-family: Arial, sans-serif;
        border-top: 1px solid windowtext;
        border-right: none;
        border-bottom: none;
        border-left: 1px solid windowtext;
      }
      
      .x63 {
        text-align: center;
        vertical-align: middle;
        white-space: nowrap;
        background: #D9D9D9;
        color: #000000;
        font-size: 10pt;
        font-weight: 700;
        font-style: normal;
        font-family: Arial, sans-serif;
        border-top: 1px solid windowtext;
        border-right: none;
        border-bottom: none;
        border-left: 1px solid windowtext;
      }
      
      .x131 {
        text-align: center;
        vertical-align: middle;
        white-space: nowrap;
        background: #D9D9D9;
        color: #000000;
        font-size: 10pt;
        font-weight: 700;
        font-style: normal;
        font-family: Arial, sans-serif;
        border-top: 1px solid windowtext;
        border-right: none;
        border-bottom: none;
        border-left: 1px solid windowtext;
      }
  </style>
  
  <style>
/* ===============================
   KHUSUS TABEL DATA KALIBRASI
   =============================== */

.kalibrasi-data-table {
    width: 100%;
    min-width: 1800px;       /* hanya tabel ini */
    border-collapse: collapse;
}

/* semua sel */
.kalibrasi-data-table th,
.kalibrasi-data-table td {
    padding: 6px 8px;
    font-size: 12px;
    text-align: center;
    vertical-align: middle;
    border: 1px solid #000;
}

/* input di tabel kalibrasi saja */
.kalibrasi-data-table input[type="text"] {
    width: 95%;
    min-width: 70px;
    height: 28px;
    font-size: 12px;
    padding: 4px 6px;
    box-sizing: border-box;
}

/* efek fokus */
.kalibrasi-data-table input[type="text"]:focus {
    outline: none;
    border-color: #0d6efd;
    background-color: #f8f9fa;
}

/* kolom judul kiri */
.kalibrasi-data-table .x128,
.kalibrasi-data-table .x121 {
    min-width: 120px;
}

/* kolom data kecil */
.kalibrasi-data-table .x63,
.kalibrasi-data-table .x53,
.kalibrasi-data-table .x78 {
    min-width: 90px;
}
</style>


<div style="overflow-x:auto;">
   <table class="kalibrasi-data-table">
  <tr class='x21' style='height:12.75pt'>
    <td rowspan='3' class='x128' style='border-bottom:1px solid windowtext;height:41.25pt;'>Titik Ukur</td>
    <td rowspan='3' class='x128' style='border-bottom:1px solid windowtext;height:41.25pt;'>Objek</td>
    <td colspan='16' class='x99' style='border-right:1px solid windowtext;border-bottom:1px solid windowtext;'>Penunjukan Standar dan UUT</td>
  </tr>
  <tr class='x21' style='height:12.75pt'>
    <td colspan='3' class='x99' style='border-right:1px solid windowtext;border-bottom:1px solid windowtext;'>Pengulangan 1</td>
    <td colspan='3' class='x99' style='border-right:1px solid windowtext;border-bottom:1px solid windowtext;'>Pengulangan 2</td>
    <td colspan='4' class='x100' style='border-right:1px solid windowtext;border-bottom:1px solid windowtext;'>Pengulangan 3</td>
    <td colspan='3' class='x99' style='border-right:1px solid windowtext;border-bottom:1px solid windowtext;'>Pengulangan 4</td>
    <td colspan='3' class='x99' style='border-right:1px solid windowtext;border-bottom:1px solid windowtext;'>Pengulangan 5</td>
  </tr>
  <tr class='x21' style='height:16.5pt'>
    <td class='x63'>menit</td>
    <td class='x63'>second</td>
    <td class='x63'>milisecond</td>
    <td class='x63'>menit</td>
    <td class='x63'>second</td>
    <td class='x63'>milisecond</td>
    <td class='x63'>menit</td>
    <td class='x63'>second</td>
    <td colspan='2' class='x131' style='border-right:1px solid windowtext;border-bottom:1px solid windowtext;'>milisecond</td>
    <td class='x63'>menit</td>
    <td class='x63'>second</td>
    <td class='x63'>milisecond</td>
    <td class='x63'>menit</td>
    <td class='x63'>second</td>
    <td class='x63' style='border-right:1px solid windowtext;'>milisecond</td>
  </tr>

  <!-- LOOPING DATA ROW -->
  <?php for ($i = 1; $i <= 10; $i++): ?>
    <!-- Baris Standar -->
    <tr class='x21' style='height:19.5pt'>
      <td rowspan='2' class='x121' style='border-bottom:1px solid windowtext;height:37.5pt;'>
        <input type="text"  name="titik_ukur_<?php echo $i; ?>" placeholder="..." style="width:80%; border:none; background:transparent; text-align:center;">
      </td>
      <td class='x53'>Standar</td>
      <?php for ($pengulangan = 1; $pengulangan <= 5; $pengulangan++): ?>
        <?php 
          // Pengulangan 3 memiliki colspan 2 untuk milisecond
          $colspan = ($pengulangan == 3) ? 2 : 1;
        ?>
        <td class='x53'>
          <input type="number" step="any" name="standar_<?php echo $i; ?>_p<?php echo $pengulangan; ?>_menit" placeholder="..." style="width:80%; border:none; background:transparent; text-align:center;">
        </td>
        <td class='x53'>
          <input type="number" step="any" name="standar_<?php echo $i; ?>_p<?php echo $pengulangan; ?>_second" placeholder="..." style="width:80%; border:none; background:transparent; text-align:center;">
        </td>
        <td class='x53' <?php echo ($pengulangan == 3) ? 'colspan="2"' : ''; ?>>
          <input type="number" step="any" name="standar_<?php echo $i; ?>_p<?php echo $pengulangan; ?>_milisecond" placeholder="..." style="width:80%; border:none; background:transparent; text-align:center;">
        </td>
      <?php endfor; ?>
    </tr>
    
    <!-- Baris Alat (UUT) -->
    <tr class='x21' style='height:19.5pt'>
      <td class='x78'>Alat (UUT)</td>
      <?php for ($pengulangan = 1; $pengulangan <= 5; $pengulangan++): ?>
        <td class='x78'>
          <input type="number" step="any" name="alat_<?php echo $i; ?>_p<?php echo $pengulangan; ?>_menit" placeholder="..." style="width:80%; border:none; background:transparent; text-align:center;">
        </td>
        <td class='x78'>
          <input type="number" step="any" name="alat_<?php echo $i; ?>_p<?php echo $pengulangan; ?>_second" placeholder="..." style="width:80%; border:none; background:transparent; text-align:center;">
        </td>
        <td class='x78' <?php echo ($pengulangan == 3) ? 'colspan="2"' : ''; ?>>
          <input type="number" step="any" name="alat_<?php echo $i; ?>_p<?php echo $pengulangan; ?>_milisecond" placeholder="..." style="width:80%; border:none; background:transparent; text-align:center;">
        </td>
      <?php endfor; ?>
    </tr>
  <?php endfor; ?>
</table>
      </div>
      
      <div class="container">
        <strong>Catatan:</strong>
        </div>
        
      <div class="container">
          <textarea name="catatan" placeholder="Tuliskan catatan di sini..."></textarea>
        
      </div>





                <!-- Footer Section -->

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Footer Kalibrasi Roughness Tester</title>
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      padding: 20px;
      background-color: #f9f9f9;
    }
    table {
      width: 100%;
      max-width: 1100px;
      margin: 20px auto;
      border-collapse: collapse;
      background-color: #fff;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    td {
      border: 1px solid #000;
      padding: 12px;
      text-align: center;
      vertical-align: middle;
    }
    .title {
      font-weight: bold;
      font-size: 18px;
      background-color: #f0f0f0;
    }
    .label {
      font-weight: bold;
      background-color: #e0e0e0;
    }
    input[type="text"] {
      width: 95%;
      border: none;
      background: transparent;
      text-align: center;
      padding: 5px;
      font-size: 12pt;
    }
    input[type="text"]:focus {
      outline: 2px solid #4a90e2;
      background-color: #f0f8ff;
    }
    /* Area TTD tanpa garis bawah + ruang tinggi untuk tanda tangan */
    .signature-box {
      height: 120px;
      vertical-align: top;
      text-align: left;
      padding: 15px 20px 10px;
      border-bottom: none !important;
    }
    .empty-row {
      height: 20px;
      border: none;
    }
    @media print {
      body { background: white; padding: 10px; }
      table { box-shadow: none; }
    }
  </style>

 <!-- Jarak besar sebelum footer (sudah termasuk di margin-bottom di atas + margin-top di tabel) -->

<!-- Footer Section: Tabel Informasi Alat & Tanda Tangan -->
<table cellspacing="0" cellpadding="8" style="width:100%; border-collapse:collapse; font-family: Arial, sans-serif; font-size:12pt; margin-top: 40px;">
    <tr style="height: 40pt;">
        <td colspan="5" style="border-bottom: 1pt solid #000; text-align: center; vertical-align: middle; background-color: #f5f5f5;">
            <span style="font-size: 18pt; font-weight: bold;">
                Isilah lembar data kalibrasi dengan lengkap dan jelas!
            </span>
        </td>
    </tr>

    <!-- Header Kolom -->
    <tr style="height: 35pt;">
        <td rowspan="3" style="width: 20%; border: 1pt solid #000; text-align: center; vertical-align: middle; font-weight: bold; font-size: 12pt; background-color: #f0f0f0;">
            Standard
        </td>
        <td colspan="2" style="width: 40%; border: 1pt solid #000; text-align: center; vertical-align: middle; font-size: 12pt; background-color: #f0f0f0;">
           
        </td>
        <td style="width: 20%; border: 1pt solid #000; text-align: center; vertical-align: middle; font-size: 12pt; font-weight: bold; background-color: #f0f0f0;">
            Dikalibrasi oleh
        </td>
        <td style="width: 20%; border: 1pt solid #000; text-align: center; vertical-align: middle; font-size: 12pt; font-weight: bold; background-color: #f0f0f0;">
            Diperiksa oleh
        </td>
    </tr>

    <!-- Baris 1: P.002 (kosong tanpa garis horizontal di kolom TTD) -->
    <tr style="height: 40pt;">
        <td style="width: 5%; border: 1pt solid #000; text-align: center; vertical-align: middle;">
            <input type="checkbox" name="alat_standar[]" value="Digital Stopwatch, Casio (WF.002)" style="width: 18pt; height: 18pt; cursor: pointer;">
        </td>
        <td style="border: 1pt solid #000; padding-left: 15pt; font-size: 11pt; vertical-align: middle;text-align: left;">
           Digital Stopwatch, Casio (WF.002)
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none;"></td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none;"></td>
    </tr>

    <!-- Baris 2: P.003 + TTD (tanpa garis atas & bawah pada sel TTD) -->
    <tr style="height: 60pt;">
        <td style="border: 1pt solid #000; text-align: center; vertical-align: middle;">
            <input type="checkbox" name="alat_standar[]" value="Digital Stopwatch, Casio (WF.003)" style="width: 18pt; height: 18pt; cursor: pointer;">
        </td>
        <td style="border: 1pt solid #000; padding-left: 15pt; font-size: 11pt; vertical-align: middle;text-align: left;">
            Digital Stopwatch, Casio (WF.003)
        </td>
        <!-- Hapus garis atas dan bawah sepenuhnya pada sel TTD -->
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none; padding: 10pt 0; vertical-align: top; font-size: 11pt; text-align: left;">
            TTD
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-top: none; border-bottom: none; padding: 10pt 0; vertical-align: top; font-size: 11pt; text-align: left;">
            TTD
        </td>
    </tr>

    <!-- Baris 3: Metode Kalibrasi + Nama -->
    <tr style="height: 60pt;">
        <td style="border: 1pt solid #000; text-align: center; vertical-align: middle; font-weight: bold; font-size: 12pt; background-color: #f0f0f0;">
            Metode Kalibrasi
        </td>
        <td colspan="2" style="border: 1pt solid #000; padding-left: 15pt; font-size: 11pt; vertical-align: middle;text-align: left;">
            PAS-IK1102-45
        </td>
        <!-- Hapus border atas pada sel Nama -->
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-bottom: 1pt solid #000; border-top: none; padding: 10pt; vertical-align: left; font-size: 11pt;">
            Nama : 
            <input type="text" name="calibrated_by" 
                   style="width: 75%; border: none; border-bottom: 2px solid #000; font-size: 11pt; padding: 5px 0; background: transparent;" 
                 >
        </td>
        <td style="border-left: 1pt solid #000; border-right: 1pt solid #000; border-bottom: 1pt solid #000; border-top: none; padding: 10pt; vertical-align: left; font-size: 11pt;">
            Nama : 
            <input type="text" name="verified_by" 
                   style="width: 75%; border: none; border-bottom: 2px solid #000; font-size: 11pt; padding: 5px 0; background: transparent;" 
                  >
        </td>
    </tr>
</table>


                <!-- Submit Button Section -->
                <div class="row mt-5">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary btn-lg" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
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
    
<script>
// JavaScript form validation
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('kalibrasiForm');
    
    form.addEventListener('submit', function(e) {
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.style.borderColor = '#dc3545';
            }
        });

        if (!isValid) {
            e.preventDefault();
            alert('Harap isi semua field yang wajib diisi!');
            return;
        }

        const alatStandar = form.querySelectorAll('input[name="alat_standar[]"]:checked');
        if (alatStandar.length === 0) {
            e.preventDefault();
            alert('Pilih minimal 1 alat standar!');
            return;
        }

        const submitBtn = form.querySelector('button[type="submit"]');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
        submitBtn.disabled = true;
    });
});
</script>

 <script>
    function updateFormType(selectedAlat) {
        // Normalize input (case-insensitive)
        const alat = selectedAlat.toLowerCase().trim();
        
        // SEMUA alat menggunakan form_type 'enclosure'
        const formTypeMap = {
            'stopwatch': 'stopwatch',
            'stopwatch digital': 'stopwatch',
            // Tidak perlu 'enclosure' karena tidak ada di dropdown
        };
        
        // Update hidden input
        const formTypeInput = document.getElementById('form_type_input');
        if (formTypeMap[alat]) {
            formTypeInput.value = formTypeMap[alat];
            console.log('✅ Form type set to: enclosure for alat:', selectedAlat);
        } else {
            formTypeInput.value = '';
            console.warn('⚠️ No form type mapping for:', selectedAlat);
        }
    }
</script>

<script>
// Fungsi untuk update kapasitas secara real-time dari range max
function updateKapasitas() {
    const maxInput = document.getElementById('rentang_ukur_max');
    const kapasitasInput = document.getElementById('kapasitas');
    
    // Ambil nilai dari rentang max
    const maxValue = parseFloat(maxInput.value);
    
    // Update kapasitas dengan nilai dari rentang max
    if (!isNaN(maxValue)) {
        // Format angka dengan 1 digit desimal
        kapasitasInput.value = maxValue.toFixed(1);
    } else {
        kapasitasInput.value = '';
    }
}

// Event listener saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    const maxInput = document.getElementById('rentang_ukur_max');
    
    // Tambahkan event listener untuk paste event juga
    maxInput.addEventListener('paste', function(e) {
        // Biarkan paste terjadi, lalu update kapasitas setelah 10ms
        setTimeout(updateKapasitas, 10);
    });
    
    // Juga update saat halaman pertama kali dimuat (jika ada nilai default di range max)
    updateKapasitas();
});
</script>



<script>
// Fungsi format Type Alat - menerima huruf, angka, titik, koma, dash, slash, spasi
function formatTypeAlat(input) {
    // Izinkan: huruf, angka, titik, koma, dash, slash, spasi, kurung, tanda petik
    // Tidak perlu mengubah value, hanya validasi input
    const regex = /[^A-Za-z0-9\s.,\-\/()"'&]/g;
    if (regex.test(input.value)) {
        input.value = input.value.replace(regex, '');
    }
}

// Fungsi format No. Seri - menerima huruf, angka, titik, koma, dash, slash
function formatNoSeri(input) {
    // Izinkan: huruf, angka, titik, koma, dash, slash
    // Tidak perlu mengubah value, hanya validasi input
    const regex = /[^A-Za-z0-9.,\-\/]/g;
    if (regex.test(input.value)) {
        input.value = input.value.replace(regex, '');
    }
}
</script>


<script>
// Fungsi untuk format input number yang bisa menerima koma
function formatNumberInput(input) {
    // Ambil nilai input
    let value = input.value;
    
    // Ganti koma dengan titik (untuk browser yang mengizinkan koma)
    value = value.replace(',', '.');
    
    // Jika ada lebih dari satu titik, hapus yang berlebih
    const dotCount = (value.match(/\./g) || []).length;
    if (dotCount > 1) {
        // Simpan bagian sebelum titik pertama dan setelah titik terakhir
        const firstPart = value.substring(0, value.indexOf('.') + 1);
        const lastPart = value.substring(value.lastIndexOf('.') + 1);
        value = firstPart + lastPart.replace(/\./g, '');
    }
    
    // Update nilai input jika ada perubahan
    if (value !== input.value) {
        input.value = value;
    }
}

// Event listener untuk menangani paste
document.addEventListener('DOMContentLoaded', function() {
    const numberInputs = document.querySelectorAll('input[type="number"]');
    
    numberInputs.forEach(input => {
        input.addEventListener('paste', function(e) {
            // Biarkan paste terjadi dulu
            setTimeout(() => {
                formatNumberInput(this);
            }, 10);
        });
    });
});
</script>

</body>

</html>