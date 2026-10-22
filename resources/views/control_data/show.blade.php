@extends('layouts.app')
@section('title', 'Detail & Edit Control Data: ' . $calibration->id)

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

<style>
    :root {
        --cd-primary: #4f46e5;
        --cd-accent: #06b6d4;
        --cd-emerald: #10b981;
        --cd-amber: #f59e0b;
        --cd-rose: #f43f5e;
        --cd-violet: #8b5cf6;
        --cd-border: #e2e8f0;
        --cd-text: #1e293b;
        --cd-muted: #64748b;
        --cd-radius: 14px;
        --cd-shadow: 0 4px 20px rgba(0,0,0,0.07);
        --cd-shadow-lg: 0 12px 40px rgba(0,0,0,0.12);
    }
    body { font-family: 'Inter', sans-serif !important; background: #f0f2f8; color: var(--cd-text); }
    .font-mono { font-family: 'JetBrains Mono', monospace; }

    /* ─── HERO ─────────────────────────────────────────────────────── */
    .cd-detail-hero {
        background: linear-gradient(135deg, #0d1b3e 0%, #132554 40%, #1a3a7c 70%, #1e3a6e 100%);
        border-radius: 20px; padding: 28px 36px; color: #fff;
        margin-bottom: 24px;
        box-shadow: 0 20px 60px -10px rgba(13,27,62,0.45), 0 8px 20px rgba(0,0,0,0.15);
        border: 1px solid rgba(255,255,255,0.08);
        position: relative; overflow: hidden;
    }
    .cd-detail-hero::before {
        content: ''; position: absolute; top: -60px; right: -60px;
        width: 220px; height: 220px;
        background: radial-gradient(circle, rgba(99,102,241,0.3) 0%, transparent 70%);
        border-radius: 50%; pointer-events: none;
    }
    .cd-detail-hero::after {
        content: ''; position: absolute; bottom: -40px; left: 30%;
        width: 180px; height: 180px;
        background: radial-gradient(circle, rgba(6,182,212,0.2) 0%, transparent 70%);
        border-radius: 50%; pointer-events: none;
    }
    .hero-id-display {
        font-family: 'JetBrains Mono', monospace;
        font-size: 1.5rem; font-weight: 700; color: #fff;
        letter-spacing: -0.5px; margin-bottom: 8px;
    }
    .hero-meta { color: rgba(255,255,255,0.55); font-size: 0.9rem; }
    .hero-meta code {
        background: rgba(0,0,0,0.25); color: #7dd3fc;
        padding: 2px 7px; border-radius: 5px;
        font-family: 'JetBrains Mono', monospace; font-size: 0.82rem;
    }

    /* ─── MAIN CARD ─────────────────────────────────────────────────── */
    .main-detail-card {
        border-radius: var(--cd-radius); border: 1px solid var(--cd-border);
        background: #fff; box-shadow: var(--cd-shadow); overflow: hidden;
    }

    /* ─── NAV TABS ──────────────────────────────────────────────────── */
    .nav-tabs-modern { border-bottom: 2px solid var(--cd-border); gap: 2px; background: #f8fafc; flex-wrap: nowrap; overflow-x: auto; }
    .nav-tabs-modern .nav-link {
        border: none; color: var(--cd-muted); font-weight: 600;
        font-size: 0.84rem; padding: 13px 18px; white-space: nowrap;
        border-radius: 8px 8px 0 0; position: relative; transition: all 0.2s ease;
    }
    .nav-tabs-modern .nav-link:hover { color: var(--cd-text); background: #f1f5f9; }
    .nav-tabs-modern .nav-link.active { color: var(--cd-primary); background: #fff; }
    .nav-tabs-modern .nav-link.active::after {
        content: ''; position: absolute; bottom: -2px; left: 0; right: 0;
        height: 3px; background: var(--cd-primary); border-radius: 3px 3px 0 0;
    }

    /* ─── FORM CONTROLS ─────────────────────────────────────────────── */
    .form-group-label {
        font-size: 0.73rem; font-weight: 700; color: var(--cd-muted);
        text-transform: uppercase; letter-spacing: 0.6px; margin-bottom: 5px; display: block;
    }
    .form-control-custom {
        border-radius: 10px; border: 1.5px solid #e2e8f0;
        font-size: 0.875rem; padding: 9px 13px;
        transition: all 0.2s ease; background: #fafbfc; width: 100%;
    }
    .form-control-custom:focus {
        border-color: var(--cd-primary);
        box-shadow: 0 0 0 3px rgba(79,70,229,0.12);
        background: #fff; outline: none;
    }
    .form-control-custom:hover:not(:focus) { border-color: #94a3b8; }
    textarea.form-control-custom { resize: vertical; min-height: 72px; }

    /* ─── SECTION CARDS (Form Edit) ──────────────────────────────────── */
    .edit-section-card {
        border-radius: 12px; border: 1px solid var(--cd-border);
        overflow: hidden; margin-bottom: 16px;
        transition: box-shadow 0.2s ease;
    }
    .edit-section-card:hover { box-shadow: 0 4px 16px rgba(0,0,0,0.07); }
    .edit-section-header {
        display: flex; align-items: center; justify-content: space-between;
        padding: 13px 18px; border-bottom: 1px solid var(--cd-border);
        font-weight: 700; font-size: 0.84rem; cursor: pointer; user-select: none;
    }
    .section-left { display: flex; align-items: center; gap: 10px; }
    .section-icon {
        width: 34px; height: 34px; border-radius: 9px;
        display: flex; align-items: center; justify-content: center; font-size: 14px;
    }
    .section-num {
        width: 22px; height: 22px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.7rem; font-weight: 800; flex-shrink: 0;
    }
    .edit-section-body { padding: 20px 22px; background: #fafbfc; }

    /* Color variants */
    .sec-primary .edit-section-header { background: linear-gradient(135deg, #eff6ff, #eef2ff); color: #3730a3; }
    .sec-primary .section-icon { background: rgba(79,70,229,0.12); color: var(--cd-primary); }
    .sec-primary .section-num { background: #4f46e5; color: #fff; }
    .sec-info .edit-section-header { background: linear-gradient(135deg, #ecfeff, #e0f2fe); color: #0c4a6e; }
    .sec-info .section-icon { background: rgba(6,182,212,0.12); color: var(--cd-accent); }
    .sec-info .section-num { background: #06b6d4; color: #fff; }
    .sec-slate .edit-section-header { background: linear-gradient(135deg, #f8fafc, #f1f5f9); color: #334155; }
    .sec-slate .section-icon { background: rgba(100,116,139,0.12); color: #475569; }
    .sec-slate .section-num { background: #64748b; color: #fff; }
    .sec-danger .edit-section-header { background: linear-gradient(135deg, #fff1f2, #fce7f3); color: #9f1239; }
    .sec-danger .section-icon { background: rgba(244,63,94,0.12); color: var(--cd-rose); }
    .sec-danger .section-num { background: #f43f5e; color: #fff; }
    .sec-success .edit-section-header { background: linear-gradient(135deg, #ecfdf5, #d1fae5); color: #065f46; }
    .sec-success .section-icon { background: rgba(16,185,129,0.12); color: var(--cd-emerald); }
    .sec-success .section-num { background: #10b981; color: #fff; }
    .sec-dark .edit-section-header { background: linear-gradient(135deg, #1e293b, #334155); color: #e2e8f0; }
    .sec-dark .section-icon { background: rgba(226,232,240,0.12); color: #94a3b8; }
    .sec-dark .section-num { background: #475569; color: #fff; }
    .sec-violet .edit-section-header { background: linear-gradient(135deg, #faf5ff, #ede9fe); color: #5b21b6; }
    .sec-violet .section-icon { background: rgba(139,92,246,0.12); color: var(--cd-violet); }
    .sec-violet .section-num { background: #8b5cf6; color: #fff; }
    .sec-amber .edit-section-header { background: linear-gradient(135deg, #fffbeb, #fef3c7); color: #92400e; }
    .sec-amber .section-icon { background: rgba(245,158,11,0.12); color: var(--cd-amber); }
    .sec-amber .section-num { background: #f59e0b; color: #fff; }

    /* ─── SAVE BAR ──────────────────────────────────────────────────── */
    .save-bar {
        background: linear-gradient(135deg, #ecfdf5, #d1fae5);
        border-radius: 14px; padding: 16px 22px;
        display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px;
        border: 1px solid #a7f3d0; margin-bottom: 22px;
        box-shadow: 0 4px 12px rgba(16,185,129,0.12);
    }
    .save-bar-info h6 { margin: 0; font-weight: 800; color: #065f46; font-size: 0.95rem; }
    .save-bar-info small { color: #6b7280; font-size: 0.78rem; }

    /* ─── DATA TABLE (raw view) ─────────────────────────────────────── */
    .data-table-raw { margin-bottom: 0; border-collapse: separate; border-spacing: 0; font-size: 0.84rem; }
    .data-table-raw th {
        background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        color: #475569; font-weight: 700; font-size: 0.72rem;
        text-transform: uppercase; letter-spacing: 0.6px;
        padding: 12px 14px; border-bottom: 2px solid var(--cd-border); border-top: none;
    }
    .data-table-raw td {
        padding: 11px 14px; border-bottom: 1px solid #f8fafc;
        vertical-align: middle; color: var(--cd-text);
    }
    .data-table-raw tbody tr:hover td { background: linear-gradient(90deg, rgba(79,70,229,0.04), transparent); }
    .data-table-raw tbody tr:last-child td { border-bottom: none; }
    .col-key { font-family: 'JetBrains Mono', monospace; font-weight: 600; color: #4f46e5; font-size: 0.78rem; }
    .col-val { color: #334155; }
    .null-badge { color: #94a3b8; font-style: italic; font-size: 0.78rem; }

    /* ─── RAW JSON ──────────────────────────────────────────────────── */
    .raw-json-box {
        background: #0b1120; color: #7dd3fc; padding: 18px; border-radius: 12px;
        font-family: 'JetBrains Mono', monospace; font-size: 0.8rem;
        max-height: 550px; overflow-y: auto; border: 1px solid #1e3a5f;
    }
    .raw-json-box::-webkit-scrollbar { width: 5px; }
    .raw-json-box::-webkit-scrollbar-track { background: #0f1a2e; }
    .raw-json-box::-webkit-scrollbar-thumb { background: #4f46e5; border-radius: 4px; }

    /* ─── MISC ──────────────────────────────────────────────────────── */
    .section-divider { height: 1px; background: linear-gradient(90deg, var(--cd-border), transparent); margin: 18px 0; }
    .btn-hero-action {
        border-radius: 10px; font-weight: 700; padding: 8px 18px; font-size: 0.875rem;
        transition: all 0.2s cubic-bezier(0.34,1.56,0.64,1);
    }
    .btn-hero-action:hover { transform: translateY(-2px); box-shadow: 0 6px 18px rgba(0,0,0,0.2); }
    .toggle-section-btn { background: none; border: none; color: inherit; cursor: pointer; padding: 0; opacity: 0.6; transition: opacity 0.2s, transform 0.3s; }
    .toggle-section-btn:hover { opacity: 1; }
    .toggle-section-btn.collapsed { transform: rotate(-90deg); }
    .detail-table-wrapper { border-radius: 12px; border: 1px solid var(--cd-border); overflow: hidden; }
    .badge-status {
        border-radius: 20px; padding: 4px 12px; font-size: 0.74rem; font-weight: 700;
        letter-spacing: 0.4px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-3 py-2">

    <!-- Hero Header -->
    <div class="cd-detail-hero">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div>
                <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                    <a href="{{ route('control-data.index') }}" class="btn btn-sm btn-outline-light mr-2 font-weight-bold" style="border-radius: 9px; backdrop-filter: blur(8px); background: rgba(255,255,255,0.08);">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali ke Control Data
                    </a>
                    <span class="badge px-3 py-1 font-weight-bold" style="background: rgba(245,158,11,0.2); color: #fef08a; border: 1px solid rgba(245,158,11,0.4); border-radius: 20px; font-size: 0.73rem;">
                        <i class="fas fa-shield-alt mr-1"></i> SUPER ADMIN CONTROL
                    </span>
                    <span class="badge px-3 py-1 font-weight-bold font-mono" style="background: rgba(6,182,212,0.2); color: #a5f3fc; border: 1px solid rgba(6,182,212,0.4); border-radius: 20px; font-size: 0.73rem;">
                        {{ strtoupper($calibration->status ?: 'DRAFT') }}
                    </span>
                </div>
                <div class="hero-id-display">{{ $calibration->id }}</div>
                <div class="hero-meta">
                    <span class="text-white font-weight-bold">{{ $calibration->namaAlat ?: 'Tanpa Nama Alat' }}</span>
                    <span class="mx-2 text-white-50">•</span>
                    Form: <code>{{ $joinedData['form_type'] }}</code>
                    <span class="mx-2 text-white-50">•</span>
                    Customer: <strong class="text-white">{{ $calibration->pemilikAlat ?: '-' }}</strong>
                    <span class="mx-2 text-white-50">•</span>
                    Order: <code>{{ $calibration->no_po ?: '-' }}</code>
                </div>
            </div>
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <button type="button" class="btn btn-success btn-hero-action mr-2" onclick="switchToEditTab()" style="background: linear-gradient(135deg, #10b981, #059669); border: none;">
                    <i class="fas fa-edit mr-1"></i> Mode Edit Data
                </button>
                <a href="{{ route('control-data.export-json', $calibration->id) }}" class="btn btn-dark btn-hero-action mr-2" style="background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.2);">
                    <i class="fas fa-download mr-1"></i> Unduh JSON
                </a>
                <a href="{{ route('calibrations.show', $calibration->id) }}" class="btn btn-outline-light btn-hero-action" target="_blank">
                    <i class="fas fa-external-link-alt mr-1"></i> Form Asli
                </a>
            </div>
        </div>
    </div>

    <!-- Navigation Tabs Card -->
    <div class="main-detail-card mb-4">
        <div class="bg-white border-bottom">
            <ul class="nav nav-tabs nav-tabs-modern px-4 pt-3" id="controlDataShowTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tab-edit-link" data-toggle="tab" href="#tab-edit" role="tab">
                        <i class="fas fa-edit mr-1 text-warning"></i> Form Edit Terpadu
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-calibrations-link" data-toggle="tab" href="#tab-calibrations" role="tab">
                        <i class="fas fa-database mr-1 text-primary"></i> Induk Calibrations ({{ count($calibration->getAttributes()) }})
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-head-link" data-toggle="tab" href="#tab-head" role="tab">
                        <i class="fas fa-heading mr-1 text-success"></i> Tabel Head ({{ $joinedData['head']->count() }})
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-detail-link" data-toggle="tab" href="#tab-detail" role="tab">
                        <i class="fas fa-list-ol mr-1 text-info"></i> Detail Pengukuran
                        @php
                            $totalDetailRows = 0;
                            foreach($joinedData['detail'] as $rows) { $totalDetailRows += count($rows); }
                        @endphp
                        <span class="badge badge-light border ml-1 font-mono">{{ $totalDetailRows }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-add-link" data-toggle="tab" href="#tab-add" role="tab">
                        <i class="fas fa-puzzle-piece mr-1 text-warning"></i> Tabel Add ({{ $joinedData['add']->count() }})
                    </a>
                </li>
                @if(!empty($joinedData['subforms']))
                <li class="nav-item">
                    <a class="nav-link" id="tab-subforms-link" data-toggle="tab" href="#tab-subforms" role="tab">
                        <i class="fas fa-layer-group mr-1 text-secondary"></i> Subforms ({{ count($joinedData['subforms']) }})
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" id="tab-json-link" data-toggle="tab" href="#tab-json" role="tab">
                        <i class="fas fa-code mr-1 text-danger"></i> Raw Payload
                    </a>
                </li>
            </ul>
        </div>

        <div class="card-body p-4">
            <div class="tab-content" id="controlDataShowContent">

                <!-- TAB 1: FORM EDIT & UPDATE DATA -->
                <div class="tab-pane fade show active" id="tab-edit" role="tabpanel">
                    <form id="formShowUpdate" onsubmit="submitShowUpdate(event)">
                        
                        <!-- Premium Save Bar Top -->
                        <div class="save-bar">
                            <div class="d-flex align-items-center gap-3">
                                <div class="section-icon" style="background: rgba(16,185,129,0.18); color: #059669; width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                                    <i class="fas fa-database"></i>
                                </div>
                                <div class="save-bar-info">
                                    <h6>Mode Live Control Data Editor</h6>
                                    <small>Seluruh modifikasi ke tabel calibrations, head, detail, dan add akan langsung disinkronkan ke database.</small>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success font-weight-bold px-4 py-2" style="border-radius: 10px; box-shadow: 0 4px 14px rgba(16,185,129,0.35);">
                                <i class="fas fa-save mr-1"></i> Simpan Semua Perubahan
                            </button>
                        </div>

                        <!-- 1. Identitas & Spesifikasi Alat (Calibrations) -->
                        <div class="edit-section-card sec-primary">
                            <div class="edit-section-header">
                                <div class="section-left">
                                    <div class="section-num">1</div>
                                    <div class="section-icon"><i class="fas fa-tools"></i></div>
                                    <div>
                                        <span>Identitas & Spesifikasi Alat</span>
                                        <div style="font-size: 0.72rem; color: #6366f1; font-weight: 500;">Tabel Induk Calibrations (Alat, Tipe, Merek, Kapasitas)</div>
                                    </div>
                                </div>
                                <span class="badge badge-light border text-primary font-weight-bold px-2 py-1">Identitas</span>
                            </div>
                            <div class="edit-section-body">
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-group-label">Nama Alat</label>
                                        <input type="text" name="calibration[namaAlat]" value="{{ $calibration->namaAlat }}" class="form-control form-control-custom">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-group-label">Merek / Brand</label>
                                        <input type="text" name="calibration[brandAlat]" value="{{ $calibration->brandAlat }}" class="form-control form-control-custom">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-group-label">Tipe Alat</label>
                                        <input type="text" name="calibration[typeAlat]" value="{{ $calibration->typeAlat }}" class="form-control form-control-custom">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-group-label">Nomor Seri</label>
                                        <input type="text" name="calibration[NoSeri]" value="{{ $calibration->NoSeri }}" class="form-control form-control-custom font-mono">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-group-label">Kode Alat</label>
                                        <input type="text" name="calibration[kodeAlat]" value="{{ $calibration->kodeAlat }}" class="form-control form-control-custom font-mono">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-group-label">ID Alat</label>
                                        <input type="text" name="calibration[id_alat]" value="{{ $calibration->id_alat }}" class="form-control form-control-custom font-mono">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-group-label">Kapasitas</label>
                                        <input type="text" name="calibration[kapasitas]" value="{{ $calibration->kapasitas }}" class="form-control form-control-custom">
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label class="form-group-label">Capacity (Alt)</label>
                                        <input type="text" name="calibration[capacity]" value="{{ $calibration->capacity }}" class="form-control form-control-custom">
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label class="form-group-label">Resolusi</label>
                                        <input type="text" name="calibration[resolusi]" value="{{ $calibration->resolusi }}" class="form-control form-control-custom">
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label class="form-group-label">Skala</label>
                                        <input type="text" name="calibration[skala]" value="{{ $calibration->skala }}" class="form-control form-control-custom">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-group-label">Range Min</label>
                                        <input type="text" name="calibration[rangeMin]" value="{{ $calibration->rangeMin }}" class="form-control form-control-custom font-mono">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-group-label">Range Max</label>
                                        <input type="text" name="calibration[rangeMax]" value="{{ $calibration->rangeMax }}" class="form-control form-control-custom font-mono">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-group-label">Jenis Pembacaan</label>
                                        <input type="text" name="calibration[jenisPembacaan]" value="{{ $calibration->jenisPembacaan }}" class="form-control form-control-custom" placeholder="Manual, Digital, Dial, dsb.">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-group-label">Kondisi Alat</label>
                                        <input type="text" name="calibration[kondisiAlat]" value="{{ $calibration->kondisiAlat }}" class="form-control form-control-custom" placeholder="Baik, Normal, dsb.">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 2. Customer, Administrasi, Order & Dokumen (Calibrations) -->
                        <div class="edit-section-card sec-info">
                            <div class="edit-section-header">
                                <div class="section-left">
                                    <div class="section-num">2</div>
                                    <div class="section-icon"><i class="fas fa-file-invoice"></i></div>
                                    <div>
                                        <span>Customer, Order & Dokumen</span>
                                        <div style="font-size: 0.72rem; color: #0284c7; font-weight: 500;">Pemilik Alat, No PO, No Label, Lembar Kerja (LK), Petugas NIK</div>
                                    </div>
                                </div>
                                <span class="badge badge-light border text-info font-weight-bold px-2 py-1">Administrasi</span>
                            </div>
                            <div class="edit-section-body">
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-group-label">Pemilik Alat (Customer)</label>
                                        <input type="text" name="calibration[pemilikAlat]" value="{{ $calibration->pemilikAlat }}" class="form-control form-control-custom">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-group-label">Nomor PO (Purchase Order)</label>
                                        <input type="text" name="calibration[no_po]" value="{{ $calibration->no_po }}" class="form-control form-control-custom font-mono">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-group-label">Nomor Label</label>
                                        <input type="text" name="calibration[no_label]" value="{{ $calibration->no_label }}" class="form-control form-control-custom font-mono">
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label class="form-group-label">No. LK (Lembar Kerja)</label>
                                        <input type="text" name="calibration[LK]" value="{{ $calibration->LK }}" class="form-control form-control-custom font-mono">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-group-label">Form Type</label>
                                        <input type="text" name="calibration[form_type]" value="{{ $calibration->form_type }}" class="form-control form-control-custom font-mono">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-group-label">Jumlah Form</label>
                                        <input type="number" name="calibration[jumlah_form]" value="{{ $calibration->jumlah_form }}" class="form-control form-control-custom font-mono">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-group-label">NIK Petugas</label>
                                        <input type="text" name="calibration[NIK]" value="{{ $calibration->NIK }}" class="form-control form-control-custom font-mono">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 3. Jadwal, Tanggal & Lokasi (Calibrations) -->
                        <div class="edit-section-card sec-slate">
                            <div class="edit-section-header">
                                <div class="section-left">
                                    <div class="section-num">3</div>
                                    <div class="section-icon"><i class="fas fa-calendar-alt"></i></div>
                                    <div>
                                        <span>Jadwal, Tanggal & Lokasi Pelaksanaan</span>
                                        <div style="font-size: 0.72rem; color: #475569; font-weight: 500;">Tanggal Masuk, Tanggal Kalibrasi, Due Date, Tempat Kalibrasi & Lokasi PT</div>
                                    </div>
                                </div>
                                <span class="badge badge-light border text-secondary font-weight-bold px-2 py-1">Jadwal & Lokasi</span>
                            </div>
                            <div class="edit-section-body">
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-group-label">Tanggal Masuk</label>
                                        <input type="date" name="calibration[tanggalMasuk]" value="{{ $calibration->tanggalMasuk ? \Carbon\Carbon::parse($calibration->tanggalMasuk)->format('Y-m-d') : '' }}" class="form-control form-control-custom">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-group-label">Tanggal Kalibrasi</label>
                                        <input type="date" name="calibration[tanggalKalibrasi]" value="{{ $calibration->tanggalKalibrasi ? \Carbon\Carbon::parse($calibration->tanggalKalibrasi)->format('Y-m-d') : '' }}" class="form-control form-control-custom">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-group-label">Next Tanggal Kalibrasi (Due)</label>
                                        <input type="date" name="calibration[NextTanggalKalibrasi]" value="{{ $calibration->NextTanggalKalibrasi ? \Carbon\Carbon::parse($calibration->NextTanggalKalibrasi)->format('Y-m-d') : '' }}" class="form-control form-control-custom">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-group-label">Tempat Kalibrasi</label>
                                        <input type="text" name="calibration[tempatKalibrasi]" value="{{ $calibration->tempatKalibrasi }}" class="form-control form-control-custom" placeholder="In-Lab / On-Site">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-group-label">Lokasi PT</label>
                                        <input type="text" name="calibration[lokasiPT]" value="{{ $calibration->lokasiPT }}" class="form-control form-control-custom">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-group-label">Location Data</label>
                                        <input type="text" name="calibration[location_data]" value="{{ is_array($calibration->location_data) ? json_encode($calibration->location_data) : $calibration->location_data }}" class="form-control form-control-custom font-mono">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 4. Kondisi Lingkungan Suhu (RT) & Kelembaban (RH) (Calibrations) -->
                        <div class="edit-section-card sec-danger">
                            <div class="edit-section-header">
                                <div class="section-left">
                                    <div class="section-num">4</div>
                                    <div class="section-icon"><i class="fas fa-thermometer-half"></i></div>
                                    <div>
                                        <span>Kondisi Lingkungan Suhu (RT) & Kelembaban (RH)</span>
                                        <div style="font-size: 0.72rem; color: #e11d48; font-weight: 500;">Tiga Titik Pengambilan Suhu (°C), Kelembaban (%), dan Kode Standar Thermo-Hygrometer</div>
                                    </div>
                                </div>
                                <span class="badge badge-light border text-danger font-weight-bold px-2 py-1">Lingkungan</span>
                            </div>
                            <div class="edit-section-body">
                                <div class="form-row">
                                    <div class="col-md-2 mb-3">
                                        <label class="form-group-label">Suhu Awal (RT 1) °C</label>
                                        <input type="text" name="calibration[RT_condition1]" value="{{ $calibration->RT_condition1 }}" class="form-control form-control-custom font-mono text-center">
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label class="form-group-label">Suhu Tengah (RT 2) °C</label>
                                        <input type="text" name="calibration[RT_condition2]" value="{{ $calibration->RT_condition2 }}" class="form-control form-control-custom font-mono text-center">
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label class="form-group-label">Suhu Akhir (RT 3) °C</label>
                                        <input type="text" name="calibration[RT_condition3]" value="{{ $calibration->RT_condition3 }}" class="form-control form-control-custom font-mono text-center">
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label class="form-group-label">Kelembaban 1 (RH 1) %</label>
                                        <input type="text" name="calibration[RH_condition1]" value="{{ $calibration->RH_condition1 }}" class="form-control form-control-custom font-mono text-center">
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label class="form-group-label">Kelembaban 2 (RH 2) %</label>
                                        <input type="text" name="calibration[RH_condition2]" value="{{ $calibration->RH_condition2 }}" class="form-control form-control-custom font-mono text-center">
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label class="form-group-label">Kelembaban 3 (RH 3) %</label>
                                        <input type="text" name="calibration[RH_condition3]" value="{{ $calibration->RH_condition3 }}" class="form-control form-control-custom font-mono text-center">
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label class="form-group-label">Kode Thermo-Hygrometer (Standar Lingkungan)</label>
                                        <input type="text" name="calibration[kode_th]" value="{{ $calibration->kode_th }}" class="form-control form-control-custom font-mono" placeholder="Kode Alat Thermo-Hygrometer">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 5. Status, Verifikasi, Approval & Petugas (Calibrations) -->
                        <div class="edit-section-card sec-success">
                            <div class="edit-section-header">
                                <div class="section-left">
                                    <div class="section-num">5</div>
                                    <div class="section-icon"><i class="fas fa-check-double"></i></div>
                                    <div>
                                        <span>Status, Verifikasi, Approval & Petugas</span>
                                        <div style="font-size: 0.72rem; color: #059669; font-weight: 500;">Workflow State, PIC Kalibrasi, Approver, Verifier, Reason & Catatan</div>
                                    </div>
                                </div>
                                <span class="badge badge-light border text-success font-weight-bold px-2 py-1">Approval</span>
                            </div>
                            <div class="edit-section-body">
                                <div class="form-row">
                                    <div class="col-md-3 mb-3">
                                        <label class="form-group-label">Status Kalibrasi</label>
                                        <select name="calibration[status]" class="form-control form-control-custom font-weight-bold">
                                            @foreach(['draft', 'waiting_verification', 'waiting_approval', 'verified', 'approved', 'completed', 'rejected'] as $st)
                                            <option value="{{ $st }}" {{ $calibration->status === $st ? 'selected' : '' }}>
                                                {{ strtoupper($st) }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-group-label">Calibrated By</label>
                                        <input type="text" name="calibration[calibratedBy]" value="{{ $calibration->calibratedBy }}" class="form-control form-control-custom">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-group-label">Tanggal Calibrated</label>
                                        <input type="date" name="calibration[calibrated]" value="{{ $calibration->calibrated ? \Carbon\Carbon::parse($calibration->calibrated)->format('Y-m-d') : '' }}" class="form-control form-control-custom">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-group-label">Verified By</label>
                                        <input type="text" name="calibration[verifiedBy]" value="{{ $calibration->verifiedBy }}" class="form-control form-control-custom">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-group-label">Tanggal Verified</label>
                                        <input type="date" name="calibration[verified]" value="{{ $calibration->verified ? \Carbon\Carbon::parse($calibration->verified)->format('Y-m-d') : '' }}" class="form-control form-control-custom">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-group-label">Approved By</label>
                                        <input type="text" name="calibration[approvedBy]" value="{{ $calibration->approvedBy }}" class="form-control form-control-custom">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-group-label">Tanggal Approved</label>
                                        <input type="date" name="calibration[approved]" value="{{ $calibration->approved ? \Carbon\Carbon::parse($calibration->approved)->format('Y-m-d') : '' }}" class="form-control form-control-custom">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-group-label">Type (Alt)</label>
                                        <input type="text" name="calibration[type]" value="{{ $calibration->type }}" class="form-control form-control-custom">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-group-label">Reason (Alasan Reject / Revisi / Catatan)</label>
                                        <textarea name="calibration[reason]" class="form-control form-control-custom" rows="2">{{ $calibration->reason }}</textarea>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-group-label">Keterangan Tambahan</label>
                                        <textarea name="calibration[keterangan]" class="form-control form-control-custom" rows="2">{{ $calibration->keterangan }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 6. Metadata JSON & Form Tambahan (Calibrations) -->
                        <div class="edit-section-card sec-violet">
                            <div class="edit-section-header">
                                <div class="section-left">
                                    <div class="section-num">6</div>
                                    <div class="section-icon"><i class="fas fa-layer-group"></i></div>
                                    <div>
                                        <span>Metadata Subform & Transaksi (JSON)</span>
                                        <div style="font-size: 0.72rem; color: #7c3aed; font-weight: 500;">additional_forms, subform_identities, dan status_transaction JSON Payload</div>
                                    </div>
                                </div>
                                <span class="badge badge-light border text-dark font-weight-bold px-2 py-1">Payload JSON</span>
                            </div>
                            <div class="edit-section-body">
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-group-label">Additional Forms (JSON)</label>
                                        <textarea name="calibration[additional_forms]" class="form-control form-control-custom font-mono" rows="2">{{ is_array($calibration->additional_forms) ? json_encode($calibration->additional_forms) : $calibration->additional_forms }}</textarea>
                                        <small class="text-muted">Contoh: <code>["caliper_tambahan"]</code></small>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-group-label">Subform Identities (JSON)</label>
                                        <textarea name="calibration[subform_identities]" class="form-control form-control-custom font-mono" rows="2">{{ is_array($calibration->subform_identities) ? json_encode($calibration->subform_identities) : $calibration->subform_identities }}</textarea>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-group-label">Status Transaction (JSON)</label>
                                        <textarea name="calibration[status_transaction]" class="form-control form-control-custom font-mono" rows="2">{{ is_array($calibration->status_transaction) ? json_encode($calibration->status_transaction) : $calibration->status_transaction }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 7. Seluruh Kolom Lainnya Tabel Calibrations (Dinamis Database) -->
                        @php
                            $handledCols = [
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
                            $allCalAttrs = $calibration->getAttributes();
                            $remainingCalCols = array_diff(array_keys($allCalAttrs), $handledCols);
                        @endphp

                        @if(!empty($remainingCalCols))
                        <div class="edit-section-card sec-dark">
                            <div class="edit-section-header">
                                <div class="section-left">
                                    <div class="section-num">7</div>
                                    <div class="section-icon"><i class="fas fa-database"></i></div>
                                    <div>
                                        <span>Kolom Database Lainnya (Tabel Calibrations)</span>
                                        <div style="font-size: 0.72rem; color: #94a3b8; font-weight: 500;">Kolom tambahan yang tersedia langsung pada skema database</div>
                                    </div>
                                </div>
                                <span class="badge badge-light border text-dark font-weight-bold px-2 py-1">{{ count($remainingCalCols) }} Kolom Dinamis</span>
                            </div>
                            <div class="edit-section-body">
                                <div class="form-row">
                                    @foreach($remainingCalCols as $remCol)
                                    @php
                                        $val = $allCalAttrs[$remCol];
                                        if (is_array($val) || is_object($val)) {
                                            $val = json_encode($val);
                                        }
                                    @endphp
                                    <div class="col-md-3 mb-3">
                                        <label class="form-group-label" style="font-size: 0.72rem;">{{ $remCol }}</label>
                                        <input type="text" name="calibration[{{ $remCol }}]" value="{{ $val }}" class="form-control form-control-sm form-control-custom">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- 8. Head Edit -->
                        @if($joinedData['head']->count() > 0)
                        <div class="edit-section-card sec-success">
                            <div class="edit-section-header">
                                <div class="section-left">
                                    <div class="section-num">8</div>
                                    <div class="section-icon"><i class="fas fa-heading"></i></div>
                                    <div>
                                        <span>Data Tabel Head</span>
                                        <div style="font-size: 0.72rem; color: #059669; font-weight: 500;">Model: <code>{{ $joinedData['models']['head'] }}</code></div>
                                    </div>
                                </div>
                                <span class="badge badge-light border text-success font-weight-bold px-2 py-1">{{ $joinedData['head']->count() }} Record</span>
                            </div>
                            <div class="edit-section-body">
                                @foreach($joinedData['head'] as $hIdx => $head)
                                <div class="p-3 bg-white rounded-lg mb-3 border shadow-sm">
                                    <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                                        <span class="font-weight-bold text-success" style="font-size: 0.88rem;">
                                            <i class="fas fa-cube mr-1"></i> Head Record #{{ $hIdx + 1 }}
                                            @if(!empty($head->form_index))
                                                <span class="badge badge-light border text-muted ml-1">Form Index: {{ $head->form_index }}</span>
                                            @endif
                                        </span>
                                        <span class="badge badge-light border font-mono text-muted">ID: {{ $head->id }}</span>
                                    </div>
                                    <input type="hidden" name="head[{{ $hIdx }}][id]" value="{{ $head->id }}">
                                    <div class="form-row">
                                        @foreach($head->getAttributes() as $k => $v)
                                        @if(!in_array($k, ['id', 'calibration_id', 'created_at', 'updated_at', 'form_index']))
                                        <div class="col-md-4 mb-2">
                                            <label class="form-group-label" style="font-size: 0.72rem;">{{ $k }}</label>
                                            <input type="text" name="head[{{ $hIdx }}][{{ $k }}]" value="{{ $v }}" class="form-control form-control-sm form-control-custom">
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- 9. Data Detail Pengukuran Edit (Grid Input) -->
                        @if($joinedData['detail']->isNotEmpty())
                        <div class="edit-section-card sec-primary">
                            <div class="edit-section-header">
                                <div class="section-left">
                                    <div class="section-num">9</div>
                                    <div class="section-icon"><i class="fas fa-list-ol"></i></div>
                                    <div>
                                        <span>Data Tabel Detail Pengukuran (Editable Grid)</span>
                                        <div style="font-size: 0.72rem; color: #4f46e5; font-weight: 500;">Ubah langsung titik ukur, pembacaan, dan nilai pengukuran</div>
                                    </div>
                                </div>
                                <span class="badge badge-light border text-primary font-weight-bold px-2 py-1 font-mono">{{ $totalDetailRows }} Baris Pengukuran</span>
                            </div>
                            <div class="edit-section-body">
                                <div class="alert alert-info py-2 px-3 mb-3 d-flex align-items-center" style="border-radius: 9px; font-size: 0.82rem; background: rgba(79,70,229,0.06); border: 1px solid rgba(79,70,229,0.18); color: #3730a3;">
                                    <i class="fas fa-info-circle mr-2 text-primary"></i>
                                    <div>Super Admin dapat mengedit langsung seluruh angka pengukuran pada kotak tabel di bawah. Perubahan akan disimpan saat menekan tombol Simpan.</div>
                                </div>

                                @foreach($joinedData['detail'] as $tblName => $rows)
                                    @php
                                        $firstRow = $rows->first();
                                        $columns = $firstRow ? array_keys($firstRow->getAttributes()) : [];
                                        $editableCols = array_diff($columns, ['id', 'calibration_id', 'created_at', 'updated_at', 'head_caliper_id']);
                                    @endphp
                                    <div class="border rounded-lg p-2 mb-3 bg-white shadow-sm">
                                        <div class="d-flex justify-content-between align-items-center mb-2 px-2 py-1 border-bottom">
                                            <strong class="text-primary font-weight-bold" style="font-size: 0.84rem;">
                                                <i class="fas fa-table mr-1"></i> {{ $tblName }}
                                            </strong>
                                            <span class="badge badge-light border text-muted small font-mono">{{ $rows->count() }} Baris</span>
                                        </div>
                                        <div class="table-responsive" style="max-height: 480px;">
                                            <table class="table table-sm table-bordered bg-white mb-0" style="font-size: 0.82rem;">
                                                <thead class="bg-light sticky-top">
                                                    <tr>
                                                        <th width="40" class="text-center text-muted">#</th>
                                                        @foreach($editableCols as $col)
                                                        <th class="small font-weight-bold text-nowrap text-center text-muted" style="background: #f8fafc;">{{ $col }}</th>
                                                        @endforeach
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($rows as $rIdx => $row)
                                                    <tr>
                                                        <td class="text-center text-muted font-mono small align-middle" style="background: #fafbfc;">
                                                            {{ $rIdx + 1 }}
                                                            <input type="hidden" name="detail[{{ $tblName }}][{{ $row->id }}][id]" value="{{ $row->id }}">
                                                        </td>
                                                        @foreach($editableCols as $col)
                                                        <td class="p-1 align-middle">
                                                            <input type="text" 
                                                                   name="detail[{{ $tblName }}][{{ $row->id }}][{{ $col }}]" 
                                                                   value="{{ $row->$col }}" 
                                                                   class="form-control form-control-sm text-center font-mono py-1 px-2 border" 
                                                                   style="min-width: 90px; background-color: #fafbfc; border-radius: 6px;"
                                                                   placeholder="-">
                                                        </td>
                                                        @endforeach
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- 10. Add Edit -->
                        @if($joinedData['add']->count() > 0)
                        <div class="edit-section-card sec-amber">
                            <div class="edit-section-header">
                                <div class="section-left">
                                    <div class="section-num">10</div>
                                    <div class="section-icon"><i class="fas fa-puzzle-piece"></i></div>
                                    <div>
                                        <span>Data Tabel Add</span>
                                        <div style="font-size: 0.72rem; color: #b45309; font-weight: 500;">Model: <code>{{ $joinedData['models']['add'] }}</code></div>
                                    </div>
                                </div>
                                <span class="badge badge-light border text-warning font-weight-bold px-2 py-1">{{ $joinedData['add']->count() }} Record</span>
                            </div>
                            <div class="edit-section-body">
                                @foreach($joinedData['add'] as $aIdx => $add)
                                <div class="p-3 bg-white rounded-lg mb-3 border shadow-sm">
                                    <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                                        <strong class="font-weight-bold text-warning" style="font-size: 0.88rem;">
                                            <i class="fas fa-cube mr-1"></i> Add Record #{{ $aIdx + 1 }}
                                        </strong>
                                        <span class="badge badge-light border font-mono text-muted">ID: {{ $add->id }}</span>
                                    </div>
                                    <input type="hidden" name="add[{{ $aIdx }}][id]" value="{{ $add->id }}">
                                    <div class="form-row">
                                        @foreach($add->getAttributes() as $k => $v)
                                        @if(!in_array($k, ['id', 'calibration_id', 'created_at', 'updated_at', 'form_index']))
                                        <div class="col-md-4 mb-2">
                                            <label class="form-group-label" style="font-size: 0.72rem;">{{ $k }}</label>
                                            <input type="text" name="add[{{ $aIdx }}][{{ $k }}]" value="{{ $v }}" class="form-control form-control-sm form-control-custom">
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Sticky/Bottom Save Action Bar -->
                        <div class="save-bar mt-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="section-icon" style="background: rgba(16,185,129,0.18); color: #059669; width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="save-bar-info">
                                    <h6>Siap Menyimpan Semua Perubahan?</h6>
                                    <small>Pastikan data yang diisi telah valid sebelum menekan tombol simpan.</small>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success btn-lg font-weight-bold px-5 py-2" style="border-radius: 10px; box-shadow: 0 4px 16px rgba(16,185,129,0.4);">
                                <i class="fas fa-save mr-1"></i> Simpan Semua Perubahan
                            </button>
                        </div>
                    </form>
                </div>

                <!-- TAB 2: TABEL CALIBRATIONS INDUK -->
                <div class="tab-pane fade" id="tab-calibrations" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="font-weight-bold text-dark mb-0">
                                <i class="fas fa-database text-primary mr-2"></i> Field Tersimpan Tabel Induk <code>calibrations</code>
                            </h5>
                            <small class="text-muted">Daftar seluruh atribut dan kolom yang tersimpan dalam row kalibrasi ini.</small>
                        </div>
                        <span class="badge badge-light border text-primary font-weight-bold px-3 py-2" style="border-radius: 20px;">
                            {{ count($calibration->getAttributes()) }} Kolom Database
                        </span>
                    </div>

                    <div class="detail-table-wrapper">
                        <table class="table data-table-raw">
                            <thead>
                                <tr>
                                    <th width="50" class="text-center">#</th>
                                    <th width="300">Kolom Database (Field)</th>
                                    <th>Nilai Tersimpan (Stored Value)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $rowIdx = 1; @endphp
                                @foreach($calibration->getAttributes() as $field => $val)
                                <tr>
                                    <td class="text-center text-muted font-mono" style="font-size: 0.78rem;">{{ $rowIdx++ }}</td>
                                    <td><span class="col-key">{{ $field }}</span></td>
                                    <td class="col-val">
                                        @if(is_array($val) || is_object($val))
                                            <pre class="mb-0 small bg-light p-2 rounded border font-mono" style="max-height: 200px; overflow-y: auto;">{{ json_encode($val, JSON_PRETTY_PRINT) }}</pre>
                                        @elseif($val === null)
                                            <span class="null-badge">null</span>
                                        @elseif($val === '')
                                            <span class="null-badge">"" (empty string)</span>
                                        @else
                                            <span class="font-weight-bold">{{ $val }}</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- TAB 3: TABEL HEAD -->
                <div class="tab-pane fade" id="tab-head" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="font-weight-bold text-dark mb-0">
                                <i class="fas fa-heading text-success mr-2"></i> Data Tabel Head
                                @if($joinedData['models']['head'])
                                    <code class="text-success font-weight-bold">({{ $joinedData['models']['head'] }})</code>
                                @endif
                            </h5>
                            <small class="text-muted">Data header spesifikasi / standard equipment yang berelasi dengan kalibrasi ini.</small>
                        </div>
                        <span class="badge badge-light border text-success font-weight-bold px-3 py-2 font-mono" style="border-radius: 20px;">
                            {{ $joinedData['head']->count() }} Record
                        </span>
                    </div>

                    @if($joinedData['head']->count() > 0)
                        @foreach($joinedData['head'] as $index => $head)
                        <div class="edit-section-card sec-success mb-4">
                            <div class="edit-section-header">
                                <span class="font-weight-bold">
                                    <i class="fas fa-cube mr-1"></i> Record Head #{{ $index + 1 }} 
                                    @if(!empty($head->form_index))
                                        <span class="badge badge-light border text-muted ml-1 font-weight-normal">Form Index: {{ $head->form_index }}</span>
                                    @endif
                                </span>
                                <span class="badge badge-light border font-mono text-muted">ID: {{ $head->id ?? '-' }}</span>
                            </div>
                            <div class="detail-table-wrapper" style="border: none; border-radius: 0;">
                                <table class="table data-table-raw">
                                    <thead>
                                        <tr>
                                            <th width="300">Field</th>
                                            <th>Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($head->getAttributes() as $k => $v)
                                        <tr>
                                            <td><span class="col-key" style="color: #059669;">{{ $k }}</span></td>
                                            <td class="col-val">
                                                @if(is_array($v) || is_object($v))
                                                    <pre class="mb-0 small bg-light p-2 rounded border font-mono">{{ json_encode($v, JSON_PRETTY_PRINT) }}</pre>
                                                @elseif($v === null)
                                                    <span class="null-badge">null</span>
                                                @else
                                                    {{ $v }}
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center py-5 bg-light rounded-lg border">
                            <i class="fas fa-info-circle fa-2x mb-2 text-muted"></i>
                            <p class="text-muted mb-0">Tidak ditemukan record data Head untuk ID Kalibrasi <strong>{{ $calibration->id }}</strong>.</p>
                        </div>
                    @endif
                </div>

                <!-- TAB 4: TABEL DETAIL PENGUKURAN -->
                <div class="tab-pane fade" id="tab-detail" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="font-weight-bold text-dark mb-0">
                                <i class="fas fa-list-ol text-primary mr-2"></i> Data Tabel Detail Pengukuran
                                @if(!empty($joinedData['models']['detail']))
                                    <code class="text-primary font-weight-bold">({{ implode(', ', $joinedData['models']['detail']) }})</code>
                                @endif
                            </h5>
                            <small class="text-muted">Data pembacaan dan titik ukur riil kalibrasi.</small>
                        </div>
                        <span class="badge badge-light border text-primary font-weight-bold px-3 py-2 font-mono" style="border-radius: 20px;">
                            {{ $totalDetailRows }} Baris Pengukuran
                        </span>
                    </div>

                    @if($joinedData['detail']->isNotEmpty())
                        @foreach($joinedData['detail'] as $tblName => $rows)
                        <div class="edit-section-card sec-primary mb-4">
                            <div class="edit-section-header">
                                <span class="font-weight-bold"><i class="fas fa-table mr-1 text-primary"></i> {{ $tblName }}</span>
                                <span class="badge badge-light border text-primary font-mono">{{ $rows->count() }} Baris</span>
                            </div>
                            <div class="detail-table-wrapper" style="border: none; border-radius: 0; max-height: 520px; overflow-y: auto;">
                                @php
                                    $firstRow = $rows->first();
                                    $columns = $firstRow ? array_keys($firstRow->getAttributes()) : [];
                                @endphp
                                <table class="table data-table-raw">
                                    <thead class="sticky-top">
                                        <tr>
                                            <th width="40" class="text-center">#</th>
                                            @foreach($columns as $col)
                                            <th class="text-center">{{ $col }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($rows as $rIdx => $row)
                                        <tr>
                                            <td class="text-center text-muted font-mono" style="font-size: 0.76rem; background: #fafbfc;">{{ $rIdx + 1 }}</td>
                                            @foreach($columns as $col)
                                            <td class="text-center font-mono" style="font-size: 0.82rem;">{{ $row->$col !== null ? $row->$col : '-' }}</td>
                                            @endforeach
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center py-5 bg-light rounded-lg border">
                            <i class="fas fa-info-circle fa-2x mb-2 text-muted"></i>
                            <p class="text-muted mb-0">Tidak ditemukan record data Detail pengukuran untuk ID Kalibrasi <strong>{{ $calibration->id }}</strong>.</p>
                        </div>
                    @endif
                </div>

                <!-- TAB 5: TABEL ADD -->
                <div class="tab-pane fade" id="tab-add" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="font-weight-bold text-dark mb-0">
                                <i class="fas fa-puzzle-piece text-warning mr-2"></i> Data Tabel Add
                                @if($joinedData['models']['add'])
                                    <code class="text-warning font-weight-bold">({{ $joinedData['models']['add'] }})</code>
                                @endif
                            </h5>
                            <small class="text-muted">Data pelengkap spesifik seperti ketidakpastian atau parameter uji tambahan.</small>
                        </div>
                        <span class="badge badge-light border text-warning font-weight-bold px-3 py-2 font-mono" style="border-radius: 20px;">
                            {{ $joinedData['add']->count() }} Record
                        </span>
                    </div>

                    @if($joinedData['add']->count() > 0)
                        @foreach($joinedData['add'] as $index => $add)
                        <div class="edit-section-card sec-amber mb-4">
                            <div class="edit-section-header">
                                <span class="font-weight-bold"><i class="fas fa-cube mr-1"></i> Record Add #{{ $index + 1 }}</span>
                                <span class="badge badge-light border font-mono text-muted">ID: {{ $add->id ?? '-' }}</span>
                            </div>
                            <div class="detail-table-wrapper" style="border: none; border-radius: 0;">
                                <table class="table data-table-raw">
                                    <thead>
                                        <tr>
                                            <th width="300">Field</th>
                                            <th>Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($add->getAttributes() as $k => $v)
                                        <tr>
                                            <td><span class="col-key" style="color: #d97706;">{{ $k }}</span></td>
                                            <td class="col-val">
                                                @if(is_array($v) || is_object($v))
                                                    <pre class="mb-0 small bg-light p-2 rounded border font-mono">{{ json_encode($v, JSON_PRETTY_PRINT) }}</pre>
                                                @elseif($v === null)
                                                    <span class="null-badge">null</span>
                                                @else
                                                    {{ $v }}
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center py-5 bg-light rounded-lg border">
                            <i class="fas fa-info-circle fa-2x mb-2 text-muted"></i>
                            <p class="text-muted mb-0">
                                @if($joinedData['models']['add'])
                                    Tidak ada data di tabel Add (Model: {{ $joinedData['models']['add'] }}) untuk kalibrasi ini.
                                @else
                                    Jenis alat ini (<code>{{ $joinedData['form_type'] }}</code>) tidak memiliki tabel Add terpisah.
                                @endif
                            </p>
                        </div>
                    @endif
                </div>

                <!-- TAB 6: SUBFORMS -->
                @if(!empty($joinedData['subforms']))
                <div class="tab-pane fade" id="tab-subforms" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="font-weight-bold text-dark mb-0">
                                <i class="fas fa-layer-group text-secondary mr-2"></i> Form Tambahan Terlampir (Subforms)
                            </h5>
                            <small class="text-muted">Data instrumen / child sheet yang terlampir pada form induk kalibrasi.</small>
                        </div>
                        <span class="badge badge-light border text-secondary font-weight-bold px-3 py-2" style="border-radius: 20px;">
                            {{ count($joinedData['subforms']) }} Subform Terlampir
                        </span>
                    </div>

                    @foreach($joinedData['subforms'] as $subType => $subData)
                    <div class="edit-section-card sec-dark mb-4">
                        <div class="edit-section-header">
                            <span class="font-weight-bold">
                                <i class="fas fa-file-alt mr-1"></i> Form: {{ ucwords(str_replace('_', ' ', $subType)) }}
                            </span>
                            <span class="badge badge-light border text-muted font-mono">{{ $subType }}</span>
                        </div>
                        <div class="edit-section-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <h6 class="font-weight-bold text-success mb-2" style="font-size: 0.84rem;">
                                        <i class="fas fa-heading mr-1"></i> Subform Head ({{ $subData['head']->count() }} record)
                                    </h6>
                                    @if($subData['head']->count() > 0)
                                        <pre class="bg-white p-3 small border rounded font-mono shadow-sm" style="max-height: 260px; overflow-y: auto;">{{ json_encode($subData['head'], JSON_PRETTY_PRINT) }}</pre>
                                    @else
                                        <p class="text-muted small mb-0">Tidak ada data head subform.</p>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h6 class="font-weight-bold text-primary mb-2" style="font-size: 0.84rem;">
                                        <i class="fas fa-list-ol mr-1"></i> Subform Detail
                                    </h6>
                                    @if(!empty($subData['detail']) && $subData['detail']->isNotEmpty())
                                        <pre class="bg-white p-3 small border rounded font-mono shadow-sm" style="max-height: 260px; overflow-y: auto;">{{ json_encode($subData['detail'], JSON_PRETTY_PRINT) }}</pre>
                                    @else
                                        <p class="text-muted small mb-0">Tidak ada data detail subform.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                <!-- TAB 7: RAW JSON -->
                <div class="tab-pane fade" id="tab-json" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="font-weight-bold text-dark mb-0">
                                <i class="fas fa-code text-danger mr-2"></i> Raw JSON Payload (Joined Object)
                            </h5>
                            <small class="text-muted">Representasi utuh seluruh entitas kalibrasi beserta relasi join untuk integrasi & audit data.</small>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <button type="button" class="btn btn-sm btn-outline-primary font-weight-bold px-3 py-1 mr-2" onclick="copyShowRawJson()" style="border-radius: 8px;">
                                <i class="fas fa-copy mr-1"></i> Salin JSON
                            </button>
                            <a href="{{ route('control-data.export-json', $calibration->id) }}" class="btn btn-sm btn-dark font-weight-bold px-3 py-1" style="border-radius: 8px;">
                                <i class="fas fa-download mr-1"></i> Unduh File .json
                            </a>
                        </div>
                    </div>
                    <pre class="raw-json-box mb-0 shadow-sm" id="showRawJsonContent">{{ json_encode(['calibration' => $calibration, 'joined' => $joinedData], JSON_PRETTY_PRINT) }}</pre>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function switchToEditTab() {
        $('#tab-edit-link').tab('show');
    }

    function submitShowUpdate(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Menyimpan Perubahan...',
            text: 'Sedang memperbarui database...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        const formData = $('#formShowUpdate').serialize();

        $.ajax({
            url: '{{ route("control-data.update", $calibration->id) }}',
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
                        text: res.message || 'Data berhasil disimpan.',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire('Gagal Menyimpan', res.message || 'Terjadi kesalahan.', 'error');
                }
            },
            error: function(xhr) {
                Swal.close();
                let errMsg = 'Gagal menyimpan data';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errMsg += ': ' + xhr.responseJSON.message;
                }
                Swal.fire('Error', errMsg, 'error');
            }
        });
    }

    function copyShowRawJson() {
        const text = document.getElementById('showRawJsonContent').textContent;
        navigator.clipboard.writeText(text).then(() => {
            Swal.fire({
                icon: 'success',
                title: 'Tersalin!',
                text: 'JSON data berhasil disalin ke clipboard.',
                timer: 1500,
                showConfirmButton: false
            });
        });
    }
</script>
@endpush
