<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Pengaduan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background: #f4f4f4; }
        .rekap-status {
            margin-top: 20px;
            margin-bottom: 10px;
            width: 100%;
        }
        .rekap-status td {
            padding: 8px 16px;
            font-weight: bold;
            border: none;
            font-size: 13px;
        }
        .rekap-selesai { background: #d4edda; color: #155724; }
        .rekap-proses { background: #cce5ff; color: #004085; }
        .rekap-belum { background: #fff3cd; color: #856404; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Laporan Pengaduan</h2>

    <table class="rekap-status">
        <tr>
            <td class="rekap-selesai">Selesai: {{ $jumlahSelesai }}</td>
            <td class="rekap-proses">Proses: {{ $jumlahProses }}</td>
            <td class="rekap-belum">Belum Ditanggapi: {{ $jumlahBelum }}</td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nama Pelapor</th>
                <th>Isi Laporan</th>
                <th>Status</th>
                <th>Petugas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengaduan as $laporan)
            <tr>
                <td>{{ $laporan->tgl_pengaduan }}</td>
                <td>{{ $laporan->masyarakat->nama }}</td>
                <td>{{ $laporan->isi_laporan }}</td>
                <td>{{ $laporan->status == '0' ? 'Belum Ditanggapi' : ucfirst($laporan->status) }}</td>
                <td>
                    {{ $laporan->tanggapan ? ($laporan->tanggapan->petugas->nama_petugas ?? '-') : 'Belum Ditanggapi' }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>