<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Pakai updateOrCreate: kalau ada di-update, kalau nggak ada di-insert
        User::updateOrCreate(
            ['email' => 'admin@akademik.com'],  // Kunci pencarian (harus unique)
            [                                   // Data yang mau diisi/diupdate
                'name' => 'Administrator',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );
        // 1. Akun keur BAA
        User::updateOrCreate(
            ['email' => 'baa@akademik.com'],
            [
                'name' => 'Biro Administrasi Akademik',
                'password' => Hash::make('baa123'),
                'role' => 'baa',
            ]
        );
        // 2. Akun keur Dosen (Opsional sekalian bisi butuh)
        User::updateOrCreate(
            ['email' => 'dosen@akademik.com'],
            [
                'name' => 'Dosen',
                'password' => Hash::make('dosen123'),
                'role' => 'dosen',
            ]
        );
        // 3. Akun keur Mahasiswa (Opsional sekalian bisi butuh)
        $mhsUser = User::updateOrCreate(
            ['email' => 'mahasiswa@akademik.com'],
            [
                'name' => 'Mahasiswa',
                'password' => Hash::make('mhs123'),
                'role' => 'mahasiswa',
            ]
        );

        // Hubungkan akun mahasiswa demo ke data Mahasiswa supaya fitur KRS bisa langsung dicoba
        Mahasiswa::updateOrCreate(
            ['nim' => '00000001'],
            [
                'nama' => $mhsUser->name,
                'user_id' => $mhsUser->id,
            ]
        );

        // Optional: Tambah info di console
        $this->command->info('✅ Admin user ready!');
    }
}