<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\MataKuliah;
use App\Models\Dosen;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        // eager load supaya tidak N+1 query
        $data = Jadwal::with(['mataKuliah', 'dosen', 'ruangan'])->get();

        return view('jadwal.index', compact('data'));
    }

    public function create()
    {
        $mataKuliahs = MataKuliah::all();
        $dosens      = Dosen::all();
        $ruangans    = Ruangan::all();

        return view('jadwal.create', compact('mataKuliahs', 'dosens', 'ruangans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'mata_kuliah_id' => 'required|exists:mata_kuliahs,id',
            'dosen_id'       => 'required|exists:dosens,id',
            'ruangan_id'     => 'required|exists:ruangans,id',
            'hari'           => 'required|string',
            'jam'            => 'required|string',
        ]);

        Jadwal::create($validated);

        return redirect('/jadwal')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data        = Jadwal::findOrFail($id);
        $mataKuliahs = MataKuliah::all();
        $dosens      = Dosen::all();
        $ruangans    = Ruangan::all();

        return view('jadwal.edit', compact('data', 'mataKuliahs', 'dosens', 'ruangans'));
    }

    public function update(Request $request, $id)
    {
        $data = Jadwal::findOrFail($id);

        $validated = $request->validate([
            'mata_kuliah_id' => 'required|exists:mata_kuliahs,id',
            'dosen_id'       => 'required|exists:dosens,id',
            'ruangan_id'     => 'required|exists:ruangans,id',
            'hari'           => 'required|string',
            'jam'            => 'required|string',
        ]);

        $data->update($validated);

        return redirect('/jadwal')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Jadwal::findOrFail($id)->delete();

        return redirect('/jadwal')->with('success', 'Jadwal berhasil dihapus.');
    }
}
