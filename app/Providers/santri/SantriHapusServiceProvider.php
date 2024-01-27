<?php

namespace App\Providers\santri;

use Exception;
use App\Models\Raport;
use App\Models\Santri;
use App\Models\KelasSantri;
use App\Models\NilaiSantri;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class SantriHapusServiceProvider extends ServiceProvider
{
    public static function hapus($request)
    {
        try {
            $santri = Santri::where('id', $request->id);
            $kelas_santri = KelasSantri::where('santri_id', $request->id);
            $nilai_santri = NilaiSantri::where('santri_id', $request->id);
            $raport = Raport::where('santri_id', $request->id);
            if ($santri) {
                $delSantri = $santri->delete();
                $delKelasSantri = $kelas_santri->delete();
                $delNilaiSantri = $nilai_santri->delete();
                $delRaport = $raport->delete();
            }

            if ($delSantri || $delNilaiSantri || $delKelasSantri || $delRaport) {
                return true;
            }
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
