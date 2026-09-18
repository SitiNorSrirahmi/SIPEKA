@php
    $role = auth()->check() ? auth()->user()->role : 'guest';
@endphp

@if ($role === 'admin')
    @include('wilayahrawan.admin')
@elseif ($role === 'petugas')
    @include('wilayahrawan.petugas')
@else
    @include('wilayahrawan.guest')
@endif