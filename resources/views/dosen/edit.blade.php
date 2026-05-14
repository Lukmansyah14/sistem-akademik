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
        <input type="text" name="matakuliah" class="form-control" value="{{ $dosen->matakuliah }}">
    </div>

    <button class="btn btn-success">
        Update
    </button>

</form>

@endsection