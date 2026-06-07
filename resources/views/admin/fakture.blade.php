@extends('layouts.app')
@section('title', 'Sve fakture')

@section('content')
<h1 class="text-2xl font-bold mb-6">Sve fakture u sistemu</h1>
<form method="GET" action="{{ route('admin.fakture') }}" class="mb-6 flex gap-3 flex-wrap">
    <input type="text" name="pretraga" value="{{ $pretraga ?? '' }}"
        placeholder="Pretraži po broju fakture ili preduzeću..."
        class="flex-1 border rounded px-4 py-2 focus:outline-none focus:border-blue-600 min-w-48">
    <input type="date" name="datum_od" value="{{ $datumOd ?? '' }}"
        class="border rounded px-4 py-2 focus:outline-none focus:border-blue-600">
    <input type="date" name="datum_do" value="{{ $datumDo ?? '' }}"
        class="border rounded px-4 py-2 focus:outline-none focus:border-blue-600">
    <button type="submit" class="bg-blue-700 text-white px-6 py-2 rounded hover:bg-blue-600">
        Pretraži
    </button>
    @if(($pretraga ?? false) || ($datumOd ?? false) || ($datumDo ?? false))
        <a href="{{ route('admin.fakture') }}" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
            Resetuj
        </a>
    @endif
</form>
<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="text-left px-4 py-3">Broj fakture</th>
                <th class="text-left px-4 py-3">Preduzeće</th>
                <th class="text-left px-4 py-3">Komitent</th>
                <th class="text-left px-4 py-3">Datum</th>
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
                <td class="px-4 py-3">{{ $faktura->preduzece->naziv }}</td>
                <td class="px-4 py-3">{{ $faktura->komitent->naziv }}</td>
                <td class="px-4 py-3">{{ $faktura->datum_izdavanja->format('d.m.Y') }}</td>
                <td class="px-4 py-3">{{ ucfirst($faktura->tip) }}</td>
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
                <td colspan="7" class="px-4 py-8 text-center text-gray-400">
                    Nema faktura u sistemu.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $fakture->links() }}</div>
@endsection