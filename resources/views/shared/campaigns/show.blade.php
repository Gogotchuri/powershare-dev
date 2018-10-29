@if($campaign->featured_image_id)
    <img class="campaign-image d-block mb-3" src="{{ $campaign->featured_image_url }}"/>
@endif

<p>{{$campaign->details}}</p>

<h4>Mining stats</h4>
@if($stats)
    <div class="row">
        <div class="col-md-6">
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Total:
                    <span class="badge badge-primary badge-pill">{{$stats->total}}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Withdrawn:
                    <span class="badge badge-primary badge-pill">{{$stats->withdrawn}}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Balance:
                    <span class="badge badge-primary badge-pill">{{$stats->balance}}</span>
                </li>
            </ul>
        </div>
    </div>
@endif

<a class="btn btn-primary" target="_blank" href="{{route('public.campaign.show', ['id' => $campaign->id])}}">Open Campaign Page</a>

@yield('controls')
