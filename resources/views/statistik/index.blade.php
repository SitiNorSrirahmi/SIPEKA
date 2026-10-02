@auth
    @if (auth()->user()->hasRole('admin'))
        @include('statistik.admin')
    @elseif (auth()->user()->hasRole('petugas'))
        @include('statistik.petugas')
    @else
        @include('statistik.guest')
    @endif
@else
    @include('statistik.guest')
@endauth