<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'nik',
        'nama',
        'password',
        'role',
        'foto',
        'session_token',
         'last_activity',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    // Accessor untuk mendapatkan URL foto
    public function getFotoUrlAttribute()
    {
        if ($this->foto) {
            return asset('profile_foto/' . $this->foto);
        }
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->nama) . '&background=4e73df&color=fff&size=128';
    }

    // Accessor untuk mendapatkan path lengkap file
    public function getFotoPathAttribute()
    {
        if ($this->foto) {
            return public_path('profile_foto/' . $this->foto);
        }
        return null;
    }
}
