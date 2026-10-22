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
    
    <title>Form Kalibrasi Feeler Gauge - PT. PANANJUNG ANUGRAH SOLUTION</title>
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
        
        .form-card {
            border: 2px solid #3b82f6;
            border-radius: 8px;
            margin-bottom: 30px;
            break-inside: avoid;
            page-break-inside: avoid;
        }

        .form-card-header {
            background: linear-gradient(135deg, #1e40af, #3b82f6);
            color: white;
            padding: 12px 20px;
            border-radius: 6px 6px 0 0;
        }

        .form-card-body {
            padding: 20px;
            background: white;
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
        <i class="fas fa-file-alt" style="margin-right:8px;"></i>Form Feeler Gauge ke-{{ $formIndex }}
        @if(!$isFirstForm)
        <span style="font-size:12px; margin-left:10px;">
            <i class="fas fa-info-circle"></i> Field informasi alat mengikuti Form 1
        </span>
        @endif
    </div>
    @endif
        
   <div class="w-100 my-4">
            <form method="POST" action="/calibrations" id="kalibrasiForm{{ $formIndex }}" data-form-index="{{ $formIndex }}">
                @csrf
                <input type="hidden" name="form_type" value="feeler_gauge">
                <input type="hidden" name="jumlah_form" value="{{ $count }}">
                <input type="hidden" name="form_index" value="{{ $formIndex }}">
                <input type="hidden" name="no_label" id="no_label_hidden{{ $formIndex }}" value="">
                
                @if(!$isFirstForm)
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
                    
                    <!-- Hidden untuk data tabel -->
                    <input type="hidden" name="satuan_unit_uut" id="satuan_unit_uut_hidden_{{ $formIndex }}" value="">
                    <input type="hidden" name="satuan_unit_gauge_block" id="satuan_unit_gauge_block_hidden_{{ $formIndex }}" value="">
                    @for($i = 1; $i <= 25; $i++)
                        <input type="hidden" name="nominal_uut_{{ $i }}" id="nominal_uut_hidden_{{ $formIndex }}_{{ $i }}" value="">
                        <input type="hidden" name="nominal_gb_{{ $i }}" id="nominal_gb_hidden_{{ $formIndex }}_{{ $i }}" value="">
                        <input type="hidden" name="ab_gb_a_{{ $i }}" id="ab_gb_a_hidden_{{ $formIndex }}_{{ $i }}" value="">
                        <input type="hidden" name="ab_uut_b_{{ $i }}" id="ab_uut_b_hidden_{{ $formIndex }}_{{ $i }}" value="">
                        <input type="hidden" name="ab_gb_a2_{{ $i }}" id="ab_gb_a2_hidden_{{ $formIndex }}_{{ $i }}" value="">
                        <input type="hidden" name="ab_uut_b2_{{ $i }}" id="ab_uut_b2_hidden_{{ $formIndex }}_{{ $i }}" value="">
                        <input type="hidden" name="ac_gb_a_{{ $i }}" id="ac_gb_a_hidden_{{ $formIndex }}_{{ $i }}" value="">
                        <input type="hidden" name="ac_uut_c_{{ $i }}" id="ac_uut_c_hidden_{{ $formIndex }}_{{ $i }}" value="">
                        <input type="hidden" name="ac_gb_a2_{{ $i }}" id="ac_gb_a2_hidden_{{ $formIndex }}_{{ $i }}" value="">
                        <input type="hidden" name="ac_uut_c2_{{ $i }}" id="ac_uut_c2_hidden_{{ $formIndex }}_{{ $i }}" value="">
                    @endfor
                @endif

                <div class="form-kalibrasi-container">
                    <table class="kalibrasi-header-table">
                        <tr>
                            <td colspan="2">
                                <p style="margin: 0; font-size: 14px;">PAS-FLK62</p>
                            </td>
                            <td rowspan="5" style="text-align: center; vertical-align: middle; padding: 10px 0;">
                                <div style="display: inline-block; text-align: center;">
                                    <div style="margin-bottom: 15px;">
                                        <img src="/logo/logo_pas_basic.png" alt="Logo PT. PAS" style="width: 107px; height: 54px; display: block; margin: 0 auto;">
                                    </div>
                                    <p style="font-weight: bold; margin: 0; font-size: 15px;">PT. PANANJUNG ANUGRAH SOLUTION</p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p style="margin: 0; font-size: 14px;">LEMBAR KERJA KALIBRASI</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p style="margin: 0; font-weight: bold; font-size: 14px;">FEELER GAUGE</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="height: 10px;"></td>
                        </tr>
                        <tr>
                            <td style="width: 25%;">
                                <p style="margin: 0; font-size: 14px;">No. Sertifikat</p>
                            </td>
                            <td style="width: 45%;">
                                <p style="margin: 0; font-size: 14px; font-weight: bold;">PAS - </p>
                            </td>
                        </tr>
                    </table>

                    <table class="kalibrasi-main-table">
                        <tr>
                            <td style="width: 20%;">
                                <p style="margin: 0;">Nama Alat</p>
                            </td>
                            <td colspan="3">
                                @if($isFirstForm)
                                    <select name="nama_alat" id="nama_alat_select_{{ $formIndex }}" class="kalibrasi-input" onchange="updateFormType(this.value, {{ $formIndex }})" required style="background-color: #f5f5f5;">
                                        <option value="">-- Pilih Alat --</option>
                                        <option value="Feeler Gauge">Feeler Gauge</option>
                                        <option value="MANUAL_INPUT">-- Input Manual Nama Alat --</option>
                                    </select>
                                    
                                    <div id="manualInputContainer_{{ $formIndex }}" style="display: none; margin-top: 10px;">
                                        <input type="text" name="nama_alat_manual" id="nama_alat_manual_{{ $formIndex }}"
                                               placeholder="Ketik nama alat secara manual"
                                               style="background-color: #f5f5f5; border: 1px solid #ced4da; padding: 6px 10px; border-radius: 4px; width: 100%;"
                                               oninput="syncNamaAlat({{ $formIndex }})">
                                    </div>
                                    
                                    <input type="hidden" name="nama_alat_final" id="nama_alat_final_{{ $formIndex }}" value="">
                                    <input type="hidden" name="nama_alat_display" id="nama_alat_display_{{ $formIndex }}" value="">
                                @else
                                    <input type="text" name="nama_alat_display" id="nama_alat_copy_{{ $formIndex }}" class="kalibrasi-input disabled-field" readonly disabled placeholder="Mengikuti Form 1" style="background-color: #e9ecef;">
                                    <div class="info-copy">
                                        <i class="fas fa-copy"></i> Nama alat akan mengikuti isian Form 1
                                    </div>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td><p style="margin: 0;">Merek</p></td>
                            <td colspan="3">
                                <div class="d-flex align-items-center">
                                    @if($isFirstForm)
                                        <input type="text" name="merek" id="merek_{{ $formIndex }}" class="kalibrasi-input me-3" placeholder="Masukkan merek alat" style="width: 60%;" required>
                                        <span class="me-1">Kode Alat :</span>
                                        <input type="text" name="kode_alat" id="kode_alat_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan kode" style="width: 30%;">
                                    @else
                                        <input type="text" name="merek_display" id="merek_{{ $formIndex }}" class="kalibrasi-input me-3 disabled-field" placeholder="Mengikuti Form 1" style="width: 60%; background-color: #e9ecef;" readonly disabled>
                                        <span class="me-1">Kode Alat :</span>
                                        <input type="text" name="kode_alat_display" id="kode_alat_{{ $formIndex }}" class="kalibrasi-input disabled-field" placeholder="Mengikuti Form 1" style="width: 30%; background-color: #e9ecef;" readonly disabled>
                                    @endif
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td><p style="margin: 0;">Type / No. Seri</p></td>
                            <td colspan="3">
                                <div class="d-flex align-items-center">
                                    @if($isFirstForm)
                                        <input type="text" name="type_alat" id="type_alat_{{ $formIndex }}" class="kalibrasi-input me-3" placeholder="Masukkan Type Alat" style="width: 45%;" required>
                                        <span class="me-3">/</span>
                                        <input type="text" name="no_seri" id="no_seri_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan No. Seri" style="width: 45%;" required>
                                    @else
                                        <input type="text" name="type_alat_display" id="type_alat_{{ $formIndex }}" class="kalibrasi-input me-3 disabled-field" placeholder="Mengikuti Form 1" style="width: 45%; background-color: #e9ecef;" readonly disabled>
                                        <span class="me-3">/</span>
                                        <input type="text" name="no_seri_display" id="no_seri_{{ $formIndex }}" class="kalibrasi-input disabled-field" placeholder="Mengikuti Form 1" style="width: 45%; background-color: #e9ecef;" readonly disabled>
                                    @endif
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td style="vertical-align: middle;">
                                <p style="margin: 0;">Kapasitas / Resolusi</p>
                            </td>
                            <td colspan="3" style="vertical-align: middle;">
                                <div class="d-flex align-items-center gap-3">
                                    @if($isFirstForm)
                                        <input type="text" name="kapasitas" id="kapasitas_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan kapasitas" style="width: 45%;" required>
                                        <span style="font-size: 1.2em;">/</span>
                                        <input type="text" name="resolusi" id="resolusi_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan Resolusi" style="width: 45%;" required>
                                    @else
                                        <input type="text" name="kapasitas_display" id="kapasitas_{{ $formIndex }}" class="kalibrasi-input disabled-field" placeholder="Mengikuti Form 1" style="width: 45%; background-color: #e9ecef;" readonly disabled>
                                        <span style="font-size: 1.2em;">/</span>
                                        <input type="text" name="resolusi_display" id="resolusi_{{ $formIndex }}" class="kalibrasi-input disabled-field" placeholder="Mengikuti Form 1" style="width: 45%; background-color: #e9ecef;" readonly disabled>
                                    @endif
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td><p style="margin: 0;">Nama Pemilik</p></td>
                            <td colspan="3">
                                @if($isFirstForm)
                                    <input type="text" name="nama_pemilik" id="nama_pemilik_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan nama pemilik/Instansi" required>
                                @else
                                    <input type="text" name="nama_pemilik_display" id="nama_pemilik_{{ $formIndex }}" class="kalibrasi-input disabled-field" placeholder="Mengikuti Form 1" style="background-color: #e9ecef;" readonly disabled>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td><p style="margin: 0;">Tanggal Alat Masuk</p></td>
                            <td colspan="3">
                                @if($isFirstForm)
                                    <input type="date" name="tanggal_alat_masuk" id="tanggal_alat_masuk_{{ $formIndex }}" class="kalibrasi-input" value="{{ date('Y-m-d') }}" required>
                                @else
                                    <input type="date" name="tanggal_alat_masuk_display" id="tanggal_alat_masuk_{{ $formIndex }}" class="kalibrasi-input disabled-field" style="background-color: #e9ecef;" readonly disabled>
                                @endif
                            </td>
                        </tr>
                        
                        <tr>
                            <td><p style="margin: 0;">Tanggal Kalibrasi</p></td>
                            <td colspan="3">
                                <div class="d-flex align-items-center">
                                    @if($isFirstForm)
                                        <input type="date" name="tanggal_kalibrasi" id="tanggal_kalibrasi_{{ $formIndex }}" class="kalibrasi-input me-3" style="width: 45%;" required value="{{ date('Y-m-d') }}">
                                        <span class="me-3">Jenis Pembacaan:</span>
                                        <select name="jenis_pembacaan" id="jenis_pembacaan_{{ $formIndex }}" class="kalibrasi-input" style="width: 45%;">
                                            <option value="">-- Pilih --</option>
                                            <option value="manual">Manual</option>
                                            <option value="digital" selected>Digital</option>
                                        </select>
                                    @else
                                        <input type="date" name="tanggal_kalibrasi_display" id="tanggal_kalibrasi_{{ $formIndex }}" class="kalibrasi-input me-3 disabled-field" style="width: 45%; background-color: #e9ecef;" readonly disabled>
                                        <span class="me-3">Jenis Pembacaan:</span>
                                        <select name="jenis_pembacaan_display" id="jenis_pembacaan_{{ $formIndex }}" class="kalibrasi-input disabled-field" style="width: 45%; background-color: #e9ecef;" disabled>
                                            <option value="digital" selected>Digital</option>
                                        </select>
                                    @endif
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td><p style="margin: 0;">Tempat Kalibrasi</p></td>
                            <td colspan="3">
                                @if($isFirstForm)
                                    <div class="d-flex">
                                        <div class="form-check me-5">
                                            <input class="form-check-input" type="radio" name="tempat_kalibrasi" value="lab.PT PAS" id="lab_{{ $formIndex }}" required>
                                            <label class="form-check-label" for="lab_{{ $formIndex }}">Lab. PT.PAS</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tempat_kalibrasi" value="insitu" id="insitu_{{ $formIndex }}" required>
                                            <label class="form-check-label" for="insitu_{{ $formIndex }}">Insitu</label>
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
                            <td><p style="margin: 0;">Lokasi PT</p></td>
                            <td colspan="3">
                                @if($isFirstForm)
                                    <input type="text" name="lokasi_pt" id="lokasi_pt_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan lokasi pt">
                                @else
                                    <input type="text" name="lokasi_pt_display" id="lokasi_pt_{{ $formIndex }}" class="kalibrasi-input disabled-field" placeholder="Mengikuti Form 1" style="background-color: #e9ecef;" readonly disabled>
                                @endif
                            </td>
                        </tr>
                    </table>

                    <div class="row mt-4">
                        <div class="col-md-6 mb-4">
                            <div class="kalibrasi-section-header">Fungsi Komponen Lainnya</div>
                            
                            <div class="d-flex justify-content-around align-items-center my-4">
                                <div class="text-center">
                                    <span class="fw-bold d-block">Ok</span>
                                    @if($isFirstForm)
                                        <input type="radio" name="fungsi_komponen" value="ok" style="transform: scale(1.5); margin: 10px 0;" required>
                                    @else
                                        <input type="radio" name="fungsi_komponen_display" value="ok" style="transform: scale(1.5); margin: 10px 0;" disabled>
                                    @endif
                                </div>
                                <div class="text-center">
                                    <span class="fw-bold d-block">Rusak</span>
                                    @if($isFirstForm)
                                        <input type="radio" name="fungsi_komponen" value="rusak" style="transform: scale(1.5); margin: 10px 0;" required>
                                    @else
                                        <input type="radio" name="fungsi_komponen_display" value="rusak" style="transform: scale(1.5); margin: 10px 0;" disabled>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center mt-4">
                                <span class="fw-bold me-3">Keterangan :</span>
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
                            <div class="kalibrasi-section-header">Kondisi Kalibrasi</div>
                            
                            <table class="table table-bordered">
                                <tr>
                                    <td class="table-secondary fw-bold" style="width: 30%;"></td>
                                    <td class="table-secondary fw-bold text-center">Awal</td>
                                    <td class="table-secondary fw-bold text-center">Tengah</td>
                                    <td class="table-secondary fw-bold text-center">Akhir</td>
                                </tr>
                                <tr>
                                    <td class="bg-light fw-bold">Suhu (&deg;C)</td>
                                    <td><input type="text" name="suhu_awal" id="suhu_awal_{{ $formIndex }}" class="kondisi-input"  placeholder="0.0" {{ $isFirstForm ? 'required' : 'disabled' }}></td>
                                    <td><input type="text" name="suhu_tengah" id="suhu_tengah_{{ $formIndex }}" class="kondisi-input"  placeholder="0.0" {{ $isFirstForm ? 'required' : 'disabled' }}></td>
                                    <td><input type="text" name="suhu_akhir" id="suhu_akhir_{{ $formIndex }}" class="kondisi-input"  placeholder="0.0" {{ $isFirstForm ? 'required' : 'disabled' }}></td>
                                </tr>
                                <tr>
                                    <td class="bg-light fw-bold">RH (%)</td>
                                    <td><input type="text" name="rh_awal" id="rh_awal_{{ $formIndex }}" class="kondisi-input"  placeholder="0.0" {{ $isFirstForm ? 'required' : 'disabled' }}></td>
                                    <td><input type="text" name="rh_tengah" id="rh_tengah_{{ $formIndex }}" class="kondisi-input"  placeholder="0.0" {{ $isFirstForm ? 'required' : 'disabled' }}></td>
                                    <td><input type="text" name="rh_akhir" id="rh_akhir_{{ $formIndex }}" class="kondisi-input"  placeholder="0.0" {{ $isFirstForm ? 'required' : 'disabled' }}></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="data-kalibrasi-header">DATA KALIBRASI</div>

                    <table class="data-kalibrasi-table" cellspacing="0" cellpadding="0" style="border:0.75pt solid #000000; border-collapse:collapse; width:100%; max-width:1200px;">
                        <tr style="height:13.15pt">
                            <td rowspan="3" style="width:15.8pt; border-right:0.75pt solid #000; border-bottom:0.75pt solid #000; vertical-align:top; text-align:center;">
                                <p style="margin-top:15pt; font-size:8pt; font-weight:bold;">No</p>
                            </td>
                            <td colspan="2" style="width:96.35pt; border-right:0.75pt solid #000; border-bottom:0.75pt solid #000; vertical-align:top; text-align:center;">
                                <p style="margin-top:5pt; font-size:8pt; font-weight:bold;">Nilai Nominal</p>
                            </td>
                            <td colspan="8" style="width:432.15pt; border-bottom:0.75pt solid #000; vertical-align:top; text-align:center;">
                                <p style="margin-top:5pt; font-size:8pt; font-weight:bold;">PEMBACAAN STANDAR ULM</p>
                            </td>
                        </tr>
                        <tr style="height:13.15pt">
                            <td style="width:44.4pt; border:0.75pt solid #000; vertical-align:top; text-align:center;">
                                <p style="margin-top:5pt; font-size:8pt; font-weight:bold;">UUT</p>
                            </td>
                            <td style="width:51.2pt; border:0.75pt solid #000; vertical-align:top; text-align:center;">
                                <p style="margin-top:5pt; font-size:8pt; font-weight:bold;">Gauge Block</p>
                            </td>
                            <td colspan="4" style="width:215.7pt; border:0.75pt solid #000; vertical-align:top; text-align:center;">
                                <p style="margin-top:5pt; font-size:8pt; font-weight:bold;">PENGUKURAN A dan B</p>
                            </td>
                            <td colspan="4" style="width:215.7pt; border:0.75pt solid #000; vertical-align:top; text-align:center;">
                                <p style="margin-top:5pt; font-size:8pt; font-weight:bold;">PENGUKURAN A dan C</p>
                            </td>
                        </tr>
                        <tr style="height:13.15pt">
                            <td style="width:44.4pt; border:0.75pt solid #000; vertical-align:top; text-align:center;">
                                <p style="margin-top:3pt; font-size:7pt; font-weight:bold;">
                                    Unit ( 
                                    <input type="text" name="satuan_unit_uut" id="satuan_unit_uut_{{ $formIndex }}" value=" " 
                                           style="width: 40px; border: none; text-align: center; background: transparent; font-size: 7pt;" {{ !$isFirstForm ?   : '' }}>
                                    )
                                </p>
                            </td>
                            <td style="width:51.2pt; border:0.75pt solid #000; vertical-align:top; text-align:center;">
                                <p style="margin-top:3pt; font-size:7pt; font-weight:bold;">
                                    Unit ( 
                                    <input type="text" name="satuan_unit_gauge_block" id="satuan_unit_gauge_block_{{ $formIndex }}" value=" " 
                                           style="width: 40px; border: none; text-align: center; background: transparent; font-size: 7pt;" {{ !$isFirstForm ?   : '' }}>
                                    )
                                </p>
                            </td>
                            <td style="width:53.4pt; border:0.75pt solid #000; vertical-align:top; text-align:center;">
                                <p style="margin-top:3pt; font-size:7pt; font-weight:bold;">Gauge Block(A)</p>
                            </td>
                            <td style="width:53.35pt; border:0.75pt solid #000; vertical-align:top; text-align:center;">
                                <p style="margin-top:3pt; font-size:7pt; font-weight:bold;">UUT(B)</p>
                            </td>
                            <td style="width:53.35pt; border:0.75pt solid #000; vertical-align:top; text-align:center;">
                                <p style="margin-top:3pt; font-size:7pt; font-weight:bold;">Gauge Block(A)</p>
                            </td>
                            <td style="width:53.35pt; border:0.75pt solid #000; vertical-align:top; text-align:center;">
                                <p style="margin-top:3pt; font-size:7pt; font-weight:bold;">UUT(B)</p>
                            </td>
                            <td style="width:53.35pt; border:0.75pt solid #000; vertical-align:top; text-align:center;">
                                <p style="margin-top:3pt; font-size:7pt; font-weight:bold;">Gauge Block(A)</p>
                            </td>
                            <td style="width:53.4pt; border:0.75pt solid #000; vertical-align:top; text-align:center;">
                                <p style="margin-top:3pt; font-size:7pt; font-weight:bold;">UUT(C)</p>
                            </td>
                            <td style="width:53.35pt; border:0.75pt solid #000; vertical-align:top; text-align:center;">
                                <p style="margin-top:3pt; font-size:7pt; font-weight:bold;">Gauge Block(A)</p>
                            </td>
                            <td style="width:53.35pt; border:0.75pt solid #000; vertical-align:top; text-align:center;">
                                <p style="margin-top:3pt; font-size:7pt; font-weight:bold;">UUT(C)</p>
                            </td>
                        </tr>

                        @for($i = 1; $i <= 25; $i++)
                        <tr style="height:14.25pt">
                            <td style="width:15.8pt; border:0.75pt solid #000; text-align:center; vertical-align:middle; font-size:8pt;">{{ $i }}</td>
                            <td style="width:44.4pt; border:0.75pt solid #000;">
                                <input type="text" name="nominal_uut_{{ $i }}" id="nominal_uut_{{ $formIndex }}_{{ $i }}" placeholder="" style="width:100%; text-align:center; border:none;">
                            </td>
                            <td style="width:51.2pt; border:0.75pt solid #000;">
                                <input type="text" name="nominal_gb_{{ $i }}" id="nominal_gb_{{ $formIndex }}_{{ $i }}" placeholder="" style="width:100%; text-align:center; border:none;">
                            </td>
                            <td style="width:53.4pt; border:0.75pt solid #000;">
                                <input type="text" name="ab_gb_a_{{ $i }}" id="ab_gb_a_{{ $formIndex }}_{{ $i }}" placeholder="" style="width:100%; text-align:center; border:none;">
                            </td>
                            <td style="width:53.35pt; border:0.75pt solid #000;">
                                <input type="text" name="ab_uut_b_{{ $i }}" id="ab_uut_b_{{ $formIndex }}_{{ $i }}" placeholder="" style="width:100%; text-align:center; border:none;">
                            </td>
                            <td style="width:53.35pt; border:0.75pt solid #000;">
                                <input type="text" name="ab_gb_a2_{{ $i }}" id="ab_gb_a2_{{ $formIndex }}_{{ $i }}" placeholder="" style="width:100%; text-align:center; border:none;">
                            </td>
                            <td style="width:53.35pt; border:0.75pt solid #000;">
                                <input type="text" name="ab_uut_b2_{{ $i }}" id="ab_uut_b2_{{ $formIndex }}_{{ $i }}" placeholder="" style="width:100%; text-align:center; border:none;">
                            </td>
                            <td style="width:53.35pt; border:0.75pt solid #000;">
                                <input type="text" name="ac_gb_a_{{ $i }}" id="ac_gb_a_{{ $formIndex }}_{{ $i }}" placeholder="" style="width:100%; text-align:center; border:none;">
                            </td>
                            <td style="width:53.4pt; border:0.75pt solid #000;">
                                <input type="text" name="ac_uut_c_{{ $i }}" id="ac_uut_c_{{ $formIndex }}_{{ $i }}" placeholder="" style="width:100%; text-align:center; border:none;">
                            </td>
                            <td style="width:53.35pt; border:0.75pt solid #000;">
                                <input type="text" name="ac_gb_a2_{{ $i }}" id="ac_gb_a2_{{ $formIndex }}_{{ $i }}" placeholder="" style="width:100%; text-align:center; border:none;">
                            </td>
                            <td style="width:53.35pt; border:0.75pt solid #000;">
                                <input type="text" name="ac_uut_c2_{{ $i }}" id="ac_uut_c2_{{ $formIndex }}_{{ $i }}" placeholder="" style="width:100%; text-align:center; border:none;">
                            </td>
                        </tr>
                        @endfor
                    </table>

                    <table border="1" cellspacing="0" cellpadding="5" style="border-collapse: collapse; width: 100%; margin-bottom: 20px; border: 1px solid black;">
                        <tr>
                            <td colspan="4" style="text-align: center; font-weight: bold; background-color: #e6e6e6; border: 1px solid black;">
                                Isilah lembar data kalibrasi dengan lengkap dan jelas!
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 20%; text-align: center; vertical-align: middle; border: 1px solid black;">
                                Alat Standar
                            </td>
                            <td style="width: 40%; vertical-align: top; border: 1px solid black;">
                                <input type="checkbox" name="alat_standar[]" value="Mesin ULM 01-600D" id="ulm_{{ $formIndex }}"> <label for="ulm_{{ $formIndex }}">Mesin ULM 01-600D</label><br>
                                <input type="checkbox" name="alat_standar[]" value="Micrometer" id="micrometer_{{ $formIndex }}"> <label for="micrometer_{{ $formIndex }}">Micrometer</label><br>
                                <input type="checkbox" name="alat_standar[]" value="Gauge Block" id="gaugeblock_{{ $formIndex }}"> <label for="gaugeblock_{{ $formIndex }}">Gauge Block</label>
                            </td>
                            <td style="width: 20%; text-align: center; vertical-align: top; border: 1px solid black;">
                                Dikalibrasi oleh
                            </td>
                            <td style="width: 20%; text-align: center; vertical-align: top; border: 1px solid black;">
                                Diperiksa oleh
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="2" style="text-align: center; vertical-align: middle; border: 1px solid black;">
                                Metode Kalibrasi
                            </td>
                            <td rowspan="2" style="text-align: center; vertical-align: middle; border: 1px solid black;">
                                PAS-IK1102-62
                            </td>
                            <td style="border: 1px solid black;">
                                TTD :
                            </td>
                            <td style="border: 1px solid black;">
                                TTD :
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;">
                                Nama :<br>
                                @if($isFirstForm)
                                    <input type="text" name="calibrated_by" style="width: 100%;" value="{{ auth()->user()->nama ?? 'System' }}" readonly>
                                @else
                                    <input type="text" name="calibrated_by_display" style="width: 100%; background-color: #e9ecef;" readonly disabled>
                                @endif
                            </td>
                            <td style="border: 1px solid black;">
                                Nama :<br>
                                @if($isFirstForm)
                                    <input type="text" name="verified_by" id="verified_by_{{ $formIndex }}" style="width: 100%;" readonly>
                                @else
                                    <input type="text" name="verified_by_display" id="verified_by_{{ $formIndex }}" style="width: 100%; background-color: #e9ecef;" readonly disabled>
                                @endif
                            </td>
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
        // 🔥 PRIORITAS 1: Cek dari URL parameter 'count'
        const urlParams = new URLSearchParams(window.location.search);
        const countParam = urlParams.get('count');
        
        if (countParam && !isNaN(parseInt(countParam))) {
            const count = parseInt(countParam);
            console.log('📊 getFormCount from URL param (count):', count);
            return Math.max(1, Math.min(4, count));
        }
        
        // 🔥 PRIORITAS 2: Cek dari sessionStorage (backup)
        const savedCount = sessionStorage.getItem('current_jumlah_form');
        if (savedCount && !isNaN(parseInt(savedCount))) {
            const count = parseInt(savedCount);
            console.log('📊 getFormCount from sessionStorage:', count);
            return Math.max(1, Math.min(4, count));
        }
        
        // 🔥 PRIORITAS 3: Cek dari hidden input di form pertama
        const firstForm = document.getElementById('kalibrasiForm1');
        if (firstForm) {
            const jumlahFormInput = firstForm.querySelector('input[name="jumlah_form"]');
            if (jumlahFormInput && jumlahFormInput.value) {
                const count = parseInt(jumlahFormInput.value);
                console.log('📊 getFormCount from hidden input:', count);
                return Math.max(1, Math.min(4, count));
            }
        }
        
        // Default: 1 form
        console.log('📊 getFormCount default: 1');
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
        console.log('🔄 syncAllFormsData - formCount:', formCount);
        
        if (formCount <= 1) return;
        
        const form1 = document.getElementById('kalibrasiForm1');
        if (!form1) return;
        
        const fieldsToSync = [
            'nama_alat', 'merek', 'kode_alat', 'type_alat', 'no_seri',
            'rentang_ukur_min', 'rentang_ukur_max', 'kapasitas', 'resolusi',
            'nama_pemilik', 'tanggal_alat_masuk', 'tanggal_kalibrasi',
            'tempat_kalibrasi', 'lokasi_pt', 'fungsi_komponen',
            'keterangan_fungsi_komponen', 'suhu_awal', 'suhu_tengah', 
            'suhu_akhir', 'rh_awal', 'rh_tengah', 'rh_akhir', 'verified_by'
        ];
        
        let form1Values = {};
        fieldsToSync.forEach(field => {
            form1Values[field] = getFormValue(form1, field);
        });
        
        const alatStandar = [];
        form1.querySelectorAll('input[name="alat_standar[]"]:checked').forEach(cb => {
            alatStandar.push(cb.value);
        });
        
        for (let i = 2; i <= formCount; i++) {
            const form = document.getElementById(`kalibrasiForm${i}`);
            if (!form) continue;
            
            fieldsToSync.forEach(field => {
                if (form1Values[field]) {
                    setFormValue(form, field, form1Values[field]);
                }
            });
            
            const existingCheckboxes = form.querySelectorAll('input[name="alat_standar[]"]');
            existingCheckboxes.forEach(cb => {
                cb.checked = alatStandar.includes(cb.value);
            });
        }
        
        console.log('✅ All forms synced from form 1');
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

    function updateKapasitas(formIndex, tabId = null) {
        const currentTabId = tabId || getActiveTabId();
        const rangeMaxInput = document.getElementById(`rentang_ukur_max_${formIndex}_tab${currentTabId}`);
        const kapasitasInput = document.getElementById(`kapasitas_${formIndex}_tab${currentTabId}`);
        
        if (rangeMaxInput && kapasitasInput) {
            let maxValue = parseFloat(rangeMaxInput.value);
            if (!isNaN(maxValue) && maxValue > 0) {
                kapasitasInput.value = maxValue;
            } else {
                kapasitasInput.value = '';
            }
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
        // 🔥 DAPATKAN TAB ID YANG AKTIF DARI DOM
        const activeTabId = getActiveTabId();
        console.log('📌 Submitting from active tab:', activeTabId);
        
        // 🔥 DAPATKAN JUMLAH FORM DARI URL PARAMETER count
        const formCount = getFormCount();
        console.log('📊 Submit - formCount from URL:', formCount);
        
        disableRequiredOnHiddenForms();
        
        const forms = [];
        for (let i = 1; i <= formCount; i++) {
            const form = document.getElementById(`kalibrasiForm${i}`);
            if (form) {
                forms.push(form);
                console.log(`✅ Form ${i} ditemukan`);
            } else {
                console.warn(`⚠️ Form ${i} tidak ditemukan (belum dibuat)`);
                // Jangan return, lanjutkan dengan form yang ada
            }
        }
        
        if (forms.length === 0) {
            alert('Tidak ada form yang ditemukan!');
            restoreRequiredOnAllForms();
            return;
        }
        
        // Update jumlah_form di semua form yang ada
        updateAllJumlahFormValues(formCount);
        syncAllFormsData();
        
        // Fix input number kosong untuk semua form
        for (let i = 0; i < forms.length; i++) {
            const form = forms[i];
            
            form.querySelectorAll('input[type="number"]').forEach(input => {
                if (!input.value || input.value === '' || input.value === null) {
                    if (input.name.includes('suhu') || input.name.includes('rh')) {
                        input.value = '0';
                    } else if (input.name === 'rentang_ukur_max' || input.name === 'kapasitas') {
                        input.value = '200';
                    } else if (input.name === 'resolusi') {
                        input.value = '0.01';
                    } else {
                        input.value = '0';
                    }
                }
            });
            
            const rangeMax = form.querySelector('input[name="rentang_ukur_max"]');
            const kapasitas = form.querySelector('input[name="kapasitas"]');
            if (rangeMax && kapasitas && (!kapasitas.value || kapasitas.value !== rangeMax.value)) {
                kapasitas.value = rangeMax.value;
            }
            
            const resolusi = form.querySelector('input[name="resolusi"]');
            if (resolusi && (!resolusi.value || resolusi.value === '')) {
                resolusi.value = '0.01';
            }
            
            const selectNamaAlat = form.querySelector('select[name="nama_alat"]');
            let namaAlat = '';
            if (selectNamaAlat && selectNamaAlat.value && selectNamaAlat.value !== 'MANUAL_INPUT') {
                namaAlat = selectNamaAlat.value;
            } else {
                const manualInput = form.querySelector('input[name="nama_alat_manual"]');
                if (manualInput && manualInput.value) {
                    namaAlat = manualInput.value;
                }
            }
            
            if (namaAlat) {
                const container = form.closest('.lk-form-container');
                if (container) {
                    container.setAttribute('data-form-name', namaAlat);
                }
            }
        }
        
        // Validasi hanya form yang visible (aktif)
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
            
            for (let i = 0; i < forms.length; i++) {
                const form = forms[i];
                const formData = new FormData(form);
                const formIndex = i + 1;
                
                for (let [key, value] of formData.entries()) {
                    if (key === '_token') continue;
                    
                    if (key === 'alat_standar[]') {
                        combinedFormData.append(`form_${formIndex}_alat_standar[]`, value);
                    } else if (key !== 'form_index' && key !== 'jumlah_form') {
                        combinedFormData.append(`form_${formIndex}_${key}`, value);
                    }
                }
                combinedFormData.append(`form_${formIndex}_form_index`, formIndex);
            }
            
            combinedFormData.append('jumlah_form', formCount.toString());
            combinedFormData.append('submit_all', 'true');
            combinedFormData.append('form_type', 'feeler_gauge');
            
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            combinedFormData.append('_token', csrfToken);
            
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
            
            console.log('📌 Saving success for tab:', activeTabId);
            
            // Panggil handleSaveSuccess dengan tabId yang benar
            if (typeof window.handleSaveSuccess === 'function') {
                window.handleSaveSuccess(activeTabId, result);
            } else if (typeof handleSaveSuccess === 'function') {
                handleSaveSuccess(activeTabId, result);
            } else {
                console.error('handleSaveSuccess function not found!');
                alert('Data berhasil disimpan!');
            }
            
            btn.disabled = false;
            btn.innerHTML = originalText;
            restoreRequiredOnAllForms();
            
        } catch (err) {
            console.error('Submit error:', err);
            alert('Error: ' + err.message);
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
        console.log('🚀 DOM Content Loaded - Initializing...');
        
        // Setup tab switching
        setupTabSwitching();
        
        // 🔥 DAPATKAN JUMLAH FORM DARI URL PARAMETER count
        const formCount = getFormCount();
        console.log('📊 Form count from URL:', formCount);
        
        // Update sessionStorage dengan nilai dari URL
        setFormCount(formCount);
        
        // Setup event listeners untuk form yang ada
        for (let i = 1; i <= formCount; i++) {
            const rangeMax = document.getElementById(`rentang_ukur_max_${i}`);
            if (rangeMax && !rangeMax.disabled) {
                rangeMax.addEventListener('input', () => updateKapasitas(i));
                rangeMax.addEventListener('change', () => updateKapasitas(i));
                if (rangeMax.value) updateKapasitas(i);
            }
        }
        
        if (formCount > 1) {
            console.log('🔄 Multiple forms detected, enabling sync...');
            setTimeout(syncAllFormsData, 500);
        }
        
        console.log('✅ Initialization complete!');
        console.log(`📌 Current active tab: ${getActiveTabId()}`);
        console.log(`📌 Total forms to submit: ${formCount}`);
    });
</script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
