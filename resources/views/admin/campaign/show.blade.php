@extends('layouts.app')

@section('content')
    @include('shared.campaign.show', [
        'edit_route_name' => 'admin.campaigns.edit'
    ])
@endsection
