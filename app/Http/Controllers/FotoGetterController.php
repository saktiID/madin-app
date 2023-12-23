<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class FotoGetterController extends Controller
{
    public function foto($filename)
    {
        $imagePath = 'profile/' . $filename;
        $file = Storage::disk('local')->get($imagePath);
        $response = response($file, 200)->header('Content-Type', 'image');
        return $response;
    }
}
