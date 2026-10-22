<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SpeedTestController extends Controller
{
    /**
     * Endpoint untuk latency (ping) test.
     */
    public function ping(Request $request)
    {
        return response()->json([
            'status'    => 'ok',
            'server_time' => microtime(true),
            'client_ip' => $request->ip(),
        ])->withHeaders([
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma'        => 'no-cache',
            'Expires'       => 'Sat, 01 Jan 2000 00:00:00 GMT',
        ]);
    }

    /**
     * Endpoint download payload untuk mengukur kecepatan download (throughput).
     * Menghasilkan binary data berukuran tertentu (default ~1MB / 1048576 bytes).
     */
    public function download(Request $request)
    {
        // Ukuran payload dalam byte (default 1MB = 1048576 bytes, max 5MB)
        $size = (int) $request->input('size', 1048576);
        if ($size < 65536) {
            $size = 65536; // Min 64KB
        }
        if ($size > 5242880) {
            $size = 5242880; // Max 5MB
        }

        // Generate string chunk sebesar ukuran yang diminta
        $chunk = str_repeat('X', 1024);
        $totalChunks = (int) ceil($size / 1024);

        return response()->stream(function () use ($chunk, $totalChunks) {
            for ($i = 0; $i < $totalChunks; $i++) {
                echo $chunk;
                if (ob_get_level() > 0) {
                    ob_flush();
                }
                flush();
            }
        }, 200, [
            'Content-Type'        => 'application/octet-stream',
            'Content-Length'      => $size,
            'Cache-Control'       => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma'              => 'no-cache',
            'Expires'             => 'Sat, 01 Jan 2000 00:00:00 GMT',
            'Access-Control-Allow-Origin' => '*',
        ]);
    }

    /**
     * Endpoint upload payload untuk mengukur kecepatan upload (throughput upstream).
     */
    public function upload(Request $request)
    {
        return response()->json([
            'status'        => 'ok',
            'received_bytes'=> strlen($request->getContent()),
            'server_time'   => microtime(true),
        ])->withHeaders([
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Access-Control-Allow-Origin' => '*',
        ]);
    }

    /**
     * Simpan hasil speed test ke tabel activity_logs.
     */
    public function logResult(Request $request)
    {
        try {
            $validated = $request->validate([
                'download_speed'  => 'required|numeric',
                'upload_speed'    => 'nullable|numeric',
                'latency'         => 'nullable|numeric',
                'jitter'          => 'nullable|numeric',
                'status_quality'  => 'nullable|string',
                'ip_address'      => 'nullable|string',
                'location'        => 'nullable|array',
                'device_info'     => 'nullable|array',
                'source'          => 'nullable|string',
            ]);

            $downloadSpeed = number_format((float) $validated['download_speed'], 2);
            $uploadSpeed = isset($validated['upload_speed']) ? number_format((float) $validated['upload_speed'], 2) : '-';
            $latency = isset($validated['latency']) ? number_format((float) $validated['latency'], 1) : '-';
            $statusQuality = $validated['status_quality'] ?? 'OK';
            $location = $validated['location'] ?? [];
            $deviceInfo = $validated['device_info'] ?? [];

            // Susun nama lokasi yang terbaca jelas (Full Address / Kecamatan / Kota / Provinsi)
            $fullAddress = $location['full_address'] ?? $location['address'] ?? null;
            $city = $location['city'] ?? null;
            $district = $location['district'] ?? $location['subdistrict'] ?? null;
            $region = $location['region'] ?? null;
            $country = $location['country'] ?? 'Indonesia';
            $isp = $location['isp'] ?? $location['org'] ?? null;
            $networkType = $deviceInfo['network_type'] ?? null;

            if ($fullAddress) {
                $locationStr = $fullAddress;
            } else {
                $locationParts = array_filter([$district, $city, $region, $country]);
                $locationStr = !empty($locationParts) ? implode(', ', $locationParts) : 'Lokasi Tidak Terdeteksi';
            }

            if ($isp) {
                $locationStr .= " (Provider: {$isp})";
            }
            if ($networkType) {
                $locationStr .= " [{$networkType}]";
            }

            $user = Auth::user();
            $performerName = $user ? $user->nama : 'Guest (Halaman Login)';

            $description = "⚡ Speed Test: Download {$downloadSpeed} Mbps | Upload {$uploadSpeed} Mbps | Ping {$latency} ms | Kualitas: {$statusQuality} | Lokasi: {$locationStr}";

            $metadata = [
                'download_speed_mbps' => (float) $validated['download_speed'],
                'upload_speed_mbps'   => isset($validated['upload_speed']) ? (float) $validated['upload_speed'] : null,
                'latency_ms'          => isset($validated['latency']) ? (float) $validated['latency'] : null,
                'jitter_ms'           => isset($validated['jitter']) ? (float) $validated['jitter'] : null,
                'status_quality'      => $statusQuality,
                'client_ip'           => $validated['ip_address'] ?? $request->ip(),
                'location'            => $location,
                'device_info'         => $deviceInfo,
                'tested_at'           => now()->toDateTimeString(),
                'source'              => $validated['source'] ?? 'login_page',
                'user_info'           => [
                    'id'   => $user?->id,
                    'name' => $user?->nama,
                    'role' => $user?->role,
                ],
            ];

            $log = ActivityLog::create([
                'activity_type' => 'speed_test',
                'description'   => $description,
                'logable_type'  => null,
                'logable_id'    => null,
                'old_data'      => null,
                'new_data'      => null,
                'performed_by'  => $user?->id ?? 1, // default user 1 atau user yang sedang login
                'ip_address'    => $request->ip(),
                'user_agent'    => $request->userAgent(),
                'method'        => $request->method(),
                'url'           => $request->fullUrl(),
                'metadata'      => $metadata,
                'batch_uuid'    => session('activity_batch_uuid', Str::uuid()->toString()),
            ]);

            return response()->json([
                'status'  => 'success',
                'message' => 'Speed test logged successfully',
                'log_id'  => $log->id,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error logging speed test: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'status'  => 'error',
                'message' => 'Gagal mencatat log speed test: ' . $e->getMessage(),
            ], 500);
        }
    }
}
