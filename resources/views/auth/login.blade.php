<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eFaktura - Prijava</title>
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
                Dobrodošli u sistem za elektronske fakture
            </h1>
            <p class="text-blue-300 text-lg leading-relaxed mb-12">
                Digitalno upravljajte fakturama u skladu sa zakonodavstvom 
                Republike Srbije i SEF sistemom Poreske uprave.
            </p>

            <!-- Stats -->
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-blue-800 rounded-xl p-4">
                    <div class="text-yellow-400 font-black text-2xl">PDV</div>
                    <div class="text-blue-300 text-sm">Automatski obračun</div>
                </div>
                <div class="bg-blue-800 rounded-xl p-4">
                    <div class="text-yellow-400 font-black text-2xl">PDF</div>
                    <div class="text-blue-300 text-sm">Export faktura</div>
                </div>
                <div class="bg-blue-800 rounded-xl p-4">
                    <div class="text-yellow-400 font-black text-2xl">3</div>
                    <div class="text-blue-300 text-sm">Valute (RSD, EUR, USD)</div>
                </div>
                <div class="bg-blue-800 rounded-xl p-4">
                    <div class="text-yellow-400 font-black text-2xl">SEF</div>
                    <div class="text-blue-300 text-sm">Inspirisano portalom</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Desna strana - forma -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
        <div class="w-full max-w-md">

            <!-- Mobile logo -->
            <div class="flex items-center gap-3 mb-10 lg:hidden">
                <div class="bg-blue-900 text-yellow-400 font-black text-xl px-3 py-1 rounded">eF</div>
                <div>
                    <div class="text-xl font-bold text-gray-900">eFaktura</div>
                    <div class="text-xs text-gray-400">Sistem za elektronske fakture</div>
                </div>
            </div>

            <h2 class="text-3xl font-black text-gray-900 mb-2">Prijava</h2>
            <p class="text-gray-500 mb-8">Unesite vaše kredencijale za pristup sistemu</p>

            <!-- Session Status -->
            @if (session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6">
                    {{ session('status') }}
                </div>
            @endif

            @if (session('status_poruka') == 'na_cekanju')
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-800 px-4 py-4 rounded-xl mb-6">
                    <p class="font-bold mb-1">⏳ Nalog čeka odobrenje</p>
                    <p class="text-sm">Vaš nalog je uspešno kreiran ali čeka odobrenje administratora. 
                    Bićete obavešteni kada administrator odobri vaš pristup.</p>
                </div>
            @endif

            @if (session('status_poruka') == 'odbijen')
            @if (session('status_poruka') == 'deaktiviran')
                <div class="bg-orange-100 border border-orange-400 text-orange-800 px-4 py-4 rounded-xl mb-6">
                    <p class="font-bold mb-1">⚠️ Nalog deaktiviran</p>
                    <p class="text-sm">Vaš nalog je privremeno deaktiviran od strane administratora. 
                    Proverite email za više informacija ili kontaktirajte administratora.</p>
                </div>
            @endif
                <div class="bg-red-100 border border-red-400 text-red-800 px-4 py-4 rounded-xl mb-6">
                    <p class="font-bold mb-1">❌ Nalog odbijen</p>
                    <p class="text-sm">Vaš zahtev za pristup sistemu je odbijen od strane administratora. 
                    Za više informacija kontaktirajte administratora sistema.</p>
                </div>
            @endif
            @if (session('status_poruka') == 'nije_verifikovan')
                <div class="bg-blue-100 border border-blue-400 text-blue-800 px-4 py-4 rounded-xl mb-6">
                    <p class="font-bold mb-1">📧 Email nije verifikovan</p>
                    <p class="text-sm">Vaš nalog je odobren ali email adresa nije verifikovana. 
                    Proverite email i kliknite na verifikacioni link koji smo vam poslali.</p>
                </div>
            @endif
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email adresa</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-blue-600 focus:outline-none transition @error('email') border-red-400 @enderror"
                        placeholder="vas@email.com">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <div class="flex justify-between items-center mb-2">
                        <label class="text-sm font-semibold text-gray-700">Lozinka</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs text-blue-600 hover:underline">
                                Zaboravili ste lozinku?
                            </a>
                        @endif
                    </div>
                    <input type="password" name="password" required
                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-blue-600 focus:outline-none transition @error('password') border-red-400 @enderror"
                        placeholder="••••••••">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit"
                    class="w-full bg-blue-900 text-white py-3 rounded-xl font-bold text-lg hover:bg-blue-800 transition">
                    Prijavite se
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-gray-500 text-sm">
                    Nemate nalog?
                    <a href="{{ route('register') }}" class="text-blue-600 font-bold hover:underline">
                        Registrujte se
                    </a>
                </p>
            </div>

            <div class="mt-4 text-center">
                <a href="{{ url('/') }}" class="text-gray-400 text-sm hover:text-gray-600 transition">
            </div>

        </div>
    </div>

</div>

</body>
</html>