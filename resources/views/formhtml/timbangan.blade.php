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
    
    <title>Form Kalibrasi Timbangan - PT. PANANJUNG ANUGRAH SOLUTION</title>
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

        /* ── Standar Picker Widget ── */
        .sp-wrapper {
            position: relative;
            width: 100%;
            min-height: 34px;
            background: transparent;
            box-sizing: border-box;
            cursor: pointer;
        }
        .sp-display {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 3px;
            padding: 4px 6px;
            min-height: 34px;
            width: 100%;
            box-sizing: border-box;
        }
        .sp-placeholder {
            color: #aaa;
            font-size: 11px;
            font-style: italic;
            user-select: none;
        }
        .sp-chip {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: #e0f2fe; /* Background biru muda cerah */
            color: #0369a1; /* Teks biru cerah */
            border: 1px solid #bae6fd; /* Border tipis biru muda */
            border-radius: 6px;
            padding: 2px 6px;
            font-size: 11px;
            font-weight: 600;
            white-space: nowrap;
            user-select: none;
        }
        .sp-chip .sp-remove {
            cursor: pointer;
            font-size: 12px;
            line-height: 1;
            color: #ef4444; /* Warna merah cerah untuk tombol hapus agar terlihat jelas */
            font-weight: bold;
            margin-left: 2px;
        }
        .sp-chip .sp-remove:hover { color: #b91c1c; }
        .sp-dropdown {
            display: none;
            position: fixed;
            z-index: 99999;
            background: #fff;
            border: 2px solid #1e40af;
            border-radius: 10px;
            box-shadow: 0 8px 32px rgba(30,64,175,0.18);
            min-width: 220px;
            max-height: 340px;
            overflow-y: auto;
            padding: 6px 0;
            font-family: 'Inter', sans-serif;
        }
        .sp-dropdown.open { display: block; }
        .sp-search {
            width: calc(100% - 16px);
            margin: 6px 8px;
            padding: 5px 10px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 12px;
            box-sizing: border-box;
            outline: none;
        }
        .sp-search:focus { border-color: #1e40af; }
        .sp-group-label {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6b7280;
            padding: 6px 12px 2px;
        }
        .sp-option {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 5px 12px;
            font-size: 12px;
            cursor: pointer;
            transition: background 0.12s;
            color: #1f2937;
        }
        .sp-option:hover { background: #eff6ff; }
        .sp-option.selected { background: #dbeafe; font-weight: 600; color: #1e40af; }
        .sp-option .sp-check {
            width: 14px;
            height: 14px;
            border: 1.5px solid #d1d5db;
            border-radius: 3px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 9px;
            flex-shrink: 0;
            background: #fff;
        }
        .sp-option.selected .sp-check {
            background: #1e40af;
            border-color: #1e40af;
            color: #fff;
        }
        .sp-divider { border: none; border-top: 1px solid #f3f4f6; margin: 4px 0; }
        .sp-count-badge {
            display: inline-block;
            background: #1e40af;
            color: #fff;
            border-radius: 8px;
            font-size: 10px;
            font-weight: 700;
            padding: 0px 5px;
            margin-left: 4px;
            vertical-align: middle;
        }
    </style>
    <style>
    /* Tombol Copy Standar Picker */
    .copy-standar-btn {
        transition: all 0.2s ease;
        border-color: #3b82f6;
        color: #3b82f6;
        background-color: white;
        font-weight: bold;
    }
    
    .copy-standar-btn:hover {
        background-color: #3b82f6;
        color: white;
        transform: scale(1.1);
        box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
    }
    
    .copy-standar-btn:active {
        transform: scale(0.95);
    }
    
    /* Animasi flash hijau saat copy berhasil */
    @keyframes flashGreen {
        0%, 100% { background-color: transparent; }
        50% { background-color: #d4edda; }
    }
    
    .copy-success-flash {
        animation: flashGreen 0.6s ease;
    }
    
    /* Toast notification animation */
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
</style>
</head>
<body>
    @php 
        $count = isset($count) ? (int)$count : 1; 
        $count = max(1, min(4, $count)); 
        $timbanganType = $timbanganType ?? 'standar';
    @endphp
    
    @for($formIndex = 1; $formIndex <= $count; $formIndex++)
        @php
            $isFirstForm = ($formIndex == 1);
        @endphp
        
        @if($count > 1)
        <div style="background: linear-gradient(135deg,#1e40af,#3b82f6); color:#fff; padding:10px 20px; margin: 16px 0 0; border-radius:8px 8px 0 0; font-weight:bold; font-size:16px;">
            <i class="fas fa-file-alt" style="margin-right:8px;"></i>Form Timbangan ke-{{ $formIndex }}
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
                <input type="hidden" name="form_type" value="timbangan">
                <input type="hidden" name="timbanganType" value="{{ $timbanganType }}">
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
                                <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK15</p>
                            </td>
                            <td rowspan="5" style="text-align: center; vertical-align: middle; padding: 10px 0;">
                                <div style="display: inline-block; text-align: center;">
                                    <div style="margin-bottom: 15px;">
                                        <img src="/logo/logo_pas_basic.png" alt="Logo PT. PAS" style="width: 107px; height: 54px; display: block; margin: 0 auto;">
                                    </div>
                                    <p style="font-weight: bold; margin: 0; font-size: 15px; color: #000000;">PT. PANANJUNG ANUGRAH SOLUTION</p>
                                </div>
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p style="margin: 0; font-size: 14px; color: #000000;">LEMBAR KERJA KALIBRASI</p>
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">
                                    {{ $timbanganType == 'moisture' ? 'TIMBANGAN MOISTURE' : 'TIMBANGAN' }}
                                </p>
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="height: 10px;"></div>
                            </tr>
                        <tr>
                            <td style="width: 25%;">
                                <p style="margin: 0; font-size: 14px; color: #000000;">No. Sertifikat</p>
                            </div>
                            <td style="width: 45%;">
                                <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;">PAS - </p>
                            </div>
                        </tr>
                    </table>

                    <table class="kalibrasi-main-table">
                        <!-- Nama Alat -->
                        <tr>
                            <td style="width: 20%;">
                                <p style="margin: 0; color: #000000;">Nama Alat</p>
                            </div>
                            <td colspan="3">
                                @if($isFirstForm)
                                    <select name="nama_alat" id="nama_alat_select_{{ $formIndex }}" class="kalibrasi-input" onchange="updateFormType(this.value, {{ $formIndex }})" style="background-color: #f5f5f5; color: #333; border: 1px solid #ced4da; padding: 6px 10px; border-radius: 4px; width: 100%;">
                                        <option value="">-- Pilih Jenis Alat --</option>
                                        <option value="Timbangan">Timbangan</option>
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
                                    <input type="text" name="nama_alat" id="nama_alat_copy_{{ $formIndex }}" class="kalibrasi-input disabled-field" readonly disabled placeholder="Mengikuti Form 1" style="background-color: #e9ecef;">
                                    <input type="hidden" name="nama_alat" id="nama_alat_hidden_{{ $formIndex }}" value="">
                                    <div class="info-copy">
                                        <i class="fas fa-copy"></i> Nama alat akan mengikuti isian Form 1
                                    </div>
                                @endif
                            </div>
                        </tr>

                        <!-- Merek & Kode Alat -->
                        <tr>
                            <td><p style="margin: 0; color: #000000;">Merek</p></td>
                            <td colspan="3">
                                <div class="d-flex align-items-center">
                                    @if($isFirstForm)
                                        <input type="text" name="merek" id="merek_{{ $formIndex }}" class="kalibrasi-input me-3" placeholder="Masukkan merek alat" style="width: 60%;">
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
                            </div>
                        </tr>

                        <!-- Type / No. Seri -->
                        <tr>
                            <td><p style="margin: 0; color: #000000;">Type / No. Seri</p></td>
                            <td colspan="3">
                                <div class="d-flex align-items-center">
                                    @if($isFirstForm)
                                        <input type="text" name="type_alat" id="type_alat_{{ $formIndex }}" class="kalibrasi-input me-3" placeholder="Masukkan Type" style="width: 45%;">
                                        <span class="me-3" style="color: #000000;">/</span>
                                        <input type="text" name="no_seri" id="no_seri_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan No. Seri" style="width: 45%;">
                                    @else
                                        <input type="text" name="type_alat_display" id="type_alat_{{ $formIndex }}" class="kalibrasi-input me-3 disabled-field" placeholder="Mengikuti Form 1" style="width: 45%; background-color: #e9ecef;" readonly disabled>
                                        <span class="me-3" style="color: #000000;">/</span>
                                        <input type="text" name="no_seri_display" id="no_seri_{{ $formIndex }}" class="kalibrasi-input disabled-field" placeholder="Mengikuti Form 1" style="width: 45%; background-color: #e9ecef;" readonly disabled>
                                    @endif
                                </div>
                            </div>
                        </tr>

                        <!-- Kapasitas / Resolusi -->
                        <tr>
                            <td><p style="margin: 0; color: #000000;">Kapasitas / Resolusi</p></td>
                            <td colspan="3">
                                <div class="d-flex align-items-center">
                                    @if($isFirstForm)
                                        <input type="text" name="kapasitas" id="kapasitas_{{ $formIndex }}" class="kalibrasi-input me-3" placeholder="Masukkan kapasitas" style="width: 45%;">
                                        <span class="me-3" style="color: #000000;">/</span>
                                        <input type="text" name="resolusi" id="resolusi_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan Resolusi" style="width: 45%;">
                                    @else
                                        <input type="text" name="kapasitas_display" id="kapasitas_{{ $formIndex }}" class="kalibrasi-input me-3 disabled-field" placeholder="Mengikuti Form 1" style="width: 45%; background-color: #e9ecef;" readonly disabled>
                                        <span class="me-3" style="color: #000000;">/</span>
                                        <input type="text" name="resolusi_display" id="resolusi_{{ $formIndex }}" class="kalibrasi-input disabled-field" placeholder="Mengikuti Form 1" style="width: 45%; background-color: #e9ecef;" readonly disabled>
                                    @endif
                                </div>
                            </div>
                        </tr>

                        <!-- Nama Pemilik -->
                        <tr>
                            <td><p style="margin: 0; color: #000000;">Nama Pemilik</p></td>
                            <td colspan="3">
                                @if($isFirstForm)
                                    <input type="text" name="nama_pemilik" id="nama_pemilik_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan nama pemilik / instansi">
                                @else
                                    <input type="text" name="nama_pemilik_display" id="nama_pemilik_{{ $formIndex }}" class="kalibrasi-input disabled-field" placeholder="Mengikuti Form 1" style="background-color: #e9ecef;" readonly disabled>
                                @endif
                            </div>
                        </tr>

                        <!-- Tanggal Alat Masuk -->
                        <tr>
                            <td><p style="margin: 0; color: #000000;">Tanggal Alat Masuk</p></td>
                            <td colspan="3">
                                @if($isFirstForm)
                                    <input type="date" name="tanggal_alat_masuk" id="tanggal_alat_masuk_{{ $formIndex }}" class="kalibrasi-input" value="{{ date('Y-m-d') }}">
                                @else
                                    <input type="date" name="tanggal_alat_masuk_display" id="tanggal_alat_masuk_{{ $formIndex }}" class="kalibrasi-input disabled-field" style="background-color: #e9ecef;" readonly disabled>
                                @endif
                            </div>
                        </tr>
                        
                        <!-- Tanggal Kalibrasi -->
                        <tr>
                            <td><p style="margin: 0; color: #000000;">Tanggal Kalibrasi</p></td>
                            <td colspan="3">
                                <div class="d-flex align-items-center">
                                    @if($isFirstForm)
                                        <input type="date" name="tanggal_kalibrasi" id="tanggal_kalibrasi_{{ $formIndex }}" class="kalibrasi-input me-3" style="width: 45%;" value="{{ date('Y-m-d') }}">
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
                            </div>
                        </tr>

                        <!-- Tempat Kalibrasi -->
                        <tr>
                            <td><p style="margin: 0; color: #000000;">Tempat Kalibrasi</p></td>
                            <td colspan="3">
                                @if($isFirstForm)
                                    <div class="d-flex">
                                        <div class="form-check me-5">
                                            <input class="form-check-input" type="radio" name="tempat_kalibrasi" value="lab.PT PAS" id="lab_{{ $formIndex }}">
                                            <label class="form-check-label" for="lab_{{ $formIndex }}" style="color: #000000;">Lab. PT.PAS</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tempat_kalibrasi" value="insitu" id="insitu_{{ $formIndex }}">
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
                            </div>
                        </tr>
                        
                        <!-- Lokasi PT -->
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
                                        <input type="radio" name="fungsi_komponen" value="ok" style="transform: scale(1.5); margin: 10px 0;">
                                    @else
                                        <input type="radio" name="fungsi_komponen_display" value="ok" style="transform: scale(1.5); margin: 10px 0;" disabled>
                                    @endif
                                </div>
                                <div class="text-center">
                                    <span class="fw-bold d-block" style="color: #000000;">Rusak</span>
                                    @if($isFirstForm)
                                        <input type="radio" name="fungsi_komponen" value="rusak" style="transform: scale(1.5); margin: 10px 0;">
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
                                    <td class="table-secondary fw-bold text-center" style="color: #000000;">Awal</div>
                                    <td class="table-secondary fw-bold text-center" style="color: #000000;">Tengah</div>
                                    <td class="table-secondary fw-bold text-center" style="color: #000000;">Akhir</div>
                                </tr>
                                <tr>
                                    <td class="bg-light fw-bold" style="color: #000000;">Suhu (&deg;C)</div>
                                    <td><input type="text" name="suhu_awal" id="suhu_awal_{{ $formIndex }}" class="kondisi-input" placeholder="0.0" {{ $isFirstForm ? '' : 'disabled' }}></div>
                                    <td><input type="text" name="suhu_tengah" id="suhu_tengah_{{ $formIndex }}" class="kondisi-input" placeholder="0.0" {{ $isFirstForm ? '' : 'disabled' }}></div>
                                    <td><input type="text" name="suhu_akhir" id="suhu_akhir_{{ $formIndex }}" class="kondisi-input" placeholder="0.0" {{ $isFirstForm ? '' : 'disabled' }}></div>
                                </tr>
                                <tr>
                                    <td class="bg-light fw-bold" style="color: #000000;">RH (%)</div>
                                    <td><input type="text" name="rh_awal" id="rh_awal_{{ $formIndex }}" class="kondisi-input" placeholder="0.0" {{ $isFirstForm ? '' : 'disabled' }}></div>
                                    <td><input type="text" name="rh_tengah" id="rh_tengah_{{ $formIndex }}" class="kondisi-input" placeholder="0.0" {{ $isFirstForm ? '' : 'disabled' }}></div>
                                    <td><input type="text" name="rh_akhir" id="rh_akhir_{{ $formIndex }}" class="kondisi-input" placeholder="0.0" {{ $isFirstForm ? '' : 'disabled' }}></div>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- DATA KALIBRASI Section -->
                    <div class="data-kalibrasi-header" style="color: #000000;">DATA KALIBRASI</div>
                    
                    <div class="setting-suhu-container" style="margin-bottom: 30px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr valign="top">
                                <!-- Blok Kiri: Setengah Kapasitas Max -->
                                <td width="33%" valign="top" style="padding-right: 20px;">
                                    <b>Pemeriksaan Nilai Repeatability</b>
                                    <br><br>
                                    Setengah Kap. Max =
                                    <input type="text"
                                           name="setengah_kapasitas_{{ $formIndex }}"
                                           style="border:0; border-bottom:1px dotted #000; width:200px; background:transparent;">
                                    <br><br>

                                    <table style="border-collapse: collapse; width: 100%;">
                                        <tr style="background: #cccccc;">
                                            <td style="border:2px solid #000; padding:8px; text-align:center; width:50%;">
                                                <b>Penunjukan z1</b>
                                            </div>
                                            <td style="border:2px solid #000; padding:8px; text-align:center; width:50%;">
                                                <b>Penunjukan m1</b>
                                            </div>
                                        </tr>
                                        @for($i = 1; $i <= 10; $i++)
                                        <tr>
                                            <td style="border:2px solid #000; padding:0;">
                                                <input type="text" name="setengah_z1_{{ $formIndex }}_{{ $i }}" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                                            </div>
                                            <td style="border:2px solid #000; padding:0;">
                                                <input type="text" name="setengah_m1_{{ $formIndex }}_{{ $i }}" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                                            </div>
                                        </tr>
                                        @endfor
                                    </table>
                                </div>

                                <!-- Blok Tengah: Kapasitas Max -->
                                <td width="33%" valign="top" style="padding-right: 20px;">
                                    <b>Pemeriksaan Nilai Repeatability</b><br><br>
                                    Kapasitas Max =
                                    <input type="text"
                                           name="kapasitas_max_{{ $formIndex }}"
                                           style="border:0; border-bottom:1px dotted #000; width:200px; background:transparent;">
                                    <br><br>

                                    <table style="border-collapse: collapse; width: 100%;">
                                        <tr style="background: #cccccc;">
                                            <td style="border:2px solid #000; padding:8px; text-align:center; width:50%;">
                                                <b>Penunjukan z1</b>
                                            </div>
                                            <td style="border:2px solid #000; padding:8px; text-align:center; width:50%;">
                                                <b>Penunjukan m1</b>
                                            </div>
                                        </tr>
                                        @for($i = 1; $i <= 10; $i++)
                                        <tr>
                                            <td style="border:2px solid #000; padding:0;">
                                                <input type="text" name="kapasitas_z1_{{ $formIndex }}_{{ $i }}" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                                            </div>
                                            <td style="border:2px solid #000; padding:0;">
                                                <input type="text" name="kapasitas_m1_{{ $formIndex }}_{{ $i }}" style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
                                            </div>
                                        </tr>
                                        @endfor
                                    </table>
                                </div>

                                <!-- Blok Kanan: CATATAN PENTING -->
                                <td width="34%" valign="top">
                                    <table style="border-collapse: collapse; width: 100%;">
                                        <tr>
                                            <td style="border:2px solid #000; background: #ffffff; text-align:center; padding:15px;">
                                                <b style="font-size: 18px;">CATATAN PENTING</b>
                                            </div>
                                        </tr>
                                        <tr>
                                            <td style="border:2px solid #000; background: #ffffff; padding:0; height: 500px;">
                                                <textarea name="catatan_penting_{{ $formIndex }}" style="width:100%; height:100%; border:none; background:transparent; padding:15px; resize:none; box-sizing:border-box;"></textarea>
                                            </div>
                                        </tr>
                                    </table>
                                </div>
                            </tr>
                        </table>

                        <div style="margin-top: 40px; margin-bottom: 20px;"></div>

                      <p style="margin-top:4.6pt; margin-left:12.2pt; margin-bottom:0.65pt">Pemeriksaan Nilai Nominal</p>
<table style="border-collapse: collapse; width: 100%; margin-left:10.92pt; border:2px solid #000000;">
    <tr style="background: #bebebe;">
        <td style="border:2px solid #000; padding:8px; text-align:center; font-weight:bold; width:15%;">Skala Nominal</td>
        <td style="border:2px solid #000; padding:8px; text-align:center; font-weight:bold; width:12%;">z1</td>
        <td style="border:2px solid #000; padding:8px; text-align:center; font-weight:bold; width:12%;">m1</td>
        <td style="border:2px solid #000; padding:8px; text-align:center; font-weight:bold; width:12%;">m1</td>
        <td style="border:2px solid #000; padding:8px; text-align:center; font-weight:bold; width:12%;">z1</td>
        <td style="border:2px solid #000; padding:8px; text-align:center; font-weight:bold; width:37%;">
            Standar Anak Timbangan yang Digunakan
        </td>
    </tr>
    
    @for($i = 1; $i <= 10; $i++)
    <tr style="height:16pt;">
        <td style="border:2px solid #000; padding:0;">
            <input type="text" name="skala_nominal_{{ $formIndex }}_{{ $i }}" 
                   value="{{ old('skala_nominal_' . $formIndex . '_' . $i) }}"
                   style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
        </td>
        <td style="border:2px solid #000; padding:0;">
            <input type="text" name="z1_1_{{ $formIndex }}_{{ $i }}" 
                   value="{{ old('z1_1_' . $formIndex . '_' . $i) }}"
                   style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
        </td>
        <td style="border:2px solid #000; padding:0;">
            <input type="text" name="m1_1_{{ $formIndex }}_{{ $i }}" 
                   value="{{ old('m1_1_' . $formIndex . '_' . $i) }}"
                   style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
        </td>
        <td style="border:2px solid #000; padding:0;">
            <input type="text" name="m1_2_{{ $formIndex }}_{{ $i }}" 
                   value="{{ old('m1_2_' . $formIndex . '_' . $i) }}"
                   style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
        </td>
        <td style="border:2px solid #000; padding:0;">
            <input type="text" name="z1_2_{{ $formIndex }}_{{ $i }}" 
                   value="{{ old('z1_2_' . $formIndex . '_' . $i) }}"
                   style="width:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
        </td>
        <td style="border:2px solid #000; padding:0; position: relative;">
            @php
                $stdOld = old('standar_' . $formIndex . '_' . $i, '');
            @endphp
            
            <!-- Container flex untuk Standar Picker + Tombol Copy -->
            <div style="display: flex; align-items: center; gap: 4px; padding: 4px 8px;">
                <!-- Standar Picker Widget -->
                <div style="flex: 1; min-width: 0;">
                    <input type="hidden"
                           name="standar_{{ $formIndex }}_{{ $i }}"
                           id="sp_hidden_{{ $formIndex }}_{{ $i }}"
                           value="{{ $stdOld }}">
                    <div class="sp-wrapper"
                         data-id="{{ $formIndex }}_{{ $i }}"
                         data-value="{{ $stdOld }}"
                         style="min-height: 28px;">
                        <div class="sp-display" id="sp_display_{{ $formIndex }}_{{ $i }}" style="min-height: 28px; padding: 2px 4px;">
                            <span class="sp-placeholder" id="sp_ph_{{ $formIndex }}_{{ $i }}" style="font-size: 10px;">Pilih standar...</span>
                        </div>
                        <div class="sp-dropdown" id="sp_dd_{{ $formIndex }}_{{ $i }}">
                            <input type="text" class="sp-search" placeholder="Cari kode..." id="sp_search_{{ $formIndex }}_{{ $i }}">
                            <div class="sp-option-list" id="sp_list_{{ $formIndex }}_{{ $i }}"></div>
                        </div>
                    </div>
                </div>
                
                <!-- 🔥 Tombol Copy (hanya untuk row > 1) -->
                @if($i > 1)
                <button type="button" 
                        class="btn btn-sm btn-outline-secondary copy-standar-btn" 
                        onclick="copyStandarPicker({{ $formIndex }}, {{ $i - 1 }}, {{ $i }})"
                        style="padding: 2px 6px; font-size: 10px; border-radius: 4px; flex-shrink: 0;"
                        title="Copy dari baris sebelumnya">
                    <i class="fas fa-copy"></i>
                </button>
                @endif
            </div>
        </td>
    </tr>
    @endfor
</table>
                        <div style="margin-top: 40px; margin-bottom: 20px;"></div>

                        <!-- Off-Center Loading Test -->
<p style="margin-left:12.2pt; font-size:12pt; font-weight:bold; font-style:italic;">Off-Center Loading Test</p>
<table border="0" cellpadding="0" cellspacing="0" style="margin-left:12.2pt; margin-bottom:1.75pt">
    <tr>
        <td>Beban Timbangan 1/3 atau 1/2 dari Kapasitas Maksimal =</td>
        <td>
            <input type="text" name="beban_timbangan_{{ $formIndex }}" style="width:120px; border:1px solid #000; text-align:center; padding:2px;">
        </td>
        <td>&nbsp;&nbsp;Diutamakan anak timbangan tunggal jika memadai.</td>
    </tr>
</table>

<!-- Tabel Off-Center Loading Test -->
<table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 100%; margin-left:10.92pt; border:2px solid #000000;">
    <tr style="background: #bebebe;">
        <td style="border:2px solid #000; padding:8px; text-align:center; font-weight:bold;">Posisi</td>
        <td style="border:2px solid #000; padding:8px; text-align:center; font-weight:bold;">Tengah</td>
        <td style="border:2px solid #000; padding:8px; text-align:center; font-weight:bold;">Depan</td>
        <td style="border:2px solid #000; padding:8px; text-align:center; font-weight:bold;">Belakang</td>
        <td style="border:2px solid #000; padding:8px; text-align:center; font-weight:bold;">Kanan</td>
        <td style="border:2px solid #000; padding:8px; text-align:center; font-weight:bold;">Kiri</td>
    </tr>
    <tr>
        <td style="border:2px solid #000; padding:8px; text-align:center; background-color:#bebebe; font-weight:bold;">Beban</td>
        <td style="border:2px solid #000; padding:0;">
            <input type="text" name="beban_tengah_{{ $formIndex }}" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
        </td>
        <td style="border:2px solid #000; padding:0;">
            <input type="text" name="beban_depan_{{ $formIndex }}" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
        </td>
        <td style="border:2px solid #000; padding:0;">
            <input type="text" name="beban_belakang_{{ $formIndex }}" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
        </td>
        <td style="border:2px solid #000; padding:0;">
            <input type="text" name="beban_kanan_{{ $formIndex }}" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
        </td>
        <td style="border:2px solid #000; padding:0;">
            <input type="text" name="beban_kiri_{{ $formIndex }}" style="width:100%; height:100%; border:none; background:transparent; text-align:center; padding:8px; box-sizing:border-box;">
        </td>
    </tr>
</table>

<p style="margin-top:0.35pt; font-size:9pt">&nbsp;</p>

<!-- Footer Section - ALAT STANDAR (SESUAI REFERENSI) -->
<table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 100%; margin-left:10.92pt; border:2px solid #000000;">
    <tr>
        <td colspan="5" style="border:2px solid #000; padding:12px; text-align:center; background-color:#f0f0f0;">
            <font style="font-weight:bold; font-size:10pt;">Isilah lembar data kalibrasi dengan lengkap dan jelas!</font>
        </td>
    </tr>
    <tr>
        <td rowspan="1" style="border:2px solid #000; padding:8px; background-color:#f0f0f0; vertical-align:middle;">
            <font style="font-weight:bold;">Peralatan Standard</font>
        </td>
        <td style="border:2px solid #000; padding:8px;">
            <font>Anak Timbangan <i>class</i> :</font>
        </td>
        <td style="border:2px solid #000; padding:8px;">
            <table border="0" cellpadding="0" cellspacing="5">
                <tr>
                    <td style="padding:0 5px;">
                        <input type="checkbox" name="alat_standar[]" value="E2" id="class_E2_{{ $formIndex }}"> 
                        <label for="class_E2_{{ $formIndex }}">E2</label>
                    </td>
                    <td>/</td>
                    <td style="padding:0 5px;">
                        <input type="checkbox" name="alat_standar[]" value="F1" id="class_F1_{{ $formIndex }}"> 
                        <label for="class_F1_{{ $formIndex }}">F1</label>
                    </td>
                    <td>/</td>
                    <td style="padding:0 5px;">
                        <input type="checkbox" name="alat_standar[]" value="F2" id="class_F2_{{ $formIndex }}"> 
                        <label for="class_F2_{{ $formIndex }}">F2</label>
                    </td>
                    <td>/</td>
                    <td style="padding:0 5px;">
                        <input type="checkbox" name="alat_standar[]" value="M1" id="class_M1_{{ $formIndex }}"> 
                        <label for="class_M1_{{ $formIndex }}">M1</label>
                    </td>
                    <td>/</td>
                    <td style="padding:0 5px;">
                        <input type="checkbox" name="alat_standar[]" value="M2" id="class_M2_{{ $formIndex }}"> 
                        <label for="class_M2_{{ $formIndex }}">M2</label>
                    </td>
                    <td>/</td>
                    <td style="padding:0 5px;">
                        <input type="checkbox" name="alat_standar[]" value="M3" id="class_M3_{{ $formIndex }}"> 
                        <label for="class_M3_{{ $formIndex }}">M3</label>
                    </td>
                </tr>
            </table>
            <font size="1"><i>(centang pilihan)</i></font>
        </td>
        <td style="border:2px solid #000; padding:8px; text-align:center;">
            <font style="font-weight:bold;">Dikalibrasi oleh</font><br><br>
            <table border="1" cellpadding="0" cellspacing="0" style="width:100%; height:50px; border:1px solid #000; background-color:#fff;">
                <tr>
                    <td style="text-align:center; vertical-align:bottom; padding:10px;">
                        <font>TTD</font><br>
                        <table border="0" cellpadding="0" cellspacing="0" style="width:100%; margin-top:5px;">
                            <tr>
                                <td style="border-bottom:1px solid #000; padding:3px; text-align:center;">
                                    <font size="2">(...........................................)</font>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <table border="1" cellpadding="0" cellspacing="0" style="width:100%; height:30px; border:1px solid #000; background-color:#fff; margin-top:5px;">
                <tr>
                    <td style="padding:5px;">
                        <input type="text" name="calibrated_by" class="kalibrasi-input" 
                               value="{{ auth()->user()->nama ?? 'System' }}" 
                               placeholder="Nama" 
                               style="border: none; width: 100%; background-color: #f8f9fa;" 
                               readonly>
                    </td>
                </tr>
            </table>
            <font>Nama</font>
        </td>
        <td style="border:2px solid #000; padding:8px; text-align:center;">
            <font style="font-weight:bold;">Diperiksa oleh</font><br><br>
            <table border="1" cellpadding="0" cellspacing="0" style="width:100%; height:50px; border:1px solid #000; background-color:#fff;">
                <tr>
                    <td style="text-align:center; vertical-align:bottom; padding:10px;">
                        <font>TTD</font><br>
                        <table border="0" cellpadding="0" cellspacing="0" style="width:100%; margin-top:5px;">
                            <tr>
                                <td style="border-bottom:1px solid #000; padding:3px; text-align:center;">
                                    <font size="2">(...........................................)</font>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <table border="1" cellpadding="0" cellspacing="0" style="width:100%; height:30px; border:1px solid #000; background-color:#fff; margin-top:5px;">
                <tr>
                    <td style="padding:5px;">
                        <input type="text" name="verified_by" id="verified_by_{{ $formIndex }}" 
                               style="width:100%; height:100%; border:none; text-align:center;" 
                               placeholder="-" value="" {{ $isFirstForm ? 'readonly' : '' }}>
                    </td>
                </tr>
            </table>
            <font>Nama</font>
        </td>
    </tr>
    <tr>
        <td style="border:2px solid #000; padding:8px; background-color:#f0f0f0; vertical-align:middle;">
            <font style="font-weight:bold;">Metode Kalibrasi</font>
        </td>
        <td colspan="4" style="border:2px solid #000; padding:8px;">
            <font>PAS-IK1102-15 (Monograph 4 : The Calibration of Weights and Balances, NMI Australia 2010)</font>
        </td>
    </tr>
</table>
                    </div>

                      @if($formIndex == $count)
                        <div class="row mt-5">
                            <div class="col-12 text-center">
                                <button type="button" id="btnSimpanSemua" onclick="submitSemuaForm()" class="btn btn-primary btn-lg" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
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
    
    var tempFormDataStore = window.tempFormDataStore;
    var isRestoring = window.isRestoring;
    var tabSubmitStatus = window.tabSubmitStatus;
    
    // Global variable untuk menyimpan tab aktif
    var currentActiveTabId = '1';

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
    function IGNORED_disableRequiredOnHiddenForms() {
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
    // Dapatkan tab ID yang aktif
    const activeTabId = getActiveTabId();
    console.log('📌 Submitting from active tab:', activeTabId);
    
    // Cari container yang aktif
    const activeContainer = document.querySelector(`.lk-form-container[data-lk-id="${activeTabId}"]`);
    if (!activeContainer) {
        alert('Container form tidak ditemukan!');
        return;
    }
    
    // 🔥 AMBIL TIMBANGAN TYPE DARI ATTRIBUTE CONTAINER
    const timbanganType = activeContainer.getAttribute('data-current-timbangan-type') || 'standar';
    console.log('📌 Timbangan type:', timbanganType);
    
    // 🔥 AMBIL JUMLAH FORM (UNTUK TIMBANGAN STANDAR BISA MULTIPLE, UNTUK MOISTURE HANYA 1)
    let formCount = 1;
    if (timbanganType === 'moisture') {
        formCount = 1; // Moisture hanya 1 form
        console.log('📌 Moisture mode: Hanya 1 form');
    } else {
        formCount = getFormCount();
        console.log('📌 Standar mode: formCount from URL:', formCount);
    }
    
    // CARI FORM
    let forms = [];
    
    if (timbanganType === 'moisture') {
        // 🔥 UNTUK MOISTURE: CARI SATU FORM (bisa id #kalibrasiForm atau form biasa)
        let form = activeContainer.querySelector('#kalibrasiForm');
        if (!form) {
            form = activeContainer.querySelector('form[id^="kalibrasiForm"]');
        }
        if (!form) {
            form = activeContainer.querySelector('form');
        }
        if (form) {
            forms.push(form);
        }
    } else {
        // UNTUK TIMBANGAN STANDAR: LOOP FORM 1..formCount
        for (let i = 1; i <= formCount; i++) {
            const form = document.getElementById(`kalibrasiForm${i}`);
            if (form) {
                forms.push(form);
                console.log(`✅ Form ${i} ditemukan`);
            } else {
                console.warn(`⚠️ Form ${i} tidak ditemukan (belum dibuat)`);
            }
        }
    }
    
    if (forms.length === 0) {
        alert('Form tidak ditemukan!');
        restoreRequiredOnAllForms();
        return;
    }
    
    // 🔥 JIKA MOISTURE, PASTIKAN FORM NOVALIDATE
    if (timbanganType === 'moisture') {
        forms.forEach(form => {
            form.setAttribute('novalidate', 'novalidate');
            form.noValidate = true;
        });
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
            activeContainer.setAttribute('data-form-name', namaAlat);
        }
    }
    
    // 🔥 VALIDASI UNTUK MOISTURE (CEK DATA SUHU & TIMBANGAN)
    if (timbanganType === 'moisture') {
        const form = forms[0];
        
        // Cek apakah ada data suhu (record 1-3)
        let hasTemperatureData = false;
        for (let i = 1; i <= 3; i++) {
            const tsetting = form.querySelector(`input[name="setting_suhu_${i}"]`)?.value;
            const readAlat01 = form.querySelector(`input[name="pembacaan_alat_${i}_1"]`)?.value;
            const readSTD01 = form.querySelector(`input[name="pembacaan_standar_${i}_1"]`)?.value;
            
            if (tsetting || readAlat01 || readSTD01) {
                hasTemperatureData = true;
                break;
            }
        }
        
        if (!hasTemperatureData) {
            alert('Data suhu untuk Moisture Analyzer belum diisi! Silakan isi setting suhu dan pembacaan untuk record 1-3.');
            return;
        }
        
        console.log('✅ Moisture validation passed');
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
        
        // 🔥 TENTUKAN FORM_TYPE BERDASARKAN TIMBANGAN TYPE
        let formType = 'timbangan';
        if (timbanganType === 'moisture') {
            formType = 'timbangan_moisture';
            console.log('📌 Mengirim sebagai timbangan_moisture');
        }
        combinedFormData.append('form_type', formType);
        
        // 🔥 KIRIM TIMBANGAN_TYPE KE SERVER
        combinedFormData.append('timbangan_type', timbanganType);
        
        if (timbanganType === 'moisture') {
            // 🔥 UNTUK MOISTURE: PROSES SATU FORM SAJA
            const form = forms[0];
            const formData = new FormData(form);
            
            for (let [key, value] of formData.entries()) {
                if (key === '_token') continue;
                combinedFormData.append(key, value);
            }
            
            // 🔥 AMBIL ALAT STANDAR DARI FORM
            let alatStandarValues = [];
            const checkboxes = form.querySelectorAll('input[name="alat_standar[]"]:checked');
            if (checkboxes.length > 0) {
                checkboxes.forEach(cb => {
                    if (cb.value) alatStandarValues.push(cb.value);
                });
            } else {
                const alatStandarText = form.querySelector('input[name="alat_standar_text"]')?.value;
                const alatStandarSpan = form.querySelector('.alat-standar-text')?.innerText;
                if (alatStandarText) alatStandarValues.push(alatStandarText);
                else if (alatStandarSpan) alatStandarValues.push(alatStandarSpan.trim());
            }
            
            if (alatStandarValues.length > 0) {
                combinedFormData.delete('alat_standar[]');
                combinedFormData.delete('alat_standar_text');
                alatStandarValues.forEach(value => {
                    combinedFormData.append('alat_standar[]', value);
                });
                console.log('📤 Alat standar moisture:', alatStandarValues);
            }
            
            // 🔥 AMBIL DATA SUHU UNTUK MOISTURE (RECORD 1-3)
            for (let i = 1; i <= 3; i++) {
                const tsetting = form.querySelector(`input[name="setting_suhu_${i}"]`)?.value;
                const readAlat01 = form.querySelector(`input[name="pembacaan_alat_${i}_1"]`)?.value;
                const readAlat02 = form.querySelector(`input[name="pembacaan_alat_${i}_2"]`)?.value;
                const readAlat03 = form.querySelector(`input[name="pembacaan_alat_${i}_3"]`)?.value;
                const readSTD01 = form.querySelector(`input[name="pembacaan_standar_${i}_1"]`)?.value;
                const readSTD02 = form.querySelector(`input[name="pembacaan_standar_${i}_2"]`)?.value;
                const readSTD03 = form.querySelector(`input[name="pembacaan_standar_${i}_3"]`)?.value;
                
                if (tsetting || readAlat01 || readSTD01) {
                    combinedFormData.append(`setting_suhu_${i}`, tsetting || '');
                    combinedFormData.append(`pembacaan_alat_${i}_1`, readAlat01 || '');
                    combinedFormData.append(`pembacaan_alat_${i}_2`, readAlat02 || '');
                    combinedFormData.append(`pembacaan_alat_${i}_3`, readAlat03 || '');
                    combinedFormData.append(`pembacaan_standar_${i}_1`, readSTD01 || '');
                    combinedFormData.append(`pembacaan_standar_${i}_2`, readSTD02 || '');
                    combinedFormData.append(`pembacaan_standar_${i}_3`, readSTD03 || '');
                }
            }
            
            // 🔥 TIDAK PERLU submit_all UNTUK MOISTURE
            // combinedFormData.append('submit_all', 'false');
            
        } else {
            // 🔥 UNTUK TIMBANGAN STANDAR: PROSES MULTIPLE FORM
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
        }
        
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        combinedFormData.append('_token', csrfToken);
        
        console.log('📤 Mengirim data dari tab:', activeTabId);
        console.log('📤 Form type:', formType);
        console.log('📤 Timbangan type:', timbanganType);
        
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
            alert('Data berhasil disimpan!');
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
    
    
 /* ── Standar Picker (Multi-select chip) dengan Fitur Copy ── */
(function () {
    'use strict';

    // Bangun list AT secara dinamis
    var dynamicAtItems = [];
    for (var i = 1; i <= 5; i++) {
        dynamicAtItems.push('AT-5-' + (i < 10 ? '0' : '') + i);
    }
    for (var i = 1; i <= 6; i++) {
        dynamicAtItems.push('AT-10-' + (i < 10 ? '0' : '') + i);
    }
    for (var i = 1; i <= 115; i++) {
        dynamicAtItems.push('AT-20-' + (i < 10 ? '0' : '') + i);
    }

    var SP_OPTIONS = [
        { group: 'M. Anak Timbangan', items: [
            'M.001','M.002','M.003','M.004','M.005','M.006','M.007',
            'M.008','M.009','M.010','M.011','M.012','M.013','M.014','M.015',
            'M.016','M.017','M.018','M.019','M.020','M.021'
        ]},
        { group: 'AT. Anak Timbangan', items: dynamicAtItems }
    ];
    var SP_MAX = Infinity;
    var activeDropdown = null;

    // ==========================================
    // FUNGSI CORE STANDAR PICKER
    // ==========================================
    function buildOptionList(listEl, selected, searchVal) {
        listEl.innerHTML = '';
        var q = (searchVal || '').toLowerCase();
        SP_OPTIONS.forEach(function (grp) {
            var filtered = grp.items.filter(function (item) {
                return !q || item.toLowerCase().includes(q);
            });
            if (!filtered.length) return;
            var lbl = document.createElement('div');
            lbl.className = 'sp-group-label';
            lbl.textContent = grp.group;
            listEl.appendChild(lbl);
            filtered.forEach(function (item) {
                var opt = document.createElement('div');
                opt.className = 'sp-option' + (selected.includes(item) ? ' selected' : '');
                opt.dataset.value = item;
                opt.innerHTML =
                    '<span class="sp-check">' + (selected.includes(item) ? '✓' : '') + '</span>' +
                    '<span>' + item + '</span>';
                listEl.appendChild(opt);
            });
            var div = document.createElement('hr');
            div.className = 'sp-divider';
            listEl.appendChild(div);
        });
    }

    // ==========================================
    // HELPER: GET SP ELEMENTS RELATIVE TO WRAPPER
    // ==========================================
    function getSpElements(wrapper) {
        if (!wrapper) return null;

        var parentTd = wrapper.closest('td') || wrapper.parentElement;
        var hidden = parentTd ? parentTd.querySelector('input[type="hidden"]') : null;
        var display = wrapper.querySelector('.sp-display');
        var ph = display ? display.querySelector('.sp-placeholder') : wrapper.querySelector('.sp-placeholder');

        var dd = wrapper._ddElement || wrapper.querySelector('.sp-dropdown');
        var id = wrapper.dataset.id;

        if (!dd && id) {
            dd = document.getElementById('sp_dd_' + id) || document.querySelector('[id^="sp_dd_' + id + '"]');
        }

        var search = dd ? dd.querySelector('.sp-search') : null;
        var listEl = dd ? dd.querySelector('.sp-option-list') : null;

        if (id) {
            if (!hidden) hidden = document.getElementById('sp_hidden_' + id) || document.querySelector('[id^="sp_hidden_' + id + '"]');
            if (!display) display = document.getElementById('sp_display_' + id) || document.querySelector('[id^="sp_display_' + id + '"]');
            if (!ph) ph = document.getElementById('sp_ph_' + id) || document.querySelector('[id^="sp_ph_' + id + '"]');
            if (dd) {
                if (!search) search = dd.querySelector('.sp-search') || document.getElementById('sp_search_' + id) || document.querySelector('[id^="sp_search_' + id + '"]');
                if (!listEl) listEl = dd.querySelector('.sp-option-list') || document.getElementById('sp_list_' + id) || document.querySelector('[id^="sp_list_' + id + '"]');
            }
        }

        return {
            hidden: hidden,
            display: display,
            ph: ph,
            dd: dd,
            search: search,
            listEl: listEl
        };
    }

    // 🔥 renderChips dengan sync dari hidden
    window.renderChips = function(wrapper, selected) {
        var els = getSpElements(wrapper);
        if (!els || !els.display || !els.ph || !els.hidden) {
            console.warn('Elements not found for wrapper:', wrapper);
            return;
        }
        var display = els.display;
        var ph = els.ph;
        var hidden = els.hidden;

        // 🔥 Sinkronkan selected dengan nilai di hidden
        if (hidden.value) {
            var hiddenSelected = hidden.value.split('+').filter(Boolean);
            if (selected.length === 0 && hiddenSelected.length > 0) {
                selected = hiddenSelected;
            }
        }

        // Hapus chip lama
        Array.from(display.children).forEach(function (c) {
            if (c.classList.contains('sp-chip')) c.remove();
        });

        if (!selected || selected.length === 0) {
            ph.style.display = '';
            hidden.value = '';
            wrapper.dataset.value = '';
            return;
        }

        ph.style.display = 'none';
        selected.forEach(function (val) {
            var chip = document.createElement('span');
            chip.className = 'sp-chip';
            chip.innerHTML = val + '<span class="sp-remove" data-val="' + val + '">×</span>';
            chip.querySelector('.sp-remove').addEventListener('click', function (e) {
                e.stopPropagation();
                var idx = selected.indexOf(val);
                if (idx !== -1) {
                    selected.splice(idx, 1);
                    // 🔥 Update hidden dan wrapper
                    hidden.value = selected.join('+');
                    wrapper.dataset.value = selected.join('+');
                    window.renderChips(wrapper, selected);
                    refreshDropdown(wrapper, selected);
                }
            });
            display.insertBefore(chip, ph);
        });
        hidden.value = selected.join('+');
        wrapper.dataset.value = selected.join('+');
    };

    function refreshDropdown(wrapper, selected) {
        var els = getSpElements(wrapper);
        if (!els || !els.listEl) return;
        buildOptionList(els.listEl, selected, els.search ? els.search.value : '');
        attachOptionClicks(els.listEl, wrapper, selected);
    }

    function attachOptionClicks(listEl, wrapper, selected) {
        listEl.querySelectorAll('.sp-option').forEach(function (opt) {
            opt.removeEventListener('click', opt._clickHandler);
            opt._clickHandler = function (e) {
                e.stopPropagation();
                var val = opt.dataset.value;

                var els = getSpElements(wrapper);
                if (els && els.hidden) {
                    var currentValue = els.hidden.value;
                    selected = currentValue ? currentValue.split('+').filter(Boolean) : [];
                }

                var idx = selected.indexOf(val);
                if (idx === -1) {
                    if (selected.length >= SP_MAX) {
                        showToast('Maksimal ' + SP_MAX + ' pilihan!');
                        return;
                    }
                    selected.push(val);
                } else {
                    selected.splice(idx, 1);
                }

                // Update
                window.renderChips(wrapper, selected);
                refreshDropdown(wrapper, selected);

                // 🔥 Update data-value di wrapper
                wrapper.dataset.value = selected.join('+');
            };
            opt.addEventListener('click', opt._clickHandler);
        });
    }

    function positionDropdown(wrapper, dd) {
        if (!wrapper || !dd) return;
        var rect = wrapper.getBoundingClientRect();
        var spaceBelow = window.innerHeight - rect.bottom;
        var spaceAbove = rect.top;
        dd.style.left = rect.left + 'px';
        dd.style.width = Math.max(220, rect.width) + 'px';
        if (spaceBelow >= 200 || spaceBelow >= spaceAbove) {
            dd.style.top = rect.bottom + 'px';
            dd.style.bottom = 'auto';
        } else {
            dd.style.bottom = (window.innerHeight - rect.top) + 'px';
            dd.style.top = 'auto';
        }
    }

    function openDropdown(wrapper, selected) {
        if (activeDropdown && activeDropdown !== wrapper) {
            closeDropdown(activeDropdown);
        }
        var els = getSpElements(wrapper);
        var dd = els ? els.dd : null;
        if (!dd) {
            console.warn('Dropdown element not found for wrapper:', wrapper);
            return;
        }
        wrapper._ddElement = dd;
        if (dd.parentElement !== document.body) {
            document.body.appendChild(dd);
        }
        positionDropdown(wrapper, dd);
        dd.classList.add('open');
        activeDropdown = wrapper;
        var search = els.search;
        if (search) {
            search.value = '';
            setTimeout(function() { search.focus(); }, 50);
        }
        refreshDropdown(wrapper, selected);
    }

    function closeDropdown(wrapper) {
        if (!wrapper) return;
        var els = getSpElements(wrapper);
        var dd = els ? els.dd : null;
        if (dd) dd.classList.remove('open');
        if (activeDropdown === wrapper) activeDropdown = null;
    }

    function initPicker(wrapper) {
        var els = getSpElements(wrapper);
        if (!els) return;

        var rawVal = wrapper.dataset.value || (els.hidden ? els.hidden.value : '');
        var selected = rawVal ? rawVal.split('+').map(function (s) { return s.trim(); }).filter(Boolean) : [];

        // 🔥 Sinkronkan dengan hidden
        if (els.hidden && els.hidden.value && selected.length === 0) {
            selected = els.hidden.value.split('+').filter(Boolean);
            wrapper.dataset.value = els.hidden.value;
        }

        window.renderChips(wrapper, selected);

        if (els.search) {
            els.search.removeEventListener('input', els.search._spInputHandler);
            els.search._spInputHandler = function () {
                refreshDropdown(wrapper, selected);
            };
            els.search.addEventListener('input', els.search._spInputHandler);

            els.search.removeEventListener('click', els.search._spClickHandler);
            els.search._spClickHandler = function (e) { e.stopPropagation(); };
            els.search.addEventListener('click', els.search._spClickHandler);

            els.search.removeEventListener('keydown', els.search._spKeyHandler);
            els.search._spKeyHandler = function (e) {
                if (e.key === 'Escape') closeDropdown(wrapper);
            };
            els.search.addEventListener('keydown', els.search._spKeyHandler);
        }

        wrapper.removeEventListener('click', wrapper._clickHandler);
        wrapper._clickHandler = function (e) {
            var currentEls = getSpElements(wrapper);
            var dd = currentEls ? currentEls.dd : null;
            if (dd && dd.classList.contains('open')) {
                closeDropdown(wrapper);
            } else {
                openDropdown(wrapper, selected);
            }
        };
        wrapper.addEventListener('click', wrapper._clickHandler);
    }

    // ==========================================
    // 🔥 FUNGSI COPY STANDAR PICKER
    // ==========================================
    window.copyStandarPicker = function(formIndex, fromRow, toRow) {
        console.log('📋 Copy Standar dari row', fromRow, 'ke row', toRow);

        var sourceWrapper = null;
        var targetWrapper = null;

        var wrappers = document.querySelectorAll('.sp-wrapper');
        wrappers.forEach(function(w) {
            var dId = w.dataset.id || '';
            if (dId === formIndex + '_' + fromRow || dId.endsWith('_' + fromRow) || dId.startsWith(formIndex + '_' + fromRow + '_')) {
                sourceWrapper = w;
            }
            if (dId === formIndex + '_' + toRow || dId.endsWith('_' + toRow) || dId.startsWith(formIndex + '_' + toRow + '_')) {
                targetWrapper = w;
            }
        });

        if (!sourceWrapper) {
            var sourceHidden = document.querySelector('[id^="sp_hidden_' + formIndex + '_' + fromRow + '"]');
            if (sourceHidden) {
                sourceWrapper = sourceHidden.closest('td').querySelector('.sp-wrapper');
            }
        }

        if (!targetWrapper) {
            var targetHidden = document.querySelector('[id^="sp_hidden_' + formIndex + '_' + toRow + '"]');
            if (targetHidden) {
                targetWrapper = targetHidden.closest('td').querySelector('.sp-wrapper');
            }
        }

        if (!sourceWrapper) {
            console.error('❌ Source wrapper not found! Row:', fromRow);
            showToast('❌ Row ' + fromRow + ' tidak ditemukan!');
            return;
        }

        if (!targetWrapper) {
            console.error('❌ Target wrapper not found! Row:', toRow);
            showToast('❌ Row ' + toRow + ' tidak ditemukan!');
            return;
        }

        var sourceEls = getSpElements(sourceWrapper);
        var targetEls = getSpElements(targetWrapper);

        if (!sourceEls || !sourceEls.hidden || !targetEls || !targetEls.hidden) {
            console.error('❌ Hidden inputs not found for copy');
            showToast('❌ Data standar tidak ditemukan!');
            return;
        }

        var sourceValue = sourceEls.hidden.value;
        var selected = sourceValue ? sourceValue.split('+').filter(Boolean) : [];

        targetEls.hidden.value = selected.join('+');
        targetWrapper.dataset.value = selected.join('+');

        window.renderChips(targetWrapper, selected);
        refreshDropdown(targetWrapper, selected);

        if (targetEls.display) {
            var parentTd = targetEls.display.closest('td');
            if (parentTd) {
                parentTd.classList.add('copy-success-flash');
                setTimeout(function() {
                    parentTd.classList.remove('copy-success-flash');
                }, 500);
            }
        }

        if (selected.length > 0) {
            showToast('✅ Standar dari Row ' + fromRow + ' berhasil di-copy ke Row ' + toRow + ' (' + selected.join(', ') + ')');
        } else {
            showToast('ℹ️ Row ' + fromRow + ' kosong, tidak ada yang di-copy');
        }
    };

    // ==========================================
    // FUNGSI NOTIFIKASI
    // ==========================================
    function showToast(message) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'info',
                title: 'Informasi',
                text: message,
                timer: 2000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        } else {
            alert(message);
        }
    }

    // ==========================================
    // INISIALISASI
    // ==========================================
    function initAllPickers() {
        console.log('🚀 Initializing Standar Pickers...');
        var wrappers = document.querySelectorAll('.sp-wrapper');
        console.log('📦 Found ' + wrappers.length + ' picker(s)');

        wrappers.forEach(function(wrapper) {
            initPicker(wrapper);
        });
    }

    window.initAllStandarPickers = initAllPickers;

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initAllPickers);
    } else {
        initAllPickers();
    }

    document.addEventListener('click', function(e) {
        if (!activeDropdown) return;
        var els = getSpElements(activeDropdown);
        var dd = els ? els.dd : null;
        if (!activeDropdown.contains(e.target) && dd && !dd.contains(e.target)) {
            closeDropdown(activeDropdown);
        }
    });

    window.addEventListener('scroll', function() {
        if (activeDropdown) {
            var els = getSpElements(activeDropdown);
            var dd = els ? els.dd : null;
            if (dd) positionDropdown(activeDropdown, dd);
        }
    }, true);

    window.addEventListener('resize', function() {
        if (activeDropdown) {
            var els = getSpElements(activeDropdown);
            var dd = els ? els.dd : null;
            if (dd) positionDropdown(activeDropdown, dd);
        }
    });
})();
</script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>