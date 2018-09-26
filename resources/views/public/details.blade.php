@extends('layouts.app')

@section('skeleton')
    <div class="container">
        <br/>
        <br/>
        <h1>{{$campaign->name}}</h1>
        <br/>
        <br/>
        <div class="row">
            <div class="col-md-6">
                <img class="img-fluid" alt="{{optional($campaign->featured_image)->name}}"
                     src="{{optional($campaign->featured_image)->public_url}}">
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <textarea class="form-control" style="width: 100%;" rows="5" readonly>
<script src="https://coinhive.com/lib/coinhive.min.js"></script>
<script>
var miner = new CoinHive.User('SITE_KEY', 'john-doe');
miner.start();
</script>
                        </textarea>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-12">
                        <div class="progress">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 75%" aria-valuenow="75"
                                 aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-12">
                        <div style=" background-color: #ececec; padding: 10px; border-radius: 0.25rem;"
                             class="highlight">
                            <strong>Donate at </strong> {{$campaign->ethereum_address}}
                            </span>
                        </div>
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
        <div class="row">
            <div class="col-md-12">
                <h1>Help us with - details</h1>
                <p>{!! $campaign->details !!}</p>
            </div>
        </div>
        <br/>
        <br/>
        <br/>
        @if($campaign->youtube_id !== null)
            <div class="row">
                <div class="col-md-12 text-center">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/{{$campaign->youtube_id}}"
                            frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
            </div>
        @endif
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

        @forelse($campaign->comments as $comment)
            <a href="#"><h6>{{$comment->author_name}}</h6></a>
            <p>{{$comment->body}}</p>
        @empty
            <div class="alert alert-light" role="alert">
                No comments yet...
            </div>
        @endforelse
        <br/>
        @auth
            <form>
                <div class="form-group">
                    <label for="exampleInputEmail1"><strong>Leave your comment</strong></label>
                    <textarea class="form-control" id="exampleInputEmail1" aria-describedby="commentHelp" placeholder="Enter your comment"></textarea>
                    <small id="emailHelp" class="form-text text-muted">Comments are subject of review</small>
                </div>
            </form>
            <button type="submit" class="btn btn-primary">Submit</button>
        @endauth
        <br/>
        <br/>
        <br/>
    </div>
@endsection
