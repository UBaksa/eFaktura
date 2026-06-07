<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eFaktura - @yield('title', 'Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">

    <!-- Navigacija -->
    <nav class="bg-blue-800 text-white px-4 py-4">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-2">
                <a href="{{ route('dashboard') }}" class="text-xl font-bold mr-4">eFaktura</a>

                <!-- Desktop meni -->
                <div class="hidden md:flex items-center gap-4">
                    @auth
                        @if(auth()->user()->uloga !== 'administrator')
                            <a href="{{ route('komitenti.index') }}" class="hover:text-blue-200 text-sm">Komitenti</a>
                            <a href="{{ route('fakture.index') }}" class="hover:text-blue-200 text-sm">Fakture</a>
                            <a href="{{ route('saldo.index') }}" class="hover:text-blue-200 text-sm">Saldo lista</a>
                        @else
                            <a href="{{ route('admin.index') }}" class="hover:text-blue-200 text-sm">Admin panel</a>
                            <a href="{{ route('admin.korisnici') }}" class="hover:text-blue-200 text-sm">Korisnici</a>
                            <a href="{{ route('admin.fakture') }}" class="hover:text-blue-200 text-sm">Sve fakture</a>
                            <a href="{{ route('admin.statistike') }}" class="hover:text-blue-200 text-sm">Statistike</a>
                            <a href="{{ route('admin.preduzeca') }}" class="hover:text-blue-200 text-sm">Preduzeća</a>
                        @endif
                    @endauth
                </div>
            </div>

            <div class="flex items-center gap-2">
                @auth
                <span class="hidden md:block text-sm text-blue-200">
                    {{ auth()->user()->ime }} {{ auth()->user()->prezime }}
                    ({{ ucfirst(auth()->user()->uloga) }})
                </span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-blue-600 hover:bg-blue-500 px-3 py-1 rounded text-sm">
                        Odjavi se
                    </button>
                </form>
                @endauth

                <!-- Hamburger dugme -->
                @auth
                <button onclick="toggleMeni()" class="md:hidden ml-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                @endauth
            </div>
        </div>

        <!-- Mobilni meni -->
        @auth
        <div id="mobilni-meni" class="hidden md:hidden mt-3 border-t border-blue-700 pt-3">
            <div class="flex flex-col gap-3">
                @if(auth()->user()->uloga !== 'administrator')
                    <a href="{{ route('komitenti.index') }}" class="hover:text-blue-200">Komitenti</a>
                    <a href="{{ route('fakture.index') }}" class="hover:text-blue-200">Fakture</a>
                    <a href="{{ route('saldo.index') }}" class="hover:text-blue-200">Saldo lista</a>
                @else
                    <a href="{{ route('admin.index') }}" class="hover:text-blue-200">Admin panel</a>
                    <a href="{{ route('admin.korisnici') }}" class="hover:text-blue-200">Korisnici</a>
                    <a href="{{ route('admin.fakture') }}" class="hover:text-blue-200">Sve fakture</a>
                    <a href="{{ route('admin.statistike') }}" class="hover:text-blue-200">Statistike</a>
                    <a href="{{ route('admin.preduzeca') }}" class="hover:text-blue-200">Preduzeća</a>
                @endif
                <span class="text-sm text-blue-200">
                    {{ auth()->user()->ime }} {{ auth()->user()->prezime }}
                    ({{ ucfirst(auth()->user()->uloga) }})
                </span>
            </div>
        </div>
        @endauth
    </nav>

    <!-- Flash poruke -->
    <div class="max-w-7xl mx-auto px-4 mt-4">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <!-- Sadržaj -->
    <main class="max-w-7xl mx-auto px-4 py-6">
        @yield('content')
    </main>

    <script>
    function toggleMeni() {
        const meni = document.getElementById('mobilni-meni');
        meni.classList.toggle('hidden');
    }
    </script>

</body>
</html>