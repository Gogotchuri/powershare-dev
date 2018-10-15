@extends('layouts.admin')

@section('skeleton')
    @yield('menu')
    <main class="py-4 secondary-light-bg">
        <div class="container">
            @if(session()->has('message'))
                <div class="alert alert-primary mb-3" role="alert">
                    {{session('message')}}
                </div>
            @endif
            <div class="card mb-3">
                <div class="card-header">
                    <div class="d-flex">
                        <div class="mr-auto">
                            @yield('header')
                        </div>
                            @hasSection('buttons')
                                @yield('buttons')
                            @endif

                    </div>
                </div>
                <div class="card-body">
                    @yield('content')
                </div>
            </div>
            @yield('other')
        </div>
    </main>
@endsection
