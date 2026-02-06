<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadPressureTransmitter extends Model
{
    protected $table = 'head_pressure_transmitter';
    protected $primaryKey = 'id'; 
    public $incrementing = true;  
    protected $keyType = 'int';

    protected $fillable = [
        'calibration_id', 'certificate_id', 'standard', 'calibrationMethod','tertelusur','satuan_set_point','satuan_p_naik','satuan_p_turun','satuan_so_naik','satuan_so_turun'
    ];

    public function calibration()
    {
        return $this->belongsTo(Calibration::class, 'calibration_id');
    }

    public function details()
    {
        return $this->hasMany(DetailPressureTransmitter::class, 'head_pressure_transmitter_id'); // ✅ UBAH
    }
}