@extends('layouts.admin')

@section('header', 'Kelola Akun Pengguna')

@section('content')
    <div class="p-6 max-w-4xl mx-auto">

        <div class="flex justify-between items-center mb-4">
            <h1 class="text-xl font-bold">Kelola Akun Pengguna</h1>
            <a href="{{ route('admin.users.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded text-sm">
                + Tambah Akun
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full border-collapse border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2">Nama</th>
                    <th class="border p-2">Email</th>
                    <th class="border p-2">NIP</th>
                    <th class="border p-2">Role</th>
                    <th class="border p-2">Status</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $item)
                    <tr>
                        <td class="border p-2">{{ $item->name }}</td>
                        <td class="border p-2">{{ $item->email }}</td>
                        <td class="border p-2">{{ $item->nip ?? '-' }}</td>
                        <td class="border p-2">{{ ucfirst($item->role) }}</td>
                        <td class="border p-2">
                            <span class="{{ $item->aktif ? 'text-green-600' : 'text-red-600' }}">
                                {{ $item->aktif ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="border p-2">
                            <a href="{{ route('admin.users.edit', $item->id) }}" class="text-blue-600 text-sm">Edit</a>
                            |
                            <form action="{{ route('admin.users.toggle-aktif', $item->id) }}" method="POST" class="inline">
                                @csrf
                                <button class="text-sm {{ $item->aktif ? 'text-red-600' : 'text-green-600' }}">
                                    {{ $item->aktif ? 'Nonaktifkan' : 'Aktifkan' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="border p-2 text-center">Belum ada akun.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $users->links() }}
    </div>
@endsection