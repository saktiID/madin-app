<?php

namespace Database\Seeders;

use App\Models\Kitab;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KitabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kitab::create([
            'fan' => 'Fiqih',
            'nama_kitab' => 'Fasholatan',
            'jenjang' => '1',
        ]);
        Kitab::create([
            'fan' => 'Fiqih',
            'nama_kitab' => 'Mabadi Fiqhiyah',
            'jenjang' => '2',
        ]);
        Kitab::create([
            'fan' => 'Fiqih',
            'nama_kitab' => 'Fathul Qorib',
            'jenjang' => '3',
        ]);
    }
}
