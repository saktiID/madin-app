<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Providers\AlertResponseServiceProvider;

class PeriodeSetterController extends Controller
{
    public function setCurrentPeriode(Request $request)
    {
        $periode = DB::table('periodes')->where('id', $request->periode)->first();

        session(['periode' => [
            'tahun_ajaran' => $periode->tahun_ajaran,
            'semester' => $periode->semester,
            'id' => $periode->id
        ]]);


        $msg = AlertResponseServiceProvider::response('success', 'Berhasil menyimpan periode!');
        return redirect()->back()->with('response', $msg);
    }
}
