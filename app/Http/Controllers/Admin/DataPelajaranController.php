<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pelajaran;
use App\Providers\GlobalDataServiceProvider;
use App\Providers\AlertResponseServiceProvider as AlertResponse;
use App\Providers\pelajaran\PelajaranTambahServiceProvider as PelajaranTambah;
use App\Providers\pelajaran\PelajaranDataTableServiceProvider as PelajaranDataTable;
use App\Providers\pelajaran\PelajaranEditSetviceProvider as PelajaranEdit;
use App\Providers\pelajaran\PelajaranHapusServiceProvider as PelajaranHapus;

class DataPelajaranController extends Controller
{
    /**
     * method controller index data pelajaran
     */
    public function index(Request $request)
    {
        $data = GlobalDataServiceProvider::get();

        if ($request->ajax()) {
            return PelajaranDataTable::dataTable();
        }

        return view('admin.pelajaran.data-pelajaran', $data);
    }

    /**
     * method controller tambah pelajaran
     */
    public function tambah(Request $request)
    {
        // baris code menambah pelajaran
        $tambah = PelajaranTambah::tambah($request);

        if ($tambah) {
            $msg = AlertResponse::response('success', 'Berhasil menambah pelajaran! <br>' . $request->nama_pelajaran);
            return response()->json([
                'status' => true,
                'data' => $msg
            ]);
        } else {
            $msg = AlertResponse::response('error', 'Gagal menambah pelajaran! <br>' . $request->nama_pelajaran);
            return response()->json([
                'status' => true,
                'data' => $msg
            ]);
        }
    }

    /**
     * mehtod controller detail pelajaran
     */
    public function detail(Request $request)
    {
        $data = GlobalDataServiceProvider::get();

        $data['pelajaran'] = Pelajaran::select(['id', 'nama_pelajaran as nama', 'deskripsi', 'is_active'])
            ->where('id', $request->id)->first();

        return view('admin.pelajaran.detail-pelajaran', $data);
    }

    /**
     * method controller edit pelajaran
     */
    public function edit(Request $request)
    {
        $update = PelajaranEdit::update($request);
        if ($update) {
            $msg = AlertResponse::response('success', 'Berhasil mengubah pelajaran ' . $request->nama);
            return response()->json([
                'status' => true,
                'data' => $msg
            ]);
        } else {
            $msg = AlertResponse::response('error', 'Gagal mengubah pelajaran ' . $request->nama);
            return response()->json([
                'status' => true,
                'data' => $msg
            ]);
        }
    }

    /**
     * method controller activate pelajaran
     */
    public function activate(Request $request)
    {
        // baris code activate pelajaran
        $activate = PelajaranEdit::activate($request);

        $status = '';
        if ($request->is_active == 'true') {
            $status = 'mengaktifkan';
        } else {
            $status = 'menonaktifkan';
        }

        if ($activate) {
            $msg = AlertResponse::response('success', 'Berhasil ' . $status . ' pelajaran! <br>' . $request->nama);
            return response()->json([
                'status' => true,
                'data' => $msg
            ]);
        } else {
            $msg = AlertResponse::response('error', 'Gagal ' . $status . ' pelajaran! <br>' . $request->nama);
            return response()->json([
                'status' => true,
                'data' => $msg
            ]);
        }
    }

    /**
     * method controller hapus pelajaran
     */
    public function hapus(Request $request)
    {
        $hapus = PelajaranHapus::hapus($request);
        if ($hapus) {
            $msg = AlertResponse::response('success', 'Berhasil menghapus pelajaran! <br>' . $request->nama_pelajaran);
            return response()->json([
                'status' => true,
                'data' => $msg
            ]);
        } else {
            $msg = AlertResponse::response('error', 'Gagal menghapus pelajaran! <br>' . $request->nama_pelajaran);
            return response()->json([
                'status' => true,
                'data' => $msg
            ]);
        }
    }
}
