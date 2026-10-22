@extends('layouts.app')
@section('title', 'Dashboard Control')

@push('styles')
<style>
    :root {
        --primary-blue: #1e3a8a;
        --secondary-blue: #2563eb;
        --light-blue: #eff6ff;
        --border-color: #e2e8f0;
        --white: #ffffff;
        --text-dark: #1e293b;
        --text-muted: #64748b;
        --shadow-premium: 0 10px 30px rgba(37, 99, 235, .08);
        --transition-fast: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Date Filter Styling */
    .filter-card {
        background: var(--white);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        box-shadow: var(--shadow-premium);
        padding: 1.25rem 1.5rem;
        margin-bottom: 2rem;
    }

    .filter-card label {
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text-muted);
    }

    .filter-card .form-control {
        border-radius: 10px;
        border: 1px solid var(--border-color);
        font-size: 0.9rem;
        height: calc(2.25rem + 4px);
    }

    .filter-card .btn-filter {
        border-radius: 10px;
        background: linear-gradient(135deg, var(--secondary-blue), var(--primary-blue));
        border: none;
        color: white;
        font-weight: 600;
        padding: 0.6rem 1.5rem;
        transition: var(--transition-fast);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
    }

    .filter-card .btn-filter:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(37, 99, 235, 0.3);
    }

    /* Status Cards */
    .status-card {
        background: var(--white);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 1.5rem;
        transition: var(--transition-fast);
        box-shadow: var(--shadow-premium);
        cursor: pointer;
        position: relative;
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .status-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        border-radius: 16px 16px 0 0;
    }

    .status-card.draft-card::before {
        background: linear-gradient(90deg, #64748b, #94a3b8);
    }

    .status-card.waiting-verification-card::before {
        background: linear-gradient(90deg, #f59e0b, #fbbf24);
    }

    .status-card.verified-card::before {
        background: linear-gradient(90deg, #2563eb, #3b82f6);
    }

    .status-card.approved-card::before {
        background: linear-gradient(90deg, #10b981, #34d399);
    }

    .status-card.rejected-card::before {
        background: linear-gradient(90deg, #f43f5e, #fb7185);
    }

    .status-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(37, 99, 235, .15);
    }

    .status-card.active-filter {
        border-color: var(--secondary-blue);
        box-shadow: 0 10px 25px rgba(37, 99, 235, .18);
        background-color: var(--light-blue);
    }

    .status-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        margin-bottom: 1rem;
    }

    .draft-card .status-icon {
        background: #f1f5f9;
        color: #475569;
    }

    .waiting-card .status-icon {
        background: #fef3c7;
        color: #d97706;
    }

    .approved-card .status-icon {
        background: #d1fae5;
        color: #059669;
    }

    .rejected-card .status-icon {
        background: #ffe4e6;
        color: #e11d48;
    }

    .status-number {
        font-size: 2.25rem;
        font-weight: 800;
        line-height: 1.1;
        color: var(--text-dark);
        font-variant-numeric: tabular-nums;
    }

    .status-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-top: 0.25rem;
    }

    .status-percent {
        font-size: 0.9rem;
        font-weight: 700;
        display: inline-block;
        padding: 0.2rem 0.5rem;
        border-radius: 6px;
        margin-top: 0.5rem;
    }

    .draft-card .status-percent {
        background: #f1f5f9;
        color: #475569;
    }

    .waiting-card .status-percent {
        background: #fef3c7;
        color: #d97706;
    }

    .approved-card .status-percent {
        background: #d1fae5;
        color: #059669;
    }

    .rejected-card .status-percent {
        background: #ffe4e6;
        color: #e11d48;
    }

    /* Dashboard Panel */
    .dashboard-panel {
        background: var(--white);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        box-shadow: var(--shadow-premium);
        margin-bottom: 2rem;
        overflow: hidden;
    }

    .panel-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: linear-gradient(135deg, var(--light-blue), #fff);
    }

    .panel-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--text-dark);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .panel-title i {
        color: var(--secondary-blue);
    }

    .panel-body {
        padding: 1.5rem;
    }

    .panel-body.p-0 {
        padding: 0;
    }

    /* Technician Table with Horizontal Bars */
    .tech-table-wrap {
        max-height: 480px;
        overflow-y: auto;
    }

    .tech-table-wrap table {
        width: 100%;
        border-collapse: collapse;
    }

    .tech-table-wrap thead {
        position: sticky;
        top: 0;
        z-index: 10;
        background: #f8fafc;
    }

    .tech-table-wrap thead th {
        padding: 0.75rem 0.5rem;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text-muted);
        border-bottom: 2px solid var(--border-color);
        text-align: center;
        white-space: nowrap;
    }

    .tech-table-wrap tbody td {
        padding: 0.4rem 0.5rem;
        vertical-align: middle;
        border-bottom: 1px solid var(--border-color);
        font-size: 0.85rem;
    }

    .tech-row {
        cursor: default;
        transition: var(--transition-fast);
    }

    .tech-row:hover {
        background-color: var(--light-blue) !important;
    }

    /* Horizontal Bar Chart Styles */
    .bar-chart-cell {
        min-width: 120px;
        padding: 0.3rem 0.5rem !important;
    }

    .bar-container {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        height: 28px;
    }

    .bar-track {
        flex: 1;
        height: 14px;
        background: #f1f5f9;
        border-radius: 7px;
        overflow: hidden;
        position: relative;
        min-width: 40px;
    }

    .bar-fill {
        height: 100%;
        border-radius: 7px;
        transition: width 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        background: linear-gradient(90deg, var(--secondary-blue), var(--primary-blue));
        min-width: 2px;
    }

    .bar-fill.alt-color {
        background: linear-gradient(90deg, #f59e0b, #d97706);
    }

    .bar-label {
        font-weight: 600;
        font-size: 0.8rem;
        min-width: 45px;
        text-align: right;
        color: var(--text-dark);
        font-variant-numeric: tabular-nums;
    }

    .bar-label .unit {
        font-weight: 400;
        color: var(--text-muted);
        font-size: 0.7rem;
    }

    .tech-name {
        font-weight: 600;
        color: var(--text-dark);
        white-space: nowrap;
    }

    .tech-nik {
        color: var(--text-muted);
        font-size: 0.75rem;
    }

    /* Progress Indicators for Instruments */
    .premium-progress {
        height: 8px;
        border-radius: 4px;
        background-color: #f1f5f9;
        margin-top: 0.4rem;
        overflow: hidden;
    }

    .premium-progress-bar {
        height: 100%;
        border-radius: 4px;
        transition: width 0.6s ease;
    }

    .table-hover tbody tr {
        transition: var(--transition-fast);
    }

    /* Responsive tweaks */
    @media (max-width: 992px) {
        .bar-chart-cell {
            min-width: 80px;
        }

        .bar-label {
            min-width: 35px;
            font-size: 0.7rem;
        }

        .tech-table-wrap tbody td {
            font-size: 0.75rem;
            padding: 0.3rem 0.3rem;
        }
    }

    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1) !important;
    }

    .premium-progress {
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.08);
    }

    .premium-progress-bar {
        position: relative;
        overflow: hidden;
    }

    .premium-progress-bar::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        animation: shimmer 2s infinite;
    }

    @keyframes shimmer {
        0% {
            transform: translateX(-100%);
        }

        100% {
            transform: translateX(100%);
        }
    }

    /* PO Filter Items */
    .po-filter-item {
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        cursor: pointer;
        transition: all 0.15s ease;
    }

    .po-filter-item:hover {
        border-color: #3b82f6 !important;
        background-color: #eff6ff !important;
        transform: translateX(2px);
    }

    .po-filter-item.active-po {
        background-color: #2563eb !important;
        border-color: #1d4ed8 !important;
        color: #ffffff !important;
        box-shadow: 0 2px 6px rgba(37, 99, 235, 0.25);
    }

    .po-filter-item.active-po * {
        color: #ffffff !important;
    }

    .btn-reset-po:hover {
        text-decoration: underline;
    }
</style>
@endpush

@section('content')
{{-- DATE RANGE FILTER (Hidden for PPIC) --}}

<div class="filter-card">
    <form action="{{ route('dashboard.control') }}" method="GET" id="filterForm">
        <div class="row align-items-end">
            <div class="col-12 col-md-3 mb-3 mb-md-0">
                <label for="date_filter">Pilih Rentang Tanggal</label>
                <select class="form-control" id="date_filter" name="date_filter" onchange="toggleDateInputs()">
                    <option value="range" {{ $dateFilter == 'range' ? 'selected' : '' }}>Rentang Tanggal</option>
                    <option value="all" {{ $dateFilter == 'all' ? 'selected' : '' }}>Semua Tanggal</option>
                </select>
            </div>
            <div class="col-12 col-md-3 mb-3 mb-md-0" id="startDateWrapper" style="{{ $dateFilter == 'all' ? 'display:none;' : '' }}">
                <label for="start_date">Tanggal Mulai</label>
                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $startDateInput ?? '' }}">
            </div>
            <div class="col-12 col-md-3 mb-3 mb-md-0" id="endDateWrapper" style="{{ $dateFilter == 'all' ? 'display:none;' : '' }}">
                <label for="end_date">Tanggal Selesai</label>
                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $endDateInput ?? '' }}">
            </div>
            <div class="col-12 col-md-3 text-md-right">
                <button type="submit" class="btn btn-filter btn-block btn-md-auto">
                    <i class="fas fa-filter mr-2"></i> Filter
                </button>
            </div>
        </div>
    </form>
</div>


{{-- STATUS SUMMARY CARDS (Hidden for PPIC) --}}
@if(auth()->user()->role !== 'ppic' && auth()->user()->role !== 'PPIC')
<div class="row">
    <div class="col-12 col-sm-6 col-md-4 col-lg mb-3">
        <div class="status-card draft-card" data-status-filter="draft">
            <div class="status-icon"><i class="fas fa-file-alt"></i></div>
            <div class="status-number">{{ $draftCount }}</div>
            <div class="status-label">Draft</div>
            <div class="status-percent">{{ $draftPercent }}%</div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-4 col-lg mb-3">
        <div class="status-card waiting-verification-card" data-status-filter="waiting_verification">
            <div class="status-icon"><i class="fas fa-user-clock"></i></div>
            <div class="status-number">{{ $waitingVerificationCount }}</div>
            <div class="status-label">Menunggu Verifikasi</div>
            <div class="status-percent">{{ $waitingVerificationPercent }}%</div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-4 col-lg mb-3">
        <div class="status-card verified-card" data-status-filter="waiting_approval">
            <div class="status-icon"><i class="fas fa-hourglass-half"></i></div>
            <div class="status-number">{{ $waitingApproveCount }}</div>
            <div class="status-label">Verified (Menunggu Approve)</div>
            <div class="status-percent">{{ $waitingApprovePercent }}%</div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-4 col-lg mb-3">
        <div class="status-card approved-card" data-status-filter="approved">
            <div class="status-icon"><i class="fas fa-check-circle"></i></div>
            <div class="status-number">{{ $approveCount }}</div>
            <div class="status-label">Approved</div>
            <div class="status-percent">{{ $approvePercent }}%</div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-4 col-lg mb-3">
        <div class="status-card rejected-card" data-status-filter="rejected">
            <div class="status-icon"><i class="fas fa-times-circle"></i></div>
            <div class="status-number">{{ $rejectCount }}</div>
            <div class="status-label">Rejected</div>
            <div class="status-percent">{{ $rejectPercent }}%</div>
        </div>
    </div>
</div>
@endif

{{-- DETAILED CALIBRATION LIST TABLE & SUMMARY PT (Visible for PPIC & Others) --}}
<div class="dashboard-panel">
    <div class="panel-header d-flex align-items-center justify-content-between">
        <span class="panel-title"><i class="fas fa-list"></i> Daftar Dokumen Kalibrasi</span>
        <button class="btn btn-sm btn-outline-secondary" id="clearFilterBtn" style="display: none;">
            <i class="fas fa-times-circle"></i> Clear Status Filter
        </button>
    </div>
    <div class="panel-body">

        {{-- Filter Tanggal Khusus Section Dokumen Kalibrasi (Tetap aktif untuk PPIC) --}}
        <div class="card border-0 bg-light p-3 mb-4" style="border-radius: 12px; border: 1px solid #e2e8f0;">
            <div class="row align-items-end">
                <div class="col-md-3 col-sm-6 mb-2 mb-md-0">
                    <label for="doc_start_date" class="form-label font-weight-bold text-muted mb-1" style="font-size:0.75rem; text-transform:uppercase; letter-spacing:0.5px;">
                        <i class="fas fa-calendar-alt text-primary mr-1"></i> Tanggal Mulai
                    </label>
                    <input type="date" id="doc_start_date" class="form-control form-control-sm" style="border-radius:8px;">
                </div>
                <div class="col-md-3 col-sm-6 mb-2 mb-md-0">
                    <label for="doc_end_date" class="form-label font-weight-bold text-muted mb-1" style="font-size:0.75rem; text-transform:uppercase; letter-spacing:0.5px;">
                        <i class="fas fa-calendar-alt text-primary mr-1"></i> Tanggal Selesai
                    </label>
                    <input type="date" id="doc_end_date" class="form-control form-control-sm" style="border-radius:8px;">
                </div>
                <div class="col-md-3 col-sm-6 mb-2 mb-md-0">
                    <label for="doc_date_type" class="form-label font-weight-bold text-muted mb-1" style="font-size:0.75rem; text-transform:uppercase; letter-spacing:0.5px;">
                        <i class="fas fa-filter text-primary mr-1"></i> Acuan Tanggal
                    </label>
                    <select id="doc_date_type" class="form-control form-control-sm" style="border-radius:8px;">
                        <option value="created_at">Tanggal Input / Buat</option>
                        <option value="tanggal_kalibrasi">Tanggal Kalibrasi</option>
                    </select>
                </div>
                <div class="col-md-3 col-sm-6 d-flex align-items-center">
                    <button type="button" id="btnFilterDocDate" class="btn btn-primary btn-sm flex-fill font-weight-bold" style="border-radius:8px; background: linear-gradient(135deg, #2563eb, #1e3a8a); border:none; height: calc(1.8125rem + 2px);">
                        <i class="fas fa-search mr-1"></i> Filter Dokumen
                    </button>
                    <button type="button" id="btnResetDocDate" class="btn btn-outline-secondary btn-sm ml-2 font-weight-bold" style="border-radius:8px; height: calc(1.8125rem + 2px);" title="Reset Filter Tanggal">
                        <i class="fas fa-undo"></i>
                    </button>
                </div>
            </div>
        </div>

        {{-- CARD EMBED PDF BERITA ACARA (Langsung Muncul File) --}}
        <div class="card border-0 mb-4 shadow-sm" id="beritaAcaraCard" style="border-radius: 12px; border: 1px solid #cbd5e1 !important; display: none;">
            <div class="card-header bg-white border-0 py-3 px-4 d-flex align-items-center justify-content-between">
                <h6 class="font-weight-bold text-dark mb-0">
                    <i class="fas fa-file-pdf text-danger mr-2"></i>
                    <span id="baHeaderTitle">Preview Berita Acara</span>
                </h6>
                <small class="text-muted" id="baCompanyInfo">Perusahaan: —</small>
            </div>
            <div class="card-body p-2 bg-light" style="border-radius: 0 0 12px 12px;">
                <div id="pdfViewerContainer" style="width: 100%; height: 500px; background: #e2e8f0; border-radius: 8px; overflow: hidden;">
                    <!-- Diisi via JS menggunakan tag embed -->
                </div>
            </div>
        </div>

        {{-- Summary Control Pengecekan Per PT (With Scroll & Live Search) --}}
        <div class="card border-0 mb-4 shadow-sm" id="ptSummaryCard" style="border-radius: 12px; background: linear-gradient(135deg, #ffffff, #eff6ff); border: 1px solid #cbd5e1 !important;">
            <div class="card-header bg-transparent border-0 d-flex flex-column flex-md-row align-items-md-center justify-content-between pt-3 px-3 pb-2" style="gap: 1rem;">
                <div>
                    <h6 class="font-weight-bold text-dark mb-1 d-flex align-items-center flex-wrap gap-2" style="font-size: 0.95rem;">
                        <i class="fas fa-building text-primary mr-2"></i> Summary Control Pengecekan (Hasil Filter PT)
                        <span id="activeDocDateBadge" class="badge badge-info ml-2" style="display:none; font-weight:600; font-size:0.75rem;"></span>
                        <span id="activePTBadge" class="badge badge-warning text-dark ml-2 px-2 py-1" style="display:none; font-weight:600; font-size:0.75rem;"></span>
                    </h6>
                    <div class="text-muted font-weight-bold" style="font-size: 0.85rem;">
                        Total PT: <span id="summaryTotalPT" class="badge badge-primary px-2 py-1" style="font-size:0.85rem;">0</span> | Total Alat: <span id="summaryTotalAlat" class="badge badge-success px-2 py-1" style="font-size:0.85rem;">0</span>
                    </div>
                </div>

                <div style="min-width: 250px;">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white border-right-0" style="border-radius: 8px 0 0 8px;"><i class="fas fa-search text-muted"></i></span>
                        </div>
                        <input type="text" id="searchPTSummary" class="form-control border-left-0" placeholder="Cari / Filter Nama PT..." style="border-radius: 0 8px 8px 0; box-shadow: none;">
                    </div>
                </div>
            </div>

            <div class="card-body p-3 border-top" style="border-color: #e2e8f0 !important; max-height: 350px; overflow-y: auto; overflow-x: hidden;" id="ptSummaryScrollArea">
                <div id="ptSummaryContainer" class="row">
                    {{-- Generated via JS --}}
                </div>
            </div>
        </div>

        {{-- Filter Tabel Khusus --}}
        <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap" style="gap:1rem; background: #f8fafc; padding: 15px; border-radius: 10px; border: 1px solid #e2e8f0;">
            <div class="d-flex align-items-center flex-wrap" style="gap:1rem;">
                <div>
                    <label class="text-muted font-weight-bold mb-1" style="font-size:0.75rem;"><i class="fas fa-toolbox"></i> Filter Nama Alat</label>
                    <select id="dtFilterNamaAlat" class="form-control form-control-sm" style="border-radius: 8px; min-width: 200px;">
                        <option value="">Semua Alat</option>
                    </select>
                </div>
                <!--<div>-->
                <!--    <label class="text-muted font-weight-bold mb-1" style="font-size:0.75rem;"><i class="fas fa-building"></i> Filter Nama PT</label>-->
                <!--    <select id="dtFilterNamaPT" class="form-control form-control-sm" style="border-radius: 8px; min-width: 250px;">-->
                <!--        <option value="">Semua PT</option>-->
                <!--    </select>-->
                <!--</div>-->
                <!--<div class="d-flex align-items-end mb-0">-->
                <!--    <button id="dtBtnResetFilters" class="btn btn-sm btn-outline-secondary" style="border-radius: 8px; height: calc(1.5em + .5rem + 2px);">-->
                <!--        <i class="fas fa-undo"></i> Reset Filter-->
                <!--    </button>-->
                <!--</div>-->
            </div>
        </div>

        {{-- Scrollable Table Wrapper --}}
        <div class="table-responsive" style="max-height: 500px; overflow-y: auto; border: 1px solid #e2e8f0; border-radius: 8px;">
            <table class="table table-hover table-striped mb-0" id="calibrationsTable" style="width:100%;">
                <thead class="bg-light" style="position: sticky; top: 0; z-index: 10; box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.1);">
                    <tr>
                        <th width="40">No</th>
                        <th>No PO</th>
                        <th>No Label</th>
                        <th>No Sertifikat</th>
                        <th>Kode Alat</th>
                        <th>Nama Alat</th>
                        <th>Nama PT / Pemilik Alat</th>
                        <th>Lokasi</th>
                        <th>Teknisi</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($calibrations as $index => $cal)
                    @php
                    $statusClass = 'badge-secondary';
                    $statusLabel = $cal->status;

                    if ($cal->status === 'draft') {
                    $statusClass = 'badge-secondary';
                    $statusLabel = 'Draft';
                    $statusGroup = 'draft';
                    } elseif ($cal->status === 'waiting_verification') {
                    $statusClass = 'badge-warning text-white';
                    $statusLabel = 'Menunggu Verifikasi';
                    $statusGroup = 'waiting_verification';
                    } elseif (in_array($cal->status, ['verified', 'waiting_approval'])) {
                    $statusClass = 'badge-primary';
                    $statusLabel = 'Verified (Menunggu Approve)';
                    $statusGroup = 'waiting_approval';
                    } elseif (in_array($cal->status, ['approved', 'completed'])) {
                    $statusClass = 'badge-success';
                    $statusLabel = 'Approved';
                    $statusGroup = 'approved';
                    } elseif ($cal->status === 'rejected') {
                    $statusClass = 'badge-danger';
                    $statusLabel = 'Rejected';
                    $statusGroup = 'rejected';
                    } else {
                    $statusGroup = 'other';
                    }

                    $createdAtDate = $cal->created_at ? $cal->created_at->format('Y-m-d') : '';
                    $tanggalKalibrasiDate = $cal->tanggalKalibrasi ? \Carbon\Carbon::parse($cal->tanggalKalibrasi)->format('Y-m-d') : $createdAtDate;
                    $noSertifikat = $cal->certificate_id ?? $cal->no_sertifikat;

                    $ba = $beritaAcaraList[$cal->id] ?? null;
                    $pdfName = $ba ? $ba->pdf_original_name : '';
                    @endphp
                    @php
                    $lokasiLabel = '—';
                    $lokasiClass = 'badge-secondary';
                    $tempat = strtolower(trim($cal->tempatKalibrasi ?? ''));
                    if (str_contains($tempat, 'insitu') || str_contains($tempat, 'onsite')) {
                    $lokasiLabel = 'Onsite';
                    $lokasiClass = 'badge-warning text-dark';
                    } elseif (str_contains($tempat, 'lab') || $tempat === 'inlab') {
                    $lokasiLabel = 'Inlab';
                    $lokasiClass = 'badge-primary';
                    }
                    @endphp
                    <tr data-status-group="{{ $statusGroup }}"
                        data-pt="{{ $cal->pemilikAlat ? trim($cal->pemilikAlat) : 'Tanpa PT' }}"
                        data-no-po="{{ $cal->no_po ? trim($cal->no_po) : 'Tanpa PO' }}"
                        data-created-at="{{ $createdAtDate }}"
                        data-tanggal-kalibrasi="{{ $tanggalKalibrasiDate }}"
                        data-tempat-kalibrasi="{{ $cal->tempatKalibrasi ?? '' }}"
                        data-lokasi-label="{{ $lokasiLabel }}"
                        data-ba-file="{{ $pdfName }}">
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if(!empty($cal->no_po))
                            <span class="badge badge-light border font-weight-bold" style="font-size:0.78rem;">{{ $cal->no_po }}</span>
                            @else
                            <span class="text-muted" style="font-size:0.8rem;">—</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('calibrations.show', $cal->id) }}" class="font-weight-bold text-primary">
                                {{ $cal->no_label ?? '—' }}
                            </a>
                        </td>
                        <td>
                            @if(!empty($noSertifikat))
                            <span class="font-weight-semibold text-dark">{{ $noSertifikat }}</span>
                            @else
                            <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>{{ $cal->kodeAlat ?? '—' }}</td>
                        <td>{{ $cal->namaAlat }}</td>
                        <td>
                            <span class="font-weight-semibold text-dark">{{ $cal->pemilikAlat ?? '—' }}</span>
                        </td>
                        <td>
                            <span class="badge {{ $lokasiClass }} px-2 py-1" style="font-size:0.75rem;">
                                @if($lokasiLabel === 'Onsite')<i class="fas fa-building mr-1"></i>@elseif($lokasiLabel === 'Inlab')<i class="fas fa-flask mr-1"></i>@endif
                                {{ $lokasiLabel }}
                            </span>
                        </td>
                        <td>{{ $cal->calibratedBy ?? '—' }}</td>
                        <td>
                            <span class="badge {{ $statusClass }} px-2 py-1" style="font-size:0.75rem;">
                                {{ $statusLabel }}
                            </span>
                        </td>
                        <td>{{ $cal->created_at ? $cal->created_at->format('d/m/Y') : '—' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- TECHNICIAN LIST (Hidden for PPIC) --}}
@if(auth()->user()->role !== 'ppic' && auth()->user()->role !== 'PPIC')
<div class="dashboard-panel">
    <div class="panel-header">
        <span class="panel-title"><i class="fas fa-users-cog"></i> Produktivitas Teknisi</span>
        <span class="badge badge-primary">{{ $technicians->count() }} Teknisi</span>
    </div>
    <div class="panel-body p-0">
        <div class="tech-table-wrap">
            <table class="table table-hover table-striped mb-0">
                <thead class="bg-light" style="position: sticky; top: 0; z-index: 10;">
                    <tr>
                        <th style="width: 5%;" class="text-center">No</th>
                        <th style="width: 10%;" class="text-center">NIK</th>
                        <th style="width: 20%;">Nama Teknisi</th>
                        <th style="width: 32.5%;" class="text-center">
                            Jumlah Jenis <span class="text-muted">(Form Type)</span>
                            <br><small class="text-muted">Total: {{ $totalFormTypes }} Jenis</small>
                        </th>
                        <th style="width: 32.5%;" class="text-center">
                            Jumlah Alat <span class="text-muted">(Total Record)</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $maxJenis = $totalFormTypes;
                    $totalAllAlat = $totalAllAlat > 0 ? $totalAllAlat : 1;
                    @endphp
                    @forelse($technicianProductivity as $index => $tech)
                    @php
                    $jenisPercent = $maxJenis > 0 ? round(($tech->jenis / $maxJenis) * 100, 1) : 0;
                    $alatPercent = $totalAllAlat > 0 ? round(($tech->alat / $totalAllAlat) * 100, 1) : 0;
                    @endphp
                    <tr class="tech-row">
                        <td class="text-center font-weight-bold">{{ $index + 1 }}</td>
                        <td class="text-center"><span class="tech-nik">{{ $tech->nik }}</span></td>
                        <td><span class="tech-name">{{ $tech->nama }}</span></td>
                        <td class="bar-chart-cell">
                            <div class="bar-container">
                                <span class="bar-label">{{ $tech->jenis }} <span class="unit">/ {{ $maxJenis }}</span></span>
                                <div class="bar-track" style="height: 20px; border-radius: 10px;">
                                    <div class="bar-fill" style="width: {{ $jenisPercent }}%; height: 100%; border-radius: 10px;"></div>
                                </div>
                                <span class="bar-label" style="min-width:45px; font-size:0.8rem; color:var(--text-muted);">{{ $jenisPercent }}%</span>
                            </div>
                        </td>
                        <td class="bar-chart-cell">
                            <div class="bar-container">
                                <span class="bar-label">{{ $tech->alat }} <span class="unit">alat</span></span>
                                <div class="bar-track" style="height: 20px; border-radius: 10px;">
                                    <div class="bar-fill alt-color" style="width: {{ $alatPercent }}%; height: 100%; border-radius: 10px;"></div>
                                </div>
                                <span class="bar-label" style="min-width:45px; font-size:0.8rem; color:var(--text-muted);">{{ $alatPercent }}%</span>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-5">
                            <i class="fas fa-users fa-2x d-block mb-2"></i> Tidak ada data teknisi
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif

{{-- DISTRIBUSI JENIS ALAT (Hidden for PPIC) --}}
@if(auth()->user()->role !== 'ppic' && auth()->user()->role !== 'PPIC')
<div class="row">
    <div class="col-12">
        <div class="dashboard-panel">
            <div class="panel-header">
                <span class="panel-title"><i class="fas fa-tools"></i> Distribusi Jenis Alat</span>
                <span class="badge badge-primary">{{ $instrumentsData->count() }} Jenis</span>
            </div>
            <div class="panel-body p-0">
                <div style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="bg-light" style="position: sticky; top: 0; z-index: 10;">
                            <tr>
                                <th style="width: 25%;">Nama Alat</th>
                                <th style="width: 10%;" class="text-center">Jumlah</th>
                                <th style="width: 40%;" class="text-center">Persentase</th>
                                <th style="width: 25%;" class="text-center">
                                    <i class="fas fa-clock"></i> Rata-rata Waktu
                                    <br><small class="text-muted">(Pilih Form → Submit)</small>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $totalAllRecords = 0;
                            foreach ($instrumentsData as $inst) {
                            $totalAllRecords += $inst->count;
                            }
                            if ($totalAllRecords == 0) $totalAllRecords = 1;
                            @endphp
                            @forelse($instrumentsData as $inst)
                            @php
                            $percent = round(($inst->count / $totalAllRecords) * 100, 1);
                            @endphp
                            <tr>
                                <td><span class="font-weight-bold">{{ $inst->namaAlat }}</span></td>
                                <td class="text-center font-weight-bold">
                                    <span class="badge badge-primary" style="font-size: 0.9rem; padding: 0.4rem 0.8rem;">{{ $inst->count }}</span>
                                </td>
                                <td class="bar-chart-cell">
                                    <div class="bar-container">
                                        <span class="bar-label">{{ $inst->count }} <span class="unit">record</span></span>
                                        <div class="bar-track" style="height: 20px; border-radius: 10px;">
                                            <div class="bar-fill" style="width: {{ $percent }}%; height: 100%; border-radius: 10px;"></div>
                                        </div>
                                        <span class="bar-label" style="min-width:45px; font-size:0.8rem; color:var(--text-muted);">{{ $percent }}%</span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    @if($inst->avg_time && $inst->avg_time !== '-')
                                    <span class="badge" style="font-size: 0.9rem; padding: 0.4rem 0.8rem; background: linear-gradient(135deg, #10b981, #059669); color: white;">
                                        <i class="fas fa-clock mr-1"></i> {{ $inst->avg_time }}
                                    </span>
                                    @else
                                    <span class="text-muted" style="font-size: 0.8rem;"><i class="fas fa-minus-circle"></i> Tidak ada data</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-5">
                                    <i class="fas fa-inbox fa-2x d-block mb-2"></i> Tidak ada data alat
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

{{-- DISTRIBUSI LOKASI KALIBRASI (Hidden for PPIC) --}}
@if(auth()->user()->role !== 'ppic' && auth()->user()->role !== 'PPIC')
<div class="row">
    <div class="col-12">
        <div class="dashboard-panel">
            <div class="panel-header">
                <span class="panel-title"><i class="fas fa-map-marker-alt"></i> Distribusi Lokasi Kalibrasi</span>
                <span class="badge badge-primary">{{ $onsiteCount + $inlabCount }} Total Alat</span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="card border-0 shadow-sm" style="border-radius: 12px; background: linear-gradient(135deg, #eff6ff, #dbeafe);">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div>
                                        <h5 class="font-weight-bold text-primary mb-0"><i class="fas fa-flask mr-2"></i> Inlab</h5>
                                        <small class="text-muted">Lab PT PAS</small>
                                    </div>
                                    <div class="text-right">
                                        <span class="badge" style="font-size: 1.1rem; padding: 0.5rem 1rem; background: linear-gradient(135deg, #3b82f6, #1e3a8a); color: white;">{{ $inlabCount }} Alat</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="font-weight-bold" style="font-size: 1.2rem; color: #1e3a8a;">{{ $inlabPercent }}%</span>
                                    <span class="text-muted" style="font-size: 0.85rem;">dari total</span>
                                </div>
                                <div class="premium-progress" style="height: 30px; border-radius: 15px; background-color: #bfdbfe; overflow: hidden;">
                                    <div class="premium-progress-bar" style="width: {{ $inlabPercent }}%; height: 100%; border-radius: 15px; background: linear-gradient(90deg, #60a5fa, #1e3a8a);"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="card border-0 shadow-sm" style="border-radius: 12px; background: linear-gradient(135deg, #fffbeb, #fef3c7);">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div>
                                        <h5 class="font-weight-bold text-warning mb-0"><i class="fas fa-building mr-2"></i> Onsite</h5>
                                        <small class="text-muted">Insitu</small>
                                    </div>
                                    <div class="text-right">
                                        <span class="badge" style="font-size: 1.1rem; padding: 0.5rem 1rem; background: linear-gradient(135deg, #f59e0b, #d97706); color: white;">{{ $onsiteCount }} Alat</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="font-weight-bold" style="font-size: 1.2rem; color: #d97706;">{{ $onsitePercent }}%</span>
                                    <span class="text-muted" style="font-size: 0.85rem;">dari total</span>
                                </div>
                                <div class="premium-progress" style="height: 30px; border-radius: 15px; background-color: #fde68a; overflow: hidden;">
                                    <div class="premium-progress-bar" style="width: {{ $onsitePercent }}%; height: 100%; border-radius: 15px; background: linear-gradient(90deg, #fbbf24, #d97706);"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="text-center text-muted" style="border-top: 1px solid #e2e8f0; padding-top: 1.5rem;">
                            <span class="mx-3"><i class="fas fa-cubes text-primary"></i> Total Alat: <strong class="text-dark">{{ $onsiteCount + $inlabCount }}</strong></span>
                            <span class="mx-3"><i class="fas fa-flask text-primary"></i> Inlab: <strong class="text-primary">{{ $inlabCount }}</strong> <span class="text-muted">({{ $inlabPercent }}%)</span></span>
                            <span class="mx-3"><i class="fas fa-building text-warning"></i> Onsite: <strong class="text-warning">{{ $onsiteCount }}</strong> <span class="text-muted">({{ $onsitePercent }}%)</span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // 1. Initialize DataTable
        const table = $('#calibrationsTable').DataTable({
            responsive: true,
            autoWidth: false,
            order: [
                [10, "desc"]
            ],
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ entri",
                info: "Menampilkan _START_ sampai _END_ dari _END_ entri",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                }
            }
        });

        let filterDocStartDate = null;
        let filterDocEndDate = null;
        let filterDocDateType = 'created_at';
        let selectedPTFilter = null;

        // Custom filtering function DataTables
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                if (settings.nTable.id !== 'calibrationsTable') return true;

                const row = table.row(dataIndex).node();
                if (!row) return true;

                const activeFilter = $('.status-card.active-filter').data('status-filter');
                if (activeFilter) {
                    const group = $(row).data('status-group');
                    if (group !== activeFilter) return false;
                }

                if (filterDocStartDate || filterDocEndDate) {
                    const rowDateStr = filterDocDateType === 'tanggal_kalibrasi' ?
                        $(row).data('tanggal-kalibrasi') :
                        $(row).data('created-at');

                    if (!rowDateStr) return false;
                    if (filterDocStartDate && rowDateStr < filterDocStartDate) return false;
                    if (filterDocEndDate && rowDateStr > filterDocEndDate) return false;
                }

                if (selectedPTFilter) {
                    const rowPT = $(row).data('pt');
                    if (selectedPTFilter.pt && rowPT !== selectedPTFilter.pt) return false;

                    if (selectedPTFilter.date) {
                        const rowDateStr = filterDocDateType === 'tanggal_kalibrasi' ?
                            $(row).data('tanggal-kalibrasi') :
                            $(row).data('created-at');
                        if (rowDateStr !== selectedPTFilter.date) return false;
                    }

                    if (selectedPTFilter.po) {
                        const rowPO = $(row).data('no-po');
                        if (rowPO !== selectedPTFilter.po) return false;
                    }
                }

                const filterNamaAlat = $('#dtFilterNamaAlat').val();
                if (filterNamaAlat) {
                    const rowNamaAlat = $(row).find('td:eq(5)').text().trim();
                    if (rowNamaAlat !== filterNamaAlat) return false;
                }

                const filterNamaPT = $('#dtFilterNamaPT').val();
                if (filterNamaPT) {
                    const rowPT = $(row).attr('data-pt') || 'Tanpa PT';
                    if (rowPT !== filterNamaPT) return false;
                }

                return true;
            }
        );

        // Event listeners for Table-only Filters
        $('#dtFilterNamaAlat, #dtFilterNamaPT').on('change', function() {
            table.draw();
        });

        $('#dtBtnResetFilters').on('click', function() {
            $('#dtFilterNamaAlat').val('');
            $('#dtFilterNamaPT').val('');
            table.draw();
        });

        function formatDateIndo(dateStr) {
            if (!dateStr || dateStr === 'Tanpa Tanggal') return 'Tanpa Tanggal';
            const parts = dateStr.split('-');
            if (parts.length === 3) {
                return `${parts[2]}/${parts[1]}/${parts[0]}`;
            }
            return dateStr;
        }

        // Fungsi update dynamic preview Berita Acara Card (Dengan Console Logging)
        function updateBeritaAcaraCard() {
            let targetRow = null;

            table.rows({
                search: 'applied'
            }).nodes().each(function(node) {
                if (!targetRow) targetRow = node;
            });

            console.group("===== DEBUG BERITA ACARA =====");
            if (targetRow) {
                const fileName = $(targetRow).attr('data-ba-file');
                const ptName = $(targetRow).attr('data-pt');
                const calibrationId = $(targetRow).find('a').attr('href');

                console.log("Target Row Ditemukan:");
                console.log("- Nama PT:", ptName);
                console.log("- Atribut data-ba-file:", fileName);
                console.log("- ID / Link Kalibrasi:", calibrationId);

                if (fileName && fileName.trim() !== '' && fileName !== 'null' && fileName !== 'undefined') {
                    const pdfUrl = `{{ asset('pdf_berita_acara') }}/${fileName.trim()}`;
                    console.log("- Generated PDF URL:", pdfUrl);

                    $('#baHeaderTitle').text(`Berita Acara: ${fileName}`);
                    $('#baCompanyInfo').text(`Perusahaan / Pemilik Alat: ${ptName}`);

                    const embedHtml = `<embed src="${pdfUrl}" type="application/pdf" width="100%" height="100%" />`;
                    $('#pdfViewerContainer').html(embedHtml);

                    $('#beritaAcaraCard').slideDown();
                } else {
                    console.warn("⚠️ Nama file PDF kosong atau tidak ditemukan pada atribut baris ini!");
                    $('#baHeaderTitle').text('Berita Acara Tidak Ditemukan');
                    $('#baCompanyInfo').text(`Perusahaan: ${ptName} (File PDF belum tersedia di database/folder)`);
                    $('#pdfViewerContainer').html(`
                    <div class="d-flex flex-column align-items-center justify-content-center h-100 text-muted">
                        <i class="fas fa-exclamation-triangle fa-2x mb-2 text-warning"></i>
                        <p class="mb-0 font-weight-bold">File PDF Berita Acara belum diunggah untuk data ini.</p>
                    </div>
                `);
                    $('#beritaAcaraCard').slideDown();
                }
            } else {
                console.log("⚠️ Tidak ada baris data yang aktif/tampil pada tabel.");
                $('#beritaAcaraCard').slideUp();
            }
            console.groupEnd();
        }

        // Helper: build per-PO breakdown HTML for a PT
        function buildPOBreakdown(poData, ptName, dateStr) {
            if (!poData || Object.keys(poData).length === 0) return '';
            dateStr = dateStr || '';
            const isCurrentPTActive = selectedPTFilter && selectedPTFilter.pt === ptName && (selectedPTFilter.date || '') === dateStr;
            const currentActivePO = isCurrentPTActive ? selectedPTFilter.po : null;

            let html = '<div class="pt-po-breakdown mt-2" style="border-top: 1px dashed #cbd5e1; padding-top: 6px;">';
            html += '<div class="d-flex align-items-center justify-content-between mb-1" style="font-size:0.68rem; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.4px;">';
            html += '<span><i class="fas fa-file-invoice mr-1 text-primary"></i>Pilih PO:</span>';
            if (isCurrentPTActive && currentActivePO) {
                html += `<span class="text-primary font-weight-bold btn-reset-po" data-parent-pt="${ptName}" data-parent-date="${dateStr}" style="font-size:0.65rem; cursor:pointer;" title="Tampilkan Semua PO di PT ini"><i class="fas fa-undo mr-1"></i>Semua PO</span>`;
            }
            html += '</div>';

            Object.keys(poData).sort().forEach(function(po) {
                const pd = poData[po];
                const isPOActive = isCurrentPTActive && currentActivePO === po;

                let locBadge = '';
                if (pd.inlab > 0 && pd.onsite > 0) {
                    locBadge = '<span class="badge badge-info" style="font-size:0.62rem; padding:1px 5px;">Inlab & Onsite</span>';
                } else if (pd.inlab > 0) {
                    locBadge = '<span class="badge badge-primary" style="font-size:0.62rem; padding:1px 5px;"><i class="fas fa-flask"></i> Inlab</span>';
                } else if (pd.onsite > 0) {
                    locBadge = '<span class="badge badge-warning text-dark" style="font-size:0.62rem; padding:1px 5px;"><i class="fas fa-building"></i> Onsite</span>';
                } else {
                    locBadge = '<span class="badge badge-secondary" style="font-size:0.62rem; padding:1px 5px;">-</span>';
                }

                const activeItemClass = isPOActive ? 'active-po' : '';
                const poLabel = po === 'Tanpa PO' ? '<em class="text-muted">Tanpa PO</em>' : `<span>${po}</span>`;
                const checkIcon = isPOActive ? '<i class="fas fa-check-circle mr-1 text-white"></i>' : '<i class="far fa-circle mr-1 text-muted" style="font-size:0.62rem;"></i>';

                html += `
                <div class="po-filter-item ${activeItemClass} d-flex align-items-center justify-content-between p-1 px-2 mb-1 rounded"
                     data-po-val="${po}"
                     data-parent-pt="${ptName}"
                     data-parent-date="${dateStr}"
                     style="font-size:0.75rem;"
                     title="${isPOActive ? 'Klik untuk batal filter PO ini' : 'Klik untuk filter tabel: ' + po}">
                    <span class="text-truncate mr-1" style="max-width:55%; font-weight:${isPOActive ? '700' : '500'};">
                        ${checkIcon}${poLabel}
                    </span>
                    <div class="d-flex align-items-center" style="gap:4px;">
                        ${locBadge}
                        <span class="badge ${isPOActive ? 'badge-light text-dark' : 'badge-light border font-weight-bold'}" style="font-size:0.72rem;">${pd.total} Alat</span>
                    </div>
                </div>
            `;
            });
            html += '</div>';
            return html;
        }

        function updatePTSummary() {
            const isDateFiltered = !!(filterDocStartDate || filterDocEndDate);

            let totalAlat = 0;
            const container = $('#ptSummaryContainer');
            container.empty();

            if (isDateFiltered) {
                const groupedByDate = {};
                const uniquePTs = new Set();

                table.rows().nodes().each(function(node) {
                    const activeStatusFilter = $('.status-card.active-filter').data('status-filter');
                    if (activeStatusFilter) {
                        const group = $(node).data('status-group');
                        if (group !== activeStatusFilter) return;
                    }

                    const rowDateStr = filterDocDateType === 'tanggal_kalibrasi' ?
                        ($(node).data('tanggal-kalibrasi') || 'Tanpa Tanggal') :
                        ($(node).data('created-at') || 'Tanpa Tanggal');

                    if (rowDateStr === 'Tanpa Tanggal') return;
                    if (filterDocStartDate && rowDateStr < filterDocStartDate) return;
                    if (filterDocEndDate && rowDateStr > filterDocEndDate) return;

                    const pt = $(node).attr('data-pt') || 'Tanpa PT';
                    const noPo = $(node).attr('data-no-po') || 'Tanpa PO';
                    const tempatKalibrasi = $(node).attr('data-tempat-kalibrasi') || '';
                    const isInlab = tempatKalibrasi.toLowerCase().includes('lab');
                    const isOnsite = tempatKalibrasi.toLowerCase().includes('insitu') || tempatKalibrasi.toLowerCase().includes('onsite');

                    if (!groupedByDate[rowDateStr]) groupedByDate[rowDateStr] = {};
                    if (!groupedByDate[rowDateStr][pt]) groupedByDate[rowDateStr][pt] = {
                        total: 0,
                        inlab: 0,
                        onsite: 0,
                        po: {}
                    };
                    groupedByDate[rowDateStr][pt].total++;
                    if (isInlab) groupedByDate[rowDateStr][pt].inlab++;
                    if (isOnsite) groupedByDate[rowDateStr][pt].onsite++;

                    if (!groupedByDate[rowDateStr][pt].po[noPo]) {
                        groupedByDate[rowDateStr][pt].po[noPo] = {
                            total: 0,
                            inlab: 0,
                            onsite: 0
                        };
                    }
                    groupedByDate[rowDateStr][pt].po[noPo].total++;
                    if (isInlab) groupedByDate[rowDateStr][pt].po[noPo].inlab++;
                    if (isOnsite) groupedByDate[rowDateStr][pt].po[noPo].onsite++;

                    totalAlat++;
                    uniquePTs.add(pt);
                });

                const dateKeys = Object.keys(groupedByDate).sort();
                const totalPT = uniquePTs.size;

                $('#summaryTotalPT').text(totalPT);
                $('#summaryTotalAlat').text(totalAlat);

                if (dateKeys.length === 0) {
                    container.append(`
                    <div class="col-12 text-center text-muted py-3">
                        <i class="fas fa-exclamation-circle text-warning mr-1"></i> Tidak ada data alat yang sesuai dengan filter tanggal.
                    </div>
                `);
                    return;
                }

                dateKeys.forEach(function(dateStr) {
                    const ptObject = groupedByDate[dateStr];
                    const ptList = Object.keys(ptObject).sort((a, b) => ptObject[b].total - ptObject[a].total);

                    let totalAlatInDate = 0;
                    ptList.forEach(pt => totalAlatInDate += ptObject[pt].total);

                    const dateFormatted = formatDateIndo(dateStr);

                    let ptCardsHtml = '';
                    ptList.forEach(function(pt) {
                        const ptData = ptObject[pt];
                        const count = ptData.total;
                        const inlabCount = ptData.inlab;
                        const onsiteCount = ptData.onsite;
                        const isActive = (selectedPTFilter && selectedPTFilter.pt === pt && selectedPTFilter.date === dateStr);

                        const activeClass = isActive ? 'border-primary shadow-sm' : 'bg-white shadow-xs';
                        const activeStyle = isActive ? 'border: 2px solid #2563eb !important; background-color: #eff6ff !important;' : '';
                        const textStyle = isActive ? 'color: #1e3a8a !important;' : 'color: #1e293b !important;';

                        let locationLabel = '';
                        if (inlabCount > 0 && onsiteCount > 0) {
                            locationLabel = '<span class="badge badge-info" style="font-size:0.7rem;"><i class="fas fa-map-marker-alt"></i> Inlab & Onsite</span>';
                        } else if (inlabCount > 0) {
                            locationLabel = '<span class="badge badge-primary" style="font-size:0.7rem;"><i class="fas fa-flask"></i> Inlab</span>';
                        } else if (onsiteCount > 0) {
                            locationLabel = '<span class="badge badge-warning text-dark" style="font-size:0.7rem;"><i class="fas fa-building"></i> Onsite</span>';
                        } else {
                            locationLabel = '<span class="badge badge-secondary" style="font-size:0.7rem;">-</span>';
                        }

                        const poBreakdown = buildPOBreakdown(ptData.po, pt, dateStr);

                        ptCardsHtml += `
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-2">
                            <div class="pt-summary-card p-2 border rounded ${activeClass} d-flex flex-column" 
                                 data-pt-name="${pt}" 
                                 data-pt-date="${dateStr}"
                                 style="cursor: pointer; transition: all 0.2s ease; ${activeStyle}"
                                 title="Klik untuk memfilter tabel khusus data ${pt} pada tanggal ${dateFormatted}">
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <div class="text-truncate mr-2" style="max-width: 70%;">
                                        <span class="font-weight-bold d-block text-truncate" style="font-size:0.85rem; ${textStyle}">
                                            <i class="fas fa-building text-primary mr-1" style="font-size:0.75rem;"></i> ${pt}
                                        </span>
                                    </div>
                                    <span class="badge ${isActive ? 'badge-primary' : 'badge-secondary'} px-2 py-1 font-weight-bold" style="font-size:0.85rem; border-radius:6px;">
                                        ${count} Alat ${isActive ? '<i class="fas fa-check ml-1"></i>' : ''}
                                    </span>
                                </div>
                                <div class="d-flex align-items-center justify-content-end" style="gap:4px;">${locationLabel}</div>
                                ${poBreakdown}
                            </div>
                        </div>
                    `;
                    });

                    const dateGroupHtml = `
                    <div class="col-12 mb-3 date-group-wrapper">
                        <div class="d-flex align-items-center justify-content-between p-2 mb-2 rounded" style="background:#f1f5f9; border-left: 4px solid #2563eb; border: 1px solid #e2e8f0;">
                            <div class="font-weight-bold text-dark" style="font-size:0.85rem;">
                                <i class="far fa-calendar-alt text-primary mr-1"></i> Tanggal: <strong>${dateFormatted}</strong>
                            </div>
                            <div style="font-size:0.8rem;">
                                <span class="badge badge-light border text-dark font-weight-bold mr-1">${ptList.length} PT</span>
                                <span class="badge badge-primary font-weight-bold">${totalAlatInDate} Alat</span>
                            </div>
                        </div>
                        <div class="row px-1">
                            ${ptCardsHtml}
                        </div>
                    </div>
                `;

                    container.append(dateGroupHtml);
                });

            } else {
                const ptCounts = {};

                table.rows().nodes().each(function(node) {
                    const activeStatusFilter = $('.status-card.active-filter').data('status-filter');
                    if (activeStatusFilter) {
                        const group = $(node).data('status-group');
                        if (group !== activeStatusFilter) return;
                    }

                    const pt = $(node).attr('data-pt') || 'Tanpa PT';
                    const noPo = $(node).attr('data-no-po') || 'Tanpa PO';
                    const tempatKalibrasi = $(node).attr('data-tempat-kalibrasi') || '';
                    const isInlab = tempatKalibrasi.toLowerCase().includes('lab');
                    const isOnsite = tempatKalibrasi.toLowerCase().includes('insitu') || tempatKalibrasi.toLowerCase().includes('onsite');

                    if (!ptCounts[pt]) ptCounts[pt] = {
                        total: 0,
                        inlab: 0,
                        onsite: 0,
                        po: {}
                    };
                    ptCounts[pt].total++;
                    if (isInlab) ptCounts[pt].inlab++;
                    if (isOnsite) ptCounts[pt].onsite++;

                    if (!ptCounts[pt].po[noPo]) ptCounts[pt].po[noPo] = {
                        total: 0,
                        inlab: 0,
                        onsite: 0
                    };
                    ptCounts[pt].po[noPo].total++;
                    if (isInlab) ptCounts[pt].po[noPo].inlab++;
                    if (isOnsite) ptCounts[pt].po[noPo].onsite++;

                    totalAlat++;
                });

                const ptList = Object.keys(ptCounts).sort((a, b) => ptCounts[b].total - ptCounts[a].total);
                const totalPT = ptList.length;

                $('#summaryTotalPT').text(totalPT);
                $('#summaryTotalAlat').text(totalAlat);

                if (totalPT === 0) {
                    container.append(`
                    <div class="col-12 text-center text-muted py-3">
                        <i class="fas fa-exclamation-circle text-warning mr-1"></i> Tidak ada data alat yang tersedia.
                    </div>
                `);
                    return;
                }

                ptList.forEach(function(pt) {
                    const ptData = ptCounts[pt];
                    const count = ptData.total;
                    const inlabCount = ptData.inlab;
                    const onsiteCount = ptData.onsite;
                    const isActive = (selectedPTFilter && selectedPTFilter.pt === pt && !selectedPTFilter.date);

                    const activeClass = isActive ? 'border-primary shadow-sm' : 'bg-white shadow-xs';
                    const activeStyle = isActive ? 'border: 2px solid #2563eb !important; background-color: #eff6ff !important;' : '';
                    const textStyle = isActive ? 'color: #1e3a8a !important;' : 'color: #1e293b !important;';

                    let locationLabel = '';
                    if (inlabCount > 0 && onsiteCount > 0) {
                        locationLabel = '<span class="badge badge-info" style="font-size:0.7rem;"><i class="fas fa-map-marker-alt"></i> Inlab & Onsite</span>';
                    } else if (inlabCount > 0) {
                        locationLabel = '<span class="badge badge-primary" style="font-size:0.7rem;"><i class="fas fa-flask"></i> Inlab</span>';
                    } else if (onsiteCount > 0) {
                        locationLabel = '<span class="badge badge-warning text-dark" style="font-size:0.7rem;"><i class="fas fa-building"></i> Onsite</span>';
                    } else {
                        locationLabel = '<span class="badge badge-secondary" style="font-size:0.7rem;">-</span>';
                    }

                    const poBreakdown = buildPOBreakdown(ptData.po, pt, '');

                    const html = `
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-2">
                        <div class="pt-summary-card p-2 border rounded ${activeClass} d-flex flex-column" 
                             data-pt-name="${pt}" 
                             data-pt-date=""
                             style="cursor: pointer; transition: all 0.2s ease; ${activeStyle}"
                             title="Klik untuk memfilter tabel khusus data ${pt}">
                            <div class="d-flex align-items-center justify-content-between mb-1">
                                <div class="text-truncate mr-2" style="max-width: 70%;">
                                    <span class="font-weight-bold d-block text-truncate" style="font-size:0.85rem; ${textStyle}">
                                        <i class="fas fa-building text-primary mr-1" style="font-size:0.75rem;"></i> ${pt}
                                    </span>
                                </div>
                                <span class="badge ${isActive ? 'badge-primary' : 'badge-secondary'} px-2 py-1 font-weight-bold" style="font-size:0.85rem; border-radius:6px;">
                                    ${count} Alat ${isActive ? '<i class="fas fa-check ml-1"></i>' : ''}
                                </span>
                            </div>
                            <div class="d-flex align-items-center justify-content-end" style="gap:4px;">${locationLabel}</div>
                            ${poBreakdown}
                        </div>
                    </div>
                `;
                    container.append(html);
                });
            }

            if (selectedPTFilter && selectedPTFilter.pt) {
                const dateLabel = selectedPTFilter.date ? ` (${formatDateIndo(selectedPTFilter.date)})` : '';
                let badgeHtml = `Filtered PT: <strong>${selectedPTFilter.pt}</strong>${dateLabel}`;

                if (selectedPTFilter.po) {
                    badgeHtml += ` <span class="mx-1">|</span> PO: <strong>${selectedPTFilter.po}</strong>`;
                    badgeHtml += ` <button type="button" id="btnClearPOOnly" class="btn btn-sm btn-link text-primary p-0 ml-1 font-weight-bold" style="text-decoration:underline; font-size:0.75rem;" title="Tampilkan Semua PO di PT ini">[Semua PO]</button>`;
                }

                badgeHtml += ` <button type="button" id="btnClearPTFilter" class="btn btn-link text-danger p-0 ml-2 font-weight-bold" style="text-decoration:none; font-size: 1.1rem; line-height: 1;" title="Hapus filter PT dan PO">&times;</button>`;

                $('#activePTBadge').html(badgeHtml).show();
            } else {
                $('#activePTBadge').hide();
            }

            const uniqueNamaAlat = new Set();
            const currentSelectedNamaAlat = $('#dtFilterNamaAlat').val();

            const uniqueNamaPT = new Set();
            const currentSelectedNamaPT = $('#dtFilterNamaPT').val();

            table.rows().nodes().each(function(node) {
                const activeStatusFilter = $('.status-card.active-filter').data('status-filter');
                if (activeStatusFilter) {
                    const group = $(node).data('status-group');
                    if (group !== activeStatusFilter) return;
                }

                const rowDateStr = filterDocDateType === 'tanggal_kalibrasi' ?
                    ($(node).data('tanggal-kalibrasi') || 'Tanpa Tanggal') :
                    ($(node).data('created-at') || 'Tanpa Tanggal');

                if (filterDocStartDate || filterDocEndDate) {
                    if (rowDateStr === 'Tanpa Tanggal') return;
                    if (filterDocStartDate && rowDateStr < filterDocStartDate) return;
                    if (filterDocEndDate && rowDateStr > filterDocEndDate) return;
                }

                const namaAlat = $(node).find('td:eq(5)').text().trim();
                uniqueNamaAlat.add(namaAlat);

                const ptName = $(node).attr('data-pt') || 'Tanpa PT';
                uniqueNamaPT.add(ptName);
            });

            $('#dtFilterNamaAlat').empty().append('<option value="">Semua Alat</option>');
            Array.from(uniqueNamaAlat).sort().forEach(function(nama) {
                $('#dtFilterNamaAlat').append(`<option value="${nama}">${nama}</option>`);
            });

            if (currentSelectedNamaAlat && uniqueNamaAlat.has(currentSelectedNamaAlat)) {
                $('#dtFilterNamaAlat').val(currentSelectedNamaAlat);
            } else if (currentSelectedNamaAlat) {
                $('#dtFilterNamaAlat').val('');
            }

            $('#dtFilterNamaPT').empty().append('<option value="">Semua PT</option>');
            Array.from(uniqueNamaPT).sort().forEach(function(pt) {
                $('#dtFilterNamaPT').append(`<option value="${pt}">${pt}</option>`);
            });

            if (currentSelectedNamaPT && uniqueNamaPT.has(currentSelectedNamaPT)) {
                $('#dtFilterNamaPT').val(currentSelectedNamaPT);
            } else if (currentSelectedNamaPT) {
                $('#dtFilterNamaPT').val('');
            }

            updateBeritaAcaraCard();
        }

        updatePTSummary();

        // Klik Card PT (Area di luar item PO)
        $(document).on('click', '.pt-summary-card', function(e) {
            if ($(e.target).closest('.po-filter-item, .btn-reset-po').length > 0) {
                return;
            }

            const clickedPT = $(this).attr('data-pt-name');
            const clickedDate = $(this).attr('data-pt-date') || null;

            if (selectedPTFilter && selectedPTFilter.pt === clickedPT && selectedPTFilter.date === clickedDate) {
                if (selectedPTFilter.po) {
                    // Sedang memfilter PO tertentu di PT ini -> klik card beralih ke Semua PO untuk PT ini
                    selectedPTFilter.po = null;
                } else {
                    // Sudah Semua PO di PT ini -> unselect PT
                    selectedPTFilter = null;
                }
            } else {
                // Pilih PT baru (Semua PO)
                selectedPTFilter = {
                    pt: clickedPT,
                    date: clickedDate,
                    po: null
                };
            }
            table.draw();
            updatePTSummary();
        });

        // Klik Item PO di dalam Card PT
        $(document).on('click', '.po-filter-item', function(e) {
            e.stopPropagation();
            const clickedPO = $(this).attr('data-po-val');
            const parentPT = $(this).attr('data-parent-pt');
            const parentDate = $(this).attr('data-parent-date') || null;

            if (selectedPTFilter && selectedPTFilter.pt === parentPT && (selectedPTFilter.date || null) === parentDate && selectedPTFilter.po === clickedPO) {
                // Toggle off PO: kembali ke Semua PO untuk PT ini
                selectedPTFilter.po = null;
            } else {
                // Filter PT + PO yang dipilih
                selectedPTFilter = {
                    pt: parentPT,
                    date: parentDate,
                    po: clickedPO
                };
            }
            table.draw();
            updatePTSummary();
        });

        // Tombol [Semua PO] di dalam kartu PT
        $(document).on('click', '.btn-reset-po', function(e) {
            e.stopPropagation();
            if (selectedPTFilter) {
                selectedPTFilter.po = null;
                table.draw();
                updatePTSummary();
            }
        });

        // Tombol [Semua PO] di badge header
        $(document).on('click', '#btnClearPOOnly', function(e) {
            e.stopPropagation();
            if (selectedPTFilter) {
                selectedPTFilter.po = null;
                table.draw();
                updatePTSummary();
            }
        });

        // Tombol Clear Filter PT & PO
        $(document).on('click', '#btnClearPTFilter', function(e) {
            e.stopPropagation();
            selectedPTFilter = null;
            table.draw();
            updatePTSummary();
        });

        $('#btnFilterDocDate').on('click', function() {
            filterDocStartDate = $('#doc_start_date').val();
            filterDocEndDate = $('#doc_end_date').val();
            filterDocDateType = $('#doc_date_type').val() || 'created_at';

            const badge = $('#activeDocDateBadge');
            if (filterDocStartDate || filterDocEndDate) {
                const typeLabel = filterDocDateType === 'tanggal_kalibrasi' ? 'Tgl Kalibrasi' : 'Tgl Input';
                const startText = filterDocStartDate ? filterDocStartDate.split('-').reverse().join('/') : 'Awal';
                const endText = filterDocEndDate ? filterDocEndDate.split('-').reverse().join('/') : 'Hari ini';

                badge.text(`Filter (${typeLabel}): ${startText} s/d ${endText}`).show();
            } else {
                badge.hide();
            }

            table.draw();
            updatePTSummary();
        });

        $('#btnResetDocDate').on('click', function() {
            $('#doc_start_date').val('');
            $('#doc_end_date').val('');
            filterDocStartDate = null;
            filterDocEndDate = null;
            selectedPTFilter = null;
            $('#activeDocDateBadge').hide();

            table.draw();
            updatePTSummary();
        });

        $('.status-card').on('click', function() {
            const isAlreadyActive = $(this).hasClass('active-filter');
            $('.status-card').removeClass('active-filter');

            if (isAlreadyActive) {
                $('#clearFilterBtn').hide();
            } else {
                $(this).addClass('active-filter');
                $('#clearFilterBtn').show();
            }

            table.draw();
            updatePTSummary();
        });

        $('#clearFilterBtn').on('click', function() {
            $('.status-card').removeClass('active-filter');
            selectedPTFilter = null;
            $(this).hide();
            table.draw();
            updatePTSummary();
        });

        // Summary PT live search filter (mencari Nama PT atau Nomor PO)
        $('#searchPTSummary').on('keyup', function() {
            const searchTerm = $(this).val().toLowerCase();

            $('.pt-summary-card').each(function() {
                const ptName = $(this).attr('data-pt-name').toLowerCase();
                const cardContent = $(this).text().toLowerCase();
                if (ptName.includes(searchTerm) || cardContent.includes(searchTerm)) {
                    $(this).parent().show();
                } else {
                    $(this).parent().hide();
                }
            });

            $('.date-group-wrapper').each(function() {
                const visibleCards = $(this).find('.pt-summary-card:visible').length;
                if (visibleCards === 0) {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            });
        });
    });

    function toggleDateInputs() {
        const dateFilter = document.getElementById('date_filter').value;
        const startDateWrapper = document.getElementById('startDateWrapper');
        const endDateWrapper = document.getElementById('endDateWrapper');

        if (dateFilter === 'all') {
            startDateWrapper.style.display = 'none';
            endDateWrapper.style.display = 'none';
            document.getElementById('start_date').value = '';
            document.getElementById('end_date').value = '';
        } else {
            startDateWrapper.style.display = 'block';
            endDateWrapper.style.display = 'block';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        toggleDateInputs();
    });
</script>
@endpush