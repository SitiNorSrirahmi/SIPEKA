@auth
    @if (auth()->user()->hasRole('admin'))
        @include('laporan.create-admin')
    @elseif (auth()->user()->hasRole('petugas'))
        @include('laporan.create-petugas')
    @else
        @include('laporan.create-guest')
    @endif
@else
    @include('laporan.create-guest')
@endauth