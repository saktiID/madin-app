<?php

namespace App\Providers\kelas;

use Exception;
use App\Models\Kelas;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class KelasHapusServiceProvider extends ServiceProvider
{
    public static function hapus($request)
    {
        try {
            $kelas = Kelas::where('id', $request->id);
            if ($kelas) {
                $delKelas = $kelas->delete();
            }

            if ($delKelas) {
                return true;
            }
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
