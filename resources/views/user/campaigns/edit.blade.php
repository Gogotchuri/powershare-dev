@extends('user.main')

@section('header', "Edit {$campaign->title}")

@section('additional-controls')
    @if($campaign->is_approved)
        <a class="btn btn-danger" href="{{route('admin.campaigns.unapprove', ['id' => $campaign->id])}}">
            Unapprove
        </a>
    @else
        <a class="btn btn-success" href="{{route('admin.campaigns.approve', ['id' => $campaign->id])}}">
            Approve
        </a>
    @endif
    <?php echo $campaign->is_draft ?>
    @include('components.form.input', [
            'type'=> "checkbox",
            'name'=> "Draft",
            'value' => true,
            'checked' => $campaign->is_draft === null || $campaign->is_draft ? true : false,
        ])
@endsection

@section('buttons')
    <a class="btn btn-primary" href="{{ route('user.campaigns.index') }}">
        Back
    </a>
@endsection

@section('body')
    @include('shared.campaigns.edit-form', [
        'route' => route('user.campaigns.update', ['id' => $campaign->id])
    ])
@endsection
