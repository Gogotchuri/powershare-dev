@extends('user.main')

@section('header', 'My Campaigns')

@section('buttons')
    <a class="btn btn-primary" href="{{ route('user.campaigns.create') }}">
        Create
    </a>
@endsection

@section('body')
    @include('shared.campaigns.index-table', [
        'row_route_name' => 'user.campaigns.show',
        'continue_route_name' => 'user.campaigns.edit'
    ])
@endsection
