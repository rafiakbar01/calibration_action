<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadPinGauge extends Model
{
    protected $table = 'head_pin_gauge';
    protected $primaryKey = 'id'; 
    public $incrementing = true;  
    protected $keyType = 'int';

    protected $fillable = [
        'calibration_id', 'certificate_id', 'standard', 'calibrationMethod'
    ];

    public function calibration()
    {
        return $this->belongsTo(Calibration::class, 'calibration_id');
    }

    public function details()
    {
        return $this->hasMany(DetailPinGauge::class, 'head_pin_gauge_id'); // ✅ UBAH
    }
}