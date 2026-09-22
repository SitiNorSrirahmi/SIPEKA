@extends($layout)

@section('header', 'Profil')

@section('content')

<div class="min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">

        {{-- INFO --}}
        <div class="mb-6">
            <p class="text-sm text-slate-500">
                Kelola informasi akun dan kata sandi kamu di sini.
            </p>
        </div>

        {{-- FORM-FORM --}}
        <div class="space-y-6">

            {{-- UPDATE PROFIL --}}
            <div class="p-4 sm:p-6 lg:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- UPDATE PASSWORD --}}
            <div class="p-4 sm:p-6 lg:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

        </div>

    </div>
</div>

@endsection