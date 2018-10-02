@extends('layouts.management')

@section('menu')
    <div class="sub-navbar">
        <div class="container">
            @include('admin.menu')
        </div>
    </div>
@endsection

@section('content')

    @hasSection('buttons')
    <div class="text-right mb-3">
        @yield('buttons')
    </div>
    @endif

    @yield('body')
@endsection
