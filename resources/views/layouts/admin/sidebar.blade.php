<aside class="w-64 bg-[#1e3a5f] text-white flex flex-col shrink-0 min-h-screen">

    {{-- Logo --}}
    <div class="px-5 py-5 border-b border-white/10">
        <div class="flex items-center gap-2">
            <span class="text-yellow-400 text-lg">✦</span>
            <span class="font-bold text-lg tracking-wide">SIPEKA</span>
        </div>
        <p class="text-xs text-gray-300 mt-1 leading-tight">
            Sistem Informasi Peta Kebencanaan
        </p>
    </div>

    {{-- Menu --}}
    <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">

        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition
           {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white font-semibold' : 'text-gray-200 hover:bg-white/10' }}">
            <span>🏠</span> Dashboard
        </a>

        <a href="{{ route('admin.laporan.create') }}"
            class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition
           {{ request()->routeIs('admin.laporan.create') ? 'bg-blue-600 text-white font-semibold' : 'text-gray-200 hover:bg-white/10' }}">
            <span>📝</span> Buat Laporan
        </a>

        <a href="{{ route('admin.laporan.index') }}"
            class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition
           {{ request()->routeIs('admin.laporan.index') ? 'bg-blue-600 text-white font-semibold' : 'text-gray-200 hover:bg-white/10' }}">
            <span>📋</span> Laporan Masuk
        </a>

        <a href="{{ route('admin.kejadian.index') }}"
            class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition
           {{ request()->routeIs('admin.kejadian.*') ? 'bg-blue-600 text-white font-semibold' : 'text-gray-200 hover:bg-white/10' }}">
            <span>🗺️</span> Peta &amp; Kejadian
        </a>

        <a href="{{ route('admin.users.index') }}"
            class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition
           {{ request()->routeIs('admin.users.*') ? 'bg-blue-600 text-white font-semibold' : 'text-gray-200 hover:bg-white/10' }}">
            <span>👥</span> Pengguna
        </a>

        <a href="{{ route('admin.wilayah.index') }}"
            class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition
           {{ request()->routeIs('admin.wilayah.*') ? 'bg-blue-600 text-white font-semibold' : 'text-gray-200 hover:bg-white/10' }}">
            <span>📍</span> Wilayah Rawan
        </a>

        <a href="{{ route('statistik.index') }}"
            class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition
           {{ request()->routeIs('statistik.*') ? 'bg-blue-600 text-white font-semibold' : 'text-gray-200 hover:bg-white/10' }}">
            <span>📊</span> Statistik
        </a>

        <a href="{{ route('admin.berita.index') }}"
            class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition
           {{ request()->routeIs('admin.berita.*') ? 'bg-blue-600 text-white font-semibold' : 'text-gray-200 hover:bg-white/10' }}">
            <span>📰</span> Kelola Berita
        </a>

    </nav>

    {{-- Logout --}}
    <div class="px-3 py-4 border-t border-white/10">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="flex items-center gap-3 w-full px-3 py-2 rounded-lg text-sm text-orange-300 hover:bg-white/10 transition">
                <span>🚪</span> Logout
            </button>
        </form>
    </div>

</aside>