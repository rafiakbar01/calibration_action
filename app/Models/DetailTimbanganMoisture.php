<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTimbanganMoisture extends Model
{
    use HasFactory;

   /**
     * Kolom yang dapat diisi (mass assignable)
     */
    protected $fillable = [
        'calibration_id',
        'titikUkur',
        'Lm1','Lz1','Rm1','Rz1',
        'STD',
        'Tsetting','ReadAlat01','ReadAlat02','ReadAlat03','ReadSTD01','ReadSTD02','ReadSTD03','form_index'
    ];

    // protected $casts = [
    //     'titikUkur'=>'decimal:5',
    //     'Lm1'=>'decimal:5',
    //     'Lz1'=>'decimal:5',
    //     'Rm1'=>'decimal:5',
    //     'Rz1'=>'decimal:5',
    //     'STD'=>'decimal:5',
        
    //     'Tsetting'=>'decimal:5',
    //     'ReadAlat01'=>'decimal:5',
    //     'ReadAlat02'=>'decimal:5',
    //     'ReadAlat03'=>'decimal:5',
    //     'ReadSTD01'=>'decimal:5',
    //     'ReadSTD02'=>'decimal:5',
    //     'ReadSTD03'=>'decimal:5',
    // ];


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}