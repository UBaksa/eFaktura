@extends('layouts.app')
@section('title', 'Izmena komitenta')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">Izmena komitenta</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="{{ route('komitenti.update', $komitent) }}">
            @csrf @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Naziv</label>
                <input type="text" value="{{ $komitent->naziv }}"
                    class="w-full border rounded px-3 py-2 bg-gray-100 text-gray-500" disabled>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">PIB</label>
                <input type="text" value="{{ $komitent->pib }}"
                    class="w-full border rounded px-3 py-2 bg-gray-100 text-gray-500" disabled>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Adresa</label>
                <input type="text" value="{{ $komitent->adresa }}"
                    class="w-full border rounded px-3 py-2 bg-gray-100 text-gray-500" disabled>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="text" value="{{ $komitent->email ?? '-' }}"
                    class="w-full border rounded px-3 py-2 bg-gray-100 text-gray-500" disabled>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Telefon</label>
                <input type="text" value="{{ $komitent->telefon ?? '-' }}"
                    class="w-full border rounded px-3 py-2 bg-gray-100 text-gray-500" disabled>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Tip *</label>
                <select name="tip" class="w-full border rounded px-3 py-2">
                    <option value="klijent" {{ $komitent->tip == 'klijent' ? 'selected' : '' }}>Klijent</option>
                    <option value="dobavljac" {{ $komitent->tip == 'dobavljac' ? 'selected' : '' }}>Dobavljač</option>
                    <option value="oba" {{ $komitent->tip == 'oba' ? 'selected' : '' }}>Oba</option>
                </select>
            </div>

            <div class="flex gap-4">
                <button type="submit"
                    class="bg-blue-700 text-white px-6 py-2 rounded hover:bg-blue-600">
                    Sačuvaj izmene
                </button>
                <a href="{{ route('komitenti.index') }}"
                    class="bg-gray-400 text-white px-6 py-2 rounded hover:bg-gray-500">
                    Otkaži
                </a>
            </div>
        </form>
    </div>
</div>
@endsection