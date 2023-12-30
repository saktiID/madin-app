<?php

namespace App\Providers\kelas;

use Exception;
use App\Models\Kelas;
use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;

class KelasTambahServiceProvider extends ServiceProvider
{
    public static function tambah($request)
    {
        try {
            $tambah = Kelas::create([
                'id' => Str::uuid(),
                'periode_id' => $request->periode_id,
                'nama_kelas' => $request->nama_kelas,
                'bagian_kelas' => $request->bagian_kelas,
                'jenjang_kelas' => $request->jenjang_kelas,
                'mustahiq_id' => null
            ]);

            if ($tambah) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e;
        }
    }
}
