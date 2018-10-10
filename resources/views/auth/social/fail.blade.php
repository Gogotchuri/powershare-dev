@extends('layouts.management')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Social sign-in failed</div>

                <div class="card-body">
                        <div class="alert alert-danger">
                            <strong>Social authentication failed  </strong>
                            <br/>
                            {{$message or ''}}
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
