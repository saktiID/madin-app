<?php

namespace App\Http\Controllers;

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
            'semester' => $periode->semester
        ]]);


        $msg = AlertResponseServiceProvider::response('success', 'Berhasil menyimpan periode!');
        return redirect()->route('beranda')->with('response', $msg);
    }
}
