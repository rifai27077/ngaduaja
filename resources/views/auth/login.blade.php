@extends('layouts.app')

@section('content')

@include('includes.navbar')

<section class="pt-28 md:pt-32 pb-20 bg-white text-center relative overflow-hidden">
    <div class="relative z-10 max-w-md mx-auto px-4">
        <!-- Card Login -->
        <div class="bg-white shadow-md rounded-md p-6 text-left">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Masuk</h2>

            <!-- Form Login -->
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- NIK -->
                <div>
                    <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                    <input id="nik" type="text" name="nik" value="{{ old('nik') }}"
                        class="mt-1 w-full px-3 py-2 border @error('nik') border-red-500 @else border-gray-300 @enderror rounded-md text-sm focus:ring-green-500 focus:border-green-500 outline-none" 
                        placeholder="Masukkan NIK" required autofocus>
                    @error('nik')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" type="password" name="password"
                        class="mt-1 w-full px-3 py-2 border @error('password') border-red-500 @else border-gray-300 @enderror rounded-md text-sm focus:ring-green-500 focus:border-green-500 outline-none" 
                        placeholder="Masukkan Password" required>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tombol Masuk -->
                <button type="submit" 
                    class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded-md font-medium transition">
                    Masuk
                </button>
            </form>

            <!-- Link Daftar -->
            <p class="mt-4 text-center text-sm text-gray-600">
                Belum memiliki akun? 
                <a href="{{ route('register') }}" class="text-green-600 hover:underline font-medium">Daftar</a>
            </p>
        </div>
    </div>
</section>

@endsection
