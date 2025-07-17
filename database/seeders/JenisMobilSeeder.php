<?php

namespace Database\Seeders;

use App\Models\JenisMobil;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisMobilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenisTypes = [
            'Kapasitas Mesin Kecil',
            'Kapasitas Mesin Menengah', 
            'Kapasitas Mesin Besar'
        ];

        foreach ($jenisTypes as $jenis) {
            JenisMobil::firstOrCreate(['nama_jenis' => $jenis]);
        }
    }
}
