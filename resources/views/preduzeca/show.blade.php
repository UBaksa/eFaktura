@extends('layouts.app')
@section('title', 'Pregled preduzeća')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">{{ $preduzece->naziv }}</h1>
        <a href="{{ route('admin.korisnici') }}"
            class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
            Nazad
        </a>
    </div>

    <!-- Osnovni podaci -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h2 class="text-lg font-bold mb-4">Osnovni podaci</h2>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-500">Naziv</p>
                <p class="font-medium">{{ $preduzece->naziv }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">PIB</p>
                <p class="font-medium">{{ $preduzece->pib }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Matični broj</p>
                <p class="font-medium">{{ $preduzece->maticni_broj }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Adresa</p>
                <p class="font-medium">{{ $preduzece->adresa }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Mesto</p>
                <p class="font-medium">{{ $preduzece->mesto ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Email</p>
                <p class="font-medium">{{ $preduzece->email }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Telefon</p>
                <p class="font-medium">{{ $preduzece->telefon }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Godina osnivanja</p>
                <p class="font-medium">{{ $preduzece->godina_osnivanja ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Ime vlasnika</p>
                <p class="font-medium">{{ $preduzece->ime_vlasnika ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Vrsta preduzeća</p>
                <p class="font-medium">{{ $preduzece->vrsta_preduzeca ? ucfirst($preduzece->vrsta_preduzeca) : '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Vrsta delatnosti</p>
                <p class="font-medium">{{ $preduzece->vrsta_delatnosti ?? '-' }}</p>
            </div>
        </div>
    </div>

    <!-- Žiro računi -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h2 class="text-lg font-bold mb-4">Žiro računi</h2>
        @if($preduzece->ziroRacuni->count() > 0)
            <div class="space-y-2">
                @foreach($preduzece->ziroRacuni as $racun)
                <div class="flex items-center gap-3 bg-gray-50 rounded-lg px-4 py-3">
                    <span class="bg-blue-700 text-white text-xs font-bold w-6 h-6 rounded-full flex items-center justify-center">
                        {{ $racun->redosled }}
                    </span>
                    <span class="font-medium">{{ $racun->broj_racuna }}</span>
                </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-400">Nema žiro računa.</p>
        @endif
    </div>

    <!-- APR dokument -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-bold mb-4">APR dokument / Rešenje o registraciji</h2>
        @if($preduzece->apr_dokument_url)
            @php
                $url = $preduzece->apr_dokument_url;
                $isPdf = str_contains($url, '.pdf') || str_contains($preduzece->apr_dokument_public_id ?? '', '.pdf');
            @endphp

            @if($isPdf)
                <div class="mb-4">
                    <a href="{{ $url }}" target="_blank"
                        class="bg-blue-700 text-white px-6 py-3 rounded-lg hover:bg-blue-600 inline-flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Otvori PDF dokument
                    </a>
                </div>
                <iframe src="{{ $url }}" class="w-full h-96 border rounded-lg" title="APR dokument"></iframe>
            @else
                <div class="mb-4">
                    <a href="{{ $url }}" target="_blank"
                        class="bg-blue-700 text-white px-6 py-3 rounded-lg hover:bg-blue-600 inline-flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                        Otvori u punoj veličini
                    </a>
                </div>
                <img src="{{ $url }}" alt="APR dokument" class="w-full rounded-lg border shadow">
            @endif
        @else
            <div class="bg-gray-50 rounded-lg p-8 text-center text-gray-400">
                Nema uploadovanog dokumenta.
            </div>
        @endif
    </div>
</div>
@endsection