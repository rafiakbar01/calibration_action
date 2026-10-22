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
        $repetition = $repetition ?? 1;
    @endphp
    
    @for($formIndex = 1; $formIndex <= $count; $formIndex++)
        @php
            $isFirstForm = ($formIndex == 1);
        @endphp
        
        @if($count > 1)
        <div style="background: linear-gradient(135deg,#1e40af,#3b82f6); color:#fff; padding:10px 20px; margin: 16px 0 0; border-radius:8px 8px 0 0; font-weight:bold; font-size:16px;">
            <i class="fas fa-file-alt" style="margin-right:8px;"></i>Form Climatic Chamber ke-{{ $formIndex }}
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
                <input type="hidden" name="form_type" value="chamber">
                <input type="hidden" name="repetition" value="{{ $repetition }}">
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
                    <input type="hidden" name="kapasitas_c" id="kapasitas_c_hidden_{{ $formIndex }}" value="">
                    <input type="hidden" name="resolusi_c" id="resolusi_c_hidden_{{ $formIndex }}" value="">
                    <input type="hidden" name="kapasitas_rh" id="kapasitas_rh_hidden_{{ $formIndex }}" value="">
                    <input type="hidden" name="resolusi_rh" id="resolusi_rh_hidden_{{ $formIndex }}" value="">
                    <input type="hidden" name="nama_pemilik" id="nama_pemilik_hidden_{{ $formIndex }}" value="">
                    <input type="hidden" name="tanggal_alat_masuk" id="tanggal_alat_masuk_hidden_{{ $formIndex }}" value="">
                    <input type="hidden" name="tanggal_kalibrasi" id="tanggal_kalibrasi_hidden_{{ $formIndex }}" value="">
                    <input type="hidden" name="jenis_pembacaan" id="jenis_pembacaan_hidden_{{ $formIndex }}" value="digital">
                    <input type="hidden" name="tempat_kalibrasi" id="tempat_kalibrasi_hidden_{{ $formIndex }}" value="">
                    <input type="hidden" name="lokasi_pt" id="lokasi_pt_hidden_{{ $formIndex }}" value="">
                    <input type="hidden" name="kode_th" id="kode_th_hidden_{{ $formIndex }}" value="">
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
                            <td colspan="2"><p style="margin:0; font-size:14px;">PAS-FLK29B</p></div>
                            <td rowspan="5" style="text-align:center; vertical-align:middle; padding:10px 0;">
                                <div style="display:inline-block; text-align:center;">
                                    <div style="margin-bottom:15px;">
                                        <img src="/logo/logo_pas_basic.png" alt="Logo PT. PAS" style="width:107px; height:54px; display:block; margin:0 auto;">
                                    </div>
                                    <p style="font-weight:bold; margin:0; font-size:15px;">PT. PANANJUNG ANUGRAH SOLUTION</p>
                                </div>
                            </div>
                        </tr>
                        <tr>
                            <td colspan="2"><p style="margin:0; font-size:14px;">LEMBAR KERJA KALIBRASI</p></div>
                        </tr>
                        <tr>
                            <td colspan="2"><p style="margin:0; font-weight:bold; font-size:14px;">CLIMATIC CHAMBER</p></div>
                        </tr>
                        <tr>
                            <td colspan="2" style="height:10px;"></div>
                        </tr>
                        <tr>
                            <td style="width:25%;"><p style="margin:0; font-size:14px;">No. Sertifikat</p></div>
                            <td style="width:45%;"><p style="margin:0; font-size:14px; font-weight:bold;">PAS - </p></div>
                        </tr>
                    </table>

                    <table class="kalibrasi-main-table">
                        <!-- Nama Alat -->
                        <tr>
                            <td style="width:20%;"><p style="margin:0;">Nama Alat</p></div>
                            <td colspan="3">
                                @if($isFirstForm)
                                    <input type="hidden" name="form_type" id="form_type" value="chamber">
                                    <select name="nama_alat" id="nama_alat_select_{{ $formIndex }}" class="kalibrasi-input" onchange="updateFormType(this.value, {{ $formIndex }})" required style="background-color:#f5f5f5; color:#333; border:1px solid #ced4da; padding:6px 10px; border-radius:4px; width:100%;">
                                        <option value="">-- Pilih Alat --</option>
                                        <option value="Climatic Chamber">Climatic Chamber</option>
                                        <option value="MANUAL_INPUT">-- Input Manual Nama Alat --</option>
                                    </select>
                                    
                                    <div id="manualInputContainer_{{ $formIndex }}" style="display:none; margin-top:10px;">
                                        <input type="text" name="nama_alat_manual" id="nama_alat_manual_{{ $formIndex }}"
                                               placeholder="Ketik nama alat Climatic Chamber secara manual"
                                               style="background-color:#f5f5f5; color:#333; border:1px solid #ced4da; padding:6px 10px; border-radius:4px; width:100%;"
                                               oninput="syncNamaAlat({{ $formIndex }})">
                                    </div>
                                    
                                    <input type="hidden" name="nama_alat_final" id="nama_alat_final_{{ $formIndex }}" value="">
                                    <input type="hidden" name="nama_alat_display" id="nama_alat_display_{{ $formIndex }}" value="">
                                @else
                                    <input type="text" class="kalibrasi-input disabled-field" readonly disabled placeholder="Mengikuti Form 1" style="background-color:#e9ecef;">
                                    <div class="info-copy"><i class="fas fa-copy"></i> Nama alat akan mengikuti isian Form 1</div>
                                @endif
                            </div>
                        </tr>

                        <!-- Merek & Kode Alat -->
                        <tr>
                            <td><p style="margin:0;">Merek</p></td>
                            <td colspan="3">
                                <div class="d-flex align-items-center">
                                    @if($isFirstForm)
                                        <input type="text" name="merek" id="merek_{{ $formIndex }}" class="kalibrasi-input me-3" placeholder="Masukkan merek alat" style="width:60%;" required>
                                    @else
                                        <input type="text" class="kalibrasi-input me-3 disabled-field" placeholder="Mengikuti Form 1" style="width:60%; background-color:#e9ecef;" readonly disabled>
                                    @endif
                                    <span class="me-3">Kode Alat :</span>
                                    @if($isFirstForm)
                                        <input type="text" name="kode_alat" id="kode_alat_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan kode" style="width:30%;">
                                    @else
                                        <input type="text" class="kalibrasi-input disabled-field" placeholder="Mengikuti Form 1" style="width:30%; background-color:#e9ecef;" readonly disabled>
                                    @endif
                                </div>
                            </div>
                        </tr>

                        <!-- Type / No. Seri -->
                        <tr>
                            <td><p style="margin:0;">Type / No. Seri</p></td>
                            <td colspan="3">
                                <div class="d-flex align-items-center">
                                    @if($isFirstForm)
                                        <input type="text" name="type_alat" id="type_alat_{{ $formIndex }}" class="kalibrasi-input me-3" placeholder="Masukkan Type" style="width:45%;" required>
                                        <span class="me-3">/</span>
                                        <input type="text" name="no_seri" id="no_seri_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan No. Seri" style="width:45%;" required>
                                    @else
                                        <input type="text" class="kalibrasi-input me-3 disabled-field" placeholder="Mengikuti Form 1" style="width:45%; background-color:#e9ecef;" readonly disabled>
                                        <span class="me-3">/</span>
                                        <input type="text" class="kalibrasi-input disabled-field" placeholder="Mengikuti Form 1" style="width:45%; background-color:#e9ecef;" readonly disabled>
                                    @endif
                                </div>
                            </div>
                        </tr>

                        <!-- Kapasitas / Resolusi -->
                      <tr>
                            <td><p style="margin:0;">Kapasitas / Resolusi °C</p></td>
                            <td colspan="3">
                                <div class="d-flex align-items-center">
                                    @if($isFirstForm)
                                        <input type="text" name="kapasitas_c" id="kapasitas_c_{{ $formIndex }}" class="kalibrasi-input me-3" placeholder="Masukkan kapasitas °C" style="width:45%;" required>
                                        <span class="me-3">/</span>
                                        <input type="text" name="resolusi_c" id="resolusi_c_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan Resolusi °C" style="width:45%;" required>
                                    @else
                                        <input type="text" class="kalibrasi-input me-3 disabled-field" placeholder="Mengikuti Form 1" style="width:45%; background-color:#e9ecef;" readonly disabled>
                                        <span class="me-3">/</span>
                                        <input type="text" class="kalibrasi-input disabled-field" placeholder="Mengikuti Form 1" style="width:45%; background-color:#e9ecef;" readonly disabled>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        
                        <tr>
                            <td><p style="margin:0;">Kapasitas / Resolusi % (Humidity)</p></td>
                            <td colspan="3">
                                <div class="d-flex align-items-center">
                                    @if($isFirstForm)
                                        <input type="text" name="kapasitas_rh" id="kapasitas_rh_{{ $formIndex }}" class="kalibrasi-input me-3" placeholder="Masukkan kapasitas %" style="width:45%;" required>
                                        <span class="me-3">/</span>
                                        <input type="text" name="resolusi_rh" id="resolusi_rh_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan Resolusi %" style="width:45%;" required>
                                    @else
                                        <input type="text" class="kalibrasi-input me-3 disabled-field" placeholder="Mengikuti Form 1" style="width:45%; background-color:#e9ecef;" readonly disabled>
                                        <span class="me-3">/</span>
                                        <input type="text" class="kalibrasi-input disabled-field" placeholder="Mengikuti Form 1" style="width:45%; background-color:#e9ecef;" readonly disabled>
                                    @endif
                                </div>
                            </td>
                        </tr>

                        <!-- Nama Pemilik -->
                        <tr>
                            <td><p style="margin:0;">Nama Pemilik</p></td>
                            <td colspan="3">
                                @if($isFirstForm)
                                    <input type="text" name="nama_pemilik" id="nama_pemilik_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan nama pemilik / instansi" required>
                                @else
                                    <input type="text" class="kalibrasi-input disabled-field" placeholder="Mengikuti Form 1" style="background-color:#e9ecef;" readonly disabled>
                                @endif
                            </div>
                        </tr>

                        <!-- Tanggal Alat Masuk -->
                        <tr>
                            <td><p style="margin:0;">Tanggal Alat Masuk</p></td>
                            <td colspan="3">
                                @if($isFirstForm)
                                    <input type="date" name="tanggal_alat_masuk" id="tanggal_alat_masuk_{{ $formIndex }}" class="kalibrasi-input" value="{{ date('Y-m-d') }}" required>
                                @else
                                    <input type="date" class="kalibrasi-input disabled-field" style="background-color:#e9ecef;" readonly disabled>
                                @endif
                            </div>
                        </tr>
                        
                        <!-- Tanggal Kalibrasi -->
                        <tr>
                            <td><p style="margin:0;">Tanggal Kalibrasi</p></td>
                            <td colspan="3">
                                <div class="d-flex align-items-center">
                                    @if($isFirstForm)
                                        <input type="date" name="tanggal_kalibrasi" id="tanggal_kalibrasi_{{ $formIndex }}" class="kalibrasi-input me-3" style="width:45%;" required value="{{ date('Y-m-d') }}">
                                        <span class="me-3">Jenis Pembacaan:</span>
                                        <select name="jenis_pembacaan" id="jenis_pembacaan_{{ $formIndex }}" class="kalibrasi-input" style="width:45%;">
                                            <option value="">-- Pilih --</option>
                                            <option value="manual">Manual</option>
                                            <option value="digital" selected>Digital</option>
                                        </select>
                                    @else
                                        <input type="date" class="kalibrasi-input me-3 disabled-field" style="width:45%; background-color:#e9ecef;" readonly disabled>
                                        <span class="me-3">Jenis Pembacaan:</span>
                                        <select class="kalibrasi-input disabled-field" style="width:45%; background-color:#e9ecef;" disabled>
                                            <option value="digital" selected>Digital</option>
                                        </select>
                                    @endif
                                </div>
                            </div>
                        </tr>

                        <!-- Tempat Kalibrasi -->
                        <tr>
                            <td><p style="margin:0;">Tempat Kalibrasi</p></td>
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
                                            <input class="form-check-input" type="radio" disabled>
                                            <label class="form-check-label">Lab. PT.PAS</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" disabled>
                                            <label class="form-check-label">Insitu</label>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </tr>
                        
                        <!-- Lokasi PT -->
                        <tr>
                            <td><p style="margin:0;">Lokasi PT</p></td>
                            <td colspan="3">
                                @if($isFirstForm)
                                    <input type="text" name="lokasi_pt" id="lokasi_pt_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan Lokasi PT">
                                @else
                                    <input type="text" class="kalibrasi-input disabled-field" placeholder="Mengikuti Form 1" style="background-color:#e9ecef;" readonly disabled>
                                @endif
                            </div>
                        </tr>
                        
                         <tr>
                            <td><p style="margin:0;">Kode TH</p></td>
                            <td colspan="3">
                                @if($isFirstForm)
                                    <input type="text" name="kode_th" id="kode_th_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan Kode Th">
                                @else
                                    <input type="text" class="kalibrasi-input disabled-field" placeholder="Mengikuti Form 1" style="background-color:#e9ecef;" readonly disabled>
                                @endif
                            </div>
                        </tr>
                    </table>

                    <div class="row mt-4">
                        <div class="col-md-6 mb-4">
                            <div class="kalibrasi-section-header">Fungsi Komponen Lainnya</div>
                            
                            <div class="d-flex justify-content-around align-items-center my-4">
                                <div class="text-center">
                                    <span class="fw-bold d-block">Ok</span>
                                    @if($isFirstForm)
                                        <input type="radio" name="fungsi_komponen" value="ok" style="transform:scale(1.5); margin:10px 0;" required>
                                    @else
                                        <input type="radio" name="fungsi_komponen_display" value="ok" disabled>
                                    @endif
                                </div>
                                <div class="text-center">
                                    <span class="fw-bold d-block">Rusak</span>
                                    @if($isFirstForm)
                                        <input type="radio" name="fungsi_komponen" value="rusak" style="transform:scale(1.5); margin:10px 0;" required>
                                    @else
                                        <input type="radio" name="fungsi_komponen_display" value="rusak" disabled>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center mt-4">
                                <span class="fw-bold me-3" style="min-width:100px;">Keterangan :</span>
                                <div style="flex:1; border-bottom:2px solid #000;">
                                    @if($isFirstForm)
                                        <input type="text" name="keterangan_fungsi_komponen" id="keterangan_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan Keterangan" style="border:none;">
                                    @else
                                        <input type="text" class="kalibrasi-input disabled-field" placeholder="Mengikuti Form 1" style="border:none; background-color:#e9ecef;" readonly disabled>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="kalibrasi-section-header">Kondisi Kalibrasi</div>
                            
                            <table class="table table-bordered">
                                <tr>
                                    <td class="table-secondary fw-bold" style="width:30%;"></td>
                                    <td class="table-secondary fw-bold text-center">Awal</div>
                                    <td class="table-secondary fw-bold text-center">Tengah</div>
                                    <td class="table-secondary fw-bold text-center">Akhir</div>
                                </tr>
                                <tr>
                                    <td class="bg-light fw-bold">Suhu (&deg;C)</div>
                                    <td><input type="text" name="suhu_awal" id="suhu_awal_{{ $formIndex }}" class="kondisi-input"  placeholder="0.0" {{ $isFirstForm ? 'required' : 'disabled' }}></div>
                                    <td><input type="text" name="suhu_tengah" id="suhu_tengah_{{ $formIndex }}" class="kondisi-input"  placeholder="0.0" {{ $isFirstForm ? 'required' : 'disabled' }}></div>
                                    <td><input type="text" name="suhu_akhir" id="suhu_akhir_{{ $formIndex }}" class="kondisi-input"  placeholder="0.0" {{ $isFirstForm ? 'required' : 'disabled' }}></div>
                                </tr>
                                <tr>
                                    <td class="bg-light fw-bold">RH (%)</div>
                                    <td><input type="text" name="rh_awal" id="rh_awal_{{ $formIndex }}" class="kondisi-input"  placeholder="0.0" {{ $isFirstForm ? 'required' : 'disabled' }}></div>
                                    <td><input type="text" name="rh_tengah" id="rh_tengah_{{ $formIndex }}" class="kondisi-input"  placeholder="0.0" {{ $isFirstForm ? 'required' : 'disabled' }}></div>
                                    <td><input type="text" name="rh_akhir" id="rh_akhir_{{ $formIndex }}" class="kondisi-input"  placeholder="0.0" {{ $isFirstForm ? 'required' : 'disabled' }}></div>
                                </tr>
                            </table>
                        </div>
                    </div>

               <!-- DATA KALIBRASI Section -->
<div class="data-kalibrasi-header">DATA KALIBRASI</div>

<ol type="1" style="margin:0pt; padding-left:0pt">
    <li class="ListParagraph" style="margin-top:0.5pt; margin-left:10.05pt; text-indent:0pt; font-size:11pt; font-weight:bold;">
        <span>Penempatan Sensor</span>
    </li>
</ol>
<p style="margin-left:0.05pt; font-size:10pt">
    <div style="display:inline-block; vertical-align:top; text-align:center; margin-right:20px;">
        <img src="/logo/foto_rektangular.png" width="350" height="190" alt="" style="border:2px solid #000000; padding:5px;" />
        <div style="margin-top:8px; font-family:Arial; font-size:9pt; font-weight:bold; text-align:center;">Rektangular</div>
    </div>
    <span style="width:359.85pt; font-family:Arial; display:inline-block;">&#xa0;</span>
    <div style="display:inline-block; vertical-align:top; text-align:center; margin-left:20px;">
        <img src="/logo/foto_silindrik.png" width="240" height="190" alt="" style="border:2px solid #000000; padding:5px;" />
        <div style="margin-top:8px; font-family:Arial; font-size:9pt; font-weight:bold; text-align:center;">Silindrik atau Sferik</div>
    </div>
</p>

@php 
    $count = isset($count) ? (int)$count : 1; 
    $count = max(1, $count); 
    
    // 🔥 AMBIL REPETITION DARI URL PARAMETER (sama seperti Enclosure)
    // Enclosure menggunakan $repetition = $repetition ?? 1;
    // Chamber juga harus seperti itu
    $repetition = isset($repetition) ? (int)$repetition : request()->query('repetition', 1);
    if ($repetition < 1) $repetition = 1;
    if ($repetition > 3) $repetition = 3;
    
    $interval_waktu = [1, 2, 3, 4, 5, 13, 20, 30];
    
    // Debug - tampilkan di HTML comment
    echo "<!-- REPETITION FROM URL: " . request()->query('repetition', 1) . " -->";
    echo "<!-- REPETITION FINAL: " . $repetition . " -->";
@endphp

<!-- 🔥 HIDDEN INPUT REPETITION - HARUS ADA DI SETIAP FORM -->
<input type="hidden" name="repetition" value="{{ $repetition }}">
@for($p = 1; $p <= $repetition; $p++)
<ol start="2" type="1" style="margin:0pt; padding-left:0pt">
    <li class="ListParagraph" style="margin-right:468.8pt; margin-bottom:2.65pt; text-indent:0pt; line-height:147%; font-size:11pt; font-weight:bold; list-style-position:inside">
        <span>Data Pengukuran Setting Suhu ke-{{ $p }}</span>
        <span style="width:31.99pt; display:inline-block">&#xa0;</span>
        <span style="font-family:'Arial MT'; font-weight:normal;">:</span>
        <input type="text"
               name="suhu_setting_{{ $formIndex }}_{{ $p }}"
               value=""
               style="font-size:10pt; border:none; border-bottom:0.75pt solid #000; width:100pt; margin-left:5pt; background:transparent; color:#000; padding:0; height:18pt; text-align:center;">
    </li>
</ol>

<table class="TableNormal" style="width:100%; margin-left:0.48pt; border:2px solid #000000; border-collapse:collapse; margin-bottom: {{ $p < $repetition ? '40px' : '20px' }}">
    <tr style="background:#d9d9d9; height:14pt">
        <td style="width:8%; border:2px solid #000; text-align:center"><span style="font-weight:bold; font-size:9pt">Interval Waktu</span></td>
        <td colspan="2" style="width:16%; border:2px solid #000; text-align:center"><span style="font-weight:bold; font-size:9pt">Pembacaan Alat</span></td>
        <td colspan="10" style="border:2px solid #000; text-align:center"><span style="font-weight:bold; font-size:9pt">Pembacaan Sensor</span></td>
    </tr>
    <tr style="background:#e8e8e8; height:13pt">
        <td style="border:2px solid #000; text-align:center"><span style="font-weight:bold; font-size:9pt;">(Menit)</span></td>
        <td style="width:8%; border:2px solid #000; text-align:center"><span style="font-family:Arial; font-size:6pt; font-weight:bold;">o</span><span style="font-family:Arial; font-weight:bold; vertical-align:-3pt; font-size:9pt;">C</span></td>
        <td style="width:8%; border:2px solid #000; text-align:center"><span style="font-weight:bold; font-size:9pt">%</span></td>
        @for($s = 1; $s <= 9; $s++)
        <td style="width:7.2%; border:2px solid #000; text-align:center"><span style="font-weight:bold; font-size:9pt">{{ $s }}</span></td>
        @endfor
        <td style="width:8%; border:2px solid #000; text-align:center"><span style="font-weight:bold; font-size:9pt">%</span></td>
    </tr>
    
    @foreach($interval_waktu as $interval)
    <tr style="height:22pt;">
        <td style="border:2px solid #000; padding:0;">
            <input type="text" name="interval_{{ $formIndex }}_{{ $p }}_{{ $interval }}" readonly value="{{ $interval }}" 
                   style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:10pt; padding:2px; font-weight:bold;">
        </td>
        <td style="border:2px solid #000; padding:0;">
            <input type="text" name="alat_{{ $formIndex }}_{{ $p }}_{{ $interval }}" value="" 
                   style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:10pt; padding:2px;">
        </td>
        <td style="border:2px solid #000; padding:0;">
            <input type="text" name="alat_percent_{{ $formIndex }}_{{ $p }}_{{ $interval }}" value="" 
                   style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:10pt; padding:2px;">
        </td>
        @for($s = 1; $s <= 9; $s++)
        <td style="border:2px solid #000; padding:0;">
            <input type="text" name="sensor_{{ $formIndex }}_{{ $p }}_{{ $interval }}_{{ $s }}" value="" 
                   style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:10pt; padding:2px;">
        </td>
        @endfor
        <td style="border:2px solid #000; padding:0;">
            <input type="text" name="sensor_percent_{{ $formIndex }}_{{ $p }}_{{ $interval }}" value="" 
                   style="width:100%; height:100%; border:none; background:transparent; text-align:center; font-size:10pt; padding:2px;">
        </td>
    </tr>
    @endforeach
</table>
@endfor

<!-- Console log untuk debugging -->
<script>
var tempFormDataStore = window.tempFormDataStore;
var isRestoring = window.isRestoring;
var tabSubmitStatus = window.tabSubmitStatus;
var currentActiveTabId = '1';

    console.log('ðŸ“Š CHAMBER FORM RENDERED');
    console.log('  - Repetition:', {{ $repetition ?? 1 }});
    console.log('  - Form Index:', {{ $formIndex ?? 1 }});
    console.log('  - Tables count:', {{ $repetition ?? 1 }});
    console.log('  - Interval waktu:', {{ json_encode($interval_waktu) }});
</script>
                    <div style="height:50px;"></div>

                    <!-- Footer Section -->
                    <table class="kalibrasi-main-table" style="width:100%; border-collapse:collapse;">
                        <tr style="height:13.5pt">
                            <td rowspan="2" style="width:15%; border:1pt solid #000; text-align:center; vertical-align:middle; font-weight:bold; font-size:10pt; background-color:#f0f0f0;">
                                Alat<br>Standar
                            </div>
                            <td style="width:15%; border:1pt solid #000; text-align:left; vertical-align:middle; font-size:9pt; padding:8px;">- Temperature</div>
                            <td style="width:10%; border:1pt solid #000; text-align:center; vertical-align:middle; font-size:9pt; padding:8px;">
                                <div style="display:flex; align-items:center; justify-content:center;">
                                    <input type="checkbox" name="alat_standar_{{ $formIndex }}[]" value="GL-220" id="gl220_{{ $formIndex }}" style="transform:scale(1.2); margin-right:8px;">
                                    <label for="gl220_{{ $formIndex }}" style="cursor:pointer; font-weight:normal;">GL-220</label>
                                </div>
                            </div>
                            <td style="width:10%; border:1pt solid #000; text-align:center; vertical-align:middle; font-size:9pt; padding:8px;">
                                <div style="display:flex; align-items:center; justify-content:center;">
                                    <input type="checkbox" name="alat_standar_{{ $formIndex }}[]" value="GL-240" id="gl240_{{ $formIndex }}" style="transform:scale(1.2); margin-right:8px;">
                                    <label for="gl240_{{ $formIndex }}" style="cursor:pointer; font-weight:normal;">GL-240</label>
                                </div>
                            </div>
                            <td style="width:10%; border:1pt solid #000; text-align:center; vertical-align:middle; font-size:9pt; padding:8px;">
                                <div style="display:flex; align-items:center; justify-content:center;">
                                    <input type="checkbox" name="alat_standar_{{ $formIndex }}[]" value="Huato" id="huato_{{ $formIndex }}" style="transform:scale(1.2); margin-right:8px;">
                                    <label for="huato_{{ $formIndex }}" style="cursor:pointer; font-weight:normal;">Huato</label>
                                </div>
                            </div>
                            <td rowspan="2" style="width:20%; border:1pt solid #000; text-align:center; vertical-align:middle; font-weight:bold; font-size:9pt; padding:8px; background-color:#f0f0f0;">
                                Dikalibrasi<br>oleh
                            </div>
                            <td rowspan="2" style="width:20%; border:1pt solid #000; text-align:center; vertical-align:middle; font-weight:bold; font-size:9pt; padding:8px; background-color:#f0f0f0;">
                                Diperiksa<br>oleh
                            </div>
                        </tr>

                        <tr style="height:13.5pt">
                            <td style="border:1pt solid #000; text-align:left; vertical-align:middle; font-size:9pt; padding:8px;">- Kelembaban</div>
                            <td style="border:1pt solid #000; text-align:center; vertical-align:middle; font-size:9pt; padding:8px;">
                                <div style="display:flex; align-items:center; justify-content:center;">
                                    <input type="checkbox" name="alat_standar_{{ $formIndex }}[]" value="Rotronic" id="rotronic_{{ $formIndex }}" style="transform:scale(1.2); margin-right:8px;">
                                    <label for="rotronic_{{ $formIndex }}" style="cursor:pointer; font-weight:normal;">Rotronic</label>
                                </div>
                            </div>
                            <td style="border:1pt solid #000; text-align:center; vertical-align:middle; font-size:9pt; padding:8px;">
                                <div style="display:flex; align-items:center; justify-content:center;">
                                    <input type="checkbox" name="alat_standar_{{ $formIndex }}[]" value="Lutron" id="lutron_{{ $formIndex }}" style="transform:scale(1.2); margin-right:8px;">
                                    <label for="lutron_{{ $formIndex }}" style="cursor:pointer; font-weight:normal;">Lutron</label>
                                </div>
                            </div>
                            <td style="border:1pt solid #000; text-align:center; vertical-align:middle; font-size:9pt; padding:8px;">&nbsp;</div>
                        </tr>

                        <tr style="height:15pt">
                            <td style="width:15%; border:1pt solid #000; text-align:center; vertical-align:middle; font-weight:bold; font-size:9pt; padding:8px; background-color:#f0f0f0;">
                                Metode<br>Kalibrasi
                            </div>
                            <td colspan="4" style="border:1pt solid #000; text-align:left; vertical-align:middle; font-size:9pt; padding:8px;">
                                PAS-IK1102-29B
                            </div>
                            <td style="width:20%; border:1pt solid #000; text-align:left; vertical-align:middle; font-size:9pt; padding:8px;">
                                <div><strong>TTD :</strong></div>
                                <div><strong>Nama :</strong>
                                    <input type="text" name="calibrated_by"
                                           style="width:calc(100% - 45px); border:none; border-bottom:1px solid #000; background:transparent; font-size:9pt; padding:2px 5px; margin-left:5px;"
                                           placeholder="Nama Lengkap" readonly value="{{ auth()->user()->nama ?? 'System' }}">
                                </div>
                            </div>
                            <td style="width:20%; border:1pt solid #000; text-align:left; vertical-align:middle; font-size:9pt; padding:8px;">
                                <div><strong>TTD :</strong></div>
                                <div><strong>Nama :</strong>
                                    <input type="text" name="verified_by" id="verified_by_{{ $formIndex }}" value="" 
                                           style="width:calc(100% - 45px); border:none; border-bottom:1px solid #000; background:transparent; font-size:9pt; padding:2px 5px; margin-left:5px;"
                                           placeholder="-" {{ $isFirstForm ? 'readonly' : '' }}>
                                </div>
                            </div>
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
// FUNGSI GET FORM COUNT - DARI DOM
// ==========================================
function getFormCount() {
    let count = 0;
    for (let i = 1; i <= 50; i++) {
        const form = document.getElementById(`kalibrasiForm${i}`);
        if (form) {
            count++;
        } else {
            break;
        }
    }
    console.log('📊 getFormCount from DOM:', count);
    return Math.max(1, count);
}

function setFormCount(count) {
    sessionStorage.setItem('current_jumlah_form', count.toString());
}

function updateAllJumlahFormValues(actualCount) {
    console.log(`🔄 Updating jumlah_form to: ${actualCount}`);
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

function syncAllFormsData() {
    const formCount = getFormCount();
    if (formCount <= 1) return;
    
    const form1 = document.getElementById('kalibrasiForm1');
    if (!form1) return;
    
    const fieldsToSync = [
        'nama_alat', 'merek', 'kode_alat', 'type_alat', 'no_seri',
        'kapasitas', 'resolusi','kapasitas_c', 'resolusi_c','kapasitas_rh', 'resolusi_rh', 'nama_pemilik', 'tanggal_alat_masuk', 
        'tanggal_kalibrasi', 'tempat_kalibrasi', 'lokasi_pt','kode_th', 'fungsi_komponen',
        'keterangan_fungsi_komponen', 'suhu_awal', 'suhu_tengah', 
        'suhu_akhir', 'rh_awal', 'rh_tengah', 'rh_akhir', 'verified_by'
    ];
    
    let form1Values = {};
    fieldsToSync.forEach(field => {
        const element = form1.querySelector(`[name="${field}"]`);
        if (element && element.value) {
            form1Values[field] = element.value;
        }
    });
    
    const alatStandar = [];
    const checkboxes = form1.querySelectorAll('input[type="checkbox"][name*="alat_standar"]:checked');
    checkboxes.forEach(cb => {
        alatStandar.push(cb.value);
    });
    
    for (let i = 2; i <= formCount; i++) {
        const form = document.getElementById(`kalibrasiForm${i}`);
        if (!form) continue;
        
        // Sync text fields
        fieldsToSync.forEach(field => {
            if (form1Values[field]) {
                const target = form.querySelector(`[name="${field}"]`);
                if (target) target.value = form1Values[field];
            }
        });
        
        // Sync checkboxes
        const targetCheckboxes = form.querySelectorAll('input[type="checkbox"][name*="alat_standar"]');
        targetCheckboxes.forEach(cb => {
            cb.checked = alatStandar.includes(cb.value);
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
        if (finalInput) finalInput.value = '';
    } else {
        if (manualContainer) manualContainer.style.display = 'none';
        if (manualInput) manualInput.value = '';
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

    const formName = container.getAttribute('data-form-name') || 'Climatic Chamber';
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
        if (firstContainer) firstContainer.style.display = 'block';
        updateActiveTab('1');
    }
};

// ==========================================
// SUBMIT FORM - MULTIPLE FORM VERSION
// ==========================================
async function submitSemuaForm() {
    const activeTabId = getActiveTabId();
    console.log('📌 Submitting from active tab:', activeTabId);
    
    // 🔥 AMBIL JUMLAH FORM DARI DOM
    const forms = [];
    for (let i = 1; i <= 10; i++) {
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
        restoreRequiredOnAllForms();
        return;
    }
    
    disableRequiredOnHiddenForms();
    updateAllJumlahFormValues(formCount);
    syncAllFormsData();
    
    // 🔥 AMBIL NILAI REPETITION DARI FORM PERTAMA
    let repetitionValue = 1;
    if (forms[0]) {
        const repetitionHidden = forms[0].querySelector('input[name="repetition"]');
        if (repetitionHidden && repetitionHidden.value) {
            repetitionValue = parseInt(repetitionHidden.value);
        }
    }
    console.log('📊 Repetition from hidden input:', repetitionValue);
    
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
                
                if (key.includes('alat_standar')) {
                    combinedFormData.append(`form_${formIndex}_${key}`, value);
                } else if (key !== 'form_index' && key !== 'jumlah_form') {
                    combinedFormData.append(`form_${formIndex}_${key}`, value);
                }
            }
            combinedFormData.append(`form_${formIndex}_form_index`, formIndex);
        }
        
        // 🔥 TAMBAHKAN REPETITION KE FORMDATA
        combinedFormData.append('repetition', repetitionValue.toString());
        combinedFormData.append('jumlah_form', formCount.toString());
        combinedFormData.append('submit_all', 'true');
        combinedFormData.append('form_type', 'chamber');
        
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        combinedFormData.append('_token', csrfToken);
        
        console.log('📤 Sending all forms data...', {
            jumlah_form: formCount,
            repetition: repetitionValue
        });
        
        const response = await fetch('/calibrations', {
            method: 'POST',
            body: combinedFormData,
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
            console.error('Non-JSON response:', text.substring(0, 500));
            throw new Error('Server mengembalikan response yang tidak valid');
        }
        
        if (!response.ok) {
            throw new Error(result.error || `Gagal menyimpan data: ${response.status}`);
        }
        
        console.log('📌 Saving success for tab:', activeTabId);
        
        if (typeof window.handleSaveSuccess === 'function') {
            window.handleSaveSuccess(activeTabId, result);
        } else {
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
    console.log('🚀 DOM Content Loaded - Initializing Climatic Chamber...');
    
    setupTabSwitching();
    
    const formCount = getFormCount();
    console.log('📊 Form count from DOM:', formCount);
    
    setFormCount(formCount);
    
    if (formCount > 1) {
        console.log('🔄 Multiple forms detected, enabling sync...');
        setTimeout(syncAllFormsData, 500);
    }
    
    const selectAlat = document.getElementById('nama_alat_select');
    if (selectAlat) {
        updateFormType(selectAlat.value, 1);
        selectAlat.addEventListener('change', function() {
            updateFormType(this.value, 1);
        });
    }
    
    const manualInput = document.getElementById('nama_alat_manual');
    if (manualInput) {
        manualInput.addEventListener('input', () => syncNamaAlat(1));
    }
    
    setTimeout(() => {
        disableRequiredOnHiddenForms();
    }, 500);
    
    console.log('✅ Climatic Chamber initialization complete!');
    console.log(`📌 Current active tab: ${getActiveTabId()}`);
    console.log(`📌 Total forms: ${formCount}`);
});
</script>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
