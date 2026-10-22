<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTaperGauge extends Model
{
    use HasFactory;

   /**
     * Kolom yang dapat diisi (mass assignable)
     */
    protected $fillable = [
        'calibration_id',
        'titikUkur',
        'ulangan01',
        'ulangan02',
        'ulangan03',
        'ulangan04',
        'ulangan05'
    ];

    protected $casts = [
        'titikUkur' => 'string',
        'ulangan01' => 'string',
        'ulangan02' => 'string',
        'ulangan03' => 'string',
        'ulangan04' => 'string',
        'ulangan05' => 'string',

    ];


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}