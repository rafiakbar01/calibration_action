<header class="app-header bg-white shadow-sm border-bottom sticky-top" style="z-index: 1030;">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between py-2">

            <!-- Toggle Sidebar -->
            <a href="#" class="nav-link p-2 text-primary" data-widget="pushmenu" role="button" title="Toggle Menu">
                <i class="fas fa-bars fa-lg"></i>
            </a>

            <!-- Logo hanya di mobile -->
            <div class="d-block d-md-none">
                <img src="{{ asset('logo_pas_basic.png') }}" alt="PT PAS Logo"
                     class="img-fluid" style="max-height: 32px; width: auto;">
            </div>

            <!-- User Dropdown -->
            <div class="dropdown">
                <a class="d-flex align-items-center text-decoration-none text-dark dropdown-toggle"
                   href="#"
                   role="button"
                   id="userDropdown"
                   data-toggle="dropdown"
                   aria-haspopup="true"
                   aria-expanded="false">
                    <!-- Foto dari kolom 'foto' - Header kecil -->
                    @if(auth()->user()->foto) {{-- Ganti auth()->user()->foto_profil --}}
                        <img src="{{ asset('profile_foto/' . auth()->user()->foto) }}" {{-- Ganti auth()->user()->foto --}}
                             class="rounded-circle mr-2 shadow-sm object-fit-cover"
                             width="36"
                             height="36"
                             alt="Foto {{ auth()->user()->nama }}"
                             onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nama) }}&background=4e73df&color=fff&rounded=true&size=128'">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nama ?? 'Admin') }}&background=4e73df&color=fff&rounded=true&size=128"
                             class="rounded-circle mr-2 shadow-sm"
                             width="36"
                             height="36"
                             alt="Avatar">
                    @endif
                    <span class="d-none d-md-inline font-weight-medium">
                        {{ auth()->user()->nama ?? 'Admin' }}
                    </span>
                </a>

                <!-- Dropdown Menu -->
                <div class="dropdown-menu dropdown-menu-right shadow-lg border-0 mt-2"
                     aria-labelledby="userDropdown"
                     style="min-width: 300px; border-radius: 12px; overflow: hidden;">

                    <!-- Header User Info -->
                    <div class="px-4 py-4 text-center text-white" style="background: linear-gradient(135deg, #4e73df, #224abe);">
                        <!-- Foto dari kolom 'foto' - Dropdown besar -->
                        <div class="position-relative d-inline-block">
                            @if(auth()->user()->foto) {{-- Ganti auth()->user()->foto_profil --}}
                                <img src="{{ asset('profile_foto/' . auth()->user()->foto) }}" {{-- Ganti auth()->user()->foto --}}
                                     class="rounded-circle shadow-lg mb-3 border border-white border-3 object-fit-cover"
                                     width="90"
                                     height="90"
                                     alt="Foto {{ auth()->user()->nama }}"
                                     onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nama) }}&background=ffffff&color=4e73df&rounded=true&bold=true&size=200'">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nama ?? 'Admin') }}&background=ffffff&color=4e73df&rounded=true&bold=true&size=200"
                                     class="rounded-circle shadow-lg mb-3 border border-white border-3"
                                     width="90"
                                     height="90"
                                     alt="User Avatar">
                            @endif
                           
                        </div>
                        <h6 class="mb-1 font-weight-bold">{{ auth()->user()->nama ?? 'Admin' }}</h6>
                        <small class="opacity-90">
                            {{ ucfirst(auth()->user()->role ?? 'User') }} • {{ auth()->user()->nik ?? '-' }}
                        </small>
                    </div>

                    <div class="dropdown-divider my-0"></div>

                    <!-- Menu Items -->
                    <a class="dropdown-item py-3 px-4" href="{{ route('profile.edit') }}">
                        <i class="fas fa-user-circle mr-3 text-primary"></i>
                        <div>
                            <strong>Profile</strong>
                            <small class="text-muted d-block">Lihat dan ubah data pribadi</small>
                        </div>
                    </a>

                    <a class="dropdown-item py-3 px-4" href="{{ route('profile.photo') }}">
                        <i class="fas fa-camera mr-3 text-success"></i>
                        <div>
                            <strong>Foto Profil</strong>
                            <small class="text-muted d-block">Ubah foto profil Anda</small>
                        </div>
                    </a>

                    <a class="dropdown-item py-3 px-4" href="{{ route('password.change') }}">
                        <i class="fas fa-key mr-3 text-warning"></i>
                        <div>
                            <strong>Ganti Password</strong>
                            <small class="text-muted d-block">Keamanan akun</small>
                        </div>
                    </a>

                    <div class="dropdown-divider my-0"></div>

                    <!-- System Version -->
                    <div class="px-4 py-2 text-center text-muted small">
                        <i class="fas fa-info-circle mr-1"></i>
                        System v{{ config('app.version', '1.0.0') }}
                        • 
                        <i class="fas fa-calendar-alt ml-1 mr-1"></i>
                        {{ auth()->user()->created_at?->format('M Y') ?? 'Baru' }}
                    </div>

                    <!-- Logout -->
                    <div class="px-3 py-3">
                        <form method="POST" action="{{ route('logout') }}" class="text-center">
                            @csrf
                            <button type="submit"
                                    class="btn btn-danger btn-block btn-sm rounded-pill py-2 shadow-sm">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>