@extends('layouts.app')

<body>
<div id="app" class="background-image campaign-page" style="background-image: url(/img/background-campaign.png);">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 left-panel">
                <img src="/img/logo-front.png" alt="Powershare logo" class="logo">
                <div class="side-menu">
                    <a href="#">About us</a>
                    <a href="#">Register Campaign</a>
                    <a href="#">FAQ</a>
                </div>
                <div class="inspire">
                    <div class="ps-card">
                        <h1>{{ $campaign->name }}</h1>
                        <p>
                            {{ $campaign->details }}
                        </p>

                        <div class="row">
                            <div class="col-sm-7">
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
                            <div class="col-sm-5">
                                <div class="coinhive-miner mb-3"
                                     style="width: 100%; height: 250px"
                                     data-key="pzZHmhyywPSQ7Q2ydEFGFK01kXVKiS0x"
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

                    <div class="container">

                        <div class="row">
                            <div class="col-md-6">

                                <br/>
                                <div class="row">
                                    <div class="col-md-12">

                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-md-12">

                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button style="width: 100%" onclick="alert('How it works, coming soon!')" class="btn btn-success btn-lg">How it works?</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br/>
                        <br/>
                        <br/>
                        {{--@if($campaign->youtube_id !== null)--}}
                            {{--<div class="row">--}}
                                {{--<div class="col-md-12 text-center">--}}
                                    {{--<iframe width="560" height="315" src="https://www.youtube.com/embed/{{$campaign->youtube_id}}"--}}
                                            {{--frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--@endif--}}
                        <br/>
                        <br/>
                        @if($campaign->images()->count() > 0)
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    @foreach($campaign->images as $image)
                                        <img style="max-width: 25%; padding: 5px;" class="img-fluid" alt="{{$image->name}}"
                                             src="{{$image->public_url}}">
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @if($campaign->social_links()->count() > 0)
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    @foreach($campaign->social_links as $link)
                                        <strong>{{$link->platform_name}} </strong> {{$link->url}}
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- TODO: Move this query in controller or somewhere else not here!--}}
                        @forelse($comments as $comment)
                            <div class="comment-container @if(!$comment->is_public) non-public @endif">
                                <a class="comment-author" href="#"><h6>{{$comment->author_name}}</h6></a>
                                <div>
                                    <span class="comment-body">{{$comment->body}}</span>
                                    <small id="emailHelp" class="form-text text-muted">Only you can see this comment until it gets published.</small>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-light" role="alert">
                                No comments yet...
                            </div>
                        @endforelse
                        <br/>
                        @auth
                            <form method="post" action="{{route('public.campaign.add-comment', ['id' => $campaign->id])}}">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><strong>Leave your comment</strong></label>
                                    <textarea required name="body" class="form-control" id="exampleInputEmail1" aria-describedby="commentHelp" placeholder="Enter your comment"></textarea>
                                    <small id="emailHelp" class="form-text text-muted">Comments are subject of review</small>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        @endauth
                        <br/>
                        <br/>
                        <br/>
                    </div>
                </div>

            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
</div>

<script src="{{ mix('js/app.js') }}" defer></script>
<script>
    var onCoinHiveSimpleUIReady = function() {
        CoinHive.Miner.on('authed', function(params) {
            console.log('Simple UI has authed with the pool');
        });
        CoinHive.Miner.on('job', function(params) {
            console.log('New job received from pool');
        });
    }
</script>
<script src="https://authedmine.com/lib/simple-ui.min.js" async></script>
@yield('scripts')

@stack('scripts-stack')
</body>

@push('scripts-stack')

@endpush
