<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calibration;
use App\Models\User;
use App\Models\ActivityLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardControlController extends Controller
{
   public function index(Request $request)
{
    // CEK ROLE - SUPER ADMIN & TEKNISI / PPIC
    if (!canAccessDashboardControl()) {
        abort(403, 'Anda Tidak Mempunyai Akses Ke Halaman Ini');
    }

    // Date range - dengan opsi ALL DATE
    $startDateInput = $request->input('start_date');
    $endDateInput = $request->input('end_date');
    $dateFilter = $request->input('date_filter', 'range');

    // Base query untuk calibrations
    $query = Calibration::query();

    // Filter tanggal
    if ($dateFilter === 'all') {
        $startDate = null;
        $endDate = null;
    } else {
        if (!$startDateInput) {
            $startDate = Carbon::now()->subDays(30)->format('Y-m-d');
        } else {
            $startDate = Carbon::parse($startDateInput)->format('Y-m-d');
        }

        if (!$endDateInput) {
            $endDate = Carbon::now()->format('Y-m-d');
        } else {
            $endDate = Carbon::parse($endDateInput)->format('Y-m-d');
        }

        $query->whereDate('created_at', '>=', $startDate)
              ->whereDate('created_at', '<=', $endDate);
    }

    // Get total count inside the range
    $totalCalibrations = (clone $query)->count();

    // Count per status category
    $draftCount = (clone $query)->where('status', 'draft')->count();
    $waitingVerificationCount = (clone $query)->where('status', 'waiting_verification')->count();
    $waitingApproveCount = (clone $query)->whereIn('status', ['verified', 'waiting_approval'])->count();
    $approveCount = (clone $query)->whereIn('status', ['approved', 'completed'])->count();
    $rejectCount = (clone $query)->where('status', 'rejected')->count();

    // Percentages calculation
    $draftPercent = $totalCalibrations > 0 ? round(($draftCount / $totalCalibrations) * 100, 1) : 0;
    $waitingVerificationPercent = $totalCalibrations > 0 ? round(($waitingVerificationCount / $totalCalibrations) * 100, 1) : 0;
    $waitingApprovePercent = $totalCalibrations > 0 ? round(($waitingApproveCount / $totalCalibrations) * 100, 1) : 0;
    $approvePercent = $totalCalibrations > 0 ? round(($approveCount / $totalCalibrations) * 100, 1) : 0;
    $rejectPercent = $totalCalibrations > 0 ? round(($rejectCount / $totalCalibrations) * 100, 1) : 0;

    // Get all calibration records inside range for list details
    $calibrations = (clone $query)->orderBy('created_at', 'desc')->get();

    // Get all technicians
    $technicians = User::where('role', 'teknisi')->get();

    // ========================================
    // TOTAL FORM TYPE - HARDCODE
    // ========================================
    $totalFormTypes = 54;

    // ========================================
    // PRODUKTIVITAS PER TEKNISI
    // ========================================
    $technicianProductivity = [];

    foreach ($technicians as $tech) {
        $jenisQuery = (clone $query)->where('calibratedBy', $tech->nama);
        $tJenis = $jenisQuery->distinct('form_type')->count('form_type');
        
        $alatQuery = (clone $query)->where('calibratedBy', $tech->nama);
        $tAlat = $alatQuery->count();

        $technicianProductivity[] = (object)[
            'nik' => $tech->nik,
            'nama' => $tech->nama,
            'jenis' => $tJenis,
            'alat' => $tAlat
        ];
    }

    // Total semua alat
    $totalAllAlat = (clone $query)->count();

    // ========================================
    // DISTRIBUSI JENIS ALAT - GROUP BY form_type
    // ========================================
    $labels = [
        'inside_micrometer' => 'Inside Micrometer',
        'outside_micrometer' => 'Outside Micrometer',
        'depth_micrometer' => 'Depth Micrometer',
        'thermometer' => 'Thermometer',
        'dial_indicator' => 'Dial Indicator',
        'dial_test_indicator' => 'Dial Test Indicator',
        'depth_caliper' => 'Depth Caliper',
        'caliper' => 'Caliper',
        'torque_wrench' => 'Torque Wrench-Driver',
        'torque_meter' => 'Torque Tester-Meter',
        'thickness_gauge' => 'Thickness Gauge',
        'penggaris' => 'Penggaris',
        'enclosure' => 'Enclosure',
        'chamber' => 'Chamber',
        'pressure_gauge' => 'Pressure Gauge',
        'differential_pressure_gauge' => 'Differential Pressure Gauge',
        'volumetrik' => 'Volumetrik',
        'thermohygrometer' => 'Thermohygrometer',
        'viscometer' => 'Viscometer',
        'push_pull' => 'Push Pull',
        'timbangan' => 'Timbangan',
        'timbangan_bias' => 'Timbangan Bias',
        'gauge_block' => 'Gauge Block',
        'holetest' => 'Holetest',
        'conductivity_meter' => 'Conductivity Meter',
        'coating_thickness' => 'Coating Thickness',
        'mikropipet_dispenset' => 'Mikropipet Dispenset',
        'temp_humid_transmitter' => 'Temperature Humidity Transmitter',
        'insulation' => 'Insulation',
        'centrifuge' => 'Centrifuge',
        'plastic_shim' => 'Plastic Shim',
        'durometer' => 'Durometer',
        'plain_limit_gauge' => 'Plain Limit Gauge',
        'surface_roughness_tester' => 'Surface Roughness Tester',
        'feeler_gauge' => 'Feeler Gauge',
        'stopwatch' => 'Stopwatch',
        'thermometer_infrared' => 'Thermometer Infrared',
        'tachometer' => 'Tachometer',
        'surface_plate' => 'Surface Plate',
        'visco_cup' => 'Visco Cup',
        'taper_gauge' => 'Taper Gauge',
        'bore_gauge' => 'Bore Gauge',
        'ph_meter' => 'PH Meter',
        'pin_gauge' => 'Pin Gauge',
        'profil_projector' => 'Profil Projector / Microscope',
        'thread_gauge' => 'Thread Gauge',
        'pressure_transmitter' => 'Pressure Transmitter / Diff Pressure Transmitter',
        'ultrasonic_thickness_gauge' => 'Ultrasonic Thickness Gauge',
        'temperature_transmitter' => 'Temperature Transmitter',
        'thermoindicator' => 'Thermoindicator',
        'anak_timbang' => 'Anak Timbang',
        'utm' => 'Mesin Uji Tarik & Tekan',
        'abration_tester' => 'Abration Tester',
        'height_gauge' => 'Height Gauge'
    ];

    // Ambil data berdasarkan form_type dari tabel calibrations
    $instruments = (clone $query)
        ->select('form_type', DB::raw('count(*) as count'))
        ->whereNotNull('form_type')
        ->where('form_type', '!=', '')
        ->groupBy('form_type')
        ->orderBy('count', 'desc')
        ->get();

    $totalInstrumentsCount = $instruments->sum('count');

    // ========================================
    // HITUNG RATA-RATA WAKTU DARI ACTIVITY LOGS
    // ========================================
    $activities = ActivityLog::whereIn('activity_type', ['select_form', 'save_calibration', 'create'])
        ->whereNotNull('batch_uuid')
        ->whereNotNull('metadata')
        ->orderBy('created_at', 'asc')
        ->get();

    $groupedByBatch = [];
    foreach ($activities as $activity) {
        $batchUuid = $activity->batch_uuid;
        if (!isset($groupedByBatch[$batchUuid])) {
            $groupedByBatch[$batchUuid] = [
                'select_form' => null,
                'create' => null,
                'save_calibration' => null
            ];
        }
        
        if ($activity->activity_type === 'select_form') {
            $groupedByBatch[$batchUuid]['select_form'] = $activity;
        } elseif ($activity->activity_type === 'create') {
            $groupedByBatch[$batchUuid]['create'] = $activity;
        } elseif ($activity->activity_type === 'save_calibration') {
            $groupedByBatch[$batchUuid]['save_calibration'] = $activity;
        }
    }

    $timeDiffs = [];
    foreach ($groupedByBatch as $batchUuid => $logs) {
        $selectForm = $logs['select_form'];
        $create = $logs['create'] ?? $logs['save_calibration'];
        
        if ($selectForm && $create) {
            $startTime = Carbon::parse($selectForm->created_at);
            $endTime = Carbon::parse($create->created_at);
            $diffInSeconds = $startTime->diffInSeconds($endTime);
            
            $metadata = $selectForm->metadata;
            if (is_string($metadata)) {
                $metadata = json_decode($metadata, true);
            }
            $formType = $metadata['form_type'] ?? null;
            
            if ($formType) {
                if (!isset($timeDiffs[$formType])) {
                    $timeDiffs[$formType] = [];
                }
                $timeDiffs[$formType][] = $diffInSeconds;
            }
        }
    }

    $averageTimes = [];
    foreach ($timeDiffs as $formType => $diffs) {
        $average = array_sum($diffs) / count($diffs);
        $averageTimes[$formType] = $average;
    }

    $instrumentsData = $instruments->map(function ($item) use ($labels, $totalInstrumentsCount, $averageTimes) {
        $item->namaAlat = $labels[$item->form_type] ?? $item->form_type;
        $item->percentage = $totalInstrumentsCount > 0 ? round(($item->count / $totalInstrumentsCount) * 100, 1) : 0;
        
        $avgTime = $averageTimes[$item->form_type] ?? null;
        if ($avgTime !== null) {
            $minutes = floor($avgTime / 60);
            $seconds = $avgTime % 60;
            $item->avg_time = sprintf('%02d:%02d', $minutes, $seconds);
            $item->avg_time_seconds = $avgTime;
        } else {
            $item->avg_time = '-';
            $item->avg_time_seconds = null;
        }
        
        return $item;
    });

    // Location status: Inlab vs Onsite
    $onsiteCount = (clone $query)
        ->where(function($q) {
            $q->where('tempatKalibrasi', 'insitu')
              ->orWhere('tempatKalibrasi', 'onsite')
              ->orWhere('tempatKalibrasi', 'like', '%insitu%')
              ->orWhere('tempatKalibrasi', 'like', '%onsite%');
        })->count();

    $inlabCount = (clone $query)
        ->where(function($q) {
            $q->where('tempatKalibrasi', 'lab.PT PAS')
              ->orWhere('tempatKalibrasi', 'inlab')
              ->orWhere('tempatKalibrasi', 'like', '%lab%');
        })->count();

    $totalLocations = $onsiteCount + $inlabCount;
    $onsitePercent = $totalLocations > 0 ? round(($onsiteCount / $totalLocations) * 100, 1) : 0;
    $inlabPercent = $totalLocations > 0 ? round(($inlabCount / $totalLocations) * 100, 1) : 0;
    
    // Ambil data berita acara dicocokkan berdasarkan calibration_id
    $beritaAcaraList = DB::table('berita_acara')->get()->keyBy('calibration_id');

    return view('dashboard-control', compact(
        'startDate', 'endDate',
        'dateFilter',
        'startDateInput', 'endDateInput',
        'totalCalibrations',
        'draftCount', 'waitingVerificationCount', 'waitingApproveCount', 'approveCount', 'rejectCount',
        'draftPercent', 'waitingVerificationPercent', 'waitingApprovePercent', 'approvePercent', 'rejectPercent',
        'calibrations',
        'technicians',
        'technicianProductivity',
        'totalFormTypes',
        'totalAllAlat',
        'instrumentsData',
        'onsiteCount', 'inlabCount',
        'onsitePercent', 'inlabPercent',
        'beritaAcaraList' // <--- PASTIKAN INI IKUT DI-COMPACT
    ));
}

    public function getTechnicianChartData(Request $request)
    {
          // CEK ROLE - SUPER ADMIN & TEKNISI PAS-069
        if (!canAccessDashboardControl()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }


        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $technicianName = $request->input('technician');
        $dateFilter = $request->input('date_filter', 'range');

        $query = DB::table('calibrations');

        // Filter tanggal
        if ($dateFilter === 'all') {
            // Semua tanggal - tidak ada filter
        } else {
            if ($startDate && $endDate) {
                $query->whereDate('created_at', '>=', $startDate)
                      ->whereDate('created_at', '<=', $endDate);
            }
        }

        if ($technicianName && $technicianName !== 'all') {
            $query->where('calibratedBy', $technicianName);
        }

        // JENIS = total distinct form_type
        $totalJenis = $query->distinct('form_type')->count('form_type');
        
        // ALAT = total semua record
        $totalAlat = $query->count();

        return response()->json([
            'jenis' => $totalJenis,
            'alat' => $totalAlat
        ]);
    }
}