<?php

namespace App\Services;

use App\Models\ScheduleCalibration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CalibrationUpdateService
{
    /**
     * Mark calibration as calibrated di Compass DB
     */
    public function markAsCalibrated(int $scheduleCalibrationId, $calibratedAt = null)
    {
        $schedule = ScheduleCalibration::findOrFail($scheduleCalibrationId);

        if ($schedule->status !== 'planned') {
            throw new \Exception("Calibration harus status 'planned'. Saat ini: {$schedule->status}");
        }

        $calibratedAt = $calibratedAt ?? now();

        try {
            // Direct UPDATE ke Compass PostgreSQL
            DB::connection('compass_postgres')
                ->table('inlab_calibrations')
                ->where('id', $schedule->compass_inlab_id)
                ->where('status', 'planned')
                ->update([
                    'status' => 'calibrated',
                    'calibrated_at' => $calibratedAt,
                    'updated_at' => now(),
                ]);

            // Update local Paperless record
            $schedule->update([
                'status' => 'calibrated',
                'calibrated_at' => $calibratedAt,
            ]);

            Log::info("Calibration {$schedule->compass_inlab_id} marked as calibrated");

            return true;

        } catch (\Exception $e) {
            Log::error("Failed to update calibration {$schedule->compass_inlab_id}: {$e->getMessage()}");
            throw $e;
        }
    }
}
