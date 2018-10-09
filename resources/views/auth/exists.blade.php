@extends('layouts.management')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Accept terms & conditions</div>

                <div class="card-body">
                        <div class="alert alert-success">
                            User with this email already exists. <a href="{{$continue}}">Continue</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
