<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddPressureGauge extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'add_pressure_gauge';
    /**
     * Kolom yang dapat diisi (mass assignable)
     */
    protected $fillable = [
        'calibration_id',
        'repeatability',
        'repeatabilitySTD',
        'ulangan01',
        'ulangan02',
        'ulangan03',
        'ulangan04',
        'ulangan05',
    ];

    /**
     * Casting tipe data
     */
    // protected $casts = [
    //     'repeatability'    => 'decimal:5',
    //     'ulangan01'        => 'decimal:5',
    //     'ulangan02'        => 'decimal:5',
    //     'ulangan03'        => 'decimal:5',
    //     'ulangan04'        => 'decimal:5',
    //     'ulangan05'        => 'decimal:5',
    // ];

  

    /**
     * Get the calibration that owns the dial indicator data.
     */
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }
}