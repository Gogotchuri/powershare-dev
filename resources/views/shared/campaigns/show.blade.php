<h2>{{$campaign->name}}</h2>

<div>
    <img class="campaign-image" src="{{asset($campaign->featured_image_url)}}"/>
</div>
<p>{{$campaign->details}}</p>

@yield('controls')