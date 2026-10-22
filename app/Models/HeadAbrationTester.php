<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadAbrationTester extends Model
{
    protected $table = 'head_abration_tester';
    protected $primaryKey = 'id'; 
    public $incrementing = true;  
    protected $keyType = 'int';

    protected $fillable = [
        'calibration_id', 'certificate_id', 'standard', 'calibrationMethod', 'catatan'
    ];

    public function calibration()
    {
        return $this->belongsTo(Calibration::class, 'calibration_id');
    }

    public function details()
    {
        return $this->hasMany(DetailAbrationTester::class, 'head_abration_tester_id'); // ✅ UBAH
    }
}

