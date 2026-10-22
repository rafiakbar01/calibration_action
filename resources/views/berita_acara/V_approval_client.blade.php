<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
       
    <!-- Favicon - Logo PT PAS -->
    <link rel="icon" type="image/png" href="{{ asset('logo/logo_pas_basic.png') }}">
    <link rel="shortcut icon" href="{{ asset('logo/logo_pas_basic.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('logo/logo_pas_basic.png') }}">
    <title>Approval Berita Acara</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background: linear-gradient(135deg, #f8faff 0%, #e0f2fe 100%); /* Putih lembut + hint biru sangat tipis */
            min-height: 100vh;
            padding: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1e293b;
        }

        .container {
            max-width: 1100px;
            width: 100%;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.10);
            animation: fadeIn 0.6s ease-out;
            border: 1px solid #bfdbfe; /* Border tipis biru muda untuk sentuhan PAS */
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .header {
            background: linear-gradient(135deg, #60a5fa 0%, #3b82f6 100%);
            color: white;
            padding: 28px 20px;
            text-align: center;
        }

        .header h1 {
            font-size: clamp(22px, 5vw, 28px);
            margin-bottom: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .no-ba {
            background: rgba(255,255,255,0.25);
            display: inline-block;
            padding: 10px 24px;
            border-radius: 999px;
            font-size: clamp(15px, 4vw, 17px);
            font-weight: 600;
            backdrop-filter: blur(4px);
        }

        .content {
            padding: 28px 24px;
        }

        .info-card {
            background: #f0f9ff;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 28px;
            border-left: 5px solid #60a5fa;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .info-row {
            display: grid;
            grid-template-columns: 140px 1fr;
            gap: 12px;
            margin-bottom: 14px;
            padding-bottom: 12px;
            border-bottom: 1px solid #e0f2fe;
            align-items: baseline;
        }

        @media (max-width: 576px) {
            .info-row {
                grid-template-columns: 1fr;
                gap: 6px;
            }
        }

        .info-label {
            font-weight: 600;
            color: #1d4ed8;
        }

        .info-value {
            color: #1e293b;
            word-break: break-word;
        }

        h3.section-title {
            font-size: clamp(18px, 4.5vw, 22px);
            color: #1d4ed8;
            margin: 0 0 20px;
            font-weight: 600;
        }

        .table-container {
            overflow-x: auto;
            margin: 24px 0;
            border-radius: 12px;
            border: 1px solid #bfdbfe;
            box-shadow: 0 2px 6px rgba(0,0,0,0.04);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14.5px;
            min-width: 680px;
        }

        th {
            background: #eff6ff;
            padding: 14px 12px;
            text-align: center;
            font-weight: 600;
            color: #1d4ed8;
            border-bottom: 2px solid #bfdbfe;
        }

        td {
            padding: 14px 12px;
            text-align: center;
            border-bottom: 1px solid #e0f2fe;
            color: #1e293b;
        }

        tr:last-child td { border-bottom: none; }

        .catatan {
            background: #f0f9ff;
            border-left: 5px solid #60a5fa;
            padding: 18px;
            border-radius: 10px;
            margin: 24px 0;
            font-size: 15px;
            color: #1e40af;
        }

        .approval-section {
            background: #f0f9ff;
            border-radius: 12px;
            padding: 28px 24px;
            margin-top: 32px;
            text-align: center;
            border: 1px solid #bfdbfe;
        }

        .approver-info {
            background: #e0f2fe;
            border-radius: 10px;
            padding: 18px;
            margin-bottom: 24px;
            text-align: left;
            border-left: 5px solid #60a5fa;
        }

        .approver-info h4 {
            color: #1d4ed8;
            margin-bottom: 12px;
            font-size: 17px;
        }

        .approver-detail {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 19px;
            color: #1e40af;
        }

        .approver-detail i {
            font-size: 28px;
            color: #60a5fa;
        }

        .approver-name {
            font-weight: 700;
            color: #1d4ed8;
        }

        .btn-approve {
            background: linear-gradient(135deg, #60a5fa, #3b82f6);
            color: white;
            border: none;
            padding: 16px 40px;
            font-size: 18px;
            font-weight: 700;
            border-radius: 999px;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 6px 20px rgba(96,165,250,0.35);
            width: 100%;
            max-width: 420px;
            margin: 20px auto 12px;
            display: block;
        }

        .btn-approve:hover:not(:disabled) {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(59,130,246,0.5);
        }

        .btn-approve:disabled {
            opacity: 0.65;
            cursor: not-allowed;
        }

        .approve-info {
            margin-top: 24px;
            padding: 20px;
            background: #e0f2fe;
            border-radius: 10px;
            text-align: left;
            border-left: 5px solid #60a5fa;
        }

        .approve-info h4 {
            color: #1d4ed8;
            margin-bottom: 12px;
        }

        .approve-info .label {
            font-weight: 600;
            color: #1d4ed8;
            display: inline-block;
            min-width: 110px;
        }

        .footer {
            background: #f0f9ff;
            padding: 20px;
            text-align: center;
            color: #1d4ed8;
            font-size: 13px;
            border-top: 1px solid #bfdbfe;
        }

        .loading {
            display: inline-block;
            width: 22px;
            height: 22px;
            border: 4px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s linear infinite;
            margin-right: 10px;
            vertical-align: middle;
        }

        @keyframes spin { to { transform: rotate(360deg); } }

        .success-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #60a5fa;
            color: white;
            padding: 10px 24px;
            border-radius: 999px;
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .warning-message {
            background: #e0f2fe;
            color: #1e40af;
            padding: 12px 16px;
            border-radius: 8px;
            margin-top: 12px;
            font-size: 14px;
            border-left: 4px solid #60a5fa;
        }

        @media (max-width: 768px) {
            .content, .approval-section { padding: 20px; }
            .btn-approve { padding: 14px 32px; font-size: 17px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>APPROVAL BERITA ACARA</h1>
            <div class="no-ba">{{ $no_ba }}</div>
        </div>

        <div class="content">
            <div class="info-card">
                 <div class="info-row"><div class="info-label">Tanggal</div><div class="info-value">{{ $header->tanggal_formatted ?? '-' }}</div></div>
                <div class="info-row"><div class="info-label">Perusahaan</div><div class="info-value">{{ $header->perusahaan ?? '-' }}</div></div>
                <div class="info-row"><div class="info-label">Alamat</div><div class="info-value">{{ $header->alamat ?? '-' }}</div></div>
                         <div class="info-row"><div class="info-label">No. Order</div><div class="info-value">{{ $header->no_order ?? '-' }}</div></div>
                <div class="info-row"><div class="info-label">Contact Person</div><div class="info-value">{{ $header->kontak ?? '-' }}</div></div>

       
                <div class="info-row"><div class="info-label">Telp/Fax</div><div class="info-value">{{ $header->telp_fax ?? '-' }}</div></div>
            </div>

            <h3 class="section-title">Daftar Alat ({{ $alatList->count() }} item)</h3>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Nama Alat</th>
                            <th>Merek</th>
                            <th>Tipe</th>
                            <th>Rentang Ukur</th>
                            <th>No. Seri</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alatList as $index => $alat)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $alat->nama_alat ?? '-' }}</td>
                            <td>{{ $alat->merek ?? '-' }}</td>
                            <td>{{ $alat->type_alat ?? '-' }}</td>
                            <td>{{ $alat->kapasitas ?? '-' }}</td>
                            <td>{{ $alat->no_seri ?? '-' }}</td>
                            <td>{{ $alat->keterangan ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($header->catatan)
            <div class="catatan">
                <strong>CATATAN:</strong> {{ $header->catatan }}
            </div>
            @endif

            <div class="approval-section" id="approvalSection">
                <h3 class="section-title">Konfirmasi Approval</h3>

                <div class="approver-info">
                    <h4><i class="fas fa-clipboard-check"></i> Akan Disetujui Atas Nama:</h4>
                    <div class="approver-detail">
                        <i class="fas fa-user-circle"></i>
                        <span class="approver-name">{{ $header->kontak ?? 'Nama tidak tersedia' }}</span>
                    </div>
                    @if(empty($header->kontak))
                    <div class="warning-message">
                        ⚠️ Nama kontak tidak tersedia. Approval tetap dapat diproses.
                    </div>
                    @endif
                </div>

                <p style="color: #1e293b; margin-bottom: 24px; font-size: 15.5px;">
                    Dengan menyetujui, Anda mengkonfirmasi bahwa semua data di atas telah benar dan sesuai.
                </p>

                <button class="btn-approve" onclick="confirmApproval()" id="approveBtn">
                    <i class="fas fa-check"></i> SETUJUI BERITA ACARA
                </button>

                <p style="color: #1d4ed8; font-size: 13.5px; margin-top: 16px;">
                    <i>Atas nama: <strong>{{ $header->kontak ?? 'Client' }}</strong></i>
                </p>
            </div>
        </div>

        <div class="footer">
            PT. PANANJUNG ANUGRAH SOLUTION
        </div>
    </div>

    <!-- Script tetap sama seperti sebelumnya -->
    <script>
        // ... (script konfirmasi dan process approval sama persis seperti versi sebelumnya)
       const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const token = '{{ $token }}';
const no_ba = '{{ $no_ba }}';
const viewUrl = '{{ $viewUrl }}'; // URL ke halaman V_view_pdf
const approverName = '{{ $header->kontak ?? "Client" }}';

function confirmApproval() {
    Swal.fire({
        title: 'Konfirmasi Approval',
        html: `
            <p>Apakah Anda yakin ingin menyetujui Berita Acara : <strong>${no_ba}</strong>?</p>
            <p style="margin: 16px 0; padding: 12px; background: #e0f2fe; border-radius: 10px; border-left: 4px solid #60a5fa;">
                <span style="color: #1d4ed8;">Di Approve Atas nama:</span><br>
                <strong style="font-size: 20px; color: #1e40af;">${approverName}</strong>
            </p>
        `,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#60a5fa',
        cancelButtonColor: '#ef4444',
        confirmButtonText: 'Ya, Setujui!',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            processApproval();
        }
    });
}

async function processApproval() {
    const btn = document.getElementById('approveBtn');
    btn.disabled = true;
    btn.innerHTML = '<span class="loading"></span> Memproses...';

    try {
        const response = await fetch(`/berita-acara/approve/${token}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        });

        const data = await response.json();

        if (data.success) {
            // Tampilkan notifikasi sukses sebentar
            await Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Berita Acara berhasil disetujui. Mengarahkan ke WhatsApp...',
                timer: 1500,
                showConfirmButton: false,
                allowOutsideClick: false
            });
            
            // Format nomor telepon untuk ditampilkan di pesan
            const clientPhone = '{{ $header->client_phone ?? $header->kontak ?? "" }}';
            
            // Format nomor telepon ke format +62 XXX-XXXX-XXXX
            let formattedPhone = '+62 858-8261-6559'; // default
            if (clientPhone) {
                const cleanPhone = clientPhone.replace(/\D/g, '');
                if (cleanPhone.startsWith('62')) {
                    formattedPhone = '+62 ' + 
                        cleanPhone.substring(2, 5) + '-' + 
                        cleanPhone.substring(5, 9) + '-' + 
                        cleanPhone.substring(9, 13);
                } else if (cleanPhone.startsWith('0')) {
                    const withoutZero = cleanPhone.substring(1);
                    formattedPhone = '+62 ' + 
                        withoutZero.substring(0, 3) + '-' + 
                        withoutZero.substring(3, 7) + '-' + 
                        withoutZero.substring(7, 11);
                }
            }
            
            // Format tanggal hari ini (d/m/y)
            const today = new Date();
            const day = today.getDate();
            const month = today.getMonth() + 1;
            const year = today.getFullYear().toString().slice(-2);
            const formattedDate = `${day}/${month}/${year}`;
            
            // Buat pesan dengan viewUrl yang mengarah ke publicViewPdfDirect
            const message = `${no_ba} berhasil ditandatangani secara digital. Klik ${viewUrl} untuk lihat dokumen atau download.`;
            
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
    </script>
</body>
</html>