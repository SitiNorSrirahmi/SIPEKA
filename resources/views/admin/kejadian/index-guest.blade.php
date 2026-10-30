@extends('layouts.publik')

@section('header', 'Peta & Kejadian Bencana')

@section('content')
<div class="bg-slate-50 min-h-screen w-full">

    {{-- Container ini WAJIB w-full biar pas di-zoom out melebar --}}
    <div class="w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Panggil dari folder admin, karena memang di situ letaknya --}}
        @include('admin.kejadian.index-content')

    </div>
</div>
@endsection