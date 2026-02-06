<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadThermometer extends Model
{
    protected $table = 'head_thermometer';
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
        return $this->hasMany(DetailThermometer::class, 'head_thermometer_id');
    }
}