<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Dosen;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::with('waliKelas')->get();
        return view('kelas.index', compact('kelas'));
    }

    public function create()
    {
        $dosens = Dosen::all();
        return view('kelas.create', compact('dosens'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kelas'    => 'required|string|max:255',
            'tingkat'       => 'required|string|max:50',
            'wali_kelas_id' => 'required|exists:dosens,id',
        ]);

        Kelas::create($validated);

        return redirect('/kelas')->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kelas  = Kelas::findOrFail($id);
        $dosens = Dosen::all();
        return view('kelas.edit', compact('kelas', 'dosens'));
    }

    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        $validated = $request->validate([
            'nama_kelas'    => 'required|string|max:255',
            'tingkat'       => 'required|string|max:50',
            'wali_kelas_id' => 'required|exists:dosens,id',
        ]);

        $kelas->update($validated);

        return redirect('/kelas')->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Kelas::findOrFail($id)->delete();
        return redirect('/kelas')->with('success', 'Kelas berhasil dihapus.');
    }
}
