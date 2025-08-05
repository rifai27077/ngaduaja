<?php

namespace App\Http\Controllers\AuthPetugasAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Petugas;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.admin-login'); // Buat view ini di resources/views/auth/
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Ambil data petugas dengan level admin
        $admin = Petugas::where('username', $credentials['username'])
                        ->where('level', 'admin')
                        ->first();

        if ($admin && password_verify($credentials['password'], $admin->password)) {
            Auth::guard('petugas')->login($admin);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['username' => 'Username atau password salah, atau Anda bukan admin.']);
    }

    public function logout(Request $request)
    {
        Auth::guard('petugas')->logout();
        return redirect()->route('admin.login')->with('success', 'Anda telah logout.');
    }
}
