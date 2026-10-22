<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailProfilProjector extends Model
{
    use HasFactory;

    protected $table = 'detail_profil_projectors'; // ✅ TAMBAHKAN INI
   /**
     * Kolom yang dapat diisi (mass assignable)
     */
    protected $fillable = [
        'calibration_id',
        'titikUkur',
        'X1',
        'X2',
        'X3',
        'X4',
        'X5',
        'Y1',
        'Y2',
        'Y3',
        'Y4',
        'Y5',
       
    ];

    protected $casts = [
        'titikUkur'=>'string',
        'X1'=>'string',
        'X2'=>'string',
        'X3'=>'string',
        'X4'=>'string',
        'X5'=>'string',
        'Y1'=>'string',
        'Y2'=>'string',
        'Y3'=>'string',
        'Y4'=>'string',
        'Y5'=>'string'
        
    ];


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}