<?php

namespace App\Providers\santri;

use Exception;
use App\Models\Santri;
use Intervention\Image\ImageManager;
use Illuminate\Support\ServiceProvider;
use Intervention\Image\Drivers\Gd\Driver;

class SantriEditServiceProvider extends ServiceProvider
{
    public static function foto($request, $imageName)
    {
        try {
            $image = $request->file('avatar');

            $oldImage = Santri::where('id', $request->id)
                ->select('avatar')->first();
            $oldImage = $oldImage->avatar;

            $manager = new ImageManager(Driver::class);
            $image = $manager->read($image);
            $image->resize(150, 150);
            $image->toPng()->save(storage_path('app/profile/' . $imageName));
            $foto = Santri::where('id', $request->id)->update(['avatar' => $imageName]);

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
            return $e;
        }
    }

    public static function biodata($request)
    {
        $updateSantri = Santri::where('id', $request->id)
            ->update([
                'nama_santri' => $request->nama,
                'nis' => $request->nis,
                'nik' => $request->nik,
                'gender' => $request->gender,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                'kabupaten' => $request->kabupaten,
                'provinsi' => $request->provinsi,
            ]);

        if ($updateSantri) {
            return true;
        } else {
            return false;
        }
    }
}
