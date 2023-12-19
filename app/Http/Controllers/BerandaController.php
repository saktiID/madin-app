<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    /**
     * method beranda index
     */
    public function index()
    {
        return view('beranda');
    }
}
