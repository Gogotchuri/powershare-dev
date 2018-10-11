@extends('layouts.management')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Social registration</div>

                <div class="card-body">
                    @include('auth.shared.terms')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
