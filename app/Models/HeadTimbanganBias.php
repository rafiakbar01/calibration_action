<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadTimbanganBias extends Model
{
    protected $table = 'head_timbangan_bias';
    protected $primaryKey = 'id'; 
    public $incrementing = true;  
    protected $keyType = 'int';

    protected $fillable = [
        'calibration_id', 'certificate_id', 'standard', 'calibrationMethod','note','beban_kapasitas_maks','beban_setengah_kapasitas'
    ];

    public function calibration()
    {
        return $this->belongsTo(Calibration::class, 'calibration_id');
    }

    public function details()
    {
        return $this->hasMany(DetailTimbanganBias::class, 'head_timbangan_bias_id'); // ✅ UBAH
    }
}