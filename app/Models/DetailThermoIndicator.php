<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailThermoIndicator extends Model
{
    use HasFactory;

   /**
     * Kolom yang dapat diisi (mass assignable)
     */
    protected $table = 'detail_thermoindicators';

    protected $fillable = [
        'calibration_id',
        'PenunjukanSTD',
        'UUTnaik',
        'UUTturun'
    ];

    protected $casts = [
        'PenunjukanSTD' => 'decimal:5',
        'UUTnaik'    => 'decimal:5',
        'UUTturun'   => 'decimal:5',
        
    ];


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}