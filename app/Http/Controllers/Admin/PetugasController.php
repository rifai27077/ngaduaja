<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Petugas;

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = Petugas::orderBy('created_at', 'desc')->get();
        return view('admin.petugas.index', compact('petugas'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_petugas' => 'required|string|max:35',
            'username' => 'required|string|max:25',
            'password' => 'required|string|min:6',
            'telp' => 'required|string|max:13',
            'level' => 'required|in:admin,petugas',
        ]);

        // Simpan data
        Petugas::create([
            'nama_petugas' => $request->nama_petugas,
            'username' => $request->username,
            'password' => $request->password,
            'telp' => $request->telp,
            'level' => $request->level,
        ]);

        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $petugas = Petugas::findOrFail($id);
        return view('admin.petugas.edit', compact('petugas'));
    }

    public function update(Request $request, $id)
    {
        $petugas = Petugas::findOrFail($id);

        $request->validate([
            'nama_petugas' => 'required|string|max:35',
            'username' => 'required|string|max:25',
            'telp' => 'required|string|max:13',
            'level' => 'required|in:admin,petugas',
        ]);

        $petugas->update([
            'nama_petugas' => $request->nama_petugas,
            'username' => $request->username,
            'telp' => $request->telp,
            'level' => $request->level,
            'password' => $request->password ? $request->password : $petugas->password,
        ]);

        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Petugas::findOrFail($id)->delete();
        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil dihapus.');
    }
}
