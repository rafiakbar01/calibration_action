<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'status',
        'created_by',
        'verified_by',
        'approved_by',
        'verified_at',
        'approved_at'
    ];

    protected $casts = [
        'verified_at' => 'datetime',
        'approved_at' => 'datetime'
    ];

    /**
     * Relasi ke ActivityLog
     */
    public function activityLogs(): HasMany
    {
        return $this->hasMany(ActivityLog::class, 'logable_id')
            ->where('logable_type', self::class)
            ->orderBy('created_at', 'desc');
    }

    /**
     * Relasi ke user yang membuat
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Relasi ke user yang memverifikasi
     */
    public function verifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    /**
     * Relasi ke user yang menyetujui
     */
    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}