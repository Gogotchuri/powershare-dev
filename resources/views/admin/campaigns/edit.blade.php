@extends('admin.main')

@section('header', "Edit {$campaign->title}")

@section('buttons')
    @if($campaign->is_approved)
        <a class="btn btn-danger" href="{{route('admin.campaigns.unapprove', ['id' => $campaign->id])}}">
            Unapprove
        </a>
    @else
        <a class="btn btn-success" href="{{route('admin.campaigns.approve', ['id' => $campaign->id])}}">
            Approve
        </a>
    @endif
    <a class="btn btn-primary" href="{{ route('admin.campaigns.index') }}">
        Back
    </a>
@endsection

@section('body')
    @include('shared.campaigns.edit-form', [
        'route' => route('admin.campaigns.update', ['id' => $campaign->id])
    ])
@endsection
