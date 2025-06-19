<?php

namespace Database\Seeders;

use App\Models\Santri;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SantriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // membuat akun santri
        Santri::create([
            'avatar' => null,
            'nama' => 'Santri Madin App 1',
            'nis' => '1234567890',
            'nik' => '1234567890123456',
            'gender' => 'L',
            'tempat_lahir' => 'Kota Madin 1',
            'tanggal_lahir' => '2000-01-01',
            'alamat' => 'Jl. Raya No. 1',
            'tahun_masuk' => '2025',
        ]);
        Santri::create([
            'avatar' => null,
            'nama' => 'Santri Madin App 2',
            'nis' => '0987654321',
            'nik' => '6543210987654321',
            'gender' => 'P',
            'tempat_lahir' => 'Kota Madin 2',
            'tanggal_lahir' => '2001-02-02',
            'alamat' => 'Jl. Raya No. 2',
            'tahun_masuk' => '2025',
        ]);
    }
}
