@extends('layouts.app')

@section('title', 'Detail Berita Acara - ' . $header->no_ba)

@section('content')
<div class="container-fluid px-3 px-md-4 py-3">
    <!-- Header Section -->
    <div class="card border-0 shadow-sm rounded-3 overflow-hidden bg-white mb-4">
        <div class="card-header bg-white border-bottom py-3 px-4 d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div class="d-flex align-items-center gap-3">
                <div class="ba-show-icon-box">
                    <i class="fas fa-file-contract text-white"></i>
                </div>
                <div>
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <h4 class="mb-0 fs-5 text-dark fw-bold">Berita Acara {{ $header->no_ba }}</h4>
                        @if(isset($header->status))
                        @php
                        $badgeClass = match(strtolower($header->status)) {
                        'approved' => 'bg-success-subtle text-success border border-success-subtle',
                        'waiting_approve' => 'bg-warning-subtle text-warning-emphasis border border-warning-subtle',
                        'rejected' => 'bg-danger-subtle text-danger border border-danger-subtle',
                        default => 'bg-secondary-subtle text-secondary border border-secondary-subtle',
                        };
                        $statusLabel = match(strtolower($header->status)) {
                        'approved' => 'Approved',
                        'waiting_approve' => 'Menunggu Approval',
                        'rejected' => 'Ditolak',
                        default => ucfirst(str_replace('_', ' ', $header->status)),
                        };
                        @endphp
                        <span class="badge {{ $badgeClass }} rounded-pill px-3 py-1 fs-7 fw-semibold">
                            {{ $statusLabel }}
                        </span>
                        @endif
                    </div>
                    <small class="text-muted">Dokumen resmi serah terima dan pemeriksaan kalibrasi alat</small>
                </div>
            </div>

            <!-- Tombol Aksi Cepat -->
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <a href="{{ route('berita-acara.list') }}" class="btn btn-outline-secondary rounded-pill px-3 btn-sm shadow-sm">
                    <i class="fas fa-list me-1"></i> Daftar BA
                </a>
                <a href="{{ route('berita-acara.index') }}" class="btn btn-outline-secondary rounded-pill px-3 btn-sm shadow-sm">
                    <i class="fas fa-layer-group me-1"></i> Data Kalibrasi
                </a>
                <a href="{{ route('berita-acara.export-pdf', $header->no_ba) }}" target="_blank" class="btn btn-danger rounded-pill px-3 btn-sm shadow-sm text-white">
                    <i class="fas fa-file-pdf me-1 text-white"></i> Cetak / PDF
                </a>
                <a href="{{ url('/berita-acara/approval/' . $header->no_ba) }}" class="btn btn-success rounded-pill px-3 btn-sm shadow-sm text-white">
                    <i class="fas fa-stamp me-1 text-white"></i> Halaman Approval
                </a>
            </div>
        </div>

        <div class="card-body p-4 bg-white">
            <!-- Ringkasan Informasi -->
            <div class="row g-4">
                <!-- Info Dokumen & Waktu -->
                <div class="col-lg-4 col-md-6">
                    <div class="p-3 rounded-3 bg-light border h-100">
                        <h6 class="fw-bold text-primary mb-3 d-flex align-items-center gap-2">
                            <i class="fas fa-info-circle"></i> Info Dokumen
                        </h6>
                        <table class="table table-sm table-borderless mb-0 small">
                            <tr>
                                <td class="text-muted text-nowrap" style="width: 40%;">Nomor BA</td>
                                <td class="fw-bold text-dark">: {{ $header->no_ba }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Tanggal BA</td>
                                <td class="fw-semibold text-dark">: {{ $header->tanggal ? \Carbon\Carbon::parse($header->tanggal)->translatedFormat('d F Y') : '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Dibuat Oleh</td>
                                <td class="fw-semibold text-dark">: {{ $header->created_by ?? 'System' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Waktu Simpan</td>
                                <td class="fw-semibold text-dark">: {{ $header->created_at ? $header->created_at->format('d/m/Y H:i') : '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Info Perusahaan -->
                <div class="col-lg-4 col-md-6">
                    <div class="p-3 rounded-3 bg-light border h-100">
                        <h6 class="fw-bold text-primary mb-3 d-flex align-items-center gap-2">
                            <i class="fas fa-building"></i> Data Perusahaan
                        </h6>
                        <table class="table table-sm table-borderless mb-0 small">
                            <tr>
                                <td class="text-muted text-nowrap" style="width: 38%;">Perusahaan</td>
                                <td class="fw-bold text-dark">: {{ $header->perusahaan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">No. Order / PO</td>
                                <td class="fw-semibold text-dark">: {{ $header->no_order ?: '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Kontak Person</td>
                                <td class="fw-semibold text-dark">: {{ $header->kontak ?: '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Telp / Fax</td>
                                <td class="fw-semibold text-dark">: {{ $header->telp_fax ?: '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Alamat</td>
                                <td class="fw-semibold text-dark">: {{ $header->alamat ?: '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Info Penanggung Jawab & Approval -->
                <div class="col-lg-4 col-md-12">
                    <div class="p-3 rounded-3 bg-light border h-100">
                        <h6 class="fw-bold text-primary mb-3 d-flex align-items-center gap-2">
                            <i class="fas fa-user-check"></i> Penanggung Jawab
                        </h6>
                        <table class="table table-sm table-borderless mb-0 small">
                            <tr>
                                <td class="text-muted text-nowrap" style="width: 40%;">Request By</td>
                                <td class="fw-semibold text-dark">: {{ $header->request_by ?: '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Approve By</td>
                                <td class="fw-semibold text-dark">: {{ $header->approve_by ?: '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Status Approval</td>
                                <td>:
                                    @if(strtolower($header->status ?? '') === 'approved')
                                    <span class="badge bg-success rounded-pill px-2 py-1">Disetujui</span>
                                    @elseif(strtolower($header->status ?? '') === 'rejected')
                                    <span class="badge bg-danger rounded-pill px-2 py-1">Ditolak</span>
                                    @else
                                    <span class="badge bg-warning text-dark rounded-pill px-2 py-1">Menunggu</span>
                                    @endif
                                </td>
                            </tr>
                            @if(!empty($header->approved_at))
                            <tr>
                                <td class="text-muted">Waktu Approve</td>
                                <td class="fw-semibold text-dark">: {{ \Carbon\Carbon::parse($header->approved_at)->format('d/m/Y H:i') }}</td>
                            </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>

            <!-- Tabel Daftar Alat -->
            <div class="mt-4">
                <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
                    <h5 class="fw-bold text-dark fs-6 mb-0 d-flex align-items-center gap-2">
                        <i class="fas fa-tools text-primary"></i> Daftar Alat Kalibrasi
                    </h5>
                    <span class="badge bg-primary rounded-pill px-3 py-2 fs-7 fw-semibold">
                        Total {{ $alatList->count() }} Alat
                    </span>
                </div>

                <div class="table-responsive rounded-3 border">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="ba-show-table-header">
                            <tr>
                                <th class="text-center" style="width: 4%;">No</th>
                                <th style="width: 12%;">No. Label</th>
                                <th style="width: 22%;">Nama Alat</th>
                                <th style="width: 14%;">Merek</th>
                                <th style="width: 12%;">Tipe</th>
                                <th style="width: 14%;">Rentang Ukur</th>
                                <th style="width: 12%;">No. Seri</th>
                                <th style="width: 10%;">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($alatList as $index => $alat)
                            <tr>
                                <td class="text-center fw-bold text-secondary">{{ $index + 1 }}</td>
                                <td>
                                    @if(!empty($alat->no_label))
                                    <span class="badge bg-light text-primary border fw-semibold px-2 py-1">{{ $alat->no_label }}</span>
                                    @else
                                    <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="fw-bold text-dark">{{ $alat->nama_alat }}</td>
                                <td>{{ $alat->merek ?: '-' }}</td>
                                <td>{{ $alat->type_alat ?: '-' }}</td>
                                <td>{{ $alat->kapasitas ?: '-' }}</td>
                                <td><code>{{ $alat->no_seri ?: '-' }}</code></td>
                                <td>
                                    <span class="badge bg-info-subtle text-info border border-info-subtle px-2 py-1">
                                        {{ $alat->keterangan ?: 'Selesai' }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    <i class="fas fa-inbox fa-3x mb-2 opacity-50"></i>
                                    <p class="mb-0">Tidak ada data alat dalam Berita Acara ini.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Catatan Tambahan (jika ada) -->
            @if(!empty($header->catatan))
            <div class="mt-4 p-3 rounded-3 bg-light border">
                <h6 class="fw-bold text-dark mb-1 d-flex align-items-center gap-2">
                    <i class="fas fa-sticky-note text-warning"></i> Catatan
                </h6>
                <p class="mb-0 small text-secondary" style="white-space: pre-line;">{{ $header->catatan }}</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .ba-show-icon-box {
        width: 44px;
        height: 44px;
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        flex-shrink: 0;
    }

    .ba-show-table-header th {
        background-color: #e8f0fe !important;
        color: #1e3a8a !important;
        font-weight: 700 !important;
        font-size: 0.8rem !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px;
        border: none !important;
        border-bottom: 2px solid #bfdbfe !important;
        padding: 12px 14px !important;
    }

    .table tbody td {
        padding: 12px 14px;
        font-size: 0.875rem;
    }

    .fs-7 {
        font-size: 0.775rem !important;
    }
</style>
@endpush