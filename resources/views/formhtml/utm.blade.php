<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        $tabId = $tabId ?? request()->query('tab_id', 1);
    @endphp

    @for($formIndex = 1; $formIndex <= $count; $formIndex++)
        @php
            $isFirstForm = ($formIndex == 1);
        @endphp

        @if($count > 1)
        <div style="background: linear-gradient(135deg,#1e40af,#3b82f6); color:#fff; padding:10px 20px; margin: 16px 0 0; border-radius:8px 8px 0 0; font-weight:bold; font-size:16px;">
            <i class="fas fa-file-alt" style="margin-right:8px;"></i>Form Mesin Uji Tarik/Tekan ke-{{ $formIndex }}
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
                <input type="hidden" name="form_type" value="utm">
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
                                <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK54</p>
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
                                <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">MESIN UJI TARIK/TEKAN</p>
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
                                        class="kalibrasi-input" onchange="updateFormType(this.value, {{ $formIndex }}, '{{ $tabId }}')">
                                        <option value="">-- Pilih Alat --</option>
                                        <option value="Mesin Uji Tarik">Mesin Uji Tarik</option>
                                        <option value="Mesin Uji Tekan">Mesin Uji Tekan</option>
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

                      <!-- Kapasitas / Resolusi - Mengikuti Form 1 -->
                        <tr>
                            <td style="vertical-align: middle;">
                                <p style="margin: 0; color: #000000; text-align: left; padding-left: 5px;">Kapasitas / Resolusi</p>
                            </td>
                            <td colspan="3" style="vertical-align: middle;">
                                <div class="d-flex align-items-center gap-3">
                                    @if($isFirstForm)
                                        <div style="width: 45%;">
                                            <input type="text" name="kapasitas" id="kapasitas_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan kapasitas">
                                        </div>
                                        <span style="color: #000000; font-size: 1.2em;">/</span>
                                        <div style="width: 45%;">
                                            <input type="text" name="resolusi" id="resolusi_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan Resolusi">
                                        </div>
                                    @else
                                        <div style="width: 45%;">
                                            <input type="text" name="kapasitas_display" id="kapasitas_{{ $formIndex }}" class="kalibrasi-input disabled-field" placeholder="Mengikuti Form 1" style="background-color: #e9ecef;" readonly disabled>
                                            <input type="hidden" name="kapasitas" id="kapasitas_hidden_{{ $formIndex }}" value="">
                                        </div>
                                        <span style="color: #000000; font-size: 1.2em;">/</span>
                                        <div style="width: 45%;">
                                            <input type="text" name="resolusi_display" id="resolusi_{{ $formIndex }}" class="kalibrasi-input disabled-field" placeholder="Mengikuti Form 1" style="background-color: #e9ecef;" readonly disabled>
                                            <input type="hidden" name="resolusi" id="resolusi_hidden_{{ $formIndex }}" value="">
                                        </div>
                                        <div class="info-copy" style="width: 100%; margin-top: 5px;">
                                            <i class="fas fa-copy"></i> Kapasitas dan Resolusi akan mengikuti isian Form 1
                                        </div>
                                    @endif
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

                    <!-- TABEL TEKAN -->
                    
                    <div class="responsive-table-container">
                        <table class="data-kalibrasi-table" style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                            <tr>
                                <td colspan="8" class="header" style="border: 1px solid #000; text-align: center; padding: 10px; font-weight: bold; background-color: #e0e0e0;">
                                    DATA KALIBRASI TEKAN
                                </td>
                            </tr>
                            <tr>
                                <td rowspan="1" class="header" style="border: 1px solid #000; text-align: center; padding: 8px; background-color: #f0f0f0; vertical-align: middle;">
                                    Titik Ukur
                                </td>
                                <td colspan="3" class="header" style="border: 1px solid #000; text-align: center; padding: 8px; background-color: #f0f0f0;">
                                    Pembacaan Tekan Standar<br>
                                    ( <input type="text" name="satuan_tekan_standar_{{ $formIndex }}" style="width:80px; text-align:center; margin-top:5px; border:1px solid #ccc;" value=""> )
                                </td>
                                <td colspan="3" class="header" style="border: 1px solid #000; text-align: center; padding: 8px; background-color: #f0f0f0;">
                                    Pembacaan Tekan UUT<br>
                                    ( <input type="text" name="satuan_tekan_uut_{{ $formIndex }}" style="width:80px; text-align:center; margin-top:5px; border:1px solid #ccc;" value=""> )
                                </td>
                            </tr>
                            <tr>
                                <td rowspan="2" style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #e8e8e8; vertical-align: middle;">
                                    ( <input type="text" name="satuan_titik_tekan_{{ $formIndex }}" style="width:80px; text-align:center; border:1px solid #ccc;" value=""> )
                                </td>
                                <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #e8e8e8;">0&deg;</td>
                                <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #e8e8e8;">120&deg;</td>
                                <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #e8e8e8;">240&deg;</td>
                                <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #e8e8e8;">0&deg;</td>
                                <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #e8e8e8;">120&deg;</td>
                                <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #e8e8e8;">240&deg;</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #f8f8f8; font-weight: bold;">1</td>
                                <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #f8f8f8; font-weight: bold;">2</td>
                                <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #f8f8f8; font-weight: bold;">3</td>
                                <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #f8f8f8; font-weight: bold;">1</td>
                                <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #f8f8f8; font-weight: bold;">2</td>
                                <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #f8f8f8; font-weight: bold;">3</td>
                            </tr>

                            @for($i = 1; $i <= 12; $i++)
                            <tr>
                                <td style="border: 1px solid #000; padding: 0;">
                                    <input type="text" name="titik_ukur_tekan_{{ $formIndex }}_{{ $i }}" 
                                           style="width:100%; border:none; padding:8px; text-align:center; background:transparent;">
                                </td>
                                <td style="border: 1px solid #000; padding: 0;">
                                    <input type="text" name="tekan_standar_{{ $formIndex }}_{{ $i }}_0_1" 
                                           style="width:100%; border:none; padding:8px; text-align:center; background:transparent;">
                                </td>
                                <td style="border: 1px solid #000; padding: 0;">
                                    <input type="text" name="tekan_standar_{{ $formIndex }}_{{ $i }}_120_2" 
                                           style="width:100%; border:none; padding:8px; text-align:center; background:transparent;">
                                </td>
                                <td style="border: 1px solid #000; padding: 0;">
                                    <input type="text" name="tekan_standar_{{ $formIndex }}_{{ $i }}_240_3" 
                                           style="width:100%; border:none; padding:8px; text-align:center; background:transparent;">
                                </td>
                                <td style="border: 1px solid #000; padding: 0;">
                                    <input type="text" name="tekan_uut_{{ $formIndex }}_{{ $i }}_0_1" 
                                           style="width:100%; border:none; padding:8px; text-align:center; background:transparent;">
                                </td>
                                <td style="border: 1px solid #000; padding: 0;">
                                    <input type="text" name="tekan_uut_{{ $formIndex }}_{{ $i }}_120_2" 
                                           style="width:100%; border:none; padding:8px; text-align:center; background:transparent;">
                                </td>
                                <td style="border: 1px solid #000; padding: 0;">
                                    <input type="text" name="tekan_uut_{{ $formIndex }}_{{ $i }}_240_3" 
                                           style="width:100%; border:none; padding:8px; text-align:center; background:transparent;">
                                </td>
                            </tr>
                            @endfor
                        </table>
                    </div>

                    <!-- TABEL TARIK -->
                  
                    <div class="responsive-table-container">
                        <table class="data-kalibrasi-table" style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                            <tr>
                                <td colspan="8" class="header" style="border: 1px solid #000; text-align: center; padding: 10px; font-weight: bold; background-color: #e0e0e0;">
                                    DATA KALIBRASI TARIK
                                </td>
                            </tr>
                            <tr>
                                <td rowspan="1" class="header" style="border: 1px solid #000; text-align: center; padding: 8px; background-color: #f0f0f0; vertical-align: middle;">
                                    Titik Ukur
                                </td>
                                <td colspan="3" class="header" style="border: 1px solid #000; text-align: center; padding: 8px; background-color: #f0f0f0;">
                                    Pembacaan Tarik Standar<br>
                                    ( <input type="text" name="satuan_tarik_standar_{{ $formIndex }}" style="width:80px; text-align:center; margin-top:5px; border:1px solid #ccc;" value=""> )
                                </td>
                                <td colspan="3" class="header" style="border: 1px solid #000; text-align: center; padding: 8px; background-color: #f0f0f0;">
                                    Pembacaan Tarik UUT<br>
                                    ( <input type="text" name="satuan_tarik_uut_{{ $formIndex }}" style="width:80px; text-align:center; margin-top:5px; border:1px solid #ccc;" value=""> )
                                </td>
                            </tr>
                            <tr>
                                <td rowspan="2" style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #e8e8e8; vertical-align: middle;">
                                    ( <input type="text" name="satuan_titik_tarik_{{ $formIndex }}" style="width:80px; text-align:center; border:1px solid #ccc;" value=""> )
                                </td>
                                <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #e8e8e8;">0&deg;</td>
                                <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #e8e8e8;">120&deg;</td>
                                <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #e8e8e8;">240&deg;</td>
                                <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #e8e8e8;">0&deg;</td>
                                <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #e8e8e8;">120&deg;</td>
                                <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #e8e8e8;">240&deg;</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #f8f8f8; font-weight: bold;">1</td>
                                <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #f8f8f8; font-weight: bold;">2</td>
                                <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #f8f8f8; font-weight: bold;">3</td>
                                <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #f8f8f8; font-weight: bold;">1</td>
                                <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #f8f8f8; font-weight: bold;">2</td>
                                <td style="border: 1px solid #000; padding: 8px; text-align: center; background-color: #f8f8f8; font-weight: bold;">3</td>
                            </tr>

                            @for($i = 1; $i <= 12; $i++)
                            <tr>
                                <td style="border: 1px solid #000; padding: 0;">
                                    <input type="text" name="titik_ukur_tarik_{{ $formIndex }}_{{ $i }}" 
                                           style="width:100%; border:none; padding:8px; text-align:center; background:transparent;">
                                </td>
                                <td style="border: 1px solid #000; padding: 0;">
                                    <input type="text" name="tarik_standar_{{ $formIndex }}_{{ $i }}_0_1" 
                                           style="width:100%; border:none; padding:8px; text-align:center; background:transparent;">
                                </td>
                                <td style="border: 1px solid #000; padding: 0;">
                                    <input type="text" name="tarik_standar_{{ $formIndex }}_{{ $i }}_120_2" 
                                           style="width:100%; border:none; padding:8px; text-align:center; background:transparent;">
                                </td>
                                <td style="border: 1px solid #000; padding: 0;">
                                    <input type="text" name="tarik_standar_{{ $formIndex }}_{{ $i }}_240_3" 
                                           style="width:100%; border:none; padding:8px; text-align:center; background:transparent;">
                                </td>
                                <td style="border: 1px solid #000; padding: 0;">
                                    <input type="text" name="tarik_uut_{{ $formIndex }}_{{ $i }}_0_1" 
                                           style="width:100%; border:none; padding:8px; text-align:center; background:transparent;">
                                </td>
                                <td style="border: 1px solid #000; padding: 0;">
                                    <input type="text" name="tarik_uut_{{ $formIndex }}_{{ $i }}_120_2" 
                                           style="width:100%; border:none; padding:8px; text-align:center; background:transparent;">
                                </td>
                                <td style="border: 1px solid #000; padding: 0;">
                                    <input type="text" name="tarik_uut_{{ $formIndex }}_{{ $i }}_240_3" 
                                           style="width:100%; border:none; padding:8px; text-align:center; background:transparent;">
                                </td>
                            </tr>
                            @endfor
                        </table>
                    </div>

                    <!-- Footer Section -->
                   <style>
/* Responsive Container untuk Tabel */
.responsive-table-container {
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    margin: 20px 0;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    border-radius: 8px;
    background: white;
    border: 1px solid #e0e0e0;
}

/* Tabel styling */
.data-kalibrasi-table {
    width: 100%;
    min-width: 800px;
    border-collapse: collapse;
    margin: 0 auto;
    background-color: #fff;
}

.data-kalibrasi-table td, 
.data-kalibrasi-table th {
    border: 1px solid #000;
    padding: 10px 8px;
    text-align: center;
    vertical-align: middle;
    font-size: 11pt;
    min-width: 70px;
}

.data-kalibrasi-table th {
    background-color: #d0d0d0;
    font-weight: bold;
    position: sticky;
    top: 0;
    z-index: 10;
}

.section-title {
    background-color: #a0a0a0;
    font-size: 1.2em;
    font-weight: bold;
    padding: 12px !important;
}

.sub-header {
    background-color: #e6e6e6;
    position: sticky;
    top: 0;
}

/* Input styling dalam tabel */
.table-input {
    width: 100%;
    min-width: 50px;
    padding: 6px 4px;
    border: 1px solid #aaa;
    border-radius: 3px;
    text-align: center;
    font-size: 10.5pt;
    background-color: white;
    box-sizing: border-box;
}

.table-input:focus {
    outline: none;
    border-color: #4a90e2;
    box-shadow: 0 0 0 2px rgba(74, 144, 226, 0.2);
}

/* Efek hover untuk baris */
.data-kalibrasi-table tr:hover {
    background-color: #f5f9ff;
}

/* Responsive Design untuk mobile */
@media (max-width: 768px) {
    .responsive-table-container {
        border-radius: 6px;
        margin: 15px -15px;
        width: calc(100% + 30px);
    }
    
    .data-kalibrasi-table {
        min-width: 700px;
        font-size: 10pt;
    }
    
    .data-kalibrasi-table td, 
    .data-kalibrasi-table th {
        padding: 8px 5px;
        font-size: 10pt;
    }
    
    .table-input {
        padding: 5px 3px;
        font-size: 10pt;
    }
    
    .section-title {
        font-size: 1.1em;
        padding: 10px !important;
    }
}

@media (max-width: 576px) {
    .responsive-table-container {
        border-radius: 4px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.1);
    }
    
    .data-kalibrasi-table {
        min-width: 650px;
    }
    
    .data-kalibrasi-table td, 
    .data-kalibrasi-table th {
        padding: 6px 4px;
        font-size: 9.5pt;
    }
    
    .table-input {
        padding: 4px 2px;
        font-size: 9.5pt;
    }
}

/* Scrollbar styling untuk container */
.responsive-table-container::-webkit-scrollbar {
    height: 8px;
}

.responsive-table-container::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
}

.responsive-table-container::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 4px;
}

.responsive-table-container::-webkit-scrollbar-thumb:hover {
    background: #555;
}

/* Footer Table Styling */
.footer-table {
    width: 100%;
    max-width: 1100px;
    margin: 20px auto;
    border-collapse: collapse;
    background-color: #fff;
    border: 1px solid #000;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.footer-table td {
    border: 1px solid #000;
    padding: 10px 12px;
    vertical-align: middle;
}

.footer-table .header-title {
    font-weight: bold;
    font-size: 18px;
    background-color: #f0f0f0;
    text-align: center;
    color: #000000;
}

.footer-table .label-cell {
    font-weight: bold;
    background-color: #e0e0e0;
    text-align: center;
    vertical-align: middle;
    color: #000000;
}

.footer-table .content-cell {
    background-color: #ffffff;
    text-align: left;
    vertical-align: middle;
}

.footer-table .content-center {
    background-color: #ffffff;
    text-align: center;
    vertical-align: middle;
}

.footer-table .td-sign {
    height: 100px;
    vertical-align: top;
    text-align: center;
    padding: 15px;
    background-color: #ffffff;
}

.footer-table .sign-area {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100%;
}

.footer-table .sign-label {
    font-weight: bold;
    font-size: 10pt;
    color: #000000;
}

.footer-table .sign-line {
    height: 60px;
    border-bottom: 1px solid #000;
    width: 80%;
    margin-top: 5px;
}

.footer-table .name-input {
    width: 100%;
    border: none;
    background: transparent;
    text-align: center;
    font-size: 10pt;
    color: #000000;
    padding: 4px 0;
}

.footer-table .name-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.footer-table .name-label {
    font-weight: bold;
    color: #000000;
    font-size: 10pt;
    white-space: nowrap;
}

.footer-table .name-border {
    border-bottom: 1px solid #000;
    padding: 4px 0;
    min-width: 120px;
    flex: 1;
}

.footer-table .checkbox-item {
    display: flex;
    align-items: center;
    cursor: pointer;
    padding: 4px 0;
    font-size: 10.5pt;
    color: #000000;
}

.footer-table .checkbox-item input[type="checkbox"] {
    margin-right: 12px;
    width: 17px;
    height: 17px;
    cursor: pointer;
    flex-shrink: 0;
}

.footer-table .checkbox-container {
    display: flex;
    flex-direction: column;
    gap: 8px;
    padding: 0 10px;
}

/* Styling untuk metode kalibrasi */
.footer-table .method-label {
    font-weight: bold;
    background-color: #e0e0e0;
    text-align: center;
    vertical-align: middle;
    color: #000000;
    font-size: 11pt;
    padding: 10px 12px;
    width: 12%;
}

.footer-table .method-value {
    border: 1px solid #000;
    padding: 10px 15px;
    text-align: center;
    vertical-align: middle;
    font-size: 11pt;
    color: #000000;
    background-color: #ffffff;
}
</style>

<!-- Footer Section -->
<table class="footer-table">
    <!-- Judul Instruksi -->
    <tr>
        <td colspan="12" class="header-title">
            Isilah lembar data kalibrasi dengan lengkap dan jelas!
        </td>
    </tr>

    <!-- Alat Standar - Header Row -->
    <tr>
        <td rowspan="2" class="label-cell" style="width: 12%; font-size: 12pt;">
            Alat Standar
        </td>
        <td rowspan="2" colspan="4" class="content-cell" style="padding: 12px 15px;">
            <div class="checkbox-container">
                <label class="checkbox-item">
                    <input type="checkbox" name="alat_standar_{{ $formIndex }}[]" value="Loadcell, 1Ton, ST2-C3-It ; JIE115587">
                    <span>Loadcell, 1Ton, ST2-C3-It ; JIE115587</span>
                </label>
                <label class="checkbox-item">
                    <input type="checkbox" name="alat_standar_{{ $formIndex }}[]" value="Loadcell, 250Kg, STI-C3-250; J025B58363">
                    <span>Loadcell, 250Kg, STI-C3-250; J025B58363</span>
                </label>
            </div>
        </td>
        <td colspan="3" class="label-cell" style="font-size: 11pt;">
            Dikalibrasi oleh
        </td>
        <td colspan="3" class="label-cell" style="font-size: 11pt;">
            Diperiksa oleh
        </td>
    </tr>

    <!-- TTD Row -->
    <tr>
        <td colspan="3" class="td-sign">
            <div class="sign-area">
                <span class="sign-label">TTD :</span>
                <div class="sign-line"></div>
            </div>
        </td>
        <td colspan="3" class="td-sign">
            <div class="sign-area">
                <span class="sign-label">TTD :</span>
                <div class="sign-line"></div>
            </div>
        </td>
    </tr>

    <!-- Metode Kalibrasi + Nama Row -->
    <tr>
        <!-- Metode Kalibrasi - sekarang rowspan tidak digunakan, langsung di baris ini -->
        <td class="method-label" style="width: 12%;">
            Metode<br>Kalibrasi
        </td>
        <td colspan="4" class="method-value">
            PAS-IK1102-54
        </td>
        <td colspan="3" class="content-center">
            <div class="name-wrapper">
                <span class="name-label">Nama:</span>
                <div class="name-border">
                    <input type="text" name="calibrated_by_{{ $formIndex }}" 
                           class="name-input" 
                           value="{{ auth()->user()->nama ?? 'System' }}" readonly>
                </div>
            </div>
        </td>
        <td colspan="3" class="content-center">
            <div class="name-wrapper">
                <span class="name-label">Nama:</span>
                <div class="name-border">
                    <input type="text" name="verified_by_{{ $formIndex }}" 
                           id="verified_by_{{ $formIndex }}" 
                           class="name-input" 
                           placeholder="-" {{ $isFirstForm ? 'readonly' : '' }}>
                </div>
            </div>
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
                </div>
            </form>
        </div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
    var currentActiveTabId = '1';

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
        return currentActiveTabId;
    }

    function updateActiveTab(tabId) {
        currentActiveTabId = tabId;
        console.log('🔄 Global active tab updated to:', tabId);
    }

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
        sessionStorage.setItem('current_jumlah_form_utm', count.toString());
        console.log('💾 Saved jumlah_form to sessionStorage:', count);
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
    // Untuk display field (disabled)
    let displayElement = form.querySelector(`[name="${fieldName}_display"]`);
    if (displayElement) {
        displayElement.value = value;
    }
    // Untuk radio button
    let radioElement = form.querySelector(`[name="${fieldName}"][value="${value}"]`);
    if (radioElement && radioElement.type === 'radio') {
        radioElement.checked = true;
    }
}

    function syncAllFormsData() {
        const formCount = getFormCount();
        if (formCount <= 1) return;
        
        const form1 = document.getElementById('kalibrasiForm1');
        if (!form1) return;
        
        const fieldsToSync = [
            'nama_alat', 'merek', 'kode_alat', 'type_alat', 'no_seri',
                'kapasitas', 'resolusi', 
            'nama_pemilik', 'tanggal_alat_masuk', 'tanggal_kalibrasi',
            'tempat_kalibrasi', 'lokasi_pt', 'kode_th', 'fungsi_komponen',
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

    function disableRequiredOnHiddenForms() {
        const formCount = getFormCount();
        for (let i = 1; i <= formCount; i++) {
            const form = document.getElementById(`kalibrasiForm${i}`);
            if (!form) continue;
            const container = form.closest('.w-100');
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

    window.handleSaveSuccess = function(tabId, data) {
        console.log('🎉 handleSaveSuccess called for tab:', tabId, data);
        const container = document.querySelector(`[data-lk-id="${tabId}"]`);
        if (!container) {
            console.error(`Container for tab ${tabId} not found!`);
            return;
        }

        const formName = 'Mesin Uji Tarik/Tekan';
        const calibrationId = data.calibration_id || data.id || '-';
        const printLabelUrl = data.print_label_url || `/calibrations/${calibrationId}/print-label`;
        
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
                    <button type="button" class="btn btn-primary btn-lg px-4 py-2" onclick="window.open('${printLabelUrl}', '_blank')">
                        <i class="fas fa-print me-2"></i> Cetak Label
                    </button>
                    <button type="button" class="btn btn-success btn-lg px-4 py-2" onclick="resetTabForNewScan()">
                        <i class="fas fa-plus-circle me-2"></i> Input Lagi
                    </button>
                </div>
                <div class="mt-3 text-muted small">
                    <i class="fas fa-info-circle me-1"></i> Data tersimpan sebagai Draft.
                </div>
            </div>
        `;
    };

    window.resetTabForNewScan = function() {
        if (confirm('Data yang belum disimpan akan hilang. Lanjutkan?')) {
            location.reload();
        }
    };

    function escapeHtml(text) {
        if (!text) return '';
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    async function submitSemuaForm() {
        const activeTabId = getActiveTabId();
        console.log('📌 Submitting from active tab:', activeTabId);
        
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
        console.log('📊 Submit - formCount from DOM:', formCount);
        
        if (forms.length === 0) {
            alert('Tidak ada form yang ditemukan!');
            return;
        }
        
        disableRequiredOnHiddenForms();
        updateAllJumlahFormValues(formCount);
        syncAllFormsData();
        
        let activeFormValid = true;
        for (let i = 0; i < forms.length; i++) {
            const container = forms[i].closest('.w-100');
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
            let csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            if (!csrfToken && forms[0]) {
                const csrfInput = forms[0].querySelector('input[name="_token"]');
                if (csrfInput) csrfToken = csrfInput.value;
            }
            if (!csrfToken) {
                throw new Error('CSRF token tidak ditemukan. Refresh halaman!');
            }
            
            combinedFormData.append('_token', csrfToken);
            combinedFormData.append('jumlah_form', formCount.toString());
            combinedFormData.append('submit_all', 'true');
            combinedFormData.append('form_type', 'utm');
            
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
                combinedFormData.append(`form_${formIndex}_form_type`, 'utm');
                combinedFormData.append(`form_${formIndex}_jumlah_form`, formCount);
                combinedFormData.append(`form_${formIndex}_capacity`, form.querySelector('input[name="capacity"]')?.value || '0');
            }
            
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

    // DOM Content Loaded
    document.addEventListener('DOMContentLoaded', function() {
        console.log('🚀 DOM Content Loaded - UTM Multiple Form');
        
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
        
        console.log('✅ UTM Multiple Form initialization complete!');
    });
    </script>
</body>
</html>