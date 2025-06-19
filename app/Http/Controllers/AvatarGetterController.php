<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class AvatarGetterController extends Controller
{
    public function get($filename)
    {
        $imagePath = 'avatars/' . $filename;
        if ($filename == 'null') {
            $file = Storage::disk('public')->get('avatar/avatar.png');
        } else {
            $file = Storage::disk('local')->get($imagePath);
            if (! isset($file)) {
                $file = Storage::disk('public')->get('img/404.png');
            }
        }

        return response($file, 200)->header('Content-Type', 'image');
    }
}
