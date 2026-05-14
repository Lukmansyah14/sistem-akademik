<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataKuliah;

class MataKuliahController extends Controller
{
    public function index()
    {
        $matakuliah = MataKuliah::all();
        return view('matakuliah.index', compact('matakuliah'));
    }

    public function create()
    {
        return view('matakuliah.create');
    }

    public function store(Request $request)
    {
        MataKuliah::create($request->all());

        return redirect('/matakuliah');
    }

    public function edit($id)
    {
        $matakuliah = MataKuliah::findOrFail($id);

        return view('matakuliah.edit', compact('matakuliah'));
    }

    public function update(Request $request, $id)
    {
        $matakuliah = MataKuliah::findOrFail($id);

        $matakuliah->update($request->all());

        return redirect('/matakuliah');
    }

    public function destroy($id)
    {
        $matakuliah = MataKuliah::findOrFail($id);

        $matakuliah->delete();

        return redirect('/matakuliah');
    }
}