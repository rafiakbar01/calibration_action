<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadPlainLimitGauge extends Model
{
    protected $table = 'head_plain_limit_gauge';
    protected $primaryKey = 'id'; 
    public $incrementing = true;  
    protected $keyType = 'int';

    protected $fillable = [
        'calibration_id', 'certificate_id', 'standard', 'calibrationMethod','catatan','satuan_go','satuan_no_go'
    ];

    public function calibration()
    {
        return $this->belongsTo(Calibration::class, 'calibration_id');
    }

    public function details()
    {
        return $this->hasMany(DetailPlainLimitGauge::class, 'head_plain_limit_gauge_id'); // ✅ UBAH
    }
}