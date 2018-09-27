@extends('layouts.management')

@section('content')
    <div class="row justify-content-center">
        @include('admin.menu')
        <div class="col-md-9">
            @hasSection('buttons')
            <div class="text-right mb-3">
                @yield('buttons')
            </div>
            @endif

            <div class="card">
                <div class="card-body">
                    @yield('body')
                </div>
            </div>
        </div>
    </div>
@endsection
