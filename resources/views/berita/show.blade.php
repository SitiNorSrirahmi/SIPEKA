@php
    $role = auth()->check() ? auth()->user()->role : 'guest';
@endphp

@if ($role === 'admin')
    @include('berita.show-admin')
@elseif ($role === 'petugas')
    @include('berita.show-petugas')
@else
    @include('berita.show-guest')
@endif