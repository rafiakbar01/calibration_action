<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduleCalibration extends Model
{
    protected $table = 'schedule_calibrations';

    protected $fillable = [
        'compass_inlab_id',
        'calibration_type',
        'status',
        'calibration_at',
        'calibrated_at',
        'registered_at',
        'pickup_at',
        'certificate_no',
        'worksheet_no',
        'customer_id',
        'customer_name',
        'customer_address',
        'customer_phone',
        'customer_code',
        'area_name',
        'sales_order_id',
        'sales_order_no',
        'sales_order_date',
        'sales_order_item_id',
        'instrument_name',
        'instrument_description',
        'instrument_unit',
        'technician_id',
        'technician_name',
        'technician_phone',
        'marketing_name',
        'synced_at',
    ];

    protected $casts = [
        'calibration_at' => 'datetime',
        'calibrated_at' => 'datetime',
        'registered_at' => 'datetime',
        'pickup_at' => 'datetime',
        'sales_order_date' => 'date',
        'synced_at' => 'datetime',
    ];

    // Scope: planned only
    public function scopePlanned($query)
    {
        return $query->where('status', 'planned');
    }

    // Scope: today's schedule
    public function scopeToday($query)
    {
        return $query->whereDate('calibration_at', today());
    }

    // Scope: inlab only
    public function scopeInlab($query)
    {
        return $query->where('calibration_type', 'inlab');
    }

    // Scope: onsite only
    public function scopeOnsite($query)
    {
        return $query->where('calibration_type', 'onsite');
    }
}
