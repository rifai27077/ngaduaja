<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Masyarakat;

class HomeController extends Controller
{
    public function index()
{
    $laporans = Pengaduan::with('masyarakat')
                ->latest()
                ->take(4)
                ->get();

    $totalLaporan = Pengaduan::count();
    $totalPengguna = Masyarakat::count();
    $selesai = Pengaduan::where('status', 'Selesai')->count();
    $persenSelesai = $totalLaporan > 0 ? round(($selesai / $totalLaporan) * 100) : 0;

    return view('home', compact('laporans', 'totalLaporan', 'totalPengguna', 'persenSelesai'));
}
}
