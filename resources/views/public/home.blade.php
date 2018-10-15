@extends('layouts.app')

@section('html-body')
    <body>
    <div id="app" class="background-image front-page" style="background-image: url(/img/background-dotted.png)">
        <div class="wrapper-animation-one">
            <ul class="side-connect-menu">
                <li><a href="https://twitter.com/pwrshr"><i class="fab fa-twitter"></i></a></li>
                <li><a href="https://web.telegram.org/#/im?p=@powershare"><i class="fab fa-telegram-plane"></i></a></li>
                <li><a href="https://facebook.com/POWERSHARE.FUND"><i class="fab fa-facebook-f"></i></a></li>
            </ul>
            @include('public.partials.nav')
            <div class="container-fluid inspiring-section inspiring-section-first">
                <div class="row">
                    <div class="col-md-5">
                        <a href="/">
                            <img src="/img/logo-front.png" alt="Powershare logo" class="logo">
                        </a>
                    </div>
                    <div class="col-md-7">
                        <div class="row">

                            <div class="col-sm-6 offset-sm-6 text-right">
                                @include('public.partials.auth-buttons')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="inspire">
                            <h1 class="inspire-first mb-5"><strong>Browser-Based Mining for Charity Crowdfunding </strong></h1>
                            <h3 class="inspire-second">We remove financial barriers<br/> to the spirit of giving</h3>
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
                                <a href="/">
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-7 right-panel">
                        <div class="row campaigns-list">
                            @foreach($campaigns as $campaign)
                                <div class="col-xl-3 col-sm-6">
                                    <a href="{{ route('public.campaign.show', ['id' => $campaign->id]) }}" class="ps-card">
                                        <div class="ps-card-image-container fade">
                                            <div class="ps-card-image" style="background-image: url({{ $campaign->featured_image_url }});">
                                        <span class="ps-card-icon">
                                            <img style="@if(!$campaign->category_icon) display: none; @endif" class="" src="data:image/png;base64,{{base64_encode($campaign->category_icon)}}">
                                        </span>
                                            </div>
                                        </div>

                                        <div class="ps-card-description">
                                            <h4>
                                                {{ str_limit($campaign->name, 15) }}
                                            </h4>
                                            <p class="ps-card-excerpt">
                                                {{ $campaign->excerpt }}
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
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
