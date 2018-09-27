@extends('admin.main')

@section('header', 'Settings')

@section('buttons')
    <a class="btn btn-primary" href="{{ route('admin.campaigns.index') }}">
        Back
    </a>
@endsection

{{--@section('additional-controls')
    <button onclick="onClick('{{CampaignStatus::nameFromId(CampaignStatus::APPROVED)}}')" type="button" class="btn btn-primary">
        Publish
    </button>
@endsection--}}

@section('body')
    @include('shared.settings-form', [
        'update_route' => route('admin.settings.update')
    ])
@endsection
