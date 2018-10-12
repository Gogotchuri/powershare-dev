@extends('admin.main')

@section('header', "Edit {$member->name}")

@section('buttons')
    {{--TODO: ...--}}
@endsection

@section('additional-controls')
    <button type="submit" class="btn btn-primary">
        Update
    </button>
@endsection

@section('body')
    @include('shared.members.edit-form', [
        'route' => route('admin.members.update', ['id' => $member->id]),
    ])
@endsection
