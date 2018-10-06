@if($campaign->url)
<div class="w-50">
    <img class="campaign-image" src="{{asset($campaign->url)}}"/>
</div>
@endif

<p>{{$campaign->details}}</p>

@yield('controls')
