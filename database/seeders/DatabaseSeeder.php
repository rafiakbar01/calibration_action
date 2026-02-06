<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Daftar user dengan role
        $users = [
            [
                'nama'     => 'Super Admin',
                'nik' => 'admin',
                'password' => Hash::make('admin123'),
                'role'     => 'super admin',
            ],
            [
                'nama'     => 'Teknisi',
                'nik' => 'pas-003',
                'password' => Hash::make('teknisi123'),
                'role'     => 'teknisi',
            ],
            [
                'nama'     => 'Checker',
                'nik' => 'pas-001',
                'password' => Hash::make('checker123'),
                'role'     => 'checker',
            ],
            [
                'nama'     => 'Approver',
                'nik' => 'pas-002',
                'password' => Hash::make('aprover123'),
                'role'     => 'approver',
            ],
            
        ];

        // Insert semua user
        foreach ($users as $userData) {
            User::create($userData);
        }

        // Opsional: buat 10 user dummy dengan factory
        // User::factory(10)->create();
    }
}