<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Models\MataKuliah;

class DosenController extends Controller
{
    public function index()
    {
        $dosen = Dosen::with('mataKuliah')->get();
        return view('dosen.index', compact('dosen'));
    }

    public function create()
    {
        $mataKuliahs = MataKuliah::all();
        return view('dosen.create', compact('mataKuliahs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'           => 'required|string|max:255',
            'nidn'           => 'required|string|max:20|unique:dosens,nidn',
            'mata_kuliah_id' => 'required|exists:mata_kuliahs,id',
        ]);

        Dosen::create($validated);

        return redirect('/dosen')->with('success', 'Dosen berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $dosen       = Dosen::findOrFail($id);
        $mataKuliahs = MataKuliah::all();
        return view('dosen.edit', compact('dosen', 'mataKuliahs'));
    }

    public function update(Request $request, $id)
    {
        $dosen = Dosen::findOrFail($id);

        $validated = $request->validate([
            'nama'           => 'required|string|max:255',
            'nidn'           => 'required|string|max:20|unique:dosens,nidn,' . $dosen->id,
            'mata_kuliah_id' => 'required|exists:mata_kuliahs,id',
        ]);

        $dosen->update($validated);

        return redirect('/dosen')->with('success', 'Dosen berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Dosen::findOrFail($id)->delete();
        return redirect('/dosen')->with('success', 'Dosen berhasil dihapus.');
    }
}
