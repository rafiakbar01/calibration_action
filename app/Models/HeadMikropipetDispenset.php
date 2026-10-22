<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadMikropipetDispenset extends Model
{
    protected $table = 'head_mikropipet_dispenset';
    protected $primaryKey = 'id'; 
    public $incrementing = true;  
    protected $keyType = 'int';

    protected $fillable = [
        'calibration_id', 'certificate_id', 'standard', 'calibrationMethod','satuan_alat_ukur_kiri','satuan_alat_ukur_kanan','satuan_alat_ukur_bawah_kiri','satuan_alat_ukur_bawah_kanan','satuan_alat_ukur_tambahan_kiri','form_index'
    ];

    public function calibration()
    {
        return $this->belongsTo(Calibration::class, 'calibration_id');
    }

    public function details()
    {
        return $this->hasMany(DetailMikropipetDispenset::class, 'head_mikropipet_dispenset_id'); // ✅ UBAH
    }
}