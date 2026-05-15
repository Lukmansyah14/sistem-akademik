@extends('layout.app')

@section('title', 'Tambah Absensi')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header py-3 bg-white">
            <h5 class="mb-0 font-weight-bold text-primary">
                <i class="fa fa-plus-circle me-2"></i>Tambah Absensi
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('absensi.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="mahasiswa_id" class="form-label">Mahasiswa <span class="text-danger">*</span></label>
                    <select name="mahasiswa_id" id="mahasiswa_id" class="form-select @error('mahasiswa_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Mahasiswa --</option>
                        @foreach($mahasiswas as $mhs)
                            <option value="{{ $mhs->id }}" {{ old('mahasiswa_id') == $mhs->id ? 'selected' : '' }}>
                                {{ $mhs->nama }} - {{ $mhs->nim ?? '' }}
                            </option>
                        @endforeach
                    </select>
                    @error('mahasiswa_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="jadwal_id" class="form-label">Jadwal/Mata Kuliah <span class="text-danger">*</span></label>
                    <select name="jadwal_id" id="jadwal_id" class="form-select @error('jadwal_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Mata Kuliah --</option>
                        @foreach($jadwals as $jadwal)
                            <option value="{{ $jadwal->id }}" {{ old('jadwal_id') == $jadwal->id ? 'selected' : '' }}>
                                {{ $jadwal->mataKuliah->nama ?? 'Jadwal ' . $jadwal->id }}
                            </option>
                        @endforeach
                    </select>
                    @error('jadwal_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror" 
                           value="{{ old('tanggal', date('Y-m-d')) }}" required>
                    @error('tanggal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="hadir" {{ old('status') == 'hadir' ? 'selected' : '' }}>Hadir</option>
                        <option value="sakit" {{ old('status') == 'sakit' ? 'selected' : '' }}>Sakit</option>
                        <option value="izin" {{ old('status') == 'izin' ? 'selected' : '' }}>Izin</option>
                        <option value="alpha" {{ old('status') == 'alpha' ? 'selected' : '' }}>Alpha</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" rows="3" class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save me-1"></i>Simpan
                    </button>
                    <a href="{{ route('absensi.index') }}" class="btn btn-secondary">
                        <i class="fa fa-times me-1"></i>Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection