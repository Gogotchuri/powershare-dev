@extends('user.main')

@section('header', "Edit {$campaign->title}")

@section('buttons')
    <a class="btn btn-primary" href="{{ route('user.campaigns.index') }}">
        Back
    </a>
@endsection

@section('body')
    @include('shared.campaign.edit-form', [
        'route' => route('user.campaigns.update', ['id' => $campaign->id])
    ])
@endsection
