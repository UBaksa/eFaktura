@extends('layouts.app')
@section('title', 'Novi komitent')

@section('content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">Dodaj komitenta</h1>

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- Pretraga preduzeća -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h2 class="text-lg font-semibold mb-4">Pretražite preduzeće</h2>
        <form method="GET" action="{{ route('komitenti.create') }}" class="flex gap-4">
            <input type="text" name="pretraga" value="{{ $pretraga ?? '' }}"
                placeholder="Unesite naziv, PIB ili MB preduzeća..."
                class="flex-1 border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-blue-600 focus:outline-none">
            <button type="submit"
                class="bg-blue-700 text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-600">
                Pretraži
            </button>
        </form>
    </div>

    <!-- Rezultati pretrage -->
    @if(isset($pretraga) && $pretraga)
        <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
            <div class="px-6 py-4 border-b bg-gray-50">
                <h2 class="font-semibold text-gray-700">
                    Rezultati pretrage za "{{ $pretraga }}" — {{ $preduzeca->count() }} pronađeno
                </h2>
            </div>

            @if($preduzeca->count() > 0)
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="text-left px-4 py-3">Naziv</th>
                            <th class="text-left px-4 py-3">PIB</th>
                            <th class="text-left px-4 py-3">MB</th>
                            <th class="text-left px-4 py-3">Adresa</th>
                            <th class="text-left px-4 py-3">Email</th>
                            <th class="text-left px-4 py-3">Akcija</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($preduzeca as $preduzece)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium">{{ $preduzece->naziv }}</td>
                            <td class="px-4 py-3">{{ $preduzece->pib }}</td>
                            <td class="px-4 py-3">{{ $preduzece->maticni_broj }}</td>
                            <td class="px-4 py-3">{{ $preduzece->adresa }}</td>
                            <td class="px-4 py-3">{{ $preduzece->email }}</td>
                            <td class="px-4 py-3">
                                @if($preduzece->id == auth()->user()->preduzece_id)
                                    <span class="text-gray-400 text-xs">Vaše preduzeće</span>
                                @else
                                    <button onclick="izaberiPreduzece({{ $preduzece->id }}, '{{ $preduzece->naziv }}')"
                                        class="bg-blue-700 text-white px-3 py-1 rounded text-xs hover:bg-blue-600">
                                        Dodaj kao komitenta
                                    </button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="px-6 py-8 text-center text-gray-400">
                    Nema preduzeća sa ovim nazivom ili PIB-om.
                </div>
            @endif
        </div>
    @endif

    <!-- Forma za dodavanje -->
    <div id="forma-komitenta" class="{{ isset($odabranoId) ? '' : 'hidden' }} bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Dodaj kao komitenta</h2>
        <form method="POST" action="{{ route('komitenti.store') }}">
            @csrf
            <input type="hidden" name="preduzece_id" id="preduzece_id">

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Odabrano preduzeće</label>
                <input type="text" id="naziv_preduzeca" readonly
                    class="w-full border rounded px-3 py-2 bg-gray-100 font-medium">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Tip komitenta *</label>
                <select name="tip" class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-blue-600 focus:outline-none">
                    <option value="klijent">Klijent</option>
                    <option value="dobavljac">Dobavljač</option>
                    <option value="oba">Oba</option>
                </select>
            </div>

            <div class="flex gap-4">
                <button type="submit"
                    class="bg-blue-700 text-white px-6 py-2 rounded-xl hover:bg-blue-600 font-bold">
                    Sačuvaj komitenta
                </button>
                <a href="{{ route('komitenti.index') }}"
                    class="bg-gray-400 text-white px-6 py-2 rounded-xl hover:bg-gray-500">
                    Otkaži
                </a>
            </div>
        </form>
    </div>

    <div class="mt-4">
        <a href="{{ route('komitenti.index') }}" class="text-gray-500 hover:text-gray-700 text-sm">
            ← Nazad na listu komitenata
        </a>
    </div>
</div>

<script>
function izaberiPreduzece(id, naziv) {
    document.getElementById('preduzece_id').value = id;
    document.getElementById('naziv_preduzeca').value = naziv;
    document.getElementById('forma-komitenta').classList.remove('hidden');
    document.getElementById('forma-komitenta').scrollIntoView({ behavior: 'smooth' });
}
</script>
@endsection