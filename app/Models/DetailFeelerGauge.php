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
        'GBA4','UUTC4','form_index'
    ];

    protected $casts = [
        'nominalUUT' => 'string',
        'nominalGB'  => 'string',

        'GBA1'  => 'string',
        'UUTB1' => 'string',
        'GBA2'  => 'string',
        'UUTB2' => 'string',
        'GBA3'  => 'string',
        'UUTC3' => 'string',
        'GBA4'  => 'string',
        'UUTC4' => 'string',
        
    ];


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}