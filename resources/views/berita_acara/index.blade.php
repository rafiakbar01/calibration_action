@extends('layouts.app')

@section('title', 'Data Calibration Grouping')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg border-0" style="border-radius: 15px;">
               <div class="card-header bg-white py-3" style="border-radius: 15px 15px 0 0;">
    <div style="display: flex; align-items: center; justify-content: space-between;">
        <div style="display: flex; align-items: center; gap: 15px;">
            <div class="icon-box bg-soft-primary text-primary">
                <i class="fas fa-layer-group"></i>
            </div>
            <div>
                <h5 class="mb-0 text-dark font-weight-bold">Grouping Data Calibration</h5>
                <small class="text-muted">Buat Berita Acara berdasarkan grup Perusahaan & Tanggal</small>
            </div>
        </div>
        <div>
            <a href="{{ route('berita-acara.list') }}" 
               class="btn btn-primary btn-sm rounded-pill px-4 shadow-sm d-flex align-items-center">
                <i class="fas fa-list-ul mr-2"></i> 
                <span>Daftar Berita Acara</span>
            </a>
        </div>
    </div>
</div>
                
                <div class="card-body">
                    <div class="bg-light p-4 rounded-lg mb-4 border">
                        <form method="GET" action="{{ route('berita-acara.index') }}" id="filterForm">
                            <div class="row align-items-end">
                                <div class="col-md-3 mb-2">
                                    <label class="small font-weight-bold text-muted">TANGGAL MASUK</label>
                                    <div class="input-group input-group-sm">
                                        <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                                        <div class="input-group-append"><span class="input-group-text bg-white">s/d</span></div>
                                        <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                                    </div>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label class="small font-weight-bold text-muted">PERUSAHAAN</label>
                                    <select name="perusahaan" class="form-control form-control-sm select2">
                                        <option value="">Semua Perusahaan</option>
                                        @foreach($perusahaanList as $p)
                                            <option value="{{ $p }}" {{ request('perusahaan') == $p ? 'selected' : '' }}>{{ $p }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label class="small font-weight-bold text-muted">STATUS BA</label>
                                    <select name="status" class="form-control form-control-sm">
                                        <option value="">Semua</option>
                                        <option value="has_ba" {{ request('status') == 'has_ba' ? 'selected' : '' }}>Sudah Ada BA</option>
                                        <option value="no_ba" {{ request('status') == 'no_ba' ? 'selected' : '' }}>Belum Ada BA</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <button type="submit" class="btn btn-dark btn-sm px-4 shadow-sm">
                                        <i class="fas fa-filter mr-1"></i> Filter
                                    </button>
                                    <a href="{{ route('berita-acara.index') }}" class="btn btn-outline-secondary btn-sm px-3 ml-1">
                                        <i class="fas fa-undo mr-1"></i> Reset
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover border" id="calibrationTable">
                            <thead class="bg-soft-light text-uppercase">
                                <tr>
                                    <th class="text-center" width="5%">No</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Perusahaan</th>
                                    <th>No. PO</th>
                                    <th>Lokasi</th>
                                    <th class="text-center">Jumlah Alat</th>
                                    <th class="text-center">Status</th>
                                    <th>No. BA</th>
                                    <th class="text-center" width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($calibrations as $index => $group)
                                <tr>
                                    <td class="text-center align-middle font-weight-bold">{{ $loop->iteration + ($calibrations->currentPage() - 1) * $calibrations->perPage() }}</td>
                                    <td class="align-middle">
                                        <span class="font-weight-bold">{{ \Carbon\Carbon::parse($group['tanggalMasuk'])->format('d/m/Y') }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <span class="font-weight-bold">{{ $group['pemilikAlat'] ?? '-' }}</span>
                                    </td>
                                    <td class="align-middle">
                                        @if(!empty($group['no_po']))
                                            <span class="badge badge-secondary px-2 py-1"><i class="fas fa-file-invoice mr-1"></i>{{ $group['no_po'] }}</span>
                                        @else
                                            <span class="text-muted small">-</span>
                                        @endif
                                    </td>
                                    <td class="align-middle">{{ $group['lokasiPT'] ?? '-' }}</td>
                                    <td class="text-center align-middle">
                                        <span class="badge badge-info-soft px-3 py-2 rounded-pill">
                                            <i class="fas fa-cubes mr-1"></i> {{ $group['jumlah_alat'] }} Alat
                                        </span>
                                    </td>
                                    <td class="text-center align-middle">
                                        @if($group['has_ba'])
                                            @php
                                                $status = $group['ba_status'];
                                                $badgeClass = match($status) {
                                                    'approved' => 'badge-success-soft',
                                                    'waiting_approve' => 'badge-warning-soft',
                                                    'rejected' => 'badge-danger-soft',
                                                    'draft' => 'badge-secondary-soft',
                                                    default => 'badge-info-soft',
                                                };
                                                $icon = match($status) {
                                                    'approved' => 'fa-check-circle',
                                                    'waiting_approve' => 'fa-clock',
                                                    'rejected' => 'fa-times-circle',
                                                    'draft' => 'fa-pen',
                                                    default => 'fa-tag',
                                                };
                                                $label = match($status) {
                                                    'approved' => 'Approved',
                                                    'waiting_approve' => 'Menunggu',
                                                    'rejected' => 'Ditolak',
                                                    'draft' => 'Draft',
                                                    default => ucfirst(str_replace('_', ' ', $status)),
                                                };
                                            @endphp
                                            <span class="badge {{ $badgeClass }} rounded-pill px-3 py-2">
                                                <i class="fas {{ $icon }} mr-1"></i> {{ $label }}
                                            </span>
                                        @else
                                            <span class="badge badge-warning-soft rounded-pill px-3 py-2">
                                                <i class="fas fa-hourglass mr-1"></i> Belum Dibuat
                                            </span>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        @if($group['has_ba'])
                                            <code class="text-primary font-weight-bold">{{ $group['ba_no'] }}</code>
                                        @else
                                            <span class="text-muted small">-</span>
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-light border dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-cog mr-1"></i> Opsi
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right shadow border-0">
                                                <button class="dropdown-item btn-view-detail" 
                                                        data-toggle="modal" 
                                                        data-target="#detailGroupModal"
                                                        data-tanggal="{{ \Carbon\Carbon::parse($group['tanggalMasuk'])->format('d/m/Y') }}"
                                                        data-perusahaan="{{ $group['pemilikAlat'] }}"
                                                        data-lokasi="{{ $group['lokasiPT'] }}"
                                                        data-no-po="{{ $group['no_po'] ?? '' }}"
                                                        data-jumlah="{{ $group['jumlah_alat'] }}"
                                                        data-alat="{{ json_encode($group['alat_list']->map(function($item) {
                                                            return [
                                                                'no_label' => $item->no_label,
                                                                'namaAlat' => $item->namaAlat,
                                                                'brandAlat' => $item->brandAlat,
                                                                'typeAlat' => $item->typeAlat,
                                                                'NoSeri' => $item->NoSeri,
                                                            ];
                                                        })) }}">
                                                    <i class="fas fa-search-plus mr-2 text-info"></i> Lihat Detail Alat
                                                </button>
                                                
                                                @php
                                                    $canCreateBA = false;
                                                    if (auth()->check()) {
                                                        $userRole = auth()->user()->role;
                                                        if ($userRole === 'super admin') {
                                                            $canCreateBA = true;
                                                        } elseif ($userRole === 'teknisi') {
                                                            $currentTeknisiName = auth()->user()->nama ?? auth()->user()->name;
                                                            $groupTeknisiList = $group['alat_list']->pluck('calibratedBy')->filter()->unique()->toArray();
                                                            if (in_array($currentTeknisiName, $groupTeknisiList)) {
                                                                $canCreateBA = true;
                                                            }
                                                        }
                                                    }
                                                @endphp
                                                @if(!$group['has_ba'])
                                                    @if($canCreateBA)
                                                    <a class="dropdown-item" 
                                                       href="{{ route('berita-acara.create', [
                                                           'ids' => implode(',', $group['alat_list']->pluck('id')->toArray()),
                                                           'tanggal' => $group['tanggalMasuk'],
                                                           'perusahaan' => $group['pemilikAlat'],
                                                           'lokasi' => $group['lokasiPT'],
                                                           'no_po' => $group['no_po'] ?? ''
                                                       ]) }}">
                                                        <i class="fas fa-plus-circle mr-2 text-success"></i> Buat Berita Acara
                                                    </a>
                                                    @endif
                                                @else
                                                    <a class="dropdown-item" href="{{ route('berita-acara.show', $group['ba_no']) }}">
                                                        <i class="fas fa-eye mr-2 text-primary"></i> Lihat Berita Acara
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="fas fa-box-open fa-4x text-muted mb-3"></i>
                                            <h5 class="text-muted">Tidak ada data calibration</h5>
                                            <p class="text-muted small">Belum ada data calibration yang tersedia</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="text-muted small">
                            <i class="fas fa-database fa-fw mr-2"></i>
                            Menampilkan {{ $calibrations->firstItem() ?? 0 }} – {{ $calibrations->lastItem() ?? 0 }}
                            dari {{ $calibrations->total() }} grup
                        </div>
                        <div class="pagination-wrapper">
                            {{ $calibrations->appends(request()->query())->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Create BA -->
<!--<div class="modal fade" id="createBAModal" tabindex="-1" role="dialog" aria-hidden="true">-->
<!--    <div class="modal-dialog modal-dialog-centered">-->
<!--        <div class="modal-content shadow-lg border-0">-->
<!--            <div class="modal-header bg-success text-white">-->
<!--                <h5 class="modal-title font-weight-bold">-->
<!--                    <i class="fas fa-file-signature mr-2"></i> Konfirmasi Pembuatan BA-->
<!--                </h5>-->
<!--                <button type="button" class="close text-white" data-dismiss="modal">-->
<!--                    <span aria-hidden="true">&times;</span>-->
<!--                </button>-->
<!--            </div>-->
<!--            <div class="modal-body bg-light">-->
<!--                <div class="text-center mb-4">-->
<!--                    <i class="fas fa-file-alt fa-4x text-success mb-3"></i>-->
<!--                    <h6>Buat Berita Acara untuk grup:</h6>-->
<!--                </div>-->
                
<!--                <div class="bg-white p-3 rounded mb-3 border">-->
<!--                    <table class="table table-sm table-borderless mb-0">-->
<!--                        <tr>-->
<!--                            <td width="40%"><i class="fas fa-calendar-alt mr-2 text-muted"></i>Tanggal Masuk</td>-->
<!--                            <td width="5%">:</td>-->
<!--                            <td><strong class="text-success" id="modalTanggal"></strong></td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td><i class="fas fa-building mr-2 text-muted"></i>Perusahaan</td>-->
<!--                            <td>:</td>-->
<!--                            <td><strong class="text-success" id="modalPerusahaan"></strong></td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td><i class="fas fa-map-marker-alt mr-2 text-muted"></i>Lokasi</td>-->
<!--                            <td>:</td>-->
<!--                            <td><strong class="text-success" id="modalLokasi"></strong></td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td><i class="fas fa-cubes mr-2 text-muted"></i>Jumlah Alat</td>-->
<!--                            <td>:</td>-->
<!--                            <td><span class="badge badge-success-soft px-3 py-2" id="modalJumlah"></span></td>-->
<!--                        </tr>-->
<!--                    </table>-->
<!--                </div>-->

<!--                <div class="alert alert-warning border-0 shadow-sm mb-0">-->
<!--                    <i class="fas fa-info-circle mr-2"></i>-->
<!--                    Semua alat dalam grup ini akan dimasukkan ke dalam <strong>SATU Berita Acara</strong> dengan nomor yang sama.-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="modal-footer">-->
<!--                <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">-->
<!--                    <i class="fas fa-times mr-2"></i> Batal-->
<!--                </button>-->
<!--                <button type="button" class="btn btn-success px-4" id="confirmCreateBA">-->
<!--                    <i class="fas fa-check mr-2"></i> Ya, Buat BA-->
<!--                </button>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<!-- Modal Detail Alat -->
<div class="modal fade" id="detailGroupModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg border-0">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title font-weight-bold">
                    <i class="fas fa-toolbox mr-2"></i> Daftar Alat dalam Grup
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-light">
                <div class="row mb-3 bg-white p-3 rounded mx-1 shadow-sm border">
                    <div class="col-md-3">
                        <label class="small text-muted mb-0">PERUSAHAAN</label>
                        <p class="font-weight-bold mb-0" id="detailPerusahaan">-</p>
                    </div>
                    <div class="col-md-3">
                        <label class="small text-muted mb-0">NO PO</label>
                        <p class="font-weight-bold mb-0 text-primary" id="detailNoPO">-</p>
                    </div>
                    <div class="col-md-3">
                        <label class="small text-muted mb-0">TANGGAL MASUK</label>
                        <p class="font-weight-bold mb-0" id="detailTanggal">-</p>
                    </div>
                    <div class="col-md-3">
                        <label class="small text-muted mb-0">LOKASI</label>
                        <p class="font-weight-bold mb-0" id="detailLokasi">-</p>
                    </div>
                </div>
                
                <div class="table-responsive bg-white rounded shadow-sm border">
                    <table class="table table-sm table-striped mb-0">
                        <thead class="bg-soft-light">
                            <tr>
                                <th class="text-center py-2" width="5%">No</th>
                                <th class="py-2" width="15%">No Label</th>
                                <th class="py-2" width="25%">Nama Alat</th>
                                <th class="py-2" width="20%">Brand</th>
                                <th class="py-2" width="20%">Type</th>
                                <th class="py-2" width="15%">No Seri</th>
                            </tr>
                        </thead>
                        <tbody id="detailAlatList">
                            <!-- Akan diisi via JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">
                    <i class="fas fa-times mr-2"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css" rel="stylesheet" />

<style>
    /* Soft UI Styling */
    .bg-soft-primary { background-color: #e8ebf8 !important; }
    .bg-soft-light { background-color: #f8f9fe !important; }
    
    .badge-info-soft { background-color: #e1f5fe; color: #0288d1; }
    .badge-success-soft { background-color: #e7f6ea; color: #28a745; }
    .badge-warning-soft { background-color: #fff8e1; color: #f57c00; }
    .badge-danger-soft { background-color: #fee; color: #dc3545; }
    .badge-secondary-soft { background-color: #f0f0f0; color: #6c757d; }
    
    .icon-box {
        width: 45px; height: 45px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 12px; font-size: 1.2rem;
    }

    .table thead th {
        background-color: #e8f0fe !important; /* Biru muda premium yang bersih, terang, dan mewah */
        background-image: none !important;
        color: #1e3a8a !important; /* Teks biru tua yang sangat kontras, tegas, dan elegan */
        font-weight: 800 !important;
        font-size: 0.8rem !important;
        text-transform: uppercase !important;
        letter-spacing: 0.8px !important;
        border: none !important; /* Hilangkan seluruh garis hitam dan garis pembatas vertikal antar kolom */
        border-bottom: 2px solid #93c5fd !important; /* Garis bawah biru muda lembut sebagai pemisah yang manis */
        padding: 12px 14px !important;
        vertical-align: middle;
        white-space: nowrap;
        text-shadow: none !important;
    }

    /* Override untuk DataTables & Bootstrap agar tidak ada sisa garis hitam pembatas di header */
    table.dataTable thead th, 
    table.dataTable thead td,
    #calibrationTable thead th {
        border: none !important;
        border-bottom: 2px solid #93c5fd !important; /* Garis pembatas biru muda lembut */
    }

    .table-responsive { overflow: visible !important; }

    .select2-container--bootstrap4 .select2-selection--single { height: 31px !important; }
    
    .dropdown-menu {
        z-index: 1050 !important;
    }
    
    .pagination-wrapper .pagination {
        margin-bottom: 0;
    }
    
    .pagination-wrapper .page-item.active .page-link {
        background: linear-gradient(135deg, #667eea, #764ba2);
        border: none;
    }
    
    .pagination-wrapper .page-link {
        border-radius: 20px !important;
        margin: 0 2px;
        color: #667eea;
    }
    
    .empty-state {
        padding: 3rem;
        text-align: center;
        opacity: 0.7;
    }
    
    .badge {
        font-weight: 500;
        font-size: 0.8rem;
        letter-spacing: 0.3px;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    // Inisialisasi DataTable
    var table = $('#calibrationTable').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": false,
        "autoWidth": false,
        "responsive": true,
        "language": {
            "search": "Cari Cepat:",
            "zeroRecords": "Data tidak ditemukan",
            "paginate": {
                "previous": "<i class='fas fa-angle-left'></i>",
                "next": "<i class='fas fa-angle-right'></i>"
            }
        }
    });

    // Inisialisasi Select2
    $('.select2').select2({
        theme: 'bootstrap4',
        width: '100%'
    });

    // Handle Detail Button
    $('.btn-view-detail').on('click', function() {
        var alat = $(this).data('alat');
        var perusahaan = $(this).data('perusahaan');
        var tanggal = $(this).data('tanggal');
        var lokasi = $(this).data('lokasi');
        var noPo = $(this).data('no-po');
        
        $('#detailPerusahaan').text(perusahaan || '-');
        $('#detailNoPO').text(noPo || '-');
        $('#detailTanggal').text(tanggal || '-');
        $('#detailLokasi').text(lokasi || '-');

        var rows = '';
        $.each(alat, function(i, item) {
            rows += `<tr>
                <td class="text-center align-middle small">${i+1}</td>
                <td class="align-middle font-weight-bold">${item.no_label || '-'}</td>
                <td class="align-middle">${item.namaAlat || '-'}</td>
                <td class="align-middle">${item.brandAlat || '-'}</td>
                <td class="align-middle">${item.typeAlat || '-'}</td>
                <td class="align-middle">${item.NoSeri || '-'}</td>
            </tr>`;
        });
        $('#detailAlatList').html(rows);
    });

    // Handle Create BA Button
    $('.btn-create-ba').on('click', function() {
        var tanggal = $(this).data('tanggal');
        var perusahaan = $(this).data('perusahaan');
        var lokasi = $(this).data('lokasi');
        var ids = $(this).data('ids');
        var jumlah = ids.length;

        // Format tanggal untuk display
        var tanggalObj = new Date(tanggal);
        var tanggalFormatted = tanggalObj.toLocaleDateString('id-ID', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric'
        });

        $('#modalTanggal').text(tanggalFormatted);
        $('#modalPerusahaan').text(perusahaan || '-');
        $('#modalLokasi').text(lokasi || '-');
        $('#modalJumlah').text(jumlah + ' Alat');
        
        // Simpan data untuk digunakan saat konfirmasi
        $('#confirmCreateBA').data('tanggal', tanggal);
        $('#confirmCreateBA').data('perusahaan', perusahaan);
        $('#confirmCreateBA').data('ids', ids);
    });

    // Handle konfirmasi pembuatan BA
    $('#confirmCreateBA').on('click', function() {
        var tanggal = $(this).data('tanggal');
        var perusahaan = $(this).data('perusahaan');
        var ids = $(this).data('ids');

        // Tampilkan loading
        $(this).html('<i class="fas fa-spinner fa-spin mr-2"></i> Memproses...').prop('disabled', true);

        $.ajax({
            url: '{{ route("berita-acara.create-from-group") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                tanggalMasuk: tanggal,
                pemilikAlat: perusahaan,
                calibration_ids: ids
            },
            success: function(response) {
                if (response.success) {
                    $('#createBAModal').modal('hide');
                    
                    // Tampilkan notifikasi sukses
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                    
                    // Redirect ke halaman detail
                    if (response.redirect) {
                        setTimeout(function() {
                            window.location.href = response.redirect;
                        }, 1500);
                    } else {
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.message
                    });
                }
            },
            error: function(xhr) {
                var errorMsg = 'Terjadi kesalahan';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                    errorMsg = Object.values(xhr.responseJSON.errors).join('\n');
                }
                
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: errorMsg
                });
            },
            complete: function() {
                $('#confirmCreateBA').html('<i class="fas fa-check mr-2"></i> Ya, Buat BA').prop('disabled', false);
            }
        });
    });
});
</script>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush