<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddDurometer extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'add_durometer';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'calibration_id',
        // 'repeability',
        'rep01',
        'rep02',
        'rep03',
        'rep04',
        'rep05',
        'rep06',
        'rep07',
        'rep08',
        'rep09',
        'rep10',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
   protected $casts = [
    'rep01' => 'string',
    'rep02' => 'string',
    'rep03' => 'string',
    'rep04' => 'string',
    'rep05' => 'string',
    'rep06' => 'string',
    'rep07' => 'string',
    'rep08' => 'string',
    'rep09' => 'string',
    'rep10' => 'string',
];

    /**
     * Get the calibration that owns the dial indicator data.
     */
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }
}