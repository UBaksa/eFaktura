<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eFaktura - Stranica nije pronađena</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="text-center px-6">
        <div class="text-9xl font-black text-blue-900 mb-4">404</div>
        <div class="w-24 h-1 bg-yellow-400 mx-auto mb-6"></div>
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Stranica nije pronađena</h1>
        <p class="text-gray-500 mb-8 max-w-md mx-auto">
            Stranica koju tražite ne postoji ili je premještena. 
            Provjerite URL ili se vratite na početnu stranicu.
        </p>
        <div class="flex gap-4 justify-center">
            <a href="{{ url('/') }}"
                class="bg-blue-900 text-white px-8 py-3 rounded-xl font-bold hover:bg-blue-800 transition">
                Početna stranica
            </a>
            @auth
            <a href="{{ route('dashboard') }}"
                class="border-2 border-blue-900 text-blue-900 px-8 py-3 rounded-xl font-bold hover:bg-blue-50 transition">
                Dashboard
            </a>
            @endauth
        </div>
    </div>
</body>
</html>