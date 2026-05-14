@extends('layout.app')

@section('content')

<h1>Tambah Ruangan</h1>

<form action="/ruangan" method="POST">

    @csrf

    <div class="mb-3">
        <label>Nama Ruangan</label>
        <input type="text" name="nama_ruangan" class="form-control">
    </div>

    <div class="mb-3">
        <label>Kode Ruangan</label>
        <input type="text" name="kode_ruangan" class="form-control">
    </div>

    <div class="mb-3">
        <label>Kapasitas</label>
        <input type="number" name="kapasitas" class="form-control">
    </div>

    <button class="btn btn-primary">
        Simpan
    </button>

</form>

@endsection