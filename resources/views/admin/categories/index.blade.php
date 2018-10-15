@extends('admin.main')

@section('header', 'All Campaign Categories')

@section('buttons')
    {{--TODO: ... --}}
@endsection

@section('body')
    <table class="table datatables" style="width: 100%;">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Icon</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr class="clickable" onclick="location.href = '{{ route('admin.categories.edit', ['id' => $category->id]) }}'">
                <td scope="row"> {{$category->id}}</td>
                <td>{!! $category->name !!}</td>
                <td><img src="data:image/png;base64,{{base64_encode($category->icon)}}" /></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
