<?php

namespace App\Providers\santri;

use Exception;
use App\Models\Santri;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;

class SantriTambahServiceProvider extends ServiceProvider
{
    public static function tambah($request)
    {
        $avatar = '';
        if ($request->gender == 'male') {
            $avatar = 'user-male-90x90.png';
        } elseif ($request->gender == 'female') {
            $avatar = 'user-female-90x90.png';
        }

        try {

            $tambah = Santri::create([
                'id' => Str::uuid(),
                'nama_santri' => $request->nama,
                'avatar' => $avatar,
                'nis' => $request->nis,
                'nik' => $request->nik,
                'gender' => $request->gender,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                'kabupaten' => $request->kabupaten,
                'provinsi' => $request->provinsi,
                'tahun_masuk' => $request->tahun_masuk,
            ]);
            if ($tambah) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    public static function tambahEmis($request)
    {
        $avatar = '';
        if ($request->gender == 'male') {
            $avatar = 'user-male-90x90.png';
        } elseif ($request->gender == 'female') {
            $avatar = 'user-female-90x90.png';
        }

        $tambah = Santri::create([
            'id' => Str::uuid(),
            'avatar' => $avatar,
            'nama_santri' => $request->nama,

            'nis' => $request->nis,
            'nik' => $request->nik,
            'gender' => $request->gender,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'kabupaten' => $request->kabupaten,
            'provinsi' => $request->provinsi,
            'tahun_masuk' => $request->tahun_masuk,
            'tahun_keluar' => $request->tahun_keluar,
            'tahun_lulus' => $request->tahun_lulus,
            'no_kk' => $request->no_kk,
            'nama_kepala_keluarga' => $request->nama_kepala_keluarga,
            'jumlah_saudara' => $request->jumlah_saudara,
            'anak_ke' => $request->anak_ke,
            'cita_cita' => $request->cita_cita,
            'hobi' => $request->hobi,
            'telp' => $request->telp,
            'email' => $request->email,
            'pembiaya' => $request->pembiaya,
            'kebutuhan_khusus' => $request->kebutuhan_khusus,
            'kebutuhan_disabilitas' => $request->keyboard_kebutuhan_disabilitas,

            'nama_ayah' => $request->nama_ayah,
            'status_ayah' => $request->status_ayah,
            'kewaraganegaraan_ayah' => $request->kewaraganegaraan_ayah,
            'nik_ayah' => $request->nik_ayah,
            'tempat_lahir_ayah' => $request->tempat_lahir_ayah,
            'tanggal_lahir_ayah' => $request->tanggal_lahir_ayah,
            'pendidikan_terakhir_ayah' => $request->pendidikan_terakhir_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'penghasilan_ayah' => $request->penghasilan_ayah,
            'telp_ayah' => $request->telp_ayah,

            'nama_ibu' => $request->nama_ibu,
            'status_ibu' => $request->status_ibu,
            'kewaraganegaraan_ibu' => $request->kewaraganegaraan_ibu,
            'nik_ibu' => $request->nik_ibu,
            'tempat_lahir_ibu' => $request->tempat_lahir_ibu,
            'tanggal_lahir_ibu' => $request->tanggal_lahir_,
            'pendidikan_terakhir_ibu' => $request->pendidikan_terakhir_ibu,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'penghasilan_ibu' => $request->penghasilan_ibu,
            'telp_ibu' => $request->telp_ibu,

            'kelurahan' => $request->kelurahan,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'kode_pos' => $request->kode_pos,

        ]);
        if ($tambah) {
            return true;
        } else {
            return false;
        }
    }
}
