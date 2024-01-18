<?php

namespace App\Providers\pelajaran;

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
            if ($pelajaran) {
                $delPelajaran = $pelajaran->delete();
            }

            if ($delPelajaran) {
                return true;
            }
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
