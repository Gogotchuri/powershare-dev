@extends('user.main')

@section('header')
    Add a new Member to <a href="{{route('user.campaigns.edit', ['id' => $campaign->id])}}">{{$campaign->name}}</a>
@endsection

@section('buttons')
    <a class="btn btn-primary" href="{{route('user.campaigns.edit', ['id' => $campaign->id])}}">Back</a>
@endsection

@section('body')
    @include('shared.members.create-form', [
        'route' => route('user.members.store', ['campaignId' => $campaign->id])
    ])
@endsection
