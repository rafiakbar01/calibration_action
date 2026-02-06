@extends('layouts.app')

@section('title')
    @if(isset($action) && $action == 'show')
        Detail Metode Kalibrasi
    @elseif(isset($action) && $action == 'edit')  
        Edit Metode Kalibrasi
    @elseif(isset($action) && $action == 'create')
        Tambah Metode Kalibrasi
    @else
        Metode Kalibrasi
    @endif
@endsection

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas 
                @if(isset($action) && $action == 'show') fa-eye 
                @elseif(isset($action) && $action == 'edit') fa-edit 
                @elseif(isset($action) && $action == 'create') fa-plus-circle 
                @else fa-cogs @endif 
                text-primary">
            </i> 
            @if(isset($action) && $action == 'show')
                Detail Metode Kalibrasi
            @elseif(isset($action) && $action == 'edit')
                Edit Metode Kalibrasi
            @elseif(isset($action) && $action == 'create')
                Tambah Metode Kalibrasi
            @else
                Metode Kalibrasi
            @endif
        </h1>
        
        @if(isset($action) && in_array($action, ['show', 'edit', 'create']))
            <a href="{{ route('calibration-methods.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali ke Daftar
            </a>
        @else
            <a href="{{ route('calibration-methods.index', ['action' => 'create']) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Metode
            </a>
        @endif
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Content -->
    @if(isset($action) && in_array($action, ['show', 'edit', 'create']))
        <!-- FORM MODE (Create, Edit, Show) -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 
                        @if($action == 'show') bg-info
                        @elseif($action == 'edit') bg-warning
                        @else bg-primary @endif">
                        <h6 class="m-0 font-weight-bold text-white">
                            <i class="fas 
                                @if($action == 'show') fa-info-circle
                                @elseif($action == 'edit') fa-edit
                                @else fa-plus-circle @endif me-2">
                            </i>
                            @if($action == 'show')
                                Detail Metode Kalibrasi
                            @elseif($action == 'edit')
                                Form Edit Metode Kalibrasi
                            @else
                                Form Tambah Metode Kalibrasi
                            @endif
                        </h6>
                    </div>
                    <div class="card-body">
                        
                        @if($action == 'show')
                            <!-- SHOW MODE -->
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label fw-bold text-dark">Nama Alat</label>
                                    <p class="form-control-plaintext border-bottom pb-2">{{ $method->nama_alat }}</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label fw-bold text-dark">Metode Kalibrasi</label>
                                    <div class="border rounded p-3 bg-light">
                                        {!! nl2br(e($method->metode_kalibrasi)) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-dark">Dibuat Oleh</label>
                                    <p class="form-control-plaintext">{{ $method->created_by ?? 'System' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-dark">Tanggal Dibuat</label>
                                    <p class="form-control-plaintext">{{ $method->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>

                            @if($method->updated_by)
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-dark">Diperbarui Oleh</label>
                                    <p class="form-control-plaintext">{{ $method->updated_by }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-dark">Tanggal Diperbarui</label>
                                    <p class="form-control-plaintext">{{ $method->updated_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                            @endif

                        @else
                            <!-- CREATE/EDIT MODE -->
                            <form action="{{ $action == 'edit' ? route('calibration-methods.update', $method->id) : route('calibration-methods.store') }}" method="POST">
                                @if($action == 'edit')
                                    @method('PUT')
                                @endif
                                @csrf
                                
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="nama_alat" class="form-label">Nama Alat <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('nama_alat') is-invalid @enderror" 
                                               id="nama_alat" name="nama_alat" 
                                               value="{{ old('nama_alat', $method->nama_alat ?? '') }}" 
                                               placeholder="Masukkan nama alat" 
                                               {{ $action == 'show' ? 'readonly' : 'required' }}>
                                        @error('nama_alat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="metode_kalibrasi" class="form-label">Metode Kalibrasi <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('metode_kalibrasi') is-invalid @enderror" 
                                                  id="metode_kalibrasi" name="metode_kalibrasi" 
                                                  rows="6" 
                                                  placeholder="Masukkan metode kalibrasi" 
                                                  {{ $action == 'show' ? 'readonly' : 'required' }}>{{ old('metode_kalibrasi', $method->metode_kalibrasi ?? '') }}</textarea>
                                        @error('metode_kalibrasi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                @if($action != 'show')
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn 
                                            @if($action == 'edit') btn-warning
                                            @else btn-primary @endif">
                                            <i class="fas fa-save me-1"></i> 
                                            @if($action == 'edit')
                                                Perbarui Metode
                                            @else
                                                Simpan Metode
                                            @endif
                                        </button>
                                        <a href="{{ route('calibration-methods.index') }}" class="btn btn-secondary">
                                            <i class="fas fa-times me-1"></i> Batal
                                        </a>
                                    </div>
                                </div>
                                @endif
                            </form>
                        @endif
                    </div>

                    @if($action == 'show')
                    <div class="card-footer bg-light">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('calibration-methods.edit', $method->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>
                            <form action="{{ route('calibration-methods.destroy', $method->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" 
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus metode kalibrasi ini?')">
                                    <i class="fas fa-trash me-1"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            
            <!-- Sidebar Information -->
            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 
                        @if($action == 'show') bg-info
                        @elseif($action == 'edit') bg-warning
                        @else bg-primary @endif">
                        <h6 class="m-0 font-weight-bold text-white">
                            <i class="fas 
                                @if($action == 'show') fa-info-circle
                                @elseif($action == 'edit') fa-history
                                @else fa-lightbulb @endif me-2">
                            </i>
                            @if($action == 'show')
                                Informasi
                            @elseif($action == 'edit')
                                Riwayat
                            @else
                                Informasi
                            @endif
                        </h6>
                    </div>
                    <div class="card-body">
                        @if($action == 'show')
                            <p class="small text-muted mb-3">
                                <i class="fas fa-info-circle text-primary me-2"></i>
                                Halaman detail menampilkan informasi lengkap tentang metode kalibrasi.
                            </p>
                            <p class="small text-muted mb-0">
                                <i class="fas fa-edit text-warning me-2"></i>
                                Gunakan tombol edit untuk memperbarui data metode kalibrasi.
                            </p>

                        @elseif($action == 'edit')
                            @if(isset($method))
                            <p class="small text-muted mb-3">
                                <i class="fas fa-user text-success me-2"></i>
                                <strong>Dibuat oleh:</strong><br>
                                {{ $method->created_by ?? 'System' }}<br>
                                {{ $method->created_at->format('d/m/Y H:i') }}
                            </p>
                            
                            @if($method->updated_by)
                            <p class="small text-muted mb-0">
                                <i class="fas fa-user-edit text-warning me-2"></i>
                                <strong>Terakhir diperbarui oleh:</strong><br>
                                {{ $method->updated_by }}<br>
                                {{ $method->updated_at->format('d/m/Y H:i') }}
                            </p>
                            @endif
                            @endif

                        @else
                            <p class="small text-muted mb-3">
                                <i class="fas fa-exclamation-circle text-warning me-2"></i>
                                Isi nama alat dan metode kalibrasi dengan lengkap dan jelas.
                            </p>
                            <p class="small text-muted mb-3">
                                <i class="fas fa-info-circle text-primary me-2"></i>
                                Metode kalibrasi akan digunakan sebagai referensi dalam proses kalibrasi.
                            </p>
                            <p class="small text-muted mb-0">
                                <i class="fas fa-user text-success me-2"></i>
                                Data akan dicatat sebagai dibuat oleh: <strong>{{ auth()->user()->nama }}</strong>
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- TABLE MODE (List) -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-primary">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-list me-2"></i>Daftar Metode Kalibrasi
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="table-dark">
                            <tr>
                                <th width="5%">No</th>
                                <th width="30%">Nama Alat</th>
                                <th width="50%">Metode Kalibrasi</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($methods as $method)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    <strong class="text-primary">{{ $method->nama_alat }}</strong>
                                </td>
                                <td>
                                    <div class="text-truncate" style="max-width: 500px;" title="{{ $method->metode_kalibrasi }}">
                                        {{ Str::limit($method->metode_kalibrasi, 150) }}
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <!-- View Button -->
                                        <a href="{{ route('calibration-methods.show', $method->id) }}" 
                                           class="btn btn-info btn-sm" 
                                           title="Lihat Detail"
                                           data-bs-toggle="tooltip">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        
                                        <!-- Edit Button -->
                                        <a href="{{ route('calibration-methods.edit', $method->id) }}" 
                                           class="btn btn-warning btn-sm" 
                                           title="Edit Metode"
                                           data-bs-toggle="tooltip">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <!-- Delete Button -->
                                        <form action="{{ route('calibration-methods.destroy', $method->id) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" 
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus metode kalibrasi ini?')"
                                                    title="Hapus Metode"
                                                    data-bs-toggle="tooltip">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="fas fa-cogs fa-4x mb-3 opacity-25"></i>
                                        <h5 class="text-gray-500 mb-2">Belum ada metode kalibrasi</h5>
                                        <p class="text-gray-400 mb-4">Mulai dengan menambahkan metode kalibrasi pertama Anda.</p>
                                        <a href="{{ route('calibration-methods.index', ['action' => 'create']) }}" class="btn btn-primary btn-lg">
                                            <i class="fas fa-plus me-2"></i>Tambah Metode Pertama
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                @if($methods->hasPages())
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div class="text-muted small">
                        Menampilkan <strong>{{ $methods->firstItem() ?? 0 }}</strong> - 
                        <strong>{{ $methods->lastItem() ?? 0 }}</strong> 
                        dari <strong>{{ $methods->total() }}</strong> data
                    </div>
                    <nav aria-label="Page navigation">
                        <ul class="pagination pagination-sm mb-0">
                            {{ $methods->links() }}
                        </ul>
                    </nav>
                </div>
                @endif
            </div>
        </div>
    @endif
</div>
@endsection

@push('styles')
<style>
    .form-control-plaintext {
        background-color: #f8f9fa;
        padding: 0.375rem 0.75rem;
        border-radius: 0.375rem;
    }
    
    .card-header {
        border-radius: 0.5rem 0.5rem 0 0 !important;
    }
    
    .text-truncate {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
@endpush

@push('scripts')
<script>
    // Auto close alerts after 5 seconds
    setTimeout(function() {
        $('.alert').alert('close');
    }, 5000);

    // Auto-resize textarea
    document.addEventListener('DOMContentLoaded', function() {
        const textarea = document.getElementById('metode_kalibrasi');
        if (textarea) {
            textarea.style.height = 'auto';
            textarea.style.height = (textarea.scrollHeight) + 'px';
            
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
            });
        }
    });

    // Initialize DataTable only when in table mode
    @if(!isset($action))
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json"
            },
            "responsive": true,
            "order": [[1, 'asc']],
            "pageLength": 10,
            "dom": '<"row"<"col-md-6"l><"col-md-6"f>>rt<"row"<"col-md-6"i><"col-md-6"p>>'
        });

        // Initialize tooltips
        $('[data-bs-toggle="tooltip"]').tooltip();
    });
    @endif
</script>
@endpush