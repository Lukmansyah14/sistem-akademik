@extends('layout.app')

@section('content')

<h1>Edit Dosen</h1>

<form action="/dosen/{{ $dosen->id }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" value="{{ $dosen->nama }}">
    </div>

    <div class="mb-3">
        <label>NIDN</label>
        <input type="text" name="nidn" class="form-control" value="{{ $dosen->nidn }}">
    </div>

    <div class="mb-3">
        <label>Mata Kuliah</label>
        <select name="mata_kuliah_id" class="form-control">
            @foreach ($mataKuliahs as $mk)
                <option value="{{ $mk->id }}" {{ $dosen->mata_kuliah_id == $mk->id ? 'selected' : '' }}>
                    {{ $mk->nama_mk }}
                </option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-success">Update</button>
</form>

@endsection
