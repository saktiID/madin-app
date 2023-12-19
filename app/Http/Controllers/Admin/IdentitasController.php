<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $image->storeAs('/public/logo', $imageName);

        Setting::setSettingMadin('logo_madin', $imageName);

        $msg = AlertResponse::response('success', 'Berhasil ubah logo madin!');

        return response()->json([$msg, $imageName]);
    }
}
