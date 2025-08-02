<!-- resources/views/auth/login.blade.php -->
@extends('layouts.app')

@section('content')

@include('includes.navbar')

<section class="min-h-screen pt-28 bg-white flex items-center justify-center px-4">
    <div class="bg-white shadow-md rounded-md w-full max-w-md p-8">
        <h2 class="text-xl font-bold text-gray-800 mb-6 text-center">Masuk</h2>

        <form action="{{ route('login') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="nik" class="block text-sm text-gray-700 mb-1">NIK</label>
                <input type="text" id="nik" name="nik" required
                    class="w-full border-b border-gray-300 focus:outline-none focus:border-green-600 px-1 py-2">
            </div>

            <div>
                <label for="password" class="block text-sm text-gray-700 mb-1">Password</label>
                <input type="password" id="password" name="password" required
                    class="w-full border-b border-gray-300 focus:outline-none focus:border-green-600 px-1 py-2">
            </div>

            <div class="text-right text-sm">
                <a href="#" class="text-gray-500 hover:text-green-600 transition">Lupa password?</a>
            </div>

            <button type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded-md transition-all duration-300">
                Masuk
            </button>

            <p class="text-center text-sm text-gray-600">
                Belum memiliki akun?
                <a href="{{ route('register') }}" class="text-green-600 hover:underline">Daftar</a>
            </p>
        </form>
    </div>
</section>

@include('includes.footer')

@endsection
