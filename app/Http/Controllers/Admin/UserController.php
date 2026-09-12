<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Admin: lihat semua akun (Admin & Petugas)
     */
    public function index()
    {
        $users = User::latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Form tambah akun baru
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Simpan akun baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'nip' => 'nullable|string|max:50|unique:users,nip',
            'password' => ['required', 'confirmed', Password::min(8)],
            'role' => 'required|in:admin,petugas',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'nip' => $validated['nip'] ?? null,
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'aktif' => true,
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Akun berhasil ditambahkan.');
    }

    /**
     * Form edit akun
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update akun (tanpa ubah password di sini, password diubah terpisah)
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'nip' => 'nullable|string|max:50|unique:users,nip,' . $user->id,
            'role' => 'required|in:admin,petugas',
        ]);

        $user->update($validated);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Akun berhasil diperbarui.');
    }

    /**
     * Nonaktifkan / aktifkan akun (bukan hapus permanen)
     */
    public function toggleAktif(User $user)
    {
        $user->update(['aktif' => !$user->aktif]);

        $pesan = $user->aktif ? 'Akun berhasil diaktifkan.' : 'Akun berhasil dinonaktifkan.';

        return redirect()
            ->route('admin.users.index')
            ->with('success', $pesan);
    }
}