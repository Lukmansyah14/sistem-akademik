@extends('layout.app')

@section('content')

<h1>Tambah Kelas</h1>

<form action="/kelas" method="POST">

    @csrf

    <div class="mb-3">
        <label>Nama Kelas</label>
        <input type="text" name="nama_kelas" class="form-control">
    </div>

    <div class="mb-3">
        <label>Tingkat</label>
        <input type="text" name="tingkat" class="form-control">
    </div>

    <div class="mb-3">
        <label>Wali Kelas</label>
        <input type="text" name="wali_kelas" class="form-control">
    </div>

    <button class="btn btn-primary">
        Simpan
    </button>

</form>

@endsection