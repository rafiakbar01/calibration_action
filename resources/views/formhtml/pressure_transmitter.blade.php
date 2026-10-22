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

        /* Styling untuk tabel data kalibrasi */
        .data-kalibrasi-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .data-kalibrasi-table td,
        .data-kalibrasi-table th {
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
    </style>
</head>

<body>
    <div class="container my-4">
        <!-- resources/views/formhtml/inside_micrometer.blade.php -->
        <form method="POST" action="/calibrations" id="kalibrasiForm">
            @csrf
            <input type="hidden" name="form_type" value="pressure_transmitter">


            <div class="form-kalibrasi-container">
                <table class="kalibrasi-header-table">
                    <tr>
                        <td colspan="2">
                            <p style="margin: 0; font-size: 14px; color: #000000;text-align: left;">PAS-FLK55</p>
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
                            <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;text-align: left;">PRESSURE TRANSMITTER / DIFF PRESSURE TRANSMITTER</p>
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
                        <td style="width: 20%;">
                            <p style="margin: 0; color: #000000;">Nama Alat</p>
                        </td>
                        <td colspan="3">
                            <!-- Hidden input untuk form type -->


                            <select name="nama_alat" id="nama_alat_select" class="kalibrasi-input" onchange="updateFormType(this.value)" required style="background-color: #f5f5f5; color: #333; border: 1px solid #ced4da; padding: 6px 10px; border-radius: 4px; width: 100%;">
                                <option value="">-- Pilih Alat --</option>
                                <option value="Pressure Transmitter">Pressure Transmitter</option>
                                <option value="Diff Pressure Transmitter">Diff Pressure Transmitter</option>
                                <option value="MANUAL_INPUT">-- Input Nama Alat --</option>
                            </select>

                            <!-- Input Manual - HIDANG AWALNYA -->
                            <div id="manualInputContainer" style="display: none; margin-top: 10px;">
                                <input type="text" name="nama_alat_manual" id="nama_alat_manual"
                                    placeholder="Ketik nama alat"
                                    style="background-color: #f5f5f5; color: #333; border: 1px solid #ced4da; padding: 6px 10px; border-radius: 4px; width: 100%;"
                                    oninput="syncNamaAlat()">
                            </div>

                            <!-- Hidden input untuk menyimpan nama alat final -->
                            <input type="hidden" name="nama_alat_final" id="nama_alat_final" value="">

                            <!-- Hidden input untuk display (opsional) -->
                            <input type="hidden" name="nama_alat_display" id="nama_alat_display" value="">
                        </td>
                    </tr>


                    <!-- Merek & Kode Alat -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;text-align: left;">Merek</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" name="merek" class="kalibrasi-input me-3" placeholder="Masukkan merek alat" style="width: 60%;text-align: left;" required>
                                <span class="me-1" style="color:#000000;">KodeAlat:</span>
                                <input type="text" name="kode_alat" class="kalibrasi-input" placeholder="Masukkan kode" style="width: 30%; text-align: left;">
                            </div>
                        </td>
                    </tr>

                    <!-- Type / No. Seri -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;text-align: left;">Type / No. Seri</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text"
                                    name="type_alat"
                                    class="kalibrasi-input me-3"
                                    placeholder="Masukkan Type Alat"
                                    style="width: 45%; text-align: left;"
                                    oninput="formatTypeAlat(this)">
                                <span class="me-3" style="color: #000000;">/</span>
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
                    <!-- Rentang Ukur -->
                    <!-- <tr>
                        <td><p style="margin:0;color:#000; text-align: left;">Rentang Ukur</p></td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="number"
                                    name="rentang_ukur_min"
                                    class="kalibrasi-input me-3"
                                    value="0"
                                    step="any"
                                    style="width:45%;"
                                    placeholder="Masukkan Range Min"
                                    required>

                                <span class="me-3">-</span>

                                <input type="number"
                                    name="rentang_ukur_max"
                                    id="rentang_ukur_max"
                                    class="kalibrasi-input"
                                    step="any"
                                    style="width:45%;"
                                    placeholder="Masukkan Range Max"
                                    required
                                    oninput="updateKapasitas()">
                            </div>
                        </td>
                    </tr> -->

                    <!-- Kapasitas / Resolusi -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Kapasitas / Resolusi</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" name="kapasitas" class="kalibrasi-input me-3" placeholder="Masukkan kapasitas" style="width: 45%;" required>
                                <span class="me-3" style="color: #000000;">/</span>
                                <input type="text" name="resolusi" class="kalibrasi-input" placeholder="Masukkan Resolusi" style="width: 45%;" required>
                            </div>
                        </td>
                    </tr>

                    <!-- Nama Pemilik -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000; text-align: left;">Nama Pemilik</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" name="nama_pemilik" class="kalibrasi-input me-3" placeholder="Masukkan nama pemilik/Instansi" style="width: 60%;text-align: left;" required>
                            </div>
                        </td>
                    </tr>

                    <!-- Kisaran Pakai Alat -->


                    <!-- Tanggal Alat Masuk & Kalibrasi -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000; text-align: left;">Tanggal Alat Masuk</p>
                        </td>
                        <td colspan="3">
                            <input type="date" name="tanggal_alat_masuk" class="kalibrasi-input" value="{{ date('Y-m-d') }}" required>
                        </td>
                    </tr>
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
                                    style="width: 45%;"
                                    required
                                    value="{{ date('Y-m-d') }}">

                                <span class="me-3" style="color: #000000;">Jenis Pembacaan:</span>

                                <!-- Dropdown Jenis Pembacaan -->
                                <select name="jenis_pembacaan" class="kalibrasi-input" style="width: 45%;">
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
                                    <label class="form-check-label" for="lab" style="color: #000000;">Lab. PT.PAS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tempat_kalibrasi" value="insitu" id="insitu" required>
                                    <label class="form-check-label" for="insitu" style="color: #000000;">Insitu</label>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000; text-align: left;">Lokasi PT</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" name="lokasi_pt" class="kalibrasi-input me-3" placeholder="Masukkan lokasi pt" style="width: 60%;text-align: left;">
                            </div>
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
                                        step="any"

                                        placeholder="0.0"
                                        required></td>
                                <td><input type="number"
                                        name="suhu_tengah"
                                        class="kondisi-input"
                                        step="any"

                                        placeholder="0.0"
                                        required></td>
                                <td><input type="number"
                                        name="suhu_akhir"
                                        class="kondisi-input"
                                        step="any"

                                        placeholder="0.0"
                                        required></td>
                            </tr>
                            <tr>
                                <td class="bg-light fw-bold" style="color: #000000;">RH (%)</td>
                                <td><input type="number"
                                        name="rh_awal"
                                        class="kondisi-input"
                                        step="any"

                                        placeholder="0.0"
                                        required></td>
                                <td><input type="number"
                                        name="rh_tengah"
                                        class="kondisi-input"
                                        step="any"

                                        placeholder="0.0"
                                        required></td>
                                <td><input type="number"
                                        name="rh_akhir"
                                        class="kondisi-input"
                                        step="any"

                                        placeholder="0.0"
                                        required></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <table cellspacing="0" cellpadding="0" class="TableNormal" style="width:100%; border:1pt solid #000000; -aw-border-insideh:1pt single #000000; -aw-border-insidev:1pt single #000000; border-collapse:collapse">
                    <tr style="height:12.05pt">
                        <td rowspan="2" style="width:15%; border-right-style:solid; border-right-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:middle; text-align:center">
                            <p class="TableParagraph" style="margin:0; padding:0; font-size:9pt">
                                <span style="font-family:Arial; font-weight:bold">Set Point</span>
                            </p>
                        </td>
                        <td style="width:21%; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:middle; text-align:center">
                            <p class="TableParagraph" style="margin:0; padding:0; font-size:9pt">
                                <span style="font-family:Arial; font-weight:bold">Pembacaan Pressure</span>
                            </p>
                        </td>
                        <td style="width:21%; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:middle; text-align:center">
                            <p class="TableParagraph" style="margin:0; padding:0; font-size:9pt">
                                <span style="font-family:Arial; font-weight:bold">Signal Output</span>
                            </p>
                        </td>
                        <td style="width:21%; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:middle; text-align:center">
                            <p class="TableParagraph" style="margin:0; padding:0; font-size:9pt">
                                <span style="font-family:Arial; font-weight:bold">Pembacaan Pressure</span>
                            </p>
                        </td>
                        <td style="width:22%; border-left-style:solid; border-left-width:1pt; vertical-align:middle; text-align:center">
                            <p class="TableParagraph" style="margin:0; padding:0; font-size:9pt">
                                <span style="font-family:Arial; font-weight:bold">Signal Output</span>
                            </p>
                        </td>
                    </tr>
                    <tr style="height:13pt">
                        <td style="width:21%; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:middle; text-align:center">
                            <p class="TableParagraph" style="margin:0; padding:0; font-size:9pt">
                                <span style="font-family:Arial; font-weight:bold">Naik</span>
                            </p>
                        </td>
                        <td style="width:21%; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:middle; text-align:center">
                            <p class="TableParagraph" style="margin:0; padding:0; font-size:9pt">
                                <span style="font-family:Arial; font-weight:bold">Naik</span>
                            </p>
                        </td>
                        <td style="width:21%; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:middle; text-align:center">
                            <p class="TableParagraph" style="margin:0; padding:0; font-size:9pt">
                                <span style="font-family:Arial; font-weight:bold">Turun</span>
                            </p>
                        </td>
                        <td style="width:22%; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:middle; text-align:center">
                            <p class="TableParagraph" style="margin:0; padding:0; font-size:9pt">
                                <span style="font-family:Arial; font-weight:bold">Turun</span>
                            </p>
                        </td>
                    </tr>
                    <tr style="height:12.55pt">
                        <td style="width:15%; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:middle; text-align:center">
                            <p class="TableParagraph" style="margin:0; padding:2px 0; font-size:9pt">
                                <span style="font-family:Arial; font-weight:bold">(</span>
                                <input type="text" name="satuan_set_point" style="width:60px; font-family:Arial; font-size:9pt; text-align:center; border:none; background:transparent; outline:none; padding:0; margin:0 2px" placeholder="">
                                <span style="font-family:Arial; font-weight:bold">)</span>
                            </p>
                        </td>
                        <td style="width:21%; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center">
                            <p class="TableParagraph" style="margin:0; padding:2px 0; font-size:9pt">
                                <span style="font-family:Arial; font-weight:bold">(</span>
                                <input type="text" name="satuan_p_naik" style="width:60px; font-family:Arial; font-size:9pt; text-align:center; border:none; background:transparent; outline:none; padding:0; margin:0 2px" placeholder="">
                                <span style="font-family:Arial; font-weight:bold">)</span>
                            </p>
                        </td>
                        <td style="width:21%; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center">
                            <p class="TableParagraph" style="margin:0; padding:2px 0; font-size:9pt">
                                <span style="font-family:Arial; font-weight:bold">(</span>
                                <input type="text" name="satuan_signal_naik" style="width:60px; font-family:Arial; font-size:9pt; text-align:center; border:none; background:transparent; outline:none; padding:0; margin:0 2px" placeholder="">
                                <span style="font-family:Arial; font-weight:bold">)</span>
                            </p>
                        </td>
                        <td style="width:21%; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center">
                            <p class="TableParagraph" style="margin:0; padding:2px 0; font-size:9pt">
                                <span style="font-family:Arial; font-weight:bold">(</span>
                                <input type="text" name="satuan_p_turun" style="width:60px; font-family:Arial; font-size:9pt; text-align:center; border:none; background:transparent; outline:none; padding:0; margin:0 2px" placeholder="">
                                <span style="font-family:Arial; font-weight:bold">)</span>
                            </p>
                        </td>
                        <td style="width:22%; border-top-style:solid; border-top-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:middle; text-align:center">
                            <p class="TableParagraph" style="margin:0; padding:2px 0; font-size:9pt">
                                <span style="font-family:Arial; font-weight:bold">(</span>
                                <input type="text" name="satuan_signal_turun" style="width:60px; font-family:Arial; font-size:9pt; text-align:center; border:none; background:transparent; outline:none; padding:0; margin:0 2px" placeholder="">
                                <span style="font-family:Arial; font-weight:bold">)</span>
                            </p>
                        </td>
                    </tr>

                    <?php for ($i = 1; $i <= 11; $i++): ?>
                        <tr style="height:17.2pt">
                            <td style="width:15%; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:middle; text-align:center">
                                <input type="text" name="set_point_<?php echo $i; ?>" style="width:90%; margin:0 auto; border:none; background:transparent; text-align:center; font-family:Arial; font-size:9pt; outline:none; padding:3px 0" placeholder="">
                            </td>
                            <td style="width:21%; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center">
                                <input type="text" name="pembacaan_naik_<?php echo $i; ?>" style="width:90%; margin:0 auto; border:none; background:transparent; text-align:center; font-family:Arial; font-size:9pt; outline:none; padding:3px 0" placeholder="">
                            </td>
                            <td style="width:21%; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center">
                                <input type="text" name="signal_naik_<?php echo $i; ?>" style="width:90%; margin:0 auto; border:none; background:transparent; text-align:center; font-family:Arial; font-size:9pt; outline:none; padding:3px 0" placeholder="">
                            </td>
                            <td style="width:21%; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center">
                                <input type="text" name="pembacaan_turun_<?php echo $i; ?>" style="width:90%; margin:0 auto; border:none; background:transparent; text-align:center; font-family:Arial; font-size:9pt; outline:none; padding:3px 0" placeholder="">
                            </td>
                            <td style="width:22%; border-top-style:solid; border-top-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:middle; text-align:center">
                                <input type="text" name="signal_turun_<?php echo $i; ?>" style="width:90%; margin:0 auto; border:none; background:transparent; text-align:center; font-family:Arial; font-size:9pt; outline:none; padding:3px 0" placeholder="">
                            </td>
                        </tr>
                    <?php endfor; ?>

                    <tr style="height:17.2pt">
                        <td style="width:15%; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; vertical-align:middle; text-align:center">
                            <p class="TableParagraph" style="margin:0; padding:0; font-size:9pt">
                                <span style="font-family:'Times New Roman'">&#xa0;</span>
                            </p>
                        </td>
                        <td style="width:21%; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:middle; text-align:center">
                            <p class="TableParagraph" style="margin:0; padding:0; font-size:9pt">
                                <span style="font-family:'Times New Roman'">&#xa0;</span>
                            </p>
                        </td>
                        <td style="width:21%; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:middle; text-align:center">
                            <p class="TableParagraph" style="margin:0; padding:0; font-size:9pt">
                                <span style="font-family:'Times New Roman'">&#xa0;</span>
                            </p>
                        </td>
                        <td style="width:21%; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:middle; text-align:center">
                            <p class="TableParagraph" style="margin:0; padding:0; font-size:9pt">
                                <span style="font-family:'Times New Roman'">&#xa0;</span>
                            </p>
                        </td>
                        <td style="width:22%; border-top-style:solid; border-top-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:middle; text-align:center">
                            <p class="TableParagraph" style="margin:0; padding:0; font-size:9pt">
                                <span style="font-family:'Times New Roman'">&#xa0;</span>
                            </p>
                        </td>
                    </tr>
                </table>

                <p class="BodyText" style="margin-top:0.45pt; font-size:7pt">
                    <span style="-aw-import:ignore">&#xa0;</span>
                </p>

                <?php
                // SECTION 1: PRESSURE
                $pressure_names = [
                    'repeatability_p',     // Nilai repeatability pressure
                    'satuan_p',            // Satuan pressure
                    'repP01',
                    'repP02',
                    'repP03',
                    'repP04',
                    'repP05', // Baris 1
                    'repP06',
                    'repP07',
                    'repP08',
                    'repP09',
                    'repP10'  // Baris 2
                ];

                // SECTION 2: SIGNAL OUTPUT  
                $signal_names = [
                    'repeatibility_SO',    // Nilai repeatability signal output
                    'satuan_SO',           // Satuan signal output
                    'repSO01',
                    'repSO02',
                    'repSO03',
                    'repSO04',
                    'repSO05', // Baris 1
                    'repSO06',
                    'repSO07',
                    'repSO08',
                    'repSO09',
                    'repSO10'  // Baris 2
                ];
                ?>

                <!-- SECTION 1: PRESSURE -->
                <p class="BodyText" style="margin-left:14.15pt; margin-bottom:1.35pt">
                    <span>Repeatability</span>
                    <span style="letter-spacing:-0.15pt"></span>
                    <span>:</span>
                    <input type="text" name="repeatability_p" style="width:80px; border:none;   background:transparent; outline:none; text-align:center; font-family:Arial; font-size:9pt; margin:0 5px" placeholder="">
                    <span style="letter-spacing:-0.05pt"></span>
                    <span style="letter-spacing:-0.5pt">(</span>
                    <input type="text" name="satuan_p" style="width:40px; border:none;   background:transparent; outline:none; text-align:center; font-family:Arial; font-size:9pt; margin:0 2px" placeholder="">
                    <span style="letter-spacing:-0.5pt">)</span>
                </p>

                <table cellspacing="0" cellpadding="0" class="TableNormal" style="margin-left:12.5pt; border:1pt solid #000000; -aw-border-insideh:1pt single #000000; -aw-border-insidev:1pt single #000000; border-collapse:collapse">
                    <?php for ($row = 1; $row <= 2; $row++): ?>
                        <tr style="height:<?php echo $row == 1 ? '12.55pt' : '14.7pt'; ?>">
                            <?php for ($col = 1; $col <= 5; $col++): ?>
                                <?php
                                $index = ($row - 1) * 5 + $col + 1; // +1 karena skip 2 input pertama
                                $name = $pressure_names[$index];
                                ?>
                                <td style="width:<?php
                                                    echo $col == 1 ? '52.05pt' : ($col == 2 ? '53.7pt' : ($col == 3 ? '61.05pt' : ($col == 4 ? '55.85pt' : '55.85pt')));
                                                    ?>; 
            <?php
                                // Border styling
                                if ($row == 1) {
                                    echo 'border-right-style:solid; border-right-width:1pt; ';
                                    if ($col > 1) echo 'border-left-style:solid; border-left-width:1pt; ';
                                    echo 'border-bottom-style:solid; border-bottom-width:1pt; ';
                                } else {
                                    echo 'border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; ';
                                    if ($col > 1) echo 'border-left-style:solid; border-left-width:1pt; ';
                                }
            ?>
            vertical-align:middle; text-align:center">
                                    <input type="text" name="<?php echo $name; ?>" style="width:90%; border:none; background:transparent; outline:none; text-align:center; font-family:Arial; font-size:9pt; margin:0 auto; display:block" placeholder="">
                                </td>
                            <?php endfor; ?>
                        </tr>
                    <?php endfor; ?>
                </table>

                <p class="BodyText" style="margin-top:0.05pt">
                    <span style="-aw-import:ignore">&#xa0;</span>
                </p>

                <!-- SECTION 2: SIGNAL OUTPUT -->
                <p class="BodyText" style="margin-left:14.15pt; margin-bottom:1.35pt">
                    <span>Repeatability</span>
                    <span style="letter-spacing:-0.15pt"></span>
                    <span>:</span>
                    <input type="text" name="repeatibility_SO" style="width:80px; border:none;   background:transparent; outline:none; text-align:center; font-family:Arial; font-size:9pt; margin:0 5px" placeholder="">
                    <span style="letter-spacing:-0.05pt"></span>
                    <span style="letter-spacing:-0.5pt">(</span>
                    <input type="text" name="satuan_SO" style="width:40px; border:none;   background:transparent; outline:none; text-align:center; font-family:Arial; font-size:9pt; margin:0 2px" placeholder="">
                    <span style="letter-spacing:-0.5pt">)</span>
                </p>

                <table cellspacing="0" cellpadding="0" class="TableNormal" style="margin-left:12.5pt; border:1pt solid #000000; -aw-border-insideh:1pt single #000000; -aw-border-insidev:1pt single #000000; border-collapse:collapse">
                    <?php for ($row = 1; $row <= 2; $row++): ?>
                        <tr style="height:<?php echo $row == 1 ? '12.55pt' : '14.7pt'; ?>">
                            <?php for ($col = 1; $col <= 5; $col++): ?>
                                <?php
                                $index = ($row - 1) * 5 + $col + 1; // +1 karena skip 2 input pertama
                                $name = $signal_names[$index];
                                ?>
                                <td style="width:<?php
                                                    echo $col == 1 ? '52.05pt' : ($col == 2 ? '53.7pt' : ($col == 3 ? '61.05pt' : ($col == 4 ? '55.85pt' : '55.85pt')));
                                                    ?>; 
            <?php
                                // Border styling
                                if ($row == 1) {
                                    echo 'border-right-style:solid; border-right-width:1pt; ';
                                    if ($col > 1) echo 'border-left-style:solid; border-left-width:1pt; ';
                                    echo 'border-bottom-style:solid; border-bottom-width:1pt; ';
                                } else {
                                    echo 'border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; ';
                                    if ($col > 1) echo 'border-left-style:solid; border-left-width:1pt; ';
                                }
            ?>
            vertical-align:middle; text-align:center">
                                    <input type="text" name="<?php echo $name; ?>" style="width:90%; border:none; background:transparent; outline:none; text-align:center; font-family:Arial; font-size:9pt; margin:0 auto; display:block" placeholder="">
                                </td>
                            <?php endfor; ?>
                        </tr>
                    <?php endfor; ?>
                </table>


                <p>
                    <span style="-aw-import:ignore">&#xa0;</span>
                </p>

                <table cellspacing="0" cellpadding="0" class="TableNormal" style="width:100%; border:1pt solid #000000; -aw-border-insideh:1pt single #000000; -aw-border-insidev:1pt single #000000; border-collapse:collapse">
                    <tr style="height:16.6pt">
                        <td colspan="6" style="border-bottom-style:solid; border-bottom-width:1pt; vertical-align:middle; text-align:center">
                            <p class="TableParagraph" style="margin:0; padding:4px 0; font-size:12.5pt">
                                <span style="font-family:Arial; font-weight:bold">Isilah lembar data kalibrasi dengan lengkap dan jelas!</span>
                            </p>
                        </td>
                    </tr>
                    <tr style="height:13.85pt">
                        <td rowspan="4" style="width:20%; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:middle; text-align:center">
                            <p class="TableParagraph" style="margin:0; padding:8px 0; font-size:9pt; font-weight:bold">
                                Alat Standar
                            </p>
                        </td>
                        <td style="width:3%; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center; padding:4px 0">
                            <input type="checkbox" name="alat_standar[]" value="Const P.001 (0 ~ 700 bar ; Hydraulic)" style="width:15px; height:15px; margin:0 auto; display:block">
                        </td>
                        <td style="width:32%; border-style:solid; border-width:1pt; vertical-align:middle; padding:4px 8px">
                            <p class="TableParagraph" style="margin:0; font-size:9pt">
                                <span>Const P.001 (0 ~ 700 bar ; Hydraulic)</span>
                            </p>
                        </td>
                        <td style="width:20%; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center; padding:4px 0">
                            <p class="TableParagraph" style="margin:0; font-size:9pt; font-weight:bold">
                                Dikalibrasi oleh
                            </p>
                        </td>
                        <td style="width:20%; border-top-style:solid; border-top-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:middle; text-align:center; padding:4px 0">
                            <p class="TableParagraph" style="margin:0; font-size:9pt; font-weight:bold">
                                Diperiksa oleh
                            </p>
                        </td>
                    </tr>
                    <tr style="height:13.85pt">
                        <td style="width:3%; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center; padding:4px 0">
                            <input type="checkbox" name="alat_standar[]" value="Adittel P.002 (-125 ~ 1000 Pa ; Pneumatic)" style="width:15px; height:15px; margin:0 auto; display:block">
                        </td>
                        <td style="width:32%; border-style:solid; border-width:1pt; vertical-align:middle; padding:4px 8px">
                            <p class="TableParagraph" style="margin:0; font-size:9pt">
                                <span>Adittel P.002 (-125 ~ 1000 Pa ; Pneumatic)</span>
                            </p>
                        </td>
                        <td rowspan="3" style="width:20%; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center; padding:8px 4px">

                        </td>
                        <td rowspan="3" style="width:20%; border-top-style:solid; border-top-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:middle; text-align:center; padding:8px 4px">

                        </td>
                    </tr>
                    <tr style="height:13.85pt">
                        <td style="width:3%; border-style:solid; border-width:1pt 1.5pt 1pt 1pt; vertical-align:middle; text-align:center; padding:4px 0">
                            <input type="checkbox" name="alat_standar[]" value="Adittel P.003 (-1 ~ 20 bar ; Pneumatic)" style="width:15px; height:15px; margin:0 auto; display:block">
                        </td>
                        <td style="width:32%; border-style:solid; border-width:1pt 1pt 1pt 1.5pt; vertical-align:middle; padding:4px 8px">
                            <p class="TableParagraph" style="margin:0; font-size:9pt">
                                <span>Adittel P.003 (-1 ~ 20 bar ; Pneumatic)</span>
                            </p>
                        </td>
                    </tr>
                    <tr style="height:13.85pt">
                        <td style="width:3%; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center; padding:4px 0">
                            <input type="checkbox" name="alat_standar[]" value="Adittel P.004 (0 ~ 700 bar ; Hydraulic)" style="width:15px; height:15px; margin:0 auto; display:block">
                        </td>
                        <td style="width:32%; border-style:solid; border-width:1pt; vertical-align:middle; padding:4px 8px">
                            <p class="TableParagraph" style="margin:0; font-size:9pt">
                                <span>Adittel P.004 (0 ~ 700 bar ; Hydraulic)</span>
                            </p>
                        </td>
                    </tr>
                    <tr style="height:13.9pt">
                        <td style="width:20%; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; vertical-align:middle; text-align:center; padding:4px 0">
                            <p class="TableParagraph" style="margin:0; font-size:9pt; font-weight:bold">
                                Metode Kalibrasi
                            </p>
                        </td>
                        <td colspan="2" style="width:35%; border-style:solid; border-width:1pt; vertical-align:middle; text-align:center; padding:4px 0">
                            <span>PAS-IK1102-55</span>
                        </td>
                        <td style="width:20%; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:middle; text-align:center; padding:4px 0">
                            <p class="TableParagraph" style="margin:0; font-size:9pt; font-weight:bold">
                                TTD:
                            </p>
                        </td>
                        <td style="width:20%; border-top-style:solid; border-top-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:middle; text-align:center; padding:4px 0">
                            <p class="TableParagraph" style="margin:0; font-size:9pt; font-weight:bold">
                                TTD:
                            </p>
                        </td>
                    </tr>
                    <tr style="height:13.85pt">
                        <td style="width:20%; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; vertical-align:middle; text-align:center; padding:4px 0">
                            <p class="TableParagraph" style="margin:0; font-size:9pt; font-weight:bold">
                                Tertelusur
                            </p>
                        </td>
                        <td colspan="2" style="width:35%; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:middle; text-align:center; padding:4px 0">
                            <input type="text" name="tertelusur" style="width:95%; border:none; background:transparent; outline:none; font-family:Arial; font-size:9pt; margin:0 auto; display:block; text-align:center">
                        </td>
                        <td style="width:20%; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; vertical-align:middle; text-align:center; padding:4px 0">
                            <input type="text" name="calibrated_by" style="width:95%; border:none; border-bottom:1px solid #000; background:transparent; outline:none; font-family:Arial; font-size:9pt; margin:0 auto; display:block; text-align:center; padding:2px 0" placeholder="Nama" value="{{ auth()->user()->nama ?? 'System' }}" readonly>
                        </td>
                        <td style="width:20%; border-left-style:solid; border-left-width:1pt; vertical-align:middle; text-align:center; padding:4px 0">
                            <input type="text" name="verified_by" style="width:95%; border:none; border-bottom:1px solid #000; background:transparent; outline:none; font-family:Arial; font-size:9pt; margin:0 auto; display:block; text-align:center; padding:2px 0" placeholder="Nama">
                        </td>
                    </tr>
                </table>

                <!-- Submit Button Section -->
                <div class="row mt-5">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary btn-lg" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
                            <i class="fas fa-save me-2"></i>Simpan Data Kalibrasi
                        </button>

                        <!--<button type="reset" class="btn btn-secondary btn-lg ms-3" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">-->
                        <!--    <i class="fas fa-redo me-2"></i>Reset Form-->
                        <!--</button>-->
                    </div>
                </div>

            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <script>
var tempFormDataStore = window.tempFormDataStore;
var isRestoring = window.isRestoring;
var tabSubmitStatus = window.tabSubmitStatus;
var currentActiveTabId = '1';

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

                const submitBtn = form.querySelector('button[type="submit"]');
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
                submitBtn.disabled = true;
            });

            // Inisialisasi update kapasitas
            updateKapasitas();
        });

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

        // Fungsi format Type Alat
        function formatTypeAlat(input) {
            const regex = /[^A-Za-z0-9\s.,\-\/()"'&]/g;
            if (regex.test(input.value)) {
                input.value = input.value.replace(regex, '');
            }
        }

        // Fungsi format No. Seri
        function formatNoSeri(input) {
            const regex = /[^A-Za-z0-9.,\-\/]/g;
            if (regex.test(input.value)) {
                input.value = input.value.replace(regex, '');
            }
        }

        // Fungsi untuk format input number
        function formatInputNumber(input) {
            let value = input.value;
            value = value.replace(',', '.');

            const dotCount = (value.match(/\./g) || []).length;
            if (dotCount > 1) {
                const firstPart = value.substring(0, value.indexOf('.') + 1);
                const lastPart = value.substring(value.lastIndexOf('.') + 1);
                value = firstPart + lastPart.replace(/\./g, '');
            }

            if (value !== input.value) {
                input.value = value;
            }
        }

        // Tambahkan event listener untuk input rentang_ukur_max
        document.getElementById('rentang_ukur_max').addEventListener('input', updateKapasitas);
        document.getElementById('rentang_ukur_max').addEventListener('paste', function() {
            setTimeout(updateKapasitas, 10);
        });

        // ══════════════════════════════════════════════════════════════
        // NAVIGASI EXCEL-STYLE — Arrow Keys + Enter untuk input fields
        // ══════════════════════════════════════════════════════════════
        (function initExcelNav() {
            // Helper to get all navigable inputs on the page (visible and enabled)
            function getGlobalNavigableInputs() {
                return Array.from(document.querySelectorAll(
                    'input:not([type="hidden"]):not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]), select, textarea'
                )).filter(el => {
                    return !el.disabled && !el.readOnly && el.offsetWidth > 0 && el.offsetHeight > 0;
                });
            }

            // Helper to build a 2D grid of inputs inside a table based on cells
            function buildTableGrid(table) {
                const grid = [];
                const rows = table.querySelectorAll('tr');
                rows.forEach(tr => {
                    const rowInputs = [];
                    let hasInputs = false;
                    const cells = tr.cells;
                    if (!cells) return;
                    for (let i = 0; i < cells.length; i++) {
                        const cell = cells[i];
                        // Find first navigable input in this cell
                        const input = cell.querySelector('input:not([type="hidden"]):not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]), select, textarea');
                        if (input && !input.disabled && !input.readOnly) {
                            rowInputs[i] = input;
                            hasInputs = true;
                        } else {
                            rowInputs[i] = null;
                        }
                    }
                    if (hasInputs) {
                        grid.push(rowInputs);
                    }
                });
                return grid;
            }

            // Find [row, col] index of an input in the table grid
            function findInGrid(grid, input) {
                for (let r = 0; r < grid.length; r++) {
                    for (let c = 0; c < grid[r].length; c++) {
                        if (grid[r][c] === input) {
                            return [r, c];
                        }
                    }
                }
                return null;
            }

            function moveTo(target) {
                if (!target) return;
                target.focus();
                if (typeof target.select === 'function' &&
                    target.type !== 'date' &&
                    target.type !== 'select-one') {
                    target.select();
                }
            }

            function highlightActive(el) {
                document.querySelectorAll('._nav-active').forEach(e => {
                    e.classList.remove('_nav-active');
                    e.style.outline = '';
                    e.style.boxShadow = '';
                });
                if (!el) return;
                el.classList.add('_nav-active');
                el.style.outline = '2px solid #2563eb';
                el.style.boxShadow = '0 0 0 3px rgba(37,99,235,0.18)';
            }

            // ── Event listener utama ──────────────────────────────────
            document.addEventListener('keydown', function(e) {
                const active = document.activeElement;
                if (!active) return;

                const tag = active.tagName.toLowerCase();
                const isNavigable =
                    (tag === 'input' && !['hidden', 'radio', 'checkbox', 'submit', 'button'].includes(active.type)) ||
                    tag === 'select' ||
                    tag === 'textarea';

                if (!isNavigable) return;

                const key = e.key;
                const arrowKeys = ['ArrowUp', 'ArrowDown', 'ArrowLeft', 'ArrowRight'];
                const isArrow = arrowKeys.includes(key);
                const isEnter = key === 'Enter';

                if (!isArrow && !isEnter) return;

                // Restrict movement inside textareas for normal cursor movement
                if (tag === 'textarea' && isArrow) {
                    return;
                }

                // Check text input selection boundaries for ArrowLeft/Right
                if (tag === 'input' && (active.type === 'text' || active.type === 'search' || active.type === 'url' || active.type === 'tel')) {
                    try {
                        const len = active.value.length;
                        const start = active.selectionStart;
                        const end = active.selectionEnd;
                        if (len > 0 && !(start === 0 && end === len)) {
                            if (key === 'ArrowLeft' && start > 0) return;
                            if (key === 'ArrowRight' && end < len) return;
                        }
                    } catch (err) {}
                }

                // Restrict ArrowUp/ArrowDown on select dropdowns so user can select options
                if (tag === 'select' && (key === 'ArrowUp' || key === 'ArrowDown')) {
                    return;
                }

                let target = null;
                const table = active.closest('table');

                if (table) {
                    const grid = buildTableGrid(table);
                    const pos = findInGrid(grid, active);
                    if (pos) {
                        const [r, c] = pos;
                        if (key === 'ArrowDown' || key === 'Enter') {
                            // Find next row in same column
                            for (let nextR = r + 1; nextR < grid.length; nextR++) {
                                if (grid[nextR][c]) {
                                    target = grid[nextR][c];
                                    break;
                                }
                            }
                        } else if (key === 'ArrowUp') {
                            // Find previous row in same column
                            for (let prevR = r - 1; prevR >= 0; prevR--) {
                                if (grid[prevR][c]) {
                                    target = grid[prevR][c];
                                    break;
                                }
                            }
                        } else if (key === 'ArrowRight') {
                            // Find next cell in same row
                            for (let nextC = c + 1; nextC < grid[r].length; nextC++) {
                                if (grid[r][nextC]) {
                                    target = grid[r][nextC];
                                    break;
                                }
                            }
                            // Wrap to next row
                            if (!target) {
                                for (let nextR = r + 1; nextR < grid.length; nextR++) {
                                    for (let nextC = 0; nextC < grid[nextR].length; nextC++) {
                                        if (grid[nextR][nextC]) {
                                            target = grid[nextR][nextC];
                                            break;
                                        }
                                    }
                                    if (target) break;
                                }
                            }
                        } else if (key === 'ArrowLeft') {
                            // Find previous cell in same row
                            for (let prevC = c - 1; prevC >= 0; prevC--) {
                                if (grid[r][prevC]) {
                                    target = grid[r][prevC];
                                    break;
                                }
                            }
                            // Wrap to previous row
                            if (!target) {
                                for (let prevR = r - 1; prevR >= 0; prevR--) {
                                    for (let prevC = grid[prevR].length - 1; prevC >= 0; prevC--) {
                                        if (grid[prevR][prevC]) {
                                            target = grid[prevR][prevC];
                                            break;
                                        }
                                    }
                                    if (target) break;
                                }
                            }
                        }
                    }
                }

                // Fallback to global flat list if target not found or not in a table
                if (!target) {
                    const globalInputs = getGlobalNavigableInputs();
                    const index = globalInputs.indexOf(active);
                    if (index !== -1) {
                        if (key === 'ArrowDown' || key === 'Enter' || key === 'ArrowRight') {
                            if (index < globalInputs.length - 1) {
                                target = globalInputs[index + 1];
                            }
                        } else if (key === 'ArrowUp' || key === 'ArrowLeft') {
                            if (index > 0) {
                                target = globalInputs[index - 1];
                            }
                        }
                    }
                }

                if (target) {
                    e.preventDefault();
                    moveTo(target);
                    highlightActive(target);
                }
            }, true);

            // Highlight saat input mendapat fokus
            document.addEventListener('focusin', function(e) {
                const tag = e.target.tagName.toLowerCase();
                if (tag === 'input' || tag === 'select' || tag === 'textarea') {
                    highlightActive(e.target);
                }
            }, true);

            document.addEventListener('focusout', function() {
                // Hapus highlight saat fokus keluar dari semua input
                setTimeout(() => {
                    const active = document.activeElement;
                    if (!active || !['INPUT', 'SELECT', 'TEXTAREA'].includes(active.tagName)) {
                        highlightActive(null);
                    }
                }, 50);
            }, true);

            // Tampilkan indikator shortcut di pojok kanan bawah
            const badge = document.createElement('div');
            badge.innerHTML = '⌨️ <strong>Arrow Keys</strong> / <strong>Enter</strong> = Pindah Cell';
            badge.style.cssText = `
                position: fixed;
                bottom: 18px;
                right: 18px;
                background: rgba(37,99,235,0.92);
                color: #fff;
                font-size: 11px;
                padding: 6px 14px;
                border-radius: 20px;
                box-shadow: 0 4px 16px rgba(37,99,235,0.35);
                z-index: 9999;
                pointer-events: none;
                user-select: none;
                backdrop-filter: blur(4px);
                opacity: 0;
                transition: opacity .3s;
            `;
            document.body.appendChild(badge);

            // Fade-in badge saat ada input yang difokus
            document.addEventListener('focusin', function(e) {
                if (['INPUT', 'SELECT', 'TEXTAREA'].includes(e.target.tagName)) {
                    badge.style.opacity = '1';
                }
            }, true);
            document.addEventListener('focusout', function() {
                setTimeout(() => {
                    const a = document.activeElement;
                    if (!a || !['INPUT', 'SELECT', 'TEXTAREA'].includes(a.tagName)) {
                        badge.style.opacity = '0';
                    }
                }, 100);
            }, true);

        })(); // end initExcelNav
    </script>
</body>

</html>