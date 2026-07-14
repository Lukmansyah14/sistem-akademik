<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Semester aktif: KRS hanya bisa diisi pada semester yang sedang berjalan
        Schema::table('semesters', function (Blueprint $table) {
            $table->boolean('is_aktif')->default(false)->after('tahun_ajaran');
        });

        // 2. Prasyarat mata kuliah (self relation, 1 prasyarat per matkul cukup untuk skala UAS)
        Schema::table('mata_kuliahs', function (Blueprint $table) {
            $table->foreignId('prasyarat_id')->nullable()->after('sks')
                ->constrained('mata_kuliahs')->nullOnDelete();
        });

        // 3. Jadwal: perlu tahu ini penawaran di semester mana + kapasitas kelasnya
        Schema::table('jadwals', function (Blueprint $table) {
            $table->foreignId('semester_id')->nullable()->after('ruangan_id')
                ->constrained('semesters')->nullOnDelete();
            $table->integer('kapasitas')->default(40)->after('semester_id');
        });

        // 4. Hubungkan akun login (users) ke data mahasiswa secara eksplisit,
        //    supaya tidak lagi mencocokkan berdasarkan nama (rawan salah/duplikat).
        Schema::table('mahasiswas', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->unique()->after('id')
                ->constrained('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('mahasiswas', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_id');
        });
        Schema::table('jadwals', function (Blueprint $table) {
            $table->dropConstrainedForeignId('semester_id');
            $table->dropColumn('kapasitas');
        });
        Schema::table('mata_kuliahs', function (Blueprint $table) {
            $table->dropConstrainedForeignId('prasyarat_id');
        });
        Schema::table('semesters', function (Blueprint $table) {
            $table->dropColumn('is_aktif');
        });
    }
};