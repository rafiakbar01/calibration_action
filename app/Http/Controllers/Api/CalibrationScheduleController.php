<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ScheduleCalibration;
use App\Services\CalibrationSyncService;
use App\Services\CalibrationUpdateService;
use Illuminate\Http\Request;

class CalibrationScheduleController extends Controller
{
    protected $syncService;
    protected $updateService;

    public function __construct(
        CalibrationSyncService $syncService,
        CalibrationUpdateService $updateService
    ) {
        $this->syncService = $syncService;
        $this->updateService = $updateService;
    }

    /**
     * Sync planned calibrations dari Compass
     * POST /api/calibrations/sync
     */
    public function sync()
    {
        try {
            $result = $this->syncService->syncPlannedCalibrations();

            return response()->json([
                'success' => true,
                'message' => "Synced {$result['synced']} calibrations",
                'synced' => $result['synced'],
                'errors' => $result['errors'],
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Sync failed: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get scheduled calibrations (planned status only)
     * GET /api/calibrations/scheduled
     */
    public function scheduled(Request $request)
    {
        $query = ScheduleCalibration::planned()
            ->orderBy('calibration_at', 'asc');

        // Optional filters
        if ($request->has('date')) {
            $query->whereDate('calibration_at', $request->date);
        }

        if ($request->has('technician_id')) {
            $query->where('technician_id', $request->technician_id);
        }

        if ($request->has('technician_name')) {
            $query->where('technician_name', 'like', '%' . $request->technician_name . '%');
        }

        $calibrations = $query->get();

        return response()->json([
            'success' => true,
            'count' => $calibrations->count(),
            'data' => $calibrations,
        ]);
    }

    /**
     * Mark calibration as completed
     * POST /api/calibrations/{id}/complete
     */
    public function complete(Request $request, $id)
    {
        $request->validate([
            'calibrated_at' => 'nullable|date',
        ]);

        try {
            $calibratedAt = $request->calibrated_at
                ? new \DateTime($request->calibrated_at)
                : now();

            $this->updateService->markAsCalibrated($id, $calibratedAt);

            return response()->json([
                'success' => true,
                'message' => 'Calibration marked as completed',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }
}
