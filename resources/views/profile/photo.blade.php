@extends('layouts.app')

@section('title', 'Foto Profil')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0"><i class="fas fa-camera me-2"></i>Foto Profil</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Foto Saat Ini -->
                    <div class="text-center mb-4">
                        <div class="position-relative d-inline-block mb-3">
                            @if(auth()->user()->foto) {{-- Ganti auth()->user()->foto_profil --}}
                                <img src="{{ asset('profile_foto/' . auth()->user()->foto) }}" {{-- Ganti auth()->user()->foto --}}
                                     class="rounded-circle shadow-lg border border-4 border-primary object-fit-cover"
                                     width="200" height="200" 
                                     alt="Foto"
                                     onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nama) }}&background=4e73df&color=fff&size=200'">
                                <div class="position-absolute bottom-0 end-0 bg-primary rounded-circle p-2 border border-3 border-white">
                                    <i class="fas fa-camera text-white"></i>
                                </div>
                            @else
                                <div class="rounded-circle bg-light d-flex flex-column align-items-center justify-content-center shadow-lg border border-4 border-primary"
                                     style="width: 200px; height: 200px;">
                                    <i class="fas fa-user text-muted mb-2" style="font-size: 4rem;"></i>
                                    <span class="text-muted small">Belum ada foto</span>
                                </div>
                            @endif
                        </div>
                        
                        <h5 class="mb-1">{{ auth()->user()->nama }}</h5>
                        <p class="text-muted small mb-4">{{ ucfirst(auth()->user()->role) }} • {{ auth()->user()->nik }}</p>
                        
                        @if(auth()->user()->foto) {{-- Ganti auth()->user()->foto_profil --}}
                            <form action="{{ route('profile.photo.destroy') }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm" 
                                        onclick="return confirm('Yakin ingin menghapus foto profil?')">
                                    <i class="fas fa-trash me-1"></i> Hapus Foto
                                </button>
                            </form>
                        @endif
                    </div>

                    <!-- Form Upload Foto -->
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title mb-3"><i class="fas fa-upload me-2 text-primary"></i>Upload Foto Baru</h6>
                            <form action="{{ route('profile.photo.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="mb-3">
                                    <label for="foto" class="form-label">Pilih File Foto</label> {{-- Ganti id dan name --}}
                                    <input type="file" class="form-control @error('foto') is-invalid @enderror" 
                                           id="foto" name="foto" accept="image/*" required> {{-- Ganti name --}}
                                    @error('foto') {{-- Ganti error --}}
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        Format: JPEG, PNG, JPG, GIF, WEBP. Maksimal 2MB.
                                    </div>
                                </div>
                                
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <strong>Rekomendasi foto profil:</strong>
                                    <ul class="mb-0 mt-1 small">
                                        <li>Foto wajah yang jelas dan terang</li>
                                        <li>Ukuran minimal 400x400 piksel</li>
                                        <li>Format landscape atau portrait</li>
                                        <li>Foto akan di-crop menjadi lingkaran</li>
                                    </ul>
                                </div>
                                
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('profile.edit') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left me-1"></i> Kembali
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-upload me-1"></i> Upload Foto
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
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