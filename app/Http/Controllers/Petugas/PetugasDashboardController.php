<?php

namespace App\Http\Controllers\Petugas;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use App\Models\Masyarakat;
use Illuminate\Support\Facades\Auth;

class PetugasDashboardController extends \App\Http\Controllers\Controller
{
    public function index()
    {
        $totalMasyarakat = Masyarakat::count();
        $totalLaporan = Pengaduan::count();
        $laporanDiproses = Pengaduan::where('status', 'proses')->count();
        $laporanSelesai = Pengaduan::where('status', 'selesai')->count();
        $jumlahNotifikasi = Pengaduan::where('status', '0')->count();

        $laporanTerbaru = Pengaduan::with(relations: ['masyarakat', 'tanggapan.petugas'])
            ->orderBy('tgl_pengaduan', 'desc')
            ->take(5)
            ->get();

        $laporanBelum = Pengaduan::with(['masyarakat'])
            ->where('status', '0')
            ->latest('tgl_pengaduan')
            ->take(5)
            ->get();

        $laporanSudah = Pengaduan::with(['masyarakat', 'tanggapan.petugas'])
            ->whereIn('status', ['proses', 'selesai'])
            ->latest('tgl_pengaduan')
            ->take(5)
            ->get();

        return view('petugas.dashboard', compact(
            'totalMasyarakat',
            'totalLaporan',
            'laporanDiproses',
            'laporanSelesai',
            'laporanTerbaru',
            'laporanBelum',
            'laporanSudah',
            'jumlahNotifikasi'
        ));
    }

    public function pengaduan()
    {
        $pengaduan = Pengaduan::with(['masyarakat', 'tanggapan.petugas'])
            ->orderBy('tgl_pengaduan', 'desc')
            ->get();

        return view('petugas.pengaduan.index', compact('pengaduan'));
    }

    public function tanggapi(Request $request, $id)
    {
        $request->validate([
            'tanggapan' => 'required|string',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);

        Tanggapan::create([
            'id_pengaduan' => $pengaduan->id_pengaduan,
            'tgl_tanggapan' => now(),
            'tanggapan' => $request->tanggapan,
            'id_petugas' => Auth::guard('petugas')->user()->id_petugas,
        ]);

        $pengaduan->update(['status' => 'selesai']);

        return redirect()->route('petugas.pengaduan')->with('success', 'Tanggapan berhasil dikirim.');
    }
}