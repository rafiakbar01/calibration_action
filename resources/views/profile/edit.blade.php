@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-user-circle me-2"></i>Edit Profile</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    <!-- Foto Profil - TAMBAHKAN DISINI -->
                    <!-- Foto Profil - TAMBAHKAN DISINI -->
<div class="text-center mb-4">
    <div class="position-relative d-inline-block">
        @if(auth()->user()->foto) {{-- Ganti auth()->user()->foto_profil --}}
            <img src="{{ asset('profile_foto/' . auth()->user()->foto) }}" {{-- Ganti auth()->user()->foto --}}
                 class="rounded-circle shadow-sm border border-3 border-primary object-fit-cover"
                 width="120" height="120" 
                 alt="Foto {{ auth()->user()->nama }}"
                 onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nama) }}&background=4e73df&color=fff&size=120'">
        @else
            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center shadow-sm border border-3 border-primary"
                 style="width: 120px; height: 120px;">
                <i class="fas fa-user text-muted" style="font-size: 3rem;"></i>
            </div>
        @endif
        
    </div>
    <h5 class="mt-3 mb-1">{{ auth()->user()->nama }}</h5>
    <p class="text-muted small mb-3">{{ ucfirst(auth()->user()->role) }}</p>
    
    <a href="{{ route('profile.photo') }}" class="btn btn-outline-success btn-sm">
        <i class="fas fa-camera me-1"></i> Kelola Foto
    </a>
</div>
                    
                    <hr class="my-4">
                    <!-- Akhir Foto Profil -->
                    
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="nik" class="form-label">NIK (Nomor Induk Karyawan)</label>
                            <input type="text" class="form-control @error('nik') is-invalid @enderror" 
                                   id="nik" name="nik" 
                                   value="{{ old('nik', auth()->user()->nik) }}" required>
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Nomor induk karyawan yang unik</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                   id="nama" name="nama" 
                                   value="{{ old('nama', auth()->user()->nama) }}" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <input type="text" class="form-control" 
                                   value="{{ ucfirst(auth()->user()->role) }}" readonly>
                            <small class="text-muted">Role tidak dapat diubah</small>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Tanggal Bergabung</label>
                            <input type="text" class="form-control" 
                                   value="{{ auth()->user()->created_at->format('d M Y') }}" readonly>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                            <div>
                                <a href="{{ route('password.change') }}" class="btn btn-warning me-2">
                                    <i class="fas fa-key me-1"></i> Ganti Password
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Simpan Perubahan
                                </button>
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
</style>
@endpush
@endsection