<?php

namespace App\Providers\kelas;

use Exception;
use App\Models\Kelas;
use App\Models\Raport;
use App\Models\KelasSantri;
use App\Models\NilaiSantri;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class KelasHapusServiceProvider extends ServiceProvider
{
    public static function hapus($request)
    {
        try {
            $kelas = Kelas::where('id', $request->id);
            $kelas_santri = KelasSantri::where('kelas_id', $request->id);
            $nilai_santri = NilaiSantri::where('kelas_id', $request->id);
            $raport = Raport::where('kelas_id', $request->id);
            if ($kelas) {
                $delKelas = $kelas->delete();
                $delKelasSantri = $kelas_santri->delete();
                $delNilaiSantri = $nilai_santri->delete();
                $delRaport = $raport->delete();
            }

            if ($delKelas || $delKelasSantri || $delNilaiSantri || $delRaport) {
                return true;
            }
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
