<!DOCTYPE html>
<html>
<head>
    <title>Sistem Akademik</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <a class="navbar-brand fw-bold" href="{{ url('/') }}">
            Sistem Akademik
        </a>

        <div class="d-flex gap-2 flex-wrap">
            @auth
                @if(in_array(auth()->user()->role, ['baa', 'admin']))
                    <a href="{{ url('/mahasiswa') }}" class="btn btn-light btn-sm">Mahasiswa</a>
                    <a href="{{ url('/dosen') }}" class="btn btn-light btn-sm">Dosen</a>
                @endif

                @if(in_array(auth()->user()->role, ['baa', 'admin']))
                    <a href="{{ url('/jurusan') }}" class="btn btn-light btn-sm">Jurusan</a>
                    <a href="{{ url('/ruangan') }}" class="btn btn-light btn-sm">Ruangan</a>
                    <a href="{{ url('/kelas') }}" class="btn btn-light btn-sm">Kelas</a>
                    <a href="{{ url('/matakuliah') }}" class="btn btn-light btn-sm">Mata Kuliah</a>
                    <a href="{{ url('/semester') }}" class="btn btn-light btn-sm">Semester</a>
                    <a href="{{ url('/jadwal') }}" class="btn btn-light btn-sm">Jadwal</a>
                @endif

                @if(in_array(auth()->user()->role, ['baa', 'dosen', 'admin']))
                    <a href="{{ url('/nilai') }}" class="btn btn-light btn-sm">Nilai</a>
                @endif

                @if(in_array(auth()->user()->role, ['dosen', 'admin']))
                    <a href="{{ url('/absensi') }}" class="btn btn-light btn-sm">Absensi</a>
                @endif
            @endauth
        </div>

        <div class="ms-auto d-flex align-items-center gap-2">
            @auth
                <span class="navbar-text text-light d-none d-lg-inline">
                    👤 {{ Auth::user()->name }}
                </span>
                
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn btn-outline-light btn-sm px-3" 
                            onclick="return confirm('Yakin mau logout?')">
                        🔓 Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Login</a>
            @endauth
        </div>

    </div>
</nav>

<div class="container mt-4">

    @auth
        @if(!Request::is('/') && !Request::is('baa/dashboard') && !Request::is('admin/dashboard'))
            @if(auth()->user()->role == 'baa')
                <a href="{{ route('baa.dashboard') }}" class="btn btn-sm btn-outline-secondary mb-3">
                    ⬅️ Kembali ke Dashboard BAA
                </a>
            @elseif(auth()->user()->role == 'admin')
                <a href="{{ url('/admin/dashboard') }}" class="btn btn-sm btn-outline-secondary mb-3">
                    ⬅️ Kembali ke Dashboard Admin
                </a>
            @endif
        @endif
    @endauth

    @yield('content')

</div>

</body>
</html>