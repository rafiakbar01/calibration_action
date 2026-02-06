<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTempTransmitter extends Model
{
    use HasFactory;

   /**
     * Kolom yang dapat diisi (mass assignable)
     */
    protected $fillable = [
        'calibration_id',
        'T_setting',
        'T_STD1',
        'T_STD2',
        'T_STD3',
        'T_Indicator1',
        'T_Indicator2',
        'T_Indicator3'
    ];

    protected $casts = [
        'T_setting'     => 'decimal:5',
        'T_STD1'        => 'decimal:5',
        'T_STD2'        => 'decimal:5',
        'T_STD3'        => 'decimal:5',
        'T_Indicator1'  => 'decimal:5',
        'T_Indicator2'  => 'decimal:5',
        'T_Indicator3'  => 'decimal:5',
        
    ];


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}