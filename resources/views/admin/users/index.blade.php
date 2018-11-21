@extends('admin.main')

@section('header', 'All Comments')

@section('body')
    <table class="table datatables" style="width: 100%;">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Registered at</th>
            {{--TODO: Following--}}
            {{--<th scope="col">Contributions</th>--}}
            <th scope="col">Role</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr class="clickable" onclick="location.href = '{{ route('admin.users.show', ['id' => $user->id]) }}'">
                <th scope="row"> {{$user->id}}</th>
                <td> {{$user->name}}</td>
                <td> {{$user->email}}</td>
                <td> {{$user->created_at}}</td>
                {{--TODO: Following--}}
                {{--<td> {{$user->total_contributions}}</td>--}}
                <td> {{$user->is_admin ? 'Admin' : 'User'}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
