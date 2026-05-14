@extends('layout.app')

@section('content')

<h1>Tambah Nilai</h1>

<form action="/nilai" method="POST">

    @csrf

    <div class="mb-3">
        <label>Nama Mahasiswa</label>
        <input type="text"
               name="nama_mahasiswa"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Mata Kuliah</label>
        <input type="text"
               name="mata_kuliah"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Nilai Angka</label>
        <input type="number"
               name="nilai_angka"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Nilai Huruf</label>
        <input type="text"
               name="nilai_huruf"
               class="form-control">
    </div>

    <button class="btn btn-success">
        Simpan
    </button>

</form>

@endsection