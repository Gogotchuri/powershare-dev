@extends('layouts.app')

<body>
<div id="app" class="background-image front-page" style="background-image: url(/img/background.png);">
    <div class="container-fluid">
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
                    <div class="col-sm-3">
                        <input id="search" type="text" placeholder="Search Campaign">
                    </div>
                    <div class="col-sm-3">
                        <select id="category">
                            <option selected="true" value="0">Filter by Category</option>
                        </select>
                    </div>
                    <div class="col-sm-6 text-right">
                        @include('partials.auth-buttons')
                    </div>
                </div>
                <div class="row campaigns-list">
                    @foreach($campaigns as $campaign)
                    <div class="col-xl-4 col-sm-6">
                        <a href="{{ route('public.campaign.show', ['id' => $campaign->id]) }}" class="ps-card">
                            <div class="ps-card-image" style="background-image: url({{ $campaign->featured_image_url }});">

                            </div>
                            <div class="ps-card-description">
                                <h4>
                                    {{ $campaign->name }}
                                </h4>
                                <p>
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

@push('scripts-stack')

@endpush
