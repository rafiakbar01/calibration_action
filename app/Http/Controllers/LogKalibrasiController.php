<?php
// app/Http/Controllers/LogKalibrasiController.php

namespace App\Http\Controllers;

use App\Models\LogKalibrasi;
use App\Models\User;
use Illuminate\Http\Request;

class LogKalibrasiController extends Controller
{
    /**
     * Tampilkan semua log kalibrasi dengan filter
     */
    public function index(Request $request)
    {
        $query = LogKalibrasi::with('user');
        
        // Apply filters
        if ($request->filled('aksi')) {
            $query->where('aksi', $request->aksi);
        }
        
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        
        if ($request->filled('logable_id')) {
            $logableIdVal = ltrim(trim($request->logable_id), '#');
            $query->where('kalibrasi_id', 'like', '%' . $logableIdVal . '%');
        }
        
        if ($request->filled('tanggal_dari')) {
            $query->whereDate('created_at', '>=', $request->tanggal_dari);
        }
        
        if ($request->filled('tanggal_sampai')) {
            $query->whereDate('created_at', '<=', $request->tanggal_sampai);
        }
        
        $logs = $query->orderBy('created_at', 'desc')->paginate(20);
        
        // Get filter options
        $aksiList = LogKalibrasi::distinct()->pluck('aksi')->filter();
        $userList = User::select('id', 'nama')->get();
        
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'table_html' => view('log-kalibrasi.partials.table', compact('logs'))->render(),
                'pagination_html' => $logs->appends($request->query())->links('pagination::bootstrap-5')->toHtml(),
                'total' => $logs->total(),
                'timestamp' => now()->format('H:i:s')
            ]);
        }
        
        return view('log-kalibrasi.index', compact('logs', 'aksiList', 'userList'));
    }

    /**
     * AJAX endpoint untuk load data
     */
    public function ajax(Request $request)
    {
        $query = LogKalibrasi::with('user');
        
        // Apply filters
        if ($request->filled('aksi')) {
            $query->where('aksi', $request->aksi);
        }
        
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        
        if ($request->filled('logable_id')) {
            $logableIdVal = ltrim(trim($request->logable_id), '#');
            $query->where('kalibrasi_id', 'like', '%' . $logableIdVal . '%');
        }
        
        if ($request->filled('tanggal_dari')) {
            $query->whereDate('created_at', '>=', $request->tanggal_dari);
        }
        
        if ($request->filled('tanggal_sampai')) {
            $query->whereDate('created_at', '<=', $request->tanggal_sampai);
        }
        
        $logs = $query->orderBy('created_at', 'desc')->paginate(20);
        
        return response()->json([
            'success' => true,
            'table_html' => view('log-kalibrasi.partials.table', compact('logs'))->render(),
            'pagination_html' => $logs->appends($request->query())->links('pagination::bootstrap-5')->toHtml(),
            'total' => $logs->total(),
            'timestamp' => now()->format('H:i:s')
        ]);
    }

    /**
     * Tampilkan log berdasarkan ID kalibrasi
     */
    public function showByKalibrasi($kalibrasi_id)
    {
        $logs = LogKalibrasi::where('kalibrasi_id', $kalibrasi_id)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('log-kalibrasi.per-kalibrasi', compact('logs'));
    }

    /**
     * Export data
     */
    public function export(Request $request)
    {
        $query = LogKalibrasi::with('user');
        
        // Apply filters
        if ($request->filled('aksi')) {
            $query->where('aksi', $request->aksi);
        }
        
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        
        if ($request->filled('logable_id')) {
            $logableIdVal = ltrim(trim($request->logable_id), '#');
            $query->where('kalibrasi_id', 'like', '%' . $logableIdVal . '%');
        }
        
        if ($request->filled('tanggal_dari')) {
            $query->whereDate('created_at', '>=', $request->tanggal_dari);
        }
        
        if ($request->filled('tanggal_sampai')) {
            $query->whereDate('created_at', '<=', $request->tanggal_sampai);
        }
        
        $logs = $query->orderBy('created_at', 'desc')->get();
        
        // Format data untuk export
        $exportData = $logs->map(function($log) {
            return [
                'Tanggal' => $log->created_at->format('d/m/Y H:i:s'),
                'Aksi' => $log->aksi,
                'Deskripsi' => $log->deskripsi,
                'Kalibrasi ID' => $log->kalibrasi_id,
                'User' => $log->user ? $log->user->nama : 'System',
                'IP Address' => $log->alamat_ip,
            ];
        });
        
        return response()->json($exportData);
    }

    /**
     * Hapus log lama (lebih dari 90 hari)
     */
    public function bersihkan()
    {
        $tanggal = now()->subDays(90);
        $terhapus = LogKalibrasi::where('created_at', '<', $tanggal)->delete();
        
        return redirect()->route('log-kalibrasi.index')
            ->with('success', 'Berhasil menghapus ' . $terhapus . ' log yang lebih dari 90 hari');
    }

    /**
     * Tampilkan detail log
     */
    public function show($id)
    {
        // Coba dulu dari ActivityLog (untuk log dari create.blade.php / activity logs)
        $log = \App\Models\ActivityLog::with('performer')->find($id);

        if ($log) {
            // Decode metadata jika masih string
            $metadata = $log->metadata ?? [];
            if (is_string($metadata)) {
                $metadata = json_decode($metadata, true) ?? [];
            }
            return view('log-kalibrasi.show', compact('log', 'metadata'));
        }

        // Fallback: coba dari LogKalibrasi lama
        $log = LogKalibrasi::with('user')->findOrFail($id);
        $metadata = [];
        return view('log-kalibrasi.show', compact('log', 'metadata'));
    }
}