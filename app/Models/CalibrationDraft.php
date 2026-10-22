<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalibrationDraft extends Model
{
    protected $fillable = [
        'user_id',
        'draft_data',
        'last_saved_at',
    ];

    protected $casts = [
        'draft_data'    => 'array',
        'last_saved_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
