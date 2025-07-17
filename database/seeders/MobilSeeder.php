<?php

namespace Database\Seeders;

use App\Models\Mobil;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MobilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mobilData = [
            ['merek' => 'Toyota Avanza', 'harga' => 220000000, 'kapasitas_mesin' => 1300],
            ['merek' => 'Honda Jazz', 'harga' => 280000000, 'kapasitas_mesin' => 1500],
            ['merek' => 'Mitsubishi Pajero', 'harga' => 540000000, 'kapasitas_mesin' => 2500],
            ['merek' => 'Toyota Innova', 'harga' => 350000000, 'kapasitas_mesin' => 2000],
            ['merek' => 'Honda CR-V', 'harga' => 450000000, 'kapasitas_mesin' => 1500],
            ['merek' => 'BMW X5', 'harga' => 1200000000, 'kapasitas_mesin' => 3000],
            ['merek' => 'Suzuki Ertiga', 'harga' => 240000000, 'kapasitas_mesin' => 1400],
            ['merek' => 'Daihatsu Xenia', 'harga' => 200000000, 'kapasitas_mesin' => 1300],
            ['merek' => 'Toyota Fortuner', 'harga' => 520000000, 'kapasitas_mesin' => 2700],
            ['merek' => 'Honda Civic', 'harga' => 580000000, 'kapasitas_mesin' => 1500],
        ];

        foreach ($mobilData as $data) {
            Mobil::create($data);
        }
    }
}
