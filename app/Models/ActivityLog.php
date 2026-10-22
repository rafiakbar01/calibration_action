<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends Model
{
    protected $fillable = [
        'logable_type',
        'logable_id',
        'activity_type',
        'description',
        'old_data',
        'new_data',
        'performed_by',
        'ip_address',
        'user_agent',
        'method',
        'url',
        'metadata',
        'batch_uuid',
    ];

    protected $casts = [
        'old_data' => 'array',
        'new_data' => 'array',
        'metadata' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi polymorphic ke model terkait
     */
    public function logable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * User yang melakukan aktivitas
     */
    public function performer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'performed_by');
    }

    /**
     * Scope untuk filter berdasarkan tipe aktivitas
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('activity_type', $type);
    }

    /**
     * Get activity icon
     */
    public function getActivityIconAttribute(): string
    {
        $icons = [
            'create' => 'fa-plus-circle text-success',
            'update' => 'fa-edit text-primary',
            'delete' => 'fa-trash text-danger',
            'login' => 'fa-sign-in-alt text-success',
            'logout' => 'fa-sign-out-alt text-secondary',
            'verify' => 'fa-check-circle text-warning',
            'approve' => 'fa-thumbs-up text-info',
            'reject' => 'fa-times-circle text-danger',
            'speed_test' => 'fa-tachometer-alt text-info',
        ];
        
        return $icons[$this->activity_type] ?? 'fa-history text-muted';
    }

    /**
     * Get badge color berdasarkan activity type
     */
    public function getActivityBadgeAttribute(): string
    {
        $colors = [
            'create' => 'badge-success',
            'update' => 'badge-primary',
            'delete' => 'badge-danger',
            'login' => 'badge-success',
            'logout' => 'badge-secondary',
            'verify' => 'badge-warning',
            'approve' => 'badge-info',
            'reject' => 'badge-dark',
            'speed_test' => 'badge-info',
        ];
        
        return $colors[$this->activity_type] ?? 'badge-secondary';
    }

    /**
     * Format created_at untuk display
     */
    public function getFormattedTimeAttribute(): string
    {
        return $this->created_at->format('d/m/Y H:i:s');
    }

    /**
     * Get model name dari logable_type
     */
    public function getModelNameAttribute(): string
    {
        return $this->logable_type ? class_basename($this->logable_type) : '-';
    }
}