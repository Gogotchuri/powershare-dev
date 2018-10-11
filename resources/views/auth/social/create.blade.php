@extends('layouts.management')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Social registration</div>

                <div class="card-body">

                    @php
                        $data = session('providerData');
                    @endphp
                    @if($data)
                        @if (session()->has('should_agree'))
                            <div class="alert alert-danger">
                                You should accept accept <strong>Terms & Conditions</strong>, otherwise we cannot register you.
                            </div>
                        @endif
                        <form method="POST" action="{{route('social.register')}}">
                            @csrf

                            @include('auth.shared.terms')

                            <div class="alert alert-primary">
                                {{--TODO: Replace provider name with actual variable here--}}
                                You are about to create new account using <br/> <strong>{{ucfirst($data['provider'])}} ({{$data['email']}})</strong>
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
                    @else
                        <div class="alert alert-danger">
                            Sorry something went wrong
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
