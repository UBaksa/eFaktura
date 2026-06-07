<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eFaktura - Zaboravljena lozinka</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">

<div class="min-h-screen flex">

    <!-- Leva strana -->
    <div class="hidden lg:flex lg:w-1/2 bg-blue-900 text-white flex-col justify-between p-12">
        <div>
            <div class="flex items-center gap-3 mb-16">
                <div class="bg-yellow-400 text-blue-900 font-black text-xl px-3 py-1 rounded">eF</div>
                <div>
                    <div class="text-xl font-bold">eFaktura</div>
                    <div class="text-xs text-blue-300">Sistem za elektronske fakture</div>
                </div>
            </div>
            <h1 class="text-4xl font-black mb-6 leading-tight">
                Zaboravili ste lozinku?
            </h1>
            <p class="text-blue-300 text-lg leading-relaxed mb-12">
                Unesite vašu email adresu i poslaćemo vam link za resetovanje lozinke.
            </p>
            <div class="bg-blue-800 rounded-xl p-6">
                <h3 class="font-bold text-yellow-400 mb-4">Koraci:</h3>
                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="bg-yellow-400 text-blue-900 font-black w-7 h-7 rounded-full flex items-center justify-center flex-shrink-0 text-sm">1</div>
                        <p class="text-blue-200 text-sm">Unesite email adresu naloga</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="bg-yellow-400 text-blue-900 font-black w-7 h-7 rounded-full flex items-center justify-center flex-shrink-0 text-sm">2</div>
                        <p class="text-blue-200 text-sm">Proverite email inbox</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="bg-yellow-400 text-blue-900 font-black w-7 h-7 rounded-full flex items-center justify-center flex-shrink-0 text-sm">3</div>
                        <p class="text-blue-200 text-sm">Kliknite na link u emailu</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="bg-yellow-400 text-blue-900 font-black w-7 h-7 rounded-full flex items-center justify-center flex-shrink-0 text-sm">4</div>
                        <p class="text-blue-200 text-sm">Unesite novu lozinku</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-blue-400 text-xs">
            Državni univerzitet u Novom Pazaru · Informacioni sistemi · 2026.
        </div>
    </div>

    <!-- Desna strana -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
        <div class="w-full max-w-md">

            <div class="flex items-center gap-3 mb-10 lg:hidden">
                <div class="bg-blue-900 text-yellow-400 font-black text-xl px-3 py-1 rounded">eF</div>
                <div>
                    <div class="text-xl font-bold text-gray-900">eFaktura</div>
                    <div class="text-xs text-gray-400">Sistem za elektronske fakture</div>
                </div>
            </div>

            <h2 class="text-3xl font-black text-gray-900 mb-2">Resetuj lozinku</h2>
            <p class="text-gray-500 mb-8">Unesite email adresu i poslaćemo vam link za resetovanje.</p>

            @if (session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email adresa</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-blue-600 focus:outline-none transition @error('email') border-red-400 @enderror"
                        placeholder="vas@email.com">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full bg-blue-900 text-white py-3 rounded-xl font-bold text-lg hover:bg-blue-800 transition">
                    Pošalji link za resetovanje
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ route('login') }}" class="text-gray-400 text-sm hover:text-gray-600 transition">
                    ← Nazad na prijavu
                </a>
            </div>

        </div>
    </div>

</div>

</body>
</html>