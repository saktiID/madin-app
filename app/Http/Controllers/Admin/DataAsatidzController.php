<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pengajar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\AlertResponseServiceProvider as AlertResponse;
use App\Providers\AsatidzDataTableServiceProvider as AsatidzDataTable;
use App\Providers\AsatidzHapusServiceProvider as AsatidzHapus;
use App\Providers\AsatidzTambahServiceProvider as AsatidzTambah;
use App\Providers\AsatidzValidatorServiceProvider as AsatidzValidator;

class DataAsatidzController extends Controller
{
    /**
     * method data asatidz index
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return AsatidzDataTable::dataTable();
        }
        return view('admin.data-asatidz');
    }


    /**
     * method controller detail profile
     */
    public function detail($id)
    {
        if (!isset($id)) {
            return redirect()->route('data-asatidz');
        }

        $data['data_asatidz'] = Pengajar::getProfileAsatidz($id);

        return view('admin.profile-asatidz', $data);
    }

    /**
     * method controller tambah asatidz
     */
    public function tambah(Request $request)
    {

        $validator = AsatidzValidator::validate($request);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'data' => $validator->errors()
            ]);
        } else {

            $tambah = AsatidzTambah::tambah($request);
            if ($tambah) {
                $msg = AlertResponse::response('success', 'Berhasil menambah Asatidz! <b>' . $request->nama);
                return response()->json([
                    'status' => true,
                    'data' => $msg
                ]);
            } else {
                $msg = AlertResponse::response('error', 'Gagal menambah Asatidz! <b>' . $request->nama);
                return response()->json([
                    'status' => true,
                    'data' => $msg
                ]);
            }
        }
    }

    /**
     * method controller hapus asatidz
     */
    public function hapus(Request $request)
    {

        $hapus = AsatidzHapus::hapus($request);
        if ($hapus) {
            $msg = AlertResponse::response('success', 'Berhasil menghapus Asatidz! <br>' . $request->nama);
            return response()->json([
                'status' => true,
                'data' => $msg
            ]);
        } else {
            $msg = AlertResponse::response('error', 'Gagal menghapus Asatidz! <br>' . $request->nama);
            return response()->json([
                'status' => true,
                'data' => $msg
            ]);
        }
    }
}
