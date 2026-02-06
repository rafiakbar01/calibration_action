<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadDialIndicator extends Model
{
    protected $table = 'head_dial_indicator';
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
        return $this->hasMany(DetailDialIndicator::class, 'head_dial_indicator_id'); // ✅ UBAH
    }
}