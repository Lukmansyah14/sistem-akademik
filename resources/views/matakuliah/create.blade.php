@extends('layout.app')

@section('content')

<h1>Tambah Mata Kuliah</h1>

<form action="/matakuliah" method="POST">

    @csrf

    <div class="mb-3">
        <label>Nama Mata Kuliah</label>
        <input type="text" name="nama_matakuliah" class="form-control">
    </div>

    <div class="mb-3">
        <label>Kode Mata Kuliah</label>
        <input type="text" name="kode_matakuliah" class="form-control">
    </div>

    <div class="mb-3">
        <label>SKS</label>
        <input type="number" name="sks" class="form-control">
    </div>

    <button class="btn btn-primary">
        Simpan
    </button>

</form>

@endsection