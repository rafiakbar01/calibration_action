<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProfilePhotoController extends Controller
{
    /**
     * Show the form for editing the profile photo.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.photo', compact('user'));
    }

    /**
     * Update the user's profile photo.
     */
    public function update(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Ganti nama field
        ]);

        $user = Auth::user();
        
        // Hapus foto lama jika ada
        $this->deleteOldPhoto($user);
        
        // Generate nama file unik
        $fileName = $this->generateFileName($request->file('foto'));
        
        // Upload ke public/profile_foto
        $path = 'profile_foto/';
        $request->file('foto')->move(public_path($path), $fileName);
        
        // Update database dengan nama file saja (kolom 'foto')
        $user->foto = $fileName;
        $user->save();
        
        return redirect()->route('profile.photo')
            ->with('success', 'Foto profil berhasil diperbarui!');
    }

    /**
     * Remove the user's profile photo.
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();
        
        if ($user->foto) { // Ganti dari $user->foto_profil menjadi $user->foto
            // Hapus file dari public/profile_foto
            $this->deleteOldPhoto($user);
            
            // Update database
            $user->foto = null;
            $user->save();
            
            return redirect()->route('profile.photo')
                ->with('success', 'Foto profil berhasil dihapus!');
        }
        
        return redirect()->route('profile.photo')
            ->with('error', 'Tidak ada foto profil untuk dihapus.');
    }

    /**
     * Generate unique filename for uploaded photo.
     */
    private function generateFileName($file)
    {
        $extension = $file->getClientOriginalExtension();
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $user = Auth::user();
        
        // Format: nik_nama_timestamp_random.extension
        $safeName = Str::slug($user->nama);
        $timestamp = time();
        $random = Str::random(6);
        
        return "{$user->nik}_{$safeName}_{$timestamp}_{$random}.{$extension}";
    }

    /**
     * Delete old photo file from public/profile_foto folder.
     */
    private function deleteOldPhoto($user)
    {
        if ($user->foto) { // Ganti dari $user->foto_profil menjadi $user->foto
            $filePath = public_path('profile_foto/' . $user->foto);
            
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }
    }
}