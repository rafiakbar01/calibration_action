{{-- resources/views/log-kalibrasi/show.blade.php --}}
@extends('layouts.app')

@section('title', 'Detail Log Aktivitas #' . $log->id)

@push('styles')
<style>
    /* ── Layout ── */
    .log-hero {
        background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 55%, #2563eb 100%);
        border-radius: 16px;
        padding: 1.5rem 2rem;
        margin-bottom: 1.5rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(37,99,235,.2);
    }
    .log-hero::before {
        content: '';
        position: absolute;
        top: -60px; right: -60px;
        width: 200px; height: 200px;
        border-radius: 50%;
        background: rgba(255,255,255,0.08);
    }
    .log-hero::after {
        content: '';
        position: absolute;
        bottom: -80px; left: -40px;
        width: 250px; height: 250px;
        border-radius: 50%;
        background: rgba(255,255,255,0.05);
    }

    /* ── Activity type badge ── */
    .activity-badge {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        padding: .45rem 1rem;
        border-radius: 50px;
        font-size: .8rem;
        font-weight: 700;
        letter-spacing: .3px;
    }
    .activity-badge.type-select_form      { background: #e8f4fd; color: #1565c0; }
    .activity-badge.type-scan_qr_success  { background: #e8f5e9; color: #2e7d32; }
    .activity-badge.type-scan_qr_failed   { background: #fce4ec; color: #c62828; }
    .activity-badge.type-scan_result      { background: #e3f2fd; color: #0277bd; }
    .activity-badge.type-auto_fill_success{ background: #e8f5e9; color: #1b5e20; }
    .activity-badge.type-auto_fill_failed { background: #fce4ec; color: #b71c1c; }
    .activity-badge.type-load_form        { background: #ede7f6; color: #4527a0; }
    .activity-badge.type-create_tab       { background: #e8f5e9; color: #2e7d32; }
    .activity-badge.type-delete_tab       { background: #fce4ec; color: #c62828; }
    .activity-badge.type-change_tab       { background: #fff8e1; color: #f57f17; }
    .activity-badge.type-page_access      { background: #f3e5f5; color: #6a1b9a; }
    .activity-badge.type-save_calibration { background: #e0f7fa; color: #00695c; }
    .activity-badge.type-login            { background: #e8f5e9; color: #2e7d32; }
    .activity-badge.type-logout           { background: #eceff1; color: #546e7a; }
    .activity-badge.type-create           { background: #e8f5e9; color: #2e7d32; }
    .activity-badge.type-update           { background: #fff8e1; color: #f57f17; }
    .activity-badge.type-delete           { background: #fce4ec; color: #c62828; }
    .activity-badge.type-speed_test       { background: #e0f2fe; color: #0284c7; }
    .activity-badge.type-default          { background: #eceff1; color: #546e7a; }

    /* ── Cards ── */
    .detail-card {
        border: 1px solid #e2e8f0 !important;
        border-radius: 16px !important;
        box-shadow: 0 4px 20px rgba(37,99,235,.06) !important;
        overflow: hidden;
        margin-bottom: 1.5rem;
        background: #ffffff;
    }
    .detail-card .card-header {
        background: #eff6ff !important;
        border-bottom: 1px solid #dbeafe !important;
        padding: 1rem 1.5rem !important;
        font-weight: 700;
        font-size: .9rem;
        color: #1e3a8a;
        display: flex;
        align-items: center;
        gap: .5rem;
    }
    .detail-card .card-body { padding: 1.5rem; }

    /* ── Info rows ── */
    .info-row {
        display: flex;
        padding: .65rem 0;
        border-bottom: 1px solid #f1f3f4;
        align-items: flex-start;
        gap: .75rem;
    }
    .info-row:last-child { border-bottom: none; padding-bottom: 0; }
    .info-label {
        min-width: 140px;
        font-size: .78rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .4px;
        color: #9ca3af;
        padding-top: .1rem;
    }
    .info-value {
        font-size: .88rem;
        color: #1f2937;
        word-break: break-word;
        flex: 1;
    }

    /* ── Metadata grid ── */
    .meta-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: .75rem;
    }
    .meta-item {
        background: #f8f9fa;
        border-radius: 10px;
        padding: .75rem 1rem;
        border-left: 3px solid #dee2e6;
        transition: border-color .2s;
    }
    .meta-item:hover { border-left-color: #4f46e5; }
    .meta-item-key {
        font-size: .72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .4px;
        color: #9ca3af;
        margin-bottom: .25rem;
    }
    .meta-item-value {
        font-size: .87rem;
        color: #1f2937;
        font-weight: 500;
        word-break: break-word;
    }

    /* ── QR scan highlight card ── */
    .qr-highlight {
        background: linear-gradient(135deg, #e8f5e9, #f1f8e9);
        border: 1px solid #c8e6c9;
        border-radius: 12px;
        padding: 1.25rem;
    }
    .qr-highlight .qr-icon {
        font-size: 2.5rem;
        color: #2e7d32;
        margin-bottom: .5rem;
    }

    /* ── Device info ── */
    .device-chip {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        background: #f1f5f9;
        border-radius: 8px;
        padding: .3rem .75rem;
        font-size: .78rem;
        color: #64748b;
        margin: .2rem;
    }

    /* ── JSON viewer ── */
    .json-viewer {
        background: #1e1e2e;
        border-radius: 10px;
        padding: 1rem 1.25rem;
        font-size: .78rem;
        line-height: 1.7;
        overflow-x: auto;
        max-height: 360px;
        color: #cdd6f4;
    }
    .json-key   { color: #89b4fa; }
    .json-str   { color: #a6e3a1; }
    .json-num   { color: #fab387; }
    .json-bool  { color: #f38ba8; }
    .json-null  { color: #9399b2; }

    /* ── Breadcrumb ── */
    .breadcrumb { background: transparent; padding: 0; margin: 0; font-size: .82rem; }
    .breadcrumb-item a { color: rgba(255,255,255,.7); text-decoration: none; }
    .breadcrumb-item a:hover { color: #fff; }
    .breadcrumb-item.active { color: rgba(255,255,255,.9); }
    .breadcrumb-item + .breadcrumb-item::before { color: rgba(255,255,255,.4); }

    /* ── Nav back ── */
    .btn-back {
        background: rgba(255,255,255,.12);
        border: 1px solid rgba(255,255,255,.2);
        color: #fff;
        border-radius: 8px;
        font-size: .82rem;
        padding: .4rem .9rem;
        transition: background .2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: .4rem;
    }
    .btn-back:hover { background: rgba(255,255,255,.22); color: #fff; }

    /* ── Timestamp ── */
    .ts-main { font-size: 1rem; font-weight: 600; color: #fff; }
    .ts-sub  { font-size: .78rem; color: rgba(255,255,255,.6); margin-top: .1rem; }

    /* ── Timeline dot ── */
    .timeline-dot {
        width: 10px; height: 10px;
        border-radius: 50%;
        background: #4ade80;
        box-shadow: 0 0 0 3px rgba(74,222,128,.25);
        display: inline-block;
        margin-right: .4rem;
    }

    /* ============================================================
       RESPONSIVE & USER FRIENDLY ADJUSTMENTS
       ============================================================ */
    @media (max-width: 768px) {
        .log-hero {
            padding: 1.25rem 1.5rem;
        }
        .log-hero .d-flex {
            flex-direction: column !important;
            align-items: stretch !important;
        }
        .log-hero .text-end {
            text-align: left !important;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
        }
        .ts-main {
            font-size: 1.15rem;
        }
        .btn-back {
            margin-top: 0.75rem !important;
            width: 100%;
            justify-content: center;
        }
        .meta-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 576px) {
        .info-row {
            flex-direction: column !important;
            gap: 0.25rem;
            padding: 0.75rem 0;
        }
        .info-label {
            min-width: 100% !important;
            font-size: 0.72rem;
            margin-bottom: 0.1rem;
            font-weight: 700;
        }
        .info-value {
            font-size: 0.85rem;
            width: 100%;
        }
        .detail-card .card-body {
            padding: 1rem !important;
        }
        .device-chip {
            width: 100%;
            margin: 0.2rem 0;
            justify-content: center;
        }
    }
</style>
@endpush

@section('content')
@php
    $typeIconMap = [
        'select_form'       => ['fas fa-hand-pointer',      'select_form'],
        'scan_qr_success'   => ['fas fa-qrcode',             'scan_qr_success'],
        'scan_qr_failed'    => ['fas fa-exclamation-triangle','scan_qr_failed'],
        'scan_result'       => ['fas fa-search',             'scan_result'],
        'auto_fill_success' => ['fas fa-magic',              'auto_fill_success'],
        'auto_fill_failed'  => ['fas fa-times-circle',       'auto_fill_failed'],
        'load_form'         => ['fas fa-file-alt',           'load_form'],
        'create_tab'        => ['fas fa-plus-square',        'create_tab'],
        'delete_tab'        => ['fas fa-minus-square',       'delete_tab'],
        'change_tab'        => ['fas fa-exchange-alt',       'change_tab'],
        'page_access'       => ['fas fa-globe',              'page_access'],
        'save_calibration'  => ['fas fa-save',               'save_calibration'],
        'login'             => ['fas fa-sign-in-alt',        'login'],
        'logout'            => ['fas fa-sign-out-alt',       'logout'],
        'create'            => ['fas fa-plus-circle',        'create'],
        'update'            => ['fas fa-edit',               'update'],
        'delete'            => ['fas fa-trash',              'delete'],
        'speed_test'        => ['fas fa-tachometer-alt',     'speed_test'],
    ];
    $typeLabelMap = [
        'select_form'       => 'Pilih Form',
        'scan_qr_success'   => 'Scan QR Sukses',
        'scan_qr_failed'    => 'Scan QR Gagal',
        'scan_result'       => 'Hasil Scan',
        'auto_fill_success' => 'Auto Fill Sukses',
        'auto_fill_failed'  => 'Auto Fill Gagal',
        'load_form'         => 'Load Form',
        'create_tab'        => 'Buat Tab',
        'delete_tab'        => 'Hapus Tab',
        'change_tab'        => 'Ganti Tab',
        'page_access'       => 'Akses Halaman',
        'save_calibration'  => 'Simpan Kalibrasi',
        'login'             => 'Login',
        'logout'            => 'Logout',
        'create'            => 'Tambah Data',
        'update'            => 'Ubah Data',
        'delete'            => 'Hapus Data',
        'speed_test'        => 'Speed Test Internet',
    ];

    $actType  = $log->activity_type ?? 'default';
    [$icon, $cls] = $typeIconMap[$actType] ?? ['fas fa-history', 'default'];
    $label = $typeLabelMap[$actType] ?? ucfirst(str_replace('_', ' ', $actType));

    // Parse metadata
    $meta = $log->metadata ?? [];
    if (is_string($meta)) $meta = json_decode($meta, true) ?? [];

    // Parse UA
    $ua = $log->user_agent ?? '';
    $isMobile  = stripos($ua, 'Mobile') !== false;
    $browser   = 'Browser';
    $os        = 'Unknown OS';
    if (stripos($ua,'Chrome') !== false && stripos($ua,'Edg') === false && stripos($ua,'OPR') === false) $browser = 'Google Chrome';
    elseif (stripos($ua,'Edg') !== false)  $browser = 'Microsoft Edge';
    elseif (stripos($ua,'Firefox') !== false)$browser = 'Mozilla Firefox';
    elseif (stripos($ua,'Safari') !== false && stripos($ua,'Chrome') === false) $browser = 'Safari';
    elseif (stripos($ua,'OPR') !== false || stripos($ua,'Opera') !== false) $browser = 'Opera';
    if (stripos($ua,'Windows') !== false)      $os = 'Windows';
    elseif (stripos($ua,'Mac OS') !== false)   $os = 'macOS';
    elseif (stripos($ua,'Android') !== false)  $os = 'Android';
    elseif (stripos($ua,'iPhone') !== false || stripos($ua,'iPad') !== false) $os = 'iOS';
    elseif (stripos($ua,'Linux') !== false)    $os = 'Linux';
@endphp

<div class="container-fluid px-3 py-2">

    {{-- ── HERO HEADER ── --}}
    <div class="log-hero">
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 position-relative" style="z-index:1">
            {{-- Left --}}
            <div>
                {{-- Breadcrumb --}}
                <nav aria-label="breadcrumb" class="mb-2">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('activity-logs.index') }}">Log Aktivitas</a></li>
                        <li class="breadcrumb-item active">Detail #{{ $log->id }}</li>
                    </ol>
                </nav>

                {{-- Activity type badge --}}
                <div class="mb-2">
                    <span class="activity-badge type-{{ $cls }}">
                        <i class="{{ $icon }}"></i> {{ $label }}
                    </span>
                </div>

                {{-- Description --}}
                <p class="mb-0" style="color:rgba(255,255,255,.9); font-size:.92rem; max-width:600px;">
                    {{ $log->description ?? 'Tidak ada deskripsi' }}
                </p>
            </div>

            {{-- Right: timestamp & back --}}
            <div class="text-end">
                <div class="ts-main">
                    <span class="timeline-dot"></span>
                    {{ $log->created_at->format('H:i:s') }}
                </div>
                <div class="ts-sub">{{ $log->created_at->format('d F Y') }}</div>
                <div class="ts-sub mt-1">{{ $log->created_at->diffForHumans() }}</div>
                <a href="{{ route('activity-logs.index') }}" class="btn-back mt-3 d-inline-flex">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="row g-3">

        {{-- ── KOLOM KIRI ── --}}
        <div class="col-lg-8">

            {{-- Informasi Utama --}}
            <div class="detail-card card">
                <div class="card-header">
                    <i class="fas fa-info-circle text-primary"></i> Informasi Utama
                </div>
                <div class="card-body">
                    <div class="info-row">
                        <span class="info-label">ID Log</span>
                        <span class="info-value"><code>#{{ $log->id }}</code></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Tipe Aktivitas</span>
                        <span class="info-value">
                            <span class="activity-badge type-{{ $cls }}">
                                <i class="{{ $icon }}"></i> {{ $label }}
                            </span>
                            <code class="ms-2 text-muted" style="font-size:.75rem;">{{ $actType }}</code>
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Deskripsi</span>
                        <span class="info-value">{{ $log->description ?? '-' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Waktu</span>
                        <span class="info-value">
                            <i class="fas fa-clock text-muted me-1"></i>
                            {{ $log->created_at->format('d/m/Y H:i:s') }}
                            <span class="text-muted ms-1">({{ $log->created_at->diffForHumans() }})</span>
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">User</span>
                        <span class="info-value">
                            <i class="fas fa-user text-muted me-1"></i>
                            <strong>{{ $log->performer->nama ?? $log->performer->name ?? 'System' }}</strong>
                            @if($log->performer)
                                <span class="text-muted ms-1">— {{ $log->performer->email ?? '' }}</span>
                            @endif
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">IP Address</span>
                        <span class="info-value">
                            <code>{{ $log->ip_address ?? '-' }}</code>
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">URL</span>
                        <span class="info-value text-muted" style="font-size:.8rem; word-break:break-all;">
                            {{ $log->url ?? '-' }}
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">HTTP Method</span>
                        <span class="info-value">
                            @php $method = strtoupper($log->method ?? 'GET'); @endphp
                            <span class="badge bg-{{ $method==='GET' ? 'secondary' : ($method==='POST' ? 'success' : ($method==='DELETE' ? 'danger' : 'warning')) }}">
                                {{ $method }}
                            </span>
                        </span>
                    </div>
                    @if($log->logable_type)
                    <div class="info-row">
                        <span class="info-label">Model Terkait</span>
                        <span class="info-value">
                            <span class="badge bg-light text-dark border">{{ class_basename($log->logable_type) }}</span>
                            @if($log->logable_id)
                                @if($log->logable_type === 'App\Models\Calibration')
                                    <a href="{{ route('calibrations.show', $log->logable_id) }}" class="ms-1">#{{ $log->logable_id }}</a>
                                @else
                                    <code class="ms-1">#{{ $log->logable_id }}</code>
                                @endif
                            @endif
                        </span>
                    </div>
                    @endif
                    @if($log->batch_uuid)
                    <div class="info-row">
                        <span class="info-label">Batch UUID</span>
                        <span class="info-value"><code style="font-size:.72rem;">{{ $log->batch_uuid }}</code></span>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Metadata (per event type) --}}
            @if(!empty($meta))
            <div class="detail-card card">
                <div class="card-header">
                    <i class="fas fa-tags text-purple" style="color:#7c3aed"></i>
                    Metadata
                    <span class="badge bg-secondary ms-auto">{{ count($meta) }} field</span>
                </div>
                <div class="card-body">

                    {{-- ── Special rendering for select_form / scan ── --}}
                    @if(in_array($actType, ['select_form', 'scan_qr_success', 'scan_result', 'auto_fill_success']))
                        @if(($meta['metode'] ?? $meta['method'] ?? '') === 'qrcode' || $actType === 'scan_qr_success')
                        <div class="qr-highlight mb-3 text-center">
                            <div class="qr-icon"><i class="fas fa-qrcode"></i></div>
                            <div class="fw-bold text-success fs-6">Scan QR Code</div>
                            @if(!empty($meta['qr_code'] ?? $meta['qr_code_id'] ?? ''))
                            <div class="mt-1">
                                <code class="fs-6">{{ $meta['qr_code'] ?? $meta['qr_code_id'] }}</code>
                            </div>
                            @endif
                            @if(!empty($meta['waktu_scan'] ?? ''))
                            <div class="text-muted small mt-1">Scan: {{ $meta['waktu_scan'] }}</div>
                            @endif
                        </div>
                        @endif
                    @endif

                    {{-- ── Special rendering for speed_test ── --}}
                    @if($actType === 'speed_test')
                        @php
                            $spSpeed = $meta['download_speed_mbps'] ?? 0;
                            $spUpload = $meta['upload_speed_mbps'] ?? null;
                            $spPing = $meta['latency_ms'] ?? null;
                            $spJitter = $meta['jitter_ms'] ?? null;
                            $spQuality = $meta['status_quality'] ?? 'OK';
                            $loc = $meta['location'] ?? [];
                            $dev = $meta['device_info'] ?? [];
                            $lat = $loc['latitude'] ?? null;
                            $lon = $loc['longitude'] ?? null;
                        @endphp
                        <div class="p-3 mb-4 rounded-3 border" style="background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%); border-color: #bae6fd !important;">
                            <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom border-info border-opacity-25">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="bg-white p-1 rounded-2 shadow-sm border border-light d-flex align-items-center justify-content-center">
                                        <img src="{{ asset('logo/logo_pas_basic.png') }}" alt="PT. PAS Logo" style="height: 22px; width: auto;">
                                    </div>
                                    <span class="fw-bold text-dark small">PT. Pananjung Anugrah Solution</span>
                                </div>
                                <span class="badge bg-primary rounded-pill px-3 py-1 font-monospace" style="font-size: .75rem;">
                                    <i class="fas fa-satellite-dish me-1"></i> Diagnostic Report
                                </span>
                            </div>
                            <div class="row g-3 text-center">
                                <!-- Download -->
                                <div class="col-md-3">
                                    <div class="bg-white p-3 rounded-3 shadow-sm border border-info border-opacity-25 h-100">
                                        <div class="text-muted small text-uppercase fw-bold"><i class="fas fa-download text-primary me-1"></i> Download</div>
                                        <div class="h3 fw-bold text-primary my-1">{{ number_format((float)$spSpeed, 2) }} <span class="fs-6 fw-normal text-muted">Mbps</span></div>
                                        <span class="badge bg-{{ $spSpeed >= 10 ? 'success' : ($spSpeed >= 3 ? 'warning text-dark' : 'danger') }} rounded-pill px-2 py-1" style="font-size:.7rem;">
                                            {{ $spQuality }}
                                        </span>
                                    </div>
                                </div>
                                <!-- Upload -->
                                <div class="col-md-3">
                                    <div class="bg-white p-3 rounded-3 shadow-sm border border-info border-opacity-25 h-100">
                                        <div class="text-muted small text-uppercase fw-bold"><i class="fas fa-upload text-success me-1"></i> Upload</div>
                                        <div class="h3 fw-bold text-success my-1">{{ $spUpload !== null ? number_format((float)$spUpload, 2) : '-' }} <span class="fs-6 fw-normal text-muted">Mbps</span></div>
                                        <span class="badge bg-light text-secondary border rounded-pill px-2 py-1" style="font-size:.7rem;">
                                            Upstream
                                        </span>
                                    </div>
                                </div>
                                <!-- Ping / Latency -->
                                <div class="col-md-3">
                                    <div class="bg-white p-3 rounded-3 shadow-sm border border-info border-opacity-25 h-100">
                                        <div class="text-muted small text-uppercase fw-bold"><i class="fas fa-bolt text-warning me-1"></i> Ping / Latency</div>
                                        <div class="h3 fw-bold text-dark my-1">{{ $spPing ? number_format((float)$spPing, 0) : '-' }} <span class="fs-6 fw-normal text-muted">ms</span></div>
                                        @if($spJitter)
                                            <div class="text-muted small" style="font-size:.72rem;">Jitter: {{ number_format((float)$spJitter, 1) }} ms</div>
                                        @else
                                            <div class="text-muted small" style="font-size:.72rem;">Pure RTT</div>
                                        @endif
                                    </div>
                                </div>
                                <!-- Location & ISP -->
                                <div class="col-md-3">
                                    <div class="bg-white p-3 rounded-3 shadow-sm border border-info border-opacity-25 h-100 text-start">
                                        <div class="text-muted small text-uppercase fw-bold text-center mb-1"><i class="fas fa-map-marker-alt text-danger me-1"></i> Lokasi & ISP</div>
                                        <div class="small fw-semibold text-dark text-truncate" title="{{ $loc['full_address'] ?? '' }}">
                                            📍 {{ $loc['full_address'] ?? implode(', ', array_filter([$loc['district'] ?? null, $loc['city'] ?? null, $loc['region'] ?? null, $loc['country'] ?? null])) ?: 'Lokasi Tidak Terdeteksi' }}
                                        </div>
                                        @if(!empty($loc['isp'] ?? $loc['org'] ?? ''))
                                            <div class="small text-muted mt-0.5 text-truncate"><i class="fas fa-wifi text-primary me-1"></i> {{ $loc['isp'] ?? $loc['org'] }}</div>
                                        @endif
                                        @if(!empty($dev['network_type']))
                                            <div class="small text-muted mt-0.5 text-truncate"><i class="fas fa-signal text-info me-1"></i> {{ $dev['network_type'] }}</div>
                                        @endif
                                        @if($lat && $lon)
                                            <div class="mt-1 text-center">
                                                <a href="https://www.google.com/maps?q={{ $lat }},{{ $lon }}" target="_blank" class="btn btn-xs btn-outline-primary rounded-pill px-2 py-0.5" style="font-size:.7rem;">
                                                    <i class="fas fa-external-link-alt me-1"></i> Maps
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="meta-grid">
                        @php
                            $skipKeys = ['user_id','user_name'];
                            $niceKeys = [
                                'form_type'     => 'Form Type',
                                'form_name'     => 'Nama Form',
                                'metode'        => 'Metode Pilih',
                                'tab_id'        => 'Tab',
                                'qr_code'       => 'QR Code ID',
                                'qr_code_id'    => 'QR Code ID',
                                'nama_alat'     => 'Nama Alat',
                                'no_seri'       => 'No. Seri',
                                'merek'         => 'Merek',
                                'capacity'      => 'Kapasitas',
                                'resolution'    => 'Resolusi',
                                'waktu_scan'    => 'Waktu Scan',
                                'waktu'         => 'Waktu',
                                'page'          => 'Halaman',
                                'session_has_scan'  => 'Session Scan',
                                'session_has_error' => 'Session Error',
                                'alat_yang_dipilih' => 'Alat Dipilih',
                                'filled_count'  => 'Field Terisi',
                                'filled_fields' => 'Detail Field',
                                'result'        => 'Hasil',
                                'error'         => 'Error',
                                'keyword'       => 'Kata Kunci',
                                'result_count'  => 'Jumlah Hasil',
                            ];
                        @endphp
                        @foreach($meta as $key => $value)
                            @if(!in_array($key, $skipKeys))
                            <div class="meta-item">
                                <div class="meta-item-key">{{ $niceKeys[$key] ?? ucwords(str_replace('_',' ',$key)) }}</div>
                                <div class="meta-item-value">
                                    @if(is_bool($value))
                                        <span class="badge bg-{{ $value ? 'success' : 'secondary' }}">{{ $value ? 'Ya' : 'Tidak' }}</span>
                                    @elseif(is_null($value))
                                        <span class="text-muted">-</span>
                                    @elseif(is_array($value))
                                        <span class="badge bg-info text-dark">{{ count($value) }} item</span>
                                    @elseif($key === 'metode')
                                        @if($value === 'qrcode')
                                            <span class="badge bg-success"><i class="fas fa-qrcode me-1"></i>Scan QR Code</span>
                                        @else
                                            <span class="badge bg-primary"><i class="fas fa-hand-pointer me-1"></i>Pilih Manual</span>
                                        @endif
                                    @else
                                        {{ $value }}
                                    @endif
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>

                    {{-- Jika ada nested array di metadata --}}
                    @foreach($meta as $key => $value)
                        @if(is_array($value) && count($value) > 0 && !in_array($key, $skipKeys))
                        <div class="mt-3">
                            <div class="fw-semibold small text-muted mb-2 text-uppercase" style="letter-spacing:.4px">
                                {{ $niceKeys[$key] ?? ucwords(str_replace('_',' ',$key)) }}
                            </div>
                            <div class="json-viewer">
                                <pre class="mb-0" style="font-family:'Fira Code',monospace; font-size:.78rem; color:#cdd6f4;">{{ json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Data Lama & Baru --}}
            @if($log->old_data || $log->new_data)
            <div class="detail-card card">
                <div class="card-header">
                    <i class="fas fa-exchange-alt text-warning"></i> Perubahan Data
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        @if($log->old_data)
                        <div class="col-md-6">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span class="badge bg-danger">Sebelum</span>
                            </div>
                            <div class="json-viewer">
                                <pre class="mb-0" style="font-family:'Fira Code',monospace; font-size:.75rem; color:#cdd6f4;">{{ json_encode($log->old_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                            </div>
                        </div>
                        @endif
                        @if($log->new_data)
                        <div class="col-md-6">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span class="badge bg-success">Sesudah</span>
                            </div>
                            <div class="json-viewer">
                                <pre class="mb-0" style="font-family:'Fira Code',monospace; font-size:.75rem; color:#cdd6f4;">{{ json_encode($log->new_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif

        </div>

        {{-- ── KOLOM KANAN ── --}}
        <div class="col-lg-4">

            {{-- Ringkasan Cepat --}}
            <div class="detail-card card">
                <div class="card-header">
                    <i class="fas fa-bolt text-warning"></i> Ringkasan
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush" style="border-radius:0 0 14px 14px;">
                        <li class="list-group-item d-flex align-items-center gap-3 py-3">
                            <div class="text-center" style="width:36px;">
                                <i class="fas fa-hashtag text-primary fa-lg"></i>
                            </div>
                            <div>
                                <div class="text-muted" style="font-size:.72rem; text-transform:uppercase; letter-spacing:.4px;">ID</div>
                                <div class="fw-semibold">#{{ $log->id }}</div>
                            </div>
                        </li>
                        <li class="list-group-item d-flex align-items-center gap-3 py-3">
                            <div class="text-center" style="width:36px;">
                                <i class="fas fa-user-circle text-success fa-lg"></i>
                            </div>
                            <div>
                                <div class="text-muted" style="font-size:.72rem; text-transform:uppercase; letter-spacing:.4px;">Dilakukan Oleh</div>
                                <div class="fw-semibold">{{ $log->performer->nama ?? $log->performer->name ?? 'System' }}</div>
                            </div>
                        </li>
                        <li class="list-group-item d-flex align-items-center gap-3 py-3">
                            <div class="text-center" style="width:36px;">
                                <i class="fas fa-calendar-alt text-info fa-lg"></i>
                            </div>
                            <div>
                                <div class="text-muted" style="font-size:.72rem; text-transform:uppercase; letter-spacing:.4px;">Tanggal</div>
                                <div class="fw-semibold">{{ $log->created_at->format('d M Y') }}</div>
                                <div class="text-muted" style="font-size:.8rem;">{{ $log->created_at->format('H:i:s') }}</div>
                            </div>
                        </li>
                        @if(!empty($meta['form_type'] ?? ''))
                        <li class="list-group-item d-flex align-items-center gap-3 py-3">
                            <div class="text-center" style="width:36px;">
                                <i class="fas fa-file-alt text-purple fa-lg" style="color:#7c3aed"></i>
                            </div>
                            <div>
                                <div class="text-muted" style="font-size:.72rem; text-transform:uppercase; letter-spacing:.4px;">Form</div>
                                <div class="fw-semibold">{{ $meta['form_name'] ?? $meta['form_type'] }}</div>
                                <code style="font-size:.72rem; color:#7c3aed;">{{ $meta['form_type'] }}</code>
                            </div>
                        </li>
                        @endif
                        @if(!empty($meta['metode'] ?? ''))
                        <li class="list-group-item d-flex align-items-center gap-3 py-3">
                            <div class="text-center" style="width:36px;">
                                @if($meta['metode'] === 'qrcode')
                                    <i class="fas fa-qrcode text-success fa-lg"></i>
                                @else
                                    <i class="fas fa-hand-pointer text-primary fa-lg"></i>
                                @endif
                            </div>
                            <div>
                                <div class="text-muted" style="font-size:.72rem; text-transform:uppercase; letter-spacing:.4px;">Metode</div>
                                <div class="fw-semibold">
                                    @if($meta['metode'] === 'qrcode')
                                        <span class="text-success">Scan QR Code</span>
                                    @else
                                        <span class="text-primary">Pilih Manual</span>
                                    @endif
                                </div>
                            </div>
                        </li>
                        @endif
                        @if(!empty($meta['tab_id'] ?? ''))
                        <li class="list-group-item d-flex align-items-center gap-3 py-3">
                            <div class="text-center" style="width:36px;">
                                <i class="fas fa-layer-group text-secondary fa-lg"></i>
                            </div>
                            <div>
                                <div class="text-muted" style="font-size:.72rem; text-transform:uppercase; letter-spacing:.4px;">Tab</div>
                                <div class="fw-semibold">Tab {{ $meta['tab_id'] }}</div>
                            </div>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>

            {{-- Informasi Perangkat --}}
            <div class="detail-card card">
                <div class="card-header">
                    <i class="fas fa-laptop text-secondary"></i> Informasi Perangkat
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap mb-2">
                        <span class="device-chip">
                            <i class="fas fa-{{ $isMobile ? 'mobile-alt' : 'desktop' }}"></i>
                            {{ $isMobile ? 'Mobile' : 'Desktop' }}
                        </span>
                        <span class="device-chip">
                            <i class="fas fa-globe"></i>
                            {{ $browser }}
                        </span>
                        <span class="device-chip">
                            <i class="fas fa-server"></i>
                            {{ $os }}
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">IP Address</span>
                        <span class="info-value"><code>{{ $log->ip_address ?? '-' }}</code></span>
                    </div>
                    <div class="mt-2">
                        <div class="text-muted mb-1" style="font-size:.72rem; text-transform:uppercase; letter-spacing:.4px;">User Agent</div>
                        <div class="bg-light rounded p-2" style="font-size:.72rem; line-height:1.5; color:#64748b; word-break:break-all;">
                            {{ $log->user_agent ?? '-' }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Navigasi Log Sebelum/Sesudah --}}
            @php
                $prevLog = \App\Models\ActivityLog::where('id', '<', $log->id)->orderBy('id','desc')->first();
                $nextLog = \App\Models\ActivityLog::where('id', '>', $log->id)->orderBy('id','asc')->first();
            @endphp
            <div class="detail-card card">
                <div class="card-header">
                    <i class="fas fa-compass text-info"></i> Navigasi Log
                </div>
                <div class="card-body p-2">
                    <div class="d-flex gap-2">
                        @if($prevLog)
                        <a href="{{ route('log-kalibrasi.show', $prevLog->id) }}"
                           class="btn btn-sm btn-outline-secondary flex-fill text-start">
                            <i class="fas fa-chevron-left me-1"></i>
                            <span class="d-block" style="font-size:.7rem; text-overflow:ellipsis; overflow:hidden; white-space:nowrap;">
                                #{{ $prevLog->id }} — {{ Str::limit($prevLog->description, 30) }}
                            </span>
                        </a>
                        @else
                        <span class="btn btn-sm btn-light flex-fill disabled text-center">
                            <i class="fas fa-chevron-left"></i> Awal
                        </span>
                        @endif

                        @if($nextLog)
                        <a href="{{ route('log-kalibrasi.show', $nextLog->id) }}"
                           class="btn btn-sm btn-outline-secondary flex-fill text-end">
                            <span class="d-block" style="font-size:.7rem; text-overflow:ellipsis; overflow:hidden; white-space:nowrap;">
                                #{{ $nextLog->id }} — {{ Str::limit($nextLog->description, 30) }}
                            </span>
                            <i class="fas fa-chevron-right ms-1"></i>
                        </a>
                        @else
                        <span class="btn btn-sm btn-light flex-fill disabled text-center">
                            Akhir <i class="fas fa-chevron-right"></i>
                        </span>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection