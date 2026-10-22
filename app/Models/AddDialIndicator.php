<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddDialIndicator extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'add_dial_indicator';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'calibration_id',
        'repeatability',
        'ulangan01',
        'ulangan02',
        'ulangan03',
        'ulangan04',
        'ulangan05',
        'ulangan06',
        'ulangan07',
        'ulangan08',
        'ulangan09',
        'ulangan10',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
     
    //     'ulangan01' => 'decimal:2',
    //     'ulangan02' => 'decimal:2',
    //     'ulangan03' => 'decimal:2',
    //     'ulangan04' => 'decimal:2',
    //     'ulangan05' => 'decimal:2',
    //     'ulangan06' => 'decimal:2',
    //     'ulangan07' => 'decimal:2',
    //     'ulangan08' => 'decimal:2',
    //     'ulangan09' => 'decimal:2',
    //     'ulangan10' => 'decimal:2',
    // ];

    /**
     * Get the calibration that owns the dial indicator data.
     */
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }
}