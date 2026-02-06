<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityLogController extends Controller
{
    /**
     * Display activity logs
     */
    public function index(Request $request)
    {
        $query = ActivityLog::with(['logable', 'performer'])
            ->latest();
        
        // Apply filters
        $this->applyFilters($query, $request);
        
        $logs = $query->paginate(25)->withQueryString();
        
        // Get filter options
        $filterData = $this->getFilterData();
        
        // Get statistics
        $statistics = $this->getStatistics();
        
        return view('activity-logs.index', compact('logs', 'filterData', 'statistics'));
    }
    
    /**
     * Show specific activity log
     */
    public function show(ActivityLog $activityLog)
    {
        $activityLog->load(['logable', 'performer']);
        
        // Get related logs
        $relatedLogs = ActivityLog::where('batch_uuid', $activityLog->batch_uuid)
            ->where('id', '!=', $activityLog->id)
            ->with('performer')
            ->latest()
            ->take(5)
            ->get();
        
        return view('activity-logs.show', compact('activityLog', 'relatedLogs'));
    }
    
    /**
     * Get activities for specific model
     */
    public function modelActivities(Request $request, $model, $id)
    {
        $query = ActivityLog::with('performer')
            ->where('logable_type', $model)
            ->where('logable_id', $id)
            ->latest();
        
        // Apply filters
        $this->applyFilters($query, $request);
        
        $logs = $query->paginate(20)->withQueryString();
        
        // Get model instance
        $modelInstance = $model::find($id);
        $modelName = class_basename($model);
        
        return view('activity-logs.model-activities', compact('logs', 'modelInstance', 'modelName'));
    }
    
    /**
     * Get user activities
     */
    public function userActivities(Request $request, User $user)
    {
        $query = ActivityLog::with('logable')
            ->where('performed_by', $user->id)
            ->latest();
        
        // Apply filters
        $this->applyFilters($query, $request);
        
        $logs = $query->paginate(20)->withQueryString();
        
        return view('activity-logs.user-activities', compact('logs', 'user'));
    }
    
    /**
     * Export logs
     */
    public function export(Request $request)
    {
        $query = ActivityLog::with('performer')
            ->latest();
        
        $this->applyFilters($query, $request);
        
        $logs = $query->get();
        
        $filename = 'activity-logs-' . date('Y-m-d-H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];
        
        $callback = function() use ($logs) {
            $file = fopen('php://output', 'w');
            
            // Header
            fputcsv($file, [
                'ID', 'Waktu', 'Aktivitas', 'Deskripsi', 'Model', 
                'Model ID', 'User', 'IP Address', 'Method', 'URL'
            ]);
            
            // Data
            foreach ($logs as $log) {
                fputcsv($file, [
                    $log->id,
                    $log->created_at->format('Y-m-d H:i:s'),
                    $log->activity_type,
                    $log->description,
                    $log->model_name,
                    $log->logable_id,
                    $log->performer->name ?? 'System',
                    $log->ip_address,
                    $log->method,
                    $log->url,
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
    
    /**
     * Apply filters to query
     */
    private function applyFilters($query, Request $request): void
    {
        if ($request->filled('type')) {
            $query->where('activity_type', $request->type);
        }
        
        if ($request->filled('user')) {
            $query->where('performed_by', $request->user);
        }
        
        if ($request->filled('model')) {
            $query->where('logable_type', $request->model);
        }
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('description', 'like', "%{$search}%")
                  ->orWhere('ip_address', 'like', "%{$search}%")
                  ->orWhere('url', 'like', "%{$search}%")
                  ->orWhereHas('performer', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }
        
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
    }
    
    /**
     * Get filter data
     */
    private function getFilterData(): array
    {
        return [
            'activityTypes' => ActivityLog::select('activity_type')
                ->distinct()
                ->orderBy('activity_type')
                ->pluck('activity_type'),
            
            'models' => ActivityLog::select('logable_type')
                ->distinct()
                ->orderBy('logable_type')
                ->pluck('logable_type')
                ->map(function ($type) {
                    return [
                        'value' => $type,
                        'name' => class_basename($type),
                    ];
                }),
            
            'users' => User::whereIn('id', function($query) {
                    $query->select('performed_by')
                        ->from('activity_logs')
                        ->distinct();
                })
                ->orderBy('name')
                ->get(['id', 'name', 'email']),
        ];
    }
    
    /**
     * Get statistics
     */
    private function getStatistics(): array
    {
        return [
            'total' => ActivityLog::count(),
            'today' => ActivityLog::whereDate('created_at', today())->count(),
            'yesterday' => ActivityLog::whereDate('created_at', today()->subDay())->count(),
            'this_week' => ActivityLog::whereBetween('created_at', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ])->count(),
            'this_month' => ActivityLog::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count(),
            
            'top_activities' => ActivityLog::select('activity_type', DB::raw('COUNT(*) as count'))
                ->groupBy('activity_type')
                ->orderBy('count', 'desc')
                ->limit(5)
                ->get(),
            
            'top_users' => ActivityLog::select('performed_by', DB::raw('COUNT(*) as count'))
                ->with('performer')
                ->groupBy('performed_by')
                ->orderBy('count', 'desc')
                ->limit(5)
                ->get(),
            
            'recent_models' => ActivityLog::select('logable_type', DB::raw('COUNT(*) as count'))
                ->whereDate('created_at', '>=', now()->subDays(7))
                ->groupBy('logable_type')
                ->orderBy('count', 'desc')
                ->limit(5)
                ->get()
                ->map(function ($item) {
                    $item->model_name = class_basename($item->logable_type);
                    return $item;
                }),
        ];
    }
}