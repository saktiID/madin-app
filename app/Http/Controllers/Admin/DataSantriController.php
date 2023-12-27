<?php

namespace App\Http\Controllers\Admin;

use App\Models\Santri;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\GlobalDataServiceProvider;
use App\Providers\AlertResponseServiceProvider as AlertResponse;
use App\Providers\santri\SantriEditServiceProvider as SantriEdit;
use App\Providers\santri\SantriHapusServiceProvider as SantriHapus;
use App\Providers\santri\SantriTambahServiceProvider as SantriTambah;
use App\Providers\santri\SantriDataTableServiceProvider as SantriDataTable;
use App\Providers\santri\SantriValidatorServiceProvider as SantriValidator;

class DataSantriController extends Controller
{
    /**
     * method controller index santri
     */
    public function index(Request $request)
    {

        $data = GlobalDataServiceProvider::get();

        if ($request->ajax()) {
            return SantriDataTable::dataTable();
        }

        return view('admin.santri.data-santri', $data);
    }

    /**
     * method controller detail santri
     */
    public function detail(Request $request)
    {
        $data = GlobalDataServiceProvider::get();
        $data['santri'] = Santri::getProfileSantri($request->id);

        return view('admin.santri.profile-santri', $data);
    }

    /**
     * method controller tambah santri
     */
    public function tambah(Request $request)
    {
        // baris code validator
        $validator = SantriValidator::validate($request);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'data' => $validator->errors()
            ]);
        } else {
            // baris code menambah santri
            $tambah = SantriTambah::tambah($request);

            if ($tambah) {
                $msg = AlertResponse::response('success', 'Berhasil menambah Santri! <br>' . $request->nama);
                return response()->json([
                    'status' => true,
                    'data' => $msg
                ]);
            } else {
                $msg = AlertResponse::response('error', 'Gagal menambah Santri! <br>' . $request->nama);
                return response()->json([
                    'status' => true,
                    'data' => $msg
                ]);
            }
        }
    }

    /**
     * method controller edit santri
     */
    public function edit(Request $request)
    {
        // baris code validator nik dan nis sekaligus update record santri
        $update = SantriEdit::biodata($request);
        if ($update) {
            $msg = AlertResponse::response('success', 'Berhasil mengubah data Santri! <br>' . $request->nama);
            return redirect()->back()->with('response', $msg);
        } else {
            $msg = AlertResponse::response('error', 'Gagal mengubah data Santri! <br>' . $request->nama);
            return redirect()->back()->with('response', $msg);
        }
    }

    /**
     * method controller edit foto santri
     */
    public function foto(Request $request)
    {
        $image = $request->file('avatar');
        $imageName = 'profile-' . uniqid() . '.' . $image->getClientOriginalExtension();

        $updateFoto = SantriEdit::foto($request, $imageName);
        if ($updateFoto) {
            $msg = AlertResponse::response('success', 'Berhasil ubah foto Santri!');
            return response()->json([
                'status' => true,
                'data' => $msg,
                'newImage' => $imageName
            ]);
        } else {
            $msg = AlertResponse::response('error', 'Gagal ubah foto Santri!');
            return response()->json([
                'status' => true,
                'data' => $msg,
            ]);
        }
    }

    /**
     * method controller detail santri
     */
    public function hapus(Request $request)
    {
        $hapus = SantriHapus::hapus($request);
        if ($hapus) {
            $msg = AlertResponse::response('success', 'Berhasil menghapus Santri! <br>' . $request->nama);
            return response()->json([
                'status' => true,
                'data' => $msg
            ]);
        } else {
            $msg = AlertResponse::response('error', 'Gagal menghapus Santri! <br>' . $request->nama);
            return response()->json([
                'status' => true,
                'data' => $msg
            ]);
        }
    }
}
