<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Masyarakat;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanExport;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMasyarakat = Masyarakat::count();
        $totalLaporan = Pengaduan::count();
        $laporanDiproses = Pengaduan::where('status', 'proses')->count();
        $laporanSelesai = Pengaduan::where('status', 'selesai')->count();

        $laporanTerbaru = Pengaduan::with(['masyarakat', 'tanggapan.petugas'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalMasyarakat',
            'totalLaporan',
            'laporanDiproses',
            'laporanSelesai',
            'laporanTerbaru'
        ));
    }

    public function laporan()
    {
        $pengaduan = Pengaduan::with(['masyarakat', 'tanggapan.petugas'])
            ->orderBy('tgl_pengaduan', 'desc')
            ->get();

        return view('admin.laporan.index', compact('pengaduan'));
    }

    public function exportPdf()
    {
        $pengaduan = Pengaduan::with(['masyarakat', 'tanggapan.petugas'])->get();
        $pdf = Pdf::loadView('admin.laporan.pdf', compact('pengaduan'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('laporan-pengaduan.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new LaporanExport, 'laporan-pengaduan.xlsx');
    }
}
