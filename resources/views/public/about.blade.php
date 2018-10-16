@extends('layouts.app')

@section('html-body')
    <body>
    <div id="app" class="background-image campaign-page" style="background-image: url(/img/background-campaign.png);">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('public.partials.mobile-nav')
                    @include('public.partials.nav')
                    <ul class="side-connect-menu">
                        @include('public.partials.social')
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-8 left-panel">
                    <a class="d-none d-sm-block" href="/">
                        <img src="/img/logo-gradient.png" alt="Powershare logo" class="logo">
                    </a>
                    @include('public.partials.nav')
                    <div class="inspire">
                        <div class="ps-card">
                            <h1>About Us</h1>
                            <div class="videoWrapper mb-5">
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/k5vwG_BofJ0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            </div>
                            <p>
                                Our unequal world desperately needs changes, but the power to change is limited by resources, reserved for the privileged few. We are here to level the playing field. We believe that small, personal, local changes lead to bigger shifts in society. That’s why we want to make sure every voice has a chance to be heard, every idea has enough fuel to get off the ground.
                            </p>
                            <p>
                                To remove financial barriers to the spirit of giving, we created a platform where ordinary people can raise money without actually paying money. POWERSHARE is where crowdfunding meets browser-based mining for cryptocurrency - we call this concept Fundmining and it means that simply by keeping a browser tab open, anyone can convert unused CPU power into a financial resource to fund important causes and ideas presented on the platform.
                            </p>
                            <p>
                                This platform represents an Alpha version of the final product and utilizes CoinHive scripts, to mine Monero (XMR), POWERSHARE is now on the mission to optimize existing technologies for Fundmining and establish browser-based mining as basic technology for charity crowdfunding.
                            </p>
                            <p class="mb-5">
                                * For more details, visit <a href="http://fire.powershare.fund">fire.powershare.fund</a>.
                            </p>
                            <div class="row about-links">
                                <div class="col-sm-6">
                                    <a href="http://fire.powershare.fund/whitepaper">
                                        <img src="/img/whitepaper.png" alt="" class="mb-3">
                                        Whitepaper
                                    </a>
                                </div>
                                <div class="col-sm-6">
                                    <a href="http://fire.powershare.fund/crypto-economics">
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
    </div>

    <script src="{{ mix('js/app.js') }}" defer></script>
    @yield('scripts')

    @stack('scripts-stack')
    </body>
@endsection

@push('scripts-stack')

@endpush
