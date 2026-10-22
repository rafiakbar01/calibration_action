<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Helpers\LogHelper;

class ChangePasswordController extends Controller
{
    /**
     * Show the change password form.
     */
    public function showChangePasswordForm()
    {
        return view('auth.change-password');
    }

    /**
     * Change the user's password.
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                function ($attribute, $value, $fail) use ($request) {
                    if (Hash::check($value, Auth::user()->password)) {
                        $fail('Password baru tidak boleh sama dengan password lama.');
                    }
                }
            ],
        ]);
        
        $user = Auth::user();
        
        // Check current password
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai']);
        }
        
        // Update password
        $user->password = $request->new_password;
        $user->save();
        
        LogHelper::log('change_password', "User '{$user->nama}' mengubah password akun", $user);
        
        return redirect()->route('password.change')
            ->with('success', 'Password berhasil diubah!');
    }
}