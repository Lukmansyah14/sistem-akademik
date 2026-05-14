<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $data = Jadwal::all();

        return view('jadwal.index', compact('data'));
    }

    public function create()
    {
        return view('jadwal.create');
    }

    public function store(Request $request)
    {
        Jadwal::create($request->all());

        return redirect('/jadwal');
    }

    public function edit($id)
    {
        $data = Jadwal::findOrFail($id);

        return view('jadwal.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Jadwal::findOrFail($id);

        $data->update($request->all());

        return redirect('/jadwal');
    }

    public function destroy($id)
    {
        $data = Jadwal::findOrFail($id);

        $data->delete();

        return redirect('/jadwal');
    }
}