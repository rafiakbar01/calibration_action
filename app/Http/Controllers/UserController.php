<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Helpers\LogHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function dashboard()
    {
        if (isPpic()) {
            return redirect()->route('dashboard.control');
        }

        return view('dashboard');
    }

    public function index()
    {
        // CEK ROLE - HANYA SUPER ADMIN
        if (!isSuperAdmin()) {
            abort(403, 'Anda Tidak Mempunyai Akses Ke Halaman Ini');
        }

        $users = User::select('id', 'nik', 'nama', 'role', 'foto')->get();
        return view('register-user', compact('users'));
    }
    
    public function store(Request $request)
    {
        // CEK ROLE - HANYA SUPER ADMIN
        if (!isSuperAdmin()) {
            return response()->json(['message' => 'Unauthorized. Hanya super admin yang dapat menambah user.'], 403);
        }

        $request->validate([
            'nik' => 'required|unique:users,nik',
            'nama' => 'required',
            'role' => 'required|in:super admin,teknisi,checker,approver,ppic,user',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        LogHelper::log('create_user', "Menambahkan user baru dengan NIK {$request->nik} ({$request->nama})", $user);

        return response()->json(['message' => 'User berhasil ditambahkan!']);
    }

    public function update(Request $request, User $user)
    {
        // CEK ROLE - HANYA SUPER ADMIN
        if (!isSuperAdmin()) {
            return response()->json(['message' => 'Unauthorized. Hanya super admin yang dapat mengupdate user.'], 403);
        }

        $request->validate([
            'nik' => 'required|unique:users,nik,' . $user->id,
            'nama' => 'required',
            'role' => 'required|in:super admin,teknisi,checker,approver,ppic,user',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $data = [
            'nik' => $request->nik,
            'nama' => $request->nama,
            'role' => $request->role
        ];
        
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        
        LogHelper::log('update_user', "Mengupdate data user {$user->nik} ({$user->nama})", $user);

        return response()->json(['message' => 'User berhasil diperbarui!']);
    }

    public function destroy(User $user)
    {
        // CEK ROLE - HANYA SUPER ADMIN
        if (!isSuperAdmin()) {
            return response()->json(['message' => 'Unauthorized. Hanya super admin yang dapat menghapus user.'], 403);
        }

        // Cegah super admin menghapus dirinya sendiri
        if ($user->id === auth()->id()) {
            return response()->json(['message' => 'Tidak dapat menghapus akun sendiri.'], 400);
        }

        // Hapus foto jika ada
        if ($user->foto && file_exists(public_path('profile_foto/' . $user->foto))) {
            unlink(public_path('profile_foto/' . $user->foto));
        }
        
        LogHelper::log('delete_user', "Menghapus user {$user->nik} ({$user->nama})");
        $user->delete();
        
        return response()->json(['message' => 'User berhasil dihapus!']);
    }

    public function updatePhoto(Request $request)
    {
        // CEK ROLE - HANYA SUPER ADMIN
        if (!isSuperAdmin()) {
            return response()->json(['message' => 'Unauthorized. Hanya super admin yang dapat mengelola foto user.'], 403);
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);
    
        $user = User::findOrFail($request->user_id);
        
        // Hapus foto lama jika ada
        $this->deleteOldPhoto($user);
        
        // Generate nama file unik
        $fileName = $this->generateFileName($request->file('foto'), $user);
        
        // Upload ke public/profile_foto
        $path = 'profile_foto/';
        $request->file('foto')->move(public_path($path), $fileName);
        
        // Update database dengan nama file saja
        $user->foto = $fileName;
        $user->save();
        
        LogHelper::log('update_photo', "Mengupdate foto profil user {$user->nama}", $user);
        
        return response()->json(['message' => 'Foto profil berhasil diupload!']);
    }

    public function deletePhoto(Request $request)
    {
        // CEK ROLE - HANYA SUPER ADMIN
        if (!isSuperAdmin()) {
            return response()->json(['message' => 'Unauthorized. Hanya super admin yang dapat menghapus foto user.'], 403);
        }

        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);
    
        $user = User::findOrFail($request->user_id);
        
        if ($user->foto) {
            // Hapus file dari public/profile_foto
            $this->deleteOldPhoto($user);
            
            // Update database
            $user->foto = null;
            $user->save();
            
            LogHelper::log('delete_photo', "Menghapus foto profil user {$user->nama}", $user);
            
            return response()->json(['message' => 'Foto profil berhasil dihapus!']);
        }
        
        return response()->json(['message' => 'Tidak ada foto profil untuk dihapus.'], 400);
    }
    
    private function generateFileName($file, $user)
    {
        $extension = $file->getClientOriginalExtension();
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        
        // Format: nik_nama_timestamp_random.extension
        $safeName = Str::slug($user->nama);
        $timestamp = time();
        $random = Str::random(6);
        
        return "{$user->nik}_{$safeName}_{$timestamp}_{$random}.{$extension}";
    }
    
    private function deleteOldPhoto($user)
    {
        if ($user->foto) {
            $filePath = public_path('profile_foto/' . $user->foto);
            
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
    }
    
     /**
     * Get password hash for display info
     */
    public function getPasswordHash($id)
    {
        try {
            $user = User::findOrFail($id);
            
            return response()->json([
                'success' => true,
                'hash' => $user->password,
                'message' => 'Hash password berhasil diambil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ], 404);
        }
    }
    
    /**
     * Reset user password
     */
    public function resetPassword(Request $request, $id)
    {
        try {
            $request->validate([
                'password' => 'required|min:6'
            ]);
            
            $user = User::findOrFail($id);
            $user->password = Hash::make($request->password);
            $user->save();
            
            // Optional: Clear session token setelah reset password
            $user->session_token = null;
            $user->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Password berhasil direset'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal reset password: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Clear session token
     */
    public function clearSessionToken($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->session_token = null;
            $user->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Session token berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus session token'
            ], 500);
        }
    }

}