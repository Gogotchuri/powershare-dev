@extends('admin.main')

@section('header', $campaign->name)

@section('body')
    @section('controls')
        <a class="btn btn-primary" href="{{route('admin.campaigns.edit', [$campaign->id])}}">Edit</a>
    @endsection
    @include('shared.campaigns.show')
@endsection
