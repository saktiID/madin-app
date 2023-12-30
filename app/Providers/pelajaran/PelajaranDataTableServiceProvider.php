<?php

namespace App\Providers\pelajaran;

use App\Models\Pelajaran;
use Illuminate\Support\ServiceProvider;
use Yajra\DataTables\Facades\DataTables;

class PelajaranDataTableServiceProvider extends ServiceProvider
{
    public static function dataTable()
    {
        $pelajaran = Pelajaran::getListPelajaran();

        $dataTable = DataTables::of($pelajaran)
            ->addIndexColumn()
            ->addColumn('nama_pelajaran', function ($pelajaran) {
                return $pelajaran->nama_pelajaran;
            })->addColumn('deskripsi', function ($pelajaran) {
                return $pelajaran->deskripsi;
            })->addColumn('is_active', function ($pelajaran) {
                $data['nama'] = $pelajaran->nama_pelajaran;
                $data['id'] = $pelajaran->id;
                $data['is_active'] = $pelajaran->is_active;
                $element = view('elements.switch', $data);
                return $element;
            })->addColumn('more', function ($pelajaran) {
                $data['route'] = 'detail-pelajaran';
                $data['id'] = $pelajaran->id;
                $data['nama'] = $pelajaran->nama_pelajaran;
                $element = view('elements.action-button-datatable', $data);
                return $element;
            })
            ->rawColumns(['foto', 'more'])
            ->make(true);

        return $dataTable;
    }
}
