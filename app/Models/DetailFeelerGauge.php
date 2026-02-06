<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailFeelerGauge extends Model
{
    use HasFactory;

   /**
     * Kolom yang dapat diisi (mass assignable)
     */
    protected $fillable = [
        'calibration_id',
        'nominalUUT',
        'nominalGB',
        'GBA1','UUTB1',
        'GBA2','UUTB2',
        'GBA3','UUTC3',
        'GBA4','UUTC4'
    ];

    protected $casts = [
        'nominalUUT' => 'decimal:5',
        'nominalGB'  => 'decimal:5',

        'GBA1'  => 'decimal:5',
        'UUTB1' => 'decimal:5',
        'GBA2'  => 'decimal:5',
        'UUTB2' => 'decimal:5',
        'GBA3'  => 'decimal:5',
        'UUTC3' => 'decimal:5',
        'GBA4'  => 'decimal:5',
        'UUTC4' => 'decimal:5',
        
    ];


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}