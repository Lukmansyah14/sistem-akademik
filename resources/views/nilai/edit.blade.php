@extends('layout.app')

@section('content')

<h1>Edit Nilai</h1>

<form action="/nilai/{{ $data->id }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Mahasiswa</label>
        <select name="mahasiswa_id" class="form-control">
            @foreach ($mahasiswas as $m)
                <option value="{{ $m->id }}" {{ $data->mahasiswa_id == $m->id ? 'selected' : '' }}>
                    {{ $m->nama }} ({{ $m->nim }})
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Mata Kuliah</label>
        <select name="mata_kuliah_id" class="form-control">
            @foreach ($mataKuliahs as $mk)
                <option value="{{ $mk->id }}" {{ $data->mata_kuliah_id == $mk->id ? 'selected' : '' }}>
                    {{ $mk->nama_mk }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Nilai Angka</label>
        <input type="number" name="nilai_angka" class="form-control" value="{{ $data->nilai_angka }}">
    </div>

    <div class="mb-3">
        <label>Nilai Huruf</label>
        <input type="text" name="nilai_huruf" class="form-control" value="{{ $data->nilai_huruf }}">
    </div>

    <button class="btn btn-primary">Update</button>
</form>

@endsection
