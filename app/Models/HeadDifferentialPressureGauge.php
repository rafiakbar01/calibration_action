<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadDifferentialPressureGauge extends Model
{
    protected $table = 'head_differential_pressure_gauge';
    protected $primaryKey = 'id'; 
    public $incrementing = true;  
    protected $keyType = 'int';

    protected $fillable = [
        'calibration_id', 'certificate_id', 'standard', 'calibrationMethod','satuan_alat_kiri','satuan_std_kiri','satuan_alat_kanan','satuan_std_kanan'
    ];

    public function calibration()
    {
        return $this->belongsTo(Calibration::class, 'calibration_id');
    }

    public function details()
    {
        return $this->hasMany(DetailDifferentialPressureGauge::class, 'head_differential_pressure_gauge_id'); // ✅ UBAH
    }
}