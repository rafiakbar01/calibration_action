<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddVolumetrik extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table = 'add_volumetrik';
    /**
     * Kolom yang dapat diisi (mass assignable)
     */
    protected $fillable = [
        'calibration_id',
        'titikUkur',
        'massaKosong',
        'massaIsi',
        'T_airSuling',
        'P_Udara',
    ];

    /**
     * Casting tipe data
     */
    // protected $casts = [
    //     'titikUkur' => 'decimal:5',
    //     'massaKosong' => 'decimal:5',
    //     'massaIsi' => 'decimal:5',
    //     'T_airSuling' => 'decimal:5',
    //     'P_Udara' => 'decimal:5',
       
    // ];
  

    /**
     * Get the calibration that owns the dial indicator data.
     */
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }
}