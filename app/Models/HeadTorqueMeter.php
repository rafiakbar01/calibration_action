<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadTorqueMeter extends Model
{
    protected $table = 'head_torque_meter';
    protected $primaryKey = 'id'; 
    public $incrementing = true;  
    protected $keyType = 'int';

    protected $fillable = [
        'calibration_id', 'certificate_id', 'standard', 'calibrationMethod','satuan_titikUkur','satuan_cw','satuan_ccw'
    ];

    public function calibration()
    {
        return $this->belongsTo(Calibration::class, 'calibration_id');
    }

    public function details()
    {
        return $this->hasMany(DetailTorqueMeter::class, 'head_torque_meter_id'); // ✅ UBAH
    }
}