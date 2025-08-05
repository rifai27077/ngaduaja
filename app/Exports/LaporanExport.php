<?php

namespace App\Exports;

use App\Models\Pengaduan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Pengaduan::with(['masyarakat', 'tanggapan.petugas'])
            ->get()
            ->map(function ($item) {
                return [
                    'Tanggal' => $item->tgl_pengaduan,
                    'Nama Pelapor' => $item->masyarakat->nama,
                    'Isi Laporan' => $item->isi_laporan,
                    'Status' => $item->status == '0' ? 'Belum Ditanggapi' : ucfirst($item->status),
                    'Petugas' => optional(optional($item->tanggapan)->petugas)->nama ?? '-',
                ];
            });
    }

    public function headings(): array
    {
        return ['Tanggal', 'Nama Pelapor', 'Isi Laporan', 'Status', 'Petugas'];
    }
}
