@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-12 px-4">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Form Laporan Pengaduan</h2>

    <!-- Pesan Sukses -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white p-6 rounded-lg shadow-md">
        <!-- Form Laporan -->
        <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- NIK -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">NIK</label>
                <input type="text" name="nik" value="{{ Auth::user()->nik }}" readonly
                    class="w-full border px-3 py-2 rounded-lg bg-gray-100 text-gray-600 focus:outline-none">
            </div>

            <!-- Tanggal Laporan -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Laporan</label>
                <input type="date" name="tgl_pengaduan" value="{{ date('Y-m-d') }}" readonly
                    class="w-full border px-3 py-2 rounded-lg bg-gray-100 text-gray-600 focus:outline-none">
            </div>

            <!-- Isi Laporan -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Isi Laporan</label>
                <textarea name="isi_laporan" rows="4" required placeholder="Tuliskan laporan Anda secara jelas dan detail..."
                    class="w-full border px-3 py-2 rounded-lg focus:ring-green-500 focus:border-green-500">{{ old('isi_laporan') }}</textarea>
                @error('isi_laporan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Upload Foto -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Upload Foto (Opsional)</label>
                <input type="file" name="foto" accept="image/*"
                    class="w-full border px-3 py-2 rounded-lg focus:ring-green-500 focus:border-green-500">
                @error('foto')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                <p class="text-xs text-gray-500 mt-1">Format: JPG/PNG | Maks: 2MB</p>
            </div>

            <!-- Tombol Submit -->
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                    Kirim Laporan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
