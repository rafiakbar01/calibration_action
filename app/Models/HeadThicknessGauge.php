<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadThicknessGauge extends Model
{
    protected $table = 'head_thickness_gauge';
    protected $primaryKey = 'id'; 
    public $incrementing = true;  
    protected $keyType = 'int';

    protected $fillable = [
        'calibration_id', 'certificate_id', 'standard', 'calibrationMethod','satuan_unit'
    ];

    public function calibration()
    {
        return $this->belongsTo(Calibration::class, 'calibration_id');
    }

    public function details()
    {
        return $this->hasMany(DetailThicknessGauge::class, 'head_thickness_gauge_id'); // ✅ UBAH
    }
}