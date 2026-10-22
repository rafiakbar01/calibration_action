<?php

namespace App\Models\Compass;

use Illuminate\Database\Eloquent\Model;

class CompassEmployee extends Model
{
    protected $connection = 'compass_postgres';
    protected $table = 'employees';
    public $timestamps = false;
}
