<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPressureTransmitter extends Model
{
    use HasFactory;

   /**
     * Kolom yang dapat diisi (mass assignable)
     */
    protected $fillable = [
        'calibration_id',
        'setPoint',
        'readP_UP',
        'readS_UP',
        'readP_DOWN',
        'readS_DOWN',
    ];

    protected $casts = [
        'setPoint'=>'decimal:5',
        'readP_UP'=>'decimal:5',
        'readS_UP'=>'decimal:5',
        'readP_DOWN'=>'decimal:5',
        'readS_DOWN'=>'decimal:5',
    ];
        
    


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}