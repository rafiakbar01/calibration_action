<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

class SingleSession
{
    /**
     * Jumlah jam sebelum session expired karena tidak aktif
     */
    protected $sessionTimeout = 2; // 2 jam (sesuaikan dengan kebutuhan)

    /**
     * Handle an incoming request.
     *
     * Cek apakah session token di sesi aktif cocok dengan session_token
     * yang tersimpan di database. Jika tidak cocok, berarti ada login baru
     * dari device lain — session ini dimatikan.
     * 
     * Juga update last activity user untuk tracking session timeout
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            // PENTING: Gunakan ->fresh() untuk mendapatkan data terbaru dari DB
            // Auth::user() bisa mengembalikan objek cached yang session_token-nya belum update
            $user = Auth::user()->fresh();
            $sessionToken = $request->session()->get('session_token');

            // CEK APAKAH SESSION SUDAH EXPIRED KARENA TIDAK AKTIF
            if ($user->last_activity) {
                $lastActivity = Carbon::parse($user->last_activity);
                $hoursInactive = $lastActivity->diffInHours(Carbon::now());
                
                // Jika sudah melebihi batas timeout, logout paksa
                if ($hoursInactive >= $this->sessionTimeout) {
                    // Hapus session token dan last activity
                    $user->update([
                        'session_token' => null,
                        'last_activity' => null
                    ]);
                    
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                    
                    return redirect()->route('login')->withErrors([
                        'session' => '⏰ Sesi Anda telah berakhir karena tidak aktif selama ' . $this->sessionTimeout . ' jam. Silakan login kembali.',
                    ]);
                }
            }

            // CEK APAKAH ADA LOGIN DARI DEVICE LAIN
            if ($user->session_token && $sessionToken !== $user->session_token) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('login')->withErrors([
                    'session' => '⚠️ Akun Anda telah digunakan di perangkat lain. Silakan login kembali.',
                ]);
            }

            // UPDATE LAST ACTIVITY - tandanya user masih aktif
            // Gunakan Auth::user() langsung untuk update (tanpa fresh karena kita sudah punya data)
            Auth::user()->update([
                'last_activity' => Carbon::now()
            ]);
        }

        return $next($request);
    }
}