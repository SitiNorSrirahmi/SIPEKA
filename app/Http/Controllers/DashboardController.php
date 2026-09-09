<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data user yang sedang login
        $user = Auth::user();

        // Cek rolenya (pastikan nama 'role' sesuai dengan kolom di database kamu)
        if ($user->role === 'admin') {
            return view('admin.dashboard'); // Mengarah ke resources/views/admin/dashboard.blade.php
        } elseif ($user->role === 'petugas') {
            return view('petugas.dashboard'); // Mengarah ke resources/views/petugas/dashboard.blade.php
        }

        // Jaga-jaga jika role tidak ada
        Auth::logout();
        return redirect('/login');
    }
}