@extends('layouts.app')
@section('title', 'File Sertifikat Kalibrasi')

@push('styles')
<style>
    /* ══════════════════════════════════════════════
   SERTIFIKAT KALIBRASI — Premium File Manager
   ══════════════════════════════════════════════ */
    :root {
        --red-1: #7f1d1d;
        --red-2: #b91c1c;
        --red-3: #dc2626;
        --red-4: #ef4444;
        --red-light: #fef2f2;
        --red-pale: #fecaca;
        --blue-3: #2563eb;
        --text-dark: #1e293b;
        --text-body: #475569;
        --text-muted: #94a3b8;
        --border: #e2e8f0;
        --bg-page: #f8fafc;
        --white: #ffffff;
        --radius-xl: 20px;
        --radius-lg: 14px;
        --radius-md: 10px;
        --radius-sm: 8px;
        --shadow-sm: 0 2px 8px rgba(0, 0, 0, .06);
        --shadow-md: 0 4px 20px rgba(0, 0, 0, .10);
        --shadow-lg: 0 10px 40px rgba(0, 0, 0, .14);
        --transition: all .25s cubic-bezier(.4, 0, .2, 1);
    }

    /* ── Page Hero ── */
    .sk-hero {
        background: linear-gradient(135deg, #7f1d1d 0%, #b91c1c 55%, #dc2626 100%);
        border-radius: var(--radius-xl);
        padding: 2rem 2.5rem;
        margin-bottom: 1.75rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 12px 36px rgba(185, 28, 28, .28);
    }

    .sk-hero::before {
        content: '';
        position: absolute;
        top: -60px;
        right: -60px;
        width: 240px;
        height: 240px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(255, 255, 255, .12) 0%, transparent 70%);
    }

    .sk-hero-icon {
        width: 64px;
        height: 64px;
        border-radius: 16px;
        background: rgba(255, 255, 255, .2);
        border: 1px solid rgba(255, 255, 255, .3);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        color: #fff;
        flex-shrink: 0;
        backdrop-filter: blur(8px);
    }

    .sk-hero-title {
        font-size: 1.6rem;
        font-weight: 800;
        color: #fff;
    }

    .sk-hero-sub {
        font-size: .85rem;
        color: rgba(255, 255, 255, .75);
        margin-top: .25rem;
    }

    /* ── Breadcrumb ── */
    .sk-breadcrumb {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: .35rem;
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        padding: .65rem 1.1rem;
        margin-bottom: 1.25rem;
        box-shadow: var(--shadow-sm);
        font-size: .82rem;
    }

    .sk-breadcrumb a {
        color: var(--blue-3);
        font-weight: 600;
        text-decoration: none;
    }

    .sk-breadcrumb a:hover {
        text-decoration: underline;
    }

    .sk-breadcrumb .sep {
        color: var(--text-muted);
    }

    .sk-breadcrumb .current {
        color: var(--text-dark);
        font-weight: 700;
    }

    /* ── Toolbar ── */
    .sk-toolbar {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: .75rem;
        margin-bottom: 1.25rem;
    }

    .sk-search-wrap {
        position: relative;
        flex: 1;
        min-width: 200px;
    }

    .sk-search-wrap .search-icon {
        position: absolute;
        left: .85rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
        font-size: .85rem;
        pointer-events: none;
    }

    .sk-search-wrap input {
        width: 100%;
        padding: .55rem 1rem .55rem 2.4rem;
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        font-size: .86rem;
        color: var(--text-dark);
        background: var(--white);
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
    }

    .sk-search-wrap input:focus {
        outline: none;
        border-color: #93c5fd;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, .12);
    }

    .btn-sk {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        padding: .55rem 1.1rem;
        border-radius: var(--radius-md);
        font-size: .84rem;
        font-weight: 600;
        cursor: pointer;
        border: 1px solid transparent;
        transition: var(--transition);
        text-decoration: none;
        white-space: nowrap;
    }

    .btn-sk:hover {
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    .btn-sk-primary {
        background: var(--red-3);
        color: #fff;
    }

    .btn-sk-primary:hover {
        background: var(--red-2);
        color: #fff;
    }

    .btn-sk-outline {
        background: var(--white);
        color: var(--text-body);
        border-color: var(--border);
    }

    .btn-sk-outline:hover {
        background: #f8fafc;
        color: var(--text-dark);
    }

    /* ── Stats bar ── */
    .sk-stats {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        margin-bottom: 1.25rem;
    }

    .sk-stat-pill {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 50px;
        padding: .4rem 1rem;
        font-size: .78rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: .45rem;
        box-shadow: var(--shadow-sm);
        color: var(--text-body);
    }

    .sk-stat-pill .dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
    }

    .dot-folder {
        background: #f59e0b;
    }

    .dot-pdf {
        background: var(--red-3);
    }

    .dot-total {
        background: var(--blue-3);
    }

    /* ── File/Folder Grid ── */
    .sk-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    /* ── Folder Card ── */
    .sk-folder-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 1.1rem 1.2rem;
        display: flex;
        flex-direction: column;
        transition: var(--transition);
        cursor: pointer;
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }

    .sk-folder-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #f59e0b, #fbbf24);
        border-radius: var(--radius-lg) var(--radius-lg) 0 0;
    }

    .sk-folder-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-md);
        border-color: #fde68a;
    }

    .sk-folder-card.drag-over {
        border: 2px dashed var(--red-3) !important;
        background: var(--red-light) !important;
        transform: scale(1.03) !important;
        box-shadow: var(--shadow-md) !important;
    }

    .sk-folder-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: linear-gradient(135deg, #fef3c7, #fffbeb);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        color: #d97706;
        margin-bottom: .75rem;
        border: 1px solid #fde68a;
    }

    .sk-folder-name {
        font-size: .88rem;
        font-weight: 700;
        color: var(--text-dark);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .sk-folder-meta {
        font-size: .74rem;
        color: var(--text-muted);
        margin-top: .2rem;
    }

    .sk-folder-actions {
        display: flex;
        gap: .4rem;
        margin-top: .85rem;
        opacity: 0;
        transition: var(--transition);
    }

    .sk-folder-card:hover .sk-folder-actions {
        opacity: 1;
    }

    /* ── PDF Card ── */
    .sk-pdf-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 1.1rem 1.2rem;
        display: flex;
        flex-direction: column;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }

    .sk-pdf-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #dc2626, #ef4444);
        border-radius: var(--radius-lg) var(--radius-lg) 0 0;
    }

    .sk-pdf-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-md);
        border-color: #fca5a5;
    }

    .sk-pdf-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: linear-gradient(135deg, #fef2f2, #fff5f5);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        color: #dc2626;
        margin-bottom: .75rem;
        border: 1px solid #fecaca;
    }

    .sk-pdf-name {
        font-size: .84rem;
        font-weight: 600;
        color: var(--text-dark);
        word-break: break-word;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        cursor: pointer;
        transition: var(--transition);
    }

    .sk-pdf-name:hover {
        color: var(--red-3);
        text-decoration: underline;
    }

    .sk-pdf-meta {
        font-size: .73rem;
        color: var(--text-muted);
        margin-top: .3rem;
    }

    .sk-pdf-actions {
        display: flex;
        gap: .4rem;
        margin-top: .85rem;
        flex-wrap: wrap;
    }

    /* ── Action buttons inside card ── */
    .btn-card {
        display: inline-flex;
        align-items: center;
        gap: .3rem;
        padding: .32rem .7rem;
        border-radius: 6px;
        font-size: .74rem;
        font-weight: 600;
        cursor: pointer;
        border: 1px solid transparent;
        transition: var(--transition);
        text-decoration: none;
    }

    .btn-card:hover {
        transform: translateY(-1px);
        text-decoration: none;
    }

    .btn-card-view {
        background: #e0f2fe;
        color: #0369a1;
        border-color: #bae6fd;
    }

    .btn-card-view:hover {
        background: #bae6fd;
        color: #0369a1;
    }

    .btn-card-dl {
        background: #dbeafe;
        color: #1d4ed8;
        border-color: #bfdbfe;
    }

    .btn-card-dl:hover {
        background: #bfdbfe;
        color: #1d4ed8;
    }

    .btn-card-edit {
        background: #fef3c7;
        color: #d97706;
        border-color: #fde68a;
    }

    .btn-card-edit:hover {
        background: #fde68a;
        color: #d97706;
    }

    .btn-card-del {
        background: #fee2e2;
        color: #dc2626;
        border-color: #fca5a5;
    }

    .btn-card-del:hover {
        background: #fca5a5;
        color: #b91c1c;
    }

    /* ── Empty state ── */
    .sk-empty {
        grid-column: 1/-1;
        text-align: center;
        padding: 3.5rem 1rem;
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-sm);
    }

    .sk-empty i {
        font-size: 3rem;
        opacity: .18;
        color: var(--red-3);
        margin-bottom: 1rem;
        display: block;
    }

    .sk-empty p {
        font-size: .9rem;
        color: var(--text-muted);
        margin: 0;
    }

    /* ── Modal ── */
    .sk-modal .modal-content {
        border-radius: var(--radius-xl);
        border: none;
        box-shadow: 0 20px 60px rgba(0, 0, 0, .18);
    }

    .sk-modal .modal-header {
        background: linear-gradient(135deg, #fef2f2, #fff);
        border-bottom: 1px solid #fecaca;
        border-radius: var(--radius-xl) var(--radius-xl) 0 0;
        padding: 1.25rem 1.5rem;
    }

    .sk-modal .modal-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--text-dark);
    }

    .sk-modal .modal-body {
        padding: 1.5rem;
    }

    .sk-modal .modal-footer {
        padding: .9rem 1.5rem;
        border-top: 1px solid var(--border);
    }

    .sk-form-label {
        font-size: .82rem;
        font-weight: 700;
        color: var(--text-body);
        margin-bottom: .4rem;
        display: block;
    }

    .sk-form-input {
        width: 100%;
        padding: .6rem .9rem;
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        font-size: .87rem;
        color: var(--text-dark);
        background: var(--white);
        transition: var(--transition);
    }

    .sk-form-input:focus {
        outline: none;
        border-color: #93c5fd;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, .12);
    }

    /* Error banner */
    .sk-error {
        background: #fef2f2;
        border: 1px solid #fecaca;
        border-radius: var(--radius-lg);
        padding: 1.25rem 1.5rem;
        color: #b91c1c;
        font-size: .86rem;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: flex-start;
        gap: .75rem;
    }

    .sk-error i {
        font-size: 1.1rem;
        flex-shrink: 0;
        margin-top: .1rem;
    }

    /* Section header */
    .sk-section-hd {
        font-size: .72rem;
        font-weight: 800;
        letter-spacing: 1.8px;
        text-transform: uppercase;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: .6rem;
        margin-bottom: .75rem;
    }

    .sk-section-hd::after {
        content: '';
        flex: 1;
        height: 1px;
        background: linear-gradient(90deg, var(--border), transparent);
    }

    .sk-breadcrumb-item.drag-over-crumb {
        background: var(--red-light) !important;
        border: 1px dashed var(--red-3) !important;
        border-radius: 4px;
        padding: 2px 6px;
        color: var(--red-3) !important;
        font-weight: 700;
        transform: scale(1.05);
        display: inline-block;
        transition: var(--transition);
    }
</style>
@endpush

@section('content')
<div class="sk-hero">
    <div class="d-flex align-items-center" style="gap:1.25rem; position:relative; z-index:1;">
        <div class="sk-hero-icon">
            <i class="fas fa-file-pdf"></i>
        </div>
        <div>
            <div class="sk-hero-title">File Sertifikat Kalibrasi</div>
            <div class="sk-hero-sub">
                <i class="fas fa-server mr-1"></i>
                cPanel Storage: /sertifikat_kalibrasi_digital
            </div>
        </div>
        <div class="ml-auto d-flex" style="gap:.6rem; flex-shrink:0;">
            <button class="btn-sk btn-sk-outline" id="btnUploadFile" style="background:#white; color:var(--red-3); border-color:var(--red-pale);">
                <i class="fas fa-upload"></i> Upload PDF
            </button>
            <button class="btn-sk btn-sk-primary" id="btnCreateFolder">
                <i class="fas fa-folder-plus"></i> Buat Folder
            </button>
        </div>
    </div>
</div>

{{-- Error --}}
@if($error)
<div class="sk-error mb-4" style="box-shadow: var(--shadow-sm);">
    <i class="fas fa-exclamation-triangle"></i>
    <div>
        <strong>Terjadi Kesalahan Akses Folder:</strong><br>
        {{ $error }}
    </div>
</div>
@endif

{{-- Flash messages --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show border-0 rounded-lg shadow-sm mb-3" role="alert">
    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
</div>
@endif
@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show border-0 rounded-lg shadow-sm mb-3" role="alert">
    <i class="fas fa-times-circle mr-2"></i>{{ session('error') }}
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
</div>
@endif

{{-- Breadcrumb --}}
<div class="sk-breadcrumb">
    <i class="fas fa-map-marker-alt" style="color:var(--red-3); margin-right: 0.25rem;"></i>
    @foreach($breadcrumbs as $i => $crumb)
    @if(!$loop->last)
    <a href="{{ route('sertifikat-kalibrasi.index', ['folder' => $crumb['folder']]) }}" class="sk-breadcrumb-item" data-folder="{{ $crumb['folder'] ?? '' }}">
        {{ $crumb['label'] }}
    </a>
    <span class="sep"><i class="fas fa-chevron-right" style="font-size:.65rem;"></i></span>
    @else
    <span class="current sk-breadcrumb-item" data-folder="{{ $crumb['folder'] ?? '' }}">{{ $crumb['label'] }}</span>
    @endif
    @endforeach
</div>

{{-- Toolbar --}}
<div class="sk-toolbar">
    <form method="GET" action="{{ route('sertifikat-kalibrasi.index') }}" class="d-contents" style="flex:1; display:contents;">
        <input type="hidden" name="folder" value="{{ $folder }}">
        <div class="sk-search-wrap">
            <i class="fas fa-search search-icon"></i>
            <input type="text" name="search" value="{{ $search }}" placeholder="Cari file atau folder..." id="searchInput">
        </div>
        <button type="submit" class="btn-sk btn-sk-outline">
            <i class="fas fa-search"></i> Cari
        </button>
    </form>
    @if($search)
    <a href="{{ route('sertifikat-kalibrasi.index', ['folder' => $folder]) }}" class="btn-sk btn-sk-outline">
        <i class="fas fa-times"></i> Reset
    </a>
    @endif
</div>

{{-- Stats --}}
@if(!$error)
<div class="sk-stats">
    <div class="sk-stat-pill">
        <span class="dot dot-folder"></span>
        {{ count($folders) }} Folder
    </div>
    <div class="sk-stat-pill">
        <span class="dot dot-pdf"></span>
        {{ count($files) }} File PDF
    </div>
    <div class="sk-stat-pill">
        <span class="dot dot-total"></span>
        Total: {{ count($folders) + count($files) }} item
    </div>
</div>
@endif

{{-- Folders Grid --}}
@if(count($folders) > 0)
<div class="sk-section-hd"><i class="fas fa-folder" style="color:#d97706;"></i> Folder</div>
<div class="sk-grid" id="foldersGrid">
    @foreach($folders as $fld)
    <div class="sk-folder-card" id="folder-card-{{ md5($fld['name']) }}" data-folder="{{ $fld['folder_path'] }}" data-name="{{ $fld['name'] }}">
        <a href="{{ route('sertifikat-kalibrasi.index', ['folder' => $fld['folder_path']]) }}"
            style="text-decoration:none; display:flex; align-items:flex-start; gap:.8rem; flex:1;">
            <div class="sk-folder-icon"><i class="fas fa-folder"></i></div>
            <div style="min-width:0; flex:1;">
                <div class="sk-folder-name" title="{{ $fld['name'] }}">{{ $fld['name'] }}</div>
                <div class="sk-folder-meta">
                    <span class="mr-2"><i class="fas fa-file-pdf mr-1" style="color: var(--red-3);"></i>{{ $fld['file_count'] ?? 0 }} File</span>
                    <span><i class="fas fa-clock mr-1"></i>{{ $fld['modified_date'] }}</span>
                </div>
            </div>
        </a>
        <div class="sk-folder-actions">
            <button class="btn-card btn-card-edit"
                onclick="openRenameFolder('{{ addslashes($folder) }}','{{ addslashes($fld['name']) }}')"
                title="Rename folder">
                <i class="fas fa-pencil-alt"></i> Rename
            </button>
            <button class="btn-card btn-card-del"
                onclick="deleteFolder('{{ addslashes($folder) }}','{{ addslashes($fld['name']) }}')"
                title="Hapus folder">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    </div>
    @endforeach
</div>
@endif

{{-- PDF Files Grid --}}
@if(count($files) > 0 || count($folders) === 0)
<div class="sk-section-hd"><i class="fas fa-file-pdf" style="color:var(--red-3);"></i> File PDF</div>
<div class="sk-grid" id="filesGrid">
    @forelse($files as $file)
    <div class="sk-pdf-card" id="file-card-{{ md5($file['name']) }}" draggable="true" data-file="{{ $file['name'] }}" data-name="{{ $file['name'] }}">
        <div style="display:flex; align-items:flex-start; gap:.8rem;">
            <div class="sk-pdf-icon" style="cursor: pointer;" onclick="viewPdf('{{ addslashes($file['folder']) }}','{{ addslashes($file['name']) }}')"><i class="fas fa-file-pdf"></i></div>
            <div style="min-width:0; flex:1;">
                <div class="sk-pdf-name" title="{{ $file['name'] }}" onclick="viewPdf('{{ addslashes($file['folder']) }}','{{ addslashes($file['name']) }}')">{{ $file['name'] }}</div>
                <div class="sk-pdf-meta">
                    <i class="fas fa-hdd mr-1"></i>{{ $file['size_human'] }}
                    &nbsp;·&nbsp;
                    <i class="fas fa-clock mr-1"></i>{{ $file['modified_date'] }}
                </div>
            </div>
        </div>
        <div class="sk-pdf-actions">
            <button class="btn-card btn-card-view"
                onclick="viewPdf('{{ addslashes($file['folder']) }}','{{ addslashes($file['name']) }}')"
                title="Lihat PDF">
                <i class="fas fa-eye"></i> View
            </button>
            <a href="{{ route('sertifikat-kalibrasi.download', ['folder' => $file['folder'], 'file' => $file['name']]) }}"
                class="btn-card btn-card-dl" title="Download">
                <i class="fas fa-download"></i> Download
            </a>
            <button class="btn-card btn-card-edit"
                onclick="openRenameFile('{{ addslashes($file['folder']) }}','{{ addslashes($file['name']) }}')"
                title="Rename file">
                <i class="fas fa-pencil-alt"></i> Rename
            </button>
            <button class="btn-card btn-card-del"
                onclick="deleteFile('{{ addslashes($file['folder']) }}','{{ addslashes($file['name']) }}')"
                title="Hapus file">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    </div>
    @empty
    <div class="sk-empty">
        <i class="fas fa-file-pdf"></i>
        <p>Tidak ada file PDF ditemukan di folder ini.</p>
    </div>
    @endforelse
</div>
@endif

@if(!$error && count($folders) === 0 && count($files) === 0)
<div class="sk-grid">
    <div class="sk-empty">
        <i class="fas fa-folder-open"></i>
        <p>Folder ini kosong.</p>
    </div>
</div>
@endif

{{-- ══ MODAL: Create Folder ══ --}}
<div class="modal fade sk-modal" id="modalCreateFolder" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-folder-plus mr-2" style="color:#d97706;"></i>Buat Folder Baru</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <label class="sk-form-label">Nama Folder</label>
                <input type="text" class="sk-form-input" id="createFolderName" placeholder="Masukkan nama folder..." maxlength="100">
                <div style="font-size:.76rem; color:var(--text-muted); margin-top:.4rem;">
                    <i class="fas fa-info-circle mr-1"></i>
                    Di dalam: <strong>{{ $breadcrumbs[count($breadcrumbs)-1]['label'] }}</strong>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-sk btn-sk-outline" data-dismiss="modal">Batal</button>
                <button class="btn-sk btn-sk-primary" id="btnSubmitCreateFolder">
                    <i class="fas fa-folder-plus"></i> Buat Folder
                </button>
            </div>
        </div>
    </div>
</div>

{{-- ══ MODAL: Rename File ══ --}}
<div class="modal fade sk-modal" id="modalRenameFile" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-pencil-alt mr-2" style="color:#d97706;"></i>Rename File PDF</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <label class="sk-form-label">Nama Baru (tanpa .pdf)</label>
                <input type="text" class="sk-form-input" id="renameFileNewName" placeholder="Nama file baru..." maxlength="200">
                <div style="font-size:.76rem; color:var(--text-muted); margin-top:.4rem;">
                    <i class="fas fa-info-circle mr-1"></i> Ekstensi <code>.pdf</code> akan ditambahkan otomatis.
                </div>
                <input type="hidden" id="renameFileOldName">
                <input type="hidden" id="renameFileFolder">
            </div>
            <div class="modal-footer">
                <button class="btn-sk btn-sk-outline" data-dismiss="modal">Batal</button>
                <button class="btn-sk btn-sk-primary" id="btnSubmitRenameFile">
                    <i class="fas fa-check"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>

{{-- ══ MODAL: Rename Folder ══ --}}
<div class="modal fade sk-modal" id="modalRenameFolder" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-folder mr-2" style="color:#d97706;"></i>Rename Folder</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <label class="sk-form-label">Nama Folder Baru</label>
                <input type="text" class="sk-form-input" id="renameFolderNewName" placeholder="Nama folder baru..." maxlength="100">
                <input type="hidden" id="renameFolderOldName">
                <input type="hidden" id="renameFolderParent">
            </div>
            <div class="modal-footer">
                <button class="btn-sk btn-sk-outline" data-dismiss="modal">Batal</button>
                <button class="btn-sk btn-sk-primary" id="btnSubmitRenameFolder">
                    <i class="fas fa-check"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>

{{-- ══ MODAL: Upload File ══ --}}
<div class="modal fade sk-modal" id="modalUploadFile" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-upload mr-2" style="color:var(--red-3);"></i>Upload Sertifikat Kalibrasi</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form id="formUploadFile" enctype="multipart/form-data">
                <div class="modal-body">
                    <label class="sk-form-label">Pilih File PDF (Maksimal 20MB)</label>
                    <input type="file" class="sk-form-input" id="uploadFileSelect" name="file" accept="application/pdf" required>
                    <div style="font-size:.76rem; color:var(--text-muted); margin-top:.4rem;">
                        <i class="fas fa-info-circle mr-1"></i>
                        Akan di-upload ke: <strong>{{ $breadcrumbs[count($breadcrumbs)-1]['label'] }}</strong>
                    </div>
                    
                    {{-- Progress Bar --}}
                    <div class="progress mt-3 d-none" id="uploadProgressContainer" style="height:8px; border-radius:4px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" id="uploadProgressBar" role="progressbar" style="width:0%"></div>
                    </div>
                    <div class="text-center mt-2 d-none" id="uploadProgressText" style="font-size:.75rem; color:var(--text-muted);">
                        Mengupload... <span id="uploadPercent">0%</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-sk btn-sk-outline" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-sk btn-sk-primary" id="btnSubmitUpload">
                        <i class="fas fa-upload"></i> Upload
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ══ MODAL: PDF Viewer ══ --}}
<div class="modal fade sk-modal" id="modalViewPdf" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document" style="max-width: 92%; margin: 1.75rem auto;">
        <div class="modal-content" style="height: 88vh; border-radius: var(--radius-lg); overflow: hidden; display: flex; flex-direction: column;">
            <div class="modal-header d-flex align-items-center justify-content-between" style="padding: 0.8rem 1.5rem; background: var(--bg-card); border-bottom: 1px solid var(--border); flex-shrink: 0;">
                <h5 class="modal-title d-flex align-items-center" style="font-size: 1rem; font-weight: 700; color: var(--text-dark); max-width: 70%; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;">
                    <i class="fas fa-file-pdf mr-2" style="color: var(--red-3); font-size: 1.2rem;"></i>
                    <span id="pdfViewerTitle">Preview Sertifikat Kalibrasi</span>
                </h5>
                <div class="d-flex align-items-center" style="gap: 0.5rem;">
                    <a href="#" id="btnDownloadPdfModal" class="btn-sk btn-sk-outline" style="padding: 0.4rem 0.8rem; font-size: 0.8rem; height: auto;" title="Download PDF">
                        <i class="fas fa-download"></i> Download
                    </a>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin: 0; padding: 0.5rem; line-height: 1; font-size: 1.5rem;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-body p-0" style="flex: 1; position: relative; background: #525659; overflow: hidden;">
                <!-- PDF Iframe -->
                <iframe id="pdfViewerIframe" src="" style="width: 100%; height: 100%; border: none;"></iframe>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const CSRF = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const currentFolder = @json($folder);

    // ─── Helpers ────────────────────────────────────────────────────────────────
    function showLoading(btn) {
        btn.disabled = true;
        btn._orig = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Proses...';
    }

    function restoreBtn(btn) {
        btn.disabled = false;
        btn.innerHTML = btn._orig;
    }

    function toastSuccess(msg) {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: msg,
            timer: 2500,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    }

    function toastError(msg) {
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: msg,
            timer: 4000,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    }

    // ─── Create Folder ───────────────────────────────────────────────────────────
    document.getElementById('btnCreateFolder').addEventListener('click', function() {
        document.getElementById('createFolderName').value = '';
        $('#modalCreateFolder').modal('show');
        setTimeout(() => document.getElementById('createFolderName').focus(), 400);
    });

    document.getElementById('btnSubmitCreateFolder').addEventListener('click', function() {
        const name = document.getElementById('createFolderName').value.trim();
        if (!name) {
            toastError('Nama folder tidak boleh kosong.');
            return;
        }

        const btn = this;
        showLoading(btn);

        fetch("{{ route('sertifikat-kalibrasi.folder.create') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': CSRF
                },
                body: JSON.stringify({
                    parent_folder: currentFolder,
                    folder_name: name
                })
            })
            .then(async r => {
                const isJson = r.headers.get('content-type')?.includes('application/json');
                const data = isJson ? await r.json() : null;
                if (!r.ok) {
                    throw new Error((data && data.message) ? data.message : `HTTP Error ${r.status}`);
                }
                return data;
            })
            .then(data => {
                restoreBtn(btn);
                if (data.success) {
                    $('#modalCreateFolder').modal('hide');
                    toastSuccess(data.message);
                    setTimeout(() => location.reload(), 900);
                } else {
                    toastError(data.message);
                }
            })
            .catch(err => {
                restoreBtn(btn);
                console.error('Error creating folder:', err);
                toastError(err.message || 'Terjadi kesalahan jaringan saat membuat folder.');
            });
    });

    // Enter key support
    document.getElementById('createFolderName').addEventListener('keydown', e => {
        if (e.key === 'Enter') document.getElementById('btnSubmitCreateFolder').click();
    });

    // ─── Upload File ─────────────────────────────────────────────────────────────
    document.getElementById('btnUploadFile').addEventListener('click', function() {
        document.getElementById('uploadFileSelect').value = '';
        document.getElementById('uploadProgressContainer').classList.add('d-none');
        document.getElementById('uploadProgressText').classList.add('d-none');
        $('#modalUploadFile').modal('show');
    });

    document.getElementById('formUploadFile').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const fileInput = document.getElementById('uploadFileSelect');
        if (!fileInput.files.length) { toastError('Silakan pilih file PDF terlebih dahulu.'); return; }
        
        const file = fileInput.files[0];
        if (file.type !== 'application/pdf') { toastError('Hanya file PDF yang diizinkan.'); return; }
        if (file.size > 20 * 1024 * 1024) { toastError('Ukuran file maksimal adalah 20MB.'); return; }
        
        const formData = new FormData();
        formData.append('file', file);
        formData.append('folder', currentFolder);
        
        const btn = document.getElementById('btnSubmitUpload');
        const origText = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Mengupload...';
        
        const progContainer = document.getElementById('uploadProgressContainer');
        const progBar = document.getElementById('uploadProgressBar');
        const progText = document.getElementById('uploadProgressText');
        const progPercent = document.getElementById('uploadPercent');
        
        progContainer.classList.remove('d-none');
        progText.classList.remove('d-none');
        progBar.style.width = '0%';
        progPercent.innerText = '0%';
        
        const xhr = new XMLHttpRequest();
        xhr.open('POST', "{{ route('sertifikat-kalibrasi.upload') }}", true);
        xhr.setRequestHeader('X-CSRF-TOKEN', CSRF);
        xhr.setRequestHeader('Accept', 'application/json');
        
        // Track progress
        xhr.upload.addEventListener('progress', function(e) {
            if (e.lengthComputable) {
                const percent = Math.round((e.loaded / e.total) * 100);
                progBar.style.width = percent + '%';
                progPercent.innerText = percent + '%';
            }
        });
        
        xhr.onload = function() {
            btn.disabled = false;
            btn.innerHTML = origText;
            
            if (xhr.status === 200) {
                try {
                    const res = JSON.parse(xhr.responseText);
                    if (res.success) {
                        $('#modalUploadFile').modal('hide');
                        toastSuccess(res.message);
                        setTimeout(() => location.reload(), 900);
                    } else {
                        toastError(res.message || 'Gagal mengupload file.');
                    }
                } catch(e) {
                    toastError('Respon server tidak valid.');
                }
            } else {
                try {
                    const res = JSON.parse(xhr.responseText);
                    toastError(res.message || 'Terjadi kesalahan saat mengupload.');
                } catch(e) {
                    toastError('Error ' + xhr.status + ': Gagal mengupload file.');
                }
            }
        };
        
        xhr.onerror = function() {
            btn.disabled = false;
            btn.innerHTML = origText;
            toastError('Terjadi kesalahan jaringan saat mengupload.');
        };
        
        xhr.send(formData);
    });

    // ─── Rename File ─────────────────────────────────────────────────────────────
    function openRenameFile(folder, filename) {
        const nameWithoutExt = filename.replace(/\.pdf$/i, '');
        document.getElementById('renameFileFolder').value = folder;
        document.getElementById('renameFileOldName').value = filename;
        document.getElementById('renameFileNewName').value = nameWithoutExt;
        $('#modalRenameFile').modal('show');
        setTimeout(() => {
            const inp = document.getElementById('renameFileNewName');
            inp.focus();
            inp.select();
        }, 400);
    }

    document.getElementById('btnSubmitRenameFile').addEventListener('click', function() {
        const newName = document.getElementById('renameFileNewName').value.trim();
        const oldName = document.getElementById('renameFileOldName').value;
        const folder = document.getElementById('renameFileFolder').value;
        if (!newName) {
            toastError('Nama baru tidak boleh kosong.');
            return;
        }

        const btn = this;
        showLoading(btn);

        fetch("{{ route('sertifikat-kalibrasi.file.rename') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': CSRF
                },
                body: JSON.stringify({
                    folder,
                    old_name: oldName,
                    new_name: newName
                })
            })
            .then(async r => {
                const isJson = r.headers.get('content-type')?.includes('application/json');
                const data = isJson ? await r.json() : null;
                if (!r.ok) {
                    throw new Error((data && data.message) ? data.message : `HTTP Error ${r.status}`);
                }
                return data;
            })
            .then(data => {
                restoreBtn(btn);
                if (data.success) {
                    $('#modalRenameFile').modal('hide');
                    toastSuccess(data.message);
                    setTimeout(() => location.reload(), 900);
                } else {
                    toastError(data.message);
                }
            })
            .catch(err => {
                restoreBtn(btn);
                console.error('Error renaming file:', err);
                toastError(err.message || 'Terjadi kesalahan jaringan saat mengubah nama file.');
            });
    });

    document.getElementById('renameFileNewName').addEventListener('keydown', e => {
        if (e.key === 'Enter') document.getElementById('btnSubmitRenameFile').click();
    });

    // ─── Delete File ─────────────────────────────────────────────────────────────
    function deleteFile(folder, filename) {
        Swal.fire({
            title: 'Hapus File?',
            html: `<span style="font-size:.9rem;">File <strong>${filename}</strong> akan dihapus permanen dari network share.</span>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: '<i class="fas fa-trash mr-1"></i> Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then(result => {
            if (!result.isConfirmed) return;

            fetch("{{ route('sertifikat-kalibrasi.file.destroy') }}", {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': CSRF
                    },
                    body: JSON.stringify({
                        folder,
                        file: filename
                    })
                })
                .then(async r => {
                    const isJson = r.headers.get('content-type')?.includes('application/json');
                    const data = isJson ? await r.json() : null;
                    if (!r.ok) {
                        throw new Error((data && data.message) ? data.message : `HTTP Error ${r.status}`);
                    }
                    return data;
                })
                .then(data => {
                    if (data.success) {
                        toastSuccess(data.message);
                        const card = document.querySelector(`.sk-pdf-card[data-name="${CSS.escape(filename)}"]`);
                        if (card) {
                            card.style.opacity = '0';
                            card.style.transform = 'scale(.95)';
                            setTimeout(() => card.remove(), 300);
                        }
                    } else {
                        toastError(data.message);
                    }
                })
                .catch(err => {
                    console.error('Error deleting file:', err);
                    toastError(err.message || 'Terjadi kesalahan jaringan saat menghapus file.');
                });
        });
    }

    // ─── Rename Folder ───────────────────────────────────────────────────────────
    function openRenameFolder(parentFolder, folderName) {
        document.getElementById('renameFolderParent').value = parentFolder;
        document.getElementById('renameFolderOldName').value = folderName;
        document.getElementById('renameFolderNewName').value = folderName;
        $('#modalRenameFolder').modal('show');
        setTimeout(() => {
            const inp = document.getElementById('renameFolderNewName');
            inp.focus();
            inp.select();
        }, 400);
    }

    document.getElementById('btnSubmitRenameFolder').addEventListener('click', function() {
        const newName = document.getElementById('renameFolderNewName').value.trim();
        const oldName = document.getElementById('renameFolderOldName').value;
        const parent = document.getElementById('renameFolderParent').value;
        if (!newName) {
            toastError('Nama baru tidak boleh kosong.');
            return;
        }

        const btn = this;
        showLoading(btn);

        fetch("{{ route('sertifikat-kalibrasi.folder.rename') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': CSRF
                },
                body: JSON.stringify({
                    parent_folder: parent,
                    old_name: oldName,
                    new_name: newName
                })
            })
            .then(async r => {
                const isJson = r.headers.get('content-type')?.includes('application/json');
                const data = isJson ? await r.json() : null;
                if (!r.ok) {
                    throw new Error((data && data.message) ? data.message : `HTTP Error ${r.status}`);
                }
                return data;
            })
            .then(data => {
                restoreBtn(btn);
                if (data.success) {
                    $('#modalRenameFolder').modal('hide');
                    toastSuccess(data.message);
                    setTimeout(() => location.reload(), 900);
                } else {
                    toastError(data.message);
                }
            })
            .catch(err => {
                restoreBtn(btn);
                console.error('Error renaming folder:', err);
                toastError(err.message || 'Terjadi kesalahan jaringan saat mengubah nama folder.');
            });
    });

    document.getElementById('renameFolderNewName').addEventListener('keydown', e => {
        if (e.key === 'Enter') document.getElementById('btnSubmitRenameFolder').click();
    });

    // ─── Delete Folder ───────────────────────────────────────────────────────────
    function deleteFolder(parentFolder, folderName) {
        Swal.fire({
            title: 'Hapus Folder?',
            html: `<span style="font-size:.9rem;">Folder <strong>${folderName}</strong> akan dihapus.<br><small style="color:#6b7280;">Folder harus kosong untuk bisa dihapus.</small></span>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: '<i class="fas fa-trash mr-1"></i> Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then(result => {
            if (!result.isConfirmed) return;

            fetch("{{ route('sertifikat-kalibrasi.folder.destroy') }}", {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': CSRF
                    },
                    body: JSON.stringify({
                        parent_folder: parentFolder,
                        folder_name: folderName
                    })
                })
                .then(async r => {
                    const isJson = r.headers.get('content-type')?.includes('application/json');
                    const data = isJson ? await r.json() : null;
                    if (!r.ok) {
                        throw new Error((data && data.message) ? data.message : `HTTP Error ${r.status}`);
                    }
                    return data;
                })
                .then(data => {
                    if (data.success) {
                        toastSuccess(data.message);
                        const card = document.querySelector(`.sk-folder-card[data-name="${CSS.escape(folderName)}"]`);
                        if (card) {
                            card.style.opacity = '0';
                            card.style.transform = 'scale(.95)';
                            setTimeout(() => card.remove(), 300);
                        }
                    } else {
                        toastError(data.message);
                    }
                })
                .catch(err => {
                    console.error('Error deleting folder:', err);
                    toastError(err.message || 'Terjadi kesalahan jaringan saat menghapus folder.');
                });
        });
    }

    // ─── Copy to clipboard ───────────────────────────────────────────────────────
    function copyText(elementId) {
        const el = document.getElementById(elementId);
        if (!el) return;
        const text = el.innerText || el.textContent;
        navigator.clipboard.writeText(text).then(() => {
            toastSuccess('Teks disalin ke clipboard!');
        }).catch(() => {
            // Fallback
            const ta = document.createElement('textarea');
            ta.value = text;
            document.body.appendChild(ta);
            ta.select();
            document.execCommand('copy');
            document.body.removeChild(ta);
            toastSuccess('Teks disalin!');
        });
    }

    // ─── Simple MD5 for card IDs (matching PHP md5()) ────────────────────────────
    // We use a lightweight implementation for card removal animation
    function md5(str) {
        // PHP md5 returns hex, we'll use a simple hash for matching
        // Since PHP uses md5($file['name']), we need to match it
        // Use a workaround: store data-id in each card matching the md5
        // Actually, let's just reload after delete instead of animating
        return str; // fallback — we reload anyway
    }

    // ─── Drag & Drop ─────────────────────────────────────────────────────────────
    const pdfCards = document.querySelectorAll('.sk-pdf-card');
    const folderCards = document.querySelectorAll('.sk-folder-card');
    const breadcrumbItems = document.querySelectorAll('.sk-breadcrumb-item');

    pdfCards.forEach(card => {
        card.addEventListener('dragstart', function(e) {
            e.dataTransfer.setData('pdf-filename', this.getAttribute('data-file'));
            e.dataTransfer.setData('text/plain', this.getAttribute('data-file'));
            this.style.opacity = '0.4';
        });

        card.addEventListener('dragend', function(e) {
            this.style.opacity = '1';
        });
    });

    folderCards.forEach(folder => {
        folder.addEventListener('dragover', function(e) {
            e.preventDefault();
        });

        folder.addEventListener('dragenter', function(e) {
            e.preventDefault();
            this.classList.add('drag-over');
        });

        folder.addEventListener('dragleave', function() {
            this.classList.remove('drag-over');
        });

        folder.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('drag-over');

            const filename = e.dataTransfer.getData('pdf-filename') || e.dataTransfer.getData('text/plain');
            const targetFolder = this.getAttribute('data-folder');

            if (!filename || !targetFolder) return;
            if (currentFolder === targetFolder) return;

            moveFile(filename, currentFolder, targetFolder);
        });
    });

    breadcrumbItems.forEach(crumb => {
        crumb.addEventListener('dragover', function(e) {
            e.preventDefault();
        });

        crumb.addEventListener('dragenter', function(e) {
            e.preventDefault();
            this.classList.add('drag-over-crumb');
        });

        crumb.addEventListener('dragleave', function() {
            this.classList.remove('drag-over-crumb');
        });

        crumb.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('drag-over-crumb');

            const filename = e.dataTransfer.getData('pdf-filename') || e.dataTransfer.getData('text/plain');
            const targetFolder = this.getAttribute('data-folder');

            if (!filename) return;

            const target = targetFolder || '';
            if (currentFolder === target) return;

            moveFile(filename, currentFolder, target);
        });
    });

    function moveFile(file, currentFolder, targetFolder) {
        const targetName = targetFolder ? targetFolder.split('/').pop() : 'Sertifikat Digital';
        Swal.fire({
            title: 'Pindahkan File?',
            html: `Apakah Anda yakin ingin memindahkan file <strong>${file}</strong> ke folder <strong>${targetName}</strong>?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: 'var(--red-3)',
            cancelButtonColor: '#6b7280',
            confirmButtonText: '<i class="fas fa-exchange-alt mr-1"></i> Ya, Pindahkan!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then(result => {
            if (!result.isConfirmed) return;

            fetch("{{ route('sertifikat-kalibrasi.file.move') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': CSRF
                },
                body: JSON.stringify({
                    file: file,
                    current_folder: currentFolder,
                    target_folder: targetFolder
                })
            })
            .then(async r => {
                const isJson = r.headers.get('content-type')?.includes('application/json');
                const data = isJson ? await r.json() : null;
                if (!r.ok) {
                    throw new Error((data && data.message) ? data.message : `HTTP Error ${r.status}`);
                }
                return data;
            })
            .then(data => {
                if (data.success) {
                    toastSuccess(data.message);
                    const fileCard = document.querySelector(`.sk-pdf-card[data-name="${CSS.escape(file)}"]`);
                    if (fileCard) {
                        fileCard.style.opacity = '0';
                        fileCard.style.transform = 'scale(0.9)';
                        setTimeout(() => {
                            fileCard.remove();
                            const filesGrid = document.getElementById('filesGrid');
                            if (filesGrid && filesGrid.children.length === 0) {
                                filesGrid.innerHTML = `
                                    <div class="sk-empty">
                                        <i class="fas fa-file-pdf"></i>
                                        <p>Tidak ada file PDF ditemukan di folder ini.</p>
                                    </div>
                                `;
                            }
                            location.reload();
                        }, 400);
                    } else {
                        location.reload();
                    }
                } else {
                    toastError(data.message);
                }
            })
            .catch(err => {
                console.error('Error moving file:', err);
                toastError(err.message || 'Terjadi kesalahan jaringan saat memindahkan file.');
            });
        });
    }

    function viewPdf(folder, filename) {
        const titleEl = document.getElementById('pdfViewerTitle');
        const iframeEl = document.getElementById('pdfViewerIframe');
        const dlBtnEl = document.getElementById('btnDownloadPdfModal');

        // Set title
        titleEl.textContent = filename;

        // Generate URLs
        const baseUrl = "{{ route('sertifikat-kalibrasi.download') }}";
        const viewUrl = `${baseUrl}?folder=${encodeURIComponent(folder)}&file=${encodeURIComponent(filename)}&inline=1`;
        const downloadUrl = `${baseUrl}?folder=${encodeURIComponent(folder)}&file=${encodeURIComponent(filename)}`;

        // Set download button href
        dlBtnEl.href = downloadUrl;

        // Load PDF immediately in iframe
        iframeEl.src = viewUrl;

        // Open modal
        $('#modalViewPdf').modal('show');
    }

    // Clear iframe src when modal is closed to stop rendering/streaming processes
    $('#modalViewPdf').on('hidden.bs.modal', function () {
        document.getElementById('pdfViewerIframe').src = '';
    });
</script>
@endpush