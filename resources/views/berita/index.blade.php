@auth
    @if (auth()->user()->hasRole('admin'))
        @include('berita.index-admin')
    @elseif (auth()->user()->hasRole('petugas'))
        @include('berita.index-petugas')
    @else
        @include('berita.index-guest')
    @endif
@else
    @include('berita.index-guest')
@endauth