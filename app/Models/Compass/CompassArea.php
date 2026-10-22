<?php

namespace App\Models\Compass;

use Illuminate\Database\Eloquent\Model;

class CompassArea extends Model
{
    protected $connection = 'compass_postgres';
    protected $table = 'areas';
    public $timestamps = false;
}
