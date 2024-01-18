<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kelas;
use App\Models\Raport;
use App\Models\Setting;
use App\Models\KelasSantri;
use App\Models\NilaiSantri;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\GlobalDataServiceProvider;
use App\Providers\raport\RaportDataTableServiceProvider as RaportDataTable;
use ZanySoft\LaravelPDF\PDF;

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

    public function print(Request $request)
    {

        $data = GlobalDataServiceProvider::get();

        $record_raport = Raport::where('santri_id', $request->id)
            ->where('periode_id', $data['currentPeriode']['id'])->first();

        $data['nama_kepala_madin'] = Setting::getSettingMadin('nama_kepala_madin');
        $data['santri'] = KelasSantri::getSantriDiKelasManaById(
            $data['currentPeriode']['id'],
            $request->id
        );

        if (!empty($record_raport)) {
            $data['no_raport'] = $record_raport->no_raport;
            $data['tanggal_raport'] = $record_raport->tanggal_raport;
        } else {
            $data['tanggal_raport'] = $request->tanggal_raport;
            $data['no_raport'] = date("Ymd") . '-' . strtoupper(Str::random(7));
            Raport::create([
                'no_raport' => $data['no_raport'],
                'tanggal_raport' => $request->tanggal_raport,
                'periode_id' => $data['currentPeriode']['id'],
                'kelas_id' => $data['santri']->kelas_id,
                'santri_id' => $request->id,
            ]);
        }

        $data['nilai_raport'] = [];
        $data['total_musyafahat'] = 0;
        $data['total_kitabah'] = 0;
        $count_pelajaran = 0;

        foreach ($data['pelajaran'] as $pelajaran) {

            $nilai = NilaiSantri::getNilaiSantri(
                $data['currentPeriode']['id'],
                $data['santri']->kelas_id,
                $pelajaran->id,
                $data['santri']->santri_id,
            );

            array_push(
                $data['nilai_raport'],
                [
                    'nama_pelajaran' => $pelajaran->nama_pelajaran,
                    'musyafahat' => ($nilai) ? $nilai->musyafahat : '0',
                    'kitabah' => ($nilai) ? $nilai->kitabah : '0',
                ]
            );

            if ($nilai) {
                $data['total_musyafahat'] = $data['total_musyafahat'] + intval($nilai->musyafahat);
                $data['total_kitabah'] = $data['total_kitabah'] + intval($nilai->kitabah);
                $count_pelajaran++;
            }
        }
        $data['rata_musyafahat'] = $data['total_musyafahat'] / $count_pelajaran;
        $data['rata_musyafahat'] = floor($data['rata_musyafahat'] * 100) / 100;
        $data['rata_kitabah'] = $data['total_kitabah'] / $count_pelajaran;
        $data['rata_kitabah'] = floor($data['rata_kitabah'] * 100) / 100;

        return view('pdf.raport-santri', $data);
    }
}
