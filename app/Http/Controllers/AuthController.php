<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\AlertResponseServiceProvider as AlertResponse;
use App\Providers\GlobalDataServiceProvider;

class AuthController extends Controller
{
    /**
     * method index login
     */
    public function index()
    {
        $data = GlobalDataServiceProvider::get();
        return view('auth.index', $data);
    }

    /**
     * method auth login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5'
        ], [
            'email.required' => 'Kolom email tidak boleh kosong.',
            'email.email' => 'Kolom email harus berupa email yang valid.',
            'password.required' => 'Kolom password tidak boleh kosong.',
            'password.min' => 'Kolom password kurang dari 5 karakter.',
        ]);

        $attempt = Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);

        if ($attempt) {
            return redirect('beranda');
        } else {
            $msg = AlertResponse::response('error', 'Email atau Password salah!');
            return redirect()->route('login',)->withInput()->with('response', $msg);
        }
    }

    /**
     * method auth logout
     */
    public function logout()
    {
        Auth::logout();
        session()->flush();
        $msg = AlertResponse::response('success', 'Berhasil keluar!');
        return redirect()->route('login')->with('response', $msg);
    }
}
