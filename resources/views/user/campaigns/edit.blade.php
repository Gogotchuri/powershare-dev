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
    <button onclick="onClick('{{CampaignStatus::nameFromId(CampaignStatus::DRAFT)}}')" type="button"
            class="btn btn-primary">
        Save as draft
    </button>
    <button onclick="onClick('{{CampaignStatus::nameFromId(CampaignStatus::PROPOSAL)}}')" type="button"
            class="btn btn-primary">
        Submit for review
    </button>
@endsection

@section('body')
    @include('shared.campaigns.edit-form', [
        'route' => route('user.campaigns.update', ['id' => $campaign->id]),
        'mainImageRoute' => route('user.campaigns.images.upload-main', ['id' => $campaign->id]),
        'imagesRoute' => route('user.campaigns.images.upload', ['id' => $campaign->id])
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
