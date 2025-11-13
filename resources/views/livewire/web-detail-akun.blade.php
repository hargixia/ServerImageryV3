    @if (Auth::check() && Auth::user()->nama)
        @include('components.header')
    @endif
