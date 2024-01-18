<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\GlobalDataServiceProvider;

class ProfilController extends Controller
{
    public function index()
    {
        $data = GlobalDataServiceProvider::get();
        return view('user.profil.index', $data);
    }
}
