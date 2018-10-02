@extends('layouts.app')

@section('skeleton')
    @yield('menu')
    <main class="py-4 secondary-light-bg">
        <div class="container">
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
