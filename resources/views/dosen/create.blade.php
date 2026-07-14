@extends('layout.app')

@section('content')

<h1>Tambah Dosen</h1>

<form action="/dosen" method="POST">
    @csrf

    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" value="{{ old('nama') }}">
        @error('nama') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
        <label>NIDN</label>
        <input type="text" name="nidn" class="form-control" value="{{ old('nidn') }}">
        @error('nidn') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
        <label>Mata Kuliah</label>
        <select name="mata_kuliah_id" class="form-control">
            <option value="">-- Pilih Mata Kuliah --</option>
            @foreach ($mataKuliahs as $mk)
                <option value="{{ $mk->id }}" {{ old('mata_kuliah_id') == $mk->id ? 'selected' : '' }}>
                    {{ $mk->nama_mk }}
                </option>
            @endforeach
        </select>
        @error('mata_kuliah_id') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <button class="btn btn-primary">Simpan</button>
</form>

@endsection
