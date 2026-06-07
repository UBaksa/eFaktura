@extends('layouts.app')
@section('title', 'Komitenti')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Komitenti</h1>
    <a href="{{ route('komitenti.create') }}"
        class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-600">
        + Novi komitent
    </a>
</div>

<!-- Pretraga -->
<form method="GET" class="bg-white rounded-lg shadow p-4 mb-6 flex gap-4">
    <input type="text" name="pretraga" value="{{ request('pretraga') }}"
        placeholder="Pretraži po nazivu, PIB-u,MB-u, adresi..."
        class="border rounded px-3 py-2 flex-1">
    <select name="tip" class="border rounded px-3 py-2">
        <option value="">Svi tipovi</option>
        <option value="klijent" {{ request('tip') == 'klijent' ? 'selected' : '' }}>Klijent</option>
        <option value="dobavljac" {{ request('tip') == 'dobavljac' ? 'selected' : '' }}>Dobavljač</option>
        <option value="oba" {{ request('tip') == 'oba' ? 'selected' : '' }}>Oba</option>
    </select>
    <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-600">
        Pretraži
    </button>
    <a href="{{ route('komitenti.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
        Reset
    </a>
</form>

<!-- Tabela -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="text-left px-4 py-3">Naziv</th>
                <th class="text-left px-4 py-3">PIB</th>
                <th class="text-left px-4 py-3">Adresa</th>
                <th class="text-left px-4 py-3">Tip</th>
                <th class="text-left px-4 py-3">Email</th>
                <th class="text-left px-4 py-3">Akcije</th>
            </tr>
        </thead>
        <tbody>
            @forelse($komitenti as $komitent)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-4 py-3 font-medium">{{ $komitent->naziv }}</td>
                <td class="px-4 py-3">{{ $komitent->pib }}</td>
                <td class="px-4 py-3">{{ $komitent->adresa }}</td>
                <td class="px-4 py-3">
                    <span class="px-2 py-1 rounded text-xs
                        {{ $komitent->tip == 'klijent' ? 'bg-green-100 text-green-700' : '' }}
                        {{ $komitent->tip == 'dobavljac' ? 'bg-orange-100 text-orange-700' : '' }}
                        {{ $komitent->tip == 'oba' ? 'bg-blue-100 text-blue-700' : '' }}">
                        {{ ucfirst($komitent->tip) }}
                    </span>
                </td>
                <td class="px-4 py-3">{{ $komitent->email ?? '-' }}</td>
                <td class="px-4 py-3 flex gap-2">
                    <a href="{{ route('komitenti.show', $komitent) }}"
                        class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs hover:bg-blue-200">
                        Pregled
                    </a>
                    <a href="{{ route('komitenti.edit', $komitent) }}"
                        class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs hover:bg-yellow-200">
                        Izmeni
                    </a>
                    <form method="POST" action="{{ route('komitenti.destroy', $komitent) }}"
                        onsubmit="return confirm('Da li ste sigurni?')">
                        @csrf @method('DELETE')
                        <button class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs hover:bg-red-200">
                            Obriši
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-4 py-8 text-center text-gray-400">
                    Nema komitenata. Dodajte prvog komitenta.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $komitenti->withQueryString()->links() }}
</div>
@endsection