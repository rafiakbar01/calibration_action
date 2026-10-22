<?php

namespace App\Models\Compass;

use Illuminate\Database\Eloquent\Model;

class CompassCustomer extends Model
{
    protected $connection = 'compass_postgres';
    protected $table = 'customers';
    public $timestamps = false;

    public function area()
    {
        return $this->belongsTo(CompassArea::class, 'area_id');
    }
}
