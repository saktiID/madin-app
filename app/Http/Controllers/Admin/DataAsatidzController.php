<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Pengajar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\GlobalDataServiceProvider;
use App\Providers\AlertResponseServiceProvider as AlertResponse;
use App\Providers\asatidz\AsatidzEditServiceProvider as AsatidzEdit;
use App\Providers\asatidz\AsatidzHapusServiceProvider as AsatidzHapus;
use App\Providers\asatidz\AsatidzTambahServiceProvider as AsatidzTambah;
use App\Providers\asatidz\AsatidzDataTableServiceProvider as AsatidzDataTable;
use App\Providers\asatidz\AsatidzValidatorServiceProvider as AsatidzValidator;

class DataAsatidzController extends Controller
{
    /**
     * index method data asatidz index
     *
     * @param  mixed $request
     * @return void
     */
    public function index(Request $request)
    {
        $data = GlobalDataServiceProvider::get();

        if ($request->ajax()) {
            return AsatidzDataTable::dataTable();
        }
        return view('admin.asatidz.data-asatidz', $data);
    }

    /**
     * detail method controller detail profile
     *
     * @param  mixed $id
     * @return void
     */
    public function detail($id)
    {
        $data = GlobalDataServiceProvider::get();
        $data['data_asatidz'] = Pengajar::getProfileAsatidz($id);

        return view('admin.asatidz.profile-asatidz', $data);
    }

    /**
     * tambah method controller tambah asatidz
     *
     * @param  mixed $request
     * @return void
     */
    public function tambah(Request $request)
    {

        $validator = AsatidzValidator::validate($request);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'data' => $validator->errors()
            ]);
        } else {

            $tambah = AsatidzTambah::tambah($request);
            if ($tambah) {
                $msg = AlertResponse::response('success', 'Berhasil menambah Asatidz! <br>' . $request->nama);
                return response()->json([
                    'status' => true,
                    'data' => $msg
                ]);
            } else {
                $msg = AlertResponse::response('error', 'Gagal menambah Asatidz! <br>' . $request->nama);
                return response()->json([
                    'status' => true,
                    'data' => $msg
                ]);
            }
        }
    }

    /**
     * editCredential method controller edit credential asatidz
     *
     * @param  mixed $request
     * @return void
     */
    public function editCredential(Request $request)
    {
        // baris code cek password
        if ($request->password || $request->password_confirmation) {
            $validator = AsatidzValidator::password($request);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'data' => $validator->errors()
                ]);
            } else {
                $update = AsatidzEdit::password($request);
                if ($update) {
                    $msg = AlertResponse::response('success', 'Berhasil mengubah password Asatidz! <br>' . $request->nama);
                    return response()->json([
                        'status' => true,
                        'data' => $msg
                    ]);
                } else {
                    $msg = AlertResponse::response('error', 'Gagal mengubah password Asatidz! <br>' . $request->nama);
                    return response()->json([
                        'status' => true,
                        'data' => $msg
                    ]);
                }
            }
        }

        // baris code cek email
        $currentEmail = User::where('id', $request->user_id)->select('email')->first();
        if ($currentEmail->email != $request->email) {
            $validatorEmail = AsatidzValidator::email($request);
            if ($validatorEmail->fails()) {
                return response()->json([
                    'status' => false,
                    'data' => $validatorEmail->errors()
                ]);
            } else {
                $updateEmail = AsatidzEdit::email($request);
                if ($updateEmail) {
                    $msg = AlertResponse::response('success', 'Berhasil mengubah email Asatidz! <br>' . $request->nama);
                    return response()->json([
                        'status' => true,
                        'data' => $msg
                    ]);
                } else {
                    $msg = AlertResponse::response('error', 'Gagal mengubah email Asatidz! <br>' . $request->nama);
                    return response()->json([
                        'status' => true,
                        'data' => $msg
                    ]);
                }
            }
        }

        // baris code update user
        $updateUser = AsatidzEdit::userdata($request);
        if ($updateUser) {
            $msg = AlertResponse::response('success', 'Berhasil mengubah credential Asatidz! <br>' . $request->nama);
            return response()->json([
                'status' => true,
                'data' => $msg
            ]);
        } else {
            $msg = AlertResponse::response('error', 'Gagal mengubah credenial Asatidz! <br>' . $request->nama);
            return response()->json([
                'status' => true,
                'data' => $msg
            ]);
        }
    }

    /**
     * editBiodata method controller edit biodata asatidz
     *
     * @param  mixed $request
     * @return void
     */
    public function editBiodata(Request $request)
    {
        // baris code cek nik
        $currentNik = Pengajar::where('id', $request->pengajar_id)->select('nik')->first();
        if ($currentNik->nik != $request->nik) {
            $validator = AsatidzValidator::nik($request);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'data' => $validator->errors()
                ]);
            }
        }

        // baris code update biodata
        $updateBiodata = AsatidzEdit::biodata($request);
        if ($updateBiodata) {
            $msg = AlertResponse::response('success', 'Berhasil mengubah biodata Asatidz! <br>' . $request->nama);
            return response()->json([
                'status' => true,
                'data' => $msg
            ]);
        } else {
            $msg = AlertResponse::response('error', 'Gagal mengubah biodata Asatidz! <br>' . $request->nama);
            return response()->json([
                'status' => true,
                'data' => $msg
            ]);
        }
    }

    /**
     * foto method controller foto asatidz
     *
     * @param  mixed $request
     * @return void
     */
    public function foto(Request $request)
    {

        $image = $request->file('avatar_asatidz');
        $imageName = 'profile-' . uniqid() . '.' . $image->getClientOriginalExtension();

        $updateFoto = AsatidzEdit::foto($request, $imageName);
        if ($updateFoto) {
            $msg = AlertResponse::response('success', 'Berhasil ubah foto Asatidz!');
            return response()->json([
                'status' => true,
                'data' => $msg,
                'newImage' => $imageName
            ]);
        } else {
            $msg = AlertResponse::response('error', 'Gagal ubah foto Asatidz!');
            return response()->json([
                'status' => true,
                'data' => $msg,
            ]);
        }
    }

    /**
     * hapus method controller hapus asatidz
     *
     * @param  mixed $request
     * @return void
     */
    public function hapus(Request $request)
    {

        $hapus = AsatidzHapus::hapus($request);
        if ($hapus) {
            $msg = AlertResponse::response('success', 'Berhasil menghapus Asatidz! <br>' . $request->nama);
            return response()->json([
                'status' => true,
                'data' => $msg
            ]);
        } else {
            $msg = AlertResponse::response('error', 'Gagal menghapus Asatidz! <br>' . $request->nama);
            return response()->json([
                'status' => true,
                'data' => $msg
            ]);
        }
    }
}
