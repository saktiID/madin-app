<?php

namespace App\Providers\santri;

use Exception;
use App\Models\Santri;
use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;

class SantriTambahServiceProvider extends ServiceProvider
{
    public static function tambah($request)
    {
        $avatar = '';
        if ($request->gender == 'male') {
            $avatar = 'user-male-90x90.png';
        } elseif ($request->gender == 'female') {
            $avatar = 'user-female-90x90.png';
        }

        try {

            $tambah = Santri::create([
                'id' => Str::uuid(),
                'nama_santri' => $request->nama,
                'avatar' => $avatar,
                'nis' => $request->nis,
                'nik' => $request->nik,
                'gender' => $request->gender,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                'kabupaten' => $request->kabupaten,
                'provinsi' => $request->provinsi,
            ]);
            if ($tambah) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e;
        }
    }
}
