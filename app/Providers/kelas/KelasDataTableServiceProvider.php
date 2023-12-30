<?php

namespace App\Providers\kelas;

use App\Models\Kelas;
use Illuminate\Support\ServiceProvider;
use Yajra\DataTables\Facades\DataTables;

class KelasDataTableServiceProvider extends ServiceProvider
{
    public static function dataTable()
    {
        $periode_id = session()->get('periode')['id'];
        $kelas = Kelas::getListKelas($periode_id);

        $dataTable = DataTables::of($kelas)
            ->addIndexColumn()
            ->addColumn('jenjang_kelas', function ($kelas) {
                return $kelas->jenjang_kelas;
            })
            ->addColumn('nama_kelas', function ($kelas) {
                return $kelas->nama_kelas;
            })
            ->addColumn('bagian_kelas', function ($kelas) {
                return $kelas->bagian_kelas;
            })
            ->addColumn('more', function ($kelas) {
                $data['route'] = 'detail-kelas';
                $data['id'] = $kelas->id;
                $data['nama'] = $kelas->nama_kelas . ' ' . $kelas->bagian_kelas;
                $element = view('elements.action-button-datatable', $data);
                return $element;
            })
            ->rawColumns(['more'])
            ->make(true);

        return $dataTable;
    }
}
