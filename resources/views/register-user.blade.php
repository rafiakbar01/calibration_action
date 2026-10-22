@extends('layouts.app')

@section('title', 'Manajemen User')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
  
    </h1>
    @can('super admin')
    <button onclick="openModal()" class="btn btn-primary btn-sm shadow-sm">
        <i class="fas fa-plus-circle mr-1"></i> Tambah User Baru
    </button>
    @endcan
</div>

<!-- Notifikasi -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <div class="d-flex align-items-center">
            <i class="fas fa-check-circle fa-2x mr-3"></i>
            <div>
                <strong>Berhasil!</strong> {{ session('success') }}
            </div>
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
        <div class="d-flex align-items-center">
            <i class="fas fa-exclamation-circle fa-2x mr-3"></i>
            <div>
                <strong>Gagal!</strong> {{ session('error') }}
            </div>
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- Statistik Cards -->
<div class="row mb-4">
    <div class="col-xl col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Users</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Models\User::count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Super Admin</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ \App\Models\User::where('role', 'super admin')->count() }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-crown fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Teknisi</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ \App\Models\User::where('role', 'teknisi')->count() }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-tools fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Approver & Checker</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ \App\Models\User::whereIn('role', ['approver', 'checker'])->count() }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check-double fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl col-md-6 mb-4">
        <div class="card border-left-dark shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                            PPIC</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ \App\Models\User::where('role', 'ppic')->count() }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-boxes fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Card -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-wrap align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-list mr-2"></i> Daftar User
        </h6>
        <div class="mt-2 mt-sm-0">
            <span class="badge badge-primary mr-2">Total: {{ \App\Models\User::count() }} user</span>
            <button onclick="openModal()" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="users-table" class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th width="30">No</th>
                        <th>User</th>
                        <th>NIK</th>
                        <th>Role</th>
                        <th>Foto Profil</th>
                        <th>Session Token</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(\App\Models\User::all() as $index => $user)
                        @php
                            $badge = match($user->role) {
                                'super admin' => 'danger',
                                'teknisi'     => 'info',
                                'checker'     => 'warning',
                                'approver'    => 'success',
                                'ppic'        => 'primary',
                                default       => 'secondary'
                            };
                            
                            $roleIcon = match($user->role) {
                                'super admin' => 'fa-crown',
                                'teknisi'     => 'fa-tools',
                                'checker'     => 'fa-clipboard-check',
                                'approver'    => 'fa-check-circle',
                                'ppic'        => 'fa-boxes',
                                default       => 'fa-user'
                            };
                        @endphp
                        <tr>
                            <td class="align-middle text-center">{{ $index + 1 }}</td>
                            <td class="align-middle">
                                <div class="d-flex align-items-center">
                                    <div class="mr-3">
                                        @if($user->foto)
                                            <img src="{{ asset('profile_foto/' . $user->foto) }}" 
                                                 class="rounded-circle shadow-sm object-fit-cover border"
                                                 width="45" height="45" 
                                                 style="object-fit: cover; border: 2px solid #4e73df !important;"
                                                 alt="{{ $user->nama }}"
                                                 onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($user->nama) }}&background=4e73df&color=fff&rounded=true&size=90'">
                                        @else
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->nama) }}&background=4e73df&color=fff&rounded=true&size=90" 
                                                 class="rounded-circle shadow-sm border"
                                                 width="45" height="45"
                                                 style="border: 2px solid #4e73df !important;"
                                                 alt="{{ $user->nama }}">
                                        @endif
                                    </div>
                                    <div>
                                        <div class="font-weight-bold">{{ $user->nama }}</div>
                                        <small class="text-muted">
                                            <i class="fas fa-envelope fa-xs mr-1"></i>{{ $user->email ?? 'No email' }}
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle">
                                <span class="badge badge-light py-2 px-3">{{ $user->nik }}</span>
                            </td>
                            <td class="align-middle">
                                <span class="badge badge-{{ $badge }} py-2 px-3">
                                    <i class="fas {{ $roleIcon }} mr-1"></i> {{ formatRole($user->role) }}
                                </span>
                            </td>
                            <td class="align-middle text-center">
                                @if($user->foto)
                                    <span class="badge badge-success px-3 py-2">
                                        <i class="fas fa-check-circle mr-1"></i> Ada
                                    </span>
                                    <button onclick="viewPhoto('{{ addslashes($user->nama) }}', '{{ asset('profile_foto/' . $user->foto) }}')" 
                                            class="btn btn-sm btn-info ml-1" title="Lihat Foto">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                @else
                                    <span class="badge badge-secondary px-3 py-2">
                                        <i class="fas fa-times-circle mr-1"></i> Tidak Ada
                                    </span>
                                @endif
                            </td>
                            <td class="align-middle">
                                <div class="d-flex flex-column">
                                    @if($user->session_token)
                                        <span class="badge badge-warning mb-1" style="cursor: pointer;" onclick="copyToClipboard('{{ $user->session_token }}')" title="Klik untuk copy">
                                            <i class="fas fa-key mr-1"></i> Token Aktif
                                        </span>
                                        <small class="text-muted" style="font-size: 10px;">{{ substr($user->session_token, 0, 20) }}...</small>
                                    @else
                                        <span class="badge badge-secondary">
                                            <i class="fas fa-clock mr-1"></i> Tidak Aktif
                                        </span>
                                    @endif
                                    <button onclick="clearSessionToken('{{ $user->id }}', '{{ addslashes($user->nama) }}')" 
                                            class="btn btn-sm btn-outline-danger mt-1" 
                                            title="Hapus Session Token"
                                            style="font-size: 11px;">
                                        <i class="fas fa-trash-alt"></i> Hapus Token
                                    </button>
                                </div>
                            </td>
                            <td class="align-middle">
                                <div class="btn-group" role="group">
                                    <button onclick="editUser(this)" 
                                            data-id="{{ $user->id }}"
                                            data-nik="{{ $user->nik }}"
                                            data-nama="{{ $user->nama }}"
                                            data-role="{{ $user->role }}"
                                            data-password="{{ $user->password_plain ?? '' }}"
                                            class="btn btn-warning btn-sm" 
                                            title="Edit User"
                                            data-toggle="tooltip">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="showPassword('{{ $user->id }}', '{{ addslashes($user->nama) }}')" 
                                            class="btn btn-success btn-sm"
                                            title="Lihat Password Saat Ini"
                                            data-toggle="tooltip">
                                        <i class="fas fa-key"></i>
                                    </button>
                                    <button onclick="managePhoto('{{ $user->id }}', '{{ addslashes($user->nama) }}', '{{ $user->foto }}', '{{ $user->role }}')" 
                                            class="btn btn-info btn-sm {{ $user->foto ? 'btn-info' : 'btn-success' }}"
                                            title="{{ $user->foto ? 'Ganti Foto' : 'Tambah Foto' }}"
                                            data-toggle="tooltip">
                                        <i class="fas fa-camera"></i>
                                    </button>
                                    <button onclick="deleteUser('{{ $user->id }}', '{{ addslashes($user->nama) }}')" 
                                            class="btn btn-danger btn-sm"
                                            title="Hapus User"
                                            data-toggle="tooltip">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- MODAL USER -->
<div class="modal fade" id="modal-user" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modal-title">
                    <i class="fas fa-user-plus mr-2"></i>Tambah User
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="user-form" method="POST">
                @csrf
                <input type="hidden" name="id" id="user-id">
                <input type="hidden" name="_method" id="method" value="POST">

                <div class="modal-body p-4">
                    <div class="form-group mb-3">
                        <label class="font-weight-bold">
                            <i class="fas fa-id-card mr-1 text-primary"></i> NIK <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="nik" id="nik" class="form-control" placeholder="Masukkan NIK" required>
                        <small class="text-danger" id="nik-error"></small>
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold">
                            <i class="fas fa-user mr-1 text-primary"></i> Nama Lengkap <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama lengkap" required>
                        <small class="text-danger" id="nama-error"></small>
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold">
                            <i class="fas fa-tag mr-1 text-primary"></i> Role <span class="text-danger">*</span>
                        </label>
                        <select name="role" id="role" class="form-control" required>
                            <option value="">-- Pilih Role --</option>
                            <option value="super admin">👑 Super Admin</option>
                            <option value="teknisi">🔧 Teknisi</option>
                            <option value="checker">✅ Checker</option>
                            <option value="approver">👍 Approver</option>
                            <option value="ppic">📦 PPIC</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold" id="password-label">
                            <i class="fas fa-lock mr-1 text-primary"></i> Password <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Minimal 6 karakter">
                            <div class="input-group-append">
                                <span class="input-group-text" onclick="togglePassword()" style="cursor: pointer;">
                                    <i class="fas fa-eye" id="togglePasswordIcon"></i>
                                </span>
                            </div>
                        </div>
                        <small class="text-danger" id="password-error"></small>
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold">
                            <i class="fas fa-lock mr-1 text-primary"></i> Konfirmasi Password <span class="text-danger">*</span>
                        </label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Ketik ulang password">
                    </div>
                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL FOTO -->
<div class="modal fade" id="modal-photo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="photo-modal-title">
                    <i class="fas fa-camera mr-2"></i>Kelola Foto Profil
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4 text-center">
                <div class="mb-4">
                    <div class="position-relative d-inline-block">
                        <img id="photo-preview" 
                             src="" 
                             class="rounded-circle shadow-lg border border-4 border-info object-fit-cover"
                             width="150" height="150" 
                             alt="Preview Foto"
                             style="display: none; object-fit: cover;">
                        <div id="photo-placeholder" 
                             class="rounded-circle bg-light d-flex align-items-center justify-content-center shadow-sm border border-4 border-secondary"
                             style="width: 150px; height: 150px;">
                            <i class="fas fa-user text-muted" style="font-size: 4rem;"></i>
                        </div>
                    </div>
                    <h5 class="mt-3 mb-1 font-weight-bold" id="photo-user-name"></h5>
                    <span class="badge badge-info" id="photo-user-role"></span>
                </div>

                <form id="photo-form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" id="photo-user-id">
                    
                    <div class="form-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="foto" name="foto" accept="image/*">
                            <label class="custom-file-label" for="foto" id="file-label">Pilih file foto...</label>
                        </div>
                        <small class="text-muted">
                            <i class="fas fa-info-circle mr-1"></i>Format: JPG, PNG, GIF. Maks: 2MB
                        </small>
                        <div class="text-danger mt-1" id="foto-error"></div>
                    </div>

                    <div class="form-group" id="delete-photo-container" style="display: none;">
                        <hr>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="delete-photo" name="delete_photo">
                            <label class="custom-control-label text-danger" for="delete-photo">
                                <i class="fas fa-trash mr-1"></i> Hapus foto profil
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i> Batal
                </button>
                <button type="button" class="btn btn-danger" id="delete-photo-btn" style="display: none;">
                    <i class="fas fa-trash mr-1"></i> Hapus
                </button>
                <button type="button" class="btn btn-info" id="upload-photo-btn">
                    <i class="fas fa-upload mr-1"></i> Upload
                </button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL LIHAT FOTO -->
<div class="modal fade" id="modal-view-photo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-image mr-2"></i>Foto Profil
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center p-4">
                <img id="view-photo" src="" alt="Foto Profil" class="img-fluid rounded-circle shadow-lg mb-3 border border-4 border-primary" 
                     style="width: 200px; height: 200px; object-fit: cover;">
                <p id="view-photo-name" class="mt-2 mb-0 font-weight-bold"></p>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL LIHAT PASSWORD -->
<div class="modal fade" id="modal-password" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">
                    <i class="fas fa-key mr-2"></i>Password User
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <p class="mb-2">Password untuk user <strong id="password-user-name"></strong>:</p>
                <div class="input-group mb-3">
                    <input type="text" id="current-password" class="form-control form-control-lg text-center font-weight-bold" readonly style="font-size: 18px; letter-spacing: 1px;">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button" onclick="copyPassword()">
                            <i class="fas fa-copy"></i> Copy
                        </button>
                    </div>
                </div>
                <small class="text-muted">
                    <i class="fas fa-info-circle"></i> Password ini adalah password yang sedang digunakan saat ini.
                </small>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .card.border-left-primary { border-left: 4px solid #4e73df !important; }
    .card.border-left-success { border-left: 4px solid #1cc88a !important; }
    .card.border-left-info { border-left: 4px solid #36b9cc !important; }
    .card.border-left-warning { border-left: 4px solid #f6c23e !important; }
    
    .btn-group .btn {
        margin: 0 2px;
        border-radius: 4px !important;
    }
    
    .custom-file-label::after {
        content: "Browse";
    }
    
    #photo-preview {
        transition: all 0.3s ease;
    }
    
    /* Animasi untuk notifikasi */
    .alert {
        animation: slideDown 0.5s ease-out;
        border-left: 4px solid;
    }
    
    .alert-success { border-left-color: #1cc88a; }
    .alert-danger { border-left-color: #e74a3b; }
    
    @keyframes slideDown {
        from {
            transform: translateY(-20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
    
    /* Hover effect untuk baris tabel */
    .table tbody tr:hover {
        background-color: rgba(78, 115, 223, 0.05);
        transition: background-color 0.3s ease;
        cursor: pointer;
    }
    
    /* Badge styling */
    .badge {
        font-weight: 500;
        letter-spacing: 0.3px;
    }
    
    /* Modal animation */
    .modal.fade .modal-dialog {
        transform: scale(0.8);
        transition: transform 0.2s ease-in-out;
    }
    
    .modal.show .modal-dialog {
        transform: scale(1);
    }
    
    /* Tooltip styling */
    .tooltip {
        font-size: 12px;
    }
    
    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }
    
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb {
        background: #4e73df;
        border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: #2e59d9;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Definisikan URL
const USER_STORE_URL = '{{ route("users.store") }}';
const USER_UPDATE_BASE = '/users';
const USER_PHOTO_URL = '/users/photo';
const USER_PHOTO_DELETE_URL = '/users/photo';
const USER_DESTROY_BASE = '/users';
const CSRF_TOKEN = '{{ csrf_token() }}';
const BASE_URL = '{{ url("/") }}';

// Toggle password visibility
function togglePassword() {
    const password = document.getElementById('password');
    const icon = document.getElementById('togglePasswordIcon');
    
    if (password.type === 'password') {
        password.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        password.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

// Open modal tambah user
function openModal() {
    $('#modal-title').html('<i class="fas fa-user-plus mr-2"></i>Tambah User Baru');
    $('#user-form')[0].reset();
    $('#user-id').val('');
    $('#method').val('POST');
    $('#user-form').attr('action', USER_STORE_URL);
    $('#password').prop('required', true);
    $('#password-label').html('<i class="fas fa-lock mr-1 text-primary"></i> Password <span class="text-danger">*</span>');
    $('.text-danger').text('').hide();
    $('#modal-user').modal('show');
}

// Edit user
function editUser(button) {
    const id = button.getAttribute('data-id');
    const nik = button.getAttribute('data-nik');
    const nama = button.getAttribute('data-nama');
    const role = button.getAttribute('data-role');

    $('#modal-title').html('<i class="fas fa-user-edit mr-2"></i>Edit User');
    $('#user-id').val(id);
    $('#method').val('PUT');
    $('#user-form').attr('action', USER_UPDATE_BASE + '/' + id);
    
    $('#nik').val(nik);
    $('#nama').val(nama);
    $('#role').val(role);
    $('#password').val('').prop('required', false);
    $('#password-label').html('<i class="fas fa-lock mr-1 text-primary"></i> Password (kosongkan jika tidak ubah)');
    $('.text-danger').text('').hide();
    $('#modal-user').modal('show');
}

// Submit form user
$('#user-form').on('submit', function(e) {
    e.preventDefault();
    
    Swal.fire({
        title: 'Menyimpan...',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    
    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: $(this).serialize(),
        success: function(response) {
            Swal.close();
            $('#modal-user').modal('hide');
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: response.message,
                timer: 2000,
                showConfirmButton: false
            }).then(() => {
                location.reload();
            });
        },
        error: function(xhr) {
            Swal.close();
            if (xhr.status === 422) {
                var errors = xhr.responseJSON.errors;
                $('.text-danger').text('').hide();
                
                if (errors.nik) $('#nik-error').text(errors.nik[0]).show();
                if (errors.nama) $('#nama-error').text(errors.nama[0]).show();
                if (errors.password) $('#password-error').text(errors.password[0]).show();
                if (errors.role) Swal.fire('Error', errors.role[0], 'error');
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: xhr.responseJSON?.message || 'Terjadi kesalahan'
                });
            }
        }
    });
});

// Manage photo
function managePhoto(userId, userName, currentPhoto, userRole = '') {
    $('#photo-user-id').val(userId);
    $('#photo-user-name').text(userName);
    $('#photo-user-role').text(userRole ? ucfirst(userRole) : '');
    $('#foto').val('');
    $('#foto-error').text('');
    $('#file-label').text('Pilih file foto...');
    
    $('#photo-preview').hide();
    $('#photo-placeholder').show();
    $('#delete-photo-container').hide();
    $('#delete-photo-btn').hide();
    
    if (currentPhoto && currentPhoto !== '') {
        const photoUrl = BASE_URL + '/profile_foto/' + currentPhoto;
        $('#photo-preview').attr('src', photoUrl).show();
        $('#photo-placeholder').hide();
        $('#delete-photo-container').show();
        $('#delete-photo-btn').show();
    }

    $('#modal-photo').modal('show');
}

// View photo
function viewPhoto(userName, photoUrl) {
    $('#view-photo').attr('src', photoUrl);
    $('#view-photo-name').text(userName);
    $('#modal-view-photo').modal('show');
}

// Delete user
function deleteUser(id, name) {
    Swal.fire({
        title: 'Hapus User?',
        html: `Apakah Anda yakin ingin menghapus user <strong>${name}</strong>?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Menghapus...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            fetch(USER_DESTROY_BASE + '/' + id, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                Swal.close();
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: data.message,
                    timer: 2000
                }).then(() => location.reload());
            })
            .catch(() => {
                Swal.close();
                Swal.fire('Gagal!', 'Terjadi kesalahan', 'error');
            });
        }
    });
}

// Helper function
function ucfirst(str) {
    if (!str) return '';
    return str.charAt(0).toUpperCase() + str.slice(1);
}

// Copy to clipboard
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Session token berhasil disalin ke clipboard',
            timer: 1500,
            showConfirmButton: false
        });
    }).catch(function() {
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: 'Gagal menyalin token',
            timer: 1500,
            showConfirmButton: false
        });
    });
}

// Clear session token
function clearSessionToken(userId, userName) {
    Swal.fire({
        title: 'Hapus Session Token?',
        html: `Apakah Anda yakin ingin menghapus session token untuk user <strong>${userName}</strong>?<br><small class="text-danger">User akan logout secara otomatis dari semua perangkat!</small>`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Menghapus token...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            fetch(`/users/${userId}/clear-session-token`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                Swal.close();
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: data.message,
                    timer: 2000
                }).then(() => location.reload());
            })
            .catch(() => {
                Swal.close();
                Swal.fire('Gagal!', 'Terjadi kesalahan', 'error');
            });
        }
    });
}

// Show current password - Versi informasi
function showPassword(userId, userName) {
    // Ambil hash password dari database
    fetch(`/users/${userId}/get-password-hash`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN,
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'info',
                title: 'Informasi Password User',
                width: '600px',
                html: `
                    <div class="text-left">
                        <p><strong>User:</strong> ${userName}</p>
                        <p><strong>Status:</strong> <span class="badge badge-warning">Terenkripsi (Bcrypt Hash)</span></p>
                        
                        <hr>
                        
                        <div class="alert alert-info">
                            <i class="fas fa-shield-alt"></i> <strong>Keamanan Password</strong><br>
                            Password disimpan dalam bentuk <strong>hash (enkripsi satu arah)</strong> 
                            menggunakan algoritma Bcrypt yang tidak dapat didekripsi.
                        </div>
                        
                        <div class="alert alert-secondary mt-2">
                            <strong>Hash Password:</strong><br>
                            <code style="font-size: 11px; word-break: break-all;">${data.hash}</code>
                        </div>
                        
                        <hr>
                        
                        <p class="mb-1"><strong>💡 Yang bisa Anda lakukan:</strong></p>
                        <ul class="small">
                            <li>Gunakan fitur <strong>Edit User</strong> untuk mengubah password</li>
                            <li>User bisa menggunakan fitur <strong>Lupa Password</strong> untuk reset mandiri</li>
                            <li>Admin dapat mereset password melalui form edit (kosongkan password baru jika tidak ingin mengubah)</li>
                        </ul>
                    </div>
                `,
                confirmButtonText: 'Mengerti',
                confirmButtonColor: '#3085d6',
                showCancelButton: true,
                cancelButtonText: 'Reset Password',
                cancelButtonColor: '#28a745'
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.cancel) {
                    // Jika klik Reset Password
                    showResetPasswordForm(userId, userName);
                }
            });
        } else {
            Swal.fire('Gagal!', data.message, 'error');
        }
    })
    .catch(error => {
        Swal.fire('Gagal!', 'Terjadi kesalahan', 'error');
    });
}

// Form reset password
function showResetPasswordForm(userId, userName) {
    Swal.fire({
        title: 'Reset Password User',
        html: `
            <div class="text-left">
                <p>Reset password untuk: <strong>${userName}</strong></p>
                <div class="form-group">
                    <label>Password Baru:</label>
                    <div class="input-group">
                        <input type="text" id="reset-password" class="form-control" value="${generateRandomPassword()}">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" onclick="copyToClipboardFromSwal()">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                    </div>
                    <small class="text-muted">Password akan di-hash saat disimpan</small>
                </div>
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: 'Reset Password',
        confirmButtonColor: '#28a745',
        preConfirm: () => {
            const newPassword = document.getElementById('reset-password').value;
            if (!newPassword || newPassword.length < 6) {
                Swal.showValidationMessage('Password minimal 6 karakter');
                return false;
            }
            
            return fetch(`/users/${userId}/reset-password`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ password: newPassword })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    return newPassword;
                } else {
                    throw new Error(data.message);
                }
            })
            .catch(error => {
                Swal.showValidationMessage(`Error: ${error.message}`);
                return false;
            });
        }
    }).then((result) => {
        if (result.isConfirmed && result.value) {
            Swal.fire({
                icon: 'success',
                title: 'Password Berhasil Direset!',
                html: `
                    Password baru untuk <strong>${userName}</strong>:<br>
                    <div class="alert alert-success mt-2">
                        <code style="font-size: 18px;">${result.value}</code>
                    </div>
                    <button class="btn btn-sm btn-info mt-2" onclick="copyText('${result.value}')">
                        <i class="fas fa-copy"></i> Salin Password
                    </button>
                `,
                confirmButtonText: 'Selesai'
            });
        }
    });
}

function copyToClipboardFromSwal() {
    const passwordInput = document.getElementById('reset-password');
    if (passwordInput) {
        copyToClipboard(passwordInput.value);
    }
}

function copyText(text) {
    copyToClipboard(text);
}
// Copy password
function copyPassword() {
    const passwordInput = document.getElementById('current-password');
    passwordInput.select();
    passwordInput.setSelectionRange(0, 99999);
    
    navigator.clipboard.writeText(passwordInput.value).then(function() {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Password berhasil disalin ke clipboard',
            timer: 1500,
            showConfirmButton: false
        });
    }).catch(function() {
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: 'Gagal menyalin password',
            timer: 1500,
            showConfirmButton: false
        });
    });
}

$(document).ready(function() {
    // Preview foto
    $('#foto').on('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            if (file.size > 2 * 1024 * 1024) {
                $('#foto-error').text('Ukuran file maksimal 2MB');
                $(this).val('');
                $('#file-label').text('Pilih file foto...');
                return;
            }
            
            const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
            if (!validTypes.includes(file.type)) {
                $('#foto-error').text('Format file harus JPG, PNG, GIF, atau WebP');
                $(this).val('');
                $('#file-label').text('Pilih file foto...');
                return;
            }
            
            $('#foto-error').text('');
            $('#file-label').text(file.name);
            
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#photo-preview').attr('src', e.target.result).show();
                $('#photo-placeholder').hide();
            }
            reader.readAsDataURL(file);
        }
    });

    // Upload photo
    $('#upload-photo-btn').on('click', function() {
        const fileInput = $('#foto')[0];
        
        if (!fileInput.files[0]) {
            Swal.fire('Peringatan', 'Pilih file foto terlebih dahulu!', 'warning');
            return;
        }
        
        Swal.fire({
            title: 'Mengupload...',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });
        
        const formData = new FormData();
        formData.append('foto', fileInput.files[0]);
        formData.append('user_id', $('#photo-user-id').val());
        formData.append('_token', CSRF_TOKEN);
        
        $.ajax({
            url: USER_PHOTO_URL,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                Swal.close();
                $('#modal-photo').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.message,
                    timer: 2000
                }).then(() => location.reload());
            },
            error: function(xhr) {
                Swal.close();
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    if (errors.foto) $('#foto-error').text(errors.foto[0]);
                } else {
                    Swal.fire('Gagal!', xhr.responseJSON?.message || 'Terjadi kesalahan', 'error');
                }
            }
        });
    });

    // Delete photo
    $('#delete-photo-btn').on('click', function() {
        Swal.fire({
            title: 'Hapus Foto?',
            text: 'Yakin ingin menghapus foto profil ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Menghapus...',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });
                
                $.ajax({
                    url: USER_PHOTO_DELETE_URL,
                    type: 'DELETE',
                    data: {
                        user_id: $('#photo-user-id').val(),
                        _token: CSRF_TOKEN
                    },
                    success: function(response) {
                        Swal.close();
                        $('#modal-photo').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                            timer: 2000
                        }).then(() => location.reload());
                    },
                    error: function() {
                        Swal.close();
                        Swal.fire('Gagal!', 'Terjadi kesalahan', 'error');
                    }
                });
            }
        });
    });

    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();
    
    // DataTable
    $('#users-table').DataTable({
        responsive: true,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'
        },
        columnDefs: [
            { orderable: false, targets: [4, 5, 6] }
        ]
    });
});
</script>
@endpush
@endsection