@extends('layout.app')

@section('content')

<h1>Tambah Dosen</h1>

<form action="/dosen" method="POST">

    @csrf

    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control">
    </div>

    <div class="mb-3">
        <label>NIDN</label>
        <input type="text" name="nidn" class="form-control">
    </div>

    <div class="mb-3">
        <label>Mata Kuliah</label>
        <input type="text" name="matakuliah" class="form-control">
    </div>

    <button class="btn btn-primary">
        Simpan
    </button>

</form>

@endsection