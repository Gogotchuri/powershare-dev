@extends('layouts.app')

<body>
<div id="app" class="background-image front-page">
    <div class="container">
        <div class="row">
            <div class="col-sm-5 left-panel">
                <img src="/img/logo-front.png" alt="Powershare logo" class="logo">
                <div class="side-menu">
                    <a href="#">About us</a>
                    <a href="#">Register Campaign</a>
                    <a href="#">FAQ</a>
                </div>
                <div class="inspire">
                    <h1>You have the power to...</h1>
                    <h2>... become a supporting hero simply by keeping the browser tab open and fuel these important causes:</h2>
                </div>

            </div>
            <div class="col-sm-7 right-panel">
                <div class="row">
                    <div class="col-sm-4">
                        <input id="search" type="text" placeholder="Search Campaign">
                    </div>
                    <div class="col-sm-4">
                        <select id="category">
                            <option selected="true" value="0">Filter by Category</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <div class="authentication-buttons">
                            <a class="login" href="/login">Login</a><a class="register" href="/register">Register</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-columns">
                            @foreach($campaigns as $campaign)
                                <div class="card">
                                    <div class="card-header">
                                        <a href="{{ route('public.campaign.show', ['id' => $campaign->id]) }}">{{$campaign->name}}</a>
                                        <br/>
                                        <br/>
                                        <img class="img-fluid" src="{{$campaign->featured_image_url}}">
                                    </div>
                                    <div class="card-body">
                                        {{-- FIXME: This width function can break html comming from WYSIWYG --}}
                                        <p>{!! mb_strimwidth($campaign->details, 0, 100, "...") !!}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <form class="form-inline">
            <div class="form-group mb-2">
                <label for="staticEmail2" class="sr-only">Email</label>
                <input class="form-control" type="text" placeholder="Search" id="staticEmail2">
            </div>
        </form>
    </div>
    <div class="container">
        <hr>

    </div>
</div>
<script src="{{ mix('js/app.js') }}" defer></script>
@yield('scripts')
@stack('scripts-stack')
</body>

@push('scripts-stack')

@endpush
