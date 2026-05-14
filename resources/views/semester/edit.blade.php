@extends('layout.app')

@section('content')

<h1>Edit Semester</h1>

<form action="/semester/{{ $data->id }}" method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">

        <label>Nama Semester</label>

        <input type="text"
               name="nama_semester"
               class="form-control"
               value="{{ $data->nama_semester }}">

    </div>

    <div class="mb-3">

        <label>Tahun Ajaran</label>

        <input type="number"
               name="tahun_ajaran"
               class="form-control"
               value="{{ $data->tahun_ajaran }}">

    </div>

    <button class="btn btn-primary">
        Update
    </button>

</form>

@endsection