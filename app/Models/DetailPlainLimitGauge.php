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
        'titikUkurGO' => 'decimal:5',
        'titikUkurNOGO' => 'decimal:5',
        'posisiAtasX1'   => 'decimal:5',
        'posisiAtasX2'   => 'decimal:5',
        'posisiAtasY1'   => 'decimal:5',
        'posisiAtasY2'   => 'decimal:5',
        'posisiBawahX1'   => 'decimal:5',
        'posisiBawahX2'   => 'decimal:5',
        'posisiBawahY1'   => 'decimal:5',
        'posisiBawahY2'   => 'decimal:5',
        'sumbuAtasX1'   => 'decimal:5',
        'sumbuAtasX2'   => 'decimal:5',
        'sumbuAtasY1'   => 'decimal:5',
        'sumbuAtasY2'   => 'decimal:5',
        'sumbuBawahX1'   => 'decimal:5',
        'sumbuBawahX2'   => 'decimal:5',
        'sumbuBawahY1'   => 'decimal:5',
        'sumbuBawahY2'   => 'decimal:5',
        
    ];


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}