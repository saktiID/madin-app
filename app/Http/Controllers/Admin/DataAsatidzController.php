<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataAsatidzController extends Controller
{
    /**
     * method data asatidz index
     */
    public function index()
    {

        return view('admin.data-asatidz');
    }
}
