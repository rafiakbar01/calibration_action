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
    <title>Berita Acara Kalibrasi - {{ $no_ba }}</title>
    <style type="text/css">
        /* CSS DIPERKECIL UNTUK 1 HALAMAN PENUH */
        body {
            font-family: 'Times New Roman';
            font-size: 10pt; /* Diperkecil dari 12pt */
            margin: 0;
            padding: 10px; /* Diperkecil dari 15px */
            line-height: 1.1;
        }
        p {
            margin: 0pt
        }
        li, table {
            margin-top: 0pt;
            margin-bottom: 0pt
        }
        .header {
            width: 100%;
            position: relative;
            margin-bottom: 3px; /* Diperkecil */
            border-bottom: 1px solid #000; /* Lebih tipis */
            padding-bottom: 3px;
            min-height: 80px; /* Diperkecil dari 100px */
        }
        .logo-left {
            position: absolute;
            left: 0;
            top: -5px;
            width: 130px; /* Diperkecil dari 160px */
            border-right: 1px solid #000;
            padding-right: 10px;
        }
        .logo-right {
            position: absolute;
            right: 0;
            top: -5px;
            width: 130px; /* Diperkecil dari 160px */
            padding-left: 10px;
        }
        .company-info {
            margin-left: 155px; /* Disesuaikan */
            margin-right: 155px; /* Disesuaikan */
            padding-top: 0;
            padding-left: 5px;
        }
        .company-name {
            font-family: 'Courier New';
            font-weight: bold;
            color: #0070c0;
            font-size: 12pt; /* Diperkecil dari 14pt */
            white-space: nowrap;
            margin-top: 0;
        }
        .company-address {
            font-family: 'Courier New';
            font-size: 9pt; /* Diperkecil dari 10pt */
            white-space: nowrap;
            margin-top: 1px;
        }
        .company-detail {
            font-family: 'Courier New';
            font-size: 8pt; /* Diperkecil dari 9pt */
            white-space: nowrap;
            margin-top: 1px;
        }
        .title {
            text-align: center;
            font-size: 11pt; /* Diperkecil dari 12pt */
            margin: 5px 0; /* Diperkecil */
        }
        .title-main {
            font-family: 'Courier New';
            font-weight: bold;
            text-decoration: underline;
            font-size: 12pt; /* Diperkecil dari 13pt */
        }
        .title-sub {
            font-family: 'Courier New';
            font-weight: bold;
            font-style: italic;
            font-size: 10pt; /* Diperkecil dari 11pt */
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin: 5px 0; /* Diperkecil dari 10px */
            font-family: 'Courier New';
            font-size: 9pt; /* Diperkecil dari 10pt */
        }
        .info-table td {
            padding: 1px 2px; /* Diperkecil */
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
            margin: 5px 0; /* Diperkecil dari 10px */
            table-layout: fixed;
        }
        .main-table th {
            border: 1px solid #000000;
            padding: 4px 2px; /* Diperkecil dari 6px */
            text-align: center;
            vertical-align: middle;
            font-family: 'Courier New';
            font-weight: bold;
            font-size: 8pt; /* Diperkecil dari 9pt */
            background-color: #f2f2f2;
        }
        .main-table td {
            border: 1px solid #000000;
            padding: 3px 2px; /* Diperkecil dari 4px */
            vertical-align: top;
            font-family: 'Courier New';
            font-size: 8pt; /* Diperkecil dari 9pt */
        }
        .main-table td:first-child {
            text-align: center;
        }
        .footer-note {
            font-size: 7pt; /* Diperkecil dari 8pt */
            margin: 3px 0; /* Diperkecil */
            text-align: left;
        }
       .footer-note .alat-info {
            font-family: 'Courier New';
            font-weight: bold;
            font-style: italic;
            text-decoration: underline;
            margin-bottom: 15px; /* TAMBAHKAN JARAK 15px KE BAWAH */
        }
        
        .catatan-section {
            margin: 5px 0 0 0; /* margin-top: 5px untuk jarak dari alat-info */
            font-family: 'Courier New';
            font-size: 8pt;
        }
        .catatan-title {
            font-weight: bold;
            margin-bottom: 1px;
        }
        .catatan-item {
            margin: 1px 0;
            font-weight: bold;
            font-size: 7.5pt; /* Lebih kecil */
        }
        .signature-wrapper {
            width: 100%;
            margin: 5px 0 0 0; /* Diperkecil */
            display: flex;
            justify-content: flex-end;
            align-items: flex-end;
        }
        .signature-table {
            width: 45%; /* Diperkecil dari 50% */
            border-collapse: collapse;
        }
        .signature-table td {
            padding: 2px 3px; /* Diperkecil */
            text-align: center;
            font-family: 'Courier New';
            font-size: 9pt; /* Diperkecil dari 11pt */
            vertical-align: middle;
        }
        .signature-line {
            font-style: italic;
        }
        .signature-image {
            max-width: 120px; /* Diperkecil */
            max-height: 50px; /* Diperkecil */
            object-fit: contain;
        }
        .client-name-text {
            font-weight: bold;
            font-size: 9pt; /* Diperkecil dari 11pt */
            margin-top: 2px;
        }
        .footer-page {
            text-align: right;
            font-size: 7pt; /* Diperkecil dari 8pt */
            margin-top: 3px; /* Diperkecil */
            clear: both;
        }
        .footer-page span {
            font-family: 'Courier New';
            font-style: italic;
        }
        hr {
            border: none;
            border-top: 1px solid #000; /* Lebih tipis */
            margin: 3px 0;
        }
        .status-badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 7pt;
            font-weight: bold;
        }
        .status-approved {
            background-color: #4CAF50;
            color: white;
        }
        .approval-stamp {
            display: inline-block;
            padding: 3px 8px; /* Diperkecil */
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
            font-size: 11pt; /* Diperkecil dari 14pt */
            border-radius: 4px;
            border: 1px solid #2E7D32;
        }

        /* Print Styles */
        @media print {
            body {
                padding: 5px;
            }
        }
    </style>
</head>
<body>
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
    <div class="page-container" style="{{ $pageIndex < $totalPages - 1 ? 'page-break-after: always;' : '' }}">
    <!-- HEADER dengan LOGO Kiri dan Kanan -->
        <div class="header">

      <!-- Logo Kiri -->
<div class="logo-left">
    @php
        $logoKiriPath = public_path('logo/logo_pas_basic.png');
        if (file_exists($logoKiriPath)) {
            $logoKiriData = base64_encode(file_get_contents($logoKiriPath));
            $logoKiriSrc = 'data:image/png;base64,' . $logoKiriData;
        } else {
            // Fallback jika file tidak ada
            $logoKiriSrc = '';
        }
    @endphp
    @if($logoKiriSrc)
        <img src="{{ $logoKiriSrc }}" alt="Logo PAS" style="max-width: 100%; height: auto;">
    @else
        <div style="color: red; font-size: 8pt;">[Logo tidak tersedia]</div>
    @endif
</div>

<!-- Logo Kanan -->
<div class="logo-right">
    @php
        $logoKanPath = public_path('logo/logo_kan.png');
        if (file_exists($logoKanPath)) {
            $logoKanData = base64_encode(file_get_contents($logoKanPath));
            $logoKanSrc = 'data:image/png;base64,' . $logoKanData;
        } else {
            // Fallback ke logo kiri jika logo kanan tidak ada
            $logoKanSrc = $logoKiriSrc ?? '';
        }
    @endphp
    @if($logoKanSrc)
        <img src="{{ $logoKanSrc }}" alt="Logo KAN" style="max-width: 100%; height: auto;">
    @else
        <div style="color: red; font-size: 8pt;">[Logo tidak tersedia]</div>
    @endif
</div>
        <!-- Company Info (Kiri, setelah logo) - POSISI TETAP -->
        <div class="company-info">
            <div class="company-name">PT. PANANJUNG ANUGRAH SOLUTION</div>
            <div class="company-address">SUNTER NIAGA MAS 3 JALAN ANTILOP RAYA BLOK F3 NO. 02</div>
            <div class="company-detail">JABABEKA II, CIKARANG PUSAT 17530 PHONE & FAX +62 21 29083214</div>
            <div class="company-detail">NPWP : 31.309.528.3-413.000 - HTTP : //WWW.PASCALIBRATION.COM</div>
        </div>
    </div>

    <!-- Title -->
    <div class="title">
        <div class="title-main">BERITA ACARA PEKERJAAN KALIBRASI INSITU</div>
        <div class="title-sub">ON-SITE CALIBRATION WORK REPORT</div>
    </div>

    <!-- Info Table (3 baris) -->
    <table class="info-table">
        <tr>
            <td class="info-label">TANGGAL</td>
            <td class="info-separator">:</td>
            <td class="info-value"><span class="info-underline">{{ $header->tanggal_formatted ?? '___/___/___' }}</span></td>
            <td class="info-label">NO. ORDER</td>
            <td class="info-separator">:</td>
            <td class="info-value"><span class="info-underline">{{ $header->no_order ?? '_____' }}</span></td>
        </tr>
        <tr>
            <td class="info-label">PERUSAHAAN</td>
            <td class="info-separator">:</td>
            <td class="info-value"><span class="info-underline">{{ $header->perusahaan ?? '__________________' }}</span></td>
            <td class="info-label">KONTAK</td>
            <td class="info-separator">:</td>
            <td class="info-value"><span class="info-underline">{{ $header->kontak ?? '_____' }}</span></td>
        </tr>
        <tr>
            <td class="info-label">ALAMAT</td>
            <td class="info-separator">:</td>
            <td class="info-value"><span class="info-underline">{{ $header->alamat ?? '__________________' }}</span></td>
            <td class="info-label">TELP. / FAX</td>
            <td class="info-separator">:</td>
            <td class="info-value"><span class="info-underline">{{ $header->telp_fax ?? '_____' }}</span></td>
        </tr>
    </table>

    <!-- Main Table Daftar Alat (10 baris) + Catatan -->
    <div style="overflow-x: auto;">
        <table class="main-table">
            <thead>
                <tr>
                    <th width="5%">NO</th>
                    <th width="20%">NAMA ALAT<br><span style="font-weight:normal;">INSTRUMENT*</span></th>
                    <th width="15%">MEREK<br><span style="font-weight:normal;">MANUFACTURE</span></th>
                    <th width="12%">TIPE<br><span style="font-weight:normal;">TYPE*</span></th>
                    <th width="15%">RENTANG<br><span style="font-weight:normal;">RANGE*</span></th>
                    <th width="13%">NO. SERI<br><span style="font-weight:normal;">SERIAL*</span></th>
                    <th width="20%">KETERANGAN<br><span style="font-weight:normal;">INFORMATION*</span></th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < 10; $i++)
                    @if (isset($chunk[$i]))
                        @php $alat = $chunk[$i]; @endphp
                        <tr>
                            <td>{{ $pageIndex * 10 + $i + 1 }}</td>
                            <td>{{ $alat->nama_alat ?? '' }}</td>
                            <td>{{ $alat->merek ?? '' }}</td>
                            <td>{{ $alat->type_alat ?? '' }}</td>
                            <td>{{ !empty($alat->rentang_ukur) ? $alat->rentang_ukur : ($alat->kapasitas ?? '') }}</td>
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
                
                <!-- BARIS CATATAN/NOTE -->
                <tr>
                    <td colspan="7" style="border: 1px solid #000000; padding: 5px 8px; font-family: 'Courier New'; font-size: 8pt; text-align: left; vertical-align: top; background-color: #f9f9f9;">
                        <div style="font-weight: bold; margin-bottom: 2px;">CATATAN / NOTE :</div>
                        <div style="white-space: pre-wrap; word-wrap: break-word; line-height: 1.3;">{{ $header->catatan ?? '' }}</div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Footer Note -->
    <div class="footer-note">
        <div class="footer-content">
            <div class="alat-info">*NAMA ALAT, RENTANG DAN NO. SERI ALAT WAJIB DIISI OLEH PETUGAS PT. PANANJUNG ANUGRAH SOLUTION</div>
            <div class="catatan-section">
                <div class="catatan-title">CATATAN :</div>
                <div class="catatan-item">• PETUGAS KALIBRASI TELAH MENYELESAIKAN PEKERJAAN KALIBRASI PERALATAN TERSEBUT DIATAS DAN TELAH DISERAHKAN SEPENUHNYA KEPADA PIHAK KLIEN.</div>
                <div class="catatan-item">• PIHAK KLIEN TELAH MENERIMA DENGAN BAIK PEKERJAAN KALIBRASI DAN PENULISAN PERALATAN TERSEBUT BESERTA IDENTITASNYA.</div>
            </div>
        </div>
    </div>

    @if($pageIndex == $totalPages - 1)
  <!-- Signature Table - POJOK KANAN BAWAH -->
<div class="signature-wrapper" style="width: 100%; margin-top: 15px; display: flex; justify-content: flex-end; float: none; clear: both;">
    <table class="signature-table" style="width: 45%; border-collapse: collapse; margin-left: auto; margin-right: 0;">
        <tr>
            <td width="50%" style="text-align: center;"><strong>TECHNICAL OFFICER,</strong></td>
            <td width="50%" style="text-align: center;"><strong>CLIENT,</strong></td>
        </tr>
        <tr>
            <td style="height: 60px; vertical-align: middle; text-align: center; font-size: 9pt;">
                {{ $header->request_by ?? '_________________' }}
            </td>
            <td style="height: 60px; vertical-align: middle; text-align: center;">
                @if($header->status === 'approved')
                    @if($header->approval_method === 'signature' && $header->approval_signature)
                        @php
                            // Ambil nama file dari URL
                            $urlParts = explode('/', $header->approval_signature);
                            $filename = end($urlParts);
                            // Buat path lokal
                            $localPath = public_path('img_ttd/' . $filename);
                            
                            // Konversi ke base64
                            $imageData = '';
                            $imageSrc = '';
                            
                            if (file_exists($localPath)) {
                                $imageData = base64_encode(file_get_contents($localPath));
                                $imageSrc = 'data:image/png;base64,' . $imageData;
                            }
                        @endphp
                        
                        @if($imageSrc)
                            <img src="{{ $imageSrc }}" 
                                 style="max-width: 120px; max-height: 50px; object-fit: contain;" 
                                 alt="Tanda Tangan Client">
                        @else
                            <span style="color: red; font-size: 8pt;">[File tidak ditemukan]</span>
                        @endif
                    @else
                        <span style="display: inline-block; padding: 3px 8px; background-color: #4CAF50; color: white; font-weight: bold; font-size: 11pt; border-radius: 4px;">APPROVED</span>
                    @endif
                @else
                    <span style="color: #999; font-size: 8pt;">[ Belum Disetujui ]</span>
                @endif
            </td>
        </tr>
        <tr>
            <td style="text-align: center; font-style: italic;">_________________</td>
            <td style="text-align: center; font-style: italic;">____________________</td>
        </tr>
        <tr>
            <td style="text-align: center; font-size: 8pt;">{{ $header->request_by ?? '' }}</td>
            <td style="text-align: center; font-weight: bold; font-size: 9pt;">{{ $header->kontak ?? '_________________' }}</td>
        </tr>
    </table>
</div>
    @endif
    </div>
    @endforeach

    
</body>
</html>