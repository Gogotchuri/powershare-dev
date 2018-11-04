@extends('admin.main')

@section('header')
    Edit <a href="#">{{$member->name}}</a> of <a href="{{route('admin.campaigns.edit', ['id' => $member->campaign->id])}}">{{$member->campaign->name}}</a>
@endsection

@section('header', "Edit {$member->name}")

@section('buttons')
    <a class="btn btn-primary" href="{{route('admin.campaigns.edit', ['id' => $member->campaign->id])}}">Back</a>
@endsection

@section('additional-controls')
    <button type="submit" class="btn btn-primary">
        Update
    </button>
@endsection

@section('body')
    @include('shared.members.edit-form', [
        'route' => route('admin.members.update', ['id' => $member->id]),
    ])
@endsection
