<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddTorqueMeter extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'add_torque_meter'; // ✅ Sesuai migration
    /**
     * Kolom yang dapat diisi (mass assignable)
     */
    protected $fillable = [
        'calibration_id',
        'repCw01',
        'repCw02',
        'repCw03',
        'repCw04',
        'repCw05',
        'repCw06',
        'repCw07',
        'repCw08',
        'repCw09',
        'repCw10',

        'repCcw01',
        'repCcw02',
        'repCcw03',
        'repCcw04',
        'repCcw05',
        'repCcw06',
        'repCcw07',
        'repCcw08',
        'repCcw09',
        'repCcw10',
        'radiusAlatBantuSTD',
        'kodeAlatBantuSTD',
    ];

    /**
     * Casting tipe data
     */
    // protected $casts = [
    //     'repCw01' => 'decimal:5',
    //     'repCw02' => 'decimal:5',
    //     'repCw03' => 'decimal:5',
    //     'repCw04' => 'decimal:5',
    //     'repCw05' => 'decimal:5',
    //     'repCw06' => 'decimal:5',
    //     'repCw07' => 'decimal:5',
    //     'repCw08' => 'decimal:5',
    //     'repCw09' => 'decimal:5',
    //     'repCw10' => 'decimal:5',

    //     'repCcw01' => 'decimal:5',
    //     'repCcw02' => 'decimal:5',
    //     'repCcw03' => 'decimal:5',
    //     'repCcw04' => 'decimal:5',
    //     'repCcw05' => 'decimal:5',
    //     'repCcw06' => 'decimal:5',
    //     'repCcw07' => 'decimal:5',
    //     'repCcw08' => 'decimal:5',
    //     'repCcw09' => 'decimal:5',
    //     'repCcw10' => 'decimal:5',
    // ];

  

    /**
     * Get the calibration that owns the dial indicator data.
     */
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }
}