<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSurfaceRoughnessTester extends Model
{
    use HasFactory;

   /**
     * Kolom yang dapat diisi (mass assignable)
     */
    protected $fillable = [
        'calibration_id',
        'nominalSTD',
        'parameter',
        'ukurAlat1',
        'ukurAlat2',
        'ukurAlat3',
        'CutOff'
    ];

    protected $casts = [
        'nominalSTD' => 'string',
        'ukurAlat1'  => 'string',
        'ukurAlat2'  => 'string',
        'ukurAlat3'  => 'string',
        'CutOff'     => 'string',
        
    ];


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}