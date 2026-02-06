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
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- MAIN MENU - Hanya tampil untuk super admin atau semua role -->
                @if(auth()->user()->role === 'super admin' || 
                    in_array(auth()->user()->role, ['teknisi', 'approver', 'checker']))
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
                        <li class="nav-item">
                            <a href="{{ route('calibrations.index') }}" class="nav-link {{ request()->routeIs('calibrations.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar Kalibrasi</p>
                            </a>
                        </li>
                        <!-- Input Kalibrasi hanya untuk teknisi dan super admin -->
                        @if(auth()->user()->role === 'super admin' || auth()->user()->role === 'teknisi')
                        <li class="nav-item">
                            <a href="{{ route('calibrations.create') }}" class="nav-link {{ request()->routeIs('calibrations.create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Input Kalibrasi</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>

               <!-- ACTIVITY LOG MENU -->
                    <li class="nav-header text-uppercase mt-3">ACTIVITY LOG</li>
                    <li class="nav-item {{ request()->is('log-kalibrasi*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('log-kalibrasi*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-history"></i>
                            <p>
                                Log Kalibrasi
                                <i class="right fas fa-angle-left"></i>
                                @if(class_exists('App\Models\CalibrationLog'))
                                    @php
                                        $todayLogsCount = App\Models\CalibrationLog::whereDate('created_at', today())->count();
                                    @endphp
                                    @if($todayLogsCount > 0)
                                        <span class="badge badge-info right">{{ $todayLogsCount }}</span>
                                    @endif
                                @endif
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('log-kalibrasi.index') }}" 
                                class="nav-link {{ request()->routeIs('log-kalibrasi.index') ? 'active' : '' }}">
                                    <i class="fas fa-clipboard-list nav-icon"></i>
                                    <p>Semua Log Kalibrasi</p>
                                    @if(class_exists('App\Models\CalibrationLog'))
                                        @php
                                            $totalLogsCount = App\Models\CalibrationLog::count();
                                        @endphp
                                        @if($totalLogsCount > 0)
                                            <span class="badge badge-primary right">{{ $totalLogsCount }}</span>
                                        @endif
                                    @endif
                                </a>
                            </li>
                        </ul>
                    </li>

                <!-- Registrasi User - Hanya untuk super admin -->
                @if(auth()->user()->role === 'super admin')
                <li class="nav-item">
                    <a href="{{ route('register-user') }}" class="nav-link {{ request()->routeIs('register-user') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>Registrasi User</p>
                    </a>
                </li>
                @endif

                <!-- MASTER DATA - Hanya untuk super admin -->
                @if(auth()->user()->role === 'super admin')
                <li class="nav-header text-uppercase">MASTER DATA</li>

                <!-- Alat Standard -->
                <li class="nav-item {{ request()->is('alat-standards*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('alat-standards*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>
                            Alat Standard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('alat-standards.index') }}" class="nav-link {{ request()->routeIs('alat-standards.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar Alat</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('alat-standards.create') }}" class="nav-link {{ request()->routeIs('alat-standards.create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah Alat</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Metode Kalibrasi -->
                <li class="nav-item {{ request()->is('calibration-methods*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('calibration-methods*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Metode Kalibrasi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('calibration-methods.index') }}" class="nav-link {{ request()->routeIs('calibration-methods.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar Metode</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('calibration-methods.create') }}" class="nav-link {{ request()->routeIs('calibration-methods.create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah Metode</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                @endif
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
</style>