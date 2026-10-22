    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', 'Calibration System') - PT PAS</title>

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="https://welcometo.pascalibration.com/icon.png">
        <!-- <script src="/js/canvas-surface-plate-dot.js"></script> -->
        <!-- <script src="/js/canvas-drawing.js"></script> -->
        <script src="/js/form-helpers.js"></script>
        <!-- Ganti script di HTML -->
        <script src="/js/canvas-surface-plate.js?v={{ filemtime(public_path('js/canvas-surface-plate.js')) }}"></script>
        <script src="/js/surface-plate-save.js?v={{ filemtime(public_path('js/surface-plate-save.js')) }}"></script>
        <script src="/js/kalibrasi-form.js"></script>
        <script src="/js/no-label-handler.js"></script>
        <script src="/js/inside-micrometer.js"></script>
        <script src="/js/global-form.js"></script>
        <script src="/js/niimbot-global.js"></script>

        <script src="https://unpkg.com/@mmote/niimbluelib@latest/dist/umd/niimbluelib.min.js"></script>
        <script src="{{ asset('js/form-handler.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.5/dist/signature_pad.umd.min.js"></script>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <!-- Google Font -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap" rel="stylesheet">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

        <!-- AdminLTE 4 Core CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

        <!-- DataTables Bootstrap 4 -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">

        <!-- SweetAlert2 -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

        <!-- Custom CSS -->
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

        @stack('styles')

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

            * {
                font-family: 'Inter', sans-serif;
            }

            /* ===== SIDEBAR — Putih Bersih + Biru Muda ===== */
            .main-sidebar,
            .sidebar-dark-primary {
                background: linear-gradient(180deg, #1e3a8a 0%, #1d4ed8 45%, #2563eb 100%) !important;
                border-right: none;
                box-shadow: 4px 0 20px rgba(37, 99, 235, .18);
            }

            /* Brand / Logo area */
            .brand-link {
                border-bottom: 1px solid rgba(255, 255, 255, .15) !important;
                background: rgba(0, 0, 0, .1) !important;
                padding: 1rem 1.25rem !important;
            }

            .brand-text {
                font-weight: 700 !important;
                font-size: 1rem !important;
                color: #fff !important;
                letter-spacing: .3px;
            }

            /* Nav links */
            .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link {
                color: rgba(255, 255, 255, .78) !important;
                border-radius: 10px !important;
                margin: 2px 10px !important;
                transition: all .22s ease !important;
                font-weight: 500 !important;
                font-size: .875rem !important;
            }

            .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link:hover {
                background: rgba(255, 255, 255, .18) !important;
                color: #fff !important;
            }

            .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active {
                background: rgba(255, 255, 255, .22) !important;
                color: #fff !important;
                box-shadow: 0 4px 14px rgba(0, 0, 0, .15) !important;
                font-weight: 600 !important;
            }

            .nav-sidebar .nav-treeview>.nav-item>.nav-link {
                color: rgba(255, 255, 255, .65) !important;
                font-size: .84rem !important;
                padding-left: 2.5rem !important;
                border-radius: 8px !important;
                margin: 1px 10px !important;
                transition: all .2s !important;
            }

            .nav-sidebar .nav-treeview>.nav-item>.nav-link:hover {
                background: rgba(255, 255, 255, .14) !important;
                color: #fff !important;
            }

            .nav-sidebar .nav-treeview>.nav-item>.nav-link.active {
                background: rgba(255, 255, 255, .2) !important;
                color: #fff !important;
                font-weight: 600 !important;
            }

            /* Nav header */
            .nav-header {
                color: rgba(255, 255, 255, .55) !important;
                font-size: .68rem !important;
                text-transform: uppercase !important;
                letter-spacing: 2px !important;
                margin: 1.25rem 1rem .5rem !important;
                font-weight: 700 !important;
            }

            /* Treeview arrow */
            .nav-sidebar .nav-item>.nav-link>.right {
                color: rgba(255, 255, 255, .4) !important;
            }

            /* Badge di sidebar */
            .nav-sidebar .badge {
                background: rgba(255, 255, 255, .25) !important;
                color: #fff !important;
            }

            /* ===== NAVBAR (Top Header) ===== */
            .main-header.navbar {
                background: #fff !important;
                border-bottom: 1px solid #e8f0fe !important;
                box-shadow: 0 2px 12px rgba(37, 99, 235, .08) !important;
            }

            .main-header .navbar-nav .nav-link {
                color: #374151 !important;
            }

            .main-header .navbar-nav .nav-link:hover {
                color: #2563eb !important;
            }

            /* Hamburger / toggle */
            .nav-link[data-widget="pushmenu"] {
                color: #2563eb !important;
            }

            /* ===== CONTENT wrapper ===== */
            .content-wrapper {
                background: linear-gradient(135deg, #f0f6ff 0%, #e8f2ff 50%, #f5f8ff 100%) !important;
                min-height: 100vh;
            }

            .content-header h1 {
                color: #1e3a8a !important;
                font-weight: 700;
            }

            .breadcrumb {
                background: transparent !important;
            }

            .breadcrumb-item,
            .breadcrumb-item a {
                color: #6b7280 !important;
                font-size: .82rem;
            }

            .breadcrumb-item a:hover {
                color: #2563eb !important;
            }

            .breadcrumb-item.active {
                color: #2563eb !important;
                font-weight: 600;
            }

            .breadcrumb-item+.breadcrumb-item::before {
                color: #cbd5e1 !important;
            }

            .content-header {
                background: transparent !important;
            }

            /* ===== FOOTER ===== */
            .main-footer {
                background: #fff !important;
                border-top: 1px solid #e8f0fe !important;
                color: #9ca3af !important;
                font-size: .8rem;
            }

            /* Scrollbar - sidebar */
            .sidebar::-webkit-scrollbar {
                width: 4px;
            }

            .sidebar::-webkit-scrollbar-track {
                background: transparent;
            }

            .sidebar::-webkit-scrollbar-thumb {
                background: rgba(255, 255, 255, .25);
                border-radius: 4px;
            }

            .sidebar::-webkit-scrollbar-thumb:hover {
                background: rgba(255, 255, 255, .45);
            }

            /* Brand logo wrapper */
            .brand-wrapper {
                padding: 1rem !important;
                border-bottom: 1px solid rgba(255, 255, 255, .15) !important;
            }

            .brand-text h5 {
                color: #fff !important;
                font-size: .9rem !important;
                letter-spacing: .3px;
            }
        </style>
    </head>

    <body class="hold-transition sidebar-mini layout-fixed">
        <script>
            if (localStorage.getItem('sidebar-state') === 'collapsed') {
                document.body.classList.add('sidebar-collapse');
            }
        </script>
        <div class="wrapper">

            <!-- Header Component -->
            @include('components.header')

            <!-- Sidebar Component -->
            @include('components.sidebar')

            <!-- Content Wrapper -->
            <div class="content-wrapper">
                <!-- Content Header -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">@yield('title', 'Dashboard')</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item active">@yield('title', 'Dashboard')</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <section class="content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </section>
            </div>

            <!-- Footer Component -->
            @include('components.footer')

            <!-- Control Sidebar (optional) -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>

        </div>

        <!-- JavaScript -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

        <!-- DataTables -->
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>

        <!-- SweetAlert2 & Axios -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

        <!-- Custom Script -->
        <script>
            $(document).ready(function() {
                // CSRF Setup
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // Initialize DataTables
                $('.datatable').DataTable({
                    responsive: true,
                    autoWidth: false,
                    language: {
                        search: "Cari:",
                        lengthMenu: "Tampilkan _MENU_ entri",
                        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                        paginate: {
                            first: "Pertama",
                            last: "Terakhir",
                            next: "Selanjutnya",
                            previous: "Sebelumnya"
                        }
                    }
                });

                // Auto-hide alerts
                setTimeout(function() {
                    $('.alert').fadeOut('slow');
                }, 5000);

                // Tooltip initialization
                $('[data-toggle="tooltip"]').tooltip();
            });

            // SweetAlert2 configuration
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });

            function showToast(message, type = 'success') {
                Toast.fire({
                    icon: type,
                    title: message
                });
            }

            function confirmDelete(formId, title = 'Yakin ingin menghapus?', text = "Data yang dihapus tidak dapat dikembalikan!") {
                Swal.fire({
                    title: title,
                    text: text,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(formId).submit();
                    }
                });
            }

            // Konfirmasi hapus khusus untuk data kalibrasi (dipanggil dari onclick di index.blade.php)
            function confirmDeleteCalibration(calibrationId, namaAlat) {
                var form = document.getElementById('delete-form-' + calibrationId);
                if (!form) {
                    console.error('Form delete tidak ditemukan! ID: delete-form-' + calibrationId);
                    return;
                }
                Swal.fire({
                    title: 'Hapus Data Kalibrasi?',
                    html: 'Yakin ingin menghapus data <strong>' + namaAlat + '</strong>?<br>' +
                        '<span class="text-danger small">Data yang dihapus tidak dapat dikembalikan!</span>',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="fas fa-trash me-1"></i> Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then(function(result) {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        </script>


        @stack('scripts')

        {{-- ============================================================ --}}
        {{-- NAVIGASI EXCEL: Tab/Enter/↓ = Bawah | Shift+Tab/↑ = Atas   --}}
        {{-- → = Kanan kolom    | ← = Kiri kolom          --}}
        {{-- SELECT & FILL: Klik+Drag / Shift+Klik untuk blok sel         --}}
        {{-- Ctrl+D = Fill Down (berurutan) | Ctrl+F = Fill Right       --}}
        {{-- Klik Kanan pada seleksi → context menu lengkap             --}}
        {{-- Fill berurutan (angka) atau copy (teks)                     --}}
        {{-- Dipasang di layout global agar aktif di semua halaman        --}}
        {{-- ============================================================ --}}

        <style>
            /* ── Excel-like selection highlight ── */
            .excel-selected {
                outline: 2px solid #1d6aff !important;
                outline-offset: -2px !important;
                background-color: rgba(29, 106, 255, 0.12) !important;
                position: relative;
                z-index: 1;
            }

            .excel-anchor {
                outline: 2px solid #1d6aff !important;
                outline-offset: -2px !important;
                background-color: rgba(29, 106, 255, 0.22) !important;
            }

            /* ── Fill context menu ── */
            #excel-fill-menu {
                position: fixed;
                background: #fff;
                border: 1px solid #d1d5db;
                border-radius: 8px;
                box-shadow: 0 8px 30px rgba(0, 0, 0, .18);
                z-index: 99999;
                min-width: 200px;
                overflow: hidden;
                font-family: 'Inter', sans-serif;
                font-size: 13px;
                display: none;
            }

            #excel-fill-menu .fill-menu-header {
                background: #f0f6ff;
                padding: 8px 14px;
                font-weight: 700;
                color: #1e3a8a;
                border-bottom: 1px solid #e2e8f0;
                font-size: 11px;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            #excel-fill-menu .fill-menu-item {
                display: flex;
                align-items: center;
                gap: 8px;
                padding: 9px 14px;
                cursor: pointer;
                color: #374151;
                transition: background .15s;
                user-select: none;
            }

            #excel-fill-menu .fill-menu-item:hover {
                background: #eff6ff;
                color: #1d4ed8;
            }

            #excel-fill-menu .fill-menu-item .fill-icon {
                font-size: 15px;
                width: 20px;
                text-align: center;
                color: #2563eb;
            }

            #excel-fill-menu .fill-menu-divider {
                border-top: 1px solid #e5e7eb;
                margin: 3px 0;
            }

            #excel-fill-menu .fill-menu-item .fill-shortcut {
                margin-left: auto;
                font-size: 10px;
                color: #9ca3af;
                font-family: monospace;
            }

            /* ── Toast notif kecil untuk fill ── */
            #excel-fill-toast {
                position: fixed;
                bottom: 28px;
                left: 50%;
                transform: translateX(-50%) translateY(20px);
                background: #1e40af;
                color: #fff;
                padding: 7px 20px;
                border-radius: 20px;
                font-size: 12.5px;
                z-index: 99998;
                pointer-events: none;
                opacity: 0;
                transition: opacity .25s, transform .25s;
                font-family: 'Inter', sans-serif;
                box-shadow: 0 4px 18px rgba(0, 0, 0, .18);
                white-space: nowrap;
            }

            #excel-fill-toast.show {
                opacity: 1;
                transform: translateX(-50%) translateY(0);
            }

            /* ── Mobile Excel Helper ── */
            #mobile-excel-helper {
                position: fixed;
                bottom: 120px;
                right: 24px;
                z-index: 99999;
                font-family: 'Inter', sans-serif;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                user-select: none;
            }

            #mobile-excel-helper.is-dragging {
                transition: none !important;
                /* nonaktifkan animasi saat drag agar halus */
                cursor: grabbing !important;
            }

            #mobile-excel-helper.collapsed {
                width: 40px;
                height: 40px;
                border-radius: 40px;
                background: linear-gradient(135deg, #2563eb, #1d4ed8);
                box-shadow: 0 4px 18px rgba(37, 99, 235, 0.45);
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: grab;
            }

            #mobile-excel-helper.collapsed:hover {
                background: linear-gradient(135deg, #1d4ed8, #1e40af);
                transform: scale(1.05);
            }

            #mobile-excel-helper.collapsed .helper-body,
            #mobile-excel-helper.collapsed .helper-drag-handle {
                display: none !important;
            }

            #mobile-excel-helper.collapsed .helper-toggle-bubble {
                display: flex;
                align-items: center;
                justify-content: center;
                color: #fff;
                font-size: 24px;
                /* Ikon diperbesar agar jelas */
            }

            /* Expanded state */
            #mobile-excel-helper.expanded {
                width: 280px;
                background: rgba(255, 255, 255, 0.9);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border: 1px solid rgba(229, 231, 235, 0.8);
                border-radius: 16px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
                overflow: hidden;
                display: flex;
                flex-direction: column;
            }

            #mobile-excel-helper.expanded .helper-toggle-bubble {
                display: none !important;
            }

            .helper-drag-handle {
                background: rgba(37, 99, 235, 0.08);
                padding: 10px 14px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                cursor: move;
                border-bottom: 1px solid rgba(229, 231, 235, 0.5);
            }

            .helper-title {
                font-size: 11px;
                font-weight: 700;
                color: #1e3a8a;
                letter-spacing: 0.5px;
                text-transform: uppercase;
                display: flex;
                align-items: center;
                gap: 6px;
            }

            .helper-close-btn {
                background: none;
                border: none;
                color: #6b7280;
                cursor: pointer;
                font-size: 13px;
                padding: 2px 6px;
                border-radius: 4px;
                transition: background 0.15s, color 0.15s;
            }

            .helper-close-btn:hover {
                background: rgba(0, 0, 0, 0.05);
                color: #374151;
            }

            .helper-body {
                padding: 12px;
                display: flex;
                flex-direction: column;
                gap: 12px;
                align-items: center;
            }

            /* D-Pad Grid */
            .dpad-container {
                display: grid;
                grid-template-columns: repeat(3, 40px);
                grid-template-rows: repeat(3, 40px);
                gap: 4px;
                justify-content: center;
                align-items: center;
            }

            .dpad-btn {
                width: 40px;
                height: 40px;
                border: 1px solid #e5e7eb;
                background: #f9fafb;
                border-radius: 8px;
                color: #374151;
                font-size: 14px;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.15s;
            }

            .dpad-btn:active {
                background: #e5e7eb;
                transform: scale(0.92);
            }

            .dpad-up {
                grid-column: 2;
                grid-row: 1;
            }

            .dpad-left {
                grid-column: 1;
                grid-row: 2;
            }

            .dpad-center-indicator {
                grid-column: 2;
                grid-row: 2;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #9ca3af;
                font-size: 14px;
            }

            .dpad-right {
                grid-column: 3;
                grid-row: 2;
            }

            .dpad-down {
                grid-column: 2;
                grid-row: 3;
            }

            .helper-divider {
                width: 100%;
                border-top: 1px solid #f3f4f6;
            }

            .actions-container {
                width: 100%;
                display: flex;
                flex-direction: column;
                gap: 6px;
            }

            .helper-action-btn {
                width: 100%;
                padding: 8px 12px;
                border: 1px solid #d1d5db;
                background: #fff;
                border-radius: 8px;
                color: #374151;
                font-size: 12px;
                font-weight: 600;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 6px;
                transition: all 0.15s;
            }

            .helper-action-btn:active:not(:disabled) {
                transform: scale(0.97);
            }

            .helper-action-btn.active {
                background: rgba(16, 185, 129, 0.1) !important;
                border-color: #10b981 !important;
                color: #047857 !important;
            }

            .helper-action-btn.btn-primary-gradient {
                background: linear-gradient(135deg, #2563eb, #1d4ed8);
                border: none;
                color: #fff;
                box-shadow: 0 4px 10px rgba(37, 99, 235, 0.25);
            }

            .helper-action-btn.btn-primary-gradient:disabled {
                background: #e5e7eb;
                color: #9ca3af;
                box-shadow: none;
                cursor: not-allowed;
            }

            .helper-action-btn.btn-secondary {
                background: #f3f4f6;
                border-color: #e5e7eb;
                color: #4b5563;
            }

            /* Reposition context menu when opened on mobile */
            @media (max-width: 768px) {
                #excel-fill-menu {
                    position: fixed !important;
                    left: 50% !important;
                    top: 50% !important;
                    transform: translate(-50%, -50%) !important;
                    width: 90% !important;
                    max-width: 300px !important;
                    border-radius: 12px !important;
                }
            }
        </style>

        <div id="excel-fill-menu">
            <div class="fill-menu-header">⚡ Fill Selection</div>
            <div class="fill-menu-item" id="fill-down-btn">
                <span class="fill-icon">↓</span> Fill Down (Berurutan)
                <span class="fill-shortcut">Ctrl+D</span>
            </div>
            <div class="fill-menu-item" id="fill-down-copy-btn">
                <span class="fill-icon">↓</span> Fill Down (Copy)
            </div>
            <div class="fill-menu-divider"></div>
            <div class="fill-menu-item" id="fill-up-btn">
                <span class="fill-icon">↑</span> Fill Up (Berurutan)
            </div>
            <div class="fill-menu-item" id="fill-up-copy-btn">
                <span class="fill-icon">↑</span> Fill Up (Copy)
            </div>
            <div class="fill-menu-divider"></div>
            <div class="fill-menu-item" id="fill-right-btn">
                <span class="fill-icon">→</span> Fill Right (Berurutan)
                <span class="fill-shortcut">Ctrl+F</span>
            </div>
            <div class="fill-menu-item" id="fill-right-copy-btn">
                <span class="fill-icon">→</span> Fill Right (Copy)
            </div>
            <div class="fill-menu-divider"></div>
            <div class="fill-menu-item" id="fill-left-btn">
                <span class="fill-icon">←</span> Fill Left (Berurutan)
            </div>
            <div class="fill-menu-item" id="fill-left-copy-btn">
                <span class="fill-icon">←</span> Fill Left (Copy)
            </div>
            <div class="fill-menu-divider"></div>
            <div class="fill-menu-item" id="fill-all-btn" style="color:#7c3aed">
                <span class="fill-icon" style="color:#7c3aed">⬛</span> Fill Semua (Copy)
            </div>
            <div class="fill-menu-item" id="fill-clear-sel-btn" style="color:#6b7280">
                <span class="fill-icon" style="color:#9ca3af">✕</span> Batalkan Seleksi
            </div>
        </div>
        <div id="excel-fill-toast"></div>

        <!-- Floating Mobile Excel Helper -->
        <div id="mobile-excel-helper" class="collapsed" style="display: none;">
            <!-- Collapsed Bubble View -->
            <div class="helper-toggle-bubble" id="mobile-helper-expand-btn" title="Buka Helper Excel">
                <i class="fas fa-table-cells"></i>
            </div>

            <!-- Expanded Panel View -->
            <div class="helper-drag-handle">
                <span class="helper-title">⚡ Navigasi & Seleksi</span>
                <button type="button" class="helper-close-btn" id="mobile-helper-collapse-btn" title="Minimize">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
            <div class="helper-body">
                <!-- D-Pad Navigation -->
                <div class="dpad-container">
                    <button type="button" class="dpad-btn dpad-up" title="Atas" id="mobile-nav-up">
                        <i class="fas fa-chevron-up"></i>
                    </button>
                    <button type="button" class="dpad-btn dpad-left" title="Kiri" id="mobile-nav-left">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <div class="dpad-center-indicator" title="Navigasi">
                        <i class="fas fa-keyboard"></i>
                    </div>
                    <button type="button" class="dpad-btn dpad-right" title="Kanan" id="mobile-nav-right">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                    <button type="button" class="dpad-btn dpad-down" title="Bawah" id="mobile-nav-down">
                        <i class="fas fa-chevron-down"></i>
                    </button>
                </div>

                <div class="helper-divider"></div>

                <!-- Action Controls -->
                <div class="actions-container">
                    <button type="button" class="helper-action-btn" id="mobile-toggle-select" title="Aktifkan Mode Blok (Pilih Banyak Sel)">
                        <i class="fas fa-square-check"></i>
                        <span class="btn-text">Mode Blok: OFF</span>
                    </button>

                    <button type="button" class="helper-action-btn btn-primary-gradient" id="mobile-trigger-menu" title="Buka Menu Fill" disabled>
                        <i class="fas fa-bolt"></i>
                        <span class="btn-text">Menu Fill</span>
                    </button>

                    <button type="button" class="helper-action-btn btn-secondary" id="mobile-clear-select" title="Batalkan Seleksi" style="display: none;">
                        <i class="fas fa-times-circle"></i>
                        <span class="btn-text">Batal Seleksi</span>
                    </button>
                </div>
            </div>
        </div>


        <script>
            (function() {
                'use strict';

                /* ── Helper: Navigasi Antar Sel Tabel ── */
                function navigateTable(direction) {
                    var activeEl = document.activeElement;
                    if (!activeEl) return;

                    var currentTd = activeEl.closest('td');
                    var currentTr = activeEl.closest('tr');
                    if (!currentTd || !currentTr) return;

                    if (activeEl.tagName !== 'INPUT' && activeEl.tagName !== 'SELECT') return;
                    if (activeEl.type === 'hidden' || activeEl.type === 'button' ||
                        activeEl.type === 'submit' || activeEl.type === 'checkbox' ||
                        activeEl.type === 'radio' || activeEl.type === 'file') return;

                    var targetInput = null;

                    if (direction === 'down' || direction === 'up') {
                        var targetTr = (direction === 'up') ? currentTr.previousElementSibling :
                            currentTr.nextElementSibling;
                        if (!targetTr) return;
                        if (targetTr.closest('thead')) return;

                        var currentRect = currentTd.getBoundingClientRect();
                        var currentCenterX = currentRect.left + currentRect.width / 2;
                        var bestDistance = Infinity;

                        Array.from(targetTr.cells).forEach(function(cell) {
                            var inputs = cell.querySelectorAll(
                                'input:not([type="hidden"]):not([disabled]):not([readonly]),' +
                                'select:not([disabled])'
                            );
                            inputs.forEach(function(inp) {
                                var cellCenterX = cell.getBoundingClientRect().left + cell.getBoundingClientRect().width / 2;
                                var dist = Math.abs(cellCenterX - currentCenterX);
                                if (dist < bestDistance) {
                                    bestDistance = dist;
                                    targetInput = inp;
                                }
                            });
                        });

                        if (!targetInput || bestDistance >= 200) return;

                    } else if (direction === 'right' || direction === 'left') {
                        var allInputsInRow = [];
                        Array.from(currentTr.cells).forEach(function(cell) {
                            var inputs = cell.querySelectorAll(
                                'input:not([type="hidden"]):not([disabled]):not([readonly]),' +
                                'select:not([disabled])'
                            );
                            inputs.forEach(function(inp) {
                                allInputsInRow.push(inp);
                            });
                        });

                        var currentIndex = allInputsInRow.indexOf(activeEl);
                        if (currentIndex === -1) return;

                        var nextIndex = (direction === 'right') ? currentIndex + 1 : currentIndex - 1;
                        if (nextIndex < 0 || nextIndex >= allInputsInRow.length) return;

                        targetInput = allInputsInRow[nextIndex];
                    }

                    if (targetInput) {
                        targetInput.focus();
                        if (targetInput.tagName === 'INPUT') {
                            try {
                                targetInput.select();
                            } catch (_) {}
                        }
                    }
                }

                /* ════════════════════════════════════════════════════════════
                1.  NAVIGASI EXCEL (Tab / Enter / Arrow keys)
                ════════════════════════════════════════════════════════════ */
                document.addEventListener('keydown', function(e) {
                    var key = e.key;

                    var isDown = (key === 'Enter') || (key === 'ArrowDown') || (key === 'Tab' && !e.shiftKey);
                    var isUp = (key === 'ArrowUp') || (key === 'Tab' && e.shiftKey);
                    var isRight = (key === 'ArrowRight');
                    var isLeft = (key === 'ArrowLeft');

                    if (!isDown && !isUp && !isRight && !isLeft) return;

                    var activeEl = document.activeElement;
                    if (!activeEl) return;

                    var currentTd = activeEl.closest('td');
                    var currentTr = activeEl.closest('tr');
                    if (!currentTd || !currentTr) return;

                    if (activeEl.tagName !== 'INPUT' && activeEl.tagName !== 'SELECT') return;
                    if (activeEl.type === 'hidden' || activeEl.type === 'button' ||
                        activeEl.type === 'submit' || activeEl.type === 'checkbox' ||
                        activeEl.type === 'radio' || activeEl.type === 'file') return;

                    if (isRight || isLeft) {
                        if (activeEl.tagName === 'INPUT') {
                            var val = activeEl.value != null ? activeEl.value : '';
                            var cursorPos = activeEl.selectionStart;
                            if (isRight && cursorPos !== val.length) return;
                            if (isLeft && cursorPos !== 0) return;
                        }
                    }

                    e.preventDefault();

                    if (isDown) navigateTable('down');
                    else if (isUp) navigateTable('up');
                    else if (isRight) navigateTable('right');
                    else if (isLeft) navigateTable('left');
                });

                /* ════════════════════════════════════════════════════════════
                2.  SELECT & FILL — Excel-like block selection
                ════════════════════════════════════════════════════════════ */

                var selState = {
                    active: false, // sedang drag-select
                    anchor: null, // input pertama yang diklik
                    selected: [], // semua input yang ter-blok
                    isDragging: false,
                };

                var fillMenu = document.getElementById('excel-fill-menu');
                var fillToast = document.getElementById('excel-fill-toast');

                // ── Helper: ambil semua input navigable dalam satu tabel/form ──
                function getAllTableInputs(tableOrContainer) {
                    var container = tableOrContainer;
                    if (!container) container = document.body;

                    if (container.tagName === 'TABLE') {
                        var parentForm = container.closest('form') || container.closest('.cal-wrapper');
                        if (parentForm) {
                            container = parentForm;
                        }
                    }

                    return Array.from(
                        container.querySelectorAll(
                            'td input:not([type="hidden"]):not([disabled]):not([readonly]),' +
                            'td select:not([disabled])'
                        )
                    ).filter(function(el) {
                        var section = el.closest('.parameter-section, [id^="section_"]');
                        if (section && (section.style.display === 'none' || getComputedStyle(section).display === 'none')) {
                            return false;
                        }
                        return !['button', 'submit', 'checkbox', 'radio', 'file'].includes(el.type);
                    });
                }

                // ── Helper: posisi (row, col) suatu input berdasarkan X visual (Aman untuk Rowspan/Colspan) ──
                function getInputPos(inp, allInputs) {
                    var td = inp.closest('td');
                    var tr = inp.closest('tr');
                    if (!td || !tr) return null;

                    var rows = [];
                    allInputs.forEach(function(i2) {
                        var r = i2.closest('tr');
                        if (r && !rows.includes(r)) rows.push(r);
                    });
                    var rowIdx = rows.indexOf(tr);

                    var colCenters = [];
                    var TOLERANCE = 20;

                    allInputs.forEach(function(i2) {
                        var td2 = i2.closest('td');
                        if (!td2) return;
                        var rect = td2.getBoundingClientRect();
                        var cx = rect.left + rect.width / 2;

                        var found = colCenters.find(function(c) {
                            return Math.abs(c - cx) <= TOLERANCE;
                        });
                        if (found === undefined) {
                            colCenters.push(cx);
                        }
                    });

                    colCenters.sort(function(a, b) {
                        return a - b;
                    });

                    var rectInp = td.getBoundingClientRect();
                    var inpCX = rectInp.left + rectInp.width / 2;
                    var colIdx = -1;

                    colCenters.forEach(function(c, idx) {
                        if (colIdx === -1 && Math.abs(c - inpCX) <= TOLERANCE) {
                            colIdx = idx;
                        }
                    });

                    if (colIdx === -1) colIdx = 0;

                    return {
                        row: rowIdx,
                        col: colIdx
                    };
                }

                // ── Helper: cari input di posisi (row, col) ──
                function getInputAt(row, col, allInputs) {
                    var rows = [];
                    allInputs.forEach(function(inp) {
                        var tr = inp.closest('tr');
                        if (tr && !rows.includes(tr)) rows.push(tr);
                    });

                    var targetTr = rows[row];
                    if (!targetTr) return null;

                    var found = null;
                    allInputs.forEach(function(inp) {
                        if (inp.closest('tr') !== targetTr) return;
                        var pos = getInputPos(inp, allInputs);
                        if (pos && pos.col === col) {
                            found = inp;
                        }
                    });
                    return found;
                }

                // ── Visual: highlight selection ──
                function applyHighlight() {
                    // Reset all
                    document.querySelectorAll('.excel-selected,.excel-anchor').forEach(function(el) {
                        el.classList.remove('excel-selected', 'excel-anchor');
                    });
                    if (!selState.anchor) return;
                    selState.anchor.classList.add('excel-anchor');
                    selState.selected.forEach(function(el) {
                        if (el !== selState.anchor) el.classList.add('excel-selected');
                    });
                }

                var mobileSelectMode = false;
                var lastActiveInput = null;
                var helperEl = document.getElementById('mobile-excel-helper');

                function updateMobileHelperState() {
                    if (!helperEl) return;
                    var fillBtn = document.getElementById('mobile-trigger-menu');
                    var clearBtn = document.getElementById('mobile-clear-select');

                    if (selState.selected.length >= 2) {
                        fillBtn.removeAttribute('disabled');
                        clearBtn.style.display = 'flex';
                    } else {
                        fillBtn.setAttribute('disabled', 'true');
                        clearBtn.style.display = 'none';
                    }
                }

                function clearSelection() {
                    selState.anchor = null;
                    selState.selected = [];
                    selState.active = false;
                    applyHighlight();
                    hideMenu();
                    updateMobileHelperState();
                }

                // ── Compute rectangular selection between anchor and target ──
                function computeRectSelection(anchor, target) {
                    var container = anchor.closest('form') || anchor.closest('.cal-wrapper') || anchor.closest('table') || document.body;
                    var allInputs = getAllTableInputs(container);
                    var posA = getInputPos(anchor, allInputs);
                    var posB = getInputPos(target, allInputs);
                    if (!posA || !posB) return [anchor];

                    var minRow = Math.min(posA.row, posB.row);
                    var maxRow = Math.max(posA.row, posB.row);
                    var minCol = Math.min(posA.col, posB.col);
                    var maxCol = Math.max(posA.col, posB.col);

                    var result = [];
                    for (var r = minRow; r <= maxRow; r++) {
                        for (var c = minCol; c <= maxCol; c++) {
                            var inp = getInputAt(r, c, allInputs);
                            if (inp) result.push(inp);
                        }
                    }
                    return result.length ? result : [anchor];
                }

                // ── Compute SINGLE-COLUMN selection between anchor and target ──
                function computeColumnSelection(anchor, target) {
                    var container = anchor.closest('form') || anchor.closest('.cal-wrapper') || anchor.closest('table') || document.body;
                    var allInputs = getAllTableInputs(container);

                    var anchorTd = anchor.closest('td');
                    var anchorRect = anchorTd.getBoundingClientRect();
                    var anchorCX = anchorRect.left + anchorRect.width / 2;

                    var rows = [];
                    allInputs.forEach(function(inp) {
                        var tr = inp.closest('tr');
                        if (tr && !rows.includes(tr)) rows.push(tr);
                    });

                    var anchorRowIdx = rows.indexOf(anchor.closest('tr'));
                    var targetRowIdx = rows.indexOf(target.closest('tr'));
                    var minRow = Math.min(anchorRowIdx, targetRowIdx);
                    var maxRow = Math.max(anchorRowIdx, targetRowIdx);

                    var TOLERANCE = Math.max(30, anchorRect.width / 2 - 2);

                    var result = [];
                    allInputs.forEach(function(inp) {
                        var tr = inp.closest('tr');
                        var rowIdx = rows.indexOf(tr);
                        if (rowIdx < minRow || rowIdx > maxRow) return;

                        var td = inp.closest('td');
                        var rect = td.getBoundingClientRect();
                        var cx = rect.left + rect.width / 2;

                        if (Math.abs(cx - anchorCX) <= TOLERANCE) {
                            result.push(inp);
                        }
                    });

                    return result.length ? result : [anchor];
                }

                // ── Mouse/Touch events ──
                document.addEventListener('mousedown', function(e) {
                    var inp = e.target.closest('input,select');
                    if (!inp) {
                        inp = null;
                    }
                    if (inp && inp.type && ['hidden', 'button', 'submit', 'checkbox', 'radio', 'file'].includes(inp.type)) inp = null;

                    if (!inp || !inp.closest('td')) {
                        // Jangan reset seleksi jika klik terjadi di dalam menu fill atau helper mobile
                        if (!fillMenu.contains(e.target) && (!helperEl || !helperEl.contains(e.target))) {
                            clearSelection();
                        }
                        return;
                    }

                    if (e.button !== 0) return; // only left click

                    if (e.shiftKey && selState.anchor) {
                        // Shift+Click desktop → rectangular selection
                        selState.selected = computeRectSelection(selState.anchor, inp);
                        applyHighlight();
                        updateMobileHelperState();
                        return;
                    }

                    if (mobileSelectMode && selState.anchor) {
                        // Mode Blok mobile: cek apakah tap ke kolom yang SAMA dengan anchor
                        var aTd = selState.anchor.closest('td');
                        var tTd = inp.closest('td');
                        var aRect = aTd.getBoundingClientRect();
                        var tRect = tTd.getBoundingClientRect();
                        var ancCX = aRect.left + aRect.width / 2;
                        var tapCX = tRect.left + tRect.width / 2;
                        var colTol = Math.max(30, aRect.width / 2 - 2);

                        if (Math.abs(tapCX - ancCX) <= colTol) {
                            // Kolom sama → hanya satu kolom (tidak bleeding ke samping)
                            selState.selected = computeColumnSelection(selState.anchor, inp);
                        } else {
                            // Kolom berbeda → rectangular (blok ke samping / semua arah)
                            selState.selected = computeRectSelection(selState.anchor, inp);
                        }
                        applyHighlight();
                        updateMobileHelperState();
                        return;
                    }

                    // New anchor
                    selState.anchor = inp;
                    selState.selected = [inp];
                    selState.active = true;
                    selState.isDragging = false;
                    applyHighlight();
                    updateMobileHelperState();
                });

                document.addEventListener('mousemove', function(e) {
                    if (!selState.active || !selState.anchor) return;
                    var inp = e.target.closest('input,select');
                    if (!inp || !inp.closest('td')) return;
                    if (inp.type && ['hidden', 'button', 'submit', 'checkbox', 'radio', 'file'].includes(inp.type)) return;

                    selState.isDragging = true;
                    selState.selected = computeRectSelection(selState.anchor, inp);
                    applyHighlight();
                    updateMobileHelperState();
                });

                document.addEventListener('mouseup', function() {
                    selState.active = false;
                });

                // ── Context menu (right-click) when selection > 1 ──
                document.addEventListener('contextmenu', function(e) {
                    if (selState.selected.length < 2) return;
                    var inp = e.target.closest('input,select');
                    if (!inp || !inp.closest('td')) return;
                    if (!selState.selected.includes(inp) && inp !== selState.anchor) return;

                    e.preventDefault();
                    showMenu(e.clientX, e.clientY);
                });

                function showMenu(x, y) {
                    fillMenu.style.display = 'block';
                    if (x !== undefined && y !== undefined) {
                        fillMenu.style.left = x + 'px';
                        fillMenu.style.top = y + 'px';
                        fillMenu.style.transform = 'none'; // reset transform jika dari klik kanan desktop

                        // Reposition if off screen
                        requestAnimationFrame(function() {
                            var rect = fillMenu.getBoundingClientRect();
                            if (rect.right > window.innerWidth) fillMenu.style.left = (x - rect.width) + 'px';
                            if (rect.bottom > window.innerHeight) fillMenu.style.top = (y - rect.height) + 'px';
                        });
                    } else {
                        // Di tengah layar pada mobile
                        fillMenu.style.left = '50%';
                        fillMenu.style.top = '50%';
                        fillMenu.style.transform = 'translate(-50%, -50%)';
                    }
                }

                function hideMenu() {
                    fillMenu.style.display = 'none';
                    fillMenu.style.transform = 'none';
                }

                document.addEventListener('click', function(e) {
                    if (!fillMenu.contains(e.target) && !e.target.closest('#mobile-trigger-menu')) hideMenu();
                });
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        hideMenu();
                        clearSelection();
                    }
                });

                /* ════════════════════════════════════════════════════════════
                2.5. MOBILE EXCEL HELPER INTERACTIVE LOGIC
                ════════════════════════════════════════════════════════════ */
                var helperTimeout;

                // Aktif di semua perangkat agar mudah digunakan dan dites (termasuk desktop/laptop)
                if (helperEl) {
                    // Event listener ketika input tabel difokuskan
                    document.addEventListener('focusin', function(e) {
                        var target = e.target;
                        var inTable = target.closest('td') && (target.tagName === 'INPUT' || target.tagName === 'SELECT');
                        var inHelper = helperEl.contains(target);

                        if (inTable) {
                            clearTimeout(helperTimeout);
                            lastActiveInput = target;

                            // Selalu perbarui anchor jika fokus berpindah via keyboard/klik
                            // (Kecuali sedang drag atau mode blok di mobile aktif)
                            if (!selState.active && !mobileSelectMode) {
                                selState.anchor = target;
                                selState.selected = [target];
                                applyHighlight();
                                updateMobileHelperState();
                            } else if (!selState.anchor) {
                                selState.anchor = target;
                                selState.selected = [target];
                                applyHighlight();
                                updateMobileHelperState();
                            }

                            helperEl.style.display = 'block';
                        } else if (inHelper) {
                            clearTimeout(helperTimeout);
                        } else {
                            // Beri jeda sedikit saat memindahkan fokus agar helper tidak kedip
                            helperTimeout = setTimeout(function() {
                                if (document.activeElement) {
                                    var actInTable = document.activeElement.closest('td') &&
                                        (document.activeElement.tagName === 'INPUT' || document.activeElement.tagName === 'SELECT');
                                    var actInHelper = helperEl.contains(document.activeElement);
                                    if (!actInTable && !actInHelper) {
                                        helperEl.style.display = 'none';
                                    }
                                } else {
                                    helperEl.style.display = 'none';
                                }
                            }, 300);
                        }
                    });

                    // Mencegah blur dari input saat menekan tombol helper (agar keyboard tidak menutup)
                    helperEl.querySelectorAll('button, .dpad-btn, .helper-action-btn').forEach(function(btn) {
                        btn.addEventListener('mousedown', function(e) {
                            e.preventDefault();
                        });
                    });

                    // Toggle Expand / Collapse
                    document.getElementById('mobile-helper-expand-btn').addEventListener('click', function() {
                        // Jangan expand jika ini adalah akhir dari gerakan drag bubble
                        if (bubbleMoved) {
                            bubbleMoved = false;
                            return;
                        }
                        helperEl.classList.remove('collapsed');
                        helperEl.classList.add('expanded');
                        if (lastActiveInput) lastActiveInput.focus();
                    });

                    document.getElementById('mobile-helper-collapse-btn').addEventListener('click', function() {
                        helperEl.classList.remove('expanded');
                        helperEl.classList.add('collapsed');
                        if (lastActiveInput) lastActiveInput.focus();
                    });

                    // D-Pad Navigation Buttons
                    document.getElementById('mobile-nav-up').addEventListener('click', function() {
                        if (mobileSelectMode && selState.anchor && lastActiveInput) {
                            // Mode Blok: extend selection ke atas dalam kolom yang sama
                            navigateTable('up');
                            setTimeout(function() {
                                var focused = document.activeElement;
                                if (focused && focused.closest('td')) {
                                    lastActiveInput = focused;
                                    selState.selected = computeColumnSelection(selState.anchor, focused);
                                    applyHighlight();
                                    updateMobileHelperState();
                                }
                            }, 50);
                        } else {
                            navigateTable('up');
                            if (lastActiveInput) lastActiveInput.focus();
                        }
                    });
                    document.getElementById('mobile-nav-down').addEventListener('click', function() {
                        if (mobileSelectMode && selState.anchor && lastActiveInput) {
                            // Mode Blok: extend selection ke bawah dalam kolom yang sama
                            navigateTable('down');
                            setTimeout(function() {
                                var focused = document.activeElement;
                                if (focused && focused.closest('td')) {
                                    lastActiveInput = focused;
                                    selState.selected = computeColumnSelection(selState.anchor, focused);
                                    applyHighlight();
                                    updateMobileHelperState();
                                }
                            }, 50);
                        } else {
                            navigateTable('down');
                            if (lastActiveInput) lastActiveInput.focus();
                        }
                    });
                    document.getElementById('mobile-nav-left').addEventListener('click', function() {
                        navigateTable('left');
                        if (lastActiveInput) lastActiveInput.focus();
                    });
                    document.getElementById('mobile-nav-right').addEventListener('click', function() {
                        navigateTable('right');
                        if (lastActiveInput) lastActiveInput.focus();
                    });

                    // Toggle Mode Blok (Multi-select)
                    var toggleSelectBtn = document.getElementById('mobile-toggle-select');
                    toggleSelectBtn.addEventListener('click', function() {
                        mobileSelectMode = !mobileSelectMode;
                        if (mobileSelectMode) {
                            toggleSelectBtn.classList.add('active');
                            toggleSelectBtn.querySelector('.btn-text').textContent = 'Mode Blok: ON';
                            if (lastActiveInput) {
                                selState.anchor = lastActiveInput;
                                selState.selected = [lastActiveInput];
                                applyHighlight();
                            }
                            showFillToast('Mode Blok Aktif: Tap sel lain untuk memilih rentang');
                        } else {
                            toggleSelectBtn.classList.remove('active');
                            toggleSelectBtn.querySelector('.btn-text').textContent = 'Mode Blok: OFF';
                        }
                        updateMobileHelperState();
                        if (lastActiveInput) lastActiveInput.focus();
                    });

                    // Trigger Fill Menu
                    document.getElementById('mobile-trigger-menu').addEventListener('click', function() {
                        if (selState.selected.length >= 2) {
                            showMenu();
                        }
                    });

                    // Reset Selection
                    document.getElementById('mobile-clear-select').addEventListener('click', function() {
                        clearSelection();
                        if (mobileSelectMode) {
                            mobileSelectMode = false;
                            toggleSelectBtn.classList.remove('active');
                            toggleSelectBtn.querySelector('.btn-text').textContent = 'Mode Blok: OFF';
                        }
                        if (lastActiveInput) lastActiveInput.focus();
                    });

                    // ── Draggable Helper Logic ──
                    var isDraggingHelper = false;
                    var startX = 0,
                        startY = 0;

                    function startHelperDrag(e) {
                        // Abaikan jika sedang collapse (ditangani startBubbleDrag)
                        if (helperEl.classList.contains('collapsed')) return;

                        // Jangan drag jika mengeklik tombol/interaktif
                        if (e.target.closest('button, .dpad-btn, .helper-action-btn, .helper-close-btn')) {
                            return;
                        }

                        if (e.type === 'touchstart') {
                            startX = e.touches[0].clientX;
                            startY = e.touches[0].clientY;
                        } else {
                            startX = e.clientX;
                            startY = e.clientY;
                        }

                        var rect = helperEl.getBoundingClientRect();
                        helperEl.style.right = 'auto';
                        helperEl.style.bottom = 'auto';
                        helperEl.style.left = rect.left + 'px';
                        helperEl.style.top = rect.top + 'px';

                        isDraggingHelper = true;
                        helperEl.classList.add('is-dragging'); // Menghilangkan delay animasi saat drag

                        document.addEventListener('mousemove', helperDrag);
                        document.addEventListener('touchmove', helperDrag, {
                            passive: false
                        });
                        document.addEventListener('mouseup', stopHelperDrag);
                        document.addEventListener('touchend', stopHelperDrag);
                    }

                    // Ganti dragHandle dengan helperEl agar kotak bisa di-drag dari bagian kosong manapun
                    helperEl.addEventListener('mousedown', startHelperDrag);
                    helperEl.addEventListener('touchstart', startHelperDrag, {
                        passive: false
                    });

                    // ── Bubble Collapsed juga bisa digeser ──
                    var bubbleEl = helperEl.querySelector('.helper-toggle-bubble');
                    var bubbleDragStartX = 0,
                        bubbleDragStartY = 0;
                    var bubbleIsDragging = false;
                    var bubbleMoved = false;
                    var BUBBLE_DRAG_THRESHOLD = 5; // pixel, kurang dari ini = klik (expand)

                    bubbleEl.addEventListener('mousedown', startBubbleDrag);
                    bubbleEl.addEventListener('touchstart', startBubbleDrag, {
                        passive: false
                    });

                    function startBubbleDrag(e) {
                        // Hanya saat bubble mode collapsed
                        if (!helperEl.classList.contains('collapsed')) return;

                        bubbleMoved = false;
                        if (e.type === 'touchstart') {
                            bubbleDragStartX = e.touches[0].clientX;
                            bubbleDragStartY = e.touches[0].clientY;
                            startX = bubbleDragStartX;
                            startY = bubbleDragStartY;
                        } else {
                            bubbleDragStartX = e.clientX;
                            bubbleDragStartY = e.clientY;
                            startX = bubbleDragStartX;
                            startY = bubbleDragStartY;
                        }

                        var rect = helperEl.getBoundingClientRect();
                        helperEl.style.right = 'auto';
                        helperEl.style.bottom = 'auto';
                        helperEl.style.left = rect.left + 'px';
                        helperEl.style.top = rect.top + 'px';
                        bubbleIsDragging = true;

                        document.addEventListener('mousemove', onBubbleDrag);
                        document.addEventListener('touchmove', onBubbleDrag, {
                            passive: false
                        });
                        document.addEventListener('mouseup', stopBubbleDrag);
                        document.addEventListener('touchend', stopBubbleDrag);
                    }

                    function onBubbleDrag(e) {
                        if (!bubbleIsDragging) return;
                        var clientX, clientY;
                        if (e.type === 'touchmove') {
                            e.preventDefault();
                            clientX = e.touches[0].clientX;
                            clientY = e.touches[0].clientY;
                        } else {
                            clientX = e.clientX;
                            clientY = e.clientY;
                        }

                        var dx = clientX - bubbleDragStartX;
                        var dy = clientY - bubbleDragStartY;

                        // Baru dianggap drag jika bergerak > threshold
                        if (!bubbleMoved && Math.sqrt(dx * dx + dy * dy) < BUBBLE_DRAG_THRESHOLD) return;

                        bubbleMoved = true;
                        helperEl.classList.add('is-dragging');

                        var rect = helperEl.getBoundingClientRect();
                        var newLeft = rect.left + (clientX - startX);
                        var newTop = rect.top + (clientY - startY);

                        // Boundary
                        if (newLeft < 0) newLeft = 0;
                        if (newTop < 0) newTop = 0;
                        if (newLeft + rect.width > window.innerWidth) newLeft = window.innerWidth - rect.width;
                        if (newTop + rect.height > window.innerHeight) newTop = window.innerHeight - rect.height;

                        helperEl.style.left = newLeft + 'px';
                        helperEl.style.top = newTop + 'px';

                        startX = clientX;
                        startY = clientY;
                    }

                    function stopBubbleDrag(e) {
                        bubbleIsDragging = false;
                        helperEl.classList.remove('is-dragging');
                        document.removeEventListener('mousemove', onBubbleDrag);
                        document.removeEventListener('touchmove', onBubbleDrag);
                        document.removeEventListener('mouseup', stopBubbleDrag);
                        document.removeEventListener('touchend', stopBubbleDrag);
                        // Jika tidak bergerak = klik expand, biarkan expand-btn menangani
                    }

                    function helperDrag(e) {
                        if (!isDraggingHelper) return;
                        var clientX, clientY;
                        if (e.type === 'touchmove') {
                            e.preventDefault(); // prevent scrolling
                            clientX = e.touches[0].clientX;
                            clientY = e.touches[0].clientY;
                        } else {
                            clientX = e.clientX;
                            clientY = e.clientY;
                        }

                        var dx = clientX - startX;
                        var dy = clientY - startY;

                        var rect = helperEl.getBoundingClientRect();
                        var newLeft = rect.left + dx;
                        var newTop = rect.top + dy;

                        // Boundary checks
                        if (newLeft < 0) newLeft = 0;
                        if (newTop < 0) newTop = 0;
                        if (newLeft + rect.width > window.innerWidth) newLeft = window.innerWidth - rect.width;
                        if (newTop + rect.height > window.innerHeight) newTop = window.innerHeight - rect.height;

                        helperEl.style.left = newLeft + 'px';
                        helperEl.style.top = newTop + 'px';

                        startX = clientX;
                        startY = clientY;
                    }

                    function stopHelperDrag() {
                        isDraggingHelper = false;
                        helperEl.classList.remove('is-dragging');
                        document.removeEventListener('mousemove', helperDrag);
                        document.removeEventListener('touchmove', helperDrag);
                        document.removeEventListener('mouseup', stopHelperDrag);
                        document.removeEventListener('touchend', stopHelperDrag);
                    }
                }

                /* ════════════════════════════════════════════════════════════
                3.  FILL LOGIC
                ════════════════════════════════════════════════════════════ */

                /**
                 * Cek apakah value bisa jadi angka (termasuk desimal & negatif)
                 */
                function parseNum(v) {
                    v = (v || '').toString().trim();
                    if (v === '') return null;
                    var n = parseFloat(v);
                    return isNaN(n) ? null : n;
                }

                /**
                 * Generate series value untuk posisi ke-`step` dari value awal.
                 * - Kalau angka → increment sebesar step
                 * - Kalau teks → copy saja
                 */
                function seriesValue(startVal, step) {
                    var n = parseNum(startVal);
                    if (n !== null) {
                        // Pertahankan jumlah desimal
                        var decimals = (startVal.toString().split('.')[1] || '').length;
                        var result = n + step;
                        return decimals ? result.toFixed(decimals) : result.toString();
                    }
                    return startVal; // teks: copy aja
                }

                /**
                 * Hitung step otomatis dari dua nilai (untuk seri)
                 */
                function autoStep(v1, v2) {
                    var n1 = parseNum(v1),
                        n2 = parseNum(v2);
                    if (n1 !== null && n2 !== null) return n2 - n1;
                    return 1;
                }

                /**
                 * Ambil nilai awal fill (dari anchor atau sel pertama selection)
                 */
                function getAnchorValue() {
                    return selState.anchor ? selState.anchor.value : '';
                }

                /**
                 * Core fill function.
                 * @param {string} direction  'down' | 'up' | 'right' | 'left'
                 * @param {boolean} isSeries  true = berurutan, false = copy
                 */
                function doFill(direction, isSeries) {
                    if (!selState.anchor || selState.selected.length < 2) return;

                    var table = selState.anchor.closest('table');
                    if (!table) return;

                    var allInputs = getAllTableInputs(table);
                    var anchorPos = getInputPos(selState.anchor, allInputs);
                    if (!anchorPos) return;

                    // Sort selected by direction
                    var sorted = selState.selected.slice().sort(function(a, b) {
                        var pa = getInputPos(a, allInputs);
                        var pb = getInputPos(b, allInputs);
                        if (!pa || !pb) return 0;
                        if (direction === 'down') return pa.row - pb.row;
                        if (direction === 'up') return pb.row - pa.row;
                        if (direction === 'right') return pa.col - pb.col;
                        if (direction === 'left') return pb.col - pa.col;
                        return 0;
                    });

                    var startVal = selState.anchor.value;
                    var step = 1;

                    // Deteksi step dari dua nilai pertama selection jika arah sama
                    if (isSeries && sorted.length >= 2) {
                        step = autoStep(sorted[0].value, sorted[1].value);
                        if (step === 0 || isNaN(step)) step = 1;
                    }

                    // Apakah anchor ada di set sorted?
                    var anchorIdx = sorted.indexOf(selState.anchor);
                    if (anchorIdx === -1) anchorIdx = 0;

                    sorted.forEach(function(inp, i) {
                        if (inp === selState.anchor) return; // jangan ubah anchor
                        var offset = i - anchorIdx;
                        if (isSeries) {
                            inp.value = seriesValue(startVal, offset * step);
                        } else {
                            inp.value = startVal;
                        }
                        // Trigger change event agar Vue/React/alpine bisa nangkap
                        inp.dispatchEvent(new Event('input', {
                            bubbles: true
                        }));
                        inp.dispatchEvent(new Event('change', {
                            bubbles: true
                        }));
                    });

                    showFillToast(sorted.length - 1 + ' sel di-fill (' + (isSeries ? 'berurutan' : 'copy') + ')');
                }

                /**
                 * Paste from clipboard ke selection
                 */
                function doPasteToSelection() {
                    if (selState.selected.length === 0) return;
                    navigator.clipboard.readText().then(function(text) {
                        var val = text.trim();
                        selState.selected.forEach(function(inp) {
                            inp.value = val;
                            inp.dispatchEvent(new Event('input', {
                                bubbles: true
                            }));
                            inp.dispatchEvent(new Event('change', {
                                bubbles: true
                            }));
                        });
                        showFillToast(selState.selected.length + ' sel di-paste');
                    }).catch(function() {
                        // fallback: pakai nilai anchor
                        var val = getAnchorValue();
                        selState.selected.forEach(function(inp) {
                            inp.value = val;
                            inp.dispatchEvent(new Event('input', {
                                bubbles: true
                            }));
                            inp.dispatchEvent(new Event('change', {
                                bubbles: true
                            }));
                        });
                        showFillToast(selState.selected.length + ' sel di-fill (copy anchor)');
                    });
                }

                function showFillToast(msg) {
                    fillToast.textContent = '✓ ' + msg;
                    fillToast.classList.add('show');
                    clearTimeout(fillToast._timer);
                    fillToast._timer = setTimeout(function() {
                        fillToast.classList.remove('show');
                    }, 2500);
                }

                // Hapus (kosongkan) semua input dalam seleksi
                function doDeleteSelection() {
                    if (selState.selected.length < 2) return;
                    var count = 0;
                    selState.selected.forEach(function(inp) {
                        if (inp.value !== '') {
                            inp.value = '';
                            inp.dispatchEvent(new Event('input', {
                                bubbles: true
                            }));
                            inp.dispatchEvent(new Event('change', {
                                bubbles: true
                            }));
                            count++;
                        }
                    });
                    showFillToast(count + ' sel dihapus');
                }

                // ── Menu button handlers ──
                document.getElementById('fill-down-btn').addEventListener('click', function() {
                    doFill('down', true);
                    hideMenu();
                });
                document.getElementById('fill-down-copy-btn').addEventListener('click', function() {
                    doFill('down', false);
                    hideMenu();
                });
                document.getElementById('fill-up-btn').addEventListener('click', function() {
                    doFill('up', true);
                    hideMenu();
                });
                document.getElementById('fill-up-copy-btn').addEventListener('click', function() {
                    doFill('up', false);
                    hideMenu();
                });
                document.getElementById('fill-right-btn').addEventListener('click', function() {
                    doFill('right', true);
                    hideMenu();
                });
                document.getElementById('fill-right-copy-btn').addEventListener('click', function() {
                    doFill('right', false);
                    hideMenu();
                });
                document.getElementById('fill-left-btn').addEventListener('click', function() {
                    doFill('left', true);
                    hideMenu();
                });
                document.getElementById('fill-left-copy-btn').addEventListener('click', function() {
                    doFill('left', false);
                    hideMenu();
                });
                document.getElementById('fill-all-btn').addEventListener('click', function() {
                    doPasteToSelection();
                    hideMenu();
                });
                document.getElementById('fill-clear-sel-btn').addEventListener('click', function() {
                    clearSelection();
                    hideMenu();
                });

                /* ════════════════════════════════════════════════════════════
                4.  KEYBOARD SHORTCUTS untuk Fill, Copy, Paste & Delete
                   Ctrl+C  = Copy nilai anchor ke clipboard
                   Ctrl+V  = Paste nilai clipboard ke semua seleksi
                   Ctrl+D  = Fill Down  (berurutan)
                   Ctrl+F  = Fill Right (berurutan)
                   Delete  = Hapus isi seluruh seleksi
                ════════════════════════════════════════════════════════════ */
                document.addEventListener('keydown', function(e) {
                    var inTable = document.activeElement && document.activeElement.closest('td');

                    // Delete → hapus isi seleksi (hanya jika blok ≥2 input)
                    var isDelete = (e.key === 'Delete' || (e.ctrlKey && e.key === 'Delete'));
                    if (isDelete && selState.selected.length >= 2) {
                        e.preventDefault();
                        doDeleteSelection();
                        return;
                    }

                    if (!e.ctrlKey || e.shiftKey || e.altKey) return;

                    // ── Ctrl+C : Copy semua sel yang dipilih sebagai grid (TSV, seperti Excel) ──
                    if ((e.key === 'c' || e.key === 'C') && selState.anchor) {
                        e.preventDefault();

                        // Kumpulkan sel terpilih, terurut berdasarkan posisi (baris lalu kolom)
                        var container = selState.anchor ? (selState.anchor.closest('form') || selState.anchor.closest('table') || document.body) : document.body;
                        var copyText = '';

                        if (container && selState.selected.length > 0) {
                            var allInputs = getAllTableInputs(container);

                            // Dapatkan posisi semua sel terpilih
                            var posMap = [];
                            selState.selected.forEach(function(inp) {
                                var pos = getInputPos(inp, allInputs);
                                if (pos) posMap.push({
                                    inp: inp,
                                    row: pos.row,
                                    col: pos.col
                                });
                            });

                            if (posMap.length > 0) {
                                // Temukan batas baris dan kolom
                                var rows = [...new Set(posMap.map(p => p.row))].sort(function(a, b) {
                                    return a - b;
                                });
                                var cols = [...new Set(posMap.map(p => p.col))].sort(function(a, b) {
                                    return a - b;
                                });

                                // Bangun grid TSV (tab pisah kolom, newline pisah baris)
                                var lines = [];
                                rows.forEach(function(r) {
                                    var rowCells = cols.map(function(c) {
                                        var cell = posMap.find(function(p) {
                                            return p.row === r && p.col === c;
                                        });
                                        return cell ? cell.inp.value : '';
                                    });
                                    lines.push(rowCells.join('\t'));
                                });
                                copyText = lines.join('\n');
                            }
                        }

                        if (!copyText && selState.anchor) {
                            copyText = selState.anchor.value; // fallback ke anchor saja
                        }

                        navigator.clipboard.writeText(copyText).then(function() {
                            var count = selState.selected.length;
                            showFillToast('✅ Di-copy: ' + count + ' sel');
                        }).catch(function() {
                            var tmp = document.createElement('textarea');
                            tmp.value = copyText;
                            document.body.appendChild(tmp);
                            tmp.select();
                            document.execCommand('copy');
                            document.body.removeChild(tmp);
                            showFillToast('✅ Di-copy: ' + selState.selected.length + ' sel');
                        });
                        return;
                    }

                    // ── Ctrl+V : Paste clipboard ke seleksi dengan mapping TSV per baris ──
                    if ((e.key === 'v' || e.key === 'V') && selState.selected.length >= 1) {
                        e.preventDefault();
                        navigator.clipboard.readText().then(function(text) {
                            // Cek apakah clipboard berisi multi-baris (TSV dari Ctrl+C atau Excel)
                            var clipLines = text.split('\n').map(function(l) {
                                return l.split('\t');
                            });
                            var hasMultiData = clipLines.length > 1 || (clipLines.length === 1 && clipLines[0].length > 1);

                            if (hasMultiData && selState.selected.length > 1) {
                                // Paste grid: mapping per baris dari posisi sel terpilih
                                var container = selState.anchor ? (selState.anchor.closest('form') || selState.anchor.closest('table') || document.body) : document.body;
                                if (container) {
                                    var allInputs = getAllTableInputs(container);
                                    var posMap = [];
                                    selState.selected.forEach(function(inp) {
                                        var pos = getInputPos(inp, allInputs);
                                        if (pos) posMap.push({
                                            inp: inp,
                                            row: pos.row,
                                            col: pos.col
                                        });
                                    });

                                    var selRows = [...new Set(posMap.map(p => p.row))].sort(function(a, b) {
                                        return a - b;
                                    });
                                    var selCols = [...new Set(posMap.map(p => p.col))].sort(function(a, b) {
                                        return a - b;
                                    });

                                    selRows.forEach(function(r, ri) {
                                        var clipRow = clipLines[ri % clipLines.length] || [];
                                        selCols.forEach(function(c, ci) {
                                            var cell = posMap.find(function(p) {
                                                return p.row === r && p.col === c;
                                            });
                                            if (cell) {
                                                var clipVal = (clipRow[ci % clipRow.length] || '').trim();
                                                cell.inp.value = clipVal;
                                                cell.inp.dispatchEvent(new Event('input', {
                                                    bubbles: true
                                                }));
                                                cell.inp.dispatchEvent(new Event('change', {
                                                    bubbles: true
                                                }));
                                            }
                                        });
                                    });
                                    showFillToast(selState.selected.length + ' sel di-paste (grid)');
                                    return;
                                }
                            }

                            // Paste nilai tunggal ke semua sel
                            var val = text.trim();
                            selState.selected.forEach(function(inp) {
                                inp.value = val;
                                inp.dispatchEvent(new Event('input', {
                                    bubbles: true
                                }));
                                inp.dispatchEvent(new Event('change', {
                                    bubbles: true
                                }));
                            });
                            showFillToast(selState.selected.length + ' sel di-paste: "' + val + '"');
                        }).catch(function() {
                            showFillToast('Akses clipboard ditolak — izinkan clipboard di browser');
                        });
                        return;
                    }

                    if (selState.selected.length < 2) return;

                    // Ctrl+D = Fill Down berurutan
                    if (e.key === 'd' || e.key === 'D') {
                        e.preventDefault();
                        doFill('down', true);
                    }
                    // Ctrl+F = Fill Right berurutan
                    if (e.key === 'f' || e.key === 'F') {
                        e.preventDefault();
                        doFill('right', true);
                    }
                });

            })();
        </script>
    </body>

    </html>