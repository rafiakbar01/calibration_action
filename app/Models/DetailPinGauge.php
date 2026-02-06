<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPinGauge extends Model
{
    use HasFactory;

   /**
     * Kolom yang dapat diisi (mass assignable)
     */
    protected $fillable = [
        'calibration_id',
        'titikUkur',
        'ulangan1',
        'ulangan2',
        'ulangan3',
        'ulangan4',
        'ulangan5',
        'ulangan6',
     
    ];

    protected $casts = [
        'titikUkur' => 'decimal:5',
        'ulangan1'  => 'decimal:5',
        'ulangan2'  => 'decimal:5',
        'ulangan3'  => 'decimal:5',
        'ulangan4'  => 'decimal:5',
        'ulangan5'  => 'decimal:5',
        'ulangan6'  => 'decimal:5',
    ];


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}