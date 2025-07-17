<?php

namespace App\Http\Controllers;

use App\Models\JenisMobil;
use App\Models\Mobil;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMobils = Mobil::count();
        $totalJenisMobils = JenisMobil::count();
        
        $mobilsByJenis = JenisMobil::withCount('mobils')->get();
        
        // Data untuk grafik pie - distribusi mobil per jenis
        $pieChartData = [
            'labels' => $mobilsByJenis->pluck('nama_jenis')->toArray(),
            'data' => $mobilsByJenis->pluck('mobils_count')->toArray(),
            'colors' => ['#3B82F6', '#10B981', '#8B5CF6', '#F59E0B', '#EF4444', '#6B7280']
        ];
        
        // Data untuk grafik bar - distribusi harga
        $hargaRanges = [
            'Di bawah 200 Juta' => Mobil::where('harga', '<', 200000000)->count(),
            '200-500 Juta' => Mobil::whereBetween('harga', [200000000, 500000000])->count(),
            '500 Juta - 1 Milyar' => Mobil::whereBetween('harga', [500000000, 1000000000])->count(),
            'Di atas 1 Milyar' => Mobil::where('harga', '>', 1000000000)->count(),
        ];
        
        $barChartData = [
            'labels' => array_keys($hargaRanges),
            'data' => array_values($hargaRanges),
            'colors' => ['#10B981', '#3B82F6', '#8B5CF6', '#EF4444']
        ];
        
        // Data untuk grafik line - distribusi kapasitas mesin
        $kapasitasRanges = [
            'Di bawah 1500cc' => Mobil::where('kapasitas_mesin', '<', 1500)->count(),
            '1500-2000cc' => Mobil::whereBetween('kapasitas_mesin', [1500, 2000])->count(),
            '2000-2500cc' => Mobil::whereBetween('kapasitas_mesin', [2000, 2500])->count(),
            '2500-3000cc' => Mobil::whereBetween('kapasitas_mesin', [2500, 3000])->count(),
            'Di atas 3000cc' => Mobil::where('kapasitas_mesin', '>', 3000)->count(),
        ];
        
        $lineChartData = [
            'labels' => array_keys($kapasitasRanges),
            'data' => array_values($kapasitasRanges),
            'colors' => ['#F59E0B']
        ];
        
        // Statistik tambahan
        $avgHarga = Mobil::avg('harga');
        $avgKapasitas = Mobil::avg('kapasitas_mesin');
        $maxHarga = Mobil::max('harga');
        $minHarga = Mobil::min('harga');
        
        return view('dashboard', compact(
            'totalMobils', 
            'totalJenisMobils', 
            'mobilsByJenis',
            'pieChartData',
            'barChartData',
            'lineChartData',
            'avgHarga',
            'avgKapasitas',
            'maxHarga',
            'minHarga'
        ));
    }
}
