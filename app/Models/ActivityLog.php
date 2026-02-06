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
        'changed_fields',
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
        'changed_fields' => 'array',
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
     * Scope untuk filter berdasarkan model
     */
    public function scopeForModel($query, $model, $id = null)
    {
        $query = $query->where('logable_type', $model);
        
        if ($id) {
            $query = $query->where('logable_id', $id);
        }
        
        return $query;
    }

    /**
     * Scope untuk filter berdasarkan user
     */
    public function scopeByUser($query, $userId)
    {
        return $query->where('performed_by', $userId);
    }

    /**
     * Scope untuk filter berdasarkan tanggal
     */
    public function scopeBetweenDates($query, $startDate, $endDate = null)
    {
        $query->whereDate('created_at', '>=', $startDate);
        
        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }
        
        return $query;
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
            'verify' => 'fa-check-circle text-warning',
            'approve' => 'fa-thumbs-up text-info',
            'reject' => 'fa-times-circle text-danger',
            'restore' => 'fa-trash-restore text-secondary',
            'login' => 'fa-sign-in-alt text-success',
            'logout' => 'fa-sign-out-alt text-secondary',
            'export' => 'fa-file-export text-info',
            'import' => 'fa-file-import text-primary',
            'view' => 'fa-eye text-info',
            'download' => 'fa-download text-success',
            'print' => 'fa-print text-secondary',
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
            'verify' => 'badge-warning',
            'approve' => 'badge-info',
            'reject' => 'badge-dark',
            'restore' => 'badge-secondary',
        ];
        
        return $colors[$this->activity_type] ?? 'badge-secondary';
    }

    /**
     * Format created_at untuk display
     */
    public function getFormattedTimeAttribute(): string
    {
        return $this->created_at->format('d M Y H:i:s');
    }

    /**
     * Get model name dari logable_type
     */
    public function getModelNameAttribute(): string
    {
        return class_basename($this->logable_type);
    }

    /**
     * Cek apakah ada perubahan data
     */
    public function hasDataChanges(): bool
    {
        return !empty($this->old_data) && !empty($this->new_data) && !empty($this->changed_fields);
    }

    /**
     * Get perubahan data dalam format yang mudah dibaca
     */
    public function getFormattedChangesAttribute(): array
    {
        if (!$this->hasDataChanges()) {
            return [];
        }
        
        $changes = [];
        foreach ($this->changed_fields as $field) {
            if (isset($this->old_data[$field]) && isset($this->new_data[$field])) {
                $changes[] = [
                    'field' => $field,
                    'from' => $this->formatValue($this->old_data[$field]),
                    'to' => $this->formatValue($this->new_data[$field]),
                ];
            }
        }
        
        return $changes;
    }

    /**
     * Format value untuk display
     */
    private function formatValue($value): string
    {
        if (is_array($value)) {
            return json_encode($value, JSON_PRETTY_PRINT);
        }
        
        if (is_bool($value)) {
            return $value ? 'Yes' : 'No';
        }
        
        if ($value === null) {
            return '<em>Empty</em>';
        }
        
        return (string) $value;
    }

    /**
     * Get URL ke model terkait jika ada
     */
    public function getModelUrlAttribute(): ?string
    {
        if (!$this->logable) {
            return null;
        }
        
        $modelName = strtolower($this->model_name);
        $routeName = "{$modelName}s.show";
        
        if (route()->has($routeName)) {
            return route($routeName, $this->logable_id);
        }
        
        return null;
    }
}