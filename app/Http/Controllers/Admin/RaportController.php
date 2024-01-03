<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\GlobalDataServiceProvider;

class RaportController extends Controller
{
    public function index()
    {
        $data = GlobalDataServiceProvider::get();
        return view('admin.raport.index', $data);
    }
}
