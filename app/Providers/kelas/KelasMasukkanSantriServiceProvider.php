<?php

namespace App\Providers\kelas;

use App\Models\Santri;
use Illuminate\Support\ServiceProvider;
use Yajra\DataTables\Facades\DataTables;

class KelasMasukkanSantriServiceProvider extends ServiceProvider
{
    public static function dataTable()
    {
        $santri = Santri::getListDataSantriActive();
        $dataTable = DataTables::of($santri)
            ->addIndexColumn()
            ->addColumn('foto', function ($santri) {
                $data['avatar'] = $santri->avatar;
                $element = view('elements.avatar-datatable', $data);
                return $element;
            })->addColumn('nama', function ($santri) {
                return $santri->nama;
            })->addColumn('nis', function ($santri) {
                return $santri->nis;
            })->addColumn('more', function ($santri) {
                $data['id'] = $santri->id;
                $data['nama'] = $santri->nama;
                $element = view('elements.masukkan-santri', $data);
                return $element;
            })->rawColumns(['foto', 'more'])->make(true);

        return $dataTable;
    }
}
