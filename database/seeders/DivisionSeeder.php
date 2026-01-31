<?php

namespace Database\Seeders;

use App\Models\Division;
use App\Models\Location;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Bidang Preservasi dan Pengolahan Bahan Perpustakaan
        $preservasi = Division::firstOrCreate(['name' => 'Bidang Preservasi dan Pengolahan Bahan Perpustakaan']);
        Location::firstOrCreate(['name' => 'Preservasi'], ['division_id' => $preservasi->id, 'is_active' => true]);

        // 2. Bidang Layanan dan Pengembangan Perpustakaan
        $layananDivision = Division::firstOrCreate(['name' => 'Bidang Layanan dan Pengembangan Perpustakaan']);

        $layananLocations = [
            'Ruang Baca Anak',
            'Drive Thru',
            'Ruang Baca Umum',
            'POCADI',
            'Pojok Baca MPP',
            'Perpustakaan MPP',
            'Perpustakaan Keliling',
            'Baca Ditempat',
            'Peminjaman Lantai 2',
            'Penjajaran Buku lt 2'
        ];

        foreach ($layananLocations as $locName) {
            Location::firstOrCreate(
                ['name' => $locName],
                [
                    'division_id' => $layananDivision->id,
                    'is_active' => true
                ]
            );
        }

        // 3. Bidang Pengelolaan Arsip
        $arsip = Division::firstOrCreate(['name' => 'Bidang Pengelolaan Arsip']);
        Location::firstOrCreate(['name' => 'Depo Arsip'], ['division_id' => $arsip->id, 'is_active' => true]);
    }
}
