<?php

namespace App\Providers\kelas;

use Exception;
use App\Models\Kelas;
use App\Models\KelasSantri;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
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
            Log::error($e);
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
            Log::error($e);
        }
    }

    public static function masukkanSantri($request)
    {
        try {
            $masuk = KelasSantri::create([
                'id' => Str::uuid(),
                'periode_id' => $request->periode_id,
                'kelas_id' => $request->kelas_id,
                'santri_id' => $request->santri_id,
            ]);

            if ($masuk) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    public static function keluarkanSantri($request)
    {
        try {
            $keluarkan = KelasSantri::where('id', $request->id)
                ->delete();

            if ($keluarkan) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
