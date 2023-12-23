<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Providers\SettingServiceProvider as SettingService;
use App\Providers\AlertResponseServiceProvider as AlertResponse;

class IdentitasController extends Controller
{
    /**
     * method identitas index
     */
    public function index()
    {
        $data = Setting::getAllSettingMadin();

        return view('admin.identitas', $data);
    }

    public function simpanSetting(Request $request)
    {

        $update = SettingService::updateSetting($request);

        if ($update) {
            $msg = AlertResponse::response('success', 'Berhasil menyimpan identitas!');
            return redirect()->route('identitas')->with('response', $msg);
        } else {
            $msg = AlertResponse::response('error', 'Gagal menyimpan identitas!');
            return redirect()->route('identitas')->with('response', $msg);
        }
    }

    public function simpanLogo(Request $request)
    {

        $image = $request->file('logo_madin');
        $imageName = 'logo-' . uniqid() . '.' . $image->getClientOriginalExtension();

        $oldImage = Setting::getSettingMadin('logo_madin');

        $manager = new ImageManager(Driver::class);
        $image = $manager->read($image);
        $image->resize(150, 150);
        $image->toPng()->save(storage_path('app/public/logo/' . $imageName));

        Setting::setSettingMadin('logo_madin', $imageName);
        $msg = AlertResponse::response('success', 'Berhasil ubah logo madin!');

        if (file_exists(storage_path('app/public/logo/' . $oldImage))) {
            unlink(storage_path('app/public/logo/' . $oldImage));
        }

        return response()->json([$msg, $imageName]);
    }
}
