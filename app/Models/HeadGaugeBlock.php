<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadGaugeBlock extends Model
{
    protected $table = 'head_gauge_block';
    protected $primaryKey = 'id'; 
    public $incrementing = true;  
    protected $keyType = 'int';

    protected $fillable = [
        'calibration_id', 'certificate_id', 'standard', 'calibrationMethod','satuan_unit', 'attachment','attachment_name','attachment_size','attachment_mime', 
    ];

    public function calibration()
    {
        return $this->belongsTo(Calibration::class, 'calibration_id');
    }

    public function details()
    {
        return $this->hasMany(DetailGaugeBlock::class, 'head_gauge_block_id'); // ✅ UBAH
    }
}