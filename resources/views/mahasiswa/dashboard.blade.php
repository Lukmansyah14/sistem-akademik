@extends('layout.app')

@section('content')
@php
    $jam = now()->format('H');
    $sapaan = $jam < 11 ? 'Selamat Pagi' : ($jam < 15 ? 'Selamat Siang' : ($jam < 18 ? 'Selamat Sore' : 'Selamat Malam'));
    $inisial = collect(explode(' ', auth()->user()->name))->map(fn($w) => mb_substr($w, 0, 1))->take(2)->implode('');

    $gradeColor = function ($huruf) {
        return match (true) {
            str_starts_with(strtoupper($huruf ?? ''), 'A') => ['bg' => '#16a34a', 'soft' => '#dcfce7', 'text' => '#15803d'],
            str_starts_with(strtoupper($huruf ?? ''), 'B') => ['bg' => '#2563eb', 'soft' => '#dbeafe', 'text' => '#1d4ed8'],
            str_starts_with(strtoupper($huruf ?? ''), 'C') => ['bg' => '#d97706', 'soft' => '#fef3c7', 'text' => '#b45309'],
            default => ['bg' => '#dc2626', 'soft' => '#fee2e2', 'text' => '#b91c1c'],
        };
    };
@endphp

<style>
    :root {
        --sa-navy: #101a3d;
        --sa-indigo: #3b4fd9;
        --sa-indigo-light: #6b7ff0;
        --sa-bg: #f4f6fb;
    }
    .sa-hero {
        background: linear-gradient(120deg, var(--sa-navy) 0%, var(--sa-indigo) 100%);
        border-radius: 20px;
        color: #fff;
        position: relative;
        overflow: hidden;
    }
    .sa-hero::before {
        content: "";
        position: absolute;
        top: -60px; right: -60px;
        width: 240px; height: 240px;
        background: rgba(255,255,255,0.08);
        border-radius: 50%;
    }
    .sa-hero::after {
        content: "";
        position: absolute;
        bottom: -80px; right: 120px;
        width: 180px; height: 180px;
        background: rgba(255,255,255,0.06);
        border-radius: 50%;
    }
    .sa-avatar {
        width: 64px; height: 64px;
        border-radius: 50%;
        background: rgba(255,255,255,0.15);
        border: 2px solid rgba(255,255,255,0.4);
        display: flex; align-items: center; justify-content: center;
        font-weight: 700; font-size: 1.3rem; letter-spacing: 1px;
        flex-shrink: 0;
    }
    .sa-chip {
        background: rgba(255,255,255,0.14);
        border: 1px solid rgba(255,255,255,0.25);
        border-radius: 999px;
        padding: 4px 14px;
        font-size: 0.82rem;
        display: inline-flex; align-items: center; gap: 6px;
    }
    .sa-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 2px 14px rgba(16, 26, 61, 0.06);
        transition: transform .15s ease, box-shadow .15s ease;
    }
    .sa-card:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(16, 26, 61, 0.1); }
    .sa-stat-icon {
        width: 46px; height: 46px;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.3rem;
        flex-shrink: 0;
    }
    .sa-progress-thin { height: 8px; border-radius: 999px; background: #eef0f7; }
    .sa-progress-thin > div { height: 100%; border-radius: 999px; }
    .sa-badge-grade {
        border-radius: 8px;
        font-weight: 700;
        padding: 4px 10px;
        font-size: 0.8rem;
    }
    .sa-table-search {
        border-radius: 10px;
    }
    .sa-filter-chip {
        border: 1px solid #dfe3ee;
        background: #fff;
        border-radius: 999px;
        padding: 4px 14px;
        font-size: 0.82rem;
        cursor: pointer;
        color: #4b5468;
        user-select: none;
        transition: all .12s ease;
    }
    .sa-filter-chip.active {
        background: var(--sa-indigo);
        border-color: var(--sa-indigo);
        color: #fff;
    }
    .sa-schedule-item {
        border-left: 4px solid var(--sa-indigo);
        background: #f7f8fd;
        border-radius: 10px;
        padding: 12px 14px;
    }
    .sa-empty {
        text-align: center;
        padding: 32px 12px;
        color: #8891a8;
    }
    .sa-section-title {
        font-weight: 700;
        font-size: 1rem;
        color: var(--sa-navy);
    }
    @media print {
        .no-print { display: none !important; }
    }
</style>

<div class="container-fluid px-lg-4">

    {{-- ================= HERO ================= --}}
    <div class="sa-hero p-4 p-md-5 mb-4">
        <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 position-relative">
            <div class="d-flex align-items-center gap-3">
                <div class="sa-avatar">{{ $inisial ?: 'MHS' }}</div>
                <div>
                    <div class="opacity-75 small mb-1">{{ $sapaan }} • {{ now()->translatedFormat('l, d F Y') }}</div>
                    <h3 class="fw-bold mb-1">{{ auth()->user()->name }} 👋</h3>
                    <div class="d-flex flex-wrap gap-2 mt-2">
                        @if($mahasiswa)
                            <span class="sa-chip">🆔 {{ $mahasiswa->nim }}</span>
                            <span class="sa-chip">🎓 {{ $mahasiswa->jurusan }}</span>
                        @endif
                        <span class="sa-chip">⭐ Rata-rata {{ $rataRata }}</span>
                        <span class="sa-chip">📅 Kehadiran {{ $persentaseKehadiran }}%</span>
                    </div>
                </div>
            </div>
            <div class="no-print">
                <button onclick="window.print()" class="btn btn-light btn-sm fw-semibold">
                    🖨️ Cetak Ringkasan
                </button>
            </div>
        </div>
    </div>

    @if(!$mahasiswa)
        <div class="alert alert-warning border-0 shadow-sm rounded-4">
            Data mahasiswa dengan nama <strong>{{ auth()->user()->name }}</strong> belum ditemukan di data induk.
            Hubungi BAA agar data Anda didaftarkan supaya nilai dan absensi bisa tampil dengan benar.
        </div>
    @endif

    {{-- ================= STAT CARDS ================= --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3 col-6">
            <div class="card sa-card h-100">
                <div class="card-body d-flex gap-3 align-items-center">
                    <div class="sa-stat-icon" style="background:#eef1ff;">📊</div>
                    <div>
                        <div class="text-muted small fw-semibold text-uppercase" style="font-size:.7rem;">Rata-rata Nilai</div>
                        <div class="fw-bold" style="font-size:1.4rem; color:var(--sa-navy);">{{ $rataRata }}</div>
                        <div class="text-muted small">{{ $jumlahNilai }} mata kuliah</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="card sa-card h-100">
                <div class="card-body">
                    <div class="d-flex gap-3 align-items-center mb-2">
                        <div class="sa-stat-icon" style="background:#e7f8ef;">✅</div>
                        <div>
                            <div class="text-muted small fw-semibold text-uppercase" style="font-size:.7rem;">Kehadiran</div>
                            <div class="fw-bold" style="font-size:1.4rem; color:var(--sa-navy);">{{ $persentaseKehadiran }}%</div>
                        </div>
                    </div>
                    <div class="sa-progress-thin"><div style="width:{{ $persentaseKehadiran }}%; background:#16a34a;"></div></div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="card sa-card h-100">
                <div class="card-body d-flex gap-3 align-items-center">
                    <div class="sa-stat-icon" style="background:#fef6e7;">🟡</div>
                    <div>
                        <div class="text-muted small fw-semibold text-uppercase" style="font-size:.7rem;">Sakit / Izin</div>
                        <div class="fw-bold" style="font-size:1.4rem; color:var(--sa-navy);">{{ $rekapAbsensi['sakit'] + $rekapAbsensi['izin'] }}</div>
                        <div class="text-muted small">Sakit {{ $rekapAbsensi['sakit'] }} · Izin {{ $rekapAbsensi['izin'] }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="card sa-card h-100">
                <div class="card-body d-flex gap-3 align-items-center">
                    <div class="sa-stat-icon" style="background:#fdeaea;">⛔</div>
                    <div>
                        <div class="text-muted small fw-semibold text-uppercase" style="font-size:.7rem;">Alpha</div>
                        <div class="fw-bold" style="font-size:1.4rem; color:var(--sa-navy);">{{ $rekapAbsensi['alpha'] }}</div>
                        <div class="text-muted small">dari {{ $absensiSaya->count() }} pertemuan</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        {{-- ================= JADWAL HARI INI ================= --}}
        <div class="col-lg-4">
            <div class="card sa-card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="sa-section-title">🗓️ Jadwal Hari Ini</span>
                        <span class="badge rounded-pill text-bg-light border">{{ $namaHariIni }}</span>
                    </div>

                    @if($jadwalHariIni->isEmpty())
                        <div class="sa-empty">
                            <div style="font-size:2rem;">🌤️</div>
                            <div class="mt-2">Tidak ada jadwal kuliah hari ini.</div>
                        </div>
                    @else
                        <div class="d-flex flex-column gap-2" style="max-height:340px; overflow-y:auto;">
                            @foreach($jadwalHariIni as $j)
                                <div class="sa-schedule-item">
                                    <div class="fw-semibold" style="color:var(--sa-navy);">{{ $j->mata_kuliah }}</div>
                                    <div class="text-muted small mt-1">⏰ {{ $j->jam }} · 🚪 {{ $j->ruangan }}</div>
                                    <div class="text-muted small">👨‍🏫 {{ $j->dosen }}</div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- ================= CHART NILAI ================= --}}
        <div class="col-lg-4">
            <div class="card sa-card h-100">
                <div class="card-body">
                    <span class="sa-section-title">📈 Grafik Nilai</span>
                    @if($nilaiSaya->isEmpty())
                        <div class="sa-empty">
                            <div style="font-size:2rem;">📭</div>
                            <div class="mt-2">Belum ada data nilai.</div>
                        </div>
                    @else
                        <div style="height:280px;" class="mt-2">
                            <canvas id="chartNilai"></canvas>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- ================= CHART ABSENSI ================= --}}
        <div class="col-lg-4">
            <div class="card sa-card h-100">
                <div class="card-body">
                    <span class="sa-section-title">🧭 Komposisi Kehadiran</span>
                    @if($absensiSaya->isEmpty())
                        <div class="sa-empty">
                            <div style="font-size:2rem;">📭</div>
                            <div class="mt-2">Belum ada riwayat absensi.</div>
                        </div>
                    @else
                        <div style="height:280px;" class="mt-2">
                            <canvas id="chartAbsensi"></canvas>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- ================= SOROTAN PERFORMA ================= --}}
    @if($jumlahNilai > 0)
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="card sa-card h-100 border-start border-4" style="border-color:#16a34a !important;">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div style="font-size:1.8rem;">🏆</div>
                        <div>
                            <div class="text-muted small text-uppercase fw-semibold" style="font-size:.7rem;">Nilai Tertinggi</div>
                            <div class="fw-bold" style="color:var(--sa-navy);">{{ $nilaiTertinggi->mata_kuliah }}</div>
                            <div class="text-muted small">{{ $nilaiTertinggi->nilai_angka }} poin · Huruf {{ $nilaiTertinggi->nilai_huruf }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card sa-card h-100 border-start border-4" style="border-color:#d97706 !important;">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div style="font-size:1.8rem;">📌</div>
                        <div>
                            <div class="text-muted small text-uppercase fw-semibold" style="font-size:.7rem;">Perlu Perhatian</div>
                            <div class="fw-bold" style="color:var(--sa-navy);">{{ $nilaiTerendah->mata_kuliah }}</div>
                            <div class="text-muted small">{{ $nilaiTerendah->nilai_angka }} poin · Huruf {{ $nilaiTerendah->nilai_huruf }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="row g-3">
        {{-- ================= NILAI ================= --}}
        <div class="col-lg-6">
            <div class="card sa-card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                        <span class="sa-section-title">📊 Nilai Saya</span>
                        @if(!$nilaiSaya->isEmpty())
                            <button class="btn btn-sm btn-outline-secondary no-print" onclick="unduhCSV('tabelNilai', 'nilai_{{ $mahasiswa->nim ?? auth()->user()->id }}.csv')">
                                ⬇️ Unduh CSV
                            </button>
                        @endif
                    </div>

                    @if($nilaiSaya->isEmpty())
                        <div class="sa-empty">
                            <div style="font-size:2rem;">📭</div>
                            <div class="mt-2">Belum ada nilai yang tercatat.</div>
                        </div>
                    @else
                        <input type="text" id="cariNilai" class="form-control form-control-sm sa-table-search mb-2 no-print"
                               placeholder="🔍 Cari mata kuliah...">
                        <div class="table-responsive" style="max-height: 340px; overflow-y: auto;">
                            <table class="table table-sm table-hover align-middle mb-0" id="tabelNilai">
                                <thead>
                                    <tr class="text-muted small text-uppercase">
                                        <th>Mata Kuliah</th>
                                        <th class="text-center">Angka</th>
                                        <th class="text-center">Huruf</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($nilaiSaya as $nilai)
                                        @php $c = $gradeColor($nilai->nilai_huruf); @endphp
                                        <tr>
                                            <td>{{ $nilai->mata_kuliah }}</td>
                                            <td class="text-center fw-semibold">{{ $nilai->nilai_angka }}</td>
                                            <td class="text-center">
                                                <span class="sa-badge-grade" style="background:{{ $c['soft'] }}; color:{{ $c['text'] }};">
                                                    {{ $nilai->nilai_huruf }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- ================= ABSENSI ================= --}}
        <div class="col-lg-6">
            <div class="card sa-card h-100">
                <div class="card-body">
                    <span class="sa-section-title">📝 Riwayat Absensi</span>

                    @if($absensiSaya->isEmpty())
                        <div class="sa-empty">
                            <div style="font-size:2rem;">📭</div>
                            <div class="mt-2">Belum ada riwayat absensi.</div>
                        </div>
                    @else
                        <div class="d-flex flex-wrap gap-2 my-2 no-print" id="filterAbsensi">
                            <span class="sa-filter-chip active" data-filter="semua">Semua</span>
                            <span class="sa-filter-chip" data-filter="hadir">Hadir</span>
                            <span class="sa-filter-chip" data-filter="sakit">Sakit</span>
                            <span class="sa-filter-chip" data-filter="izin">Izin</span>
                            <span class="sa-filter-chip" data-filter="alpha">Alpha</span>
                        </div>
                        <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                            <table class="table table-sm table-hover align-middle mb-0" id="tabelAbsensi">
                                <thead>
                                    <tr class="text-muted small text-uppercase">
                                        <th>Tanggal</th>
                                        <th>Mata Kuliah</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($absensiSaya as $absen)
                                        @php
                                            $badge = [
                                                'hadir' => 'success',
                                                'sakit' => 'warning',
                                                'izin'  => 'info',
                                                'alpha' => 'danger',
                                            ][$absen->status] ?? 'secondary';
                                        @endphp
                                        <tr data-status="{{ $absen->status }}">
                                            <td>{{ \Carbon\Carbon::parse($absen->tanggal)->format('d M Y') }}</td>
                                            <td>{{ $absen->jadwal->mata_kuliah ?? '-' }}</td>
                                            <td class="text-center">
                                                <span class="badge rounded-pill text-bg-{{ $badge }}">{{ ucfirst($absen->status) }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
<script>
    // ---------- Chart: Nilai per Mata Kuliah ----------
    @if(!$nilaiSaya->isEmpty())
    new Chart(document.getElementById('chartNilai'), {
        type: 'bar',
        data: {
            labels: @json($nilaiSaya->pluck('mata_kuliah')),
            datasets: [{
                label: 'Nilai',
                data: @json($nilaiSaya->pluck('nilai_angka')),
                backgroundColor: '#6b7ff0',
                borderRadius: 6,
                maxBarThickness: 34,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, max: 100, grid: { color: '#f0f1f7' } },
                x: { grid: { display: false } }
            }
        }
    });
    @endif

    // ---------- Chart: Komposisi Absensi ----------
    @if(!$absensiSaya->isEmpty())
    new Chart(document.getElementById('chartAbsensi'), {
        type: 'doughnut',
        data: {
            labels: ['Hadir', 'Sakit', 'Izin', 'Alpha'],
            datasets: [{
                data: [{{ $rekapAbsensi['hadir'] }}, {{ $rekapAbsensi['sakit'] }}, {{ $rekapAbsensi['izin'] }}, {{ $rekapAbsensi['alpha'] }}],
                backgroundColor: ['#16a34a', '#d97706', '#0ea5e9', '#dc2626'],
                borderWidth: 0,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '68%',
            plugins: { legend: { position: 'bottom', labels: { boxWidth: 10, padding: 14 } } }
        }
    });
    @endif

    // ---------- Cari Nilai ----------
    const inputCari = document.getElementById('cariNilai');
    if (inputCari) {
        inputCari.addEventListener('input', function () {
            const q = this.value.toLowerCase();
            document.querySelectorAll('#tabelNilai tbody tr').forEach(row => {
                row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
            });
        });
    }

    // ---------- Filter Absensi ----------
    const filterWrap = document.getElementById('filterAbsensi');
    if (filterWrap) {
        filterWrap.querySelectorAll('.sa-filter-chip').forEach(chip => {
            chip.addEventListener('click', function () {
                filterWrap.querySelectorAll('.sa-filter-chip').forEach(c => c.classList.remove('active'));
                this.classList.add('active');
                const filter = this.dataset.filter;
                document.querySelectorAll('#tabelAbsensi tbody tr').forEach(row => {
                    row.style.display = (filter === 'semua' || row.dataset.status === filter) ? '' : 'none';
                });
            });
        });
    }

    // ---------- Unduh CSV ----------
    function unduhCSV(tableId, filename) {
        const table = document.getElementById(tableId);
        let csv = [];
        table.querySelectorAll('tr').forEach(row => {
            const cols = Array.from(row.querySelectorAll('th, td')).map(col => '"' + col.textContent.trim().replace(/"/g, '""') + '"');
            csv.push(cols.join(','));
        });
        const blob = new Blob([csv.join('\n')], { type: 'text/csv;charset=utf-8;' });
        const link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = filename;
        link.click();
    }
</script>
@endsection