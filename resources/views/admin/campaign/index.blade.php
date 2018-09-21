@extends('layouts.app')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Details</th>
            <th scope="col">Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($campaigns as $campaign)
        <tr>
            <th scope="row"> {{$campaign->id}}</th>
            <td><a href="{{route('admin.campaigns.show', ['id' => $campaign->id])}}">{{'Sample Name'}}</a></td>
            <td>{{mb_strimwidth($campaign->details, 0, 10, "...")}}</td>
            <td><span class="badge badge-pill badge-{{$campaign->is_approved ? 'success' : 'secondary'}}">{{$campaign->status_name}}</span></td>
        </tr>
            @endforeach
        </tbody>
    </table>
@endsection
