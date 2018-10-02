@extends('user.main')

@section('header', 'Settings')

@section('buttons')
    <a class="btn btn-primary" href="{{ route('user.campaigns.index') }}">
        Back
    </a>
@endsection

@section('body')
    @include('shared.settings.password-form', [
        'update_route' => route('user.settings.updatePassword')
    ])
    <br/><br/><br/>
    @include('shared.settings.notifications-form', [
        'update_route' => route('user.settings.updateNotifications')
    ])
@endsection
