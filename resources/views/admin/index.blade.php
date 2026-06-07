@extends('layouts.app')
@section('title', 'Admin panel')

@section('content')
<h1 class="text-2xl font-bold mb-6">Admin panel</h1>

<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-gray-500 text-sm">Ukupno korisnika</p>
        <p class="text-3xl font-bold text-blue-700">{{ $ukupnoKorisnika }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-gray-500 text-sm">Ukupno faktura</p>
        <p class="text-3xl font-bold text-green-700">{{ $ukupnoFaktura }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-gray-500 text-sm">Ukupno preduzeća</p>
        <p class="text-3xl font-bold text-purple-700">{{ $ukupnoPreduzeca }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <p class="text-gray-500 text-sm">Poslate fakture</p>
        <p class="text-3xl font-bold text-orange-700">{{ $poslateFakture }}</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <a href="{{ route('admin.korisnici') }}"
        class="bg-blue-700 text-white p-6 rounded-lg hover:bg-blue-600 text-center">
        <p class="text-xl font-bold">Upravljanje korisnicima</p>
        <p class="text-sm mt-1 text-blue-200">Pregled i aktivacija korisnika</p>
    </a>
    <a href="{{ route('admin.fakture') }}"
        class="bg-green-700 text-white p-6 rounded-lg hover:bg-green-600 text-center">
        <p class="text-xl font-bold">Sve fakture</p>
        <p class="text-sm mt-1 text-green-200">Pregled svih faktura u sistemu</p>
    </a>
    <a href="{{ route('admin.statistike') }}"
        class="bg-purple-700 text-white p-6 rounded-lg hover:bg-purple-600 text-center">
        <p class="text-xl font-bold">Statistike</p>
        <p class="text-sm mt-1 text-purple-200">Izveštaji i finansijska kontrola</p>
    </a>
</div>
@endsection