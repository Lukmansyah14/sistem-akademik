<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;

class DosenController extends Controller
{
    public function index()
    {
        $dosen = Dosen::all();
        return view('dosen.index', compact('dosen'));
    }

    public function create()
    {
        return view('dosen.create');
    }

    public function store(Request $request)
    {
        Dosen::create($request->all());

        return redirect('/dosen');
    }

    public function edit($id)
    {
        $dosen = Dosen::findOrFail($id);

        return view('dosen.edit', compact('dosen'));
    }

    public function update(Request $request, $id)
    {
        $dosen = Dosen::findOrFail($id);

        $dosen->update($request->all());

        return redirect('/dosen');
    }

    public function destroy($id)
    {
        $dosen = Dosen::findOrFail($id);

        $dosen->delete();

        return redirect('/dosen');
    }
}