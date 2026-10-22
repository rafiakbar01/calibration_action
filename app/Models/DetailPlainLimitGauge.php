<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPlainLimitGauge extends Model
{
    use HasFactory;

   /**
     * Kolom yang dapat diisi (mass assignable)
     */
    protected $fillable = [
       'calibration_id',
        'titikUkurGO',
        'posisiAtasX1',
        'posisiAtasX2',
        'posisiAtasY1',
        'posisiAtasY2',
        'posisiBawahX1',
        'posisiBawahX2',
        'posisiBawahY1',
        'posisiBawahY2',

        'titikUkurNOGO',
        'sumbuAtasX1',
        'sumbuAtasX2',
        'sumbuAtasY1',
        'sumbuAtasY2',
        'sumbuBawahX1',
        'sumbuBawahX2',
        'sumbuBawahY1',
        'sumbuBawahY2',
    ];

    protected $casts = [
        'titikUkurGO' => 'string',
        'titikUkurNOGO' => 'string',
        'posisiAtasX1'   => 'string',
        'posisiAtasX2'   => 'string',
        'posisiAtasY1'   => 'string',
        'posisiAtasY2'   => 'string',
        'posisiBawahX1'   => 'string',
        'posisiBawahX2'   => 'string',
        'posisiBawahY1'   => 'string',
        'posisiBawahY2'   => 'string',
        'sumbuAtasX1'   => 'string',
        'sumbuAtasX2'   => 'string',
        'sumbuAtasY1'   => 'string',
        'sumbuAtasY2'   => 'string',
        'sumbuBawahX1'   => 'string',
        'sumbuBawahX2'   => 'string',
        'sumbuBawahY1'   => 'string',
        'sumbuBawahY2'   => 'string',
        
    ];


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}