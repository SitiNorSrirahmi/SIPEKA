@extends('layouts.petugas')

@section('header', 'Peta & Kejadian Bencana')

@section('content')
<div class="w-full mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">

    {{-- Panggil dari folder admin --}}
    @include('admin.kejadian.index-content')

</div>
@endsection