<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailCentrifuge extends Model
{
    use HasFactory;

   /**
     * Kolom yang dapat diisi (mass assignable)
     */
    protected $fillable = [
        'calibration_id',
        'nominalRPM',
        'STD1',
        'STD2',
        'STD3',
        'STD4',
        'STD5',
        'resolusi'
    ];

    protected $casts = [
        'nominalRPM'=>'decimal:3',
        'STD1'=>'decimal:3',
        'STD2'=>'decimal:3',
        'STD3'=>'decimal:3',
        'STD4'=>'decimal:3',
        'STD5'=>'decimal:3',
        'resolusi'=>'decimal:3'
        
    ];


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}