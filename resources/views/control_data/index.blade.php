@extends('layouts.app')
@section('title', 'Control Data Kalibrasi - Super Admin')

@push('styles')
<!-- Google Fonts: Inter + JetBrains Mono -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

<!-- DataTables Bootstrap 4 & Responsive -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">

<style>
    /* ============================================================
       THEME & VARIABLES: Clean Royal Modern
       ============================================================ */
    :root {
        --cd-primary: #2563eb;
        --cd-primary-hover: #1d4ed8;
        --cd-primary-light: #eff6ff;
        --cd-primary-border: #bfdbfe;
        --cd-dark-blue: #1e3a8a;
        --cd-text-main: #0f172a;
        --cd-text-muted: #64748b;
        --cd-bg: #f8fafc;
        --cd-surface: #ffffff;
        --cd-border: #e2e8f0;
        --cd-border-light: #f1f5f9;
        --cd-radius-lg: 16px;
        --cd-radius-md: 10px;
        --cd-radius-sm: 6px;
        --cd-shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.05);
        --cd-shadow: 0 4px 15px rgba(37, 99, 235, 0.05), 0 1px 3px rgba(0, 0, 0, 0.04);
        --cd-shadow-lg: 0 10px 30px rgba(37, 99, 235, 0.12);
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif !important;
        background-color: var(--cd-bg);
        color: var(--cd-text-main);
    }

    .font-mono {
        font-family: 'JetBrains Mono', monospace !important;
    }

    /* ─── HERO HEADER ─────────────────────────────────────────────── */
    .cd-hero-card {
        background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 55%, #2563eb 100%);
        border-radius: var(--cd-radius-lg);
        padding: 24px 30px;
        color: #fff;
        margin-bottom: 22px;
        box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.35);
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.15);
    }
    .cd-hero-card::before {
        content: '';
        position: absolute;
        top: -60px; right: -60px;
        width: 220px; height: 220px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.15) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }
    .cd-hero-card::after {
        content: '';
        position: absolute;
        bottom: -50px; left: 30%;
        width: 160px; height: 160px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }
    .cd-hero-icon {
        width: 52px; height: 52px;
        background: rgba(255, 255, 255, 0.18);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.45rem; flex-shrink: 0;
        color: #ffffff;
        backdrop-filter: blur(6px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .cd-hero-title {
        font-size: 1.45rem;
        font-weight: 800;
        letter-spacing: -0.3px;
        color: #ffffff;
    }
    .cd-hero-sub {
        color: rgba(255, 255, 255, 0.82);
        font-size: 0.86rem;
        margin-top: 4px;
        line-height: 1.45;
    }
    .cd-hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: rgba(255, 255, 255, 0.18);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: #ffffff;
        border-radius: 20px;
        padding: 3px 10px;
        font-size: 0.70rem;
        font-weight: 700;
        letter-spacing: 0.4px;
        text-transform: uppercase;
    }
    .btn-hero-action {
        background: #ffffff;
        color: var(--cd-primary) !important;
        font-weight: 700;
        font-size: 0.84rem;
        padding: 8px 16px;
        border-radius: 50px;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.2s ease;
        text-decoration: none !important;
    }
    .btn-hero-action:hover {
        background: #f8fafc;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
    }
    .btn-hero-outline {
        background: rgba(255, 255, 255, 0.12);
        color: #ffffff !important;
        font-weight: 600;
        font-size: 0.84rem;
        padding: 8px 16px;
        border-radius: 50px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s ease;
        text-decoration: none !important;
    }
    .btn-hero-outline:hover {
        background: rgba(255, 255, 255, 0.22);
        transform: translateY(-2px);
    }

    /* ─── METRICS CARDS ───────────────────────────────────────────── */
    .metric-card {
        border-radius: var(--cd-radius-md);
        border: 1px solid var(--cd-border);
        background: var(--cd-surface);
        padding: 16px 18px;
        box-shadow: var(--cd-shadow-sm);
        transition: all 0.25s ease;
        position: relative;
        overflow: hidden;
    }
    .metric-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--cd-shadow);
        border-color: #cbd5e1;
    }
    .metric-icon-wrap {
        width: 40px; height: 40px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.15rem;
        flex-shrink: 0;
    }
    .metric-label {
        font-size: 0.70rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: var(--cd-text-muted);
        margin-bottom: 2px;
    }
    .metric-value {
        font-size: 1.55rem;
        font-weight: 800;
        letter-spacing: -0.5px;
        line-height: 1.15;
    }
    .metric-sub {
        font-size: 0.70rem;
        color: #94a3b8;
    }

    /* ─── FILTER SECTION ──────────────────────────────────────────── */
    .filter-card {
        border-radius: var(--cd-radius-lg);
        border: 1px solid var(--cd-border);
        background: var(--cd-surface);
        box-shadow: var(--cd-shadow-sm);
        margin-bottom: 20px;
        overflow: hidden;
    }
    .filter-header {
        background: #ffffff;
        padding: 14px 22px;
        border-bottom: 1px solid var(--cd-border-light);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .form-group-label {
        font-size: 0.72rem;
        font-weight: 700;
        color: var(--cd-text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 6px;
        display: block;
    }
    .form-control-custom {
        border-radius: 8px;
        border: 1.5px solid var(--cd-border);
        font-size: 0.85rem;
        padding: 8px 12px;
        transition: all 0.2s ease;
        background-color: #fbfcfe;
        color: var(--cd-text-main);
    }
    .form-control-custom:focus {
        border-color: var(--cd-primary);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        background-color: #fff;
        outline: none;
    }
    .form-control-custom:hover:not(:focus) {
        border-color: #cbd5e1;
    }

    /* ─── MAIN TABLE CARD ─────────────────────────────────────────── */
    .main-table-card {
        border-radius: var(--cd-radius-lg);
        border: 1px solid var(--cd-border);
        background: var(--cd-surface);
        box-shadow: var(--cd-shadow);
        overflow: hidden;
    }
    .table-top-toolbar {
        padding: 16px 22px;
        border-bottom: 1px solid var(--cd-border);
        background: #ffffff;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: gap-2;
    }
    
    /* Modern DataTable Table */
    .table-cd {
        margin-bottom: 0 !important;
        border-collapse: separate !important;
        border-spacing: 0 !important;
        width: 100% !important;
    }
    .table-cd thead th {
        background: #f8fafc !important;
        color: #475569 !important;
        font-weight: 700 !important;
        font-size: 0.72rem !important;
        text-transform: uppercase !important;
        letter-spacing: 0.6px !important;
        padding: 13px 14px !important;
        border-bottom: 2px solid var(--cd-border) !important;
        border-top: none !important;
        vertical-align: middle !important;
        white-space: nowrap !important;
    }
    .table-cd tbody td {
        padding: 12px 14px !important;
        vertical-align: middle !important;
        font-size: 0.84rem !important;
        border-bottom: 1px solid var(--cd-border-light) !important;
        color: var(--cd-text-main) !important;
        background-color: #ffffff;
    }
    .table-cd tbody tr {
        transition: background-color 0.15s ease;
    }
    .table-cd tbody tr:hover td {
        background-color: #f1f5f9 !important;
    }
    .table-cd tbody tr.row-deleted td {
        background-color: #fff1f2 !important;
    }

    /* DataTables Custom Controls Integration */
    .dataTables_wrapper {
        font-size: 0.84rem;
    }
    /* ─── CUSTOM SCROLLBAR & PAGINATION ─────────────────────────── */
    .table-responsive::-webkit-scrollbar {
        height: 6px;
    }
    .table-responsive::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 4px;
    }
    .table-responsive::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }
    .table-responsive::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    /* Clean Unified Pagination */
    .pagination {
        margin-bottom: 0 !important;
        display: flex !important;
        align-items: center !important;
        gap: 4px !important;
    }
    .pagination .page-item .page-link {
        border-radius: 8px !important;
        border: 1px solid var(--cd-border) !important;
        color: var(--cd-text-muted) !important;
        font-weight: 600 !important;
        font-size: 0.82rem !important;
        padding: 6px 12px !important;
        background: #ffffff !important;
        transition: all 0.15s ease !important;
        box-shadow: none !important;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .pagination .page-item.active .page-link {
        background: var(--cd-primary) !important;
        border-color: var(--cd-primary) !important;
        color: #ffffff !important;
        box-shadow: 0 2px 8px rgba(37, 99, 235, 0.25) !important;
    }
    .pagination .page-item:not(.active):not(.disabled) .page-link:hover {
        background: var(--cd-primary-light) !important;
        color: var(--cd-primary) !important;
        border-color: var(--cd-primary-border) !important;
    }
    .pagination .page-item.disabled .page-link {
        color: #94a3b8 !important;
        background: #f8fafc !important;
        border-color: var(--cd-border) !important;
        opacity: 0.6;
        cursor: not-allowed;
    }

    /* ─── BADGES & PILLS ──────────────────────────────────────────── */
    .id-code-badge {
        font-family: 'JetBrains Mono', monospace;
        font-weight: 700;
        font-size: 0.80rem;
        background: #f1f5f9;
        color: #1e3a8a;
        padding: 3px 8px;
        border-radius: 6px;
        border: 1px solid #e2e8f0;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        cursor: pointer;
        transition: all 0.15s ease;
    }
    .id-code-badge:hover {
        background: #e2e8f0;
        border-color: #cbd5e1;
    }
    .badge-form-type {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.68rem;
        font-weight: 600;
        background: #ecfeff;
        color: #0e7490;
        border: 1px solid #cffafe;
        border-radius: 6px;
        padding: 2px 7px;
        display: inline-block;
    }
    .badge-status-pill {
        border-radius: 20px;
        padding: 4px 10px;
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    .badge-status-approved { background: #ecfdf5; color: #059669; border: 1px solid #a7f3d0; }
    .badge-status-verified { background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe; }
    .badge-status-waiting { background: #fffbeb; color: #d97706; border: 1px solid #fde68a; }
    .badge-status-draft { background: #f8fafc; color: #64748b; border: 1px solid #e2e8f0; }
    .badge-status-rejected { background: #fff1f2; color: #e11d48; border: 1px solid #fecdd3; }

    /* Relasi Pills */
    .rel-pill {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 0.68rem;
        font-weight: 600;
        padding: 3px 8px;
        border-radius: 6px;
        white-space: nowrap;
    }
    .rel-pill-yes { background: #ecfdf5; color: #047857; border: 1px solid #a7f3d0; }
    .rel-pill-no { background: #f8fafc; color: #94a3b8; border: 1px solid #e2e8f0; }
    .rel-pill-info { background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; }
    .rel-pill-warn { background: #fffbeb; color: #b45309; border: 1px solid #fde68a; }

    /* Action Buttons */
    .btn-action-icon {
        width: 32px; height: 32px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.80rem;
        border: 1px solid transparent;
        transition: all 0.15s ease;
    }
    .btn-action-icon:hover {
        transform: translateY(-2px);
    }
    .btn-action-inspect {
        background: #eff6ff;
        color: #2563eb;
        border-color: #bfdbfe;
    }
    .btn-action-inspect:hover {
        background: #2563eb;
        color: #ffffff;
    }
    .btn-action-edit {
        background: #fef3c7;
        color: #d97706;
        border-color: #fde68a;
    }
    .btn-action-edit:hover {
        background: #d97706;
        color: #ffffff;
    }
    .btn-action-open {
        background: #ecfeff;
        color: #0891b2;
        border-color: #a5f3fc;
    }
    .btn-action-open:hover {
        background: #0891b2;
        color: #ffffff;
    }
    .btn-action-json {
        background: #f1f5f9;
        color: #475569;
        border-color: #cbd5e1;
    }
    .btn-action-json:hover {
        background: #475569;
        color: #ffffff;
    }

    /* ─── MODAL MODERN ────────────────────────────────────────────── */
    .modal-xl-custom { max-width: 95%; }
    .modal-content-modern {
        border-radius: var(--cd-radius-lg);
        border: none;
        box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.3);
        overflow: hidden;
    }
    .modal-header-modern {
        background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 55%, #2563eb 100%);
        color: #fff;
        padding: 18px 24px;
        border-bottom: 1px solid rgba(255,255,255,0.12);
    }
    .modal-tabs-modern {
        border-bottom: 2px solid var(--cd-border);
        background: #f8fafc;
        padding: 0 16px;
    }
    .modal-tabs-modern .nav-link {
        border: none;
        color: var(--cd-text-muted);
        font-weight: 600;
        font-size: 0.82rem;
        padding: 12px 16px;
        border-radius: 8px 8px 0 0;
        position: relative;
        transition: all 0.15s ease;
    }
    .modal-tabs-modern .nav-link:hover {
        color: var(--cd-primary);
        background: #f1f5f9;
    }
    .modal-tabs-modern .nav-link.active {
        color: var(--cd-primary);
        background: #ffffff;
    }
    .modal-tabs-modern .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: -2px; left: 0; right: 0;
        height: 3px;
        background: var(--cd-primary);
        border-radius: 3px 3px 0 0;
    }
    .raw-json-box {
        background: #0f172a;
        color: #38bdf8;
        padding: 16px;
        border-radius: 10px;
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.78rem;
        max-height: 480px;
        overflow-y: auto;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-3 py-2">

    <!-- Hero Card Header -->
    <div class="cd-hero-card d-flex flex-wrap align-items-center justify-content-between gap-3">
        <div class="d-flex align-items-center gap-3">
            <div class="cd-hero-icon">
                <i class="fas fa-database"></i>
            </div>
            <div>
                <div class="d-flex align-items-center flex-wrap gap-2 mb-1">
                    <h2 class="cd-hero-title mb-0">Control Data Kalibrasi</h2>
                    <span class="cd-hero-badge">
                        <i class="fas fa-user-shield text-warning"></i> Super Admin
                    </span>
                    <span class="cd-hero-badge">
                        <i class="fas fa-project-diagram text-info"></i> Master Relasi Join
                    </span>
                </div>
                <p class="cd-hero-sub mb-0">
                    Inspeksi terpadu tabel master <code>calibrations</code> ter-relasi dengan tabel <code>head</code>, <code>detail</code>, dan <code>add</code>.
                </p>
            </div>
        </div>
        <div class="d-flex align-items-center gap-2 flex-wrap">
            <a href="{{ route('calibrations.index') }}" class="btn-hero-outline">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar
            </a>
            <button type="button" class="btn-hero-action" onclick="window.location.reload();">
                <i class="fas fa-sync-alt"></i> Refresh Data
            </button>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-lg border-0 shadow-sm mb-3 d-flex align-items-center" role="alert">
        <i class="fas fa-check-circle fa-lg mr-2 text-success"></i>
        <div><strong>Berhasil!</strong> {{ session('success') }}</div>
        <button type="button" class="close ml-auto" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show rounded-lg border-0 shadow-sm mb-3 d-flex align-items-center" role="alert">
        <i class="fas fa-exclamation-triangle fa-lg mr-2 text-danger"></i>
        <div><strong>Gagal!</strong> {{ session('error') }}</div>
        <button type="button" class="close ml-auto" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <!-- 6 Metric Stats Cards -->
    <div class="row mb-3">
        <div class="col-xl-2 col-md-4 col-sm-6 mb-2">
            <div class="metric-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="metric-label">Total Data</div>
                        <div class="metric-value font-mono text-primary">{{ number_format($stats['total']) }}</div>
                        <div class="metric-sub">Semua rekaman</div>
                    </div>
                    <div class="metric-icon-wrap" style="background: #eff6ff; color: #2563eb;">
                        <i class="fas fa-layer-group"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-sm-6 mb-2">
            <div class="metric-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="metric-label">Bulan Ini</div>
                        <div class="metric-value font-mono text-info">{{ number_format($stats['month']) }}</div>
                        <div class="metric-sub">30 hari terakhir</div>
                    </div>
                    <div class="metric-icon-wrap" style="background: #ecfeff; color: #0891b2;">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-sm-6 mb-2">
            <div class="metric-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="metric-label">Draft</div>
                        <div class="metric-value font-mono text-secondary">{{ number_format($stats['draft']) }}</div>
                        <div class="metric-sub">Belum diproses</div>
                    </div>
                    <div class="metric-icon-wrap" style="background: #f1f5f9; color: #64748b;">
                        <i class="fas fa-file-alt"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-sm-6 mb-2">
            <div class="metric-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="metric-label">Verified</div>
                        <div class="metric-value font-mono" style="color: #0284c7;">{{ number_format($stats['verified']) }}</div>
                        <div class="metric-sub">Terverifikasi</div>
                    </div>
                    <div class="metric-icon-wrap" style="background: #f0f9ff; color: #0284c7;">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-sm-6 mb-2">
            <div class="metric-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="metric-label">Approved</div>
                        <div class="metric-value font-mono text-success">{{ number_format($stats['approved']) }}</div>
                        <div class="metric-sub">Disetujui</div>
                    </div>
                    <div class="metric-icon-wrap" style="background: #ecfdf5; color: #059669;">
                        <i class="fas fa-stamp"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-sm-6 mb-2">
            <div class="metric-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="metric-label">Recycle Bin</div>
                        <div class="metric-value font-mono text-danger">{{ number_format($stats['deleted']) }}</div>
                        <div class="metric-sub">Data terhapus</div>
                    </div>
                    <div class="metric-icon-wrap" style="background: #fff1f2; color: #e11d48;">
                        <i class="fas fa-trash-alt"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Card (Compact & Clean) -->
    <div class="filter-card mb-3">
        <div class="filter-header" style="cursor: pointer;" data-toggle="collapse" data-target="#filterBodyArea" aria-expanded="true">
            <div class="d-flex align-items-center gap-2">
                <i class="fas fa-sliders-h text-primary"></i>
                <span class="font-weight-bold" style="font-size: 0.88rem;">Filter & Pencarian Lanjutan</span>
                @if($search || $formTypeFilter || $statusFilter || $dateStart || $dateEnd || $withDeleted)
                <span class="badge badge-primary font-weight-normal px-2 py-1 ml-2" style="font-size: 0.70rem;">Filter Aktif</span>
                @endif
            </div>
            <div>
                <span class="text-muted small mr-2">Klik untuk sembunyikan/tampilkan</span>
                <i class="fas fa-chevron-down text-muted" id="filterChevronIcon"></i>
            </div>
        </div>
        <div class="collapse show" id="filterBodyArea">
            <div class="p-3">
                <form method="GET" action="{{ route('control-data.index') }}" id="filterForm">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 mb-2">
                            <label class="form-group-label"><i class="fas fa-search mr-1"></i> Kata Kunci Database</label>
                            <input type="text" name="search" class="form-control form-control-custom" placeholder="ID, Alat, No Seri, Customer, PO..." value="{{ $search }}">
                        </div>
                        <div class="col-lg-3 col-md-6 mb-2">
                            <label class="form-group-label"><i class="fas fa-tools mr-1"></i> Jenis Form / Alat</label>
                            <select name="form_type" class="form-control form-control-custom">
                                <option value="">-- Semua Jenis Alat --</option>
                                @foreach($availableFormTypes as $ft)
                                <option value="{{ $ft }}" {{ $formTypeFilter === $ft ? 'selected' : '' }}>
                                    {{ ucwords(str_replace('_', ' ', $ft)) }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-4 mb-2">
                            <label class="form-group-label"><i class="fas fa-info-circle mr-1"></i> Status</label>
                            <select name="status" class="form-control form-control-custom">
                                <option value="">-- Semua Status --</option>
                                <option value="draft" {{ $statusFilter === 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="waiting_verification" {{ $statusFilter === 'waiting_verification' ? 'selected' : '' }}>Waiting Verification</option>
                                <option value="waiting_approval" {{ $statusFilter === 'waiting_approval' ? 'selected' : '' }}>Waiting Approval</option>
                                <option value="verified" {{ $statusFilter === 'verified' ? 'selected' : '' }}>Verified</option>
                                <option value="approved" {{ $statusFilter === 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="completed" {{ $statusFilter === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="rejected" {{ $statusFilter === 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-4 mb-2">
                            <label class="form-group-label"><i class="fas fa-calendar-alt mr-1"></i> Tanggal Dari</label>
                            <input type="date" name="tanggal_mulai" class="form-control form-control-custom" value="{{ $dateStart }}">
                        </div>
                        <div class="col-lg-2 col-md-4 mb-2">
                            <label class="form-group-label"><i class="fas fa-calendar-alt mr-1"></i> Tanggal Sampai</label>
                            <input type="date" name="tanggal_akhir" class="form-control form-control-custom" value="{{ $dateEnd }}">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-2 mt-1 border-top flex-wrap gap-2">
                        <div class="d-flex align-items-center gap-3">
                            <div class="custom-control custom-checkbox mr-3">
                                <input type="checkbox" class="custom-control-input" id="withDeleted" name="with_deleted" value="1" {{ $withDeleted ? 'checked' : '' }}>
                                <label class="custom-control-label small font-weight-bold text-muted cursor-pointer" for="withDeleted">
                                    <i class="fas fa-trash-restore text-warning mr-1"></i> Tampilkan Data Terhapus
                                </label>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="small text-muted mr-2 font-weight-bold">Muat Server:</span>
                                <select name="per_page" class="form-control form-control-sm form-control-custom" style="width: 120px;" onchange="document.getElementById('filterForm').submit();">
                                    <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25 baris</option>
                                    <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50 baris</option>
                                    <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100 baris</option>
                                    <option value="200" {{ $perPage == 200 ? 'selected' : '' }}>200 baris</option>
                                    <option value="all" {{ request('per_page') == 'all' ? 'selected' : '' }}>Semua Data</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <a href="{{ route('control-data.index') }}" class="btn btn-sm btn-light border px-3" style="border-radius: 8px;">
                                <i class="fas fa-undo mr-1"></i> Reset
                            </a>
                            <button type="submit" class="btn btn-sm btn-primary px-4 font-weight-bold" style="border-radius: 8px;">
                                <i class="fas fa-filter mr-1"></i> Terapkan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Main Table Card with DataTable -->
    <div class="main-table-card mb-4">
        <!-- Card Header Info & Quick Search -->
        <div class="table-top-toolbar d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div class="d-flex align-items-center gap-2">
                <div class="metric-icon-wrap" style="width: 36px; height: 36px; background: #eff6ff; color: #2563eb; font-size: 1rem;">
                    <i class="fas fa-table"></i>
                </div>
                <div>
                    <h6 class="font-weight-bold text-dark mb-0">Data Master Calibrations & Relasi Join</h6>
                    <small class="text-muted">
                        Menampilkan <strong>{{ $calibrations->firstItem() ?? 0 }}</strong> – <strong>{{ $calibrations->lastItem() ?? 0 }}</strong> dari total <strong>{{ number_format($calibrations->total()) }}</strong> data tersimpan
                    </small>
                </div>
            </div>
            <div class="d-flex align-items-center gap-2">
                <div id="tableInstantSearchWrapper"></div>
            </div>
        </div>

        <!-- Table View -->
        <div class="table-responsive p-0">
            <table id="controlDataTable" class="table table-hover table-cd nowrap w-100 mb-0">
                <thead>
                    <tr>
                        <th width="40" class="text-center">No</th>
                        <th width="180">ID Kalibrasi</th>
                        <th width="220">Nama Alat & Jenis</th>
                        <th width="190">Identitas Alat</th>
                        <th width="180">Customer & PO</th>
                        <th width="110">Tgl Kalibrasi</th>
                        <th width="110" class="text-center">Status</th>
                        <th width="110" class="text-center">Tabel Head</th>
                        <th width="120" class="text-center">Tabel Detail</th>
                        <th width="110" class="text-center">Tabel Add</th>
                        <th width="150" class="text-center">Aksi Super Admin</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($itemsWithRelations as $index => $item)
                    @php
                        $c = $item['calibration'];
                        $r = $item['relation_info'];
                        $isDeleted = $c->trashed();
                    @endphp
                    <tr id="row-cal-{{ $c->id }}" class="{{ $isDeleted ? 'row-deleted' : '' }}">
                        <!-- No -->
                        <td class="text-center font-mono text-muted" style="font-size: 0.80rem;">
                            {{ $calibrations->firstItem() + $index }}
                        </td>

                        <!-- ID Kalibrasi -->
                        <td>
                            <div class="d-flex align-items-center">
                                <span class="id-code-badge" onclick="copyText('{{ $c->id }}')" title="Klik untuk menyalin ID">
                                    <i class="far fa-copy text-muted mr-1" style="font-size: 0.72rem;"></i> {{ $c->id }}
                                </span>
                            </div>
                            @if($isDeleted)
                            <span class="badge badge-danger text-uppercase mt-1" style="font-size: 0.64rem;">
                                <i class="fas fa-trash-alt mr-1"></i> Terhapus
                            </span>
                            @endif
                            @if(!empty($r['subforms']))
                            <div class="mt-1 d-flex flex-wrap gap-1">
                                @foreach($r['subforms'] as $sub)
                                <span class="badge badge-light border text-muted font-weight-normal" style="font-size: 0.65rem;">
                                    + {{ ucwords(str_replace('_', ' ', $sub)) }}
                                </span>
                                @endforeach
                            </div>
                            @endif
                        </td>

                        <!-- Nama Alat & Form Type -->
                        <td>
                            <div class="font-weight-bold text-dark mb-1" style="font-size: 0.86rem;">
                                {{ $c->namaAlat ?: '-' }}
                            </div>
                            <span class="badge-form-type">
                                <i class="fas fa-tag mr-1"></i>{{ $r['form_type'] }}
                            </span>
                        </td>

                        <!-- Identitas Alat -->
                        <td>
                            <div class="small line-height-sm">
                                <div><span class="text-muted">Brand:</span> <strong>{{ $c->brandAlat ?: '-' }}</strong></div>
                                <div><span class="text-muted">Seri:</span> <span class="font-mono">{{ $c->NoSeri ?: '-' }}</span></div>
                                <div><span class="text-muted">Kode:</span> <span class="font-mono">{{ $c->kodeAlat ?: '-' }}</span></div>
                            </div>
                        </td>

                        <!-- Customer & PO -->
                        <td>
                            <div class="small">
                                <div class="font-weight-bold text-dark text-truncate" style="max-width: 170px;" title="{{ $c->pemilikAlat }}">
                                    {{ $c->pemilikAlat ?: '-' }}
                                </div>
                                @if($c->no_po)
                                <div class="text-muted font-mono mt-1" style="font-size: 0.72rem;">
                                    <i class="fas fa-receipt mr-1 text-secondary"></i>{{ $c->no_po }}
                                </div>
                                @endif
                            </div>
                        </td>

                        <!-- Tanggal Kalibrasi -->
                        <td>
                            <div class="small font-mono">
                                <i class="far fa-calendar-alt text-muted mr-1"></i>
                                {{ $c->tanggalKalibrasi ? \Carbon\Carbon::parse($c->tanggalKalibrasi)->format('d/m/Y') : '-' }}
                            </div>
                        </td>

                        <!-- Status Badge -->
                        <td class="text-center">
                            @php
                                $statusClass = match($c->status) {
                                    'approved' => 'badge-status-approved',
                                    'verified' => 'badge-status-verified',
                                    'waiting_approval', 'waiting_verification' => 'badge-status-waiting',
                                    'rejected' => 'badge-status-rejected',
                                    default => 'badge-status-draft',
                                };
                            @endphp
                            <span class="badge-status-pill {{ $statusClass }}">
                                {{ $c->status ?: 'DRAFT' }}
                            </span>
                        </td>

                        <!-- Head Relasi -->
                        <td class="text-center">
                            @if($r['has_head'])
                                <span class="rel-pill rel-pill-yes" title="Tabel: {{ $r['head_table'] }}">
                                    <i class="fas fa-check-circle"></i> Ada ({{ $r['head_count'] }})
                                </span>
                                <small class="d-block text-muted mt-1 font-mono" style="font-size: 0.65rem;">{{ $r['head_model'] }}</small>
                            @else
                                <span class="rel-pill rel-pill-no">
                                    <i class="fas fa-minus-circle"></i> Kosong
                                </span>
                                @if($r['head_model'])
                                <small class="d-block text-muted mt-1 font-mono" style="font-size: 0.65rem;">{{ $r['head_model'] }}</small>
                                @endif
                            @endif
                        </td>

                        <!-- Detail Relasi -->
                        <td class="text-center">
                            @if($r['detail_count'] > 0)
                                <span class="rel-pill rel-pill-info">
                                    <i class="fas fa-list-ol"></i> {{ $r['detail_count'] }} Baris
                                </span>
                                <small class="d-block text-muted mt-1 font-mono text-truncate" style="font-size: 0.65rem; max-width: 120px;" title="{{ implode(', ', $r['detail_models']) }}">
                                    {{ implode(', ', $r['detail_models']) }}
                                </small>
                            @else
                                <span class="rel-pill rel-pill-no">
                                    <i class="fas fa-times-circle"></i> 0 Baris
                                </span>
                            @endif
                        </td>

                        <!-- Add Relasi -->
                        <td class="text-center">
                            @if($r['has_add_support'])
                                @if($r['has_add'])
                                    <span class="rel-pill rel-pill-yes" title="Tabel: {{ $r['add_table'] }}">
                                        <i class="fas fa-check-circle"></i> Ada
                                    </span>
                                    <small class="d-block text-muted mt-1 font-mono" style="font-size: 0.65rem;">{{ $r['add_model'] }}</small>
                                @else
                                    <span class="rel-pill rel-pill-no">
                                        <i class="fas fa-minus-circle"></i> Kosong
                                    </span>
                                @endif
                            @else
                                <span class="rel-pill rel-pill-no text-muted" style="font-size: 0.65rem;">
                                    - N/A -
                                </span>
                            @endif
                        </td>

                        <!-- Aksi Super Admin -->
                        <td class="text-center">
                            <div class="d-flex justify-content-center align-items-center gap-1">
                                <!-- Inspect View -->
                                <button type="button" class="btn-action-icon btn-action-inspect" onclick="openInspectModal('{{ $c->id }}', 'inspect')" title="Lihat Data Join (Inspect)">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <!-- Edit Modal -->
                                <button type="button" class="btn-action-icon btn-action-edit" onclick="openInspectModal('{{ $c->id }}', 'edit')" title="Edit Data Ini (Quick Edit)">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <!-- Full Show Page -->
                                <a href="{{ route('control-data.show', $c->id) }}" class="btn-action-icon btn-action-open" title="Buka Halaman Lengkap">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                                <!-- Raw JSON Export -->
                                <a href="{{ route('control-data.export-json', $c->id) }}" class="btn-action-icon btn-action-json" title="Unduh JSON Joined Data">
                                    <i class="fas fa-code"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="11" class="text-center py-5 text-muted">
                            <div class="py-4">
                                <i class="fas fa-folder-open fa-3x text-muted mb-3 opacity-50"></i>
                                <h6 class="text-dark font-weight-bold">Tidak Ada Data Kalibrasi Ditemukan</h6>
                                <p class="text-muted small mb-0">Coba ubah kriteria pencarian atau klik tombol Reset Filter.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Single Clean Unified Pagination Bar -->
        <div class="px-3 py-3 border-top bg-white d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div class="text-muted small">
                Menampilkan <strong>{{ $calibrations->firstItem() ?? 0 }}</strong> – <strong>{{ $calibrations->lastItem() ?? 0 }}</strong> dari <strong>{{ number_format($calibrations->total()) }}</strong> data
                @if($calibrations->hasPages())
                <span class="text-muted font-italic ml-1">(Halaman {{ $calibrations->currentPage() }} dari {{ $calibrations->lastPage() }})</span>
                @endif
            </div>
            @if($calibrations->hasPages())
            <nav aria-label="Navigasi Halaman" class="m-0">
                {{ $calibrations->onEachSide(1)->appends(request()->query())->links('pagination::bootstrap-4') }}
            </nav>
            @endif
        </div>
    </div>
</div>

<!-- ======================================================= -->
<!-- MODAL CONTROL DATA: INSPECT & UPDATE (JOIN DATA)       -->
<!-- ======================================================= -->
<div class="modal fade" id="modalControlData" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-xl modal-xl-custom modal-dialog-scrollable" role="document">
        <div class="modal-content modal-content-modern">
            
            <!-- Modal Header -->
            <div class="modal-header-modern d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div class="mr-3" style="background: rgba(255, 255, 255, 0.2); width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #ffffff; font-size: 20px;">
                        <i class="fas fa-sliders-h"></i>
                    </div>
                    <div>
                        <div class="d-flex align-items-center gap-2">
                            <h5 class="modal-title font-weight-bold mb-0 text-white" id="modalCdTitle">Control Data: -</h5>
                            <span class="badge badge-warning text-dark ml-2 px-2 py-1 font-weight-bold" style="font-size: 0.70rem;">SUPER ADMIN</span>
                            <span id="modalCdModeBadge" class="badge badge-info px-2 py-1 font-weight-bold ml-1" style="font-size: 0.70rem;">MODE INSPECT</span>
                        </div>
                        <small class="text-white-50" id="modalCdSubtitle">Tabel Calibrations di-join dengan Head, Detail, dan Add</small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <button type="button" class="btn btn-sm btn-outline-light mr-2" id="btnToggleMode" onclick="toggleEditInspectMode()" style="border-radius: 20px;">
                        <i class="fas fa-edit mr-1"></i> Beralih ke Mode Edit
                    </button>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: 0.9;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-0">
                <!-- Loading State -->
                <div id="modalCdLoading" class="text-center py-5">
                    <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <p class="mt-3 text-muted font-weight-bold">Memuat data join dari server...</p>
                </div>

                <!-- Main Content -->
                <div id="modalCdContent" style="display: none;">
                    
                    <!-- Modern Nav Tabs -->
                    <ul class="nav modal-tabs-modern" id="modalCdTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-cd-overview-link" data-toggle="tab" href="#tab-cd-overview" role="tab">
                                <i class="fas fa-info-circle mr-1 text-primary"></i> Ringkasan & Relasi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-cd-edit-link" data-toggle="tab" href="#tab-cd-edit" role="tab">
                                <i class="fas fa-edit mr-1 text-warning"></i> Form Edit Data
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-cd-detail-link" data-toggle="tab" href="#tab-cd-detail" role="tab">
                                <i class="fas fa-list-ol mr-1 text-info"></i> Data Detail (Pengukuran)
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-cd-raw-cal-link" data-toggle="tab" href="#tab-cd-raw-cal" role="tab">
                                <i class="fas fa-table mr-1 text-secondary"></i> Raw Calibrations
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-cd-json-link" data-toggle="tab" href="#tab-cd-json" role="tab">
                                <i class="fas fa-code mr-1 text-danger"></i> Raw JSON
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content p-4" id="modalCdTabContent">
                        
                        <!-- TAB 1: OVERVIEW & STATUS JOIN -->
                        <div class="tab-pane fade show active" id="tab-cd-overview" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <div class="card h-100 border rounded-lg shadow-sm">
                                        <div class="card-header bg-light font-weight-bold py-2 d-flex justify-content-between align-items-center">
                                            <span><i class="fas fa-info-circle mr-1 text-primary"></i> Identitas Transaksi Kalibrasi</span>
                                            <span class="badge badge-primary font-mono" id="ovId">-</span>
                                        </div>
                                        <div class="card-body p-3">
                                            <table class="table table-sm table-borderless mb-0">
                                                <tr><td width="150" class="text-muted">Nama Alat:</td><td><strong id="ovNamaAlat">-</strong></td></tr>
                                                <tr><td class="text-muted">Form Type:</td><td><span id="ovFormType" class="badge badge-dark font-mono">-</span></td></tr>
                                                <tr><td class="text-muted">Customer / Pemilik:</td><td><strong id="ovCustomer">-</strong></td></tr>
                                                <tr><td class="text-muted">Merek / Brand:</td><td id="ovBrand">-</td></tr>
                                                <tr><td class="text-muted">No Seri:</td><td id="ovNoSeri" class="font-mono">-</td></tr>
                                                <tr><td class="text-muted">Kode Alat:</td><td id="ovKodeAlat" class="font-mono">-</td></tr>
                                                <tr><td class="text-muted">No PO:</td><td id="ovNoPo" class="font-mono">-</td></tr>
                                                <tr><td class="text-muted">Tgl Kalibrasi:</td><td id="ovTanggal">-</td></tr>
                                                <tr><td class="text-muted">Status:</td><td><span id="ovStatus" class="badge badge-primary">-</span></td></tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <div class="card h-100 border rounded-lg shadow-sm">
                                        <div class="card-header bg-light font-weight-bold py-2 d-flex justify-content-between align-items-center">
                                            <span><i class="fas fa-project-diagram mr-1 text-success"></i> Status Join Tabel (Relasi)</span>
                                            <span class="badge badge-secondary">Join on calibration_id</span>
                                        </div>
                                        <div class="card-body p-3">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered mb-0">
                                                    <thead class="bg-light">
                                                        <tr>
                                                            <th>Komponen</th>
                                                            <th>Model Class</th>
                                                            <th>Data Ter-Join</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><strong class="text-success"><i class="fas fa-heading mr-1"></i> Head</strong></td>
                                                            <td id="ovHeadModel" class="font-mono small">-</td>
                                                            <td id="ovHeadStatus">-</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong class="text-primary"><i class="fas fa-list-ol mr-1"></i> Detail</strong></td>
                                                            <td id="ovDetailModel" class="font-mono small">-</td>
                                                            <td id="ovDetailStatus">-</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong class="text-warning"><i class="fas fa-puzzle-piece mr-1"></i> Add</strong></td>
                                                            <td id="ovAddModel" class="font-mono small">-</td>
                                                            <td id="ovAddStatus">-</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong class="text-secondary"><i class="fas fa-layer-group mr-1"></i> Subforms</strong></td>
                                                            <td id="ovSubformsList" class="small">-</td>
                                                            <td id="ovSubformsStatus">-</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="mt-3 text-right">
                                                <button type="button" class="btn btn-primary btn-sm px-3 font-weight-bold" onclick="switchToEditTab()" style="border-radius: 8px;">
                                                    <i class="fas fa-edit mr-1"></i> Buka Editor & Update Data
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 2: FORM EDIT DATA (BISA UNTUK UPDATE DATA) -->
                        <div class="tab-pane fade" id="tab-cd-edit" role="tabpanel">
                            <form id="formUpdateControlData" onsubmit="submitUpdateControlData(event)">
                                <div class="d-flex justify-content-between align-items-center mb-3 p-3 bg-light rounded-lg border">
                                    <div>
                                        <h6 class="font-weight-bold text-dark mb-0">
                                            <i class="fas fa-edit text-warning mr-1"></i> Formulir Perubahan Data (Super Admin)
                                        </h6>
                                        <small class="text-muted">Ubah field di bawah ini dan klik Simpan. Sistem akan mengupdate tabel calibrations, head, detail, atau add secara terpadu.</small>
                                    </div>
                                    <button type="submit" class="btn btn-success font-weight-bold px-4" style="border-radius: 8px;">
                                        <i class="fas fa-save mr-1"></i> Simpan Perubahan
                                    </button>
                                </div>

                                <!-- 1. Identitas & Spesifikasi Alat (Calibrations) -->
                                <div class="card mb-3 border rounded-lg">
                                    <div class="card-header bg-white py-2 font-weight-bold text-primary">
                                        <i class="fas fa-tools mr-1"></i> 1. Identitas & Spesifikasi Alat (Tabel Calibrations)
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="form-row">
                                            <div class="col-md-4 mb-2">
                                                <label class="form-group-label">Nama Alat</label>
                                                <input type="text" name="calibration[namaAlat]" id="edtNamaAlat" class="form-control form-control-sm form-control-custom">
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label class="form-group-label">Merek / Brand</label>
                                                <input type="text" name="calibration[brandAlat]" id="edtBrandAlat" class="form-control form-control-sm form-control-custom">
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label class="form-group-label">Tipe Alat</label>
                                                <input type="text" name="calibration[typeAlat]" id="edtTypeAlat" class="form-control form-control-sm form-control-custom">
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <label class="form-group-label">Nomor Seri</label>
                                                <input type="text" name="calibration[NoSeri]" id="edtNoSeri" class="form-control form-control-sm form-control-custom font-mono">
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <label class="form-group-label">Kode Alat</label>
                                                <input type="text" name="calibration[kodeAlat]" id="edtKodeAlat" class="form-control form-control-sm form-control-custom font-mono">
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <label class="form-group-label">ID Alat</label>
                                                <input type="text" name="calibration[id_alat]" id="edtIdAlat" class="form-control form-control-sm form-control-custom font-mono">
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <label class="form-group-label">Kapasitas</label>
                                                <input type="text" name="calibration[kapasitas]" id="edtKapasitas" class="form-control form-control-sm form-control-custom">
                                            </div>
                                            <div class="col-md-2 mb-2">
                                                <label class="form-group-label">Capacity (Alt)</label>
                                                <input type="text" name="calibration[capacity]" id="edtCapacity" class="form-control form-control-sm form-control-custom">
                                            </div>
                                            <div class="col-md-2 mb-2">
                                                <label class="form-group-label">Resolusi</label>
                                                <input type="text" name="calibration[resolusi]" id="edtResolusi" class="form-control form-control-sm form-control-custom">
                                            </div>
                                            <div class="col-md-2 mb-2">
                                                <label class="form-group-label">Skala</label>
                                                <input type="text" name="calibration[skala]" id="edtSkala" class="form-control form-control-sm form-control-custom">
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <label class="form-group-label">Range Min</label>
                                                <input type="text" name="calibration[rangeMin]" id="edtRangeMin" class="form-control form-control-sm form-control-custom font-mono">
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <label class="form-group-label">Range Max</label>
                                                <input type="text" name="calibration[rangeMax]" id="edtRangeMax" class="form-control form-control-sm form-control-custom font-mono">
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <label class="form-group-label">Jenis Pembacaan</label>
                                                <input type="text" name="calibration[jenisPembacaan]" id="edtJenisPembacaan" class="form-control form-control-sm form-control-custom" placeholder="Manual, Digital, Dial, dsb.">
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <label class="form-group-label">Kondisi Alat</label>
                                                <input type="text" name="calibration[kondisiAlat]" id="edtKondisiAlat" class="form-control form-control-sm form-control-custom" placeholder="Baik, Normal, dsb.">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 2. Customer, Order & Dokumen (Calibrations) -->
                                <div class="card mb-3 border rounded-lg">
                                    <div class="card-header bg-white py-2 font-weight-bold text-info">
                                        <i class="fas fa-file-invoice mr-1"></i> 2. Customer, Order & Dokumen (Tabel Calibrations)
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="form-row">
                                            <div class="col-md-4 mb-2">
                                                <label class="form-group-label">Pemilik Alat (Customer)</label>
                                                <input type="text" name="calibration[pemilikAlat]" id="edtPemilikAlat" class="form-control form-control-sm form-control-custom">
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <label class="form-group-label">Nomor PO (Purchase Order)</label>
                                                <input type="text" name="calibration[no_po]" id="edtNoPo" class="form-control form-control-sm form-control-custom font-mono">
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <label class="form-group-label">Nomor Label</label>
                                                <input type="text" name="calibration[no_label]" id="edtNoLabel" class="form-control form-control-sm form-control-custom font-mono">
                                            </div>
                                            <div class="col-md-2 mb-2">
                                                <label class="form-group-label">No. LK (Lembar Kerja)</label>
                                                <input type="text" name="calibration[LK]" id="edtLk" class="form-control form-control-sm form-control-custom font-mono">
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label class="form-group-label">Form Type</label>
                                                <input type="text" name="calibration[form_type]" id="edtFormType" class="form-control form-control-sm form-control-custom font-mono">
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label class="form-group-label">Jumlah Form</label>
                                                <input type="number" name="calibration[jumlah_form]" id="edtJumlahForm" class="form-control form-control-sm form-control-custom font-mono">
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label class="form-group-label">NIK Petugas</label>
                                                <input type="text" name="calibration[NIK]" id="edtNik" class="form-control form-control-sm form-control-custom font-mono">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 3. Jadwal, Tanggal & Lokasi (Calibrations) -->
                                <div class="card mb-3 border rounded-lg">
                                    <div class="card-header bg-white py-2 font-weight-bold text-secondary">
                                        <i class="fas fa-calendar-alt mr-1"></i> 3. Jadwal, Tanggal & Lokasi (Tabel Calibrations)
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="form-row">
                                            <div class="col-md-4 mb-2">
                                                <label class="form-group-label">Tanggal Masuk</label>
                                                <input type="date" name="calibration[tanggalMasuk]" id="edtTanggalMasuk" class="form-control form-control-sm form-control-custom">
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label class="form-group-label">Tanggal Kalibrasi</label>
                                                <input type="date" name="calibration[tanggalKalibrasi]" id="edtTanggalKalibrasi" class="form-control form-control-sm form-control-custom">
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label class="form-group-label">Next Tanggal Kalibrasi (Due)</label>
                                                <input type="date" name="calibration[NextTanggalKalibrasi]" id="edtNextTanggalKalibrasi" class="form-control form-control-sm form-control-custom">
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label class="form-group-label">Tempat Kalibrasi</label>
                                                <input type="text" name="calibration[tempatKalibrasi]" id="edtTempatKalibrasi" class="form-control form-control-sm form-control-custom" placeholder="In-Lab / On-Site">
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label class="form-group-label">Lokasi PT</label>
                                                <input type="text" name="calibration[lokasiPT]" id="edtLokasiPt" class="form-control form-control-sm form-control-custom">
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label class="form-group-label">Location Data</label>
                                                <input type="text" name="calibration[location_data]" id="edtLocationData" class="form-control form-control-sm form-control-custom font-mono">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 4. Kondisi Lingkungan Suhu (RT) & Kelembaban (RH) (Calibrations) -->
                                <div class="card mb-3 border rounded-lg">
                                    <div class="card-header bg-white py-2 font-weight-bold text-danger">
                                        <i class="fas fa-thermometer-half mr-1"></i> 4. Kondisi Lingkungan Suhu (RT) & Kelembaban (RH) (Tabel Calibrations)
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="form-row">
                                            <div class="col-md-2 mb-2">
                                                <label class="form-group-label">Suhu Awal (RT 1) °C</label>
                                                <input type="text" name="calibration[RT_condition1]" id="edtRt1" class="form-control form-control-sm form-control-custom font-mono text-center">
                                            </div>
                                            <div class="col-md-2 mb-2">
                                                <label class="form-group-label">Suhu Tengah (RT 2) °C</label>
                                                <input type="text" name="calibration[RT_condition2]" id="edtRt2" class="form-control form-control-sm form-control-custom font-mono text-center">
                                            </div>
                                            <div class="col-md-2 mb-2">
                                                <label class="form-group-label">Suhu Akhir (RT 3) °C</label>
                                                <input type="text" name="calibration[RT_condition3]" id="edtRt3" class="form-control form-control-sm form-control-custom font-mono text-center">
                                            </div>
                                            <div class="col-md-2 mb-2">
                                                <label class="form-group-label">Kelembaban 1 (RH 1) %</label>
                                                <input type="text" name="calibration[RH_condition1]" id="edtRh1" class="form-control form-control-sm form-control-custom font-mono text-center">
                                            </div>
                                            <div class="col-md-2 mb-2">
                                                <label class="form-group-label">Kelembaban 2 (RH 2) %</label>
                                                <input type="text" name="calibration[RH_condition2]" id="edtRh2" class="form-control form-control-sm form-control-custom font-mono text-center">
                                            </div>
                                            <div class="col-md-2 mb-2">
                                                <label class="form-group-label">Kelembaban 3 (RH 3) %</label>
                                                <input type="text" name="calibration[RH_condition3]" id="edtRh3" class="form-control form-control-sm form-control-custom font-mono text-center">
                                            </div>
                                            <div class="col-md-12 mb-2">
                                                <label class="form-group-label">Kode Thermo-Hygrometer (Standar Lingkungan)</label>
                                                <input type="text" name="calibration[kode_th]" id="edtKodeTh" class="form-control form-control-sm form-control-custom font-mono" placeholder="Kode Alat Thermo-Hygrometer">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 5. Status, Verifikasi, Approval & Petugas (Calibrations) -->
                                <div class="card mb-3 border rounded-lg">
                                    <div class="card-header bg-white py-2 font-weight-bold text-success">
                                        <i class="fas fa-check-double mr-1"></i> 5. Status, Verifikasi, Approval & Petugas (Tabel Calibrations)
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="form-row">
                                            <div class="col-md-3 mb-2">
                                                <label class="form-group-label">Status Kalibrasi</label>
                                                <select name="calibration[status]" id="edtStatus" class="form-control form-control-sm form-control-custom font-weight-bold">
                                                    <option value="draft">DRAFT</option>
                                                    <option value="waiting_verification">WAITING VERIFICATION</option>
                                                    <option value="waiting_approval">WAITING APPROVAL</option>
                                                    <option value="verified">VERIFIED</option>
                                                    <option value="approved">APPROVED</option>
                                                    <option value="completed">COMPLETED</option>
                                                    <option value="rejected">REJECTED</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <label class="form-group-label">Calibrated By</label>
                                                <input type="text" name="calibration[calibratedBy]" id="edtCalibratedBy" class="form-control form-control-sm form-control-custom">
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <label class="form-group-label">Tanggal Calibrated</label>
                                                <input type="date" name="calibration[calibrated]" id="edtCalibratedDate" class="form-control form-control-sm form-control-custom">
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <label class="form-group-label">Verified By</label>
                                                <input type="text" name="calibration[verifiedBy]" id="edtVerifiedBy" class="form-control form-control-sm form-control-custom">
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <label class="form-group-label">Tanggal Verified</label>
                                                <input type="date" name="calibration[verified]" id="edtVerifiedDate" class="form-control form-control-sm form-control-custom">
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <label class="form-group-label">Approved By</label>
                                                <input type="text" name="calibration[approvedBy]" id="edtApprovedBy" class="form-control form-control-sm form-control-custom">
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <label class="form-group-label">Tanggal Approved</label>
                                                <input type="date" name="calibration[approved]" id="edtApprovedDate" class="form-control form-control-sm form-control-custom">
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <label class="form-group-label">Type (Alt)</label>
                                                <input type="text" name="calibration[type]" id="edtTypeAlt" class="form-control form-control-sm form-control-custom">
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <label class="form-group-label">Reason (Alasan Reject / Revisi / Catatan)</label>
                                                <textarea name="calibration[reason]" id="edtReason" class="form-control form-control-sm form-control-custom" rows="2"></textarea>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <label class="form-group-label">Keterangan Tambahan</label>
                                                <textarea name="calibration[keterangan]" id="edtKeterangan" class="form-control form-control-sm form-control-custom" rows="2"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 6. Metadata JSON & Form Tambahan (Calibrations) -->
                                <div class="card mb-3 border rounded-lg">
                                    <div class="card-header bg-white py-2 font-weight-bold text-dark">
                                        <i class="fas fa-layer-group mr-1"></i> 6. Metadata Subform & Transaksi (Tabel Calibrations)
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="form-row">
                                            <div class="col-md-4 mb-2">
                                                <label class="form-group-label">Additional Forms (JSON)</label>
                                                <textarea name="calibration[additional_forms]" id="edtAdditionalForms" class="form-control form-control-sm form-control-custom font-mono" rows="2"></textarea>
                                                <small class="text-muted">Contoh: <code>["caliper_tambahan"]</code></small>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label class="form-group-label">Subform Identities (JSON)</label>
                                                <textarea name="calibration[subform_identities]" id="edtSubformIdentities" class="form-control form-control-sm form-control-custom font-mono" rows="2"></textarea>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label class="form-group-label">Status Transaction (JSON)</label>
                                                <textarea name="calibration[status_transaction]" id="edtStatusTransaction" class="form-control form-control-sm form-control-custom font-mono" rows="2"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 7. Kolom Lainnya Tabel Calibrations (Dinamis dari Database) -->
                                <div class="card mb-3 border rounded-lg" id="edtCalOtherCardWrapper">
                                    <div class="card-header bg-white py-2 font-weight-bold text-secondary d-flex justify-content-between align-items-center">
                                        <span><i class="fas fa-database mr-1"></i> 7. Kolom Database Lainnya (Tabel Calibrations)</span>
                                        <span class="badge badge-secondary" id="edtCalOtherCountBadge">0 Kolom Tambahan</span>
                                    </div>
                                    <div class="card-body p-3" id="edtCalOtherContainer">
                                        <p class="text-muted small mb-0">Tidak ada kolom tambahan yang belum tercakup.</p>
                                    </div>
                                </div>

                                <!-- Section Data Head -->
                                <div class="card mb-3 border rounded-lg">
                                    <div class="card-header bg-white py-2 font-weight-bold text-success d-flex justify-content-between align-items-center">
                                        <span><i class="fas fa-heading mr-1"></i> 8. Data Tabel Head</span>
                                        <span class="badge badge-success font-mono" id="edtHeadModelLabel">-</span>
                                    </div>
                                    <div class="card-body p-3" id="edtHeadContainer">
                                        <p class="text-muted small mb-0">Tidak ada data head yang bisa diedit.</p>
                                    </div>
                                </div>

                                <!-- Section Data Detail Pengukuran (Editable Grid) -->
                                <div class="card mb-3 border rounded-lg" id="edtDetailCardWrapper">
                                    <div class="card-header bg-white py-2 font-weight-bold text-primary d-flex justify-content-between align-items-center">
                                        <span><i class="fas fa-list-ol mr-1"></i> 9. Data Tabel Detail Pengukuran (Editable Grid)</span>
                                        <span class="badge badge-primary font-mono" id="edtDetailModelLabel">-</span>
                                    </div>
                                    <div class="card-body p-3">
                                        <p class="text-muted small mb-2"><i class="fas fa-info-circle mr-1 text-primary"></i> Anda dapat mengubah nilai titik ukur, pembacaan, dan kolom pengukuran secara langsung di dalam kotak input tabel di bawah ini:</p>
                                        <div id="edtDetailContainer">
                                            <p class="text-muted small mb-0">Tidak ada data detail pengukuran untuk kalibrasi ini.</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Section Data Add -->
                                <div class="card mb-3 border rounded-lg" id="edtAddCardWrapper">
                                    <div class="card-header bg-white py-2 font-weight-bold text-warning d-flex justify-content-between align-items-center">
                                        <span><i class="fas fa-puzzle-piece mr-1"></i> 10. Data Tabel Add</span>
                                        <span class="badge badge-warning font-mono" id="edtAddModelLabel">-</span>
                                    </div>
                                    <div class="card-body p-3" id="edtAddContainer">
                                        <p class="text-muted small mb-0">Tidak ada data add untuk jenis alat ini.</p>
                                    </div>
                                </div>

                                <div class="text-right mt-3 mb-2">
                                    <button type="submit" class="btn btn-success font-weight-bold px-4 py-2" style="border-radius: 8px;">
                                        <i class="fas fa-save mr-1"></i> Simpan Semua Perubahan Data
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- TAB 3: DATA DETAIL PENGUKURAN (TABLE VIEW) -->
                        <div class="tab-pane fade" id="tab-cd-detail" role="tabpanel">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h6 class="font-weight-bold text-primary mb-0">
                                        <i class="fas fa-list-ol mr-1"></i> Baris Data Detail Pengukuran (Joined Table)
                                    </h6>
                                    <small class="text-muted">Tabel detail pengukuran yang tersambung via <code>calibration_id</code>.</small>
                                </div>
                                <span class="badge badge-info font-mono" id="detBadgeTotalRows">0 Baris</span>
                            </div>
                            <div id="modalDetailTableContainer"></div>
                        </div>

                        <!-- TAB 4: RAW CALIBRATIONS ATTRIBUTES -->
                        <div class="tab-pane fade" id="tab-cd-raw-cal" role="tabpanel">
                            <h6 class="font-weight-bold text-secondary mb-3">
                                <i class="fas fa-table mr-1"></i> Semua Kolom Tabel <code>calibrations</code>
                            </h6>
                            <div class="table-responsive" style="max-height: 480px;">
                                <table class="table table-sm table-bordered table-striped" id="tblModalRawCal">
                                    <thead class="bg-light">
                                        <tr><th width="240">Field Database</th><th>Nilai Tersimpan</th></tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>

                        <!-- TAB 5: RAW JSON -->
                        <div class="tab-pane fade" id="tab-cd-json" role="tabpanel">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="font-weight-bold text-danger mb-0">Payload JSON Data Join Lengkap</h6>
                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="copyModalRawJson()">
                                    <i class="fas fa-copy mr-1"></i> Salin JSON
                                </button>
                            </div>
                            <pre class="raw-json-box mb-0" id="modalRawJsonBox"></pre>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer bg-light py-2 d-flex justify-content-between">
                <div>
                    <a href="#" id="modalBtnFullShow" class="btn btn-outline-info btn-sm mr-2" style="border-radius: 6px;">
                        <i class="fas fa-external-link-alt mr-1"></i> Buka Halaman Penuh
                    </a>
                    <a href="#" id="modalBtnExportJson" class="btn btn-outline-secondary btn-sm" style="border-radius: 6px;">
                        <i class="fas fa-download mr-1"></i> Unduh JSON
                    </a>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <button type="button" class="btn btn-secondary btn-sm px-3" data-dismiss="modal" style="border-radius: 6px;">Tutup</button>
                    <button type="button" class="btn btn-success btn-sm px-4 font-weight-bold" onclick="document.getElementById('formUpdateControlData').dispatchEvent(new Event('submit'))" style="border-radius: 6px;">
                        <i class="fas fa-save mr-1"></i> Simpan
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<!-- DataTables JS & Bootstrap 4 integration -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    let activeCalibrationId = null;
    let activeLoadedData = null;
    let isEditMode = false;
    let controlDataTable = null;

    $(document).ready(function() {
        // Toggle chevron on filter collapse
        $('#filterBodyArea').on('show.bs.collapse', function () {
            $('#filterChevronIcon').removeClass('fa-chevron-up').addClass('fa-chevron-down');
        }).on('hide.bs.collapse', function () {
            $('#filterChevronIcon').removeClass('fa-chevron-down').addClass('fa-chevron-up');
        });

        // Initialize DataTable (Paging handled cleanly by Server Pagination)
        if ($('#controlDataTable tbody tr').length > 0 && !$('#controlDataTable tbody tr td[colspan]').length) {
            controlDataTable = $('#controlDataTable').DataTable({
                responsive: false,
                scrollX: true,
                autoWidth: false,
                paging: false,       // Matikan pagination internal DataTables agar tidak ada Previous/Next dobel
                info: false,         // Matikan info internal DataTables
                searching: true,     // Tetap aktifkan fitur search instan
                ordering: true,      // Tetap aktifkan sorting kolom
                order: [],           // Pertahankan urutan dari server
                columnDefs: [
                    { orderable: false, targets: [0, 10] }, // No & Aksi non-orderable
                    { className: "text-center align-middle", targets: [0, 6, 7, 8, 9, 10] },
                    { className: "align-middle", targets: [1, 2, 3, 4, 5] }
                ],
                language: {
                    zeroRecords: "Tidak ditemukan data yang sesuai dengan pencarian",
                    emptyTable: "Belum ada data kalibrasi untuk ditampilkan"
                },
                dom: 'rt' // Render hanya tabel; search input diintegrasikan rapi ke header
            });

            // Pasang search bar instan ke header toolbar
            const searchHtml = `
                <div class="input-group input-group-sm" style="width: 270px;">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-white border-right-0 text-muted" style="border-radius: 8px 0 0 8px; border-color: #cbd5e1;">
                            <i class="fas fa-search text-primary"></i>
                        </span>
                    </div>
                    <input type="text" id="dtTableSearchInput" class="form-control border-left-0" placeholder="Cari instan di tabel..." style="border-radius: 0 8px 8px 0; border-color: #cbd5e1; font-size: 0.83rem; background: #fafbfc;">
                </div>
            `;
            $('#tableInstantSearchWrapper').html(searchHtml);
            $('#dtTableSearchInput').on('keyup', function() {
                controlDataTable.search(this.value).draw();
            });
        }
    });

    // Salin teks ke clipboard dengan notifikasi toast
    function copyText(text) {
        if (!navigator.clipboard) {
            const el = document.createElement('textarea');
            el.value = text;
            document.body.appendChild(el);
            el.select();
            document.execCommand('copy');
            document.body.removeChild(el);
        } else {
            navigator.clipboard.writeText(text);
        }

        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: 'Tersalin: ' + text,
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true
        });
    }

    function openInspectModal(id, mode = 'inspect') {
        activeCalibrationId = id;
        $('#modalControlData').modal('show');
        $('#modalCdLoading').show();
        $('#modalCdContent').hide();
        $('#modalCdTitle').text('Control Data: ' + id);

        const showUrl = '{{ url("master-data/control-data") }}/' + id;
        const exportUrl = '{{ url("master-data/control-data") }}/' + id + '/export-json';
        $('#modalBtnFullShow').attr('href', showUrl);
        $('#modalBtnExportJson').attr('href', exportUrl);

        if (mode === 'edit') {
            setMode(true);
        } else {
            setMode(false);
        }

        // Fetch Data via AJAX
        $.ajax({
            url: '{{ url("master-data/control-data") }}/' + id + '/ajax',
            type: 'GET',
            success: function(res) {
                if (res.success) {
                    activeLoadedData = res;
                    populateModalData(res.calibration, res.joined_data);
                    $('#modalCdLoading').hide();
                    $('#modalCdContent').show();

                    if (mode === 'edit') {
                        $('#tab-cd-edit-link').tab('show');
                    } else {
                        $('#tab-cd-overview-link').tab('show');
                    }
                } else {
                    Swal.fire('Error', res.message || 'Gagal memuat data', 'error');
                    $('#modalControlData').modal('hide');
                }
            },
            error: function(xhr, status, error) {
                Swal.fire('Error', 'Terjadi kesalahan AJAX: ' + error, 'error');
                $('#modalControlData').modal('hide');
            }
        });
    }

    function toggleEditInspectMode() {
        setMode(!isEditMode);
        if (isEditMode) {
            $('#tab-cd-edit-link').tab('show');
        } else {
            $('#tab-cd-overview-link').tab('show');
        }
    }

    function switchToEditTab() {
        setMode(true);
        $('#tab-cd-edit-link').tab('show');
    }

    function setMode(edit) {
        isEditMode = edit;
        if (isEditMode) {
            $('#modalCdModeBadge').removeClass('badge-info').addClass('badge-warning').text('MODE EDIT AKTIF');
            $('#btnToggleMode').html('<i class="fas fa-eye mr-1"></i> Beralih ke Mode Inspect');
        } else {
            $('#modalCdModeBadge').removeClass('badge-warning').addClass('badge-info').text('MODE INSPECT');
            $('#btnToggleMode').html('<i class="fas fa-edit mr-1"></i> Beralih ke Mode Edit');
        }
    }

    function populateModalData(cal, joined) {
        // 1. Overview Tab
        $('#ovId').text(cal.id);
        $('#ovNamaAlat').text(cal.namaAlat || '-');
        $('#ovFormType').text(joined.form_type || '-');
        $('#ovCustomer').text(cal.pemilikAlat || '-');
        $('#ovBrand').text(cal.brandAlat || '-');
        $('#ovNoSeri').text(cal.NoSeri || '-');
        $('#ovKodeAlat').text(cal.kodeAlat || '-');
        $('#ovNoPo').text(cal.no_po || '-');
        $('#ovTanggal').text(cal.tanggalKalibrasi ? cal.tanggalKalibrasi.substring(0, 10) : '-');
        $('#ovStatus').text((cal.status || 'DRAFT').toUpperCase());

        // Head Join Status
        $('#ovHeadModel').text(joined.models.head || '-');
        const headCount = joined.head ? joined.head.length : 0;
        $('#ovHeadStatus').html(headCount > 0 
            ? '<span class="badge badge-success px-2 py-1"><i class="fas fa-check mr-1"></i> Ter-Join (' + headCount + ' Record)</span>' 
            : '<span class="badge badge-secondary px-2 py-1">Kosong</span>');

        // Detail Join Status
        $('#ovDetailModel').text(joined.models.detail ? joined.models.detail.join(', ') : '-');
        let detailCount = 0;
        if (joined.detail) {
            Object.values(joined.detail).forEach(rows => detailCount += rows.length);
        }
        $('#ovDetailStatus').html(detailCount > 0 
            ? '<span class="badge badge-primary px-2 py-1"><i class="fas fa-list-ol mr-1"></i> Ter-Join (' + detailCount + ' Baris)</span>' 
            : '<span class="badge badge-secondary px-2 py-1">0 Baris</span>');

        // Add Join Status
        $('#ovAddModel').text(joined.models.add || '-');
        const addCount = joined.add ? joined.add.length : 0;
        if (joined.models.add) {
            $('#ovAddStatus').html(addCount > 0 
                ? '<span class="badge badge-warning px-2 py-1"><i class="fas fa-check mr-1"></i> Ter-Join (' + addCount + ' Record)</span>' 
                : '<span class="badge badge-secondary px-2 py-1">Kosong</span>');
        } else {
            $('#ovAddStatus').html('<span class="badge badge-light border text-muted">N/A (Tidak Ada Tabel Add)</span>');
        }

        // Subforms Status
        const subKeys = joined.subforms ? Object.keys(joined.subforms) : [];
        $('#ovSubformsList').text(subKeys.length > 0 ? subKeys.join(', ') : '-');
        $('#ovSubformsStatus').html(subKeys.length > 0 
            ? '<span class="badge badge-info px-2 py-1">' + subKeys.length + ' Subform</span>' 
            : '<span class="badge badge-light border text-muted">Tidak Ada</span>');

        // 2. Populate Form Edit Fields (Tabel Calibrations)
        $('#edtNamaAlat').val(cal.namaAlat || '');
        $('#edtBrandAlat').val(cal.brandAlat || '');
        $('#edtTypeAlat').val(cal.typeAlat || '');
        $('#edtNoSeri').val(cal.NoSeri || '');
        $('#edtKodeAlat').val(cal.kodeAlat || '');
        $('#edtIdAlat').val(cal.id_alat || '');
        $('#edtKapasitas').val(cal.kapasitas || '');
        $('#edtCapacity').val(cal.capacity || '');
        $('#edtResolusi').val(cal.resolusi || '');
        $('#edtSkala').val(cal.skala || '');
        $('#edtRangeMin').val(cal.rangeMin || '');
        $('#edtRangeMax').val(cal.rangeMax || '');
        $('#edtJenisPembacaan').val(cal.jenisPembacaan || '');
        $('#edtKondisiAlat').val(cal.kondisiAlat || '');

        // Section 2: Customer, Order & Dokumen
        $('#edtPemilikAlat').val(cal.pemilikAlat || '');
        $('#edtNoPo').val(cal.no_po || '');
        $('#edtNoLabel').val(cal.no_label || '');
        $('#edtLk').val(cal.LK || '');
        $('#edtFormType').val(cal.form_type || '');
        $('#edtJumlahForm').val(cal.jumlah_form || '');
        $('#edtNik').val(cal.NIK || '');

        // Section 3: Jadwal, Tanggal & Lokasi
        $('#edtTanggalMasuk').val(cal.tanggalMasuk ? cal.tanggalMasuk.substring(0, 10) : '');
        $('#edtTanggalKalibrasi').val(cal.tanggalKalibrasi ? cal.tanggalKalibrasi.substring(0, 10) : '');
        $('#edtNextTanggalKalibrasi').val(cal.NextTanggalKalibrasi ? cal.NextTanggalKalibrasi.substring(0, 10) : '');
        $('#edtTempatKalibrasi').val(cal.tempatKalibrasi || '');
        $('#edtLokasiPt').val(cal.lokasiPT || '');
        $('#edtLocationData').val(typeof cal.location_data === 'object' && cal.location_data !== null ? JSON.stringify(cal.location_data) : (cal.location_data || ''));

        // Section 4: Suhu RT & Kelembaban RH
        $('#edtRt1').val(cal.RT_condition1 || '');
        $('#edtRt2').val(cal.RT_condition2 || '');
        $('#edtRt3').val(cal.RT_condition3 || '');
        $('#edtRh1').val(cal.RH_condition1 || '');
        $('#edtRh2').val(cal.RH_condition2 || '');
        $('#edtRh3').val(cal.RH_condition3 || '');
        $('#edtKodeTh').val(cal.kode_th || '');

        // Section 5: Status, Verifikasi, Approval & Petugas
        $('#edtStatus').val(cal.status || 'draft');
        $('#edtCalibratedBy').val(cal.calibratedBy || '');
        $('#edtCalibratedDate').val(cal.calibrated ? cal.calibrated.substring(0, 10) : '');
        $('#edtVerifiedBy').val(cal.verifiedBy || '');
        $('#edtVerifiedDate').val(cal.verified ? cal.verified.substring(0, 10) : '');
        $('#edtApprovedBy').val(cal.approvedBy || '');
        $('#edtApprovedDate').val(cal.approved ? cal.approved.substring(0, 10) : '');
        $('#edtTypeAlt').val(cal.type || '');
        $('#edtReason').val(cal.reason || '');
        $('#edtKeterangan').val(cal.keterangan || '');

        // Section 6: JSON Subform & Transaksi
        $('#edtAdditionalForms').val(typeof cal.additional_forms === 'object' && cal.additional_forms !== null ? JSON.stringify(cal.additional_forms) : (cal.additional_forms || ''));
        $('#edtSubformIdentities').val(typeof cal.subform_identities === 'object' && cal.subform_identities !== null ? JSON.stringify(cal.subform_identities) : (cal.subform_identities || ''));
        $('#edtStatusTransaction').val(typeof cal.status_transaction === 'object' && cal.status_transaction !== null ? JSON.stringify(cal.status_transaction) : (cal.status_transaction || ''));

        // Section 7: Render Dinamis Kolom Tambahan Lainnya pada Tabel calibrations
        const handledCalCols = [
            'id', 'created_at', 'updated_at', 'deleted_at',
            'namaAlat', 'brandAlat', 'typeAlat', 'NoSeri', 'kodeAlat', 'id_alat',
            'kapasitas', 'capacity', 'resolusi', 'skala', 'rangeMin', 'rangeMax',
            'jenisPembacaan', 'kondisiAlat',
            'pemilikAlat', 'no_po', 'no_label', 'LK', 'form_type', 'jumlah_form', 'NIK',
            'tanggalMasuk', 'tanggalKalibrasi', 'NextTanggalKalibrasi', 'tempatKalibrasi', 'lokasiPT', 'location_data',
            'RT_condition1', 'RT_condition2', 'RT_condition3', 'RH_condition1', 'RH_condition2', 'RH_condition3', 'kode_th',
            'status', 'calibratedBy', 'calibrated', 'verifiedBy', 'verified', 'approvedBy', 'approved', 'type', 'reason', 'keterangan',
            'additional_forms', 'subform_identities', 'status_transaction'
        ];
        const $otherCalBox = $('#edtCalOtherContainer');
        $otherCalBox.empty();
        const otherCols = Object.keys(cal).filter(k => !handledCalCols.includes(k));
        $('#edtCalOtherCountBadge').text(otherCols.length + ' Kolom Tambahan');

        if (otherCols.length > 0) {
            let oHtml = '<div class="form-row">';
            otherCols.forEach(col => {
                let v = cal[col];
                if (typeof v === 'object' && v !== null) {
                    v = JSON.stringify(v);
                }
                oHtml += '<div class="col-md-3 mb-2">';
                oHtml += '<label class="form-group-label" style="font-size: 0.72rem;">' + col + '</label>';
                oHtml += '<input type="text" name="calibration[' + col + ']" value="' + (v !== null && v !== undefined ? v : '') + '" class="form-control form-control-sm form-control-custom">';
                oHtml += '</div>';
            });
            oHtml += '</div>';
            $otherCalBox.append(oHtml);
        } else {
            $otherCalBox.html('<div class="text-muted small py-2"><i class="fas fa-check-circle text-success mr-1"></i> Seluruh kolom tabel calibrations telah terpetakan pada section 1 s/d 6 di atas.</div>');
        }

        // Populate Form Edit: Head
        const $edtHeadBox = $('#edtHeadContainer');
        $edtHeadBox.empty();
        $('#edtHeadModelLabel').text(joined.models.head || 'Tidak Ada Model Head');
        if (headCount > 0) {
            joined.head.forEach((h, hIdx) => {
                let hHtml = '<div class="p-3 bg-light rounded mb-3 border">';
                hHtml += '<div class="d-flex justify-content-between mb-2"><strong class="small text-success">Record Head #' + (hIdx + 1) + (h.form_index ? ' (Form Index: ' + h.form_index + ')' : '') + '</strong><span class="badge badge-secondary font-mono">ID: ' + (h.id || '-') + '</span></div>';
                hHtml += '<input type="hidden" name="head[' + hIdx + '][id]" value="' + (h.id || '') + '">';
                hHtml += '<div class="form-row">';
                Object.keys(h).forEach(k => {
                    if (['id', 'calibration_id', 'created_at', 'updated_at', 'form_index'].includes(k)) return;
                    hHtml += '<div class="col-md-4 mb-2">';
                    hHtml += '<label class="form-group-label" style="font-size: 0.72rem;">' + k + '</label>';
                    hHtml += '<input type="text" name="head[' + hIdx + '][' + k + ']" value="' + (h[k] !== null && h[k] !== undefined ? h[k] : '') + '" class="form-control form-control-sm form-control-custom">';
                    hHtml += '</div>';
                });
                hHtml += '</div></div>';
                $edtHeadBox.append(hHtml);
            });
        } else {
            $edtHeadBox.html('<div class="text-muted small py-2"><i class="fas fa-info-circle mr-1"></i> Tidak ada data record head untuk kalibrasi ini.</div>');
        }

        // Populate Form Edit: Detail (Editable Grid)
        const $edtDetBox = $('#edtDetailContainer');
        $edtDetBox.empty();
        $('#edtDetailModelLabel').text((joined.models.detail ? joined.models.detail.join(', ') : 'Tidak Ada') + ' (' + detailCount + ' Baris)');
        if (detailCount > 0) {
            Object.keys(joined.detail).forEach(tblName => {
                const rows = joined.detail[tblName];
                if (rows.length === 0) return;
                const cols = Object.keys(rows[0]);
                const editableCols = cols.filter(c => !['id', 'calibration_id', 'created_at', 'updated_at', 'head_caliper_id'].includes(c));

                let dHtml = '<div class="border rounded p-2 mb-3 bg-light">';
                dHtml += '<div class="d-flex justify-content-between align-items-center mb-2 px-1"><strong class="text-primary small font-weight-bold"><i class="fas fa-table mr-1"></i> ' + tblName + ' (' + rows.length + ' Baris)</strong><span class="badge badge-secondary small font-mono">Tabel Detail</span></div>';
                dHtml += '<div class="table-responsive" style="max-height: 420px;"><table class="table table-sm table-bordered bg-white mb-0" style="font-size: 0.82rem;"><thead class="bg-light sticky-top"><tr><th width="35" class="text-center">#</th>';
                editableCols.forEach(c => dHtml += '<th class="small font-weight-bold text-nowrap text-center">' + c + '</th>');
                dHtml += '</tr></thead><tbody>';
                rows.forEach((r, rIdx) => {
                    dHtml += '<tr><td class="text-center text-muted font-mono small align-middle">' + (rIdx + 1) + '<input type="hidden" name="detail[' + tblName + '][' + r.id + '][id]" value="' + r.id + '"></td>';
                    editableCols.forEach(c => {
                        const val = (r[c] !== null && r[c] !== undefined) ? r[c] : '';
                        dHtml += '<td class="p-1 align-middle"><input type="text" name="detail[' + tblName + '][' + r.id + '][' + c + ']" value="' + val + '" class="form-control form-control-sm text-center font-mono py-1 px-2 border" style="min-width: 90px; background-color: #f8fafc;" placeholder="-"></td>';
                    });
                    dHtml += '</tr>';
                });
                dHtml += '</tbody></table></div></div>';
                $edtDetBox.append(dHtml);
            });
        } else {
            $edtDetBox.html('<div class="text-muted small py-2"><i class="fas fa-info-circle mr-1"></i> Tidak ada data detail pengukuran untuk kalibrasi ini.</div>');
        }

        // Populate Form Edit: Add
        const $edtAddBox = $('#edtAddContainer');
        $edtAddBox.empty();
        $('#edtAddModelLabel').text(joined.models.add || 'Tidak Ada Model Add');
        if (addCount > 0) {
            joined.add.forEach((a, aIdx) => {
                let aHtml = '<div class="p-3 bg-light rounded mb-3 border">';
                aHtml += '<div class="d-flex justify-content-between mb-2"><strong class="small text-warning">Record Add #' + (aIdx + 1) + '</strong><span class="badge badge-secondary font-mono">ID: ' + (a.id || '-') + '</span></div>';
                aHtml += '<input type="hidden" name="add[' + aIdx + '][id]" value="' + (a.id || '') + '">';
                aHtml += '<div class="form-row">';
                Object.keys(a).forEach(k => {
                    if (['id', 'calibration_id', 'created_at', 'updated_at', 'form_index'].includes(k)) return;
                    aHtml += '<div class="col-md-4 mb-2">';
                    aHtml += '<label class="form-group-label" style="font-size: 0.72rem;">' + k + '</label>';
                    aHtml += '<input type="text" name="add[' + aIdx + '][' + k + ']" value="' + (a[k] !== null && a[k] !== undefined ? a[k] : '') + '" class="form-control form-control-sm form-control-custom">';
                    aHtml += '</div>';
                });
                aHtml += '</div></div>';
                $edtAddBox.append(aHtml);
            });
        } else {
            $edtAddBox.html('<div class="text-muted small py-2"><i class="fas fa-info-circle mr-1"></i> Tidak ada data add untuk jenis alat ini.</div>');
        }

        // 3. Populate Detail Table Tab
        const $detBox = $('#modalDetailTableContainer');
        $detBox.empty();
        $('#detBadgeTotalRows').text(detailCount + ' Baris Data');
        if (detailCount > 0) {
            Object.keys(joined.detail).forEach(tblName => {
                const rows = joined.detail[tblName];
                if (rows.length === 0) return;
                const cols = Object.keys(rows[0]);
                let dHtml = '<div class="card border mb-4" style="border-radius: 10px; overflow: hidden;"><div class="card-header bg-light py-2 font-weight-bold d-flex justify-content-between align-items-center"><span><i class="fas fa-table mr-1 text-primary"></i> ' + tblName + '</span><span class="badge badge-primary font-mono">' + rows.length + ' Baris</span></div>';
                dHtml += '<div class="table-responsive" style="max-height: 420px;"><table class="table table-sm table-bordered table-hover mb-0"><thead class="bg-light sticky-top"><tr><th width="30">#</th>';
                cols.forEach(c => dHtml += '<th class="small font-weight-bold">' + c + '</th>');
                dHtml += '</tr></thead><tbody>';
                rows.forEach((r, rIdx) => {
                    dHtml += '<tr><td class="text-muted small font-mono">' + (rIdx + 1) + '</td>';
                    cols.forEach(c => {
                        dHtml += '<td class="small">' + (r[c] !== null && r[c] !== undefined ? r[c] : '-') + '</td>';
                    });
                    dHtml += '</tr>';
                });
                dHtml += '</tbody></table></div></div>';
                $detBox.append(dHtml);
            });
        } else {
            $detBox.html('<div class="alert alert-secondary py-4 text-center"><i class="fas fa-info-circle fa-2x mb-2 text-secondary"></i><p class="mb-0">Tidak ada record detail pengukuran yang tersimpan untuk ID Kalibrasi ini.</p></div>');
        }

        // 4. Populate Raw Calibrations Table
        const $tblRawCal = $('#tblModalRawCal tbody');
        $tblRawCal.empty();
        Object.keys(cal).sort().forEach(k => {
            let v = cal[k];
            if (typeof v === 'object' && v !== null) {
                v = JSON.stringify(v);
            }
            $tblRawCal.append('<tr><td><code>' + k + '</code></td><td>' + (v !== null && v !== undefined ? v : '<span class="text-muted font-italic">null</span>') + '</td></tr>');
        });

        // 5. Populate Raw JSON
        $('#modalRawJsonBox').text(JSON.stringify({ calibration: cal, joined: joined }, null, 2));
    }

    function submitUpdateControlData(e) {
        e.preventDefault();
        if (!activeCalibrationId) return;

        Swal.fire({
            title: 'Menyimpan Perubahan...',
            text: 'Sedang memperbarui data di database...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        const formData = $('#formUpdateControlData').serialize();

        $.ajax({
            url: '{{ url("master-data/control-data") }}/' + activeCalibrationId,
            type: 'PUT',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(res) {
                Swal.close();
                if (res.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil Diperbarui!',
                        text: res.message || 'Data kalibrasi dan tabel ter-join berhasil disimpan.',
                        timer: 2000,
                        showConfirmButton: false
                    });

                    // Update loaded data and re-render modal
                    activeLoadedData = res;
                    populateModalData(res.calibration, res.joined_data);

                    // Update baris pada tabel utama di background tanpa reload
                    const row = $('#row-cal-' + activeCalibrationId);
                    if (row.length > 0) {
                        row.find('td:nth-child(3) .font-weight-bold').text(res.calibration.namaAlat);
                        row.find('td:nth-child(4) div:nth-child(1) strong').text(res.calibration.brandAlat || '-');
                        row.find('td:nth-child(4) div:nth-child(2) span').text(res.calibration.NoSeri || '-');
                        row.find('td:nth-child(4) div:nth-child(3) span').text(res.calibration.kodeAlat || '-');
                        row.find('td:nth-child(5) .font-weight-bold').text(res.calibration.pemilikAlat || '-');
                    }
                } else {
                    Swal.fire('Gagal Menyimpan', res.message || 'Terjadi kesalahan pada server.', 'error');
                }
            },
            error: function(xhr, status, error) {
                Swal.close();
                let errMsg = 'Gagal menyimpan data';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errMsg += ': ' + xhr.responseJSON.message;
                }
                Swal.fire('Error', errMsg, 'error');
            }
        });
    }

    function copyModalRawJson() {
        const text = $('#modalRawJsonBox').text();
        navigator.clipboard.writeText(text).then(() => {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: 'JSON disalin ke clipboard!',
                showConfirmButton: false,
                timer: 1500
            });
        });
    }
</script>
@endpush
