<!DOCTYPE html>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <meta name="generator" content="Aspose.Words for .NET 26.2.0" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon - Logo PT PAS -->
    <link rel="icon" type="image/png" href="{{ asset('logo/logo_pas_basic.png') }}">
    <link rel="shortcut icon" href="{{ asset('logo/logo_pas_basic.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('logo/logo_pas_basic.png') }}">
    <title>Berita Acara Kalibrasi</title>
    <script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style type="text/css">
        /* CSS ASLI TIDAK DIUBAH */
        body {
            font-family: 'Times New Roman';
            font-size: 12pt;
            margin: 0;
            padding: 15px;
            line-height: 1.2;
        }

        p {
            margin: 0pt
        }

        li,
        table {
            margin-top: 0pt;
            margin-bottom: 0pt
        }

        .header {
            width: 100%;
            position: relative;
            margin-bottom: 5px;
            border-bottom: 2px solid #000;
            padding-bottom: 5px;
            min-height: 100px;
        }

        .logo-left {
            position: absolute;
            left: 0;
            top: -10px;
            width: 160px;
            border-right: 2px solid #000;
            padding-right: 15px;
        }

        .logo-right {
            position: absolute;
            right: 0;
            top: -10px;
            width: 160px;

            padding-left: 15px;
        }

        .company-info {
            margin-left: 190px;
            margin-right: 190px;
            padding-top: 0;
            padding-left: 10px;
        }

        .company-name {
            font-family: 'Courier New';
            font-weight: bold;
            color: #0070c0;
            font-size: 14pt;
            white-space: nowrap;
            margin-top: 0;
        }

        .company-address {
            font-family: 'Courier New';
            font-size: 10pt;
            white-space: nowrap;
            margin-top: 2px;
        }

        .company-detail {
            font-family: 'Courier New';
            font-size: 9pt;
            white-space: nowrap;
            margin-top: 2px;
        }

        .title {
            text-align: center;
            font-size: 12pt;
            margin: 10px 0;
        }

        .title-main {
            font-family: 'Courier New';
            font-weight: bold;
            text-decoration: underline;
            font-size: 13pt;
        }

        .title-sub {
            font-family: 'Courier New';
            font-weight: bold;
            font-style: italic;
            font-size: 11pt;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
            font-family: 'Courier New';
            font-size: 10pt;
        }

        .info-table td {
            padding: 1px 3px;
            vertical-align: top;
        }

        .info-label {
            width: 12%;
            font-weight: bold;
        }

        .info-separator {
            width: 1%;
        }

        .info-value {
            width: 30%;
        }

        .info-underline {
            text-decoration: underline;
            font-weight: bold;
        }

        .main-table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
            table-layout: fixed;
        }

        .main-table th {
            border: 1px solid #000000;
            padding: 6px 3px;
            text-align: center;
            vertical-align: middle;
            font-family: 'Courier New';
            font-weight: bold;
            font-size: 9pt;
            background-color: #f2f2f2;
        }

        .main-table td {
            border: 1px solid #000000;
            padding: 4px 3px;
            vertical-align: top;
            font-family: 'Courier New';
            font-size: 9pt;
        }

        .main-table td:first-child {
            text-align: center;
        }

        .footer-note {
            font-size: 8pt;
            margin: 5px 0;
            text-align: left;
        }

        .footer-note span {
            font-family: 'Courier New';
            font-weight: bold;
            font-style: italic;
            text-decoration: underline;
        }

        .catatan-section {
            margin: 10px 0;
            font-family: 'Courier New';
            font-size: 9pt;
        }

        .catatan-section p {
            margin: 2px 0;
        }

        .signature-wrapper {
            width: 100%;
            margin: 20px 0;
            display: flex;
            justify-content: flex-end;
        }

        .signature-table {
            width: 80%;
            border-collapse: collapse;
        }

        .signature-table td {
            padding: 5px;
            text-align: center;
            font-family: 'Courier New';
            font-size: 11pt;
            vertical-align: middle;
        }

        .signature-line {
            font-style: italic;
        }

        .qr-cell {
            width: 100px;
            text-align: center;
            vertical-align: middle;
        }

        #qrcode {
            width: 90px;
            height: 90px;
            margin: 0 auto;
        }

        .signature-canvas {
            width: 180px;
            height: 90px;
            border: 1px solid #000;
            background-color: #fff;
            touch-action: none;
        }

        .btn-small {
            padding: 3px 8px;
            font-size: 8pt;
            cursor: pointer;
            font-family: 'Courier New';
            background-color: #f0f0f0;
            border: 1px solid #999;
            border-radius: 2px;
            margin: 2px;
        }

        .btn-small:hover {
            background-color: #e0e0e0;
        }

        .btn-clear {
            background-color: #f44336;
            color: white;
            border: none;
        }

        .btn-clear:hover {
            background-color: #da190b;
        }

        .btn-save {
            background-color: #4CAF50;
            color: white;
            border: none;
        }

        .btn-save:hover {
            background-color: #45a049;
        }

        .btn-success {
            background-color: #2196F3;
            color: white;
            border: none;
        }

        .btn-success:hover {
            background-color: #0b7dda;
        }

        .phone-input-small {
            width: 120px;
            padding: 3px;
            font-size: 9pt;
            font-family: 'Courier New';
            border: 1px solid #999;
            margin-right: 5px;
        }

        .client-name-text {
            font-weight: bold;
            font-size: 11pt;
            margin-top: 5px;
        }

        .footer-page {
            text-align: right;
            font-size: 8pt;
            margin-top: 10px;
            clear: both;
        }

        .footer-page span {
            font-family: 'Courier New';
            font-style: italic;
        }

        hr {
            border: none;
            border-top: 2px solid #000;
            margin: 5px 0;
        }

        .status-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 8pt;
            font-weight: bold;
            margin-left: 10px;
        }

        .status-approved {
            background-color: #4CAF50;
            color: white;
        }

        .status-waiting {
            background-color: #FFC107;
            color: black;
        }

        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 20px;
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 9999;
            display: none;
            font-family: 'Courier New';
            font-size: 10pt;
        }

        .notification.error {
            background-color: #f44336;
        }

        .notification.info {
            background-color: #2196F3;
        }

        /* RESPONSIVE TAMBAHAN - TIDAK MENGUBAH POSISI ASLI */
        @media screen and (max-width: 1200px) {
            body {
                padding: 10px;
            }

            .company-info {
                margin-left: 170px;
                margin-right: 170px;
            }
        }

        @media screen and (max-width: 992px) {
            .company-info {
                margin-left: 150px;
                margin-right: 150px;
            }

            .company-name {
                font-size: 12pt;
                white-space: normal;
            }

            .company-address,
            .company-detail {
                font-size: 9pt;
                white-space: normal;
            }

            .signature-table {
                width: 90%;
            }
        }

        @media screen and (max-width: 768px) {
            .logo-left {
                width: 100px;
                top: -5px;
            }

            .logo-right {
                width: 100px;
                top: -5px;
            }

            .company-info {
                margin-left: 120px;
                margin-right: 120px;
            }

            .company-name {
                font-size: 10pt;
            }

            .company-address,
            .company-detail {
                font-size: 8pt;
            }

            .info-table {
                font-size: 8pt;
            }

            .info-label {
                white-space: normal;
            }

            .main-table th {
                font-size: 7pt;
                padding: 4px 2px;
            }

            .main-table td {
                font-size: 7pt;
                padding: 3px 2px;
            }

            #qrcode {
                width: 70px;
                height: 70px;
            }

            .signature-canvas {
                width: 130px;
                height: 70px;
            }

            .signature-table td {
                font-size: 9pt;
                padding: 3px;
            }

            .btn-small {
                padding: 2px 5px;
                font-size: 7pt;
            }

            .phone-input-small {
                width: 80px;
                font-size: 7pt;
                padding: 2px;
            }

            .client-name-text {
                font-size: 9pt;
            }
        }

        @media screen and (max-width: 576px) {
            body {
                padding: 5px;
            }

            .logo-left {
                width: 70px;
                padding-right: 8px;
            }

            .logo-right {
                width: 70px;
                padding-left: 8px;
            }

            .company-info {
                margin-left: 85px;
                margin-right: 85px;
            }

            .company-name {
                font-size: 8pt;
            }

            .company-address,
            .company-detail {
                font-size: 6pt;
            }

            .signature-table {
                width: 100%;
            }

            #qrcode {
                width: 50px;
                height: 50px;
            }

            .signature-canvas {
                width: 90px;
                height: 50px;
            }

            .btn-small {
                padding: 2px 4px;
                font-size: 6pt;
            }

            .phone-input-small {
                width: 60px;
                font-size: 6pt;
            }
        }

        /* Print Styles */
        @media print {

            .btn-small,
            .btn-clear,
            .btn-save {
                display: none;
            }
        }

        .btn-back {
            display: inline-block;
            padding: 8px 20px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 10pt;
            font-family: 'Courier New';
            border: 1px solid;
            transition: all 0.2s;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>

<body>
    <!-- Notification Element -->
    <div id="notification" class="notification"></div>

    <!-- Loading Indicator -->
    <div id="loading" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: rgba(0,0,0,0.8); color: white; padding: 15px 25px; border-radius: 5px; z-index: 10000; font-family: 'Courier New';">
        Memproses...
    </div>

    @php
        $alatArray = [];
        foreach($alatList as $item) {
            $alatArray[] = $item;
        }
        $chunks = array_chunk($alatArray, 10);
        if (empty($chunks)) {
            $chunks = [[]];
        }
        $totalPages = count($chunks);
    @endphp

    @foreach($chunks as $pageIndex => $chunk)
    <div class="page-container" style="{{ $pageIndex < $totalPages - 1 ? 'page-break-after: always; margin-bottom: 50px;' : '' }}">
        <!-- HEADER dengan LOGO Kiri dan Kanan - POSISI TETAP -->
        <div class="header">
            <!-- Logo Kiri dengan Garis Pemisah -->
            <div class="logo-left">
                <img src="{{ asset('logo/logo_pas_basic.png') }}" alt="Logo PAS" style="max-width: 100%; height: auto;">
            </div>

            <!-- Logo Kanan dengan Garis Pemisah -->
            <div class="logo-right">
                <img src="{{ asset('logo/logo_kan.png') }}" alt="Logo PAS" style="max-width: 100%; height: auto;">
            </div>

            <!-- Company Info (Kiri, setelah logo) - POSISI TETAP -->
            <div class="company-info">
                <div class="company-name">PT. PANANJUNG ANUGRAH SOLUTION</div>
                <div class="company-address">SUNTER NIAGA MAS 3 JALAN ANTILOP RAYA BLOK F3 NO. 02</div>
                <div class="company-detail">JABABEKA II, CIKARANG PUSAT 17530 PHONE & FAX +62 21 29083214</div>
                <div class="company-detail">NPWP : 31.309.528.3-413.000 - HTTP : //WWW.PASCALIBRATION.COM</div>
            </div>
        </div>

        <!-- Title - POSISI TETAP -->
        <div class="title">
            <div class="title-main">BERITA ACARA PEKERJAAN KALIBRASI INSITU</div>
            <div class="title-sub">ON-SITE CALIBRATION WORK REPORT</div>
        </div>

        <!-- Info Table dengan Underline - POSISI TETAP -->
        <table class="info-table">
            <tr>
                <td class="info-label">TANGGAL</td>
                <td class="info-separator">:</td>
                <td class="info-value"><span class="info-underline">{{ $header->tanggal_formatted ?? '___ / ___ / ___' }}</span></td>
                <td class="info-label">NO. ORDER</td>
                <td class="info-separator">:</td>
                <td class="info-value"><span class="info-underline">{{ $header->no_order ?? '_____' }}</span></td>
            </tr>
            <tr>
                <td class="info-label">DATE</td>
                <td class="info-separator"></td>
                <td class="info-value"></td>
                <td class="info-label">ORDER NUMBER</td>
                <td class="info-separator"></td>
                <td class="info-value"></td>
            </tr>
            <tr>
                <td class="info-label">PERUSAHAAN</td>
                <td class="info-separator">:</td>
                <td class="info-value"><span class="info-underline">{{ $header->perusahaan ?? '______________________' }}</span></td>
                <td class="info-label">KONTAK</td>
                <td class="info-separator">:</td>
                <td class="info-value"><span class="info-underline">{{ $header->kontak ?? '_____' }}</span></td>
            </tr>
            <tr>
                <td class="info-label">COMPANY</td>
                <td class="info-separator"></td>
                <td class="info-value"></td>
                <td class="info-label">CONTACT PERSON</td>
                <td class="info-separator"></td>
                <td class="info-value"></td>
            </tr>
            <tr>
                <td class="info-label">ALAMAT</td>
                <td class="info-separator">:</td>
                <td class="info-value"><span class="info-underline">{{ $header->alamat ?? '______________________' }}</span></td>
                <td class="info-label">TELP. / FAX</td>
                <td class="info-separator">:</td>
                <td class="info-value"><span class="info-underline">{{ $header->telp_fax ?? '_____' }}</span></td>
            </tr>
            <tr>
                <td class="info-label">ADDRESS</td>
                <td class="info-separator"></td>
                <td class="info-value"></td>
                <td class="info-label">PHONE / FAX</td>
                <td class="info-separator"></td>
                <td class="info-value"></td>
            </tr>
        </table>

        <!-- Main Table untuk Daftar Alat (10 baris) - POSISI TETAP -->
        <div style="overflow-x: auto;">
            <table class="main-table">
                <thead>
                    <tr>
                        <th width="5%">NO</th>
                        <th width="20%">NAMA ALAT<br><span style="font-weight:normal; font-style:italic;">INSTRUMENT*</span></th>
                        <th width="15%">MEREK PABRIK<br><span style="font-weight:normal; font-style:italic;">MANUFACTURE</span></th>
                        <th width="15%">TIPE DATA<br><span style="font-weight:normal; font-style:italic;">TYPE*</span></th>
                        <th width="15%">RENTANG UKUR<br><span style="font-weight:normal; font-style:italic;">RANGE*</span></th>
                        <th width="10%">NO. SERI<br><span style="font-weight:normal; font-style:italic;">SERIAL NUMBER*</span></th>
                        <th width="20%">KETERANGAN<br><span style="font-weight:normal; font-style:italic;">INFORMATION*</span></th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < 10; $i++)
                        @if (isset($chunk[$i]))
                        @php $alat=$chunk[$i]; @endphp
                        <tr>
                        <td>{{ $pageIndex * 10 + $i + 1 }}</td>
                        <td>{{ $alat->nama_alat ?? '' }}</td>
                        <td>{{ $alat->merek ?? '' }}</td>
                        <td>{{ $alat->type_alat ?? '' }}</td>
                        <td>{{ $alat->kapasitas ?? '' }}</td>
                        <td>{{ $alat->no_seri ?? '' }}</td>
                        <td>{{ $alat->keterangan ?? '' }}</td>
                        </tr>
                        @else
                        <tr>
                            <td>{{ $pageIndex * 10 + $i + 1 }}</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        @endif
                    @endfor

                    <!-- BARIS CATATAN/NOTE - MERGE SAMPAI KOLOM KETERANGAN -->
                    <tr>
                        <td colspan="7" style="border: 1px solid #000000; padding: 8px 10px; font-family: 'Courier New'; font-size: 9pt; text-align: left; vertical-align: top; background-color: #f9f9f9;">
                            <div style="font-weight: bold; margin-bottom: 5px;">CATATAN / NOTE :</div>
                            <div style="white-space: pre-wrap; word-wrap: break-word; line-height: 1.4;">{{ $header->catatan ?? '-' }}</div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Footer Note - POSISI TETAP -->
        <div class="footer-note">
            <div class="footer-content">
                <!-- Baris pertama: Nama alat, rentang, no seri - BESAR DAN TEBAL -->
                <div class="alat-info">*NAMA ALAT, RENTANG DAN NO. SERI ALAT WAJIB DIISI OLEH PETUGAS PT. PANANJUNG ANUGRAH SOLUTION</div>

                <!-- Bagian Catatan dengan 2 poin - SEMUA BESAR DAN TEBAL -->
                <div class="catatan-section">
                    <div class="catatan-title">CATATAN :</div>
                    <div class="catatan-item">PETUGAS KALIBRASI TELAH MENYELESAIKAN PEKERJAAN KALIBRASI PERALATAN TERSEBUT DIATAS DAN TELAH DISERAHKAN SEPENUHNYA KEPADA PIHAK KLIEN</div>
                    <div class="catatan-item">PIHAK KLIEN TELAH MENERIMA DENGAN BAIK PEKERJAAN KALIBRASI DAN PENULISAN PERALATAN TERSEBUT BESERTA IDENTITASNYA</div>
                </div>
            </div>
        </div>

        @if($pageIndex == $totalPages - 1)
        <!-- Status Approval -->
        <div style="text-align: right; margin-bottom: 10px;">
            <span id="status-badge" class="status-badge status-waiting">Menunggu Approval</span>
        </div>
        <!-- Signature Table dengan QR Code dan Canvas - POSISI TETAP -->
        <div class="signature-wrapper">
            <table class="signature-table">
                <tr>
                    <td width="25%"><strong>TECHNICAL OFFICER,</strong></td>
                    <td width="25%"><strong>CLIENT,</strong></td>

                </tr>
                <tr>
                    <td style="height: 60px;">{{ $header->request_by ?? '' }}</td>
                    <td style="height: 60px;">
                        <!-- QR Code (kiri) dan Canvas/TTD Image (kanan) dalam satu sel - POSISI TETAP -->
                        <table width="100%" cellpadding="2">
                            <tr>
                                <td width="45%" style="border: 1px solid #ccc; padding: 5px;">
                                    <div id="qrcode" style="width: 80px; height: 80px; margin: 0 auto;"></div>
                                    <div style="font-size: 7pt;">Scan to Approve</div>

                                </td>
                                <td width="55%" style="border: 1px solid #ccc; padding: 5px; position: relative;">
                                    <!-- Canvas untuk input TTD (akan ditampilkan jika status belum approved) -->
                                    <canvas id="signature-pad" class="signature-canvas" style="width: 100%; height: 80px; {{ $header->status === 'approved' ? 'display: none;' : '' }}"></canvas>

                                    <!-- Image untuk menampilkan TTD yang sudah disimpan (hanya untuk metode signature) -->
                                    <img id="saved-signature" class="signature-canvas" src="{{ $header->approval_signature ?? '' }}"
                                        style="width: 100%; height: 80px; object-fit: contain; border: 1px solid #000; background-color: #fff; {{ $header->status === 'approved' && $header->approval_method === 'signature' && $header->approval_signature ? '' : 'display: none;' }}"
                                        alt="Tanda Tangan Client">

                                    <!-- Area kosong untuk QR code approval (tanpa tulisan) -->
                                    <div id="approved-empty" style="width: 100%; height: 80px; border: 1px solid #000; background-color: #fff; {{ $header->status === 'approved' && $header->approval_method !== 'signature' ? 'display: block;' : 'display: none;' }}"></div>

                                    <div style="font-size: 7pt; margin-top: 2px;">TTD Client</div>
                                    <div style="font-size: 6pt; color: #666;">(Manual Approve)</div>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="25%" style="text-align: left;">
                        <!-- Input No WA untuk QR Code - POSISI TETAP -->
                        <div style="margin-bottom: 5px;">
                            <span style="font-size: 8pt; font-weight: bold;">No. WA:</span>
                            <input type="number" id="phone_number" class="phone-input-small" placeholder="08889150150" value="{{ $header->client_phone ?? '' }}" style="width: 100px;" {{ $header->status === 'approved' ? 'disabled' : '' }}>
                        </div>
                        <button class="btn-small btn-clear" onclick="clearSignature()" {{ $header->status === 'approved' ? 'disabled' : '' }}>Clear TTD</button>
                        @if(auth()->check() && auth()->user()->role === 'super admin')
                        <button class="btn-small btn-upload" onclick="document.getElementById('upload-ttd').click()" style="background-color: #2196F3; color: white;" {{ $header->status === 'approved' ? 'disabled' : '' }}>Upload TTD</button>
                        <input type="file" id="upload-ttd" accept="image/*" style="display:none" onchange="handleTTDUpload(event)">
                        @endif
                        <button class="btn-small btn-save" onclick="saveClientApproval()" {{ $header->status === 'approved' ? 'disabled' : '' }}>Save & Approve</button>

                        <!-- Kontrol Ukuran dan Posisi Gambar TTD -->
                        <div id="scale-container" style="display:none; margin-top: 5px; flex-direction: column; gap: 5px; background: #f9f9f9; padding: 5px; border: 1px solid #ddd; border-radius: 4px;">
                            <div style="display: flex; align-items: center; justify-content: space-between;">
                                <span style="font-size: 8pt; font-weight: bold; width: 45px;">Zoom:</span>
                                <input type="range" id="signature-scale" min="0.1" max="5" step="0.1" value="1" style="flex: 1;" oninput="redrawUploadedSignature()">
                            </div>
                            <div style="display: flex; align-items: center; justify-content: space-between;">
                                <span style="font-size: 8pt; font-weight: bold; width: 45px;">X (Kiri):</span>
                                <input type="range" id="signature-x" min="-200" max="200" step="2" value="0" style="flex: 1;" oninput="redrawUploadedSignature()">
                            </div>
                            <div style="display: flex; align-items: center; justify-content: space-between;">
                                <span style="font-size: 8pt; font-weight: bold; width: 45px;">Y (Atas):</span>
                                <input type="range" id="signature-y" min="-100" max="100" step="2" value="0" style="flex: 1;" oninput="redrawUploadedSignature()">
                            </div>
                        </div>

                    </td>
                </tr>
                <tr>
                    <td class="signature-line">_________________</td>
                    <td class="signature-line">____________________</td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td></td>
                    <td class="client-name-text">{{ $header->kontak ?? '_________________________' }}</td>
                    <td colspan="2"></td>
                </tr>
            </table>
        </div>
        @endif
    </div>
    @endforeach
    <!-- Tombol Kembali - Biru -->
    <div style="text-align: left; margin-top: 20px; margin-bottom: 10px;">
        <a href="{{ url()->previous() }}" class="btn-back" style="background-color: #3498db; border-color: #2980b9;">
            ← Kembali
        </a>
    </div>



    <script>
        // CSRF Token untuk semua fetch request
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Definisikan URL di sini
        const approveUrl = "{{ route('berita-acara.approve', ['token' => $header->approval_token]) }}";
        const checkStatusUrl = "{{ route('berita-acara.check-status', ['no_ba' => $no_ba]) }}";
        const no_ba = '{{ $no_ba }}';
        const token = '{{ $header->approval_token ?? "" }}';
        const baseUrl = window.location.origin;
        const viewUrl = '{{ $viewUrl ?? url("/berita-acara/view-pdf-direct/" . $header->approval_token) }}'; // TAMBAHKAN INI
        const approverName = '{{ $header->kontak ?? "Client" }}'; // PINDAHKAN KE SINI


        // Log untuk debugging
        console.log('=== INITIALIZATION ===');
        console.log('approveUrl:', approveUrl);
        console.log('checkStatusUrl:', checkStatusUrl);
        console.log('no_ba:', no_ba);
        console.log('token:', token);

        // Initialize Signature Pad untuk Client
        const canvas = document.getElementById('signature-pad');
        const signaturePad = new SignaturePad(canvas, {
            backgroundColor: 'rgb(255, 255, 255)',
            penColor: 'rgb(0, 0, 0)',
            minWidth: 0.5, // Diubah dari 1 menjadi 0.5
            maxWidth: 1.5, // Diubah dari 2.5 menjadi 1.5
            throttle: 16,
            minDistance: 1
        });

        // Resize canvas
        function resizeCanvas() {
            // Simpan data tanda tangan yang sudah ada (jika ada) sebelum canvas di-resize
            let data = signaturePad ? signaturePad.toData() : null;

            const ratio = Math.max(window.devicePixelRatio || 1, 1);
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            canvas.getContext("2d").scale(ratio, ratio);

            if (signaturePad) {
                signaturePad.clear();
                // Kembalikan goresan tanda tangan setelah canvas disesuaikan ukurannya
                if (data && data.length > 0) {
                    signaturePad.fromData(data);
                }
            }
        }

        window.addEventListener("resize", resizeCanvas);
        resizeCanvas();

        // Flag untuk mendeteksi upload
        let hasUploadedSignature = false;
        let uploadedImageObj = null;

        // Fungsi untuk membersihkan signature
        function clearSignature() {
            signaturePad.clear();
            hasUploadedSignature = false;
            uploadedImageObj = null;
            document.getElementById('scale-container').style.display = 'none';
            document.getElementById('signature-scale').value = 1;
            document.getElementById('signature-x').value = 0;
            document.getElementById('signature-y').value = 0;
            document.getElementById('upload-ttd').value = '';
        }

        // Fungsi untuk redraw gambar berdasarkan skala
        function redrawUploadedSignature() {
            if (!uploadedImageObj) return;

            signaturePad.clear();
            const ctx = canvas.getContext('2d');
            const scale = parseFloat(document.getElementById('signature-scale').value);
            const offsetX = parseFloat(document.getElementById('signature-x').value);
            const offsetY = parseFloat(document.getElementById('signature-y').value);

            // Hitung rasio dasar (agar muat - fit to box)
            const hRatio = canvas.width / uploadedImageObj.width;
            const vRatio = canvas.height / uploadedImageObj.height;
            const baseRatio = Math.min(hRatio, vRatio);

            // Terapkan tambahan skala dari slider
            const finalRatio = baseRatio * scale;

            const newWidth = uploadedImageObj.width * finalRatio;
            const newHeight = uploadedImageObj.height * finalRatio;

            // Selalu taruh di tengah canvas, ditambah offset X dan Y
            const centerShift_x = ((canvas.width - newWidth) / 2) + offsetX;
            const centerShift_y = ((canvas.height - newHeight) / 2) + offsetY;

            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.drawImage(uploadedImageObj, 0, 0, uploadedImageObj.width, uploadedImageObj.height,
                centerShift_x, centerShift_y, newWidth, newHeight);

            hasUploadedSignature = true;
        }

        // Fungsi untuk menangani upload gambar TTD
        function handleTTDUpload(event) {
            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(e) {
                const img = new Image();
                img.onload = function() {
                    uploadedImageObj = img;

                    // Tampilkan slider dan reset valuenya
                    document.getElementById('scale-container').style.display = 'flex';
                    document.getElementById('signature-scale').value = 1;
                    document.getElementById('signature-x').value = 0;
                    document.getElementById('signature-y').value = 0;

                    // Gambar untuk pertama kalinya
                    redrawUploadedSignature();
                };
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }

        // Generate QR Code untuk Public Approval Link
        function generateQRCode() {
            const qrElement = document.getElementById('qrcode');

            if (!qrElement) {
                console.error('QR Element not found');
                return;
            }

            // Kosongkan element dulu
            qrElement.innerHTML = '';

            if (token) {
                const publicUrl = `${baseUrl}/berita-acara/approve/${token}`;
                console.log('Public Approval URL:', publicUrl);

                // Generate QR Code
                new QRCode(qrElement, {
                    text: publicUrl,
                    width: 80,
                    height: 80,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.H
                });

                // Update instruksi
                const qrContainer = document.querySelector('td[width="45%"] div:first-child');
                if (qrContainer) {
                    qrContainer.innerHTML = 'Scan untuk Approve (Public Link)';
                }
            } else {
                console.error('Token tidak ditemukan!');
                qrElement.innerHTML = '<span style="color: red; font-size: 8pt;">Token tidak tersedia</span>';
            }
        }

        // Semua inisialisasi dijalankan setelah halaman siap
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM Content Loaded');

            // Generate QR Code
            setTimeout(generateQRCode, 100); // Delay kecil untuk memastikan elemen siap

            // Cek apakah sudah approved dari data server
            @if($header -> status === 'approved')
            updateStatusBadge('approved');

            // Sembunyikan canvas dan tampilkan gambar
            const canvas = document.getElementById('signature-pad');
            const savedSignature = document.getElementById('saved-signature');

            if (canvas) canvas.style.display = 'none';
            if (savedSignature) {
                savedSignature.src = '{{ $header->approval_signature ?? "" }}';
                savedSignature.style.display = 'block';
            }\

            // Disable input phone
            const phoneInput = document.getElementById('phone_number');
            if (phoneInput) {
                phoneInput.value = '{{ $header->client_phone ?? "" }}';
                phoneInput.disabled = true;
            }
            @endif
        });

        // Fungsi untuk membersihkan signature
        function clearSignature() {
            signaturePad.clear();
        }

        // Show/hide loading
        function showLoading(show = true) {
            document.getElementById('loading').style.display = show ? 'block' : 'none';
        }

        // Notification function
        function showNotification(message, type = 'success') {
            const notification = document.getElementById('notification');
            notification.textContent = message;
            notification.className = 'notification';

            if (type === 'success') {
                notification.style.backgroundColor = '#4CAF50';
            } else if (type === 'error') {
                notification.style.backgroundColor = '#f44336';
            } else if (type === 'info') {
                notification.style.backgroundColor = '#2196F3';
            }

            notification.style.display = 'block';

            setTimeout(() => {
                notification.style.display = 'none';
            }, 5000);
        }

        // Update status badge
        function updateStatusBadge(status) {
            const badge = document.getElementById('status-badge');
            if (status === 'approved') {
                badge.className = 'status-badge status-approved';
                badge.textContent = '✓ DISETUJUI';

                // Disable semua button
                document.querySelectorAll('.btn-small').forEach(btn => {
                    btn.disabled = true;
                    btn.style.opacity = '0.5';
                    btn.style.cursor = 'not-allowed';
                });

                // Disable input phone
                const phoneInput = document.getElementById('phone_number');
                if (phoneInput) {
                    phoneInput.disabled = true;
                }

                // Disable signature pad
                signaturePad.off();
            } else {
                badge.className = 'status-badge status-waiting';
                badge.textContent = 'Menunggu Approval';
            }
        }

        // Fungsi untuk approve via server (khusus TTD)
        async function approveBeritaAcara(no_ba, method, clientPhone = null, signature = null) {
            // Bersihkan nomor telepon jika ada
            let cleanPhone = clientPhone ? clientPhone.replace(/\D/g, '') : null;

            const approvalData = {
                no_ba: no_ba,
                approval_method: method, // 'signature'
                client_phone: cleanPhone, // NOMOR DARI INPUT USER
                signature: signature
            };

            console.log('Sending approval data:', approvalData);

            try {
                const response = await fetch(`/berita-acara/approve/${token}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(approvalData)
                });

                if (!response.ok) {
                    const errorText = await response.text();
                    console.error('Server response:', errorText);
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const data = await response.json();
                console.log('Approval response:', data);

                if (data.success) {
                    updateStatusBadge('approved');

                    // Tampilkan gambar TTD
                    const canvas = document.getElementById('signature-pad');
                    const savedSignature = document.getElementById('saved-signature');
                    const approvedEmpty = document.getElementById('approved-empty');

                    if (canvas) canvas.style.display = 'none';
                    if (approvedEmpty) approvedEmpty.style.display = 'none';

                    if (savedSignature && data.data.signature_url) {
                        savedSignature.src = data.data.signature_url;
                        savedSignature.style.display = 'block';
                    }

                    // Tampilkan notifikasi sukses
                    await Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Berita Acara berhasil disetujui. Mengirim notifikasi ke admin...',
                        timer: 2000,
                        showConfirmButton: false
                    });

                    // === FORMAT PESAN YANG DIMINTA ===
                    // Format: No client|no_ba (dibawah nya no ba) link pdf nya
                    const message = `${cleanPhone}|${no_ba}\n${viewUrl}\n Terima Kasih sudah menjadikan PT.PAS, Mitra Laboratorium Kalibrasi Terpercaya Anda.Bukan Sekedar Kalibrasi !!)`;

                    // Redirect ke WhatsApp admin
                    const adminPhone = '628889150150';
                    const waUrl = `https://wa.me/${adminPhone}?text=${encodeURIComponent(message)}`;

                    // Redirect ke WhatsApp
                    window.location.href = waUrl;

                    return true;
                } else {
                    throw new Error(data.message || 'Gagal menyetujui');
                }
            } catch (error) {
                console.error('Error:', error);

                await Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: error.message,
                    confirmButtonColor: '#d33'
                });
                return false;
            }
        }

        // Fungsi untuk menambahkan tombol lihat PDF dan download
        function addPDFViewButton(pdfData) {
            let infoDiv = document.getElementById('approval-info');
            if (!infoDiv) {
                infoDiv = document.createElement('div');
                infoDiv.id = 'approval-info';
                infoDiv.style.marginTop = '10px';
                infoDiv.style.fontSize = '8pt';
                infoDiv.style.color = '#4CAF50';
                infoDiv.style.textAlign = 'left';

                const lastCell = document.querySelector('.signature-table td:last-child');
                if (lastCell) {
                    lastCell.appendChild(infoDiv);
                }
            }

            // Kosongkan infoDiv dulu
            infoDiv.innerHTML = '';

            // Tombol Lihat PDF
            const viewButton = document.createElement('a');
            viewButton.href = pdfData.url;
            viewButton.target = '_blank';
            viewButton.innerHTML = '📄 Lihat PDF';
            viewButton.style.display = 'inline-block';
            viewButton.style.marginRight = '5px';
            viewButton.style.padding = '3px 8px';
            viewButton.style.backgroundColor = '#4CAF50';
            viewButton.style.color = 'white';
            viewButton.style.textDecoration = 'none';
            viewButton.style.borderRadius = '3px';
            viewButton.style.fontSize = '8pt';

            // Tombol Download
            const downloadButton = document.createElement('a');
            downloadButton.href = `/berita-acara/download-pdf/${pdfData.no_ba}`;
            downloadButton.innerHTML = '⬇️ Download PDF';
            downloadButton.style.display = 'inline-block';
            downloadButton.style.padding = '3px 8px';
            downloadButton.style.backgroundColor = '#2196F3';
            downloadButton.style.color = 'white';
            downloadButton.style.textDecoration = 'none';
            downloadButton.style.borderRadius = '3px';
            downloadButton.style.fontSize = '8pt';
            downloadButton.style.marginLeft = '5px';

            infoDiv.appendChild(viewButton);
            infoDiv.appendChild(downloadButton);
        }

        // Fungsi untuk mengirim notifikasi WhatsApp
        function sendWANotification(no_ba, clientPhone, method) {
            const adminPhone = '628889150150';

            let formattedPhone = clientPhone;
            if (formattedPhone && formattedPhone.startsWith('0')) {
                formattedPhone = '62' + formattedPhone.substring(1);
            }

            const message = no_ba;
            const waUrl = `https://wa.me/${adminPhone}?text=${encodeURIComponent(message)}`;

            window.open(waUrl, '_blank');
            console.log('WA Notification URL:', waUrl);
        }

        // Fungsi untuk menyimpan approval client (manual dengan TTD)
        async function saveClientApproval() {
            const clientPhone = document.getElementById('phone_number').value.trim();
            const no_ba = '{{ $no_ba }}';

            // Validasi nomor telepon
            if (!clientPhone) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Nomor telepon client harus diisi',
                    timer: 2000,
                    showConfirmButton: false
                });
                document.getElementById('phone_number').focus();
                return;
            }

            // Validasi format nomor
            const phoneDigits = clientPhone.replace(/\D/g, '');
            if (phoneDigits.length < 10) {
                Swal.fire({
                    icon: 'error',
                    title: 'Nomor Tidak Valid',
                    text: 'Nomor telepon minimal 10 digit',
                    timer: 2000,
                    showConfirmButton: false
                });
                document.getElementById('phone_number').focus();
                return;
            }

            // Validasi tanda tangan
            if (signaturePad.isEmpty()) {
                Swal.fire({
                    icon: 'error',
                    title: 'Tanda Tangan Kosong',
                    text: 'Tanda tangan harus diisi',
                    timer: 2000,
                    showConfirmButton: false
                });
                return;
            }

            // KONFIRMASI DENGAN SWEETALERT
            const result = await Swal.fire({
                title: 'Konfirmasi Approval',
                html: `
            <p>Apakah Anda yakin ingin menyetujui Berita Acara <strong>${no_ba}</strong>?</p>
            <p style="margin-top: 15px; padding: 10px; background: #f0f8ff; border-radius: 8px;">
                <span style="color: #1976D2;">Atas nama:</span><br>
                <strong style="font-size: 18px; color: #4CAF50;">{{ $header->kontak ?? 'Client' }}</strong>
            </p>
            <p style="margin-top: 10px; color: #666;">Nomor WA: <strong>${clientPhone}</strong></p>
        `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#4CAF50',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Setujui!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            });

            if (!result.isConfirmed) {
                Swal.fire({
                    icon: 'info',
                    title: 'Dibatalkan',
                    text: 'Approval dibatalkan',
                    timer: 1500,
                    showConfirmButton: false
                });
                return;
            }

            // JIKA SETUJU, TAMPILKAN LOADING SWEETALERT
            Swal.fire({
                title: 'Memproses Approval...',
                html: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Ambil data signature
            const signatureData = signaturePad.toDataURL('image/png');

            // Kirim approval ke endpoint public
            await approveBeritaAcara(no_ba, 'signature', clientPhone, signatureData);
        }
        // Handle orientation change
        window.addEventListener('orientationchange', function() {
            setTimeout(resizeCanvas, 100);
        });

        // Fungsi checkApprovalStatus
        async function checkApprovalStatus() {
            try {
                const response = await fetch(checkStatusUrl, {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                });
                const data = await response.json();

                if (data.success && data.approved) {
                    updateStatusBadge('approved');

                    // Sembunyikan canvas dan tampilkan status sesuai metode
                    const canvas = document.getElementById('signature-pad');
                    const savedSignature = document.getElementById('saved-signature');
                    const approvedEmpty = document.getElementById('approved-empty');
                    const phoneInput = document.getElementById('phone_number');

                    if (canvas) canvas.style.display = 'none';

                    // Jika approve dengan signature, tampilkan gambar
                    if (data.approval_data?.method === 'signature' && data.approval_data?.signature_url) {
                        if (savedSignature) {
                            savedSignature.src = data.approval_data.signature_url;
                            savedSignature.style.display = 'block';
                        }
                        if (approvedEmpty) approvedEmpty.style.display = 'none';
                    }
                    // Jika approve dengan method lain (whatsapp/public_link), tampilkan area kosong
                    else {
                        if (savedSignature) savedSignature.style.display = 'none';
                        if (approvedEmpty) approvedEmpty.style.display = 'block';
                    }

                    if (phoneInput && data.approval_data?.client_phone) {
                        phoneInput.value = data.approval_data.client_phone;
                        phoneInput.disabled = true;
                    }
                }
            } catch (error) {
                console.error('Error checking status:', error);
            }
        }

        // Check status pertama kali dan setiap 5 detik
        checkApprovalStatus();
        setInterval(checkApprovalStatus, 5000);

        // ===== QR CODE GENERATION - DEBUG VERSION =====
        setTimeout(function() {
            console.log('🔄 Mencoba generate QR Code...');

            const qrElement = document.getElementById('qrcode');
            console.log('QR Element:', qrElement);

            if (!qrElement) {
                console.error('❌ ELEMENT TIDAK DITEMUKAN!');
                return;
            }

            const token = '{{ $header->approval_token ?? "" }}';
            console.log('Token dari server:', token);

            if (!token) {
                console.error('❌ TOKEN KOSONG!');
                qrElement.innerHTML = '❌ Token tidak ada';
                return;
            }

            const publicUrl = `${window.location.origin}/berita-acara/approve/${token}`;
            console.log('URL:', publicUrl);

            qrElement.innerHTML = '';

            new QRCode(qrElement, {
                text: publicUrl,
                width: 80,
                height: 80
            });

            console.log('✅ QR Code generated!');
        }, 500); // Delay 500ms

        async function processApproval() {
            const btn = document.getElementById('approveBtn');

            btn.disabled = true;
            btn.innerHTML = '<span class="loading"></span> Memproses...';

            try {
                // UNTUK QR CODE - TIDAK ADA SIGNATURE
                const approvalData = {
                    no_ba: no_ba,
                    approval_method: 'whatsapp', // SET METHOD = WHATSAPP
                    client_phone: null, // QR CODE TIDAK ADA NOMOR
                    signature: null
                };

                const response = await fetch(`/berita-acara/approve/${token}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify(approvalData)
                });

                const data = await response.json();

                if (data.success) {
                    // Tampilkan notifikasi sukses
                    await Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Berita Acara berhasil disetujui. Mengarahkan ke WhatsApp...',
                        timer: 2000,
                        showConfirmButton: false
                    });

                    // Buat pesan dengan viewUrl global - TANPA NOMOR TELEPON
                    const message = `${no_ba} berhasil ditandatangani secara digital. Klik ${viewUrl} untuk lihat dokumen atau download Berita Acara Onsite.`;

                    // Redirect ke WhatsApp admin
                    const adminPhone = '628889150150';
                    const waUrl = `https://wa.me/${adminPhone}?text=${encodeURIComponent(message)}`;

                    // Redirect ke WhatsApp
                    window.location.href = waUrl;

                } else {
                    throw new Error(data.message || 'Terjadi kesalahan');
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: error.message
                });

                btn.disabled = false;
                btn.innerHTML = '✓ SETUJUI BERITA ACARA';
            }
        }
        // Update tampilan setelah approve via QR code (tanpa tulisan)
        function updateAfterQRApprove() {
            const canvas = document.getElementById('signature-pad');
            const savedSignature = document.getElementById('saved-signature');
            const approvedEmpty = document.getElementById('approved-empty');
            const phoneInput = document.getElementById('phone_number');
            const saveBtn = document.querySelector('.btn-save');
            const clearBtn = document.querySelector('.btn-clear');

            if (canvas) canvas.style.display = 'none';
            if (savedSignature) savedSignature.style.display = 'none';
            if (approvedEmpty) approvedEmpty.style.display = 'block';

            if (phoneInput) {
                phoneInput.disabled = true;
            }

            if (saveBtn) {
                saveBtn.disabled = true;
                saveBtn.style.opacity = '0.5';
            }

            if (clearBtn) {
                clearBtn.disabled = true;
                clearBtn.style.opacity = '0.5';
            }

            if (signaturePad) {
                signaturePad.off();
            }

            updateStatusBadge('approved');
        }

        function confirmApproval() {
            Swal.fire({
                title: 'Konfirmasi Approval',
                html: `
            <p>Apakah Anda yakin ingin menyetujui Berita Acara <strong>${no_ba}</strong>?</p>
            <p style="margin-top: 15px; padding: 10px; background: #f0f8ff; border-radius: 8px;">
                <span style="color: #1976D2;">Atas nama:</span><br>
                <strong style="font-size: 18px; color: #4CAF50;">${approverName}</strong>
            </p>
        `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#4CAF50',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Setujui!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    processApproval();
                }
            });
        }
        // Event listener untuk input nomor telepon
        document.getElementById('phone_number').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    </script>
</body>

</html>