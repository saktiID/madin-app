<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\AlertResponseServiceProvider as AlertResponse;

class AuthController extends Controller
{
    /**
     * method index login
     */
    public function index()
    {
        return view('auth.index');
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
        $msg = AlertResponse::response('success', 'Berhasil keluar!');
        return redirect()->route('login')->with('response', $msg);
    }
}
