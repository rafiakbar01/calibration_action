<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTimbanganBias extends Model
{
    use HasFactory;
    protected $table = 'detail_timbangan_biass';
   /**
     * Kolom yang dapat diisi (mass assignable)
     */
    protected $fillable = [
        'calibration_id',
        'titikUkur',
        'Lm1','Lz1','Rm1','Rz1',
        'STD'
    ];

    protected $casts = [
        'titikUkur'=>'decimal:5',
        'Lm1'=>'decimal:5',
        'Lz1'=>'decimal:5',
        'Rm1'=>'decimal:5',
        'Rz1'=>'decimal:5',
        'STD'=>'decimal:5',
    ];


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}