<!-- filepath: d:\xampp\htdocs\pengaduan_masyarakat\resources\views\petugas\includes\layout.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Petugas | @yield('title')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@4.1.11/index.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/tailwindcss@4.1.11/dist/lib.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    @endif
    
    <script src="https://kit.fontawesome.com/d0f5c539f4.js" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
    <style>
        .tooltip-delay {
            transition: opacity 0.2s ease-in-out 0.2s;
        }
        .tooltip-delay-hidden {
            opacity: 0;
            transition: opacity 0.2s ease-in-out 0s;
        }
    </style>
</head> 
<body class="bg-gray-100 font-sans text-gray-800" x-data="{ sidebarOpen: false }">
    <div class="flex min-h-screen">
        @include('petugas.includes.sidebar')
        <div 
            :class="sidebarOpen ? 'ml-64' : 'ml-20'"
            class="flex-1 flex flex-col min-h-screen transition-all duration-300 bg-gray-50">
            @include('petugas.includes.header')
            <main class="flex-1 p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>