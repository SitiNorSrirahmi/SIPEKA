@extends('layouts.admin')

@section('header', 'Edit Akun Pengguna')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6 lg:py-8">

    {{-- ==================== BACK ==================== --}}
    <a href="{{ url()->previous() }}"
       class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-medium text-blue-600 hover:text-blue-700 transition-colors mb-3 sm:mb-4">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali
    </a>

    @php
        $roleLabel = $user->role === 'admin' ? 'Admin' : 'Petugas';
        $roleStyle = $user->role === 'admin'
            ? 'bg-purple-50 text-purple-700 border-purple-200'
            : 'bg-blue-50 text-blue-700 border-blue-200';
        $roleDot = $user->role === 'admin' ? 'bg-purple-500' : 'bg-blue-500';
    @endphp

    {{-- ==================== HEADER — SEJAJAR ==================== --}}
    <div class="flex items-center justify-between gap-3 mb-4 sm:mb-6">
        <div class="flex items-center gap-3 min-w-0">
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-blue-100 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </div>
            <div class="min-w-0">
                <h1 class="text-base sm:text-xl lg:text-2xl font-bold text-slate-900 truncate">
                    Edit Akun Pengguna
                </h1>
                <p class="text-[11px] sm:text-sm text-slate-500 truncate">
                    Perbarui informasi akun <span class="font-medium text-slate-700">{{ $user->name }}</span>
                </p>
            </div>
        </div>

        {{-- Badge Role --}}
        <span class="inline-flex items-center gap-1.5 px-3 sm:px-4 py-1.5 sm:py-2 rounded-full border text-[11px] sm:text-sm font-semibold {{ $roleStyle }} shrink-0">
            <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full {{ $roleDot }}"></span>
            {{ $roleLabel }}
        </span>
    </div>

    {{-- ==================== ERROR ==================== --}}
    @if ($errors->any())
    <div class="flex items-start gap-3 bg-rose-50 border border-rose-200 text-rose-700 p-3 sm:p-4 mb-4 sm:mb-6 rounded-2xl">
        <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <div>
            <p class="text-sm font-semibold mb-1">Ada beberapa kesalahan:</p>
            <ul class="list-disc list-inside text-xs sm:text-sm space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    {{-- ==================== FORM ==================== --}}
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">

            {{-- ============ LEFT: FORM ============ --}}
            <div class="lg:col-span-2 space-y-4 sm:space-y-6">

                {{-- CARD: DATA AKUN --}}
                <div class="bg-white rounded-2xl border border-slate-200 p-4 sm:p-6 lg:p-7">
                    <div class="flex items-center gap-3 mb-4 sm:mb-6">
                        <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-blue-50 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-sm font-semibold text-slate-900">Data Akun</h2>
                            <p class="text-[11px] sm:text-xs text-slate-400">Informasi dasar pengguna</p>
                        </div>
                    </div>

                    <div class="space-y-4 sm:space-y-5">
                        {{-- Nama --}}
                        <div>
                            <label class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-2">
                                Nama Lengkap <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                   placeholder="Masukkan nama lengkap"
                                   class="w-full px-3 sm:px-4 py-2.5 sm:py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-sm text-slate-900 placeholder:text-slate-400">
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-2">
                                Email <span class="text-rose-500">*</span>
                            </label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                   placeholder="nama@sipeka.test"
                                   class="w-full px-3 sm:px-4 py-2.5 sm:py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-sm text-slate-900 placeholder:text-slate-400">
                        </div>

                        {{-- Grid 2 kolom: NIP + Role --}}
                        <div class="grid grid-cols-2 gap-3 sm:gap-5">
                            <div>
                                <label class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-2">
                                    NIP <span class="text-slate-400 normal-case tracking-normal font-normal hidden sm:inline">(opsional)</span>
                                </label>
                                <input type="text" name="nip" value="{{ old('nip', $user->nip) }}"
                                       placeholder="Nomor Induk"
                                       class="w-full px-3 sm:px-4 py-2.5 sm:py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-xs sm:text-sm font-mono text-slate-900 placeholder:text-slate-400">
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-2">
                                    Role <span class="text-rose-500">*</span>
                                </label>
                                <select name="role"
                                        class="w-full px-3 sm:px-4 py-2.5 sm:py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-sm text-slate-900">
                                    <option value="petugas" @selected(old('role', $user->role) === 'petugas')>Petugas</option>
                                    <option value="admin" @selected(old('role', $user->role) === 'admin')>Admin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- CARD: KEAMANAN --}}
                <div class="bg-white rounded-2xl border border-slate-200 p-4 sm:p-6 lg:p-7">
                    <div class="flex items-center gap-3 mb-4 sm:mb-6">
                        <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-emerald-50 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-sm font-semibold text-slate-900">Ubah Password</h2>
                            <p class="text-[11px] sm:text-xs text-slate-400">Kosongkan jika tidak ingin mengubah</p>
                        </div>
                    </div>

                    <div class="space-y-4 sm:space-y-5">
                        {{-- Password --}}
                        <div>
                            <label class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-2">
                                Password Baru <span class="text-slate-400 normal-case tracking-normal font-normal hidden sm:inline">(opsional)</span>
                            </label>
                            <input type="password" name="password"
                                   placeholder="Minimal 8 karakter"
                                   class="w-full px-3 sm:px-4 py-2.5 sm:py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-sm text-slate-900 placeholder:text-slate-400">
                        </div>

                        {{-- Konfirmasi Password --}}
                        <div>
                            <label class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-2">
                                Konfirmasi Password
                            </label>
                            <input type="password" name="password_confirmation"
                                   placeholder="Ulangi password baru"
                                   class="w-full px-3 sm:px-4 py-2.5 sm:py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-sm text-slate-900 placeholder:text-slate-400">
                        </div>
                    </div>
                </div>

            </div>

            {{-- ============ RIGHT: SIDEBAR ============ --}}
            <div class="lg:col-span-1">
                <div class="lg:sticky lg:top-6 space-y-4 sm:space-y-6">

                    {{-- CARD: PREVIEW USER --}}
                    <div class="bg-white rounded-2xl border border-slate-200 p-4 sm:p-6">
                        <div class="flex flex-col items-center text-center">
                            <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-slate-100 flex items-center justify-center mb-3">
                                <span class="text-lg sm:text-xl font-semibold text-slate-600">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </span>
                            </div>
                            <p class="text-sm font-semibold text-slate-900 truncate max-w-full">{{ $user->name }}</p>
                            <p class="text-xs text-slate-500 truncate max-w-full mb-3">{{ $user->email }}</p>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full border text-xs font-medium {{ $roleStyle }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $roleDot }}"></span>
                                {{ $roleLabel }}
                            </span>
                        </div>
                    </div>

                    {{-- CARD: INFO --}}
                    <div class="bg-slate-50/70 rounded-2xl border border-slate-100 p-4 sm:p-6">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M12 9v2m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-xs font-semibold text-slate-900 mb-1">Perhatian</h4>
                                <p class="text-xs text-slate-500 leading-relaxed">
                                    Perubahan role akan langsung memengaruhi hak akses pengguna. Pastikan sudah sesuai.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- CARD: AKSI --}}
                    <div class="bg-white rounded-2xl border border-slate-200 p-4 sm:p-6">
                        <button type="submit"
                                class="w-full inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 sm:px-6 py-2.5 sm:py-3 rounded-xl text-sm font-semibold transition-colors mb-2 sm:mb-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                            </svg>
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.users.index') }}"
                           class="w-full inline-flex items-center justify-center px-4 sm:px-6 py-2.5 sm:py-3 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100 transition-colors">
                            Batal
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>
@endsection