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
        'setPoint'=>'string',
        'readP_UP'=>'string',
        'readS_UP'=>'string',
        'readP_DOWN'=>'string',
        'readS_DOWN'=>'string',
    ];
        
    


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}