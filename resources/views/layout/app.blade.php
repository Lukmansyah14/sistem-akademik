<!DOCTYPE html>
<html>
<head>
    <title>Sistem Akademik</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <a class="navbar-brand fw-bold" href="#">
            Sistem Akademik
        </a>

        <div class="d-flex gap-2 flex-wrap">

            <a href="/mahasiswa" class="btn btn-light btn-sm">
                Mahasiswa
            </a>

            <a href="/dosen" class="btn btn-light btn-sm">
                Dosen
            </a>

            <a href="/jurusan" class="btn btn-light btn-sm">
                Jurusan
            </a>

            <a href="/ruangan" class="btn btn-light btn-sm">
                Ruangan
            </a>

            <a href="/kelas" class="btn btn-light btn-sm">
                Kelas
            </a>

            <a href="/matakuliah" class="btn btn-light btn-sm">
                Mata Kuliah
            </a>

            <a href="/absensi" class="btn btn-light btn-sm">
                Absensi
            </a>

            <a href="/semester" class="btn btn-light btn-sm">
                Semester
            </a>

            <a href="/jadwal" class="btn btn-light btn-sm">
                Jadwal
            </a>

            <a href="/nilai" class="btn btn-light btn-sm">
                Nilai
            </a>

        </div>

    </div>
</nav>

<div class="container mt-4">

    @yield('content')

</div>

</body>
</html>