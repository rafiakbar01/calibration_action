<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadPushPull extends Model
{
    protected $table = 'head_push_pull';
    protected $primaryKey = 'id'; 
    public $incrementing = true;  
    protected $keyType = 'int';

    protected $fillable = [
        'calibration_id', 'certificate_id', 'standard', 'calibrationMethod','satuan_titik_ukur','satuan_tarik','satuan_tekan'
    ];

    public function calibration()
    {
        return $this->belongsTo(Calibration::class, 'calibration_id');
    }   

    public function details()
    {
        return $this->hasMany(DetailPushpull::class, 'head_push_pull_id'); // ✅ UBAH
    }
}