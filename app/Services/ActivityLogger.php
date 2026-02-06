<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class ActivityLogger
{
    /**
     * Log aktivitas manual
     */
    public static function log(
        string $activityType,
        string $description,
        $model = null,
        array $oldData = null,
        array $newData = null,
        array $changedFields = null,
        array $metadata = null
    ): ActivityLog {
        $user = Auth::user();
        $request = Request::instance();
        
        $logData = [
            'activity_type' => $activityType,
            'description' => $description,
            'old_data' => $oldData,
            'new_data' => $newData,
            'changed_fields' => $changedFields,
            'performed_by' => $user ? $user->id : 1,
            'ip_address' => $request ? $request->ip() : null,
            'user_agent' => $request ? $request->userAgent() : null,
            'method' => $request ? $request->method() : null,
            'url' => $request ? $request->fullUrl() : null,
            'metadata' => $metadata,
            'batch_uuid' => session('activity_batch_uuid', Str::uuid()->toString()),
        ];
        
        // Jika ada model, tambahkan logable info
        if ($model) {
            $logData['logable_type'] = get_class($model);
            $logData['logable_id'] = $model->getKey();
        }
        
        return ActivityLog::create($logData);
    }
    
    /**
     * Log login activity
     */
    public static function logLogin($user, bool $success = true, string $ip = null): ActivityLog
    {
        $description = $success 
            ? "User {$user->name} berhasil login"
            : "Gagal login untuk user {$user->email}";
        
        return self::log(
            $success ? 'login' : 'failed_login',
            $description,
            $user,
            null, null, null,
            [
                'email' => $user->email,
                'success' => $success,
                'ip_address' => $ip ?? Request::ip(),
            ]
        );
    }
    
    /**
     * Log logout activity
     */
    public static function logLogout($user): ActivityLog
    {
        return self::log(
            'logout',
            "User {$user->name} berhasil logout",
            $user
        );
    }
    
    /**
     * Log import activity
     */
    public static function logImport(string $model, int $count, array $metadata = null): ActivityLog
    {
        return self::log(
            'import',
            "Berhasil mengimport {$count} data {$model}",
            null, null, null, null,
            array_merge($metadata ?? [], ['count' => $count])
        );
    }
    
    /**
     * Log export activity
     */
    public static function logExport(string $model, int $count, string $format = 'excel'): ActivityLog
    {
        return self::log(
            'export',
            "Berhasil mengexport {$count} data {$model} dalam format {$format}",
            null, null, null, null,
            ['count' => $count, 'format' => $format]
        );
    }
    
    /**
     * Log system activity
     */
    public static function logSystem(string $description, array $metadata = null): ActivityLog
    {
        return self::log(
            'system',
            $description,
            null, null, null, null,
            $metadata
        );
    }
}