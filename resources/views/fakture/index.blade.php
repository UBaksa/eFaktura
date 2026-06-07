@extends('layouts.app')
@section('title', 'Fakture')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Fakture</h1>
    <a href="{{ route('fakture.create') }}"
        class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-600">
        + Nova faktura
    </a>
</div>

<!-- Filteri -->
<form method="GET" class="bg-white rounded-lg shadow p-4 mb-6 flex gap-4 flex-wrap">
    <input type="text" name="pretraga" value="{{ request('pretraga') }}"
        placeholder="Pretraži po komitentu..."
        class="border rounded px-3 py-2 flex-1 min-w-40">
    <select name="tip" class="border border-gray-300 pl-3 pr-8 py-2 focus:outline-none bg-white text-gray-700">
        <option value="">Svi tipovi</option>
        <option value="izlazna" {{ request('tip') == 'izlazna' ? 'selected' : '' }}>Izlazna</option>
        <option value="ulazna" {{ request('tip') == 'ulazna' ? 'selected' : '' }}>Ulazna</option>
    </select>
    <select name="status" class="border border-gray-300 pl-3 pr-8 py-2 focus:outline-none bg-white text-gray-700">
        <option value="">Svi statusi</option>
        <option value="poslata" {{ request('status') == 'poslata' ? 'selected' : '' }}>Poslata</option>
        <option value="primljena" {{ request('status') == 'primljena' ? 'selected' : '' }}>Primljena</option>
        <option value="placena" {{ request('status') == 'placena' ? 'selected' : '' }}>Plaćena</option>
        <option value="odbijena" {{ request('status') == 'odbijena' ? 'selected' : '' }}>Odbijena</option>
    </select>
    <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-600">
        Filtiraj
    </button>
    <a href="{{ route('fakture.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
        Reset
    </a>
</form>

<!-- Tabela -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="text-left px-4 py-3">Broj fakture</th>
                <th class="text-left px-4 py-3">Komitent</th>
                <th class="text-left px-4 py-3">Datum izdavanja</th>
                <th class="text-left px-4 py-3">Datum valute</th>
                <th class="text-left px-4 py-3">Tip</th>
                <th class="text-left px-4 py-3">Status</th>
                <th class="text-left px-4 py-3">Valuta</th>
                <th class="text-left px-4 py-3">Akcije</th>
            </tr>
        </thead>
        <tbody>
            @forelse($fakture as $faktura)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-4 py-3 font-medium">{{ $faktura->broj_fakture }}</td>
                <td class="px-4 py-3">{{ $faktura->komitent->naziv }}</td>
                <td class="px-4 py-3">{{ $faktura->datum_izdavanja->format('d.m.Y') }}</td>
                <td class="px-4 py-3">{{ $faktura->datum_valute->format('d.m.Y') }}</td>
                <td class="px-4 py-3">
                    <span class="px-2 py-1 rounded text-xs
                        {{ $faktura->tip == 'izlazna' ? 'bg-green-100 text-green-700' : 'bg-orange-100 text-orange-700' }}">
                        {{ ucfirst($faktura->tip) }}
                    </span>
                </td>
                <td class="px-4 py-3">
                    <span class="px-2 py-1 rounded text-xs
                        {{ $faktura->status == 'poslata' ? 'bg-blue-100 text-blue-700' : '' }}
                        {{ $faktura->status == 'primljena' ? 'bg-yellow-100 text-yellow-700' : '' }}
                        {{ $faktura->status == 'placena' ? 'bg-green-100 text-green-700' : '' }}
                        {{ $faktura->status == 'odbijena' ? 'bg-red-100 text-red-700' : '' }}">
                        {{ ucfirst($faktura->status) }}
                    </span>
                </td>
                <td class="px-4 py-3">{{ $faktura->valuta }}</td>
                <td class="px-4 py-3">
                    <a href="{{ route('fakture.show', $faktura) }}"
                        class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs hover:bg-blue-200">
                        Pregled
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="px-4 py-8 text-center text-gray-400">
                    Nema faktura.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $fakture->withQueryString()->links() }}</div>
@endsection