<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_RH_TempHumidTransmitter extends Model
{
    use HasFactory;

    protected $table = 'detail_rh_temp_humid_transmitters';

    protected $casts = [
        'RH_setting' => 'decimal:3',
        'RH_STD1' => 'decimal:3',
        'RH_STD2' => 'decimal:3',
        'RH_STD3' => 'decimal:3',
        'RH_OSmA1' => 'decimal:3',
        'RH_OSmA2' => 'decimal:3',
        'RH_OSmA3' => 'decimal:3',
    ];

    protected $fillable = [
        'calibration_id', 
        'RH_setting',
        'RH_STD1',
        'RH_STD2',
        'RH_STD3',
        'RH_OSmA1',
        'RH_OSmA2',
        'RH_OSmA3'
    ];

    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

    // ❌ HAPUS relation ke HeadInsideMicrometer (jika tidak digunakan)
    // public function headInsideMicrometer()
    // {
    //     return $this->belongsTo(HeadInsideMicrometer::class);
    // }
}