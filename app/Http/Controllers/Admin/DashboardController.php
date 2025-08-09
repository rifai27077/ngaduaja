<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
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

        return view('admin.dashboard', compact(
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

        $jumlahSelesai = Pengaduan::where('status', 'selesai')->count();
        $jumlahProses = Pengaduan::where('status', 'proses')->count();
        $jumlahBelum = Pengaduan::where('status', '0')->count();

        $pdf = Pdf::loadView('admin.laporan.pdf', compact(
            'pengaduan',
            'jumlahSelesai',
            'jumlahProses',
            'jumlahBelum'
        ))->setPaper('a4', 'landscape');

        return $pdf->download('laporan-pengaduan.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new LaporanExport, 'laporan-pengaduan.xlsx');
    }

    public function boot()
{
    View::composer('admin.includes.header', function ($view) {
        $jumlahNotif = Pengaduan::where('status', '0')->count();
        $view->with('jumlahNotif', $jumlahNotif);
    });
}
}
