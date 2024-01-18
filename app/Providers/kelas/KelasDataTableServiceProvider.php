<?php

namespace App\Providers\kelas;

use App\Models\Kelas;
use App\Models\KelasSantri;
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
                $data['id'] = $santriKelas->id; // id dari kelas_santris table
                $element = view('elements.keluarkan-santri', $data);
                return $element;
            })->rawColumns(['foto', 'nama', 'more'])->make(true);

        return $dataTable;
    }
}
