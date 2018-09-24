@extends('admin.main')

@section('body')
    <form method="post" action="{{route('admin.comments.update', ['id' => $comment->id])}}">

        {{method_field('PUT')}}

        @csrf

        @include('components.form.textarea', [
            'name' => 'Body',
            'required' => true,
            'value' => $comment->body,
        ])

        @include('components.form.select', [
            'name' => 'Campaign',
            'required' => true,
            'options' => $campaigns,
            'title' => 'name',
            'value' => $comment->campaign_id,
        ])

        @include('components.form.select', [
            'name' => 'Author',
            'required' => true,
            'options' => $users,
            'title' => 'name',
            'value' => $comment->author_id,
        ])

        @include('components.form.input', [
            'name' => 'Date',
            'required' => true,
            'type' => 'datetime',
            'value' => Carbon\Carbon::parse($comment->date)->toDateTimeString()
        ])

        @include('components.form.input', [
            'type'=> "checkbox",
            'name'=> "Status",
            'value' => true,
            'checked' => $comment->is_public,
        ])

        <button type="submit" class="btn btn-primary">
            Edit
        </button>

        <a href="{{route('admin.comments.delete', ['id' => $comment->id])}}" style="float: right;" class="btn btn-danger">
            Delete
        </a>
    </form>
@endsection
