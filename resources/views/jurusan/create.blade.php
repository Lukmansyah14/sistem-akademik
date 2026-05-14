@extends('layout.app')

@section('content')

<h1>Tambah Jurusan</h1>

<form action="/jurusan" method="POST">

    @csrf

    <div class="mb-3">
        <label>Nama Jurusan</label>
        <input type="text" name="nama_jurusan" class="form-control">
    </div>

    <div class="mb-3">
        <label>Kode Jurusan</label>
        <input type="text" name="kode_jurusan" class="form-control">
    </div>

    <button class="btn btn-primary">
        Simpan
    </button>

</form>

@endsection