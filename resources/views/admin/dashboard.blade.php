@extends('admin.includes.layout')

@section('title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-xl shadow-sm p-5">
            <div class="flex justify-between items-center mb-2">
                <p class="text-sm text-gray-500 font-medium">Total Masyarakat</p>
                <i class="fas fa-user text-purple-500 text-2xl"></i>
            </div>
            <h3 class="text-3xl font-bold text-gray-800">{{ $totalMasyarakat }}</h3>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-5">
            <div class="flex justify-between items-center mb-2">
                <p class="text-sm text-gray-500 font-medium">Total Laporan Masuk</p>
                <i class="fas fa-box text-yellow-500 text-2xl"></i>
            </div>
            <h3 class="text-3xl font-bold text-gray-800">{{ $totalLaporan }}</h3>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-5">
            <div class="flex justify-between items-center mb-2">
                <p class="text-sm text-gray-500 font-medium">Laporan Diproses</p>
                <i class="fas fa-spinner text-green-500 text-2xl"></i>
            </div>
            <h3 class="text-3xl font-bold text-gray-800">{{ $laporanDiproses }}</h3>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-5">
            <div class="flex justify-between items-center mb-2">
                <p class="text-sm text-gray-500 font-medium">Laporan Selesai</p>
                <i class="fas fa-check-circle text-blue-500 text-2xl"></i>
            </div>
            <h3 class="text-3xl font-bold text-gray-800">{{ $laporanSelesai }}</h3>
        </div>
    </div>

    <!-- Tabel Laporan Terbaru -->
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-gray-800">Laporan Terbaru</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left">
                <thead>
                    <tr class="bg-gray-100 text-gray-600 text-xs">
                        <th class="py-3 px-4">Nama Pelapor</th>
                        <th class="py-3 px-4">Isi Laporan</th>
                        <th class="py-3 px-4">Tanggal</th>
                        <th class="py-3 px-4">Ditangani Oleh</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach ($laporanTerbaru as $laporan)
                        <tr class="border-t border-gray-200 hover:bg-gray-50">
                            <td class="py-3 px-4">{{ $laporan->masyarakat->nama }}</td>
                            <td class="py-3 px-4">{{ Str::limit($laporan->isi_laporan, 50) }}</td>
                            <td class="py-3 px-4">{{ $laporan->tgl_pengaduan }}</td>
                            <td class="py-3 px-4">{{ optional(optional($laporan->tanggapan)->petugas)->nama ?? '-' }}</td>
                            <td class="py-3 px-4">
                                <span class="text-white text-xs px-3 py-1 rounded-full 
                                    {{ $laporan->status == 'selesai' ? 'bg-green-500' : ($laporan->status == 'proses' ? 'bg-yellow-500' : 'bg-red-500') }}">
                                    {{ $laporan->status == '0' ? 'Belum' : ucfirst($laporan->status) }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-right">
                                <a href="{{ url('admin/pengaduan/' . $laporan->id_pengaduan) }}" class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-eye text-lg"></i>
                                </a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
