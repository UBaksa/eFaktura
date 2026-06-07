@extends('layouts.app')
@section('title', 'Preduzeća')

@section('content')
<h1 class="text-2xl font-bold mb-6">Upravljanje preduzećima</h1>

<!-- Pretraga -->
<form method="GET" action="{{ route('admin.preduzeca') }}" class="mb-6 flex gap-3">
    <input type="text" name="pretraga" value="{{ $pretraga ?? '' }}"
        placeholder="Pretraži po nazivu, PIB-u ili matičnom broju..."
        class="flex-1 border rounded px-4 py-2 focus:outline-none focus:border-blue-600">
    <button type="submit" class="bg-blue-700 text-white px-6 py-2 rounded hover:bg-blue-600">
        Pretraži
    </button>
    @if($pretraga ?? false)
        <a href="{{ route('admin.preduzeca') }}" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
            Resetuj
        </a>
    @endif
</form>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="text-left px-4 py-3">Naziv</th>
                <th class="text-left px-4 py-3">PIB</th>
                <th class="text-left px-4 py-3">Matični broj</th>
                <th class="text-left px-4 py-3">Email</th>
                <th class="text-left px-4 py-3">Akcije</th>
            </tr>
        </thead>
        <tbody>
            @forelse($preduzeca as $preduzece)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-4 py-3 font-medium">{{ $preduzece->naziv }}</td>
                <td class="px-4 py-3">{{ $preduzece->pib }}</td>
                <td class="px-4 py-3">{{ $preduzece->maticni_broj }}</td>
                <td class="px-4 py-3">{{ $preduzece->email }}</td>
                <td class="px-4 py-3 flex gap-2">
                    <a href="{{ route('admin.preduzece.show', $preduzece) }}"
                        class="bg-blue-100 text-blue-700 px-3 py-1 rounded text-xs hover:bg-blue-200">
                        Pregled
                    </a>
                    <a href="{{ route('admin.preduzeca.edit', $preduzece) }}"
                        class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded text-xs hover:bg-yellow-200">
                        Izmeni
                    </a>
                    <form method="POST" action="{{ route('admin.preduzeca.obrisi', $preduzece) }}"
                        onsubmit="return confirm('Da li ste sigurni? Ovo će obrisati preduzeće i sve povezane podatke!')">
                        @csrf @method('DELETE')
                        <button class="bg-red-600 text-white px-3 py-1 rounded text-xs hover:bg-red-500">
                            Obriši
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-4 py-8 text-center text-gray-400">Nema preduzeća.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection