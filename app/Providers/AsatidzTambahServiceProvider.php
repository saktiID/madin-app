<?php

namespace App\Providers;

use Exception;
use App\Models\User;
use App\Models\Pengajar;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;

class AsatidzTambahServiceProvider extends ServiceProvider
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

            User::create([
                'id' => Str::uuid(),
                'nama' => $request->nama,
                'email' => $request->email,
                'role' => $request->role,
                'gender' => $request->gender,
                'avatar' => $avatar,
                'password' => Hash::make($request->password)
            ]);

            $user_id = User::where('email', $request->email)
                ->select('id')
                ->first();

            Pengajar::create([
                'id' => Str::uuid(),
                'user_id' => $user_id->id,
                'nik' => $request->nik,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'pendidikan_terakhir' => $request->pendidikan_terakhir,
                'pendidikan_islam' => $request->pendidikan_islam,
                'telp' => $request->telp,
                'alamat' => $request->alamat,
                'kabupaten' => $request->kabupaten,
                'provinsi' => $request->provinsi,
            ]);

            return true;
        } catch (Exception $e) {
            return $e;
        }
    }
}
