<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailDurometer extends Model
{
    use HasFactory;

   /**
     * Kolom yang dapat diisi (mass assignable)
     */

   protected $table = 'detail_durometers';
   
    protected $fillable = [
        'calibration_id',
        'titikUkur',
        'x1',
        'x2',
        'x3',

    ];

    // protected $casts = [
    //     'titikUkur' => 'decimal:5',
    //     'x1'     => 'decimal:5',
    //     'x2'     => 'decimal:5',
    //     'x3'     => 'decimal:5',
    // ];


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}