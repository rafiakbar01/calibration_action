<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadTimbanganMoisture extends Model
{
    protected $table = 'head_timbangan_moisture';
    protected $primaryKey = 'id'; 
    public $incrementing = true;  
    protected $keyType = 'int';

    protected $fillable = [
        'calibration_id', 'certificate_id', 'standard', 'calibrationMethod','setengah_kapasitas','kapasitas_max','form_index'
    ];

    public function calibration()
    {
        return $this->belongsTo(Calibration::class, 'calibration_id');
    }

    public function details()
    {
        return $this->hasMany(DetailTimbanganMoisture::class, 'head_Timbangan_moisture_id'); // ✅ UBAH
    }
}