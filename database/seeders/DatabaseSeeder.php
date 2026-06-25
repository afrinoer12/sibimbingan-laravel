<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        $userMahasiswa = User::create([
            'name' => 'Afrizal Noer',
            'email' => 'mahasiswa@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'mahasiswa',
        ]);

        Mahasiswa::create([
            'user_id' => $userMahasiswa->id,
            'nim' => '23122013',
            'nama' => 'Afrizal Noer',
            'program_studi' => 'Teknik Informatika',
            'angkatan' => '2023',
            'no_hp' => '08xxxxxxxxxx',
            'alamat' => 'Padang',
        ]);

        $userDosen = User::create([
            'name' => 'Dosen Pembimbing',
            'email' => 'dosen@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'dosen',
        ]);

        Dosen::create([
            'user_id' => $userDosen->id,
            'nidn' => '1234567890',
            'nama' => 'Dosen Pembimbing',
            'program_studi' => 'Teknik Informatika',
            'no_hp' => '08xxxxxxxxxx',
        ]);
    }
}