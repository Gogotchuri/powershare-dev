@if($campaign->featured_image_id)
    <img class="campaign-image d-block mb-3" src="{{ $campaign->featured_image_url }}"/>
@endif

<p>{{$campaign->details}}</p>

@yield('controls')
