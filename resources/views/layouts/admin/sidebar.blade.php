<aside class="w-64 text-white flex flex-col shrink-0 min-h-screen"
    style="background: linear-gradient(to bottom, #0A1A3A 0%, #0D2440 100%);">

    {{-- ============ LOGO ============ --}}
    <div class="px-5 py-5 border-b border-white/10">
        <img src="{{ asset('images/logo-sidebar.png') }}" alt="SIPEKA"
             class="h-9 w-auto object-contain"
             style="filter: brightness(0) invert(1);">
        <p class="text-[10px] text-gray-400 mt-2 leading-snug tracking-wide">
            Sistem Informasi Peta Kebencanaan<br>
            Kalimantan Selatan
        </p>
    </div>

    {{-- ============ MENU ============ --}}
    <nav class="flex-1 px-3 py-3 space-y-0.5 overflow-y-auto">

        {{-- Dashboard --}}
        <a href="{{ route('admin.dashboard') }}"
            class="group flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all duration-200
                  {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white font-semibold shadow-md shadow-blue-600/20' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            Dashboard
        </a>

        {{-- Buat Laporan --}}
        <a href="{{ route('admin.laporan.create') }}"
            class="group flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all duration-200
                  {{ request()->routeIs('admin.laporan.create') ? 'bg-blue-600 text-white font-semibold shadow-md shadow-blue-600/20' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
            Buat Laporan
        </a>

        {{-- Laporan Masuk --}}
        <a href="{{ route('admin.laporan.index') }}"
            class="group flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all duration-200
                  {{ request()->routeIs('admin.laporan.index') ? 'bg-blue-600 text-white font-semibold shadow-md shadow-blue-600/20' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
            </svg>
            Laporan Masuk
        </a>

        {{-- Verifikasi Laporan --}}
        <a href="{{ route('admin.verifikasi-laporan') }}"
            class="group flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all duration-200
                  {{ request()->routeIs('admin.verifikasi-laporan') ? 'bg-blue-600 text-white font-semibold shadow-md shadow-blue-600/20' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Verifikasi Laporan
        </a>

        {{-- Peta & Kejadian --}}
        <a href="{{ route('admin.kejadian.index') }}"
            class="group flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all duration-200
                  {{ request()->routeIs('admin.kejadian.*') ? 'bg-blue-600 text-white font-semibold shadow-md shadow-blue-600/20' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
            </svg>
            Peta &amp; Kejadian
        </a>

        {{-- Pengguna --}}
        <a href="{{ route('admin.users.index') }}"
            class="group flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all duration-200
                  {{ request()->routeIs('admin.users.*') ? 'bg-blue-600 text-white font-semibold shadow-md shadow-blue-600/20' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            Pengguna
        </a>

        {{-- Wilayah Rawan --}}
        <a href="{{ route('admin.wilayah.index') }}"
            class="group flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all duration-200
                  {{ request()->routeIs('admin.wilayah.*') ? 'bg-blue-600 text-white font-semibold shadow-md shadow-blue-600/20' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            Wilayah Rawan
        </a>

        {{-- Statistik --}}
        <a href="{{ route('statistik.index') }}"
            class="group flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all duration-200
                  {{ request()->routeIs('statistik.*') ? 'bg-blue-600 text-white font-semibold shadow-md shadow-blue-600/20' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
            Statistik
        </a>

        {{-- Kelola Berita --}}
        <a href="{{ route('admin.berita.index') }}"
            class="group flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all duration-200
                  {{ request()->routeIs('admin.berita.*') ? 'bg-blue-600 text-white font-semibold shadow-md shadow-blue-600/20' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
            </svg>
            Kelola Berita
        </a>

    </nav>

    {{-- ============ LOGOUT ============ --}}
    <div class="px-3 py-3 border-t border-white/10">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="flex items-center gap-3 w-full px-3 py-2.5 rounded-lg text-sm font-semibold transition-all duration-200 hover:bg-red-500/10"
                style="color: #FF6B6B;">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Logout
            </button>
        </form>
    </div>

</aside>