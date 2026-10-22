<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="brand-wrapper text-center py-3">
        <a href="{{ route('dashboard') }}" class="brand-logo-link d-block mb-2">
            <div style="background: white; padding: 8px; border-radius: 8px; display: inline-block;">
                <img src="{{ asset('logo_pas_basic.png') }}" alt="PT PAS Logo" 
                     style="width: 140px; height: auto; max-height: 45px; object-fit: contain;">
            </div>
        </a>
        <div class="brand-text mt-2">
            <h5 class="text-white mb-0" style="font-weight: 600;">Calibration In Action</h5>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Dashboard - Semua role -->
                 @if(!isPpic())
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @endif
               <!-- Dashboard Control - Super Admin, Approver, Checker -->
              <!-- Dashboard Control - Super Admin & Teknisi PAS-069 -->
                @if(canAccessDashboardControl())
                <li class="nav-item">
                    <a href="{{ route('dashboard.control') }}" class="nav-link {{ request()->routeIs('dashboard.control') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-sliders-h"></i>
                        <p>Dashboard Control</p>
                    </a>
                </li>
                @endif

                <!-- MAIN MENU - Tampil untuk super admin, teknisi, approver, checker -->
                @if(can('super admin,teknisi,approver,checker'))
                <li class="nav-header text-uppercase">MAIN MENU</li>

                <!-- Calibrations -->
                <li class="nav-item {{ request()->is('calibrations*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('calibrations*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-ruler-combined"></i>
                        <p>
                            Calibrations
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- Daftar Kalibrasi - Semua role -->
                        <li class="nav-item">
                            <a href="{{ route('calibrations.index') }}" class="nav-link {{ request()->routeIs('calibrations.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar Kalibrasi</p>
                            </a>
                        </li>
                        
                        <!-- Input Kalibrasi - Hanya super admin dan teknisi -->
                        @if(can('super admin,teknisi'))
                        <li class="nav-item">
                            <a href="{{ route('calibrations.create') }}" class="nav-link {{ request()->routeIs('calibrations.create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Input Kalibrasi</p>
                            </a>
                        </li>
                        @endif
                        
                             <!-- Recycle Bin Data Kalibrasi -->
                        @if(can('super admin'))
                        <li class="nav-item">
                            <a href="{{ route('calibrations.recycle-bin') }}" class="nav-link {{ request()->routeIs('calibrations.recycle-bin') ? 'active' : '' }}">
                                <i class="fas fa-trash-restore nav-icon text-warning"></i>
                                <p>Recycle Bin</p>
                            </a>
                        </li>
                        @endif
                        
                        
                        
                        
                        <!-- Berita Acara - Hanya super admin dan teknisi -->
                        @if(can('super admin,teknisi'))
                        <li class="nav-item">
                            <a href="{{ route('berita-acara.list') }}" class="nav-link {{ request()->routeIs('berita-acara.list') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Berita Acara</p>
                            </a>
                        </li>
                        @endif
                        
                         <!-- Cetak Label Old -->
                        @if(can('super admin,teknisi,approver,checker'))
                        <li class="nav-item">
                            <a href="{{ route('cetak-label-old.index') }}" class="nav-link {{ request()->routeIs('cetak-label-old.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cetak Label Old</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                
                <!-- File Template Kalibrasi -->
                @if(can('super admin,approver,checker'))
                <li class="nav-item">
                    <a href="{{ route('file-template.index') }}"
                       class="nav-link {{ request()->routeIs('file-template.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-excel" style="color:#ffffff;"></i>
                        <p>
                            File Template
                            @php
                                $approvedCount = count(\Illuminate\Support\Facades\File::exists(public_path('data_approved')) ? \Illuminate\Support\Facades\File::files(public_path('data_approved')) : []);
                                $verifiedCount = count(\Illuminate\Support\Facades\File::exists(public_path('data_verified')) ? \Illuminate\Support\Facades\File::files(public_path('data_verified')) : []);
                                $totalBadge = $approvedCount + $verifiedCount;
                            @endphp
                            @if($totalBadge > 0)
                            <span class="badge badge-success badge-pill right" style="font-size:.7rem;">{{ $totalBadge }}</span>
                            @endif
                        </p>
                    </a>
                </li>
                @endif
                
                <!-- Sertifikat Kalibrasi Digital (Network Share) -->
                @if(can('super admin,checker,approver'))
                <li class="nav-item">
                    <a href="{{ route('sertifikat-kalibrasi.index') }}"
                       class="nav-link {{ request()->routeIs('sertifikat-kalibrasi.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-pdf" style="color:#ffffff;"></i>
                        <p>
                            Sertifikat Kalibrasi
                            @php
                                try {
                                    $skPath = '\\\\Compass\\Sertifikat Digital';
                                    $skCount = is_dir($skPath) ? count(array_filter(scandir($skPath), fn($f) => strtolower(pathinfo($f, PATHINFO_EXTENSION)) === 'pdf')) : 0;
                                } catch (\Exception $e) {
                                    $skCount = 0;
                                }
                            @endphp
                            @if($skCount > 0)
                            <span class="badge badge-danger badge-pill right" style="font-size:.7rem;">{{ $skCount }}</span>
                            @endif
                        </p>
                    </a>
                </li>
                @endif
                
                <!-- Template Macro Excel -->
                @if(can('super admin,approver,checker'))
                <li class="nav-item">
                    <a href="{{ route('template-macro.index') }}"
                       class="nav-link {{ request()->routeIs('template-macro.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-code" style="color:#ffffff;"></i>
                        <p>
                            Template Macro Excel
                        </p>
                    </a>
                </li>
                @endif

                <!-- Registrasi User - Hanya super admin -->
                @if(isSuperAdmin())
                <li class="nav-item">
                    <a href="{{ route('register-user') }}" class="nav-link {{ request()->routeIs('register-user') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>Registrasi User</p>
                    </a>
                </li>
                @endif

                <!-- ========================================== -->
                <!-- MASTER DATA - Hanya Super Admin -->
                <!-- ========================================== -->
                @if(isSuperAdmin())
                <li class="nav-header text-uppercase mt-2">MASTER DATA</li>
                
                <!-- Control Data (Khusus Super Admin) -->
                <li class="nav-item">
                    <a href="{{ route('control-data.index') }}" 
                       class="nav-link {{ request()->routeIs('control-data.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-database text-info"></i>
                        <p>
                            Control Data
                            <span class="badge badge-warning badge-pill right" style="font-size:.65rem;">Super Admin</span>
                        </p>
                    </a>
                </li>

                <!-- Kompetensi Teknisi -->
                <li class="nav-item">
                    <a href="{{ route('kompetensi.index') }}" 
                       class="nav-link {{ request()->routeIs('kompetensi.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-graduate"></i>
                        <p>
                            Kompetensi Teknisi
                            @php
                                $totalTeknisi = \App\Models\User::where('role', 'teknisi')->count();
                            @endphp
                            @if($totalTeknisi > 0)
                            <span class="badge badge-info badge-pill right" style="font-size:.7rem;">{{ $totalTeknisi }}</span>
                            @endif
                        </p>
                    </a>
                </li>
                @endif

                <!-- SYSTEM ACTIVITY LOGS - New System -->
                @if(isSuperAdmin())
                <li class="nav-header text-uppercase mt-2">Log</li>
                <li class="nav-item">
                    <a href="{{ route('activity-logs.index') }}" 
                       class="nav-link {{ request()->routeIs('activity-logs.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-fingerprint"></i>
                        <p>
                            Log Aktivitas Real Time
                        </p>
                    </a>
                </li>
                @endif

                @endif {{-- Tutup MAIN MENU --}}

                <!-- Informasi User di Sidebar (Opsional) -->
                
            </ul>
        </nav>
    </div>
</aside>

<!-- Tambahkan style untuk badge -->
<style>
.nav-sidebar .nav-treeview > .nav-item > .nav-link > .badge {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 10px;
    padding: 3px 6px;
}

/* Style untuk role badge di sidebar */
.nav-sidebar .nav-link .badge {
    position: static;
    display: inline-block;
    margin-left: 5px;
    transform: none;
    font-size: 10px;
    padding: 2px 5px;
}

/* Hover effect */
.nav-sidebar .nav-item:hover {
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 4px;
}

/* Collapsed sidebar custom styles (only when not hovered) */
body.sidebar-collapse .main-sidebar:not(:hover) .brand-wrapper {
    padding: 0.75rem 0.5rem !important;
}
body.sidebar-collapse .main-sidebar:not(:hover) .brand-wrapper a div {
    width: 40px !important;
    height: 40px !important;
    border-radius: 50% !important;
    overflow: hidden !important;
    padding: 4px !important;
    margin: 0 auto !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    background: white !important;
}
body.sidebar-collapse .main-sidebar:not(:hover) .brand-wrapper a div img {
    width: 100% !important;
    height: 100% !important;
    max-height: none !important;
    object-fit: contain !important;
}
body.sidebar-collapse .main-sidebar:not(:hover) .brand-text {
    display: none !important;
}
body.sidebar-collapse .main-sidebar:not(:hover) .nav-header {
    display: none !important;
}
body.sidebar-collapse .main-sidebar:not(:hover) .nav-sidebar .nav-item {
    margin: 8px 0 !important;
}
body.sidebar-collapse .main-sidebar:not(:hover) .nav-sidebar .nav-item .nav-link {
    padding: 5px 0 !important;
    margin: 0 !important;
    text-align: center !important;
    background: transparent !important;
    box-shadow: none !important;
}
body.sidebar-collapse .main-sidebar:not(:hover) .nav-sidebar .nav-item .nav-link i {
    background: rgba(255, 255, 255, 0.15) !important;
    border-radius: 50% !important;
    width: 38px !important;
    height: 38px !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    margin: 0 auto !important;
    transition: all 0.2s ease-in-out !important;
    color: #fff !important;
}
body.sidebar-collapse .main-sidebar:not(:hover) .nav-sidebar .nav-item .nav-link:hover i {
    background: rgba(255, 255, 255, 0.3) !important;
}
body.sidebar-collapse .main-sidebar:not(:hover) .nav-sidebar .nav-item .nav-link.active i {
    background: rgba(255, 255, 255, 0.4) !important;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15) !important;
}
body.sidebar-collapse .main-sidebar:not(:hover) .nav-sidebar .nav-link p,
body.sidebar-collapse .main-sidebar:not(:hover) .nav-sidebar .nav-link .right,
body.sidebar-collapse .main-sidebar:not(:hover) .nav-sidebar .nav-link .badge {
    display: none !important;
}
</style>