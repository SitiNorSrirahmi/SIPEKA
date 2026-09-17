@extends('layouts.admin')

@section('header', 'Tambah Akun Pengguna')

@section('content')
<div class="p-6 max-w-xl mx-auto">
    <h1 class="text-xl font-bold mb-4">Tambah Akun Pengguna</h1>

    @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <label>Nama</label>
        <input type="text" name="name" class="border w-full mb-3 p-2">

        <label>Email</label>
        <input type="email" name="email" class="border w-full mb-3 p-2">

        <label>NIP (opsional)</label>
        <input type="text" name="nip" class="border w-full mb-3 p-2">

        <label>Password</label>
        <input type="password" name="password" class="border w-full mb-3 p-2">

        <label>Konfirmasi Password</label>
        <input type="password" name="password_confirmation" class="border w-full mb-3 p-2">

        <label>Role</label>
        <select name="role" class="border w-full mb-3 p-2">
            <option value="petugas">Petugas</option>
            <option value="admin">Admin</option>
        </select>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection