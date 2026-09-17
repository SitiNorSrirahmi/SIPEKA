@php
    $role = auth()->check() ? auth()->user()->role : 'guest';
@endphp

@if ($role === 'admin')
    @include('laporan.create-admin')
@elseif ($role === 'petugas')
    @include('laporan.create-petugas')
@else
    @include('laporan.create-guest')
@endif