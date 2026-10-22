<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailThreadGauge extends Model
{
    use HasFactory;

   /**
     * Kolom yang dapat diisi (mass assignable)
     */
    protected $fillable = [
        'calibration_id',
        'sensor','kodeGO','satuan_go','nominalGO','GOatasX1','GOatasY1',
        'GObawahX1','GObawahY1','kodeNOTGO','satuan_not_go','nominalNOTGO',
        'NOTGOatasX1','NOTGOatasY1','NOTGObawahX1','NOTGObawahY1',
        'ukuranPitch','satuan_pitch','sudutUlir'
    ];

    protected $casts = [
        'nominalGO' => 'string',
        'GOatasX1'=>'string','GOatasY1'=>'string',
        'GObawahX1'=>'string','GObawahY1'=>'string',
        'nominalNOTGO'=>'string','NOTGOatasX1'=>'string','NOTGOatasY1'=>'string',
        'NOTGObawahX1'=>'string','NOTGObawahY1'=>'string',
        'ukuranPitch'=>'string',
        
    ];


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}