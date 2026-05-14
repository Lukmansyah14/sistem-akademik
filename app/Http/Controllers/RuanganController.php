<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruangan;

class RuanganController extends Controller
{
    public function index()
    {
        $ruangan = Ruangan::all();
        return view('ruangan.index', compact('ruangan'));
    }

    public function create()
    {
        return view('ruangan.create');
    }

    public function store(Request $request)
    {
        Ruangan::create($request->all());

        return redirect('/ruangan');
    }

    public function edit($id)
    {
        $ruangan = Ruangan::findOrFail($id);

        return view('ruangan.edit', compact('ruangan'));
    }

    public function update(Request $request, $id)
    {
        $ruangan = Ruangan::findOrFail($id);

        $ruangan->update($request->all());

        return redirect('/ruangan');
    }

    public function destroy($id)
    {
        $ruangan = Ruangan::findOrFail($id);

        $ruangan->delete();

        return redirect('/ruangan');
    }
}