<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailUtm extends Model
{
    use HasFactory;

   /**
     * Kolom yang dapat diisi (mass assignable)
     */
    protected $fillable = [
        'calibration_id',
        'titikUkur',
        'readTekanSTD1',
        'readTekanSTD2',
        'readTekanSTD3',
        'readTekanUUT1',
        'readTekanUUT2',
        'readTekanUUT3',
        'readTarikSTD1',
        'readTarikSTD2',
        'readTarikSTD3',
        'readTarikUUT1',
        'readTarikUUT2',
        'readTarikUUT3'
    ];

    // protected $casts = [
    //     'titikUkur'=>'decimal:2',
    //     'readTekanSTD1'=>'decimal:2',
    //     'readTekanSTD2'=>'decimal:2',
    //     'readTekanSTD3'=>'decimal:2',
    //     'readTekanUUT1'=>'decimal:2',
    //     'readTekanUUT2'=>'decimal:2',
    //     'readTekanUUT3'=>'decimal:2',
    //     'readTarikSTD1'=>'decimal:2',
    //     'readTarikSTD2'=>'decimal:2',
    //     'readTarikSTD3'=>'decimal:2',
    //     'readTarikUUT1'=>'decimal:2',
    //     'readTarikUUT2'=>'decimal:2',
    //     'readTarikUUT3'=>'decimal:2'
        
    // ];


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}