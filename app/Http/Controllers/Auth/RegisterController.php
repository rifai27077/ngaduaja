<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Masyarakat;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nik' => 'required|size:16|unique:masyarakat,nik',
            'nama' => 'required|string|max:35',
            'username' => 'required|string|max:25|unique:masyarakat,username',
            'password' => 'required|string|min:4',
            'telp' => 'required|string|max:13',
        ]);

        Masyarakat::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => $request->password, // TANPA HASH
            'telp' => $request->telp,
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
