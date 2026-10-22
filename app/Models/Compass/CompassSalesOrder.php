<?php

namespace App\Models\Compass;

use Illuminate\Database\Eloquent\Model;

class CompassSalesOrder extends Model
{
    protected $connection = 'compass_postgres';
    protected $table = 'sales_orders';
    public $timestamps = false;

    public function marketingBy()
    {
        return $this->belongsTo(CompassOfficer::class, 'marketing_by_id');
    }
}
