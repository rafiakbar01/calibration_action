<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailMultimeterDc extends Model
{
    use HasFactory;

   /**
     * Kolom yang dapat diisi (mass assignable)
     */
    protected $fillable = [
        'calibration_id',
        'titikUkur',
        'STD1_1',
        'STD1_2',
        'STD1_3',
        'STD1_4',
        'STD1_5',
        'resolusiSTD1',
        'STD2_1',
        'STD2_2',
        'STD2_3',
        'STD2_4',
        'STD2_5',
        'resolusiSTD2',
        'STD3_1',
        'STD3_2',
        'STD3_3',
        'STD3_4',
        'STD3_5',
        'resolusiSTD3'
    ];

    protected $casts = [
        'titikUkur'=>'decimal:2',
        'STD1_1'=>'decimal:2',
        'STD1_2'=>'decimal:2',
        'STD1_3'=>'decimal:2',
        'STD1_4'=>'decimal:2',
        'STD1_5'=>'decimal:2',
        'resolusiSTD1'=>'decimal:2',
        'STD2_1'=>'decimal:2',
        'STD2_2'=>'decimal:2',
        'STD2_3'=>'decimal:2',
        'STD2_4'=>'decimal:2',
        'STD2_5'=>'decimal:2',
        'resolusiSTD2'=>'decimal:2',
        'STD3_1'=>'decimal:2',
        'STD3_2'=>'decimal:2',
        'STD3_3'=>'decimal:2',
        'STD3_4'=>'decimal:2',
        'STD3_5'=>'decimal:2',
        'resolusiSTD3'=>'decimal:2',
        
    ];


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}