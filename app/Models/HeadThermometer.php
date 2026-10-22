<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadThermometer extends Model
{
    protected $table = 'head_thermometers';
    protected $primaryKey = 'id'; 
    public $incrementing = true;  
    protected $keyType = 'int';

    protected $fillable = [
        'calibration_id', 'certificate_id', 'standard', 'calibrationMethod','satuan_suhu_kiri','satuan_suhu_kanan','form_index','rentang_ukur_min','rentang_ukur_max','kapasitas','resolusi','keterangan_fungsi_komponen'
    ];

    public function calibration()
    {
        return $this->belongsTo(Calibration::class, 'calibration_id');
    }

    public function details()
    {
        return $this->hasMany(DetailThermometers::class, 'calibration_id', 'calibration_id');
    }
}