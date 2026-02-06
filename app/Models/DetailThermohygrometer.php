<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailThermohygrometer extends Model
{
    use HasFactory;

   /**
     * Kolom yang dapat diisi (mass assignable)
     */
    protected $fillable = [
        'calibration_id',

        'titikUkur_T',
        'T_STD1','T_STD2','T_STD3',
        'T_IN1','T_IN2','T_IN3',
        'T_OUT1','T_OUT2','T_OUT3',

        'titikUkur_RH',
        'RH_STD1','RH_STD2','RH_STD3',
        'RH_ALAT1','RH_ALAT2','RH_ALAT3',
    ];

    /**
     * Casting tipe data
     */
    protected $casts = [
        'titikUkur_T'  => 'decimal:5',
        'titikUkur_RH' => 'decimal:5',

        'T_STD1' => 'decimal:5',
        'T_STD2' => 'decimal:5',
        'T_STD3' => 'decimal:5',
        'T_IN1'  => 'decimal:5',
        'T_IN2'  => 'decimal:5',
        'T_IN3'  => 'decimal:5',
        'T_OUT1' => 'decimal:5',
        'T_OUT2' => 'decimal:5',
        'T_OUT3' => 'decimal:5',

        'RH_STD1'  => 'decimal:5',
        'RH_STD2'  => 'decimal:5',
        'RH_STD3'  => 'decimal:5',
        'RH_ALAT1' => 'decimal:5',
        'RH_ALAT2' => 'decimal:5',
        'RH_ALAT3' => 'decimal:5',
    ];


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}