<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Kalibrasi Kelistrikan - AC Voltage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Global Reset - Semua teks hitam */
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

        /* Header styling - dengan border */
        .kalibrasi-header-table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .kalibrasi-header-table td {
            padding: 5px;
            vertical-align: top;
            border: 1px solid #000;
        }

        /* Main form styling - TANPA border */
        .kalibrasi-main-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .kalibrasi-main-table td {
            padding: 8px;
            vertical-align: middle;
            border: none !important; /* Menghapus semua border */
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

        .kalibrasi-data-table input:focus {
            outline: 2px solid #4a90e2;
            background-color: #f0f8ff;
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

        /* Table AC Voltage */
        .ac-voltage-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .ac-voltage-table td,
        .ac-voltage-table th {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
            vertical-align: middle;
            font-size: 9pt;
        }

        .ac-voltage-table th {
            background-color: #d9d9d9;
            font-weight: bold;
        }

        .ac-voltage-table .section-title {
            background-color: #a0a0a0;
            font-weight: bold;
            font-size: 11pt;
        }

        .ac-voltage-table input[type="text"] {
            width: 100%;
            border: none;
            background: transparent;
            text-align: center;
            padding: 4px;
            box-sizing: border-box;
            font-size: 9pt;
        }

        .ac-voltage-table input[type="text"]:focus {
            outline: 2px solid #4a90e2;
            background-color: #f0f8ff;
        }

        .ac-voltage-table .unit {
            font-size: 8pt;
            display: block;
        }

        .ac-voltage-table .rentang-input {
            font-weight: bold;
            width: 100%;
            border: none;
            background: transparent;
            text-align: center;
            padding: 4px;
            font-size: 9pt;
        }

        .ac-voltage-table .rentang-input:focus {
            outline: 2px solid #4a90e2;
            background-color: #f0f8ff;
        }

        /* Footer table styling */
        .footer-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .footer-table td {
            border: 1px solid #000;
            padding: 8px;
            vertical-align: middle;
            text-align: center;
            font-size: 9pt;
        }

        .footer-table .title {
            font-weight: bold;
            background-color: #f0f0f0;
            font-size: 11pt;
        }

        .footer-table .label {
            font-weight: bold;
            background-color: #e0e0e0;
        }

        .footer-table input[type="text"] {
            width: 90%;
            border: none;
            background: transparent;
            text-align: center;
            padding: 4px;
            font-size: 9pt;
        }

        .footer-table input[type="text"]:focus {
            outline: 2px solid #4a90e2;
            background-color: #f0f8ff;
        }

        .footer-table input[type="checkbox"] {
            transform: scale(1.2);
            margin: 0 5px;
        }

        .footer-table .signature-box {
            min-height: 50px;
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

        /* Radio styling */
        .form-check-input {
            transform: scale(1.2);
        }

        .form-check-label {
            color: #000000 !important;
        }

        @media print {
            body {
                background: white;
                padding: 10px;
            }
            .btn-primary,
            .btn-secondary {
                display: none !important;
            }
        }
    </style>
</head>
<body>
    <div class="container my-4">
        <form method="POST" action="/calibrations" id="kalibrasiForm">
            @csrf
            <input type="hidden" name="form_type" value="kelistrikan">
            <input type="hidden" name="type" value="ac_voltage">

            <div class="form-kalibrasi-container">

                <!-- ==================== HEADER ==================== -->
                <table class="kalibrasi-header-table">
                    <tr>
                        <td colspan="2" style="width: 50%;">
                            <p style="margin: 0; font-size: 8pt; color: #000000; text-align: left;">PAS-FLK044</p>
                        </td>
                        <td rowspan="5" style="width: 50%; text-align: center; vertical-align: middle; padding: 10px 0;">
                            <div style="display: inline-block; text-align: center;">
                                <div style="margin-bottom: 10px;">
                                    <img src="/logo/logo_pas_basic.png" alt="Logo PT. PAS" style="width: 107px; height: 54px; display: block; margin: 0 auto;">
                                </div>
                                <p style="font-weight: bold; margin: 0; font-size: 9pt; color: #000000;">PT. PANANJUNG ANUGRAH SOLUTION</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p style="margin: 0; font-size: 8pt; color: #000000; text-align: left;">LEMBAR KERJA KALIBRASI</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p style="margin: 0; font-weight: bold; font-size: 8pt; color: #000000; text-align: left;">KELISTRIKAN</p>
                        </td>
                    </tr>
                  
                    <tr>
                        <td>
                            <p style="margin: 0; font-size: 8pt; color: #000000; text-align: left;">No. Sertifikat</p>
                        </td>
                        <td>
                            <p style="margin: 0; font-size: 8pt; color: #000000; font-weight: bold; text-align: left;">PAS-SK /</p>
                        </td>
                    </tr>
                </table>

                <!-- ==================== MAIN FORM - TANPA BORDER ==================== -->
                <table class="kalibrasi-main-table">
                    <!-- Nama Alat -->
                    <tr>
                        <td style="width: 20%;">
                            <p style="margin: 0; color: #000000; text-align: left; font-size: 8pt;">Nama Alat</p>
                        </td>
                        <td colspan="3">
                            <input type="text" name="nama_alat" class="kalibrasi-input" placeholder="AC Voltage" style="width: 60%; text-align: left; font-size: 8pt;" required>
                        </td>
                    </tr>

                    <!-- Merek & Kode Alat -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000; text-align: left; font-size: 8pt;">Merek</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" name="merek" class="kalibrasi-input me-3" placeholder="Masukkan merek alat" style="width: 45%; text-align: left; font-size: 8pt;" required>
                                <span class="me-1" style="color:#000000; font-size: 8pt;">Kode Alat:</span>
                                <input type="text" name="kode_alat" class="kalibrasi-input" placeholder="Masukkan kode" style="width: 30%; text-align: left; font-size: 8pt;">
                            </div>
                        </td>
                    </tr>

                    <!-- Type / No. Seri -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000; text-align: left; font-size: 8pt;">Type / No. Seri</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" name="type_alat" class="kalibrasi-input me-3" placeholder="Masukkan Type Alat" style="width: 45%; text-align: left; font-size: 8pt;" oninput="formatTypeAlat(this)">
                                <span class="me-3" style="color: #000000; font-size: 8pt;">/</span>
                                <input type="text" name="no_seri" class="kalibrasi-input" placeholder="Masukkan No. Seri" style="width: 45%; text-align: left; font-size: 8pt;" oninput="formatNoSeri(this)" required>
                            </div>
                        </td>
                    </tr>

                    <!-- Kapasitas / Resolusi -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000; text-align: left; font-size: 8pt;">Kapasitas / Resolusi</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" name="kapasitas" class="kalibrasi-input me-3" placeholder="Kapasitas" style="width: 45%; text-align: left; font-size: 8pt;">
                                <span class="me-3" style="color: #000000; font-size: 8pt;">/</span>
                                <input type="text" name="resolusi" class="kalibrasi-input" placeholder="Resolusi" style="width: 45%; text-align: left; font-size: 8pt;">
                            </div>
                        </td>
                    </tr>

                    <!-- Nama Pemilik -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000; text-align: left; font-size: 8pt;">Nama Pemilik</p>
                        </td>
                        <td colspan="3">
                            <input type="text" name="pemilik" class="kalibrasi-input" placeholder="Masukkan nama pemilik/Instansi" style="width: 60%; text-align: left; font-size: 8pt;" required>
                        </td>
                    </tr>

                    <!-- Tanggal Alat Masuk -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000; text-align: left; font-size: 8pt;">Tanggal Alat Masuk</p>
                        </td>
                        <td colspan="3">
                            <input type="date" name="tanggal_alat_masuk" class="kalibrasi-input" value="{{ date('Y-m-d') }}" style="font-size: 8pt;" required>
                        </td>
                    </tr>

                    <!-- Tanggal Kalibrasi -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000; text-align: left; font-size: 8pt;">Tanggal Kalibrasi</p>
                        </td>
                        <td colspan="3">
                            <input type="date" name="tanggal_kalibrasi" class="kalibrasi-input" value="{{ date('Y-m-d') }}" style="font-size: 8pt;" required>
                        </td>
                    </tr>

                    <!-- Tempat Kalibrasi -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000; text-align: left; font-size: 8pt;">Tempat Kalibrasi</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex">
                                <div class="form-check me-5">
                                    <input class="form-check-input" type="radio" name="tempat_kalibrasi" value="lab" id="lab" required>
                                    <label class="form-check-label" for="lab" style="color: #000000; font-size: 8pt;">Lab. PT.PAS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tempat_kalibrasi" value="insitu" id="insitu" required>
                                    <label class="form-check-label" for="insitu" style="color: #000000; font-size: 8pt;">Insitu</label>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>

                <!-- ==================== FUNGSI KOMPONEN & KONDISI KALIBRASI ==================== -->
                <div class="row mt-4">
                    <!-- Fungsi Komponen Lainnya -->
                    <div class="col-md-6 mb-4">
                        <div class="kalibrasi-section-header" style="color: #000000; font-size: 10pt;">Fungsi Komponen Lainnya</div>

                        <div class="d-flex justify-content-around align-items-center my-4">
                            <div class="text-center">
                                <span class="fw-bold d-block" style="color: #000000; font-size: 9pt;">Ok</span>
                                <input type="radio" name="fungsi_komponen" value="ok" style="transform: scale(1.5); margin: 10px 0;" required>
                            </div>
                            <div class="text-center">
                                <span class="fw-bold d-block" style="color: #000000; font-size: 9pt;">Rusak</span>
                                <input type="radio" name="fungsi_komponen" value="rusak" style="transform: scale(1.5); margin: 10px 0;" required>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mt-4">
                            <span class="fw-bold me-3" style="color: #000000; font-size: 9pt;">Keterangan :</span>
                            <div style="flex: 1; border-bottom: 2px solid #000;">
                                <input type="text" name="keterangan_fungsi_komponen" class="kalibrasi-input" placeholder="Masukkan Keterangan" style="border: none; font-size: 8pt;">
                            </div>
                        </div>
                    </div>

                    <!-- Kondisi Kalibrasi -->
                    <div class="col-md-6 mb-4">
                        <div class="kalibrasi-section-header" style="color: #000000; font-size: 10pt;">Kondisi Kalibrasi</div>

                        <table class="table table-bordered" style="font-size: 8pt;">
                            <tr>
                                <td class="table-secondary fw-bold" style="width: 30%; color: #000000; font-size: 8pt;"></td>
                                <td class="table-secondary fw-bold text-center" style="color: #000000; font-size: 8pt;">Awal</td>
                                <td class="table-secondary fw-bold text-center" style="color: #000000; font-size: 8pt;">Tengah</td>
                                <td class="table-secondary fw-bold text-center" style="color: #000000; font-size: 8pt;">Akhir</td>
                            </tr>
                            <tr>
                                <td class="bg-light fw-bold" style="color: #000000; font-size: 8pt;">Suhu (¡ÆC)</td>
                                <td><input type="number" name="suhu_awal" class="kondisi-input" step="0.1" oninput="formatInputNumber(this)" placeholder="0.0" style="font-size: 8pt;" required></td>
                                <td><input type="number" name="suhu_tengah" class="kondisi-input" step="0.1" oninput="formatInputNumber(this)" placeholder="0.0" style="font-size: 8pt;" required></td>
                                <td><input type="number" name="suhu_akhir" class="kondisi-input" step="0.1" oninput="formatInputNumber(this)" placeholder="0.0" style="font-size: 8pt;" required></td>
                            </tr>
                            <tr>
                                <td class="bg-light fw-bold" style="color: #000000; font-size: 8pt;">RH (%)</td>
                                <td><input type="number" name="rh_awal" class="kondisi-input" step="0.1" oninput="formatInputNumber(this)" placeholder="0.0" style="font-size: 8pt;" required></td>
                                <td><input type="number" name="rh_tengah" class="kondisi-input" step="0.1" oninput="formatInputNumber(this)" placeholder="0.0" style="font-size: 8pt;" required></td>
                                <td><input type="number" name="rh_akhir" class="kondisi-input" step="0.1" oninput="formatInputNumber(this)" placeholder="0.0" style="font-size: 8pt;" required></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- ==================== DATA KALIBRASI - AC VOLTAGE 50 Hz ==================== -->
                <div class="data-kalibrasi-header" style="color: #000000; font-size: 14pt;">DATA KALIBRASI</div>

                <table class="ac-voltage-table">
                    <!-- Judul Bagian -->
                    <tr>
                        <td colspan="10" class="section-title" style="font-size: 11pt;">AC Voltage 50 Hz</td>
                    </tr>

                    <!-- Header Tabel -->
                    <tr>
                        <th rowspan="2" style="font-size: 8pt;">Rentang</th>
                        <th colspan="2" rowspan="2" style="font-size: 8pt;">Penunjukan Alat</th>
                        <th colspan="5" style="font-size: 8pt;">Pembacaan Standard</th>
                        <th rowspan="2" style="font-size: 8pt;">Resolusi Alat</th>
                    </tr>
                    <tr>
                        <th style="font-size: 8pt;">1</th>
                        <th style="font-size: 8pt;">2</th>
                        <th style="font-size: 8pt;">3</th>
                        <th style="font-size: 8pt;">4</th>
                        <th style="font-size: 8pt;">5</th>
                    </tr>

                    <!-- ====== RENTANG 1: 0-100 mV ====== -->
                    <tr>
                        <td rowspan="5">
                            <input type="text" class="rentang-input" placeholder="0-100" style="font-size: 8pt;">
                            <span class="unit" style="font-size: 7pt;">mV</span>
                        </td>
                        <td><input type="text" placeholder="0.0" style="font-size: 8pt;"></td>
                        <td style="font-size: 8pt;">mV</td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td rowspan="5"><input type="text" class="rentang-input" placeholder="0.1" style="font-size: 8pt;"></td>
                    </tr>
                    <tr>
                        <td><input type="text" placeholder="20.0" style="font-size: 8pt;"></td>
                        <td style="font-size: 8pt;">mV</td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                    </tr>
                    <tr>
                        <td><input type="text" placeholder="40.0" style="font-size: 8pt;"></td>
                        <td style="font-size: 8pt;">mV</td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                    </tr>
                    <tr>
                        <td><input type="text" placeholder="60.0" style="font-size: 8pt;"></td>
                        <td style="font-size: 8pt;">mV</td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                    </tr>
                    <tr>
                        <td><input type="text" placeholder="100.0" style="font-size: 8pt;"></td>
                        <td style="font-size: 8pt;">mV</td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                    </tr>

                    <!-- ====== RENTANG 2: 0-100 V ====== -->
                    <tr>
                        <td rowspan="5">
                            <input type="text" class="rentang-input" placeholder="0-100" style="font-size: 8pt;">
                            <span class="unit" style="font-size: 7pt;">V</span>
                        </td>
                        <td><input type="text" placeholder="0.0" style="font-size: 8pt;"></td>
                        <td style="font-size: 8pt;">V</td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td rowspan="5"><input type="text" class="rentang-input" placeholder="0.1" style="font-size: 8pt;"></td>
                    </tr>
                    <tr>
                        <td><input type="text" placeholder="20.0" style="font-size: 8pt;"></td>
                        <td style="font-size: 8pt;">V</td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                    </tr>
                    <tr>
                        <td><input type="text" placeholder="40.0" style="font-size: 8pt;"></td>
                        <td style="font-size: 8pt;">V</td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                    </tr>
                    <tr>
                        <td><input type="text" placeholder="60.0" style="font-size: 8pt;"></td>
                        <td style="font-size: 8pt;">V</td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                    </tr>
                    <tr>
                        <td><input type="text" placeholder="100.0" style="font-size: 8pt;"></td>
                        <td style="font-size: 8pt;">V</td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                    </tr>

                    <!-- ====== RENTANG 3: 0-300 V ====== -->
                    <tr>
                        <td rowspan="5">
                            <input type="text" class="rentang-input" placeholder="0-300" style="font-size: 8pt;">
                            <span class="unit" style="font-size: 7pt;">V</span>
                        </td>
                        <td><input type="text" placeholder="0.0" style="font-size: 8pt;"></td>
                        <td style="font-size: 8pt;">V</td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td rowspan="5"><input type="text" class="rentang-input" placeholder="0.1" style="font-size: 8pt;"></td>
                    </tr>
                    <tr>
                        <td><input type="text" placeholder="60.0" style="font-size: 8pt;"></td>
                        <td style="font-size: 8pt;">V</td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                    </tr>
                    <tr>
                        <td><input type="text" placeholder="120.0" style="font-size: 8pt;"></td>
                        <td style="font-size: 8pt;">V</td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                    </tr>
                    <tr>
                        <td><input type="text" placeholder="180.0" style="font-size: 8pt;"></td>
                        <td style="font-size: 8pt;">V</td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                    </tr>
                    <tr>
                        <td><input type="text" placeholder="300.0" style="font-size: 8pt;"></td>
                        <td style="font-size: 8pt;">V</td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                    </tr>

                    <!-- ====== RENTANG 4: 0-600 V ====== -->
                    <tr>
                        <td rowspan="5">
                            <input type="text" class="rentang-input" placeholder="0-600" style="font-size: 8pt;">
                            <span class="unit" style="font-size: 7pt;">V</span>
                        </td>
                        <td><input type="text" placeholder="0.0" style="font-size: 8pt;"></td>
                        <td style="font-size: 8pt;">V</td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td rowspan="5"><input type="text" class="rentang-input" placeholder="1" style="font-size: 8pt;"></td>
                    </tr>
                    <tr>
                        <td><input type="text" placeholder="120.0" style="font-size: 8pt;"></td>
                        <td style="font-size: 8pt;">V</td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                    </tr>
                    <tr>
                        <td><input type="text" placeholder="240.0" style="font-size: 8pt;"></td>
                        <td style="font-size: 8pt;">V</td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                    </tr>
                    <tr>
                        <td><input type="text" placeholder="360.0" style="font-size: 8pt;"></td>
                        <td style="font-size: 8pt;">V</td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                    </tr>
                    <tr>
                        <td><input type="text" placeholder="600.0" style="font-size: 8pt;"></td>
                        <td style="font-size: 8pt;">V</td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                    </tr>

                    <!-- ====== RENTANG 5: 0-1000 V ====== -->
                    <tr>
                        <td rowspan="5">
                            <input type="text" class="rentang-input" placeholder="0-1000" style="font-size: 8pt;">
                            <span class="unit" style="font-size: 7pt;">V</span>
                        </td>
                        <td><input type="text" placeholder="0.0" style="font-size: 8pt;"></td>
                        <td style="font-size: 8pt;">V</td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td rowspan="5"><input type="text" class="rentang-input" placeholder="1" style="font-size: 8pt;"></td>
                    </tr>
                    <tr>
                        <td><input type="text" placeholder="200.0" style="font-size: 8pt;"></td>
                        <td style="font-size: 8pt;">V</td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                    </tr>
                    <tr>
                        <td><input type="text" placeholder="400.0" style="font-size: 8pt;"></td>
                        <td style="font-size: 8pt;">V</td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                    </tr>
                    <tr>
                        <td><input type="text" placeholder="600.0" style="font-size: 8pt;"></td>
                        <td style="font-size: 8pt;">V</td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                    </tr>
                    <tr>
                        <td><input type="text" placeholder="1000.0" style="font-size: 8pt;"></td>
                        <td style="font-size: 8pt;">V</td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                        <td><input type="text" style="font-size: 8pt;"></td>
                    </tr>
                </table>

                <!-- ==================== FOOTER ==================== -->
                <table class="footer-table">
                    <tr>
                        <td colspan="12" class="title" style="font-size: 11pt;">
                            Isilah lembar data kalibrasi dengan lengkap dan jelas!
                        </td>
                    </tr>

                    <!-- Baris Alat Standar -->
                    <tr>
                        <td rowspan="2" class="label" style="font-size: 8pt; width: 12%;">Alat Standar</td>
                        <td colspan="5" rowspan="2" style="font-size: 8pt; text-align: left; padding-left: 10px;">
                            Multifunction Calibration System "Transmille 1000A"
                        </td>
                        <td colspan="3" class="label" style="font-size: 8pt;">Di Kalibrasi oleh</td>
                        <td colspan="3" class="label" style="font-size: 8pt;">Di Periksa oleh</td>
                    </tr>
                    <tr>
                        <!-- Kosong untuk baris kedua -->
                    </tr>

                    <!-- Baris Metode Kalibrasi -->
                    <tr>
                        <td rowspan="2" class="label" style="font-size: 8pt;">Metode Kalibrasi</td>
                        <td colspan="5" style="text-align: left; padding-left: 10px; font-size: 8pt;">
                            <label>
                                <input type="checkbox" name="metode_1">
                                PAS-IK1102-43 A (Multimeter)
                            </label>
                        </td>
                        <td colspan="3" style="text-align: left; padding-left: 20px; font-size: 8pt;">
                            TTD :
                        </td>
                        <td colspan="3" style="text-align: left; padding-left: 20px; font-size: 8pt;">
                            TTD :
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" style="text-align: left; padding-left: 10px; font-size: 8pt;">
                            <label>
                                <input type="checkbox" name="metode_2">
                                PAS-IK1102-43 B (Clamp Meter)
                            </label>
                        </td>
                        <td colspan="3" style="text-align: left; padding-left: 20px; font-size: 8pt;">
                            Nama: <input type="text" placeholder="Masukkan nama" style="font-size: 8pt;">
                        </td>
                        <td colspan="3" style="text-align: left; padding-left: 20px; font-size: 8pt;">
                            Nama: <input type="text" placeholder="Masukkan nama" style="font-size: 8pt;">
                        </td>
                    </tr>
                </table>

                <!-- ==================== SUBMIT BUTTON ==================== -->
                <div class="row mt-5">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary btn-lg" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
                            <i class="fas fa-save me-2"></i>Simpan Data Kalibrasi
                        </button>

                        <button type="reset" class="btn btn-secondary btn-lg ms-3" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
                            <i class="fas fa-redo me-2"></i>Reset Form
                        </button>
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
        });
    </script>

    <script>
        // Fungsi format Type Alat - menerima huruf, angka, titik, koma, dash, slash, spasi
        function formatTypeAlat(input) {
            const regex = /[^A-Za-z0-9\s.,\-\/()"'&]/g;
            if (regex.test(input.value)) {
                input.value = input.value.replace(regex, '');
            }
        }

        // Fungsi format No. Seri - menerima huruf, angka, titik, koma, dash, slash
        function formatNoSeri(input) {
            const regex = /[^A-Za-z0-9.,\-\/]/g;
            if (regex.test(input.value)) {
                input.value = input.value.replace(regex, '');
            }
        }
    </script>

    <script>
        // Fungsi untuk format input number yang bisa menerima koma
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

        // Event listener untuk menangani paste
        document.addEventListener('DOMContentLoaded', function() {
            const numberInputs = document.querySelectorAll('input[type="number"]');
            numberInputs.forEach(input => {
                input.addEventListener('paste', function(e) {
                    setTimeout(() => {
                        formatInputNumber(this);
                    }, 10);
                });
            });
        });
    </script>

</body>
</html>