<?php

namespace App\Providers\kelas;

use App\Models\Kelas;
use Exception;
use Illuminate\Support\ServiceProvider;

class KelasEditServiceProvider extends ServiceProvider
{
    public static function mustahiq($request)
    {
        try {
            $update = Kelas::where('id', $request->kelas_id)
                ->update(['mustahiq_id' => $request->mustahiq_id]);

            if ($update) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e;
        }
    }

    public static function edit($request)
    {
        try {
            $update = Kelas::where('id', $request->kelas_id)
                ->update([
                    'nama_kelas' => $request->nama_kelas,
                    'bagian_kelas' => $request->bagian_kelas,
                    'jenjang_kelas' => $request->jenjang_kelas,
                ]);

            if ($update) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e;
        }
    }
}
