@extends('user.main')

@section('header', $campaign->name)

@section('body')
    @section('controls')
        @if($campaign->is_draft && Auth::user()->ownsCampaign($campaign->id))
            <a class="btn btn-primary" href="{{route('user.campaigns.edit', ['id' => $campaign->id])}}">Continue editing</a>
        @elseif($campaign->is_proposal && Auth::user()->ownsCampaign($campaign->id))
            <div class="alert alert-warning mt-3" role="alert">
                <p>Submited for review.</p>
                <form method="post" action="{{route('user.campaigns.destroy', ['id' => $campaign->id])}}">
                    @method("DELETE")
                    @csrf
                    <div class="btn-group">
                        <button type="submit" class="btn btn-danger">Delete Campaign</button>
                    </div>
                </form>
            </div>
        @endif
    @endsection
    @include('shared.campaigns.show')
@endsection
