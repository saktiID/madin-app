<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Santri;
use App\Models\Pengajar;
use App\Models\Pelajaran;
use App\Providers\GlobalDataServiceProvider;

class BerandaController extends Controller
{
    /**
     * method beranda index
     */
    public function index()
    {
        $data = GlobalDataServiceProvider::get();
        $data['countAsatidz'] = Pengajar::count();
        $data['countSantri'] = Santri::count();
        $data['countPelajaran'] = Pelajaran::count();

        return view('user.beranda.index', $data);
    }
}
