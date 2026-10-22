<?php

namespace App\Services;

use App\Models\Compass\CompassInlabCalibration;
use App\Models\ScheduleCalibration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CalibrationSyncService
{
    /**
     * Sync planned calibrations dari Compass ke Paperless
     */
    public function syncPlannedCalibrations()
    {
        $synced = 0;
        $errors = [];

        try {
            $compassCalibrations = CompassInlabCalibration::planned()
                ->withFullDetails()
                ->get();

            foreach ($compassCalibrations as $compass) {
                try {
                    $this->upsertCalibration($compass);
                    $synced++;
                } catch (\Exception $e) {
                    $errors[] = [
                        'compass_id' => $compass->id,
                        'error' => $e->getMessage()
                    ];
                    Log::error("Failed to sync calibration {$compass->id}: {$e->getMessage()}");
                }
            }

            return ['synced' => $synced, 'errors' => $errors];

        } catch (\Exception $e) {
            Log::error("Calibration sync failed: {$e->getMessage()}");
            throw $e;
        }
    }

    /**
     * Upsert single calibration record
     */
    protected function upsertCalibration(CompassInlabCalibration $compass)
    {
        $data = [
            'compass_inlab_id' => $compass->id,
            'calibration_type' => 'inlab',
            'status' => $compass->status,
            'calibration_at' => $compass->calibration_at,
            'calibrated_at' => $compass->calibrated_at,
            'registered_at' => $compass->registered_at,
            'pickup_at' => $compass->pickup_at,
            'certificate_no' => $compass->certificate_no,
            'worksheet_no' => $compass->worksheet_no,

            // Customer info
            'customer_id' => $compass->customer_id,
            'customer_name' => $compass->customer->name ?? null,
            'customer_address' => $compass->customer->address ?? null,
            'customer_phone' => $compass->customer->phone ?? null,
            'customer_code' => $compass->customer->code ?? null,
            'area_name' => $compass->customer->area->name ?? null,

            // Sales order info
            'sales_order_id' => $compass->sales_order_id,
            'sales_order_no' => $compass->salesOrder->external_no ?? null,
            'sales_order_date' => $compass->salesOrder->issued_at ?? null,

            // Instrument info
            'sales_order_item_id' => $compass->sales_order_item_id,
            'instrument_name' => $compass->salesOrderItem->name ?? null,
            'instrument_description' => $compass->salesOrderItem->description ?? null,
            'instrument_unit' => $compass->salesOrderItem->unit ?? null,

            // Technician info
            'technician_id' => $compass->calibration_by_id,
            'technician_name' => $compass->calibrationBy->employee->name ?? null,
            'technician_phone' => $compass->calibrationBy->employee->phone_number ?? null,

            // Marketing info
            'marketing_name' => $compass->salesOrder->marketingBy->employee->name ?? null,

            'synced_at' => now(),
        ];

        ScheduleCalibration::updateOrCreate(
            ['compass_inlab_id' => $compass->id],
            $data
        );
    }
}
