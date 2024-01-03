<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Pengajar;
use App\Models\KelasSantri;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\GlobalDataServiceProvider;
use App\Providers\kelas\KelasEditServiceProvider as KelasEdit;
use App\Providers\AlertResponseServiceProvider as AlertResponse;
use App\Providers\kelas\KelasHapusServiceProvider as KelasHapus;
use App\Providers\kelas\KelasTambahServiceProvider as KelasTambah;
use App\Providers\kelas\KelasDataTableServiceProvider as KelasDataTable;
use App\Providers\kelas\KelasMasukkanSantriServiceProvider as KelasMasukkanSantri;

class DataKelasController extends Controller
{
    /**
     * method controller index
     */
    public function index(Request $request)
    {
        $data = GlobalDataServiceProvider::get();

        if ($request->ajax()) {
            return KelasDataTable::dataTable();
        }

        return view('admin.kelas.data-kelas', $data);
    }

    /**
     * method controller detail kelas
     */
    public function detail(Request $request)
    {
        $data = GlobalDataServiceProvider::get();
        $data['kelas'] = Kelas::select(['id', 'nama_kelas', 'jenjang_kelas', 'bagian_kelas', 'mustahiq_id'])
            ->where('id', $request->id)->first();

        if ($data['kelas']->mustahiq_id) {
            $data['mustahiq'] = User::select(['id', 'nama', 'avatar'])
                ->where('id', $data['kelas']->mustahiq_id)->first();
        }

        if ($request->ajax()) {
            return KelasDataTable::detailKelasDataTable($request->periode_id, $request->id);
        }

        return view('admin.kelas.detail-kelas', $data);
    }

    /**
     * method controller fetch asatidz
     */
    public function asatidz()
    {
        return response()->json([
            'status' => 'success',
            'data' => Pengajar::getListDataAsatidz()
        ]);
    }

    /**
     * method controller set mustahiq
     */
    public function setMustahiq(Request $request)
    {
        $update = KelasEdit::mustahiq($request);

        if ($update) {
            $msg = AlertResponse::response(
                'success',
                'Berhasil Menjadikan Mustahiq! <br>' . $request->nama_mustahiq
            );
            return response()->json([
                'status' => true,
                'data' => $msg
            ]);
        } else {
            $msg = AlertResponse::response(
                'error',
                'Gagal Menjadikan Mustahiq! <br>' . $request->nama_mustahiq
            );
            return response()->json([
                'status' => true,
                'data' => $msg
            ]);
        }
    }

    /**
     * method cotroller ambil data santri
     */
    public function santri(Request $request)
    {
        if ($request->ajax()) {
            return KelasMasukkanSantri::dataTable();
        }
    }

    /**
     * method controller masukkan santri ke kelas
     */
    public function masukkanSantri(Request $request)
    {
        $santriKelas = KelasSantri::cekSantriKelas(
            $request->santri_id,
            $request->periode_id,
        );
        if ($santriKelas) {
            return response()->json([
                'status' => true,
                'title' => 'Gagal',
                'content' => 'sudah ada dalam kelas!'
            ]);
        } else {
            $masuk = KelasEdit::masukkanSantri($request);
            if ($masuk) {
                return response()->json([
                    'status' => true,
                    'title' => 'Berhasil',
                    'content' => 'telah dimasukkan kelas!'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'title' => 'Gagal',
                    'content' => 'gagal dimasukkan kelas!'
                ]);
            }
        }
    }

    /**
     * method controller keluarkan santri dari kelas
     */
    public function keluarkanSantri(Request $request)
    {
        $santriKelas = KelasSantri::cekSantriKelasById($request->id);

        if (!$santriKelas) {
            return response()->json([
                'status' => false,
                'title' => 'Gagal',
                'content' => 'tidak ada dalam kelas!'
            ]);
        } else {
            $keluarkan = KelasEdit::keluarkanSantri($request);
            if ($keluarkan) {
                return response()->json([
                    'status' => true,
                    'title' => 'Berhasil',
                    'content' => 'telah dikeluarkan dari kelas!'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'title' => 'Gagal',
                    'content' => 'gagal dikeluarkan dari kelas!'
                ]);
            }
        }
    }

    /**
     * method controller edit kelas
     */
    public function edit(Request $request)
    {
        $update = KelasEdit::edit($request);
        if ($update) {
            $msg = AlertResponse::response(
                'success',
                'Berhasil mengubah kelas! <br>' . $request->nama_kelas . ' ' . $request->bagian_kelas
            );
            return response()->json([
                'status' => true,
                'data' => $msg
            ]);
        } else {
            $msg = AlertResponse::response(
                'error',
                'Gagal mengubah kelas! <br>' . $request->nama_kelas . ' ' . $request->bagian_kelas
            );
            return response()->json([
                'status' => true,
                'data' => $msg
            ]);
        }
    }

    /**
     * method controller tambah
     */
    public function tambah(Request $request)
    {
        // baris code menambah kelas
        $tambah = KelasTambah::tambah($request);

        if ($tambah) {
            $msg = AlertResponse::response(
                'success',
                'Berhasil menambah kelas! <br>' . $request->nama_kelas . ' ' . $request->bagian_kelas
            );
            return response()->json([
                'status' => true,
                'data' => $msg
            ]);
        } else {
            $msg = AlertResponse::response(
                'error',
                'Gagal menambah kelas! <br>' . $request->nama_kelas . ' ' . $request->bagian_kelas
            );
            return response()->json([
                'status' => true,
                'data' => $msg
            ]);
        }
    }

    /**
     * method controller hapus kelas
     */
    public function hapus(Request $request)
    {
        // baris code hapus kelas
        $hapus = KelasHapus::hapus($request);

        if ($hapus) {
            $msg = AlertResponse::response(
                'success',
                'Berhasil menghapus kelas! <br>' . $request->nama_kelas
            );
            return response()->json([
                'status' => true,
                'data' => $msg
            ]);
        } else {
            $msg = AlertResponse::response(
                'error',
                'Gagal menghapus kelas! <br>' . $request->nama_kelas
            );
            return response()->json([
                'status' => true,
                'data' => $msg
            ]);
        }
    }
}
