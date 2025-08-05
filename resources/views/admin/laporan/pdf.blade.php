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
    </style>
</head>
<body>
    <h2 style="text-align: center;">Laporan Pengaduan</h2>
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
                <td>{{ optional(optional($laporan->tanggapan)->petugas)->nama ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
