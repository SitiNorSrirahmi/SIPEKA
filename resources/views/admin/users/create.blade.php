@extends('layouts.admin')

@section('header', 'Tambah Akun Pengguna')

@section('content')
<div class="max-w-6xl mx-auto px-2">

    {{-- ==================== BACK ==================== --}}
    <a href="{{ url()->previous() }}"
        class="inline-flex items-center gap-1.5 text-sm font-medium text-blue-600 hover:text-blue-700 transition-colors mb-4">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali
    </a>

    {{-- ==================== HEADER ==================== --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900 tracking-tight leading-tight mb-1.5">
            Tambah Akun Pengguna
        </h1>
        <p class="text-sm text-slate-500">
            Buat akun baru untuk admin atau petugas SIPEKA
        </p>
    </div>

    {{-- ==================== ERROR ==================== --}}
    @if ($errors->any())
    <div class="flex items-start gap-3 bg-rose-50 border border-rose-200 text-rose-700 p-4 mb-6 rounded-2xl">
        <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <div>
            <p class="text-sm font-semibold mb-1">Ada beberapa kesalahan:</p>
            <ul class="list-disc list-inside text-sm space-y-0.5">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    {{-- ==================== FORM WRAPPER ==================== --}}
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- ============ LEFT: FORM ============ --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- CARD: DATA AKUN --}}
                <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-7">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-sm font-semibold text-slate-900">Data Akun</h2>
                            <p class="text-xs text-slate-400">Informasi dasar pengguna</p>
                        </div>
                    </div>

                    <div class="space-y-5">
                        {{-- Nama --}}
                        <div>
                            <label class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-2">
                                Nama Lengkap <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                placeholder="Masukkan nama lengkap"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-sm text-slate-900 placeholder:text-slate-400">
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-2">
                                Email <span class="text-rose-500">*</span>
                            </label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                placeholder="nama@sipeka.test"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-sm text-slate-900 placeholder:text-slate-400">
                        </div>

                        {{-- Grid 2 kolom: NIP + Role --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-2">
                                    NIP <span class="text-slate-400 normal-case tracking-normal font-normal">(opsional)</span>
                                </label>
                                <input type="text" name="nip" value="{{ old('nip') }}"
                                    placeholder="Nomor Induk Pegawai"
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-sm font-mono text-slate-900 placeholder:text-slate-400">
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-2">
                                    Role <span class="text-rose-500">*</span>
                                </label>
                                <select name="role"
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-sm text-slate-900">
                                    <option value="petugas" @selected(old('role')==='petugas' )>Petugas</option>
                                    <option value="admin" @selected(old('role')==='admin' )>Admin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- CARD: KEAMANAN --}}
                <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-7">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-full bg-emerald-50 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-sm font-semibold text-slate-900">Keamanan</h2>
                            <p class="text-xs text-slate-400">Atur kata sandi akun</p>
                        </div>
                    </div>

                    <div class="space-y-5">
                        {{-- Password --}}
                        <div>
                            <label class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-2">
                                Password <span class="text-rose-500">*</span>
                            </label>
                            <input type="password" name="password"
                                placeholder="Minimal 8 karakter"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-sm text-slate-900 placeholder:text-slate-400">
                        </div>

                        {{-- Konfirmasi Password --}}
                        <div>
                            <label class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-2">
                                Konfirmasi Password <span class="text-rose-500">*</span>
                            </label>
                            <input type="password" name="password_confirmation"
                                placeholder="Ulangi password"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-sm text-slate-900 placeholder:text-slate-400">
                        </div>
                    </div>
                </div>

            </div>

            {{-- ============ RIGHT: SIDEBAR ============ --}}
            <div class="lg:col-span-1">
                <div class="lg:sticky lg:top-6 space-y-6">

                    {{-- CARD: RINGKASAN --}}
                    <div class="bg-white rounded-2xl border border-slate-200 p-6">
                        <h3 class="text-xs font-semibold text-slate-900 uppercase tracking-wider mb-4">
                            Ringkasan
                        </h3>
                        <div class="space-y-3 text-sm">
                            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                                <span class="text-slate-400">Tipe Akun</span>
                                <span class="font-medium text-slate-900">Pengguna Baru</span>
                            </div>
                            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                                <span class="text-slate-400">Role Default</span>
                                <span class="font-medium text-slate-900">Petugas</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-slate-400">Status</span>
                                <span class="inline-flex items-center gap-1.5 text-emerald-600 font-medium">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Aktif
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- CARD: INFO --}}
                    <div class="bg-slate-50/70 rounded-2xl border border-slate-100 p-6">
                        <div class="flex items-start gap-3 mb-3">
                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-xs font-semibold text-slate-900 mb-1">Informasi</h4>
                                <p class="text-xs text-slate-500 leading-relaxed">
                                    Akun yang dibuat akan langsung aktif. Pastikan email unik dan password kuat minimal 8 karakter.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- CARD: AKSI --}}
                    <div class="bg-white rounded-2xl border border-slate-200 p-6">
                        <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl text-sm font-semibold transition-colors mb-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                            </svg>
                            Simpan Akun
                        </button>
                        <a href="{{ route('admin.users.index') }}"
                            class="w-full inline-flex items-center justify-center px-6 py-3 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100 transition-colors">
                            Batal
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>
@endsection