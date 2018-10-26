@extends('admin.main')

@section('header', 'All Campaigns')

@section('buttons')
    <a class="btn btn-secondary" href="{{ route('admin.campaigns.create') }}">
        Create
    </a>
@endsection

@section('body')
    @include('shared.campaigns.index-table', [
        'row_route_name' => 'admin.campaigns.edit',
        'continue_route_name' => 'admin.campaigns.edit',
        'create_route' => route('admin.campaigns.create'),
    ])
@endsection
