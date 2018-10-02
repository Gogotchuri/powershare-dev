@extends('layouts.app')

@section('skeleton')
    @yield('menu')
    <main class="py-4 secondary-light-bg">
        <div class="container">
            <div class="card mb-3">
                <div class="card-header">
                    @yield('header')
                </div>

                <div class="card-body">
                    @yield('content')
                </div>
            </div>
            @yield('other')
        </div>
    </main>
@endsection
