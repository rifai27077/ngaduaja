@extends('admin.includes.layout')

@section('title', 'Manajemen Petugas')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Manajemen Petugas</h2>
        <button onclick="document.getElementById('modal-tambah').classList.remove('hidden')"
            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
            + Tambah Petugas
        </button>
    </div>

    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Daftar Petugas</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left">
                <thead>
                    <tr class="bg-gray-100 text-gray-600 text-xs">
                        <th class="py-3 px-4">No</th>
                        <th class="py-3 px-4">Nama Petugas</th>
                        <th class="py-3 px-4">Username</th>
                        <th class="py-3 px-4">Telepon</th>
                        <th class="py-3 px-4">Level</th>
                        <th class="py-3 px-4">Tanggal Dibuat</th>
                        <th class="py-3 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse ($petugas as $i => $p)
                        <tr class="border-t border-gray-200 hover:bg-gray-50">
                            <td class="py-3 px-4">{{ $i + 1 }}</td>
                            <td class="py-3 px-4">{{ $p->nama_petugas }}</td>
                            <td class="py-3 px-4">{{ $p->username }}</td>
                            <td class="py-3 px-4">{{ $p->telp }}</td>
                            <td class="py-3 px-4">
                                <span class="text-white text-xs px-3 py-1 rounded-full 
                                    {{ $p->level == 'admin' ? 'bg-blue-500' : 'bg-green-500' }}">
                                    {{ ucfirst($p->level) }}
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                {{ $p->created_at ? $p->created_at->format('d-m-Y') : '-' }}
                            </td>

                            <td class="py-3 px-4 text-right space-x-2">
                                <button 
                                    class="text-yellow-500 hover:text-yellow-600 transition"
                                    onclick="openEditModal({{ $p->id_petugas }}, '{{ $p->nama_petugas }}', '{{ $p->username }}', '{{ $p->telp }}', '{{ $p->level }}')">
                                    <i class="fas fa-edit text-lg"></i>
                                </button>
                                <form action="{{ route('petugas.destroy', $p->id_petugas) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-600 transition" onclick="return confirm('Yakin ingin menghapus petugas ini?')">
                                        <i class="fas fa-trash text-lg"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-gray-500">Belum ada petugas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div id="modal-tambah"
        class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center px-4">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative">
            <button onclick="document.getElementById('modal-tambah').classList.add('hidden')"
                class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 text-xl font-bold">
                &times;
            </button>

            <h3 class="text-xl font-semibold text-gray-800 mb-4">Tambah Petugas</h3>

            <form action="{{ route('petugas.store') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Petugas</label>
                        <input type="text" name="nama_petugas" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 text-sm focus:outline-none focus:ring focus:border-blue-300">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Username</label>
                        <input type="text" name="username" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 text-sm focus:outline-none focus:ring focus:border-blue-300">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" name="password" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 text-sm focus:outline-none focus:ring focus:border-blue-300">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Telepon</label>
                        <input type="number" name="telp" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 text-sm focus:outline-none focus:ring focus:border-blue-300">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Level</label>
                        <select name="level" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 text-sm focus:outline-none focus:ring focus:border-blue-300">
                            <option value="admin">Admin</option>
                            <option value="petugas">Petugas</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="button"
                        onclick="document.getElementById('modal-tambah').classList.add('hidden')"
                        class="mr-3 px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <div id="modal-edit"
        class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center px-4">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative">
            <!-- Tombol Close -->
            <button onclick="document.getElementById('modal-edit').classList.add('hidden')"
                class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 text-xl font-bold">
                &times;
            </button>

            <h3 class="text-xl font-semibold text-gray-800 mb-4">Edit Petugas</h3>

            <form id="form-edit" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Petugas</label>
                        <input type="text" id="edit-nama" name="nama_petugas" required
                            class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Username</label>
                        <input type="text" id="edit-username" name="username" required
                            class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Password (kosongkan jika tidak diubah)</label>
                        <input type="password" id="edit-password" name="password"
                            class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Telepon</label>
                        <input type="number" id="edit-telp" name="telp" required
                            class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Level</label>
                        <select id="edit-level" name="level" required
                            class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 text-sm">
                            <option value="admin">Admin</option>
                            <option value="petugas">Petugas</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="button"
                        onclick="document.getElementById('modal-edit').classList.add('hidden')"
                        class="mr-3 px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Update</button>
                </div>
            </form>
        </div>
    </div>

@endsection

<script>
    function openEditModal(id, nama, username, telp, level) {
        document.getElementById('modal-edit').classList.remove('hidden');
        document.getElementById('edit-nama').value = nama;
        document.getElementById('edit-username').value = username;
        document.getElementById('edit-telp').value = telp;
        document.getElementById('edit-level').value = level;
        document.getElementById('edit-password').value = '';

        document.getElementById('form-edit').action = '/admin/petugas/' + id;
    }
</script>
