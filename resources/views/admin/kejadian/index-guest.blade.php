@extends('layouts.publik')

@section('header', 'Peta & Kejadian Bencana')

@section('content')
<div class="bg-[#ffff] min-h-screen">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 py-8">

        {{-- ==================== KONTEN (peta + filter + tabel) ==================== --}}
        @include('admin.kejadian.index-content')

    </div>
</div>
@endsection