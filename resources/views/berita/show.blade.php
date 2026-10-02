@auth
    @if (auth()->user()->hasRole('admin'))
        @include('berita.show-admin')
    @elseif (auth()->user()->hasRole('petugas'))
        @include('berita.show-petugas')
    @else
        @include('berita.show-guest')
    @endif
@else
    @include('berita.show-guest')
@endauth