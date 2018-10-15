@extends('user.main')

@section('header')
    Edit <a href="#">{{$member->name}}</a> of <a href="{{route('user.campaigns.edit', ['id' => $member->campaign->id])}}">{{$member->campaign->name}}</a>
@endsection

@section('buttons')
    {{--TODO: ...--}}
@endsection

@section('additional-controls')
    <button type="submit" class="btn btn-primary">
        Update
    </button>
@endsection

@section('body')
    @include('shared.members.edit-form', [
        'route' => route('user.members.update', ['id' => $member->id]),
    ])
@endsection
