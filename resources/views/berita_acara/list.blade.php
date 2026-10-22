@extends('layouts.app')
@section('title', ' DAFTAR BERITA ACARA')

@section('content')
<div class="container-fluid px-2 px-md-4 py-3">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden bg-white">
               <div class="card-header bg-white border-bottom py-3" style="position: relative;">
                        <div class="d-flex align-items-center gap-3">
                            <div class="ba-icon-box">
                                <i class="fas fa-file-alt text-primary"></i>
                            </div>
                             &nbsp; &nbsp;
                            <div>
                                <h4 class="mb-0 fs-5 text-dark fw-bold">Daftar Berita Acara</h4>
                            </div>
                        </div>
                        <a href="{{ route('berita-acara.index') }}" class="btn btn-primary btn-sm px-3 rounded-pill shadow-sm" style="color: #ffffff !important; text-decoration: none !important; position: absolute; right: 20px; top: 50%; transform: translateY(-50%);">
                            <i class="fas fa-plus-circle me-1" style="color: #ffffff !important;"></i> Buat Baru
                        </a>
                    </div>

                <div class="card-body bg-white p-2 p-md-3">
                    <!-- Tabel DataTables Responsif -->
                 <div class="table-responsive">
    <table id="beritaAcaraTable" 
           class="table table-hover table-borderless align-middle" 
           style="width:100%;">
        
        <thead class="ba-table-header">
            <tr>
                <th class="text-center">No</th>
                <th>No. BA</th>
                <th>Tanggal</th>
                <th>Perusahaan</th>
                <th class="text-center">Jumlah Alat</th>
                <th>Daftar Alat</th>
                <th>Dikalibrasi Oleh</th>
                <th class="text-center">Status</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        
        <tbody>
           @forelse($beritaAcara as $index => $ba)
    @php
        $currentUserName = auth()->user()->nama;
        $canView = true;
        
        // Ambil data calibratedBy dari controller (sudah ditambahkan di controller)
        $calibratedBy = $ba->calibratedBy ?? '-';
    @endphp
    
    @if($canView)
    <tr>
        <td class="text-center">{{ $index + 1 }}</td>
        <td><strong class="text-primary">{{ $ba->no_ba }}</strong></td>
        <td>{{ $ba->tanggal ? \Carbon\Carbon::parse($ba->tanggal)->format('d/m/Y') : '-' }}</td>
        <td>{{ Str::limit(e($ba->perusahaan ?? '-'), 40) }}</td>
        <td class="text-center">
            <span class="badge bg-primary">{{ $ba->jumlah_alat }}</span>
        </td>
        <td title="{{ e($ba->nama_alat_list ?? '-') }}">
            {{ Str::limit(e($ba->nama_alat_list ?? '-'), 55, '...') }}
        </td>
        <td>{{ $calibratedBy }}</td>
        <td class="text-center">
            {!! $ba->status_badge ?? '<span class="badge bg-secondary">Unknown</span>' !!}
        </td>
        <td class="text-center">
            @php
                $isApproved = strtolower($ba->status_transaction ?? $ba->status ?? '') === 'approved' || (isset($ba->status_badge) && str_contains(strtolower($ba->status_badge), 'approved'));
                $disableEdit = $isApproved;
            @endphp
            <div class="d-flex align-items-center justify-content-center gap-1 flex-wrap">
                <button class="ba-action-btn btn-info" onclick="showDetail('{{ $ba->no_ba }}')" title="Detail" data-bs-toggle="tooltip">
                    <i class="fas fa-eye"></i>
                </button>
                @if(!$disableEdit)
                <button class="ba-action-btn btn-warning" onclick="editBeritaAcara('{{ $ba->no_ba }}')" title="Edit" data-bs-toggle="tooltip">
                    <i class="fas fa-edit text-white"></i>
                </button>
                @endif
                @if(auth()->user()->role !== 'teknisi')
                <button class="ba-action-btn btn-danger" onclick="confirmDelete('{{ $ba->no_ba }}')" title="Hapus" data-bs-toggle="tooltip">
                    <i class="fas fa-trash"></i>
                </button>
                @endif
                <a href="{{ url('berita-acara/approval/' . $ba->no_ba) }}" class="ba-action-btn btn-success" title="Approval" data-bs-toggle="tooltip">
                    <i class="fas fa-check"></i>
                </a>
            </div>
        </td>
    </tr>
    @endif
@empty
    <tr>
        <td colspan="9" class="text-center py-5">
            <i class="fas fa-folder-open fa-4x mb-3 opacity-50"></i>
            <h5>Tidak ada data berita acara</h5>
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
</div>

<!-- Modal View Detail Responsif -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-3">
            <div class="modal-header bg-white border-bottom py-3">
                <h5 class="modal-title fw-bold text-dark fs-6" id="viewModalLabel">
                    <span class="ba-modal-icon me-2"><i class="fas fa-file-alt text-primary"></i></span> Detail Berita Acara
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-2 p-md-3" id="viewModalBody" style="max-height: 70vh; overflow-y: auto; background: #f8faff;"></div>
            <div class="modal-footer bg-white border-top py-2 p-md-3">
                <button type="button" class="btn btn-light px-4 rounded-pill" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Responsif -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-3">
            <div class="modal-header bg-white border-bottom py-3">
                <h5 class="modal-title fw-bold text-dark fs-6" id="editModalLabel">
                    <span class="ba-modal-icon me-2"><i class="fas fa-edit text-warning"></i></span> Edit Berita Acara
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-2 p-md-3" id="editModalBody" style="max-height: 70vh; overflow-y: auto; background: #f8faff;"></div>
            <div class="modal-footer bg-white border-top py-2 p-md-3">
                <button type="button" class="btn btn-light px-4 rounded-pill" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-warning text-white px-4 rounded-pill shadow-sm" id="btnSaveEdit">
                    <i class="fas fa-save me-1"></i> Simpan Perubahan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus Responsif -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-3">
            <div class="modal-header bg-white border-bottom py-3">
                <h5 class="modal-title fw-bold text-dark fs-6" id="deleteModalLabel">
                    <span class="ba-modal-icon me-2"><i class="fas fa-exclamation-triangle text-danger"></i></span> Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 text-center">
                <div class="ba-delete-icon mb-3">
                    <i class="fas fa-trash-alt fa-2x text-danger"></i>
                </div>
                <h6 class="fw-bold text-dark mb-2">Hapus Berita Acara ini?</h6>
                <p class="text-secondary small mb-3">Anda yakin ingin menghapus BA nomor <strong id="deleteNoBa" class="text-danger"></strong>?</p>
                <div class="alert alert-danger bg-danger-subtle border-0 py-2 text-start rounded-3 mb-0">
                    <p class="text-danger small mb-0">
                        <i class="fas fa-info-circle me-1"></i> Tindakan ini akan menghapus semua alat secara permanen!
                    </p>
                </div>
            </div>
            <div class="modal-footer bg-white border-top py-2">
                <button type="button" class="btn btn-light rounded-pill px-4" data-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" action="" class="m-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger rounded-pill px-4 shadow-sm">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Approval Responsif -->
<div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-3">
            <div class="modal-header bg-white border-bottom py-3">
                <h5 class="modal-title fw-bold text-dark fs-6" id="approveModalLabel">
                    <span class="ba-modal-icon me-2"><i class="fas fa-check-circle text-success"></i></span> Approval Berita Acara
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="text-center mb-4">
                    <div class="ba-approve-icon mb-2">
                        <i class="fas fa-stamp fa-2x text-success"></i>
                    </div>
                    <p class="text-secondary small mb-0">Setujui Berita Acara nomor <strong id="approveNoBa" class="text-success"></strong></p>
                </div>
                <div class="mb-0">
                    <label for="approveNote" class="form-label fw-semibold small text-secondary mb-1">Catatan Approval (Opsional)</label>
                    <textarea id="approveNote" class="form-control" rows="3" placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                </div>
            </div>
            <div class="modal-footer bg-white border-top py-2">
                <button type="button" class="btn btn-light rounded-pill px-4" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success rounded-pill px-4 shadow-sm" id="btnConfirmApprove">
                    <i class="fas fa-check me-1"></i> Ya, Setujui
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.bootstrap5.min.css">

<style>
    /* === Icon box header === */
    .ba-icon-box {
        width: 44px;
        height: 44px;
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        flex-shrink: 0;
        color: white;
    }
    .ba-icon-box i { color: white !important; }

    /* === Table header solid blue === */
    .table thead.ba-table-header th {
        background-color: #e8f0fe !important;
        background-image: none !important;
        color: #1e3a8a !important;
        font-weight: 800 !important;
        font-size: 0.8rem !important;
        text-transform: uppercase !important;
        letter-spacing: 0.8px !important;
        border: none !important;
        border-bottom: 2px solid #93c5fd !important;
        padding: 12px 14px !important;
        vertical-align: middle;
        white-space: nowrap;
        text-shadow: none !important;
    }

    table.dataTable thead th, 
    table.dataTable thead td,
    #beritaAcaraTable thead th {
        border: none !important;
        border-bottom: 2px solid #93c5fd !important;
    }

    /* === Table rows clean === */
    .table td {
        vertical-align: middle;
        font-size: 0.875rem;
        color: #374151;
        border-bottom: 1px solid #f1f5f9 !important;
        padding: 12px 16px;
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

    /* === Action Buttons === */
    .ba-action-btn {
        width: 32px; height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        font-size: 0.88rem;
        transition: all 0.22s cubic-bezier(0.4, 0, 0.2, 1);
        border: none;
        box-shadow: 0 2px 5px rgba(0,0,0,.08);
        color: white !important;
        text-decoration: none !important;
    }
    .ba-action-btn:hover {
        transform: translateY(-2px) scale(1.05);
        box-shadow: 0 6px 15px rgba(0,0,0,.15);
    }
    .ba-action-btn i { color: white !important; }
    
    .ba-action-btn.btn-info     { background: #3b82f6 !important; }
    .ba-action-btn.btn-info:hover { background: #2563eb !important; }
    .ba-action-btn.btn-warning  { background: #f59e0b !important; }
    .ba-action-btn.btn-warning:hover { background: #d97706 !important; }
    .ba-action-btn.btn-danger   { background: #f43f5e !important; }
    .ba-action-btn.btn-danger:hover { background: #e11d48 !important; }
    .ba-action-btn.btn-success  { background: #10b981 !important; }
    .ba-action-btn.btn-success:hover { background: #059669 !important; }

    /* === Modal icon box === */
    .ba-modal-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 30px;
        height: 30px;
        background: #f1f5f9;
        border-radius: 8px;
    }

    .ba-delete-icon, .ba-approve-icon {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        background: #fef2f2;
    }
    .ba-approve-icon {
        background: #f0fdf4;
    }

    .form-control, textarea {
        border: 1px solid #e2e8f0 !important;
        border-radius: 8px !important;
        background-color: #fff !important;
        color: #1e293b !important;
        transition: border-color 0.2s, box-shadow 0.2s !important;
    }
    .form-control:focus, textarea:focus {
        border-color: #2563eb !important;
        box-shadow: 0 0 0 3px rgba(37,99,235,.12) !important;
    }

    .btn-sm, .btn-group-sm .btn {
        font-size: 0.82rem;
        padding: 0.3rem 0.6rem;
        border-radius: 6px;
        transition: all 0.2s ease;
    }
    .btn-group-sm .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 3px 8px rgba(0,0,0,0.12);
    }

    .badge {
        font-weight: 600;
        padding: 0.4em 0.85em;
        border-radius: 10px;
        white-space: nowrap;
    }

    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 0.4rem 0.75rem;
        font-size: 0.875rem;
        width: 250px !important;
        outline: none;
        transition: border-color 0.2s ease;
    }
    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37,99,235,.1);
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border: none !important;
        background: transparent !important;
        border-radius: 8px !important;
        margin-left: 2px;
        padding: 6px 12px !important;
        color: #64748b !important;
        font-size: 0.85rem;
        transition: all 0.15s ease !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background: #2563eb !important;
        color: #fff !important;
        font-weight: 600 !important;
        box-shadow: 0 3px 8px rgba(37,99,235,.25) !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover:not(.current) {
        background: #eff6ff !important;
        color: #2563eb !important;
    }

    @media (max-width: 768px) {
        .dataTables_wrapper .dataTables_filter input { width: 100% !important; }
        .btn-group-sm .btn { padding: 0.25rem 0.4rem; }
        .modal-dialog { margin: 0.5rem; }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.bootstrap5.min.js"></script>

<script>
// ========== CONSOLE LOG UNTUK DEBUGGING ==========
console.log('========== LIST BERITA ACARA ==========');
console.log('Jumlah data BA: {{ $beritaAcara->count() }}');

// Log data BA dengan calibratedBy
@foreach($beritaAcara as $ba)
    console.log('BA: {{ $ba->no_ba }} | calibratedBy: {{ $ba->calibratedBy ?? '-' }}');
@endforeach
console.log('========================================');

const bahasaIndonesia = {
    "decimal": "",
    "emptyTable": "Tidak ada data yang tersedia dalam tabel",
    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
    "infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
    "infoFiltered": "(difilter dari _MAX_ total entri)",
    "lengthMenu": "Tampilkan _MENU_ baris",
    "loadingRecords": "Memuat...",
    "processing": "Memproses...",
    "search": "Cari:",
    "zeroRecords": "Data tidak ditemukan",
    "paginate": {
        "next": "Selanjutnya",
        "previous": "Sebelumnya"
    },
    "aria": {
        "sortAscending": ": aktifkan untuk mengurutkan kolom ascending",
        "sortDescending": ": aktifkan untuk mengurutkan kolom descending"
    }
};

$(document).ready(function () {
    console.log('Inisialisasi DataTables...');
    
    var table = $('#beritaAcaraTable').DataTable({
        language: bahasaIndonesia,
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100, 200],
        order: [[2, 'desc']],
        responsive: true,
        autoWidth: false,
        
        data: [],
        columns: [
            { title: "No", data: null, render: function(data, type, row, meta) { return meta.row + 1; } },
            { title: "No. BA", data: "no_ba" },
            { title: "Tanggal", data: "tanggal" },
            { title: "Perusahaan", data: "perusahaan" },
            { title: "Jumlah Alat", data: "jumlah_alat" },
            { title: "Daftar Alat", data: "nama_alat_list" },
            { title: "Dikalibrasi Oleh", data: "calibratedBy" },
            { title: "Status", data: "status_badge" },
            { title: "Aksi", data: "aksi" }
        ],
        
        columnDefs: [
            { orderable: false, targets: [0, 8] },
            { className: "text-center", targets: [0, 4, 7, 8] }
        ],
        
        dom: '<"row mb-3"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
             'rt' +
             '<"row mt-3"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7 text-end"p>>'
    });
    
    console.log('DataTables diinisialisasi');
    
    @if($beritaAcara->count() > 0)
        console.log('Memuat data ke DataTables...');
        var data = [];
        @foreach($beritaAcara as $ba)
            @php
                $isApproved = strtolower($ba->status_transaction ?? $ba->status ?? '') === 'approved' || (isset($ba->status_badge) && str_contains(strtolower($ba->status_badge), 'approved'));
                $disableEdit = $isApproved;
                
                $aksiHtml = '<div class="d-flex align-items-center justify-content-center gap-1 flex-wrap">';
                $aksiHtml .= '<button class="ba-action-btn btn-info" onclick="showDetail(\'' . $ba->no_ba . '\')" title="Detail" data-bs-toggle="tooltip"><i class="fas fa-eye"></i></button>';
                
                if (!$disableEdit) {
                    $aksiHtml .= '<button class="ba-action-btn btn-warning" onclick="editBeritaAcara(\'' . $ba->no_ba . '\')" title="Edit" data-bs-toggle="tooltip"><i class="fas fa-edit text-white"></i></button>';
                }
                
                if (auth()->user()->role !== 'teknisi') {
                    $aksiHtml .= '<button class="ba-action-btn btn-danger" onclick="confirmDelete(\'' . $ba->no_ba . '\')" title="Hapus" data-bs-toggle="tooltip"><i class="fas fa-trash"></i></button>';
                }
                
                $aksiHtml .= '<a href="' . url('berita-acara/approval/' . $ba->no_ba) . '" class="ba-action-btn btn-success" title="Approval" data-bs-toggle="tooltip"><i class="fas fa-check"></i></a>';
                $aksiHtml .= '</div>';
            @endphp
            data.push({
                no_ba: '{{ $ba->no_ba }}',
                tanggal: '{{ $ba->tanggal ? \Carbon\Carbon::parse($ba->tanggal)->format('d/m/Y') : '-' }}',
                perusahaan: '{{ $ba->perusahaan ?? '-' }}',
                jumlah_alat: '{{ $ba->jumlah_alat }}',
                nama_alat_list: '{{ $ba->nama_alat_list ?? '-' }}',
                calibrated_by: '{{ $ba->calibratedBy ?? '-' }}',
                status_badge: '{!! $ba->status_badge ?? '<span class="badge bg-secondary">Unknown</span>' !!}',
                aksi: `{!! $aksiHtml !!}`
            });
        @endforeach
        console.log('Data yang akan dimuat ke DataTables:', data);
        table.clear().rows.add(data).draw();
        console.log('Data berhasil dimuat ke DataTables');
    @else
        console.log('Tidak ada data untuk dimuat');
    @endif
});
// ==================================================

function showDetail(noBa) {
    $('#viewModal').modal('show');
    $('#viewModalBody').html(`
        <div class="text-center py-5">
            <div class="spinner-border text-primary" role="status"></div>
            <p class="mt-3 fw-bold">Memuat detail...</p>
        </div>
    `);

    $.ajax({
        url: '/berita-acara/detail/' + noBa,
        success: function(res) {
            console.log('Detail BA:', res);
            let h = res.header;
            let alat = res.alatList || [];
            
            // Ambil calibratedBy dari data calibration
            let calibratedBy = h.calibration ? (h.calibration.calibratedBy || '-') : '-';
            
            let html = `
                <div class="bg-white p-3 p-md-4 rounded shadow-sm mb-4">
                    <div class="row g-2 g-md-3">
                        <div class="col-12 col-md-4"><strong>No. BA</strong><br><span class="fs-5 fs-md-4 text-primary">${h.no_ba}</span></div>
                        <div class="col-6 col-md-4"><strong>Tanggal</strong><br>${h.tanggal_formatted}</div>
                        <div class="col-6 col-md-4"><strong>Status</strong><br>${h.status_badge}</div>
                    </div>
                    <hr class="my-2 my-md-3">
                    <div class="row g-2 g-md-3">
                        <div class="col-12 col-md-6"><strong>Perusahaan</strong><br>${h.perusahaan || '-'}</div>
                        <div class="col-12 col-md-6"><strong>Alamat</strong><br>${h.alamat || '-'}</div>
                    </div>
                    <hr class="my-2 my-md-3">
                    <div class="row g-2 g-md-3">
                        <div class="col-12 col-md-6"><strong>Dikalibrasi Oleh</strong><br>${calibratedBy}</div>
                    </div>
                </div>
                <h6 class="fw-bold mb-2 mb-md-3">DAFTAR ALAT (${alat.length} item)</h6>
                <div class="table-responsive bg-white rounded shadow-sm">
                    <table class="table table-bordered table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="d-none d-sm-table-cell">No</th>
                                <th>Nama Alat</th>
                                <th class="d-none d-md-table-cell">Merek</th>
                                <th class="d-none d-md-table-cell">Tipe</th>
                                <th class="d-none d-lg-table-cell">Rentang Ukur</th>
                                <th class="d-none d-sm-table-cell">No Seri</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>`;

            alat.forEach((item, i) => {
                html += `
                    <tr>
                        <td class="d-none d-sm-table-cell">${i+1}</td>
                        <td><span class="d-block d-sm-none fw-bold">${i+1}.</span> ${item.nama_alat || '-'}</td>
                        <td class="d-none d-md-table-cell">${item.merek || '-'}</td>
                        <td class="d-none d-md-table-cell">${item.type_alat || '-'}</td>
                        <td class="d-none d-lg-table-cell">${item.kapasitas || '-'}</td>
                        <td class="d-none d-sm-table-cell">${item.no_seri || '-'}</td>
                        <td>${item.keterangan || '-'}</td>
                    </tr>`;
            });

            html += `</tbody>
                    </table>
                </div>`;

            if (h.catatan) {
                html += `<div class="bg-white p-3 p-md-4 rounded shadow-sm mt-3 mt-md-4">
                            <h6 class="fw-bold mb-2">Catatan</h6>
                            <p class="mb-0 small">${h.catatan}</p>
                         </div>`;
            }

            $('#viewModalBody').html(html);
        },
        error: function(xhr) {
            console.error('Error loading detail:', xhr);
            $('#viewModalBody').html('<div class="alert alert-danger text-center py-4">Gagal memuat detail.</div>');
        }
    });
}

function editBeritaAcara(noBa) {
    $('#editModal').modal('show');
    $('#editModalBody').html(`
        <div class="text-center py-5">
            <div class="spinner-border text-warning" role="status"></div>
            <p class="mt-3 fw-bold">Memuat data untuk diedit...</p>
        </div>
    `);

    $.ajax({
        url: '/berita-acara/detail/' + noBa,
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(res) {
            console.log('Edit data:', res);
            let h = res.header;
            let alat = res.alatList || [];
            
            let tanggal = h.tanggal_formatted;
            if (tanggal) {
                let parts = tanggal.split('/');
                if (parts.length === 3) {
                    tanggal = parts[2] + '-' + parts[1] + '-' + parts[0];
                }
            }
            
            // Ambil calibratedBy dari data calibration
            let calibratedBy = h.calibration ? (h.calibration.calibratedBy || '') : '';

            let html = `
                <form id="editForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="no_ba" value="${h.no_ba}">
                    
                    <div class="bg-white p-3 p-md-4 rounded shadow-sm mb-4">
                        <h6 class="fw-bold mb-3 text-warning"><i class="fas fa-info-circle me-2"></i>Informasi Berita Acara</h6>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label fw-bold small mb-1">No. BA</label>
                                <input type="text" class="form-control form-control-sm bg-light" value="${h.no_ba}" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold small mb-1">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control form-control-sm" value="${tanggal}" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold small mb-1">Jumlah Alat</label>
                                <input type="text" class="form-control form-control-sm bg-light" value="${alat.length}" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold small mb-1">Dikalibrasi Oleh</label>
                                <input type="text" name="request_by" class="form-control form-control-sm" value="${h.request_by}" placeholder="Nama kalibrator">
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white p-3 p-md-4 rounded shadow-sm mb-4">
                        <h6 class="fw-bold mb-3 text-warning"><i class="fas fa-building me-2"></i>Informasi Perusahaan</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small mb-1">Perusahaan</label>
                                <input type="text" name="perusahaan" class="form-control form-control-sm" value="${h.perusahaan || ''}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small mb-1">Alamat</label>
                                <input type="text" name="alamat" class="form-control form-control-sm" value="${h.alamat || ''}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold small mb-1">No Order</label>
                                <input type="text" name="no_order" class="form-control form-control-sm" value="${h.no_order || ''}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold small mb-1">Kontak</label>
                                <input type="text" name="kontak" class="form-control form-control-sm" value="${h.kontak || ''}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold small mb-1">Telp/Fax</label>
                                <input type="text" name="telp_fax" class="form-control form-control-sm" value="${h.telp_fax || ''}">
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white p-3 p-md-4 rounded shadow-sm mb-4">
                        <h6 class="fw-bold mb-3 text-warning"><i class="fas fa-user me-2"></i>Person</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small mb-1">Request By</label>
                                <input type="text" name="request_by" class="form-control form-control-sm" value="${h.request_by || ''}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small mb-1">Approve By</label>
                                <input type="text" name="approve_by" class="form-control form-control-sm" value="${h.approve_by || ''}">
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white p-3 p-md-4 rounded shadow-sm mb-4">
                        <h6 class="fw-bold mb-3 text-warning"><i class="fas fa-tools me-2"></i>Daftar Alat (${alat.length})</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-sm">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="text-center" style="width: 5%">No</th>
                                        <th style="width: 25%">Nama Alat</th>
                                        <th style="width: 15%">Merek</th>
                                        <th style="width: 15%">Type Alat</th>
                                        <th style="width: 15%">Rentang Ukur</th>
                                        <th style="width: 15%">No Seri</th>
                                        <th style="width: 15%">Keterangan</th>
                                        <th style="width: 5%"></th>
                                    </tr>
                                </thead>
                                <tbody>`;

            alat.forEach((item, i) => {
                html += `
                    <tr>
                        <td class="text-center align-middle row-number">${i+1}</td>
                        <td>
                            <input type="hidden" name="alat[${i}][id_ba]" value="${item.id || ''}">
                            <input type="text" name="alat[${i}][nama_alat]" class="form-control form-control-sm" value="${item.nama_alat || ''}" placeholder="Nama alat" required>
                        </td>
                        <td>
                            <input type="text" name="alat[${i}][merek]" class="form-control form-control-sm" value="${item.merek || ''}" placeholder="Merek">
                        </td>
                        <td>
                            <input type="text" name="alat[${i}][type_alat]" class="form-control form-control-sm" value="${item.type_alat || ''}" placeholder="Type Alat">
                        </td>
                        <td>
                            <input type="text" name="alat[${i}][kapasitas]" class="form-control form-control-sm" value="${item.kapasitas || ''}" placeholder="Rentang ukur">
                        </td>
                        <td>
                            <input type="text" name="alat[${i}][no_seri]" class="form-control form-control-sm" value="${item.no_seri || ''}" placeholder="No seri">
                        </td>
                        <td>
                            <input type="text" name="alat[${i}][keterangan]" class="form-control form-control-sm" value="${item.keterangan || ''}" placeholder="Keterangan">
                        </td>
                        <td class="text-center align-middle">
                            <button type="button" class="btn btn-sm btn-outline-danger border-0" onclick="hapusAlatRow(this)" title="Hapus baris">
                                <i class="fas fa-times"></i>
                            </button>
                        </td>
                    </tr>`;
            });

            html += `</tbody>
                            </table>
                            <div class="mt-2 text-end">
                                <button type="button" class="btn btn-sm btn-success shadow-sm" onclick="tambahAlatRow()">
                                    <i class="fas fa-plus"></i> Tambah Alat
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white p-3 p-md-4 rounded shadow-sm mb-4">
                        <label class="form-label fw-bold small mb-1">Catatan Tambahan</label>
                        <textarea name="catatan" class="form-control" rows="2">${h.catatan || ''}</textarea>
                    </div>
                </form>`;

            $('#editModalBody').html(html);

            $('#btnSaveEdit').off('click').on('click', function() {
                let formData = $('#editForm').serialize();
                
                Swal.fire({
                    title: 'Menyimpan...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                $.ajax({
                    url: '/berita-acara/update-by-no/' + noBa,
                    type: 'PUT',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(resp) {
                        if (resp.success) {
                            $('#editModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data berita acara berhasil diperbarui',
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: resp.message || 'Gagal menyimpan data'
                            });
                        }
                    },
                    error: function(xhr) {
                        let errorMsg = 'Terjadi kesalahan';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMsg = xhr.responseJSON.message;
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: errorMsg
                        });
                    }
                });
            });
        },
        error: function(xhr) {
            console.error('Error loading data:', xhr);
            $('#editModalBody').html('<div class="alert alert-danger text-center py-4">Gagal memuat data edit.</div>');
        }
    });
}

function tambahAlatRow() {
    let tbody = $('#editForm table tbody');
    let count = Date.now();
    let rowNum = tbody.find('tr').length + 1;
    let tr = `
        <tr>
            <td class="text-center align-middle row-number">${rowNum}</td>
            <td>
                <input type="hidden" name="alat[${count}][id_ba]" value="">
                <input type="text" name="alat[${count}][nama_alat]" class="form-control form-control-sm" value="" placeholder="Nama alat" required>
            </td>
            <td>
                <input type="text" name="alat[${count}][merek]" class="form-control form-control-sm" value="" placeholder="Merek">
            </td>
            <td>
                <input type="text" name="alat[${count}][kapasitas]" class="form-control form-control-sm" value="" placeholder="Rentang ukur">
            </td>
            <td>
                <input type="text" name="alat[${count}][no_seri]" class="form-control form-control-sm" value="" placeholder="No seri">
            </td>
            <td>
                <input type="text" name="alat[${count}][keterangan]" class="form-control form-control-sm" value="" placeholder="Keterangan">
            </td>
            <td class="text-center align-middle">
                <button type="button" class="btn btn-sm btn-outline-danger border-0" onclick="hapusAlatRow(this)" title="Hapus baris">
                    <i class="fas fa-times"></i>
                </button>
            </td>
        </tr>`;
    tbody.append(tr);
}

function hapusAlatRow(btn) {
    $(btn).closest('tr').remove();
    $('#editForm table tbody tr').each(function(index) {
        $(this).find('td.row-number').text(index + 1);
    });
}

@if(auth()->user()->role !== 'teknisi')
function confirmDelete(noBa) {
    $('#deleteNoBa').text(noBa);
    $('#deleteForm').attr('action', '/berita-acara/destroy-all/' + noBa);
    $('#deleteModal').modal('show');
}

$(document).on('submit', '#deleteForm', function(e) {
    Swal.fire({
        title: 'Menghapus...',
        text: 'Mohon tunggu sebentar',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    return true;
});
@endif

$(document).ready(function() {
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif
    
    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif
    
    @if(session('warning'))
        Swal.fire({
            icon: 'warning',
            title: 'Peringatan!',
            text: '{{ session('warning') }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif
    
    @if(session('info'))
        Swal.fire({
            icon: 'info',
            title: 'Informasi',
            text: '{{ session('info') }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif
});

function approveBeritaAcara(noBa) {
    $('#approveNoBa').text(noBa);
    $('#approveNote').val('');
    $('#approveModal').modal('show');

    $('#btnConfirmApprove').off('click').on('click', function() {
        let note = $('#approveNote').val();
        $.ajax({
            url: '/berita-acara/approve/' + noBa,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                note: note
            },
            success: function(resp) {
                if (resp.success) {
                    $('#approveModal').modal('hide');
                    location.reload();
                } else {
                    alert('Gagal approve: ' + resp.message);
                }
            },
            error: function() {
                alert('Terjadi kesalahan saat proses approval');
            }
        });
    });
}
</script>
@endpush