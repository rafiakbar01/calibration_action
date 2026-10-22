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
    @php 
        $count = isset($count) ? (int)$count : 1; 
        $count = max(1, $count); 
    @endphp
    
    @for($formIndex = 1; $formIndex <= $count; $formIndex++)
        @php
            $isFirstForm = ($formIndex == 1);
            $tabId = $tabId ?? request()->query('tab_id', 1);
        @endphp
        
        @if($count > 1)
        <div style="background: linear-gradient(135deg,#1e40af,#3b82f6); color:#fff; padding:10px 20px; margin: 16px 0 0; border-radius:8px 8px 0 0; font-weight:bold; font-size:16px;">
            <i class="fas fa-file-alt" style="margin-right:8px;"></i>Form Conductivity Meter ke-{{ $formIndex }}
            @if(!$isFirstForm)
            <span style="font-size:12px; margin-left:10px;">
                <i class="fas fa-info-circle"></i> Field informasi alat mengikuti Form 1
            </span>
            @endif
        </div>
        @endif
        
        <div class="w-100 my-4" style="@if($count > 1) padding-bottom:24px; @endif">
            <form method="POST" action="/calibrations" id="kalibrasiForm{{ $formIndex }}" data-form-index="{{ $formIndex }}">
                @csrf
                <input type="hidden" name="form_type" value="conductivity_meter">
                <input type="hidden" name="jumlah_form" value="{{ $count }}">
                <input type="hidden" name="form_index" value="{{ $formIndex }}">
                <input type="hidden" name="no_label" id="no_label_hidden{{ $formIndex }}" value="">
                
                @if(!$isFirstForm)
                    <!-- Hidden fields untuk data yang mengikuti form 1 -->
                    <input type="hidden" name="nama_alat" id="nama_alat_hidden_{{ $formIndex }}" value="">
                    <input type="hidden" name="merek" id="merek_hidden_{{ $formIndex }}" value="">
                    <input type="hidden" name="kode_alat" id="kode_alat_hidden_{{ $formIndex }}" value="">
                    <input type="hidden" name="type_alat" id="type_alat_hidden_{{ $formIndex }}" value="">
                    <input type="hidden" name="no_seri" id="no_seri_hidden_{{ $formIndex }}" value="">
                    <input type="hidden" name="nama_pemilik" id="nama_pemilik_hidden_{{ $formIndex }}" value="">
                    <input type="hidden" name="tanggal_alat_masuk" id="tanggal_alat_masuk_hidden_{{ $formIndex }}" value="">
                    <input type="hidden" name="tanggal_kalibrasi" id="tanggal_kalibrasi_hidden_{{ $formIndex }}" value="">
                    <input type="hidden" name="jenis_pembacaan" id="jenis_pembacaan_hidden_{{ $formIndex }}" value="digital">
                    <input type="hidden" name="tempat_kalibrasi" id="tempat_kalibrasi_hidden_{{ $formIndex }}" value="">
                    <input type="hidden" name="lokasi_pt" id="lokasi_pt_hidden_{{ $formIndex }}" value="">
                    <input type="hidden" name="fungsi_komponen" id="fungsi_komponen_hidden_{{ $formIndex }}" value="">
                    <input type="hidden" name="suhu_awal" id="suhu_awal_hidden_{{ $formIndex }}" value="">
                    <input type="hidden" name="suhu_tengah" id="suhu_tengah_hidden_{{ $formIndex }}" value="">
                    <input type="hidden" name="suhu_akhir" id="suhu_akhir_hidden_{{ $formIndex }}" value="">
                    <input type="hidden" name="rh_awal" id="rh_awal_hidden_{{ $formIndex }}" value="">
                    <input type="hidden" name="rh_tengah" id="rh_tengah_hidden_{{ $formIndex }}" value="">
                    <input type="hidden" name="rh_akhir" id="rh_akhir_hidden_{{ $formIndex }}" value="">
                    <input type="hidden" name="calibrated_by" value="{{ auth()->user()->nama ?? 'System' }}">
                    <input type="hidden" name="verified_by" id="verified_by_hidden_{{ $formIndex }}" value="">
                @endif
        
                <div class="form-kalibrasi-container">
                <table class="kalibrasi-header-table">
                    <tr>
                        <td colspan="2">
                            <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK41</p>
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
                            <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">CONDUCTIVITY METER</p>
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
                            @if($isFirstForm)
                                <select name="nama_alat" id="nama_alat_select_{{ $formIndex }}_tab{{ $tabId }}" class="kalibrasi-input" onchange="updateFormType(this.value, {{ $formIndex }})" required style="background-color: #f5f5f5; color: #333; border: 1px solid #ced4da; padding: 6px 10px; border-radius: 4px; width: 100%;">
                                    <option value="">-- Pilih Alat --</option>
                                    <option value="Conductivity Meter" selected>Conductivity Meter</option>
                                    <option value="MANUAL_INPUT">-- Input Manual Nama Alat --</option>
                                </select>
                                
                                <div id="manualInputContainer_{{ $formIndex }}" style="display: none; margin-top: 10px;">
                                    <input type="text" name="nama_alat_manual" id="nama_alat_manual_{{ $formIndex }}"
                                           placeholder="Ketik nama alat secara manual"
                                           style="background-color: #f5f5f5; color: #333; border: 1px solid #ced4da; padding: 6px 10px; border-radius: 4px; width: 100%;"
                                           oninput="syncNamaAlat({{ $formIndex }})">
                                </div>
                                
                                <input type="hidden" name="nama_alat_final" id="nama_alat_final_{{ $formIndex }}" value="">
                                <input type="hidden" name="nama_alat_display" id="nama_alat_display_{{ $formIndex }}" value="">
                            @else
                                <input type="text" name="nama_alat_copy" id="nama_alat_copy_{{ $formIndex }}" class="kalibrasi-input disabled-field" readonly disabled placeholder="Mengikuti Form 1" style="background-color: #e9ecef;">
                                <input type="hidden" name="nama_alat" id="nama_alat_hidden_{{ $formIndex }}" value="">
                                <div class="info-copy" style="font-size: 11px; color: #6c757d; margin-top: 4px;">
                                    <i class="fas fa-copy"></i> Nama alat akan mengikuti isian Form 1
                                </div>
                            @endif
                        </td>
                    </tr>

                    <!-- Merek & Kode Alat -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Merek</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                @if($isFirstForm)
                                    <input type="text" name="merek" id="merek_{{ $formIndex }}" class="kalibrasi-input me-3" placeholder="Masukkan merek alat" style="width: 60%;" required>
                                    <span class="me-3" style="color: #000000;">Kode Alat :</span>
                                    <input type="text" name="kode_alat" id="kode_alat_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan kode" style="width: 30%;">
                                @else
                                    <input type="text" name="merek_display" id="merek_{{ $formIndex }}" class="kalibrasi-input me-3 disabled-field" placeholder="Mengikuti Form 1" style="width: 60%; background-color: #e9ecef;" readonly disabled>
                                    <span class="me-3" style="color: #000000;">Kode Alat :</span>
                                    <input type="text" name="kode_alat_display" id="kode_alat_{{ $formIndex }}" class="kalibrasi-input disabled-field" placeholder="Mengikuti Form 1" style="width: 30%; background-color: #e9ecef;" readonly disabled>
                                @endif
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
                                @if($isFirstForm)
                                    <input type="text" name="type_alat" id="type_alat_{{ $formIndex }}" class="kalibrasi-input me-3" placeholder="Masukkan Type Alat" style="width: 45%;" oninput="formatTypeAlat(this)">
                                    <span class="me-3" style="color: #000000;">/</span>
                                    <input type="text" name="no_seri" id="no_seri_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan No. Seri" style="width: 45%;" oninput="formatNoSeri(this)" required>
                                @else
                                    <input type="text" name="type_alat_display" id="type_alat_{{ $formIndex }}" class="kalibrasi-input me-3 disabled-field" placeholder="Mengikuti Form 1" style="width: 45%; background-color: #e9ecef;" readonly disabled>
                                    <span class="me-3" style="color: #000000;">/</span>
                                    <input type="text" name="no_seri_display" id="no_seri_{{ $formIndex }}" class="kalibrasi-input disabled-field" placeholder="Mengikuti Form 1" style="width: 45%; background-color: #e9ecef;" readonly disabled>
                                @endif
                            </div>
                        </td>
                    </tr>

                    <!-- Kapasitas / Resolusi -->
                      <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Kapasitas / Resolusi</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" name="kapasitas_{{ $formIndex }}" id="kapasitas_{{ $formIndex }}" class="kalibrasi-input me-3" placeholder="Masukkan kapasitas" style="width: 45%;" required>
                                <span class="me-3" style="color: #000000;">/</span>
                                <input type="text" name="resolusi_{{ $formIndex }}" id="resolusi_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan Resolusi" style="width: 45%;" required>
                            </div>
                        </td>
                    </tr>

                    <!-- Nama Pemilik -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Nama Pemilik</p>
                        </td>
                        <td colspan="3">
                            @if($isFirstForm)
                                <input type="text" name="nama_pemilik" id="nama_pemilik_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan nama pemilik / instansi" required>
                            @else
                                <input type="text" name="nama_pemilik_display" id="nama_pemilik_{{ $formIndex }}" class="kalibrasi-input disabled-field" placeholder="Mengikuti Form 1" style="background-color: #e9ecef;" readonly disabled>
                            @endif
                        </td>
                    </tr>

                    <!-- Tanggal Alat Masuk & Kalibrasi -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Tanggal Alat Masuk</p>
                        </td>
                        <td colspan="3">
                            @if($isFirstForm)
                                <input type="date" name="tanggal_alat_masuk" id="tanggal_alat_masuk_{{ $formIndex }}" class="kalibrasi-input" value="{{ date('Y-m-d') }}" required>
                            @else
                                <input type="date" name="tanggal_alat_masuk_display" id="tanggal_alat_masuk_{{ $formIndex }}" class="kalibrasi-input disabled-field" style="background-color: #e9ecef;" readonly disabled>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Tanggal Kalibrasi</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                @if($isFirstForm)
                                    <input type="date" name="tanggal_kalibrasi" id="tanggal_kalibrasi_{{ $formIndex }}" class="kalibrasi-input me-3" style="width: 45%;" required value="{{ date('Y-m-d') }}">
                                    <span class="me-3" style="color: #000000;">Jenis Pembacaan:</span>
                                    <select name="jenis_pembacaan" id="jenis_pembacaan_{{ $formIndex }}" class="kalibrasi-input" style="width: 45%;">
                                        <option value="">-- Pilih --</option>
                                        <option value="manual">Manual</option>
                                        <option value="digital" selected>Digital</option>
                                    </select>
                                @else
                                    <input type="date" name="tanggal_kalibrasi_display" id="tanggal_kalibrasi_{{ $formIndex }}" class="kalibrasi-input me-3 disabled-field" style="width: 45%; background-color: #e9ecef;" readonly disabled>
                                    <span class="me-3" style="color: #000000;">Jenis Pembacaan:</span>
                                    <select name="jenis_pembacaan_display" id="jenis_pembacaan_{{ $formIndex }}" class="kalibrasi-input disabled-field" style="width: 45%; background-color: #e9ecef;" disabled>
                                        <option value="digital" selected>Digital</option>
                                    </select>
                                @endif
                            </div>
                        </td>
                    </tr>

                    <!-- Tempat Kalibrasi -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Tempat Kalibrasi</p>
                        </td>
                        <td colspan="3">
                            @if($isFirstForm)
                                <div class="d-flex">
                                    <div class="form-check me-5">
                                        <input class="form-check-input" type="radio" name="tempat_kalibrasi" value="lab.PT PAS" id="lab_{{ $formIndex }}" required>
                                        <label class="form-check-label" for="lab_{{ $formIndex }}" style="color: #000000;">Lab. PT.PAS</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tempat_kalibrasi" value="insitu" id="insitu_{{ $formIndex }}" required>
                                        <label class="form-check-label" for="insitu_{{ $formIndex }}" style="color: #000000;">Insitu</label>
                                    </div>
                                </div>
                            @else
                                <div class="d-flex">
                                    <div class="form-check me-5">
                                        <input class="form-check-input" type="radio" name="tempat_kalibrasi_display" value="lab.PT PAS" id="lab_{{ $formIndex }}" disabled>
                                        <label class="form-check-label" for="lab_{{ $formIndex }}" style="color: #999;">Lab. PT.PAS</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tempat_kalibrasi_display" value="insitu" id="insitu_{{ $formIndex }}" disabled>
                                        <label class="form-check-label" for="insitu_{{ $formIndex }}" style="color: #999;">Insitu</label>
                                    </div>
                                </div>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Lokasi PT</p>
                        </td>
                        <td colspan="3">
                            @if($isFirstForm)
                                <input type="text" name="lokasi_pt" id="lokasi_pt_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan Lokasi PT">
                            @else
                                <input type="text" name="lokasi_pt_display" id="lokasi_pt_{{ $formIndex }}" class="kalibrasi-input disabled-field" placeholder="Mengikuti Form 1" style="background-color: #e9ecef;" readonly disabled>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Kode TH</p>
                        </td>
                        <td colspan="3">
                            @if($isFirstForm)
                                <input type="text" name="kode_th" id="kode_th_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan Kode TH">
                            @else
                                <input type="text" name="kode_th_display" id="kode_th_{{ $formIndex }}" class="kalibrasi-input disabled-field" placeholder="Mengikuti Form 1" style="background-color: #e9ecef;" readonly disabled>
                            @endif
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
                                @if($isFirstForm)
                                    <input type="radio" name="fungsi_komponen" value="ok" style="transform: scale(1.5); margin: 10px 0;" required>
                                @else
                                    <input type="radio" name="fungsi_komponen_display" value="ok" style="transform: scale(1.5); margin: 10px 0;" disabled>
                                @endif
                            </div>
                            <div class="text-center">
                                <span class="fw-bold d-block" style="color: #000000;">Rusak</span>
                                @if($isFirstForm)
                                    <input type="radio" name="fungsi_komponen" value="rusak" style="transform: scale(1.5); margin: 10px 0;" required>
                                @else
                                    <input type="radio" name="fungsi_komponen_display" value="rusak" style="transform: scale(1.5); margin: 10px 0;" disabled>
                                @endif
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center mt-4">
                            <span class="fw-bold me-3" style="color: #000000;">Keterangan :</span>
                            <div style="flex: 1; border-bottom: 2px solid #000;">
                                <input type="text" name="keterangan_fungsi_komponen" id="keterangan_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan Keterangan" style="border: none;">
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
                                <td><input type="text" name="suhu_awal" id="suhu_awal_{{ $formIndex }}" class="kondisi-input" placeholder="0.0" {{ $isFirstForm ? 'required' : 'disabled' }}></td>
                                <td><input type="text" name="suhu_tengah" id="suhu_tengah_{{ $formIndex }}" class="kondisi-input" placeholder="0.0" {{ $isFirstForm ? 'required' : 'disabled' }}></td>
                                <td><input type="text" name="suhu_akhir" id="suhu_akhir_{{ $formIndex }}" class="kondisi-input" placeholder="0.0" {{ $isFirstForm ? 'required' : 'disabled' }}></td>
                            </tr>
                            <tr>
                                <td class="bg-light fw-bold" style="color: #000000;">RH (%)</td>
                                <td><input type="text" name="rh_awal" id="rh_awal_{{ $formIndex }}" class="kondisi-input" placeholder="0.0" {{ $isFirstForm ? 'required' : 'disabled' }}></td>
                                <td><input type="text" name="rh_tengah" id="rh_tengah_{{ $formIndex }}" class="kondisi-input" placeholder="0.0" {{ $isFirstForm ? 'required' : 'disabled' }}></td>
                                <td><input type="text" name="rh_akhir" id="rh_akhir_{{ $formIndex }}" class="kondisi-input" placeholder="0.0" {{ $isFirstForm ? 'required' : 'disabled' }}></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Data Kalibrasi Section -->
                <div class="data-kalibrasi-header" style="color: #000000;">DATA KALIBRASI</div>
                
           <table cellspacing="0" cellpadding="0" class="TableNormal" style="width:100%; border:1pt solid #000000; -aw-border-insideh:1pt solid #000000; -aw-border-insidev:1pt solid #000000; border-collapse:collapse; font-size:12pt; margin: 15px 0;">
                        <!-- Header Row 1 -->
                        <tr style="height:20pt">
                        <td style="width:18%; border-right:1pt solid #000000; vertical-align:middle; text-align:center">
                            <span style="font-family:Arial; font-weight:bold; font-size:11pt">Nilai CRM</span>
                        </td>
                        <td colspan="5" style="width:48%; border:1pt solid #000000; border-bottom:1pt solid #000000; vertical-align:middle; text-align:center">
                            <span style="font-family:Arial; font-weight:bold; font-size:11pt">Pembacaan Alat</span>
                        </td>
                        <td rowspan="2" style="width:17%; border:1pt solid #000000; vertical-align:middle; text-align:center">
                            <span style="font-family:Arial; font-weight:bold; font-size:11pt">Resolusi</span>
                        </td>
                        <td style="width:17%; border-left:1pt solid #000000; vertical-align:middle; text-align:center">
                            <span style="font-family:Arial; font-weight:bold; font-size:11pt">Suhu CRM</span>
                        </td>
                        </tr>
                        
                        <!-- Header Row 2 -->
                        <tr style="height:20pt">
                        <td style="border-right:1pt solid #000000; border-bottom:1pt solid #000000; vertical-align:middle; text-align:center">
                            <span style="font-family:Arial; font-weight:bold; font-size:10pt"></span>
                        </td>
                        <td style="width:9.6%; border:1pt solid #000000; vertical-align:middle; text-align:center">
                            <span style="font-family:Arial; font-weight:bold; font-size:11pt">1</span>
                        </td>
                        <td style="width:9.6%; border:1pt solid #000000; vertical-align:middle; text-align:center">
                            <span style="font-family:Arial; font-weight:bold; font-size:11pt">2</span>
                        </td>
                        <td style="width:9.6%; border:1pt solid #000000; vertical-align:middle; text-align:center">
                            <span style="font-family:Arial; font-weight:bold; font-size:11pt">3</span>
                        </td>
                        <td style="width:9.6%; border:1pt solid #000000; vertical-align:middle; text-align:center">
                            <span style="font-family:Arial; font-weight:bold; font-size:11pt">4</span>
                        </td>
                        <td style="width:9.6%; border:1pt solid #000000; vertical-align:middle; text-align:center">
                            <span style="font-family:Arial; font-weight:bold; font-size:11pt">5</span>
                        </td>
                        <td style="border-left:1pt solid #000000; border-bottom:1pt solid #000000; vertical-align:middle; text-align:center">
                            <span style="font-family:Arial; font-weight:bold; font-size:11pt"><sup>o</sup>C</span>
                        </td>
                        </tr>
                        
                        <!-- Data Rows - PHP Loop untuk 6 baris -->
                        <?php
                        $isFirstForm = $isFirstForm ?? ($formIndex == 1);
                        for ($row = 1; $row <= 6; $row++) {
                            // Tentukan style untuk baris terakhir
                            $isLastRow = ($row == 6);
                            
                            // Style untuk sel pertama (Nilai CRM)
                            $firstCellStyle = "width:18%; border-right:1pt solid #000000;";
                            if ($row == 1) {
                                $firstCellStyle .= " border-top:1pt solid #000000;";
                            }
                            if (!$isLastRow) {
                                $firstCellStyle .= " border-bottom:1pt solid #000000;";
                            }
                            $firstCellStyle .= " vertical-align:middle;";
                            
                            // Style untuk sel tengah (Pembacaan 1-5)
                            $middleCellStyle = "width:9.6%; border:1pt solid #000000;";
                            if (!$isLastRow) {
                                $middleCellStyle .= " border-bottom:1pt solid #000000;";
                            }
                            $middleCellStyle .= " vertical-align:middle;";
                            
                            // Style untuk sel resolusi
                            $resolusiStyle = "width:17%; border:1pt solid #000000;";
                            if (!$isLastRow) {
                                $resolusiStyle .= " border-bottom:1pt solid #000000;";
                            }
                            $resolusiStyle .= " vertical-align:middle;";
                            
                            // Style untuk sel terakhir (Suhu)
                            $lastCellStyle = "width:17%; border-left:1pt solid #000000;";
                            if ($row == 1) {
                                $lastCellStyle .= " border-top:1pt solid #000000;";
                            }
                            if (!$isLastRow) {
                                $lastCellStyle .= " border-bottom:1pt solid #000000;";
                            }
                            $lastCellStyle .= " vertical-align:middle;";
                            
                            // Input style yang konsisten
                            $inputStyle = "width:100%; height:60px; border:none; font-family:'Times New Roman'; font-size:14pt; text-align:center; box-sizing:border-box; background:transparent; outline:none; padding:5px;";
                            
                            echo '<tr style="height:60pt">';
                    
                            // Kolom 1: Nilai CRM - Sesuai dengan store: "nilai_crm_{$i}_{$formIndex}"
                            $nameNilaiCRM = 'nilai_crm_' . $row . '_' . $formIndex;
                            echo '<td style="' . $firstCellStyle . '">';
                            echo '<input type="text" name="' . $nameNilaiCRM . '" id="' . $nameNilaiCRM . '" style="' . $inputStyle . '">';
                            if ($isFirstForm) {
                                echo '<input type="hidden" name="nilai_crm_' . $row . '" id="nilai_crm_' . $row . '">';
                            }
                            echo '</td>';
                            
                            // Kolom 2-6: Pembacaan Alat 1-5 - Sesuai dengan store: "pembacaan_{$i}_{$j}_{$formIndex}"
                            for ($col = 1; $col <= 5; $col++) {
                                $namePembacaan = 'pembacaan_' . $row . '_' . $col . '_' . $formIndex;
                                echo '<td style="' . $middleCellStyle . '">';
                                echo '<input type="text" name="' . $namePembacaan . '" id="' . $namePembacaan . '" style="' . $inputStyle . '">';
                                if ($isFirstForm) {
                                    echo '<input type="hidden" name="pembacaan_' . $row . '_' . $col . '" id="pembacaan_' . $row . '_' . $col . '">';
                                }
                                echo '</td>';
                            }
                            
                            // Kolom 7: Resolusi - Sesuai dengan store: "resolusi_{$i}_{$formIndex}"
                            $nameResolusi = 'resolusi_' . $row . '_' . $formIndex;
                            echo '<td style="' . $resolusiStyle . '">';
                            echo '<input type="text" name="' . $nameResolusi . '" id="' . $nameResolusi . '" style="' . $inputStyle . '">';
                            if ($isFirstForm) {
                                echo '<input type="hidden" name="resolusi_row_' . $row . '" id="resolusi_row_' . $row . '">';
                            }
                            echo '</td>';
                            
                            // Kolom 8: Suhu CRM - Sesuai dengan store: "suhu_crm_{$i}_{$formIndex}"
                            $nameSuhuCRM = 'suhu_crm_' . $row . '_' . $formIndex;
                            echo '<td style="' . $lastCellStyle . '">';
                            echo '<input type="text" name="' . $nameSuhuCRM . '" id="' . $nameSuhuCRM . '" style="' . $inputStyle . '">';
                            if ($isFirstForm) {
                                echo '<input type="hidden" name="suhu_crm_' . $row . '" id="suhu_crm_' . $row . '">';
                            }
                            echo '</td>';
                            
                            echo '</tr>';
                        }
                        ?>
                    </table>

                <p style="margin-top:8.8pt; margin-bottom:0.05pt; font-size:10pt">
                    <span style="-aw-import:ignore">&#xa0;</span>
                </p>


              <table cellspacing="0" cellpadding="0" class="TableNormal" style="width:100%; border:0.75pt solid #000000; -aw-border-insideh:0.75pt single #000000; -aw-border-insidev:0.75pt single #000000; border-collapse:collapse; margin-top:20px;">
                        <tr style="height:12.9pt">
                          <td colspan="9" style="width:100%; border-bottom-style:solid; border-bottom-width:0.75pt; vertical-align:top">
                            <p class="TableParagraph" style="margin-left:0.8pt; text-align:center; line-height:11.95pt">
                              <span style="font-family:Arial; font-weight:bold">Isilah</span>
                              <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.45pt"></span>
                              <span style="font-family:Arial; font-weight:bold">lembar</span>
                              <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.5pt"></span>
                              <span style="font-family:Arial; font-weight:bold">data</span>
                              <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.45pt"></span>
                              <span style="font-family:Arial; font-weight:bold">kalibrasi</span>
                              <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.5pt"></span>
                              <span style="font-family:Arial; font-weight:bold">dengan</span>
                              <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.45pt"></span>
                              <span style="font-family:Arial; font-weight:bold">lengkap</span>
                              <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.45pt"></span>
                              <span style="font-family:Arial; font-weight:bold">dan</span>
                              <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.45pt"></span>
                              <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.1pt">jelas!</span>
                            </p>
                          </td>
                        </tr>
                        <tr style="height:14.3pt">
                          <td rowspan="2" style="width:25%; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; vertical-align:top">
                            <p class="TableParagraph" style="margin-top:0.2pt; font-size:9.5pt">
                              <span style="-aw-import:ignore">&#xa0;</span>
                            </p>
                            <p class="TableParagraph" style="margin-left:1.35pt; text-align:center; font-size:9.5pt">
                              <span>Alat</span>
                              <span style="letter-spacing:-0.05pt"></span>
                              <span style="letter-spacing:-0.1pt">Standar</span>
                            </p>
                          </td>
                          <td colspan="6" style="width:45%; border-style:solid; border-width:0.75pt; vertical-align:top; -aw-border-bottom:0.38pt thin-thick-medium-gap #000000">
                            <p class="TableParagraph" style="margin-top:2.2pt; margin-left:1.45pt; font-size:9.5pt">
                              <span>CRM,</span>
                              <span style="letter-spacing:0.05pt"></span>
                              <span style="letter-spacing:-0.1pt">Thermoscientific.</span>
                            </p>
                          </td>
                          <td style="width:15%; border-style:solid; border-width:0.75pt; vertical-align:top">
                            <p class="TableParagraph" style="margin-top:2.1pt; text-align:center; font-size:9.5pt">
                              <span>Dikalibrasi</span>
                              <span style="letter-spacing:0.35pt"></span>
                              <span style="letter-spacing:-0.2pt">oleh</span>
                            </p>
                          </td>
                          <td style="width:15%; border-top-style:solid; border-top-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; vertical-align:top">
                            <p class="TableParagraph" style="margin-top:2.1pt; text-align:center; font-size:9.5pt">
                              <span>Diperiksa</span>
                              <span style="letter-spacing:0.35pt"></span>
                              <span style="letter-spacing:-0.2pt">oleh</span>
                            </p>
                          </td>
                        </tr>
                        <tr style="height:13.6pt">
                          <td style="width:6%; border-style:solid; border-width:0.75pt; vertical-align:top">
                            <p class="TableParagraph" style="margin-top:1.95pt; margin-left:1.45pt; font-size:9.5pt">
                              <span style="letter-spacing:-0.25pt">TES</span>
                            </p>
                          </td>
                          <td style="width:6%; border-style:solid; border-width:0.75pt; vertical-align:top; -aw-border-bottom:0.38pt thick-thin-medium-gap #000000; -aw-border-top:0.38pt thick-thin-medium-gap #000000">
                            <div style="text-align:center; padding:2px">
                              <input type="checkbox" name="alat_standar_{{ $formIndex }}[]" value="TES" id="tes_checkbox_{{ $formIndex }}" style="width:14px; height:14px; margin:0">
                              @if($isFirstForm)
                                <input type="checkbox" name="alat_standar[]" value="TES" id="tes_checkbox" style="display:none;">
                              @endif
                            </div>
                          </td>
                          <td style="width:10.5%; border-style:solid; border-width:0.75pt; vertical-align:top">
                           
                          </td>
                          <td style="width:6%; border-style:solid; border-width:0.75pt; vertical-align:top">
                            <p class="TableParagraph" style="margin-top:1.95pt; margin-left:1.5pt; font-size:9.5pt">
                              <span style="letter-spacing:-0.25pt">TFA</span>
                            </p>
                          </td>
                          <td style="width:6%; border-style:solid; border-width:0.75pt; vertical-align:top; -aw-border-bottom:0.38pt thick-thin-medium-gap #000000; -aw-border-top:0.38pt thick-thin-medium-gap #000000">
                            <div style="text-align:center; padding:2px">
                              <input type="checkbox" name="alat_standar_{{ $formIndex }}[]" value="TFA" id="tfa_checkbox_{{ $formIndex }}" style="width:14px; height:14px; margin:0">
                              @if($isFirstForm)
                                <input type="checkbox" name="alat_standar[]" value="TFA" id="tfa_checkbox" style="display:none;">
                              @endif
                            </div>
                          </td>
                          <td style="width:10.5%; border-style:solid; border-width:0.75pt; vertical-align:top">
                           
                          </td>
                          <td style="width:15%; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; vertical-align:top">
                           
                          </td>
                          <td style="width:15%; border-top-style:solid; border-top-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; vertical-align:top">
                          
                          </td>
                        </tr>
                        <tr style="height:16.95pt">
                          <td rowspan="2" style="width:25%; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; vertical-align:top">
                            <p class="TableParagraph" style="margin-top:9.25pt; text-align:center; font-size:9.5pt">
                              <span>Metode</span>
                              <span style="letter-spacing:-0.1pt"> Kalibrasi</span>
                            </p>
                          </td>
                          <td colspan="6" rowspan="2" style="width:45%; border-style:solid; border-width:0.75pt; vertical-align:top; -aw-border-top:0.38pt thin-thick-medium-gap #000000">
                            <p class="TableParagraph" style="margin-top:9.25pt; margin-left:1.45pt; font-size:9.5pt">
                              <span style="letter-spacing:-0.1pt">PAS-IK1102-</span>
                              <span style="letter-spacing:-0.25pt">41</span>
                            </p>
                            <input type="hidden" name="calibration_method_{{ $formIndex }}" value="PAS-IK1102-41">
                            @if($isFirstForm)
                              <input type="hidden" name="calibration_method" value="PAS-IK1102-41">
                            @endif
                          </td>
                          <td style="width:15%; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; vertical-align:top">
                            <p class="TableParagraph" style="margin-top:4.45pt; text-align:center; font-size:9.5pt">
                              <span style="letter-spacing:-0.5pt">TTD</span>
                            </p>
                          </td>
                          <td style="width:15%; border-left-style:solid; border-left-width:0.75pt; vertical-align:top">
                            <p class="TableParagraph" style="margin-top:4.45pt; text-align:center; font-size:9.5pt">
                              <span style="letter-spacing:-0.5pt">TTD</span>
                            </p>
                          </td>
                        </tr>
                        <tr style="height:12.4pt">
                          <td style="width:15%; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; vertical-align:top">
                            <div style="display:flex; align-items:center; height:100%; padding-left:1.15pt">
                              <span style="font-size:9.5pt; margin-right:4px; font-weight:bold">Nama</span>
                              <span style="font-size:9.5pt; margin-right:2px; font-weight:bold">:</span>
                              <input type="text" name="calibrated_by_{{ $formIndex }}" style="flex:1; border:none; font-size:10pt; font-weight:bold; margin-left:4px; padding:2px 4px" value="{{ auth()->user()->nama ?? 'System' }}" readonly>
                              @if($isFirstForm)
                                <input type="hidden" name="calibrated_by" value="{{ auth()->user()->nama ?? 'System' }}">
                              @endif
                            </div>
                          </td>
                          <td style="width:15%; border-left-style:solid; border-left-width:0.75pt; vertical-align:top">
                            <div style="display:flex; align-items:center; height:100%; padding-left:1.3pt">
                              <span style="font-size:9.5pt; margin-right:4px; font-weight:bold">Nama</span>
                              <span style="font-size:9.5pt; margin-right:2px; font-weight:bold">:</span>
                              <input type="text" name="verified_by_{{ $formIndex }}" id="verified_by_{{ $formIndex }}" style="flex:1; border:none; font-size:10pt; font-weight:bold; margin-left:4px; padding:2px 4px" readonly>
                              @if($isFirstForm)
                                <input type="hidden" name="verified_by" id="verified_by_form1_hidden" value="">
                              @endif
                            </div>
                          </td>
                        </tr>
                    </table>

                    @if($formIndex == $count)
                    <div class="row mt-5">
                        <div class="col-12 text-center">
                            <button type="button" id="btnSimpanSemua" class="btn btn-primary btn-lg" onclick="submitSemuaForm()" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
                                <i class="fas fa-save me-2"></i>Simpan Data Kalibrasi
                            </button>
                        </div>
                    </div>
                    @endif
                </div>
            </form>
        </div>
        @if($count > 1 && $formIndex < $count) 
        <div style="height: 8px;"></div>
        @endif
    @endfor

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
    console.log(`ðŸ”„ Global active tab updated to: ${tabId}`);
}

// ==========================================
// FUNGSI UNTUK MENONAKTIFKAN REQUIRED PADA FORM YANG TIDAK VISIBLE
// ==========================================
function disableRequiredOnHiddenForms() {
    console.log('ðŸ”§ disableRequiredOnHiddenForms called');
    
    const allForms = document.querySelectorAll('form[id^="kalibrasiForm"]');
    
    allForms.forEach((form, index) => {
        const formIndex = index + 1;
        const container = form.closest('.lk-form-container');
        const isVisible = container && window.getComputedStyle(container).display !== 'none';
        
        console.log(`ðŸ“Œ Form ${formIndex}: isVisible=${isVisible}`);
        
        const requiredInputs = form.querySelectorAll('[required]');
        
        if (!isVisible) {
            requiredInputs.forEach(input => {
                console.log(`ðŸ”§ Disabling required for: ${input.name}`);
                input.removeAttribute('required');
                input.setAttribute('data-required-temp', 'true');
            });
        } else {
            requiredInputs.forEach(input => {
                if (input.hasAttribute('data-required-temp')) {
                    console.log(`ðŸ”§ Re-enabling required for: ${input.name}`);
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
// HANDLE SAVE SUCCESS
// ==========================================
window.handleSaveSuccess = function(tabId, data) {
    console.log('ðŸŽ‰ handleSaveSuccess called for tab:', tabId, data);
    
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

    const formName = container.getAttribute('data-form-name') || 'Conductivity Meter';
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
            title: 'âœ“ Data Tersimpan!',
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
// SUBMIT Conductivity Meter - MULTI-FORM SUPPORT
// ==========================================
function getFormCount() {
    const urlParams = new URLSearchParams(window.location.search);
    const countParam = urlParams.get('count');
    if (countParam && !isNaN(parseInt(countParam))) {
        return Math.max(1, parseInt(countParam));
    }
    const existingForms = document.querySelectorAll('form[id^="kalibrasiForm"]');
    if (existingForms.length > 0) {
        return existingForms.length;
    }
    return 1;
}

function getFormValue(form, fieldName) {
    const el = form.querySelector(`[name="${fieldName}"]`);
    if (!el) return '';
    if (el.type === 'radio') {
        const checked = form.querySelector(`[name="${fieldName}"]:checked`);
        return checked ? checked.value : '';
    }
    return el.value || '';
}

function setFormValue(form, fieldName, value) {
    const hiddenEl = form.querySelector(`#${fieldName}_hidden_${form.dataset.formIndex}`);
    if (hiddenEl) {
        hiddenEl.value = value;
        return;
    }
    const el = form.querySelector(`[name="${fieldName}"]`);
    if (!el) return;
    if (el.type === 'radio') {
        const radio = form.querySelector(`[name="${fieldName}"][value="${value}"]`);
        if (radio) radio.checked = true;
    } else {
        el.value = value;
    }
}

function syncAllFormsData() {
    const formCount = getFormCount();
    if (formCount <= 1) return;
    const form1 = document.getElementById('kalibrasiForm1') || document.querySelector('form[id^="kalibrasiForm"]');
    if (!form1) return;
    
    const fieldsToSync = [
        'nama_alat', 'merek', 'kode_alat', 'type_alat', 'no_seri',
        'nama_pemilik', 'tanggal_alat_masuk', 'tanggal_kalibrasi',
        'tempat_kalibrasi', 'lokasi_pt', 'fungsi_komponen',
        'suhu_awal', 'suhu_tengah', 
        'suhu_akhir', 'rh_awal', 'rh_tengah', 'rh_akhir', 'verified_by'
    ];
    
    let form1Values = {};
    fieldsToSync.forEach(field => {
        form1Values[field] = getFormValue(form1, field);
    });
    
    for (let i = 2; i <= formCount; i++) {
        const form = document.getElementById(`kalibrasiForm${i}`);
        if (!form) continue;
        fieldsToSync.forEach(field => {
            if (form1Values[field]) {
                setFormValue(form, field, form1Values[field]);
            }
        });
    }
}

async function submitSemuaForm() {
    const activeTabId = getActiveTabId();
    console.log('📌 Submitting Conductivity Meter from active tab:', activeTabId);
    
    const forms = [];
    for (let i = 1; i <= 100; i++) {
        const form = document.getElementById(`kalibrasiForm${i}`);
        if (form) {
            forms.push(form);
        } else {
            break;
        }
    }
    if (forms.length === 0) {
        const singleForm = document.getElementById('kalibrasiForm') || document.querySelector('form');
        if (singleForm) forms.push(singleForm);
    }
    
    const formCount = forms.length;
    if (forms.length === 0) {
        alert('Form tidak ditemukan!');
        return;
    }
    
    disableRequiredOnHiddenForms();
    syncAllFormsData();
    
    for (let i = 0; i < forms.length; i++) {
        forms[i].setAttribute('novalidate', 'novalidate');
        forms[i].noValidate = true;
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
        const combinedFormData = new FormData();
        let csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
        if (!csrfToken && forms[0]) {
            const csrfInput = forms[0].querySelector('input[name="_token"]');
            if (csrfInput) csrfToken = csrfInput.value;
        }
        if (csrfToken) combinedFormData.append('_token', csrfToken);
        
        combinedFormData.append('jumlah_form', formCount.toString());
        combinedFormData.append('submit_all', 'true');
        combinedFormData.append('form_type', 'conductivity_meter');
        
        for (let i = 0; i < forms.length; i++) {
            const form = forms[i];
            const formIndex = i + 1;
            const formData = new FormData(form);
            
            for (let [key, value] of formData.entries()) {
                if (key === '_token') continue;
                let newKey = key;
                if (!key.match(/^form_\d+_/)) {
                    newKey = `form_${formIndex}_${key}`;
                }
                combinedFormData.append(newKey, value);
                if (formIndex === 1) {
                    combinedFormData.append(key, value);
                }
            }
            
            combinedFormData.append(`form_${formIndex}_form_index`, formIndex);
            combinedFormData.append(`form_${formIndex}_form_type`, 'conductivity_meter');
            combinedFormData.append(`form_${formIndex}_jumlah_form`, formCount);
        }
        
        console.log('📤 Sending combinedFormData for Conductivity Meter...');
        
        const response = await fetch('/calibrations', {
            method: 'POST',
            body: combinedFormData,
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
        
        let formName = 'Conductivity Meter';
        const selectNamaAlat = forms[0].querySelector('select[name="nama_alat"]');
        if (selectNamaAlat && selectNamaAlat.value && selectNamaAlat.value !== 'MANUAL_INPUT') {
            formName = selectNamaAlat.value;
        } else {
            const manualNamaAlat = forms[0].querySelector('input[name="nama_alat_manual"]');
            if (manualNamaAlat && manualNamaAlat.value) {
                formName = manualNamaAlat.value;
            }
        }
        
        const activeContainer = document.querySelector(`.lk-form-container[data-lk-id="${activeTabId}"]`);
        if (activeContainer) activeContainer.setAttribute('data-form-name', formName);
        
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
            console.log('ðŸŽ¯ Tab switched to:', tabId);
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
    console.log('ðŸš€ DOM Content Loaded - Initializing Conductivity Meter...');
    
    setupTabSwitching();
    
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
    
    console.log('âœ… Conductivity Meter initialization complete!');
});
</script>

</body>

</html>