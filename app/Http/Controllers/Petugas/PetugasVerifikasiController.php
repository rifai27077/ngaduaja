<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tanggapan;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;

class PetugasVerifikasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengaduan::with(['masyarakat', 'tanggapan.petugas'])->orderBy('tgl_pengaduan', 'desc');

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->search) {
            $query->whereHas('masyarakat', function($q) use ($request) {
                $q->where('nama', 'like', '%'.$request->search.'%')
                ->orWhere('nik', 'like', '%'.$request->search.'%');
            });
        }

        if ($request->tanggal) {
            $query->whereDate('tgl_pengaduan', $request->tanggal);
        }

        $pengaduan = $query->get();
        return view('petugas.pengaduan.index', compact('pengaduan'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:proses,selesai'
        ]);

        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->status = $request->status;
        $pengaduan->save();

        Tanggapan::updateOrCreate(
            ['id_pengaduan' => $id],
            [
                'tgl_tanggapan' => now()->toDateString(),
                'tanggapan' => $pengaduan->tanggapan->tanggapan ?? '', // bisa diubah jadi default kosong
                'id_petugas' => Auth::guard('petugas')->user()->id_petugas,
            ]
        );


        return back()->with('success', 'Status pengaduan berhasil diperbarui dan petugas tercatat.');
    }



    public function updateTanggapan(Request $request, $id)
    {
        $request->validate([
            'tanggapan' => 'required|string',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);

        if ($pengaduan->status === 'selesai') {
            return back()->withErrors(['msg' => 'Laporan ini sudah selesai dan tidak dapat diberi tanggapan.']);
        }

        $petugas = auth('petugas')->user();
        if (!$petugas) {
            return back()->withErrors(['msg' => 'Anda harus login sebagai petugas untuk memberikan tanggapan.']);
        }

        Tanggapan::updateOrCreate(
            ['id_pengaduan' => $id],
            [
                'tgl_tanggapan' => now(),
                'tanggapan' => $request->tanggapan,
                'id_petugas' => $petugas->id_petugas,
            ]
        );
        if ($pengaduan->status === '0') {
            $pengaduan->status = 'proses';
            $pengaduan->save();
        }

        return redirect()->route('petugas.verifikasi.index')->with('success', 'Tanggapan berhasil disimpan.');
    }
}
