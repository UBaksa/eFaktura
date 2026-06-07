@extends('layouts.app')
@section('title', 'Pregled fakture')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Faktura {{ $faktura->broj_fakture }}</h1>
        <div class="flex gap-2">
           @if($faktura->status == 'poslata' && $faktura->tip == 'ulazna')
                <form method="POST" action="{{ route('fakture.prihvati', $faktura) }}">
                    @csrf @method('PATCH')
                    <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-500">
                        Prihvati
                    </button>
                </form>
                <button type="button" onclick="otvoriModalOdbijanja()"
                    class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-500">
                    Odbij
                </button>
            @endif
            <a href="/fakture/{{ $faktura->id }}/pdf" target="_blank"
                class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-600">
                PDF
            </a>
            <a href="{{ route('fakture.index') }}"
                class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
                Nazad
            </a>
        </div>
    </div>

    <!-- Info -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <div class="grid grid-cols-3 gap-4">
            <div>
                <p class="text-sm text-gray-500">Komitent</p>
                <p class="font-medium">{{ $faktura->komitent->naziv }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Datum izdavanja</p>
                <p class="font-medium">{{ $faktura->datum_izdavanja->format('d.m.Y') }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Datum valute</p>
                <p class="font-medium">{{ $faktura->datum_valute->format('d.m.Y') }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Tip</p>
                <p class="font-medium">{{ ucfirst($faktura->tip) }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Status</p>
                <span class="px-2 py-1 rounded text-xs
                    {{ $faktura->status == 'poslata' ? 'bg-blue-100 text-blue-700' : '' }}
                    {{ $faktura->status == 'primljena' ? 'bg-yellow-100 text-yellow-700' : '' }}
                    {{ $faktura->status == 'placena' ? 'bg-green-100 text-green-700' : '' }}
                    {{ $faktura->status == 'odbijena' ? 'bg-red-100 text-red-700' : '' }}">
                    {{ ucfirst($faktura->status) }}
                </span>
            </div>
            <div>
                <p class="text-sm text-gray-500">Valuta</p>
                <p class="font-medium">{{ $faktura->valuta }}</p>
            </div>
        </div>
        @if($faktura->napomena)
        <div class="mt-4">
            <p class="text-sm text-gray-500">Napomena</p>
            <p>{{ $faktura->napomena }}</p>
        </div>
        @endif
        <!-- Žiro računi -->
@if($faktura->preduzece->ziroRacuni->count() > 0)
<div class="mt-4">
    <p class="text-sm text-gray-500 mb-2">Žiro računi za plaćanje</p>
    <div class="space-y-1">
        @foreach($faktura->preduzece->ziroRacuni as $racun)
        <div class="flex items-center gap-2">
            <span class="bg-blue-700 text-white text-xs font-bold w-5 h-5 rounded-full flex items-center justify-center">
                {{ $racun->redosled }}
            </span>
            <span class="font-medium text-blue-700">{{ $racun->broj_racuna }}</span>
        </div>
        @endforeach
    </div>
</div>
@endif
        @if($faktura->dokument_url)
<div class="mt-4">
    <p class="text-sm text-gray-500 mb-2">Prateći dokument</p>
    @php
        $isPdf = str_contains($faktura->dokument_url, '.pdf') || 
                 str_contains($faktura->dokument_public_id ?? '', '.pdf');
    @endphp
    @if($isPdf)
        <a href="{{ $faktura->dokument_url }}" target="_blank"
            class="inline-flex items-center gap-2 bg-blue-100 text-blue-700 px-4 py-2 rounded-lg hover:bg-blue-200 text-sm font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            Otvori PDF dokument
        </a>
    @else
        <div>
            <a href="{{ $faktura->dokument_url }}" target="_blank"
                class="inline-flex items-center gap-2 bg-blue-100 text-blue-700 px-4 py-2 rounded-lg hover:bg-blue-200 text-sm font-medium mb-3">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                Otvori u punoj veličini
            </a>
            <div>
                <img src="{{ $faktura->dokument_url }}" alt="Prateći dokument"
                    class="max-w-sm rounded-lg border shadow cursor-pointer"
                    onclick="window.open('{{ $faktura->dokument_url }}', '_blank')">
            </div>
        </div>
    @endif
</div>
@endif
    </div>

    <!-- Stavke -->
    <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="text-left px-4 py-3">Naziv</th>
                    <th class="text-right px-4 py-3">Količina</th>
                    <th class="text-left px-4 py-3">Jed. mere</th>
                    <th class="text-right px-4 py-3">Cena bez PDV</th>
                    <th class="text-right px-4 py-3">PDV %</th>
                    <th class="text-right px-4 py-3">Iznos PDV</th>
                    <th class="text-right px-4 py-3">Ukupno</th>
                </tr>
            </thead>
            <tbody>
                @foreach($faktura->stavke as $stavka)
                <tr class="border-b">
                    <td class="px-4 py-3">{{ $stavka->naziv }}</td>
                    <td class="px-4 py-3 text-right">{{ $stavka->kolicina }}</td>
                    <td class="px-4 py-3">{{ $stavka->jedinica_mere }}</td>
                    <td class="px-4 py-3 text-right">{{ number_format($stavka->cena_bez_pdv, 2) }}</td>
                    <td class="px-4 py-3 text-right">{{ $stavka->pdv_stopa }}%</td>
                    <td class="px-4 py-3 text-right">{{ number_format($stavka->iznos_pdv, 2) }}</td>
                    <td class="px-4 py-3 text-right font-medium">{{ number_format($stavka->ukupno, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot class="bg-gray-50">
                <tr>
                    <td colspan="6" class="px-4 py-3 text-right font-bold">UKUPNO:</td>
                    <td class="px-4 py-3 text-right font-bold text-blue-700">
                        {{ number_format($faktura->stavke->sum('ukupno'), 2) }} {{ $faktura->valuta }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- Razlog odbijanja -->
@if($faktura->status == 'odbijena' && $faktura->razlog_odbijanja)
<div class="bg-red-50 border border-red-200 rounded-lg p-4 mt-4">
    <p class="text-sm font-bold text-red-700 mb-1">Razlog odbijanja:</p>
    <p class="text-red-600">{{ $faktura->razlog_odbijanja }}</p>
</div>
@endif

<!-- Modal za odbijanje -->
<div id="modal-odbijanja" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-xl p-8 max-w-md w-full mx-4">
        <h3 class="text-xl font-bold text-gray-900 mb-2">Odbijanje fakture</h3>
        <p class="text-gray-500 mb-4">Faktura: <strong>{{ $faktura->broj_fakture }}</strong></p>

        <form method="POST" action="{{ route('fakture.odbij', $faktura) }}">
            @csrf @method('PATCH')
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Razlog odbijanja *
                </label>
                <textarea name="razlog_odbijanja" rows="3" required
                    placeholder="Unesite razlog odbijanja fakture..."
                    class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-red-600 focus:outline-none transition"></textarea>
            </div>
            <div class="flex gap-3">
                <button type="submit"
                    class="bg-red-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-red-500 flex-1">
                    Odbij fakturu
                </button>
                <button type="button" onclick="zatvoriModalOdbijanja()"
                    class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg font-bold hover:bg-gray-400 flex-1">
                    Otkaži
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function otvoriModalOdbijanja() {
    document.getElementById('modal-odbijanja').classList.remove('hidden');
    document.getElementById('modal-odbijanja').classList.add('flex');
}

function zatvoriModalOdbijanja() {
    document.getElementById('modal-odbijanja').classList.add('hidden');
    document.getElementById('modal-odbijanja').classList.remove('flex');
}
</script>
@endsection