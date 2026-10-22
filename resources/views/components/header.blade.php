<!-- Header -->
<header class="app-header shadow border-bottom sticky-top"
        style="z-index: 1030;
               background: linear-gradient(180deg, #f9fafb 0%, #ffffff 100%);
               border-bottom: 1px solid #e2e8f0;">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between py-2">

            <!-- Logo & Toggle -->
            <div class="d-flex align-items-center">
                <a href="javascript:void(0)" class="nav-link p-2 text-primary toggle-hover me-3"
                   id="sidebarToggle" data-widget="pushmenu" role="button" title="Toggle Menu">
                    <i class="fas fa-bars fa-lg"></i>
                </a>

              
            </div>

            <!-- User Dropdown -->
            <div class="dropdown" style="position: relative; margin-right: 15px;">
                <a class="d-flex align-items-center text-decoration-none dropdown-toggle user-dropdown-toggle"
                   href="javascript:void(0)" role="button" id="userDropdown"
                   data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                    
                    <!-- Foto Profil -->
                    @if(auth()->user()->foto)
                        <img src="{{ asset('profile_foto/' . auth()->user()->foto) }}"
                             class="rounded-circle me-2 shadow-sm object-fit-cover"
                             width="38" height="38"
                             alt="Foto {{ auth()->user()->nama }}"
                             onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nama) }}&background=5a9cff&color=fff&rounded=true&size=128'">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nama ?? 'Admin') }}&background=5a9cff&color=fff&rounded=true&size=128"
                             class="rounded-circle me-2 shadow-sm"
                             width="38" height="38" alt="Avatar">
                    @endif

                    <span class="d-none d-md-inline fw-medium text-dark ms-1">
                        {{ auth()->user()->nama ?? 'Admin' }}
                    </span>
                </a>

                <!-- Dropdown Menu -->
                <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 p-0 overflow-hidden"
                    aria-labelledby="userDropdown"
                    style="min-width: 320px;
                           max-width: 360px;
                           border-radius: 12px;
                           margin-top: 10px;
                           z-index: 1055;">
                    
                    <!-- Header Info User -->
                    <li class="px-4 py-4 text-center text-white"
                        style="background: linear-gradient(135deg, #5a9cff 0%, #3b82f6 100%); border-radius: 12px 12px 0 0;">
                        @if(auth()->user()->foto)
                            <img src="{{ asset('profile_foto/' . auth()->user()->foto) }}"
                                 class="rounded-circle shadow-lg mb-3 border border-white border-3 object-fit-cover"
                                 width="80" height="80"
                                 alt="Foto {{ auth()->user()->nama }}"
                                 onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nama) }}&background=ffffff&color=5a9cff&rounded=true&bold=true&size=160'">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nama ?? 'Admin') }}&background=ffffff&color=5a9cff&rounded=true&bold=true&size=160"
                                 class="rounded-circle shadow-lg mb-3 border border-white border-3"
                                 width="80" height="80" alt="Avatar">
                        @endif
                        <h6 class="mb-1 fw-bold" style="font-size: 1.1rem;">
                            {{ auth()->user()->nama ?? 'Admin' }}
                        </h6>
                        <small class="opacity-90" style="font-size: 0.82rem;">
                            {{ ucfirst(auth()->user()->role ?? 'User') }} • {{ auth()->user()->nik ?? '-' }}
                        </small>
                    </li>

                    <li><hr class="dropdown-divider my-1"></li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center py-2 px-4 hover-bg-light"
                           href="{{ route('profile.edit') }}">
                            <i class="fas fa-user-circle me-3 text-primary" style="font-size: 1.3rem; width: 24px;"></i>
                            <div>
                                <div class="fw-medium">Profile</div>
                                <small class="text-muted">Kelola data pribadi</small>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center py-2 px-4 hover-bg-light"
                           href="{{ route('password.change') }}">
                            <i class="fas fa-key me-3 text-warning" style="font-size: 1.3rem; width: 24px;"></i>
                            <div>
                                <div class="fw-medium">Ganti Password</div>
                                <small class="text-muted">Keamanan akun</small>
                            </div>
                        </a>
                    </li>

                    <li><hr class="dropdown-divider my-1"></li>

                    <li class="px-4 py-2 text-center text-muted small">
                        <i class="fas fa-info-circle me-1"></i> v{{ config('app.version', '1.0.0') }}
                        <span class="mx-2">•</span>
                        <i class="fas fa-calendar-alt me-1"></i> Bergabung {{ auth()->user()->created_at?->format('M Y') ?? 'Baru' }}
                    </li>

                    <li class="px-4 py-3 bg-light" style="border-radius: 0 0 12px 12px;">
                        <button type="button" class="btn btn-danger rounded-pill shadow-sm w-100"
                                id="logoutButton" style="font-size: 0.95rem; padding: 0.6rem 1rem;">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </button>
                        <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>

<!-- SweetAlert2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- CSS Tambahan -->
<style>
    .app-header { transition: all 0.3s ease; }
    .app-header:hover { box-shadow: 0 6px 16px rgba(0,0,0,0.08) !important; }
    .toggle-hover:hover, .user-dropdown-toggle:hover {
        background-color: rgba(90, 156, 255, 0.1);
        border-radius: 8px;
    }
    
    /* Fix dropdown position */
    .dropdown {
        position: relative;
        margin-right: 15px !important;
    }
    
    .dropdown-menu-end {
        right: -30px !important;
        left: auto !important;
    }
    
    /* Untuk layar yang lebih kecil */
    @media (max-width: 1400px) {
        .dropdown-menu-end {
            right: -40px !important;
        }
    }
    
    @media (max-width: 1200px) {
        .dropdown-menu-end {
            right: -50px !important;
            min-width: 300px !important;
        }
    }
    
    @media (max-width: 992px) {
        .dropdown-menu-end {
            right: -20px !important;
        }
    }
    
    @media (max-width: 768px) {
        .dropdown-menu-end {
            right: -10px !important;
        }
    }
    
    @media (max-width: 576px) {
        .dropdown-menu-end {
            right: -5px !important;
            min-width: 90vw !important;
            max-width: 320px !important;
        }
    }
    
    .hover-bg-light:hover { background-color: #f1f5f9; }
    .object-fit-cover { object-fit: cover; }

    /* Geser toggle sidebar ke kanan saat sidebar terbuka / collapse */
    @media (min-width: 992px) {
        body:not(.sidebar-collapse) #sidebarToggle {
            margin-left: 230px;
            transition: margin-left 0.3s ease-in-out;
        }
        body.sidebar-collapse #sidebarToggle {
            margin-left: 4.6rem;
            transition: margin-left 0.3s ease-in-out;
        }
        body.sidebar-collapse:has(.main-sidebar:hover) #sidebarToggle {
            margin-left: 230px;
            transition: margin-left 0.3s ease-in-out;
        }
    }
    
    /* Fix untuk Bootstrap dropdown */
    .dropdown-toggle::after {
        display: inline-block !important;
        margin-left: 0.5rem;
        vertical-align: middle;
    }
</style>

<!-- Script -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Logout dengan SweetAlert2
    const logoutBtn = document.getElementById('logoutButton');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Logout?',
                text: "Anda akan keluar dari sistem",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Logout',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        });
    }

    // Persist sidebar state using MutationObserver to detect class changes on document.body
    const sidebarObserver = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.attributeName === 'class') {
                const isCollapsed = document.body.classList.contains('sidebar-collapse');
                localStorage.setItem('sidebar-state', isCollapsed ? 'collapsed' : 'expanded');
            }
        });
    });
    sidebarObserver.observe(document.body, { attributes: true, attributeFilter: ['class'] });

    // ===== PERBAIKAN DROPDOWN - CARA SEDERHANA =====
    const userDropdown = document.getElementById('userDropdown');
    const dropdownMenu = document.querySelector('.dropdown-menu[aria-labelledby="userDropdown"]');
    
    if (userDropdown && dropdownMenu) {
        // Toggle dropdown saat diklik
        userDropdown.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            // Toggle class 'show' pada dropdown menu
            dropdownMenu.classList.toggle('show');
            
            // Update aria-expanded
            const isExpanded = dropdownMenu.classList.contains('show');
            userDropdown.setAttribute('aria-expanded', isExpanded);
        });
        
        // Tutup dropdown saat klik di luar
        document.addEventListener('click', function(e) {
            if (!userDropdown.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.remove('show');
                userDropdown.setAttribute('aria-expanded', 'false');
            }
        });
        
        // Cegah penutupan saat klik di dalam dropdown menu
        dropdownMenu.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    }
    
    // Untuk dropdown items yang merupakan link
    const dropdownItems = document.querySelectorAll('.dropdown-item');
    dropdownItems.forEach(function(item) {
        item.addEventListener('click', function() {
            // Tutup dropdown setelah klik item (kecuali tombol logout)
            if (this.getAttribute('href') && !this.querySelector('#logoutButton')) {
                dropdownMenu.classList.remove('show');
                userDropdown.setAttribute('aria-expanded', 'false');
            }
        });
    });
    
    // Fix untuk tombol logout
    const logoutBtn2 = document.getElementById('logoutButton');
    if (logoutBtn2) {
        logoutBtn2.addEventListener('click', function(e) {
            // Jangan tutup dropdown karena akan muncul SweetAlert
            e.stopPropagation();
        });
    }
});
</script>