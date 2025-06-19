<?php

namespace Database\Seeders;

use App\Models\Identitas;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IdentitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $identitas = [
            [
                'judul_identitas' => 'Logo Madin',
                'deskripsi_identitas' => 'logo_madin_default.png',
            ],
            [
                'judul_identitas' => 'Nama Madin',
                'deskripsi_identitas' => 'Nurul Ulum',
            ],
            [
                'judul_identitas' => 'Alamat Madin',
                'deskripsi_identitas' => 'Kedungkendo RT/RW 08/10, Candi, Sidoarjo',
            ],
            [
                'judul_identitas' => 'Kota Madin',
                'deskripsi_identitas' => 'Sidoarjo',
            ],
            [
                'judul_identitas' => 'Kode Pos Madin',
                'deskripsi_identitas' => '61271',
            ],
            [
                'judul_identitas' => 'Telepon Madin',
                'deskripsi_identitas' => '0812-3456-7890',
            ],
            [
                'judul_identitas' => 'Email Madin',
                'deskripsi_identitas' => 'nurululum@mail.com',
            ],
            [
                'judul_identitas' => 'Nomor Statistik Madin',
                'deskripsi_identitas' => '123456',
            ],
            [
                'judul_identitas' => 'Kepala Madin',
                'deskripsi_identitas' => 'KH. Ahmad',
            ],
            [
                'judul_identitas' => 'Bendahara Madin',
                'deskripsi_identitas' => 'Gus Abdul',
            ],
            [
                'judul_identitas' => 'Sekretaris Madin',
                'deskripsi_identitas' => 'Ustadzah Siti',
            ],
        ];

        foreach ($identitas as $data) {
            Identitas::create([
                'slug' => Str::of($data['judul_identitas'])->slug('_'),
                'judul_identitas' => $data['judul_identitas'],
                'deskripsi_identitas' => $data['deskripsi_identitas'],
            ]);
        }
    }
}
