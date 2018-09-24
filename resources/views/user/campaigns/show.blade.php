@extends('user.main')

@section('body')
    @include('shared.campaigns.show', [
        'edit_route_name' => 'user.campaigns.edit'
    ])
@endsection
