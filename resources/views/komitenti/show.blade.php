@extends('layouts.app')
@section('title', 'Pregled komitenta')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">{{ $komitent->naziv }}</h1>
        <div class="flex gap-2">
            <a href="{{ route('komitenti.edit', $komitent) }}"
                class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-400">
                Izmeni
            </a>
            <a href="{{ route('komitenti.index') }}"
                class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
                Nazad
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-500">PIB</p>
                <p class="font-medium">{{ $komitent->pib }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Tip</p>
                <p class="font-medium">{{ ucfirst($komitent->tip) }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Adresa</p>
                <p class="font-medium">{{ $komitent->adresa }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Email</p>
                <p class="font-medium">{{ $komitent->email ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Telefon</p>
                <p class="font-medium">{{ $komitent->telefon ?? '-' }}</p>
            </div>
        </div>
    </div>

    <h2 class="text-xl font-bold mb-4">Fakture komitenta</h2>
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="text-left px-4 py-3">Broj fakture</th>
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
                    <td class="px-4 py-3">{{ $faktura->datum_izdavanja->format('d.m.Y') }}</td>
                    <td class="px-4 py-3">{{ ucfirst($faktura->tip) }}</td>
                    <td class="px-4 py-3">{{ ucfirst($faktura->status) }}</td>
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
                    <td colspan="6" class="px-4 py-8 text-center text-gray-400">
                        Nema faktura za ovog komitenta.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $fakture->links() }}</div>
</div>
@endsection