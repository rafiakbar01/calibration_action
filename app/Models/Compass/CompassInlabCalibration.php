<?php

namespace App\Models\Compass;

use Illuminate\Database\Eloquent\Model;

class CompassInlabCalibration extends Model
{
    protected $connection = 'compass_postgres';
    protected $table = 'inlab_calibrations';
    public $timestamps = false;

    protected $casts = [
        'calibration_at' => 'datetime',
        'calibrated_at' => 'datetime',
        'registered_at' => 'datetime',
        'pickup_at' => 'datetime',
        'delivery_at' => 'datetime',
        'certificate_send_at' => 'datetime',
        'completed_at' => 'datetime',
        'rejected_at' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(CompassCustomer::class, 'customer_id');
    }

    public function salesOrder()
    {
        return $this->belongsTo(CompassSalesOrder::class, 'sales_order_id');
    }

    public function salesOrderItem()
    {
        return $this->belongsTo(CompassSalesOrderItem::class, 'sales_order_item_id');
    }

    public function calibrationBy()
    {
        return $this->belongsTo(CompassOfficer::class, 'calibration_by_id');
    }

    public function scopePlanned($query)
    {
        return $query->where('status', 'planned');
    }

    public function scopeWithFullDetails($query)
    {
        return $query->with([
            'customer.area',
            'salesOrder.marketingBy.employee',
            'salesOrderItem',
            'calibrationBy.employee'
        ]);
    }
}
