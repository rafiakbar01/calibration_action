<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UpdateLastActivity
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            // Cek apakah session token masih valid
            $sessionToken = session('session_token');
            if ($user->session_token !== $sessionToken) {
                Auth::logout();
                $request->session()->invalidate();
                return redirect()->route('login')->withErrors([
                    'nik' => 'Sesi Anda telah berakhir karena login di perangkat lain.'
                ]);
            }
            
            // Update last activity
            $user->update(['last_activity' => Carbon::now()]);
        }
        
        return $next($request);
    }
}