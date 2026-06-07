@extends('layouts.app')
@section('title', 'Upravljanje korisnicima')

@section('content')
<h1 class="text-2xl font-bold mb-6">Upravljanje korisnicima</h1>

<!-- Na čekanju -->
@if($naCekanju->count() > 0)
<div class="bg-yellow-50 border border-yellow-200 rounded-lg mb-6">
    <div class="px-6 py-4 border-b border-yellow-200 flex items-center gap-2">
        <span class="w-3 h-3 bg-yellow-400 rounded-full"></span>
        <h2 class="font-bold text-yellow-800">Na čekanju ({{ $naCekanju->count() }})</h2>
    </div>
    <table class="w-full text-sm">
        <thead class="bg-yellow-100">
            <tr>
                <th class="text-left px-4 py-3">Ime i prezime</th>
                <th class="text-left px-4 py-3">Email</th>
                <th class="text-left px-4 py-3">Uloga</th>
                <th class="text-left px-4 py-3">Preduzeće</th>
                <th class="text-left px-4 py-3">Akcije</th>
            </tr>
        </thead>
        <tbody>
            @foreach($naCekanju as $korisnik)
            <tr class="border-t border-yellow-200">
                <td class="px-4 py-3 font-medium">{{ $korisnik->ime }} {{ $korisnik->prezime }}</td>
                <td class="px-4 py-3">{{ $korisnik->email }}</td>
                <td class="px-4 py-3">{{ ucfirst($korisnik->uloga) }}</td>
                <td class="px-4 py-3">
                    @if($korisnik->preduzece)
                        <a href="{{ route('admin.preduzece.show', $korisnik->preduzece) }}"
                            class="text-blue-600 hover:underline font-medium">
                            {{ $korisnik->preduzece->naziv }}
                        </a>
                    @else
                        -
                    @endif
                </td>
                <td class="px-4 py-3 flex gap-2">
                    <form method="POST" action="{{ route('admin.korisnici.odobri', $korisnik) }}">
                        @csrf @method('PATCH')
                        <button class="bg-green-600 text-white px-3 py-1 rounded text-xs hover:bg-green-500">
                            ✓ Odobri
                        </button>
                    </form>
                    <form method="POST" action="{{ route('admin.korisnici.odbij', $korisnik) }}">
                        @csrf @method('PATCH')
                        <button class="bg-red-600 text-white px-3 py-1 rounded text-xs hover:bg-red-500">
                            ✕ Odbij
                        </button>
                    </form>
                    <form method="POST" action="{{ route('admin.korisnici.obrisi', $korisnik) }}"
                        onsubmit="return confirm('Da li ste sigurni da želite da obrišete korisnika {{ $korisnik->ime }} {{ $korisnik->prezime }}?')">
                        @csrf @method('DELETE')
                        <button class="bg-gray-800 text-white px-3 py-1 rounded text-xs hover:bg-gray-700">
                            Obriši
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
<div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-6 text-center text-yellow-700">
    Nema korisnika na čekanju.
</div>
@endif

<!-- Odobreni -->
<div class="bg-white rounded-lg shadow mb-6">
    <div class="px-6 py-4 border-b flex items-center gap-2">
        <span class="w-3 h-3 bg-green-500 rounded-full"></span>
        <h2 class="font-bold text-gray-800">Odobreni korisnici ({{ $odobreni->count() }})</h2>
    </div>
    <table class="w-full text-sm">
        <thead class="bg-gray-50">
            <tr>
                <th class="text-left px-4 py-3">Ime i prezime</th>
                <th class="text-left px-4 py-3">Email</th>
                <th class="text-left px-4 py-3">Uloga</th>
                <th class="text-left px-4 py-3">Preduzeće</th>
                <th class="text-left px-4 py-3">Status</th>
                <th class="text-left px-4 py-3">Akcije</th>
            </tr>
        </thead>
        <tbody>
            @forelse($odobreni as $korisnik)
            <tr class="border-t hover:bg-gray-50">
                <td class="px-4 py-3 font-medium">{{ $korisnik->ime }} {{ $korisnik->prezime }}</td>
                <td class="px-4 py-3">{{ $korisnik->email }}</td>
                <td class="px-4 py-3">{{ ucfirst($korisnik->uloga) }}</td>
                <td class="px-4 py-3">
                    @if($korisnik->preduzece)
                        <a href="{{ route('admin.preduzece.show', $korisnik->preduzece) }}"
                            class="text-blue-600 hover:underline font-medium">
                            {{ $korisnik->preduzece->naziv }}
                        </a>
                    @else
                        -
                    @endif
                </td>
                <td class="px-4 py-3">
                    @if($korisnik->aktivan)
                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">Aktivan</span>
                    @else
                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs">Neaktivan</span>
                    @endif
                </td>
                <td class="px-4 py-3 flex gap-2">
                    @if($korisnik->aktivan)
                    <button onclick="otvoriModal({{ $korisnik->id }}, '{{ $korisnik->ime }} {{ $korisnik->prezime }}')"
                        class="bg-red-100 text-red-700 px-3 py-1 rounded text-xs hover:bg-red-200">
                        Deaktiviraj
                    </button>
                    @else
                    <form method="POST" action="{{ route('admin.korisnici.toggle', $korisnik) }}">
                        @csrf @method('PATCH')
                        <input type="hidden" name="obrazlozenje" value="Nalog je ponovo aktiviran.">
                        <button class="bg-green-100 text-green-700 px-3 py-1 rounded text-xs hover:bg-green-200">
                            Aktiviraj
                        </button>
                    </form>
                    @endif
                    <form method="POST" action="{{ route('admin.korisnici.odbij', $korisnik) }}">
                        @csrf @method('PATCH')
                        <button class="bg-orange-100 text-orange-700 px-3 py-1 rounded text-xs hover:bg-orange-200">
                            Odbij
                        </button>
                    </form>
                    <form method="POST" action="{{ route('admin.korisnici.obrisi', $korisnik) }}"
                        onsubmit="return confirm('Da li ste sigurni da želite da obrišete korisnika {{ $korisnik->ime }} {{ $korisnik->prezime }}?')">
                        @csrf @method('DELETE')
                        <button class="bg-gray-800 text-white px-3 py-1 rounded text-xs hover:bg-gray-700">
                            Obriši
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-4 py-8 text-center text-gray-400">Nema odobrenih korisnika.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Odbijeni -->
<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b flex items-center gap-2">
        <span class="w-3 h-3 bg-red-500 rounded-full"></span>
        <h2 class="font-bold text-gray-800">Odbijeni korisnici ({{ $odbijeni->count() }})</h2>
    </div>
    <table class="w-full text-sm">
        <thead class="bg-gray-50">
            <tr>
                <th class="text-left px-4 py-3">Ime i prezime</th>
                <th class="text-left px-4 py-3">Email</th>
                <th class="text-left px-4 py-3">Uloga</th>
                <th class="text-left px-4 py-3">Preduzeće</th>
                <th class="text-left px-4 py-3">Akcije</th>
            </tr>
        </thead>
        <tbody>
            @forelse($odbijeni as $korisnik)
            <tr class="border-t hover:bg-gray-50">
                <td class="px-4 py-3 font-medium">{{ $korisnik->ime }} {{ $korisnik->prezime }}</td>
                <td class="px-4 py-3">{{ $korisnik->email }}</td>
                <td class="px-4 py-3">{{ ucfirst($korisnik->uloga) }}</td>
                <td class="px-4 py-3">
                    @if($korisnik->preduzece)
                        <a href="{{ route('admin.preduzece.show', $korisnik->preduzece) }}"
                            class="text-blue-600 hover:underline font-medium">
                            {{ $korisnik->preduzece->naziv }}
                        </a>
                    @else
                        -
                    @endif
                </td>
                <td class="px-4 py-3 flex gap-2">
                    <form method="POST" action="{{ route('admin.korisnici.odobri', $korisnik) }}">
                        @csrf @method('PATCH')
                        <button class="bg-green-100 text-green-700 px-3 py-1 rounded text-xs hover:bg-green-200">
                            Odobri ponovo
                        </button>
                    </form>
                    <form method="POST" action="{{ route('admin.korisnici.obrisi', $korisnik) }}"
                        onsubmit="return confirm('Da li ste sigurni da želite da obrišete korisnika {{ $korisnik->ime }} {{ $korisnik->prezime }}?')">
                        @csrf @method('DELETE')
                        <button class="bg-gray-800 text-white px-3 py-1 rounded text-xs hover:bg-gray-700">
                            Obriši
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-4 py-8 text-center text-gray-400">Nema odbijenih korisnika.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Modal za deaktivaciju -->
<div id="modal-deaktivacija" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-xl p-8 max-w-md w-full mx-4">
        <h3 class="text-xl font-bold text-gray-900 mb-2">Deaktivacija korisnika</h3>
        <p id="modal-naziv" class="text-gray-500 mb-4"></p>
        <form method="POST" id="forma-deaktivacija">
            @csrf @method('PATCH')
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Obrazloženje *</label>
                <textarea name="obrazlozenje" rows="3" required
                    placeholder="Unesite razlog deaktivacije koji će biti poslat korisniku..."
                    class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-blue-600 focus:outline-none transition"></textarea>
            </div>
            <div class="flex gap-3">
                <button type="submit"
                    class="bg-red-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-red-500 flex-1">
                    Deaktiviraj
                </button>
                <button type="button" onclick="zatvoriModal()"
                    class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg font-bold hover:bg-gray-400 flex-1">
                    Otkaži
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function otvoriModal(id, naziv) {
    document.getElementById('modal-naziv').textContent = 'Korisnik: ' + naziv;
    document.getElementById('forma-deaktivacija').action = '/admin/korisnici/' + id + '/toggle';
    document.getElementById('modal-deaktivacija').classList.remove('hidden');
    document.getElementById('modal-deaktivacija').classList.add('flex');
}

function zatvoriModal() {
    document.getElementById('modal-deaktivacija').classList.add('hidden');
    document.getElementById('modal-deaktivacija').classList.remove('flex');
}
</script>
@endsection