<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadUltrasonicThicknessGauge extends Model
{
    protected $table = 'head_ultrasonic_thickness_gauge';
    protected $primaryKey = 'id'; 
    public $incrementing = true;  
    protected $keyType = 'int';

    protected $fillable = [
        'calibration_id', 'certificate_id', 'standard', 'calibrationMethod',
        'satuan_unit', 'form_index', 'keterangan_fungsi_komponen'
    ];

    public function calibration()
    {
        return $this->belongsTo(Calibration::class, 'calibration_id');
    }

    public function details()
    {
        return $this->hasMany(DetailUltrasonicThicknessGauge::class, 'calibration_id'); // ✅ UBAH
    }
}