@extends('user.main')

@section('header', 'Add a new Member')

@section('buttons')
    {{--TODO: ... --}}
@endsection

@section('body')
    @include('shared.members.create-form', [
        'route' => route('user.members.store', ['campaignId' => $campaignId])
    ])
@endsection
