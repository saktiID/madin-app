<?php

namespace App\Http\Controllers\User;

use App\Models\Kelas;
use App\Models\Pelajaran;
use App\Models\NilaiSantri;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Providers\GlobalDataServiceProvider;
use App\Providers\AlertResponseServiceProvider as AlertResponse;
use App\Providers\penilaian\SimpanNilaiServiceProvider as SimpanNilai;
use App\Providers\nilai\NilaiDataTableServiceProvider as NilaiDataTable;
use App\Providers\penilaian\DownloadTemplateServiceProvider as DownloadTemplate;

class PenilaianController extends Controller
{
    public function index(Request $request)
    {
        $data = GlobalDataServiceProvider::get();
        $data['pelajaran_target'] = Pelajaran::where('id', $request->pelajaran_id)->first();
        $data['kelas'] = Kelas::getListKelas($data['currentPeriode']['id']);

        if ($request->ajax()) {
            return NilaiDataTable::dataTable($request);
        }

        return view('user.penilaian.index', $data);
    }

    /**
     * method controller untuk simpan nilai
     */
    public function simpan(Request $request)
    {
        $simpan = SimpanNilai::simpan($request);

        if ($simpan) {
            $msg = AlertResponse::response('success', 'Berhasil menyimpan nilai! <br>');
            return response()->json([
                'status' => true,
                'data' => $msg
            ]);
        } else {
            $msg = AlertResponse::response('error', 'Gagal menyimpan nilai! <br>');
            return response()->json([
                'status' => true,
                'data' => $msg
            ]);
        }
    }

    /**
     * method controller download template nilai
     */
    public function download(Request $request)
    {
        DownloadTemplate::download($request);
    }

    /**
     * method controller upload nilai
     */
    public function upload(Request $request)
    {
        if ($request->hasFile('excelFile')) {
            $filename = $_FILES['excelFile']['name'];
            $filetmp = $_FILES['excelFile']['tmp_name'];
            $filetype = pathinfo($filename)['extension'];
            $extAllowed = ['xls', 'xlsx',];
        } else {
            $msg = AlertResponse::response('error', 'File tidak ditemukan!');
            return response()->json([
                'status' => true,
                'data' => $msg
            ]);
        }

        if (!in_array($filetype, $extAllowed)) {
            $msg = AlertResponse::response('error', 'Format file tidak diizinkan!');
            return response()->json([
                'status' => true,
                'data' => $msg
            ]);
        }

        $reader = IOFactory::createReaderForFile($filetmp);
        $spreadsheet = $reader->load($filetmp);
        $activeWorksheet = $spreadsheet->getActiveSheet()->toArray();

        $pelajaran_id_target = $request->pelajaran_id_target;
        $pelajaran_id_excel = $activeWorksheet[2][1];

        if ($pelajaran_id_target != $pelajaran_id_excel) {
            $msg = AlertResponse::response('error', 'Mata pelajaran tidak sesuai');
            return response()->json([
                'status' => true,
                'data' => $msg
            ]);
        }

        $periode_id = $activeWorksheet[1][1];
        $pelajaran_id = $activeWorksheet[2][1];
        $kelas_id = $activeWorksheet[3][1];

        for ($i = 6; $i < count($activeWorksheet); $i++) {
            $record_nilai = NilaiSantri::updateOrCreate(
                [
                    'periode_id' => $periode_id,
                    'pelajaran_id' => $pelajaran_id,
                    'kelas_id' => $kelas_id,
                    'santri_id' => $activeWorksheet[$i][1]
                ],
                [
                    'musyafahat' => $activeWorksheet[$i][3],
                    'kitabah' => $activeWorksheet[$i][4],
                ]
            );
        }

        if ($record_nilai) {
            $msg = AlertResponse::response('success', 'Berhasil upload nilai! <br>');
            return response()->json([
                'status' => true,
                'data' => $msg
            ]);
        } else {
            $msg = AlertResponse::response('error', 'Gagal upload nilai! <br>');
            return response()->json([
                'status' => true,
                'data' => $msg
            ]);
        }
    }
}
