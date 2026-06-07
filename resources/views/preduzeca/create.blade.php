<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eFaktura - Registracija preduzeća</title>
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
                Registracija preduzeća
            </h1>
            <p class="text-blue-300 text-lg leading-relaxed mb-12">
                Unesite podatke o vašem preduzeću. Ovi podaci će biti korišćeni 
                na svim fakturama koje kreirate u sistemu.
            </p>

            <div class="bg-blue-800 rounded-2xl p-6 mb-6">
                <h3 class="font-bold text-yellow-400 mb-4">Šta vam treba?</h3>
                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 bg-yellow-400 rounded-full"></div>
                        <p class="text-blue-200 text-sm">PIB preduzeća (9 cifara)</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 bg-yellow-400 rounded-full"></div>
                        <p class="text-blue-200 text-sm">Matični broj (8 cifara)</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 bg-yellow-400 rounded-full"></div>
                        <p class="text-blue-200 text-sm">Adresa sedišta preduzeća</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 bg-yellow-400 rounded-full"></div>
                        <p class="text-blue-200 text-sm">Email i telefon za kontakt</p>
                    </div>
                </div>
            </div>

            <div class="bg-yellow-400 bg-opacity-10 border border-yellow-400 rounded-xl p-4">
                <p class="text-yellow-300 text-sm">
                    <strong>Napomena:</strong> PIB i matični broj možete pronaći u rešenju 
                    o registraciji preduzeća ili na APR portalu.
                </p>
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

            <!-- Korak indikator -->
            <div class="flex items-center gap-3 mb-8">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center text-sm font-bold">✓</div>
                    <span class="text-sm text-green-600 font-medium">Nalog kreiran</span>
                </div>
                <div class="flex-1 h-0.5 bg-gray-200"></div>
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-blue-900 text-white rounded-full flex items-center justify-center text-sm font-bold">2</div>
                    <span class="text-sm text-blue-900 font-medium">Preduzeće</span>
                </div>
            </div>

            <h2 class="text-3xl font-black text-gray-900 mb-2">Vaše preduzeće</h2>
            <p class="text-gray-500 mb-8">Unesite zvanične podatke o preduzeću</p>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('preduzece.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Naziv preduzeća *</label>
                    <input type="text" name="naziv" value="{{ old('naziv') }}" required
                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-blue-600 focus:outline-none transition @error('naziv') border-red-400 @enderror"
                        placeholder="npr. Moje Preduzeće DOO">
                    @error('naziv') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4 mb-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">PIB *</label>
                        <input type="text" name="pib" value="{{ old('pib') }}" required maxlength="9"
                            class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-blue-600 focus:outline-none transition @error('pib') border-red-400 @enderror"
                            placeholder="9 cifara">
                        @error('pib') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Matični broj *</label>
                        <input type="text" name="maticni_broj" value="{{ old('maticni_broj') }}" required maxlength="8"
                            class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-blue-600 focus:outline-none transition @error('maticni_broj') border-red-400 @enderror"
                            placeholder="8 cifara">
                        @error('maticni_broj') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Adresa sedišta *</label>
                    <input type="text" name="adresa" value="{{ old('adresa') }}" required
                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-blue-600 focus:outline-none transition @error('adresa') border-red-400 @enderror"
                        placeholder="Ulica i broj, Grad">
                    @error('adresa') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Email *</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-blue-600 focus:outline-none transition @error('email') border-red-400 @enderror"
                            placeholder="firma@email.com">
                        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Telefon *</label>
                        <input type="text" name="telefon" value="{{ old('telefon') }}" required
                            class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-blue-600 focus:outline-none transition @error('telefon') border-red-400 @enderror"
                            placeholder="011 123 456">
                        @error('telefon') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    APR dokument / Rešenje o registraciji *
                </label>
                <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-blue-400 transition cursor-pointer"
                    onclick="document.getElementById('apr_dokument').click()">
                    <svg class="w-10 h-10 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                    </svg>
                    <p class="text-gray-500 text-sm mb-1">Kliknite da uploadujete dokument</p>
                    <p class="text-gray-400 text-xs">PDF, JPG, PNG — maksimalno 5MB</p>
                    <p id="naziv-fajla" class="text-blue-600 text-sm font-medium mt-2 hidden"></p>
                </div>
                <input type="file" id="apr_dokument" name="apr_dokument"
                    accept=".pdf,.jpg,.jpeg,.png" class="hidden"
                    onchange="prikaziNaziv(this)">
                @error('apr_dokument')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <!-- Godina osnivanja -->
<div class="mb-5">
    <label class="block text-sm font-semibold text-gray-700 mb-2">Godina osnivanja *</label>
    <input type="number" name="godina_osnivanja" value="{{ old('godina_osnivanja') }}"
        min="1800" max="{{ date('Y') }}" required
        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-blue-600 focus:outline-none transition @error('godina_osnivanja') border-red-400 @enderror"
        placeholder="npr. 2005">
    @error('godina_osnivanja') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
</div>

<!-- Ime vlasnika -->
<div class="mb-5">
    <label class="block text-sm font-semibold text-gray-700 mb-2">Ime vlasnika *</label>
    <input type="text" name="ime_vlasnika" value="{{ old('ime_vlasnika') }}" required
        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-blue-600 focus:outline-none transition @error('ime_vlasnika') border-red-400 @enderror"
        placeholder="Ime i prezime vlasnika">
    @error('ime_vlasnika') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
</div>

<!-- Mesto -->
<div class="mb-5">
    <label class="block text-sm font-semibold text-gray-700 mb-2">Mesto sedišta *</label>
    <input type="text" name="mesto" value="{{ old('mesto') }}" required
        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-blue-600 focus:outline-none transition @error('mesto') border-red-400 @enderror"
        placeholder="npr. Beograd">
    @error('mesto') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
</div>

<div class="grid grid-cols-2 gap-4 mb-5">
    <!-- Vrsta preduzeća -->
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">Vrsta preduzeća *</label>
        <select name="vrsta_preduzeca"
            class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-blue-600 focus:outline-none transition @error('vrsta_preduzeca') border-red-400 @enderror">
            <option value="">-- Izaberi --</option>
            <option value="mikro" {{ old('vrsta_preduzeca') == 'mikro' ? 'selected' : '' }}>Mikro</option>
            <option value="malo" {{ old('vrsta_preduzeca') == 'malo' ? 'selected' : '' }}>Malo</option>
            <option value="srednje" {{ old('vrsta_preduzeca') == 'srednje' ? 'selected' : '' }}>Srednje</option>
            <option value="veliko" {{ old('vrsta_preduzeca') == 'veliko' ? 'selected' : '' }}>Veliko</option>
        </select>
        @error('vrsta_preduzeca') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <!-- Vrsta delatnosti -->
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">Vrsta delatnosti *</label>
        <input type="text" name="vrsta_delatnosti" value="{{ old('vrsta_delatnosti') }}" required
            class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-blue-600 focus:outline-none transition @error('vrsta_delatnosti') border-red-400 @enderror"
            placeholder="npr. Trgovina, IT, Transport">
        @error('vrsta_delatnosti') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
</div>

<!-- Žiro računi -->
<div class="mb-6">
    <div class="flex justify-between items-center mb-3">
        <label class="block text-sm font-semibold text-gray-700">Žiro računi (max 3) *</label>
        <button type="button" onclick="dodajZiroRacun()"
            class="bg-blue-700 text-white px-3 py-1 rounded text-sm hover:bg-blue-600">
            + Dodaj žiro račun
        </button>
    </div>
    <div id="ziro-racuni-container">
        <div class="ziro-racun flex gap-2 mb-2">
            <input type="text" name="ziro_racuni[]"
                placeholder="npr. 205-242296-21"
                pattern="\d{3}-\d{6,}-\d{2}"
                class="flex-1 border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-blue-600 focus:outline-none transition"
                required>
        </div>
    </div>
</div>

<script>
let brojZiroRacuna = 1;
function dodajZiroRacun() {
    if (brojZiroRacuna >= 3) {
        alert('Maksimalno 3 žiro računa!');
        return;
    }
    brojZiroRacuna++;
    const container = document.getElementById('ziro-racuni-container');
    const div = document.createElement('div');
    div.className = 'ziro-racun flex gap-2 mb-2';
    div.innerHTML = `
        <input type="text" name="ziro_racuni[]"
            placeholder="npr. 205-242296-21"
            class="flex-1 border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-blue-600 focus:outline-none transition">
        <button type="button" onclick="this.parentElement.remove(); brojZiroRacuna--;"
            class="bg-red-500 text-white px-3 rounded-xl hover:bg-red-400">✕</button>
    `;
    container.appendChild(div);
}
</script>
                <button type="submit"
                    class="w-full bg-blue-900 text-white py-3 rounded-xl font-bold text-lg hover:bg-blue-800 transition">
                    Sačuvaj i nastavi
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ url('/') }}" class="text-gray-400 text-sm hover:text-gray-600 transition">
                    ← Nazad na početnu stranicu
                </a>
            </div>

        </div>
    </div>

</div>
        <script>
        function prikaziNaziv(input) {
            const naziv = document.getElementById('naziv-fajla');
            if (input.files && input.files[0]) {
                naziv.textContent = '✓ ' + input.files[0].name;
                naziv.classList.remove('hidden');
            }
        }
        </script>
</body>
</html>