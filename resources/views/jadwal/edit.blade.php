@extends('layout.app')

@section('content')

<h1>Edit Jadwal</h1>

<form action="/jadwal/{{ $data->id }}" method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Mata Kuliah</label>
        <input type="text"
               name="mata_kuliah"
               class="form-control"
               value="{{ $data->mata_kuliah }}">
    </div>

    <div class="mb-3">
        <label>Dosen</label>
        <input type="text"
               name="dosen"
               class="form-control"
               value="{{ $data->dosen }}">
    </div>

    <div class="mb-3">
        <label>Ruangan</label>
        <input type="text"
               name="ruangan"
               class="form-control"
               value="{{ $data->ruangan }}">
    </div>

    <div class="mb-3">
        <label>Hari</label>
        <input type="text"
               name="hari"
               class="form-control"
               value="{{ $data->hari }}">
    </div>

    <div class="mb-3">
        <label>Jam</label>
        <input type="text"
               name="jam"
               class="form-control"
               value="{{ $data->jam }}">
    </div>

    <button class="btn btn-primary">
        Update
    </button>

</form>

@endsection