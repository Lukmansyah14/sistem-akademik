@extends('layout.app')

@section('content')

<h1>Edit Mahasiswa</h1>

<form action="/mahasiswa/{{ $mahasiswa->id }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" value="{{ $mahasiswa->nama }}">
    </div>

    <div class="mb-3">
        <label>NIM</label>
        <input type="text" name="nim" class="form-control" value="{{ $mahasiswa->nim }}">
    </div>

    <div class="mb-3">
        <label>Jurusan</label>
        <select name="jurusan_id" class="form-control">
            @foreach ($jurusans as $j)
                <option value="{{ $j->id }}" {{ $mahasiswa->jurusan_id == $j->id ? 'selected' : '' }}>
                    {{ $j->nama_jurusan }}
                </option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-success">Update</button>
</form>

@endsection
