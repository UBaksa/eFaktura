<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eFaktura - Nova lozinka</title>
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
                Unesite novu lozinku
            </h1>
            <p class="text-blue-300 text-lg leading-relaxed">
                Odaberite sigurnu lozinku za vaš eFaktura nalog.
            </p>
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

            <h2 class="text-3xl font-black text-gray-900 mb-2">Nova lozinka</h2>
            <p class="text-gray-500 mb-8">Unesite novu lozinku za vaš nalog.</p>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email adresa</label>
                    <input type="email" name="email" value="{{ old('email', $request->email) }}" required
                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-blue-600 focus:outline-none transition @error('email') border-red-400 @enderror">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nova lozinka</label>
                    <input type="password" name="password" required
                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-blue-600 focus:outline-none transition @error('password') border-red-400 @enderror"
                        placeholder="Minimum 8 karaktera">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Potvrdi novu lozinku</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-blue-600 focus:outline-none transition"
                        placeholder="Ponovite lozinku">
                </div>

                <button type="submit"
                    class="w-full bg-blue-900 text-white py-3 rounded-xl font-bold text-lg hover:bg-blue-800 transition">
                    Sačuvaj novu lozinku
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