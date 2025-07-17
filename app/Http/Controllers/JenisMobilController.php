<?php

namespace App\Http\Controllers;

use App\Models\JenisMobil;
use Illuminate\Http\Request;

class JenisMobilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenisMobils = JenisMobil::withCount('mobils')
                                 ->orderByDesc('id')
                                 ->paginate(10);
        return view('jenis-mobils.index', compact('jenisMobils'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jenis-mobils.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:255|unique:jenis_mobils',
        ]);

        JenisMobil::create($request->validated());

        return redirect()->route('jenis-mobils.index')
            ->with('success', 'Jenis mobil berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisMobil $jenisMobil)
    {
        $jenisMobil->load('mobils');
        return view('jenis-mobils.show', compact('jenisMobil'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisMobil $jenisMobil)
    {
        return view('jenis-mobils.edit', compact('jenisMobil'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JenisMobil $jenisMobil)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:255|unique:jenis_mobils,nama_jenis,' . $jenisMobil->id,
        ]);

        $jenisMobil->update($request->validated());

        return redirect()->route('jenis-mobils.index')
            ->with('success', 'Jenis mobil berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenisMobil $jenisMobil)
    {
        if ($jenisMobil->mobils()->count() > 0) {
            return redirect()->route('jenis-mobils.index')
                ->with('error', 'Tidak dapat menghapus jenis mobil yang masih memiliki data mobil.');
        }

        $jenisMobil->delete();

        return redirect()->route('jenis-mobils.index')
            ->with('success', 'Jenis mobil berhasil dihapus.');
    }
}
