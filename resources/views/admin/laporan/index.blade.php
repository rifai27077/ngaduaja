@extends('admin.includes.layout')

@section('title', 'Generate Laporan')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Generate Laporan</h2>
</div>


<div class="flex gap-3 mb-4">
    <a href="{{ route('admin.laporan.export.pdf', request()->only(['start_date', 'end_date'])) }}" 
        class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
        Export PDF
    </a>
    <a href="{{ route('admin.laporan.export.excel', request()->only(['start_date', 'end_date'])) }}" 
        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
        Export Excel
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm p-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Laporan Pengaduan</h3>
    <div class="overflow-x-auto">
        <table class="min-w-full table-auto text-sm text-left">
            <thead>
                <tr class="bg-gray-100 text-gray-600 text-xs whitespace-nowrap">
                    <th class="py-3 px-4">Tanggal</th>
                    <th class="py-3 px-4">Nama Pelapor</th>
                    <th class="py-3 px-4">Isi Laporan</th>
                    <th class="py-3 px-4">Status</th>
                    <th class="py-3 px-4">Petugas</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pengaduan as $laporan)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="py-3 px-4">{{ $laporan->tgl_pengaduan }}</td>
                        <td class="py-3 px-4">{{ $laporan->masyarakat->nama }}</td>
                        <td class="py-3 px-4">{{ Str::limit($laporan->isi_laporan, 50) }}</td>
                        <td class="py-3 px-4">
                            <span class="text-white text-xs px-3 py-1 rounded-full 
                                {{ $laporan->status == '0' ? 'bg-yellow-500' : ($laporan->status == 'proses' ? 'bg-blue-500' : 'bg-green-500') }}">
                                {{ $laporan->status == '0' ? 'Belum Ditanggapi' : ucfirst($laporan->status) }}
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            {{ $laporan->tanggapan ? ($laporan->tanggapan->petugas->nama_petugas ?? '-') : 'Belum Ditanggapi' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500">Tidak ada data laporan untuk periode ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
