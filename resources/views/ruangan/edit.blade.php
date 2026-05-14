@extends('layout.app')

@section('content')

<h1>Edit Ruangan</h1>

<form action="/ruangan/{{ $ruangan->id }}" method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama Ruangan</label>
        <input type="text" name="nama_ruangan" class="form-control" value="{{ $ruangan->nama_ruangan }}">
    </div>

    <div class="mb-3">
        <label>Kode Ruangan</label>
        <input type="text" name="kode_ruangan" class="form-control" value="{{ $ruangan->kode_ruangan }}">
    </div>

    <div class="mb-3">
        <label>Kapasitas</label>
        <input type="number" name="kapasitas" class="form-control" value="{{ $ruangan->kapasitas }}">
    </div>

    <button class="btn btn-success">
        Update
    </button>

</form>

@endsection