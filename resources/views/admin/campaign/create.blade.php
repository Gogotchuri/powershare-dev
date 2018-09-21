@extends('layouts.app')

@section('content')
    @include('shared.campaign.create-form', [
        'route' => route('admin.campaigns.store')
    ])
@endsection
