@extends('admin.main')

@section('body')
    <table class="table datatables" style="width: 100%;">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Authors</th>
            <th scope="col">Campaign</th>
            <th scope="col">Body</th>
        </tr>
        </thead>
        <tbody>
        @foreach($comments as $comment)
            <tr class="clickable" onclick="location.href = '{{ route('admin.comments.edit', ['id' => $comment->id]) }}'">
                <th scope="row"> {{$comment->id}}</th>
                <td scope="row"> {{$comment->author_name}}</td>
                <td scope="row"> {{$comment->campaign_name}}</td>
                <td scope="row"> {{mb_strimwidth($comment->body, 0, 100, "...")}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
