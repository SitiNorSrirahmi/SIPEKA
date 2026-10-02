@auth
    @if (auth()->user()->hasRole('admin'))
        @include('wilayahrawan.admin')
    @elseif (auth()->user()->hasRole('petugas'))
        @include('wilayahrawan.petugas')
    @else
        @include('wilayahrawan.guest')
    @endif
@else
    @include('wilayahrawan.guest')
@endauth