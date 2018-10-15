@extends('user.main')

@section('header', "Edit {$campaign->title}")

@section('buttons')
    @if($campaign->is_draft)
        <a class="btn btn-danger mr-1" href="{{ route('admin.campaigns.delete', ['id' => $campaign->id]) }}">
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
    <div class="card mb-3">
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
    <div class="card mb-3">
        <div class="card-header">
            Team members
            <div class="btn-group float-right">
                <a href="{{route('user.members.create', ['campaignId' => $campaign->id])}}" class="btn btn-success">Add
                    new</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach($campaign->members as $member)
                    <div class="col-sm-4">
                        <div class="card mb-3">
                            <div class="card-header">
                                {{$member->name}}
                            </div>
                            <div class="card-body">
                                <img id="featured-image" src="{{ $member->image_url }}" class="w-100 mb-3"
                                     @if(!$member->image_url) style="display: none;" @endif
                                />
                                <div class="btn-group">
                                    <a href="{{route('user.members.edit', ['id' => $member->id])}}"
                                       class="btn btn-primary">Edit</a>
                                </div>
                                <div class="btn-group">
                                    <form method="post"
                                          action="{{route('user.members.destroy', ['id' => $member->id])}}">

                                        @method('DELETE')
                                        @csrf


                                        <button type="submit" class="btn btn-danger">Delete</button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection
