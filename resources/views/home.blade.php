<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eFaktura - Sistem za elektronske fakture</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
    .carousel-item {
        display: none;
        animation: fadeIn 0.8s ease-in-out;
    }
    .carousel-item.active {
        display: block;
    }
    .carousel-slide-left {
        animation: slideLeft 0.6s ease-in-out;
    }
    .carousel-slide-right {
        animation: slideRight 0.6s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes slideLeft {
        from { opacity: 0; transform: translateX(80px); }
        to { opacity: 1; transform: translateX(0); }
    }
    @keyframes slideRight {
        from { opacity: 0; transform: translateX(-80px); }
        to { opacity: 1; transform: translateX(0); }
    }
</style>
</head>
<body class="bg-gray-50 font-sans">

    <!-- Header -->
    <header class="bg-blue-900 text-white sticky top-0 z-50 shadow-lg">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="bg-white text-blue-900 font-black text-xl px-3 py-1 rounded">eF</div>
                <div>
                    <div class="text-xl font-bold">eFaktura</div>
                    <div class="text-xs text-blue-300">Sistem za elektronske fakture</div>
                </div>
            </div>
            <nav class="hidden md:flex items-center gap-8 text-sm">
                <a href="#o-sistemu" class="text-blue-200 hover:text-white transition">O sistemu</a>
                <a href="#poreski-sistem" class="text-blue-200 hover:text-white transition">Poreski sistem</a>
                <a href="#mogucnosti" class="text-blue-200 hover:text-white transition">Mogućnosti</a>
                <a href="#koriscenje" class="text-blue-200 hover:text-white transition">Kako koristiti</a>
            </nav>
            <div class="flex gap-3">
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="bg-white text-blue-900 px-5 py-2 rounded-lg font-bold hover:bg-blue-50 text-sm">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="text-white border border-blue-400 px-5 py-2 rounded-lg hover:bg-blue-800 text-sm transition">
                        Prijava
                    </a>
                    <a href="{{ route('register') }}"
                        class="bg-yellow-400 text-blue-900 px-5 py-2 rounded-lg font-bold hover:bg-yellow-300 text-sm transition">
                        Registracija
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Carousel / Hero -->
    <section class="relative bg-blue-900 text-white overflow-hidden" id="carousel">
        
        <!-- Slide 1 -->
        <div class="carousel-item active">
            <div class="min-h-screen md:min-h-0 md:h-96 flex items-center" 
                style="background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 50%, #1d4ed8 100%);">
                <div class="max-w-7xl mx-auto px-6 py-20 grid md:grid-cols-2 gap-12 items-center w-full">
                    <div>
                        <span class="bg-yellow-400 text-blue-900 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">
                            Republika Srbija
                        </span>
                        <h1 class="text-4xl md:text-5xl font-black mt-4 mb-6 leading-tight">
                            Elektronske fakture za moderna preduzeća
                        </h1>
                        <p class="text-blue-200 text-lg mb-8">
                            eFaktura je platforma inspirisana SEF sistemom Poreske uprave Srbije. 
                            Digitalizujte poslovanje i budite u skladu sa zakonom.
                        </p>
                        <div class="flex gap-4">
                            <a href="{{ route('register') }}"
                                class="bg-yellow-400 text-blue-900 px-8 py-3 rounded-lg font-black hover:bg-yellow-300 text-lg transition">
                                Počnite odmah
                            </a>
                            <a href="#o-sistemu"
                                class="border border-white text-white px-8 py-3 rounded-lg font-bold hover:bg-blue-800 text-lg transition">
                                Saznajte više
                            </a>
                        </div>
                    </div>
                    <div class="hidden md:flex justify-center">
                        <div class="bg-white bg-opacity-10 rounded-2xl p-8 text-center border border-blue-400">
                            <div class="text-6xl font-black text-yellow-400 mb-2">SEF</div>
                            <div class="text-blue-200 text-sm">Sistem za elektronske fakture</div>
                            <div class="mt-6 grid grid-cols-2 gap-4 text-sm">
                                <div class="bg-blue-800 rounded-lg p-3">
                                    <div class="text-yellow-400 font-bold text-xl">100%</div>
                                    <div class="text-blue-300">Digitalno</div>
                                </div>
                                <div class="bg-blue-800 rounded-lg p-3">
                                    <div class="text-yellow-400 font-bold text-xl">PDV</div>
                                    <div class="text-blue-300">Automatski</div>
                                </div>
                                <div class="bg-blue-800 rounded-lg p-3">
                                    <div class="text-yellow-400 font-bold text-xl">PDF</div>
                                    <div class="text-blue-300">Export</div>
                                </div>
                                <div class="bg-blue-800 rounded-lg p-3">
                                    <div class="text-yellow-400 font-bold text-xl">3</div>
                                    <div class="text-blue-300">Valute</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item">
            <div class="min-h-screen md:min-h-0 md:h-96 flex items-center"
                style="background: linear-gradient(135deg, #064e3b 0%, #065f46 50%, #047857 100%);">
                <div class="max-w-7xl mx-auto px-6 py-20 text-center w-full">
                    <span class="bg-green-400 text-green-900 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">
                        Poreski sistem Srbije
                    </span>
                    <h2 class="text-4xl md:text-5xl font-black mt-4 mb-6">
                        U skladu sa zakonodavstvom
                    </h2>
                    <p class="text-green-200 text-lg mb-8 max-w-3xl mx-auto">
                        Od 2022. godine, Zakon o elektronskom fakturisanju obavezuje sve privredne subjekte 
                        u Srbiji da koriste elektronske fakture u poslovanju sa javnim sektorom.
                    </p>
                    <div class="grid md:grid-cols-3 gap-6 max-w-4xl mx-auto">
                        <div class="bg-green-800 bg-opacity-50 rounded-xl p-6 border border-green-600">
                            <div class="text-3xl font-black text-green-300 mb-2">2022</div>
                            <div class="text-green-200 text-sm">Zakon o elektronskom fakturisanju</div>
                        </div>
                        <div class="bg-green-800 bg-opacity-50 rounded-xl p-6 border border-green-600">
                            <div class="text-3xl font-black text-green-300 mb-2">B2G</div>
                            <div class="text-green-200 text-sm">Obavezno za javni sektor</div>
                        </div>
                        <div class="bg-green-800 bg-opacity-50 rounded-xl p-6 border border-green-600">
                            <div class="text-3xl font-black text-green-300 mb-2">PDV</div>
                            <div class="text-green-200 text-sm">Automatski obračun 0%, 10%, 20%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item">
            <div class="min-h-screen md:min-h-0 md:h-96 flex items-center"
                style="background: linear-gradient(135deg, #4c1d95 0%, #5b21b6 50%, #6d28d9 100%);">
                <div class="max-w-7xl mx-auto px-6 py-20 text-center w-full">
                    <span class="bg-purple-300 text-purple-900 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">
                        Brzo i jednostavno
                    </span>
                    <h2 class="text-4xl md:text-5xl font-black mt-4 mb-6">
                        Sve na jednom mestu
                    </h2>
                    <p class="text-purple-200 text-lg mb-8 max-w-3xl mx-auto">
                        Kreirajte fakturu za manje od 2 minuta. Pratite status, generisite PDF 
                        i kontrolišite saldo listu — sve iz jednog sistema.
                    </p>
                    <a href="{{ route('register') }}"
                        class="bg-white text-purple-900 px-10 py-4 rounded-lg font-black text-xl hover:bg-purple-100 transition inline-block">
                        Registrujte se besplatno
                    </a>
                </div>
            </div>
        </div>

        <!-- Carousel controls -->
        <button onclick="prevSlide()"
            class="absolute left-4 top-1/2 -translate-y-1/2 bg-white bg-opacity-20 hover:bg-opacity-40 text-white w-10 h-10 rounded-full flex items-center justify-center transition">
            &#8249;
        </button>
        <button onclick="nextSlide()"
            class="absolute right-4 top-1/2 -translate-y-1/2 bg-white bg-opacity-20 hover:bg-opacity-40 text-white w-10 h-10 rounded-full flex items-center justify-center transition">
            &#8250;
        </button>

        <!-- Dots -->
        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2">
            <button onclick="goToSlide(0)" class="dot w-3 h-3 rounded-full bg-white opacity-100 transition"></button>
            <button onclick="goToSlide(1)" class="dot w-3 h-3 rounded-full bg-white opacity-40 transition"></button>
            <button onclick="goToSlide(2)" class="dot w-3 h-3 rounded-full bg-white opacity-40 transition"></button>
        </div>
    </section>

    <!-- Poreski sistem -->
    <section id="poreski-sistem" class="py-20 px-6 bg-gray-50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <span class="text-blue-600 font-bold uppercase text-sm tracking-wide">Srbija</span>
                <h2 class="text-4xl font-black text-gray-900 mt-2">Poreski sistem u Srbiji</h2>
                <div class="w-16 h-1 bg-yellow-400 mx-auto mt-4"></div>
                <p class="text-gray-500 mt-4 max-w-2xl mx-auto">
                    Razumevanje poreskog sistema je osnova za pravilno fakturisanje
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 mb-12">
                <div class="bg-white rounded-2xl shadow-md p-8">
                    <div class="bg-blue-100 text-blue-700 font-black text-2xl w-14 h-14 rounded-xl flex items-center justify-center mb-4">
                        PDV
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Porez na dodatu vrednost</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-4">
                        PDV je opšti porez na potrošnju koji se obračunava u svakoj fazi prometa. 
                        U Srbiji postoje tri stope PDV-a.
                    </p>
                    <div class="space-y-2">
                        <div class="flex justify-between items-center bg-gray-50 rounded-lg px-3 py-2">
                            <span class="text-sm text-gray-600">Standardna stopa</span>
                            <span class="font-black text-blue-700">20%</span>
                        </div>
                        <div class="flex justify-between items-center bg-gray-50 rounded-lg px-3 py-2">
                            <span class="text-sm text-gray-600">Posebna stopa</span>
                            <span class="font-black text-green-700">10%</span>
                        </div>
                        <div class="flex justify-between items-center bg-gray-50 rounded-lg px-3 py-2">
                            <span class="text-sm text-gray-600">Oslobođeno</span>
                            <span class="font-black text-gray-700">0%</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-md p-8">
                    <div class="bg-green-100 text-green-700 font-black text-2xl w-14 h-14 rounded-xl flex items-center justify-center mb-4">
                        SEF
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Sistem elektronskih faktura</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-4">
                        SEF je centralizovani sistem koji omogućava razmenu elektronskih faktura 
                        između privrednih subjekata i organa javne vlasti u Srbiji.
                    </p>
                    <div class="space-y-2">
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                            Obavezno od 2022. godine
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                            B2G i G2B transakcije
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                            Elektronsko arhiviranje
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                            Poreska kontrola u realnom vremenu
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-md p-8">
                    <div class="bg-yellow-100 text-yellow-700 font-black text-2xl w-14 h-14 rounded-xl flex items-center justify-center mb-4">
                        ZEF
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Zakon o e-fakturisanju</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-4">
                        Zakon o elektronskom fakturisanju reguliše obaveze privrednih subjekata 
                        u pogledu izdavanja, slanja i čuvanja elektronskih faktura.
                    </p>
                    <div class="space-y-2">
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <div class="w-2 h-2 bg-yellow-500 rounded-full"></div>
                            Sl. glasnik RS br. 44/2021
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <div class="w-2 h-2 bg-yellow-500 rounded-full"></div>
                            Obavezno čuvanje 10 godina
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <div class="w-2 h-2 bg-yellow-500 rounded-full"></div>
                            Kazne za nepoštovanje
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <div class="w-2 h-2 bg-yellow-500 rounded-full"></div>
                            Digitalni potpis obavezan
                        </div>
                    </div>
                </div>
            </div>

            <!-- Timeline -->
            <div class="bg-white rounded-2xl shadow-md p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-8 text-center">Istorijat uvođenja e-faktura u Srbiji</h3>
                <div class="grid md:grid-cols-4 gap-4">
                    <div class="text-center">
                        <div class="bg-blue-600 text-white font-black text-xl w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3">
                            2021
                        </div>
                        <h4 class="font-bold text-gray-900 mb-1">Zakon usvojen</h4>
                        <p class="text-gray-500 text-xs">Usvojen Zakon o elektronskom fakturisanju</p>
                    </div>
                    <div class="text-center">
                        <div class="bg-blue-700 text-white font-black text-xl w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3">
                            2022
                        </div>
                        <h4 class="font-bold text-gray-900 mb-1">B2G obavezno</h4>
                        <p class="text-gray-500 text-xs">Obavezno fakturisanje prema javnom sektoru</p>
                    </div>
                    <div class="text-center">
                        <div class="bg-blue-800 text-white font-black text-xl w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3">
                            2023
                        </div>
                        <h4 class="font-bold text-gray-900 mb-1">B2B obavezno</h4>
                        <p class="text-gray-500 text-xs">Prošireno na sve privredne subjekte</p>
                    </div>
                    <div class="text-center">
                        <div class="bg-yellow-500 text-white font-black text-xl w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3">
                            Sad
                        </div>
                        <h4 class="font-bold text-gray-900 mb-1">Potpuna primena</h4>
                        <p class="text-gray-500 text-xs">Svi privredni subjekti obavezno koriste SEF</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mogućnosti -->
    <section id="mogucnosti" class="py-20 px-6 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <span class="text-blue-600 font-bold uppercase text-sm tracking-wide">Funkcionalnosti</span>
                <h2 class="text-4xl font-black text-gray-900 mt-2">Mogućnosti sistema</h2>
                <div class="w-16 h-1 bg-yellow-400 mx-auto mt-4"></div>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="group bg-gray-50 hover:bg-blue-700 rounded-2xl p-8 transition-all duration-300 cursor-pointer">
                    <div class="bg-blue-100 group-hover:bg-blue-600 w-14 h-14 rounded-xl flex items-center justify-center mb-4 transition">
                        <svg class="w-7 h-7 text-blue-700 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-white mb-3 transition">Kreiranje faktura</h3>
                    <p class="text-gray-500 group-hover:text-blue-200 text-sm leading-relaxed transition">
                        Kreirajte izlazne fakture sa neograničenim brojem stavki. Automatski obračun PDV-a 
                        po stopama 0%, 10% i 20%. Podrška za RSD, EUR i USD valutu.
                    </p>
                </div>

                <div class="group bg-gray-50 hover:bg-green-700 rounded-2xl p-8 transition-all duration-300 cursor-pointer">
                    <div class="bg-green-100 group-hover:bg-green-600 w-14 h-14 rounded-xl flex items-center justify-center mb-4 transition">
                        <svg class="w-7 h-7 text-green-700 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-white mb-3 transition">Upravljanje komitentima</h3>
                    <p class="text-gray-500 group-hover:text-green-200 text-sm leading-relaxed transition">
                        Dodajte klijente i dobavljače sa svim podacima (PIB, adresa, kontakt). 
                        Pretraga i filtriranje. Pregled istorije faktura po komitentu.
                    </p>
                </div>

                <div class="group bg-gray-50 hover:bg-purple-700 rounded-2xl p-8 transition-all duration-300 cursor-pointer">
                    <div class="bg-purple-100 group-hover:bg-purple-600 w-14 h-14 rounded-xl flex items-center justify-center mb-4 transition">
                        <svg class="w-7 h-7 text-purple-700 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-white mb-3 transition">Saldo lista</h3>
                    <p class="text-gray-500 group-hover:text-purple-200 text-sm leading-relaxed transition">
                        Automatsko generisanje saldo liste po komitentima. Praćenje dugovanja 
                        i kontrola roka valute plaćanja.
                    </p>
                </div>

                <div class="group bg-gray-50 hover:bg-red-700 rounded-2xl p-8 transition-all duration-300 cursor-pointer">
                    <div class="bg-red-100 group-hover:bg-red-600 w-14 h-14 rounded-xl flex items-center justify-center mb-4 transition">
                        <svg class="w-7 h-7 text-red-700 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-white mb-3 transition">PDF export</h3>
                    <p class="text-gray-500 group-hover:text-red-200 text-sm leading-relaxed transition">
                        Generišite profesionalne PDF fakture sa svim podacima o preduzeću, 
                        komitentu i stavkama. Direktno preuzimanje.
                    </p>
                </div>

                <div class="group bg-gray-50 hover:bg-yellow-600 rounded-2xl p-8 transition-all duration-300 cursor-pointer">
                    <div class="bg-yellow-100 group-hover:bg-yellow-500 w-14 h-14 rounded-xl flex items-center justify-center mb-4 transition">
                        <svg class="w-7 h-7 text-yellow-700 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-white mb-3 transition">Praćenje statusa</h3>
                    <p class="text-gray-500 group-hover:text-yellow-100 text-sm leading-relaxed transition">
                        Svaka faktura ima status: poslata, primljena, plaćena ili odbijena. 
                        Prihvatanje i odbijanje faktura jednim klikom.
                    </p>
                </div>

                <div class="group bg-gray-50 hover:bg-gray-800 rounded-2xl p-8 transition-all duration-300 cursor-pointer">
                    <div class="bg-gray-200 group-hover:bg-gray-700 w-14 h-14 rounded-xl flex items-center justify-center mb-4 transition">
                        <svg class="w-7 h-7 text-gray-700 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-white mb-3 transition">Admin panel</h3>
                    <p class="text-gray-500 group-hover:text-gray-300 text-sm leading-relaxed transition">
                        Kompletna kontrola za administratore — pregled svih faktura, 
                        upravljanje korisnicima i statistike sistema.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Kako koristiti -->
    <section id="koriscenje" class="py-20 px-6 bg-blue-900 text-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <span class="text-yellow-400 font-bold uppercase text-sm tracking-wide">Uputstvo</span>
                <h2 class="text-4xl font-black mt-2">Kako koristiti eFakturu?</h2>
                <div class="w-16 h-1 bg-yellow-400 mx-auto mt-4"></div>
            </div>

            <div class="grid md:grid-cols-2 gap-8 mb-12">
                <div>
                    <h3 class="text-2xl font-bold text-yellow-400 mb-6">Za korisnike preduzeća</h3>
                    <div class="space-y-4">
                        <div class="flex gap-4 items-start">
                            <div class="bg-yellow-400 text-blue-900 font-black w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0">1</div>
                            <div>
                                <h4 class="font-bold mb-1">Registrujte se</h4>
                                <p class="text-blue-300 text-sm">Kreirajte nalog sa ulogom Računovođa ili Direktor, zatim unesite podatke o vašem preduzeću.</p>
                            </div>
                        </div>
                        <div class="flex gap-4 items-start">
                            <div class="bg-yellow-400 text-blue-900 font-black w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0">2</div>
                            <div>
                                <h4 class="font-bold mb-1">Dodajte komitente</h4>
                                <p class="text-blue-300 text-sm">Unesite podatke o klijentima i dobavljačima sa kojima poslujete (naziv, PIB, adresa).</p>
                            </div>
                        </div>
                        <div class="flex gap-4 items-start">
                            <div class="bg-yellow-400 text-blue-900 font-black w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0">3</div>
                            <div>
                                <h4 class="font-bold mb-1">Kreirajte fakturu</h4>
                                <p class="text-blue-300 text-sm">Izaberite komitenta, dodajte stavke sa cenama i PDV-om, postavite datum valute i pošaljite.</p>
                            </div>
                        </div>
                        <div class="flex gap-4 items-start">
                            <div class="bg-yellow-400 text-blue-900 font-black w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0">4</div>
                            <div>
                                <h4 class="font-bold mb-1">Pratite i upravljajte</h4>
                                <p class="text-blue-300 text-sm">Pratite status faktura, generišite PDF, prihvatajte ili odbijajte primljene fakture.</p>
                            </div>
                        </div>
                        <div class="flex gap-4 items-start">
                            <div class="bg-yellow-400 text-blue-900 font-black w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0">5</div>
                            <div>
                                <h4 class="font-bold mb-1">Generišite saldo listu</h4>
                                <p class="text-blue-300 text-sm">Pregledajte dugovanja po komitentima i kontrolišite rokove valute plaćanja.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-2xl font-bold text-yellow-400 mb-6">Za administratore</h3>
                    <div class="space-y-4">
                        <div class="flex gap-4 items-start">
                            <div class="bg-white text-blue-900 font-black w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0">1</div>
                            <div>
                                <h4 class="font-bold mb-1">Pristup admin panelu</h4>
                                <p class="text-blue-300 text-sm">Administrator se prijavljuje i automatski dobija pristup kompletnom admin panelu.</p>
                            </div>
                        </div>
                        <div class="flex gap-4 items-start">
                            <div class="bg-white text-blue-900 font-black w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0">2</div>
                            <div>
                                <h4 class="font-bold mb-1">Pregled svih faktura</h4>
                                <p class="text-blue-300 text-sm">Pristup svim fakturama svih preduzeća u sistemu radi poreske kontrole.</p>
                            </div>
                        </div>
                        <div class="flex gap-4 items-start">
                            <div class="bg-white text-blue-900 font-black w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0">3</div>
                            <div>
                                <h4 class="font-bold mb-1">Upravljanje korisnicima</h4>
                                <p class="text-blue-300 text-sm">Aktivacija i deaktivacija korisničkih naloga. Pregled svih registrovanih korisnika.</p>
                            </div>
                        </div>
                        <div class="flex gap-4 items-start">
                            <div class="bg-white text-blue-900 font-black w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0">4</div>
                            <div>
                                <h4 class="font-bold mb-1">Statistike i izveštaji</h4>
                                <p class="text-blue-300 text-sm">Pregled statistika faktura po mesecima i statusima za finansijsku kontrolu.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA -->
            <div class="bg-yellow-400 rounded-2xl p-10 text-center">
                <h3 class="text-3xl font-black text-blue-900 mb-4">Spremni da počnete?</h3>
                <p class="text-blue-800 mb-6">Registrujte se besplatno i počnite sa digitalnim fakturisanjem danas.</p>
                <a href="{{ route('register') }}"
                    class="bg-blue-900 text-white px-10 py-4 rounded-lg font-black text-lg hover:bg-blue-800 transition inline-block">
                    Registrujte se besplatno
                </a>
            </div>
        </div>
    </section>

    <!-- Uloge -->
    <section class="py-20 px-6 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <span class="text-blue-600 font-bold uppercase text-sm tracking-wide">Uloge u sistemu</span>
                <h2 class="text-4xl font-black text-gray-900 mt-2">Ko koristi eFakturu?</h2>
                <div class="w-16 h-1 bg-yellow-400 mx-auto mt-4"></div>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-blue-50 border-2 border-blue-200 rounded-2xl p-8 text-center hover:shadow-xl transition">
                    <div class="bg-blue-700 text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-black text-blue-900 mb-3">Administrator</h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4">
                        Predstavnik poreskih finansija. Ima pristup svim fakturama svih preduzeća 
                        radi kontrole i statistike. Upravlja korisnicima sistema.
                    </p>
                    <div class="bg-blue-700 text-white text-xs font-bold px-3 py-1 rounded-full inline-block">
                        Poreska uprava
                    </div>
                </div>

                <div class="bg-green-50 border-2 border-green-200 rounded-2xl p-8 text-center hover:shadow-xl transition">
                    <div class="bg-green-700 text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-black text-green-900 mb-3">Računovođa</h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4">
                        Zastupnik preduzeća na eFaktura portalu. Kreira, šalje i prima fakture. 
                        U slučaju pravnih posledica snosi krivičnu odgovornost.
                    </p>
                    <div class="bg-green-700 text-white text-xs font-bold px-3 py-1 rounded-full inline-block">
                        Preduzeće
                    </div>
                </div>

                <div class="bg-purple-50 border-2 border-purple-200 rounded-2xl p-8 text-center hover:shadow-xl transition">
                    <div class="bg-purple-700 text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-black text-purple-900 mb-3">Direktor</h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4">
                        Ima iste funkcionalnosti kao Računovođa. Ukoliko dođe do pravnih posledica, 
                        krivičnu odgovornost snosi kao ovlašćeni zastupnik preduzeća.
                    </p>
                    <div class="bg-purple-700 text-white text-xs font-bold px-3 py-1 rounded-full inline-block">
                        Preduzeće
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-6 py-16">
            <div class="grid md:grid-cols-4 gap-8 mb-12">
                <div class="col-span-2">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="bg-yellow-400 text-blue-900 font-black text-xl px-3 py-1 rounded">eF</div>
                        <div class="text-2xl font-bold">eFaktura</div>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed mb-4">
                        Sistem za upravljanje elektronskim fakturama inspirisan SEF portalom 
                        Poreske uprave Republike Srbije. Razvijen u edukativne svrhe.
                    </p>
                </div>
                <div>
                    <h4 class="font-bold text-yellow-400 mb-4">Navigacija</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="#poreski-sistem" class="hover:text-white transition">Poreski sistem</a></li>
                        <li><a href="#mogucnosti" class="hover:text-white transition">Mogućnosti</a></li>
                        <li><a href="#koriscenje" class="hover:text-white transition">Kako koristiti</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-yellow-400 mb-4">Stranice</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="{{ route('login') }}" class="hover:text-white transition">Prijava</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-white transition">Registracija</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-gray-500 text-sm">© 2026 eFaktura. Sva prava zadržana.</p>
                <p class="text-gray-500 text-sm">Republika Srbija · Ministarstvo finansija · Poreska uprava</p>
            </div>
        </div>
    </footer>

    <script>
    let trenutniSlajd = 0;
    let smer = 'left';
    const slajdovi = document.querySelectorAll('.carousel-item');
    const tackice = document.querySelectorAll('.dot');

    function prikaziSlajd(n, pravac = 'left') {
        slajdovi[trenutniSlajd].classList.remove('active');
        tackice.forEach(t => t.style.opacity = '0.4');
        trenutniSlajd = (n + slajdovi.length) % slajdovi.length;
        slajdovi[trenutniSlajd].classList.add('active');
        slajdovi[trenutniSlajd].classList.remove('carousel-slide-left', 'carousel-slide-right');
        void slajdovi[trenutniSlajd].offsetWidth; // reflow
        slajdovi[trenutniSlajd].classList.add(pravac === 'left' ? 'carousel-slide-left' : 'carousel-slide-right');
        tackice[trenutniSlajd].style.opacity = '1';
    }

    function nextSlide() { prikaziSlajd(trenutniSlajd + 1, 'left'); }
    function prevSlide() { prikaziSlajd(trenutniSlajd - 1, 'right'); }
    function goToSlide(n) { prikaziSlajd(n, n > trenutniSlajd ? 'left' : 'right'); }

    // Auto carousel
    setInterval(() => { nextSlide(); }, 5000);
</script>

</body>
</html>