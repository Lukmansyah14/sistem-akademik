<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. mahasiswas: jurusan (string) -> jurusan_id
        Schema::table('mahasiswas', function (Blueprint $table) {
            $table->foreignId('jurusan_id')->nullable()->after('jurusan')
                ->constrained('jurusans')->nullOnDelete();
        });

        // migrasi data lama: cocokkan nama jurusan teks -> id jurusan
        DB::table('mahasiswas')->orderBy('id')->each(function ($m) {
            $jurusan = DB::table('jurusans')->where('nama_jurusan', $m->jurusan)->first();
            if ($jurusan) {
                DB::table('mahasiswas')->where('id', $m->id)->update(['jurusan_id' => $jurusan->id]);
            }
        });

        Schema::table('mahasiswas', function (Blueprint $table) {
            $table->dropColumn('jurusan');
        });

        // 2. dosens: matakuliah (string) -> mata_kuliah_id
        Schema::table('dosens', function (Blueprint $table) {
            $table->foreignId('mata_kuliah_id')->nullable()->after('matakuliah')
                ->constrained('mata_kuliahs')->nullOnDelete();
        });

        DB::table('dosens')->orderBy('id')->each(function ($d) {
            $mk = DB::table('mata_kuliahs')->where('nama_mk', $d->matakuliah)->first();
            if ($mk) {
                DB::table('dosens')->where('id', $d->id)->update(['mata_kuliah_id' => $mk->id]);
            }
        });

        Schema::table('dosens', function (Blueprint $table) {
            $table->dropColumn('matakuliah');
        });

        // 3. kelas: wali_kelas (string) -> wali_kelas_id (dosen)
        Schema::table('kelas', function (Blueprint $table) {
            $table->foreignId('wali_kelas_id')->nullable()->after('wali_kelas')
                ->constrained('dosens')->nullOnDelete();
        });

        DB::table('kelas')->orderBy('id')->each(function ($k) {
            $dosen = DB::table('dosens')->where('nama', $k->wali_kelas)->first();
            if ($dosen) {
                DB::table('kelas')->where('id', $k->id)->update(['wali_kelas_id' => $dosen->id]);
            }
        });

        Schema::table('kelas', function (Blueprint $table) {
            $table->dropColumn('wali_kelas');
        });

        // 4. jadwals: mata_kuliah, dosen, ruangan (string) -> FK id
        Schema::table('jadwals', function (Blueprint $table) {
            $table->foreignId('mata_kuliah_id')->nullable()->after('mata_kuliah')
                ->constrained('mata_kuliahs')->nullOnDelete();
            $table->foreignId('dosen_id')->nullable()->after('dosen')
                ->constrained('dosens')->nullOnDelete();
            $table->foreignId('ruangan_id')->nullable()->after('ruangan')
                ->constrained('ruangans')->nullOnDelete();
        });

        DB::table('jadwals')->orderBy('id')->each(function ($j) {
            $update = [];
            if ($mk = DB::table('mata_kuliahs')->where('nama_mk', $j->mata_kuliah)->first()) {
                $update['mata_kuliah_id'] = $mk->id;
            }
            if ($dosen = DB::table('dosens')->where('nama', $j->dosen)->first()) {
                $update['dosen_id'] = $dosen->id;
            }
            if ($ruangan = DB::table('ruangans')->where('nama_ruangan', $j->ruangan)->first()) {
                $update['ruangan_id'] = $ruangan->id;
            }
            if ($update) {
                DB::table('jadwals')->where('id', $j->id)->update($update);
            }
        });

        Schema::table('jadwals', function (Blueprint $table) {
            $table->dropColumn(['mata_kuliah', 'dosen', 'ruangan']);
        });

        // 5. nilais: nama_mahasiswa, mata_kuliah (string) -> FK id
        Schema::table('nilais', function (Blueprint $table) {
            $table->foreignId('mahasiswa_id')->nullable()->after('nama_mahasiswa')
                ->constrained('mahasiswas')->nullOnDelete();
            $table->foreignId('mata_kuliah_id')->nullable()->after('mata_kuliah')
                ->constrained('mata_kuliahs')->nullOnDelete();
        });

        DB::table('nilais')->orderBy('id')->each(function ($n) {
            $update = [];
            if ($mhs = DB::table('mahasiswas')->where('nama', $n->nama_mahasiswa)->first()) {
                $update['mahasiswa_id'] = $mhs->id;
            }
            if ($mk = DB::table('mata_kuliahs')->where('nama_mk', $n->mata_kuliah)->first()) {
                $update['mata_kuliah_id'] = $mk->id;
            }
            if ($update) {
                DB::table('nilais')->where('id', $n->id)->update($update);
            }
        });

        Schema::table('nilais', function (Blueprint $table) {
            $table->dropColumn(['nama_mahasiswa', 'mata_kuliah']);
        });
    }

    public function down(): void
    {
        // Rollback sederhana: cukup drop FK yang ditambahkan (data lama string tidak dikembalikan)
        Schema::table('nilais', function (Blueprint $table) {
            $table->dropConstrainedForeignId('mahasiswa_id');
            $table->dropConstrainedForeignId('mata_kuliah_id');
        });
        Schema::table('jadwals', function (Blueprint $table) {
            $table->dropConstrainedForeignId('mata_kuliah_id');
            $table->dropConstrainedForeignId('dosen_id');
            $table->dropConstrainedForeignId('ruangan_id');
        });
        Schema::table('kelas', function (Blueprint $table) {
            $table->dropConstrainedForeignId('wali_kelas_id');
        });
        Schema::table('dosens', function (Blueprint $table) {
            $table->dropConstrainedForeignId('mata_kuliah_id');
        });
        Schema::table('mahasiswas', function (Blueprint $table) {
            $table->dropConstrainedForeignId('jurusan_id');
        });
    }
};
