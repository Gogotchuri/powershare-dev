<h1>Hello, <strong>{{$campaign->author->name}}</strong></h1>
<div class="alert alert-success" role="alert">
    Campaign <a target="_blank" href="{{route('public.campaign.show', ['id' => $campaign->id])}}"><strong>{{$campaign->name}}</strong></a> {{$notification}}
</div>
