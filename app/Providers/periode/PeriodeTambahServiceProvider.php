<?php

namespace App\Providers\periode;

use App\Models\Periode;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class PeriodeTambahServiceProvider extends ServiceProvider
{
    public static function tambah($request)
    {
        try {
            $tambah = Periode::create([
                'tahun_ajaran' => $request->tahun_pertama . '-' . $request->tahun_kedua,
                'semester' => $request->semester
            ]);

            if ($tambah) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return Log::error($e);
        }
    }
}
