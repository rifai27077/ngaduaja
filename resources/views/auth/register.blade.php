@extends('layouts.app')

@section('content')
@include('includes.navbar')

<section class="pt-28 md:pt-32 pb-20 bg-white text-center relative overflow-hidden">
    <div class="relative z-10 max-w-md mx-auto px-4">
        <!-- Card Register -->
        <div class="bg-white shadow-md rounded-md p-6 text-left">
            <h2 class="text-lg font-bold text-gray-800 mb-4">
                Buat <span class="text-green-600">Akun</span>
            </h2>

            <!-- Form -->
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- NIK -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">NIK</label>
                    <input type="text" name="nik" value="{{ old('nik') }}" 
                        class="mt-1 w-full px-3 py-2 border @error('nik') border-red-500 @else border-gray-300 @enderror rounded-md text-sm focus:ring-green-500 focus:border-green-500" required>
                    @error('nik')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nama -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" name="nama" value="{{ old('nama') }}"
                        class="mt-1 w-full px-3 py-2 border @error('nama') border-red-500 @else border-gray-300 @enderror rounded-md text-sm focus:ring-green-500 focus:border-green-500" required>
                    @error('nama')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Username -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" name="username" value="{{ old('username') }}"
                        class="mt-1 w-full px-3 py-2 border @error('username') border-red-500 @else border-gray-300 @enderror rounded-md text-sm focus:ring-green-500 focus:border-green-500" required>
                    @error('username')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password"
                        class="mt-1 w-full px-3 py-2 border @error('password') border-red-500 @else border-gray-300 @enderror rounded-md text-sm focus:ring-green-500 focus:border-green-500" required>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Telepon -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Telepon</label>
                    <input type="text" name="telp" value="{{ old('telp') }}"
                        class="mt-1 w-full px-3 py-2 border @error('telp') border-red-500 @else border-gray-300 @enderror rounded-md text-sm focus:ring-green-500 focus:border-green-500" required>
                    @error('telp')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tombol Daftar -->
                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded-md font-medium transition">
                    Daftar
                </button>
            </form>

            <!-- Link Login -->
            <p class="mt-4 text-center text-sm text-gray-600">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="text-green-600 hover:underline font-medium">Login</a>
            </p>
        </div>
    </div>
</section>
@endsection
