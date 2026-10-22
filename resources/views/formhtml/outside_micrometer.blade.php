<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @if(session('show_no_label_modal') && session('calibration_id'))
        <meta name="show-no-label-modal" content="true">
        <meta name="calibration-id" content="{{ session('calibration_id') }}">
        <meta name="form-type" content="{{ session('form_type', request()->form_type) }}">
    @else
        <meta name="show-no-label-modal" content="false">
        <meta name="calibration-id" content="">
        <meta name="form-type" content="">
    @endif
    
    <script type="importmap">
    {
        "imports": {
            "niimbluelib": "https://cdn.jsdelivr.net/npm/niimbluelib@latest/dist/index.js"
        }
    }
    </script>
    <title>Form Kalibrasi - PT. PANANJUNG ANUGRAH SOLUTION</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
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
        }
        
        .kalibrasi-input::placeholder {
            color: #666666 !important;
        }

        .kondisi-input {
            border: 1px solid #000 !important;
            text-align: center;
            width: 100%;
            padding: 4px;
        }

        .kalibrasi-header-table {
            width: 100%;
            margin-bottom: 20px;
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

        input:required:invalid {
            border-color: #dc3545 !important;
        }

        input:required:valid {
            border-color: #198754 !important;
        }

        .disabled-field {
            background-color: #e9ecef !important;
            opacity: 0.8;
        }

        .info-copy {
            font-size: 12px;
            color: #6c757d;
            margin-top: 5px;
            font-style: italic;
        }
        
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .loading-spinner {
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
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
            <i class="fas fa-file-alt" style="margin-right:8px;"></i>Form Outside Micrometer ke-{{ $formIndex }}
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
                <input type="hidden" name="form_type" value="outside_micrometer">
                <input type="hidden" name="capacity" value="{{ $capacity ?? '' }}">
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
                    <!--<input type="hidden" name="rentang_ukur_min" id="rentang_ukur_min_hidden_{{ $formIndex }}" value="0">-->
                    <!--<input type="hidden" name="rentang_ukur_max" id="rentang_ukur_max_hidden_{{ $formIndex }}" value="">-->
                    <!--<input type="hidden" name="kapasitas" id="kapasitas_hidden_{{ $formIndex }}" value="">-->
                    <!--<input type="hidden" name="resolusi" id="resolusi_hidden_{{ $formIndex }}" value="">-->
                    <input type="hidden" name="nama_pemilik" id="nama_pemilik_hidden_{{ $formIndex }}" value="">
                    <input type="hidden" name="tanggal_alat_masuk" id="tanggal_alat_masuk_hidden_{{ $formIndex }}" value="">
                    <input type="hidden" name="tanggal_kalibrasi" id="tanggal_kalibrasi_hidden_{{ $formIndex }}" value="">
                    <input type="hidden" name="jenis_pembacaan" id="jenis_pembacaan_hidden_{{ $formIndex }}" value="digital">
                    <input type="hidden" name="tempat_kalibrasi" id="tempat_kalibrasi_hidden_{{ $formIndex }}" value="">
                    <input type="hidden" name="lokasi_pt" id="lokasi_pt_hidden_{{ $formIndex }}" value="">
                    <input type="hidden" name="fungsi_komponen" id="fungsi_komponen_hidden_{{ $formIndex }}" value="">
                    <input type="hidden" name="keterangan_fungsi_komponen" id="keterangan_hidden_{{ $formIndex }}" value="">
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
                                <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK02</p>
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
                                <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">OUTSIDE MICROMETER</p>
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
                                    <select name="nama_alat" id="nama_alat_select_{{ $formIndex }}_tab{{ $tabId }}" 
                                        class="kalibrasi-input">
                                        <option value="">-- Pilih Alat --</option>
                                          <option value="Outside Micrometer">Outside Micrometer</option>
                                        <option value="MANUAL_INPUT">-- Input Nama Alat --</option>
                                    </select>
                                    
                                    <div id="manualInputContainer_{{ $formIndex }}_tab{{ $tabId }}" style="display: none; margin-top: 10px;">
                                        <input type="text" name="nama_alat_manual" id="nama_alat_manual_{{ $formIndex }}_tab{{ $tabId }}"
                                               placeholder="Ketik nama alat"
                                               style="background-color: #f5f5f5; color: #333; border: 1px solid #ced4da; padding: 6px 10px; border-radius: 4px; width: 100%;">
                                    </div>
                                    
                                    
                                    <input type="hidden" name="nama_alat_final" id="nama_alat_final_{{ $formIndex }}" value="">
                                    <input type="hidden" name="nama_alat_display" id="nama_alat_display_{{ $formIndex }}" value="">
                                @else
                                    <input type="text" name="nama_alat" id="nama_alat_copy_{{ $formIndex }}" class="kalibrasi-input disabled-field" readonly disabled placeholder="Mengikuti Form 1" style="background-color: #e9ecef;">
                                    <input type="hidden" name="nama_alat" id="nama_alat_hidden_{{ $formIndex }}" value="">
                                    <div class="info-copy">
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
                                    @else
                                        <input type="text" name="merek_display" id="merek_{{ $formIndex }}" class="kalibrasi-input me-3 disabled-field" placeholder="Mengikuti Form 1" style="width: 60%; background-color: #e9ecef;" readonly disabled>
                                    @endif
                                    <span class="me-3" style="color: #000000;">Kode Alat :</span>
                                    @if($isFirstForm)
                                        <input type="text" name="kode_alat" id="kode_alat_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan kode" style="width: 30%;">
                                    @else
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
                                        <input type="text" name="type_alat" id="type_alat_{{ $formIndex }}" class="kalibrasi-input me-3" placeholder="Masukkan Type Alat" style="width: 45%;" required>
                                        <span class="me-3" style="color: #000000;">/</span>
                                        <input type="text" name="no_seri" id="no_seri_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan No. Seri" style="width: 45%;" required>
                                    @else
                                        <input type="text" name="type_alat_display" id="type_alat_{{ $formIndex }}" class="kalibrasi-input me-3 disabled-field" placeholder="Mengikuti Form 1" style="width: 45%; background-color: #e9ecef;" readonly disabled>
                                        <span class="me-3" style="color: #000000;">/</span>
                                        <input type="text" name="no_seri_display" id="no_seri_{{ $formIndex }}" class="kalibrasi-input disabled-field" placeholder="Mengikuti Form 1" style="width: 45%; background-color: #e9ecef;" readonly disabled>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Rentang Ukur -->
                          <tr>
                            <td><p style="margin:0;color:#000">Rentang Ukur</p></td>
                            <td colspan="3">
                                <div class="d-flex align-items-center">
                                    <input type="text" name="rentang_ukur_min" id="rentang_ukur_min_{{ $formIndex }}" class="kalibrasi-input me-3" value="0" style="width:45%;" placeholder="Masukkan Range Min"  >
                                    <span class="me-3">-</span>
                                    <input type="text" name="rentang_ukur_max" id="rentang_ukur_max_{{ $formIndex }}" class="kalibrasi-input" style="width:45%;" placeholder="Masukkan Range Max"  >
                                </div>
                             </td>
                        </tr>

                        <!-- KAPASITAS / RESOLUSI - SEKARANG BISA DIISI PER FORM -->
                        <tr>
                            <td><p style="margin:0;color:#000">Kapasitas / Resolusi</p></td>
                            <td colspan="3">
                                <div class="d-flex align-items-center gap-3">
                                    <div style="width: 45%;">
                                        <input type="text" name="kapasitas" id="kapasitas_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan Kapasitas"  >
                                    </div>
                                    <span style="color: #000000;">/</span>
                                    <div style="width: 45%;">
                                        <input type="text" name="resolusi" id="resolusi_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan Resolusi"  >
                                    </div>
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
                            <td><p style="margin: 0; color: #000000;">Th</p></td>
                            <td colspan="3">
                                @if($isFirstForm)
                                     <input type="text" name="kode_th" id="kode_th_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan TH" style="width: 100%; margin-top: 8px;">
                                @else
                                     <input type="text" name="kode_th_display" id="kode_th_{{ $formIndex }}" class="kalibrasi-input disabled-field" placeholder="Mengikuti Form 1" style="width: 100%; margin-top: 8px; background-color: #e9ecef;" readonly disabled>
                                @endif
                            </td>
                        </tr>
                        
                    </table>

                    <!-- Fungsi Komponen Lainnya & Kondisi Kalibrasi -->
                    <div class="row mt-4">
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
                                    @if($isFirstForm)
                                        <input type="text" name="keterangan_fungsi_komponen" id="keterangan_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan Keterangan" style="border: none;">
                                    @else
                                        <input type="text" name="keterangan_fungsi_komponen_display" id="keterangan_{{ $formIndex }}" class="kalibrasi-input disabled-field" placeholder="Mengikuti Form 1" style="border: none; background-color: #e9ecef;" readonly disabled>
                                    @endif
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
                                    <td><input type="text" name="suhu_awal" id="suhu_awal_{{ $formIndex }}" class="kondisi-input"   placeholder="0.0" {{ $isFirstForm ? 'required' : 'disabled' }}></td>
                                    <td><input type="text" name="suhu_tengah" id="suhu_tengah_{{ $formIndex }}" class="kondisi-input"   placeholder="0.0" {{ $isFirstForm ? 'required' : 'disabled' }}></td>
                                    <td><input type="text" name="suhu_akhir" id="suhu_akhir_{{ $formIndex }}" class="kondisi-input"   placeholder="0.0" {{ $isFirstForm ? 'required' : 'disabled' }}></td>
                                </tr>
                                <tr>
                                    <td class="bg-light fw-bold" style="color: #000000;">RH (%)</td>
                                    <td><input type="text" name="rh_awal" id="rh_awal_{{ $formIndex }}" class="kondisi-input"   placeholder="0.0" {{ $isFirstForm ? 'required' : 'disabled' }}></td>
                                    <td><input type="text" name="rh_tengah" id="rh_tengah_{{ $formIndex }}" class="kondisi-input"   placeholder="0.0" {{ $isFirstForm ? 'required' : 'disabled' }}></td>
                                    <td><input type="text" name="rh_akhir" id="rh_akhir_{{ $formIndex }}" class="kondisi-input"   placeholder="0.0" {{ $isFirstForm ? 'required' : 'disabled' }}></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Data Kalibrasi Section -->
                    <div class="data-kalibrasi-header" style="color: #000000;">DATA KALIBRASI</div>


<table class="table table-bordered" style="width: 100%; border: 2px solid #000;">
    <tr>
        <td colspan="4" style="border: 2px solid #000; background-color: #f0f0f0; text-align: center; padding: 8px;">
            <strong>Uji Kerataan</strong>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="border: 2px solid #000; background-color: #e8e8e8; text-align: center; padding: 6px;">
            <strong>Anvil</strong>
        </td>
        <td colspan="2" style="border: 2px solid #000; background-color: #e8e8e8; text-align: center; padding: 6px;">
            <strong>Spindle</strong>
        </td>
    </tr>
    <tr>
        <td style="border: 2px solid #000; background-color: #d9d9d9; text-align: center; padding: 6px; width: 25%;">
            <strong>Ukuran Optical Flat</strong>
        </td>
        <td style="border: 2px solid #000; background-color: #d9d9d9; text-align: center; padding: 6px; width: 25%;">
            <strong>Jumlah Frinji</strong>
        </td>
        <td style="border: 2px solid #000; background-color: #d9d9d9; text-align: center; padding: 6px; width: 25%;">
            <strong>Ukuran Optical Flat</strong>
        </td>
        <td style="border: 2px solid #000; background-color: #d9d9d9; text-align: center; padding: 6px; width: 25%;">
            <strong>Jumlah Frinji</strong>
        </td>
    </tr>
    
    <!-- BARIS 1 - Anvil 1 dan Spindle 1 -->
    <tr style="height:21.3pt;">
        <td style="border:2px solid #000; padding:0;">
            <div class="d-flex align-items-center" style="padding: 4px;">
                <input type="text" name="ukuranAnvil1_{{ $formIndex }}" class="form-control border-0 text-center flex-grow-1" 
                       placeholder="0.00" value=""
                       style="margin-right: 8px; background: transparent;">
                <span style="font-weight: bold; color: #000000; white-space: nowrap;"> </span>
            </div>
        </td>
        <td style="border:2px solid #000; padding:0;">
            <input type="text" name="jumlahAnvil1_{{ $formIndex }}" class="form-control border-0 text-center" 
                   placeholder="Jumlah" value="" style="background: transparent;">
        </td>
        <td style="border:2px solid #000; padding:0;">
            <div class="d-flex align-items-center" style="padding: 4px;">
                <input type="text" name="ukuranSpindle1_{{ $formIndex }}" class="form-control border-0 text-center flex-grow-1" 
                       placeholder="0.00" value=""
                       style="margin-right: 8px; background: transparent;">
                <span style="font-weight: bold; color: #000000; white-space: nowrap;"> </span>
            </div>
        </td>
        <td style="border:2px solid #000; padding:0;">
            <input type="text" name="jumlahSpindle1_{{ $formIndex }}" class="form-control border-0 text-center" 
                   placeholder="Jumlah" value="" style="background: transparent;">
        </td>
    </tr>
    
    <!-- BARIS 2 - Anvil 2 dan Spindle 2 -->
    <tr style="height:21.3pt;">
        <td style="border:2px solid #000; padding:0;">
            <div class="d-flex align-items-center" style="padding: 4px;">
                <input type="text" name="ukuranAnvil2_{{ $formIndex }}" class="form-control border-0 text-center flex-grow-1" 
                       placeholder="0.00" value=""
                       style="margin-right: 8px; background: transparent;">
                <span style="font-weight: bold; color: #000000; white-space: nowrap;"> </span>
            </div>
        </td>
        <td style="border:2px solid #000; padding:0;">
            <input type="text" name="jumlahAnvil2_{{ $formIndex }}" class="form-control border-0 text-center" 
                   placeholder="Jumlah" value="" style="background: transparent;">
        </td>
        <td style="border:2px solid #000; padding:0;">
            <div class="d-flex align-items-center" style="padding: 4px;">
                <input type="text" name="ukuranSpindle2_{{ $formIndex }}" class="form-control border-0 text-center flex-grow-1" 
                       placeholder="0.00" value=""
                       style="margin-right: 8px; background: transparent;">
                <span style="font-weight: bold; color: #000000; white-space: nowrap;"> </span>
            </div>
        </td>
        <td style="border:2px solid #000; padding:0;">
            <input type="text" name="jumlahSpindle2_{{ $formIndex }}" class="form-control border-0 text-center" 
                   placeholder="Jumlah" value="" style="background: transparent;">
        </td>
    </tr>
</table>
                    
                    <!-- Uji Skala Nominal -->
                    <div class="mb-3 mt-4">
                        <span style="font-size: 16px; font-weight: bold; color: #000000;">Uji Skala Nominal</span>
                    </div>
                    
                    @php
                        $getNominalValues = function($capacity) {
                            if ($capacity === null) return array_fill(0, 14, '');
                            $values = [];
                            switch((int)$capacity) {
                                case 0: $values = [0.0, 2.5, 5.1, 7.7, 10.3, 12.9, 15.0, 17.6, 20.2, 22.8, 25.0, '', '', '']; break;
                                case 25: $values = [25.0, 27.5, 30.1, 32.7, 35.3, 37.9, 40.0, 42.6, 45.2, 47.8, 50.0, '', '', '']; break;
                                case 50: $values = [50.0, 52.5, 55.1, 57.7, 60.3, 62.9, 65.0, 67.6, 70.2, 72.8, 75.0, '', '', '']; break;
                                case 75: $values = [75.0, 77.5, 80.1, 82.7, 85.3, 87.9, 90.0, 92.6, 95.2, 97.8, 100.0, '', '', '']; break;
                                case 100: $values = [100.0, 102.5, 105.1, 107.7, 110.3, 112.9, 115.0, 117.6, 120.2, 122.8, 125.0, '', '', '']; break;
                                case 125: $values = [125.0, 127.5, 130.1, 132.7, 135.3, 137.9, 140.0, 142.6, 145.2, 147.8, 150.0, '', '', '']; break;
                                case 150: $values = [150.0, 152.5, 155.1, 157.7, 160.3, 162.9, 165.0, 167.6, 170.2, 172.8, 175.0, '', '', '']; break;
                                case 175: $values = [175.0, 177.5, 180.1, 182.7, 185.3, 187.9, 190.0, 192.6, 195.2, 197.8, 200.0, '', '', '']; break;
                                case 200: $values = [200.0, 202.5, 205.1, 207.7, 210.3, 212.9, 215.0, 217.6, 220.2, 222.8, 225.0, '', '', '']; break;
                                case 225: $values = [225.0, 227.5, 230.1, 232.7, 235.3, 237.9, 240.0, 242.6, 245.2, 247.8, 250.0, '', '', '']; break;
                                case 250: $values = [250.0, 252.5, 255.1, 257.7, 260.3, 262.9, 265.0, 267.6, 270.2, 272.8, 275.0, '', '', '']; break;
                                case 275: $values = [275.0, 277.5, 280.1, 282.7, 285.3, 287.9, 290.0, 292.6, 295.2, 297.8, 300.0, '', '', '']; break;
                                case 300: $values = [300.0, 302.5, 305.1, 307.7, 310.3, 312.9, 315.0, 317.6, 320.2, 322.8, 325.0, '', '', '']; break;
                                case 325: $values = [325.0, 327.5, 330.1, 332.7, 335.3, 337.9, 340.0, 342.6, 345.2, 347.8, 350.0, '', '', '']; break;
                                case 350: $values = [350.0, 352.5, 355.1, 357.7, 360.3, 362.9, 365.0, 367.6, 370.2, 372.8, 375.0, '', '', '']; break;
                                case 375: $values = [375.0, 377.5, 380.1, 382.7, 385.3, 387.9, 390.0, 392.6, 395.2, 397.8, 400.0, '', '', '']; break;
                                case 400: $values = [400.0, 402.5, 405.1, 407.7, 410.3, 412.9, 415.0, 417.6, 420.2, 422.8, 425.0, '', '', '']; break;
                                case 425: $values = [425.0, 427.5, 430.1, 432.7, 435.3, 437.9, 440.0, 442.6, 445.2, 447.8, 450.0, '', '', '']; break;
                                case 450: $values = [450.0, 452.5, 455.1, 457.7, 460.3, 462.9, 465.0, 467.6, 470.2, 472.8, 475.0, '', '', '']; break;
                                case 475: $values = [475.0, 477.5, 480.1, 482.7, 485.3, 487.9, 490.0, 492.6, 495.2, 497.8, 500.0, '', '', '']; break;
                                case 500: $values = [500.0, 502.5, 505.1, 507.7, 510.3, 512.9, 515.0, 517.6, 520.2, 522.8, 525.0, '', '', '']; break;
                                default: 
                                    if ($capacity == 0 || $capacity == '0') {
                                        $values = [0.0, 2.5, 5.1, 7.7, 10.3, 12.9, 15.0, 17.6, 20.2, 22.8, 25.0, '', '', ''];
                                    } else {
                                        $values = array_fill(0, 14, '');
                                    }
                                    break;
                            }
                            while(count($values) < 14) $values[] = '';
                            return $values;
                        };
                        $nominalValues = $getNominalValues($capacity ?? null);
                    @endphp

                    <table class="kalibrasi-data-table">
                        <tr style="background: #d9d9d9;">
                            <td style="width: 20%;"><span style="font-weight: bold; color: #000000;">Nilai Nominal</span></td>
                            <td colspan="5"><span style="font-weight: bold; color: #000000;">Penunjukan Alat</span></td>
                        </tr>
                        <tr style="background: #e8e8e8;">
                            <td style="text-align: center; vertical-align: middle;">
                                <div style="display: flex; align-items: center; justify-content: center; gap: 4px;">
                                    <span style="font-weight: bold; color: #000000;">Unit (</span>
                                    <input type="text" name="satuan_unit_{{ $formIndex }}" id="satuan_unit_{{ $formIndex }}" value="mm" style="width: 45px; padding: 2px 4px; border: 1px solid #999; border-radius: 3px; text-align: center; font-weight: bold; font-size: 12px; background: white;">
                                    <span style="font-weight: bold; color: #000000;">)</span>
                                </div>
                            </td>
                            <td style="width: 16%; text-align: center;"><span style="font-weight: bold; color: #000000;">1</span></td>
                            <td style="width: 16%; text-align: center;"><span style="font-weight: bold; color: #000000;">2</span></td>
                            <td style="width: 16%; text-align: center;"><span style="font-weight: bold; color: #000000;">3</span></td>
                            <td style="width: 16%; text-align: center;"><span style="font-weight: bold; color: #000000;">4</span></td>
                            <td style="width: 16%; text-align: center;"><span style="font-weight: bold; color: #000000;">5</span></td>
                        </tr>

                        @for($row = 1; $row <= 14; $row++)
                            @php
                                $nominalValue = isset($nominalValues[$row-1]) ? $nominalValues[$row-1] : '';
                                $readonly = ($nominalValue !== '' && $nominalValue !== null) ? 'readonly' : '';
                                $inputType = ($nominalValue !== '' && $nominalValue !== null) ? 'text' : 'text';
                                $nominalFormatted = ($nominalValue !== '' && $nominalValue !== null) ? number_format((float)$nominalValue, 1, '.', '') : '';
                            @endphp
                            <tr style="height:21.3pt;">
                                <td style="border:2px solid #000; padding:0; background: #f0f0f0;">
                                    <input type="{{ $inputType }}" name="nominal_{{ $formIndex }}_{{ $row }}" value="{{ $nominalFormatted }}" {{ $readonly }}   style="width:100%;height:100%;border:none;background:transparent;text-align:center;font-size:10pt;color:#000;padding:2px;">
                                </td>
                                @for($col = 1; $col <= 5; $col++)
                                    <td style="border:2px solid #000; padding:0;">
                                        <input type="text" name="penunjukan_{{ $formIndex }}_{{ $row }}_{{ $col }}" value=""   style="width:100%;height:100%;border:none;background:transparent;text-align:center;font-size:10pt;color:#000;padding:2px;">
                                    </td>
                                @endfor
                            </tr>
                        @endfor
                    </table>

                    <!-- Footer Section -->
                    <table class="kalibrasi-main-table">
                        <tr>
                            <td colspan="6" style="text-align: center; border-bottom: 1px solid #000;">
                                <span style="font-weight: bold; font-size: 18px; color: #000000;">Isilah lembar data kalibrasi dengan lengkap dan jelas!</span>
                            </td>
                        </tr>

                        <!-- ALAT STANDAR + CHECKBOX -->
                        <tr style="height:13.5pt">
                            <td rowspan="5" style="width:105.35pt; border:1pt solid #000; vertical-align:middle; text-align:center; font-weight:bold; font-size:10pt; color:#000000;">
                                Alat<br>Standar
                            </td>
                            <td style="width:24.75pt; border:1pt solid #000; text-align:center; vertical-align:middle;">
                                <input type="checkbox" name="alat_standar[]" value="Gauge Block (150mm) D.007" id="alat1_{{ $formIndex }}">
                            </td>
                            <td colspan="2" style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
                                <label for="alat1_{{ $formIndex }}" style="cursor:pointer; color:#000000;">Gauge Block (150mm) D.007</label>
                            </td>
                            <td rowspan="5" style="width:111.15pt; border:1pt solid #000; padding-top:6pt; text-align:center; vertical-align:top; font-size:8.5pt; color:#000000;">
                                Dikalibrasi<br>oleh
                            </td>
                            <td rowspan="5" style="width:98.3pt; border:1pt solid #000; padding-top:6pt; text-align:center; vertical-align:top; font-size:8.5pt; color:#000000;">
                                Diperiksa<br>oleh
                            </td>
                        </tr>
                        <tr style="height:13.5pt">
                            <td style="border:1pt solid #000; text-align:center;"><input type="checkbox" name="alat_standar[]" value="Gauge Block (300mm) D.008" id="alat2_{{ $formIndex }}"></td>
                            <td colspan="2" style="border:1pt solid #000; padding-left:12.1pt;"><label for="alat2_{{ $formIndex }}" style="cursor:pointer; color:#000000;">Gauge Block (300mm) D.008</label></td>
                        </tr>
                        <tr style="height:13.5pt">
                            <td style="border:1pt solid #000; text-align:center;"><input type="checkbox" name="alat_standar[]" value="Gauge Block (300mm) D.009" id="alat3_{{ $formIndex }}"></td>
                            <td colspan="2" style="border:1pt solid #000; padding-left:12.1pt;"><label for="alat3_{{ $formIndex }}" style="cursor:pointer; color:#000000;">Gauge Block (300mm) D.009</label></td>
                        </tr>
                        <tr style="height:13.5pt">
                            <td style="border:1pt solid #000; text-align:center;"><input type="checkbox" name="alat_standar[]" value="Gauge Block Set Grade 0.5 ~ 100 mm 0 D.012" id="alat4_{{ $formIndex }}"></td>
                            <td colspan="2" style="border:1pt solid #000; padding-left:12.1pt;"><label for="alat4_{{ $formIndex }}" style="cursor:pointer; color:#000000;">Gauge Block Set Grade 0.5 ~ 100 mm 0 D.012</label></td>
                        </tr>
                        <tr style="height:13.5pt">
                            <td style="border:1pt solid #000; text-align:center;"><input type="checkbox" name="alat_standar[]" value="Gauge Block Set Grade 2.5 ~ 25 mm 0 D.013" id="alat5_{{ $formIndex }}"></td>
                            <td colspan="2" style="border:1pt solid #000; padding-left:12.1pt;"><label for="alat5_{{ $formIndex }}" style="cursor:pointer; color:#000000;">Gauge Block Set Grade 2.5 ~ 25 mm 0 D.013</label></td>
                        </tr>

                        <!-- METODE KALIBRASI + TTD & NAMA -->
                        <tr style="height:15pt">
                            <td rowspan="2" style="width:105.35pt; border:1pt solid #000; padding:8.6pt 0 0 20.5pt; font-size:8.5pt; vertical-align:top; color:#000000;">
                                Metode Kalibrasi
                            </td>
                            <td colspan="3" rowspan="2" style="border:1pt solid #000; padding:3.2pt 5.25pt 0 8.85pt; font-size:8.5pt; line-height:112%; vertical-align:top; color:#000000;">
                                PAS-IK1102-02 (JIS B 7502:2016 (JMA/JSA); SNSU PK.P-01:2020).
                            </td>
                            <td style="width:111.15pt; border:1pt solid #000; padding:3.35pt 0 0 1.35pt; font-size:8.5pt; vertical-align:top;">
                                <input type="text" name="calibrated_by" class="kalibrasi-input" value="{{ auth()->user()->nama ?? 'System' }}" placeholder="Nama" style="border: none; width: 100%; background-color: #f8f9fa;" readonly>
                            </td>
                            <td style="width:98.3pt; border:1pt solid #000; padding:3.35pt 0 0 1.8pt; font-size:8.5pt; vertical-align:top;">
                                <input type="text" name="verified_by" id="verified_by_{{ $formIndex }}" class="kalibrasi-input" placeholder="-" style="border: none; width: 100%;" {{ $isFirstForm ? 'readonly' : '' }}>
                            </td>
                        </tr>
                        <tr style="height:11.95pt">
                            <td style="width:111.15pt; border:1pt solid #000; padding:1.8pt 0 0 1.35pt; font-size:8.5pt; vertical-align:top;">TTD :</td>
                            <td style="width:98.3pt; border:1pt solid #000; padding:1.8pt 0 0 1.8pt; font-size:8.5pt; vertical-align:top;">TTD :</td>
                        </tr>
                    </table>

                    @if($formIndex == $count)
                    <div class="row mt-5">
                        <div class="col-12 text-center">
                            <button type="button" id="btnSimpanSemua" onclick="submitSemuaForm()" class="btn btn-primary btn-lg" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
                                <i class="fas fa-save me-2"></i>Simpan Data Kalibrasi
                            </button>
                        </div>
                    </div>
                    @endif
            </form>
        </div>
        
        @if($count > 1 && $formIndex < $count) 
        <div style="height: 8px;"></div>
        @endif
    @endfor

    <!-- MODAL NO LABEL -->
    <div class="modal fade" id="noLabelModal" tabindex="-1" aria-labelledby="noLabelModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="noLabelModalLabel">
                        <i class="fas fa-tag me-2"></i>Lengkapi No. Label Kalibrasi
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="" id="noLabelForm">
                    @csrf
                    <div class="modal-body">
                        <div class="alert alert-success mb-4">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success', 'Data kalibrasi berhasil disimpan!') }}
                        </div>
                        <label for="no_label_input" class="modal-label">
                            <i class="fas fa-barcode me-1"></i>No. Label Kalibrasi
                        </label>
                        <input type="text" name="no_label" id="no_label_input" class="no-label-input" placeholder="Contoh: LAB-001/2024" maxlength="50" autocomplete="off" required>
                        <div class="form-text mt-2 text-muted">Nomor label wajib diisi untuk melengkapi data kalibrasi.</div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="calibration_id_no_label" value="">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times me-1"></i>Nanti</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Simpan No. Label</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
var tempFormDataStore = window.tempFormDataStore;
var isRestoring = window.isRestoring;
var tabSubmitStatus = window.tabSubmitStatus;
var currentActiveTabId = '1';

    // ==========================================
    // STORAGE PER TAB
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
    
    // Global variable untuk menyimpan tab aktif
    // ==========================================
    // FUNGSI UNTUK MENDAPATKAN TAB AKTIF
    // ==========================================
    function getActiveTabId() {
        // PRIORITAS 1: Cari tab pane yang aktif (dari Bootstrap tab)
        const activePane = document.querySelector('.tab-pane.active');
        if (activePane && activePane.id) {
            const paneId = activePane.id;
            if (paneId && paneId.startsWith('lk-pane-')) {
                const tabId = paneId.replace('lk-pane-', '');
                console.log(`📍 Active tab ID from active pane: ${tabId}`);
                currentActiveTabId = tabId;
                return tabId;
            }
        }
        
        // PRIORITAS 2: Cari tab button dengan class active
        const activeTabButton = document.querySelector('.nav-link.active');
        if (activeTabButton && activeTabButton.id) {
            const id = activeTabButton.id;
            if (id && id.startsWith('lk-tab-')) {
                const tabId = id.replace('lk-tab-', '');
                console.log(`📍 Active tab ID from active button: ${tabId}`);
                currentActiveTabId = tabId;
                return tabId;
            }
        }
        
        // PRIORITAS 3: Cari container yang visible
        const containers = document.querySelectorAll('.lk-form-container');
        for (let i = 0; i < containers.length; i++) {
            const container = containers[i];
            const style = window.getComputedStyle(container);
            if (style.display !== 'none') {
                const tabId = container.getAttribute('data-lk-id');
                console.log(`📍 Active tab ID from visible container: ${tabId}`);
                currentActiveTabId = tabId || '1';
                return currentActiveTabId;
            }
        }
        
        // Fallback ke global variable
        console.log(`📍 Active tab ID from global (fallback): ${currentActiveTabId}`);
        return currentActiveTabId;
    }
    
    // Update global variable saat tab berubah
    function updateActiveTab(tabId) {
        currentActiveTabId = tabId;
        console.log(`🔄 Global active tab updated to: ${tabId}`);
    }

  
     // ==========================================
    // FUNGSI GET FORM COUNT - HANYA DARI URL PARAMETER count
    // ==========================================
      function getFormCount() {
        let maxFormIndex = 0;
        for (let i = 1; i <= 100; i++) {
            const form = document.getElementById(`kalibrasiForm${i}`);
            if (form) {
                maxFormIndex = i;
            } else {
                break;
            }
        }
        
        if (maxFormIndex > 0) {
            return maxFormIndex;
        }
        
        const urlParams = new URLSearchParams(window.location.search);
        const countParam = urlParams.get('count');
        if (countParam && !isNaN(parseInt(countParam))) {
            return Math.max(1, parseInt(countParam));
        }
        
        return 1;
    }
    
    function setFormCount(count) {
        sessionStorage.setItem('current_jumlah_form', count.toString());
        console.log('💾 Saved jumlah_form to sessionStorage:', count);
    }

    // ==========================================
    // FUNGSI UPDATE SEMUA JUMLAH FORM
    // ==========================================
    function updateAllJumlahFormValues(actualCount) {
        console.log(`🔄 Updating jumlah_form to: ${actualCount}`);
        setFormCount(actualCount);
        
        // Hanya update form yang ada (1 sampai actualCount)
        for (let i = 1; i <= actualCount; i++) {
            const form = document.getElementById(`kalibrasiForm${i}`);
            if (form) {
                let jumlahFormInput = form.querySelector('input[name="jumlah_form"]');
                if (!jumlahFormInput) {
                    jumlahFormInput = document.createElement('input');
                    jumlahFormInput.type = 'hidden';
                    jumlahFormInput.name = 'jumlah_form';
                    form.appendChild(jumlahFormInput);
                }
                jumlahFormInput.value = actualCount;
                console.log(`✅ Set jumlah_form form ${i} = ${actualCount}`);
            } else {
                console.warn(`⚠️ Form ${i} tidak ditemukan, mungkin belum dibuat`);
            }
        }
    }

   function getFormValue(form, fieldName) {
    const element = form.querySelector(`[name="${fieldName}"]`);
    if (!element) return '';
    if (element.type === 'checkbox') return element.checked ? element.value : '';
    if (element.type === 'radio') {
        const checked = form.querySelector(`[name="${fieldName}"]:checked`);
        return checked ? checked.value : '';
    }
    return element.value || '';
}

function setFormValue(form, fieldName, value) {
    if (!value) return;
    let element = form.querySelector(`[name="${fieldName}"]`);
    if (element && element.type !== 'radio' && element.type !== 'checkbox') {
        element.value = value;
    }
    let hiddenElement = form.querySelector(`#${fieldName}_hidden_${form.getAttribute('data-form-index')}`);
    if (hiddenElement) {
        hiddenElement.value = value;
    }
    let radioElement = form.querySelector(`[name="${fieldName}"][value="${value}"]`);
    if (radioElement && radioElement.type === 'radio') {
        radioElement.checked = true;
    }
    let displayElement = form.querySelector(`[name="${fieldName}_display"]`);
    if (displayElement) {
        displayElement.value = value;
    }
}

   function syncAllFormsData() {
    const formCount = getFormCount();
    
    if (formCount <= 1) return;
    
    const form1 = document.getElementById('kalibrasiForm1');
    if (!form1) return;
    
    // Field yang tetap mengikuti Form 1 (data alat umum)
    const fieldsToSync = [
        'nama_alat', 'merek', 'kode_alat', 'type_alat', 'no_seri',
        'nama_pemilik', 'tanggal_alat_masuk', 'tanggal_kalibrasi',
        'tempat_kalibrasi', 'lokasi_pt', 'fungsi_komponen',
        'keterangan_fungsi_komponen', 'suhu_awal', 'suhu_tengah', 
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

    function updateFormType(selectedAlat, formIndex, tabId = null) {
        const currentTabId = tabId || getActiveTabId();
        const manualContainer = document.getElementById(`manualInputContainer_${formIndex}_tab${currentTabId}`);
        const manualInput = document.getElementById(`nama_alat_manual_${formIndex}_tab${currentTabId}`);
        const finalInput = document.getElementById(`nama_alat_final_${formIndex}_tab${currentTabId}`);
        
        if (selectedAlat === 'MANUAL_INPUT') {
            if (manualContainer) manualContainer.style.display = 'block';
            if (manualInput) {
                manualInput.value = '';
                manualInput.required = true;
            }
            if (finalInput) finalInput.value = '';
        } else {
            if (manualContainer) manualContainer.style.display = 'none';
            if (manualInput) {
                manualInput.value = '';
                manualInput.required = false;
            }
            if (finalInput && selectedAlat) finalInput.value = selectedAlat;
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
    // FUNGSI MENONAKTIFKAN REQUIRED
    // ==========================================
    function disableRequiredOnHiddenForms() {
        const formCount = getFormCount();
        
        for (let i = 1; i <= formCount; i++) {
            const form = document.getElementById(`kalibrasiForm${i}`);
            if (!form) continue;
            
            const container = form.closest('.lk-form-container');
            const isVisible = container && window.getComputedStyle(container).display !== 'none';
            
            const requiredInputs = form.querySelectorAll('[required]');
            
            if (!isVisible) {
                requiredInputs.forEach(input => {
                    input.removeAttribute('required');
                    input.setAttribute('data-required-temp', 'true');
                });
            }
        }
    }

    function restoreRequiredOnAllForms() {
        const formCount = getFormCount();
        
        for (let i = 1; i <= formCount; i++) {
            const form = document.getElementById(`kalibrasiForm${i}`);
            if (!form) continue;
            
            const requiredInputs = form.querySelectorAll('[data-required-temp]');
            requiredInputs.forEach(input => {
                input.setAttribute('required', 'required');
                input.removeAttribute('data-required-temp');
            });
        }
    }

    // ==========================================
    // FUNGSI HANDLE SAVE SUCCESS
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

        const formName = container.getAttribute('data-form-name') || 'Alat';
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
            if (firstContainer) {
                firstContainer.style.display = 'block';
            }
            updateActiveTab('1');
        }
    };

    // ==========================================
    // SUBMIT FORM
    // ==========================================
    async function submitSemuaForm() {
    const activeTabId = getActiveTabId();
    console.log('📌 Submitting from active tab:', activeTabId);
    
    // ========== 1. KUMPULKAN SEMUA FORM ==========
    const forms = [];
    for (let i = 1; i <= 100; i++) {
        const form = document.getElementById(`kalibrasiForm${i}`);
        if (form) {
            forms.push(form);
            console.log(`✅ Form ${i} ditemukan di DOM`);
        } else {
            break;
        }
    }
    
    const formCount = forms.length;
    console.log('📊 Submit - formCount from DOM:', formCount);
    
    if (forms.length === 0) {
        alert('Tidak ada form yang ditemukan!');
        return;
    }
    
    // ========== 2. NONAKTIFKAN REQUIRED ==========
    disableRequiredOnHiddenForms();
    updateAllJumlahFormValues(formCount);
    syncAllFormsData();
    
    // ========== 3. VALIDASI FORM YANG VISIBLE ==========
    let activeFormValid = true;
    for (let i = 0; i < forms.length; i++) {
        const container = forms[i].closest('.lk-form-container');
        const isVisible = container && window.getComputedStyle(container).display !== 'none';
        
        if (isVisible && !forms[i].reportValidity()) {
            alert(`Mohon lengkapi data pada Form ${i+1} terlebih dahulu!`);
            activeFormValid = false;
            break;
        }
    }
    
    if (!activeFormValid) {
        restoreRequiredOnAllForms();
        return;
    }
    
    const btn = document.getElementById('btnSimpanSemua');
    if (!btn) {
        alert('Tombol simpan tidak ditemukan!');
        restoreRequiredOnAllForms();
        return;
    }
    
    const originalText = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan Data...';
    
    try {
        const combinedFormData = new FormData();
        
        // ========== 4. AMBIL CSRF TOKEN ==========
        let csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
        if (!csrfToken && forms[0]) {
            const csrfInput = forms[0].querySelector('input[name="_token"]');
            if (csrfInput) csrfToken = csrfInput.value;
        }
        
        if (!csrfToken) {
            throw new Error('CSRF token tidak ditemukan. Refresh halaman!');
        }
        
        console.log('🔐 CSRF Token found');
        
        // ========== 5. TAMBAHKAN DATA GLOBAL ==========
        combinedFormData.append('_token', csrfToken);
        combinedFormData.append('jumlah_form', formCount.toString());
        combinedFormData.append('submit_all', 'true');
        combinedFormData.append('form_type', 'outside_micrometer');
        
        // ========== 6. PROSES SETIAP FORM - GUNAKAN FORMDATA LANGSUNG ==========
        for (let i = 0; i < forms.length; i++) {
            const form = forms[i];
            const formIndex = i + 1;
            
            console.log(`📝 Processing Form ${formIndex}`);
            
            // 🔥 MUDAH: Gunakan FormData untuk mengambil SEMUA data dari form
            const formData = new FormData(form);
            
            // Log semua key yang ada di FormData untuk debug
            const allFormKeys = Array.from(formData.keys());
            const nominalKeys = allFormKeys.filter(k => k.includes('nominal'));
            const penunjukanKeys = allFormKeys.filter(k => k.includes('penunjukan'));
            console.log(`   📝 Form ${formIndex} - Total keys: ${allFormKeys.length}`);
            console.log(`   📝 Form ${formIndex} - Nominal keys:`, nominalKeys);
            console.log(`   📝 Form ${formIndex} - Penunjukan keys:`, penunjukanKeys.slice(0, 5));
            
            // Kirim SEMUA data dari formData ke combinedFormData
            for (let [key, value] of formData.entries()) {
                if (key === '_token') continue;
                
                // Tambahkan prefix form_{formIndex}_ jika belum ada
                let newKey = key;
                if (!key.match(/^form_\d+_/)) {
                    newKey = `form_${formIndex}_${key}`;
                }
                combinedFormData.append(newKey, value);
            }
            
            // Pastikan field penting terkirim (sebagai backup)
            combinedFormData.append(`form_${formIndex}_form_index`, formIndex);
            combinedFormData.append(`form_${formIndex}_form_type`, 'outside_micrometer');
            combinedFormData.append(`form_${formIndex}_jumlah_form`, formCount);
            combinedFormData.append(`form_${formIndex}_capacity`, form.querySelector('input[name="capacity"]')?.value || '0');
        }
        
        // ========== 7. DEBUG: TAMPILKAN KEY UNTUK FORM 9 DAN 10 ==========
        const allKeys = Array.from(combinedFormData.keys());
        const form9Keys = allKeys.filter(k => k.includes('form_9') && (k.includes('nominal') || k.includes('penunjukan')));
        const form10Keys = allKeys.filter(k => k.includes('form_10') && (k.includes('nominal') || k.includes('penunjukan')));
        console.log('📤 Form 9 nominal/penunjukan keys:', form9Keys);
        console.log('📤 Form 10 nominal/penunjukan keys:', form10Keys);
        console.log('📤 Total FormData entries:', allKeys.length);
        
        // ========== 8. KIRIM REQUEST ==========
        const response = await fetch('/calibrations', {
            method: 'POST',
            body: combinedFormData,
            credentials: 'same-origin',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        });
        
        if (response.status === 419) {
            alert('Session telah berakhir. Halaman akan di-refresh.');
            location.reload();
            return;
        }
        
        let result;
        const contentType = response.headers.get('content-type');
        if (contentType && contentType.includes('application/json')) {
            result = await response.json();
        } else {
            const text = await response.text();
            console.error('Non-JSON response:', text.substring(0, 500));
            throw new Error('Server error: ' + text.substring(0, 200));
        }
        
        if (!response.ok) {
            if (result.errors) {
                const errorMessages = Object.values(result.errors).flat().join('\n');
                throw new Error(`Validasi gagal:\n${errorMessages}`);
            }
            throw new Error(result.error || result.message || `Error: ${response.status}`);
        }
        
        console.log('✅ Save success!', result);
        
        // ========== 9. TAMPILKAN HASIL ==========
        if (typeof window.handleSaveSuccess === 'function') {
            window.handleSaveSuccess(activeTabId, result);
        } else {
            alert('Data berhasil disimpan!');
            location.reload();
        }
        
    } catch (err) {
        console.error('Submit error:', err);
        alert('Error: ' + err.message);
    } finally {
        btn.disabled = false;
        btn.innerHTML = originalText;
        restoreRequiredOnAllForms();
    }
}
    // ==========================================
    // SETUP TAB SWITCHING
    // ==========================================
    function setupTabSwitching() {
        // Listen untuk tab switching dari Bootstrap
        $(document).on('shown.bs.tab', 'button[data-toggle="tab"]', function (e) {
            const targetId = $(e.target).attr('id');
            if (targetId && targetId.startsWith('lk-tab-')) {
                const tabId = targetId.replace('lk-tab-', '');
                console.log('🎯 Tab switched to:', tabId);
                updateActiveTab(tabId);
                
                // Sembunyikan semua container
                document.querySelectorAll('.lk-form-container').forEach(container => {
                    container.style.display = 'none';
                });
                
                // Tampilkan container yang dipilih
                const targetContainer = document.querySelector(`.lk-form-container[data-lk-id="${tabId}"]`);
                if (targetContainer) {
                    targetContainer.style.display = 'block';
                }
            }
        });
        
        // Set initial active tab
        const activeButton = document.querySelector('.nav-link.active');
        if (activeButton && activeButton.id) {
            const tabId = activeButton.id.replace('lk-tab-', '');
            updateActiveTab(tabId);
        }
    }

    // ==========================================
    // DOM CONTENT LOADED
    // ==========================================
  document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 DOM Content Loaded');
    
    const formCount = getFormCount();
    console.log('📊 Form count:', formCount);
    
    setFormCount(formCount);
    
    if (formCount > 1) {
        setTimeout(syncAllFormsData, 500);
    }
    
    // Setup event listener untuk nama alat di form pertama
    const namaAlatSelect = document.getElementById('nama_alat_select_1_tab1');
    if (namaAlatSelect) {
        namaAlatSelect.addEventListener('change', function() {
            updateFormType(this.value, 1);
        });
    }
    
    console.log('✅ Initialization complete!');
});
</script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
