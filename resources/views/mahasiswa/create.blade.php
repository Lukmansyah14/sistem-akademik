@extends('layout.app')

@section('content')

<h1>Tambah Mahasiswa</h1>

<form action="/mahasiswa" method="POST">

    @csrf

    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control">
    </div>

    <div class="mb-3">
        <label>NIM</label>
        <input type="text" name="nim" class="form-control">
    </div>

    <div class="mb-3">
        <label>Jurusan</label>
        <input type="text" name="jurusan" class="form-control">
    </div>

    <button class="btn btn-primary">
        Simpan
    </button>

</form>

@endsection