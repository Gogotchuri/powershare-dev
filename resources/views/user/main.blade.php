@extends('layouts.management')

@section('menu')
    <div class="sub-navbar">
        <div class="container">
            @include('user.menu')
        </div>
    </div>
@endsection

@section('content')
    @yield('body')
@endsection
