<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddCaliper extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
  
    /**
     * Kolom yang dapat diisi (mass assignable)
     */
    protected $fillable = [
        'calibration_id',
        'titikUkurKesajajaran',
        'kesejajaranAwal',
        'kesejajaranTengah',
        'kesejajaranAkhir',
        'pengukuranDalamPisauBersilang',
        'pembacaan1',
        'pembacaan2',
        'pembacaan3',
        'form_index'
    ];

    /**
     * Casting tipe data
     */
    // protected $casts = [
    //     'titikUkurKesajajaran' => 'decimal:5',
    //     'kesejajaranAwal' => 'decimal:5',
    //     'kesejajaranTengah' => 'decimal:5',
    //     'kesejajaranAkhir' => 'decimal:5',
    //     'pengukuranDalamPisauBersilang' => 'decimal:5',
    //     'pembacaan1' => 'decimal:5',
    //     'pembacaan2' => 'decimal:5',
    //     'pembacaan3' => 'decimal:5',
    // ];

  

    /**
     * Get the calibration that owns the dial indicator data.
     */
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }
}