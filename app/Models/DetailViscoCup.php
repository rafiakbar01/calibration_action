<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailViscoCup extends Model
{
    use HasFactory;

   /**
     * Kolom yang dapat diisi (mass assignable)
     */
    protected $fillable = [
        'calibration_id',
        'nilaiStandar',
        'ulangan1',
        'ulangan2',
        'ulangan3',
        'ulangan4',
        'ulangan5',
        'suhuCRM'
    ];

    protected $casts = [
        'nilaiStandar' => 'string',
        'ulangan1'     => 'string',
        'ulangan2'     => 'string',
        'ulangan3'     => 'string',
        'ulangan4'     => 'string',
        'ulangan5'     => 'string',
        'suhuCRM'      => 'string',
        
    ];


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}