<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Form Kalibrasi Ultrasonic Thickness Gauge - PT. PANANJUNG ANUGRAH SOLUTION</title>
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

        /* Disabled field style */
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
            <i class="fas fa-file-alt" style="margin-right:8px;"></i>Form Ultrasonic Thickness Gauge ke-{{ $formIndex }}
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
                <input type="hidden" name="form_type" value="ultrasonic_thickness_gauge">
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
                    <input type="hidden" name="kode_th" id="kode_th_hidden_{{ $formIndex }}" value="">
                    <input type="hidden" name="fungsi_komponen" id="fungsi_komponen_hidden_{{ $formIndex }}" value="">
                    <!-- keterangan_fungsi_komponen diisi langsung per form (tidak disync dari form 1) -->
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
                                <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK59</p>
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
                                <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">ULTRASONIC THICKNESS GAUGE</p>
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
                                        class="kalibrasi-input" onchange="updateFormType(this.value, {{ $formIndex }}, {{ $tabId }})">
                                        <option value="">-- Pilih Alat --</option>
                                        <option value="Ultrasonic Thickness Gauge">Ultrasonic Thickness Gauge</option>
                                        <option value="MANUAL_INPUT">-- Input Nama Alat --</option>
                                    </select>
                                    
                                    <div id="manualInputContainer_{{ $formIndex }}_tab{{ $tabId }}" style="display: none; margin-top: 10px;">
                                        <input type="text" name="nama_alat_manual" id="nama_alat_manual_{{ $formIndex }}_tab{{ $tabId }}"
                                               placeholder="Ketik nama alat"
                                               style="background-color: #f5f5f5; color: #333; border: 1px solid #ced4da; padding: 6px 10px; border-radius: 4px; width: 100%;"
                                               oninput="syncNamaAlat({{ $formIndex }}, {{ $tabId }})">
                                    </div>
                                    
                                    <input type="hidden" name="nama_alat_final" id="nama_alat_final_{{ $formIndex }}" value="">
                                    <input type="hidden" name="nama_alat_display" id="nama_alat_display_{{ $formIndex }}" value="">
                                @else
                                    <input type="text" name="nama_alat_display" id="nama_alat_copy_{{ $formIndex }}" class="kalibrasi-input disabled-field" readonly disabled placeholder="Mengikuti Form 1" style="background-color: #e9ecef;">
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
                                        <input type="text" name="type_alat" id="type_alat_{{ $formIndex }}" class="kalibrasi-input me-3" placeholder="Masukkan Type Alat" style="width: 45%;" required oninput="formatTypeAlat(this)">
                                        <span class="me-3" style="color: #000000;">/</span>
                                        <input type="text" name="no_seri" id="no_seri_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan No. Seri" style="width: 45%;" required oninput="formatNoSeri(this)">
                                    @else
                                        <input type="text" name="type_alat_display" id="type_alat_{{ $formIndex }}" class="kalibrasi-input me-3 disabled-field" placeholder="Mengikuti Form 1" style="width: 45%; background-color: #e9ecef;" readonly disabled>
                                        <span class="me-3" style="color: #000000;">/</span>
                                        <input type="text" name="no_seri_display" id="no_seri_{{ $formIndex }}" class="kalibrasi-input disabled-field" placeholder="Mengikuti Form 1" style="width: 45%; background-color: #e9ecef;" readonly disabled>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Rentang Ukur -->
                        <!--<tr>-->
                        <!--    <td><p style="margin:0;color:#000">Rentang Ukur</p></td>-->
                        <!--    <td colspan="3">-->
                        <!--        <div class="d-flex align-items-center">-->
                        <!--            <input type="text" name="rentang_ukur_min" id="rentang_ukur_min_{{ $formIndex }}" class="kalibrasi-input me-3" value="0" style="width:45%;" placeholder="Masukkan Range Min">-->
                        <!--            <span class="me-3">-</span>-->
                        <!--            <input type="text" name="rentang_ukur_max" id="rentang_ukur_max_{{ $formIndex }}" class="kalibrasi-input" style="width:45%;" placeholder="Masukkan Range Max">-->
                        <!--        </div>-->
                        <!--    </td>-->
                        <!--</tr>-->

                        <!-- KAPASITAS / RESOLUSI -->
                        <tr>
                            <td><p style="margin:0;color:#000">Kapasitas / Resolusi</p></td>
                            <td colspan="3">
                                <div class="d-flex align-items-center gap-3">
                                    <div style="width: 45%;">
                                        @if($isFirstForm)
                                            <input type="text" name="kapasitas" id="kapasitas_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan Kapasitas" required>
                                        @else
                                            <input type="text" name="kapasitas_display" id="kapasitas_{{ $formIndex }}" class="kalibrasi-input disabled-field" placeholder="Mengikuti Form 1" style="background-color: #e9ecef;" readonly disabled>
                                        @endif
                                    </div>
                                    <span style="color: #000000;">/</span>
                                    <div style="width: 45%;">
                                        @if($isFirstForm)
                                            <input type="text" name="resolusi" id="resolusi_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan Resolusi" required>
                                        @else
                                            <input type="text" name="resolusi_display" id="resolusi_{{ $formIndex }}" class="kalibrasi-input disabled-field" placeholder="Mengikuti Form 1" style="background-color: #e9ecef;" readonly disabled>
                                        @endif
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
                            <td><p style="margin: 0; color: #000000;">Kode TH</p></td>
                            <td colspan="3">
                                @if($isFirstForm)
                                    <input type="text" name="kode_th" id="kode_th_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan Kode TH" style="width: 100%; margin-top: 8px;">
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
                                        <input type="text" name="keterangan_fungsi_komponen" id="keterangan_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan Keterangan (Form {{ $formIndex }})" style="border: none;">
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
                
                    <!-- DATA KALIBRASI -->
                    <div class="data-kalibrasi-header" style="color: #000000;">DATA KALIBRASI</div>
                    <div class="mb-3">
                        <span style="font-size: 16px; font-weight: bold; color: #000000;">Uji Skala Nominal</span>
                    </div>
                    
                    <table class="kalibrasi-data-table">
                        <tr style="background: #d9d9d9;">
                            <td style="width: 20%;">
                                <span style="font-weight: bold; color: #000000;">Nilai Nominal</span>
                            </td>
                            <td colspan="5">
                                <span style="font-weight: bold; color: #000000;">Penunjukan Alat</span>
                            </td>
                        </tr>
                        <tr style="background: #e8e8e8;">
                            <td style="padding: 8px;">
                                <div style="display: flex; align-items: center; justify-content: center; gap: 5px;">
                                    <span style="font-weight: bold; color: #000000;">Unit (</span>
                                    <input type="text" 
                                           name="satuan_unit_{{ $formIndex }}" 
                                           value="mm"
                                           style="width: 60px; padding: 4px 6px; border: 1px solid #ccc; border-radius: 3px; text-align: center; font-weight: bold; background: #fff;">
                                    <span style="font-weight: bold; color: #000000;">)</span>
                                </div>
                            </td>
                            <td style="width: 16%; text-align: center;"><span style="font-weight: bold; color: #000000;">1</span></td>
                            <td style="width: 16%; text-align: center;"><span style="font-weight: bold; color: #000000;">2</span></td>
                            <td style="width: 16%; text-align: center;"><span style="font-weight: bold; color: #000000;">3</span></td>
                            <td style="width: 16%; text-align: center;"><span style="font-weight: bold; color: #000000;">4</span></td>
                            <td style="width: 16%; text-align: center;"><span style="font-weight: bold; color: #000000;">5</span></td>
                        </tr>
                    
                        @for($i = 1; $i <= 15; $i++)
                            <tr style="height:21.3pt;">
                                <td style="border:2px solid #000; padding:0; background: #f0f0f0;">
                                    <input type="text" 
                                        name="nominal_{{ $formIndex }}_{{ $i }}" 
                                        style="width:100%;height:100%;border:none;background:transparent;text-align:center;font-size:10pt;color:#000;padding:2px;">
                                </td>
                                <td style="border:2px solid #000; padding:0;">
                                    <input type="text" 
                                        name="penunjukan_{{ $formIndex }}_{{ $i }}_1" 
                                        style="width:100%;height:100%;border:none;background:transparent;text-align:center;font-size:10pt;color:#000;padding:2px;">
                                </td>
                                <td style="border:2px solid #000; padding:0;">
                                    <input type="text" 
                                        name="penunjukan_{{ $formIndex }}_{{ $i }}_2" 
                                        style="width:100%;height:100%;border:none;background:transparent;text-align:center;font-size:10pt;color:#000;padding:2px;">
                                </td>
                                <td style="border:2px solid #000; padding:0;">
                                    <input type="text" 
                                        name="penunjukan_{{ $formIndex }}_{{ $i }}_3" 
                                        style="width:100%;height:100%;border:none;background:transparent;text-align:center;font-size:10pt;color:#000;padding:2px;">
                                </td>
                                <td style="border:2px solid #000; padding:0;">
                                    <input type="text" 
                                        name="penunjukan_{{ $formIndex }}_{{ $i }}_4" 
                                        style="width:100%;height:100%;border:none;background:transparent;text-align:center;font-size:10pt;color:#000;padding:2px;">
                                </td>
                                <td style="border:2px solid #000; padding:0;">
                                    <input type="text" 
                                        name="penunjukan_{{ $formIndex }}_{{ $i }}_5" 
                                        style="width:100%;height:100%;border:none;background:transparent;text-align:center;font-size:10pt;color:#000;padding:2px;">
                                </td>
                            </tr>
                        @endfor
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
                                GAUGE BLOCK SET
                            </td>
                            @if($isFirstForm)
                                <input type="hidden" name="alat_standar_text" value="GAUGE BLOCK SET">
                            @endif
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
                                PAS-IK1102-59 (IS 15468 : 2004)
                            </td>
                            <td colspan="3" style="border: 1px solid #000; padding: 12px; text-align: center;">
                                Nama: 
                                @if($isFirstForm)
                                    <input type="text" name="calibrated_by" id="calibrated_by_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan nama" style="width: 70%; border: none; background: transparent; text-align: center;" value="{{ auth()->user()->nama ?? 'System' }}">
                                @else
                                    <input type="text" name="calibrated_by_display" id="calibrated_by_{{ $formIndex }}" class="kalibrasi-input disabled-field" placeholder="Mengikuti Form 1" style="width: 70%; border: none; background: transparent; text-align: center; background-color: #e9ecef;" readonly disabled>
                                @endif
                            </td>
                            <td colspan="3" style="border: 1px solid #000; padding: 12px; text-align: center;">
                                Nama: 
                                @if($isFirstForm)
                                    <input type="text" name="verified_by" id="verified_by_{{ $formIndex }}" class="kalibrasi-input" placeholder="-" style="width: 70%; border: none; background: transparent; text-align: center;" readonly>
                                @else
                                    <input type="text" name="verified_by_display" id="verified_by_{{ $formIndex }}" class="kalibrasi-input disabled-field" placeholder="Mengikuti Form 1" style="width: 70%; border: none; background: transparent; text-align: center; background-color: #e9ecef;" readonly disabled>
                                @endif
                            </td>
                        </tr>
                    </table>

                    <!-- Submit Button Section -->
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
    // FUNGSI GET FORM COUNT
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

    // ==========================================
    // FUNGSI GET FORM VALUE
    // ==========================================
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

    // ==========================================
    // SYNC DATA DARI FORM 1 KE FORM LAIN
    // ==========================================
    function syncAllFormsData() {
        const formCount = getFormCount();
        if (formCount <= 1) return;
        
        const form1 = document.getElementById('kalibrasiForm1');
        if (!form1) return;
        
        // Field yang mengikuti Form 1
        const fieldsToSync = [
            'nama_alat', 'merek', 'kode_alat', 'type_alat', 'no_seri',
            'kapasitas', 'resolusi', 'nama_pemilik', 'tanggal_alat_masuk',
            'tanggal_kalibrasi', 'jenis_pembacaan', 'tempat_kalibrasi',
            'lokasi_pt', 'kode_th', 'fungsi_komponen',
            'suhu_awal', 'suhu_tengah',
            'suhu_akhir', 'rh_awal', 'rh_tengah', 'rh_akhir', 'verified_by'
        ];
        
        let form1Values = {};
        fieldsToSync.forEach(field => {
            form1Values[field] = getFormValue(form1, field);
        });
        
        // Update form 2 dan seterusnya
        for (let i = 2; i <= formCount; i++) {
            const form = document.getElementById(`kalibrasiForm${i}`);
            if (!form) continue;
            
            fieldsToSync.forEach(field => {
                setFormValue(form, field, form1Values[field]);
            });
        }
    }

    // ==========================================
    // UPDATE FORM TYPE
    // ==========================================
    function updateFormType(selectedAlat, formIndex, tabId = null) {
        const currentTabId = tabId || getActiveTabId();
        const manualContainer = document.getElementById(`manualInputContainer_${formIndex}_tab${currentTabId}`);
        const manualInput = document.getElementById(`nama_alat_manual_${formIndex}_tab${currentTabId}`);
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
    }

    function syncNamaAlat(formIndex, tabId = null) {
        const currentTabId = tabId || getActiveTabId();
        const manualInput = document.getElementById(`nama_alat_manual_${formIndex}_tab${currentTabId}`);
        const finalInput = document.getElementById(`nama_alat_final_${formIndex}`);
        if (manualInput && finalInput) {
            finalInput.value = manualInput.value;
        }
    }

    function formatTypeAlat(input) {
        // Fungsi formatting jika diperlukan
    }

    function formatNoSeri(input) {
        // Fungsi formatting jika diperlukan
    }

    // ==========================================
    // ESCAPE HTML
    // ==========================================
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
        console.log('🎉 handleSaveSuccess called for tab:', tabId, data);
        
        // Cari container berdasarkan tabId
        const container = document.querySelector(`.lk-form-container[data-lk-id="${tabId}"]`);
        if (!container) {
            console.error(`Container for tab ${tabId} not found!`);
            return;
        }

        const formName = container.getAttribute('data-form-name') || 'Ultrasonic Thickness Gauge';
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
                            style="border-radius: 10px; transition: all 0.2s ease;"
                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 5px 15px rgba(0,0,0,0.2)';"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';"
                            onmousedown="this.style.transform='translateY(1px)';"
                            onmouseup="this.style.transform='translateY(-2px)';"
                            onclick="window.open('${printLabelUrl}', '_blank')">
                        <i class="fas fa-print me-2"></i> Cetak Label
                    </button>
                    
                    <button type="button" class="btn btn-success btn-lg px-4 py-2" 
                            style="border-radius: 10px; transition: all 0.2s ease;"
                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 5px 15px rgba(0,0,0,0.2)';"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';"
                            onmousedown="this.style.transform='translateY(1px)';"
                            onmouseup="this.style.transform='translateY(-2px)';"
                            onclick="resetTabForNewScan(${tabId})">
                        <i class="fas fa-plus-circle me-2"></i> Input Lagi
                    </button>
                    
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
    // SUBMIT SEMUA FORM
    // ==========================================
    async function submitSemuaForm() {
        console.log('📌 Submitting all forms...');
        
        // Kumpulkan semua form
        const forms = [];
        for (let i = 1; i <= 100; i++) {
            const form = document.getElementById(`kalibrasiForm${i}`);
            if (form) {
                forms.push(form);
            } else {
                break;
            }
        }
        
        const formCount = forms.length;
        console.log('📊 Total forms to submit:', formCount);
        
        if (forms.length === 0) {
            alert('Tidak ada form yang ditemukan!');
            return;
        }
        
        // Nonaktifkan required pada form yang tidak visible
        disableRequiredOnHiddenForms();
        
        // Validasi semua form
        let allValid = true;
        for (let i = 0; i < forms.length; i++) {
            if (!forms[i].reportValidity()) {
                allValid = false;
                alert(`Mohon lengkapi data pada Form ${i+1} terlebih dahulu!`);
                break;
            }
        }
        
        if (!allValid) {
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
            
            // CSRF Token
            let csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            if (!csrfToken && forms[0]) {
                const csrfInput = forms[0].querySelector('input[name="_token"]');
                if (csrfInput) csrfToken = csrfInput.value;
            }
            
            if (!csrfToken) {
                throw new Error('CSRF token tidak ditemukan. Refresh halaman!');
            }
            
            combinedFormData.append('_token', csrfToken);
            combinedFormData.append('form_type', 'ultrasonic_thickness_gauge');
            combinedFormData.append('jumlah_form', formCount.toString());
            combinedFormData.append('submit_all', 'true');
            
            // Proses setiap form
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
                }
                
                combinedFormData.append(`form_${formIndex}_form_index`, formIndex);
                combinedFormData.append(`form_${formIndex}_form_type`, 'ultrasonic_thickness_gauge');
                combinedFormData.append(`form_${formIndex}_jumlah_form`, formCount);
            }
            
            // Kirim request
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
            
            if (typeof window.handleSaveSuccess === 'function') {
                window.handleSaveSuccess('1', result);
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
    // FUNGSI MENONAKTIFKAN REQUIRED
    // ==========================================
    function disableRequiredOnHiddenForms() {
        const formCount = getFormCount();
        
        for (let i = 1; i <= formCount; i++) {
            const form = document.getElementById(`kalibrasiForm${i}`);
            if (!form) continue;
            
            const requiredInputs = form.querySelectorAll('[required]');
            
            // Untuk form 2 dan seterusnya, nonaktifkan required jika bukan form pertama
            if (i > 1) {
                requiredInputs.forEach(input => {
                    input.removeAttribute('required');
                    input.setAttribute('data-required-temp', 'true');
                });
            }
        }
    }

    function restoreRequiredOnAllForms() {
        document.querySelectorAll('[data-required-temp]').forEach(input => {
            input.setAttribute('required', 'required');
            input.removeAttribute('data-required-temp');
        });
    }

    // ==========================================
    // INISIALISASI
    // ==========================================
    document.addEventListener('DOMContentLoaded', function() {
        console.log('🚀 DOM Content Loaded - Ultrasonic Thickness Gauge');
        
        const formCount = getFormCount();
        console.log('📊 Form count:', formCount);
        
        if (formCount > 1) {
            setTimeout(syncAllFormsData, 500);
        }
        
        // Setup event listener untuk nama alat di form pertama
        const namaAlatSelect = document.getElementById('nama_alat_select_1_tab1');
        if (namaAlatSelect) {
            namaAlatSelect.addEventListener('change', function() {
                updateFormType(this.value, 1, 1);
            });
        }
        
        // Nonaktifkan required pada form yang tidak visible pertama kali
        setTimeout(() => {
            disableRequiredOnHiddenForms();
        }, 300);
        
        console.log('✅ Initialization complete!');
    });
    </script>
</body>
</html>