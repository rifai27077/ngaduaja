@extends('admin.includes.layout')

@section('title', 'Verifikasi Laporan')

@section('content')
    <div id="modal-detail" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center px-4">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl max-h-[90vh] overflow-y-auto p-6 relative">
            <button onclick="document.getElementById('modal-detail').classList.add('hidden')"
                class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 text-xl font-bold">&times;
            </button>

            <h3 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Detail Laporan</h3>
            <div class="grid grid-cols-2 gap-4 text-sm mb-4">
                <p><strong>Nama:</strong> <span id="detail-nama"></span></p>
                <p><strong>NIK:</strong> <span id="detail-nik"></span></p>
                <p><strong>No HP:</strong> <span id="detail-telp"></span></p>
                <p><strong>Tanggal:</strong> <span id="detail-tanggal"></span></p>
                <p class="col-span-2"><strong>Status:</strong> <span id="detail-status"></span></p>
            </div>

            <div class="mb-4">
                <p class="font-semibold text-sm text-gray-700">Isi Laporan:</p>
                <div id="detail-isi" class="mt-2 p-3 bg-gray-100 rounded-md text-gray-700 text-sm max-h-48 overflow-y-auto border"></div>
            </div>

            <div>
                <p class="font-semibold text-sm text-gray-700 mb-2">Foto Bukti:</p>
                <div class="flex justify-center">
                    <img id="detail-foto" src="" 
                        class="rounded-lg border shadow max-h-72 object-contain cursor-pointer hover:scale-105 transition" 
                        alt="Foto Bukti"
                        onclick="openImageModal(this.src)">
                </div>
            </div>
        </div>
    </div>

    <div id="modal-zoom-foto" class="fixed inset-0 bg-black bg-opacity-80 z-50 hidden flex items-center justify-center px-4">
        <div class="relative">
            <button onclick="document.getElementById('modal-zoom-foto').classList.add('hidden')"
                class="absolute top-2 right-4 text-white text-3xl font-bold">&times;</button>
            <img id="zoomed-foto" src="" class="max-h-[90vh] max-w-[90vw] rounded-lg shadow-lg">
        </div>
    </div>

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Verifikasi & Tanggapan Laporan</h2>
    </div>

    {{-- <div class="flex flex-wrap gap-4 mb-4">
        <input type="text" placeholder="Cari nama atau NIK pelapor..."
            class="border border-gray-300 rounded-md px-4 py-2 text-sm w-full md:w-1/3">
        <select class="border border-gray-300 rounded-md px-3 py-2 text-sm w-full md:w-1/5">
            <option value="">Semua Status</option>
            <option value="0">Belum Ditanggapi</option>
            <option value="proses">Proses</option>
            <option value="selesai">Selesai</option>
        </select>
        <input type="date" class="border border-gray-300 rounded-md px-3 py-2 text-sm w-full md:w-1/5">
    </div> --}}

    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Daftar Laporan</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto text-sm text-left">
                <thead>
                    <tr class="bg-gray-100 text-gray-600 text-xs whitespace-nowrap">
                        <th class="py-3 px-4">No</th>
                        <th class="py-3 px-4">Tgl Pengaduan</th>
                        <th class="py-3 px-4">Nama Pelapor</th>
                        <th class="py-3 px-4">Isi Laporan</th>
                        <th class="py-3 px-4">Foto</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4">Petugas</th>
                        <th class="py-3 px-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach ($pengaduan as $i => $laporan)
                        <tr class="border-t border-gray-200 hover:bg-gray-50 whitespace-nowrap">
                            <td class="py-3 px-4">{{ $i + 1 }}</td>
                            <td class="py-3 px-4">{{ $laporan->tgl_pengaduan }}</td>
                            <td class="py-3 px-4">{{ $laporan->masyarakat->nama }}</td>
                            <td class="py-3 px-4">
                                <span class="line-clamp-1">{{ Str::limit($laporan->isi_laporan, 50) }}</span>
                                <button 
                                    onclick="openDetailModal(
                                        '{{ $laporan->masyarakat->nama }}',
                                        '{{ $laporan->masyarakat->nik }}',
                                        '{{ $laporan->masyarakat->telp }}',
                                        '{{ $laporan->tgl_pengaduan }}',
                                        `{{ $laporan->isi_laporan }}`,
                                        '{{ $laporan->status }}',
                                        '{{ asset('storage/' . $laporan->foto) }}'
                                    )" 
                                    class="text-blue-600 text-xs ml-2 hover:underline">
                                    Lihat Detail
                                </button>
                            </td>
                            <td class="py-3 px-4">
                                <img src="{{ asset('storage/' . $laporan->foto) }}" alt="Foto"
                                    class="w-12 h-12 rounded object-cover cursor-pointer hover:scale-105 transition"
                                    onclick="openImageModal('{{ asset('storage/' . $laporan->foto) }}')">
                            </td>
                            <td class="py-3 px-4">
                                <span class="text-white text-xs px-3 py-1 rounded-full 
                                    {{ $laporan->status == '0' ? 'bg-yellow-500' : ($laporan->status == 'proses' ? 'bg-blue-500' : 'bg-green-500') }}">
                                    {{ $laporan->status == '0' ? 'Belum Ditanggapi' : ucfirst($laporan->status) }}
                                </span>
                            </td>
                            <td class="py-3 px-4">{{ optional(optional($laporan->tanggapan)->petugas)->nama_petugas ?? '-' }}</td>
                            <td class="py-3 px-4 flex gap-2">
                                <button 
                                    @if($laporan->status == 'selesai') 
                                        disabled 
                                        class="bg-gray-400 text-white text-xs px-3 py-2 rounded cursor-not-allowed opacity-70" 
                                    @else 
                                        onclick="document.getElementById('modal-verif-{{ $laporan->id_pengaduan }}').classList.remove('hidden')" 
                                        class="bg-blue-600 text-white text-xs px-3 py-2 rounded hover:bg-blue-700"
                                    @endif>
                                    Verifikasi
                                </button>

                                <button 
                                    @if($laporan->status == 'selesai') 
                                        disabled 
                                        class="bg-gray-400 text-white text-xs px-3 py-2 rounded cursor-not-allowed opacity-70" 
                                    @else 
                                        onclick="document.getElementById('modal-tanggapan-{{ $laporan->id_pengaduan }}').classList.remove('hidden')" 
                                        class="bg-green-600 text-white text-xs px-3 py-2 rounded hover:bg-green-700"
                                    @endif>
                                    Tanggapan
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @foreach ($pengaduan as $laporan)
        <div id="modal-verif-{{ $laporan->id_pengaduan }}" 
            class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center px-4">
            <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative">
                <button type="button" 
                    onclick="document.getElementById('modal-verif-{{ $laporan->id_pengaduan }}').classList.add('hidden')"
                    class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 text-xl font-bold">&times;
                </button>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Verifikasi Laporan</h3>
                <form action="{{ route('admin.verifikasi.update', $laporan->id_pengaduan) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm" 
                            @if($laporan->status == 'selesai') disabled @endif required>
                            <option value="proses" {{ $laporan->status == 'proses' ? 'selected' : '' }}>Proses</option>
                            <option value="selesai" {{ $laporan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>

                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="document.getElementById('modal-verif-{{ $laporan->id_pengaduan }}').classList.add('hidden')" class="px-4 py-2 text-sm border rounded-md hover:bg-gray-100">Batal</button>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm hover:bg-blue-700">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    @foreach ($pengaduan as $laporan)
        <div id="modal-tanggapan-{{ $laporan->id_pengaduan }}" 
            class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center px-4">
            <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative">
                <button type="button" 
                    onclick="document.getElementById('modal-tanggapan-{{ $laporan->id_pengaduan }}').classList.add('hidden')"
                    class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 text-xl font-bold">&times;
                </button>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Tanggapan Laporan</h3>
                <form action="{{ route('admin.tanggapan.update', $laporan->id_pengaduan) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggapan</label>
                        <textarea name="tanggapan" rows="3" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm" required>{{ $laporan->tanggapan->tanggapan ?? '' }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ubah Status</label>
                        <select name="status" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm" required>
                            <option value="proses" {{ $laporan->status == 'proses' ? 'selected' : '' }}>Proses</option>
                            <option value="selesai" {{ $laporan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="document.getElementById('modal-tanggapan-{{ $laporan->id_pengaduan }}').classList.add('hidden')" class="px-4 py-2 text-sm border rounded-md hover:bg-gray-100">Batal</button>
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md text-sm hover:bg-green-700">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
@endsection

<script>
    function openDetailModal(nama, nik, telp, tanggal, isi, status, foto) {
        document.getElementById('detail-nama').innerText = nama;
        document.getElementById('detail-nik').innerText = nik;
        document.getElementById('detail-telp').innerText = telp;
        document.getElementById('detail-tanggal').innerText = tanggal;
        document.getElementById('detail-isi').innerText = isi;
        document.getElementById('detail-status').innerText = (status === '0') ? 'Belum Ditanggapi' : status.charAt(0).toUpperCase() + status.slice(1);
        document.getElementById('detail-foto').src = foto;
        document.getElementById('modal-detail').classList.remove('hidden');
    }

    function openImageModal(src) {
        document.getElementById('zoomed-foto').src = src;
        document.getElementById('modal-zoom-foto').classList.remove('hidden');
    }
</script>
