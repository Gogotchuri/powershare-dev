@extends('admin.main')

@section('header')
    Add a new Member to <a href="{{route('admin.campaigns.edit', ['id' => $campaign->id])}}">{{$campaign->name}}</a>
@endsection

@section('buttons')
    {{--TODO: ... --}}
@endsection

@section('body')
    @include('shared.members.create-form', [
        'route' => route('admin.members.store', ['campaignId' => $campaign->id])
    ])
@endsection
