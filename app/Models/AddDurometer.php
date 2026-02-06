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
        // 'repeability' => 'decimal:2',
        'rep01' => 'decimal:2',
        'rep02' => 'decimal:2',
        'rep03' => 'decimal:2',
        'rep04' => 'decimal:2',
        'rep05' => 'decimal:2',
        'rep06' => 'decimal:2',
        'rep07' => 'decimal:2',
        'rep08' => 'decimal:2',
        'rep09' => 'decimal:2',
        'rep10' => 'decimal:2',
    ];

    /**
     * Get the calibration that owns the dial indicator data.
     */
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }
}