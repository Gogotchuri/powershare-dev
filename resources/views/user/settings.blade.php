@extends('user.main')

@section('header', 'Settings')

@section('buttons')
    <a class="btn btn-primary" href="{{ route('user.campaigns.index') }}">
        Back
    </a>
@endsection

@section('body')
    @include('shared.settings-form', [
        'update_route' => route('user.settings.update')
    ])
@endsection
