{{-- resources/views/log-kalibrasi/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Log Kalibrasi')

@section('content')
<div class="container-fluid cal-wrapper">
    <!-- ===== HERO HEADER ===== -->
    <div class="cal-hero">
        <div class="cal-hero-bg"></div>
        <div class="cal-hero-content d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div class="d-flex align-items-center gap-3">
                <div class="cal-hero-icon">
                    <i class="fas fa-history"></i>
                </div>
                &nbsp;&nbsp;
                <div>
                    <h4 class="mb-0 fw-bold text-white">Log Aktivitas Kalibrasi</h4>
                    <p class="mb-0 small text-white-50">Pantau dan audit riwayat perubahan data kalibrasi secara realtime</p>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button id="btnDeleteSelected" class="cal-btn-add text-danger bg-white fw-bold rounded-pill px-4 shadow-sm" style="display:none; border:none;">
                    <i class="fas fa-trash-alt me-2"></i> Hapus (<span id="selectedCount">0</span>)
                </button>
                <a href="{{ route('activity-logs.export', request()->query()) }}" id="btnExport"
                   class="cal-btn-add text-primary bg-white fw-bold rounded-pill px-4 shadow-sm" style="text-decoration:none;">
                    <i class="fas fa-file-export me-2"></i> Export Data Log
                </a>
            </div>
        </div>
    </div>

    <!-- ===== CONTROLS & FILTER ===== -->
    <div class="cal-body mb-4">
        <!-- Auto Refresh Toolbar -->
        <div class="cal-toolbar mb-3 d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div class="d-flex align-items-center flex-wrap gap-2">
                <span class="cal-label mb-0"><i class="fas fa-sync-alt me-1 text-primary"></i> Auto Refresh:</span>
                &nbsp;
                <div class="btn-group btn-group-sm" role="group" aria-label="Interval refresh">
                    <input type="radio" class="btn-check" name="refreshInterval" id="refreshOff" autocomplete="off" checked>
                    <label class="btn btn-outline-primary px-3 rounded-pill-start" for="refreshOff" style="border-top-left-radius: 20px; border-bottom-left-radius: 20px;">Off</label>

                    <input type="radio" class="btn-check" name="refreshInterval" id="refresh5s" autocomplete="off" data-interval="5000">
                    <label class="btn btn-outline-primary px-3" for="refresh5s">5s</label>

                    <input type="radio" class="btn-check" name="refreshInterval" id="refresh10s" autocomplete="off" data-interval="10000">
                    <label class="btn btn-outline-primary px-3" for="refresh10s">10s</label>

                    <input type="radio" class="btn-check" name="refreshInterval" id="refresh30s" autocomplete="off" data-interval="30000">
                    <label class="btn btn-outline-primary px-3 rounded-pill-end" for="refresh30s" style="border-top-right-radius: 20px; border-bottom-right-radius: 20px;">30s</label>
                </div>
            </div>

            <div class="d-flex align-items-center flex-wrap gap-3 ms-md-auto">
                <span id="refreshStatus" class="badge bg-secondary rounded-pill px-3 py-2 fw-semibold">
                    <i class="fas fa-pause-circle me-1"></i> Off
                </span>
                <span class="small text-muted text-nowrap fw-medium">
                    Terakhir: <strong id="lastUpdateTime" class="text-primary">{{ now()->format('H:i:s') }}</strong>
                </span>
                <button id="manualRefresh" class="btn btn-primary rounded-pill px-3 d-inline-flex align-items-center gap-1 shadow-sm" title="Refresh sekarang" style="height:36px; font-weight:700;">
                    <i class="fas fa-sync-alt"></i> <span>Refresh</span>
                </button>
            </div>
        </div>

        <!-- Filter Form -->
        <div class="p-3 rounded-3" style="background:#f8faff; border:1px solid #e2e8f0;">
            <div class="row g-2 align-items-end">
                <div class="col-md-2 col-sm-6">
                    <label class="form-label small fw-bold text-secondary mb-1">Aksi</label>
                    <select id="filterAksi" class="cal-select w-100" style="height:38px;">
                        <option value="">Semua Aksi</option>
                        @foreach($aksiList as $aksi)
                            <option value="{{ $aksi }}">{{ ucfirst($aksi) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2 col-sm-6">
                    <label class="form-label small fw-bold text-secondary mb-1">User</label>
                    <select id="filterUser" class="cal-select w-100" style="height:38px;">
                        <option value="">Semua User</option>
                        @foreach($userList as $user)
                            <option value="{{ $user->id }}">{{ $user->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2 col-sm-6">
                    <label class="form-label small fw-bold text-secondary mb-1">ID Model</label>
                    <input type="text" id="filterLogableId" class="cal-select w-100" placeholder="Contoh: PAS-000411-K26-1 / #PAS..." style="height:38px; padding:0 10px;">
                </div>

                <div class="col-md-2 col-sm-6">
                    <label class="form-label small fw-bold text-secondary mb-1">Tanggal Dari</label>
                    <input type="date" id="filterTanggalDari" class="cal-select w-100" style="height:38px; padding-right:10px;">
                </div>

                <div class="col-md-2 col-sm-6">
                    <label class="form-label small fw-bold text-secondary mb-1">Tanggal Sampai</label>
                    <input type="date" id="filterTanggalSampai" class="cal-select w-100" style="height:38px; padding-right:10px;">
                </div>

                <div class="col-md-2 col-sm-12">
                    <div class="d-flex gap-1 mt-md-3">
                        <button type="button" id="btnFilter" class="btn btn-primary rounded-pill px-3 flex-fill d-inline-flex align-items-center justify-content-center gap-1 shadow-sm" style="height:38px; font-weight:700;">
                            <i class="fas fa-filter"></i> <span>Filter</span>
                        </button>
                        <button type="button" id="btnReset" class="btn btn-secondary rounded-pill px-3 d-inline-flex align-items-center justify-content-center shadow-sm" title="Reset" style="height:38px; width:38px; flex-shrink:0;">
                            <i class="fas fa-redo"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== TABLE CONTAINER ===== -->
    <div class="cal-body">
        <div class="table-responsive cal-table-wrap">
            <table id="logsTable" class="table table-hover table-borderless align-middle mb-0 w-100">
                <thead class="table-light cal-thead">
                    <tr>
                        <th class="no-sort text-center" width="50">
                            <input type="checkbox" id="selectAll" title="Pilih Semua">
                        </th>
                        <th width="140">Waktu</th>
                        <th width="90">Aksi</th>
                        <th>Deskripsi</th>
                        <th width="110">Tipe Model</th>
                        <th width="100">ID Model</th>
                        <th width="150">User</th>
                        <th width="120">IP Address</th>
                        <th class="text-center no-sort" width="70">Detail</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus Multiple -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
            <div class="modal-body text-center p-4">
                <div class="mb-3 text-danger">
                    <i class="fas fa-exclamation-triangle fa-3x"></i>
                </div>
                <h5 class="fw-bold mb-2" id="deleteConfirmModalLabel">Konfirmasi Hapus Data</h5>
                <p class="text-muted small mb-4">Apakah Anda yakin ingin menghapus <strong id="deleteItemCount">0</strong> log aktivitas yang dipilih? Tindakan ini tidak dapat dibatalkan.</p>
                <div class="d-flex justify-content-center gap-2">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="button" id="confirmDeleteBtn" class="btn btn-danger rounded-pill px-4">Ya, Hapus</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* ============================================================
       THEME: Premium Light Blue-White (Activity Log Theme)
       ============================================================ */
    
    :root {
        --blue-primary: #2563eb;
        --blue-dark: #1e3a8a;
        --blue-medium: #1d4ed8;
        --blue-accent: #3b82f6;
        --blue-light: #eff6ff;
        --blue-pale: #dbeafe;
        --blue-border: #93c5fd;
        --gray-text: #475569;
        --gray-light: #f8fafc;
    }

    /* === Container === */
    .cal-wrapper {
        margin-bottom: 2.5rem;
    }

    /* === Hero Header === */
    .cal-hero {
        background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 55%, #2563eb 100%);
        border-radius: 16px;
        padding: 2.25rem 2.5rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(37,99,235,.22);
    }
    .cal-hero-bg {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        pointer-events: none;
    }
    .cal-hero-bg::before {
        content: '';
        position: absolute;
        top: -50px; right: -50px;
        width: 220px; height: 220px;
        background: radial-gradient(circle, rgba(255,255,255,.12) 0%, transparent 70%);
        border-radius: 50%;
    }
    .cal-hero-bg::after {
        content: '';
        position: absolute;
        bottom: -50px; left: 15%;
        width: 150px; height: 150px;
        background: radial-gradient(circle, rgba(255,255,255,.06) 0%, transparent 70%);
        border-radius: 50%;
    }
    .cal-hero-content {
        position: relative;
        z-index: 2;
    }
    .cal-hero-icon {
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
    .cal-hero-icon i { color: #ffffff !important; }

    /* === Add / Export Button === */
    .cal-btn-add {
        background: #ffffff;
        color: #1d4ed8 !important;
        font-weight: 700;
        font-size: 0.9rem;
        padding: 0.6rem 1.4rem;
        border-radius: 50px;
        border: none;
        display: inline-flex; align-items: center; justify-content: center;
        text-decoration: none !important;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .cal-btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        background: #f8fafc;
    }

    /* === Body / Card wrapper === */
    .cal-body {
        background: #ffffff;
        border-radius: 16px;
        padding: 1.5rem 1.75rem;
        box-shadow: 0 4px 20px rgba(37,99,235,.06);
        border: 1px solid #e2e8f0;
    }

    /* === Toolbar === */
    .cal-toolbar {
        background: #eff6ff;
        border: 1.5px solid #dbeafe;
        border-radius: 14px;
        padding: 0.9rem 1.25rem;
    }
    .cal-label {
        font-weight: 700;
        color: #1e3a8a;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* === Custom Select & Inputs === */
    .cal-select {
        border: 1.5px solid #2563eb;
        border-radius: 10px;
        padding: 6px 12px;
        font-size: 0.85rem;
        color: #1e3a8a;
        font-weight: 600;
        background-color: #fff;
        transition: all .2s;
        outline: none;
    }
    select.cal-select {
        padding-right: 32px;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%232563eb' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 12px;
        appearance: none;
        cursor: pointer;
    }
    .cal-select:focus {
        border-color: #1d4ed8;
        box-shadow: 0 0 0 3px rgba(37,99,235,.18);
    }

    /* === Button group checked states === */
    .btn-check:checked + .btn-outline-primary {
        background-color: #2563eb !important;
        color: #fff !important;
        border-color: #2563eb !important;
        box-shadow: 0 4px 10px rgba(37,99,235,0.2) !important;
        font-weight: 700;
    }
    .btn-outline-primary {
        border-color: #2563eb;
        color: #2563eb;
        font-weight: 600;
        transition: all 0.2s ease;
    }
    .btn-outline-primary:hover {
        background-color: #eff6ff;
        color: #1d4ed8;
        border-color: #1d4ed8;
    }

    /* === Table Wrap === */
    .cal-table-wrap {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        box-shadow: 0 2px 10px rgba(0,0,0,0.02);
    }

    /* === Table Head === */
    .table thead.cal-thead th {
        background-color: #e8f0fe !important; /* Biru muda premium yang bersih, terang, dan mewah */
        background-image: none !important;
        color: #1e3a8a !important; /* Teks biru tua yang sangat kontras, tegas, dan elegan */
        font-weight: 800 !important;
        font-size: 0.8rem !important;
        text-transform: uppercase !important;
        letter-spacing: 0.8px !important;
        border: none !important; /* Hilangkan seluruh garis hitam dan garis pembatas vertikal antar kolom */
        border-bottom: 2px solid #93c5fd !important; /* Garis bawah biru muda lembut sebagai pemisah yang manis */
        padding: 14px 16px !important;
        vertical-align: middle;
        white-space: nowrap;
        text-shadow: none !important;
    }

    /* Override untuk DataTables & Bootstrap agar tidak ada sisa garis hitam pembatas di header */
    table.dataTable thead th, 
    table.dataTable thead td,
    #logsTable thead th,
    .cal-table-wrap thead th {
        border: none !important;
        border-bottom: 2px solid #93c5fd !important; /* Garis pembatas biru muda lembut */
    }

    /* === Table Body === */
    .table tbody td {
        padding: 12px 16px;
        vertical-align: middle;
        font-size: 0.875rem;
        color: #374151;
        border-bottom: 1px solid #f1f5f9 !important;
    }
    .table-hover tbody tr:hover td {
        background-color: #f0f7ff !important;
        transition: background-color 0.15s ease;
    }
    .table tbody tr:nth-child(even) td {
        background-color: #f8fafc;
    }
    .table tbody tr:nth-child(even):hover td {
        background-color: #f0f7ff !important;
    }

    /* === Badges & Buttons === */
    .badge {
        font-size: 0.75rem;
        padding: 0.4em 0.8em;
        border-radius: 10px;
        font-weight: 600;
    }
    .btn { transition: all 0.2s ease; }
    .btn:hover { transform: translateY(-1px); box-shadow: 0 4px 10px rgba(0,0,0,0.08); }
    .btn-primary { background: linear-gradient(135deg, #2563eb, #1d4ed8) !important; border: none !important; }
    .btn-secondary { background: #64748b !important; border: none !important; }
    .btn-outline-primary { border-color: #2563eb; color: #2563eb; }

    /* === DataTables Search & Elements === */
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        margin: 1.25rem;
    }
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_paginate {
        padding: 1.25rem;
        margin-top: 0;
    }
    div.dataTables_wrapper div.dataTables_filter input {
        border: 1.5px solid #2563eb !important;
        border-radius: 10px !important;
        padding: 6px 12px !important;
        font-size: 0.85rem !important;
        outline: none;
        height: 38px;
        transition: border-color .2s;
    }
    div.dataTables_wrapper div.dataTables_filter input:focus {
        border-color: #1d4ed8 !important;
        box-shadow: 0 0 0 3px rgba(37,99,235,.15) !important;
    }
    .dataTables_wrapper .dataTables_filter label { color: #1e3a8a; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border: none !important;
        background: transparent !important;
        border-radius: 8px !important;
        margin-left: 2px;
        padding: 6px 12px !important;
        color: #4b5563 !important;
        font-size: 0.85rem;
        transition: all 0.2s ease !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background: #2563eb !important;
        color: #fff !important;
        font-weight: 700 !important;
        box-shadow: 0 4px 12px rgba(37,99,235,.35) !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover:not(.current) {
        background: #dbeafe !important;
        color: #1d4ed8 !important;
    }

    .highlight-row {
        animation: highlightFade 2s ease-out;
    }
    @keyframes highlightFade {
        0% { background-color: rgba(37, 99, 235, 0.25); }
        100% { background-color: transparent; }
    }
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    let refreshTimer = null;
    let lastDataHash = null;

    // Function to update refresh status display
    function updateRefreshStatus(interval) {
        if (!interval) {
            $('#refreshStatus').html('<i class="fas fa-pause-circle me-1"></i> Off');
            $('#refreshStatus').removeClass('bg-success').addClass('bg-secondary');
        } else {
            const seconds = interval / 1000;
            $('#refreshStatus').html(`<i class="fas fa-sync-alt fa-spin me-1"></i> ${seconds}s`);
            $('#refreshStatus').removeClass('bg-secondary').addClass('bg-success');
        }
    }

    // Function to update last update time
    function updateLastUpdateTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
        $('#lastUpdateTime').text(timeString);
    }

    // Initialize DataTable
    var table = $('#logsTable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {
            url: '{{ route("activity-logs.data") }}',
            type: 'GET',
            data: function(d) {
                d.activity_type = $('#filterAksi').val();
                d.performed_by = $('#filterUser').val();
                d.logable_id = $('#filterLogableId').val();
                d.tanggal_dari = $('#filterTanggalDari').val();
                d.tanggal_sampai = $('#filterTanggalSampai').val();
            },
            complete: function() {
                updateLastUpdateTime();
            }
        },
        columns: [
            { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false, className: 'text-center' },
            { data: 'created_at', name: 'created_at' },
            { data: 'activity_type', name: 'activity_type', orderable: false },
            { data: 'description', name: 'description' },
            { data: 'logable_type', name: 'logable_type' },
            { data: 'logable_id', name: 'logable_id' },
            { data: 'performer', name: 'performer' },
            { data: 'ip_address', name: 'ip_address' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
        order: [[1, 'desc']],
        pageLength: 15,
        lengthMenu: [[10, 15, 25, 50, 100, -1], [10, 15, 25, 50, 100, "Semua"]],
        language: {
            processing: '<div class="spinner-border spinner-border-sm text-primary me-2"></div>Memproses...',
            search: '<i class="fas fa-search"></i> Cari:',
            lengthMenu: 'Tampilkan _MENU_ data per halaman',
            info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
            infoEmpty: 'Tidak ada data',
            infoFiltered: '(difilter dari _MAX_ total data)',
            loadingRecords: '<div class="spinner-border spinner-border-sm text-primary me-2"></div>Memuat data...',
            zeroRecords: 'Tidak ada data ditemukan',
            emptyTable: 'Tidak ada data tersedia',
            paginate: {
                first: '<i class="fas fa-angle-double-left"></i>',
                previous: '<i class="fas fa-angle-left"></i>',
                next: '<i class="fas fa-angle-right"></i>',
                last: '<i class="fas fa-angle-double-right"></i>'
            }
        },
        drawCallback: function(settings) {
            $('.dataTables_processing').css('background', 'rgba(255,255,255,0.8)');
            
            // Highlight new rows (baris yang baru muncul)
            const currentData = JSON.stringify(settings.aoData.map(row => row._aData));
            if (lastDataHash && lastDataHash !== currentData) {
                $('#logsTable tbody tr').addClass('highlight-row');
                setTimeout(() => {
                    $('#logsTable tbody tr').removeClass('highlight-row');
                }, 2000);
            }
            lastDataHash = currentData;
            
            // Reset select all checkbox pada draw
            $('#selectAll').prop('checked', false);
            updateDeleteButtonVisibility();
            
            // Perbarui URL Ekspor secara dinamis
            updateExportUrl(settings);
        }
    });

    // Handle Select All Checkbox
    $('#selectAll').on('change', function() {
        const isChecked = $(this).is(':checked');
        $('.row-checkbox').prop('checked', isChecked);
        updateDeleteButtonVisibility();
    });

    // Handle Individual Row Checkbox
    $(document).on('change', '.row-checkbox', function() {
        const totalRows = $('.row-checkbox').length;
        const totalChecked = $('.row-checkbox:checked').length;
        $('#selectAll').prop('checked', totalRows > 0 && totalRows === totalChecked);
        updateDeleteButtonVisibility();
    });

    // Update visibility and count for delete button
    function updateDeleteButtonVisibility() {
        const selectedCount = $('.row-checkbox:checked').length;
        $('#selectedCount').text(selectedCount);
        if (selectedCount > 0) {
            $('#btnDeleteSelected').fadeIn(200);
        } else {
            $('#btnDeleteSelected').fadeOut(200);
        }
    }

    // Trigger Delete Confirmation Modal
    $('#btnDeleteSelected').on('click', function() {
        const selectedCount = $('.row-checkbox:checked').length;
        if (selectedCount === 0) return;
        
        $('#deleteItemCount').text(selectedCount);
        $('#deleteConfirmModal').modal('show');
    });

    // Confirm Delete Action
    $('#confirmDeleteBtn').on('click', function() {
        const selectedCheckboxes = $('.row-checkbox:checked');
        const ids = [];
        selectedCheckboxes.each(function() {
            ids.push($(this).data('id'));
        });

        if (ids.length === 0) return;

        const $btn = $(this);
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i> Menghapus...');

        $.ajax({
            url: '{{ route("activity-logs.destroyMultiple") }}',
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}',
                ids: ids
            },
            success: function(response) {
                $('#deleteConfirmModal').modal('hide');
                $btn.prop('disabled', false).text('Ya, Hapus');

                if (response.success) {
                    // Remove selected rows from UI instantly
                    selectedCheckboxes.each(function() {
                        table.row($(this).closest('tr')).remove();
                    });
                    table.draw(false); // Redraw UI layout without reloading from server

                    $('#selectAll').prop('checked', false);
                    updateDeleteButtonVisibility();
                } else {
                    alert('Gagal: ' + (response.message || 'Terjadi kesalahan'));
                }
            },
            error: function(xhr) {
                $('#deleteConfirmModal').modal('hide');
                $btn.prop('disabled', false).text('Ya, Hapus');
                alert('Gagal menghapus data. Silakan coba lagi.');
            }
        });
    });

    // Function to update export button link dynamically
    function updateExportUrl(settings) {
        let baseUrl = '{{ route("activity-logs.export") }}';
        let searchVal = '';
        if (settings && settings.oPreviousSearch) {
            searchVal = settings.oPreviousSearch.sSearch;
        } else if (typeof table !== 'undefined' && table) {
            searchVal = table.search();
        }
        
        let params = $.param({
            activity_type: $('#filterAksi').val(),
            performed_by: $('#filterUser').val(),
            logable_id: $('#filterLogableId').val(),
            tanggal_dari: $('#filterTanggalDari').val(),
            tanggal_sampai: $('#filterTanggalSampai').val(),
            search: searchVal
        });
        $('#btnExport').attr('href', baseUrl + '?' + params);
    }

    // Function to refresh table data
    function refreshTable() {
        table.ajax.reload(null, false); // false = tetap di halaman yang sama
        updateLastUpdateTime();
    }

    // Function to setup auto refresh
    function setupAutoRefresh(interval) {
        if (refreshTimer) {
            clearInterval(refreshTimer);
            refreshTimer = null;
        }
        
        updateRefreshStatus(interval);
        
        if (interval) {
            refreshTimer = setInterval(refreshTable, interval);
            // Simpan ke localStorage
            localStorage.setItem('logKalibrasiRefreshInterval', interval);
        } else {
            localStorage.setItem('logKalibrasiRefreshInterval', 'off');
        }
    }

    // Auto refresh radio buttons
    $('#refreshOff').on('change', function() {
        if ($(this).is(':checked')) {
            setupAutoRefresh(null);
        }
    });
    
    $('#refresh5s').on('change', function() {
        if ($(this).is(':checked')) {
            setupAutoRefresh(5000);
        }
    });
    
    $('#refresh10s').on('change', function() {
        if ($(this).is(':checked')) {
            setupAutoRefresh(10000);
        }
    });
    
    $('#refresh30s').on('change', function() {
        if ($(this).is(':checked')) {
            setupAutoRefresh(30000);
        }
    });

    // Manual refresh button
    $('#manualRefresh').on('click', function() {
        const $btn = $(this);
        $btn.prop('disabled', true);
        $btn.html('<i class="fas fa-spinner fa-spin"></i>');
        
        refreshTable();
        
        setTimeout(() => {
            $btn.prop('disabled', false);
            $btn.html('<i class="fas fa-sync-alt"></i>');
        }, 800);
    });

    // Filter button click
    $('#btnFilter').on('click', function() {
        refreshTable();
    });

    // Reset button click
    $('#btnReset').on('click', function() {
        $('#filterAksi').val('');
        $('#filterUser').val('');
        $('#filterLogableId').val('');
        $('#filterTanggalDari').val('');
        $('#filterTanggalSampai').val('');
        refreshTable();
    });

    // Enter key on filter inputs
    $('#filterAksi, #filterUser, #filterLogableId, #filterTanggalDari, #filterTanggalSampai').on('keypress', function(e) {
        if (e.which === 13) {
            $('#btnFilter').click();
        }
    });

    // Update export URL instantly on any filter input change
    $('#filterAksi, #filterUser, #filterLogableId, #filterTanggalDari, #filterTanggalSampai').on('change input', function() {
        updateExportUrl();
    });

    // Load saved refresh preference from localStorage
    const savedInterval = localStorage.getItem('logKalibrasiRefreshInterval');
    if (savedInterval && savedInterval !== 'off') {
        const interval = parseInt(savedInterval);
        const radio = $(`input[data-interval="${interval}"]`);
        if (radio.length) {
            radio.prop('checked', true);
            setupAutoRefresh(interval);
        } else {
            $('#refreshOff').prop('checked', true);
            setupAutoRefresh(null);
        }
    } else if (savedInterval === 'off') {
        $('#refreshOff').prop('checked', true);
        setupAutoRefresh(null);
    }

    // Update initial time
    updateLastUpdateTime();
});
</script>
@endpush