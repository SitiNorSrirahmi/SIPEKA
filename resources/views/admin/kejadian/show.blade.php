@auth
    @if (auth()->user()->hasRole('admin'))
        @include('admin.kejadian.show-admin')
    @elseif (auth()->user()->hasRole('petugas'))
        @include('admin.kejadian.show-petugas')
    @else
        @include('admin.kejadian.show-guest')
    @endif
@else
    @include('admin.kejadian.show-guest')
@endauth