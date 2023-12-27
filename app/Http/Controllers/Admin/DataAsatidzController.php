<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pengajar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\GlobalDataServiceProvider;
use App\Providers\AlertResponseServiceProvider as AlertResponse;
use App\Providers\asatidz\AsatidzEditServiceProvider as AsatidzEdit;
use App\Providers\asatidz\AsatidzHapusServiceProvider as AsatidzHapus;
use App\Providers\asatidz\AsatidzTambahServiceProvider as AsatidzTambah;
use App\Providers\asatidz\AsatidzDataTableServiceProvider as AsatidzDataTable;
use App\Providers\asatidz\AsatidzValidatorServiceProvider as AsatidzValidator;

class DataAsatidzController extends Controller
{
    /**
     * method data asatidz index
     */
    public function index(Request $request)
    {

        $data = GlobalDataServiceProvider::get();

        if ($request->ajax()) {
            return AsatidzDataTable::dataTable();
        }
        return view('admin.asatidz.data-asatidz', $data);
    }


    /**
     * method controller detail profile
     */
    public function detail($id)
    {
        $data = GlobalDataServiceProvider::get();
        $data['data_asatidz'] = Pengajar::getProfileAsatidz($id);

        return view('admin.asatidz.profile-asatidz', $data);
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
                $msg = AlertResponse::response('success', 'Berhasil menambah Asatidz! <br>' . $request->nama);
                return response()->json([
                    'status' => true,
                    'data' => $msg
                ]);
            } else {
                $msg = AlertResponse::response('error', 'Gagal menambah Asatidz! <br>' . $request->nama);
                return response()->json([
                    'status' => true,
                    'data' => $msg
                ]);
            }
        }
    }

    /**
     * method controller edit credential asatidz
     */
    public function editCredential(Request $request)
    {
        // cek apakah ada password
        $cekPassword = AsatidzEdit::password($request);
        if ($cekPassword) {
            $msg = AlertResponse::response('success', 'Berhasil mengubah password! <br>' . $request->nama);
            return redirect()->back()->with('response', $msg);
        }

        // cek email dan update credential
        $updateUser = AsatidzEdit::email($request);
        if ($updateUser) {
            $msg = AlertResponse::response('success', 'Berhasil mengubah credential! <br>' . $request->nama);
            return redirect()->back()->with('response', $msg);
        } else {
            $msg = AlertResponse::response('error', 'Gagal mengubah credential! <br>' . $request->nama);
            return redirect()->back()->with('response', $msg);
        }
    }

    /**
     * method controller edit biodata asatidz
     */
    public function editBiodata(Request $request)
    {
        // cek nik dan update biodata
        $updatePengajar = AsatidzEdit::nik($request);
        if ($updatePengajar) {
            $msg = AlertResponse::response('success', 'Berhasil mengubah biodata! <br>' . $request->nama);
            return redirect()->back()->with('response', $msg);
        } else {
            $msg = AlertResponse::response('error', 'Gagal mengubah biodata! <br>' . $request->nama);
            return redirect()->back()->with('response', $msg);
        }
    }

    /**
     * method controller foto asatidz
     */
    public function foto(Request $request)
    {

        $image = $request->file('avatar_asatidz');
        $imageName = 'profile-' . uniqid() . '.' . $image->getClientOriginalExtension();

        $updateFoto = AsatidzEdit::foto($request, $imageName);
        if ($updateFoto) {
            $msg = AlertResponse::response('success', 'Berhasil ubah foto Asatidz!');
            return response()->json([
                'status' => true,
                'data' => $msg,
                'newImage' => $imageName
            ]);
        } else {
            $msg = AlertResponse::response('error', 'Gagal ubah foto Asatidz!');
            return response()->json([
                'status' => true,
                'data' => $msg,
            ]);
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
