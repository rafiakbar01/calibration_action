<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadThreadGauge extends Model
{
    protected $table = 'head_thread_gauge';
    protected $primaryKey = 'id'; 
    public $incrementing = true;  
    protected $keyType = 'int';

    protected $fillable = [
        'calibration_id', 'certificate_id', 'standard', 'calibrationMethod','catatan'
    ];

    public function calibration()
    {
        return $this->belongsTo(Calibration::class, 'calibration_id');
    }

    public function details()
    {
        return $this->hasMany(DetailThreadGauge::class, 'head_thread_gauge_id'); // ✅ UBAH
    }
}