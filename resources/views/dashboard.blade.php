@extends('layouts.app')
@section('title', 'Dashboard Calibration')

@section('content')
@php
    use Carbon\Carbon;

    // Total data hari ini
    $todayCount = \App\Models\Calibration::whereDate('created_at', Carbon::today())->count();

    // Data status
    $waiting = \App\Models\Calibration::where('status', 'waiting_verification')->latest()->get();
    $approved = \App\Models\Calibration::where('status', 'approved')->latest()->get();
    $rejected = \App\Models\Calibration::where('status', 'rejected')->latest()->get();
    $verified = \App\Models\Calibration::where('status', 'verified')->latest()->get();


    $totalWaiting = $waiting->count();
    $totalApproved = $approved->count();
    $totalVerified = $verified->count();
    $totalRejected = $rejected->count();

    // Data untuk kalender: jumlah data per tanggal di bulan ini
    $currentMonth = Carbon::now()->startOfMonth();
    $endOfMonth = Carbon::now()->endOfMonth();

    $dataPerDate = \App\Models\Calibration::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                                          ->whereBetween('created_at', [$currentMonth, $endOfMonth])
                                          ->groupBy('date')
                                          ->pluck('count', 'date')
                                          ->toArray();

    // Semua data bulan ini untuk modal detail per tanggal
    $allThisMonth = \App\Models\Calibration::whereBetween('created_at', [$currentMonth, $endOfMonth])
                                           ->orderBy('created_at', 'desc')
                                           ->get()
                                           ->groupBy(function($item) {
                                               return $item->created_at->format('Y-m-d');
                                           });
@endphp

<div class="row">



                                           <!-- Menunggu Verifikasi -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card border-0 shadow-lg h-100 hover-shadow transition-all rounded-3">
            <div class="card-header bg-warning text-dark border-0 py-3 rounded-top-3">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="mb-0 font-weight-bold">
                        <i class="fas fa-hourglass-half me-2"></i> Menunggu Verifikasi
                    </h5>
                    <span class="badge bg-dark rounded-pill px-3 py-2">{{ $totalWaiting }}</span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush rounded-bottom-3" style="max-height: 300px; overflow-y: auto;">
                    @forelse($waiting->take(8) as $cal)
                        <a href="{{ route('calibrations.show', $cal->id) }}" class="list-group-item list-group-item-action border-0 px-4 py-3 hover-bg-light">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm bg-soft-warning rounded-circle me-3">
                                    <i class="fas fa-tools fa-sm text-warning"></i>
                                </div>
                                <div class="flex-fill">
                                    <p class="mb-1 fw-medium text-dark text-truncate">{{ $cal->namaAlat }}</p>
                                    <small class="text-muted">{{ $cal->NoSeri ?? '—' }} • {{ $cal->brandAlat ?? '—' }}</small>
                                </div>
                                <small class="text-muted ms-2">{{ $cal->created_at->format('H:i') }}</small>
                            </div>
                        </a>
                    @empty
                        <div class="text-center py-5 text-muted opacity-75">
                            <i class="fas fa-inbox fa-3x mb-3"></i>
                            <p>Tidak ada data</p>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="card-footer bg-transparent border-0 pt-2">
                <a href="{{ route('calibrations.index') }}?status=waiting_verification" class="btn btn-outline-warning btn-sm w-100 rounded-pill shadow-sm">
                    Lihat Semua →
                </a>
            </div>
        </div>
    </div>
    <!-- Terverifikasi (BARU) -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card border-0 shadow-lg h-100 hover-shadow transition-all rounded-3">
            <div class="card-header bg-info text-white border-0 py-3 rounded-top-3">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="mb-0 font-weight-bold">
                        <i class="fas fa-verified me-2"></i> Terverifikasi
                    </h5>
                    <span class="badge bg-light text-info rounded-pill px-3 py-2">{{ $totalVerified }}</span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush" style="max-height: 300px; overflow-y: auto;">
                    @forelse($verified->take(8) as $cal)
                        <a href="{{ route('calibrations.show', $cal->id) }}" class="list-group-item list-group-item-action border-0 px-4 py-3 hover-bg-light">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm bg-soft-info rounded-circle me-3">
                                    <i class="fas fa-certificate fa-sm text-info"></i>
                                </div>
                                <div class="flex-fill">
                                    <p class="mb-1 fw-medium text-dark text-truncate">{{ $cal->namaAlat }}</p>
                                    <small class="text-muted">{{ $cal->NoSeri ?? '—' }} • {{ $cal->brandAlat ?? '—' }}</small>
                                </div>
                                <small class="text-muted ms-2">{{ $cal->updated_at->format('H:i') }}</small>
                            </div>
                        </a>
                    @empty
                        <div class="text-center py-5 text-muted opacity-75">
                            <i class="fas fa-check-double fa-3x mb-3"></i>
                            <p>Belum ada data</p>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="card-footer bg-transparent border-0 pt-2">
                <a href="{{ route('calibrations.index') }}?status=verified" class="btn btn-info btn-sm w-100 rounded-pill shadow-sm">
                    Lihat Semua →
                </a>
            </div>
        </div>
    </div>

    

    <!-- Disetujui -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card border-0 shadow-lg h-100 hover-shadow transition-all rounded-3">
            <div class="card-header bg-success text-white border-0 py-3 rounded-top-3">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="mb-0 font-weight-bold">
                        <i class="fas fa-check-circle me-2"></i> Disetujui
                    </h5>
                    <span class="badge bg-light text-success rounded-pill px-3 py-2">{{ $totalApproved }}</span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush" style="max-height: 300px; overflow-y: auto;">
                    @forelse($approved->take(8) as $cal)
                        <a href="{{ route('calibrations.show', $cal->id) }}" class="list-group-item list-group-item-action border-0 px-4 py-3 hover-bg-light">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm bg-soft-success rounded-circle me-3">
                                    <i class="fas fa-check fa-sm text-success"></i>
                                </div>
                                <div class="flex-fill">
                                    <p class="mb-1 fw-medium text-dark text-truncate">{{ $cal->namaAlat }}</p>
                                    <small class="text-muted">{{ $cal->NoSeri ?? '—' }} • {{ $cal->brandAlat ?? '—' }}</small>
                                </div>
                                <small class="text-muted ms-2">{{ $cal->updated_at->format('H:i') }}</small>
                            </div>
                        </a>
                    @empty
                        <div class="text-center py-5 text-muted opacity-75">
                            <i class="fas fa-thumbs-up fa-3x mb-3"></i>
                            <p>Belum ada data</p>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="card-footer bg-transparent border-0 pt-2">
                <a href="{{ route('calibrations.index') }}?status=approved" class="btn btn-success btn-sm w-100 rounded-pill shadow-sm">
                    Lihat Semua →
                </a>
            </div>
        </div>
    </div>

    <!-- Ditolak -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card border-0 shadow-lg h-100 hover-shadow transition-all rounded-3">
            <div class="card-header bg-danger text-white border-0 py-3 rounded-top-3">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="mb-0 font-weight-bold">
                        <i class="fas fa-times-circle me-2"></i> Ditolak
                    </h5>
                    <span class="badge bg-light text-danger rounded-pill px-3 py-2">{{ $totalRejected }}</span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush" style="max-height: 300px; overflow-y: auto;">
                    @forelse($rejected->take(8) as $cal)
                        <a href="{{ route('calibrations.show', $cal->id) }}" class="list-group-item list-group-item-action border-0 px-4 py-3 hover-bg-light">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm bg-soft-danger rounded-circle me-3">
                                    <i class="fas fa-ban fa-sm text-danger"></i>
                                </div>
                                <div class="flex-fill">
                                    <p class="mb-1 fw-medium text-dark text-truncate">{{ $cal->namaAlat }}</p>
                                    <small class="text-muted">{{ $cal->NoSeri ?? '—' }} • {{ $cal->brandAlat ?? '—' }}</small>
                                </div>
                                <small class="text-muted ms-2">{{ $cal->updated_at->format('H:i') }}</small>
                            </div>
                        </a>
                    @empty
                        <div class="text-center py-5 text-muted opacity-75">
                            <i class="fas fa-smile fa-3x mb-3"></i>
                            <p>Tidak ada data</p>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="card-footer bg-transparent border-0 pt-2">
                <a href="{{ route('calibrations.index') }}?status=rejected" class="btn btn-danger btn-sm w-100 rounded-pill shadow-sm">
                    Lihat Semua →
                </a>
            </div>
        </div>
    </div>

</div>
<!-- Layout Bawah: Kiri (Profil, Sistem, Aksi vertikal) | Kanan (Kalender lebih lebar) -->
<div class="row mt-4">
    <!-- Kiri: Profil, Sistem, Aksi Cepat (susun atas-bawah) -->
        <div class="col-lg-4 col-md-12 mb-4">
                  <div class="row g-4">
    <!-- Profil User -->
    <div class="col-12">
        <div class="card shadow-lg border-0 rounded-4 h-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
            <div class="card-body d-flex align-items-center p-5">
                <div class="position-relative me-5">
                    @if(auth()->user()->foto)
                        <img src="{{ asset('profile_foto/' . auth()->user()->foto) }}"
                            class="rounded-circle shadow-lg border border-5 border-white object-fit-cover"
                            width="110"
                            height="110"
                            alt="Foto {{ auth()->user()->nama }}"
                            onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nama) }}&background=ffffff&color=667eea&bold=true&size=128'">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nama ?? 'Admin') }}&background=ffffff&color=667eea&bold=true&rounded=true&size=128"
                            class="rounded-circle shadow-lg border border-5 border-white"
                            width="110"
                            height="110"
                            alt="Avatar">
                    @endif
                   
                </div>
                <div style="width: 30px;"></div>
               <div>
                    @php
                        // Waktu Jakarta (WIB)
                        $now = now()->timezone('Asia/Jakarta');
                        $jam = $now->hour;

                        if ($jam >= 5 && $jam < 11) {
                            $salam = 'Selamat Pagi';
                            $kalimatSemangat = [
                                'Selamat beraktivitas. Semoga hari ini berjalan lancar dan produktif.',
                                'Semangat menjalankan tugas hari ini dengan penuh dedikasi.',
                                'Pagi yang baik untuk memulai pekerjaan dengan fokus dan tenang.',
                                'Mari kita sambut hari baru dengan energi yang optimal.'
                            ];
                        } elseif ($jam >= 11 && $jam < 15) {
                            $salam = 'Selamat Siang';
                            $kalimatSemangat = [
                                'Tetap semangat menjalankan tugas di tengah hari.',
                                'Jaga stamina dan fokus hingga seluruh pekerjaan selesai.',
                                'Semoga segala urusan hari ini berjalan lancar dan sesuai rencana.',
                                'Terus bekerja dengan baik, hasil yang optimal akan segera tercapai.'
                            ];
                        } elseif ($jam >= 15 && $jam < 18) {
                            $salam = 'Selamat Sore';
                            $kalimatSemangat = [
                                'Semangat menyelesaikan sisa tugas hari ini dengan baik.',
                                'Hampir selesai, mari kita tutup hari ini dengan hasil yang memuaskan.',
                                'Tetap konsisten dan teliti hingga akhir waktu kerja.',
                                'Sore yang produktif, semoga semua target hari ini tercapai.'
                            ];
                        } else {
                            $salam = 'Selamat Malam';
                            $kalimatSemangat = [
                                'Terima kasih atas kerja keras hari ini. Istirahatlah yang cukup.',
                                'Selamat beristirahat. Semoga besok kita kembali segar dan produktif.',
                                'Malam yang tenang. Pulihkan tenaga untuk hari esok yang lebih baik.',
                                'Hari ini telah selesai dengan baik. Saatnya beristirahat dengan nyaman.'
                            ];
                        }

                        $randomKalimat = $kalimatSemangat[array_rand($kalimatSemangat)];
                    @endphp

                    <h4 class="mb-2 fw-light opacity-90">{{ $salam }},</h4>
                    <h2 class="mb-4 fw-bold display-5">{{ auth()->user()->nama ?? 'User' }}!</h2>
                    <p class="mb-0 fst-italic lead opacity-90">
                        <i class="fas fa-quote-left me-2 opacity-70"></i>
                        {{ $randomKalimat }}
                        <i class="fas fa-quote-right ms-2 opacity-70"></i>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Sistem -->
    <div class="col-12 col-md-6">
        <div class="card shadow-sm border-0 rounded-4 h-100 bg-light">
            <div class="card-body p-4">
                <h6 class="fw-bold text-success mb-4"><i class="fas fa-server me-2"></i> Status Sistem</h6>
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-circle text-success me-3 fs-5"></i>
                    <div>
                        <div class="text-muted small">Server Status</div>
                        <strong class="text-success">Online</strong>
                    </div>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-clock text-primary me-3 fs-5"></i>
                    <div>
                        <div class="text-muted small">Waktu Saat Ini (WIB)</div>
                        <strong><span id="clock" class="fs-5"></span></strong>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <i class="fas fa-calendar-alt text-info me-3 fs-5"></i>
                    <div>
                        <div class="text-muted small">Tanggal Hari Ini</div>
                        <strong>{{ $now->format('d F Y') }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Aksi Cepat -->
    <div class="col-12 col-md-6">
        <div class="card shadow-sm border-0 rounded-4 h-100">
            <div class="card-body p-4 d-flex flex-column justify-content-center">
                <h6 class="fw-bold text-primary mb-4"><i class="fas fa-bolt me-2"></i> Aksi Cepat</h6>
                <a href="{{ route('calibrations.index') }}" class="btn btn-outline-primary btn-lg w-100 mb-3 rounded-pill shadow hover-shadow-lg transition">
                    <i class="fas fa-list-alt me-2"></i> Lihat Semua Data
                </a>
                <a href="{{ route('calibrations.create') }}" class="btn btn-primary btn-lg w-100 rounded-pill shadow hover-shadow-lg transition" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
                    <i class="fas fa-plus-circle me-2"></i> Tambah Data Baru
                </a>
            </div>
        </div>
    </div>
</div>
        </div>


   <!-- Kanan: Kalender lebih lebar dengan +n more scrollable -->
    <div class="col-lg-8 col-md-12">
        <div class="card shadow-lg border-0 rounded-4 overflow-hidden h-100">
            <div class="card-header bg-gradient-to-r from-indigo-500 to-purple-600 text-white py-4">
                <h5 class="mb-0 text-center fw-bold">
                    <i class="fas fa-calendar-alt me-3"></i> Kalender Data Calibration
                </h5>
            </div>
            <div class="card-body p-4 bg-gray-50">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('styles')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css" rel="stylesheet" />
<style>
    .bg-gradient-to-r { background: linear-gradient(to right, #6366f1, #a78bfa); }
    .bg-gray-50 { background-color: #f8fafc; }

    #calendar {
        max-width: 100%;
        margin: 0 auto;
        font-size: 0.95rem;
    }

    /* Hari ini - lingkaran biru gradient */
    .fc-day-today {
        background: rgba(99, 102, 241, 0.1) !important;
    }
    .fc-day-today .fc-daygrid-day-number {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: white;
        border-radius: 50%;
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        font-weight: bold;
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
    }

    /* Event cantik */
    .fc-event {
        border-radius: 8px !important;
        padding: 4px 8px !important;
        font-size: 0.85rem !important;
        font-weight: 500;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        transition: all 0.3s ease;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .fc-event:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        z-index: 10;
    }

    /* +n more popover dengan scroll */
    .fc-more-popover {
        width: 320px !important;
        max-height: 400px !important;
        overflow-y: auto !important;
        border-radius: 12px !important;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }
    .fc-more-popover .fc-popover-body {
        max-height: 360px;
        overflow-y: auto;
        padding: 10px;
    }
    .fc-more-popover .fc-event {
        margin-bottom: 6px !important;
        display: block;
        width: 100%;
    }

    .fc-button {
        border-radius: 8px !important;
        padding: 6px 12px !important;
        font-weight: 600;
    }

      .text-orange {
        color: #ff7b00 !important;
    }
    
    .fst-italic {
        font-style: italic;
    }
    
    .border-0 {
        border: 0 !important;
    }
    
    .rounded-4 {
        border-radius: 1rem !important;
    }
    
    .shadow-sm {
        box-shadow: 0 .125rem .25rem rgba(0,0,0,.075) !important;
    }
    
    .shadow-lg {
        box-shadow: 0 1rem 3rem rgba(0,0,0,.175) !important;
    }
    .transition {
        transition: all 0.3s ease;
    }
    .hover-shadow-lg:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15) !important;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            height: 'auto',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: ''
            },
            events: '{{ route('calibration.events') }}',
            eventClick: function(info) {
                info.jsEvent.preventDefault();
                if (info.event.url) {
                    window.location.href = info.event.url;
                }
            },
            dayMaxEvents: 4, // maks 4 event langsung tampil, sisanya jadi +n more
            moreLinkClick: 'popover', // klik +n more → popover
            locale: 'id'
        });

        calendar.render();
    });

    // Jam real-time
    function updateClock() {
        const now = new Date();
        document.getElementById('clock').textContent = now.toLocaleTimeString('id-ID', {
            hour: '2-digit', minute: '2-digit', second: '2-digit'
        });
    }
    setInterval(updateClock, 1000);
    updateClock();
</script>

<script>
   // Jam real-time Jakarta
function updateClock() {
    const now = new Date(new Date().toLocaleString("en-US", {timeZone: "Asia/Jakarta"}));
    const time = now.toLocaleTimeString('id-ID', {hour: '2-digit', minute:'2-digit', second:'2-digit'});
    document.getElementById('clock').innerHTML = time;
}
updateClock();
setInterval(updateClock, 1000);
</script>
@endpush