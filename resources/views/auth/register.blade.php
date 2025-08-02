<!-- resources/views/auth/register.blade.php -->

@extends('layouts.app')

@section('content')
<section class="min-h-screen flex flex-col justify-center items-center bg-white px-4 pt-32">
    <div class="bg-white w-full max-w-md p-8 shadow-md rounded-md">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Buat <span class="text-green-600">Akun</span></h2>

        <form action="{{ route('register.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <input type="text" name="nik" placeholder="NIK" required
                       class="w-full border-b border-gray-300 focus:outline-none focus:border-green-600 py-2 placeholder:text-gray-500">
            </div>

            <div>
                <input type="text" name="nama" placeholder="Nama" required
                       class="w-full border-b border-gray-300 focus:outline-none focus:border-green-600 py-2 placeholder:text-gray-500">
            </div>

            <div>
                <input type="text" name="username" placeholder="Username" required
                       class="w-full border-b border-gray-300 focus:outline-none focus:border-green-600 py-2 placeholder:text-gray-500">
            </div>

            <div>
                <input type="password" name="password" placeholder="Password" required
                       class="w-full border-b border-gray-300 focus:outline-none focus:border-green-600 py-2 placeholder:text-gray-500">
            </div>

            <div>
                <input type="text" name="telp" placeholder="Telepon" required
                       class="w-full border-b border-gray-300 focus:outline-none focus:border-green-600 py-2 placeholder:text-gray-500">
            </div>

            <button type="submit"
                    class="w-full bg-green-600 text-white py-2 rounded-md hover:bg-green-700 transition">
                Daftar
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-4">
            Sudah punya akun? 
            <a href="{{ route('login') }}" class="text-green-600 font-medium hover:underline">Login</a>
        </p>
    </div>
</section>
@endsection
