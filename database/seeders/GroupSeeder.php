<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = [
            [
                'name' => 'Gelombang 1',
                'description' => 'Mahasiswa PKL Gelombang 1 - Januari s/d Maret',
                'is_active' => true,
            ],
            [
                'name' => 'Gelombang 2',
                'description' => 'Mahasiswa PKL Gelombang 2 - April s/d Juni',
                'is_active' => true,
            ],
            [
                'name' => 'Gelombang 3',
                'description' => 'Mahasiswa PKL Gelombang 3 - Juli s/d September',
                'is_active' => true,
            ],
            [
                'name' => 'Umum',
                'description' => 'Grup umum untuk mahasiswa lainnya',
                'is_active' => true,
            ],
        ];

        foreach ($groups as $group) {
            Group::firstOrCreate(
                ['name' => $group['name']],
                [
                    'description' => $group['description'],
                    'is_active' => $group['is_active'],
                ]
            );
        }
    }
}
