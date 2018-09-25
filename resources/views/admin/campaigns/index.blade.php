@extends('admin.main')

@section('header', 'All Campaigns')

@section('buttons')
    <a class="btn btn-primary" href="{{ route('admin.campaigns.create') }}">
        Create
    </a>
@endsection

@section('body')
    @include('shared.campaigns.index-table', [
        'row_route_name' => 'admin.campaigns.edit',
        'continue_route_name' => 'user.campaigns.edit'
    ])
@endsection
