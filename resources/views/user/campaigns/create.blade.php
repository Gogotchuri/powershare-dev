@extends('user.main')

@section('header', 'Create a new Campaign')

@section('buttons')
    <a class="btn btn-primary" href="{{ route('user.campaigns.index') }}">
        Back
    </a>
@endsection

@section('body')
    @include('shared.campaigns.create-form', [
        'route' => route('user.campaigns.store')
    ])
@endsection
