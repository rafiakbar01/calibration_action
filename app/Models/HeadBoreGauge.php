<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadBoreGauge extends Model
{
    protected $table = 'head_bore_gauge';
    protected $primaryKey = 'id'; 
    public $incrementing = true;  
    protected $keyType = 'int';

    protected $fillable = [ 
        'calibration_id', 'certificate_id', 'standard', 'calibrationMethod','satuan_unit_bawah','satuan_unit_atas'
    ];

    public function calibration()
    {
        return $this->belongsTo(Calibration::class, 'calibration_id');
    }

    public function details()
    {
        return $this->hasMany(DetailBoreGauge::class, 'head_bore_gauge_id'); // ✅ UBAH
    }
}