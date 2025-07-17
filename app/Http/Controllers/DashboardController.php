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
        
        return view('dashboard', compact('totalMobils', 'totalJenisMobils', 'mobilsByJenis'));
    }
}
