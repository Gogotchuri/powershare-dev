@extends('layouts.app')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Author</th>
            <th scope="col">Campaign</th>
            <th scope="col">Body</th>
        </tr>
        </thead>
        <tbody>
        @foreach($comments as $comment)
            <tr>
                <th scope="row"> {{$comment->id}}</th>
                {{-- TODO: following --}}
                {{--<th scope="row"> {{$comment->id}}</th>
                <th scope="row"> {{$comment->id}}</th>
                <th scope="row"> {{$comment->id}}</th>--}}
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
