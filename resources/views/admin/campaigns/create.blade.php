@extends('admin.main')

@section('header', 'Create a new Campaign')

@section('buttons')
    <a class="btn btn-secondary" href="{{ route('admin.campaigns.index') }}">
        Back
    </a>
@endsection

@section('additional-controls')
    <button onclick="onClick('{{CampaignStatus::nameFromId(CampaignStatus::APPROVED)}}')" type="button" class="btn btn-secondary">
        Publish
    </button>
@endsection

@section('body')
    @include('shared.campaigns.create-form', [
        'route' => route('admin.campaigns.store')
    ])
@endsection
