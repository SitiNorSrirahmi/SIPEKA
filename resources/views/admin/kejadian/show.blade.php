@php
    $role = auth()->check() ? auth()->user()->role : 'guest';
@endphp

@if ($role === 'admin')
    @include('admin.kejadian.show-admin')
@elseif ($role === 'petugas')
    @include('admin.kejadian.show-petugas')
@else
    @include('admin.kejadian.show-guest')
@endif