<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTimbangan extends Model
{
    use HasFactory;

   /**
     * Kolom yang dapat diisi (mass assignable)
     */
    protected $fillable = [
        'calibration_id',
        'titikUkur',
        'Lm1','Lz1','Rm1','Rz1',
        'STD','form_index'
        
    ];

    // protected $casts = [
    //     'titikUkur'=>'string',
    //     'Lm1'=>'string',
    //     'Lz1'=>'string',
    //     'Rm1'=>'string',
    //     'Rz1'=>'string',
    //     'STD'=>'string',

       
    // ];


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}