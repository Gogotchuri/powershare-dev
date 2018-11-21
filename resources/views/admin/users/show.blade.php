@extends('admin.main')

@section('body')
    <ul class="list-group mb-5">
        <li class="list-group-item">Name: <strong>{{ $user->name }}</strong></li>
        <li class="list-group-item">Email: <strong>{{ $user->email }}</strong></li>
        <li class="list-group-item">Registration date: <strong>{{$user->created_at}}</strong></li>
        <li class="list-group-item">Registered with: <strong>{{ ucfirst($user->provider ?? 'email') }}</strong></li>
        <li class="list-group-item">Role: <strong>{{$user->is_admin ? 'Admin' : 'User'}}</strong></li>
    </ul>

    {{--TODO: Following--}}
    {{--<h5 class="m-3">Contributions by campaign</h5>
    <ul class="list-group">
        @foreach($user->contributed_campaigns as $campaign)
            <li class="list-group-item">{{$campaign->name}}: <strong>1000</strong></li>
        @endforeach
    </ul>--}}
@endsection
