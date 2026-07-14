<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index()
    {
        $data = Nilai::with(['mahasiswa', 'mataKuliah'])->get();
        return view('nilai.index', compact('data'));
    }

    public function create()
    {
        $mahasiswas  = Mahasiswa::all();
        $mataKuliahs = MataKuliah::all();
        return view('nilai.create', compact('mahasiswas', 'mataKuliahs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'mahasiswa_id'   => 'required|exists:mahasiswas,id',
            'mata_kuliah_id' => 'required|exists:mata_kuliahs,id',
            'nilai_angka'    => 'required|integer|min:0|max:100',
            'nilai_huruf'    => 'required|string|max:2',
        ]);

        Nilai::create($validated);

        return redirect('/nilai')->with('success', 'Nilai berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data        = Nilai::findOrFail($id);
        $mahasiswas  = Mahasiswa::all();
        $mataKuliahs = MataKuliah::all();
        return view('nilai.edit', compact('data', 'mahasiswas', 'mataKuliahs'));
    }

    public function update(Request $request, $id)
    {
        $data = Nilai::findOrFail($id);

        $validated = $request->validate([
            'mahasiswa_id'   => 'required|exists:mahasiswas,id',
            'mata_kuliah_id' => 'required|exists:mata_kuliahs,id',
            'nilai_angka'    => 'required|integer|min:0|max:100',
            'nilai_huruf'    => 'required|string|max:2',
        ]);

        $data->update($validated);

        return redirect('/nilai')->with('success', 'Nilai berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Nilai::findOrFail($id)->delete();
        return redirect('/nilai')->with('success', 'Nilai berhasil dihapus.');
    }
}
