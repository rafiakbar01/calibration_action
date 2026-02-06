@extends('layouts.app')

@section('title', 'Buka di Google Sheets - ' . $calibration->namaAlat)

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fab fa-google text-success"></i> Buka di Google Sheets - {{ $calibration->namaAlat }}
    </h1>
    <div>
        <a href="{{ route('calibrations.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header bg-success text-white">
                <h6 class="m-0 font-weight-bold">
                    <i class="fas fa-play-circle me-2"></i>Buka File di Google Sheets
                </h6>
            </div>
            <div class="card-body">
                <div class="text-center py-4">
                    <i class="fab fa-google-drive fa-4x text-primary mb-3"></i>
                    <h4>{{ $filename }}</h4>
                    <p class="text-muted">Klik tombol di bawah untuk membuka file ini di Google Sheets</p>
                    
                    <div class="d-grid gap-2 col-md-8 mx-auto mt-4">
                        <!-- Tombol utama buka di Google Sheets -->
                        <a href="https://docs.google.com/spreadsheets/u/0/create?usp=sheets_home&ths=true" 
                           class="btn btn-success btn-lg"
                           target="_blank"
                           id="openSheetsBtn">
                            <i class="fab fa-google me-2"></i>Buka Google Sheets
                        </a>
                        
                        <!-- Auto download -->
                        <a href="{{ $fileUrl }}" 
                           class="btn btn-primary btn-lg"
                           download
                           id="downloadBtn">
                            <i class="fas fa-download me-2"></i>Download File Excel
                        </a>
                    </div>
                </div>

                <!-- Instruksi -->
                <div class="alert alert-info mt-4">
                    <h6><i class="fas fa-info-circle me-2"></i>Cara Membuka di Google Sheets:</h6>
                    <ol class="mb-0">
                        <li>Klik tombol "Buka Google Sheets" di atas</li>
                        <li>Setelah Google Sheets terbuka, pilih <strong>File → Import</strong></li>
                        <li>Pilih tab <strong>Upload</strong> dan drag & drop file Excel yang sudah didownload</li>
                        <li>Pilih <strong>"Replace spreadsheet"</strong> dan klik <strong>Import data</strong></li>
                        <li>File Excel sekarang terbuka di Google Sheets dan bisa diedit!</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-header bg-info text-white">
                <h6 class="m-0 font-weight-bold">
                    <i class="fas fa-file-alt me-2"></i>Informasi File
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong><i class="fas fa-file-excel me-2"></i>Nama File:</strong><br>
                    <code>{{ $filename }}</code>
                </div>
                
                <div class="mb-3">
                    <strong><i class="fas fa-toolbox me-2"></i>Nama Alat:</strong><br>
                    {{ $calibration->namaAlat }}
                </div>
                
                <div class="mb-3">
                    <strong><i class="fas fa-folder me-2"></i>Lokasi File:</strong><br>
                    <small class="text-muted">/public/excel_files/{{ $filename }}</small>
                </div>

                <hr>
                
                <div class="alert alert-warning">
                    <small>
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Tips:</strong> Setelah edit di Google Sheets, download ulang file untuk menyimpan perubahan.
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto download file ketika halaman load
    setTimeout(() => {
        document.getElementById('downloadBtn').click();
    }, 1000);

    // Auto buka Google Sheets setelah 2 detik
    setTimeout(() => {
        document.getElementById('openSheetsBtn').click();
    }, 2000);
});
</script>
@endpush