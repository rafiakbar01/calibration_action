@extends('layouts.app')
@section('title', 'Recycle Bin - Data Kalibrasi')

@section('content')
<div class="rb-wrapper">

    {{-- HERO HEADER --}}
    <div class="rb-hero">
        <div class="rb-hero-bg"></div>
        <div class="rb-hero-content d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div class="d-flex align-items-center gap-3">
                <div class="rb-hero-icon">
                    <i class="fas fa-trash-restore"></i>
                </div>
                &nbsp;&nbsp;
                <div>
                    <h4 class="mb-0 fw-bold text-white">Recycle Bin</h4>
                    <p class="mb-0 text-white opacity-75 small">Data kalibrasi yang telah dihapus sementara</p>
                </div>
            </div>
            <div class="d-flex align-items-center gap-2">
                @if($calibrations->count() > 0)
                <form action="{{ route('calibrations.empty-recycle-bin') }}" method="POST" id="form-empty-recycle-bin" class="m-0">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="rb-btn-empty" onclick="confirmAction('empty-all', null, null)">
                        <i class="fas fa-trash me-2"></i> Kosongkan Recycle Bin
                    </button>
                </form>
                @endif
                <a href="{{ route('calibrations.index') }}" class="rb-btn-back">
                    <i class="fas fa-arrow-left me-2"></i>
                    <span>Kembali ke Kalibrasi</span>
                </a>
            </div>
        </div>
    </div>

    {{-- BODY --}}
    <div class="rb-body">

        {{-- ALERTS --}}
        @if(session('success'))
        <div class="rb-alert rb-alert-success">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
        @endif
        @if(session('error'))
        <div class="rb-alert rb-alert-danger">
            <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
        @endif

        {{-- INFO BANNER --}}
        <div class="rb-info-banner">
            <div class="rb-info-icon"><i class="fas fa-info-circle"></i></div>
            <div>
                <span class="fw-semibold">Informasi:</span>
                Data di sini masih tersimpan di database dan dapat dipulihkan kapan saja. Hapus permanen jika sudah tidak dibutuhkan.
            </div>
            <div class="rb-count-badge">{{ $calibrations->count() }} Item</div>
        </div>

        {{-- TABLE --}}
        <div class="table-responsive mt-3">
            <table class="table rb-table align-middle">
                <thead>
                    <tr>
                        <th class="text-center" width="4%">No</th>
                        <th>Nama Alat</th>
                        <th>Merek</th>
                        <th>No Seri</th>
                        <th>No Label</th>
                        <th>Pemilik Alat</th>
                        <th>Kalibrasi Oleh</th>
                        <th>Tanggal Dihapus</th>
                        <th class="text-center" width="14%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($calibrations as $cal)
                    <tr class="rb-row">
                        <td class="text-center">
                            <span class="rb-num">{{ $loop->iteration }}</span>
                        </td>
                        <td>
                            <span class="fw-semibold rb-alat-name">{{ $cal->namaAlat ?? '-' }}</span>
                        </td>
                        <td>
                            @if($cal->brandAlat)
                                <span class="rb-merek-badge">{{ $cal->brandAlat }}</span>
                            @else
                                <span class="text-muted fst-italic">—</span>
                            @endif
                        </td>
                        <td class="text-muted small">{{ $cal->NoSeri ?? '—' }}</td>
                        <td>
                            <span class="rb-label-badge">{{ $cal->no_label ?? '-' }}</span>
                        </td>
                        <td class="text-muted">{{ $cal->pemilikAlat ?? '-' }}</td>
                        <td>
                            @if($cal->calibratedBy)
                                <span class="small fw-medium">{{ $cal->calibratedBy }}</span>
                            @else
                                <span class="text-muted fst-italic">—</span>
                            @endif
                        </td>
                        <td>
                            <div class="rb-deleted-at">
                                <i class="fas fa-clock me-1 text-danger opacity-75"></i>
                                {{ $cal->deleted_at ? $cal->deleted_at->format('d M Y, H:i') : '-' }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                {{-- View --}}
                                <a href="{{ route('calibrations.show', $cal->id) }}" 
                                    class="rb-btn-action rb-btn-view"
                                    data-bs-toggle="tooltip" title="Lihat Data">
                                    <i class="fas fa-eye me-1"></i> Lihat
                                </a>
                                {{-- Restore --}}
                                <form action="{{ route('calibrations.restore', $cal->id) }}" method="POST" id="form-restore-{{ $cal->id }}">
                                    @csrf
                                    <button type="button"
                                        class="rb-btn-action rb-btn-restore"
                                        onclick="confirmAction('restore', '{{ $cal->id }}', '{{ addslashes($cal->namaAlat) }}')"
                                        data-bs-toggle="tooltip" title="Pulihkan Data">
                                        <i class="fas fa-undo me-1"></i> Pulihkan
                                    </button>
                                </form>
                                {{-- Force Delete --}}
                                <form action="{{ route('calibrations.force-delete', $cal->id) }}" method="POST" id="form-delete-{{ $cal->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                        class="rb-btn-action rb-btn-destroy"
                                        onclick="confirmAction('delete', '{{ $cal->id }}', '{{ addslashes($cal->namaAlat) }}')"
                                        data-bs-toggle="tooltip" title="Hapus Permanen">
                                        <i class="fas fa-trash-alt me-1"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9">
                            <div class="rb-empty">
                                <div class="rb-empty-icon">
                                    <i class="fas fa-leaf"></i>
                                </div>
                                <h5 class="fw-bold mt-3 mb-1">Recycle Bin Bersih!</h5>
                                <p class="text-muted mb-4">Tidak ada data kalibrasi yang dihapus sementara.</p>
                                <a href="{{ route('calibrations.index') }}" class="rb-btn-back-small">
                                    <i class="fas fa-list me-1"></i> Lihat Daftar Kalibrasi
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

{{-- CUSTOM CONFIRM MODAL --}}
<div id="rb-confirm-overlay">
    <div class="rb-confirm-box" id="rb-confirm-box">
        <div class="rb-confirm-icon" id="rb-confirm-icon">
            <i id="rb-confirm-icon-i"></i>
        </div>
        <h5 class="rb-confirm-title" id="rb-confirm-title">Konfirmasi</h5>
        <p class="rb-confirm-msg" id="rb-confirm-msg"></p>
        <p class="rb-confirm-name" id="rb-confirm-name"></p>
        <div class="rb-confirm-actions">
            <button class="rb-confirm-cancel" onclick="closeConfirm()">Batal</button>
            <button class="rb-confirm-ok" id="rb-confirm-ok-btn" onclick="doAction()">Lanjutkan</button>
        </div>
    </div>
</div>

{{-- LOADING OVERLAY --}}
<div id="rb-loading-overlay">
    <div class="rb-loading-box">
        <div class="rb-spinner" id="rb-spinner-icon"></div>
        <p class="rb-loading-text" id="rb-loading-text">Memproses...</p>
        <p class="rb-loading-sub" id="rb-loading-sub">Mohon tunggu sebentar</p>
    </div>
</div>

@endsection

@push('styles')
<style>
    /* ===========================
       RECYCLE BIN – PREMIUM UI
       =========================== */
    :root {
        --rb-red: #dc2626;
        --rb-red-dark: #991b1b;
        --rb-red-light: #fef2f2;
        --rb-red-border: #fecaca;
        --rb-green: #16a34a;
        --rb-orange: #ea580c;
        --rb-gray-100: #f8fafc;
        --rb-gray-200: #e2e8f0;
        --rb-text: #334155;
        --rb-muted: #64748b;
    }

    /* WRAPPER */
    .rb-wrapper {
        margin-bottom: 2.5rem;
    }

    /* ---- HERO ---- */
    .rb-hero {
        background: linear-gradient(135deg, #7f1d1d 0%, #b91c1c 55%, #dc2626 100%);
        border-radius: 16px;
        padding: 2.25rem 2.5rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(185, 28, 28, .30);
    }

    .rb-hero-bg::before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 220px;
        height: 220px;
        background: radial-gradient(circle, rgba(255, 255, 255, .12) 0%, transparent 70%);
        border-radius: 50%;
    }

    .rb-hero-bg::after {
        content: '';
        position: absolute;
        bottom: -50px;
        left: 15%;
        width: 150px;
        height: 150px;
        background: radial-gradient(circle, rgba(255, 255, 255, .07) 0%, transparent 70%);
        border-radius: 50%;
    }

    .rb-hero-content {
        position: relative;
        z-index: 2;
    }

    .rb-hero-icon {
        width: 56px;
        height: 56px;
        background: rgba(255, 255, 255, .18);
        border: 1px solid rgba(255, 255, 255, .3);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: #fff;
        backdrop-filter: blur(6px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, .15);
        flex-shrink: 0;
    }

    /* BACK BUTTON (hero) */
    .rb-btn-back {
        background: #fff;
        color: #b91c1c !important;
        font-weight: 700;
        font-size: 0.9rem;
        padding: 0.6rem 1.4rem;
        border-radius: 50px;
        border: none;
        display: inline-flex;
        align-items: center;
        text-decoration: none !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, .12);
        transition: all .25s ease;
    }

    .rb-btn-back:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, .18);
        background: #fef2f2;
    }

    /* EMPTY BUTTON (hero) */
    .rb-btn-empty {
        background: #dc2626;
        color: #fff !important;
        font-weight: 700;
        font-size: 0.9rem;
        padding: 0.6rem 1.4rem;
        border-radius: 50px;
        border: none;
        display: inline-flex;
        align-items: center;
        text-decoration: none !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, .12);
        transition: all .25s ease;
    }

    .rb-btn-empty:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, .18);
        background: #b91c1c;
    }

    /* ---- BODY CARD ---- */
    .rb-body {
        background: #fff;
        border-radius: 16px;
        padding: 1.75rem 2rem;
        box-shadow: 0 4px 20px rgba(185, 28, 28, .07);
        border: 1px solid #fde8e8;
    }

    /* ---- ALERTS ---- */
    .rb-alert {
        display: flex;
        align-items: center;
        gap: .5rem;
        padding: .875rem 1.25rem;
        border-radius: 12px;
        margin-bottom: 1rem;
        font-weight: 500;
        font-size: .9rem;
    }

    .rb-alert-success {
        background: #f0fdf4;
        color: #166534;
        border: 1px solid #bbf7d0;
    }

    .rb-alert-danger {
        background: #fef2f2;
        color: #991b1b;
        border: 1px solid #fecaca;
    }

    /* ---- INFO BANNER ---- */
    .rb-info-banner {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: .875rem 1.25rem;
        background: linear-gradient(90deg, #fff7ed, #fef3c7);
        border: 1px solid #fed7aa;
        border-radius: 12px;
        font-size: .875rem;
        color: #92400e;
    }

    .rb-info-icon {
        width: 36px;
        height: 36px;
        background: #f97316;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .rb-count-badge {
        margin-left: auto;
        background: #dc2626;
        color: #fff;
        font-size: .78rem;
        font-weight: 700;
        padding: .25rem .8rem;
        border-radius: 50px;
        white-space: nowrap;
    }

    /* ---- TABLE ---- */
    .rb-table {
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
    }

    .rb-table thead tr {
        background: linear-gradient(135deg, #7f1d1d, #b91c1c);
    }

    .rb-table thead th {
        color: #fff;
        font-weight: 600;
        font-size: .83rem;
        text-transform: uppercase;
        letter-spacing: .5px;
        padding: .9rem 1rem;
        border: none;
    }

    .rb-table thead th:first-child {
        border-radius: 10px 0 0 0;
    }

    .rb-table thead th:last-child {
        border-radius: 0 10px 0 0;
    }

    .rb-row {
        transition: background .2s;
    }

    .rb-row:hover {
        background: #fef2f2;
    }

    .rb-table tbody td {
        padding: .9rem 1rem;
        border-bottom: 1px solid #fde8e8;
        color: var(--rb-text);
        font-size: .88rem;
        vertical-align: middle;
    }

    .rb-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Nomor urut */
    .rb-num {
        display: inline-flex;
        width: 28px;
        height: 28px;
        background: #fef2f2;
        color: #b91c1c;
        font-weight: 700;
        font-size: .8rem;
        border-radius: 50%;
        align-items: center;
        justify-content: center;
        border: 1.5px solid #fecaca;
    }

    /* Ikon alat */
    .rb-alat-icon {
        width: 34px;
        height: 34px;
        background: linear-gradient(135deg, #b91c1c, #dc2626);
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: .75rem;
        flex-shrink: 0;
    }

    .rb-alat-name {
        color: #1e293b;
    }

    /* No label badge */
    .rb-label-badge {
        background: #fef2f2;
        color: #b91c1c;
        border: 1px solid #fecaca;
        padding: .2rem .7rem;
        border-radius: 50px;
        font-size: .78rem;
        font-weight: 600;
    }

    /* Tanggal dihapus */
    .rb-deleted-at {
        font-size: .83rem;
        color: #64748b;
    }

    /* Merek badge */
    .rb-merek-badge {
        background: linear-gradient(135deg, #eff6ff, #dbeafe);
        color: #1d4ed8;
        border: 1px solid #93c5fd;
        padding: .2rem .75rem;
        border-radius: 50px;
        font-size: .78rem;
        font-weight: 600;
        white-space: nowrap;
    }

    /* Avatar teknisi */
    .rb-tech-avatar {
        width: 28px;
        height: 28px;
        background: linear-gradient(135deg, #7c3aed, #6d28d9);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: .72rem;
        font-weight: 700;
        flex-shrink: 0;
    }

    /* ACTION BUTTONS */
    .rb-btn-action {
        display: inline-flex;
        align-items: center;
        font-size: .78rem;
        font-weight: 600;
        padding: .4rem .85rem;
        border-radius: 50px;
        border: none;
        cursor: pointer;
        transition: all .2s ease;
        text-decoration: none;
        white-space: nowrap;
    }

    .rb-btn-view {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: #fff;
        box-shadow: 0 3px 10px rgba(59, 130, 246, .30);
    }

    .rb-btn-view:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(59, 130, 246, .40);
        color: #fff;
    }

    .rb-btn-restore {
        background: linear-gradient(135deg, #16a34a, #15803d);
        color: #fff;
        box-shadow: 0 3px 10px rgba(22, 163, 74, .30);
    }

    .rb-btn-restore:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(22, 163, 74, .40);
        color: #fff;
    }

    .rb-btn-destroy {
        background: linear-gradient(135deg, #dc2626, #b91c1c);
        color: #fff;
        box-shadow: 0 3px 10px rgba(220, 38, 38, .30);
    }

    .rb-btn-destroy:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(220, 38, 38, .40);
        color: #fff;
    }

    /* ---- EMPTY STATE ---- */
    .rb-empty {
        text-align: center;
        padding: 4rem 2rem;
    }

    .rb-empty-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #fef2f2, #fde8e8);
        border: 2px dashed #fca5a5;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        color: #f87171;
        margin: 0 auto;
    }

    .rb-btn-back-small {
        display: inline-flex;
        align-items: center;
        background: linear-gradient(135deg, #b91c1c, #dc2626);
        color: #fff !important;
        font-weight: 600;
        font-size: .88rem;
        padding: .55rem 1.3rem;
        border-radius: 50px;
        text-decoration: none !important;
        transition: all .25s ease;
        box-shadow: 0 4px 12px rgba(185, 28, 28, .30);
    }

    .rb-btn-back-small:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(185, 28, 28, .40);
    }

    /* Responsive tweak */
    @media (max-width: 767px) {
        .rb-hero {
            padding: 1.5rem;
        }

        .rb-body {
            padding: 1rem;
        }

        .rb-btn-action {
            padding: .35rem .65rem;
            font-size: .72rem;
        }
    }

    /* ---- LOADING OVERLAY ---- */
    #rb-loading-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(15, 10, 30, 0.65);
        backdrop-filter: blur(6px);
        -webkit-backdrop-filter: blur(6px);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        animation: rb-fade-in .2s ease;
    }
    #rb-loading-overlay.active {
        display: flex;
    }
    @keyframes rb-fade-in {
        from { opacity: 0; }
        to   { opacity: 1; }
    }

    .rb-loading-box {
        background: #fff;
        border-radius: 20px;
        padding: 2.5rem 3rem;
        text-align: center;
        box-shadow: 0 20px 60px rgba(0,0,0,.3);
        animation: rb-slide-up .3s ease;
        min-width: 260px;
    }
    @keyframes rb-slide-up {
        from { transform: translateY(20px); opacity: 0; }
        to   { transform: translateY(0);    opacity: 1; }
    }

    /* Spinner base */
    .rb-spinner {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        border: 5px solid #e2e8f0;
        border-top-color: #dc2626;
        animation: rb-spin .75s linear infinite;
        margin: 0 auto 1.25rem;
    }
    .rb-spinner-green {
        border-top-color: #16a34a;
    }
    .rb-spinner-red {
        border-top-color: #dc2626;
    }
    @keyframes rb-spin {
        to { transform: rotate(360deg); }
    }

    .rb-loading-text {
        font-weight: 700;
        font-size: 1.05rem;
        color: #1e293b;
        margin-bottom: .3rem;
    }
    .rb-loading-sub {
        font-size: .82rem;
        color: #64748b;
        margin: 0;
    }

    /* ---- CUSTOM CONFIRM MODAL ---- */
    #rb-confirm-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(15, 10, 30, 0.55);
        backdrop-filter: blur(5px);
        -webkit-backdrop-filter: blur(5px);
        z-index: 10000;
        align-items: center;
        justify-content: center;
    }
    #rb-confirm-overlay.active {
        display: flex;
    }

    .rb-confirm-box {
        background: #fff;
        border-radius: 22px;
        padding: 2.5rem 2.25rem 2rem;
        max-width: 400px;
        width: 90%;
        text-align: center;
        box-shadow: 0 25px 70px rgba(0,0,0,.25);
        transform: translateY(24px) scale(.96);
        opacity: 0;
        transition: transform .28s cubic-bezier(.34,1.56,.64,1), opacity .22s ease;
    }
    .rb-confirm-box.show {
        transform: translateY(0) scale(1);
        opacity: 1;
    }

    /* Icon lingkaran */
    .rb-confirm-icon {
        width: 68px; height: 68px;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.6rem;
        margin: 0 auto 1.2rem;
    }
    .rb-confirm-icon-green {
        background: linear-gradient(135deg, #dcfce7, #bbf7d0);
        color: #16a34a;
        border: 2px solid #86efac;
    }
    .rb-confirm-icon-red {
        background: linear-gradient(135deg, #fef2f2, #fde8e8);
        color: #dc2626;
        border: 2px solid #fca5a5;
    }

    .rb-confirm-title {
        font-weight: 700;
        font-size: 1.15rem;
        color: #1e293b;
        margin-bottom: .4rem;
    }
    .rb-confirm-msg {
        font-size: .875rem;
        color: #64748b;
        margin-bottom: .6rem;
        line-height: 1.5;
    }
    .rb-confirm-name {
        font-weight: 700;
        font-size: .95rem;
        color: #0f172a;
        background: #f1f5f9;
        border-radius: 10px;
        padding: .5rem .9rem;
        margin-bottom: 1.5rem;
        word-break: break-word;
    }

    .rb-confirm-actions {
        display: flex;
        gap: .75rem;
        justify-content: center;
    }
    .rb-confirm-cancel {
        flex: 1;
        padding: .6rem 1rem;
        border-radius: 50px;
        border: 1.5px solid #e2e8f0;
        background: #fff;
        color: #64748b;
        font-weight: 600;
        font-size: .88rem;
        cursor: pointer;
        transition: all .2s;
    }
    .rb-confirm-cancel:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
        color: #334155;
    }
    .rb-confirm-ok {
        flex: 1.4;
        padding: .6rem 1rem;
        border-radius: 50px;
        border: none;
        font-weight: 700;
        font-size: .88rem;
        color: #fff;
        cursor: pointer;
        transition: all .2s;
        display: flex; align-items: center; justify-content: center;
    }
    .rb-confirm-ok-green {
        background: linear-gradient(135deg, #16a34a, #15803d);
        box-shadow: 0 4px 14px rgba(22,163,74,.35);
    }
    .rb-confirm-ok-green:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(22,163,74,.45);
    }
    .rb-confirm-ok-red {
        background: linear-gradient(135deg, #dc2626, #b91c1c);
        box-shadow: 0 4px 14px rgba(220,38,38,.35);
    }
    .rb-confirm-ok-red:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(220,38,38,.45);
    }
</style>
@endpush

@push('scripts')
<script>
    // Init tooltips
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
        new bootstrap.Tooltip(el, { trigger: 'hover' });
    });

    // State untuk menyimpan aksi yang akan dilakukan
    let _pendingType = null;
    let _pendingId   = null;

    function confirmAction(type, id, namaAlat) {
        _pendingType = type;
        _pendingId   = id;

        const overlay  = document.getElementById('rb-confirm-overlay');
        const box      = document.getElementById('rb-confirm-box');
        const iconEl   = document.getElementById('rb-confirm-icon');
        const iconI    = document.getElementById('rb-confirm-icon-i');
        const title    = document.getElementById('rb-confirm-title');
        const msg      = document.getElementById('rb-confirm-msg');
        const nameEl   = document.getElementById('rb-confirm-name');
        const okBtn    = document.getElementById('rb-confirm-ok-btn');

        if (type === 'restore') {
            iconEl.className  = 'rb-confirm-icon rb-confirm-icon-green';
            iconI.className   = 'fas fa-undo';
            title.textContent = 'Pulihkan Data?';
            msg.textContent   = 'Data berikut akan dipulihkan kembali ke daftar kalibrasi:';
            okBtn.className   = 'rb-confirm-ok rb-confirm-ok-green';
            okBtn.innerHTML   = '<i class="fas fa-undo me-2"></i>Ya, Pulihkan';
            nameEl.style.display = 'block';
            nameEl.textContent = namaAlat;
        } else if (type === 'delete') {
            iconEl.className  = 'rb-confirm-icon rb-confirm-icon-red';
            iconI.className   = 'fas fa-exclamation-triangle';
            title.textContent = 'Hapus Permanen?';
            msg.textContent   = 'Data berikut akan dihapus PERMANEN dan tidak dapat dikembalikan lagi!';
            okBtn.className   = 'rb-confirm-ok rb-confirm-ok-red';
            okBtn.innerHTML   = '<i class="fas fa-trash-alt me-2"></i>Ya, Hapus Permanen';
            nameEl.style.display = 'block';
            nameEl.textContent = namaAlat;
        } else if (type === 'empty-all') {
            iconEl.className  = 'rb-confirm-icon rb-confirm-icon-red';
            iconI.className   = 'fas fa-exclamation-triangle';
            title.textContent = 'Kosongkan Recycle Bin?';
            msg.textContent   = 'Semua data di recycle bin akan dihapus PERMANEN dan tidak dapat dikembalikan lagi!';
            okBtn.className   = 'rb-confirm-ok rb-confirm-ok-red';
            okBtn.innerHTML   = '<i class="fas fa-trash-alt me-2"></i>Ya, Kosongkan';
            nameEl.style.display = 'none';
        }

        overlay.classList.add('active');
        // Trigger animasi
        requestAnimationFrame(() => box.classList.add('show'));
    }

    function closeConfirm() {
        const overlay = document.getElementById('rb-confirm-overlay');
        const box     = document.getElementById('rb-confirm-box');
        box.classList.remove('show');
        setTimeout(() => overlay.classList.remove('active'), 250);
    }

    function doAction() {
        if (!_pendingType) return;
        
        // Simpan nilai ke variabel lokal sebelum direset
        const typeToRun = _pendingType;
        const idToRun   = _pendingId;
        
        closeConfirm();
        
        // Reset state global
        _pendingType = null;
        _pendingId   = null;

        setTimeout(() => {
            showLoading(typeToRun);
            let formId;
            if (typeToRun === 'restore') {
                formId = `form-restore-${idToRun}`;
            } else if (typeToRun === 'delete') {
                formId = `form-delete-${idToRun}`;
            } else if (typeToRun === 'empty-all') {
                formId = 'form-empty-recycle-bin';
            }
            if(formId) {
                document.getElementById(formId).submit();
            }
        }, 280);
    }

    // Tutup modal jika klik di luar box
    document.getElementById('rb-confirm-overlay').addEventListener('click', function(e) {
        if (e.target === this) {
            closeConfirm();
            _pendingType = null;
            _pendingId   = null;
        }
    });

    function showLoading(type) {
        const overlay = document.getElementById('rb-loading-overlay');
        const text    = document.getElementById('rb-loading-text');
        const sub     = document.getElementById('rb-loading-sub');
        const spinner = document.getElementById('rb-spinner-icon');

        if (type === 'restore') {
            text.textContent  = 'Memulihkan Data...';
            sub.textContent   = 'Data sedang dipulihkan ke daftar kalibrasi';
            spinner.className = 'rb-spinner rb-spinner-green';
        } else if (type === 'delete') {
            text.textContent  = 'Menghapus Permanen...';
            sub.textContent   = 'Data sedang dihapus secara permanen';
            spinner.className = 'rb-spinner rb-spinner-red';
        } else if (type === 'empty-all') {
            text.textContent  = 'Mengosongkan Recycle Bin...';
            sub.textContent   = 'Semua data sedang dihapus secara permanen';
            spinner.className = 'rb-spinner rb-spinner-red';
        }
        overlay.classList.add('active');
    }
</script>
@endpush