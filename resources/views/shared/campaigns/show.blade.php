@if($campaign->featured_image_id)
    <img class="campaign-image d-block mb-3" src="{{ $campaign->featured_image_url }}"/>
@endif

<p>{{$campaign->details}}</p>
<h4>Mining stats</h4>

@if($stats)
    <div class="row">
        <div class="col-md-3">
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Total hashes: <span class="badge badge-secondary badge-pill"><big>{{$stats->total}}</big></span>
                </li>
            </ul>
        </div>
    </div>
@else
    <div class="mb-3">
        <small>You haven't contributed to this Campaign yet.</small>
    </div>
@endif

@yield('controls')

@if($campaign->is_approved)
    <div class="alert alert-primary mt-3">
        <div class="d-flex">
            <div class="mr-auto">
                Campaign is approved and public
            </div>
            <a class="btn btn-primary pull-right" target="_blank" href="{{route('public.campaign.show', ['id' => $campaign->id])}}">Open Campaign Page</a>
        </div>
    </div>
@endif
