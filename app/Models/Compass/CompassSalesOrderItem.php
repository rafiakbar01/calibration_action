<?php

namespace App\Models\Compass;

use Illuminate\Database\Eloquent\Model;

class CompassSalesOrderItem extends Model
{
    protected $connection = 'compass_postgres';
    protected $table = 'sales_order_items';
    public $timestamps = false;
}
