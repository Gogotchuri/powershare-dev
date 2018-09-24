@extends('admin.main')

@section('body')
    @include('shared.campaigns.show', [
        'edit_route_name' => 'admin.campaigns.edit'
    ])
@endsection
