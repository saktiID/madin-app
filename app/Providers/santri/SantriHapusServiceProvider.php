<?php

namespace App\Providers\santri;

use Exception;
use App\Models\Santri;
use Illuminate\Support\ServiceProvider;

class SantriHapusServiceProvider extends ServiceProvider
{
    public static function hapus($request)
    {
        try {
            $santri = Santri::where('id', $request->id);
            if ($santri) {
                $delSantri = $santri->delete();
            }

            if ($delSantri) {
                return true;
            }
        } catch (Exception $e) {
            return $e;
        }
    }
}
