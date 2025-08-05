<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tanggapan;
use App\Models\Pengaduan;

class VerifikasiController extends Controller
{
    // Menampilkan daftar pengaduan
    public function index()
    {
        $pengaduan = Pengaduan::with(['masyarakat', 'tanggapan.petugas'])
            ->orderBy('tgl_pengaduan', 'desc')
            ->get();

        return view('admin.pengaduan.index', compact('pengaduan'));
    }

    // Update status laporan (Verifikasi)
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:proses,selesai',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->status = $request->status;
        $pengaduan->save();

        return redirect()->route('admin.verifikasi.index')->with('success', 'Status laporan berhasil diperbarui.');
    }

    // Update atau Tambah Tanggapan
    public function updateTanggapan(Request $request, $id)
    {
        $request->validate([
            'tanggapan' => 'required|string',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);

        $petugas = auth('admin')->user() ?? auth('petugas')->user();
        if (!$petugas) {
            return back()->withErrors(['msg' => 'Anda harus login sebagai admin atau petugas untuk memberikan tanggapan.']);
        }

        Tanggapan::updateOrCreate(
            ['id_pengaduan' => $id],
            [
                'tgl_tanggapan' => now(),
                'tanggapan' => $request->tanggapan,
                'id_petugas' => $petugas->id_petugas,
            ]
        );

        return redirect()->route('admin.verifikasi.index')->with('success', 'Tanggapan berhasil disimpan.');
    }
}
