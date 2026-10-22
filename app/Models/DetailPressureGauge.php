<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPressureGauge extends Model
{
    use HasFactory;

   /**
     * Kolom yang dapat diisi (mass assignable)
     */
    protected $fillable = [
        'calibration_id',
        'titikUkur',
        'STDNaik',
        'STDTurun',
    ];

    /**
     * Casting tipe data
     */
    // protected $casts = [
    //     'titikUkur' => 'decimal:5',
    //     'STDNaik'   => 'decimal:5',
    //     'STDTurun'  => 'decimal:5',
    // ];


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}