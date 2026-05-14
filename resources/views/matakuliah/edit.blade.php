@extends('layout.app')

@section('content')

<h1>Edit Mata Kuliah</h1>

<form action="/matakuliah/{{ $matakuliah->id }}" method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama Mata Kuliah</label>
        <input type="text" name="nama_matakuliah" class="form-control" value="{{ $matakuliah->nama_matakuliah }}">
    </div>

    <div class="mb-3">
        <label>Kode Mata Kuliah</label>
        <input type="text" name="kode_matakuliah" class="form-control" value="{{ $matakuliah->kode_matakuliah }}">
    </div>

    <div class="mb-3">
        <label>SKS</label>
        <input type="number" name="sks" class="form-control" value="{{ $matakuliah->sks }}">
    </div>

    <button class="btn btn-success">
        Update
    </button>

</form>

@endsection