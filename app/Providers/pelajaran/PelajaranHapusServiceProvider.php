<?php

namespace App\Providers\pelajaran;

use App\Models\NilaiSantri;
use Exception;
use App\Models\Pelajaran;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class PelajaranHapusServiceProvider extends ServiceProvider
{
    public static function hapus($request)
    {
        try {
            $pelajaran = Pelajaran::where('id', $request->id);
            $nilai_santri = NilaiSantri::where('pelajaran_id', $request->id);
            if ($pelajaran) {
                $delPelajaran = $pelajaran->delete();
                $delNilaiSantri = $nilai_santri->delete();
            }

            if ($delPelajaran || $delNilaiSantri) {
                return true;
            }
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
