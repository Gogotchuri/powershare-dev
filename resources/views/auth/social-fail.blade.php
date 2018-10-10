@extends('layouts.management')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Social sign-in failed</div>

                <div class="card-body">
                        <div class="alert alert-danger">
                            <strong>We were unable to sign you in</strong> <br/> If it wasn't your decision, please contact us, use
                            contact information available on our website.
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
