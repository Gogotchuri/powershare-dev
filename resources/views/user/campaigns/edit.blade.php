@extends('user.main')

@section('header', "Edit {$campaign->title}")

@section('buttons')
    @if($campaign->is_draft)
    <a style="float: left" class="btn btn-danger" href="{{ route('admin.campaigns.delete', ['id' => $campaign->id]) }}">
        Delete
    </a>
    @endif
    <a class="btn btn-primary" href="{{ route('user.campaigns.index') }}">
        Back
    </a>
@endsection

@section('additional-controls')
    <button type="submit" name="status_id" value="{{CampaignStatus::DRAFT}}" class="btn btn-primary">
        Update
    </button>
    <button type="submit" name="status_id" value="{{CampaignStatus::PROPOSAL}}" class="btn btn-primary">
        Submit for review
    </button>
@endsection

@section('body')
    @include('shared.campaigns.edit-form', [
        'route' => route('user.campaigns.update', ['id' => $campaign->id]),
    ])
@endsection

@section('other')
    <div class="card">
        <div class="card-header">
            Image gallery
        </div>
        <div class="card-body">
            @include('components.dropzone', [
                'images' => $campaign->images,
                'url' => route('images.campaigns', $campaign->id)
            ])
        </div>
    </div>
@endsection
