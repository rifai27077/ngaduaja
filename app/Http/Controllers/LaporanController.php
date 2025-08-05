<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'isi_laporan' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $foto = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('uploads', 'public');
        }

        Pengaduan::create([
            'tgl_pengaduan' => date('Y-m-d'),
            'nik' => Auth::user()->nik,
            'isi_laporan' => $request->isi_laporan,
            'foto' => $foto,
            'status' => '0',
            'created_at' => now(),
        ]);

        return redirect()->route('laporan.form')->with('success', 'Laporan berhasil dikirim!');
    }
}
