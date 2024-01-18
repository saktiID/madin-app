<?php

namespace App\Providers\asatidz;

use App\Models\Pengajar;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;
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

            if ($oldImage != 'user-male-90x90.png' && $oldImage != 'user-female-90x90.png') {
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
            Log::error($e);
        }
    }

    public static function password($request)
    {
        $updatePassword = User::where('id', $request->user_id)
            ->update(['password' => $request->password]);

        if ($updatePassword) {
            return true;
        } else {
            return false;
        }
    }

    public static function email($request)
    {
        $updateEmail = User::where('id', $request->user_id)
            ->update(['email' => $request->email,]);

        if ($updateEmail) {
            return true;
        } else {
            return false;
        }
    }

    public static function userdata($request)
    {
        $updateUser = User::where('id', $request->user_id)
            ->update([
                'nama' => $request->nama,
                'role' => $request->role,
                'gender' => $request->gender
            ]);

        if ($updateUser) {
            return true;
        } else {
            return false;
        }
    }

    public static function biodata($request)
    {
        $updateBiodata = Pengajar::where('id', $request->pengajar_id)
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

        if ($updateBiodata) {
            return true;
        } else {
            return false;
        }
    }
}
