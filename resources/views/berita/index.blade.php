@php
$role = auth()->check() ? auth()->user()->role : 'guest';
@endphp

@if ($role === 'admin')
@include('berita.index-admin')
@elseif ($role === 'petugas')
@include('berita.index-petugas')
@else
@include('berita.index-guest')
@endif