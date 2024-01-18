<?php

namespace App\Providers\pelajaran;

use Exception;
use App\Models\Pelajaran;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class PelajaranTambahServiceProvider extends ServiceProvider
{
    public static function tambah($request)
    {
        try {
            $tambah = Pelajaran::create([
                'id' => Str::uuid(),
                'nama_pelajaran' => $request->nama_pelajaran,
                'deskripsi' => $request->deskripsi,
                'is_active' => 1
            ]);
            if ($tambah) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
