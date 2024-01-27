<?php

namespace App\Providers\penilaian;

use App\Models\NilaiSantri;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class SimpanNilaiServiceProvider extends ServiceProvider
{
    public static function simpan($request)
    {
        try {
            $periode_id = $request->periode_id;
            $pelajaran_id = $request->pelajaran_id;
            $kelas_id = $request->kelas_id;

            $nilai = json_decode($request->nilai);
            $musyafahat = '';
            $kitabah = '';

            foreach ($nilai as $item) {
                $pecah = explode('_', $item->tanda_nilai);
                $santri_id = $pecah[1];

                if ($pecah[0] == 'musyafahat') {
                    $musyafahat = $item->isi_nilai;

                    $record_nilai = NilaiSantri::updateOrCreate(
                        [
                            'periode_id' => $periode_id,
                            'pelajaran_id' => $pelajaran_id,
                            'kelas_id' => $kelas_id,
                            'santri_id' => $santri_id
                        ],
                        ['musyafahat' => $musyafahat,]
                    );
                }
                if ($pecah[0] == 'kitabah') {
                    $kitabah = $item->isi_nilai;

                    $record_nilai = NilaiSantri::updateOrCreate(
                        [
                            'periode_id' => $periode_id,
                            'pelajaran_id' => $pelajaran_id,
                            'kelas_id' => $kelas_id,
                            'santri_id' => $santri_id
                        ],
                        ['kitabah' => $kitabah,]
                    );
                }

                $musyafahat = '';
                $kitabah = '';
            }

            if ($record_nilai) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            Log::error($e);
        }
    }
}
