@extends('admin.main')

@section('header', 'All Comments')

@section('body')
    <table class="table datatables" style="width: 100%;">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Author</th>
            <th scope="col">Campaign</th>
            <th scope="col">Body</th>
            <th scope="col">Status</th>
            <th scope="col">Date</th>
        </tr>
        </thead>
        <tbody>
        @foreach($comments as $comment)
            <tr class="clickable" onclick="location.href = '{{ route('admin.comments.edit', ['id' => $comment->id]) }}'">
                <th scope="row"> {{$comment->id}}</th>
                <td> {{$comment->author_name}}</td>
                <td> {{$comment->campaign_name}}</td>
                <td> {{mb_strimwidth($comment->body, 0, 100, "...")}}</td>
                <td>
                    <span class="badge badge-pill badge-{{$comment->is_public ? 'success' : 'secondary'}}">{{$comment->is_public ? 'public' : 'Not public'}}</span>
                </td>
                <td> {{$comment->date}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
