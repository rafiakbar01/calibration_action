<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadTimbangan extends Model
{
    protected $table = 'head_timbangan';
    protected $primaryKey = 'id'; 
    public $incrementing = true;  
    protected $keyType = 'int';

    protected $fillable = [
        'calibration_id', 'certificate_id', 'standard', 'calibrationMethod','note','setengah_kapasitas','kapasitas_max','form_index'
    ];

    public function calibration()
    {
        return $this->belongsTo(Calibration::class, 'calibration_id');
    }

    public function details()
    {
        return $this->hasMany(DetailTimbangan::class, 'head_timbangan_id'); // ✅ UBAH
    }
}