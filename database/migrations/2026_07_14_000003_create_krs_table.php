<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('krs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswas')->cascadeOnDelete();
            $table->foreignId('jadwal_id')->constrained('jadwals')->cascadeOnDelete();
            $table->foreignId('semester_id')->constrained('semesters')->cascadeOnDelete();
            $table->enum('status', ['diambil', 'dibatalkan'])->default('diambil');
            $table->timestamps();

            // Satu mahasiswa tidak boleh mengambil jadwal yang sama 2x di semester yang sama
            $table->unique(['mahasiswa_id', 'jadwal_id', 'semester_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('krs');
    }
};