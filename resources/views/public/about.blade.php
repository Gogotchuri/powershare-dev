@extends('layouts.app')

@section('html-body')
    <div id="app" class="background-image about-page static-page" style="background-image: url(/img/about_background.png);">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('public.partials.mobile-nav')
                    @include('public.partials.nav')
                    @include('public.partials.connect-menu')
                </div>
            </div>
        </div>
        <div class="container-fluid inspiring-section">
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
            <div class="row">
                <div class="col-sm-8 left-panel">
                    <div class="inspire">
                        <h1 class="main-heading">About</h1>
                        <h1 class="main-heading">Us</h1>
                        <div class="ps-card ps-card-video mb-5 mt-3">
                            <div class="youtube-video-aspect">
                                <div class="video-container">
                                    <div class="video-bg cover">
                                        <div class="video-fg">
                                            <iframe width="560" height="315" src="https://www.youtube.com/embed/k5vwG_BofJ0"
                                                    frameborder="0" allow="autoplay; encrypted-media"
                                                    allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p>
                            Our unequal world desperately needs changes, but the power to change is limited by
                            resources, reserved for the privileged few. We are here to level the playing field. We
                            believe that small, personal, local changes lead to bigger shifts in society. That’s why we
                            want to make sure every voice has a chance to be heard, every idea has enough fuel to get
                            off the ground.
                        </p>
                        <p>
                            To remove financial barriers to the spirit of giving, we created a platform where ordinary
                            people can raise money without actually paying money. POWERSHARE is where crowdfunding meets
                            browser-based mining for cryptocurrency - we call this concept Fundmining and it means that
                            simply by keeping a browser tab open, anyone can convert unused CPU power into a financial
                            resource to fund important causes and ideas presented on the platform.
                        </p>
                        <p>
                            This platform represents an Alpha version of the final product and utilizes CoinHive
                            scripts, to mine Monero (XMR), POWERSHARE is now on the mission to optimize existing
                            technologies for Fundmining and establish browser-based mining as basic technology for
                            charity crowdfunding.
                        </p>
                        <p class="mb-5">
                            * For more details, visit <a target="_blank" href="http://fire.powershare.fund">fire.powershare.fund</a>.
                        </p>
                        <div class="row about-links mb-5">
                            <div class="col-sm-6">
                                <a target="_blank" href="http://fire.powershare.fund/whitepaper">
                                    <img src="/img/whitepaper.png" alt="" class="mb-3">
                                    Whitepaper
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <a target="_blank" href="http://fire.powershare.fund/crypto-economics">
                                    <img src="/img/crypto-economic.png" alt="" class="mb-3">
                                    Crypto Economics
                                </a>
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
@endsection

@push('scripts-stack')

@endpush
