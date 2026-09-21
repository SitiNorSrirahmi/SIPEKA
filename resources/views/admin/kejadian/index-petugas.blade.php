@extends('layouts.petugas')

@section('header', 'Peta & Kejadian Bencana')

@section('content')
<div class="max-w-6xl mx-auto">

    {{-- ==================== KONTEN (peta + filter + tabel) ==================== --}}
    @include('admin.kejadian.index-content')

</div>
@endsection