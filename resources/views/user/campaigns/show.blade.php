@extends('user.main')

@section('header', $campaign->name)

@section('body')
    @section('controls')
        @if($campaign->is_draft)
            <a class="btn btn-primary" href="{{route('user.campaigns.edit', ['id' => $campaign->id])}}">Continue editing</a>
        @elseif($campaign->is_proposal)
            <div class="alert alert-warning" role="alert">
                <p>Submited for review.</p>
                <form method="post" action="{{route('user.campaigns.delete', ['id' => $campaign->id])}}">
                    @method("DELETE")
                    @csrf
                    <div class="btn-group">
                        <button type="submit" class="btn btn-danger">Delete Campaign</button>
                    </div>
                </form>
            </div>
        @else
            <div class="alert alert-success" role="alert">
                <a href="{{route('public.campaign.show', ['id' => $campaign->id])}}" target="_blank">Public</a>
            </div>
        @endif
    @endsection
    @include('shared.campaigns.show')
@endsection
