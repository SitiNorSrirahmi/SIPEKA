<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Selamat datang Petugas!") }}
                </div>
            </div>

            <div class="mt-4 flex gap-3">
                <a href="{{ route('petugas.laporan.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded text-sm">
                    Buat Laporan
                </a>
                <a href="{{ route('petugas.laporan-saya') }}" class="bg-gray-200 text-gray-800 px-4 py-2 rounded text-sm">
                    Laporan Saya
                </a>
                <a href="{{ route('berita.index') }}" class="bg-gray-200 text-gray-800 px-4 py-2 rounded text-sm">
                    Lihat Berita
                </a>
            </div>
        </div>
    </div>
</x-app-layout>