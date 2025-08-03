<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Masyarakat;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nik' => 'required|size:16',
            'password' => 'required|string',
        ]);

        $user = Masyarakat::where('nik', $request->nik)
            ->where('password', $request->password) // TANPA HASH
            ->first();

        if ($user) {
            Auth::login($user); // langsung login user
            return redirect('/')->with('success', 'Login berhasil!');
        }

        return back()->withErrors(['nik' => 'NIK atau password salah.']);
    }
    

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }
}