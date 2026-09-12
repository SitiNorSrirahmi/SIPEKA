@extends('layouts.admin')

@section('header', 'Dashboard')

@section('content')
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Selamat datang Admin!") }}
                </div>
            </div>
        </div>
    </div>
@endsection