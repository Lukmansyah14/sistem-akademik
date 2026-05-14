<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    public function index()
    {
        $data = Semester::all();

        return view('semester.index', compact('data'));
    }

    public function create()
    {
        return view('semester.create');
    }

    public function store(Request $request)
    {
        Semester::create($request->all());

        return redirect('/semester')
            ->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = Semester::findOrFail($id);

        return view('semester.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Semester::findOrFail($id);

        $data->update($request->all());

        return redirect('/semester')
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $data = Semester::findOrFail($id);

        $data->delete();

        return redirect('/semester')
            ->with('success', 'Data berhasil dihapus');
    }
}