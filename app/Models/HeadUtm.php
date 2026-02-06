<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadUtm extends Model
{
    protected $table = 'head_utm';
    protected $primaryKey = 'id'; 
    public $incrementing = true;  
    protected $keyType = 'int';

    protected $fillable = [
        'calibration_id', 'certificate_id', 'standard', 'calibrationMethod','satuan_titik_ukur_tekan',
        'satuan_read_tekan_std','satuan_read_tekan_uut','satuan_titik_ukur_tarik','satuan_read_tarik_std',
        'satuan_read_tarik_uut'
    ];

    public function calibration()
    {
        return $this->belongsTo(Calibration::class, 'calibration_id');
    }

    public function details()
    {
        return $this->hasMany(DetailUtm::class, 'head_utm_id'); // ✅ UBAH
    }
}