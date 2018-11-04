@extends('layouts.app')

@section('html-body')
    <body>
    <div id="app">
        @include('partials.navbar')

        @yield('skeleton')
    </div>
    <script src="{{ mix('js/app.js') }}" defer></script>
    @yield('scripts')
    @stack('scripts-stack')
    </body>
@endsection
