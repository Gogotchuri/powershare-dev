@extends('layouts.app')

@section('skeleton')
    <main class="py-4">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    @yield('header')
                </div>

                <div class="card-body">
                    @yield('content')
                </div>
            </div>
        </div>
    </main>
@endsection
