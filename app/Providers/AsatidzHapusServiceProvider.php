<?php

namespace App\Providers;

use Exception;
use App\Models\User;
use App\Models\Pengajar;
use Illuminate\Support\ServiceProvider;

class AsatidzHapusServiceProvider extends ServiceProvider
{
    public static function hapus($request)
    {
        try {
            $user = User::where('id', $request->id);
            $pengajar = Pengajar::where('user_id', $request->id);

            if ($user && $pengajar) {
                // dahulukan menghapus record yg memiliki foreign key
                $delPengajar = $pengajar->delete();
                // akhirkan menghapus record yg meiliki primary key
                $delUser = $user->delete();
            }

            if ($delPengajar && $delUser) {
                return true;
            }
        } catch (Exception $e) {
            return $e;
        }
    }
}
