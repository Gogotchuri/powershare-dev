@extends('layouts.app')

@section('additional-controls')
    @if($campaign->is_approved)
        <a class="btn btn-primary" href="{{route('admin.campaigns.unapprove', ['id' => $campaign->id])}}">
            Unapprove
        </a>
    @else
        <a class="btn btn-primary" href="{{route('admin.campaigns.approve', ['id' => $campaign->id])}}">
            Approve
        </a>
    @endif
@endsection

@section('content')
    @include('shared.campaign.edit-form', [
        'route' => route('admin.campaigns.update', ['id' => $campaign->id])
    ])
@endsection