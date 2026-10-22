<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadDialTestIndicator extends Model
{
    protected $table = 'head_dial_test_indicator';
    protected $primaryKey = 'id'; 
    public $incrementing = true;  
    protected $keyType = 'int';

    protected $fillable = [
        'calibration_id', 'certificate_id', 'standard', 'calibrationMethod','satuan_alat_kiri','satuan_alat_kanan'
    ];

    public function calibration()
    {
        return $this->belongsTo(Calibration::class, 'calibration_id');
    }

    public function details()
    {
        return $this->hasMany(DetailDialTestIndicator::class, 'head_dial_test_indicator_id'); // ✅ UBAH
    }
}