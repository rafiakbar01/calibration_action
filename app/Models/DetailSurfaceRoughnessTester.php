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
        'nominalSTD' => 'decimal:5',
        'ukurAlat1'  => 'decimal:5',
        'ukurAlat2'  => 'decimal:5',
        'ukurAlat3'  => 'decimal:5',
        'CutOff'     => 'decimal:5',
        
    ];


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}