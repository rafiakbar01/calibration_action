@extends('layouts.app')

@section('title', 'Log Aktivitas Sistem')

@push('styles')
<meta http-equiv="refresh" content="60">
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h3 class="card-title">
                    <i class="fas fa-history mr-2"></i>Riwayat Aktivitas Pengguna
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="activityLogTable" class="table table-bordered table-hover table-striped w-100">
                        <thead class="bg-light">
                            <tr>
                                <th width="180">Waktu (WIB)</th>
                                <th width="150">User</th>
                                <th width="120">Tipe</th>
                                <th>Deskripsi</th>
                                <th width="150">Model</th>
                                <th width="120">IP Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs as $log)
                                <tr>
                                    <td class="text-muted font-weight-bold">
                                        {{ $log->formatted_time }}
                                    </td>
                                    <td>
                                        @if($log->performer)
                                            <span class="badge badge-light p-2 border">
                                                <i class="fas fa-user mr-1 text-primary"></i>
                                                {{ $log->performer->nama }}
                                            </span>
                                        @else
                                            <span class="text-muted">System/Guest</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge {{ $log->activity_badge }} px-2 py-1">
                                            <i class="fas {{ $log->activity_icon }} mr-1"></i>
                                            {{ strtoupper($log->activity_type) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="text-dark">
                                            {{ $log->description }}
                                            @if($log->performer)
                                                <strong>oleh {{ $log->performer->nama }}</strong>
                                            @endif
                                        </div>
                                        @if($log->url)
                                            <small class="text-muted d-block mt-1">
                                                <i class="fas fa-link mr-1"></i> {{ Str::limit($log->url, 50) }}
                                            </small>
                                        @endif
                                    </td>
                                    <td>
                                        @if($log->logable_type)
                                            <span class="text-secondary">
                                                <i class="fas fa-cube mr-1"></i>
                                                {{ $log->model_name }} #{{ $log->logable_id }}
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <code class="text-muted small">{{ $log->ip_address }}</code>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fas fa-info-circle fa-2x mb-3 d-block"></i>
                                            Belum ada log aktivitas yang tercatat.
                                        </div>
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

@endsection

@push('scripts')
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#activityLogTable').DataTable({
            "responsive": true,
            "autoWidth": false,
            "order": [[0, "desc"]], // Sort by time column descending
            "language": {
                "search": "Cari Log:",
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "zeroRecords": "Tidak ada data yang ditemukan",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                "infoEmpty": "Tidak ada data yang tersedia",
                "infoFiltered": "(difilter dari _MAX_ total data)",
                "paginate": {
                    "first": "Awal",
                    "last": "Akhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                }
            }
        });
    });
</script>

<style>
    .table td { vertical-align: middle !important; }
    .badge { font-weight: 500; letter-spacing: 0.5px; }
    /* Pastikan meta refresh tidak mengganggu interaksi datatable (opsional, bisa dimatikan jika dirasa mengganggu saat ngetik search) */
</style>
@endpush
