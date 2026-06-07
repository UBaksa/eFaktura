@extends('layouts.app')
@section('title', 'Nova faktura')

@section('content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">Nova faktura</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="{{ route('fakture.store') }}" id="forma-fakture" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Komitent *</label>
                    <select name="komitent_id" class="w-full border rounded px-3 py-2 @error('komitent_id') border-red-500 @enderror">
                        <option value="">-- Izaberi komitenta --</option>
                        @foreach($komitenti as $komitent)
                            <option value="{{ $komitent->id }}" {{ old('komitent_id') == $komitent->id ? 'selected' : '' }}>
                                {{ $komitent->naziv }}
                            </option>
                        @endforeach
                    </select>
                    @error('komitent_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Valuta *</label>
                    <select name="valuta" class="w-full border rounded px-3 py-2">
                        <option value="RSD" {{ old('valuta') == 'RSD' ? 'selected' : '' }}>RSD</option>
                        <option value="EUR" {{ old('valuta') == 'EUR' ? 'selected' : '' }}>EUR</option>
                        <option value="USD" {{ old('valuta') == 'USD' ? 'selected' : '' }}>USD</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Datum izdavanja *</label>
                    <input type="date" name="datum_izdavanja" value="{{ old('datum_izdavanja', date('Y-m-d')) }}"
                        class="w-full border rounded px-3 py-2 @error('datum_izdavanja') border-red-500 @enderror">
                    @error('datum_izdavanja') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Datum valute *</label>
                    <input type="date" name="datum_valute" value="{{ old('datum_valute') }}"
                        class="w-full border rounded px-3 py-2 @error('datum_valute') border-red-500 @enderror">
                    @error('datum_valute') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Napomena</label>
                <textarea name="napomena" rows="2"
                    class="w-full border rounded px-3 py-2">{{ old('napomena') }}</textarea>
            </div>

            <!-- Stavke -->
            <div class="mb-6">
                <div class="flex justify-between items-center mb-3">
                    <h2 class="text-lg font-semibold">Stavke fakture</h2>
                    <button type="button" id="dodaj-stavku-btn"
                        class="bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-500">
                        + Dodaj stavku
                    </button>
                </div>

                <div id="stavke-container">
                    <div class="stavka grid grid-cols-6 gap-2 mb-2 items-end">
                        <div class="col-span-2">
                            <label class="block text-xs text-gray-500 mb-1">Naziv</label>
                            <input type="text" name="stavke[0][naziv]"
                                class="w-full border rounded px-2 py-1 text-sm" required>
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Količina</label>
                            <input type="number" name="stavke[0][kolicina]" step="0.001" min="0.001"
                                class="w-full border rounded px-2 py-1 text-sm" required>
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Jed. mere</label>
                            <input type="text" name="stavke[0][jedinica_mere]" placeholder="kom"
                                class="w-full border rounded px-2 py-1 text-sm" required>
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Cena bez PDV</label>
                            <input type="number" name="stavke[0][cena_bez_pdv]" step="0.01" min="0"
                                class="w-full border rounded px-2 py-1 text-sm" required>
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">PDV %</label>
                            <select name="stavke[0][pdv_stopa]" class="w-full border rounded px-2 py-1 text-sm">
                                <option value="0">0%</option>
                                <option value="10">10%</option>
                                <option value="20" selected>20%</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Prateći dokument -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Prateći dokument <span class="text-gray-400 text-xs">(opciono — otpremnica, ugovor, itd.)</span>
                </label>
                <div id="dokument-zona" class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-blue-400 transition cursor-pointer">
                    <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                    </svg>
                    <p class="text-gray-500 text-sm mb-1">Kliknite da uploadujete dokument</p>
                    <p class="text-gray-400 text-xs">PDF, JPG, PNG — maksimalno 5MB</p>
                    <p id="naziv-dokumenta" class="text-blue-600 text-sm font-medium mt-2 hidden"></p>
                </div>
                <input type="file" id="dokument" name="dokument"
                    accept=".pdf,.jpg,.jpeg,.png" class="hidden">
            </div>

            <div class="flex gap-4">
                <button type="submit"
                    class="bg-blue-700 text-white px-6 py-2 rounded hover:bg-blue-600">
                    Kreiraj fakturu
                </button>
                <a href="{{ route('fakture.index') }}"
                    class="bg-gray-400 text-white px-6 py-2 rounded hover:bg-gray-500">
                    Otkaži
                </a>
            </div>
        </form>
    </div>
</div>

<script>
let brojStavki = 1;

document.addEventListener('DOMContentLoaded', function() {
    // Dodaj stavku
    document.getElementById('dodaj-stavku-btn').addEventListener('click', function() {
        const container = document.getElementById('stavke-container');
        const i = brojStavki++;
        const div = document.createElement('div');
        div.className = 'stavka grid grid-cols-6 gap-2 mb-2 items-end';
        div.innerHTML = `
            <div class="col-span-2">
                <input type="text" name="stavke[${i}][naziv]"
                    placeholder="Naziv" class="w-full border rounded px-2 py-1 text-sm" required>
            </div>
            <div>
                <input type="number" name="stavke[${i}][kolicina]" step="0.001" min="0.001"
                    placeholder="Kol." class="w-full border rounded px-2 py-1 text-sm" required>
            </div>
            <div>
                <input type="text" name="stavke[${i}][jedinica_mere]"
                    placeholder="kom" class="w-full border rounded px-2 py-1 text-sm" required>
            </div>
            <div>
                <input type="number" name="stavke[${i}][cena_bez_pdv]" step="0.01" min="0"
                    placeholder="Cena" class="w-full border rounded px-2 py-1 text-sm" required>
            </div>
            <div class="flex gap-1">
                <select name="stavke[${i}][pdv_stopa]" class="w-full border rounded px-2 py-1 text-sm">
                    <option value="0">0%</option>
                    <option value="10">10%</option>
                    <option value="20" selected>20%</option>
                </select>
                <button type="button" class="obrisi-stavku bg-red-500 text-white px-2 rounded text-sm hover:bg-red-400">✕</button>
            </div>
        `;
        container.appendChild(div);

        div.querySelector('.obrisi-stavku').addEventListener('click', function() {
            div.remove();
        });
    });

    // Upload dokument
    document.getElementById('dokument-zona').addEventListener('click', function() {
        document.getElementById('dokument').click();
    });

    document.getElementById('dokument').addEventListener('change', function() {
        const naziv = document.getElementById('naziv-dokumenta');
        if (this.files && this.files[0]) {
            naziv.textContent = '✓ ' + this.files[0].name;
            naziv.classList.remove('hidden');
        }
    });
});
</script>
@endsection