<?php

namespace App\Http\Controllers\AuthPetugasAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Petugas;

class PetugasLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.petugas-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $petugas = Petugas::where('username', $credentials['username'])
                        ->where('level', 'petugas')
                        ->first();

        if ($petugas && $petugas->password === $credentials['password']) {
            Auth::guard('petugas')->login($petugas); 
            return redirect()->route('petugas.dashboard');
        }


        return back()->withErrors(['username' => 'Username atau password salah, atau Anda bukan petugas.']);
    }

    public function logout(Request $request)
    {
        Auth::guard('petugas')->logout();
        return redirect()->route('petugas.login')->with('success', 'Anda telah logout.');
    }
}
