<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user's profile.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'nik' => 'required|string|max:20|unique:users,nik,' . $user->id,
            'nama' => 'required|string|max:255',
        ]);
        
        $user->update($validated);
        
        return redirect()->route('profile.edit')
            ->with('success', 'Profile berhasil diperbarui!');
    }
}