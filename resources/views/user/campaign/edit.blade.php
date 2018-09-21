@extends('layouts.app')

@section('content')
    @include('shared.campaign.edit-form', [
        'route' => route('user.campaigns.update', ['id' => $campaign->id])
    ])
@endsection
