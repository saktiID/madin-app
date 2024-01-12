<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\GlobalDataServiceProvider;
use App\Providers\raport\RaportDataTableServiceProvider as RaportDataTable;

class RaportController extends Controller
{
    public function index(Request $request)
    {
        $data = GlobalDataServiceProvider::get();
        $data['kelas'] = Kelas::getListKelas($data['currentPeriode']['id']);

        if ($request->ajax()) {
            return RaportDataTable::detailKelasDataTable($request->periode_id, $request->kelas_id);
        }

        return view('admin.raport.index', $data);
    }
}
