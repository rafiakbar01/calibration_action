{{-- resources/views/log-kalibrasi/show.blade.php --}}
@extends('layouts.app')

@section('title', 'Detail Log Kalibrasi')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-12">
            <h5 class="mb-0">
                <i class="fas fa-eye me-2"></i>Detail Log Kalibrasi
                <a href="{{ route('log-kalibrasi.index') }}" class="btn btn-secondary btn-sm ms-2">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </a>
            </h5>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-info-circle me-2"></i>Informasi Log
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>ID Log:</strong> #{{ $log->id }}
                        </div>
                        <div class="col-md-6">
                            <strong>Kalibrasi ID:</strong> 
                            <a href="{{ route('log-kalibrasi.per-kalibrasi', $log->kalibrasi_id) }}">
                                #{{ $log->kalibrasi_id }}
                            </a>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Aksi:</strong>
                            @php
                                $badgeColor = match($log->aksi) {
                                    'BUAT' => 'success',
                                    'UBAH' => 'warning',
                                    'HAPUS' => 'danger',
                                    default => 'info'
                                };
                            @endphp
                            <span class="badge bg-{{ $badgeColor }}">{{ $log->aksi }}</span>
                        </div>
                        <div class="col-md-6">
                            <strong>Waktu:</strong> {{ $log->created_at->format('d/m/Y H:i:s') }}
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-12">
                            <strong>Deskripsi:</strong>
                            <p class="mb-0">{{ $log->deskripsi ?? '-' }}</p>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>User:</strong> {{ $log->user->name ?? 'System' }}
                        </div>
                        <div class="col-md-6">
                            <strong>IP Address:</strong> {{ $log->alamat_ip ?? '-' }}
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12">
                            <strong>User Agent:</strong>
                            <small class="text-muted d-block">{{ $log->user_agent ?? '-' }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <i class="fas fa-history me-2"></i>Data Log
                </div>
                <div class="card-body">
                    @if($log->data_lama || $log->data_baru)
                        @if($log->data_lama)
                            <div class="mb-3">
                                <strong>Data Sebelumnya:</strong>
                                <div class="border rounded p-2 mt-1 bg-light small">
                                    <pre class="mb-0" style="white-space: pre-wrap;">{{ json_encode($log->data_lama, JSON_PRETTY_PRINT) }}</pre>
                                </div>
                            </div>
                        @endif
                        
                        @if($log->data_baru)
                            <div class="mb-3">
                                <strong>Data Baru:</strong>
                                <div class="border rounded p-2 mt-1 bg-light small">
                                    <pre class="mb-0" style="white-space: pre-wrap;">{{ json_encode($log->data_baru, JSON_PRETTY_PRINT) }}</pre>
                                </div>
                            </div>
                        @endif
                    @else
                        <p class="text-muted text-center mb-0">
                            <i class="fas fa-info-circle me-1"></i>Tidak ada data perubahan tersimpan
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection