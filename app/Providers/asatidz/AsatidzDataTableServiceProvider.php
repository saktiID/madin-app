<?php

namespace App\Providers\asatidz;

use App\Models\Pengajar;
use Illuminate\Support\ServiceProvider;
use Yajra\DataTables\Facades\DataTables;

class AsatidzDataTableServiceProvider extends ServiceProvider
{
    public static function dataTable()
    {
        $asatidz = Pengajar::getListDataAsatidz();

        $dataTable = DataTables::of($asatidz)
            ->addIndexColumn()
            ->addColumn('foto', function ($asatidz) {
                $data['id'] = $asatidz->user_id;
                $data['route'] = 'profile-asatidz';
                $data['avatar'] = $asatidz->avatar;
                $element = view('elements.avatar-datatable', $data);
                return $element;
            })->addColumn('nama', function ($asatidz) {
                return $asatidz->nama;
            })->addColumn('email', function ($asatidz) {
                return $asatidz->email;
            })->addColumn('telp', function ($asatidz) {
                return $asatidz->telp;
            })->addColumn('more', function ($asatidz) {
                $data['id'] = $asatidz->user_id;
                $data['route'] = 'profile-asatidz';
                $data['nama'] = $asatidz->nama;
                $element = view('elements.action-button-datatable', $data);
                return $element;
            })->rawColumns(['foto', 'more'])->make(true);

        return $dataTable;
    }
}
