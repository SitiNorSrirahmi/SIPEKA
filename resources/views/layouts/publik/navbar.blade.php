<nav x-data="{ mobileOpen: false }" class="bg-white shadow-sm sticky top-0 z-50 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex items-center justify-between h-16">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center shrink-0">
                <img src="{{ asset('images/logo-sidebar.png') }}" alt="SIPEKA"
                     class="h-8 sm:h-9 w-auto object-contain">
            </a>

            {{-- Menu Desktop (≥ lg) --}}
            <div class="hidden lg:flex items-center gap-1">
                <a href="{{ route('home') }}"
                   class="px-3 py-2 rounded-lg text-sm font-medium transition
                          {{ request()->routeIs('home') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }}">
                    Beranda
                </a>
                <a href="{{ route('wilayahrawan.index') }}"
                   class="px-3 py-2 rounded-lg text-sm font-medium transition
                          {{ request()->routeIs('wilayahrawan.*') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }}">
                    Wilayah Rawan
                </a>
                <a href="{{ route('berita.index') }}"
                   class="px-3 py-2 rounded-lg text-sm font-medium transition
                          {{ request()->routeIs('berita.*') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }}">
                    Berita
                </a>
                <a href="{{ route('statistik.index') }}"
                   class="px-3 py-2 rounded-lg text-sm font-medium transition
                          {{ request()->routeIs('statistik.*') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }}">
                    Statistik
                </a>
                <a href="{{ route('kejadian.index') }}"
                   class="px-3 py-2 rounded-lg text-sm font-medium transition
                          {{ request()->routeIs('kejadian.*') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }}">
                    Kejadian
                </a>
                <a href="{{ route('cek-status.index') }}"
                   class="px-3 py-2 rounded-lg text-sm font-medium transition
                          {{ request()->routeIs('cek-status.*') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }}">
                    Cek Status
                </a>
            </div>

            {{-- Tombol Kanan --}}
            <div class="flex items-center gap-2">

                {{-- Lapor Bencana (desktop) --}}
                <a href="{{ route('laporan.create') }}"
                   class="hidden sm:inline-flex items-center bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                    Lapor Bencana
                </a>

                {{-- Auth Buttons (desktop) --}}
                <div class="hidden lg:flex items-center gap-2">
                    @auth
                        <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('petugas.dashboard') }}"
                           class="px-4 py-2 rounded-lg text-sm font-semibold bg-blue-600 hover:bg-blue-700 text-white transition">
                            Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="px-4 py-2 rounded-lg text-sm font-semibold text-red-500 hover:bg-red-50 transition">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                           class="px-4 py-2 rounded-lg text-sm font-semibold bg-blue-600 hover:bg-blue-700 text-white transition">
                            Masuk
                        </a>
                    @endauth
                </div>

                {{-- Hamburger Button (mobile) --}}
                <button type="button"
                        @click="mobileOpen = !mobileOpen"
                        class="lg:hidden inline-flex items-center justify-center w-10 h-10 rounded-lg text-gray-600 hover:bg-gray-100 transition"
                        aria-label="Toggle menu">
                    <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="mobileOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- ============ MOBILE MENU (OVERLAY — setengah kanan) ============ --}}
    <div x-show="mobileOpen"
         x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 translate-x-4"
         x-transition:enter-end="opacity-100 translate-x-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-x-0"
         x-transition:leave-end="opacity-0 translate-x-4"
         @click.away="mobileOpen = false"
         class="lg:hidden absolute top-full right-0 w-72 max-w-[85vw] bg-white shadow-lg border-l border-gray-100 max-h-[calc(100vh-4rem)] overflow-y-auto rounded-bl-2xl">

        <div class="px-4 py-3 space-y-1">

            {{-- Menu Items --}}
            <a href="{{ route('home') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition
                      {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-gray-700 hover:bg-gray-50' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Beranda
            </a>

            <a href="{{ route('wilayahrawan.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition
                      {{ request()->routeIs('wilayahrawan.*') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-gray-700 hover:bg-gray-50' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Wilayah Rawan
            </a>

            <a href="{{ route('berita.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition
                      {{ request()->routeIs('berita.*') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-gray-700 hover:bg-gray-50' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                </svg>
                Berita
            </a>

            <a href="{{ route('statistik.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition
                      {{ request()->routeIs('statistik.*') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-gray-700 hover:bg-gray-50' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                Statistik
            </a>

            <a href="{{ route('kejadian.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition
                      {{ request()->routeIs('kejadian.*') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-gray-700 hover:bg-gray-50' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                </svg>
                Kejadian
            </a>

            <a href="{{ route('cek-status.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition
                      {{ request()->routeIs('cek-status.*') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-gray-700 hover:bg-gray-50' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                Cek Status
            </a>

            {{-- Divider --}}
            <div class="border-t border-gray-100 my-2"></div>

            {{-- Lapor Bencana --}}
            <a href="{{ route('laporan.create') }}"
               class="flex items-center justify-center gap-2 bg-red-600 hover:bg-red-700 text-white px-4 py-3 rounded-lg text-sm font-bold transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                </svg>
                Lapor Bencana
            </a>

            {{-- Auth Buttons --}}
            @auth
                <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('petugas.dashboard') }}"
                   class="flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-lg text-sm font-bold transition">
                    Dashboard
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="w-full flex items-center justify-center gap-2 text-red-600 hover:bg-red-50 px-4 py-3 rounded-lg text-sm font-bold transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                   class="flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-lg text-sm font-bold transition">
                    Masuk
                </a>
            @endauth

        </div>
    </div>
</nav>