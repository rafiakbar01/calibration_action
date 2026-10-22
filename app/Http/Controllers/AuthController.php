<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Helpers\LogHelper;
use Carbon\Carbon;

class AuthController extends Controller
{
    private $allowedRoles = ['super admin', 'teknisi', 'checker', 'approver', 'ppic', 'user'];
    private $sessionTimeout = 2; // Sama dengan di middleware

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $request->validate([
        'nik'      => ['required', 'string', 'max:255'],
        'password' => ['required', 'string'],
        'role'     => ['required', 'string', 'in:' . implode(',', $this->allowedRoles)],
    ], [
        'nik.required' => 'NIK wajib diisi.',
        'password.required' => 'Password wajib diisi.',
        'role.required' => 'Role wajib dipilih.',
        'role.in' => 'Role tidak valid.',
    ]);

    $nik = $request->nik;
    $password = $request->password;
    $role = $request->role;

    $user = User::where('nik', $nik)->first();

    if (
        $user &&
        Hash::check($password, $user->password) &&
        strtolower($user->role) === strtolower($role)
    ) {
        // CEK APAKAH ADA SESSION AKTIF DAN BELUM EXPIRED
        if ($user->session_token !== null) {
            // Cek apakah session sudah expired berdasarkan last_activity
            if ($user->last_activity) {
                $lastActivity = Carbon::parse($user->last_activity);
                $now = Carbon::now();
                
                // Hitung total menit tidak aktif
                $totalInactiveMinutes = $lastActivity->diffInMinutes($now);
                $inactiveHours = floor($totalInactiveMinutes / 60);
                $inactiveMinutes = $totalInactiveMinutes % 60;
                
                // Hitung total menit batas timeout
                $timeoutMinutes = $this->sessionTimeout * 60;
                
                if ($totalInactiveMinutes >= $timeoutMinutes) {
                    // Session expired, hapus token agar bisa login lagi
                    $user->update([
                        'session_token' => null,
                        'last_activity' => null
                    ]);
                    
                    LogHelper::log('auto_logout', "User '{$user->nama}' otomatis logout karena tidak aktif selama " . $this->formatDuration($inactiveHours, $inactiveMinutes) . ".");
                    
                    // Lanjutkan ke proses login
                    return $this->processLogin($user, $request);
                } else {
                    // Session masih aktif
                    // Format waktu terakhir aktif
                    $lastActiveText = $this->formatDuration($inactiveHours, $inactiveMinutes) . ' yang lalu';
                    
                    return back()->withErrors([
                        'nik' => '⚠️ Akun ini sedang digunakan di perangkat lain. ' .
                                'Terakhir aktif: ' . $lastActiveText . '. ' .
                                'Hubungi pemilik akun untuk logout manual.',
                    ])->withInput($request->only('nik', 'role'));
                }
            } else {
                // Jika last_activity null, anggap session sudah expired
                $user->update([
                    'session_token' => null,
                    'last_activity' => null
                ]);
                
                return $this->processLogin($user, $request);
            }
        }

        // Tidak ada session aktif atau session expired, langsung login
        return $this->processLogin($user, $request);
    }

    return back()->withErrors([
        'nik' => 'NIK, password, atau role tidak cocok.',
    ])->withInput($request->only('nik', 'role'));
}

/**
 * Format durasi waktu dalam format yang mudah dibaca
 */
private function formatDuration($hours, $minutes)
{
    if ($hours > 0 && $minutes > 0) {
        return $hours . ' jam ' . $minutes . ' menit';
    } elseif ($hours > 0) {
        return $hours . ' jam';
    } elseif ($minutes > 0) {
        return $minutes . ' menit';
    } else {
        return 'beberapa detik';
    }
}

    private function processLogin($user, $request)
    {
        Auth::login($user, $request->boolean('remember'));
        $request->session()->regenerate();

        // Buat & simpan token sesi ke DB dan session
        $sessionToken = \Illuminate\Support\Str::random(60);
        $user->update([
            'session_token' => $sessionToken,
            'last_activity' => Carbon::now()
        ]);
        
        $request->session()->put('session_token', $sessionToken);

        // Log Aktivitas dengan data speed test dan lokasi jika ada
        $speed = $request->input('speed_test_speed');
        $upload = $request->input('speed_test_upload');
        $ping = $request->input('speed_test_ping');
        $location = $request->input('speed_test_location');
        $isp = $request->input('speed_test_isp');
        $metaRaw = $request->input('speed_test_meta');

        $loginDescription = "User '{$user->nama}' berhasil login ke sistem.";
        $metadata = [
            'user_id' => $user->id,
            'nama'    => $user->nama,
            'nik'     => $user->nik,
            'role'    => $user->role,
        ];

        if ($speed || $upload || $location) {
            $extraDesc = [];
            if ($speed) {
                $speedText = "Unduh: {$speed} Mbps";
                if ($upload) $speedText .= " | Unggah: {$upload} Mbps";
                if ($ping) $speedText .= " (Ping: {$ping}ms)";
                $extraDesc[] = $speedText;
                $metadata['speed_test_download_mbps'] = (float) $speed;
                if ($upload) $metadata['speed_test_upload_mbps'] = (float) $upload;
                if ($ping) $metadata['speed_test_ping_ms'] = (float) $ping;
            }
            if ($location) {
                $locFull = $location . ($isp ? " ({$isp})" : '');
                $extraDesc[] = "Lokasi: {$locFull}";
                $metadata['location_string'] = $locFull;
            }
            $loginDescription .= " [" . implode(' | ', $extraDesc) . "]";
        }

        if ($metaRaw) {
            $parsedMeta = is_string($metaRaw) ? json_decode($metaRaw, true) : $metaRaw;
            if (is_array($parsedMeta)) {
                $metadata['speed_test_details'] = $parsedMeta;
            }
        }

        LogHelper::log('login', $loginDescription, $user, null, null, $metadata);

        if (strtolower($user->role) === 'ppic') {
            return redirect()->route('dashboard.control');
        }

        return redirect()->intended('dashboard');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'nama'     => ['required', 'string', 'max:255'],
            'nik'      => ['required', 'string', 'max:255', 'unique:users,nik'],
            'password' => ['required', 'confirmed', 'min:6'],
            'role'     => ['required', 'in:' . implode(',', $this->allowedRoles)],
        ], [
            'nik.unique' => 'NIK sudah terdaftar.',
            'role.in'    => 'Role tidak valid.',
        ]);

        $user = User::create([
            'nama'     => $data['nama'],
            'nik'      => $data['nik'],
            'password' => Hash::make($data['password']),
            'role'     => $data['role'],
            'session_token' => null,
            'last_activity' => null
        ]);

        Auth::login($user);
        
        // Set session token dan last activity untuk user baru
        $sessionToken = \Illuminate\Support\Str::random(60);
        $user->update([
            'session_token' => $sessionToken,
            'last_activity' => Carbon::now()
        ]);
        
        session()->put('session_token', $sessionToken);
        
        if (strtolower($user->role) === 'ppic') {
            return redirect()->route('dashboard.control');
        }

        return redirect()->intended('dashboard');
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            // Log Aktivitas sebelum logout
            LogHelper::log('logout', "User '{$user->nama}' telah logout dari sistem.");
            
            // Clear session token dan last activity di database
            $user->update([
                'session_token' => null,
                'last_activity' => null
            ]);
        }
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}