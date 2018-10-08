@extends('layouts.app')

<body>
<div id="app" class="background-image campaign-page" style="background-image: url(/img/background-campaign.png);">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 left-panel">
                <a href="/">
                    <img src="/img/logo-front.png" alt="Powershare logo" class="logo">
                </a>
                @include('public.partials.nav')
                <div class="inspire">
                    <div class="ps-card">
                        <h1>{{ $campaign->name }}</h1>
                        <p>
                            {{ $campaign->details }}
                        </p>

                        <div class="row">
                            <div class="col-sm-7">
                                <div id="light-slider-wrapper">
                                    <ul id="light-slider">
                                        <li data-thumb="http://sachinchoolur.github.io/lightslider/img/thumb/cS-1.jpg">
                                            <img src="http://sachinchoolur.github.io/lightslider/img/cS-1.jpg" />
                                        </li>
                                        <li data-thumb="http://sachinchoolur.github.io/lightslider/img/thumb/cS-2.jpg">
                                            <img src="http://sachinchoolur.github.io/lightslider/img/cS-2.jpg" />
                                        </li>
                                        <li data-thumb="http://sachinchoolur.github.io/lightslider/img/thumb/cS-3.jpg">
                                            <img src="http://sachinchoolur.github.io/lightslider/img/cS-3.jpg" />
                                        </li>
                                        <li data-thumb="http://sachinchoolur.github.io/lightslider/img/thumb/cS-4.jpg">
                                            <img src="http://sachinchoolur.github.io/lightslider/img/cS-4.jpg" />
                                        </li>
                                        <li data-thumb="http://sachinchoolur.github.io/lightslider/img/thumb/cS-5.jpg">
                                            <img src="http://sachinchoolur.github.io/lightslider/img/cS-5.jpg" />
                                        </li>
                                        <li data-thumb="http://sachinchoolur.github.io/lightslider/img/thumb/cS-6.jpg">
                                            <img src="http://sachinchoolur.github.io/lightslider/img/cS-6.jpg" />
                                        </li>
                                        <li data-thumb="http://sachinchoolur.github.io/lightslider/img/thumb/cS-7.jpg">
                                            <img src="http://sachinchoolur.github.io/lightslider/img/cS-7.jpg" />
                                        </li>
                                        <li data-thumb="http://sachinchoolur.github.io/lightslider/img/thumb/cS-8.jpg">
                                            <img src="http://sachinchoolur.github.io/lightslider/img/cS-8.jpg" />
                                        </li>
                                        <li data-thumb="http://sachinchoolur.github.io/lightslider/img/thumb/cS-9.jpg">
                                            <img src="http://sachinchoolur.github.io/lightslider/img/cS-9.jpg" />
                                        </li>
                                        <li data-thumb="http://sachinchoolur.github.io/lightslider/img/thumb/cS-10.jpg">
                                            <img src="http://sachinchoolur.github.io/lightslider/img/cS-10.jpg" />
                                        </li>
                                        <li data-thumb="http://sachinchoolur.github.io/lightslider/img/thumb/cS-11.jpg">
                                            <img src="http://sachinchoolur.github.io/lightslider/img/cS-12.jpg" />
                                        </li>
                                        <li data-thumb="http://sachinchoolur.github.io/lightslider/img/thumb/cS-13.jpg">
                                            <img src="http://sachinchoolur.github.io/lightslider/img/cS-13.jpg" />
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-5">
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
                                     data-throttle="0.1">
                                    <em>Loading...</em>
                                </div>
                                @if($campaign->ethereum_address)
                                <a class="btn btn-secondary d-block m-lg-auto" href="https://etherscan.io/address/{{ $campaign->ethereum_address }}">
                                    Donate
                                </a>
                                @endif
                            </div>
                        </div>

                    </div>
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
                            <form method="post" action="{{route('public.campaign.add-comment', ['id' => $campaign->id])}}">
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
            <div class="col-sm-4">
                <div class="text-right">
                    @include('public.partials.auth-buttons')
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ mix('js/app.js') }}" defer></script>
<script>
    var onCoinHiveSimpleUIReady = function() {
        CoinHive.Miner.on('job', function(params) {
            $.post('/api/sessions', {
                campaign_id: {{ $campaign->id }},
                job: params,
                user_id: {{ Auth::id() }},
            });
        });
    }
</script>
<script src="https://authedmine.com/lib/simple-ui.min.js" async></script>
@yield('scripts')

@stack('scripts-stack')
</body>

@push('scripts-stack')

@endpush
