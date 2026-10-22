<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailVolumetrik extends Model
{
    use HasFactory;

   /**
     * Kolom yang dapat diisi (mass assignable)
     */

    //  protected $table = 'detail_torque_meters'; // Atau nama tabel yang benar

    protected $fillable = [
        'calibration_id',
        'titikUkur',
        'masssaKosong01',
        'masssaKosong02',
        'masssaKosong03',
        'massaIsi01',
        'massaIsi02',
        'massaIsi03',
        'T_airSuling01',
        'T_airSuling02',
        'T_airSuling03',
        'P_Udara01',
        'P_Udara02',
        'P_Udara03',

    ];

    /**
     * Casting tipe data
     */
    // protected $casts = [
    //     'titikUkur' => 'decimal:5',
    //     'masssaKosong01' => 'decimal:5',
    //     'masssaKosong02' => 'decimal:5',
    //     'masssaKosong03' => 'decimal:5',
    //     'massaIsi01' => 'decimal:5',
    //     'massaIsi02' => 'decimal:5',
    //     'massaIsi03'  => 'decimal:5',
    //     'T_airSuling01'  => 'decimal:5',
    //     'T_airSuling02'  => 'decimal:5',
    //     'T_airSuling03'  => 'decimal:5',
    //     'P_Udara01'  => 'decimal:5',
    //     'P_Udara02'  => 'decimal:5',
    //     'P_Udara03'  => 'decimal:5',
    // ];


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}