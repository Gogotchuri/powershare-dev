@extends('layouts.app')

@section('content')
    @include('shared.campaign.index-table', [
        'row_route_name' => 'user.campaigns.edit'
    ])
@endsection
