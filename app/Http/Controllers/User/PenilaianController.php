<?php

namespace App\Http\Controllers\User;

use App\Models\Kelas;
use App\Models\Pelajaran;
use App\Models\NilaiSantri;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\GlobalDataServiceProvider;
use App\Providers\nilai\NilaiDataTableServiceProvider as NilaiDataTable;
use App\Providers\AlertResponseServiceProvider as AlertResponse;

class PenilaianController extends Controller
{
    public function index(Request $request)
    {
        $data = GlobalDataServiceProvider::get();
        $data['pelajaran_target'] = Pelajaran::where('id', $request->pelajaran_id)->first();
        $data['kelas'] = Kelas::getListKelas($data['currentPeriode']['id']);

        if ($request->ajax()) {
            return NilaiDataTable::dataTable($request);
        }

        return view('user.penilaian.index', $data);
    }

    /**
     * method controller untuk simpan nilai
     */
    public function simpan(Request $request)
    {
        $periode_id = $request->periode_id;
        $pelajaran_id = $request->pelajaran_id;
        $kelas_id = $request->kelas_id;

        $nilai = json_decode($request->nilai);
        $musyafahat = '';
        $kitabah = '';

        foreach ($nilai as $item) {
            $pecah = explode('_', $item->tanda_nilai);
            $santri_id = $pecah[1];

            if ($pecah[0] == 'musyafahat') {
                $musyafahat = $item->isi_nilai;

                $record_nilai = NilaiSantri::updateOrCreate(
                    [
                        'periode_id' => $periode_id,
                        'pelajaran_id' => $pelajaran_id,
                        'kelas_id' => $kelas_id,
                        'santri_id' => $santri_id
                    ],
                    ['musyafahat' => $musyafahat,]
                );
            }
            if ($pecah[0] == 'kitabah') {
                $kitabah = $item->isi_nilai;

                $record_nilai = NilaiSantri::updateOrCreate(
                    [
                        'periode_id' => $periode_id,
                        'pelajaran_id' => $pelajaran_id,
                        'kelas_id' => $kelas_id,
                        'santri_id' => $santri_id
                    ],
                    ['kitabah' => $kitabah,]
                );
            }

            $musyafahat = '';
            $kitabah = '';
        }

        if ($record_nilai) {
            $msg = AlertResponse::response('success', 'Berhasil menyimpan nilai! <br>');
            return response()->json([
                'status' => true,
                'data' => $msg
            ]);
        } else {
            $msg = AlertResponse::response('error', 'Gagal menyimpan nilai! <br>');
            return response()->json([
                'status' => true,
                'data' => $msg
            ]);
        }
    }
}
