@extends('layouts.app')
@section('title', 'Moj profil')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">Moj profil</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Lični podaci -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h2 class="text-lg font-semibold mb-4">Lični podaci</h2>
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf @method('PATCH')

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ime</label>
                    <input type="text" name="ime" value="{{ old('ime', $user->ime) }}"
                        class="w-full border rounded px-3 py-2 @error('ime') border-red-500 @enderror">
                    @error('ime') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Prezime</label>
                    <input type="text" name="prezime" value="{{ old('prezime', $user->prezime) }}"
                        class="w-full border rounded px-3 py-2 @error('prezime') border-red-500 @enderror">
                    @error('prezime') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                    class="w-full border rounded px-3 py-2 @error('email') border-red-500 @enderror">
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Uloga</label>
                <input type="text" value="{{ ucfirst($user->uloga) }}"
                    class="w-full border rounded px-3 py-2 bg-gray-100" disabled>
            </div>

            @if($user->preduzece)
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Preduzeće</label>
                <input type="text" value="{{ $user->preduzece->naziv }}"
                    class="w-full border rounded px-3 py-2 bg-gray-100" disabled>
            </div>
            @endif

            <button type="submit"
                class="bg-blue-700 text-white px-6 py-2 rounded hover:bg-blue-600">
                Sačuvaj izmene
            </button>
        </form>
    </div>

    <!-- Promena lozinke -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h2 class="text-lg font-semibold mb-4">Promena lozinke</h2>
        <form method="POST" action="{{ route('profile.password') }}">
            @csrf @method('PATCH')

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Trenutna lozinka</label>
                <input type="password" name="current_password"
                    class="w-full border rounded px-3 py-2 @error('current_password') border-red-500 @enderror">
                @error('current_password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nova lozinka</label>
                <input type="password" name="password"
                    class="w-full border rounded px-3 py-2 @error('password') border-red-500 @enderror">
                @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Potvrdi novu lozinku</label>
                <input type="password" name="password_confirmation"
                    class="w-full border rounded px-3 py-2">
            </div>

            <button type="submit"
                class="bg-yellow-600 text-white px-6 py-2 rounded hover:bg-yellow-500">
                Promeni lozinku
            </button>
        </form>
    </div>

    <!-- Brisanje naloga -->
    <div class="bg-white rounded-lg shadow p-6 border border-red-200">
        <h2 class="text-lg font-semibold mb-2 text-red-600">Brisanje naloga</h2>
        <p class="text-sm text-gray-500 mb-4">Nakon brisanja naloga, svi podaci će biti trajno obrisani.</p>
        <form method="POST" action="{{ route('profile.destroy') }}"
            onsubmit="return confirm('Da li ste sigurni da želite da obrišete nalog?')">
            @csrf @method('DELETE')

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Unesite lozinku za potvrdu</label>
                <input type="password" name="password"
                    class="w-full border rounded px-3 py-2 @error('password') border-red-500 @enderror">
                @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <button type="submit"
                class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-500">
                Obriši nalog
            </button>
        </form>
    </div>
</div>
@endsection