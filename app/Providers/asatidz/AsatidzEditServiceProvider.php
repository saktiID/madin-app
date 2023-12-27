<?php

namespace App\Providers\asatidz;

use App\Models\Pengajar;
use App\Models\User;
use Exception;
use Intervention\Image\ImageManager;
use Illuminate\Support\ServiceProvider;
use Intervention\Image\Drivers\Gd\Driver;

class AsatidzEditServiceProvider extends ServiceProvider
{
    public static function foto($request, $imageName)
    {
        try {
            $image = $request->file('avatar_asatidz');

            $oldImage = User::where('id', $request->id)
                ->select('avatar')->first();
            $oldImage = $oldImage->avatar;

            $manager = new ImageManager(Driver::class);
            $image = $manager->read($image);
            $image->resize(150, 150);
            $image->toPng()->save(storage_path('app/profile/' . $imageName));

            $foto = User::where('id', $request->id)->update(['avatar' => $imageName]);

            if ($oldImage != 'user-male-90x90.png' || $oldImage != 'user-female-90x90.png') {
                if (file_exists(storage_path('app/profile/' . $oldImage))) {
                    unlink(storage_path('app/profile/' . $oldImage));
                }
            }

            if ($foto) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e;
        }
    }

    public static function password($request)
    {
        // cek apakah ada password
        if ($request->password || $request->password_confirmation) {
            $request->validate([
                'password' => 'required|min:5|confirmed'
            ], [
                'password.confirmed' => 'Password tidak sama.',
                'password.required' => 'Kolom password tidak boleh kosong.',
                'password.min' => 'Kolom password kurang dari 5 karakter.',
            ]);


            $updatePassword = User::where('id', $request->user_id)
                ->update(['password' => $request->password]);

            if ($updatePassword) {
                return true;
            }
        }
    }

    public static function email($request)
    {
        // cek email saat ini
        $currentEmail = User::where('id', $request->user_id)->first();
        $currentEmail = $currentEmail->email;

        // cek apakah email saat ini dan baru itu sama
        if ($currentEmail != $request->email) {
            // ketika beda jalankan validasi email
            $request->validate([
                'email' => 'unique:users'
            ], [
                'email.unique' => 'Email sudah ada yang menggunakan.'
            ]);
        }

        $updateUser = User::where('id', $request->user_id)
            ->update([
                'email' => $request->email,
                'nama' => $request->nama,
                'gender' => $request->gender,
                'role' => $request->role,
            ]);

        if ($updateUser) {
            return true;
        }
    }

    public static function nik($request)
    {
        // cek nik saat ini
        $currentNik = Pengajar::where('id', $request->pengajar_id)->first();
        $currentNik = $currentNik->nik;

        // cek apakah nik saat ini dan baru itu sama
        if ($currentNik != $request->nik) {
            // ketika beda jalankan validasi nik
            $request->validate([
                'nik' => 'unique:pengajars'
            ], [
                'nik.unique' => 'NIK sudah ada yang menggunakan.'
            ]);
        }

        $updatePengajar = Pengajar::where('id', $request->pengajar_id)
            ->update([
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

        if ($updatePengajar) {
            return true;
        }
    }
}
