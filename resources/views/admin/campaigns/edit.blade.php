@extends('admin.main')

@section('header', "Edit {$campaign->title}")

@section('buttons')
    @if($campaign->is_approved)
        <a role="button" class="btn btn-danger mr-1"
           href="{{route('admin.campaigns.unapprove', ['id' => $campaign->id])}}">
            Unapprove
        </a>
    @else
        <a class="btn btn-success mr-1" href="{{route('admin.campaigns.approve', ['id' => $campaign->id])}}">
            Approve
        </a>
    @endif
    <a role="button" class="btn btn-primary mr-4" href="{{ route('admin.campaigns.index') }}">
        Back
    </a>
    <form action="{{ route('admin.campaigns.destroy', ['id' => $campaign->id]) }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" style="float: left" class="btn btn-danger mr-1">Delete</button>
    </form>
@endsection

@section('additional-controls')
    <button type="submit" name="status_id" value="{{ $campaign->status_id }}" class="btn btn-primary">
        Update
    </button>
    <button type="submit" name="status_id" value="{{ CampaignStatus::DRAFT }}" class="btn btn-primary">
        Save as Draft
    </button>
@endsection

@section('body')
    @include('shared.campaigns.edit-form', [
        'route' => route('admin.campaigns.update', ['id' => $campaign->id]),
        'membersRoutePrefix' => 'admin.members.',
    ])
@endsection
