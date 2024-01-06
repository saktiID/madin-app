<?php

namespace App\Providers\periode;

use Illuminate\Support\ServiceProvider;
use Yajra\DataTables\Facades\DataTables;

class PeriodeDataTableServiceProvider extends ServiceProvider
{
    public static function dataTable($periode)
    {
        $dataTable = DataTables::of($periode)
            ->addColumn('id', function ($periode) {
                return $periode->id;
            })->addColumn('semester', function ($periode) {
                return $periode->semester;
            })->addColumn('tahun_ajaran', function ($periode) {
                return $periode->tahun_ajaran;
            })->addColumn('more', function ($periode) {
                $data['current_periode_id'] = session()->get('periode')['id'];
                $data['id'] = $periode->id;
                $element = view('elements.current-periode', $data);
                return $element;
            })->rawColumns(['more'])->make(true);

        return $dataTable;
    }
}
