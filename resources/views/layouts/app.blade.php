<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'NgaduAja') }}</title>

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
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>

    <style>
        html {
            scroll-behavior: smooth;
        }
        nav#navbar {
            z-index: 1000;
        }
        .nav-link {
            position: relative;
            transition: color 0.3s ease;
        }
        .nav-link::after {
            content: "";
            position: absolute;
            bottom: -4px;
            left: 50%;
            transform: translateX(-50%) scaleX(0);
            transform-origin: center;
            width: 50%;
            height: 2px;
            background-color: #15803d; /* Hijau */
            transition: transform 0.3s ease;
        }
        .nav-link.active {
            color: #15803d !important;
            font-weight: 500;
        }
        .nav-link.active::after {
            transform: translateX(-50%) scaleX(1);
        }

        #menu-toggle {
        padding: 10px;
        z-index: 1001;
        }
    </style>
</head> 

<body class="bg-[#FDFDFC] text-[#1b1b18] antialiased">
    @include('includes.navbar')
    <main class="pt-16">
        @yield('content')
    </main>

    @include('includes.footer')
</body>
</html>
