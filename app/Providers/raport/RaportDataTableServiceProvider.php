<?php

namespace App\Providers\raport;

use App\Models\KelasSantri;
use Illuminate\Support\ServiceProvider;
use Yajra\DataTables\Facades\DataTables;

class RaportDataTableServiceProvider extends ServiceProvider
{
    public static function detailKelasDataTable($periode_id, $kelas_id)
    {
        $santriKelas = KelasSantri::getListSantriKelas($periode_id, $kelas_id);

        $dataTable = DataTables::of($santriKelas)
            ->addIndexColumn()
            ->addColumn('foto', function ($santriKelas) {
                $data['avatar'] = $santriKelas->avatar;
                $data['route'] = 'profile-santri';
                $data['id'] = $santriKelas->santri_id;
                $element = view('elements.avatar-datatable', $data);
                return $element;
            })->addColumn('nama', function ($santriKelas) {
                return $santriKelas->nama_santri;
            })->addColumn('nis', function ($santriKelas) {
                return $santriKelas->nis;
            })->addColumn('more', function ($santriKelas) {
                $data['nama'] = $santriKelas->nama_santri;
                $data['id'] = $santriKelas->santri_id;
                $element = view('elements.action-print-raport', $data);
                return $element;
            })->rawColumns(['foto', 'nama', 'more'])->make(true);

        return $dataTable;
    }
}
