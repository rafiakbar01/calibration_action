<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadTempTransmitter extends Model
{
    protected $table = 'head_temp_transmitter';
    protected $primaryKey = 'id'; 
    public $incrementing = true;  
    protected $keyType = 'int';

    protected $fillable = [
        'calibration_id', 'certificate_id', 'standard', 'calibrationMethod','indicator','media','satuan_suhu_kiri','satuan_suhu_kanan','satuan_std_kiri','satuan_std_kanan','satuan_indicator_kiri','satuan_indicator_kanan'
    ];

    public function calibration()
    {
        return $this->belongsTo(Calibration::class, 'calibration_id');
    }

    public function details()
    {
        return $this->hasMany(DetailTempTransmitter::class, 'head_temp_transmitter_id'); // ✅ UBAH
    }
}