<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalibrationMethod extends Model
{
    use HasFactory;

    protected $table = 'calibration_methods';

    protected $fillable = [
        'nama_alat',
        'metode_kalibrasi',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}