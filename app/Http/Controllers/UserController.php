<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }

    public function index()
    {
        $users = User::select('id', 'nik', 'nama', 'role')->get();
        return view('register-user', compact('users'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:users,nik',
            'nama' => 'required',
            'role' => 'required|in:super admin,teknisi,checker,approver,user',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'User berhasil ditambahkan!']);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'nik' => 'required|unique:users,nik,' . $user->id,
            'nama' => 'required',
            'role' => 'required|in:super admin,teknisi,checker,approver,user',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $data = $request->only('nik', 'nama', 'role');
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return response()->json(['message' => 'User berhasil diperbarui!']);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'User berhasil dihapus!']);
    }
}