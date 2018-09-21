@extends('layouts.app')

@section('content')
    @include('shared.campaign.create-form', [
        'route' => route('user.campaigns.store')
    ])
@endsection
