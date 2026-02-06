<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    private $allowedRoles = ['super admin', 'teknisi', 'checker', 'approver', 'user'];

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
            Auth::login($user, $request->boolean('remember'));
            $request->session()->regenerate();
            return redirect('/dashboard');
        }

        return back()->withErrors([
            'nik' => 'NIK, password, atau role tidak cocok.',
        ])->withInput($request->only('nik', 'role'));
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
        ]);

        Auth::login($user);
        
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}