<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Location;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        User::create([
            'name' => 'Admin PKL',
            'email' => 'admin@pkl.local',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Sample Mahasiswa
        User::create([
            'name' => 'Mahasiswa Contoh',
            'email' => 'mahasiswa@pkl.local',
            'password' => Hash::make('password'),
            'role' => 'mahasiswa',
            'nim' => '1234567890',
            'institution' => 'Universitas Contoh',
            'phone' => '081234567890',
            'start_date' => now()->subDays(30),
            'end_date' => now()->addDays(30),
        ]);

        // Create Sample Locations
        Location::create([
            'name' => 'Layanan Sirkulasi',
            'description' => 'Layanan peminjaman dan pengembalian buku',
            'is_active' => true,
        ]);

        Location::create([
            'name' => 'Layanan Referensi',
            'description' => 'Layanan referensi dan informasi',
            'is_active' => true,
        ]);

        Location::create([
            'name' => 'Layanan Teknologi Informasi',
            'description' => 'Layanan teknologi informasi dan digitalisasi',
            'is_active' => true,
        ]);

        Location::create([
            'name' => 'Layanan Kearsipan',
            'description' => 'Layanan pengelolaan arsip',
            'is_active' => true,
        ]);
    }
}

