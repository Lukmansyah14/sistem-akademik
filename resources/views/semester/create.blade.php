@extends('layout.app')

@section('content')

<h1>Tambah Semester</h1>

<form action="/semester" method="POST">

    @csrf

    <div class="mb-3">

        <label>Nama Semester</label>

        <input type="text"
               name="nama_semester"
               class="form-control">

    </div>

    <div class="mb-3">

        <label>Tahun Ajaran</label>

        <input type="number"
               name="tahun_ajaran"
               class="form-control">

    </div>

    <button class="btn btn-success">
        Simpan
    </button>

</form>

@endsection