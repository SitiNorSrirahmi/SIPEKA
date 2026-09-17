@extends('layouts.admin')

@section('header', 'Edit Akun Pengguna')

@section('content')
    <div class="p-6 max-w-xl mx-auto">
        <h1 class="text-xl font-bold mb-4">Edit Akun Pengguna</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Nama</label>
            <input type="text" name="name" class="border w-full mb-3 p-2" value="{{ $user->name }}">

            <label>Email</label>
            <input type="email" name="email" class="border w-full mb-3 p-2" value="{{ $user->email }}">

            <label>NIP (opsional)</label>
            <input type="text" name="nip" class="border w-full mb-3 p-2" value="{{ $user->nip }}">

            <label>Role</label>
            <select name="role" class="border w-full mb-3 p-2">
                <option value="petugas" @selected($user->role === 'petugas')>Petugas</option>
                <option value="admin" @selected($user->role === 'admin')>Admin</option>
            </select>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        </form>
    </div>
@endsection