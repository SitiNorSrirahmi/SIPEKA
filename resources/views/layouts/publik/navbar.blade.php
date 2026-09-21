<nav class="bg-white shadow-sm sticky top-0 z-50 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center justify-between h-16">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center shrink-0">
                <img src="{{ asset('images/logo-sidebar.png') }}" alt="SIPEKA"
                     class="h-9 w-auto object-contain">
            </a>

            {{-- Menu --}}
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

            {{-- Tombol --}}
            <div class="flex items-center gap-2">
                <a href="{{ route('laporan.create') }}"
                   class="hidden sm:inline-flex items-center bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                    Lapor Bencana
                </a>

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
        </div>
    </div>
</nav>