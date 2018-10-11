@extends('layouts.app')

@section('html-body')
    <body>
    <div id="app" class="background-image front-page" style="background-image: url(/img/background.png);">
        <div class="container-fluid inspiring-section inspiring-section-first">
            @include('public.partials.nav')
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
                        <h1 class="inspire-first"><strong>Browser-Based Mining for Charity Crowdfunding </strong></h1>
                        <h3 class="inspire-second">We remove financial barrier to the spirit of giving</h3>
                    </div>
                </div>

            </div>
        </div>

        <div class="container-fluid inspiring-section inspiring-section-second">

            <div class="row">
                <div class="col-sm-5 left-panel">
                    <a href="/">
                        <img src="/img/logo-front.png" alt="Powershare logo" class="logo">
                    </a>
                    <div class="inspire">
                        <h1 class="inspire-first"><strong>You have the power to...</strong></h1>
                        <h3 class="inspire-second">... become a supporting hero simply by keeping the browser tab open and fuel these important
                            causes:</h3>
                    </div>

                </div>
                <div class="col-sm-7 right-panel">
                    <div class="row campaigns-list">
                        @foreach($campaigns as $campaign)
                            <div class="col-xl-3 col-sm-6">
                                <a href="{{ route('public.campaign.show', ['id' => $campaign->id]) }}" class="ps-card">
                                    <div class="ps-card-image-container">
                                        <div class="ps-card-image" style="background-image: url({{ $campaign->featured_image_url }});">
                                        <span class="ps-card-icon">
                                            <img class="" src="img/icons/icon_1.png">
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
    <script src="{{ mix('js/app.js') }}" defer></script>
    @yield('scripts')
    @stack('scripts-stack')
    </body>
@endsection

@push('scripts-stack')

@endpush
