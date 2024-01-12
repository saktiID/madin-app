<?php

namespace App\Providers\nilai;

use App\Models\KelasSantri;
use App\Models\NilaiSantri;
use Illuminate\Support\ServiceProvider;
use Yajra\DataTables\Facades\DataTables;

class NilaiDataTableServiceProvider extends ServiceProvider
{
    public static function dataTable($request)
    {
        $data = NilaiDataTableServiceProvider::getData($request);
        $dataTable = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('nama', function ($data) {
                return $data['nama_santri'];
            })
            ->addColumn('nis', function ($data) {
                return $data['nis'];
            })
            ->addColumn('musyafahat', function ($data) {
                $data['jenis_nilai'] = 'musyafahat';
                $data['santri_id'] = $data['santri_id'];
                $data['nilai'] = $data['musyafahat'];
                $element = view('elements.input-nilai', $data);
                return $element;
            })
            ->addColumn('kitabah', function ($data) {
                $data['jenis_nilai'] = 'kitabah';
                $data['santri_id'] = $data['santri_id'];
                $data['nilai'] = $data['kitabah'];
                $element = view('elements.input-nilai', $data);
                return $element;
            })
            ->make(true);

        return $dataTable;
    }

    public static function getData($request)
    {
        $nilai = [];
        $kelas = KelasSantri::getListSantriKelas(
            $request->periode_id,
            $request->kelas_id
        )->toArray();

        foreach ($kelas as $santri) {
            $n = NilaiSantri::getNilaiSantri(
                $request->periode_id,
                $request->kelas_id,
                $request->pelajaran_id,
                $santri->santri_id
            );

            if (!isset($n)) {
                $nilai[] = [
                    'id' => '',
                    'periode' => $request->periode_id,
                    'pelajaran_id' => $request->pelajaran_id,
                    'kelas_id' => $request->kelas_id,
                    'santri_id' => $santri->santri_id,
                    'musyafahat' => '',
                    'kitabah' => '',
                    'nama_santri' => $santri->nama_santri,
                    'nis' => $santri->nis,
                ];
            } else {
                $nilai[] = [
                    'id' => $n->id,
                    'periode' => $n->periode_id,
                    'pelajaran_id' => $n->pelajaran_id,
                    'kelas_id' => $n->kelas_id,
                    'santri_id' => $n->santri_id,
                    'musyafahat' => $n->musyafahat,
                    'kitabah' => $n->kitabah,
                    'nama_santri' => $santri->nama_santri,
                    'nis' => $santri->nis,
                ];
            }
        }
        return $nilai;
    }
}
