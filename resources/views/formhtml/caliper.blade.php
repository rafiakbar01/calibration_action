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

        .form-card {
            border: 2px solid #3b82f6;
            border-radius: 8px;
            margin-bottom: 24px;
            background: white;
        }

        .form-card-header {
            background: linear-gradient(135deg, #1e40af, #3b82f6);
            color: white;
            padding: 12px 20px;
            border-radius: 6px 6px 0 0;
            font-weight: bold;
            font-size: 16px;
        }

        .form-card-body {
            padding: 20px;
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
        @endphp
        
        @if($count > 1)
        <div style="background: linear-gradient(135deg,#1e40af,#3b82f6); color:#fff; padding:10px 20px; margin: 16px 0 0; border-radius:8px 8px 0 0; font-weight:bold; font-size:16px;">
            <i class="fas fa-file-alt" style="margin-right:8px;"></i>Form Caliper ke-{{ $formIndex }}
            @if(!$isFirstForm)
            <span style="font-size:12px; margin-left:10px;">
                <i class="fas fa-info-circle"></i> Field informasi alat mengikuti Form 1
            </span>
            @endif
        </div>
        @endif
        
        <div class="container-fluid my-4" style="@if($count > 1) border:2px solid #3b82f6; border-radius:0 0 8px 8px; padding-bottom:24px; @endif">
            <form method="POST" action="/calibrations" id="kalibrasiForm{{ $formIndex }}" data-form-index="{{ $formIndex }}">
                @csrf
                <input type="hidden" name="form_type" value="caliper">
                <input type="hidden" name="capacity" value="{{ $capacity ?? '300' }}">
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
                    <input type="hidden" name="kapasitas" id="kapasitas_hidden_{{ $formIndex }}" value="">
                    <input type="hidden" name="resolusi" id="resolusi_hidden_{{ $formIndex }}" value="">
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
                                <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK03</p>
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
                                <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">CALIPER</p>
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

                    <table class="kalibrasi-main-table">
                        <tr>
                            <td style="width: 20%;">
                                <p style="margin: 0; color: #000000;">Nama Alat</p>
                            </td>
                            <td colspan="3">
                                @if($isFirstForm)
                                    <select name="nama_alat" id="nama_alat_select_{{ $formIndex }}" class="kalibrasi-input" onchange="updateFormType(this.value, {{ $formIndex }})" style="background-color: #f5f5f5; color: #333; border: 1px solid #ced4da; padding: 6px 10px; border-radius: 4px; width: 100%;">
                                        <option value="">-- Pilih Alat  --</option>
                                        <option value="Caliper">Caliper</option>
                                        <option value="MANUAL_INPUT">-- Input Manual Nama Alat --</option>
                                    </select>
                                    
                                    <div id="manualInputContainer_{{ $formIndex }}" style="display: none; margin-top: 10px;">
                                        <input type="text" name="nama_alat_manual" id="nama_alat_manual_{{ $formIndex }}"
                                               placeholder="Ketik nama alat Caliper secara manual"
                                               style="background-color: #f5f5f5; color: #333; border: 1px solid #ced4da; padding: 6px 10px; border-radius: 4px; width: 100%;"
                                               oninput="syncNamaAlat({{ $formIndex }})">
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
                        
                        <tr>
                            <td><p style="margin: 0; color: #000000;">Merek</p></td>
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

                        <tr>
                            <td><p style="margin: 0; color: #000000;">Type / No. Seri</p></td>
                            <td colspan="3">
                                <div class="d-flex align-items-center">
                                    @if($isFirstForm)
                                        <input type="text" name="type_alat" id="type_alat_{{ $formIndex }}" class="kalibrasi-input me-3" placeholder="Masukkan Type" style="width: 45%;" required>
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

                        <tr>
                            <td><p style="margin: 0; color: #000000;">Kapasitas / Resolusi</p></td>
                            <td colspan="3">
                                <div class="d-flex align-items-center">
                                    @if($isFirstForm)
                                        <input type="text" name="kapasitas" id="kapasitas_{{ $formIndex }}" class="kalibrasi-input me-3" placeholder="Masukkan kapasitas" style="width: 45%;" required>
                                        <span class="me-3" style="color: #000000;">/</span>
                                        <input type="text" name="resolusi" id="resolusi_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan Resolusi" style="width: 45%;" required>
                                    @else
                                        <input type="text" name="kapasitas_display" id="kapasitas_{{ $formIndex }}" class="kalibrasi-input me-3 disabled-field" placeholder="Mengikuti Form 1" style="width: 45%; background-color: #e9ecef;" readonly disabled>
                                        <span class="me-3" style="color: #000000;">/</span>
                                        <input type="text" name="resolusi_display" id="resolusi_{{ $formIndex }}" class="kalibrasi-input disabled-field" placeholder="Mengikuti Form 1" style="width: 45%; background-color: #e9ecef;" readonly disabled>
                                    @endif
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td><p style="margin: 0; color: #000000;">Nama Pemilik</p></td>
                            <td colspan="3">
                                @if($isFirstForm)
                                    <input type="text" name="nama_pemilik" id="nama_pemilik_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan nama pemilik / instansi" required>
                                @else
                                    <input type="text" name="nama_pemilik_display" id="nama_pemilik_{{ $formIndex }}" class="kalibrasi-input disabled-field" placeholder="Mengikuti Form 1" style="background-color: #e9ecef;" readonly disabled>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td><p style="margin: 0; color: #000000;">Tanggal Alat Masuk</p></td>
                            <td colspan="3">
                                @if($isFirstForm)
                                    <input type="date" name="tanggal_alat_masuk" id="tanggal_alat_masuk_{{ $formIndex }}" class="kalibrasi-input" value="{{ date('Y-m-d') }}" required>
                                @else
                                    <input type="date" name="tanggal_alat_masuk_display" id="tanggal_alat_masuk_{{ $formIndex }}" class="kalibrasi-input disabled-field" style="background-color: #e9ecef;" readonly disabled>
                                @endif
                            </td>
                        </tr>
                        
                        <tr>
                            <td><p style="margin: 0; color: #000000;">Tanggal Kalibrasi</p></td>
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

                        <tr>
                            <td><p style="margin: 0; color: #000000;">Tempat Kalibrasi</p></td>
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
                            <td><p style="margin: 0; color: #000000;">Lokasi PT</p></td>
                            <td colspan="3">
                                @if($isFirstForm)
                                    <input type="text" name="lokasi_pt" id="lokasi_pt_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan Lokasi PT">
                                @else
                                    <input type="text" name="lokasi_pt_display" id="lokasi_pt_{{ $formIndex }}" class="kalibrasi-input disabled-field" placeholder="Mengikuti Form 1" style="background-color: #e9ecef;" readonly disabled>
                                @endif
                            </td>
                        </tr>
                           <tr>
                            <td><p style="margin: 0; color: #000000;">Kode TH</p></td>
                            <td colspan="3">
                                @if($isFirstForm)
                                    <input type="text" name="kode_th" id="kode_th_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan Kode TH">
                                @else
                                    <input type="text" name="kode_th_display" id="kode_th_{{ $formIndex }}" class="kalibrasi-input disabled-field" placeholder="Mengikuti Form 1" style="background-color: #e9ecef;" readonly disabled>
                                @endif
                            </td>
                        </tr>
                    </table>

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
                                    <td><input type="text" name="suhu_awal" id="suhu_awal_{{ $formIndex }}" class="kondisi-input"  placeholder="0.0" {{ $isFirstForm ? 'required' : 'disabled' }}></td>
                                    <td><input type="text" name="suhu_tengah" id="suhu_tengah_{{ $formIndex }}" class="kondisi-input"  placeholder="0.0" {{ $isFirstForm ? 'required' : 'disabled' }}></td>
                                    <td><input type="text" name="suhu_akhir" id="suhu_akhir_{{ $formIndex }}" class="kondisi-input"  placeholder="0.0" {{ $isFirstForm ? 'required' : 'disabled' }}></td>
                                </tr>
                                <tr>
                                    <td class="bg-light fw-bold" style="color: #000000;">RH (%)</td>
                                    <td><input type="text" name="rh_awal" id="rh_awal_{{ $formIndex }}" class="kondisi-input"  placeholder="0.0" {{ $isFirstForm ? 'required' : 'disabled' }}></td>
                                    <td><input type="text" name="rh_tengah" id="rh_tengah_{{ $formIndex }}" class="kondisi-input"  placeholder="0.0" {{ $isFirstForm ? 'required' : 'disabled' }}></td>
                                    <td><input type="text" name="rh_akhir" id="rh_akhir_{{ $formIndex }}" class="kondisi-input"  placeholder="0.0" {{ $isFirstForm ? 'required' : 'disabled' }}></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- DATA KALIBRASI Section -->
                    <div class="data-kalibrasi-header" style="color: #000000;">DATA KALIBRASI</div>
                    
                    <!-- BAGIAN 1: PEMERIKSAAN KESEJAJARAN MUKA UKUR EKSTERNAL -->
                    <div class="mb-3">
                        <ol type="1" style="margin:0pt; padding-left:0pt">
                            <li class="ListParagraph" style="text-indent:0pt; font-size:11pt; font-weight:bold">
                                <span>Pemeriksaan Kesejajaran Muka Ukur Eksternal</span>
                            </li>
                        </ol>
                        <table cellspacing="0" cellpadding="0" class="TableNormal" style="margin-left:15.48pt; border:0.75pt solid #000000; border-collapse:collapse; width:100%">
                            <tr style="height:10.05pt">
                                <td style="width:25%; border:0.75pt solid #000000; vertical-align:top; background-color:#bebebe">
                                    <p style="text-align:center; line-height:9.05pt; padding:4pt">
                                        <span style="font-family:Arial; font-size:9.5pt; font-weight:bold">Titik Ukur</span>
                                    </p>
                                </td>
                                <td style="width:25%; border:0.75pt solid #000000; vertical-align:top; background-color:#bebebe">
                                    <p style="text-align:center; line-height:9.05pt; padding:4pt">
                                        <span style="font-family:Arial; font-size:9.5pt; font-weight:bold">Atas / Pangkal</span>
                                    </p>
                                </td>
                                <td style="width:25%; border:0.75pt solid #000000; vertical-align:top; background-color:#bebebe">
                                    <p style="text-align:center; line-height:9.05pt; padding:4pt">
                                        <span style="font-family:Arial; font-size:9.5pt; font-weight:bold">Tengah</span>
                                    </p>
                                </td>
                                <td style="width:25%; border:0.75pt solid #000000; vertical-align:top; background-color:#bebebe">
                                    <p style="text-align:center; line-height:9.05pt; padding:4pt">
                                        <span style="font-family:Arial; font-size:9.5pt; font-weight:bold">Bawah / Ujung</span>
                                    </p>
                                </td>
                            </tr>
                            <tr style="height:12.65pt">
                                <td style="width:25%; border:0.75pt solid #000000; vertical-align:top; padding:4pt; position:relative">
                                    <div style="display:flex; align-items:center; width:100%;">
                                        <input type="text"
                                            name="titikUkurKesejajaran_{{ $formIndex }}" 
                                            value=""
                                            style="flex:1; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                                        <span style="font-size:9.5pt; color:#666; margin-left:4px;">mm</span>
                                    </div>
                                </td>
                                <td style="width:25%; border:0.75pt solid #000000; vertical-align:top; padding:4pt">
                                    <input type="text" 
                                        name="kesejajaranAwal_{{ $formIndex }}" 
                                        value=""
                                        style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                                </td>
                                <td style="width:25%; border:0.75pt solid #000000; vertical-align:top; padding:4pt">
                                    <input type="text" 
                                        name="kesejajaranTengah_{{ $formIndex }}" 
                                        value=""
                                        style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                                </td>
                                <td style="width:25%; border:0.75pt solid #000000; vertical-align:top; padding:4pt">
                                    <input type="text" 
                                        name="kesejajaranAkhir_{{ $formIndex }}" 
                                        value=""
                                        style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- BAGIAN 2: PENGUKURAN DALAM DENGAN UJUNG PISAU BERSILANG -->
                    <div class="mb-3">
                        <ol start="2" type="1" style="margin:0pt; padding-left:0pt">
                            <li class="ListParagraph" style="margin-top:4.85pt; text-indent:0pt; font-size:11pt; font-weight:bold">
                                <span>Pengukuran Dalam Dengan Ujung Pisau Bersilang</span>
                            </li>
                        </ol>
                        <table cellspacing="0" cellpadding="0" class="TableNormal" style="margin-left:15.48pt; border:0.75pt solid #000000; border-collapse:collapse; width:100%">
                            <tr style="height:12pt">
                                <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                                    <p style="text-align:center; line-height:11pt; padding:6pt">
                                        <span style="font-family:Arial; font-size:10pt; font-weight:bold">Titik Ukur</span>
                                    </p>
                                </td>
                                <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                                    <p style="text-align:center; line-height:11pt; padding:6pt">
                                        <span style="font-family:Arial; font-size:10pt; font-weight:bold">Pembacaan-1</span>
                                    </p>
                                </td>
                                <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                                    <p style="text-align:center; line-height:11pt; padding:6pt">
                                        <span style="font-family:Arial; font-size:10pt; font-weight:bold">Pembacaan-2</span>
                                    </p>
                                </td>
                                <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                                    <p style="text-align:center; line-height:11pt; padding:6pt">
                                        <span style="font-family:Arial; font-size:10pt; font-weight:bold">Pembacaan-3</span>
                                    </p>
                                </td>
                            </tr>
                            <tr style="height:16pt">
                                <td style="width:25%; border:0.75pt solid #000000; vertical-align:top; padding:4pt; position:relative">
                                    <div style="display:flex; align-items:center; width:100%;">
                                        <input type="text"
                                            name="pengukuranDalamPisauBersilang_{{ $formIndex }}" 
                                            value=""
                                            style="flex:1; border:none; background:transparent; text-align:center; font-size:9.5pt; color:#000; padding:2px;">
                                        <span style="font-size:9.5pt; color:#666; margin-left:4px;">mm</span>
                                    </div>
                                </td>
                                <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                                    <input type="text" 
                                        name="pembacaan1_{{ $formIndex }}" 
                                        value=""
                                        style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:10pt; color:#000; padding:4px;">
                                </td>
                                <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                                    <input type="text" 
                                        name="pembacaan2_{{ $formIndex }}" 
                                        value=""
                                        style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:10pt; color:#000; padding:4px;">
                                </td>
                                <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                                    <input type="text" 
                                        name="pembacaan3_{{ $formIndex }}" 
                                        value=""
                                        style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:10pt; color:#000; padding:4px;">
                                </td>
                            </tr>
                        </table>
                    </div>

                 <!-- BAGIAN 3: PENGUKURAN OUTSIDE -->
<div class="mb-3">
    <ol start="3" type="1" style="margin:0pt; padding-left:0pt">
        <li class="ListParagraph" style="margin-top:4.85pt; text-indent:0pt; font-size:11pt; font-weight:bold">
            <span>Pengukuran Outside</span>
        </li>
    </ol>
    
    @php
        $capacity = $capacity ?? 300;
        if ($capacity == 100) {
            $values = [0, 20, 50, 100];
        } elseif ($capacity == 150) {
            $values = [0, 20, 50, 100, 150];
        } elseif ($capacity == 200) {
            $values = [0, 20, 50, 100, 150, 200];
        } elseif ($capacity == 300) {
            $values = [0, 20, 50, 100, 150, 200, 250, 300];
        } elseif ($capacity == 450) {
            $values = [0, 50, 100, 200, 300, 350, 400, 450];
        } elseif ($capacity == 600) {
            $values = [0, 50, 100, 200, 300, 400, 500, 600];
        } elseif ($capacity == 1000) {
            $values = [0, 100, 300, 500, 700, 800, 900, 1000];
        } else {
            $values = [0, 20, 50, 100, 150, 200, 250, 300];
        }
    @endphp
    
    <table cellspacing="0" cellpadding="0" class="TableNormal" style="margin-left:15.48pt; border:0.75pt solid #000000; border-collapse:collapse; width:100%">
        <tr style="height:12pt">
            <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <div style="text-align:center; padding:6pt">
                    <div style="margin-bottom: 8px; line-height:11pt;">
                        <span style="font-family:Arial; font-size:10pt; font-weight:bold">Titik Ukur</span>
                    </div>
                    <div>
                        <span style="font-family:Arial; font-size:9pt; font-weight:bold">Unit (</span>
                        <input type="text" 
                            name="satuan_unit_outside_{{ $formIndex }}" 
                            value=" "
                            style="width: 50px; padding: 2px; border: 1px solid #666; border-radius: 3px; text-align: center; font-size: 9pt; background: white;">
                        <span style="font-family:Arial; font-size:9pt; font-weight:bold">)</span>
                    </div>
                </div>
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Penunjukan 1</span>
                </p>
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Penunjukan 2</span>
                </p>
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Penunjukan 3</span>
                </p>
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Penunjukan 4</span>
                </p>
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Penunjukan 5</span>
                </p>
            </td>
        </tr>
        
        @php
            $maxRows = 14;
            $outsideValues = $values;
            $outsideFilledCount = count($outsideValues);
        @endphp

        @for($rowIndex = 0; $rowIndex < $maxRows; $rowIndex++)
            @php
                $value = $rowIndex < $outsideFilledCount ? $outsideValues[$rowIndex] : '';
                $isFilled = $rowIndex < $outsideFilledCount;
            @endphp
            <tr style="height:16pt">
                <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text"
                        name="outside_titik_ukur_{{ $formIndex }}[{{ $rowIndex }}]" 
                        value="{{ $value }}"
                        placeholder="{{ $isFilled ? '' : 'opsional' }}"
                        style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:10pt; color:#000; padding:4px; {{ !$isFilled ?  : '' }}">
                </td>
                <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text"
                        name="outside_ulangan01_{{ $formIndex }}[{{ $rowIndex }}]" 
                        value=""
                        style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:10pt; color:#000; padding:4px;">
                </td>
                <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text"
                        name="outside_ulangan02_{{ $formIndex }}[{{ $rowIndex }}]" 
                        value=""
                        style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:10pt; color:#000; padding:4px;">
                </td>
                <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text"
                        name="outside_ulangan03_{{ $formIndex }}[{{ $rowIndex }}]" 
                        value=""
                        style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:10pt; color:#000; padding:4px;">
                </td>
                <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text"
                        name="outside_ulangan04_{{ $formIndex }}[{{ $rowIndex }}]" 
                        value=""
                        style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:10pt; color:#000; padding:4px;">
                </td>
                <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text"
                        name="outside_ulangan05_{{ $formIndex }}[{{ $rowIndex }}]" 
                        value=""
                        style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:10pt; color:#000; padding:4px;">
                </td>
            </tr>
        @endfor
       
    </table>
</div>
<!-- BAGIAN 4: PENGUKURAN INSIDE -->
<div class="mb-3">
    <ol start="4" type="1" style="margin:0pt; padding-left:0pt">
        <li class="ListParagraph" style="margin-top:4.85pt; text-indent:0pt; font-size:11pt; font-weight:bold">
            <span>Pengukuran Inside</span>
        </li>
    </ol>
    
    @php
        // INSIDE menggunakan nilai yang sama dengan OUTSIDE (kecuali nilai 0 untuk awal)
        if ($capacity == 100) {
            $insideValues = [20, 50, 100]; // tanpa 0
        } elseif ($capacity == 150) {
            $insideValues = [20, 50, 100, 150];
        } elseif ($capacity == 200) {
            $insideValues = [20, 50, 100, 150, 200];
        } elseif ($capacity == 300) {
            $insideValues = [20, 50, 100, 150, 200, 250, 300];
        } elseif ($capacity == 450) {
            $insideValues = [50, 100, 200, 300, 350, 400, 450];
        } elseif ($capacity == 600) {
            $insideValues = [50, 100, 200, 300, 400, 500, 600];
        } elseif ($capacity == 1000) {
            $insideValues = [100, 300, 500, 700, 800, 900, 1000];
        } else {
            $insideValues = [20, 50, 100, 150, 200, 250, 300];
        }
    @endphp
    
    <table cellspacing="0" cellpadding="0" class="TableNormal" style="margin-left:15.48pt; border:0.75pt solid #000000; border-collapse:collapse; width:100%">
        <tr style="height:12pt">
            <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <div style="text-align:center; padding:6pt">
                    <div style="margin-bottom: 8px; line-height:11pt;">
                        <span style="font-family:Arial; font-size:10pt; font-weight:bold">Titik Ukur</span>
                    </div>
                    <div>
                        <span style="font-family:Arial; font-size:9pt; font-weight:bold">Unit (</span>
                        <input type="text" 
                            name="satuan_unit_inside_{{ $formIndex }}" 
                            value=" "
                            style="width: 50px; padding: 2px; border: 1px solid #666; border-radius: 3px; text-align: center; font-size: 9pt; background: white;">
                        <span style="font-family:Arial; font-size:9pt; font-weight:bold">)</span>
                    </div>
                </div>
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Penunjukan 1</span>
                </p>
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Penunjukan 2</span>
                </p>
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Penunjukan 3</span>
                </p>
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Penunjukan 4</span>
                </p>
            </td>
            <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Penunjukan 5</span>
                </p>
            </td>
        </tr>
        
       @php
            $maxRows = 14;
            $insideValuesLocal = $insideValues;
            $insideFilledCount = count($insideValuesLocal);
        @endphp

        @for($rowIndex = 0; $rowIndex < $maxRows; $rowIndex++)
            @php
                $value = $rowIndex < $insideFilledCount ? $insideValuesLocal[$rowIndex] : '';
                $isFilled = $rowIndex < $insideFilledCount;
            @endphp
            <tr style="height:16pt">
                <td style="width:25%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text"
                        name="inside_titik_ukur_{{ $formIndex }}[{{ $rowIndex }}]" 
                        value="{{ $value }}"
                        placeholder="{{ $isFilled ? '' : 'opsional' }}"
                        style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:10pt; color:#000; padding:4px; {{ !$isFilled ?  : '' }}">
                </td>
                <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text"
                        name="inside_ulangan01_{{ $formIndex }}[{{ $rowIndex }}]" 
                        value=""
                        style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:10pt; color:#000; padding:4px;">
                </td>
                <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text"
                        name="inside_ulangan02_{{ $formIndex }}[{{ $rowIndex }}]" 
                        value=""
                        style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:10pt; color:#000; padding:4px;">
                </td>
                <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text"
                        name="inside_ulangan03_{{ $formIndex }}[{{ $rowIndex }}]" 
                        value=""
                        style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:10pt; color:#000; padding:4px;">
                </td>
                <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text"
                        name="inside_ulangan04_{{ $formIndex }}[{{ $rowIndex }}]" 
                        value=""
                        style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:10pt; color:#000; padding:4px;">
                </td>
                <td style="width:15%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text"
                        name="inside_ulangan05_{{ $formIndex }}[{{ $rowIndex }}]" 
                        value=""
                        style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:10pt; color:#000; padding:4px;">
                </td>
            </tr>
        @endfor
    </table>
</div>

<!-- BAGIAN 5: PENGUKURAN DEPTH -->
<div class="mb-3">
    <ol start="5" type="1" style="margin:0pt; padding-left:0pt">
        <li class="ListParagraph" style="margin-top:4.85pt; text-indent:0pt; font-size:11pt; font-weight:bold">
            <span>Pengukuran Depth</span>
        </li>
    </ol>
    
    @php
        // DEPTH menggunakan nilai yang SAMA PERSIS dengan OUTSIDE
        $capacity = $capacity ?? 300;
        if ($capacity == 100) {
            $depthValues = [0, 20, 50, 100];
        } elseif ($capacity == 150) {
            $depthValues = [0, 20, 50, 100, 150];
        } elseif ($capacity == 200) {
            $depthValues = [0, 20, 50, 100, 150, 200];
        } elseif ($capacity == 300) {
            $depthValues = [0, 20, 50, 100, 150, 200, 250, 300];
        } elseif ($capacity == 450) {
            $depthValues = [0, 50, 100, 200, 300, 350, 400, 450];
        } elseif ($capacity == 600) {
            $depthValues = [0, 50, 100, 200, 300, 400, 500, 600];
        } elseif ($capacity == 1000) {
            $depthValues = [0, 100, 300, 500, 700, 800, 900, 1000];
        } else {
            $depthValues = [0, 20, 50, 100, 150, 200, 250, 300];
        }
    @endphp
    
    <table cellspacing="0" cellpadding="0" class="TableNormal" style="margin-left:15.48pt; border:0.75pt solid #000000; border-collapse:collapse; width:100%">
        <!-- Header Row 1 -->
        <tr style="height:12pt">
            <td style="width:20%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <div style="text-align:center; padding:6pt">
                    <div style="margin-bottom: 8px; line-height:11pt;">
                        <span style="font-family:Arial; font-size:10pt; font-weight:bold">Titik Ukur</span>
                    </div>
                    <div>
                        <span style="font-family:Arial; font-size:9pt; font-weight:bold">Unit (</span>
                        <input type="text" 
                            name="satuan_unit_depth_{{ $formIndex }}" 
                            value=" "
                            style="width: 50px; padding: 2px; border: 1px solid #666; border-radius: 3px; text-align: center; font-size: 9pt; background: white;">
                        <span style="font-family:Arial; font-size:9pt; font-weight:bold">)</span>
                    </div>
                </div>
            </td>
            <td colspan="2" style="width:20%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Kode Standar yang Digunakan</span>
                </p>
            </td>
            <td colspan="5" style="width:60%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Penunjukan Alat</span>
                </p>
            </td>
        </tr>
        
        <!-- Header Row 2 -->
        <tr style="height:12pt">
            <td style="width:20%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">Nilai Nominal</span>
                </p>
            </td>
            <td style="width:10%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:9.5pt; font-weight:bold">Kiri</span>
                </p>
            </td>
            <td style="width:10%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:9.5pt; font-weight:bold">Kanan</span>
                </p>
            </td>
            <td style="width:12%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:9.5pt; font-weight:bold">1</span>
                </p>
            </td>
            <td style="width:12%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:9.5pt; font-weight:bold">2</span>
                </p>
            </td>
            <td style="width:12%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:9.5pt; font-weight:bold">3</span>
                </p>
            </td>
            <td style="width:12%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:9.5pt; font-weight:bold">4</span>
                </p>
            </td>
            <td style="width:12%; border:0.75pt solid #000000; vertical-align:middle; background-color:#bebebe">
                <p style="text-align:center; line-height:11pt; padding:6pt">
                    <span style="font-family:Arial; font-size:9.5pt; font-weight:bold">5</span>
                </p>
            </td>
        </tr>
        
        <!-- Data Rows -->
       @php
            $maxRows = 14;
            $depthValuesLocal = $depthValues;
            $depthFilledCount = count($depthValuesLocal);
        @endphp

        @for($rowIndex = 0; $rowIndex < $maxRows; $rowIndex++)
            @php
                $value = $rowIndex < $depthFilledCount ? $depthValuesLocal[$rowIndex] : '';
                $isFilled = $rowIndex < $depthFilledCount;
            @endphp
            <tr style="height:16pt">
                <td style="width:20%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text"
                        name="depth_titik_ukur_{{ $formIndex }}[{{ $rowIndex }}]" 
                        value="{{ $value }}"
                        placeholder="{{ $isFilled ? '' : 'opsional' }}"
                        style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:10pt; color:#000; padding:4px; {{ !$isFilled ?  : '' }}">
                </td>
                <td style="width:10%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text"
                        name="depth_kode_standard_kiri_{{ $formIndex }}[{{ $rowIndex }}]" 
                        value=""
                        style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:10pt; color:#000; padding:4px;">
                </td>
                <td style="width:10%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text"
                        name="depth_kode_standard_kanan_{{ $formIndex }}[{{ $rowIndex }}]" 
                        value=""
                        style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:10pt; color:#000; padding:4px;">
                </td>
                <td style="width:12%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text"
                        name="depth_ulangan01_{{ $formIndex }}[{{ $rowIndex }}]" 
                        value=""
                        style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:10pt; color:#000; padding:4px;">
                </td>
                <td style="width:12%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text"
                        name="depth_ulangan02_{{ $formIndex }}[{{ $rowIndex }}]" 
                        value=""
                        style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:10pt; color:#000; padding:4px;">
                </td>
                <td style="width:12%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text"
                        name="depth_ulangan03_{{ $formIndex }}[{{ $rowIndex }}]" 
                        value=""
                        style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:10pt; color:#000; padding:4px;">
                </td>
                <td style="width:12%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text"
                        name="depth_ulangan04_{{ $formIndex }}[{{ $rowIndex }}]" 
                        value=""
                        style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:10pt; color:#000; padding:4px;">
                </td>
                <td style="width:12%; border:0.75pt solid #000000; vertical-align:middle; padding:6pt">
                    <input type="text"
                        name="depth_ulangan05_{{ $formIndex }}[{{ $rowIndex }}]" 
                        value=""
                        style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:10pt; color:#000; padding:4px;">
                </td>
            </tr>
        @endfor
    </table>
</div>
                    <!-- Footer Section -->
                    <table class="kalibrasi-main-table">
                        <tr>
                            <td colspan="6" style="text-align: center; border-bottom: 1px solid #000;">
                                <span style="font-weight: bold; font-size: 18px; color: #000000;">Isilah lembar data kalibrasi dengan lengkap dan jelas!</span>
                            </td>
                        </tr>

                        <tr style="height:13.5pt">
                            <td rowspan="5" style="width:105.35pt; border:1pt solid #000; vertical-align:middle; text-align:center; font-weight:bold; font-size:10pt; color:#000000;">
                                Alat<br>Standar
                            </td>

                            <td style="width:24.75pt; border:1pt solid #000; text-align:center; vertical-align:middle;">
                                <input type="checkbox" name="alat_standar_{{ $formIndex }}[]" value="Caliper Checker D.001" id="alat1_{{ $formIndex }}">
                            </td>
                            <td colspan="2" style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
                                <label for="alat1_{{ $formIndex }}" style="cursor:pointer; color:#000000;">Caliper Checker D.001</label>
                            </td>

                            <td rowspan="5" style="width:111.15pt; border:1pt solid #000; padding-top:6pt; text-align:center; vertical-align:top; font-size:8.5pt; color:#000000;">
                                Dikalibrasi<br>oleh
                            </td>
                            <td rowspan="5" style="width:98.3pt; border:1pt solid #000; padding-top:6pt; text-align:center; vertical-align:top; font-size:8.5pt; color:#000000;">
                                Diperiksa<br>oleh
                            </td>
                        </tr>

                        <tr style="height:13.5pt">
                            <td style="border:1pt solid #000; text-align:center; vertical-align:middle;">
                                <input type="checkbox" name="alat_standar_{{ $formIndex }}[]" value="Caliper Checker D.001B" id="alat2_{{ $formIndex }}">
                            </td>
                            <td colspan="2" style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
                                <label for="alat2_{{ $formIndex }}" style="cursor:pointer; color:#000000;">Caliper Checker D.001B</label>
                            </td>
                        </tr>

                        <tr style="height:13.5pt">
                            <td style="border:1pt solid #000; text-align:center; vertical-align:middle;">
                                <input type="checkbox" name="alat_standar_{{ $formIndex }}[]" value="Gauge Block Set Grade 0" id="alat3_{{ $formIndex }}">
                            </td>
                            <td colspan="2" style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
                                <label for="alat3_{{ $formIndex }}" style="cursor:pointer; color:#000000;">Gauge Block Set Grade 0</label>
                            </td>
                        </tr>

                        <tr style="height:13.5pt">
                            <td style="border:1pt solid #000; text-align:center; vertical-align:middle;">
                                <input type="checkbox" name="alat_standar_{{ $formIndex }}[]" value="Pin Gauge 15 mm" id="alat4_{{ $formIndex }}">
                            </td>
                            <td colspan="2" style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
                                <label for="alat4_{{ $formIndex }}" style="cursor:pointer; color:#000000;">Pin Gauge 15 mm</label>
                            </td>
                        </tr>

                        <tr style="height:13.5pt">
                            <td style="border:1pt solid #000; text-align:center; vertical-align:middle;">
                                <input type="checkbox" name="alat_standar_{{ $formIndex }}[]" value="Ring Gauge 5 mm" id="alat5_{{ $formIndex }}">
                            </td>
                            <td colspan="2" style="border:1pt solid #000; padding-left:12.1pt; font-size:8.5pt; vertical-align:middle; color:#000000;">
                                <label for="alat5_{{ $formIndex }}" style="cursor:pointer; color:#000000;">Ring Gauge 5 mm</label>
                            </td>
                        </tr>

                        <tr style="height:15pt">
                            <td rowspan="2" style="width:105.35pt; border:1pt solid #000; padding:8.6pt 0 0 20.5pt; font-size:8.5pt; vertical-align:top; color:#000000;">
                                Metode Kalibrasi
                            </td>
                            <td colspan="3" rowspan="2" style="border:1pt solid #000; padding:3.2pt 5.25pt 0 8.85pt; font-size:8.5pt; line-height:112%; vertical-align:top; color:#000000;">
                                PAS-IK1102-03 (JIS B 7507:2022 (JMA/JSA); SNSU PK.P-02:2020).
                            </td>
                            <td style="width:111.15pt; border:1pt solid #000; padding:3.35pt 0 0 1.35pt; font-size:8.5pt; vertical-align:top; color:#000000;">
                                <input type="text" name="calibrated_by" class="kalibrasi-input" value="{{ auth()->user()->nama ?? 'System' }}" placeholder="Nama" style="border: none; width: 100%; background-color: #f8f9fa;" readonly>
                            </td>
                            <td style="width:98.3pt; border:1pt solid #000; padding:3.35pt 0 0 1.8pt; font-size:8.5pt; vertical-align:top; color:#000000;">
                                <input type="text" name="verified_by" id="verified_by_{{ $formIndex }}" class="kalibrasi-input" placeholder="-" style="border: none; width: 100%;" {{ $isFirstForm ? 'readonly' : '' }}>
                            </td>
                        </tr>

                        <tr style="height:11.95pt">
                            <td style="width:111.15pt; border:1pt solid #000; padding:1.8pt 0 0 1.35pt; font-size:8.5pt; vertical-align:top; color:#000000;">
                                TTD :
                            </td>
                            <td style="width:98.3pt; border:1pt solid #000; padding:1.8pt 0 0 1.8pt; font-size:8.5pt; vertical-align:top; color:#000000;">
                                TTD :
                            </td>
                        </tr>
                    </table>

                    @if($formIndex == $count)
                    <div class="row mt-5">
                        <div class="col-12 text-center">
                            <button type="button" id="btnSimpanSemua" onclick="submitCaliperForms()" class="btn btn-primary btn-lg" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
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
    
    <!-- Modal No Label -->
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

    function getFormCount() {
        const urlParams = new URLSearchParams(window.location.search);
        const countParam = urlParams.get('count');
        if (countParam && !isNaN(parseInt(countParam))) {
            return Math.max(1, parseInt(countParam));
        }
        const savedCount = sessionStorage.getItem('current_jumlah_form');
        if (savedCount && !isNaN(parseInt(savedCount))) {
            return Math.max(1, parseInt(savedCount));
        }
        const firstForm = document.getElementById('kalibrasiForm1');
        if (firstForm) {
            const jumlahFormInput = firstForm.querySelector('input[name="jumlah_form"]');
            if (jumlahFormInput && jumlahFormInput.value) {
                return Math.max(1, parseInt(jumlahFormInput.value));
            }
        }
        return 1;
    }

    function setFormCount(count) {
        sessionStorage.setItem('current_jumlah_form', count.toString());
    }

    function updateAllJumlahFormValues(actualCount) {
        setFormCount(actualCount);
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
        
        const fieldsToSync = [
            'nama_alat', 'merek', 'kode_alat', 'type_alat', 'no_seri',
            'kapasitas', 'resolusi', 'nama_pemilik', 'tanggal_alat_masuk', 
            'tanggal_kalibrasi', 'tempat_kalibrasi', 'lokasi_pt', 'fungsi_komponen',
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
        
        console.log('Informasi umum alat disinkronkan dari Form 1 (alat standar tetap independen per form)');
    }
    
    function updateFormType(selectedAlat, formIndex) {
        const manualContainer = document.getElementById(`manualInputContainer_${formIndex}`);
        const manualInput = document.getElementById(`nama_alat_manual_${formIndex}`);
        const finalInput = document.getElementById(`nama_alat_final_${formIndex}`);
        
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
        
        if (formIndex == 1) setTimeout(syncAllFormsData, 100);
    }
    
    function syncNamaAlat(formIndex) {
        const manualInput = document.getElementById(`nama_alat_manual_${formIndex}`);
        const finalInput = document.getElementById(`nama_alat_final_${formIndex}`);
        if (manualInput && finalInput) {
            finalInput.value = manualInput.value;
            if (formIndex == 1) setTimeout(syncAllFormsData, 100);
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

    function disableRequiredOnHiddenForms() {
        const formCount = getFormCount();
        for (let i = 1; i <= formCount; i++) {
            const form = document.getElementById(`kalibrasiForm${i}`);
            if (!form) continue;
            const container = form.closest('.lk-form-container');
            const isVisible = container && window.getComputedStyle(container).display !== 'none';
            const requiredInputs = form.querySelectorAll('[required]');
            if (!isVisible && i !== 1) {
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
    // HANDLE SAVE SUCCESS - 3 TOMBOL
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

        const formName = container.getAttribute('data-form-name') || 'Caliper';
        const calibrationId = data.calibration_id || data.id || '-';
        const printLabelUrl = data.print_label_url || `/calibrations/${calibrationId}/print-label`;
        
        tabSubmitStatus[tabId] = {
            success: true,
            calibrationId: calibrationId,
            printLabelUrl: printLabelUrl,
            formName: formName,
            timestamp: Date.now()
        };
        
        // ðŸ”¥ TAMPILKAN 3 TOMBOL (BUKAN REDIRECT)
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
    // SUBMIT FORM - MODIFIKASI AGAR 3 PILIHAN
    // ==========================================
//   async function submitCaliperForms() {
//     console.log('ðŸš€ Memulai submit semua form...');
//     const activeTabId = getActiveTabId();
    
//     // ðŸ”¥ AMBIL JUMLAH FORM DARI DOM (BUKAN DARI URL)
//     const forms = [];
//     for (let i = 1; i <= 10; i++) { // Maksimal 10 form
//         const form = document.getElementById(`kalibrasiForm${i}`);
//         if (form) {
//             forms.push(form);
//             console.log(`âœ… Form ${i} ditemukan di DOM`);
//         } else {
//             break; // Stop jika form tidak ditemukan
//         }
//     }
    
//     const formCount = forms.length;
//     console.log('ðŸ“Š Submit - formCount from DOM:', formCount);
    
//     if (forms.length === 0) {
//         alert('Tidak ada form yang ditemukan!');
//         restoreRequiredOnAllForms();
//         return;
//     }
    
//     disableRequiredOnHiddenForms();
    
//     if (typeof syncAllFormsData === 'function') {
//         syncAllFormsData();
//     }
    
//     updateAllJumlahFormValues(formCount);
    
//     // Validasi hanya form yang visible
//     let activeFormValid = true;
//     for (let i = 0; i < forms.length; i++) {
//         const container = forms[i].closest('.lk-form-container');
//         const isVisible = container && window.getComputedStyle(container).display !== 'none';
//         if (isVisible && !forms[i].reportValidity()) {
//             alert(`Mohon lengkapi data pada Form ${i+1} terlebih dahulu!`);
//             activeFormValid = false;
//             break;
//         }
//     }
    
//     if (!activeFormValid) {
//         restoreRequiredOnAllForms();
//         return;
//     }
    
//     // Ambil data alat standar dari FORM 1
//     const form1 = document.getElementById('kalibrasiForm1');
//     const alatStandarForm1 = [];
//     form1.querySelectorAll('input[name="alat_standar_1[]"]:checked').forEach(cb => {
//         if (cb.value) alatStandarForm1.push(cb.value);
//     });
    
//     console.log('Alat standar dari form 1:', alatStandarForm1);
    
//     const btn = document.getElementById('btnSimpanSemua');
//     const originalText = btn.innerHTML;
//     btn.disabled = true;
//     btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan Data...';
    
//     try {
//         const combinedFormData = new FormData();
        
//         for (let i = 0; i < forms.length; i++) {
//             const form = forms[i];
//             const formData = new FormData(form);
//             const formIndex = i + 1;
            
//             console.log(`Processing Form ${formIndex}...`);
            
//             for (let [key, value] of formData.entries()) {
//                 if (key === '_token') continue;
                
//                 if (key.includes('alat_standar')) {
//                     continue;
//                 } else if (key !== 'form_index' && key !== 'jumlah_form') {
//                     combinedFormData.append(`form_${formIndex}_${key}`, value);
//                 }
//             }
            
//             alatStandarForm1.forEach(value => {
//                 combinedFormData.append(`form_${formIndex}_alat_standar_${formIndex}[]`, value);
//             });
            
//             combinedFormData.append(`form_${formIndex}_form_index`, formIndex);
//         }
        
//         combinedFormData.append('jumlah_form', formCount.toString());
//         combinedFormData.append('submit_all', 'true');
//         combinedFormData.append('form_type', 'caliper');
        
//         const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
//         combinedFormData.append('_token', csrfToken);
        
//         console.log('Submitting all forms together...');
        
//         const response = await fetch('/calibrations', {
//             method: 'POST',
//             body: combinedFormData,
//             headers: {
//                 'X-Requested-With': 'XMLHttpRequest',
//                 'Accept': 'application/json'
//             }
//         });
        
//         const contentType = response.headers.get('content-type');
        
//         let result;
//         if (contentType && contentType.includes('application/json')) {
//             result = await response.json();
//         } else {
//             const text = await response.text();
//             console.error('Non-JSON response:', text.substring(0, 500));
//             throw new Error('Server mengembalikan response yang tidak valid');
//         }
        
//         if (!response.ok) {
//             throw new Error(result.error || `Gagal menyimpan data: ${response.status}`);
//         }
        
//         console.log('Success:', result);
        
//         // ðŸ”¥ PANGGIL HANDLE SAVE SUCCESS (TIDAK REDIRECT)
//         if (typeof window.handleSaveSuccess === 'function') {
//             window.handleSaveSuccess(activeTabId, result);
//         } else {
//             alert('Data berhasil disimpan!');
//         }
        
//         btn.disabled = false;
//         btn.innerHTML = originalText;
//         restoreRequiredOnAllForms();
        
//     } catch (err) {
//         console.error('Submit error:', err);
//         alert('Error: ' + err.message);
//         btn.disabled = false;
//         btn.innerHTML = originalText;
//         restoreRequiredOnAllForms();
//     }
// }

async function submitCaliperForms() {
    console.log('🚀 Memulai submit semua form...');
    const activeTabId = getActiveTabId();
    
    const forms = [];
    let formIdx = 1;
    while (true) {
        const form = document.getElementById(`kalibrasiForm${formIdx}`);
        if (form) {
            forms.push(form);
            formIdx++;
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
    
    updateAllJumlahFormValues(formCount);
    
    // Validasi
    for (let i = 0; i < forms.length; i++) {
        const container = forms[i].closest('.lk-form-container');
        const isVisible = container && window.getComputedStyle(container).display !== 'none';
        if (isVisible && !forms[i].reportValidity()) {
            alert(`Mohon lengkapi data pada Form ${i+1} terlebih dahulu!`);
            return;
        }
    }
    
    const btn = document.getElementById('btnSimpanSemua');
    const originalText = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan Data...';
    
    try {
        // ✅ BUAT FormData BARU (bukan combinedFormData)
        const formData = new FormData();
        
        // ✅ Ambil data dari SEMUA form dengan KEY ASLI
        for (let i = 0; i < forms.length; i++) {
            const form = forms[i];
            const currentFormData = new FormData(form);
            const formIndex = i + 1;
            
            console.log(`📤 Processing Form ${formIndex}...`);
            
            // Ambil semua data dari form ini
            for (let [key, value] of currentFormData.entries()) {
                // Skip token, form_index, jumlah_form (akan ditambahkan nanti)
                if (key === '_token' || key === 'form_index' || key === 'jumlah_form') {
                    continue;
                }
                
                // ✅ KIRIM DENGAN KEY ASLI
                formData.append(key, value);
                
                // ✅ KIRIM JUGA DENGAN PREFIX form_{formIndex}_ (seperti inside_micrometer & multiple tools lainnya)
                if (!key.match(/^form_\d+_/)) {
                    formData.append(`form_${formIndex}_${key}`, value);
                }
            }
        }
        
        // ✅ Tambahkan metadata
        formData.append('jumlah_form', formCount.toString());
        formData.append('form_type', 'caliper');
        formData.append('submit_all', 'true');
        formData.append('tab_id', activeTabId);
        
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        formData.append('_token', csrfToken);
        
        console.log('📤 Submitting all forms with ORIGINAL keys...');
        
        const response = await fetch('/calibrations', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        });
        
        let result;
        const contentType = response.headers.get('content-type');
        if (contentType && contentType.includes('application/json')) {
            result = await response.json();
        } else {
            const text = await response.text();
            console.error('❌ Non-JSON response:', text.substring(0, 500));
            throw new Error('Server mengembalikan response yang tidak valid');
        }
        
        if (!response.ok) {
            throw new Error(result.error || `Gagal menyimpan data: ${response.status}`);
        }
        
        console.log('✅ Success:', result);
        
        if (typeof window.handleSaveSuccess === 'function') {
            window.handleSaveSuccess(activeTabId, result);
        } else {
            alert('Data berhasil disimpan!');
        }
        
        btn.disabled = false;
        btn.innerHTML = originalText;
        
    } catch (err) {
        console.error('❌ Submit error:', err);
        alert('Error: ' + err.message);
        btn.disabled = false;
        btn.innerHTML = originalText;
    }
}
    
    document.addEventListener('DOMContentLoaded', function() {
        const formCount = getFormCount();
        console.log('DOM loaded, formCount:', formCount);
        
        const form1Select = document.getElementById('nama_alat_select_1');
        if (form1Select) {
            updateFormType(form1Select.value, 1);
            form1Select.addEventListener('change', function() {
                updateFormType(this.value, 1);
            });
        }
        
        if (formCount > 1) {
            setTimeout(syncAllFormsData, 500);
            
            const form1 = document.getElementById('kalibrasiForm1');
            if (form1) {
                const inputs = form1.querySelectorAll('input, select, textarea');
                inputs.forEach(input => {
                    input.addEventListener('change', () => syncAllFormsData());
                    input.addEventListener('input', () => syncAllFormsData());
                });
            }
        }
    });
</script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>