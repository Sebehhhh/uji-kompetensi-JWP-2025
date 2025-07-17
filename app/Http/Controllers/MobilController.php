<?php

namespace App\Http\Controllers;

use App\Models\JenisMobil;
use App\Models\Mobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class MobilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Mobil::with('jenisMobil');

        // Filter by search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id', 'LIKE', "%{$search}%")
                  ->orWhere('merek', 'LIKE', "%{$search}%");
            });
        }

        // Filter by jenis mobil
        if ($request->filled('jenis_mobil_id')) {
            $query->where('jenis_mobil_id', $request->jenis_mobil_id);
        }

        // Filter by CC range
        if ($request->filled('cc_filter')) {
            $ccFilter = $request->cc_filter;
            $customCC = $request->custom_cc;
            
            if ($ccFilter == 'above' && $customCC) {
                $query->where('kapasitas_mesin', '>', $customCC);
            } elseif ($ccFilter == 'below' && $customCC) {
                $query->where('kapasitas_mesin', '<', $customCC);
            } elseif ($ccFilter == 'exact' && $customCC) {
                $query->where('kapasitas_mesin', $customCC);
            }
        }

        $mobils = $query->orderByDesc('id')
                       ->paginate(10);

        $jenisMobils = JenisMobil::all();

        return view('mobils.index', compact('mobils', 'jenisMobils'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenisMobils = JenisMobil::all();
        return view('mobils.create', compact('jenisMobils'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'merek' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'kapasitas_mesin' => 'required|integer|min:1',
            'jenis_mobil_id' => 'nullable|exists:jenis_mobils,id',
        ]);

        Mobil::create($validatedData);

        return redirect()->route('mobils.index')
            ->with('success', 'Mobil berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mobil $mobil)
    {
        $mobil->load('jenisMobil');
        return view('mobils.show', compact('mobil'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mobil $mobil)
    {
        $jenisMobils = JenisMobil::all();
        return view('mobils.edit', compact('mobil', 'jenisMobils'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mobil $mobil)
    {
        $validatedData = $request->validate([
            'merek' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'kapasitas_mesin' => 'required|integer|min:1',
            'jenis_mobil_id' => 'nullable|exists:jenis_mobils,id',
        ]);

        $mobil->update($validatedData);

        return redirect()->route('mobils.index')
            ->with('success', 'Mobil berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mobil $mobil)
    {
        $mobil->delete();

        return redirect()->route('mobils.index')
            ->with('success', 'Mobil berhasil dihapus.');
    }

    /**
     * Export data to CSV format.
     */
    public function exportCsv()
    {
        $mobils = Mobil::with('jenisMobil')
                      ->orderByDesc('harga')
                      ->orderByDesc('kapasitas_mesin')
                      ->get();

        $csvData = "ID,Merek,Harga,Kapasitas Mesin,Jenis Mobil\n";
        
        foreach ($mobils as $mobil) {
            $csvData .= sprintf(
                "%d,%s,%s,%d,%s\n",
                $mobil->id,
                $mobil->merek,
                number_format($mobil->harga, 0, ',', '.'),
                $mobil->kapasitas_mesin,
                $mobil->jenisMobil->nama_jenis
            );
        }

        return Response::make($csvData, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="data_mobil.csv"',
        ]);
    }

    /**
     * Export data to TXT format.
     */
    public function exportTxt()
    {
        $mobils = Mobil::with('jenisMobil')
                      ->orderByDesc('harga')
                      ->orderByDesc('kapasitas_mesin')
                      ->get();

        $txtData = "DATA MOBIL SHOWROOM\n";
        $txtData .= "===================\n\n";
        
        foreach ($mobils as $mobil) {
            $txtData .= "ID: {$mobil->id}\n";
            $txtData .= "Merek: {$mobil->merek}\n";
            $txtData .= "Harga: Rp " . number_format($mobil->harga, 0, ',', '.') . "\n";
            $txtData .= "Kapasitas Mesin: {$mobil->kapasitas_mesin} cc\n";
            $txtData .= "Jenis Mobil: {$mobil->jenisMobil->nama_jenis}\n";
            $txtData .= "-------------------\n\n";
        }

        return Response::make($txtData, 200, [
            'Content-Type' => 'text/plain',
            'Content-Disposition' => 'attachment; filename="data_mobil.txt"',
        ]);
    }
}
