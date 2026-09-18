@php
    $role = auth()->check() ? auth()->user()->role : 'guest';
@endphp

@if ($role === 'admin')
    @include('statistik.admin')
@elseif ($role === 'petugas')
    @include('statistik.petugas')
@else
    @include('statistik.guest')
@endif