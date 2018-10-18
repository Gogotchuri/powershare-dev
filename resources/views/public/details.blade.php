@extends('layouts.app')

@section('html-body')
    <body>
    <div id="app" class="background-image campaign-page" style="background-image: url(/img/background-campaign.png);">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('public.partials.mobile-nav')
                    @include('public.partials.nav')
                    @include('public.partials.connect-menu')
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 left-panel">

                    {{--Inspire row--}}
                    <div class="row mb-5">
                        <div class="col-md-8">
                            <a class="d-none d-sm-block" href="/">
                                <img src="/img/logo-gradient.png" alt="Powershare logo" class="logo">
                            </a>
                            @include('public.partials.nav')
                            <div class="inspire">

                                <div class="ps-card ps-card-main">
                                    <div class="row mb-3">
                                        <div class="mb-sm-4 mb-xl-0 col-sm-8 offset-sm-2 offset-xl-0 col-xl-4">
                                            <div class="ps-card-image-container fade">
                                                <div class="ps-card-image" style="background-image: url({{ $campaign->featured_image_url }});">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-8">
                                            <div class="row mt-xl-5 pt-4">
                                                <div class="col-md-12">
                                                    <h1>{{ $campaign->name }}</h1>
                                                    <h2>Important for: {{$campaign->target_audience}}</h2>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="campaign-mark">
                                                        <div class="campaign-mark-img">
                                                            <img src="data:image/png;base64,{{base64_encode(optional($campaign->category)->icon)}}">
                                                        </div>
                                                        <div class="campaign-mark-title">
                                                            <span>Category</span>
                                                            <span>{{optional($campaign->category)->name}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="campaign-mark">
                                                        <div class="campaign-mark-img">
                                                            <img src="data:image/png;base64,{{base64_encode(optional($campaign->category)->icon)}}">
                                                        </div>
                                                        <div class="campaign-mark-title">
                                                            <span>Category</span>
                                                            <span>{{optional($campaign->category)->name}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-7">
                                            <div class="campaign-details-area pb-5 pb-md-2">
                                                <div class="vp-table">
                                                    <div class="vp-table-row">
                                                        <div class="vp-table-cell vp-align-top">
                                                            <p class="campaign-details mb-5">{{ $campaign->details }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="vp-table-row">
                                                        <div class="vp-table-cell vp-align-bottom">
                                                            <div class="fund-raising">
                                                                <div class="row">
                                                                    <div class="col-md-6 col-lg-7">
                                                                        <div class="fund-raising-raised">
                                                                            <div class="fund-raising-bordered-object">
                                                                                <div class="current-funding">855,65 $</div>
                                                                                <img class="fire-img" src="/img/icons/fire.png" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-lg-5">
                                                        <span class="required-funding">
                                                            <h6>Required funding</h6>
                                                            <h6>1,500 $</h6>
                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-5">
                                            <div class="ps-card">
                                                <div class="row mb-sm-5 mb-md-5">
                                                    <div class="col-md-12">
                                                        <div class="coinhive-miner mb-3"
                                                             style="width: 100%; height: 250px"
                                                             data-key="pzZHmhyywPSQ7Q2ydEFGFK01kXVKiS0x"
                                                             data-user="{{ Auth::user()
                                      ? $campaign->id . '-' . Auth::id()
                                      : $campaign->id . '-' . 0 }}"
                                                             data-autostart="true"
                                                             data-whitelabel="false"
                                                             data-background="#ffffff"
                                                             data-text="#888888"
                                                             data-action="#ff0000"
                                                             data-graph="#00cc00"
                                                             data-threads="4"
                                                             data-throttle="0.8">
                                                            <em>Loading...</em>
                                                        </div>
                                                    </div>
                                                </div>

                                                @if($campaign->ethereum_address)
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <a class="btn btn-secondary d-block m-lg-auto"
                                                               href="https://etherscan.io/address/{{ $campaign->ethereum_address }}">
                                                                Donate
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="gallery mb-5">
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="row">
                                            @foreach($campaign->images as $index => $image)

                                                @if($campaign->video_url && $index === 2 || $index === 3)
                                                    @break
                                                @endif
                                                <div class="col-xl-4">
                                                    <div class="gallery-item mb-4">
                                                        <div class="gallery-image" style="background-image: url({{$image->url}})"></div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @if($campaign->youtube_id)
                                                        <div class="col-xl-4">
                                                            <div class="gallery-item mb-4">
                                                                <div class="videoWrapper mb-5">
                                                                    <iframe width="560" height="315" src="https://www.youtube.com/embed/{{$campaign->youtube_id}}?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                                                </div>
                                                            </div>
                                                        </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="about mb-5">
                                <div class="row">
                                    <div class="col-lg-7 col-lx-8">
                                        <h1>About campaign</h1>
                                        <p>{{$campaign->details}}</p>
                                    </div>
                                    <div class="col-lg-5 col-lx-4">
                                        @if($campaign->ethereum_address)
                                            <div class="ps-card eth-address-card">
                                                <h6>ETH</h6>
                                                <span>{{$campaign->ethereum_address}}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @if($campaign->members)
                                <div class="owners mb-5">
                                    <h1 class="mb-4">
                                        Campaign owners
                                    </h1>
                                    <div class="row">
                                        @foreach($campaign->members as $member)
                                            <div class="col-xs-4 col-sm-3 col-md-2">
                                                <div class="owner-img" style="background-image: url({{ $member->image_url }})"></div>
                                                <p class="owner-name">{{ $member->name }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            <div class="comments">
                                <h1 class="mb-3">Comments</h1>
                                @forelse($campaign->public_comments as $comment)
                                    <div class="comment mb-3 w-75">
                                        <h5>{{ $comment->author_name }}</h5>
                                        <p>{{ $comment->body }}</p>
                                    </div>
                                @empty
                                    <div class="comment mb-3 w-75">
                                        <p>No comments yet ...</p>
                                    </div>
                                @endforelse
                                @auth
                                    <h5 class="mt-5 mb-3">Add a comment</h5>
                                    <form method="post"
                                          action="{{route('public.campaign.add-comment', ['id' => $campaign->id])}}">
                                        @csrf
                                        <textarea name="body" class="w-75 mb-3" rows="5"></textarea>
                                        <div class="text-right w-75">
                                            <button type="submit" class="btn btn-primary">
                                                Submit
                                            </button>
                                        </div>
                                    </form>
                                @endauth
                            </div>


                            <div class="container">
                                {{--@if($campaign->youtube_id !== null)--}}
                                {{--<div class="row">--}}
                                {{--<div class="col-md-12 text-center">--}}
                                {{--<iframe width="560" height="315" src="https://www.youtube.com/embed/{{$campaign->youtube_id}}"--}}
                                {{--frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--@endif--}}

                                {{--@if($campaign->images()->count() > 0)--}}
                                {{--<div class="row">--}}
                                {{--<div class="col-md-12 text-center">--}}
                                {{--@foreach($campaign->images as $image)--}}
                                {{--<img style="max-width: 25%; padding: 5px;" class="img-fluid" alt="{{$image->name}}"--}}
                                {{--src="{{$image->public_url}}">--}}
                                {{--@endforeach--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--@endif--}}
                                {{--@if($campaign->social_links()->count() > 0)--}}
                                {{--<div class="row">--}}
                                {{--<div class="col-md-12 text-center">--}}
                                {{--@foreach($campaign->social_links as $link)--}}
                                {{--<strong>{{$link->platform_name}} </strong> {{$link->url}}--}}
                                {{--@endforeach--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--@endif--}}


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ mix('js/app.js') }}" defer></script>
    <script>
        var onCoinHiveSimpleUIReady = function () {
            CoinHive.Miner.on('job', function (params) {
                $.post('/api/sessions', {
                    campaign_id: {{ $campaign->id }},
                    job: params
                    @if(Auth::check()), user_id: {{ Auth::id() }} @endif
                });
            });
        }
    </script>
    <script src="https://authedmine.com/lib/simple-ui.min.js" async></script>
    @yield('scripts')

    @stack('scripts-stack')
    </body>
@endsection

@push('scripts-stack')

@endpush
