@extends('layouts.app')
@section('title', 'Statistike')

@section('content')
<h1 class="text-2xl font-bold mb-6">Statistike i kontrola</h1>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <!-- Fakture po statusu -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-bold mb-4">Fakture po statusu</h2>
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="text-left px-4 py-2">Status</th>
                    <th class="text-right px-4 py-2">Broj faktura</th>
                </tr>
            </thead>
            <tbody>
                @foreach($fakturePoStatusu as $stavka)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ ucfirst($stavka->status) }}</td>
                    <td class="px-4 py-2 text-right font-bold">{{ $stavka->broj }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Fakture po mesecu -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-bold mb-4">Fakture po mesecu</h2>
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="text-left px-4 py-2">Mesec</th>
                    <th class="text-right px-4 py-2">Broj faktura</th>
                </tr>
            </thead>
            <tbody>
                @php
                $meseci = ['', 'Januar', 'Februar', 'Mart', 'April', 'Maj', 'Jun',
                           'Jul', 'Avgust', 'Septembar', 'Oktobar', 'Novembar', 'Decembar'];
                @endphp
                @foreach($fakturePoBrojuMesecno as $stavka)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $meseci[$stavka->mesec] }}</td>
                    <td class="px-4 py-2 text-right font-bold">{{ $stavka->broj }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection