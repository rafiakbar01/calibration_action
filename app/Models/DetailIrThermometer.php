<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailIrThermometer extends Model
{
    use HasFactory;

   /**
     * Kolom yang dapat diisi (mass assignable)
     */
    protected $fillable = [
        'calibration_id', 
        'titikUkur',
        'STD01',
        'STD02',
        'STD03',
        'UUT01',
        'UUT02',
        'UUT03'
    ];

    protected $casts = [
        
        'titikUkur'     => 'string',
        'STD01'         => 'string',
        'STD02'         => 'string',
        'STD03'         => 'string',
        'UUT01'         => 'string',
        'UUT02'         => 'string',
        'UUT03'         => 'string',
    ];


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}