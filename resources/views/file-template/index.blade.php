@extends('layouts.app')

@section('title', 'File Template Kalibrasi')

@push('styles')
<style>
    /* ===== Page Header ===== */
    .page-hero {
        background: linear-gradient(135deg, #1a3a6b 0%, #2563eb 60%, #0ea5e9 100%);
        border-radius: 16px;
        padding: 2rem 2.5rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(37, 99, 235, 0.3);
    }
    .page-hero::before {
        content: '';
        position: absolute;
        top: -40px; right: -40px;
        width: 200px; height: 200px;
        background: rgba(255,255,255,0.06);
        border-radius: 50%;
    }
    .page-hero::after {
        content: '';
        position: absolute;
        bottom: -60px; left: -20px;
        width: 150px; height: 150px;
        background: rgba(255,255,255,0.04);
        border-radius: 50%;
    }
    .page-hero h2 { font-size: 1.8rem; font-weight: 700; }
    .page-hero .subtitle { opacity: .8; font-size: .95rem; }

    /* ===== Summary Cards ===== */
    .summary-card {
        border: none;
        border-radius: 14px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        transition: transform .2s, box-shadow .2s;
        overflow: hidden;
        position: relative;
    }
    .summary-card:hover { transform: translateY(-4px); box-shadow: 0 8px 30px rgba(0,0,0,0.14); }
    .summary-card .card-body { padding: 1.5rem; }
    .summary-card .icon-wrap {
        width: 56px; height: 56px;
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.4rem;
        flex-shrink: 0;
    }
    .summary-card .count { font-size: 2.2rem; font-weight: 800; line-height: 1; }
    .summary-card .label { font-size: .82rem; text-transform: uppercase; letter-spacing: .5px; opacity: .7; }

    /* Color themes */
    .card-total   .icon-wrap { background: rgba(99,102,241,.12); color: #6366f1; }
    .card-verified .icon-wrap { background: rgba(37,99,235,.12);  color: #2563eb; }
    .card-approved .icon-wrap { background: rgba(16,185,129,.12); color: #10b981; }
    .card-rejected .icon-wrap { background: rgba(239,68,68,.12);  color: #ef4444; }

    /* ===== Filter Bar ===== */
    .filter-bar {
        background: #fff;
        border-radius: 14px;
        padding: 1.25rem 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
    }
    .filter-bar .form-control, .filter-bar .form-select {
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        font-size: .9rem;
        height: 42px;
    }
    .filter-bar .btn { border-radius: 10px; height: 42px; font-weight: 600; }

    /* Category Tabs */
    .cat-tabs { gap: .5rem; }
    .cat-tab {
        border: 2px solid transparent;
        border-radius: 10px;
        padding: .45rem 1.1rem;
        font-size: .85rem;
        font-weight: 600;
        cursor: pointer;
        transition: all .2s;
        text-decoration: none;
        display: inline-flex; align-items: center; gap: .4rem;
    }
    .cat-tab:hover { text-decoration: none; }
    .cat-tab.all       { background: #f1f5f9; color: #475569; border-color: #e2e8f0; }
    .cat-tab.all.active{ background: #6366f1; color: #fff;    border-color: #6366f1; }
    .cat-tab.verified       { background: #eff6ff; color: #2563eb; border-color: #bfdbfe; }
    .cat-tab.verified.active{ background: #2563eb; color: #fff;    border-color: #2563eb; }
    .cat-tab.approved       { background: #f0fdf4; color: #16a34a; border-color: #bbf7d0; }
    .cat-tab.approved.active{ background: #16a34a; color: #fff;    border-color: #16a34a; }
    .cat-tab.rejected       { background: #fef2f2; color: #dc2626; border-color: #fecaca; }
    .cat-tab.rejected.active{ background: #dc2626; color: #fff;    border-color: #dc2626; }

    /* ===== Table ===== */
    .main-table-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.08);
        overflow: hidden;
    }
    .main-table-card .card-header {
        background: #fff;
        border-bottom: 1px solid #f1f5f9;
        padding: 1.25rem 1.5rem;
        font-weight: 700; font-size: 1rem;
    }

    #filesTable thead th {
        background: #f8fafc;
        color: #475569;
        font-size: .78rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .5px;
        border-bottom: 2px solid #e2e8f0;
        white-space: nowrap;
        padding: .85rem 1rem;
    }
    #filesTable tbody td { padding: .85rem 1rem; vertical-align: middle; font-size: .9rem; }
    #filesTable tbody tr:hover { background: #f8faff; }

    /* Badge type */
    .badge-type {
        border-radius: 8px;
        font-size: .78rem;
        font-weight: 600;
        padding: .3rem .75rem;
        display: inline-flex; align-items: center; gap: .35rem;
    }
    .badge-verified { background: #dbeafe; color: #1d4ed8; }
    .badge-approved { background: #dcfce7; color: #15803d; }
    .badge-rejected { background: #fee2e2; color: #b91c1c; }

    /* File icon */
    .file-icon {
        width: 38px; height: 38px;
        border-radius: 10px;
        display: inline-flex; align-items: center; justify-content: center;
        font-size: 1.1rem;
        background: #f0fdf4; color: #16a34a;
        flex-shrink: 0;
    }
    .file-icon.xlsm { background: #f0fdf4; color: #16a34a; }
    .file-icon.xlsx { background: #eff6ff; color: #2563eb; }
    .file-icon.xls  { background: #fefce8; color: #d97706; }

    /* Nama alat */
    .alat-name { font-weight: 600; color: #1e293b; font-size: .9rem; }
    .alat-meta { font-size: .78rem; color: #94a3b8; margin-top: .1rem; }

    /* Download button */
    .btn-download {
        border-radius: 8px;
        padding: .35rem .9rem;
        font-size: .82rem;
        font-weight: 600;
        border: none;
        transition: all .2s;
    }
    .btn-download-verified { background: #dbeafe; color: #1d4ed8; }
    .btn-download-verified:hover { background: #2563eb; color: #fff; }
    .btn-download-approved { background: #dcfce7; color: #15803d; }
    .btn-download-approved:hover { background: #16a34a; color: #fff; }
    .btn-download-rejected { background: #fee2e2; color: #b91c1c; }
    .btn-download-rejected:hover { background: #dc2626; color: #fff; }

    .btn-delete-template {
        border-radius: 8px;
        padding: .35rem .9rem;
        font-size: .82rem;
        font-weight: 600;
        border: none;
        transition: all .2s;
        background: #fee2e2; color: #b91c1c;
        display: inline-flex; align-items: center; gap: .3rem;
    }
    .btn-delete-template:hover { background: #dc2626; color: #fff; text-decoration: none; }

    /* Empty state */
    .empty-state { padding: 4rem 2rem; text-align: center; }
    .empty-state .empty-icon { font-size: 4rem; opacity: .25; }

    /* DataTables override */
    .dataTables_wrapper .dataTables_filter label,
    .dataTables_wrapper .dataTables_length label { font-size: .85rem; }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 8px !important; margin: 0 2px;
    }
</style>
@endpush

@section('content')

{{-- ===== Page Hero ===== --}}
<div class="page-hero text-white">
    <div class="d-flex align-items-center justify-content-between flex-wrap" style="gap:1rem; position:relative;z-index:1;">
        <div>
            <h2 class="mb-1"><i class="fas fa-file-excel mr-2"></i>File Template Kalibrasi</h2>
            <p class="subtitle mb-0">Daftar file Excel yang telah diverifikasi dan disetujui</p>
        </div>
        <div class="text-right">
            <span style="font-size:.85rem; opacity:.75;">Terakhir diperbarui: {{ now()->format('d M Y H:i') }}</span>
        </div>
    </div>
</div>

{{-- ===== Summary Cards ===== --}}
<div class="row mb-4">
    <div class="col-6 col-md-3 mb-3">
        <div class="card summary-card card-total">
            <div class="card-body d-flex align-items-center" style="gap:1rem;">
                <div class="icon-wrap"><i class="fas fa-layer-group"></i></div>
                <div>
                    <div class="count">{{ $summary['total'] }}</div>
                    <div class="label">Total File</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3 mb-3">
        <div class="card summary-card card-verified">
            <div class="card-body d-flex align-items-center" style="gap:1rem;">
                <div class="icon-wrap"><i class="fas fa-check-circle"></i></div>
                <div>
                    <div class="count" style="color:#2563eb;">{{ $summary['verified'] }}</div>
                    <div class="label">Verified</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3 mb-3">
        <div class="card summary-card card-approved">
            <div class="card-body d-flex align-items-center" style="gap:1rem;">
                <div class="icon-wrap"><i class="fas fa-stamp"></i></div>
                <div>
                    <div class="count" style="color:#10b981;">{{ $summary['approved'] }}</div>
                    <div class="label">Approved</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3 mb-3">
        <div class="card summary-card card-rejected">
            <div class="card-body d-flex align-items-center" style="gap:1rem;">
                <div class="icon-wrap"><i class="fas fa-times-circle"></i></div>
                <div>
                    <div class="count" style="color:#ef4444;">{{ $summary['rejected'] }}</div>
                    <div class="label">Rejected</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ===== Filter Bar ===== --}}
<div class="filter-bar">
    <form method="GET" action="{{ route('file-template.index') }}" id="filterForm">
        <div class="row align-items-center" style="gap:.5rem 0;">
            {{-- Search & Date --}}
            <div class="col-12 col-md-5 mb-2 mb-md-0 d-flex" style="gap:.5rem;">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="border-radius:10px 0 0 10px; border:1px solid #e2e8f0; background:#f8fafc;">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                    </div>
                    <input type="text" name="search" class="form-control"
                           placeholder="Cari nama alat, no seri..."
                           value="{{ $search }}"
                           style="border-radius:0 10px 10px 0; border-left:0;">
                </div>
                <input type="date" name="date" class="form-control" value="{{ $date ?? '' }}" style="border-radius:10px; max-width: 140px;" title="Filter berdasarkan tanggal">
            </div>

            {{-- Category Tabs --}}
            <div class="col-12 col-md-7">
                <div class="d-flex flex-wrap cat-tabs">
                    <a href="{{ route('file-template.index', array_merge(request()->except('category'), ['category'=>'all', 'search'=>$search, 'date'=>$date])) }}"
                       class="cat-tab all {{ $category === 'all' ? 'active' : '' }}">
                        <i class="fas fa-layer-group"></i> Semua
                        <span class="ml-1" style="background:rgba(255,255,255,.3); border-radius:6px; padding:0 6px; font-size:.8rem;">{{ $summary['total'] }}</span>
                    </a>
                    <a href="{{ route('file-template.index', array_merge(request()->except('category'), ['category'=>'verified', 'search'=>$search, 'date'=>$date])) }}"
                       class="cat-tab verified {{ $category === 'verified' ? 'active' : '' }}">
                        <i class="fas fa-check-circle"></i> Verified
                        <span class="ml-1" style="background:rgba(255,255,255,.3); border-radius:6px; padding:0 6px; font-size:.8rem;">{{ $summary['verified'] }}</span>
                    </a>
                    <a href="{{ route('file-template.index', array_merge(request()->except('category'), ['category'=>'approved', 'search'=>$search, 'date'=>$date])) }}"
                       class="cat-tab approved {{ $category === 'approved' ? 'active' : '' }}">
                        <i class="fas fa-stamp"></i> Approved
                        <span class="ml-1" style="background:rgba(255,255,255,.3); border-radius:6px; padding:0 6px; font-size:.8rem;">{{ $summary['approved'] }}</span>
                    </a>
                    <a href="{{ route('file-template.index', array_merge(request()->except('category'), ['category'=>'rejected', 'search'=>$search, 'date'=>$date])) }}"
                       class="cat-tab rejected {{ $category === 'rejected' ? 'active' : '' }}">
                        <i class="fas fa-times-circle"></i> Rejected
                        <span class="ml-1" style="background:rgba(255,255,255,.3); border-radius:6px; padding:0 6px; font-size:.8rem;">{{ $summary['rejected'] }}</span>
                    </a>

                    @if($search || $date)
                    <a href="{{ route('file-template.index', ['category' => $category]) }}"
                       class="btn btn-sm btn-outline-secondary ml-2" style="border-radius:10px; height:36px; padding:.35rem .85rem; font-size:.82rem; font-weight:600; display:inline-flex; align-items:center;">
                        <i class="fas fa-times mr-1"></i> Reset
                    </a>
                    @endif

                    <button type="submit" class="btn btn-primary ml-auto" style="height:36px; padding:.35rem 1rem; font-size:.85rem; font-weight:600; border-radius:10px;">
                        <i class="fas fa-search mr-1"></i> Cari
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

{{-- ===== Main Table ===== --}}
<div class="card main-table-card">
    <div class="card-header d-flex align-items-center justify-content-between flex-wrap" style="gap:.5rem;">
        <span>
            <i class="fas fa-file-excel mr-2" style="color:#16a34a;"></i>
            Daftar File
            @if($search)
                <small class="text-muted ml-2">— hasil pencarian "<strong>{{ $search }}</strong>"</small>
            @endif
        </span>
        <div class="d-flex align-items-center" style="gap:.5rem;">
            @if(count($files) > 0)
            <div id="bulkActions" class="d-none d-flex align-items-center" style="gap:.5rem;">
                <button class="btn btn-primary btn-sm font-weight-bold" style="border-radius:10px; height:34px; padding:.35rem .85rem;"
                        onclick="downloadSelected()">
                    <i class="fas fa-download mr-1"></i> Unduh Terpilih (<span class="selectedCount">0</span>)
                </button>
                <button class="btn btn-warning btn-sm font-weight-bold" style="border-radius:10px; height:34px; padding:.35rem .85rem;"
                        onclick="confirmDeleteSelected()">
                    <i class="fas fa-trash-alt mr-1"></i> Hapus Terpilih (<span class="selectedCount">0</span>)
                </button>
            </div>
            <button class="btn btn-danger btn-sm font-weight-bold" style="border-radius:10px; height:34px; padding:.35rem .85rem;"
                    onclick="confirmDeleteAll('{{ $category }}')">
                <i class="fas fa-trash-alt mr-1"></i> Hapus Semua ({{ $category === 'all' ? 'Semua' : ucfirst($category) }})
            </button>
            @endif
            <span class="badge badge-pill badge-light px-3 py-2" style="font-size:.85rem; font-weight:600;">
                {{ count($files) }} file
            </span>
        </div>
    </div>
    <div class="card-body p-0">
        @if(count($files) > 0)
        <div class="table-responsive">
            <table id="filesTable" class="table table-hover mb-0" style="width:100%;">
                <thead>
                    <tr>
                        <th style="width:40px; text-align:center;">
                            <input type="checkbox" id="selectAllCheckbox" style="transform: scale(1.2); cursor: pointer;">
                        </th>
                        <th style="width:50px;">#</th>
                        <th>Nama Alat / File</th>
                        <th>No. Seri</th>
                        <th>Tanggal Simpan</th>
                        <th>Ukuran</th>
                        <th>Status</th>
                        <th style="width:180px; text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($files as $i => $file)
                    <tr>
                        <td class="text-center">
                            <input type="checkbox" class="file-checkbox" value="{{ $file['type'] }}::{{ $file['filename'] }}" style="transform: scale(1.2); cursor: pointer;">
                        </td>
                        {{-- No --}}
                        <td class="text-muted" style="font-size:.82rem;">{{ $i + 1 }}</td>

                        {{-- Nama Alat + Filename --}}
                        <td>
                            <div class="d-flex align-items-center" style="gap:.75rem;">
                                <div class="file-icon {{ $file['extension'] }}">
                                    <i class="fas fa-file-excel"></i>
                                </div>
                                <div>
                                    <div class="alat-name">{{ $file['nama_alat'] ?: '-' }}</div>
                                    <div class="alat-meta" title="{{ $file['filename'] }}">
                                        {{ Str::limit($file['filename'], 55) }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        {{-- No Seri --}}
                        <td>
                            @if($file['no_seri'] !== '-')
                                <code style="background:#f1f5f9; padding:.2rem .5rem; border-radius:6px; font-size:.82rem;">{{ $file['no_seri'] }}</code>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>

                        {{-- Tanggal --}}
                        <td style="white-space:nowrap;">
                            <i class="fas fa-calendar-alt mr-1 text-muted" style="font-size:.78rem;"></i>
                            {{ $file['modified_date'] }}
                        </td>

                        {{-- Ukuran --}}
                        <td style="white-space:nowrap;">
                            <span class="text-muted" style="font-size:.85rem;">{{ $file['size_human'] }}</span>
                        </td>

                        {{-- Status Badge --}}
                        <td>
                            <span class="badge-type badge-{{ $file['type'] }}">
                                @if($file['type'] === 'verified')
                                    <i class="fas fa-check-circle"></i> Verified
                                @elseif($file['type'] === 'approved')
                                    <i class="fas fa-stamp"></i> Approved
                                @else
                                    <i class="fas fa-times-circle"></i> Rejected
                                @endif
                            </span>
                        </td>

                        {{-- Aksi --}}
                        <td class="text-center">
                            <div class="d-flex justify-content-center" style="gap:.5rem;">
                                <a href="{{ $file['download_url'] }}"
                                   download="{{ $file['filename'] }}"
                                   class="btn btn-download btn-download-{{ $file['type'] }}"
                                   title="Unduh {{ $file['filename'] }}">
                                    <i class="fas fa-download mr-1"></i> Unduh
                                </a>

                                <button class="btn btn-delete-template"
                                        onclick="confirmDelete('{{ $file['type'] }}', '{{ $file['filename'] }}')"
                                        title="Hapus {{ $file['filename'] }}">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="empty-state">
            <div class="empty-icon mb-3">
                @if($search)
                    <i class="fas fa-search-minus"></i>
                @else
                    <i class="fas fa-folder-open"></i>
                @endif
            </div>
            <h5 class="text-muted">
                @if($search)
                    Tidak ada file yang cocok dengan "<strong>{{ $search }}</strong>"
                @else
                    Belum ada file di folder ini
                @endif
            </h5>
            <p class="text-muted" style="font-size:.9rem;">
                @if($search)
                    Coba gunakan kata kunci yang berbeda atau pilih kategori lain.
                @else
                    File akan muncul di sini setelah proses verifikasi / approval selesai.
                @endif
            </p>
            @if($search || $category !== 'all')
            <a href="{{ route('file-template.index') }}" class="btn btn-primary" style="border-radius:10px;">
                <i class="fas fa-redo mr-1"></i> Tampilkan Semua
            </a>
            @endif
        </div>
        @endif
    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    @if(count($files) > 0)
    var table = $('#filesTable').DataTable({
        responsive: true,
        autoWidth: false,
        pageLength: 25,
        order: [[4, 'desc']], // Sort by tanggal desc (index shifted by 1 because of checkbox column)
        columnDefs: [
            { orderable: false, targets: [0, 7] } // Kolom checkbox & download tidak bisa di-sort
        ],
        language: {
            search:     "Cari di tabel:",
            lengthMenu: "Tampilkan _MENU_ baris",
            info:       "Menampilkan _START_ - _END_ dari _TOTAL_ file",
            infoEmpty:  "Tidak ada file",
            paginate: {
                previous: '<i class="fas fa-chevron-left"></i>',
                next:     '<i class="fas fa-chevron-right"></i>'
            },
            emptyTable: "Tidak ada data",
        },
        dom: '<"d-flex align-items-center justify-content-between mb-3"lf>rtip',
        initComplete: function() {
            // Style DataTables search input
            $('.dataTables_filter input')
                .addClass('form-control')
                .css({ 'border-radius': '10px', 'border': '1px solid #e2e8f0', 'height': '38px', 'font-size': '.88rem' });
            $('.dataTables_length select')
                .addClass('form-control')
                .css({ 'border-radius': '8px', 'height': '38px', 'font-size': '.88rem', 'display': 'inline', 'width': 'auto' });
        }
    });

    // Handle check all
    $('#selectAllCheckbox').on('change', function() {
        var isChecked = $(this).prop('checked');
        $('.file-checkbox', table.rows({ search: 'applied' }).nodes()).prop('checked', isChecked);
        updateSelectedCount();
    });

    // Handle individual check
    $('#filesTable tbody').on('change', '.file-checkbox', function() {
        var totalCheckboxes = $('.file-checkbox', table.rows({ search: 'applied' }).nodes()).length;
        var checkedCheckboxes = $('.file-checkbox:checked', table.rows({ search: 'applied' }).nodes()).length;
        
        $('#selectAllCheckbox').prop('checked', totalCheckboxes === checkedCheckboxes && totalCheckboxes > 0);
        updateSelectedCount();
    });

    // Update DataTables draw event to maintain select all state
    table.on('draw', function() {
        var totalCheckboxes = $('.file-checkbox', table.rows({ search: 'applied', page: 'current' }).nodes()).length;
        var checkedCheckboxes = $('.file-checkbox:checked', table.rows({ search: 'applied', page: 'current' }).nodes()).length;
        
        $('#selectAllCheckbox').prop('checked', totalCheckboxes === checkedCheckboxes && totalCheckboxes > 0);
    });

    function updateSelectedCount() {
        var checkedCount = $('.file-checkbox:checked', table.rows().nodes()).length;
        $('.selectedCount').text(checkedCount);
        
        if (checkedCount > 0) {
            $('#bulkActions').removeClass('d-none');
        } else {
            $('#bulkActions').addClass('d-none');
        }
    }
    @endif

    // Realtime search trigger
    $('#filterForm input[name="search"]').on('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            $(this).closest('form').submit();
        }
    });

    $('#filterForm input[name="date"]').on('change', function() {
        $(this).closest('form').submit();
    });

    // Flash session notification with SweetAlert2
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 3000,
            toast: true,
            position: 'top-end',
            timerProgressBar: true
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: "{{ session('error') }}",
            confirmButtonColor: '#3b82f6'
        });
    @endif

    @if(session('info'))
        Swal.fire({
            icon: 'info',
            title: 'Informasi',
            text: "{{ session('info') }}",
            confirmButtonColor: '#3b82f6'
        });
    @endif
});

/**
 * Confirm delete individual file using SweetAlert2
 */
function confirmDelete(type, filename) {
    Swal.fire({
        title: 'Hapus Template?',
        text: `Apakah Anda yakin ingin menghapus berkas "${filename}" (${type})? Berkas ini tidak dapat dikembalikan!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/file-template/delete/${encodeURIComponent(type)}/${encodeURIComponent(filename)}`;
            
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            form.appendChild(csrfInput);

            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            form.appendChild(methodInput);

            document.body.appendChild(form);
            form.submit();
        }
    });
}

/**
 * Confirm delete all files in active category using SweetAlert2
 */
function confirmDeleteAll(category) {
    const categoryName = category === 'all' ? 'Semua' : category.charAt(0).toUpperCase() + category.slice(1);
    Swal.fire({
        title: 'Hapus Semua Template?',
        text: `Apakah Anda yakin ingin menghapus SEMUA berkas template kalibrasi di kategori "${categoryName}"? Tindakan ini tidak dapat dikembalikan!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus Semua!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/file-template/delete-all/${encodeURIComponent(category)}`;
            
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            form.appendChild(csrfInput);

            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            form.appendChild(methodInput);

            document.body.appendChild(form);
            form.submit();
        }
    });
}

/**
 * Confirm delete selected files using SweetAlert2
 */
function confirmDeleteSelected() {
    const checkedCheckboxes = $('.file-checkbox:checked', $('#filesTable').DataTable().rows().nodes());
    if (checkedCheckboxes.length === 0) return;

    Swal.fire({
        title: 'Hapus Terpilih?',
        text: `Apakah Anda yakin ingin menghapus ${checkedCheckboxes.length} berkas yang terpilih? Berkas ini tidak dapat dikembalikan!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = "{{ route('file-template.destroy-multiple') }}";
            
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            form.appendChild(csrfInput);

            checkedCheckboxes.each(function() {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'files[]';
                input.value = $(this).val();
                form.appendChild(input);
            });

            document.body.appendChild(form);
            form.submit();
        }
    });
}

/**
 * Unduh selected files (multiple)
 */
function downloadSelected() {
    const checkedCheckboxes = $('.file-checkbox:checked', $('#filesTable').DataTable().rows().nodes());
    if (checkedCheckboxes.length === 0) return;

    const form = document.createElement('form');
    form.method = 'POST';
    form.action = "{{ route('file-template.download-multiple') }}";
    
    const csrfInput = document.createElement('input');
    csrfInput.type = 'hidden';
    csrfInput.name = '_token';
    csrfInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    form.appendChild(csrfInput);

    checkedCheckboxes.each(function() {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'files[]';
        input.value = $(this).val();
        form.appendChild(input);
    });

    document.body.appendChild(form);
    form.submit();
    
    // Refresh page or uncheck everything after download start (optional)
    setTimeout(() => {
        document.body.removeChild(form);
        $('#selectAllCheckbox').prop('checked', false).trigger('change');
    }, 1000);
}
</script>
@endpush
