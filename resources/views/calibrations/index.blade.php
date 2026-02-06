@extends('layouts.app')

@section('title', 'Daftar Kalibrasi')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"></h1>
    
    @if(auth()->user()->role === 'super admin' || auth()->user()->role === 'teknisi')
    <a href="{{ route('calibrations.create') }}" 
       class="btn btn-primary rounded-pill shadow-lg px-5 py-3 d-inline-flex align-items-center gap-3 fw-medium text-decoration-none transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
        <i class="fas fa-plus fa-lg"></i>
        <span class="fw-bold fs-6">Tambah Kalibrasi Baru</span>
    </a>
    @endif
</div>

<!-- Alert Messages -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- TABEL DATA KALIBRASI -->
<div class="card shadow mb-4 border-0 rounded-3">
    <div class="card-header py-3 bg-gradient-primary d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-white">Daftar Kalibrasi</h6>
        
       
    </div>

    <div class="card-body pb-0">
        <!-- Kontrol Atas: Tampilkan + Search Bawaan DataTables -->
        <div class="row mb-3 align-items-center">
            <!-- Kiri: Tampilkan per page -->
            <div class="col-12 col-sm-6 col-md-6 mb-3 mb-sm-0">
                <form method="GET" action="{{ route('calibrations.index') }}" class="d-flex align-items-center">
                    <label for="perPage" class="form-label me-2 mb-0 small fw-medium">Tampilkan:</label>
                    <select name="perPage" id="perPage" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                        <option value="5"   {{ request('perPage', 10) == 5   ? 'selected' : '' }}>5</option>
                        <option value="10"  {{ request('perPage', 10) == 10  ? 'selected' : '' }}>10</option>
                        <option value="25"  {{ request('perPage', 10) == 25  ? 'selected' : '' }}>25</option>
                        <option value="50"  {{ request('perPage', 10) == 50  ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('perPage', 10) == 100 ? 'selected' : '' }}>100</option>
                    </select>
                </form>
            </div>

            <!-- Kanan: Wrapper untuk search box bawaan DataTables -->
            <div class="col-12 col-sm-6 col-md-6">
                <div id="dtSearchWrapper" class="d-flex justify-content-end"></div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle" id="calibrationTable" width="100%">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center" width="5%">No</th>
                        <th>Certificate ID</th>
                        <th>Nama Alat</th>
                        <th>Jenis</th>
                        <th>Merek</th>
                        <th>Pemilik</th>
                        <th>Tanggal Masuk</th>
                        <th>Status</th>
                        <th class="text-center no-sort" width="140">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($calibrations as $calibration)
                    <tr>
                        <td class="text-center fw-bold text-muted">
                            {{ $loop->iteration + (($calibrations->currentPage() - 1) * $calibrations->perPage()) }}
                        </td>

                        <!-- Certificate ID -->
                        <td>
                            @php
                                $certificateId = '';
                                $headModels = [
                                    'headInsideMicrometer','headOutsideMicrometer','headDepthMicrometer','headThermometer',
                                    'headDialIndicator','headDialTestIndicator','headDepthCaliper','headCaliper',
                                    'headTorqueWrench','headTorqueMeter','headUltrasonicThicknessGauge','headThicknessGauge','headPenggaris',
                                    'headEnclosure','headChamber','headPressureGauge','headDifferentialPressureGauge',
                                    'headVolumetrik','headThermoHygrometer','headViscometer','headPushPull','headAnakTimbangan','headTimbangan',
                                    'headTimbanganMoisture','headTimbanganBias','headGaugeBlock','headHoletest',
                                    'headConductivityMeter','headCoatingThickness','headDurometer',
                                    'headMikropipetDispenset','headTaperGauge','headFeelerGauge','headPhMeter',
                                    'headTachometer','headPinGauge','headViscoCup','headPlainLimitGauge','headTempHumidTransmitter',
                                    'headTempTransmitter','headIrThermometer','headThermoIndicator','headPlasticShim','headProfilProjector',
                                    'headSurfaceRoughnessTester','headThreadGauge','headStopwatch','headCentrifuge','headUtm','headPressureTransmitter','headSurfacePlate'
                                ];
                                foreach ($headModels as $model) {
                                    if ($calibration->$model && $calibration->$model->certificate_id) {
                                        $certificateId = $calibration->$model->certificate_id;
                                        break;
                                    }
                                }
                            @endphp
                            @if($certificateId)
                                <span class="badge bg-white text-primary border border-primary fw-bold px-3 py-2 rounded-pill">
                                    {{ $certificateId }}
                                </span>
                            @else
                                <span class="text-muted fst-italic">—</span>
                            @endif
                        </td>

                        <td class="fw-medium">{{ $calibration->namaAlat ?? '-' }}</td>

                        <!-- Jenis Alat -->
                        <td>
                            @php
                                $jenis = 'General';
                                $namaLower = strtolower($calibration->namaAlat ?? '');

                                if (str_contains($namaLower, 'timbangan')) {
                                    if (str_contains($namaLower, 'moisture')) $jenis = 'Timbangan Moisture';
                                    elseif (str_contains($namaLower, 'anak')) $jenis = 'Anak Timbangan';
                                    elseif (str_contains($namaLower, 'bias')) $jenis = 'Timbangan Bias';
                                    else $jenis = 'Timbangan';
                                } else {
                                    $jenis = collect([
                                        'Inside Micrometer','Outside Micrometer','Depth Micrometer','Thermometer Infrared','Thermometer',
                                        'Dial Indicator','Dial Test Indicator','Depth Caliper','Caliper',
                                        'Torque Wrench','Torque Meter', 'Ultrasonic Thickness Gauge','Thickness Gauge','Penggaris',
                                        'Oven','Freezer','Furnace','Incubator','WaterBath','AutoClave','Climatic Chamber',
                                        'Pressure Gauge','Differential Pressure Gauge','Buret','Gelas Ukur','Pipet Ukur',
                                        'Labu Ukur','Pipet Volume','Thermohygrometer','Viscometer','Push Pull','Tension Gauge',
                                        'Gauge Block','Holetest','Conductivity Meter','Coating Thickness','Durometer',
                                        'Mikropipet','Dispenset','Taper Gauge','Feeler Gauge','PH Meter','Tachometer','Pin Gauge',
                                        'Visco Cup','Plain Limit Gauge','Temperature','Humidity Transmitter','Temperature Transmitter',
                                        'ThermoIndicator','Plastic Shim','Profil Projector','Microscope','Surface Roughness Tester',
                                        'Thread Gauge','Stopwatch','Stopwatch Digital','Centrifuge','Mesin Uji Tarik','Mesin Uji Tekan','Diff Pressure Transmitter','Pressure Transmitter',
                                        'Meja Rata'
                                        
                                      
                                        
                                    ])->first(fn($k) => str_contains($namaLower, strtolower($k))) ?? 'General';
                                }
                            @endphp
                            <span class="badge bg-light text-primary border rounded-pill px-3 py-1">
                                {{ $jenis }}
                            </span>
                        </td>

                        <td class="text-muted">{{ $calibration->brandAlat ?? '-' }}</td>
                        <td class="text-muted">{{ $calibration->pemilikAlat ?? '-' }}</td>
                        <td class="small text-muted">
                            <i class="far fa-calendar-alt me-1"></i>
                            {{ $calibration->tanggalMasuk ? \Carbon\Carbon::parse($calibration->tanggalMasuk)->format('d M Y') : '-' }}
                        </td>

                        <!-- Status -->
                        <td>
                            @php
                                $status = match($calibration->status) {
                                    'draft'                 => ['Menunggu Input', 'bg-secondary text-white'],
                                    'waiting_verification'  => ['Menunggu Verif', 'bg-warning text-dark'],
                                    'waiting_approval'      => ['Menunggu Approval', 'bg-info text-white'],
                                    'verified'              => ['Terverifikasi', 'bg-primary text-white'],
                                    'approved'              => ['Disetujui', 'bg-success text-white'],
                                    'rejected'              => ['Ditolak', 'bg-danger text-white'],
                                    'completed'             => ['Selesai', 'bg-teal text-white'],
                                    default                 => ['Unknown', 'bg-dark text-white']
                                };
                            @endphp
                            <span class="badge {{ $status[1] }} rounded-pill px-3 py-2 fw-bold">
                                {{ $status[0] }}
                            </span>
                        </td>

                        <!-- Aksi -->
                        <td class="text-center">
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('calibrations.show', $calibration->id) }}?mode=view" class="btn btn-primary" title="Lihat">
                                    <i class="fas fa-eye"></i>
                                </a>

                                @php
                                    $canEdit = false;
                                    $role = auth()->user()->role;
                                    if ($role === 'super admin') {
                                        $canEdit = $calibration->status !== 'completed';
                                    } elseif ($role === 'checker') {
                                        $canEdit = in_array($calibration->status, ['waiting_verification', 'rejected']);
                                    } elseif ($role === 'approver') {
                                        $canEdit = $calibration->status === 'verified';
                                    }
                                @endphp

                                @if($canEdit)
                                    <a href="{{ route('calibrations.show', $calibration->id) }}?mode=edit" class="btn btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @else
                                    <button class="btn btn-secondary opacity-50" disabled title="Tidak dapat diedit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                @endif

                                @php
                                    $canDownloadExcel = ($role === 'super admin' || ($role === 'checker' && in_array($calibration->status, ['waiting_verification', 'rejected'])));
                                    $isSupported = $calibration->headInsideMicrometer || $calibration->headOutsideMicrometer ||
                                                   $calibration->headDepthMicrometer || $calibration->headThermometer;
                                @endphp

                                @if($canDownloadExcel && empty($calibration->location_data) && 
                                    in_array($calibration->status, ['draft', 'waiting_verification', 'rejected']) && $isSupported)
                                    <a href="{{ route('calibrations.download.excel.template', $calibration->id) }}"
                                       class="btn btn-success download-excel-btn" title="Download Template Excel">
                                        <i class="fas fa-file-excel"></i>
                                    </a>
                                @endif

                                @if(($role === 'super admin' || ($role === 'approver' && $calibration->status === 'verified')) &&
                                    $calibration->status === 'verified' && $calibration->location_data)
                                    <a href="{{ route('calibrations.download.verified', $calibration->id) }}"
                                       class="btn btn-warning approval-download-btn" title="Download File Terverifikasi">
                                        <i class="fas fa-check-double"></i>
                                    </a>
                                @endif

                                @if(($role === 'super admin' || ($role === 'checker' && $calibration->status === 'rejected')) &&
                                    $calibration->status === 'rejected' && $calibration->location_data)
                                    <a href="{{ route('calibrations.download.rejected', $calibration->id) }}"
                                       class="btn btn-danger rejected-download-btn" title="Download File Ditolak">
                                        <i class="fas fa-times-circle"></i>
                                    </a>
                                @endif

                                @php
                                    $canDelete = ($role === 'super admin' && in_array($calibration->status, ['draft', 'waiting_verification']));
                                @endphp

                                @if($canDelete)
                                    <form action="{{ route('calibrations.destroy', $calibration->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger" 
                                                onclick="return confirm('Yakin ingin menghapus data ini?')" title="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                @else
                                    <button class="btn btn-secondary opacity-50" disabled title="Tidak dapat dihapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-5 text-muted">
                            <i class="fas fa-inbox fa-4x mb-3 opacity-50"></i>
                            <h5>Belum ada data kalibrasi</h5>
                            @if(auth()->user()->role === 'super admin' || auth()->user()->role === 'teknisi')
                            <a href="{{ route('calibrations.create') }}" class="btn btn-primary mt-3">
                                <i class="fas fa-plus me-2"></i>Tambah Data Pertama
                            </a>
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($calibrations->hasPages())
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4 px-2">
            <div class="text-muted small mb-3 mb-sm-0">
                Menampilkan {{ $calibrations->firstItem() }} – {{ $calibrations->lastItem() }} dari {{ $calibrations->total() }} entri
            </div>
            <nav>
                <ul class="pagination pagination-sm mb-0">
                    {!! $calibrations->onEachSide(1)->appends(request()->query())->links('pagination::bootstrap-5') !!}
                </ul>
            </nav>
        </div>
        @endif
    </div>
</div>

<!-- Modal Loading -->
<div class="modal fade" id="loadingModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-file-download me-2"></i> Sedang Menyiapkan File Excel
                </h5>
            </div>
            <div class="modal-body text-center py-5">
                <div class="spinner-border text-primary mb-4" role="status" style="width: 4rem; height: 4rem;">
                    <span class="visually-hidden"></span>
                </div>
                <p class="fw-bold fs-5">File sedang diproses, mohon tunggu sebentar...</p>
            </div>
        </div>
    </div>
</div>

<!-- Modal Instruksi Sukses – Ukuran Sedang (modal-md), Teks Jelas, Tidak Terlalu Besar -->
<div class="modal fade" id="instructionModal" tabindex="-1" aria-labelledby="instructionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content shadow-lg border-0 rounded-4">
            <!-- Header -->
            <div class="modal-header bg-success text-white py-3">
                <h5 class="modal-title fw-bold" id="instructionModalLabel">
                    <i class="fas fa-check-circle me-2"></i> Download Berhasil!
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body -->
            <div class="modal-body py-4 px-4 bg-light">
                <!-- Pesan Sukses -->
                <div class="text-center mb-4">
                    <i class="fas fa-file-excel fa-4x text-success mb-3"></i>
                    <h5 class="fw-bold text-dark">File Excel telah berhasil di-download</h5>
                    <p class="text-muted small">Silakan buka file yang baru saja Anda unduh.</p>
                </div>

                <!-- Kotak Peringatan -->
                <div class="border border-warning border-2 rounded-4 p-4 bg-white shadow-sm">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-exclamation-triangle text-warning fs-4 me-3"></i>
                        <h6 class="fw-bold text-dark mb-0">Informasi Penting Saat Membuka File</h6>
                    </div>

                    <p class="text-dark small mb-3">
                        Saat membuka file, Excel mungkin menampilkan pesan:
                    </p>

                    <div class="bg-light border rounded p-3 mb-4 text-center">
                        <p class="mb-0 text-secondary fst-italic small">
                            “We found a problem with some content... Do you want us to try to recover?”
                        </p>
                    </div>

                    <!-- KLIK YES – Masih Menonjol Tapi Tidak Berlebihan -->
                    <div class="text-center py-3 bg-success bg-opacity-10 rounded mb-4">
                        <p class="fw-bold text-secondary mb-1">Click</p>
                        <h3 class="fw-bold text-secondary text-uppercase mb-0">YES</h3>
                    </div>

                    <!-- Daftar Manfaat – Rapi & Ringkas -->
                    <ul class="list-unstyled mb-0">
                        <li class="d-flex mb-2">
                            <i class="fas fa-check text-success me-3 mt-1"></i>
                            <span><strong>Data kalibrasi sudah terisi otomatis</strong></span>
                        </li>
                        <li class="d-flex mb-2">
                            <i class="fas fa-check text-success me-3 mt-1"></i>
                            <span><strong>Peringatan hanya muncul sekali</strong></span>
                        </li>
                        <li class="d-flex mb-2">
                            <i class="fas fa-shield-alt text-primary me-3 mt-1"></i>
                            <span><strong>File aman dari sistem resmi perusahaan</strong></span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Footer – Tombol Tutup -->
            <div class="modal-footer bg-white border-top-0 justify-content-center py-3">
            <button type="button" 
                    class="btn btn-success px-5 shadow-sm" 
                    onclick="hideInstructionModal()">
                <i class="fas fa-check me-2"></i> Mengerti, Tutup
            </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .bg-teal { background-color: #0d9488 !important; }
    #dataTable thead th {
        font-weight: 600; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px;
        background-color: #2c3e50 !important; color: white; border: none !important;
    }
    #dataTable tbody tr:hover {
        background-color: #f8faff !important; transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.1); transition: all 0.2s ease;
    }
    .btn-sm { width: 38px; height: 38px; display: flex; align-items: center; justify-content: center; }
    .btn-sm:hover { transform: translateY(-3px); box-shadow: 0 8px 15px rgba(0,0,0,0.2) !important; }
    .card { border: none; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
    .card-header { border-radius: 10px 10px 0 0 !important; }
    .badge { font-size: 0.75rem; padding: 0.35em 0.65em; border-radius: 6px; font-weight: 500; }
</style>
@endpush

@push('scripts')

<script>
    function hideInstructionModal() {
        const modal = document.getElementById('instructionModal');
        if (modal) {
            // Hapus class 'show' agar animasi fade out berjalan (jika ada)
            modal.classList.remove('show');
            // Sembunyikan modal
            modal.style.display = 'none';
            // Hapus backdrop (elemen .modal-backdrop yang dibuat Bootstrap)
            const backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) {
                backdrop.remove();
            }
            // Hapus class modal-open dari body (agar scroll kembali normal)
            document.body.classList.remove('modal-open');
            // Hapus padding-right yang ditambahkan Bootstrap
            document.body.style.paddingRight = '';
        }
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const loadingModalEl = document.getElementById('loadingModal');
        const instructionModalEl = document.getElementById('instructionModal');

        if (!loadingModalEl || !instructionModalEl) {
            console.error('Modal tidak ditemukan!');
            return;
        }

        const loadingModal = new bootstrap.Modal(loadingModalEl);
        const instructionModal = new bootstrap.Modal(instructionModalEl);

        let currentButton = null;
        let fallbackTimeout = null;

        // Proses setelah download selesai (baik template maupun verified)
        function showInstructionModal() {
            // Kembalikan ikon tombol ke bentuk semula sesuai jenis tombol
            if (currentButton) {
                const icon = currentButton.querySelector('i');
                icon.classList.remove('fa-spin', 'fa-spinner');

                if (currentButton.classList.contains('approval-download-btn')) {
                    icon.classList.add('fa-check-double');  // Ikon Approval
                } else if (currentButton.classList.contains('rejected-download-btn')) {
                    icon.classList.add('fa-times-circle');  // Ikon Rejected
                } else {
                    icon.classList.add('fa-file-excel');    // Ikon Download Template
                }
                currentButton = null;
            }

            // Bersihkan fallback timeout
            if (fallbackTimeout) {
                clearTimeout(fallbackTimeout);
                fallbackTimeout = null;
            }

            // Tutup loading modal dan buka instruksi
            loadingModal.hide();
            instructionModal.show();
        }

        // Event klik untuk KEDUA tombol: Download Template & Approval Download
        document.querySelectorAll('.download-excel-btn, .approval-download-btn, .rejected-download-btn').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();

            currentButton = this;

            // Ganti ikon menjadi spinner
            const icon = this.querySelector('i');
            if (this.classList.contains('approval-download-btn')) {
                icon.classList.replace('fa-check-double', 'fa-spinner');
            } else if (this.classList.contains('rejected-download-btn')) {
                icon.classList.replace('fa-times-circle', 'fa-spinner');
            } else {
                icon.classList.replace('fa-file-excel', 'fa-spinner');
            }
            icon.classList.add('fa-spin');

            // Tampilkan modal loading
            loadingModal.show();

            // Trigger download file
            const link = document.createElement('a');
            link.href = this.href;
            link.download = ''; // Biarkan browser tentukan nama file
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);

            // Fallback: maksimal 4 detik langsung tampilkan instruksi
            fallbackTimeout = setTimeout(showInstructionModal, 4000);
        });
    });

        // Deteksi saat jendela kembali fokus (setelah user menyimpan file)
        window.addEventListener('focus', function () {
            if (currentButton && loadingModalEl.classList.contains('show')) {
                showInstructionModal();
            }
        });

        // Tooltip
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        tooltipTriggerList.forEach(el => new bootstrap.Tooltip(el));

        // Auto close alert
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                bootstrap.Alert.getOrCreateInstance(alert).close();
            });
        }, 5000);

        // Simpan preferensi perPage
        const perPageSelect = document.getElementById('perPage');
        if (perPageSelect) {
            perPageSelect.addEventListener('change', function () {
                localStorage.setItem('calibrations_perPage', this.value);
            });
            const saved = localStorage.getItem('calibrations_perPage');
            if (saved) perPageSelect.value = saved;
        }
    });
</script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {
    var table = $('#calibrationTable').DataTable({
        paging: false,
        lengthChange: false,
        searching: true,
        ordering: true,
        info: false,
        autoWidth: false,
        language: {
            search: "Cari: ",
            zeroRecords: "Tidak ditemukan data yang sesuai",
            emptyTable: "Belum ada data untuk ditampilkan"
        },
        columnDefs: [
            { orderable: false, targets: 'no-sort' }
        ]
    });

    // Pindahkan search box bawaan DataTables ke wrapper di kanan atas
    $('.dataTables_filter').appendTo('#dtSearchWrapper');

    // Styling search box agar lebih rapi dan sesuai tema
    $('.dataTables_filter label')
        .addClass('d-flex align-items-center mb-0')
        .css('margin-bottom', '0');

    $('.dataTables_filter input')
        .addClass('form-control form-control-sm ms-2')
        .css({ 'width': '220px', 'display': 'inline-block' });
});
</script>


@endpush