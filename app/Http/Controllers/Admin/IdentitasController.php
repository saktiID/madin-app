<?php

namespace App\Http\Controllers\Admin;

use App\Models\Identitas;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class IdentitasController extends Controller
{
    public function index()
    {
        $identitas = (object) Identitas::all()
            ->pluck('deskripsi_identitas', 'slug')
            ->toArray();

        return inertia('Admin/Identitas/Identitas', [
            'identitas' => $identitas,
        ]);
    }

    public function update(Request $request)
    {
        // Handle the request to update data
        $data = $request->all();
        foreach ($data as $key => $value) {
            Identitas::where('slug', $key)->update(['deskripsi_identitas' => $value]);
        }
        return redirect()->back()->with('success', 'Data identitas berhasil diperbarui.');
    }

    public function uploadLogo(Request $request)
    {

        // Validasi file yang diupload
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Ambil file yang diupload
        $file = $request->file('logo');
        $filename = 'logo_madin_' . Str::random(5);
        $path = 'app/public/logo/';
        $manager = new ImageManager(new Driver());
        $image = $manager->read($file);
        $image->resize(250, 250);
        $encoded = $image->toPng();
        $encoded->save(storage_path($path . $filename . '.png'));

        // Update tabel identitas
        $identitas = Identitas::where('slug', 'logo_madin')->first();
        if ($identitas) {
            $identitas->deskripsi_identitas = $filename . '.png';
            $identitas->save();
        }

        return redirect()->back()->with('success', 'Logo berhasil diperbarui.');
    }
}
