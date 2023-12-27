<?php

namespace App\Providers\santri;

use App\Models\Santri;
use Illuminate\Support\ServiceProvider;
use Yajra\DataTables\Facades\DataTables;

class SantriDataTableServiceProvider extends ServiceProvider
{
    public static function dataTable()
    {
        $santri = Santri::getListDataSantri();
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
                $data['route'] = 'profile-santri';
                $data['id'] = $santri->id;
                $data['nama'] = $santri->nama;
                $element = view('elements.action-button-datatable', $data);
                return $element;
            })->rawColumns(['foto', 'more'])->make(true);

        return $dataTable;
    }
}
