<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin account if not exists
        if (!User::where('email', 'admin@admin.com')->exists()) {
            User::create([
                'name' => 'Administrator',
                'email' => 'admin@admin.com',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'admin',
            ]);
        }

        // Create sample user account if not exists
        if (!User::where('email', 'user@example.com')->exists()) {
            User::create([
                'name' => 'Sample User',
                'email' => 'user@gmail.com',
                'password' => \Illuminate\Support\Facades\Hash::make('12345678'),
                'role' => 'user',
                'nik' => '1234567890123456', // Sample NIK
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1990-01-01',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Sample No. 123, Jakarta',
                'phone' => '081234567890',
            ]);
        }
    }
}
