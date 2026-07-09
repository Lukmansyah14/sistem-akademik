<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index()
    {
        $data = Nilai::all();
        return view('nilai.index', compact('data'));
    }

    public function create()
    {
        return view('nilai.create');
    }

    public function store(Request $request)
    {
        Nilai::create($request->all());
        return redirect('/nilai');
    }

    public function edit($id)
    {
        $data = Nilai::findOrFail($id);
        return view('nilai.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Nilai::findOrFail($id);
        $data->update($request->all());
        return redirect('/nilai');
    }

    public function destroy($id)
    {
        $data = Nilai::findOrFail($id);
        $data->delete();
        return redirect('/nilai');
    }
}