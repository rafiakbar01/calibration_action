<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadIrThermometer extends Model
{
    protected $table = 'head_ir_thermometer';
    protected $primaryKey = 'id'; 
    public $incrementing = true;  
    protected $keyType = 'int';

    protected $fillable = [
        'calibration_id', 'certificate_id', 'standard', 'calibrationMethod','satuan_suhu_kiri','satuan_suhu_kanan'
    ];

    public function calibration()
    {
        return $this->belongsTo(Calibration::class, 'calibration_id');
    }

    public function details()
    {
        return $this->hasMany(DetailIrThermometer::class, 'head_ir_thermometer_id'); // ✅ UBAH
    }
}