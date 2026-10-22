<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailConductivityMeter extends Model
{
    use HasFactory;

   /**
     * Kolom yang dapat diisi (mass assignable)
     */

     protected $table = 'detail_conductivity_meters'; // Atau nama tabel yang benar

    protected $fillable = [
        'calibration_id',
        'form_index',
        'nilaiCRM',
        'rep01',
        'rep02',
        'rep03',
        'rep04',
        'rep05',
        'Resolusi',
        'suhuCRM'
    ];

    /**
     * Casting tipe data
     */
    // protected $casts = [
    //     'nilaiCRM' => 'decimal:5',
    //     'rep01' => 'decimal:5',
    //     'rep02' => 'decimal:5',
    //     'rep03' => 'decimal:5',
    //     'rep04' => 'decimal:5',
    //     'rep05' => 'decimal:5',
    //     'Resolusi' => 'decimal:5',
    //     'suhuCRM' => 'decimal:5',
    // ];


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}