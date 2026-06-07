@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<h1 class="text-2xl font-bold mb-6">Dashboard</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-gray-500 text-sm">Ukupno faktura</p>
        <p class="text-3xl font-bold text-blue-700">{{ $ukupnoFaktura }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-gray-500 text-sm">Izlazne fakture</p>
        <p class="text-3xl font-bold text-green-700">{{ $izlazneFakture }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-gray-500 text-sm">Ulazne fakture</p>
        <p class="text-3xl font-bold text-orange-700">{{ $ulazneFakture }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-gray-500 text-sm">Ukupno komitenata</p>
        <p class="text-3xl font-bold text-purple-700">{{ $ukupnoKomitenata }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-gray-500 text-sm">Poslate fakture</p>
        <p class="text-3xl font-bold text-yellow-700">{{ $poslateFakture }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-gray-500 text-sm">Odbijene fakture</p>
        <p class="text-3xl font-bold text-red-700">{{ $odbijene }}</p>
    </div>
</div>

<div class="mt-8 flex gap-4">
    <a href="{{ route('fakture.create') }}"
        class="bg-blue-700 text-white px-6 py-3 rounded-lg hover:bg-blue-600">
        + Nova faktura
    </a>
    <a href="{{ route('komitenti.create') }}"
        class="bg-green-700 text-white px-6 py-3 rounded-lg hover:bg-green-600">
        + Novi komitent
    </a>
    <a href="{{ route('saldo.index') }}"
        class="bg-purple-700 text-white px-6 py-3 rounded-lg hover:bg-purple-600">
        Saldo lista
    </a>
</div>
@endsection