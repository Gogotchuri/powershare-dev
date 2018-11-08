@extends('layouts.app')

@section('html-body')
    <body>
    <div id="app" class="background-image front-page" style="background-image: url(/img/background-dotted.png)">
        <div class="wrapper-animation-one">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @include('public.partials.mobile-nav')
                        @include('public.partials.nav')
                        @include('public.partials.connect-menu')
                    </div>
                </div>
            </div>

            <div class="container-fluid inspiring-section inspiring-section-first">
                <div class="row">
                    <div class="col-md-5">
                        <a class="d-none d-sm-block" href="/">
                            <img src="/img/logo-gradient.png" alt="Powershare logo" class="logo">
                        </a>
                    </div>
                    <div class="col-md-7">
                        <div class="row">

                            <div class="col-sm-8 offset-sm-4 text-sm-right ">
                                <div class="d-none d-sm-block">
                                    @include('public.partials.auth-buttons')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="inspire">
                            <h1 class="inspire-first mb-5"><strong>Browser-Based Mining for Charity Crowdfunding </strong></h1>
                            <h3 class="inspire-second mb-4">We remove financial barriers<br/> to the spirit of giving</h3>
                            <div class="row">
                                <div class="col-12">
                                    <a class="powershare-button" href="{{ \App\Models\Campaign::createPath() }}">Register a Campaign</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrapper-animation-two">
            <div class="container-fluid inspiring-section inspiring-section-second">

                <div class="row">
                    <div class="col-sm-5 left-panel">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="/" class="d-block position-relative">
                                    <img src="/img/logo-front-orange.png" alt="Powershare logo" class="logo">
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-10 left-panel">
                                <div class="inspire">
                                    <h1 class="inspire-first mb-5"><strong>You have the power to...</strong></h1>
                                    <h3 class="inspire-second">... become a supporting hero simply by keeping the browser tab open and fuel these important
                                        causes:</h3>
                                    <select class="category-select">
                                        <option value="-1" selected>Find by Category</option>
                                        <option value="1">a1</option>
                                        <option value="2">a2</option>
                                        <option value="3">a3</option>
                                    </select>
                                    <input type="text" class="name-input" placeholder="Find by Campaign Name">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-7 right-panel">
                        <div class="campaigns-list-wrapper">
                            <div class="campaigns-list-wrapper-inner">
                                <div class="campaigns-list">
                                    <div class="infinite-scroll">
                                        <div class="row"></div>
                                        <div class="loader"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ mix('js/app.js') }}" defer></script>
    @yield('scripts')
    @stack('scripts-stack')
    </body>
@endsection

@push('scripts-stack')

@endpush
