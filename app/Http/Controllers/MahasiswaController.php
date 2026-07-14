<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Jurusan;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::with('jurusan')->get();
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    public function create()
    {
        $jurusans = Jurusan::all();
        return view('mahasiswa.create', compact('jurusans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'       => 'required|string|max:255',
            'nim'        => 'required|string|max:20|unique:mahasiswas,nim',
            'jurusan_id' => 'required|exists:jurusans,id',
        ]);

        Mahasiswa::create($validated);

        return redirect('/mahasiswa')->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $jurusans  = Jurusan::all();
        return view('mahasiswa.edit', compact('mahasiswa', 'jurusans'));
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $validated = $request->validate([
            'nama'       => 'required|string|max:255',
            'nim'        => 'required|string|max:20|unique:mahasiswas,nim,' . $mahasiswa->id,
            'jurusan_id' => 'required|exists:jurusans,id',
        ]);

        $mahasiswa->update($validated);

        return redirect('/mahasiswa')->with('success', 'Mahasiswa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Mahasiswa::findOrFail($id)->delete();
        return redirect('/mahasiswa')->with('success', 'Mahasiswa berhasil dihapus.');
    }
}
