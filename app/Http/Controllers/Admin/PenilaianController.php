<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\GlobalDataServiceProvider;

class PenilaianController extends Controller
{
    public function index()
    {
        $data = GlobalDataServiceProvider::get();
        return view('admin.penilaian.index', $data);
    }
}
