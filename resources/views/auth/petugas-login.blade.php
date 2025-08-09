
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Petugas | Login</title>

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
        .tooltip-delay {
        transition: opacity 0.2s ease-in-out 0.2s;
    }
    .tooltip-delay-hidden {
        opacity: 0;
        transition: opacity 0.2s ease-in-out 0s;/
    }
</style>
    </style>
</head> 
<body class="bg-gray-100 font-sans text-gray-800">
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="bg-white shadow-md rounded-lg w-full max-w-sm p-6">
            <h2 class="text-2xl font-bold text-center mb-6">Login Petugas</h2>

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('petugas.login') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm mb-2">Username</label>
                    <input type="text" name="username" class="w-full border px-3 py-2 rounded focus:outline-blue-500">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm mb-2">Password</label>
                    <input type="password" name="password" class="w-full border px-3 py-2 rounded focus:outline-blue-500">
                </div>
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded">Login</button>
            </form>
        </div>
    </div>
</body>
</html>

