<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPushPull extends Model
{
    use HasFactory;

    protected $table = 'detail_push_pulls'; // ✅ TAMBAHKAN INI
   /**
     * Kolom yang dapat diisi (mass assignable)
     */
    protected $fillable = [
        'calibration_id',
        'titikUkur',
        'STD',
        'ulanganTarik01',
        'ulanganTarik02',
        'ulanganTarik03',
        'ulanganTekan01',
        'ulanganTekan02',
        'ulanganTekan03',   
       
    ];

    // protected $casts = [
    //     'titikUkur'=>'decimal:5',
    //     'STD'=>'string',
    //     'ulanganTarik01'=>'decimal:5',
    //     'ulanganTarik02'=>'decimal:5',
    //     'ulanganTarik03'=>'decimal:5',
    //     'ulanganTekan01'=>'decimal:5',
    //     'ulanganTekan02'=>'decimal:5',
    //     'ulanganTekan03'=>'decimal:5'
        
    // ];


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}