@extends('layouts.app')
@section('title', 'Daftar Kalibrasi')

@section('content')

<div class="cal-wrapper">

    <div class="cal-hero">
        <div class="cal-hero-bg"></div>
        <div class="cal-hero-content d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div class="d-flex align-items-center gap-3">
                <div class="cal-hero-icon">
                    <i class="fas fa-microscope"></i>
                </div>
                &nbsp;&nbsp;
                <div>
                    <h4 class="mb-0 fw-bold text-white">Daftar Kalibrasi</h4>
                </div>
            </div>
            @if(auth()->user()->role === 'super admin' || auth()->user()->role === 'teknisi')
            <a href="{{ route('calibrations.create') }}" class="cal-btn-add">
                <i class="fas fa-plus me-2"></i>
                <span>Tambah Kalibrasi</span>
            </a>
            @endif
        </div>
    </div>

    <div class="cal-body">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 border-0 shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-3 border-0 shadow-sm" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="cal-toolbar">
        <form method="GET" action="{{ route('calibrations.index') }}" class="d-flex align-items-center gap-2 flex-wrap">
            <span class="cal-label">Tampilkan</span>
            &nbsp;
            <span class="cal-label">data</span>
            &nbsp;
            <select name="perPage" id="perPage" class="cal-select" onchange="this.form.submit()">
                <option value="5"  {{ request('perPage', 10) == 5  ? 'selected' : '' }}>5</option>
                <option value="10" {{ request('perPage', 10) == 10 ? 'selected' : '' }}>10</option>
                <option value="25" {{ request('perPage', 10) == 25 ? 'selected' : '' }}>25</option>
                <option value="50" {{ request('perPage', 10) == 50 ? 'selected' : '' }}>50</option>
                <option value="100"{{ request('perPage', 10) == 100? 'selected' : '' }}>100</option>
                <option value="all"{{ request('perPage') == 'all' ? 'selected' : '' }}>Semua</option>
            </select>
          
            <input type="hidden" name="status" value="{{ request('status') }}">
        </form>

        @if(auth()->user()->role === 'teknisi')
        <!-- Status Badge/Text indicating the current view for the teknisi role -->
        <div class="cal-filter-group" style="padding: 0 10px;">
           <span class="badge bg-secondary">
                Data Draft
            </span>
        </div>
        @else
        <div class="cal-filter-group">
            <form method="GET" action="{{ route('calibrations.index') }}" class="d-flex align-items-center gap-1 flex-wrap" id="filterStatusForm">
                <input type="hidden" name="perPage" value="{{ request('perPage', 10) }}">
                <i class="fas fa-sliders-h" style="color:#1a56db;font-size:.8rem"></i>
                &nbsp;&nbsp;
                <select name="status" id="statusFilter" class="cal-select" onchange="this.form.submit()">
                    <option value="" {{ !request('status') ? 'selected' : '' }}>Semua Status</option>
                    @if(auth()->user()->role === 'checker')
                        <option value="waiting_verification" {{ request('status') == 'waiting_verification' ? 'selected' : '' }}>Menunggu Verif</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                    @elseif(auth()->user()->role === 'approver')
                        <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>Menunggu Approval</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                    @else
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="waiting_verification" {{ request('status') == 'waiting_verification' ? 'selected' : '' }}>Menunggu Verif</option>
                        <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>Menunggu Approval</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                    @endif
                </select>
            </form>
        </div>
        @endif

        @if(in_array(auth()->user()->role, ['teknisi', 'super admin']))
        <form action="{{ route('calibrations.send-all-to-checker') }}" method="POST" class="cal-send-all-form">
            @csrf
            <button type="submit" class="cal-btn-send" onclick="return confirm('Yakin ingin mengirim SEMUA data draft ke checker?')">
                <i class="fas fa-paper-plane"></i> <span>Kirim Semua Data Draft</span>
            </button>
        </form>
        @endif

        <div id="dtSearchWrapper" class="ms-auto"></div>
    </div>

    <div class="cal-table-wrap">
        <table class="table table-hover table-borderless align-middle" id="calibrationTable" width="100%">
           <thead class="cal-thead">
                <tr>
                    <th width="40" class="text-center no-sort cell-expand"></th> {{-- Kolom 0: Tombol Expand Modern --}}
                    <th class="text-center" width="4%">No</th> {{-- Kolom 1 --}}
                    <th>Certificate ID</th> {{-- Kolom 2 --}}
                    <th>Kode Alat</th> {{-- Kolom 3 --}}
                    <th>Nama Alat</th> {{-- Kolom 4 --}}
                    <th>No Seri</th> {{-- Kolom 5 --}}
                    <th>Jenis</th> {{-- Kolom 6 --}}
                    <th>Merek</th> {{-- Kolom 7 --}}
                    <th>Pemilik</th> {{-- Kolom 8 --}}
                    <th>Tanggal Masuk</th> {{-- Kolom 9 --}}
                    <th>Kalibrasi By</th> {{-- Kolom 10 --}}
                    <th class="text-center">Status</th> {{-- Kolom 11 --}}
                    <th class="text-center no-sort" width="10%">Aksi</th> {{-- Kolom 12 --}}
                </tr>
            </thead>
            <tbody>
                @forelse($calibrations as $calibration)
                <tr>
                    <td class="text-center cell-expand">
                        <span class="btn-expand-trigger">
                            <i class="fas fa-plus"></i>
                        </span>
                    </td>

                    <td class="text-center fw-bold text-muted">
                        {{ $loop->iteration + (($calibrations->currentPage() - 1) * $calibrations->perPage()) }}
                    </td>

                    <td>
                        @php
                            $certificateId = '';
                            $formTypeMapping = [
                                'inside_micrometer' => 'headInsideMicrometer',
                                'outside_micrometer' => 'headOutsideMicrometer',
                                'depth_micrometer' => 'headDepthMicrometer',
                                'insulation' => 'headInsulation',
                                'thermometer' => 'headThermometer',
                                'dial_indicator' => 'headDialIndicator',
                                'dial_test_indicator' => 'headDialTestIndicator',
                                'depth_caliper' => 'headDepthCaliper',
                                'caliper' => 'headCaliper',
                                'torque_wrench' => 'headTorqueWrench',
                                'torque_meter' => 'headTorqueMeter',
                                'ultrasonic_thickness_gauge' => 'headUltrasonicThicknessGauge',
                                'thickness_gauge' => 'headThicknessGauge',
                                'penggaris' => 'headPenggaris',
                                'enclosure' => 'headEnclosure',
                                'chamber' => 'headChamber',
                                'pressure_gauge' => 'headPressureGauge',
                                'differential_pressure_gauge' => 'headDifferentialPressureGauge',
                                'height_gauge' => 'headHeightGauge',
                                'volumetrik' => 'headVolumetrik',
                                'thermohygrometer' => 'headThermoHygrometer',
                                'viscometer' => 'headViscometer',
                                'push_pull' => 'headPushPull',
                                'timbangan' => 'headTimbangan',
                                'timbangan_moisture' => 'headTimbanganMoisture',
                                'timbangan_bias' => 'headTimbanganBias',
                                'anak_timbangan' => 'headAnakTimbangan',
                                'gauge_block' => 'headGaugeBlock',
                                'holetest' => 'headHoletest',
                                'conductivity_meter' => 'headConductivityMeter',
                                'coating_thickness' => 'headCoatingThickness',
                                'durometer' => 'headDurometer',
                                'mikropipet_dispenset' => 'headMikropipetDispenset',
                                'taper_gauge' => 'headTaperGauge',
                                'feeler_gauge' => 'headFeelerGauge',
                                'ph_meter' => 'headPhMeter',
                                'tachometer' => 'headTachometer',
                                'pin_gauge' => 'headPinGauge',
                                'visco_cup' => 'headViscoCup',
                                'plain_limit_gauge' => 'headPlainLimitGauge',
                                'temp_humid_transmitter' => 'headTempHumidTransmitter',
                                'temperature_transmitter' => 'headTempTransmitter',
                                'ir_thermometer' => 'headIrThermometer',
                                'thermo_indicator' => 'headThermoIndicator',
                                'plastic_shim' => 'headPlasticShim',
                                'profil_projector' => 'headProfilProjector',
                                'surface_roughness_tester' => 'headSurfaceRoughnessTester',
                                'thread_gauge' => 'headThreadGauge',
                                'stopwatch' => 'headStopwatch',
                                'centrifuge' => 'headCentrifuge',
                                'utm' => 'headUtm',
                                'pressure_transmitter' => 'headPressureTransmitter',
                                'surface_plate' => 'headSurfacePlate',
                                'bore_gauge' => 'headBoreGauge',
                                'abration_tester' => 'headAbrationTester',
                            ];
                            
                            $currentFormType = $calibration->form_type ?? '';
                            
                            if ($currentFormType && isset($formTypeMapping[$currentFormType])) {
                                $headModel = $formTypeMapping[$currentFormType];
                                if ($calibration->$headModel && $calibration->$headModel->certificate_id) {
                                    $certificateId = $calibration->$headModel->certificate_id;
                                }
                            }
                            
                            if (!$certificateId) {
                                $allHeads = array_values($formTypeMapping);
                                $uniqueHeads = array_unique($allHeads);
                                
                                foreach ($uniqueHeads as $head) {
                                    if ($calibration->$head && $calibration->$head->certificate_id) {
                                        $certificateId = $calibration->$head->certificate_id;
                                        break;
                                    }
                                }
                            }
                            
                            if (!$certificateId) {
                                $certificateId = 'Tidak ditemukan';
                            }
                        @endphp

                        @if($certificateId && $certificateId !== 'Tidak ditemukan')
                            <span class="badge bg-white text-primary border border-primary fw-bold px-3 py-2 rounded-pill cert-badge">
                                {{ $certificateId }}
                            </span>
                        @else
                            <span class="text-muted fst-italic">— {{ $certificateId }}</span>
                        @endif
                    </td>

                    <td>
                        <span class="badge bg-light text-dark border px-2 py-1 font-monospace">
                            {{ $calibration->kodeAlat ?? '-' }}
                        </span>
                    </td>

                    <td class="fw-medium alat-name">{{ $calibration->namaAlat ?? '-' }}</td>

                    <td class="text-muted font-monospace">{{ $calibration->NoSeri ?? '-' }}</td>
                    
                    <td>
                        @php
                            $jenis = 'General';
                            $namaLower = strtolower($calibration->namaAlat ?? '');
                            $formType = $calibration->form_type ?? null;
                            
                            $jenisMap = [
                                'volumetrik' => 'Volumetrik',
                                'inside_micrometer' => 'Inside Micrometer',
                                'outside_micrometer' => 'Outside Micrometer',
                                'depth_micrometer' => 'Depth Micrometer',
                                'thermometer' => 'Thermometer',
                                'dial_indicator' => 'Dial Indicator',
                                'dial_test_indicator' => 'Dial Test Indicator',
                                'depth_caliper' => 'Depth Caliper',
                                'caliper' => 'Caliper',
                                'torque_wrench' => 'Torque Wrench',
                                'torque_meter' => 'Torque Meter',
                                'ultrasonic_thickness_gauge' => 'Ultrasonic Thickness Gauge',
                                'thickness_gauge' => 'Thickness Gauge',
                                'penggaris' => 'Penggaris',
                                'enclosure' => 'Enclosure',
                                'chamber' => 'Climatic Chamber',
                                'pressure_gauge' => 'Pressure Gauge',
                                'height_gauge'=> 'Height Gauge',
                                'differential_pressure_gauge' => 'Differential Pressure Gauge',
                                'thermohygrometer' => 'Thermohygrometer',
                                'viscometer' => 'Viscometer',
                                'push_pull' => 'Push Pull',
                                'gauge_block' => 'Gauge Block',
                                'holetest' => 'Holetest',
                                'conductivity_meter' => 'Conductivity Meter',
                                'coating_thickness' => 'Coating Thickness',
                                'durometer' => 'Durometer',
                                'mikropipet_dispenset' => 'Mikropipet / Dispenset',
                                'taper_gauge' => 'Taper Gauge',
                                'feeler_gauge' => 'Feeler Gauge',
                                'ph_meter' => 'PH Meter',
                                'tachometer' => 'Tachometer',
                                'pin_gauge' => 'Pin Gauge',
                                'visco_cup' => 'Visco Cup',
                                'plain_limit_gauge' => 'Plain Limit Gauge',
                                'temp_humid_transmitter' => 'Temp Humidity Transmitter',
                                'temperature_transmitter' => 'Temp Transmitter',
                                'thermoindicator' => 'ThermoIndicator',
                                'plastic_shim' => 'Plastic Shim',
                                'profil_projector' => 'Profil Projector',
                                'surface_roughness_tester' => 'Surface Roughness Tester',
                                'thread_gauge' => 'Thread Gauge',
                                'stopwatch' => 'Stopwatch',
                                'centrifuge' => 'Centrifuge',
                                'utm' => 'Mesin Uji Tarik & Tekan',
                                'pressure_transmitter' => 'Pressure Transmitter',
                                'surface_plate' => 'Meja Rata',
                                'bore_gauge' => 'Bore Gauge',
                                'timbangan_moisture' => 'Timbangan Moisture',
                                'timbangan' => 'Timbangan',
                                'anak_timbangan' => 'Anak Timbangan',
                                'timbangan_bias' => 'Timbangan Bias',
                                'ir_thermometer' => 'IR Thermometer',
                                'abration_tester' => 'Abration Tester',
                                'insulation' => 'Insulation',
                            ];
                            
                            if (isset($jenisMap[$formType])) {
                                $jenis = $jenisMap[$formType];
                            } elseif ($formType === 'enclosure') {
                                if (str_contains($namaLower, 'oven')) $jenis = 'Oven';
                                elseif (str_contains($namaLower, 'freezer')) $jenis = 'Freezer';
                                elseif (str_contains($namaLower, 'furnace')) $jenis = 'Furnace';
                                elseif (str_contains($namaLower, 'incubator')) $jenis = 'Incubator';
                                elseif (str_contains($namaLower, 'waterbath')) $jenis = 'Waterbath';
                                elseif (str_contains($namaLower, 'autoclave')) $jenis = 'Autoclave';
                                else $jenis = 'Enclosure';
                            } elseif (str_contains($namaLower, 'timbangan')) {
                                if (str_contains($namaLower, 'moisture')) $jenis = 'Timbangan Moisture';
                                elseif (str_contains($namaLower, 'anak')) $jenis = 'Anak Timbangan';
                                elseif (str_contains($namaLower, 'bias')) $jenis = 'Timbangan Bias';
                                else $jenis = 'Timbangan';
                            }
                        @endphp
                        <span class="badge bg-light text-primary border rounded-pill px-3 py-1">
                            {{ $jenis }}
                        </span>
                    </td>
                    
                    <td class="text-muted">{{ $calibration->brandAlat ?? '-' }}</td>
                    
                   <td class="text-muted">
                        <div>{{ $calibration->pemilikAlat ?? '-' }}</div>
                        @if(!empty($calibration->no_po))
                            <small class="badge bg-light text-secondary border mt-1"><i class="fas fa-file-invoice me-1"></i>{{ $calibration->no_po }}</small>
                        @endif
                    </td>
                    
                    <td class="small text-muted">
                        <i class="far fa-calendar-alt me-1"></i>
                        {{ $calibration->tanggalMasuk ? \Carbon\Carbon::parse($calibration->tanggalMasuk)->format('d M Y') : '-' }}
                    </td>
                    
                    <td class="text-muted">{{ $calibration->calibratedBy ?? '-' }}</td>

                    <td>
                        @php
                            $status = match($calibration->status) {
                                'draft' => ['Draft', 'bg-secondary text-white'],
                                'waiting_verification' => ['Menunggu Verif', 'bg-warning text-dark'],
                                'waiting_approval' => ['Menunggu Approval', 'bg-info text-white'],
                                'verified' => ['Terverifikasi', 'bg-primary text-white'],
                                'approved' => ['Disetujui', 'bg-success text-white'],
                                'rejected' => ['Ditolak', 'bg-danger text-white'],
                                'completed' => ['Selesai', 'bg-teal text-white'],
                                default => ['Unknown', 'bg-dark text-white']
                            };
                        @endphp
                        <span class="badge {{ $status[1] }} rounded-pill px-3 py-2 fw-bold status-badge">
                            {{ $status[0] }}
                        </span>
                    </td>

                    <td class="text-center">
                        <div class="d-flex align-items-center justify-content-center gap-2 flex-wrap action-group">
                            @php
                                $role = auth()->user()->role;
                                
                                $canEdit = false;
                                if ($role === 'super admin') {
                                    $canEdit = $calibration->status !== 'completed';
                                } elseif ($role === 'teknisi') {
                                    $canEdit = $calibration->status === 'draft';
                                } elseif ($role === 'checker') {
                                    $canEdit = in_array($calibration->status, ['waiting_verification', 'rejected']);
                                } elseif ($role === 'approver') {
                                    $canEdit = $calibration->status === 'verified';
                                }
                                
                                $canPrint = in_array($calibration->status, ['draft']);
                                
                             $canDownloadExcel = ($role === 'super admin' || ($role === 'checker' && in_array($calibration->status, ['waiting_verification', 'rejected'])));

                                // Cek apakah ada data head untuk insulation
                                $hasInsulationData = false;
                                if ($calibration->headInsulation) {
                                    // Cek insulation_type
                                    $insulationType = $calibration->headInsulation->insulation_type ?? '';
                                    // Jika insulation_type tidak kosong, berarti ada data
                                    if (!empty($insulationType)) {
                                        $hasInsulationData = true;
                                    }
                                }
                                
                                $isSupported = $calibration->headInsideMicrometer || $calibration->headOutsideMicrometer ||
                                               $calibration->headDepthMicrometer || $calibration->headThermometer || $calibration->headDialIndicator ||
                                               $calibration->headDialTestIndicator || $calibration->headThicknessGauge || $calibration->headCaliper || $calibration->headPenggaris 
                                               || $calibration->headTorqueWrench || $calibration->headTorqueMeter || $calibration->headPressureGauge || $calibration->headDifferentialPressureGauge
                                               || $calibration->headVolumetrik || $calibration->headThermohygrometer || $calibration->headViscometer || $calibration->headPushPull || $calibration->headTimbangan 
                                               || $calibration->headTimbanganMoisture || $calibration->headTimbanganBias || $calibration->headHoleTest || $calibration->headConductivityMeter || $calibration->headMikropipetDispenset
                                               || $calibration->headCoatingThickness || $calibration->headTaperGauge || $calibration->headProfilProjector || $calibration->headUltrasonicThicknessGauge || $calibration->headHeightGauge 
                                               || $calibration->headTempHumidTransmitter || $calibration->headIrThermometer || $calibration->headTempTransmitter || $calibration->headViscoCup || $calibration->headPhMeter || $calibration->headEnclosure
                                               || $calibration->headDurometer || $calibration->headCentrifuge || $calibration->headThermoindicator || $calibration->headUtm
                                               || $hasInsulationData || $calibration->headTachometer;  // <- Ganti $calibration->headInsulation dengan $hasInsulationData
                                $showExcelDownload = $canDownloadExcel && empty($calibration->location_data) &&
                                                    in_array($calibration->status, ['draft', 'waiting_verification', 'rejected']) && $isSupported;
                                
                                $showVerifiedDownload = ($role === 'super admin' || ($role === 'approver' && $calibration->status === 'verified')) &&
                                                       $calibration->status === 'verified' && $calibration->location_data;
                                
                                $showRejectedDownload = ($role === 'super admin' || ($role === 'checker' && $calibration->status === 'rejected')) &&
                                                       $calibration->status === 'rejected' && $calibration->location_data;
                                
                                $canDelete = false;
                                if ($role === 'super admin') {
                                    $canDelete = in_array($calibration->status, ['draft', 'waiting_verification']);
                                } elseif ($role === 'teknisi') {
                                    $canDelete = $calibration->status === 'draft';
                                }
                                
                                $canSendSingle = false;
                                if (auth()->user()->role === 'super admin') {
                                    $canSendSingle = $calibration->status === 'draft';
                                } elseif (auth()->user()->role === 'teknisi') {
                                    $canSendSingle = ($calibration->status === 'draft' && $calibration->calibratedBy === auth()->user()->nama);
                                }
                            @endphp
                            
                            <a href="{{ route('calibrations.show', $calibration->id) }}?mode=view"
                               class="action-btn btn-view"
                               title="Lihat Detail"
                               data-bs-toggle="tooltip">
                                <i class="fas fa-eye"></i>
                            </a>

                            @if($canEdit)
                                <a href="{{ route('calibrations.show', $calibration->id) }}?mode=edit"
                                   class="action-btn btn-edit"
                                   title="Edit Data"
                                   data-bs-toggle="tooltip">
                                    <i class="fas fa-pen-to-square"></i>
                                </a>
                            @else
                                <span class="action-btn btn-edit disabled"
                                      title="Tidak dapat diedit"
                                      data-bs-toggle="tooltip">
                                    <i class="fas fa-pen-to-square"></i>
                                </span>
                            @endif

                            @if($canPrint)
                                <a href="{{ route('calibrations.print-label', $calibration->id) }}"
                                   class="action-btn btn-print"
                                   title="Cetak Ulang Label"
                                   data-bs-toggle="tooltip"
                                   target="_blank">
                                    <i class="fas fa-print"></i>
                                </a>
                            @else
                                <span class="action-btn btn-print disabled"
                                      title="Label belum tersedia"
                                      data-bs-toggle="tooltip">
                                    <i class="fas fa-print"></i>
                                </span>
                            @endif
                            
                            @if(in_array(auth()->user()->role, ['teknisi', 'super admin']))
                                @if($canSendSingle)
                                    <form action="{{ route('calibrations.send-to-checker', $calibration->id) }}" method="POST" class="d-inline" id="sendToCheckerForm-{{ $calibration->id }}">
                                        @csrf
                                        <button type="button" class="action-btn bg-success text-white border-0"
                                                title="Kirim ke Checker"
                                                data-bs-toggle="tooltip"
                                                onclick="confirmSendToChecker('{{ $calibration->id }}')">
                                            <i class="fas fa-paper-plane"></i>
                                        </button>
                                    </form>
                                @else
                                    <span class="action-btn bg-secondary text-white disabled opacity-50"
                                          title="Tidak dapat dikirim"
                                          data-bs-toggle="tooltip">
                                        <i class="fas fa-paper-plane"></i>
                                    </span>
                                @endif
                            @endif
                            
                           <a href="{{ route('calibrations.export-pdf', $calibration->id) }}"
                               class="action-btn text-white download-pdf-btn"
                               style="background-color: #00bcd4;"
                               title="Export PDF"
                               data-bs-toggle="tooltip">
                                <i class="fas fa-file-pdf"></i>
                            </a>

                            @if($showExcelDownload)
                                <a href="{{ route('calibrations.download.excel.template', $calibration->id) }}"
                                   class="action-btn btn-download download-excel-btn"
                                   title="Download Template Excel"
                                   data-bs-toggle="tooltip">
                                    <i class="fas fa-file-arrow-down"></i>
                                </a>
                            @endif

                            @if($showVerifiedDownload)
                                <a href="{{ route('calibrations.download.verified', $calibration->id) }}"
                                   class="action-btn btn-approve approval-download-btn"
                                   title="Download Terverifikasi"
                                   data-bs-toggle="tooltip">
                                    <i class="fas fa-file-circle-check"></i>
                                </a>
                            @endif

                            @if($showRejectedDownload)
                                <a href="{{ route('calibrations.download.rejected', $calibration->id) }}"
                                   class="action-btn btn-reject rejected-download-btn"
                                   title="Download Ditolak"
                                   data-bs-toggle="tooltip">
                                    <i class="fas fa-file-circle-xmark"></i>
                                </a>
                            @endif

                            @if($canDelete)
                                <form action="{{ route('calibrations.destroy', $calibration->id) }}" 
                                      method="POST" 
                                      class="d-inline" 
                                      id="delete-form-{{ $calibration->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="action-btn btn-delete border-0"
                                            onclick="confirmDeleteCalibration('{{ $calibration->id }}', '{{ addslashes($calibration->namaAlat) }}')"
                                            title="Hapus Data"
                                            data-bs-toggle="tooltip">
                                        <i class="fas fa-trash-can"></i>
                                    </button>
                                </form>
                            @else
                                <span class="action-btn btn-delete disabled"
                                      title="Tidak dapat dihapus"
                                      data-bs-toggle="tooltip">
                                    <i class="fas fa-trash-can"></i>
                                </span>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="13" class="text-center py-5 text-muted">
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

    @if($calibrations->hasPages())
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4 pt-3 border-top">
        <div class="text-muted small mb-3 mb-sm-0">
            Menampilkan <strong>{{ $calibrations->firstItem() }}</strong> –
            <strong>{{ $calibrations->lastItem() }}</strong> dari
            <strong>{{ $calibrations->total() }}</strong> entri
        </div>
        <nav>
            <ul class="pagination pagination-sm mb-0 cal-pagination">
                {!! $calibrations->onEachSide(1)->appends(request()->query())->links('pagination::bootstrap-5') !!}
            </ul>
        </nav>
    </div>
    @endif
</div>

<div class="modal fade" id="loadingModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0 rounded-3">
            <div class="modal-header bg-white border-bottom py-3">
                <h5 class="modal-title fw-bold text-dark">
                    <span class="cal-modal-icon me-2"><i class="fas fa-file-download text-primary"></i></span>
                    Menyiapkan File Excel
                </h5>
            </div>
            <div class="modal-body text-center py-5">
                <div class="cal-spinner mx-auto mb-4"></div>
                <p class="fw-semibold text-secondary fs-6">File sedang diproses, mohon tunggu...</p>
            </div>
        </div>
    </div>
</div>

<!--<div class="modal fade" id="instructionModal" tabindex="-1" aria-labelledby="instructionModalLabel" aria-hidden="true">-->
<!--    <div class="modal-dialog modal-dialog-centered modal-md">-->
<!--        <div class="modal-content shadow-lg border-0 rounded-3">-->
<!--            <div class="modal-header bg-white border-bottom py-3">-->
<!--                <h5 class="modal-title fw-bold text-dark" id="instructionModalLabel">-->
<!--                    <span class="cal-modal-icon me-2"><i class="fas fa-check-circle text-success"></i></span>-->
<!--                    Download Berhasil!-->
<!--                </h5>-->
<!--                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
<!--            </div>-->
<!--            <div class="modal-body py-4 px-4" style="background:#f8faff">-->
<!--                <div class="text-center mb-4">-->
<!--                    <div class="cal-success-icon mx-auto mb-3">-->
<!--                        <i class="fas fa-file-excel fa-2x text-success"></i>-->
<!--                    </div>-->
<!--                    <h6 class="fw-bold text-dark">File Excel berhasil di-download</h6>-->
<!--                    <p class="text-muted small mb-0">Silakan buka file yang baru saja Anda unduh.</p>-->
<!--                </div>-->
<!--                <div class="border border-2 rounded-3 p-3 bg-white" style="border-color:#fde68a!important">-->
<!--                    <div class="d-flex align-items-center mb-2">-->
<!--                        <i class="fas fa-exclamation-triangle text-warning me-2"></i>-->
<!--                        <h6 class="fw-bold text-dark mb-0 small">Informasi Saat Membuka File</h6>-->
<!--                    </div>-->
<!--                    <p class="text-secondary small mb-2">Excel mungkin menampilkan pesan:</p>-->
<!--                    <div class="bg-light rounded p-2 mb-3 text-center">-->
<!--                        <p class="mb-0 text-secondary fst-italic small">"We found a problem... Do you want us to try to recover?"</p>-->
<!--                    </div>-->
<!--                    <div class="text-center py-2 rounded mb-3" style="background:#dcfce7">-->
<!--                        <p class="fw-semibold text-success small mb-0">Klik tombol &nbsp;<strong class="fs-6">YES</strong></p>-->
<!--                    </div>-->
<!--                    <ul class="list-unstyled mb-0">-->
<!--                        <li class="d-flex align-items-center mb-1">-->
<!--                            <i class="fas fa-check text-success me-2 small"></i>-->
<!--                            <span class="small">Data kalibrasi sudah terisi otomatis</span>-->
<!--                        </li>-->
<!--                        <li class="d-flex align-items-center mb-1">-->
<!--                            <i class="fas fa-check text-success me-2 small"></i>-->
<!--                            <span class="small">Peringatan hanya muncul sekali</span>-->
<!--                        </li>-->
<!--                        <li class="d-flex align-items-center">-->
<!--                            <i class="fas fa-shield-alt text-primary me-2 small"></i>-->
<!--                            <span class="small">File aman dari sistem resmi perusahaan</span>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="modal-footer bg-white border-top justify-content-center py-2">-->
<!--                <button type="button" class="btn btn-success rounded-pill px-5 shadow-sm" onclick="hideInstructionModal()">-->
<!--                    <i class="fas fa-check me-2"></i> Mengerti, Tutup-->
<!--                </button>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

@endsection

@push('styles')
<style>
    /* ============================================================
       THEME: Premium Light Blue-White (Saturated & Beautiful)
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

    /* === Add Button === */
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
        margin-bottom: 1.5rem;
        display: flex; align-items: center;
        gap: 1.25rem; flex-wrap: wrap;
    }
    .cal-label {
        font-weight: 700;
        color: #1e3a8a;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* === Custom Select === */
    .cal-select {
        border: 1.5px solid #2563eb;
        border-radius: 10px;
        padding: 6px 32px 6px 12px;
        font-size: 0.85rem;
        color: #1e3a8a;
        font-weight: 600;
        background-color: #fff;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%232563eb' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 12px;
        appearance: none;
        transition: all .2s;
        cursor: pointer;
        outline: none;
        min-width: 80px;
    }
    .cal-select:focus {
        border-color: #1d4ed8;
        box-shadow: 0 0 0 3px rgba(37,99,235,.18);
    }

    /* === Send all button === */
    .cal-btn-send {
        background: linear-gradient(135deg, #0ea5e9, #2563eb);
        color: #fff !important;
        border: none;
        border-radius: 10px;
        padding: 6px 16px;
        font-size: 0.85rem;
        font-weight: 700;
        display: inline-flex; align-items: center; gap: 8px;
        box-shadow: 0 4px 10px rgba(37,99,235,.15);
        transition: all .25s ease;
        white-space: nowrap;
    }
    .cal-btn-send:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 15px rgba(37,99,235,.28);
    }
    .cal-btn-send i { color: white !important; }

    /* === Table Wrap === */
    .cal-table-wrap {
        border-radius: 12px;
        overflow: hidden; /* Mengunci screen agar tidak tergeser horizontal */
        border: 1px solid #e2e8f0;
        box-shadow: 0 2px 10px rgba(0,0,0,0.02);
        width: 100%;
    }

    #calibrationTable {
        width: 100% !important;
        margin: 0 !important;
    }

    /* === Table Head === */
    .table thead.cal-thead th {
        background-color: #e8f0fe !important;
        background-image: none !important;
        color: #1e3a8a !important;
        font-weight: 800 !important;
        font-size: 0.8rem !important;
        text-transform: uppercase !important;
        letter-spacing: 0.8px !important;
        border: none !important;
        border-bottom: 2px solid #93c5fd !important;
        padding: 14px 16px !important;
        vertical-align: middle;
        white-space: nowrap;
        text-shadow: none !important;
    }

    table.dataTable thead th, 
    table.dataTable thead td,
    #calibrationTable thead th,
    .cal-table-wrap thead th {
        border: none !important;
        border-bottom: 2px solid #93c5fd !important;
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

    /* === Badges === */
    .badge {
        font-weight: 600 !important;
        padding: 0.45em 0.85em !important;
        border-radius: 10px !important;
    }
    .bg-teal { background-color: #0d9488 !important; }

    /* === Action Buttons === */
    .action-btn {
        width: 36px; height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        font-size: 0.95rem;
        transition: all 0.22s cubic-bezier(0.4, 0, 0.2, 1);
        border: none;
        box-shadow: 0 2px 5px rgba(0,0,0,.08);
        color: white;
        text-decoration: none !important;
    }
    .action-btn:hover {
        transform: translateY(-2px) scale(1.05);
        box-shadow: 0 6px 15px rgba(0,0,0,.15);
        color: white !important;
    }
    .action-btn.disabled, .action-btn:disabled,
    .action-btn.disabled:hover, .action-btn[disabled]:hover {
        opacity: 0.3; transform: none;
        box-shadow: none; cursor: not-allowed;
        pointer-events: none;
    }
    .action-btn i { color: white !important; }

    /* Action button colors */
    .btn-view     { background: #3b82f6; }
    .btn-view:hover     { background: #2563eb; }
    .btn-edit     { background: #f59e0b; }
    .btn-edit:hover     { background: #d97706; }
    .btn-print    { background: #8b5cf6; }
    .btn-print:hover    { background: #7c3aed; }
    .btn-download { background: #10b981; }
    .btn-download:hover { background: #059669; }
    .btn-approve  { background: #6366f1; }
    .btn-approve:hover  { background: #4f46e5; }
    .btn-reject   { background: #ef4444; }
    .btn-reject:hover   { background: #dc2626; }
    .btn-delete   { background: #f43f5e; }
    .btn-delete:hover   { background: #e11d48; }

    /* === Modals === */
    .cal-modal-icon {
        display: inline-flex; align-items: center; justify-content: center;
        width: 32px; height: 32px;
        background: #eff6ff; border-radius: 8px;
    }
    .cal-success-icon {
        width: 64px; height: 64px; border-radius: 50%;
        background: #f0fdf4;
        display: flex; align-items: center; justify-content: center;
    }
    .cal-spinner {
        width: 52px; height: 52px;
        border: 4px solid #bfdbfe;
        border-top-color: #1d4ed8;
        border-radius: 50%;
        animation: cal-spin 0.9s linear infinite;
    }
    @keyframes cal-spin {
        to { transform: rotate(360deg); }
    }

    /* === Pagination === */
    .cal-pagination .page-link {
        border: none !important;
        border-radius: 8px !important;
        margin: 0 3px;
        padding: 6px 12px;
        color: #4b5563;
        font-size: 0.85rem;
        transition: all .2s;
    }
    .cal-pagination .page-item.active .page-link {
        background: #2563eb !important;
        color: #fff !important;
        font-weight: 700;
        box-shadow: 0 4px 12px rgba(37,99,235,.35);
    }
    .cal-pagination .page-link:hover {
        background: #dbeafe;
        color: #1d4ed8;
    }

    /* === DataTables Search === */
    .dataTables_filter input {
        border: 1.5px solid #2563eb !important;
        border-radius: 10px !important;
        padding: 6px 12px !important;
        font-size: 0.85rem !important;
        outline: none;
        transition: border-color .2s;
        height: 38px;
    }
    .dataTables_filter input:focus {
        border-color: #1d4ed8 !important;
        box-shadow: 0 0 0 3px rgba(37,99,235,.15) !important;
    }
    .dataTables_filter label { color: #1e3a8a; font-size: 0.85rem; font-weight: 700; margin-bottom: 0; text-transform: uppercase; letter-spacing: 0.5px; }

    /* === Responsive - Layouting Breakpoints === */
    @media (max-width: 991.98px) {
        .cal-hero { padding: 1.5rem 1.5rem; }
        .cal-body { padding: 1rem 1rem; }
        .cal-toolbar { gap: 0.8rem; padding: 0.8rem 1rem; }
        .action-btn { width: 32px; height: 32px; font-size: 0.85rem; border-radius: 8px; }
        .table tbody td { font-size: 0.82rem; padding: 10px 12px; }
        .table thead.cal-thead th { font-size: 0.72rem !important; padding: 10px 12px !important; }
        .cal-btn-add span, .cal-btn-send span { display: none; }
    }

    @media (max-width: 767.98px) {
        .cal-hero { padding: 1.1rem 1.25rem; border-radius: 12px; margin-bottom: 1.25rem; }
        .cal-hero h4 { font-size: 1rem; }
        .cal-hero-icon { width: 40px; height: 40px; font-size: 1.1rem; }
        .cal-btn-add { padding: 0.45rem 1rem; font-size: 0.82rem; }
        .cal-body { padding: 0.8rem 0.8rem; border-radius: 12px; }
        .cal-toolbar { padding: 0.7rem 0.8rem; gap: 0.5rem; }
        .action-group { gap: 0.25rem !important; flex-wrap: wrap !important; }
        .action-btn { width: 30px; height: 30px; font-size: 0.8rem; border-radius: 7px; }
        .table tbody td { font-size: 0.78rem; padding: 8px 8px; }
        .table thead.cal-thead th { font-size: 0.68rem !important; padding: 8px 8px !important; }
        .badge { font-size: 0.65rem !important; padding: 0.25em 0.55em !important; }
        .cert-badge, .status-badge { font-size: 0.7rem !important; padding: 0.25rem 0.5rem !important; }
        .alat-name { font-size: 0.8rem !important; }
    }

    @media (max-width: 575.98px) {
        .cal-hero { padding: 0.8rem 0.8rem; }
        .cal-hero h4 { font-size: 0.85rem; }
        .cal-hero-icon { width: 32px; height: 32px; font-size: 0.85rem; }
        .cal-btn-add { padding: 0.35rem 0.7rem; font-size: 0.75rem; }
        .cal-btn-add i { margin-right: 0 !important; }
        .cal-toolbar { flex-direction: column; align-items: stretch; gap: 0.5rem; }
        .cal-toolbar form, .cal-toolbar > div, .cal-filter-group, .cal-send-all-form, #dtSearchWrapper, .dataTables_filter { width: 100%; }
        .cal-select { width: 100%; box-sizing: border-box; min-width: auto; }
        .cal-btn-send { width: 100%; justify-content: center; font-size: 0.8rem; padding: 8px 12px; }
        .dataTables_filter input { width: 100% !important; }
        .action-btn { width: 28px; height: 28px; font-size: 0.7rem; border-radius: 6px; }
        .action-group { gap: 0.2rem !important; }
        .table tbody td { font-size: 0.7rem; padding: 6px 6px; }
        .table thead.cal-thead th { font-size: 0.6rem !important; padding: 6px 6px !important; letter-spacing: 0.3px !important; }
        .badge { font-size: 0.6rem !important; padding: 0.2em 0.4em !important; border-radius: 8px !important; }
        .cert-badge, .status-badge { font-size: 0.65rem !important; padding: 0.2rem 0.4rem !important; }
        .alat-name { font-size: 0.75rem !important; }
        .pagination .page-link { padding: 4px 8px !important; font-size: 0.75rem !important; }
    }

    /* === STYLING CUSTOM BUTTON EXPAND (EKSPLISIT TERLIHAT) === */
    .btn-expand-trigger {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 24px;
        height: 24px;
        background-color: #eff6ff;
        border: 1.5px solid #3b82f6;
        color: #2563eb;
        border-radius: 6px;
        font-size: 0.8rem;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
    }
    
    /* Sembunyikan kolom expand jika tidak ada kolom yang terpotong (table tidak collapsed) */
    #calibrationTable:not(.collapsed) .cell-expand {
        display: none !important;
    }
    .btn-expand-trigger i {
        color: #2563eb !important;
        transition: transform 0.25s ease;
    }
    .btn-expand-trigger:hover {
        background-color: #2563eb;
        color: white;
    }
    .btn-expand-trigger:hover i {
        color: white !important;
    }

    /* Animasi Perubahan Tombol Saat Row Terbuka (Trigered by DataTables Class .parent) */
    tr.parent .btn-expand-trigger {
        background-color: #fef2f2;
        border-color: #f87171;
    }
    tr.parent .btn-expand-trigger i {
        color: #ef4444 !important;
        transform: rotate(45deg); /* Mengubah ikon tambah (+) menjadi silang (x) tutup */
    }

    /* NONAKTIFKAN PSEUDO ELEMENT BAWAAN DATATABLES BIAR TIDAK DOBEL */
    table.dataTable.dtr-inline.collapsed > tbody > tr > td.dtr-control::before,
    table.dataTable.dtr-inline.collapsed > tbody > tr > th.dtr-control::before {
        display: none !important;
    }
    table.dataTable.dtr-inline.collapsed > tbody > tr > td.dtr-control,
    table.dataTable.dtr-inline.collapsed > tbody > tr > th.dtr-control {
        padding-left: 12px !important;
    }
    
    /* Child row detail styling (Hasil expand ke bawah) */
    table.dataTable > tbody > tr.child {
        background: #f8faff !important;
    }
    table.dataTable > tbody > tr.child ul.dtr-details {
        display: block;
        list-style-type: none;
        margin: 0 !important;
        padding: 4px 12px !important;
        width: 100%;
    }
    table.dataTable > tbody > tr.child ul.dtr-details li {
        border-bottom: 1px solid #e2e8f0 !important;
        padding: 8px 0 !important;
        font-size: 0.85rem !important;
        color: #374151 !important;
        display: flex;
        justify-content: flex-start;
        align-items: center;
    }
    table.dataTable > tbody > tr.child ul.dtr-details li:last-child {
        border-bottom: none !important;
    }
    table.dataTable > tbody > tr.child ul.dtr-details li span.dtr-title {
        font-weight: 700 !important;
        color: #1e3a8a !important;
        min-width: 140px !important;
        display: inline-block;
    }
    table.dataTable > tbody > tr.child ul.dtr-details li span.dtr-data {
        display: inline-block;
    }

    /* Sembunyikan search jika no data */
    .dataTables_empty + #dtSearchWrapper,
    #calibrationTable tbody tr td[colspan] + #dtSearchWrapper { display: none; }
</style>
@endpush

@push('scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.bootstrap5.min.css">

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.bootstrap5.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// ============================================================
// FUNGSI DOWNLOAD DENGAN SWEETALERT + ANIMASI LOADING
// ============================================================
function downloadWithSweetAlert(button, isApproval = false, isRejected = false) {
    let fileType = 'Template Excel';
    let successMessage = 'Template Excel berhasil di-download!';
    let fileName = 'Template_Kalibrasi.xlsx';
    
    if (isApproval) {
        fileType = 'File Terverifikasi';
        successMessage = 'File terverifikasi berhasil di-download!';
        fileName = 'Data_Terverifikasi.xlsx';
    } else if (isRejected) {
        fileType = 'File Ditolak';
        successMessage = 'File ditolak berhasil di-download!';
        fileName = 'Data_Ditolak.xlsx';
    }
    
    // Tampilkan SweetAlert Loading dengan animasi
    Swal.fire({
        title: 'Menyiapkan File...',
        html: `
            <div style="margin: 10px 0;">
                <div class="swal2-loader" style="display:flex;margin:20px auto;border:4px solid #bfdbfe;border-top-color:#2563eb;border-radius:50%;width:56px;height:56px;animation:swal2-rotate-loading 1.5s linear infinite;"></div>
                <p style="margin-top:15px;color:#475569;font-weight:500;animation:pulse-text 1.5s ease-in-out infinite;">
                    <i class="fas fa-file-excel" style="color:#217346;margin-right:8px;"></i>
                    Sedang memproses ${fileType}...
                </p>
                <p style="color:#94a3b8;font-size:0.8rem;margin-top:5px;">
                    Mohon tunggu, file sedang disiapkan
                </p>
            </div>
        `,
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false,
        didOpen: () => {
            // Tambahkan style animasi pulse jika belum ada
            if (!document.getElementById('pulse-style')) {
                const style = document.createElement('style');
                style.id = 'pulse-style';
                style.textContent = `
                    @keyframes pulse-text {
                        0%, 100% { opacity: 1; }
                        50% { opacity: 0.5; }
                    }
                    @keyframes swal2-rotate-loading {
                        0% { transform: rotate(0deg); }
                        100% { transform: rotate(360deg); }
                    }
                `;
                document.head.appendChild(style);
            }
        }
    });
    
    // Lakukan proses download setelah delay 2 detik
    setTimeout(() => {
        try {
            // Buat link download
            const link = document.createElement('a');
            link.href = button.href;
            link.download = '';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            
            // Tutup loading
            Swal.close();
            
            // Tampilkan notifikasi sukses dengan informasi
            Swal.fire({
                title: 'Berhasil!',
                html: `
                    <div style="text-align:center;">
                        <div style="font-size:3rem;margin-bottom:10px;color:#10b981;">
                           
                        </div>
                        <p style="font-weight:600;color:#1e293b;font-size:1.1rem;margin-bottom:5px;">
                            ${successMessage}
                        </p>
                        <p style="color:#64748b;font-size:0.9rem;margin-bottom:15px;">
                            <i class="fas fa-file-excel" style="color:#217346;"></i>
                            ${fileName}
                        </p>
                        
                        <div style="background:#fef3c7;border-left:4px solid #f59e0b;padding:12px 16px;border-radius:8px;margin:10px 0 5px 0;text-align:left;">
                            <div style="font-weight:600;color:#92400e;font-size:0.9rem;">
                                <i class="fas fa-info-circle" style="color:#f59e0b;margin-right:8px;"></i>
                                Informasi Penting Saat Membuka File
                            </div>
                            <div style="color:#78350f;font-size:0.85rem;margin-top:4px;">
                                <p style="margin:8px 0 6px 0;">
                                    Jika muncul pesan:
                                    <br>
                                    <span style="background:#f1f5f9;padding:4px 10px;border-radius:4px;display:inline-block;margin:6px 0;font-style:italic;font-size:0.85rem;color:#334155;">
                                        "We found a problem with some content in <strong>${fileName}</strong>. Do you want us to try to recover as much as we can?"
                                    </span>
                                </p>
                                <p style="margin:6px 0 0 0;font-weight:500;">
                                    <i class="fas fa-arrow-right" style="color:#10b981;"></i>
                                    Klik tombol 
                                    <span style="display:inline-block;background:#10b981;color:white;padding:2px 14px;border-radius:4px;font-weight:700;font-size:0.85rem;margin:0 4px;">YES</span>
                                    untuk melanjutkan
                                </p>
                                <p style="margin:6px 0 0 0;font-size:0.8rem;color:#78716c;">
                                    <i class="fas fa-shield-alt"></i>
                                    File aman, ini adalah notifikasi normal dari Excel
                                </p>
                            </div>
                        </div>
                        
                        <div style="margin-top:12px;display:flex;gap:8px;justify-content:center;flex-wrap:wrap;">
                            <span style="background:#dcfce7;color:#166534;padding:4px 12px;border-radius:20px;font-size:0.75rem;">
                                <i class="fas fa-check"></i> Data sudah terisi otomatis
                            </span>
                            <span style="background:#dbeafe;color:#1e40af;padding:4px 12px;border-radius:20px;font-size:0.75rem;">
                                <i class="fas fa-shield"></i> Dari sistem resmi
                            </span>
                        </div>
                    </div>
                `,
                icon: 'success',
                confirmButtonText: 'Mengerti, Tutup',
                confirmButtonColor: '#2563eb',
                timer: 10000,
                timerProgressBar: true,
                customClass: {
                    confirmButton: 'btn btn-primary px-5 py-2 rounded-pill'
                }
            });
            
        } catch (error) {
            Swal.close();
            Swal.fire({
                title: 'Gagal!',
                text: 'Terjadi kesalahan saat mendownload file. Silakan coba lagi.',
                icon: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: '#dc3545'
            });
        }
    }, 2000);
}

// ============================================================
// FUNGSI CONFIRM SEND TO CHECKER
// ============================================================
function confirmSendToChecker(calibrationId) {
    Swal.fire({
        title: 'Kirim Data ?',
        text: 'Data kalibrasi ini akan dikirim ke checker untuk diverifikasi',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#198754',
        cancelButtonColor: '#dc3545',
        confirmButtonText: 'Ya, Kirim',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('sendToCheckerForm-' + calibrationId).submit();
        }
    });
}

// ============================================================
// FUNGSI CONFIRM DELETE
// ============================================================
function confirmDeleteCalibration(id, nama) {
    Swal.fire({
        title: 'Hapus Data?',
        html: `Apakah Anda yakin ingin menghapus data kalibrasi <strong>"${nama}"</strong>?<br><small class="text-muted">Data yang dihapus tidak dapat dikembalikan.</small>`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}


function downloadPdfWithSweetAlert(button) {
    let successMessage = 'File PDF berhasil di-download!';
    
    // Tampilkan SweetAlert Loading dengan animasi
    Swal.fire({
        title: 'Menyiapkan PDF...',
        html: `
            <div style="margin: 10px 0;">
                <div class="swal2-loader" style="display:flex;margin:20px auto;border:4px solid #fecaca;border-top-color:#dc2626;border-radius:50%;width:56px;height:56px;animation:swal2-rotate-loading 1.5s linear infinite;"></div>
                <p style="margin-top:15px;color:#475569;font-weight:500;animation:pulse-text 1.5s ease-in-out infinite;">
                    <i class="fas fa-file-pdf" style="color:#dc2626;margin-right:8px;"></i>
                    Sedang memproses PDF...
                </p>
                <p style="color:#94a3b8;font-size:0.8rem;margin-top:5px;">
                    Mohon tunggu, file sedang dibuat
                </p>
            </div>
        `,
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false,
        didOpen: () => {
            if (!document.getElementById('pulse-style')) {
                const style = document.createElement('style');
                style.id = 'pulse-style';
                style.textContent = `
                    @keyframes pulse-text {
                        0%, 100% { opacity: 1; }
                        50% { opacity: 0.5; }
                    }
                    @keyframes swal2-rotate-loading {
                        0% { transform: rotate(0deg); }
                        100% { transform: rotate(360deg); }
                    }
                `;
                document.head.appendChild(style);
            }
        }
    });
    
    // Lakukan proses download setelah delay singkat
    setTimeout(() => {
        try {
            // Buat link download
            const link = document.createElement('a');
            link.href = button.href;
            link.download = '';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            
            // Tutup loading
            Swal.close();
            
            // Tampilkan notifikasi sukses dengan informasi
            Swal.fire({
                title: 'Berhasil!',
                html: `
                    <div style="text-align:center;">
                        <p style="font-weight:600;color:#1e293b;font-size:1.1rem;margin-bottom:5px;">
                            ${successMessage}
                        </p>
                        <p style="color:#64748b;font-size:0.9rem;margin-bottom:15px;">
                            <i class="fas fa-file-pdf" style="color:#dc2626;"></i>
                            Cek folder download Anda
                        </p>
                    </div>
                `,
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Tutup'
            });
        } catch (error) {
            Swal.fire('Error!', 'Terjadi kesalahan saat mendownload file.', 'error');
        }
    }, 2000);
}

// ============================================================
// DOMContentLoaded - INISIALISASI SEMUA
// ============================================================
document.addEventListener('DOMContentLoaded', function () {
    // --- EVENT LISTENER UNTUK TOMBOL DOWNLOAD DENGAN SWEETALERT ---
    document.querySelectorAll('.download-pdf-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            downloadPdfWithSweetAlert(this);
        });
    });

    // --- EVENT LISTENER UNTUK TOMBOL DOWNLOAD DENGAN SWEETALERT ---
    document.querySelectorAll('.download-excel-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            downloadWithSweetAlert(this, false, false);
        });
    });
    
    document.querySelectorAll('.approval-download-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            downloadWithSweetAlert(this, true, false);
        });
    });
    
    document.querySelectorAll('.rejected-download-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            downloadWithSweetAlert(this, false, true);
        });
    });

    // --- TOOLTIP ---
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => new bootstrap.Tooltip(el));

    // --- AUTO CLOSE ALERT ---
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => {
            if (typeof bootstrap.Alert.getOrCreateInstance === 'function') {
                bootstrap.Alert.getOrCreateInstance(alert).close();
            } else {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }
        });
    }, 5000);
    
    // --- PERPAGE SAVE TO LOCALSTORAGE ---
    const perPageSelect = document.getElementById('perPage');
    if (perPageSelect) {
        perPageSelect.addEventListener('change', function () {
            localStorage.setItem('calibrations_perPage', this.value);
        });
        const saved = localStorage.getItem('calibrations_perPage');
        if (saved) perPageSelect.value = saved;
    }
});

// ============================================================
// INISIALISASI DATATABLES
// ============================================================
$(document).ready(function () {
    if ($('#calibrationTable tbody tr').length > 1 || 
        ($('#calibrationTable tbody tr').length === 1 && 
         !$('#calibrationTable tbody tr td[colspan]').length)) {
        
        $('#calibrationTable').DataTable({
            paging: false,
            lengthChange: false,
            searching: true,
            ordering: true,
            info: false,
            autoWidth: false,
            responsive: {
                details: {
                    type: 'column',
                    target: 'td.cell-expand'
                }
            },
            columnDefs: [
                { orderable: false, targets: [0, 12] },
                { responsivePriority: 1, targets: 0 },
                { responsivePriority: 1, targets: 1 },
                { responsivePriority: 1, targets: 4 },
                { responsivePriority: 1, targets: 10 },
                { responsivePriority: 1, targets: 12 },
                { responsivePriority: 2, targets: 11 },
                { responsivePriority: 3, targets: [2, 3, 5] },
                { responsivePriority: 4, targets: 8 },
                { responsivePriority: 4, targets: [6, 7, 9] }
            ],
            language: {
                search: "Cari: ",
                zeroRecords: "Tidak ditemukan data yang sesuai",
                emptyTable: "Belum ada data untuk ditampilkan",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 entri",
                infoFiltered: "(difilter dari _MAX_ total entri)"
            },
            createdRow: function(row, data, index) {
                $(row).addClass('responsive-row');
            }
        });

        $('.dataTables_filter').appendTo('#dtSearchWrapper');
        $('.dataTables_filter label').addClass('d-flex align-items-center mb-0');
        $('.dataTables_filter input').addClass('form-control form-control-sm ms-2').css('width', '100%');
    } else {
        $('#dtSearchWrapper').hide();
    }
});
</script>
@endpush