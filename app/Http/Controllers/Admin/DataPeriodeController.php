<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\GlobalDataServiceProvider;

class DataPeriodeController extends Controller
{
    public function index()
    {
        $data = GlobalDataServiceProvider::get();

        return view('admin.periode.data-periode', $data);
    }
}
