@extends('layouts.management')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form id="registerForm" method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="main-inputs">
                                <div class="form-group row">

                                    <div class="col-md-8 offset-md-2">
                                        <input placeholder="{{ __('Name') }}" id="name" type="text"
                                               class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                               name="name" value="{{ old('name') }}" required >

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">

                                    <div class="col-md-8 offset-md-2">
                                        <input placeholder="{{ __('E-Mail Address') }}" id="email" type="email"
                                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                               name="email" value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">

                                    <div class="col-md-8 offset-md-2">
                                        <input placeholder="{{ __('Password') }}" id="password" type="password"
                                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                               name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">

                                    <div class="col-md-8 offset-md-2">
                                        <input placeholder="{{ __('Confirm Password') }}" id="password-confirm" type="password" class="form-control"
                                               name="password_confirmation" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-md-2 col-md-8">
                                        <div class="form-check">
                                            <input name="agree" class="form-check-input @if($errors->has('agree')) is-invalid @endif" type="checkbox" value="agree"
                                                   id="agree">
                                            <label class="form-check-label" for="agree">
                                                Agree to <a target="_blank" href="{{route('public.terms')}}">Terms and Conditions</a>
                                            </label>
                                            @if ($errors->has('agree'))
                                                <div class="invalid-feedback">
                                                    You should agree before submitting.
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-2">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Sign up
                                    </button>
                                </div>
                            </div>

                        </form>
                        <hr/>
                        <div class="form-group row text-center">

                            <div class="col-md-8 offset-md-2">
                                <a href="{{ url('/auth/facebook') }}" class="btn btn-primary btn-block">
                                    <i class="fab fa-facebook"></i> Sign up with <b>Facebook</b></a>
                                <a href="{{ url('/auth/google') }}" class="btn btn-danger btn-block">
                                    <i class="fab fa-google"></i> Sign up with <b>Google</b></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
