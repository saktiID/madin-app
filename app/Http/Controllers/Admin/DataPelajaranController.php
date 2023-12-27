<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\GlobalDataServiceProvider;

class DataPelajaranController extends Controller
{
    /**
     * method controller index data pelajaran
     */
    public function index(Request $request)
    {
        $data = GlobalDataServiceProvider::get();

        return view('admin.pelajaran.data-pelajaran', $data);
    }
}
