<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Mahasiswa;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index()
    {
        $absensis = Absensi::with(['mahasiswa', 'jadwal.mataKuliah'])->latest()->paginate(10);
        return view('absensi.index', compact('absensis'));
    }

    public function create()
    {
        $mahasiswas = Mahasiswa::all();
        $jadwals = Jadwal::with('mataKuliah')->get();
        return view('absensi.create', compact('mahasiswas', 'jadwals'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'jadwal_id' => 'required|exists:jadwals,id',
            'tanggal' => 'required|date',
            'status' => 'required|in:hadir,sakit,izin,alpha',
            'keterangan' => 'nullable|string|max:255',
        ]);

        Absensi::create($validated);

        return redirect()->route('absensi.index')
            ->with('success', 'Data absensi berhasil ditambahkan!');
    }

    public function show(Absensi $absensi)
    {
        $absensi->load(['mahasiswa', 'jadwal.mataKuliah']);
        return view('absensi.show', compact('absensi'));
    }

    public function edit(Absensi $absensi)
    {
        $mahasiswas = Mahasiswa::all();
        $jadwals = Jadwal::with('mataKuliah')->get();
        return view('absensi.edit', compact('absensi', 'mahasiswas', 'jadwals'));
    }

    public function update(Request $request, Absensi $absensi)
    {
        $validated = $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'jadwal_id' => 'required|exists:jadwals,id',
            'tanggal' => 'required|date',
            'status' => 'required|in:hadir,sakit,izin,alpha',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $absensi->update($validated);

        return redirect()->route('absensi.index')
            ->with('success', 'Data absensi berhasil diupdate!');
    }

    public function destroy(Absensi $absensi)
    {
        $absensi->delete();

        return redirect()->route('absensi.index')
            ->with('success', 'Data absensi berhasil dihapus!');
    }
}