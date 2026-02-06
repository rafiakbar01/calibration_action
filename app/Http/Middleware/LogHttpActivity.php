<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\ActivityLog;
use Illuminate\Support\Str;

class LogHttpActivity
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Generate batch UUID untuk session ini
        if (!session()->has('activity_batch_uuid')) {
            session(['activity_batch_uuid' => Str::uuid()->toString()]);
        }
        
        return $next($request);
    }

    /**
     * Handle tasks after the response has been sent to the browser.
     */
    public function terminate($request, $response)
    {
        // Hanya log untuk method tertentu dan status code success
        if (!in_array($request->method(), ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'])) {
            return;
        }
        
        if ($response->getStatusCode() < 200 || $response->getStatusCode() >= 300) {
            return;
        }
        
        // Hanya log untuk route tertentu (opsional)
        if ($request->route()) {
            $routeName = $request->route()->getName();
            
            // Exclude route tertentu dari logging
            $excludedRoutes = [
                'activity-logs.*',
                'log-viewer.*',
                'horizon.*',
                'telescope.*',
                'livewire.*',
            ];
            
            foreach ($excludedRoutes as $pattern) {
                if (Str::is($pattern, $routeName)) {
                    return;
                }
            }
        }
        
        // Log aktivitas HTTP umum
        $this->logHttpActivity($request, $response);
    }
    
    /**
     * Log HTTP activity
     */
    private function logHttpActivity(Request $request, $response): void
    {
        $user = Auth::user();
        $route = $request->route();
        
        if (!$route) {
            return;
        }
        
        $routeName = $route->getName();
        $model = null;
        $modelId = null;
        
        // Cek apakah route terkait dengan model tertentu
        $parameters = $route->parameters();
        
        foreach ($parameters as $key => $value) {
            if (is_object($value) && method_exists($value, 'getKey')) {
                $model = get_class($value);
                $modelId = $value->getKey();
                break;
            }
        }
        
        // Tentukan activity type berdasarkan HTTP method
        $activityType = $this->getActivityTypeFromMethod($request->method());
        
        // Generate description
        $description = $this->generateHttpDescription($request, $routeName, $user);
        
        // Buat log
        ActivityLog::create([
            'logable_type' => $model,
            'logable_id' => $modelId,
            'activity_type' => $activityType,
            'description' => $description,
            'performed_by' => $user ? $user->id : null,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'metadata' => [
                'route' => $routeName,
                'parameters' => $parameters,
                'status_code' => $response->getStatusCode(),
                'content_type' => $response->headers->get('Content-Type'),
            ],
            'batch_uuid' => session('activity_batch_uuid'),
        ]);
    }
    
    /**
     * Get activity type dari HTTP method
     */
    private function getActivityTypeFromMethod(string $method): string
    {
        $mapping = [
            'GET' => 'view',
            'POST' => 'create',
            'PUT' => 'update',
            'PATCH' => 'update',
            'DELETE' => 'delete',
        ];
        
        return $mapping[$method] ?? strtolower($method);
    }
    
    /**
     * Generate description untuk HTTP activity
     */
    private function generateHttpDescription(Request $request, string $routeName, $user): string
    {
        $userName = $user ? $user->name : 'Guest';
        $method = $request->method();
        $path = $request->path();
        
        $actions = [
            'index' => 'melihat daftar',
            'create' => 'membuka form buat',
            'store' => 'menyimpan data baru',
            'show' => 'melihat detail',
            'edit' => 'membuka form edit',
            'update' => 'memperbarui data',
            'destroy' => 'menghapus data',
        ];
        
        // Extract action dari route name
        $action = 'mengakses';
        foreach ($actions as $key => $desc) {
            if (Str::contains($routeName, ".{$key}")) {
                $action = $desc;
                break;
            }
        }
        
        return "{$userName} {$action} {$path}";
    }
}