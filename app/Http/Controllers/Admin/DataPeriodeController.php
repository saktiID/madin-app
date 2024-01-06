<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\GlobalDataServiceProvider;
use App\Providers\periode\PeriodeDataTableServiceProvider as PeriodeDataTable;
use App\Providers\AlertResponseServiceProvider as AlertResponse;
use App\Providers\periode\PeriodeTambahServiceProvider;

class DataPeriodeController extends Controller
{
    public function index(Request $request)
    {
        $data = GlobalDataServiceProvider::get();

        if ($request->ajax()) {
            $periode = $data['periode'];
            return PeriodeDataTable::dataTable($periode);
        }

        return view('admin.periode.index', $data);
    }

    /**
     * method controller tambah periode
     */
    public function tambah(Request $request)
    {
        if ($request->kunci_kode_konfirmasi != $request->kode_konfirmasi) {
            $msg = AlertResponse::response('error', 'Kode konfirmasi tidak benar.');
            return response()->json([
                'status' => true,
                'data' => $msg
            ]);
        } else {
            $tambah = PeriodeTambahServiceProvider::tambah($request);
            if ($tambah) {
                $msg = AlertResponse::response('success', 'Berhasil menambah periode!');
                return response()->json([
                    'status' => true,
                    'data' => $msg
                ]);
            } else {
                $msg = AlertResponse::response('success', 'Gagals menambah periode!');
                return response()->json([
                    'status' => true,
                    'data' => $msg
                ]);
            }
        }
    }
}
