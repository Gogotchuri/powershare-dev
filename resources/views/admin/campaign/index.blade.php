@extends('admin.main')

@section('header', 'All Campaigns')

@section('buttons')
    <a class="btn btn-primary" href="{{ route('admin.campaigns.create') }}">
        Create
    </a>
@endsection

@section('body')
    @include('shared.campaign.index-table', [
        'row_route_name' => 'admin.campaigns.edit'
    ])
@endsection
