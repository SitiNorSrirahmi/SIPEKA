@extends('layouts.admin')

@section('header', 'Kelola Akun Pengguna')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6 lg:py-8">

    {{-- ==================== HEADER — SEJAJAR ==================== --}}
    <div class="flex items-center justify-between gap-3 mb-4 sm:mb-6">
        <div class="flex items-center gap-3 min-w-0">
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-blue-100 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <div class="min-w-0">
                <h1 class="text-base sm:text-xl lg:text-2xl font-bold text-gray-800 truncate">Kelola Akun Pengguna</h1>
                <p class="text-[11px] sm:text-sm text-gray-500 truncate">Kelola akun admin, petugas, dan pengguna SIPEKA</p>
            </div>
        </div>
        <a href="{{ route('admin.users.create') }}"
           class="inline-flex items-center justify-center gap-1.5 sm:gap-2 bg-red-500 hover:bg-red-600 text-white px-3 sm:px-4 py-2 sm:py-2.5 rounded-lg sm:rounded-xl text-[11px] sm:text-xs font-bold shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5 shrink-0">
            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Akun
        </a>
    </div>

    {{-- ==================== SUCCESS ==================== --}}
    @if (session('success'))
    <div class="flex items-start gap-3 bg-green-50 border border-green-200 text-green-700 p-3 sm:p-4 mb-4 sm:mb-5 rounded-xl">
        <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span class="text-xs sm:text-sm">{{ session('success') }}</span>
    </div>
    @endif

    {{-- ==================== TABEL ==================== --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

        {{-- Desktop: tabel --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="text-left px-5 py-3 font-bold text-gray-500 text-xs uppercase tracking-wider">Nama</th>
                        <th class="text-left px-5 py-3 font-bold text-gray-500 text-xs uppercase tracking-wider">Email</th>
                        <th class="text-left px-5 py-3 font-bold text-gray-500 text-xs uppercase tracking-wider">NIP</th>
                        <th class="text-left px-5 py-3 font-bold text-gray-500 text-xs uppercase tracking-wider">Role</th>
                        <th class="text-center px-5 py-3 font-bold text-gray-500 text-xs uppercase tracking-wider">Status</th>
                        <th class="text-center px-5 py-3 font-bold text-gray-500 text-xs uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($users as $item)
                        @php
                            $roleColor = match(strtolower($item->role ?? '')) {
                                'admin' => 'bg-purple-100 text-purple-700',
                                'petugas' => 'bg-blue-100 text-blue-700',
                                'masyarakat', 'user' => 'bg-gray-100 text-gray-700',
                                default => 'bg-gray-100 text-gray-600',
                            };
                            $aksiConfirm = $item->aktif ? 'Nonaktifkan akun ini?' : 'Aktifkan akun ini?';
                            $aksiClass = $item->aktif
                                ? 'bg-red-50 hover:bg-red-100 text-red-700'
                                : 'bg-green-50 hover:bg-green-100 text-green-700';
                            $aksiTitle = $item->aktif ? 'Nonaktifkan' : 'Aktifkan';
                        @endphp

                        <tr class="hover:bg-blue-50/30 transition-colors">
                            {{-- NAMA + AVATAR --}}
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shrink-0 shadow-sm">
                                        <span class="text-white font-bold text-xs">
                                            {{ strtoupper(substr($item->name, 0, 1)) }}
                                        </span>
                                    </div>
                                    <p class="font-semibold text-gray-800 text-sm">{{ $item->name }}</p>
                                </div>
                            </td>

                            {{-- EMAIL --}}
                            <td class="px-5 py-3.5 text-gray-600 text-sm">
                                {{ $item->email }}
                            </td>

                            {{-- NIP --}}
                            <td class="px-5 py-3.5 text-gray-500 text-sm font-mono">
                                {{ $item->nip ?? '-' }}
                            </td>

                            {{-- ROLE --}}
                            <td class="px-5 py-3.5">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wide {{ $roleColor }}">
                                    {{ $item->role ?? 'user' }}
                                </span>
                            </td>

                            {{-- STATUS --}}
                            <td class="px-5 py-3.5 text-center">
                                @if ($item->aktif)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-green-100 text-green-700 ring-1 ring-green-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                        AKTIF
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-red-100 text-red-700 ring-1 ring-red-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                        NONAKTIF
                                    </span>
                                @endif
                            </td>

                            {{-- AKSI --}}
                            <td class="px-5 py-3.5">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.users.edit', $item->id) }}"
                                       class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-700 transition"
                                       title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>

                                    <form action="{{ route('admin.users.toggle-aktif', $item->id) }}" method="POST"
                                          class="inline"
                                          onsubmit="return confirm('{{ $aksiConfirm }}')">
                                        @csrf
                                        <button type="submit"
                                                class="inline-flex items-center justify-center w-8 h-8 rounded-lg transition {{ $aksiClass }}"
                                                title="{{ $aksiTitle }}">
                                            @if ($item->aktif)
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                                </svg>
                                            @else
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            @endif
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-16 text-center">
                                <div class="flex flex-col items-center gap-3 text-gray-400">
                                    <div class="w-16 h-16 rounded-2xl bg-blue-50 flex items-center justify-center">
                                        <svg class="w-8 h-8 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <p class="text-sm font-medium">Belum ada akun pengguna.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Mobile: card list --}}
        <div class="md:hidden divide-y divide-gray-100">
            @forelse ($users as $item)
                @php
                    $roleColor = match(strtolower($item->role ?? '')) {
                        'admin' => 'bg-purple-100 text-purple-700',
                        'petugas' => 'bg-blue-100 text-blue-700',
                        'masyarakat', 'user' => 'bg-gray-100 text-gray-700',
                        default => 'bg-gray-100 text-gray-600',
                    };
                    $aksiConfirm = $item->aktif ? 'Nonaktifkan akun ini?' : 'Aktifkan akun ini?';
                    $aksiClass = $item->aktif
                        ? 'bg-red-50 hover:bg-red-100 text-red-700'
                        : 'bg-green-50 hover:bg-green-100 text-green-700';
                    $aksiTitle = $item->aktif ? 'Nonaktifkan' : 'Aktifkan';
                @endphp

                <div class="p-3 sm:p-4 hover:bg-blue-50/30 transition-colors">
                    <div class="flex items-center gap-3">
                        {{-- KIRI: Info --}}
                        <div class="flex items-center gap-3 min-w-0 flex-1">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shrink-0 shadow-sm">
                                <span class="text-white font-bold text-sm">
                                    {{ strtoupper(substr($item->name, 0, 1)) }}
                                </span>
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="flex items-center gap-1.5 mb-0.5">
                                    <p class="font-bold text-gray-800 text-sm truncate">{{ $item->name }}</p>
                                    <span class="inline-flex items-center px-1.5 py-0.5 rounded-full text-[8px] font-bold uppercase tracking-wide {{ $roleColor }} shrink-0">
                                        {{ $item->role ?? 'user' }}
                                    </span>
                                </div>
                                <p class="text-[11px] text-gray-500 truncate">✉️ {{ $item->email }}</p>
                                <div class="flex items-center gap-2 mt-1">
                                    @if($item->nip)
                                    <span class="text-[10px] text-gray-400 font-mono">NIP: {{ $item->nip }}</span>
                                    @endif
                                    @if ($item->aktif)
                                        <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded-full text-[8px] font-bold bg-green-100 text-green-700">
                                            <span class="w-1 h-1 rounded-full bg-green-500"></span>
                                            AKTIF
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded-full text-[8px] font-bold bg-red-100 text-red-700">
                                            <span class="w-1 h-1 rounded-full bg-red-500"></span>
                                            NONAKTIF
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- KANAN: Tombol --}}
                        <div class="shrink-0 flex flex-col gap-1.5">
                            {{-- Edit --}}
                            <a href="{{ route('admin.users.edit', $item->id) }}"
                               class="inline-flex items-center justify-center gap-1 bg-blue-50 hover:bg-blue-100 text-blue-700 px-3 py-1.5 rounded-lg text-[10px] font-bold transition whitespace-nowrap"
                               title="Edit">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </a>

                            {{-- Toggle aktif --}}
                            <form action="{{ route('admin.users.toggle-aktif', $item->id) }}" method="POST"
                                  onsubmit="return confirm('{{ $aksiConfirm }}')">
                                @csrf
                                <button type="submit"
                                        class="w-full inline-flex items-center justify-center gap-1 px-3 py-1.5 rounded-lg text-[10px] font-bold transition whitespace-nowrap {{ $aksiClass }}"
                                        title="{{ $aksiTitle }}">
                                    @if ($item->aktif)
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                        </svg>
                                        Nonaktifkan
                                    @else
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Aktifkan
                                    @endif
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-6 text-center">
                    <div class="flex flex-col items-center gap-3 text-gray-400">
                        <div class="w-14 h-14 rounded-2xl bg-blue-50 flex items-center justify-center">
                            <svg class="w-7 h-7 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <p class="text-sm font-medium">Belum ada akun pengguna.</p>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- PAGINATION --}}
        @if ($users->hasPages())
            <div class="px-4 sm:px-5 py-3 sm:py-4 border-t border-gray-100 bg-gray-50/50">
                {{ $users->links() }}
            </div>
        @endif
    </div>

</div>
@endsection