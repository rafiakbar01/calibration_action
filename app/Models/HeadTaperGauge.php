<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadTaperGauge extends Model
{
    protected $table = 'head_taper_gauge';
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
        return $this->hasMany(DetailTaperGauge::class, 'head_taper_gauge_id'); // ✅ UBAH
    }
}