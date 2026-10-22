@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="container-fluid px-3 px-md-4">
    <div class="row">
        <div class="col-12 col-md-10 col-lg-8 col-xl-6 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0 fs-5 fs-md-4"><i class="fas fa-user-circle me-2"></i>Edit Profile</h4>
                </div>
                <div class="card-body p-3 p-md-4">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    <!-- Foto Profil - Tampil berbeda berdasarkan role -->
                    @if(auth()->user()->role === 'super admin')
                        <!-- Tampilan untuk Super Admin (bisa lihat dan kelola foto) -->
                        <div class="text-center mb-4">
                            <div class="position-relative d-inline-block">
                                @if(auth()->user()->foto)
                                    <img src="{{ asset('profile_foto/' . auth()->user()->foto) }}"
                                         class="rounded-circle shadow-sm border border-3 border-primary object-fit-cover"
                                         width="100" height="100" 
                                         style="width: 100px; height: 100px;"
                                         alt="Foto {{ auth()->user()->nama }}"
                                         onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nama) }}&background=4e73df&color=fff&size=120'">
                                @else
                                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center shadow-sm border border-3 border-primary"
                                         style="width: 100px; height: 100px;">
                                        <i class="fas fa-user text-muted" style="font-size: 3rem;"></i>
                                    </div>
                                @endif
                            </div>
                            <h5 class="mt-3 mb-1 fs-6 fs-md-5">{{ auth()->user()->nama }}</h5>
                            <p class="text-muted small mb-3">{{ ucfirst(auth()->user()->role) }}</p>
                            
                            <a href="{{ route('profile.photo') }}" class="btn btn-outline-success btn-sm">
                                <i class="fas fa-camera me-1"></i> Kelola Foto
                            </a>
                        </div>
                    @else
                        <!-- Tampilan untuk Non-Super Admin (tanpa foto, hanya info) -->
                        <div class="text-center mb-4">
                            <!-- Avatar default tanpa foto -->
                            <div class="d-inline-block">
                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center shadow-sm border border-3 border-secondary"
                                     style="width: 100px; height: 100px; background-color: #e9ecef;">
                                    <i class="fas fa-user-slash text-secondary" style="font-size: 3rem; opacity: 0.5;"></i>
                                </div>
                            </div>
                            
                            <h5 class="mt-3 mb-1 fs-6 fs-md-5">{{ auth()->user()->nama }}</h5>
                            <p class="text-muted small mb-2">{{ ucfirst(auth()->user()->role) }}</p>
                            
                            <!-- Info bahwa foto hanya bisa diatur super admin -->
                            <div class="alert alert-info alert-sm py-2 px-3 d-inline-flex align-items-center mx-auto" role="alert" style="max-width: 100%;">
                                <i class="fas fa-info-circle me-2"></i>
                                <small>Foto profil hanya dapat diatur oleh Super Admin</small>
                            </div>
                            
                            <!-- Petunjuk tambahan -->
                            <p class="text-muted small mb-0 mt-2">
                                <i class="fas fa-shield-alt me-1"></i>
                                Silakan hubungi Super Admin untuk mengubah foto profil
                            </p>
                        </div>
                    @endif
                    
                    <hr class="my-4">
                    
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="nik" class="form-label">NIK (Nomor Induk Karyawan)</label>
                            <input type="text" class="form-control @error('nik') is-invalid @enderror form-control-sm form-control-md" 
                                   id="nik" name="nik" 
                                   value="{{ old('nik', auth()->user()->nik) }}" 
                                   {{ auth()->user()->role !== 'super_admin' ? 'readonly' : '' }}
                                   required>
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if(auth()->user()->role !== 'super_admin')
                                <small class="text-muted">
                                    <i class="fas fa-lock me-1"></i>NIK hanya dapat diubah oleh Super Admin
                                </small>
                            @else
                                <small class="text-muted">Nomor induk karyawan yang unik</small>
                            @endif
                        </div>
                        
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror form-control-sm form-control-md" 
                                   id="nama" name="nama" 
                                   value="{{ old('nama', auth()->user()->nama) }}" 
                                   {{ auth()->user()->role !== 'super_admin' ? 'readonly' : '' }}
                                   required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if(auth()->user()->role !== 'super_admin')
                                <small class="text-muted">
                                    <i class="fas fa-lock me-1"></i>Nama hanya dapat diubah oleh Super Admin
                                </small>
                            @endif
                        </div>
                        
                        <div class="row">
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label">Role</label>
                                <input type="text" class="form-control form-control-sm form-control-md" 
                                       value="{{ ucfirst(auth()->user()->role) }}" readonly>
                                <small class="text-muted">Role tidak dapat diubah</small>
                            </div>
                            
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label">Tanggal Bergabung</label>
                                <input type="text" class="form-control form-control-sm form-control-md" 
                                       value="{{ auth()->user()->created_at->format('d M Y') }}" readonly>
                            </div>
                        </div>
                        
                        <!-- Tombol Aksi - Responsif dengan kondisi role -->
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-stretch align-items-sm-center gap-2 mt-4">
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary w-100 w-sm-auto">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                            <div class="d-flex flex-column flex-sm-row gap-2 w-100 w-sm-auto">
                                @if(auth()->user()->role === 'super_admin')
                                    <a href="{{ route('password.change') }}" class="btn btn-warning w-100 w-sm-auto">
                                        <i class="fas fa-key me-1"></i> Ganti Password
                                    </a>
                                    <button type="submit" class="btn btn-primary w-100 w-sm-auto">
                                        <i class="fas fa-save me-1"></i> Simpan
                                    </button>
                                @else
                                    <a href="{{ route('password.change') }}" class="btn btn-warning w-100 w-sm-auto">
                                        <i class="fas fa-key me-1"></i> Ganti Password
                                    </a>
                                    <button type="submit" class="btn btn-primary w-100 w-sm-auto">
                                        <i class="fas fa-save me-1"></i> Simpan
                                    </button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .object-fit-cover {
        object-fit: cover;
    }
    
    /* Custom responsive utilities */
    @media (min-width: 576px) {
        .w-sm-auto {
            width: auto !important;
        }
        .w-sm-100 {
            width: 100% !important;
        }
    }
    
    /* Form control size untuk mobile */
    .form-control-sm {
        font-size: 0.875rem;
    }
    
    /* Responsive font sizes */
    @media (max-width: 576px) {
        .fs-5 {
            font-size: 1.1rem !important;
        }
        .card-body {
            padding: 1rem !important;
        }
    }
    
    /* Memastikan tombol tidak terlalu besar di mobile */
    @media (max-width: 576px) {
        .btn {
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
        }
    }
    
    /* Style untuk input readonly */
    input[readonly] {
        background-color: #f8f9fc;
        cursor: not-allowed;
    }
    
    input[readonly]:focus {
        border-color: #d1d3e2;
        box-shadow: none;
    }
    
    /* Alert kecil */
    .alert-sm {
        font-size: 0.85rem;
    }
</style>
@endpush
@endsection