<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'nik' => 'admin',
            'nama' => 'Administrator',
            'password' => bcrypt('password'),
            'role' => 'super admin',
        ]);

        \App\Models\User::create([
            'nik' => 'user001',
            'nama' => 'User Demo',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);
    }
}
