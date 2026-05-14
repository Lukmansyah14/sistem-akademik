@extends('layout.app')

@section('content')

<h1>Tambah Jadwal</h1>

<form action="/jadwal" method="POST">

    @csrf

    <div class="mb-3">
        <label>Mata Kuliah</label>
        <input type="text" name="mata_kuliah" class="form-control">
    </div>

    <div class="mb-3">
        <label>Dosen</label>
        <input type="text" name="dosen" class="form-control">
    </div>

    <div class="mb-3">
        <label>Ruangan</label>
        <input type="text" name="ruangan" class="form-control">
    </div>

    <div class="mb-3">
        <label>Hari</label>
        <input type="text" name="hari" class="form-control">
    </div>

    <div class="mb-3">
        <label>Jam</label>
        <input type="text" name="jam" class="form-control">
    </div>

    <button class="btn btn-success">
        Simpan
    </button>

</form>

@endsection