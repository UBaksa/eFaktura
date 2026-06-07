@extends('layouts.app')
@section('title', 'Izmena preduzeća')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Izmena preduzeća</h1>
        <a href="{{ route('admin.preduzeca') }}"
            class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
            Nazad
        </a>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="{{ route('admin.preduzeca.update', $preduzece) }}">
            @csrf @method('PATCH')

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Naziv *</label>
                <input type="text" name="naziv" value="{{ old('naziv', $preduzece->naziv) }}"
                    class="w-full border rounded px-3 py-2 @error('naziv') border-red-500 @enderror">
                @error('naziv') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">PIB</label>
                    <input type="text" value="{{ $preduzece->pib }}"
                        class="w-full border rounded px-3 py-2 bg-gray-100" disabled>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Matični broj</label>
                    <input type="text" value="{{ $preduzece->maticni_broj }}"
                        class="w-full border rounded px-3 py-2 bg-gray-100" disabled>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Adresa *</label>
                <input type="text" name="adresa" value="{{ old('adresa', $preduzece->adresa) }}"
                    class="w-full border rounded px-3 py-2 @error('adresa') border-red-500 @enderror">
                @error('adresa') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Mesto</label>
                <input type="text" name="mesto" value="{{ old('mesto', $preduzece->mesto) }}"
                    class="w-full border rounded px-3 py-2">
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                    <input type="email" name="email" value="{{ old('email', $preduzece->email) }}"
                        class="w-full border rounded px-3 py-2 @error('email') border-red-500 @enderror">
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Telefon *</label>
                    <input type="text" name="telefon" value="{{ old('telefon', $preduzece->telefon) }}"
                        class="w-full border rounded px-3 py-2 @error('telefon') border-red-500 @enderror">
                    @error('telefon') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Ime vlasnika</label>
                <input type="text" name="ime_vlasnika" value="{{ old('ime_vlasnika', $preduzece->ime_vlasnika) }}"
                    class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Godina osnivanja</label>
                <input type="number" name="godina_osnivanja" value="{{ old('godina_osnivanja', $preduzece->godina_osnivanja) }}"
                    min="1800" max="{{ date('Y') }}" class="w-full border rounded px-3 py-2">
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Vrsta preduzeća</label>
                    <select name="vrsta_preduzeca" class="w-full border rounded px-3 py-2">
                        <option value="">-- Izaberi --</option>
                        <option value="mikro" {{ old('vrsta_preduzeca', $preduzece->vrsta_preduzeca) == 'mikro' ? 'selected' : '' }}>Mikro</option>
                        <option value="malo" {{ old('vrsta_preduzeca', $preduzece->vrsta_preduzeca) == 'malo' ? 'selected' : '' }}>Malo</option>
                        <option value="srednje" {{ old('vrsta_preduzeca', $preduzece->vrsta_preduzeca) == 'srednje' ? 'selected' : '' }}>Srednje</option>
                        <option value="veliko" {{ old('vrsta_preduzeca', $preduzece->vrsta_preduzeca) == 'veliko' ? 'selected' : '' }}>Veliko</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Vrsta delatnosti</label>
                    <input type="text" name="vrsta_delatnosti" value="{{ old('vrsta_delatnosti', $preduzece->vrsta_delatnosti) }}"
                        class="w-full border rounded px-3 py-2">
                </div>
            </div>

            <!-- Žiro računi -->
            <div class="mb-6">
                <div class="flex justify-between items-center mb-3">
                    <label class="block text-sm font-medium text-gray-700">Žiro računi (max 3)</label>
                    <button type="button" onclick="dodajZiroRacun()"
                        class="bg-blue-700 text-white px-3 py-1 rounded text-sm hover:bg-blue-600">
                        + Dodaj žiro račun
                    </button>
                </div>
                <div id="ziro-racuni-container">
                    @foreach($preduzece->ziroRacuni as $racun)
                    <div class="ziro-racun flex gap-2 mb-2">
                        <input type="text" name="ziro_racuni[]" value="{{ $racun->broj_racuna }}"
                            class="flex-1 border rounded px-3 py-2">
                        <button type="button" onclick="this.parentElement.remove(); brojZiroRacuna--;"
                            class="bg-red-500 text-white px-3 rounded hover:bg-red-400">✕</button>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="flex gap-4">
                <button type="submit"
                    class="bg-blue-700 text-white px-6 py-2 rounded hover:bg-blue-600">
                    Sačuvaj izmene
                </button>
                <a href="{{ route('admin.preduzeca') }}"
                    class="bg-gray-400 text-white px-6 py-2 rounded hover:bg-gray-500">
                    Otkaži
                </a>
            </div>
        </form>
    </div>
</div>

<script>
let brojZiroRacuna = {{ $preduzece->ziroRacuni->count() }};
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
            class="flex-1 border rounded px-3 py-2">
        <button type="button" onclick="this.parentElement.remove(); brojZiroRacuna--;"
            class="bg-red-500 text-white px-3 rounded hover:bg-red-400">✕</button>
    `;
    container.appendChild(div);
}
</script>
@endsection