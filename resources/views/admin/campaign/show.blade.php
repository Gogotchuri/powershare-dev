@extends('admin.main')

@section('body')
    @include('shared.campaign.show', [
        'edit_route_name' => 'admin.campaigns.edit'
    ])
@endsection
