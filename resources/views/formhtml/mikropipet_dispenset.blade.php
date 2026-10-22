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
        input::invalid {
            border-color: #dc3545 !important;
        }

        input::valid {
            border-color: #198754 !important;
        }
    </style>
</head>
<body>
    @php 
        $count = isset($count) ? (int)$count : 1; 
        $count = max(1, min(4, $count)); 
    @endphp

    @for($formIndex = 1; $formIndex <= $count; $formIndex++)
        @php
            $isFirstForm = ($formIndex == 1);
        @endphp

        @if($count > 1)
        <div style="background: linear-gradient(135deg,#1e40af,#3b82f6); color:#fff; padding:10px 20px; margin: 16px 0 0; border-radius:8px 8px 0 0; font-weight:bold; font-size:16px;">
            <i class="fas fa-file-alt" style="margin-right:8px;"></i>Form Mikropipet Dispenset ke-{{ $formIndex }}
            @if(!$isFirstForm)
            <span style="font-size:12px; margin-left:10px;">
                <i class="fas fa-info-circle"></i> Field informasi alat mengikuti Form 1 (kecuali Keterangan)
            </span>
            @endif
        </div>
        @endif

        <div class="container my-4" style="@if($count > 1) border:2px solid #3b82f6; border-radius:0 0 8px 8px; padding-bottom:24px; @endif">
            <form method="POST" action="/calibrations" id="kalibrasiForm{{ $formIndex }}" data-form-index="{{ $formIndex }}">
                @csrf
                <input type="hidden" name="form_type" value="mikropipet_dispenset">
                <input type="hidden" name="capacity" value="{{ $capacity ?? '' }}">
                <input type="hidden" name="jumlah_form" value="{{ $count }}">
                <input type="hidden" name="form_index" value="{{ $formIndex }}">
                <input type="hidden" name="no_label" id="no_label_hidden{{ $formIndex }}" value="">

                @if(!$isFirstForm)
                    <!-- Hidden fields untuk data yang mengikuti form 1 (KECUALI KETERANGAN) -->
                    <input type="hidden" name="nama_alat" id="nama_alat_hidden_{{ $formIndex }}" value="">
                    <input type="hidden" name="merek" id="merek_hidden_{{ $formIndex }}" value="">
                    <input type="hidden" name="kode_alat" id="kode_alat_hidden_{{ $formIndex }}" value="">
                    <input type="hidden" name="type_alat" id="type_alat_hidden_{{ $formIndex }}" value="">
                    <input type="hidden" name="no_seri" id="no_seri_hidden_{{ $formIndex }}" value="">
                    <input type="hidden" name="rentang_ukur_min" id="rentang_ukur_min_hidden_{{ $formIndex }}" value="0">
                    <input type="hidden" name="rentang_ukur_max" id="rentang_ukur_max_hidden_{{ $formIndex }}" value="">
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
                    <!-- KETERANGAN TIDAK DI HIDDEN - biarkan user mengisi sendiri -->
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
                                <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK39</p>
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
                                <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">MIKROPIPET DISPENSET</p>
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
                                    <select name="nama_alat" id="nama_alat_select_{{ $formIndex }}" class="kalibrasi-input" onchange="updateFormType(this.value, {{ $formIndex }})" style="background-color: #f5f5f5; color: #333; border: 1px solid #ced4da; padding: 6px 10px; border-radius: 4px; width: 100%;">
                                        <option value="">-- Pilih Alat --</option>
                                        <option value="Mikropipet">Mikropipet</option>
                                        <option value="Dispenset">Dispenset</option>
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
                            </td>
                        </tr>
                        
                        <!-- Merek & Kode Alat -->
                        <tr>
                            <td style="vertical-align: middle;">
                                <p style="margin: 0; color: #000000; text-align: left; padding-left: 5px;">Merek</p>
                            </td>
                            <td colspan="3" style="vertical-align: middle;">
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
                            <td style="vertical-align: middle;">
                                <p style="margin: 0; color: #000000; text-align: left; padding-left: 5px;">Type / No. Seri</p>
                            </td>
                            <td colspan="3" style="vertical-align: middle;">
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

                        <!-- Kapasitas / Resolusi -->
                        <tr>
                            <td style="vertical-align: middle;">
                                <p style="margin: 0; color: #000000; text-align: left; padding-left: 5px;">Kapasitas / Resolusi</p>
                            </td>
                            <td colspan="3" style="vertical-align: middle;">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center" style="width: 48%;">
                                        @if($isFirstForm)
                                            <input type="text" name="kapasitas" id="kapasitas_{{ $formIndex }}" class="kalibrasi-input" style="border-top-right-radius: 0; border-bottom-right-radius: 0; border-right: none; width: calc(100% - 40px);" placeholder="Masukkan kapasitas">
                                        @else
                                            <input type="text" name="kapasitas_display" id="kapasitas_{{ $formIndex }}" class="kalibrasi-input disabled-field" style="border-top-right-radius: 0; border-bottom-right-radius: 0; border-right: none; width: calc(100% - 40px); background-color: #e9ecef;" readonly disabled placeholder="Mengikuti Form 1">
                                        @endif
                                    </div>

                                    <div class="mx-2" style="color: #000000; font-size: 16px; font-weight: normal;">/</div>

                                    <div class="d-flex align-items-center" style="width: 48%;">
                                        @if($isFirstForm)
                                            <input type="text" name="resolusi" id="resolusi_{{ $formIndex }}" step="any" class="kalibrasi-input" style="border-top-right-radius: 0; border-bottom-right-radius: 0; border-right: none; width: calc(100% - 40px);" placeholder="Masukkan resolusi" required>
                                        @else
                                            <input type="text" name="resolusi_display" id="resolusi_{{ $formIndex }}" class="kalibrasi-input disabled-field" style="border-top-right-radius: 0; border-bottom-right-radius: 0; border-right: none; width: calc(100% - 40px); background-color: #e9ecef;" readonly disabled placeholder="Mengikuti Form 1">
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <!-- Nama Pemilik -->
                        <tr>
                            <td style="vertical-align: middle;">
                                <p style="margin: 0; color: #000000; text-align: left; padding-left: 5px;">Nama Pemilik</p>
                            </td>
                            <td colspan="3" style="vertical-align: middle;">
                                @if($isFirstForm)
                                    <input type="text" name="nama_pemilik" id="nama_pemilik_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan nama pemilik / instansi" required>
                                @else
                                    <input type="text" name="nama_pemilik_display" id="nama_pemilik_{{ $formIndex }}" class="kalibrasi-input disabled-field" placeholder="Mengikuti Form 1" style="background-color: #e9ecef;" readonly disabled>
                                @endif
                            </td>
                        </tr>

                        <!-- Tanggal Alat Masuk -->
                        <tr>
                            <td style="vertical-align: middle;">
                                <p style="margin: 0; color: #000000; text-align: left; padding-left: 5px;">Tanggal Alat Masuk</p>
                            </td>
                            <td colspan="3" style="vertical-align: middle;">
                                @if($isFirstForm)
                                    <input type="date" name="tanggal_alat_masuk" id="tanggal_alat_masuk_{{ $formIndex }}" class="kalibrasi-input" value="{{ date('Y-m-d') }}" required>
                                @else
                                    <input type="date" name="tanggal_alat_masuk_display" id="tanggal_alat_masuk_{{ $formIndex }}" class="kalibrasi-input disabled-field" style="background-color: #e9ecef;" readonly disabled>
                                @endif
                            </td>
                        </tr>
                        
                        <!-- Tanggal Kalibrasi -->
                        <tr>
                            <td style="vertical-align: middle;">
                                <p style="margin: 0; color: #000000; text-align: left; padding-left: 5px;">Tanggal Kalibrasi</p>
                            </td>
                            <td colspan="3" style="vertical-align: middle;">
                                <div class="d-flex align-items-center">
                                    @if($isFirstForm)
                                        <input type="date" name="tanggal_kalibrasi" id="tanggal_kalibrasi_{{ $formIndex }}" class="kalibrasi-input me-3" style="width: 45%;" value="{{ date('Y-m-d') }}" required>
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
                            <td style="vertical-align: middle;">
                                <p style="margin: 0; color: #000000; text-align: left; padding-left: 5px;">Tempat Kalibrasi</p>
                            </td>
                            <td colspan="3" style="vertical-align: middle;">
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
                        
                        <!-- Lokasi PT -->
                        <tr>
                            <td style="vertical-align: middle;">
                                <p style="margin: 0; color: #000000; text-align: left; padding-left: 5px;">Lokasi PT</p>
                            </td>
                            <td colspan="3" style="vertical-align: middle;">
                                @if($isFirstForm)
                                    <input type="text" name="lokasi_pt" id="lokasi_pt_{{ $formIndex }}" class="kalibrasi-input" placeholder="Masukkan Lokasi PT">
                                @else
                                    <input type="text" name="lokasi_pt_display" id="lokasi_pt_{{ $formIndex }}" class="kalibrasi-input disabled-field" placeholder="Mengikuti Form 1" style="background-color: #e9ecef;" readonly disabled>
                                @endif
                            </td>
                        </tr>
                        
                        <tr>
                            <td style="vertical-align: middle;">
                                <p style="margin: 0; color: #000000; text-align: left; padding-left: 5px;">Kode TH</p>
                            </td>
                            <td colspan="3" style="vertical-align: middle;">
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
                                    <!-- 🔥 PERUBAHAN UTAMA: KETERANGAN DAPAT DIISI UNTUK SEMUA FORM -->
                                    <input type="text" name="keterangan_fungsi_komponen" id="keterangan_{{ $formIndex }}" 
                                           class="kalibrasi-input" placeholder="Masukkan Keterangan" 
                                           style="border: none; background-color: #ffffff;">
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

                    <!-- Data Kalibrasi Table -->
                    <table cellspacing="0" cellpadding="0" class="TableNormal" style="margin-left:3.12pt; width:100%; -aw-border:0.75pt single #000000; -aw-border-insideh:0.75pt single #000000; -aw-border-insidev:0.75pt single #000000; border-collapse:collapse">
                        <!-- ==================== BAGIAN ATAS ==================== -->
                        <tr style="height:12pt">
                            <td colspan="11" style="border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9; -aw-border:0.75pt single #000000">
                                <p class="TableParagraph" style="margin-right:0.05pt; margin-left:1.15pt; text-align:center; line-height:10pt">
                                    <span style="font-family:Arial; font-size:10pt; font-weight:bold">DATA KALIBRASI</span>
                                </p>
                            </td>
                        </tr>
                        
                        <!-- HEADER ATAS -->
                        <tr style="height:15pt">
                            <td rowspan="2" style="width:15%; border-style:solid; border-width:0.75pt; vertical-align:middle; background-color:#d9d9d9; text-align:center">
                                <div style="width:100%; text-align:center">
                                    <span style="font-family:Arial; font-size:8pt; font-weight:bold">Nominal Alat Ukur</span><br>
                                    <p style="margin:0; font-size:6pt;">
                                        <span style="font-family:'Verdana';">(
                                            <input type="text" name="satuan_alat_ukur_kiri_{{ $formIndex }}" 
                                                   id="satuan_alat_ukur_kiri_{{ $formIndex }}"
                                                   style="width:60px; border:none; border-bottom:1px dotted #000; 
                                                          font-family:'Verdana'; font-size:6pt; text-align:center; background:transparent;">
                                            )
                                        </span>
                                    </p>
                                </div>
                            </td>
                            <td colspan="4" style="width:25%; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:5pt; margin-left:13.55pt; font-size:8pt">
                                    <span style="font-family:Arial; font-weight:bold">Pembacaan Timbangan (g)</span>
                                </p>
                            </td>
                            <td rowspan="40" style="width:3%; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; vertical-align:top">
                                <p class="TableParagraph" style="font-size:8pt">
                                    <span style="font-family:'Times New Roman';">&#xa0;</span>
                                </p>
                            </td>
                            <td rowspan="2" style="width:15%; border-style:solid; border-width:0.75pt; vertical-align:middle; background-color:#d9d9d9; text-align:center">
                                <div style="width:100%; text-align:center">
                                    <span style="font-family:Arial; font-size:8pt; font-weight:bold">Nominal Alat Ukur</span><br>
                                    <p style="margin:0; font-size:6pt;">
                                        <span style="font-family:'Verdana';">(
                                            <input type="text" name="satuan_alat_ukur_kanan_{{ $formIndex }}" 
                                                   id="satuan_alat_ukur_kanan_{{ $formIndex }}"
                                                   style="width:60px; border:none; border-bottom:1px dotted #000; 
                                                          font-family:'Verdana'; font-size:6pt; text-align:center; background:transparent;">
                                            )
                                        </span>
                                    </p>
                                </div>
                            </td>
                            <td colspan="4" style="width:25%; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:5pt; margin-left:13.5pt; font-size:8pt">
                                    <span style="font-family:Arial; font-weight:bold">Pembacaan Timbangan (g)</span>
                                </p>
                            </td>
                        </tr>
                        
                        <!-- SUB HEADER ATAS -->
                        <tr style="height:12pt">
                            <td style="width:6%; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                                    <span style="font-family:Arial; font-weight:bold">m</span>
                                </p>
                            </td>
                            <td colspan="3" style="width:19%; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                                    <span style="font-family:Arial; font-weight:bold">Nilai</span>
                                </p>
                            </td>
                            <td style="width:6%; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                                    <span style="font-family:Arial; font-weight:bold">m</span>
                                </p>
                            </td>
                            <td colspan="3" style="width:19%; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                                    <span style="font-family:Arial; font-weight:bold">Nilai</span>
                                </p>
                            </td>
                        </tr>
                        
                        <!-- BARIS DATA m0 - m11 (ATAS) -->
                        <!-- Baris m0 (dengan rowspan untuk Nominal) -->
                        <tr style="height:12pt">
                            <td rowspan="12" style="width:15%; border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="nominal_kiri_{{ $formIndex }}" id="nominal_kiri_{{ $formIndex }}" 
                                       style="width:90%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none" 
                                       placeholder="Nominal">
                            </td>
                            <td style="width:6%; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">m<sub>0</sub></p>
                            </td>
                            <td colspan="3" style="width:19%; border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="m0_kiri_{{ $formIndex }}" id="m0_kiri_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                            <td rowspan="12" style="width:15%; border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="nominal_kanan_{{ $formIndex }}" id="nominal_kanan_{{ $formIndex }}"
                                       style="width:90%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none" 
                                       placeholder="Nominal">
                            </td>
                            <td style="width:6%; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">m<sub>0</sub></p>
                            </td>
                            <td colspan="3" style="width:19%; border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="m0_kanan_{{ $formIndex }}" id="m0_kanan_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                        </tr>
                        
                        <!-- Baris m1 sampai m11 -->
                        <?php for($i = 1; $i <= 11; $i++): ?>
                        <tr style="height:12pt">
                            <td style="width:6%; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">m<sub><?php echo $i; ?></sub></p>
                            </td>
                            <td colspan="3" style="width:19%; border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="m<?php echo $i; ?>_kiri_{{ $formIndex }}" id="m<?php echo $i; ?>_kiri_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                            <td style="width:6%; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">m<sub><?php echo $i; ?></sub></p>
                            </td>
                            <td colspan="3" style="width:19%; border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="m<?php echo $i; ?>_kanan_{{ $formIndex }}" id="m<?php echo $i; ?>_kanan_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                        </tr>
                        <?php endfor; ?>
                        
                        <!-- PARAMETER PENDUKUNG ATAS -->
                        <tr style="height:12pt">
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                                    <span style="font-family:Arial; font-weight:bold">Parameter Pendukung</span>
                                </p>
                            </td>
                            <td style="border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                                    <span style="font-family:Arial; font-weight:bold">Awal</span>
                                </p>
                            </td>
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                                    <span style="font-family:Arial; font-weight:bold">Akhir</span>
                                </p>
                            </td>
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                                    <span style="font-family:Arial; font-weight:bold">Parameter Pendukung</span>
                                </p>
                            </td>
                            <td style="border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                                    <span style="font-family:Arial; font-weight:bold">Awal</span>
                                </p>
                            </td>
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                                    <span style="font-family:Arial; font-weight:bold">Akhir</span>
                                </p>
                            </td>
                        </tr>
                        
                        <!-- Suhu Udara ATAS -->
                        <tr style="height:12pt">
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">Suhu Udara (°C)</p>
                            </td>
                            <td style="border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="suhu_awal_kiri_{{ $formIndex }}" id="suhu_awal_kiri_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="suhu_akhir_kiri_{{ $formIndex }}" id="suhu_akhir_kiri_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">Suhu Udara (°C)</p>
                            </td>
                            <td style="border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="suhu_awal_kanan_{{ $formIndex }}" id="suhu_awal_kanan_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="suhu_akhir_kanan_{{ $formIndex }}" id="suhu_akhir_kanan_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                        </tr>
                        
                        <!-- Kelembaban Udara ATAS -->
                        <tr style="height:12pt">
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">Kelembaban Udara (%rh)</p>
                            </td>
                            <td style="border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="kelembaban_awal_kiri_{{ $formIndex }}" id="kelembaban_awal_kiri_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="kelembaban_akhir_kiri_{{ $formIndex }}" id="kelembaban_akhir_kiri_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">Kelembaban Udara (%rh)</p>
                            </td>
                            <td style="border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="kelembaban_awal_kanan_{{ $formIndex }}" id="kelembaban_awal_kanan_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="kelembaban_akhir_kanan_{{ $formIndex }}" id="kelembaban_akhir_kanan_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                        </tr>
                        
                        <!-- Tekanan Udara ATAS -->
                        <tr style="height:12pt">
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">Tekanan Udara (hPa)</p>
                            </td>
                            <td style="border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="tekanan_awal_kiri_{{ $formIndex }}" id="tekanan_awal_kiri_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="tekanan_akhir_kiri_{{ $formIndex }}" id="tekanan_akhir_kiri_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">Tekanan Udara (hPa)</p>
                            </td>
                            <td style="border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="tekanan_awal_kanan_{{ $formIndex }}" id="tekanan_awal_kanan_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="tekanan_akhir_kanan_{{ $formIndex }}" id="tekanan_akhir_kanan_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                        </tr>
                        
                        <!-- Suhu Air ATAS -->
                        <tr style="height:12pt">
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">Suhu Air (°C)</p>
                            </td>
                            <td style="border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="suhu_air_awal_kiri_{{ $formIndex }}" id="suhu_air_awal_kiri_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="suhu_air_akhir_kiri_{{ $formIndex }}" id="suhu_air_akhir_kiri_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">Suhu Air (°C)</p>
                            </td>
                            <td style="border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="suhu_air_awal_kanan_{{ $formIndex }}" id="suhu_air_awal_kanan_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="suhu_air_akhir_kanan_{{ $formIndex }}" id="suhu_air_akhir_kanan_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                        </tr>
                        
                        <!-- Waktu ATAS -->
                        <tr style="height:12pt">
                            <td colspan="2" style="border-style:solid solid double; border-width:0.75pt 0.75pt 2.25pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">Waktu (detik)</p>
                            </td>
                            <td colspan="3" style="border-style:solid solid double; border-width:0.75pt 0.75pt 2.25pt; vertical-align:middle; text-align:center">
                                <input type="text" name="waktu_kiri_{{ $formIndex }}" id="waktu_kiri_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                            <td colspan="2" style="border-style:solid solid double; border-width:0.75pt 0.75pt 2.25pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">Waktu (detik)</p>
                            </td>
                            <td colspan="3" style="border-style:solid solid double; border-width:0.75pt 0.75pt 2.25pt; vertical-align:middle; text-align:center">
                                <input type="text" name="waktu_kanan_{{ $formIndex }}" id="waktu_kanan_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                        </tr>
                        
                        <!-- SPACER -->
                        <tr><td colspan="11" style="padding:5px;"><p style="margin-top:0.35pt; font-size:9pt">&nbsp;</p></td></tr>
                        
                        <!-- ==================== BAGIAN BAWAH ==================== -->
                        <!-- HEADER BAWAH -->
                        <tr style="height:15pt">
                            <td rowspan="2" style="width:15%; border-style:double solid solid; border-width:2.25pt 0.75pt 0.75pt; vertical-align:middle; background-color:#d9d9d9; text-align:center">
                                <div style="width:100%; text-align:center">
                                    <span style="font-family:Arial; font-size:8pt; font-weight:bold">Nominal Alat Ukur</span><br>
                                    <p style="margin:0; font-size:6pt;">
                                        <span style="font-family:'Verdana';">(
                                            <input type="text" name="satuan_alat_ukur_bawah_kiri_{{ $formIndex }}" 
                                                   id="satuan_alat_ukur_bawah_kiri_{{ $formIndex }}"
                                                   style="width:60px; border:none; border-bottom:1px dotted #000; 
                                                          font-family:'Verdana'; font-size:6pt; text-align:center; background:transparent;">
                                            )
                                        </span>
                                    </p>
                                </div>
                            </td>
                            <td colspan="4" style="width:25%; border-style:double solid solid; border-width:2.25pt 0.75pt 0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:5pt; margin-left:13.55pt; font-size:8pt">
                                    <span style="font-family:Arial; font-weight:bold">Pembacaan Timbangan (g)</span>
                                </p>
                            </td>
                            <td rowspan="2" style="width:15%; border-style:double solid solid; border-width:2.25pt 0.75pt 0.75pt; vertical-align:middle; background-color:#d9d9d9; text-align:center">
                                <div style="width:100%; text-align:center">
                                    <span style="font-family:Arial; font-size:8pt; font-weight:bold">Nominal Alat Ukur</span><br>
                                    <p style="margin:0; font-size:6pt;">
                                        <span style="font-family:'Verdana';">(
                                            <input type="text" name="satuan_alat_ukur_bawah_kanan_{{ $formIndex }}" 
                                                   id="satuan_alat_ukur_bawah_kanan_{{ $formIndex }}"
                                                   style="width:60px; border:none; border-bottom:1px dotted #000; 
                                                          font-family:'Verdana'; font-size:6pt; text-align:center; background:transparent;">
                                            )
                                        </span>
                                    </p>
                                </div>
                            </td>
                            <td colspan="4" style="width:25%; border-style:double solid solid; border-width:2.25pt 0.75pt 0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:5pt; margin-left:13.5pt; font-size:8pt">
                                    <span style="font-family:Arial; font-weight:bold">Pembacaan Timbangan (g)</span>
                                </p>
                            </td>
                        </tr>
                        
                        <!-- SUB HEADER BAWAH -->
                        <tr style="height:12pt">
                            <td style="width:6%; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                                    <span style="font-family:Arial; font-weight:bold">m</span>
                                </p>
                            </td>
                            <td colspan="3" style="width:19%; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                                    <span style="font-family:Arial; font-weight:bold">Nilai</span>
                                </p>
                            </td>
                            <td style="width:6%; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                                    <span style="font-family:Arial; font-weight:bold">m</span>
                                </p>
                            </td>
                            <td colspan="3" style="width:19%; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                                    <span style="font-family:Arial; font-weight:bold">Nilai</span>
                                </p>
                            </td>
                        </tr>
                        
                        <!-- BARIS DATA m0 - m11 (BAWAH) -->
                        <!-- Baris m0 -->
                        <tr style="height:12pt">
                            <td rowspan="12" style="width:15%; border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="nominal_kiri_bawah_{{ $formIndex }}" id="nominal_kiri_bawah_{{ $formIndex }}" 
                                       style="width:90%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none" 
                                       placeholder="Nominal">
                            </td>
                            <td style="width:6%; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">m<sub>0</sub></p>
                            </td>
                            <td colspan="3" style="width:19%; border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="m0_kiri_bawah_{{ $formIndex }}" id="m0_kiri_bawah_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                            <td rowspan="12" style="width:15%; border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="nominal_kanan_bawah_{{ $formIndex }}" id="nominal_kanan_bawah_{{ $formIndex }}"
                                       style="width:90%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none" 
                                       placeholder="Nominal">
                            </td>
                            <td style="width:6%; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">m<sub>0</sub></p>
                            </td>
                            <td colspan="3" style="width:19%; border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="m0_kanan_bawah_{{ $formIndex }}" id="m0_kanan_bawah_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                        </tr>
                        
                        <!-- Baris m1 sampai m11 BAWAH -->
                        <?php for($i = 1; $i <= 11; $i++): ?>
                        <tr style="height:12pt">
                            <td style="width:6%; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">m<sub><?php echo $i; ?></sub></p>
                            </td>
                            <td colspan="3" style="width:19%; border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="m<?php echo $i; ?>_kiri_bawah_{{ $formIndex }}" id="m<?php echo $i; ?>_kiri_bawah_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                            <td style="width:6%; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">m<sub><?php echo $i; ?></sub></p>
                            </td>
                            <td colspan="3" style="width:19%; border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="m<?php echo $i; ?>_kanan_bawah_{{ $formIndex }}" id="m<?php echo $i; ?>_kanan_bawah_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                        </tr>
                        <?php endfor; ?>
                        
                        <!-- PARAMETER PENDUKUNG BAWAH -->
                        <tr style="height:12pt">
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                                    <span style="font-family:Arial; font-weight:bold">Parameter Pendukung</span>
                                </p>
                            </td>
                            <td style="border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                                    <span style="font-family:Arial; font-weight:bold">Awal</span>
                                </p>
                            </td>
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                                    <span style="font-family:Arial; font-weight:bold">Akhir</span>
                                </p>
                            </td>
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                                    <span style="font-family:Arial; font-weight:bold">Parameter Pendukung</span>
                                </p>
                            </td>
                            <td style="border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                                    <span style="font-family:Arial; font-weight:bold">Awal</span>
                                </p>
                            </td>
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                                    <span style="font-family:Arial; font-weight:bold">Akhir</span>
                                </p>
                            </td>
                        </tr>
                        
                        <!-- Suhu Udara BAWAH -->
                        <tr style="height:12pt">
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">Suhu Udara (°C)</p>
                            </td>
                            <td style="border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="suhu_awal_kiri_bawah_{{ $formIndex }}" id="suhu_awal_kiri_bawah_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="suhu_akhir_kiri_bawah_{{ $formIndex }}" id="suhu_akhir_kiri_bawah_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">Suhu Udara (°C)</p>
                            </td>
                            <td style="border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="suhu_awal_kanan_bawah_{{ $formIndex }}" id="suhu_awal_kanan_bawah_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="suhu_akhir_kanan_bawah_{{ $formIndex }}" id="suhu_akhir_kanan_bawah_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                        </tr>
                        
                        <!-- Kelembaban Udara BAWAH -->
                        <tr style="height:12pt">
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">Kelembaban Udara (%rh)</p>
                            </td>
                            <td style="border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="kelembaban_awal_kiri_bawah_{{ $formIndex }}" id="kelembaban_awal_kiri_bawah_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="kelembaban_akhir_kiri_bawah_{{ $formIndex }}" id="kelembaban_akhir_kiri_bawah_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">Kelembaban Udara (%rh)</p>
                            </td>
                            <td style="border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="kelembaban_awal_kanan_bawah_{{ $formIndex }}" id="kelembaban_awal_kanan_bawah_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="kelembaban_akhir_kanan_bawah_{{ $formIndex }}" id="kelembaban_akhir_kanan_bawah_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                        </tr>
                        
                        <!-- Tekanan Udara BAWAH -->
                        <tr style="height:12pt">
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">Tekanan Udara (hPa)</p>
                            </td>
                            <td style="border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="tekanan_awal_kiri_bawah_{{ $formIndex }}" id="tekanan_awal_kiri_bawah_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="tekanan_akhir_kiri_bawah_{{ $formIndex }}" id="tekanan_akhir_kiri_bawah_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">Tekanan Udara (hPa)</p>
                            </td>
                            <td style="border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="tekanan_awal_kanan_bawah_{{ $formIndex }}" id="tekanan_awal_kanan_bawah_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="tekanan_akhir_kanan_bawah_{{ $formIndex }}" id="tekanan_akhir_kanan_bawah_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                        </tr>
                        
                        <!-- Suhu Air BAWAH -->
                        <tr style="height:12pt">
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">Suhu Air (°C)</p>
                            </td>
                            <td style="border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="suhu_air_awal_kiri_bawah_{{ $formIndex }}" id="suhu_air_awal_kiri_bawah_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="suhu_air_akhir_kiri_bawah_{{ $formIndex }}" id="suhu_air_akhir_kiri_bawah_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">Suhu Air (°C)</p>
                            </td>
                            <td style="border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="suhu_air_awal_kanan_bawah_{{ $formIndex }}" id="suhu_air_awal_kanan_bawah_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="suhu_air_akhir_kanan_bawah_{{ $formIndex }}" id="suhu_air_akhir_kanan_bawah_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                        </tr>
                        
                        <!-- Waktu BAWAH -->
                        <tr style="height:12pt">
                            <td colspan="2" style="border-style:solid solid double; border-width:0.75pt 0.75pt 2.25pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">Waktu (detik)</p>
                            </td>
                            <td colspan="3" style="border-style:solid solid double; border-width:0.75pt 0.75pt 2.25pt; vertical-align:middle; text-align:center">
                                <input type="text" name="waktu_kiri_bawah_{{ $formIndex }}" id="waktu_kiri_bawah_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                            <td style="width:3%; border-style:solid solid double; border-width:0.75pt 0.75pt 2.25pt; vertical-align:middle; text-align:center">
                                <p class="TableParagraph" style="font-size:8pt"><span style="font-family:'Times New Roman';">&#xa0;</span></p>
                            </td>
                            <td colspan="2" style="border-style:solid solid double; border-width:0.75pt 0.75pt 2.25pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">Waktu (detik)</p>
                            </td>
                            <td colspan="3" style="border-style:solid solid double; border-width:0.75pt 0.75pt 2.25pt; vertical-align:middle; text-align:center">
                                <input type="text" name="waktu_kanan_bawah_{{ $formIndex }}" id="waktu_kanan_bawah_{{ $formIndex }}"
                                       style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                        </tr>
                        
                        <!-- SPACER -->
                        <tr>
                            <td colspan="11" style="padding:5px;">
                                <p style="margin-top:0.35pt; font-size:9pt">&nbsp;</p>
                            </td>
                        </tr>
                        
                        <!-- ==================== BAGIAN TAMBAHAN KIRI ==================== -->
                        <!-- HEADER TAMBAHAN -->
                        <tr style="height:15pt">
                            <td rowspan="2" style="width:15%; border-style:double solid solid; border-width:2.25pt 0.75pt 0.75pt; vertical-align:middle; background-color:#d9d9d9; text-align:center">
                                <div style="width:100%; text-align:center">
                                    <span style="font-family:Arial; font-size:8pt; font-weight:bold">Nominal Alat Ukur</span><br>
                                    <p style="margin:0; font-size:6pt;">
                                        <span style="font-family:'Verdana';">(
                                            <input type="text" name="satuan_alat_ukur_tambahan_kiri_{{ $formIndex }}"
                                                id="satuan_alat_ukur_tambahan_kiri_{{ $formIndex }}"
                                                style="width:60px; border:none; border-bottom:1px dotted #000; 
                                                        font-family:'Verdana'; font-size:6pt; text-align:center; background:transparent;">
                                            )
                                        </span>
                                    </p>
                                </div>
                            </td>
                            <td colspan="4" style="width:25%; border-style:double solid solid; border-width:2.25pt 0.75pt 0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:5pt; margin-left:13.55pt; font-size:8pt">
                                    <span style="font-family:Arial; font-weight:bold">Pembacaan Timbangan (g)</span>
                                </p>
                            </td>
                            <td colspan="5" rowspan="19" style="border:none;"></td>
                        </tr>
                        
                        <tr style="height:12pt">
                            <td style="width:6%; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                                    <span style="font-family:Arial; font-weight:bold">m</span>
                                </p>
                            </td>
                            <td colspan="3" style="width:19%; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                                    <span style="font-family:Arial; font-weight:bold">Nilai</span>
                                </p>
                            </td>
                        </tr>
                        
                        <!-- BARIS DATA m0 - m11 (TAMBAHAN) -->
                        <?php for ($i = 0; $i <= 11; $i++): ?>
                        <tr style="height:12pt">
                            <?php if($i == 0): ?>
                            <td rowspan="12" style="width:15%; border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="nominal_tambahan_kiri_{{ $formIndex }}" id="nominal_tambahan_kiri_{{ $formIndex }}"
                                    style="width:90%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none"
                                    placeholder="Nominal">
                            </td>
                            <?php endif; ?>
                            <td style="width:6%; border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">m<sub><?php echo $i; ?></sub></p>
                            </td>
                            <td colspan="3" style="width:19%; border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="m<?php echo $i; ?>_tambahan_kiri_{{ $formIndex }}" id="m<?php echo $i; ?>_tambahan_kiri_{{ $formIndex }}"
                                    style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                        </tr>
                        <?php endfor; ?>
                        
                        <!-- Header Parameter Pendukung TAMBAHAN -->
                        <tr style="height:12pt">
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                                    <span style="font-family:Arial; font-weight:bold">Parameter Pendukung</span>
                                </p>
                            </td>
                            <td style="border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                                    <span style="font-family:Arial; font-weight:bold">Awal</span>
                                </p>
                            </td>
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">
                                    <span style="font-family:Arial; font-weight:bold">Akhir</span>
                                </p>
                            </td>
                        </tr>
                        
                        <!-- Suhu Udara TAMBAHAN -->
                        <tr style="height:12pt">
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">Suhu Udara (°C)</p>
                            </td>
                            <td style="border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="suhu_awal_tambahan_kiri_{{ $formIndex }}" id="suhu_awal_tambahan_kiri_{{ $formIndex }}"
                                    style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="suhu_akhir_tambahan_kiri_{{ $formIndex }}" id="suhu_akhir_tambahan_kiri_{{ $formIndex }}"
                                    style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                        </tr>
                        
                        <!-- Kelembaban TAMBAHAN -->
                        <tr style="height:12pt">
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">Kelembaban (% RH)</p>
                            </td>
                            <td style="border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="kelembaban_awal_tambahan_kiri_{{ $formIndex }}" id="kelembaban_awal_tambahan_kiri_{{ $formIndex }}"
                                    style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="kelembaban_akhir_tambahan_kiri_{{ $formIndex }}" id="kelembaban_akhir_tambahan_kiri_{{ $formIndex }}"
                                    style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                        </tr>
                        
                        <!-- Tekanan TAMBAHAN -->
                        <tr style="height:12pt">
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">Tekanan (hPa)</p>
                            </td>
                            <td style="border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="tekanan_awal_tambahan_kiri_{{ $formIndex }}" id="tekanan_awal_tambahan_kiri_{{ $formIndex }}"
                                    style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="tekanan_akhir_tambahan_kiri_{{ $formIndex }}" id="tekanan_akhir_tambahan_kiri_{{ $formIndex }}"
                                    style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                        </tr>
                        
                        <!-- Suhu Air TAMBAHAN -->
                        <tr style="height:12pt">
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">Suhu Air (°C)</p>
                            </td>
                            <td style="border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="suhu_air_awal_tambahan_kiri_{{ $formIndex }}" id="suhu_air_awal_tambahan_kiri_{{ $formIndex }}"
                                    style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                            <td colspan="2" style="border-style:solid; border-width:0.75pt; vertical-align:middle; text-align:center">
                                <input type="text" name="suhu_air_akhir_tambahan_kiri_{{ $formIndex }}" id="suhu_air_akhir_tambahan_kiri_{{ $formIndex }}"
                                    style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                        </tr>
                        
                        <!-- WAKTU TAMBAHAN -->
                        <tr style="height:12pt">
                            <td colspan="2" style="border-style:solid solid double; border-width:0.75pt 0.75pt 2.25pt; vertical-align:top; background-color:#d9d9d9">
                                <p class="TableParagraph" style="margin-top:3pt; text-align:center; font-size:8pt">Waktu (detik)</p>
                            </td>
                            <td colspan="3" style="border-style:solid solid double; border-width:0.75pt 0.75pt 2.25pt; vertical-align:middle; text-align:center">
                                <input type="text" name="waktu_tambahan_kiri_{{ $formIndex }}" id="waktu_tambahan_kiri_{{ $formIndex }}"
                                    style="width:95%; border:none; background:transparent; font-size:8pt; text-align:center; outline:none">
                            </td>
                        </tr>
                    </table>
                    
                    <p class="BodyText" style="margin-top:3.1pt; margin-left:4.45pt; margin-bottom:1.3pt">
                        <span>Catatan</span>
                        <span style="letter-spacing:0.15pt"></span>
                        <span>:</span>
                        <span style="letter-spacing:0.1pt"></span>
                        <span>Pengukuran</span>
                        <span style="letter-spacing:0.2pt"></span>
                        <span>m</span>
                        <span style="font-size:6pt; vertical-align:sub">11</span>
                        <span style="letter-spacing:0.15pt"></span>
                        <span>dan</span>
                        <span style="letter-spacing:0.15pt"></span>
                        <span>penghitungan</span>
                        <span style="letter-spacing:0.2pt"></span>
                        <span>waktu</span>
                        <span style="letter-spacing:0.15pt"></span>
                        <span>hanya</span>
                        <span style="letter-spacing:0.2pt"></span>
                        <span>untuk</span>
                        <span style="letter-spacing:0.15pt"></span>
                        <span>volume</span>
                        <span style="letter-spacing:0.15pt"></span>
                        <span>50</span>
                        <span style="letter-spacing:0.35pt"></span>
                        <span style="font-family:Calibri">μ</span>
                        <span>l ke</span>
                        <span style="letter-spacing:0.2pt"></span>
                        <span style="letter-spacing:-0.2pt">bawah</span>
                    </p>

                    <!-- ==================== TABEL ALAT STANDAR & METODE ==================== -->
                    <table cellspacing="0" cellpadding="5"
                        style="border-collapse:collapse; width:100%; font-family:Arial; font-size:9pt; border:1px solid #000;">

                        <!-- JUDUL -->
                        <tr>
                            <td colspan="9" style="border:1px solid #000; text-align:center; font-weight:bold; font-size:11pt;">
                                Isilah lembar data kalibrasi dengan lengkap dan jelas!
                            </td>
                        </tr>

                        <!-- BARIS 1 - Semi Microbalance AND -->
                        <tr>
                            <td rowspan="4" style="border:1px solid #000; text-align:center; font-weight:bold; width:90px;">
                                Alat Standar
                            </td>
                            <td style="border:1px solid #000; width:200px;">Semi Microbalance, AND</td>
                            <td style="border:1px solid #000;" align="center">
                                <input type="checkbox" name="alat_standar_{{ $formIndex }}[]" value="Semi Microbalance AND 0.1g" id="std_and_01_{{ $formIndex }}">
                                <label for="std_and_01_{{ $formIndex }}">0.1 g</label>
                            </td>
                            <td style="border:1px solid #000;" align="center">
                                <input type="checkbox" name="alat_standar_{{ $formIndex }}[]" value="Semi Microbalance AND 1g" id="std_and_1_{{ $formIndex }}">
                                <label for="std_and_1_{{ $formIndex }}">1 g</label>
                            </td>
                            <td style="border:1px solid #000;" align="center">
                                <input type="checkbox" name="alat_standar_{{ $formIndex }}[]" value="Semi Microbalance AND 10g" id="std_and_10_{{ $formIndex }}">
                                <label for="std_and_10_{{ $formIndex }}">10 g</label>
                            </td>
                            <td style="border:1px solid #000;" align="center">
                                <input type="checkbox" name="alat_standar_{{ $formIndex }}[]" value="Semi Microbalance AND 100g" id="std_and_100_{{ $formIndex }}">
                                <label for="std_and_100_{{ $formIndex }}">100 g</label>
                            </td>
                            <td style="border:1px solid #000;" align="center">
                                <input type="checkbox" name="alat_standar_{{ $formIndex }}[]" value="Semi Microbalance AND 200g" id="std_and_200_{{ $formIndex }}">
                                <label for="std_and_200_{{ $formIndex }}">200 g</label>
                            </td>
                            <!-- TANPA BORDER -->
                            <td style="border:none; text-align:center; font-weight:bold;">
                                Dikalibrasi oleh
                            </td>
                            <td style="border:none; text-align:center; font-weight:bold;">
                                Diperiksa oleh
                            </td>
                        </tr>

                        <!-- BARIS 2 - Semi Microbalance Radwag -->
                        <tr>
                            <td style="border:1px solid #000;">Semi Microbalance, Radwag</td>
                            <td style="border:1px solid #000;" align="center">
                                <input type="checkbox" name="alat_standar_{{ $formIndex }}[]" value="Semi Microbalance Radwag 0.1g" id="std_radwag_01_{{ $formIndex }}">
                                <label for="std_radwag_01_{{ $formIndex }}">0.1 g</label>
                            </td>
                            <td style="border:1px solid #000;" align="center">
                                <input type="checkbox" name="alat_standar_{{ $formIndex }}[]" value="Semi Microbalance Radwag 1g" id="std_radwag_1_{{ $formIndex }}">
                                <label for="std_radwag_1_{{ $formIndex }}">1 g</label>
                            </td>
                            <td style="border:1px solid #000;" align="center">
                                <input type="checkbox" name="alat_standar_{{ $formIndex }}[]" value="Semi Microbalance Radwag 10g" id="std_radwag_10_{{ $formIndex }}">
                                <label for="std_radwag_10_{{ $formIndex }}">10 g</label>
                            </td>
                            <td style="border:1px solid #000;" align="center">
                                <input type="checkbox" name="alat_standar_{{ $formIndex }}[]" value="Semi Microbalance Radwag 100g" id="std_radwag_100_{{ $formIndex }}">
                                <label for="std_radwag_100_{{ $formIndex }}">100 g</label>
                            </td>
                            <td style="border:1px solid #000;" align="center">
                                <input type="checkbox" name="alat_standar_{{ $formIndex }}[]" value="Semi Microbalance Radwag 200g" id="std_radwag_200_{{ $formIndex }}">
                                <label for="std_radwag_200_{{ $formIndex }}">200 g</label>
                            </td>
                        </tr>

                        <!-- BARIS 3 - Timbangan Digital & Stopwatch -->
                        <tr>
                            <td style="border:1px solid #000;">Timbangan Digital, AND</td>
                            <td colspan="2" style="border:1px solid #000;" align="center">
                                <input type="checkbox" name="alat_standar_{{ $formIndex }}[]" value="Timbangan Digital AND 3kg" id="std_digital_3kg_{{ $formIndex }}">
                                <label for="std_digital_3kg_{{ $formIndex }}">3 kg</label>
                            </td>
                            <td colspan="3" style="border:1px solid #000;" align="center">
                                Stopwatch<br>
                                <input type="checkbox" name="stopwatch_{{ $formIndex }}" value="Stopwatch WF002" id="stopwatch_wf002_{{ $formIndex }}">
                                <label for="stopwatch_wf002_{{ $formIndex }}">WF002</label>
                                &nbsp;&nbsp;
                                <input type="checkbox" name="stopwatch_{{ $formIndex }}" value="Stopwatch WT003" id="stopwatch_wt003_{{ $formIndex }}">
                                <label for="stopwatch_wt003_{{ $formIndex }}">WT003</label>
                            </td>
                        </tr>

                        <!-- BARIS 4 - Termometer -->
                        <tr>
                            <td style="border:1px solid #000;">Termometer</td>
                            <td colspan="2" style="border:1px solid #000;" align="center">
                                <input type="checkbox" name="termometer_{{ $formIndex }}" value="Termometer TES" id="termometer_tes_{{ $formIndex }}">
                                <label for="termometer_tes_{{ $formIndex }}">TES</label>
                            </td>
                            <td style="border:1px solid #000;"></td>
                            <td colspan="2" style="border:1px solid #000;" align="center">
                                <input type="checkbox" name="termometer_{{ $formIndex }}" value="Termometer TFA" id="termometer_tfa_{{ $formIndex }}">
                                <label for="termometer_tfa_{{ $formIndex }}">TFA</label>
                            </td>
                        </tr>

                        <!-- BARIS TERAKHIR - Metode Kalibrasi -->
                        <tr>
                            <td style="border:1px solid #000; font-weight:bold; text-align:center;">
                                Metode Kalibrasi
                            </td>
                            <td colspan="6" style="border:1px solid #000; padding-left:10px;">
                                <input type="hidden" name="metode_kalibrasi_{{ $formIndex }}[]" value="PAS-IK102-39 (Volumetrik Piston)" id="metode_volumetrik_{{ $formIndex }}" checked>
                                <label for="metode_volumetrik_{{ $formIndex }}">PAS-IK102-39 (Volumetrik Piston)</label>
                            </td>
                            <td style="border:1px solid #000; text-align:center;">
                                TTD :<br><br>
                                Nama :<br>
                                <input type="text" name="calibrated_by" id="calibrated_by_{{ $formIndex }}"
                                       style="width:90%; border:none; border-bottom:1px solid #000;"
                                       placeholder="Nama Kalibrator"
                                       value="{{ auth()->user()->nama ?? '' }}" readonly>
                            </td>
                            <td style="border:1px solid #000; text-align:center;">
                                TTD :<br><br>
                                Nama :<br>
                                <input type="text" name="verified_by" id="verified_by_{{ $formIndex }}"
                                       style="width:90%; border:none; border-bottom:1px solid #000;"
                                       placeholder="-"
                                       {{ $isFirstForm ?? false ? 'readonly' : '' }}>
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
        // 🔥 PRIORITAS 1: Cek dari URL parameter 'count' (paling penting)
        const urlParams = new URLSearchParams(window.location.search);
        const countParam = urlParams.get('count');
        
        if (countParam && !isNaN(parseInt(countParam))) {
            const count = parseInt(countParam);
            console.log('📊 getFormCount from URL param (count):', count);
            return Math.max(1, count); // TIDAK dibatasi 4
        }
        
        // 🔥 PRIORITAS 2: Cek dari form yang sudah ada di DOM
        const existingForms = document.querySelectorAll('form[id^="kalibrasiForm"]');
        if (existingForms.length > 0) {
            const countFromDOM = existingForms.length;
            console.log('📊 getFormCount from existing forms in DOM:', countFromDOM);
            return countFromDOM;
        }
        
        // 🔥 PRIORITAS 3: Cek dari sessionStorage (backup)
        const savedCount = sessionStorage.getItem('current_jumlah_form');
        if (savedCount && !isNaN(parseInt(savedCount))) {
            const count = parseInt(savedCount);
            console.log('📊 getFormCount from sessionStorage:', count);
            return Math.max(1, count);
        }
        
        // Default: 1 form
        console.log('📊 getFormCount default: 1');
        return 1;
    }
    
    // Fungsi untuk menyimpan jumlah form ke sessionStorage (TANPA batasan 4)
    function setFormCount(count) {
        const countVal = parseInt(count);
        if (!isNaN(countVal) && countVal >= 1) {
            sessionStorage.setItem('current_jumlah_form', countVal.toString());
            console.log('💾 Saved jumlah_form to sessionStorage:', countVal);
        }
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
        
        // 🔥 PERUBAHAN UTAMA: KETERANGAN TIDAK DISYNC!
        const fieldsToSync = [
            'nama_alat', 'merek', 'kode_alat', 'type_alat', 'no_seri',
            'rentang_ukur_min', 'rentang_ukur_max', 'kapasitas', 'resolusi',
            'nama_pemilik', 'tanggal_alat_masuk', 'tanggal_kalibrasi',
            'tempat_kalibrasi', 'lokasi_pt', 'fungsi_komponen','kode_th',
            // 🔥 KETERANGAN DIHAPUS DARI FIELDS_TO_SYNC
            'suhu_awal', 'suhu_tengah', 'suhu_akhir', 'rh_awal', 'rh_tengah', 'rh_akhir', 
            'verified_by'
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
            
            // Sync semua field kecuali keterangan
            fieldsToSync.forEach(field => {
                if (form1Values[field]) {
                    setFormValue(form, field, form1Values[field]);
                }
            });
            
            // 🔥 KETERANGAN TIDAK DISYNC - Biarkan user mengisi sendiri
            // Jika field keterangan ada di form, biarkan nilainya (tidak diubah)
            
            const existingCheckboxes = form.querySelectorAll('input[name="alat_standar[]"]');
            existingCheckboxes.forEach(cb => {
                cb.checked = alatStandar.includes(cb.value);
            });
        }
        
        console.log('✅ All forms synced from form 1 (except Keterangan)');
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
    
    // 🔥 AMBIL NILAI DARI FORM 1 UNTUK DIREPLIKASI KE FORM LAIN
    const form1 = forms[0];
    const form1Values = {};
    
    // Field yang diperlukan (semua required) - KETERANGAN TIDAK DISYNC
    const requiredFields = [
        'merek', 'no_seri', 'kapasitas', 'resolusi', 'nama_pemilik',
        'tanggal_alat_masuk', 'tanggal_kalibrasi', 'tempat_kalibrasi',
        'fungsi_komponen', 'suhu_awal', 'suhu_tengah', 'suhu_akhir',
        'rh_awal', 'rh_tengah', 'rh_akhir', 'calibrated_by'
    ];
    
    // Ambil nilai dari form 1
    requiredFields.forEach(field => {
        const input = form1.querySelector(`[name="${field}"]`);
        if (input && input.value && input.value !== '') {
            form1Values[field] = input.value;
        } else {
            // Default values jika form 1 kosong
            if (field === 'suhu_awal' || field === 'suhu_tengah' || field === 'suhu_akhir' ||
                field === 'rh_awal' || field === 'rh_tengah' || field === 'rh_akhir') {
                form1Values[field] = '0';
            } else if (field === 'kapasitas') {
                form1Values[field] = '200';
            } else if (field === 'resolusi') {
                form1Values[field] = '0.01';
            } else if (field === 'calibrated_by') {
                form1Values[field] = 'Admin';
            } else {
                form1Values[field] = '-';
            }
        }
    });
    
    // 🔥 ISI SEMUA FORM DENGAN NILAI DARI FORM 1 (KECUALI KETERANGAN)
    for (let i = 0; i < forms.length; i++) {
        const form = forms[i];
        const formIndex = i + 1;
        
        // Isi semua required fields dengan nilai dari form 1 (kecuali keterangan)
        for (const field of requiredFields) {
            const input = form.querySelector(`[name="${field}"]`);
            if (input) {
                if (!input.value || input.value === '') {
                    input.value = form1Values[field];
                    console.log(`📝 Form ${formIndex} - ${field} diisi dengan: ${form1Values[field]}`);
                }
            } else {
                // Buat hidden input jika field tidak ada
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = field;
                hiddenInput.value = form1Values[field];
                form.appendChild(hiddenInput);
                console.log(`📝 Form ${formIndex} - ${field} ditambahkan sebagai hidden: ${form1Values[field]}`);
            }
        }
        
        // Fix input number kosong
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
        
        // ================================================================
        // 🔥 PERBAIKAN UTAMA: PROSES SETIAP FORM DENGAN BENAR
        // ================================================================
        for (let i = 0; i < forms.length; i++) {
            const form = forms[i];
            const formIndex = i + 1;
            const formData = new FormData(form);
            
            // 1. PROSES SEMUA FIELD BIASA (selain yang spesial)
            for (let [key, value] of formData.entries()) {
                if (key === '_token') continue;
                
                // Skip field yang akan diproses terpisah
                if (key.startsWith('alat_standar_')) continue;
                if (key.startsWith('stopwatch_')) continue;
                if (key.startsWith('termometer_')) continue;
                if (key.startsWith('metode_kalibrasi_')) continue;
                
                if (key !== 'form_index' && key !== 'jumlah_form') {
                    combinedFormData.append(`form_${formIndex}_${key}`, value);
                }
            }
            
            // ============================================================
            // 2. 🔥 AMBIL ALAT STANDAR (MULTIPLE CHECKBOX)
            //   
            // ============================================================
            const standarCheckboxes = form.querySelectorAll(`input[name="alat_standar_${formIndex}[]"]:checked`);
            standarCheckboxes.forEach((input) => {
                if (input.value) {
                    combinedFormData.append(`form_${formIndex}_alat_standar[]`, input.value);
                    console.log(`📝 Form ${formIndex} - Alat Standar: ${input.value}`);
                }
            });
            
            // ============================================================
            // 3. 🔥 AMBIL STOPWATCH
            /
            // ============================================================
            const stopwatchChecked = form.querySelector(`input[name="stopwatch_${formIndex}"]:checked`);
            if (stopwatchChecked && stopwatchChecked.value) {
                combinedFormData.append(`form_${formIndex}_stopwatch`, stopwatchChecked.value);
                console.log(`📝 Form ${formIndex} - Stopwatch: ${stopwatchChecked.value}`);
            }
            
            // ============================================================
            // 4. 🔥 AMBIL TERMOMETER
            //  
            // ============================================================
            const termometerChecked = form.querySelector(`input[name="termometer_${formIndex}"]:checked`);
            if (termometerChecked && termometerChecked.value) {
                combinedFormData.append(`form_${formIndex}_termometer`, termometerChecked.value);
                console.log(`📝 Form ${formIndex} - Termometer: ${termometerChecked.value}`);
            }
            
            // ============================================================
            // 5. 🔥 AMBIL METODE KALIBRASI
            //   
            // ============================================================
            const metodeInput = form.querySelector(`input[name="metode_kalibrasi_${formIndex}[]"]:checked`);
            if (metodeInput && metodeInput.value) {
                combinedFormData.append(`form_${formIndex}_metode_kalibrasi`, metodeInput.value);
                console.log(`📝 Form ${formIndex} - Metode: ${metodeInput.value}`);
            }
            
            // ============================================================
            // 6. 🔥 AMBIL NAMA ALAT MANUAL (jika ada)
            // ============================================================
            const manualInput = form.querySelector('input[name="nama_alat_manual"]');
            if (manualInput && manualInput.value) {
                combinedFormData.append(`form_${formIndex}_nama_alat_manual`, manualInput.value);
            }
            
            const finalInput = form.querySelector('input[name="nama_alat_final"]');
            if (finalInput && finalInput.value) {
                combinedFormData.append(`form_${formIndex}_nama_alat_final`, finalInput.value);
            }
            
            // Tambahkan form index
            combinedFormData.append(`form_${formIndex}_form_index`, formIndex);
        }
        
        // ================================================================
        // 7. TAMBAHKAN DATA GLOBAL
        // ================================================================
        combinedFormData.append('jumlah_form', formCount.toString());
        combinedFormData.append('submit_all', 'true');
        combinedFormData.append('form_type', 'mikropipet_dispenset');
        
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        combinedFormData.append('_token', csrfToken);
        
        // 🔥 LOG UNTUK DEBUG - TAMPILKAN DATA YANG AKAN DIKIRIM
        console.log('📤 Combined FormData entries:');
        for (let [key, value] of combinedFormData.entries()) {
            console.log(`  ${key}: ${value}`);
        }
        
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
            let errorMsg = result.error || result.message || `Gagal menyimpan data: ${response.status}`;
            if (result.errors) {
                const errors = Object.values(result.errors).flat();
                errorMsg += '\n\nDetail:\n' + errors.join('\n');
            }
            throw new Error(errorMsg);
        }
        
        console.log('📌 Saving success for tab:', activeTabId);
        
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
</body>
</html>
