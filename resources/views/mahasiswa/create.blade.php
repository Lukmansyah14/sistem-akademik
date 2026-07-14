@extends('layout.app')

@section('content')

<h1>Tambah Mahasiswa</h1>

<form action="/mahasiswa" method="POST">
    @csrf

    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" value="{{ old('nama') }}">
        @error('nama') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
        <label>NIM</label>
        <input type="text" name="nim" class="form-control" value="{{ old('nim') }}">
        @error('nim') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
        <label>Jurusan</label>
        <select name="jurusan_id" class="form-control">
            <option value="">-- Pilih Jurusan --</option>
            @foreach ($jurusans as $j)
                <option value="{{ $j->id }}" {{ old('jurusan_id') == $j->id ? 'selected' : '' }}>
                    {{ $j->nama_jurusan }}
                </option>
            @endforeach
        </select>
        @error('jurusan_id') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <button class="btn btn-primary">Simpan</button>
</form>

@endsection
