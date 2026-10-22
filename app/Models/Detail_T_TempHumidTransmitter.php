<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_T_TempHumidTransmitter extends Model
{
    use HasFactory;

    protected $table = 'detail_t_temp_humid_transmitters';

    // protected $casts = [
    //     'T_setting' => 'decimal:3',
    //     'T_STD1' => 'decimal:3',
    //     'T_STD2' => 'decimal:3',
    //     'T_STD3' => 'decimal:3',
    //     'T_OSmA1' => 'decimal:3',
    //     'T_OSmA2' => 'decimal:3',
    //     'T_OSmA3' => 'decimal:3',
    // ];

    protected $fillable = [
        'calibration_id', 
        'T_setting',
        'T_STD1',
        'T_STD2',
        'T_STD3',
        'T_OSmA1',
        'T_OSmA2',
        'T_OSmA3'
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