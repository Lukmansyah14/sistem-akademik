<?php

namespace Database\Seeders;

use App\Models\User;
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
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Optional: Tambah info di console
        $this->command->info('✅ Admin user ready!');
    }
}