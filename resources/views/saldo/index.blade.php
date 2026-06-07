@extends('layouts.app')
@section('title', 'Saldo lista')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Saldo lista</h1>
    <form method="POST" action="{{ route('saldo.generisi') }}">
        @csrf
        <button type="submit"
            class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-600">
            Generisi saldo listu
        </button>
    </form>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="text-left px-4 py-3">Komitent</th>
                <th class="text-right px-4 py-3">Iznos dugovanja</th>
                <th class="text-left px-4 py-3">Valuta</th>
                <th class="text-left px-4 py-3">U valuti</th>
                <th class="text-left px-4 py-3">Datum generisanja</th>
            </tr>
        </thead>
        <tbody>
            @forelse($saldo as $stavka)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-4 py-3 font-medium">
                    <a href="{{ route('komitenti.show', $stavka->komitent) }}"
                        class="text-blue-600 hover:underline font-medium">
                        {{ $stavka->komitent->naziv }}
                    </a>
                </td>
                <td class="px-4 py-3 text-right
                    {{ $stavka->iznos_dugovanja > 0 ? 'text-red-600 font-bold' : 'text-green-600' }}">
                    {{ number_format($stavka->iznos_dugovanja, 2) }}
                </td>
                <td class="px-4 py-3">{{ $stavka->valuta }}</td>
                <td class="px-4 py-3">
                    @if($stavka->u_valuti)
                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">Da</span>
                    @else
                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs">Ne</span>
                    @endif
                </td>
                <td class="px-4 py-3">{{ $stavka->datum_generisanja->format('d.m.Y H:i') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-4 py-8 text-center text-gray-400">
                    Nema podataka. Kliknite "Generisi saldo listu".
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $saldo->links() }}</div>
@endsection