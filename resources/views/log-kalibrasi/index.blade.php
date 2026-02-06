{{-- resources/views/log-kalibrasi/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Log Kalibrasi')

@section('content')
<div class="container-fluid">
    <!-- Auto Refresh Controls -->
    <div class="row mb-2">
        <div class="col-12">
            <div class="card bg-light border">
                <div class="card-body py-2 px-3 d-flex flex-wrap align-items-center justify-content-between gap-2">
                    <div class="d-flex align-items-center flex-wrap gap-3">
                        <span class="small text-nowrap">Auto Refresh:</span>
                        <div class="btn-group btn-group-sm" role="group" aria-label="Interval refresh">
                            <input type="radio" class="btn-check" name="refreshInterval" id="refreshOff" autocomplete="off" checked>
                            <label class="btn btn-outline-secondary" for="refreshOff">Off</label>

                            <input type="radio" class="btn-check" name="refreshInterval" id="refresh5s" autocomplete="off" data-interval="5000">
                            <label class="btn btn-outline-secondary" for="refresh5s">5 detik</label>

                            <input type="radio" class="btn-check" name="refreshInterval" id="refresh10s" autocomplete="off" data-interval="10000">
                            <label class="btn btn-outline-secondary" for="refresh10s">10 detik</label>

                            <input type="radio" class="btn-check" name="refreshInterval" id="refresh30s" autocomplete="off" data-interval="30000">
                            <label class="btn btn-outline-secondary" for="refresh30s">30 detik</label>
                        </div>
                    </div>

                    <div class="d-flex align-items-center flex-wrap gap-2">
                        <span id="refreshStatus" class="badge bg-secondary">
                            <i class="fas fa-pause-circle me-1"></i> Off
                        </span>
                        <span class="small text-muted text-nowrap">
                            Terakhir: <span id="lastUpdateTime">{{ now()->format('H:i:s') }}</span>
                        </span>
                        <button id="manualRefresh" class="btn btn-sm btn-outline-primary" title="Refresh sekarang">
                            <i class="fas fa-sync-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Judul & Total Data -->
    <div class="row mb-3">
        <div class="col-12">
            <h5 class="mb-0">
                <i class="fas fa-history me-2"></i>Log Kalibrasi
                <small class="text-muted ms-2" id="totalData">({{ $logs->total() }} data)</small>
            </h5>
        </div>
    </div>

    <!-- Filter Form -->
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-3">
                    <form method="GET" id="filterForm" class="row g-2 align-items-end">
                        <div class="col-md-3 col-sm-6">
                            <select name="aksi" class="form-select form-select-sm">
                                <option value="">Semua Aksi</option>
                                @foreach($aksiList as $aksi)
                                    <option value="{{ $aksi }}" {{ request('aksi') == $aksi ? 'selected' : '' }}>
                                        {{ $aksi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <select name="user_id" class="form-select form-select-sm">
                                <option value="">Semua User</option>
                                @foreach($userList as $user)
                                    <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2 col-sm-6">
                            <input type="date" name="tanggal_dari" class="form-control form-control-sm" 
                                   value="{{ request('tanggal_dari') }}" placeholder="Dari">
                        </div>

                        <div class="col-md-2 col-sm-6">
                            <input type="date" name="tanggal_sampai" class="form-control form-control-sm" 
                                   value="{{ request('tanggal_sampai') }}" placeholder="Sampai">
                        </div>

                        <div class="col-md-2 col-sm-12">
                            <div class="d-flex gap-1">
                                <button type="submit" class="btn btn-primary btn-sm flex-fill">
                                    <i class="fas fa-filter me-1"></i>Filter
                                </button>
                                <a href="{{ route('log-kalibrasi.export', request()->query()) }}" 
                                   class="btn btn-success btn-sm" title="Export" target="_blank">
                                    <i class="fas fa-file-export"></i>
                                </a>
                                <a href="{{ route('log-kalibrasi.index') }}" 
                                   class="btn btn-secondary btn-sm" title="Reset">
                                    <i class="fas fa-redo"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="140">Waktu</th>
                                    <th width="80">Aksi</th>
                                    <th>Deskripsi</th>
                                    <th width="100">Kalibrasi ID</th>
                                    <th width="150">User</th>
                                    <th width="120">IP Address</th>
                                    <th width="80">Detail</th>
                                </tr>
                            </thead>
                            <tbody id="logsTableBody">
                                @forelse($logs as $log)
                                    <tr>
                                        <td class="small text-nowrap">
                                            {{ $log->created_at->format('d/m/Y H:i:s') }}
                                        </td>
                                        <td>
                                            @php
                                                $badgeColor = match($log->aksi) {
                                                    'BUAT' => 'success',
                                                    'UBAH' => 'warning',
                                                    'HAPUS' => 'danger',
                                                    default => 'info'
                                                };
                                            @endphp
                                            <span class="badge bg-{{ $badgeColor }}">
                                                {{ $log->aksi }}
                                            </span>
                                        </td>
                                        <td class="small">{{ $log->deskripsi }}</td>
                                        <td class="text-nowrap">
                                            <a href="{{ route('log-kalibrasi.per-kalibrasi', $log->kalibrasi_id) }}" 
                                               class="text-decoration-none">
                                                #{{ $log->kalibrasi_id }}
                                            </a>
                                        </td>
                                        <td class="small text-nowrap">
                                            {{ $log->user->nama ?? 'System' }}
                                        </td>
                                        <td class="small">{{ $log->alamat_ip ?? '-' }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('log-kalibrasi.show', $log->id) }}" 
                                               class="btn btn-info btn-sm" title="Detail Log">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            <i class="fas fa-inbox fa-2x mb-3 opacity-50"></i><br>
                                            Tidak ada data log kalibrasi.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="paginationContainer" class="card-footer py-3 bg-light">
                    {!! $logs->appends(request()->query())->links('pagination::bootstrap-5') !!}
                    <div class="small text-muted mt-2">
                        Menampilkan {{ $logs->firstItem() ?? 0 }} - {{ $logs->lastItem() ?? 0 }} dari {{ $logs->total() }} data
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .highlight-new {
        background-color: rgba(40, 167, 69, 0.15) !important;
        transition: background-color 2s ease-out;
    }
    .btn-check:checked + .btn {
        background-color: #0d6efd !important;
        color: white !important;
    }
    .table tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    let refreshTimer = null;

    const filterForm = document.getElementById('filterForm');
    const logsTableBody = document.getElementById('logsTableBody');
    const paginationContainer = document.getElementById('paginationContainer');
    const totalDataElement = document.getElementById('totalData');
    const refreshStatus = document.getElementById('refreshStatus');
    const lastUpdateTime = document.getElementById('lastUpdateTime');
    const manualRefreshBtn = document.getElementById('manualRefresh');

    function updateRefreshStatus(interval) {
        if (!interval) {
            refreshStatus.innerHTML = '<i class="fas fa-pause-circle me-1"></i> Off';
            refreshStatus.className = 'badge bg-secondary';
        } else {
            const seconds = interval / 1000;
            refreshStatus.innerHTML = `<i class="fas fa-sync-alt fa-spin me-1"></i> ${seconds}s`;
            refreshStatus.className = 'badge bg-success';
        }
    }

    function loadData() {
        const params = new URLSearchParams(new FormData(filterForm));
        const url = `{{ route('log-kalibrasi.ajax') }}?${params.toString()}`;

        // Loading state
        logsTableBody.innerHTML = `
            <tr>
                <td colspan="7" class="text-center py-5">
                    <div class="spinner-border spinner-border-sm text-primary"></div>
                    <span class="ms-2">Memuat data...</span>
                </td>
            </tr>`;

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) throw new Error('Network error');
            return response.json();
        })
        .then(data => {
            if (data.success) {
                logsTableBody.innerHTML = data.table_html;
                paginationContainer.innerHTML = data.pagination_html;
                totalDataElement.textContent = `(${data.total} data)`;
                lastUpdateTime.textContent = data.timestamp;

                // Highlight baris baru
                logsTableBody.querySelectorAll('tr').forEach(row => {
                    row.classList.add('highlight-new');
                    setTimeout(() => row.classList.remove('highlight-new'), 2000);
                });
            }
        })
        .catch(err => {
            console.error('Error:', err);
            logsTableBody.innerHTML = `
                <tr>
                    <td colspan="7" class="text-center text-danger py-4">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Gagal memuat data. Silakan coba lagi.
                    </td>
                </tr>`;
            lastUpdateTime.textContent = new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
        });
    }

    function setupAutoRefresh(interval) {
        if (refreshTimer) clearInterval(refreshTimer);
        updateRefreshStatus(interval);
        if (interval) {
            refreshTimer = setInterval(loadData, interval);
        }
    }

    // Radio buttons auto refresh
    document.querySelectorAll('input[name="refreshInterval"]').forEach(radio => {
        radio.addEventListener('change', function () {
            if (this.checked) {
                const interval = this.dataset.interval ? parseInt(this.dataset.interval) : null;
                setupAutoRefresh(interval);
                localStorage.setItem('calibrationLogRefresh', interval || 'off');
            }
        });
    });

    // Manual refresh
    manualRefreshBtn.addEventListener('click', () => {
        manualRefreshBtn.disabled = true;
        manualRefreshBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        loadData();
        setTimeout(() => {
            manualRefreshBtn.disabled = false;
            manualRefreshBtn.innerHTML = '<i class="fas fa-sync-alt"></i>';
        }, 800);
    });

    // Muat preferensi dari localStorage
    const saved = localStorage.getItem('calibrationLogRefresh');
    if (saved && saved !== 'off') {
        const radio = document.querySelector(`input[data-interval="${saved}"]`);
        if (radio) {
            radio.checked = true;
            setupAutoRefresh(parseInt(saved));
        }
    } else if (saved === 'off') {
        document.getElementById('refreshOff').checked = true;
    }

    // Update waktu awal
    lastUpdateTime.textContent = new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
});
</script>
@endpush