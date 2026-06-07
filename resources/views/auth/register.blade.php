<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eFaktura - Registracija</title>
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
                Kreirajte nalog i počnite sa digitalnim fakturisanjem
            </h1>
            <p class="text-blue-300 text-lg leading-relaxed mb-12">
                Registracija je besplatna. Nakon kreiranja naloga, 
                unesite podatke o vašem preduzeću i počnite odmah.
            </p>

            <div class="space-y-4">
                <div class="flex items-center gap-4">
                    <div class="bg-yellow-400 text-blue-900 font-black w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0">1</div>
                    <p class="text-blue-200">Kreirajte korisnički nalog</p>
                </div>
                <div class="flex items-center gap-4">
                    <div class="bg-yellow-400 text-blue-900 font-black w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0">2</div>
                    <p class="text-blue-200">Unesite podatke o preduzeću</p>
                </div>
                <div class="flex items-center gap-4">
                    <div class="bg-yellow-400 text-blue-900 font-black w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0">3</div>
                    <p class="text-blue-200">Dodajte komitente i kreirajte fakture</p>
                </div>
                <div class="flex items-center gap-4">
                    <div class="bg-yellow-400 text-blue-900 font-black w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0">4</div>
                    <p class="text-blue-200">Pratite saldo listu i dugovanja</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Desna strana - forma -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
        <div class="w-full max-w-md">

            <!-- Mobile logo -->
            <div class="flex items-center gap-3 mb-8 lg:hidden">
                <div class="bg-blue-900 text-yellow-400 font-black text-xl px-3 py-1 rounded">eF</div>
                <div>
                    <div class="text-xl font-bold text-gray-900">eFaktura</div>
                    <div class="text-xs text-gray-400">Sistem za elektronske fakture</div>
                </div>
            </div>

            <h2 class="text-3xl font-black text-gray-900 mb-2">Registracija</h2>
            <p class="text-gray-500 mb-8">Kreirajte nalog za pristup sistemu</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="grid grid-cols-2 gap-4 mb-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Ime</label>
                        <input type="text" name="ime" value="{{ old('ime') }}" required autofocus
                            class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-blue-600 focus:outline-none transition @error('ime') border-red-400 @enderror"
                            placeholder="Vaše ime">
                        @error('ime') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Prezime</label>
                        <input type="text" name="prezime" value="{{ old('prezime') }}" required
                            class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-blue-600 focus:outline-none transition @error('prezime') border-red-400 @enderror"
                            placeholder="Vaše prezime">
                        @error('prezime') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email adresa</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-blue-600 focus:outline-none transition @error('email') border-red-400 @enderror"
                        placeholder="vas@email.com">
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Uloga</label>
                    <select name="uloga"
                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-blue-600 focus:outline-none transition @error('uloga') border-red-400 @enderror">
                        <option value="racunovodja" {{ old('uloga') == 'racunovodja' ? 'selected' : '' }}>Računovođa</option>
                        <option value="direktor" {{ old('uloga') == 'direktor' ? 'selected' : '' }}>Direktor</option>
                    </select>
                    @error('uloga') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Lozinka</label>
                    <input type="password" name="password" required
                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-blue-600 focus:outline-none transition @error('password') border-red-400 @enderror"
                        placeholder="Minimum 8 karaktera">
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Potvrdi lozinku</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-blue-600 focus:outline-none transition"
                        placeholder="Ponovite lozinku">
                </div>

                <button type="submit"
                    class="w-full bg-blue-900 text-white py-3 rounded-xl font-bold text-lg hover:bg-blue-800 transition">
                    Kreiraj nalog
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-gray-500 text-sm">
                    Već imate nalog?
                    <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:underline">
                        Prijavite se
                    </a>
                </p>
            </div>

            <div class="mt-4 text-center">
                <a href="{{ url('/') }}" class="text-gray-400 text-sm hover:text-gray-600 transition">
                    ← Nazad na početnu stranicu
                </a>
            </div>

        </div>
    </div>

</div>

</body>
</html>