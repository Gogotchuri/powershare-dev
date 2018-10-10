@extends('layouts.management')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Accept terms & conditions</div>

                <div class="card-body">
                    @if (session()->has('should_agree'))
                        <div class="alert alert-danger">
                            You should accept accept <strong>Terms & Conditions</strong>, otherwise we cannot register you.
                        </div>
                    @endif
                    <form method="POST" action="{{-- TODO: Add social register action --}}">
                        @csrf

                        @include('auth.shared.terms')

                        <div class="alert alert-primary">
                            {{--Replace provider name with actual variable here--}}
                            You are about to create new account using <br/> <strong>Facebook (g.gatenashvili@gmail.com)</strong>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6 col-xs-offset-3">
                                <div class="checkbox">
                                    <label>
                                        <button class="btn btn-primary" type="submit" value="agree" >Continue</button>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
