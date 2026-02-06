<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadThermoIndicator extends Model
{
    protected $table = 'head_thermoindicator';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'calibration_id', 'certificate_id', 'standard', 'calibrationMethod','satuan_std','satuan_uut'
    ];

    public function calibration()
    {
        return $this->belongsTo(Calibration::class, 'calibration_id');
    }

    public function details()
    {
        return $this->hasMany(DetailThermoIndicator::class, 'head_thermo_indicator_id'); // ✅ UBAH
    }
}