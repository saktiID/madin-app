<?php

namespace Database\Seeders;

use App\Models\Pelajaran;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class PelajaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pelajaran::create([
            'id' => Str::uuid(),
            'nama_pelajaran' => 'Nahwu',
            'deskripsi' => 'Jurumiyah, Muhkhtashor Jiddan, Imrithi',
            'is_active' => true,
        ]);

        Pelajaran::create([
            'id' => Str::uuid(),
            'nama_pelajaran' => 'Fiqih',
            'deskripsi' => 'Fasholatan, Mabadi Fiqhiyah, Taqrib',
            'is_active' => true,
        ]);

        Pelajaran::create([
            'id' => Str::uuid(),
            'nama_pelajaran' => 'Tauhid',
            'deskripsi' => 'Tauhid Jawan, Kharidatul Bahiyah, Tijan Ad Durori, Jawahiroh At Tauhid',
            'is_active' => true,
        ]);
    }
}
