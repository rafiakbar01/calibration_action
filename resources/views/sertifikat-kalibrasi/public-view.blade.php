<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Sertifikat Kalibrasi - PAS Calibration</title>
    <link rel="icon" href="{{ asset('logo/logo_pas_basic.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #ffffff;
            --sidebar-bg: #f8fafc;
            --card-bg: #ffffff;
            --border-color: #e2e8f0;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --accent-blue: #2563eb;
            --accent-emerald: #10b981;
            --accent-rose: #ef4444;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        /* Layout Split Screen 35:65 */
        .page-container {
            min-height: 100vh;
        }

        .sidebar {
            width: 100%;
            background-color: var(--sidebar-bg);
            border-right: 1px solid var(--border-color);
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            padding: 24px;
        }

        .viewer-container {
            flex-grow: 1;
            background-color: #e2e8f0;
            position: relative;
        }

        @media (min-width: 768px) {
            .page-container {
                display: flex;
                flex-direction: row;
                height: 100vh;
                overflow: hidden;
            }
            .sidebar {
                width: 35%;
                min-width: 350px;
                max-width: 480px;
                height: 100vh;
                padding: 36px;
            }
            .viewer-container {
                width: 65%;
                height: 100vh;
            }
        }

        @media (max-width: 767.98px) {
            .sidebar {
                border-right: none;
                border-bottom: 1px solid var(--border-color);
                padding: 20px;
            }
            .viewer-container {
                height: 80vh;
            }
        }

        /* Brand Styling */
        .brand-section {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 32px;
        }
        .brand-logo {
            height: 52px;
            width: auto;
            object-fit: contain;
        }
        .brand-title {
            font-weight: 800;
            font-size: 1.6rem;
            letter-spacing: -0.5px;
            color: var(--text-main);
        }

        /* Status Box */
        .status-box-success {
            background-color: #e6f4ea;
            border: 1px solid #a3cfbb;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 24px;
        }
        .status-box-error {
            background-color: #fdf2f2;
            border: 1px solid #f8b4b4;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 24px;
        }

        /* Document Verification Large Icon */
        .verify-icon-wrapper {
            width: 140px;
            height: 140px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            margin: 24px auto;
        }
        .verify-doc-icon {
            width: 80px;
            height: 105px;
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: white;
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.2);
            position: relative;
        }
        .verify-doc-icon-error {
            width: 80px;
            height: 105px;
            background: linear-gradient(135deg, #f43f5e 0%, #9f1239 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: white;
            box-shadow: 0 10px 25px rgba(244, 63, 94, 0.2);
            position: relative;
        }
        .verify-badge {
            position: absolute;
            bottom: -8px;
            right: -8px;
            width: 36px;
            height: 36px;
            background: var(--accent-emerald);
            border: 3px solid var(--sidebar-bg);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            color: white;
            box-shadow: 0 4px 10px rgba(16, 185, 129, 0.2);
        }
        .verify-badge-error {
            position: absolute;
            bottom: -8px;
            right: -8px;
            width: 36px;
            height: 36px;
            background: var(--accent-rose);
            border: 3px solid var(--sidebar-bg);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            color: white;
            box-shadow: 0 4px 10px rgba(244, 63, 94, 0.2);
        }

        @media (max-width: 767.98px) {
            .verify-icon-wrapper {
                width: 110px;
                height: 110px;
                margin: 16px auto;
            }
            .verify-doc-icon, .verify-doc-icon-error {
                width: 65px;
                height: 85px;
                font-size: 2rem;
            }
            .verify-badge, .verify-badge-error {
                width: 28px;
                height: 28px;
                font-size: 0.85rem;
            }
        }

        /* Signee Card */
        .section-label {
            font-size: 0.88rem;
            color: var(--text-muted);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-top: 24px;
            margin-bottom: 16px;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 8px;
        }
        .signee-card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 14px;
            padding: 16px;
            margin-bottom: 12px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.02);
            transition: all 0.2s;
        }
        .signee-card:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        .signee-avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: rgba(59, 130, 246, 0.1);
            color: var(--accent-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        /* Metadata Details */
        .meta-list {
            margin-bottom: 16px;
        }
        .meta-item {
            margin-bottom: 16px;
        }
        .meta-label {
            font-size: 0.85rem;
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 4px;
        }
        .meta-value {
            font-size: 1.15rem;
            color: var(--text-main);
            font-weight: 700;
        }

        /* Action Buttons */
        .btn-download {
            background-color: #ffffff;
            border: 1px solid #cbd5e1;
            color: #334155;
            font-weight: 600;
            padding: 16px 24px;
            border-radius: 12px;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
            font-size: 1.05rem;
        }
        .btn-download:hover {
            background-color: #f8fafc;
            border-color: #94a3b8;
            color: #0f172a;
        }

        /* PDF Viewer */
        .pdf-frame {
            width: 100%;
            height: 100%;
            border: none;
        }

        .empty-viewer-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            color: var(--text-muted);
            padding: 40px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container-fluid p-0 page-container">
        <!-- LEFT SIDEBAR -->
        <div class="sidebar">
            <!-- Brand Logo -->
            <div class="brand-section">
                <img src="{{ asset('logo/logo_pas_basic.png') }}" alt="PAS Calibration Logo" class="brand-logo">
                <div>
                    <span class="brand-title">PAS CALIBRATION</span>
                    <span class="d-block text-muted" style="font-size: 0.72rem; letter-spacing: 0.3px;">PAPERLESS SYSTEM</span>
                </div>
                
            </div>

            @if(isset($error))
                <!-- Status Box (Error) -->
                <div class="status-box-error">
                    <div class="d-flex align-items-center gap-2 text-danger">
                        <i class="fas fa-exclamation-triangle fs-5"></i>
                        <strong style="font-size: 1.1rem;">Dokumen Tidak Terdaftar</strong>
                    </div>
                    <p class="mb-0 mt-2 text-muted" style="font-size: 0.95rem; line-height: 1.4;">
                        Mohon cek dengan teliti keaslian fisik dokumen Anda. Berkas ini tidak ditemukan di sistem.
                    </p>
                </div>

                <!-- Warning Icon -->
                <div class="verify-icon-wrapper">
                    <div class="verify-doc-icon-error">
                        <i class="fas fa-file-contract text-white"></i>
                        <span class="verify-badge-error"><i class="fas fa-times"></i></span>
                    </div>
                </div>

                <div class="text-center mb-4">
                    <h5 class="fw-bold mb-2" style="font-size: 1.25rem;">Verifikasi Naskah Gagal</h5>
                    <p class="text-muted" style="font-size: 0.92rem;">Tautan QR Code ini tidak mengarah pada berkas sertifikat yang sah atau terdaftar.</p>
                </div>

                @if($status)
                    <div class="section-label">Status Terlampir</div>
                    <div class="p-3 bg-danger bg-opacity-10 border border-danger border-opacity-20 rounded-3 mb-4 text-center">
                        <span class="text-danger" style="font-size: 0.95rem;"><i class="fas fa-shield-alt me-2"></i>{{ $status }}</span>
                    </div>
                @endif

                <div class="mt-auto pt-3">
                    <a href="https://pascalibration.com" class="btn btn-outline-secondary w-100 py-3" style="border-radius: 12px; font-weight: 600; font-size: 1.05rem;">
                        <i class="fas fa-home me-2"></i>Kembali ke Beranda
                    </a>
                </div>
            @else
                <!-- Status Box (Success) -->
                <div class="status-box-success">
                    <div class="d-flex align-items-center gap-2 text-success" style="color: var(--accent-emerald) !important;">
                        <i class="fas fa-check-circle fs-5"></i>
                        <strong style="font-size: 1.1rem;">Dokumen terdaftar pada sistem</strong>
                    </div>
                    <p class="mb-0 mt-2 text-muted" style="font-size: 0.95rem; line-height: 1.4;">
                        Mohon cek dengan teliti keaslian antara surat yang terdaftar dalam sistem dan surat fisik.
                    </p>
                </div>

                <!-- Verification Document Icon -->
                <div class="verify-icon-wrapper">
                    <div class="verify-doc-icon">
                        <i class="fas fa-file-contract text-white"></i>
                        <span class="verify-badge"><i class="fas fa-check"></i></span>
                    </div>
                </div>

                <!-- Verification Info -->
                <div class="text-center mb-4">
                    <h5 class="fw-bold mb-1" style="font-size: 1.25rem;">Verifikasi Naskah Asli</h5>
                    <p class="text-muted" style="font-size: 0.92rem;">Telah diverifikasi secara digital melalui sistem paperless.</p>
                </div>

                <!-- Metadata Details -->
                <div class="section-label">Detail Dokumen</div>
                <div class="meta-list">
                    <div class="meta-item">
                        <div class="meta-label">No. Sertifikat</div>
                        <div class="meta-value">{{ $noSertifikat }}</div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-label">Nama Alat</div>
                        <div class="meta-value">{{ $namaAlat }}</div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-label">Perusahaan / Instansi</div>
                        <div class="meta-value">{{ $perusahaan }}</div>
                    </div>
                </div>

                <!-- Signee Authority -->
                <div class="section-label">Diverifikasi & TTE Oleh</div>
                <div class="signee-list mb-4">
                    @if(isset($calibrator) && $calibrator)
                        <div class="signee-card">
                            <div class="d-flex align-items-center gap-3">
                                <img src="{{ $calibrator['photo'] }}" alt="{{ $calibrator['name'] }}" class="rounded-circle" style="width: 44px; height: 44px; object-fit: cover; border: 1px solid var(--border-color);">
                                <div>
                                    <h6 class="mb-0 text-dark fw-bold" style="font-size: 1.05rem; text-transform: uppercase; color: var(--text-main) !important;">
                                        {{ $calibrator['name'] }}
                                    </h6>
                                    <span class="d-block text-muted" style="font-size: 0.85rem;">Calibrated By / Teknisi</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(isset($verifier) && $verifier)
                        <div class="signee-card">
                            <div class="d-flex align-items-center gap-3">
                                <img src="{{ $verifier['photo'] }}" alt="{{ $verifier['name'] }}" class="rounded-circle" style="width: 44px; height: 44px; object-fit: cover; border: 1px solid var(--border-color);">
                                <div>
                                    <h6 class="mb-0 text-dark fw-bold" style="font-size: 1.05rem; text-transform: uppercase; color: var(--text-main) !important;">
                                        {{ $verifier['name'] }}
                                    </h6>
                                    <span class="d-block text-muted" style="font-size: 0.85rem;">Verified By / Checker</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="signee-card">
                        <div class="d-flex align-items-center gap-3">
                            <img src="{{ $approverPhoto }}" alt="{{ $approverName }}" class="rounded-circle" style="width: 44px; height: 44px; object-fit: cover; border: 1px solid var(--border-color);">
                            <div>
                                <h6 class="mb-0 text-dark fw-bold" style="font-size: 1.05rem; text-transform: uppercase; color: var(--text-main) !important;">
                                    {{ $approverName }}
                                </h6>
                                <span class="d-block text-muted" style="font-size: 0.85rem;">Approved By / Approver</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bottom Download Action -->
                <div class="mt-auto pt-3">
                    <div class="section-label">Dokumen</div>
                    <a href="{{ $fileUrl }}" download class="btn btn-download w-100 py-3">
                        <i class="fas fa-download"></i> Download dokumen
                    </a>
                </div>
            @endif
        </div>

        <!-- RIGHT PDF VIEWER CONTAINER -->
        <div class="viewer-container">
            @if(isset($error))
                <div class="empty-viewer-state">
                    <i class="fas fa-file-contract fs-1 mb-3"></i>
                    <h5 class="fw-bold">Dokumen Tidak Dapat Ditampilkan</h5>
                    <p class="small text-muted" style="max-width: 320px;">
                        Berkas sertifikat digital tidak terdaftar atau telah dihapus dari database.
                    </p>
                </div>
            @else
                <!-- Canvas container for mobile PDF.js rendering -->
                <div id="pdf-canvas-container" style="display: none; width: 100%; height: 100%; overflow-y: auto; background-color: #525659; padding: 20px 0;"></div>

                <iframe class="pdf-frame" src="{{ $fileUrl }}#toolbar=0" type="application/pdf">
                    <div class="empty-viewer-state">
                        <i class="fas fa-exclamation-triangle fs-1 mb-3"></i>
                        <h5 class="fw-bold">Preview Tidak Didukung</h5>
                        <p class="small text-muted" style="max-width: 320px;">
                            Browser Anda tidak mendukung preview PDF langsung. Silakan klik tombol "Download dokumen" di panel kiri.
                        </p>
                    </div>
                </iframe>
            @endif
        </div>
    </div>

    <!-- PDF.js library and rendering script for mobile devices -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const url = '{{ isset($fileUrl) ? $fileUrl : "" }}';
            if (!url) return;
            
            // Detect mobile browser
            const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
            
            if (isMobile) {
                const iframe = document.querySelector('.pdf-frame');
                const canvasContainer = document.getElementById('pdf-canvas-container');
                
                if (iframe) iframe.style.display = 'none';
                if (canvasContainer) canvasContainer.style.display = 'block';
                
                // Configure PDF.js worker
                pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js';
                
                // Render PDF document on canvas
                pdfjsLib.getDocument(url).promise.then(function(pdf) {
                    for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
                        pdf.getPage(pageNum).then(function(page) {
                            const viewport = page.getViewport({ scale: 1.5 });
                            const canvas = document.createElement('canvas');
                            canvas.style.display = 'block';
                            canvas.style.margin = '0 auto 16px auto';
                            canvas.style.maxWidth = '95%';
                            canvas.style.boxShadow = '0 4px 12px rgba(0,0,0,0.2)';
                            canvasContainer.appendChild(canvas);
                            
                            const context = canvas.getContext('2d');
                            canvas.height = viewport.height;
                            canvas.width = viewport.width;
                            
                            const renderContext = {
                                canvasContext: context,
                                viewport: viewport
                            };
                            page.render(renderContext);
                        });
                    }
                }).catch(function(error) {
                    console.error('Error rendering PDF on mobile via PDF.js:', error);
                    // Fallback to standard iframe if rendering fails
                    if (iframe) iframe.style.display = 'block';
                    if (canvasContainer) canvasContainer.style.display = 'none';
                });
            }
        });
    </script>
</body>
</html>
