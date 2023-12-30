<?php

namespace App\Providers\pelajaran;

use App\Models\Pelajaran;
use Illuminate\Support\ServiceProvider;

class PelajaranEditSetviceProvider extends ServiceProvider
{
    public static function activate($request)
    {
        $value = '';
        if ($request->is_active == 'true') {
            $value = 1;
        } else {
            $value = 0;
        }
        $activate = Pelajaran::where('id', $request->id)
            ->update(['is_active' => $value]);

        if ($activate) {
            return true;
        } else {
            return false;
        }
    }

    public static function update($request)
    {
        $update = Pelajaran::where('id', $request->id)
            ->update([
                'nama_pelajaran' => $request->nama,
                'deskripsi' => $request->deskripsi
            ]);

        if ($update) {
            return true;
        } else {
            return false;
        }
    }
}
