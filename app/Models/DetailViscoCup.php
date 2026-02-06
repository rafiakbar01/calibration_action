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
        'nilaiStandar' => 'decimal:5',
        'ulangan1'     => 'decimal:5',
        'ulangan2'     => 'decimal:5',
        'ulangan3'     => 'decimal:5',
        'ulangan4'     => 'decimal:5',
        'ulangan5'     => 'decimal:5',
        'suhuCRM'      => 'decimal:5',
        
    ];


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}